<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       debugLog.php                                                ##
##  Type           : Admin action (Debug Error Log)                           ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.               ##
##                                                                             ##
##  Handles the admin actions of the Debug Error Log page:                     ##
##    do=save     -> persist capture settings (levels, size cap, auto-off)     ##
##    do=toggle   -> turn the debug capture on/off                             ##
##    do=clear    -> empty the log file(s)                                     ##
##    do=download -> stream the log file as a download                         ##
#################################################################################

if(!isset($_SESSION)) session_start();
if(($_SESSION['access'] ?? 0) < 9) die("Access denied: You are not Admin!");

include_once("../../Database.php");

// Resolve project root (max 5 levels up), like the rest of the codebase.
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}
$logFile = $autoprefix . 'var/log/debug-players.log';

$uid = (int)($_SESSION['id_user'] ?? 0);
$do  = $_REQUEST['do'] ?? '';

switch ($do) {

    case 'save':
        $database->setDebugSettings(
            isset($_POST['lvl_warning']),
            isset($_POST['lvl_notice']),
            isset($_POST['lvl_deprecated']),
            isset($_POST['lvl_fatal']),
            $_POST['max_size_mb'] ?? 5,
            $_POST['auto_off_hours'] ?? 6
        );
        $database->query("Insert into ".TB_PREFIX."admin_log values (0,".$uid.",'Changed Debug Error Log settings',".time().")");
        break;

    case 'toggle':
        $active = (int)($_POST['active'] ?? 0);
        $database->setDebugMode($active, $uid);
        $database->query("Insert into ".TB_PREFIX."admin_log values (0,".$uid.",'".($active ? 'Enabled' : 'Disabled')." Debug Error Log',".time().")");
        break;

    case 'clear':
        @file_put_contents($logFile, '');
        @unlink($logFile . '.1');
        $database->query("Insert into ".TB_PREFIX."admin_log values (0,".$uid.",'Cleared Debug Error Log',".time().")");
        break;

    case 'download':
        if (is_file($logFile) && filesize($logFile) > 0) {
            header('Content-Type: text/plain; charset=UTF-8');
            header('Content-Disposition: attachment; filename="debug-players-'.date('Ymd-His').'.log"');
            header('Content-Length: ' . filesize($logFile));
            readfile($logFile);
        } else {
            header('Content-Type: text/plain; charset=UTF-8');
            echo "The debug log is empty.";
        }
        exit;
}

header("Location: ../../../Admin/admin.php?p=debug_log");
exit;
