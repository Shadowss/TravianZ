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
/*-------------------------------------------------------*\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Developed by:  Manni < manuel_mannhardt@web.de >        |
|                Dzoki < dzoki.travian@gmail.com >        |
| Copyright:     TravianX Project All rights reserved     |
\*-------------------------------------------------------*/
    
    if($hero_info['unit'] == 1) {
        	$name = "Legionnaire";
        } else if($hero_info['unit'] == 2) {
        	$name = "Praetorian";
        } else if($hero_info['unit'] == 3) {
        	$name = "Imperian";
        } else if($hero_info['unit'] == 5) {
        	$name = "Equites Imperatoris";
        } else if($hero_info['unit'] == 6) {
        	$name = "Equites Caesaris";
        } else if($hero_info['unit'] == 11) {
        	$name = "Clubswinger";
        } else if($hero_info['unit'] == 12) {
        	$name = "Spearman";
        } else if($hero_info['unit'] == 13) {
        	$name = "Axeman";
        } else if($hero_info['unit'] == 15) {
        	$name = "Paladin";
        } else if($hero_info['unit'] == 16) {
        	$name = "Teutonic Knight";
        } else if($hero_info['unit'] == 21) {
        	$name = "Phalanx";
        } else if($hero_info['unit'] == 22) {
        	$name = "Swordsman";
        } else if($hero_info['unit'] == 24) {
        	$name = "Theutates Thunder";
        } else if($hero_info['unit'] == 25) {
        	$name = "Druidrider";
        } else if($hero_info['unit'] == 26) {
        	$name = "Haeduan";
        }
        if($hero_info['level'] <= 60){
        $wood = (${'h'.$hero_info['unit'].'_full'}[$hero_info['level']]['wood']);
        $clay = (${'h'.$hero_info['unit'].'_full'}[$hero_info['level']]['clay']);
        $iron = (${'h'.$hero_info['unit'].'_full'}[$hero_info['level']]['iron']);
        $crop = (${'h'.$hero_info['unit'].'_full'}[$hero_info['level']]['crop']);
        $training_time = $generator->getTimeFormat(round((${'h'.$hero_info['unit'].'_full'}[$hero_info['level']]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus));
        $training_time2 = time() + round((${'h'.$hero_info['unit'].'_full'}[$hero_info['level']]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus);
		}else{
        $wood = (${'h'.$hero_info['unit'].'_full'}[60]['wood']);
        $clay = (${'h'.$hero_info['unit'].'_full'}[60]['clay']);
        $iron = (${'h'.$hero_info['unit'].'_full'}[60]['iron']);
        $crop = (${'h'.$hero_info['unit'].'_full'}[60]['crop']);
        $training_time = $generator->getTimeFormat(round((${'h'.$hero_info['unit'].'_full'}[60]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus));
        $training_time2 = time() + round((${'h'.$hero_info['unit'].'_full'}[60]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus);
		}
?>

    <table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
            <tr>
                <th colspan="2">Revive hero</th>
            </tr>
        </thead>
    
    <?php
	if($hero_info['inrevive'] == 1) {
    $timeleft = $generator->getTimeFormat($hero_info['trainingtime'] - time());
                
?>
    <table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>Hero will be ready in <span id=timer1>" . $timeleft . "</span></th></tr>"; ?>
            </tr>
        </thead>
            
            <tr>
			<?php
				   echo "<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u".$hero_info['unit']."\" src=\"img/x.gif\" alt=\"".$name."\" title=\"".$name."\" />
						$name ($name1)
					</div>"
			?>
			
            </tr>
    </table>
	<?php }else{ if($hero_info['unit'] == 1 OR 11 OR 21){ ?>
        <tr>
                <td class="desc">
					<div class="tit">
						<img class="unit u<?php echo $hero_info['unit']; ?>" src="img/x.gif" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
						<?php echo $name . " (Level " . $hero_info['level'] . ")"; ?>
					</div>
					<div class="details">
						<img class="r1" src="img/x.gif" alt="Wood" title="Wood" /><?php echo $wood; ?>|
                        <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><?php echo $clay; ?>|
                        <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><?php echo $iron; ?>|
                        <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><?php echo $crop; ?>|
                        <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" />6|
                        <img class="clock" src="img/x.gif" alt="Duration" title="Duration" />
				        <?php echo $training_time; ?>
                    </div>
				</td>
				
                <td class="val" width="20%"><center>
                <?php
                if($village->awood < $wood OR $village->aclay < $clay OR $village->airon < $iron OR $village->acrop < $crop) {
                    echo "<span class=\"none\">No enough resources</span>";
                }else {
                    echo "<a href=\"build.php?id=".$id."&revive=1\">Revive</a>";
                }
                
                ?></center></td>
            </tr>
        <?php }else { ?>
        
        
    <?php if($database->checkIfResearched($village->wid, 't'.$hero_info['unit']) != 0){ ?>
        <tr>
                <td class="desc">
					<div class="tit">
						<img class="unit u<?php echo $hero_info['unit']; ?>" src="img/x.gif" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
						<?php echo $name . " (Level " . $hero_info['level'] . ")"; ?>
					</div>
					<div class="details">
						<img class="r1" src="img/x.gif" alt="Wood" title="Wood" /><?php echo $wood; ?>|
                        <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><?php echo $clay; ?>|
                        <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><?php echo $iron; ?>|
                        <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><?php echo $crop; ?>|
                        <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" />6|
                        <img class="clock" src="img/x.gif" alt="Duration" title="Duration" />
				        <?php echo $training_time; ?>
                    </div>
				</td>
				
                <td class="val" width="20%"><center>
                <?php
                if($village->awood < $wood OR $village->aclay < $clay OR $village->airon < $iron OR $village->acrop < $crop) {
                    echo "<span class=\"none\">No enough resources</span>";
                }else {
                    echo "<a href=\"build.php?id=".$id."&revive=1\">Revive</a>";
                }
                
                ?>
                </center></td>
            </tr>
        <?php } }} ?>
        
</table>


    <?php
    
    if($_GET['revive'] == 1 && $hero_info['inrevive'] == 0 && $hero_info['intraining'] == 0 && $hero_info['dead'] == 1){
			if($session->access != BANNED){
            mysql_query("UPDATE ".TB_PREFIX."hero SET `inrevive` = '1', `trainingtime` = '".$training_time2."', `wref` = '".$village->wid."' WHERE `uid` = '".$session->uid."'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$wood." WHERE `wref` = '" . $village->wid . "'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$clay." WHERE `wref` = '" . $village->wid . "'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$iron." WHERE `wref` = '" . $village->wid . "'");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$crop." WHERE `wref` = '" . $village->wid . "'");
            header("Location: build.php?id=".$id."");
			}else{
			header("Location: banned.php"); 
			}
    }
	if($hero_info['inrevive'] == 0 && $hero_info['intraining'] == 0) {
            include ("37_train.tpl");
	}
    ?>