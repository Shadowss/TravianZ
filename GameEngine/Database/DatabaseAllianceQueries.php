<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseAllianceQueries.php                                 ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Alliances, invitations, diplomacy, embassies                ##
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

trait DatabaseAllianceQueries {


	function getAllianceName($id, $use_cache = true) {
    $alliance = $this->getAlliance($id, $use_cache);
    if (!is_array($alliance) || !isset($alliance['tag'])) {
        return null;
    }
    return $alliance['tag'];
	}

	// no need to cache this method
	
	function getAlliancePermission($uid, $field, $alliance) {
    $uid = (int)$uid;
    $alliance = (int)$alliance;

    // whitelist câmpuri permise
    $allowed_fields = ['ap1','ap2','ap3','ap4','ap5','ap6','ap7','ap8','ap9','ap10','owner','admin','rank'];

    if (!in_array($field, $allowed_fields)) {
        error_log("Invalid field in getAlliancePermission: $field");
        return false;
    }

    $q = "SELECT `$field` FROM " . TB_PREFIX . "ali_permission WHERE uid = $uid AND alliance = $alliance LIMIT 1";

    $result = mysqli_query($this->dblink, $q);

    if (!$result) {
        error_log("SQL Error in getAlliancePermission: " . mysqli_error($this->dblink) . " | Query: $q");
        return false;
    }

    if (mysqli_num_rows($result) == 0) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);

    return $row[$field];
	}

	function getAlliance($id, $use_cache = true) {
	    $id = (int) $id;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceDataCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * from " . TB_PREFIX . "alidata where id = $id";
		$result = mysqli_query($this->dblink,$q);

        self::$allianceDataCache[$id] = mysqli_fetch_assoc($result);
        return self::$allianceDataCache[$id];
	}

	function setAlliName($aid, $name, $tag) {
	    list($aid, $name, $tag) = $this->escape_input((int) $aid, $name, $tag);
        $name = $this->RemoveXSS($name);
        $tag = $this->RemoveXSS($tag);

		$q = "UPDATE " . TB_PREFIX . "alidata set name = '$name', tag = '$tag' where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function isAllianceOwner($id, $use_cache = true) {
	    $id = (int) $id;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceOwnerCheckCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT id from " . TB_PREFIX . "alidata where leader = ". $id;
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
		    $result = mysqli_fetch_assoc($result);
			$result = $result['id'];
		} 
		else $result = false;

        self::$allianceOwnerCheckCache[$id] = $result;
        return self::$allianceOwnerCheckCache[$id];
	}

	function countAllianceMembers($aid, $use_cache = true) {
	    $aid = (int) $aid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceMembersCountCache, $aid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    $q = "SELECT Count(*) as Total from ".TB_PREFIX."users WHERE alliance = ".$aid;
	    $membersCount = $this->query_return($q);

        self::$allianceMembersCountCache[$aid] = $membersCount[0]['Total'];
        return self::$allianceMembersCountCache[$aid];
	}

    // no need to cache this method
	function aExist($ref, $type) {
        list($ref, $type) = $this->escape_input($ref, $type);

		$q = "SELECT $type FROM " . TB_PREFIX . "alidata where $type = '$ref'";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_num_rows($result);
	}

	/*****************************************
	Function to create an alliance
	References:
	*****************************************/
	function createAlliance($tag, $name, $uid, $max) {
	    list($tag, $name, $uid, $max) = $this->escape_input($tag, $name, (int) $uid, (int) $max);
        $tag = $this->RemoveXSS($tag);
        $name = $this->RemoveXSS($name);

	    $q = "INSERT into " . TB_PREFIX . "alidata values (0,'$name','$tag',$uid,0,0,0,'','',$max,0,0,0,0,0,0,0,0,0)";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	function procAllyPop($aid) {
        list($aid) = $this->escape_input($aid);

		$ally = $this->getAlliance($aid);
		$memberlist = $this->getAllMember($ally['id']);
		$oldrank = 0;
        $memberIDs = [];

        foreach($memberlist as $member) {
            $memberIDs[] = $member['id'];
        }

        $data = $this->getVSumField($memberIDs,"pop");

        if (count($data)) {
            foreach ($data as $row) {
                $oldrank += $row['Total'];
            }
        }

		if($ally['oldrank'] != $oldrank){
			if($ally['oldrank'] < $oldrank) {
				$totalpoints = $oldrank - $ally['oldrank'];
				$this->addclimberrankpopAlly($ally['id'], $totalpoints);
				$this->updateoldrankAlly($ally['id'], $oldrank);
			} else
				if($ally['oldrank'] > $oldrank) {
					$totalpoints = $ally['oldrank'] - $oldrank;
					$this->removeclimberrankpopAlly($ally['id'], $totalpoints);
					$this->updateoldrankAlly($ally['id'], $oldrank);
				}
		}
	}

	/*****************************************
	Function to insert an alliance new
	References:
	*****************************************/
	function insertAlliNotice($aid, $notice) {
        list($aid, $notice) = $this->escape_input($aid, $notice);

		$time = time();
		$q = "INSERT into " . TB_PREFIX . "ali_log values (0,'$aid','$notice',$time)";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	/*****************************************
	Function to delete alliance if empty
	References:
	*****************************************/
	function deleteAlliance($aid) {
	    list($aid) = $this->escape_input((int) $aid);

	    $result = mysqli_fetch_array(mysqli_query($this->dblink,"SELECT Count(*) as Total FROM " . TB_PREFIX . "users where alliance = $aid"), MYSQLI_ASSOC);
		if ($result['Total'] == 0) {
	        // remove the alliance
	        $q = "DELETE FROM " . TB_PREFIX . "alidata WHERE id = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all permissions for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "ali_permission WHERE alliance = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all logs for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "ali_log WHERE aid = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all medals for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "allimedal WHERE allyid = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all invitations for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "ali_invite WHERE alliance = $aid";
	        mysqli_query($this->dblink,$q);
	    }
	}

	/*****************************************
	Function to read all alliance news
	References:
	*****************************************/
	function readAlliNotice($aid) {
	    list($aid) = $this->escape_input((int) $aid);

		$q = "SELECT * from " . TB_PREFIX . "ali_log where aid = $aid ORDER BY date DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	/*****************************************
	Function to create alliance permissions
	References: ID, notice, description
	*****************************************/
	function createAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8) {
        list($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8) = $this->escape_input($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8);


		$q = "INSERT into " . TB_PREFIX . "ali_permission values(0,'$uid','$aid','$rank','$opt1','$opt2','$opt3','$opt4','$opt5','$opt6','$opt7','$opt8')";
		mysqli_query($this->dblink,$q);

		// update cache
        $insertID = mysqli_insert_id($this->dblink);
        self::$alliancePermissionsCache[$uid.$aid] = [
            'id' => $insertID,
            'uid' => $uid,
            'alliance' => $aid,
            'rank' => $rank,
            'opt1' => $opt1,
            'opt2' => $opt2,
            'opt3' => $opt3,
            'opt4' => $opt4,
            'opt5' => $opt5,
            'opt6' => $opt6,
            'opt7' => $opt7,
            'opt8' => $opt8
        ];

		return $insertID;
	}

	/*****************************************
	Function to update alliance permissions
	References:
	*****************************************/
	function deleteAlliPermissions($uid) {
        list($uid) = $this->escape_input($uid);

		$q = "DELETE from " . TB_PREFIX . "ali_permission where uid = '$uid'";
		return mysqli_query($this->dblink,$q);
	}
	/*****************************************
	Function to update alliance permissions
	References:
	*****************************************/
	
	function updateAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7){
		list($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7) = $this->escape_input((int)$uid, (int)$aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7);
		        // update cache
        if (isset(self::$alliancePermissionsCache[$uid.$aid])) {
            self::$alliancePermissionsCache[ $uid . $aid ]['rank'] = $rank;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt1'] = $opt1;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt2'] = $opt2;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt3'] = $opt3;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt4'] = $opt4;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt5'] = $opt5;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt6'] = $opt6;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt7'] = $opt7;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt8'] = $opt8;
        }
	$q = "UPDATE " . TB_PREFIX . "ali_permission SET `rank` = '$rank',opt1 = '$opt1', opt2 = '$opt2', opt3 = '$opt3', opt4 = '$opt4', opt5 = '$opt5', opt6 = '$opt6', opt7 = '$opt7' WHERE uid = $uid AND alliance = $aid LIMIT 1";
    $result = mysqli_query($this->dblink, $q);
    if(!$result) {
        die("SQL ERROR: " . mysqli_error($this->dblink) . "<br><br>" . $q);
    }
    return true;
	}
	
	/*****************************************
	Function to read alliance permissions
	References: ID, notice, description
	*****************************************/
	function getAlliPermissions($uid, $aid, $use_cache = true) {
	    list($uid, $aid) = $this->escape_input((int) $uid, (int) $aid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$alliancePermissionsCache, $uid.$aid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "ali_permission where uid = $uid && alliance = $aid";
		$result = mysqli_query($this->dblink,$q);

        self::$alliancePermissionsCache[$uid.$aid] = mysqli_fetch_assoc($result);
        return self::$alliancePermissionsCache[$uid.$aid];
	}

	/*****************************************
	Function to update an alliance description and notice
	References: ID, notice, description
	*****************************************/
	function submitAlliProfile($aid, $notice, $desc) {
	    list($aid, $notice, $desc) = $this->escape_input((int) $aid, $notice, $desc);


		$q = "UPDATE " . TB_PREFIX . "alidata SET `notice` = '$notice', `desc` = '$desc' where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyInviteAdd($alli1, $alli2, $type) {
	    list($alli1, $alli2, $type) = $this->escape_input((int) $alli1, (int) $alli2, $type);

		$q = "INSERT INTO " . TB_PREFIX . "diplomacy (alli1,alli2,type,accepted) VALUES ($alli1,$alli2," . (int)intval($type) . ",0)";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyOwnOffers($sessionAlliance) {
	    list($sessionAlliance) = $this->escape_input((int) $sessionAlliance);

	    $q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $sessionAlliance AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getAllianceID($name) {
        list($name) = $this->escape_input($name);

		$q = "SELECT id FROM " . TB_PREFIX . "alidata WHERE tag ='" . $this->RemoveXSS($name) . "' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['id'];
	}

	function diplomacyCancelOffer($id, $sessionAlliance) {
	    list($id, $sessionAlliance) = $this->escape_input((int) $id, (int) $sessionAlliance);

		$q = "DELETE FROM " . TB_PREFIX . "diplomacy WHERE id = $id AND alli1 = $sessionAlliance";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyInviteAccept($id, $sessionAlliance) {
	    list($id, $sessionAlliance) = $this->escape_input((int) $id, (int) $sessionAlliance);

	    $q = "UPDATE " . TB_PREFIX . "diplomacy SET accepted = 1 WHERE id = $id AND alli2 = $sessionAlliance";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyInviteDenied($id, $sessionAlliance) {
	    list($id, $sessionAlliance) = $this->escape_input((int) $id, (int) $sessionAlliance);

	    $q = "DELETE FROM " . TB_PREFIX . "diplomacy WHERE id = $id AND alli2 = $sessionAlliance";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function diplomacyInviteCheck($sessionAlliance) {
	    list($sessionAlliance) = $this->escape_input((int) $sessionAlliance);

	    $q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli2 = $sessionAlliance AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function diplomacyInviteCheck2($ally1, $ally2) {
	    list($ally1, $ally2) = $this->escape_input((int) $ally1, (int) $ally2);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE (alli1 = $ally1 OR alli2 = $ally1) AND (alli1 = $ally2 OR alli2 = $ally2)";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getAllianceDipProfile($aid, $type) {
	    list($aid, $type) = $this->escape_input($aid, $type);
		$q = "SELECT alli1, alli2 FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '$type' AND accepted = '1' OR alli2 = '$aid' AND type = '$type' AND accepted = '1'";
		$array = $this->query_return($q);
		$text = "";

		if($array){
			foreach($array as $row){
				if($row['alli1'] == $aid) $alliance = $this->getAlliance($row['alli2']);			
				elseif($row['alli2'] == $aid) $alliance = $this->getAlliance($row['alli1']);
				$text .= "";
				$text .= "<a href=allianz.php?aid=" . $alliance['id'] . ">" . $alliance['tag'] . "</a><br> ";
			}
		}
		if(strlen($text) == 0){
			$text = "-<br>";
		}
		return $text;
	}

    // no need to cache this method
	function getAllianceWar($aid) {
	    list($aid) = $this->escape_input($aid);
		$q = "SELECT alli1, alli2 FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
		$array = $this->query_return($q);
        $text = "";

        if ($array) {
    		foreach($array as $row){
    			if($row['alli1'] == $aid){
    			$alliance = $this->getAlliance($row['alli2']);
    			}elseif($row['alli2'] == $aid){
    			$alliance = $this->getAlliance($row['alli1']);
    			}
    			$text .= "";
    			$text .= "<a href=allianz.php?aid=".$alliance['id'].">".$alliance['tag']."</a><br> ";
    		}
        }
		if(strlen($text) == 0){
			$text = "-<br>";
		}
		return $text;
	}

	function getAllianceAlly($aid, $type, $use_cache = true) {
	    list($aid, $type) = $this->escape_input($aid, $type);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceAlliesCache, $aid.$type)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE (alli1 = '$aid' or alli2 = '$aid') AND (type = '$type' AND accepted = '1')";
		$result = mysqli_query($this->dblink,$q);

        self::$allianceAlliesCache[$aid.$type] = $this->mysqli_fetch_all($result);
        return self::$allianceAlliesCache[$aid.$type];
	}

    // no need to cache this method
	function getAllianceWar2($aid) {
	    list($aid) = $this->escape_input($aid);
		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function diplomacyExistingRelationships($sessionAlliance) {
	    list($sessionAlliance) = $this->escape_input((int) $sessionAlliance);

	    $q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE (alli1 = $sessionAlliance OR alli2 = $sessionAlliance) AND accepted = 1";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function diplomacyCancelExistingRelationship($id, $sessionAlliance) {
	    list($id, $sessionAlliance) = $this->escape_input((int) $id, (int) $sessionAlliance);

	    $q = "DELETE FROM " . TB_PREFIX . "diplomacy WHERE (alli1 = $sessionAlliance OR alli2 = $sessionAlliance) AND id = $id ";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function diplomacyCheckLimits($aid, $type) {
	    list($aid, $type) = $this->escape_input((int) $aid, (int) $type);
	    if($type == 3) return true;
	    
		$q = "SELECT Count(case when alli1 = $aid then 1 end) as Total1, Count(case when alli2 = $aid then 1 end) as Total2 FROM " . TB_PREFIX . "diplomacy WHERE type = $type";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		return $result['Total1'] < 3 && $result['Total2'] < 3;
	}

	function getUserAlliance($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$userAllianceCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT " . TB_PREFIX . "alidata.tag from " . TB_PREFIX . "users join " . TB_PREFIX . "alidata where " . TB_PREFIX . "users.alliance = " . TB_PREFIX . "alidata.id and " . TB_PREFIX . "users.id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['tag'] == "") {
            self::$userAllianceCache[$id] =  "-";
		} else {
            self::$userAllianceCache[$id] = $dbarray['tag'];
		}

		return self::$userAllianceCache[$id];
	}

    // no need to cache this method
    function getInvitation($uid) {
        list($uid) = $this->escape_input((int) $uid);

        $q = "SELECT * FROM " . TB_PREFIX . "ali_invite where uid = $uid";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    // no need to cache this method
    function getInvitation2($uid, $aid) {
        list($uid, $aid) = $this->escape_input((int) $uid, (int) $aid);

        $q = "SELECT * FROM " . TB_PREFIX . "ali_invite where uid = $uid and alliance = $aid";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    // no need to cache this method
    function getAliInvitations($aid) {
        list($aid) = $this->escape_input((int) $aid);

        $q = "SELECT * FROM " . TB_PREFIX . "ali_invite where alliance = $aid && accept = 0";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    function sendInvitation($uid, $alli, $sender) {
        list($uid, $alli, $sender) = $this->escape_input((int) $uid, (int) $alli, (int) $sender);

        $time = time();
        $q = "INSERT INTO " . TB_PREFIX . "ali_invite values (0,$uid,$alli,$sender,$time,0)";
        return mysqli_query($this->dblink,$q);
    }

    function removeInvitation($id) {
        list($id) = $this->escape_input((int) $id);

        $q = "DELETE FROM " . TB_PREFIX . "ali_invite where id = $id";
        return mysqli_query($this->dblink,$q);
    }

	/**
	 * Returns a minimum level for an Embassy in order to accomodate
	 * the given number of members.
	 *
	 * @param int $membersCount Number of members for an alliance to accomodate.
	 *                          Maximum = 60
	 *
	 * @return number Returns the level of Embassy required to accomodate
	 *                the given number of members.
	 */
	public function getMinEmbassyLevel($membersCount) {
	    $membersCount = (int) $membersCount;

	    if ($membersCount > 60) {
	        $membersCount = 60;
	    }

	    if ($membersCount < 0) {
	        $membersCount = 0;
	    }

	    return ceil((20 / 60) * $membersCount);
	}

	/***
	 * Returns the number of members an alliance can hold
	 * with the current level of leader's Embassy.
	 *
	 * @param int $embassyLevel Level of leader's Embassy building.
	 *
	 * @return number Returns the number of members an alliance
	 *                can hold with the current level of leader's Embassy.
	 */
	public function getAllianceCapacity($embassyLevel) {
	    $embassyLevel = (int) $embassyLevel;

	    if ($embassyLevel > 20) {
	        $embassyLevel = 20;
	    }

	    if ($embassyLevel < 0) {
	        $embassyLevel = 0;
	    }

	    // ceil is not really necessary but to make sure
	    // decimals won't crack this up, it's here
	    return ceil((60 / 20) * $embassyLevel);
	}

	/**
	 * Checks and potentially updates the status of a player-alliance
	 * relationship given the user input.
	 *
	 * @param array $userData     Data of the user for which we want to check
	 *                            the player-alliance relationship.
	 * @param boolean $demolition Determines whether the request came from
	 *                            a buiding demolition (true) or from a battle
	 *                            report (false).
	 *
	 * @return boolean            Returns TRUE if there was no change
	 *                            to the player-alliance relationship
	 *                            FALSE if the player was an alliance
	 *                            leader and the alliance was destroyed
	 *                            and 0 when the player was evicted from
	 *                            the alliance due to Embassy damage.
	 */
	public 
    /**
     * REFACTORIZAT 14.05.2026 - împărțit în metode mici, păstrată logica originală
     * Verifică statutul ambasadelor și gestionează ieșirea din alianță
     */
    function checkAllianceEmbassiesStatus($userData, $demolition = false, $use_cache = true) {
        // fără alianță = nimic de făcut
        if (empty($userData['alliance'])) {
            return true;
        }

        $isOwner = ($this->isAllianceOwner($userData['id'], $use_cache) == $userData['alliance']);
        
        if (!$isOwner) {
            return $this->handleNonOwnerEmbassyCheck($userData, $demolition, $use_cache);
        } else {
            return $this->handleOwnerEmbassyCheck($userData, $demolition, $use_cache);
        }
    }

    // === METODE NOI EXTRAS DIN checkAllianceEmbassiesStatus ===

    private function handleNonOwnerEmbassyCheck(array $userData, bool $demolition, bool $use_cache) {
        // constantă magică 18 = Embassy - păstrată pentru compatibilitate
        $hasEmbassy = $this->getSingleFieldTypeCount($userData['id'], 18, '>=', 1, $use_cache) >= 1;
        
        if ($hasEmbassy) {
            return true; // are ambasadă, rămâne în alianță
        }

        // nu mai are ambasadă - evict
        $this->evictUserFromAlliance($userData['id']);
        $this->deleteAlliPermissions($userData['id']);

        $msgTitle = $demolition ? rc_tok('MSG_LEFT_ALLIANCE_TITLE') : rc_tok('MSG_FORCED_LEAVE_TITLE');
        $msgBody = $demolition
            ? rc_tok('MSG_LEFT_DEMOLITION_BODY', $userData['username'])
            : rc_tok('MSG_LEFT_ATTACK_BODY', $userData['username']);

        $this->sendMessage($userData['id'], 4, $msgTitle, $this->escape($msgBody), 0,0,0,0,0,true);
        
        return $demolition ? true : 0;
    }

    private function handleOwnerEmbassyCheck(array $userData, bool $demolition, bool $use_cache) {
        $membersCount = $this->countAllianceMembers($userData['alliance'], $use_cache);
        $minLevel = max(3, $this->getMinEmbassyLevel($membersCount)); // liderul are nevoie minim nivel 3

        $hasSufficientEmbassy = $this->getSingleFieldTypeCount($userData['id'], 18, '>=', $minLevel, false, $use_cache) >= 1;
        $needsAction = ($userData['lvl'] <= $minLevel) && !$hasSufficientEmbassy;

        if (!$needsAction) {
            return true;
        }

        $members = $this->getAllMember($userData['alliance'], 0, $use_cache);

        if ($demolition) {
            return $this->disbandAllianceOnDemolition($userData, $members);
        } else {
            return $this->handleOwnerAttackLoss($userData, $members, $minLevel, $membersCount, $use_cache);
        }
    }

    public function evictUserFromAlliance(int $uid): void {
        $this->query('UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id = '.$uid);
        $this->clearQueryCache('alliance'); // invalidăm cache-ul de alianță
    }

    private function disbandAllianceOnDemolition(array $ownerData, array $members): bool {
        $evicts = [];
        foreach ($members as $member) {
            $evicts[] = $member['id'];
            $isOwner = ($member['id'] == $ownerData['id']);
            $title = rc_tok('MSG_DISBAND_TITLE');
            $body = $isOwner
                ? rc_tok('MSG_DISBAND_OWNER_BODY', $ownerData['username'])
                : rc_tok('MSG_DISBAND_MEMBER_BODY', $member['username']);
            
            $this->sendMessage($member['id'], 4, $title, $this->escape($body), 0,0,0,0,0,true);
            $this->deleteAlliPermissions($member['id']);
        }
        if ($evicts) {
            $this->query('UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id IN('.implode(',', $evicts).')');
        }
        $this->deleteAlliance($ownerData['alliance']);
        return true;
    }

    private function handleOwnerAttackLoss(array $ownerData, array $members, int $minLevel, int $membersCount, bool $use_cache): bool {
        $newLeaderId = null;
        
        // căutăm primul membru cu ambasadă suficientă
        if ($membersCount > 1) {
            foreach ($members as $member) {
                if ($this->getSingleFieldTypeCount($member['id'], 18, '>=', $minLevel) >= 1) {
                    $newLeaderId = (int)$member['id'];
                    $this->promoteNewAllianceLeader($ownerData['alliance'], $newLeaderId, $ownerData['id'], $member['username'], $ownerData);
                    break;
                }
            }
        }

        if (!$newLeaderId) {
            // niciun lider eligibil - dispersăm alianța
            return $this->disperseAllianceNoLeader($ownerData, $members, $membersCount);
        }

        // avem lider nou - notificăm și eventual evictăm ownerul vechi
        return $this->notifyLeaderChange($ownerData, $members, $newLeaderId, $minLevel, $use_cache);
    }

    public function promoteNewAllianceLeader(int $allyId, int $newLeaderId, int $oldLeaderId, string $newLeaderName, array $oldLeaderData, ?string $customMessage = null): void {
        $this->query("UPDATE ".TB_PREFIX."alidata SET leader = $newLeaderId WHERE id = $allyId");
        $this->updateAlliPermissions($newLeaderId, $allyId, "Leader", 1,1,1,1,1,1,1);
        if (class_exists('Automation')) { Automation::updateMax($newLeaderId); }
        $this->updateAlliPermissions($oldLeaderId, $allyId, "Former Leader", 0,0,0,0,0,0,0);

        if ($customMessage === null) {
            $msg = rc_tok('MSG_PROMOTE_BODY', $newLeaderName, $oldLeaderId, $oldLeaderData['username']);
            $title = rc_tok('MSG_NOW_ALLIANCE_LEADER_TITLE');
        } else {
            $msg = $customMessage;
            $title = rc_tok('MSG_NOW_LEADER_TITLE');
        }
        $this->sendMessage($newLeaderId, 4, $title, $this->escape($msg), 0,0,0,0,0,true);
        $this->clearQueryCache('alliance');
    }

    private function disperseAllianceNoLeader(array $ownerData, array $members, int $membersCount): bool {
        $ids = array_column($members, 'id');
        if ($ids) {
            $this->query('UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id IN('.implode(',', $ids).')');
        }
        foreach ($members as $m) {
            $isOwner = ($m['id'] == $ownerData['id']);
            $title = rc_tok('MSG_DISPERSE_TITLE');
            if ($isOwner) {
                $body = ($membersCount > 1)
                    ? rc_tok('MSG_DISPERSE_OWNER_BODY_MANY', $ownerData['username'], $membersCount)
                    : rc_tok('MSG_DISPERSE_OWNER_BODY_FEW', $ownerData['username']);
            } else {
                $body = rc_tok('MSG_DISPERSE_MEMBER_BODY', $m['username'], $membersCount);
            }
            $this->sendMessage($m['id'], 4, $title, $this->escape($body), 0,0,0,0,0,true);
            $this->deleteAlliPermissions($m['id']);
        }
        $this->deleteAlliance($ownerData['alliance']);
        return false;
    }

    private function notifyLeaderChange(array $ownerData, array $members, int $newLeaderId, int $minLevel, bool $use_cache): bool {
        $keepOwner = ($ownerData['lvl'] > 0) || ($this->getSingleFieldTypeCount($ownerData['id'], 18, '>=', 1, $use_cache) >= 1);
        
        foreach ($members as $m) {
            if ($m['id'] == $newLeaderId) continue;
            if (!$keepOwner && $m['id'] == $ownerData['id']) continue;
            
            $isOwner = ($m['id'] == $ownerData['id']);
            $title = rc_tok('MSG_NEW_LEADER_TITLE');
            $body = $isOwner
                ? rc_tok('MSG_NEWLEADER_OWNER_BODY', $ownerData['username'], count($members), $newLeaderId)
                : rc_tok('MSG_NEWLEADER_MEMBER_BODY', $m['username'], $newLeaderId);
            $this->sendMessage($m['id'], 4, $title, $this->escape($body), 0,0,0,0,0,true);
        }

        if (!$keepOwner) {
            $this->evictUserFromAlliance($ownerData['id']);
            $msg = rc_tok('MSG_FORCED_LEAVE_BODY', $ownerData['username'], $newLeaderId);
            $this->sendMessage($ownerData['id'], 4, rc_tok('MSG_FORCED_LEAVE_TITLE'), $this->escape($msg), 0,0,0,0,0,true);
        }
        $this->deleteAlliance($ownerData['alliance']);
        return true;
    }


	function checkEmbassiesAfterBattle($vid, $current_level, $use_cache = true) {
        $userData = $this->getUserArray($this->getVillageField($vid, "owner"), 1);

        Automation::updateMax($this->getVillageField($vid,"owner"));
        $allianceStatus = $this->checkAllianceEmbassiesStatus([
            'id'       => $userData['id'],
            'alliance' => $userData["alliance"],
            'username' => $userData["username"],
            'lvl'      => $current_level
        ], false, $use_cache);

        if ($allianceStatus === false) return ' ' . rc_tok('MSG_ALLIANCE_DISPERSED_STATUS');
	    else if ($allianceStatus === 0) return ' ' . rc_tok('MSG_FORCED_LEAVE_STATUS');
	    else return ''; // all is good, no need to append additional alliance-related text 
    }

	function getAllMember($aid, $limit = 0, $use_cache = true) {
	    list($aid) = $this->escape_input((int) $aid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceMembersCache, $aid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid order  by (SELECT sum(pop) FROM " . TB_PREFIX . "vdata WHERE owner =  " . TB_PREFIX . "users.id) desc, " . TB_PREFIX . "users.id desc".($limit > 0 ? ' LIMIT '.(int) $limit : '');
		$result = mysqli_query($this->dblink,$q);

        self::$allianceMembersCache[$aid] = $this->mysqli_fetch_all($result);
        return self::$allianceMembersCache[$aid];
	}

	function getAllMember2($aid) {
	    return $this->getAllMember($aid, 1);
	}

	################# -START- ##################
	##   WORLD WONDER STATISTICS FUNCTIONS!   ##
	############################################

	/***************************
	Function to get user alliance name!
	Made by: Dzoki
	***************************/

    // no need to cache this method
	function getUserAllianceID($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT alliance FROM " . TB_PREFIX . "users where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['alliance'];
	}
}
