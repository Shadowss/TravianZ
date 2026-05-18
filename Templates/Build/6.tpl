<?php

// BRICKYARD

include 'next.tpl';

$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentBonus  = $currentLevel > 0 ? $bid6[$currentLevel]['attri'] : 0;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = 5;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextBonus     = $bid6[$nextLevel]['attri'];
?>
<div id="build" class="gid6">
    <a href="#" onclick="return Popup(6,4);" class="build_logo">
        <img class="building g6" src="img/x.gif" alt="<?= BRICKYARD ?>" title="<?= BRICKYARD ?>">
    </a>

    <h1>
        <?= BRICKYARD ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= BRICKYARD_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_CLAY_BONUS ?>:</th>
            <td><b><?= $currentBonus ?></b> <?= PERCENT ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= CLAY_BONUS_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextBonus ?></b> <?= PERCENT ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>