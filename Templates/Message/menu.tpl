<?php
#################################################################################
##  SAFE INCREMENTAL REFACTOR - Messages Menu                                  ##
##  Credits: cleaned structure, same logic preserved                           ##
##  Compatibility: PHP 5.6+ / PHP 7+                                           ##
#################################################################################

// ======================================================
// SAFE GET PARAM
// ======================================================
$t = isset($_GET['t']) ? (int)$_GET['t'] : 0;
?>

<div id="textmenu">

    <!-- Inbox -->
    <a href="nachrichten.php" <?php if ($t === 0) { echo 'class="selected"'; } ?>>Inbox</a>

    |

    <!-- Write -->
    <a href="nachrichten.php?t=1" <?php if ($t === 1) { echo 'class="selected"'; } ?>>Write</a>

    |

    <!-- Sent -->
    <a href="nachrichten.php?t=2" <?php if ($t === 2) { echo 'class="selected"'; } ?>>Sent</a>

    <?php
    // ======================================================
    // PLUS FEATURES (Archive + Notes)
    // ======================================================
    if ($session->plus) {

        echo ' | <a href="nachrichten.php?t=3" ' . ($t === 3 ? 'class="selected"' : '') . '>Archive</a>';

        echo ' | <a href="nachrichten.php?t=4" ' . ($t === 4 ? 'class="selected"' : '') . '>Notes</a>';
    }
    ?>

</div>