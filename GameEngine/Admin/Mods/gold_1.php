<?php

// ============================================================
// TRAVIANZ MI INSTANCE / SESSION BOOTSTRAP
// ============================================================
require_once(__DIR__ . '/../../Instance/Resolver.php');

$travianInstance = InstanceResolver::resolve(false);
InstanceResolver::startInstanceSession($travianInstance);

include_once(__DIR__ . '/../../config.php');

if (file_exists(__DIR__ . '/../../Lang/loader.php')) {
    require_once(__DIR__ . '/../../Lang/loader.php');
    if (defined('LANG') && function_exists('tz_load_language')) {
        tz_load_language(LANG);
    }
}

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold_1.php                                                  ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired â€” please return to the admin panel and sign in again.');
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

include_once(__DIR__ . '/../../Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$admid  = (int)($_POST['admid'] ?? 0);
$id     = (int)($_POST['id'] ?? 0);
$amount = (int)($_POST['gold'] ?? 0);

if ($id <= 0 || $amount === 0) {
    header("Location: ../../../Admin/admin.php?p=usergold");
    exit;
}

// ---------------------------------------------------------------------------
// Vérification admin
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($admid, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired â€” please return to the admin panel and sign in again.');
}

// ---------------------------------------------------------------------------
// 1. Mise à jour de l'or
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "users
     SET gold = gold + $amount
     WHERE id = $id"
);

// ---------------------------------------------------------------------------
// 2. Journal administrateur
// ---------------------------------------------------------------------------
$targetName = $database->getUserField($id, 'username', 0) ?: 'UID ' . $id;
$targetNameSafe = htmlspecialchars($targetName, ENT_QUOTES, 'UTF-8');

$logText = "Added <b>$amount</b> gold to user <a href='admin.php?p=player&uid=$id'>$targetNameSafe</a>";
$logEsc = $database->escape($logText);

$adminId = (int)$_SESSION['id'];
$time = time();

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// 3. GOLD_FIN_LOG (pour a2b2.php)
// ---------------------------------------------------------------------------
$vill = $database->query(
    "SELECT wref
     FROM " . TB_PREFIX . "vdata
     WHERE owner = $id
     LIMIT 1"
);

$villData = $vill ? mysqli_fetch_assoc($vill) : null;
$wid = (int)($villData['wref'] ?? 0);

$action = $amount > 0 ? 'Admin added Gold' : 'Admin removed Gold';

$adminName = $admin['username'] ?? 'Administrator';
$detailsRaw = 'Admin gift by ' . $adminName;
$details = $database->escape($detailsRaw);

$database->query(
    "INSERT INTO " . TB_PREFIX . "gold_fin_log
        (wid, uid, action, gold, time, details)
     VALUES
        ($wid, $id, '" . $database->escape($action) . "', $amount, " . time() . ", '$details')"
);

// ---------------------------------------------------------------------------
// Retour ACP
// ---------------------------------------------------------------------------
header("Location: ../../../Admin/admin.php?p=usergold&g");
exit;
?>