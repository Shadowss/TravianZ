<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.05                                                  ##
##  Filename:      Templates/Admin/login.tpl                                   ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################
?>
<div align="center"><img src="img/admin/admin.gif" width="468" height="60" border="0"></div>
<p>Login to Admin Control Panel:</p>
<form method="post" action="admin.php">
	<input type="hidden" name="action" value="login">
		<table cellspacing="0">
			<tr>
            	<td>Username:&nbsp;<input class="fm fm110" type="text" name="name" value="<?php echo $_SESSION['username']?>" maxlength="15"> <span class="e f7"></span>
				</td>
            </tr>
			<tr>
            	<td>Password:&nbsp;<input class="fm fm110" type="password" name="pw" value="" maxlength="20"> <span class="e f7"></span>
				</td>
            </tr>
		</table>
	<p align="center">
    <input type="image" border="0" src="img/admin/b/l1.gif" width="80" height="20">
	<img align="right" src="img/admin/senator_roemer.png" width="450" height="500">
    </p>
</form>