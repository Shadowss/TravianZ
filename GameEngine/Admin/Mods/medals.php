<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       medals.php                                                  ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################
// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) admin_deny('You must be signed in as an administrator to view this page. Your session may have expired — please return to the admin panel and sign in again.');

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

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

$admid = (int) $_SESSION['id'];
$uid   = (int) ($_POST['uid'] ?? 0);
$name  = $database->escape((string) $database->getUserField($uid, "username", 0));
$medalLogId = isset($medalID) ? $medalID : 0;
//TODO: Make a dedicated method for logging
mysqli_query($database->dblink, "INSERT INTO ".TB_PREFIX."admin_log values (0, $admid, 'Deleted medal id [#".$medalLogId."] from the user <a href=\'admin.php?p=player&uid=$uid\'>$name</a> ',".time().")");

header("Location: ../../../Admin/admin.php?p=player&uid=".$uid);
?>