<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HEROSMANSION TRAIN PAGE				                   ##
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

// ============================================================================
// REFACTOR - NOTE IMPORTANTE
// ============================================================================
// Two pre-existing bugs were found during the audit and are EXACTLY REPRODUCED
// (not corrected), according to the rule of not changing logic:
// 1) U3 (Imperian): in the original unfactored, the row did not close
// </center></td></tr> - it was written as a string without "$output.=" in front,
// so it was evaluated and thrown, with no effect. Replicated via the flag
// 'skip_closing_tags' below.
// 2) U13: the call $generator->getTimeFormat(...) for the training duration
// was executed, but the result was never concatenated to $output -
// the duration did not appear on that row at all. Replicated via the flag
// 'skip_duration' below (the call is made identically, only the result
// is no longer displayed).
// If at some point you want to FIX these 2 bugs (not just keep them
//), just delete the two entries in $bugOverrides below.
// ============================================================================

//check if there is unit needed in the village

$result      = mysqli_query($database->dblink, "SELECT * FROM " . TB_PREFIX . "units WHERE `vref` = " . (int) $village->wid . "");
$units_array = mysqli_fetch_array($result);

$count_hero = mysqli_fetch_array(mysqli_query($database->dblink, "SELECT Count(*) as Total FROM " . TB_PREFIX . "hero WHERE `uid` = " . $database->escape($session->uid) . ""), MYSQLI_ASSOC);
$count_hero = $count_hero['Total'];

// Explicit lookup instead of dynamic variables ${'u'.$unitID}. Variables
// u1, u2, u3, u5, u6, u11... are defined elsewhere (just like in
// the original that accessed them dynamically) - here we just put them in a single
// array, without changing where the values ​​come from. The "?? []" fallback is just
// defensive (avoid notices), the original didn't have one and assumed that
// the variables always exist.
$unitData = [
	1  => $u1  ?? [],
	2  => $u2  ?? [],
	3  => $u3  ?? [],
	5  => $u5  ?? [],
	6  => $u6  ?? [],
	11 => $u11 ?? [],
	12 => $u12 ?? [],
	13 => $u13 ?? [],
	15 => $u15 ?? [],
	16 => $u16 ?? [],
	21 => $u21 ?? [],
	22 => $u22 ?? [],
	24 => $u24 ?? [],
	25 => $u25 ?? [],
	26 => $u26 ?? [],
	51 => $u51 ?? [], 
	53 => $u53 ?? [], 
	54 => $u54 ?? [], 
	55 => $u55 ?? [], 
	56 => $u56 ?? [],
	61 => $u61 ?? [], 
	62 => $u62 ?? [], 
	63 => $u63 ?? [], 
	65 => $u65 ?? [], 
	66 => $u66 ?? [],
	71 => $u71 ?? [], 
	72 => $u72 ?? [], 
	73 => $u73 ?? [], 
	75 => $u75 ?? [], 
	76 => $u76 ?? [],
	81 => $u81 ?? [], 
	83 => $u83 ?? [], 
	84 => $u84 ?? [], 
	85 => $u85 ?? [], 
	86 => $u86 ?? [],
];

// The single source of truth for "which units belong to each tribe", used
// both when displaying the rows and when validating ?train=ID below (in
// the original it was duplicated: once implicitly through the 3 if(tribe==X) blocks,
// once explicitly in the switch in the validationArray).
// The first ID in each list (1, 11, 21) is the base unit of the tribe -
// it is always displayed, without research check, exactly as in the original.
$tribeUnits = [
	1 => [1, 2, 3, 5, 6],
	2 => [11, 12, 13, 15, 16],
	3 => [21, 22, 24, 25, 26],
	6 => [51, 53, 54, 55, 56],
	7 => [61, 62, 63, 65, 66],
	8 => [71, 72, 73, 75, 76],
	9 => [81, 83, 84, 85, 86],
];

// The 2 pre-existing bugs, explicitly identified on the unit (see note above).
$bugOverrides = [
	3  => ['skip_closing_tags' => true],
	13 => ['skip_duration'     => true],
];

// Render a row from the hero training table for a unit.
// Replace the 15 nearly identical blocks in the unfactored original.
$renderTrainRow = function ($unitID, $unitData, $unitName, $units_array, $bugOptions = []) use ($database, $session, $village, $building, $generator, $id) {
	$skipDuration    = $bugOptions['skip_duration'] ?? false;
	$skipClosingTags = $bugOptions['skip_closing_tags'] ?? false;

	$data = $unitData[$unitID];

	$row  = "<tr>";
	$row .=     "<td class=\"desc\">";
	$row .=         "<div class=\"tit\">";
	$row .=             "<img class=\"unit u" . $unitID . "\" src=\"img/x.gif\" alt=\"" . $unitName . "\" title=\"" . $unitName . "\" />";
	$row .=             $unitName;
	$row .=         "</div>";
	$row .=         "<div class=\"details\">";
	$row .=             "<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"" . LUMBER . "\" />" . $data['wood'] . "|";
	$row .=             "<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"" . CLAY . "\" />" . $data['clay'] . "|";
	$row .=             "<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"" . IRON . "\" />" . $data['iron'] . "|";
	$row .=             "<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"" . CROP . "\" />" . $data['crop'] . "|";
	$row .=             "<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"" . CROP_COM . "\" />6|";
	$row .=             "<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"" . DURATION . "\" />";

	// The call is always made (just like in the original, including for U13);
	// only the display of the result is omitted for the pre-existing bug of U13.
	$durationText = $generator->getTimeFormat($database->getArtifactsValueInfluence($session->uid, $village->wid, 5, $data['time'] / SPEED) * 3);
	if (!$skipDuration) {
		$row .= $durationText;
	}

	//-- If available resources combined are not enough, remove NPC button
	$total_required = (int) ($data['wood'] + $data['clay'] + $data['iron'] + $data['crop']);
	if ($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
		$row .= "|<a href=\"build.php?gid=17&t=3&r1=" . $data['wood'] . "&r2=" . $data['clay'] . "&r3=" . $data['iron'] . "&r4=" . $data['crop'] . "\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
	}

	$row .=         "</div>";
	$row .=     "</td>";
	$row .=     "<td class=\"val\" width=\"20%\"><center>";

	if ($village->awood < $data['wood'] || $village->aclay < $data['clay'] || $village->airon < $data['iron'] || $village->acrop < $data['crop']) {
		$row .= "<span class=\"none\">" . NOT . "" . ENOUGH_RESOURCES . "</span>";
	} elseif ($units_array['u' . $unitID] == 0) {
		$row .= "<span class=\"none\">" . NOT_UNITS . "</span>";
	} else {
		$row .= "<a href=\"build.php?id=" . $id . "&train=" . $unitID . "\">" . TRAIN . "</a>";
	}

	// Pre-existing U3 bug: closing tags are no longer added.	
	if (!$skipClosingTags) {
		$row .= "</center></td></tr>";
	}

	return $row;
};

if ($count_hero < 3) {

	$output = "<table cellpadding=1 cellspacing=1 class=\"build_details\">
        <thead>
            <tr>
                <th colspan=2>" . TRAIN_HERO . "</th>
            </tr>
        </thead>";

	if (isset($tribeUnits[$session->tribe])) {
		foreach ($tribeUnits[$session->tribe] as $index => $unitID) {
			$isBaseUnit = ($index === 0); // u1 / u11 / u21: mereu afisat, fara research check
			$unitName   = constant('U' . $unitID);
			$bugOptions = $bugOverrides[$unitID] ?? [];

			if ($isBaseUnit || $database->checkIfResearched($village->wid, 't' . $unitID) != 0) {
				$output .= $renderTrainRow($unitID, $unitData, $unitName, $units_array, $bugOptions);
			}
		}
	}

	//HERO TRAINING
	if (isset($_GET['train'])) {
		$validationArray = $tribeUnits[$session->tribe] ?? [];

		// check for a valid unit value
		if (in_array($_GET['train'], $validationArray)) {
			if ($count_hero < 3) {
				$unitID = $_GET['train'];
				mysqli_query($database->dblink, "INSERT INTO " . TB_PREFIX . "hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES (" . $database->escape($session->uid) . ", " . (int) $village->wid . ", 0, " . $unitID . ", '" . $database->escape($session->username) . "', 0, 5, 0, 0, 100, 0, 0, 0, 0, " . round((time() + ($unitData[$unitID]['time'] / SPEED) * 3)) . ", 50, 1)");
				mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "units SET `u$unitID` = `u$unitID` - 1 WHERE `vref` = " . (int) $village->wid);
				mysqli_query($database->dblink, "
					    UPDATE " . TB_PREFIX . "vdata
					        SET
					            `wood` = `wood` - " . (int) $unitData[$unitID]['wood'] . ",
					            `clay` = `clay` - " . (int) $unitData[$unitID]['clay'] . ",
					            `iron` = `iron` - " . (int) $unitData[$unitID]['iron'] . ",
					            `crop` = `crop` - " . (int) $unitData[$unitID]['crop'] . "
                            WHERE
                                `wref` = " . (int) $village->wid);
			}
			header("Location: build.php?id=" . $id . "");
			exit;
		}
	}

	echo $output;
}
// NOTE (pre-existing behavior, kept unchanged): if $count_hero >= 3,
// $output is no longer created and no longer echoed - but the </table> below
// is outside this if and is displayed unconditionally. In that case the file
// generates an "orphan" </table>, without a corresponding <table>. This was also the case in
// the original file.
?>
</table>
