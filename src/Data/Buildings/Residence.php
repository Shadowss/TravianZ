<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\TrainingField;

final class Residence extends TrainingField
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
     * {@inheritDoc}
     * @see \TravianZ\Entity\TrainingField::__tostring()
     */
    public function __tostring(): string
    {
        return 'Colonizers';
    }
}