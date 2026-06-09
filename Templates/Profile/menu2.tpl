<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       menu.tpl                                                    ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// UID sigur (evităm repetarea $_GET)
$menuUid = isset($_GET['uid']) ? (int)$_GET['uid'] : (int)$session->uid;
$hasUid  = isset($_GET['uid']);
?>

<div id="textmenu">

    <!-- ================= OVERVIEW (ACTIVE) ================= -->
    <a href="spieler.php?uid=<?php echo $menuUid; ?>"
       <?php echo $hasUid ? 'class="selected"' : ''; ?>>
        <?php echo OVERVIEW; ?>
    </a>

    |

    <!-- ================= DISABLED ITEMS ================= -->
    <span class="none"><b><?php echo PROFILE; ?></b></span>
    |
    <span class="none"><b><?php echo PREFERENCES; ?></b></span>
    |
    <span class="none"><b><?php echo ACCOUNT; ?></b></span>

    <?php if (defined('NEW_FUNCTIONS_VACATION') && NEW_FUNCTIONS_VACATION) { ?>
        |
        <span class="none"><b><?php echo VACATION; ?></b></span>
    <?php } ?>

    <?php if (defined('GP_ENABLE') && GP_ENABLE) { ?>
        |
        <span class="none"><b><?php echo GRAPH_PACK; ?></b></span>
    <?php } ?>

</div>