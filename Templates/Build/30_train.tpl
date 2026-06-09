<?php
// 30_train.tpl - GREATSTABLE TRAIN
global $session, $technology, $village, $database, $building, $bid30, $bid41, $generator, $id;

$start = ($session->tribe - 1) * 10 + 3;
$end = ($session->tribe - 1) * 10 + 6;
$level = (int)$village->resarray['f'.$id];
$horseDrinking = $building->getTypeLevel(41);
$success = 0;

for ($i = $start; $i <= $end; $i++):
    if ($i == 3 || $i == 13 || $i == 14) continue;
    if (!$technology->getTech($i)) continue;
    $success++;

    $unit = ${'u'.$i};
    $costWood = (int)$unit['wood'] * 3;
    $costClay = (int)$unit['clay'] * 3;
    $costIron = (int)$unit['iron'] * 3;
    $costCrop = (int)$unit['crop'] * 3;
    $pop = (int)$unit['pop'] - ($horseDrinking >= 1 ? 1 : 0);
    $available = (int)$village->unitarray['u'.$i];
    $max = $technology->maxUnit($i, true);
    $maxPlus = $technology->maxUnitPlus($i);

    $speedMod = $bid30[$level]['attri'] / 100;
    if ($horseDrinking >= 1) $speedMod *= (1 / $bid41[$horseDrinking]['attri']);
    $time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, round($unit['time'] * $speedMod / SPEED));

    $totalRequired = (int)($unit['wood'] + $unit['clay'] + $unit['iron'] + $unit['crop']);
    $showNpc = $session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $totalRequired;
?>
<tr>
    <td class="desc">
        <div class="tit">
            <img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo $technology->getUnitName($i);?>" title="<?php echo $technology->getUnitName($i);?>" />
            <a href="#" onClick="return Popup(<?php echo $i;?>,1);"><?php echo $technology->getUnitName($i);?></a>
            <span class="info">(<?php echo AVAILABLE;?>: <?php echo $available;?>)</span>
        </div>
        <div class="details">
            <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/><?php echo $costWood;?>|
            <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/><?php echo $costClay;?>|
            <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/><?php echo $costIron;?>|
            <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/><?php echo $costCrop;?>|
            <img class="r5" src="img/x.gif" title="<?php echo CROP_COM;?>"/><?php echo $pop;?>|
            <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $generator->getTimeFormat($time);?>
            <?php if ($showNpc):?>
            |<a href="build.php?gid=17&t=3&r1=<?php echo $unit['wood']*$maxPlus;?>&r2=<?php echo $unit['clay']*$maxPlus;?>&r3=<?php echo $unit['iron']*$maxPlus;?>&r4=<?php echo $unit['crop']*$maxPlus;?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" /></a>
            <?php endif;?>
        </div>
    </td>
    <td class="val"><input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="10"></td>
    <td class="max"><a href="#" onClick="document.snd.t<?php echo $i;?>.value=<?php echo $max;?>; return false;">(<?php echo $max;?>)</a></td>
</tr>
<?php endfor; if ($success == 0):?>
<tr><td colspan="3"><div class="none" align="center"><?php echo AVAILABLE_ACADEMY;?></div></td></tr>
<?php endif;?>