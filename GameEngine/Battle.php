<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Battle.php                      	                       ##
##  Type           : Battle System Backend                                     ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki & Dixie  			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################


class Battle {

	/*****************************************
	Function sigma
	*****************************************/
    
	private function sigma($x) {
    return ($x > 1 ? 2 - pow($x, -1.5) : pow($x, 1.5)) / 2;
	}
		
	/*****************************************
	Function to proc Simulation
	*****************************************/
        
	public function procSim($post) {
    global $form;

    /******************************************************************
     * BASIC VALIDATION
     ******************************************************************/
    if (
        empty($post['a1_v']) ||
        !(
            isset($post['a2_v1']) ||
            isset($post['a2_v2']) ||
            isset($post['a2_v3']) ||
            isset($post['a2_v4']) ||
            isset($post['a2_v5']) ||
            isset($post['a2_v6']) ||
            isset($post['a2_v7']) ||
            isset($post['a2_v8']) ||
            isset($post['a2_v9'])
        )
    ) {
        return;
    }

    // [Phase 3] a1_v intra in aritmetica de sloturi ((trib-1)*10+1) din simulate();
    // in afara 1..9 producea chei u<negative>/inexistente. Invalid => iesire,
    // exact ca celelalte validari de mai sus. (Schimbare de comportament DOAR
    // pentru input invalid.)
    if ((int)$post['a1_v'] < 1 || (int)$post['a1_v'] > 9) {
        return;
    }

    $_POST['mytribe'] = $post['a1_v'];

    /******************************************************************
     * TARGET BUILD
     ******************************************************************/
    $target = [];
    for ($i = 1; $i <= 9; $i++) {
        if (!empty($post['a2_v'.$i])) {
            $target[] = $i;
        }
    }
    $_POST['target'] = $target;
    if (empty($target)) {
        return;
    }

    /******************************************************************
     * HERO BONUS LIMITS (OFF / DEF)
     ******************************************************************/
    $post['h_off_bonus'] = isset($post['h_off_bonus'])
        ? min(20, (int)$post['h_off_bonus'])
        : 0;
    $post['h_def_bonus'] = isset($post['h_def_bonus'])
        ? min(20, (int)$post['h_def_bonus'])
        : 0;

    /******************************************************************
     * UNIT SUM CHECK
     ******************************************************************/
    $sum = 0;
    for ($i = 1; $i <= 10; $i++) {
        $sum += isset($post['a1_'.$i]) ? (int)$post['a1_'.$i] : 0;
    }
    if ($sum <= 0) {
        return;
    }

    /******************************************************************
     * PALACE LIMIT
     ******************************************************************/
    $post['palast'] = isset($post['palast'])
        ? min(20, (int)$post['palast'])
        : 0;

    /******************************************************************
     * WALL LEVELS (OPTIMIZED LOOP)
     ******************************************************************/
    $post['walllevel'] = 0;
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($post['wall'.$i])) {
            continue;
        }
        $wall = (int)$post['wall'.$i];
        if ($wall > 20) {
            $wall = 20;
        } elseif ($wall < 0) {
            $wall = 0;
        }
        $post['wall'.$i] = $wall;
        $post['walllevel'] = $wall;
    }

    /******************************************************************
     * SIMULATION CALL
     ******************************************************************/
    $post['tribe'] = $target[0];
    $_POST['result'] = $this->simulate($post);
	$newWallLevel = $_POST['result'][7]?? 0;
	$oldWallLevel = $_POST['result'][8]?? 0;

    /******************************************************************
     * WALL CHANGE RE-SIMULATION
     ******************************************************************/
    if ($newWallLevel != $oldWallLevel) {
        $post['walllevel'] = $newWallLevel;
        $_POST['result'] = $this->simulate($post);
		
        // restore original expected output
		
        $_POST['result'][7] = $newWallLevel;
        $_POST['result'][8] = $oldWallLevel;
        $post['walllevel'] = $oldWallLevel;
    }
    $form->valuearray = $post;
}
		
	/*****************************************
	Function to battle Hero
	*****************************************/
		
	private function getBattleHero($uid) {

    global $database;
    $heroarray = $database->getHero($uid);
    if (empty($heroarray) || empty($heroarray[0])) {
        // ob/db sunt MULTIPLICATORI: 0 ar anula toata puterea armatei ($ap *= ob).
        // Un erou lipsa/invalid trebuie sa fie neutru, nu catastrofal.
        return [
            'heroid' => 0,
            'unit'   => '',
            'atk'    => 0,
            'di'     => 0,
            'dc'     => 0,
            'ob'     => 1,
            'db'     => 1,
            'health' => 0
        ];
    }

    $hero = $heroarray[0];
    $heroUnit = $hero['unit'];
    if (!isset($GLOBALS['h'.$heroUnit])) {

        // ob/db sunt MULTIPLICATORI: 0 ar anula toata puterea armatei ($ap *= ob).
        // Un erou lipsa/invalid trebuie sa fie neutru, nu catastrofal.
        return [
            'heroid' => 0,
            'unit'   => '',
            'atk'    => 0,
            'di'     => 0,
            'dc'     => 0,
            'ob'     => 1,
            'db'     => 1,
            'health' => 0
        ];
    }

    $herodata = $GLOBALS['h'.$heroUnit];
    $attack = (int)$hero['attack'];
    $defence = (int)$hero['defence'];
    $attackBonus = (int)$hero['attackbonus'];
    $defenceBonus = (int)$hero['defencebonus'];
    $h_atk = $herodata['atk']
        + ($attack * $herodata['atkp']);
    $h_di = $herodata['di']
        + 5 * floor(($defence * $herodata['dip']) / 5);
    $h_dc = $herodata['dc']
        + 5 * floor(($defence * $herodata['dcp']) / 5);
    $h_ob = 1 + (0.010 * ($attackBonus / 5));
    $h_db = 1 + (0.010 * ($defenceBonus / 5));

    // T4 hero port (Phase 5): flat fighting strength from equipped items
    // (weapons/cuirasses/shields) counts on whichever side the hero fights.
    // No-ops to 0 when NEW_FUNCTIONS_HERO_T4 is off.
    $itemStrength = HeroBattleBonus::statBonus($uid);
    if ($itemStrength > 0) {
        $h_atk += $itemStrength;
        $h_di  += $itemStrength;
        $h_dc  += $itemStrength;
    }

    return [
        'heroid' => (int)$hero['heroid'],
        'unit'   => $heroUnit,
        'atk'    => $h_atk,
        'di'     => $h_di,
        'dc'     => $h_dc,
        'ob'     => $h_ob,
        'db'     => $h_db,
        // T4 hero port: carried along for the offense/defense/damage hooks.
        'uid'    => (int)$uid,
        'health' => isset($hero['health'])
            ? (int)$hero['health']
            : 0
    ];
}

	/*****************************************
	Function to battle Hero Sim
	*****************************************/

	private function getBattleHeroSim($attbonus) {
		
    $h_ob = 1 + (0.010 * (float)$attbonus);
    return [
        'unit' => 16,
        'atk'  => 0,
        'ob'   => $h_ob
    ];
}

	/*****************************************
	Function to Simulation
	*****************************************/

	private function simulate($post) {

    /******************************************************************
     * INPUT PARSING (Phase 3)
     * Toate cheile din $post se citesc O SINGURA DATA aici, cu ?? si
     * cast (int) + clamp de interval. Pentru valori VALIDE rezultatul
     * este identic cu originalul (verificat cu harness-ul de
     * echivalenta); clamp-urile schimba comportamentul doar pe input
     * invalid — fiecare e semnalat individual mai jos.
     ******************************************************************/
    $attTribe = (int)$post['a1_v'];   // validat 1..9 in procSim()

    // [Phase 3] era (int)$post['h_off'], fara ?? (notice pe cheie lipsa)
    // si fara podea; forta negativa de erou n-are sens
    $hero_strenght = max(0, (int)($post['h_off'] ?? 0));

    // [Phase 3] procSim() taia doar plafonul (min 20); adaugata si podeaua 0
    $offhero  = max(0, min(20, (int)($post['h_off_bonus'] ?? 0)));
    $deffhero = max(0, min(20, (int)($post['h_def_bonus'] ?? 0)));
    $palast   = max(0, min(20, (int)($post['palast'] ?? 0)));

    // procSim() garanteaza deja 0..20 pe fluxul normal; clamp-ul e doar plasa
    $walllevel = max(0, min(20, (int)($post['walllevel'] ?? 0)));
    $wall      = $walllevel;

    $deftribe = (int)($post['tribe'] ?? 0);   // setat de procSim() = $target[0]

    // [Phase 3] era !empty($post['kata']) ? (int)$post['kata'] : 0, fara plafon;
    // e nivelul cladirii-tinta pentru catapulte (WW poate ajunge la 100)
    $kata = max(0, min(100, (int)($post['kata'] ?? 0)));

    // [Phase 3] era $post['stonemason'] pasat brut; nivelul valid e 0..20
    // (indexeaza $bid34; peste 20 dadea undefined index + durability nula)
    $stonemason = max(0, min(20, (int)($post['stonemason'] ?? 0)));

    // [Phase 3] erau pasate brute ca attpop/defpop; negative n-au sens in morala
    $ew1 = max(0, (int)($post['ew1'] ?? 0));
    $ew2 = max(0, (int)($post['ew2'] ?? 0));

    // [Phase 3] era $post['ktyp'] + 3 brut; doar 0 (=> tip 3, atac normal)
    // sau 1 (=> tip 4, raid) sunt valori valide
    $ktyp = ((int)($post['ktyp'] ?? 0) === 1) ? 1 : 0;

    /******************************************************************
     * ATTACKER INIT (KEEP LEGACY STRUCTURE)
     ******************************************************************/
    $attacker = [];

    for ($i = 1; $i <= 90; $i++) {
        $attacker['u'.$i] = 0;
    }

    $start = ($attTribe - 1) * 10 + 1;

    /******************************************************************
     * ATTACKER UNITS + ATTACK BONUSES
     * [Phase 3] ${'att_ab'.$index} (variabile dinamice) -> array $att_ab,
     * conform conventiei proiectului; valorile raman identice
     ******************************************************************/
    $att_ab = array_fill(1, 8, 0);

    for ($i = $start, $index = 1; $i <= $start + 9; $i++, $index++) {

        $attacker['u'.$i] = !empty($post['a1_'.$index])
            ? (int)$post['a1_'.$index]
            : 0;

        if ($index <= 8 && !empty($post['f1_'.$index])) {
            $att_ab[$index] = (int)$post['f1_'.$index];
        }
    }

    /******************************************************************
     * DEFENDER INIT
     ******************************************************************/
    $defender = [];
    $def_ab   = [];
    $defscout = 0;

    for ($i = 1; $i <= 90; $i++) {
        $units = (int)($post['a2_'.$i] ?? 0);
        $ab    = (int)($post['f2_'.$i] ?? 0);

        $defender['u'.$i] = $units;
        $def_ab[$i]       = $units > 0 ? $ab : 0;

        if ($units > 0 && in_array($i, [4, 14, 23, 44, 52, 64, 74, 82])) {
            $defscout += $units;
        }
    }

    /******************************************************************
     * SCOUT CHECK 
     ******************************************************************/
    $scout = 1;

    for ($i = $start; $i <= $start + 9; $i++) {

        if (in_array($i, [4, 14, 23, 44, 52, 64, 74, 82])) {
            continue;
        }

        if ($attacker['u'.$i] > 0) {
            $scout = 0;
            break;
        }
    }

    /******************************************************************
     * WALL / PALAST RULES 
     ******************************************************************/
    if ($scout == 1 && $defscout == 0) {
        $walllevel = 0;
        $wall = 0;
        $palast = 0;
    }

    if ($scout == 1) {
        $palast = 0;
    }

    /******************************************************************
     * FINAL CALL
     * [Phase 3] cele doua apeluri aproape identice au fost unificate;
     * difereau doar prin tip (1 vs ktyp+3) si prin zero-urile de erou
     * de pe ramura de spionaj
     ******************************************************************/
    return $this->calculateBattle(
        $attacker,
        $defender,
        $wall,
        $attTribe,
        $deftribe,
        $palast,
        $ew1,
        $ew2,
        $scout ? 1 : $ktyp + 3,
        $def_ab,
        $att_ab[1], $att_ab[2], $att_ab[3], $att_ab[4],
        $att_ab[5], $att_ab[6], $att_ab[7], $att_ab[8],
        $kata,
        $stonemason,
        $walllevel,
        $scout ? 0 : $offhero,
        $scout ? 0 : $hero_strenght,
        $scout ? 0 : $deffhero,
        0, 0, 0, 0, 0
    );
}
		
	/*****************************************
	Function for Type Level
	*****************************************/

	public function getTypeLevel($tid, $vid) {

    global $village, $database;
    $resourcearray = $database->getResourceLevel($vid);
    if (empty($resourcearray)) {
        return 0;
    }
    $keyholder = [];

    /******************************************************************
     * FIND BUILDINGS OF REQUESTED TYPE
     ******************************************************************/
    foreach ($resourcearray as $key => $value) {

        // The building TYPE is stored in the 'f<n>t' columns of fdata (e.g. the
        // Brewery on slot 20 is 'f20t' == 35); the matching level lives in 'f<n>'.
        // Match on the 't' SUFFIX, not the first character — a previous rewrite
        // tested $key[0] === 't', which never matched 'f<n>t' and made this
        // return 0 for every building (issue #294: Brewery bonus never applied).
        // Mirrors Building::getTypeLevel()/Automation::getTypeLevel().
        if (
            isset($value)
            && $value == $tid
            && strpos($key, 't') !== false
        ) {

            $keyholder[] = (int)preg_replace('/[^0-9]/', '', $key);
        }
    }
    $element = count($keyholder);
    if ($element === 0) {
        return 0;
    }
    if ($element === 1) {
        $field = 'f'.$keyholder[0];
        return isset($resourcearray[$field])
            ? (int)$resourcearray[$field]
            : 0;
    }

    /******************************************************************
     * FIND HIGHEST LEVEL
     ******************************************************************/
    $targetKey = $keyholder[0];
    $targetLevel = isset($resourcearray['f'.$targetKey])
        ? (int)$resourcearray['f'.$targetKey]
        : 0;

    // preserve original behavior separation for resource fields
    if ($tid <= 4) {
        foreach ($keyholder as $fieldId) {
            $fieldLevel = isset($resourcearray['f'.$fieldId])
                ? (int)$resourcearray['f'.$fieldId]
                : 0;

            // preserve original "last max wins" behavior
            if ($fieldLevel >= $targetLevel) {
                $targetLevel = $fieldLevel;
                $targetKey = $fieldId;
            }
        }
    } else {
        foreach ($keyholder as $fieldId) {
            $fieldLevel = isset($resourcearray['f'.$fieldId])
                ? (int)$resourcearray['f'.$fieldId]
                : 0;
            if ($fieldLevel > $targetLevel) {
                $targetLevel = $fieldLevel;
                $targetKey = $fieldId;
            }
        }
    }
    return $targetLevel;
}
	
	/*****************************************
	Function to process Calculate Battle
	(Phase 2: orchestrator — fiecare sectiune
	a devenit un helper privat, mai jos)
	*****************************************/

	function calculateBattle(
		$Attacker, $Defender,
		$def_wall, $att_tribe, $def_tribe,
		$residence, $attpop, $defpop,
		$type,
		$def_ab,
		$att_ab1, $att_ab2, $att_ab3, $att_ab4, $att_ab5, $att_ab6, $att_ab7, $att_ab8,
		$tblevel, $stonemason, $walllevel,
		$offhero, $hero_strenght, $deffhero,
		$AttackerID, $DefenderID,
		$AttackerWref, $DefenderWref,
		$conqureby,
		$defReinforcements = null) {
			
    global $database, $unitsbytype;

    /******************************************************************
     * UNIT GROUP DEFINITIONS
     ******************************************************************/
    $calvaryLookup  = array_flip($unitsbytype['cavalry']);
    $catapultLookup = array_flip($unitsbytype['catapult']);
    $ramsLookup     = array_flip($unitsbytype['ram']);

    /******************************************************************
     * BASE VARIABLES
     ******************************************************************/
    $result = [];
    $units  = [];

    $attAb = [
        1 => $att_ab1, 2 => $att_ab2, 3 => $att_ab3, 4 => $att_ab4,
        5 => $att_ab5, 6 => $att_ab6, 7 => $att_ab7, 8 => $att_ab8
    ];

    /******************************************************************
     * ARTIFACTS (GLOBAL EFFECTS)
     ******************************************************************/
    $attacker_artefact = $database->getArtifactsValueInfluence($AttackerID, $AttackerWref, 3, 1, false);
    $defender_artefact = $database->getArtifactsValueInfluence($DefenderID, $DefenderWref, 3, 1, false);
    $strongerbuildings = $database->getArtifactsValueInfluence($DefenderID, $DefenderWref, 1, 1, false);

    $isWWVillage = $database->getVillageField($DefenderWref, 'natar');

    /******************************************************************
     * HERO LOADING (ATTACKER / DEFENDER)
     ******************************************************************/
    $atkhero = null;
    $defenderhero = null;

    if (!empty($Attacker['uhero'])) {
        $atkhero = $this->getBattleHero($AttackerID);
    }

    if (!empty($Defender['hero'])) {
        $defenderhero = $this->getBattleHero($DefenderID);
    }

    /******************************************************************
     * DEFENDER FORCES (BASE + REINFORCEMENTS) — citeste DB, nu scrie
     ******************************************************************/
    $defForces = $this->computeDefenderForces(
        $Defender, $def_ab, $type,
        $defender_artefact, $defenderhero,
        $DefenderWref, $defReinforcements
    );

    $dp       = $defForces['dp'];
    $cdp      = $defForces['cdp'];
    $involve  = $defForces['involve'];
    $detected = $defForces['detected'];

    if ($defForces['def_hero_unit'] !== null) {
        $units['Def_unit']['hero'] = $defForces['def_hero_unit'];
    }

    $DefendersAll = $defForces['DefendersAll'];

    /******************************************************************
     * ATTACKER FORCES (AP/CAP/CATP/RAM + HERO OFFENSE)
     ******************************************************************/
    $start = ($att_tribe - 1) * 10 + 1;
    $end   = $att_tribe * 10;

    $attForces = $this->computeAttackerForces(
        $Attacker, $att_tribe, $type, $attAb,
        $attacker_artefact, $atkhero,
        $offhero, $hero_strenght, $deffhero,
        $DefenderID,
        $calvaryLookup, $catapultLookup, $ramsLookup,
        $dp, $cdp
    );

    $ap   = $attForces['ap'];
    $cap  = $attForces['cap'];
    $catp = $attForces['catp'];
    $ram  = $attForces['ram'];

    // bonusurile de erou din simulator (deffhero) multiplica apararea,
    // de aceea dp/cdp trec prin computeAttackerForces() si se intorc aici
    $dp  = $attForces['dp'];
    $cdp = $attForces['cdp'];

    $involve += $attForces['involve'];

    if (!empty($attForces['att_units'])) {
        $units['Att_unit'] = $attForces['att_units'];
    }

    /******************************************************************
     * WALL + RESIDENCE
     ******************************************************************/
    $walled = $this->applyWallAndResidence($dp, $cdp, $def_wall, $def_tribe, $residence, $type);

    $dp  = $walled['dp'];
    $cdp = $walled['cdp'];

    /******************************************************************
     * ATTACK / DEFENSE TOTAL
     ******************************************************************/
    $bonus = $this->computeBreweryAttackBonus($AttackerID, $att_tribe);

    $points = $this->computeTotalPoints($ap, $cap, $dp, $cdp, $bonus);

    $rap = $points['rap'];
    $rdp = $points['rdp'];

    $result['Attack_points'] = $rap;
    $result['Defend_points'] = $rdp;

    $winner = ($rap > $rdp);

    $safeRap = max(1, (float)$rap);
    $safeRdp = max(1, (float)$rdp);

    /******************************************************************
     * MORALE + M FACTOR
     ******************************************************************/
    $moralbonus = $this->computeMorale($attpop, $defpop, $isWWVillage, $rap, $rdp);
    $Mfactor    = $this->computeMfactor($involve, $type);

    /******************************************************************
     * LOSSES (tip 1/3/4 — izoleaza singurul rand() din fisier)
     ******************************************************************/
    $losses = $this->computeLossRatios(
        $type, $winner, $att_tribe, $detected, $Attacker,
        $rap, $rdp, $safeRap, $safeRdp,
        $moralbonus, $Mfactor,
        $ram, $catp
    );

    foreach ($losses['result'] as $key => $value) {
        $result[$key] = $value;
    }

    $winner = $losses['winner'];
    $ram    = $losses['ram'];
    $catp   = $losses['catp'];

    /******************************************************************
     * CATAPULTS DAMAGE
     ******************************************************************/
    $catapultResult = $this->applyCatapultDamage(
        $catp, $tblevel, $att_ab8, $stonemason,
        $safeRap, $safeRdp, $attpop, $defpop, $strongerbuildings
    );

    foreach ($catapultResult as $key => $value) {
        $result[$key] = $value;
    }

    /******************************************************************
     * RAMS DAMAGE
     ******************************************************************/
    $ramResult = $this->applyRamDamage(
        $ram, $walllevel, $att_ab7, $stonemason,
        $safeRap, $safeRdp, $strongerbuildings
    );

    foreach ($ramResult as $key => $value) {
        $result[$key] = $value;
    }

    /******************************************************************
     * FINAL MORALE FACTOR
     ******************************************************************/
    $result[6] = pow(
        $safeRap / max($safeRdp * $moralbonus, 1),
        $Mfactor
    );

    $result['moralBonus'] = $moralbonus;

    /******************************************************************
     * CASUALTIES
     ******************************************************************/
    // NOTA: pentru tipurile fara ramura de pierderi (ex. 2/5) originalul
    // citea $result[1] nedefinit (notice per iteratie, valoare 0);
    // isset-ul de aici pastreaza valoarea (0) fara notice-uri
    $result['casualties_attacker'] = $this->computeCasualties(
        isset($result[1]) ? $result[1] : 0,
        isset($units['Att_unit']) ? $units['Att_unit'] : [],
        $start,
        $end
    );

    /******************************************************************
     * HERO DAMAGE (ATTACKER)
     ******************************************************************/
    if (!empty($units['Att_unit']['hero']) && !empty($atkhero['heroid'])) {

        $dead = $this->applyHeroBattleDamage(
            $atkhero['heroid'],
            $result[1],
            // T4 hero port (Phase 5): doar eroul ATACATOR beneficiaza de
            // reducerea de daune din armuri (comportament original pastrat)
            $atkhero['uid'] ?? 0
        );

        if ($dead === 1) {
            $result['casualties_attacker'][11] = 1;
        }
    }

    /******************************************************************
     * HERO DAMAGE (DEFENDER)
     ******************************************************************/
    if (!empty($units['Def_unit']['hero']) && !empty($defenderhero['heroid'])) {

        $dead = $this->applyHeroBattleDamage($defenderhero['heroid'], $result[2]);

        if ($dead !== null) {
            $result['deadherodef'] = $dead;
        }
    }

    /******************************************************************
     * HERO DAMAGE (DEFENDER + REINFORCEMENTS)
     ******************************************************************/
    if (!empty($DefendersAll)) {

        $battleHeroesCache = [];
        $villageOwnerCache = [];

        foreach ($DefendersAll as $defenders) {

            if (empty($defenders['hero'])) {
                continue;
            }

            $fromVillage = (int)$defenders['from'];

            if (!isset($villageOwnerCache[$fromVillage])) {
                $villageOwnerCache[$fromVillage] = (int)$database->getVillageField($fromVillage, "owner");
            }

            $owner = $villageOwnerCache[$fromVillage];

            if (!isset($battleHeroesCache[$owner])) {
                $battleHeroesCache[$owner] = $this->getBattleHero($owner);
            }

            $heroarraydefender = $battleHeroesCache[$owner];

            if (empty($heroarraydefender['heroid'])) {
                continue;
            }

            $dead = $this->applyHeroBattleDamage($heroarraydefender['heroid'], $result[2]);

            if ($dead !== null) {
                $result['deadheroref'][$defenders['id']] = $dead;
            }
        }
    }

    /******************************************************************
     * BOUNTY CALCULATION
     ******************************************************************/
    $result['bounty'] = $this->computeBounty(
        $Attacker,
        $result['casualties_attacker'],
        $att_tribe,
        $start,
        $end
    );

    return $result;
}

	/*****************************************
	Phase 2 helper: apararea de baza +
	intaririle (citeste DB, nu scrie nimic)
	*****************************************/

	private function computeDefenderForces(
    $Defender, $def_ab, $type,
    $defender_artefact, $defenderhero,
    $DefenderWref, $defReinforcements
) {

    global $database;

    $dp = 0;
    $cdp = 0;
    $involve = 0;
    $detected = false;
    $defHeroUnit = null;

    /******************************************************************
     * DEFENDER BASE FORCES
     ******************************************************************/
    if ($type == 1) {

        $datadefScout = $this->getDataDefScout($Defender, $def_ab, $defender_artefact);

        $dp      += $datadefScout['dp'];
        $cdp     += $datadefScout['cdp'];
        $involve += $datadefScout['involve'];

        if (!$detected && $datadefScout['detect']) {
            $detected = $datadefScout['detect'];
        }

    } else {

        $datadef = $this->getDataDef($Defender, $def_ab);

        $own_dp  = $datadef['dp'];
        $own_cdp = $datadef['cdp'];

        $involve += $datadef['involve'];

        if (isset($Defender['hero']) && $Defender['hero'] != 0) {

            $defHeroUnit = $Defender['hero'];

            $own_cdp += $defenderhero['dc'];
            $own_dp += $defenderhero['di'];

            // T4 hero port (Phase 5): weapon adds +N defense per unit of
            // its type in the defending army, counted in both pools
            // (see HeroBattleBonus::unitDefense). No-op when flag is off.
            $itemDef = HeroBattleBonus::unitDefense($defenderhero['uid'] ?? 0, $Defender);
            $own_dp  += $itemDef;
            $own_cdp += $itemDef;

            $own_dp *= $defenderhero['db'];
            $own_cdp *= $defenderhero['db'];
        }

        $dp += $own_dp;
        $cdp += $own_cdp;
    }

    /******************************************************************
     * REINFORCEMENTS
     ******************************************************************/
    $DefendersAll = ($defReinforcements === null)
        ? $database->getEnforceVillage($DefenderWref, 0)
        : $defReinforcements;

    if (!empty($DefendersAll) && $DefenderWref > 0) {

        $ownerCache = [];
        $userCache  = [];
        $abCache    = [];
        $heroCache  = [];

        foreach ($DefendersAll as $defenders) {

            $fromvillage = (int)$defenders['from'];

            if ($fromvillage <= 0) {
                continue;
            }

            if (!isset($ownerCache[$fromvillage])) {
                $ownerCache[$fromvillage] = (int)$database->getVillageField($fromvillage, "owner");
            }

            $owner = $ownerCache[$fromvillage];

            if (!isset($userCache[$owner])) {
                $userCache[$owner] = $database->getUserArray($owner, 1);
            }

            $enforcetribe = (int)$userCache[$owner]["tribe"];
            $ud = ($enforcetribe - 1) * 10;

            if (!isset($abCache[$fromvillage])) {
                $abCache[$fromvillage] = $database->getABTech($fromvillage);
            }

            $armory = $abCache[$fromvillage];

            for ($i = 1; $i <= 8; $i++) {
                $def_ab[$ud + $i] = isset($armory['a'.$i]) ? $armory['a'.$i] : 0;
            }

            if ($type == 1) {

                $datadefScout = $this->getDataDefScout($defenders, $def_ab, $defender_artefact);

                $dp  += $datadefScout['dp'];
                $cdp += $datadefScout['cdp'];

                $involve += $datadefScout['involve'];

                if (!$detected && $datadefScout['detect']) {
                    $detected = $datadefScout['detect'];
                }

            } else {

                $datadef = $this->getDataDef($defenders, $def_ab);

                $reinf_dp  = $datadef['dp'];
                $reinf_cdp = $datadef['cdp'];

                $involve += $datadef['involve'];

                if (!empty($defenders['hero'])) {

                    if (!isset($heroCache[$owner])) {
                        $heroCache[$owner] = $this->getBattleHero($owner);
                    }

                    $defhero = $heroCache[$owner];

                    $reinf_dp  += $defhero['di'];
                    $reinf_cdp += $defhero['dc'];

                    $reinf_dp  *= $defhero['db'];
                    $reinf_cdp *= $defhero['db'];
                }

                $dp  += $reinf_dp;
                $cdp += $reinf_cdp;
            }
        }
    }

    return [
        'dp'            => $dp,
        'cdp'           => $cdp,
        'involve'       => $involve,
        'detected'      => $detected,
        'def_hero_unit' => $defHeroUnit,
        'DefendersAll'  => $DefendersAll
    ];
}

	/*****************************************
	Phase 2 helper: fortele atacatorului
	(ap/cap/catp/ram + ofensiva eroului)
	*****************************************/

	private function computeAttackerForces(
    $Attacker, $att_tribe, $type, $attAb,
    $attacker_artefact, $atkhero,
    $offhero, $hero_strenght, $deffhero,
    $DefenderID,
    $calvaryLookup, $catapultLookup, $ramsLookup,
    $dp, $cdp
) {

    global $unitsbytype;

    $start = ($att_tribe - 1) * 10 + 1;
    $end   = $att_tribe * 10;

    $ap = 0;
    $cap = 0;
    $catp = 0;
    $ram = 0;
    $involve = 0;
    $attUnits = [];

    if ($type == 1) {

        // era: $abcount = ($att_tribe == 3) ? 3 : 4; $scoutAB = ${'att_ab'.$abcount};
        // (galii au cercetasul pe slotul 3, restul triburilor pe slotul 4)
        $scoutAB = ($att_tribe == 3) ? $attAb[3] : $attAb[4];

        for ($i = $start; $i <= $end; $i++) {

            $unitAmount = (int)$Attacker['u'.$i];

            if ($unitAmount <= 0) {
                continue;
            }

            global ${'u'.$i};

            if (in_array($i, $unitsbytype['scout'])) {

                if ($scoutAB > 0) {

                    $unitAttack = round(
                        35 + (
                            35 + (300 * ${'u'.$i}['pop'] / 7)
                        ) * (pow(1.007, $scoutAB) - 1),
                        4
                    );

                    $ap += $unitAttack * $unitAmount;

                } else {
                    $ap += 35 * $unitAmount;
                }
            }

            $involve += $unitAmount;
            $attUnits[$i] = $unitAmount;
        }

        // NOTA: artefactul ofensiv al atacatorului se aplica DOAR pe ramura
        // de spionaj (tip 1), nu si la atacurile normale — comportament
        // original pastrat 1:1; de verificat separat daca e intentionat
        $ap *= $attacker_artefact;

    } else {

        $abcount = 1;

        for ($i = $start; $i <= $end; $i++) {

            $unitAmount = (int)$Attacker['u'.$i];

            if ($unitAmount <= 0) {
                $abcount++;
                continue;
            }

            global ${'u'.$i};

            $unitData = ${'u'.$i};
            $unitAttack = $unitData['atk'];

            if ($abcount <= 8 && $attAb[$abcount] > 0) {

                $unitAttack = round(
                    $unitAttack + (
                        $unitAttack + (300 * $unitData['pop'] / 7)
                    ) * (pow(1.007, $attAb[$abcount]) - 1),
                    4
                );
            }

            $totalAttack = $unitAttack * $unitAmount;

            if (isset($calvaryLookup[$i])) {
                $cap += $totalAttack;
            } else {
                $ap += $totalAttack;
            }

            if (isset($catapultLookup[$i])) {
                $catp += $unitAmount;
            }

            if (isset($ramsLookup[$i])) {
                $ram += $unitAmount;
            }

            $involve += $unitAmount;
            $attUnits[$i] = $unitAmount;

            $abcount++;
        }

        /******************************************************************
         * HERO OFFENSE
         ******************************************************************/
        if (!empty($Attacker['uhero']) && !empty($atkhero)) {

            $attUnits['hero'] = $Attacker['uhero'];

            $heroOb = (!empty($atkhero['ob']) && $atkhero['ob'] > 0) ? $atkhero['ob'] : 1;
            $ap  *= $heroOb;
            $cap *= $heroOb;

            // T4 hero port (Phase 5): hunting horn boosts the HERO's own
            // contribution vs the Natars (uid 3); weapon adds +N attack per
            // accompanying unit of its type. Neutral no-ops when the flag is off.
            $ap += $atkhero['atk'] * HeroBattleBonus::natarMultiplier($atkhero['uid'] ?? 0, $DefenderID);

            list($itemAp, $itemCap) = HeroBattleBonus::unitOffense($atkhero['uid'] ?? 0, $Attacker, $calvaryLookup);
            $ap  += $itemAp;
            $cap += $itemCap;
        }

        if ($offhero > 0 || $hero_strenght > 0) {

            $simHero = $this->getBattleHeroSim($offhero);

            $ap  *= $simHero['ob'];
            $cap *= $simHero['ob'];

            $ap += $hero_strenght;
        }

        if ($deffhero > 0) {

            $dfdhero = $this->getBattleHeroSim($deffhero);

            $dp  *= $dfdhero['ob'];
            $cdp *= $dfdhero['ob'];
        }
    }

    return [
        'ap'        => $ap,
        'cap'       => $cap,
        'catp'      => $catp,
        'ram'       => $ram,
        'involve'   => $involve,
        'att_units' => $attUnits,
        'dp'        => $dp,
        'cdp'       => $cdp
    ];
}

	/*****************************************
	Phase 2 helper: zid + resedinta (pur)
	*****************************************/

	private function applyWallAndResidence($dp, $cdp, $def_wall, $def_tribe, $residence, $type) {

    $residenceBonus = (2 * ($residence * $residence)) + 10;

    if ($def_wall > 0) {

        // Factori de zid per trib: 1 City Wall, 2 Earth Wall, 3 Palisade,
        // 6 Makeshift Wall, 7 Stone Wall, 8 Defensive Wall, 9 Barricade
        $wallFactors = array(1 => 1.030, 2 => 1.020, 3 => 1.025, 6 => 1.015, 7 => 1.030, 8 => 1.028, 9 => 1.022);
        $factor = isset($wallFactors[$def_tribe]) ? $wallFactors[$def_tribe] : 1.025;

        $wallMultiplier = round(pow($factor, $def_wall), 3);

        if ($dp > 0 || $cdp > 0) {

            if ($type == 1) {

                $dp *= $wallMultiplier;
                $dp += 10;

            } else {

                $dp  *= $wallMultiplier;
                $cdp *= $wallMultiplier;

                $resBonus = $residenceBonus * $wallMultiplier;

                $dp  += $resBonus;
                $cdp += $resBonus;
            }

        } else {

            $baseWall = 10 * $wallMultiplier * $def_wall;

            $dp  = $baseWall;
            $cdp = $baseWall;

            if ($type != 1) {

                $resBonus = $residenceBonus * $wallMultiplier;

                $dp  += $resBonus;
                $cdp += $resBonus;

            } else {

                $dp += 10;
                $cdp = 0;
            }
        }

    } elseif ($type != 1) {

        $dp  += $residenceBonus;
        $cdp += $residenceBonus;
    }

    return ['dp' => $dp, 'cdp' => $cdp];
}

	/*****************************************
	Phase 2 helper: bonusul de atac Brewery
	(citeste DB; extras ca sa ramana
	computeTotalPoints() pur — vezi tabelul
	de mapare din livrare)
	*****************************************/

	private function computeBreweryAttackBonus($AttackerID, $att_tribe) {

    global $bid35, $database;

    $bonus = 0;

    // Brewery (35) Mead-Festival attack bonus: Teuton-only, capital-only but
    // empire-wide, and active ONLY while a festival is running (72h). It must be
    // read from the attacker's CAPITAL — $AttackerWref is the launching village,
    // which usually has no Brewery — and gated on the festival being active,
    // otherwise the bonus is permanent and never reacts to the festival being
    // started/expired (issue #294). This mirrors the catapult-randomization gate
    // in Units.php and the chief-penalty gate in Automation.php. The simulator
    // passes AttackerID = 0, so it keeps a 0 bonus exactly as before.
    if ($AttackerID != 0 && $att_tribe == 2) {

        $attackerCapital = $database->getVillage($AttackerID, 3);

        if ($attackerCapital && (int)$attackerCapital['festival'] > time()) {

            $typeLevel = $this->getTypeLevel(35, $attackerCapital['wref']);

            $bonus = isset($bid35[$typeLevel])
                ? $bid35[$typeLevel]['attri']
                : 0;
        }
    }

    return $bonus;
}

	/*****************************************
	Phase 2 helper: rap/rdp (pur)
	*****************************************/

	private function computeTotalPoints($ap, $cap, $dp, $cdp, $bonus) {

    $rap = round(
        ($ap + $cap) + (
            (($ap + $cap) / 100) * $bonus
        )
    );

    if ($rap == 0) {

        $rdp = round($dp + $cdp);

    } else {

        $rdp = round(
            (round($cap / $rap, 4) * $cdp) +
            (round($ap / $rap, 4) * $dp)
        );
    }

    return ['rap' => $rap, 'rdp' => $rdp];
}

	/*****************************************
	Phase 2 helper: morala (pur)
	*****************************************/

	private function computeMorale($attpop, $defpop, $isWWVillage, $rap, $rdp) {

    if ($attpop > $defpop && !$isWWVillage) {

        $moralbonus = 1 / round(
            max(
                0.667,
                pow(
                    $defpop / $attpop,
                    0.2 * min(1, $rap / max($rdp, 1))
                )
            ),
            3
        );

    } else {

        $moralbonus = 1.0;
    }

    return $moralbonus;
}

	/*****************************************
	Phase 2 helper: factorul M (pur)
	*****************************************/

	private function computeMfactor($involve, $type) {

    if ($involve >= 1000 && $type != 1) {
        $Mfactor = 2 * round((1.8592 - pow($involve, 0.015)), 4);
    } else {
        $Mfactor = 1.5;
    }

    if ($Mfactor < 1.2578) {
        $Mfactor = 1.2578;
    } elseif ($Mfactor > 1.5) {
        $Mfactor = 1.5;
    }

    return $Mfactor;
}

	/*****************************************
	Phase 2 helper: ratele de pierderi pentru
	tipurile 1/3/4 — izoleaza singurul rand()
	din fisier (hero_fealthy); pentru alte
	tipuri nu seteaza cheile 1/2, exact ca
	originalul
	*****************************************/

	private function computeLossRatios(
    $type, $winner, $att_tribe, $detected, $Attacker,
    $rap, $rdp, $safeRap, $safeRdp,
    $moralbonus, $Mfactor,
    $ram, $catp
) {

    $result = [];

    if ($type == 1) {

        $holder = pow((($rdp * $moralbonus) / $safeRap), $Mfactor);

        if ($holder > 1 || $rdp > $rap) {
            $holder = 1;
        }

        $result[1] = ($att_tribe == 5 || !$detected) ? 0 : $holder;
        $result[2] = 0;

    } elseif ($type == 4) {

        $holder = ($winner)
            ? pow((($rdp * $moralbonus) / $safeRap), $Mfactor)
            : pow(($safeRap / max($safeRdp * $moralbonus, 1)), $Mfactor);

        $holder = $holder / (1 + $holder);

        $result[1] = $winner ? $holder : 1 - $holder;
        $result[2] = $winner ? 1 - $holder : $holder;

        // NOTA: $result[1] e o fractie 0..1, deci "/ 100" face scaderea
        // aproape mereu 0 (berbecii/catapultele trag cu efectivul de
        // dinainte de pierderi) — comportament original pastrat 1:1
        $ram  -= round($ram * $result[1] / 100);
        $catp -= round($catp * $result[1] / 100);

    } elseif ($type == 3) {

        $result[1] = ($winner)
            ? pow((($rdp * $moralbonus) / $safeRap), $Mfactor)
            : 1;

        if ($result[1] > 1) {

            $result[1] = 1;
            $winner = false;
            $result['Winner'] = "defender";
        }

        $result[2] = (!$winner)
            ? pow(($safeRap / max($safeRdp * $moralbonus, 1)), $Mfactor)
            : 1;

        if ($result[1] == 1) {
            $result[2] = pow(($safeRap / max($safeRdp * $moralbonus, 1)), $Mfactor);
        }

        if ($result[2] > 1) {

            $result[2] = 1;
            $winner = true;
            $result['Winner'] = "attacker";
        }

        $ku = ($att_tribe - 1) * 10 + 9;

        $kings = (int)$Attacker['u'.$ku];

        // NOTA: cast-ul (int) trunchiaza fractia la 0, deci $aviables ==
        // $kings pentru orice pierdere partiala (doar pierderea totala,
        // result[1] == 1, ii scade) — comportament original pastrat 1:1
        $aviables = $kings - round($kings * (int)$result[1]);

        if ($aviables > 0) {

            switch ($aviables) {
                case 1: $fealthy = rand(20, 30); break;
                case 2: $fealthy = rand(40, 60); break;
                case 3: $fealthy = rand(60, 80); break;
                case 4: $fealthy = rand(80, 100); break;
                default: $fealthy = 100; break;
            }

            $result['hero_fealthy'] = $fealthy;
        }

        // NOTA: acelasi "/ 100" pe fractie ca la tipul 4 — pastrat 1:1
        $ram -= ($winner)
            ? round($ram * $result[1] / 100)
            : round($ram * $result[2] / 100);

        $catp -= ($winner)
            ? round($catp * $result[1] / 100)
            : round($catp * $result[2] / 100);
    }

    return [
        'result' => $result,
        'winner' => $winner,
        'ram'    => $ram,
        'catp'   => $catp
    ];
}

	/*****************************************
	Phase 2 helper: daunele catapultelor
	asupra cladirii-tinta (determinist)
	*****************************************/

	private function applyCatapultDamage(
    $catp, $tblevel, $att_ab8, $stonemason,
    $safeRap, $safeRdp, $attpop, $defpop, $strongerbuildings
) {

    global $bid34;

    if ($catp <= 0 || $tblevel == 0) {
        return [];
    }

    $upgrades = round(200 * pow(1.0205, $att_ab8)) / 200;

    $durability = ($stonemason > 0)
        ? $bid34[$stonemason]['attri'] / 100
        : 1;

    $attackDefenseRatio = $safeRap / $safeRdp;

    $catpMoraleBonus = min(
        max(pow(($attpop / max($defpop, 1)), 0.3), 1),
        3
    );

    $catapultsDamage = $this->calculateCatapultsDamage(
        $catp,
        $upgrades,
        $durability,
        $attackDefenseRatio,
        $strongerbuildings,
        $catpMoraleBonus
    );

    return [
        3 => $this->calculateNewBuildingLevel($tblevel, $catapultsDamage),
        4 => $tblevel,
        'catapults' => [
            'upgrades' => $upgrades,
            'durability' => $durability,
            'attackDefenseRatio' => $attackDefenseRatio,
            'strongerBuildings' => $strongerbuildings,
            'moraleBonus' => $catpMoraleBonus
        ]
    ];
}

	/*****************************************
	Phase 2 helper: daunele berbecilor
	asupra zidului (determinist)
	*****************************************/

	private function applyRamDamage(
    $ram, $walllevel, $att_ab7, $stonemason,
    $safeRap, $safeRdp, $strongerbuildings
) {

    global $bid34;

    if ($ram <= 0 || $walllevel == 0) {
        return [];
    }

    $upgrades = round(200 * pow(1.0205, $att_ab7)) / 200;

    $durability = ($stonemason > 0)
        ? $bid34[$stonemason]['attri'] / 100
        : 1;

    $attackDefenseRatio = $safeRap / $safeRdp;

    $ramsDamage = $this->calculateCatapultsDamage(
        $ram,
        $upgrades,
        $durability,
        $attackDefenseRatio,
        $strongerbuildings,
        1
    );

    return [
        7 => $this->calculateNewBuildingLevel($walllevel, $ramsDamage),
        8 => $walllevel,
        'rams' => [
            'upgrades' => $upgrades,
            'durability' => $durability,
            'attackDefenseRatio' => $attackDefenseRatio,
            'strongerBuildings' => $strongerbuildings,
            'moraleBonus' => 1
        ]
    ];
}

	/*****************************************
	Phase 2 helper: pierderile atacatorului
	pe sloturile 1..10 (pur)
	*****************************************/

	private function computeCasualties($lossRatio, $attUnits, $start, $end) {

    $casualties = [];

    for ($i = $start; $i <= $end; $i++) {

        $y = $i - $start + 1;

        $casualties[$y] = round(
            $lossRatio * (isset($attUnits[$i]) ? $attUnits[$i] : 0)
        );
    }

    return $casualties;
}

	/*****************************************
	Phase 2 helper: daunele de sanatate ale
	unui erou dupa lupta — unifica cele 3
	blocuri DB duplicate (atacator, aparator,
	intariri); SINGURUL helper care scrie in
	DB. Intoarce: null = eroul nu exista /
	era deja mort (nicio scriere), 1 = a
	murit acum, 0 = a supravietuit (health
	scazut cu daunele)
	*****************************************/

	private function applyHeroBattleDamage($hero_id, $lossRatio, $reduceForUid = null) {

    global $database;

    $hero_id = (int)$hero_id;

    $_result = mysqli_query(
        $database->dblink,
        "SELECT heroid, health
         FROM " . TB_PREFIX . "hero
         WHERE dead = 0
         AND heroid = " . $hero_id . "
         LIMIT 1"
    );

    $fdb = mysqli_fetch_assoc($_result);

    if (empty($fdb)) {
        return null;
    }

    $hero_health = (int)$fdb['health'];
    $damage_health = round(100 * $lossRatio);

    // T4 hero port (Phase 5): armors reduce the health damage the
    // hero takes in one battle (flat, floored at 0). No-op when off.
    // Se aplica doar cand apelantul trimite un uid (eroul atacator).
    if ($reduceForUid !== null) {
        $damage_health = HeroBattleBonus::reduceDamage($reduceForUid, $damage_health);
    }

    if ($hero_health <= $damage_health || $damage_health > 90) {

        mysqli_query(
            $database->dblink,
            "UPDATE " . TB_PREFIX . "hero
             SET dead = 1, health = 0
             WHERE heroid = " . $hero_id . "
             LIMIT 1"
        );

        return 1;
    }

    mysqli_query(
        $database->dblink,
        "UPDATE " . TB_PREFIX . "hero
         SET health = health - " . (int)$damage_health . "
         WHERE heroid = " . $hero_id . "
         LIMIT 1"
    );

    return 0;
}

	/*****************************************
	Phase 2 helper: prada maxima carata de
	supravietuitori (pur)
	*****************************************/

	private function computeBounty($Attacker, $casualties, $att_tribe, $start, $end) {

    $max_bounty = 0;

    for ($i = $start; $i <= $end; $i++) {

        global ${'u'.$i};

        $y = $i - (($att_tribe - 1) * 10);

        $aliveUnits =
            (int)$Attacker['u'.$i]
            - (int)$casualties[$y];

        $max_bounty += $aliveUnits * (int)${'u'.$i}['cap'];
    }

    return $max_bounty;
}

	/*****************************************
	Function to process Def Scout
	*****************************************/
	
	public function getDataDefScout($defenders, $def_ab, $defender_artefact) {

    $invol = 0;
    $dp = 0;
    $cdp = 0;
    $detected = false;

    /******************************************************************
     * SCOUT UNITS ONLY 
     ******************************************************************/
	 
    global $unitsbytype;
    $scoutUnits = $unitsbytype['scout'];

    foreach ($scoutUnits as $y) {
        $unitAmount = isset($defenders['u'.$y])
            ? (int)$defenders['u'.$y]
            : 0;
        if ($unitAmount <= 0) {
            continue;
        }
        global ${'u'.$y};
        $unitData = ${'u'.$y};
        $abLevel = isset($def_ab[$y])
            ? (int)$def_ab[$y]
            : 0;

        if ($abLevel > 0) {
            $unitDefense = round(
                20 + (
                    20 + (300 * $unitData['pop'] / 7)
                ) * (pow(1.007, $abLevel) - 1),
                4
            );
            $dp += $unitDefense * $unitAmount * $defender_artefact;
        } else {
            $dp += $unitAmount * 20 * $defender_artefact;
        }
        $detected = true;
        $invol += $unitAmount;
    }
    return [
        'dp'      => $dp,
        'cdp'     => $cdp,
        'detect'  => $detected,
        'involve' => $invol
    ];
}

	/*****************************************
	Function to process Deffence
	*****************************************/

	public function getDataDef($defenders, $def_ab) {

    $dp = 0;
    $cdp = 0;
    $invol = 0;

    for ($y = 1; $y <= 90; $y++) {
        $unitAmount = isset($defenders['u'.$y])
            ? (int)$defenders['u'.$y]
            : 0;
        if ($unitAmount <= 0) {
            continue;
        }
        global ${'u'.$y};
        $unitData = ${'u'.$y};
        $abLevel = isset($def_ab[$y])
            ? (int)$def_ab[$y]
            : 0;
        if ($abLevel > 0) {

            // IMPORTANT:
            // kept original formula structure / values
            // only reduced duplicate operations

            $powValue = pow(1.007, $abLevel) - 1;
            $unitDI = round(
                $unitData['di'] + (
                    $unitData['di'] + (300 * $unitData['pop'] / 7)
                ) * $powValue,
                4
            );
            $unitDC = round(
                $unitData['dc'] + (
                    $unitData['dc'] + (300 * $unitData['pop'] / 7)
                ) * $powValue,
                4
            );
            $dp += $unitDI * $unitAmount;
            $cdp += $unitDC * $unitAmount;
        } else {
            $dp += $unitAmount * $unitData['di'];
            $cdp += $unitAmount * $unitData['dc'];
        }
        $invol += $unitAmount;
    }
    return [
        'dp'      => $dp,
        'cdp'     => $cdp,
        'involve' => $invol
    ];
}
 
 	/********************************************************************
	Function to calculates the new building level, after damaging it
	********************************************************************/

	public function calculateNewBuildingLevel($oldLevel, $damage) {

    $oldLevel = (int)$oldLevel;
    $damage = (float)$damage - 0.5;
    if ($damage < 0 || $oldLevel <= 0) {
        return $oldLevel;
    }
    while ($oldLevel > 0 && $damage >= $oldLevel) {
        $damage -= $oldLevel;
        $oldLevel--;
    }
    return $oldLevel;
	}
 
  	/****************************************************
	Function to calculates the damage done by catapults
	****************************************************/

	public function calculateCatapultsDamage(
    $catapultsQuantity,
    $catapultsUpgrade,
    $durability,
    $ADRatio,
    $strongerBuildings,
    $moraleBonus
) {

    $divider = $durability * $strongerBuildings;
    if ($divider <= 0) {
        $divider = 1;
    }
    $catapultsEfficiency = floor($catapultsQuantity / $divider);
    $sigma = $this->sigma($ADRatio);
    return (
        4
        * $sigma
        * $catapultsEfficiency
        * $catapultsUpgrade
        / $moraleBonus
    );
}
};

$battle = new Battle;
