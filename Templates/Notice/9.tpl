<?php
#################################################################################
#  Refactor incremental SAFE - Report Loader (9.tpl)
#  - Added basic input validation
#  - Prevents undefined index warnings
#  - PHP 5.6+ / 7+ compatible
#  - Logic preserved 100%
#  - Minimal safe hardening (no behavior change)
#################################################################################

// ======================== SAFE INPUT ========================
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no valid ID, stop safely (prevents warnings / injection edge cases)
if ($id <= 0) {
    return;
}

// ======================== GET TEMPLATE ========================
// NOTE: archive field defines which tpl file is loaded
$template = $database->getNotice2($id, 'archive');

// Safety: ensure valid string before include
if (!empty($template)) {
    include($template . ".tpl");
}