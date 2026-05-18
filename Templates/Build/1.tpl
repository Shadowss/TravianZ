<?php

// WOODCUTER

include 'next.tpl';

// — pregătire date —
$field         = 'f' . $id;
$currentLevel  = (int) ($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentProd   = $bid1[$currentLevel]['prod'] * SPEED;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = ($village->capital == 1) ? 20 : 10;

// calculează nivelul următor luând în calcul queue-urile
$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextProd      = $bid1[$nextLevel]['prod'] * SPEED;
?>
<div id="build" class="gid1">
    <a href="#" onclick="return Popup(0,4);" class="build_logo">
        <img class="building g1" src="img/x.gif" alt="<?= WOODCUTTER ?>" title="<?= WOODCUTTER ?>">
    </a>

    <h1>
        <?= WOODCUTTER ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= WOODCUTTER_DESC ?></p>

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