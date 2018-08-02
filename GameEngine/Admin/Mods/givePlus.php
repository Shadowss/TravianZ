<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       mainteneceBan.php                                           ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

function mysqli_result($res, $row, $field=0) {
	$res->data_seek($row);
	$datarow = $res->fetch_array();
	return $datarow[$field];
}

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

$sql = "SELECT id FROM ".TB_PREFIX."users ORDER BY ID DESC LIMIT 1";
$loops = mysqli_result(mysqli_query($GLOBALS["link"], $sql), 0);

$plusdur = $_POST['plus'] * 86400;

for($i = 0; $i < $loops + 1; $i++)
{
	$query = "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$i."";
	$result = mysqli_query($GLOBALS["link"], $query);
	while($row = mysqli_fetch_assoc($result))
	{
		if($row['plus'] < time()) { $plusbefore = time(); $addplus = $plusbefore + $plusdur; } elseif($row['plus'] > time()) { $plusbefore = $row['plus']; $addplus = $plusbefore + $plusdur; }
		mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET
			plus = '".$addplus."' 
			WHERE id = '".$row['id']."'");
	}
}

header("Location: ../../../Admin/admin.php?p=givePlus&g");
?>