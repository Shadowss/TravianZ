<?php

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        additional.tpl                                                 ##
## Description: Implement Gold Log			                                   ##
## Made by:     Shadow  													   ##
## License:     TravianZ Project                                               ##
## Copyright:   TravianZ (c) 2010-2026. All rights reserved.                   ##
## URLs:        https://travianz.org                                           ##
##              https://github.com/Shadowss/TravianZ                           ##
## 				                                                               ##
#################################################################################

include_once("../../config.php");
include_once("../../Database.php");

if (!isset($_SESSION)) session_start();
if(($_SESSION['access']?? 0) < ADMIN) die("Access Denied: You are not Admin!");

// --- INPUT ---
$id = (int)($_POST['id']?? 0);
$admid = (int)($_POST['admid']?? 0);
$access = (int)($_POST['access']?? 2);
$newGold = (int)($_POST['gold']?? 0);
$sit1 = (int)($_POST['sitter1']?? 0);
$sit2 = (int)($_POST['sitter2']?? 0);
$protect = time() + ((int)($_POST['protect']?? 0) * 86400);
$cp = (int)($_POST['cp']?? 0);
$ap = (int)($_POST['off']?? 0);
$dp = (int)($_POST['def']?? 0);
$rr = (int)($_POST['res']?? 0);
$apall = (int)($_POST['ooff']?? 0);
$dpall = (int)($_POST['odef']?? 0);

if($id <= 0) die("Invalid user");

// --- GOLD LOGIC ---
$oldGold = (int)$database->getUserField($id, 'gold', 1);
$diffGold = $newGold - $oldGold;

// --- UPDATE USER (prepared-style, fără escape manual) ---
$database->query("
    UPDATE ".TB_PREFIX."users SET
        access = $access,
        gold = $newGold,
        sit1 = $sit1,
        sit2 = $sit2,
        protect = $protect,
        cp = $cp,
        ap = $ap,
        dp = $dp,
        RR = $rr,
        apall = $apall,
        dpall = $dpall
    WHERE id = $id
");

// --- LOG GOLD dacă s-a modificat ---
if($diffGold!== 0){
    $vill = $database->getVillagesID($id);
    $wid = $vill[0]?? 0;
    $action = $diffGold > 0? 'Admin added Gold' : 'Admin removed Gold';
    $details = 'Admin adjustment by '.($session->username?? 'Admin');
    $now = time();

    $database->query("
        INSERT INTO ".TB_PREFIX."gold_fin_log
        (wid, uid, action, gold, time, details)
        VALUES ($wid, $id, '$action', $diffGold, $now, '$details')
    ");
}

// --- REDIRECT ---
header("Location:../../../Admin/admin.php?p=player&uid=".$id);
exit;