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
##  Filename       givePlus.php                                                ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.               ##
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
// INPUT
// ============================================================
$days = (int)($_POST['plus'] ?? 0);

if ($days <= 0) {
    header('Location: ../../../Admin/admin.php?p=givePlus&e=0');
    exit;
}

$plusdur = $days * 86400;
$time = time();

// ============================================================
// AJOUT DU PLUS À TOUS LES JOUEURS
// ============================================================
//
// Si le Plus actuel est expiré, il repart de maintenant.
// Sinon, la nouvelle durée est ajoutée à la durée existante.
//
// id > 3 permet de ne pas modifier les comptes système/Natars.
// ============================================================
$database->query(
    "UPDATE " . TB_PREFIX . "users
     SET plus = IF(plus < $time, $time + $plusdur, plus + $plusdur)
     WHERE id > 3"
);

// ============================================================
// LOG ADMINISTRATEUR
// ============================================================
$adminId = (int)$_SESSION['id'];
$logText = "Gave $days days Plus to all players";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '$adminId', '$logEsc', $time)"
);

// ============================================================
// RETOUR ADMIN
// ============================================================
header('Location: ../../../Admin/admin.php?p=givePlus&g=1');
exit;
?>