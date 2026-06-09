<?php
/**
 * ==========================================================
 * 2.tpl - RESOURCES SAFE PERFORMANCE PATCH
 * ==========================================================
 * - Logică originală păstrată 100%
 * - Compatibil PHP 5.6 / 7+
 * - Reducere acces repetitiv array
 * - Optimizare mici calcule și condiții
 * - Comentarii pentru mentenanță
 * ==========================================================
 */

include('menu.tpl');
?>

<table id="ressources" cellpadding="1" cellspacing="1">

<thead>
<tr>
	<th colspan="6"><?php echo RESOURCES ?></th>
</tr>

<tr>
	<td><?php echo VILLAGE; ?></td>
	<td><img class="r1" src="img/x.gif" alt=""></td>
	<td><img class="r2" src="img/x.gif" alt=""></td>
	<td><img class="r3" src="img/x.gif" alt=""></td>
	<td><img class="r4" src="img/x.gif" alt=""></td>
	<td><?php echo MERCHANT ?></td>
</tr>
</thead>

<tbody>
<?php
// ==========================================================
// LISTĂ VILLAGES
// ==========================================================
$varray = $database->getProfileVillages($session->uid);

// SUM GLOBAL RESURSE
$woodSUM = 0;
$claySUM = 0;
$ironSUM = 0;
$cropSUM = 0;

foreach ($varray as $vil) {

	$vid = $vil['wref'];

	// date sat (1 singur apel SQL)
	$vdata = $database->getVillage($vid);

	// comercianți
	$totalmerchants  = $building->getTypeLevel(17, $vid);
	$usedmerchants   = $database->totalMerchantUsed($vid);
	$availmerchants   = $totalmerchants - $usedmerchants;

	// ==========================================================
	// RESURSE (LIMITARE LA STORAGE)
	// ==========================================================
	$wood = ($vdata['wood'] > $vdata['maxstore']) ? $vdata['maxstore'] : $vdata['wood'];
	$clay = ($vdata['clay'] > $vdata['maxstore']) ? $vdata['maxstore'] : $vdata['clay'];
	$iron = ($vdata['iron'] > $vdata['maxstore']) ? $vdata['maxstore'] : $vdata['iron'];
	$crop = ($vdata['crop'] > $vdata['maxcrop'])  ? $vdata['maxcrop']  : $vdata['crop'];

	// highlight sat curent
	$class = ($vid == $village->wid) ? 'hl' : '';

	// ==========================================================
	// OUTPUT ROW
	// ==========================================================
	echo '
	<tr class="'.$class.'">
		<td class="vil fc">
			<a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a>
		</td>

		<td class="lum">'.number_format(round($wood)).'</td>
		<td class="clay">'.number_format(round($clay)).'</td>
		<td class="iron">'.number_format(round($iron)).'</td>
		<td class="crop">'.number_format(round($crop)).'</td>

		<td class="tra lc">
			'.($totalmerchants > 0 ? '<a href="build.php?newdid='.$vid.'&amp;gid=17">' : '').'
			'.$availmerchants.'/'.$totalmerchants.'
			</a>
		</td>
	</tr>';

	// ==========================================================
	// SUME GLOBALE
	// ==========================================================
	$woodSUM += $wood;
	$claySUM += $clay;
	$ironSUM += $iron;
	$cropSUM += $crop;
}
?>

<!-- ==========================================================
     TOTAL RESOURCES ROW
========================================================== -->
<tr>
	<td colspan="6" class="empty"></td>
</tr>

<tr class="sum">
	<th><?php echo SUM; ?></th>

	<td class="lum"><?php echo number_format(round($woodSUM)); ?></td>
	<td class="clay"><?php echo number_format(round($claySUM)); ?></td>
	<td class="iron"><?php echo number_format(round($ironSUM)); ?></td>
	<td class="crop"><?php echo number_format(round($cropSUM)); ?></td>

	<td class="tra">&nbsp;</td>
</tr>

</tbody>
</table>