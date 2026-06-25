<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : MAIN BUILDING                                             ##
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

$currentTime   = $currentLevel > 0 ? round($bid15[$currentLevel]['attri']) : 300;

$isMax         = $building->isMax($buildingType, $id);
$maxLevel      = 20;

$nextLevelRaw  = $currentLevel + 1 + $loopsame + $doublebuild + $master;
$nextLevel     = min($nextLevelRaw, $maxLevel);
$nextTime      = round($bid15[$nextLevel]['attri']);
?>
<div id="build" class="gid15">
    <a href="#" onclick="return Popup(15,4);" class="build_logo">
        <img class="building g15" src="img/x.gif" alt="<?= MAINBUILDING ?>" title="<?= MAINBUILDING ?>">
    </a>

    <h1>
        <?= MAINBUILDING ?>
        <span class="level"><?= LEVEL ?> <?= $currentLevel ?></span>
    </h1>

    <p class="build_desc"><?= MAINBUILDING_DESC ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?= CURRENT_CONSTRUCTION_TIME ?>:</th>
            <td><b><?= $currentTime ?></b> <?= PERCENT ?></td>
        </tr>

        <?php if (!$isMax): ?>
        <tr>
            <th><?= CONSTRUCTION_TIME_LEVEL ?> <?= $nextLevel ?>:</th>
            <td><b><?= $nextTime ?></b> <?= PERCENT ?></td>
        </tr>
        <?php endif; ?>
    </table>

    <?php
    if ($currentLevel >= 10) {
        include 'Templates/Build/15_1.tpl';
    }
    include 'upgrade.tpl';
    ?>
</div>