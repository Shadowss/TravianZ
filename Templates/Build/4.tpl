<?php

// CROPLAND

include 'next.tpl';

// — pregătire date —
$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentProd   = $bid4[$currentLevel]['prod'] * SPEED;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = ($village->capital == 1) ? 20 : 10;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextProd      = $bid4[$nextLevel]['prod'] * SPEED;
?>
<div id="build" class="gid4">
    <a href="#" onclick="return Popup(4,4);" class="build_logo">
        <img class="building g4" src="img/x.gif" alt="<?= CROPLAND ?>" title="<?= CROPLAND ?>">
    </a>

    <h1>
        <?= CROPLAND ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= CROPLAND_DESC ?></p>

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