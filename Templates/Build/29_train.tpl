<?php
// 29_train.tpl - GREATBARRACKS TRAIN
global $session, $technology, $village, $database, $building, $bid29, $generator, $id;

$start = ($session->tribe - 1) * 10 + 1;
$end = ($session->tribe - 1) * 10 + 4;
$level = (int)$village->resarray['f'.$id];

for ($i = $start; $i <= $end; $i++):
    if ($i == 4 || $i == 23 || $i == 24) continue;
    if (!($technology->getTech($i) || $i % 10 == 1)) continue;

    $unit = ${'u'.$i};
    $costWood = (int)$unit['wood'] * 3;
    $costClay = (int)$unit['clay'] * 3;
    $costIron = (int)$unit['iron'] * 3;
    $costCrop = (int)$unit['crop'] * 3;
    $pop = (int)$unit['pop'];
    $available = (int)$village->unitarray['u'.$i];
    $max = $technology->maxUnit($i, true);
    $maxPlus = $technology->maxUnitPlus($i);
    $time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, round($unit['time'] * ($bid29[$level]['attri'] / 100) / SPEED));
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
            |<a href="build.php?gid=17&t=3&r1=<?php echo $costWood/3*$maxPlus;?>&r2=<?php echo $costClay/3*$maxPlus;?>&r3=<?php echo $costIron/3*$maxPlus;?>&r4=<?php echo $costCrop/3*$maxPlus;?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" /></a>
            <?php endif;?>
        </div>
    </td>
    <td class="val"><input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="10"></td>
    <td class="max"><a href="#" onClick="document.snd.t<?php echo $i;?>.value=<?php echo $max;?>; return false;">(<?php echo $max;?>)</a></td>
</tr>
<?php endfor;?>