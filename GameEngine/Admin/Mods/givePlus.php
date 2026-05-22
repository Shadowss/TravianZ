<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       givePlus.php                                                ##
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
$days = (int)($_POST['plus'] ?? 0);
if ($days <= 0) {
    header("Location: ../../../Admin/admin.php?p=givePlus&e=0");
    exit;
}

$plusdur = $days * 86400;
$time = time();

// ---------------------------------------------------------------------------
// Update în masă – fără loop
// ---------------------------------------------------------------------------
// Dacă plus < now, pornește de acum, altfel adaugă la timpul existent
$database->query(
    "UPDATE " . TB_PREFIX . "users 
     SET plus = IF(plus < $time, $time + $plusdur, plus + $plusdur) 
     WHERE id > 3"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$logText = "Gave $days days Plus to all players";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=givePlus&g=1");
exit;
?>