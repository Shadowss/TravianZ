<?php

// GRANARY

include 'next.tpl';

$field            = 'f' . $id;
$currentLevel     = (int) ($village->resarray[$field] ?? 0);
$buildingType     = $village->resarray[$field . 't'] ?? 0;

$currentCapacity  = $bid11[$currentLevel]['attri'] * STORAGE_MULTIPLIER;

$isMax            = $building->isMax($buildingType, $id);
$maxLevel         = 20;

$nextLevelRaw     = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel        = min($nextLevelRaw, $maxLevel);
$nextCapacity     = $bid11[$nextLevel]['attri'] * STORAGE_MULTIPLIER;
?>
<div id="build" class="gid11">
    <a href="#" onclick="return Popup(11,4);" class="build_logo">
        <img class="building g11" src="img/x.gif" alt="<?= GRANARY ?>" title="<?= GRANARY ?>">
    </a>

    <h1>
        <?= GRANARY ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= GRANARY_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_CAPACITY ?>:</th>
            <td><b><?= $currentCapacity ?></b> <?= CROP_UNITS ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= CAPACITY_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextCapacity ?></b> <?= CROP_UNITS ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>