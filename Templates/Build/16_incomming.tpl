<?php

$units = $database->getMovement("34",$village->wid,1);
$total_for = count($units);

for($y=0;$y < $total_for;$y++){
$timer = $y+1;
if ($units[$y]['sort_type']==3){
	if ($units[$y]['attack_type']==3){
		$actionType = "Attack on ";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "Raid on ";
	}
	
	if($units[$y]['attack_type'] != 1){
		echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$units[$y]['from']."&c=".$generator->getMapCheck($units[$y]['from'])."\">".$database->getVillageField($units[$y]['from'],"name")."</a></td>
                  <td colspan=\"10\">";
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($units[$y]['from'],"owner")."\">".$database->getUserField($database->getVillageField($units[$y]['from'],"owner"),"username",0)."'s troops</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($units[$y]['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=$start;$i<=($end);$i++) {
				  $tribe1 = $tribe-1;
				  $totalunits = $units[$y]['t'.$tribe1*10+1]+$units[$y]['t'.$tribe1*10+2]+$units[$y]['t'.$tribe1*10+3]+$units[$y]['t'.$tribe1*10+4]+$units[$y]['t'.$tribe1*10+5]+$units[$y]['t'.$tribe1*10+6]+$units[$y]['t'.$tribe1*10+7]+$units[$y]['t'.$tribe1*10+8]+$units[$y]['t'.$tribe1*10+9]+$units[$y]['t'.$tribe1*10+10];
				  if($totalunits > $building->getTypeLevel(16)){
                 		echo "<td class=\"none\">?</td>";
                  }else{
				  if($units[$y]['t'.$i] == 0) {
                    echo "<td class=\"none\">0</td>";
				  }else{
					echo "<td>?</td>";
                  }	
				  }
				  }
                  echo "</tr></tbody>";
                  echo '
                  <tbody class="infos">
									<tr>
										<th>Arrival</th>
										<td colspan="10">
										<div class="in small"><span id=timer'.$timer.'>'.$generator->getTimeFormat($units[$y]['endtime']-time()).'</span> h</div>';
										    $datetime = $generator->procMtime($units[$y]['endtime']);
										    echo "<div class=\"at small\">";
										    if($datetime[0] != "today") {
										    echo "on ".$datetime[0]." ";
										    }
										    echo "at ".$datetime[1]."</div>
											</div>
										</td>
									</tr>
								</tbody>";
		echo "</table>";
	}
}else if ($units[$y]['sort_type']==4){
	if ($units[$y]['attack_type']==1){
		$actionType = "Return from ";
	} else if ($units[$y]['attack_type']==2){
		$actionType = "Reinforment for ";
	} else if ($units[$y]['attack_type']==3){
		$actionType = "Return from ";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "Return from ";
	}


$to = $database->getMInfo($units[$y]['vref']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">            
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
			<td colspan="<?php if($units[$y]['t11'] != 0) {echo"11";}else{echo"10";}?>"><a href="karte.php?d=<?php echo $to['wref']."&c=".$generator->getMapCheck($to['wref']); ?>"><?php echo "Returning to ".$to['name']; ?></a></td>
		</tr>
	</thead>
	<tbody class="units">
			<?php
				  $tribe = $session->tribe;
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  if($units[$y]['t11'] != 0) {
                   echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";    
                  }
			?>
			</tr>
 <tr><th>Troops</th>
            <?php
            for($i=1;$i<($units[$y]['t11'] != 0?12:11);$i++) {
            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">?</td>";
                }
                else {
                echo "<td>";
                }
                echo $units[$y]['t'.$i]."</td>";
            }
            ?>
           </tr></tbody>
		<tbody class="infos">
			<tr>
				<th>Arrival</th>
				<td colspan="<?php if($units[$y]['t11'] == 0) {echo"10";}else{echo"11";}?>">
				<?php
				    echo "<div class=\"in small\"><span id=timer".$timer.">".$generator->getTimeFormat($units[$y]['endtime']-time())."</span> h</div>";
				    $datetime = $generator->procMtime($units[$y]['endtime']);
				    echo "<div class=\"at small\">";
				    if($datetime[0] != "today") {
				    echo "on ".$datetime[0]." ";
				    }
				    echo "at ".$datetime[1]."</div>";
    		?>
					</div>
				</td>
			</tr>
		</tbody>
</table>
<?php	
	}
	
	
	}

//}
		?>
