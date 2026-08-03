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

        // Aceste setari trebuie trimise prin $overrides, NU prin tz_config_set
        // dupa ce functia a returnat: rezerva centrala din
        // admin_config_template_contents() ar consuma placeholderele inainte,
        // iar alegerea adminului s-ar pierde tacut la fiecare salvare.
        $abChoice = (isset($_POST['alliance_bonuses']) && $_POST['alliance_bonuses'] === 'true')
            ? 'true' : 'false';

        $psChoice = (isset($_POST['plus_statistics']) && $_POST['plus_statistics'] === 'true')
            ? 'true' : 'false';

        $psHours = isset($_POST['plus_stats_hours']) ? (float) $_POST['plus_stats_hours'] : 6;
        if ($psHours < 0.25 || $psHours > 168) { $psHours = 6; }

        $psKeep = isset($_POST['plus_stats_keep']) ? (int) $_POST['plus_stats_keep'] : 0;
        if ($psKeep < 0 || $psKeep > 3650) { $psKeep = 0; }

        $text = admin_config_template_contents(array(
            '%ALLIANCEBONUSES%' => $abChoice,
            '%PLUSSTATS%'       => $psChoice,
            '%PLUSSTATSHOURS%'  => $psHours,
            '%PLUSSTATSKEEP%'   => $psKeep,
        ));

		$SUPPORT_MSGS_IN_ADMIN = (ADMIN_RECEIVE_SUPPORT_MESSAGES == false ? 'false' : 'true');
		$ADMINS_RAIDABLE = (ADMIN_ALLOW_INCOMING_RAIDS == false ? 'false' : 'true');
		$REG_OPEN = (REG_OPEN == false ? 'false' : 'true');
		$QUEST = (QUEST == false ? 'false' : 'true');

		// SERVER SETTINGS - we need to keep these intact
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
		tz_config_set($text, '%QUEST%', $QUEST);
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
		tz_config_set($text, '%REG_OPEN%', $REG_OPEN);
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
		tz_config_set($text, '%LIMIT_MAILBOX%', (LIMIT_MAILBOX ? 'true' : 'false'));
		tz_config_set($text, '%MAX_MAILS%', MAX_MAIL);
		tz_config_set($text, '%ARANK%', (INCLUDE_ADMIN ? 'true' : 'false'));
		tz_config_set($text, '%AEMAIL%', ADMIN_EMAIL);
		tz_config_set($text, '%ANAME%', ADMIN_NAME);
		tz_config_set($text, '%ASUPPMSGS%', $SUPPORT_MSGS_IN_ADMIN);
		tz_config_set($text, '%ARAIDS%', $ADMINS_RAIDABLE);

		tz_config_set($text, '%DOMAIN%', DOMAIN);
		tz_config_set($text, '%HOMEPAGE%', HOMEPAGE);
		tz_config_set($text, '%SERVER%', SERVER);
		tz_config_set($text, '%NEW_FUNCTIONS_OASIS%', $_POST['new_functions_oasis'] ?? '');

		tz_config_set($text, '%NEW_FUNCTIONS_ALLIANCE_INVITATION%', $_POST['new_functions_alliance_invitation'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_EMBASSY_MECHANICS%', $_POST['new_functions_embassy_mechanics'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_FORUM_POST_MESSAGE%', $_POST['new_functions_forum_post_message'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_TRIBE_IMAGES%', $_POST['new_functions_tribe_images'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MHS_IMAGES%', $_POST['new_functions_mhs_images'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_ARTIFACT%', $_POST['new_functions_display_artifact'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_WONDER%', $_POST['new_functions_display_wonder'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_VACATION%', $_POST['new_functions_vacation'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET%', $_POST['new_functions_display_catapult_target'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MANUAL_NATURENATARS%', $_POST['new_functions_manual_naturenatars'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_DISPLAY_LINKS%', $_POST['new_functions_display_links'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_3YEAR%', $_POST['new_functions_medal_3year'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_5YEAR%', $_POST['new_functions_medal_5year'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_10YEAR%', $_POST['new_functions_medal_10year'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM%', $_POST['new_functions_special_medals_system'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MILESTONES%', $_POST['new_functions_milestones'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_MEDAL_RESET%', $_POST['new_functions_medal_reset'] ?? '');
		tz_config_set($text, '%NEW_FUNCTIONS_HERO_T4%', $_POST['new_functions_hero_t4'] ?? '');	
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_HUNS%', $_POST['new_function_tribe_huns'] ?? '');
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_EGIPTEANS%', $_POST['new_function_tribe_egipteans'] ?? '');
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_SPARTANS%', $_POST['new_function_tribe_spartans'] ?? '');
		tz_config_set($text, '%NEW_FUNCTION_TRIBE_VIKINGS%', $_POST['new_function_tribe_vikings'] ?? '');
		// Registration bonus gold: owned by THIS Mod (edited from the New Functions form).
		$__reg_gold_on  = (isset($_POST['new_function_registration_gold']) && strtolower((string)$_POST['new_function_registration_gold']) === 'true') ? 'true' : 'false';
		$__reg_gold_val = (int) ($_POST['new_function_registration_gold_value'] ?? 200);
		if ($__reg_gold_val < 0) { $__reg_gold_val = 0; }
		tz_config_set($text, '%NEW_FUNCTION_REGISTRATION_GOLD%', $__reg_gold_on);
		tz_config_set($text, '%NEW_FUNCTION_REGISTRATION_GOLD_VALUE%', (string) $__reg_gold_val);

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

		fwrite($fh, $text);
		fclose($fh);

$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$id.",'Changed New Mechanics and Functions Settings',".time().")");

header("Location: ../../../Admin/admin.php?p=config");

?>
