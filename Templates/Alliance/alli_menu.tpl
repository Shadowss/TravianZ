<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        alli_menu.tpl                                                  ##
## Description: Alliance menu navigation                                       ##
## Improvements:                                                               ##
##  - Reduced duplication                                                      ##
##  - Safer input handling                                                     ##
##  - Cleaner structure                                                        ##
##  - Added comments                                                           ##
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
        Overview
    </a>

    | <!-- Forum -->
    <a href="allianz.php?s=2" <?php if ($s === 2) { echo 'class="selected"'; } ?>>
        Forum
    </a>

    | <!-- Chat -->
    <a href="allianz.php?s=6" <?php if ($s === 6) { echo 'class="selected"'; } ?>>
        Chat
    </a>

    | <!-- Attacks -->
    <a href="allianz.php?s=3" <?php if ($s === 3) { echo 'class="selected"'; } ?>>
        <?php echo TZ_ATTACKS; ?>
    </a>

    | <!-- News -->
    <a href="allianz.php?s=4" <?php if ($s === 4) { echo 'class="selected"'; } ?>>
        News
    </a>

<?php
    // Dacă NU este sitter → are acces la Options
    if ($session->sit == 0) {
?>
    | <!-- Options -->
    <a href="allianz.php?s=5" <?php if ($s === 5) { echo 'class="selected"'; } ?>>
        Options
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