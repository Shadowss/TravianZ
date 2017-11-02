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
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../Database.php");
$status="&ce=1";

foreach ($_POST as $key => $value) {
    $_POST[$key] = $database->escape($value);
}

if(isset($_POST['id']) && isset($_POST['hid'])) {
	$_POST['hname'] = trim(stripslashes($_POST['hname']));
	if ($_POST['hname']=="") {
		header("Location: ../../../Admin/admin.php?p=editHero&uid=".$_POST['id']."&e=1");
		exit;
	}	
		
	include_once("../../Data/hero_full.php"); 
	
	$id = (int) $_POST['id'];
	$hid = (int) $_POST['hid'];
	
	$q = "UPDATE ".TB_PREFIX."hero SET unit=".(int) $_POST['hunit'].", name='".$_POST['hname']."', level=".(int) $_POST['hlvl'].", points=".(int) $_POST['exp'].", experience=".(int) $hero_levels[$_POST['hlvl']].", health='".$_POST['hhealth']."',
		attack=".(int) $_POST['hatk'].", defence=".(int) $_POST['hdef'].", attackbonus=".(int) $_POST['hob'].", defencebonus=".(int) $_POST['hdb'].", regeneration=".(int) $_POST['hrege']." WHERE heroid = ".$hid." AND uid = ".$id;
$return=$database->query($q);
if($return) {
    $database->query("Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Changed hero info',".time().")");
	$status="&cs=1";
}	
}
header("Location: ../../../Admin/admin.php?p=player&uid=".$id.$status);
?>