<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : RESIDENCE MENU                                            ##
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

global $id;
$s = $_GET['s'] ?? null;
?>
<div id="textmenu">
   <a href="build.php?id=<?php echo (int)$id;?>" <?php if(!$s) echo 'class="selected"';?>><?php echo TRAIN;?></a>
 | <a href="build.php?id=<?php echo (int)$id;?>&amp;s=2" <?php if($s==2) echo 'class="selected"';?>><?php echo CULTURE_POINTS;?></a>
 | <a href="build.php?id=<?php echo (int)$id;?>&amp;s=3" <?php if($s==3) echo 'class="selected"';?>><?php echo LOYALTY;?></a>
 | <a href="build.php?id=<?php echo (int)$id;?>&amp;s=4" <?php if($s==4) echo 'class="selected"';?>><?php echo EXPANSION;?></a>
</div>