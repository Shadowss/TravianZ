<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseForumQueries.php                                    ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Alliance forum: categories, topics, posts, polls            ##
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

trait DatabaseForumQueries {


	/**
	 * Get shared forums (and confederation forums), based on user ID and alliance ID
	 * 
	 * @param int $uid The user ID
	 * @param int $alliance The alliance ID
	 * @return array Returns all user's shared forums
	 */
	
	function getSharedForums($uid, $alliance){
		list($uid, $alliance) = $this->escape_input((int) $uid, (int) $alliance);
		
		$allianceForums = $confForums = $closedForums = [];
		
		$q = 	"SELECT * FROM 
					".TB_PREFIX."forum_cat 
				WHERE 
					display_to_alliances 
				LIKE
					'%,$alliance,%'
				OR
					display_to_alliances 
				LIKE
					'%,$alliance%'
				OR
					display_to_alliances 
				LIKE
					'%$alliance,%'
				OR
					display_to_alliances 
				=
					'$alliance'
				OR
					display_to_users
				LIKE 
					'%,$uid,%'
				OR
					display_to_users 
				LIKE 
					'%,$uid%'
				OR
					display_to_users 
				LIKE 
					'%$uid,%'
				OR
					display_to_users 
				= 
					'$uid'
				";
		$result = mysqli_query($this->dblink, $q);
		if(!empty($result)){
		    while($row = mysqli_fetch_assoc($result)) {
		        switch($row['forum_area']){
		            case 0: $allianceForums[] = $row; break;
		            case 2: $confForums[] = $row; break;
		            case 3: $closedForums[] = $row; break;
		        }
		    }
		}	

		//Get the alliance confederation forums
		if($alliance > 0){
			$confederations = $this->diplomacyExistingRelationships($alliance);
			if(!empty($confederations)){
				foreach($confederations as $confederation){
					if($confederation['type'] == 1){
						$confederationForums = $this->ForumCat($confederation['alli1'] == $alliance ? $confederation['alli2'] : $confederation['alli1'], 1);	
						if(!empty($confederationForums)){
							foreach($confederationForums as $forum){
								if($forum['forum_area'] == 2) $confForums[] = $forum;
							}
						}
					}
				}	
			}		
		}

		return ['alliance' => $allianceForums, 'confederation' => $confForums, 'closed' => $closedForums];
	}
	
	/**
	 * Get the total amount of the wanted forum, based on alliance and the forum area
	 * 
	 * @param int $forumArea The forum Area 0 = alliance, 1 = public, 2 = confederation, 3 = closed
	 * @param int $ally The alliance ID
	 * @return int Returns the total amount of the wanted forum
	 */
	
	function countForums($forumArea, $ally){
		list($forumArea, $ally) = $this->escape_input((int) $forumArea, (int) $ally);
		
		$q = "SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE ".($ally != -1 ? "alliance = $ally AND" : "")." forum_area = $forumArea";
		$result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC	);
		return $result['Total'];
	}
	
    // no need to refactor this method
	function CheckForum($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "forum_cat where alliance = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
		return $result['Total'] > 0; 
	}

    // no need to refactor this method
	function CountCat($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_topic where cat = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

    // no need to refactor this method
	function LastTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' order by post_date";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function CheckLastTopic($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$lastTopicCheckCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_topic where cat = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if($result['Total']) {
            self::$lastTopicCheckCache[$id] = true;
		} else {
            self::$lastTopicCheckCache[$id] = false;
		}

		return self::$lastTopicCheckCache[$id];
	}

	function CheckLastPost($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$lastPostForTopicCheckCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_post where topic = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if ($result['Total']) {
            self::$lastPostForTopicCheckCache[$id] = true;
		} else {
            self::$lastPostForTopicCheckCache[$id] = false;
		}

		return self::$lastPostForTopicCheckCache[$id];
	}

	function LastPost($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$lastPostForTopicCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);

        self::$lastPostForTopicCache[$id] = $this->mysqli_fetch_all($result);
        return self::$lastPostForTopicCache[$id];
	}

	function CountTopic($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$topicCountCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_post where owner = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

		$qs = "SELECT count(id) FROM " . TB_PREFIX . "forum_topic where owner = '$id'";
		$results = mysqli_query($this->dblink,$qs);
		$rows = mysqli_fetch_row($results);

        self::$topicCountCache[$id] = $row[0] + $rows[0];
        return self::$topicCountCache[$id];
	}

	// no need to cache this method
	function CountPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

    // no need to cache this method
	function ForumCat($id, $mode = 0) {
        list($id, $mode) = $this->escape_input($id, $mode);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where alliance = '$id' ".(!$mode ? "OR forum_area = 1" : "")." ORDER BY sorting DESC, id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ForumCatEdit($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where id = '$id'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ForumCatAlliance($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT alliance from " . TB_PREFIX . "forum_cat where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink, $q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['alliance'];
	}

    // no need to cache this method
	function ForumCatName($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT forum_name from " . TB_PREFIX . "forum_cat where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['forum_name'];
	}

    // no need to cache this method
	function CheckCatTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_topic where cat = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		return $result['Total'] > 0;
	}

    // no need to cache this method
	function CheckResultEdit($alli) {
        list($alli) = $this->escape_input($alli);

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_edit where alliance = $alli";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		return $result['Total'] > 0;
	}

    // no need to cache this method
	function CheckCloseTopic($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT close from " . TB_PREFIX . "forum_topic where id = '$id' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['close'];
	}

	function CheckEditRes($alli, $use_cache = true) {
        list($alli) = $this->escape_input($alli);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$editResultsCache, $alli)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT result from " . TB_PREFIX . "forum_edit where alliance = '$alli' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

        self::$editResultsCache[$alli] = $dbarray['result'];
        return self::$editResultsCache[$alli];
	}

	function CreatResultEdit($alli, $result) {
        list($alli, $result) = $this->escape_input($alli, $result);

		$q = "INSERT into " . TB_PREFIX . "forum_edit values (0,'$alli','$result')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	function UpdateResultEdit($alli, $result) {
        list($alli, $result) = $this->escape_input($alli, $result);

		$date = time();
		$q = "UPDATE " . TB_PREFIX . "forum_edit set result = '$result' where alliance = '$alli'";
		return mysqli_query($this->dblink,$q);
	}

	function MoveForum($id, $area, $ally, $mode){
		list($id, $area, $ally, $mode) = $this->escape_input((int) $id, (int) $area, (int) $ally, $mode);
		
		$q = "UPDATE
					".TB_PREFIX."forum_cat
		      SET
					sorting = (SELECT * FROM(SELECT ".(!$mode ? "MIN" : "MAX")."(sorting) FROM ".TB_PREFIX."forum_cat WHERE forum_area = $area ".($area != 1 ? "AND alliance = $ally" : "")." AND id != $id) f) ".(!$mode ? "-" : "+")." 1
		      WHERE
					id = $id";
		return mysqli_query($this->dblink, $q);
	}
	
	function UpdateEditTopic($id, $title, $cat) {
	    list($id, $title, $cat) = $this->escape_input((int) $id, $title, $cat);

		$q = "UPDATE " . TB_PREFIX . "forum_topic set title = '$title', cat = '$cat' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function UpdateEditForum($id, $name, $des, $alliances, $users) {
		list($id, $name, $des, $alliances, $users) = $this->escape_input((int) $id, $name, $des, $alliances, $users);

		$q = "UPDATE " . TB_PREFIX . "forum_cat SET forum_name = '$name', forum_des = '$des', display_to_alliances = '$alliances', display_to_users = '$users' WHERE id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function StickTopic($id, $mode) {
	    list($id, $mode) = $this->escape_input((int) $id, (int) $mode);

		$q = "UPDATE " . TB_PREFIX . "forum_topic SET stick = $mode WHERE id = $id";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function ForumCatTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' AND stick = '' ORDER BY post_date desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ForumCatTopicStick($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' AND stick = '1' ORDER BY post_date desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ShowTopic($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ShowPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id' ORDER BY id ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ShowPostEdit($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function CreatForum($owner, $alli, $name, $des, $area, $alliances, $users) {
		list($owner, $alli, $name, $des, $area, $alliances, $users) = $this->escape_input($owner, $alli, $name, $des, $area, $alliances, $users);

		$q = "INSERT into " . TB_PREFIX . "forum_cat values (0, 0,'$owner','$alli','$name','$des','$area','$alliances','$users')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

    function CreatTopic($title, $post, $cat, $owner, $alli, $ends) {
        list($title, $post, $cat, $owner, $alli, $ends) = $this->escape_input($title, $post, (int) $cat, (int) $owner, (int) $alli, (int) $ends);

        $date = time();
        $q = "INSERT into " . TB_PREFIX . "forum_topic values (0,'$title','$post',$date, $date, $cat, $owner, $alli, $ends, 0, 0)";
        mysqli_query($this->dblink,$q);
        return mysqli_insert_id($this->dblink);
    }

	/*************************
	        FORUM SUREY
	*************************/

  function createSurvey($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends) {
        list($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends) = $this->escape_input($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends);

        $q = "INSERT into " . TB_PREFIX . "forum_survey (topic,title,option1,option2,option3,option4,option5,option6,option7,option8,ends) values ('$topic','$title','$option1','$option2','$option3','$option4','$option5','$option6','$option7','$option8','$ends')";
        return mysqli_query($this->dblink,$q);
  }

    // no need to cache this method
  function getSurvey($topic) {
      list($topic) = $this->escape_input((int) $topic);

    $q = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic LIMIT 1";
    $result = mysqli_query($this->dblink,$q);
    return mysqli_fetch_array($result);
  }

    // no need to cache this method
  function checkSurvey($topic) {
      list($topic) = $this->escape_input((int) $topic);

      $q      = "SELECT Count(*) as Total FROM " . TB_PREFIX . "forum_survey where topic = $topic";
      $result = mysqli_fetch_array( mysqli_query( $this->dblink, $q ), MYSQLI_ASSOC );

      if ( $result['Total'] ) {
          return true;
      } else {
          return false;
      }
  }

  function Vote($topic, $num, $text) {
      list($topic, $num, $text) = $this->escape_input((int) $topic, (int) $num, $text);

      $q = "UPDATE " . TB_PREFIX . "forum_survey set vote".$num." = vote".$num." + 1, voted = '$text' where topic = ".$topic."";
      return mysqli_query($this->dblink,$q);
  }

  // no need to cache this method
  function checkVote($topic, $uid) {
      list( $topic, $uid ) = $this->escape_input( (int) $topic, $uid );

      $q      = "SELECT voted FROM " . TB_PREFIX . "forum_survey where topic = $topic LIMIT 1";
      $result = mysqli_query( $this->dblink, $q );
      $array  = mysqli_fetch_array( $result );
      $text   = $array['voted'];

      if ( preg_match( '/,' . $uid . ',/', $text ) ) {
          return true;
      } else {
          return false;
      }
  }

    // no need to cache this method
  function getVoteSum($topic) {
      list( $topic ) = $this->escape_input( (int) $topic );

      $q      = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic LIMIT 1";
      $result = mysqli_query( $this->dblink, $q );
      $array  = mysqli_fetch_array( $result );
      $sum    = 0;

      for ( $i = 1; $i <= 8; $i ++ ) {
          $sum += $array[ 'vote' . $i ];
      }

      return $sum;
  }


	/*************************
	        FORUM SUREY
	*************************/

    function CreatPost($post, $tids, $owner, $fid2 = 0) {
        global $message, $session;
        list($post, $tids, $owner, $fid2) = $this->escape_input($post, (int) $tids, $owner, (int) $fid2);

        $date = time();
        $q = "INSERT into " . TB_PREFIX . "forum_post values (0,'$post',$tids,'$owner','$date')";
        mysqli_query($this->dblink,$q);
        $postID = mysqli_insert_id($this->dblink);

        // create a message notification for each person subscribed to this topic
        // ... for now it's everyone who ever posted there, there is no real un/subscription yet
        if(NEW_FUNCTIONS_FORUM_POST_MESSAGE){
            if ($fid2 !== 0) {
                $q = "SELECT DISTINCT owner FROM ".TB_PREFIX . "forum_post WHERE topic = $tids";
                $result = mysqli_query($this->dblink, $q);
                if ($result->num_rows) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['owner'] != $owner) {
                            $this->sendMessage(
                                (int) $row['owner'],
                                4,
                                rc_tok('MSG_FORUM_NEW_TITLE'),
                                rc_tok(
                                    'MSG_FORUM_NEW_BODY',
                                    rtrim(SERVER, '/')."/spieler.php?uid=".(int) $session->uid,
                                    $this->escape($session->username),
                                    rtrim(SERVER, '/')."/allianz.php?s=2&amp;pid=2&amp;fid2=$fid2&amp;tid=$tids"
                                ),
                                0,
                                0,
                                0,
                                0,
                                0,
                                true);
                        }
                    }
                }
            }
        }
        return $postID;
    }

	function UpdatePostDate($id) {
	    list($id) = $this->escape_input((int) $id);

		$date = time();
		$q = "UPDATE " . TB_PREFIX . "forum_topic set post_date = '$date' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function EditUpdateTopic($id, $post) {
        list($id, $post) = $this->escape_input((int) $id, $post);

        $q = "UPDATE " . TB_PREFIX . "forum_topic set post = '$post' where id = $id";

        return mysqli_query($this->dblink, $q);
    }

    function EditUpdatePost($id, $post) {
        list($id, $post) = $this->escape_input((int) $id, $post);

       	$q = "UPDATE " . TB_PREFIX . "forum_post set post = '$post' where id = $id";
        return mysqli_query($this->dblink,$q);
    }

	function LockTopic($id, $mode) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

		$q = "UPDATE " . TB_PREFIX . "forum_topic set close = '$mode' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function DeleteCat($id) {
        list($id) = $this->escape_input($id);

        $qs = "DELETE from " . TB_PREFIX . "forum_cat where id = '$id'";
        $q = "DELETE from " . TB_PREFIX . "forum_topic where cat = '$id'";
        $q2="SELECT id from ".TB_PREFIX."forum_topic where cat ='$id'";
        $result = mysqli_query($this->dblink,$q2);
        if (!empty($result)) {
            $array=$this->mysqli_fetch_all($result);
            $toDelete = [];
            foreach($array as $ss) {
                $toDelete[] = $ss['id'];
            }
            $this->DeleteSurvey($toDelete);
        }
        mysqli_query($this->dblink,$qs);
        return mysqli_query($this->dblink,$q);
    }

	function DeleteSurvey($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $idValue) {
            $id[$index] = (int) $idValue;
        }

        $qs = "DELETE from " . TB_PREFIX . "forum_survey where topic IN(".implode(', ', $id).")";
        return mysqli_query($this->dblink,$qs);
    }

	function DeleteTopic($id) {
        list($id) = $this->escape_input($id);

		$qs = "DELETE from " . TB_PREFIX . "forum_topic where id = '$id'";
		return mysqli_query($this->dblink,$qs);
	}

	function DeletePost($id) {
        list($id) = $this->escape_input($id);

		$q = "DELETE from " . TB_PREFIX . "forum_post where id = '$id'";
		return mysqli_query($this->dblink,$q);
	}

	function setAlliForumdblink($aid, $dblink) {
	    list($aid, $dblink) = $this->escape_input((int) $aid, $dblink);

		$q = "UPDATE " . TB_PREFIX . "alidata SET `forumlink` = '$dblink' WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}
}
