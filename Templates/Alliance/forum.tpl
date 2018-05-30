<?php
// ###########################################################
// # DO NOT REMOVE THIS NOTICE ##
// # MADE BY TTMTT ##
// # FIX BY RONIX ##
// # TRAVIANZ ##
// ###########################################################
//TODO: Rework the whole code of this section...
if(!isset($aid)){
	if(isset($_GET['fid']) && !empty($_GET['fid'])) $aid = $database->ForumCatAlliance($_GET['fid']);
	else if(isset($_GET['fid2']) && !empty($_GET['fid2'])) $aid = $database->ForumCatAlliance($_GET['fid2']);
	else $aid = $session->alliance;
}

$allianceinfo = $database->getAlliance($aid);
$opt = $database->getAlliPermissions($session->uid, $aid);
echo $aid > 0 ? "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>" : "<h1>Forum</h1>";
include ("alli_menu.tpl");
$ids = $_GET['s'];

if(isset($_POST['new']) && 
   isset($_POST['u1']) && !empty($_POST['u1']) &&
   isset($_POST['u2']) && !empty($_POST['u2']) &&
   isset($_POST['bid']) && $_POST['bid'] >= 0 && $_POST['bid'] <= 3 &&
   ($session->access == 9 || ($session->alliance > 0 && $opt['opt5'] == 1)))
{
	//Initialization
	$forumViewable['alliances'] = $forumViewable['users'] = "";
	
	//Check if the user is the ADMIN (Multihunter account) or not, if not, it will not be able to create public forum
	//ADMIN can only creates public forums
	if($session->access != ADMIN && $_POST['bid'] == 1) $_POST['bid'] = 0;
	elseif($session->access == ADMIN && $_POST['bid'] != 1) $_POST['bid'] = 1;

	//Ignore it if the forum is public
	if($_POST['bid'] != 1) {
		$forumViewable = $alliance->createForumVisiblity($_POST['allys_by_id'], $_POST['allys_by_name'], $_POST['users_by_id'], $_POST['users_by_name']);
	}
	
	$forum_name = $_POST['u1'];
	$forum_des = $_POST['u2'];
	$forum_owner = $session->uid;
	$forum_area = $_POST['bid'];
	$database->CreatForum($forum_owner, $session->access == ADMIN ? 0 : $session->alliance, $forum_name, $forum_des, $forum_area, $forumViewable['alliances'], $forumViewable['users']);
}

if(isset($_POST['edittopic']) && 
   isset($_POST['fid']) && !empty($_POST['fid']) &&
   isset($_POST['tid']) && !empty($_POST['tid']) &&
   isset($_POST['thema']) && !empty($_POST['thema']) &&
   Alliance::canAct(['aid' => $aid, 'alliance' => ($topic = reset($database->ShowTopic($_POST['tid'])))['alliance'], 
		'forum_perm' => $opt['opt5'], 'admin' => $_GET['admin'], 'owner' => $topic['owner'],
   		'forum_owner' => ($forumData = reset($database->ForumCatEdit($_POST['fid'])))['owner']], 1) &&
   (($forumData['forum_area'] != 1 && reset($database->ForumCatEdit($topic['cat']))['forum_area'] != 1 && $forumData['alliance'] == $session->alliance) ||
   		$forumData['id'] == $topic['cat'] || ($session->access == ADMIN && $forumData['alliance'] = 0)))
{
	$topic_name = $_POST['thema'];
	$topic_cat = $_POST['fid'];
	$topic_id = $_POST['tid'];
	$database->UpdateEditTopic($topic_id, $topic_name, $topic_cat);
}

if(isset($_POST['editforum']) &&
   isset($_POST['fid']) && !empty($_POST['fid']) &&
   isset($_POST['u1']) && !empty($_POST['u1']) &&
   isset($_POST['u2']) && !empty($_POST['u2']) &&
   (($database->ForumCatAlliance($_POST['fid']) == $session->alliance && $opt['opt5'] == 1) || $session->access == ADMIN))
{
	$forumViewable['alliances'] = $forumViewable['users'] = "";
	
	//Ignore it if the forum is public
	if($forumData['forum_area'] != 1) {
		$forumViewable = $alliance->createForumVisiblity($_POST['allys_by_id'], $_POST['allys_by_name'], $_POST['users_by_id'], $_POST['users_by_name']);
	}
	
	$forum_name = $_POST['u1'];
	$forum_name = htmlspecialchars($forum_name);
	$forum_des = $_POST['u2'];
	$forum_des = htmlspecialchars($forum_des);
	$forum_id = $_POST['fid'];
	$database->UpdateEditForum($forum_id, $forum_name, $forum_des, $forumViewable['alliances'], $forumViewable['users']);
}

if(isset($_POST['newtopic']) && isset($_POST['thema']) && isset($_POST['text']) && isset($_POST['fid'])
   && !empty($_POST['thema']) && !empty($_POST['text']) && !empty($_POST['fid']) &&
   ((($forumData = reset($database->ForumCatEdit($_POST['fid'])))['alliance'] == $session->alliance || 
   $forumData['forum_area'] == 1 || $alliance->isForumAccessible($_POST['fid'])) && 
   ($forumData['forum_area'] != 3 || ($forumData['forum_area'] == 3 && $opt['opt5'] == 1))))
{
	$title = $_POST['thema'];
	$text = $_POST['text'];
	$cat = $_POST['fid'];
	$owner = $session->uid;
	$alli = $database->ForumCatAlliance($cat);
	
	if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
		$text = "[message]".$text."[/message]";
		
		$survey = false;
		$ends = '';
		if(isset($_POST['umfrage'])){
			if(isset($_POST['umfrage_ende'])){
				$ends_date = $_POST['month']."/".$_POST['day']."/".$_POST['year'];
				if($_POST['meridiem'] == 1) $_POST['hour'] += 12;
				$ends_time = $_POST['hour'].":".$_POST['minute'];
				$ends = strtotime($ends_date) - strtotime(date('d.m.y')) + strtotime($ends_time);
			}
			
			for($i = 1; $i <= 8; $i++) if(isset($_POST['option_'.$i]) && !empty($_POST['option_'.$i])) $survey = true;
		}
		$topic_id = $database->CreatTopic($title, $text, $cat, $owner, $alli, $ends);
		if($survey){
			$database->createSurvey($topic_id, $_POST['umfrage_thema'], $_POST['option_1'], $_POST['option_2'], $_POST['option_3'], $_POST['option_4'], $_POST['option_5'], $_POST['option_6'], $_POST['option_7'], $_POST['option_8'], $ends);
		}
	}
}

if(isset($_POST['newpost']) && isset($_POST['text']) && !empty($_POST['text']) &&
   isset($_POST['tid']) && !empty($_POST['tid']) &&
   isset($_POST['fid2']) && !empty($_POST['fid2']) &&
   ((($forumData = reset($database->ForumCatEdit($_POST['fid2'])))['alliance'] == $session->alliance || 
   $forumData['forum_area'] == 1 || $alliance->isForumAccessible($_POST['fid2'])) &&
   (($forumData['forum_area'] != 3 && !reset($database->ShowTopic($_POST['tid']))['close'])
   || ($forumData['forum_area'] == 3 && $opt['opt5'] == 1))))
{
   	$text = $_POST['text'];
	$tids = $_POST['tid'];
	$fid2 = $_POST['fid2'];
	$owner = $session->uid;
	if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
		$text = "[message]".$text."[/message]";
		
		$database->UpdatePostDate($tids);
		$database->CreatPost($text, $tids, $owner, $fid2);
	}
}

if(isset($_POST['editans']) && isset($_POST['text']) && !empty($_POST['text'])
   && isset($_POST['tid']) && !empty($_POST['tid']) &&
   Alliance::canAct(['aid' => $aid, 'alliance' => ($topic = reset($database->ShowTopic($_POST['tid'])))['alliance'],
		'forum_perm' => $opt['opt5'], 'admin' => $_GET['admin'], 'owner' => $topic['owner'],
		'forum_owner' => reset($database->ForumCatEdit($topic['cat']))['owner']], 1))
{
   	$text = $_POST['text'];
	$topic_id = $_POST['tid'];
	
	if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
		$text = "[message]" . $text . "[/message]";
		$database->EditUpdateTopic($topic_id, $text);
	}
   	
}

if(isset($_POST['editpost']) && isset($_POST['text']) && !empty($_POST['text']) &&
		isset($_POST['pod']) && !empty($_POST['pod']) &&
		Alliance::canAct(['aid' => $aid, 
				'alliance' => ($topic = reset($database->ShowTopic(($post = reset($database->ShowPostEdit($_POST['pod'])))['topic'])))['alliance'], 
				'forum_perm' => $opt['opt5'], 'owner' => $post['owner'], 'admin' => $_GET['admin'],
				'forum_owner' => ($forumData = reset($database->ForumCatEdit($topic['cat'])))['owner']], 1))
{
	
	$text = $_POST['text'];
	$posts_id = $_POST['pod'];
	
	$text = preg_replace('/\[message\]/', '', $text);
	$text = preg_replace('/\[\/message\]/', '', $text);
	
	$database->EditUpdatePost($posts_id, $text);
}

if(!isset($_GET['admin'])) $_GET['admin'] = null;
if($_GET['admin'] == "switch_admin"){
	if($opt['opt5'] == 1){
		if($database->CheckResultEdit($aid) != 1) $database->CreatResultEdit($aid, 1);		
		/*else
		{
			if($database->CheckEditRes($aid) == 1) $database->UpdateResultEdit($aid, 0);
			else $database->UpdateResultEdit($aid, 1);
		}*/
	}
}

if($_GET['admin'] == "pos" && isset($_GET['res']) && isset($_GET['fid']) && !empty($_GET['fid']) &&
  (($database->ForumCatAlliance($_GET['fid']) == $session->alliance && $opt['opt5'] == 1) ||
  ($forumData = reset($database->ForumCatEdit($_GET['fid'])))['owner'] == $session->uid && $session->access == ADMIN))
{
	$database->moveForum($_GET['fid'], $forumData['forum_area'], $session->alliance, $_GET['res']); //Move the forum to the top/bottom of the list
	$alliance->redirect($_GET);
}
elseif(isset($_GET['idt']) && !empty($_GET['idt'])){
	
	//Get the post informations
	$topicID = $_GET['idt'];
	$post = reset($database->ShowTopic($topicID));
	$checkArray = ['aid' => $aid, 'alliance' => $post['alliance'], 'forum_perm' => $opt['opt5'], 'admin' => $_GET['admin'], 
			'owner' => $post['owner'], 'forum_owner' => reset($database->ForumCatEdit($post['cat']))['owner']];

	//Exit if we've the rights to modify it
	if(!Alliance::canAct($checkArray, 1)) $alliance->redirect($_GET);
	
	//We've the rights to modify it, check what we have to modify
	switch($_GET['admin']){
		case "pin":
			$database->StickTopic($topicID, 1); //Stick topic
			break;
			
		case "unpin":
			$database->StickTopic($topicID, 0); //Unstick topic
			break;
			
		case "lock":
			$database->LockTopic($topicID, 1); //Lock a topic
			break;
			
		case "unlock":
			$database->LockTopic($topicID, 0); //Unlock a topic
			break;
			
		case "deltopic":
			$database->DeleteTopic($topicID); //Delete topic
			$database->DeleteSurvey($topicID); //Delete survey
			break;
			
		case "edittopic":
			include("Forum/forum_3.tpl"); //Edit topic
			break;
			
		case "editans":
			include("Forum/forum_9.tpl");
			break;
	}

	if($_GET['admin'] != "edittopic" && $_GET['admin'] != "editans") $alliance->redirect($_GET);
}
elseif($_GET['admin'] == "delforum" && isset($_GET['idf']) && !empty($_GET['idf']) &&
	  ((($database->ForumCatAlliance($_GET['idf']) == $session->alliance && $opt['opt5'] == 1) ||
	  ($forumData = reset($database->ForumCatEdit($_GET['idf'])))['owner'] == $session->uid) ||
	  ($forumData['alliance'] == 0 && $session->access == ADMIN)))
{
	$database->DeleteCat($_GET['idf']); // delete forum
	$alliance->redirect($_GET);
}
elseif($_GET['admin'] == "delpost" && isset($_GET['pod']) && !empty($_GET['pod']) &&
		isset($_GET['tid']) && !empty($_GET['tid']) &&
		isset($_GET['fid2']) && !empty($_GET['fid2']) &&
		Alliance::canAct(['aid' => $aid, 'alliance' => reset($database->ShowTopic($_GET['tid']))['alliance'], 'forum_perm' => $opt['opt5'],
				'owner' => reset($database->ShowPostEdit($_GET['pod']))['owner'], 'admin' => $_GET['admin'],
				'forum_owner' => reset($database->ForumCatEdit($_GET['fid2']))['owner']], 1))
{
	$database->DeletePost($_GET['pod']); //Delete post
	header("Location: allianz.php?s=2&fid2=".$_GET['fid2']."&tid=".$_GET['tid']);
	exit;
}
elseif($_GET['admin'] == "newforum") include("Forum/forum_1.tpl"); //New forum
elseif($_GET['admin'] == "editpost" && isset($_GET['pod']) && !empty($_GET['pod']) &&
		isset($_GET['tid']) && !empty($_GET['tid']) &&
		isset($_GET['fid']) && !empty($_GET['fid']) &&
		Alliance::canAct(['aid' => $aid, 'alliance' => reset($database->ShowTopic($_GET['tid']))['alliance'], 'forum_perm' => $opt['opt5'],
				'owner' => reset($database->ShowPostEdit($_GET['pod']))['owner'], 'admin' => $_GET['admin'],
				'forum_owner' => reset($database->ForumCatEdit($_GET['fid']))['owner']], 1)) //Edit post
{
	include("Forum/forum_10.tpl");
}
elseif(isset($_GET['fid'])){
	if(isset($_GET['ac'])) include("Forum/forum_5.tpl"); //New topic	
	else include("Forum/forum_4.tpl"); //Show topics
}
elseif($_GET['admin'] == "editforum") include("Forum/forum_8.tpl"); //Edit forum	
elseif(isset($_GET['tid'])){
	if(isset($_GET['ac'])) include ("Forum/forum_7.tpl"); //New post
	else include ("Forum/forum_6.tpl"); //Show topic
}
else include("Forum/forum_2.tpl");
?>