<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editOverall.tpl                                             ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

$id = $_GET['uid'];
$uid = $_GET['uid'];
$user = $database->getUserArray($id,1); 
if(isset($id))
{
	?>
	<form action="../GameEngine/Admin/Mods/editOverall.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2">Edit Overall Attack and Defence Points For: <a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Edit Attack Points</td>
						<td>
							<input class="fm" name="off" value="<?php echo $user['apall']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
					<tr>
						<td>Edit Defence Points</td>
						<td>
							<input class="fm" name="def" value="<?php echo $user['dpall']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
				</tbody>
			</table>
			<br />
			<center><input type="image" value="submit" src="../img/admin/b/ok1.gif"></center>
		</form>
	<?php
}
else
{
	include("404.tpl");
}
?>