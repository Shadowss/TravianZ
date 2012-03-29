<table id="player" cellpadding="1" cellspacing="1">
	<thead>
				<tr>
					<th colspan="15">Results in <?php echo $_POST['search_in'];?></th>
				</tr>

		
		</thead><tbody>
    <?php
    if($_POST['search_in']=="player"){   
 
    
    echo '<tr><td></td><td>Player</td><td>Access</td><td>Gold</td><td>Email</td><td>Alliance</td><td>Population</td>
    <td>Villages</td><td>Tribe</td><td>Last activity</td><td></td></tr>'; 
     
    for ($i = 0; $i <= count($search)-1; $i++) {
    
    $search[$i]['totalvillage'] = count($database->getVillagesID($search[$i]['id']));  
		$search[$i]['totalpop'] = $database->getVSumField($search[$i]['id'],"pop");
		$search[$i]['aname'] = $database->getAllianceName($search[$i]['alliance']);
    
    if($search[$i]['id']==0 or $search[$i]['id']==1){
    $del = "<td></td>";
    }else{
    $del = '<td ><a href="?delete='.$search[$i]['id'].'"><img src="img/x.gif" class="del" title="cancel" alt="cancel"></a></td>';
    }
    
    echo' <tr>
        <td class="ra fc">'.($i+1).'.</td>
        <td class="pla "><a href="?uid='.$search[$i]['id'].'">'.$search[$i]['username'].'</a></td>
        <td class="vil">'.$search[$i]['access'].'</td>
        <td class="vil">'.$search[$i]['gold'].'</td>
        <td class="vil">'.$search[$i]['email'].'</td>
        <td class="al "><a href="?aid='.$search[$i]['alliance'].'">'.$search[$i]['aname'].'</a></td>
        <td class="pop ">'.$search[$i]['totalpop'].'</td>
        <td class="vil">'.$search[$i]['totalvillage'].'</td>
        <td class="vil">'.$search[$i]['tribe'].'</td>
        <td class="vil">'.date("H:m d.m.y",$search[$i]['timestamp']).'</td>
        '.$del.'
        </tr>
        ';        
      }
    }
    
    if($_POST['search_in']=="village"){
    echo '<tr><td></td><td>Village</td><td>Owner</td><td><img src="img/x.gif" class="r1">Wood</td><td><img src="img/x.gif" class="r2">Clay</td><td><img src="img/x.gif" class="r3">Iron</td><td>Max store</td><td><img src="img/x.gif" class="r4">Crop</td><td>Max Crop</td><td>Pop</td><td>Capital</td></tr>';
    for ($i = 0; $i <= count($search)-1; $i++) {
    $owner = $database->getUserField($search[$i]['owner'],'username',0);
    echo '<tr>
     <td class="fc">'.($i+1).'.</td>
     <td class="vil"><a href="?uid='.$search[$i]['wref'].'">'.$search[$i]['name'].'</a></td>
     <td class="vil"><a href="?uid='.$search[$i]['owner'].'">'.$owner.'</td>
     <td class="vil">'.$search[$i]['wood'].'</td>
     <td class="vil">'.$search[$i]['clay'].'</td>
     <td class="vil">'.$search[$i]['iron'].'</td>
     <td class="vil">'.$search[$i]['maxstore'].'</td>
     <td class="vil">'.$search[$i]['crop'].'</td>
     <td class="vil">'.$search[$i]['maxcrop'].'</td>
     <td class="vil">'.$search[$i]['pop'].'</td>
     <td class="vil">'.$search[$i]['capital'].'</td>
    </tr>';
    //echo $search[$i]['name'].$search[$i]['owner']."<br>";
    }
    }
    
    ?>     
    </tbody>

</table>

