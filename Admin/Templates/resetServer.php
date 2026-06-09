<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : resetServer.php 			                               ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include_once("../../GameEngine/config.php");
include_once("../../GameEngine/Database.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['access']) || (int)$_SESSION['access'] < ADMIN) {
    die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
}
set_time_limit(0);

// 1. Salvăm adminul dacă e bifat
$keepAdmin = isset($_POST['keep_admin']) && $_POST['keep_admin'] == '1';
$adminData = null;
if($keepAdmin){
    $admin_id = (int)$_SESSION['id'];
    $res = mysqli_query($GLOBALS["link"], "SELECT username, password, email, access, tribe FROM `".TB_PREFIX."users` WHERE id = $admin_id LIMIT 1");
    $adminData = mysqli_fetch_assoc($res);
}

// 2. Golim tot - fără FK checks
mysqli_query($GLOBALS["link"], "SET FOREIGN_KEY_CHECKS=0");

$tables = ["a2b","abdata","activate","active","admin_log","alidata","ali_invite","ali_log","ali_permission","allimedal","artefacts","attacks","banlist","bdata","build_log","chat","deleting","demolition","diplomacy","enforcement","farmlist","fdata","forum_cat","forum_edit","forum_post","forum_survey","forum_topic","general","gold_fin_log","hero","illegal_log","links","login_log","market","market_log","mdata","medal","movement","ndata","online","odata","password","prisoners","raidlist","research","route","send","tdata","tech_log","training","units","vdata","wdata","ww_attacks","croppers","users"];

foreach($tables as $t){
    mysqli_query($GLOBALS["link"], "TRUNCATE TABLE `".TB_PREFIX.$t."`");
}

mysqli_query($GLOBALS["link"], "SET FOREIGN_KEY_CHECKS=1");

// 3. Recreăm structura și harta
$database->createDbStructure();
$database->populateWorldData();

// 4. Conturi sistem
$passw = password_hash("12345", PASSWORD_BCRYPT, ['cost' => 12]);
mysqli_query($GLOBALS["link"], "INSERT INTO `".TB_PREFIX."users` (id, username, password, email, tribe, access, gold, plus, protect) VALUES
(1, 'Support', '', 'support@travianz.game', 0, 8, 0, 0, 0),
(2, 'Nature', '', 'nature@travianz.game', 4, 8, 0, 0, 0),
(4, 'Taskmaster', '', 'taskmaster@travianz.game', 0, 8, 0, 0, 0),
(5, 'Multihunter', '$passw', 'multihunter@travianx.mail', 0, 9, 0, 0, 0)");

// 5. Reintroducem adminul
if($keepAdmin && $adminData){
    $u = mysqli_real_escape_string($GLOBALS["link"], $adminData['username']);
    $p = mysqli_real_escape_string($GLOBALS["link"], $adminData['password']);
    $e = mysqli_real_escape_string($GLOBALS["link"], $adminData['email']);
    $a = (int)$adminData['access'];
    $t = (int)$adminData['tribe'];
    // ID 6 ca să nu se calce cu sistemele
    mysqli_query($GLOBALS["link"], "INSERT INTO `".TB_PREFIX."users` (id, username, password, email, tribe, access, gold, plus, protect) VALUES (6, '$u', '$p', '$e', $t, $a, 0, 0, 0)");
    $_SESSION['id'] = 6; // actualizăm sesiunea
}

// 6. Log (proxy-aware, issue #185)
$resetIp = \App\Utils\IpResolver::getClientIp() ?? ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
mysqli_query($GLOBALS["link"], "INSERT INTO `".TB_PREFIX."admin_log` (user, ip, time, action) VALUES (".(int)$_SESSION['id'].", '".$resetIp."', ".time().", 'Server reset".($keepAdmin ? ' (admin kept)' : '')."')");

header("Location: ../admin.php?p=resetdone");
exit;
?>