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
##  Filename       editUser.php                                                ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

include_once("../../config.php");

// ---------------------------------------------------------------------------
// Autoloader path
// ---------------------------------------------------------------------------
$autoprefix = '';

for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . "GameEngine/Database.php");

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);
$id      = (int)($_POST['id'] ?? 0);

if ($id <= 0 || $session <= 0) {
    header("Location: ../../../Admin/admin.php?p=player&uid={$id}&e=bad");
    exit;
}

// ---------------------------------------------------------------------------
// Vérification admin
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($session, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Champs
// ---------------------------------------------------------------------------
$emailRaw = trim($_POST['email'] ?? '');
$email    = filter_var($emailRaw, FILTER_VALIDATE_EMAIL) ? $emailRaw : '';
$email    = $database->escape($email);

$tribe = max(1, min(9, (int)($_POST['tribe'] ?? 1)));

$locationRaw = trim($_POST['location'] ?? '');
$location = $database->escape(
    mb_substr(strip_tags($locationRaw), 0, 50)
);

$desc1Raw = $_POST['desc1'] ?? '';
$desc1 = $database->escape(
    mb_substr(strip_tags($desc1Raw, '<b><i><u><br>'), 0, 5000)
);

$desc2Raw = $_POST['desc2'] ?? '';
$desc2 = $database->escape(
    mb_substr(strip_tags($desc2Raw, '<b><i><u><br>'), 0, 5000)
);

$questRaw = trim($_POST['quest'] ?? '');
$quest = $database->escape(
    mb_substr(strip_tags($questRaw), 0, 200)
);

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "users SET
        email = '{$email}',
        tribe = {$tribe},
        location = '{$location}',
        desc1 = '{$desc1}',
        desc2 = '{$desc2}',
        quest = '{$quest}'
     WHERE id = {$id}"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time    = time();

$targetName = $database->getUserField($id, 'username', 0) ?: 'UID ' . $id;
$targetNameSafe = htmlspecialchars(
    $targetName,
    ENT_QUOTES,
    'UTF-8'
);

$logText = "Edited profile for user <a href='admin.php?p=player&uid={$id}'>{$targetNameSafe}</a>";
$logEsc  = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '{$adminId}', '{$logEsc}', {$time})"
);

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id);
exit;
?>
