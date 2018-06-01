<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       maintenance.tpl                                             ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

if(isset($_POST['startMaint_x'])) {
    $database->setUsersOk(2);
    $error = "The maintenance has started";
}
elseif($_POST['removeMaint_x']) {
    $database->setUsersOk(0);
    $error = "The maintenance has been removed";
}

?>
<form action="../Admin/admin.php?p=maintenance" method="POST">
<p><div style="text-align: center;color: red"><?php echo $error; ?></div></p>
<table id="member" cellpadding="1" cellspacing="1" >
	<thead>
		<tr>
			<th colspan="2">Server Maintenance</th>
		</tr> 
		<tr>
			<td class="on">Description</td>
			<td class="hab">Execute</td>
		</tr>
	</thead>
	<tbody> 
		<tr>
			<td class="hab">Start a maintenance</td>
			<td class="hab"><div style="text-align: center"><input name="startMaint" type="image" src="../img/admin/b/ok1.gif"/></div></td>
		</tr>
		<tr>
			<td class="hab">Remove a Maintenance</td>
			<td class="hab"><div style="text-align: center"><input name="removeMaint" type="image" src="../img/admin/b/ok1.gif"></div></td>
		</tr>
	</tbody>
</table>
</form>