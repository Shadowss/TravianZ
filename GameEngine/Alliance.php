<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Alliance.php                                                ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

	   class Alliance {

		public $gotInvite = false;
		public $inviteArray = array();
		public $allianceArray = array();
		public $userPermArray = array();

		public function procAlliance($get) {
			global $session, $database;

			if($session->alliance != 0) {
				$this->allianceArray = $database->getAlliance($session->alliance);
				// Permissions Array
				// [id] => id [uid] => uid [alliance] => alliance [opt1] => X [opt2] => X [opt3] => X [opt4] => X [opt5] => X [opt6] => X [opt7] => X [opt8] => X
				$this->userPermArray = $database->getAlliPermissions($session->uid, $session->alliance);
			} else {
				$this->inviteArray = $database->getInvitation($session->uid);
				$this->gotInvite = count($this->inviteArray) == 0 ? false : true;
			}
			if(isset($get['a'])) {
				switch($get['a']) {
					case 2:
						$this->rejectInvite($get);
						break;
					case 3:
						$this->acceptInvite($get);
						break;
					default:
						break;
				}
			}
			if(isset($get['o'])) {
				switch($get['o']) {
					case 4:
						$this->delInvite($get);
						break;
					default:
						break;
				}
			}
		}

		public function procAlliForm($post) {
			if(isset($post['ft'])) {
				switch($post['ft']) {
					case "ali1":
						$this->createAlliance($post);
						break;
				}

			}
			if(isset($_POST['dipl']) and isset($_POST['a_name'])) {
				$this->changediplomacy($post);
			}

			if(isset($post['s'])) {
				if(isset($post['o'])) {
					switch($post['o']) {
						case 1:
							if(isset($_POST['a'])) {
								$this->changeUserPermissions($post);
							}
							break;
						case 2:
							if(isset($_POST['a_user'])) {
								$this->kickAlliUser($post);
							}
							break;
						case 4:
							if(isset($_POST['a']) && $_POST['a'] == 4) {
								$this->sendInvite($post);
							}
							break;
						case 3:
							$this->updateAlliProfile($post);
							break;
						case 11:
							$this->quitally($post);
							break;
						case 100:
							$this->changeAliName($post);
							break;
					}
				}
			}
		}

		/*****************************************
		Function to process of sending invitations
		*****************************************/
		public function sendInvite($post) {
			global $form, $database, $session;
			if($session->access != BANNED){
			$UserData = $database->getUserArray(stripslashes($post['a_name']), 0);
			if($this->userPermArray['opt4'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}elseif(!isset($post['a_name']) || $post['a_name'] == "") {
				$form->addError("name1", NAME_EMPTY);
			}elseif(!$database->checkExist(stripslashes($post['a_name']), 0)) {
				$form->addError("name2", NAME_NO_EXIST."".stripslashes(stripslashes($post['a_name'])));
			}elseif($UserData['id'] == $session->uid) {
				$form->addError("name3", SAME_NAME);
			}elseif($database->getInvitation2($UserData['id'],$session->alliance)) {
				$form->addError("name4", $post['a_name'].ALREADY_INVITED);
			}elseif($UserData['alliance'] == $session->alliance) {
				$form->addError("name5", $post['a_name'].ALREADY_IN_ALLY);
			}else{
				// Obtenemos la informacion necesaria
				$aid = $session->alliance;
				// Insertamos invitacion
				$database->sendInvitation($UserData['id'], $aid, $session->uid);
				// Log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has invited  <a href="spieler.php?uid=' . $UserData['id'] . '">' . addslashes($UserData['username']) . '</a> into the alliance.');
			}
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to reject an invitation
		*****************************************/
		private function rejectInvite($get) {
			global $database, $session;
			if($session->access != BANNED){
			foreach($this->inviteArray as $invite) {
				if($invite['id'] == $get['d']) {
					$database->removeInvitation($get['d']);
					$database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has rejected the invitation.');
				}
			}
			header("Location: build.php?id=".$get['id']);
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to del an invitation
		*****************************************/
		private function delInvite($get) {
			global $database, $session;
			if($session->access != BANNED){
			$inviteArray = $database->getAliInvitations($session->alliance);
			foreach($inviteArray as $invite) {
				if($invite['id'] == $get['d']) {
				$invitename = $database->getUserArray($invite['uid'], 1);
					$database->removeInvitation($get['d']);
					$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has deleted the invitation for <a href="spieler.php?uid=' . $invitename['id'] . '">' . addslashes($invitename['username']) . '</a>.');
				}
			}
			header("Location: allianz.php?delinvite");
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to accept an invitation
		*****************************************/
		private function acceptInvite($get) {
			global $form, $database, $session;
			if($session->access != BANNED){
			foreach($this->inviteArray as $invite) {
			if($session->alliance == 0){
				if($invite['id'] == $get['d'] && $invite['uid'] == $session->uid) {
				$memberlist = $database->getAllMember($invite['alliance']);
				$alliance_info = $database->getAlliance($invite['alliance']);
				if(count($memberlist) < $alliance_info['max']){
					$database->removeInvitation($get['d']);
					$database->updateUserField($invite['uid'], "alliance", $invite['alliance'], 1);
					$database->createAlliPermissions($invite['uid'], $invite['alliance'], '', '0', '0', '0', '0', '0', '0', '0', '0');
					// Log the notice
					$database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has joined the alliance.');
				}else{
				$accept_error = 1;
				$max = $alliance_info['max'];
				}
				}
			}
			}
			if($accept_error == 1){
			$form->addError("ally_accept", "The alliance can contain only ".$max." peoples right now.");
			}else{
			header("Location: build.php?id=" . $get['id']);
			}
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to create an alliance
		*****************************************/
		private function createAlliance($post) {
			global $form, $database, $session, $bid18, $village;
			if($session->access != BANNED){
			if(!isset($post['ally1']) || $post['ally1'] == "") {
				$form->addError("ally1", ATAG_EMPTY);
			}
			if(!isset($post['ally2']) || $post['ally2'] == "") {
				$form->addError("ally2", ANAME_EMPTY);
			}
			if($database->aExist($post['ally1'], "tag")) {
				$form->addError("ally1", ATAG_EXIST);
			}
			if($database->aExist($post['ally2'], "name")) {
				$form->addError("ally2", ANAME_EXIST);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;

				header("Location: build.php?id=" . $post['id']);
			} else {
				$max = $bid18[$village->resarray['f' . $post['id']]]['attri'];
				$aid = $database->createAlliance($post['ally1'], $post['ally2'], $session->uid, $max);
				$database->updateUserField($session->uid, "alliance", $aid, 1);
				$database->procAllyPop($aid);
				// Asign Permissions
				$database->createAlliPermissions($session->uid, $aid, 'Alliance founder', '1', '1', '1', '1', '1', '1', '1', '1');
				// log the notice
				$database->insertAlliNotice($aid, 'The alliance has been founded by <a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>.');
				header("Location: build.php?id=" . $post['id']);
			}
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to change the alliance name
		*****************************************/
		private function changeAliName($get) {
			global $form, $database, $session;
			if($session->access != BANNED){
			if(!isset($get['ally1']) || $get['ally1'] == "") {
				$form->addError("ally1", ATAG_EMPTY);
			}
			if(!isset($get['ally2']) || $get['ally2'] == "") {
				$form->addError("ally2", ANAME_EMPTY);
			}
			if($database->aExist($get['ally1'], "tag")) {
				$form->addError("tag", ATAG_EXIST);
			}
			if($database->aExist($get['ally2'], "name")) {
				$form->addError("name", ANAME_EXIST);
			}
			if($this->userPermArray['opt3'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;
				//header("Location: build.php?id=".$post['id']);
			} else {
				$database->setAlliName($session->alliance, $get['ally2'], $get['ally1']);
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has changed the alliance name.');
			}
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to create/change the alliance description
		*****************************************/
		private function updateAlliProfile($post) {
			global $database, $session, $form;
			if($session->access != BANNED){
			if($this->userPermArray['opt3'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;
				//header("Location: build.php?id=".$post['id']);
			} else {
				$database->submitAlliProfile($session->alliance, $post['be2'], $post['be1']);
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has changed the alliance description.');
			}
			}else{
			header("Location: banned.php");
			}
		}

		/*****************************************
		Function to change the user permissions
		*****************************************/
		private function changeUserPermissions($post) {
			global $database, $session, $form;
			if($session->access != BANNED){
			if($this->userPermArray['opt1'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;
				//header("Location: build.php?id=".$post['id']);
			} else {
				$database->updateAlliPermissions($post['a_user'], $session->alliance, $post['a_titel'], $post['e1'], $post['e2'], $post['e3'], $post['e4'], $post['e5'], $post['e6'], $post['e7']);
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has changed permissions.');
			}
			}else{
			header("Location: banned.php");
			}
		}
		/*****************************************
		Function to kick a user from alliance
		*****************************************/
		private function kickAlliUser($post) {
			global $database, $session, $form;
			if($session->access != BANNED){
			$UserData = $database->getUserArray($post['a_user'], 0);
			if($this->userPermArray['opt2'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			} else if($UserData['id'] != $session->uid){
				$database->updateUserField($post['a_user'], 'alliance', 0, 1);
				$database->deleteAlliPermissions($post['a_user']);
				$database->deleteAlliance($session->alliance);
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $UserData['id'] . '">' . addslashes($post['a_user']) . '</a> has quit the alliance.');
				if($database->isAllianceOwner($UserData['id'])){
				$newowner = $database->getAllMember2($session->alliance);
				$newleader = $newowner['id'];
				$q = "UPDATE " . TB_PREFIX . "alidata set leader = ".$newleader." where id = ".$session->alliance."";
				$database->query($q);
				$database->updateAlliPermissions($newleader, 1, 1, 1, 1, 1, 1, 1, 1, 1);
				$this->updateMax($newleader);
				}
				}
			}else{
			header("Location: banned.php");
			}
		}
		/*****************************************
		Function to set forum link
		*****************************************/
		public function setForumLink($post) {
			global $database, $session;
			if($session->access != BANNED){
				if(isset($post['f_link'])){
				$database->setAlliForumLink($session->alliance, $post['f_link']);
				header("Location: allianz.php?s=5");
				}
			}else{
			header("Location: banned.php");
			}
		}
		/*****************************************
		Function to vote on forum survey
		*****************************************/
		public function Vote($post) {
			global $database, $session;
			if($session->access != BANNED){
			if($database->checkSurvey($post['tid']) && !$database->checkVote($post['tid'], $session->uid)){
			$survey = $database->getSurvey($post['tid']);
			$text = ''.$survey['voted'].','.$session->uid.',';
			$database->Vote($post['tid'], $post['vote'], $text);
			}
			header("Location: allianz.php?s=2&fid2=".$post['fid2']."&pid=".$post['pid']."&tid=".$post['tid']);
			}else{
			header("Location: banned.php");
			}
		}
		/*****************************************
		Function to quit from alliance
		*****************************************/
		private function quitally($post) {
			global $database, $session, $form;
			if($session->access != BANNED){
			if(!isset($post['pw']) || $post['pw'] == "") {
				$form->addError("pw1", PW_EMPTY);
			} elseif(md5($post['pw']) !== $session->userinfo['password']) {
				$form->addError("pw2", PW_ERR);
			} else {
				$database->updateUserField($session->uid, 'alliance', 0, 1);
				if($database->isAllianceOwner($session->uid)){
				$newowner = $database->getAllMember2($session->alliance);
				$newleader = $newowner['id'];
				$q = "UPDATE " . TB_PREFIX . "alidata set leader = ".$newleader." where id = ".$session->alliance."";
				$database->query($q);
				$database->updateAlliPermissions($newleader, 1, 1, 1, 1, 1, 1, 1, 1, 1);
				$this->updateMax($newleader);
				}
				$database->deleteAlliPermissions($session->uid);
				// log the notice
				$database->deleteAlliance($session->alliance);
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a> has quit the alliance.');
				header("Location: spieler.php?uid=".$session->uid);
			}
			}else{
			header("Location: banned.php");
			}
		}

		private function changediplomacy($post) {
			global $database, $session, $form;
			if($session->access != BANNED){
			$aName = $_POST['a_name'];
			$aType = (int)intval($_POST['dipl']);
			if($database->aExist($aName, "tag")) {
				if($database->getAllianceID($aName) != $session->alliance) {
					if($aType >= 1 and $aType <= 3) {
						if(!$database->diplomacyInviteCheck2($session->alliance, $database->getAllianceID($aName))) {
							$database->diplomacyInviteAdd($session->alliance, $database->getAllianceID($aName), $aType);
							if($aType == 1){
							$notice = "offer a confederation to";
							}else if($aType == 2){
							$notice = "offer non-aggression pact to";
							}else if($aType == 3){
							$notice = "declare war on";
							}
							$database->insertAlliNotice($session->alliance, '<a href="allianz.php?aid=' . $session->alliance . '">' . $database->getAllianceName($session->alliance) . '</a> '. $notice .' <a href="allianz.php?aid=' . $database->getAllianceID($aName) . '">' . $aName . '</a>.');
							$form->addError("name", "Invite sended");
						} else {
							$form->addError("name", "You have already sended them a invite");
						}

					} else {
						$form->addError("name", "wrong choice made");
					}
				} else {
					$form->addError("name", "You can not invite your own alliance");
				}
			} else {
				$form->addError("name", "Alliance does not exist");
			}
			}else{
			header("Location: banned.php");
			}
		}
		
		private function updateMax($leader) {
			global $bid18, $database;
			$q = mysql_query("SELECT * FROM " . TB_PREFIX . "alidata where leader = $leader");
			if(mysql_num_rows($q) > 0){
			$villages = $database->getVillagesID2($leader);
			$max = 0;
			foreach($villages as $village){
			$field = $database->getResourceLevel($village['wref']);
			for($i=19;$i<=40;$i++){
			if($field['f'.$i.'t'] == 18){
			$level = $field['f'.$i];
			$attri = $bid18[$level]['attri'];
			}
			}
			if($attri > $max){
			$max = $attri;
			}
			}
			$q = "UPDATE ".TB_PREFIX."alidata set max = $max where leader = $leader";
			$database->query($q);
			}
		}
	   }

	   $alliance = new Alliance;

?>
