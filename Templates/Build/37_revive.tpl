<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HEROSMANSION REVIVE PAGE				                   ##
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

?>


<table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
            <tr>
                <th colspan="2"><?php echo REVIVE; ?> <?php echo U0; ?></th>
            </tr>
        </thead>

<?php

// Explicit lookup instead of dynamic variables ${'h'.$unit.'_full'}.
// The variables h1_full, h2_full, ... h26_full are defined elsewhere
// (hero_full.php / build.php's global context), exactly as they were
// accessed dynamically in the original - here we just put them in a single array,
// without changing where the values ​​come from.
$heroFullData = [
	1  => $h1_full  ?? [],
	2  => $h2_full  ?? [],
	3  => $h3_full  ?? [],
	5  => $h5_full  ?? [],
	6  => $h6_full  ?? [],
	11 => $h11_full ?? [],
	12 => $h12_full ?? [],
	13 => $h13_full ?? [],
	15 => $h15_full ?? [],
	16 => $h16_full ?? [],
	21 => $h21_full ?? [],
	22 => $h22_full ?? [],
	24 => $h24_full ?? [],
	25 => $h25_full ?? [],
	26 => $h26_full ?? [],
];

// The "can be resurrected" line was duplicated identically in the original: one version
// for the base unit of the tribe (without research check) and one for
// the rest of the units (with research check) - but the generated HTML was byte-for-byte
// the same. Extracted here once, called from both branches below.
$renderReviveRow = function ($hero_datarow, $name, $wood, $clay, $iron, $crop, $training_time, $id) use ($session, $building, $village) {
	$total_required = (int) ($wood + $clay + $iron + $crop);

	$html  = "<tr>";
	$html .= "<td class=\"desc\">";
	$html .=     "<div class=\"tit\">";
	$html .=         "<img class=\"unit u" . $hero_datarow['unit'] . "\" src=\"img/x.gif\" alt=\"" . $name . "\" title=\"" . $name . "\" />";
	$html .=         $name . " (Level " . $hero_datarow['level'] . ")";
	$html .=     "</div>";
	$html .=     "<div class=\"details\">";
	$html .=         "<img class=\"r1\" src=\"img/x.gif\" alt=\"" . TZ_WOOD . "\" title=\"" . LUMBER . "\" />" . $wood . "|";
	$html .=         "<img class=\"r2\" src=\"img/x.gif\" alt=\"" . CLAY . "\" title=\"" . CLAY . "\" />" . $clay . "|";
	$html .=         "<img class=\"r3\" src=\"img/x.gif\" alt=\"" . IRON . "\" title=\"" . IRON . "\" />" . $iron . "|";
	$html .=         "<img class=\"r4\" src=\"img/x.gif\" alt=\"" . CROP . "\" title=\"" . CROP . "\" />" . $crop . "|";
	$html .=         "<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"" . CROP_COM . "\" />6|";
	$html .=         "<img class=\"clock\" src=\"img/x.gif\" alt=\"" . DURATION . "\" title=\"" . DURATION . "\" />";
	$html .=         $training_time;

	//-- If available resources combined are not enough, remove NPC button
	if ($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
		$html .= "|<a href=\"build.php?gid=17&t=3&r1=" . $wood . "&r2=" . $clay . "&r3=" . $iron . "&r4=" . $crop . "\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
	}

	$html .=     "</div>";
	$html .= "</td>";

	$html .= "<td class=\"val\" width=\"20%\" style=\"text-align: center\">";
	if ($village->awood < $wood || $village->aclay < $clay || $village->airon < $iron || $village->acrop < $crop) {
		$html .= "<span class=\"none\">" . NOT . "" . ENOUGH_RESOURCES . "</span>";
	} else {
		$html .= "<a href=\"build.php?id=" . $id . "&amp;revive=1&amp;hid=" . $hero_datarow['heroid'] . "\">" . REVIVE . "</a>";
	}
	$html .= "</td>";
	$html .= "</tr>";

	return $html;
};

// check if there is a hero in revive already
$reviving = $training = false;

foreach ($heroes as $hero_datarow) {
	if ($hero_datarow['inrevive']) {
		$reviving = true;
	}
	if ($hero_datarow['intraining']) {
		$training = true;
	}

	$name = $technology->getUnitName($hero_datarow['unit']);

	// Collapsed the two branches (level <= 60 / level > 60) that differed
	// only by the key used in the lookup (current level vs. ceiling 60) -
	// same result, without duplicating the 5 calculation lines.
	$levelKey      = ($hero_datarow['level'] <= 60) ? $hero_datarow['level'] : 60;
	$heroLevelData = $heroFullData[$hero_datarow['unit']][$levelKey];

	$wood = $heroLevelData['wood'];
	$clay = $heroLevelData['clay'];
	$iron = $heroLevelData['iron'];
	$crop = $heroLevelData['crop'];

	$timeToTrain    = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, $heroLevelData['time'] / SPEED);
	$training_time  = $generator->getTimeFormat($timeToTrain);
	$training_time2 = time() + $timeToTrain;

	if ($hero_datarow['inrevive'] == 1) {
		$timeleft = $generator->getTimeFormat($hero_datarow['trainingtime'] - time());
		?>
    	<table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>".HERO_READY." <span id=timer".++$session->timer.">".$timeleft."</span></th></tr>"; ?>
            </tr>
        </thead>

            <tr>
			<?php
			// NOTE (pre-existing bug, kept unchanged): $name1 comes from
			// the parent scope (37.tpl), where at this point in the flow it is
			// 'unknown' - NOT the real name of this $hero_datarow. Same
			// behavior as in the original file.
				   echo "<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u".$hero_datarow['unit']."\" src=\"img/x.gif\" alt=\"".$name."\" title=\"".$name."\" />
						$name ($name1)
					</div>"
			?>

            </tr>
    </table>
		<?php
	} elseif (!$reviving) {
		if (in_array($hero_datarow['unit'], [1, 11, 21, 51, 61, 71, 81])) {
			// basic unit of the tribe - available without research
			echo $renderReviveRow($hero_datarow, $name, $wood, $clay, $iron, $crop, $training_time, $id);
		} else {
			if ($database->checkIfResearched($village->wid, 't' . $hero_datarow['unit']) != 0) {
				echo $renderReviveRow($hero_datarow, $name, $wood, $clay, $iron, $crop, $training_time, $id);
			}
		}
	}

	if (isset($_GET['revive']) && $_GET['revive'] == 1 && isset($_GET['hid']) && $_GET['hid'] == $hero_datarow['heroid'] && $hero_datarow['inrevive'] == 0 && $hero_datarow['intraining'] == 0 && $hero_datarow['dead'] == 1) {
		mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "hero SET `inrevive` = '1', `trainingtime` = '" . (int) $training_time2 . "', `wref` = '" . (int) $village->wid . "' WHERE `heroid` = " . (int) $_GET['hid'] . " AND `uid` = '" . (int) $session->uid . "'");
		$database->modifyResource($village->wid, $wood, $clay, $iron, $crop, 0);
		header("Location: build.php?id=" . $id . "");
		exit;
	}
}
?>

</table><br />


	<?php
	// NOTE: plain include() (not include_once), just like in the original. It
	// is important to keep it that way - if 37_train.tpl has already been included from
	// 37.tpl via an include_once earlier in the same request, PHP
	// tracks the file as "already included" globally (regardless of what kind of
	// include it was first brought in), so a subsequent include_once in
	// 37.tpl will not re-run it. Changing to include_once here wouldn't be
	// wrong per se, but I preferred not to change this detail at all.
	if (!$reviving && !$training) {
		include("37_train.tpl");
	}
	?>
