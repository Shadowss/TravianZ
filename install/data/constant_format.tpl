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

// -----------------------------------------------------------------------------
// Multi-instance bootstrap
// -----------------------------------------------------------------------------
// config.php is generated from this template. The bootstrap resolves the
// current world before any server constants are defined.
//
// For a normal/default installation, execution continues in this file exactly
// as before. For s1/s2/etc., an instance-local config is loaded instead. The
// guard prevents that instance config from recursively loading itself.
require_once __DIR__ . '/../GameEngine/Instance/Bootstrap.php';

if (defined('TRAVIANZ_INSTANCE_ID')
    && TRAVIANZ_INSTANCE_ID !== 'default'
    && !defined('TRAVIANZ_LOADING_INSTANCE_CONFIG')) {

    $instanceConfigPath = dirname(__DIR__) . '/instances/'
        . TRAVIANZ_INSTANCE_ID . '/config.php';

    if (is_file($instanceConfigPath)) {
        define('TRAVIANZ_LOADING_INSTANCE_CONFIG', true);
        require $instanceConfigPath;
        return;
    }

    // Do not silently fall back to the default world. A request reaching an
    // instance hostname without its configuration must fail safely rather than
    // allowing s2.example.com to operate on the default database/settings.
    http_response_code(503);
    die('TravianZ instance configuration is missing for ' . htmlspecialchars(TRAVIANZ_INSTANCE_ID, ENT_QUOTES, 'UTF-8'));
}

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
// SERVER_LANG is the DEFAULT language of the server (chosen at install / in
// the admin "Server Settings"). LANG is the EFFECTIVE display language.
//
// Per-user language (issue #166): if the logged-in player picked a language
// in their profile preferences (stored in users.lang and mirrored into
// $_SESSION['lang']), LANG becomes that language; otherwise LANG falls back
// to SERVER_LANG.
//
// SECURITY: LANG is used in include("Lang/".LANG.".php"), so the value is
// strictly sanitized to [a-z_] (no path traversal) and the target file MUST
// exist, otherwise we fall back to the server default. This prevents Local
// File Inclusion via a crafted session value.
define("SERVER_LANG", "%LANG%");
if (session_status() !== PHP_SESSION_ACTIVE) { @session_start(); }
$__user_lang = isset($_SESSION['lang']) ? preg_replace('/[^a-z_]/', '', strtolower((string) $_SESSION['lang'])) : '';
define("LANG", ($__user_lang !== '' && is_file(__DIR__ . "/Lang/" . $__user_lang . ".php")) ? $__user_lang : SERVER_LANG);

// ***** Speed
// Choose your server speed. NOTICE: Higher speed, more likely
// to have some bugs. Lower speed, most likely no major bugs.
// Values: 1 (normal), 3 (3x speed) etc...
define("SPEED", "%SPEED%");

// ***** World size
// Defines world size. NOTICE: DO NOT EDIT!!
define("WORLD_MAX", "%MAX%");

// ***** Graphical statistics (Travian Plus)
// The game periodically records each player's rank, population, villages, and
// army from the moment this feature is enabled. These snapshots are then used
// to generate the account progression graphs.
//
// Data is collected for ALL players, but the Statistics tab is visible ONLY to
// users with an active Plus account. Otherwise, players who purchase Plus would
// open the page and see an empty graph immediately after paying.
define("NEW_FUNCTIONS_PLUS_STATISTICS", %PLUSSTATS%);

// Number of hours between snapshots. On a fast server, a single day represents
// a significant amount of gameplay, so taking a snapshot every 6 hours provides
// a smooth graph without filling the database table too quickly.
define("PLUS_STATS_INTERVAL_HOURS", %PLUSSTATSHOURS%);

// Number of days to retain historical data. Set to 0 to keep all snapshots,
// allowing the complete account progression to be displayed. Even over the
// lifetime of an entire server, this only amounts to a few tens of thousands of records.
define("PLUS_STATS_KEEP_DAYS", %PLUSSTATSKEEP%);

// ***** Registration rules
// Validation rules applied during registration (see Account.php).
//
// USRNM_SPECIAL: when set to true, usernames may contain dots, hyphens,
// underscores, and single spaces between words. When set to false,
// only letters and numbers are allowed.
define("USRNM_SPECIAL", %USRNMSPECIAL%);
define("USRNM_MIN_LENGTH", %USRNMMIN%);
define("USRNM_MAX_LENGTH", %USR NMMAX%);
define("PW_MIN_LENGTH", %PWMIN%);

// ***** Activation Mail
// true = activation mail will be sent, users will have to finish registration
//        by clicking on link recieved in mail.
// false =  users can register with any mail. Not needed to be real one.
define("AUTH_EMAIL",%ACTIVATE%);

// ***** Troop Speed
// Values: 1 (normal), 3 (3x speed) etc...
define("INCREASE_SPEED","%INCSPEED%");

// ***** Evasion Speed
define("EVASION_SPEED","%EVASIONSPEED%");

// ***** Trader capacity
// Values: 1 (normal), 3 (3x speed) etc...
define("TRADER_CAPACITY","%TRADERCAP%");

// ***** Cranny capacity
define("CRANNY_CAPACITY","%CRANNYCAP%");

// ***** Trapper capacity
define("TRAPPER_CAPACITY","%TRAPPERCAP%");

// ***** Village Expand
// 1 = slow village expanding - more Cultural Points needed for every new village
// 0 = fast village expanding - less Cultural Points needed for every new village
define("CP", %VILLAGE_EXPAND%);

// ***** Demolish Level Required
// Defines which level of Main building is required to be able to
// demolish. Min value = 1, max value = 20
// Default: 10
define("DEMOLISH_LEVEL_REQ","%DEMOLISH%");

// ***** Change storage capacity
define("STORAGE_MULTIPLIER","%STORAGE_MULTIPLIER%");
define("STORAGE_BASE",800*STORAGE_MULTIPLIER);

// ***** Quest
// Ingame quest enabled/disabled.
define("QUEST",%QUEST%);
//quest type : 25 = Travian Official 
//             37 = TravianZ Extended 