<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Utils;

use TravianZ\Entity\WorldCell;
use TravianZ\Entity\Village;
use TravianZ\Enums\TribeEnums;
use TravianZ\Data\Buildings\TournamentSquare;

class Generator
{
    /**
     * 
     * @return string
     */
    public static function generateRandID(): string
    {
        return md5(self::generateRandStr(16));
    }

    /**
     * 
     * @param int $length
     * @return string
     */
    public static function generateRandStr(int $length): string
    {
        $randstr = '';
        for ($i = 0; $i < $length; $i ++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

    /**
     * 
     * @param string $str
     * @param int $length
     * @return string
     */
    public static function encodeStr(string $str, int $length): string
    {
        return substr(md5($str), 0, $length);
    }
    
    /**
     * Get the travel time of units/merchants between two villages
     * 
     * @param WorldCell $from The sender Village
     * @param WorldCell $to The target village
     * @param int $speed The units speed, 0 if merchants
     * @param array $units If empty, calculate the merchants travel time, units travel time otherwise
     * @return int Returns the required travel time
     */
    public static function getWalkingUnitsTime(WorldCell $from, WorldCell $to, array $units = []) {
        // Initialization
        $distance = [];
        $speed = 0;
        
        // Calculate the X distance
        $distance['x'] = abs($from->coordinates['x'] - $to->coordinates['x']);
        if ($distance['x'] > WORLD_MAX) {
            $distance['x'] = (2 * WORLD_MAX + 1) - $distance['x'];
        }
        
        // Calculate the Y distance
        $distance['y'] = abs($from->coordinates['y'] - $to->coordinates['y']);
        if ($distance['y'] > WORLD_MAX) {
            $distance['y'] = (2 * WORLD_MAX + 1) - $distance['y'];
        }
        
        // Calculate the distance between the two cells
        $distance = sqrt($distance['x'] ** 2 + $distance['y'] ** 2);
        
        // Check if they're units or merchants
        if (empty($units)) {
            if ($from->owner->tribe == TribeEnums::ROMANS) {
                $speed = 16;
            } elseif ($from->owner->tribe == TribeEnums::TEUTONS) {
                $speed = 12;
            } elseif ($from->owner->tribe == TribeEnums::GAULS) {
                $speed = 24;
            } else {
                $speed = 1;
            }
        } else {            
            // Search the slowest unit
            foreach ($units as $unit) {
                if (
                    $unit->amount > 0 &&
                    ($unit->speed < $speed ||
                     $speed == 0)
                ) {
                    $speed = $unit->speed;
                }
            }
            
            // Search the tournament square
            if ($distance >= TS_THRESHOLD) {
                foreach ($from->getBuildings() as $building) {
                    // Check if the the building is a tournament square and it's level 1 or more
                    if (
                        $building->level > 0 &&
                        $building instanceof TournamentSquare
                    ) {
                        $speed *= $building->getBonus() / 100;
                        break;
                    }
                }
            }
        }
        
        // Calculate the required time and return it
        return round(($distance / ($speed > 0 ? $speed : 1)) * 3600 / INCREASE_SPEED);      
    }

    /**
     *  Get the distance between two villages
     * 
     * @param array $firstCoordinates
     * @param array $secondCoordinates
     * @return float
     */
    public function getDistance(array $firstCoordinates, array $secondCoordinates): float
    {
        $max = 2 * WORLD_MAX + 1;

        $distanceX = min(abs($secondCoordinates['x'] - $firstCoordinates['x']), abs($max - abs($secondCoordinates['x'] - $firstCoordinates['x'])));
        $distanceY = min(abs($secondCoordinates['y'] - $firstCoordinates['x']), abs($max - abs($secondCoordinates['y'] - $firstCoordinates['y'])));

        return round(sqrt($distanceX ** 2 + $distanceY ** 2), 1);
    }
    
    /**
     * 
     * @param int $time
     * @return string
     */
    public static function getTimeFormat(int $time): string
    {
        $min = $hr = $days = 0;
        
        while ($time >= 60) {
            $time -= 60;
            $min += 1;
        }
        
        while ($min >= 60) {
            $min -= 60;
            $hr += 1;
        }
        
        if ($min < 10) {
            $min = 0 . $min;
        }
            
        if ($time < 10) {
            $time = 0 . $time;
        }
      
        return $hr . ':' . $min . ':' . $time;
    }

    /**
     * 
     * @param int $time
     * @param int $pref
     * @return string|string[]
     */
    public static function procMtime(int $time, int $pref = 3)
    {       
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
        if ($pref == "9" || $pref == 9) {
            return $new;
        } else {
            return [
                $day,
                $new
            ];
        }
    }

    /**
     * Get a village ID through its coordinates
     *
     * @param int $x The x coordinate
     * @param int $y The y coordinate
     * @return int Return the village ID
     */
    public static function getBaseID(int $x, int $y): int
    {
        return ((WORLD_MAX - $y) * (WORLD_MAX * 2 + 1)) + (WORLD_MAX + $x + 1);
    }

    /**
     * Check a map cell number
     * 
     * @param int $wref
     * @return string
     */
    public static function getMapCheck(int $wref): string
    {
        return substr(md5($wref), 5, 2);
    }
    
    /**
     * 
     * @param array $actualResources
     * @param array $requiredResources
     * @param array $production
     * @return string|string[]
     */
    public static function getNeededResourcesTime(array $actualResources, array $requiredResources, array $production)
    {
        // Initialize
        $neededResources = [];
       
        // Get the needed resources
        foreach ($actualResources as $key => $actualResource) {
            $neededResources[$key] = $requiredResources[$key] - $actualResource;
        }

        return self::procMtime(round(max(
            $neededResources['wood'] / $production['wood'] * 3600,
            $neededResources['clay'] / $production['clay'] * 3600,
            $neededResources['iron'] / $production['iron'] * 3600,
            $neededResources['crop'] / $production['crop'] * 3600
        ) + time()));
    }
}
