<?php

require_once(__DIR__ . '/../../Instance/Resolver.php');
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editExtraSet.php                                            ##
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

$myFile = InstanceResolver::adminConfigPath();

		$ERRORREPORT=ERROR_REPORT;
		$T4=(T4_COMING==false)? "false":"true";
		$QUEST=(QUEST==false)? "false":"true";
		$WW=(WW==false)? "false":"true";
		$SHOW_NATARS=(SHOW_NATARS==false)? "false":"true";
		$AUTH_EMAIL=(AUTH_EMAIL==false)? "false":"true";
		$GREAT_WKS=(GREAT_WKS==false)? "false":"true";
		$REG_OPEN=(REG_OPEN==false)? "false":"true";

		$LOG_BUILD=(LOG_BUILD==false)? "false":"true";
		$LOG_TECH=(LOG_TECH==false)? "false":"true";
		$LOG_LOGIN=(LOG_LOGIN==false)? "false":"true";
		$LOG_GOLD_FIN=(LOG_GOLD_FIN==false)? "false":"true";
		$LOG_ADMIN=(LOG_ADMIN==false)? "false":"true";
		$LOG_WAR=(LOG_WAR==false)? "false":"true";
		$LOG_MARKET=(LOG_MARKET==false)? "false":"true";
		$LOG_ILLEGAL=(LOG_ILLEGAL==false)? "false":"true";
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

		$text = admin_config_template_contents();
		tz_config_set($text, '%ERRORREPORT%', ERROR_REPORT);
		tz_config_set($text, '%ERROR%', ERROR_REPORT, 'code');
		tz_config_set($text, '%SERVERNAME%', SERVER_NAME);
		tz_config_set($text, '%STIMEZONE%', TIMEZONE);
		tz_config_set($text, '%STARTTIME%', COMMENCE);
		tz_config_set($text, '%SSTARTDATE%', START_DATE);
		tz_config_set($text, '%SSTARTTIME%', START_TIME);
		tz_config_set($text, '%LANG%', (defined('SERVER_LANG') ? SERVER_LANG : LANG));
		tz_config_set($text, '%SPEED%', SPEED);
		tz_config_set($text, '%MAX%', WORLD_MAX);
		tz_config_set($text, '%INCSPEED%', INCREASE_SPEED);
		tz_config_set($text, '%EVASIONSPEED%', EVASION_SPEED);
		tz_config_set($text, '%TRADERCAP%', TRADER_CAPACITY);
		tz_config_set($text, '%CRANNYCAP%', CRANNY_CAPACITY);
		tz_config_set($text, '%TRAPPERCAP%', TRAPPER_CAPACITY);
		tz_config_set($text, '%VILLAGE_EXPAND%', CP);
		tz_config_set($text, '%DEMOLISH%', DEMOLISH_LEVEL_REQ);
		tz_config_set($text, '%STORAGE_MULTIPLIER%', STORAGE_MULTIPLIER);
		tz_config_set($text, '%QUEST%', QUEST);
		tz_config_set($text, '%QTYPE%', QTYPE);
		tz_config_set($text, '%BEGINNER%', PROTECTION);
		tz_config_set($text, '%WW%', (WW ? 'true' : 'false'));
		tz_config_set($text, '%SHOW_NATARS%', (SHOW_NATARS ? 'true' : 'false'));
		tz_config_set($text, '%NATARS_UNITS%', NATARS_UNITS);
		tz_config_set($text, '%NATARS_SPAWN_TIME%', NATARS_SPAWN_TIME);
		tz_config_set($text, '%NATARS_WW_SPAWN_TIME%', NATARS_WW_SPAWN_TIME);
		tz_config_set($text, '%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%', NATARS_WW_BUILDING_PLAN_SPAWN_TIME);
		tz_config_set($text, '%NATURE_REGTIME%', NATURE_REGTIME);
		tz_config_set($text, '%OASIS_WOOD_MULTIPLIER%', OASIS_WOOD_MULTIPLIER);
		tz_config_set($text, '%OASIS_CLAY_MULTIPLIER%', OASIS_CLAY_MULTIPLIER);
		tz_config_set($text, '%OASIS_IRON_MULTIPLIER%', OASIS_IRON_MULTIPLIER);
		tz_config_set($text, '%OASIS_CROP_MULTIPLIER%', OASIS_CROP_MULTIPLIER);
		tz_config_set($text, '%T4_COMING%', (T4_COMING ? 'true' : 'false'));
		tz_config_set($text, '%ACTIVATE%', (AUTH_EMAIL ? 'true' : 'false'));
		tz_config_set($text, '%MEDALINTERVAL%', MEDALINTERVAL);
		tz_config_set($text, '%GREAT_WKS%', (GREAT_WKS ? 'true' : 'false'));
		tz_config_set($text, '%TS_THRESHOLD%', TS_THRESHOLD);
		tz_config_set($text, '%REG_OPEN%', REG_OPEN);
		tz_config_set($text, '%PEACE%', PEACE);
		tz_config_set($text, '%LOGBUILD%', (LOG_BUILD ? 'true' : 'false'));
		tz_config_set($text, '%LOGTECH%', (LOG_TECH ? 'true' : 'false'));
		tz_config_set($text, '%LOGLOGIN%', (LOG_LOGIN ? 'true' : 'false'));
		tz_config_set($text, '%LOGGOLDFIN%', (LOG_GOLD_FIN ? 'true' : 'false'));
		tz_config_set($text, '%LOGADMIN%', (LOG_ADMIN ? 'true' : 'false'));
		tz_config_set($text, '%LOGWAR%', (LOG_WAR ? 'true' : 'false'));
		tz_config_set($text, '%LOGMARKET%', (LOG_MARKET ? 'true' : 'false'));
		tz_config_set($text, '%LOGILLEGAL%', (LOG_ILLEGAL ? 'true' : 'false'));
		tz_config_set($text, '%BOX1%', (NEWSBOX1 ? 'true' : 'false'));
		tz_config_set($text, '%BOX2%', (NEWSBOX2 ? 'true' : 'false'));
		tz_config_set($text, '%BOX3%', (NEWSBOX3 ? 'true' : 'false'));
		tz_config_set($text, '%SSERVER%', SQL_SERVER);
		$text = str_replace("%SPORT%", SQL_PORT, $text);
		tz_config_set($text, '%SUSER%', SQL_USER);
		tz_config_set($text, '%SPASS%', SQL_PASS);
		tz_config_set($text, '%SDB%', SQL_DB);
		tz_config_set($text, '%PREFIX%', TB_PREFIX);
		tz_config_set($text, '%CONNECTT%', DB_TYPE);
		tz_config_set($text, '%LIMIT_MAILBOX%', $_POST['limit_mailbox'] ?? '');
		tz_config_set($text, '%MAX_MAILS%', MAX_MAIL);
		tz_config_set($text, '%ARANK%', (INCLUDE_ADMIN ? 'true' : 'false'));
		tz_config_set($text, '%AEMAIL%', ADMIN_EMAIL);
		tz_config_set($text, '%ANAME%', ADMIN_NAME);
		tz_config_set($text, '%ASUPPMSGS%', $SUPPORT_MSGS_IN_ADMIN);
		tz_config_set($text, '%ARAIDS%', $ADMINS_RAIDABLE);

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

		// Ultima verificare: rezolva orice placeholder pe care acest modul
		// nu il trateaza. TREBUIE apelata dupa toate tz_config_set() si
		// inainte de scriere - altfel setarile modulului ar fi ignorate.
		$text = tz_config_finalize($text);

		// SCRIERE IN SIGURANTA.
		//
		// Inainte, fisierul se deschidea cu 'w' la INCEPUTUL scriptului, adica se
		// golea imediat. Orice eroare aparuta pana la fwrite lasa config.php GOL
		// si serverul mort. Acum scriem intai intr-un fisier temporar si abia la
		// final il punem in locul celui vechi, printr-o redenumire atomica.
		$tmpFile = $myFile . '.tmp';
		$fh = fopen($tmpFile, 'w') or die("<br/><br/><br/>Can't open file: GameEngine\\config.php");

		if (fwrite($fh, $text) === false) {
		    fclose($fh);
		    @unlink($tmpFile);
		    die("<br/><br/><br/>Can't write file: GameEngine\\config.php");
		}

		fclose($fh);

		// pastram o copie a variantei anterioare, pentru orice eventualitate
		if (is_file($myFile)) {
		    @copy($myFile, $myFile . '.bak');
		}

		if (!rename($tmpFile, $myFile)) {
		    @unlink($tmpFile);
		    die("<br/><br/><br/>Can't replace file: GameEngine\\config.php");
		}

$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$id.",'Changed Extra server settings',".time().")");

header("Location: ../../../Admin/admin.php?p=config");

?>
