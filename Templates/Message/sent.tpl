<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/

?>
<div id="content"  class="messages">
    <h1>Messages</h1>
        <?php include("menu.tpl"); ?>
    <form method="post" action="nachrichten.php" name="msg">
    <input type="hidden" name="ft" value="m4" />
    <table cellpadding="1" cellspacing="1" id="overview">
        <thead><tr>
            <th></th>
            <th>Subject</th>
            <th>Recipient</th>
            <th class="sent"><a href="nachrichten.php?t=2&s=0&amp;t=2&amp;o=1">Sent</a></th>
            </tr></thead><tfoot><tr><th><?php
		$MyGold = mysqli_query($GLOBALS['link'],"SELECT plus FROM ".TB_PREFIX."users WHERE `id`='".(int) $session->uid."'") or die(mysqli_error($database->dblink));
		$golds = mysqli_fetch_array($MyGold);
		$date2=strtotime("NOW");
		if ($golds['plus'] <= $date2) { ?>
		<?php } else { ?>
		<input class="check" type="checkbox" id="s10" name="s10" onclick="Allmsg(this.form);" />
		<?php } ?></th>
	<th colspan="2" class="buttons"><input name="delmsg" value="delete" type="image" id="btn_delete" class="dynamic_img" src="img/x.gif" alt="delete" /></th><th class="navi"><?php
     if(!isset($_GET['s']) && count($message->sent1) < 10) {
    echo "&laquo;&raquo;";
    }
    else if (!isset($_GET['s']) && count($message->sent1) > 10) {
    echo "&laquo;<a href=\"?t=2&s=10&o=".(!empty($_GET['o']) ? $_GET['o'] : 0)."\">&raquo;</a>";
    }
    else if(isset($_GET['s']) && count($message->sent1) > $_GET['s']) {
    	if(count($message->sent1) > ($_GET['s']+10) && $_GET['s']-10 < count($message->sent1) && $_GET['s'] != 0) {
         echo "<a href=\"?t=2&s=".($_GET['s']-10)."&o=".(!empty($_GET['o']) ? $_GET['o'] : 0)."\">&laquo;</a><a href=\"?t=2&s=".($_GET['s']+10)."&o=".(!empty($_GET['o']) ? $_GET['o'] : 0)."\">&raquo;</a>";
         }
         else if(count($message->sent1) > $_GET['s']+10) {
         	echo "&laquo;<a href=\"?t=2&s=".($_GET['s']+10)."&o=".(!empty($_GET['o']) ? $_GET['o'] : 0)."\">&raquo;</a>";
         }
        else if (count($message->sent1) > 10) {
        echo "<a href=\"?t=2&s=".($_GET['s']-10)."&o=".(!empty($_GET['o']) ? $_GET['o'] : 0)."\">&laquo;</a>&raquo;";
        }
    }
    ?></th></tr></tfoot>
<tbody>
   <?php
    if(isset($_GET['s'])) {
    $s = $_GET['s'];
    }
    else {
    $s = 0;
    }
    $name = 1;
    $support_messages = ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES);
    $multihunter_messages = ($session->access == MULTIHUNTER);

    for($i=(1+$s);$i<=(10+$s);$i++) {
    if(count($message->sent1) >= $i) {
    if($message->sent1[$i-1]['target'] == 0) {
    echo "<tr class=\"sup\">";
    }
    else {
    echo "<tr>";
    }

    $sent_as_text = '';

    if (!$support_messages || ($support_messages && $message->inbox1[$i-1]['target'] != 1) || ($multihunter_messages && $message->inbox1[$i-1]['target'] != 5)) {
        $sent_as_text = "<input class=\"check\" type=\"checkbox\" name=\"n".$name."\" value=\"".$message->sent1[$i-1]['id']."\" />";
    } else if ($support_messages) {
        $sent_as_text = '<u><b title="Sent as Support"><i>S</i></b></u>';
    } else if ($multihunter_messages) {
        $sent_as_text = '<u><b title="Sent as Multihunter"><i>M</i></b></u>';
    }

    echo "<td class=\"sel\">".$sent_as_text."</td>
		<td class=\"top\"><a href=\"nachrichten.php?t=2a&amp;id=".$message->sent1[$i-1]['id']."\">".$message->sent1[$i-1]['topic']."</a> ";
    if($message->sent1[$i-1]['viewed'] == 0) {
    echo "(unread)";
    }
    $date = $generator->procMtime($message->sent1[$i-1]['time']);
    echo "</td><td class=\"send\"><a href=\"spieler.php?uid=".$message->sent1[$i-1]['target']."\">".$database->getUserField($message->sent1[$i-1]['target'],'username',0)."</a></td>
		<td class=\"dat\">".$date[0]." ".$date[1]."</td></tr>";
        }
        $name++;
    }
    if(count($message->sent1) == 0) {
    echo "<td colspan=\"4\" class=\"none\">There are no sent messages available.</td></tr>";
    }
    ?>
</tbody></table>
</form>
</div>
