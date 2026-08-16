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
##  Filename       mainteneceBan.php                                           ##
##  Type           BACKEND                                                     ##
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

// Database.php utilise le bootstrap MI déjà chargé.
require_once(__DIR__ . '/../../GameEngine/Database.php');

// ---------------------------------------------------------------------------
// Vérification de l'administrateur transmis par le formulaire
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);

if ($session <= 0) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

$admin = $database->getUserArray($session, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$duration = (int)($_POST['duration'] ?? 0) * 3600;
$start    = trim((string)($_POST['start'] ?? ''));
$reason   = trim((string)($_POST['reason'] ?? 'Maintenance ban'));

// Access 2 = joueurs normaux.
$access = 2;

// ---------------------------------------------------------------------------
// Calcul de la période du ban
// ---------------------------------------------------------------------------
$startts = $start !== '' ? strtotime($start) : time();

if ($startts === false) {
    $startts = time();
}

if ($duration <= 0) {
    $duration = 86400; // 1 jour par défaut
}

$endts = $startts + $duration;

// ---------------------------------------------------------------------------
// Protection SQL
// ---------------------------------------------------------------------------
$reasonEsc = $database->escape($reason);
$adminId   = (int)$session;

// ---------------------------------------------------------------------------
// Ban en masse
//
// Tous les joueurs normaux (access = 2), hors comptes système id <= 3.
// Si un joueur possède déjà une entrée dans banlist, celle-ci est réactivée
// et ses informations de ban sont mises à jour.
// ---------------------------------------------------------------------------
$database->query(
    "INSERT INTO " . TB_PREFIX . "banlist
        (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`)
     SELECT
        `id`,
        `username`,
        '$reasonEsc',
        $startts,
        $endts,
        $adminId,
        1
     FROM " . TB_PREFIX . "users
     WHERE `access` = $access
       AND `id` > 3
     ON DUPLICATE KEY UPDATE
        `name`   = VALUES(`name`),
        `reason` = VALUES(`reason`),
        `time`   = VALUES(`time`),
        `end`    = VALUES(`end`),
        `admin`  = VALUES(`admin`),
        `active` = 1"
);

// ---------------------------------------------------------------------------
// Log administrateur
// ---------------------------------------------------------------------------
$durationHours = (int)($duration / 3600);

$logText = sprintf(
    "Mass ban for access=%d, duration=%dh, reason='%s'",
    $access,
    $durationHours,
    $reason
);

$logEsc = $database->escape($logText);
$logTime = time();

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log
        (`id`, `user`, `log`, `time`)
     VALUES
        (0, '$adminId', '$logEsc', $logTime)"
);

// ---------------------------------------------------------------------------
// Retour administration
// ---------------------------------------------------------------------------
header("Location: ../../../Admin/admin.php?p=ban&m=1");
exit;
?>
