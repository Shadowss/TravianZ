<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : TREASURY MENU       	                                   ##
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

?>

<div id="textmenu">
   <a href="build.php?id=<?php echo $id ?? 0; ?>"<?php if(($_GET['t'] ?? 0) == 0 || ($_GET['t'] ?? 0) == 1) echo ' class="selected"'; ?>><?php echo OWN_ARTEFACTS; ?></a>
         
 | <a href="build.php?id=<?php echo $id ?? 0; ?>&t=2"<?php if(($_GET['t'] ?? 0) == 2) echo ' class="selected"'; ?>><?php echo SMALL_ARTEFACTS; ?></a>

 | <a href="build.php?id=<?php echo $id ?? 0; ?>&t=3"<?php if(($_GET['t'] ?? 0) == 3) echo ' class="selected"'; ?>><?php echo LARGE_ARTEFACTS; ?></a>
</div>