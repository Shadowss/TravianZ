<?php
###############################  S  T  A  R  T   ################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.php                                                  ##
##  Version        4.8.5                                                       ##
##  Developed by:  Dzoki and Dixie Edited by Advocaite                         ##
##  Rework by:     ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

//////////////////////////////////
// *****  ERROR REPORTING  *****//
//////////////////////////////////
// (E_ALL ^ E_NOTICE) = enabled
// (0) = disabled
define("ERROR_REPORT","%ERRORREPORT%");
%ERROR%

//////////////////////////////////
// *****  SERVER SETTINGS  *****//
//////////////////////////////////

// ***** Name
define("SERVER_NAME","%SERVERNAME%");

// ***** Time zone
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
// Choose your server language.
define("LANG","%LANG%");

// ***** Speed
// Choose your server speed. NOTICE: Higher speed, more likely
// to have some bugs. Lower speed, most likely no major bugs.
// Values: 1 (normal), 3 (3x speed) etc...
define("SPEED", "%SPEED%");

// ***** World size
// Defines world size. NOTICE: DO NOT EDIT!!
define("WORLD_MAX", "%MAX%");

// ***** Graphic Pack
// True = enabled, false = disabled
//!!!!!!!!!!!! DO NOT ENABLE !!!!!!!!!!!!
define("GP_ENABLE",%GP%);
// Graphic pack location (default: gpack/travian_default/)
define("GP_LOCATE", "gpack/travian_default/");

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
//             37 = Extended 
define("QTYPE",%QTYPE%);

// ***** Beginners Protection
// 3600 = 1 hour
// 3600*12 = 12 hours
// 3600*24 = 1 day
// 3600*24*3 = 3 days
// You can choose any value you want!
define("PROTECTION","%BEGINNER%");

// ***** Enable WW Statistics
define("WW",%WW%);

// ***** Show Natars in Statistics
define("SHOW_NATARS",%SHOW_NATARS%); 

// ***** Natars Units Multiplier
define("NATARS_UNITS",%NATARS_UNITS%); 

// ***** Nature troops regeneration time
define("NATURE_REGTIME",%NATURE_REGTIME%); 

// ***** Enable T4 is Coming screen
define("T4_COMING",%T4_COMING%);

// ***** Activation Mail
// true = activation mail will be sent, users will have to finish registration
//        by clicking on link recieved in mail.
// false =  users can register with any mail. Not needed to be real one.
define("AUTH_EMAIL",%ACTIVATE%);

// ***** PLUS
//Plus account lenght
define("PLUS_TIME",%PLUS_TIME%);
//+25% production lenght
define("PLUS_PRODUCTION",%PLUS_PRODUCTION%);
// ***** Medal Interval check
define("MEDALINTERVAL",%MEDALINTERVAL%);
// ***** Great Workshop
define("GREAT_WKS",%GREAT_WKS%);
// ***** Tourn threshold
define("TS_THRESHOLD",%TS_THRESHOLD%);  

// ***** Register open/close
define("REG_OPEN",%REG_OPEN%);

// ***** Peace system
// 0 = None
// 1 = Normal
// 2 = Christmas
// 3 = New Year
// 4 = Easter
define("PEACE",%PEACE%);

//////////////////////////////////
//    **** LOG SETTINGS  ****   //
//////////////////////////////////
// LOG BUILDING/UPGRADING
define("LOG_BUILD",%LOGBUILD%);
// LOG RESEARCHES
define("LOG_TECH",%LOGTECH%);
// LOG USER LOGIN (IP's)
define("LOG_LOGIN",%LOGLOGIN%);
// LOG GOLD
define("LOG_GOLD_FIN",%LOGGOLDFIN%);
// LOG ADMIN
define("LOG_ADMIN",%LOGADMIN%);
// LOG ATTACK REPORTS
define("LOG_WAR",%LOGWAR%);
// LOG MARKET REPORTS
define("LOG_MARKET",%LOGMARKET%);
// LOG ILLEGAL ACTIONS
define("LOG_ILLEGAL",%LOGILLEGAL%);



//////////////////////////////////
// ****  NEWSBOX SETTINGS  **** //
//////////////////////////////////
//true = enabled
//false = disabled
define("NEWSBOX1",%BOX1%);
define("NEWSBOX2",%BOX2%);
define("NEWSBOX3",%BOX3%);



//////////////////////////////////
//   ****  SQL SETTINGS  ****   //
//////////////////////////////////

// ***** SQL Hostname
// example. sql106.000space.com / localhost
// If you host server on own PC than this value is: localhost
// If you use online hosting, value must be written in host cpanel
define("SQL_SERVER", "%SSERVER%");

// ***** Database Username
define("SQL_USER", "%SUSER%");

// ***** Database Password
define("SQL_PASS", "%SPASS%");

// ***** Database Name
define("SQL_DB", "%SDB%");

// ***** Database - Table Prefix
define("TB_PREFIX", "%PREFIX%");

// ***** Database type
// 0 = MYSQL
// 1 = MYSQLi
// default: 1
define("DB_TYPE", %CONNECTT%);



////////////////////////////////////
//   ****  EXTRA SETTINGS  ****   //
////////////////////////////////////

// ***** Censore words
//define("WORD_CENSOR", "%ACTCEN%");

// ***** Words (censore)
// Choose which words do you want to be censored
//define("CENSORED","%CENWORDS%");


// ***** Limit Mailbox
// Limits mailbox to defined number of mails. (IGM's)
define("LIMIT_MAILBOX",%LIMIT_MAILBOX%);
// If enabled, define number of maximum mails.
define("MAX_MAIL","%MAX_MAILS%");

// ***** Include administrator in statistics/rank
define("INCLUDE_ADMIN", %ARANK%);



////////////////////////////////////
//   ****  ADMIN SETTINGS  ****   //
////////////////////////////////////

// ***** Admin Email
define("ADMIN_EMAIL", "%AEMAIL%");

// ***** Admin Name
define("ADMIN_NAME", "%ANAME%");



//////////////////////////////////////////
//   ****  DO NOT EDIT SETTINGS  ****   //
//////////////////////////////////////////
define("TRACK_USR","%UTRACK%");
define("USER_TIMEOUT","%UTOUT%"); 
define("ALLOW_BURST",false);
define("BASIC_MAX",1);
define("INNER_MAX",1);
define("PLUS_MAX",1);
define("ALLOW_ALL_TRIBE",false);
define("CFM_ADMIN_ACT",true);
define("SERVER_WEB_ROOT",false);
define("USRNM_SPECIAL",true);
define("USRNM_MIN_LENGTH",3);
define("PW_MIN_LENGTH",4);
define("BANNED",0);
define("AUTH",1);
define("USER",2);
define("MULTIHUNTER",8);
define("ADMIN",9);
define("COOKIE_EXPIRE", 60*60*24*7); 
define("COOKIE_PATH", "/"); 
define("MODERATOR",4); 
define("AUTO_DEL_INACTIVE",false);
define("UN_ACT_TIME",3600);

////////////////////////////////////////////
//   ****  DOMAIN/SERVER SETTINGS  ****   //
////////////////////////////////////////////
define("DOMAIN", "%DOMAIN%");
define("HOMEPAGE", "%HOMEPAGE%");
define("SERVER", "%SERVER%");

$requse = 0;

###############################  E    N    D   ##################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.php                                                  ##
##  Version        4.8.5                                                       ##
##  Developed by:  Dzoki and Dixie Edited by Advocaite                         ##
##  Rework by:     ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

?>
