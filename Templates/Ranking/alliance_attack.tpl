<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       alliance_attack.tpl                                         ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// Validare search
if (!isset($_SESSION['search']) || !is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                The alliance <b>"<?php echo htmlspecialchars(isset($_SESSION['search']) ? $_SESSION['search'] : '', ENT_QUOTES, 'UTF-8'); ?>"</b> does not exist.
            </p>
        </font>
    </center>
<?php
    $search = 0;
} else {
    $search = (int)$_SESSION['search'];
}
?>

<table cellpadding="1" cellspacing="1" id="alliance_off" class="row_table_data">
    <thead>
        <tr>
            <th colspan="5">
                The best alliances (off)
                <div id="submenu">
                    <a title="Top 10" href="statistiken.php?id=43">
                        <img class="btn_top10" src="img/x.gif" alt="Top 10" />
                    </a>
                    <a title="defender" href="statistiken.php?id=42">
                        <img class="btn_def" src="img/x.gif" alt="defender" />
                    </a>
                    <a title="attacker" href="statistiken.php?id=41">
                        <img class="active btn_off" src="img/x.gif" alt="attacker" />
                    </a>
                </div>
            </th>
        </tr>
        <tr>
            <td></td>
            <td>Alliance</td>
            <td>Player</td>
            <td>Points</td>
        </tr>
    </thead>

    <tbody>
    <?php
    // EXACT ca original (doar fallback dacă lipsește obiectul)
    $rankArray = isset($ranking) ? $ranking->getRank() : array();

    if(isset($_GET['rank'])){
        $multiplier = 1;

        if(is_numeric($_GET['rank'])) {

            if($_GET['rank'] > count($rankArray)) {
                $_GET['rank'] = count($rankArray) - 1;
            }

            while($_GET['rank'] > (20 * $multiplier)) {
                $multiplier++;
            }

            $start = 20 * $multiplier - 19;

        } else {
            $start = (isset($_SESSION['start']) ? (int)$_SESSION['start'] : 0) + 1;
        }

    } else {
        $start = (isset($_SESSION['start']) ? (int)$_SESSION['start'] : 0) + 1;
    }

    if(count($rankArray) > 1) {

        for($i = $start; $i < $start + 20; $i++) {

            if(isset($rankArray[$i]['name']) && $rankArray[$i] != "pad") {

                if($i == $search) {
                    echo '<tr class="hl"><td class="ra fc">';
                } else {
                    echo '<tr><td class="ra">';
                }

                echo $i . '.</td>';

                echo '<td class="al">';
                echo '<a href="allianz.php?aid=' . (int)$rankArray[$i]['id'] . '">';
                echo htmlspecialchars($rankArray[$i]['tag'], ENT_QUOTES, 'UTF-8');
                echo '</a></td>';

                echo '<td class="pla">' . (int)$rankArray[$i]['players'] . '</td>';

                // Offensive points (Aap)
                echo '<td class="po">' . (int)$rankArray[$i]['Aap'] . '</td>';

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
// Include fallback safe
include("ranksearch.tpl");
?>