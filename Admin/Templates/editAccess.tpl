<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.tpl                                                    ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
$id = $_SESSION['id']; 
if(isset($_GET['uid']))
{
	$sql = mysql_query("SELECT access FROM ".TB_PREFIX."users WHERE id = ".$_GET['uid']."");
	$curaccess = mysql_result($sql, 0);
	$player = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = ".$id.""));
	?>

	<form action="../GameEngine/Admin/Mods/editAccess.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="uid" id="uid" value="<?php echo $_GET['uid']; ?>">
		<table id="member" style="width:300px;">
			<thead>
				<tr>
					<th colspan="2">Edit <?php echo $player['username']; ?>'s access</th>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<center>
							<b>Change Access</b>
						</center>
					</td>
					<td>
						<center>
							<select name="access" class="dropdown">
								<option value="0" <?php if($curaccess == 0) { echo 'selected="selected"'; } else { echo ''; } ?>>Banned</option>
								<option value="2" <?php if($curaccess == 2) { echo 'selected="selected"'; } else { echo ''; } ?>>Normal User</option>
								<option value="8" <?php if($curaccess == 8) { echo 'selected="selected"'; } else { echo ''; } ?>>Multihunter</option>
								<option value="9" <?php if($curaccess == 9) { echo 'selected="selected"'; } else { echo ''; } ?>>Admin</option>
							</select>
						</center>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<input type="image" src="../img/admin/b/ok1.gif" value="submit" title="Give Players Free Gold">
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	</form><?php
    if(isset($_GET['g']))
	{
		echo '<br /><br /><font color="Red"><b>Players Access Changed</font></b>';
	}
}
else
{
	include("404.tpl");
}
?>