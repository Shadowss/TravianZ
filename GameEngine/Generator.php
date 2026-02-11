<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Generator.php                                               ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

class MyGenerator
{
    /* ===============================
       RANDOM GENERATORS
    =============================== */

    public function generateRandID()
    {
        return md5($this->generateRandStr(16));
    }

    public function generateRandStr($length)
    {
        $length = (int)$length;
        if ($length <= 0) return '';

        // Hard cap to prevent abuse
        if ($length > 256) $length = 256;

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

    public function encodeStr($str, $length)
    {
        $length = (int)$length;
        if ($length <= 0) return '';

        $hash = md5((string)$str);

        if ($length > 32) $length = 32;

        return substr($hash, 0, $length);
    }

    /* ===============================
       DISTANCE / TIME CALCULATIONS
    =============================== */

    public function procDistanceTime($coor, $thiscoor, $ref, $mode, $vid = 0)
    {
        global $database, $bid28, $bid14, $village;

        if ($vid == 0 && isset($village->wid)) {
            $vid = (int)$village->wid;
        }

        $x1 = (int)$thiscoor['x'];
        $y1 = (int)$thiscoor['y'];
        $x2 = (int)$coor['x'];
        $y2 = (int)$coor['y'];

        $xdistance = abs($x1 - $x2);
        if ($xdistance > WORLD_MAX) {
            $xdistance = (2 * WORLD_MAX + 1) - $xdistance;
        }

        $ydistance = abs($y1 - $y2);
        if ($ydistance > WORLD_MAX) {
            $ydistance = (2 * WORLD_MAX + 1) - $ydistance;
        }

        $distance = sqrt(pow($xdistance, 2) + pow($ydistance, 2));

        if (!$mode) {
            switch ((int)$ref) {
                case 1:   $speed = 16; break;
                case 2:   $speed = 12; break;
                case 3:   $speed = 24; break;
                case 300: $speed = 5;  break;
                default:  $speed = 1;  break;
            }
        } else {
            $speed = (float)$ref;

            if ($speed > 0) {
                $tSquareLevel = (int)$database->getFieldLevelInVillage($vid, 14);

                if ($tSquareLevel > 0 && $distance >= TS_THRESHOLD) {
                    if (isset($bid14[$tSquareLevel]['attri'])) {
                        $speed *= ($bid14[$tSquareLevel]['attri'] / 100);
                    }
                }
            }
        }

        if ($speed <= 0) {
            return round($distance * 3600 / INCREASE_SPEED);
        }

        return round(($distance / $speed) * 3600 / INCREASE_SPEED);
    }

    /* ===============================
       TIME FORMATTING
    =============================== */

    public function getTimeFormat($time)
    {
        $time = (int)$time;
        if ($time < 0) $time = 0;

        $hr = floor($time / 3600);
        $min = floor(($time % 3600) / 60);
        $sec = $time % 60;

        return sprintf("%d:%02d:%02d", $hr, $min, $sec);
    }

    public function procMtime($time, $pref = 3)
    {
        $time = (int)$time;
        $pref = (int)$pref;

        $today = date('Ymd');
        $target = date('Ymd', $time);

        if ($today === $target) {
            $day = "today";
        } elseif (date('Ymd', strtotime("-1 day")) === $target) {
            $day = "yesterday";
        } else {
            switch ($pref) {
                case 1: $day = date("m/j/y", $time); break;
                case 2: $day = date("j/m/y", $time); break;
                case 3: $day = date("j.m.y", $time); break;
                default:$day = date("y/m/j", $time); break;
            }
        }

        $clock = date("H:i:s", $time);

        if ($pref === 9) {
            return $clock;
        }

        return [$day, $clock];
    }

    /* ===============================
       MAP HELPERS
    =============================== */

    public function getBaseID($x, $y)
    {
        $x = (int)$x;
        $y = (int)$y;

        return ((WORLD_MAX - $y) * (WORLD_MAX * 2 + 1)) + (WORLD_MAX + $x + 1);
    }

    public function getMapCheck($wref)
    {
        $wref = (int)$wref;
        return substr(md5((string)$wref), 5, 2);
    }

    /* ===============================
       PAGE LOAD TIMERS
    =============================== */

    public function pageLoadTimeStart()
    {
        if (isset($_SERVER["REQUEST_TIME_FLOAT"])) {
            return (float)$_SERVER["REQUEST_TIME_FLOAT"];
        }

        return microtime(true);
    }

    public function pageLoadTimeEnd()
    {
        return microtime(true);
    }
}

$generator = new MyGenerator();
