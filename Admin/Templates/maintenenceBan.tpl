<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       maintenenceBan.tpl                                          ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<form action="../GameEngine/Admin/Mods/mainteneceBan.php" method="POST">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<br />	
	<table id="member" cellpadding="1" cellspacing="1" >
		<thead>
			<tr>
				<th colspan="2">Close Server (Ban Everyone)</th>
			</tr> 
			<tr>
				<td class="on">Duration</td>
				<td class="hab">Starting</td>
			</tr>
		</thead>
		<tbody> 
			<tr>
				<td class="hab"><input type="text" class="fm" name="duration" value="1"></td>
				<td class="hab"><input type="text" class="fm" name="start" value="<?php echo date('d-m-Y H:i:s', strtotime("now")); ?>"></td>
			</tr>
			<tr>
				<td>Default: 1 Hour<br />Value: Hours (0.5) for 30 mins</td>
				<td>Default: Now
			</tr>
			<tr>
				<td class="hab" colspan="2"><center><input type="text" class="fm" name="reason" value="Server Downtime"></center></td>
			</tr>
			<tr>
				<td class="hab" colspan="2"><center><input type="image" src="../img/admin/b/ok1.gif" value="submit"></center></td>
			</tr>
		</tbody>
	</table>
</form>