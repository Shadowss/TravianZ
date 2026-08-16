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
##  Filename       delAli.php                                                  ##
##  Type           BACKEND                                                     ##
##  Developed by:  Shadow (dupÄƒ model editUser)                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');

if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired â€” please return to the admin panel and sign in again.');
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
csrf_verify();

include_once(__DIR__ . '/../../Database.php');
include_once(__DIR__ . '/../../Technology.php');

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$aid   = (int)($_POST['aid'] ?? 0);
$admid = (int)($_POST['admid'] ?? 0);

if ($aid <= 0 || $admid <= 0) {
    header("Location: ../../../Admin/admin.php?p=alliance&aid=0&e=bad");
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
// 1. Retirer tous les membres de l'alliance
// ---------------------------------------------------------------------------
$database->query(
    "UPDATE " . TB_PREFIX . "users
     SET alliance = 0
     WHERE alliance = $aid"
);

// ---------------------------------------------------------------------------
// 2. Supprimer la structure de l'alliance
// ---------------------------------------------------------------------------
$database->query(
    "DELETE FROM " . TB_PREFIX . "alidata
     WHERE id = $aid"
);

$database->query(
    "DELETE FROM " . TB_PREFIX . "ali_permission
     WHERE alliance = $aid"
);

$database->query(
    "DELETE FROM " . TB_PREFIX . "ali_invite
     WHERE alliance = $aid"
);

$database->query(
    "DELETE FROM " . TB_PREFIX . "ali_log
     WHERE aid = $aid"
);

// ---------------------------------------------------------------------------
// 3. Supprimer la diplomatie
// ---------------------------------------------------------------------------
$database->query(
    "DELETE FROM " . TB_PREFIX . "diplomacy
     WHERE alli1 = $aid OR alli2 = $aid"
);

// ---------------------------------------------------------------------------
// 4. Supprimer le forum de l'alliance
// ---------------------------------------------------------------------------

// Supprimer d'abord les messages appartenant aux topics de l'alliance.
$database->query(
    "DELETE p
     FROM " . TB_PREFIX . "forum_post p
     INNER JOIN " . TB_PREFIX . "forum_topic t
         ON p.topic = t.id
     WHERE t.alliance = $aid"
);

// Supprimer ensuite les topics.
$database->query(
    "DELETE FROM " . TB_PREFIX . "forum_topic
     WHERE alliance = $aid"
);

// Puis supprimer les catégories.
$database->query(
    "DELETE FROM " . TB_PREFIX . "forum_cat
     WHERE alliance = $aid"
);

// ---------------------------------------------------------------------------
// 5. Journal administrateur
// ---------------------------------------------------------------------------
$adminId = (int)$_SESSION['id'];
$time    = time();

$logText = "Deleted alliance ID $aid";
$logEsc  = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
     VALUES (0, '$adminId', '$logEsc', $time)"
);

// ---------------------------------------------------------------------------
// Retour ACP
// ---------------------------------------------------------------------------
header("Location: ../../../Admin/admin.php?p=search&delali=1");
exit;
?>