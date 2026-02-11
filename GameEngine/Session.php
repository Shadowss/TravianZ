<?php
use App\Entity\User;

ob_start(); // Enesure, that no more header already been sent error not showing up again
mb_internal_encoding("UTF-8"); // Add for utf8 varriables.

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			                   ##
##  Filename       Session.php                                                 ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       	   ##
##  Fixed by:      InCube - double troops				       				   ##
##  Refactored TravianZ Enterprise Hardened Core by Shadow 					   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       	   ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################

global $autoprefix;

$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
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
    var $username, $uid, $access, $plus, $tribe, $isAdmin, $alliance, $gold, $oldrank, $gpack, $goldclub;
    var $bonus = 0;
    var $bonus1 = 0;
    var $bonus2 = 0;
    var $bonus3 = 0;
    var $bonus4 = 0;
    var $timer = 0;
    var $sharedForums = array();
    var $checker, $mchecker;
    public $userinfo = array();
    private $userarray = array();
    var $villages = array();

    function __construct() {
        global $database;

        $this->time = time();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_regenerate_id(true); // 🔒 Session fixation protection

        $this->logged_in = $this->checkLogin();

        if($this->logged_in && TRACK_USR) {
            $database->updateActiveUser($this->username, $this->time);
        }

        $this->referrer = isset($_SESSION['url']) ? $_SESSION['url'] : "/";
        $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];

        $this->SurfControl();
    }
    public function Login($user) {
        global $database, $generator, $logging;

        if(empty($user)) {
            header("Location: login.php");
            exit;
        }

        $this->logged_in = true;

        $_SESSION['sessid']   = $generator->generateRandID();
        $_SESSION['username'] = $user;
        $_SESSION['checker']  = $generator->generateRandStr(3);
        $_SESSION['mchecker'] = $generator->generateRandStr(5);

        // 🔒 Prepared statement (critical zone)
        $stmt = $database->dblink->prepare(
            "SELECT id, quest, village_select FROM " . TB_PREFIX . "users WHERE username = ? LIMIT 1"
        );
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $dbarray = $result->fetch_assoc();
        $stmt->close();

        if(!$dbarray) {
            $this->Logout();
            header("Location: login.php");
            exit;
        }

        $_SESSION['id_user'] = (int)$dbarray['id'];
        $_SESSION['qst']     = $dbarray['quest'];

        $selected_village = (int)$dbarray['village_select'];

        if(!isset($_SESSION['wid']) || empty($_SESSION['wid'])) {

            if(!empty($selected_village)) {
                $data = $database->getVillage($selected_village);
            } else {
                $data = $database->getVillage($dbarray['id']);
            }

            if(isset($data['wref'])) {
                $_SESSION['wid'] = (int)$data['wref'];
            }
        }

        $this->PopulateVar();

        $database->updateActiveUser($user, $this->time);
        $database->updateUserField($user, "sessid", $_SESSION['sessid'], 0);

        $logging->addLoginLog($dbarray['id'], $_SERVER['REMOTE_ADDR']);

        if ($dbarray['id'] == 1) {
            header("Location: nachrichten.php");
        } else {
            header("Location: dorf1.php");
        }
        exit;
    }

    public function Logout() {
        global $database;

        $this->logged_in = false;

        if(isset($_SESSION['username'])) {
            $database->updateUserField($_SESSION['username'], "sessid", "", 0);
        }

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        session_start();
    }

    public function changeChecker() {
        global $generator;

        $this->checker  = $_SESSION['checker']  = $generator->generateRandStr(3);
        $this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(5);
    }
    private function checkLogin() {
        global $database;

        $user  = '';
        $id    = 0;
        $admin = false;
        $inAdmin = (strpos($_SERVER['REQUEST_URI'], '/Admin') !== false);

        if (!$inAdmin && isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
            $id   = isset($_SESSION['id_user']) ? (int)$_SESSION['id_user'] : 0;
        }
        else if ($inAdmin && isset($_SESSION['admin_username'])) {
            $user  = $_SESSION['admin_username'];
            $id    = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0;
            $admin = true;
        }

        if ($user && ($admin || isset($_SESSION['sessid']))) {

            $this->maintenance();
            $this->isWinner();

            // 🔒 Support restriction hardening
            if ($user === 'Support') {
                $req_file = basename($_SERVER['PHP_SELF']);
                $allowed = array(
                    'nachrichten.php',
                    'logout.php',
                    'statistiken.php',
                    'rules.php',
                    'karte.php',
                    'karte2.php',
                    'spieler.php'
                );

                if (!in_array($req_file, $allowed)) {
                    header('Location: nachrichten.php');
                    exit;
                }
            }

            // Populate user data
            $this->PopulateVar();

            // Ban check
            $this->isBanned();

            $database->updateActiveUser($user, $this->time);

            return true;
        }

        return false;
    }

    /**
     * Ban control
     */
    function isBanned() {
        $current = basename($_SERVER['PHP_SELF']);

        if ($this->access == BANNED &&
            !in_array($current, array('banned.php','nachrichten.php','rules.php'))) {

            header('Location: banned.php');
            exit;
        }
    }

    /**
     * Maintenance control
     */
    function maintenance() {
        $current = basename($_SERVER['PHP_SELF']);

        if (isset($_SESSION['ok']) &&
            $_SESSION['ok'] == 2 &&
            $current != 'maintenance.php') {

            header('Location: maintenance.php');
            exit;
        }
    }

    /**
     * Winner check (WW level 100)
     */
    function isWinner() {
        global $database;

        $requiredPage = basename($_SERVER['PHP_SELF']);

        if ($database->isThereAWinner()) {

            $restricted = array('build.php', 'plus1.php');

            if (in_array($requiredPage, $restricted) ||
                ($requiredPage == 'plus.php' &&
                 isset($_GET['id']) &&
                 is_numeric($_GET['id']) &&
                 (int)$_GET['id'] >= 7)) {

                header('Location: winner.php');
                exit;
            }
        }
    }
    /**
     * Hero integrity verification
     * (Enterprise hardened – logic 1:1)
     */
    function CheckHeroReal() {
        global $database;

        if (!is_array($this->villages) || !count($this->villages)) {
            $this->Logout();
            header('Location: login.php');
            exit;
        }

        // 🔒 sanitize village IDs (critical SQL protection)
        $safeVillageIDs = array();
        foreach ($this->villages as $v) {
            $safeVillageIDs[] = (int)$v;
        }

        $villageIDs = implode(',', $safeVillageIDs);

        $q = "
            SELECT
            IFNULL((SELECT SUM(hero) FROM ".TB_PREFIX."enforcement WHERE `from` IN($villageIDs)),0) +
            IFNULL((SELECT SUM(hero) FROM ".TB_PREFIX."units WHERE `vref` IN($villageIDs)),0) +
            IFNULL((SELECT SUM(t11) FROM ".TB_PREFIX."prisoners WHERE `from` IN($villageIDs)),0) +
            IFNULL((SELECT SUM(t11) FROM ".TB_PREFIX."movement m
                    JOIN ".TB_PREFIX."attacks a ON m.ref = a.id
                    WHERE m.`from` IN($villageIDs)
                    AND m.proc = 0 AND m.sort_type = 3),0) +
            IFNULL((SELECT SUM(t11) FROM ".TB_PREFIX."movement m
                    JOIN ".TB_PREFIX."attacks a ON m.ref = a.id
                    WHERE m.`to` IN($villageIDs)
                    AND m.proc = 0 AND m.sort_type = 4),0)
            AS herocount
        ";

        $res = mysqli_query($database->dblink, $q);
        $row = mysqli_fetch_assoc($res);
        $heroUnitRegisters = isset($row['herocount']) ? (int)$row['herocount'] : 0;

        $isHeroLivingOrRaising = $database->getHeroDeadReviveOrInTraining($this->uid);

        if (!$heroUnitRegisters && $isHeroLivingOrRaising) {
            $database->KillMyHero($this->uid);
        }
    }

    /**
     * Populate session variables (NO LOGIC CHANGE)
     */
    private function PopulateVar() {
        global $database;

        $this->userarray = $this->userinfo =
            $database->getUserArray($_SESSION['username'], 0);

        if (!is_array($this->userarray)) {
            $this->Logout();
            header('Location: login.php');
            exit;
        }

        $this->username   = $this->userarray['username'];
        $this->uid        = $_SESSION['id_user'] = (int)$this->userarray['id'];
        $this->gpack      = $this->userarray['gpack'];
        $this->access     = (int)$this->userarray['access'];
        $this->plus       = ($this->userarray['plus'] > $this->time);
        $this->goldclub   = (int)$this->userarray['goldclub'];
        $this->tribe      = (int)$this->userarray['tribe'];
        $this->isAdmin    = ($this->access >= MODERATOR);
        $this->alliance   = $_SESSION['alliance_user'] = (int)$this->userarray['alliance'];

        $this->checker    = $_SESSION['checker'];
        $this->mchecker   = $_SESSION['mchecker'];

        $this->villages   = $database->getVillagesID($this->uid);
        $this->sit        = $database->GetOnline($this->uid);
        $this->sit1       = (int)$this->userarray['sit1'];
        $this->sit2       = (int)$this->userarray['sit2'];
        $this->cp         = floor($this->userarray['cp']);
        $this->gold       = (int)$this->userarray['gold'];
        $this->oldrank    = (int)$this->userarray['oldrank'];
        $this->sharedForums = $database->getSharedForums($this->uid, $this->alliance);

        $_SESSION['ok'] = $this->userarray['ok'];

        // bonuses
        if ($this->userarray['b1'] > $this->time) $this->bonus1 = 1;
        if ($this->userarray['b2'] > $this->time) $this->bonus2 = 1;
        if ($this->userarray['b3'] > $this->time) $this->bonus3 = 1;
        if ($this->userarray['b4'] > $this->time) $this->bonus4 = 1;

        if (!in_array($this->username, array('Support','Multihunter'))) {
            $this->CheckHeroReal();
        }
    }

    /**
     * Populate attack indicators
     */
    public function populateAttacks() {
        global $database, $village;

        $_SESSION['troops_movement'] = array(
            'scouts' => array(),
            'enforcements' => array(),
            'attacks' => array()
        );

        $troopsMovement = $database->getMovement(3, $village->wid, 0);

        if (is_array($troopsMovement) && count($troopsMovement) > 0) {

            foreach ($troopsMovement as $movement) {

                switch ((int)$movement['attack_type']) {

                    case 1:
                        $_SESSION['troops_movement']['scouts'][] = $movement['to'];
                        break;

                    case 2:
                        $_SESSION['troops_movement']['enforcements'][] = $movement['to'];
                        break;

                    case 3:
                    case 4:
                        $_SESSION['troops_movement']['attacks'][] = $movement['to'];
                        break;
                }
            }
        }
    }
    /**
     * Page access control
     * Enterprise hardened – logic 1:1
     */
    private function SurfControl() {

        if (SERVER_WEB_ROOT) {
            $page = basename($_SERVER['SCRIPT_NAME']);
        } else {
            $explode = explode("/", $_SERVER['SCRIPT_NAME']);
            $page = end($explode);
        }

        $allowedWithoutLogin = array(
            "index.php",
            "anleitung.php",
            "tutorial.php",
            "login.php",
            "activate.php",
            "anmelden.php",
            "xaccount.php"
        );

        if (!$this->logged_in) {

            if (!in_array($page, $allowedWithoutLogin) || $page == "logout.php") {
                header("Location: login.php");
                exit;
            }

        } else {

            if (in_array($page, $allowedWithoutLogin)) {

                if ($this->uid == 1) {
                    header("Location: nachrichten.php");
                } else {
                    header("Location: dorf1.php");
                }
                exit;
            }
        }
    }

} // END CLASS

$session = new Session();
$form    = new Form();

/**
 * Message + User init
 * Enterprise safe instantiation
 */

if (!empty($_SESSION['id_user']) && is_numeric($_SESSION['id_user'])) {

    $message = new Message();

    // Safe casting
    $user = new User((int)$_SESSION['id_user'], $database);
}

