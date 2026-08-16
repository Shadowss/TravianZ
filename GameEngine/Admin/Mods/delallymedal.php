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
##  Filename       delallymedal.php                                            ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

// Database.php utilise le bootstrap MI déjà chargé ci-dessus.
require_once(__DIR__ . '/../../GameEngine/Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$delete  = (int)($_POST['medalid'] ?? 0);
$aid     = (int)($_POST['aid'] ?? 0);
$session = (int)($_POST['admid'] ?? 0);

if ($delete <= 0 || $aid <= 0 || $session <= 0) {
    header(
        "Location: ../../../Admin/admin.php?p=alliance&aid=" .
        $aid .
        "&e=bad"
    );
    exit;
}

// ---------------------------------------------------------------------------
// Vérification de l'administrateur
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($session, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Suppression logique de la médaille
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "allimedal " .
    "SET del = 1 " .
    "WHERE id = $delete AND allyid = $aid"
);

// Nombre de lignes effectivement modifiées
$affected = (int)$database->dblink->affected_rows;

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];

$logText = "Deleted ally medal #$delete (affected $affected) for ally $aid";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', " . time() . ")"
);

// ---------------------------------------------------------------------------
// Retour administration
// ---------------------------------------------------------------------------
header(
    "Location: ../../../Admin/admin.php?p=alliance&aid=" . $aid
);
exit;
?>
