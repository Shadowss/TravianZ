<?php
	include('menu.tpl');
?>
<table id="overview" cellpadding="1" cellspacing="1">
<thead>
<tr><th colspan="5">Overview</th></tr>
<tr><td>Village</td><td>Attacks</td><td>Building</td><td>Troops</td><td>Merchants</td></tr>
</thead>
<tbody>
<?php
	$varray = $database->getProfileVillages($session->uid);
	foreach($varray as $vil){
		$vid = $vil['wref'];
		$vdata = $database->getVillage($vid);
		$jobs = $database->getJobs($vid);
		$units = $database->getTraining($vid);
		$unitsArray = [];
		foreach($units as $unit) $unitsArray[$unit['unit']] += $unit['amt'];
		$totalmerchants = $building->getTypeLevel(17,$vid);
		$availmerchants = $totalmerchants - $database->totalMerchantUsed($vid);
		$incoming_attacks = $database->getMovement(3,$vid,1);
		$bui = $tro = $att = '';

		if (count($incoming_attacks) > 0) {
			$inc_atts = count($incoming_attacks);
			for($i=0;$i<count($incoming_attacks);$i++){
			    if($incoming_attacks[$i]['attack_type'] == 1 || $incoming_attacks[$i]['attack_type'] == 2) {
					$inc_atts -= 1;
				}
			}
			if($inc_atts > 0) {
				$att = '<a href="build.php?newdid='.$vid.'&id=39"><img class="att1" src="img/x.gif" title="'.count($incoming_attacks).' incoming attack'.(count($incoming_attacks)>1?'s':'').'" alt="'.count($incoming_attacks).' incoming attack'.(count($incoming_attacks)>1?'s':'').'"></a>';
			}
		}
		foreach($jobs as $b){
			$bui .= '<a href="build.php?newdid='.$vid.'&id='.$b['field'].'"><img class="bau" src="img/x.gif" title="'.Building::procResType($b['type']).'" alt="'.Building::procResType($b['type']).'"></a>';
		}	
		foreach($unitsArray as $key => $c){
		    if($key == 99) $key = 51;
			$gid = in_array($key, $unitsbytype['infantry'])?19:(in_array($key, $unitsbytype['cavalry'])?20:(in_array($key, $unitsbytype['siege'])?21:(in_array(($key-60), $unitsbytype['infantry'])?29:(in_array(($key-60), $unitsbytype['cavalry'])?30:($key == 51)?36:($building->getTypeLevel(26)>0?26:25)))));
			if($key > 60) { $key -= 60; }
			$tro .= '<a href="build.php?newdid='.$vid.'&gid='.$gid.'"><img class="unit u'.($key == 51 ? 99 : $key).'" src="img/x.gif" title="'.$c.'x '.$technology->getUnitName($key).'" alt="'.$c.'x '.$technology->getUnitName($key).'"></a>';
		}
		if($vid == $village->wid) { $class = 'hl'; } else {$class = ''; }

echo '
<tr class="'.$class.'">
<td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a></td>
<td class="att">'.$att.'</td>
<td class="bui">'.$bui.'</td>
<td class="tro">'.$tro.'</td>
<td class="tra lc">'.($totalmerchants>0?'<a href="build.php?newdid='.$vid.'&amp;gid=17">':'').$availmerchants.'/'.$totalmerchants.'</a></td>
</tr>';

	}
?>
</tbody></table>
