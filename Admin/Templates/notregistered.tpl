<table cellpadding="1" cellspacing="1" id="member">
	<thead>
		<tr>
			<th colspan="10">Players Not Activated</th>
		</tr>
		<tr>
			<td class="on">#</td>
			<td class="on">ID</td>
			<td class="on">Username</td>
			<td class="on">Email</td>
			<td class="on">Tribe</td>
			<td class="on">Activation Code</td>
			<td class="on">Act 2??</td>
			<td class="on">Time</td>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql = "SELECT * FROM ".TB_PREFIX."activate";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result))
			{
				$i++;
				if($row['tribe'] == 1) {$tribe = "Roman"; }
				elseif($row['tribe'] == 2) {$tribe = "Teuton"; }
				elseif($row['tribe'] == 3) {$tribe = "Gaul"; }
				echo "
				<tr>
					<td>".$i."</td>
					<td>".$row['id']."</td>
					<td>".$row['username']."</td>
					<td><a href=\"mailto:".$row['email']."\">".$row['email']."</a></td>
					<td>".$tribe."</td>
					<td>".$row['act']."</td>
					<td>".$row['act2']."</td>
					<td class=\"hab\">".date('d:m:Y H:i', $row['timestamp'])."</td>
				</tr>";
			}
		?>
	</tbody>
</table>