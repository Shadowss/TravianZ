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
include_once("../GameEngine/Lang/" . LANG . ".php");
include_once("../GameEngine/Admin/database.php");
include_once("../GameEngine/Data/buidata.php");
include_once("../GameEngine/Artifacts.php");

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
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
        'editExtraSet', 'editAdminInfo', 'resetServer', 'player', 'editUser',
        'deletion', 'Newmessage', 'editPlus', 'editSitter', 'editPassword',
        'editProtection', 'editOverall',
        'editWeek', 'userlogin', 'userillegallog', 'editHero', 'editAdditional',
        'village', 'editResources', 'addTroops', 'addABTroops', 'editVillage',
        'villagelog', 'techlog', 'msg',
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
            $subpage = 'Server Info';
            break;

        case 'online':
            $subpage = 'Online Users';
            break;

        case 'notregistered':
            $subpage = 'Players Not Activated';
            break;

        case 'inactive':
            $subpage = 'Players Inactivate';
            break;

        case 'report':
            $subpage = 'Players Report';
            break;

        case 'message':
            // NOTE: original code had this case duplicated (second occurrence
            // overrode with 'Search IGMs/Reports'). The first definition
            // ('Players Message') is intentional for the ?p=message route.
            // The 'Search IGMs/Reports' label belongs to ?p=search sub-section
            // which is already covered by the search template include logic.
            $subpage = 'Players Message';
            break;

        case 'msg':
            $subpage = 'Search IGMs/Reports';
            break;

        case 'massmessage':
            $subpage = 'Mass Message';
            break;

        case 'sysmessage':
            $subpage = 'System Message';
            break;

        case 'map':
            $subpage = 'Map';
            break;

        case 'map_tile':
            $subpage                 = 'Map Tile';
            $not_include_mootools_js = true;
            break;

        case 'natars':
            $subpage = 'Natars Management';
            break;

        case 'search':
            $subpage = 'General Search';
            break;

        case 'ban':
            $subpage = 'Ban/Unban Players';
            break;

        case 'maintenance':
            $subpage = 'Server Maintenance';
            break;

        case 'cleanban':
            $subpage = 'Clean Banlist Data';
            break;

        case 'gold':
            $subpage = 'Give All Free Gold';
            break;

        case 'usergold':
            $subpage = 'Give Free Gold To Specific User';
            break;

        case 'maintenenceResetGold':
            $subpage = 'Reset Gold';
            break;

        case 'delmedal':
            $subpage = 'Delete Player Medals';
            break;

        case 'delallymedal':
            $subpage = 'Delete Ally Medals';
            break;

        case 'givePlus':
            $subpage = 'Give All Plus';
            break;

        case 'maintenenceResetPlus':
            $subpage = 'Reset Plus';
            break;

        case 'givePlusRes':
            $subpage = 'Give All Res Bonus';
            break;

        case 'maintenenceResetPlusBonus':
            $subpage = 'Reset Res Bonus';
            break;

        case 'addUsers':
            $subpage = 'Create Users';
            break;

        case 'users':
            $subpage = 'Users List';
            break;

        case 'admin_log':
            $subpage = 'Admin Log';
            break;

        case 'config':
            $subpage = 'Server Settings';
            break;

        case 'debug_log':
            $subpage = 'Debug Error Log';
            break;

        case 'editServerSet':
            $subpage = 'Server Configuration';
            break;

        case 'editPlusSet':
            $subpage = 'PLUS Settings';
            break;

        case 'editLogSet':
            $subpage = 'Log Settings';
            break;

        case 'editNewsboxSet':
            $subpage = 'NewsBox Settings';
            break;

        case 'editExtraSet':
            $subpage = 'Extra Settings';
            break;

        case 'editAdminInfo':
            $subpage = 'Edit Admin Information';
            break;

        case 'resetServer':
            $subpage = 'Server Resetting';
            break;

        // ── User-context pages (require a valid ?uid=) ───────────────────────
        case 'player':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $displayarray = $database->getUserArray($uid, 1);
                $user         = $displayarray;
                $subpage      = 'Player Details (' . e($user['username']) . ')';
            } else {
                $subpage = 'Player Details (no player)';
            }
            break;

        case 'editUser':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Player (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Player (no player)';
            }
            break;

        case 'deletion':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Delete Player (' . e($user['username']) . ')';
            } else {
                $subpage = 'Delete Player (no player)';
            }
            break;

        case 'Newmessage':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Compose Message (' . e($user['username']) . ')';
            } else {
                $subpage = 'Compose Message';
            }
            break;

        case 'editPlus':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Plus &amp; Resources (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Plus &amp; Resources';
            }
            break;

        case 'editSitter':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Sitters (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Sitters';
            }
            break;

        case 'editPassword':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Password (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Password';
            }
            break;

        case 'editProtection':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Protection (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Protection';
            }
            break;

        case 'editOverall':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Off &amp; Def (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Off &amp; Def';
            }
            break;

        case 'editWeek':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Weekly Off &amp; Def (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Weekly Off &amp; Def';
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
                $subpage = 'User Logins (no player)';
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
                $subpage = 'User Illegals Log (no player)';
            }
            break;

        case 'editHero':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Hero (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Hero';
            }
            break;

        case 'editAdditional':
            $uid = admin_input_id($_GET, 'uid');
            if ($uid !== null) {
                $user    = $database->getUserArray($uid, 1);
                $subpage = 'Edit Additional Info (' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Additional Info';
            }
            break;

        // ── Village-context pages (require a valid ?did=) ────────────────────
        case 'village':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                if ($village) {
                    $user    = $database->getUserArray($village['owner'], 1);
                    $subpage = 'Edit Village (' . e($village['name']) . ' » ' . e($user['username'] ?? '?') . ')';
                } else {
                    $subpage = 'Edit Village (ID ' . $did . ' not found)';
                    $village = null;
                }
            } else {
                $subpage = 'Edit Village (no village)';
            }
            break;

        case 'editResources':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                if ($village) {
                    $user    = $database->getUserArray($village['owner'], 1);
                    $subpage = 'Edit Resources (' . e($village['name']) . ' » ' . e($user['username']) . ')';
                } else {
                    // BUGFIX: original used $did which was only set in 'village' case,
                    // causing an undefined variable notice here. Now always defined above.
                    $subpage = 'Edit Resources (ID ' . $did . ' not found)';
                    $village = null;
                }
            } else {
                $subpage = 'Edit Resources (no village)';
            }
            break;

        case 'addTroops':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = 'Edit Troops (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Troops (no village)';
            }
            break;

        case 'addABTroops':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = 'Upgrade Troops (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = 'Upgrade Troops (no village)';
            }
            break;

        case 'editVillage':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = 'Edit Village (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = 'Edit Village (no village)';
            }
            break;

        case 'villagelog':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = 'Build Log (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = 'Build Log (no village)';
            }
            break;

        case 'techlog':
            $did = admin_input_id($_GET, 'did');
            if ($did !== null) {
                $village = $database->getVillage($did);
                $user    = $database->getUserArray($village['owner'], 1);
                $subpage = 'Research Log (' . e($village['name']) . ' » ' . e($user['username']) . ')';
            } else {
                $subpage = 'Research Log (no village)';
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
                    <a href="?action=logout" class="tz-logout">Logout</a>
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
                        <li><a href="<?php echo e(HOMEPAGE); ?>">Server Homepage</a></li>
                        <li><a href="index.php">Control Panel Home</a></li>
                        <li><a href="<?php echo e(rtrim(SERVER, '/')); ?>/dorf1.php">Return to the server</a></li>
                        <li><a href="?action=logout">Logout</a></li>
                        <li class="sub"><a href="#">Server Info</a>
                            <ul>
                                <li><a href="?p=server_info">Server Info</a></li>
                                <li><a href="?p=online">Online Users</a></li>
                                <li><a href="?p=notregistered">Players Not Activated</a></li>
                                <li><a href="?p=inactive">Players Inactivate</a></li>
                                <li><a href="?p=report">Players Report</a></li>
                                <li><a href="?p=msg">Players Message</a></li>
                                <li><a href="?p=map">Map</a></li>
                                <li><a href="?p=map_tile">Map Tile</a></li>
                                <li><a href="?p=natars">Natars Management</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Search</a>
                            <ul>
                                <li><a href="?p=search">General Search</a></li>
                                <li><a href="?p=message">Search IGMs/Reports</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Messages</a>
                            <ul>
                                <li><a href="admin.php?p=massmessage">Create Mass Message</a></li>
                                <li><a href="admin.php?p=sysmessage">Create System Message</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Ban</a>
                            <ul>
                                <li><a href="?p=ban">Ban/Unban Players</a></li>
                                <li><a href="?p=cleanban">Clean Banlist Data</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Gold</a>
                            <ul>
                                <li><a href="?p=gold">Give All Free Gold</a></li>
                                <li><a href="?p=usergold">Give Free Gold To Specific User</a></li>
                                <li><a href="?p=maintenenceResetGold">Reset Gold</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Plus &amp; Res Bonus</a>
                            <ul>
                                <li><a href="?p=givePlus">Give All Plus</a></li>
                                <li><a href="?p=maintenenceResetPlus">Reset Plus</a></li>
                                <li><a href="?p=givePlusRes">Give All Res Bonus</a></li>
                                <li><a href="?p=maintenenceResetPlusBonus">Reset Res Bonus</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Users</a>
                            <ul>
                                <li><a href="?p=users">List Users</a></li>
                                <li><a href="?p=addUsers">Create Users</a></li>
                            </ul>
                        </li>
                        <li class="sub"><a href="#">Admin</a>
                            <ul>
                                <li><a href="?p=admin_log"><font color="Red"><b>Admin Log</b></font></a></li>
                                <li><a href="?p=debug_log">Debug Error Log</a></li>
                                <li><a href="?p=config">Server Settings</a></li>
                                <li><a href="?p=maintenance">Server Maintenance</a></li>
                                <li><a href="?p=resetServer">Server Resetting</a></li>
                            </ul>
                        </li>
                    </ul>

                    <?php } elseif ($_SESSION['access'] == MULTIHUNTER) { ?>

                    <ul id="menu">
                        <li><a href="<?php echo e(HOMEPAGE); ?>">Server Homepage</a></li>
                        <li><a href="index.php">Control Panel Home</a></li>
                        <li><a href="<?php echo e(rtrim(SERVER, '/')); ?>/nachrichten.php">In-Game Messages</a></li>
                        <li><a href="?p=server_info">Server Info</a></li>
                        <li><a href="?p=online">Online users</a></li>
                        <li><a href="?p=search">Search</a></li>
                        <li><a href="?p=message">Msg/Rep</a></li>
                        <li><a href="?p=ban">Ban</a></li>
                        <li><a href="?action=logout">Logout</a></li>
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