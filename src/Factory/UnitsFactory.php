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

use TravianZ\Entity\Unit;
use TravianZ\Data\Units\Hero;
use TravianZ\Enums\UnitEnums;

/**
 * @author iopietro
 */
abstract class UnitsFactory
{
    /**
     * Create a Unit class
     * 
     * @param int $tribe The Unit tribe
     * @param int $unit The Unit
     * @param int $amount The unit amount
     * @return Unit Returns an istance of the Unit
     */
    public static function create(int $tribe, int $unit, int $amount): Unit
    {
        switch ($tribe) {
            default:
            case 1:
                return self::getRomansUnit($unit, $amount);
            case 2:
                return self::getTeutonsUnit($unit, $amount);
            case 3:
                return self::getGaulsUnit($unit, $amount);           
            case 4:
                return self::getNatureUnit($unit, $amount);
            case 5:
                return self::getNatarsUnit($unit, $amount);
        }
    }
    
    /**
     * Create an Hero class
     * 
     * @param string $name The Hero name
     * @param Unit $unit The Hero Unit type
     * @param int $id The Hero ID
     * @param int $owner The Hero owner
     * @param int $level The hero level
     * @param int $health The hero health
     * @param int $regenerationPoints The hero regeneration points
     * @param int $attackingPoints The hero attacking points
     * @param int $defensivePoints The hero defensive points
     * @param int $attackingBonusPoints The attacking bonus points
     * @param int $defensiveBonusPoints The defensive bonus points
     * @return Hero Returns an instance of the Hero
     */
    public static function createHero(
        string $name,
        Unit $unit,
        int $id,
        int $owner,
        int $level,
        float $health,
        int $regenerationPoints,
        int $attackingPoints,
        int $defensivePoints,
        int $attackingBonusPoints,
        int $defensiveBonusPoints
    ): Hero {
        return new Hero(
            $name,
            $unit,
            $id,
            $owner,
            $level,
            $health,
            $regenerationPoints, 
            $attackingPoints,
            $defensivePoints, 
            $attackingBonusPoints,
            $defensiveBonusPoints,
            0,
            [0, 0, 0, 0]
        );
    }
    
    /**
     * Get a Roman unit
     * 
     * @param int $unit The unit ID
     * @param int $amount The Unit amount
     * @return Unit Returns the instanced object
     */
    private static function getRomansUnit(int $unit, int $amount): Unit
    {
        switch ($unit)
        {
            case 1:
                return new Unit(U1, 40, 35, 50, 6, 50, 1, 2000, [120, 100, 150, 30], [UnitEnums::INFANTRY], $amount);
            case 2:
                return new Unit(U2, 30, 65, 35, 5, 20, 1, 2200, [100, 130, 160, 70], [UnitEnums::INFANTRY], $amount);
            case 3:
                return new Unit(U3, 70, 40, 25, 7, 50, 1, 2400, [150, 160, 210, 80], [UnitEnums::INFANTRY], $amount);
            case 4:
                return new Unit(U4, 0, 20, 10, 16, 0, 2, 1700, [140, 160, 20, 40], [UnitEnums::CAVALRY, UnitEnums::SCOUT], $amount);
            case 5:
                return new Unit(U5, 120, 65, 50, 14, 100, 3, 3300, [550, 440, 320, 100], [UnitEnums::CAVALRY], $amount);
            case 6:
                return new Unit(U6, 180, 80, 105, 10, 70, 4, 4400, [550, 640, 800, 180], [UnitEnums::CAVALRY], $amount);
            case 7:
                return new Unit(U7, 60, 30, 75, 4, 0, 3, 4600, [900, 360, 500, 70], [UnitEnums::SIEGE, UnitEnums::RAM], $amount);
            case 8:
                return new Unit(U8, 75, 60, 10, 3, 0, 6, 9000, [950, 1350, 600, 90], [UnitEnums::SIEGE, UnitEnums::CATAPULT], $amount);
            case 9:
                return new Unit(U9, 50, 40, 30, 4, 0, 5, 90700, [30750, 27200, 45000, 37500], [UnitEnums::COLONIZERS, UnitEnums::CHIEF], $amount);
            case 10:
                return new Unit(U10, 0, 80, 80, 5, 3000, 1, 26900, [5800, 5300, 7200, 5500], [UnitEnums::COLONIZERS, UnitEnums::SETTLER], $amount);
        }
    }
    
    /**
     * Get a Teutonic unit
     *
     * @param int $unit The unit ID
     * @param int $amount The Unit amount
     * @return Unit Returns the instanced object
     */
    private static function getTeutonsUnit(int $unit, int $amount): Unit
    {
        switch ($unit)
        {
            case 1:
                return new Unit(U11, 40, 20, 5, 7, 60, 1, 900, [95, 75, 40, 40], [UnitEnums::INFANTRY], $amount);
            case 2:
                return new Unit(U12, 10, 35, 60, 7, 40, 1, 1400, [145, 70, 85, 40], [UnitEnums::INFANTRY], $amount);
            case 3:
                return new Unit(U13, 60, 30, 30, 6, 50, 1, 1500, [130, 120, 170, 70], [UnitEnums::INFANTRY], $amount);
            case 4:
                return new Unit(U14, 0, 10, 5, 9, 0, 1, 1400, [160, 100, 50, 50], [UnitEnums::INFANTRY, UnitEnums::SCOUT], $amount);
            case 5:
                return new Unit(U15, 55, 100, 40, 10, 110, 2, 3000, [370, 270, 290, 75], [UnitEnums::CAVALRY], $amount);
            case 6:
                return new Unit(U16, 150, 50, 75, 9, 80, 3, 3700, [450, 515, 480, 80], [UnitEnums::CAVALRY], $amount);
            case 7:
                return new Unit(U17, 65, 30, 80, 4, 0, 3, 4200, [1000, 300, 350, 70], [UnitEnums::SIEGE, UnitEnums::RAM], $amount);
            case 8:
                return new Unit(U18, 50, 60, 10, 3, 0, 6, 9000, [900, 1200, 600, 60], [UnitEnums::SIEGE, UnitEnums::CATAPULT], $amount);
            case 9:
                return new Unit(U19, 40, 60, 40, 4, 0, 4, 70500, [35500, 26600, 25000, 27200], [UnitEnums::COLONIZERS, UnitEnums::CHIEF], $amount);
            case 10:
                return new Unit(U20, 10, 80, 80, 5, 3000, 1, 31000, [7200, 5500, 5800, 6500], [UnitEnums::COLONIZERS, UnitEnums::SETTLER], $amount);
        }
    }
    
    /**
     * Get a Gallic unit
     *
     * @param int $unit The unit ID
     * @param int $amount The Unit amount
     * @return Unit Returns the instanced object
     */
    private static function getGaulsUnit(int $unit, int $amount): Unit
    {
        switch ($unit)
        {
            case 1:
                return new Unit(U21, 15, 40, 50, 7, 35, 1, 1300, [100, 130, 55, 30], [UnitEnums::INFANTRY], $amount);
            case 2:
                return new Unit(U22, 65, 35, 20, 6, 45, 1, 1800, [140, 150, 185, 60], [UnitEnums::INFANTRY], $amount);
            case 3:
                return new Unit(U23, 0, 20, 10, 17, 0, 2, 1700, [170, 150, 20, 40], [UnitEnums::CAVALRY, UnitEnums::SCOUT], $amount);
            case 4:
                return new Unit(U24, 90, 25, 40, 19, 75, 2, 3100, [350, 450, 230, 60], [UnitEnums::CAVALRY], $amount);
            case 5:
                return new Unit(U25, 45, 115, 55, 16, 35, 2, 3200, [360, 330, 280, 120], [UnitEnums::CAVALRY], $amount);
            case 6:
                return new Unit(U26, 140, 50, 165, 13, 65, 3, 3900, [500, 620, 675, 170], [UnitEnums::CAVALRY], $amount);
            case 7:
                return new Unit(U27, 50, 30, 105, 4, 0, 3, 5000, [950, 555, 330, 75], [UnitEnums::SIEGE, UnitEnums::RAM], $amount);
            case 8:
                return new Unit(U28, 70, 45, 10, 3, 0, 6, 9000, [960, 1450, 630, 90], [UnitEnums::SIEGE, UnitEnums::CATAPULT], $amount);
            case 9:
                return new Unit(U29, 40, 50, 50, 5, 0, 4, 90700, [30750, 45400, 31000, 37500], [UnitEnums::COLONIZERS, UnitEnums::CHIEF], $amount);
            case 10:
                return new Unit(U30, 0, 80, 80, 5, 3000, 1, 22700, [5500, 7000, 5300, 4900], [UnitEnums::COLONIZERS, UnitEnums::SETTLER], $amount);
            case 12:
                return new Unit(U99, 0, 0, 0, 0, 0, 0, 600, [35, 30, 10, 20], [UnitEnums::TRAP], $amount);
            case 13:
                return new Unit(U99O, 0, 0, 0, 0, 0, 0, 600, [0, 0, 0, 0], [UnitEnums::OCCUPIED_TRAP], $amount);
        }
    }
    
    /**
     * Get a Nature unit
     *
     * @param int $unit The unit ID
     * @param int $amount The Unit amount
     * @return Unit Returns the instanced object
     */
    private static function getNatureUnit(int $unit, int $amount): Unit
    {
        switch ($unit) {
            case 1:
                return new Unit(U31, 10, 25, 20, 20, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY], $amount);
            case 2:
                return new Unit(U32, 20, 35, 40, 20, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY], $amount);
            case 3:
                return new Unit(U33, 60, 40, 60, 20, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY], $amount);
            case 4:
                return new Unit(U34, 80, 66, 50, 20, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY, UnitEnums::SCOUT], $amount);
            case 5:
                return new Unit(U35, 50, 70, 33, 20, 0, 2, 0, [0, 0, 0, 0], [UnitEnums::CAVALRY], $amount);
            case 6:
                return new Unit(U36, 100, 80, 70, 20, 0, 2, 0, [0, 0, 0, 0], [UnitEnums::CAVALRY], $amount);
            case 7:
                return new Unit(U37, 250, 140, 200, 20, 0, 3, 0, [0, 0, 0, 0], [UnitEnums::SIEGE, UnitEnums::RAM], $amount);
            case 8:
                return new Unit(U38, 450, 380, 240, 20, 0, 3, 0, [0, 0, 0, 0], [UnitEnums::SIEGE, UnitEnums::CATAPULT], $amount);
            case 9:
                return new Unit(U39, 200, 170, 250, 20, 0, 3, 0, [0, 0, 0, 0], [UnitEnums::COLONIZERS, UnitEnums::CHIEF], $amount);
            case 10:
                return new Unit(U40, 600, 440, 520, 20, 0, 5, 0, [0, 0, 0, 0], [UnitEnums::COLONIZERS, UnitEnums::SETTLER], $amount);
        }
    }
    
    /**
     * Get a Nataren unit
     *
     * @param int $unit The unit ID
     * @param int $amount The Unit amount
     * @return Unit Returns the instanced object
     */
    private static function getNatarsUnit(int $unit, int $amount): Unit
    {
        switch ($unit) {
            case 1:
                return new Unit(U41, 20, 35, 50, 6, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY], $amount);
            case 2:
                return new Unit(U42, 65, 30, 10, 7, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY], $amount);
            case 3:
                return new Unit(U43, 100, 90, 75, 6, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY], $amount);
            case 4:
                return new Unit(U44, 0, 10, 0, 25, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::INFANTRY, UnitEnums::SCOUT], $amount);
            case 5:
                return new Unit(U45, 155, 80, 50, 14, 0, 2, 0, [0, 0, 0, 0], [UnitEnums::CAVALRY], $amount);
            case 6:
                return new Unit(U46, 170, 140, 80, 12, 0, 3, 0, [0, 0, 0, 0], [UnitEnums::CAVALRY], $amount);
            case 7:
                return new Unit(U47, 250, 120, 150, 5, 0, 4, 0, [0, 0, 0, 0], [UnitEnums::SIEGE, UnitEnums::RAM], $amount);
            case 8:
                return new Unit(U48, 60, 45, 10, 3, 0, 5, 0, [0, 0, 0, 0], [UnitEnums::SIEGE, UnitEnums::CATAPULT], $amount);
            case 9:
                return new Unit(U49, 80, 50, 50, 5, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::COLONIZERS, UnitEnums::CHIEF], $amount);
            case 10:
                return new Unit(U50, 30, 40, 40, 5, 0, 1, 0, [0, 0, 0, 0], [UnitEnums::COLONIZERS, UnitEnums::SETTLER], $amount);
        }
    }
}