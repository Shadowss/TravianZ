<?php
// 19_train.tpl - UNIT LIST BARRAKS
global $session, $technology, $village, $database, $generator, $building, $bid19, $id;

$tribe = (int)$session->tribe;
$units = ($tribe !== 4) ? range(($tribe-1)*10+1, ($tribe-1)*10+4) : range(31, 40);

foreach ($units as $i) {
    // skip unități invalide
    if ($tribe !== 4 && ($i == 4 || $i == 23 || $i == 24)) continue;
    if (!($technology->getTech($i) || $i % 10 == 1)) continue;

    $unitData = ${'u'.$i};
    $name = $technology->getUnitName($i);
    $maxTrain = $technology->maxUnit($i, false);
    $maxPlus = $technology->maxUnitPlus($i);
    $available = (int)($village->unitarray['u'.$i] ?? 0);

    $dur = $database->getArtifactsValueInfluence(
        $session->uid,
        $village->wid,
        5,
        round($unitData['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED)
    );
    $timeFormatted = $generator->getTimeFormat($dur);

    $total_required = (int)($unitData['wood'] + $unitData['clay'] + $unitData['iron'] + $unitData['crop']);
    $showNpc = $session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required;
?>
<tr>
    <td class="desc">
        <div class="tit">
            <img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo htmlspecialchars($name);?>" title="<?php echo htmlspecialchars($name);?>" />
            <a href="#" onClick="return Popup(<?php echo $i;?>,1);"><?php echo htmlspecialchars($name);?></a>
            <span class="info">(<?php echo AVAILABLE;?>: <?php echo $available;?>)</span>
        </div>
        <div class="details">
            <img class="r1" src="img/x.gif" alt="<?php echo TZ_WOOD; ?>" title="<?php echo LUMBER;?>" /><?php echo (int)$unitData['wood'];?>|
            <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY;?>" /><?php echo (int)$unitData['clay'];?>|
            <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON;?>" /><?php echo (int)$unitData['iron'];?>|
            <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP;?>" /><?php echo (int)$unitData['crop'];?>|
            <img class="r5" src="img/x.gif" alt="Crop consumption" title="<?php echo CROP_COM;?>" /><?php echo (int)$unitData['pop'];?>|
            <img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION;?>" /><?php echo $timeFormatted;?>
            <?php if ($showNpc):?>
                |<a href="build.php?gid=17&t=3&r1=<?php echo (int)$unitData['wood']*$maxPlus;?>&r2=<?php echo (int)$unitData['clay']*$maxPlus;?>&r3=<?php echo (int)$unitData['iron']*$maxPlus;?>&r4=<?php echo (int)$unitData['crop']*$maxPlus;?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" title="<?php echo NPC_TRADE; ?>" /></a>
            <?php endif;?>
        </div>
    </td>
    <td class="val"><input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="10"></td>
    <td class="max"><a href="#" onClick="document.snd.t<?php echo $i;?>.value=<?php echo $maxTrain;?>; return false;">(<?php echo $maxTrain;?>)</a></td>
</tr>
<?php } ?>