<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       overview.tpl                                                ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

$search = 0;

// ------------------------- SEARCH VALIDATION -------------------------
if (!isset($_SESSION['search']) || !is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                The user <b>"<?php echo htmlspecialchars($_SESSION['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"</b> does not exist.
            </p>
        </font>
    </center>
<?php
    $search = 0;
} else {
    $search = (int)$_SESSION['search'];
}
?>

<table cellpadding="1" cellspacing="1" id="player">
    <thead>
        <tr>
            <th colspan="5">
                The largest players

                <div id="submenu">
                    <a title="Top 10" href="statistiken.php?id=7">
                        <img class="btn_top10" src="img/x.gif" alt="Top 10" />
                    </a>
                    <a title="defender" href="statistiken.php?id=32">
                        <img class="btn_def" src="img/x.gif" alt="defender" />
                    </a>
                    <a title="attacker" href="statistiken.php?id=31">
                        <img class="btn_off" src="img/x.gif" alt="attacker" />
                    </a>
                </div>

                <br>

                <div id="submenu2">
                    <a title="Romans" href="statistiken.php?id=11">
                        <img class="btn_v1" src="img/x.gif" alt="Romans">
                    </a>
                    <a title="Teutons" href="statistiken.php?id=12">
                        <img class="btn_v2" src="img/x.gif" alt="Teutons">
                    </a>
                    <a title="Gauls" href="statistiken.php?id=13">
                        <img class="btn_v3" src="img/x.gif" alt="Gauls">
                    </a>
                </div>

            </th>
        </tr>

        <tr>
            <td></td>
            <td>Player</td>
            <td>Alliance</td>
            <td>Population</td>
            <td>Villages</td>
        </tr>
    </thead>

    <tbody>
<?php
$rankArray = $ranking->getRank();

// ------------------------- PAGINATION SAFE -------------------------
if (isset($_GET['rank']) && is_numeric($_GET['rank'])) {

    $rank = (int)$_GET['rank'];
    $count = count($rankArray);

    if ($rank > $count) {
        $rank = max(1, $count - 1);
    }

    $multiplier = 1;
    while ($rank > (20 * $multiplier)) {
        $multiplier++;
    }

    $start = 20 * $multiplier - 19;

} else {
    $start = ($_SESSION['start'] ?? 0) + 1;
}

// ------------------------- RENDER -------------------------
if (count($rankArray) > 1) {

    for ($i = $start; $i < $start + 20; $i++) {

        if (!isset($rankArray[$i]['username'])) {
            continue;
        }

        $row = $rankArray[$i];

        $isHighlight = ($i == $search);

        echo $isHighlight
            ? "<tr class=\"hl\"><td class=\"ra fc\">"
            : "<tr><td class=\"ra \">";

        echo $i . ".</td>";

        // ---------------- PLAYER ----------------
        echo "<td class=\"pla\">";

        $uid = (int)($row['userid'] ?? 0);
        $username = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');

        if (!empty($row['access']) && $row['access'] > 2) {
            echo "<u><a href=\"spieler.php?uid={$uid}\">{$username}</a></u>";
        } else {
            echo "<a href=\"spieler.php?uid={$uid}\">{$username}</a>";
        }

        echo "</td>";

        // ---------------- ALLIANCE ----------------
        echo "<td class=\"al\">";

        if (!empty($row['aname']) && !empty($row['alliance'])) {
            $aid = (int)$row['alliance'];
            $aname = htmlspecialchars($row['aname'], ENT_QUOTES, 'UTF-8');
            echo "<a href=\"allianz.php?aid={$aid}\">{$aname}</a>";
        } else {
            echo "-";
        }

        echo "</td>";

        // ---------------- POP ----------------
        echo "<td class=\"pop\">" . (int)($row['totalpop'] ?? 0) . "</td>";

        // ---------------- VILLAGES ----------------
        echo "<td class=\"vil\">" . (int)($row['totalvillage'] ?? 0) . "</td>";

        echo "</tr>";
    }

} else {
    echo "<tr><td class=\"none\" colspan=\"5\">No users found</td></tr>";
}
?>
    </tbody>
</table>

<?php include("ranksearch.tpl"); ?>