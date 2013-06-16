<table id="player" cellpadding="1" cellspacing="1">
	<thead>
				<tr>
					<th colspan="15">Results in <?php echo $_GET['search_in'];?></th>
				</tr>


		</thead><tbody>
	<?php
	if($_GET['search_in']=="player"){


	echo '<tr><td></td><td>Player</td><td>Access</td><td>Gold</td><td>Email</td><td>Alliance</td><td>Population</td>
	<td>Villages</td><td>Tribe</td><td>Last activity</td><td></td></tr>';

	  $holder = array();
		foreach($search as $value) {
			  $value['totalvillage'] = count($database->getVillagesID($value['id']));
			  $value['totalpop'] = $database->getVSumField($value['id'],"pop");
			  $value['aname'] = $database->getAllianceName($value['alliance']);
			  array_push($holder,$value);
			}
		$search = $multisort->sorte($holder, "'totalvillage'", false, 2, "'totalpop'", false, 2);


	for ($i = 0; $i <= count($search)-1; $i++) {

	if($search[$i]['id']==0 or $search[$i]['id']==1){
	$del = "<td></td>";
	}else{
	$del = '<td ><a href="?delete='.$search[$i]['id'].'&where=user"><img src="img/x.gif" class="del" title="cancel" alt="cancel"></a></td>';
	}

	echo'<tr>
		<td class="ra fc">'.($i+1).'.</td>
		<td class="pla "><a href="?uid='.$search[$i]['id'].'">'.$search[$i]['username'].'</a></td>
		<td class="vil">'.$search[$i]['access'].'</td>
		<td class="vil">'.$search[$i]['gold'].'</td>
		<td class="vil">'.$search[$i]['email'].'</td>
		<td class="al "><a href="?aid='.$search[$i]['alliance'].'">'.$search[$i]['aname'].'</a></td>
		<td class="pop ">'.$search[$i]['totalpop'].'</td>
		<td class="vil">'.$search[$i]['totalvillage'].'</td>
		<td class="vil">'.$search[$i]['tribe'].'</td>
		<td class="pla">'.date("H:i d.m.y",$search[$i]['timestamp']).'</td>
		'.$del.'
		</tr>
		';
	  }
	}

	if($_GET['search_in']=="village"){

	foreach ($_GET as $value=>$el) {
	if($value!="sort"){
	$page .= $value."=".$el."&";
	}
	}
	echo '<tr><td></td>
	<td><a class="rn3" href="?'.$page.'sort=name">Village</a></td>
	<td><a class="rn3" href="?'.$page.'sort=owner">Owner</a></td>
	<td><a class="rn3" href="?'.$page.'sort=wood"><img src="img/x.gif" class="r1"> Wood</a></td>
	<td><a class="rn3" href="?'.$page.'sort=clay"><img src="img/x.gif" class="r2"> Clay</a></td>
	<td><a class="rn3" href="?'.$page.'sort=iron"><img src="img/x.gif" class="r3"> Iron</a></td>
	<td><a class="rn3" href="?'.$page.'sort=maxstore">Max store</a></td>
	<td><a class="rn3" href="?'.$page.'sort=crop"><img src="img/x.gif" class="r4"> Crop</a></td>
	<td><a class="rn3" href="?'.$page.'sort=maxcrop">Max Crop</a></td>
	<td><a class="rn3" href="?'.$page.'sort=pop">Pop</a></td>
	<td><a class="rn3" href="?'.$page.'sort=capital">Capital</a></td>
	</tr>
	<tr><td colspan="15"></td></tr>';

	$sort = $_GET['sort'];
	if(!$sort){
	$search = $multisort->sorte($search, "'pop'", false, 2);
	}
	else{
	$search = $multisort->sorte($search, "'$sort'", true, 2);
	}


	for ($i = 0; $i <= count($search)-1; $i++) {
	$owner = $database->getUserField($search[$i]['owner'],'username',0);
	$owner_id = $database->getUserField($search[$i]['owner'],'id',0);
	echo '<tr>
	 <td>'.($i+1).'.</td>
	 <td><a href="?wref='.$search[$i]['wref'].'">'.$search[$i]['name'].'</a></td>
	 <td><a href="?uid='.$search[$i]['owner'].'">'.$owner.'</a></td>
	 <td>'.$search[$i]['wood'].'</td>
	 <td>'.$search[$i]['clay'].'</td>
	 <td>'.$search[$i]['iron'].'</td>
	 <td>'.$search[$i]['maxstore'].'</td>
	 <td>'.$search[$i]['crop'].'</td>
	 <td>'.$search[$i]['maxcrop'].'</td>
	 <td>'.$search[$i]['pop'].'</td>
	 <td>'.$search[$i]['capital'].'</td>
	</tr>';
	}
	}

	?>
	</tbody>

</table>

