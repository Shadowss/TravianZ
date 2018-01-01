<table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
            <tr>
                <th colspan="2"><?php echo REVIVE; ?> <?php echo U0; ?></th>
            </tr>
        </thead>

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

	// check if there is a hero in revive already
	$reviving = false;
	$training = false;

	foreach ($heroes as $hero_datarow) {
		if ($hero_datarow['inrevive']) {
			$reviving = true;
		}

		if ($hero_datarow['intraining']) {
			$training = true;
		}
	}

	foreach ($heroes as $hero_datarow) {

    if($hero_datarow['unit'] == 1) {
        	$name = U1;
        } else if($hero_datarow['unit'] == 2) {
        	$name = U2;
        } else if($hero_datarow['unit'] == 3) {
        	$name = U3;
        } else if($hero_datarow['unit'] == 5) {
        	$name = U5;
        } else if($hero_datarow['unit'] == 6) {
        	$name = U6;
        } else if($hero_datarow['unit'] == 11) {
        	$name = U11;
        } else if($hero_datarow['unit'] == 12) {
        	$name = U12;
        } else if($hero_datarow['unit'] == 13) {
        	$name = U13;
        } else if($hero_datarow['unit'] == 15) {
        	$name = U15;
        } else if($hero_datarow['unit'] == 16) {
        	$name = U16;
        } else if($hero_datarow['unit'] == 21) {
        	$name = U21;
        } else if($hero_datarow['unit'] == 22) {
        	$name = U22;
        } else if($hero_datarow['unit'] == 24) {
        	$name = U24;
        } else if($hero_datarow['unit'] == 25) {
        	$name = U25;
        } else if($hero_datarow['unit'] == 26) {
        	$name = U26;
        }
        if($hero_datarow['level'] <= 60){
        $wood = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['wood']);
        $clay = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['clay']);
        $iron = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['iron']);
        $crop = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['crop']);
        $timeToTrain = round((${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus);
        $training_time = $generator->getTimeFormat($timeToTrain);
        $training_time2 = time() + $timeToTrain;
		}else{
        $wood = (${'h'.$hero_datarow['unit'].'_full'}[60]['wood']);
        $clay = (${'h'.$hero_datarow['unit'].'_full'}[60]['clay']);
        $iron = (${'h'.$hero_datarow['unit'].'_full'}[60]['iron']);
        $crop = (${'h'.$hero_datarow['unit'].'_full'}[60]['crop']);
        $timeToTrain = round((${'h'.$hero_datarow['unit'].'_full'}[60]['time']) / SPEED * $artefact_bonus2 / $artefact_bonus);
        $training_time = $generator->getTimeFormat($timeToTrain);
        $training_time2 = time() + $timeToTrain;
		}

	if($hero_datarow['inrevive'] == 1) {
    $timeleft = $generator->getTimeFormat($hero_datarow['trainingtime'] - time());
?>
    <table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>".HERO_READY." <span id=timer1>" . $timeleft . "</span></th></tr>"; ?>
            </tr>
        </thead>

            <tr>
			<?php
				   echo "<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u".$hero_datarow['unit']."\" src=\"img/x.gif\" alt=\"".$name."\" title=\"".$name."\" />
						$name ($name1)
					</div>"
			?>

            </tr>
    </table>
	<?php }else if (!$reviving) { if($hero_datarow['unit'] == 1 OR 11 OR 21){ ?>
        <tr>
                <td class="desc">
					<div class="tit">
						<img class="unit u<?php echo $hero_datarow['unit']; ?>" src="img/x.gif" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
						<?php echo $name . " (Level " . $hero_datarow['level'] . ")"; ?>
					</div>
					<div class="details">
						<img class="r1" src="img/x.gif" alt="Wood" title="<?php echo LUMBER; ?>" /><?php echo $wood; ?>|
                        <img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY; ?>" /><?php echo $clay; ?>|
                        <img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON; ?>" /><?php echo $iron; ?>|
                        <img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP; ?>" /><?php echo $crop; ?>|
                        <img class="r5" src="img/x.gif" alt="Crop consumption" title="<?php echo CROP_COM; ?>" />6|
                        <img class="clock" src="img/x.gif" alt="Duration" title="<?php echo DURATION; ?>" />
				        <?php echo $training_time; ?>
				        <?php
                            //-- If available resources combined are not enough, remove NPC button
                            $total_required = (int)($wood + $clay + $iron + $crop);
                            if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
                   				echo "|<a href=\"build.php?gid=17&t=3&r1=".$wood."&r2=".$clay."&r3=".$iron."&r4=".$crop."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 			}
				        ?>
                    </div>
				</td>

                <td class="val" width="20%"><center>
                <?php
                if($village->awood < $wood OR $village->aclay < $clay OR $village->airon < $iron OR $village->acrop < $crop) {
                    echo "<span class=\"none\">".NOT."".ENOUGH_RESOURCES."</span>";
                }else {
                    echo "<a href=\"build.php?id=".$id."&amp;revive=1&amp;hid=".$hero_datarow['heroid']."\">".REVIVE."</a>";
                }

                ?></center></td>
            </tr>
        <?php }else { ?>


    <?php if($database->checkIfResearched($village->wid, 't'.$hero_datarow['unit']) != 0){ ?>
        <tr>
                <td class="desc">
					<div class="tit">
						<img class="unit u<?php echo $hero_datarow['unit']; ?>" src="img/x.gif" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
						<?php echo $name . " (Level " . $hero_datarow['level'] . ")"; ?>
					</div>
					<div class="details">
						<img class="r1" src="img/x.gif" alt="Wood" title="<?php echo LUMBER; ?>" /><?php echo $wood; ?>|
                        <img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY; ?>" /><?php echo $clay; ?>|
                        <img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON; ?>" /><?php echo $iron; ?>|
                        <img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP; ?>" /><?php echo $crop; ?>|
                        <img class="r5" src="img/x.gif" alt="Crop consumption" title="<?php echo CROP_COM; ?>" />6|
                        <img class="clock" src="img/x.gif" alt="Duration" title="<?php echo DURATION; ?>" />
				        <?php echo $training_time; ?>
				        <?php
                            //-- If available resources combined are not enough, remove NPC button
                            $total_required = (int)($wood + $clay + $iron + $crop);
                            if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
                   				echo "|<a href=\"build.php?gid=17&t=3&r1=".$wood."&r2=".$clay."&r3=".$iron."&r4=".$crop."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 			}
				        ?>
                    </div>
				</td>

                <td class="val" width="20%"><center>
                <?php
                if($village->awood < $wood OR $village->aclay < $clay OR $village->airon < $iron OR $village->acrop < $crop) {
                    echo "<span class=\"none\">".NOT."".ENOUGH_RESOURCES."</span>";
                }else {
                    echo "<a href=\"build.php?id=".$id."&amp;revive=1&amp;hid=".$hero_datarow['heroid']."\">".REVIVE."</a>";
                }

                ?>
                </center></td>
            </tr>
        <?php }
        }
    }

	if(isset($_GET['revive']) && $_GET['revive'] == 1 && isset($_GET['hid']) && $_GET['hid'] == $hero_datarow['heroid'] && $hero_datarow['inrevive'] == 0 && $hero_datarow['intraining'] == 0 && $hero_datarow['dead'] == 1){
		if($session->access != BANNED){
            mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."hero SET `inrevive` = '1', `trainingtime` = '".(int) $training_time2."', `wref` = '".(int) $village->wid."' WHERE `heroid` = ".(int) $_GET['hid']." AND `uid` = '".(int) $session->uid."'");
			mysqli_query($GLOBALS['link'],"
			    UPDATE " . TB_PREFIX . "vdata
			        SET
			            `wood` = `wood` - ".(int) $wood.",
			            `clay` = `clay` - ".(int) $clay.",
			            `iron` = `iron` - ".(int) $iron .",
			            `crop` = `crop` - ".(int) $crop."
                    WHERE
                        `wref` = '" . (int) $village->wid . "'");
            header("Location: build.php?id=".$id."");
			exit;
		} else {
			header("Location: banned.php");
			exit;
		}
    }

    }
?>

</table>


    <?php
	if(!$reviving && !$training) {
            include ("37_train.tpl");
	}
    ?>