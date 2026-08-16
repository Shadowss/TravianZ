<?php

// ============================================================
// TRAVIANZ MI INSTANCE / SESSION BOOTSTRAP
// ============================================================
require_once(__DIR__ . '/../../../Instance/Resolver.php');

$travianInstance = InstanceResolver::resolve(false);
InstanceResolver::startInstanceSession($travianInstance);

require_once(__DIR__ . '/../../../config.php');

if (file_exists(__DIR__ . '/../../../Lang/loader.php')) {
    require_once(__DIR__ . '/../../../Lang/loader.php');

    if (defined('LANG') && function_exists('tz_load_language')) {
        tz_load_language(LANG);
    }
}

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       giveResBonus.php                                            ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// ---------------------------------------------------------------------------
// CSRF / administration access
// ---------------------------------------------------------------------------
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// Ce fichier reçoit directement le POST : vérification CSRF obligatoire.
csrf_verify();

// ---------------------------------------------------------------------------
// Database
// ---------------------------------------------------------------------------
require_once(__DIR__ . '/../../Database.php');

// ---------------------------------------------------------------------------
// Vérification de l'administrateur
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);
$admin = $database->getUserArray($session, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$gold = (int)($_POST['gold'] ?? 0);

if ($gold <= 0) {
    header(
        'Location: ../../../Admin/admin.php?p=maintenenceResetPlusBonus&e=0'
    );
    exit;
}

$time = time();

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query(
    'UPDATE ' . TB_PREFIX .
    'users SET gold = gold + ' . $gold .
    ' WHERE id > 3'
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)($_SESSION['id'] ?? 0);

$logText = "Gave {$gold} gold to all players";
$logEsc = $database->escape($logText);

$database->query(
    'INSERT INTO ' . TB_PREFIX .
    'admin_log (`id`, `user`, `log`, `time`) ' .
    "VALUES (0, {$adminId}, '{$logEsc}', {$time})"
);

// ---------------------------------------------------------------------------
// Return to administration
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=maintenenceResetPlusBonus&g=1'
);
exit;
