<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HERO T4 NAV BAR                                           ##
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


$t4HeroItems  = new HeroItems();
$t4Silver     = $t4HeroItems->getSilver($session->uid);
$t4Tabs = [
    'hero'       => ['label' => HERO_T4_TAB_HERO,       'url' => 'build.php?id=' . $id],
    'items'      => ['label' => HERO_T4_TAB_ITEMS,      'url' => 'build.php?id=' . $id . '&t4tab=items'],
    'adventures' => ['label' => HERO_T4_TAB_ADVENTURES, 'url' => 'build.php?id=' . $id . '&t4tab=adventures'],
    'auction'    => ['label' => HERO_T4_TAB_AUCTION,    'url' => 'build.php?id=' . $id . '&t4tab=auction'],
];
?>
<link rel="stylesheet" href="css/hero_items.css" type="text/css">
<div class="heroT4Nav" style="margin:6px 0 10px 0;">
    <?php foreach ($t4Tabs as $key => $tab) { ?>
        <?php if ($key === $t4tab) { ?>
            <span style="font-weight:bold;margin-right:14px;"><?php echo $tab['label']; ?></span>
        <?php } else { ?>
            <a href="<?php echo $tab['url']; ?>" style="margin-right:14px;"><?php echo $tab['label']; ?></a>
        <?php } ?>
    <?php } ?>
    <span style="float:right;"><b><?php echo HERO_SILVER; ?>:</b> <?php echo number_format($t4Silver); ?></span>
    <div style="clear:both;"></div>
</div>
