<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##  Improved:      aggenkeech                                                  ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
include("../GameEngine/config.php");
$id = $_SESSION['id'];

$sql = mysqli_fetch_array(mysqli_query($GLOBALS["link"], "SELECT Count(*) as Total FROM ".TB_PREFIX."medal"), MYSQLI_ASSOC);
$nummedals = $sql['Total'];
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
			$sql = mysqli_fetch_array(mysqli_query($GLOBALS["link"], "SELECT Count(*) as Total FROM ".TB_PREFIX."medal"), MYSQLI_ASSOC);
			$tot = $sql['Total'];
			$sql = mysqli_query($GLOBALS["link"], "SELECT week FROM ".TB_PREFIX."medal ORDER BY week DESC LIMIT 1");
			if(mysqli_num_rows($sql) > 0){
			$week = mysqli_result($sql, 0);
			echo "<tr><td><center>$week</center></td><td><center>$tot</center></td></tr>";
			}else{
			echo "<tr><td><center>0</center></td><td><center>$tot</center></td></tr>";
			}
		?>
	</tbody>
</table>
<br />
<br />



<form action="../GameEngine/Admin/Mods/deletemedalbyweek.php" method="POST">
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

				$sql = mysqli_fetch_array(mysqli_query($GLOBALS["link"], "SELECT Count(*) as Total FROM ".TB_PREFIX."medal WHERE week = $newweek"), MYSQLI_ASSOC);
				$tot = $sql['Total'];

				echo "<tr><td>$newweek</td><td>$tot</td><td><input type=\"image\" name=\"medalweek\" value=\"".$newweek."\" style=\"background-image: url('../gpack/travian_default/img/a/del.gif'); height: 12px; width: 12px;\" src=\"../gpack/travian_default/img/a/x.gif\"></td>";
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
			$query = "SELECT * FROM ".TB_PREFIX."medal ORDER BY id DESC";
			$result = mysqli_query($GLOBALS["link"], $query);
			while($row = mysqli_fetch_array($result))
			{
				$i = $i + 1;
				$titel="Bonus";
				switch ($row['categorie'])
				{
					case "1": 	$titel="Attackers"; break;
					case "2": 	$titel="Defenders"; break;
					case "3":	$titel="Climbers"; break;
					case "4":	$titel="Robbers"; break;
					case "5":	$titel="Top 10 Att and Def"; break;
					case "6":	$titel="Top 3 Att, ".$medal['points']." in a row"; break;
					case "7":	$titel="Top 3 Def,".$medal['points']." in a row"; break;
					case "8":	$titel="Top 3 Climber, ".$medal['points']." in a row"; break;
					case "9":	$titel="Top 3 Robber, ".$medal['points']." in a row"; break;
					case "10":	$titel="Climber of the week"; break;
					case "11":	$titel="Top 3 Climber,  ".$medal['points']." in a row"; break;
					case "12":	$titel="Top 10 Attacker, ".$medal['points']." in a row"; break;
				}
				$title = $titel;
				$rank = $row['plaats'];
				$week = $row['week'];
				$points = $row['points'];
				$bb = $row['id'];
				$playerid = (int) $row['userid'];

				$unq = "SELECT username FROM ".TB_PREFIX."users where id = $playerid";
				$user = mysqli_result(mysqli_query($GLOBALS["link"], $unq), 0);
				$username = $user;

				$player = "<a href=\"admin.php?p=player&uid=".$playerid."\">$username</a>";
				echo"
				<tr>
					<td>$i</td>
					<td>[#$bb]</td>
					<td><img src=\"../../gpack/travian_default/img/t/".$row['img'].".jpg\"></td>
					<td>$player</td>
					<td>$rank</td>
					<td>$week</td>
					<td>$points</td>
				</tr>";
			}
		?>
	</tbody>
</table>