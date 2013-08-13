<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editVillage.tpl                                             ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<table id="member" cellpadding="1" cellspacing="1" >
	<thead>
		<tr>
			<th colspan="2">Server Maintenence</th>
		</tr> 
		<tr>
			<td class="on">Description</td>
			<td class="hab">Execute</td>
		</tr>
	</thead>
	<tbody> 
		<tr>
			<td class="hab">Close Server for Maintenece, This will ban all players (Access 2) till you can fix bugs, or a crap version of a ceasefire lol</td>
			<td class="hab"><center><a href="admin.php?p=maintenenceBan"><img src="../img/admin/b/ok1.gif"></a></center></td>
		</tr>
		<tr>
			<td class="hab">Bring Server Back for Maintenece, This will unban all players (By Banning Reason)</td>
			<td class="hab"><center><a href="admin.php?p=maintenenceUnban"><img src="../img/admin/b/ok1.gif"></a></center></td>
		</tr>
		<tr>
			<form action="../GameEngine/Admin/Mods/mainteneceCleanBanData.php" method="POST">
			<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
			<td class="hab">Clean Banlist Data (TRUNCATE)</td>
			<td class="hab"><center><input type="image" src="../img/admin/b/ok1.gif" value="submit"></center></td>
			</form>
		</tr>
	</tbody>
</table>