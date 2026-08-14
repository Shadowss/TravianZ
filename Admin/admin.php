<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       05.03.2026                                                  ##
##  Filename:      Admin/admin.php                                             ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

// ─── SESSION ─────────────────────────────────────────────────────────────────
// Harden session cookie before session_start() — has no effect after.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

// ─── CSRF PROTECTION ──────────────────────────────────────────────────────────
// Token init + csrf_token()/csrf_field()/csrf_verify() helpers, shared with the
// admin Mods (which are POSTed to directly). See GameEngine/Admin/csrf.php.
include_once("../GameEngine/Admin/csrf.php");

// ─── CORE INCLUDES ───────────────────────────────────────────────────────────
include_once("../GameEngine/config.php");
include_once("../GameEngine/Database.php");
require_once __DIR__ . "/../GameEngine/Lang/loader.php";
tz_load_language(LANG);
include_once("../GameEngine/Admin/database.php");

// Helperul care descopera pachetele grafice din gpack/ (tz_available_gpacks).
// Sabloanele panoului il folosesc pentru selectorul de pachet; fara acest
// include, functia nu exista la randare si lista arata doar pachetul curent.
include_once("../GameEngine/Admin/Mods/config_template.php");
include_once("../GameEngine/Data/buidata.php");
include_once("../GameEngine/Artifacts.php");
include_once("../GameEngine/MultiAccount.php");
include_once("../GameEngine/PushProtection.php");
include_once("../GameEngine/RegBlock.php");
include_once("../GameEngine/Heatmap.php");
include_once("../GameEngine/GoldShop.php");
include_once("../GameEngine/QuestConfig.php");

// ─── SECURITY HELPERS ────────────────────────────────────────────────────────

/**
 * Return a sanitised integer from a superglobal key, or null if missing/invalid.
 * Replaces direct (int) casts on $_GET inside switch — ensures 0 is treated as
 * absent (IDs are always >= 1 in TravianZ).
 */
function admin_input_id(array $source, string $key): ?int
{
    if (!isset($source[$key]) || !ctype_digit((string)$source[$key])) {
        return null;
    }
    $v = (int)$source[$key];
    return $v > 0 ? $v : null;
}

/**
 * HTML-escape a value for safe output inside HTML attributes or text nodes.
 */
function e(string $value): string
{
    // decode first prevents &amp;#39; / &#39; double encoding
    return htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'),
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}
/**
 * Whitelist-validate the ?p= parameter.
 * Returns the validated page string, or '' if not in the whitelist.
 *
 * SECURITY: This is the primary defence against path-traversal in the
 * include('Templates/'.$p.'.tpl') call below. Only values present in this
 * array are ever passed to include().
 */
function admin_validated_page(string $raw): string
{
    static $whitelist = [
        'server_info', 'online', 'notregistered', 'inactive', 'report',
        'message', 'massmessage', 'sysmessage', 'map', 'map_tile', 'natars',
        'search', 'ban', 'maintenance', 'cleanban', 'gold', 'usergold',
        'maintenenceResetGold', 'delmedal', 'delallymedal', 'givePlus',
        'maintenenceResetPlus', 'givePlusRes', 'maintenenceResetPlusBonus',
        'addUsers', 'users', 'admin_log', 'config', 'debug_log',
        'editServerSet', 'editPlusSet', 'editLogSet', 'editNewsboxSet',
        'editCronSet',
        'editExtraSet', 'editAdminInfo', 'resetServer', 'player', 'editUser',
        'deletion', 'Newmessage', 'editPlus', 'editSitter', 'editPassword',
        'editProtection', 'editOverall',
        'editWeek', 'userlogin', 'userillegallog', 'editHero', 'editHeroT4', 'editAdditional',
        'village', 'editResources', 'addTroops', 'addABTroops', 'editVillage',
        'villagelog', 'techlog', 'msg',
        'alliance', 'editAli', 'delAli','editNewFunctions',
        'multiacc',
        'pushprot',
        'blockReg',
        'heatmap',
        'goldShop',
        'questEditor',
    ];

    return in_array($raw, $whitelist, true) ? $raw : '';
}

// CSRF helpers — csrf_token() / csrf_field() / csrf_verify() — are defined in
// GameEngine/Admin/csrf.php (included above), shared with the admin Mods.

/**
 * Look up a user row by ID using a prepared statement.
 * Replaces the two raw mysqli_query() calls for userlogin / userillegallog.
 *
 * Returns the associative row, or null on failure / not found.
 */
function admin_get_user_by_id(int $uid): ?array
{
    $link = $GLOBALS['link'];
    $stmt = mysqli_prepare($link, "SELECT * FROM `" . TB_PREFIX . "users` WHERE `id` = ?");
    if (!$stmt) {
        return null;
    }
    mysqli_stmt_bind_param($stmt, 'i', $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row    = $result ? mysqli_fetch_assoc($result) : null;
    mysqli_stmt_close($stmt);
    return $row ?: null;
}

// ─── PAGE ROUTING ─────────────────────────────────────────────────────────────
// Read and whitelist the ?p= parameter once; all branching below uses $page.
$rawPage = isset($_GET['p']) ? trim((string)$_GET['p']) : '';
$page    = admin_validated_page($rawPage);

$subpage               = 'Login';
$not_include_mootools_js = false;

if ($page !== '') {
    switch ($page) {

        // ── Simple label-only pages ──────────────────────────────────────────
        case 'server_info':
            $subpage = ADMIN_SERVER_INFO;
            break;

        case 'online':
            $subpage = ADMIN_ONLINE_USERS;
            break;

        case 'notregistered':
            $subpage = ADMIN_PLAYERS_NOT_ACTIVATED;
            break;

        case 'inactive':
            $subpage = ADMIN_PLAYERS_INACTIVATE;
            break;

        case 'report':
            $subpage = ADMIN_PLAYERS_REPORT;
            break;

        case 'message':
            // NOTE: original code had this case duplicated (second occurrence
            // overrode with 'Search IGMs/Reports'). The first definition
            // ('Players Message') is intentional for the ?p=message route.
            // The 'Search IGMs/Reports' label belongs to ?p=search sub-section
            // which is already covered by the search template include logic.
            $subpage = ADMIN_PLAYERS_MESSAGE;
            break;

        case 'msg':
            $subpage = ADMIN_SEARCH_IGMS_REPORTS;
            break;

        case 'multiacc':
            $subpage = ADMIN_MULTI_ACCOUNT_DETECTION;
            break;

        case 'pushprot':
            $subpage = ADMIN_PUSH_PROTECTION;
            break;

        case 'blockReg':
            $subpage = ADMIN_REGISTRATION_BLOCKLIST;
            break;

        case 'heatmap':
            $subpage = ADMIN_WORLD_MAP_HEATMAP;
            break;

        case 'goldShop':
            $subpage = ADMIN_GOLD_SHOP_PROMO_CODES;
            break;

        case 'questEditor':
            $subpage = ADMIN_QUEST_EDITOR;
            break;

        case 'massmessage':
            $subpage = ADMIN_MASS_MESSAGE;
            break;

        case 'sysmessage':
            $subpage = ADMIN_SYSTEM_MESSAGE;
            break;

        case 'map':
            $subpage = ADMIN_MAP;
            break;

        case 'map_tile':
            $subpage                 = 'Map Tile';
            $not_include_mootools_js = true;
            break;

        case 'natars':
            $subpage = ADMIN_NATARS_MANAGEMENT;
            break;

        case 'search':
            $subpage = ADMIN_GENERAL_SEARCH;
            break;

        case 'ban':
            $subpage = ADMIN_BAN_UNBAN_PLAYERS;
            break;

        case 'maintenance':
            $subpage = ADMIN_SERVER_MAINTENANCE;
            break;

        case 'cleanban':
            $subpage = ADMIN_CLEAN_BANLIST_DATA;
            break;

        case 'gold':
            $subpage = ADMIN_GIVE_ALL_FREE_GOLD;
            break;

        case 'usergold':
            $subpage = ADMIN_GIVE_FREE_GOLD_TO_SPECIFIC_USER;
            break;

        case 'maintenenceResetGold':
            $subpage = ADMIN_RESET_GOLD;
            break;

        case 'delmedal':
            $subpage = ADMIN_DELETE_PLAYER_MEDALS;
            break;

        case 'delallymedal':
            $subpage = ADMIN_DELETE_ALLY_MEDALS;
            break;

        case 'givePlus':
            $subpage = ADMIN_GIVE_ALL_PLUS;
            break;

        case 'maintenenceResetPlus':
            $subpage = ADMIN_RESET_PLUS;
            break;

        case 'givePlusRes':
            $subpage = ADMIN_GIVE_ALL_RES_BONUS;
            break;

        case 'maintenenceResetPlusBonus':
            $subpage = ADMIN_RESET_RES_BONUS;
            break;

        case 'addUsers':
            $subpage = ADMIN_CREATE_USERS;
            break;

        case 'users':
            $subpage = ADMIN_USERS_LIST;
            break;

        case 'admin_log':
            $subpage = ADMIN_ADMIN_LOG;
            break;

        case 'config':
            $subpage = ADMIN_SERVER_SETTINGS;
            break;

        case 'debug_log':
            $subpage = ADMIN_DEBUG_ERROR_LOG;
            break;

        case 'editServerSet':
            $subpage = ADMIN_SERVER_CONFIGURATION;
            break;

        case 'editCronSet':
            $subpage = ADMIN_CRON_AUTOMATION;
            break;

        case 'editPlusSet':
            $subpage = ADMIN_PLUS_SETTINGS;
            break;

        case 'editLogSet':
            $subpage = ADMIN_LOG_SETTINGS;
            break;

        case 'editNewsboxSet':
            $subpage = ADMIN_NEWSBOX_SETTINGS;
            break;
			
		case 'editNewFunctions':
            $subpage = ADMIN_NEW_FUNCTIONS_SETTINGS;
            break;

        case 'editExtraSet':
            $subpage = ADMIN_EXTRA_SETTINGS;
            break;

        case 'editAdminInfo':
            $subpage = ADMIN_EDIT_ADMIN_INFORMATION;
            break;

        case 'resetServer':
            $subpage = ADMIN_SERVER_RESETTING;
            break;

        // ── User-context pages (require a valid ?uid=) ───────────────────────
        case 'player':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $displayarray = $database->getUserArray($uid, 1);
                $user         = $displayarray;
                $subpage      = 'Player Details (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_PLAYER_DETAILS . ' (' . ADMIN_NO_PLAYER . ')';
            }
            break;

        case 'editUser':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_PLAYER . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_PLAYER . ' (' . ADMIN_NO_PLAYER . ')';
            }
            break;

        case 'deletion':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_DELETE_PLAYER . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_DELETE_PLAYER . ' (' . ADMIN_NO_PLAYER . ')';
            }
            break;

        case 'Newmessage':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_COMPOSE_MESSAGE . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_COMPOSE_MESSAGE;
            }
            break;

        case 'editPlus':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_PLUS_RESOURCES . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_PLUS_RESOURCES;
            }
            break;

        case 'editSitter':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_SITTERS . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_SITTERS;
            }
            break;

        case 'editPassword':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_PASSWORD . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_PASSWORD;
            }
            break;

        case 'editProtection':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_PROTECTION . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_PROTECTION;
            }
            break;

        case 'editOverall':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_OFF_DEF . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_OFF_DEF;
            }
            break;

        case 'editWeek':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_WEEKLY_OFF_DEF . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_WEEKLY_OFF_DEF;
            }
            break;

        case 'userlogin':
            // SECURITY FIX: was raw mysqli_query with direct $_GET interpolation.
            // Now uses admin_get_user_by_id() which internally uses a prepared statement.
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $player  = admin_get_user_by_id($uid);
                $subpage = $player
                    ? 'User Logins (' . e($player['username']) . ')'
                    : 'User Logins (player not found)';
            } else {
                $subpage = ADMIN_USER_LOGINS . ' (' . ADMIN_NO_PLAYER . ')';
            }
            break;

        case 'userillegallog':
            // SECURITY FIX: same as userlogin above.
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $player  = admin_get_user_by_id($uid);
                $subpage = $player
                    ? 'User Illegals Log (' . e($player['username']) . ')'
                    : 'User Illegals Log (player not found)';
            } else {
                $subpage = ADMIN_USER_ILLEGALS_LOG . ' (' . ADMIN_NO_PLAYER . ')';
            }
            break;

        case 'editHero':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_HERO . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_HERO;
            }
            break;

        case 'editHeroT4':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_T4_HERO_CONTROLS . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_T4_HERO_CONTROLS;
            }
            break;

        case 'editAdditional':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = ADMIN_EDIT_ADDITIONAL_INFO . ' (' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_ADDITIONAL_INFO;
            }
            break;

        // ── Village-context pages (require a valid ?did=) ────────────────────
        case 'village':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                if ($village) {
                    $user    = $database->getUserArray($village['owner'], 1);
                    $subpage = ADMIN_EDIT_VILLAGE . ' (' . e($village['name']) . ' » ' . e($user['username'] ?? '?') . ')';
                } else {
                    $subpage = ADMIN_EDIT_VILLAGE . $did . ' not found)';
                    $village = null;
                }
            } else {
                $subpage = ADMIN_EDIT_VILLAGE . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;

        case 'editResources':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                if ($village) {
                    $user    = $database->getUserArray($village['owner'], 1);
                    $subpage = ADMIN_EDIT_RESOURCES . ' (' . e($village['name']) . ' » ' . e($user['username']) . ')';
                } else {
                    // BUGFIX: original used $did which was only set in 'village' case,
                    // causing an undefined variable notice here. Now always defined above.
                    $subpage = ADMIN_EDIT_RESOURCES . $did . ' not found)';
                    $village = null;
                }
            } else {
                $subpage = ADMIN_EDIT_RESOURCES . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;

        case 'addTroops':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = ADMIN_EDIT_TROOPS . ' (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_TROOPS . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;

        case 'addABTroops':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = ADMIN_UPGRADE_TROOPS . ' (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_UPGRADE_TROOPS . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;

        case 'editVillage':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = ADMIN_EDIT_VILLAGE . ' (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_EDIT_VILLAGE . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;

        // ── Alliance-context pages (require a valid ?aid=) ───────────────────
        case 'alliance':
            $aid = admin_input_id($_GET, 'aid');
            if ($aid !== null) {
                $alidata = $database->getAlliance($aid);
                $subpage = $alidata ? 'Alliance (' . e($alidata['tag']) . ')' : 'Alliance (ID ' . $aid . ' not found)';
            } else {
                $subpage = ADMIN_ALLIANCE;
            }
            break;

        case 'editAli':
            $aid = admin_input_id($_GET, 'aid');
            if ($aid !== null) {
                $alidata = $database->getAlliance($aid);
                $subpage = $alidata ? 'Edit Alliance (' . e($alidata['tag']) . ')' : 'Edit Alliance';
            } else {
                $subpage = ADMIN_EDIT_ALLIANCE;
            }
            break;

        case 'delAli':
            $aid = admin_input_id($_GET, 'aid');
            if ($aid !== null) {
                $alidata = $database->getAlliance($aid);
                $subpage = $alidata ? 'Delete Alliance (' . e($alidata['tag']) . ')' : 'Delete Alliance';
            } else {
                $subpage = ADMIN_DELETE_ALLIANCE;
            }
            break;

        case 'villagelog':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = ADMIN_BUILD_LOG . ' (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_BUILD_LOG . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;

        case 'techlog':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = ADMIN_RESEARCH_LOG . ' (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = ADMIN_RESEARCH_LOG . ' (' . ADMIN_NO_VILLAGE . ')';
            }
            break;
    }
}

// ─── SECURITY HEADERS ─────────────────────────────────────────────────────────
// Send headers before ANY output. These protect against common web attacks.
// Intentionally NOT using header_remove() to avoid stripping headers set by
// other TravianZ bootstrap code — we only add, never remove.
if (!headers_sent()) {
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header("Content-Security-Policy: default-src 'self'; "
        . "script-src 'self' 'unsafe-inline' https://ajax.googleapis.com; "
        . "style-src 'self' 'unsafe-inline'; "
        . "img-src 'self' data:; "
        . "font-src 'self'; "
        . "connect-src 'self'; "
        . "frame-ancestors 'none';");
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <link rel="shortcut icon" href="favicon.ico"/>
        <title>Admin Panel - <?php echo e($subpage); ?></title>
        <link rel="stylesheet" type="text/css" href="../img/admin/admin.css">
        <link rel="stylesheet" type="text/css" href="../img/admin/acp.css">
        <link rel="stylesheet" type="text/css" href="../img/img.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.cookie.js"></script>
        <?php if (!$not_include_mootools_js) { ?>
        <script type="text/javascript" src="/mt-full.js?423cb"></script>
        <script type="text/javascript" src="ajax.js"></script>
        <script type="text/javascript" src="../new.js?0faab"></script>
        <?php } ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="imagetoolbar" content="no">
        <meta name="viewport" content="width=device-width,initial-scale=1">
<style>
/* === TRAVIANZ ADMIN === */
body{margin:0;font-family:Verdana,Arial,sans-serif}
#ltop1{border-bottom:3px solid #f59e0b}
.tz-topbar{display:flex;align-items:center;justify-content:space-between;padding:14px 22px;min-height:64px}
.tz-brand{display:flex;align-items:center;gap:12px}
.tz-logo{width:38px;height:38px;background:#f59e0b;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:bold;color:#fff;font-size:18px}
.tz-brand h1{margin:0;font-size:20px;font-weight:700}
.tz-brand h1 span{color:#f59e0b}
.tz-brand.tz-sub{display:block;font-size:10px;margin-top:2px;text-transform:uppercase;letter-spacing:.7px;opacity:.7}
.tz-user{font-size:12px}
.tz-logout{margin-left:10px;background:#ef4444;color:#fff;padding:5px 11px;border-radius:6px;text-decoration:none;font-size:11px;font-weight:bold}
body.login{background:#0f172a;color:#e2e8f0}
body.login #ltop1{background:#0b1220!important;background-image:none!important}
body.app{background:#0f172a;color:#e2e8f0}
body.app #ltop1{background:#0b1220!important;background-image:none!important;border-bottom:3px solid #f59e0b!important}
body.app #lleft{background:transparent!important;border-right:none!important;padding:0 12px;}
body.app #menu{background:#ffffff;border-radius:8px;overflow:visible;box-shadow:0 4px 12px rgba(0,0,0,.3);margin-top:0;}
body.app #menu li.sub>ul{display:none;}
body.app #menu>li>a{display:block;padding:10px 16px;color:#374151!important;font-weight:600;font-size:12px;border-left:3px solid transparent;text-decoration:none}
body.app #menu>li>a:hover,body.app #menu>li>a.active{background:#f3f4f6;border-left-color:#f59e0b;color:#111827!important}
body.app #menu li.sub ul{background:#f9fafb}
body.app #menu li.sub ul li a{display:block;padding:8px 16px 8px 34px;font-size:11px;color:#6b7280!important}
body.app #menu li.sub ul li a:hover{color:#d97706!important}
</style>
    </head>
    <body class="<?php echo $funct->CheckLogin() ? 'app' : 'login'; ?>">

    <script type="text/javascript">
        init_local();

        function getMouseCoords(e) {
            var coords = {};
            e = e || window.event;
            if (e.pageX || e.pageY) {
                coords.x = e.pageX;
                coords.y = e.pageY;
            } else if (e.clientX || e.clientY) {
                coords.x = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
                coords.y = e.clientY + document.body.scrollTop  + document.documentElement.scrollTop;
            }
            return coords;
        }

        function med_mouseMoveHandler(e, desc_string) {
            var coords = getMouseCoords(e);
            med_showDescription(coords, desc_string);
        }

        function med_closeDescription() {
            document.getElementById('medal_mouseover').className = 'hide';
        }

        function init_local() {
            med_init();
        }

        function med_init() {
            var layer    = document.createElement('div');
            layer.id        = 'medal_mouseover';
            layer.className = 'hide';
            document.body.appendChild(layer);
        }

        function med_showDescription(coords, desc_string) {
            var layer       = document.getElementById('medal_mouseover');
            layer.style.top  = (coords.y + 25) + 'px';
            layer.style.left = (coords.x - 20) + 'px';
            layer.className  = '';
            layer.innerHTML  = desc_string;
        }
    </script>

    <script type="text/javascript">
        // FIXED: removed IE-only language="javascript" attribute and
        // event.srcElement references — replaced with standard DOM API.
        function aktiv(el)   { el.className = 'fl1'; }
        function inaktiv(el) { el.className = 'fl2'; }

        function del(type, id) {
            var messages = {
                arti    : 'Do you really want to delete artifact id '   + id + '?',
                did     : 'Do you really want to delete village id '    + id + '?',
                unban   : 'Do you really want to unban player '         + id + '?',
                stopDel : 'Do you really want to stop deleting user '   + id + '?',
                oas     : 'Do you really want to delete oasis id '      + id + '?'
            };
            var msg = messages[type];
            return msg ? confirm(msg) : false;
        }

        function showStuff(id) { document.getElementById(id).style.display = 'block'; }
        function hideStuff(id) { document.getElementById(id).style.display = 'none';  }
        function go_url(url)   { location = url; return false; }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            // Restore previously opened sub-menu section.
            var checkNav = $.cookie('sub-nav');
            if (checkNav !== '' && checkNav !== null) {
                $('#menu > li.sub > a:eq(' + checkNav + ')').addClass('active').next().show();
            }

            $('#menu > li.sub > a').click(function () {
                var navIndex = $('#menu > li.sub > a').index(this);
                $.cookie('sub-nav', navIndex);
                $('#menu li ul').slideUp();
                if ($(this).next().is(':visible')) {
                    $(this).next().slideUp();
                } else {
                    $(this).next().slideToggle();
                }
                return false;
            });

            // Restore previously active sub-link.
            var checkLink = $.cookie('sub-link');
            if (checkLink !== '' && checkLink !== null) {
                $('#menu > li.sub > ul li a:eq(' + checkLink + ')').addClass('active');
            }

            $('.sub ul li a').click(function () {
                var subIndex = $('.sub ul li a').index(this);
                $.cookie('sub-link', subIndex);
                $('.sub ul li a').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>

    <div id="ltop1">
        <div class="tz-topbar">
            <div class="tz-brand">
                <div class="tz-logo">TZ</div>
                <div>
                    <h1>TravianZ <span>Admin Panel</span></h1>
                    <span class="tz-sub"><?php echo e($subpage); ?> • v14.06.2026</span>
                </div>
            </div>
            <div class="tz-user">
                <?php if ($funct->CheckLogin()) { ?>
                    <?php
                        $adminName   = $database->getUserField($_SESSION['id'], 'username', 0);
                        $adminAccess = $database->getUserField($_SESSION['id'], 'access', 0);
                        $rank        = $adminAccess == 9 ? 'Admin' : ($adminAccess == 8 ? 'MH' : 'User');
                    ?>
                    Logged: <b><?php echo e($adminName); ?></b>
                    <span style="color:#999;font-size:11px">(<?php echo e($rank); ?>)</span>
                    <a href="?action=logout" class="tz-logout"><?php echo ADMIN_LOGOUT; ?></a>
                <?php } else { ?>
                    Not Logged in
                <?php } ?>
            </div>
        </div>
    </div>

    <div style="height:20px;"></div>

    <div id="lmidall">
        <div id="lmidlc">
            <div id="lleft">

                <p class="center-img">
                    <a href="<?php echo e(HOMEPAGE); ?>">
                        <img src="/Admin/img/travianz_admin_logo.png"
                             alt="TravianZ Admin Panel"
                             style="display:block;margin:0 auto;max-width:85%;height:auto;filter:drop-shadow(0 2px 6px rgba(0,0,0,.5));">
                    </a>
                </p>

                <?php if ($funct->CheckLogin()) { ?>
                    <?php if ($_SESSION['access'] == ADMIN) { ?>

                    <ul id="menu">
                        <li><a href="<?php echo e(HOMEPAGE); ?>"><?php echo ADMIN_SERVER_HOMEPAGE; ?></a></li>
                        <li><a href="index.php"><?php echo ADMIN_CONTROL_PANEL_HOME; ?></a></li>
                        <li><a href="<?php echo e(rtrim(SERVER, '/')); ?>/dorf1.php"><?php echo ADMIN_RETURN_TO_THE_SERVER; ?></a></li>
                        <li><a href="?action=logout"><?php echo ADMIN_LOGOUT; ?></a></li>
                        <li class="sub"><a href="#"><?php echo ADMIN_SERVER_INFO; ?></a>
                            <ul>
                                <li><a href="?p=server_info"><?php echo ADMIN_SERVER_INFO; ?></a></li>
                                <li><a href="?p=online"><?php echo ADMIN_ONLINE_USERS; ?></a></li>
                                <li><a href="?p=notregistered"><?php echo ADMIN_PLAYERS_NOT_ACTIVATED; ?></a></li>
                                <li><a href="?p=inactive"><?php echo ADMIN_PLAYERS_INACTIVATE; ?></a></li>
                                <li><a href="?p=report"><?php echo ADMIN_PLAYERS_REPORT; ?></a></li>
                                <li><a href="?p=msg"><?php echo ADMIN_PLAYERS_MESSAGE; ?></a></li>
                                <li><a href="?p=map"><?php echo ADMIN_MAP; ?></a></li>
                                <li><a href="?p=map_tile"><?php echo ADMIN_MAP_TILE; ?></a></li>
                                <li><a href="?p=natars"><?php echo ADMIN_NATARS_MANAGEMENT; ?></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_SEARCH; ?></a>
                            <ul>
                                <li><a href="?p=search"><?php echo ADMIN_GENERAL_SEARCH; ?></a></li>
                                <li><a href="?p=message"><?php echo ADMIN_SEARCH_IGMS_REPORTS; ?></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_MESSAGES; ?></a>
                            <ul>
                                <li><a href="admin.php?p=massmessage"><?php echo ADMIN_CREATE_MASS_MESSAGE; ?></a></li>
                                <li><a href="admin.php?p=sysmessage"><?php echo ADMIN_CREATE_SYSTEM_MESSAGE; ?></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_BAN; ?></a>
                            <ul>
                                <li><a href="?p=ban"><?php echo ADMIN_BAN_UNBAN_PLAYERS; ?></a></li>
                                <li><a href="?p=cleanban"><?php echo ADMIN_CLEAN_BANLIST_DATA; ?></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_GOLD; ?></a>
                            <ul>
                                <li><a href="?p=gold"><?php echo ADMIN_GIVE_ALL_FREE_GOLD; ?></a></li>
                                <li><a href="?p=usergold"><?php echo ADMIN_GIVE_FREE_GOLD_TO_SPECIFIC_USER; ?></a></li>
                                <li><a href="?p=goldShop"><?php echo ADMIN_GOLD_SHOP_PROMO_CODES; ?></a></li>
                                <li><a href="?p=maintenenceResetGold"><?php echo ADMIN_RESET_GOLD; ?></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_PLUS_RES_BONUS; ?></a>
                            <ul>
                                <li><a href="?p=givePlus"><?php echo ADMIN_GIVE_ALL_PLUS; ?></a></li>
                                <li><a href="?p=maintenenceResetPlus"><?php echo ADMIN_RESET_PLUS; ?></a></li>
                                <li><a href="?p=givePlusRes"><?php echo ADMIN_GIVE_ALL_RES_BONUS; ?></a></li>
                                <li><a href="?p=maintenenceResetPlusBonus"><?php echo ADMIN_RESET_RES_BONUS; ?></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_USERS; ?></a>
                            <ul>
                                <li><a href="?p=users"><?php echo ADMIN_LIST_USERS; ?></a></li>
                                <li><a href="?p=addUsers"><?php echo ADMIN_CREATE_USERS; ?></a></li>
								<li><a href="?p=multiacc"><font color="Red"><b><?php echo ADMIN_MULTI_ACCOUNT_DETECTION; ?></b></font></a></li>
                                <li><a href="?p=pushprot"><font color="Red"><b><?php echo ADMIN_PUSH_PROTECTION; ?></b></font></a></li>
                                <li><a href="?p=blockReg"><font color="Red"><b><?php echo ADMIN_REGISTRATION_BLOCKLIST; ?></b></font></a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#"><?php echo ADMIN_ADMIN; ?></a>
                            <ul>
                                <li><a href="?p=admin_log"><font color="Red"><b><?php echo ADMIN_ADMIN_LOG; ?></b></font></a></li>
								<li><a href="?p=questEditor"><font color="Red"><b><?php echo ADMIN_QUEST_EDITOR; ?></b></font></a></li>
                                <li><a href="?p=heatmap"><font color="Red"><b><?php echo ADMIN_WORLD_MAP_HEATMAP; ?></b></font></a></li>
                                <li><a href="?p=debug_log"><?php echo ADMIN_DEBUG_ERROR_LOG; ?></a></li>
                                <li><a href="?p=config"><?php echo ADMIN_SERVER_SETTINGS; ?></a></li>
                                <li><a href="?p=maintenance"><?php echo ADMIN_SERVER_MAINTENANCE; ?></a></li>
                                <li><a href="?p=resetServer"><?php echo ADMIN_SERVER_RESETTING; ?></a></li>
                            </ul>
                        </li>
                    </ul>

                    <?php } elseif ($_SESSION['access'] == MULTIHUNTER) { ?>

                    <ul id="menu">
                        <li><a href="<?php echo e(HOMEPAGE); ?>"><?php echo ADMIN_SERVER_HOMEPAGE; ?></a></li>
                        <li><a href="index.php"><?php echo ADMIN_CONTROL_PANEL_HOME; ?></a></li>
                        <li><a href="<?php echo e(rtrim(SERVER, '/')); ?>/nachrichten.php"><?php echo ADMIN_IN_GAME_MESSAGES; ?></a></li>
                        <li><a href="?p=server_info"><?php echo ADMIN_SERVER_INFO; ?></a></li>
                        <li><a href="?p=online"><?php echo ADMIN_ONLINE_USERS; ?></a></li>
                        <li><a href="?p=search"><?php echo ADMIN_SEARCH; ?></a></li>
                        <li><a href="?p=message"><?php echo ADMIN_MSG_REP; ?></a></li>
                        <li><a href="?p=ban"><?php echo ADMIN_BAN; ?></a></li>
                        <li><a href="?p=multiacc"><?php echo ADMIN_MULTI_ACCOUNT_DETECTION; ?></a></li>
                        <li><a href="?p=pushprot"><?php echo ADMIN_PUSH_PROTECTION; ?></a></li>
                        <li><a href="?p=heatmap"><?php echo ADMIN_WORLD_MAP_HEATMAP; ?></a></li>
                        <li><a href="?action=logout"><?php echo ADMIN_LOGOUT; ?></a></li>
                    </ul>

                    <?php } ?>
                <?php } ?>

            </div><!-- #lleft -->

            <div id="lmid1">
                <div id="lmid3">
                    <?php
                    if ($funct->CheckLogin()) {
                        // CSRF: verifică token-ul pe ORICE request POST înainte de a
                        // include orice template. GET-urile nu modifică starea serverului
                        // (sunt doar citiri), deci nu necesită verificare CSRF.
                        if ($_POST) {
                            csrf_verify();
                        }

                        if ($_POST || $_GET) {
                            // SECURITY: $page is already whitelist-validated above.
                            // Direct string concat with include() is now safe.
                            if ($page !== '' && $page !== 'search') {
                                $filename = 'Templates/' . $page . '.tpl';
                                if (file_exists($filename)) {
                                    include($filename);
                                } else {
                                    include('Templates/404.tpl');
                                }
                            } else {
                                include('Templates/search.tpl');
                            }

                            // Handle POST-based results template.
                            $postPage = isset($_POST['p']) ? trim((string)$_POST['p']) : '';
                            $postSub  = isset($_POST['s']) ? trim((string)$_POST['s']) : '';
                            $postPage = admin_validated_page($postPage); // whitelist POST too
                            if ($postPage !== '' && $postSub !== '') {
                                $filename = 'Templates/results_' . $postPage . '.tpl';
                                if (file_exists($filename)) {
                                    include($filename);
                                } else {
                                    include('Templates/404.tpl');
                                }
                            }
                        } else {
                            include('Templates/home.tpl');
                        }
                    } else {
                        include('Templates/login.tpl');
                    }
                    ?>
                </div><!-- #lmid3 -->
            </div><!-- #lmid1 -->

        </div><!-- #lmidlc -->
        <div id="lright1"></div>
        <div id="ce"></div>
    </div><!-- #lmidall -->

    </body>
</html>
