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

include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$session = $_POST['admid'];

$sql = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session."");
$access = mysql_fetch_array($sql);
$sessionaccess = $access['access'];

if($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$users = mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users"));

$duration = $_POST['duration'] * 3600;
$start = $_POST['start'];
$startts = strtotime($start);
$endts = $startts + $duration;
$reason = $_POST['reason'];
$admin = $session;
$active = '1';
$access = '2';

$sql = "SELECT id FROM ".TB_PREFIX."users ORDER BY ID DESC LIMIT 1";
$loops = mysql_result(mysql_query($sql), 0);

for($i = 0; $i < $loops + 1; $i++)
{
	$query = "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$i." AND access = ".$access."";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result))
	{
		##mysql_query("INSERT INTO ".TB_PREFIX."banlist ".$row['id'].", ".$row['username'].", ".$reason.", ".$startts.", ".$endts.", ".$admin.", ".$active."");
		mysql_query("INSERT INTO ".TB_PREFIX."banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES (".$row['id'].", '".$row['username']."' , '$reason', '$startts', '$endts', '$admin', '1')");
	}
}

header("Location: ../../../Admin/admin.php?p=ban");
?>