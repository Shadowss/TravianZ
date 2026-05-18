<?php

// IRONMINE

include 'next.tpl';

// — pregătire date —
$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentProd   = $bid3[$currentLevel]['prod'] * SPEED;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = ($village->capital == 1) ? 20 : 10;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextProd      = $bid3[$nextLevel]['prod'] * SPEED;
?>
<div id="build" class="gid3">
    <a href="#" onclick="return Popup(3,4);" class="build_logo">
        <img class="building g3" src="img/x.gif" alt="<?= IRONMINE ?>" title="<?= IRONMINE ?>">
    </a>

    <h1>
        <?= IRONMINE ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= IRONMINE_DESC ?></p>

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