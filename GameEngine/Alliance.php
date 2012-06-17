<?php

/*
|--------------------------------------------------------------------------
|   PLEASE DO NOT REMOVE THIS COPYRIGHT NOTICE!
|--------------------------------------------------------------------------
|
|   Project owner:   Dzoki < dzoki.travian@gmail.com >
|
|   This script is property of TravianX Project. You are allowed to change
|   its source and release it under own name, not under name `TravianX`.
|   You have no rights to remove copyright notices.
|
|   TravianX All rights reserved
|
*/

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
			// ¿El campo posee informacion?
			if(!isset($post['a_name']) || $post['a_name'] == "") {
				$form->addError("name1", NAME_EMPTY);
			}
			// ¿Existe el usuario?
			if(!$database->checkExist($post['a_name'], 0)) {
				$form->addError("name2", NAME_NO_EXIST);
			}
			// ¿La invitacion es a si mismo?
			if($post['a_name'] == ($session->username)) {
				$form->addError("name3", SAME_NAME);
			}
			// ¿Esta ya invitado a la alianza?
			$UserData = $database->getUserArray($post['a_name'], 0);
			if($database->getInvitation($UserData['id'])) {
				$form->addError("name4", OLRADY_INVITED);
			}
			// ¿Esta ya en la alianza?
			$UserData = $database->getUserArray($post['a_name'], 0);
			if($UserData['alliance'] == $session->alliance) {
				$form->addError("name5", OLRADY_IN_ALLY);
			}
			// ¿La invitación la envia un autorizado?
			if($this->userPermArray['opt4'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;
				print_r($form->getErrors());
			} else {
				// Obtenemos la informacion necesaria
				$aid = $session->alliance;
				// Insertamos invitacion
				$database->sendInvitation($UserData['id'], $aid, $session->uid);
				// Log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has invited  <a href="spieler.php?uid=' . $UserData['id'] . '">' . $UserData['username'] . '</a> into the alliance.');
			}
		}

		/*****************************************
		Function to reject an invitation
		*****************************************/
		private function rejectInvite($get) {
			global $database, $session;
			foreach($this->inviteArray as $invite) {
				if($invite['id'] == $get['d']) {
					$database->removeInvitation($get['d']);
					$database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has rejected the invitation.');
				}
			}
			header("Location: build.php?id=".$get['id']);
		}

		/*****************************************
		Function to del an invitation
		*****************************************/
		private function delInvite($get) {
			global $database, $session;
			$inviteArray = $database->getAliInvitations($session->alliance);
			foreach($inviteArray as $invite) {
				if($invite['id'] == $get['d']) {
				$invitename = $database->getUserArray($invite['uid'], 1);
					$database->removeInvitation($get['d']);
					$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has deleted the invitation for <a href="spieler.php?uid=' . $invitename['id'] . '">' . $invitename['username'] . '</a>.');
				}
			}
		}

		/*****************************************
		Function to accept an invitation
		*****************************************/
		private function acceptInvite($get) {
			global $database, $session;
			foreach($this->inviteArray as $invite) {
				if($invite['id'] == $get['d']) {
					$database->removeInvitation($database->RemoveXSS($get['d']));
					$database->updateUserField($database->RemoveXSS($invite['uid']), "alliance", $database->RemoveXSS($invite['alliance']), 1);
					$database->createAlliPermissions($database->RemoveXSS($invite['uid']), $database->RemoveXSS($invite['alliance']), '', '0', '0', '0', '0', '0', '0', '0', '0');
					// Log the notice
					$database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has joined the alliance.');
				}
			}
			header("Location: build.php?id=" . $get['id']);
		}

		/*****************************************
		Function to create an alliance
		*****************************************/
		private function createAlliance($post) {
			global $form, $database, $session, $bid18, $village;
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
				$aid = $database->createAlliance($database->RemoveXSS($post['ally1']), $database->RemoveXSS($post['ally2']), $session->uid, $max);
				$database->updateUserField($database->RemoveXSS($session->uid), "alliance", $database->RemoveXSS($aid), 1);
				// Asign Permissions
				$database->createAlliPermissions($database->RemoveXSS($session->uid), $database->RemoveXSS($aid), 'Alliance founder', '1', '1', '1', '1', '1', '1', '1', '1');
				// log the notice
				$database->insertAlliNotice($aid, 'The alliance has been founded by <a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a>.');
				header("Location: build.php?id=" . $post['id']);
			}
		}

		/*****************************************
		Function to change the alliance name
		*****************************************/
		private function changeAliName($get) {
			global $form, $database, $session;

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
				$database->setAlliName($database->RemoveXSS($session->alliance), $database->RemoveXSS($get['ally2']), $database->RemoveXSS($get['ally1']));
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has changed the alliance name.');
			}
		}

		/*****************************************
		Function to create/change the alliance description
		*****************************************/
		private function updateAlliProfile($post) {
			global $database, $session, $form;
			if($this->userPermArray['opt3'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;
				//header("Location: build.php?id=".$post['id']);
			} else {
				$database->submitAlliProfile($database->RemoveXSS($session->alliance), $database->RemoveXSS($post['be2']), $database->RemoveXSS($post['be1']));
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has changed the alliance description.');
			}
		}

		/*****************************************
		Function to change the user permissions
		*****************************************/
		private function changeUserPermissions($post) {
			global $database, $session, $form;
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
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has changed permissions.');
			}

		}
		/*****************************************
		Function to kick a user from alliance
		*****************************************/
		private function kickAlliUser($post) {
			global $database, $session, $form;

			if($this->userPermArray['opt2'] == 0) {
				$form->addError("perm", NO_PERMISSION);
			}
			if($form->returnErrors() != 0) {
				$_SESSION['errorarray'] = $form->getErrors();
				$_SESSION['valuearray'] = $post;
				//header("Location: build.php?id=".$post['id']);
			} else {
				$database->updateUserField($post['a_user'], 'alliance', 0, 1);
				$database->deleteAlliPermissions($post['a_user']);
				$database->deleteAlliance($session->alliance);
				// log the notice
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> kicked <a href="spieler.php?uid=' . $post['a_user'] . '">' . $UserData['username'] . '</a>.');
				//header("Location: build.php?id=".$post['id']);
			}
		}
		/*****************************************
		Function to set forum link
		*****************************************/
		public function setForumLink($post) {
			global $database, $session;
				if(isset($post['f_link'])){
				$database->setAlliForumLink($session->alliance, $post['f_link']);
				header("Location: allianz.php?s=5");
				}
		}
		/*****************************************
		Function to quit from alliance
		*****************************************/
		private function quitally($post) {
			global $database, $session, $form;
			if(!isset($post['pw']) || $post['pw'] == "") {
				$form->addError("pw1", PW_EMPTY);
			} elseif(md5($post['pw']) !== $session->userinfo['password']) {
				$form->addError("pw2", PW_ERR);
			} else {
				$database->updateUserField($session->uid, 'alliance', 0, 1);
				$database->deleteAlliPermissions($session->uid);
				// log the notice
				$database->deleteAlliance($session->alliance);
				$database->insertAlliNotice($session->alliance, '<a href="spieler.php?uid=' . $session->uid . '">' . $session->username . '</a> has quit the alliance.');
				header("Location: spieler.php?uid=".$session->uid);
			}
		}

		private function changediplomacy($post) {
			global $database, $session, $form;

			$aName = $database->RemoveXSS($_POST['a_name']);
			$aType = (int)intval($_POST['dipl']);
			if($database->aExist($aName, "tag")) {
				if($database->getAllianceID($aName) != $session->alliance) {
					if($aType >= 1 and $aType <= 3) {
						if(!$database->diplomacyInviteCheck($database->getAllianceID($aName), $session->alliance)) {
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
		}
	   }

	   $alliance = new Alliance;

?>
