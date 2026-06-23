<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       sendMessage.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die("Access Denied: You are not Admin!");
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once("../../config.php");

// ---------------------------------------------------------------------------
// Autoloader path
// ---------------------------------------------------------------------------
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . "GameEngine/Database.php");

// ---------------------------------------------------------------------------
// INPUT
// ---------------------------------------------------------------------------
$adminId = (int)($_SESSION['id'] ?? 0);
$uid     = (int)($_POST['uid'] ?? 0);
$topic   = trim($_POST['topic'] ?? 'Admin Message');
$message = trim($_POST['message'] ?? '');

// ---------------------------------------------------------------------------
// VALIDARE
// ---------------------------------------------------------------------------
if ($adminId <= 0) {
    die("Invalid admin session.");
}

if ($uid <= 0 || $message === '') {
    header("Location: ../../../Admin/admin.php?p=Newmessage&uid=$uid&e=1");
    exit;
}

// ---------------------------------------------------------------------------
// SANITIZARE
// ---------------------------------------------------------------------------
$topicEsc = $database->escape($topic);
$msgEsc   = $database->escape($message);

$time = time();

// ---------------------------------------------------------------------------
// INSERT MESAJ (FULL FIX)
// ---------------------------------------------------------------------------
$sql = "
INSERT INTO " . TB_PREFIX . "mdata 
(
    target,
    owner,
    topic,
    message,
    viewed,
    archived,
    send,
    time,
    deltarget,
    delowner,
    alliance,
    player,
    coor,
    report
)
VALUES
(
    $uid,
    $adminId,
    '$topicEsc',
    '$msgEsc',
    0,
    0,
    0,
    $time,
    0,
    0,
    0,
    0,
    0,
    0
)
";

$result = $database->query($sql);

if (!$result) {
    die("Message insert failed: " . $database->getError());
}

// ---------------------------------------------------------------------------
// LOG ADMIN ACTION
// ---------------------------------------------------------------------------
$logText = "Sent message to uid $uid: '$topicEsc'";
$logEsc  = $database->escape($logText);

$database->query("
INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
VALUES (0, $adminId, '$logEsc', $time)
");

// ---------------------------------------------------------------------------
// REDIRECT SUCCESS
// ---------------------------------------------------------------------------
header("Location: ../../../Admin/admin.php?p=Newmessage&uid=" . $uid . "&msg=ok");
exit;
?>