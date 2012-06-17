<?php
$ranking->procRankReq($_GET);
$displayarray = $database->getUserArray($_GET['uid'],1);
$varray = $database->getProfileVillages($_GET['uid']);
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}
?>
<div id="content"  class="player" style="width:100%">
<table id="profile" cellpadding="1" cellspacing="1" >
	<thead>
	<tr>
		<th colspan="2">Player <?php echo $displayarray['username']; ?> </th>
	</tr>
	<tr>
		<td>Details</td>
		<td>Description</td>

	</tr>
	</thead><tbody>
	<tr>
		<td class="empty"></td><td class="empty"></td>
	</tr>
	<tr>
		<td class="details">
			<table cellpadding="0" cellspacing="0">
			<tr>

				<th>Rank</th>
				<td><?php echo $ranking->searchRank($displayarray['username'],"username"); ?></td>
			</tr>
			<tr>
				<th>Tribe</th>
				<td><?php
				if($displayarray['tribe'] == 1) {
				echo "Roman";
				}
				else if($displayarray['tribe'] == 2) {
				echo "Teutons";
				}
				else if($displayarray['tribe'] == 3) {
				echo "Gauls";
				} ?></td>
			</tr>

			<tr>
				<th>Alliance</th>
				<td><?php if($displayarray['alliance'] == 0) {
				echo "-";
				}
				else {
				$displayalliance = $database->getAllianceName($displayarray['alliance']);
				echo "<a href=\"?aid=".$displayarray['alliance']."\">".$displayalliance."</a>";
				} ?></td>
			</tr>
			<tr>
				<th>Villages</th>
				<td><?php echo count($varray);?></td>

			</tr>
			<tr>
				<th>Population</th>
				<td><?php echo $totalpop; ?></td>
			</tr>
			<?php
			if(isset($displayarray['birthday']) && $displayarray['birthday'] != 0) {
			$age = date("Y")-substr($displayarray['birthday'],0,4);
			echo "<tr><th>Age</th><td>$age</td></tr>";
			}
			if(isset($displayarray['gender']) && $displayarray['gender'] != 0) {
			$gender = ($displayarray['gender']== 1)? "Male" : "Female";
			echo "<tr><th>Gender</th><td>".$gender."</td></tr>";
			}
			if($displayarray['location'] != "") {
			echo "<tr><th>Location</th><td>".$displayarray['location']."</td></tr>";
			}
			?>
			<tr>
				<td colspan="2" class="empty"></td>
			</tr>
			<tr>
					<td colspan="2"> <a href="?edit=user&uid=<?php echo $_GET['uid'];?>">&raquo; Change profile</a></td>
			</tr>
			<tr>
					<td colspan="2"> <a href="?action=message&amp;id=<?php echo $_GET['uid'];?>">&raquo; Write message</a></td>
			</tr>
			<tr>
					<td colspan="2"> <a href="?uid=<?php echo $_GET['uid'];?>&delete=<?php echo $_GET['uid'];?>&where=user">&raquo; Delete player</a></td>
			</tr>
			<tr>
					<td colspan="2"> <a href="?log_login=<?php echo $_GET['uid'];?>">&raquo; Login Log</a></td>
			</tr>
			<tr>
							<td colspan="2" class="desc2">
								<div class="desc2div"><?php echo $displayarray['desc1']; ?></div>
							</td>
						</tr>
			</table>

		</td>
		<td class="desc1" >
<?php echo $displayarray['desc2']; ?>
		</td>

	</tr>
	</tbody>
</table>
<br>
<table cellpadding="1" cellspacing="1" id="villages">
	<thead>
	<tr>
		<th colspan="3">Villages</th>
	</tr>
	<tr>
		<td>Name</td>

		<td>Inhabitants</td>
		<td>Coordinates</td>
	</tr>
	</thead><tbody>
	<?php
	if(count($varray)>0){
	foreach($varray as $vil) {

		$coor = $database->getCoor($vil['wref']);
		echo "<tr><td class=\"nam\"><a href=\"?wref=".$vil['wref']."\">".$vil['name']."</a>";
		if($vil['capital'] == 1) {
		echo "<span class=\"none3\"> (capital)</span>";
		}
		echo "</td>";
		echo "<td class=\"hab\">".$vil['pop']."</td><td class=\"aligned_coords\">";
		echo "<div class=\"cox\">(".$coor['x']."</div><div class=\"pi\">|</div><div class=\"coy\">".$coor['y'].")</div></td></tr>";

	}
	}
	else{
	echo "<tr><td colspan=\"3\" class=\"none\">No village</td></tr>";
	}
	?>
		</tbody></table>
