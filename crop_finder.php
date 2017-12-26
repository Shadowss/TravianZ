<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

/*-------------------------------------------------------*\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Developed by:  Manni < manuel_mannhardt@web.de >        |
|                Dzoki < dzoki.travian@gmail.com >        |
| Copyright:     TravianX Project All rights reserved     |
\*-------------------------------------------------------*/

   use App\Utils\AccessLogger;

   include_once("GameEngine/Village.php");
   AccessLogger::logRequest();

   if($session->goldclub == 0) {
	   header("Location: plus.php?id=3");
	   exit;
   }

   if($_POST['type'] == 15) {
	   header("Location: ".$_SERVER['PHP_SELF']."?s=1&x=" . preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['x']) . '&y=' . preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['y']));
	   exit;
   } elseif($_POST['type'] == 9) {
	   header("Location: ".$_SERVER['PHP_SELF']."?s=2&x=" . preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['x']) . '&y=' . preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['y']));
	   exit;
   } elseif($_POST['type'] == 'both') {
	   header("Location: ".$_SERVER['PHP_SELF']."?s=3&x=" . preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['x']) . '&y=' . preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['y']));
	   exit;
   }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php

   echo SERVER_NAME

?> - Crop Finder</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php

   echo GP_LOCATE;

?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php

   echo GP_LOCATE;

?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<?php

   if($session->gpack == null || GP_ENABLE == false) {
   echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
   }
   else {
   echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
   }

?>
	<script type="text/javascript">

		window.addEvent('domready', start);
	</script>
</head>


<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php

   include ("Templates/header.tpl");

?>
<div id="mid">
<?php

   include ("Templates/menu.tpl");

   if(is_numeric($_GET['x']) AND is_numeric($_GET['y'])) {
	   $coor2['x'] = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['x']);
	   $coor2['y'] = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['y']);
   } else {
	   $wref2 = $village->wid;
	   $coor2 = $database->getCoor($wref2);
   }

?>
<div id="content"  class="player">

<h1>Crop Finder</h1>
<div style="text-align: center">
<img width="200" src="gpack/travian_default/img/g/f6.jpg" />
<img width="200" src="gpack/travian_default/img/g/f1.jpg" />
</div>
<br /><br />
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?s" method="post">
 <table>
  <tr>
   <td width="100">Search for:</td>
   <td width="250">
	<input type="radio" class="radio" name="type" value="15" <?php if($_GET['s'] == 1) { print 'checked="checked"'; } ?> /> 15 crop
	<input type="radio" class="radio" name="type" value="9" <?php if($_GET['s'] == 2) { print 'checked="checked"'; } ?> /> 9 crop
	<input type="radio" class="radio" name="type" value="both" <?php if($_GET['s'] == 3) { print 'checked="checked"'; } ?> /> both<br />
   </td>
  </tr>
  <tr>
   <td>Startposition:</td>
   <td>x: <input type="text" name="x" value="<?php print $coor2['x']; ?>" size="3" /> y: <input type="text" name="y" value="<?php print $coor2['y']; ?>"  size="3" /></td>
  </tr>
  <tr>
   <td colspan="2"><input type="submit" name="submit" value="Search" /></td>
  </tr>
 </table>
</form>

<?php

   define('PREFIX', TB_PREFIX);
   $type15 = mysqli_query($GLOBALS['link'],"SELECT id,x,y,occupied FROM ".PREFIX."wdata WHERE fieldtype = 6");
   $type9 = mysqli_query($GLOBALS['link'],"SELECT id,x,y,occupied FROM ".PREFIX."wdata WHERE fieldtype = 1");
   $type_both = mysqli_query($GLOBALS['link'],"SELECT id,x,y,occupied,fieldtype FROM ".PREFIX."wdata WHERE fieldtype = 1 OR fieldtype = 6");

   if(is_numeric($_GET['x']) AND is_numeric($_GET['y'])) {
	   $coor['x'] = $_GET['x'];
	   $coor['y'] = $_GET['y'];
   } else {
	   $wref = $village->wid;
	   $coor = $database->getCoor($wref);
   }

	  function getDistance($coorx1, $coory1, $coorx2, $coory2) {
   $max = 2 * WORLD_MAX + 1;
   $x1 = intval($coorx1);
   $y1 = intval($coory1);
   $x2 = intval($coorx2);
   $y2 = intval($coory2);
   $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
   $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
   $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
   return round($dist, 1);
   }

   if($_GET['s'] == 1) {

?>
 <table id="member">
	<thead>
	<tr>
		<th colspan='5'>Crop Finder - 15c</th>
	</tr>
	<tr>
		<td>Type</td>
		<td>Coordinates</td>
		<td>Owner</td>
		<td>Occupied</td>
		<td>Distance</td>
	</tr>
	</thead><tbody>

<?php

   while($row = mysqli_fetch_array($type15)) {
	   $dist = getDistance($coor['x'], $coor['y'], $row['x'], $row['y']);

	   $rows[$dist] = $row;

   }
   ksort($rows);
   foreach($rows as $dist => $row) {

	   echo "<tr>";
	   echo "<td>15c</td>";
	   if($row['occupied'] == 0) {
		   echo "<td><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$database->getVillageField($row['id'], "name")." (".$row['x']."|".$row['y'].")</td>";
		   echo "<td>-</td>";
		   echo "<td><b><font color=\"green\">Unoccupied</b></font></td>";
	   } else {
		   echo "<td><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$database->getVillageField($row['id'], "name")." (".$row['x']."|".$row['y'].")</a></td>";
		   echo "<td><a href=\"spieler.php?uid=".$database->getVillageField($row['id'], "owner")."\">".$database->getUserField($database->getVillageField($row['id'], "owner"), "username", 0)."</a></td>";
		   echo "<td><b><font color=\"red\">Occupied</b></font></td>";
	   }
	   echo "<td><div style=\"text-align: center\">".getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</div></td>";
   }

?>

</tbody></table>

<?php

   }
   else if($_GET['s'] == 2) {

?>
<table id="member">
	<thead>
	<tr>
		<th colspan='5'>Crop Finder - 9c</th>
	</tr>
	<tr>
		<td>Type</td>
		<td>Coordinates</td>
		<td>Owner</td>
		<td>Occupied</td>
		<td>Distance</td>
	</tr>
	</thead><tbody>

<?php

   unset($rows);
   while($row = mysqli_fetch_array($type9)) {
	   $dist = getDistance($coor['x'], $coor['y'], $row['x'], $row['y']);

	   $rows[$dist] = $row;

   }
   ksort($rows);
   foreach($rows as $dist => $row) {


	   echo "<tr>";
	   echo "<td>9c</td>";
	   if($row['occupied'] == 0) {
		   echo "<td><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$database->getVillageField($row['id'], "name")." (".$row['x']."|".$row['y'].")</td>";
		   echo "<td>-</td>";
		   echo "<td><b><font color=\"green\">Unoccupied</b></font></td>";
	   } else {
		   echo "<td><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$database->getVillageField($row['id'], "name")." (".$row['x']."|".$row['y'].")</a></td>";
		   echo "<td><a href=\"spieler.php?uid=".$database->getVillageField($row['id'], "owner")."\">".$database->getUserField($database->getVillageField($row['id'], "owner"), "username", 0)."</a></td>";
		   echo "<td><b><font color=\"red\">Occupied</b></font></td>";
	   }
	   echo "<td><div style=\"text-align: center\">".getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</div></td>";
   }

?>

</tbody></table>

<?php

   }
   else if($_GET['s'] == 3) {

?>
<table id="member">
	<thead>
	<tr>
		<th colspan='5'>Crop Finder - 9c and 15c</th>
	</tr>
	<tr>
		<td>Type</td>
		<td>Coordinates</td>
		<td>Owner</td>
		<td>Occupied</td>
		<td>Distance</td>
	</tr>
	</thead><tbody>

<?php

   unset($rows);
   while($row = mysqli_fetch_array($type_both)) {
	   $dist = getDistance($coor['x'], $coor['y'], $row['x'], $row['y']);

	   $rows[$dist] = $row;

   }
   ksort($rows);
   foreach($rows as $dist => $row) {

	   if($row['fieldtype'] == 1) {
		   $field = '9c';
	   } elseif($row['fieldtype'] == 6) {
		   $field = '15c';
	   }

	   echo "<tr>";
	   echo "<td>" . $field . "</td>";
	   if($row['occupied'] == 0) {
		   echo "<td><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$database->getVillageField($row['id'], "name")." (".$row['x']."|".$row['y'].")</td>";
		   echo "<td>-</td>";
		   echo "<td><b><font color=\"green\">Unoccupied</b></font></td>";
	   } else {
		   echo "<td><a href=\"karte.php?d=".$row['id']."&c=".$generator->getMapCheck($row['id'])."\">".$database->getVillageField($row['id'], "name")." (".$row['x']."|".$row['y'].")</a></td>";
		   echo "<td><a href=\"spieler.php?uid=".$database->getVillageField($row['id'], "owner")."\">".$database->getUserField($database->getVillageField($row['id'], "owner"), "username", 0)."</a></td>";
		   echo "<td><b><font color=\"red\">Occupied</b></font></td>";
	   }
	   echo "<td><div style=\"text-align: center\">".getDistance($coor['x'], $coor['y'], $row['x'], $row['y'])."</div></td>";
   }

?>

</tbody></table>

<?php

   }
?>
</div>
<br /><br /><br /><br /><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
include("Templates/links.tpl");
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php

   include ("Templates/footer.tpl");
   include ("Templates/res.tpl");

?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
Calculated in <b><?php

echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000);

?></b> ms

<br />Server time: <span id="tp1" class="b"><?php

   echo date('H:i:s');

?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
