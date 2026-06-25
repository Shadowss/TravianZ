<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : TOURNAMENT SQUARE                                         ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include 'next.tpl';

$field         = 'f' . $id;
$currentLevel  = (int)($village->resarray[$field] ?? 0);
$buildingType  = $village->resarray[$field . 't'] ?? 0;

$currentSpeed  = $currentLevel > 0 ? $bid14[$currentLevel]['attri'] : 100;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = 20;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextSpeed     = $bid14[$nextLevel]['attri'];
?>
<div id="build" class="gid14">
    <a href="#" onclick="return Popup(14,4);" class="build_logo">
        <img class="building g14" src="img/x.gif" alt="<?= TOURNAMENTSQUARE ?>" title="<?= TOURNAMENTSQUARE ?>">
    </a>

    <h1>
        <?= TOURNAMENTSQUARE ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= TOURNAMENTSQUARE_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_SPEED ?>:</th>
            <td><b><?= $currentSpeed ?></b> <?= PERCENT ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= SPEED_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextSpeed ?></b> <?= PERCENT ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php include 'upgrade.tpl'; ?>
</div>