<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       goldPromo.php                                              ##
##  Type           BACKEND (Gold shop / promo codes)                         ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianZ Project                                           ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.               ##
#################################################################################

require_once(__DIR__ . '/../csrf.php');
if (!isset($_SESSION)) session_start();
if ($_SESSION['access'] < ADMIN) {
    admin_deny('You must be signed in as an administrator to do this. '
        . 'Your session may have expired — please return to the admin panel and sign in again.');
}

csrf_verify();

include_once("../../config.php");

$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) break;
}
include_once($autoprefix . "GameEngine/Database.php");
include_once($autoprefix . "GameEngine/GoldShop.php");

$admid = (int)($_SESSION['id'] ?? 0);

$check = mysqli_query($GLOBALS['link'],
    "SELECT access FROM " . TB_PREFIX . "users WHERE id = " . $admid);
$acc = $check ? mysqli_fetch_assoc($check) : null;
if (!$acc || (int)$acc['access'] < ADMIN) {
    admin_deny('Your session may have expired — please sign in again.');
}

$do  = $_POST['do'] ?? '';
$msg = '';

if ($do === 'create') {
    $code    = $_POST['code']     ?? '';
    $gold    = (int)($_POST['gold'] ?? 0);
    $maxUses = (int)($_POST['max_uses'] ?? 0);
    $perUser = isset($_POST['per_user']) ? 1 : 0;

    // Optional expiry: number of days from now (0/empty = never).
    $expDays = (int)($_POST['expires_days'] ?? 0);
    $expires = $expDays > 0 ? time() + $expDays * 86400 : 0;

    $note = $_POST['note'] ?? '';

    list($ok, $msg) = GoldShop::createCode($code, $gold, $maxUses, $perUser, $expires, $note, $admid);
    if ($ok) {
        $logMsg = mysqli_real_escape_string($GLOBALS['link'],
            'Promo code created: ' . GoldShop::normCode($code) . ' (' . (int)$gold . ' gold)');
        mysqli_query($GLOBALS['link'],
            "INSERT INTO " . TB_PREFIX . "admin_log VALUES (0, " . $admid . ", '" . $logMsg . "', " . time() . ")");
    }
} elseif ($do === 'toggle') {
    $id     = (int)($_POST['id'] ?? 0);
    $active = (int)($_POST['active'] ?? 0);
    if ($id > 0) {
        GoldShop::setActive($id, $active);
        $msg = $active ? 'Code enabled.' : 'Code disabled.';
    }
} elseif ($do === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        GoldShop::deleteCode($id);
        mysqli_query($GLOBALS['link'],
            "INSERT INTO " . TB_PREFIX . "admin_log VALUES (0, " . $admid . ", 'Promo code deleted (id " . $id . ")', " . time() . ")");
        $msg = 'Code deleted.';
    }
}

header("Location: ../../../Admin/admin.php?p=goldShop&msg=" . urlencode($msg));
exit;
?>
