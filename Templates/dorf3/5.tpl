<?php
	include('menu.tpl');
?>
<table id="troops" cellpadding="1" cellspacing="1">
<thead><tr><th colspan="12">Own troops</th></tr><tr>
<?php
	$varray = $database->getProfileVillages($session->uid);
?>
<td>Village</td>
<?php
	for ($i=($session->tribe-1)*10+1; $i<=($session->tribe)*10; $i++) {
		echo '<td><img class="unit u'.$i.'" src="img/x.gif"></td>';
		$unit_total['u'.$i] = 0;
	}
	echo '<td><img class="unit uhero" src="img/x.gif"></td>';
?>
</tr></thead><tbody>
<?php
	foreach($varray as $vil) {
		$vid = $vil['wref'];
		if($vdata['capital'] == 1){$class = 'hl';}else{$class = '';}

		$units = $database->getEnforceVillage($vid,1);
		array_unshift($units,$database->getUnit($vid));

		echo '<tr class="'.$class.'"><td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vil['name'].'</a></td>';
		$movement = $database->getVillageMovement($vid);
		for ($i=($session->tribe-1)*10+1; $i<=($session->tribe)*10; $i++) {
			$uni['u'.$i] = 0;
			foreach($units as $unit) {
				$uni['u'.$i] += $unit['u'.$i];
				$unit_total['u'.$i] += $unit['u'.$i];
			}
				$uni['u'.$i] += $movement['u'.$i];
				$unit_total['u'.$i] += $movement['u'.$i];
			if($uni['u'.$i] !=0){$cl = '';}else{$cl = 'none';}
			echo '<td class="'.$cl.'">'.$uni['u'.$i].'</td>';
		}
		$uni['hero'] = 0;
		foreach($units as $unit) {
			$uni['hero'] += $unit['hero'];
			$unit_total['hero'] += $unit['hero'];
		}
		$uni['hero'] += $movement['hero'];
		$unit_total['hero'] += $movement['hero'];
		if($uni['hero'] !=0){$cl = '';}else{$cl = 'none';}
		echo '<td class="'.$cl.'">'.$uni['hero'].'</td>';
		echo '</tr>';
	}
?>

<tr>
<th>Sum</th>
<?php
	for ($i=($session->tribe-1)*10+1; $i<=($session->tribe)*10; $i++) {
		if($unit_total['u'.$i] !=0){$cl = '';}else{$cl = 'none';}
		echo '<td class="'.$cl.'">'.$unit_total['u'.$i].'</td>';
	}
	if($unit_total['hero'] !=0){$cl = '';}else{$cl = 'none';}
	echo '<td class="'.$cl.'">'.$unit_total['hero'].'</td>';

?>
</tr></tbody></table>
