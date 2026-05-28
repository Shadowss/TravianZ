<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editResources.php                                           ##
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
$id      = (int)($_POST['did'] ?? 0);

if ($id <= 0 || $session <= 0) {
    header("Location: ../../../Admin/admin.php?p=admin&e=bad");
    exit;
}

// ---------------------------------------------------------------------------
// Verificare admin
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($session, 1);
if (!$admin || (int)$admin['access'] !== 9) {
    die('<h1><font color="red">Access Denied: You are not Admin!</font></h1>');
}

// ---------------------------------------------------------------------------
// Valori
// ---------------------------------------------------------------------------
$wood     = max(0, (int)($_POST['wood'] ?? 0));
$clay     = max(0, (int)($_POST['clay'] ?? 0));
$iron     = max(0, (int)($_POST['iron'] ?? 0));
$crop     = max(0, (int)($_POST['crop'] ?? 0));
$maxstore = max(0, (int)($_POST['maxstore'] ?? 0));
$maxcrop  = max(0, (int)($_POST['maxcrop'] ?? 0));

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "vdata SET 
        wood = $wood,
        clay = $clay,
        iron = $iron,
        crop = $crop,
        maxstore = $maxstore,
        maxcrop = $maxcrop
     WHERE wref = $id"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();

// FIX: nume sat + ID formatat
$village = $database->getVillage($id); // dacă nu e deja încărcat sus
$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');

$logText = "Edited resources for village <a href='admin.php?p=village&did=$id'>$villageNameSafe</a> (w:$wood c:$clay i:$iron cr:$crop)";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=village&did=" . $id);
exit;
?>