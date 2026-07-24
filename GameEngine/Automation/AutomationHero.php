<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationHero.php                                          ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Hero adventures, regeneration, level-up, hero revival       ##
##                                                                             ##
##  Phase S2: Trait extracted from GameEngine/Automation.php                   ##
##            (Automation class).                                              ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

trait AutomationHero {


    /**
     * T4 Hero port (Phase 3+4): process adventure arrivals (sort_type 20,
     * rewards + ntype 26 report + return movement), returns (sort_type 21,
     * hero re-enters units.hero, loot credited), top up offer lists, then
     * finalize ended auctions and restock the NPC merchant.
     * Fully feature-flagged - a no-op unless NEW_FUNCTIONS_HERO_T4 is enabled.
     */
    private function heroAdventureComplete() {
        if (!defined('NEW_FUNCTIONS_HERO_T4') || !NEW_FUNCTIONS_HERO_T4) {
            return;
        }

        $adventures = new HeroAdventure();
        $adventures->processArrivals();
        $adventures->processReturns();
        $adventures->generateOffersBatch();

        $auctions = new HeroAuction();
        $auctions->processFinished();
        $auctions->seedNpcAuctions();
    }

    private function updateHero() {
        global $database, $hero_levels;
        
        $harray = $database->getHero();
        if(!empty($harray)){
            // first of all, prepare all unit data at once for these heroes
            $heroVillageIDs = [];
            foreach($harray as $hdata) {
                $heroVillageIDs[] = $hdata['wref'];
            }

            // load data for those prepared IDs
            $unitData = $database->getUnit($heroVillageIDs);

            // now do the math
            $lastUpdateIDs = [];
            $timeNow = time();
            foreach($harray as $hdata){
                $columns = [];
                $columnValues = [];
                $modes = [];
                $lastUpdateTime = $timeNow;

                // 1. passive HP regeneration
                $newHealth = $this->calculateHealthRegen($hdata);

                // 2. level-up + score points
                $this->mergeHeroColumns($columns, $columnValues, $modes, $this->calculateLevelUp($hdata));

                // 3. revive completion (forces health to 100 and stamps the update time)
                $revive = $this->handleReviveCompletion($hdata);
                $this->mergeHeroColumns($columns, $columnValues, $modes, $revive);
                if ($revive['health'] !== null) $newHealth = $revive['health'];
                if ($revive['lastUpdate'] !== null) $lastUpdateTime = $revive['lastUpdate'];

                // 4. training completion (does not touch health)
                $training = $this->handleTrainingCompletion($hdata);
                $this->mergeHeroColumns($columns, $columnValues, $modes, $training);
                if ($training['lastUpdate'] !== null) $lastUpdateTime = $training['lastUpdate'];

                // update health, if needed
                if ($newHealth > -1) {
                    $columns[] = 'health';
                    $columnValues[] = $newHealth;
                    $modes[] = null;
                }

                if ($lastUpdateTime != $timeNow) {
                    // last update timestamp
                    $columns[]      = 'lastupdate';
                    $columnValues[] = $lastUpdateTime;
                    $modes[]        = null;
                } else {
                    // leave same last update values for multiple heroes to the end
                    $lastUpdateIDs[] = $hdata['heroid'];
                }

                if (count($columns)) $database->modifyHero($columns, $columnValues, $hdata['heroid'], $modes);
            }

            if (count($lastUpdateIDs)) {
                mysqli_query($database->dblink,"UPDATE " . TB_PREFIX . "hero SET lastupdate = $timeNow WHERE heroid IN(".implode(', ', $lastUpdateIDs).")");
            }
        }
    }

    // Append a hero column fragment (['columns'=>[], 'values'=>[], 'modes'=>[]])
    // onto the running modifyHero() arrays, preserving order.
    private function mergeHeroColumns(&$columns, &$columnValues, &$modes, $fragment) {
        foreach ($fragment['columns'] as $k => $col) {
            $columns[]      = $col;
            $columnValues[] = $fragment['values'][$k];
            $modes[]        = $fragment['modes'][$k];
        }
    }

    // Passive HP regeneration: returns the new health value, or -1 if unchanged.
    private function calculateHealthRegen($hdata) {
        // Eroii morti nu se regenereaza (se ridica prin inviere, nu singuri).
        if ((int) $hdata['dead'] === 1) {
            return -1;
        }

        if((time()-$hdata['lastupdate']) >= 1){
            // FIX: conditia veche era "health > 0", deci un erou VIU ajuns exact
            // la 0 ramanea blocat acolo pentru totdeauna. Acum conteaza doar sa
            // fie viu si sub 100.
            if($hdata['health'] < 100){
                if(SPEED <= 10) $speed = SPEED;
                else if(SPEED <= 100) $speed = ceil(SPEED / 10);
                else $speed = ceil(SPEED / 100);

                // FIX: bonusul HB_REGEN_HP al coifurilor (Regeneration / Health /
                // Healing = +10/15/20 HP pe zi) nu era aplicat nicaieri - exista
                // doar in definitia itemelor. Se adauga la regenerarea proprie a
                // eroului, scalat cu aceeasi viteza de server ca aceasta, altfel
                // pe un server rapid ar fi complet nesemnificativ.
                // ANOMALIE DE SEMNALAT: in T4 valoarea e "HP pe zi" fixa; aici o
                // scalam cu $speed pentru consecventa cu regenerarea din atribute.
                // Daca preferi valoarea fixa, scoate "* $speed" de mai jos.
                $itemRegen = $this->heroItemRegen($hdata);

                // FIX PRINCIPAL: pana acum regenerarea depindea EXCLUSIV de
                // atributul 'regeneration'. Un erou nou porneste cu acest atribut
                // pe 0 (vezi INSERT-ul din 37_train.tpl), deci daca jucatorul nu
                // punea puncte acolo, viata NU se refacea niciodata: scadea la
                // fiecare aventura sau lupta si nu urca inapoi. Dupa destule
                // aventuri ajungea la 0 si eroul murea chiar si la o aventura
                // "Normal" (care ia doar 0-8 HP) - exact simptomul raportat.
                //
                // Acum exista o regenerare de BAZA, independenta de atribute, ca
                // in Travian T4 (implicit 10 HP pe zi). Se poate regla din
                // GameEngine/config.php:  define('HERO_BASE_REGEN', 10);
                $baseRegen = defined('HERO_BASE_REGEN') ? (float) HERO_BASE_REGEN : 10;

                // HP pe zi din toate sursele: baza + atribut (5 per punct) + iteme
                $perDay = $baseRegen + ($hdata['regeneration'] * 5) + $itemRegen;

                $reg = $hdata['health']
                     + $perDay * $speed / 86400 * (time() - $hdata['lastupdate']);

                return ($reg <= 100) ? $reg : 100;
            }
        }
        return -1;
    }

    /**
     * HP pe zi adaugat de itemele echipate (HB_REGEN_HP).
     *
     * HeroBattleBonus::bonuses() are gard de feature flag, cache per request si
     * intoarce null cand sistemul T4 e oprit - deci pe serverele fara erou T4
     * comportamentul ramane exact ca inainte.
     */
    private function heroItemRegen($hdata) {
        if (!class_exists('HeroBattleBonus') || !HeroBattleBonus::enabled()) {
            return 0;
        }

        $uid = isset($hdata['uid']) ? (int) $hdata['uid'] : 0;

        if ($uid <= 0) {
            return 0;
        }

        $bonuses = HeroBattleBonus::bonuses($uid);

        return $bonuses ? (float) $bonuses[HB_REGEN_HP] : 0;
    }

    // Level-up + score points. Returns a column fragment.
    private function calculateLevelUp($hdata) {
        global $hero_levels;

        $columns = [];
        $values = [];
        $modes = [];

        $herolevel = $hdata['level'];
        $newLevel = - 1;
        $scorePoints = false;
        // Nivelul maxim se ia din tabelul de experienta, nu mai e scris in cod:
        // ultimul index e o santinela care repeta valoarea nivelului maxim real.
        // Asa, extinderea tabelului (facuta pentru al 6-lea atribut, "Resources")
        // ridica automat si plafonul de nivel.
        $maxLevel = max(array_keys($hero_levels)) - 1;

        for ($i = $herolevel + 1; $i <= $maxLevel; $i++){
            if($hdata['experience'] >= $hero_levels[$i]){
                $newLevel = $i;
                // punctele se acorda pentru FIECARE nivel, inclusiv ultimul:
                // 5 initiale + 119 niveluri x 5 = 600, adica exact cat trebuie
                // pentru 6 atribute duse la maximul de 100
                $scorePoints = true;
            }
        }

        // upgrade hero to a new level, if needed
        if ($newLevel > -1) {
            $columns[] = 'level';
            $values[]  = $newLevel;
            $modes[]   = null;
        }

        // add as many points as needed, if we're below level 100
        if ($scorePoints) {
            $columns[] = 'points';
            $values[]  = (5 * ($newLevel - $herolevel));
            $modes[]   = 1;
        }

        return ['columns' => $columns, 'values' => $values, 'modes' => $modes, 'health' => null, 'lastUpdate' => null];
    }

    // Revive completion: marks the hero unit alive and clears the revive flag.
    // Returns a column fragment plus the health (100) and lastUpdate overrides.
    private function handleReviveCompletion($hdata) {
        global $database;

        if($hdata['trainingtime'] < time() && $hdata['inrevive'] == 1){
            mysqli_query($database->dblink,"UPDATE " . TB_PREFIX . "units SET hero = 1 WHERE vref = ".(int) $hdata['wref']."");

            return [
                'columns'    => ['dead', 'inrevive', 'inrevive'],
                'values'     => [0, 0, 0],
                'modes'      => [null, null, null],
                'health'     => 100,
                'lastUpdate' => (int) $hdata['trainingtime'],
            ];
        }

        return ['columns' => [], 'values' => [], 'modes' => [], 'health' => null, 'lastUpdate' => null];
    }

    // Training completion: marks the hero unit alive and clears the training flag.
    // Returns a column fragment plus the lastUpdate override (health untouched).
    private function handleTrainingCompletion($hdata) {
        global $database;

        if($hdata['trainingtime'] < time() && $hdata['intraining'] == 1){
            mysqli_query($database->dblink,"UPDATE " . TB_PREFIX . "units SET hero = 1 WHERE vref = ".(int) $hdata['wref']);

            return [
                'columns'    => ['dead', 'intraining'],
                'values'     => [0, 0],
                'modes'      => [null, null],
                'health'     => null,
                'lastUpdate' => (int) $hdata['trainingtime'],
            ];
        }

        return ['columns' => [], 'values' => [], 'modes' => [], 'health' => null, 'lastUpdate' => null];
    }
}
