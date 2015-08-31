<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Account.php                                                 ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

include("Session.php");

class Account {

	function Account() {
		global $session;
		if(isset($_POST['ft'])) {
			switch($_POST['ft']) {
				case "a1":
				$this->Signup();
				break;
				case "a2":
				$this->Activate();
				break;
				case "a3":
				$this->Unreg();
				break;
				case "a4":
				$this->Login();
				break;
			}
		} if(isset($_GET['code'])) {
		$_POST['id'] = $_GET['code']; $this->Activate();
		}
		else {
			if($session->logged_in && in_array("logout.php",explode("/",$_SERVER['PHP_SELF']))) {
				$this->Logout();
			}
		}
	}

	private function Signup() {
		global $database,$form,$mailer,$generator,$session;
		if(!isset($_POST['name']) || trim($_POST['name']) == "") {
			$form->addError("name",USRNM_EMPTY);
		}
		else {
			if(strlen($_POST['name']) < USRNM_MIN_LENGTH) {
				$form->addError("name",USRNM_SHORT);
			}
			else if(!USRNM_SPECIAL && preg_match('/[^0-9A-Za-z]/',$_POST['name'])) {
				$form->addError("name",USRNM_CHAR);
			}
			else if(USRNM_SPECIAL && preg_match("/[:,\\. \\n\\r\\t\\s\\<\\>]+/", $_POST['name'])) {
				$form->addError("name",USRNM_CHAR);
			}
			else if($database->checkExist($_POST['name'],0)) {
				$form->addError("name",USRNM_TAKEN);
			}
			else if($database->checkExist_activate($_POST['name'],0)) {
				$form->addError("name",USRNM_TAKEN);
			}

		}
		if(!isset($_POST['pw']) || trim($_POST['pw']) == "") {
			$form->addError("pw",PW_EMPTY);
		}
		else {
			if(strlen($_POST['pw']) < PW_MIN_LENGTH) {
				$form->addError("pw",PW_SHORT);
			}
			else if($_POST['pw'] == $_POST['name']) {
				$form->addError("pw",PW_INSECURE);

			}
		}
		if(!isset($_POST['email'])) {
			$form->addError("email",EMAIL_EMPTY);
		}
		else {
			if(!$this->validEmail($_POST['email'])) {
				$form->addError("email",EMAIL_INVALID);
			}
			else if($database->checkExist($_POST['email'],1)) {
				$form->addError("email",EMAIL_TAKEN);
			}
			else if($database->checkExist_activate($_POST['email'],1)) {
				$form->addError("email",EMAIL_TAKEN);
			}
		}
		if(!isset($_POST['vid'])) {
			$form->addError("tribe",TRIBE_EMPTY);
		}
		if(!isset($_POST['agb'])) {
			$form->addError("agree",AGREE_ERROR);
		}
		if($form->returnErrors() > 0) {
            $form->addError("invt",$_POST['invited']);
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;
            

            header("Location: anmelden.php");
        }
		else {
			if(AUTH_EMAIL){
			$act = $generator->generateRandStr(10);
			$act2 = $generator->generateRandStr(5);
				$uid = $database->activate($_POST['name'],md5($_POST['pw']),$_POST['email'],$_POST['vid'],$_POST['kid'],$act,$act2);
				if($uid) {

					$mailer->sendActivate($_POST['email'],$_POST['name'],$_POST['pw'],$act);
					header("Location: activate.php?id=$uid&q=$act2");
				}
			}
			else {
				$uid = $database->register($_POST['name'],md5($_POST['pw']),$_POST['email'],$_POST['vid'],$act);
				if($uid) {
					setcookie("COOKUSR",$_POST['name'],time()+COOKIE_EXPIRE,COOKIE_PATH);
					setcookie("COOKEMAIL",$_POST['email'],time()+COOKIE_EXPIRE,COOKIE_PATH);
					$database->updateUserField($uid,"act","",1);
					$database->updateUserField($uid,"invited",$_POST['invited'],1);
					$this->generateBase($_POST['kid'],$uid,$_POST['name']);
					header("Location: login.php");
				}
			}
		}
	}

	private function Activate() {
		if(START_DATE < date('m/d/Y') or START_DATE == date('m/d/Y') && START_TIME <= date('H:i'))
	   {
			global $database;
			$q = "SELECT * FROM ".TB_PREFIX."activate where act = '".$_POST['id']."'";
			$result = mysql_query($q, $database->connection);
			$dbarray = mysql_fetch_array($result);
			if($dbarray['act'] == $_POST['id']) {
				$uid = $database->register($dbarray['username'],$dbarray['password'],$dbarray['email'],$dbarray['tribe'],"");
				if($uid) {
				$database->unreg($dbarray['username']);
				$this->generateBase($dbarray['kid'],$uid,$dbarray['username']);
				header("Location: activate.php?e=2");
				}
			}
			else
			{
				header("Location: activate.php?e=3");
			}
	   }
	   else
	   {
			header("Location: activate.php");
	   }

	}

	private function Unreg() {
		global $database;
		$q = "SELECT * FROM ".TB_PREFIX."activate where id = '".$_POST['id']."'";
		$result = mysql_query($q, $database->connection);
		$dbarray = mysql_fetch_array($result);
		if(md5($_POST['pw']) == $dbarray['password']) {
			$database->unreg($dbarray['username']);
			header("Location: anmelden.php");
		}
		else {
			header("Location: activate.php?e=3");
		}
	}

	private function Login() {
		global $database,$session,$form;
		$_POST['user'] = mysql_real_escape_string($_POST['user']);
		if(!isset($_POST['user']) || $_POST['user'] == "") {
			$form->addError("user",LOGIN_USR_EMPTY);
		}
		else if(!$database->checkExist($_POST['user'],0)) {
			$form->addError("user",USR_NT_FOUND);
		}
		if(!isset($_POST['pw']) || $_POST['pw'] == "") {
			$form->addError("pw",LOGIN_PASS_EMPTY);
		}
		else if(!$database->login($_POST['user'],$_POST['pw']) && !$database->sitterLogin($_POST['user'],$_POST['pw'])) {
			$form->addError("pw",LOGIN_PW_ERROR);
		}
		if($database->getUserField($_POST['user'],"act",1) != "") {
			$form->addError("activate",$_POST['user']);
		}
		// Vacation mode by Shadow
		if($database->getUserField($_POST['user'],"vac_mode",1) == 1 && $database->getUserField($_POST['user'],"vac_time",1) > time()) {
		$form->addError("vacation","Vacation mode is still enabled");
		}
		// Vacation mode by Shadow
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;

			header("Location: login.php");
		}
		else {
		$userid = $database->getUserArray($_POST['user'], 0);
		// Vacation mode by Shadow
		$database->removevacationmode($userid['id']);
		// Vacation mode by Shadow
		if($database->login($_POST['user'],$_POST['pw'])){
			$database->UpdateOnline("login" ,$_POST['user'],time(),$userid['id']);
		}else if($database->sitterLogin($_POST['user'],$_POST['pw'])){
			$database->UpdateOnline("sitter" ,$_POST['user'],time(),$userid['id']);
		}
			setcookie("COOKUSR",$_POST['user'],time()+COOKIE_EXPIRE,COOKIE_PATH);
			$session->login($_POST['user']);
		}
	}

	private function Logout() {
		global $session,$database;
		unset($_SESSION['wid']);
		$database->activeModify(addslashes($session->username),1);
		$database->UpdateOnline("logout") or die(mysql_error());
		$session->Logout();
	}

	private function validEmail($email) {
	  $regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
	  if ( !preg_match($regexp, $email) ) {
		   return false;
	  }
	  return true;
	}

	function generateBase($kid,$uid,$username) {
		global $database,$message;
		if($kid == 0) {
			$kid = rand(1,4);
		}
		else{
			$kid = $_POST['kid'];
		}

		$wid = $database->generateBase($kid,0);
		$database->setFieldTaken($wid);
		$database->addVillage($wid,$uid,$username,1);
		$database->addResourceFields($wid,$database->getVillageType($wid));
		$database->addUnits($wid);
		$database->addTech($wid);
		$database->addABTech($wid);
		$database->updateUserField($uid,"access",USER,1);
		$message->sendWelcome($uid,$username);
	}

};
$account = new Account;
?>
