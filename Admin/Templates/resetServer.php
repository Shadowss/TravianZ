 <?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       resetServer.php                                             ##
##  Developed by:  Ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2012-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

include_once("../../GameEngine/config.php");
include_once("../../GameEngine/Database.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] != ADMIN) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
set_time_limit(0);
mysql_query("TRUNCATE TABLE ".TB_PREFIX."a2b");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."abdata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."activate");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."active");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."admin_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."alidata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."ali_invite");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."ali_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."ali_permission");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."allimedal");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."artefacts");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."attacks");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."banlist");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."bdata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."build_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."chat");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."config");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."deleting");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."demolition");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."diplomacy");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."enforcement");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."farmlist");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."fdata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."forum_cat");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."forum_edit");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."forum_post");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."forum_survey");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."forum_topic");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."general");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."gold_fin_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."hero");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."illegal_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."links");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."login_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."market");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."market_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."mdata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."medal");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."movement");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."ndata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."online");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."password");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."prisoners");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."raidlist");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."research");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."route");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."send");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."tdata");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."tech_log");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."training");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."units");
$time=time();
mysql_query("TRUNCATE TABLE ".TB_PREFIX."odata");

$database->populateOasisdata();
$database->populateOasis();
$database->populateOasisUnits2();
$uid=$database->getVillageID(5);

$passw=md5('123456');
mysql_query("TRUNCATE TABLE ".TB_PREFIX."users");
mysql_query("INSERT INTO ".TB_PREFIX."users (id, username, password, email, tribe, access, gold, gender, birthday, location, desc1, desc2, plus, b1, b2, b3, b4, sit1, sit2, alliance, sessid, act, timestamp, ap, apall, dp, dpall, protect, quest, gpack, cp, lastupdate, RR, Rc, ok) VALUES
(5, 'Multihunter', '".$passw."', 'multihunter@travianx.mail', 0, 9, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(1, 'Support', '', 'support@travianx.mail', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(2, 'Nature', '', 'support@travianx.mail', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(4, 'Taskmaster', '', 'support@travianx.mail', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0)");

mysql_query("INSERT INTO ".TB_PREFIX."units (vref) VALUES ($uid)");
mysql_query("INSERT INTO ".TB_PREFIX."tdata (vref) VALUES ($uid)");

mysql_query("INSERT INTO ".TB_PREFIX."fdata (vref, f1t, f2t, f3t, f4t, f5t, f6t, f7t, f8t, f9t, f10t, f11t, f12t, f13t, f14t, f15t, f16t, f17t, f18t, f26, f26t, wwname) VALUES ($uid, '1', '4', '1', '3', '2',  '2', '3', '4', '4', '3', '3', '4', '4', '1', '4', '2', '1', '2', '1', '15', 'World Wonder')");

mysql_query("DELETE FROM ".TB_PREFIX."vdata WHERE owner<>5");
mysql_query("UPDATE ".TB_PREFIX."wdata SET occupied=0 WHERE id<>$uid");
mysql_query("TRUNCATE TABLE ".TB_PREFIX."ww_attacks");

header("Location: ../admin.php?p=resetdone");
?> 
