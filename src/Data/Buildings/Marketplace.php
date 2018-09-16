<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Entity\Building;
use TravianZ\Entity\Village;
use TravianZ\Data\Validator;
use TravianZ\Utils\Generator;
use TravianZ\Enums\VillageEnums;
use TravianZ\Data\Movements\Trade;
use TravianZ\Entity\User;
use TravianZ\Entity\Offer;
use TravianZ\Entity\TradeRoute;

final class Marketplace extends Building
{
    
    const PREPARE_TRADE_RULES = [
        'wood' => 'isInt|minValue=0',
        'clay' => 'isInt|minValue=0',
        'iron' => 'isInt|minValue=0',
        'crop' => 'isInt|minValue=0',
        'repetitions' => 'isInt|minValue=1|maxValue=3',
        'villageVref' => 'isInt|minValue=1'
    ];
    
    const FIRST_RESOURCE_FILTER_RULES = [
        's' => 'isRequired|isInt|minValue=1|maxValue=4'
    ];
    
    const SECOND_RESOURCE_FILTER_RULES = [
        'b' => 'isRequired|isInt|minValue=1|maxValue=4'
    ];
    
    const RATIO_FILTER_RULES = [
        'v' => 'isRequired|isInt|minValue=1|maxValue=1'
    ];
    
    const ACCEPT_OFFER_RULES = [
        'g' => 'isRequired|isInt|minValue=1'
    ];
    
    const ADD_OFFER_RULES = [
        'm1' => 'isRequired|isInt|minValue=1',
        'm2' => 'isRequired|isInt|minValue=1',
        'rid1' => 'isRequired|isInt|minValue=1|maxValue=4',
        'rid2' => 'isRequired|isInt|minValue=1|maxValue=4',
        'ally' => 'isInt|minValue=1'
    ];
    
    const REMOVE_OFFER_RULES = [
        'del' => 'isRequired|isInt|minValue=1'
    ];
    
    const TRADE_NPC_RESOURCES_RULES = [
        '0' => 'isRequired|isInt|minValue=0',
        '1' => 'isRequired|isInt|minValue=0',
        '2' => 'isRequired|isInt|minValue=0',
        '3' => 'isRequired|isInt|minValue=0',
    ];
    
    const TRADE_ROUTE_RULES = [
        'routeid' => 'isRequired|isInt|minValue=1'
    ];
    
    const UPDATE_TRADE_ROUTE_RULES = [
        'routeid' => 'isRequired|isInt|minValue=1',
        'wood' => 'isInt|minValue=0',
        'clay' => 'isInt|minValue=0',
        'iron' => 'isInt|minValue=0',
        'crop' => 'isInt|minValue=0',
        'start' => 'isRequired|isInt|minValue=0|maxValue=23',
        'deliveries' => 'isRequired|isInt|minValue=1|maxValue=3'
    ];
    
    const NEW_TRADE_ROUTE_RULES = [
        'tvillage' => 'isInt|minValue=1',
        'wood' => 'isInt|minValue=0',
        'clay' => 'isInt|minValue=0',
        'iron' => 'isInt|minValue=0',
        'crop' => 'isInt|minValue=0',
        'start' => 'isRequired|isInt|minValue=0|maxValue=23',
        'deliveries' => 'isRequired|isInt|minValue=1|maxValue=3'
    ];
    
    /**
     * @var array The available market offers
     */
    private $availableOffers;
    
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
     * Get the available offers
     * 
     * @return array
     */
    public function getAvailableOffers(): array
    {
        return $this->availableOffers;
    }
    
    /**
     * Set the available offers
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function setAvailableOffers(Village $village, array $parameters)
    {
        $sql = 'SELECT
                    market.*, village.name as villageName, users.id as owner, users.username, users.tribe,
                    wdata.x, wdata.y
                FROM
                    ' . TB_PREFIX . 'market as market
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as village
                ON
                    village.wref = market.vref
                LEFT JOIN
                    ' . TB_PREFIX . 'wdata as wdata
                ON
                    wdata.id = village.wref
                LEFT JOIN
                    ' . TB_PREFIX . 'users as users
                ON
                    users.id = village.owner
                WHERE
                    market.accept = 0 AND market.vref != ? AND (market.alliance = ? OR market.alliance = 0)';
        
        $res = $this->getDatabase()->queryNew($sql, $village->vref, $village->owner->alliance);
        
        // Reset the actual offers
        $this->availableOffers = [];
        
        // Check if there's at least one offer
        if (empty($res)) {
            return;
        }
        
        foreach ($res as $offer) {
            // Create the village
            $offerVillage = new Village(
                $this->getDatabase(),
                new User($this->getDatabase(), [$offer['owner'], $offer['username'], $offer['tribe']], false, false),
                $offer['vref'],
                $offer['villageName'],
                false,
                false,
                0,
                0,
                0,
                0,
                0,
                0,
                [],
                ['x' => $offer['x'], 'y' => $offer['y']]
            );
            
            // Filter the offers
            if (
                (empty($this->validator->validateInputs($parameters['GET'], self::FIRST_RESOURCE_FILTER_RULES)) &&
                    $offer['offered'] != $parameters['GET']['s']) ||
                (empty($this->validator->validateInputs($parameters['GET'], self::SECOND_RESOURCE_FILTER_RULES)) &&
                    $offer['wanted'] != $parameters['GET']['b']) ||
                (empty($this->validator->validateInputs($parameters['GET'], self::RATIO_FILTER_RULES)) &&
                    $offer['offeredAmount'] != $offer['wantedAmount']) ||
                    ($offer['maxtime'] > 0 &&
                    Generator::getWalkingUnitsTime(
                        $village,
                        $offerVillage
                    ) > $offer['maxtime'] * 3600)
            ) {
                continue;
            }

            $this->availableOffers[] = new Offer(
                $this->getDatabase(),
                $offer['id'],
                $offerVillage,
                $offer['offered'],
                $offer['offeredAmount'],
                $offer['wanted'],
                $offer['wantedAmount'],
                $offer['maxtime'],
                $offer['alliance'],
                $offer['merchants']
            );
        }
    }
    
    /**
     * Remove an available offer
     *
     * @return array
     */
    public function removeAvailableOffer(int $offerIndex)
    {
        unset($this->availableOffers[$offerIndex]);
    }
    
    /**
     * Prepare a trade
     * 
     * @param array $parameters The given parameters
     * @return 
     */
    public function prepareTrade(Village $village, array $parameters): array
    {        
        //Validate the parameters
        $errors = $this->validator->validateInputs($parameters, self::PREPARE_TRADE_RULES);

        if (!empty($errors)) {
            return ['error' => RESOURCES_NO_SELECTED];
        }
        
        $totalResources = 0;
        foreach ($village->getResources() as $key => $value) {
            // If empty, set it to 0
            if ($parameters[$key] == '') {
                $parameters[$key] = 0;
            }

            // Check if the inserted resources, are more than the owned ones
            if (
                $parameters[$key] > 0 &&
                $parameters[$key] > $value
            ) {
                return ['error' => TOO_FEW_RESOURCES];               
            }
            
            $totalResources += $parameters[$key];
        }

        if ($totalResources > $village->getMerchants()['maxCarry'] * $village->getMerchants()['available'])
        {
            return ['error' => TOO_FEW_MERCHANTS];
        } elseif($totalResources == 0) {
            return ['error' => RESOURCES_NO_SELECTED];
        }

        if ($parameters['x'] != '' && $parameters['y'] != '' ) {
            $targetVillage = new Village(
                $this->getDatabase(),
                null, 
                Generator::getBaseID($parameters['x'], $parameters['y']),
                ''
            );
        } elseif ($parameters['villageName'] != '') {
            $targetVillage = new Village($this->getDatabase(), null, 0, $parameters['villageName']);
        } elseif ($parameters['villageVref'] > 0) {
            $targetVillage = new Village($this->getDatabase(), null, $parameters['villageVref']);
        } else {
            return ['error' => ENTER_COORDINATES];
        }

        if ($targetVillage->getState() == VillageEnums::DOES_NOT_EXIST) {
            return ['error' => NO_COORDINATES_SELECTED];
        } elseif ($targetVillage->owner->isBanned() || ($targetVillage->owner->isAdmin() && !ADMIN_ALLOW_INCOMING_RAIDS)) {
            return ['error' => BANNED_CANNOT_SEND_RESOURCES];
        } elseif ($targetVillage->vref == $village->vref) {
            return ['error' => CANNOT_SEND_RESOURCES];
        } elseif (!empty($parameters['repetitions']) && !$village->owner->goldclub) {
            return ['error' => CANNOT_USE_GOLDCLUB_FEATURES];
        } elseif($targetVillage->owner->isOnVacation()) {
            return ['error' => PLAYER_ON_VACATION];
        }

        $neededTime = Generator::getWalkingUnitsTime(
            $village,
            $targetVillage
        );
        
        return [
            'tradeSecondPhase' => true,
            'tradeOwner' => $targetVillage->owner->id,
            'tradeOwnerUsername' => $targetVillage->owner->username,
            'tradeVref' => $targetVillage->vref,
            'tradeMapCheck' => Generator::getMapCheck($targetVillage->vref),
            'tradeVillageName' => $targetVillage->name,
            'tradeVillageCoordinates' => $targetVillage->coordinates,
            'tradeNeededMerchants' => ceil(($totalResources - 0.1) / $village->getMerchants()['maxCarry']),
            'tradeTime' => $neededTime,
            'tradeResources' => [$parameters['wood'], $parameters['clay'], $parameters['iron'], $parameters['crop']],
            'tradeDuration' => Generator::getTimeFormat($neededTime),
            'tradeRepetitions' => $parameters['repetitions'] == '' ? 0 : $parameters['repetitions']
        ];
    }

    /**
     * Send a trade
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function sendTrade(Village $village, array $parameters): array
    {
        // Check the trade validity
        $checkTrade = $this->prepareTrade($village, $parameters);

        // Check if there is an error
        if (in_array('error', array_keys($checkTrade))) {
            return $checkTrade;
        }
        
        // There are no errors, the movement can be confirmed
        $time = time();

        // Create the movement
        $trade = new Trade(
            $this->getDatabase(), 
            0, 
            $village, 
            new Village(
                $this->getDatabase(),
                new User(
                    $this->getDatabase(), 
                    [$checkTrade['tradeOwner'], $checkTrade['tradeOwnerUsername'], 0],
                    false
                ), 
                $checkTrade['tradeVref'], 
                $checkTrade['tradeVillageName'], 
                false,
                false
            ), 
            $time, 
            $time + $checkTrade['tradeTime'], 
            $checkTrade['tradeResources'],
            $checkTrade['tradeNeededMerchants'],
            $checkTrade['tradeRepetitions']
        );
        
        // Add the movement to the database
        $trade->add();
        
        // Add the movement to the village
        $village->addMovement($trade);  
        
        // Update the village merchants
        $village->setMerchants();
        
        return [];
    }
    
    /**
     * Check an offer validity
     * 
     * @param Village $village
     * @param Offer $offer
     * @return string Returns an error or an empty string on a success
     */
    public function checkOffer(Village $village, Offer $offer): string
    {
        if ($offer->resourceWantedAmount > $village->getMerchants()['available'] * $village->getMerchants()['maxCarry']) {
            return NOT_ENOUGH_MERCHANTS;
        } elseif ($village->getResources()[array_keys($village->getResources())[$offer->resourceWanted - 1]] < $offer->resourceWantedAmount) {
            return NOT_ENOUGH_RESOURCES;
        }
        
        return '';
    }
    
    /**
     * Accept an offer
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function acceptOffer(Village $village, array $parameters)
    {
        // Check if the offer is valid
        if (!empty($this->validator->validateInputs($parameters['GET'], self::ACCEPT_OFFER_RULES))) {
            return;
        }

        // Search the offer
        $offerToAccept = null;
        foreach ($this->availableOffers as $index => $offer) {
            if ($offer->id == $parameters['GET']['g']) {
                $offerToAccept = $offer;
                $offerIndex = $index;
                break;
            }
        }
        
        // Check if the offer exists
        if (is_null($offerToAccept)) {
            return;
        }
        
        // Set the time variable
        $time = time();

        // Create the two movements
        $acceptedResourcesTrade = new Trade(
            $this->getDatabase(), 
            0, 
            $village, 
            $offerToAccept->from, 
            $time, 
            $time + Generator::getWalkingUnitsTime($village, $offerToAccept->from), 
            [$offerToAccept->resourceWanted - 1 => $offerToAccept->resourceWantedAmount],
            ceil(($offerToAccept->resourceWantedAmount - 0.1) / $village->getMerchants()['maxCarry']), 
            1
        );

        // Set the resource to be offered
        $offeredResourcesTrade = new Trade(
            $this->getDatabase(),
            0,
            $offerToAccept->from,
            $village,
            $time,
            $time + Generator::getWalkingUnitsTime($offerToAccept->from, $village),
            [$offerToAccept->resourceOffered - 1 => $offerToAccept->resourceOfferedAmount],
            $offerToAccept->merchants,
            1
        );

        // Add them to the database
        $acceptedResourcesTrade->add();
        $offeredResourcesTrade->add();

        // Add them locally
        $village->addMovement($acceptedResourcesTrade);
        $village->addMovement($offeredResourcesTrade);
        
        // Accept the offer
        $offerToAccept->accept();
        
        // Remove the offer
        $this->removeAvailableOffer($offerIndex);
        
        // Update the village resources
        $village->updateResources(
            [
                array_keys(
                    $village->getResources()
                    )[$offerToAccept->resourceWanted - 1] => -$offerToAccept->resourceWantedAmount
            ]
        );
        
        // Update the village merchants
        $village->setMerchants();
    }
    
    /**
     * Add an offer
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function addOffer(Village $village, array $parameters): array
    {
        // Check if the inputs are valid
        if (!empty($this->validator->validateInputs($parameters, self::ADD_OFFER_RULES))) {
            return ['error' => RESOURCES_NO_SELECTED];
        }
        
        // Check if the maximum (x2) and minimum (x0.5) ratio is being respected
        if (
            ($parameters['m1'] > 2 * $parameters['m2']) || 
            ($parameters['m2'] > 2 * $parameters['m1'])
        ) {
            return ['error' => INVALID_RATIO];
        } elseif ($parameters['rid1'] == $parameters['rid2']) {
            return ['error' => CANNOT_SELECT_SAME_RESOURCE];
        } elseif (
            $village->getResources()[array_keys($village->getResources())[$parameters['rid1'] - 1]] < $parameters['m1']
        ) { // Check if the village has enough resources
            return ['error' => NOT_ENOUGH_RESOURCES];
        } elseif (
            $parameters['m1'] > $village->getMerchants()['available'] * $village->getMerchants()['maxCarry']
        ) { // Check if the village has enough merchants
            return ['error' => TOO_FEW_MERCHANTS];
        } elseif ($parameters['d1'] == 1 && ($parameters['d2'] < 1 || $parameters['d2'] > 99)) {
            return ['error' => INVALID_MAXIMUM_TIME];
        } elseif ($parameters['ally'] == 1 && !$village->owner->alliance) {
            return ['error' => ACTUALLY_NOT_IN_ALLY];
        }

        // Create the offer
        $offerToAdd = new Offer(
            $this->getDatabase(), 
            0, 
            $village,
            $parameters['rid1'],
            $parameters['m1'],
            $parameters['rid2'], 
            $parameters['m2'], 
            $parameters['d1'] == 1 ? $parameters['d2'] : 0, 
            $parameters['ally'] == 1 ? $village->owner->alliance : 0, 
            ceil(($parameters['m1'] - 0.1) / $village->getMerchants()['maxCarry'])
        );
        
        // Add it to the database
        $offerToAdd->add();
        
        // Add it locally
        $village->addMarketOffer($offerToAdd);

        // Update the village resources
        $village->updateResources(
            [
                array_keys($village->getResources())[$parameters['rid1'] - 1] => -$parameters['m1'] 
            ]
        );
        
        // Update the merchants
        $village->setMerchants();
        
        return [];
    }
    
    public function removeOffer(Village $village, array $parameters)
    {
        // Check if the offer is valid
        if (!empty($this->validator->validateInputs($parameters['GET'], self::REMOVE_OFFER_RULES))) {
            return;
        }
        
        // Search the offer
        foreach ($village->getMarketOffers() as $index => $offer) {
            if ($offer->id == $parameters['GET']['del']) {
                // Delete the offer from the database
                $offer->delete();
                
                // Update the village resources
                $village->updateResources(
                    [
                        array_keys($village->getResources())[$offer->resourceOffered - 1] => $offer->resourceOfferedAmount
                    ]
                );           
                
                // Delete the offer locally
                $village->removeMarketOffer($index); 
                
                // Set the new merchants
                $village->setMerchants();

                return;
            }
        }
    }
    
    public function tradeNPCResources(Village $village, array $parameters): array
    {
        // Check if it's a WW village
        if ($village->isNatar) {
            return ['error' => CANNOT_NPC_WW_VILLAGE];
        }

        // Check if the user has at least 3 golds
        if ($village->owner->gold < 3) {
            return ['error' => NOT_ENOUGH_GOLDS];
        }

        // Check if the trading is valid
        if (
            !empty($parameters['m2']) &&
            !empty($this->validator->validateInputs($parameters['m2'], self::TRADE_NPC_RESOURCES_RULES))
        ) {
            return ['error' => RESOURCES_NO_SELECTED];
        }

        // Initialize
        $resourcesToAdd = [];
        $totalResources = 0;
        
        // Count the total resources and create a new array
        for ($i = 0; $i <= 3; $i++) {
            // Set the resource key
            $key = array_keys($village->getResources())[$i];

            // Count the total resources
            $totalResources += $parameters['m2'][$i];
            
            // Add the new resource value to the array
            $resourcesToAdd[$key] = $parameters['m2'][$i] - $village->getResources()[$key];
        }

        // Check if the total resources are more than the village ones
        if ($totalResources > $village->getTotalResources()) {
            return ['error' => TOO_MUCH_RESOURCES];
        }
        
        // Check if the inserted resources should be rebalanced
        while (true) {
            foreach ($village->getResources() as $key => $value) {
                if ($totalResources == $village->getTotalResources()) {
                    break 2;
                }
                
                if (
                    ($key == 'crop' && $resourcesToAdd[$key] + 1 <= $village->maxCrop) || 
                    ($key != 'crop' && $resourcesToAdd[$key] + 1 <= $village->maxStore)
                ) {
                    $resourcesToAdd[$key]++;
                    $totalResources++;
                }
            }
        }
        
        // Update the village resources
        $village->updateResources($resourcesToAdd);
        
        //Update the user golds
        $village->owner->gold -= 3;
        $village->owner->setUserFields(['gold'], [$village->owner->gold]);
        
        return ['npcCompleted' => true];
    }
    
    /**
     * Create a new trade route
     */
    public function createTradeRoute(Village $village): array
    {
        // Check if the user has at least 2 golds
        if ($village->owner->gold < 2) {
            return [
                'error' => NOT_ENOUGH_GOLDS,
                'createTradeRoute' => false
            ];
        }

        return ['createTradeRoute' => true];
    }
    
    /**
     * Add a new trade route
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function addTradeRoute(Village $village, array $parameters): array
    {        
        // Check if the user has at least 2 golds
        if ($village->owner->gold < 2) {
            return [
                'error' => NOT_ENOUGH_GOLDS,
                'createTradeRoute' => false
            ];
        }

        // Check the parameters validity
        if (!empty($this->validator->validateInputs($parameters, self::NEW_TRADE_ROUTE_RULES))) {
            return [
                'error' => INVALID_TRADE_ROUTE,
                'createTradeRoute' => true
            ];
        }
        
        //Initialize
        $totalResources = 0;

        // Count the total resources
        foreach ($village->getResources() as $key => $value) {
            $totalResources += $parameters[$key];
        }

        // Check if there are more than 0 resources
        if ($totalResources == 0) {
            return [
                'error' => NO_INSERTED_RESOURCES,
                'createTradeRoute' => true
            ];
        }
        
        // Check if the village is not the actual village
        if ($parameters['tvillage'] == $village->owner->selectedVillage) {
            return [
                'error' => CANNOT_SEND_RESOURCES,
                'createTradeRoute' => true
            ];
        }
        
        // Check if the village is valid
        foreach ($village->owner->getVillages() as $searchedVillage) {
            // Check if the village corresponds
            if ($searchedVillage->vref == $parameters['tvillage']) {
                // Initialize the time variable
                $time = time();
                
                // Create the trade route
                $tradeRouteToAdd = new TradeRoute(
                    $this->getDatabase(), 
                    0, 
                    $village,
                    $searchedVillage,
                    [$parameters['wood'], $parameters['clay'], $parameters['iron'], $parameters['crop']],
                    $parameters['start'],
                    $parameters['deliveries'],
                    $time,
                    $time + 604800
                );
 
                // Add the trade route to the database
                $tradeRouteToAdd->add();
                
                // Add the trade route locally
                $village->addTradeRoute($tradeRouteToAdd);
                
                // Update the user's golds
                $village->owner->gold -= 2;
                $village->owner->setUserFields(['gold'], [$village->owner->gold]);

                return ['createTradeRoute' => false];
            }
        }

        // If the trade village wasn't found
        return [
            'error' => INVALID_VILLAGE,
            'createTradeRoute' => true
        ];
    }
    
    /**
     * Extend a trade route
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function extendTradeRoute(Village $village, array $parameters): array
    {
        // Check if the user has at least 2 golds
        if ($village->owner->gold < 2) {
            return ['error' => NOT_ENOUGH_GOLDS];
        }
        
        // Check if the trade route is valid
        if (!empty($this->validator->validateInputs($parameters, self::TRADE_ROUTE_RULES))) {
            return ['error' => INVALID_TRADE_ROUTE];
        }
        
        // Search the trade route
        foreach ($village->getTradeRoutes() as $tradeRoute) {
            if ($tradeRoute->id == $parameters['routeid']) {
                // Extend the trade route
                $tradeRoute->extend();
                
                // Update the user's golds
                $village->owner->gold -= 2;
                $village->owner->setUserFields(['gold'], [$village->owner->gold]);

                return ['lastRouteID' => $tradeRoute->id];
            }
        }
        
        // If the trade route wasn't found
        return ['error' => INVALID_TRADE_ROUTE];
    }
    
    /**
     * Delete a trade route
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function deleteTradeRoute(Village $village, array $parameters): array
    {        
        // Check if the trade route is valid
        if (!empty($this->validator->validateInputs($parameters, self::TRADE_ROUTE_RULES))) {
            return ['error' => INVALID_TRADE_ROUTE];
        }
        
        // Search the trade route
        foreach ($village->getTradeRoutes() as $index => $tradeRoute) {
            if ($tradeRoute->id == $parameters['routeid']) {
                // Delete the trade route
                $tradeRoute->delete();

                // Delete the trade route locally
                $village->removeTradeRoute($index);

                return ['lastRouteID' => 0];
            }
        }

        // If the trade route wasn't found
        return ['error' => INVALID_TRADE_ROUTE];
    }
    
    /**
     * Edit a trade route
     *
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function editTradeRoute(Village $village, array $parameters): array
    {
        // Check if the trade route is valid
        if (!empty($this->validator->validateInputs($parameters, self::TRADE_ROUTE_RULES))) {
            return [
                'error' => INVALID_TRADE_ROUTE,
                'editTradeRoute' => false
            ];
        }
        
        // Search the trade route
        foreach ($village->getTradeRoutes() as $tradeRoute) {
            if ($tradeRoute->id == $parameters['routeid']) {                
                return [
                    'tradeRoute' => [
                        'id' => $tradeRoute->id,
                        'resources' => $tradeRoute->getResources(),
                        'start' => $tradeRoute->start,
                        'deliveries' => $tradeRoute->deliveries
                    ],
                    'editTradeRoute' => true
                ];
            }
        }

        // If the trade route wasn't found
        return [
            'error' => INVALID_TRADE_ROUTE,
            'editTradeRoute' => false
        ];
    }
    
    /**
     * Update a trade route
     *
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function updateTradeRoute(Village $village, array $parameters): array
    {
        // Check if the trade route is valid
        if (!empty($this->validator->validateInputs($parameters, self::UPDATE_TRADE_ROUTE_RULES))) {
            return [
                'error' => INVALID_TRADE_ROUTE,
                'editTradeRoute' => false
            ];
        }
        
        // Search the trade route
        foreach ($village->getTradeRoutes() as $index => $tradeRoute) {
            if ($tradeRoute->id == $parameters['routeid']) {
                // Set the new values
                $tradeRoute->setResources([
                    $parameters['wood'], 
                    $parameters['clay'], 
                    $parameters['iron'], 
                    $parameters['crop'] 
                ]);
                $tradeRoute->start = $parameters['start'];
                $tradeRoute->deliveries = $parameters['deliveries'];

                // Update the trade route
                $tradeRoute->update();

                // Remove the trade route
                $village->removeTradeRoute($index);
                
                // Add the updated trade route
                $village->addTradeRoute($tradeRoute);

                return [
                    'lastRouteID' => $tradeRoute->id,
                    'editTradeRoute' => false
                ];
            }
        }
        
        // If the trade route wasn't found
        return [
            'error' => INVALID_TRADE_ROUTE,
            'editTradeRoute' => false
        ];
    }
}