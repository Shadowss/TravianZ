<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editBuildings.php                                           ##
##  Type        BACKEND                                                        ##
##  Developed by:  aggenkeech                                                  ##
##  Fix by:        ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2011-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die('<h1><font color="red">Access Denied: You are not Admin!</font></h1>');
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
include_once($autoprefix . "GameEngine/Automation.php");

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php?p=admin");
    exit;
}

// ---------------------------------------------------------------------------
// Construim SET-ul dinamic pentru f1-f40 și f99
// ---------------------------------------------------------------------------
$sets = [];
for ($i = 1; $i <= 40; $i++) {
    $level = (int)($_POST["id{$i}level"] ?? 0);
    $gid   = (int)($_POST["id{$i}gid"] ?? 0);
    // limităm la valori rezonabile Travian
    $level = max(0, min(20, $level));
    $gid   = max(0, min(40, $gid));
    $sets[] = "f{$i} = $level";
    $sets[] = "f{$i}t = $gid";
}

// câmpurile speciale f99 (capcană / zid?)
$level99 = (int)($_POST['id99level'] ?? 0);
$gid99   = (int)($_POST['id99gid'] ?? 0);
$sets[] = "f99 = " . max(0, min(20, $level99));
$sets[] = "f99t = " . max(0, min(40, $gid99));

$setSql = implode(', ', $sets);

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query("UPDATE " . TB_PREFIX . "fdata SET $setSql WHERE vref = $id");

// recalculăm populația după editare
$automation = new Automation();
$automation->recountPop($id);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();
$log = $database->escape("Edited buildings for village <a href='admin.php?p=village&did=$id'>$id</a>");
$database->query("INSERT INTO " . TB_PREFIX . "admin_log (`id`,`user`,`log`,`time`) VALUES (0,'$adminId','$log',$time)");

header("Location: ../../../Admin/admin.php?p=village&did=" . $id);
exit;
?>