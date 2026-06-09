<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       player_3.tpl                                                ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################
if (!is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                <?php echo TZ_THE_USER; ?> <b>"<?php echo htmlspecialchars($_SESSION['search'], ENT_QUOTES, 'UTF-8'); ?>"</b> <?php echo TZ_DOES_NOT_EXIST; ?>
            </p>
        </font>
    </center>
<?php
    $search = 0;
} else {
    $search = (int)$_SESSION['search'];
}

/** Rank data */
$rankArray = $ranking->getRank();
$totalRanks = is_array($rankArray) ? count($rankArray) : 0;

/** Pagination logic (kept identical behavior) */
if (isset($_GET['rank']) && is_numeric($_GET['rank'])) {
    $rankGet = (int)$_GET['rank'];

    if ($rankGet > $totalRanks) {
        $rankGet = max(1, $totalRanks - 1);
    }

    $multiplier = 1;
    while ($rankGet > (20 * $multiplier)) {
        $multiplier++;
    }

    $start = (20 * $multiplier) - 19;
} else {
    $start = isset($_SESSION['start']) ? ((int)$_SESSION['start'] + 1) : 1;
}
?>

<table cellpadding="1" cellspacing="1" id="player">
    <thead>
        <tr>
            <th colspan="5">
                <?php echo TZ_THE_LARGEST_GAULS; ?>
                <div id="submenu">
                    <a title="<?php echo TZ_TOP_10; ?>" href="statistiken.php?id=7"><img class="btn_top10" src="img/x.gif" alt="<?php echo TZ_TOP_10; ?>" /></a>
                    <a title="<?php echo DEFENDER; ?>" href="statistiken.php?id=32"><img class="btn_def" src="img/x.gif" alt="<?php echo DEFENDER; ?>" /></a>
                    <a title="<?php echo ATTACKER; ?>" href="statistiken.php?id=31"><img class="btn_off" src="img/x.gif" alt="<?php echo ATTACKER; ?>" /></a>
                </div>
                <br>
                <div id="submenu2">
                    <a title="<?php echo TRIBE1; ?>" href="statistiken.php?id=11"><img class="btn_v1" src="img/x.gif" alt="<?php echo ATTACKER; ?>"></a>
                    <a title="<?php echo TRIBE2; ?>" href="statistiken.php?id=12"><img class="btn_v2" src="img/x.gif" alt="<?php echo ATTACKER; ?>"></a>
                    <a title="<?php echo TRIBE3; ?>" href="statistiken.php?id=13"><img class="active btn_v3" src="img/x.gif" alt="<?php echo ATTACKER; ?>"></a>
                </div>
            </th>
        </tr>
        <tr>
            <td></td><td><?php echo PLAYER; ?></td><td><?php echo ALLIANCE; ?></td><td><?php echo POP; ?></td><td><?php echo VILLAGES; ?></td>
        </tr>
    </thead>

    <tbody>
<?php
if ($totalRanks > 0) {

    $end = $start + 20;

    for ($i = $start; $i < $end; $i++) {

        if (!isset($rankArray[$i]) || $rankArray[$i] === "pad") {
            continue;
        }

        $row = $rankArray[$i];

        $uid  = (int)$row['userid'];
        $rank = (int)$i;

        $username = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
        $aname    = htmlspecialchars($row['aname'], ENT_QUOTES, 'UTF-8');

        $highlight = ($i == $search) ? " class=\"hl\"" : "";

        echo "<tr{$highlight}>";

        echo "<td class=\"ra fc\">{$rank}.</td>";

        // Player
        echo "<td class=\"pla\">";
        if (!empty($row['access']) && (int)$row['access'] > 2) {
            echo "<u><a href=\"spieler.php?uid={$uid}\">{$username}</a></u>";
        } else {
            echo "<a href=\"spieler.php?uid={$uid}\">{$username}</a>";
        }
        echo "</td>";

        // Alliance
        echo "<td class=\"al\">";
        if (!empty($row['alliance']) && (int)$row['alliance'] > 0) {
            echo "<a href=\"allianz.php?aid=".(int)$row['alliance']."\">{$aname}</a>";
        } else {
            echo "-";
        }
        echo "</td>";

        echo "<td class=\"pop\">".(int)$row['totalpop']."</td>";
        echo "<td class=\"vil\">".(int)$row['totalvillage']."</td>";

        echo "</tr>";
    }

} else {
    echo "<tr><td class=\"none\" colspan=\"5\">No users found</td></tr>";
}
?>
    </tbody>
</table>

<?php include("ranksearch.tpl"); ?>