<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       troops.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<table id="troops" cellpadding="1" cellspacing="1">
<thead><tr>
	<th colspan="3"><?php echo TROOPS_DORF; ?></th>
</tr></thead><tbody>
<?php
$troops = $technology->getAllUnits($village->wid,True);
$TroopsPresent = False;
for($i=1;$i<=50;$i++) {
	if($troops['u'.$i] > 0) {
		echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" /></a></td>";
		echo "<td class=\"num\">".$troops['u'.$i]."</td><td class=\"un\">".$technology->getUnitName($i)."</td></tr>";
		$TroopsPresent = True;
	}
}
if($troops['hero'] > 0) {
		echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit uhero\" src=\"img/x.gif\" alt=\"Hero\" title=\"Hero\" /></a></td>";
		echo "<td class=\"num\">".$troops['hero']."</td><td class=\"un\">Hero</td></tr>";
		$TroopsPresent = True;
}
$units = $technology->getUnitList($village->wid);
if(!$TroopsPresent) {
	echo "<tr><td>none</td></tr>";
}
?>
	</tbody></table>
</div>
