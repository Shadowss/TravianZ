<?php

// ============================================================
// TRAVIANZ MI INSTANCE / SESSION BOOTSTRAP
// ============================================================
require_once(__DIR__ . '/../../Instance/Resolver.php');

$travianInstance = InstanceResolver::resolve(false);
InstanceResolver::startInstanceSession($travianInstance);

include_once(__DIR__ . '/../../config.php');

if (file_exists(__DIR__ . '/../../Lang/loader.php')) {
    require_once(__DIR__ . '/../../Lang/loader.php');

    if (defined('LANG') && function_exists('tz_load_language')) {
        tz_load_language(LANG);
    }
}

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       delUser.php                                                 ##
##  Type           BACKEND                                                     ##
##  Developed by:  Shadow (dupa model delAli)                                   ##
##  License:       TravianZ Project                                             ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// ---------------------------------------------------------------------------
// CSRF + session + admin access
// ---------------------------------------------------------------------------
require_once(__DIR__ . '/../csrf.php');

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// CSRF verification
// ---------------------------------------------------------------------------
// This Mod is POSTed directly, so it must verify the CSRF token itself.
csrf_verify();

// ---------------------------------------------------------------------------
// Configuration
// ---------------------------------------------------------------------------
include_once(__DIR__ . '/../../config.php');

// ---------------------------------------------------------------------------
// Database
// ---------------------------------------------------------------------------
$autoprefix = '';

for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . 'GameEngine/Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$uid   = (int)($_POST['uid'] ?? 0);
$admid = (int)($_POST['admid'] ?? 0);
$pass  = $_POST['pass'] ?? '';

if ($uid <= 0 || $admid <= 0) {
    header('Location: ../../../Admin/admin.php?p=search&e=bad');
    exit;
}

// ---------------------------------------------------------------------------
// Verify administrator
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($admid, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Verify administrator password
// ---------------------------------------------------------------------------
if (!password_verify($pass, $admin['password'])) {
    die('<script>alert("Wrong administrator password!");history.back();</script>');
}

// ---------------------------------------------------------------------------
// Prevent administrator from deleting himself
// ---------------------------------------------------------------------------
if ($uid === $admid) {
    die('<script>alert("You cannot delete yourself!");history.back();</script>');
}

// ---------------------------------------------------------------------------
// Target user
// ---------------------------------------------------------------------------
$target = $database->getUserArray($uid, 1);

if (!$target) {
    die('User not found');
}

$username = $database->escape($target['username']);

// ---------------------------------------------------------------------------
// 1. Get all villages belonging to the user
// ---------------------------------------------------------------------------
$vilIds = [];

$res = $database->query(
    'SELECT wref FROM ' . TB_PREFIX . 'vdata WHERE owner = ' . $uid
);

while ($r = mysqli_fetch_assoc($res)) {
    $vilIds[] = (int)$r['wref'];
}

$ids = $vilIds ? implode(',', $vilIds) : '0';

// ---------------------------------------------------------------------------
// 2. Delete village-related data
// ---------------------------------------------------------------------------
if ($ids !== '0') {

    $database->query(
        'UPDATE ' . TB_PREFIX . 'wdata
         SET occupied = 0
         WHERE id IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'vdata
         WHERE wref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'fdata
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'bdata
         WHERE wid IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'abdata
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'tdata
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'units
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'training
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'research
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'demolition
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'build_log
         WHERE wid IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'tech_log
         WHERE wid IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'market
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'movement
         WHERE `from` IN (' . $ids . ')
            OR `to` IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'attacks
         WHERE vref IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'enforcement
         WHERE vref IN (' . $ids . ')
            OR `from` IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'prisoners
         WHERE wref IN (' . $ids . ')
            OR `from` IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'route
         WHERE wid IN (' . $ids . ')'
    );

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'ww_attacks
         WHERE vid IN (' . $ids . ')'
    );

    // -----------------------------------------------------------------------
    // Farmlists / raidlists
    // -----------------------------------------------------------------------
    $fl = $database->query(
        'SELECT id
         FROM ' . TB_PREFIX . 'farmlist
         WHERE wref IN (' . $ids . ')'
    );

    $flIds = [];

    while ($f = mysqli_fetch_assoc($fl)) {
        $flIds[] = (int)$f['id'];
    }

    if ($flIds) {
        $fids = implode(',', $flIds);

        $database->query(
            'DELETE FROM ' . TB_PREFIX . 'raidlist
             WHERE lid IN (' . $fids . ')'
        );
    }

    $database->query(
        'DELETE FROM ' . TB_PREFIX . 'farmlist
         WHERE wref IN (' . $ids . ')'
    );
}

// ---------------------------------------------------------------------------
// 3. Delete user-related data
// ---------------------------------------------------------------------------

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'hero
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'mdata
     WHERE target = ' . $uid . '
        OR owner = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'ndata
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'medal
     WHERE userid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'gold_fin_log
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'links
     WHERE userid = ' . $uid
);

// The old "active" table no longer exists.
// Last activity is stored in users.timestamp.

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'online
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'chat
     WHERE id_user = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'login_log
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'banlist
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'deleting
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'password
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'illegal_log
     WHERE user = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'ali_invite
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'ali_permission
     WHERE uid = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'forum_post
     WHERE owner = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'forum_topic
     WHERE owner = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'artefacts
     WHERE owner = ' . $uid
);

$database->query(
    'DELETE FROM ' . TB_PREFIX . 'artefacts_chrono
     WHERE uid = ' . $uid
);

// ---------------------------------------------------------------------------
// Finally delete the user
// ---------------------------------------------------------------------------
$database->query(
    'DELETE FROM ' . TB_PREFIX . 'users
     WHERE id = ' . $uid
);

// ---------------------------------------------------------------------------
// Log admin action
// ---------------------------------------------------------------------------
$time = time();

$logText = "Deleted player ID $uid ($username)";
$logEsc  = $database->escape($logText);

$database->query(
    'INSERT INTO ' . TB_PREFIX . 'admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, \'' . $admid . '\', \'' . $logEsc . '\', ' . $time . ')'
);

// ---------------------------------------------------------------------------
// Redirect
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=search&deluser=1'
);

exit;
?>
