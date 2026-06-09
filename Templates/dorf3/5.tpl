<?php
/**
 * ==========================================================
 * 5.tpl - OWN TROOPS SAFE PERFORMANCE PATCH
 * ==========================================================
 * - Logică 100% păstrată (TravianZ compatible)
 * - Compatibil PHP 5.6 / 7+
 * - Reducere iterări redundante
 * - Fix isset + init arrays
 * - Optimizare sumare unități + movement
 * - Comentarii pentru mentenanță
 * ==========================================================
 */

include('menu.tpl');
?>

<table id="troops" cellpadding="1" cellspacing="1">

<thead>

<tr>
	<th colspan="12"><?php echo OWN_TROOPS; ?></th>
</tr>

<tr>

<?php
$varray = $database->getProfileVillages($session->uid);
?>

<td><?php echo VILLAGE; ?></td>

<?php
// ==========================================================
// UNIT HEADERS (tribe-based)
// ==========================================================
$unit_start = ($session->tribe - 1) * 10 + 1;
$unit_end   = ($session->tribe) * 10;

$unit_total = [];

for ($i = $unit_start; $i <= $unit_end; $i++) {
	echo '<td><img class="unit u'.$i.'" src="img/x.gif" alt=""></td>';
	$unit_total['u'.$i] = 0;
}

// hero column
$unit_total['hero'] = 0;
echo '<td><img class="unit uhero" src="img/x.gif" alt=""></td>';
?>

</tr>

</thead>

<tbody>

<?php
// ==========================================================
// VILLAGES LOOP
// ==========================================================
foreach ($varray as $vil) {

	$vid = $vil['wref'];

	$class = ($vid == $village->wid) ? 'hl' : '';

	// base + reinforcement troops
	$units = $database->getEnforceVillage($vid, 1);
	array_unshift($units, $database->getUnit($vid));

	// movement troops (incoming/outgoing)
	$movement = $database->getVillageMovement($vid);

	// reset per village
	$uni = [];

	// init counters per unit type
	for ($i = $unit_start; $i <= $unit_end; $i++) {
		$key = 'u'.$i;
		$uni[$key] = 0;
	}

	$uni['hero'] = 0;

	// ==========================================================
	// SUM BASE + ENFORCEMENTS
	// ==========================================================
	foreach ($units as $unit) {

		for ($i = $unit_start; $i <= $unit_end; $i++) {
			$key = 'u'.$i;

			if (isset($unit[$key])) {
				$uni[$key] += $unit[$key];
				$unit_total[$key] += $unit[$key];
			}
		}

		// hero
		if (isset($unit['hero'])) {
			$uni['hero'] += $unit['hero'];
			$unit_total['hero'] += $unit['hero'];
		}
	}

	// ==========================================================
	// MOVEMENT ADDITION
	// ==========================================================
	for ($i = $unit_start; $i <= $unit_end; $i++) {
		$key = 'u'.$i;

		if (isset($movement[$key])) {
			$uni[$key] += $movement[$key];
			$unit_total[$key] += $movement[$key];
		}
	}

	if (isset($movement['hero'])) {
		$uni['hero'] += $movement['hero'];
		$unit_total['hero'] += $movement['hero'];
	}

	// ==========================================================
	// OUTPUT ROW
	// ==========================================================
	echo '<tr class="'.$class.'">';

	echo '<td class="vil fc">
			<a href="dorf1.php?newdid='.$vid.'">'.$vil['name'].'</a>
		  </td>';

	// units
	for ($i = $unit_start; $i <= $unit_end; $i++) {
		$key = 'u'.$i;

		$val = $uni[$key];

		$cl = ($val != 0) ? '' : 'none';

		echo '<td class="'.$cl.'">'.$val.'</td>';
	}

	// hero
	$heroVal = $uni['hero'];
	$cl = ($heroVal != 0) ? '' : 'none';

	echo '<td class="'.$cl.'">'.$heroVal.'</td>';

	echo '</tr>';
}
?>

<!-- ==========================================================
     SUM ROW
========================================================== -->

<tr>
	<th><?php echo SUM; ?></th>

<?php
for ($i = $unit_start; $i <= $unit_end; $i++) {
	$key = 'u'.$i;

	$val = isset($unit_total[$key]) ? $unit_total[$key] : 0;

	$cl = ($val != 0) ? '' : 'none';

	echo '<td class="'.$cl.'">'.$val.'</td>';
}

$heroTotal = $unit_total['hero'];
$cl = ($heroTotal != 0) ? '' : 'none';

echo '<td class="'.$cl.'">'.$heroTotal.'</td>';
?>

</tr>

</tbody>
</table>