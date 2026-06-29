<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.php                                                    ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################
// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) admin_deny('You must be signed in as an administrator to view this page. Your session may have expired — please return to the admin panel and sign in again.');

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once("../../config.php");

error_reporting(E_ALL);

// autoloader
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) break;
}
include_once($autoprefix."GameEngine/Database.php");

$admid = (int)($_POST['admid'] ?? 0);
$amount = (int)($_POST['gold'] ?? 0);

if($amount == 0){
    header("Location: ../../../Admin/admin.php?p=gold");
    exit;
}

// verificare admin
$check = mysqli_query($GLOBALS["link"], "SELECT access, username FROM ".TB_PREFIX."users WHERE id = $admid");
$acc = mysqli_fetch_assoc($check);
if(!$acc || $acc['access'] != 9) admin_deny('You must be signed in as an administrator to view this page. Your session may have expired — please return to the admin panel and sign in again.');

// 1. UPDATE gold la toți (id > 3 = sare peste Natars etc)
mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET gold = gold + $amount WHERE id > 3") or die(mysqli_error($GLOBALS["link"]));

// 2. LOG în admin_log
mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."admin_log VALUES (0, $admid, 'Added <b>$amount</b> gold to ALL players', ".time().")");

// 3. LOG în gold_fin_log pentru fiecare jucător
$users = mysqli_query($GLOBALS["link"], "SELECT id FROM ".TB_PREFIX."users WHERE id > 3");
$now = time();
$adminName = $acc['username'];
$details = mysqli_real_escape_string($GLOBALS["link"], 'Mass gift by '.$adminName);

while($u = mysqli_fetch_assoc($users)){
    $uid = (int)$u['id'];
    $vill = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT wref FROM ".TB_PREFIX."vdata WHERE owner = $uid LIMIT 1"));
    $wid = (int)($vill['wref'] ?? 0);
    
    mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."gold_fin_log (wid, uid, action, gold, time, details) VALUES ($wid, $uid, 'Admin added Gold', $amount, $now, '$details')");
}

header("Location: ../../../Admin/admin.php?p=gold&g");
exit;
?>