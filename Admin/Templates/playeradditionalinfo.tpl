		<table id="member">
			<thead>
				<tr>
					<th colspan="2">Additional Information &nbsp;&nbsp;&nbsp;<a href='admin.php?p=editAdditional&uid=<?php echo $id; ?>'><img src="../img/admin/edit.gif" title="Edit Player Additional Info"></a></th>
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
						?>
					</td>
				</tr>
				<tr>
					<td>Vacation Mode</td>
					<td>
						<?php
							if($user['vac_mode'] == 0)
							{
								echo "Disabled";
							}
							else if($user['vac_mode'] == 1)
							{
								echo "Enabled";
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Gold</td>
					<td><img src="../img/admin/gold.gif"> <?php echo $user['gold']; ?></td>
				</tr>
				<tr>
					<td>Sitter 1</td>
					<td>
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
					<td>
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
						?>
					</td>
				</tr>
				<tr>
					<td>Culture Points</td>
					<td><?php echo round($user['cp'], 0);?></td>
				</tr>
				<tr>
					<td>Last Activity</td>
					<td><?php echo date('d.m.Y H:i',$user['timestamp']+3600*2);?></td>
				</tr>
				<tr>
					<td>Attack Points ("This "Week")</td>
					<td><?php echo $user['ap'];?></td>
				</tr>
				<tr>
					<td>Defence Points ("This Week")</td>
					<td><?php echo $user['dp'];?></td>
				</tr>
				<tr>
					<td>Resources Raided ("This Week")</td>
					<td><?php echo $user['RR'];?></td>
				</tr>
				<tr>
					<td>Total Attack Points</td>
					<td><?php echo $user['apall'];?></td>
				</tr>
				<tr>
					<td>Total Defence Points</td>
					<td><?php echo $user['dpall'];?></td>
				</tr>
			</tbody>
		</table>
