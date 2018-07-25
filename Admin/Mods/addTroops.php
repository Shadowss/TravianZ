<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       addTroops.php                                               ##
##  Developed by:  Dzoki & Advocatie                                           ##
##  License:       TravianX Project                                            ##
##  Thanks to:     Dzoki & itay2277 (edit troops)                              ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

include_once("../../Account.php");
include_once("../../Technology.php");

if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$id = (int) $_POST['id'];
$village = $database->getVillage($id);
$user = $database->getUserArray($village['owner'],1);
$coor = $database->getCoor($village['wref']);
$varray = $database->getProfileVillages($village['owner']);
$type = $database->getVillageType($village['wref']);
$fdata = $database->getResourceLevel($village['wref']);
$units = $database->getUnit($village['wref']);

foreach ($_POST as $key => $value) {
    $_POST[$key] = (int) $value;
}

for($i = 1; $i <= 50; $i++) ${"u".$i} = $_POST['u'.$i];

if($user['tribe'] == 1){
    $q = "UPDATE ".TB_PREFIX."units SET u1 = $u1, u2 = $u2, u3 = $u3, u4 = $u4, u5 = $u5, u6 = $u6, u7 = $u7, u8 = $u8, u9 = $u9, u10 = $u10 WHERE vref = $id";
    mysqli_query($GLOBALS["link"], $q);
} else if($user['tribe'] == 2){
    $q = "UPDATE ".TB_PREFIX."units SET u11 = '$u11', u12 = '$u12', u13 = '$u13', u14 = '$u14', u15 = '$u15', u16 = '$u16', u17 = '$u17', u18 = '$u18', u19 = '$u19', u20 = '$u20' WHERE vref = $id";
    mysqli_query($GLOBALS["link"], $q);
} else if($user['tribe'] == 3){
    $q = "UPDATE ".TB_PREFIX."units SET u21 = '$u21', u22 = '$u22', u23 = '$u23', u24 = '$u24', u25 = '$u25', u26 = '$u26', u27 = '$u27', u28 = '$u28', u29 = '$u29', u30 = '$u30' WHERE vref = $id";
    mysqli_query($GLOBALS["link"], $q);
} else if($user['tribe'] == 4){
    $q = "UPDATE ".TB_PREFIX."units SET u31 = '$u31', u32 = '$u32', u33 = '$u33', u34 = '$u34', u35 = '$u35', u36 = '$u36', u37 = '$u37', u38 = '$u38', u39 = '$u39', u40 = '$u40' WHERE vref = $id";
    mysqli_query($GLOBALS["link"], $q);
} else if($user['tribe'] == 5){
    $q = "UPDATE ".TB_PREFIX."units SET u41 = '$u41', u42 = '$u42', u43 = '$u43', u44 = '$u44', u45 = '$u45', u46 = '$u46', u47 = '$u47', u48 = '$u48', u49 = '$u49', u50 = '$u50' WHERE vref = $id";
    mysqli_query($GLOBALS["link"], $q);
}

mysqli_query($GLOBALS["link"], "Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Changed troop anmount in village <a href=\'admin.php?p=village&did=$id\'>$id</a> ',".time().")");

$database->addStarvationData($village['wref']);

header("Location: ../../../Admin/admin.php?p=addTroops&did=".$id."&d");

?>