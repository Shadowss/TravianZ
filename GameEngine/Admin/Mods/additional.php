<?php

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        additional.tpl                                                 ##
## Type         BACKEND                                                        ##
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

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

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
$vac_mode = (int)($_POST['vac_mode']?? 0);

if($id <= 0) die("Invalid user");

// --- GOLD LOGIC ---
$oldGold = (int)$database->getUserField($id, 'gold', 1);
$diffGold = $newGold - $oldGold;

// --- UPDATE USER ---
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
        dpall = $dpall,
        vac_mode = $vac_mode
    WHERE id = $id
");

// --- LOG GOLD dacă s-a modificat ---
if($diffGold!== 0){
    $vill = $database->getVillagesID($id);
    $wid = $vill[0]?? 0;
    $action = $diffGold > 0? 'Admin added Gold' : 'Admin removed Gold';
    $details = 'Admin adjustment by '.($session->username?? 'Admin');
    $now = time();

    // folosește mysqli_real_escape_string dacă $database->query nu face escape automat
    $action_esc = mysqli_real_escape_string($GLOBALS["link"], $action);
    $details_esc = mysqli_real_escape_string($GLOBALS["link"], $details);

    $database->query("
        INSERT INTO ".TB_PREFIX."gold_fin_log
        (uid, wid, action, gold, time, details)
        VALUES ($id, $wid, '$action_esc', $diffGold, $now, '$details_esc')
    ");
}

// --- LOG ADMIN (cu UID, nu nume) ---
$adminUid = $admid > 0? $admid : (int)($_SESSION['id']?? 0); // FIX AICI
$adminName = $database->getUserField($adminUid, 'username', 0)?: 'Admin';
$playerName = $database->getUserField($id, 'username', 0)?: 'Unknown';
$protectDays = (int)($_POST['protect']?? 0);

$logParts = [];
$logParts[] = "Gold: $oldGold → $newGold". ($diffGold!=0? " ($diffGold)" : "");
$logParts[] = "VacMode: $vac_mode";
$logParts[] = "Access: $access";
$logParts[] = "Protect: {$protectDays}d";
$logParts[] = "Sitters: $sit1/$sit2";

$logText = "[$adminName] edited Additional for [$playerName] (UID:$id) - ". implode(' | ', $logParts);
$logText = addslashes($logText);

$now = time();
$database->query("
    INSERT INTO ".TB_PREFIX."admin_log
    (`user`, `log`, `time`)
    VALUES ('$adminUid', '$logText', $now)
");

// --- REDIRECT ---
header("Location:../../../Admin/admin.php?p=player&uid=".$id);
exit;
?>