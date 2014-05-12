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

<div id="build" class="gid40"><a href="#" onClick="return Popup(40,4);" class="build_logo">
	<img class="building g40" src="img/x.gif" alt="World Wonder" title="<?php echo WORLD_WONDER;?>" />
</a>
<h1><?php echo WONDER;?> <br /><span class="level"><?php echo LEVEL;?> <?php echo $village->resarray['f'.$id];?></span></h1>
<p class="build_desc"><?php echo WONDER_DESC;?></p>
<form action="GameEngine/Game/WorldWonderName.php" method="POST">
<input type="hidden" name="vref" value="<?php echo $_SESSION['wid']; ?>" />
<?php
$vref = $_SESSION['wid'];
$wwname = $database->getWWName($vref);

if($village->resarray['f'.$id] < 0){
echo ''.WORLD_WONDER_CHANGE_NAME.'.
			<center><br />'.WORLD_WONDER_NAME.': <input class="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>';
} else if($village->resarray['f'.$id] > 0 and $village->resarray['f'.$id] < 11) {
echo '<center><br />'.WORLD_WONDER_NAME.': <input class="text" name="wwname" id="wwname" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>'; 
} else if ($village->resarray['f'.$id] > 10){
echo ''.WORLD_WONDER_NOTCHANGE_NAME.'.
			<center><br />'.WORLD_WONDER_NAME.': <input class="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>';
}?>
    </form>
	<?php
    if(isset($_GET['n'])) {
		echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Red"><b>'.WORLD_WONDER_NAME_CHANGED.'.</b></font>';
		  }
		  ?>

<?php
include("wwupgrade.tpl");
?>
</p></div>
