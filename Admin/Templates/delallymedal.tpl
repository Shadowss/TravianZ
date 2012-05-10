<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##  Improved:      aggenkeech                                                  ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
include("../GameEngine/config.php");
$id = $_SESSION['id'];
$sql = mysql_query("SELECT * FROM ".TB_PREFIX."allimedal");
$nummedals = mysql_num_rows($sql);
?>


<style>
	.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
</style>
<table id="member">
	<thead>
		<tr>
			<th>Medal Information</th>
		</tr>
	</thead> 
</table>
<table id="profile">
	<thead>
		<tr>
			<td>Week</td>
			<td>Medals</td>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql = mysql_query("SELECT * FROM ".TB_PREFIX."allimedal");
			$tot = mysql_num_rows($sql);
			$sql = mysql_query("SELECT week FROM ".TB_PREFIX."allimedal ORDER BY week DESC LIMIT 1");
			if(mysql_num_rows($sql) > 0){
			$week = mysql_result($sql, 0);
			echo "<tr><td><center>$week</center></td><td><center>$tot</center></td></tr>";
			}else{
			echo "<tr><td><center>0</center></td><td><center>$tot</center></td></tr>";
			}
		?>
	</tbody>
</table>
<br />
<br />



<form action="../GameEngine/Admin/Mods/delallymedalbyweek.php" method="POST">
<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
<table id="member">
	<thead>
		<tr>
			<th>Medal Week by Week</th>
		</tr>
	</thead> 
</table>
<table id="profile">
	<thead>
		<tr>
			<td>Week</td>
			<td>Medals</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<?php
			for($j = 0; $j<$week; $j++)
			{
				$newweek = $j+1;
				$sql = mysql_query("SELECT * FROM ".TB_PREFIX."allimedal WHERE week = $newweek");
				$tot = mysql_num_rows($sql);
				echo "<tr>
				<td>$newweek</td>
				<td>$tot</td>
				<td><input type=\"image\" name=\"deleteweek\" value=\"".$newweek."\" style=\"background-image: url('../gpack/travian_default/img/a/del.gif'); height: 12px; width: 12px;\" src=\"../gpack/travian_default/img/a/x.gif\"></td>";
			}
		?>
	</tbody>
</table>
</form>
<br />
<br />

<table id="member">
	<thead>
		<tr>
			<th>All Medals (<?php echo $nummedals; ?>)</th>
		</tr>
	</thead> 
</table>
<table id="profile">
	<thead>
		<tr>
			<td>Medal</td>
			<td>BB-Code</td>
			<td>Type</td>
			<td>Player</td>
			<td>Rank</td>
			<td>Week</td>
			<td>Points</td>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = "SELECT * FROM ".TB_PREFIX."allimedal ORDER BY id DESC";
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result))
			{
				$i = $i + 1;
				$titel="Bonus";
				switch ($row['categorie']) 
				{
					case "1": 	$titel="Attackers"; break;
					case "2": 	$titel="Defenders"; break;
					case "3":	$titel="Climbers"; break;
					case "4":	$titel="Robbers"; break;
				}
				$title = $titel;
				$rank = $row['plaats'];
				$week = $row['week'];
				$points = $row['points'];
				$bb = $row['id'];
				$allyid = $row['allyid'];
				
				$unq = "SELECT name FROM ".TB_PREFIX."alidata WHERE id = ".$allyid."";
				$user = mysql_result(mysql_query($unq), 0);
				$allyname = $user;
				
				$alliance = '<a href="admin.php?p=alliance&aid='.$allyid.'">'.$allyname.'</a>';
				echo"
				<tr>
					<td>$i</td>
					<td>[#$bb]</td>
					<td><img src=\"../../gpack/travian_default/img/t/".$row['img'].".jpg\"></td>
					<td>$alliance</td>
					<td>$rank</td>
					<td>$week</td>
					<td>$points</td>
				</tr>";
			}
		?>
	</tbody>
</table>