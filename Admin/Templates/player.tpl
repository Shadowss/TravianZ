<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       player.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
$id = $_GET['uid'];
if(isset($id))
{
	include_once("../GameEngine/Ranking.php");
	$varmedal = $database->getProfileMedal($id);
	$profiel="".$user['desc1']."".md5('skJkev3')."".$user['desc2']."";
	$separator="../";
	require("../Templates/Profile/medal.php");
	$profiel=explode("".md5('skJkev3')."", $profiel);
	$varray = $database->getProfileVillages($id);
	$refreshiconfrm = "../img/admin/refresh.png";
	$refreshicon  = "<img src=\"".$refreshiconfrm."\">";
	if($user){
		$totalpop = 0;
		foreach($varray as $vil) $totalpop += $vil['pop'];

		include('search2.tpl');
		echo "<br />";
		$deletion = false;
		if($deletion) include("playerdeletion.tpl");

        include("playerinfo.tpl");
        include("playerheroinfo.tpl");
        include("playeradditionalinfo.tpl");  
		echo "<br />";
		include("playermedals.tpl");
		include ("villages.tpl"); ?>

		<div style="float: left;">
			<?php
				include ('punish.tpl');
			?>
		</div>
		<div style="float: right;">
			<?php
				include ('add_village.tpl');
			?>
		</div>

		<?php
			$sql = "SELECT * FROM ".TB_PREFIX."banlist WHERE uid = ".(int) $id."";
			$numbans = mysqli_num_rows(mysqli_query($GLOBALS["link"], $sql));
		?>
		<table id="member" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th colspan="6">Ban History (<?php echo $numbans; ?>)</th>
				</tr>
				<tr>
					<td class="hab"><b>Start</b></td>
					<td class="hab"><b>End</b></td>
					<td class="hab"><b>Duration</b></td>
					<td class="on"><b>Reason</b></td>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = mysqli_query($GLOBALS["link"], $sql);
					while($row = mysqli_fetch_assoc($result))
					{
						echo '
							<tr>
								<td class="hab">'.date('d:m:Y H:i', $row['time']).'</td>
								<td class="hab">'.date('d:m:Y H:i', $row['end']).'</td>
								<td class="hab">'.round((($row['end'] - $row['time']) / 3600), 2).' minutes</td>
								<td class="on">'.$row['reason'].'</td>
							</tr>';
					}
				?>
			</tbody>
		</table>
		<?php
	}
	else include("404.tpl");
}
?>