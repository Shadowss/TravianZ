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
		$unit = $database->getTraining($vid);
		$totalmerchants = $building->getTypeLevel(17,$vid);
		$availmerchants = $totalmerchants - $database->totalMerchantUsed($vid);
		$incoming_attacks = $database->getMovement(3,$vid,1);
		$bui = '';
		$tro = '';
		$att = '';

		if (count($incoming_attacks) > 0) {
			$inc_atts = count($incoming_attacks);
			for($i=0;$i<count($incoming_attacks);$i++){
				if($incoming_attacks[$i]['attack_type'] == 2) {
					$inc_atts -= 1;
				}
			}
			if($inc_atts > 0) {
				$att = '<a href="build.php?newdid='.$vid.'&id=39"><img class="att1" src="img/x.gif" title="'.count($incoming_attacks).' incoming attack'.(count($incoming_attacks)>1?'s':'').'" alt="'.count($incoming_attacks).' incoming attack'.(count($incoming_attacks)>1?'s':'').'"></a>';
			}
		}
		foreach($jobs as $b){
			$bui .= '<a href="build.php?newdid='.$vid.'&id='.$b['field'].'"><img class="bau" src="img/x.gif" title="'.$building->procResType($b['type']).'" alt="'.$building->procResType($b['type']).'"></a>';
		}	
		foreach($unit as $c){
			$gid = in_array($c['unit'],$unitsbytype['infantry'])?19:(in_array($c['unit'],$unitsbytype['cavalry'])?20:(in_array($c['unit'],$unitsbytype['siege'])?21:(in_array(($c['unit']-60),$unitsbytype['infantry'])?29:(in_array(($c['unit']-60),$unitsbytype['cavalry'])?30:($building->getTypeLevel(26)>0?26:25)))));
			if($c['unit'] > 60) { $c['unit'] -= 60; }
			$tro .= '<a href="build.php?newdid='.$vid.'&gid='.$gid.'"><img class="unit u'.$c['unit'].'" src="img/x.gif" title="'.$c['amt'].'x '.$technology->getUnitName($c['unit']).'" alt="'.$c['amt'].'x '.$technology->getUnitName($c['unit']).'"></a>';
		}
		if($vdata['capital'] == 1) { $class = 'hl'; } else {$class = ''; }

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
