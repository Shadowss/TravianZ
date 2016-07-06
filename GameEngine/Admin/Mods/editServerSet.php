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
$id = $_POST['id'];

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
		$text = preg_replace("'%NATURE_REGTIME%'", $_POST['nature_regtime'], $text);
		$text = preg_replace("'%T4_COMING%'", $T4, $text);
		$text = preg_replace("'%ACTIVATE%'", $_POST['activate'], $text);
		$text = preg_replace("'%PLUS_TIME%'", $_POST['plus_time'], $text);
		$text = preg_replace("'%PLUS_PRODUCTION%'", $_POST['plus_production'], $text);
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
		$text = preg_replace("'%SUSER%'", SQL_USER, $text);
		$text = preg_replace("'%SPASS%'", SQL_PASS, $text);
		$text = preg_replace("'%SDB%'", SQL_DB, $text);
		$text = preg_replace("'%PREFIX%'", TB_PREFIX, $text);
		$text = preg_replace("'%CONNECTT%'", DB_TYPE, $text);		
		$text = preg_replace("'%LIMIT_MAILBOX%'", $LIMIT_MAILBOX, $text);
		$text = preg_replace("'%MAX_MAILS%'", MAX_MAIL, $text);
		$text = preg_replace("'%ARANK%'", $INCLUDE_ADMIN, $text);		
		$text = preg_replace("'%AEMAIL%'", ADMIN_EMAIL, $text);
		$text = preg_replace("'%ANAME%'", ADMIN_NAME, $text);
		$text = preg_replace("'%UTRACK%'", "", $text);
		$text = preg_replace("'%UTOUT%'", "", $text);
		$text = preg_replace("'%DOMAIN%'", DOMAIN, $text);
		$text = preg_replace("'%HOMEPAGE%'", HOMEPAGE, $text);
		$text = preg_replace("'%SERVER%'", SERVER, $text);		
	
		fwrite($fh, $text);
		fclose($fh);

$database->query("Insert into ".TB_PREFIX."admin_log values (0,".$id.",'Changed server setting',".time().")");

header("Location: ../../../Admin/admin.php?p=config");

?>
