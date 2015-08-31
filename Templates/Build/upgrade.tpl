<?php
$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);
if($bindicate == 1) {
	echo "<p><span class=\"none\">".MAX_LEVEL."</span></p>";
} else if($bindicate == 10) {
	echo "<p><span class=\"none\">".BUILDING_MAX_LEVEL_UNDER."</span></p>";
} else if($bindicate == 11) {
	echo "<p><span class=\"none\">".BUILDING_BEING_DEMOLISHED."</span></p>";
} else {
	$loopsame = ($building->isCurrent($id) || $building->isLoop($id))?1:0;
	$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))?1:0;
	$master = count($database->getMasterJobsByField($village->wid,$id));
	$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
	$mastertime = $uprequire['time'];
?>
<p id="contract"><b><?php echo COSTS_UPGRADING_LEVEL;?> <?php echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master; ?>:<br />
<img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /><span class="little_res"><?php echo $uprequire['wood']; ?></span> | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><span class="little_res"><?php echo $uprequire['clay']; ?></span> | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><span class="little_res"><?php echo $uprequire['iron']; ?></span> | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><span class="little_res"><?php echo $uprequire['crop']; ?></span> | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /><?php echo $uprequire['pop']; ?> | <img class="clock" src="img/x.gif" alt="duration" title="duration" /><?php echo $generator->getTimeFormat($uprequire['time']); 
if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
    echo "|<a href=\"build.php?gid=17&t=3&r1=".$uprequire['wood']."&r2=".$uprequire['clay']."&r3=".$uprequire['iron']."&r4=".$uprequire['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 } ?><br />
<?php
    if($bindicate == 2) {
   		echo "<span class=\"none\">".WORKERS_ALREADY_WORK."</span>";
	if($session->goldclub == 1){
?>	</br>
<?php
	if($id <= 18) {
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf1.php?master=$bid&id=$id&time=$mastertime&c=$session->checker\">".CONSTRUCTING_MASTER_BUILDER." </a>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}else{
		echo "<span class=\"none\">".CONSTRUCTING_MASTER_BUILDER."</span>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}
	}else{
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime&c=$session->checker\">".CONSTRUCTING_MASTER_BUILDER." </a>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}else{
		echo "<span class=\"none\">".CONSTRUCTING_MASTER_BUILDER."</span>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}
	}
	}
    }
    else if($bindicate == 3) {
    	echo "<span class=\"none\">".WORKERS_ALREADY_WORK_WAITING."</span>";
	if($session->goldclub == 1){
?>	</br>
<?php
	if($id <= 18) {
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf1.php?master=$bid&id=$id&time=$mastertime&c=$session->checker\">".CONSTRUCTING_MASTER_BUILDER." </a>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}else{
		echo "<span class=\"none\">".CONSTRUCTING_MASTER_BUILDER."</span>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}
	}else{
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime&c=$session->checker\">".CONSTRUCTING_MASTER_BUILDER." </a>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}else{
		echo "<span class=\"none\">".CONSTRUCTING_MASTER_BUILDER."</span>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}
	}
	}
    }
    else if($bindicate == 4) {
    	echo "<span class=\"none\">".ENOUGH_FOOD_EXPAND_CROPLAND."</span>";
    }
    else if($bindicate == 5) {
    	echo "<span class=\"none\">".UPGRADE_WAREHOUSE.".</span>";
    }
    else if($bindicate == 6) {
    	echo "<span class=\"none\">".UPGRADE_GRANARY.".</span>";
    }
    else if($bindicate == 7) {
	if($village->allcrop - $village->pop - $automation->getUpkeep($village->unitall, 0) > 0){
    	$neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
    	echo "<span class=\"none\">".ENOUGH_RESOURCES." ".$neededtime[0]." at  ".$neededtime[1]."</span>";
	}else{
		echo "<span class=\"none\">".YOUR_CROP_NEGATIVE."</span>";
	}
	if($session->goldclub == 1){
?>	</br>
<?php
	if($id <= 18) {
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf1.php?master=$bid&id=$id&time=$mastertime&c=$session->checker\">".CONSTRUCTING_MASTER_BUILDER." </a>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}else{
		echo "<span class=\"none\">".CONSTRUCTING_MASTER_BUILDER."</span>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}
	}else{
	if($session->gold >= 1 && $village->master == 0){
	    echo "<a class=\"build\" href=\"dorf2.php?master=$bid&id=$id&time=$mastertime&c=$session->checker\">".CONSTRUCTING_MASTER_BUILDER." </a>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}else{
		echo "<span class=\"none\">".CONSTRUCTING_MASTER_BUILDER."</span>";
		echo '<font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="Gold" title="'.GOLD.'"/>1)</font>';
	}
	}
	}
    }
    else if($bindicate == 8) {
		if($session->access==BANNED){
    	echo "<a class=\"build\" href=\"banned.php\">".UPGRADE_LEVEL." ";
		}
		else if($id <= 18) {
    	echo "<a class=\"build\" href=\"dorf1.php?a=$id&c=$session->checker\">".UPGRADE_LEVEL." ";
        }
        else {
        echo "<a class=\"build\" href=\"dorf2.php?a=$id&c=$session->checker\">".UPGRADE_LEVEL." ";
        }
		echo $village->resarray['f'.$id]+1;
		echo ".</a>";
		}
    else if($bindicate == 9) {
		if($session->access==BANNED){
    	echo "<a class=\"build\" href=\"banned.php\">".UPGRADE_LEVEL." ";
		}
    	else if($id <= 18) {
    	echo "<a class=\"build\" href=\"dorf1.php?a=$id&c=$session->checker\">".UPGRADE_LEVEL." ";
        }
        else {
        echo "<a class=\"build\" href=\"dorf2.php?a=$id&c=$session->checker\">".UPGRADE_LEVEL." ";
        }
		echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1);
		echo ".</a> <span class=\"none\">".WAITING."</span> ";
    }
}

?>
