<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       Automation.php                                              ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2018. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################

// make sure we only run the automation script once and wait until it's done,
// so concurrent AJAX calls from many different users won't overload the server
if ( !defined('AUTOMATION_MANUAL_RUN') ) {
    if ( file_exists( AUTOMATION_LOCK_FILE_NAME ) ) {
        // check that the file is not too old, in which case our PHP script hung
        // and we need to remove the lock and run automation again
        $fileTime = filemtime( AUTOMATION_LOCK_FILE_NAME );

        // allow for 60 seconds of old automation script processing time, which is still way too plenty
        if ( ! $fileTime || time() - $fileTime > 60 ) {
            @unlink( AUTOMATION_LOCK_FILE_NAME );
        } else {
            // automation file exists and is valid, don't run another automation
            exit;
        }
    } else {
        // create automation lock file
        file_put_contents( AUTOMATION_LOCK_FILE_NAME, '' );
    }
}

include_once("Database.php");
include_once("Data/buidata.php");
include_once("Data/unitdata.php");
include_once("Data/hero_full.php");
include_once("Units.php");
include_once("Battle.php");
include_once("Technology.php");
include_once("Ranking.php");
include_once("Generator.php");
include_once("Multisort.php");
include_once("Building.php");
include_once("Artifacts.php");

class Automation {

    /**
     * @var object The artifacts class, used to create Natars, artifacts and obtaining info about them
     */
    
    private $artifacts;
    
    public function __construct() {
    	
        //Classes initialization
        $this->artifacts = new Artifacts();
        
    	$autoprefix = "";
    	for ($i = 0; $i < 5; $i++) {
    		$autoprefix = str_repeat('../', $i);
    		if (file_exists($autoprefix.'autoloader.php')) {
    			// we have our path, let's leave
    			break;
    		}
    	}
    	
        $this->procNewClimbers();
        $this->ClearUser();
        $this->ClearInactive();
        $this->pruneResource();
        $this->pruneOResource();
        $this->checkWWAttacks();
        $this->delTradeRoute();
        $this->TradeRoute();
        
        $methodsArrays = ["culturePoints", "updateHero", "clearDeleting", "buildComplete",
        				  "demolitionComplete", "marketComplete", "researchComplete",
        				  "trainingComplete", "starvation", "celebrationComplete",
        				  "sendUnitsComplete", "loyaltyRegeneration", "sendreinfunitsComplete",
        				  "returnunitsComplete", "sendSettlersComplete", "spawnNatars",
        				  "spawnWWVillages", "spawnWWBuildingPlans", "activateArtifacts"];
        
        foreach($methodsArrays as $method){
        	$file = fopen($autoprefix."GameEngine/Prevention/".$method.".txt", "w");
        	if(flock($file, LOCK_EX)) {
        		call_user_func(array($this, $method));
        		flock($file, LOCK_UN);     		
        	}
        	fclose($file);
        }
        
        $this->MasterBuilder();
        $this->updateGeneralAttack();
        $this->checkInvitedPlayes();
        $this->updateStore();
        $this->CheckBan();
        $this->regenerateOasisTroops();
        $this->medals();
        $this->artefactOfTheFool();
    }

    public function procResType($ref, $mode = 0) {
        //Capital or only 1 village left = cannot be destroyed
        return addslashes(empty($build = Building::procResType($ref)) && !$mode ? "Village can't be" : $build);
    }

    function recountPop($vid, $use_cache = true){
        global $database;
        
        $vid = (int) $vid;
        $fdata = $database->getResourceLevel($vid, $use_cache);
        $popTot = 0;

        for ($i = 1; $i <= 40; $i++) {
            $lvl = $fdata["f".$i];
            $building = $fdata["f".$i."t"];
			if($building) $popTot += $this->buildingPOP($building, $lvl);
        }
        
        Building::recountCP($database, $vid);
		$q = "UPDATE ".TB_PREFIX."vdata set pop = $popTot where wref = $vid";
		mysqli_query($database->dblink, $q);
		$owner = $database->getVillageField($vid, "owner");
		$this->procClimbers($owner);

        return $popTot;
    }

    function buildingPOP($f, $lvl){
        $name = "bid".$f;
        global $$name;
        
        $popT = 0;
        $dataarray = $$name;

        for ($i = 0; $i <= $lvl; $i++) {
            $popT += ((isset($dataarray[$i]) && isset($dataarray[$i]['pop'])) ? $dataarray[$i]['pop'] : 0);
        }
        return $popT;
    }

    private function loyaltyRegeneration() {
    	global $database;
        
        $array = [];
        $array = $database->getProfileVillages(0, 6);
        if(!empty($array)) {
            foreach($array as $loyalty) {
                if (($t25_level = $this->getTypeLevel(25, $loyalty['wref'])) >= 1) {
                    $value = $t25_level;
                }elseif(($t26_level = $this->getTypeLevel(26, $loyalty['wref'])) >= 1){
                    $value = $t26_level;
                }
                else $value = 0;
                
                if($value > 0){
                    $newloyalty = min(100, $loyalty['loyalty'] + $value * (time() - $loyalty['lastupdate2']) / 3600);
                    $q = "UPDATE ".TB_PREFIX."vdata SET loyalty = $newloyalty, lastupdate2=".time()." WHERE wref = '".$loyalty['wref']."'";
                    $database->query($q);
                }            
            }
        }
        
        $array = [];
        $q = "SELECT conqured, loyalty, lastupdated, wref FROM ".TB_PREFIX."odata WHERE loyalty < 100";
        $array = $database->query_return($q);
        if(!empty($array)) {
            foreach($array as $loyalty) {
                $value = $this->getTypeLevel(37, $loyalty['conqured']);   
                
                if($value > 0){
                    $newloyalty = min(100, $loyalty['loyalty'] + $value * (time() - $loyalty['lastupdated']) / 3600);
                    $q = "UPDATE ".TB_PREFIX."odata SET loyalty = $newloyalty, lastupdated=".time()." WHERE wref = '".$loyalty['wref']."'";
                    $database->query($q);
                }              
            }
        }
    }

    public function getTypeLevel($tid, $vid) {
        global $database;
        
        $keyholder = [];

        $resourcearray = $database->getResourceLevel($vid);
        foreach(array_keys($resourcearray, $tid) as $key) {
            if(strpos($key,'t')) {
                $key = preg_replace("/[^0-9]/", '', $key);
                array_push($keyholder, $key);
            }
        }
        
        $element = count($keyholder);
        if($element >= 2) {
            if($tid <= 4) {
                $temparray = [];
                for($i = 0; $i <= $element - 1; $i++) {
                    array_push($temparray,$resourcearray['f'.$keyholder[$i]]);
                }
                foreach ($temparray as $key => $val) {
                    if ($val == max($temparray)) $target = $key;                        
                }
            }
            else {
                $target = 0;
                for($i = 1; $i <= $element - 1; $i++) {
                    if($resourcearray['f'.$keyholder[$i]] > $resourcearray['f'.$keyholder[$target]]) {
                        $target = $i;
                    }
                }
            }
        }
        else if($element == 1) $target = 0;
        else return 0;

        if(!empty($keyholder[$target])) return $resourcearray['f'.$keyholder[$target]];
        else return 0;
    }

    private function clearDeleting() {
    	global $database;
        
        $needDelete = $database->getNeedDelete();
        if(count($needDelete) > 0) {
        	
        	//Remove the time limit, otherwise deleting players with 80 or more villages couldn't be deleted in one run
        	@set_time_limit(0);
        	
            foreach($needDelete as $need) {
                $need['uid'] = (int) $need['uid'];
                
                //Get the villages which have to be deleted
                $needVillages = $database->getVillagesID($need['uid']);
                
                //Delete all villages
                $database->DelVillage($needVillages);

                for($i = 0;$i < 20; $i++){
                    $q = "SELECT id FROM ".TB_PREFIX."users where friend".$i." = ".$need['uid']." or friend".$i."wait = ".$need['uid']."";
                    $array = $database->query_return($q);
                    foreach($array as $friend){
                        $database->deleteFriend($friend['id'],"friend".$i);
                        $database->deleteFriend($friend['id'],"friend".$i."wait");
                    }
                }

                $database->updateUserField($need['uid'], 'alliance', 0, 1);

                if($database->isAllianceOwner($need['uid'])){
                    $alliance = $database->getUserAllianceID($need['uid']);
                    $newowner = $database->getAllMember2($alliance);
                    $newleader = $newowner['id'];
                    $q = "UPDATE " . TB_PREFIX . "alidata set leader = ".(int) $newleader." where id = ".(int) $alliance."";
                    $database->query($q);
                    $database->updateAlliPermissions($newleader, $alliance, "Leader", 1, 1, 1, 1, 1, 1, 1);
                    Automation::updateMax($newleader);
                }

                if (isset($alliance)) $database->deleteAlliance($alliance);
                
                $q = "DELETE FROM ".TB_PREFIX."hero where uid = ".$need['uid'];
                $database->query($q);

                $q = "DELETE FROM ".TB_PREFIX."mdata where target = ".$need['uid']." or owner = ".$need['uid'];
                $database->query($q);

                $q = "DELETE FROM ".TB_PREFIX."ndata where uid = ".$need['uid'];
                $database->query($q);

                $q = "DELETE FROM ".TB_PREFIX."users where id = ".$need['uid'];
                $database->query($q);

                $q = "DELETE FROM ".TB_PREFIX."deleting where uid = ".$need['uid'];
                $database->query($q);
            }
        }
    }

    private function ClearUser() {
        global $database;
        
        if(AUTO_DEL_INACTIVE) {
            $time = time() - UN_ACT_TIME;

            $q = "INSERT INTO ".TB_PREFIX."deleting SELECT id, UNIX_TIMESTAMP() FROM ".TB_PREFIX."users WHERE timestamp < $time AND tribe IN(1, 2, 3)";
            $database->query($q);
        }
    }

    private function ClearInactive() {
        global $database;
        
        if(TRACK_USR) {
            $timeout = time()-USER_TIMEOUT * 60;
            $q = "DELETE FROM ".TB_PREFIX."active WHERE timestamp < $timeout";
            $database->query($q);
        }
    }
    
    private function pruneOResource() {
        global $database;
        
        if(!ALLOW_BURST) {
            $database->query("UPDATE
                      ".TB_PREFIX."odata
                  SET
                      wood = IF(wood < 0, 0, wood),
                      clay = IF(clay < 0, 0, clay),
                      iron = IF(iron < 0, 0, iron),
                      crop = IF(crop < 0, 0, crop),
                      maxstore = IF(maxstore < ".STORAGE_BASE.", ".STORAGE_BASE.", maxstore),
                      maxcrop = IF(maxcrop < ".STORAGE_BASE.", ".STORAGE_BASE.", maxcrop)
                  WHERE
                      maxstore < ".STORAGE_BASE." OR
                      maxcrop < ".STORAGE_BASE." OR
                      wood < 0 OR
                      clay < 0 OR
                      iron < 0 OR
                      crop < 0");
        }
    }
    private function pruneResource() {
        global $database;
        
        if(!ALLOW_BURST) {
            $database->query("UPDATE
                      ".TB_PREFIX."vdata
                  SET
                      wood = IF(wood < 0, 0, wood),
                      clay = IF(clay < 0, 0, clay),
                      iron = IF(iron < 0, 0, iron),
                      crop = IF(crop < 0, 0, crop),
                      maxstore = IF(maxstore < ".STORAGE_BASE.", ".STORAGE_BASE.", maxstore),
                      maxcrop = IF(maxcrop < ".STORAGE_BASE.", ".STORAGE_BASE.", maxcrop)
                  WHERE
                      maxstore < ".STORAGE_BASE." OR
                      maxcrop < ".STORAGE_BASE." OR
                      wood < 0 OR
                      clay < 0 OR
                      iron < 0 OR
                      crop < 0");

            $database->query("UPDATE
                      ".TB_PREFIX."vdata
                  SET
                      wood = IF(wood > maxstore, maxstore, wood),
                      clay = IF(clay > maxstore, maxstore, clay),
                      iron = IF(iron > maxstore, maxstore, iron),
                      crop = IF(crop > maxcrop, maxcrop, crop)
                  WHERE
                      wood > maxstore OR
                      clay > maxstore OR
                      iron > maxstore OR
                      crop > maxcrop");
        }
    }

    private function culturePoints() {
        global $database;

        $database->updateVSumField('cp');
    }

    private function buildComplete() {
        global $database, $technology, $bid18, $bid10, $bid11, $bid38, $bid39;

        $time = time();
        // IDs of villages that were affected by this building completion update,
        // used to calculate statistical data at the end
        $villagesAffected = [];
        // holds additional conditions when updating loopcon records in the bdata table
        $loopconUpdates = [];
        // this will hold IDs of bdata table records to delete
        $dbIdsToDelete = [];

        // get all pending builds that should be complete by now
        $res = $database->query_return(
            "SELECT
                id, wid, field, level, type, timestamp
             FROM
                ".TB_PREFIX."bdata
            WHERE
                timestamp < $time and master = 0"
        );

        // preload village data
        $vilIDs = [];
        foreach($res as $indi) {
            $vilIDs[$indi['wid']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getProfileVillages($vilIDs, 5);
        $database->getEnforceVillage($vilIDs, 0);

        // complete buildings
        foreach($res as $indi) {
            // store village ID for later for statistical updates
            $villageData = $database->getVillageFields($indi['wid'],'owner, maxcrop, maxstore, starv, pop');
            $villageOwner = $villageData['owner'];
            $villagesAffected[] = (int) $indi['wid'];
            $fieldsToSet = [];
            
            $q = "UPDATE ".TB_PREFIX."fdata SET f".$indi['field']." = ".$indi['level'].", f".$indi['field']."t = ".$indi['type']." WHERE vref = ".(int) $indi['wid'];

            if($database->query($q)) {
                // this will be the level we brought the building to now
                $level = $indi['level'];

                // TODO: magic numbers into constants (for building types below)

                // update capacity if we updated a warehouse or a granary
                if (in_array($indi['type'], [10, 11, 38, 39])) {
                    $fieldDbName = (in_array($indi['type'], [10, 38]) ? 'maxstore' : 'maxcrop');
                    $max = $villageData[$fieldDbName];

                    if($level == 1 && $max == STORAGE_BASE) $max = STORAGE_BASE;
                    
                    if ($level != 1) $max -= ${'bid'.$indi['type']}[$level - 1]['attri'] * STORAGE_MULTIPLIER;

                    $max += ${'bid'.$indi['type']}[$level]['attri'] * STORAGE_MULTIPLIER;

                    $fieldsToSet[$fieldDbName] = $max;
                }

                // if we updated Embassy, update maximum members that the alliance can take
                if($indi['type'] == 18) Automation::updateMax($villageOwner);

                // by SlimShady95 aka Manuel Mannhardt < manuel_mannhardt@web.de >
                if ($indi['type'] == 40 && ($indi['level'] % 5 == 0 || $indi['level'] > 95) && $indi['level'] != 100) {
                    $this->startNatarAttack($indi['level'], $indi['wid'], $indi['timestamp']);
                }

                //now can't be more than one winner if ww to level 100 is build by 2 users or more on same time
                if ($indi['type'] == 40 && $indi['level'] == 100) {
                    mysqli_query($database->dblink,"TRUNCATE ".TB_PREFIX."bdata");
                }

                // TODO: find out what exactly these conditions are for
                // no special military conditioning for Teutons and Gauls
                if ($database->getUserField($villageOwner, "tribe", 0) != 1) $loopconUpdates[$indi['wid']] = '';                 
                else
                {
                    // special condition for Roman military buildings
                    if ($indi['field'] > 18) $loopconUpdates[$indi['wid']] = ' AND field > 18';                    
                    else $loopconUpdates[$indi['wid']] = ' AND field < 19';                                      
                }

                // Update ww last finish upgrade
                if ($indi['type'] == 40) {
                    $qW = "UPDATE ".TB_PREFIX."fdata set ww_lastupdate = ".time()." where vref = ".(int) $indi['wid'];
                    $database->query($qW);
                }

                $dbIdsToDelete[] = (int) $indi['id'];
            }

            //Update starvation data
            $database->addStarvationData($indi['wid']);

            // update the requested fields, all at once
            $database->setVillageFields($indi['wid'], array_keys($fieldsToSet), array_values($fieldsToSet));
        }

        // update statistical data for affected villages
        foreach ($villagesAffected as $affected_id) $this->recountPop($affected_id, false);

        // update data that can be done in one swoop instead of using multiple update queries
        // no special checks for Romans
        foreach ($loopconUpdates as $villageId => $updateCondition) {
            $database->query(
                "UPDATE
                    ".TB_PREFIX."bdata
                 SET
                    loopcon = 0
                 WHERE
                    loopcon = 1 AND
                    master = 0 AND
                    wid = ".$villageId.$updateCondition);
        }

        // delete all processed entries
        if (count($dbIdsToDelete)) {
            $database->query( "DELETE FROM " . TB_PREFIX . "bdata WHERE id IN(" . implode( ',', $dbIdsToDelete ) . ")" );
        }
    }

    // by SlimShady95 aka Manuel Mannhardt < manuel_mannhardt@web.de >
    private function startNatarAttack($level, $vid, $time) {
        global $database;

        // bad, but should work :D
        // I took the data from my first ww (first .org world)
        // TODO: get the algo from the real travian with the 100 biggest offs

        $troops = [5 => [[3412, 2814, 4156, 3553, 9, 0], [35, 0, 77, 33, 17, 10]],
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

        // select the troops^^
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

        // wave 1
        $ref = $database->addAttack($row['wref'], 0, $units[0][0], $units[0][1], 0, $units[0][2], $units[0][3], $units[0][4], $units[0][5], 0, 0, 0, 3, 0, 0, 0, 0, 20, 20, 0, 20, 20, 20, 20);
        $database->addMovement(3, $row['wref'], $vid, $ref, $time, $endtime);

        // wave 2
        $ref2 = $database->addAttack($row['wref'], 0, $units[1][0], $units[1][1], 0, $units[1][2], $units[1][3], $units[1][4], $units[1][5], 0, 0, 0, 3, 40, 0, 0, 0, 20, 20, 0, 20, 20, 20, 20, ['vid' => $vid, 'endtime' => ($endtime + 1)]);
        $database->addMovement(3, $row['wref'], $vid, $ref2, $time, $endtime + 1);
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

    private function getPop($tid, $level) {
        $name = "bid".$tid;
        global $$name;
        
        $dataarray = $$name;
        $pop = $dataarray[($level + 1)]['pop'];
        $cp = $dataarray[($level + 1)]['cp'];
        return [$pop, $cp];
    }

    private function delTradeRoute() {
        global $database;
     
        $database->delTradeRoute();
    }

    private function TradeRoute() {
        global $database;
        $time = time();
        $q = "SELECT `from`, wood, clay, iron, crop, wid, deliveries, id FROM ".TB_PREFIX."route where timestamp < $time";
        $dataarray = $database->query_return($q);

        $vilIDs = [];
        foreach($dataarray as $data) {
            $vilIDs[$data['to']] = true;
            $vilIDs[$data['from']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getVillageByWorldID($vilIDs);

        foreach($dataarray as $data) {
            $targettribe = $database->getUserField($database->getVillageField($data['from'], "owner"), "tribe", 0);
			$this->sendResource2($data['wood'], $data['clay'], $data['iron'], $data['crop'], $data['from'], $data['wid'], $targettribe, $data['deliveries']);
			$database->editTradeRoute($data['id'], "timestamp", 86400, 1);
        }
    }

    private function marketComplete() {
        global $database, $units;

        $time = microtime(true);
        $q = "SELECT s.wood, s.clay, s.iron, s.crop, `to`, `from`, endtime, merchant, send, moveid FROM ".TB_PREFIX."movement m, ".TB_PREFIX."send s WHERE m.ref = s.id AND m.proc = 0 AND sort_type = 0 AND endtime < $time";
        $dataarray = $database->query_return($q);

        foreach($dataarray as $data) {
            $userData_from = $database->getUserFields($database->getVillageField($data['from'], "owner"), "alliance, tribe", 0);
            $userData_to = $database->getUserFields($database->getVillageField($data['to'], "owner"), "alliance, tribe", 0);

            if($data['wood'] >= $data['clay'] && $data['wood'] >= $data['iron'] && $data['wood'] >= $data['crop']) $sort_type = 10;
            elseif($data['clay'] >= $data['wood'] && $data['clay'] >= $data['iron'] && $data['clay'] >= $data['crop']) $sort_type = 11;
            elseif($data['iron'] >= $data['wood'] && $data['iron'] >= $data['clay'] && $data['iron'] >= $data['crop']) $sort_type = 12;
            elseif($data['crop'] >= $data['wood'] && $data['crop'] >= $data['clay'] && $data['crop'] >= $data['iron']) $sort_type = 13;

            $to = $database->getMInfo($data['to']);
            $from = $database->getMInfo($data['from']);

            $ownally = $userData_from['alliance'];
            $targetally = $userData_to['alliance'];

            $database->addNotice($to['owner'],$to['wref'],$targetally,$sort_type,''.addslashes($from['name']).' send resources to '.addslashes($to['name']).'',''.$from['owner'].','.$from['wref'].','.$data['wood'].','.$data['clay'].','.$data['iron'].','.$data['crop'].'',$data['endtime']);
            if($from['owner'] != $to['owner']) {
                $database->addNotice($from['owner'],$to['wref'],$ownally,$sort_type,''.addslashes($from['name']).' send resources to '.addslashes($to['name']).'',''.$from['owner'].','.$from['wref'].','.$data['wood'].','.$data['clay'].','.$data['iron'].','.$data['crop'].'',$data['endtime']);
            }
            $database->modifyResource($data['to'],$data['wood'],$data['clay'],$data['iron'],$data['crop'],1);
            $targettribe = $userData_to["tribe"];
            $endtime = $units->getWalkingTroopsTime($data['from'], $data['to'], 0, 0, [$targettribe], 0) + $data['endtime'];
            $database->addMovement(2, $data['to'], $data['from'], $data['merchant'], time(), $endtime, $data['send'], $data['wood'], $data['clay'], $data['iron'], $data['crop']);
            $database->setMovementProc($data['moveid']);
        }

        $q1 = "SELECT send, moveid, `to`, wood, clay, iron, crop, `from` FROM ".TB_PREFIX."movement WHERE proc = 0 and sort_type = 2 and endtime < $time";
        $dataarray1 = $database->query_return($q1);

        $vilIDs = [];
        foreach($dataarray1 as $data1) {
            $vilIDs[$data1['to']] = true;
            $vilIDs[$data1['from']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getVillageByWorldID($vilIDs);

        foreach($dataarray1 as $data1) {
            $database->setMovementProc($data1['moveid']);
            if($data1['send'] > 1){
                $targettribe1 = $database->getUserFields($database->getVillageField($data1['to'],"owner"),"alliance, tribe",0)['tribe'];
                $send = $data1['send']-1;
                $this->sendResource2($data1['wood'],$data1['clay'],$data1['iron'],$data1['crop'],$data1['to'],$data1['from'],$targettribe1,$send);
            }
        }
    }

    private function sendResource2($wtrans, $ctrans, $itrans, $crtrans, $from, $to, $tribe, $send) {
        global $bid17, $bid28, $database, $units;

        $availableWood = $database->getWoodAvailable($from);
        $availableClay = $database->getClayAvailable($from);
        $availableIron = $database->getIronAvailable($from);
        $availableCrop = $database->getCropAvailable($from);
        
        if($availableWood + $availableClay + $availableIron + $availableCrop > 0)
        {
            if($availableWood < $wtrans) $wtrans = $availableWood;
            if($availableClay < $ctrans) $ctrans = $availableClay;
            if($availableIron < $itrans) $itrans = $availableIron;
            if($availableCrop < $crtrans) $crtrans = $availableCrop;          
            
            $merchant2 = ($this->getTypeLevel(17, $from) > 0)? $this->getTypeLevel(17, $from) : 0;
            $used2 = $database->totalMerchantUsed($from, false);
            $merchantAvail2 = $merchant2 - $used2;
            $maxcarry2 = ($tribe == 1)? 500 : (($tribe == 2)? 1000 : 750);
            $maxcarry2 *= TRADER_CAPACITY;
            
            if($this->getTypeLevel(28, $from) != 0) {
                $maxcarry2 *= $bid28[$this->getTypeLevel(28, $from)]['attri'] / 100;
            }
            
            $resource = [$wtrans, $ctrans, $itrans, $crtrans];
            $reqMerc = ceil((array_sum($resource) - 0.1) / $maxcarry2);
            
            if($merchantAvail2 > 0 && $reqMerc <= $merchantAvail2) {                
                if($database->getVillageState($to)) {
                    $timetaken = $units->getWalkingTroopsTime($from, $to, 0, 0, [$tribe], 0);
                    $res = $resource[0] + $resource[1] + $resource[2] + $resource[3];
                    if($res > 0){
                        $reference = $database->sendResource($resource[0], $resource[1], $resource[2], $resource[3], $reqMerc, 0);
                        $database->modifyResource($from, $resource[0], $resource[1], $resource[2], $resource[3], 0);
                        $database->addMovement(0, $from, $to, $reference, microtime(true), microtime(true) + $timetaken, $send);
                    }
                }           
            }
        }
    }

    private function resolveCatapultsDestruction(&$bdo, &$battlepart, &$info_cat, &$data, $catapultTarget, $twoRowsCatapultSetup, $isSecondRow, $catp_pic, $can_destroy, $isoasis, &$village_destroyed, $tribe) {
        global $battle, $database, $bid34;

        if(isset($catapultTarget))
        {
            //Currently targeted building/field level
            $tblevel = (int) $bdo['f'.$catapultTarget];
            //Currently targetet building/field GID (ID of the building/field type - woodcutter, cropland, embassy...)
            $tbgid = (int) $bdo['f'.$catapultTarget.'t'];
            //Currently targeted building/field ID in the database (fdata, the fID field, e.g. f1, f2, f3...)
            $tbid = (int) $catapultTarget;          
            
            //If we're targeting the WW
            if($catapultTarget == 40){
                $battlepart['catapults']['strongerBuildings'] = 1;
                $battlepart['catapults']['moraleBonus'] = 1;
            }
            
            $catapultsDamage = $battle->calculateCatapultsDamage($data['t8'],
                                                                 $battlepart['catapults']['upgrades'],                                                                											   
            											         $battlepart['catapults']['durability'],
                                                                 $battlepart['catapults']['attackDefenseRatio'],                                                               
            											         $battlepart['catapults']['strongerBuildings'],
                                                                 $battlepart['catapults']['moraleBonus']);
            
            $newLevel = $battle->calculateNewBuildingLevel($tblevel, $catapultsDamage / ($twoRowsCatapultSetup ? 2 : 1));

            //If that building was present in the building queue, we have to modify his level or remove it
            $database->modifyBData($data['to'], $tbid, [$newLevel, $tblevel], $tribe);
            
            // building/field destroyed
            if ($newLevel == 0){       
                // prepare data to be updated
                $fieldsToSet = ["f".$tbid];
                $fieldValuesToSet = [0];
                
                // update $bdo, so we don't have to reselect later
                $bdo['f'.$catapultTarget] = 0;
                
                if ($tbid >= 19 && $tbid != 99) {
                    $fieldsToSet[] = "f".$tbid."t";
                    $fieldValuesToSet[] = 0;
                    $bdo['f'.$catapultTarget."t"] = 0;
                }
                
                // update all that needs updating
                $database->setVillageLevel($data['to'], $fieldsToSet, $fieldValuesToSet);
                
                $buildarray = $GLOBALS["bid".$tbgid];

                if ( isset( $buildarray[$newLevel] ) ) {
                    // (great) warehouse level was changed
                    if ($tbgid == 10 || $tbgid == 38) {
                        $database->setMaxStoreForVillage($data['to'], $buildarray[$newLevel]['attri']);
                    }

                    // (great) granary level was changed
                    if ($tbgid == 11 || $tbgid == 39) {
                        $database->setMaxCropForVillage($data['to'], $buildarray[$newLevel]['attri']);
                    }
                }
                
                // oasis cannot be destroyed
                $pop = $this->recountPop($data['to'], false);
                if ($isoasis == 0 && $pop == 0 && $can_destroy == 1) $village_destroyed = 1;
                
                if ($isSecondRow) {
                    if ($tbid > 0) {
                        $info_cat .= "<tbody class=\"goods\"><tr><th>Information</th><td colspan=\"11\">
					<img class=\"unit u".$catp_pic."\" src=\"img/x.gif\" alt=\"Catapult\" title=\"Catapult\" /> ".$this->procResType($tbgid, $can_destroy)." <b>destroyed</b>.";
                    }
                    
                    // embassy level was changed
                    if ($tbgid == 18){
                        $info_cat .= $database->checkEmbassiesAfterBattle($data['to'], $bdo['f'.$catapultTarget], false);
                    }
                    
                    $info_cat .= "</td></tr></tbody>";
                } else {
                    $info_cat = "".$catp_pic.", ".$this->procResType($tbgid, $can_destroy)." <b>destroyed</b>.";
                    
                    // embassy level was changed
                    if ($tbgid == 18){
                        $info_cat .= $database->checkEmbassiesAfterBattle($data['to'], $bdo['f'.$catapultTarget], false);
                    }
                }
            }
            // building/field not damaged
            elseif($newLevel == $tblevel){
                if($isSecondRow) {
                    if ($tbid > 0) {
                        $info_cat .= "<tbody class=\"goods\"><tr><th>Information</th><td colspan=\"11\">
					<img class=\"unit u".$catp_pic."\" src=\"img/x.gif\" alt=\"Catapult\" title=\"Catapult\" /> ".$this->procResType($tbgid, $can_destroy)." was not damaged.</td></tr></tbody>";
                    }
                } else {
                    $info_cat = "".$catp_pic.",".$this->procResType($tbgid, $can_destroy)." was not damaged.";
                }
            }
            // building/field was damaged, let's calculate the actual damage
            else
            { 
                // update $bdo, so we don't have to reselect later
                $bdo['f'.$catapultTarget] = $newLevel;
                
                // building was damaged to a lower level
                $info_cata = " damaged from level <b>".$tblevel."</b> to level <b>".$newLevel."</b>.";
                
                $buildarray = $GLOBALS["bid".$tbgid];
                
                // (great) warehouse level was changed
                if ($tbgid == 10 || $tbgid == 38) {
                    $database->setMaxStoreForVillage($data['to'], $buildarray[$newLevel]['attri']);
                }
                
                // (great) granary level was changed
                if ($tbgid == 11 || $tbgid == 39) {
                    $database->setMaxCropForVillage($data['to'], $buildarray[$newLevel]['attri']);
                }
                
                $fieldsToSet = ["f".$tbid];
                $fieldValuesToSet = [$newLevel];
                
                $database->setVillageLevel($data['to'], $fieldsToSet, $fieldValuesToSet);
                
                // recalculate population and check if the village shouldn't be destroyed at this point
                $pop = $this->recountPop($data['to'], false);
                if ($isoasis == 0) {
                    if($pop == 0 && $can_destroy == 1) $village_destroyed = 1;
                }
                
                if ($isSecondRow) {
                    $info_cat .= "<tbody class=\"goods\"><tr><th>Information</th><td colspan=\"11\">
					<img class=\"unit u".$catp_pic."\" src=\"img/x.gif\" alt=\"Catapult\" title=\"Catapult\" /> ".$this->procResType($tbgid, $can_destroy).$info_cata;
                    
                    // embassy level was changed
                    if ($tbgid == 18) {
                        $info_cat .= $database->checkEmbassiesAfterBattle($data['to'], $bdo['f'.$catapultTarget], false);
                    }
                    
                    $info_cat .= "</td></tr></tbody>";
                } else {
                    $info_cat = "" . $catp_pic . "," . $this->procResType($tbgid, $can_destroy).$info_cata;
                    
                    // embassy level was changed
                    if ($tbgid == 18) {
                        $info_cat .= $database->checkEmbassiesAfterBattle($data['to'], $bdo['f'.$catapultTarget], false);
                    }
                }
            }
        }else{
            if(!isset($info_cat) || empty($info_cat) || $info_cat == ","){
                $info_cat = "".$catp_pic.", There are no buildings left to destroy";
            }else if(strpos($info_cat, "There are no buildings left") === false){
                $info_cat .= "<tbody class=\"goods\"><tr><th>Information</th><td colspan=\"11\">
                          <img class=\"unit u".$catp_pic."\" src=\"img/x.gif\" alt=\"Catapult\" title=\"Catapult\" /> There are no buildings left to destroy.</td></tr></tbody>";
            }       
        }
    }

    private function sendunitsComplete() {
        global $bid19, $bid23, $bid34, $u99, $database, $battle, $technology, $units;

        $time = time();
        $q = "
            SELECT
                `from`, `to`, endtime, ref, ctar1, ctar2, spy, moveid, attack_type,
                t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, (SELECT oasistype FROM ".TB_PREFIX."wdata WHERE id = `to`) as oasistype
            FROM
                ".TB_PREFIX."movement,
                ".TB_PREFIX."attacks
            WHERE
                ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id
                AND
                ".TB_PREFIX."movement.proc = 0
                AND
                ".TB_PREFIX."movement.sort_type = 3
                AND
                ".TB_PREFIX."attacks.attack_type != 2
                AND
                endtime < $time
            ORDER BY endtime ASC";
        $dataarray = $database->query_return($q);
        $totalattackdead = $data_num = 0;

        if ($dataarray && count($dataarray)) {
            // preload village data
            $vilIDs = [];
            foreach($dataarray as $data) {
                $vilIDs[$data['from']] = true;
                $vilIDs[$data['to']] = true;
            }
            $vilIDs = array_keys($vilIDs);
            $database->getProfileVillages($vilIDs, 5);
            $database->getUnit($vilIDs);
            $database->getEnforceVillage($vilIDs, 0);
            $database->getMovement(34, $vilIDs, 1);
            $database->getABTech($vilIDs);

            // calculate battles
            foreach($dataarray as $data) {
                //set base things
                $isoasis = $data['oasistype'];
                $AttackArrivalTime = $data['endtime'];
                $AttackerWref = $data['from'];
                $DefenderWref = $data['to'];
                $NatarCapital = false;

                $Attacker['id'] = $database->getUserArray($database->getVillageField($data['from'],"owner"), 1)["id"];
                $AttackerID = $Attacker['id'];
                $owntribe = $database->getUserArray($database->getVillageField($data['from'],"owner"), 1)["tribe"];
                $ownally = $database->getUserArray($database->getVillageField($data['from'],"owner"), 1)["alliance"];
                $from = $database->getMInfo($data['from']);
                $fromF = $database->getVillage($data['from']);

                //It's a village
                if ($isoasis == 0){
                    $DefenderUserData = $database->getUserArray($database->getVillageField($data['to'],"owner"), 1);
                    $Defender['id'] = $DefenderUserData["id"];
                    $DefenderID = $Defender['id'];
                    $targettribe = $DefenderUserData["tribe"];
                    $targetally = $DefenderUserData["alliance"];
                    $to = $database->getMInfo($data['to']);
                    $toF = $database->getVillage($data['to']);
                    $conqureby = 0;
					$NatarCapital = ($toF['owner'] == 3 && $toF['capital'] == 1);
					if(!isset($to['name']) || empty($to['name'])) $to['name'] = "[?]";

                    $DefenderUnit = [];
					$DefenderUnit = $database->getUnit($data['to']);
					$evasion = $toF["evasion"];
					$maxevasion = $DefenderUserData["maxevasion"];
					$gold = $DefenderUserData["gold"];
					$playerunit = (($targettribe - 1) * 10);
					$cannotsend = false;
					
					$movements = $database->getMovement(34, $data['to'], 1);
					for($y = 0; $y < count($movements); $y++){
						if(property_exists($units, $y)){
							$returntime = $units->$y['endtime'] - time();
							if($units->$y['sort_type'] == 4 && $units->$y['from'] != 0 && $returntime <= 10){
								$cannotsend = true;
							}
						}
					}

                    if($evasion == 1 && $maxevasion > 0 && $gold > 1 && !$cannotsend && $dataarray[$data_num]['attack_type'] > 2){
                        $evaded = true;
                        $totaltroops = 0;
                        $evasionUnitModifications_units = [];
                        $evasionUnitModifications_amounts = [];
                        $evasionUnitModifications_modes = [];
                        for($i = 1; $i <= 10; $i++){
							$playerunit += $i;
							$data['u' . $i] = $DefenderUnit['u' . $playerunit];
							$evasionUnitModifications_units[] = $playerunit;
							$evasionUnitModifications_amounts[] = $DefenderUnit['u' . $playerunit];
							$evasionUnitModifications_modes[] = 0;
							$playerunit -= $i;
							$totaltroops += $data['u' . $i];
						}

                        $data['u11'] = $DefenderUnit['hero'];
                        $totaltroops += $data['u11'];
                        if($totaltroops > 0){
                            $evasionUnitModifications_units[] = 'hero';
                            $evasionUnitModifications_amounts[] = $DefenderUnit['hero'];
                            $evasionUnitModifications_modes[] = 0;

                            $attackid = $database->addAttack($data['to'], $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $data['u11'], 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
							$database->addMovement(4, 0, $data['to'], $attackid, microtime(true), microtime(true) + (180 / EVASION_SPEED));
							$newgold = $gold - 2;
							$newmaxevasion = $maxevasion - 1;
							$database->updateUserField($DefenderID, ["gold", "maxevasion"], [$newgold, $newmaxevasion], 1);
                        }

                        // modify units in DB
                        $database->modifyUnit($data['to'], $evasionUnitModifications_units, $evasionUnitModifications_amounts, $evasionUnitModifications_modes);
                    }
                    
                    //get defence units
                    $enforDefender = [];
                    $rom = $ger = $gal = $nat = $natar = 0;
                    $Defender = $database->getUnit($data['to'], false);
                    $enforcementarray = $database->getEnforceVillage($data['to'], 0);
                    
                    if(count($enforcementarray) > 0) {
                        foreach($enforcementarray as $enforce) {
                            for($i = 1; $i <= 50; $i++){
								if(!isset($enforDefender['u'.$i])){
									$enforDefender['u'.$i] = 0;
								}
								$enforDefender['u'.$i] += $enforce['u'.$i];
							}

                            if (!isset($enforDefender['hero'])) {
                                $enforDefender['hero'] = 0;
                            }
                            $enforDefender['hero'] += $enforce['hero'];
                        }
                    }
                    
                    for($i = 1; $i <= 50; $i++){
                        $def_ab[$i] = 0;
                        if(!isset($Defender['u'.$i]) || empty($Defender['u'.$i]) || $Defender['u'.$i] < 0) {
                            $Defender['u'.$i] = 0;                                                  
                        }
                    }
                    
                    if(!isset($Defender['hero']) || empty($Defender['hero']) || $Defender['hero'] < 0) {
                        $Defender['hero'] = 0;            
                    }

                    //get attack units
                    $Attacker = [];
                    $start = ($owntribe - 1) * 10 + 1;
                    $end = $owntribe * 10;
                    $u = ($owntribe - 1) * 10;
                    $catapult = [8, 18, 28, 48];
                    $ram = [7, 17, 27, 47];
                    $chief = [9, 19, 29, 49];
                    $spys = [4, 14, 23, 44];
                    for($i = $start; $i <= $end; $i++) {
                        $y = $i - $u;
                        $Attacker['u'.$i] = $dataarray[$data_num]['t'.$y];
                        //there are catas
                        if(in_array($i, $catapult)) $catp_pic = $i;
                        if(in_array($i, $ram)) $ram_pic = $i;
                        if(in_array($i, $chief)) $chief_pic = $i;
                        if(in_array($i, $spys)) $spy_pic = $i;
                    }
                    $Attacker['uhero'] = $dataarray[$data_num]['t11'];
                    $hero_pic = "hero";
                    
                    //need to set these variables.
                    $def_wall = $database->getFieldLevel($data['to'], 40, false);
                    $att_tribe = $owntribe;
                    $def_tribe = $targettribe;
                    $attpop = $defpop = $residence = 0;
                    $def_ab = [];
                    
                    //get level of palace or residence
                    $residence = $database->getFieldLevelInVillage($data['to'], '25, 26', false);

                    //type of attack
                    $type = $dataarray[$data_num]['attack_type'];
                    if($type == 1) $scout = 1;
                    
                    $ud = ($def_tribe - 1) * 10;
                    $att_ab = $database->getABTech($data['from']); // Blacksmith level
                    $att_ab1 = $att_ab['b1'];
                    $att_ab2 = $att_ab['b2'];
                    $att_ab3 = $att_ab['b3'];
                    $att_ab4 = $att_ab['b4'];
                    $att_ab5 = $att_ab['b5'];
                    $att_ab6 = $att_ab['b6'];
                    $att_ab7 = $att_ab['b7'];
                    $att_ab8 = $att_ab['b8'];
                    $armory = $database->getABTech($data['to']); // Armory level
                    $def_ab[$ud + 1] = $armory['a1'];
                    $def_ab[$ud + 2] = $armory['a2'];
                    $def_ab[$ud + 3] = $armory['a3'];
                    $def_ab[$ud + 4] = $armory['a4'];
                    $def_ab[$ud + 5] = $armory['a5'];
                    $def_ab[$ud + 6] = $armory['a6'];
                    $def_ab[$ud + 7] = $armory['a7'];
                    $def_ab[$ud + 8] = $armory['a8'];

                    //rams attack
                    if (($data['t7']) > 0 && $type == 3) {
                        $basearraywall = $to;
                        if (($walllevel = $database->getFieldLevel($basearraywall['wref'], 40, false)) > 0){
                            $wallgid = $database->getFieldLevel($basearraywall['wref'],"40t");
                            $wallid = 40;
                            $w = 4;
                        }
                    }

                    $tblevel = 1;
                    $stonemason = $database->getFieldLevelInVillage($data['to'], 34);

                }else{ //It's an oasis
                	
                    $DefenderUserData = $database->getUserArray($database->getOasisField($data['to'], "owner"), 1);
					$Defender['id'] = $DefenderUserData["id"];
					$DefenderID = $Defender['id'];
					$targettribe = $DefenderUserData["tribe"];
					$targetally = $DefenderUserData["alliance"];
					$to = $database->getOMInfo($data['to']);
					$toF = $database->getOasisV($data['to']);
					$conqureby = $toF['conqured'];
                    //get defence units
                    $enforDefender = [];
                    $rom = $ger = $gal = $nat = $natar = 0;
                    $Defender = $database->getUnit($data['to'], false);
                    $enforcementarray = $database->getEnforceVillage($data['to'],0);

                    if(count($enforcementarray) > 0) {
                        foreach($enforcementarray as $enforce) {
                            for($i = 1;$i <= 50; $i++) {
                                $enforDefender['u'.$i] += $enforce['u'.$i];
                            }
                            $enforDefender['hero'] += $enforce['hero'];
                        }
                    }
                    
                    for($i = 1; $i <= 50; $i++){
                        if(!isset($Defender['u'.$i]) || empty($Defender['u'.$i]) || $Defender['u'.$i] < 0) {
                            $Defender['u'.$i] = 0;                
                        }
                    }
                    
                    if(!isset($Defender['hero']) || empty($Defender['hero']) || $Defender['hero'] < 0) {
                        $Defender['hero'] = 0;                
                    }

                    //get attack units
                    $Attacker = [];
                    $start = ($owntribe - 1) * 10 + 1;
                    $end = $owntribe * 10;
                    $u = ($owntribe - 1) * 10;
                    $catapult = [8, 18, 28, 38, 48];
                    $ram = [7, 17, 27, 37, 47];
                    $chief = [9, 19, 29, 39, 49];
                    $spys = [4, 14, 23, 44];
                    for($i = $start; $i <= $end; $i++) {
                        $y = $i - $u;
                        $Attacker['u'.$i] = $dataarray[$data_num]['t'.$y];
                        //there are catas
                        if(in_array($i, $catapult)) $catp_pic = $i;                       
                        if(in_array($i, $ram)) $ram_pic = $i;                                                
                        if(in_array($i, $chief)) $chief_pic = $i;       
                        if(in_array($i, $spys)) $spy_pic = $i;
                    }
                    $Attacker['uhero'] = $dataarray[$data_num]['t11'];
                    $hero_pic = "hero";
                    
                    //need to set these variables.
                    $def_wall = $residence = $attpop = 0;
                    $att_tribe = $owntribe;
                    $def_tribe = $targettribe;
                    $defpop = 500;

                    //type of attack
                    $type = $dataarray[$data_num]['attack_type'];
                    if($type == 1) $scout = 1;

                    $att_ab1 = $att_ab2 = $att_ab3 = $att_ab4 = $att_ab5 = $att_ab6 = $att_ab7 = $att_ab8 = 0;
                    $def_ab[31] = $def_ab[32] = $def_ab[33] = $def_ab[34] = $def_ab[35] = $def_ab[36] = $def_ab[37] = $def_ab[38] = 0;

                    $walllevel = $tblevel = $stonemason = 0;
                }

                $varray = $database->getProfileVillages($to['owner'], 0, false);

                if ($to['owner'] == $from['owner']) $varray1 = $varray;         
                else $varray1 = $database->getProfileVillages($from['owner'], 0, false);            
                
                // total population of the defender
                if($isoasis == 0){
                	foreach($varray as $defenderVillage) $defpop += $defenderVillage['pop'];
                }       
                
                // total population of the attacker
                foreach($varray1 as $attackerVillage) $attpop += $attackerVillage['pop'];          

                //fix by ronix
                for ($i = 1; $i <= 50; $i++) {
                    if (!isset($enforDefender['u'.$i])) {
                        $enforDefender['u'.$i] = 0;
                    }
                    $enforDefender['u'.$i] += (isset($Defender['u'.$i]) ? $Defender['u'.$i] : 0);
                }

                $defspy = $enforDefender['u4'] > 0 || $enforDefender['u14'] > 0 || $enforDefender['u23'] > 0 || $enforDefender['u44'] > 0;

                if(PEACE == 0 || $targettribe == 4 || $targettribe == 5 || $scout){
                    if($targettribe == 1) $def_spy = $enforDefender['u4'];                       
                    elseif($targettribe == 2) $def_spy = $enforDefender['u14'];                      
                    elseif($targettribe == 3) $def_spy = $enforDefender['u23'];                      
                    elseif($targettribe == 5) $def_spy = $enforDefender['u44'];

                    //impossible to attack or scout NATAR Capital Village
                    if ($NatarCapital){
                        for($i = 1; $i <= 11; $i++) ${'traped'.$i} = $data['t'.$i];
                    }
                    elseif(empty($scout))
                    {
                        $traps = max($Defender['u99'] - $Defender['u99o'], 0);
                        
                        $totalTroops = 0;
                        for($i = 1; $i <= 11; $i++) $totalTroops += $data['t'.$i];               
                        
                        if($traps >= $totalTroops){
                            for($i = 1; $i <= 11; $i++) ${'traped'.$i} = $data['t'.$i];
                        }
                        else
                        {
                            $multiplier = $traps / $totalTroops;
                            
                            //The hero is excluded, because it can be only trapped if traps > totalTroops
                            for($i = 1; $i <= 10; $i++){
                                $trappedUnits = intval($data['t'.$i] * $multiplier);
                                ${'traped'.$i} = $trappedUnits;
                                $traps -= $trappedUnits;
                            }

                            while($traps > 0){
                                //There are some traps left, let's distribute them
                                for($i = 1; $i <= 10 && $traps > 0; $i++){
                                    if($data['t'.$i] != 0){
                                        ${'traped'.$i}++;
                                        $traps--;
                                    }
                                }
                            }
                        }
                    }
                    
                    if(empty($scout) || $NatarCapital){
                        for ($i = 1; $i <= 11; $i++){
                            if (!isset(${'traped'.$i})) ${'traped'.$i} = 0;
                            if ( !isset($totaltraped_att) ) {
                                $totaltraped_att = 0;
                            }
                            $totaltraped_att += ${'traped'.$i};
                        }
                        
                        $database->modifyUnit($data['to'], ["99o"], [$totaltraped_att], [1]);
                        
                        for($i = $start; $i <= $end; $i++){
                            $j = $i-$start+1;
                            $Attacker['u'.$i] -= ${'traped'.$j};
                        }
                        $Attacker['uhero'] -= $traped11;
                        
                        if($totaltraped_att > 0){
                            $prisoners2 = $database->getPrisoners2($data['to'], $data['from'], false);
                            if(empty($prisoners2)){
                                $database->addPrisoners($data['to'],$data['from'],$traped1,$traped2,$traped3,$traped4,$traped5,$traped6,$traped7,$traped8,$traped9,$traped10,$traped11);
                            }else{
                                $database->updatePrisoners($data['to'],$data['from'],$traped1,$traped2,$traped3,$traped4,$traped5,$traped6,$traped7,$traped8,$traped9,$traped10,$traped11);
                            }
                        }
                    }
                    
                    // we need to save the attacker heroid before the battle
                    if(isset($Attacker['uhero']) && $Attacker['uhero'] > 0){
                        $AttackerHeroID = $database->getHeroField($from['owner'], "heroid");
                    }
                    
                    // and the defender(s) heroid
                    $DefendersHeroID = [];
                    $herosend_def = 0;
                    
                    // check if our hero is defending the village, if so, add it to the list
                    if (isset($Defender['hero']) && $Defender['hero'] > 0) {                        
                        $DefendersHeroID[] = $database->getHeroField($DefenderID, "heroid");
                        
                        // collecting information for the battle report
                        $herosend_def += $Defender['hero'];
                    }

                    // check if there are other heroes defending the village
                    if(count($enforcementarray) > 0){
                        foreach($enforcementarray as $enforcement){
                            if($enforcement['hero'] > 0){
                                $heroOwner = $database->getVillageField($enforcement['from'], "owner");
                                $DefendersHeroID[] = $database->getHeroField($heroOwner, "heroid");
                            }                          
                        }
                    }

                    //fix by ronix
                    if (!isset($walllevel)) $walllevel = 0;

                    $battlepart = $battle->calculateBattle($Attacker, $Defender, $def_wall, $att_tribe, $def_tribe, $residence, $attpop, $defpop, $type, $def_ab, $att_ab1, $att_ab2, $att_ab3, $att_ab4, $att_ab5, $att_ab6, $att_ab7, $att_ab8, $tblevel, $stonemason, $walllevel, 0, 0, 0, $AttackerID, $DefenderID, $AttackerWref, $DefenderWref, $conqureby, $enforcementarray);

                    //Data for when troops return.
                    //catapults look :D
                    $info_cat = $info_chief = $info_ram = $info_hero = ",";
                    
                    //check to see if can destroy village
                    if (count($varray) > 1 && !$database->villageHasArtefact($DefenderWref) && !$to['natar']) {
                    	$can_destroy = 1;
                    }
                    else $can_destroy = 0;
                    
                    //Catapults and rams management
                    //TODO: Move this in Battle.php
                    if($isoasis == 0){
                    	if ($type == 3){
                    		if (($data['t7'] - $traped7) > 0){
                    			if($walllevel > 0){
                    			    $ramsDamage = $battle->calculateCatapultsDamage($data['t7'],
                    			                                                    $battlepart['rams']['upgrades'], 
                    			                                                    $battlepart['rams']['durability'], 
                    			                                                    $battlepart['rams']['attackDefenseRatio'], 
                    			                                                    $battlepart['rams']['strongerBuildings'], 
                    			                                                    $battlepart['rams']['moraleBonus']);
                    				$newLevel = $battle->calculateNewBuildingLevel($walllevel, $ramsDamage);
                    				
                    				if ($newLevel == 0){
                    					$info_ram = "".$ram_pic.",Wall <b>destroyed</b>.";
                    					$database->setVillageLevel($data['to'], ["f".$wallid, "f".$wallid."t"], [0, 0]);
                    					$pop = $this->recountPop($data['to']);
                    				}elseif ($newLevel == $walllevel){
                    					$info_ram = "".$ram_pic.",Wall was not damaged.";
                    				}else{
                    					$info_ram = "".$ram_pic.",Wall damaged from level <b>".$walllevel."</b> to level <b>".$newLevel."</b>.";
                    					$database->setVillageLevel($data['to'],"f".$wallid."",$newLevel);
                    				}
                    				
                    				//If the wall got damaged/destroyed during the attack
                    				//we need to recalculate the whole battle
                    				if($newLevel != $walllevel){
                    					$battlepart = $battle->calculateBattle($Attacker, $Defender, $newLevel, $att_tribe, $def_tribe, $residence, $attpop, $defpop, $type, $def_ab, $att_ab1, $att_ab2, $att_ab3, $att_ab4, $att_ab5, $att_ab6, $att_ab7, $att_ab8, $tblevel, $stonemason, $newLevel, 0, 0, 0, $AttackerID, $DefenderID, $AttackerWref, $DefenderWref, $conqureby, $enforcementarray);
                    				}
                    			}
                    			else $info_ram = "".$ram_pic.",There is no wall to destroy.";
                    		}
                    		
                    		if (($data['t8'] - $traped8) > 0)
                    		{
                    			$pop = $this->recountPop($data['to']);
                    			
                    			// village has been destroyed
                    			if ($pop <= 0) {
                    				if ($can_destroy == 1) $info_cat = "".$catp_pic.", Village already destroyed.";
                    				else $info_cat = "".$catp_pic.", Village can\'t be destroyed.";
                    			}
                    			else
                    			{
                    				// village stands, let's do the damage
                    				/**
                    				 * FIRST CATAPULTS ROW
                    				 */
                    				
                    				$basearray = $data['to'];
                    				$bdo = $database->getResourceLevel($basearray, false);
                    				$catapultTarget = $data['ctar1'];
                    				$catapultTarget2 = (isset($data['ctar2']) ? $data['ctar2'] : 0);
                    				
                    				$catapults1TargetRandom = ($catapultTarget == 0);
                    				$catapults2WillNotShoot = ($catapultTarget2 == 0);
                    				$catapults2TargetRandom = ($catapults2WillNotShoot || $catapultTarget2 == 99);
                    				
                    				// we're manually targetting 1st and/or 2nd row of catapults
                    				if (!$catapults1TargetRandom)
                    				{
                    					$_catapultsTarget1Levels = [];
                    					$__catapultsTarget1AltTargets = [];
                    					
                    					// calculate targets for 1st rows of catapults
                    					$j = 0;
                    					for ($i = 1; $i <= 41; $i++)
                    					{
                    						if ($i == 41) $i = 99;
                    						
                    						// 1st row of catapults pre-selected target calculations, if needed
                    						if (!$catapults1TargetRandom && $bdo['f'.$i.'t'] == $catapultTarget && $bdo['f'.$i] > 0 && $i != 40)
                    						{
                    							$j++;
                    							$_catapultsTarget1Levels[$j]=$bdo['f'.$i];
                    							$__catapultsTarget1AltTargets[$j]=$i;
                    						}
                    					}
                    					
                    					// if we couldn't find a suitable target for 1st row of catapults,
                    					// select a random target instead
                    					if (!$catapults1TargetRandom) {
                    						if ( count( $_catapultsTarget1Levels ) > 0 ) {
                    							if ( max( $_catapultsTarget1Levels ) <= 0 ) {
                    								$catapultTarget = 0;
                    							} else {
                    								$catapultTarget = $__catapultsTarget1AltTargets[rand( 1, $j )];
                    							}
                    						} else {
                    							$catapultTarget = 0;
                    							$catapults1TargetRandom = true;
                    						}
                    					}
                    				}
                    				
                    				// 1st row of catapults set to target randomly
                    				if ($catapults1TargetRandom)
                    				{
                    					$list = [];
                    					for ($i = 1; $i <= 41; $i++)
                    					{
                    						if ($i == 41) $i = 99;
                    						if ($bdo['f'.$i] > 0 && $i != 40) $list[] = $i;
                    					}
                    					$catapultTarget = $list[rand(0, count($list) - 1)];
                    				}
                    				
                    				/**
                    				 * resolve 1st row of catapults
                    				 */
                    				$village_destroyed = 0;
                    				$this->resolveCatapultsDestruction($bdo, $battlepart, $info_cat, $data, $catapultTarget, !$catapults2WillNotShoot, false, $catp_pic, $can_destroy, $isoasis, $village_destroyed, $targettribe);
                    				
                    				/**
                    				 * SECOND CATAPULTS ROW
                    				 */
                    				
                    				// we're manually targetting 2nd row of catapults
                    				if (!$catapults2TargetRandom)
                    				{
                    					$_catapultsTarget2Levels = [];
                    					$__catapultsTarget2AltTargets = [];
                    					
                    					// calculate targets for 2nd rows of catapults
                    					$j = 0;
                    					for ($i = 1; $i <= 41; $i++)
                    					{
                    						if ($i == 41) $i = 99;
                    						
                    						// 2nd row of catapults pre-selected target calculations, if needed
                    						if (!$catapults2TargetRandom && !$catapults2WillNotShoot && $bdo['f'.$i.'t'] == $catapultTarget2 && $bdo['f'.$i] > 0 && $i != 40)
                    						{
                    							$j++;
                    							$_catapultsTarget2Levels[$j] = $bdo['f'.$i];
                    							$__catapultsTarget2AltTargets[$j] = $i;
                    						}
                    					}
                    					
                    					// if we couldn't find a suitable target for 2nd row of catapults,
                    					// select a random target instead
                    					if (!$catapults2TargetRandom) {
                    						if (count($_catapultsTarget2Levels) > 0 ) {
                    							if (max($_catapultsTarget2Levels) <= 0 ) {
                    								$catapultTarget2 = 99;
                    							}
                    							else $catapultTarget2 = $__catapultsTarget2AltTargets[rand( 1, $j )];
                    						} else {
                    							$catapultTarget2 = 99;
                    							$catapults2TargetRandom = true;
                    						}
                    					}
                    				}
                    				
                    				// 2nd row of catapults set to target randomly
                    				if ($catapults2TargetRandom && !$catapults2WillNotShoot)
                    				{
                    					$list = [];
                    					for ($i = 1; $i <= 41; $i++)
                    					{
                    						if ($i == 41) $i = 99;
                    						if ($bdo['f'.$i] > 0 && $i != 40) $list[] = $i;
                    					}
                    					$catapultTarget2 = $list[ rand(0, count($list) - 1) ];
                    				}
                    				
                    				/**
                    				 * resolve 2nd row of catapults
                    				 */
                    				if (!$catapults2WillNotShoot) {
                    					$this->resolveCatapultsDestruction($bdo, $battlepart, $info_cat, $data, $catapultTarget2, true, true, $catp_pic, $can_destroy, $isoasis, $village_destroyed, $targettribe);
                    				}
                    				
                    				// clear resource levels cache, since we might have destroyed buildings/fields by now
                    				call_user_func(get_class($database).'::clearResourseLevelsCache');
                    			}
                    		}
                    	} elseif (($data['t7'] - $traped7) > 0) {
                    		$info_ram = "".$ram_pic.",Hint: The ram does not work during a raid.";
                    	}
                    }
                    else $can_destroy = 0;  
                    
                    //units attack string for battleraport
                    $unitssend_att = ''.$data['t1'].','.$data['t2'].','.$data['t3'].','.$data['t4'].','.$data['t5'].','.$data['t6'].','.$data['t7'].','.$data['t8'].','.$data['t9'].','.$data['t10'].'';
                    $herosend_att = $data['t11'];
                   
                    if ($herosend_att > 0) $unitssend_att_check = $unitssend_att.','.$data['t11'];      
                    else  $unitssend_att_check = $unitssend_att;            

                    //Resetting the enforcement arrays
                    for($i = 1; $i <= 50; $i++) { 
                        $DefenderEnf['u'.$i] = 0;
                        if($i <= 5){
                            $DefenderHeroesTotArray[$i] = 0;
                            $DefenderHeroesDeadArray[$i] = 0;
                        }     
                    }
                    
                    // our reinforcements count could have changed at this point, thus the re-select
                    $enforcementarray2 = $database->getEnforceVillage($data['to'], 0);
                    if(count($enforcementarray2) > 0) {
                        foreach($enforcementarray2 as $enforce2) {                           
                            for($i = 1; $i <= 50; $i++) {
                                $DefenderEnf['u'.$i] += $enforce2['u'.$i];
                            }                     
                            
                            //Divide heroes by tribe
                            if($enforce2['hero'] > 0) {
                                $reinfTribe = ($enforce2['from'] == 0) ? 4 : $database->getUserField($database->getVillageField($enforce2['from'], "owner"), "tribe", 0);
                                $DefenderHeroesTotArray[$reinfTribe] += $enforce2['hero'];
                                $Defender['hero'] += $enforce2['hero'];
                            }
                        }         
                    }
                    
                    $totalsend_alldef = 0;
                    $unitssend_def = [];
                    
                    //Own troops     
                    $ownTroops = array_slice($Defender, ($targettribe - 1) * 10 + 1, 10);
                    $totalsend_alldef = array_sum($ownTroops);
                    
                    //Collecting informations for the report
                    $unitssend_def[0] = implode(",", $ownTroops);               
                    $unitssend_deff[0] = '?,?,?,?,?,?,?,?,?,?,';
                     
                    for($i = 1; $i <= 5; $i++){
                        //Reinforcements
                        $reinfTroops = array_slice($DefenderEnf, ($i - 1) * 10, 10);
                        $totalsend_alldef += array_sum($reinfTroops);
                        
                        //Collecting informations for the report
                        $unitssend_def[$i] = implode(",", $reinfTroops);
                        $unitssend_deff[$i] = $unitssend_deff[0];
                    }
                    $totalsend_alldef += $Defender['hero'];

                    #################################################
                    ################FIXED BY SONGER################
                    #################################################

                    for($i = 1; $i <= 11; $i++){
                        //MUST TO BE FIX : This is only for defender and still not properly coded
                        if (isset($battlepart['casualties_attacker']) && isset($battlepart['casualties_attacker'][$i]) && $battlepart['casualties_attacker'][$i] <= 0) {
                            ${'dead'.$i} = 0;
                        } else if (isset($data['t'.$i]) && isset($battlepart['casualties_attacker']) && isset($battlepart['casualties_attacker'][$i]) && $battlepart['casualties_attacker'][$i] > $data['t'.$i]) {
                            ${'dead'.$i} = $data['t'.$i];
                        } else {
                            ${'dead'.$i} = (isset($battlepart['casualties_attacker']) && isset($battlepart['casualties_attacker'][$i]) ? $battlepart['casualties_attacker'][$i] : 0);
                        }
                    }

                    #################################################

                    $dead = [];
                    $owndead = [];
                    $alldead = [];
                    
                    for($i = 1; $i <= 50; $i++) $alldead[$i] = 0;
                    $heroAttackDead = $dead11;
                    
                    //kill own defence
                    $unitlist = $database->getUnit($data['to'], false);
                    $start = ($targettribe-1)*10+1;
                    $end = ($targettribe*10);

                    if ($targettribe == 1) $u = "";                    
                    else $u = $targettribe - 1;

                    $unitModifications_units = [];
                    $unitModifications_amounts = [];
                    $unitModifications_modes = [];
                    for ($i = $start; $i <= $end; $i++) {
                        if($i == $end) {
                            $u = $targettribe;
                        }

                        if($unitlist){
                            $owndead[$i] = round($battlepart[2] * $unitlist['u'.$i]);
                            $unitModifications_units[] = $i;
                            $unitModifications_amounts[] = $owndead[$i];
                            $unitModifications_modes[] = 0;
                        }
                    }

                    $owndead['hero'] = 0;

                    if($unitlist){
                        $owndead['hero'] = (isset($battlepart['deadherodef']) ? $battlepart['deadherodef'] : '');

                        $unitModifications_units[] = 'hero';
                        $unitModifications_amounts[] = $owndead['hero'];
                        $unitModifications_modes[] = 0;
                    }

                    // modify units in DB
                    $database->modifyUnit($data['to'], $unitModifications_units, $unitModifications_amounts, $unitModifications_modes);

                    //kill other defence in village
                    // ... once again, units could have changed, so we need to reselect
                    $enforcementarray3 = $database->getEnforceVillage($data['to'],0);
                    foreach ($enforcementarray3 as $enforce) {
                        $life=''; $notlife=''; $wrong = false;
                        if($enforce['from'] != 0){
                            $tribe = $database->getUserArray($database->getVillageField($enforce['from'],"owner"), 1)["tribe"];
                        }
                        else $tribe = 4;                           
                        
                        $start = ($tribe - 1) * 10 + 1;
                        $end = ($tribe * 10);
                        unset($dead);

                        switch($tribe)
                        {
                            case 1: $rom = 1; break;
                            case 2: $ger = 1; break;
                            case 3: $gal = 1; break;
                            case 4: $nat = 1; break;                          
                            case 5: 
                            default: $natar = 1; break;                      
                        }

                        $enforceModificationsById = [];                                      
                        for ($i = $start; $i <= $end; $i++){
                            if($enforce['u'.$i]>'0'){
                                if (!isset($enforceModificationsById[$enforce['id']])) {
                                    $enforceModificationsById[$enforce['id']] = [
                                        'units' => [],
                                        'amounts' => [],
                                        'modes' => []
                                    ];
                                }
                                $enforceModificationsById[$enforce['id']]['units'][] = $i;
                                $enforceModificationsById[$enforce['id']]['amounts'][] = (isset($battlepart[2]) ? round($battlepart[2]*$enforce['u'.$i]) : 0);
                                $enforceModificationsById[$enforce['id']]['modes'][] = 0;
                                $dead[$i] = (isset($battlepart[2]) ? round($battlepart[2]*$enforce['u'.$i]) : 0);
                                $checkpoint = (isset($battlepart[2]) ? round($battlepart[2]*$enforce['u'.$i]) : 0);

                                if (!isset($enforce['u'.$i])) $enforce['u'.$i] = 0;
                                
                                $alldead[$i] += $dead[$i];                           

                                $wrong = $checkpoint != $enforce['u'.$i];
                            } 
                            else $dead[$i] = 0;
                        }

                        if($enforce['hero'] > 0) {
                            $enforceModificationsById[$enforce['id']]['units'][] = 'hero';
                            $enforceModificationsById[$enforce['id']]['amounts'][] = $battlepart['deadheroref'][$enforce['id']];
                            $enforceModificationsById[$enforce['id']]['modes'][] = 0;

                            $dead['hero'] = $battlepart['deadheroref'][$enforce['id']];
                            $alldead['hero'] += $dead['hero'];
                            $wrong = $dead['hero'] != $enforce['hero'];
                            
                            //Collecting information for the report
                            $reinfTribe = ($enforce['from'] == 0) ? 4 : $database->getUserField($database->getVillageField($enforce['from'], "owner"), "tribe", 0);
                            $DefenderHeroesDeadArray[$reinfTribe] += $dead['hero'];                     
                        }

                        // modify enforce in DB
                        foreach ($enforceModificationsById as $enforceId => $enforceArray) {
                            $database->modifyEnforce( $enforceId, $enforceArray['units'], $enforceArray['amounts'], $enforceArray['modes']);
                        }

                        $notlife= ''.$dead[$start].','.$dead[$start+1].','.$dead[$start+2].','.$dead[$start+3].','.$dead[$start+4].','.$dead[$start+5].','.$dead[$start+6].','.$dead[$start+7].','.$dead[$start+8].','.$dead[$start+9].'';
                        $notlife1 = $dead[$start]+$dead[$start+1]+$dead[$start+2]+$dead[$start+3]+$dead[$start+4]+$dead[$start+5]+$dead[$start+6]+$dead[$start+7]+$dead[$start+8]+$dead[$start+9];
                        $life= ''.$enforce['u'.$start.''].','.$enforce['u'.($start+1).''].','.$enforce['u'.($start+2).''].','.$enforce['u'.($start+3).''].','.$enforce['u'.($start+4).''].','.$enforce['u'.($start+5).''].','.$enforce['u'.($start+6).''].','.$enforce['u'.($start+7).''].','.$enforce['u'.($start+8).''].','.$enforce['u'.($start+9).''].'';
                        $life1 = $enforce['u'.$start.'']+$enforce['u'.($start+1).'']+$enforce['u'.($start+2).'']+$enforce['u'.($start+3).'']+$enforce['u'.($start+4).'']+$enforce['u'.($start+5).'']+$enforce['u'.($start+6).'']+$enforce['u'.($start+7).'']+$enforce['u'.($start+8).'']+$enforce['u'.($start+9).''];
                        $lifehero = (isset($enforce['hero']) ? $enforce['hero'] : 0);
                        $notlifehero = (isset($dead['hero']) ? $dead['hero'] : 0);
                        $totallife = (isset($enforce['hero']) ? $enforce['hero'] : 0)+$life1;
                        $totalnotlife = (isset($dead['hero']) ? $dead['hero'] : 0)+$notlife1;
                        $totalsend_att = $data['t1']+$data['t2']+$data['t3']+$data['t4']+$data['t5']+$data['t6']+$data['t7']+$data['t8']+$data['t9']+$data['t10']+$data['t11'];
                        $totaldead_att = $dead1+$dead2+$dead3+$dead4+$dead5+$dead6+$dead7+$dead8+$dead9+$dead10+$dead11;
                        //NEED TO SEND A RAPPORTAGE!!!
                        $data2 = ''.$database->getVillageField( $enforce['from'], "owner" ).','.$to['wref'].','.addslashes($to['name']).','.$tribe.','.$life.','.$notlife.','.$lifehero.','.$notlifehero.','.$enforce['from'].'';
                        if(empty($scout)) {
                            if($totalnotlife == 0){
                            $database->addNotice($database->getVillageField( $enforce['from'], "owner" ),$from['wref'],$ownally,15,'Reinforcement in '.addslashes($to['name']).' was attacked',$data2,$AttackArrivalTime);
                            }else if($totallife > $totalnotlife){
                                $database->addNotice($database->getVillageField( $enforce['from'], "owner" ),$from['wref'],$ownally,16,'Reinforcement in '.addslashes($to['name']).' was attacked',$data2,$AttackArrivalTime);
                            }else{
                                $database->addNotice($database->getVillageField( $enforce['from'], "owner" ),$from['wref'],$ownally,17,'Reinforcement in '.addslashes($to['name']).' was attacked',$data2,$AttackArrivalTime);
                            }
                            //delete reinf sting when its killed all.
                            if(!$wrong) $database->deleteReinf($enforce['id']);
                        }
                    }
                    $totalsend_att = $data['t1']+$data['t2']+$data['t3']+$data['t4']+$data['t5']+$data['t6']+$data['t7']+$data['t8']+$data['t9']+$data['t10']+$data['t11'];              
                    
                    $DefenderHeroesTot = implode(",", $DefenderHeroesTotArray);
                    $DefenderHeroesDead = implode(",", $DefenderHeroesDeadArray);
                    
                    if (empty($alldead['hero'])) $alldead['hero'] = 0;
                    if (empty($owndead['hero'])) $owndead['hero'] = 0;
                    $deadhero = $owndead['hero'];

                    //Counting own total dead troops
                    $ownDeadTroops = array_slice($owndead, 0, 10);                   
                    $totaldead_alldef = array_sum($ownDeadTroops);
                    
                    //Collecting informations for the report
                    $unitsdead_def[0] = implode(",", $ownDeadTroops);
                    $unitsdead_deff[0] = '?,?,?,?,?,?,?,?,?,?,';
                    for($i = 1; $i <= 5; $i++){
                        //Counting reinforcements total dead troops
                        $deadTroops = array_slice($alldead, ($i - 1) * 10, 10);
                        $totaldead_alldef += array_sum($deadTroops);
                        //Collecting informations for the report
                        $unitsdead_def[$i] = implode(",", $deadTroops);
                        $unitsdead_deff[$i] = $unitsdead_deff[0];
                    }
                    $totaldead_alldef += ($deadhero + $alldead['hero']);

                    if (!isset($totalattackdead))  $totalattackdead = 0;
                    $totalattackdead += $totaldead_alldef;

                    // Set units returning from attack

                    $p_units = [];
                    for ($i = 1; $i <= 11; $i++) {
                        if (!isset(${'dead'.$i})) ${'dead'.$i} = 0;
                        if (!isset(${'traped'.$i})) ${'traped'.$i} = 0;
                        $p_units[] = "t".$i." = t".$i." - ".(${'dead'.$i} + ${'traped'.$i});
                    }

                    $database->modifyAttack3($data['ref'],implode(', ', $p_units));

                    $unitsdead_att = $dead1.','.$dead2.','.$dead3.','.$dead4.','.$dead5.','.$dead6.','.$dead7.','.$dead8.','.$dead9.','.$dead10;
                    $unitstraped_att = $traped1.','.$traped2.','.$traped3.','.$traped4.','.$traped5.','.$traped6.','.$traped7.','.$traped8.','.$traped9.','.$traped10.','.$traped11;
                    
                    if($herosend_att > 0) $unitsdead_att_check = $unitsdead_att.','.$dead11;
                    else $unitsdead_att_check = $unitsdead_att;


                    //top 10 attack and defence update
                    $totaldead_att = $dead1 + $dead2 + $dead3 + $dead4 + $dead5 + $dead6 + $dead7 + $dead8 + $dead9 + $dead10 + $dead11;
                    $totalattackdead += $totaldead_att;
                    $troopsdead1 = $dead1;
                    $troopsdead2 = $dead2;
                    $troopsdead3 = $dead3;
                    $troopsdead4 = $dead4;
                    $troopsdead5 = $dead5;
                    $troopsdead6 = $dead6;
                    $troopsdead7 = $dead7;
                    $troopsdead8 = $dead8;
                    $troopsdead9 = $dead9 + 1;
                    $troopsdead10 = $dead10;
                    $troopsdead11 = $dead11;
                    
                    $totaldead_def = 0;
                    $totalpoint_att = 0;
                    
                    for($i = 1 ;$i <= 50; $i++) {
                        $unitarray = $GLOBALS["u".$i];

                        //Reinforcements dead troops
                        $totaldead_def += $alldead[$i];
                        $totalpoint_att += ($alldead[$i] * $unitarray['pop']);
                        
                        //Own dead troops
                        if($i >= ($targettribe - 1) * 10 + 1 && $i <= $targettribe * 10){
                            $totaldead_def += $owndead[$i];
                            $totalpoint_att += ($owndead[$i] * $unitarray['pop']);
                        }
                    }
                    $totalpoint_att += ((isset($alldead['hero']) ? $alldead['hero'] : 0) * 6);
                    $totalpoint_att += ((isset($owndead['hero']) ? $owndead['hero'] : 0) * 6);
                    
                    if ($Attacker['uhero'] > 0){
                        $heroxp = $totalpoint_att;
                        $database->modifyHeroXp("experience", $heroxp, $AttackerHeroID);
                    }

                    for($i = 1; $i <= 10; $i++){
                        $unitarray = $GLOBALS["u".(($att_tribe - 1) * 10 + $i)];
                        if ( !isset($totalpoint_def) ) {
                            $totalpoint_def = 0;
                        }
                        $totalpoint_def += (${'dead'.$i}*$unitarray['pop']);
                    }

                    $totalpoint_def += $dead11 * 6;
                    
                    if($Defender['hero'] > 0){
                        //counting heroxp
                        $defheroxp = intval($totalpoint_def / count($DefendersHeroID));
                        foreach($DefendersHeroID as $HeroID){
                            $database->modifyHeroXp("experience",$defheroxp,$HeroID);
                        }
                    }
                    
                    // we don't need these two variables anymore
                    unset($AttackerHeroID, $DefendersHeroID);

                    $database->modifyPoints(
                        $toF['owner'],
                        ['dpall', 'dp'],
                        [$totalpoint_def, $totalpoint_def]
                    );

                    $database->modifyPoints(
                        $from['owner'],
                        ['apall', 'ap'],
                        [$totalpoint_att, $totalpoint_att]
                    );

                    $database->modifyPointsAlly(
                        $targetally,
                        ['Adp', 'dp'],
                        [$totalpoint_def, $totalpoint_def]
                    );

                    $database->modifyPointsAlly(
                        $ownally,
                        ['Aap', 'ap'],
                        [$totalpoint_att, $totalpoint_att]
                    );

                    if ($isoasis == 0){
                        // get total cranny value:
                        $buildarray = $database->getResourceLevel($data['to']);
                        $cranny = 0;
                        for($i = 19; $i < 39;$i++){
                            if($buildarray['f'.$i.'t'] == 23){
                                $cranny += $bid23[$buildarray['f'.$i]]['attri'] * CRANNY_CAPACITY;
                            }
                        }

                        //cranny efficiency
                        $atk_bonus = ($owntribe == 2) ? (4 / 5) : 1;
                        $def_bonus = ($targettribe == 3) ? 2 : 1;
                        $to_owner = $database->getVillageField($data['to'], "owner");                       
                        
                        $crannySpy = $database->getArtifactsValueInfluence($to_owner, $data['to'], 7, $cranny * $def_bonus);
                        $cranny_eff = $crannySpy * $atk_bonus;

                        // work out available resources.
                        $this->updateRes($data['to']);
                        $this->pruneResource();

                        $villageData = $database->getVillageFields($data['to'], 'clay, iron, wood, crop', false);
                        $totclay = $villageData['clay'];
                        $totiron = $villageData['iron'];
                        $totwood = $villageData['wood'];
                        $totcrop = $villageData['crop'];                      
                    }else{
                        $cranny_eff = 0;                       

                        if ($conqureby > 0) { //10% from owner proc village owner - fix by ronix - exploit fixed by iopietro
                            $this->updateRes($conqureby);
                            $this->pruneResource();
                            
                            $villageData = $database->getVillageFields($conqureby, 'clay, iron, wood, crop', false);
                            $totclay = intval($villageData['clay'] / 10);
                            $totiron = intval($villageData['iron'] / 10);
                            $totwood = intval($villageData['wood'] / 10);
                            $totcrop = intval($villageData['crop'] / 10);
                        }else{
                            // work out available resources.
                            $this->updateORes($data['to']);
                            $this->pruneOResource();
                            
                            $oasisData = $database->getOasisFields($data['to'], false);
                            $totclay = $oasisData['clay'];
                            $totiron = $oasisData['iron'];
                            $totwood = $oasisData['wood'];
                            $totcrop = $oasisData['crop'];
                        }
                    }

                    $avclay = floor($totclay - $cranny_eff);
                    $aviron = floor($totiron - $cranny_eff);
                    $avwood = floor($totwood - $cranny_eff);
                    $avcrop = floor($totcrop - $cranny_eff);

                    $avclay = ($avclay < 0) ? 0 : $avclay;
                    $aviron = ($aviron < 0) ? 0 : $aviron;
                    $avwood = ($avwood < 0) ? 0 : $avwood;
                    $avcrop = ($avcrop < 0) ? 0 : $avcrop;

                    $avtotal = [$avwood, $avclay, $aviron, $avcrop];
                    $av = $avtotal;

                    // resources (wood,clay,iron,crop)
                    $steal = [0, 0, 0, 0];

                    //bounty variables
                    $btotal = $battlepart['bounty'];
                    $bmod = 0;

                    for($i = 0; $i < 5; $i++)
                    {
                        for($j = 0; $j < 4; $j++)
                        {
                            if(isset($avtotal[$j]))
                            {
                                if($avtotal[$j] < 1) unset($avtotal[$j]);                           
                            }
                        }

                        //No resources left to take
                        if(empty($avtotal) || ($btotal < 1 && $bmod < 1)) break;
                        
                        if($btotal < 1)
                        {
                            while($bmod)
                            {
                                //random select
                                $rs = array_rand($avtotal);
                                if(isset($avtotal[$rs]))
                                {
                                    $avtotal[$rs] -= 1;
                                    $steal[$rs] += 1;
                                    $bmod -= 1;
                                }
                            }
                        }

                        // handle unbalanced amounts.
                        $btotal += $bmod;
                        $bmod = $btotal % count($avtotal);
                        $btotal -= $bmod;
                        $bsplit = $btotal / count($avtotal);
                        
                        $max_steal = (min($avtotal) < $bsplit) ? min($avtotal) : $bsplit;
                        
                        for($j = 0; $j < 4; $j++)
                        {
                            if(isset($avtotal[$j]))
                            {
                                $avtotal[$j] -= $max_steal;
                                $steal[$j] += $max_steal;
                                $btotal -= $max_steal;
                            }
                        }
                    }                    

                    //chiefing village
                    //there are senators
                    if(($data['t9'] - $dead9 - $traped9) > 0 && $isoasis == 0){
                        if ($type == 3) {
                            $palacelevel = $database->getResourceLevel($from['wref']);
                            
                            for($i = 1; $i <= 40; $i++) {
                                if($palacelevel['f'.$i.'t'] == 26) $plevel = $i;      
                                elseif($palacelevel['f'.$i.'t'] == 25) $plevel = $i;
                            }
                            
                            if($palacelevel['f'.$plevel.'t'] == 26){                            
                                if($palacelevel['f'.$plevel] < 10) $canconquer = 0;
                                elseif($palacelevel['f'.$plevel] < 15) $canconquer = 1;
                                elseif($palacelevel['f'.$plevel] < 20) $canconquer = 2;
                                else $canconquer = 3;                              
                            }else if($palacelevel['f'.$plevel.'t'] == 25){
                                if($palacelevel['f'.$plevel] < 10) $canconquer = 0;
                                elseif($palacelevel['f'.$plevel] < 20) $canconquer = 1;
                                else $canconquer = 2;
                            }

                            $expArray = $database->getVillageFields($from['wref'], 'exp1, exp2, exp3');
                            $exp1 = $expArray['exp1'];
                            $exp2 = $expArray['exp2'];
                            $exp3 = $expArray['exp3'];

                            if($exp1 == 0) $villexp = 0;
                            elseif($exp2 == 0) $villexp = 1;               
                            elseif($exp3 == 0) $villexp = 2;                       
                            else $villexp = 3;
                        
                            $mode = CP;
                            $cp_mode = $GLOBALS['cp'.$mode];
                            $need_cps = $cp_mode[count($varray1) + 1];
                            $user_cps = $database->getUserArray($from['owner'], 1)['cp'];

                            //check for last village or capital
                            if($user_cps >= $need_cps){
                                if(count($varray) > 1 && $to['capital'] != 1 && $villexp < $canconquer){
                                    if($to['owner'] != 3 || $to['name'] != 'WW Buildingplan'){
                                        // check for standing Palace or Residence
                                        // note: at this point, we can use cache, since we've cleared it above
                                        if ($database->getFieldLevelInVillage($data['to'], '25, 26')) {
                                            $nochiefing = 1;
                                            $info_chief = "".$chief_pic.",The Palace/Residence isn\'t destroyed!";
                                        }

                                        // we can conquer this village
                                        if(!isset($nochiefing)){
                                            //$info_chief = "".$chief_pic.",You don't have enought CP to chief a village.";
                                            // note: at this point, we can use cache, since we've cleared it above
                                            $time = time();
                                            $reducedLoyaltyTotal = $reducedLoyalty = 0;
                                            for ($i = 0; $i < ($data['t9'] - $dead9 - $traped9); $i++){
                                                
                                                //Random factor, which depends on the attacking tribe
                                                if($owntribe == 1) $reducedLoyalty = rand(20, 30);
                                                else $reducedLoyalty = rand(20, 25);
                                                
                                                //If a Big Party is active in the attacking village
                                                if($from['celebration'] > $time && $from['type'] == 2) $reducedLoyalty += 5;
                                                
                                                //If a Big Party is active in the target village
                                                if($to['celebration'] > $time && $to['type'] == 2) $reducedLoyalty -= 5;
                                                
                                                //Moral bonus
                                                $reducedLoyalty /= $battlepart['moralBonus'];
                                                
                                                //If the brewery is built (Teutons only)
                                                if($owntribe == 2 && $this->getTypeLevel(35, $data['from']) > 0) $reducedLoyalty /= 2;
                                                
                                                $reducedLoyaltyTotal += $reducedLoyalty;
                                            }                                            

                                            // loyalty is more than 0
                                            if (($toF['loyalty'] - $reducedLoyaltyTotal) > 0) {
                                                $info_chief = "".$chief_pic.",The loyalty was lowered from <b>".floor($toF['loyalty'])."</b> to <b>".floor($toF['loyalty'] - $reducedLoyaltyTotal)."</b>.";
                                                $database->setVillageField($data['to'], 'loyalty', ($toF['loyalty'] - $reducedLoyaltyTotal));
                                            } else if (!$village_destroyed) {
                                                // you took over the village
                                                $villname = addslashes($database->getVillageField($data['to'],"name"));
                                                $artifact = reset($database->getOwnArtefactInfo($data['to']));

                                                $info_chief = "".$chief_pic.",Inhabitants of ".$villname." village decided to join your empire.";

                                                if ($artifact['vref'] == $data['to']){
                                                    $database->claimArtefact($data['to'], $data['to'], $database->getVillageField($data['from'], "owner"));
                                                }

                                                $database->setVillageFields(
                                                    $data['to'],
                                                    ['loyalty', 'owner'],
                                                    [0, $database->getVillageField($data['from'],"owner")]
                                                );

                                                //delete upgrades in armory and blacksmith
                                                $q = "DELETE FROM ".TB_PREFIX."abdata WHERE vref = ".(int) $data['to'];
                                                $database->query($q);
                                                $database->addABTech($data['to']);

                                                //delete researches in academy
                                                $q = "DELETE FROM ".TB_PREFIX."tdata WHERE vref = ".(int) $data['to'];
                                                $database->query($q);
                                                $database->addTech($data['to']);

                                                //delete reinforcement
                                                $q = "DELETE FROM ".TB_PREFIX."enforcement WHERE `from` = ".(int) $data['to'];
                                                $database->query($q);
                                                
                                                //delete trade routes
                                                $q = "DELETE FROM ".TB_PREFIX."route where wid = ".(int) $data['to']." OR `from` =".(int) $data['to'];
                                                $database->query($q);

                                                //no units can stay in the village itself
                                                $units2reset = [];
                                                for ($u = 1; $u <= 50; $u++) $units2reset[] = 'u'.$u.' = 0';

                                                $units2reset[] = 'u99 = 0';
                                                $units2reset[] = 'u99o = 0';
                                                $units2reset[] = 'hero = 0';
                                                $q = "UPDATE ".TB_PREFIX."units SET ".implode(',', $units2reset)." WHERE vref = ".(int) $data['to'];
                                                $database->query($q);

                                                // check buildings
                                                $newLevels_fieldNames = [];
                                                $newLevels_fieldValues = [];

                                                $poparray = $database->getVSumField([$AttackerID, $DefenderID] ,"pop");
                                                $pop1 = $poparray[0]['Total'];
                                                $pop2 = $poparray[1]['Total'];
                                                if($pop1 > $pop2 && $targettribe != 5){
                                                    $buildlevel = $database->getResourceLevel($data['to']);
                                                    for ($i = 1; $i <= 39; $i++){
                                                        if($buildlevel['f'.$i]!=0){
                                                            if($buildlevel['f'.$i."t"] != 35 && $buildlevel['f'.$i."t"] != 36 && $buildlevel['f'.$i."t"] != 41){
                                                                $leveldown = $buildlevel['f'.$i]-1;
                                                                $newLevels_fieldNames[] = "f".$i;
                                                                $newLevels_fieldValues[] = $leveldown;

                                                                // building at level 0, remove it completely
                                                                if (!$leveldown > 0) {
                                                                    $newLevels_fieldNames[] = "f".$i."t";
                                                                    $newLevels_fieldValues[] = 0;
                                                                }
                                                            }else{
                                                                $newLevels_fieldNames[] = "f".$i;
                                                                $newLevels_fieldValues[] = 0;

                                                                $newLevels_fieldNames[] = "f".$i."t";
                                                                $newLevels_fieldValues[] = 0;
                                                            }
                                                        }
                                                    }

                                                    if ($buildlevel['f99'] != 0) {
                                                        $leveldown = $buildlevel['f99'] - 1;
                                                        $newLevels_fieldNames[] = "f99";
                                                        $newLevels_fieldValues[] = $leveldown;
                                                    }
                                                }

                                                //destroy wall
                                                $newLevels_fieldNames[] = "f40";
                                                $newLevels_fieldValues[] = 0;

                                                $newLevels_fieldNames[] = "f40t";
                                                $newLevels_fieldValues[] = 0;

                                                //clear expansion slot in the village which founded the conquered one
                                                $database->clearExpansionSlot($data['to'], 1);

                                                $expArray = $database->getVillageFields($data['from'], 'exp1, exp2, exp3');
                                                $exp1 = $expArray['exp1'];
                                                $exp2 = $expArray['exp2'];
                                                $exp3 = $expArray['exp3'];

                                                if($exp1 == 0){
                                                    $exp = 'exp1';
                                                    $value = $data['to'];
                                                }elseif($exp2 == 0){
                                                    $exp = 'exp2';
                                                    $value = $data['to'];
                                                }else{
                                                    $exp = 'exp3';
                                                    $value = $data['to'];
                                                }

                                                $database->setVillageField($data['from'], $exp, $value);

                                                //Remove oasis related to village
                                                $units->returnTroops($data['to'], 1);
                                                $chiefing_village = 1;
                                                
												//Remove trade routes related to village
												$database->deleteTradeRoutesByVillage($data['to']);
												
                                                //Update data in the database                                            
                                                $database->setVillageLevel($data['to'], $newLevels_fieldNames, $newLevels_fieldValues);
                                           
                                                //Recount the population
                                                $pop = $this->recountPop($data['to'], false);
                                                
                                                //Kill and reassign the hero to the capital village, if registered in the conquered one
                                                $database->reassignHero($data['to']);
                                            }
                                        }
                                    }
                                    else $info_chief = "".$chief_pic.",You cant take over this village.";                                                                   
                                }
                                else $info_chief = "".$chief_pic.",You cant take over this village.";                   
                            }
                            else $info_chief = "".$chief_pic.",Not enough culture points.";                       
                            unset($plevel);
                        }
                        else 
                        $info_chief = "".$chief_pic.",Could not reduce cultural points during raid";        
                    }

                    if(($data['t11'] - $dead11 - $traped11) > 0){ //hero
                        if ($heroxp == 0) {
                            $xp = "";
                            $info_hero = $hero_pic.",Your hero had nothing to kill therefore gains no XP at all.";
                        } else {
                            $xp = " and gained <b>".$heroxp."</b> XP from the battle.";
                            $info_hero = $hero_pic.",Your hero gained <b>".$heroxp."</b> XP.";
                        }

                        if ($isoasis != 0) { //oasis fix by ronix
                            if ($to['owner'] != $from['owner']) {
                                $troopcount = $database->countOasisTroops($data['to'], false);
                                $canqured = $database->canConquerOasis($data['from'], $data['to'], false);
                                if ($canqured == 1 && $troopcount == 0) {
                                    $database->conquerOasis($data['from'], $data['to']);
                                    $info_hero = $hero_pic.",Your hero has conquered this oasis".$xp;
                                }else{
                                    if ($canqured == 3 && $troopcount == 0) {
                                        if ($type == 3) {
                                            $Oloyaltybefore = intval($to['loyalty']);
                                            //$database->modifyOasisLoyalty($data['to']);
                                            //$OasisInfo = $database->getOasisInfo($data['to']);
                                            $Oloyaltynow = intval($database->modifyOasisLoyalty($data['to']));//intval($OasisInfo['loyalty']);
                                            $info_hero = $hero_pic.",Your hero has reduced oasis loyalty to ".$Oloyaltynow." from ".$Oloyaltybefore.$xp;
                                        }
                                        else $info_hero = $hero_pic.",Could not reduce loyalty during raid".$xp;                              
                                    }
                                }
                            }
                        } else {
                            if ($heroxp == 0) $xp=" no XP from the battle.";
                            else $xp=" gained <b>".$heroxp."</b> XP from the battle.";
                             
                            $artifact = reset($database->getOwnArtefactInfo($data['to']));
                            if (!empty($artifact)) {
                                if ($type == 3) {
                                    if (empty($artifactError = $database->canClaimArtifact($data['from'], $artifact['vref'], $artifact['size'], $artifact['type']))) {
                                        $database->claimArtefact($data['from'], $data['to'], $database->getVillageField($data['from'], "owner"));
                                        $info_hero = $hero_pic.",Your hero is carrying home the artifact <b>".$artifact['name']."</b> and".$xp;
                                        
                                        // if the defender pop is 0 with no artefact, then destroy the village
                                        if($database->getVillageField($data['to'], "pop") == 0 || $targettribe == 5){
                                            $can_destroy = $village_destroyed = 1;
                                            if(strpos($info_cat, "The village has") === false) $info_hero .= " The village has been destroyed.";
                                        }
                                    }
                                    else $info_hero = $hero_pic.",".$artifactError.$xp;
                                }
                                else $info_hero = $hero_pic.",Your hero could not claim an artifact during raid".$xp;    
                            }
                        }
                    }elseif($data['t11'] > 0) {
                        if ($heroxp == 0) $xp = "";     
                        else $xp = " but gained <b>".$heroxp."</b> XP from the battle.";
                        
                        if ($traped11 > 0) $info_hero = $hero_pic.",Your hero was trapped".$xp;                    
                        else $info_hero = $hero_pic.",Your hero died".$xp;
                    }
                    
                    if ($DefenderID == 0) $natar = 0;

                    if(!empty($scout)) {
                        if ($data['spy'] == 1){
                            $info_spy = "".$spy_pic.",<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".round($totwood)." |
				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".round($totclay)." |
				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".round($totiron)." |
				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".round($totcrop)."</div>
				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources: ".round($totwood+$totclay+$totiron+$totcrop)."</div>
	";
                        }else if($data['spy'] == 2){
                            if ($isoasis == 0){
                                $walllevel = $database->getFieldLevelInVillage($data['to'], '31, 32, 33');
                                $residencelevel = $database->getFieldLevelInVillage($data['to'], 25);
                                $palacelevel = $database->getFieldLevelInVillage($data['to'], 26);
                                $residenceimg = "<img src=\"".GP_LOCATE."img/g/g25.gif\" height=\"20\" width=\"15\" alt=\"Residence\" title=\"Residence\" />";
                                $palaceimg = "<img src=\"".GP_LOCATE."img/g/g26.gif\" height=\"20\" width=\"15\" alt=\"Palace\" title=\"Palace\" />";
                                $crannyimg = "<img src=\"".GP_LOCATE."img/g/g23.gif\" height=\"20\" width=\"15\" alt=\"Cranny\" title=\"Cranny\" />";
                                $wallimg = "<img src=\"".GP_LOCATE."img/g/g3".$targettribe."Icon.gif\" height=\"20\" width=\"15\" alt=\"Wall\" title=\"Wall\" />";
                                $info_spy = "".$spy_pic.",";
                                if($residencelevel > 0) $info_spy .= $residenceimg." Residence level:<b>".$residencelevel."</b><br />";
                                elseif($palacelevel > 0) $info_spy .= $palaceimg." Palace level: <b>".$palacelevel."</b><br />";
                                
                                if($walllevel > 0) $info_spy .= $wallimg." Wall level: <b>".$walllevel."</b><br />";
                                $info_spy .= $crannyimg." Total crannies capacity: <b>".$crannySpy."</b>";
                            }
                            else $info_spy = "".$spy_pic.", There are no informations to show";                                                   
                        }

                        $data2 = ''.$from['owner'].','.$from['wref'].','.$owntribe.','.$unitssend_att.','.$unitsdead_att.',0,0,0,0,0,'.$to['owner'].','.$to['wref'].','.addslashes($to['name']).',,,,'.$targettribe.','.$unitssend_def[0].','.$unitsdead_def[0].','.$rom.','.$unitssend_def[1].','.$unitsdead_def[1].','.$ger.','.$unitssend_def[2].','.$unitsdead_def[2].','.$gal.','.$unitssend_def[3].','.$unitsdead_def[3].','.$nat.','.$unitssend_def[4].','.$unitsdead_def[4].','.$natar.','.$unitssend_def[5].','.$unitsdead_def[5].','.$DefenderHeroesTot.','.$DefenderHeroesDead.','.$info_ram.','.$info_cat.','.$info_chief.','.$info_spy.','.$data['t11'].','.$dead11.','.$herosend_def.','.$deadhero.',,'.$unitstraped_att;
                    }else{
                        if(isset($village_destroyed) && $village_destroyed == 1 && $can_destroy==1){
                            //check if village pop=0 and no info destroy
                            if (strpos($info_cat, "The village has") === false) {
                                $info_cat .= "<tbody class=\"goods\"><tr><th>Information</th><td colspan=\"11\">
                                          <img class=\"unit u".$catp_pic."\" src=\"img/x.gif\" alt=\"Catapult\" title=\"Catapult\" /> The village has been destroyed.</td></tr></tbody>";
                            }
                        }
                        $data2 = ''.$from['owner'].','.$from['wref'].','.$owntribe.','.$unitssend_att.','.$unitsdead_att.','.$steal[0].','.$steal[1].','.$steal[2].','.$steal[3].','.$battlepart['bounty'].','.$to['owner'].','.$to['wref'].','.addslashes($to['name']).',,,,'.$targettribe.','.$unitssend_def[0].','.$unitsdead_def[0].','.$rom.','.$unitssend_def[1].','.$unitsdead_def[1].','.$ger.','.$unitssend_def[2].','.$unitsdead_def[2].','.$gal.','.$unitssend_def[3].','.$unitsdead_def[3].','.$nat.','.$unitssend_def[4].','.$unitsdead_def[4].','.$natar.','.$unitssend_def[5].','.$unitsdead_def[5].','.$DefenderHeroesTot.','.$DefenderHeroesDead.','.$info_ram.','.$info_cat.','.$info_chief.','.(isset($info_spy) ? $info_spy : '').',,'.$data['t11'].','.$dead11.','.$herosend_def.','.$deadhero.','.$unitstraped_att;
                    }
                  
                    if($totalsend_att - ($totaldead_att + (isset($totaltraped_att) ? $totaltraped_att : 0)) <= 0){
                        $info_troop = "None of your soldiers returned.";
                    }
                    else $info_troop = "";
                    
                    //When all of the attacker's troops die, send no informations
                    $data_fail = ''.$from['owner'].','.$from['wref'].','.$owntribe.','.$unitssend_att.','.$unitsdead_att.','.$steal[0].','.$steal[1].','.$steal[2].','.$steal[3].','.$battlepart['bounty'].','.$to['owner'].','.$to['wref'].','.addslashes($to['name']).',,,,'.$targettribe.','.$unitssend_deff[0].','.$unitsdead_deff[0].','.$rom.','.$unitssend_deff[1].','.$unitsdead_deff[1].','.$ger.','.$unitssend_deff[2].','.$unitsdead_deff[2].','.$gal.','.$unitssend_deff[3].','.$unitsdead_deff[3].','.$nat.','.$unitssend_deff[4].','.$unitsdead_deff[4].','.$natar.','.$unitssend_deff[5].','.$unitsdead_deff[5].','.$DefenderHeroesTot.','.$DefenderHeroesDead.',,,'.$data['t11'].','.$dead11.','.$unitstraped_att.',,'.$info_ram.','.$info_cat.','.$info_chief.','.$info_troop.','.$info_hero;

                    //Undetected and detected in here.
                    if(!empty($scout)){
                        for($i = 1; $i <= 10; $i++){
                            if($battlepart['casualties_attacker'][$i]){
                                if($from['owner'] == 3){
                                    $database->addNotice($to['owner'],$to['wref'],$targetally,20,''.addslashes($from['name']).' scouts '.addslashes($to['name']).'',$data2,$AttackArrivalTime);
                                    break;
                                }else if($unitsdead_att == $unitssend_att && $defspy){ //fix by ronix
                                    $database->addNotice($to['owner'],$to['wref'],$targetally,20,''.addslashes($from['name']).' scouts '.addslashes($to['name']).'',$data2.',,'.$info_troop,$AttackArrivalTime);
                                    break;
                                }else if($defspy){ //fix by ronix
                                    $database->addNotice($to['owner'],$to['wref'],$targetally,21,''.addslashes($from['name']).' scouts '.addslashes($to['name']).'',$data2,$AttackArrivalTime);
                                    break;
                                }
                            }
                        }
                    }else{
                        if($type == 3 && $totalsend_att - ($totaldead_att + $totaltraped_att) > 0){                          
                            $prisoners = $database->getPrisoners([$to['wref']], 0, false)[$to['wref'].'0'];
                            if(count($prisoners) > 0){
                                $anothertroops = $mytroops = $ownDeads = $anotherDeads = 0;
                                $prisoners2delete = [];
                                $movementType = [];
                                $movementFrom = [];
                                $movementTo = [];
                                $movementRef = [];
                                $movementTime = [];
                                $movementEndtime = [];
                                $utime = microtime(true);
                                
                                foreach($prisoners as $prisoner) {
                                    $p_owner = $database->getVillageField($prisoner['from'], "owner");

                                    //If troops are coming from the same village, add it to the returing troops
                                    if ($prisoner['from'] == $from['wref']) {
                                        for($i = 1; $i <= 11; $i++){
                                            $deadPrisoners = round($prisoner['t'.$i] / 4);
                                            $mytroops += $prisoner['t'.$i];
                                            $ownDeads += $deadPrisoners; 
                                            $prisoner['t'.$i] -= $deadPrisoners;
                                        }
                                        
                                        $database->modifyAttack2(
                                            $data['ref'],
                                            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                            [$prisoner['t1'], $prisoner['t2'], $prisoner['t3'], $prisoner['t4'], $prisoner['t5'], $prisoner['t6'], $prisoner['t7'], $prisoner['t8'], $prisoner['t9'], $prisoner['t10'], $prisoner['t11']]
                                        );             
                                        $prisoners2delete[] = $prisoner['id'];
                                    } else {
                                        $p_alliance = $database->getUserField($p_owner, "alliance",0);
                                        $friendarray = $database->getAllianceAlly($p_alliance, 1);
                                        $neutralarray = $database->getAllianceAlly($p_alliance, 2);
                                        $friend = ($friendarray[0]['alli1'] > 0 && $friendarray[0]['alli2'] > 0 && $p_alliance > 0) && ($friendarray[0]['alli1'] == $ownally || $friendarray[0]['alli2'] == $ownally) && ($ownally != $p_alliance && $ownally && $p_alliance);
                                        $neutral = ($neutralarray[0]['alli1'] > 0 && $neutralarray[0]['alli2'] > 0 && $p_alliance > 0) && ($neutralarray[0]['alli1'] == $ownally || $neutralarray[0]['alli2'] == $ownally) && ($ownally != $p_alliance && $ownally && $p_alliance);

                                        if($p_alliance == $ownally || $friend || $neutral){
                                            $p_tribe = $database->getUserField($p_owner, "tribe", 0);

                                            for($i = 1; $i <= 11; $i++){
                                                $deadPrisoners = round($prisoner['t'.$i] / 4);
                                                if($p_owner == $from['owner']){
                                                    $mytroops += $prisoner['t'.$i];
                                                    $ownDeads += $deadPrisoners;                                   
                                                }else{
                                                    $anothertroops += $prisoner['t'.$i];
                                                    $anotherDeads += $deadPrisoners;
                                                }
                                                $prisoner['t'.$i] -= $deadPrisoners;
                                            } 
                                            
                                            $troopsTime = $units->getWalkingTroopsTime($prisoner['from'], $prisoner['wref'], $p_owner, $p_tribe, $prisoner, 1, 't');
                                            $p_time = $database->getArtifactsValueInfluence($p_owner, $prisoner['from'], 2, $troopsTime);
                                            
                                            $p_reference = $database->addAttack($prisoner['from'], $prisoner['t1'], $prisoner['t2'], $prisoner['t3'], $prisoner['t4'], $prisoner['t5'], $prisoner['t6'], $prisoner['t7'], $prisoner['t8'], $prisoner['t9'], $prisoner['t10'], $prisoner['t11'], 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                            $movementType[] = 4;
                                            $movementFrom[] = $prisoner['wref'];
                                            $movementTo[] = $prisoner['from'];
                                            $movementRef[] = $p_reference;
                                            $movementTime[] = $utime;
                                            $movementEndtime[] = $p_time + $utime;                                                      
                                            $prisoners2delete[] = $prisoner['id'];
                                        }
                                    }
                                }

                                if (count($movementType)) {
                                    $database->addMovement($movementType, $movementFrom, $movementTo, $movementRef, $movementTime, $movementEndtime);
                                }

                                $database->deletePrisoners($prisoners2delete);

                                $ownDeadsText = ($ownAlive = $mytroops - $ownDeads) > 0 ? " of which <b>".$ownAlive."</b> have been saved" : "";
                                $anotherDeadsText = ($anotherAlive = $anothertroops - $anotherDeads) > 0 ? " of which <b>".$anotherAlive."</b> have been saved" : "";
                                
                                //Add dead troops to the "General attacks" tab
                                $database->addGeneralAttack($ownDeads + $anotherDeads);
                                
                                //Calculate new traps which have to be repaired
                                $newtraps = round(($mytroops + $anothertroops) / 3);
                                
                                //Reset traps
                                $database->modifyUnit($data['to'], ['99', '99o'], [$mytroops + $anothertroops, $mytroops + $anothertroops], [0, 0]);
                                
                                //Repair needed traps            
                                if($newtraps > 0){
                                    $repairDuration = $database->getArtifactsValueInfluence($to['owner'], $to['wref'], 5, round(($bid19[max($this->getTypeLevel(36, $to['wref']), 1)]['attri'] / 100) * $u99['time'] / SPEED));
                                    $database->trainUnit($to['wref'], 99, $newtraps, $u99['pop'], $repairDuration, 0);
                                }
                                
                                $trapper_pic = "<img src=\"".GP_LOCATE."img/u/98.gif\" alt=\"Trap\" title=\"Trap\" />";
                                $p_username = $database->getUserField($from['owner'], "username", 0);

                                if($mytroops > 0 && $anothertroops > 0){
                                    $info_trap = "".$trapper_pic." <b>".$p_username."</b> freed <b>".$mytroops."</b> from his troops".$ownDeadsText." and <b>".$anothertroops."</b> friendly troops".$anotherDeadsText.".";
                                }elseif($mytroops > 0){
                                    $info_trap = "".$trapper_pic." <b>".$p_username."</b> freed <b>".$mytroops."</b> from his troops".$ownDeadsText.".";
                                }elseif($anothertroops > 0){
                                    $info_trap = "".$trapper_pic." <b>".$p_username."</b> freed <b>".$anothertroops."</b> friendly troops".$anotherDeadsText.".";
                                }
                            }
                        }
                        
                        $data2 = $data2.','.(isset($info_trap) ? addslashes($info_trap) : '').',,'.$info_troop.','.$info_hero;

                        if($totalsend_alldef == 0 && $totalsend_att - ($totaldead_att + (isset($totaltraped_att) ? $totaltraped_att : 0)) > 0){
                            $database->addNotice($to['owner'],$to['wref'],$targetally,7,''.addslashes($from['name']).' attacks '.addslashes($to['name']).'',$data2,$AttackArrivalTime);
                        }else if($totaldead_alldef == 0){
                            $database->addNotice($to['owner'],$to['wref'],$targetally,4,''.addslashes($from['name']).' attacks '.addslashes($to['name']).'',$data2,$AttackArrivalTime);
                        }else if($totalsend_alldef > $totaldead_alldef){
                            $database->addNotice($to['owner'],$to['wref'],$targetally,5,''.addslashes($from['name']).' attacks '.addslashes($to['name']).'',$data2,$AttackArrivalTime);
                        }else if($totalsend_alldef == $totaldead_alldef){
                            $database->addNotice($to['owner'],$to['wref'],$targetally,6,''.addslashes($from['name']).' attacks '.addslashes($to['name']).'',$data2,$AttackArrivalTime);
                        }
                    }
                    //to here
                    // If the dead units not equal the ammount sent they will return and report
                    if($totalsend_att - ($totaldead_att + (isset($totaltraped_att) ? $totaltraped_att : 0)) > 0)
                    {                       
                        $returningTroops = [];
                        for($i = 1; $i <= 11; $i++) $returningTroops['t'.$i] = $data['t'.$i] - ${'traped'.$i} - ${'dead'.$i};
                        $troopsTime = $units->getWalkingTroopsTime($from['wref'], $to['wref'], $from['owner'], $owntribe, $returningTroops, 1, 't');
                        $endtime = $database->getArtifactsValueInfluence($from['owner'], $from['wref'], 2, $troopsTime);
                        $endtime += $AttackArrivalTime;
                        if($type == 1){
							if($from['owner'] == 3){ // fix natar report by ronix
								$database->addNotice($to['owner'], $to['wref'], $targetally, 20, '' . addslashes($from['name']) . ' scouts ' . addslashes($to['name']) . '', $data2, $AttackArrivalTime);
							}elseif($totaldead_att == 0 && $totaltraped_att == 0){
								$database->addNotice($from['owner'], $to['wref'], $ownally, 18, '' . addslashes($from['name']) . ' scouts ' . addslashes($to['name']) . '', $data2, $AttackArrivalTime);
							}else{
								$database->addNotice($from['owner'], $to['wref'], $ownally, 21, '' . addslashes($from['name']) . ' scouts ' . addslashes($to['name']) . '', $data2, $AttackArrivalTime);
							}
						}else{
							if((empty($totaldead_att) || $totaldead_att == 0) && (empty($totaltraped_att) || $totaltraped_att == 0)){
								$database->addNotice($from['owner'], $to['wref'], $ownally, 1, '' . addslashes($from['name']) . ' attacks ' . addslashes($to['name']) . '', $data2, $AttackArrivalTime);
							}else{
								$database->addNotice($from['owner'], $to['wref'], $ownally, 2, '' . addslashes($from['name']) . ' attacks ' . addslashes($to['name']) . '', $data2, $AttackArrivalTime);
							}
						}

                        $database->setMovementProc($data['moveid']);

                        if (!isset($chiefing_village)) $chiefing_village = 0;

                        if($chiefing_village != 1){
                        	$database->addMovement(4, $DefenderWref, $AttackerWref, $data['ref'], $AttackArrivalTime, $endtime, 1, $steal[0], $steal[1], $steal[2], $steal[3]);
                            if($type !== 1){
                            	if ($isoasis == 0) $database->modifyResource($DefenderWref, $steal[0], $steal[1], $steal[2], $steal[3], 0);                   
                                else
                                {
                                	//if it's an oasis but it's conquered by someone, resources must be modified in the owner's village
                                	if($conqureby > 0) $database->modifyResource($conqureby, $steal[0], $steal[1], $steal[2], $steal[3], 0);
                                    else $database->modifyOasisResource($DefenderWref, $steal[0], $steal[1], $steal[2], $steal[3], 0);                                  
                                }
								$totalstolengain = $steal[0] + $steal[1] + $steal[2] + $steal[3];
								$totalstolentaken = ((isset($totalstolentaken) ? $totalstolentaken : 0) - ($steal[0] + $steal[1] + $steal[2] + $steal[3]));
								$database->modifyPoints($from['owner'], 'RR', $totalstolengain);
								$database->modifyPoints($to['owner'], 'RR', $totalstolentaken);
								$database->modifyPointsAlly($targetally, 'RR', $totalstolentaken);
								$database->modifyPointsAlly($ownally, 'RR', $totalstolengain);
                            }
                        }else{ //fix by ronix if only 1 chief left to conqured - don't add with zero enforces
                            if($totalsend_att - ($totaldead_att + (isset($totaltraped_att) ? $totaltraped_att : 0)) > 1){
								$database->addEnforce2($data, $owntribe, $troopsdead1, $troopsdead2, $troopsdead3, $troopsdead4, $troopsdead5, $troopsdead6, $troopsdead7, $troopsdead8, $troopsdead9, $troopsdead10, $troopsdead11);
							}
                        }
                    }
                    else //else they die and don't return or report.
                    {
                        $database->setMovementProc($data['moveid']);
						if($type == 1){
							$database->addNotice($from['owner'], $to['wref'], $ownally, 19, addslashes($from['name']) . ' scouts ' . addslashes($to['name']) . '', $data_fail, $AttackArrivalTime);
						}else{
							$database->addNotice($from['owner'], $to['wref'], $ownally, 3, '' . addslashes($from['name']) . ' attacks ' . addslashes($to['name']) . '', $data_fail, $AttackArrivalTime);
						}
                    }
                    if($type == 3 || $type == 4) $database->addGeneralAttack($totalattackdead);

                    if (!isset($village_destroyed)) $village_destroyed = 0;

                    if ($village_destroyed == 1 && $can_destroy == 1) 
                    {                 	
                    	if($to['capital'] == 1){
                    		$mostPopulatedVillage = [];
                    		//Search for the most populated village
                    		foreach($varray as $village){
                    			if($village['wref'] != $data['to'] && (empty($mostPopulatedVillage) || $mostPopulatedVillage['pop'] < $village['pop'])){
                    				$mostPopulatedVillage = $village;
                    			}
                    		}
                    		//Set the new capital
                    		$database->changeCapital($mostPopulatedVillage['wref']);
                    	}
                    	
                    	//Delete the village
                    	$database->DelVillage($data['to']);
                    	
                    	//Reassign the hero, if dead and assigned to the deleted village
                    	$database->reassignHero($data['to']);
                    }
                }else{
                    //units attack string for battleraport
                    $unitssend_att1 = ''.$data['t1'].','.$data['t2'].','.$data['t3'].','.$data['t4'].','.$data['t5'].','.$data['t6'].','.$data['t7'].','.$data['t8'].','.$data['t9'].','.$data['t10'].'';
                    $herosend_att = $data['t11'];
                    $unitssend_att= $unitssend_att1.','.$herosend_att;
                    
                    $troopsTime = $units->getWalkingTroopsTime($from['wref'], $to['wref'], $from['owner'], $owntribe, $data, 1, 't');
                    $endtime = $database->getArtifactsValueInfluence($from['owner'], $from['wref'], 2, $troopsTime);                
                    $endtime += $AttackArrivalTime;

                    $database->setMovementProc($data['moveid']);
                    $database->addMovement(4, $to['wref'], $from['wref'], $data['ref'], $AttackArrivalTime, $endtime);
                    $peace = PEACE;
                    $data2 = $from['owner'].','.$from['wref'].','.$to['owner'].','.$owntribe.','.$unitssend_att.','.$peace;
                    $time = time();
                    $database->addNotice($from['owner'], $to['wref'], $ownally, 22,''.addslashes($from['name']).' attacks '.addslashes($to['name']).'', $data2, $time);
                    $database->addNotice($to['owner'], $to['wref'], $targetally, 23,''.addslashes($from['name']).' attacks '.addslashes($to['name']).'', $data2, $time);
                }

                //Update starvation data
                $database->addStarvationData($to['wref']);
                
				//Returning units back to village is not necessary because it will be taken care when processing movement			
				// Fix by AL-Kateb
                // if evasion was active, return units back to base
               /*
			   if (isset($evaded)) {
                    foreach ($evasionUnitModifications_modes as $index => $mode) {
                        $evasionUnitModifications_modes[$index] = 1;
                    }

                    $database->modifyUnit($data['to'], $evasionUnitModifications_units, $evasionUnitModifications_amounts, $evasionUnitModifications_modes);
                }
				*/

                #################################################
                ################FIXED BY SONGER################
                #################################################

                ################################################################################
                ##############ISUE: Lag, fixed3####################################################
                #### PHP.NET manual: unset() destroy more than one variable unset($foo1, $foo2, $foo3);######
                ################################################################################
                $data_num++;

                unset(
                    $Attacker
                    ,$Defender
                    ,$DefenderEnf
                    ,$DefenderHeroesTotArray
                    ,$DefenderHeroesDeadArray
                    ,$DefenderHeroesTot
                    ,$DefenderHeroesDead
                    ,$enforce
                    ,$unitssend_att
                    ,$unitssend_def
                    ,$battlepart
                    ,$unitlist
                    ,$unitsdead_def
                    ,$dead
                    ,$steal
                    ,$from
                    ,$data
                    ,$data2
                    ,$to
                    ,$artifact
                    ,$artifactBig
                    ,$canclaim
                    ,$data_fail
                    ,$owntribe
                    ,$unitsdead_att
                    ,$herosend_def
                    ,$deadhero
                    ,$heroxp
                    ,$AttackerID
                    ,$DefenderID
                    ,$totalsend_att
                    ,$totalsend_alldef
                    ,$totaldead_att
                    ,$totaltraped_att
                    ,$totaldead_def
                    ,$unitsdead_att_check
                    ,$totalattackdead
                    ,$enforce1
                    ,$defheroowner
                    ,$enforceowner
                    ,$defheroxp
                    ,$reinfheroxp
                    ,$AttackerWref
                    ,$DefenderWref
                    ,$troopsdead1
                    ,$troopsdead2
                    ,$troopsdead3
                    ,$troopsdead4
                    ,$troopsdead5
                    ,$troopsdead6
                    ,$troopsdead7
                    ,$troopsdead8
                    ,$troopsdead9
                    ,$troopsdead10
                    ,$troopsdead11
                    ,$DefenderUnit
                    ,$info_trap);

                #################################################

            }
        }
    }

    private function sendreinfunitsComplete() {
        global $bid23, $database, $technology, $battle;

        $time = time();
        $q = "
            SELECT
                `to`, `from`, moveid,
                t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11
            FROM
                ".TB_PREFIX."movement,
                ".TB_PREFIX."attacks 
            WHERE
                ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id
                AND
                ".TB_PREFIX."movement.proc = 0
                AND
                ".TB_PREFIX."movement.sort_type = 3
                AND
                ".TB_PREFIX."attacks.attack_type = 2
                AND
                endtime < $time";
        $dataarray = $database->query_return($q);

        if ($dataarray && count($dataarray)) {
            // preload village data
            $vilIDs = [];
            $tos = [];
            $froms = [];
            foreach($dataarray as $data) {
                $vilIDs[$data['from']] = true;
                $vilIDs[$data['to']] = true;
                $tos[$data['to']] = true;
                $froms[$data['from']] = true;
            }
            $vilIDs = array_keys($vilIDs);
            $database->getProfileVillages($vilIDs, 5);
            $database->getUnit($vilIDs);
            $database->getEnforce(array_keys($tos), array_keys($froms));
            $database->getVillageByWorldID($vilIDs);

            // calculate reinforcements data
            $movementProcIDs = [];
            foreach($dataarray as $data) {
				$isoasis = $database->isVillageOases($data['to']);
				if($isoasis == 0){
					$to = $database->getMInfo($data['to']);
					$toF = $database->getVillage($data['to']);
					$DefenderID = $to['owner'];
					$targettribe = $database->getUserField($DefenderID, "tribe", 0);
					$conqureby = 0;
				}else{
					$to = $database->getOMInfo($data['to']);
					$toF = $database->getOasisV($data['to']);
					$DefenderID = $to['owner'];
					$targettribe = $database->getUserField($DefenderID, "tribe", 0);
					$conqureby = $toF['conqured'];
				}

                if($data['from'] == 0){
					$DefenderID = $database->getVillageField($data['to'], "owner");
					$database->addEnforce(['from' => $data['from'], 'to' => $data['to'], 't1' => 0, 't2' => 0, 't3' => 0, 't4' => 0, 't5' => 0, 't6' => 0, 't7' => 0, 't8' => 0, 't9' => 0, 't10' => 0, 't11' => 0]);
					$reinf = $database->getEnforce($data['to'], $data['from']);
					$database->modifyEnforce($reinf['id'], 31, 1, 1);
					$data_fail = '0,0,4,1,0,0,0,0,0,0,0,0,0,0';
					$database->addNotice($to['owner'], $to['wref'], (isset($targetally) ? $targetally : 0), 8, 'village of the elders reinforcement ' . addslashes($to['name']), $data_fail, $AttackArrivalTime);
					$movementProcIDs[] = $data['moveid'];
				}else{
                    //set base things
                    $from = $database->getMInfo($data['from']);
                    $fromF = $database->getVillage($data['from']);
                    $AttackerID = $from['owner'];
                    $owntribe = $database->getUserField($AttackerID,"tribe",0);
                   
                    $HeroTransfer = $troopsPresent = 0;              
                    for($i = 1;$i <= 10; $i++) {
                    	if($data['t'.$i] > 0) {
                    		$troopsPresent = 1;
                    		break;
                    	}
                    }
                    
                    //check if the hero is present and we're not sending him to an occupied oasis
                    //only add hero if we're sending him alone
                    if($data['t11'] > 0 && !$isoasis && !$troopsPresent) {
                    	//check if we're sending a hero between own villages
                        if($AttackerID == $DefenderID) {             
                            //check if there's a Mansion at target village
                            if($this->getTypeLevel(37, $data['to']) > 0){
                                //don't reinforce, addunit instead
                                $database->modifyUnit($data['to'], ["hero"], [1], [1]);
                                $heroid = $database->getHeroField($DefenderID, 'heroid');
                                $database->modifyHero("wref", $data['to'], $heroid);
                                $HeroTransfer = 1;
                            }
                        }
                    }                   

                    if($data['t11'] > 0 || $troopsPresent) {
                        $temphero = $data['t11'];
                        if ($HeroTransfer) $data['t11'] = 0;
                        //check if there is defence from town in to town
                        $check = $database->getEnforce($data['to'], $data['from']);
                        if (!isset($check['id'])) $database->addEnforce($data);
                        else
                        {
                            //yes
                            $start = ($owntribe - 1) * 10 + 1;
                            $end = ($owntribe * 10);
                            
                            //add unit.
                            $t_units = '';
                            for($i = $start, $j = 1; $i <= $end; $i++, $j++)
                            {
                                $t_units .= "u".$i." = u".$i." + ".$data['t'.$j].(($j > 9) ? '' : ', ');
                            }
                            
                            $q = "UPDATE ".TB_PREFIX."enforcement set $t_units where id =".(int) $check['id'];
                            $database->query($q);
                            $database->modifyEnforce($check['id'], 'hero', $data['t11'], 1);
                        }
                        $data['t11'] = $temphero;
                    }
                    //send rapport
                    $unitssend_att = ''.$data['t1'].','.$data['t2'].','.$data['t3'].','.$data['t4'].','.$data['t5'].','.$data['t6'].','.$data['t7'].','.$data['t8'].','.$data['t9'].','.$data['t10'].','.$data['t11'].'';
                    $data_fail = ''.$from['wref'].','.$from['owner'].','.$owntribe.','.$unitssend_att.'';


                    if($isoasis == 0) $to_name = $to['name'];    
                    else $to_name = "Oasis ".$database->getVillageField($to['conqured'],"name");                 
                    
                    $database->addNotice($from['owner'],$from['wref'],(isset($ownally) ? $ownally : 0),8,''.addslashes($from['name']).' reinforcement '.addslashes($to_name).'',$data_fail,(isset($AttackArrivalTime) ? $AttackArrivalTime : time()));
                    if($from['owner'] != $to['owner']) {
                        $database->addNotice($to['owner'],$to['wref'],(isset($targetally) ? $targetally : 0),8,''.addslashes($from['name']).' reinforcement '.addslashes($to_name).'',$data_fail,(isset($AttackArrivalTime) ? $AttackArrivalTime : time()));
                    }
                    //update status
                    $movementProcIDs[] = $data['moveid'];
                }

                //Update starvation data
                $database->addStarvationData($data['to']);

                //check empty reinforcement in rally point
                $e_units = '';
                for ($i = 1; $i <= 50; $i++) $e_units.= 'u'.$i.'= 0 AND ';
                
                $e_units.= 'hero = 0';
                $q = "DELETE FROM ".TB_PREFIX."enforcement WHERE ".$e_units." AND (vref=".(int) $data['to']." OR `from`=".(int) $data['to'].")";
                $database->query($q);
            }

            $database->setMovementProc(implode(', ', $movementProcIDs));
        }
    }

    private function returnunitsComplete() {
        global $database, $technology;

        $time = time();
        $q = "
            SELECT
                `to`, `from`, moveid, starttime, endtime, wood, clay, iron, crop,
                t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11
            FROM
                ".TB_PREFIX."movement,
                ".TB_PREFIX."attacks
            WHERE
                ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id
                AND
                ".TB_PREFIX."movement.proc = 0
                AND
                ".TB_PREFIX."movement.sort_type = 4
                AND
                endtime < $time";
        $dataarray = $database->query_return($q);

        if ($dataarray && count($dataarray)) {
            // preload village data
            $vilIDs = [];
            foreach($dataarray as $data) {
                $vilIDs[$data['from']] = true;
                $vilIDs[$data['to']] = true;
            }
            $database->getProfileVillages(array_keys($vilIDs), 5);
            $database->getOasisEnforce($vilIDs, 0);
            $database->getOasisEnforce($vilIDs, 1);

            $movementProcIDs = [];
            foreach($dataarray as $data) {
            	$tribe = $database->getUserField($database->getVillageField($data['to'], "owner"), "tribe", 0);
            	$u = $tribe == 1 ? "" : $tribe - 1;
            	$database->modifyUnit(
            			$data['to'],
            			[$u."1", $u."2", $u."3", $u."4", $u."5", $u."6", $u."7", $u."8", $u."9", $tribe."0", "hero"],
            			[$data['t1'], $data['t2'], $data['t3'], $data['t4'], $data['t5'], $data['t6'], $data['t7'], $data['t8'], $data['t9'], $data['t10'], $data['t11']],
            			[1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
            			);
            	
            	//If there's at least 1 resource, add it to the village
            	if($data['wood'] + $data['clay'] + $data['iron'] + $data['crop'] > 0){
            		$database->modifyResource($data['to'], $data['wood'], $data['clay'], $data['iron'], $data['crop'], 1);
            	}
            	
            	$movementProcIDs[] = $data['moveid'];
            	
            	//Update starvation data
            	$database->addStarvationData($data['to']);
            }
            
            $database->setMovementProc(implode(', ', $movementProcIDs));
            $this->pruneResource();
        }

        // Settlers
        $q = "SELECT `to`, moveid FROM ".TB_PREFIX."movement where ref = 0 and proc = '0' and sort_type = '4' and endtime < $time";
        $dataarray = $database->query_return($q);
        $movementProcIDs = [];

        if ($dataarray && count($dataarray)) {
            foreach($dataarray as $data) {
                $tribe = $database->getUserField($database->getVillageField($data['to'], "owner"), "tribe", 0);
                $database->modifyUnit($data['to'], [$tribe."0"], [3], [1]);
                
                //If a settling is canceled, add 750 for each resource type
                $database->modifyResource($data['to'], 750, 750, 750, 750, 1);
                $movementProcIDs[] = $data['moveid'];
            }
            $database->setMovementProc(implode(', ', $movementProcIDs));
        }
    }

    private function sendSettlersComplete() {
        global $database;

        $time = microtime(true);
        $q = "SELECT `to`, `from`, moveid, starttime, ref FROM ".TB_PREFIX."movement where proc = 0 and sort_type = 5 and endtime < $time";

        $dataarray = $database->query_return($q);
        $movementProcIDs = [];
        $fieldIDs = [];
        $addUnitsWrefs = [];
        $addTechWrefs = [];
        $addABTechWrefs = [];
        $time = microtime(true);
        $types = [];
        $froms = [];
        $tos = [];
        $refs = [];
        $times = [];
        $endtimes = [];

        // preload village data
        $vilIDs = [];
        foreach($dataarray as $data) {
            $vilIDs[$data['from']] = true;
            $vilIDs[$data['to']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getProfileVillages($vilIDs, 5);
        $database->getVillageByWorldID($vilIDs);

        foreach($dataarray as $data) {
            $ownerID = $database->getUserField($database->getVillageField($data['from'], "owner"), "id", 0);
			$to = $database->getMInfo($data['from']);
			$user = addslashes($database->getUserField($to['owner'], 'username', 0));
			$taken = $database->getVillageState($data['to']);
			if($taken != 1){
				$fieldIDs[] = $data['to'];
				$database->addVillage($data['to'], $to['owner'], $user, '0');
				$database->addResourceFields($data['to'], $database->getVillageType($data['to']));
                $addUnitsWrefs[] = $data['to'];
                $addTechWrefs[] = $data['to'];
                $addABTechWrefs[] = $data['to'];
                $movementProcIDs[] = $data['moveid'];
                
				$exp1 = $database->getVillageField($data['from'], 'exp1');
				$exp2 = $database->getVillageField($data['from'], 'exp2');
				$exp3 = $database->getVillageField($data['from'], 'exp3');
				
				if($exp1 == 0){
					$exp = 'exp1';
					$value = $data['to'];
				}elseif($exp2 == 0){
					$exp = 'exp2';
					$value = $data['to'];
				}else{
					$exp = 'exp3';
					$value = $data['to'];
				}
				
				$database->setVillageField($data['from'], $exp, $value);
            }else{
                // here must come movement from returning settlers
                $types[] = 4;
                $froms[] = $data['to'];
                $tos[] = $data['from'];
                $refs[] = $data['ref'];
                $times[] = $time;
                $endtimes[] = $time + ($time - $data['starttime']);
                $movementProcIDs[] = $data['moveid'];
            }
        }

        $database->addMovement($types, $froms, $tos, $refs, $times, $endtimes);
        $database->setMovementProc(implode(', ', $movementProcIDs));
        $database->setFieldTaken($fieldIDs);
        $database->addUnits($addUnitsWrefs);
        $database->addTech($addTechWrefs);
        $database->addABTech($addABTechWrefs);

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

    private function researchComplete() {
        global $database;

        $time = time();
        $deleteIDs = [];
        $tdata = [];
        $abdata = [];

        $q = "SELECT tech, vref, id FROM ".TB_PREFIX."research where timestamp < $time";
        $dataarray = $database->query_return($q);

        foreach($dataarray as $data) {
            $sort_type = substr($data['tech'],0,1);
            switch($sort_type) {
                case "t":
                    if (!isset($tdata[$data['vref']])) $tdata[$data['vref']] = [];
                    $tdata[$data['vref']][] = $data['tech'].' = 1';
                    break;
                case "a":
                case "b":
                    if (!isset($abdata[$data['vref']])) $abdata[$data['vref']] = [];
                    $abdata[$data['vref']][] = $data['tech']." = ".$data['tech']." + 1";
                    break;
            }
            $deleteIDs[] = (int) $data['id'];
        }

        // execute queries with consolidated research data
        if (count($tdata)) {
            foreach ( $tdata as $vid => $preparedData ) {
                $q = "UPDATE ".TB_PREFIX."tdata SET ".implode(', ', $preparedData)." WHERE vref = ".$vid;
                $database->query($q);
            }
        }

        if (count($abdata)) {
            foreach ( $abdata as $vid => $preparedData ) {
                $q = "UPDATE ".TB_PREFIX."abdata SET ".implode(', ', $preparedData)." WHERE vref = ".$vid;
                $database->query($q);
            }
        }

        if (count($deleteIDs)) {
            $q = "DELETE FROM " . TB_PREFIX . "research where id IN(" . implode( ', ', $deleteIDs ) . ")";
            $database->query( $q );
        }
    }

    private function updateORes($bountywid) {
    	global $database;
    	
    	$oasisInfoArray = $database->getOasisV($bountywid);
    	$timepast = time() - $oasisInfoArray['lastupdated'];
    	$nwood = (OASIS_WOOD_PRODUCTION / 3600) * $timepast;
    	$nclay = (OASIS_CLAY_PRODUCTION / 3600) * $timepast;
    	$niron = (OASIS_IRON_PRODUCTION / 3600) * $timepast;
    	$ncrop = (OASIS_CROP_PRODUCTION / 3600) * $timepast;
    	$database->modifyOasisResource($bountywid, $nwood, $nclay, $niron, $ncrop, 1);
    	$database->updateOasis($bountywid);
    }
    
    private function updateRes($bountywid) {
    	global $database, $technology;
    	
    	//Get village infos
    	$villageInfoArray = $database->getVillage($bountywid);
    	
    	//Get building and resource fields array
    	$resArray = $database->getResourceLevel($bountywid, false);
    	
    	//Get oasis array
    	$oasisArray = $database->getOasis($bountywid);
    	
    	//Get an array with the numbers of the oasis
    	$numberOfOasis = $this->bountysortOasis($oasisArray);
    	
    	//Set the village population (if WW Villages, it's halved)
    	$villagePopulation = !$villageInfoArray['natar'] ? $villageInfoArray['pop'] : round($villageInfoArray['pop'] / 2);
    	
    	//Get the upkeep of the village
    	$upkeep = $technology->getUpkeep($this->getAllUnits($bountywid), 0, $bountywid);   	
 
    	//Calculate the produced resources
    	$timepast = time() - $villageInfoArray['lastupdate'];
    	$nwood = ($this->bountyGetWoodProd($resArray, $numberOfOasis) / 3600) * $timepast;
    	$nclay = ($this->bountyGetClayProd($resArray, $numberOfOasis) / 3600) * $timepast;
    	$niron = ($this->bountyGetIronProd($resArray, $numberOfOasis) / 3600) * $timepast;
    	$ncrop = (($this->bountyGetCropProd($resArray, $numberOfOasis) - $villagePopulation - $upkeep) / 3600) * $timepast;
    	$database->modifyResource($bountywid, $nwood, $nclay, $niron, $ncrop, 1);
    	$database->updateVillage($bountywid);
    }

    private function bountysortOasis($oasisArray) {
        $crop = $clay = $wood = $iron = 0;
        foreach ($oasisArray as $oasis) {
            switch($oasis['type']) {
                case 1:
                case 2:
                    $wood++;
                    break;
                case 3:
                    $wood++;
                    $crop++;
                    break;
                case 4:
                case 5:
                    $clay++;
                    break;
                case 6:
                    $clay++;
                    $crop++;
                    break;
                case 7:
                case 8:
                    $iron++;
                    break;
                case 9:
                    $iron++;
                    $crop++;
                    break;
                case 10:
                case 11:
                    $crop++;
                    break;
                case 12:
                    $crop += 2;
                    break;
            }
        }
        return [$wood, $clay, $iron, $crop];
    }

    function getAllUnits($base, $use_cache = true) {
        global $database;

        $ownunit = $database->getUnit($base, $use_cache);
		$enforcementarray = $database->getEnforceVillage($base, 0);
		
		if(count($enforcementarray) > 0){
			foreach($enforcementarray as $enforce){
				for($i = 1; $i <= 50; $i++){
					$ownunit['u'.$i] += $enforce['u'.$i];
				}
			}
		}
		
		$enforceoasis = $database->getOasisEnforce($base, 0, $use_cache);
		if(count($enforceoasis) > 0){
			foreach($enforceoasis as $enforce){
				for($i = 1; $i <= 50; $i++){
					$ownunit['u'.$i] += $enforce['u'.$i];
				}
			}
		}
		
		$enforceoasis1 = $database->getOasisEnforce($base, 1, $use_cache);
		if(count($enforceoasis1) > 0){
			foreach($enforceoasis1 as $enforce){
				for($i = 1; $i <= 50; $i++){
					$ownunit['u'.$i] += $enforce['u'.$i];
				}
			}
		}
		
		$movement = $database->getVillageMovement($base);
		if(!empty($movement)){
			for($i = 1; $i <= 50; $i++){
				if(!isset($ownunit['u' . $i])){
					$ownunit['u'.$i] = 0;
				}
				
				$ownunit['u'.$i] += (isset($movement['u'.$i]) ? $movement['u'.$i] : 0);
			}
		}
		
		$prisoners = $database->getPrisoners($base, 1);
		if(!empty($prisoners)){
			foreach($prisoners as $prisoner){
				$owner = $database->getVillageField($base, "owner");
				$ownertribe = $database->getUserField($owner, "tribe", 0);
				$start = ($ownertribe - 1) * 10 + 1;
				$end = ($ownertribe * 10);
				for($i = $start; $i <= $end; $i++){
					$j = $i - $start + 1;
					$ownunit['u'.$i] += $prisoner['t'.$j];
				}
				$ownunit['hero'] += $prisoner['t11'];
			}
		}
		return $ownunit;
    }
    
    private function bountyGetWoodProd($resArray, $oasisNumber) {
        global $bid1, $bid5;
        
        $wood = $sawmill = 0;
        $woodholder = [];
        for($i = 1; $i <= 38; $i++) {
        	if($resArray['f'.$i.'t'] == 1) array_push($woodholder,'f'.$i);
            if($resArray['f'.$i.'t'] == 5) $sawmill = $resArray['f'.$i];
        }
        
        for($i = 0; $i <= count($woodholder) - 1; $i++) $wood += $bid1[$resArray[$woodholder[$i]]]['prod'];
        
        if($sawmill >= 1) $wood += $wood / 100 * $bid5[$sawmill]['attri'];
        if($oasisNumber[0] > 0) $wood += $wood * 0.25 * $oasisNumber[0];

        return round($wood * SPEED);
    }
    
    private function bountyGetClayProd($resArray, $oasisNumber) {
        global $bid2, $bid6;
        
        $clay = $brick = 0;
        $clayholder = [];
        for($i = 1; $i <= 38; $i++) {
        	if($resArray['f'.$i.'t'] == 2) array_push($clayholder, 'f'.$i);
        	if($resArray['f'.$i.'t'] == 6) $brick = $resArray['f'.$i];
        }
        
        for($i = 0; $i <= count($clayholder) - 1; $i++) $clay += $bid2[$resArray[$clayholder[$i]]]['prod'];
        
        if($brick >= 1) $clay += $clay / 100 * $bid6[$brick]['attri'];
        if($oasisNumber[1] > 0) $clay += $clay * 0.25 * $oasisNumber[1];

        return round($clay * SPEED);
    }

    private function bountyGetIronProd($resArray, $oasisNumber) {
        global $bid3, $bid7;
        
        $iron = $foundry = 0;
        $ironholder = [];
        for($i = 1; $i <= 38; $i++) {
        	if($resArray['f'.$i.'t'] == 3) array_push($ironholder, 'f'.$i);               
        	if($resArray['f'.$i.'t'] == 7) $foundry = $resArray['f'.$i];
        }
        
        for($i = 0; $i <= count($ironholder) - 1; $i++) $iron += $bid3[$resArray[$ironholder[$i]]]['prod'];
        
        if($foundry >= 1) $iron += $iron / 100 * $bid7[$foundry]['attri'];
        if($oasisNumber[2] > 0) $iron += $iron * 0.25 * $oasisNumber[2];

        return round($iron * SPEED);
    }

    private function bountyGetCropProd($resArray, $oasisNumber) {
        global $bid4, $bid8, $bid9, $database;
        
        $crop = $grainmill = $bakery = 0;
        $cropholder = [];
        for($i = 1; $i <= 38;$i++) {
        	if($resArray['f'.$i.'t'] == 4) array_push($cropholder, 'f'.$i);
        	if($resArray['f'.$i.'t'] == 8) $grainmill = $resArray['f'.$i];
        	if($resArray['f'.$i.'t'] == 9) $bakery = $resArray['f'.$i];
        }
        for($i = 0; $i <= count($cropholder) - 1; $i++) $crop += $bid4[$resArray[$cropholder[$i]]]['prod'];
        
        if($grainmill >= 1) $crop += $crop / 100 * (isset($bid8[$grainmill]['attri']) ? $bid8[$grainmill]['attri'] : 0);
        if($bakery >= 1) $crop += $crop / 100 * (isset($bid9[$bakery]['attri']) ? $bid9[$bakery]['attri'] : 0);                
        if($oasisNumber[3] > 0) $crop += $crop * 0.25 * $oasisNumber[3];       
        
        if(!empty($resArray['vref']) && is_numeric($resArray['vref'])){
        	$who = $database->getVillageField($resArray['vref'], "owner");
            $croptrue = $database->getUserField($who, "b4", 0);
            if($croptrue > time()) $crop *= 1.25;
        }
        
        return round($crop * SPEED);
    }

    private function trainingComplete() {
        global $database, $technology;

        $time = time();
        $trainlist = $database->getTrainingList();
        if(count($trainlist) > 0){
            // preload village data
            $vilIDs = [];
            foreach($trainlist as $train){
                $vilIDs[$train['vref']] = true;
            }
            $vilIDs = array_keys($vilIDs);
            $database->getProfileVillages($vilIDs, 5);
            $database->cacheResourceLevels($vilIDs);
            $database->getUnit($vilIDs);
            $database->getEnforceVillage($vilIDs, 0 );
            $database->getMovement(3, $vilIDs, 0);
            $database->getMovement(4, $vilIDs, 1);
            $database->getMovement(5, $vilIDs, 0);
            $database->getOasisEnforce($vilIDs, 0);
            $database->getOasisEnforce($vilIDs, 1);
            $database->getPrisoners($vilIDs, 1);

            // calculate training updates
            foreach($trainlist as $train){
                $timepast = $train['timestamp2'] - $time;
                $pop = $train['pop'];
                $valuesUpdated = false;
                if($timepast <= 0 && $train['amt'] > 0) {
                    $valuesUpdated = true;
                    if($train['eachtime'] > 0){                       
                        $timepast2 = $time - $train['timestamp2'];
                        $trained = 1;
                        while($timepast2 >= $train['eachtime']){
                            $timepast2 -= $train['eachtime'];
                            $trained += 1;
                        }
                        
                        if($trained > $train['amt']) $trained = $train['amt'];
                    }
                    else $trained = $train['amt'];               
                    
                    if($train['unit'] > 60 && $train['unit'] != 99){
                        $database->modifyUnit($train['vref'], [$train['unit'] - 60], [$trained], [1]);
                    }
                    else $database->modifyUnit($train['vref'], [$train['unit']], [$trained], [1]);
                
                    $database->updateTraining($train['id'], $trained, $trained * $train['eachtime']);
                    
                    if($train['amt'] - $trained <= 0) $database->trainUnit($train['id'], 0, 0, 0, 0, 1);
                }

                if ($valuesUpdated) call_user_func(get_class($database).'::clearUnitsCache');
             
                //Update starvation data
                $database->addStarvationData($train['vref']);
            }
        }
    }

    private function getsort_typeLevel($tid, $resarray) {
        $keyholder = [];

        foreach(array_keys($resarray, $tid) as $key) {
            if(strpos($key, 't')) {
                $key = preg_replace("/[^0-9]/", '', $key);
                array_push($keyholder, $key);
            }
        }

        $element = count($keyholder);
        if($element >= 2) {
            if($tid <= 4) {
                $temparray = [];

                for($i = 0; $i <= $element - 1; $i++) {
                    array_push($temparray, $resarray['f'.$keyholder[$i]]);
                }

                foreach ($temparray as $key => $val) {
                    if ($val == max($temparray)) $target = $key;                   
                }
            }
        }
        else if($element == 1) $target = 0;
        else return 0;

        if(!empty($keyholder[$target])) return $resarray['f'.$keyholder[$target]];
        else return 0;
    }

    private function celebrationComplete() {
        global $database;

        $varray = $database->getCel();
        foreach($varray as $vil){
            $id = $vil['wref'];
            $type = $vil['type'];
            $user = $vil['owner'];
            $cp = ($type == 1) ? 500 : 2000;           
            $database->clearCel($id);
            $database->setCelCp($user, $cp);
        }
    }

    private function demolitionComplete() {
        global $database;

        $varray = $database->getDemolition();
        foreach($varray as $vil) {
            if ($vil['timetofinish'] <= time()) {
                $type = $database->getFieldType($vil['vref'],$vil['buildnumber']);
                $level = $database->getFieldLevel($vil['vref'],$vil['buildnumber']);

                if ($level < 0) $level = 0;

                $buildarray = $GLOBALS["bid".$type];

                if ($type == 10 || $type == 38) {
                    $database->query("
                        UPDATE ".TB_PREFIX."vdata
                            SET
                                `maxstore` = IF(`maxstore` - ".$buildarray[$level]['attri']." <= ".STORAGE_BASE.", ".STORAGE_BASE.", `maxstore` - ".$buildarray[$level]['attri']."),
                            WHERE
                                wref=".(int) $vil['vref']);
                }

                if ($type == 11 || $type == 39) {
                    $database->query("
                        UPDATE ".TB_PREFIX."vdata
                            SET
                                `maxcrop` = IF(`maxcrop` - ".$buildarray[$level]['attri']." <= ".STORAGE_BASE.", ".STORAGE_BASE.", `maxcrop` - ".$buildarray[$level]['attri']."),
                            WHERE
                                wref=".(int) $vil['vref']);
                }

                if ($level == 1) $clear = ",f".$vil['buildnumber']."t=0";
                else $clear = "";

                if ($database->getVillageField($vil['vref'], 'natar') == 1 && $type == 40) $clear = ""; //fix by ronix - fixed by iopietro

                $q = "UPDATE ".TB_PREFIX."fdata SET f".$vil['buildnumber']."=".(($level - 1 >= 0) ? $level - 1 : 0).$clear." WHERE vref=".(int) $vil['vref'];
                $database->query($q);

                $pop = $this->getPop($type, $level - 1);
                $database->modifyPop($vil['vref'], $pop[0], 1);
                $this->procClimbers($database->getVillageField($vil['vref'], 'owner'));
                $database->delDemolition($vil['vref'], true);

                if ($type == 18) Automation::updateMax($database->getVillageField($vil['vref'], 'owner'));
            }
        }

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
                $newHealth = -1;

                if((time()-$hdata['lastupdate']) >= 1){
                    if($hdata['health'] < 100 and $hdata['health'] > 0){
                        if(SPEED <= 10) $speed = SPEED;                           
                        else if(SPEED <= 100) $speed = ceil(SPEED / 10);                           
                        else $speed = ceil(SPEED / 100);

                        $reg = $hdata['health'] + $hdata['regeneration'] * 5 * $speed / 86400 * (time() - $hdata['lastupdate']);

                        if($reg <= 100) $newHealth = $reg;                        
                        else $newHealth = 100;                      
                    }
                }

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
                    $columnValues[] = $newLevel;
                    $modes[] = null;
                }

                // add as many points as needed, if we're below level 100
                if ($scorePoints) {
                    $columns[] = 'points';
                    $columnValues[] = (5 * ($newLevel - $herolevel));
                    $modes[] = 1;
                }

                $villunits = $unitData[$hdata['wref']];
                if($hdata['trainingtime'] < time() && $hdata['inrevive'] == 1){
                    mysqli_query($database->dblink,"UPDATE " . TB_PREFIX . "units SET hero = 1 WHERE vref = ".(int) $hdata['wref']."");

                    $columns[] = 'dead';
                    $columnValues[] = 0;
                    $modes[] = null;

                    $columns[] = 'inrevive';
                    $columnValues[] = 0;
                    $modes[] = null;

                    $columns[] = 'inrevive';
                    $columnValues[] = 0;
                    $modes[] = null;

                    $newHealth = 100;
                    $lastUpdateTime = (int) $hdata['trainingtime'];
                }

                if($hdata['trainingtime'] < time() && $hdata['intraining'] == 1){
                    mysqli_query($database->dblink,"UPDATE " . TB_PREFIX . "units SET hero = 1 WHERE vref = ".(int) $hdata['wref']);

                    $columns[] = 'dead';
                    $columnValues[] = 0;
                    $modes[] = null;

                    $columns[] = 'intraining';
                    $columnValues[] = 0;
                    $modes[] = null;

                    $lastUpdateTime = (int) $hdata['trainingtime'];
                }

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

    // by SlimShady95, aka Manuel Mannhardt < manuel_mannhardt@web.de > UPDATED FROM songeriux < haroldas.snei@gmail.com >
    private function updateStore() {
        global $database, $bid10, $bid38, $bid11, $bid39;

        $result = mysqli_query($database->dblink, 'SELECT * FROM `' . TB_PREFIX . 'fdata`');

        mysqli_begin_transaction($database->dblink);
        while ($row = mysqli_fetch_assoc($result))
        {
            $ress = $crop = 0;
            for ($i = 19; $i < 40; ++$i)
            {
                //Warehouse
                if ($row['f' . $i . 't'] == 10)
                {
                    $ress += ((isset($bid10[$row['f' . $i]]) && isset($bid10[$row['f' . $i]]['attri'])) ? $bid10[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                }

                //Great warehouse
                if ($row['f' . $i . 't'] == 38)
                {
                    $ress += ((isset($bid38[$row['f' . $i]]) && isset($bid38[$row['f' . $i]]['attri'])) ? $bid38[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                }
                
                //Granary
                if ($row['f' . $i . 't'] == 11)
                {
                    $crop += ((isset($bid11[$row['f' . $i]]) && isset($bid11[$row['f' . $i]]['attri'])) ? $bid11[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                }
              
                //Great granary
                if ($row['f' . $i . 't'] == 39)
                {
                    $crop += ((isset($bid39[$row['f' . $i]]) && isset($bid39[$row['f' . $i]]['attri'])) ? $bid39[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                }
            }

            // no need for update, since we didn't find any warehouses or granaries
            // and maximums would have been set to correct values inside prune* functions already
            if ($ress == 0 && $crop == 0) continue;

            // maxstore nor maxcrop can go below the minimum threshold
            if ($ress < STORAGE_BASE) $ress = STORAGE_BASE;
            if ($crop < STORAGE_BASE) $crop = STORAGE_BASE;

            mysqli_query($database->dblink,'UPDATE `' . TB_PREFIX . 'vdata` SET `maxstore` = ' . (int) $ress . ', `maxcrop` = ' . (int) $crop . ' WHERE `wref` = ' . (int) $row['vref']);
        }
        mysqli_commit($database->dblink);
    }

    /*private function oasisResourcesProduce() {
        global $database;

        $speedMultiplier = (8 * (SPEED/3600));
        $database->query("
            UPDATE " . TB_PREFIX . "odata
                SET
                    lastupdated = UNIX_TIMESTAMP(),
                    wood = IF(wood + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated)) > maxstore, maxstore, wood + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated))),
                    clay = IF(clay + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated)) > maxstore, maxstore, clay + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated))),
                    iron = IF(iron + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated)) > maxstore, maxstore, iron + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated))),
                    crop = IF(crop + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated)) > maxcrop, maxcrop, crop + ($speedMultiplier * (UNIX_TIMESTAMP() - lastupdated)))
                WHERE
                    wood < 800 OR
                    clay < 800 OR
                    iron < 800 OR
                    crop < 800");
    }*/

    private function checkInvitedPlayes() {
        global $database;
        
        $q = "SELECT id, invited FROM ".TB_PREFIX."users WHERE invited > 0";
        $array = $database->query_return($q);

        // preload villages data
        $userIDs = [];
        foreach($array as $user) {
            $userIDs[] = $user['id'];
        }
        $database->getProfileVillages($userIDs);

        // continue...
        foreach($array as $user) {
            $numusers = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT Count(*) as Total FROM ".TB_PREFIX."users WHERE id = ".(int) $user['invited']), MYSQLI_ASSOC);
            if($numusers['Total'] > 0){
                $varray = count($database->getProfileVillages($user['id']));
                if($varray > 1){
                    $usergold = $database->getUserField($user['invited'],"gold",0);
                    $gold = $usergold+50;
                    $database->updateUserField($user['invited'],"gold",$gold,1);
                    $database->updateUserField($user['id'],"invited",0,1);
                }
            }
        }
    }

    private function updateGeneralAttack() {
        global $database;

        mysqli_query($database->dblink, "
            UPDATE ".TB_PREFIX."general
                SET
                    shown = 0
                WHERE
                    shown = 1 AND
                    `time` < (UNIX_TIMESTAMP() - (86400 * 8))");
    }

    private function MasterBuilder() {
        global $database;
        
        $q = "SELECT id, wid, type, level, field, timestamp FROM ".TB_PREFIX."bdata WHERE master = 1";
        $array = $database->query_return($q);

        foreach($array as $master) {      
            $owner = $database->getVillageField($master['wid'], 'owner');
            $tribe = $database->getUserField($owner, 'tribe', 0);
            $villwood = $database->getVillageField($master['wid'], 'wood');
            $villclay = $database->getVillageField($master['wid'], 'clay');
            $villiron = $database->getVillageField($master['wid'], 'iron');
            $villcrop = $database->getVillageField($master['wid'], 'crop');
            $type = $master['type'];
            $level = $master['level'];
            $buildarray = $GLOBALS["bid".$type];
            $buildwood = $buildarray[$level]['wood'];
            $buildclay = $buildarray[$level]['clay'];
            $buildiron = $buildarray[$level]['iron'];
            $buildcrop = $buildarray[$level]['crop'];
            $ww = count($database->getBuildingByType($master['wid'], 40));

            if($tribe == 1){
                if($master['field'] < 19){
                    $bdata = $database->getDorf1Building($master['wid']);
                    $bdataTotal = count($bdata);
                    $bbdata = count($database->getDorf2Building($master['wid']));
                }else{
                    $bdata = $database->getDorf2Building($master['wid']);
                    $bdataTotal = count($bdata);
                    $bbdata = count($database->getDorf1Building($master['wid']));
                }
            }else{
                $bdata = array_merge($database->getDorf1Building($master['wid']), $database->getDorf2Building($master['wid']));
                $bdataTotal = $bbdata = count($bdata);          
            }

            if($database->getUserField($owner, 'plus', 0) > time() || $ww > 0){
                if($bbdata < 2) $inbuild = 2;                
                else $inbuild = 1;
            }
            else $inbuild = 1;

            $usergold = $database->getUserField($owner, 'gold', 0);

            if($bdataTotal < $inbuild && $buildwood <= $villwood && $buildclay <= $villclay && $buildiron <= $villiron && $buildcrop <= $villcrop && $usergold > 0){
                $time = $master['timestamp'] + time();

                if(!empty($bdata)){
                    foreach($bdata as $masterLoop) $time += ($masterLoop['timestamp'] - time());
                }

                if($bdataTotal == 0) $database->updateBuildingWithMaster($master['id'], $time, 0);                  
                else $database->updateBuildingWithMaster($master['id'], $time, 1);             

                $database->updateUserField($owner, 'gold', --$usergold, 1);
                $database->modifyResource($master['wid'], $buildwood, $buildclay, $buildiron, $buildcrop, 0);
            }
        }
    }
    
    /**
     * Function for starvation - by brainiacX and Shadow
     * Rework by ronix
     * Refactored by iopietro
     */
    
    //TODO: This function needs to be splitted in many subfunctions (for TravianZ refactor)
    private function starvation() {
        global $database, $technology;

        //Starvation is disabled during Easter/Holidays/Christmas
        if(PEACE) return;
        
        $time = time();

        //Update starvation in every village
        $starvarray = $database->getProfileVillages(0, 7);
        foreach($starvarray as $starv) $database->addStarvationData($starv['wref']);

        //Load villages with minus prod
        $starvarray = [];
        $starvarray = $database->getStarvation();

        $vilIDs = [];
        foreach ($starvarray as $starv) $vilIDs[] = $starv['wref'];
        
        //Cache
        $database->getEnforceVillage($vilIDs, 0);
        $database->getOasisEnforce($vilIDs, 2);
        $database->getOasisEnforce($vilIDs, 3);
        $database->getPrisoners($vilIDs, 1);
        $database->getMovement(3, $vilIDs, 0);
        $database->getMovement(4, $vilIDs, 1);

        foreach ($starvarray as $starv)
        {
            $unitarrays = $this->getAllUnits($starv['wref']);

            $upkeep = $starv['pop'] + $technology->getUpkeep($unitarrays, 0, $starv['wref']);                    
            
            $enforceArrays = $prisonerArrays = $unitArrays = $attackArrays = $allTroopsArray = $starvingTroops = $killedUnits = [];
            
            $enforceArrays = [$database->getOasisEnforce($starv['wref'], 2),
                                 $database->getOasisEnforce($starv['wref'], 3),
                                 $database->getEnforceVillage($starv['wref'], 2),
                                 $database->getEnforceVillage($starv['wref'], 3)];
            
            $prisonerArrays = [$database->getPrisoners($starv['wref'], 1)];
            
            $unitArrays = ($database->getUnitsNumber($starv['wref'], 0) > 0) ? [[$database->getUnit($starv['wref'])]] : [];

            $attackArrays = [$database->getMovement(3, $starv['wref'], 0),
                                $database->getMovement(4, $starv['wref'], 1)];

            $allTroopsArray = [$enforceArrays, $prisonerArrays, $unitArrays, $attackArrays];

            //Find the first not-empty array
            foreach($allTroopsArray as $type => $allTroops)
            {
                if(!empty($allTroops)){
                    foreach($allTroops as $subtype => $troops){
                        if(!empty($troops)){
                            $starvingTroops = reset($troops);
                            break 2;
                        }
                    }
                }                            
            }

            //If the player has no troops, then skip the next instructions
            if(empty($starvingTroops)) continue;
				
			//Counting
			$timedif = $time - $starv['starvupdate'];
            $cropProd = $database->getCropProdstarv($starv['wref']) - $starv['starv'];
            if($cropProd < 0){
                $starvsec = (abs($cropProd) / 3600);
                $difcrop = ($timedif * $starvsec); //crop eat up over time
                $newcrop = 0;
                $oldcrop = $database->getVillageField($starv['wref'], 'crop');
                
                //If the grain is then tries to send all
                if ($oldcrop > 100){
                    $difcrop = $difcrop - $oldcrop;
					if($difcrop < 0){
						$difcrop = 0;
						$newcrop = $oldcrop - $difcrop;
						$database->setVillageField($starv['wref'], 'crop', $newcrop);
					}
                }

                if($difcrop > 0 && $oldcrop <= 0){
                    $tribe = $database->getUserField(($type == 2) ? $starv['owner'] : $database->getVillageField($starvingTroops['from'], "owner"), "tribe", 0);
                    $start = ($special = in_array($type, [1, 3])) ? 1 : ($tribe - 1) * 10 + 1;
                    $end = ($special) ? 10 : $tribe * 10 ;
                    $utype = ($special) ? 't' : 'u';
                    $heroType = ($special) ? 't11' : 'hero';

                    $totalUnits = 0;
                    $counting = true;
                    while($difcrop > 0)
                    {
                        //S earch the highest troop
                        $maxcount = $maxtype = 0;                    
                        for($i = $start ; $i <= $end ; $i++)
                        {
                            $units = (isset($starvingTroops[$utype.$i]) ? $starvingTroops[$utype.$i] : 0);
                            if($counting) $totalUnits += $units;
                            if($units > $maxcount){
                                $maxcount = $units;
                                $maxtype = $i;
                            }                       
                        }
                        if($counting) $counting = false;
                        
                        if($maxtype > 0){
                            $starvingTroops[$utype.$maxtype]--;
                            if ( !isset($killedUnits[$maxtype]) ) {
                                $killedUnits[$maxtype] = 0;
                            }
                            $killedUnits[$maxtype]++;                      
                            $difcrop -= $GLOBALS['u'.(($special) ? $maxtype + ($tribe - 1) * 10 : $maxtype)]['crop'];
                        }
                        else break;
                    }

                    $totalKilledUnits = array_sum($killedUnits);
                    if($starvingTroops[$heroType] > 0 && ($totalUnits == 0 || $totalUnits == $totalKilledUnits)){
                        $totalKilledUnits += $starvingTroops[$heroType];
                        $totalUnits += $starvingTroops[$heroType];
                        $starvingTroops['heroinfo'] = $database->getHero(($type == 2) ? $starv['owner'] : $database->getVillageField(($type == 3 && $subtype == 1) ? $starvingTroops['to'] : $starvingTroops['from'], "owner"))[0];
                        $database->modifyHero("dead", 1, $starvingTroops['heroinfo']['heroid']);
                        $database->modifyHero("health", 0, $starvingTroops['heroinfo']['heroid']);
                        $newCrop = $GLOBALS['h'.$starvingTroops['heroinfo']['unit'].'_full'][min($starvingTroops['heroinfo']['level'], 60)]['crop'] + $difcrop;              
                    }
                    else if($maxtype == 0) $newCrop = 0;
                    else $newCrop = $GLOBALS['u'.$maxtype]['crop'];

                    if($totalKilledUnits > 0){                   
                        switch($type){
                            case 0:                                
                                if($totalKilledUnits < $totalUnits){
                                    $database->modifyEnforce($starvingTroops['id'], array_keys($killedUnits), array_values($killedUnits), 0);  
                                }                                                              
                                else $database->deleteReinf($starvingTroops['id']);                         
                                break;                        
                                
                            case 1:                            
                                if($totalKilledUnits < $totalUnits){
                                    $database->modifyPrisoners($starvingTroops['id'],  array_keys($killedUnits), array_values($killedUnits), 0);
                                    $database->modifyUnit($starvingTroops['wref'], ["99o"], [$totalKilledUnits], [0]);
                                }else{ 
                                    $database->deletePrisoners($starvingTroops['id']);
                                    $database->modifyUnit($starvingTroops['wref'], ["99o"], [$totalUnits], [0]);
                                }
                                break;
                                
                            case 2:
                                $database->modifyUnit($starv['wref'], array_keys($killedUnits), array_values($killedUnits), [0]);
                                break;
                                
                            case 3:
                                if($totalKilledUnits < $totalUnits){
                                    $database->modifyAttack2($starvingTroops['id'], array_keys($killedUnits), array_values($killedUnits), 0);
                                }
                                else $database->setMovementProc($starvingTroops['moveid']);
                                break;
                        }
                        
                        $database->modifyResource($starv['wref'], 0, 0, 0, max($newCrop, 0), 1);
                        $database->setVillageField($starv['wref'], ['starv', 'starvupdate'], [$upkeep, $time]);                        
                    }
                }
            }

            $crop = $database->getCropProdstarv($starv['wref'], false);        
            if ($crop > $upkeep) $database->setVillageFields($starv['wref'], ['starv', 'starvupdate'], [0, 0]);         

            unset ($unitarrays, $type, $subtype);
        }
    }

    private function procNewClimbers() {
    	global $database, $ranking;

        $ranking->procRankArray();
        $climbers = $ranking->getRank();
        if(count($climbers) > 0){
            $q = "SELECT week FROM ".TB_PREFIX."medal order by week DESC LIMIT 0, 1";
            $result = mysqli_query($database->dblink,$q);
            if(mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $week = $row['week'] + 1;
            }
            else $week = 1;

            $q = "SELECT id FROM ".TB_PREFIX."users where oldrank = 0 and id > 5";
            $array = $database->query_return($q);
            foreach($array as $user){
                $newrank = $ranking->getUserRank($user['id']);
                if($week > 1){
                    for($i = $newrank + 1; $i < count($climbers); $i++) {
                        if(isset($climbers[$i]['userid'])){
                            $oldrank = $ranking->getUserRank($climbers[$i]['userid']);
                            $totalpoints = $oldrank - $climbers[$i]['oldrank'];
                            $database->removeclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }                      
                    }
                    $database->updateoldrank($user['id'], $newrank);
                }else{
                    $totalpoints = count($climbers) - $newrank;
                    $database->setclimberrankpop($user['id'], $totalpoints);
                    $database->updateoldrank($user['id'], $newrank);
                    for($i = 1; $i < $newrank; $i++){
                        if(isset($climbers[$i]['userid'])){
                            $oldrank = $ranking->getUserRank($climbers[$i]['userid']);
                            $totalpoints = count($climbers) - $oldrank;
                            $database->setclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }                     
                    }
                    for($i = $newrank + 1; $i < count($climbers); $i++){
                        if(isset($climbers[$i]['userid'])){
                            $oldrank = $ranking->getUserRank($climbers[$i]['userid']);
                            $totalpoints = count($climbers) - $oldrank;
                            $database->setclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }                      
                    }
                }
            }
        }
    }

    private function procClimbers($uid) {
        global $database, $ranking;
        
        $ranking->procRankArray();
        $climbers = $ranking->getRank();
        if(count($ranking->getRank()) > 0){
            $q = "SELECT week FROM ".TB_PREFIX."medal order by week DESC LIMIT 0, 1";
            $result = mysqli_query($database->dblink,$q);
            if(mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $week = $row['week'] + 1;
            }
            else $week = 1;

            $myrank = $ranking->getUserRank($uid);
            if(isset($climbers[$myrank]['oldrank']) && $climbers[$myrank]['oldrank'] > $myrank){
                for($i = $myrank + 1; $i <= $climbers[$myrank]['oldrank']; $i++) {
                    if(isset($climbers[$i]['oldrank'])){
                        $oldrank = $ranking->getUserRank($climbers[$i]['userid']);
                        if($week > 1){
                            $totalpoints = $oldrank - $climbers[$i]['oldrank'];
                            $database->removeclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }else{
                            $totalpoints = count($ranking->getRank()) - $oldrank;
                            $database->setclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }
                    }              
                }
                if(isset($climbers[$myrank]['oldrank'])){
                    if($week > 1){
                        $totalpoints = $climbers[$myrank]['oldrank'] - $myrank;
                        $database->addclimberrankpop($climbers[$myrank]['userid'], $totalpoints);
                        $database->updateoldrank($climbers[$myrank]['userid'], $myrank);
                    }else{
                        $totalpoints = count($ranking->getRank()) - $myrank;
                        $database->setclimberrankpop($climbers[$myrank]['userid'], $totalpoints);
                        $database->updateoldrank($climbers[$myrank]['userid'], $myrank);
                    }
                }        
            }else if(isset($climbers[$myrank]['oldrank']) && $climbers[$myrank]['oldrank'] < $myrank){
                for($i = $climbers[$myrank]['oldrank']; $i < $myrank; $i++) {
                    if(isset($climbers[$i]['oldrank'])){
                        $oldrank = $ranking->getUserRank($climbers[$i]['userid']);
                        if($week > 1){
                            $totalpoints = $climbers[$i]['oldrank'] - $oldrank;
                            $database->addclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }else{
                            $totalpoints = count($ranking->getRank()) - $oldrank;
                            $database->setclimberrankpop($climbers[$i]['userid'], $totalpoints);
                            $database->updateoldrank($climbers[$i]['userid'], $oldrank);
                        }
                    }          
                }
                if(isset($climbers[$myrank-1]['oldrank'])){
                    if($week > 1){
                        $totalpoints = $myrank - $climbers[$myrank-1]['oldrank'];
                        $database->removeclimberrankpop($climbers[$myrank-1]['userid'], $totalpoints);
                        $database->updateoldrank($climbers[$myrank-1]['userid'], $myrank);
                    }else{
                        $totalpoints = count($ranking->getRank()) - $myrank;
                        $database->setclimberrankpop($climbers[$myrank-1]['userid'], $totalpoints);
                        $database->updateoldrank($climbers[$myrank-1]['userid'], $myrank);
                    }
                }               
            }
        }
        $ranking->procARankArray();
        $aid = $database->getUserField($uid,"alliance",0);
        if(count($ranking->getRank()) > 0 && $aid != 0){
            $ally = $database->getAlliance($aid);
            $memberlist = $database->getAllMember($ally['id']);
            $oldrank = 0;

            $memberIDs = [];
            foreach($memberlist as $member) {
                $memberIDs[] = $member['id'];
            }
            $data = $database->getVSumField($memberIDs,"pop");

            if (count($data)) {
                foreach ($data as $row) {
                    $oldrank += $row['Total'];
                }
            }

            if($ally['oldrank'] != $oldrank){
                if($ally['oldrank'] < $oldrank) {
                    $totalpoints = $oldrank - $ally['oldrank'];
                    $database->addclimberrankpopAlly($ally['id'], $totalpoints);
                    $database->updateoldrankAlly($ally['id'], $oldrank);
                } else
                    if($ally['oldrank'] > $oldrank) {
                        $totalpoints = $ally['oldrank'] - $oldrank;
                        $database->removeclimberrankpopAlly($ally['id'], $totalpoints);
                        $database->updateoldrankAlly($ally['id'], $oldrank);
                    }
            }
        }
    }

    private function checkBan() {
        global $database;

        mysqli_query($database->dblink, "
            UPDATE ".TB_PREFIX."banlist as b
                JOIN ".TB_PREFIX."users as u ON b.uid = u.id
                    SET
                        b.active = 0,
                        u.access = 2
                    WHERE
                        b.active = 1 AND
                        b.`end` < UNIX_TIMESTAMP() AND
                        b.`end` > 0");
    }

    private function regenerateOasisTroops() {
        global $database;
        
        $timeFinal = time() - NATURE_REGTIME;
        $q = "SELECT wref FROM " . TB_PREFIX . "odata where conqured = 0 and lastupdated2 < $timeFinal";
        $array = $database->query_return($q);
        if (count($array)) {
            $ids = [];
            foreach($array as $oasis) $ids[] = $oasis['wref'];
            $database->regenerateOasisUnits($ids, true);
        }
    }

    public static function updateMax($leader) {
        global $bid18, $database;
        
        $q = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT Count(*) as Total FROM " . TB_PREFIX . "alidata where leader = ". (int) $leader), MYSQLI_ASSOC);
        if ($q['Total'] > 0) {
            $villages = $database->getVillagesID2($leader);
            $max = 0;

            // cache resource levels
            $vilIDs = [];
            foreach($villages as $village){
                $vilIDs[$village['wref']] = true;
            }
            $database->cacheResourceLevels(array_keys($vilIDs));

            foreach($villages as $village){
                $field = $database->getResourceLevel($village['wref'], false);
                for($i = 19; $i <= 40; $i++){
                    if($field['f'.$i.'t'] == 18){
                        $level = $field['f'.$i];
                        $attri = $bid18[$level]['attri'];
                    }
                }
                if($attri > $max){
                    $max = $attri;
                }
            }
            $q = "UPDATE ".TB_PREFIX."alidata set max = ".(int) $max." where leader = ".(int) $leader;
            $database->query($q);
        }
    }

    /**
     * Function for automate medals - by yi12345 and Shadow
     *
     */
    
    function medals(){
        global $ranking, $database;

        //we may give away ribbons
        $giveMedal = false;
        $q = "SELECT lastgavemedal FROM ".TB_PREFIX."config";
        $result = mysqli_query($database->dblink,$q);
        if($result) {
            $row = mysqli_fetch_assoc($result);
            $stime = strtotime(START_DATE) - strtotime(date('d.m.Y')) + strtotime(START_TIME);
            if($row['lastgavemedal'] == 0 && $stime < time()){
                $setDays = round(MEDALINTERVAL / 86400);
                $newtime = $setDays < 7 ? strtotime(($setDays + 1).'day midnight') : strtotime('next monday');
                $q = "UPDATE ".TB_PREFIX."config SET lastgavemedal = ".(int) $newtime;
                $database->query($q);
            }elseif($row['lastgavemedal'] != 0){
                $time = $row['lastgavemedal'] + MEDALINTERVAL;
                $giveMedal = $row['lastgavemedal'] < time();
            }
        }

        if($giveMedal && MEDALINTERVAL > 0){

            //determine which week we are

            $q = "SELECT week FROM ".TB_PREFIX."medal order by week DESC LIMIT 0, 1";
            $result = mysqli_query($database->dblink,$q);
            if(mysqli_num_rows($result)) {
                $row=mysqli_fetch_assoc($result);
                $week=($row['week']+1);
            } else {
                $week='1';
            }

            //Do same for ally week

            $q = "SELECT week FROM ".TB_PREFIX."allimedal order by week DESC LIMIT 0, 1";
            $result = mysqli_query($database->dblink,$q);
            if(mysqli_num_rows($result)) {
                $row=mysqli_fetch_assoc($result);
                $allyweek=($row['week']+1);
            } else {
                $allyweek='1';
            }


            //Attackers of the week
            $result = mysqli_query($database->dblink,"SELECT id, ap FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY ap DESC, id DESC Limit 10");
            $i=0;
            while($row = mysqli_fetch_array($result)){
                $i++;
                $img="t2_".($i)."";
                $quer="insert into ".TB_PREFIX."medal (userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", 1, ".($i).", ".(int) $week.", '".$row['ap']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Defender of the week
            $result = mysqli_query($database->dblink,"SELECT id, dp FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY dp DESC, id DESC Limit 10");
            $i=0;
            while($row = mysqli_fetch_array($result)){
                $i++;
                $img="t3_".($i)."";
                $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '2', ".($i).", '".(int) $week."', '".$row['dp']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Climbers of the week
            $result = mysqli_query($database->dblink,"SELECT id, Rc FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY Rc DESC, id DESC Limit 10");
            $i=0;
            while($row = mysqli_fetch_array($result)){
                $i++;
                $img="t1_".($i)."";
                $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '3', ".($i).", '".(int) $week."', '".$row['Rc']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Rank climbers of the week
            $result = mysqli_query($database->dblink,"SELECT id, clp FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY clp DESC Limit 10");
            $i=0;
            while($row = mysqli_fetch_array($result)){
                $i++;
                $img="t6_".($i)."";
                $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '10', ".($i).", '".(int) $week."', '".$row['clp']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Robbers of the week
            $result = mysqli_query($database->dblink,"SELECT id, RR FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY RR DESC, id DESC Limit 10");
            $i=0;
            while($row = mysqli_fetch_array($result)){
                $i++;
                $img="t4_".($i)."";
                $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '4', ".($i).", '".(int) $week."', '".$row['RR']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Part of the bonus for top 10 attack + defense out
            //Top10 attackers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY ap DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                //Top 10 defenders
                $result2 = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY dp DESC, id DESC Limit 10");
                while($row2 = mysqli_fetch_array($result2)){
                    if($row['id']==$row2['id']){

                        $query3="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 5";
                        $result3=mysqli_query($database->dblink,$query3);
                        $row3=mysqli_fetch_row($result3);

                        //Look what color the ribbon must have
                        if($row3[0]<='2'){
                            $img="t22".$row3[0]."_1";
                            switch ($row3[0]) {
                                case "0":
                                    $tekst="";
                                    break;
                                case "1":
                                    $tekst="twice ";
                                    break;
                                case "2":
                                    $tekst="three times ";
                                    break;
                            }
                            $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '5', '0', '".(int) $week."', '".$tekst."', '".$img."')";
                            $resul=mysqli_query($database->dblink,$quer);
                        }
                    }
                }
            }

            //you stand for 3rd / 5th / 10th time in the top 3 strikers
            //top10 attackers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY ap DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 1 AND plaats<=3";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x at present as it is so ribbon 3rd (bronze)
                if($row1[0]=='3'){
                    $img="t120_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '6', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x at present as it is so 5th medal (silver)
                if($row1[0]=='5'){
                    $img="t121_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '6', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t122_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '6', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }

            }
            //you stand for 3rd / 5th / 10th time in the top 10 attackers
            //top10 attackers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY ap DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 1 AND plaats<=10";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t130_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '12', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t131_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '12', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t132_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '12', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }

            }
            //je staat voor 3e / 5e / 10e keer in de top 3 verdedigers
            //Pak de top10 verdedigers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY dp DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 2 AND plaats<=3";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t140_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '7', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t141_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '7', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t142_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '7', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }

            }
            //je staat voor 3e / 5e / 10e keer in de top 3 verdedigers
            //Pak de top10 verdedigers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY dp DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 2 AND plaats<=10";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t150_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '13', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t151_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '13', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t152_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '13', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }

            }

            //je staat voor 3e / 5e / 10e keer in de top 3 klimmers
            //Pak de top10 klimmers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY Rc DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 3 AND plaats<=3";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t100_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '8', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t101_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '8', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t102_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '8', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
            }
            //je staat voor 3e / 5e / 10e keer in de top 3 klimmers
            //Pak de top10 klimmers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY Rc DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 3 AND plaats<=10";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t110_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '14', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t111_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '14', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t112_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '14', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
            }

            //je staat voor 3e / 5e / 10e keer in de top 3 klimmers
            //Pak de top3 rank climbers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY clp DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 10 AND plaats<=3";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t200_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '11', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t201_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '11', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t202_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '11', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
            }
            //je staat voor 3e / 5e / 10e keer in de top 10klimmers
            //Pak de top3 rank climbers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY clp DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 10 AND plaats<=10";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t210_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '16', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t211_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '16', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t212_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '16', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
            }

            //je staat voor 3e / 5e / 10e keer in de top 10 overvallers
            //Pak de top10 overvallers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY RR DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 4 AND plaats<=3";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t160_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '9', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t161_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '9', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t162_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '9', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
            }
            //je staat voor 3e / 5e / 10e keer in de top 10 overvallers
            //Pak de top10 overvallers
            $result = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY RR DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                $query1="SELECT Count(*) FROM ".TB_PREFIX."medal WHERE userid=".(int) $row['id']." AND categorie = 4 AND plaats<=10";
                $result1=mysqli_query($database->dblink,$query1);
                $row1=mysqli_fetch_row($result1);


                //2x in gestaan, dit is 3e dus lintje (brons)
                if($row1[0]=='3'){
                    $img="t170_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '15', '0', '".(int) $week."', 'Three', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //4x in gestaan, dit is 5e dus lintje (zilver)
                if($row1[0]=='5'){
                    $img="t171_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '15', '0', '".(int) $week."', 'Five', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
                //9x at present as it is so 10th medal (gold)
                if($row1[0]=='10'){
                    $img="t172_1";
                    $quer="insert into ".TB_PREFIX."medal(userid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '15', '0', '".(int) $week."', 'Ten', '".$img."')";
                    $resul=mysqli_query($database->dblink,$quer);
                }
            }

            //Put all true dens to 0
            $query="SELECT id FROM ".TB_PREFIX."users WHERE id > 5 AND access < 8 ORDER BY id+0 DESC";
            $result=mysqli_query($database->dblink,$query);
            $userIDs = [];
            for ($i=0; $row=mysqli_fetch_row($result); $i++){
                $userIDs[] = (int) $row[0];
            }

            if (count($userIDs)) {
                mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."users SET ap=0, dp=0,Rc=0,clp=0, RR=0 WHERE id IN(".implode(', ', $userIDs).")");
            }

            //Start alliance Medals wooot

            //Aanvallers v/d Week
            $result = mysqli_query($database->dblink,"SELECT id, ap FROM ".TB_PREFIX."alidata ORDER BY ap DESC, id DESC Limit 10");
            $i=0;     while($row = mysqli_fetch_array($result)){
                $i++;    $img="a2_".($i)."";
                $quer="insert into ".TB_PREFIX."allimedal(allyid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '1', ".($i).", '".$allyweek."', '".$row['ap']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Verdediger v/d Week
            $result = mysqli_query($database->dblink,"SELECT id, dp FROM ".TB_PREFIX."alidata ORDER BY dp DESC Limit 10");
            $i=0;     while($row = mysqli_fetch_array($result)){
                $i++;    $img="a3_".($i)."";
                $quer="insert into ".TB_PREFIX."allimedal(allyid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '2', ".($i).", '".$allyweek."', '".$row['dp']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Overvallers v/d Week
            $result = mysqli_query($database->dblink,"SELECT id, RR FROM ".TB_PREFIX."alidata ORDER BY RR DESC, id DESC Limit 10");
            $i=0;     while($row = mysqli_fetch_array($result)){
                $i++;    $img="a4_".($i)."";
                $quer="insert into ".TB_PREFIX."allimedal(allyid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '4', ".($i).", '".$allyweek."', '".$row['RR']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            //Rank climbers of the week
            $result = mysqli_query($database->dblink,"SELECT id, clp FROM ".TB_PREFIX."alidata ORDER BY clp DESC Limit 10");
            $i=0;     while($row = mysqli_fetch_array($result)){
                $i++;    $img="a1_".($i)."";
                $quer="insert into ".TB_PREFIX."allimedal(allyid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '3', ".($i).", '".$allyweek."', '".$row['clp']."', '".$img."')";
                $resul=mysqli_query($database->dblink,$quer);
            }

            $result = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."alidata ORDER BY ap DESC, id DESC Limit 10");
            while($row = mysqli_fetch_array($result)){

                //Pak de top10 verdedigers
                $result2 = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."alidata ORDER BY dp DESC, id DESC Limit 10");
                while($row2 = mysqli_fetch_array($result2)){
                    if($row['id']==$row2['id']){

                        $query3="SELECT Count(*) FROM ".TB_PREFIX."allimedal WHERE allyid=".(int) $row['id']." AND categorie = 5";
                        $result3=mysqli_query($database->dblink,$query3);
                        $row3=mysqli_fetch_row($result3);

                        //Look what color the ribbon must have
                        if($row3[0]<='2'){
                            $img="t22".$row3[0]."_1";
                            switch ($row3[0]) {
                                case "0":
                                    $tekst="";
                                    break;
                                case "1":
                                    $tekst="twice ";
                                    break;
                                case "2":
                                    $tekst="three times ";
                                    break;
                            }
                            $quer="insert into ".TB_PREFIX."allimedal(allyid, categorie, plaats, week, points, img) values(".(int) $row['id'].", '5', '0', '".$allyweek."', '".$tekst."', '".$img."')";
                            $resul=mysqli_query($database->dblink,$quer);
                        }
                    }
                }
            }

            $query="SELECT id FROM ".TB_PREFIX."alidata ORDER BY id+0 DESC";
            $result=mysqli_query($database->dblink,$query);

            $aliIDs = [];
            for ($i=0; $row=mysqli_fetch_row($result); $i++){
                $aliIDs[] = (int) $row[0];
            }

            if (count($aliIDs)) {
                mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."alidata SET ap=0, dp=0,RR=0,clp=0 WHERE id IN(".implode(', ', $aliIDs).")");
            }

            $q = "UPDATE ".TB_PREFIX."config SET lastgavemedal=".$time;
            $database->query($q);
        }
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
$automation = new Automation;

// remove automation lock file
@unlink( AUTOMATION_LOCK_FILE_NAME );
?>
