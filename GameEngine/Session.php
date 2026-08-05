<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Session.php                      	                       ##
##  Type           : Session System Backend                                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

use App\Entity\User;

ob_start();
mb_internal_encoding("UTF-8");

global $autoprefix;

/**
 * Auto-detect root path (max 5 levels up)
 */
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

if (!file_exists($autoprefix . 'GameEngine/config.php')) {
    header("Location: install/");
    exit;
}

$script_name = ($_SERVER['REQUEST_URI'] == 'karte.php') ? 'karte' : $_SERVER['REQUEST_URI'];

include_once("Battle.php");
include_once("Data/buidata.php");
include_once("Data/cp.php");
include_once("Data/cel.php");
include_once("Data/festival.php");
include_once("Data/resdata.php");
include_once("Data/unitdata.php");
include_once("Data/hero_full.php");
include_once("config.php");
include_once("Database.php");
include_once("Mailer.php");
include_once("Form.php");
include_once("Generator.php");
include_once("Multisort.php");
include_once("Ranking.php");
require_once __DIR__ . "/Lang/loader.php";
tz_load_language(LANG);
include_once("Logging.php");
include_once("Message.php");
include_once("Alliance.php");
include_once("Profile.php");

class Session {

    private $time;
	private $populated = false;
    var $logged_in = false;
    var $inAdmin = false;
    var $referrer, $url;
    var $username, $uid, $access, $plus, $tribe, $isAdmin, $alliance, $gold, $oldrank, $gpack, $goldclub;

    var $bonus = 0;
    var $bonus1 = 0;
    var $bonus2 = 0;
    var $bonus3 = 0;
    var $bonus4 = 0;

    var $timer = 0;
    var $sharedForums = [];

    var $checker, $mchecker;

    public $userinfo = [];
    private $userarray = [];

    var $villages = [];
	var $sit;
	var $sit1;
	var $sit2;
	var $cp;
function __construct() {
    global $database;

    $this->time = time();

    if (!isset($_SESSION)) {
        /**
         * FIX SECURITATE (CSRF): cookie-ul de sesiune nu avea SameSite, deci
         * era trimis si la cereri pornite de pe alte site-uri. Panoul de admin
         * avea deja 'Strict' (vezi Admin/admin.php); jocul, nu.
         *
         * Folosim 'Lax', nu 'Strict': cu Strict, un jucator care intra pe link
         * din forum sau dintr-un e-mail ar aparea delogat. Lax pastreaza
         * navigarea normala si opreste cererile POST venite din alta parte.
         */
        if (PHP_VERSION_ID >= 70300) {
            session_set_cookie_params(array(
                'lifetime' => 0,
                'path'     => '/',
                'secure'   => !empty($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Lax',
            ));
        }

        session_start();
    }

    $this->logged_in = $this->checkLogin();

    // users.timestamp nu mai e optional: din el se scot lista de jucatori
    // online, harta de caldura si stergerea conturilor inactive. Inainte era
    // in spatele lui TRACK_USR - cu flagul stins, stergerea automata ar fi
    // considerat TOTI jucatorii inactivi.
    if ($this->logged_in) {
        $database->updateActiveUser($this->username, $this->time);
    }

    // aici se seteaza access-ul in checkLogin, dar sa fim siguri
    if(!isset($this->access)) {
        $this->access = $this->logged_in ? $database->getUserField($this->uid, "access", 1) : 0;
    }

    // === IP BAN ENFORCEMENT (issue #185) - DUPA ce avem access ===
    // Admins / Multihunters are never blocked by an IP ban (avoid self-lockout).
    // The admin panel (Admin/admin.php) does not bootstrap Session, so it stays reachable.
    if ((int)$this->access < (defined('MULTIHUNTER') ? MULTIHUNTER : 8)) {
        \App\Utils\IpResolver::enforce($database);
    }

    // === MAINTENANCE CHECK - DUPA ce avem access ===
    $maint = $database->getMaintenance();
    if($maint['active'] == 1 && $this->access < 9) {
        // evita loop infinit
        if(strpos($_SERVER['PHP_SELF'], 'maintenance.php') === false) {
            header('Location: maintenance.php');
            exit;
        }
    }

    // === DEBUG ERROR LOG (admin-controlled, transparent to players) ===
    // When enabled from the admin panel, capture the selected PHP errors of
    // every player into var/log/debug-players.log. Auto-disables itself after
    // the configured window so a forgotten debug session cannot run forever.
    $dbg = $database->getDebugMode();
    if (!empty($dbg['active'])) {
        $autoOff = (int)($dbg['auto_off_hours'] ?? 0);
        if ($autoOff > 0 && !empty($dbg['started_at'])
            && ($dbg['started_at'] + $autoOff * 3600) < $this->time) {
            $database->setDebugMode(0, $this->uid ?? 0);
        } else {
            \App\Utils\DebugErrorLogger::enable($dbg, $this->uid ?? 0, $this->username ?? '');
        }
    }

    $this->referrer = $_SESSION['url'] ?? "/";
    $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];

    $this->SurfControl();
}

    /**
     * LOGIN USER
     */
    public function Login($user) {
        global $database, $generator, $logging;

        $this->logged_in = true;

        $_SESSION['sessid'] = $generator->generateRandID();
        $_SESSION['username'] = $user;

        $user_sanitized = $database->escape($user);

        /**
         * FIX SECURITATE (CSRF): token-urile aveau 3 si 5 caractere.
         *
         * 3 caractere = 62^3 = 238.328 combinatii, adica se pot incerca toate
         * in sub o ora, fara nicio limitare de rata. Cu 32 de caractere ajung
         * la 62^32 - imposibil de ghicit.
         *
         * Generatorul folosea deja random_int(), care e sigur criptografic;
         * problema era doar lungimea.
         */
        $_SESSION['checker'] = $generator->generateRandStr(32);
        $_SESSION['mchecker'] = $generator->generateRandStr(32);

        $userFields = $database->getUserFields($user_sanitized, "quest, id", 1, true);
        $_SESSION['qst'] = $userFields["quest"];

        $dbarray = $database->getUserFields($user_sanitized, 'id, village_select', 1);
        $selected_village = (int)$dbarray['village_select'];

        if ($dbarray['id'] > 1) {

            if (!isset($_SESSION['wid']) || empty($_SESSION['wid'])) {

                if (!empty($selected_village)) {
                    $data = $database->getVillage($selected_village);
                } else {
                    $data = $database->getVillage($userFields["id"]);
                }

                $_SESSION['wid'] = isset($data['wref']) ? (int)$data['wref'] : 0;
            }

            $this->logged_in = true;
			$this->PopulateVar(); // only once, controlled by flag

            $database->updateActiveUser($user_sanitized, $this->time);
            $database->updateUserField($user_sanitized, "sessid", $_SESSION['sessid'], 0);
        }

        $logging->addLoginLog($dbarray['id'], \App\Utils\IpResolver::getClientIp() ?? ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'));

        // Multi-account detection: record this login's fingerprint (IP + User-Agent).
        // Best-effort — MultiAccount::recordSession() swallows all errors so it can
        // never block a login, and it self-creates its table on first use.
        MultiAccount::recordSession(
            $dbarray['id'],
            \App\Utils\IpResolver::getClientIp() ?? ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'),
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        );

        if ($dbarray['id'] == 1) {
            header("Location: nachrichten.php");
            exit;
        }

        header("Location: dorf1.php");
        exit;
    }

    /**
     * LOGOUT
     */
    public function Logout() {
        global $database;

        $this->logged_in = false;

        $database->updateUserField($_SESSION['username'], "sessid", "", 0);

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        session_start();
    }

    public function changeChecker() {
        global $generator;

        // 32 de caractere: vezi explicatia de la generarea initiala.
        $this->checker = $_SESSION['checker'] = $generator->generateRandStr(32);
        $this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(32);
    }

    /**
     * LOGIN CHECK
     */
    private function checkLogin() {
        global $database;

        $user = '';
        $admin = false;

        $inAdmin = (strpos($_SERVER['REQUEST_URI'], '/Admin') !== false);
        $this->inAdmin = $inAdmin;

        if (!$inAdmin && isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
        } elseif ($inAdmin && isset($_SESSION['admin_username'])) {
            $user = $_SESSION['admin_username'];
            $admin = true;
        }

        if ($user && ($admin || isset($_SESSION['sessid']))) {

            $this->maintenance();
            $this->isWinner();

            if ($user == 'Support') {
                $req_file = basename($_SERVER['PHP_SELF']);

                if (!in_array($req_file, [
                    'nachrichten.php', 'logout.php', 'statistiken.php',
                    'rules.php', 'karte.php', 'karte2.php', 'spieler.php'
                ])) {
                    header('Location: nachrichten.php');
                    exit;
                }
            }

            if (!$this->logged_in) {
			$this->PopulateVar();
			}
            $this->isBanned();

            $database->updateActiveUser($user, $this->time);

            return true;
        }

        return false;
    }

    function isBanned() {
        if ($this->access == BANNED &&
            !in_array(basename($_SERVER['PHP_SELF']), ['banned.php', 'nachrichten.php', 'rules.php'])) {

            header('Location: banned.php');
            exit;
        }
    }

    function maintenance() {
        if (($_SESSION['ok'] ?? null) == 2 &&
            basename($_SERVER['PHP_SELF']) != 'maintenance.php') {

            header('Location: maintenance.php');
            exit;
        }
    }

    /**
     * FIXED: winner condition bug (safe parentheses + logic)
     */
    function isWinner() {
        global $database;

        $requiredPage = basename($_SERVER['PHP_SELF']);

        $idParam = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if (
            $database->isThereAWinner() &&
            (
                in_array($requiredPage, ['build.php', 'plus1.php']) ||
                (
                    $requiredPage === 'plus.php' && $idParam >= 7
                )
            )
        ) {
            header('Location: winner.php');
            exit;
        }
    }

    /**
     * HERO CHECK (SAFE)
     */
    function CheckHeroReal() {
        global $database;

        $villageIDs = implode(', ', $this->villages);

        if (!count($this->villages)) {
            $this->Logout();
            header('Location: login.php');
            exit;
        }

        // Constantele de miscare pentru aventuri sunt definite in
        // Data/hero_items.php, care se incarca doar la nevoie (din HeroItems,
        // HeroAdventure etc.). Sesiunea poate rula inaintea lor, asa ca luam
        // valorile cu rezerva in loc sa presupunem ca exista.
        $advOut  = defined('MOVEMENT_ADVENTURE_OUT')  ? (int) MOVEMENT_ADVENTURE_OUT  : 20;
        $advBack = defined('MOVEMENT_ADVENTURE_BACK') ? (int) MOVEMENT_ADVENTURE_BACK : 21;

        // Partea de aventuri se adauga DOAR cu functiile T4 pornite: pe un
        // server care nu a rulat migrarea, tabela hero_adventure nu exista, iar
        // o interogare esuata ar face herocount null - adica exact efectul pe
        // care il reparam aici (eroul declarat disparut si ucis).
        $adventureTerms = '';

        if (defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4) {
            $adventureTerms = '
                +
                IFNULL((SELECT COUNT(*) FROM ' . TB_PREFIX . 'movement
                    WHERE ' . TB_PREFIX . 'movement.proc = 0
                    AND ((' . TB_PREFIX . 'movement.sort_type = ' . $advOut . '
                          AND ' . TB_PREFIX . 'movement.`from` IN(' . $villageIDs . '))
                      OR (' . TB_PREFIX . 'movement.sort_type = ' . $advBack . '
                          AND ' . TB_PREFIX . 'movement.`to` IN(' . $villageIDs . ')))), 0)
                +
                IFNULL((SELECT COUNT(*) FROM ' . TB_PREFIX . 'hero_adventure
                    WHERE uid = ' . (int) $this->uid . ' AND status = 1), 0)';
        }

        $q = '
            SELECT
                IFNULL((SELECT SUM(hero) FROM ' . TB_PREFIX . 'enforcement WHERE `from` IN(' . $villageIDs . ')), 0) +
                IFNULL((SELECT SUM(hero) FROM ' . TB_PREFIX . 'units WHERE `vref` IN(' . $villageIDs . ')), 0) +
                IFNULL((SELECT SUM(t11) FROM ' . TB_PREFIX . 'prisoners WHERE `from` IN(' . $villageIDs . ')), 0) +
                IFNULL((SELECT SUM(t11) FROM ' . TB_PREFIX . 'movement, ' . TB_PREFIX . 'attacks
                    WHERE ' . TB_PREFIX . 'movement.`from` IN(' . $villageIDs . ')
                    AND ' . TB_PREFIX . 'movement.ref = ' . TB_PREFIX . 'attacks.id
                    AND ' . TB_PREFIX . 'movement.proc = 0
                    AND ' . TB_PREFIX . 'movement.sort_type = 3), 0) +
                IFNULL((SELECT SUM(t11) FROM ' . TB_PREFIX . 'movement, ' . TB_PREFIX . 'attacks
                    WHERE ' . TB_PREFIX . 'movement.`to` IN(' . $villageIDs . ')
                    AND ' . TB_PREFIX . 'movement.ref = ' . TB_PREFIX . 'attacks.id
                    AND ' . TB_PREFIX . 'movement.proc = 0
                    AND ' . TB_PREFIX . 'movement.sort_type = 4), 0)' . $adventureTerms . '
                AS herocount';

        $heroUnitRegisters = mysqli_fetch_array(
            mysqli_query($database->dblink, $q),
            MYSQLI_ASSOC
        )['herocount'];

        $isHeroLivingOrRaising = $database->getHeroDeadReviveOrInTraining($this->uid);

        if (!$heroUnitRegisters && $isHeroLivingOrRaising) {
            $database->KillMyHero($this->uid);
        }
    }

    /**
     * POPULATE USER DATA
     */
    private function PopulateVar() {
        global $database;
		
	// prevent double execution per request
    if ($this->populated) {
        return;
    }

    $this->populated = true;	
		
	// -----------------------------
	// SIMPLE SESSION CACHE LAYER
	// -----------------------------
	$cacheKeyUser = 'cache_user_' . $_SESSION['username'];
	$cacheKeyVillages = 'cache_villages_' . ($_SESSION['id_user'] ?? 0);

	// TTL simplu (secunde)
	$ttl = 30;
        
	// USER CACHE
	if (!isset($_SESSION[$cacheKeyUser]) || (time() - $_SESSION[$cacheKeyUser]['time'] > $ttl)) {
    $_SESSION[$cacheKeyUser] = [
        'time' => time(),
        'data' => $database->getUserArray($_SESSION['username'], 0)
    ];
	}
		$this->userarray = $this->userinfo = $_SESSION[$cacheKeyUser]['data'];

        // Per-user language (issue #166): seed the session language from the
        // player's saved preference (users.lang) the first time, e.g. right
        // after login. Once set, the profile "save preferences" page keeps it
        // up to date, so we don't overwrite it here (also avoids reverting to
        // a stale value from the 30s user cache above).
        if (empty($_SESSION['lang']) && !empty($this->userarray['lang'])) {
            $_SESSION['lang'] = $this->userarray['lang'];
        }

        $this->username = $this->userarray['username'];
        $this->uid = $_SESSION['id_user'] = $this->userarray['id'];

        $this->gpack = $this->userarray['gpack'];

        // Pachetul grafic ales de jucator ajunge in sesiune, exact ca limba de
        // mai sus: config.php se incarca INAINTE de a exista o conexiune la baza
        // de date, deci singurul mod de a-i spune ce pachet vrea jucatorul este
        // prin sesiune. Fara asta, GP_LOCATE ramanea mereu pachetul serverului,
        // oricat de des si-l schimba jucatorul din profil.
        $_SESSION['gpack'] = (string) $this->userarray['gpack'];
        $this->access = $this->userarray['access'];
        $this->plus = ($this->userarray['plus'] > $this->time);
        $this->goldclub = $this->userarray['goldclub'];

     // VILLAGES CACHE
	if (!isset($_SESSION[$cacheKeyVillages]) || (time() - $_SESSION[$cacheKeyVillages]['time'] > $ttl)) {
    $_SESSION[$cacheKeyVillages] = [
        'time' => time(),
        'data' => $database->getVillagesID($this->uid)
    ];
	}
		$this->villages = $_SESSION[$cacheKeyVillages]['data'];

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

        $this->sharedForums = $database->getSharedForums($this->uid, $this->alliance);

        $_SESSION['ok'] = $this->userarray['ok'];

        if ($this->userarray['b1'] > $this->time) $this->bonus1 = 1;
        if ($this->userarray['b2'] > $this->time) $this->bonus2 = 1;
        if ($this->userarray['b3'] > $this->time) $this->bonus3 = 1;
        if ($this->userarray['b4'] > $this->time) $this->bonus4 = 1;

        if (!in_array($this->username, ['Support', 'Multihunter'])) {
            $this->CheckHeroReal();
        }
    }

    /**
     * ATTACKS CACHE (SESSION)
     */
    public function populateAttacks() {
        global $database, $village;

        $troopsMovement = $database->getMovement(3, $village->wid, 0);

        if (count($troopsMovement) > 0) {
            foreach ($troopsMovement as $movement) {

                switch ($movement['attack_type']) {
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
     * SURF CONTROL (ROUTING SAFE)
     */
    private function SurfControl() {

        // Bug fix: GameEngine/Admin/Mods/*.php scripts (addUsers.php, gold.php,
        // cp.php, editResources.php, ...) are POSTed to directly and already
        // enforce their own access-level guard (access >= 9) plus CSRF. They
        // are not "pages" in the player-facing $pagearray sense below, and
        // routing them through this player login/page-redirect logic sent
        // them to a relative "login.php" that resolved under
        // GameEngine/Admin/Mods/ instead of the site root -> 404, regardless
        // of whether the admin session was actually valid.
        if ($this->inAdmin) {
            return;
        }

        $page = SERVER_WEB_ROOT
            ? $_SERVER['SCRIPT_NAME']
            : basename($_SERVER['SCRIPT_NAME']);

        $pagearray = [
            "index.php", "anleitung.php", "tutorial.php",
            "login.php", "activate.php", "anmelden.php", "xaccount.php"
        ];

        if (!$this->logged_in) {
            if (!in_array($page, $pagearray) || $page == "logout.php") {
                header("Location: login.php");
                exit;
            }
        } else {
            if (in_array($page, $pagearray)) {

                if (($this->uid ?? 0) == 1) {
                    header("Location: nachrichten.php");
                    exit;
                }

                header("Location: dorf1.php");
                exit;
            }
        }
    }
}

$session = new Session;
$form = new Form;

if (!empty($_SESSION['id_user'])) {
    $message = new Message;
    $user = new User((int)$_SESSION['id_user'], $database);
}
?>
