<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : BARRICADE                                                 ##
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

global $village, $building, $bid50, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)$bid50[$level]['attri'] : 0;
?>
<div id="build" class="gid50">
    <h1><?php echo BARRICADE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo BARRICADE_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo DEFENCE_NOW;?></th>
            <td><b><?php echo $current;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20 ? 20 : $next;
        ?>
        <tr>
            <th><?php echo DEFENCE_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo (int)$bid50[$next]['attri'];?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php endif;?>
    </table>

    <?php include("upgrade.tpl");?>
</div>