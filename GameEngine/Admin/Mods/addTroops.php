<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       addTroops.php                                               ##
##  Developed by:  Dzoki & Advocatie                                           ##
##  License:       TravianZ Project                                            ##
##  Reworks by:    ronix                                                       ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
include_once("../../Database.php");
include_once("../../Technology.php");
include_once("../../Data/unitdata.php");

$id = (int)$_POST['id'];
$village = $database->getVillage($id);  
$user = $database->getUserArray($village['owner'],1);
$units = "";
$tribe = $user['tribe'];
$u = ($tribe - 1) * 10;

for($i = 1; $i < 11; $i++) {
	$units.="u".($u + $i)."=".$database->escape($_POST['u'.($u + $i)].(($i < 10) ? ", " : ""));
}

$q = "UPDATE ".TB_PREFIX."units SET ".$units." WHERE vref = ".$id;
$database->query($q);
$database->query("Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Changed troop amounts in village <a href=\'admin.php?p=village&did=$id\'>$id</a> ',".time().")");
$database->addStarvationData($id);
header("Location: ../../../Admin/admin.php?p=village&did=".$id."&d");
?>