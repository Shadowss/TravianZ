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
##  Filename       addABTroops.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

// ---------------------------------------------------------------------------
// CSRF + admin access
// ---------------------------------------------------------------------------
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel '
        . 'and sign in again.'
    );
}

// This file is POSTed to directly, so verify CSRF here.
csrf_verify();

// ---------------------------------------------------------------------------
// Database
// ---------------------------------------------------------------------------
include_once(__DIR__ . '/../../Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

// ---------------------------------------------------------------------------
// Update a1-a8 / b1-b8
// ---------------------------------------------------------------------------
$fields = [];

for ($i = 1; $i <= 8; $i++) {
    $a = (int)($_POST['a' . $i] ?? 0);
    $b = (int)($_POST['b' . $i] ?? 0);

    $fields[] = "a{$i} = {$a}";
    $fields[] = "b{$i} = {$b}";
}

$query = "UPDATE " . TB_PREFIX . "abdata
          SET " . implode(', ', $fields) . "
          WHERE vref = {$id}";

$database->query($query);

// ---------------------------------------------------------------------------
// Log admin action
// ---------------------------------------------------------------------------
$adminId = (int)($_SESSION['id'] ?? 0);
$time = time();

$village = $database->getVillage($id);

$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars(
    $villageName,
    ENT_QUOTES,
    'UTF-8'
);

$logText = "Changed troop upgrade levels in village "
    . "<a href='admin.php?p=village&did={$id}'>"
    . $villageNameSafe
    . "</a>";

$adminIdEsc = $database->escape((string)$adminId);
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log "
    . "(`id`, `user`, `log`, `time`) "
    . "VALUES (0, '{$adminIdEsc}', '{$logEsc}', {$time})"
);

// ---------------------------------------------------------------------------
// Redirect
// ---------------------------------------------------------------------------
header(
    "Location: ../../../Admin/admin.php?p=village&did={$id}&ab"
);
exit;
?>
