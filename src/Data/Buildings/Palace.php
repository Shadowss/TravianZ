<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\TrainingField;
use TravianZ\Entity\Village;
use TravianZ\Data\Validator;

final class Palace extends TrainingField
{
    /**
     * @var array The rules for changing the capital
     */
    const CHANGE_CAPITAL_RULES = ['Password' => 'isRequired'];
    
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
        array $buildingRequirements,
        int $unitToTrainClass,
        bool $unitToTrainGreat
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
            $buildingRequirements,
            $unitToTrainClass,
            $unitToTrainGreat
        );
    }
    
    /**
     * {@inheritDoc}
     * @see \TravianZ\Entity\Building::getBonus()
     */
    public function getBonus()
    {
        return 2 * $this->level ** 2;
    }
    
    /**
     * Change the User's capital
     * 
     * @param Village $village The new capital
     * @param array $parameters The parameters
     * @return string Returns an error, or an empty string in case of success
     */
    public function changeCapital(Village $village, array $parameters): string
    {
        // Check if the village is already a capital
        if ($village->isCapital) {
            return CAPITAL;
        }

        // Check if the password and parameters are valid
        if (
            !empty((new Validator())->validateInputs($parameters, self::CHANGE_CAPITAL_RULES)) ||
            !password_verify($parameters['Password'], $village->owner->getPassword())
        ) {
            return LOGIN_PW_ERROR;
        }

        // Search the actual capital village
        foreach ($village->owner->getVillages() as $capitalVillage) {
            if ($capitalVillage->isCapital) {
                // Set the building jobs and buildings
                $capitalVillage->setBuildings();
                $capitalVillage->setBuildingJobs();

                // Set the new capital
                $village->setFields(['capital'], [1]);
                $capitalVillage->setFields(['capital'], [0]);

                // Set the new capital locally
                $village->isCapital = 1;
                $capitalVillage->isCapital = 0;
                
                // Reset the resources field to level 10, if any
                $buildings = [];
                $levels = [];
                foreach ($capitalVillage->getBuildings() as $building) {
                    // Check if the building is a resource field
                    if (
                        $building->position >= 1 &&
                        $building->position <= 18 &&
                        $building->level > 10
                    ) {
                        $buildings[] = 'f'.$building->position;
                        $levels[] = 10;
                    }
                }
                
                // Update the buildings if not empty
                $capitalVillage->updateBuildings($buildings, $levels);

                // Remove the not-capital exclusive buildings
                $buildings = [];
                $levels = [];
                foreach ($village->getBuildings() as $building) {
                    // Check if the building is a not-capital exclusive building
                    if (
                        $building instanceof GreatBarracks ||
                        $building instanceof GreatStable ||
                        $building instanceof GreatWorkshop
                    ) {
                            $buildings[] = 'f'.$building->position;
                            $buildings[] = 'f'.$building->position.'t';
                            $levels[] = 0;
                            $levels[] = 0;
                    }
                }

                // Update the buildings
                $village->updateBuildings($buildings, $levels);

                // Remove any resources field building job over level 10
                foreach ($capitalVillage->getBuildingJobs() as $job) {
                    if (
                        $job->building->position >= 1 &&
                        $job->building->position <= 18 &&
                        $job->building->level > 10
                    ) {
                        // Remove the building
                        $capitalVillage->removeBuildingJob($job->id);
                    }
                }
                
                // Remove any not-capital exclusive buildings
                foreach ($village->getBuildingJobs() as $job) {
                    if (
                        $job->building instanceof GreatBarracks ||
                        $job->building instanceof GreatStable ||
                        $job->building instanceof GreatWorkshop
                        ) {
                            // Remove the building
                            $village->removeBuildingJob($job->id);
                        }
                }

                // Return an empty string in case of success
                return '';
            }
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \TravianZ\Entity\TrainingField::__tostring()
     */
    public function __tostring(): string
    {
        return 'Colonizers';
    }
}