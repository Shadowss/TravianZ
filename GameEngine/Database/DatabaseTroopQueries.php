<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseTroopQueries.php                                    ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Units, training, research, hospital, reinforcements         ##
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

trait DatabaseTroopQueries {

	function deleteReinf($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE from " . TB_PREFIX . "enforcement where id = '$id'";
		mysqli_query($this->dblink,$q);
		self::clearReinforcementsCache();
	}

	public function countOasisTroops($vref, $use_cache = true) {
	    list($vref) = $this->escape_input((int) $vref);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisTroopsCountCache, $vref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		//count oasis troops: $troops_o
        $troops_o = 0;
        $o_unit   = $this->getUnit($vref, $use_cache);

        for ( $i = 1; $i < 51; $i ++ ) {
            $troops_o += $o_unit[ 'u'.$i ];
        }

        $troops_o += $o_unit['hero'];
        $o_unit2 = $this->getEnforceVillage($vref, 0, $use_cache);

        foreach ($o_unit2 as $o_unit) {
            for ( $i = 1; $i < 51; $i ++ ) {
                $troops_o += $o_unit[ 'u'.$i ];
            }

            $troops_o += $o_unit['hero'];
        }

        self::$oasisTroopsCountCache[$vref] = $troops_o;
            return self::$oasisTroopsCountCache[$vref];
	}

	function getResearchLock($wid) {
		$wid = (int) $wid;
		$result = mysqli_query($this->dblink, "SELECT GET_LOCK('research_village_$wid', 10) AS locked");
		$row = mysqli_fetch_assoc($result);
		return $row['locked'] == 1;
	}

	function releaseResearchLock($wid) {
		$wid = (int) $wid;
		mysqli_query($this->dblink, "SELECT RELEASE_LOCK('research_village_$wid')");
	}

	function getTrainingLock($wid) {
		$wid = (int) $wid;
		$result = mysqli_query($this->dblink, "SELECT GET_LOCK('train_village_$wid', 10) AS locked");
		$row = mysqli_fetch_assoc($result);
		return $row['locked'] == 1;
	}

	function releaseTrainingLock($wid) {
		$wid = (int) $wid;
		mysqli_query($this->dblink, "SELECT RELEASE_LOCK('train_village_$wid')");
	}

	function getEnforceLock($id) {
		$id = (int) $id;
		$result = mysqli_query($this->dblink, "SELECT GET_LOCK('enforce_$id', 10) AS locked");
		$row = mysqli_fetch_assoc($result);
		return $row['locked'] == 1;
	}

	function releaseEnforceLock($id) {
		$id = (int) $id;
		mysqli_query($this->dblink, "SELECT RELEASE_LOCK('enforce_$id')");
	}

	/**
	 * Add the unit table(s) and troops if presents
	 * 
	 * @param mixed $vid The villaged ID(s)
	 * @param array $troopsArray divided in two portion, which contains the types (unidimensional array) and the values of the
	 *              troops that need to be added (bidimensional array)
	 * @return bool Returns true if the query was successful, false otherwise
	 */
	
	function addUnits($vid, $troopsArray = null) {
        list($vid) = $this->escape_input($vid);
	    
        if(empty($vid)) return;
	    if (!is_array($vid)) $vid = [$vid];
        $types = "";
        $typeKeys = [];
        $values = [];
	    
	    if($troopsArray != null){
            $typeKeys = $troopsArray[0];
	        $values = $troopsArray[1];
	        
            $types = ",u".implode(",u", $typeKeys);
	    }    
	    
        foreach ($vid as $index => $vidValue) $vid[$index] = (int) $vidValue.($troopsArray != null ? ",".implode(",", $values[$index]) : "");

        $duplicateUpdate = "";
        if(!empty($typeKeys)){
            $duplicateColumns = [];
            foreach($typeKeys as $typeKey){
                $typeKey = (int) $typeKey;
                $duplicateColumns[] = "u".$typeKey."=VALUES(u".$typeKey.")";
            }
            $duplicateUpdate = " ON DUPLICATE KEY UPDATE ".implode(', ', $duplicateColumns);
        }else{
            $duplicateUpdate = " ON DUPLICATE KEY UPDATE vref=vref";
        }

        $q = "INSERT into " . TB_PREFIX . "units (vref$types) values (".implode('),(', $vid).")".$duplicateUpdate;
		return mysqli_query($this->dblink,$q);
	}

	function getUnit($vid, $use_cache = true) {
	    $array_passed = is_array($vid);

        if (!$array_passed) {
            $singleVillage = true;
            $vid = [$vid];
        } else {
            foreach ($vid as $index => $vidValue) {
                $vid[$index] = (int) $vidValue;
            }
        }

        $returnArray = [];

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$unitsCache, (int) $vid[0])) && !is_null($cachedValue)) {
            return $cachedValue;
        } else if ($use_cache && $array_passed) {
            $newIDs = [];
            foreach ($vid as $villageID) {
                // don't cache what we don't need to cache
                if (isset(self::$unitsCache[$villageID])) {
                    $returnArray[$villageID] = self::$unitsCache[$villageID];
                } else {
                    // add the uncached ID, so we can select and cache it
                    $newIDs[] = $villageID;
                }
            }
            $vid = $newIDs;

            // nothing to cache? return what we have
            if (!count($vid)) {
                return $returnArray;
            }
        }

		$q = "SELECT * from " . TB_PREFIX . "units where vref IN(".implode(', ', $vid).")";
		$result = mysqli_query($this->dblink,$q);
		$resCount = 0;
		$vidCount = count($vid);

		if (!empty($result) && ($resCount = mysqli_num_rows($result)) && $resCount) {
		    while ($row = mysqli_fetch_assoc($result)) {
                self::$unitsCache[$row['vref']] = $row;
                $returnArray[$row['vref']] = $row;
            }
		} else {
		    // fill everything with nulls
		    foreach ($vid as $id) {
                self::$unitsCache[$id] = null;
                $returnArray[$id] = null;
            }
		}

		// check if we're not missing any return values
        if ($vidCount != $resCount) {
		    // fill-in the gaps, as it would mean some of the IDs we got were not found
            // (which is super-strange, but it's still a mathematical possibility)
            foreach ($vid as $id) {
                if (!isset($returnArray[$id])) {
                    $returnArray[$id] = null;
                }
            }
        }

		return (!isset($singleVillage) ? $returnArray : reset($returnArray));
	}

    // no need to cache this method
	function getUnitsNumber($vid, $mode = 1, $use_cache = false) {
        list( $vid ) = $this->escape_input( (int) $vid );

        $dbarray     = $this->getUnit( $vid );
        $totalunits  = 0;
        for ( $i = 1; $i <= 90; $i ++ ) {
            $totalunits += $dbarray[ 'u' . $i ];
        }
        
        $totalunits += $dbarray['hero'];
        if(!$mode) return $totalunits;
      
        $movingunits      = $this->getVillageMovement( $vid );
        $reinforcingunits = $this->getEnforceArray( $vid, 1 );
        $owner            = $this->getVillageField( $vid, "owner" );
        $ownertribe       = $this->getUserField( $owner, "tribe", 0 );
        $start            = ( $ownertribe - 1 ) * 10 + 1;
        $end              = ( $ownertribe * 10 );

        for ( $i = $start; $i <= $end; $i ++ ) {
            $totalunits += $movingunits[ 'u' . $i ] ?? 0;
            $totalunits += $reinforcingunits[ 'u' . $i ] ?? 0;
        }

        $totalunits += $movingunits['hero'] ?? 0;
        $totalunits += $reinforcingunits['hero'] ?? 0;

		return $totalunits;
	}

	function addTech($vid) {
        if(empty($vid)) return;
        if (!is_array($vid)) {
            $vid = [$vid];
        }

        foreach ($vid as $index => $vidValue) {
            $vid[$index] = (int) $vidValue;
        }

		$q = "INSERT INTO " . TB_PREFIX . "tdata (vref) VALUES (".implode('),(', $vid).")";
		return mysqli_query($this->dblink,$q);
	}

	function addABTech($vid) {
        if(empty($vid)) return;
        if (!is_array($vid)) {
            $vid = [$vid];
        }

        foreach ($vid as $index => $vidValue) {
            $vid[$index] = (int) $vidValue;
        }

        self::$abTechCache = [];
		$q = "INSERT INTO " . TB_PREFIX . "abdata (vref) VALUES (".implode('),(', $vid).")";
		return mysqli_query($this->dblink,$q);
	}

	function getABTech($vid, $use_cache = true) {
        $array_passed = is_array($vid);

        if (!$array_passed) {
            $vid = [(int) $vid];
        } else {
            foreach ($vid as $index => $ivdValue) {
                $vid[$index] = (int) $ivdValue;
            }
        }

        if (!count($vid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$abTechCache[$vid[0]]) && is_array(self::$abTechCache[$vid[0]]) && !count(self::$abTechCache[$vid[0]])) {
            return self::$abTechCache[$vid[0]];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newVIDs = [];
            foreach ($vid as $key) {
                if (!isset(self::$abTechCache[$key])) {
                    $newVIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newVIDs)) {
                return self::$abTechCache;
            } else {
                // update remaining IDs to select and cache
                $vid = $newVIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$abTechCache, $vid[0])) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "abdata where vref IN(".implode(', ', $vid).")";
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$abTechCache[$vid[0]] = $result[0];
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$abTechCache[ $record['vref']] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($vid as $key) {
                if (!isset(self::$abTechCache[$key])) {
                    self::$abTechCache[$key] = [];
                }
            }
        }

        return ($array_passed ? self::$abTechCache : self::$abTechCache[$vid[0]]);
	}

	function addResearch($vid, $tech, $time) {
	    list($vid, $tech, $time) = $this->escape_input((int) $vid, $tech, (int) $time);

        self::$researchingCache = [];
		$q = "INSERT into " . TB_PREFIX . "research values (0,$vid,'$tech',$time)";
		return mysqli_query($this->dblink,$q);
	}

	function getResearching($vid, $use_cache = true) {
        $vid = (int) $vid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$researchingCache[$vid]) && is_array(self::$researchingCache[$vid]) && !count(self::$researchingCache[$vid])) {
            return self::$researchingCache[$vid];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$researchingCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "research where vref = $vid ORDER BY timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
        $researchingCache[$vid] = $this->mysqli_fetch_all($result);
        return $researchingCache[$vid];
	}

	function checkIfResearched($vref, $unit, $use_cache = true) {
	    list($vref, $unit) = $this->escape_input((int) $vref, $unit);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$isResearchedCache, $vref)) && !is_null($cachedValue)) {
            return $cachedValue[$unit];
        }

		$q = "SELECT * FROM " . TB_PREFIX . "tdata WHERE vref = $vref LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result, MYSQLI_ASSOC);

        self::$isResearchedCache[$vref] = $dbarray;
        return self::$isResearchedCache[$vref][$unit];
	}

	function getTech($vid) {
	    // this is a somewhat non-ideal, externally non-changeable way of caching
        // but since we're only ever going to be calling this from Village constructor
        // for our current village, this will more than suffice
	    static $cachedData = [];
	    $vid = (int) $vid;

	    if (isset($cachedData[$vid])) {
            return $cachedData[$vid];
        }

		$q = "SELECT * from " . TB_PREFIX . "tdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
        $cachedData[$vid] = mysqli_fetch_assoc($result);

        return $cachedData[$vid];
	}

    // no need to cache this method

	// ==================== HOSPITAL (raniti + vindecare) ====================

	function getWounded($vid) {
		list($vid) = $this->escape_input((int)$vid);
		$result = mysqli_query($this->dblink, "SELECT * FROM " . TB_PREFIX . "hospital WHERE vref = $vid");
		return $result ? mysqli_fetch_array($result, MYSQLI_ASSOC) : null;
	}

	function addWounded($vid, array $units, array $amounts) {
		list($vid) = $this->escape_input((int)$vid);
		$cols = []; $vals = []; $upd = [];
		foreach($units as $k => $u) {
			$u = (int)$u; $a = (int)$amounts[$k];
			if($a <= 0 || $u < 1 || $u > 90) continue;
			$cols[] = "u$u"; $vals[] = $a; $upd[] = "u$u = u$u + $a";
		}
		if(empty($cols)) return true;
		$q = "INSERT INTO " . TB_PREFIX . "hospital (vref, " . implode(',', $cols) . ") VALUES ($vid, " . implode(',', $vals) . ") ON DUPLICATE KEY UPDATE " . implode(',', $upd);
		return mysqli_query($this->dblink, $q);
	}

	function deductWounded($vid, $unit, $amt) {
		list($vid, $unit, $amt) = $this->escape_input((int)$vid, (int)$unit, (int)$amt);
		return mysqli_query($this->dblink, "UPDATE " . TB_PREFIX . "hospital SET u$unit = GREATEST(u$unit - $amt, 0) WHERE vref = $vid");
	}

	function clearHospital($vid) {
		list($vid) = $this->escape_input((int)$vid);
		mysqli_query($this->dblink, "DELETE FROM " . TB_PREFIX . "hospital WHERE vref = $vid");
		mysqli_query($this->dblink, "DELETE FROM " . TB_PREFIX . "healing WHERE vref = $vid");
	}

	function getHealing($vid) {
		list($vid) = $this->escape_input((int)$vid);
		$result = mysqli_query($this->dblink, "SELECT * FROM " . TB_PREFIX . "healing WHERE vref = $vid ORDER BY id");
		$rows = [];
		if($result) while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $rows[] = $row;
		return $rows;
	}

	function getHealingDue($time) {
		list($time) = $this->escape_input((int)$time);
		$result = mysqli_query($this->dblink, "SELECT * FROM " . TB_PREFIX . "healing WHERE timestamp2 <= $time AND amt > 0");
		$rows = [];
		if($result) while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $rows[] = $row;
		return $rows;
	}

	function healUnit($vid, $unit, $amt, $each) {
		list($vid, $unit, $amt, $each) = $this->escape_input((int)$vid, (int)$unit, (int)$amt, (int)$each);
		$now = time();
		$q = "INSERT INTO " . TB_PREFIX . "healing (vref, unit, amt, timestamp, eachtime, timestamp2) VALUES ($vid, $unit, $amt, $now, $each, " . ($now + $each) . ")";
		return mysqli_query($this->dblink, $q);
	}

	function updateHealing($id, $amt, $timestamp2) {
		list($id, $amt, $timestamp2) = $this->escape_input((int)$id, (int)$amt, (int)$timestamp2);
		return mysqli_query($this->dblink, "UPDATE " . TB_PREFIX . "healing SET amt = $amt, timestamp2 = $timestamp2 WHERE id = $id");
	}

	function deleteHealing($id) {
		list($id) = $this->escape_input((int)$id);
		return mysqli_query($this->dblink, "DELETE FROM " . TB_PREFIX . "healing WHERE id = $id");
	}

	function getTraining($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "training where vref = $vid ORDER BY id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function trainUnit($vid, $unit, $amt, $pop, $each, $mode) {
	    list($vid, $unit, $amt, $pop, $each, $mode) = $this->escape_input((int) $vid, (int) $unit, (int) $amt, (int) $pop, (int) $each, $mode);

		global $technology;

		if(!$mode) {
			// Rutare generica pe tipul unitatii (u1-u90 + offsetul +1000 pentru cladirile mari)
			global $unitsbytype;
			$isGreat = $unit > 1000;
			$baseUnit = $isGreat ? $unit - 1000 : $unit;

			if($baseUnit == 99) $queued = $technology->getTrainingList(8);
			elseif(in_array($baseUnit, $unitsbytype['expansion'])) $queued = $technology->getTrainingList(4);
			elseif(in_array($baseUnit, $unitsbytype['siege'])) $queued = $technology->getTrainingList($isGreat ? 7 : 3);
			elseif(in_array($baseUnit, $unitsbytype['cavalry'])) $queued = $technology->getTrainingList($isGreat ? 6 : 2);
			else $queued = $technology->getTrainingList($isGreat ? 5 : 1);
		
			$now = time();
            $uid = $this->getVillageField($vid, "owner");
            $each = $this->getArtifactsValueInfluence($uid, $vid, 5, $each);
            
            $time2 = $now + $each;
            $time = $now + ($each * $amt);
            if(count($queued) > 0){
                $time  += $queued[count($queued) - 1]['timestamp'] - $now;
                $time2 += $queued[count($queued) - 1]['timestamp'] - $now;
            }            
            
			$q = "INSERT INTO " . TB_PREFIX . "training values (0, $vid, $unit, $amt, $pop, $time, $each, $time2)";
		} 
		else $q = "DELETE FROM " . TB_PREFIX . "training where id = $vid";
		
		return mysqli_query($this->dblink,$q);
	}

	function updateTraining($id, $trained, $each) {
	    list($id, $trained, $each) = $this->escape_input((int) $id, (int) $trained, (int) $each);

		$q = "UPDATE " . TB_PREFIX . "training set amt = amt - $trained, timestamp2 = timestamp2 + $each where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function modifyUnit($vref, $array_unit, $array_amt, $array_mode) {
	    list($vref, $array_unit, $array_amt, $array_mode) = $this->escape_input((int) $vref, $array_unit, $array_amt, $array_mode);
		$i = -1;
		$units='';
		$number = count($array_unit);
		foreach($array_unit as $unit){
			if($unit == 230) $unit = 30;
			if($unit == 231) $unit = 31;
			if($unit == 120) $unit = 20;
			if($unit == 121) $unit = 21;
			if($unit =="hero") $unit = 'hero';
			else $unit = 'u' . $unit;

            ++$i;
            //Fixed part of negative troops (double troops) - by InCube
            $array_amt[$i] = (int) $array_amt[$i] < 0 ? 0 : $array_amt[$i];
            //Fixed part of negative troops (double troops) - by InCube
            $units .= $unit.' = '.$unit.' '.(($array_mode[$i] == 1)? '+':'-').'  '.($array_amt[$i] ? $array_amt[$i] : 0).(($number > $i+1) ? ', ' : '');
		}
		$q = "UPDATE ".TB_PREFIX."units set $units WHERE vref = $vref";
		return mysqli_query($this->dblink, $q);
	}

	function getEnforce($vid, $from, $use_cache = true) {
	    $array_passed = is_array($vid);
	    if (!$array_passed) {
	        $vid = [$vid];
	        $from = [$from];
        } else {
            foreach ($vid as $index => $vidValue) {
                $vid[$index] = (int) $vidValue;
                $from[$index] = (int) $from[$index];
            }
        }

        if (!count($vid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$villageFromReinforcementsCache[$vid[0].$from[0]]) && is_array(self::$villageFromReinforcementsCache[$vid[0].$from[0]]) && !count(self::$villageFromReinforcementsCache[$vid[0].$from[0]])) {
            return self::$villageFromReinforcementsCache[$vid[0].$from[0]];
        }  else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newVIDs = [];
            $newFROMs = [];
            foreach ($vid as $index => $vidValue) {
                if (!isset(self::$villageFromReinforcementsCache[$vidValue.$from[$index]])) {
                    $newVIDs[] = $vidValue;
                    $newFROMs[] = $from[$index];
                }
            }

            // everything's cached, just return the cache
            if (!count($newVIDs)) {
                return self::$villageFromReinforcementsCache;
            } else {
                // update remaining IDs to select and cache
                $vid = $newVIDs;
                $from = $newFROMs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$villageFromReinforcementsCache, $vid[0].$from[0])) && !is_null($cachedValue)) {
            return $cachedValue;
        }
        
        // build SELECT pairs
        $pairs = [];
        foreach ($vid as $index => $vidValue) {
            $pairs[] = '(`from` = '.(int) $from[$index].' AND vref = '.(int) $vidValue.')';
        }

		$q = "SELECT * FROM " . TB_PREFIX . "enforcement WHERE ".implode(' OR ', $pairs);
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$villageFromReinforcementsCache[$vid[0].$from[0]] = $result[0];
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$villageFromReinforcementsCache[$record['vref'].$record['from']] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($vid as $index => $vidValue) {
                if (!isset(self::$villageFromReinforcementsCache[$vidValue.$from[$index]])) {
                    self::$villageFromReinforcementsCache[$vidValue.$from[$index]] = [];
                }
            }
        }

        return ($array_passed ? self::$villageFromReinforcementsCache : self::$villageFromReinforcementsCache[$vid[0].$from[0]]);
	}

    function getOasisEnforce($ref, $mode=0, $use_cache = true) {
        $array_passed = is_array($ref);
        $mode = (int) $mode;

        if (!$array_passed) {
            $ref = [(int) $ref];
        } else {
            foreach ($ref as $index => $refValue) {
                $ref[$index] = (int) $refValue;
            }
        }

        if (!count($ref)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$oasisReinforcementsCache[$ref[0].$mode]) && is_array(self::$oasisReinforcementsCache[$ref[0].$mode]) && !count(self::$oasisReinforcementsCache[$ref[0].$mode])) {
            return self::$oasisReinforcementsCache[$ref[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newREFs = [];
            foreach ($ref as $key) {
                if (!isset(self::$oasisReinforcementsCache[$key.$mode])) {
                    $newREFs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newREFs)) {
                return self::$oasisReinforcementsCache;
            } else {
                // update remaining IDs to select and cache
                $ref = $newREFs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$oasisReinforcementsCache, $ref[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.conqured IN(".implode(', ', $ref).") AND e.from NOT IN(".implode(', ', $ref).")";
        }else if ($mode == 1) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.conqured IN(".implode(', ', $ref).")";
        } else if ($mode == 2) {
            $q = "SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref where o.conqured IN(".implode(', ', $ref).") AND o.owner<>v.owner";
        } else if ($mode == 3) {
            $q = "SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref where o.conqured IN(".implode(', ', $ref).") AND o.owner=v.owner";
        }
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$oasisReinforcementsCache[$ref[0].$mode] = $result;
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    if ( ! isset( self::$oasisReinforcementsCache[ $record['conqured'] . $mode ] ) ) {
                        self::$oasisReinforcementsCache[ $record['conqured'] . $mode ] = [];
                    }

                    self::$oasisReinforcementsCache[ $record['conqured'] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($ref as $key) {
                if (!isset(self::$oasisReinforcementsCache[$key.$mode])) {
                    self::$oasisReinforcementsCache[$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$oasisReinforcementsCache : self::$oasisReinforcementsCache[$ref[0].$mode]);
    }

    function getOasisEnforceArray($id, $mode=0, $use_cache = true) {
        list($id, $mode) = $this->escape_input((int) $id, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisArrayReinforcementsCache, $id.$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where e.id = $id";
        }else{
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.from=o.wref where e.id =$id";
        }
        $result = mysqli_query($this->dblink,$q);

        self::$oasisArrayReinforcementsCache[$id.$mode] = mysqli_fetch_assoc($result);
        return self::$oasisArrayReinforcementsCache[$id.$mode];
    }

	function addEnforce($data) {
        list($data) = $this->escape_input($data);

        $q = "INSERT into " . TB_PREFIX . "enforcement (vref,`from`) values (" . (int) $data['to'] . "," . (int) $data['from'] . ")";
		mysqli_query($this->dblink,$q);
		$id = mysqli_insert_id($this->dblink);
		$owntribe = $this->getUserField($this->getVillageField($data['from'], "owner"), "tribe", 0);
		$start = ($owntribe - 1) * 10 + 1;
		$end = ($owntribe * 10);
		//add unit
		$j = 1;
		$units = [];
		$amounts = [];
		$modes = [];

		for($i = $start; $i <= $end; $i++) {
		    $units[] = ($i < 0 ? 0 : $i);
		    $amounts[] = $data['t' . $j . ''];
		    $modes[] = 1;
			$j++;
		}

		// add hero
        $units[] = 'hero';
        $amounts[] = $data['t11'];
        $modes[] = 1;

		$this->modifyEnforce($id,$units, $amounts, $modes);
	}

	function addEnforce2($data,$tribe,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11) {
        list($data,$tribe,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11) = $this->escape_input($data,$tribe,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11);

        $q = "INSERT into " . TB_PREFIX . "enforcement (vref,`from`) values (" . (int) $data['to'] . "," . (int) $data['from'] . ")";
		mysqli_query($this->dblink,$q);
		$id = mysqli_insert_id($this->dblink);
		$owntribe = $this->getUserField($this->getVillageField($data['from'], "owner"), "tribe", 0);
		$start = ($owntribe - 1) * 10 + 1;
		$end = ($owntribe * 10);
		$start2 = ($tribe - 1) * 10 + 1;
		$start3 = ($tribe - 1) * 10;
		if($start3 == 0){
		    $start3 = "";
		}
		$end2 = ($tribe * 10);
		//add unit
		$j = 1;

        $units = [];
        $amounts = [];
        $modes = [];

		for($i = $start; $i <= $end; $i++) {
            $units[] = ($i < 0 ? 0 : $i);
            $amounts[] = $data['t' . $j . ''];
            $modes[] = 1;

            $units[] = ($i < 0 ? 0 : $i);
            $amounts[] = ${'dead'.$j};
            $modes[] = 0;

			$j++;
		}

        // process heroes
        $units[] = 'hero';
        $amounts[] = $data['t11'];
        $modes[] = 1;

        $units[] = 'hero';
        $amounts[] = $dead11;
        $modes[] = 0;

        $this->modifyEnforce($id,$units, $amounts, $modes);
	}

	function modifyEnforce($id, $unit, $amt, $mode) {
	    $id = (int) $id;

		// prepare pairing array, even if we're not passing arrays, so we can use the same logic
        $pairs = [];
		if (!is_array($unit)) {
		    $unit = [$unit];
		    $amt = [(int) $amt];
		    $mode = [(int) $mode];
        }

        foreach ($unit as $index => $unitType) {
            $unitType = ($unitType != 'hero' ? 'u' . $this->escape($unitType) : $unitType);
		    $pairs[] = $unitType . ' = ' . $unitType . (!(int) $mode[$index] ? ' - ' : ' + ') . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "enforcement SET ".implode(', ', $pairs)." WHERE id = $id";
		mysqli_query($this->dblink,$q);

		// clear enforce cache
        self::$villageReinforcementsCache = [];
        self::$villageFromReinforcementsCache = [];
        self::$reinforcementsCache = [];
	}

	function getEnforceArray($id, $mode, $use_cache = true) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$reinforcementsCache, $id.$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		if(!$mode) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where id = $id";
		} else {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` = $id";
		}
		$result = mysqli_query($this->dblink,$q);

        self::$reinforcementsCache[$id.$mode] = mysqli_fetch_assoc($result);
        return self::$reinforcementsCache[$id.$mode];
	}

	function getEnforceVillage($id, $mode, $use_cache = true) {
        $array_passed = is_array($id);
        $mode = (int) $mode;

        if (!$array_passed) {
            $id = [(int) $id];
        } else {
            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

        if (!count($id)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$villageReinforcementsCache[$id[0].$mode]) && is_array(self::$villageReinforcementsCache[$id[0].$mode]) && !count(self::$villageReinforcementsCache[$id[0].$mode])) {
            return self::$villageReinforcementsCache[$id[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newIDs = [];
            foreach ($id as $key) {
                if (!isset(self::$villageReinforcementsCache[$key.$mode])) {
                    $newIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newIDs)) {
                return self::$villageReinforcementsCache;
            } else {
                // update remaining IDs to select and cache
                $id = $newIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$villageReinforcementsCache, $id[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

		if(!$mode) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where vref IN(".implode(', ', $id).")";
		} else if ($mode == 1) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` IN(".implode(', ', $id).")";
		} else if ($mode == 2) {
            $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref LEFT JOIN ".TB_PREFIX."vdata as v1 ON e.vref=v1.wref where e.vref IN(".implode(', ', $id).") AND v.owner<>v1.owner";
        } else if ($mode == 3) {
            $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref LEFT JOIN ".TB_PREFIX."vdata as v1 ON e.vref=v1.wref where e.vref IN(".implode(', ', $id).") AND v.owner=v1.owner";
        } else if ($mode == 4) {
            $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref LEFT JOIN ".TB_PREFIX."vdata as v1 ON e.vref=v1.wref where e.vref IN(".implode(', ', $id).") AND v.owner=v1.owner";
        }
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$villageReinforcementsCache[$id[0].$mode] = $result;
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    if ( ! isset( self::$villageReinforcementsCache[ $record['vref'] . $mode ] ) ) {
                        self::$villageReinforcementsCache[ $record['vref'] . $mode ] = [];
                    }

                    self::$villageReinforcementsCache[ $record['vref'] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($id as $key) {
                if (!isset(self::$villageReinforcementsCache[$key.$mode])) {
                    self::$villageReinforcementsCache[$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$villageReinforcementsCache : self::$villageReinforcementsCache[$id[0].$mode]);
	}

	public static function clearReinforcementsCache() {
	    self::$reinforcementsCache = [];
	    self::$villageReinforcementsCache = [];
	    self::$villageFromReinforcementsCache = [];
	    self::$oasisArrayReinforcementsCache = [];
	    self::$oasisReinforcementsCache = [];
	    self::clearUnitsCache();
    }

    public static function clearUnitsCache() {
        self::$unitsCache = [];
    }

    // no need to cache this method
	function getTrainingList() {
		$q = "SELECT * FROM " . TB_PREFIX . "training where vref IS NOT NULL";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
}
