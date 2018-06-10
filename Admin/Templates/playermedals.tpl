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
					if(empty($varmedal)){ ?>
						<td colspan="5"><div style="text-align: center">This player has no medals yet</div></td><?php
					}
					elseif(!empty($varmedal)){
						foreach($varmedal as $medal){
							$title = "Bonus";
							switch ($medal['categorie']){
							    case 1: $title = "Attackers"; break;
							    case 2: $title = "Defenders"; break;
							    case 3:	$title = "Climbers"; break;
							    case 4:	$title = "Robbers"; break;
							    case 5:	$title = "Top 10 Att and Def"; break;
							    case 6:	$title = "Top 3 Att, ".$medal['points']." in a row"; break;
							    case 7:	$title = "Top 3 Def,".$medal['points']." in a row"; break;
							    case 8:	$title = "Top 3 Climber, ".$medal['points']." in a row"; break;
							    case 9:	$title = "Top 3 Robber, ".$medal['points']." in a row"; break;
							    case 10: $title = "Climber of the week"; break;
							    case 11: $title = "Top 3 Climber,  ".$medal['points']." in a row"; break;
							    case 12: $title = "Top 10 Attacker, ".$medal['points']." in a row"; break;
							}

							$rank = $medal['plaats'];
							if($rank == 0) $rank = "<p>Bonus</p>";
							
							$week = $medal['week'];
							$points = $medal['points'];
							if($points == '') $points = "<p>Bonus</p>";

							echo"
								<tr>
									<td>$title</td>
									<td>$rank</td>
									<td>$week</td>
									<td>$points</td>
									<td><img src=\"../gpack/travian_default/img/t/".$medal['img'].".jpg\"></td>
                                    <form action=\"../GameEngine/Admin/Mods/medals.php\" method=\"POST\">
									   <td>
                                            <input type=\"hidden\" name=\"uid\" value=\"".$_GET['uid']."\">
                                            <input type=\"hidden\" name=\"medalid\" value=\"".$medal['id']."\" >
										    <input type=\"image\" style=\"background-image: url('../gpack/travian_default/img/a/del.gif'); height: 12px; width: 12px;\" src=\"../gpack/travian_default/img/a/x.gif\">
									   </td>
                                    </form>
								</tr>";
						}

						$averagerank = 0;
						foreach($varmedal as $medal){
							$rank = $medal['plaats'];
							if($rank > 0){
								if(is_numeric($rank)){
									$i++;
									$averagerank += $medal['plaats'];
								}
							}
						}
						$average = round($averagerank / $i, 1);
						echo "</form><tr><td><b>Average Rank</b></td><td>$average</td><td></td><td></td><td>Delete All</td>";
					}
				?>
					<td>
						<form action="../GameEngine/Admin/Mods/medals.php" method="POST">
							<input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
							<input type="hidden" name="userid" value="<?php echo $id; ?>">
							<input type="image" style="background-image: url('../gpack/travian_default/img/a/del.gif'); height: 12px; width: 12px;" src="../gpack/travian_default/img/a/x.gif">				
						</form>
					</td>			
			</tbody>
		</table>
