<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       renameVillage.php                                           ##
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
$session  = (int)($_POST['admid'] ?? 0);
$did      = (int)($_POST['did'] ?? 0);
$nameOrig = trim($_POST['villagename'] ?? '');

if ($did <= 0 || $nameOrig === '') {
    header("Location: ../../../Admin/admin.php?p=village&did=$did&e=1");
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
// Update
// ---------------------------------------------------------------------------
$nameEsc = $database->escape($nameOrig);
$database->query("UPDATE " . TB_PREFIX . "vdata SET name = '$nameEsc' WHERE wref = $did");

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();
$logText = "Renamed village <a href='admin.php?p=village&did=$did'>$did</a> to '$nameEsc'";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=village&did=" . $did);
exit;
?>