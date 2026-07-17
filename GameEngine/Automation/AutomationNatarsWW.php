<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationNatarsWW.php                                      ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Natars, WW villages/plans, active artifacts                 ##
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

trait AutomationNatarsWW {


    private function startNatarAttack($level, $vid, $time) {
        global $database;

        // bad, but should work :D
        // I took the data from my first ww (first .org world)
        // TODO: get the algo from the real travian with the 100 biggest offs

        // select the troops^^
        $troops = $this->getNatarTroopTable();
        if (isset($troops[$level])) $units = $troops[$level];
        else return false;

        // get the capital village from the natars
        $query = mysqli_query($database->dblink,'SELECT `wref` FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = 3 and `capital` = 1 LIMIT 1') or die(mysqli_error($database->dblink));
        $row = mysqli_fetch_assoc($query);

        // start the attacks
        $endtime = $time + round(86400 / INCREASE_SPEED);

        // -.-
        $vid = (int) $vid;
        mysqli_query($database->dblink,'INSERT INTO `' . TB_PREFIX . 'ww_attacks` (`vid`, `attack_time`) VALUES (' . $vid . ', ' . $endtime . ')');
        mysqli_query($database->dblink,'INSERT INTO `' . TB_PREFIX . 'ww_attacks` (`vid`, `attack_time`) VALUES (' . $vid . ', ' . ($endtime + 1) . ')');

        // two waves: the second one targets the WW (catapult target 40) one second later
        $this->launchNatarWave($row['wref'], $vid, $units[0], 0, $time, $endtime);
        $this->launchNatarWave($row['wref'], $vid, $units[1], 40, $time, $endtime + 1);
    }

    /**
     * Fire a single Natar attack wave at a World Wonder village.
     * $unitRow is one troop row [t2, t3, t5, t6, t7, t8]; $ctar1 is the
     * catapult target slot (0 for the first wave, 40 for the second).
     */
    private function launchNatarWave($source, $vid, $unitRow, $ctar1, $time, $arrival) {
        global $database;

        $ref = $database->addAttack($source, 0, $unitRow[0], $unitRow[1], 0, $unitRow[2], $unitRow[3], $unitRow[4], $unitRow[5], 0, 0, 0, 3, $ctar1, 0, 0, 0, 20, 20, 0, 20, 20, 20, 20);
        $database->addMovement(3, $source, $vid, $ref, $time, $arrival);
    }

    /**
     * Hard-coded Natar offensive waves indexed by World Wonder level.
     * Each level holds two waves, each a troop row [t2, t3, t5, t6, t7, t8].
     */
    private function getNatarTroopTable() {
        return [5 => [[3412, 2814, 4156, 3553, 9, 0], [35, 0, 77, 33, 17, 10]],
                   10 => [[4314, 3688, 5265, 4621, 13, 0], [65, 0, 175, 77, 28, 17]],
                   15 => [[4645, 4267, 5659, 5272, 15, 0], [99, 0, 305, 134, 40, 25]],
                   20 => [[6207, 5881, 7625, 7225, 22, 0], [144, 0, 456, 201, 56, 36]],
                   25 => [[6004, 5977, 7400, 7277, 23, 0], [152, 0, 499, 220, 58, 37]],
                   30 => [[7073, 7181, 8730, 8713, 27, 0], [183, 0, 607, 268, 69, 45]],
                   35 => [[7090, 7320, 8762, 8856, 28, 0], [186, 0, 620, 278, 70, 45]],
                   40 => [[7852, 6967, 9606, 8667, 25, 0], [146, 0, 431, 190, 60, 37]],
                   45 => [[8480, 8883, 10490, 10719, 35, 0], [223, 0, 750, 331, 83, 54]],
                   50 => [[8522, 9038, 10551, 10883, 35, 0], [224, 0, 757, 335, 83, 54]],
                   55 => [[8931, 8690, 10992, 10624, 32, 0], [219, 0, 707, 312, 84, 54]],
                   60 => [[12138, 13013, 15040, 15642, 51, 0], [318, 0, 1079, 477, 118, 76]],
                   65 => [[13397, 14619, 16622, 17521, 58, 0], [345, 0, 1182, 522, 127, 83]],
                   70 => [[16323, 17665, 20240, 21201, 70, 0], [424, 0, 1447, 640, 157, 102]],
                   75 => [[20739, 22796, 25746, 27288, 91, 0], [529, 0, 1816, 803, 194, 127]],
                   80 => [[21857, 24180, 27147, 28914, 97, 0], [551, 0, 1898, 839, 202, 132]],
                   85 => [[22476, 25007, 27928, 29876, 100, 0], [560, 0, 1933, 855, 205, 134]],
                   90 => [[31345, 35053, 38963, 41843, 141, 0], [771, 0, 2668, 1180, 281, 184]],
                   95 => [[31720, 35635, 39443, 42506, 144, 0], [771, 0, 2671, 1181, 281, 184]],
                   96 => [[32885, 37007, 40897, 44130, 150, 0], [795, 0, 2757, 1219, 289, 190]],
                   97 => [[32940, 37099, 40968, 44235, 150, 0], [794, 0, 2755, 1219, 289, 190]],
                   98 => [[33521, 37691, 41686, 44953, 152, 0], [812, 0, 2816, 1246, 296, 194]],
                   99 => [[36251, 40861, 45089, 48714, 165, 0], [872, 0, 3025, 1338, 317, 208]]];
    }

    private function checkWWAttacks() {
        global $database;
        
        $query = mysqli_query($database->dblink,'SELECT vid, attack_time FROM `' . TB_PREFIX . 'ww_attacks` WHERE `attack_time` <= ' . time());
        while ($row = mysqli_fetch_assoc($query))
        {
            // delete the attack
            $query3 = mysqli_query($database->dblink,'DELETE FROM `' . TB_PREFIX . 'ww_attacks` WHERE `vid` = ' . (int) $row['vid'] . ' AND `attack_time` = ' . (int) $row['attack_time']);
        }
    }
    
    /**
     * Create the Natars account and spawn artifacts
     *
     */
    
    private function spawnNatars(){
    	global $database;
    	
    	//Check if Natars account is already created and if the time
    	//is come and we have to create Natars and spawn their artifacts
    	if($database->areArtifactsSpawned() || strtotime(START_DATE) + (NATARS_SPAWN_TIME * 86400) > time()) return;
    	
    	//Create the Natars account and his capital
    	$this->artifacts->createNatars();
    	
    	//Write the system message
    	$database->displaySystemMessage(ARTEFACT);
    }
    
    /**
     * Spawn WW Villages
     *
     */
    
    private function spawnWWVillages(){
    	global $database;
    	
    	//Check if Natars account has already been created, if WW villages have already been spawned
    	//and if it's the time to spawn them or not
    	if(!$database->areArtifactsSpawned() || $database->areWWVillagesSpawned() || strtotime(START_DATE) + (NATARS_WW_SPAWN_TIME * 86400) > time()) return;
    	
    	//Create WW villages
    	$this->artifacts->createWWVillages();
	    
	    //Write the system message
    	$database->displaySystemMessage(WWVILLAGEMSG);
    }
    
    /**
     * Spawn WW Building plans
     * 
     */
    
    private function spawnWWBuildingPlans(){
    	global $database;
    	
    	//Check if Natars account is already spawned, if WW building plans have already been spawned
    	//and if it's the time to spawn them or not
    	if(!$database->areArtifactsSpawned() || $database->areArtifactsSpawned(true) || strtotime(START_DATE) + (NATARS_WW_BUILDING_PLAN_SPAWN_TIME * 86400) > time()) return;
    	
    	//Create WW building plans
    	$this->artifacts->createWWBuildingPlans();
    	
    	//Set the system message to contain the infos of the WW building plans
    	$database->displaySystemMessage(PLAN_INFO);
    }
    
    /**
     * Automatically activate all artifacts that need to be activated
     *
     */
    
    private function activateArtifacts() {
        global $database;
        
        //Check if there's at least one artifact, if not, return
        if(!$database->areArtifactsSpawned()) return;
        
        //Activate the artifacts that need to be activated
        $this->artifacts->activateArtifacts();
    }

    private function artefactOfTheFool() {
        global $database;
        
        $time = time();
        $q = "SELECT id, size FROM " . TB_PREFIX . "artefacts where type = 8 AND active = 1 AND del = 0 AND lastupdate <= ".($time - (86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED))));
        $array = $database->query_return($q);
        if ($array) {
            foreach($array as $artefact) {
                $kind = rand(1, 7);
                
                while($kind == 6) $kind = rand(1, 7);
                    
                if($artefact['size'] != 3) $bad_effect = rand(0, 1);
                else $bad_effect = 0;

                switch($kind) {
                    case 1:
                        $effect = rand(1, 5);
                        break;
                    case 2:
                        $effect = rand(1, 3);
                        break;
                    case 3:
                        $effect = rand(3, 10);
                        break;
                    case 4:
                    case 5:
                        $effect = rand(2, 4);
                        break;
                    case 7:
                        $effect = rand(1, 6);
                        break;
                }
                mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."artefacts SET kind = ". (int) $kind. ", bad_effect = $bad_effect, effect2 = $effect, lastupdate = $time WHERE id = ".(int) $artefact['id']);
            }
        }
    }
}
