<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editBuildings.php                                           ##
##  Type        BACKEND                                                        ##
##  Developed by:  aggenkeech                                                  ##
##  Fix by:        ronix + Shadow 2026 (WW lvl 100 + auto pop)                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2011-2026. All rights reserved.                ##
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
    $gid   = max(0, min(44, $gid)); // 44 = ziduri speciale
    $sets[] = "f{$i} = $level";
    $sets[] = "f{$i}t = $gid";
}

// câmpurile speciale f99
$level99 = (int)($_POST['id99level'] ?? 0);
$gid99   = (int)($_POST['id99gid'] ?? 0);

// --- FIX WW: gid 40 = World Wonder, level maxim 100 ---
if ($gid99 == 40) {
    $level99 = max(0, min(100, $level99));
} else {
    $level99 = max(0, min(20, $level99)); // capcană, etc.
}
$gid99 = max(0, min(44, $gid99));

$sets[] = "f99 = " . $level99;
$sets[] = "f99t = " . $gid99;

$setSql = implode(', ', $sets);

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query("UPDATE " . TB_PREFIX . "fdata SET $setSql WHERE vref = $id");

// ---------------------------------------------------------------------------
// recalculăm populația după editare
// ---------------------------------------------------------------------------
$automation = new Automation();
$pop = $automation->recountPop($id);

// --- FIX: recountPop original nu include f99 (WW), îl adăugăm ---
$fdata = $database->getResourceLevel($id);
if ((int)$fdata['f99t'] === 40) {
    $wwLevel = (int)$fdata['f99'];
    if ($wwLevel > 0) {
        // buildingPOP există în Automation
        $wwPop = $automation->buildingPOP(40, $wwLevel);
        $pop += $wwPop;
        $database->query("UPDATE " . TB_PREFIX . "vdata SET pop = $pop WHERE wref = $id");
    }
}

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