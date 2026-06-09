<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       delAli.php                                                  ##
##  Type           BACKEND                                                     ##
##  Developed by:  Shadow (după model editUser)                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                 ##
#################################################################################

if (!isset($_SESSION)) { session_start(); }
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die("Access Denied: You are not Admin!");
}

include_once("../../config.php");

// ---------------------------------------------------------------------------
// Autoloader path - la fel ca în editUser.php
// ---------------------------------------------------------------------------
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) { break; }
}
include_once($autoprefix . "GameEngine/Database.php");

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$aid   = (int)($_POST['aid'] ?? 0);
$admid = (int)($_POST['admid'] ?? 0);

if ($aid <= 0 || $admid <= 0) {
    header("Location: ../../Admin/admin.php?p=alliance&aid=0&e=bad");
    exit;
}

// ---------------------------------------------------------------------------
// Verificare admin
// ---------------------------------------------------------------------------
$admin = $database->getUserArray($admid, 1);
if (!$admin || (int)$admin['access'] !== 9) {
    die('<h1><font color="red">Access Denied: You are not Admin!</font></h1>');
}

// ---------------------------------------------------------------------------
// 1. Scoate toți membrii
// ---------------------------------------------------------------------------
$database->query("UPDATE " . TB_PREFIX . "users SET alliance = 0 WHERE alliance = $aid");

// ---------------------------------------------------------------------------
// 2. Șterge structura alianței
// ---------------------------------------------------------------------------
$database->query("DELETE FROM " . TB_PREFIX . "alidata WHERE id = $aid");
$database->query("DELETE FROM " . TB_PREFIX . "ali_permission WHERE alliance = $aid");
$database->query("DELETE FROM " . TB_PREFIX . "ali_invite WHERE alliance = $aid");
$database->query("DELETE FROM " . TB_PREFIX . "ali_log WHERE aid = $aid");

// ---------------------------------------------------------------------------
// 3. Șterge diplomația
// ---------------------------------------------------------------------------
$database->query("DELETE FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $aid OR alli2 = $aid");

// ---------------------------------------------------------------------------
// 4. Șterge forumul - CORECTAT pentru structura ta
// ---------------------------------------------------------------------------
// întâi posturile (prin topic)
$database->query("DELETE p FROM " . TB_PREFIX . "forum_post p 
    INNER JOIN " . TB_PREFIX . "forum_topic t ON p.topic = t.id 
    WHERE t.alliance = $aid");

// apoi topicurile
$database->query("DELETE FROM " . TB_PREFIX . "forum_topic WHERE alliance = $aid");

// apoi categoriile
$database->query("DELETE FROM " . TB_PREFIX . "forum_cat WHERE alliance = $aid");

// ---------------------------------------------------------------------------
// Log admin
// ---------------------------------------------------------------------------
$time = time();
$logText = "Deleted alliance ID $aid";
$logEsc = $database->escape($logText);
$database->query(
    "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`) " .
    "VALUES (0, '$admid', '$logEsc', $time)"
);

header("Location: ../../../Admin/admin.php?p=search&delali=1");
exit;
?>