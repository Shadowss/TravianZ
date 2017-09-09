<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
include_once("../../Account.php");
mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysqli_select_db(SQL_DB);
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");  

$id = $_POST['id'];
$gold = $_POST['gold'];

	$q = "UPDATE ".TB_PREFIX."users SET gold = gold + ".$_POST['gold']." WHERE id != '0'";
	mysqli_query($GLOBALS["link"], $q);
	mysqli_query($GLOBALS["link"], "Insert into ".TB_PREFIX."admin_log values (0,$id,'Added <b>$gold</b> gold to all users',".time().")");


header("Location: ../../../Admin/admin.php?p=gold&g");
?>