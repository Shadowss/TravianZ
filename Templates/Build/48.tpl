<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : BIGHOSPITAL                                               ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Created by     : Shadow                                                    ##
##  Designed by    : Shadow                                                    ##
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

global $village, $building, $database, $technology, $bid48, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)round($bid48[$level]['attri'] * 100) : 100;
?>
<div id="build" class="gid48">
    <a href="#" onClick="return Popup(48,4);" class="build_logo">
        <img class="building g48" src="img/x.gif" alt="<?php echo BIGHOSPITAL; ?>" title="<?php echo BIGHOSPITAL;?>" />
    </a>
    <h1><?php echo BIGHOSPITAL;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo BIGHOSPITAL_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo HEALING_TIME_NOW;?></th>
            <td><b><?php echo $current;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20 ? 20 : $next;
            $nextFactor = (int)round($bid48[$next]['attri'] * 100);
        ?>
        <tr>
            <th><?php echo HEALING_TIME_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo $nextFactor;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php endif;?>
    </table>


    <?php
    // ==================== RANITI + VINDECARE ====================
    $woundedRows = $database->getWounded($village->wid);
    $healingRows = $database->getHealing($village->wid);
    $hasWounded = false;
    if (!empty($woundedRows)) {
        for ($wi = 1; $wi <= 90; $wi++) {
            if (!empty($woundedRows['u'.$wi])) { $hasWounded = true; break; }
        }
    }
    ?>
    <h4 class="hosp"><?php echo WOUNDED_TROOPS; ?></h4>
    <?php if ($hasWounded && $level > 0): ?>
    <form method="post" action="build.php?id=<?php echo (int)$id; ?>">
    <table cellpadding="1" cellspacing="1" id="hospital_wounded">
        <?php for ($wi = 1; $wi <= 90; $wi++): if (empty($woundedRows['u'.$wi])) continue; ?>
        <tr>
            <td class="ico"><img class="unit u<?php echo $wi; ?>" src="img/x.gif" alt="" /></td>
            <td class="desc"><?php echo $technology->getUnitName($wi); ?></td>
            <td class="val"><b><?php echo (int)$woundedRows['u'.$wi]; ?></b></td>
            <td class="val"><input class="text" type="text" name="hamt[<?php echo $wi; ?>]" value="0" maxlength="6" /></td>
            <td><button type="submit" name="hunit" value="<?php echo $wi; ?>" class="trav_buttons"><?php echo HEAL_BUTTON; ?></button></td>
        </tr>
        <?php endfor; ?>
    </table>
    <input type="hidden" name="ft" value="heal" />
    </form>
    <p class="c"><?php echo HEAL_COST_HINT; ?></p>
    <?php else: ?>
    <p class="none"><?php echo NO_WOUNDED; ?></p>
    <?php endif; ?>

    <?php if (!empty($healingRows)): ?>
    <h4 class="hosp"><?php echo HEALING_IN_PROGRESS; ?></h4>
    <table cellpadding="1" cellspacing="1" id="hospital_healing">
        <?php foreach ($healingRows as $hr):
            $doneAt = (int)$hr['timestamp2'] + ((int)$hr['amt'] - 1) * (int)$hr['eachtime']; ?>
        <tr>
            <td class="ico"><img class="unit u<?php echo (int)$hr['unit']; ?>" src="img/x.gif" alt="" /></td>
            <td class="desc"><?php echo (int)$hr['amt']; ?> x <?php echo $technology->getUnitName((int)$hr['unit']); ?></td>
            <td class="val"><?php echo date("H:i:s", $doneAt); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php include("upgrade.tpl");?>
</div>