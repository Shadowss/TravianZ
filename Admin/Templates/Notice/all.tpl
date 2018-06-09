<?php
$noticeClass =
["Scout Report",
    "Won as attacker without losses",
    "Won as attacker with losses",
    "Lost as attacker with losses",
    "Won as defender without losses",
    "Won as defender with losses",
    "Lost as defender with losses",
    "Lost as defender without losses",
    "Reinforcement arrived",
    "",
    "Wood Delivered",
    "Clay Delivered",
    "Iron Delivered",
    "Crop Delivered",
    "",
    "Won as defender without losses",
    "Won as defender with losses",
    "Lost as defender with losses",
    "Won scouting as attacker",
    "Lost scouting as attacker",
    "Won scouting as defender",
    "Lost scouting as defender",
    "Scout Report"];
?>
	<table cellpadding="1" cellspacing="1" id="overview"
		class="row_table_data">
		<thead>
			<tr>
				<th colspan="1">Subject:</th>
				<th class="sent"><a href="admin.php?p=report&s=0&amp;o=1">Sent</a></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="buttons">
            </th>
				<th class=navi>
                        <?php
                        if (! isset($_GET['s']) && count($rep1) < 10) {
                            echo "&laquo;&raquo;";
                        } else if (! isset($_GET['s']) && count($rep1) > 10) {
                            echo "&laquo;<a href=\"?p=report&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=10&o=0\">&raquo;</a>";
                        } else if (isset($_GET['s']) && count($rep1) > $_GET['s']) {
                            if (count($rep1) > ($_GET['s'] + 10) && $_GET['s'] - 10 < count($rep1) && $_GET['s'] != 0) {
                                echo "<a href=\"?p=report&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] - 10) . "&o=0\">&laquo;</a><a href=\"?p=report&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] + 10) . "&o=0\">&raquo;</a>";
                            } else if (count($rep1) > $_GET['s'] + 10) {
                                echo "&laquo;<a href=\"?p=report&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] + 10) . "&o=0\">&raquo;</a>";
                            } else {
                                echo "<a href=\"?p=report&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] - 10) . "&o=0\">&laquo;</a>&raquo;";
                            }
                        }
                        ?>
     	</th>
			</tr>
		</tfoot>
		<tbody>
<?php

if (isset($_GET['s'])) $s = $_GET['s'];  
else $s = 0;

for ($i = (1 + $s); $i <= (10 + $s); $i ++) {
    if (count($rep1) >= $i) {
        echo "<tr>
		<td class=\"sub\">";
        $type = $rep1[$i - 1]['ntype'];
        if($type == 23) $type = 22;
        if ($type >= 15 && $type <= 17) {
            $type -= 11;
            echo "<img src=\"img/x.gif\" class=\"iReport iReport$type\" alt=\"" . $noticeClass[$type] . "\" title=\"" . $noticeClass[$type] . "\" />";
        } else if ($type >= 18 && $type <= 22) {
            echo "<img src=\"../gpack/travian_default/img/scouts/$type.gif\" alt=\"" . $noticeClass[$type] . "\" title=\"" . $noticeClass[$type] . "\" />";
        } else {
            echo "<img src=\"img/x.gif\" class=\"iReport iReport$type\" alt=\"" . $noticeClass[$type] . "\" title=\"" . $noticeClass[$type] . "\" />";
        }
        echo "<div><a href=\"admin.php?p=report&bid=" . $rep1[$i - 1]['id'] . "\">" . $rep1[$i - 1]['topic'] . "</a> ";
        $date = $generator->procMtime($rep1[$i - 1]['time']);
        echo "</div></td><td class=\"dat\">" . $date[0] . " " . $date[1] . "</td></tr>";
    }
}
if (count($rep1) == 0) echo "<td colspan=\"2\" class=\"none\">There are no reports available.</td></tr>";
?>
</tbody>
</table>