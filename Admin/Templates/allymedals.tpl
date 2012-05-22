<?php
	$varmedal = $database->getProfileMedalAlly($_GET['aid'])
?>
<form action="../GameEngine/Admin/Mods/delallymedal.php" method="POST">
	<input type="hidden" name="aid" value="<?php echo $_GET['aid']; ?>">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<table id="profile"> 
		<thead>
			<tr>
				<th colspan="6">Alliance Medals (<?php echo sizeof($varmedal); ?>)</th>
			</tr>
			<tr>
				<td>Category</td>
				<td>Rank</td>
				<td>Week</td>
				<td>Points</td>
				<td>Medal</td>
				<td></td>
			</tr>
		</thead>
			<?php
				if(sizeof($varmedal) ==0)
				{ ?>
					<td colspan="5"><center>This alliance has no medals yet</center></td><?php 
				}
				elseif(sizeof($varmedal) >0)
				{
					foreach($varmedal as $medal) 
					{
						$titel="Bonus";
						switch ($medal['categorie']) 
						{
							case "1": 	$titel="Attackers"; break;
							case "2": 	$titel="Defenders"; break;
							case "3":	$titel="Climbers"; break;
							case "4":	$titel="Robbers"; break;
						}
						$title = $titel;
						$rank = $medal['plaats'];
						if($rank == '0') { $rank = "<p>Bonus</p>"; } else { $rank = $rank; }
						$week = $medal['week'];
						$points = $medal['points'];
						if($points == '') { $points = "<p>Bonus</p>"; } else { $points = $points; }
						
						echo"
							<tr>
								<td>$title</td>
								<td>$rank</td>
								<td>$week</td>
								<td>$points</td>
								<td><img src=\"../<?php echo GP_LOCATE; ?>img/t/".$medal['img'].".jpg\"></td>
								<td>
									<input type=\"image\" name=\"medalid\" value=\"".$medal['id']."\" style=\"background-image: url('../<?php echo GP_LOCATE; ?>img/a/del.gif'); height: 12px; width: 12px;\" src=\"../<?php echo GP_LOCATE; ?>img/a/x.gif\">
								</td>
							</tr>";
						}
						
						$averagerank = 0;
						foreach($varmedal as $medal)
						{
							$rank = $medal['plaats'];
							if($rank > 0)
							{
								if(is_numeric($rank))
								{
									$i = $i + 1;
									$averagerank = $averagerank + $medal['plaats'];
								}
								else
								{
									$averagerank = $averagerank + 0;
								}
							}
						}
						$average = $averagerank / $i;
						echo "</form><tr><td><b>Average Rank</b></td><td>$average</td><td></td><td></td><td>Delete All</td>"; 
					}
				?>
				<td>
					<form action="../GameEngine/Admin/Mods/delallymedalbyaid.php" method="POST">
						<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
						<input type="hidden" name="aid" value="<?php echo $_GET['aid']; ?>">
						<input type="image" name="allyid" value="<?php echo $id; ?>" style="background-image: url('../<?php echo GP_LOCATE; ?>img/a/del.gif'); height: 12px; width: 12px;" src="../<?php echo GP_LOCATE; ?>img/a/x.gif">
					</form>
				</td>
			</tbody>
		</table>