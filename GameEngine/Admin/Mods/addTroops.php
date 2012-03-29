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

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if ($session->access < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$village = $database->getVillage($id);  
$user = $database->getUserArray($village['owner'],1);  
$coor = $database->getCoor($village['wref']); 
$varray = $database->getProfileVillages($village['owner']); 
$type = $database->getVillageType($village['wref']);
$fdata = $database->getResourceLevel($village['wref']);
$units = $database->getUnit($village['wref']);

$u1 = $_POST['u1'];
$u2 = $_POST['u2'];
$u3 = $_POST['u3'];
$u4 = $_POST['u4'];
$u5 = $_POST['u5'];
$u6 = $_POST['u6'];
$u7 = $_POST['u7'];
$u8 = $_POST['u8'];
$u9 = $_POST['u9'];
$u10 = $_POST['u10'];
////////////////////
$u11 = $_POST['u11'];
$u12 = $_POST['u12'];
$u13 = $_POST['u13'];
$u14 = $_POST['u14'];
$u15 = $_POST['u15'];
$u16 = $_POST['u16'];
$u17 = $_POST['u17'];
$u18 = $_POST['u18'];
$u19 = $_POST['u19'];
$u20 = $_POST['u20'];
////////////////////
$u21 = $_POST['u21'];
$u22 = $_POST['u22'];
$u23 = $_POST['u23'];
$u24 = $_POST['u24'];
$u25 = $_POST['u25'];
$u26 = $_POST['u26'];
$u27 = $_POST['u27'];
$u28 = $_POST['u28'];
$u29 = $_POST['u29'];
$u30 = $_POST['u30'];
////////////////////
$u31 = $_POST['u31'];
$u32 = $_POST['u32'];
$u33 = $_POST['u33'];
$u34 = $_POST['u34'];
$u35 = $_POST['u35'];
$u36 = $_POST['u36'];
$u37 = $_POST['u37'];
$u38 = $_POST['u38'];
$u39 = $_POST['u39'];
$u40 = $_POST['u40'];
////////////////////
$u41 = $_POST['u41'];
$u42 = $_POST['u42'];
$u43 = $_POST['u43'];
$u44 = $_POST['u44'];
$u45 = $_POST['u45'];
$u46 = $_POST['u46'];
$u47 = $_POST['u47'];
$u48 = $_POST['u48'];
$u49 = $_POST['u49'];
$u50 = $_POST['u50'];

if($user['tribe'] == 1){
$q = "UPDATE ".TB_PREFIX."units SET u1 = $u1, u2 = $u2, u3 = $u3, u4 = $u4, u5 = $u5, u6 = $u6, u7 = $u7, u8 = $u8, u9 = $u9, u10 = $u10 WHERE vref = $id";
mysql_query($q);
} else if($user['tribe'] == 2){
$q = "UPDATE ".TB_PREFIX."units SET u11 = '$u11', u12 = '$u12', u13 = '$u13', u14 = '$u14', u15 = '$u15', u16 = '$u16', u17 = '$u17', u18 = '$u18', u19 = '$u19', u20 = '$u20' WHERE vref = $id";
mysql_query($q);
} else if($user['tribe'] == 3){
$q = "UPDATE ".TB_PREFIX."units SET u21 = '$u21', u22 = '$u22', u23 = '$u23', u24 = '$u24', u25 = '$u25', u26 = '$u26', u27 = '$u27', u28 = '$u28', u29 = '$u29', u30 = '$u30' WHERE vref = $id";
mysql_query($q);
} else if($user['tribe'] == 4){
$q = "UPDATE ".TB_PREFIX."units SET u31 = '$u31', u32 = '$u32', u33 = '$u33', u34 = '$u34', u35 = '$u35', u36 = '$u36', u37 = '$u37', u38 = '$u38', u39 = '$u39', u40 = '$u40' WHERE vref = $id";
mysql_query($q);
} else if($user['tribe'] == 5){
$q = "UPDATE ".TB_PREFIX."units SET u41 = '$u41', u42 = '$u42', u43 = '$u43', u44 = '$u44', u45 = '$u45', u46 = '$u46', u47 = '$u47', u48 = '$u48', u49 = '$u49', u50 = '$u50' WHERE vref = $id";
mysql_query($q);
}

mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Changed troop anmount in village <a href=\'admin.php?p=village&did=$id\'>$id</a> ',".time().")");

header("Location: ../../../Admin/admin.php?p=addTroops&did=".$id."&d");

?>
