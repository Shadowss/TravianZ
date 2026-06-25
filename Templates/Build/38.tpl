<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : GREATWAREHOUSE			                                   ##
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

global $village, $building, $bid38, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)$bid38[$level]['attri'] * STORAGE_MULTIPLIER : 0;
?>
<div id="build" class="gid38">
    <a href="#" onClick="return Popup(38,4);" class="build_logo">
        <img class="building g38" src="img/x.gif" alt="<?php echo GREATWAREHOUSE; ?>" title="<?php echo GREATWAREHOUSE;?>" />
    </a>
    <h1><?php echo GREATWAREHOUSE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo GREATWAREHOUSE_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_CAPACITY;?></th>
            <td><b><?php echo $current;?></b> <?php echo RESOURCE_UNITS;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20 ? 20 : $next;
        ?>
        <tr>
            <th><?php echo CAPACITY_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo (int)$bid38[$next]['attri'] * STORAGE_MULTIPLIER;?></b> <?php echo RESOURCE_UNITS;?></td>
        </tr>
        <?php endif;?>
    </table>

    <?php include("upgrade.tpl");?>
</div>