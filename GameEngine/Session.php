<?php
ob_start(); // Enesure, that no more header already been sent error not showing up again
mb_internal_encoding("UTF-8"); // Add for utf8 varriables.

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Session.php                                                 ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

if(file_exists('GameEngine/config.php') || file_exists('../../GameEngine/config.php') || file_exists('../../config.php') || file_exists('../GameEngine/config.php')) {
}else{
header("Location: install/");
}

$script_name = ($_SERVER['REQUEST_URI'] == 'karte.php') ? 'karte' : $_SERVER['REQUEST_URI'];
include_once ("Battle.php");
include_once ("Data/buidata.php");
include_once ("Data/cp.php");
include_once ("Data/cel.php");
include_once ("Data/resdata.php");
include_once ("Data/unitdata.php");
include_once ("Data/hero_full.php");
include_once ("config.php");
include_once ("Database.php");
include_once ("Mailer.php");
include_once ("Form.php");
include_once ("Generator.php");
include_once ("Multisort.php");
include_once ("Ranking.php");
include_once ("Lang/" . LANG . ".php");
include_once ("Logging.php");
include_once ("Message.php");
include_once ("Alliance.php");
include_once ("Profile.php");

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
				if (!isset($_SESSION)) session_start();

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
                $result = mysql_query("SELECT village_select FROM `". TB_PREFIX."users` WHERE `username`='".$_SESSION['username']."'");
                $dbarray = mysql_fetch_assoc($result);
                $selected_village=$dbarray['village_select'];
                if(!isset($_SESSION['wid'])) {
                    if($selected_village!='') {
                        $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = '.$selected_village);
                    }else{
                        $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $database->getUserField($_SESSION['username'], "id", 1) . ' LIMIT 1');
                    }
                    $data = mysql_fetch_assoc($query);
                    $_SESSION['wid'] = $data['wref'];
                } else
                    if($_SESSION['wid'] == '') {
                        if($selected_village!='') {
                            $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = '.$selected_village);
                        }else{
                            $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $database->getUserField($_SESSION['username'], "id", 1) . ' LIMIT 1');
                        }
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
     				$q3 = "SELECT SUM(t11) from " . TB_PREFIX . "prisoners where `from` = ".$myvill;   // check if hero is prisoner
					$result3 = mysql_query($q3, $database->connection);
					$he3=mysql_fetch_array($result3);
					$hero+=$he3[0];
					$hero+=$database->HeroNotInVil($myvill); // check if hero is not in village (come back from attack , raid , etc.)  
     				}
     				$yes=true; //fix by ronix
            if($database->getHeroDead($this->uid) and !$hero){ // check if hero is already dead
                $yes=false;
            }elseif($database->getHeroInRevive($this->uid) and !$hero){ // check if hero is already in revive
                $yes=false;
            }elseif($database->getHeroInTraining($this->uid) and !$hero){ // check if hero is in training
                $yes=false;
            } 
            if($yes and !$hero) $database->KillMyHero($this->uid);
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
