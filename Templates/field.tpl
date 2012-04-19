<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       field.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
//Load default array position
$coorarray = array(1=>"101,33,28","165,32,28","224,46,28","46,63,28","138,74,28","203,94,28","262,86,28","31,117,28","83,110,28","214,142,28","269,146,28","42,171,28","93,164,28","160,184,28","239,199,28","87,217,28","140,231,28","190,232,28");

//Load level & type
$arrayVillage = $village->resarray;
?>
<map name="rx" id="rx">
<?php 
for($i=1;$i<=18;$i++) {echo "	<area href=\"build.php?id=$i\" coords=\"$coorarray[$i]\" shape=\"circle\" title=\"".$building->procResType($arrayVillage['f'.$i.'t'])." Level ".$arrayVillage['f'.$i]."\"/>\r\n";
}
?>
	<area href="dorf2.php" coords="144,131,36" shape="circle" title="Village centre" alt="" />
</map>

<div id="village_map" class="f<?php echo $village->type; ?>">
<?php 
for($i=1;$i<=18;$i++) {
	if($arrayVillage['f'.$i.'t'] != 0) {
		$text = "";
		switch($i){
			case 1:$text = "Woodcutter Level";break;
			case 2:$text = "Clay Pit Level";break;
			case 3:$text = "Iron Mine Level";break;
			case 4:$text = "Cropland Level";break;
		}
		echo "<img src=\"img/x.gif\" class=\"reslevel rf$i level".$arrayVillage['f'.$i]."\" alt=\"$text ".$arrayVillage['f'.$i]."\" />";
	}
}
?>
	<img id="resfeld" usemap="#rx" src="img/x.gif" alt="" />
</div>