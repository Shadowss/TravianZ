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
##  Filename       blockReg.php                                               ##
##  Type           BACKEND (Registration blocklist add/remove)                ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.               ##
#################################################################################

require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to do this. '
        . 'Your session may have expired â€” please return to the admin panel and sign in again.'
    );
}

csrf_verify();

include_once("../../config.php");

$autoprefix = '';

for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . "GameEngine/Database.php");
include_once($autoprefix . "GameEngine/RegBlock.php");

$admid = (int)($_SESSION['id'] ?? 0);

// Defence in depth: confirm the acting account really is an admin.
$check = mysqli_query(
    $GLOBALS['link'],
    "SELECT access FROM " . TB_PREFIX . "users WHERE id = " . $admid
);

$acc = $check ? mysqli_fetch_assoc($check) : null;

if (!$acc || (int)$acc['access'] < ADMIN) {
    admin_deny('Your session may have expired â€” please sign in again.');
}

$do = $_POST['do'] ?? '';

if ($do === 'add') {
    $type  = $_POST['type'] ?? '';
    $value = $_POST['value'] ?? '';
    $note  = $_POST['note'] ?? '';

    list($ok, $msg) = RegBlock::add($type, $value, $note, $admid);

    if ($ok) {
        $logMsg = 'Registration block added: ' . $type . ' = ' . RegBlock_safe($value);
        $logMsg = mysqli_real_escape_string($GLOBALS['link'], $logMsg);

        mysqli_query(
            $GLOBALS['link'],
            "INSERT INTO " . TB_PREFIX . "admin_log VALUES (0, " . $admid . ", '" . $logMsg . "', " . time() . ")"
        );
    }

    header("Location: ../../../Admin/admin.php?p=blockReg&msg=" . urlencode($msg));
    exit;
}

if ($do === 'remove') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0 && RegBlock::remove($id)) {
        mysqli_query(
            $GLOBALS['link'],
            "INSERT INTO " . TB_PREFIX . "admin_log VALUES (0, " . $admid . ", 'Registration block removed (id " . $id . ")', " . time() . ")"
        );

        header(
            "Location: ../../../Admin/admin.php?p=blockReg&msg="
            . urlencode('Block removed.')
        );
        exit;
    }

    header(
        "Location: ../../../Admin/admin.php?p=blockReg&msg="
        . urlencode('Could not remove block.')
    );
    exit;
}

header("Location: ../../../Admin/admin.php?p=blockReg");
exit;

/**
 * Small helper: keep the admin-log message readable/short.
 */
function RegBlock_safe($v)
{
    $v = strtolower(trim((string)$v));

    return strlen($v) > 80
        ? substr($v, 0, 77) . '...'
        : $v;
}
