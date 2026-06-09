<?php
#################################################################################
##  SAFE INCREMENTAL REFATOR - Messages Module                                ##
##  Credits: optimized structure, same logic preserved                        ##
##  Compatibility: PHP 5.6+ / PHP 7+                                          ##
#################################################################################

?>

<div id="content" class="messages">
    <h1><?php echo MESSAGES; ?></h1>

    <?php include("menu.tpl"); ?>

    <form method="post" action="nachrichten.php" name="msg">
        <table cellpadding="1" cellspacing="1" id="overview">

            <thead>
            <tr>
                <th colspan="2"><?php echo SUBJECT; ?></th>
                <th><?php echo SENDER; ?></th>
                <th class="sent">
                    <a href="nachrichten.php?o=1"><?php echo SENT; ?></a>
                </th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>

                    <?php
                    // ======================================================
                    // GET USER PLUS STATUS (same logic, single query)
                    // ======================================================
                    $userId = (int)$session->uid;

                    $MyGold = mysqli_query(
                        $database->dblink,
                        "SELECT plus FROM " . TB_PREFIX . "users WHERE id = '$userId' LIMIT 1"
                    ) or die(mysqli_error($database->dblink));

                    $golds = mysqli_fetch_array($MyGold);
                    $date2 = strtotime("NOW");

                    // Show checkbox only if plus active
                    if ($golds['plus'] > $date2) {
                        ?>
                        <input class="check" type="checkbox" id="s10" name="s10" onclick="Allmsg(this.form);" />
                        <?php
                    }
                    ?>

                </th>

                <th colspan="2" class="buttons">
                    <button name="delmsg" value="delete" id="btn_delete" class="trav_buttons"><?php echo DELETE; ?></button>

                    <?php
                    // Archive only for PLUS users
                    if ($session->plus) {
                        echo '<button name="archive" value="Archive" id="btn_archiv" class="trav_buttons">'.ARCHIVE.'</button>';
                    }
                    ?>

                    <input name="ft" value="m3" type="hidden" />
                </th>

                <th class="navi">
                    <?php
                    // ======================================================
                    // PAGINATION (UNCHANGED LOGIC, SIMPLIFIED READABILITY)
                    // ======================================================
                    $total = count($message->inbox1);
                    $s = isset($_GET['s']) ? (int)$_GET['s'] : 0;

                    $tParam = !empty($_GET['t']) ? 't=' . $_GET['t'] . '&' : '';

                    if (!isset($_GET['s']) && $total < 10) {
                        echo "&laquo;&raquo;";
                    } elseif (!isset($_GET['s']) && $total > 10) {
                        echo "&laquo;<a href=\"?" . $tParam . "s=10&o=0\">&raquo;</a>";
                    } elseif (isset($_GET['s']) && $total > $_GET['s']) {

                        if ($total > ($_GET['s'] + 10) && $_GET['s'] - 10 < $total && $_GET['s'] != 0) {
                            echo "<a href=\"?" . $tParam . "s=" . ($_GET['s'] - 10) . "&o=0\">&laquo;</a>
                                  <a href=\"?" . $tParam . "s=" . ($_GET['s'] + 10) . "&o=0\">&raquo;</a>";

                        } elseif ($total > $_GET['s'] + 10) {
                            echo "&laquo;<a href=\"?" . $tParam . "s=" . ($_GET['s'] + 10) . "&o=0\">&raquo;</a>";

                        } elseif ($total > 10) {
                            echo "<a href=\"?" . $tParam . "s=" . ($_GET['s'] - 10) . "&o=0\">&laquo;</a>&raquo;";
                        }
                    }
                    ?>
                </th>

            </tr>
            </tfoot>

            <tbody>

            <style>
                tr.multihunterMsg td.sel {
                    background-color: orange;
                }
            </style>

            <?php
            // ======================================================
            // MESSAGE LISTING
            // ======================================================

            $s = isset($_GET['s']) ? (int)$_GET['s'] : 0;
            $name = 1;

            $support_messages = ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES);
            $multihunter_messages = ($session->access == MULTIHUNTER);

            // cache usernames (REDUCE SQL LOAD)
            $userCache = [];

            $totalMessages = count($message->inbox1);

            for ($i = (1 + $s); $i <= (10 + $s); $i++) {

                if ($totalMessages >= $i) {

                    $msg = $message->inbox1[$i - 1];

                    // row class logic (UNCHANGED)
                    if ($msg['owner'] <= 1) {
                        echo "<tr class=\"sup\">";
                    } elseif ($msg['owner'] == 5) {
                        echo "<tr class=\"multihunterMsg\">";
                    } else {
                        echo "<tr>";
                    }

                    // ======================================================
                    // CHECKBOX / SUPPORT / MULTIHUNTER LOGIC (UNCHANGED)
                    // ======================================================
                    $message_for_text = '';

                    if (
                        !$support_messages ||
                        ($support_messages && $msg['target'] != 1) ||
                        ($multihunter_messages && $msg['target'] != 5)
                    ) {
                        $message_for_text =
                            "<input class=\"check\" type=\"checkbox\" name=\"n" . $name . "\" value=\"" . $msg['id'] . "\" />";
                    } else if ($support_messages) {
                        $message_for_text = '<u><b title="'.MESS_FOR_SUP.'"><i>S</i></b></u>';
                    } else if ($multihunter_messages) {
                        $message_for_text = '<u><b title="'.MESS_FOR_MH.'"><i>M</i></b></u>';
                    }

                    echo "<td class=\"sel\">" . $message_for_text . "</td>";

                    // ======================================================
                    // SUBJECT
                    // ======================================================
                    echo "<td class=\"top\">
                            <a href=\"nachrichten.php?id=" . $msg['id'] . "\">" . $msg['topic'] . "</a>";

                    if ($msg['viewed'] == 0) {
                        echo " (new)";
                    }

                    echo "</td>";

                    // ======================================================
                    // SENDER (cached username to reduce SQL)
                    // ======================================================
                    $ownerId = (int)$msg['owner'];

                    if (!isset($userCache[$ownerId])) {
                        $userCache[$ownerId] = $database->getUserField($ownerId, 'username', 0);
                    }

                    $username = $userCache[$ownerId];

                    $date = $generator->procMtime($msg['time']);

                    if ($ownerId <= 1) {

                        echo "<td class=\"send\">
                                <a href=\"spieler.php?uid=1\"><u>" . $username . "</u></a>
                              </td>
                              <td class=\"dat\">" . $date[0] . " " . $date[1] . "</td>
                              </tr>";

                    } else {

                        $linkSender = ($ownerId != 2 && $ownerId != 4);

                        echo "<td class=\"send\">" .
                            ($linkSender ? "<a href=\"spieler.php?uid=$ownerId\">" : "<b>") .
                            $username .
                            ($linkSender ? "</a>" : "</b>") .
                            "</td>

                            <td class=\"dat\">" . $date[0] . " " . $date[1] . "</td>
                            </tr>";
                    }

                    $name++;
                }
            }

            // ======================================================
            // EMPTY STATE
            // ======================================================
            if ($totalMessages == 0) {
                echo "<td colspan=\"4\" class=\"none\">There are no messages available.</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </form>
</div>