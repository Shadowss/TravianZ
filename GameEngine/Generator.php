<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:        TravianZ                                                   ##
##  Version:        18.05.2026                                                 ##
##  Filename:       Generator.php                                              ##
##  Developed by:   Dzoki		                                               ##
##  Refactored by:  Shadow (cata7007@gmail.com)								   ##
##  License:        TravianZ Project                                           ##
##  Copyright:      TravianZ (c) 2010-2026. All rights reserved.               ##
##                                                                             ##
##   * Rules applied:														   ##
##  - No logic changes														   ##
##  - No functional behavior changes										   ##
##  - Improved readability & structure										   ##
##  - Removed obvious redundancy											   ##
##  - PHP 7+ / legacy compatible											   ##
##                                                                             ##
##  URLs:           https://travianz.org                                       ##
##                  https://github.com/Shadowss/TravianZ                       ##
##                                                                             ##
#################################################################################

class MyGenerator
{
	/**
	 * Generate hashed random ID
	 */
	public function generateRandID()
	{
		return md5($this->generateRandStr(16));
	}

	/**
	 * Generate random string using secure random_int
	 */
	public function generateRandStr($length)
	{
		$randstr = '';

		for ($i = 0; $i < $length; $i++) {
			$randnum = random_int(0, 61);

			if ($randnum < 10) {
				$randstr .= chr($randnum + 48);
			} elseif ($randnum < 36) {
				$randstr .= chr($randnum + 55);
			} else {
				$randstr .= chr($randnum + 61);
			}
		}

		return $randstr;
	}

	/**
	 * Encode string to fixed-length md5 hash
	 */
	public function encodeStr($str, $length)
	{
		$encode = md5($str);
		return substr($encode, 0, $length);
	}

	/**
	 * Calculate travel/distance time between coordinates
	 */
	public function procDistanceTime($coor, $thiscoor, $ref, $mode, $vid = 0)
	{
		global $database, $bid28, $bid14, $village;

		if ($vid == 0) {
			$vid = $village->wid;
		}

		$xdistance = abs($thiscoor['x'] - $coor['x']);
		if ($xdistance > WORLD_MAX) {
			$xdistance = (2 * WORLD_MAX + 1) - $xdistance;
		}

		$ydistance = abs($thiscoor['y'] - $coor['y']);
		if ($ydistance > WORLD_MAX) {
			$ydistance = (2 * WORLD_MAX + 1) - $ydistance;
		}

		$distance = sqrt(pow($xdistance, 2) + pow($ydistance, 2));

		if (!$mode) {
			if ($ref == 1) $speed = 16;
			elseif ($ref == 2) $speed = 12;
			elseif ($ref == 3) $speed = 24;
			elseif ($ref == 300) $speed = 5;
			else $speed = 1;
		} else {
			$speed = $ref;

			$tSquareLevel = $database->getFieldLevelInVillage($vid, 14);

			if ($tSquareLevel > 0 && $distance >= TS_THRESHOLD) {
				$speed *= ($bid14[$tSquareLevel]['attri'] / 100);
			}
		}

		if ($speed > 0) {
			return round(($distance / $speed) * 3600 / INCREASE_SPEED);
		}

		return round($distance * 3600 / INCREASE_SPEED);
	}

	/**
	 * Format seconds into H:i:s
	 */
	public function getTimeFormat($time)
	{
		$min = 0;
		$hr = 0;

		while ($time >= 60) {
			$time -= 60;
			$min++;
		}

		while ($min >= 60) {
			$min -= 60;
			$hr++;
		}

		if ($min < 10) $min = "0" . $min;
		if ($time < 10) $time = "0" . $time;

		return $hr . ":" . $min . ":" . $time;
	}

	/**
	 * Format timestamp into readable date/time
	 */
	public function procMtime($time, $pref = 3)
	{
		$time += 0; // placeholder for timezone adjustments

		$today = date('d', time()) - 1;

		if (date('Ymd', time()) == date('Ymd', $time)) {
			$day = "today";
		} elseif ($today == date('d', $time)) {
			$day = "yesterday";
		} else {
			switch ($pref) {
				case 1:
					$day = date("m/j/y", $time);
					break;
				case 2:
					$day = date("j/m/y", $time);
					break;
				case 3:
					$day = date("j.m.y", $time);
					break;
				default:
					$day = date("y/m/j", $time);
					break;
			}
		}

		$new = date("H:i:s", $time);

		if ($pref == 9) {
			return $new;
		}

		return [$day, $new];
	}

	/**
	 * Convert map coordinates to base ID
	 */
	public function getBaseID($x, $y)
	{
		return ((WORLD_MAX - $y) * (WORLD_MAX * 2 + 1)) + (WORLD_MAX + $x + 1);
	}

	/**
	 * Generate map checksum
	 */
	public function getMapCheck($wref)
	{
		return substr(md5($wref), 5, 2);
	}

	/**
	 * Page load start time
	 */
	public function pageLoadTimeStart() {
		
    return $_SERVER["REQUEST_TIME_FLOAT"]?? microtime(true);
	
	}

	/**
	 * Page load end time
	 */
	public function pageLoadTimeEnd() {
		
    return microtime(true);
	
	}
}

$generator = new MyGenerator();