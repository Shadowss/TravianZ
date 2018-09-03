<?php
###############################  S  T  A  R  T   ################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.php                                                  ##
##  Version        8.0                                                         ##
##  Developed by:  Dzoki and Dixie Edited by Advocaite                         ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2013-2014. All rights reserved.                ##
##  Modified by:   Shadow and ronix                                            ##
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
// true = enabled, false = disabled
//!!!!!!!!!!!! DO NOT ENABLE !!!!!!!!!!!!
define("GP_ENABLE",false);
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
//             37 = TravianZ Extended 
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

// ***** Natars Spawn Time
define("NATARS_SPAWN_TIME",%NATARS_SPAWN_TIME%); 
define("NATARS_WW_SPAWN_TIME",%NATARS_WW_SPAWN_TIME%); 
define("NATARS_WW_BUILDING_PLAN_SPAWN_TIME",%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%); 

// ***** Nature troops regeneration time
define("NATURE_REGTIME",%NATURE_REGTIME%); 

// ***** Oasis production
define("OASIS_WOOD_MULTIPLIER",%OASIS_WOOD_MULTIPLIER%); 
define("OASIS_CLAY_MULTIPLIER",%OASIS_CLAY_MULTIPLIER%); 
define("OASIS_IRON_MULTIPLIER",%OASIS_IRON_MULTIPLIER%); 
define("OASIS_CROP_MULTIPLIER",%OASIS_CROP_MULTIPLIER%); 
define("OASIS_WOOD_PRODUCTION",OASIS_WOOD_MULTIPLIER*SPEED);
define("OASIS_CLAY_PRODUCTION",OASIS_CLAY_MULTIPLIER*SPEED);
define("OASIS_IRON_PRODUCTION",OASIS_IRON_MULTIPLIER*SPEED);
define("OASIS_CROP_PRODUCTION",OASIS_CROP_MULTIPLIER*SPEED); 

// ***** Enable T4 is Coming screen
define("T4_COMING",%T4_COMING%);

// ***** Activation Mail
// true = activation mail will be sent, users will have to finish registration
//        by clicking on link recieved in mail.
// false =  users can register with any mail. Not needed to be real one.
define("AUTH_EMAIL",%ACTIVATE%);

// ***** PLUS
//Plus PayPal e-mail address
define("PAYPAL_EMAIL","%PAYPAL_EMAIL%");
//Plus PayPal currency
define("PAYPAL_CURRENCY","%PAYPAL_CURRENCY%");
//Plus Package A Price
define("PLUS_PACKAGE_A_PRICE","%PLUS_PACKAGE_A_PRICE%");
//Plus Package A Gold
define("PLUS_PACKAGE_A_GOLD","%PLUS_PACKAGE_A_GOLD%");
//Plus Package B Price
define("PLUS_PACKAGE_B_PRICE","%PLUS_PACKAGE_B_PRICE%");
//Plus Package B Gold
define("PLUS_PACKAGE_B_GOLD","%PLUS_PACKAGE_B_GOLD%");
//Plus Package C Price
define("PLUS_PACKAGE_C_PRICE","%PLUS_PACKAGE_C_PRICE%");
//Plus Package C Gold
define("PLUS_PACKAGE_C_GOLD","%PLUS_PACKAGE_C_GOLD%");
//Plus Package D Gold
define("PLUS_PACKAGE_D_GOLD","%PLUS_PACKAGE_D_GOLD%");
//Plus Package D Price
define("PLUS_PACKAGE_D_PRICE","%PLUS_PACKAGE_D_PRICE%");
//Plus Package E Price
define("PLUS_PACKAGE_E_PRICE","%PLUS_PACKAGE_E_PRICE%");
//Plus Package E Gold
define("PLUS_PACKAGE_E_GOLD","%PLUS_PACKAGE_E_GOLD%");
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
// example: sql106.000space.com / localhost
// If you host server on own PC than this value is: localhost
// If you use online hosting, value must be written in host cpanel
define("SQL_SERVER", "%SSERVER%");

// ***** SQL Port
// default: 3306
define("SQL_PORT", %SPORT%);

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

// ***** Show Support Messages in Admin
define("ADMIN_RECEIVE_SUPPORT_MESSAGES", %ASUPPMSGS%);

// ***** Allow Admin accounts to be raided and attacked
define("ADMIN_ALLOW_INCOMING_RAIDS", %ARAIDS%);


/////////////////////////////////////////////////
//   ****  NEW MECHANICS AND FUNCTIONS  ****   //
/////////////////////////////////////////////////
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


//////////////////////////////////////////
//   ****  DO NOT EDIT SETTINGS  ****   //
//////////////////////////////////////////
define("AUTO_DEL_INACTIVE",false); // auto-delete inactive players; default = false
define("UN_ACT_TIME", 3628800); // 6 weeks to consider a player inactive
//define("TRACK_USR","%UTRACK%");
//define("USER_TIMEOUT","%UTOUT%");
define("TRACK_USR",true); // track users' being active or not
define("USER_TIMEOUT",3600); // 1 hour of no activity counts as inactivity
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
define("LOG_PAGE_ACCESS", false);
define("PAGE_ACCESS_LOG_DATE", true);
define("PAGE_ACCESS_LOG_IP", true);
define("PAGE_ACCESS_LOG_FILENAME", 'access.log'); // filename ONLY, no path!


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
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

?>
