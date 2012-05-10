<?php
$id = $_GET['uid'];
if(isset($id))
{
	$player = mysql_fetch_assoc(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = $id"));
	?>
	<table cellpadding="1" cellspacing="1" id="member">
		<thead>
			<tr>
				<th colspan="10"><a href="admin.php?p=player&uid=<?php echo $player['id']; ?>"><?php echo $player['username']; ?></a> Login Log</th>
			</tr>
			<tr>
				<td>Login Attempt</td>
				<td>ID</td>
				<td>IP</td>
			</tr>
		</thead>
		<tbody>  
			<?php
				$sql = "SELECT * FROM ".TB_PREFIX."login_log WHERE uid = $id";
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result))
				{
					$i++;
					echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['id'].'</td>
						<td>'.$row['ip'].'</td>
					</tr>';
				}
			?>
		</tbody>
	</table><?php
}
else
{
	include("404.tpl");
}
?>