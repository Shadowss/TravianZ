<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       sendMessage.php                                             ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
#################################################################################

include_once("../../GameEngine/Account.php");
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");  

foreach ($_POST as $key => $value) {
    $_POST[$key] = $database->escape($value);
}

$uid = (int) $_POST['uid'];
$topic = $_POST['topic'];
$message = $_POST['message'];
$time = time();

$query = "INSERT INTO ".TB_PREFIX."mdata  VALUES ('', '$uid', 1, '$topic', '$message', 0, 0, 0, '$time', 0, 0, 0, 0, 0, 0)";
mysqli_query($GLOBALS["link"], $query) OR DIE (mysqli_errno($GLOBALS["link"]));

header("Location: ../../../Admin/admin.php?p=Newmessage&uid=".$uid."&msg=ok");
?>