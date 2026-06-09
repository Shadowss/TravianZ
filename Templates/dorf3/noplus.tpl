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

	<a href="dorf3.php" class="selected"><?php echo OVERVIEW; ?></a>
	|
	<span><?php echo RESOURCES; ?></span>
	|
	<span><?php echo WAREHOUSE; ?></span>
	|
	<span>CP</span>
	|
	<span><?php echo TROOPS; ?></span>

</div>

<table cellpadding="1" cellspacing="1" id="overview">

<thead>

<tr>
	<th colspan="5"><?php echo OVERVIEW; ?></th>
</tr>

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