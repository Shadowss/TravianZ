<div id="content"  class="messages">
    <h1>Messages</h1>
    <?php
    include("menu.tpl");
    ?>
    <form method="post" action="nachrichten.php" name="msg" ><table cellpadding="1" cellspacing="1" id="overview">
	<thead>
	    <tr>
		<th colspan="2">Subject</th>
		<th>Sender</th>
		<th class="sent"><a href="nachrichten.php?o=1">Sent</a></th>
	    </tr></thead><tfoot><tr><th>
		<?php
		$MyGold = mysqli_query($database->dblink,"SELECT plus FROM ".TB_PREFIX."users WHERE `id`='".(int) $session->uid."'") or die(mysqli_error($database->dblink));
		$golds = mysqli_fetch_array($MyGold);
		$date2=strtotime("NOW");
		if ($golds['plus'] <= $date2) { ?>
		<?php } else { ?>
		<input class="check" type="checkbox" id="s10" name="s10" onclick="Allmsg(this.form);" />
		<?php } ?>
	    </th>
	    <th colspan="2" class="buttons">
		<button name="delmsg" value="delete" id="btn_delete" class="trav_buttons"> Delete </button>
		<?php if($session->plus) { echo "<button name=\"archive\" value=\"Archive\" id=\"btn_archiv\" class=\"trav_buttons\" alt=\"Archive\" /> Archive </button>"; } ?>
		<input name="ft" value="m3" type="hidden" />
	    </th><th class="navi"><?php
		if(!isset($_GET['s']) && count($message->inbox1) < 10) {
		echo "&laquo;&raquo;";
		}
		else if (!isset($_GET['s']) && count($message->inbox1) > 10) {
		echo "&laquo;<a href=\"?".(!empty($_GET['t']) ? 't='.$_GET['t'].'&amp;' : '')."s=10&o=".(!empty($_GET['o'])  )."\">&raquo;</a>";
		}
		else if(isset($_GET['s']) && count($message->inbox1) > $_GET['s']) {
    		if(count($message->inbox1) > ($_GET['s']+10) && $_GET['s']-10 < count($message->inbox1) && $_GET['s'] != 0) {
		echo "<a href=\"?".(!empty($_GET['t']) ? 't='.$_GET['t'].'&amp;' : '')."s=".($_GET['s']-10)."&o=0\">&laquo;</a><a href=\"?".(!empty($_GET['t']) ? 't='.$_GET['t'].'&amp;' : '')."s=".($_GET['s']+10)."&o=0\">&raquo;</a>";
		}
		else if(count($message->inbox1) > $_GET['s']+10) {
         	echo "&laquo;<a href=\"?".(!empty($_GET['t']) ? 't='.$_GET['t'].'&amp;' : '')."s=".($_GET['s']+10)."&o=0\">&raquo;</a>";
		}
		else if(count($message->inbox1) > 10) {
		    echo "<a href=\"?".(!empty($_GET['t']) ? 't='.$_GET['t'].'&amp;' : '')."s=".($_GET['s']-10)."&o=0\">&laquo;</a>&raquo;";
		}
		}
		?></th></tr></tfoot><tbody>
		<style>
		 tr.multihunterMsg td.sel{
		     background-color:orange;
		 }
		</style>
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
		if(count($message->inbox1) >= $i) {
		if($message->inbox1[$i-1]['owner'] <= 1)  {
		echo "<tr class=\"sup\">";
		    }elseif($message->inbox1[$i-1]['owner'] == 5){
		    echo "<tr class=\"multihunterMsg\">";
		    }
		    else {
		    echo "<tr>";
		    }

            $message_for_text = '';

            if (!$support_messages || ($support_messages && $message->inbox1[$i-1]['target'] != 1) || ($multihunter_messages && $message->inbox1[$i-1]['target'] != 5)) {
                $message_for_text = "<input class=\"check\" type=\"checkbox\" name=\"n".$name."\" value=\"".$message->inbox1[$i-1]['id']."\" />";
            } else if ($support_messages) {
                $message_for_text = '<u><b title="Message for Support"><i>S</i></b></u>';
            } else if ($multihunter_messages) {
                $message_for_text = '<u><b title="Message for Multihunter"><i>M</i></b></u>';
            }

		    echo "<td class=\"sel\">".$message_for_text."</td>
		    <td class=\"top\"><a href=\"nachrichten.php?id=".$message->inbox1[$i-1]['id']."\">".$message->inbox1[$i-1]['topic']."</a> ";
			if($message->inbox1[$i-1]['viewed'] == 0) {
			echo "(new)";
			}
			$date = $generator->procMtime($message->inbox1[$i-1]['time']);
			if($message->inbox1[$i-1]['owner'] <= 1) {
			echo "</td><td class=\"send\"><a href=\"spieler.php?uid=1\"><u>".$database->getUserField($message->inbox1[$i-1]['owner'],'username',0)."</u></a></td>
		    <td class=\"dat\">".$date[0]." ".$date[1]."</td></tr>";
		    }
		    else {
		    $linkSender = ($message->inbox1[$i-1]['owner'] != 2 && $message->inbox1[$i-1]['owner'] != 4);

		    echo "</td><td class=\"send\">".($linkSender ? "<a href=\"spieler.php?uid=".$message->inbox1[$i-1]['owner']."\">" : '<b>').$database->getUserField($message->inbox1[$i-1]['owner'],'username',0).($linkSender ? '</a>' : '</b>')."</td>

		    <td class=\"dat\">".$date[0]." ".$date[1]."</td></tr>";
		    }
		    }
		    $name++;
		    }
		    if(count($message->inbox1) == 0) {
		    echo "<td colspan=\"4\" class=\"none\">There are no messages available.</td></tr>";
		    }
		    ?>
		</tbody></table>
    </form>
</div>
