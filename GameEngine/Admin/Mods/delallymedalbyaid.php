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
##  Filename       deletemedalsbyuser.php                                      ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

// ---------------------------------------------------------------------------
// Vérification de la session administrateur
// ---------------------------------------------------------------------------
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel '
        . 'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Vérification CSRF
// ---------------------------------------------------------------------------
// This Mod is POSTed to directly, so it must verify the CSRF token itself.
csrf_verify();

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

include_once($autoprefix . 'GameEngine/config.php');
include_once($autoprefix . 'GameEngine/Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$aid = (int)($_POST['aid'] ?? $_POST['allyid'] ?? 0);

if ($aid <= 0) {
    header(
        'Location: ../../../Admin/admin.php?p=alliance&aid='
        . $aid
        . '&e=bad'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Vérification de l'administrateur
// ---------------------------------------------------------------------------
// The session is already authenticated above. We deliberately use the
// session ID rather than trusting a POSTed admid value.
$adminId = (int)($_SESSION['id'] ?? 0);

if ($adminId <= 0) {
    admin_deny(
        'You must be signed in as an administrator to do this. '
        . 'Your session may have expired — please sign in again.'
    );
}

$admin = $database->getUserArray($adminId, 1);

if (!$admin || (int)$admin['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to do this. '
        . 'Your session may have expired — please sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Suppression logique - toutes les médailles de l'alliance
// ---------------------------------------------------------------------------
$result = $database->query(
    "UPDATE " . TB_PREFIX . "allimedal
     SET del = 1
     WHERE allyid = $aid
       AND del = 0"
);

if (!$result) {
    die('Failed to delete alliance medals: ' . $database->getError());
}

$affected = mysqli_affected_rows($database->dblink);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$time = time();

$logText =
    "Deleted all medals ($affected) for alliance "
    . "<a href='admin.php?p=alliance&aid=$aid'>$aid</a>";

$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// Redirect
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=alliance&aid='
    . $aid
    . '&deleted='
    . $affected
);

exit;
?>