<?php
// 26_train.tpl - PALACE / Antrenare coloniști și șefi
global $database, $session, $village, $technology, $generator, $building, $bid26, $id;

$slots = $database->getAvailableExpansionTraining();
$totalSlots = ($slots['settlers'] ?? 0) + ($slots['chiefs'] ?? 0);

if ($totalSlots > 0): ?>
<form method="POST" name="snd" action="build.php">
    <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
    <input type="hidden" name="ft" value="t1" />

    <table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
            <tr>
                <td><?php echo NAME;?></td>
                <td><?php echo QUANTITY;?></td>
                <td><?php echo MAX;?></td>
            </tr>
        </thead>
        <tbody>
        <?php
        $start = ($session->tribe - 1) * 10 + 9;
        $end = $session->tribe * 10;
        
        for ($i = $start; $i <= $end; $i++):
            $isSettler = ($i % 10 === 0);
            $isChief = ($i % 10 === 9 && $session->tribe != 4);
            
            if (($isSettler && $slots['settlers'] > 0) || ($isChief && $slots['chiefs'] > 0)):
                $unitName = $technology->getUnitName($i);
                $costs = $GLOBALS['u'.$i];
                $maxByTech = $technology->maxUnit($i);
                $slotLimit = $isSettler ? $slots['settlers'] : $slots['chiefs'];
                $maxUnit = min($maxByTech, $slotLimit);
                $available = (int)($village->unitarray['u'.$i] ?? 0);
                
                // timp cu bonus palat și artefacte
                $baseTime = $costs['time'] * ($bid26[$village->resarray['f'.$id]]['attri'] / 100) / SPEED;
                $duration = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, round($baseTime));
                
                $totalRequired = $costs['wood'] + $costs['clay'] + $costs['iron'] + $costs['crop'];
                $canNpc = $session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $totalRequired;
        ?>
            <tr>
                <td class="desc">
                    <div class="tit">
                        <img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo htmlspecialchars($unitName);?>" title="<?php echo htmlspecialchars($unitName);?>" />
                        <a href="#" onclick="return Popup(<?php echo $i;?>,1);"><?php echo htmlspecialchars($unitName);?></a>
                        <span class="info">(<?php echo AVAILABLE;?>: <?php echo $available;?>)</span>
                    </div>
                    <div class="details">
                        <img class="r1" src="img/x.gif" alt="<?php echo LUMBER;?>" title="<?php echo LUMBER;?>" /><?php echo $costs['wood'];?>|
                        <img class="r2" src="img/x.gif" alt="<?php echo CLAY;?>" title="<?php echo CLAY;?>" /><?php echo $costs['clay'];?>|
                        <img class="r3" src="img/x.gif" alt="<?php echo IRON;?>" title="<?php echo IRON;?>" /><?php echo $costs['iron'];?>|
                        <img class="r4" src="img/x.gif" alt="<?php echo CROP;?>" title="<?php echo CROP;?>" /><?php echo $costs['crop'];?>|
                        <img class="clock" src="img/x.gif" alt="<?php echo DURATION;?>" title="<?php echo DURATION;?>" /><?php echo $generator->getTimeFormat($duration);?>
                        <?php if ($canNpc):?>
                        |<a href="build.php?gid=17&t=3&r1=<?php echo $costs['wood'];?>&r2=<?php echo $costs['clay'];?>&r3=<?php echo $costs['iron'];?>&r4=<?php echo $costs['crop'];?>" title="<?php echo NPC_TRADE; ?>">
                            <img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" title="<?php echo NPC_TRADE; ?>" />
                        </a>
                        <?php endif;?>
                    </div>
                </td>
                <td class="val">
                    <input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="4">
                </td>
                <td class="max">
                    <a href="#" onclick="document.snd.t<?php echo $i;?>.value=<?php echo $maxUnit;?>; return false;">(<?php echo $maxUnit;?>)</a>
                </td>
            </tr>
        <?php 
            endif;
        endfor; ?>
        </tbody>
    </table>
    <p>
        <input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" />
    </p>
</form>
<?php else: ?>
    <div class="c"><?php echo PALACE_TRAIN_DESC;?></div>
<?php endif;

include("26_progress.tpl");
?>