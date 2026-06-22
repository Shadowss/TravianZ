<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editSitter.php                                              ##
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
$sit1    = (int)($_POST['sitter1'] ?? 0);
$sit2    = (int)($_POST['sitter2'] ?? 0);

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
// Update
// ---------------------------------------------------------------------------
$database->query("UPDATE " . TB_PREFIX . "users SET sit1 = $sit1, sit2 = $sit2 WHERE id = $id");

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();

// FIX: username pentru target + sitteri
$targetName = $database->getUserField($id, 'username', 0) ?: 'UID '.$id;
$targetNameSafe = htmlspecialchars($targetName, ENT_QUOTES, 'UTF-8');

$sit1Name = $sit1 > 0 ? ($database->getUserField($sit1, 'username', 0) ?: $sit1) : 'none';
$sit2Name = $sit2 > 0 ? ($database->getUserField($sit2, 'username', 0) ?: $sit2) : 'none';

$logText = "Changed sitters for user <a href='admin.php?p=player&uid=$id'>$targetNameSafe</a> (sit1=$sit1Name, sit2=$sit2Name)";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id);
exit;
?>