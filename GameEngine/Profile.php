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
		global $session;
		
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "p1" :
					$this->updateProfile($post);
					break;
				case "p3" :
					$this->updateAccount($post);
					break;
				case "p4" :
					$this->setvactionmode($post);
					break;
			}
		}
		
		if(isset($post['s']) && $post['s'] == 4) $this->gpack($post);
	}

	public function procSpecial($get) {
		global $session;
		
		if(isset($get['e'])) {
			switch($get['e']) {
				case 2 :
					$this->removeMeSit($get);
					break;
				case 3 :
					$this->removeSitter($get);
					break;
				case 4 :
					$this->cancelDeleting($get);
					break;
			}
		}
	}

	private function updateProfile($post) {
		global $database, $session;
		
		$birthday = $post['jahr'].'-'.$post['monat'].'-'.$post['tag'];
		$database->submitProfile($session->uid, $database->RemoveXSS($post['mw']), $database->RemoveXSS($post['ort']), $database->RemoveXSS($birthday), $database->RemoveXSS($post['be2']), $database->RemoveXSS($post['be1']));
		$varray = $database->getProfileVillages($session->uid);
		
		for($i = 0; $i < count($varray); $i++){
			$database->setVillageName($varray[$i]['wref'], $database->RemoveXSS(trim($post['dname'.$i])));
		}
		
		header("Location: spieler.php?uid=".$session->uid);
		exit;
	}

	private function gpack($post) {
		global $database, $session;
		
		$database->gpack($database->RemoveXSS($session->uid),$database->RemoveXSS($post['custom_url']));
		header("Location: spieler.php?uid=".$session->uid);
		exit;
	}
	
	/**
	 * Function to vacation mode - by advocaite and Shadow
	 * 
	 * @param array $post The $_POST array
	 */

	private function setvactionmode($post){
	    global $database, $session, $form;

	    if(isset($post['vac']) && $post['vac'] && isset($post['vac_days']) && $post['vac_days'] >= 2 && $post['vac_days'] <= 14){        
	        unset($_SESSION['wid']);
			$database->setvacmode($session->uid, $post['vac_days']);
			$database->activeModify(addslashes($session->username), 1);
			$database->UpdateOnline("logout");
			$session->Logout();
			header("Location: login.php");
			exit;
	    }else{
	    	$form->add("vac", VAC_MODE_WRONG_DAYS);
	        header("Location: spieler.php?s=".$session->uid);        
	        exit;
	    }
	    
	}

	/**
	 * Function to vacation mode - by advocaite and Shadow
	 * 
	 * @param array $post The $_POST array
	 */

	private function updateAccount($post) {
		global $database, $session, $form;

		if(!empty($post['pw1']) && !empty($post['pw2']) && !empty($post['pw3'])){
			if($post['pw2'] == $post['pw3']){
				if($database->login($session->username, $post['pw1'])){
					$database->updateUserField($session->uid, "password", password_hash($post['pw2'], PASSWORD_BCRYPT, ['cost' => 12]), 1);
				}
				else $form->addError("pw", LOGIN_PW_ERROR);
			}
			else $form->addError("pw", PASS_MISMATCH);
		}

		if(!empty($post['email_alt']) && !empty($post['email_neu'])){
			if($post['email_alt'] == $session->userinfo['email']){
				$database->updateUserField($session->uid, "email", $post['email_neu'], 1);
			}
			else $form->addError("email", EMAIL_ERROR);
		}
		
		if(!empty($post['del_pw']) && $post['del']){
			if(password_verify($post['del_pw'], $session->userinfo['password'])){
				$database->setDeleting($session->uid, 0);
			}
			else $form->addError("del", PASS_MISMATCH);	
		}
		
		if(!empty($post['v1'])){
			$sitid = $database->getUserField($post['v1'], "id", 1);
			if($sitid == $session->userinfo['sit1'] || $sitid == $session->userinfo['sit2']){
				$form->addError("sit", SIT_ERROR);
			}else if($sitid != $session->uid){
				if($session->userinfo['sit1'] == 0){
					$database->updateUserField($session->uid, "sit1", $sitid, 1);
				}else if($session->userinfo['sit2'] == 0){
					$database->updateUserField($session->uid, "sit2", $sitid, 1);
				}
			}
		}
		
		if($form->returnErrors() > 0){
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
		}	
		
		header("Location: spieler.php?s=3");
		exit;
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
		exit;
	}

	private function cancelDeleting($get) {
		global $database, $session;
		
		$database->setDeleting($session->uid,1);
		header("Location: spieler.php?s=".$get['s']);
		exit;
	}

	private function removeMeSit($get) {
		global $database, $session;

		if($get['a'] == $session->checker) {
			$database->removeMeSit($get['id'],$session->uid);
			$session->changeChecker();
		}

		header("Location: spieler.php?s=".$get['s']);
		exit;
	}
};

$profile = new Profile;
?>
