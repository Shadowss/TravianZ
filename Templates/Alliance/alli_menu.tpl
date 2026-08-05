<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : alli_menu.tpl                                             ##
##  Type           : Alliance Navigation Menu                                  ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

// Verifică dacă jucătorul este în alianța curentă
if ($session->alliance == $aid && $session->alliance > 0) {

    // Preluăm parametrul "s" o singură dată (GET sau POST)
    // Cast la int pentru siguranță
    $s = 0;
    if (isset($_GET['s'])) {
        $s = (int)$_GET['s'];
    } elseif (isset($_POST['s'])) {
        $s = (int)$_POST['s'];
    }
?>
<div id="textmenu">

    <!-- Overview -->
    <a href="allianz.php" <?php if ($s === 0) { echo 'class="selected"'; } ?>>
        <?php echo TZ_OVERVIEW; ?>
    </a>

    | <!-- Forum -->
    <a href="allianz.php?s=2" <?php if ($s === 2) { echo 'class="selected"'; } ?>>
        <?php echo TZ_FORUM; ?>
    </a>

    | <!-- Chat -->
    <a href="allianz.php?s=6" <?php if ($s === 6) { echo 'class="selected"'; } ?>>
        <?php echo TZ_CHAT; ?>
    </a>

    | <!-- Attacks -->
    <a href="allianz.php?s=3" <?php if ($s === 3) { echo 'class="selected"'; } ?>>
        <?php echo TZ_ATTACKS; ?>
    </a>

    | <!-- News -->
    <a href="allianz.php?s=4" <?php if ($s === 4) { echo 'class="selected"'; } ?>>
        <?php echo TZ_NEWS; ?>
    </a>

<?php if (defined('NEW_FUNCTIONS_ALLIANCE_BONUSES') && NEW_FUNCTIONS_ALLIANCE_BONUSES) { ?>
    | <!-- Bonuses -->
    <a href="allianz.php?s=7" <?php if ($s === 7) { echo 'class="selected"'; } ?>>
        <?php echo defined('ALLYBONUS_TAB') ? ALLYBONUS_TAB : 'Bonuses'; ?>
    </a>
<?php } ?>

<?php
    // Dacă NU este sitter → are acces la Options
    if ($session->sit == 0) {
?>
    | <!-- Options -->
    <a href="allianz.php?s=5" <?php if ($s === 5) { echo 'class="selected"'; } ?>>
        <?php echo TZ_OPTIONS; ?>
    </a>
<?php
    } else {
?>
    | <!-- Options disabled for sitter -->
    <span class="none"><b><?php echo OPTION; ?></b></span>
<?php
    }
?>

</div>
<?php
}
?>