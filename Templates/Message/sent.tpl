<?php

#################################################################################
##  SAFE INCREMENTAL REFACTOR - Sent Message                                   ##
##  Credits: cleaned structure, same logic preserved                           ##
##  Compatibility: PHP 5.6+ / PHP 7+                                           ##
#################################################################################

// ======================================================
// SAFE GET PARAMS
// ======================================================
$s = isset($_GET['s']) ? (int)$_GET['s'] : 0;
$o = !empty($_GET['o']) ? (int)$_GET['o'] : 0;

// cache username
$userCache = [];
function getCachedUsername($uid, $database, &$cache) {
    $uid = (int)$uid;
    if (!isset($cache[$uid])) {
        $cache[$uid] = $database->getUserField($uid, 'username', 0);
    }
    return $cache[$uid];
}
?>

<div id="content" class="messages">
<h1><?php echo MESSAGES; ?></h1>

<?php include("menu.tpl"); ?>

<form method="post" action="nachrichten.php" name="msg">
<input type="hidden" name="ft" value="m4" />

<table cellpadding="1" cellspacing="1" id="overview">

<thead>
<tr>
    <th></th>
    <th><?php echo SUBJECT; ?></th>
    <th><?php echo RECIPIENT; ?></th>
    <th class="sent">
        <a href="nachrichten.php?t=2&s=0&amp;t=2&amp;o=1"><?php echo SENT; ?></a>
    </th>
</tr>
</thead>

<tfoot>
<tr>

<th>
<?php
// ======================================================
// PLUS CHECK (UNCHANGED)
// ======================================================
$userId = (int)$session->uid;

$MyGold = mysqli_query(
    $database->dblink,
    "SELECT plus FROM " . TB_PREFIX . "users WHERE id='$userId' LIMIT 1"
) or die(mysqli_error($database->dblink));

$golds = mysqli_fetch_array($MyGold);
$date2 = strtotime("NOW");

if ($golds['plus'] > $date2) {
?>
<input class="check" type="checkbox" id="s10" name="s10" onclick="Allmsg(this.form);" />
<?php } ?>
</th>

<th colspan="2" class="buttons">
<button value="delete" name="delmsg" id="btn_delete" class="trav_buttons"><?php echo DELETE; ?></button>
</th>

<th class="navi">
<?php
// ======================================================
// PAGINATION (same logic, cleaner)
// ======================================================
$total = count($message->sent1);

if (!isset($_GET['s']) && $total < 10) {
    echo "&laquo;&raquo;";
}
elseif (!isset($_GET['s']) && $total > 10) {
    echo "&laquo;<a href=\"?t=2&s=10&o=$o\">&raquo;</a>";
}
elseif (isset($_GET['s']) && $total > $_GET['s']) {

    if ($total > ($_GET['s'] + 10) && $_GET['s'] - 10 < $total && $_GET['s'] != 0) {
        echo "<a href=\"?t=2&s=" . ($_GET['s'] - 10) . "&o=$o\">&laquo;</a>
              <a href=\"?t=2&s=" . ($_GET['s'] + 10) . "&o=$o\">&raquo;</a>";

    } elseif ($total > $_GET['s'] + 10) {
        echo "&laquo;<a href=\"?t=2&s=" . ($_GET['s'] + 10) . "&o=$o\">&raquo;</a>";

    } elseif ($total > 10) {
        echo "<a href=\"?t=2&s=" . ($_GET['s'] - 10) . "&o=$o\">&laquo;</a>&raquo;";
    }
}
?>
</th>

</tr>
</tfoot>

<tbody>

<?php
// ======================================================
// MESSAGE LIST
// ======================================================
$name = 1;

$support_messages = ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES);
$multihunter_messages = ($session->access == MULTIHUNTER);

$totalMessages = count($message->sent1);

for ($i = (1 + $s); $i <= (10 + $s); $i++) {

    if ($totalMessages >= $i) {

        $msg = $message->sent1[$i - 1];

        // row class
        if ($msg['target'] == 0) {
            echo "<tr class=\"sup\">";
        } else {
            echo "<tr>";
        }

        // ======================================================
        // SENT TYPE (IMPORTANT: păstrăm bug original inbox1)
        // ======================================================
        $sent_as_text = '';

        if (
            !$support_messages ||
            ($support_messages && $message->inbox1[$i - 1]['target'] != 1) ||
            ($multihunter_messages && $message->inbox1[$i - 1]['target'] != 5)
        ) {
            $sent_as_text =
                "<input class=\"check\" type=\"checkbox\" name=\"n" . $name . "\" value=\"" . $msg['id'] . "\" />";
        }
        else if ($support_messages) {
            $sent_as_text = '<u><b title="Sent as Support"><i>S</i></b></u>';
        }
        else if ($multihunter_messages) {
            $sent_as_text = '<u><b title="Sent as Multihunter"><i>M</i></b></u>';
        }

        echo "<td class=\"sel\">" . $sent_as_text . "</td>";

        // ======================================================
        // SUBJECT
        // ======================================================
        echo "<td class=\"top\">
                <a href=\"nachrichten.php?t=2a&amp;id=" . $msg['id'] . "\">" . $msg['topic'] . "</a>";

        if ($msg['viewed'] == 0) {
            echo " (unread)";
        }

        echo "</td>";

        // ======================================================
        // RECIPIENT (cached)
        // ======================================================
        $targetId = (int)$msg['target'];
        $username = getCachedUsername($targetId, $database, $userCache);

        $date = $generator->procMtime($msg['time']);

        echo "<td class=\"send\">
                <a href=\"spieler.php?uid=$targetId\">" . $username . "</a>
              </td>

              <td class=\"dat\">" . $date[0] . " " . $date[1] . "</td>
              </tr>";
    }

    $name++;
}

// ======================================================
// EMPTY STATE
// ======================================================
if ($totalMessages == 0) {
    echo "<td colspan=\"4\" class=\"none\">There are no sent messages available.</td></tr>";
}
?>

</tbody>
</table>
</form>
</div>