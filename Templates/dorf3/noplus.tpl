<?php
/**
 * ==========================================================
 * noplus.tpl - SAFE CLEAN VERSION
 * ==========================================================
 * - Logică 100% păstrată (non-plus placeholder view)
 * - Compatibil PHP 5.6 / 7+
 * - Curățare structură HTML
 * - Evitare warnings
 * - Mică optimizare DB access
 * ==========================================================
 */
?>

<div id="textmenu">

	<a href="dorf3.php" class="selected">Overview</a>
	|
	<span>Resources</span>
	|
	<span>Warehouse</span>
	|
	<span>CP</span>
	|
	<span>Troops</span>

</div>

<table cellpadding="1" cellspacing="1" id="overview">

<thead>

<tr>
	<th colspan="5">Overview</th>
</tr>

<tr>
	<td>Village</td>
	<td>Attacks</td>
	<td>Building</td>
	<td>Troops</td>
	<td>Merchants</td>
</tr>

</thead>

<tbody>

<?php
// ==========================================================
// VILLAGES LIST (single fetch)
$varray = $database->getProfileVillages($session->uid);

foreach ($varray as $vil) {

	$vid = $vil['wref'];

	// single DB call per village
	$vdata = $database->getVillage($vid);

	// highlight capital
	$class = (!empty($vdata['capital']) && $vdata['capital'] == 1) ? 'hl' : '';

	echo '
	<tr class="'.$class.'">

		<td class="vil fc">
			<a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a>
		</td>

		<td class="att"><span class="none">?</span></td>

		<td class="bui"><span class="none">?</span></td>

		<td class="tro"><span class="none">?</span></td>

		<td class="tra lc">
			<a href="build.php?gid=17">?/?</a>
		</td>

	</tr>';
}
?>

</tbody>
</table>