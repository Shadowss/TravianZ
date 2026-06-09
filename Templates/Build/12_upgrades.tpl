<?php

// BLACKSMITH UPGRADES

$abdata = $database->getABTech($village->wid);
$ABups = $technology->getABUpgrades('b');
$totalUps = count($ABups);
$blacksmithLevel = $building->getTypeLevel(12);
$bsAttri = $bid12[$blacksmithLevel]['attri'] / 100;

$start = $session->tribe * 10 - 9;
$end = $session->tribe * 10 - 2;
?>
<table cellpadding="1" cellspacing="1" class="build_details">
    <thead>
        <tr>
            <td><?= BLACKSMITH?></td>
            <td><?= ACTION?></td>
        </tr>
    </thead>
    <tbody>
    <?php for ($i = $start; $i <= $end; $i++):
        $j = $i % 10;
        if (!($technology->getTech($i) || $j == 1)) continue;

        $unitName = $technology->getUnitName($i);
        $current = (int)$abdata['b'.$j];

        // câte upgrade-uri sunt deja în coadă pentru unitatea asta
        $ups = 0;
        foreach ($ABups as $up) {
            if (in_array('b'.$j, $up)) $ups++;
        }
        $shownLevel = $current + $ups;
        $nextLevel = $shownLevel + 1;
        $ab = ${'ab'.$i};
        $next = $ab[$nextLevel]?? null;
  ?>
        <tr>
            <td class="desc">
                <div class="tit">
                    <img class="unit u<?= $i?>" src="img/x.gif" alt="<?= $unitName?>" title="<?= $unitName?>">
                    <a href="#" onclick="return Popup(<?= $i?>,1);"><?= $unitName?></a>
                    (<?= LEVEL?> <?= $current?><?= $ups > 0? '+'.$ups : ''?>)
                </div>

                <?php if ($current < 20 && $next):?>
                <div class="details">
                    <img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>"> <?= $next['wood']?>|
                    <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>"> <?= $next['clay']?>|
                    <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>"> <?= $next['iron']?>|
                    <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>"> <?= $next['crop']?>|
                    <img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>">
                    <?= $generator->getTimeFormat(round($next['time'] * $bsAttri / SPEED))?>

                    <?php
                    $totalRequired = $next['wood'] + $next['clay'] + $next['iron'] + $next['crop'];
                    $canNpc = $session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $totalRequired;
                  ?>
                    <?php if ($canNpc):?>
                        |<a href="build.php?gid=17&t=3&r1=<?= $next['wood']?>&r2=<?= $next['clay']?>&r3=<?= $next['iron']?>&r4=<?= $next['crop']?>" title="<?php echo NPC_TRADE; ?>">
                            <img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" title="<?php echo NPC_TRADE; ?>">
                        </a>
                    <?php endif;?>

                    <?php
                    // mesaj resurse insuficiente
                    if ($next['wood'] > $village->awood || $next['clay'] > $village->aclay || $next['iron'] > $village->airon || $next['crop'] > $village->acrop) {
                        if ($village->getProd('crop') > 0 || $village->acrop > $next['crop']) {
                            $time = $technology->calculateAvaliable(12, $next);
                            echo '<br><span class="none">'.ENOUGH_RESOURCES.' '.$time[0].' at '.$time[1].'</span>';
                        } else {
                            echo '<br><span class="none">'.CROP_NEGATIVE.'</span>';
                        }
                    }
                  ?>
                </div>
                <?php endif;?>
            </td>

            <td class="act">
                <?php if ($current >= 20):?>
                    <div class="none"><?= MAXIMUM_LEVEL?></div>

                <?php elseif ($blacksmithLevel <= $shownLevel):?>
                    <div class="none"><?= UPGRADE_BLACKSMITH?></div>

                <?php elseif ($next && ($next['wood'] > $village->maxstore || $next['clay'] > $village->maxstore || $next['iron'] > $village->maxstore)):?>
                    <div class="none"><?= EXPAND_WAREHOUSE?></div>

                <?php elseif ($next && $next['crop'] > $village->maxcrop):?>
                    <div class="none"><?= EXPAND_GRANARY?></div>

                <?php elseif ($next && ($next['wood'] > $village->awood || $next['clay'] > $village->aclay || $next['iron'] > $village->airon || $next['crop'] > $village->acrop)):?>
                    <div class="none"><?= TOO_FEW_RESOURCES?></div>

                <?php elseif ($totalUps == 1 &&!$session->plus || $totalUps > 1):?>
                    <div class="none"><?= UPGRADE_IN_PROGRESS?></div>

                <?php elseif ($session->access!= BANNED):?>
                    <a class="research" href="build.php?id=<?= $id?>&amp;a=<?= $j?>&amp;c=<?= $session->mchecker?>"><?= UPGRADE?></a>
                    <?php if ($totalUps!= 0):?><span class="none"> <?= WAITING?></span><?php endif;?>

                <?php else:?>
                    <a class="research" href="banned.php"><?= UPGRADE?></a>
                    <?php if ($totalUps!= 0):?><span class="none"> <?= WAITING?></span><?php endif;?>
                <?php endif;?>
            </td>
        </tr>
    <?php endfor;?>
    </tbody>
</table>

<?php if ($totalUps > 0):?>
<table cellpadding="1" cellspacing="1" class="under_progress">
    <thead>
        <tr>
            <td><?= UPGRADING?></td>
            <td><?= DURATION?></td>
            <td><?= COMPLETE?></td>
        </tr>
    </thead>
    <tbody>
    <?php $count = 0; foreach ($ABups as $black):
        $count++;
        $ABUnit = (int)substr($black['tech'], 1, 2);
        $abdata['b'.$ABUnit]++; // incrementează pentru afișare corectă
        $unit = ($session->tribe - 1) * 10 + $ABUnit;
        $unitName = $technology->getUnitName($unit);
        $date = $generator->procMtime($black['timestamp']);
  ?>
        <tr>
            <td class="desc">
                <img class="unit u<?= $unit?>" src="img/x.gif" alt="<?= $unitName?>" title="<?= $unitName?>">
                <?= $unitName?>
                <span class="none"> (<?= LEVEL?> <?= $abdata['b'.$ABUnit]?>)</span>
                <?php if ($count > 1):?><span class="none"> <?= WAITING?></span><?php endif;?>
            </td>
            <td class="dur"><span id="timer<?= ++$session->timer?>"><?= $generator->getTimeFormat($black['timestamp'] - time())?></span></td>
            <td class="fin"><span><?= $date[1]?></span><span> <?php echo TZ_HRS; ?></span></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php endif;?>