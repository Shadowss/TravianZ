<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Author: iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Factory;

use TravianZ\Entity\Research;
use TravianZ\Entity\Unit;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Database\IDbConnection;

/**
 * @author iopietro
 */
abstract class ResearchesFactory
{
    /**
     * Instantiate a Research class
     * 
     * @param int $tribe The Unit tribe
     * @param int $unit The Unit ID
     * @param int $amount The unit amount
     * @param IDbConnection $db The database
     * @return Unit Returns an istance of the Research
     */
    public static function create(IDbConnection $db, int $tribe, int $unit, int $researchValue): Research
    {
        switch ($tribe) {
            default:
            case 1:
                return self::getRomansResearch($db, UnitsFactory::create($tribe, $unit, 1), $unit, $researchValue);
            case 2:
                return self::getGaulsResearch($db, UnitsFactory::create($tribe, $unit, 1), $unit, $researchValue);
            case 3:
                return self::getTeutonsResearch($db, UnitsFactory::create($tribe, $unit, 1), $unit, $researchValue);           
            case 4:
                return self::getNatureResearch($db, UnitsFactory::create($tribe, $unit, 1), $unit, $researchValue);
            case 5:
                return self::getNatarsResearch($db, UnitsFactory::create($tribe, $unit, 1), $unit, $researchValue);
        }
    }
    
    /**
     * Get a Roman research
     * 
     * @param Unit $unit The unit
     * @param int $type The unit type
     * @param int $researchValue The Research value
     * @return Research Returns the instanced object
     */
    private static function getRomansResearch(IDbConnection $db, Unit $unit, int $type, int $researchValue): Research
    {
        switch ($type) {
            case 2:
                return new Research($db, $unit, 7080, [700, 620, 1480, 580], [BuildingEnums::ACADEMY => 1, BuildingEnums::ARMOURY => 1], $researchValue);
            case 3:
                return new Research($db, $unit, 7560, [1000, 740, 1880, 640], [BuildingEnums::ACADEMY => 5, BuildingEnums::ARMOURY => 1], $researchValue);
            case 4:
                return new Research($db, $unit, 5880, [940, 740, 360, 400], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 1], $researchValue);
            case 5:
                return new Research($db, $unit, 9720, [3400, 1860, 2760, 760], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 5], $researchValue);
            case 6:
                return new Research($db, $unit, 12360, [3400, 2660, 6600, 1240], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 10], $researchValue);
            case 7:
                return new Research($db, $unit, 15600, [5500, 1540, 4200, 580], [BuildingEnums::ACADEMY => 10, BuildingEnums::WORKSHOP => 1], $researchValue);
            case 8:
                return new Research($db, $unit, 28800, [5800, 5500, 5000, 700], [BuildingEnums::ACADEMY => 15, BuildingEnums::WORKSHOP => 10], $researchValue);
            case 9:
                return new Research($db, $unit, 24475, [15880, 13800, 36400, 22660], [BuildingEnums::ACADEMY => 20, BuildingEnums::RALLY_POINT => 10], $researchValue);
        }
    }
    
    /**
     * Get a Teutonic research
     * 
     * @param Unit $unit The unit
     * @param int $type The unit type
     * @param int $researchValue The Unit amount
     * @return Unit Returns the instanced object
     */
    private static function getTeutonsResearch(IDbConnection $db, Unit $unit, int $type, int $researchValue): Research
    {
        switch ($type) {
            case 2:
                return new Research($db, $unit, 5160, [970, 380, 880, 400], [BuildingEnums::ACADEMY => 1, BuildingEnums::BARRACKS => 3], $researchValue);
            case 3:
                return new Research($db, $unit, 5400, [880, 580, 1560, 580], [BuildingEnums::ACADEMY => 3, BuildingEnums::BLACKSMITH => 1], $researchValue);
            case 4:
                return new Research($db, $unit, 5160, [1060, 500, 600, 460], [BuildingEnums::ACADEMY => 1, BuildingEnums::MAIN_BUILDING => 5], $researchValue);
            case 5:
                return new Research($db, $unit, 9000, [2320, 1180, 2520, 610], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 3], $researchValue);
            case 6:
                return new Research($db, $unit, 10680, [2800, 2160, 4040, 640], [BuildingEnums::ACADEMY => 15, BuildingEnums::STABLE => 10], $researchValue);
            case 7:
                return new Research($db, $unit, 14400, [6100, 1300, 3000, 580], [BuildingEnums::ACADEMY => 10, BuildingEnums::WORKSHOP => 1], $researchValue);
            case 8:
                return new Research($db, $unit, 28800, [5500, 4900, 5000, 520], [BuildingEnums::ACADEMY => 15, BuildingEnums::WORKSHOP => 10], $researchValue);
            case 9:
                return new Research($db, $unit, 19425, [18250, 13500, 20400, 16480], [BuildingEnums::ACADEMY => 20, BuildingEnums::RALLY_POINT => 5], $researchValue);
        }
    }
    
    /**
     * Get a Gallic research
     *
     * @param Unit $unit The unit
     * @param int $type The unit type
     * @param int $researchValue The Unit amount
     * @return Research Returns the instanced object
     */
    private static function getGaulsResearch(IDbConnection $db, Unit $unit, int $type, int $researchValue): Research
    {
        switch ($type) {
            case 2:
                return new Research($db, $unit, 6120, [940, 700, 1680, 520], [BuildingEnums::ACADEMY => 3, BuildingEnums::BLACKSMITH => 1], $researchValue);
            case 3:
                return new Research($db, $unit, 5880, [1120, 700, 360, 400], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 1], $researchValue);
            case 4:
                return new Research($db, $unit, 9240, [2200, 1900, 2040, 520], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 3], $researchValue);
            case 5:
                return new Research($db, $unit, 9480, [2260, 1420, 2440, 880], [BuildingEnums::ACADEMY => 5, BuildingEnums::STABLE => 5], $researchValue);
            case 6:
                return new Research($db, $unit, 11160, [3100, 2580, 5600, 1180], [BuildingEnums::ACADEMY => 15, BuildingEnums::STABLE => 10], $researchValue);
            case 7:
                return new Research($db, $unit, 16800, [5800, 2320, 2840, 610], [BuildingEnums::ACADEMY => 10, BuildingEnums::WORKSHOP => 1], $researchValue);
            case 8:
                return new Research($db, $unit, 28800, [5860, 5900, 5240, 700], [BuildingEnums::ACADEMY => 15, BuildingEnums::WORKSHOP => 10], $researchValue);
            case 9:
                return new Research($db, $unit, 24475, [15880, 22900, 25200, 22660], [BuildingEnums::ACADEMY => 20, BuildingEnums::RALLY_POINT => 10], $researchValue);
        }
    }
    
    /**
     * Get a Nature unit
     *
     * @param Unit $unit The unit
     * @param int $type The unit type
     * @param int $researchValue The Unit amount
     * @return Research Returns the instanced object
     */
    private static function getNatureResearch(IDbConnection $db, Unit $unit, int $type, int $researchValue): Research
    {
        switch ($type) {
            case 2:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 3:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 4:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 5:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 6:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 7:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 8:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 9:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
        }
    }
    
    /**
     * Get a Nataren research
     *
     * @param Unit $unit The unit
     * @param int $type The unit type
     * @param int $researchValue The Unit amount
     * @return Research Returns the instanced object
     */
    private static function getNatarsResearch(IDbConnection $db, Unit $unit, int $type, int $researchValue): Research
    {
        switch ($type) {
            case 2:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 3:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 4:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 5:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 6:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 7:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 8:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
            case 9:
                return new Research($db, $unit, 0, [0, 0, 0, 0], [], $researchValue);
        }
    }
}