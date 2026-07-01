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
            isset($post['a2_v5'])
        )
    ) {
        return;
    }
    $_POST['mytribe'] = $post['a1_v'];

    /******************************************************************
     * TARGET BUILD
     ******************************************************************/
    $target = [];
    for ($i = 1; $i <= 5; $i++) {
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
    for ($i = 1; $i <= 5; $i++) {
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
        return [
            'heroid' => 0,
            'unit'   => '',
            'atk'    => 0,
            'di'     => 0,
            'dc'     => 0,
            'ob'     => 0,
            'db'     => 0,
            'health' => 0
        ];
    }

    $hero = $heroarray[0];
    $heroUnit = $hero['unit'];
    if (!isset($GLOBALS['h'.$heroUnit])) {

        return [
            'heroid' => 0,
            'unit'   => '',
            'atk'    => 0,
            'di'     => 0,
            'dc'     => 0,
            'ob'     => 0,
            'db'     => 0,
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

    return [
        'heroid' => (int)$hero['heroid'],
        'unit'   => $heroUnit,
        'atk'    => $h_atk,
        'di'     => $h_di,
        'dc'     => $h_dc,
        'ob'     => $h_ob,
        'db'     => $h_db,
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
     * ATTACKER INIT (KEEP LEGACY STRUCTURE)
     ******************************************************************/
    $attacker = [];

    for ($i = 1; $i <= 50; $i++) {
        $attacker['u'.$i] = 0;
    }

    $start = ((int)$post['a1_v'] - 1) * 10 + 1;

    $offhero       = (int)$post['h_off_bonus'];
    $hero_strenght = (int)$post['h_off'];
    $deffhero      = (int)$post['h_def_bonus'];

    /******************************************************************
     * ATTACKER UNITS + ATTACK BONUSES (CRITICAL LEGACY VARS)
     ******************************************************************/
    $att_ab1 = $att_ab2 = $att_ab3 = $att_ab4 = 0;
    $att_ab5 = $att_ab6 = $att_ab7 = $att_ab8 = 0;

    for ($i = $start, $index = 1; $i <= $start + 9; $i++, $index++) {

        $attacker['u'.$i] = !empty($post['a1_'.$index])
            ? (int)$post['a1_'.$index]
            : 0;

        if ($index <= 8) {

            if (!empty($post['f1_'.$index])) {
                ${'att_ab'.$index} = (int)$post['f1_'.$index];
            } else {
                ${'att_ab'.$index} = 0;
            }
        }
    }

    /******************************************************************
     * DEFENDER INIT
    ******************************************************************/
	
	$defender = [];
	$def_ab   = [];
	$defscout = 0;

	for ($i = 1; $i <= 50; $i++) {
		$units = (int)($post['a2_'.$i] ?? 0);
		$ab    = (int)($post['f2_'.$i] ?? 0);

    $defender['u'.$i] = $units;
    $def_ab[$i]       = $units > 0 ? $ab : 0;

    if ($units > 0 && in_array($i, [4,14,23,44])) {
        $defscout += $units;
		}
	}

    /******************************************************************
     * BASIC VALUES
     ******************************************************************/
    $deftribe = (int)$post['tribe'];

    $walllevel = (int)$post['walllevel'];
    $wall      = $walllevel;
    $palast    = (int)$post['palast'];

    $kata = !empty($post['kata']) ? (int)$post['kata'] : 0;

    /******************************************************************
     * SCOUT CHECK 
     ******************************************************************/
    $scout = 1;

    for ($i = $start; $i <= $start + 9; $i++) {

        if ($i == 4 || $i == 14 || $i == 23 || $i == 44) {
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
     ******************************************************************/
    if (!$scout) {

        return $this->calculateBattle(
            $attacker,
            $defender,
            $wall,
            $post['a1_v'],
            $deftribe,
            $palast,
            $post['ew1'],
            $post['ew2'],
            $post['ktyp'] + 3,
            $def_ab,
            $att_ab1, $att_ab2, $att_ab3, $att_ab4,
            $att_ab5, $att_ab6, $att_ab7, $att_ab8,
            $kata,
            $post['stonemason'],
            $walllevel,
            $offhero,
            $hero_strenght,
            $deffhero,
            0, 0, 0, 0, 0
        );

    } else {

        return $this->calculateBattle(
            $attacker,
            $defender,
            $wall,
            $post['a1_v'],
            $deftribe,
            $palast,
            $post['ew1'],
            $post['ew2'],
            1,
            $def_ab,
            $att_ab1, $att_ab2, $att_ab3, $att_ab4,
            $att_ab5, $att_ab6, $att_ab7, $att_ab8,
            $kata,
            $post['stonemason'],
            $walllevel,
            0, 0, 0, 0, 0, 0, 0, 0
        );
    }
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

        // faster than array_keys + strpos + preg_replace
        if (
            isset($value)
            && $value == $tid
            && isset($key[0])
            && $key[0] === 't'
        ) {

            $keyholder[] = (int)substr($key, 1);
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
			
    global $bid34, $bid35, $database;

    /******************************************************************
     * UNIT GROUP DEFINITIONS
     ******************************************************************/
    $calvaryLookup = array_flip([4, 5, 6, 15, 16, 23, 24, 25, 26, 45, 46]);
    $catapultLookup = array_flip([8, 18, 28, 48]);
    $ramsLookup = array_flip([7, 17, 27, 47]);

    $catp = 0;
    $ram  = 0;

    /******************************************************************
     * BASE VARIABLES
     ******************************************************************/
    $result   = [];
    $units    = [];
    $involve  = 0;
    $winner   = false;

    $cap = 0;
    $ap  = 0;
    $dp  = 0;
    $cdp = 0;
    $rap = 0;
    $rdp = 0;

    $detected = false;

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

        if(isset($Defender['hero']) && $Defender['hero'] != 0){
			
                $units['Def_unit']['hero'] = $Defender['hero'];
                $own_cdp += $defenderhero['dc'];
                $own_dp += $defenderhero['di'];
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

    /******************************************************************
     * ATTACKER UNIT CALCULATION
     ******************************************************************/
    $start = ($att_tribe - 1) * 10 + 1;
    $end   = $att_tribe * 10;

    if ($type == 1) {

        $abcount = ($att_tribe == 3) ? 3 : 4;
        $scoutAB = ${'att_ab'.$abcount};

        for ($i = $start; $i <= $end; $i++) {

            $unitAmount = (int)$Attacker['u'.$i];

            if ($unitAmount <= 0) {
                continue;
            }

            global ${'u'.$i};

            if ($i == 4 || $i == 14 || $i == 23 || $i == 44) {

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
            $units['Att_unit'][$i] = $unitAmount;
        }

        $ap *= $attacker_artefact;

    } else {

        $abValues = [
            1 => $att_ab1,
            2 => $att_ab2,
            3 => $att_ab3,
            4 => $att_ab4,
            5 => $att_ab5,
            6 => $att_ab6,
            7 => $att_ab7,
            8 => $att_ab8
        ];

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

            if ($abcount <= 8 && $abValues[$abcount] > 0) {

                $unitAttack = round(
                    $unitAttack + (
                        $unitAttack + (300 * $unitData['pop'] / 7)
                    ) * (pow(1.007, $abValues[$abcount]) - 1),
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
            $units['Att_unit'][$i] = $unitAmount;

            $abcount++;
        }

        /******************************************************************
         * HERO OFFENSE
         ******************************************************************/
        if (!empty($Attacker['uhero']) && !empty($atkhero)) {

            $units['Att_unit']['hero'] = $Attacker['uhero'];

            $ap  *= $atkhero['ob'];
            $cap *= $atkhero['ob'];

            $ap += $atkhero['atk'];
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

    /******************************************************************
     * WALL + RESIDENCE
     ******************************************************************/
    $residenceBonus = (2 * ($residence * $residence)) + 10;

    if ($def_wall > 0) {

        if ($def_tribe == 1) {
            $factor = 1.030;
        } elseif ($def_tribe == 2) {
            $factor = 1.020;
        } else {
            $factor = 1.025;
        }

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

    /******************************************************************
     * ATTACK / DEFENSE TOTAL
     ******************************************************************/
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

    $result['Attack_points'] = $rap;
    $result['Defend_points'] = $rdp;

    $winner = ($rap > $rdp);

    $safeRap = max(1, (float)$rap);
    $safeRdp = max(1, (float)$rdp);

    /******************************************************************
     * MORALE
     ******************************************************************/
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

    /******************************************************************
     * M FACTOR
     ******************************************************************/
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

    /******************************************************************
     * LOSSES
     ******************************************************************/
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

        $ram -= ($winner)
            ? round($ram * $result[1] / 100)
            : round($ram * $result[2] / 100);

        $catp -= ($winner)
            ? round($catp * $result[1] / 100)
            : round($catp * $result[2] / 100);
    }

    /******************************************************************
     * CATAPULTS DAMAGE
     ******************************************************************/
    if ($catp > 0 && $tblevel != 0) {

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

        $result[3] = $this->calculateNewBuildingLevel($tblevel, $catapultsDamage);
        $result[4] = $tblevel;

        $result['catapults'] = [
            'upgrades' => $upgrades,
            'durability' => $durability,
            'attackDefenseRatio' => $attackDefenseRatio,
            'strongerBuildings' => $strongerbuildings,
            'moraleBonus' => $catpMoraleBonus
        ];
    }

    /******************************************************************
     * RAMS DAMAGE
     ******************************************************************/
    if ($ram > 0 && $walllevel != 0) {

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

        $result[7] = $this->calculateNewBuildingLevel($walllevel, $ramsDamage);
        $result[8] = $walllevel;

        $result['rams'] = [
            'upgrades' => $upgrades,
            'durability' => $durability,
            'attackDefenseRatio' => $attackDefenseRatio,
            'strongerBuildings' => $strongerbuildings,
            'moraleBonus' => 1
        ];
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
    for ($i = $start; $i <= $end; $i++) {

        $y = $i - $start + 1;

        $result['casualties_attacker'][$y] = round(
            $result[1] * (isset($units['Att_unit'][$i]) ? $units['Att_unit'][$i] : 0)
        );
    }

    /******************************************************************
     * HERO DAMAGE (ATTACKER)
     ******************************************************************/
    if (!empty($units['Att_unit']['hero']) && !empty($atkhero['heroid'])) {

        $hero_id = (int)$atkhero['heroid'];

        $_result = mysqli_query(
            $database->dblink,
            "SELECT heroid, health
             FROM " . TB_PREFIX . "hero
             WHERE dead = 0
             AND heroid = " . $hero_id . "
             LIMIT 1"
        );

        $fdb = mysqli_fetch_assoc($_result);

        if (!empty($fdb)) {

            $hero_health = (int)$fdb['health'];
            $damage_health = round(100 * $result[1]);

            if ($hero_health <= $damage_health || $damage_health > 90) {

                $result['casualties_attacker'][11] = 1;

                mysqli_query(
                    $database->dblink,
                    "UPDATE " . TB_PREFIX . "hero
                     SET dead = 1, health = 0
                     WHERE heroid = " . $hero_id . "
                     LIMIT 1"
                );

            } else {

                mysqli_query(
                    $database->dblink,
                    "UPDATE " . TB_PREFIX . "hero
                     SET health = health - " . (int)$damage_health . "
                     WHERE heroid = " . $hero_id . "
                     LIMIT 1"
                );
            }
        }
    }

    /******************************************************************
     * HERO DAMAGE (DEFENDER)
     ******************************************************************/
    if (!empty($units['Def_unit']['hero']) && !empty($defenderhero['heroid'])) {

        $hero_id = (int)$defenderhero['heroid'];

        $_result = mysqli_query(
            $database->dblink,
            "SELECT heroid, health
             FROM " . TB_PREFIX . "hero
             WHERE dead = 0
             AND heroid = " . $hero_id . "
             LIMIT 1"
        );

        $fdb = mysqli_fetch_assoc($_result);

        if (!empty($fdb)) {

            $hero_health = (int)$fdb['health'];
            $damage_health = round(100 * $result[2]);

            if ($hero_health <= $damage_health || $damage_health > 90) {

                $result['deadherodef'] = 1;

                mysqli_query(
                    $database->dblink,
                    "UPDATE " . TB_PREFIX . "hero
                     SET dead = 1, health = 0
                     WHERE heroid = " . $hero_id . "
                     LIMIT 1"
                );

            } else {

                $result['deadherodef'] = 0;

                mysqli_query(
                    $database->dblink,
                    "UPDATE " . TB_PREFIX . "hero
                     SET health = health - " . (int)$damage_health . "
                     WHERE heroid = " . $hero_id . "
                     LIMIT 1"
                );
            }
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

            $hero_id = (int)$heroarraydefender['heroid'];

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
                continue;
            }

            $hero_health = (int)$fdb['health'];
            $damage_health = round(100 * $result[2]);

            if ($hero_health <= $damage_health || $damage_health > 90) {

                $result['deadheroref'][$defenders['id']] = 1;

                mysqli_query(
                    $database->dblink,
                    "UPDATE " . TB_PREFIX . "hero
                     SET dead = 1, health = 0
                     WHERE heroid = " . $hero_id . "
                     LIMIT 1"
                );

            } else {

                $result['deadheroref'][$defenders['id']] = 0;

                mysqli_query(
                    $database->dblink,
                    "UPDATE " . TB_PREFIX . "hero
                     SET health = health - " . (int)$damage_health . "
                     WHERE heroid = " . $hero_id . "
                     LIMIT 1"
                );
            }
        }
    }

    /******************************************************************
     * BOUNTY CALCULATION
     ******************************************************************/
    $max_bounty = 0;

    for ($i = $start; $i <= $end; $i++) {

        global ${'u'.$i};

        $y = $i - (($att_tribe - 1) * 10);

        $aliveUnits =
            (int)$Attacker['u'.$i]
            - (int)$result['casualties_attacker'][$y];

        $max_bounty += $aliveUnits * (int)${'u'.$i}['cap'];
    }

    $result['bounty'] = $max_bounty;

    return $result;
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
	 
    $scoutUnits = [4, 14, 23, 44];

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

    for ($y = 1; $y <= 50; $y++) {
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
?>