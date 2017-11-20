<?php
use App\Entity\User;

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

if(!file_exists($autoprefix.'GameEngine/config.php')) {
    header("Location: install/");
    exit;
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

			function __construct() {
        		global $database; //TienTN fix

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
				$user_sanitized = $database->escape($user);
				$_SESSION['checker'] = $generator->generateRandStr(3);
				$_SESSION['mchecker'] = $generator->generateRandStr(5);

                $userFields = $database->getUserFields($user_sanitized, "quest, id", 1, true);
				$_SESSION['qst'] = $userFields["quest"];

				$dbarray = $database->getUserFields($user_sanitized, 'id, village_select', 1);
				$selected_village=(int) $dbarray['village_select'];

				if ($dbarray['id'] > 1) {
                    if(!isset($_SESSION['wid'])) {
                        if($selected_village!='') {
                            $data = $database->getVillage($selected_village);
                        }else{
                            $data = $database->getVillage($userFields["id"]);
                        }
                        $_SESSION['wid'] = $data['wref'];
                    } else
                        if($_SESSION['wid'] == '') {
                            if($selected_village!='') {
                                $data = $database->getVillage($selected_village);
                            }else{
                                $data = $database->getVillage($userFields["id"]);
                            }
                            $_SESSION['wid'] = $data['wref'];
                        }
    				$this->PopulateVar();

    				$database->updateActiveUser($user_sanitized, $this->time);
    				$database->updateUserField($user_sanitized, "sessid", $_SESSION['sessid'], 0);
                }

                $logging->addLoginLog($dbarray['id'], $_SERVER['REMOTE_ADDR']);

                if ($dbarray['id'] == 1) {
				    header("Location: nachrichten.php");
				    exit;
				} else {
				    header("Location: dorf1.php");
				    exit;
				}
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

        		$user = '';
        		$id = '';
        		$admin = false;
        		$inAdmin = (strpos($_SERVER['REQUEST_URI'], '/Admin') !== false);

        		if (!$inAdmin && isset($_SESSION['username'])) {
        		    $user = $_SESSION['username'];
        		    $id   = (int) $_SESSION['id_user'];
        		} else if ($inAdmin && isset($_SESSION['admin_username'])) {
        		    $user  = $_SESSION['admin_username'];
        		    $id    = (int) $_SESSION['id'];
        		    $admin = true;
        		}

        		if($user && ($admin || isset($_SESSION['sessid']))) {
        		    // check if this is not a support user, for who only messages and statistics are available
        		    if ($user == 1) {
        		        $req_file = basename($_SERVER['PHP_SELF']);
        		        if (!in_array($req_file, ['nachrichten.php', 'logout.php', 'statistiken.php', 'rules.php', 'karte.php', 'karte2.php', 'spieler.php'])) {
        		            header('Location:nachrichten.php');
        		            exit;
        		        }
        		    }

        			//Get and Populate Data
        			$this->PopulateVar();
        			//update database
        			$database->updateActiveUser($user, $this->time);
        			$database->updateUserField($user, "timestamp", $this->time, 0);
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
				global $database,$link;

				$villageIDs = implode(', ', $this->villages);
   				$hero = mysqli_fetch_array(
   				    mysqli_query($database->dblink, '
                      SELECT
                        IFNULL((SELECT SUM(hero) from '.TB_PREFIX.'enforcement where `from` IN('.$villageIDs.')), 0) +
                        IFNULL((SELECT SUM(hero) from '.TB_PREFIX.'units where `vref` IN('.$villageIDs.')), 0) +
                        IFNULL((SELECT SUM(t11) from '.TB_PREFIX.'prisoners where `from` IN('.$villageIDs.')), 0) +
                        IFNULL((SELECT SUM(t11) FROM '.TB_PREFIX.'movement, '.TB_PREFIX.'attacks WHERE '.TB_PREFIX.'movement.`from` IN('.$villageIDs.') and '.TB_PREFIX.'movement.ref = '.TB_PREFIX.'attacks.id and '.TB_PREFIX.'movement.proc = 0 and '.TB_PREFIX.'movement.sort_type = 3), 0) +
                        IFNULL((SELECT SUM(t11) FROM '.TB_PREFIX.'movement, '.TB_PREFIX.'attacks where '.TB_PREFIX.'movement.`to` IN('.$villageIDs.') and '.TB_PREFIX.'movement.ref = '.TB_PREFIX.'attacks.id and '.TB_PREFIX.'movement.proc = 0 and '.TB_PREFIX.'movement.sort_type = 4), 0)
                        as herocount'),
                    MYSQLI_ASSOC
                )['herocount'];

                $isHeroElsewhere = $database->getHeroDeadReviveOrInTraining($this->uid);

                if($isHeroElsewhere && !$hero) {
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
						exit;
					}
				} else {
					if(in_array($page, $pagearray)) {
					    if ($this->uid == 1) {
					        header("Location: nachrichten.php");
					        exit;
					    } else {
					        header("Location: dorf1.php");
					        exit;
					    }
					}

				}
			}
};
$session = new Session;
$form = new Form;

// if there is no user, we'd try to load messages for user with ID 0, which is wrong
if (!empty($_SESSION['id_user'])) {
    $message = new Message;

    // create a global user variable which will later be removed from here
    // and created + retrieved either via Service Locator or other DI concept
    $user = new User((int) $_SESSION['id_user'], $database);
}

?>
