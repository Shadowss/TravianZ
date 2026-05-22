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
// Input
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);
$uid     = (int)($_POST['uid'] ?? 0);
$topic   = trim($_POST['topic'] ?? 'Admin Message');
$message = trim($_POST['message'] ?? '');

if ($uid <= 0 || $message === '') {
    header("Location: ../../../Admin/admin.php?p=Newmessage&uid=$uid&e=1");
    exit;
}

// ---------------------------------------------------------------------------
// Verificare admin
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($session, 1);
if (!$admin || (int)$admin['access'] !== 9) {
    die('<h1><font color="red">Access Denied: You are not Admin!</font></h1>');
}

// ---------------------------------------------------------------------------
// Insert mesaj
// ---------------------------------------------------------------------------
$time = time();
$topicEsc = $database->escape($topic);
$msgEsc   = $database->escape($message);

$database->query(
    "INSERT INTO " . TB_PREFIX . "mdata 
    (target, owner, topic, message, viewed, time, archive) 
    VALUES ($uid, 1, '$topicEsc', '$msgEsc', 0, $time, 0)"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$logText = "Sent message to uid $uid: '$topicEsc'";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=Newmessage&uid=" . $uid . "&msg=ok");
exit;
?>