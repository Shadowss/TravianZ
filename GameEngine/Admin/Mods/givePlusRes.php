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

$session = (int) $_POST['admid'];

$sql = mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session."");
$access = mysqli_fetch_array($sql);
$sessionaccess = $access['access'];

if($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$sql = "SELECT id FROM ".TB_PREFIX."users ORDER BY ID DESC LIMIT 1";
$loops = mysqli_result(mysqli_query($GLOBALS["link"], $sql), 0);

$wood = (int) $_POST['wood'] * 86400;
$clay = (int) $_POST['clay'] * 86400;
$iron = (int) $_POST['iron'] * 86400;
$crop = (int) $_POST['crop'] * 86400;

for($i = 0; $i < $loops + 1; $i++)
{
	$query = "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$i."";
	$result = mysqli_query($GLOBALS["link"], $query);
	while($row = mysqli_fetch_assoc($result))
	{
		if($row['b1'] < time()) { $b1before = time(); $addb1 = $b1before + $wood; } elseif($row['b1'] > time()) { $b1before = $row['b1']; $addb1 = $b1before + $wood; }
		if($row['b2'] < time()) { $b2before = time(); $addb2 = $b1before + $clay; } elseif($row['b2'] > time()) { $b2before = $row['b2']; $addb2 = $b1before + $clay; }
		if($row['b3'] < time()) { $b3before = time(); $addb3 = $b1before + $iron; } elseif($row['b3'] > time()) { $b3before = $row['b3']; $addb3 = $b1before + $iron; }
		if($row['b4'] < time()) { $b4before = time(); $addb4 = $b1before + $crop; } elseif($row['b4'] > time()) { $b4before = $row['b4']; $addb4 = $b1before + $crop; }
		mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET
			b1 = '".$addb1."', 
			b2 = '".$addb2."', 
			b3 = '".$addb3."', 
			b4 = '".$addb4."' 
			WHERE id = '".$row['id']."'");
	}
}

header("Location: ../../../Admin/admin.php?p=givePlusRes&g");
?>