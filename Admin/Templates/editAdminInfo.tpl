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
<h2><center><?php echo SERV_CONFIG ?></center></h2>
	<form action="../GameEngine/Admin/Mods/editAdminInfo.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2"><?php echo EDIT_ADMIN_INFO ?></th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td width="50%"><?php echo CONF_ADMIN_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_NAME_TOOLTIP ?></span></em></td>
					<td width="50%"><input class="fm" name="aname" id="aname" value="<?php echo ADMIN_NAME;?>" style="width: 90%;"></td>
				</tr>
				<tr>
					<td width="50%"><?php echo CONF_ADMIN_EMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_EMAIL_TOOLTIP ?></span></em></td>
					<td width="50%"><input class="fm" name="aemail" id="aemail" value="<?php echo ADMIN_EMAIL;?>" style="width: 90%;"></td>
				</tr>
				<tr>
					<td><?php echo CONF_ADMIN_SHOWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SHOWSTATS_TOOLTIP ?></span></em></span></td>
					<td>
						<select name="admin_rank">
							<option value="true" <?php if (INCLUDE_ADMIN==true) echo "selected";?>>True</option>
							<option value="false" <?php if (INCLUDE_ADMIN==false) echo "selected";?>>False</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo CONF_ADMIN_SUPPMESS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SUPPMESS_TOOLTIP ?></span></em></td>
        			<td>
            			<select name="admin_support_msgs">
                			<option value="True" <?php if (ADMIN_RECEIVE_SUPPORT_MESSAGES==true) echo "selected";?>>True</option>
                			<option value="False" <?php if (ADMIN_RECEIVE_SUPPORT_MESSAGES==false) echo "selected";?>>False</option>
            			</select>
        			</td>
        		</tr>
        		<tr>
					<td><?php echo CONF_ADMIN_RAIDATT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_RAIDATT_TOOLTIP ?></span></em></td>
        			<td>
            			<select name="admin_raidable">
                			<option value="True" <?php if (ADMIN_ALLOW_INCOMING_RAIDS==true) echo "selected";?>>True</option>
                			<option value="False" <?php if (ADMIN_ALLOW_INCOMING_RAIDS==false) echo "selected";?>>False</option>
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
