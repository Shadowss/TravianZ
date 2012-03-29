<div id="textmenu">
   <a href="dorf3.php" class="selected ">Overview</a>
 | <span>Resources</span>
 | <span>Warehouse</span>
 | <span>CP</span>
 | <span>Troops</span>
</div>
<table cellpadding="1" cellspacing="1" id="overview">
<thead><tr>
	<th colspan="5">Overview</th>
</tr>
<tr>
	<td>Village</td>
	<td>Attacks</td>
	<td>Building</td> 
	<td>Troops</td>
	<td>Merchants</td>
</tr></thead><tbody>
<?php
$varray = $database->getProfileVillages($session->uid);  
foreach($varray as $vil){  
  $vid = $vil['wref'];
  $vdata = $database->getVillage($vid);
  if($vdata['capital'] == 1){$class = 'hl';}else{$class = '';}
  echo '
  <tr class="'.$class.'">
		   <td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a></td>
		   <td class="att"><span class="none">?</span></td>
		   <td class="bui"><span class="none">?</span></td> 
		   <td class="tro"><span class="none">?</span></td>
		   <td class="tra lc"><a href="build.php?gid=17">?/?</a></td>
	</tr> 
  ';
}
?>   
     </tbody>
</table>