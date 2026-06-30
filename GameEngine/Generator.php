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

			if ($tSquareLevel > 0 && $distance >= TS_THRESHOLD && $speed > 0) {
				// Tournament Square only speeds up the part of the journey
				// beyond the threshold: the first TS_THRESHOLD tiles are walked
				// at base speed and the remainder at the boosted speed.
				// Multiplying the whole distance made far targets arrive sooner
				// than near ones (issue #304).
				$boostedSpeed = $speed * ($bid14[$tSquareLevel]['attri'] / 100);
				$time = (TS_THRESHOLD / $speed) + (($distance - TS_THRESHOLD) / $boostedSpeed);

				return round($time * 3600 / INCREASE_SPEED);
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
     $time = (int) $time;
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
	 * Resolve a player's "timezone" preference (issue #198) to a DateTimeZone.
	 *
	 * The preference form exposes two kinds of values:
	 *   - 8 named, DST-aware regions (Europe, UK, Turkey, Kolkata, Bangkok,
	 *     New York, Chicago, New Zealand) stored as their legacy magic ids;
	 *   - fixed UTC offsets (general zones): 0..11 => UTC+1..UTC+12,
	 *     12..22 => UTC-11..UTC-1, 23 => UTC.
	 * Falls back to the server's default timezone when the value is unknown.
	 *
	 * @param int|null $tz Stored timezone preference value (null = server time).
	 * @return DateTimeZone
	 */
	private function resolveUserTimeZone($tz)
	{
		if ($tz === null) {
			return new DateTimeZone(date_default_timezone_get());
		}

		$tz = (int) $tz;

		$named = [
			495 => 'Europe/Berlin',
			99  => 'Europe/London',
			492 => 'Europe/Istanbul',
			328 => 'Asia/Kolkata',
			345 => 'Asia/Bangkok',
			257 => 'America/New_York',
			189 => 'America/Chicago',
			474 => 'Pacific/Auckland',
		];

		try {
			if (isset($named[$tz])) {
				return new DateTimeZone($named[$tz]);
			}

			if ($tz === 23) {
				$offset = 0;
			} elseif ($tz >= 0 && $tz <= 11) {
				$offset = $tz + 1;
			} elseif ($tz >= 12 && $tz <= 22) {
				$offset = $tz - 23;
			} else {
				$offset = 0;
			}

			$sign = $offset >= 0 ? '+' : '-';
			return new DateTimeZone(sprintf('%s%02d:00', $sign, abs($offset)));
		} catch (\Exception $e) {
			return new DateTimeZone(date_default_timezone_get());
		}
	}

	/**
	 * Format an absolute timestamp into a readable date/time, honouring the
	 * current player's time preference (issue #198): timezone conversion +
	 * date layout / 12h-24h clock derived from the "tformat" setting.
	 *
	 *   tformat 0 => EU  dd.mm.yy  24h   (legacy default, unchanged)
	 *   tformat 1 => US  mm/dd/yy  12h
	 *   tformat 2 => UK  dd/mm/yy  12h
	 *   tformat 3 => ISO yy/mm/dd  24h
	 *
	 * When no player session is available (e.g. admin / pre-login) it falls
	 * back to the server timezone and the EU layout, i.e. the previous output.
	 * The "today"/"yesterday" sentinels are kept verbatim (callers compare them).
	 *
	 * @param int $time Unix timestamp.
	 * @param int $pref Pass 9 to get the time-of-day string only.
	 * @return array|string [$day, $time] normally, or the time string when $pref == 9.
	 */
	public function procMtime($time, $pref = 3)
	{
		global $session;

		$time = (int) $time;

		$tzPref = (isset($session) && isset($session->userinfo['timezone']))
			? $session->userinfo['timezone'] : null;
		$tformat = (isset($session) && isset($session->userinfo['tformat']))
			? (int) $session->userinfo['tformat'] : 0;

		$zone = $this->resolveUserTimeZone($tzPref);

		$dt = new DateTime('@' . $time);
		$dt->setTimezone($zone);
		$now = new DateTime('now', $zone);

		// date layout + clock (12h/24h) per the tformat preference
		switch ($tformat) {
			case 1:  $dateFmt = "m/d/y"; $timeFmt = "h:i:s A"; break;
			case 2:  $dateFmt = "d/m/y"; $timeFmt = "h:i:s A"; break;
			case 3:  $dateFmt = "y/m/d"; $timeFmt = "H:i:s";   break;
			default: $dateFmt = "j.m.y"; $timeFmt = "H:i:s";   break; // legacy EU output, unchanged
		}

		// Time-only mode (9) feeds the live JS clock counters (unx.js ob()/rb()),
		// which parse "H:i:s" by splitting on ":" — keep 24h here regardless of
		// the 12h/24h tformat, while still honouring the timezone conversion.
		if ($pref == 9) {
			return $dt->format("H:i:s");
		}

		$new = $dt->format($timeFmt);

		$yesterday = (clone $now)->modify('-1 day');

		if ($dt->format('Ymd') == $now->format('Ymd')) {
			$day = "today";
		} elseif ($dt->format('Ymd') == $yesterday->format('Ymd')) {
			$day = "yesterday";
		} else {
			$day = $dt->format($dateFmt);
		}

		return [$day, $new];
	}

	/**
	 * Resolve the current player's timezone preference (issue #198), shared by
	 * the "local time" header clock helpers below.
	 */
	private function currentPlayerZone()
	{
		global $session;

		$tzPref = (isset($session) && isset($session->userinfo['timezone']))
			? $session->userinfo['timezone'] : null;

		return $this->resolveUserTimeZone($tzPref);
	}

	/**
	 * Current UTC offset (in seconds, DST-aware) of the player's timezone.
	 * Feeds the live "local time" clock in the page header (issue #198).
	 *
	 * @return int
	 */
	public function userTimeZoneOffset()
	{
		return (new DateTime('now', $this->currentPlayerZone()))->getOffset();
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