<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       26_train.tpl                                                ##
##  Made by:       Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

	$slots = $database->getAvailableExpansionTraining();

	if ($slots['settlers']+$slots['chiefs']>0) { ?>

<form method="POST" name="snd" action="build.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="ft" value="t1" />

<table cellpadding="1" cellspacing="1" class="build_details">
<thead>
<tr>
<td>Name</td>
<td>Quantity</td>
<td>Max</td>
</tr>
</thead>
<tbody>
<?php
		for ($i=($session->tribe-1)*10+9;$i<=($session->tribe*10);$i++) {
			if ($slots['settlers']>0 && $i%10==0 || $slots['chiefs']>0 && $i%10==9) {
			       $maxunit = MIN($technology->maxUnit($i),($i%10==0?$slots['settlers']:$slots['chiefs']));

echo "<tr><td class=\"desc\">
<div class=\"tit\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a> <span class=\"info\">(Available: ".$village->unitarray['u'.$i].")</span></div>
<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".${'u'.$i}['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".${'u'.$i}['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".${'u'.$i}['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".${'u'.$i}['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"duration\" />";
echo $generator->getTimeFormat(round(${'u'.$i}['time'] * ($bid26[$village->resarray['f'.$id]]['attri'] / 100) / SPEED));

				if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) > 1) {
echo "|<a href=\"build.php?gid=17&t=3&r1=".${'r'.$i}['wood']."&r2=".${'r'.$i}['clay']."&r3=".${'r'.$i}['iron']."&r4=".${'r'.$i}['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
				}
echo "<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"4\"></td>
<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t".$i.".value=".$maxunit."; return false;\">(".$maxunit.")</a></td></tr></tbody>";
			}
		} ?>
</div>
</tbody>
</table>
<p>
<input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" />
</p>
</form>
<?php
	} else {
		echo '<div class="c">In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.</div>';
	}
    include ("26_progress.tpl");
?>
