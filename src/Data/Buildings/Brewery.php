<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\Building;
use TravianZ\Entity\Village;
use TravianZ\Entity\BeerFest;

final class Brewery extends Building
{
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
        array $buildingRequirements
    ) {
        parent::__construct(
            $id,
            $position,
            $level,
            $name,
            $desc,
            $baseResourcesRequired,
            $baseCulturePoints,
            $baseTime,
            $baseCostGrowth,
            $baseUpkeep,
            $bonus,
            $maxLevel,
            $buildingRequirements
        );
    }

    /**
     * Check if the passed village has enough resources to start a beer fest
     * 
     * @param Village $village
     * @return array Returns the needed resources (with the right keys) to start a beer fest
     */
    public function checkEnoughBeerFestResources(Village $village): array
    {
        // Initialize
        $neededResources = [];
        
        // Check the resources quantity
        foreach (BeerFest::NEEDED_RESOURCES as $key => $value) {
            // Set the new key
            $newKey = array_keys($village->getResources())[$key];
            
            // Check if the resource isn't enough
            if ($village->getResources()[$newKey] < BeerFest::NEEDED_RESOURCES[$key]) {
                return [];
            }
            
            // Add the resource
            $neededResources[$newKey] = -BeerFest::NEEDED_RESOURCES[$key];
        }

        return $neededResources;
    }
    
    /**
     * Start a beerfest
     * 
     * @param Village $village
     */
    public function startBeerFest(Village $village)
    {
        // Check if the beer fest hasn't already been started
        if ($village->owner->isBeerFestActive()) {
            return;
        }
        
        // Initialize
        $neededResources = $this->checkEnoughBeerFestResources($village);
        
        // Check if the beer fest can be started
        if (empty($neededResources)) {
            return;
        }

        // Start the beerFest
        (new BeerFest($this->getDatabase(), $village->owner))->start();
        
        // Remove the resources from the village
        $village->updateResources($neededResources);
    }
}