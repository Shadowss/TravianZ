<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.php                                                ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$session = $_POST['admid'];
$id = $_POST['id'];

$sql = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session."");
$access = mysql_fetch_array($sql);
$sessionaccess = $access['access'];

if($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

mysql_query("UPDATE ".TB_PREFIX."users SET 
	email = '".$_POST['email']."', 
	tribe = ".$_POST['tribe'].", 
	location = '".$_POST['location']."', 
	desc1 = '".$_POST['desc1']."', 
	desc2 = '".$_POST['desc2']."', 
	quest = '".$_POST['quest']."' 
	WHERE id = $id") or die(mysql_error());

header("Location: ../../../Admin/admin.php?p=player&uid=".$id."");
?>