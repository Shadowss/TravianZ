<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Logging.php                      	                       ##
##  Type           : Logging System Backend                                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

class Logging {

	public function addIllegal($uid, $ref, $type) {
		global $database;

		list($uid, $ref, $type) = $database->escape_input((int)$uid, $ref, $type);

		if (LOG_ILLEGAL) {
			$log = "Attempted to ";

			switch ($type) {
				case 1:
					$log .= "access village $ref";
					break;
				default:
					$log .= "perform illegal action";
					break;
			}

			list($log) = $database->escape_input($log);

			$q = "Insert into " . TB_PREFIX . "illegal_log SET user = $uid, log = '$log'";
			$database->query($q);
		}
	}

	public function addLoginLog($id, $ip) {
		global $database;

		list($id, $ip) = $database->escape_input((int)$id, $ip);

		if (LOG_LOGIN) {

			if (empty($ip)) {
				// proxy-aware (issue #185): real client IP behind a trusted reverse proxy
				$ip = \App\Utils\IpResolver::getClientIp() ?? ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
			}

			list($ip) = $database->escape_input($ip);

			$q = "Insert into " . TB_PREFIX . "login_log SET uid = $id, ip = '$ip'";
			$database->query($q);
		}
	}

	public function addBuildLog($wid, $building, $level, $type) {
		global $database;

		list($wid, $building, $level, $type) = $database->escape_input((int)$wid, $building, $level, $type);

		if (LOG_BUILD) {

			if ($type) {
				$log = "Start Construction of ";
			} else {
				$log = "Start Upgrade of ";
			}

			$log .= $building . " to level " . $level;

			list($log) = $database->escape_input($log);

			$q = "Insert into " . TB_PREFIX . "build_log SET wid = $wid, log = '$log'";
			$database->query($q);
		}
	}

	public function addTechLog($wid, $tech, $level) {
		global $database;

		list($wid, $tech, $level) = $database->escape_input((int)$wid, $tech, $level);

		if (LOG_TECH) {

			$log = "Upgrading of tech " . $tech . " to level " . $level;
			list($log) = $database->escape_input($log);

			$q = "Insert into " . TB_PREFIX . "tech_log SET wid = $wid, log = '$log'";
			$database->query($q);
		}
	}

	public function goldFinLog($wid) {
		global $database;

		list($wid) = $database->escape_input((int)$wid);

		if (LOG_GOLD_FIN) {

			$log = "Finish construction and research with gold";
			list($log) = $database->escape_input($log);

			$q = "INSERT INTO " . TB_PREFIX . "gold_fin_log (wid, action, time, details) VALUES ($wid, 'Finish all constructions', " . time() . ", '$log')";
			$database->query($q);
		}
	}

	public function addAdminLog() {
		global $database;
		// reserved
	}

	public function addMarketLog($wid, $type, $data) {
		global $database;

		list($wid, $type, $data) = $database->escape_input((int)$wid, $type, $data);

		if (LOG_MARKET) {

			if ($type == 1) {
				$log = "Sent " . $data[0] . "," . $data[1] . "," . $data[2] . "," . $data[3] . " to village " . $data[4];
			} else if ($type == 2) {
				$log = "Traded resource between " . $wid . " and " . $data[0] . " market ref is " . $data[1];
			} else {
				$log = "Unknown market action";
			}

			list($log) = $database->escape_input($log);

			$q = "Insert into " . TB_PREFIX . "market_log SET wid = $wid, log = '$log'";
			$database->query($q);
		}
	}

	public function addWarLog() {
		global $database;
		// reserved
	}

	public function clearLogs() {
		global $database;
		// reserved
	}

	public static function debug($debug_info, $time = 0) {
		global $database, $generator;

		list($debug_info) = $database->escape_input($debug_info);

		$prefix = "";

		if ($time > 0 && isset($generator)) {
			$mtime = $generator->procMtime($time);
			$prefix = "[" . ($mtime[1] ?? '') . "] ";
		}

		echo '<script>console.log(' . json_encode($prefix . $debug_info) . ')</script>';
	}
}

$logging = new Logging();
?>