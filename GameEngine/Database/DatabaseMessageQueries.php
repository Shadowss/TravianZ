<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseMessageQueries.php                                  ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Messages (mdata) and reports/notifications (ndata)          ##
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

trait DatabaseMessageQueries {


    // no need to cache this method
    function getUnreadMessagesCount($uid) {
        $uid = (int) $uid;

        $ids = [$uid];

        if (($this->getUserField($uid, 'access', 0) == ADMIN) && ADMIN_RECEIVE_SUPPORT_MESSAGES) {
            $ids[] = 1;
        }

        if ($this->getUserField($uid, 'access', 0) == MULTIHUNTER) {
            $ids[] = 5;
        }

        $q = 'SELECT Count(*) as numUnread FROM '.TB_PREFIX.'mdata WHERE target IN('.implode(', ', $ids).') AND viewed = 0';
        return mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC)['numUnread'];
    }

    // no need to cache this method
    function getUnreadNoticesCount($uid) {
        $uid = (int) $uid;

        return mysqli_fetch_array(mysqli_query($this->dblink, '
            SELECT Count(*) as numUnread FROM '.TB_PREFIX.'ndata WHERE uid = '.$uid.' AND viewed = 0'
        ), MYSQLI_ASSOC)['numUnread'];
    }

    function sendMessage($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report, $skip_escaping = false) {
        if (!$skip_escaping) {
           list($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report) = $this->escape_input((int) $client, (int) $owner, $topic, $message, (int) $send, (int) $alliance, (int) $player, (int) $coor, (int) $report);
        }

        $time = time();

        // add this message to the query cache, so we save some queries
        // if we need to send multiple messages at once
        self::$sendMessageQueryCache[] = "(0,$client,$owner,'$topic','$message',0,0,$send,$time,0,0,$alliance,$player,$coor,$report)";

        // check if we don't have too many messages to be sent out cached,
        // in which case we'll flush the cache and start again
        $retValue = true;
        if (count(self::$sendMessageQueryCache) >= self::$sendMessageQueryCacheMaxRecords) {
            $retValue = mysqli_query($this->dblink, "INSERT INTO " . TB_PREFIX . "mdata VALUES " . implode(', ', self::$sendMessageQueryCache));
            self::$sendMessageQueryCache = [];
        }

        return $retValue;
    }

    public function sendPendingMessages() {
        if (count(self::$sendMessageQueryCache)) {
            mysqli_query($this->dblink, "INSERT INTO " . TB_PREFIX . "mdata VALUES " . implode(', ', self::$sendMessageQueryCache));
        }
    }

    function setArchived($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

        $q = "UPDATE " . TB_PREFIX . "mdata set archived = 1 where id IN(".implode(', ', $id).")";
        return mysqli_query($this->dblink,$q);
    }

    function setNorm($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

        $q = "UPDATE " . TB_PREFIX . "mdata set archived = 0 where id IN(".implode(',', $id).")";
        return mysqli_query($this->dblink,$q);
    }

/***************************
Function to get messages
Mode 1: Get inbox
Mode 2: Get sent
Mode 3: Get message
Mode 4: Set viewed
Mode 5: Remove message
Mode 6: Retrieve archive
References: User ID/Message ID, Mode
***************************/
    // no need to cache this method
	function getMessage($id, $mode) {
	    global $session;

	    $mode = (int) $mode;
	    $mode_updated = false;
	    // update $id if we should show Support messages for Admins and we are an admin
	    if (
	       $session->access == ADMIN
	       && ADMIN_RECEIVE_SUPPORT_MESSAGES
	       && in_array($mode, [1,2,6,9,10,11])
	    ) {
	        $id = $id . ', 1';
            $mode_updated = true;
	    }

        // update $id if we should show Multihunter messages for the current player
        if (
            $session->access == MULTIHUNTER
            && in_array($mode, [1,2,6,9,10,11])
        ) {
            $id = $id . ', 5';
            $mode_updated = true;
        }

        if (in_array($mode, [5,7,8])) {
            if (!is_array($id)) {
                $id = [$id];

                foreach ($id as $index => $idValue) {
                    $id[$index] = (int) $idValue;
                }
            }
        } else {
	        if (!$mode_updated) {
                $id = (int) $id;
            }
        }

		switch($mode) {
			case 1:
				$q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target IN($id) and send = 0 and archived = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 2:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner IN($id) ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 3:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata where id = $id";
				break;
			case 4:
			    $show_target = $session->uid;
			    if ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES) $show_target .= ',1';
                if ($session->access == MULTIHUNTER) $show_target .= ',5';

			    $q = "UPDATE " . TB_PREFIX . "mdata set viewed = 1 where id = $id AND target IN(".$show_target.")";
				break;
			case 5:
				$q = "UPDATE " . TB_PREFIX . "mdata set deltarget = 1, viewed = 1 where id IN(".implode(', ', $id).")";
				break;
			case 6:
				$q = "SELECT * FROM " . TB_PREFIX . "mdata where target IN($id) and send = 0 and archived = 1 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 7:
				$q = "UPDATE " . TB_PREFIX . "mdata set delowner = 1 where id IN(".implode(', ', $id).")";
				break;
			case 8:
				$q = "UPDATE " . TB_PREFIX . "mdata set deltarget = 1, delowner = 1, viewed = 1 where id IN(".implode(', ', $id).")";
				break;
			case 9:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target IN($id) and send = 0 and archived = 0 and deltarget = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 10:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner IN($id) and delowner = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 11:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata where target IN($id) and send = 0 and archived = 1 and deltarget = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
		}

		if($mode <= 3 || $mode == 6 || $mode > 8) {
			$result = mysqli_query($this->dblink,$q);
			return $this->mysqli_fetch_all($result);
		}
		else return mysqli_query($this->dblink,$q);
	}

	function unarchiveNotice($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

		$q = "UPDATE " . TB_PREFIX . "ndata set ntype = archive, archive = 0 where id IN(".implode(',', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function archiveNotice($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

		$q = "update " . TB_PREFIX . "ndata set archive = ntype, ntype = 9 where id IN(".implode(',', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function removeNotice($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

		$q = "UPDATE " . TB_PREFIX . "ndata set del = 1,viewed = 1 where id IN(".implode(',', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function noticeViewed($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "ndata set viewed = 1 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function addNotice($uid, $toWref, $ally, $type, $topic, $data, $time = 0) {
    list($uid, $toWref, $ally, $type, $topic, $data, $time) = $this->escape_input((int) $uid, (int) $toWref, (int) $ally, (int) $type, $topic, $data, (int) $time);
        
        //We don't need to send reports to Nature or Natars
        if($uid == 2 || $uid == 3) return;
        if($time == 0) $time = time();
    	
    	$q = "INSERT INTO " . TB_PREFIX . "ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'$uid','$toWref','$ally','$topic',$type,'$data',$time,0)";
    	return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
	function getNotice($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid and del = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getNotice2($id, $field = null, $use_cache = true) {
        list($id, $field) = $this->escape_input((int) $id, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$noticesCacheById, $id)) && !is_null($cachedValue)) {
            return $cachedValue[$field];
        }

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where `id` = $id ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC')." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

        self::$noticesCacheById[$id] = $dbarray;
        return is_null($field) ? self::$noticesCacheById[$id] : self::$noticesCacheById[$id][$field];
	}

	function getUnViewNotice($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid AND viewed=0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	/**
	 * UM-W1: numarul de mesaje trimise de $uid in ultimele $seconds secunde.
	 * Muta flood-check-ul inline din Message::sendMessage()/sendAMessage().
	 */
	function countRecentMessages($uid, $seconds = 60) {
	    list($uid, $seconds) = $this->escape_input((int) $uid, (int) $seconds);

		$q = "SELECT COUNT(*) AS Total FROM " . TB_PREFIX . "mdata WHERE owner = $uid AND time > " . (time() - $seconds);
		$row = mysqli_fetch_assoc(mysqli_query($this->dblink, $q));
		return (int) ($row['Total'] ?? 0);
	}

	/**
	 * UM-W1: id-urile membrilor unei aliante. Muta query-ul inline din
	 * Message::sendAMessage().
	 */
	function getAllianceMemberIds($alliance) {
	    list($alliance) = $this->escape_input((int) $alliance);

		$q = "SELECT id FROM " . TB_PREFIX . "users WHERE alliance = $alliance";
		$result = mysqli_query($this->dblink, $q);
		$ids = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$ids[] = $row['id'];
		}
		return $ids;
	}

	/**
	 * UM-W1: permisiunea de mesaj-catre-alianta (opt7) a unui membru. Muta
	 * query-ul inline din Message::sendAMessage(). Returneaza direct valoarea
	 * opt7 (0 sau 1), deci in Message.php comparatia devine "$permission == 1"
	 * in loc de vechiul "$permission['opt7'] == 1" - aceeasi verificare.
	 * Filtreaza pe uid SI alliance (+ LIMIT 1) ca sa nu ia un rand ramas dintr-o
	 * alianta anterioara.
	 */
	function getAllyMessagePermission($uid, $alliance = 0) {
	    list($uid, $alliance) = $this->escape_input((int) $uid, (int) $alliance);

		$q = "SELECT opt7 FROM " . TB_PREFIX . "ali_permission WHERE uid = $uid";
		if ($alliance > 0) {
			$q .= " AND alliance = $alliance";
		}
		$q .= " LIMIT 1";

		$row = mysqli_fetch_assoc(mysqli_query($this->dblink, $q));
		return (int) ($row['opt7'] ?? 0);
	}

	/**
	 * UM-W1: target + owner ale unui mesaj (pentru a decide modul de stergere).
	 * Muta SELECT-ul inline din Message::removeMessage().
	 */
	function getMessageOwnership($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT target, owner FROM " . TB_PREFIX . "mdata WHERE id = $id LIMIT 1";
		$row = mysqli_fetch_assoc(mysqli_query($this->dblink, $q));
		return $row ?: ['target' => 0, 'owner' => 0];
	}
}
