<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : TOWNHALL                                                  ##
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

global $village, $building, $id;
$level = (int)$village->resarray['f'.$id];
?>
<div id="build" class="gid24">
    <a href="#" onClick="return Popup(24,4);" class="build_logo">
        <img class="building g24" src="img/x.gif" alt="<?php echo TOWNHALL; ?>" title="<?php echo TOWNHALL;?>" />
    </a>
    <h1><?php echo TOWNHALL;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo TOWNHALL_DESC;?></p>

    <?php if ($building->getTypeLevel(24) > 0):?>
        <?php include("Templates/Build/24_1.tpl"); ?>
        <?php include("Templates/Build/24_2.tpl"); ?>
    <?php else:?>
        <p><b><?php echo CELEBRATIONS_COMMENCE_TOWNHALL;?></b></p>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>