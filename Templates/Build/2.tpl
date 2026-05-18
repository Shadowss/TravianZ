<?php

// CLAYPIT

include 'next.tpl';

// — pregătire date —
$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentProd   = $bid2[$currentLevel]['prod'] * SPEED;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = ($village->capital == 1) ? 20 : 10;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextProd      = $bid2[$nextLevel]['prod'] * SPEED;
?>
<div id="build" class="gid2">
    <a href="#" onclick="return Popup(2,4);" class="build_logo">
        <img class="building g2" src="img/x.gif" alt="<?= CLAYPIT ?>" title="<?= CLAYPIT ?>">
    </a>

    <h1>
        <?= CLAYPIT ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= CLAYPIT_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CUR_PROD ?>:</th>
            <td><b><?= $currentProd ?></b> <?= PER_HR ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= NEXT_PROD ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextProd ?></b> <?= PER_HR ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>