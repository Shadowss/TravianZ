<?php
/**
 * ==========================================================
 * Overview.tpl - SAFE PERFORMANCE PATCH
 * ==========================================================
 * - Logică păstrată 100% identică
 * - Compatibil PHP 5.6 / 7+
 * - Reducere duplicări inutile
 * - Optimizare count() și array access
 * - Comentarii pentru mentenanță
 * ==========================================================
 */

include('menu.tpl');
?>

<table id="overview" cellpadding="1" cellspacing="1">
<thead>
<tr><th colspan="5"><?php echo OVERVIEW; ?></th></tr>
<tr>
	<td><?php echo VILLAGE; ?></td>
	<td><?php echo TZ_ATTACKS; ?></td>
	<td><?php echo TZ_BUILDING; ?></td>
	<td><?php echo TROOPS; ?></td>
	<td><?php echo MERCHANT; ?></td>
</tr>
</thead>

<tbody>
<?php
// ==========================================================
// LISTA VILLAGES UTILIZATOR
// ==========================================================
$varray = $database->getProfileVillages($session->uid);

foreach ($varray as $vil) {

	$vid = $vil['wref'];

	// Date sat
	$vdata = $database->getVillage($vid);

	// Lucrări construcții în desfășurare
	$jobs = $database->getJobs($vid);

	// Unități în training
	$units = $database->getTraining($vid);

	// ==========================================================
	// AGRUPARE UNITĂȚI (SAFE INIT)
	// ==========================================================
	$unitsArray = [];

	foreach ($units as $unit) {
		if (!isset($unitsArray[$unit['unit']])) {
			$unitsArray[$unit['unit']] = 0;
		}
		$unitsArray[$unit['unit']] += $unit['amt'];
	}

	// ==========================================================
	// MERCHANTS
	// ==========================================================
	$totalmerchants  = $building->getTypeLevel(17, $vid);
	$usedmerchants    = $database->totalMerchantUsed($vid);
	$availmerchants   = $totalmerchants - $usedmerchants;

	// ==========================================================
	// INCOMING ATTACKS
	// ==========================================================
	$incoming_attacks = $database->getMovement(3, $vid, 1);
	$att = '';

	if (!empty($incoming_attacks)) {

		$total_attacks = count($incoming_attacks);
		$inc_atts = $total_attacks;

		// filtrare atacuri ignorate (logică originală păstrată)
		for ($i = 0; $i < $total_attacks; $i++) {
			if (
				$incoming_attacks[$i]['attack_type'] == 1 ||
				$incoming_attacks[$i]['attack_type'] == 2
			) {
				$inc_atts -= 1;
			}
		}

		if ($inc_atts > 0) {
			$att = '<a href="build.php?newdid='.$vid.'&id=39">
						<img class="att1" src="img/x.gif"
						title="'.$total_attacks.' incoming attack'.($total_attacks > 1 ? 's' : '').'"
						alt="'.$total_attacks.' incoming attack'.($total_attacks > 1 ? 's' : '').'">
					</a>';
		}
	}

	// ==========================================================
	// BUILDING JOBS ICONS
	// ==========================================================
	$bui = '';
	foreach ($jobs as $b) {
		$bui .= '<a href="build.php?newdid='.$vid.'&id='.$b['field'].'">
					<img class="bau" src="img/x.gif"
					title="'.Building::procResType($b['type']).'"
					alt="'.Building::procResType($b['type']).'">
				 </a>';
	}

	// ==========================================================
	// TROOPS DISPLAY
	// ==========================================================
	$tro = '';

	foreach ($unitsArray as $key => $c) {

		// normalizare specială (păstrată din original)
		if ($key == 99) $key = 51;

		// determinare categorie unități
		$gid =
			in_array($key, $unitsbytype['infantry']) ? 19 :
			(in_array($key, $unitsbytype['cavalry']) ? 20 :
			(in_array($key, $unitsbytype['siege']) ? 21 :
			(in_array(($key - 60), $unitsbytype['infantry']) ? 29 :
			(in_array(($key - 60), $unitsbytype['cavalry']) ? 30 :
			($key == 51 ? 36 : ($building->getTypeLevel(26) > 0 ? 26 : 25))))));

		// ajustare offset unități
		if ($key > 60) {
			$key -= 60;
		}

		$unitName = $technology->getUnitName($key);

		$tro .= '<a href="build.php?newdid='.$vid.'&gid='.$gid.'">
					<img class="unit u'.($key == 51 ? 99 : $key).'"
					src="img/x.gif"
					title="'.$c.'x '.$unitName.'"
					alt="'.$c.'x '.$unitName.'">
				 </a>';
	}

	// ==========================================================
	// HIGHLIGHT VILLAGE CURENT
	// ==========================================================
	$class = ($vid == $village->wid) ? 'hl' : '';

	// ==========================================================
	// OUTPUT ROW
	// ==========================================================
	echo '
	<tr class="'.$class.'">
		<td class="vil fc">
			<a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a>
		</td>
		<td class="att">'.$att.'</td>
		<td class="bui">'.$bui.'</td>
		<td class="tro">'.$tro.'</td>
		<td class="tra lc">
			'.($totalmerchants > 0 ? '<a href="build.php?newdid='.$vid.'&amp;gid=17">' : '').'
			'.$availmerchants.'/'.$totalmerchants.'
			</a>
		</td>
	</tr>';
}
?>
</tbody>
</table>