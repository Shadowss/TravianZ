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
##              Filename: cp.php                                               ##
##              Developed by: aggenkeech                                       ##
##              License: TravianZ Project                                      ##
##              Copyright: TravianZ (c) 2010-2025. All rights reserved.        ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

// ---------------------------------------------------------------------------
// Vérification de la session administrateur
// ---------------------------------------------------------------------------
if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel '
        . 'and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

// ---------------------------------------------------------------------------
// Database
// ---------------------------------------------------------------------------
include_once(__DIR__ . '/../../config.php');

// Go max 5 levels up - we don't have folders that go deeper than that.
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
$id    = (int)($_POST['id'] ?? 0);
$admid = (int)($_POST['admid'] ?? 0);
$cp    = (int)($_POST['cp'] ?? 0);

// ---------------------------------------------------------------------------
// Validation
// ---------------------------------------------------------------------------
if ($id <= 0 || $admid <= 0) {
    header(
        'Location: ../../../Admin/admin.php?p=player&uid='
        . $id
        . '&e=bad'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Vérification de l'administrateur
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($admid, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel '
        . 'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Modification des points de culture
// ---------------------------------------------------------------------------
//
// cp peut être positif ou négatif.
// Exemple :
//   cp = 100  -> ajoute 100 CP
//   cp = -100 -> retire 100 CP
//
// La valeur est castée en entier, donc aucune injection SQL possible ici.
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "users "
    . "SET cp = cp + " . $cp . " "
    . "WHERE id = " . $id
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)($_SESSION['id'] ?? 0);
$time    = time();

$logText = "Updated culture points for user $id by $cp CP";
$logEsc  = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) "
    . "VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// Redirect
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=player&uid=' . $id
);
exit;
?>