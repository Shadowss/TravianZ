<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseMovementQueries.php                                 ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Troop movements, attacks, prisoners, farm lists             ##
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

use App\Utils\Math;

trait DatabaseMovementQueries {


	function setMovementProc($moveid) {
        if (!Math::isInt($moveid)) {
            list($moveid) = $this->escape_input($moveid);
        }

        if(empty($moveid)) return;

        // rather than re-selecting data and updating cache here, let's just
        // flush the cache and let it re-cach itself as neccessary
        self::$marketMovementCache = [];

		$q = "UPDATE " . TB_PREFIX . "movement set proc = 1 where moveid IN($moveid)";
		return mysqli_query($this->dblink,$q);
	}

	function getMovement($type, $village, $mode, $use_cache = true) {
        $array_passed = is_array($village);

        if (!$array_passed) {
            $village = [(int) $village];
        } else {
            foreach ($village as $index => $villageValue) {
                $village[$index] = (int) $villageValue;
            }
        }

        if (!count($village)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$marketMovementCache[$type.$village[0].$mode]) && is_array(self::$marketMovementCache[$type.$village[0].$mode]) && !count(self::$marketMovementCache[$type.$village[0].$mode])) {
            return self::$marketMovementCache[$type.$village[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newIDs = [];
            foreach ($village as $key) {
                if (!isset(self::$marketMovementCache[$type.$key.$mode])) {
                    $newIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newIDs)) {
                return self::$marketMovementCache;
            } else {
                // update remaining IDs to select and cache
                $village = $newIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$marketMovementCache, $type.$village[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return ($array_passed ? self::$marketMovementCache: $cachedValue);
        }

		$time = time();
		if(!$mode) {
			$where = "from";
		} else {
			$where = "to";
		}
		switch($type) {
			case 0:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "send where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "send.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 0 ORDER BY endtime ASC";
				break;
			case 1:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "send where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "send.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 6 ORDER BY endtime ASC";
				break;
			case 2:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 2 ORDER BY endtime ASC";
				break;
			case 3:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				break;
			case 4:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 4 ORDER BY endtime ASC";
				break;
			case 5:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and sort_type = 5 and proc = 0 ORDER BY endtime ASC";
				break;
			case 6:
				$q = "SELECT * FROM " . TB_PREFIX . "movement," . TB_PREFIX . "odata, " . TB_PREFIX . "attacks where " . TB_PREFIX . "odata.wref IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.to IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "attacks.attack_type != 1 and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				//$q = "SELECT * FROM " . TB_PREFIX . "movement," . TB_PREFIX . "odata, " . TB_PREFIX . "attacks where " . TB_PREFIX . "odata.conqured IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.to = " . TB_PREFIX . "odata.wref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				break;
			case 7:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC";
				break;
			case 8:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 1 ORDER BY endtime ASC";
				break;
			// T4 hero port: hero travelling to an adventure (plain select,
			// ref points to hero_adventure - NOT to attacks, so no join).
			case 20:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and sort_type = 20 and proc = 0 ORDER BY endtime ASC";
				break;
			// T4 hero port: hero returning from an adventure.
			case 21:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and sort_type = 21 and proc = 0 ORDER BY endtime ASC";
				break;
			case 34:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 or " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 4 ORDER BY endtime ASC";
				break;
			default:
				return [];
		}

		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$marketMovementCache[$type.$village[0].$mode] = $result;
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$marketMovementCache[ $type . $record[ $where ] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no movements were found for these villages
            foreach ($village as $key) {
                if (!isset(self::$marketMovementCache[$type.$key.$mode])) {
                    self::$marketMovementCache[$type.$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$marketMovementCache : self::$marketMovementCache[$type.$village[0].$mode]);
	}

	function addA2b($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type) {
	    list($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type) = $this->escape_input($ckey, (int) $timestamp, (int) $to, (int) $t1, (int) $t2, (int) $t3, (int) $t4, (int) $t5, (int) $t6, (int) $t7, (int) $t8, (int) $t9, (int) $t10, (int) $t11, (int) $type);

		$q = "INSERT INTO " . TB_PREFIX . "a2b (ckey,time_check,to_vid,u1,u2,u3,u4,u5,u6,u7,u8,u9,u10,u11,type) VALUES ('$ckey', '$timestamp', '$to', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$type')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

    function remA2b($id) {
        $id = (int) $id;

        $q = "DELETE FROM " . TB_PREFIX . "a2b WHERE id = $id";
        return mysqli_query($this->dblink,$q);
    }

    function claimA2b($id, $ckey) {
        $id = (int)$id;
        list($ckey) = $this->escape_input($ckey);

        $q = "DELETE FROM " . TB_PREFIX . "a2b WHERE id = $id AND ckey = '".$ckey."' LIMIT 1";
        mysqli_query($this->dblink, $q);

        return (mysqli_affected_rows($this->dblink) === 1);
    }

	// no need to cache this method
	function getA2b($ckey) {
        list($ckey) = $this->escape_input($ckey);

		$q = "SELECT * from " . TB_PREFIX . "a2b where ckey = '" . $ckey . "'";
		$result = mysqli_query($this->dblink,$q);
		if($result) return mysqli_fetch_assoc($result);
        else return false;
	}

	function addMovement($type, $from, $to, $ref, $time, $endtime, $send = 1, $wood = 0, $clay = 0, $iron = 0, $crop = 0, $ref2 = 0) {
        // always prepare for multiple inserts at once
        if (!is_array($type)) {
            $type = [$type];
            $from = [$from];
            $to = [$to];
            $ref = [$ref];
            $time = [$time];
            $endtime = [$endtime];
            $send = [$send];
            $wood = [$wood];
            $clay = [$clay];
            $iron = [$iron];
            $crop = [$crop];
            $ref2 = [$ref2];
        }

        $counter = 0;
        $pairs = [];

        foreach ($type as $index => $typeValue) {
            $pairs[] = '(0, '.(int) $typeValue.', '.(int) $from[$index].', '.(int) $to[$index].', '.(int) $ref[$index].', '.(int) $ref2[$index].', '.(int) $time[$index].', '.(int) $endtime[$index].', 0, '.(int) $send[$index].', '.(int) $wood[$index].', '.(int) $clay[$index].', '.(int) $iron[$index].', '.(int) $crop[$index].')';

            if ($counter++ > 25) {
                $q = "INSERT INTO " . TB_PREFIX . "movement (moveid, sort_type, `from`, `to`, ref, ref2, starttime, endtime, proc, send, wood, clay, iron, crop) VALUES ".implode(', ', $pairs);
                mysqli_query($this->dblink,$q);

                $pairs = [];
                $counter = 0;
            }
        }

        if ($counter > 0) {
            $q = "INSERT INTO " . TB_PREFIX . "movement (moveid, sort_type, `from`, `to`, ref, ref2, starttime, endtime, proc, send, wood, clay, iron, crop) VALUES " . implode( ', ', $pairs );
            return mysqli_query( $this->dblink, $q );
        } else {
            return true;
        }
	}

	function addAttack($vid, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type, $ctar1, $ctar2, $spy,$b1=0,$b2=0,$b3=0,$b4=0,$b5=0,$b6=0,$b7=0,$b8=0) {
	    if (!is_array($vid)) {
	        $vid = [$vid];
	        $t1 = [$t1];
            $t2 = [$t2];
            $t3 = [$t3];
            $t4 = [$t4];
            $t5 = [$t5];
            $t6 = [$t6];
            $t7 = [$t7];
            $t8 = [$t8];
            $t9 = [$t9];
            $t10 = [$t10];
            $t11 = [$t11];
            $type = [$type];
            $ctar1 = [$ctar1];
            $ctar2 = [$ctar2];
            $spy = [$spy];
            $b1 = [$b1];
            $b2 = [$b2];
            $b3 = [$b3];
            $b4 = [$b4];
            $b5 = [$b5];
            $b6 = [$b6];
            $b7 = [$b7];
            $b8 = [$b8];
        }

        $values = [];
        foreach ($vid as $index => $vidValue) {
            $values[] = '(0, '.(int) $vidValue.', '.(int) $t1[$index].', '.(int) $t2[$index].', '.(int) $t3[$index].', '.
                        (int) $t4[$index].', '.(int) $t5[$index].', '.(int) $t6[$index].', '.(int) $t7[$index].', '.
                        (int) $t8[$index].', '.(int) $t9[$index].', '.(int) $t10[$index].', '.(int) $t11[$index].
                        ', '.(int) $type[$index].', '.(int) $ctar1[$index].', '.(int) $ctar2[$index].', '.
                        (int) $spy[$index].', '.(int) $b1[$index].', '.(int) $b2[$index].', '.(int) $b3[$index].
                        ', '.(int) $b4[$index].', '.(int) $b5[$index].', '.(int) $b6[$index].', '.(int) $b7[$index].
                        ', '.(int) $b8[$index].')';
        }

		$q = "INSERT INTO " . TB_PREFIX . "attacks VALUES ".implode(', ', $values);
		mysqli_query($this->dblink,$q);

		return (count($vid) == 1 ? mysqli_insert_id($this->dblink) : true);
	}

	function modifyAttack($aid, $unit, $amt) {
	    list($aid, $unit, $amt) = $this->escape_input((int) $aid, $unit, (int) $amt);

		$unit = 't' . $unit;
		$q = "UPDATE " . TB_PREFIX . "attacks set $unit = $unit - $amt where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyAttack2($aid, $unit, $amt, $mode = 1) {
	    list($aid, $unit, $amt) = $this->escape_input((int) $aid, $unit, $amt);

	    if (!is_array($unit)) {
	        $unit = [$unit];
	        $amt = [$amt];
        }

        $pairs = [];
	    foreach ($unit as $index => $unitValue) {
	        $unitValue = 't' . $this->escape($unitValue);
            $pairs[] = $unitValue . ' = ' . $unitValue . (($mode) ? ' + ' : ' - ') . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "attacks SET ".implode(', ', $pairs)." WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyAttack3($aid, $units) {
	    list($aid, $units) = $this->escape_input((int) $aid, $units);

        $q = "UPDATE ".TB_PREFIX."attacks set $units WHERE id = $aid";
        return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
	function getVillageMovement($id) {
        list($id) = $this->escape_input($id);

		$vinfo = $this->getVillage($id);
		$vtribe = $this->getUserField($vinfo['owner'], "tribe", 0);
        $movingunits = [];
        
		$outgoingarray = $this->getMovement(3, $id, 0);
		if(!empty($outgoingarray) && count($outgoingarray)) {
			foreach($outgoingarray as $out) {
				for($i = 1; $i <= 10; $i++) {
				    if (!isset($movingunits['u'.(($vtribe - 1) * 10 + $i)])) {
				        $movingunits['u'.(($vtribe - 1) * 10 + $i)] = 0;
				    }

				    if (!isset($out['t'.$i])) $out['t'.$i] = 0;
					$movingunits['u'.(($vtribe - 1) * 10 + $i)] += $out['t'.$i];
				}

				if (!isset($movingunits['hero'])) $movingunits['hero'] = 0;
				if (!isset($out['t11'])) $out['t11'] = 0;
				
				$movingunits['hero'] += $out['t11'];
			}
		}
		
		$returningarray = $this->getMovement(4, $id, 1);
		if(!empty($returningarray) && count($returningarray)) {
			foreach($returningarray as $ret) {
			    for($i = 1; $i <= 10; $i++) {
			        if (!isset($movingunits['u'.(($vtribe - 1) * 10 + $i)])) {
			            $movingunits['u'.(($vtribe - 1) * 10 + $i)] = 0;
			        }
			        $movingunits['u'.(($vtribe - 1) * 10 + $i)] += $ret['t' . $i];
			    }
			    
			    if (!isset($movingunits['hero'])) $movingunits['hero'] = 0;
			    $movingunits['hero'] += $ret['t11'];
			}
		}
		
		$settlerarray = $this->getMovement(5, $id, 0);
		if(!empty($settlerarray)) {
		    if (!isset($movingunits['u'.($vtribe * 10)])) {
		        $movingunits['u'.($vtribe * 10)] = 0;
		    }
			$movingunits['u'.($vtribe * 10)] += 3 * count($settlerarray);
		}
		return $movingunits;
	}

    // no need to cache this method
	function getMovementById($id) {
	    list($id) = $this->escape_input((int) $id);
		$q = "SELECT * FROM ".TB_PREFIX."movement WHERE moveid = ".$id;
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

	// Rally-point attack marker (issue #245): a defender can tag an incoming
	// attack green/yellow/red. The WHERE clause restricts the update to a
	// movement whose target village (`to`) belongs to $uid, so a player can
	// only mark attacks incoming on their own villages.
	function setMovementMarker($moveid, $marker, $uid) {
		$moveid = (int) $moveid;
		$marker = (int) $marker;
		$uid    = (int) $uid;
		if ($marker < 0 || $marker > 3 || $moveid <= 0 || $uid <= 0) {
			return false;
		}
		$q = "UPDATE ".TB_PREFIX."movement SET marker = ".$marker.
			" WHERE moveid = ".$moveid.
			" AND `to` IN (SELECT wref FROM ".TB_PREFIX."vdata WHERE owner = ".$uid.")";
		return mysqli_query($this->dblink, $q) && mysqli_affected_rows($this->dblink) > 0;
	}

    // no need to cache this method
	function getVilFarmlist($uid) {
		list($uid) = $this->escape_input((int) $uid);
		
		$q = 'SELECT * FROM ' . TB_PREFIX . 'farmlist WHERE owner = '.$uid.' ORDER BY wref ASC LIMIT 1';
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return ($dbarray['id'] ?? 0) > 0;
	}

    // no need to cache this method
	function getRaidList($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "raidlist WHERE id = ".$id." LIMIT 1";
		$result = mysqli_query($this->dblink, $q);
		return mysqli_fetch_array($result);
	}
	
	/**
	 * Get all informations about a farm list
	 * 
	 * @param int $id The farmlist ID
	 * @return array Returns the seleted farm list informations
	 */

	function getFLData($id) {
		list($id) = $this->escape_input((int) $id);
		
		$q = "SELECT * FROM " . TB_PREFIX . "farmlist where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}
	

	function delFarmList($id, $owner) {
	    list($id, $owner) = $this->escape_input((int) $id, (int) $owner);

		$q = "DELETE FROM " . TB_PREFIX . "farmlist where id = $id and owner = $owner";
		if(mysqli_query($this->dblink, $q) && mysqli_affected_rows($this->dblink) > 0){
			$q = "DELETE FROM " . TB_PREFIX . "raidlist where lid = $id";
			return mysqli_query($this->dblink, $q);
		}
		return false;
	}

	function delSlotFarm($id, $owner, $lid) {
	    list($id, $owner, $lid) = $this->escape_input((int) $id, (int) $owner, (int) $lid);
	    
		$q = "DELETE FROM " . TB_PREFIX . "raidlist WHERE id = $id AND lid = $lid AND EXISTS(SELECT 1 FROM " . TB_PREFIX . "farmlist WHERE id = $lid AND owner = $owner)";
		return mysqli_query($this->dblink,$q);
	}

	function createFarmList($wref, $owner, $name) {
        list($wref, $owner, $name) = $this->escape_input($wref, $owner, $name);

		$q = "INSERT INTO " . TB_PREFIX . "farmlist (`wref`, `owner`, `name`) VALUES ('$wref', '$owner', '$name')";
		return mysqli_query($this->dblink,$q);
	}

	function addSlotFarm($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6) {
        list($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6) = $this->escape_input($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6);
        
	for($i = 1; $i <= 6; $i++) {
            if (${'t'.$i} == '') {
                ${'t'.$i} = 0;
            }
        }
		$q = "INSERT INTO " . TB_PREFIX . "raidlist (`lid`, `towref`, `x`, `y`, `distance`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`) VALUES ('$lid', '$towref', '$x', '$y', '$distance', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6')";
		return mysqli_query($this->dblink,$q);
	}

	function editSlotFarm($eid, $lid, $oldLid, $owner, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6) {
		list($eid, $lid, $oldLid, $owner, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6) = $this->escape_input((int) $eid, $lid, $oldLid, $owner, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6);

	for($i = 1; $i <= 6; $i++) {
            if (${'t'.$i} == '') {
                ${'t'.$i} = 0;
            }
        }
		$q = "UPDATE " . TB_PREFIX . "raidlist SET lid = '$lid', towref = '$wref', x = '$x', y = '$y', distance = '$dist', t1 = '$t1', t2 = '$t2', t3 = '$t3', t4 = '$t4', t5 = '$t5', t6 = '$t6' WHERE id = $eid AND lid = $oldLid AND EXISTS(SELECT 1 FROM " . TB_PREFIX . "farmlist WHERE id = $lid AND owner = $owner) AND EXISTS(SELECT 1 FROM " . TB_PREFIX . "farmlist WHERE id = $oldLid AND owner = $owner)";
		return mysqli_query($this->dblink,$q);
	}
	
	//general statistics

	function addGeneralAttack($casualties) {
        list($casualties) = $this->escape_input($casualties);

		$time = time();
		$q = "INSERT INTO " . TB_PREFIX . "general values (0,'$casualties','$time',1)";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function getAttackByDate($time) {
        list($time) = $this->escape_input($time);

		$q = "SELECT time FROM " . TB_PREFIX . "general where shown = 1";
		$result = $this->query_return($q);
		$attack = 0;
		foreach($result as $general) {
		    if(date("j. M",$time) == date("j. M",$general['time'])){
		        $attack += 1;
		    }
		}
		return $attack;
	}

    // no need to cache this method
	function getAttackCasualties($time) {
        list($time) = $this->escape_input($time);

		$q = "SELECT time, casualties FROM " . TB_PREFIX . "general where shown = 1";
		$result = $this->query_return($q);
		$casualties = 0;
		foreach($result as $general){
		    if(date("j. M",$time) == date("j. M",$general['time'])){
		        $casualties += $general['casualties'];
		    }
		}
		return $casualties;
	}

	function setVillageEvasion($vid) {
        list($vid) = $this->escape_input($vid);

        $village = $this->getVillage((int) $vid);
		if($village['evasion'] == 0){
		$q = "UPDATE " . TB_PREFIX . "vdata SET evasion = 1 WHERE wref = $vid";
		}else{
		$q = "UPDATE " . TB_PREFIX . "vdata SET evasion = 0 WHERE wref = $vid";
		}
		return mysqli_query($this->dblink,$q);
	}

	function addPrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {
	    list($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) = $this->escape_input((int) $wid,(int) $from,(int) $t1,(int) $t2,(int) $t3,(int) $t4,(int) $t5,(int) $t6,(int) $t7,(int) $t8,(int) $t9,(int) $t10,(int) $t11);

		$q = "INSERT INTO " . TB_PREFIX . "prisoners values (0,$wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11)";
		mysqli_query($this->dblink,$q);
		self::$prisonersCache = [];
		return mysqli_insert_id($this->dblink);
	}

	function updatePrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {
	    list($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) = $this->escape_input((int) $wid,(int) $from,(int) $t1,(int) $t2,(int) $t3,(int) $t4,(int) $t5,(int) $t6,(int) $t7,(int) $t8,(int) $t9,(int) $t10,(int) $t11);

        $q = "UPDATE " . TB_PREFIX . "prisoners set t1 = t1 + $t1, t2 = t2 + $t2, t3 = t3 + $t3, t4 = t4 + $t4, t5 = t5 + $t5, t6 = t6 + $t6, t7 = t7 + $t7, t8 = t8 + $t8, t9 = t9 + $t9, t10 = t10 + $t10, t11 = t11 + $t11 where wref = $wid and ".TB_PREFIX."prisoners.from = $from";
        $res = mysqli_query($this->dblink,$q);
        self::$prisonersCache = [];
        return $res;
    }

    /**
     * Used to modify prisoners through the inserted id
     * 
     * @param int $id The prisoner id where prisoners are in the database
     * @param int $unit The type of the unit
     * @param int $amount The amount of the unit you want to sum/subtract
     * @param int $mode 0 for subtracting the inserted amount, 1 for adding it
     * @return bool Returns false on failure and true on success 
     */
    
    function modifyPrisoners($id, $units, $amount, $mode) {
        list($id, $units, $amount, $mode) = $this->escape_input((int) $id, $units, $amount,(int) $mode);
        
        if (!is_array($units))
        {
            $units = [$units];
            $amount = [$amount];
        }
               
        $prisoners = [];
        foreach($units as $index => $unit) 
        {
            $unit = 't'.$this->escape($unit);
            $prisoners[] = $unit." = ".$unit.(!$mode ? " - " : " + ").(int)$amount[$index];
        }
        
        $q = "UPDATE " . TB_PREFIX . "prisoners set ".implode(', ', $prisoners)." WHERE id = $id"; 
        return mysqli_query($this->dblink,$q);
    }

    function getPrisoners($wid, $mode = 0, $use_cache = true) {
        $array_passed = is_array($wid);
        $mode = (int) $mode;

        if (!$array_passed) {
            $wid = [(int) $wid];
        } else {
            foreach ($wid as $index => $widValue) {
                $wid[$index] = (int) $widValue;
            }
        }

        if (!count($wid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$prisonersCache[$wid[0].$mode]) && is_array(self::$prisonersCache[$wid[0].$mode]) && !count(self::$prisonersCache[$wid[0].$mode])) {
            return self::$prisonersCache[$wid[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newWIDs = [];
            foreach ($wid as $key) {
                if (!isset(self::$prisonersCache[$key.$mode])) {
                    $newWIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newWIDs)) {
                return self::$prisonersCache;
            } else {
                // update remaining IDs to select and cache
                $wid = $newWIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$prisonersCache, $wid[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

        if(!$mode) {
            $q = "SELECT * FROM " . TB_PREFIX . "prisoners where wref IN(".implode(', ', $wid).")";
        }else {
            $q = "SELECT * FROM " . TB_PREFIX . "prisoners where `from` IN(".implode(', ', $wid).")";
        }
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            if (count($result) == 1) {
                $result = $result[0];
            }
            self::$prisonersCache[$wid[0].$mode] = (count($result) ? [$result] : []);
		} else {
    if ($result && count($result)) {
        foreach ($result as $record) {
            $key = $record[($mode ? 'from' : 'wref')] . $mode;
            if (!isset(self::$prisonersCache[$key])) {
                self::$prisonersCache[$key] = [];
            }
            self::$prisonersCache[$key][] = $record;
        }
    }

    // check for any missing IDs and fill them in with blanks,
    // since no prisoners were found for these villages
    foreach ($wid as $key) {
        if (!isset(self::$prisonersCache[$key.$mode])) {
            self::$prisonersCache[$key.$mode] = [];
        }
    }
}

        return ($array_passed ? self::$prisonersCache : self::$prisonersCache[$wid[0].$mode]);
    }

	function getPrisoners2($wid,$from, $use_cache = true) {
	    list($wid,$from) = $this->escape_input((int) $wid,(int) $from);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$prisonersCacheByVillageAndFromIDs, $wid.$from)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where wref = $wid and " . TB_PREFIX . "prisoners.from = $from";
		$result = mysqli_query($this->dblink,$q);

        self::$prisonersCacheByVillageAndFromIDs[$wid.$from] = $this->mysqli_fetch_all($result);
        return self::$prisonersCacheByVillageAndFromIDs[$wid.$from];
	}

	function getPrisonersByID($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$prisonersCacheByID, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$prisonersCacheByID[$id] = mysqli_fetch_array($result);
        return self::$prisonersCacheByID[$id];
	}

	function getPrisoners3($from, $use_cache = true) {
    list($from) = $this->escape_input((int) $from);
    
    // first of all, check if we should be using cache and whether the field
    // required is already cached
    if ($use_cache && ($cachedValue = self::returnCachedContent(self::$prisonersCacheByVillageAndFromIDs, $from)) && !is_null($cachedValue)) {
        return $cachedValue;
    }
    
    $q = "SELECT * FROM " . TB_PREFIX . "prisoners where " . TB_PREFIX . "prisoners.from = $from";
    $result = mysqli_query($this->dblink,$q);
    
    self::$prisonersCacheByVillageAndFromIDs[$from] = $this->mysqli_fetch_all($result); // FIX: scos $wid
    return self::$prisonersCacheByVillageAndFromIDs[$from];
	}

	function deletePrisoners($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $idValue) {
            $id[$index] = (int) $idValue;
        }

		$q = "DELETE FROM " . TB_PREFIX . "prisoners WHERE id IN(".implode(', ', $id).")";
		mysqli_query($this->dblink,$q);

		self::$prisonersCache = [];
	}
}
