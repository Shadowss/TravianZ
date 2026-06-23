<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       mainteneceBan.php                                           ##
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
// Verificare admin
// ---------------------------------------------------------------------------
$session = (int)($_POST['admid'] ?? 0);
$admin = $database->getUserArray($session, 1);
if (!$admin || (int)$admin['access'] !== 9) {
    die('<h1><font color="red">Access Denied: You are not Admin!</font></h1>');
}

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$duration = (int)($_POST['duration'] ?? 0) * 3600;
$start    = trim($_POST['start'] ?? '');
$reason   = trim($_POST['reason'] ?? 'Maintenance ban');
$access   = 2; // jucători normali

$startts = $start ? strtotime($start) : time();
if ($startts === false) $startts = time();

$endts = $startts + $duration;
if ($duration <= 0) $endts = $startts + 86400; // default 1 zi

$reasonEsc = $database->escape($reason);
$adminId = (int)$session;

// ---------------------------------------------------------------------------
// Ban în masă – un singur query
// ---------------------------------------------------------------------------
$database->query(
    "INSERT INTO " . TB_PREFIX . "banlist (uid, name, reason, time, end, admin, active)
     SELECT id, username, '$reasonEsc', $startts, $endts, $adminId, 1
     FROM " . TB_PREFIX . "users
     WHERE access = $access AND id > 3
     ON DUPLICATE KEY UPDATE 
        reason = VALUES(reason),
        time = VALUES(time),
        end = VALUES(end),
        admin = VALUES(admin),
        active = 1"
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$time = time();
$logText = "Mass ban for access=$access, duration=" . ($duration/3600) . "h, reason='$reasonEsc'";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=ban&m=1");
exit;
?>