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

namespace TravianZ\Data;

use TravianZ\Account\ISessionBase;
use TravianZ\Data\Buildings\Marketplace;
use TravianZ\Data\Buildings\TownHall;
use TravianZ\Data\Movements\Normal;
use TravianZ\Data\Movements\Raid;
use TravianZ\Data\Movements\Reinforcement;
use TravianZ\Data\Movements\Returning;
use TravianZ\Data\Movements\ReturningTrade;
use TravianZ\Data\Movements\Settling;
use TravianZ\Data\Movements\Spy;
use TravianZ\Data\Movements\Trade;
use TravianZ\Entity\Village;
use TravianZ\Utils\Generator;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Enums\BuildingJobEnums;
use TravianZ\Enums\MovementEnums;

/**
 * @author iopietro
 */
trait GetInformations
{
    /**
     * Get the information of a village
     *
     * @param Village $village
     */
    private function getVillageInformations(Village $village)
    {
        $villageInformations['resourcesFieldCoordinatesArray'] = Village::RESOURCES_FIELD_COORDINATES_ARRAY;
        $villageInformations['villageCoordinatesArray'] = Village::VILLAGE_COORDINATES_ARRAY;
        $villageInformations['villageProduction'] = $village->getProduction();
        $villageInformations['villageCropConsumption'] = $village->getCropConsumption();
        $villageInformations['villageResources'] = $village->getResources();
        $villageInformations['villageTotalResources'] = $village->getTotalResources();
        $villageInformations['villageCulturePoints'] = $village->culturePoints;
        $villageInformations['villageCulturePointsProduction'] = $village->getCulturePointsProduction();
        $villageInformations['villageVref'] = $village->vref;
        $villageInformations['villageMapCheck'] = Generator::getMapCheck($village->vref);
        $villageInformations['villageName'] = $village->name;
        $villageInformations['villageMaxStore'] = $village->maxStore;
        $villageInformations['villageMaxCrop'] = $village->maxCrop;
        $villageInformations['villageLoyalty'] = $village->loyalty;
        $villageInformations['villageType'] = $village->type;
        $villageInformations['villageCelebrationTime'] = Generator::getTimeFormat($village->celebrationTime - $this->time);
        $villageInformations['villageIsCelebrating'] = $village->isCelebrating;
        $villageInformations['villageIsCapital'] = $village->isCapital;
        $villageInformations['villageIsNatar'] = $village->isNatar;
        $villageInformations['villageCoordinates'] = $village->coordinates;
        $villageInformations['villageMerchants'] = $village->getMerchants();
        $villageInformations['villageSlots'] = $village->getSlots();
        $villageInformations['villageEvasion'] = $village->evasion;
        
        $oasisVrefs = [];
        foreach ($village->getOasis() as $oases) {
            $oasisVrefs[] = $oases->wref;
        }
        
        $villageTotalUnitsInTraining = $villageUnitsInTraining = [];
        $totalUnitsInTraining = count($village->getUnitsInTraining());

        foreach ($village->getUnitsInTraining() as $index => $inTraining) {
            $villageTotalUnitsInTraining[$inTraining->type]['name'] = $inTraining->unit->name;
            $villageTotalUnitsInTraining[$inTraining->type]['amount'] += $inTraining->unit->amount;
            $villageTotalUnitsInTraining[$inTraining->type]['classes'] = $inTraining->unit->classes;
            $villageTotalUnitsInTraining[$inTraining->type]['great'] = $inTraining->great;
            
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['name'] = $inTraining->unit->name;
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['amount'] += $inTraining->unit->amount;
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['great'] = $inTraining->great;
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['type'] = $inTraining->type;
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['duration'] = Generator::getTimeFormat(
                $inTraining->eachTime * $inTraining->unit->amount + (!$index ? $inTraining->lastTrainedTime - $this->time : 0)
            );
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['finishTime'] = Generator::procMtime($inTraining->finishTime);
            $villageUnitsInTraining[$inTraining->unit->classes[0]][$inTraining->great][$index]['nextFinished'] = Generator::getTimeFormat($inTraining->lastTrainedTime + $inTraining->eachTime - $this->time);
        }
        
        $villageBuildings = [];
        $villageIsTownHallBuilt = $villageIsMarketplaceBuilt = false;
        foreach ($village->getBuildings() as $index => $building) {
            if ($building instanceof TownHall) {
                $villageIsTownHallBuilt = true;
            }elseif ($building instanceof Marketplace) {
                $villageIsMarketplaceBuilt = true;
            }
            
            $villageBuildings[$index]['id'] = $building->id;
            $villageBuildings[$index]['name'] = $building->name;
            $villageBuildings[$index]['desc'] = $building->desc;
            $villageBuildings[$index]['level'] = $building->level;
            $villageBuildings[$index]['bonus'] = $building->getBonus();
            $villageBuildings[$index]['pop'] = $building->getUpkeep();
        }
        
        $villageBuildingJobs = [];
        $villageIsMasterBuilderBusy = false;
        foreach ($village->getBuildingJobs() as $index => $job) {
            // Check if it's a demolition job
            if ($job->sort == BuildingJobEnums::IN_DEMOLITION) {
                continue;
            }
            
            // Check if the master builder is busy
            if (!$villageIsMasterBuilderBusy && $job->sort == BuildingJobEnums::MASTER_BUILDER) {
                $villageIsMasterBuilderBusy = true;
            }
            
            $villageBuildingJobs[$index]['name'] = $job->building->name;
            $villageBuildingJobs[$index]['position'] = $job->building->position;
            $villageBuildingJobs[$index]['type'] = $job->building->id;
            $villageBuildingJobs[$index]['id'] = $job->id;
            $villageBuildingJobs[$index]['level'] = $job->building->level;
            $villageBuildingJobs[$index]['sort'] = $job->sort;
            $villageBuildingJobs[$index]['time'] = Generator::getTimeFormat($job->timestamp - $this->time);
            $villageBuildingJobs[$index]['doneAt'] = date('H:i', $job->timestamp);
        }
        
        $villageAreUnitsPresent = false;
        $villageTotalPresentUnits = [];
        $villagePresentUnits = [
            'villageName' => $village->name,
            'villageVref' => $village->vref,
            'villageMapCheck' => Generator::getMapCheck($village->vref),
            'ownerId' => $village->owner->id,
            'ownerTribe' => $village->owner->tribe
        ];
        foreach ($village->getUnits() as $index => $unit) {
            $villagePresentUnits['unitsArray'][$index]['name'] = $unit->name;
            $villagePresentUnits['unitsArray'][$index]['amount'] = $unit->amount;
            $villagePresentUnits['unitsArray'][$index]['totalUpkeep'] = $unit->upkeep * $unit->amount;
            
            $villageTotalPresentUnits[$this->session->getUser()->tribe][$index]['name'] = $unit->name;
            $villageTotalPresentUnits[$this->session->getUser()->tribe][$index]['amount'] += $unit->amount;

            if (!$villageAreUnitsPresent && $unit->amount > 0) {
                $villageAreUnitsPresent = true;
            }
        }

        $villageTrainableUnits = [];
        foreach ($village->getTrainableUnits() as $index => $unit) {
            $villageTrainableUnits[$unit->classes[0]][$index]['name'] = $unit->name;
            $villageTrainableUnits[$unit->classes[0]][$index]['classes'] = $unit->classes;
            $villageTrainableUnits[$unit->classes[0]][$index]['upkeep'] = $unit->upkeep;
            $villageTrainableUnits[$unit->classes[0]][$index]['resources'] = $unit->trainResources;
            $villageTrainableUnits[$unit->classes[0]][$index]['totalResources'] = $unit->totalTrainResources;
            $villageTrainableUnits[$unit->classes[0]][$index]['amount'] = $unit->amount;
            $villageTrainableUnits[$unit->classes[0]][$index]['duration'] = Generator::getTimeFormat($unit->trainTime);
            
            $villageTrainableUnits[$unit->classes[0]][$index]['max'] = min(
                $unit->max,
                floor($village->getResources()['wood'] / ($unit->trainResources[0] > 0 ? $unit->trainResources[0] : 1)),
                floor($village->getResources()['clay'] / ($unit->trainResources[1] > 0 ? $unit->trainResources[1] : 1)),
                floor($village->getResources()['iron'] / ($unit->trainResources[2] > 0 ? $unit->trainResources[2] : 1)),
                floor(($village->getResources()['crop'] > 0 ? $village->getResources()['crop'] : 0)  / ($unit->trainResources[3] > 0 ? $unit->trainResources[3] : 1))
           );
        }
        
        $villageEnforcements = [];
        $villageTotalEnforcementsUnit = [];
        foreach ($village->getEnforcements() as $index => $enforcement) {
            $target = $enforcement->from->vref == $village->vref ? 'from' : 'to';
            $where = in_array($enforcement->to->vref, $oasisVrefs) ? 'oasis' : 'village';
            
            $villageEnforcements[$where][$target][$index]['id'] = $enforcement->id;
            $villageEnforcements[$where][$target][$index]['villageName'] = $enforcement->to->name;
            $villageEnforcements[$where][$target][$index]['villageVref'] = $enforcement->to->vref;
            $villageEnforcements[$where][$target][$index]['villageMapCheck'] = Generator::getMapCheck($enforcement->to->vref);
            $villageEnforcements[$where][$target][$index]['ownerId'] = $enforcement->from->owner->id;
            $villageEnforcements[$where][$target][$index]['ownerUsername'] = $enforcement->from->owner->username;
            $villageEnforcements[$where][$target][$index]['ownerTribe'] = $enforcement->from->owner->tribe;
            
            foreach($enforcement->units as $unitID => $unit) {
                $villageEnforcements[$where][$target][$index]['unitsArray'][$unitID]['name'] = $unit->name;
                $villageEnforcements[$where][$target][$index]['unitsArray'][$unitID]['amount'] = $unit->amount;
                $villageEnforcements[$where][$target][$index]['unitsArray'][$unitID]['totalUpkeep'] = $unit->upkeep * $unit->amount;
                
                if ($enforcement->from->vref != $village->vref) {
                    $villageTotalPresentUnits[$enforcement->from->owner->tribe][$unitID]['name'] = $unit->name;
                    $villageTotalPresentUnits[$enforcement->from->owner->tribe][$unitID]['amount'] += $unit->amount;
                    $villageTotalEnforcementsUnit[$unitID] += $unit->amount;
                    
                    if (!$villageAreUnitsPresent && $unit->amount > 0) {
                        $villageAreUnitsPresent = true;
                    }
                }
            }
        }
        
        $villageTrappedUnits = [];
        foreach ($village->getTrappedUnits() as $index => $trapped) {
            $target = $trapped->from->vref == $village->vref ? 'from' : 'to';
            
            $villageTrappedUnits[$target][$index]['id'] = $trapped->id;
            $villageTrappedUnits[$target][$index]['villageName'] = $target == 'from' ? $trapped->to->name : $trapped->from->name;
            $villageTrappedUnits[$target][$index]['villageVref'] = $target == 'from' ? $trapped->to->vref : $trapped->from->vref;
            $villageTrappedUnits[$target][$index]['villageMapCheck'] = Generator::getMapCheck($target == 'from' ? $trapped->to->vref : $trapped->from->vref);
            $villageTrappedUnits[$target][$index]['targetVillageName'] = $villageTrappedUnits[$target][$index]['villageName'];
            $villageTrappedUnits[$target][$index]['targetVillageVref'] = $villageTrappedUnits[$target][$index]['villageVref'];
            $villageTrappedUnits[$target][$index]['targetVillageMapCheck'] = $villageTrappedUnits[$target][$index]['villageMapCheck'];
            $villageTrappedUnits[$target][$index]['ownerTribe'] = $trapped->from->owner->tribe;
            
            foreach($trapped->units as $unitID => $unit) {
                $villageTrappedUnits[$target][$index]['unitsArray'][$unitID]['name'] = $unit->name;
                $villageTrappedUnits[$target][$index]['unitsArray'][$unitID]['amount'] = $unit->amount;
                $villageTrappedUnits[$target][$index]['unitsArray'][$unitID]['totalUpkeep'] = $unit->upkeep * $unit->amount;
            }
        }
        
        $villageMovements = [];
        $oasisVrefs[] = $village->vref;
        foreach ($village->getMovements() as $index => $movement) {
            // Exclude spy attacks to the village, returning movements to other villages and trades
            if (
                (in_array($movement->to->vref, $oasisVrefs) && $movement instanceof Spy) ||
                ($movement->to->vref != $village->vref && $movement instanceof Returning) ||
                $movement instanceof Trade || 
                $movement instanceof ReturningTrade
                ) {
                    continue;
                }
                
                if ($movement->to->vref == $village->vref) {
                    $where = 'village';
                    $target = 'to';
                } elseif ($movement->from->vref == $village->vref) {
                    $where = 'village';
                    $target = 'from';
                } else {
                    $where = 'oasis';
                    $target = 'to';
                }
                
                if ($movement instanceof Spy || $movement instanceof Raid || $movement instanceof Normal) {
                    $action = 'attacks';
                } elseif ($movement instanceof Reinforcement || $movement instanceof Returning) {
                    $action = 'reinforcements';
                } elseif ($movement instanceof Settling) {
                    $action = 'settling';
                }
                
                if (
                    !isset($villageMovements[$action][$where][$target]['timetoarrive']) ||
                    $villageMovements[$action][$where][$target]['timetoarrive'] < $movement->time
                ) {
                    $villageMovements[$action][$where][$target]['timetoarrive'] = Generator::getTimeFormat($movement->endTime - $this->time);
                    $villageMovements[$action][$where][$target]['timetoarriveunix'] = $movement->endTime;
                }
                    
                $villageMovements[$action][$where][$target]['amount']++;

                $villageMovementsInfo[$target][$index]['villageName'] = $movement->type != MovementEnums::RETURNING ? $movement->from->name : $movement->to->name;
                $villageMovementsInfo[$target][$index]['villageVref'] = $movement->type != MovementEnums::RETURNING ? $movement->from->vref : $movement->to->vref;
                $villageMovementsInfo[$target][$index]['villageMapCheck'] = Generator::getMapCheck($movement->type != MovementEnums::RETURNING ? $movement->from->vref : $movement->to->vref);
                $villageMovementsInfo[$target][$index]['targetVillageName'] = $movement->type != MovementEnums::RETURNING ? $movement->to->name : $movement->from->name;
                $villageMovementsInfo[$target][$index]['targetVillageVref'] = $movement->type != MovementEnums::RETURNING ? $movement->to->vref : $movement->from->vref;
                $villageMovementsInfo[$target][$index]['targetVillageMapCheck'] = Generator::getMapCheck($movement->type != MovementEnums::RETURNING ? $movement->to->vref : $movement->from->vref);
                $villageMovementsInfo[$target][$index]['ownerTribe'] = $movement->type != MovementEnums::RETURNING ? $movement->from->owner->tribe : $movement->to->owner->tribe;
                $villageMovementsInfo[$target][$index]['ownerId'] = $movement->type != MovementEnums::RETURNING ? $movement->from->owner->id : $movement->to->owner->id;
                $villageMovementsInfo[$target][$index]['type'] = $movement->type;
                $villageMovementsInfo[$target][$index]['id'] = $movement->id;
                $villageMovementsInfo[$target][$index]['canBeCanceled'] = $this->time - $movement->startTime <= 90 && $target != 'to';
                $villageMovementsInfo[$target][$index]['arrivalTime'] = Generator::getTimeFormat($movement->endTime - $this->time);
                $villageMovementsInfo[$target][$index]['arrivalDate'] = Generator::procMtime($movement->endTime);
                
                foreach ($movement->units as $unitID => $unit) {
                    $villageMovementsInfo[$target][$index]['unitsArray'][$unitID]['name'] = $unit->name;
                    $villageMovementsInfo[$target][$index]['unitsArray'][$unitID]['amount'] = $movement instanceof Returning || $movement->from->vref == $village->vref ? $unit->amount : '?';
                }
        }
        
        $villageMaxStoreTime = $villageMaxCropTime = 0;
        
        // Set the highest time to fill the warehouse
        foreach ($village->getResources() as $key => $resource) {
            // Exclude the crop
            if ($key == 'crop') {
                continue;
            }
            
            // Prevent possible division by zero errors
            if ($village->getProduction()[$key] != 0) {
                // Set the time required from this resource, to fill the warehouse
                $timeToFill = round((($village->maxStore - $resource) / $village->getProduction()[$key]) * 3600);
                if ($villageMaxStoreTime < $timeToFill) {
                    $villageMaxStoreTime = $timeToFill;
                }
            }
        }
        
        $villageInformations['villageMaxStoreTime'] = $villageMaxStoreTime;
        
        // Get the highest time to fill the granary
        $villageInformations['villageMaxStoreTimeString'] = Generator::getTimeFormat($villageInformations['villageMaxStoreTime']);
        
        // Check if the crop production is negative or 0
        if ($village->getProduction()['crop'] - $village->getCropConsumption() >= 0) {
            // Set the time required to fill the granary
            $villageMaxCropTime = max(0, round(
                (
                    ($village->maxCrop - $village->getResources()['crop']) /
                    ($village->getProduction()['crop'] - $village->getCropConsumption())
                ) * 3600
            )
            );
        }
        
        $villageInformations['villageMaxCropTime'] = $villageMaxCropTime;
        $villageInformations['villageMaxCropTimeString'] = Generator::getTimeFormat($villageInformations['villageMaxCropTime']);
        
        $villageInformations['villageIsTownHallBuilt'] = $villageIsTownHallBuilt;
        $villageInformations['villageIsMarketplaceBuilt'] = $villageIsMarketplaceBuilt;
        
        // Fill the arrays
        $villageInformations['villageTotalUnitsInTraining'] = $villageTotalUnitsInTraining;
        $villageInformations['villageUnitsInTraining'] = $villageUnitsInTraining;
        $villageInformations['villageTrappedUnits'] = $villageTrappedUnits;
        $villageInformations['villageBuildings'] = $villageBuildings;
        $villageInformations['villageBuildingJobs'] = $villageBuildingJobs;
        $villageInformations['villageTrainableUnits'] = $villageTrainableUnits;
        $villageInformations['villageEnforcements'] = $villageEnforcements;
        $villageInformations['villageTrappedUnits'] = $villageTrappedUnits;
        $villageInformations['villageTotalPresentUnits'] = $villageTotalPresentUnits;
        $villageInformations['villageTotalUnits'] = $village->getTotalUnits();
        $villageInformations['villageTotalEnforcementsUnit'] = $villageTotalEnforcementsUnit;
        $villageInformations['villagePresentUnits'] = $villagePresentUnits;
        $villageInformations['villageMovements'] = $villageMovements;
        $villageInformations['villageAreUnitsPresent'] = $villageAreUnitsPresent;
        $villageInformations['villageMovementsInfo'] = $villageMovementsInfo;

        return $villageInformations;
    }
    
    /**
     * Get the user's villages informations
     *
     * @param array $villages The user's villages
     * @return array
     */
    public function getVillagesInformations(array $villages): array
    {
        $villagesInformation = [];
        foreach ($villages as $village) {
            $villagesInformation[] = $this->getVillageInformations($village);
        }

        return ['villages' => $villagesInformation];
    }
    
    /**
     * Gets the session informations
     *
     * @return array
     */
    public function getSessionInformations(ISessionBase $session): array
    {
        // Set the default Session informations
        $sessionInformations = [
            'isLoggedIn' => $session->getUser()->isLoggedIn,
            'numberOfVillages' => $session->getUser()->getVillagesCount(),
            'goldclub' => $session->getUser()->goldclub,
            'plus' => $session->getUser()->plus,
            'access' => $session->getUser()->access,
            'userId' => $session->getUser()->id,
            'gold' => $session->getUser()->gold,
            'tribe' => $session->getUser()->tribe,
            'alliance' => $session->getUser()->alliance,
            'maxEvasion' => $session->getUser()->maxEvasion,
            'questNumber' => $session->getUser()->questNumber,
            'selectedVillage' => $session->getUser()->selectedVillage,
            'currentGold' => sprintf(CURRENT_GOLD, $session->getUser()->gold),
            'deletingTimestamp' => $session->getUser()->inDeleting(),
            'nextVillageCulturePoints' => $session->getUser()->getNextVillageCulturePoints(CP),
        ];

        $totalCulturePoints = $totalCulturePointsProduction = 0;
        foreach ($session->getUser()->getVillages() as $village) {
            $totalCulturePoints += $village->culturePoints;
            $totalCulturePointsProduction += $village->getCulturePointsProduction();
        }
        
        return array_merge(
            $session->getInformations(), 
            $sessionInformations,
            [
                'totalCulturePoints' => $totalCulturePoints,
                'totalCulturePointsProduction' => $totalCulturePointsProduction
            ]
        );
    }
}