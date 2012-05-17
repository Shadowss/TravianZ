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
	<img class="building g40" src="img/x.gif" alt="World Wonder" title="World Wonder" />
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
include("wwupgrade.tpl");
?>
</p></div>