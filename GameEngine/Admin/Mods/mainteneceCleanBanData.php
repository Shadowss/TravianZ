<?php

// ============================================================
// TRAVIANZ MI INSTANCE / SESSION BOOTSTRAP
// ============================================================
require_once(__DIR__ . '/../../Instance/Resolver.php');

$travianInstance = InstanceResolver::resolve(false);
InstanceResolver::startInstanceSession($travianInstance);

require_once(__DIR__ . '/../../config.php');

if (file_exists(__DIR__ . '/../../Lang/loader.php')) {
    require_once(__DIR__ . '/../../Lang/loader.php');

    if (defined('LANG') && function_exists('tz_load_language')) {
        tz_load_language(LANG);
    }
}

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       mainteneceCleanBanData.php                                  ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// ============================================================
// CSRF / ADMIN ACCESS
// ============================================================
require_once(__DIR__ . '/../csrf.php');

if (
    !isset($_SESSION['access']) ||
    (int)$_SESSION['access'] < 9
) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// Ce fichier est appelé directement en POST depuis l'administration.
csrf_verify();

// ============================================================
// DATABASE
// ============================================================
require_once(__DIR__ . '/../../GameEngine/Database.php');

// ============================================================
// VERIFICATION DE L'ADMIN TRANSMIS EN POST
// ============================================================
$session = (int)($_POST['admid'] ?? 0);

if ($session <= 0) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

$admin = $database->getUserArray($session, 1);

if (
    !$admin ||
    (int)$admin['access'] !== 9
) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ============================================================
// NETTOYAGE DE LA BANLIST
// ============================================================
$database->query(
    "TRUNCATE TABLE " . TB_PREFIX . "banlist"
);

// ============================================================
// LOG ADMINISTRATEUR
// ============================================================
$adminId = (int)$_SESSION['id'];
$time = time();

$logText = 'Cleared banlist (TRUNCATE)';
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

// ============================================================
// RETOUR ADMIN
// ============================================================
header('Location: ../../../Admin/admin.php?p=ban&c=1');
exit;
?>