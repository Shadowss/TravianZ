<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       medals.php                                                  ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
#################################################################################
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../Account.php");

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/Database.php");

if(isset($_POST['medalid']) && !empty($_POST['medalid']) && is_numeric($_POST['medalid'])){
    $medalID = (int) $_POST['medalid'];
    mysqli_query($database->dblink, "UPDATE ".TB_PREFIX."medal set del = 1 WHERE id = ".$medalID."");
}
elseif(isset($_POST['userid']) && !empty($_POST['userid']) && is_numeric($_POST['userid'])){
    $userID = (int) $_POST['userid'];
    mysqli_query($database->dblink, "UPDATE ".TB_PREFIX."medal set del = 1 WHERE userid = ".$userID."");
}

$admidID = (int) $_SESSION['id'];
$name = $database->getUserField($adminID, "name", 0);
//TODO: Make a dedicated method for logging
mysqli_query($database->dblink, "INSERT INTO ".TB_PREFIX."admin_log values (0, $admid, 'Deleted medal id [#".$medalid."] from the user <a href=\'admin.php?p=player&uid=$uid\'>$name</a> ',".time().")");

header("Location: ../../../Admin/admin.php?p=player&uid=".$_POST['uid']."");
?>