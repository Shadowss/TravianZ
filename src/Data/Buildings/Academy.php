<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\Building;
use TravianZ\Entity\Village;
use TravianZ\Data\Validator;
use TravianZ\Enums\ResearchEnums;
use TravianZ\Entity\Research;
use TravianZ\Utils\Generator;

final class Academy extends Building
{
    /**
     * @var array The rules needed to start a research
     */
    const START_RESEARCH_RULES = ['a' => 'isRequired|isInt|minValue=2|maxValue=9'];
    
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
     * {@inheritDoc}
     * @see \TravianZ\Entity\Building::getBonus()
     */
    public function getBonus()
    {
        return 0.964 ** ($this->level - 1);
    }
    
    /**
     * Check the validity of a research
     * 
     * @param Village $village The village in which the research should be researched
     * @param Research $research The research to be researched
     * @return string Returns the error or an empty string on success
     */
    public function checkResearch(Village $village, Research $research): string
    {
        // Check if there's already a research in progress
        foreach ($village->getResearches() as $startedResearch) {
            if ($startedResearch->getState() == ResearchEnums::IN_RESEARCH) {
                return RESEARCH_IN_PROGRESS;
            }
        }
        
        // Initialize
        $resourcesRequired = [];

        // Change the array keys
        foreach ($research->researchNeededResources as $key => $value) {
            $resourcesRequired[array_keys($village->getResources())[$key]] += $value;
        }

        // Check if the resources aren't enough
        foreach ($resourcesRequired as $key => $value) {           
            // Check if the warehouse capacity is enough
            if ($value > $village->maxStore && $key != 'crop') {
                return EXPAND_WAREHOUSE;
            } elseif ($value > $village->maxCrop && $key == 'crop') { // Check if the granary capacity is enough
                return EXPAND_GRANARY;
            }
            
            if ($value > $village->getResources()[$key]) {
                if (
                    $key == 'crop' && $value > $village->getResources()[$key] &&
                    $village->getProduction()[$key] - $village->getCropConsumption() <= 0
                ) { // Check if the crop is negative
                    return CROP_NEGATIVE;
                } else {
                    $enoughResourcesTime = Generator::getNeededResourcesTime(
                        $village->getResources(), 
                        $resourcesRequired, 
                        $village->getProduction()
                    );

                    return ENOUGH_RESOURCES . ' ' . $enoughResourcesTime[0] . ' ' . AT . ' ' . $enoughResourcesTime[1];
                }
            }
        }

        return '';
    }

    /**
     * Start a research
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function research(Village $village, array $parameters)
    {
        // Check if the parameters are valid
        if(!empty((new Validator())->validateInputs($parameters, self::START_RESEARCH_RULES))) {
            return;
        }

        // Check if the research can be researched
        if(!empty($this->checkResearch($village, $village->getResearches()[$parameters['a']]))) {
            return;
        }

        // Check if the village has the required buildings
        if (!$village->getResearches()[$parameters['a']]->canBeResearched($village->getBuildings())) {
            return;
        }

        // Check if the research has already been researched or in research
        if ($village->getResearches()[$parameters['a']]->getState() != ResearchEnums::NOT_YET_RESEARCHED) {
            return;
        }

        // Initialization
        $extraResources = [];

        // Prepare the resources to remove
        foreach ($village->getResearches()[$parameters['a']]->researchNeededResources as $key => $value) {
            $extraResources[array_keys($village->getResources())[$key]] -= $value;
        }

        // Update the research
        $village->getResearches()[$parameters['a']]->setValue(time() + $village->getResearches()[$parameters['a']]->researchTime);
        $village->getResearches()[$parameters['a']]->update($parameters['a'], $village->vref);       

        // Update the village resources
        $village->updateResources($extraResources);
    }
}