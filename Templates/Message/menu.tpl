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
    <a href="nachrichten.php" <?php if ($t === 0) { echo 'class="selected"'; } ?>><?php echo INBOX; ?></a>

    |

    <!-- Write -->
    <a href="nachrichten.php?t=1" <?php if ($t === 1) { echo 'class="selected"'; } ?>><?php echo WRITE; ?></a>

    |

    <!-- Sent -->
    <a href="nachrichten.php?t=2" <?php if ($t === 2) { echo 'class="selected"'; } ?>><?php echo SENT; ?></a>

    <?php
    // ======================================================
    // PLUS FEATURES (Archive + Notes)
    // ======================================================
    if ($session->plus) {

        echo ' | <a href="nachrichten.php?t=3" ' . ($t === 3 ? 'class="selected"' : '') . '>'.ARCHIVE.'</a>';

        echo ' | <a href="nachrichten.php?t=4" ' . ($t === 4 ? 'class="selected"' : '') . '>'.NOTES.'</a>';
    }
    ?>

</div>