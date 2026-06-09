<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       player_attack.tpl                                           ##
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
                <?php echo TZ_THE_USER; ?> <b>"<?php echo htmlspecialchars(isset($_SESSION['search']) ? $_SESSION['search'] : '', ENT_QUOTES, 'UTF-8'); ?>"</b> <?php echo TZ_DOES_NOT_EXIST; ?>
            </p>
        </font>
    </center>
<?php
    $search = 0;
} else {
    $search = (int)$_SESSION['search'];
}
?>

<table cellpadding="1" cellspacing="1" id="player_off" class="row_table_data">
    <thead>
        <tr>
            <th colspan="5">
                <?php echo TZ_THE_MOST_SUCCESSFUL_ATTACKERS; ?>
                <div id="submenu">
                    <a title="<?php echo TZ_TOP_10; ?>" href="statistiken.php?id=7">
                        <img class="btn_top10" src="img/x.gif" alt="<?php echo TZ_TOP_10; ?>" />
                    </a>
                    <a title="<?php echo DEFENDER; ?>" href="statistiken.php?id=32">
                        <img class="btn_def" src="img/x.gif" alt="<?php echo DEFENDER; ?>" />
                    </a>
                    <a title="<?php echo ATTACKER; ?>" href="statistiken.php?id=31">
                        <img class="active btn_off" src="img/x.gif" alt="<?php echo ATTACKER; ?>" />
                    </a>
                </div>
            </th>
        </tr>
        <tr>
            <td></td>
            <td><?php echo PLAYER; ?></td>
            <td><?php echo POP; ?></td>
            <td><?php echo VILLAGES; ?></td>
            <td><?php echo POINTS; ?></td>
        </tr>
    </thead>

    <tbody>
    <?php
    // EXACT ca original (fallback safe)
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

            if(isset($rankArray[$i]['username']) && $rankArray[$i] != "pad") {

                if($i == $search) {
                    echo '<tr class="hl"><td class="ra fc">';
                } else {
                    echo '<tr><td class="ra">';
                }

                echo $i . '.</td>';

                echo '<td class="pla">';

                // Player link + underline dacă acces > 2
                $uid = (int)$rankArray[$i]['id'];
                $username = htmlspecialchars($rankArray[$i]['username'], ENT_QUOTES, 'UTF-8');

                if(isset($rankArray[$i]['access']) && $rankArray[$i]['access'] > 2) {
                    echo '<u><a href="spieler.php?uid='.$uid.'">'.$username.'</a></u>';
                } else {
                    echo '<a href="spieler.php?uid='.$uid.'">'.$username.'</a>';
                }

                echo '</td>';

                echo '<td class="pop">' . (int)$rankArray[$i]['totalpop'] . '</td>';
                echo '<td class="vil">' . (int)$rankArray[$i]['totalvillages'] . '</td>';
                echo '<td class="po">' . (int)$rankArray[$i]['apall'] . '</td>';

                echo '</tr>';
            }
        }

    } else {
        echo '<tr><td class="none" colspan="5">No users found</td></tr>';
    }
    ?>
    </tbody>
</table>

<?php
// IMPORTANT: exact ca original
include("ranksearch.tpl");
?>