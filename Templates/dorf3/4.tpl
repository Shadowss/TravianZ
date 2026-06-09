<?php
/**
 * ==========================================================
 * 4.tpl - CULTURE POINTS SAFE PERFORMANCE PATCH
 * ==========================================================
 * - Logică 100% păstrată (TravianZ compatible)
 * - Compatibil PHP 5.6 / 7+
 * - Reducere query-uri repetitive
 * - Fix inițializări + isset safety
 * - Optimizare loops (units display)
 * - Comentarii pentru mentenanță
 * ==========================================================
 */

include('menu.tpl');
?>

<table id="culture_points" cellpadding="1" cellspacing="1">

<thead>
<tr>
	<th colspan="5"><?php echo CULTUREPOINT; ?></th>
</tr>
<tr>
	<td><?php echo VILLAGE; ?></td>
	<td><?php echo TZ_CP_DAY; ?></td>
	<td><?php echo CELEBRATIONS; ?></td>
	<td><?php echo TROOPS; ?></td>
	<td><?php echo TZ_SLOTS; ?></td>
</tr>
</thead>

<tbody>

<?php
// ==========================================================
// INIT GLOBAL
// ==========================================================
$timer = 0;

$gesexp = 0;
$gesdorf = 0;
$gescp = 0;
$gessied = 0;
$gessen = 0;

// ==========================================================
// VILLAGES LIST
// ==========================================================
$varray = $database->getProfileVillages($session->uid);

foreach ($varray as $vil) {

	$vid = $vil['wref'];

	// CP (culture points)
	$cp = $database->getVillageField($vid, 'cp');

	// ==========================================================
	// EXP SLOTS (celebration slots)
	// ==========================================================
	$exp = 0;

	for ($i = 1; $i <= 3; $i++) {
		$slot = $database->getVillageField($vid, 'exp'.$i);

		if ($slot != 0) {
			$exp++;
		}
	}

	// ==========================================================
	// BUILDINGS LEVELS
	// ==========================================================
	$lvlTH  = $building->getTypeLevel(24, $vid);
	$lvlRes = $building->getTypeLevel(25, $vid);
	$lvlPal = $building->getTypeLevel(26, $vid);

	// slots calculation (păstrat identic)
	$maxslots =
		($lvlRes >= 10 ? floor($lvlRes / 10) : 0) +
		($lvlPal >= 10 ? floor(($lvlPal - 5) / 5) : 0);

	// ==========================================================
	// CELEBRATION TIMER
	// ==========================================================
	$hasCel = $database->getVillageField($vid, 'celebration');

	if ($hasCel != 0) {
		$timer++;
	}

	// highlight village
	$class = ($vid == $village->wid) ? 'hl' : '';

	// ==========================================================
	// TROOPS
	// ==========================================================
	$unit = $database->getUnit($vid);
	$tribe = $session->tribe;

	$siedler = isset($unit['u'.$tribe*10]) ? $unit['u'.$tribe*10] : 0;
	$senator = isset($unit['u'.((($tribe - 1) * 10) + 9)]) ? $unit['u'.((($tribe - 1) * 10) + 9)] : 0;

	// images (avoid recompute)
	$siedlerImg = '<img src="img/un/u/'.($tribe * 10).'.gif" alt="">';
	$senatorImg = '<img src="img/un/u/'.((($tribe - 1) * 10) + 9).'.gif" alt="">';

	// ==========================================================
	// OUTPUT ROW
	// ==========================================================
	echo '
	<tr class="'.$class.'">

		<td class="vil fc">
			<a href="dorf1.php?newdid='.$vid.'">'.$vil['name'].'</a>
		</td>

		<td class="cps">'.$cp.'</td>

		<td class="cel">';

			if ($lvlTH > 0) {
				echo '<a href="build.php?newdid='.$vid.'&amp;gid=24">';

				if ($hasCel != 0) {
					echo '<span id="timer'.$timer.'">'.$generator->getTimeFormat($hasCel - time()).'</span>';
				} else {
					echo '●';
				}

				echo '</a>';
			} else {
				echo '&nbsp;';
			}

	echo '</td>

		<td class="tro"><span>';

			// display troops (safe loops, same logic)
			for ($i = 0; $i < $siedler; $i++) {
				echo $siedlerImg;
			}

			for ($s = 0; $s < $senator; $s++) {
				echo $senatorImg;
			}

	echo '</span></td>

		<td class="slo lc">'.$exp.'/'.$maxslots.'</td>

	</tr>';

	// ==========================================================
	// GLOBAL SUMS
	// ==========================================================
	$gesexp += $exp;
	$gesdorf += $maxslots;
	$gescp += $cp;
	$gessied += $siedler;
	$gessen += $senator;
}
?>

<!-- ==========================================================
     TOTAL ROW
========================================================== -->
<tr>
	<td colspan="5" class="empty"></td>
</tr>

<tr class="sum">

	<th class="vil"><?php echo SUM; ?></th>

	<td class="cps"><?php echo $gescp; ?></td>

	<td class="cel none">&nbsp;</td>

	<td class="tro">
		<?php
			echo $gessied;
			echo $siedlerImg;
			echo '&nbsp;';
			echo $gessen;
			echo $senatorImg;
		?>
	</td>

	<td class="slo">
		<?php echo $gesexp.'/'.$gesdorf; ?>
	</td>

</tr>

</tbody>
</table>