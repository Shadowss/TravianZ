<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       MaintenenceResetPlus.tpl                                    ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<form action="../GameEngine/Admin/Mods/mainteneceResetPlus.php" method="POST">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<table id="member" cellpadding="1" cellspacing="1" >
		<thead>
			<tr>
				<th colspan="2">Reset All Players Plus Bonus</th>
			</tr> 
		</thead>
		<tbody> 
			<tr>
				<td class="hab" colspan="2"><center><input type="image" src="../img/admin/b/ok1.gif" value="submit"></center></td>
			</tr>
		</tbody>
	</table>
</form>
<?php
if(isset($_GET['g']))
{
	echo '<br><br><font color="red"><b>All Players Plus Bonus Reset</b></font>';
}
?>