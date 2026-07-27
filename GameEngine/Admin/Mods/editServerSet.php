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

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once("../../Database.php");
$id = (int) $_POST['id'];

require_once(__DIR__ . '/config_template.php');

if (!admin_config_template_available()) {
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
		$NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM = (NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MILESTONES = (NEW_FUNCTIONS_MILESTONES == false ? 'false' : 'true');
		$NEW_FUNCTIONS_MEDAL_RESET = (NEW_FUNCTIONS_MEDAL_RESET == false ? 'false' : 'true');
		$NEW_FUNCTIONS_HERO_T4 = (NEW_FUNCTIONS_HERO_T4 == false ? 'false' : 'true');
		$NEW_FUNCTION_TRIBE_HUNS = (defined('NEW_FUNCTION_TRIBE_HUNS') && NEW_FUNCTION_TRIBE_HUNS ? 'true' : 'false');
		$NEW_FUNCTION_TRIBE_EGIPTEANS = (defined('NEW_FUNCTION_TRIBE_EGIPTEANS') && NEW_FUNCTION_TRIBE_EGIPTEANS ? 'true' : 'false');
		$NEW_FUNCTION_TRIBE_SPARTANS = (defined('NEW_FUNCTION_TRIBE_SPARTANS') && NEW_FUNCTION_TRIBE_SPARTANS ? 'true' : 'false');
		$NEW_FUNCTION_TRIBE_VIKINGS = (defined('NEW_FUNCTION_TRIBE_VIKINGS') && NEW_FUNCTION_TRIBE_VIKINGS ? 'true' : 'false');

		// Regenerarea de baza a vietii eroului (HP pe zi). 0 = dezactivata.
$heroBaseRegen = isset($_POST['hero_base_regen']) ? (int) $_POST['hero_base_regen'] : 10;

if ($heroBaseRegen < 0)   { $heroBaseRegen = 0; }
if ($heroBaseRegen > 100) { $heroBaseRegen = 100; }

// Ratele casei de schimb aur <-> argint.
$silverPerGold = isset($_POST['hero_silver_per_gold']) ? (int) $_POST['hero_silver_per_gold'] : 10;
$silverToGold  = isset($_POST['hero_silver_to_gold'])  ? (int) $_POST['hero_silver_to_gold']  : 25;

if ($silverPerGold < 1)     { $silverPerGold = 1; }
if ($silverPerGold > 10000) { $silverPerGold = 10000; }
if ($silverToGold < 1)      { $silverToGold = 1; }
if ($silverToGold > 10000)  { $silverToGold = 10000; }

// Productia de resurse a eroului (atributul "Resources").
$heroResAll = isset($_POST['hero_res_all']) ? (int) $_POST['hero_res_all'] : 3;
$heroResOne = isset($_POST['hero_res_one']) ? (int) $_POST['hero_res_one'] : 10;

if ($heroResAll < 0)     { $heroResAll = 0; }
if ($heroResAll > 10000) { $heroResAll = 10000; }
if ($heroResOne < 0)     { $heroResOne = 0; }
if ($heroResOne > 10000) { $heroResOne = 10000; }

// Pachetul grafic al serverului. Acceptam doar un director care exista si
// contine travian.css - altfel jocul ar ramane fara stiluri.
$gpLocate = defined('GP_LOCATE') ? GP_LOCATE : 'gpack/travian_default/';

if (isset($_POST['gp_locate'])) {
    $gpAvailable = tz_available_gpacks();

    if (isset($gpAvailable[$_POST['gp_locate']])) {
        $gpLocate = $_POST['gp_locate'];
    }
}

// Comutatorul "pachete grafice proprii" (campul 'gpack' din formular).
$gpEnable = (isset($_POST['gpack']) && $_POST['gpack'] === 'true') ? 'true' : 'false';

$text = admin_config_template_contents(array(
    '%GP%'                => $gpEnable,
    '%GP_LOCATE%'         => $gpLocate,
    '%HEROBASEREGEN%'     => $heroBaseRegen,
    '%HEROSILVERPERGOLD%' => $silverPerGold,
    '%HEROSILVERTOGOLD%'  => $silverToGold,
    '%HERORESALL%'        => $heroResAll,
    '%HERORESONE%'        => $heroResOne,
));
		tz_config_set($text, '%ERRORREPORT%', $_POST['error'] ?? '');
		tz_config_set($text, '%ERROR%', $_POST['error'] ?? '', 'code');
		tz_config_set($text, '%SERVERNAME%', $_POST['servername'] ?? '');
		// Fusul orar se scrie intr-un fisier PHP (define("TIMEZONE","...")), deci
		// valoarea NU are voie sa ajunga acolo nefiltrata: pana acum $_POST['tzone']
		// era inserat ca atare, ceea ce permitea scrierea de cod in config.php.
		// Acceptam doar identificatori IANA reali, verificati la rulare.
		$tzCurrent = defined('TIMEZONE') ? TIMEZONE : date_default_timezone_get();
		$tzChosen  = $tzCurrent;

		if (isset($_POST['tzone'])) {
			$tzCandidate = (string) $_POST['tzone'];

			if (in_array($tzCandidate, DateTimeZone::listIdentifiers(), true)) {
				$tzChosen = $tzCandidate;
			}
		}

		$text = str_replace('%STIMEZONE%', $tzChosen, $text);
		tz_config_set($text, '%STARTTIME%', COMMENCE);
		tz_config_set($text, '%SSTARTDATE%', START_DATE);
		tz_config_set($text, '%SSTARTTIME%', START_TIME);
		// FIX: limba selectata din formular era ignorata - se rescria mereu
		// constanta deja incarcata, deci salvarea nu schimba nimic.
		// Validam valoarea primita si verificam si ca fisierul de limba exista:
		// altfel un POST modificat ar putea scrie in config o limba fara fisier,
		// iar jocul ar ramane fara traduceri.
		$serverLangCurrent = defined('SERVER_LANG') ? SERVER_LANG : LANG;
		$serverLang        = $serverLangCurrent;

		if (isset($_POST['lang'])) {
			$langCandidate = (string) $_POST['lang'];

			if (preg_match('/^[a-z]{2}$/', $langCandidate)
				&& file_exists(__DIR__ . '/../../Lang/' . $langCandidate . '.php')) {
				$serverLang = $langCandidate;
			}
		}

		// str_replace, nu preg_replace: valoarea nu e o expresie regulata
		$text = str_replace('%LANG%', $serverLang, $text);
		tz_config_set($text, '%SPEED%', $_POST['speed'] ?? '');
		tz_config_set($text, '%MAX%', WORLD_MAX);
		tz_config_set($text, '%INCSPEED%', $_POST['incspeed'] ?? '');
		tz_config_set($text, '%EVASIONSPEED%', $_POST['evasionspeed'] ?? '');
		tz_config_set($text, '%TRADERCAP%', $_POST['tradercap'] ?? '');
		tz_config_set($text, '%CRANNYCAP%', $_POST['crannycap'] ?? '');
		tz_config_set($text, '%TRAPPERCAP%', $_POST['trappercap'] ?? '');
		tz_config_set($text, '%VILLAGE_EXPAND%', $_POST['village_expand'] ?? '');
		tz_config_set($text, '%DEMOLISH%', $_POST['demolish'] ?? '');
		tz_config_set($text, '%STORAGE_MULTIPLIER%', $_POST['storage_multiplier'] ?? '');
		tz_config_set($text, '%QUEST%', $_POST['quest'] ?? '');
		tz_config_set($text, '%QTYPE%', $_POST['qtype'] ?? '');
		tz_config_set($text, '%BEGINNER%', $_POST['beginner'] ?? '');
		tz_config_set($text, '%WW%', $_POST['ww'] ?? '');
		tz_config_set($text, '%SHOW_NATARS%', $_POST['show_natars'] ?? '');
		tz_config_set($text, '%NATARS_UNITS%', $_POST['natars_units'] ?? '');
		tz_config_set($text, '%NATARS_SPAWN_TIME%', $_POST['natars_spawn_time'] ?? '');
		tz_config_set($text, '%NATARS_WW_SPAWN_TIME%', $_POST['natars_ww_spawn_time'] ?? '');
		tz_config_set($text, '%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%', $_POST['natars_ww_building_plan_spawn_time'] ?? '');
		tz_config_set($text, '%NATURE_REGTIME%', $_POST['nature_regtime'] ?? '');
		tz_config_set($text, '%OASIS_WOOD_MULTIPLIER%', $_POST['oasis_wood_multiplier'] ?? '');
		tz_config_set($text, '%OASIS_CLAY_MULTIPLIER%', $_POST['oasis_clay_multiplier'] ?? '');
		tz_config_set($text, '%OASIS_IRON_MULTIPLIER%', $_POST['oasis_iron_multiplier'] ?? '');
		tz_config_set($text, '%OASIS_CROP_MULTIPLIER%', $_POST['oasis_crop_multiplier'] ?? '');
		tz_config_set($text, '%T4_COMING%', $T4);
		tz_config_set($text, '%ACTIVATE%', $_POST['activate'] ?? '');
		tz_config_set($text, '%MEDALINTERVAL%', $_POST['medalinterval'] ?? '');
		tz_config_set($text, '%GREAT_WKS%', $_POST['great_wks'] ?? '');
		tz_config_set($text, '%TS_THRESHOLD%', $_POST['ts_threshold'] ?? '');
		tz_config_set($text, '%REG_OPEN%', $_POST['reg_open'] ?? '');
		tz_config_set($text, '%PEACE%', $_POST['peace'] ?? '');
		tz_config_set($text, '%LOGBUILD%', $LOG_BUILD);
		tz_config_set($text, '%LOGTECH%', $LOG_TECH);
		tz_config_set($text, '%LOGLOGIN%', $LOG_LOGIN);
		tz_config_set($text, '%LOGGOLDFIN%', $LOG_GOLD_FIN);
		tz_config_set($text, '%LOGADMIN%', $LOG_ADMIN);
		tz_config_set($text, '%LOGWAR%', $LOG_WAR);
		tz_config_set($text, '%LOGMARKET%', $LOG_MARKET);
		tz_config_set($text, '%LOGILLEGAL%', $LOG_ILLEGAL);
		tz_config_set($text, '%BOX1%', $NEWSBOX1);
		tz_config_set($text, '%BOX2%', $NEWSBOX2);
		tz_config_set($text, '%BOX3%', $NEWSBOX3);
		tz_config_set($text, '%SSERVER%', SQL_SERVER);
		$text = str_replace("%SPORT%", SQL_PORT, $text);
		tz_config_set($text, '%SUSER%', SQL_USER);
		tz_config_set($text, '%SPASS%', SQL_PASS);
		tz_config_set($text, '%SDB%', SQL_DB);
		tz_config_set($text, '%PREFIX%', TB_PREFIX);
		tz_config_set($text, '%CONNECTT%', DB_TYPE);
		tz_config_set($text, '%LIMIT_MAILBOX%', $LIMIT_MAILBOX);
		tz_config_set($text, '%MAX_MAILS%', MAX_MAIL);
		tz_config_set($text, '%ARANK%', $INCLUDE_ADMIN);
		tz_config_set($text, '%AEMAIL%', ADMIN_EMAIL);
		tz_config_set($text, '%ASUPPMSGS%', $SUPPORT_MSGS_IN_ADMIN);
		tz_config_set($text, '%ARAIDS%', $ADMINS_RAIDABLE);
		tz_config_set($text, '%ANAME%', ADMIN_NAME);
		tz_config_set($text, '%UTRACK%', "");
		tz_config_set($text, '%UTOUT%', "");
		tz_config_set($text, '%DOMAIN%', DOMAIN);
		tz_config_set($text, '%HOMEPAGE%', HOMEPAGE);
		tz_config_set($text, '%SERVER%', SERVER);
		tz_config_set($text, '%NEW_FUNCTIONS_OASIS%', $NEW_FUNCTIONS_OASIS);
		tz_config_set($text, '%NEW_FUNCTIONS_ALLIANCE_INVITATION%', $NEW_FUNCTIONS_ALLIANCE_INVITATION);
		tz_config_set($text, '%NEW_FUNCTIONS_EMBASSY_MECHANICS%', $NEW_FUNCTIONS_EMBASSY_MECHANICS);
		tz_config_set($text, '%NEW_FUNCTIONS_FORUM_POST_MESSAGE%', $NEW_FUNCTIONS_FORUM_POST_MESSAGE);
		tz_config_set($text, '%NEW_FUNCTIONS_TRIBE_IMAGES%', $NEW_FUNCTIONS_TRIBE_IMAGES);
		tz_config_set($text, '%NEW_FUNCTIONS_MHS_IMAGES%', $NEW_FUNCTIONS_MHS_IMAGES);
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_ARTIFACT%', $NEW_FUNCTIONS_DISPLAY_ARTIFACT);
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_WONDER%', $NEW_FUNCTIONS_DISPLAY_WONDER);
		tz_config_set($text, '%NEW_FUNCTIONS_VACATION%', $NEW_FUNCTIONS_VACATION);
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET%', $NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET);
		tz_config_set($text, '%NEW_FUNCTIONS_MANUAL_NATURENATARS%', $NEW_FUNCTIONS_MANUAL_NATURENATARS);
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_LINKS%', $NEW_FUNCTIONS_DISPLAY_LINKS);
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_3YEAR%', $NEW_FUNCTIONS_MEDAL_3YEAR);
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_5YEAR%', $NEW_FUNCTIONS_MEDAL_5YEAR);
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_10YEAR%', $NEW_FUNCTIONS_MEDAL_10YEAR);
		tz_config_set($text, '%NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM%', $NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM);
		tz_config_set($text, '%NEW_FUNCTIONS_MILESTONES%', $NEW_FUNCTIONS_MILESTONES);
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_RESET%', $NEW_FUNCTIONS_MEDAL_RESET);
		tz_config_set($text, '%NEW_FUNCTIONS_HERO_T4%', $NEW_FUNCTIONS_HERO_T4);
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_HUNS%', $NEW_FUNCTION_TRIBE_HUNS);
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_EGIPTEANS%', $NEW_FUNCTION_TRIBE_EGIPTEANS);
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_SPARTANS%', $NEW_FUNCTION_TRIBE_SPARTANS);
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_VIKINGS%', $NEW_FUNCTION_TRIBE_VIKINGS);
		// Preserve registration-bonus-gold settings (owned by editNewFunctions.php).
		tz_config_set($text, '%NEW_FUNCTION_REGISTRATION_GOLD%', (defined('NEW_FUNCTION_REGISTRATION_GOLD') && NEW_FUNCTION_REGISTRATION_GOLD ? 'true' : 'false'));
		tz_config_set($text, '%NEW_FUNCTION_REGISTRATION_GOLD_VALUE%', (string) (defined('NEW_FUNCTION_REGISTRATION_GOLD_VALUE') ? (int) NEW_FUNCTION_REGISTRATION_GOLD_VALUE : 200));

		// PLUS settings need to be kept intact
		tz_config_set($text, '%PLUS_TIME%', PLUS_TIME);
		tz_config_set($text, '%PLUS_PRODUCTION%', PLUS_PRODUCTION);
		tz_config_set($text, '%PAYPAL_EMAIL%', (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'martin@martinambrus.com'));
		tz_config_set($text, '%PAYPAL_CURRENCY%', (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'));
		tz_config_set($text, '%PLUS_PACKAGE_A_PRICE%', (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99'));
		tz_config_set($text, '%PLUS_PACKAGE_A_GOLD%', (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : '60'));
		tz_config_set($text, '%PLUS_PACKAGE_B_PRICE%', (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99'));
		tz_config_set($text, '%PLUS_PACKAGE_B_GOLD%', (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : '120'));
		tz_config_set($text, '%PLUS_PACKAGE_C_PRICE%', (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99'));
		tz_config_set($text, '%PLUS_PACKAGE_C_GOLD%', (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : '360'));
		tz_config_set($text, '%PLUS_PACKAGE_D_PRICE%', (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99'));
		tz_config_set($text, '%PLUS_PACKAGE_D_GOLD%', (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : '1000'));
		tz_config_set($text, '%PLUS_PACKAGE_E_PRICE%', (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99'));
		tz_config_set($text, '%PLUS_PACKAGE_E_GOLD%', (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : '2000'));

		fwrite($fh, $text);
		fclose($fh);

$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$id.",'Changed General Server Settings',".time().")");

header("Location: ../../../Admin/admin.php?p=config");

?>
