<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       heroes.tpl                                                  ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// ================= SEARCH VALIDATION =================
if (!isset($_SESSION['search']) || !is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                <?php echo TZ_THE_HERO; ?> <b>"<?php echo htmlspecialchars(isset($_SESSION['search']) ? $_SESSION['search'] : '', ENT_QUOTES, 'UTF-8'); ?>"</b> <?php echo TZ_DOES_NOT_EXIST; ?>
            </p>
        </font>
    </center>
<?php
    $search = 0;
} else {
    $search = (int)$_SESSION['search'];
}
?>

<table cellpadding="1" cellspacing="1" id="heroes" class="row_table_data">
    <thead>
        <tr>
            <th colspan="5"><?php echo TZ_THE_MOST_EXPERIENCED_HEROES; ?></th>
        </tr>
        <tr>
            <td></td>
            <td><?php echo U0; ?></td>
            <td><?php echo PLAYER; ?></td>
            <td><?php echo LEVEL; ?></td>
            <td><?php echo EXPERIENCE; ?></td>
        </tr>
    </thead>

    <tbody>
    <?php
    $rankArray = isset($ranking) ? $ranking->getRank() : array();

    // ================= PAGINATION (UNCHANGED LOGIC) =================
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

    // ================= RENDER =================
    if(count($rankArray) > 1) {

        for($i = $start; $i < $start + 20; $i++) {

            if(isset($rankArray[$i]['name']) && $rankArray[$i] != "pad") {

                // highlight searched
                if($i == $search) {
                    echo '<tr class="hl"><td class="ra fc">';
                } else {
                    echo '<tr><td class="ra">';
                }

                // index
                echo $i . '.</td>';

                // hero column
                $unit = (int)$rankArray[$i]['unit'];
                $heroName = htmlspecialchars($rankArray[$i]['name'], ENT_QUOTES, 'UTF-8');

                echo '<td class="hero">';
                echo '<img class="unit u'.$unit.'" alt="" title="" src="img/x.gif"> ';
                echo $heroName;
                echo '</td>';

                // player
                $uid = (int)$rankArray[$i]['uid'];
                $owner = htmlspecialchars($rankArray[$i]['owner'], ENT_QUOTES, 'UTF-8');

                echo '<td class="pla"><center><a href="spieler.php?uid='.$uid.'">'.$owner.'</a></center></td>';

                // level + xp
                echo '<td class="lev">'.(int)$rankArray[$i]['level'].'</td>';
                echo '<td class="xp">'.(int)$rankArray[$i]['experience'].'</td>';

                echo '</tr>';
            }
        }

    } else {
        echo '<tr><td class="none" colspan="5">No heros found</td></tr>';
    }
    ?>
    </tbody>
</table>

<?php
include("ranksearch.tpl");
?>