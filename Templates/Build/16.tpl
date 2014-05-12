<div id="build" class="gid16"><a href="#" onClick="return Popup(16,4);" class="build_logo">
        <img class="g16" src="img/x.gif" alt="Rally point" title="<?php echo RALLYPOINT;?>" />
</a>
<h1><?php echo RALLYPOINT;?> <span class="level"><?php echo LEVEL;?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo RALLYPOINT_DESC;?></p>

<div id="textmenu">
                <a href="build.php?id=<?php echo $id; ?>"><?php echo OVERVIEW;?></a> |
                <a href="a2b.php"><?php echo SEND_TROOPS;?></a> |
                <a href="warsim.php"><?php echo Q20_RESP1;?></a> <?php if($session->goldclub==1){ ?>|
                <a href="build.php?id=<?php echo $id; ?>&amp;t=99">Gold Club</a>
                <?php } ?>
                </div>
<?php
$units_type = $database->getMovement("34",$village->wid,1);
$settlers = $database->getMovement("7",$village->wid,1);
$oasis_incoming = 0;
$array = $database->getOasis($village->wid);
foreach($array as $conqured){
$oasis_incoming += count($database->getMovement(6,$conqured['wref'],0));
}
$units_incoming = count($units_type);
$settlers_incoming = count($settlers);
for($i=0;$i<$units_incoming;$i++){
        if($units_type[$i]['attack_type'] == 1 && $units_type[$i]['sort_type'] == 3)
                $units_incoming -= 1;
}
if($units_incoming > 0 or $settlers_incoming > 0 or $oasis_incoming > 0){
?>
<h4><?php echo INCOMING_TROOPS;?> (<?php echo $units_incoming+$settlers_incoming+$oasis_incoming; ?>)</h4>
        <?php include("16_incomming.tpl");
        }
?>
                
<h4><?php echo TROOPS_IN_THE_VILLAGE;?></h4>
<table class="troop_details" cellpadding="1" cellspacing="1">
        <thead>
                <tr>
                        <td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td><td colspan="<?php if($village->unitarray['hero'] == 0) {echo"10";}else{echo"11";}?>">
<a href="spieler.php?uid=<?php echo $session->uid; ?>"><?php echo OWN_TROOPS;?></a></td></tr></thead>
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
if (LANG == "es") {
                  echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".TROOPSFROM." ".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." </a>";
     }else{       echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." ".TROOPSFROM."</a>";

}	 
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
echo "</tr><tr><th>".TROOPS."</th>";
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
<tbody class=\"infos\"><tr><th>".UPKEEP."</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PER_HR."</div><div class='sback'><a href='a2b.php?w=".$enforce['id']."'>".SEND_BACK."</a></div></td></tr>";
echo "</tbody></table>";
                        }else{
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
<a>".TASKMASTER."</a></td>
<td colspan=\"$colspan\">";
                  echo "<a> ".VILLAGE_OF_THE_ELDERS_TROOPS."</a>";
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
echo "</tr><tr><th>".TROOPS."</th>";
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
<tbody class=\"infos\"><tr><th>".UPKEEP."</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PER_HR."</div><div class='sback'><span class=none><b>".SEND_BACK."</b></span></div></td></tr>";
echo "</tbody></table>";
                        }
}
}
$enforcevill = array();
$enforceoasis = array();
$allenforce=$village->enforcetoyou;
$enforcemeoasis=$village->enforceoasis;
if(count($allenforce) > 0) {
                foreach($allenforce as $enforce) {
                    $conquredvid=$database->getOasisField($enforce['vref'], "conqured");
                    if ($conquredvid>0) {
                        $enforce['conqured']=$conquredvid;
                        array_push($enforceoasis,$enforce);
                    } else {
                        array_push($enforcevill,$enforce);
                    }
}
}
if(count($enforcemeoasis) > 0) {
                foreach($enforcemeoasis as $enforce) {
                    array_push($enforceoasis,$enforce);
                }
}
if (count($enforcevill)>0) {
                echo "<h4>".TROOPS_IN_OTHER_VILLAGE."</h4>";
                foreach($enforcevill as $enforce) {
                    $colspan = 10+$enforce['hero'];
                    echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
<a href=\"karte.php?d=".$enforce['vref']."&c=".$generator->getMapCheck($enforce['from'])."\">".$database->getVillageField($enforce['from'],"name")."</a></td>
<td colspan=\"$colspan\">";
                    echo "<a href=\"karte.php?d=".$enforce['vref']."&c=".$generator->getMapCheck($enforce['vref'])."\">".REINFORCEMENTFOR." ".$database->getVillageField($enforce['vref'],"name")." </a>";
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
echo "</tr><tr><th>".TROOPS."</th>";
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
<tbody class=\"infos\"><tr><th>".UPKEEP."</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PER_HR."</div><div class='sback'><a href='a2b.php?r=".$enforce['id']."'>".SEND_BACK."</a></div></td></tr>";
echo "</tbody></table>";
}
}
if(count($enforceoasis) > 0) {
                echo "<h4>".TROOPS_IN_OASIS."</h4>";
                foreach($enforceoasis as $enforce) {
                    $colspan = 10+$enforce['hero'];
                    echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
<a href=\"karte.php?d=".$enforce['vref']."&c=".$generator->getMapCheck($enforce['vref'])."\">".$database->getVillageField($enforce['conqured'],"name")."</a></td>
<td colspan=\"$colspan\">";
if (LANG == "es") {
                    echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".TROOPSFROM." ".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." </a> ".FROM." <a href=\"karte.php?d=".$enforce['from']."&c=".$generator->getMapCheck($enforce['from'])."\">".$database->getVillageField($enforce['from'],"name")."</a>";
}else{              echo "<a href=\"spieler.php?uid=".$database->getVillageField($enforce['from'],"owner")."\">".$database->getUserField($database->getVillageField($enforce['from'],"owner"),"username",0)." ".TROOPSFROM."</a> ".FROM." <a href=\"karte.php?d=".$enforce['from']."&c=".$generator->getMapCheck($enforce['from'])."\">".$database->getVillageField($enforce['from'],"name")."</a>";
}
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
echo "</tr><tr><th>".TROOPS."</th>";
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
<tbody class=\"infos\"><tr><th>".UPKEEP."</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($enforce,$tribe)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PER_HR."</div><div class='sback'><a href='a2b.php?r=".$enforce['id']."'>".SEND_BACK."</a></div></td></tr>";
echo "</tbody></table>";
}
}
if(count($database->getPrisoners3($village->wid)) > 0) {
            echo "<h4>".PRISONERS."</h4>";
            foreach($database->getPrisoners3($village->wid) as $prisoners) {
                        $colspan = 10+$prisoners['t11'];
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
<a href=\"karte.php?d=".$prisoners['wref']."&c=".$generator->getMapCheck($prisoners['wref'])."\">".$database->getVillageField($prisoners['wref'],"name")."</a></td>
<td colspan=\"$colspan\">";
                  echo "<a href=\"karte.php?d=".$prisoners['wref']."&c=".$generator->getMapCheck($prisoners['wref'])."\">".PRISONERSIN." ".$database->getVillageField($prisoners['wref'],"name")."</a>";
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
echo "</tr><tr><th>".TROOPS."</th>";
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
<tbody class=\"infos\"><tr><th>".UPKEEP."</th><td colspan=\"$colspan\"><div class='sup'>".$technology->getUpkeep($prisoners,$tribe,0,1)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PER_HR."</div><div class='sback'><a href='a2b.php?delprisoners=".$prisoners['id']."'>".KILL."</a></div></td></tr>";
echo "</tbody></table>";
}
}
if(count($database->getPrisoners($village->wid)) > 0) {
            echo "<h4>".PRISONERS."</h4>";
            foreach($database->getPrisoners($village->wid) as $prisoners) {
                        $colspan = 10+$prisoners['t11'];
                        $colspan2 = 11+$prisoners['t11'];
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
<a href=\"karte.php?d=".$prisoners['from']."&c=".$generator->getMapCheck($prisoners['from'])."\">".$database->getVillageField($prisoners['from'],"name")."</a></td>
<td colspan=\"$colspan\">";
                  echo "<a href=\"karte.php?d=".$prisoners['from']."&c=".$generator->getMapCheck($prisoners['from'])."\">".PRISONERSFROM." ".$database->getVillageField($prisoners['from'],"name")."</a>";
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
echo "</tr><tr><th>".TROOPS."</th>";
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
<tbody class=\"infos\"><tr><td colspan=\"11\"><div class='sup'><img class=\"r6\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" /></div><div class='sback'><a href='a2b.php?delprisoners=".$prisoners['id']."'>".SEND_BACK."</a></div></td></tr>";
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
        echo "<h4>".TROOPS_ON_THEIR_WAY."</h4>";
        include("16_walking.tpl");
}

include("upgrade.tpl");
?>
</p></div>