<?php
$id = $_GET['did'];
if(isset($id))
{
	?>
	<br /><br />
	<table id="profile">
		<thead>
		<tr>
				<th colspan="3" class="on"><a href="#"><?php echo $village['name']; ?></a>'s Research Log</th>
			</tr>
			<tr>
				<td style="width: 12%">#</td>
				<td>Event</td>
				<td>Date</td>
			</tr>
		</thead>
			<?php
				$sql = "SELECT * FROM ".TB_PREFIX."tech_log WHERE wid = ".(int) $_GET['did']."";
				$result = mysqli_query($GLOBALS["link"], $sql);
				$j = 0;
				while($row = mysqli_fetch_assoc($result))
				{
					echo '
					<tr>
						<td>'.++$j.'</td>
						<td>'.$row['log'].'</td>
						<td style="white-space: nowrap">'.$row['date'].'</td>
					</tr>';
				}
			?>
		</thead>
	</table><?php
}
else
{
	include("404.tpl");
}
?>