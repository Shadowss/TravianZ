<?php
			$artefact = count($database->getOwnUniqueArtefactInfo2($session->uid,5,3,0));
			$artefact1 = count($database->getOwnUniqueArtefactInfo2($village->wid,5,1,1));
			$artefact2 = count($database->getOwnUniqueArtefactInfo2($session->uid,5,2,0));
			if($artefact > 0){
			$artefact_bonus = 2;
			$artefact_bonus2 = 1;
			}else if($artefact1 > 0){
			$artefact_bonus = 2;
			$artefact_bonus2 = 1;
			}else if($artefact2 > 0){
			$artefact_bonus = 4;
			$artefact_bonus2 = 3;
			}else{
			$artefact_bonus = 1;
			$artefact_bonus2 = 1;
			}
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       25_train.tpl                                                ##
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
<td><?php echo NAME; ?></td>
<td><?php echo QUANTITY; ?></td>
<td><?php echo MAX; ?></td>
</tr>
</thead>
<tbody>
<?php
		for ($i=($session->tribe-1)*10+9;$i<=($session->tribe*10);$i++) {
			if ($slots['settlers']>0 && $i%10==0 || $slots['chiefs']>0 && $i%10==9 && $session->tribe != 4) {
			       $maxunit = MIN($technology->maxUnit($i),($i%10==0?$slots['settlers']:$slots['chiefs']));

echo "<tr><td class=\"desc\">
<div class=\"tit\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a> <span class=\"info\">(".AVAILABLE.": ".$village->unitarray['u'.$i].")</span></div>
<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".${'u'.$i}['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".${'u'.$i}['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".${'u'.$i}['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".${'u'.$i}['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"".DURATION."\" />";
$dur=round(${'u'.$i}['time'] * ($bid25[$village->resarray['f'.$id]]['attri'] / 100) / SPEED * $artefact_bonus2 / $artefact_bonus);
					$foolartefact = $database->getFoolArtefactInfo(5,$village->wid,$session->uid);
					if(count($foolartefact) > 0){
					foreach($foolartefact as $arte){
					if($arte['bad_effect'] == 1){
					$dur *= $arte['effect2'];
					}else{
					$dur /= $arte['effect2'];
					$dur = round($dur);
					}
					}
					}
					$dur=$generator->getTimeFormat($dur);
echo ($dur=="0:00:00")? "0:00:01":$dur;
//-- If available resources combined are not enough, remove NPC button
$total_required = (int)(${'u'.$i}['wood'] + ${'u'.$i}['clay'] + ${'u'.$i}['iron'] + ${'u'.$i}['crop']);

if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
    echo "|<a href=\"build.php?gid=17&t=3&r1=".${'u'.$i}['wood']."&r2=".${'u'.$i}['clay']."&r3=".${'u'.$i}['iron']."&r4=".${'u'.$i}['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
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
		echo '<div class="c">'.RESIDENCE_TRAIN_DESC.'</div>';
	}
    include ("25_progress.tpl");
?>
