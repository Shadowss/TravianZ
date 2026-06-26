<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HEROMANSION OASIS PAGE				                       ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

	$oasisarray = $database->getOasis($village->wid);

	if (isset($_GET['gid']) && $_GET['gid'] == 37 && isset($_GET['del']) && $database->getOasisField($_GET['del'], 'owner') == $session->uid) {
		$units->returnTroops($village->wid, 1);
		$database->removeOases($_GET['del']);
		header("Location: build.php?id=" . $id . "&land");
		exit;
	}

	// Explicit lookup, instead of the original repetitive switch:
	// each oasis type => which resources get bonus and how much.
	// Identical behavior to the original (same alt/title on each icon,
	// including the existing asymmetry: for wood, alt uses TZ_WOOD but
	// title uses LUMBER - kept exactly as in the original source).
	$oasisResourceIcons = [
		'wood' => ['class' => 'r1', 'alt' => TZ_WOOD, 'title' => LUMBER],
		'clay' => ['class' => 'r2', 'alt' => CLAY,    'title' => CLAY],
		'iron' => ['class' => 'r3', 'alt' => IRON,    'title' => IRON],
		'crop' => ['class' => 'r4', 'alt' => CROP,    'title' => CROP],
	];

	$oasisTypeBonuses = [
		1  => [['wood', 25]],
		2  => [['wood', 25]],
		3  => [['wood', 25], ['crop', 25]],
		4  => [['clay', 25]],
		5  => [['clay', 25]],
		6  => [['clay', 25], ['crop', 25]],
		7  => [['iron', 25]],
		8  => [['iron', 25]],
		9  => [['iron', 25], ['crop', 25]],
		10 => [['crop', 25]],
		11 => [['crop', 25]],
		12 => [['crop', 50]],
	];

	// Replace the original switch with 12 identical cases as the structure.
	// Unknown types => empty string, just like the lack of a 'default' in the original switch.
	$renderOasisBonus = function ($type) use ($oasisResourceIcons, $oasisTypeBonuses) {
		if (!isset($oasisTypeBonuses[$type])) {
			return '';
		}

		$html = '';
		foreach ($oasisTypeBonuses[$type] as $bonus) {
			[$resource, $percent] = $bonus;
			$icon = $oasisResourceIcons[$resource];
			$html .= '<img class="' . $icon['class'] . '" src="img/x.gif" alt="' . $icon['alt'] . '" title="' . $icon['title'] . '" />+' . $percent . '%';
		}

		return $html;
	};
?>
<table id="oases" cellpadding="1" cellspacing="1">
<thead><tr>
<th colspan="4"><?php echo OASES; ?></th>
</tr>
<tr>
<td><?php echo NAME; ?></td>
<td><?php echo COORDINATES; ?></td>
<td><?php echo LOYALTY; ?></td>
<td><?php echo RESOURCES; ?></td>
</tr></thead>
<tbody>

<?php
if (!empty($oasisarray)) {
	foreach ($oasisarray as $oasis) {
		$oasiscoor = $database->getCoor($oasis['wref']);
?>
<tr>
<td class="nam">
<a href="build.php?gid=37&c=<?php echo $generator->getMapCheck($oasis['wref']); ?>&del=<?php echo $oasis['wref']; ?>&land"><img class="del" src="img/x.gif" alt="<?php echo DELETE; ?>" title="<?php echo DELETE; ?>"></a>
<a href="karte.php?d=<?php echo $oasis['wref']; ?>&c=<?php echo $generator->getMapCheck($oasis['wref']) ?>"><?php echo $oasis['name']; ?></a>
</td>
<td class="aligned_coords">
<div class="cox">(<?php echo $oasiscoor['x']; ?></div>
<div class="pi">|</div>
<div class="coy"><?php echo $oasiscoor['y']; ?>)</div>
</td>
<td class="zp"><?php echo floor($oasis['loyalty']); ?>%</td>
<td class="res"><?php echo $renderOasisBonus($oasis['type']); ?></td>
</tr>
<?php
	}
} else {
?>
<tr>
<td class="none" colspan="4"><?php echo NO_OASIS; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
