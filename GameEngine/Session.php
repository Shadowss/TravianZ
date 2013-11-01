<?php
ob_start(); // Enesure, that no more header already been sent error not showing up again
mb_internal_encoding("UTF-8"); // Add for utf8 varriables.

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                        		       	       ##
##  Version:       01.09.2013 						       ##
##  Filename       Session.ph   p                                              ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow  	       ##
##  Fixed by:      Shadow - Doubleing Troops , STARVATION , HERO FIXED COMPL.  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       ##
##                                                                             ##
#################################################################################

if(!file_exists('GameEngine/config.php') && !file_exists('../../GameEngine/config.php') && !file_exists('../../config.php')) {
header("Location: install/");
}

$script_name = ($_SERVER['REQUEST_URI'] == 'karte.php') ? 'karte' : $_SERVER['REQUEST_URI'];
include ("Battle.php");
include ("Data/buidata.php");
include ("Data/cp.php");
include ("Data/cel.php");
include ("Data/resdata.php");
include ("Data/unitdata.php");
include ("Data/hero_full.php");
include ("config.php");
include ("Database.php");
include ("Mailer.php");
include ("Form.php");
include ("Generator.php");
include ("Multisort.php");
include ("Ranking.php");
include ("Automation.php");
include ("Lang/" . LANG . ".php");
include ("Logging.php");
include ("Message.php");
include ("Alliance.php");
include ("Profile.php");

class Session {

			private $time;
			var $logged_in = false;
			var $referrer, $url;
			var $username, $uid, $access, $plus, $tribe, $isAdmin, $alliance, $gold, $oldrank, $gpack;
			var $bonus = 0;
			var $bonus1 = 0;
			var $bonus2 = 0;
			var $bonus3 = 0;
			var $bonus4 = 0;
			var $checker, $mchecker;
			public $userinfo = array();
			private $userarray = array();
			var $villages = array();

			function Session() {
				$this->time = time();
				session_start();

				$this->logged_in = $this->checkLogin();

				if($this->logged_in && TRACK_USR) {
					$database->updateActiveUser($this->username, $this->time);
				}
				if(isset($_SESSION['url'])) {
					$this->referrer = $_SESSION['url'];
				} else {
					$this->referrer = "/";
				}
				$this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
				$this->SurfControl();
			}

			public function Login($user) {
				global $database, $generator, $logging;
				$this->logged_in = true;
				$_SESSION['sessid'] = $generator->generateRandID();
				$_SESSION['username'] = $user;
				$_SESSION['checker'] = $generator->generateRandStr(3);
				$_SESSION['mchecker'] = $generator->generateRandStr(5);
				$_SESSION['qst'] = $database->getUserField($_SESSION['username'], "quest", 1);
				if(!isset($_SESSION['wid'])) {
					$query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $database->getUserField($_SESSION['username'], "id", 1) . ' LIMIT 1');
					$data = mysql_fetch_assoc($query);
					$_SESSION['wid'] = $data['wref'];
				} else
					if($_SESSION['wid'] == '') {
						$query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $database->getUserField($_SESSION['username'], "id", 1) . ' LIMIT 1');
						$data = mysql_fetch_assoc($query);
						$_SESSION['wid'] = $data['wref'];
					}
				$this->PopulateVar();

				$logging->addLoginLog($this->uid, $_SERVER['REMOTE_ADDR']);
				$database->addActiveUser($_SESSION['username'], $this->time);
				$database->updateUserField($_SESSION['username'], "sessid", $_SESSION['sessid'], 0);

				header("Location: dorf1.php");
			}

			public function Logout() {
				global $database;
				$this->logged_in = false;
				$database->updateUserField($_SESSION['username'], "sessid", "", 0);
				if(ini_get("session.use_cookies")) {
					$params = session_get_cookie_params();
					setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
				}
				session_destroy();
				session_start();
			}

			public function changeChecker() {
				global $generator;
				$this->checker = $_SESSION['checker'] = $generator->generateRandStr(3);
				$this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(5);
			}

			private function checkLogin(){
                		global $database;
                		if(isset($_SESSION['username']) && isset($_SESSION['sessid'])) {
                    			//Get and Populate Data
                    			$this->PopulateVar();
                    			//update database
                    			$database->addActiveUser($_SESSION['username'], $this->time);
                    			$database->updateUserField($_SESSION['username'], "timestamp", $this->time, 0);
                        		return true;
                		} else {
                    			return false;
                		}
            		}
			

			/***************************
			Function to check Real Hero
			Made by: Shadow and brainiacX
			***************************/

 			function CheckHeroReal () {
				global $database;
   				$hero=0;
    			foreach($this->villages as $myvill){
     				$q1 = "SELECT SUM(hero) from " . TB_PREFIX . "enforcement where `from` = ".$myvill;       // check if hero is send as reinforcement
     				$result1 = mysql_query($q1, $database->connection);
     				$he1=mysql_fetch_array($result1);
     				$hero+=$he1[0];
     				$q2 = "SELECT SUM(hero) from " . TB_PREFIX . "units where `vref` = ".$myvill;   // check if hero is on my account (all villages)
     				$result2 = mysql_query($q2, $database->connection);
     				$he2=mysql_fetch_array($result2);
     				$hero+=$he2[0];
     				$hero+=$database->HeroNotInVil($myvill); // check if hero is not in village (come back from attack , raid , etc.)
     				}
     				if(!$database->getHeroDead($this->uid) and !$hero){ // check if hero is already dead
					}elseif(!$database->getHeroInRevive($this->uid) and !$hero){ // check if hero is already in revive
					}elseif(!$database->getHeroInTraining($this->uid) and !$hero){ // check if hero is in training
      				$database->KillMyHero($this->uid);
				} 
     		}

			private function PopulateVar() {
				global $database;
				$this->userarray = $this->userinfo = $database->getUserArray($_SESSION['username'], 0);
				$this->username = $this->userarray['username'];
				$this->uid = $_SESSION['id_user'] =  $this->userarray['id'];
				$this->gpack = $this->userarray['gpack'];
				$this->access = $this->userarray['access'];
				$this->plus = ($this->userarray['plus'] > $this->time);
				$this->goldclub = $this->userarray['goldclub'];
				$this->villages = $database->getVillagesID($this->uid);
				$this->tribe = $this->userarray['tribe'];
				$this->isAdmin = $this->access >= MODERATOR;
				$this->alliance = $_SESSION['alliance_user'] = $this->userarray['alliance'];
				$this->checker = $_SESSION['checker'];
				$this->mchecker = $_SESSION['mchecker'];
				$this->sit = $database->GetOnline($this->uid);
				$this->sit1 = $this->userarray['sit1'];
				$this->sit2 = $this->userarray['sit2'];
				$this->cp = floor($this->userarray['cp']);
				$this->gold = $this->userarray['gold'];
				$this->oldrank = $this->userarray['oldrank'];
				$_SESSION['ok'] = $this->userarray['ok'];
				if($this->userarray['b1'] > $this->time) {
					$this->bonus1 = 1;
				}
				if($this->userarray['b2'] > $this->time) {
					$this->bonus2 = 1;
				}
				if($this->userarray['b3'] > $this->time) {
					$this->bonus3 = 1;
				}
				if($this->userarray['b4'] > $this->time) {
					$this->bonus4 = 1;
				}
                                $this->CheckHeroReal();
			}

			private function SurfControl(){
				if(SERVER_WEB_ROOT) {
					$page = $_SERVER['SCRIPT_NAME'];
				} else {
					$explode = explode("/", $_SERVER['SCRIPT_NAME']);
					$i = count($explode) - 1;
					$page = $explode[$i];

				}
				$pagearray = array("index.php", "anleitung.php", "tutorial.php", "login.php", "activate.php", "anmelden.php", "xaccount.php");
				if(!$this->logged_in) {
					if(!in_array($page, $pagearray) || $page == "logout.php") {
						header("Location: login.php");
					}
				} else {
					if(in_array($page, $pagearray)) {
						header("Location: dorf1.php");
					}

				}
			}
};
$session = new Session;
$form = new Form;
$message = new Message;

?>
