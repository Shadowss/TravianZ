<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editAdditional.tpl                                          ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
$id = $_GET['uid'];
$user = $database->getUserArray($id,1);
$dur=$user['protect']-time();
$protect=0;
if($dur>43200) {
	$protect=intval($dur/86400)+1;
}
if(isset($id))
{
	?>
<script LANGUAGE="JavaScript">
function go_url(url) {
	location=url;
	return(false);
}
</script>	
	<form action="../GameEngine/Admin/Mods/additional.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2">Edit Additional Info For: <a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>
					Change Access
					</td>
					<td>
							<select name="access" class="dropdown">
								<option value="0" <?php if($user['access'] == 0) { echo 'selected="selected"'; } else { echo ''; } ?>>Banned</option>
								<option value="2" <?php if($user['access'] == 2) { echo 'selected="selected"'; } else { echo ''; } ?>>Normal User</option>
								<option value="8" <?php if($user['access'] == 8) { echo 'selected="selected"'; } else { echo ''; } ?>>Multihunter</option>
								<option value="9" <?php if($user['access'] == 9) { echo 'selected="selected"'; } else { echo ''; } ?>>Admin</option>
							</select>
					</td>
				</tr>
				<tr>
					<td>Edit Gold</td>
					<td>
						<input class="give_gold" name="gold" value="<?php echo $user['gold'];?>"> <img src="../img/admin/gold.gif">
					</td>
				</tr>
					<tr>
						<td>Sitter 1</td>
						<td>
							<input class="fm" name="sitter1" value="<?php echo $user['sit1']; ?>"><br />
							<?php
								$sitter1 = $database->getUserArray($user['sit1'], 1);
								if($user['sit1'] ==0)
								{
									echo 'No Sitter';
								}
								else
								{
									echo '<a href="admin.php?p=player&uid='.$sitter1['id'].'">'.$sitter1['username'].'</a>';
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Sitter 2</td>
						<td>
							<input class="fm" name="sitter2" value="<?php echo $user['sit2']; ?>"><br />
							<?php
								$sitter2 = $database->getUserArray($user['sit2'], 1);
								if($user['sit2'] ==0)
								{
									echo 'No Sitter';
								}
								else
								{
									echo '<a href="admin.php?p=player&uid='.$sitter2['id'].'">'.$sitter2['username'].'</a>';
								}
							?>
						</td>
					</tr>				
					<tr>
						<td>Give Protection For</td>
						<td>
							<input class="fm" name="protect" value="<?php echo $protect;?>" style="width: 60%;"> Days
						</td>
					</tr>
					<tr>
						<td>Edit Culture Points</td>
						<td>
							<input class="fm" name="cp" value="<?php echo round($user['cp'], 0); ?>" style="width: 60%;"> Points
						</td>
					</tr>
					<tr>
						<td>Edit Attack Points</td>
						<td>
							<input class="fm" name="off" value="<?php echo $user['ap']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
					<tr>
						<td>Edit Defence Points</td>
						<td>
							<input class="fm" name="def" value="<?php echo $user['dp']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
					<tr>
						<td>Edit Resources Raided</td>
						<td>
							<input class="fm" name="res" value="<?php echo $user['RR']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
					<tr>
						<td>Total Attack Points</td>
						<td>
							<input class="fm" name="ooff" value="<?php echo $user['apall']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
					<tr>
						<td>Total Defence Points</td>
						<td>
							<input class="fm" name="odef" value="<?php echo $user['dpall']; ?>" style="width: 60%;"> Points
						</td>
					</tr>
					
				</tbody>
				<thead>
				<tr>
					<td style="border-right:none; text-align:left"><input name="back" type="image" id="btn_back" class="dynamic_img" src="img/x.gif" value="back" alt="back" onclick="return go_url('../Admin/admin.php?p=player&uid=<?php echo $_GET["uid"];?>')" /></td>
					<td style="border-left:none; text-align:right" colspan="5"><input name="save" type="image" id="btn_save" class="dynamic_img" src="img/x.gif" value="save" alt="save" /></td>
				</tr>
				</thead>				
			</table>
		</form>
	<?php
}
else
{
	include("404.tpl");
}
?>
