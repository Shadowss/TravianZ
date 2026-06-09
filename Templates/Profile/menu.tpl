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

// determinăm UID sigur (evităm repetarea directă $_GET peste tot)
$menuUid = isset($_GET['uid']) ? (int)$_GET['uid'] : (int)$session->uid;

// helper simplu pentru "selected"
$selectedUid = isset($_GET['uid']);
$sParam = isset($_GET['s']) ? (int)$_GET['s'] : null;
?>

<div id="textmenu">

    <!-- ================= OVERVIEW ================= -->
    <a href="spieler.php?uid=<?php echo $menuUid; ?>"
       <?php echo $selectedUid ? 'class="selected"' : ''; ?>>
        <?php echo OVERVIEW; ?>
    </a>

    |

    <!-- ================= PROFILE ================= -->
    <a href="spieler.php?s=1"
       <?php echo ($sParam === 1) ? 'class="selected"' : ''; ?>>
        <?php echo PROFILE; ?>
    </a>

    |

    <!-- ================= PREFERENCES ================= -->
    <a href="spieler.php?s=2"
       <?php echo ($sParam === 2) ? 'class="selected"' : ''; ?>>
        <?php echo PREFERENCES; ?>
    </a>

    |

    <!-- ================= ACCOUNT ================= -->
    <a href="spieler.php?s=3"
       <?php echo ($sParam === 3) ? 'class="selected"' : ''; ?>>
        <?php echo ACCOUNT; ?>
    </a>

    <?php
    // ================= VACATION MODE =================
    if (defined('NEW_FUNCTIONS_VACATION') && NEW_FUNCTIONS_VACATION) {
    ?>
        |
        <a href="spieler.php?s=5"
           <?php echo ($sParam === 5) ? 'class="selected"' : ''; ?>>
            <?php echo VACATION; ?>
        </a>
    <?php
    }

    // ================= GRAPHIC PACK =================
    if (defined('GP_ENABLE') && GP_ENABLE) {
    ?>
        |
        <a href="spieler.php?s=4"
           <?php echo ($sParam === 4) ? 'class="selected"' : ''; ?>>
            <?php echo GRAPH_PACK; ?>
        </a>
    <?php
    }
    ?>

</div>