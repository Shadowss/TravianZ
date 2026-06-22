<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editPlus.php                                                ##
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
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php?p=search");
    exit;
}

$time = time();
$bonusDuration = [
    'plus' => (int)($_POST['plus'] ?? 0) * 86400,
    'b1'   => (int)($_POST['wood'] ?? 0) * 86400,
    'b2'   => (int)($_POST['clay'] ?? 0) * 86400,
    'b3'   => (int)($_POST['iron'] ?? 0) * 86400,
    'b4'   => (int)($_POST['crop'] ?? 0) * 86400,
];

$user = $database->getUserArray($id, 1);
if (!$user) {
    header("Location: ../../../Admin/admin.php?p=player&uid=$id&e=notfound");
    exit;
}

foreach ($bonusDuration as $key => $add) {
    $current = (int)($user[$key] ?? 0);
    $base = $current < $time ? $time : $current;
    // A negative value subtracts days (the form advertises "Add / Remove Days").
    // 0 leaves the current expiry untouched; the clamp below caps it at "expired".
    $bonusDuration[$key] = $add != 0 ? $base + $add : $current;
    if ($bonusDuration[$key] < $time) {
        $bonusDuration[$key] = 0;
    }
}

$database->updateUserField($id, array_keys($bonusDuration), array_values($bonusDuration), 1);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$logText = "Updated Plus/bonuses for user <a href='admin.php?p=player&uid=$id'>$id</a> (plus={$_POST['plus']}d, wood={$_POST['wood']}d, clay={$_POST['clay']}d, iron={$_POST['iron']}d, crop={$_POST['crop']}d)";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminId', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=player&uid=" . $id);
exit;
?>