<?php
// 42_train.tpl - 
global $session, $technology, $village, $generator, $database, $building, $bid42, $id;

$success = 0;
$start = ($session->tribe - 1) * 10 + 7;
$end = $start + 1; // ram + catapult

for ($i = $start; $i <= $end; $i++) {
    if (!$technology->getTech($i)) continue;
    $success++;

    $unit = ${'u'.$i};
    $name = $technology->getUnitName($i);
    $wood = $unit['wood'] * 3;
    $clay = $unit['clay'] * 3;
    $iron = $unit['iron'] * 3;
    $crop = $unit['crop'] * 3;
    $pop  = $unit['pop'];

    $dur = $database->getArtifactsValueInfluence(
        $session->uid, $village->wid, 5,
        round($unit['time'] * ($bid42[$village->resarray['f'.$id]]['attri'] / 100) / SPEED)
    );
    $max = $technology->maxUnit($i, true);
?>
<tr>
    <td class="desc">
        <div class="tit">
            <img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo $name;?>" title="<?php echo $name;?>" />
            <a href="#" onClick="return Popup(<?php echo $i;?>,1);"><?php echo $name;?></a>
            <span class="info">(<?php echo AVAILABLE;?>: <?php echo (int)$village->unitarray['u'.$i];?>)</span>
        </div>
        <div class="details">
            <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/><?php echo $wood;?>|
            <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/><?php echo $clay;?>|
            <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/><?php echo $iron;?>|
            <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/><?php echo $crop;?>|
            <img class="r5" src="img/x.gif" title="<?php echo CROP_COM;?>"/><?php echo $pop;?>|
            <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $generator->getTimeFormat($dur);?>
            <?php
            $total_required = $unit['wood'] + $unit['clay'] + $unit['iron'] + $unit['crop'];
            if ($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required):
                $r1 = $unit['wood'] * $technology->maxUnitPlus($i);
                $r2 = $unit['clay'] * $technology->maxUnitPlus($i);
                $r3 = $unit['iron'] * $technology->maxUnitPlus($i);
                $r4 = $unit['crop'] * $technology->maxUnitPlus($i);
            ?>
            |<a href="build.php?gid=17&t=3&r1=<?php echo $r1;?>&r2=<?php echo $r2;?>&r3=<?php echo $r3;?>&r4=<?php echo $r4;?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" /></a>
            <?php endif;?>
        </div>
    </td>
    <td class="val"><input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="4"></td>
    <td class="max"><a href="#" onClick="document.snd.t<?php echo $i;?>.value=<?php echo $max;?>; return false;">(<?php echo $max;?>)</a></td>
</tr>
<?php
}

if ($success == 0): ?>
<tr><td colspan="3"><div class="none" align="center"><?php echo AVAILABLE_ACADEMY;?></div></td></tr>
<?php endif; ?>