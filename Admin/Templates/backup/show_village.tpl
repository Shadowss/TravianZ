<?php
$village = $database->getVillage($_GET['wref']);
?>
<div id="content"  class="player" style="width:100%">
<table id="profile" cellpadding="1" cellspacing="1" >
	<thead>
	<tr>
		<th colspan="2">Village: <a href="?wref=<?php echo $village['wref']; ?>"><?php echo $village['name']; ?></a> - user '<?php echo $village['owner']; ?>'</th>
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

				<th>Wood</th>
				<td><?php echo $village['wood']; ?></td>
			</tr>
			<tr>
				<th>Clay</th>
				<td><?php echo $village['clay']; ?></td>
			</tr>

			<tr>
				<th>Iron</th>
				<td><?php echo $village['iron']; ?></td>
			</tr>
			<tr>
				<th>Max store</th>
				<td><?php echo $village['maxstore']; ?></td>
			</tr>
			<tr>
				<th>Crop</th>
				<td><?php echo $village['crop']; ?></td>

			</tr>
			<tr>
				<th>Max store</th>
				<td><?php echo $village['maxcrop']; ?></td>
			</tr>
			<tr>
				<th>Population</th>
				<td><?php echo $village['pop']; ?></td>
			</tr>
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
					<td colspan="2"> <a href="#?uid=<?php echo $_GET['uid'];?>&delete=<?php echo $_GET['uid'];?>&where=user">&raquo; Delete player</a></td>
			</tr>
			</table>

		</td>
		<td class="details">
			<table cellpadding="0" cellspacing="0">
			<tr>

				<th>Capital</th>
				<td><?php echo $village['capital']; ?></td>
			</tr>
			<tr>
				<th>Clay</th>
				<td><?php echo $village['clay']; ?></td>
			</tr>

			<tr>
				<th>Iron</th>
				<td><?php echo $village['iron']; ?></td>
			</tr>
			<tr>
				<th>Max store</th>
				<td><?php echo $village['maxstore']; ?></td>
			</tr>
			<tr>
				<th>Crop</th>
				<td><?php echo $village['crop']; ?></td>

			</tr>
			<tr>
				<th>Max store</th>
				<td><?php echo $village['maxcrop']; ?></td>
			</tr>
			<tr>
				<th>Population</th>
				<td><?php echo $village['pop']; ?></td>
			</tr>
			</table>

		</td>

	</tr>
	</tbody>
</table>
<br>
<table id="villages" cellpadding="1" cellspacing="1">
	<thead>
	<tr>
		<th colspan="3">Villages:</th>
	</tr>
	<tr>
		<td>Name</td>
		<td>Inhabitants</td>
		<td>Coordinates</td>
	</tr>
	</thead><tbody>
<?php
$villages = $database->getProfileVillages($village['owner']);
foreach($villages as $vil){
$coor = $database->getCoor($vil['wref']);
if($vil['capital']==1) {$cap = '<span class="none3">(capital)</span>';} else{$cap = "";}
echo '
  <tr>
	<td class="nam"><a href="?wref='.$vil['wref'].'">'.$vil['name'].'</a> '.$cap.'</td>
		<td class="hab">'.$vil['pop'].'</td>
		<td class="aligned_coords">
			<div class="cox">('.$coor['x'].'</div>
			<div class="pi">|</div>
			<div class="coy">'.$coor['y'].')</div>
		</td>
	</tr>'; }
?>
	</tbody></table>