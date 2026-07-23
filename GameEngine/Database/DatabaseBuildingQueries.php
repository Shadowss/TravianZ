<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseBuildingQueries.php                                 ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Buildings (bdata), building queues, demolitions             ##
##                                                                             ##
##  Phase S1: Trait extracted from GameEngine/Database.php                     ##
##            (MYSQLi_DB class).                                               ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

trait DatabaseBuildingQueries {

	
	function addBuilding($wid, $field, $type, $loop, $time, $master, $level) {
	    list($wid, $field, $type, $loop, $time, $master, $level) = $this->escape_input((int) $wid, $field, (int) $type, (int) $loop, (int) $time, (int) $master, (int) $level);

		$x = "UPDATE " . TB_PREFIX . "fdata SET f" . $field . "t=" . $type . " WHERE vref=" . $wid;
		mysqli_query($this->dblink,$x);
		$q = "INSERT into " . TB_PREFIX . "bdata values (0, $wid, $field, $type, $loop, $time, $master, $level)";
		return mysqli_query($this->dblink,$q);
	}

	/**
	 * B-W2: finalizeaza o cladire (nivel + tip) in fdata SI invalideaza cache-ul
	 * de resource levels. Inlocuieste UPDATE-ul raw din Building::finishAll()
	 * care ocolea invalidarea din Faza B - recountCP() citea nivelele vechi din
	 * cache si persista un CP gresit in vdata.
	 */
	function finishBuildingLevel($wid, $field, $level, $type) {
	    list($wid, $field, $level, $type) = $this->escape_input((int) $wid, (int) $field, (int) $level, (int) $type);

		$q = "UPDATE " . TB_PREFIX . "fdata SET f" . $field . " = " . $level . ", f" . $field . "t = " . $type . " WHERE vref = " . $wid;
		$result = mysqli_query($this->dblink, $q);

		// invalidare: urmatorul getResourceLevel()/getFieldLevel() reciteste din DB
		self::clearResourseLevelsCache();

		return $result;
	}

	/**
	 * B-W2: sterge joburi din bdata dupa id-uri SI invalideaza cache-ul de
	 * joburi al satului. Inlocuieste DELETE-ul raw din Building::finishAll().
	 */
	function deleteBuildings($wid, array $ids) {
	    $wid = (int) $wid;
	    $ids = array_map('intval', $ids);

	    if (empty($ids)) {
	        return true;
	    }

		$result = mysqli_query($this->dblink, "DELETE FROM " . TB_PREFIX . "bdata WHERE id IN(" . implode(',', $ids) . ")");
		unset(self::$buildingsUnderConstructionCache[$wid]);

		return $result;
	}

	/**
	 * B-W2: promoveaza un job din coada de asteptare (loopcon = 1) in coada
	 * activa SI invalideaza cache-ul de joburi al satului.
	 */
	function promoteLoopJob($wid, $id) {
	    list($wid, $id) = $this->escape_input((int) $wid, (int) $id);

		$result = mysqli_query($this->dblink, "UPDATE " . TB_PREFIX . "bdata SET loopcon = 0 WHERE id = " . $id);
		unset(self::$buildingsUnderConstructionCache[$wid]);

		return $result;
	}

	/**
	 * B-W2: actualizeaza numarul maxim de membri ai aliantei conduse de $leader
	 * (efectul Embassy-ului). Inlocuieste UPDATE-ul raw din Building::finishAll().
	 */
	function updateAllianceMax($leader, $max) {
	    list($leader, $max) = $this->escape_input((int) $leader, (int) $max);

		return mysqli_query($this->dblink, "UPDATE " . TB_PREFIX . "alidata SET max = " . $max . " WHERE leader = " . $leader);
	}

	/**
	 * B-W2: log de gold (prepared statement). Inlocuieste INSERT-ul raw din
	 * Building::finishAll(); acelasi format ca logger-ul din UserQueries.
	 */
	function addGoldFinLog($wid, $uid, $action, $gold, $details) {
		$stmt = $this->dblink->prepare(
			"INSERT INTO `" . TB_PREFIX . "gold_fin_log` (wid, uid, action, gold, time, details) VALUES (?, ?, ?, ?, ?, ?)"
		);

		if (!$stmt) {
			return false;
		}

		$wid  = (int) $wid;
		$uid  = (int) $uid;
		$gold = (int) $gold;
		$now  = time();

		$stmt->bind_param("iisiis", $wid, $uid, $action, $gold, $now, $details);
		$ok = $stmt->execute();
		$stmt->close();

		return $ok;
	}


	function getBuildLock($wid) {
		$wid = (int) $wid;
		$result = mysqli_query($this->dblink, "SELECT GET_LOCK('build_village_$wid', 10) AS locked");
		$row = mysqli_fetch_assoc($result);
		return $row['locked'] == 1;
	}

	function releaseBuildLock($wid) {
		$wid = (int) $wid;
		mysqli_query($this->dblink, "SELECT RELEASE_LOCK('build_village_$wid')");
	}

	/**
	 * Get the time required to build a specified building
	 * 
	 * @param int $id The ID where the building is located
	 * @param int $tid The type of the building
	 * @param int $plus The construction queue count
	 * @param int $wref The village ID
	 * @param array $buildingArray The array containing the buildings in the village
	 * @return int Returns the building time
	 */
	
	function getBuildingTime($id, $tid, $plus, $wref, $buildingArray) {
		list($id, $tid, $plus, $wref, $buildingArray) = $this->escape_input((int) $id, (int) $tid, (int) $plus, (int) $wref, $buildingArray);
		global ${'bid'.$tid}, $bid15;
		
		$dataArray = ${'bid'.$tid};
		
		//Check if we've the main building or not
		$mainBuilding = $this->getFieldLevelInVillage($wref, 15);
		if($tid == 15){
			if($mainBuilding == 0) return round($dataArray[$buildingArray['f'.$id] + $plus]['time'] / SPEED * 5);
			else return round($dataArray[$buildingArray['f'.$id] + $plus]['time'] / SPEED);
		}else{
			if($mainBuilding > 0) {
				return round($dataArray[$buildingArray['f'.$id] + $plus]['time'] * ($bid15[$mainBuilding]['attri'] / 100)  / SPEED);
			}
			else return round($dataArray[$buildingArray['f'.$id] + $plus]['time'] * 5 / SPEED);
		}
	}
	
	/**
	 * Called when removing a queued building by a player or because destroyed by catapults
	 * 
	 * @param int $d The ID of the building which needs to be deleted
	 * @param int $tribe The tribe of the player
	 * @param int $wid The village ID of the player
	 * @param array $fieldsArray Optional, the array containing the village building/resource fields
	 * @return bool Returns true if the building was delete successfully, false otherwise
	 */
	
	function removeBuilding($d, $tribe, $wid, $fieldsArray = []) {
		list($d, $tribe, $wid, $fieldsArray) = $this->escape_input((int) $d, (int) $tribe, (int) $wid, $fieldsArray);

		//Variables initialization
		$jobToDelete = [];
		$canBeRemoved = true;
		$time = time();
		$newTime = $loopTime = 0;
		if(empty($fieldsArray)) $fieldsArray = $this->getResourceLevel($wid);
		$jobs = $this->getJobsOrderByID($wid);
		
		//Search the job which needs to be deleted	
		foreach($jobs as $job){	
			//We need to modify waiting loop orders
			if(!empty($jobToDelete) && $job['loopcon'] == 1 && ($tribe != 1 || ($tribe == 1 && (($jobToDelete['field'] <= 18 && $job['field'] <= 18) || ($jobToDelete['field'] >= 19 && $job['field'] >= 19))))){
				
				//Does this job have the same field of the deleted one?
				$sameBuilding = $jobToDelete['field'] == $job['field'] ? 1 : 0;
				
				//Can the building be completely removed from the village?
				if($sameBuilding && $canBeRemoved) $canBeRemoved = !$sameBuilding;		
				
				//Get the time required to upgrade the building at the given level	
				$newTime = $this->getBuildingTime(
						$job['field'],
						$job['type'], 
						$job['level'] - $fieldsArray['f'.$job['field']] - $sameBuilding, 
						$wid, 
						$fieldsArray);
				
				//Increase the looptime
				$loopTime += $newTime;
				
				//Update the values
				$q = "UPDATE
							" .TB_PREFIX. "bdata
 					  SET
							".($job['master'] ? "" : "loopcon = 0,")."
							timestamp = ".($job['master'] ? $newTime : $loopTime + $time)."
							".($sameBuilding ? ", level = level - 1" : "")."
					  WHERE
							id = ".$job['id'];
				mysqli_query($this->dblink, $q);
						
			}
			
			//We found the job that needs to be deleted
			if($job['id'] == $d) $jobToDelete = $job;
		}	

		if($canBeRemoved && $jobToDelete['field'] > 18 && $jobToDelete['field'] != 99 && $jobToDelete['level'] - 1 == 0){
			$this->setVillageLevel($wid, ["f".$jobToDelete['field']."t"], [0]);
		}
		
        $q = "DELETE FROM " . TB_PREFIX . "bdata where id = $d";
        return mysqli_query($this->dblink, $q);
	}

	function addDemolition($wid, $field) {
	    list($wid, $field) = $this->escape_input((int) $wid, (int) $field);

		global $building, $village, $session;
		
		$fLevel = $this->getFieldLevel($wid, $field);

		// check if we're not demolishing an Embassy if the player is in an alliance
		if ($this->getFieldType($wid,$field) == 18 && $session->alliance) {

		    // get field level, alliance members count and the minimum
		    // level of Embassy to be able to hold this number of people
		    $membersCount    = $this->countAllianceMembers($session->alliance);
		    $minEmbassyLevel = $this->getMinEmbassyLevel($membersCount);
		    $isOwner         = $this->isAllianceOwner($session->uid) == $session->alliance;

		    // make sure minimum Embassy level is 3 of the player is alliance owner
            if ($isOwner && $minEmbassyLevel < 3) {
                $minEmbassyLevel = 3;
            }

		    // check if this user is the founder of the alliance
		    // and whether we're not trying to demolish under the lowest level
		    // which can hold current number of members
		    if ($fLevel == $minEmbassyLevel && $session->alliance && $isOwner) {
		        // check if we have any other players in this alliance left
		        if ($membersCount > 1) {
		            // check if this player has only 1 last Embassy on a sufficient level
		            if ($this->getSingleFieldTypeCount($session->uid, 18, '>=', $minEmbassyLevel) == 1) {
    		            // cannot demolish Embassy further until the player quits the alliance,
    		            // as they are founder and there are still other players in the alliance,
    		            // thus destroying Embassy would evict this player from the alliance
    		            // and leave a new random leader
    		            return 18;
		            }
		        }
		    }
		}

		$q = "DELETE FROM ".TB_PREFIX."bdata WHERE field=$field AND wid=$wid";
		mysqli_query($this->dblink,$q);
		$uprequire = $building->resourceRequired($field,$village->resarray['f'.$field.'t'],0);
		$newLevel = max(0, $fLevel - 1);
		$q = "INSERT INTO ".TB_PREFIX."demolition VALUES (".$wid.",".$field.",".$newLevel.",".(time() + floor($uprequire['time'] / 2)).")";
		mysqli_query($this->dblink,$q);

		return true;
	}

    // no need to cache this method
	function getDemolition($wid = 0) {
	    list($wid) = $this->escape_input((int) $wid);

		if($wid) {
			$q = "SELECT * FROM " . TB_PREFIX . "demolition WHERE vref=" . $wid;
		} else {
			$q = "SELECT * FROM " . TB_PREFIX . "demolition WHERE timetofinish<=" . time();
		}
		$result = mysqli_query($this->dblink,$q);
		if(!empty($result)) {
			return $this->mysqli_fetch_all($result);
		} else {
			return NULL;
		}
	}

	function finishDemolition($wid) {
	    list($wid) = $this->escape_input((int) $wid);

    	$q = "UPDATE " . TB_PREFIX . "demolition SET timetofinish=" . time() . " WHERE vref=" . $wid;
    	$result= mysqli_query($this->dblink,$q);
    	return mysqli_affected_rows($this->dblink);
	}

	function delDemolition($wid, $checkEmbassy = false) {
	    $wid = (int) $wid;

	    if ($checkEmbassy) {
	        // check if we've demolished an Embassy
	        // and select the user it belonged to as well,
	        // so we can potentially evict them from the alliance
	        // and remove it - if they don't have any more Embassies
	        //                 or if the they are founder and they have no more lvl 3+ Embassies
	        $q = '
            SELECT
                u.id, u.username, u.alliance, d.buildnumber, d.lvl
            FROM
                '.TB_PREFIX.'demolition d
                LEFT JOIN '.TB_PREFIX.'vdata v ON d.vref = v.wref
                LEFT JOIN '.TB_PREFIX.'users u ON u.id = v.owner
            WHERE d.vref = '.$wid;

	        $res = $this->mysqli_fetch_all(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
	        foreach ($res as $key) {
	            // if this building being demolished is an Embassy or was demolished completely
	            // and the player is in an alliance, check and update their alliance status
	            if (($key['alliance'] > 0) && ($key['lvl'] == 0 || $this->getFieldType($wid, $key['buildnumber']) == 18)) {
                    $this->checkAllianceEmbassiesStatus($key, true);
                }
	        }
	    }

		$q = "DELETE FROM " . TB_PREFIX . "demolition WHERE vref=" . $wid;
		return mysqli_query($this->dblink,$q);
	}
    
    /**
     * Modify or delete a building being constructed/in queue
     * 
     * @param int The village ID
     * @param int $field The field where the building is located
     * @param array $levels The new level of the building and the old one
     * @param int $tribe The player's tribe
     */
    
    function modifyBData($wid, $field, $levels, $tribe){
    	// HOTFIX "array offset on int": $levels e un ARRAY [nivelNou, nivelVechi] (singurul
    	// apel: AutomationBattleResolution, dupa lovitura de catapulte). Cast-ul (int) de aici
    	// il transforma in 1, deci $levels[0] era null, "null == 0" era mereu TRUE si ramura
    	// else (ajustarea nivelului comenzilor din coada) era COD MORT - comenzile de
    	// constructie erau sterse mereu, chiar daca cladirea nu ajungea la nivelul 0.
    	// Pastram cast-ul pe celelalte argumente; elementele lui $levels devin int (SQL-safe).
    	list($wid, $field, $tribe) = $this->escape_input((int) $wid, (int) $field, (int) $tribe);
    	$levels = array_map('intval', is_array($levels) ? $levels : [$levels, 0]);
        
        if($levels[0] == 0){ 
        	$q = "SELECT id FROM " .TB_PREFIX. "bdata WHERE wid = $wid AND field = $field";
        	$orders = $this->mysqli_fetch_all(mysqli_query($this->dblink, $q));
        	foreach($orders as $order) $this->removeBuilding($order['id'], $tribe, $wid);
        }
        else mysqli_query($this->dblink, $q = "UPDATE " .TB_PREFIX. "bdata SET level = level - $levels[1] + $levels[0] WHERE wid = $wid AND field = $field");
    }
    
    private function getBData($wid, $use_cache = true, $orderByID = false) {
	    $wid = (int) $wid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$buildingsUnderConstructionCache[$wid]) && is_array(self::$buildingsUnderConstructionCache[$wid]) && !count(self::$buildingsUnderConstructionCache[$wid])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$buildingsUnderConstructionCache, $wid)) && !is_null($cachedValue)) {
            return self::$buildingsUnderConstructionCache[$wid];
        }

        $q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid order by ".(!$orderByID ? "master,timestamp" : "id")." ASC";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        self::$buildingsUnderConstructionCache[$wid] = $result;
        return $result;
    }

    // do not cache output, as building jobs can change when using instant build (PLUS) etc.
	function getJobs($wid) {
	    return $this->getBData($wid, false);
	}
	
	function getJobsOrderByID($wid) {
	    return $this->getBData($wid, false, true);
	}

	function FinishWoodcutter($wid) {
	    $bdata = $this->getBData($wid);
		$time = time()-1;

		// find our woodcutter
        $dbarray = [];
        foreach ($bdata as $row) {
            if ($row['type'] == 1) {
                $dbarray = $row;
                break;
            }
        }

        // no woodcutters? just return
        if (!count($dbarray)) {
            return;
        }

        // make it complete
		$q = "UPDATE ".TB_PREFIX."bdata SET timestamp = $time WHERE id = ".$dbarray['id'];
		$this->query($q);

		$tribe = $this->getUserField($this->getVillageField($wid, "owner"), "tribe", 0);

		// find first field that's the next one in the loop after our finished woodcutter
		$dbarray2 = [];
        foreach ($bdata as $row) {
            if ($row['loopcon'] == 1 && ($tribe == 1 ? $row['field'] >= 19 : true)) {
                $dbarray2 = $row;
                break;
            }
        }

        // if found, update it's finish time by subtracting the resulting time for our woodcutter,
        // which is now finished
		if (count($dbarray2)){
            $wc_time = $dbarray['timestamp'];
            $q2 = "UPDATE ".TB_PREFIX."bdata SET timestamp = timestamp - $wc_time WHERE id = ".$dbarray2['id'];
            $this->query($q2);
		}
	}

	function getMasterJobs($wid) {
	    // cache data
        $bdata = $this->getBData($wid);

        // return all master jobs
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 1) $data[] = $row;
        }

		return $data;
	}

	function getMasterJobsByField($wid,$field) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all master jobs for the requested field
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 1 && $row['field'] == $field) {
                $data[] = $row;
            }
        }

        return $data;
	}

	function getBuildingByField($wid,$field) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all non-master jobs for the requested field
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 0 && $row['field'] == $field) {
                $data[] = $row;
            }
        }

        return $data;
	}

    // no need to cache this method
	function getBuildingByField2($wid,$field) {
	    list($wid,$field) = $this->escape_input((int) $wid,(int) $field);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "bdata where wid = $wid and field = $field and master = 0";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		return $result['Total'];
	}

	function getBuildingByType($wid,$type) {
        // cache data
        $bdata = $this->getBData($wid);
        $type = (strpos($type, ',') === false ? [(int) $type] : explode(',', str_replace(' ', '', $this->escape($type))));

        // return all jobs which are of the requested type
        $data = [];
        foreach ($bdata as $row) {
            if (in_array($row['field'], $type)) {
                $data[] = $row;
            }
        }

        return $data;
	}

	function getBuildingByType2($wid,$type) {
	    $wid = (int) $wid;

	    if (!is_array($type)) {
	        $type = [$type];
        } else {
	        foreach ($type as $index => $typeValue) {
	            $type[$index] = (int) $typeValue;
            }
        }

		$q = "SELECT CONCAT(type, \"=\", Count(type)) FROM " . TB_PREFIX . "bdata where wid = $wid and type IN(".implode(', ', $type).") and master = 0 GROUP BY type";
		$result = mysqli_query($this->dblink, $q);
		$newresult = [];

		if (mysqli_num_rows($result)) {
		    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		        if ($row[0]) {
                    $val                  = explode( '=', $row[0] );
                    $newresult[ $val[0] ] = $val[1];
                }
            }

            $result = $newresult;

        } else {
		    $result = [];
        }

		return $result;
	}

	function getDorf1Building($wid) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all non-master jobs for field type under 19
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 0 && $row['field'] < 19) $data[] = $row;
        }

        return $data;
	}

	function getDorf2Building($wid) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all non-master jobs for field type above 18
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 0 && $row['field'] > 18) $data[] = $row;
        }

        return $data;
	}

	function updateBuildingWithMaster($id, $time, $loop) {
	    list($id, $time, $loop) = $this->escape_input((int) $id, (int) $time, (int) $loop);

		$q = "UPDATE " . TB_PREFIX . "bdata SET master = 0, timestamp = ".$time.", loopcon = ".$loop." WHERE id = ".$id."";
		return mysqli_query($this->dblink,$q);
	}
}
