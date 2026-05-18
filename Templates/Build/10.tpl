<?php

// WAREHOUSE

include 'next.tpl';

$field            = 'f' . $id;
$currentLevel     = (int) ($village->resarray[$field] ?? 0);
$buildingType     = $village->resarray[$field . 't'] ?? 0;

$currentCapacity  = $bid10[$currentLevel]['attri'] * STORAGE_MULTIPLIER;

$isMax            = $building->isMax($buildingType, $id);
$maxLevel         = 20;

$nextLevelRaw     = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel        = min($nextLevelRaw, $maxLevel);
$nextCapacity     = $bid10[$nextLevel]['attri'] * STORAGE_MULTIPLIER;
?>
<div id="build" class="gid10">
    <a href="#" onclick="return Popup(10,4);" class="build_logo">
        <img class="building g10" src="img/x.gif" alt="<?= WAREHOUSE ?>" title="<?= WAREHOUSE ?>">
    </a>

    <h1>
        <?= WAREHOUSE ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= WAREHOUSE_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_CAPACITY ?>:</th>
            <td><b><?= $currentCapacity ?></b> <?= RESOURCE_UNITS ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= CAPACITY_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextCapacity ?></b> <?= RESOURCE_UNITS ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>