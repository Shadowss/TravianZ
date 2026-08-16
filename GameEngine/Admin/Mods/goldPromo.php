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
##  Filename       goldPromo.php                                               ##
##  Type           BACKEND (Gold shop / promo codes)                           ##
##  Developed by:  Shadow                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
#################################################################################

// ---------------------------------------------------------------------------
// CSRF + vérification administrateur
// ---------------------------------------------------------------------------
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to do this. ' .
        'Your session may have expired — please return to the admin panel ' .
        'and sign in again.'
    );
}

csrf_verify();

// ---------------------------------------------------------------------------
// Chargement de la base de données
// ---------------------------------------------------------------------------
$autoprefix = '';

for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . 'GameEngine/Database.php');
include_once($autoprefix . 'GameEngine/GoldShop.php');

// ---------------------------------------------------------------------------
// Vérification supplémentaire de l'administrateur
// ---------------------------------------------------------------------------
$admid = (int)($_SESSION['id'] ?? 0);

$check = mysqli_query(
    $GLOBALS['link'],
    "SELECT access FROM " . TB_PREFIX . "users WHERE id = " . $admid
);

$acc = $check ? mysqli_fetch_assoc($check) : null;

if (!$acc || (int)$acc['access'] < 9) {
    admin_deny(
        'Your session may have expired — please sign in again.'
    );
}

// ---------------------------------------------------------------------------
// Action
// ---------------------------------------------------------------------------
$do  = $_POST['do'] ?? '';
$msg = '';

if ($do === 'create') {

    $code    = $_POST['code'] ?? '';
    $gold    = (int)($_POST['gold'] ?? 0);
    $maxUses = (int)($_POST['max_uses'] ?? 0);
    $perUser = isset($_POST['per_user']) ? 1 : 0;

    // Expiration option:
    // number of days from now; 0 = no expiration.
    $expDays = (int)($_POST['expires_days'] ?? 0);
    $expires = $expDays > 0
        ? time() + ($expDays * 86400)
        : 0;

    $note = $_POST['note'] ?? '';

    list(
        $ok,
        $msg
    ) = GoldShop::createCode(
        $code,
        $gold,
        $maxUses,
        $perUser,
        $expires,
        $note,
        $admid
    );

    if ($ok) {
        $logMsg = mysqli_real_escape_string(
            $GLOBALS['link'],
            'Promo code created: ' .
            GoldShop::normCode($code) .
            ' (' .
            (int)$gold .
            ' gold)'
        );

        mysqli_query(
            $GLOBALS['link'],
            "INSERT INTO " . TB_PREFIX . "admin_log " .
            "VALUES (0, " .
            $admid .
            ", '" .
            $logMsg .
            "', " .
            time() .
            ")"
        );
    }

} elseif ($do === 'toggle') {

    $id     = (int)($_POST['id'] ?? 0);
    $active = (int)($_POST['active'] ?? 0);

    if ($id > 0) {
        GoldShop::setActive($id, $active);

        $msg = $active
            ? 'Code enabled.'
            : 'Code disabled.';
    }

} elseif ($do === 'delete') {

    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0) {
        GoldShop::deleteCode($id);

        mysqli_query(
            $GLOBALS['link'],
            "INSERT INTO " . TB_PREFIX . "admin_log " .
            "VALUES (0, " .
            $admid .
            ", 'Promo code deleted (id " .
            $id .
            ")', " .
            time() .
            ")"
        );

        $msg = 'Code deleted.';
    }
}

// ---------------------------------------------------------------------------
// Retour vers le Gold Shop
// ---------------------------------------------------------------------------
header(
    "Location: ../../../Admin/admin.php?p=goldShop&msg=" .
    urlencode($msg)
);
exit;
?>