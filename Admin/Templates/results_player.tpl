<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       results_player.tpl                                          ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$result = $admin->search_player($_POST['s']);
?>
<table id="member">
  <thead>
	<tr>
		<th class="dtbl"><a href="">1 «</a></th><th>Found player (<?php echo count($result);?>)</th><th class="dtbl"><a href="">» 100</a></th>
	</tr>
  </thead>

</table>
<table id="profile">
	<tr>
		<td class="b">UID</td>
		<td class="b">Player</td>
		<td class="b">Villages</td>
		<td class="b">Pop</td>
	</tr>
<?php
if($result){
for ($i = 0; $i <= count($result)-1; $i++) {
$varray = $database->getProfileVillages($result[$i]["id"]);
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}
echo '
	<tr>
		<td>'.$result[$i]["id"].'</td>
		<td><a href="?p=player&uid='.$result[$i]["id"].'">'.$result[$i]["username"].'</a></td>
		<td>'.count($varray).'</td>
		<td>'.$totalpop.'</td>
	</tr>
';
}}
else{
echo '
	<tr>
		<td colspan="4">No results</td>
	</tr>
';
}
?>

</table>
