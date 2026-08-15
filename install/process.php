<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					                           ##
##  Version:       01.09.2013 						                           ##
##  Filename       process.php                                                 ##
##  Developed by:  Shadow			                                           ##
##  Fixed by:      Shadow cata7007@gmail.com                       			   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
@set_time_limit(0);

require_once __DIR__ . '/../GameEngine/Instance/Resolver.php';

/*
 * The POST request already contains the selected instance in the hidden form
 * field. Start the matching instance session before touching $_SESSION.
 * Starting a generic PHPSESSID here would prevent the resolver from switching
 * to TZSESSID_S1/TZSESSID_S2 and produces "headers already sent" warnings on
 * the following installation step.
 */
$installerPostInstance = InstanceResolver::sanitize(isset($_POST['instance']) ? $_POST['instance'] : '');
if ($installerPostInstance === null && session_status() === PHP_SESSION_ACTIVE) {
    $installerPostInstance = InstanceResolver::sanitize(isset($_SESSION['install_instance']) ? $_SESSION['install_instance'] : '');
}
if ($installerPostInstance !== null) {
    InstanceResolver::startInstanceSession($installerPostInstance);
    $_SESSION['install_instance'] = $installerPostInstance;
}

class Process {

	function __construct() {
		if(isset($_POST['subconst'])) {
			$this->constForm();
		} else
			if(isset($_POST['substruc'])) {
				$this->createStruc();
			} else
				if(isset($_POST['subwdata'])) {
					$this->createWdata();
				} else
					if(isset($_POST['subacc'])) {
						$this->createAcc();
						} else {
							header("Location: index.php?instance=" . rawurlencode($instanceId));
						}
	}

	/**
	 * Resolve the instance associated with the current installer POST request.
	 *
	 * The instance is read from POST first and from the installer session
	 * second. This prevents a missing query parameter or redirect from silently
	 * falling back to S1 during a later installation step.
	 */
	private function getInstanceId() {
		$instanceId = InstanceResolver::sanitize(isset($_POST['instance']) ? $_POST['instance'] : '');
		if ($instanceId === null) {
			$instanceId = InstanceResolver::sanitize(isset($_SESSION['install_instance']) ? $_SESSION['install_instance'] : '');
		}
		if ($instanceId === null) {
			die("<span class='f18 c5'>ERROR!</span><br />Invalid or missing TravianZ instance identifier.");
		}
		$_SESSION['install_instance'] = $instanceId;
		return $instanceId;
	}

	private function constForm() {
		$instanceId = $this->getInstanceId();


        $instancePath = InstanceResolver::instancePath($instanceId);
        $runtimePath = InstanceResolver::runtimePath($instanceId);
        $configFile = InstanceResolver::configPath($instanceId);
        $configTemplateFile = "../GameEngine/Admin/Mods/constant_format.tpl";

        // Each world owns its configuration and runtime directory. The PHP
        // source code itself remains shared between all worlds.
        if (!is_dir($instancePath) && !@mkdir($instancePath, 0755, true)) {
            die("<br/><br/><br/>Can't create instance directory: " . htmlspecialchars($instanceId, ENT_QUOTES, 'UTF-8'));
        }
        if (!is_dir($runtimePath) && !@mkdir($runtimePath, 0755, true)) {
            die("<br/><br/><br/>Can't create instance runtime directory.");
        }

        $gameConfig = @fopen($configFile, 'w') or die("<br/><br/><br/>Can't create or update instance config.php");

		// copy the contents of the config template file into a new location, used when editing
		// game configuration from the in-game Admin (since the install folder would be deleted at that point)
		$templateFile = @fopen($configTemplateFile, 'w') or die("<br/><br/><br/>Can't create or update file: GameEngine\Admin\Mods\constant_format.tpl");
		fclose($templateFile);

		$text = file_get_contents("data/constant_format.tpl");

		// make template copy
		file_put_contents($configTemplateFile, $text);

		// continue with text replacements
		$findReplace = [];
		
		$findReplace["%INSTANCEID%"] = $instanceId;
		$findReplace["%SERVERNAME%"] = $_POST['servername'];
		$findReplace["%SSTARTDATE%"] = $_POST['start_date'];
		$findReplace["%SSTARTTIME%"] = $_POST['start_time'];

		$tz = explode(",",$_POST['tzone']);
        $findReplace["%STIMEZONE%"] = $tz[1];
		$findReplace["%LANG%"] = $_POST['lang'];
		$findReplace["%SPEED%"] = $_POST['speed'];
		$findReplace["%SERVERNUMBER%"] = (int) preg_replace('/\D+/', '', $instanceId) ?: 1;
		$findReplace["%SERVERCLASSIC%"] = (isset($_POST['server_classic']) && $_POST['server_classic'] === 'true') ? 'true' : 'false';
		$findReplace["%SERVERSPEED%"] = (isset($_POST['server_speed']) && $_POST['server_speed'] === 'true') ? 'true' : 'false';
		$findReplace["%SERVERENABLED%"] = 'true';
		$findReplace["%INCSPEED%"] = $_POST['incspeed'];
		$findReplace["%EVASIONSPEED%"] = $_POST['evasionspeed'];
		$findReplace["%TRADERCAP%"] = $_POST['tradercap'];
		$findReplace["%CRANNYCAP%"] = $_POST['crannycap'];
		$findReplace["%TRAPPERCAP%"] = $_POST['trappercap'];
		$findReplace["%STORAGE_MULTIPLIER%"] = $_POST['storage_multiplier'];
		$findReplace["%MAX%"] = $_POST['wmax'];
		// Comutatorul de pachete grafice proprii. Linia era comentata, deci %GP%
		// ramanea neinlocuit in config.php si constanta nu se definea deloc.
		// Bonusuri de alianta (port T4)
		$findReplace["%ALLIANCEBONUSES%"] = (isset($_POST['alliance_bonuses']) && $_POST['alliance_bonuses'] === 'true') ? 'true' : 'false';

		// Statistici grafice (Travian Plus)
		$findReplace["%PLUSSTATS%"] = (isset($_POST['plus_statistics']) && $_POST['plus_statistics'] === 'false') ? 'false' : 'true';

		$psHours = isset($_POST['plus_stats_hours']) ? (float) $_POST['plus_stats_hours'] : 6;
		if ($psHours < 0.25 || $psHours > 168) { $psHours = 6; }
		$findReplace["%PLUSSTATSHOURS%"] = $psHours;

		$psKeep = isset($_POST['plus_stats_keep']) ? (int) $_POST['plus_stats_keep'] : 0;
		if ($psKeep < 0 || $psKeep > 3650) { $psKeep = 0; }
		$findReplace["%PLUSSTATSKEEP%"] = $psKeep;

		// Regulile de inregistrare
		$findReplace["%USRNMSPECIAL%"] = (isset($_POST['usrnm_special']) && $_POST['usrnm_special'] === 'false') ? 'false' : 'true';

		$uMin = isset($_POST['usrnm_min']) ? (int) $_POST['usrnm_min'] : 3;
		if ($uMin < 1 || $uMin > 50) { $uMin = 3; }
		$findReplace["%USRNMMIN%"] = $uMin;

		$uMax = isset($_POST['usrnm_max']) ? (int) $_POST['usrnm_max'] : 15;
		if ($uMax < $uMin || $uMax > 100) { $uMax = max(15, $uMin); }
		$findReplace["%USRNMMAX%"] = $uMax;

		$pMin = isset($_POST['pw_min']) ? (int) $_POST['pw_min'] : 4;
		if ($pMin < 1 || $pMin > 100) { $pMin = 4; }
		$findReplace["%PWMIN%"] = $pMin;

		// Minunea Lumii cu stil pe trib
		$findReplace["%WWIMAGE%"] = (isset($_POST['ww_image']) && $_POST['ww_image'] === 'false') ? 'false' : 'true';

		// Jucatori protejati impotriva atacurilor
		$findReplace["%PROTECTEDPLAYERS%"] = isset($_POST['protected_players'])
			? trim(str_replace('"', '', $_POST['protected_players'])) : '';

		$findReplace["%GP%"] = (isset($_POST['gpack']) && $_POST['gpack'] === 'true') ? 'true' : 'false';
		$findReplace["%SSERVER%"] = $_POST['sserver'];
		$findReplace["%SPORT%"] = $_POST['sport'];
		$findReplace["%SUSER%"] = $_POST['suser'];
		$findReplace["%SPASS%"] = $_POST['spass'];
		$findReplace["%SDB%"] = $_POST['sdb'];
		$findReplace["%PREFIX%"] = $_POST['prefix'];
		$findReplace["%CONNECTT%"] = $_POST['connectt'];
		$findReplace["%ASUPPMSGS%"] = 'true';
		$findReplace["%ARAIDS%"] = 'false';
		$findReplace["%LOGBUILD%"] = $_POST['log_build'];
		$findReplace["%LOGTECH%"] = $_POST['log_tech'];
		$findReplace["%LOGLOGIN%"] = $_POST['log_login'];
		$findReplace["%LOGGOLDFIN%"] = $_POST['log_gold_fin'];
		$findReplace["%LOGADMIN%"] = $_POST['log_admin'];
		$findReplace["%LOGWAR%"] = $_POST['log_war'];
		$findReplace["%LOGMARKET%"] = $_POST['log_market'];
		$findReplace["%LOGILLEGAL%"] = $_POST['log_illegal'];
		$findReplace["%ACTIVATE%"] = $_POST['activate'];
		$findReplace["%ARANK%"] = 'false';
		$findReplace["%QUEST%"] = $_POST['quest'];
		$findReplace["%QTYPE%"] = $_POST['qtype'];  
		$findReplace["%BEGINNER%"] = $_POST['beginner'];
		$findReplace["%STARTTIME%"] = time();
		// Cheie aleatoare pentru apelul HTTP al cron.php (vezi CRON_KEY in config).
		// Generata o singura data, la instalare; ACP-ul o pastreaza la resalvari.
		$findReplace["%CRONKEY%"] = bin2hex(random_bytes(24));
		// Valori implicite pentru ciclul intern al cron.php; editabile ulterior
		// din ACP (Config -> Cron & Automation -> edit).
		// Setarile de cron si de curatenie vin acum din formularul de instalare
		// (sectiunea CRON & AUTOMATION). Valorile sunt limitate aici, ca un
		// formular trimis modificat sa nu scrie ceva absurd in config.php.
		$cronLoop = isset($_POST['cron_loop']) ? (int) $_POST['cron_loop'] : 300;
		$cronTick = isset($_POST['cron_tick']) ? (int) $_POST['cron_tick'] : 60;

		if ($cronLoop < 0)    { $cronLoop = 0; }
		if ($cronLoop > 3300) { $cronLoop = 3300; }
		if ($cronTick < 15)   { $cronTick = 15; }
		if ($cronTick > 900)  { $cronTick = 900; }

		// Un ciclu mai scurt decat un tick nu are sens: il tratam ca "o singura
		// rulare per invocare".
		if ($cronLoop > 0 && $cronLoop < $cronTick) { $cronLoop = 0; }

		$findReplace["%CRONLOOP%"] = $cronLoop;
		$findReplace["%CRONTICK%"] = $cronTick;

		// Retentiile curateniei periodice (0 = regula dezactivata).
		$cleanupFields = array(
			"%CLEANUPREPORTS%"  => array('cleanup_reports', 14),
			"%CLEANUPCHAT%"     => array('cleanup_chat', 7),
			"%CLEANUPMESSAGES%" => array('cleanup_messages', 0),
		);

		foreach ($cleanupFields as $placeholder => $field) {
			list($postName, $default) = $field;

			$value = isset($_POST[$postName]) ? (int) $_POST[$postName] : $default;

			if ($value < 0)    { $value = 0; }
			if ($value > 3650) { $value = 3650; }

			$findReplace[$placeholder] = $value;
		}

		// Regenerarea de baza a vietii eroului (HP pe zi). Vezi HERO_BASE_REGEN.
		$heroRegen = isset($_POST['hero_base_regen']) ? (int) $_POST['hero_base_regen'] : 10;

		if ($heroRegen < 0)   { $heroRegen = 0; }
		if ($heroRegen > 100) { $heroRegen = 100; }

		$findReplace["%HEROBASEREGEN%"] = $heroRegen;

		// Ratele casei de schimb (aur <-> argint), din formularul de instalare.
		$silverPerGold = isset($_POST['hero_silver_per_gold']) ? (int) $_POST['hero_silver_per_gold'] : 10;
		$silverToGold  = isset($_POST['hero_silver_to_gold'])  ? (int) $_POST['hero_silver_to_gold']  : 25;

		if ($silverPerGold < 1)     { $silverPerGold = 1; }
		if ($silverPerGold > 10000) { $silverPerGold = 10000; }
		if ($silverToGold < 1)      { $silverToGold = 1; }
		if ($silverToGold > 10000)  { $silverToGold = 10000; }

		$findReplace["%HEROSILVERPERGOLD%"] = $silverPerGold;
		$findReplace["%HEROSILVERTOGOLD%"]  = $silverToGold;

		// Atributul de erou "Resources": cate resurse da un punct pe ora.
		$resAll = isset($_POST['hero_res_all']) ? (int) $_POST['hero_res_all'] : 3;
		$resOne = isset($_POST['hero_res_one']) ? (int) $_POST['hero_res_one'] : 10;

		if ($resAll < 0)    { $resAll = 0; }
		if ($resAll > 10000) { $resAll = 10000; }
		if ($resOne < 0)    { $resOne = 0; }
		if ($resOne > 10000) { $resOne = 10000; }

		$findReplace["%HERORESALL%"] = $resAll;
		$findReplace["%HERORESONE%"] = $resOne;
		$findReplace["%DOMAIN%"] = $_POST['domain'];
		$findReplace["%HOMEPAGE%"] = $_POST['homepage'];
		$findReplace["%SERVER%"] = $_POST['server'];
		$findReplace["%LIMIT_MAILBOX%"] = $_POST['limit_mailbox'];
		$findReplace["%MAX_MAILS%"] = $_POST['max_mails'];
		$findReplace["%DEMOLISH%"] = $_POST['demolish'];
		$findReplace["%BOX1%"] = $_POST['box1'];
		$findReplace["%BOX2%"] = $_POST['box2'];
		$findReplace["%BOX3%"] = $_POST['box3'];
		$findReplace["%VILLAGE_EXPAND%"] = $_POST['village_expand'];
		$findReplace["%ERRORREPORT%"] = $_POST['error'];
		$findReplace["%ERROR%"] = $_POST['error'];
		// Pachetul grafic al serverului. Linia era comentata, deci %GP_LOCATE%
		// ramanea neinlocuit in config.php. Validam ca directorul chiar exista si
		// contine travian.css, altfel jocul ar porni fara stiluri.
		$gpLocate = isset($_POST['gp_locate']) ? (string) $_POST['gp_locate'] : 'gpack/travian_default/';

		if (!preg_match('#^gpack/[A-Za-z0-9_\-]+/$#', $gpLocate)
			|| !is_file('../' . $gpLocate . 'travian.css')) {
			$gpLocate = 'gpack/travian_default/';
		}

		$findReplace["%GP_LOCATE%"] = $gpLocate;
		$findReplace["%PLUS_TIME%"] = $_POST['plus_time'];
		$findReplace["%PLUS_PRODUCTION%"] = $_POST['plus_production'];
		$findReplace["%PAYPAL_EMAIL%"] = $_POST['paypal-email'];
		$findReplace["%PAYPAL_CURRENCY%"] = $_POST['paypal-currency'];
		$findReplace["%PLUS_PACKAGE_A_GOLD%"] = $_POST['plus-a-gold'];
		$findReplace["%PLUS_PACKAGE_A_PRICE%"] = $_POST['plus-a-price'];
		$findReplace["%PLUS_PACKAGE_B_GOLD%"] = $_POST['plus-b-gold'];
		$findReplace["%PLUS_PACKAGE_B_PRICE%"] = $_POST['plus-b-price'];
		$findReplace["%PLUS_PACKAGE_C_GOLD%"] = $_POST['plus-c-gold'];
		$findReplace["%PLUS_PACKAGE_C_PRICE%"] = $_POST['plus-c-price'];
		$findReplace["%PLUS_PACKAGE_D_GOLD%"] = $_POST['plus-d-gold'];
		$findReplace["%PLUS_PACKAGE_D_PRICE%"] = $_POST['plus-d-price'];
		$findReplace["%PLUS_PACKAGE_E_GOLD%"] = $_POST['plus-e-gold'];
		$findReplace["%PLUS_PACKAGE_E_PRICE%"] = $_POST['plus-e-price'];
		$findReplace["%MEDALINTERVAL%"] = $_POST['medalinterval'];
		$findReplace["%GREAT_WKS%"] = $_POST['great_wks'];
		$findReplace["%TS_THRESHOLD%"] = $_POST['ts_threshold'];
		$findReplace["%WW%"] = $_POST['ww'];
		$findReplace["%SHOW_NATARS%"] = $_POST['show_natars'];
		$findReplace["%NATARS_UNITS%"] = $_POST['natars_units'];
		$findReplace["%NATARS_SPAWN_TIME%"] = $_POST['natars_spawn_time'];
		$findReplace["%NATARS_WW_SPAWN_TIME%"] = $_POST['natars_ww_spawn_time'];
		$findReplace["%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%"] = $_POST['natars_ww_building_plan_spawn_time'];

		// Dupa cate zile de la aparitia planurilor incep Natarii Minunea lor.
		$natarsWwDelay = isset($_POST['natars_ww_start_delay']) ? (int) $_POST['natars_ww_start_delay'] : 10;
		if ($natarsWwDelay < 0 || $natarsWwDelay > 3650) { $natarsWwDelay = 10; }
		$findReplace["%NATARS_WW_START_DELAY%"] = $natarsWwDelay;
		$findReplace["%NATURE_REGTIME%"] = $_POST['nature_regtime'];
		$findReplace["%OASIS_WOOD_MULTIPLIER%"] = $_POST['oasis_wood_multiplier'];
		$findReplace["%OASIS_CLAY_MULTIPLIER%"] = $_POST['oasis_clay_multiplier'];
		$findReplace["%OASIS_IRON_MULTIPLIER%"] = $_POST['oasis_iron_multiplier'];
		$findReplace["%OASIS_CROP_MULTIPLIER%"] = $_POST['oasis_crop_multiplier'];
		$findReplace["%T4_COMING%"] = $_POST['t4_coming'];
		$findReplace["%REG_OPEN%"] = $_POST['reg_open'];
		$findReplace["%PEACE%"] = $_POST['peace'];

		//New Mechanics and Functions
		$findReplace["%NEW_FUNCTIONS_OASIS%"] = $_POST['new_functions_oasis'];
		$findReplace["%NEW_FUNCTIONS_ALLIANCE_INVITATION%"] = $_POST['new_functions_alliance_invitation'];
		$findReplace["%NEW_FUNCTIONS_EMBASSY_MECHANICS%"] = $_POST['new_functions_embassy_mechanics'];
		$findReplace["%NEW_FUNCTIONS_FORUM_POST_MESSAGE%"] = $_POST['new_functions_forum_post_message'];
		$findReplace["%NEW_FUNCTIONS_TRIBE_IMAGES%"] = $_POST['new_functions_tribe_images'];
		$findReplace["%NEW_FUNCTIONS_MHS_IMAGES%"] = $_POST['new_functions_mhs_images'];
		$findReplace["%NEW_FUNCTIONS_DISPLAY_ARTIFACT%"] = $_POST['new_functions_display_artifact'];
		$findReplace["%NEW_FUNCTIONS_DISPLAY_WONDER%"] = $_POST['new_functions_display_wonder'];
		$findReplace["%NEW_FUNCTIONS_VACATION%"] = $_POST['new_functions_vacation'];
		$findReplace["%NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET%"] = $_POST['new_functions_display_catapult_target'];
		$findReplace["%NEW_FUNCTIONS_MANUAL_NATURENATARS%"] = $_POST['new_functions_manual_naturenatars'];
		$findReplace["%NEW_FUNCTIONS_DISPLAY_LINKS%"] = $_POST['new_functions_display_links'];
		$findReplace["%NEW_FUNCTIONS_MEDAL_3YEAR%"] = $_POST['new_functions_medal_3year'];
		$findReplace["%NEW_FUNCTIONS_MEDAL_5YEAR%"] = $_POST['new_functions_medal_5year'];
		$findReplace["%NEW_FUNCTIONS_MEDAL_10YEAR%"] = $_POST['new_functions_medal_10year'];
		$findReplace["%NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM%"] = $_POST['new_functions_special_medals_system'];
		$findReplace["%NEW_FUNCTIONS_MILESTONES%"] = $_POST['new_functions_milestones'];
		$findReplace["%NEW_FUNCTIONS_MEDAL_RESET%"] = $_POST['new_functions_medal_reset'];
		$findReplace["%NEW_FUNCTIONS_HERO_T4%"] = $_POST['new_functions_hero_t4'];
		$findReplace["%NEW_FUNCTION_TRIBE_HUNS%"] = $_POST['new_function_tribe_huns'];
		$findReplace["%NEW_FUNCTION_TRIBE_EGIPTEANS%"] = $_POST['new_function_tribe_egipteans'];
		$findReplace["%NEW_FUNCTION_TRIBE_SPARTANS%"] = $_POST['new_function_tribe_spartans'];
		$findReplace["%NEW_FUNCTION_TRIBE_VIKINGS%"] = $_POST['new_function_tribe_vikings'];
		$findReplace["%NEW_FUNCTION_REGISTRATION_GOLD%"] = $_POST['new_function_registration_gold'];
		$findReplace["%NEW_FUNCTION_REGISTRATION_GOLD_VALUE%"] = $_POST['new_function_registration_gold_value'];

		fwrite($gameConfig, str_replace(array_keys($findReplace), array_values($findReplace), $text));

		if (file_exists($configFile) && file_exists($configTemplateFile)) {
			header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=2");
		} else {
			header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=1&c=1");
		}

		fclose($gameConfig);
	}

	/**
	 * Creates database structure for the game.
	 */
	function createStruc() {
	    global $database;
	    $instanceId = $this->getInstanceId();

	    include ("../GameEngine/config.php");
	    include ("../GameEngine/Database.php");
	    include ("../GameEngine/Admin/database.php");

	    // create table structure
	    $result = $database->createDbStructure();
        if ($result === false) {
            header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=2&err=1");
            exit;
        } else if ($result === -1) {
	        header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=2&c=1");
	        exit;
	    }

    	header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=3");
    	exit;
	}

	/**
	 * Generates map data and populates it with oasis.
	 */
		function createWdata() {
			global $database;
			$instanceId = $this->getInstanceId();

			include ("../GameEngine/config.php");
			include ("../GameEngine/Database.php");
			include ("../GameEngine/Admin/database.php");

			// 1) Populate world data
			$result = $database->populateWorldData();
			if ($result === false) {
				header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=3&err=1");
				exit;
			} else if ($result === -1) {
				header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=3&c=1");
				exit;
			}

			header("Location: index.php?instance=" . rawurlencode($instanceId) . "&s=3&startCroppers=1");
			exit;
		}

}
;

$process = new Process;

?>
