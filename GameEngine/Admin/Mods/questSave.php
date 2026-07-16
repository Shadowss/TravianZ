<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       questSave.php                                              ##
##  Type           BACKEND (Quest editor save/reset)                         ##
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
include_once($autoprefix . "GameEngine/QuestConfig.php");

$admid = (int)($_SESSION['id'] ?? 0);

$check = mysqli_query($GLOBALS['link'],
    "SELECT access FROM " . TB_PREFIX . "users WHERE id = " . $admid);
$acc = $check ? mysqli_fetch_assoc($check) : null;
if (!$acc || (int)$acc['access'] < ADMIN) {
    admin_deny('Your session may have expired — please sign in again.');
}

$do      = $_POST['do'] ?? '';
$variant = QuestConfig::normVariant($_POST['variant'] ?? 'standard');
$msg     = '';

if ($do === 'save' && isset($_POST['q']) && is_array($_POST['q'])) {
    $n = 0;
    foreach ($_POST['q'] as $qid => $fields) {
        if (!is_array($fields)) {
            continue;
        }
        QuestConfig::setQuest($variant, (int)$qid, [
            'enabled'   => !empty($fields['enabled']),
            'wood'      => $fields['wood']      ?? 0,
            'clay'      => $fields['clay']      ?? 0,
            'iron'      => $fields['iron']      ?? 0,
            'crop'      => $fields['crop']      ?? 0,
            'gold'      => $fields['gold']      ?? 0,
            'plus_days' => $fields['plus_days'] ?? 0,
            'req_level' => $fields['req_level'] ?? 0,
            'note'      => $fields['note']      ?? '',
        ]);
        $n++;
    }
    mysqli_query($GLOBALS['link'],
        "INSERT INTO " . TB_PREFIX . "admin_log VALUES (0, " . $admid . ", 'Quest editor: saved " . $n . " " . $variant . " quests', " . time() . ")");
    $msg = $n . ' quests saved (' . $variant . ').';
} elseif ($do === 'reset') {
    QuestConfig::resetVariant($variant);
    mysqli_query($GLOBALS['link'],
        "INSERT INTO " . TB_PREFIX . "admin_log VALUES (0, " . $admid . ", 'Quest editor: reset " . $variant . " to defaults', " . time() . ")");
    $msg = $variant . ' quests reset to defaults.';
}

header("Location: ../../../Admin/admin.php?p=questEditor&variant=" . urlencode($variant) . "&msg=" . urlencode($msg));
exit;
?>
