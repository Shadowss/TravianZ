<?php
use App\Entity\User;

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

global $autoprefix;

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/Session.php");

class Account {

	function __construct() {
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
			else if(User::exists($database,$_POST['name'])) {
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
			else if(User::exists($database,$_POST['email'])) {
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
            exit;
        }
		else {
			if(AUTH_EMAIL){
			$act = $generator->generateRandStr(10);
			$act2 = $generator->generateRandStr(5);
			$uid = $database->activate($_POST['name'],password_hash($_POST['pw'], PASSWORD_BCRYPT,['cost' => 12]),$_POST['email'],$_POST['vid'],$_POST['kid'],$act,$act2);
				if($uid) {

					$mailer->sendActivate($_POST['email'],$_POST['name'],$_POST['pw'],$act);
					header("Location: activate.php?id=$uid&q=$act2");
					exit;
				}
			}
			else {
			    $uid = $database->register($_POST['name'],password_hash($_POST['pw'], PASSWORD_BCRYPT,['cost' => 12]),$_POST['email'],$_POST['vid'],$act);
				if($uid) {
					setcookie("COOKUSR",$_POST['name'],time()+COOKIE_EXPIRE,COOKIE_PATH);
					setcookie("COOKEMAIL",$_POST['email'],time()+COOKIE_EXPIRE,COOKIE_PATH);
					$database->updateUserField(
						$uid,
                        ["act", "invited"],
                        ["", $_POST['invited']],
                        1
                    );

					$this->generateBase($_POST['kid'],$uid,$_POST['name']);
					header("Location: login.php");
					exit;
				}
			}
		}
	}

	private function Activate() {
		if(START_DATE < date('m/d/Y') or START_DATE == date('m/d/Y') && START_TIME <= date('H:i'))
	   {
			global $database;
			$q = "SELECT act, username, password, email, tribe, kid FROM ".TB_PREFIX."activate where act = '".$database->escape($_POST['id'])."'";
			$result = mysqli_query($GLOBALS['link'],$q);
			$dbarray = mysqli_fetch_array($result);
			if($dbarray['act'] == $_POST['id']) {
				$uid = $database->register($dbarray['username'],$dbarray['password'],$dbarray['email'],$dbarray['tribe'],"");
				if($uid) {
				$database->unreg($dbarray['username']);
				$this->generateBase($dbarray['kid'],$uid,$dbarray['username']);
				header("Location: activate.php?e=2");
				exit;
				}
			}
			else
			{
				header("Location: activate.php?e=3");
				exit;
			}
	   }
	   else
	   {
			header("Location: activate.php");
			exit;
	   }

	}

	private function Unreg() {
		global $database;
		$q = "SELECT password, username FROM ".TB_PREFIX."activate where id = ".(int) $_POST['id'];
		$result = mysqli_query($GLOBALS['link'],$q);
		$dbarray = mysqli_fetch_array($result);
		if(password_verify($_POST['pw'], $dbarray['password'])) {
			$database->unreg($dbarray['username']);
			header("Location: anmelden.php");
			exit;
		}
		else {
			header("Location: activate.php?e=3");
			exit;
		}
	}

	private function Login() {
		global $database,$session,$form;
		$user = $_POST['user'];
		if(!isset($_POST['user']) || $_POST['user'] == "") {
			$form->addError("user",$user);
		}
		else if(!User::exists($database,$_POST['user'])) {
			$form->addError("user",USR_NT_FOUND);
		}
		if(!isset($_POST['pw']) || $_POST['pw'] == "") {
			$form->addError("pw",LOGIN_PASS_EMPTY);
		}
		else if(!$database->login($_POST['user'],$_POST['pw']) && !$database->sitterLogin($_POST['user'],$_POST['pw'])) {
			$form->addError("pw",LOGIN_PW_ERROR);
		}

		$userData = $database->getUserArray($_POST['user'], 0);

		if($userData["act"] != "") {
			$form->addError("activate",$_POST['user']);
		}

		// Vacation mode by Shadow
		if($userData["vac_mode"] == 1 && $userData["vac_time"] > time()) {
    		$form->addError("vacation","Vacation mode is still enabled");
		}

		// Vacation mode by Shadow
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;

			header("Location: login.php");
			exit;
		} else {
    		// Vacation mode by Shadow
    		$database->removevacationmode($userData['id']);
    		// Vacation mode by Shadow
    		if($database->login($_POST['user'],$_POST['pw'])){
    			$database->UpdateOnline("login" ,$_POST['user'],time(),$userData['id']);
    		}else if($database->sitterLogin($_POST['user'],$_POST['pw'])){
    			$database->UpdateOnline("sitter" ,$_POST['user'],time(),$userData['id']);
    		}
    			setcookie("COOKUSR",$_POST['user'],time()+COOKIE_EXPIRE,COOKIE_PATH);
    			$session->login($_POST['user']);
		}
	}

	private function Logout() {
		global $session,$database;
		unset($_SESSION['wid']);
		$database->activeModify(addslashes($session->username),1);
		$database->UpdateOnline("logout") or die(mysqli_error($database->dblink));
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

		$message = new Message();
		$message->sendWelcome($uid,$username);
	}

};
$account = new Account;
?>
