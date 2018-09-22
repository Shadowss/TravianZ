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

namespace TravianZ\Models;

use TravianZ\Account\ISessionBase;
use TravianZ\Account\Session;
use TravianZ\Data\GetInformations;
use TravianZ\Data\Validator;
use TravianZ\Data\Buildings\Academy;
use TravianZ\Data\Buildings\MainBuilding;
use TravianZ\Data\Buildings\Marketplace;
use TravianZ\Data\Buildings\Palace;
use TravianZ\Data\Buildings\RallyPoint;
use TravianZ\Data\Movements\Raid;
use TravianZ\Data\Movements\ReturningTrade;
use TravianZ\Data\Movements\Trade;
use TravianZ\Database\Database;
use TravianZ\Entity\Building;
use TravianZ\Entity\TrainingField;
use TravianZ\Entity\Village;
use TravianZ\Entity\Villages;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Enums\BuildingJobEnums;
use TravianZ\Enums\ResearchEnums;
use TravianZ\Exceptions\InvalidParametersException;
use TravianZ\Factory\BuildingsFactory;
use TravianZ\Mvc\Model;
use TravianZ\Utils\Generator;
use TravianZ\Data\Buildings\Brewery;
use TravianZ\Entity\BeerFest;

/**
 * @author iopietro
 */
class BuildingModel extends Model
{
    use GetInformations;
    
    /**
     * @var array Marketplace menus
     */
    const MARKETPLACE_MENU_RULES = ['t' => 'isInt|minValue=1|maxValue=4'];
    
    /**
     * @var array Marketplace gold club menu rules
     */
    const MARKETPLACE_GOLDCLUB_MENU_RULES = ['t' => 'isInt|minValue=4|maxValue=4'];
    
    /**
     * @var array Residence and Palace menu
     */
    const COLONIZERS_MENU_RULES = ['s' => 'isInt|minValue=1|maxValue=3'];
    
    /**
     * @var array Rally point menu rules
     */
    const RALLY_POINT_MENU_RULES = ['t' => 'isInt|minValue=1|maxValue=3'];
    
    /**
     * @var array Rally point gold club menu rules
     */
    const RALLY_POINT_GOLDCLUB_MENU_RULES = ['t' => 'isInt|minValue=3|maxValue=3'];
    
    /**
     * @var array Marketplace actions
     */
    const MARKETPLACE_ACTIONS = [
        null => 'marketplaceDefault',
        1 => 'marketplaceBuy',
        2 => 'marketplaceOffer',
        3 => 'marketplaceNPCTrading',
        4 => 'marketplaceTradeRoutes'
    ];
    
    /**
     * @var array Palace and Residence actions
     */
    const COLONIZERS_ACTIONS = [
        null => 'colonizersTrain',
        1 => 'colonizersCulturePoints',
        3 => 'colonizersExpansion'
    ];
    
    /**
     * @var array Palace and Residence actions
     */
    const RALLY_POINT_ACTIONS = [
        null => 'rallyPointViewMovements',
        1 => 'rallyPointSendUnits',
        2 => 'rallyPointSimulator',
        3 => 'rallyPointGoldClub'
    ];
    
    /**
     * @var Validator
     */
    private $validator;
    
    /**
     * @var int
     */
    private $time;

    /**
     * @var ISessionBase
     */
    private $session;
    
    public function __construct(){
        parent::__construct();
        $this->validator = new Validator();

        // Create the Session
        $this->session = new Session(Database::getInstance());
        
        // Set the object creation time
        $this->time = time();
    }

    /**
     * Default build method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultBuild(array $parameters): array
    {
        if (isset($parameters['GET']['newdid'])) {
            $this->session->getUser()->changeSelectedVillage($parameters['GET']['newdid']);
        }

        $selectedVillage = new Village(
            Database::getInstance(),
            $this->session->getUser(),
            $this->session->getUser()->selectedVillage,
            false
        );

        // Initialize the whole village
        $selectedVillage->initAll();

        // Initialization
        $sameBuilding = 0;

        // Check if the same building is in the building queue
        foreach ($selectedVillage->getBuildingJobs() as $job) {
            // Exclude the demolition job
            if (
                $job->sort == BuildingJobEnums::IN_DEMOLITION || 
                $job->sort == BuildingJobEnums::IN_DEMOLITION_LOOP
            ) {
                continue;
            }
            
            if ($job->building->position == $parameters['GET']['id']) {
                $sameBuilding++;
            }
        }

        // Check what building the user is accessing
        foreach ($selectedVillage->getBuildings() as $building) {
            if (
                (isset($parameters['GET']['id']) && $building->position == $parameters['GET']['id']) ||
                (isset($parameters['GET']['gid']) && $building->id == $parameters['GET']['gid'])
            ) {
                // Create the building
                $selectedBuilding = BuildingsFactory::newBuilding(
                    $building->id,
                    $building->position,
                    $building->level
                );
                
                // Set the building ID
                $parameters['GET']['id'] = $building->position;

                break;
            }
        }    

        // If the building is more than level 0, check if an action can be executed
        if ($selectedBuilding->level > 0) {
            // Get the class method name to call
            $methodToCall = 'manage'.str_replace(' ', '', $selectedBuilding);
            $results = [];
            
            // Check if the method exists
            if (method_exists($this, $methodToCall)) {
                $selectedBuilding->setDatabase(Database::getInstance());
                $results = $this->$methodToCall($selectedBuilding, $selectedVillage, $parameters);
            }
        }

        // Increase building level
        $selectedBuilding->level += $sameBuilding + 1;
        
        // Get the village infomations
        $villageInformations = $this->getVillageInformations($selectedVillage);
        
        // Default informations
        $villageInformations['villageBuildingToUpgrade']['neededResources'] = $selectedBuilding->getNeededResources();
        $villageInformations['villageBuildingToUpgrade']['totalResources'] = array_sum($villageInformations['villageBuildingToUpgrade']['neededResources']);
        $villageInformations['villageBuildingToUpgrade']['neededTime'] = Generator::getTimeFormat($selectedBuilding->getNeededTime());
        $villageInformations['villageBuildingToUpgrade']['bonus'] = $selectedBuilding->getBonus();
        $villageInformations['villageBuildingToUpgrade']['level'] = $selectedBuilding->level;
        $villageInformations['villageBuildingToUpgrade']['isMax'] = $selectedBuilding->level > $selectedBuilding->maxLevel;
        $villageInformations['villageBuildingToUpgrade']['pop'] = $selectedBuilding->getUpkeep();

        // Check if the building can be upgraded
        $villageInformations['villageBuildingCanBeUpgraded'] = $selectedBuilding->canBeUpgraded(
            $selectedVillage
        );

        // Check if there are enough resources
        if ($villageInformations['villageBuildingCanBeUpgraded'] == BuildingEnums::NOT_ENOUGH_RESOURCES) {
            $villageInformations['villageBuildingToUpgrade']['neededResourcesTime'] = Generator::GetNeededResourcesTime(
                $selectedVillage->getResources(),
                $selectedBuilding->getNeededResources(),
                $selectedVillage->getProduction()
            );
        }
        
        // Return all informations to be displayed
        return array_merge_recursive(
            $results,
            $this->getSessionInformations($this->session),
            $villageInformations,
            $this->getVillagesInformations($this->session->getUser()->getVillages()),
            ['parameters' => ['id' => $parameters['GET']['id']]]
        );
    }

    public function manageMainBuilding(MainBuilding $building, Village $village, array $parameters): array
    {
        // Check if an offer a building demolition has been started/cancelled
        if (isset($parameters['POST']['demolish'])) {
            $building->startDemolition($village, $parameters['POST']);
        } elseif (isset($parameters['GET']['cancel'])) {
            $building->cancelDemolition($village, $parameters['GET']);
        }

        $buildingsInDemolition = $buildingsInConstruction = [];
        foreach ($village->getBuildingJobs() as $index => $job) {
            // Check if it's a demolition
            if (
                $job->sort != BuildingJobEnums::IN_DEMOLITION &&
                $job->sort != BuildingJobEnums::IN_DEMOLITION_LOOP
            ) {
                $buildingsInConstruction[$job->building->position] = true;
                continue;
            }

            $buildingsInDemolition[$index]['id'] = $job->id;
            $buildingsInDemolition[$index]['name'] = $job->building->name;
            $buildingsInDemolition[$index]['level'] = $job->building->level;
            $buildingsInDemolition[$index]['finished'] = Generator::getTimeFormat($job->timestamp - $this->time);
        }

        return [
            'villageBuildingsInConstruction' => $buildingsInConstruction,
            'villageBuildingsInDemolition' => $buildingsInDemolition
        ];
    }
    
    /**
     * Manage all marketplace related actions
     * 
     * @param Building $building
     * @param array $parameters
     * @return array
     */
    private function manageMarketplace(Marketplace $building, Village $village, array $parameters): array
    {
        // Check if the menu parameter is valid
        if (!empty($this->validator->validateInputs($parameters['GET'], self::MARKETPLACE_MENU_RULES))) {
            throw new InvalidParametersException();
        }
        
        // Check if the user is trying to access to a gold club feature
        if (
            empty($this->validator->validateInputs($parameters['GET'], self::MARKETPLACE_GOLDCLUB_MENU_RULES)) &&
            (!$village->owner->goldclub || $village->owner->getVillagesCount() == 1)
        ) {
            unset($parameters['GET']['t']);
        }

        //Initialize
        $action = self::MARKETPLACE_ACTIONS[$parameters['GET']['t']];
        $results = [];

        // Execute the marketplace selected action
        if (method_exists($this, $action)) {
            $results = $this->$action($building, $village, $parameters);
        }

        return array_merge_recursive(
            $results,
            ['parameters' => ['t' => $parameters['GET']['t']]]
        );   
    }
        
    /**
     * The default marketplace method
     * 
     * @return array
     */
    private function marketplaceDefault(Marketplace $building, Village $village, array $parameters): array
    {        
        $results = [];
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
            
            if (method_exists($building, $action)) {
                $results = $building->$action($village, $parameters['POST']);
            }
        }

        // Get the village merchants movements
        foreach ($village->getMovements() as $index => $movement) {
            // Filter trade movements only
            if(!$movement instanceof Trade && !$movement instanceof ReturningTrade)
            {
                continue;
            }
            
            if ($movement->from->vref == $village->vref) {
                $target = 'to';
                $tradeVillage = $movement->to;
            } else{
                if ($movement instanceof Trade) {
                    $target = 'from';
                } elseif ($movement instanceof ReturningTrade) {
                    $target = 'returning';
                }
                
                $tradeVillage = $movement->from;
            }
            
            $villageTrades[$target][$index]['villageName'] = $tradeVillage->name;
            $villageTrades[$target][$index]['villageOwner'] = $tradeVillage->owner->id;
            $villageTrades[$target][$index]['villageOwnerName'] = $tradeVillage->owner->username;
            $villageTrades[$target][$index]['resources'] = $movement->resources;
            $villageTrades[$target][$index]['vref'] = $tradeVillage->vref;
            $villageTrades[$target][$index]['time'] = Generator::getTimeFormat($movement->endTime - $this->time);
            $villageTrades[$target][$index]['timeString'] = Generator::procMtime($movement->endTime);
            $villageTrades[$target][$index]['mapCheck'] = Generator::getMapCheck($village->vref);
            $villageTrades[$target][$index]['repetitions'] = $movement->repetitions;
        }

        return array_merge(
            $parameters['POST'] ?? [],
            $results,
            ['villageMarketplaceTrades' => $villageTrades]
        );
    }
    
    /**
     * Buy a marketplace offer
     * 
     * @param Marketplace $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function marketPlaceBuy(Marketplace $building, Village $village, array $parameters): array
    {
        // Set the available offers
        $building->setAvailableOffers($village, $parameters);
        
        // Check if an offer has been accepted
        if (isset($parameters['GET']['g'])) {
            $building->acceptOffer($village, $parameters);
        }
        
        $villageOffers = [];
        foreach ($building->getAvailableOffers() as $index => $offer) {
            $villageOffers[$index]['id'] = $offer->id;
            $villageOffers[$index]['offered'] = $offer->resourceOffered;
            $villageOffers[$index]['offeredAmount'] = $offer->resourceOfferedAmount;
            $villageOffers[$index]['wanted'] = $offer->resourceWanted;
            $villageOffers[$index]['wantedAmount'] = $offer->resourceWantedAmount;
            $villageOffers[$index]['villageName'] = $offer->from->name;
            $villageOffers[$index]['villageVref'] = $offer->from->vref;
            $villageOffers[$index]['villageMapCheck'] = Generator::getMapCheck($offer->from->vref);
            $villageOffers[$index]['duration'] = Generator::getTimeFormat(Generator::getWalkingUnitsTime(
                $village,
                $offer->from
            ));
            $villageOffers[$index]['ownerUsername'] = $offer->from->owner->username;
            $villageOffers[$index]['error'] = $building->checkOffer($village, $offer);
        }
        
        // Set the total number of the offers
        $villageOffersCount = count($villageOffers);

        $results = [];
        
        return array_merge(
            $results,
            ['villageOffers' => $villageOffers],
            ['villageOffersCount' => $villageOffersCount],
            ['parameters' =>
                [
                    's' => $parameters['GET']['s'],
                    'v' => $parameters['GET']['v'],
                    'b' => $parameters['GET']['b'] 
                ]
            ]
        );
    }
    
    /**
     * Marketplace offers management
     * 
     * @param Marketplace $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function marketplaceOffer(Marketplace $building, Village $village, array $parameters): array
    {
        // Check if there's an action to execute
        // TODO: Don't repeat it every time
        $results = [];
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
            
            if (method_exists($building, $action)) {
                $results = $building->$action($village, $parameters['POST']);
            }
        }

        // Check if an offer has been removed
        if (isset($parameters['GET']['del'])) {
            $building->removeOffer($village, $parameters);
        }
        
        $villageOffers = [];
        foreach ($village->getMarketOffers() as $index => $offer) {
            $villageOffers[$index]['id'] = $offer->id;
            $villageOffers[$index]['offered'] = $offer->resourceOffered;
            $villageOffers[$index]['offeredAmount'] = $offer->resourceOfferedAmount;
            $villageOffers[$index]['wanted'] = $offer->resourceWanted;
            $villageOffers[$index]['merchants'] = $offer->merchants;
            $villageOffers[$index]['wantedAmount'] = $offer->resourceWantedAmount;
            $villageOffers[$index]['alliance'] = $offer->alliance;
            $villageOffers[$index]['maxTime'] = $offer->maxTime;
        }

        return array_merge(
            $results, 
            ['villageOffers' => $villageOffers]
        );
    }
    
    /**
     * Marketplace NPC Trading management
     * 
     * @param Marketplace $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function marketplaceNPCTrading(Marketplace $building, Village $village, array $parameters): array
    {
        // Check if there's an action to execute
        // TODO: Don't repeat it every time
        $results = [];
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
            
            if (method_exists($building, $action)) {
                $results = $building->$action($village, $parameters['POST']);
            }
        }

        return array_merge(
            $results,
            ['parameters' =>
                [
                    'r1' => $parameters['GET']['r1'],
                    'r2' => $parameters['GET']['r2'],
                    'r3' => $parameters['GET']['r3'],
                    'r4' => $parameters['GET']['r4']
                ]
            ]
        );
    }
    
    /**
     * Marketplace trade routes management
     * 
     * @param Marketplace $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function marketplaceTradeRoutes(Marketplace $building, Village $village, array $parameters): array
    {
        // Check if the gold club is active
        if (!$village->owner->goldclub) {
            return [];
        }
        
        // Check if there's an action to execute
        // TODO: Don't repeat it every time
        $results = [];
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
            
            if (method_exists($building, $action)) {
                $results = $building->$action($village, $parameters['POST']);
            }
        }
        
        $villageTradeRoutes = [];
        foreach ($village->getTradeRoutes() as $index => $tradeRoute) {
            $villageTradeRoutes[$index]['id'] = $tradeRoute->id;
            $villageTradeRoutes[$index]['villageVref'] = $tradeRoute->to->vref;
            $villageTradeRoutes[$index]['villageMapCheck'] = Generator::getMapCheck($tradeRoute->to->vref);
            $villageTradeRoutes[$index]['villageName'] = $tradeRoute->to->name;
            $villageTradeRoutes[$index]['start'] = $tradeRoute->start;
            $villageTradeRoutes[$index]['deliveries'] = $tradeRoute->deliveries;
            $villageTradeRoutes[$index]['merchants'] = ceil(($tradeRoute->getTotalResources() - 0.1) / $village->getMerchants()['maxCarry']);
            $villageTradeRoutes[$index]['timeLeft'] = max(0, ceil(($tradeRoute->timeLeft - $this->time) / 86400));
        }
        
        return array_merge(
            $results,
            ['villageTradeRoutes' => $villageTradeRoutes]
        );
    }
    
    /**
     * Manage all training-like buildings
     * 
     * @param TrainingField $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function manageTrainingField(TrainingField $building, Village $village, array $parameters): array
    {
        // Check if units need to be trained
        if (isset($parameters['POST']['action']) && $parameters['POST']['action'] == 'train') {
            $building->train($village, $parameters['POST']);
        }

        return [
            'villageUnitsToTrainClass' => $building->unitToTrainClass,
            'villageUnitsToTrainGreat' => $building->unitToTrainGreat
        ];
    }
    
    private function manageAcademy(Academy $building, Village $village, array $parameters): array
    {
        // Check if there's a research to start
        if (isset($parameters['GET']['a'])) {
            $building->research($village, $parameters['GET']);
        }

        $villageResearches = [];
        foreach ($village->getResearches() as $unit => $research) {
            if ($research->getState() == ResearchEnums::NOT_YET_RESEARCHED) {
                if ($research->canBeResearched($village->getBuildings())) {
                    $state = 'available';

                    $villageResearches[$state][$unit]['neededTime'] = Generator::getTimeFormat($research->researchTime);
                    $villageResearches[$state][$unit]['neededResources'] = $research->researchNeededResources;
                    $villageResearches[$state][$unit]['totalResources'] = array_sum($research->researchNeededResources);
                    $villageResearches[$state][$unit]['error'] = $building->checkResearch($village, $research);
                } else {
                    $state = 'notAvailable';
                    
                    foreach ($research->requirements as $buildingID => $buildingLevel) {
                        $neededBuilding = BuildingsFactory::newBuilding($buildingID, 0, $buildingLevel);

                        $villageResearches[$state][$unit]['buildingsNeeded'][$buildingID]['name'] = $neededBuilding->name;
                        $villageResearches[$state][$unit]['buildingsNeeded'][$buildingID]['level'] = $buildingLevel;
                    }
                }
            } elseif ($research->getState() == ResearchEnums::IN_RESEARCH) {
                $state = 'inResearch';
                $villageResearches[$state][$unit]['time'] = Generator::getTimeFormat($research->getValue() - $this->time);
                $villageResearches[$state][$unit]['finishTime'] = Generator::procMtime($research->getValue())[1];
            } else {
                $state = 'researched';
            }
            
            $villageResearches[$state][$unit]['name'] = $research->unit->name;
        }

        return ['villageResearches' => $villageResearches];
    }
    
    /**
     * Manage the Residence and the Palace
     * 
     * @param Academy $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function manageColonizers(Building $building, Village $village, array $parameters): array
    {
        // Check if the menu parameter is valid
        if (!empty($this->validator->validateInputs($parameters['GET'], self::COLONIZERS_MENU_RULES))) {
            throw new InvalidParametersException();
        }

        //Initialize
        $action = self::COLONIZERS_ACTIONS[$parameters['GET']['s']];
        $results = [];

        // Execute the colonizers selected action
        if (method_exists($this, $action)) {
            $results = $this->$action($building, $village, $parameters);
        }
        
        // Check if the building can change the actual capital
        $canChangeCapital = $building instanceof Palace;

        return array_merge( 
            $results ?? [],
            [
                'parameters' => [
                    's' => $parameters['GET']['s'],
                    'confirm' => $parameters['GET']['confirm']
                ],
                'canChangeCapital' => $canChangeCapital
            ]
        );
    }
    
    /**
     * Train the colonizer units/Change the capital
     * 
     * @param TrainingField $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function colonizersTrain(TrainingField $building, Village $village, array $parameters): array
    {
        $error = '';
        // Check if the capital must be changed
        if (
            $building instanceof Palace && 
            isset($parameters['POST']['action']) &&
            $parameters['POST']['action'] == 'changeCapital'
        ) {
            $error = $building->changeCapital($village, $parameters['POST']);
        }

        // Check trainings
        return array_merge(
            $this->manageTrainingField($building, $village, $parameters),
            ['error' => $error]
        );
    }
    
    /**
     * Set the buildings and the culture points production of every village
     */
    private function colonizersCulturePoints()
    {
        foreach ($this->session->getUser()->getVillages() as $villageToInit) {
            $villageToInit->setBuildings();
            $villageToInit->setCulturePointsProduction();
        }
    }
    
    /**
     * Get the expansion villages
     * 
     * @param Building $building
     * @param Village $village
     * @return array
     */
    private function colonizersExpansion(Building $building, Village $village): array
    {
        // Init the expansion villages
        $expansionVillages = new Villages($building->getDatabase());
        $expansionVillages->initByVrefs($village->expansionSlots);
        
        $villageExpansions = [];
        foreach ($expansionVillages->getVillages() as $index => $village) {
            $villageExpansions[$index]['villageName'] = $village->name;
            $villageExpansions[$index]['villageVref'] = $village->vref;
            $villageExpansions[$index]['villagePop'] = $village->pop;
            $villageExpansions[$index]['villageCreated'] = date('d.m.Y', $village->created);
            $villageExpansions[$index]['villageMapCheck'] = Generator::getMapCheck($village->vref);
            $villageExpansions[$index]['ownerUsername'] = $village->owner->username;
            $villageExpansions[$index]['owner'] = $village->owner->id;
            $villageExpansions[$index]['villageCoordinates'] = $village->coordinates;
        }
        
        return ['villageExpansions' => $villageExpansions];
    }
    
    /**
     * Manage the rally point
     * 
     * @param RallyPoint $building
     * @param Village $village
     * @param array $parameters
     * @throws InvalidParametersException
     * @return array
     */
    private function manageRallyPoint(RallyPoint $building, Village $village, array $parameters): array
    {
        // Check if the menu parameter is valid
        if (!empty($this->validator->validateInputs($parameters['GET'], self::RALLY_POINT_MENU_RULES))) {
            throw new InvalidParametersException();
        }

        // Check if the user is trying to access a gold club feature
        if (
            empty($this->validator->validateInputs($parameters['GET'], self::RALLY_POINT_GOLDCLUB_MENU_RULES)) &&
            !$village->owner->goldclub
        ) {
            unset($parameters['GET']['t']);
        }

        //Initialize
        $action = self::RALLY_POINT_ACTIONS[$parameters['GET']['t']];
        $results = [];

        // Execute the rally point selected action
        if (method_exists($this, $action)) {
            $results = $this->$action($building, $village, $parameters);
        }

        return array_merge_recursive(
            $results,
            ['parameters' => ['t' => $parameters['GET']['t']]]
        ); 
    }
    
    /**
     * View the rally point movements
     * 
     * @param RallyPoint $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function rallyPointViewMovements(RallyPoint $building, Village $village, array $parameters): array
    {
    	// Check if there is a movement to send
    	$results = $this->rallyPointSendUnits($building, $village, $parameters);
    	
    	return $results ?? [];
    }

    /**
     * Send units to another village
     * 
     * @param RallyPoint $building
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    private function rallyPointSendUnits(RallyPoint $building, Village $village, array $parameters): array 
    {
    	// Check if there's an action to execute
    	// TODO: Don't repeat it every time
    	if (isset($parameters['POST']['action'])) {
    		$action = $parameters['POST']['action'];
    		if (method_exists($building, $action)) {
    			$results = $building->$action($village, $parameters['POST']);
    		}
    	}

    	return $results ?? [];
    }
    
    /**
     * Manage the gold club functions (raid list, etc.)
     * 
     * @param Building $building
     * @param Village $village
     * @return array
     */
    private function rallyPointGoldClub(RallyPoint $building, Village $village, array $parameters): array 
    {
        // Check if the user has got the gold club
        if (!$village->owner->goldclub) {
            return [];
        }

        // Set the user's reports and farmlists
        $this->session->getUser()->setReports();
        $this->session->getUser()->setFarmLists();

        // Set the User's units, enforcements, upkeep of every village
        foreach ($this->session->getUser()->getVillages() as $villageToSet) {
            $villageToSet->setUnits();
            $villageToSet->setEnforcements();
            $villageToSet->setUpkeep();
        }
        
        // Check if there's an action to execute
        // TODO: Don't repeat it every time
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
            if (method_exists($building, $action)) {
                $results = $building->$action($village, $parameters['POST']);
            }
        } elseif (isset($parameters['GET']['raidList'])) {
            $results = $building->editFarmListRaid($village, $parameters['GET']);
        } elseif (isset($parameters['GET']['delFarmList'])) {
            $results = $building->deleteFarmList($village, $parameters['GET']);
        }

        // Initialize
        $farmLists = [];
        $lastAttackedTargets = [];
        $units = [];

        // Set the farm lists
        foreach ($this->session->getUser()->getFarmLists() as $index => $farmList) {
            $farmLists[$index]['id'] = $farmList->id;
            $farmLists[$index]['name'] = $farmList->name;
            $farmLists[$index]['fromVillageName'] = $farmList->from->name;
            
            // Set the raids list
            foreach ($farmList->raidsList as $raidIndex => $raid) {
                $farmLists[$index]['raidsList'][$raidIndex]['id'] = $raid->id;
                $farmLists[$index]['raidsList'][$raidIndex]['toVillageName'] = $raid->to->name;
                $farmLists[$index]['raidsList'][$raidIndex]['toVillageCoordinates'] = $raid->to->coordinates;
                $farmLists[$index]['raidsList'][$raidIndex]['toVillagePop'] = $raid->to->pop;
                $farmLists[$index]['raidsList'][$raidIndex]['toVillageDistance'] = Generator::getDistance(
                    $farmList->from->coordinates, $raid->to->coordinates
                );
                
                if (!is_null($raid->lastReport)) {
                    $farmLists[$index]['raidsList'][$raidIndex]['lastReport']['id'] = $raid->lastReport->id;
                    $farmLists[$index]['raidsList'][$raidIndex]['lastReport']['type'] = $raid->lastReport->type;
                    $farmLists[$index]['raidsList'][$raidIndex]['lastReport']['topic'] = $raid->lastReport->topic;
                    $farmLists[$index]['raidsList'][$raidIndex]['lastReport']['time'] = [
                        Generator::procMtime($raid->lastReport->time)[0],
                        date('H:i', $raid->lastReport->time)
                    ];
                    $farmLists[$index]['raidsList'][$raidIndex]['lastReport']['robbedResources'] = $raid->lastReport->getTotalRobbedResources();
                    $farmLists[$index]['raidsList'][$raidIndex]['lastReport']['maxCarry'] = $raid->lastReport->getMaxCarry();
                }
                
                // Set the raid units
                foreach ($raid->getUnits() as $unitIndex => $unit) {
                    $farmLists[$index]['raidsList'][$raidIndex]['units'][$unitIndex]['name'] = $unit->name;
                    $farmLists[$index]['raidsList'][$raidIndex]['units'][$unitIndex]['amount'] = $unit->amount;
                }
                
                // Check if the village is being raided
                foreach ($village->getMovements() as $movement) {
                    if (
                        $movement->to->vref == $raid->to->vref &&
                        $movement instanceof Raid
                    ) {
                        $farmLists[$index]['raidsList'][$raidIndex]['isBeingRaided'] = true;
                        break;
                    }
                }
            }
        }

        return array_merge(
            $results ?? [],
            ['villageFarmLists' => $farmLists]
        );
    }
    
    /**
     * Manage the brewery
     * 
     * @param Brewery $building
     * @param Village $village
     * @param array $parameters
     */
    public function manageBrewery(Brewery $building, Village $village, array $parameters)
    {        
        // Check if there's an action to execute
        // TODO: Don't repeat it every time
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
            if (method_exists($building, $action)) {
                $results = $building->$action($village, $parameters['POST']);
            }
        }

        return [
            'beerFest' => [
                'neededResources' => BeerFest::NEEDED_RESOURCES,
                'duration' => Generator::getTimeFormat(BeerFest::BASE_DURATION),
                'error' => $village->owner->isBeerFestActive() ?
                Generator::getTimeFormat($village->owner->getBeerFestEndTime() - $this->time) :
                (empty($building->checkEnoughBeerFestResources($village)) ? TOO_FEW_RESOURCES : '')
            ]
        ];       
    }
}
