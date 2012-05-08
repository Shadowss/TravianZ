<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       ww.tpl                                                      ##
##  Developed by:  Dixie                                                       ##
##  Edited by:     Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
	$loopsame = ($building->isCurrent($id) || $building->isLoop($id))?1:0;
	$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))?1:0;
?>

<div id="build" class="gid40"><a href="#" onClick="return Popup(5,4);" class="build_logo">
	<img class="building g40" src="img/x.gif" alt="Sawmill" title="Sawmill" />
</a>
<h1>Wonder of the World <br /><span class="level">Level <?php echo $village->resarray['f'.$id];?></span></h1>
<p class="build_desc">The World Wonder (otherwise known as a Wonder of the World) is as wonderful as it sounds. "This building" is built in order to win the server. Each level of the World Wonder costs hundreds of thousands (even millions) of resources to build.</p>
<form action="GameEngine/Game/WorldWonderName.php" method="POST">
<input type="hidden" name="vref" value="<?php echo $_SESSION['wid']; ?>" />
<?php
$vref = $_SESSION['wid'];
$wwname = $database->getWWName($vref);

if($village->resarray['f'.$id] < 0){
echo 'You need to have World Wonder level 1 to be able to change its name.
			<center><br />World Wonder name: <input class="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>';
} else if($village->resarray['f'.$id] > 0 and $village->resarray['f'.$id] < 11) {
echo '<center><br />World Wonder name: <input class="text" name="wwname" id="wwname" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>'; 
} else if ($village->resarray['f'.$id] > 10){
echo 'You can not change the name of the World Wonder after level 10.
			<center><br />World Wonder name: <input class="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>';
}?>
    </form>
	<?php
    if(isset($_GET['n'])) {
		echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Red"><b>Name changed.</b></font>';
		  }
		  ?>

<?php
$bindicate = $building->canBuild($id,$village->resarray['f'.$id.'t']);
if($village->resarray['f'.$id] == 100) {
	echo "<p><span class=\"none\">Building already at max level</span></p>";
}
else {
$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
?>
<p id="contract"><b>Costs</b> for upgrading to level <?php echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild; ?>:<br />
<img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /><span class="little_res"><?php echo $uprequire['wood']; ?></span> | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><span class="little_res"><?php echo $uprequire['clay']; ?></span> | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><span class="little_res"><?php echo $uprequire['iron']; ?></span> | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><span class="little_res"><?php echo $uprequire['crop']; ?></span> | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /><?php echo $uprequire['pop']; ?> | <img class="clock" src="img/x.gif" alt="duration" title="duration" /><?php echo $generator->getTimeFormat($uprequire['time']); 
if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=".$uprequire['wood']."&r2=".$uprequire['clay']."&r3=".$uprequire['iron']."&r4=".$uprequire['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 } ?><br />
<?php
    if($bindicate == 2) {
   		echo "<span class=\"none\">The workers are already at work.</span>";
    }
    else if($bindicate == 3) {
    	echo "<span class=\"none\">The workers are already at work. (waiting loop)</span>";
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
    	$neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id]);
    	echo "<span class=\"none\">Enough resources ".$neededtime[0]." at  ".$neededtime[1]."</span>";
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
		echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild;
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
		echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild;
		echo ".</a> <span class=\"none\">(waiting loop)</span> ";
    }
}

?>
</p></div>