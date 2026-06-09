<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       quest.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Rework by:     ronix                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original quest logic                                           ##
##  - Improved readability and indentation                                     ##
##  - Added safety checks for session values                                   ##
##  - Reduced repeated session access                                          ##
##  - Compatible with PHP 7+                                                   ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Initialize quest type in session
 * ---------------------------------------------------------
 */
$_SESSION['qtyp'] = QTYPE;

/**
 * ---------------------------------------------------------
 * Basic session safety
 * ---------------------------------------------------------
 */
$userId   = isset($_SESSION['id_user']) ? (int)$_SESSION['id_user'] : 0;
$qst      = isset($_SESSION['qst']) ? (int)$_SESSION['qst'] : 0;
$qstNew   = isset($_SESSION['qstnew']) ? (int)$_SESSION['qstnew'] : 0;
$tribe    = isset($session->userinfo['tribe']) ? $session->userinfo['tribe'] : 0;

/**
 * ---------------------------------------------------------
 * Quest display conditions (preserved logic)
 * ---------------------------------------------------------
 */
$showQuest =
    $userId != 1 &&
    (
        ($qst < 38 && QTYPE == 37 && QUEST == true) ||
        ($qst < 31 && QTYPE == 25 && QUEST == true) ||
        ($qst >= 90 && QUEST == true)
    );

if ($showQuest) {
?>

<div id="anm" style="width:120px; height:140px; visibility:hidden;"></div>

<div id="qge">

    <?php if ($qst == 0 || $qstNew == 1) { ?>

        <img
            onclick="qst_handle();"
            src="<?php echo GP_LOCATE; ?>img/q/l<?php echo $tribe; ?>g.jpg"
            title="<?php echo TO_THE_TASK; ?>"
            style="height:174px"
            alt="<?php echo TO_THE_TASK; ?>"
        />

    <?php } else { ?>

        <img
            onclick="qst_handle();"
            src="<?php echo GP_LOCATE; ?>img/q/l<?php echo $tribe; ?>.jpg"
            title="<?php echo TO_THE_TASK; ?>"
            style="height:174px"
            alt="<?php echo TO_THE_TASK; ?>"
        />

    <?php } ?>

</div>

<script type="text/javascript">
<?php if ($qst == 0) { ?>
    quest.number = null;
<?php } else { ?>
    quest.number = 0;
<?php } ?>

<?php if ($qst < 38 && QTYPE == 37) { ?>
    quest.last = 37;
<?php } else { ?>
    quest.last = 30;
<?php } ?>

cache_preload = new Image();
cache_preload.src = "img/x.gif";
cache_preload.className = "wood";
</script>

<?php
}
?>