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
##              Filename       gold.php                                        ##
##              Type           BACKEND                                         ##
##              Developed by:  aggenkeech                                      ##
##              Refactored by: Shadow                                          ##
##              License:       TravianZ Project                                ##
##              Copyright:     TravianZ (c) 2010-2025. All rights reserved.   ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

error_reporting(E_ALL);

// ---------------------------------------------------------------------------
// Autoloader
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
$admid  = (int)($_POST['admid'] ?? 0);
$amount = (int)($_POST['gold'] ?? 0);

if ($amount === 0) {
    header("Location: ../../../Admin/admin.php?p=gold");
    exit;
}

// ---------------------------------------------------------------------------
// Vérification admin
// ---------------------------------------------------------------------------
$check = mysqli_query(
    $GLOBALS['link'],
    "SELECT access, username
     FROM " . TB_PREFIX . "users
     WHERE id = $admid
     LIMIT 1"
);

$acc = mysqli_fetch_assoc($check);

if (!$acc || (int)$acc['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// 1. Ajouter l'or à tous les joueurs
//    id > 3 = exclusion des comptes système / Natars
// ---------------------------------------------------------------------------
mysqli_query(
    $GLOBALS['link'],
    "UPDATE " . TB_PREFIX . "users
     SET gold = gold + $amount
     WHERE id > 3"
) or die(mysqli_error($GLOBALS['link']));

// ---------------------------------------------------------------------------
// 2. Log dans admin_log
// ---------------------------------------------------------------------------
$adminLog = mysqli_real_escape_string(
    $GLOBALS['link'],
    'Added <b>' . $amount . '</b> gold to ALL players'
);

mysqli_query(
    $GLOBALS['link'],
    "INSERT INTO " . TB_PREFIX . "admin_log
        (`id`, `user`, `log`, `time`)
     VALUES
        (0, $admid, '$adminLog', " . time() . ")"
) or die(mysqli_error($GLOBALS['link']));

// ---------------------------------------------------------------------------
// 3. Log gold_fin_log pour chaque joueur
// ---------------------------------------------------------------------------
$users = mysqli_query(
    $GLOBALS['link'],
    "SELECT id
     FROM " . TB_PREFIX . "users
     WHERE id > 3"
) or die(mysqli_error($GLOBALS['link']));

$now = time();

$adminName = mysqli_real_escape_string(
    $GLOBALS['link'],
    $acc['username']
);

$details = mysqli_real_escape_string(
    $GLOBALS['link'],
    'Mass gift by ' . $acc['username']
);

while ($u = mysqli_fetch_assoc($users)) {

    $uid = (int)$u['id'];

    // Récupère le premier village du joueur pour le wid du journal.
    $vill = mysqli_fetch_assoc(
        mysqli_query(
            $GLOBALS['link'],
            "SELECT wref
             FROM " . TB_PREFIX . "vdata
             WHERE owner = $uid
             LIMIT 1"
        )
    );

    $wid = (int)($vill['wref'] ?? 0);

    mysqli_query(
        $GLOBALS['link'],
        "INSERT INTO " . TB_PREFIX . "gold_fin_log
            (`wid`, `uid`, `action`, `gold`, `time`, `details`)
         VALUES
            ($wid, $uid, 'Admin added Gold', $amount, $now, '$details')"
    ) or die(mysqli_error($GLOBALS['link']));
}

// ---------------------------------------------------------------------------
// Retour ACP
// ---------------------------------------------------------------------------
header("Location: ../../../Admin/admin.php?p=gold&g");
exit;
?>