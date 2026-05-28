<?php

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

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die(defined('ACCESS_DENIED_ADMIN') ? ACCESS_DENIED_ADMIN : 'Access Denied: You are not Admin!');
}

include_once __DIR__ . "/../../Database.php";
include_once __DIR__ . "/../../Technology.php";
include_once __DIR__ . "/../../Data/unitdata.php";

/* ---------------------------------------------------------------------------
 * Input & validare
 * --------------------------------------------------------------------------- */
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

$village = $database->getVillage($id);
$user = $database->getUserArray($village['owner'], 1);
$tribe = (int)$user['tribe'];
$u = ($tribe - 1) * 10;

/* ---------------------------------------------------------------------------
 * Construiește SET pentru u1-u10 / u11-u20 etc.
 * - originalul concatena escape($_POST + ",") greșit
 * - aici cast la int + implode
 * --------------------------------------------------------------------------- */
$fields = [];
for ($i = 1; $i <= 10; $i++) {
    $unitId = $u + $i;
    $val = (int)($_POST['u' . $unitId] ?? 0);
    $fields[] = "u$unitId = $val";
}

$q = "UPDATE " . TB_PREFIX . "units SET " . implode(", ", $fields) . " WHERE vref = $id";
$database->query($q);

/* ---------------------------------------------------------------------------
 * Log admin - adaptat pentru tabelul tău
 * --------------------------------------------------------------------------- */
$adminId = (string)(int)$_SESSION['id'];
$time = time();

// FIX AICI
$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');

$logText = "Changed troop amounts in village <a href='admin.php?p=village&did=$id'>$villageNameSafe</a>";

$adminIdEsc = $database->escape($adminId);
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminIdEsc', '$logEsc', $time)"
);

$database->addStarvationData($id);

header("Location: ../../../Admin/admin.php?p=village&did=" . $id . "&d");
exit;
?>