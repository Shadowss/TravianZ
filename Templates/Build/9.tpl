<?php

// BAKERY

include 'next.tpl';

$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentBonus  = $currentLevel > 0 ? $bid9[$currentLevel]['attri'] : 0;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = 5;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextBonus     = $bid9[$nextLevel]['attri'];
?>
<div id="build" class="gid9">
    <a href="#" onclick="return Popup(9,4);" class="build_logo">
        <img class="building g9" src="img/x.gif" alt="<?= BAKERY ?>" title="<?= BAKERY ?>">
    </a>

    <h1>
        <?= BAKERY ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= BAKERY_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_CROP_BONUS ?>:</th>
            <td><b><?= $currentBonus ?></b> <?= PERCENT ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= CROP_BONUS_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextBonus ?></b> <?= PERCENT ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>