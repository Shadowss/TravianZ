<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : MARKETPLACE MENU                                          ##
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

global $database, $session, $id;

$t = isset($_GET['t'])? (int)$_GET['t'] : 0;
$hasGold = (int)$session->userinfo['gold'] > 2;
$hasRoutes = $session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1;
?>
<div id="textmenu">
    <a href="build.php?id=<?php echo (int)$id;?>" <?php if($t===0) echo 'class="selected"';?>><?php echo SEND_RESOURCES;?></a>
    | <a href="build.php?id=<?php echo (int)$id;?>&amp;t=1" <?php if($t===1) echo 'class="selected"';?>><?php echo BUY;?></a>
    | <a href="build.php?id=<?php echo (int)$id;?>&amp;t=2" <?php if($t===2) echo 'class="selected"';?>><?php echo OFFER;?></a>
    <?php if ($hasGold):?>
    | <a href="build.php?id=<?php echo (int)$id;?>&amp;t=3" <?php if($t===3) echo 'class="selected"';?>><?php echo NPC_TRADING;?></a>
    <?php endif;?>
    <?php if ($hasRoutes):?>
    | <a href="build.php?id=<?php echo (int)$id;?>&amp;t=4" <?php if($t===4) echo 'class="selected"';?>><?php echo TRADE_ROUTES;?></a>
    <?php endif;?>
</div>