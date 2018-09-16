<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\Building;
use TravianZ\Entity\Village;
use TravianZ\Data\Validator;
use TravianZ\Enums\BuildingJobEnums;
use TravianZ\Entity\BuildingJob;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Utils\Math;
use TravianZ\Factory\BuildingsFactory;

final class MainBuilding extends Building
{
    const START_DEMOLITION_RULES = [
        'demolish' => 'isRequired|isInt|minValue=19|maxValue=40'
    ];
    
    const CANCEL_DEMOLITION_RULES = [
        'cancel' => 'isRequired|isInt|minValue=1'
    ];
    
    /**
     * @var Validator
     */
    private $validator;
    
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
        
        $this->validator = new Validator();
    }
    
    /**
     * {@inheritDoc}
     * @see \TravianZ\Entity\Building::getBonus()
     */
    public function getBonus()
    {
        return round(0.964 ** ($this->level - 1) * 100);
    }
    
    /**
     * Start a building demolition
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function startDemolition(Village $village, array $parameters)
    {
        // Check if the building position is valid
        if (!empty($this->validator->validateInputs($parameters, self::START_DEMOLITION_RULES))) {
            return;
        }

        // Initialize
        $inDemolition = 0;
        $inConstruction = false;
        $buildingToDemolish = null;

        // Count total buildings in demolition
        foreach ($village->getBuildingJobs() as $job) {
            if ($job->sort == BuildingJobEnums::IN_DEMOLITION) {
                $inDemolition++;
            } elseif (!$inConstruction && $job->building->position == $parameters['demolish']) {
                $inConstruction = $job->building;
            }
        }
        
        // Search the building to demolish
        foreach ($village->getBuildings() as $building) {
            if ($building->id > BuildingEnums::EMPTY && $building->position == $parameters['demolish']) {
                $buildingToDemolish = $building;
                break;
            }
        }
        
        // Check if the buildings in demolition limit has been reached 
        if ($inDemolition >= 1) {
            return;
        }

        // Check if the building is in construction
        if ($inConstruction) {
            return;
        }

        // Check if the building doesn't exist
        if (is_null($buildingToDemolish)) {
            return;
        }

        // Create the demolition job
        $demolitionJob = new BuildingJob(
            $this->getDatabase(),
            0, 
            BuildingsFactory::newBuilding(
                $buildingToDemolish->id, 
                $buildingToDemolish->position,
                $buildingToDemolish->level - 1
            ), 
            time() + Math::roundWithPrecision($buildingToDemolish->getNeededTime() / 2, 10),
            BuildingJobEnums::IN_DEMOLITION
        );
        
        // Add the demolition job to the database
        $demolitionJob->add($village->vref);
        
        // Add the demolition job locally
        $village->addBuildingJob($demolitionJob);
    }
    
    /**
     * Cancel a building demolition
     *
     * @param Village $village
     * @param array $parameters
     */
    public function cancelDemolition(Village $village, array $parameters)
    {
        // Check if the building job is valid
        if (!empty($this->validator->validateInputs($parameters, self::CANCEL_DEMOLITION_RULES))) {
            return;
        }
        
        // Remove the building job
        $village->removeBuildingJob($parameters['cancel'], BuildingJobEnums::IN_DEMOLITION_LOOP, false);
    }
}