<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editAdminInfo.tpl                                           ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
?>
<h2><center>Server Configuration</center></h2>
	<form action="../GameEngine/Admin/Mods/editAdminInfo.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2">Edit Admin Information</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td width="50%">Admin Name</td>
					<td width="50%"><input class="fm" name="aname" id="aname" value="<?php echo ADMIN_NAME;?>" style="width: 90%;"></td>
				</tr>
				<tr>
					<td width="50%">Admin Email</td>
					<td width="50%"><input class="fm" name="aemail" id="aemail" value="<?php echo ADMIN_EMAIL;?>" style="width: 90%;"></td>
				</tr>
				<tr>
					<td>Show Admin in Stats:</span></td>
					<td>
						<select name="admin_rank">
							<option value="true" <?php if (INCLUDE_ADMIN==true) echo "selected";?>>True</option>
							<option value="false" <?php if (INCLUDE_ADMIN==false) echo "selected";?>>False</option>
						</select>
					</td>
				</tr>
			</tbody>
			</table>
			<br />
			<table width="100%">
				<tr><td align="left"><a href="../Admin/admin.php?p=config"><< back</a></td>
					<td align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif"></td>
				</tr>
			</table>
		</form>
