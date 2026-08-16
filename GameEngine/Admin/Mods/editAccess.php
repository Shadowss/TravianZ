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
##  Filename       editUser.php                                                ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['access']) || (int)$_SESSION['access'] < 9) {
    admin_deny(
        'You must be signed in as an administrator to view this page. ' .
        'Your session may have expired — please return to the admin panel and sign in again.'
    );
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

// Database.php utilise désormais le bootstrap MI déjà chargé ci-dessus.
require_once(__DIR__ . '/../../GameEngine/Database.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$id = (int)($_POST['uid'] ?? 0);
$access = (int)($_POST['access'] ?? -1);

if ($id <= 0) {
    header("Location: ../../../Admin/admin.php?p=search&e=bad");
    exit;
}

// ---------------------------------------------------------------------------
// Vérification du niveau d'accès demandé
// ---------------------------------------------------------------------------
// Valeurs autorisées par le formulaire TravianZ :
// 0 = Banned
// 2 = Normal user
// 8 = Multihunter
// 9 = Admin
if (!in_array($access, [0, 2, 8, 9], true)) {
    die("Invalid access level");
}

// ---------------------------------------------------------------------------
// Modification du compte
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "users SET access = $access WHERE id = $id"
);

// ---------------------------------------------------------------------------
// Retour vers la fiche du joueur
// ---------------------------------------------------------------------------
header(
    "Location: ../../../Admin/admin.php?p=player&uid=" . $id
);
exit;
?>
