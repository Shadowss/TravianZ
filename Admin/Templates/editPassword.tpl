<?php
if(isset($_GET['uid']))
{
	$user = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = ".$_GET['uid']."")); ?>
	<form action="../GameEngine/Admin/Mods/editPassword.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="uid" id="uid" value="<?php echo $_GET['uid']; ?>">
		
		<table id="profile" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="2">Player <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
				</tr>                                       
				<tr>
					<td></td>
					<td>New Password</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Password</th>
					<td>
						<input type="text" style="width: 80%;" class="fm" name="newpw" value="new password">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<input type="image" value="submit" src="../img/admin/b/ok1.gif" title="Edit Location">
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	</form><?php
}
else
{
	include("404.tpl");
}
?>