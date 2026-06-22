<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.php                                                ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once("../../config.php");

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

$session = (int) $_POST['admid'];
$id = (int) $_POST['uid'];

$sql = mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session."");
$access = mysqli_fetch_array($sql);
$sessionaccess = $access['access'];

if($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

// Cast + whitelist the access level. $_POST['access'] was injected raw into
// the UPDATE below (SQL injection). Only accept the values the admin form
// offers: 0=Banned, 2=Normal user, 8=Multihunter, 9=Admin.
$access = (int) $_POST['access'];
if (!in_array($access, array(0, 2, 8, 9), true)) {
	die("Invalid access level");
}

mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET
	access = ".$access."
	WHERE id = ".$id."") or die(mysqli_error($database->dblink));

header("Location: ../../../Admin/admin.php?p=player&uid=".$id."");
?>