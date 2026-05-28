<?php
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

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die("Access Denied: You are not Admin!");
}

include_once __DIR__ . "/../../Database.php";

/* ---------------------------------------------------------------------------
 * Input
 * --------------------------------------------------------------------------- */
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

$village = $database->getVillage($id);

/* ---------------------------------------------------------------------------
 * Update a1-a8 / b1-b8
 * --------------------------------------------------------------------------- */
$fields = [];
for ($i = 1; $i <= 8; $i++) {
    $a = (int)($_POST['a' . $i] ?? 0);
    $b = (int)($_POST['b' . $i] ?? 0);
    $fields[] = "a$i = $a";
    $fields[] = "b$i = $b";
}

$q = "UPDATE " . TB_PREFIX . "abdata SET " . implode(", ", $fields) . " WHERE vref = $id";
$database->query($q);

/* ---------------------------------------------------------------------------
 * Log admin - adaptat pentru structura ta:
 * CREATE TABLE `s1_admin_log` (`id` int, `user` text, `log` text, `time` int)
 * --------------------------------------------------------------------------- */
$adminId = (string)(int)$_SESSION['id'];
$time = time();

// FIX: luăm numele satului
$village = $database->getVillage($id); // dacă nu-l ai deja sus, lasă linia asta
$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');

$logText = "Changed troop upgrade levels in village <a href='admin.php?p=village&did=$id'>$villageNameSafe</a>";

// escapăm corect pentru coloana TEXT
$adminIdEsc = $database->escape($adminId);
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminIdEsc', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=village&did=" . $id . "&ab");
exit;
?>