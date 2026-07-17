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
        if((time()-$hdata['lastupdate']) >= 1){
            if($hdata['health'] < 100 and $hdata['health'] > 0){
                if(SPEED <= 10) $speed = SPEED;
                else if(SPEED <= 100) $speed = ceil(SPEED / 10);
                else $speed = ceil(SPEED / 100);

                $reg = $hdata['health'] + $hdata['regeneration'] * 5 * $speed / 86400 * (time() - $hdata['lastupdate']);

                return ($reg <= 100) ? $reg : 100;
            }
        }
        return -1;
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
        for ($i = $herolevel + 1; $i < 100; $i++){
            if($hdata['experience'] >= $hero_levels[$i]){
                $newLevel = $i;
                if ($i < 99) $scorePoints = true;
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
