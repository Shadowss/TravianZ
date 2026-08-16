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
##  Filename       editPlus.php                                                ##
##  Type           BACKEND                                                     ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.               ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. '
        . 'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

// ---------------------------------------------------------------------------
// Database
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
$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: ../../../Admin/admin.php?p=search');
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

// ---------------------------------------------------------------------------
// User
// ---------------------------------------------------------------------------
$user = $database->getUserArray($id, 1);

if (!$user) {
    header(
        'Location: ../../../Admin/admin.php?p=player&uid='
        . $id
        . '&e=notfound'
    );
    exit;
}

// ---------------------------------------------------------------------------
// Calculate new bonus expiration dates
// ---------------------------------------------------------------------------
// Positive values add days.
// Negative values remove days.
// Zero leaves the current expiration unchanged.
// If the resulting expiration is in the past, it is reset to 0.
foreach ($bonusDuration as $key => $add) {
    $current = (int)($user[$key] ?? 0);

    $base = $current < $time ? $time : $current;

    if ($add != 0) {
        $bonusDuration[$key] = $base + $add;
    } else {
        $bonusDuration[$key] = $current;
    }

    if ($bonusDuration[$key] < $time) {
        $bonusDuration[$key] = 0;
    }
}

// ---------------------------------------------------------------------------
// Update user
// ---------------------------------------------------------------------------
$database->updateUserField(
    $id,
    array_keys($bonusDuration),
    array_values($bonusDuration),
    1
);

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];

$plusDays = (int)($_POST['plus'] ?? 0);
$woodDays = (int)($_POST['wood'] ?? 0);
$clayDays = (int)($_POST['clay'] ?? 0);
$ironDays = (int)($_POST['iron'] ?? 0);
$cropDays = (int)($_POST['crop'] ?? 0);

$logText =
    "Updated Plus/bonuses for user "
    . "<a href='admin.php?p=player&uid=$id'>$id</a>"
    . " (plus={$plusDays}d, wood={$woodDays}d, clay={$clayDays}d, "
    . "iron={$ironDays}d, crop={$cropDays}d)";

$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) "
    . "VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// Redirect
// ---------------------------------------------------------------------------
header(
    'Location: ../../../Admin/admin.php?p=player&uid='
    . $id
);

exit;
?>