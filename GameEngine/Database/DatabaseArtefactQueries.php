<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseArtefactQueries.php                                 ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Artifacts, WW plans, timeline, milestones                   ##
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

trait DatabaseArtefactQueries {


	/***************************
	Function to get WW name
	Made by: Dzoki
	***************************/

    // no need to cache this method
	function getWWName($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT wwname FROM " . TB_PREFIX . "fdata WHERE vref = $vref LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['wwname'];
	}

	/***************************
	Function to change WW name
	Made by: Dzoki
	***************************/

	function submitWWname($vref, $name) {
	    list($vref, $name) = $this->escape_input((int) $vref, $name);

		$q = "UPDATE " . TB_PREFIX . "fdata SET `wwname` = '$name' WHERE " . TB_PREFIX . "fdata.`vref` = $vref";
		return mysqli_query($this->dblink,$q);
	}


	/**
	 * Calculates how much artifacts affect troops speed, cranny efficency, etc.
	 * 
	 * @param int $uid The User ID
	 * @param int $vid The village ID
	 * @param int $kind The kind of the artifact
	 * @param float $multiplicand The value which needs to be multiplied
	 * @return int Returns the new value, multiplied or divided by artifacts bonus or malus
	 */

	function getArtifactsValueInfluence($uid, $vid, $kind, $multiplicand, $round = true){
	    list($uid, $vid, $kind, $multiplicand, $round) = $this->escape_input((int) $uid,(int) $vid, $kind, $multiplicand, $round);

	    $artefacts = $foolArefacts = [];
	    $multipliers = [1 => [4, 5, 3], 2 => [1/2, 1/3, 2/3], 3 => [5, 10, 3], 4 => [1/2, 1/2, 3/4], 5 => [1/2, 1/2, 3/4], 7 => [3, 6, 2]];

	    $artefacts[] = count($this->getOwnUniqueArtefactInfo2($vid, $kind, 1, 1)); //Village effect
	    $artefacts[] = count($this->getOwnUniqueArtefactInfo2($uid, $kind, 3, 0)); //Unique effect
	    $artefacts[] = count($this->getOwnUniqueArtefactInfo2($uid, $kind, 2, 0)); //Account effect
	    
	    $multiplier = 1;
	    for($i = 0; $i < count($artefacts); $i++)
	    {
	        if($artefacts[$i] > 0) {
	            $multiplier = $multipliers[$kind][$i];
	            break;
	        }
	    }

	    $foolArefacts[] = $this->getOwnUniqueArtefactInfo2($vid, 8, 1, 1); //Village effect
	    $foolArefacts[] = $this->getOwnUniqueArtefactInfo2($uid, 8, 3, 0); //Unique effect
   
	    $foolEffect = 1;
	    for($i = 0; $i < count($foolArefacts); $i++)
	    {
	        if(count($foolArefacts[$i]) > 0 && $foolArefacts[$i]['kind'] == $kind) 
	        {
	            $foolEffect = $foolArefacts[$i]['bad_effect'] == 1 ? 1 / $foolArefacts[$i]['effect2'] : $foolArefacts[$i]['effect2'];
	            break;
	        }
	    }
	    
	    if(in_array($kind, [2, 4, 5])) $foolEffect = 1 / $foolEffect;
	    
	    return !$round ? $multiplicand * $multiplier * $foolEffect : round($multiplicand * $multiplier * $foolEffect);
	}
	
	/**
	 * Get the total artifacts sum, divided by small, great and unique, by kind
	 * 
	 * @param int $uid The User ID
	 * @param int $vid The Village ID
	 * @param int $kind The kind of the artifact
	 * @return array Returns the total artifacts sum divided by size
	 */
	
	function getArtifactsSumByKind($uid, $vid, $kind){
	    list($uid, $vid, $kind) = $this->escape_input((int) $uid, (int) $vid, (int) $kind);

	    $q = "SELECT SUM(IF((size = '1' AND vref = $vid) OR size > '1', 1, 0)) totals,
              SUM(IF(size = '1' AND vref = $vid, 1, 0)) small,
              SUM(IF(size = '2', 1, 0)) great,
              SUM(IF(size = '3', 1, 0)) `unique`
              FROM " . TB_PREFIX . "artefacts WHERE owner = ".$uid." AND active = 1 AND (type = $kind OR kind = $kind) AND del = 0";
	    $result = mysqli_query($this->dblink, $q);
	    return $this->mysqli_fetch_all($result)[0];    
	}
	
	function addArtefacts($wids, $artifactsArray) {
	    list($wids, $artifactsArray) = $this->escape_input($wids, $artifactsArray);

	    if(!is_array($wids)) $wids = [$wids];
	    
	    $time = time();
	    
	    foreach($artifactsArray as $index => $artifact){
	        $values[] = "(".$wids[$index].",".$artifact['owner'].",".$artifact['type'].",".$artifact['size'].",".$time.",'".$artifact['name']."','".$artifact['desc']."','".$artifact['effect']."','".$artifact['img']."', 0)";
	    }
	    
		$q = "INSERT INTO `" . TB_PREFIX . "artefacts` (`vref`, `owner`, `type`, `size`, `conquered`, `name`, `desc`, `effect`, `img`, `active`) VALUES ".implode(",", $values);
		return mysqli_query($this->dblink, $q);
	}

	function getWWConstructionPlans($uid, $alliance = 0){
	    list($uid, $alliance) = $this->escape_input((int) $uid, $alliance);
	    
	    if(!$alliance){
	        $q = "SELECT
			        Count(*) as Total
              FROM
                    ".TB_PREFIX."artefacts
              WHERE
                    owner = ".$uid." AND type = 11 AND active = 1 AND del = 0";
	    }else{
	        $q = "SELECT
			        Count(*) as Total
              FROM
                    ".TB_PREFIX."artefacts AS artefacts
			  INNER JOIN ".TB_PREFIX."users AS users
					ON users.id != ".$uid." AND users.alliance = ".$alliance." AND artefacts.owner = users.id AND artefacts.type = 11
		      WHERE
					users.id > 4 AND artefacts.active = 1 AND artefacts.del = 0";
	    }
            
	    $result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
	    return $result['Total'] > 0;
	}
	
    // no need to cache this method
	function getOwnArtefactInfo($vref, $use_cache = true) {
	    // load the data - type is irrelevant, since the method caches all data
        // then returns the one for our type
        $this->getOwnArtefactInfoByType($vref, 1, $use_cache);

        // return what we've cached
        return (self::$artefactInfoByTypeCache[$vref]);
	}

    // no need to cache this method since its called one time only
	function getOwnArtefactsInfo($uid) {
        list($uid) = $this->escape_input((int) $uid);
	    
	    $q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE owner = $uid AND del = 0";
	    $result = mysqli_query($this->dblink, $q);

	    return $this->mysqli_fetch_all($result);
	}

	function getOwnArtefactInfoByType2($vref, $type, $use_cache = true) {
	    return $this->getOwnArtefactInfoByType($vref, $type, $use_cache);
	}
	
	function getOwnArtefactInfoByType($vref, $type, $use_cache = true) {
        $vref = (int) $vref;
        $type = (int) $type;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$artefactInfoByTypeCache[$vref]) && is_array(self::$artefactInfoByTypeCache[$vref]) && !count(self::$artefactInfoByTypeCache[$vref])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$artefactInfoByTypeCache, $vref)) && !is_null($cachedValue)) {
            return (isset($cachedValue[$type]) ? $cachedValue[$type] : []);
        }

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vref AND del = 0 ORDER BY size";
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

		// cache all types and return the requested one
        if (count($result)) {
            foreach ($result as $arteInfo) {
                if (!isset(self::$artefactInfoByTypeCache[$arteInfo['vref']])) {
                    self::$artefactInfoByTypeCache[$arteInfo['vref']] = [];
                }

                // we're sorting by size, thus we only need the first one per each type
                if (isset(self::$artefactInfoByTypeCache[$arteInfo['vref']]) && !isset(self::$artefactInfoByTypeCache[$arteInfo['vref']][$arteInfo['type']])) {
                    self::$artefactInfoByTypeCache[$arteInfo['vref']][$arteInfo['type']] = $arteInfo;
                }
            }
        } else {
            self::$artefactInfoByTypeCache[$vref] = [];
        }

        return (isset(self::$artefactInfoByTypeCache[$vref][$type]) ? self::$artefactInfoByTypeCache[$vref][$type] : []);
	}

	function getOwnUniqueArtefactInfo2($id, $type, $size, $mode, $use_cache = true) {
	    list($id, $type, $size, $mode) = $this->escape_input((int) $id, (int) $type, (int) $size, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$artefactDataCache[$id.$mode]) && is_array(self::$artefactDataCache[$id.$mode]) && !count(self::$artefactDataCache[$id.$mode])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$artefactDataCache, $id.$mode)) && !is_null($cachedValue)) {
            return (isset($cachedValue[$size.$type]) ? $cachedValue[$size.$type] : []);
        }

        $q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE ".(!$mode ? 'owner' : 'vref')." = $id AND active = 1 AND del = 0";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // cache all types and return the requested one
        if (count($result)) {
            foreach ($result as $arteInfo) {
                if (!isset(self::$artefactDataCache[$arteInfo[(!$mode ? 'owner' : 'vref')] . $mode])) {
                    self::$artefactDataCache[$arteInfo[(!$mode ? 'owner' : 'vref')] . $mode] = [];
                }

                self::$artefactDataCache[$arteInfo[(!$mode ? 'owner' : 'vref')] . $mode][$arteInfo['size'].$arteInfo['type']] = $arteInfo;
            }
        } else {
            self::$artefactDataCache[$id.$mode] = [];
        }

        return (isset(self::$artefactDataCache[$id.$mode][$size.$type]) ? self::$artefactDataCache[$id.$mode][$size.$type] : []);
	}

	/**
	 * Get deleted artifacts
	 *
	 * @return array Returns the deleted artifacts
	 */
	
	function getDeletedArtifacts(){   
	    $q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE del = 1";
	    $result = mysqli_query($this->dblink, $q);
	    return $this->mysqli_fetch_all($result);
	}
	
	function villageHasArtefact($vref) {
        // this is a somewhat non-ideal, externally non-changeable way of caching
        // but since we're only ever going to be calling this from a single point of Automation,
        // this will more than suffice
        static $cachedData = [];
        $vref = (int) $vref;

        if (isset($cachedData[$vref])) {
            return $cachedData[$vref];
        }

        $q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "artefacts WHERE vref = $vref AND del = 0";
        $result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
        $cachedData[$vref] = $result['Total'];

        return $cachedData[$vref];
    }
	
	/**
	 * =====================================================================
	 * SERVER MILESTONES (NEW_FUNCTIONS_MILESTONES)
	 * =====================================================================
	 * "First player on the server to..." achievements. Each milestone_key
	 * is recorded AT MOST ONCE, ever — the table's UNIQUE KEY on
	 * milestone_key does the actual "first wins" enforcement at the DB
	 * level via INSERT IGNORE, so this is race-condition-safe even if two
	 * players' actions are processed in the same cron batch: only one
	 * INSERT can ever succeed for a given key, no matter how many
	 * processes attempt it concurrently.
	 */

	/**
	 * Attempts to record a milestone. Only the very first call for a given
	 * $key across the server's lifetime actually stores anything.
	 *
	 * @param string $key  Unique milestone identifier, e.g. 'second_village'
	 * @param int    $uid  The user who achieved it
	 * @param int    $vref The village where it happened (0 if not applicable)
	 * @param string $extra Optional free-form context (e.g. alliance name)
	 * @return bool true if THIS call is the one that recorded the milestone
	 */
	function recordMilestoneIfFirst($key, $uid, $vref = 0, $extra = '') {
	    list($key, $extra) = $this->escape_input((string) $key, (string) $extra);
	    list($uid, $vref) = [(int) $uid, (int) $vref];

	    $time = time();
	    $q = "INSERT IGNORE INTO " . TB_PREFIX . "milestones (milestone_key, uid, vref, extra, achieved_time)
	          VALUES ('$key', $uid, $vref, '$extra', $time)";
	    mysqli_query($this->dblink, $q);

	    return mysqli_affected_rows($this->dblink) > 0;
	}

	/**
	 * @return array All recorded milestones, keyed by milestone_key, each
	 *               row enriched with the achiever's username and (if
	 *               applicable) the village name.
	 */
	function getMilestones() {
	    $q = "SELECT m.milestone_key, m.uid, m.vref, m.extra, m.achieved_time,
	                 u.username, v.name AS village_name
	          FROM " . TB_PREFIX . "milestones m
	          LEFT JOIN " . TB_PREFIX . "users u ON u.id = m.uid
	          LEFT JOIN " . TB_PREFIX . "vdata v ON v.wref = m.vref";
	    $result = mysqli_query($this->dblink, $q);
	    $rows = $this->mysqli_fetch_all($result);

	    $byKey = [];
	    foreach ($rows as $row) {
	        $byKey[$row['milestone_key']] = $row;
	    }
	    return $byKey;
	}

	function claimArtefact($vref, $ovref, $id) {
	    list($vref, $ovref, $id) = $this->escape_input((int) $vref, (int) $ovref, (int) $id);

		$time = time();
		$q = "UPDATE " . TB_PREFIX . "artefacts SET vref = $vref, owner = $id, conquered = $time, active = 0 WHERE vref = $ovref";
		
		if(mysqli_query($this->dblink, $q))
		{ 
		    $artifactInfo = reset($this->getOwnArtefactInfo($vref, false));
		    $artifactID = $artifactInfo['id'];

		    // Milestones: first artifact EVER captured by any player (any
		    // type, including the WW Building Plan), and — separately —
		    // the first WW Building Plan (artefacts.type == 11) specifically.
		    // claimArtefact() is the single function that transfers artifact
		    // ownership (both the "conquer the artifact's own village" path
		    // and the "hero carries it home" path call this), so hooking
		    // here covers every capture route with no risk of missing one.
		    if (defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES) {
		        $this->recordMilestoneIfFirst('first_artifact', $id, $vref);
		        if ((int)($artifactInfo['type'] ?? 0) === 11) {
		            $this->recordMilestoneIfFirst('first_ww_plan', $id, $vref);
		        }
		    }

		    return $this->addArtifactsChronology($artifactID, $id, $vref, $time);
		}
		else return false;
	}
	
	/**
	 * Retrieves the chronology of one specific artifact
	 * 
	 * @param int $artefactid The id of the artifact
	 * @return array Returns the chronology for the passed artifact
	 */
	
	function getArtifactsChronology($artifactID){
	    list($artifactID) = $this->escape_input((int) $artifactID);

	    $q = "SELECT * FROM " . TB_PREFIX . "artefacts_chrono WHERE artefactid = $artifactID ORDER BY conqueredtime ASC";
	    $result = mysqli_query($this->dblink, $q);
	    return $this->mysqli_fetch_all($result);
	}
	
	/**
	 * Stores when an artifact was conquered and who had conquered it
	 * 
	 * @param int $artefactid The id of the artifact
	 * @param int $vref The vref of the village that has conquered the artifact
	 * @return bool Return true if the query was successful, false otherwise
	 */
	
	function addArtifactsChronology($artifactID, $uid, $vref, $conqueredTime){
	    list($artifactID, $uid, $vref, $conqueredTime) = $this->escape_input((int) $artifactID, (int) $uid, (int) $vref, (int) $conqueredTime);

	    $q = "INSERT INTO " . TB_PREFIX . "artefacts_chrono (artefactid, uid, vref, conqueredtime) VALUES ('$artifactID', '$uid', '$vref', '$conqueredTime')";
	    return mysqli_query($this->dblink, $q);
	}
	
	/**
	 * @param mixed $size The integer/array which contains the artifacts size(s)
	 * @return int Returns if there are at least one not deleted artifact
	 */
	
	function getArtifactsBysize($size){
	    list($size) = $this->escape_input($size);
	    
	    if(!is_array($size)) $size = [$size];
	    
	    $q = "SELECT * FROM ".TB_PREFIX."artefacts WHERE size IN(".implode(',', $size).") AND del = 0 ORDER BY id ASC";
	    $result = mysqli_query($this->dblink, $q);
	    return $this->mysqli_fetch_all($result);
	}
	
	/**
	 * @param bool $mode true: check if WW Building plans are already out, false: check if artifacts are already out
	 * @return int Returns if artifacts are already out or not
	 */
	
	function areArtifactsSpawned($mode = false){
		list($mode) = $this->escape_input($mode);
		
		$q = "SELECT 1 FROM ".TB_PREFIX."artefacts".($mode ? " WHERE type = 11" : "");
		$result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
		return $result;
	}
	
	
	/**
	 * Check if WW villages are already out or not
	 *
	 * @return int Returns if artifacts are already out or not
	 */
	
	function areWWVillagesSpawned(){
		$q = "SELECT 1 FROM ".TB_PREFIX."vdata WHERE natar = 1";
		$result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
		return $result;
	}
	
	/**
	 * Get all inactive artifacts which can be activated
	 * 
	 * @return bool Returns all inactive artifacts
	 */
	
	function getInactiveArtifacts($time){
	    list($time) = $this->escape_input($time);
	    
	    $q = "SELECT * FROM ".TB_PREFIX."artefacts WHERE active = 0 AND owner > 5 AND conquered <= $time AND del = 0 ORDER BY conquered ASC, size ASC";
	    $result = mysqli_query($this->dblink, $q);
	    return $this->mysqli_fetch_all($result);
	}
	
	/**
	 * Get the sum of active artifacts by user ID, divided by: total, great, small and unique
	 * 
	 * @param int $uid The User ID of the player
	 * @param bool $mode True if you want only active artifacts, false if you want all artifacts
	 * @return array Returns the artifacts sum of the account, divided by: total, great, small and unique
	 */
	
	function getOwnArtifactsSum($uid, $mode = false){
	    list($uid) = $this->escape_input((int) $uid, $mode);
	    
	    $q = "SELECT Count(size) AS totals,
              SUM(IF(size = '1', 1, 0)) small,
              SUM(IF(size = '2', 1, 0)) great,
              SUM(IF(size = '3', 1, 0)) `unique`
              FROM " . TB_PREFIX . "artefacts WHERE owner = ".(int) $uid.($mode ? " AND active = 1 AND del = 0" : "");
	    $result = mysqli_query($this->dblink, $q);
	    return $this->mysqli_fetch_all($result)[0];
	}
	
	/**
	 * Activate an artifact by his id
	 * 
	 * @param int $id The id of the artifact
	 * @param int $mode 1 for activating an artifact, 0 for deactivating it
	 * @return bool Returns true if the query was successful, false otherwise
	 */
	
	function activateArtifact($id, $mode = 1){
	    list($id) = $this->escape_input((int) $id);
	    
	    $time = time();
	    $q = "UPDATE " . TB_PREFIX . "artefacts SET active = $mode WHERE id = $id";
	    return mysqli_query($this->dblink, $q);
	}
	
	/**
	 * Get the newest active artifact by size
	 * 
	 * @param int $size The size of the artifcat (village, account, unique)
	 * @return array Returns the newest active artifact infomations by size
	 */
	
	function getNewestArtifactBySize($id, $size){
	    list($id, $size) = $this->escape_input((int) $id, (int) $size);
	    
	    $q = "SELECT * FROM ".TB_PREFIX."artefacts WHERE active = 1 AND owner = $id AND size = $size AND del = 0 ORDER BY conquered DESC LIMIT 1";
	    $result = mysqli_query($this->dblink, $q);
	    return mysqli_fetch_array($result);
	}
	
    // no need to cache this method
    public function canClaimArtifact($from, $vref, $size, $type) {
        list($size, $type) = $this->escape_input((int) $size, (int) $type);

        $artifact = $this->getOwnArtefactInfo($from);
        if (!empty($artifact)) return  "Treasury is full. Your hero could not claim the artefact";
        
        $uid = $this->getVillageField($from, "owner");
        $vuid = $this->getVillageField($vref, "owner");

        $artifact = $this->getOwnArtifactsSum($uid);

        if ($artifact['totals'] < 3 || $uid == $vuid) {
			$DefenderFields = $this->getResourceLevel( $vref );
            $defcanclaim    = true;

            for ($i = 19; $i <= 38; $i++) {
                if ($DefenderFields['f'.$i.'t'] == 27) {
                    $defTresuaryLevel = $DefenderFields['f'.$i];
                    if ($defTresuaryLevel > 0) {
                        $defcanclaim = false;
                        return "Treasury has not been destroyed. Your hero could not claim the artefact";                   
                    }
                    else $defcanclaim = true;
                }
            }

            $AttackerFields = $this->getResourceLevel( $from, 2 );

            for($i = 19; $i <= 38; $i++) {
                if($AttackerFields['f'.$i.'t'] == 27) {
                    $attTresuaryLevel = $AttackerFields['f'.$i];
                    $villageartifact = $attTresuaryLevel >= 10;
                    $accountartifact = $attTresuaryLevel >= 20;
                }
            }

            if(($artifact['great'] > 0 || $artifact['unique'] > 0) && $size > 1 && $uid != $vuid) {
                return "Max num. of great/unique artefacts. Your hero could not claim the artefact";
            }

            if(($size == 1 && ($villageartifact || $accountartifact)) || (($size == 2 || $size == 3) && $accountartifact)) {
                return "";
            }
            else return "Your level treasury is low. Your hero could not claim the artefact";
        } 
        else return "Max num. of artefacts. Your hero could not claim the artefact";
    }

    /**
     * Get the informations of a single artifact
     * 
     * @param int $id The artifact id
     * @param int $del If 0, it will search not-deleted artifacts, and vice versa with 1
     * @return array Returns the artefact informations
     */
    
	function getArtefactDetails($id, $del = 0) {
	    list($id, $del) = $this->escape_input((int) $id, (int) $del);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE id = ".$id." AND del = ".$del." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}
	
	/**
	 * Update an artifact with a specified fields => values array
	 * 
	 * @param int $id The artifact ID
	 * @param array $detailsArray Contains the fields to update and the relative values
	 * @return bool Returns true if the query was successful, false otherwise
	 */
	
	function updateArtifactDetails($id, $detailsArray){
	    list($id, $detailsArray) = $this->escape_input((int) $id, $detailsArray);
	    
	    $values = [];
	    foreach($detailsArray as $field => $value) $values[] = $field."=".$value;
	    
	    $q = "UPDATE ".TB_PREFIX."artefacts SET ".implode(",", $values)." WHERE id = $id";
	    return mysqli_query($this->dblink, $q);
	}
}
