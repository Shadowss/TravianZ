<?php
// ###########################################################
// # DO NOT REMOVE THIS NOTICE ##
// # MADE BY TTMTT ##
// # FIX BY RONIX ##
// # TRAVIANZ ##
// ###########################################################

if(!isset($aid)){
	if(isset($_GET['fid']) && !empty($_GET['fid'])) $aid = $database->ForumCatAlliance($_GET['fid']);
	else if(isset($_GET['fid2']) && !empty($_GET['fid2'])) $aid = $database->ForumCatAlliance($_GET['fid2']);
	else $aid = $session->alliance;
}

$allianceinfo = $database->getAlliance($aid);
$opt = $database->getAlliPermissions($session->uid, $aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include ("alli_menu.tpl");
$ids = $_GET['s'];

if(isset($_POST['new']) && $opt['opt5'] == 1 && 
   isset($_POST['u1']) && !empty($_POST['u1']) &&
   isset($_POST['u2']) && !empty($_POST['u2']) &&
   isset($_POST['bid']) && $_POST['bid'] >= 0 && $_POST['bid'] <= 3)
{
	$forum_name = $_POST['u1'];
	$forum_des = $_POST['u2'];
	$forum_owner = $session->uid;
	$forum_area = $_POST['bid'];
	$database->CreatForum($forum_owner, $aid, $forum_name, $forum_des, $forum_area);
}

if(isset($_POST['edittopic']) && $opt['opt5'] == 1 && 
   isset($_POST['fid']) && !empty($_POST['fid']) &&
   isset($_POST['tid']) && !empty($_POST['tid']) &&
   isset($_POST['thema']) && !empty($_POST['thema']) &&
   $database->ForumCatAlliance($_POST['fid']) == $session->alliance)
{
	$topic_name = $_POST['thema'];
	$topic_cat = $_POST['fid'];
	$topic_id = $_POST['tid'];
	$database->UpdateEditTopic($topic_id, $topic_name, $topic_cat);
}

if(isset($_POST['editforum']) && $opt['opt5'] == 1 &&
   isset($_POST['fid']) && !empty($_POST['fid']) &&
   isset($_POST['u1']) && !empty($_POST['u1']) &&
   isset($_POST['u2']) && !empty($_POST['u2']) &&
   $database->ForumCatAlliance($_POST['fid']) == $session->alliance)
{
	$forum_name = $_POST['u1'];
	$forum_name = htmlspecialchars($forum_name);
	$forum_des = $_POST['u2'];
	$forum_des = htmlspecialchars($forum_des);
	$forum_id = $_POST['fid'];
	$database->UpdateEditForum($forum_id, $forum_name, $forum_des, $session->alliance);
}

if(isset($_POST['newtopic']) && isset($_POST['thema']) && isset($_POST['text']) && isset($_POST['fid'])
		&& !empty($_POST['thema']) && !empty($_POST['text']) && !empty($_POST['fid'])){
	$title = $_POST['thema'];
	$text = $_POST['text'];
	$cat = $_POST['fid'];
	$owner = $session->uid;
	$alli = $database->ForumCatAlliance($cat);
	
	if(!empty($text)){
		if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
			$text = "[message]".$text."[/message]";
			$alliances = $player = $coor = $report = 0;
			for($i = 0; $i <= $alliances; $i++){
				if(preg_match('/\[alliance'.$i.'\]/', $text) && preg_match('/\[\/alliance'.$i.'\]/', $text)){
					$alliance1 = preg_replace('/\[message\](.*?)\[\/alliance'.$i.'\]/is', '', $text);
					if(preg_match('/\[alliance'.$i.'\]/', $alliance1) && preg_match('/\[\/alliance'.$i.'\]/', $alliance1)){
						$j = $i + 1;
						$alliance2 = preg_replace('/\[\/alliance'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$alliance1 = preg_replace('/\[alliance'.$i.'\]/', '[alliance'.$j.']', $alliance1);
						$alliance1 = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance'.$j.']', $alliance1);
						$text = $alliance2."[/alliance".$i."]".$alliance1;
						$alliances += 1;
					}
				}
			}
			for($i = 0; $i <= $player; $i++){
				if(preg_match('/\[player'.$i.'\]/', $text) && preg_match('/\[\/player'.$i.'\]/', $text)){
					$player1 = preg_replace('/\[message\](.*?)\[\/player'.$i.'\]/is', '', $text);
					if(preg_match('/\[player'.$i.'\]/', $player1) && preg_match('/\[\/player'.$i.'\]/', $player1)){
						$j = $i + 1;
						$player2 = preg_replace('/\[\/player'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$player1 = preg_replace('/\[player'.$i.'\]/', '[player'.$j.']', $player1);
						$player1 = preg_replace('/\[\/player'.$i.'\]/', '[/player'.$j.']', $player1);
						$text = $player2."[/player".$i."]".$player1;
						$player += 1;
					}
				}
			}
			for($i = 0; $i <= $coor; $i++){
				if(preg_match('/\[coor'.$i.'\]/', $text) && preg_match('/\[\/coor'.$i.'\]/', $text)){
					$coor1 = preg_replace('/\[message\](.*?)\[\/coor'.$i.'\]/is', '', $text);
					if(preg_match('/\[coor'.$i.'\]/', $coor1) && preg_match('/\[\/coor'.$i.'\]/', $coor1)){
						$j = $i + 1;
						$coor2 = preg_replace('/\[\/coor'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$coor1 = preg_replace('/\[coor'.$i.'\]/', '[coor'.$j.']', $coor1);
						$coor1 = preg_replace('/\[\/coor'.$i.'\]/', '[/coor'.$j.']', $coor1);
						$text = $coor2."[/coor".$i."]".$coor1;
						$coor += 1;
					}
				}
			}
			for($i = 0; $i <= $report; $i++){
				if(preg_match('/\[report'.$i.'\]/', $text) && preg_match('/\[\/report'.$i.'\]/', $text)){
					$report1 = preg_replace('/\[message\](.*?)\[\/report'.$i.'\]/is', '', $text);
					if(preg_match('/\[report'.$i.'\]/', $report1) && preg_match('/\[\/report'.$i.'\]/', $report1)){
						$j = $i + 1;
						$report2 = preg_replace('/\[\/report'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$report1 = preg_replace('/\[report'.$i.'\]/', '[report'.$j.']', $report1);
						$report1 = preg_replace('/\[\/report'.$i.'\]/', '[/report'.$j.']', $report1);
						$text = $report2."[/report".$i."]".$report1;
						$report += 1;
					}
				}
			}
			$survey = false;
			$ends = '';
			if(isset($_POST['umfrage'])){
				if(isset($_POST['umfrage_ende'])){
					$ends_date = $_POST['month']."/".$_POST['day']."/".$_POST['year'];
					if($_POST['meridiem'] == 1) $_POST['hour'] += 12;
					$ends_time = $_POST['hour'].":".$_POST['minute'];
					$ends = strtotime($ends_date) - strtotime(date('m/d/Y')) + strtotime($ends_time);
				}
				
				for($i = 1; $i <= 8; $i++) if(isset($_POST['option_'.$i]) && !empty($_POST['option_'.$i])) $survey = true;
			}
			$topic_id = $database->CreatTopic($title, $text, $cat, $owner, $alli, $ends, $alliances, $player, $coor, $report);
			if($survey){
				$database->createSurvey($topic_id, $_POST['umfrage_thema'], $_POST['option_1'], $_POST['option_2'], $_POST['option_3'], $_POST['option_4'], $_POST['option_5'], $_POST['option_6'], $_POST['option_7'], $_POST['option_8'], $ends);
			}
		}
	}
}

if(isset($_POST['newpost'])){
	$text = $_POST['text'];
	$tids = $_POST['tid'];
	$fid2 = $_POST['fid2'];
	$owner = $session->uid;
	if(!empty($text)){
		if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
			$text = "[message]".$text."[/message]";
			$alliances = $player = $coor = $report = 0;
			for($i = 0; $i <= $alliances; $i++){
				if(preg_match('/\[alliance'.$i.'\]/', $text) && preg_match('/\[\/alliance'.$i.'\]/', $text)){
					$alliance1 = preg_replace('/\[message\](.*?)\[\/alliance'.$i.'\]/is', '', $text);
					if(preg_match('/\[alliance'.$i.'\]/', $alliance1) && preg_match('/\[\/alliance'.$i.'\]/', $alliance1)){
						$j = $i + 1;
						$alliance2 = preg_replace('/\[\/alliance'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$alliance1 = preg_replace('/\[alliance'.$i.'\]/', '[alliance'.$j.']', $alliance1);
						$alliance1 = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance'.$j.']', $alliance1);
						$text = $alliance2."[/alliance".$i."]".$alliance1;
						$alliances += 1;
					}
				}
			}
			for($i = 0; $i <= $player; $i++){
				if(preg_match('/\[player'.$i.'\]/', $text) && preg_match('/\[\/player'.$i.'\]/', $text)){
					$player1 = preg_replace('/\[message\](.*?)\[\/player'.$i.'\]/is', '', $text);
					if(preg_match('/\[player'.$i.'\]/', $player1) && preg_match('/\[\/player'.$i.'\]/', $player1)){
						$j = $i + 1;
						$player2 = preg_replace('/\[\/player'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$player1 = preg_replace('/\[player'.$i.'\]/', '[player'.$j.']', $player1);
						$player1 = preg_replace('/\[\/player'.$i.'\]/', '[/player'.$j.']', $player1);
						$text = $player2."[/player".$i."]".$player1;
						$player += 1;
					}
				}
			}
			for($i = 0; $i <= $coor; $i++){
				if(preg_match('/\[coor'.$i.'\]/', $text) && preg_match('/\[\/coor'.$i.'\]/', $text)){
					$coor1 = preg_replace('/\[message\](.*?)\[\/coor'.$i.'\]/is', '', $text);
					if(preg_match('/\[coor'.$i.'\]/', $coor1) && preg_match('/\[\/coor'.$i.'\]/', $coor1)){
						$j = $i + 1;
						$coor2 = preg_replace('/\[\/coor'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$coor1 = preg_replace('/\[coor'.$i.'\]/', '[coor'.$j.']', $coor1);
						$coor1 = preg_replace('/\[\/coor'.$i.'\]/', '[/coor'.$j.']', $coor1);
						$text = $coor2."[/coor".$i."]".$coor1;
						$coor += 1;
					}
				}
			}
			for($i = 0; $i <= $report; $i++){
				if(preg_match('/\[report'.$i.'\]/', $text) && preg_match('/\[\/report'.$i.'\]/', $text)){
					$report1 = preg_replace('/\[message\](.*?)\[\/report'.$i.'\]/is', '', $text);
					if(preg_match('/\[report'.$i.'\]/', $report1) && preg_match('/\[\/report'.$i.'\]/', $report1)){
						$j = $i + 1;
						$report2 = preg_replace('/\[\/report'.$i.'\](.*?)\[\/message\]/is', '', $text);
						$report1 = preg_replace('/\[report'.$i.'\]/', '[report'.$j.']', $report1);
						$report1 = preg_replace('/\[\/report'.$i.'\]/', '[/report'.$j.']', $report1);
						$text = $report2."[/report".$i."]".$report1;
						$report += 1;
					}
				}
			}
			$database->UpdatePostDate($tids);
			$database->CreatPost($text, $tids, $owner, $alliances, $player, $coor, $report, $fid2);
		}
	}
}

if(isset($_POST['editans']) && isset($_POST['text']) && !empty($_POST['text'])
   && isset($_POST['tid']) && !empty($_POST['tid']) &&
		Alliance::canAct(['aid' => $aid, 'alliance' => ($topic = reset($database->ShowTopic($_POST['tid'])))['alliance'],
				'forum_perm' => $opt['opt5'], 'admin' => $_GET['admin'], 'owner' => $topic['owner']], 1)){

	$text = $_POST['text'];
	$topic_id = $_POST['tid'];

	$text = preg_replace('/\[message\]/', '', $text);
	$text = preg_replace('/\[\/message\]/', '', $text);
	for($i = 0; $i <= $_POST['alliance0']; $i++){
		$text = preg_replace('/\[alliance'.$i.'\]/', '[alliance0]', $text);
		$text = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance0]', $text);
	}
	for($i = 0; $i <= $_POST['player0']; $i++){
		$text = preg_replace('/\[player'.$i.'\]/', '[player0]', $text);
		$text = preg_replace('/\[\/player'.$i.'\]/', '[/player0]', $text);
	}
	for($i = 0; $i <= $_POST['coor0']; $i++){
		$text = preg_replace('/\[coor'.$i.'\]/', '[coor0]', $text);
		$text = preg_replace('/\[\/coor'.$i.'\]/', '[/coor0]', $text);
	}
	for($i = 0; $i <= $_POST['report0']; $i++){
		$text = preg_replace('/\[report'.$i.'\]/', '[report0]', $text);
		$text = preg_replace('/\[\/report'.$i.'\]/', '[/report0]', $text);
	}

	if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
		$text = "[message]".$text."[/message]";
		$alliances = $player = $coor = $report = 0;
		for($i = 0; $i <= $alliances; $i++){
			if(preg_match('/\[alliance'.$i.'\]/', $text) && preg_match('/\[\/alliance'.$i.'\]/', $text)){
				$alliance1 = preg_replace('/\[message\](.*?)\[\/alliance'.$i.'\]/is', '', $text);
				if(preg_match('/\[alliance'.$i.'\]/', $alliance1) && preg_match('/\[\/alliance'.$i.'\]/', $alliance1)){
					$j = $i + 1;
					$alliance2 = preg_replace('/\[\/alliance'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$alliance1 = preg_replace('/\[alliance'.$i.'\]/', '[alliance'.$j.']', $alliance1);
					$alliance1 = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance'.$j.']', $alliance1);
					$text = $alliance2."[/alliance".$i."]".$alliance1;
					$alliances += 1;
				}
			}
		}
		for($i = 0; $i <= $player; $i++){
			if(preg_match('/\[player'.$i.'\]/', $text) && preg_match('/\[\/player'.$i.'\]/', $text)){
				$player1 = preg_replace('/\[message\](.*?)\[\/player'.$i.'\]/is', '', $text);
				if(preg_match('/\[player'.$i.'\]/', $player1) && preg_match('/\[\/player'.$i.'\]/', $player1)){
					$j = $i + 1;
					$player2 = preg_replace('/\[\/player'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$player1 = preg_replace('/\[player'.$i.'\]/', '[player'.$j.']', $player1);
					$player1 = preg_replace('/\[\/player'.$i.'\]/', '[/player'.$j.']', $player1);
					$text = $player2."[/player".$i."]".$player1;
					$player += 1;
				}
			}
		}
		for($i = 0; $i <= $coor; $i++){
			if(preg_match('/\[coor'.$i.'\]/', $text) && preg_match('/\[\/coor'.$i.'\]/', $text)){
				$coor1 = preg_replace('/\[message\](.*?)\[\/coor'.$i.'\]/is', '', $text);
				if(preg_match('/\[coor'.$i.'\]/', $coor1) && preg_match('/\[\/coor'.$i.'\]/', $coor1)){
					$j = $i + 1;
					$coor2 = preg_replace('/\[\/coor'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$coor1 = preg_replace('/\[coor'.$i.'\]/', '[coor'.$j.']', $coor1);
					$coor1 = preg_replace('/\[\/coor'.$i.'\]/', '[/coor'.$j.']', $coor1);
					$text = $coor2."[/coor".$i."]".$coor1;
					$coor += 1;
				}
			}
		}
		for($i = 0; $i <= $report; $i++){
			if(preg_match('/\[report'.$i.'\]/', $text) && preg_match('/\[\/report'.$i.'\]/', $text)){
				$report1 = preg_replace('/\[message\](.*?)\[\/report'.$i.'\]/is', '', $text);
				if(preg_match('/\[report'.$i.'\]/', $report1) && preg_match('/\[\/report'.$i.'\]/', $report1)){
					$j = $i + 1;
					$report2 = preg_replace('/\[\/report'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$report1 = preg_replace('/\[report'.$i.'\]/', '[report'.$j.']', $report1);
					$report1 = preg_replace('/\[\/report'.$i.'\]/', '[/report'.$j.']', $report1);
					$text = $report2."[/report".$i."]".$report1;
					$report += 1;
				}
			}
		}

		$database->EditUpdateTopic($topic_id, $text, $alliances, $player, $coor, $report);
	}
}

if(isset($_POST['editpost']) && isset($_POST['text']) && !empty($_POST['text']) &&
		isset($_POST['pod']) && !empty($_POST['pod']) &&
		Alliance::canAct(['aid' => $aid, 
				'alliance' => reset($database->ShowTopic(($post = reset($database->ShowPostEdit($_POST['pod'])))['topic']))['alliance'], 
				'forum_perm' => $opt['opt5'], 'owner' => $post['owner'], 'admin' => $_GET['admin']], 1))
{
	
	$text = $_POST['text'];
	$posts_id = $_POST['pod'];
	
	$text = preg_replace('/\[message\]/', '', $text);
	$text = preg_replace('/\[\/message\]/', '', $text);
	for($i = 0; $i <= $_POST['alliance0']; $i++){
		$text = preg_replace('/\[alliance'.$i.'\]/', '[alliance0]', $text);
		$text = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance0]', $text);
	}
	for($i = 0; $i <= $_POST['player0']; $i++){
		$text = preg_replace('/\[player'.$i.'\]/', '[player0]', $text);
		$text = preg_replace('/\[\/player'.$i.'\]/', '[/player0]', $text);
	}
	for($i = 0; $i <= $_POST['coor0']; $i++){
		$text = preg_replace('/\[coor'.$i.'\]/', '[coor0]', $text);
		$text = preg_replace('/\[\/coor'.$i.'\]/', '[/coor0]', $text);
	}
	if(isset($text['report0'])){
		for($i = 0; $i <= $text['report0']; $i++){
			$text = preg_replace('/\[report'.$i.'\]/', '[report0]', $text);
			$text = preg_replace('/\[\/report'.$i.'\]/', '[/report0]', $text);
		}
	}

	if(!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)){
		$text = "[message]".$text."[/message]";
		$alliance = $player = $coor = $report = 0;
		for($i = 0; $i <= $alliance; $i++){
			if(preg_match('/\[alliance'.$i.'\]/', $text) && preg_match('/\[\/alliance'.$i.'\]/', $text)){
				$alliance1 = preg_replace('/\[message\](.*?)\[\/alliance'.$i.'\]/is', '', $text);
				if(preg_match('/\[alliance'.$i.'\]/', $alliance1) && preg_match('/\[\/alliance'.$i.'\]/', $alliance1)){
					$j = $i + 1;
					$alliance2 = preg_replace('/\[\/alliance'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$alliance1 = preg_replace('/\[alliance'.$i.'\]/', '[alliance'.$j.']', $alliance1);
					$alliance1 = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance'.$j.']', $alliance1);
					$text = $alliance2."[/alliance".$i."]".$alliance1;
					$alliance += 1;
				}
			}
		}
		for($i = 0; $i <= $player; $i++){
			if(preg_match('/\[player'.$i.'\]/', $text) && preg_match('/\[\/player'.$i.'\]/', $text)){
				$player1 = preg_replace('/\[message\](.*?)\[\/player'.$i.'\]/is', '', $text);
				if(preg_match('/\[player'.$i.'\]/', $player1) && preg_match('/\[\/player'.$i.'\]/', $player1)){
					$j = $i + 1;
					$player2 = preg_replace('/\[\/player'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$player1 = preg_replace('/\[player'.$i.'\]/', '[player'.$j.']', $player1);
					$player1 = preg_replace('/\[\/player'.$i.'\]/', '[/player'.$j.']', $player1);
					$text = $player2."[/player".$i."]".$player1;
					$player += 1;
				}
			}
		}
		for($i = 0; $i <= $coor; $i++){
			if(preg_match('/\[coor'.$i.'\]/', $text) && preg_match('/\[\/coor'.$i.'\]/', $text)){
				$coor1 = preg_replace('/\[message\](.*?)\[\/coor'.$i.'\]/is', '', $text);
				if(preg_match('/\[coor'.$i.'\]/', $coor1) && preg_match('/\[\/coor'.$i.'\]/', $coor1)){
					$j = $i + 1;
					$coor2 = preg_replace('/\[\/coor'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$coor1 = preg_replace('/\[coor'.$i.'\]/', '[coor'.$j.']', $coor1);
					$coor1 = preg_replace('/\[\/coor'.$i.'\]/', '[/coor'.$j.']', $coor1);
					$text = $coor2."[/coor".$i."]".$coor1;
					$coor += 1;
				}
			}
		}
		for($i = 0; $i <= $report; $i++){
			if(preg_match('/\[report'.$i.'\]/', $text) && preg_match('/\[\/report'.$i.'\]/', $text)){
				$report1 = preg_replace('/\[message\](.*?)\[\/report'.$i.'\]/is', '', $text);
				if(preg_match('/\[report'.$i.'\]/', $report1) && preg_match('/\[\/report'.$i.'\]/', $report1)){
					$j = $i + 1;
					$report2 = preg_replace('/\[\/report'.$i.'\](.*?)\[\/message\]/is', '', $text);
					$report1 = preg_replace('/\[report'.$i.'\]/', '[report'.$j.']', $report1);
					$report1 = preg_replace('/\[\/report'.$i.'\]/', '[/report'.$j.']', $report1);
					$text = $report2."[/report".$i."]".$report1;
					$report += 1;
				}
			}
		}
		$database->EditUpdatePost($posts_id, $text, $alliance, $player, $coor, $report);
	}
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

if($_GET['admin'] == "pos" && isset($_GET['res']) && isset($_GET['bid']) && isset($_GET['fid']) && !empty($_GET['fid']) && $opt['opt5'] == 1){
	$database->moveForum($_GET['fid'], $_GET['bid'], $session->alliance, $_GET['res']); //Move the forum to the top/bottom of the list
	$alliance->redirect($_GET);
}
elseif(isset($_GET['admin']) && !empty($_GET['admin']) && isset($_GET['idt']) && !empty($_GET['idt'])){
	
	//Get the post informations
	$topicID = $_GET['idt'];
	$post = reset($database->ShowTopic($topicID));
	$checkArray = ['aid' => $aid, 'alliance' => $post['alliance'], 'forum_perm' => $opt['opt5'], 'admin' => $_GET['admin'], 'owner' => $post['owner']];

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
elseif($_GET['admin'] == "delforum" && $opt['opt5'] == 1 &&
   !empty($catToDelete = reset($database->ForumCatEdit($_GET['idf']))) &&
   $catToDelete['alliance'] == $session->alliance)
{
	$database->DeleteCat($_GET['idf']); // delete forum
	$alliance->redirect($_GET);
}
elseif($_GET['admin'] == "delpost" && isset($_GET['pod']) && !empty($_GET['pod']) &&
		isset($_GET['tid']) && !empty($_GET['tid']) &&
		isset($_GET['fid2']) && !empty($_GET['fid2']) &&
		Alliance::canAct(['aid' => $aid, 'alliance' => reset($database->ShowTopic($_GET['tid']))['alliance'], 'forum_perm' => $opt['opt5'],
		'owner' => reset($database->ShowPostEdit($_GET['pod']))['owner'], 'admin' => $_GET['admin']], 1))
{
	$database->DeletePost($_GET['pod']); //Delete post
	header("Location: allianz.php?s=2&fid2=".$_GET['fid2']."&tid=".$_GET['tid']);
	exit;
}
elseif($_GET['admin'] == "newforum" && $opt['opt5'] == 1) include("Forum/forum_1.tpl"); // new forum
elseif($_GET['admin'] == "editpost" && isset($_GET['pod']) && !empty($_GET['pod']) &&
		isset($_GET['tid']) && !empty($_GET['tid']) &&
		isset($_GET['fid']) && !empty($_GET['fid']) &&
		Alliance::canAct(['aid' => $aid, 'alliance' => reset($database->ShowTopic($_GET['tid']))['alliance'], 'forum_perm' => $opt['opt5'],
				'owner' => reset($database->ShowPostEdit($_GET['pod']))['owner'], 'admin' => $_GET['admin']], 1)) //Edit post
{
	include("Forum/forum_10.tpl");
}
elseif(isset($_GET['fid'])){
	if(isset($_GET['ac'])) include("Forum/forum_5.tpl"); //New topic	
	else include("Forum/forum_4.tpl"); //Show topics
}
elseif($_GET['admin'] == "editforum" && $opt['opt5'] == 1) include("Forum/forum_8.tpl"); // edit forum	
elseif(isset($_GET['tid'])){
	if(isset($_GET['ac'])) include ("Forum/forum_7.tpl"); //New post
	else include ("Forum/forum_6.tpl"); //Showtopic
}else{
	if($database->CheckForum($aid)) include("Forum/forum_2.tpl");	
	else if($opt['opt5'] == 1){
		if($session->access == BANNED){
			echo '<p class="error">Forum is not created yet</p><p>
			<a href="banned.php"><img id="fbtn_newforum" class="dynamic_img" src="img/x.gif" alt="New forum" /></a></p>';
		}else{
			echo '<p class="error">Forum is not created yet</p><p>
			<a href="allianz.php?s=2&admin=newforum"><img id="fbtn_newforum" class="dynamic_img" src="img/x.gif" alt="New forum" /></a></p>';
		}
	}
	else echo '<p class="error">Forum is not created yet</p>';
}
?>