<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editNewsboxSet.tpl                                          ##
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
	<form action="../GameEngine/Admin/Mods/editNewsboxSet.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2">Edit Newsbox Settings</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td width="50%">Newsbox 1</td>
					<td width="50%">
						<select name="box1">
							<option value="true" <?php if (NEWSBOX1==true) echo "selected";?>>Enable</option>
							<option value="false" <?php if (NEWSBOX1==false) echo "selected";?>>Disable</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Newsbox 2</td>
					<td>
						<select name="box2">
							<option value="true" <?php if (NEWSBOX2==true) echo "selected";?>>Enable</option>
							<option value="false" <?php if (NEWSBOX2==false) echo "selected";?>>Disable</option>
						</select>
					</td>	
				</tr>
				<tr>
					<td>Newsbox 3</td>
					<td>
						<select name="box3">
							<option value="true" <?php if (NEWSBOX3==true) echo "selected";?>>Enable</option>
							<option value="false" <?php if (NEWSBOX3==false) echo "selected";?>>Disable</option>
						</select>
					</td>	
				</tr>
				<tr>
				
				</tbody>
			</table>
			<br />
			<table width="100%">
				<tr><td align="left"><a href="../Admin/admin.php?p=config"><< back</a></td>
					<td align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif"></td>
				</tr>
			</table>
		</form>
