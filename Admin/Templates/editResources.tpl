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

$id = $_GET['did'];
if(isset($id))
{
	$village = $database->getVillage($id);
	$user = $database->getUserArray($village['owner'],1);
	$coor = $database->getCoor($village['wref']);
	//$varray = $database->getProfileVillages($village['owner']);
	//$type = $database->getVillageType($village['wref']);
	//$fdata = $database->getResourceLevel($village['wref']);

	include("search2.tpl"); ?>
	<form action="../GameEngine/Admin/Mods/editResources.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="did" id="did" value="<?php echo $_GET['did']; ?>">
		<br />

		<table id="member" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="4">Modify Resources</th>
				</tr>
				<tr>
					<td class="on">Resource</td>
					<td class="hab">Amount</td>
					<td class="hab">Maximum Capacity</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="on"><img src="../img/admin/r/1.gif"> Wood</td>
					<td class="hab"><input class="fm" name="wood" value="<?php echo round($village['wood'], 0); ?>"></td>
						<td rowspan="3" class="hab">
							<input class="fm" name="maxstore" value="<?php echo round($village['maxstore'], 0); ?>">
						</tr>
					</tr>
				</tr>
				<tr>
					<td class="on"><img src="../img/admin/r/2.gif"> Clay</td>
					<td class="hab">
						<input class="fm" name="clay" value="<?php echo round($village['clay'], 0); ?>">
					</td>
				</tr>
				<tr>
					<td class="on"><img src="../img/admin/r/3.gif"> Iron</td>
					<td class="hab">
						<input class="fm" name="iron" value="<?php echo round($village['iron'], 0); ?>">
					</td>
				</tr>
				<tr>
					<td class="on"><img src="../img/admin/r/4.gif"> Crop</td>
					<td class="hab">
						<input class="fm" name="crop" value="<?php echo round($village['crop'], 0); ?>">
					</td>
					<td class="hab">
						<input class="fm" name="maxcrop" value="<?php echo round($village['maxcrop'], 0); ?>">
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<table id="ejas" border="0" width="100%">
			<tr><td align="left"><a href="../Admin/admin.php?p=village&did=<?php echo $_GET['did'];?>"><< back</a></td>
				<td align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif"></td>
			</tr>
		</table>
	</form><?php
}
else
{
include("404.tpl");
}
?>