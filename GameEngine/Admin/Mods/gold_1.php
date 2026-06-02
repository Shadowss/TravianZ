<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold_1.php                                                  ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");

include_once("../../config.php");
include_once("../../Database.php");

$admid  = (int)($_POST['admid'] ?? 0);
$id     = (int)($_POST['id'] ?? 0);
$amount = (int)($_POST['gold'] ?? 0);

if($id <= 0 || $amount == 0){
    header("Location: ../../../Admin/admin.php?p=usergold");
    exit;
}

// verificare admin
$check = mysqli_query($GLOBALS["link"], "SELECT access, username FROM ".TB_PREFIX."users WHERE id = $admid");
$acc = mysqli_fetch_assoc($check);
if(!$acc || $acc['access'] != 9) die("<h1><font color=\"red\">Access Denied</font></h1>");

// 1. UPDATE GOLD
mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET gold = gold + $amount WHERE id = $id") or die(mysqli_error($GLOBALS["link"]));

// 2. ADMIN LOG
$name = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT username FROM ".TB_PREFIX."users WHERE id = $id"))['username'];
$name = mysqli_real_escape_string($GLOBALS["link"], $name);
mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."admin_log VALUES (0, $admid, 'Added <b>$amount</b> gold to user <a href=\'admin.php?p=player&uid=$id\'>$name</a>', ".time().")");

// 3. GOLD_FIN_LOG (pentru a2b2.php)
$vill = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT wref FROM ".TB_PREFIX."vdata WHERE owner = $id LIMIT 1"));
$wid = (int)($vill['wref'] ?? 0);
$action = $amount > 0 ? 'Admin added Gold' : 'Admin removed Gold';
$adminName = $acc['username'];
$details = mysqli_real_escape_string($GLOBALS["link"], 'Admin gift by '.$adminName);
$now = time();

mysqli_query($GLOBALS["link"], 
    "INSERT INTO ".TB_PREFIX."gold_fin_log (uid, wid, action, gold, time, log) 
     VALUES ($id, $wid, '$action', $amount, $now, '$details')"
) or die(mysqli_error($GLOBALS["link"]));

header("Location: ../../../Admin/admin.php?p=usergold&g");
exit;
?>