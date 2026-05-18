<?php

// IRONFOUNDRY

include 'next.tpl';

$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentBonus  = $currentLevel > 0 ? $bid7[$currentLevel]['attri'] : 0;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = 5;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextBonus     = $bid7[$nextLevel]['attri'];
?>
<div id="build" class="gid7">
    <a href="#" onclick="return Popup(7,4);" class="build_logo">
        <img class="building g7" src="img/x.gif" alt="<?= IRONFOUNDRY ?>" title="<?= IRONFOUNDRY ?>">
    </a>

    <h1>
        <?= IRONFOUNDRY ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= IRONFOUNDRY_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_IRON_BONUS ?>:</th>
            <td><b><?= $currentBonus ?></b> <?= PERCENT ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= IRON_BONUS_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextBonus ?></b> <?= PERCENT ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>