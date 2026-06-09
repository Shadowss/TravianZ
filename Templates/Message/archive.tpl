<?php
#################################################################################
##  SAFE INCREMENTAL REFATOR - Archive Messages                                ##
##  Credits: optimized structure, same logic preserved                         ##
##  Compatibility: PHP 5.6+ / PHP 7+                                           ##
#################################################################################
?>

<div id="content" class="messages">
    <h1><?php echo MESSAGES; ?></h1>

    <?php include("menu.tpl"); ?>

    <form method="post" action="nachrichten.php" name="msg">
        <input type="hidden" name="ft" value="m5" />

        <table cellpadding="1" cellspacing="1" id="overview">

            <thead>
            <tr>
                <th colspan="2"><?php echo SUBJECT; ?></th>
                <th><?php echo SENDER; ?></th>
                <th class="sent">
                    <a href="nachrichten.php?s=0&amp;t=3&amp;o=1"><?php echo SENT; ?></a>
                </th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>
                    <input class="check" type="checkbox" id="s10" name="s10" onclick="Allmsg(this.form);" />
                </th>

                <th colspan="2" class="buttons">
                    <button name="delmsg" value="delete" id="btn_delete" class="trav_buttons"><?php echo DELETE; ?></button>
                    <button name="start" value="Back" id="btn_back" class="trav_buttons"><?php echo BACK; ?></button>
                </th>

                <th class="navi">
                    <?php
                    // ======================================================
                    // PAGINATION (same logic, cleaned)
                    // ======================================================
                    $total = count($message->archived1);
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

            <?php
            // ======================================================
            // MESSAGE LIST
            // ======================================================
            $s = isset($_GET['s']) ? (int)$_GET['s'] : 0;
            $name = 1;

            // cache username (important pentru performanță)
            $userCache = [];

            $totalMessages = count($message->archived1);

            for ($i = (1 + $s); $i <= (10 + $s); $i++) {

                if ($totalMessages >= $i) {

                    // ATENȚIE: păstrăm exact structura originală (archived vs archived1)
                    $msg = $message->archived[$i - 1];

                    // row class (logică originală)
                    if ($msg['owner'] == 0) {
                        echo "<tr class=\"sup\">";
                    } else {
                        echo "<tr>";
                    }

                    // ======================================================
                    // CHECKBOX
                    // ======================================================
                    echo "<td class=\"sel\">
                            <input class=\"check\" type=\"checkbox\" name=\"n" . $name . "\" value=\"" . $msg['id'] . "\" />
                          </td>";

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
                    // USERNAME (cached)
                    // ======================================================
                    $ownerId = (int)$msg['owner'];

                    if (!isset($userCache[$ownerId])) {
                        $userCache[$ownerId] = $database->getUserField($ownerId, 'username', 0);
                    }

                    $username = $userCache[$ownerId];

                    // ======================================================
                    // DATE
                    // ======================================================
                    $date = $generator->procMtime($msg['time']);

                    echo "<td class=\"send\">
                            <a href=\"spieler.php?uid=" . $ownerId . "\"><u>" . $username . "</u></a>
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
                echo "<td colspan=\"4\" class=\"none\">There are no messages available in the archive.</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </form>
</div>