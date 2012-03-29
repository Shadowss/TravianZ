<div id="build" class="gid16"><a href="#" onClick="return Popup(16,4);" class="build_logo">
	<img class="g16" src="img/x.gif" alt="Rally point" title="Rally point" />
</a>
<h1>Rally point <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Your village's troops meet here. From here you can send them out to conquer, raid or reinforce other villages.</p>

<div id="textmenu">
		<a href="build.php?id=<?php echo $id; ?>">Overview</a> |
		<a href="a2b.php">Send troops</a> |
		<a href="warsim.php">Combat Simulator</a></div>
		
<?php
$units_type = $database->getMovement("34",$village->wid,1);

$units_incoming = count($units_type);
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['attack_type'] == 1)
		$units_incoming -= 1;
}
if($units_incoming >= 1){
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
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['from']."&c=".$generator->getMapCheck($enforce['from'])."\">".$database->getVillageField($enforce['from'],"name")."</a></td>
                  <td colspan=\"10\">";
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." troops</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($enforce['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
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
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>Upkeep</th><td colspan=\"10\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour</div><div class='sback'><a href='a2b.php?w=".$enforce['id']."'>Send back</a></div></td></tr>";
            
                  echo "</tbody></table>";
            }
            }
            if(count($village->enforcetoyou) > 0) {
            echo "<h4>Troops in other village</h4>";
            foreach($village->enforcetoyou as $enforce) {
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['vref']."&c=".$generator->getMapCheck($enforce['vref'])."\">".$database->getVillageField($enforce['vref'],"name")."</a></td>
                  <td colspan=\"10\">";
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." troops</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserField($database->getVillageField($enforce['from'],"owner"),"tribe",0);
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
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
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>Upkeep</th><td colspan=\"10\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />per hour</div><div class='sback'><a href='a2b.php?r=".$enforce['id']."'>Send back</a></div></td></tr>";
            
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
