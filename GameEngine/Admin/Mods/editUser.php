<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.php                                                ##
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
// Input
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);
$id      = (int)($_POST['id'] ?? 0);

if ($id <= 0 || $session <= 0) {
    header("Location: ../../../Admin/admin.php?p=player&uid=$id&e=bad");
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
// Câmpuri
// ---------------------------------------------------------------------------
$email_raw = trim($_POST['email'] ?? '');
$email     = filter_var($email_raw, FILTER_VALIDATE_EMAIL) ? $email_raw : '';
$email     = $database->escape($email);

$tribe    = max(1, min(5, (int)($_POST['tribe'] ?? 1)));

$location_raw = trim($_POST['location'] ?? '');
$location = $database->escape(
    $database->RemoveXSS(mb_substr(strip_tags($location_raw), 0, 50))
);

$desc1_raw = $_POST['desc1'] ?? '';
$desc1 = $database->escape(
    $database->RemoveXSS(mb_substr(strip_tags($desc1_raw, '<b><i><u><br>'), 0, 5000))
);

$desc2_raw = $_POST['desc2'] ?? '';
$desc2 = $database->escape(
    $database->RemoveXSS(mb_substr(strip_tags($desc2_raw, '<b><i><u><br>'), 0, 5000))
);

$quest_raw = trim($_POST['quest'] ?? '');
$quest = $database->escape(
    $database->RemoveXSS(mb_substr(strip_tags($quest_raw), 0, 200))
);

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "users SET 
        email = '$email',
        tribe = $tribe,
        location = '$location',
        desc1 = '$desc1',
        desc2 = '$desc2',
        quest = '$quest'
     WHERE id = $id"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();

// FIX: username + ID formatat
$targetName = $database->getUserField($id, 'username', 0) ?: 'UID '.$id;
$targetNameSafe = htmlspecialchars($targetName, ENT_QUOTES, 'UTF-8');

$logText = "Edited profile for user <a href='admin.php?p=player&uid=$id'>$targetNameSafe</a>";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id);
exit;
?>