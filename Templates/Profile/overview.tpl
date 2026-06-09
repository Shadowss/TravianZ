<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       overview.tpl                                                ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// =========================
// SECURITY: sanitize UID
// =========================
$uid = isset($_GET['uid']) ? (int)$_GET['uid'] : (int)$session->uid;

// =========================
// RANK PROCESS
// =========================
$ranking->procRankReq($_GET);

// ensure safe overwrite
$_GET['uid'] = $uid;

// =========================
// USER DATA
// =========================
$displayarray = $database->getUserArray($uid, 1);
$varmedal     = $database->getProfileMedal($uid);

// =========================
// PROFILE SAFE MERGE
// =========================

// marker legacy (păstrat pentru compatibilitate DB)
$profileSeparator = md5('skJkev3');

// păstrăm exact formatul original (IMPORTANT pentru medal.php)
$profiel = $displayarray['desc1'] . $profileSeparator . $displayarray['desc2'];

// medal.php se ocupă de procesare (NU îi strica inputul)
require("medal.php");

// split DUPĂ medal processing
$profiel = explode($profileSeparator, $profiel);

// safety fallback
if (!isset($profiel[0])) $profiel[0] = '';
if (!isset($profiel[1])) $profiel[1] = '';

// =========================
// VILLAGES + POPULATION
// =========================
$varray = $database->getProfileVillages($uid);
$totalpop = 0;

foreach ($varray as $vil) {
    $totalpop += (int)$vil['pop'];
}
?>

<h1><?php echo PLAYER_PROFILE; ?></h1>

<?php
// =========================
// MENU SWITCH (SELF vs SIT)
// =========================
if ($uid == $session->uid) {
    if ($session->sit == 0) {
        include("menu.tpl");
    } else {
        include("menu2.tpl");
    }
}
?>

<table id="profile" cellpadding="1" cellspacing="1">

<thead>

<tr>
    <th colspan="2">
        Player <?php echo htmlspecialchars($displayarray['username'], ENT_QUOTES, 'UTF-8'); ?>
    </th>
</tr>

<?php
// =========================
// STATUS FLAGS
// =========================
if ($displayarray['access'] == ADMIN)
    echo "<tr><th colspan='2'><font color='Red'><center><b>This player is Admin.</b></center></font></th></tr>";

if ($displayarray['access'] == MULTIHUNTER)
    echo "<tr><th colspan='2'><font color='Blue'><center><b>This player is Multihunter.</b></center></font></th></tr>";

if ($displayarray['access'] == BANNED)
    echo "<tr><th colspan='2'><font color='Green'><center><b>This player is BANNED.</b></center></font></th></tr>";

if ($displayarray['vac_mode'] == 1)
    echo "<tr><th colspan='2'><font color='Maroon'><center><b>This player is on VACATION.</b></center></font></th></tr>";
?>

<tr>
    <td><?php echo DETAIL; ?></td>
    <td><?php echo DESCRIPTION; ?></td>
</tr>

</thead>

<tbody>

<tr>
    <td class="empty"></td>
    <td class="empty"></td>
</tr>

<tr>

<td class="details">

<table cellpadding="0" cellspacing="0">

<?php
if ($displayarray['access'] == BANNED) {
    echo "<tr><td colspan='2'><center><b>".BANNED."</b></center></td></tr>";
}
?>

<tr>
    <th><?php echo RANK; ?></th>
    <td><?php echo $ranking->getUserRank($displayarray['id']); ?></td>
</tr>

<tr>
    <th><?php echo TRIBE; ?></th>
    <td>
        <?php
        $tribeArrays = [TRIBE1, TRIBE2, TRIBE3, TRIBE4, TRIBE5];
        echo $tribeArrays[$displayarray['tribe'] - 1];
        ?>
    </td>
</tr>

<tr>
    <th><?php echo ALLIANCE; ?></th>
    <td>
        <?php
        if ($displayarray['alliance'] == 0) {
            echo "-";
        } else {
            $displayalliance = $database->getAllianceName($displayarray['alliance']);
            echo '<a href="allianz.php?aid=' . (int)$displayarray['alliance'] . '">' .
                 htmlspecialchars($displayalliance, ENT_QUOTES, 'UTF-8') .
                 '</a>';
        }
        ?>
    </td>
</tr>

<tr>
    <th><?php echo VILLAGES; ?></th>
    <td><?php echo count($varray); ?></td>
</tr>

<tr>
    <th><?php echo POP; ?></th>
    <td><?php echo (int)$totalpop; ?></td>
</tr>

<?php
// =========================
// AGE
// =========================
if (!empty($displayarray['birthday'])) {
    $age = date('Y') - substr($displayarray['birthday'], 0, 4);

    if ((date('m') - substr($displayarray['birthday'], 5, 2)) < 0) $age--;
    elseif ((date('m') - substr($displayarray['birthday'], 5, 2)) == 0) {
        if (date('d') < substr($displayarray['birthday'], 8, 2)) $age--;
    }

    echo "<tr><th>Age</th><td>$age</td></tr>";
}

// =========================
// GENDER
// =========================
if (!empty($displayarray['gender'])) {
    $gender = ($displayarray['gender'] == 1) ? "Male" : "Female";
    echo "<tr><th>".GENDER."</th><td>$gender</td></tr>";
}

// =========================
// LOCATION
// =========================
if (!empty($displayarray['location'])) {
    echo "<tr><th>".LOCATION."</th><td>" .
         htmlspecialchars($displayarray['location'], ENT_QUOTES, 'UTF-8') .
         "</td></tr>";
}
?>

<tr>
    <td colspan="2" class="empty"></td>
</tr>

<tr>
<?php
// =========================
// ACTION BUTTONS
// =========================

// Natar tribe (de obicei 5 în Travian-like setups)
$isNatar = (isset($displayarray['tribe']) && $displayarray['tribe'] == 5);

// Nature special account (fixed UID = 2)
$isNature = ($uid == 2);

if ($uid == $session->uid) {

    // =========================
    // OWN PROFILE ACTION
    // =========================
    if ($session->sit == 0) {
        echo '<td colspan="2"><a href="spieler.php?s=1">&raquo; Change profile</a></td>';
    } else {
        echo '<td colspan="2"><span class="none"><b>&raquo; Change profile</b></span></td>';
    }

} else {

    // =========================
    // BLOCK SYSTEM ACCOUNTS
    // =========================
    if ($isNatar || $isNature) {

        echo '<td colspan="2"><span class="none"><b>&raquo; Write message not available</b></span></td>';

    } else {

        echo '<td colspan="2"><a href="nachrichten.php?t=1&amp;id=' . (int)$uid . '">&raquo; Write message</a></td>';
    }
}
?>
</tr>

<tr>
<td colspan="2" class="desc2">
<div class="desc2div">
    <?php echo nl2br($profiel[0]); ?>
</div>
    </td>
</tr>

</table>

</td>

<td class="desc1">
<div class="desc1div">
    <?php echo nl2br($profiel[1]); ?>
</div>
</td>

</tr>

</tbody>

</table>

<!-- ========================= VILLAGES ========================= -->

<table cellpadding="1" cellspacing="1" id="villages">

<thead>

<tr>
    <th colspan="<?php echo (defined('NEW_FUNCTIONS_OASIS') && NEW_FUNCTIONS_OASIS) ? 4 : 3; ?>">
        Villages
    </th>
</tr>

<tr>
    <td><?php echo NAME; ?></td>

    <?php if (defined('NEW_FUNCTIONS_OASIS') && NEW_FUNCTIONS_OASIS) { ?>
        <td><?php echo OASIS; ?></td>
    <?php } ?>

    <td><?php echo INHABITANTS; ?></td>
    <td><?php echo COORDINATES; ?></td>
</tr>

</thead>

<tbody>

<?php
foreach ($varray as $vil) {

    $hasArtifact = $database->villageHasArtefact($vil['wref']);
    $coor = $database->getCoor($vil['wref']);

    echo "<tr><td class=\"nam\">
          <a href=\"karte.php?d=" . (int)$vil['wref'] . "&amp;c=" . $generator->getMapCheck($vil['wref']) . "\">"
          . htmlspecialchars($vil['name'], ENT_QUOTES, 'UTF-8') .
          "</a>";

    if ($vil['capital'] == 1) echo "<span class=\"none3\"> (Capital)</span>";

    if (defined('NEW_FUNCTIONS_DISPLAY_ARTIFACT') && NEW_FUNCTIONS_DISPLAY_ARTIFACT) {
        if ($hasArtifact) echo "<span class=\"none3\"> (Artifact)</span>";
    }

    if (defined('NEW_FUNCTIONS_DISPLAY_WONDER') && NEW_FUNCTIONS_DISPLAY_WONDER) {
        if ($vil['natar'] == 1) echo "<span class=\"none3\"> (WoW)</span>";
    }

    // OASIS
    if (defined('NEW_FUNCTIONS_OASIS') && NEW_FUNCTIONS_OASIS) {

        echo "<td class=\"hab\">";

        $oases = $database->getOasis($vil['wref']);

        foreach ($oases as $oasis) {
            switch ($oasis['type']) {
                case 1:
                case 2: echo "<img class='r100' src='img/x.gif' title='+25% Lumber'> "; break;
                case 3: echo "<img class='r200' src='img/x.gif' title='+25% Lumber +25% Crop'> "; break;
                case 4:
                case 5: echo "<img class='r400' src='img/x.gif' title='+25% Clay'> "; break;
                case 6: echo "<img class='r500' src='img/x.gif' title='+25% Clay +25% Crop'> "; break;
                case 7:
                case 8: echo "<img class='r700' src='img/x.gif' title='+25% Iron'> "; break;
                case 9: echo "<img class='r800' src='img/x.gif' title='+25% Iron +25% Crop'> "; break;
                case 10:
                case 11: echo "<img class='r1000' src='img/x.gif' title='+25% Crop'> "; break;
                case 12: echo "<img class='r1100' src='img/x.gif' title='+50% Crop'> "; break;
            }
        }

        echo "</td>";
    }

    echo "<td class=\"hab\">" . (int)$vil['pop'] . "</td>
          <td class=\"aligned_coords\">
          <div class=\"cox\">(" . $coor['x'] . "</div>
          <div class=\"pi\">|</div>
          <div class=\"coy\">" . $coor['y'] . ")</div></td></tr>";
}
?>

</tbody>

</table>