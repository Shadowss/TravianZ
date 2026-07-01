<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : BREWERY				                                   ##
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

global $village, $building, $bid35, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)$bid35[$level]['attri'] : 0;
?>
<div id="build" class="gid35">
    <a href="#" onClick="return Popup(35,4);" class="build_logo">
        <img class="building g35" src="img/x.gif" alt="<?php echo BREWERY; ?>" title="<?php echo BREWERY;?>" />
    </a>
    <h1><?php echo BREWERY;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo BREWERY_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_BONUS;?></th>
            <td><b><?php echo $current;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 10 ? 10 : $next;
        ?>
        <tr>
            <th><?php echo BONUS_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo (int)$bid35[$next]['attri'];?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php endif;?>
    </table>
	</br>
    <?php if ($level > 0):?>
        <?php include("35_1.tpl");?>
    <?php else:?>
	</br>
        <p><b><?php echo MEAD_FESTIVAL_COMMENCE_BREWERY;?></b></p>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>