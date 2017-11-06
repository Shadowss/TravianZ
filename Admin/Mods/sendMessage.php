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

$query = "INSERT INTO ".TB_PREFIX."mdata  SET target = $uid, owner = 1, topic = '$topic', message = '$message', viewed = 0, archived = 0, send = 0, time = $time, deltarget = 0, delowner = 0, alliance = 0, player = 0, coor = 0, report = 0";
mysqli_query($GLOBALS["link"], $query) OR DIE (mysqli_errno($GLOBALS["link"]));

header("Location: ../../../Admin/admin.php?p=Newmessage&uid=".$uid."&msg=ok");
?>