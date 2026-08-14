<?php
###############################  S  T  A  R  T   ################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.php                                                  ##
##  Version        11.0 Full Refactor & Security                               ##
##  Developed by:  Dzoki and Dixie Edited by Advocaite                         ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2013-2026. All rights reserved.                ##
##  Modified by:   Shadow and ronix                                            ##
##  Refactored by: Shadow                                                      ##
##  				                                                           ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

//////////////////////////////////
// *****  ERROR REPORTING  *****//
//////////////////////////////////
// (E_ALL ^ E_NOTICE) = enabled
// (0) = disabled
define("ERROR_REPORT","%ERRORREPORT%");
%ERROR%
define('AUTOMATION_LOCK_FILE_NAME', 'automation.lck');

//////////////////////////////////
// *****  CRON / AUTOMATION *****//
//////////////////////////////////
// Automation runs from cron.php (a server cron job), not from player page
// requests. See the comments in cron.php for cron job installation instructions.
//
// CRON_LOOP_SECONDS = how long a single cron.php invocation runs.
//   Many hosting providers do not allow cron jobs to run more frequently than
//   every 5 minutes, while Automation is designed to run approximately every
//   60 seconds. For this reason, a single invocation executes multiple ticks
//   in sequence.
//   300 = suitable for a "*/5 * * * *" cron schedule.
//   Set to 0 if your hosting provider allows a cron job every minute
//   (in that case, each invocation executes only a single tick).
//
// CRON_TICK_SECONDS = the interval, in seconds, between each tick within a
// single cron.php invocation.
define('CRON_LOOP_SECONDS', %CRONLOOP%);
define('CRON_TICK_SECONDS', %CRONTICK%);

// Key used to access cron.php via HTTP (wget/curl or an external cron service).
// Command-line execution (e.g. a cPanel cron job) does NOT require it.
// Automatically generated during installation and preserved when saving configuration settings from the ACP.
define('CRON_KEY', '%CRONKEY%');

//////////////////////////////////
// *****  DATABASE CLEANUP  *****//
//////////////////////////////////
//
// Tables that grow indefinitely (reports, chat, deleted messages) are cleaned
// up periodically by Automation. Set each rule to 0 to disable it individually.
//
// Reports archived by players are never deleted.
define('CLEANUP_REPORTS_DAYS', %CLEANUPREPORTS%);
define('CLEANUP_CHAT_DAYS', %CLEANUPCHAT%);
define('CLEANUP_MESSAGES_DAYS', %CLEANUPMESSAGES%);
define('CLEANUP_INTERVAL', 3600);
define('CLEANUP_BATCH', 5000);

//////////////////////////////////
// *****       HERO        *****//
//////////////////////////////////
//
// The hero's BASE health regeneration, in HP per day, independent of the
// points invested in the Regeneration attribute (as in Travian T4).
// Without this, a hero with 0 points in Regeneration would never recover
// health and would eventually die after enough adventures.
//
// It scales with the server speed, just like regeneration from attributes.
// Set to 0 to disable it (legacy behavior).
define('HERO_BASE_REGEN', %HEROBASEREGEN%);

// Auction House exchange rates:
//
//   HERO_SILVER_PER_GOLD = how much silver you receive for 1 gold
//   HERO_SILVER_TO_GOLD  = how much silver it costs to buy 1 gold
//
// The difference between the two rates is the Auction House margin
// (just like in Travian: 1 gold → 10 silver, but 25 silver → 1 gold).
define('HERO_SILVER_PER_GOLD', %HEROSILVERPERGOLD%);
define('HERO_SILVER_TO_GOLD', %HEROSILVERTOGOLD%);

// Hero "Resources" attribute (T4): how many resources each attribute point
// produces per hour.
//
//   ALL = when the bonus is distributed equally across all four resources
//         (default: 3 of each resource)
//
//   ONE = when the bonus is concentrated on a single resource
//         (default: 10)
define('HERO_RES_PER_POINT_ALL', %HERORESALL%);
define('HERO_RES_PER_POINT_ONE', %HERORESONE%);

//////////////////////////////////
// *****  SERVER SETTINGS  *****//
//////////////////////////////////

// ***** Name
define("SERVER_NAME","%SERVERNAME%");

// ***** Time zone added by ronix
// Defines server time zone.
define("TIMEZONE","%STIMEZONE%");
date_default_timezone_set(TIMEZONE);

// ***** Started
// Defines when has server started.
define("COMMENCE","%STARTTIME%");

// ***** Server Start Date / Time
define("START_DATE", "%SSTARTDATE%");
define("START_TIME", "%SSTARTTIME%");

// ***** Language
define("SERVER_LANG", "%LANG%");
if (session_status() !== PHP_SESSION_ACTIVE) { @session_start(); }
$__user_lang = isset($_SESSION['lang']) ? preg_replace('/[^a-z_]/', '', strtolower((string) $_SESSION['lang'])) : '';
define("LANG", ($__user_lang !== '' && is_file(__DIR__ . "/Lang/" . $__user_lang . ".php")) ? $__user_lang : SERVER_LANG);

// ***** Speed
define("SPEED", "%SPEED%");

// ***** World size
define("WORLD_MAX", "%MAX%");

define("NEW_FUNCTIONS_PLUS_STATISTICS", %PLUSSTATS%);
define("PLUS_STATS_INTERVAL_HOURS", %PLUSSTATSHOURS%);
define("PLUS_STATS_KEEP_DAYS", %PLUSSTATSKEEP%);

define("USRNM_SPECIAL", %USRNMSPECIAL%);
define("USRNM_MIN_LENGTH", %USRNMMIN%);
define("USRNM_MAX_LENGTH", %USRNMMAX%);
define("PW_MIN_LENGTH", %PWMIN%);

define("AUTH_EMAIL",%ACTIVATE%);
define("INCREASE_SPEED","%INCSPEED%");
define("EVASION_SPEED","%EVASIONSPEED%");
define("TRADER_CAPACITY","%TRADERCAP%");
define("CRANNY_CAPACITY","%CRANNYCAP%");
define("TRAPPER_CAPACITY","%TRAPPERCAP%");
define("CP", %VILLAGE_EXPAND%);
define("DEMOLISH_LEVEL_REQ","%DEMOLISH%");
define("STORAGE_MULTIPLIER","%STORAGE_MULTIPLIER%");
define("STORAGE_BASE",800*STORAGE_MULTIPLIER);
define("QUEST",%QUEST%);
define("QTYPE",%QTYPE%);
define("PROTECTION","%BEGINNER%");
define("WW",%WW%);
define("SHOW_NATARS",%SHOW_NATARS%); 
define("NATARS_UNITS",%NATARS_UNITS%); 
define("NATARS_SPAWN_TIME",%NATARS_SPAWN_TIME%); 
define("NATARS_WW_SPAWN_TIME",%NATARS_WW_SPAWN_TIME%); 
define("NATARS_WW_BUILDING_PLAN_SPAWN_TIME",%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%);
define("NATARS_WW_START_DELAY", %NATARS_WW_START_DELAY%); 
define("NATURE_REGTIME",%NATURE_REGTIME%); 
define("OASIS_WOOD_MULTIPLIER",%OASIS_WOOD_MULTIPLIER%); 
define("OASIS_CLAY_MULTIPLIER",%OASIS_CLAY_MULTIPLIER%); 
define("OASIS_IRON_MULTIPLIER",%OASIS_IRON_MULTIPLIER%); 
define("OASIS_CROP_MULTIPLIER",%OASIS_CROP_MULTIPLIER%); 
define("OASIS_WOOD_PRODUCTION",OASIS_WOOD_MULTIPLIER*SPEED);
define("OASIS_CLAY_PRODUCTION",OASIS_CLAY_MULTIPLIER*SPEED);
define("OASIS_IRON_PRODUCTION",OASIS_IRON_MULTIPLIER*SPEED);
define("OASIS_CROP_PRODUCTION",OASIS_CROP_MULTIPLIER*SPEED); 
define("MEDALINTERVAL",%MEDALINTERVAL%);
define("GREAT_WKS",%GREAT_WKS%);
define("TS_THRESHOLD",%TS_THRESHOLD%);  
define("REG_OPEN",%REG_OPEN%);
define("PEACE",%PEACE%);
define("PROTECTED_PLAYERS", "%PROTECTEDPLAYERS%");

define("NEW_FUNCTIONS_ALLIANCE_BONUSES", %ALLIANCEBONUSES%);
define("ALLIANCE_BONUS_COSTS", "1200000,5600000,17100000,51200000,153600000");
define("ALLIANCE_BONUS_HOURS", "24,48,72,96,120");
define("ALLIANCE_BONUS_DAILY", "300000,300000,400000,550000,750000,1000000");
define("ALLIANCE_BONUS_PCT_SMALL", 2);
define("ALLIANCE_BONUS_PCT_LARGE", 4);
define("ALLIANCE_BONUS_TRIPLE_GOLD", 3);

define("GP_ENABLE",%GP%);
define("SERVER_GP", "%GP_LOCATE%");
$__user_gp = '';
if (GP_ENABLE && isset($_SESSION['gpack']) && is_string($_SESSION['gpack'])) {
    $__candidate = trim((string) $_SESSION['gpack']);
    if (preg_match('#^gpack/[A-Za-z0-9_\-]+/$#', $__candidate)
        && is_file(__DIR__ . "/../" . $__candidate . "travian.css")) {
        $__user_gp = $__candidate;
    }
}
define("GP_LOCATE", $__user_gp !== '' ? $__user_gp : SERVER_GP);
define("NEW_FUNCTION_WW_IMAGE", %WWIMAGE%);
define("T4_COMING",%T4_COMING%);

define("PAYPAL_EMAIL","%PAYPAL_EMAIL%");
define("PAYPAL_CURRENCY","%PAYPAL_CURRENCY%");
define("PLUS_PACKAGE_A_PRICE","%PLUS_PACKAGE_A_PRICE%");
define("PLUS_PACKAGE_A_GOLD","%PLUS_PACKAGE_A_GOLD%");
define("PLUS_PACKAGE_B_PRICE","%PLUS_PACKAGE_B_PRICE%");
define("PLUS_PACKAGE_B_GOLD","%PLUS_PACKAGE_B_GOLD%");
define("PLUS_PACKAGE_C_PRICE","%PLUS_PACKAGE_C_PRICE%");
define("PLUS_PACKAGE_C_GOLD","%PLUS_PACKAGE_C_GOLD%");
define("PLUS_PACKAGE_D_GOLD","%PLUS_PACKAGE_D_GOLD%");
define("PLUS_PACKAGE_D_PRICE","%PLUS_PACKAGE_D_PRICE%");
define("PLUS_PACKAGE_E_PRICE","%PLUS_PACKAGE_E_PRICE%");
define("PLUS_PACKAGE_E_GOLD","%PLUS_PACKAGE_E_GOLD%");
define("PLUS_TIME",%PLUS_TIME%);
define("PLUS_PRODUCTION",%PLUS_PRODUCTION%);

define("LOG_BUILD",%LOGBUILD%);
define("LOG_TECH",%LOGTECH%);
define("LOG_LOGIN",%LOGLOGIN%);
define("LOG_GOLD_FIN",%LOGGOLDFIN%);
define("LOG_ADMIN",%LOGADMIN%);
define("LOG_WAR",%LOGWAR%);
define("LOG_MARKET",%LOGMARKET%);
define("LOG_ILLEGAL",%LOGILLEGAL%);
define("NEWSBOX1",%BOX1%);
define("NEWSBOX2",%BOX2%);
define("NEWSBOX3",%BOX3%);

define("SQL_SERVER", "%SSERVER%");
define("SQL_PORT", %SPORT%);
define("SQL_USER", "%SUSER%");
define("SQL_PASS", "%SPASS%");
define("SQL_DB", "%SDB%");
define("TB_PREFIX", "%PREFIX%");
define("DB_TYPE", %CONNECTT%);

define("LIMIT_MAILBOX",%LIMIT_MAILBOX%);
define("MAX_MAIL","%MAX_MAILS%");
define("INCLUDE_ADMIN", %ARANK%);

define("ADMIN_EMAIL", "%AEMAIL%");
define("ADMIN_NAME", "%ANAME%");
define("ADMIN_RECEIVE_SUPPORT_MESSAGES", %ASUPPMSGS%);
define("ADMIN_ALLOW_INCOMING_RAIDS", %ARAIDS%);

define("NEW_FUNCTIONS_OASIS", %NEW_FUNCTIONS_OASIS%);
define("NEW_FUNCTIONS_ALLIANCE_INVITATION", %NEW_FUNCTIONS_ALLIANCE_INVITATION%);
define("NEW_FUNCTIONS_EMBASSY_MECHANICS", %NEW_FUNCTIONS_EMBASSY_MECHANICS%);
define("NEW_FUNCTIONS_FORUM_POST_MESSAGE", %NEW_FUNCTIONS_FORUM_POST_MESSAGE%);
define("NEW_FUNCTIONS_TRIBE_IMAGES", %NEW_FUNCTIONS_TRIBE_IMAGES%);
define("NEW_FUNCTIONS_MHS_IMAGES", %NEW_FUNCTIONS_MHS_IMAGES%);
define("NEW_FUNCTIONS_DISPLAY_ARTIFACT", %NEW_FUNCTIONS_DISPLAY_ARTIFACT%);
define("NEW_FUNCTIONS_DISPLAY_WONDER", %NEW_FUNCTIONS_DISPLAY_WONDER%);
define("NEW_FUNCTIONS_VACATION", %NEW_FUNCTIONS_VACATION%);
define("NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET", %NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET%);
define("NEW_FUNCTIONS_MANUAL_NATURENATARS", %NEW_FUNCTIONS_MANUAL_NATURENATARS%);
define("NEW_FUNCTIONS_DISPLAY_LINKS", %NEW_FUNCTIONS_DISPLAY_LINKS%);
define("NEW_FUNCTIONS_MEDAL_3YEAR", %NEW_FUNCTIONS_MEDAL_3YEAR%);
define("NEW_FUNCTIONS_MEDAL_5YEAR", %NEW_FUNCTIONS_MEDAL_5YEAR%);
define("NEW_FUNCTIONS_MEDAL_10YEAR", %NEW_FUNCTIONS_MEDAL_10YEAR%);
define("NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM", %NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM%);
define("NEW_FUNCTIONS_MILESTONES", %NEW_FUNCTIONS_MILESTONES%);
define("NEW_FUNCTIONS_MEDAL_RESET", %NEW_FUNCTIONS_MEDAL_RESET%);
define("NEW_FUNCTIONS_HERO_T4", %NEW_FUNCTIONS_HERO_T4%);
define("NEW_FUNCTION_TRIBE_HUNS", %NEW_FUNCTION_TRIBE_HUNS%);
define("NEW_FUNCTION_TRIBE_EGIPTEANS", %NEW_FUNCTION_TRIBE_EGIPTEANS%);
define("NEW_FUNCTION_TRIBE_SPARTANS", %NEW_FUNCTION_TRIBE_SPARTANS%);
define("NEW_FUNCTION_TRIBE_VIKINGS", %NEW_FUNCTION_TRIBE_VIKINGS%);
define("NEW_FUNCTION_REGISTRATION_GOLD", %NEW_FUNCTION_REGISTRATION_GOLD%);
define("NEW_FUNCTION_REGISTRATION_GOLD_VALUE", %NEW_FUNCTION_REGISTRATION_GOLD_VALUE%);

define("AUTO_DEL_INACTIVE",false);
define("UN_ACT_TIME", 3628800);
define("ALLOW_BURST",false);
define("BASIC_MAX",1);
define("INNER_MAX",1);
define("PLUS_MAX",1);
define("ALLOW_ALL_TRIBE",false);
define("CFM_ADMIN_ACT",true);
define("SERVER_WEB_ROOT",false);

define("BAN_IP_ENABLED",true);
define("IP_TRUSTED_PROXIES","");
define("IP_FORWARDED_HEADER","HTTP_X_FORWARDED_FOR");
define("BANNED",0);
define("AUTH",1);
define("USER",2);
define("MULTIHUNTER",8);
define("ADMIN",9);
define("COOKIE_EXPIRE", 60*60*24*7); 
define("COOKIE_PATH", "/"); 
define("LOG_PAGE_ACCESS", false);
define("PAGE_ACCESS_LOG_DATE", true);
define("PAGE_ACCESS_LOG_IP", true);
define("PAGE_ACCESS_LOG_FILENAME", 'access.log');

define("DOMAIN", "%DOMAIN%");
define("HOMEPAGE", "%HOMEPAGE%");
define("SERVER", "%SERVER%");

$requse = 0;

###############################  E    N    D   ##################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.php                                                  ##
##  Version        11.0 Full Refactor & Security                               ##
##  Developed by:  Dzoki and Dixie Edited by Advocaite                         ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2013-2026. All rights reserved.                ##
##  Modified by:   Shadow and ronix                                            ##
##  Refactored by: Shadow                                                      ##
##                                                                             ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

?>
