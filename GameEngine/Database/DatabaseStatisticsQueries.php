<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseStatisticsQueries.php                               ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Rankings, points, medals, statistics counters               ##
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

trait DatabaseStatisticsQueries {


	// no need to refactor this method
	function getProfileMedal($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id,categorie,plaats,week,img,points from " . TB_PREFIX . "medal where userid = $uid and del = 0 order by id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);

	}

    // no need to refactor this method
	function getProfileMedalAlly($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id,categorie,plaats,week,img,points from " . TB_PREFIX . "allimedal where allyid = $uid and del = 0 order by id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);

	}

	function modifyPoints($aid, $points, $amt) {
	    $aid = (int) $aid;

	    if (!is_array($points)) {
	        $points = [$points];
	        $amt    = [$amt];
        }

        $updates = [];
        foreach ($points as $index => $value) {
            $value = $this->escape($value);
	        $updates[] = $value.' = ' . $value . ' + ' . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "users SET ".implode(', ', $updates)." WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyPointsAlly($aid, $points, $amt) {
        $aid = (int) $aid;

        if (!is_array($points)) {
            $points = [$points];
            $amt    = [$amt];
        }

        $updates = [];
        foreach ($points as $index => $value) {
            $value = $this->escape($value);
            $updates[] = $value.' = ' . $value . ' + ' . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "alidata SET ".implode(', ', $updates)." WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

    function isThereAWinner(){
    	$q = "SELECT Count(*) as Total FROM ".TB_PREFIX."fdata WHERE f99 = 100 and f99t = 40";
    	$result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
    	return $result['Total'] > 0;
    }

    // no need to cache this method
	function getVRanking() {
	    $q = "SELECT v.wref,v.name,v.owner,v.pop FROM " . TB_PREFIX . "vdata AS v," . TB_PREFIX . "users AS u WHERE v.owner=u.id AND u.tribe IN(1,2,3".(SHOW_NATARS ? ',5' : '').") AND v.wref != '' AND u.access<" . (INCLUDE_ADMIN ? "10" : "8");
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getARanking($use_cache = true) {
        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceRankingCache, 0)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT id,name,tag,oldrank,Aap,Adp FROM " . TB_PREFIX . "alidata where id != '' ORDER BY id DESC";
		$result = mysqli_query($this->dblink,$q);

        self::$allianceRankingCache[0] = $this->mysqli_fetch_all($result);
        return self::$allianceRankingCache[0];
	}

    // no need to cache this method
	function getUserByTribe($tribe) {
	    list($tribe) = $this->escape_input((int) $tribe);
		$q = "SELECT * FROM " . TB_PREFIX . "users where tribe = $tribe";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getUserByAlliance($aid) {
	    list($aid) = $this->escape_input((int) $aid);
		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getHeroRanking() {
		$q = "SELECT * FROM " . TB_PREFIX . "hero WHERE dead = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	//medal functions
	function addclimberrankpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set clp = clp + $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function removeclimberrankpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set clp = clp - $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function setclimberrankpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set clp = $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function updateoldrank($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set oldrank = $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	// ALLIANCE MEDAL FUNCTIONS
	function addclimberrankpopAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set clp = clp + $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function removeclimberrankpopAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set clp = clp - $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function updateoldrankAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set oldrank = $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function countUser($use_cache = true) {
        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$usersCountCache, 0)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(id) FROM " . TB_PREFIX . "users where id > 5";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

        self::$usersCountCache[0] = $row[0];
        return self::$usersCountCache[0];
	}

	function countAlli($use_cache = true) {
        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceCountCache, 0)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(id) FROM " . TB_PREFIX . "alidata where id != 0";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

        self::$allianceCountCache[0] = $row[0];
        return self::$allianceCountCache[0];
	}

	/**
	 * @param int $uid
	 * @return int How many villages this user currently owns. Deliberately
	 *             uncached (always a fresh COUNT) since it's used right
	 *             after a village INSERT to decide a one-time milestone.
	 */
	function countVillages($uid) {
	    list($uid) = $this->escape_input((int) $uid);

	    $q = "SELECT COUNT(*) AS total FROM " . TB_PREFIX . "vdata WHERE owner = $uid";
	    $result = mysqli_query($this->dblink, $q);
	    $row = mysqli_fetch_assoc($result);

	    return $row ? (int) $row['total'] : 0;
	}
}
