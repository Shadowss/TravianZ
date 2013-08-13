		<table id="member">
			<thead>
				<tr>
					<th colspan="2">Additional Information</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Access</td>
					<td>
						<?php
							if($user['access'] == 0)
							{
								echo "Banned";
							}
							else if($user['access'] == 2)
							{
								echo "Normal user";
							}
							else if($user['access'] == 8)
							{
								echo "<b>Multihunter</b>";
							}
							else if($user['access'] == 9)
							{
								echo "<b>Administrator</b>";
							}
						?> <a href="admin.php?p=editAccess&uid=<?php echo $_GET['uid']; ?>"><img src="../img/admin/edit.gif" title="Give Gold"></a>
					</td>
				</tr>
				<tr>
					<td>Gold</td>
					<td><img src="../img/admin/gold.gif"> <?php echo $user['gold']; ?> <a href='admin.php?p=player&uid=<?php echo $id; ?>&g'><img src="../img/admin/edit.gif" title="Give Gold"></a>
				</tr>
				<?php
					if($_SESSION['access'] == ADMIN)
					{
						if($_GET['g'] == 'ok')
						{
							echo '';
						}
						else
						{
							if(isset($_GET['g']))
							{ ?>
								<form action="../GameEngine/Admin/Mods/gold_1.php" method="POST">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
									<tr>
										<td>Give how much Gold?</td>
										<td>
											<input class="give_gold" name="gold" value="0">
											<input type="image" src="../gpack/travian_default/img/new/tick.png" value="submit">
											<a href="admin.php?p=player&uid=<?php echo $id; ?>"><img src="../img/admin/del.gif" title="Cancel"></a></td>
									</tr>
								</form><?php
							}
						}
					}
				?>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Sitter 1</td>
					<td><a href="?p=editSitter&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Sitters"></a>
						<?php
							if($user['sit1'] >= 1)
							{
								echo '<a href="admin.php?p=player&uid='.$user['sit1'].'">'.$database->getUserField($user['sit1'],"username",0).'</a>';
							}
							else if($user['sit1'] == 0)
							{
								echo 'No Sitter';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Sitter 2</td>
					<td><a href="?p=editSitter&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Sitters"></a>
						<?php
							if($user['sit2'] >= 1)
							{
								echo '<a href="admin.php?p=player&uid='.$user['sit2'].'">'.$database->getUserField($user['sit2'],"username",0).'</a>';
							}
							else if($user['sit2'] == 0)
							{
								echo 'No Sitter';
							}
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Beginners Protection</td>
					<td>
						<?php
							$datetime = $user['protect'];
							$now = time();
							if($datetime ==0)
							{
								echo '<img src="../img/admin/del.gif">';
								echo "<font color=\"red\"> No Protection</font>";
							}
							else
							{
								if($datetime <= $now)
								{
									echo '<img src="../img/admin/del.gif">';
									echo "<font color=\"red\"> No Protection</font>";
								}
								else
								{
									$tsdiffact = $datetime - $now;
									$timetoecho = $timeformat->getTimeFormat($tsdiffact);
									echo '<img src="../gpack/travian_default/img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['protect']+3600*2).'">';
									echo "<font color=\"blue\"> $timetoecho</font>";
								}
							}
							/*if(date('d.m.Y H:i',$user['protect']) == '01.01.1970 00:00')
							{
								echo "Not enabled!</tr></th>";
							}
							else
							{
								$ends = date('d.m.Y H:i',$user['protect']+3600*2);
								$now = date('d.m.Y H:i');
								if($now>$ends)
								{
									echo "<font color=\"blue\">$ends</font>";
								}
								else
								{
									echo "<font color=\"red\">NO!</font>";
								}
							} */
						?>
					 <a href="admin.php?p=editProtection&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Give Player Protection"></a></td>
				</tr>
				<tr>
					<td>Culture Points</td>
					<td><a href='admin.php?p=player&uid=<?php echo $id; ?>&cp'><img src="../img/admin/edit.gif" title="Edit Culture Points"></a>
						<?php
							echo round($user['cp'], 0);
							if($_SESSION['access'] == ADMIN)
							{ ?>
								<a href='admin.php?p=player&uid=<?php echo $id; ?>&cp'><?php
							}
						?>
					</td>
				</tr>
				<?php
					if($_SESSION['access'] == ADMIN)
					{
						if($_GET['cp'] == 'ok')
						{
							echo '';
						}
						else
						{
							if(isset($_GET['cp']))
							{ ?>
								<form action="../GameEngine/Admin/Mods/cp.php" method="POST">
									<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<tr>
										<td>Add how many CP?</td>
										<td>
											<input class="give_gold" name="cp" value="0">
											<input type="image" src="../gpack/travian_default/img/new/tick.png" value="submit">
											<a href="admin.php?p=player&uid=<?php echo $id; ?>"><img src="../img/admin/del.gif" title="Cancel"></a>
										</td>
									</tr>
								</form><?php
							}
						}
					}
				?>
				<tr>
					<td>Last Activity</td>
					<td>
						<?php
							echo ''.date('d.m.Y H:i',$user['timestamp']+3600*2).'';
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Attack Points ("This "Week")</td>
					<td><a href="admin.php?p=editWeek&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Weekly Points"></a>
						<?php
							echo $user['ap'];
						?>
					</td>
				</tr>
				<tr>
					<td>Defence Points ("This Week")</td>
					<td><a href="admin.php?p=editWeek&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Weekly Points"></a>
						<?php
							echo $user['dp'];
						?>
					</td>
				</tr>
				<tr>
					<td>Resources Raided ("This Week")</td>
					<td><a href="admin.php?p=editWeek&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Weekly Points"></a>
						<?php
							echo $user['RR'];
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Total Attack Points</td>
					<td><a href="admin.php?p=editOverall&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Overall Points"></a>
						<?php
							echo $user['apall'];
						?>
					</td>
				</tr>
				<tr>
					<td>Total Defence Points</td>
					<td><a href="admin.php?p=editOverall&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Overall Points"></a>
						<?php
							echo $user['dpall'];
						?>
					</td>
				</tr>
			</tbody>
		</table>