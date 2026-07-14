<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : COMMANDCENTER                                             ##
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

global $village, $id;

$level = (int)$village->resarray['f'.$id];
?>
<div id="build" class="gid44">
    <h1><?php echo COMMANDCENTER;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc">
        <a href="#" onClick="return Popup(44,4, 'gid');" class="build_logo">
            <img class="building g44" src="img/x.gif" alt="<?php echo COMMANDCENTER; ?>" title="<?php echo COMMANDCENTER;?>" />
        </a>
        <?php echo COMMANDCENTER_DESC;?>
    </p>

    <?php if ($village->capital == 1):?>
        <p class="act"><?php echo CAPITAL;?></p>
    <?php endif;?>

    <?php include("25_menu.tpl"); ?>

    <?php if ($level >= 10):?>
        <?php include("44_train.tpl");?>
    <?php else:?>
        <div class="c"><?php echo COMMANDCENTER_TRAIN_DESC;?></div>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>