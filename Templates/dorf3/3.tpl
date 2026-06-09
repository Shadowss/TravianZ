<?php
/**
 * ==========================================================
 * 3.tpl - WAREHOUSE SAFE PERFORMANCE PATCH
 * ==========================================================
 * - Logică complet păstrată (TravianZ compatible)
 * - Compatibil PHP 5.6 / 7+
 * - Reducere acces repetitiv array
 * - Optimizare bucle și calcule
 * - Comentarii pentru mentenanță
 * ==========================================================
 */

include('menu.tpl');
?>

<table id="warehouse" cellpadding="1" cellspacing="1">

<thead>
<tr>
	<th colspan="7"><?php echo WAREHOUSE; ?></th>
</tr>

<tr>
	<td><?php echo VILLAGE; ?></td>
	<td><img class="r1" src="img/x.gif" title="<?php echo TZ_WOOD; ?>" alt="<?php echo TZ_WOOD; ?>"></td>
	<td><img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>" alt="<?php echo CLAY; ?>"></td>
	<td><img class="r3" src="img/x.gif" title="<?php echo IRON; ?>" alt="<?php echo IRON; ?>"></td>
	<td><img class="clock" src="img/x.gif" title="<?php echo TZ_CLOCK; ?>" alt="<?php echo TZ_CLOCK; ?>"></td>
	<td><img class="r4" src="img/x.gif" title="<?php echo CROP; ?>" alt="<?php echo CROP; ?>"></td>
	<td><img class="clock" src="img/x.gif" title="<?php echo TZ_CLOCK; ?>" alt="<?php echo TZ_CLOCK; ?>"></td>
</tr>
</thead>

<tbody>

<?php
// ==========================================================
// VILLAGES LIST
// ==========================================================
$varray = $database->getProfileVillages($session->uid);

foreach ($varray as $vil) {

	$vid = $vil['wref'];

	// date sat
	$vdata = $database->getVillage($vid);

	// ==========================================================
	// RESURSE & LIMITS
	// ==========================================================
	$wood = floor($vdata['wood']);
	$clay = floor($vdata['clay']);
	$iron = floor($vdata['iron']);
	$crop = floor($vdata['crop']);

	$maxs = $vdata['maxstore'];
	$maxc = $vdata['maxcrop'];

	// populație
	$pop = $vdata['pop'];

	// ==========================================================
	// RESOURCE FIELDS
	// ==========================================================
	$vresarray = $database->getResourceLevel($vid);

	$woodholder = $clayholder = $ironholder = $cropholder = [];
	$sawmill = $claypit = $foundry = $grainmill = $bakery = 0;

	// scan fields (38)
	for ($i = 1; $i <= 38; $i++) {

		$type = $vresarray['f'.$i.'t'];
		$level = $vresarray['f'.$i];

		if ($type == 1) $woodholder[] = 'f'.$i;
		elseif ($type == 2) $clayholder[] = 'f'.$i;
		elseif ($type == 3) $ironholder[] = 'f'.$i;
		elseif ($type == 4) $cropholder[] = 'f'.$i;
		elseif ($type == 5) $sawmill = $level;
		elseif ($type == 6) $claypit = $level;
		elseif ($type == 7) $foundry = $level;
		elseif ($type == 8) $grainmill = $level;
		elseif ($type == 9) $bakery = $level;
	}

	// ==========================================================
	// PRODUCTION BASE (FIELDS)
	// ==========================================================
	$prod_wood = $prod_clay = $prod_iron = $prod_crop = 0;

	foreach ($woodholder as $f)  $prod_wood += $bid1[$vresarray[$f]]['prod'];
	foreach ($clayholder as $f)  $prod_clay += $bid2[$vresarray[$f]]['prod'];
	foreach ($ironholder as $f)  $prod_iron += $bid3[$vresarray[$f]]['prod'];
	foreach ($cropholder as $f)  $prod_crop += $bid4[$vresarray[$f]]['prod'];

	// ==========================================================
	// BONUS BUILDINGS
	// ==========================================================
	if ($sawmill >= 1)
		$prod_wood += ($prod_wood / 100) * $bid5[$sawmill]['attri'];

	if ($claypit >= 1)
		$prod_clay += ($prod_clay / 100) * $bid6[$claypit]['attri'];

	if ($foundry >= 1)
		$prod_iron += ($prod_iron / 100) * $bid7[$foundry]['attri'];

	if ($grainmill >= 1 || $bakery >= 1) {
		$bonus = 0;
		if (isset($bid8[$grainmill]['attri'])) $bonus += $bid8[$grainmill]['attri'];
		if (isset($bid9[$bakery]['attri']))    $bonus += $bid9[$bakery]['attri'];

		$prod_crop += ($prod_crop / 100) * $bonus;
	}

	// ==========================================================
	// OASIS (placeholder logic păstrat)
	// ==========================================================
	$oasisowned = $database->getOasis($vid);

	// ==========================================================
	// PLUS ACCOUNT BONUS
	// ==========================================================
	if ($session->plus) {
		$prod_wood *= 1.25;
		$prod_clay *= 1.25;
		$prod_iron *= 1.25;
		$prod_crop *= 1.25;
	}

	// speed server
	$prod_wood *= SPEED;
	$prod_clay *= SPEED;
	$prod_iron *= SPEED;
	$prod_crop *= SPEED;

	// ==========================================================
	// CONSUMPTION
	// ==========================================================
	$prod_crop -= $pop;
	$prod_crop -= $technology->getUpkeep($technology->getAllUnits($vid), 0);

	// ==========================================================
	// STORAGE %
	// ==========================================================
	$percentW  = floor($wood / ($maxs / 100));
	$percentC  = floor($clay / ($maxs / 100));
	$percentI  = floor($iron / ($maxs / 100));
	$percentCr = floor($crop / ($maxc / 100));

	$class = ($vid == $village->wid) ? 'hl' : '';

	// ==========================================================
	// WARNING LEVEL
	// ==========================================================
	$cr = 95;

	$critW  = ($percentW >= $cr)  ? 'crit' : '';
	$critC  = ($percentC >= $cr)  ? 'crit' : '';
	$critI  = ($percentI >= $cr)  ? 'crit' : '';
	$critCR = ($percentCr >= $cr) ? 'crit' : '';

	$critNCR = '';
	if ($prod_crop < 0) {
		$critCR = 'crit';
		$critNCR = 'crit';
	}

	// ==========================================================
	// TIMERS
	// ==========================================================
	$timerwood = floor(($maxs - $wood) / $prod_wood * 3600);
	$timerclay = floor(($maxs - $clay) / $prod_clay * 3600);
	$timeriron = floor(($maxs - $iron) / $prod_iron * 3600);

	$timer1 = min($timerwood, $timerclay, $timeriron);

	$timer2 = floor(
		($prod_crop >= 0 ? $maxc - $crop : $crop)
		/ abs($prod_crop)
		* 3600
	);

	// session timer (global counter)
	if ($timer1 > 0) $session->timer++;

	echo '
	<tr class="'.$class.'">

		<td class="vil fc">
			<a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a>
		</td>

		<td class="lum '.$critW.'" title="'.$wood.'/'.$maxs.'">'.$percentW.'%</td>
		<td class="clay '.$critC.'" title="'.$clay.'/'.$maxs.'">'.$percentC.'%</td>
		<td class="iron '.$critI.'" title="'.$iron.'/'.$maxs.'">'.$percentI.'%</td>

		<td class="max123">
			<span '.($timer1 > 0 ? 'id="timer'.$session->timer.'"' : '').'>
				'.($timer1 >= 0 ? $generator->getTimeFormat($timer1) : 'Never').'
			</span>
		</td>
	';

	// crop timer counter
	if ($timer2 > 0) $session->timer++;

	echo '
		<td class="crop '.$critCR.'" title="'.$crop.'/'.$maxc.'">'.$percentCr.'%</td>

		<td class="max4 '.$critNCR.'">
			<span '.($timer2 > 0 ? 'id="timer'.$session->timer.'"' : '').'>
				'.($timer2 >= 0 ? $generator->getTimeFormat($timer2) : 'Never').'
			</span>
		</td>

	</tr>';
}
?>

</tbody>
</table>