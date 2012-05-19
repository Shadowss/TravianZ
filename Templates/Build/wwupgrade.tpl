<?php
$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);
$wwlevel = $village->resarray['f'.$id];
if($wwlevel > 49){
$needed_plan = 1;
}else{
$needed_plan = 0;
}
$alli_users = $database->getUserByAlliance($session->alliance);
$wwbuildingplan = 0;
if(!empty($alli_users)){
foreach($alli_users as $users){
$villages = $database->getVillageID($users['id']);
foreach($villages as $village){
$plan = count($database->getOwnArtefactInfoByType2($village,11));
if($plan > 0){
$wwbuildingplan += 1;
}
}
}
}
if($wwbuildingplan == $needed_plan){
if($bindicate == 1) {
	echo "<p><span class=\"none\">Building already at max level</span></p>";
} else if($bindicate == 10) {
	echo "<p><span class=\"none\">Building max level under construction</span></p>";
} else if($bindicate == 11) {
	echo "<p><span class=\"none\">Building presently being demolished</span></p>";
} else {
	$loopsame = ($building->isCurrent($id) || $building->isLoop($id))?1:0;
	$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))?1:0;
	$master = count($database->getMasterJobsByField($village->wid,$id));
	$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
	$mastertime = $uprequire['time'];
?>
<p id="contract"><b>Costs</b> for upgrading to level <?php echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master; ?>:<br />
<img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /><span class="little_res"><?php echo $uprequire['wood']; ?></span> | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><span class="little_res"><?php echo $uprequire['clay']; ?></span> | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><span class="little_res"><?php echo $uprequire['iron']; ?></span> | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><span class="little_res"><?php echo $uprequire['crop']; ?></span> | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /><?php echo $uprequire['pop']; ?> | <img class="clock" src="img/x.gif" alt="duration" title="duration" /><?php echo $generator->getTimeFormat($uprequire['time']); 
if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
    echo "|<a href=\"build.php?gid=17&t=3&r1=".$uprequire['wood']."&r2=".$uprequire['clay']."&r3=".$uprequire['iron']."&r4=".$uprequire['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 } ?><br />
<?php
    if($bindicate == 2) {
   		echo "<span class=\"none\">The workers are already at work.</span>";
	if($session->goldclub){
?>	</br>
<?php
	if($id <= 18) {
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf1.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}else{
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}
	}
    }
    else if($bindicate == 3) {
    	echo "<span class=\"none\">The workers are already at work. (waiting loop)</span>";
	if($session->goldclub){
?>	</br>
<?php
	if($id <= 18) {
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf1.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}else{
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}
	}
    }
    else if($bindicate == 4) {
    	echo "<span class=\"none\">Not enough food. Expand cropland.</span>";
    }
    else if($bindicate == 5) {
    	echo "<span class=\"none\">Upgrade Warehouse.</span>";
    }
    else if($bindicate == 6) {
    	echo "<span class=\"none\">Upgrade Granary.</span>";
    }
    else if($bindicate == 7) {
    	$neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
    	echo "<span class=\"none\">Enough resources ".$neededtime[0]." at  ".$neededtime[1]."</span>";
	if($session->goldclub){
?>	</br>
<?php
	if($id <= 18) {
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf1.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}else{
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime\">Constructing with master builder </a>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}else{
		echo "<span class=\"none\">Constructing with master builder</span>";
		echo '<font color="#B3B3B3">(costs: <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="Gold"/>1)</font>';
	}
	}
	}
    }
    else if($bindicate == 8) {
		if($session->access==BANNED){
    	echo "<a class=\"build\" href=\"banned.php\">Upgrade to level ";
		}
		else if($id <= 18) {
    	echo "<a class=\"build\" href=\"dorf1.php?a=$id&c=$session->checker\">Upgrade to level ";
        }
        else {
        echo "<a class=\"build\" href=\"dorf2.php?a=$id&c=$session->checker\">Upgrade to level ";
        }
		echo $village->resarray['f'.$id]+1;
		echo ".</a>";
		}
    else if($bindicate == 9) {
		if($session->access==BANNED){
    	echo "<a class=\"build\" href=\"banned.php\">Upgrade to level ";
		}
    	else if($id <= 18) {
    	echo "<a class=\"build\" href=\"dorf1.php?a=$id&c=$session->checker\">Upgrade to level ";
        }
        else {
        echo "<a class=\"build\" href=\"dorf2.php?a=$id&c=$session->checker\">Upgrade to level ";
        }
		echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1);
		echo ".</a> <span class=\"none\">(waiting loop)</span> ";
    }
}
	}else{
    	echo "<span class=\"none\">Need more WW construction plan.</span>";
	}

?>
