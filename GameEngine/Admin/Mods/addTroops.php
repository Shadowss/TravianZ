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

$id = $_POST['id'];
$village = $database->getVillage($id);  
$user = $database->getUserArray($village['owner'],1);  
$units="";
	$tribe = $user['tribe'];
	if($tribe ==1){ $u = 0;}
	if($tribe ==2){ $u = 10;}
	if($tribe ==3){ $u = 20;}
	if($tribe ==4){ $u = 30;}
	if($tribe ==5){ $u = 40;}
	if($tribe ==6){ $u = 50;}

for($i=1; $i<11; $i++) {
	$units.="u".($u+$i)."=".$_POST['u'.($u+$i)].(($i < 10) ? ", " : "");
}
$q = "UPDATE ".TB_PREFIX."units SET ".$units." WHERE vref = $id";
$database->query($q);
$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Changed troop anmount in village <a href=\'admin.php?p=village&did=$id\'>$id</a> ',".time().")");

header("Location: ../../../Admin/admin.php?p=village&did=".$id."&d");
?>