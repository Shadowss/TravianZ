```php
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
##  Filename       addTroops.php                                               ##
##  Type           BACKEND                                                     ##
##  Developed by:  Dzoki & Advocatie                                           ##
##  License:       TravianZ Project                                            ##
##  Reworks by:    ronix                                                       ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

include_once(__DIR__ . "/../../Database.php");
include_once(__DIR__ . "/../../Technology.php");
include_once(__DIR__ . "/../../Data/unitdata.php");

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

// ---------------------------------------------------------------------------
// Village / owner
// ---------------------------------------------------------------------------
$village = $database->getVillage($id);

if (!$village) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

$user = $database->getUserArray((int)$village['owner'], 1);

if (!$user) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

// ---------------------------------------------------------------------------
// Tribe / unit offset
// ---------------------------------------------------------------------------
$tribe = (int)$user['tribe'];
$u = ($tribe - 1) * 10;

// ---------------------------------------------------------------------------
// Update units
// ---------------------------------------------------------------------------
$fields = [];

for ($i = 1; $i <= 10; $i++) {
    $unitId = $u + $i;
    $value = max(0, (int)($_POST['u' . $unitId] ?? 0));

    $fields[] = "u{$unitId} = {$value}";
}

$database->query(
    "UPDATE " . TB_PREFIX . "units SET " .
    implode(", ", $fields) .
    " WHERE vref = {$id}"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();

$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars(
    $villageName,
    ENT_QUOTES,
    'UTF-8'
);

$logText = "Changed troop amounts in village <a href='admin.php?p=village&did={$id}'>{$villageNameSafe}</a>";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, {$adminId}, '{$logEsc}', {$time})"
);

// ---------------------------------------------------------------------------
// Recalculate starvation
// ---------------------------------------------------------------------------
$database->addStarvationData($id);

// ---------------------------------------------------------------------------
// Redirect
// ---------------------------------------------------------------------------
header("Location: ../../../Admin/admin.php?p=village&did={$id}&d");
exit;
?>
