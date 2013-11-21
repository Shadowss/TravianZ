<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       villages.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
</style>
<table id="member">
  <thead>
	<tr>
		<th>Villages</th>
	</tr>
  </thead>

</table>
<table id="profile">
	<tr>
		<td>Name</td>
		<td>Population</td>
		<td>Coordinates</td>
		<td>Add Troops</td>
		<td></td>
	</tr>
<?php
for ($i = 0; $i <= count($varray)-1; $i++) {
$coorproc = $database->getCoor($varray[$i]['wref']);
if($varray[$i]['capital']){
$capital = '<span class="c">(Capital)</span>';
$delLink = '<a href="#"><img src="../img/admin/del_g.gif" class="del"></a>';
}else{
$capital = '';
	if($_SESSION['access'] == ADMIN){
$delLink = '<a href="?action=delVil&did='.$varray[$i]['wref'].'" onClick="return del(\'did\','.$varray[$i]['wref'].');"><img src="../img/admin/del.gif" class="del"></a>';
  }else if($_SESSION['access'] == MULTIHUNTER){
  $delLink = '<a href="#"><img src="../img/admin/del_g.gif" class="del"></a>';
	}
}
$addTroops = '<a href="?p=addTroops&did='.$varray[$i]['wref'].'"> Edit Troops</a>';
echo '
	<tr>
		<td><a href="?p=village&did='.$varray[$i]['wref'].'">'.$varray[$i]['name'].'</a> '.$capital.'</td>
		<td>'.$varray[$i]['pop'].' <a href="?action=recountPop&did='.$varray[$i]['wref'].'">Recount<a/></td>
		<td>('.$coorproc['x'].'|'.$coorproc['y'].')</td>
		<td>'.$addTroops.' </td>
		<td>'.$delLink.' </td>
	</tr>
';
}

?>

</table>