<div id="build" class="gid16"><a href="#" onClick="return Popup(16,4);" class="build_logo">
	<img class="g16" src="img/x.gif" alt="Rally point" title="Rally point" />
</a>
<h1>Rally point <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Your village's troops meet here. From here you can send them out to conquer, raid or reinforce other villages.</p>

<div id="textmenu">
		<a href="build.php?id=<?php echo $id; ?>">Overview</a> |
		<a href="a2b.php">Send troops</a> |
		<a href="warsim.php">Combat Simulator</a> <?php if($session->goldclub==1){ ?>|
		<a href="build.php?id=<?php echo $id; ?>&amp;t=99">Gold Club</a>
		<?php } ?>
		</div>
<?php
$units_type = $database->getMovement("34",$village->wid,1);
$settlers = $database->getMovement("7",$village->wid,1);
$units_incoming = count($units_type);
$settlers_incoming = count($settlers);
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['attack_type'] == 1 && $units_type[$i]['sort_type'] == 3)
		$units_incoming -= 1;
}
if($units_incoming > 0 or $settlers_incoming > 0){
?>
<h4>Incoming troops (<?php echo $units_incoming; ?>)</h4>
	<?php include("16_incomming.tpl"); 
	} 
?>
		
<h4>Troops in the village</h4>
        <table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td><td colspan="<?php if($village->unitarray['hero'] == 0) {echo"10";}else{echo"11";}?>">
            <a href="spieler.php?uid=<?php echo $session->uid; ?>">Own troops</a></td></tr></thead>
            <tbody class="units">
           <?php include("16_troops.tpl"); 
          
           ?>
            </tbody></table>
            
            <?php
            if(count($village->enforcetome) > 0) {
            foreach($village->enforcetome as $enforce) {
			$colspan = 10+$enforce['hero'];
			if($enforce['from']!=0){
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['from']."&c=".$generator->getMapCheck($enforce['from'])."\">".$database->getVillageField($enforce['from'],"name")."</a></td>
                  <td colspan=\"$colspan\">";
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." troops</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($enforce['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
				  if($enforce['hero']!=0){
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
				  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=$start;$i<=($start+9);$i++) {
                  if($enforce['u'.$i] == 0) {
                	echo "<td class=\"none\">";
                       }
                      else {
                     echo "<td>";
                        }
                        echo $enforce['u'.$i]."</td>";
                  }
				  if($enforce['hero']!=0){
					echo "<td>".$enforce['hero']."</td>";
				  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>Upkeep</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour</div><div class='sback'><a href='a2b.php?w=".$enforce['id']."'>Send back</a></div></td></tr>";
            
                  echo "</tbody></table>";
			}else{
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a>Taskmaster</a></td>
                  <td colspan=\"$colspan\">";
                  echo "<a> village of the elders troops</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = 4;
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
				  if($enforce['hero']!=0){
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
				  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=$start;$i<=($start+9);$i++) {
                  if($enforce['u'.$i] == 0) {
                	echo "<td class=\"none\">";
                       }
                      else {
                     echo "<td>";
                        }
                        echo $enforce['u'.$i]."</td>";
                  }
				  if($enforce['hero']!=0){
					echo "<td>".$enforce['hero']."</td>";
				  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>Upkeep</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour</div><div class='sback'><span class=none><b>Send back</b></span></div></td></tr>";
            
                  echo "</tbody></table>";
			}
            }
            }
            if(count($village->enforcetoyou) > 0) {
            echo "<h4>Troops in other village</h4>";
            foreach($village->enforcetoyou as $enforce) {
			$colspan = 10+$enforce['hero'];
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['vref']."&c=".$generator->getMapCheck($enforce['vref'])."\">".$database->getVillageField($enforce['vref'],"name")."</a></td>
                  <td colspan=\"$colspan\">";
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." troops</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($enforce['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
				  if($enforce['hero']!=0){
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
				  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=$start;$i<=($start+9);$i++) {
                  if($enforce['u'.$i] == 0) {
                	echo "<td class=\"none\">";
                       }
                      else {
                     echo "<td>";
                        }
                        echo $enforce['u'.$i]."</td>";
                  }
				  if($enforce['hero']!=0){
					echo "<td>".$enforce['hero']."</td>";
				  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>Upkeep</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour</div><div class='sback'><a href='a2b.php?r=".$enforce['id']."'>Send back</a></div></td></tr>";
            
                  echo "</tbody></table>";
            }
            }
            if(count($database->getPrisoners3($village->wid)) > 0) {
            echo "<h4>Prisoners</h4>";
            foreach($database->getPrisoners3($village->wid) as $prisoners) {
			$colspan = 10+$prisoners['t11'];
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$prisoners['wref']."&c=".$generator->getMapCheck($prisoners['wref'])."\">".$database->getVillageField($prisoners['wref'],"name")."</a></td>
                  <td colspan=\"$colspan\">";
                  echo "<a href=\"karte.php?d=".$prisoners['wref']."&c=".$generator->getMapCheck($prisoners['wref'])."\">prisoners in ".$database->getVillageField($prisoners['wref'],"name")."</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($prisoners['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
				  if($prisoners['t11']!=0){
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
				  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=1;$i<=10;$i++) {
                  if($prisoners['t'.$i] == 0) {
                	echo "<td class=\"none\">";
                       }
                      else {
                     echo "<td>";
                        }
                        echo $prisoners['t'.$i]."</td>";
                  }
				  if($prisoners['t11']!=0){
					echo "<td>".$prisoners['t11']."</td>";
				  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>Upkeep</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($prisoners,$tribe,0,1)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour</div><div class='sback'><a href='a2b.php?delprisoners=".$prisoners['id']."'>Kill</a></div></td></tr>";
            
                  echo "</tbody></table>";
            }
            }
            if(count($database->getPrisoners($village->wid)) > 0) {
            echo "<h4>Prisoners</h4>";
            foreach($database->getPrisoners($village->wid) as $prisoners) {
			$colspan = 10+$prisoners['t11'];
			$colspan2 = 11+$prisoners['t11'];
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$prisoners['from']."&c=".$generator->getMapCheck($prisoners['from'])."\">".$database->getVillageField($prisoners['from'],"name")."</a></td>
                  <td colspan=\"$colspan\">";
                  echo "<a href=\"karte.php?d=".$prisoners['from']."&c=".$generator->getMapCheck($prisoners['from'])."\">prisoners from ".$database->getVillageField($prisoners['from'],"name")."</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($prisoners['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
				  if($prisoners['t11']!=0){
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
				  }
                  echo "</tr><tr><th>Troops</th>";
                  for($i=1;$i<=10;$i++) {
                  if($prisoners['t'.$i] == 0) {
                	echo "<td class=\"none\">";
                       }
                      else {
                     echo "<td>";
                        }
                        echo $prisoners['t'.$i]."</td>";
                  }
				  if($prisoners['t11']!=0){
					echo "<td>".$prisoners['t11']."</td>";
				  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><td colspan=\"11\"><div class='sup'><img class=\"r6\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" /></div><div class='sback'><a href='a2b.php?delprisoners=".$prisoners['id']."'>Send Back</a></div></td></tr>";
            
                  echo "</tbody></table>";
            }
            }
            ?>

<?php
$units_type = $database->getMovement("3",$village->wid,0);
$settlers = $database->getMovement("5",$village->wid,0);
$units_incoming = count($units_type);
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['vref'] != $village->wid)
		$units_incoming -= 1;
}
$units_incoming += count($settlers);

if($units_incoming >= 1){
	echo "<h4>Troops on their way</h4>";
	include("16_walking.tpl"); 
}

include("upgrade.tpl");
?>
</p></div>
