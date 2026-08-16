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
##  Filename       addABTroops.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');
if (!isset($_SESSION)) {
}
if (!isset(<?php

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
##  Filename       addABTroops.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');
if (!isset($_SESSION)) {
}
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired â€” please return to the admin panel and sign in again.');
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once __DIR__ . "/../../Database.php";

/* ---------------------------------------------------------------------------
 * Input
 * --------------------------------------------------------------------------- */
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

$village = $database->getVillage($id);

/* ---------------------------------------------------------------------------
 * Update a1-a8 / b1-b8
 * --------------------------------------------------------------------------- */
$fields = [];
for ($i = 1; $i <= 8; $i++) {
    $a = (int)($_POST['a' . $i] ?? 0);
    $b = (int)($_POST['b' . $i] ?? 0);
    $fields[] = "a$i = $a";
    $fields[] = "b$i = $b";
}

$q = "UPDATE " . TB_PREFIX . "abdata SET " . implode(", ", $fields) . " WHERE vref = $id";
$database->query($q);

/* ---------------------------------------------------------------------------
 * Log admin - adaptat pentru structura ta:
 * CREATE TABLE `s1_admin_log` (`id` int, `user` text, `log` text, `time` int)
 * --------------------------------------------------------------------------- */
$adminId = (string)(int)$_SESSION['id'];
$time = time();

// FIX: luÄƒm numele satului
$village = $database->getVillage($id); // dacÄƒ nu-l ai deja sus, lasÄƒ linia asta
$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');

$logText = "Changed troop upgrade levels in village <a href='admin.php?p=village&did=$id'>$villageNameSafe</a>";

// escapÄƒm corect pentru coloana TEXT
$adminIdEsc = $database->escape($adminId);
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminIdEsc', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=village&did=" . $id . "&ab");
exit;
?>SESSION['access']) || (int)<?php

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
##  Filename       addABTroops.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');
if (!isset($_SESSION)) {
}
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired â€” please return to the admin panel and sign in again.');
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once __DIR__ . "/../../Database.php";

/* ---------------------------------------------------------------------------
 * Input
 * --------------------------------------------------------------------------- */
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

$village = $database->getVillage($id);

/* ---------------------------------------------------------------------------
 * Update a1-a8 / b1-b8
 * --------------------------------------------------------------------------- */
$fields = [];
for ($i = 1; $i <= 8; $i++) {
    $a = (int)($_POST['a' . $i] ?? 0);
    $b = (int)($_POST['b' . $i] ?? 0);
    $fields[] = "a$i = $a";
    $fields[] = "b$i = $b";
}

$q = "UPDATE " . TB_PREFIX . "abdata SET " . implode(", ", $fields) . " WHERE vref = $id";
$database->query($q);

/* ---------------------------------------------------------------------------
 * Log admin - adaptat pentru structura ta:
 * CREATE TABLE `s1_admin_log` (`id` int, `user` text, `log` text, `time` int)
 * --------------------------------------------------------------------------- */
$adminId = (string)(int)$_SESSION['id'];
$time = time();

// FIX: luÄƒm numele satului
$village = $database->getVillage($id); // dacÄƒ nu-l ai deja sus, lasÄƒ linia asta
$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');

$logText = "Changed troop upgrade levels in village <a href='admin.php?p=village&did=$id'>$villageNameSafe</a>";

// escapÄƒm corect pentru coloana TEXT
$adminIdEsc = $database->escape($adminId);
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminIdEsc', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=village&did=" . $id . "&ab");
exit;
?>SESSION['access'] < 9) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired â€” please return to the admin panel and sign in again.');
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once __DIR__ . "/../../Database.php";

/* ---------------------------------------------------------------------------
 * Input
 * --------------------------------------------------------------------------- */
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: ../../../Admin/admin.php");
    exit;
}

$village = $database->getVillage($id);

/* ---------------------------------------------------------------------------
 * Update a1-a8 / b1-b8
 * --------------------------------------------------------------------------- */
$fields = [];
for ($i = 1; $i <= 8; $i++) {
    $a = (int)($_POST['a' . $i] ?? 0);
    $b = (int)($_POST['b' . $i] ?? 0);
    $fields[] = "a$i = $a";
    $fields[] = "b$i = $b";
}

$q = "UPDATE " . TB_PREFIX . "abdata SET " . implode(", ", $fields) . " WHERE vref = $id";
$database->query($q);

/* ---------------------------------------------------------------------------
 * Log admin - adaptat pentru structura ta:
 * CREATE TABLE `s1_admin_log` (`id` int, `user` text, `log` text, `time` int)
 * --------------------------------------------------------------------------- */
$adminId = (string)(int)$_SESSION['id'];
$time = time();

// FIX: luÄƒm numele satului
$village = $database->getVillage($id); // dacÄƒ nu-l ai deja sus, lasÄƒ linia asta
$villageName = $village['name'] ?? 'Village';
$villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');

$logText = "Changed troop upgrade levels in village <a href='admin.php?p=village&did=$id'>$villageNameSafe</a>";

// escapÄƒm corect pentru coloana TEXT
$adminIdEsc = $database->escape($adminId);
$logEsc = $database->escape($logText);

$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$adminIdEsc', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=village&did=" . $id . "&ab");
exit;
?>
