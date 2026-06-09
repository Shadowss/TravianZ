<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       alliance.tpl                                                ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// Inițializare sigură pentru search
$search = 0;

// Verificăm dacă există valoare în sesiune
if (!isset($_SESSION['search']) || !is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                <?php echo TZ_THE_ALLIANCE; ?> <b>"<?php echo htmlspecialchars(isset($_SESSION['search']) ? $_SESSION['search'] : '', ENT_QUOTES, 'UTF-8'); ?>"</b> <?php echo TZ_DOES_NOT_EXIST; ?>
            </p>
        </font>
    </center>
<?php
} else {
    $search = (int)$_SESSION['search'];
}
?>

<table cellpadding="1" cellspacing="1" id="alliance" class="row_table_data">
    <thead>
        <tr>
            <th colspan="5">
                <?php echo TZ_THE_LARGEST_ALLIANCES; ?>
                <div id="submenu">
                    <a title="<?php echo TZ_TOP_10; ?>" href="statistiken.php?id=43">
                        <img class="btn_top10" src="img/x.gif" alt="<?php echo TZ_TOP_10; ?>">
                    </a>
                    <a title="<?php echo DEFENDER; ?>" href="statistiken.php?id=42">
                        <img class="btn_def" src="img/x.gif" alt="<?php echo DEFENDER; ?>">
                    </a>
                    <a title="<?php echo ATTACKER; ?>" href="statistiken.php?id=41">
                        <img class="btn_off" src="img/x.gif" alt="<?php echo ATTACKER; ?>">
                    </a>
                </div>
            </th>
        </tr>
        <tr>
            <td></td>
            <td><?php echo ALLIANCE; ?></td>
            <td><?php echo PLAYER; ?></td>
            <td>&Oslash;</td>
            <td><?php echo POINTS; ?></td>
        </tr>
    </thead>

    <tbody>
    <?php
    // Luăm ranking-ul (fallback dacă nu există)
    $rankArray = isset($ranking) ? $ranking->getRank() : array();

    // Start implicit sigur
    $start = isset($_SESSION['start']) ? ((int)$_SESSION['start'] + 1) : 1;

    // Dacă există rank în GET, îl validăm
    if (isset($_GET['rank']) && is_numeric($_GET['rank'])) {
        $rank = (int)$_GET['rank'];
        $multiplier = 1;
        $totalRanks = count($rankArray);

        // Limitare la dimensiunea array-ului
        if ($rank > $totalRanks) {
            $rank = $totalRanks - 1;
        }

        // Calcul paginare (pastrat logic original)
        while ($rank > (20 * $multiplier)) {
            $multiplier++;
        }

        $start = 20 * $multiplier - 19;
    }

    // Afișare rezultate
    if (!empty($rankArray) && count($rankArray) > 1) {

        for ($i = $start; $i < $start + 20; $i++) {

            // Validare element existent
            if (isset($rankArray[$i]) && $rankArray[$i] !== "pad" && isset($rankArray[$i]['name'])) {

                // Highlight pentru căutare
                $rowClass = ($i === $search) ? 'hl' : '';

                echo '<tr class="' . $rowClass . '">';
                echo '<td class="ra fc">' . $i . '.</td>';

                // Alliance link (XSS safe)
                echo '<td class="al">';
                echo '<a href="allianz.php?aid=' . (int)$rankArray[$i]['id'] . '">';
                echo htmlspecialchars($rankArray[$i]['tag'], ENT_QUOTES, 'UTF-8');
                echo '</a></td>';

                // Players
                echo '<td class="pla">' . (int)$rankArray[$i]['players'] . '</td>';

                // Average
                echo '<td class="av">' . (int)$rankArray[$i]['avg'] . '</td>';

                // Total population
                echo '<td class="po">' . (int)$rankArray[$i]['totalpop'] . '</td>';

                echo '</tr>';
            }
        }

    } else {
        echo '<tr><td class="none" colspan="5">No alliances found</td></tr>';
    }
    ?>
    </tbody>
</table>

<?php
// Include fallback-safe
include("ranksearch.tpl");
?>