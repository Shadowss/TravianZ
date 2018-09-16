<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\Building;
use TravianZ\Entity\Village;
use TravianZ\Enums\BuildingEnums;

final class WonderOfTheWorld extends Building
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
     * {@inheritDoc}
     * @see \TravianZ\Entity\Building::canBeUpgraded()
     */
    public function canBeUpgraded(Village $village, array $artifacts = []): int
    {
        if ($this->level >= 0 && $this->level <= 49 && $artifacts['own'] < 1) {
            return BuildingEnums::NEED_WW_BUILDING_PLAN;
        } elseif ($this->level >= 50 && $this->level <= 99 && $artifacts['own'] < 1 && $artifacts['allied'] < 1) {
            return BuildingEnums::NEED_WW_BUILDING_PLAN;
        } else {
            return parent::canBeUpgraded($village, $tribe, $plus);
        }
    }
}