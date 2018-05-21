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

if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] != ADMIN) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");
set_time_limit(0);
// TODO: truncate ALL tables (in a single query, not like this),
//       then perform install steps (createDbStructure() && populateWorldData())
//       .. no need for updates and inserts here, as that would keep autoincrements high
//          and one nice day, after 100th reset, there will be no more integers to go for
//          and the whole game would be screwed :P
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."a2b");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."abdata");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."activate");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."active");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."admin_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."alidata");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."ali_invite");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."ali_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."ali_permission");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."allimedal");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."artefacts");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."attacks");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."banlist");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."bdata");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."build_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."chat");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."config");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."deleting");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."demolition");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."diplomacy");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."enforcement");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."farmlist");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."fdata");
mysqli_query($GLOBALS["link"], "DELETE FROM ".TB_PREFIX."forum_cat WHERE forum_area != 1");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."forum_edit");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."forum_post");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."forum_survey");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."forum_topic");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."general");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."gold_fin_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."hero");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."illegal_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."links");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."login_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."market");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."market_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."mdata");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."medal");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."movement");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."ndata");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."online");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."password");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."prisoners");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."raidlist");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."research");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."route");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."send");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."tdata");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."tech_log");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."training");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."units");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."wdata");
$time=time();
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."odata");


$uid=$database->getVillageID(5);

$passw=password_hash("12345", PASSWORD_BCRYPT,['cost' => 12]);
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."users");
mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."users (id, username, password, email, tribe, access, gold, gender, birthday, location, desc1, desc2, plus, b1, b2, b3, b4, sit1, sit2, alliance, sessid, act, timestamp, ap, apall, dp, dpall, protect, quest, gpack, cp, lastupdate, RR, Rc, ok) VALUES
(5, 'Multihunter', '".$passw."', 'multihunter@travianx.mail', 0, 9, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(1, 'Support', '', 'support@travianz.game', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(2, 'Nature', '', 'nature@travianz.game', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(4, 'Taskmaster', '', 'taskmaster@travianz.game', 0, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 'gpack/travian_default/', 1, 0, 0, 0, 0)");

mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."units (vref) VALUES ($uid)");
mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."tdata (vref) VALUES ($uid)");

mysqli_query($GLOBALS["link"], "INSERT INTO ".TB_PREFIX."fdata (vref, f1t, f2t, f3t, f4t, f5t, f6t, f7t, f8t, f9t, f10t, f11t, f12t, f13t, f14t, f15t, f16t, f17t, f18t, f26, f26t, wwname) VALUES ($uid, '1', '4', '1', '3', '2',  '2', '3', '4', '4', '3', '3', '4', '4', '1', '4', '2', '1', '2', '1', '15', 'World Wonder')");

mysqli_query($GLOBALS["link"], "DELETE FROM ".TB_PREFIX."vdata WHERE owner<>5");
mysqli_query($GLOBALS["link"], "TRUNCATE TABLE ".TB_PREFIX."ww_attacks");

header("Location: ../admin.php?p=resetdone");
?>
