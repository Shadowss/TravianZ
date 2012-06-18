<?php
$log = $database->getUser_log($_GET['log_login']);
?>
<table cellpadding="1" cellspacing="1" id="player">
	<thead>
				<tr>
					<th colspan="10">User id <?php echo $_GET['log_login'];?> login log</th>
				</tr>
		<tr><td></td><td>Player</td><td>IP</td><td>Time</td><td></td></tr>
		</thead><tbody>
		<?php

		if(count($log)>0) {
		for ($i = 0; $i < count($log); $i++) {

		//$del = '<td class="vil"><a href="?delete='.$log[$i]['id'].'&where=login_log"><img src="img/x.gif" class="del" title="cancel" alt="cancel"></a></td>';
		if(!$del){$del = '<td></td>';}
					  $id = $i+1;
					echo "<tr><td class=\"ra \" >".$id.".</td>";
					echo "<td><a href=\"?uid=".$log[$i]['id']."\">".$database->getUserField($log[$i]['uid'],'username',0)."</a></td>";
					echo "<td>".$log[$i]['ip']."</td>";
					echo "<td>".date("d.m.y H:i:s",$log[$i]['time'])."</td>";
					echo $del;
					echo "</tr>";
			  }

		}
				else {
			echo "<tr><td class=\"none\" colspan=\"7\">No logs</td></tr>";
		}

		?>
 </tbody>
</table>

