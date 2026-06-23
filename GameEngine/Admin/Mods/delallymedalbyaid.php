<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       deletemedalsbyuser.php                                      ##
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

include_once($autoprefix . "GameEngine/config.php");
include_once($autoprefix . "GameEngine/Database.php");

// ---------------------------------------------------------------------------
// Input - folosim un singur ID pentru alianță
// ---------------------------------------------------------------------------
$aid     = (int)($_POST['aid'] ?? $_POST['allyid'] ?? 0);
$session = (int)($_POST['admid'] ?? 0);

if ($aid <= 0 || $session <= 0) {
    header("Location: ../../../Admin/admin.php?p=alliance&aid=" . $aid . "&e=bad");
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
// Ștergere logică - toate medaliile alianței
// ---------------------------------------------------------------------------
$database->query("UPDATE " . TB_PREFIX . "allimedal SET del = 1 WHERE allyid = $aid AND del = 0");
$affected = mysqli_affected_rows($database->dblink);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time = time();
$logText = "Deleted all medals ($affected) for alliance <a href='admin.php?p=alliance&aid=$aid'>$aid</a>";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=alliance&aid=" . $aid . "&deleted=$affected");
exit;
?>