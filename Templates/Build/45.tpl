<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : WATERWORKS                                                ##
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

global $village, $building, $bid45, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)round($bid45[$level]['attri'] * 100) : 0;

// numarul de oaze anexate de acest sat (pentru a arata impactul concret)
$wwOasisCount = 0;
$wwOasisList = $database->getOasis($village->wid);
if (!empty($wwOasisList)) $wwOasisCount = count($wwOasisList);
// procentul efectiv al unei oaze standard (25% de baza)
$wwEffective = $level > 0 ? 25 * (1 + $bid45[$level]['attri']) : 25;
$wwEffStr = ($wwEffective == floor($wwEffective)) ? (string)(int)$wwEffective : rtrim(rtrim(number_format($wwEffective, 1, '.', ''), '0'), '.');
?>
<div id="build" class="gid45">
    <a href="#" onClick="return Popup(45,4);" class="build_logo">
        <img class="building g45" src="img/x.gif" alt="<?php echo WATERWORKS; ?>" title="<?php echo WATERWORKS;?>" />
    </a>
    <h1><?php echo WATERWORKS;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo WATERWORKS_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_BONUS;?></th>
            <td><b><?php echo $current;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20 ? 20 : $next;
            $nextBonus = (int)round($bid45[$next]['attri'] * 100);
        ?>
        <tr>
            <th><?php echo BONUS_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo $nextBonus;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php endif;?>
        <?php if ($level > 0): ?>
        <tr>
            <th><?php echo OASIS_EFFECTIVE_BONUS;?></th>
            <td>25% &rarr; <b><?php echo $wwEffStr;?>%</b></td>
        </tr>
        <?php if ($wwOasisCount > 0): ?>
        <tr>
            <th><?php echo OASES;?></th>
            <td><b><?php echo $wwOasisCount;?></b> <?php echo WATERWORKS_AFFECTED;?></td>
        </tr>
        <?php endif; endif; ?>
    </table>

    <?php include("upgrade.tpl");?>
</div>