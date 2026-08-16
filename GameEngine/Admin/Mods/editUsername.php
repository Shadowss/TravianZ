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
##  Filename       editUsername.php                                            ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// ---------------------------------------------------------------------------
// CSRF + admin access
// ---------------------------------------------------------------------------
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel '
        . 'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// CSRF verification
// ---------------------------------------------------------------------------
// This file is POSTed to directly, so it must verify the CSRF token itself.
csrf_verify();

// ---------------------------------------------------------------------------
// Configuration
// ---------------------------------------------------------------------------
include_once(__DIR__ . '/../../config.php');

// ---------------------------------------------------------------------------
// Autoloader / Database
// ---------------------------------------------------------------------------
$autoprefix = '';

for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . 'GameEngine/Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$uid = (int)($_POST['uid'] ?? 0);
$session = (int)($_POST['admid'] ?? 0);
$username = trim($_POST['username'] ?? '');

// ---------------------------------------------------------------------------
// Basic validation
// ---------------------------------------------------------------------------
if ($uid <= 0 || $session <= 0 || $username === '') {
    header(
        'Location: ../../../Admin/admin.php?p=player&uid='
        . $uid
        . '&e=user'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Verify administrator
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($session, 1);

if (!$admin || (int)$admin['access'] !== 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel '
        . 'and sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Validate username
// ---------------------------------------------------------------------------
// Mirror the registration rules from Account.php.
//
// When USRNM_SPECIAL is enabled:
//   - letters
//   - digits
//   - . _ -
//   - single spaces between name parts
//
// When disabled:
//   - ASCII letters and digits only
$usernameSpecial = defined('USRNM_SPECIAL')
    ? (bool)USRNM_SPECIAL
    : false;

$minLen = defined('USRNM_MIN_LENGTH')
    ? (int)USRNM_MIN_LENGTH
    : 3;

$maxLen = defined('USRNM_MAX_LENGTH')
    ? (int)USRNM_MAX_LENGTH
    : 15;

if ($usernameSpecial) {
    $charsOk = (bool)preg_match(
        '/^[A-Za-z0-9._-]+(?: [A-Za-z0-9._-]+)*$/D',
        $username
    );
} else {
    $charsOk = !preg_match(
        '/[^0-9A-Za-z]/',
        $username
    );
}

if (
    strlen($username) < $minLen
    || strlen($username) > $maxLen
    || !$charsOk
) {
    header(
        'Location: ../../../Admin/admin.php?p=player&uid='
        . $uid
        . '&e=invalid'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Check duplicate username
// ---------------------------------------------------------------------------
$usernameEsc = $database->escape($username);

$check = $database->query(
    "SELECT id
     FROM " . TB_PREFIX . "users
     WHERE username = '$usernameEsc'
       AND id != $uid
     LIMIT 1"
);

if ($check && mysqli_num_rows($check) > 0) {
    header(
        'Location: ../../../Admin/admin.php?p=player&uid='
        . $uid
        . '&e=taken'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Update username
// ---------------------------------------------------------------------------
$result = $database->query(
    "UPDATE " . TB_PREFIX . "users
     SET username = '$usernameEsc'
     WHERE id = $uid"
);

if (!$result) {
    header(
        'Location: ../../../Admin/admin.php?p=player&uid='
        . $uid
        . '&e=error'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Log admin action
// ---------------------------------------------------------------------------
$adminId = (int)($_SESSION['id'] ?? 0);
$time = time();

$logText = "Changed username for user $uid to '$usernameEsc'";
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// Success
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=player&uid='
    . $uid
    . '&name=1'
);
exit;
?>