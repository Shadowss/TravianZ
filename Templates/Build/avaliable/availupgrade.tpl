<?php
$bid = $_GET['bid'];
unset($_GET['bid']);
$bindicator = $building->canBuild($id,$bid);
$loopsame = ($building->isCurrent($id) || $building->isLoop($id))?1:0;
$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))?1:0;
$uprequire = $building->resourceRequired($id,$bid);
$mastertime = $uprequire['time'];
?>
<td class="res">
			<img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /><?php echo $uprequire['wood']; ?> | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><?php echo $uprequire['clay']; ?> | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><?php echo $uprequire['iron']; ?> | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><?php echo $uprequire['crop']; ?> | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /><?php echo $uprequire['pop']; ?> | <img class="clock" src="img/x.gif" alt="duration" title="duration" /><?php echo $generator->getTimeFormat($uprequire['time']);

                   if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=".$uprequire['wood']."&r2=".$uprequire['clay']."&r3=".$uprequire['iron']."&r4=".$uprequire['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 } ?></td>
		</tr>
		<tr>
			<td class="link">
<?php
     if($bindicator == 2) {
     echo "<span class=\"none\">The workers are already at work.</span>";
	if($session->goldclub == 1){
?>	</br>
<?php
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}
     }
     else if($bindicator == 3) {
     echo "<span class=\"none\">The workers are already at work. (waiting loop)</span>";
	if($session->goldclub == 1){
?>	</br>
<?php
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}
     }
     else if($bindicator == 4) {
     echo "<span class=\"none\">Not enough food. Expand cropland.</span>";
     }
     else if($bindicator == 5) {
     echo "<span class=\"none\">Upgrade Warehouse.</span>";
     }
     else if($bindicator == 6) {
     echo "<span class=\"none\">Upgrade Granary.</span>";
     }
     else if($bindicator == 7) {
    	$neededtime = $building->calculateAvaliable($id,$bid);
    	echo "<span class=\"none\">Enough resources ".$neededtime[0]." at  ".$neededtime[1]."</span>";
	if($session->goldclub == 1){
?>	</br>
<?php
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}
     }
     else if($bindicator == 8) {
	 if($session->access!=BANNED){
     	echo "<a class=\"build\" href=\"dorf2.php?a=$bid&id=$id&c=".$session->checker."\">Construct building.</a>";
	 }else{
		echo "<a class=\"build\" href=\"banned.php\">Construct building.</a>";
	 }
     }
     else if($bindicator == 9) {
	 if($session->access!=BANNED){
     	echo "<a class=\"build\" href=\"dorf2.php?a=$bid&id=$id&c=".$session->checker."\">Construct building. (waiting loop)</a>";
	 }else{
		echo "<a class=\"build\" href=\"banned.php?a=$bid&id=$id&c=".$session->checker."\">Construct building. (waiting loop)</a>";
	 }
     }
            ?>	
</td>