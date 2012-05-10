<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       alliance.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

if($_GET['aid'])
{
	$alidata = $database->getAlliance($_GET['aid']);
	$aliusers = $database->getAllMember($_GET['aid']);
	if($alidata and $aliusers)
	{
		foreach($aliusers as $member)
		{
			$totalpop += $database->getVSumField($member['id'],"pop");
		} ?>
	
		<br>
		<table id="profile" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th colspan="2">Alliance <a href="?p=alliance&aid=<?php echo $alidata['id'];?>"><?php echo $alidata['name'];?></a></th>
				</tr>
				<tr>
					<td>Details</td>
					<td>Description</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="empty"></td>
					<td class="empty"></td>
				</tr>
				<tr>
					<td class="details">
						<table cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<th>Tag</th>
									<td><?php echo $alidata['tag']; ?></td>
								</tr>
								<tr>
									<th>Name</th>
									<td><?php echo $alidata['name']; ?></td>
								</tr>
								<tr>
									<td colspan="2" class="empty"></td>
								</tr>
								<tr>
									<th>Rank</th>
									<td>???</td>
								</tr>
								<tr>
									<th>Points</th>
									<td><?php echo $totalpop; ?></td>
								</tr>
								<tr>
									<th>Members</th>
									<td><?php echo count($aliusers); ?></td>
								</tr>
								<tr>
									<td colspan="2" class="empty"></td>  
								</tr>
								<tr>
									<th>Alliance Founder</th>
									<td><a href="?p=player&uid=<?php echo $alidata['leader']; ?>"><?php echo $database->getUserField($alidata['leader'],"username",0); ?></a></td>
								</tr>
								<tr>
									<td colspan="2"><b>Alliance Positions</b></td>
								</tr>
								
								<?php
									error_reporting(0);
									$sql = "SELECT * FROM ".TB_PREFIX."ali_permission WHERE alliance = ".$_GET['aid']."";
									$result = mysql_query($sql);
									while($row = mysql_fetch_assoc($result))
									{
										$player = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = ".$row['uid'].""));
										if($row['opt1'] == 1) { $position1 = "Assign To Position"; } else { $position1 = "No Assigning Positions"; }
										if($row['opt2'] == 1) { $position2 = "Kick Players"; } else { $position2 = "No Kicking Players"; }
										if($row['opt3'] == 1) { $position3 = "Change Alliance Description"; } else { $position3 = "No Changing Description"; }
										if($row['opt4'] == 1) { $position4 = "Invite Players"; } else { $position4 = "No Invitations"; }
										if($row['opt5'] == 1) { $position5 = "Manage Forums"; } else { $position5 = "No Forum Management"; }
										if($row['opt6'] == 1) { $position6 = "Alliance Diplomacy"; } else { $position6 = "No Diplomacy"; }
										if($row['opt7'] == 1) { $position7 = "Mass IGMs (MMs)"; } else { $position7 = "No MMs"; }
										if($row['opt8'] == 1) { $position8 = "???"; } else { $position8 = "No ???"; }
										
										echo '
										<tr>
											<td>Position:</td>
											<td><a href="admin.php?p=player&uid='.$row['uid'].'">'.$player['username'].'</a><br /><b>'.$row['rank'].'</b><br />
												<select>
													<option>Permissions</option>
													<option>'.$position1.'</option>
													<option>'.$position2.'</option>
													<option>'.$position3.'</option>
													<option>'.$position4.'</option>
													<option>'.$position5.'</option>
													<option>'.$position6.'</option>
													<option>'.$position7.'</option>
													<option>'.$position8.'</option>
												</select>
											</td>
										</tr>
										';
									}
								?>
								
								<tr>
									<th>Capacity</th>
									<td>
										<?php
											$now = count($aliusers);
											$max = $alidata['max'];
											if($now > $max)
											{
												$color = "red";
											}
											else
											{
												$color = "blue";
											}
											echo "<b><font color=\"$color\">($now/$max)</font></b>";
										?>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="empty"></td>
								</tr>
								<tr>
									<td colspan="2"><a href="?p=editAli&aid=<?php echo $alidata['id'];?>">» Edit Alliance</a></td>
								</tr>
								<tr>
									<td colspan="2"><a href="?p=DelAli&aid=<?php echo $alidata['id'];?>">» Delete Alliance</a></td>
								</tr>
								<tr>
									<td colspan="2" class="empty"></td>
								</tr>
								<tr>
									<td class="desc2" colspan="2">
										<center>
											<?php echo nl2br($alidata['desc']); ?>
										</center>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="empty"></td>
								</tr>
							</tbody>
						</table>
					</td>
						<td class="desc1">
							<center>
								<?php echo nl2br($alidata['notice']); ?>
							</center>
						</td>
					</tr>
				</tr>
				<tr>
					<td colspan="4" class="empty"></td>
				</tr>
			</tbody>
		</table>
		
		
		<table id="member" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Player</th>
					<th>Population</th>
					<th>Villages</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach($aliusers as $user)
				{
					$rank = $rank  + 1;
					$TotalUserPop = $database->getVSumField($user['id'],"pop");
					$TotalVillages = $database->getProfileVillages($user['id']);
					echo "<tr>";
					echo "<td class=ra>".$rank.".</td>";
					echo "<td class=pla><a href=spieler.php?uid=".$user['id'].">".$user['username']."</a></td>"; 
					echo "<td class=hab>".$TotalUserPop."</td>"; 
					echo "<td class=vil>".count($TotalVillages)."</td>";
					if($aid == $session->alliance)
					{	
						if ((time()-600) < $user['timestamp'])
						{
							// 0 Min - 10 Min
							echo "<td class=on><img class=online1 src=img/x.gif title=now online alt=now online /></td>";
						}
						elseif ((time()-86400) < $user['timestamp'] && (time()-600) > $user['timestamp'])
						{
							// 10 Min - 1 Days
							echo "<td class=on><img class=online2 src=img/x.gif title=now online alt=now online /></td>";              
						}
						elseif ((time()-259200) < $user['timestamp'] && (time()-86400) > $user['timestamp'])
						{ 
							// 1-3 Days
							echo "<td class=on><img class=online3 src=img/x.gif title=now online alt=now online /></td>";    
						}
						elseif ((time()-604800) < $user['timestamp'] && (time()-259200) > $user['timestamp'])
						{
							echo "<td class=on><img class=online4 src=img/x.gif title=now online alt=now online /></td>";    
						}
						else
						{
							echo "<td class=on><img class=online5 src=img/x.gif title=now online alt=now online /></td>";   
						}
					}
					echo "	</tr>";    
				}
			?> 
			</tbody>
		</table>
		<br /><br />
		
		<table id="profile">
			<thead>
				<tr>
					<th colspan="3">Alliance News</th>
				</tr>
				<tr>
					<td>Event</td>
					<td>Time</td>
				</tr>
			</thead>
				<?php
					$sql = "SELECT * FROM ".TB_PREFIX."ali_log WHERE aid = ".$_GET['aid']."";
					$result = mysql_query($sql);
					while($row = mysql_fetch_assoc($result))
					{
						echo '
						<tr>
							<td>'.$row['comment'].'</td>
							<td>'.date('d:m:Y H:i', $row['date']).'</td>
						</tr>';
					}
				?>
			</thead>
		</table>
		<br /><br />
		
		<h3>Not Sure this Diplomacy is correct, but I think it is</h3>
		<br />
		<table id="profile">
			<thead>
				<tr>
					<th colspan="3">Alliance Diplomacy Sent</th>
				</tr>
				<tr>
					<td>Recipient Alliance</td>
					<td>Type</td>
					<td>Accepted</td>
				</tr>
			</thead>
				<?php
					$sql = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = ".$_GET['aid']."";
					$result = mysql_query($sql);
					while($row = mysql_fetch_assoc($result))
					{
						if($row['type'] == 1) { $type = 'Confederation Pact'; }
						if($row['type'] == 2) { $type = 'Non Agression Pact'; }
						if($row['type'] == 3) { $type = 'Declaration of War'; }
						if($row['accepted'] == 0) { $accepted = "<img src=\"../../gpack/travian_default/img/a/del.gif\">"; }
						if($row['accepted'] ==1) { $accepted = "<img src=\"../../gpack/travian_default/img/a/acc.gif\">"; }
					
						$ally = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."alidata WHERE id = ".$row['alli2'].""));
						echo '
						<tr>
							<td><a href="admin.php?p=alliance&aid='.$row['alli1'].'">'.$ally['tag'].'</a></td>
							<td>'.$type.'</td>
							<td>'.$accepted.'</td>
						</tr>';
					}
				?>
			</thead>
		</table>
		<br /><br />
		
		<table id="profile">
			<thead>
				<tr>
					<th colspan="3">Alliance Diplomacy Recieved</th>
				</tr>
				<tr>
					<td>From Alliance</td>
					<td>Type</td>
					<td>Accepted</td>
				</tr>
			</thead>
				<?php
					$sql = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli2 = ".$_GET['aid']."";
					$result = mysql_query($sql);
					while($row = mysql_fetch_assoc($result))
					{
						if($row['type'] == 1) { $type = 'Confederation Pact'; }
						if($row['type'] == 2) { $type = 'Non Agression Pact'; }
						if($row['type'] == 3) { $type = 'Declaration of War'; }
						if($row['accepted'] == 0) { $accepted = "<img src=\"../../gpack/travian_default/img/a/del.gif\">"; }
						if($row['accepted'] ==1) { $accepted = "<img src=\"../../gpack/travian_default/img/a/acc.gif\">"; }
					
						$ally = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."alidata WHERE id = ".$row['alli1'].""));
						echo '
						<tr>
							<td><a href="admin.php?p=alliance&aid='.$row['alli2'].'">'.$ally['tag'].'</a></td>
							<td>'.$type.'</td>
							<td>'.$accepted.'</td>
						</tr>';
					}
				?>
			</thead>
		</table>
		
		<br /><br />
		
		<table id="profile">
			<thead>
				<tr>
					<th colspan="3">Alliance Relationships</th>
				</tr>
				<tr>
					<td>Alliance</td>
					<td>Type</td>
					<td></td>
				</tr>
			</thead>
				<?php
					$sql = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = ".$_GET['aid']." OR alli2 = ".$_GET['aid']." AND accepted = 1";
					$result = mysql_query($sql);
					while($row = mysql_fetch_assoc($result))
					{
						if($row['type'] == 1) { $type = 'Confederation Pact'; }
						if($row['type'] == 2) { $type = 'Non Agression Pact'; }
						if($row['type'] == 3) { $type = 'Declaration of War'; }
						if($row['accepted'] == 0) { $accepted = "<img src=\"../../gpack/travian_default/img/a/del.gif\">"; }
						if($row['accepted'] == 1) { $accepted = "<img src=\"../../gpack/travian_default/img/a/acc.gif\">"; }
					
						$ally1 = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."alidata WHERE id = ".$row['alli1'].""));
						$ally2 = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."alidata WHERE id = ".$row['alli2'].""));
						echo '
						<tr>
							<td><a href="admin.php?p=alliance&aid='.$row['alli1'].'">'.$ally1['tag'].'</a> & <a href="admin.php?p=alliance&aid='.$row['alli2'].'">'.$ally2['tag'].'</a></td>
							<td>'.$type.'</td>
							<td><img src="../../gpack/travian_default/img/a/acc.gif"></td>
						</tr>';
					}
				?>
			</thead>
		</table>
		
		<br /><br />
		
		<?php
		include("allymedals.tpl");
	}
	else
	{
		echo "Not found...<a href=\"javascript: history.go(-1)\">Back</a>";
	}
}
?>