<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editExtraSet.tpl                                            ##
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
	<form action="../GameEngine/Admin/Mods/editExtraSet.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2"><?php echo EDIT_EXTRA_SETT ?></th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td width="50%"><?php echo CONF_EXTRA_LIMITMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_LIMITMAIL_TOOLTIP ?></span></em></td>
					<td width="50%">
						<select name="limit_mailbox">
							<option value="true" <?php if (LIMIT_MAILBOX==true) echo "selected";?>>Yes</option>
							<option value="false" <?php if (LIMIT_MAILBOX==false) echo "selected";?>>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo CONF_EXTRA_MAXMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_MAXMAIL_TOOLTIP ?></span></em></td>
					<td>30</td>	
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
