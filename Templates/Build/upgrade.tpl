<?php
$bindicate = $building->canBuild($id,$village->resarray['f'.$id.'t']);
if($bindicate == 1) {
	echo "<p><span class=\"none\">".$lang['upgrade'][0]."</span></p>";
} else if($bindicate == 10) {
	echo "<p><span class=\"none\">".$lang['upgrade'][1]."</span></p>";
} else if($bindicate == 11) {
	echo "<p><span class=\"none\">".$lang['upgrade'][2]."</span></p>";
} else {
	$loopsame = ($building->isCurrent($id) || $building->isLoop($id))?1:0;
	$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))?1:0;
	$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
?>
<p id="contract"><?php echo $lang['upgrade'][3]; echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild; ?>:<br />
<img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" />&nbsp;<span class="little_res"><?php echo $uprequire['wood']; ?></span> | <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" />&nbsp;<span class="little_res"><?php echo $uprequire['clay']; ?></span> | <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />&nbsp;<span class="little_res"><?php echo $uprequire['iron']; ?></span> | <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />&nbsp;<span class="little_res"><?php echo $uprequire['crop']; ?></span> | <img class="r5" src="img/x.gif" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" />&nbsp;<?php echo $uprequire['pop']; ?> | <img class="clock" src="img/x.gif" alt="<?php echo DURATION ?>" title="<?php echo DURATION ?>" /><?php echo $generator->getTimeFormat($uprequire['time']); 
if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
    echo "|<a href=\"build.php?gid=17&t=3&r1=".$uprequire['wood']."&r2=".$uprequire['clay']."&r3=".$uprequire['iron']."&r4=".$uprequire['crop']."\" title=\"".$lang['npc'][0]."\"><img class=\"npc\" src=\"img/x.gif\" alt=\"".$lang['npc'][0]."\" title=\"".$lang['npc'][0]."\" /></a>";
                 } ?><br />
<?php
    if($bindicate == 2) {
   		echo "<span class=\"none\">".$lang['upgrade'][4]."</span>";
    }
    else if($bindicate == 3) {
    	echo "<span class=\"none\">".$lang['upgrade'][4]."&nbsp;".WAITING_LOOP."</span>";
    }
    else if($bindicate == 4) {
    	echo "<span class=\"none\">".$lang['upgrade'][5]."</span>";
    }
    else if($bindicate == 5) {
    	echo "<span class=\"none\">".$lang['upgrade'][6]."</span>";
    }
    else if($bindicate == 6) {
    	echo "<span class=\"none\">".$lang['upgrade'][7]."</span>";
    }
    else if($bindicate == 7) {
    	$neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],($loopsame > 0 ? 2:1));
    	echo "<span class=\"none\">".$lang['upgrade'][8].$neededtime[0].$lang['upgrade'][9].$neededtime[1]."</span>";
    }
    else if($bindicate == 8) {
		if($session->access==BANNED){
    	echo "<a class=\"build\" href=\"banned.php\">".$lang['upgrade'][10];
		}
		else if($id <= 18) {
    	echo "<a class=\"build\" href=\"dorf1.php?a=$id&c=$session->checker\">".$lang['upgrade'][10];
        }
        else {
        echo "<a class=\"build\" href=\"dorf2.php?a=$id&c=$session->checker\">".$lang['upgrade'][10];
        }
		echo $village->resarray['f'.$id]+1;
		echo ".</a>";
    }
    else if($bindicate == 9) {
		if($session->access==BANNED){
    	echo "<a class=\"build\" href=\"banned.php\">".$lang['upgrade'][10];
		}
    	else if($id <= 18) {
    	echo "<a class=\"build\" href=\"dorf1.php?a=$id&c=$session->checker\">".$lang['upgrade'][10];
        }
        else {
        echo "<a class=\"build\" href=\"dorf2.php?a=$id&c=$session->checker\">".$lang['upgrade'][10];
        }
		echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1);
		echo ".</a> <span class=\"none\">".WAITING_LOOP."</span> ";
    }
}

?>
