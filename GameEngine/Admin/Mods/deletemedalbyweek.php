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
##  Filename       deletemedalsbyweek.php                                      ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

// ---------------------------------------------------------------------------
// Vérification de l'accès administrateur
// ---------------------------------------------------------------------------
if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Vérification CSRF
// Ce fichier est appelé directement en POST depuis l'administration.
// ---------------------------------------------------------------------------
csrf_verify();

// ---------------------------------------------------------------------------
// Chargement de la base de données
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
$deleteweek = (int)($_POST['medalweek'] ?? 0);
$session    = (int)($_POST['admid'] ?? 0);

if ($deleteweek <= 0 || $session <= 0) {
    header('Location: ../../../Admin/admin.php?p=delmedal&e=bad');
    exit;
}

// ---------------------------------------------------------------------------
// Vérification supplémentaire de l'administrateur transmis en POST
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($session, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Suppression logique des médailles joueurs pour la semaine indiquée
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "medal
     SET del = 1
     WHERE week = $deleteweek
       AND del = 0"
);

$affected = mysqli_affected_rows($database->dblink);

// ---------------------------------------------------------------------------
// Log administrateur
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();

$logText = "Deleted player medals for week $deleteweek ($affected rows)";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// Retour vers la gestion des médailles
// ---------------------------------------------------------------------------
header(
    "Location: ../../../Admin/admin.php?p=delmedal" .
    "&week=$deleteweek&deleted=$affected"
);
exit;
?>