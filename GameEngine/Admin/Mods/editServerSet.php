<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editServerSet.php                                           ##
##  Developed by:  ronix                                                       ##
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

		$T4=(T4_COMING==false)? "false":"true";
		$LOG_BUILD=(LOG_BUILD==false)? "false":"true";
		$LOG_TECH=(LOG_TECH==false)? "false":"true";
		$LOG_LOGIN=(LOG_LOGIN==false)? "false":"true";
		$LOG_GOLD_FIN=(LOG_GOLD_FIN==false)? "false":"true";
		$LOG_ADMIN=(LOG_ADMIN==false)? "false":"true";
		$LOG_WAR=(LOG_WAR==false)? "false":"true";
		$LOG_MARKET=(LOG_MARKET==false)? "false":"true";
		$LOG_ILLEGAL=(LOG_ILLEGAL==false)? "false":"true";
		$NEWSBOX1=(NEWSBOX1==false)? "false":"true";
		$NEWSBOX2=(NEWSBOX2==false)? "false":"true";
		$NEWSBOX3=(NEWSBOX3==false)? "false":"true";
		$LIMIT_MAILBOX=(LIMIT_MAILBOX==false)? "false":"true";
		$INCLUDE_ADMIN=(INCLUDE_ADMIN==false)? "false":"true";
		$SUPPORT_MSGS_IN_ADMIN = (ADMIN_RECEIVE_SUPPORT_MESSAGES == false ? 'false' : 'true');
		$ADMINS_RAIDABLE = (ADMIN_ALLOW_INCOMING_RAIDS == false ? 'false' : 'true');
		$NEW_FUNCTIONS_OASIS = (NEW_FUNCTIONS_OASIS == false ? 'false' : 'true');
		$NEW_FUNCTIONS_ALLIANCE_INVITATION = (NEW_FUNCTIONS_ALLIANCE_INVITATION == false ? 'false' : 'true');
		$NEW_FUNCTIONS_EMBASSY_MECHANICS = (NEW_FUNCTIONS_EMBASSY_MECHANICS == false ? 'false' : 'true');
		$NEW_FUNCTIONS_FORUM_POST_MESSAGE = (NEW_FUNCTIONS_FORUM_POST_MESSAGE == false ? 'false' : 'true');
		$NEW_FUNCTIONS_TRIBE_IMAGES = (NEW_FUNCTIONS_TRIBE_IMAGES == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MHS_IMAGES = (NEW_FUNCTIONS_MHS_IMAGES == false ? 'false' : 'true');
		$NEW_FUNCTIONS_DISPLAY_ARTIFACT = (NEW_FUNCTIONS_DISPLAY_ARTIFACT == false ? 'false' : 'true');
		$NEW_FUNCTIONS_DISPLAY_WONDER = (NEW_FUNCTIONS_DISPLAY_WONDER == false ? 'false' : 'true');
		$NEW_FUNCTIONS_VACATION = (NEW_FUNCTIONS_VACATION == false ? 'false' : 'true');
		$NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET = (NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MANUAL_NATURENATARS = (NEW_FUNCTIONS_MANUAL_NATURENATARS == false ? 'false' : 'true');
		$NEW_FUNCTIONS_DISPLAY_LINKS = (NEW_FUNCTIONS_DISPLAY_LINKS == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MEDAL_3YEAR = (NEW_FUNCTIONS_MEDAL_3YEAR == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MEDAL_5YEAR = (NEW_FUNCTIONS_MEDAL_5YEAR == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MEDAL_10YEAR = (NEW_FUNCTIONS_MEDAL_10YEAR == false ? 'false' : 'true');

		$text = file_get_contents("constant_format.tpl");
		$text = preg_replace("'%ERRORREPORT%'", $_POST['error'], $text);
		$text = preg_replace("'%ERROR%'", $_POST['error'], $text);
		$text = preg_replace("'%SERVERNAME%'", $_POST['servername'], $text);
		$text = preg_replace("'%STIMEZONE%'", $_POST['tzone'], $text);
		$text = preg_replace("'%STARTTIME%'", COMMENCE, $text);
		$text = preg_replace("'%SSTARTDATE%'", START_DATE, $text);
		$text = preg_replace("'%SSTARTTIME%'", START_TIME, $text);
		$text = preg_replace("'%LANG%'", $_POST['lang'], $text);
		$text = preg_replace("'%SPEED%'", $_POST['speed'], $text);
		$text = preg_replace("'%MAX%'", WORLD_MAX, $text);
		$text = preg_replace("'%GP%'", $_POST['gpack'], $text);
		$text = preg_replace("'%GP_LOCATE%'", "gpack/travian_default/", $text);
		$text = preg_replace("'%INCSPEED%'", $_POST['incspeed'], $text);
		$text = preg_replace("'%EVASIONSPEED%'", $_POST['evasionspeed'], $text);
		$text = preg_replace("'%TRADERCAP%'", $_POST['tradercap'], $text);
		$text = preg_replace("'%CRANNYCAP%'", $_POST['crannycap'], $text);
		$text = preg_replace("'%TRAPPERCAP%'", $_POST['trappercap'], $text);
		$text = preg_replace("'%VILLAGE_EXPAND%'", $_POST['village_expand'], $text);
		$text = preg_replace("'%DEMOLISH%'", $_POST['demolish'], $text);
		$text = preg_replace("'%STORAGE_MULTIPLIER%'", $_POST['storage_multiplier'], $text);
		$text = preg_replace("'%QUEST%'", $_POST['quest'], $text);
		$text = preg_replace("'%QTYPE%'", $_POST['qtype'], $text);
		$text = preg_replace("'%BEGINNER%'", $_POST['beginner'], $text);
		$text = preg_replace("'%WW%'", $_POST['ww'], $text);
		$text = preg_replace("'%SHOW_NATARS%'", $_POST['show_natars'], $text);
		$text = preg_replace("'%NATARS_UNITS%'", $_POST['natars_units'], $text);
		$text = preg_replace("'%NATARS_SPAWN_TIME%'", $_POST['natars_spawn_time'], $text);
		$text = preg_replace("'%NATARS_WW_SPAWN_TIME%'", $_POST['natars_ww_spawn_time'], $text);
		$text = preg_replace("'%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%'", $_POST['natars_ww_building_plan_spawn_time'], $text);
		$text = preg_replace("'%NATURE_REGTIME%'", $_POST['nature_regtime'], $text);
		$text = preg_replace("'%OASIS_WOOD_MULTIPLIER%'", $_POST['oasis_wood_multiplier'], $text);
		$text = preg_replace("'%OASIS_CLAY_MULTIPLIER%'", $_POST['oasis_clay_multiplier'], $text);
		$text = preg_replace("'%OASIS_IRON_MULTIPLIER%'", $_POST['oasis_iron_multiplier'], $text);
		$text = preg_replace("'%OASIS_CROP_MULTIPLIER%'", $_POST['oasis_crop_multiplier'], $text);
		$text = preg_replace("'%T4_COMING%'", $T4, $text);
		$text = preg_replace("'%ACTIVATE%'", $_POST['activate'], $text);
		$text = preg_replace("'%MEDALINTERVAL%'", $_POST['medalinterval'], $text);
		$text = preg_replace("'%GREAT_WKS%'", $_POST['great_wks'], $text);
		$text = preg_replace("'%TS_THRESHOLD%'", $_POST['ts_threshold'], $text);
		$text = preg_replace("'%REG_OPEN%'", $_POST['reg_open'], $text);
		$text = preg_replace("'%PEACE%'", $_POST['peace'], $text);
		$text = preg_replace("'%LOGBUILD%'", $LOG_BUILD, $text);
		$text = preg_replace("'%LOGTECH%'", $LOG_TECH, $text);
		$text = preg_replace("'%LOGLOGIN%'", $LOG_LOGIN, $text);
		$text = preg_replace("'%LOGGOLDFIN%'", $LOG_GOLD_FIN, $text);
		$text = preg_replace("'%LOGADMIN%'", $LOG_ADMIN, $text);
		$text = preg_replace("'%LOGWAR%'", $LOG_WAR, $text);
		$text = preg_replace("'%LOGMARKET%'", $LOG_MARKET, $text);
		$text = preg_replace("'%LOGILLEGAL%'", $LOG_ILLEGAL, $text);
		$text = preg_replace("'%BOX1%'", $NEWSBOX1, $text);
		$text = preg_replace("'%BOX2%'", $NEWSBOX2, $text);
		$text = preg_replace("'%BOX3%'", $NEWSBOX3, $text);
		$text = preg_replace("'%SSERVER%'", SQL_SERVER, $text);
		$text = str_replace("%SPORT%", SQL_PORT, $text);
		$text = preg_replace("'%SUSER%'", SQL_USER, $text);
		$text = preg_replace("'%SPASS%'", SQL_PASS, $text);
		$text = preg_replace("'%SDB%'", SQL_DB, $text);
		$text = preg_replace("'%PREFIX%'", TB_PREFIX, $text);
		$text = preg_replace("'%CONNECTT%'", DB_TYPE, $text);
		$text = preg_replace("'%LIMIT_MAILBOX%'", $LIMIT_MAILBOX, $text);
		$text = preg_replace("'%MAX_MAILS%'", MAX_MAIL, $text);
		$text = preg_replace("'%ARANK%'", $INCLUDE_ADMIN, $text);
		$text = preg_replace("'%AEMAIL%'", ADMIN_EMAIL, $text);
		$text = preg_replace("'%ASUPPMSGS%'", $SUPPORT_MSGS_IN_ADMIN, $text);
		$text = preg_replace("'%ARAIDS%'", $ADMINS_RAIDABLE, $text);
		$text = preg_replace("'%ANAME%'", ADMIN_NAME, $text);
		$text = preg_replace("'%UTRACK%'", "", $text);
		$text = preg_replace("'%UTOUT%'", "", $text);
		$text = preg_replace("'%DOMAIN%'", DOMAIN, $text);
		$text = preg_replace("'%HOMEPAGE%'", HOMEPAGE, $text);
		$text = preg_replace("'%SERVER%'", SERVER, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_OASIS%'", $NEW_FUNCTIONS_OASIS, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_ALLIANCE_INVITATION%'", $NEW_FUNCTIONS_ALLIANCE_INVITATION, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_EMBASSY_MECHANICS%'", $NEW_FUNCTIONS_EMBASSY_MECHANICS, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_FORUM_POST_MESSAGE%'", $NEW_FUNCTIONS_FORUM_POST_MESSAGE, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_TRIBE_IMAGES%'", $NEW_FUNCTIONS_TRIBE_IMAGES, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MHS_IMAGES%'", $NEW_FUNCTIONS_MHS_IMAGES, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_ARTIFACT%'", $NEW_FUNCTIONS_DISPLAY_ARTIFACT, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_WONDER%'", $NEW_FUNCTIONS_DISPLAY_WONDER, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_VACATION%'", $NEW_FUNCTIONS_VACATION, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET%'", $NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MANUAL_NATURENATARS%'", $NEW_FUNCTIONS_MANUAL_NATURENATARS, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_DISPLAY_LINKS%'", $NEW_FUNCTIONS_DISPLAY_LINKS, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MEDAL_3YEAR%'", $NEW_FUNCTIONS_MEDAL_3YEAR, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MEDAL_5YEAR%'", $NEW_FUNCTIONS_MEDAL_5YEAR, $text);
		$text = preg_replace("'%NEW_FUNCTIONS_MEDAL_10YEAR%'", $NEW_FUNCTIONS_MEDAL_10YEAR, $text);

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

$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$id.",'Changed General Server Settings',".time().")");

header("Location: ../../../Admin/admin.php?p=config");

?>
