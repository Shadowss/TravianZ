<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Logging.php                                                 ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Logging {

	public function addIllegal($uid,$ref,$type) {
		global $database;
		list($uid,$ref,$type) = $database->escape_input((int) $uid,$ref,$type);
		if(LOG_ILLEGAL) {
			$log = "Attempted to ";
			switch($type) {
				case 1:
				$log .= "access village $ref";
				break;
			}
			$q = "Insert into ".TB_PREFIX."illegal_log SET user = $uid, log = '$log'";
			$database->query($q);
		}
	}

	public function addLoginLog($id,$ip) {
		global $database;
		list($id,$ip) = $database->escape_input((int) $id,$ip);
		if(LOG_LOGIN) {
			$q = "Insert into ".TB_PREFIX."login_log SET uid = $id, ip = '".$_SERVER['REMOTE_ADDR']."'";
			$database->query($q);
		}
	}

	public function addBuildLog($wid,$building,$level,$type) {
		global $database;
		list($wid,$building,$level,$type) = $database->escape_input((int) $wid,$building,$level,$type);
		if(LOG_BUILD) {
			if($type) {
				$log = "Start Construction of ";
			}
			else {
				$log = "Start Upgrade of ";
			}
			$log .= $building." to level ".$level;
			$q = "Insert into ".TB_PREFIX."build_log SET wid = $wid, log = '$log'";
			$database->query($q);
		}
	}

	public function addTechLog($wid,$tech,$level) {
		global $database;
		list($wid,$tech,$level) = $database->escape_input((int) $wid,$tech,$level);
		if(LOG_TECH) {
			$log = "Upgrading of tech ".$tech." to level ".$level;
			$q = "Insert into ".TB_PREFIX."tech_log SET wid = $wid, log = '$log'";
			$database->query($q);
		}
	}

	public function goldFinLog($wid) {
		global $database;
		list($wid) = $database->escape_input((int) $wid);
		if(LOG_GOLD_FIN) {
			$log = "Finish construction and research with gold";
			$q = "Insert into ".TB_PREFIX."gold_fin_log values (0,$wid,'$log')";
			$database->query($q);
		}
	}

	public function addAdminLog() {
		global $database;
	}

	public function addMarketLog($wid,$type,$data) {
		global $database;
		list($wid,$type,$data) = $database->escape_input((int) $wid,$type,$data);
		if(LOG_MARKET) {
			if($type == 1) {
				$log = "Sent ".$data[0].",".$data[1].",".$data[2].",".$data[3]." to village ".$data[4];
			}
			else if($type == 2) {
				$log = "Traded resource between ".$wid." and ".$data[0]." market ref is ".$data[1];
			}
			$q = "Insert into ".TB_PREFIX."market_log SET wid = $wid, log = '$log'";
			$database->query($q);
		}
	}

	public function addWarLog() {
		global $database;
	}

	public function clearLogs() {
		global $database;
	}

	public static function debug($debug_info, $time = 0) {
		global $database, $generator;
		list($debug_info) = $database->escape_input($debug_info);
		
		echo '<script>console.log('.json_encode(($time > 0 ? "[".$generator->procMtime($time)[1]."] " : "").$debug_info).')</script>';
	}
};

$logging = new Logging;
?>
