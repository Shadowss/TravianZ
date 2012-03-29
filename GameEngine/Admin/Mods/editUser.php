<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.php                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if ($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$user = $database->getUserArray($id,1);
mysql_query("UPDATE ".TB_PREFIX."users SET email = '".$_POST['email']."', tribe = ".$_POST['tribe'].", location = '".$_POST['location']."', desc1 = '".$_POST['desc1']."', `desc2` = '".$_POST['desc2']."' WHERE id = ".$_POST['id']."");
mysql_query("Insert into ".TB_PREFIX."admin_log values (0,".$_SESSION['id'].",'Changed <a href=\'admin.php?p=village&did=$id\'>".$user['username']."</a>\'s profile',".time().")");


header("Location: ../../../Admin/admin.php?p=player&uid=".$id."");
?>