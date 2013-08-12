<form action="../GameEngine/Admin/Mods/medals.php" method="POST">
			<input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
			<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
			<table id="profile">
				<thead>
					<tr>
						<th colspan="6">Player Medals (<?php echo sizeof($varmedal); ?>)</th>
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
						<td colspan="5"><center>This player has no medals yet</center></td><?php
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
									<td><img src=\"../gpack/travian_default/img/t/".$medal['img'].".jpg\"></td>
									<td>
										<input type=\"image\" name=\"medalid\" value=\"".$medal['id']."\" style=\"background-image: url('../gpack/travian_default/img/a/del.gif'); height: 12px; width: 12px;\" src=\"../gpack/travian_default/img/a/x.gif\">
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
					<form action="../GameEngine/Admin/Mods/deletemedalbyuser.php" method="POST">
						<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
						<input type="image" name="userid" value="<?php echo $id; ?>" style="background-image: url('../gpack/travian_default/img/a/del.gif'); height: 12px; width: 12px;" src="../gpack/travian_default/img/a/x.gif">
					</form>
				</td>
			</tbody>
		</table>
