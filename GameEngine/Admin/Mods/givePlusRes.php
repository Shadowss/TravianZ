<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       givePlusRes.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die("Access Denied: You are not Admin!");
}

include_once("../../config.php");

// ---------------------------------------------------------------------------
// Autoloader path
// ---------------------------------------------------------------------------
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . "GameEngine/Database.php");

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);
$admin = $database->getUserArray($session, 1);
if (!$admin || (int)$admin['access'] !== 9) {
    die('<h1><font color="red">Access Denied: You are not Admin!</font></h1>');
}

$wood = (int)($_POST['wood'] ?? 0) * 86400;
$clay = (int)($_POST['clay'] ?? 0) * 86400;
$iron = (int)($_POST['iron'] ?? 0) * 86400;
$crop = (int)($_POST['crop'] ?? 0) * 86400;

if ($wood + $clay + $iron + $crop == 0) {
    header("Location: ../../../Admin/admin.php?p=givePlusRes&e=0");
    exit;
}

$time = time();

// ---------------------------------------------------------------------------
// Update în masă
// ---------------------------------------------------------------------------
if ($wood > 0) {
    $database->query("UPDATE " . TB_PREFIX . "users SET b1 = IF(b1 < $time, $time + $wood, b1 + $wood) WHERE id > 3");
}
if ($clay > 0) {
    $database->query("UPDATE " . TB_PREFIX . "users SET b2 = IF(b2 < $time, $time + $clay, b2 + $clay) WHERE id > 3");
}
if ($iron > 0) {
    $database->query("UPDATE " . TB_PREFIX . "users SET b3 = IF(b3 < $time, $time + $iron, b3 + $iron) WHERE id > 3");
}
if ($crop > 0) {
    $database->query("UPDATE " . TB_PREFIX . "users SET b4 = IF(b4 < $time, $time + $crop, b4 + $crop) WHERE id > 3");
}

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$logText = "Gave res bonuses to all: wood=" . ($_POST['wood'] ?? 0) . "d, clay=" . ($_POST['clay'] ?? 0) . "d, iron=" . ($_POST['iron'] ?? 0) . "d, crop=" . ($_POST['crop'] ?? 0) . "d";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=givePlusRes&g=1");
exit;
?>