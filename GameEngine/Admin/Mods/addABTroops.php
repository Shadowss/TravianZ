<?php

// ============================================================
// TRAVIANZ MI INSTANCE / SESSION BOOTSTRAP
// ============================================================
require_once(__DIR__ . '/../../Instance/Resolver.php');

$travianInstance = InstanceResolver::resolve(false);
InstanceResolver::startInstanceSession($travianInstance);

// config.php est à la racine de TravianZ
require_once(__DIR__ . '/../../../config.php');

// Chargement de la langue
if (file_exists(__DIR__ . '/../../../Lang/loader.php')) {
    require_once(__DIR__ . '/../../../Lang/loader.php');

    if (defined('LANG') && function_exists('tz_load_language')) {
        tz_load_language(LANG);
    }
}

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       addABTroops.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
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
// Input
// ---------------------------------------------------------------------------
$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: ../../../Admin/admin.php');
    exit;
}

// ---------------------------------------------------------------------------
// Update a1-a8 / b1-b8
// ---------------------------------------------------------------------------
$fields = [];

for ($i = 1; $i <= 8; $i++) {
    $a = (int)($_POST['a' . $i] ?? 0);
    $b = (int)($_POST['b' . $i] ?? 0);

    // Empêche les valeurs négatives.
    $a = max(0, $a);
    $b = max(0, $b);

    $fields[] = "a{$i} = {$a}";
    $fields[] = "b{$i} = {$b}";
}

$query = sprintf(
    'UPDATE %sabdata SET %s WHERE vref = %d',
    TB_PREFIX,
    implode(', ', $fields),
    $id
);

$database->query($query);

// ---------------------------------------------------------------------------
// Admin log
// ---------------------------------------------------------------------------
$adminId = (int)($_SESSION['id'] ?? 0);
$time = time();

// Récupération du village pour le journal d'administration.
$village = $database->getVillage($id);

$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars(
    $villageName,
    ENT_QUOTES,
    'UTF-8'
);

$logText =
    "Changed troop upgrade levels in village " .
    "<a href='admin.php?p=village&did={$id}'>" .
    $villageNameSafe .
    '</a>';

$adminIdEsc = $database->escape((string)$adminId);
$logEsc = $database->escape($logText);

$database->query(
    'INSERT INTO ' . TB_PREFIX .
    'admin_log (`id`, `user`, `log`, `time`) ' .
    "VALUES (0, '{$adminIdEsc}', '{$logEsc}', {$time})"
);

// ---------------------------------------------------------------------------
// Return to village administration
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=village&did=' .
    $id .
    '&ab'
);
exit;

