<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editNewFunctions.tpl                                        ##
##  Developed by:  velhbxtyrj                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
?>
<h2><center><?php echo SERV_CONFIG ?></center></h2>
	<form action="../GameEngine/Admin/Mods/editNewFunctions.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2">Edit New Mechanics and Functions</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td width="50%">Display oasis in profile <em class="tooltip">?<span class="classic">Turns on or off the display of oases of each village in the player profile</span></em></td>
					<td width="50%">
                        <select name="new_functions_oasis">
								<option value="True" <?php if(NEW_FUNCTIONS_OASIS==true) echo "selected";?>>True</option>
								<option value="False" <?php if(NEW_FUNCTIONS_OASIS==false) echo "selected";?>>False</option>
						</select>
                    </td>
				</tr>
				</tbody>
			</table>
			<br />
			<table width="100%">
				<tr><td align="left"><a href="../Admin/admin.php?p=config"><< <?php echo EDIT_BACK ?></a></td>
					<td align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif"></td>
				</tr>
			</table>
		</form>
