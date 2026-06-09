<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       villages.tpl                                                ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

$search = 0;

// validate search
if (!isset($_SESSION['search']) || !is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                <?php echo TZ_THE_VILLAGE; ?> <b>"<?php echo htmlspecialchars($_SESSION['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"</b> <?php echo TZ_DOES_NOT_EXIST; ?>
            </p>
        </font>
    </center>
<?php
    $search = 0;
} else {
    $search = (int)$_SESSION['search'];
}
?>

<table cellpadding="1" cellspacing="1" id="villages" class="row_table_data">
    <thead>
        <tr>
            <th colspan="5"><?php echo TZ_THE_LARGEST_VILLAGES; ?></th>
        </tr>
        <tr>
            <td></td>
            <td><?php echo VILLAGE; ?></td>
            <td><?php echo PLAYER; ?></td>
            <td><?php echo INHABITANTS; ?></td>
            <td><?php echo COORDINATES; ?></td>
        </tr>
    </thead>

    <tbody>
<?php
$rankArray = $ranking->getRank();

if (isset($_GET['rank'])) {
    $multiplier = 1;

    if (is_numeric($_GET['rank'])) {
        $rank = (int)$_GET['rank'];

        if ($rank > count($rankArray)) {
            $rank = max(1, count($rankArray) - 1);
        }

        while ($rank > (20 * $multiplier)) {
            $multiplier++;
        }

        $start = 20 * $multiplier - 19;
    } else {
        $start = ($_SESSION['start'] + 1);
    }
} else {
    $start = ($_SESSION['start'] + 1);
}

// render rows
if (count($rankArray) > 1) {

    for ($i = $start; $i < $start + 20; $i++) {

        if (!isset($rankArray[$i]['wref'])) {
            continue;
        }

        $row = $rankArray[$i];

        $isHighlight = ($i == $search);

        echo $isHighlight
            ? "<tr class=\"hl\"><td class=\"ra fc\">"
            : "<tr><td class=\"ra \">";

        echo $i . ".</td>";

        // village name
        echo "<td class=\"vil \">
                <a href=\"karte.php?d=" . (int)$row['wref'] . "&amp;c=" . $generator->getMapCheck($row['wref']) . "\">"
                . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') .
             "</a></td>";

        // player
        echo "<td class=\"pla \">
                <a href=\"spieler.php?uid=" . (int)$row['owner'] . "\">"
                . htmlspecialchars($row['user'], ENT_QUOTES, 'UTF-8') .
             "</a></td>";

        // population
        echo "<td class=\"hab\">" . (int)$row['pop'] . "</td>";

        // coordinates
        echo "<td class=\"aligned_coords \">
                <div class=\"cox\">(" . (int)$row['x'] . "</div>
                <div class=\"pi\">|</div>
                <div class=\"coy\">" . (int)$row['y'] . ")</div>
              </td>";

        echo "</tr>";
    }

} else {
    echo "<tr><td class=\"none\" colspan=\"5\">No villages found</td></tr>";
}
?>
    </tbody>
</table>

<?php include("ranksearch.tpl"); ?>