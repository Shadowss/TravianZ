<?php
$units = $database->getMovement(3,$village->wid,0);
$total_for = count($units);

for($y=0;$y<$total_for;$y++){
$timer += 1;

if($units[$y]['attack_type'] == 2){
	$attack_type = "Reinforcing";
	}
if($units[$y]['attack_type'] == 1){
	$attack_type = "Scouting";
	}
if($units[$y]['attack_type'] == 3){
	$attack_type = "Attack to";
	}
if($units[$y]['attack_type'] == 4){
	$attack_type = "Raid to";
	}
$isoasis = $database->isVillageOases($units[$y]['to']);
if ($isoasis ==0){ 	
$to = $database->getMInfo($units[$y]['to']);
} else {
$to = $database->getOMInfo($units[$y]['to']);}


?>
<table class="troop_details" cellpadding="1" cellspacing="1">            
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
			<td colspan="<?php if($units[$y]['t11'] == 0) {echo"10";}else{echo"11";}?>"><a href="karte.php?d=<?php echo $to['wref']."&c=".$generator->getMapCheck($to['wref']); ?>"><?php echo $attack_type." ".$to['name']; ?></a></td>
		</tr>
	</thead>
	<tbody class="units">
			<?php
                  echo "<tr><th>&nbsp;</th>";
                  for($i=($session->tribe-1)*10+1;$i<=$session->tribe*10;$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";	
                  }
                  if($units[$y]['t11'] != 0) {
                   echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";    
                  }
			?>
			</tr>
 <tr><th>Troops</th>
            <?php
			if($units[$y]['t11'] != 0) {
				$end = 12;
			}else{
				$end = 11;
			}
            for($i=1;$i<$end;$i++) {
            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">";
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
				    echo "<div class=\"in small\"><span id=timer$timer>".$generator->getTimeFormat($units[$y]['endtime']-time())."</span> h</div>";
				    $datetime = $generator->procMtime($units[$y]['endtime']);
				    echo "<div class=\"at small\">";
				    if($datetime[0] != "today") {
				    echo "on ".$datetime[0]." ";
				    }
				    echo "at ".$datetime[1]."</div>";
    		?>
					<!--<div class="abort"><a href="build.php?id=39&a=4&t=5360004"><img src="img/x.gif" class="del" title="Annuleren" alt="Annuleren" /></a>-->
					</div>
				</td>
			</tr>
		</tbody>
</table>
		<?php
		}
		?>
        
        <?php
        $settlers = $database->getMovement(5,$village->wid,0);   
        if($settlers){
        $total_for = count($settlers);

for($y=0;$y<$total_for;$y++){
$timer += 1;
    
?>
<table class="troop_details" cellpadding="1" cellspacing="1">            
    <thead>
        <tr>
            <td class="role"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo $village->vname; ?></a></td>
            <td colspan="10"><a href="karte.php?d=<?php echo $settlers[$y]['to']."&c=".$generator->getMapCheck($settlers[$y]['to']); ?>">Found new village.</a></td>
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
            ?>
            </tr>
 <tr><th>Troops</th>
            <?php
            $units[$y]['t10']=3;
            for($i=1;$i<=10;$i++) {
                if($units[$y]['t'.$i] == 0) {
                    echo "<td class=\"none\">";
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
                    echo "<div class=\"in small\"><span id=timer$timer>".$generator->getTimeFormat($settlers[$y]['endtime']-time())."</span> h</div>";
                    $datetime = $generator->procMtime($settlers[$y]['endtime']);
                    echo "<div class=\"at small\">";
                    if($datetime[0] != "today") {
                    echo "on ".$datetime[0]." ";
                    }
                    echo "at ".$datetime[1]."</div>";
            ?>
                    <!--<div class="abort"><a href="build.php?id=39&a=4&t=5360004"><img src="img/x.gif" class="del" title="Annuleren" alt="Annuleren" /></a>-->
                    </div>
                </td>
            </tr>
        </tbody>
</table>
        <?php
        }
        }
        ?>
