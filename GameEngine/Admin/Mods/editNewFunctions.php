<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editNewFunctions.php                                        ##
##  Developed by:  velhbxtyrj                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
include_once("../../Database.php");
$id = (int) $_POST['id'];

if (!file_exists('constant_format.tpl')) {
    die(
        'You seem to be running a new version of TravianZ which was installed using an old installer.<br />' .
        'Please download <strong>constant_format.tpl</strong> file and copy it into the <strong>GameEngine/Admin/Mods</strong> ' .
        'directory  - otherwise saving configuration won\'t work.<br /><br />' .
        'The constant_format.tpl file can be downloaded at ' .
        '<strong>https://raw.githubusercontent.com/Shadowss/TravianZ/master/install/data/constant_format.tpl</strong>');
}

$myFile = "../../config.php";
$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: GameEngine\config.php");

        $text = file_get_contents("constant_format.tpl");

		$SUPPORT_MSGS_IN_ADMIN = (ADMIN_RECEIVE_SUPPORT_MESSAGES == false ? 'false' : 'true');
		$ADMINS_RAIDABLE = (ADMIN_ALLOW_INCOMING_RAIDS == false ? 'false' : 'true');
		$REG_OPEN = (REG_OPEN == false ? 'false' : 'true');
		$QUEST = (QUEST == false ? 'false' : 'true');

		// SERVER SETTINGS - we need to keep these intact
		$text = preg_replace("'%ERRORREPORT%'", ERROR_REPORT, $text);
		$text = preg_replace("'%ERROR%'", ERROR_REPORT, $text);
		$text = preg_replace("'%SERVERNAME%'", SERVER_NAME, $text);
		$text = preg_replace("'%STIMEZONE%'", TIMEZONE, $text);
		$text = preg_replace("'%STARTTIME%'", COMMENCE, $text);
		$text = preg_replace("'%SSTARTDATE%'", START_DATE, $text);
		$text = preg_replace("'%SSTARTTIME%'", START_TIME, $text);
		$text = preg_replace("'%LANG%'", LANG, $text);
		$text = preg_replace("'%SPEED%'", SPEED, $text);
		$text = preg_replace("'%MAX%'", WORLD_MAX, $text);
		$text = preg_replace("'%GP%'", GP_ENABLE, $text);
		$text = preg_replace("'%GP_LOCATE%'", GP_LOCATE, $text);
		$text = preg_replace("'%INCSPEED%'", INCREASE_SPEED, $text);
		$text = preg_replace("'%EVASIONSPEED%'", EVASION_SPEED, $text);
		$text = preg_replace("'%TRADERCAP%'", TRADER_CAPACITY, $text);
		$text = preg_replace("'%CRANNYCAP%'", CRANNY_CAPACITY, $text);
		$text = preg_replace("'%TRAPPERCAP%'", TRAPPER_CAPACITY, $text);
		$text = preg_replace("'%VILLAGE_EXPAND%'", CP, $text);
		$text = preg_replace("'%DEMOLISH%'", DEMOLISH_LEVEL_REQ, $text);
		$text = preg_replace("'%STORAGE_MULTIPLIER%'", STORAGE_MULTIPLIER, $text);
		$text = preg_replace("'%QUEST%'", $QUEST, $text);
		$text = preg_replace("'%QTYPE%'", QTYPE, $text);
		$text = preg_replace("'%BEGINNER%'", PROTECTION, $text);
		$text = preg_replace("'%WW%'", (WW ? 'true' : 'false'), $text);
		$text = preg_replace("'%SHOW_NATARS%'", (SHOW_NATARS ? 'true' : 'false'), $text);
		$text = preg_replace("'%NATARS_UNITS%'", NATARS_UNITS, $text);
		$text = preg_replace("'%NATARS_SPAWN_TIME%'", NATARS_SPAWN_TIME, $text);
		$text = preg_replace("'%NATARS_WW_SPAWN_TIME%'", NATARS_WW_SPAWN_TIME, $text);
		$text = preg_replace("'%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%'", NATARS_WW_BUILDING_PLAN_SPAWN_TIME, $text);
		$text = preg_replace("'%NATURE_REGTIME%'", NATURE_REGTIME, $text);
		$text = preg_replace("'%OASIS_WOOD_MULTIPLIER%'", OASIS_WOOD_MULTIPLIER, $text);
		$text = preg_replace("'%OASIS_CLAY_MULTIPLIER%'", OASIS_CLAY_MULTIPLIER, $text);
		$text = preg_replace("'%OASIS_IRON_MULTIPLIER%'", OASIS_IRON_MULTIPLIER, $text);
		$text = preg_replace("'%OASIS_CROP_MULTIPLIER%'", OASIS_CROP_MULTIPLIER, $text);
		$text = preg_replace("'%T4_COMING%'", (T4_COMING ? 'true' : 'false'), $text);
		$text = preg_replace("'%ACTIVATE%'", (AUTH_EMAIL ? 'true' : 'false'), $text);
		$text = preg_replace("'%MEDALINTERVAL%'", MEDALINTERVAL, $text);
		$text = preg_replace("'%GREAT_WKS%'", (GREAT_WKS ? 'true' : 'false'), $text);
		$text = preg_replace("'%TS_THRESHOLD%'", TS_THRESHOLD, $text);
		$text = preg_replace("'%REG_OPEN%'", $REG_OPEN, $text);
		$text = preg_replace("'%PEACE%'", PEACE, $text);
		$text = preg_replace("'%LOGBUILD%'", (LOG_BUILD ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGTECH%'", (LOG_TECH ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGLOGIN%'", (LOG_LOGIN ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGGOLDFIN%'", (LOG_GOLD_FIN ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGADMIN%'", (LOG_ADMIN ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGWAR%'", (LOG_WAR ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGMARKET%'", (LOG_MARKET ? 'true' : 'false'), $text);
		$text = preg_replace("'%LOGILLEGAL%'", (LOG_ILLEGAL ? 'true' : 'false'), $text);
		$text = preg_replace("'%BOX1%'", (NEWSBOX1 ? 'true' : 'false'), $text);
		$text = preg_replace("'%BOX2%'", (NEWSBOX2 ? 'true' : 'false'), $text);
		$text = preg_replace("'%BOX3%'", (NEWSBOX3 ? 'true' : 'false'), $text);
		$text = preg_replace("'%SSERVER%'", SQL_SERVER, $text);
		$text = str_replace("%SPORT%", SQL_PORT, $text);
		$text = preg_replace("'%SUSER%'", SQL_USER, $text);
		$text = preg_replace("'%SPASS%'", SQL_PASS, $text);
		$text = preg_replace("'%SDB%'", SQL_DB, $text);
		$text = preg_replace("'%PREFIX%'", TB_PREFIX, $text);
		$text = preg_replace("'%CONNECTT%'", DB_TYPE, $text);
		$text = preg_replace("'%LIMIT_MAILBOX%'", (LIMIT_MAILBOX ? 'true' : 'false'), $text);
		$text = preg_replace("'%MAX_MAILS%'", MAX_MAIL, $text);
		$text = preg_replace("'%ARANK%'", (INCLUDE_ADMIN ? 'true' : 'false'), $text);
		$text = preg_replace("'%AEMAIL%'", ADMIN_EMAIL, $text);
		$text = preg_replace("'%ANAME%'", ADMIN_NAME, $text);
		$text = preg_replace("'%ASUPPMSGS%'", $SUPPORT_MSGS_IN_ADMIN, $text);
		$text = preg_replace("'%ARAIDS%'", $ADMINS_RAIDABLE, $text);
		$text = preg_replace("'%UTRACK%'", "TRACK_USR", $text); // not in use, text only in a comment
		$text = preg_replace("'%UTOUT%'", "USER_TIMEOUT", $text); // not in use, text only in a comment
		$text = preg_replace("'%DOMAIN%'", DOMAIN, $text);
		$text = preg_replace("'%HOMEPAGE%'", HOMEPAGE, $text);
		$text = preg_replace("'%SERVER%'", SERVER, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_OASIS%'", $_POST['new_functions_oasis'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_ALLIANCE_INVITATION%'", $_POST['new_functions_alliance_invitation'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_EMBASSY_MECHANICS%'", $_POST['new_functions_embassy_mechanics'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_FORUM_POST_MESSAGE%'", $_POST['new_functions_forum_post_message'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_TRIBE_IMAGES%'", $_POST['new_functions_tribe_images'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MHS_IMAGES%'", $_POST['new_functions_mhs_images'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_ARTIFACT%'", $_POST['new_functions_display_artifact'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_WONDER%'", $_POST['new_functions_display_wonder'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_VACATION%'", $_POST['new_functions_vacation'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET%'", $_POST['new_functions_display_catapult_target'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MANUAL_NATURENATARS%'", $_POST['new_functions_manual_naturenatars'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_LINKS%'", $_POST['new_functions_display_links'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MEDAL_3YEAR%'", $_POST['new_functions_medal_3year'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MEDAL_5YEAR%'", $_POST['new_functions_medal_5year'], $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MEDAL_10YEAR%'", $_POST['new_functions_medal_10year'], $text);

		// PLUS settings need to be kept intact
		$text = preg_replace("'%PLUS_TIME%'", PLUS_TIME, $text);
		$text = preg_replace("'%PLUS_PRODUCTION%'", PLUS_PRODUCTION, $text);
		$text = preg_replace("'%PAYPAL_EMAIL%'", (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'martin@martinambrus.com'), $text);
		$text = preg_replace("'%PAYPAL_CURRENCY%'", (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_A_PRICE%'", (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_A_GOLD%'", (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : '60'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_B_PRICE%'", (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_B_GOLD%'", (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : '120'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_C_PRICE%'", (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_C_GOLD%'", (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : '360'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_D_PRICE%'", (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_D_GOLD%'", (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : '1000'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_E_PRICE%'", (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99'), $text);
		$text = preg_replace("'%PLUS_PACKAGE_E_GOLD%'", (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : '2000'), $text);

		fwrite($fh, $text);
		fclose($fh);

$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$id.",'Changed New Mechanics and Functions Settings',".time().")");

header("Location: ../../../Admin/admin.php?p=config");

?>
