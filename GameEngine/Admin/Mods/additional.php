<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       cp.php                                                      ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
include_once("../../config.php");
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
$GLOBALS["link"] = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysqli_select_db($GLOBALS["link"], SQL_DB);

$id = $_POST['id'];
$admid = $_POST['admid'];

//$sql = mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$admid."");
//$access = mysqli_fetch_array($sql);
//$sessionaccess = $access['access'];
if (!isset($_SESSION)) {
 session_start();
}

if($_SESSION['access'] != ADMIN) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$access = $_POST['access'];
$dur = $_POST['protect'] * 86400;
$protection = (time() + $dur);

mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET 
	access = ".$access.",
	gold = ".$_POST['gold'].",	
	sit1 = '".$_POST['sitter1']."',
	sit2 = '".$_POST['sitter2']."',
	protect = '".$protection."',
	cp = ".$_POST['cp'].",
	ap = '".$_POST['off']."', 
	dp = '".$_POST['def']."', 
	RR = '".$_POST['res']."', 
	apall = '".$_POST['ooff']."', 
	dpall = '".$_POST['odef']."' 
	WHERE id = ".$id."") or die(mysqli_error($database->dblink));

header("Location: ../../../Admin/admin.php?p=player&uid=".$id."");
?>