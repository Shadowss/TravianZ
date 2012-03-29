<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Profile.php                                                 ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


class Profile {

	public function procProfile($post) {
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "p1":
				$this->updateProfile($post);
				break;
				case "p3":
				$this->updateAccount($post);
				break;
			}
		}
		if(isset($post['s'])) {
			switch($post['s']) {
			case "4":
				$this->gpack($post);
			break;
			}
		}
	}

	public function procSpecial($get) {
		if(isset($get['e'])) {
			switch($get['e']) {
				case 2:
				$this->removeMeSit($get);
				break;
				case 3:
				$this->removeSitter($get);
				break;
				case 4:
				$this->cancelDeleting($get);
				break;
			}
		}
	}

	private function updateProfile($post) {
		global $database;
		$birthday = $post['jahr'].'-'.$post['monat'].'-'.$post['tag'];
		$database->submitProfile($database->RemoveXSS($post['uid']),$database->RemoveXSS($post['mw']),$database->RemoveXSS($post['ort']),$database->RemoveXSS($birthday),$database->RemoveXSS($post['be2']),$database->RemoveXSS($post['be1']));
		$varray = $database->getProfileVillages($post['uid']);
		for($i=0;$i<=count($varray)-1;$i++) {
			$database->setVillageName($database->RemoveXSS($varray[$i]['wref']),$database->RemoveXSS($post['dname'.$i]));
		}
		header("Location: ?uid=".$post['uid']);
	}

	private function gpack($post) {
		global $database, $session;
		$database->gpack($database->RemoveXSS($session->uid),$database->RemoveXSS($post['custom_url']));
		header("Location: ?uid=".$session->uid);
	}	
	private function updateAccount($post) {
		global $database,$session,$form;
		if($post['pw2'] == $post['pw3']) {
			if($database->login($session->username,$post['pw1'])) {
				$database->updateUserField($post['uid'],"password",md5($post['pw2']),1);
			}
			else {
				$form->addError("pw",LOGIN_PW_ERROR);
			}
		}
		else {
			$form->addError("pw",PASS_MISMATCH);
		}
		if($post['email_alt'] == $session->userinfo['email']) {
			$database->updateUserField($post['uid'],"email",$post['email_neu'],1);
		}
		else {
			$form->addError("email",EMAIL_ERROR);
		}
		if($post['del'] && md5($post['del_pw']) == $session->userinfo['password']) {
			if($database->isAllianceOwner($post['uid'])) {
				$form->addError("del",ALLI_OWNER);
			}
			else {
				$database->setDeleting($post['uid'],0);
			}
		}
		else {
			$form->addError("del",PASS_MISMATCH);
		}
		if($post['v1'] != "") {
			$sitid = $database->getUserField($post['v1'],"id",1);
			if($sitid == $session->userinfo['sit1'] || $sitid == $session->userinfo['sit2']) {
				$form->addError("sit",SIT_ERROR);
			}
			else {
				if($session->userinfo['sit1'] == 0) {
					$database->updateUserField($post['uid'],"sit1",$sitid,1);
				}
				else if($session->userinfo['sit2'] == 0) {
					$database->updateUserField($post['uid'],"sit2",$sitid,1);
				}
			}
		}
		$_SESSION['errorarray'] = $form->getErrors();
		header("Location: spieler.php?s=3");
	}

	private function removeSitter($get) {
		global $database,$session;
		if($get['a'] == $session->checker) {
			if($session->userinfo['sit'.$get['type']] == $get['id']) {
				$database->updateUserField($session->uid,"sit".$get['type'],0,1);
			}
			$session->changeChecker();
		}
		header("Location: spieler.php?s=".$get['s']);
	}

	private function cancelDeleting($get) {
		global $database;
		$database->setDeleting($get['id'],1);
		header("Location: spieler.php?s=".$get['s']);
	}

	private function removeMeSit($get) {
		global $database,$session;
		if($get['a'] == $session->checker) {
			$database->removeMeSit($get['id'],$session->uid);
			$session->changeChecker();
		}
		header("Location: spieler.php?s=".$get['s']);
	}
};
$profile = new Profile;
?>