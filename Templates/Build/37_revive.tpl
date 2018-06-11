<table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
            <tr>
                <th colspan="2"><?php echo REVIVE; ?> <?php echo U0; ?></th>
            </tr>
        </thead>

<?php
/*-------------------------------------------------------*\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Developed by:  Manni < manuel_mannhardt@web.de >        |
|                Dzoki < dzoki.travian@gmail.com >        |
| Copyright:     TravianX Project All rights reserved     |
\*-------------------------------------------------------*/

	// check if there is a hero in revive already
	$reviving = $training = false;
	
	foreach ($heroes as $hero_datarow) {
	    if ($hero_datarow['inrevive']) $reviving = true;
	    if ($hero_datarow['intraining']) $training = true;
	    
	    $name = $technology->getUnitName($hero_datarow['unit']);
	    
	    if($hero_datarow['level'] <= 60){
	        $wood = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['wood']);
	        $clay = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['clay']);
	        $iron = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['iron']);
	        $crop = (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['crop']);
	        $timeToTrain = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, (${'h'.$hero_datarow['unit'].'_full'}[$hero_datarow['level']]['time']) / SPEED);
	        $training_time = $generator->getTimeFormat($timeToTrain);
	        $training_time2 = time() + $timeToTrain;
	    }else{
	        $wood = (${'h'.$hero_datarow['unit'].'_full'}[60]['wood']);
	        $clay = (${'h'.$hero_datarow['unit'].'_full'}[60]['clay']);
	        $iron = (${'h'.$hero_datarow['unit'].'_full'}[60]['iron']);
	        $crop = (${'h'.$hero_datarow['unit'].'_full'}[60]['crop']);
	        $timeToTrain = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, (${'h'.$hero_datarow['unit'].'_full'}[60]['time']) / SPEED);
	        $training_time = $generator->getTimeFormat($timeToTrain);
	        $training_time2 = time() + $timeToTrain;
	    }
	    
	    if($hero_datarow['inrevive'] == 1) {
	        $timeleft = $generator->getTimeFormat($hero_datarow['trainingtime'] - time());
	        ?>
    	<table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>".HERO_READY." <span id=timer".++$session->timer.">".$timeleft."</span></th></tr>"; ?>
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
	<?php }else if (!$reviving) if(in_array($hero_datarow['unit'], [1, 11, 21])){ ?>
        <tr>
                <td class="desc">
					<div class="tit">
						<img class="unit u<?php echo $hero_datarow['unit']; ?>" src="img/x.gif" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
						<?php echo $name." (Level ".$hero_datarow['level'].")"; ?>
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

                <td class="val" width="20%" style="text-align: center">
                <?php
                if($village->awood < $wood || $village->aclay < $clay || $village->airon < $iron || $village->acrop < $crop) {
                    echo "<span class=\"none\">".NOT."".ENOUGH_RESOURCES."</span>";
                }else {
                    echo "<a href=\"build.php?id=".$id."&amp;revive=1&amp;hid=".$hero_datarow['heroid']."\">".REVIVE."</a>";
                }

                ?></td>
            </tr>
        <?php }else { ?>


    <?php if($database->checkIfResearched($village->wid, 't'.$hero_datarow['unit']) != 0){ ?>
        <tr>
                <td class="desc">
					<div class="tit">
						<img class="unit u<?php echo $hero_datarow['unit']; ?>" src="img/x.gif" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
						<?php echo $name." (Level ".$hero_datarow['level'].")"; ?>
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

                <td class="val" width="20%" style="text-align: center">
                <?php
                if($village->awood < $wood || $village->aclay < $clay || $village->airon < $iron || $village->acrop < $crop) {
                    echo "<span class=\"none\">".NOT."".ENOUGH_RESOURCES."</span>";
                }else {
                    echo "<a href=\"build.php?id=".$id."&amp;revive=1&amp;hid=".$hero_datarow['heroid']."\">".REVIVE."</a>";
                }

                ?>
                </td>
            </tr>
        <?php }
        }
        
        if(isset($_GET['revive']) && $_GET['revive'] == 1 && isset($_GET['hid']) && $_GET['hid'] == $hero_datarow['heroid'] && $hero_datarow['inrevive'] == 0 && $hero_datarow['intraining'] == 0 && $hero_datarow['dead'] == 1){
            mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."hero SET `inrevive` = '1', `trainingtime` = '".(int) $training_time2."', `wref` = '".(int) $village->wid."' WHERE `heroid` = ".(int) $_GET['hid']." AND `uid` = '".(int) $session->uid."'");
            $database->modifyResource($village->wid, $wood, $clay, $iron, $crop, 0);
            header("Location: build.php?id=".$id."");
            exit;
        }
    }
?>

</table><br />


    <?php
    if(!$reviving && !$training) include ("37_train.tpl");
    ?>