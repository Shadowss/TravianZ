<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editWeek.php                                                ##
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
// Valori
// ---------------------------------------------------------------------------
$ap  = (int)($_POST['off'] ?? 0);
$dp  = (int)($_POST['def'] ?? 0);
$rr  = (int)($_POST['res'] ?? 0);

// ---------------------------------------------------------------------------
// Update
// ---------------------------------------------------------------------------
$database->query("UPDATE " . TB_PREFIX . "users SET ap = $ap, dp = $dp, RR = $rr WHERE id = $id");

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();
$logText = "Changed weekly stats for user <a href='admin.php?p=player&uid=$id'>$id</a> (ap=$ap, dp=$dp, RR=$rr)";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id);
exit;
?>