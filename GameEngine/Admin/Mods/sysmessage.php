<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       sysmessage.php                                              ##
##  Type           BACKEND                                                     ##
##  Purpose        Handler for the Admin Panel "Create System Message" form    ##
##                 (Admin/Templates/sysmessage.tpl). Displays a global system  ##
##                 message to all players (same mechanism as sysmsg.php):      ##
##                 writes Templates/text.tpl from text_format.tpl and sets     ##
##                 users.ok = 1 so every player sees it on their next page.    ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
#################################################################################

session_start();

include_once("../../config.php");
include_once("../../Database.php");

if (!isset($_SESSION['access']) || $_SESSION['access'] < ADMIN) {
    die("Access Denied");
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

// ---------------------------------------------------------------------------
// Resolve project root (so we can read/write Templates/*.tpl)
// ---------------------------------------------------------------------------
$autoprefix = '';
for ($i = 0; $i < 6; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

/*
|--------------------------------------------------------------------------
| STEP 1 - PREPARE (show confirmation)
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] == 'prepare') {

    if (empty($_POST['subject']))  die("Subject required");
    if (empty($_POST['message']))  die("Message required");

    $_SESSION['sys_subject'] = trim($_POST['subject']);
    $_SESSION['sys_message'] = trim($_POST['message']);
    $_SESSION['sys_color']   = trim($_POST['color'] ?? 'black');

    header("Location: ../../../Admin/admin.php?p=sysmessage&confirm=1");
    exit;
}

/*
|--------------------------------------------------------------------------
| STEP 2 - EXECUTE (write the global system message)
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] == 'execute') {

    // Cancel button
    if (isset($_POST['confirm']) && $_POST['confirm'] == 'No') {
        unset($_SESSION['sys_subject'], $_SESSION['sys_message'], $_SESSION['sys_color']);
        header("Location: ../../../Admin/admin.php?p=sysmessage");
        exit;
    }

    if (empty($_SESSION['sys_subject']) || empty($_SESSION['sys_message'])) {
        header("Location: ../../../Admin/admin.php?p=sysmessage");
        exit;
    }

    $subject = trim($_SESSION['sys_subject']);
    $message = trim($_SESSION['sys_message']);
    $color   = trim($_SESSION['sys_color'] ?: 'black');

    // Compose the HTML body: coloured subject heading + message (line breaks kept).
    $body  = '<div style="color:' . $color . ';font-weight:bold;font-size:14px;margin-bottom:8px">' . $subject . '</div>';
    $body .= $message;

    // %TEKST% is injected into a PHP double-quoted string inside text_format.tpl,
    // so escape backslash, double-quote and $ to avoid breaking the string or
    // allowing code injection. str_replace (not preg_replace) so the replacement
    // is treated literally.
    $safe = str_replace(['\\', '"', '$'], ['\\\\', '\\"', '\\$'], $body);

    $format = @file_get_contents($autoprefix . 'Templates/text_format.tpl');
    if ($format === false) {
        die("Cannot read Templates/text_format.tpl");
    }

    $out = str_replace('%TEKST%', $safe, $format);

    if (@file_put_contents($autoprefix . 'Templates/text.tpl', $out) === false) {
        die("Cannot write Templates/text.tpl (check permissions)");
    }

    // Make the message visible to every player (they will see it on next page).
    $database->setUsersOk(1);

    unset($_SESSION['sys_subject'], $_SESSION['sys_message'], $_SESSION['sys_color']);

    header("Location: ../../../Admin/admin.php?p=sysmessage&done=1");
    exit;
}

// Fallback
header("Location: ../../../Admin/admin.php?p=sysmessage");
exit;
?>
