<?php
if(!is_numeric($_SESSION['search'])) {
	echo "<p class=\"error\">The user <b>".$_SESSION['search']."</b> does not exist.</p>";
	$search = 0;
}
else {
$search = $_SESSION['search'];
}
?>
<table cellpadding="1" cellspacing="1" id="player">
	<thead>
				<tr>
					<th colspan="10">Online players</th>
				</tr>
		<tr><td></td><td>Player</td><td>Access</td><td>Gold</td><td>Email</td><td>Alliance</td><td>Population</td><td>Villages</td><td>Tribe</td></tr>
		</thead><tbody>
		<?php
		$users = $database->getUsersAll();
		for ($i = 0; $i < count($users); $i++) {

		if(count($users)>0) {
				$users[$i]['totalvillage'] = count($database->getVillagesID($users[$i]['id']));
					$users[$i]['totalpop'] = $database->getVSumField($users[$i]['id'],"pop");
					  $users[$i]['aname'] = $database->getAllianceName($users[$i]['alliance']);
					  $id = $i+1;
					echo "<tr><td class=\"ra \" >".$id.".</td>";

					echo "<td class=\"pla \" ><a href=\"spieler.php?uid=".$users[$i]['id']."\">".$users[$i]['username']."</a> [".$users[$i]['id']."]</td>";
					echo "<td class=\"pla \" >".$users[$i]['access']."</td>";
					echo "<td class=\"pla \" >".$users[$i]['gold']."</td>";
					echo "<td class=\"pla \" >".$users[$i]['email']."</td>";

					echo "<td class=\"al \" ><a href=\"allianz.php?aid=".$users[$i]['alliance']."\">".$users[$i]['aname']."</a></td>";

					echo "<td class=\"pop \" >".$users[$i]['totalpop']."</td><td class=\"vil\">".$users[$i]['totalvillage']."</td><td class=\"vil\">".$users[$i]['tribe']."</td></tr>";


		}

		else {
			echo "<td class=\"none\" colspan=\"5\">No users found</td>";
		}
		}
		?>
 </tbody>
</table>

