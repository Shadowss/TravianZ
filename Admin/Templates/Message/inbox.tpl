
<table cellpadding="1" cellspacing="1" id="overview">
	<thead>
		<tr>
			<th colspan="2">Subject</th>
			<th>Sender</th>
			<th class="sent"><a href="nachrichten.php?o=1">Sent</a></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th colspan="3" class="buttons"></th>
			<th class="navi"><?php
if (! isset($_GET['s']) && count($allMessages) < 10) {
    echo "&laquo;&raquo;";
} else if (! isset($_GET['s']) && count($allMessages) > 10) {
    echo "&laquo;<a href=\"?p=msg&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=10&o=" . (!empty($_GET['o']) ? $_GET['o'] : 0) . "\">&raquo;</a>";
} else if (isset($_GET['s']) && count($allMessages) > $_GET['s']) {
    if (count($allMessages) > ($_GET['s'] + 10) && $_GET['s'] - 10 < count($allMessages) && $_GET['s'] != 0) {
        echo "<a href=\"?p=msg&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] - 10) . "&o=0\">&laquo;</a><a href=\"?p=msg&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] + 10) . "&o=0\">&raquo;</a>";
    } else if (count($allMessages) > $_GET['s'] + 10) {
        echo "&laquo;<a href=\"?p=msg&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] + 10) . "&o=0\">&raquo;</a>";
    } else if (count($allMessages) > 10) {
        echo "<a href=\"?p=msg&" . (! empty($_GET['t']) ? 't=' . $_GET['t'] . '&amp;' : '') . "s=" . ($_GET['s'] - 10) . "&o=0\">&laquo;</a>&raquo;";
    }
}
?></th>
		</tr>
	</tfoot>
	<tbody>
	
<style>
tr.multihunterMsg td.sel {
	background-color: orange;
}
</style>
<?php
if (isset($_GET['s'])) $s = $_GET['s'];
else $s = 0;

for ($i = (1 + $s); $i <= (10 + $s); $i ++) {
    if (count($allMessages) >= $i) {
        if ($allMessages[$i - 1]['owner'] <= 1) echo "<tr class=\"sup\">";    
        elseif ($allMessages[$i - 1]['owner'] == 5)  echo "<tr class=\"multihunterMsg\">";
        else echo "<tr>";
        
        echo "<td class=\"top\" colspan=\"2\"><a href=\"admin.php?p=msg&nid=" . $allMessages[$i - 1]['id'] . "\">" . $allMessages[$i - 1]['topic'] . "</a> ";
        
        $date = $generator->procMtime($allMessages[$i - 1]['time']);
        if ($allMessages[$i - 1]['owner'] <= 1) {
            echo "</td><td class=\"send\"><a href=\"admin.php?p=player&uid=1\"><u>" . $database->getUserField($allMessages[$i - 1]['owner'], 'username', 0) . "</u></a></td>
		    <td class=\"dat\">" . $date[0] . " " . $date[1] . "</td></tr>";
        } else {
            $linkSender = ($allMessages[$i - 1]['owner'] != 2 && $allMessages[$i - 1]['owner'] != 4);
            
            echo "</td><td class=\"send\">" . ($linkSender ? "<a href=\"admin.php?p=player&uid=" . $allMessages[$i - 1]['owner'] . "\">" : '<b>') . $database->getUserField($allMessages[$i - 1]['owner'], 'username', 0) . ($linkSender ? '</a>' : '</b>') . "</td>

		    <td class=\"dat\">" . $date[0] . " " . $date[1] . "</td></tr>";
        }
    }
}
if (count($allMessages) == 0) {
    echo "<td colspan=\"4\" class=\"none\">There are no messages available.</td></tr>";
}
?>
		</tbody>
</table>
</div>