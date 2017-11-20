<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       medals.php                                                  ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
#################################################################################

include_once("../../Account.php");

if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$medalid = (int) $_POST['medalid'];
$uid = (int) $_POST['uid'];
$admid = (int) $_POST['admid'];

mysqli_query($GLOBALS["link"], "DELETE FROM ".TB_PREFIX."medal WHERE id = ".$medalid."");

$name = mysqli_query($GLOBALS["link"], "SELECT name FROM ".TB_PREFIX."users WHERE id= ".$uid."");
$name = mysqli_result($name, 0);

mysqli_query($GLOBALS["link"], "Insert into ".TB_PREFIX."admin_log values (0,$admid,'Deleted medal id [#".$medalid."] from the user <a href=\'admin.php?p=player&uid=$uid\'>$name</a> ',".time().")");


$deleteweek = (int) $_POST['medalweek'];
mysqli_query($GLOBALS["link"], "DELETE FROM ".TB_PREFIX."medal WHERE week = ".$deleteweek."");

header("Location: ../../../Admin/admin.php?p=player&uid=".$uid."");
?>