<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       online.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
error_reporting(0);
?>
<style>
	.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
</style>

<table id="member">
	<thead>
		<tr>
			<th colspan="7">Inactive users</th>
		</tr>
		<tr>
			<td>Name [access]</td>
			<td>Time</td>
			<td>Tribe</td>
			<td>Population</td>
			<td>Villages</td>
			<td>Gold</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<?php
			$inactivei = time() - 86400;
			$q = "SELECT * FROM ".TB_PREFIX."users where timestamp < $inactivei AND access=2";
			$result = mysql_query($q);
			$active = mysql_fetch_assoc($result);

			for ($i = 0; $i <= count($active)-1; $i++)
			{
				$uid = $database->getUserField($active[$i]['username'],'id',1);
				$varray = $database->getProfileVillages($uid);
				$totalpop = 0;
				foreach($varray as $vil)
				{
					$totalpop += $vil['pop'];
				}
				if($active[$i]['tribe'] == 1)
				{
					$tribe = "Roman";
					$img = "";
				}
				else if($active[$i]['tribe'] == 2)
				{
					$tribe = "Teuton";
					$img = "1";
				}
				else if($active[$i]['tribe'] == 3)
				{
					$tribe = "Gaul";
					$img = "2";
				}
				echo "
				<tr>
					<td><a href=\"?p=player&uid=".$uid."\">".$active[$i]['username']." [".$active[$i]['access']."]</a></td>
					<td>".date("H:i:s",$active[$i]['timestamp'])."</td>
					<td><img src=\"../../gpack/travian_default/img/u/".$img."9.gif\" title=\"$tribe\" alt=\"$tribe\"></td>
					<td>".$totalpop."</td>
					<td>".count($varray)."</td>
					<td><img src=\"../img/admin/gold.gif\" class=\"gold\" alt=\"Gold\" title=\"This user has: ".$active[$i]['gold']." gold\"/> ".$active[$i]['gold']."</td>
					<td><img src=\"../gpack/travian_default/img/a/online1.gif\"></td>
				</tr>";
			}
		?>
	</tbody>
</table>