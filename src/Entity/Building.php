<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Author: iopietro <https://github.com/iopietro>
 *
 * Source: All formulas used in this class were taken from this file:
 *         <https://github.com/kirilloid/travian/blob/26b27f0a9a98dda196c9154faf1545dbd9ac5066/src/model/base/buildings.ts>
 *         of Kirilloid <https://github.com/kirilloid>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Entity;

use TravianZ\Utils\Math;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Database\IDbConnection;
use TravianZ\Enums\BuildingJobEnums;

/**
 * @author iopietro
 */
abstract class Building
{
    /**
     * @var int The building ID
     */
    public $id;
    
    /**
     * @var int Where the building is located on the village
     */
    public $position;
    
    /**
     * @var int The level of the building
     */    
    public $level;
    
    /**
     * @var string The name of the building
     */
    public $name;
    
    /**
     * @var string The description of the building
     */
    public $desc;
    
    /**
     * @var int The maximum level of this building
     */
    public $maxLevel;

    /**
     * @var array The base resources for building it at the first level
     */
    private $baseResourcesRequired;
    
    /**
     * @var int The base culture points growth
     */
    private $baseCulturePoints;

    /**
     * @var array The time needed to build it at the first level
     */
    private $baseTime;
    
    /**
     * @var float The base cost growth
     */
    private $baseCostGrowth;

    /**
     * @var int The base upkeep consumption and population, at the first level
     */
    private $baseUpkeep;

    /**
     * @var array The bonus provided by this building
     */
    private $bonus;
    
    /**
     * @var array The prerequisites needed to build this building
     */
    private $prerequisites;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        int $id,
        int $position,
        int $level,
        string $name,
        string $desc,
        array $baseResourcesRequired,
        int $baseCulturePoints,
        array $baseTime,
        float $baseCostGrowth,
        int $baseUpkeep,
        array $bonus,
        int $maxLevel,
        array $prerequisites
    ) {
        $this->id = $id;
        $this->position = $position;
        $this->level = $level;
        $this->name = $name;
        $this->desc = $desc;
        $this->maxLevel = $maxLevel;
        $this->baseResourcesRequired = $baseResourcesRequired;
        $this->baseCulturePoints = $baseCulturePoints;
        $this->baseTime = $baseTime;
        $this->baseCostGrowth = $baseCostGrowth;
        $this->baseUpkeep = $baseUpkeep;
        $this->bonus = $bonus;
        $this->prerequisites = $prerequisites;
    }
    
    /**
     * Check if this building can be built
     * 
     * @param array $buildings
     * @return bool Returns if the building meet its requirements to be built
     */
    public function canBeBuilt(array $buildings): bool
    {
        // Check if the buildings are valid
        foreach ($buildings as $building) {
            if ($building->id > 0 && $building->position >= 19) {
                foreach ($this->prerequisites as $id => $levelRequired) {
                    // Check if the buildings are valid
                    if (($building->id == $id && ($building->level < $levelRequired || $levelRequired == - 1))) {
                        // At least one building isn't valid
                        return false;
                    }
                }
            }
        }

        // All buildings are valid
        return true;
    }
    
    /**
     * Check if this building can be upgraded
     *
     * @param array $buildings
     * @param int Returns the error or success
     */
    public function canBeUpgraded(Village $village): int
    {
        // Initialization
        $inLoop = $basic = $inner = $sameBuild = $soonPop = 0;
        
        foreach ($village->getBuildingJobs() as $job) {
            // Exclude the demolition jobs
            if (
                $job->sort == BuildingJobEnums::IN_DEMOLITION ||
                $job->sort == BuildingJobEnums::IN_DEMOLITION_LOOP
            ) {
                // Check if the building is being demolished
                if ($job->building->position == $this->position) {
                    return BuildingEnums::BEING_DEMOLISHED;
                }
                
                // If not, continue
                continue;
            }
            
            // Check if the same building is in the building queue
            if ($job->building->position == $this->position) {
                $sameBuild++;
            }
            
            // Check if this building is in waiting loop
            if ($job->sort == BuildingJobEnums::IN_LOOP) {
                $inLoop++;
            } elseif ($job->building->position <= 18 && ($village->owner->tribe == 1 || ALLOW_ALL_TRIBE)) {
                $inner++;
            } else {
                $basic++;
            }
            
            // Increment the future population
            $soonPop += $job->building->getUpkeep();
        }

        // Check if the building is being built at his maximum level
        if ($this->level > $this->maxLevel) {
            if ($sameBuild > 0) {
                return BuildingEnums::MAX_LEVEL_UNDER_CONSTRUCTION;
            } else {
                return BuildingEnums::MAX_LEVEL_REACHED;
            }
        }
        
        // Check if the village crop production is enough
        if (
            $village->getProduction()['crop'] - $village->getCropConsumption() - $soonPop <= 1 && 
            $this->id != BuildingEnums::CROPLAND
        ) {
            return BuildingEnums::NOT_ENOUGH_FOOD;
        }

        // Check if all workers are busy
        if (
            $basic >= BASIC_MAX && $this->position >= 19 || 
            (($village->owner->tribe == 1 || ALLOW_ALL_TRIBE) && $inner >= INNER_MAX && $this->position <= 18)
        ) {
            if ($village->owner->plus) {
                if ($inLoop >= PLUS_MAX) {
                    return BuildingEnums::WORKERS_ALREADY_WORK_WAITING_LOOP;
                }
            } else {
                return BuildingEnums::WORKERS_ALREADY_WORK;
            }
        }
        
        // Check if the resources are enough
        if (
            $this->getNeededResources()['wood'] > $village->maxStore ||
            $this->getNeededResources()['clay'] > $village->maxStore ||
            $this->getNeededResources()['iron'] > $village->maxStore
        ) {
            return BuildingEnums::UPGRADE_WAREHOUSE;
        } elseif ($this->getNeededResources()['crop'] > $village->maxCrop) {
            return BuildingEnums::UPGRADE_GRANARY;
        } elseif (
            $this->getNeededResources()['wood'] > $village->getResources()['wood'] ||
            $this->getNeededResources()['clay'] > $village->getResources()['clay'] ||
            $this->getNeededResources()['iron'] > $village->getResources()['iron'] ||
            $this->getNeededResources()['crop'] > $village->getResources()['crop'] 
        ) {
            return BuildingEnums::NOT_ENOUGH_RESOURCES;
        } elseif ($inLoop) {
            return BuildingEnums::CAN_BE_BUILT_WAITING_LOOP;
        } else {
            return BuildingEnums::CAN_BE_BUILT;
        }
    }
    
    /**
     * @return int|float Returns the actual building bonus
     */
    public function getBonus()
    {
        return $this->bonus[$this->level];
    }
    
    /**
     * Get the actual upkeep
     * 
     * @return int
     */
    public function getUpkeep(): int
    {
        return $this->level == 1 ? $this->baseUpkeep : round((5 * $this->baseUpkeep + $this->level - 1) / 10);
    }
    
    /**
     * Get the actual culture points production
     *
     * @return int
     */
    public function getCulturePoints(): int
    {
        return $this->baseCulturePoints * 1.2 ** $this->level;
    }

    /**
     * Get the needed time to build the building at the set level
     * 
     * @return int
     */
    public function getNeededTime(): int
    {
        return Math::roundWithPrecision($this->baseTime[0] * ($this->baseTime[1] ** ($this->level - 1)) - $this->baseTime[2], 10);
    }
    
    /**
     * Get the needed resources to build the building at the set level
     * 
     * @return array
     */
    public function getNeededResources(): array
    {
        return [
            'wood' => $this->calculatesNeededResource($this->baseResourcesRequired[0]),
            'clay' => $this->calculatesNeededResource($this->baseResourcesRequired[1]),
            'iron' => $this->calculatesNeededResource($this->baseResourcesRequired[2]),
            'crop' => $this->calculatesNeededResource($this->baseResourcesRequired[3])
        ];
    }

    /**
     * Calculates the resource amount required to build a certain level of a building
     * 
     * @return int
     */
    private function calculatesNeededResource(int $resource): int
    {
        return Math::roundWithPrecision($resource * $this->baseCostGrowth ** ($this->level - 1), 5);
    }
    
    public function __toString()
    {
        return $this->name;
    }
    
    /**
     * Set the building database
     * 
     * @param IDbConnection $db
     */
    public function setDatabase(IDbConnection $db)
    {
        $this->db = $db;
    }
    
    /**
     * Get the building database
     * 
     * @return IDbConnection
     */
    public function getDatabase(): IDbConnection
    {
        return $this->db;
    }
}