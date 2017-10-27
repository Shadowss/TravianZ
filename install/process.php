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
		$myFile = "../GameEngine/config.php";
		$fh = @fopen($myFile, 'w') or die("<br/><br/><br/>Can't create or update file: GameEngine\config.php");
		$text = file_get_contents("data/constant_format.tpl");
		$text = preg_replace("'%SERVERNAME%'", $_POST['servername'], $text);
		$text = preg_replace("'%SSTARTDATE%'", $_POST['start_date'], $text);
		$text = preg_replace("'%SSTARTTIME%'", $_POST['start_time'], $text);

		$tz = explode(",",$_POST['tzone']);
        $text = preg_replace("'%STIMEZONE%'", $tz[1], $text);
		$text = preg_replace("'%LANG%'", $_POST['lang'], $text);
		$text = preg_replace("'%SPEED%'", $_POST['speed'], $text);
		$text = preg_replace("'%INCSPEED%'", $_POST['incspeed'], $text);
		$text = preg_replace("'%EVASIONSPEED%'", $_POST['evasionspeed'], $text);
		$text = preg_replace("'%TRADERCAP%'", $_POST['tradercap'], $text);
		$text = preg_replace("'%CRANNYCAP%'", $_POST['crannycap'], $text);
		$text = preg_replace("'%TRAPPERCAP%'", $_POST['trappercap'], $text);
		$text = preg_replace("'%STORAGE_MULTIPLIER%'", $_POST['storage_multiplier'], $text);
		//$text = preg_replace("'%UTRACK%'", $_POST['trackusers'], $text);
		//$text = preg_replace("'%UTOUT%'", $_POST['timeout'], $text);
		//$text = preg_replace("'%AUTOD%'", $_POST['autodel'], $text);
		//$text = preg_replace("'%AUTODT%'", $_POST['autodeltime'], $text);
		$text = preg_replace("'%MAX%'", $_POST['wmax'], $text);
		//$text = preg_replace("'%GP%'", $_POST['gpack'], $text);
		$text = preg_replace("'%SSERVER%'", $_POST['sserver'], $text);
		$text = preg_replace("'%SUSER%'", $_POST['suser'], $text);
		$text = preg_replace("'%SPASS%'", $_POST['spass'], $text);
		$text = preg_replace("'%SDB%'", $_POST['sdb'], $text);
		$text = preg_replace("'%PREFIX%'", $_POST['prefix'], $text);
		$text = preg_replace("'%CONNECTT%'", $_POST['connectt'], $text);
		$text = preg_replace("'%AEMAIL%'", $_POST['aemail'], $text);
		$text = preg_replace("'%ANAME%'", $_POST['aname'], $text);
		$text = preg_replace("'%ASUPPMSGS%'", ($_POST['admin_support_msgs'] == 'True' ? 'true' : 'false'), $text);
		$text = preg_replace("'%ARAIDS%'", ($_POST['admin_raidable'] == 'True' ? 'true' : 'false'), $text);
		//$text = preg_replace("'%SUBDOM%'", $_POST['subdom'], $text);
		$text = preg_replace("'%LOGBUILD%'", $_POST['log_build'], $text);
		$text = preg_replace("'%LOGTECH%'", $_POST['log_tech'], $text);
		$text = preg_replace("'%LOGLOGIN%'", $_POST['log_login'], $text);
		$text = preg_replace("'%LOGGOLDFIN%'", $_POST['log_gold_fin'], $text);
		$text = preg_replace("'%LOGADMIN%'", $_POST['log_admin'], $text);
		$text = preg_replace("'%LOGWAR%'", $_POST['log_war'], $text);
		$text = preg_replace("'%LOGMARKET%'", $_POST['log_market'], $text);
		$text = preg_replace("'%LOGILLEGAL%'", $_POST['log_illegal'], $text);
		//$text = preg_replace("'%MINUSERLENGTH%'", $_POST['userlength'], $text);
		//$text = preg_replace("'%MINPASSLENGTH%'", $_POST['passlength'], $text);
		//$text = preg_replace("'%SPECIALCHARS%'", $_POST['specialchars'], $text);
		$text = preg_replace("'%ACTIVATE%'", $_POST['activate'], $text);
		$text = preg_replace("'%ARANK%'", $_POST['admin_rank'], $text);
		$text = preg_replace("'%QUEST%'", $_POST['quest'], $text);
		$text = preg_replace("'%QTYPE%'", $_POST['qtype'], $text);  
		$text = preg_replace("'%BEGINNER%'", $_POST['beginner'], $text);
		$text = preg_replace("'%STARTTIME%'", time(), $text);
		$text = preg_replace("'%DOMAIN%'", $_POST['domain'], $text);
		$text = preg_replace("'%HOMEPAGE%'", $_POST['homepage'], $text);
		$text = preg_replace("'%SERVER%'", $_POST['server'], $text);
		$text = preg_replace("'%LIMIT_MAILBOX%'", $_POST['limit_mailbox'], $text);
		$text = preg_replace("'%MAX_MAILS%'", $_POST['max_mails'], $text);
		$text = preg_replace("'%DEMOLISH%'", $_POST['demolish'], $text);
		$text = preg_replace("'%BOX1%'", $_POST['box1'], $text);
		$text = preg_replace("'%BOX2%'", $_POST['box2'], $text);
		$text = preg_replace("'%BOX3%'", $_POST['box3'], $text);
		$text = preg_replace("'%VILLAGE_EXPAND%'", $_POST['village_expand'], $text);
		$text = preg_replace("'%ERRORREPORT%'", $_POST['error'], $text);
		$text = preg_replace("'%ERROR%'", $_POST['error'], $text);
		//$text = preg_replace("'%GP_LOCATE%'", $_POST['gp_locate'], $text);
		$text = preg_replace("'%PLUS_TIME%'", $_POST['plus_time'], $text);
		$text = preg_replace("'%PLUS_PRODUCTION%'", $_POST['plus_production'], $text);
		$text = preg_replace("'%PAYPAL_EMAIL%'", $_POST['paypal-email'], $text);
		$text = preg_replace("'%PAYPAL_CURRENCY%'", $_POST['paypal-currency'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_A_GOLD%'", $_POST['plus-a-gold'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_A_PRICE%'", $_POST['plus-a-price'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_B_GOLD%'", $_POST['plus-b-gold'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_B_PRICE%'", $_POST['plus-b-price'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_C_GOLD%'", $_POST['plus-c-gold'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_C_PRICE%'", $_POST['plus-c-price'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_D_GOLD%'", $_POST['plus-d-gold'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_D_PRICE%'", $_POST['plus-d-price'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_E_GOLD%'", $_POST['plus-e-gold'], $text);
		$text = preg_replace("'%PLUS_PACKAGE_E_PRICE%'", $_POST['plus-e-price'], $text);
		$text = preg_replace("'%MEDALINTERVAL%'", $_POST['medalinterval'], $text);
		$text = preg_replace("'%GREAT_WKS%'", $_POST['great_wks'], $text);
		$text = preg_replace("'%TS_THRESHOLD%'", $_POST['ts_threshold'], $text);
		$text = preg_replace("'%WW%'", $_POST['ww'], $text);
		$text = preg_replace("'%SHOW_NATARS%'", $_POST['show_natars'], $text);
		$text = preg_replace("'%NATARS_UNITS%'", $_POST['natars_units'], $text);
		$text = preg_replace("'%NATURE_REGTIME%'", $_POST['nature_regtime'], $text);
		$text = preg_replace("'%T4_COMING%'", $_POST['t4_coming'], $text);
		$text = preg_replace("'%REG_OPEN%'", $_POST['reg_open'], $text);
		$text = preg_replace("'%PEACE%'", $_POST['peace'], $text);

		fwrite($fh, $text);

		if(file_exists("../GameEngine/config.php")) {
			header("Location: index.php?s=2");
		} else {
			header("Location: index.php?s=1&c=1");
		}

		fclose($fh);
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
