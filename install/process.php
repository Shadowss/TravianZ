<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       process.php                                                 ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
@set_time_limit(0);

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
							header("Location: index.php");
						}
	}

	private function constForm() {
	    $configFile = "../GameEngine/config.php";
		$configTemplateFile = "../GameEngine/Admin/Mods/constant_format.tpl";

		$gameConfig = @fopen($configFile, 'w') or die("<br/><br/><br/>Can't create or update file: GameEngine\config.php");

		// copy the contents of the config template file into a new location, used when editing
		// game configuration from the in-game Admin (since the install folder would be deleted at that point)
		$templateFile = @fopen($configTemplateFile, 'w') or die("<br/><br/><br/>Can't create or update file: GameEngine\Admin\Mods\constant_format.tpl");
		fclose($templateFile);

		$text = file_get_contents("data/constant_format.tpl");

		// make template copy
		file_put_contents($configTemplateFile, $text);

		// continue with text replacements
		$findReplace = [];
		
		$findReplace["%SERVERNAME%"] = $_POST['servername'];
		$findReplace["%SSTARTDATE%"] = $_POST['start_date'];
		$findReplace["%SSTARTTIME%"] = $_POST['start_time'];

		$tz = explode(",",$_POST['tzone']);
        $findReplace["%STIMEZONE%"] = $tz[1];
		$findReplace["%LANG%"] = $_POST['lang'];
		$findReplace["%SPEED%"] = $_POST['speed'];
		$findReplace["%INCSPEED%"] = $_POST['incspeed'];
		$findReplace["%EVASIONSPEED%"] = $_POST['evasionspeed'];
		$findReplace["%TRADERCAP%"] = $_POST['tradercap'];
		$findReplace["%CRANNYCAP%"] = $_POST['crannycap'];
		$findReplace["%TRAPPERCAP%"] = $_POST['trappercap'];
		$findReplace["%STORAGE_MULTIPLIER%"] = $_POST['storage_multiplier'];
		//$findReplace["%UTRACK%"] = $_POST['trackusers'];
		//$findReplace["%UTOUT%"] = $_POST['timeout'];
		//$findReplace["%AUTOD%"] = $_POST['autodel'];
		//$findReplace["%AUTODT%"] = $_POST['autodeltime'];
		$findReplace["%MAX%"] = $_POST['wmax'];
		//$findReplace["%GP%"] = $_POST['gpack'];
		$findReplace["%SSERVER%"] = $_POST['sserver'];
		$findReplace["%SPORT%"] = $_POST['sport'];
		$findReplace["%SUSER%"] = $_POST['suser'];
		$findReplace["%SPASS%"] = $_POST['spass'];
		$findReplace["%SDB%"] = $_POST['sdb'];
		$findReplace["%PREFIX%"] = $_POST['prefix'];
		$findReplace["%CONNECTT%"] = $_POST['connectt'];
		$findReplace["%ASUPPMSGS%"] = 'true';
		$findReplace["%ARAIDS%"] = 'false';
		//$findReplace["%SUBDOM%"] = $_POST['subdom'];
		$findReplace["%LOGBUILD%"] = $_POST['log_build'];
		$findReplace["%LOGTECH%"] = $_POST['log_tech'];
		$findReplace["%LOGLOGIN%"] = $_POST['log_login'];
		$findReplace["%LOGGOLDFIN%"] = $_POST['log_gold_fin'];
		$findReplace["%LOGADMIN%"] = $_POST['log_admin'];
		$findReplace["%LOGWAR%"] = $_POST['log_war'];
		$findReplace["%LOGMARKET%"] = $_POST['log_market'];
		$findReplace["%LOGILLEGAL%"] = $_POST['log_illegal'];
		//$findReplace["%MINUSERLENGTH%"] = $_POST['userlength'];
		//$findReplace["%MINPASSLENGTH%"] = $_POST['passlength'];
		//$findReplace["%SPECIALCHARS%"] = $_POST['specialchars'];
		$findReplace["%ACTIVATE%"] = $_POST['activate'];
		$findReplace["%ARANK%"] = 'false';
		$findReplace["%QUEST%"] = $_POST['quest'];
		$findReplace["%QTYPE%"] = $_POST['qtype'];  
		$findReplace["%BEGINNER%"] = $_POST['beginner'];
		$findReplace["%STARTTIME%"] = time();
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
		//$findReplace["%GP_LOCATE%"] = $_POST['gp_locate'];
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
		$findReplace["%NATURE_REGTIME%"] = $_POST['nature_regtime'];
		$findReplace["%T4_COMING%"] = $_POST['t4_coming'];
		$findReplace["%REG_OPEN%"] = $_POST['reg_open'];
		$findReplace["%PEACE%"] = $_POST['peace'];

		fwrite($gameConfig, str_replace(array_keys($findReplace), array_values($findReplace), $text));

		if (file_exists($configFile) && file_exists($configTemplateFile)) {
			header("Location: index.php?s=2");
		} else {
			header("Location: index.php?s=1&c=1");
		}

		fclose($gameConfig);
	}

	/**
	 * Creates database structure for the game.
	 */
	function createStruc() {
	    global $database;

	    include ("../GameEngine/config.php");
	    include ("../GameEngine/Database.php");
	    include ("../GameEngine/Admin/database.php");

	    // create table structure
	    $result = $database->createDbStructure();
        if ($result === false) {
            header("Location: index.php?s=2&err=1");
            exit;
        } else if ($result === -1) {
	        header("Location: index.php?s=2&c=1");
	        exit;
	    }

    	header("Location: index.php?s=3");
    	exit;
	}

	/**
	 * Generates map data and populates it with oasis.
	 */
	function createWdata() {
	    global $database;

	    include ("../GameEngine/config.php");
	    include ("../GameEngine/Database.php");
	    include ("../GameEngine/Admin/database.php");

	    // populate world data
	    $result = $database->populateWorldData();
	    if ($result === false) {
	        header("Location: index.php?s=3&err=1");
	        exit;
	    } else if ($result === -1) {
	        header("Location: index.php?s=3&c=1");
	        exit;
	    }

	    header("Location: index.php?s=4");
	    exit;
	}

}
;

$process = new Process;

?>
