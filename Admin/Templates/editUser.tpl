<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

$id = $_GET['uid'];
if(isset($id))
{
	$user = $database->getUserArray($id,1);
	$varray = $database->getProfileVillages($id);
	$varmedal = $database->getProfileMedal($id); ?>

	<style type="text/css">
		select.dropdown
		{
			border: 1px solid #71D000;
			margin: 0;
			padding: 1px 1px;
			width: 90%;
		}
	</style>
	<form action="../GameEngine/Admin/Mods/editUser.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<table id="profile" cellpadding="1" cellspacing="1">
			<thead>
			<tr>
				<th colspan="2">Player <a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></th>
			</tr>
			<tr>
				<td>Details</td>
				<td>Description</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="details">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<th>Tribe</th>
							<td>
								<select name="tribe" class="dropdown">
									<option value="1" <?php if($user['tribe'] == 1) { echo "selected='selected'"; } else {} ?>>Roman</option>
									<option value="2" <?php if($user['tribe'] == 2) { echo "selected='selected'"; } else {} ?>>Teuton</option>
									<option value="3" <?php if($user['tribe'] == 3) { echo "selected='selected'"; } else {} ?>>Gaul</option>
									<option value="4" <?php if($user['tribe'] == 4) { echo "selected='selected'"; } else {} ?>>Nature</option>
									<option value="5" <?php if($user['tribe'] == 5) { echo "selected='selected'"; } else {} ?>>Natars</option>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<th>Location</th>
							<td><input class="fm" name="location" value="<?php echo $user['location']; ?>"></td>
						</tr>
						<tr>
							<th>E-mail</th><td><input class="fm" name="email" value="<?php echo $user['email']; ?>"></td></tr>
						<tr>
						<tr>
							<th>Quest</th><td><input class="fm" name="quest" value="<?php echo $user['quest']; ?>"></td></tr>
						<tr>
							<td colspan="2" class="empty"></td>
						</tr>
						<tr>
							<td colspan="2"><a href="?p=player&uid=<?php echo $user['id']; ?>"><span class="rn2" >&raquo;</span> Go back</a></td>
						</tr>
						<tr>
							<td colspan="2" class="empty"></td>
						</tr>
						<tr>
							<td colspan="2" class="desc2"><textarea cols="25" rows="14" tabindex="1" name="desc1"><?php echo nl2br($user['desc1']); ?></textarea></td>
						</tr>
					</table>
				</td>
				<td class="desc1">
					<textarea tabindex="8" cols="30" rows="20" name="desc2"><?php echo nl2br($user['desc2']); ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="empty"></td>
			</tr>
		</tbody>
	</table>

	<table cellspacing="1" cellpadding="2" id="member">
		<thead>
			<tr>
				<th colspan="4">Medals</th>
			</tr>
			<tr>
				<td>Category</td>
				<td>Rank</td>
				<td>Week</td>
				<td>BB-Code</td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($varmedal as $medal)
				{
					$titel="Bonus";
					switch ($medal['categorie'])
					{
						case "1":
							$titel="Attacker of the Week";
						break;
						case "2":
							$titel="Defender of the Week";
						break;
						case "3":
							$titel="Climber of the week";
						break;
						case "4":
							$titel="Robber of the week";
						break;
					}
					echo"
					<tr>
						<td> ".$titel."</td>
						<td>".$medal['plaats']."</td>
						<td>".$medal['week']."</td>
						<td>[#".$medal['id']."]</td>
					</tr>";
				}
			?>
			<tr>
				<td>Beginners Protection</td>
				<td></td>
				<td></td>
				<td>[#0]</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">
					<center>
						<input type="image" src="../img/admin/b/ok1.gif" value="submit">
					</center>
				</td>
			</tr>
		</tfoot>
	</table>
	</form><?php
}
else
{
	echo "<br /><br />Not found. <a href=\"javascript: history.go(-1)\"> Go Back</a>";
}
?>