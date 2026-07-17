<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseUserQueries.php                                     ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Accounts, login, profiles, gold, sitters, vacation mode,    ##
##                 friends                                                     ##
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

trait DatabaseUserQueries {


	function register($username, $password, $email, $tribe, $act, $uid = 0, $desc = null) {
    $username = trim($username);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL) ?: '';
    $tribe = (int)$tribe;
    $uid = (int)$uid;
    $desc = $desc ?? '';
    $time = time();
    $access = USER;
    
    $startTime = strtotime(START_DATE) - strtotime(date('d.m.Y')) + strtotime(START_TIME);
    $protectionTime = $uid != 3 ? (($startTime > $time) ? $startTime : $time) + PROTECTION : 0;

    // încercăm varianta cu is_bcrypt (PHP 8.3)
    $stmt = $this->dblink->prepare(
        "INSERT INTO `".TB_PREFIX."users` 
        (id, username, password, access, email, timestamp, tribe, act, protect, lastupdate, regtime, desc2, is_bcrypt) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"
    );
    $is_bcrypt = 1;
    $stmt->bind_param("issisiiiiiisi", $uid, $username, $password, $access, $email, $time, $tribe, $act, $protectionTime, $time, $time, $desc, $is_bcrypt);
    
    if($stmt->execute()){
        $id = $stmt->insert_id ?: $uid;
        $stmt->close();
		$this->grantRegistrationGold($id);
        return $id;
    }
    $stmt->close();

    // fallback pentru DB vechi fără coloana is_bcrypt
    $stmt2 = $this->dblink->prepare(
        "INSERT INTO `".TB_PREFIX."users` 
        (id, username, password, access, email, timestamp, tribe, act, protect, lastupdate, regtime, desc2) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"
    );
    $stmt2->bind_param("issisiiiiiis", $uid, $username, $password, $access, $email, $time, $tribe, $act, $protectionTime, $time, $time, $desc);
    
    if($stmt2->execute()){
        $id = $stmt2->insert_id ?: $uid;
        $stmt2->close();
		$this->grantRegistrationGold($id);
        return $id;
    }
    $stmt2->close();
    return false;
}
	/**
	 * Registration bonus gold (NEW_FUNCTION_REGISTRATION_GOLD).
	 * Grants a one-time gold bonus to a freshly created player account. Called
	 * from register() right after the users row is inserted, so it covers every
	 * registration path (email activation, instant registration, admin-created
	 * users). No-ops when disabled, amount <= 0, or system account (id <= 3).
	 */
	private function grantRegistrationGold($id) {
		$id = (int) $id;
		if ($id <= 3) {
			return; // system accounts: admin / nature / natars
		}
		if (!defined('NEW_FUNCTION_REGISTRATION_GOLD') || !NEW_FUNCTION_REGISTRATION_GOLD) {
			return;
		}
		$amount = defined('NEW_FUNCTION_REGISTRATION_GOLD_VALUE') ? (int) NEW_FUNCTION_REGISTRATION_GOLD_VALUE : 0;
		if ($amount <= 0) {
			return;
		}
		$this->modifyGold($id, $amount, 1); // mode 1 = add

		// Best-effort audit trail. The village does not exist yet, so wid = 0.
		if (defined('LOG_GOLD_FIN') && LOG_GOLD_FIN) {
			try {
				$now     = time();
				$details = 'Registration bonus';
				$stmt = $this->dblink->prepare(
					"INSERT INTO `".TB_PREFIX."gold_fin_log` (wid, uid, action, gold, time, details)
					 VALUES (0, ?, 'Registration bonus Gold', ?, ?, ?)"
				);
				if ($stmt) {
					$stmt->bind_param("iiis", $id, $amount, $now, $details);
					$stmt->execute();
					$stmt->close();
				}
			} catch (\Throwable $e) {
				// swallow: logging must never block account creation
			}
		}
	}

	function activate($username, $password, $email, $tribe, $locate, $act, $act2) {
    $username = trim($username);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL) ?: '';
    $tribe = (int)$tribe;
    $locate = (int)$locate;
    $time = time();
    $access = USER;

    $stmt = $this->dblink->prepare(
        "INSERT INTO `".TB_PREFIX."activate` 
        (username,password,access,email,tribe,timestamp,location,act,act2) 
        VALUES (?,?,?,?,?,?,?,?,?)"
    );
    $stmt->bind_param("ssisiiiss", $username, $password, $access, $email, $tribe, $time, $locate, $act, $act2);
    
    if($stmt->execute()){
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }
    $stmt->close();
    return false;
}

	function unreg($username) {
        list($username) = $this->escape_input($username);

		$q = "DELETE from " . TB_PREFIX . "activate where username = '$username'";
		return mysqli_query($this->dblink,$q);
	}

	/**
	 * IP ban lookup (issue #185).
	 * Returns the active ban row for the given packed binary IP, or false.
	 * Uses a prepared statement and tolerates the table not existing yet
	 * (older installs): in that case it simply reports "not banned".
	 *
	 * @param string $ipBinary Packed IP (inet_pton output), 4 or 16 bytes.
	 * @return array|false
	 */
	function ipBanActive($ipBinary) {
		if (!is_string($ipBinary) || $ipBinary === '') {
			return false;
		}
		try {
			$now  = time();
			$stmt = $this->dblink->prepare(
				"SELECT id, ip_text, reason, end FROM `".TB_PREFIX."banlist_ip`
				 WHERE ip = ? AND active = 1 AND (end IS NULL OR end = 0 OR end > ?) LIMIT 1"
			);
			if (!$stmt) {
				return false; // table missing / prepare failed (non-throwing mysqli)
			}
			$stmt->bind_param("si", $ipBinary, $now);
			$stmt->execute();
			$res = $stmt->get_result();
			$row = $res ? $res->fetch_assoc() : null;
			$stmt->close();
			return $row ?: false;
		} catch (\Throwable $e) {
			return false; // table missing (throwing mysqli) → treat as not banned
		}
	}

	// no need to cache this method
	public function hasBeginnerProtection($vid) {
	list($vid) = $this->escape_input($vid);
    	$q = "SELECT u.protect FROM ".TB_PREFIX."users u,".TB_PREFIX."vdata v WHERE u.id=v.owner AND v.wref=".(int) $vid." LIMIT 1";
	$result = mysqli_query($this->dblink,$q);
	$dbarray = mysqli_fetch_array($result);
	if(!empty($dbarray)) {
		if(time()<$dbarray[0]) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

	function updateUserField($ref, $field, $value, $switch) {
    list($ref) = $this->escape_input($ref);

    if (!is_array($field)) {
        $field = [$field];
        $value = [$value];
    }

    $pairs = [];
    foreach ($field as $i => $f) {
        $pairs[] = $this->escape($f) . ' = ' . (is_numeric($value[$i]) ? $value[$i] : "'".$this->escape($value[$i])."'");
    }

    $q = !$switch 
        ? "UPDATE ".TB_PREFIX."users SET ".implode(', ', $pairs)." WHERE username = '$ref'"
        : "UPDATE ".TB_PREFIX."users SET ".implode(', ', $pairs)." WHERE id = ".(int)$ref;

    $ret = mysqli_query($this->dblink, $q);

    // === FIX CACHE - ștergem tot ce ține de user ===
    $uid = $switch ? (int)$ref : (int)$this->getUserField($ref, 'id', 0, false);
    
    // 1. cache-ul de fields
    unset(self::$fieldsCache[$uid.'0'], self::$fieldsCache[$uid.'1']);
    unset(self::$fieldsCache[$ref.'0'], self::$fieldsCache[$ref.'1']);
    
    // 2. cache-ul de query-uri
    $this->clearQueryCache('userarray');
    $this->clearQueryCache('getUser');
    
    // 3. forțăm și sesiunea dacă e userul curent
    global $session;
    if (isset($session) && $session->uid == $uid && in_array('alliance', (array)$field)) {
        $idx = array_search('alliance', (array)$field);
        $session->alliance = $value[$idx];
        $session->userinfo['alliance'] = $value[$idx];
    }

    return $ret;
}

	// no need to cache this method
	function getSitee($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id from " . TB_PREFIX . "users where sit1 = $uid or sit2 = $uid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function removeMeSit($uid, $uid2) {
	    list($uid, $uid2) = $this->escape_input((int) $uid, (int) $uid2);

		$q = "UPDATE " . TB_PREFIX . "users set sit1 = 0 where id = $uid and sit1 = $uid2";
		mysqli_query($this->dblink,$q);
		$q2 = "UPDATE " . TB_PREFIX . "users set sit2 = 0 where id = $uid and sit2 = $uid2";
		mysqli_query($this->dblink,$q2);
	}

    function getUserField($ref, $field, $mode, $use_cache = true) {
        // update for Multihunter's username and ID
        if (($mode && $ref == '') || (!$mode && $ref == 0)) {
            $ref = 'Multihunter';
            $mode = 1;
        }

        // return all data, don't waste time by selecting fields one by one
        $userArray = $this->getUserArray($ref, ($mode ? 0 : 1), $use_cache);
        $result = (isset($userArray[$field]) ? $userArray[$field] : null);

        if ($result) {
            // will return the result
        } elseif($field=="username") {
            $result = "[?]";
        } else {
            $result = 0;
        }

        return $result;
    }

    function getUserFields($ref, $fields, $mode, $use_cache = true) {
        // update for Multihunter's username and ID
        if (($mode && $ref == '') || (!$mode && $ref == 0)) {
            $ref = 'Multihunter';
            $mode = 1;
        }

	    // return all data, don't waste time by selecting fields one by one
	    return $this->getUserArray($ref, ($mode ? 0 : 1), $use_cache);
    }

    // no need to cache this method
	function getInvitedUser($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "users where invited = $uid order by regtime desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getActivateField($ref, $field, $mode) {
        list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);

		if(!$mode) {
		    $q = "SELECT $field FROM " . TB_PREFIX . "activate where id = " . (int) $ref . " LIMIT 1";
		} else {
			$q = "SELECT $field FROM " . TB_PREFIX . "activate where username = '$ref' LIMIT 1";
		}
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function login($username, $password) {
        static $cachedResult = null;

        if ($cachedResult !== null) {
            return $cachedResult;
        }

        list($username, $password) = $this->escape_input($username, $password);
		$q = "SELECT id,password,sessid,is_bcrypt FROM " . TB_PREFIX . "users where username = '$username'";
		$result = mysqli_query($this->dblink,$q);

		// if we didn't update the database for bcrypt hashes yet...
		if (mysqli_error($this->dblink) != '') {
		    $q = "SELECT id, password,sessid,0 as is_bcrypt FROM " . TB_PREFIX . "users where username = '$username' LIMIT 1";
		    $result = mysqli_query($this->dblink,$q);
		    $bcrypt_update_done = false;
		} else {
		    $bcrypt_update_done = true;
		}

		$dbarray = mysqli_fetch_array($result);

		// even if we didn't do a DB conversion for bcrypt passwords,
		// we still need to check if this password wasn't encrypted via password_hash,
		// since all methods were updated to use that instead of md5 and therefore
		// new passwords in DB will be bcrypt already even without the is_bcrypt field present
		$bcrypted = true;
		$pwOk = password_verify($password, $dbarray['password']);

		if (!$pwOk && !$dbarray['is_bcrypt']) {
		    $pwOk = ($dbarray['password'] == md5($password));
		    $bcrypted = false;
		}

		if($pwOk) {
		    // update password to bcrypt, if correct
		    if (!$dbarray['is_bcrypt'] && !$bcrypted) {
		        mysqli_query($this->dblink, "UPDATE " . TB_PREFIX . "users SET password = '".password_hash($password, PASSWORD_BCRYPT,['cost' => 12])."'".($bcrypt_update_done ? ', is_bcrypt = 1' : '')." where id = ".(int) $dbarray['id']);
		    }
            $cachedResult = true;
		} else {
            $cachedResult = false;
		}

		return $cachedResult;
	}

	function sitterLogin($username, $password) {
        list($username, $password) = $this->escape_input($username, $password);

		$q = "SELECT sit1,sit2 FROM " . TB_PREFIX . "users where username = '$username' and access != " . BANNED ." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['sit1'] != 0) {
		    $q2 = "SELECT password FROM " . TB_PREFIX . "users where id = " . (int) $dbarray['sit1'] . " and access != " . BANNED . " LIMIT 1";
			$result2 = mysqli_query($this->dblink,$q2);
			$dbarray2 = mysqli_fetch_array($result2);
		}
		if($dbarray['sit2'] != 0) {
		    $q3 = "SELECT password FROM " . TB_PREFIX . "users where id = " . (int) $dbarray['sit2'] . " and access != " . BANNED . " LIMIT 1";
				$result3 = mysqli_query($this->dblink,$q3);
				$dbarray3 = mysqli_fetch_array($result3);
		}
		if($dbarray['sit1'] != 0 || $dbarray['sit2'] != 0) {
		    if(password_verify($password, $dbarray2['password']) || password_verify($password, $dbarray3['password'])) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function setDeleting($uid, $mode) {
	    list($uid, $mode) = $this->escape_input((int) $uid, $mode);

		$time = time() + 72 * 3600;
		if(!$mode) {
			$q = "INSERT into " . TB_PREFIX . "deleting values ($uid,$time)";
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "deleting where uid = $uid";
		}
		mysqli_query($this->dblink,$q);
	}

	function isDeleting($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT timestamp from " . TB_PREFIX . "deleting where uid = $uid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
        return isset($dbarray['timestamp']) ? (int)$dbarray['timestamp'] : 0;
	}

	function modifyGold($userid, $amt, $mode) {
	    list($userid, $amt, $mode) = $this->escape_input((int) $userid, (int) $amt, $mode);

	    if(!$mode) $q = "UPDATE " . TB_PREFIX . "users set gold = gold - $amt where id = $userid";		
		else $q = "UPDATE " . TB_PREFIX . "users set gold = gold + $amt where id = $userid";
		
		return mysqli_query($this->dblink,$q);
	}

	/**
	 * Retrieves the user array via Username or ID
	 * 
	 * @param int $ref The user ID or the username
	 * @param int $mode 0 --> Search by username, 1 --> Search by user ID	 
	 * @param bool $use_cache Will use the cache if true
	 * @return array Returns the user array
	 */

	function getUserArray($ref, $mode, $use_cache = true) {
        list($ref, $mode) = $this->escape_input($ref, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$fieldsCache, $ref.$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if(!$mode) $q = "SELECT * FROM " . TB_PREFIX . "users where username = '$ref' LIMIT 1";
		else $q = "SELECT * FROM " . TB_PREFIX . "users where id = " . (int) $ref . " LIMIT 1";
		
		$result = mysqli_query($this->dblink,$q);

        self::$fieldsCache[$ref.$mode] = mysqli_fetch_array($result);
        return self::$fieldsCache[$ref.$mode];
	}

	function activeModify($username, $mode) {
        list($username, $mode) = $this->escape_input($username, $mode);

		$time = time();
		if(!$mode) {
			$q = "INSERT into " . TB_PREFIX . "active VALUES ('$username',$time)";
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "active where username = '$username'";
		}
		return mysqli_query($this->dblink,$q);
	}

	function addActiveUser($username, $time) {
        list($username, $time) = $this->escape_input($username, $time);

		$q = "REPLACE into " . TB_PREFIX . "active values ('$username',$time)";
		if(mysqli_query($this->dblink,$q)) {
			return true;
		} else {
			return false;
		}
	}

	function updateActiveUser($username, $time) {
	    static $updated = false;

	    if ($updated) {
	        return;
        }

        list($username, $time) = $this->escape_input($username, $time);

        $res1 = $this->addActiveUser($username, $time);
        $q = "UPDATE " . TB_PREFIX . "users set timestamp = $time where username = '$username'";
		$res2 = mysqli_query($this->dblink,$q);
		if($res1 && $res2) {
            $updated = true;
			return true;
		} else {
			return false;
		}
	}

	function submitProfile($uid, $gender, $location, $birthday, $desc1, $desc2) {
    $uid = (int)$uid;
    $gender = (int)$gender;
    $location = mb_substr(trim($location), 0, 30, 'UTF-8');
    $birthday = trim($birthday);
    // Issue #250: cap profile descriptions (BBCode is rendered as HTML on
    // display) so a single field cannot store an oversized payload.
    $desc1 = mb_substr(trim($desc1), 0, 3000, 'UTF-8');
    $desc2 = mb_substr(trim($desc2), 0, 3000, 'UTF-8');

    $stmt = $this->dblink->prepare(
        "UPDATE `".TB_PREFIX."users` 
         SET gender = ?, location = ?, birthday = ?, desc1 = ?, desc2 = ?
         WHERE id = ? LIMIT 1"
    );
    $stmt->bind_param("issssi", $gender, $location, $birthday, $desc1, $desc2, $uid);
    $stmt->execute();
    $stmt->close();
    return true;
	}

	function gpack($uid, $gpack) {
	    list($uid, $gpack) = $this->escape_input((int) $uid, $gpack);

		$q = "UPDATE " . TB_PREFIX . "users set gpack = '$gpack' where id = $uid";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function GetOnline($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT sit FROM " . TB_PREFIX . "online WHERE uid = $uid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['sit'];
	}

	function UpdateOnline($mode, $name = "", $time = "", $uid = 0) {
	    list($mode, $name, $time, $uid) = $this->escape_input($mode, $name, $time, (int) $uid);

		global $session;
		if($mode == "login") {
			$q = "INSERT IGNORE INTO " . TB_PREFIX . "online (name, uid, time, sit) VALUES ('$name', $uid, '" . time() . "', 0)";
			return mysqli_query($this->dblink,$q);
		} else if($mode == "sitter") {
			$q = "INSERT IGNORE INTO " . TB_PREFIX . "online (name, uid, time, sit) VALUES ('$name', $uid, '" . time() . "', 1)";
			return mysqli_query($this->dblink,$q);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "online WHERE name ='" . $this->escape($session->username) . "'";
			return mysqli_query($this->dblink,$q);
		}
	}

    // no need to cache this method
	function getNeedDelete() {
		$time = time();
		$q = "SELECT uid FROM " . TB_PREFIX . "deleting where timestamp < $time";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getLinks($id) {
	    list($id) = $this->escape_input((int) $id);
		$q = 'SELECT * FROM `' . TB_PREFIX . 'links` WHERE `userid` = ' . $id . ' ORDER BY `pos` ASC';
		return mysqli_query($this->dblink,$q);
	}

	function removeLinks($id,$uid) {
	    list($id,$uid) = $this->escape_input((int) $id,(int) $uid);
		$q = "DELETE FROM " . TB_PREFIX . "links WHERE `id` = ".$id." and `userid` = ".$uid;
		return mysqli_query($this->dblink,$q);
	}

	function addPassword($uid, $npw, $cpw) {
	    list($uid, $npw, $cpw) = $this->escape_input((int) $uid, $npw, $cpw);
		$q = "REPLACE INTO `" . TB_PREFIX . "password`(uid, npw, cpw) VALUES ($uid, '$npw', '$cpw')";
		mysqli_query($this->dblink,$q);
	}

	function resetPassword($uid, $cpw) {
	    list($uid, $cpw) = $this->escape_input((int) $uid, $cpw);
		$q = "SELECT npw FROM `" . TB_PREFIX . "password` WHERE uid = $uid AND cpw = '$cpw' AND used = 0 LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

		if(!empty($dbarray)) {
		    if(!$this->updateUserField($uid, 'password', password_hash($dbarray['npw'], PASSWORD_BCRYPT,['cost' => 12]), 1)) return false;
			$q = "UPDATE `" . TB_PREFIX . "password` SET used = 1 WHERE uid = $uid AND cpw = '$cpw' AND used = 0";
			mysqli_query($this->dblink,$q);
			return true;
		}

		return false;
	}

	//end general statistics

	function addFriend($uid, $column, $friend) {
	    list($uid, $column, $friend) = $this->escape_input((int) $uid, $column, (int) $friend);

		$q = "UPDATE " . TB_PREFIX . "users SET $column = $friend WHERE id = $uid";
		return mysqli_query($this->dblink,$q);
	}

	function deleteFriend($uid, $column) {
	    list($uid, $column) = $this->escape_input((int) $uid, $column);

		$q = "UPDATE " . TB_PREFIX . "users SET $column = 0 WHERE id = $uid";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function checkFriends($uid) {
        list($uid) = $this->escape_input($uid);
        global $session;
        
		$user = $this->getUserArray($uid, 1);
		for($i = 0; $i <= 19; $i++){
			if($user['friend'.$i] == 0 && $user['friend'.$i.'wait'] == 0){
				for($j = $i + 1; $j <= 19; $j++){
					$k = $j - 1;
					if($user['friend'.$j] != 0){
						$friend = $this->getUserField($uid, "friend".$j, 0);
						$this->addFriend($uid, "friend".$k, $friend);
						$this->deleteFriend($uid, "friend".$j);
					}
					
					if($user['friend'.$j.'wait'] == 0){
						$friendwait = $this->getUserField($uid, "friend".$j."wait", 0);
						$this->addFriend($session->uid, "friend".$k."wait", $friendwait);
						$this->deleteFriend($uid, "friend".$j."wait");
					}
				}
			}
		}
	}

    /*****************************************
    Function to vacation mode - by advocaite
    References:
    *****************************************/

   function setvacmode($uid, $days) {
        // TODO: refactor vacation mode
        list ($uid, $days) = $this->escape_input((int) $uid, (int) $days);
        $days1 = 60 * 60 * 24 * $days;
        $time = time() + $days1;
        $q = "UPDATE " . TB_PREFIX . "users SET vac_mode = '1' , vac_time=" . $time . " WHERE id=" . $uid . "";
        $result = mysqli_query($this->dblink, $q);
		return;
    }

    function removevacationmode($uid){
        // TODO: refactor vacation mode
        list ($uid) = $this->escape_input((int) $uid);
        $q = "UPDATE " . TB_PREFIX . "users SET vac_mode = '0' , vac_time='0' WHERE id=" . $uid . "";
        $result = mysqli_query($this->dblink, $q);
		return;
    }

    function getvacmodexy($wref){
        // TODO: refactor vacation mode
        list ($wref) = $this->escape_input((int) $wref);
        $q = "SELECT id,oasistype,occupied FROM " . TB_PREFIX . "wdata where id = $wref";
        $result = mysqli_query($this->dblink, $q);
        $dbarray = mysqli_fetch_array($result);
        if ($dbarray['occupied'] != 0 && $dbarray['oasistype'] == 0) {
            $q1 = "SELECT owner FROM " . TB_PREFIX . "vdata where wref = " . (int) $dbarray['id'] . "";
            $result1 = mysqli_query($this->dblink, $q1);
            $dbarray1 = mysqli_fetch_array($result1);
            if ($dbarray1['owner'] != 0) {
                $q2 = "SELECT vac_mode,vac_time FROM " . TB_PREFIX . "users where id = " . (int) $dbarray1['owner'] . "";
                $result2 = mysqli_query($this->dblink, $q2);
                $dbarray2 = mysqli_fetch_array($result2);
                return $dbarray2['vac_mode'] == 1;
            }
        } 
        else 
		return 
	false;
    }
	
	/*****************************************
    Function to vacation mode
    Remake & Refactor: Shadow 
    *****************************************/
	
	function checkVacationRequirements(int $uid): array|bool{
    $uid  = (int)$uid;
    $now  = time();
    $errors = [];

    // HELPERS : returns true if it finds rows
    $exists = function(string $sql, array $params = []) {
        $stmt = mysqli_prepare($this->dblink, $sql);
        if ($params) {
            $types = str_repeat('i', count($params));
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $found = mysqli_stmt_num_rows($stmt) > 0;
        mysqli_stmt_close($stmt);
        return $found;
    };

    // HELPERS : returns a single field
    $fetchOne = function(string $sql, array $params = []) {
        $stmt = mysqli_prepare($this->dblink, $sql);
        if ($params) {
            $types = str_repeat('i', count($params));
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);
        return $row;
    };

    // 1. TROOPS MOVING
    $sql = "SELECT 1 FROM ".TB_PREFIX."movement m
            JOIN ".TB_PREFIX."vdata v ON v.wref = m.from
            WHERE v.owner=? AND m.proc=0 AND m.endtime>? AND m.sort_type=3 LIMIT 1";
    if ($exists($sql, [$uid, $now])) $errors[] = "TROOPS_MOVING";

    // 2. INCOMING TROOPS
    $sql = "SELECT 1 FROM ".TB_PREFIX."movement m
            JOIN ".TB_PREFIX."vdata v ON v.wref = m.to
            WHERE v.owner=? AND m.proc=0 AND m.endtime>? AND m.sort_type IN (3,4) LIMIT 1";
    if ($exists($sql, [$uid, $now])) $errors[] = "INCOMING_TROOPS";

    // 3. REINFORCEMENTS
    $sql = "SELECT 1 FROM ".TB_PREFIX."enforcement e
            WHERE (e.from IN (SELECT wref FROM ".TB_PREFIX."vdata WHERE owner=?)
               OR e.vref IN (SELECT wref FROM ".TB_PREFIX."vdata WHERE owner=?))
            AND (e.u1+e.u2+e.u3+e.u4+e.u5+e.u6+e.u7+e.u8+e.u9+e.u10+
                 e.u11+e.u12+e.u13+e.u14+e.u15+e.u16+e.u17+e.u18+e.u19+e.u20+
                 e.u21+e.u22+e.u23+e.u24+e.u25+e.u26+e.u27+e.u28+e.u29+e.u30+
                 e.u41+e.u42+e.u43+e.u44+e.u45+e.u46+e.u47+e.u48+e.u49+e.u50) > 0
            LIMIT 1";
    if ($exists($sql, [$uid, $uid])) $errors[] = "REINFORCEMENTS";

    // 4. WONDER WORLD
    $sql = "SELECT 1 FROM ".TB_PREFIX."fdata f
            JOIN ".TB_PREFIX."vdata v ON v.wref=f.vref
            WHERE v.owner=? AND f.f99t=40 LIMIT 1";
    if ($exists($sql, [$uid])) $errors[] = "WW";

    // 5. ARTEFACTS
    $sql = "SELECT 1 FROM ".TB_PREFIX."artefacts WHERE owner=? LIMIT 1";
    if ($exists($sql, [$uid])) $errors[] = "ARTEFACTS";

    // 6 + 10. PROTECTION + ADMIN or MULTIHUNTER
    $user = $fetchOne("SELECT protect, access FROM ".TB_PREFIX."users WHERE id=?", [$uid]);
    if ($user) {
        if ((int)$user['protect'] > $now) $errors[] = "PROTECTION";
        if (in_array((int)$user['access'], [8,9])) $errors[] = "NO_VACATION_ACCESS";
    }

    // 7. PRISONERS IN & OUT (Enemy troops trapped in your villages & Your troops trapped in enemy villages)
    $sqlIn = "SELECT 1 FROM ".TB_PREFIX."prisoners p
              JOIN ".TB_PREFIX."vdata v ON v.wref=p.wref
              WHERE v.owner=? LIMIT 1";
    if ($exists($sqlIn, [$uid])) $errors[] = "PRISONERS_IN";

    $sqlOut = "SELECT 1 FROM ".TB_PREFIX."prisoners p
               JOIN ".TB_PREFIX."vdata v ON v.wref=p.from
               WHERE v.owner=? LIMIT 1";
    if ($exists($sqlOut, [$uid])) $errors[] = "PRISONERS_OUT";

    // 8. MARKETPLACE MOVING
    $sql = "SELECT 1 FROM ".TB_PREFIX."movement m
            JOIN ".TB_PREFIX."vdata v ON v.wref=m.from
            WHERE v.owner=? AND m.proc=0 AND m.endtime>? AND m.sort_type=0 LIMIT 1";
    if ($exists($sql, [$uid, $now])) $errors[] = "MARKET";

    // 9. ACCOUNT DELETION
    $del = $fetchOne("SELECT timestamp FROM ".TB_PREFIX."deleting WHERE uid=?", [$uid]);
    if (!empty($del['timestamp']) && $del['timestamp'] > $now) {
        $errors[] = "ACCOUNT_DELETION";
    }
    return empty($errors) ? true : $errors;
	}
}
