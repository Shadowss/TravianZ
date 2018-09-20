<?php

namespace TravianZ\Data\Buildings;

use TravianZ\Data\Validator;
use TravianZ\Entity\Building;
use TravianZ\Entity\FarmList;
use TravianZ\Entity\Oases;
use TravianZ\Entity\RaidList;
use TravianZ\Entity\Village;
use TravianZ\Entity\WorldCell;
use TravianZ\Enums\MovementEnums;
use TravianZ\Enums\UnitEnums;
use TravianZ\Enums\VillageEnums;
use TravianZ\Factory\MovementsFactory;
use TravianZ\Factory\UnitsFactory;
use TravianZ\Utils\Generator;
use TravianZ\Data\Users\Nature;
use TravianZ\Factory\BuildingsFactory;
use TravianZ\Enums\BuildingEnums;

final class RallyPoint extends Building
{
    /**
     * @var array The evasion settings rules
     */
    const UPDATE_EVASION_SETTINGS_RULES = [
        'maxEvasion' => 'isRequired|isInt|minValue=0|maxValue=999'
    ];
    
    /**
     * @var array
     */
    const CREATE_RAID_FARM_LIST_RULES = [
        'lid' => 'isRequired|isInt|minValue=1'
    ];
    
    /**
     * @var array
     */
    const CREATE_RAID_UNITS_RULES = [
        'units' => 'isRequired'
    ];
    
    /**
     * @var array The farm list coordinates rules
     */
    const CREATE_RAID_COORDINATES_RULES = [
        'x' => 'isRequired|isInt|minValue=' . -WORLD_MAX.'|maxValue=' . WORLD_MAX,
        'y' => 'isRequired|isInt|minValue=' . -WORLD_MAX.'|maxValue=' . WORLD_MAX
    ];
    
    /**
     * @var array The farm list last target rules
     */
    const CREATE_RAID_LAST_TARGET_RULES = [
        'lastTarget' => 'isRequired|isInt|minValue=1'
    ];
    
    /**
     * @var array The set of edit a raid
     * 
     */
    const EDIT_RAID_RULES = [
        'raidList' => 'isRequired|isInt|minValue=1',
        'lid' => 'isRequired|isInt|minValue=1'
    ];
    
    /**
     * @var array The set of rules to create a farm list
     */
    const CREATE_FARM_LIST_RULES = [
        'name' => 'isRequired|maxLength=30',
        'fromVref' => 'isRequired|isInt|minValue=1'
    ];
    
    /**
     * @var array The set of rules to delete a farm list
     */
    const DELETE_FARM_LIST_RULES = [
        'delFarmList' => 'isRequired|isInt|minValue=1'
    ];
    
    /**
     * @var array The set of rules to start one or more raid(s)
     */
    const START_RAIDS_RULES = [
        'slot' => 'isRequired'
    ];
    
    /**
     * @var array The set of rules to prepare a movement
     */
    const PREPARE_MOVEMENT_RULES = [
    	'c' => 'isRequired|isInt|minValue=1|maxValue=4'
    ];
    
    /**
     * @var array The set of rules to get a village by name
     */
    const PREPARE_MOVEMENT_VILLAGE_NAME_RULES = [
    	'targetVillageName' => 'isRequired'
    ];
    
    /**
     * @var array The set of rules for sending units
     */
    const SEND_UNITS_RULES = [
    	'ckey' => 'isRequired',
    	'ctar1' => 'isInt|minValue=0|maxValue=42',
    	'ctar2' => 'isInt|minValue=-1|maxValue=42',
    	'spy' => 'isInt|minValue=1|maxValue=2'
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
	 * {@inheritdoc}
	 * @see \TravianZ\Entity\Building::getBonus()
	 */
	public function getBonus(){
		// Initialize
		$bonus = [];
		
		// Loop through the bonuses
		for($i = $this->level; $i >= 1; $i--){
			if(!isset($this->bonus[$i])){
				continue;
			}

			$bonus = array_replace_recursive($bonus, $this->bonus[$i]);
		}
		
		return $bonus;
	}
    
    /**
     * Update the user's evasion settings
     * 
     * @param Village $village The user's village
     * @param array $parameters The parameters
     */
    public function updateEvasionSettings(Village $village, array $parameters): array
    {
        // Check if the parameters are valid
        if (!empty($this->validator->validateInputs($parameters, self::UPDATE_EVASION_SETTINGS_RULES))) {
            return ['error' => INVALID_MAX_EVASIONS];
        }

        // Set the new evasions number
        if ($village->owner->maxEvasion != $parameters['maxEvasion']) {
            $village->owner->maxEvasion = $parameters['maxEvasion'];
            $village->owner->setUserFields(['maxevasion'], [$village->owner->maxEvasion]);
        }
        
        // Enable/Disable evasion
        foreach ($village->owner->getVillages() as $villageToUpdate) {
            $evasionState = isset($parameters['evasionCheck'][$villageToUpdate->vref]);
            if ($villageToUpdate->evasion != $evasionState) {
                $villageToUpdate->evasion = $evasionState;
                $villageToUpdate->setFields(['evasion'], [$villageToUpdate->evasion]);
            }
        }

        return ['success' => EVASION_SETTINGS_UPDATED];
    }

    /**
     * Check the validity of the inserted units
     * 
     * @param Village $village
     * @param array $parameters
     * @return string
     */
    public function checkUnits(Village $village, array $parameters): string
    {
        // Check the inserted inputs
        if (!empty($this->validator->validateInputs($parameters, self::CREATE_RAID_UNITS_RULES))) {
            return INVALID_PARAMETERS;
        }
        
        // Check if the inserted units are valid
        foreach ($parameters['units'] as $type => $unit) {
            if (!empty($this->validator->validateInputs($parameters['units'], [$type => 'isInt|minValue=0|maxValue=999999']))) {
                return INVALID_UNITS;
            }
        }
        
        // Check if there's at least one unit
        if (array_sum($parameters['units']) <= 0) {
            return NO_UNITS;
        }
        
        return '';
    }
    
    /**
     * Check the validity of the inserted farm list id
     * 
     * @param Village $village
     * @param array $parameters
     * @return string
     */
    public function checkFarmList(Village $village, array $parameters): string
    {
        // Check the inserted inputs
        if (!empty($this->validator->validateInputs($parameters, self::CREATE_RAID_FARM_LIST_RULES))) {
            return INVALID_PARAMETERS;
        }
        
        // Check if the list is owned by the village owner
        foreach ($village->owner->getFarmLists() as $farmList) {
            if ($farmList->id == $parameters['lid']) {
                return '';
            }
        }
        
        return INVALID_FARM_LIST;
    }
    
    /**
     * Check a raid correctness
     * 
     * @param Village $village
     * @param WorldCell $worldCellToCheck
     * @param array $parameters
     * @return string|Village|Oases Returns an error or the target village/oases on success
     */
    public function checkRaid(Village $village, WorldCell $worldCellToCheck = null, array $parameters = [])
    {
        // If the village to check is null, create it
        if (is_null($worldCellToCheck)) {
            // Check the coordinates/target vref
            if (empty($this->validator->validateInputs($parameters, self::CREATE_RAID_COORDINATES_RULES))) {
                $worldCellToCheck = new Village(
                    $this->getDatabase(),
                    null,
                    Generator::getBaseID($parameters['x'], $parameters['y'])
                );
                
                // If it doesn't exist, it could be an oases
                if ($worldCellToCheck->getState() == VillageEnums::DOES_NOT_EXIST) {
                    $worldCellToCheck = new Oases(
                        $this->getDatabase(),
                        null,
                        Generator::getBaseID($parameters['x'], $parameters['y'])
                    );
                }
            } elseif (empty($this->validator->validateInputs($parameters, self::CREATE_RAID_LAST_TARGET_RULES))) {
                $worldCellToCheck = new Village(
                    $this->getDatabase(),
                    null,
                    $parameters['lastTarget']
                );
                
                // If it doesn't exist, it could be an oases
                if ($worldCellToCheck->getState() == VillageEnums::DOES_NOT_EXIST) {
                    $worldCellToCheck = new Oases(
                        $this->getDatabase(),
                        null,
                        $parameters['lastTarget']
                    );
                }
            } 
            
            // Check if the village/oases is null or doesn't exists
            if (
                is_null($worldCellToCheck) ||
                $worldCellToCheck->getState() == VillageEnums::DOES_NOT_EXIST
            ) {
                return VILLAGE_DOES_NOT_EXIST;
            }   
        }

        // Check if the village is the same
        if ($worldCellToCheck->vref == $village->vref) {
            return CANNOT_SEND_UNITS_SAME_VILLAGE;
        }
        
        // Check if the User is banned or an Admin/MH is being attacked
        if ($worldCellToCheck->owner->isBanned() || ($worldCellToCheck->owner->isAdmin() && !ADMIN_ALLOW_INCOMING_RAIDS)) {
            return BANNED_CANNOT_SEND_UNITS;
        }

        // Check if the User is under beginner protection
        if ($worldCellToCheck->owner->isUnderBeginnerProtection) {
            return UNDER_BEGINNER_PROTECTION;
        }
        
        // Check if the User is on vacation
        if ($worldCellToCheck->owner->isUnderBeginnerProtection) {
            return PLAYER_ON_VACATION_SEND_UNITS;
        }

        return $worldCellToCheck;
    } 
    
    /**
     * Check the correctness of a sending units attemp
     *
     * @param Village $village
     * @param array $parameters
     * @return string|Village|Oases Returns an error or the target village/oases on success
     */
    public function checkSendingUnits(Village $village, array $parameters)
    {
    	// Check if the inserted units are valid
    	if (!empty($error = $this->checkUnits($village, $parameters))) {
    		return $error;
    	}
    	
    	// Check if the inserted units aren't enough
    	foreach ($parameters['units'] as $type => $unit) {
    		if ($unit > $village->getUnits()[$type]->amount) {
    			return CANNOT_SEND_MORE_UNITS_THAN_HAVE;
    		}
    	}
    	
    	// Check if the attack type is valid
    	if (!empty($this->validator->validateInputs($parameters, self::PREPARE_MOVEMENT_RULES))) {
    		return INVALID_ATTACK_TYPE;
    	}
    	
    	// Check if a village name was inserted
    	if (empty($this->validator->validateInputs($parameters, self::PREPARE_MOVEMENT_VILLAGE_NAME_RULES))) {
    		$worldCellToCheck = new Village(
    				$this->getDatabase(),
    				null,
    				0,
    				$parameters['targetVillageName']
    		);

    		// Check if the village/oases is null or doesn't exists
    		if (
    			is_null($worldCellToCheck) ||
    			$worldCellToCheck->getState() == VillageEnums::DOES_NOT_EXIST
    		) {
    			return VILLAGE_DOES_NOT_EXIST;
    		}  
    	}
    	
    	// Check parameters correctness
    	$worldCellToCheck = $this->checkRaid($village, $worldCellToCheck, $parameters);
    	
    	// If it's an oases, check if it can be normal attacked or enforced
    	if (
    		$worldCellToCheck instanceof Oases &&
    		$worldCellToCheck->owner instanceof Nature
    	) {
    		if ($parameters['c'] == MovementEnums::NORMAL) {
    			return CANT_NORMAL_ATTACK_OASES;
    		} elseif ($parameters['c'] == MovementEnums::REINFORCEMENT) {
    			return CANT_ENFORCE_OASES;
    		}
    	}
    	
    	// Return the error/Village/Oases
    	return $worldCellToCheck;
    }
    

    /**
     * Check the correctness of a farm list raid
     * 
     * @param WorldCell $worldCell
     * @param array $parameters
     * @return string|Village|Oases Returns an error message or a village/oases on success
     */
    public function checkFarmListRaid(WorldCell $worldCell, array $parameters)
    {
        // Check if the inserted units are valid
        if (!empty($error = $this->checkUnits($worldCell, $parameters))) {
            return $error;
        }
        
        // Check if the inserted farmlist is valid
        if (!empty($error = $this->checkFarmList($worldCell, $parameters))) {
            return $error;
        }
        
        // Check the raid correctness
        return $this->checkRaid($worldCell, null, $parameters);
    }

    /**
     * 
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function addFarmListRaid(Village $village, array $parameters): array
    {
        // Check the user has at least one farm list
        if (empty($village->owner->getFarmLists())) {
            return [
                'addRaid' => false,
                'error' => CREATE_FARM_LIST_FIRST
            ];
        }

        // A raid list can be created
        return [
            'units' => $this->getRaidListUnits($village, $parameters),
            'villageLastAttackedTargets' => $this->getLastAttackedVillages($village),
            'addRaid' => true
        ];
    }
    
    /**
     * Create a farm list raid
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function createFarmListRaid(Village $village, array $parameters): array
    {
        // Check if the raid is valid
        $toWorldCell = $this->checkFarmListRaid($village, $parameters);

        // Check if it's a string
        if (is_string($toWorldCell)) {
            return [
                'lid' => $parameters['lid'],
                'y' => $parameters['y'],
                'x' => $parameters['x'],
                'lastTarget' => $parameters['lastTarget'],
                'units' => $this->getRaidListUnits($village, $parameters),
                'villageLastAttackedTargets' => $this->getLastAttackedVillages($village),
                'addRaid' => true,
                'error' => $toWorldCell
            ];
        }
        
        // Initialization
        $units = [];
        $lastReport = null;
        
        // Create the units
        foreach ($parameters['units'] as $type => $amount) {
            $units[$type] = UnitsFactory::create($village->owner->tribe, $type, $amount);
        }

        // Search the last attack report to this village
        foreach ($village->owner->getReports() as $report) {
            // Check if it's the last attacking report to the target village
            if (
                $report->to->vref == $toWorldCell->vref &&
                in_array($report->type, [1, 2, 3, 7])
            ) {
                $lastReport = $report;
                break;
            }
        }
        
        // Create the raid
        $raidToAdd = new RaidList(
            $this->getDatabase(), 
            0, 
            $parameters['lid'],
            $toWorldCell, 
            $units, 
            $lastReport
        );
        
        // Add the raid to the database
        $raidToAdd->add();
        
        /// Add the raid locally
        $village->owner->addRaidList($parameters['lid'], $raidToAdd);
        
        return ['addRaid' => false];
    }
    
    /**
     * Edit an user's raid list
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function editFarmListRaid(Village $village, array $parameters): array
    {
        // Check the parameters validity
        if (!empty($this->validator->validateInputs($parameters, self::EDIT_RAID_RULES))) {
            return ['editRaid' => false];
        }        
        
        // Check if the raid is owned by the user
        foreach ($village->owner->getFarmLists()[$parameters['lid']]->raidsList as $raid) {
            if ($raid->id == $parameters['raidList']) {
                // Load the units
                foreach ($raid->getUnits() as $type => $unit) {
                    $parameters['units'][$type] = $unit->amount;
                }

                // Load the farm list ID
                $parameters['lid'] = $raid->farmListID;

                // Load the coordinates
                $parameters['x'] = $raid->to->coordinates['x'];
                $parameters['y'] = $raid->to->coordinates['y'];
                
                return [
                    'lid' => $parameters['lid'],
                    'x' => $parameters['x'],
                    'y' => $parameters['y'],
                    'lastTarget' => $parameters['lastTarget'],
                    'units' => $this->getRaidListUnits($village, $parameters),
                    'villageLastAttackedTargets' => $this->getLastAttackedVillages($village),
                    'raidList' => $parameters['raidList'],
                    'editRaid' => true
                ];
            }
        }
        
        return ['editRaid' => false];
    }
    
    /**
     * Update an user's farm list
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function updateFarmListRaid(Village $village, array $parameters): array
    { 
        // Check if the raid is valid
        $toWorldCell = $this->checkFarmListRaid($village, $parameters);

        // Check the parameters validity
        if (is_string($toWorldCell)) {
            return [
                'lid' => $parameters['lid'],
                'y' => $parameters['y'],
                'x' => $parameters['x'],
                'lastTarget' => $parameters['lastTarget'],
                'units' => $this->getRaidListUnits($village, $parameters),
                'villageLastAttackedTargets' => $this->getLastAttackedVillages($village),
                'raidList' => $parameters['raidList'],
                'error' => $toWorldCell,
                'editRaid' => true
            ];
        }

        // Search the raid list to update
        foreach ($village->owner->getFarmLists() as $farmList) {
            foreach ($farmList->raidsList as $raidIndex => $raid) {
                if ($raid->id == $parameters['raidList']) {
                    // Initialization
                    $units = [];
                    $lastReport = null;
                    
                    // Create the units
                    foreach ($parameters['units'] as $type => $amount) {
                        $units[$type] = UnitsFactory::create($village->owner->tribe, $type, $amount);
                    }
                    
                    // Search the last attack report to this village
                    foreach ($village->owner->getReports() as $report) {
                        // Check if it's the last attacking report to the target village
                        if (
                            $report->to->vref == $toWorldCell->vref &&
                            in_array($report->type, [1, 2, 3, 7])
                            ) {
                                $lastReport = $report;
                                break;
                            }
                    }    

                    // Create the new raid
                    $raidToAdd = new RaidList(
                        $this->getDatabase(),
                        $raid->id,
                        $parameters['lid'],
                        $toWorldCell,
                        $units,
                        $lastReport
                    );

                    // Delete the older one
                    $village->owner->deleteRaidList($farmList->id, $raidIndex);
                    
                    // Add it to the list
                    $village->owner->addRaidList($parameters['lid'], $raidToAdd);
                    
                    // Update it on the database
                    $raidToAdd->update();

                    break 2;
                }
            }
        }
        
        return ['editRaid' => false];
    }
    
    /**
     * Delete an user's farm list raid
     * 
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function deleteFarmListRaid(Village $village, array $parameters): array
    {
        // Check the parameters validity
        if (!empty($this->validator->validateInputs($parameters, self::EDIT_RAID_RULES))) {
            return ['editRaid' => false];
        }

        // Search the raid list to delete
        foreach ($village->owner->getFarmLists()[$parameters['lid']]->raidsList as $raidIndex => $raid) {
            if ($raid->id == $parameters['raidList']) {
                // Delete it from the database
                $raid->delete();
                
                // Delete it locally
                $village->owner->deleteRaidList($parameters['lid'], $raidIndex);
                
                break;
            }
        }
        
        return ['editRaid' => false];
    }
    
    /**
     * Add a farm list
     *
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function addFarmList(Village $village, array $parameters): array
    {
        return ['addFarmList' => true];
    }
    
    /**
     * Create a farm list
     *
     * @param Village $village
     * @param array $parameters
     * @return array
     */
    public function createFarmList(Village $village, array $parameters): array
    {
        // Check the parameters validity
        if (!empty($this->validator->validateInputs($parameters, self::CREATE_FARM_LIST_RULES))) {
            return [
                'addFarmList' => true,
                'error' => INVALID_PARAMETERS
            ];
        }
        
        // Check if the passed village, is owned by the user
        foreach ($village->owner->getVillages() as $villageToCheck) {
            if ($villageToCheck->vref == $parameters['fromVref']) {
                // Create the farm list
                $farmListToAdd = new FarmList(
                    $this->getDatabase(), 
                    0, 
                    $villageToCheck,
                    $parameters['name'],
                    []
                );
                
                // Add it to the database
                $farmListToAdd->add();
                
                // Add it locally
                $village->owner->addFarmList($farmListToAdd);
                
                return ['addFarmList' => false];
            }
        }
        
        // The village wasn't found
        return [
            'error' => INVALID_VILLAGE,
            'addFarmList' => true
        ];
    }
    
    /**
     * Delete an user's farm list
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function deleteFarmList(Village $village, array $parameters)
    {
        // Check the parameters validity
        if (!empty($this->validator->validateInputs($parameters, self::DELETE_FARM_LIST_RULES))) {
            return;
        }
        
        // Check if the farm list is owned by the user
        foreach ($village->owner->getFarmLists() as $farmList) {
            if ($farmList->id == $parameters['delFarmList']) {
                // Delete the farm list from the database
                $farmList->delete();
                
                // Delete the farm list locally
                $village->owner->deleteFarmList($farmList->id);
                
                break;
            }
        }
    }
    
    /**
     * Start one or more raids
     *
     * @param Village $village
     * @param array $parameters
     */
    public function startFarmListRaids(Village $village, array $parameters)
    {
        // Check the parameters validity
        if (!empty($this->validator->validateInputs($parameters, self::START_RAIDS_RULES))) {
            return;
        }

        // Check the raids validity
        foreach ($parameters['slot'] as $index => $slot) {
            if (!empty($this->validator->validateInputs($parameters['slot'], [$index => 'isRequired|isInt|minValue=1']))) {
                // Unset it, if it's not valid
                unset($parameters['slot'][$index]);
            }
        }

        // Initialize
        $movements = [];
        $time = time();

        // Set the movements
        foreach ($village->owner->getFarmLists() as $farmList) {
            foreach ($farmList->raidsList as $raidList) {
                // Check if it's a selected raid
                if (in_array($raidList->id, $parameters['slot'])) {
                    $movements[] = MovementsFactory::create(
                        MovementEnums::RAID,
                        $this->getDatabase(),
                        0,
                        $farmList->from,
                        $raidList->to,
                        $time,
                        $time,
                        [],
                        $raidList->getUnits()
                    );
                    
                    // Remove it from the list
                    unset($parameters['slot'][$raidList->id]);
                }
                
                // Break if all raids have been found
                if (empty($parameters['slot'])) {
                    break 2;
                }
            }
        }
        
        // Add the movements
        $this->addMovements($village, $movements);
    }
    
    /**
     * Prepare the units to send
     * 
     * @param Village $village
     * @param array $movements
     */
    public function prepareUnitsToSend(Village $village, array $parameters): array
    {
    	// Check if the attack type is not a spy attack
    	if ($parameters['c'] == MovementEnums::SPY) {
    		$toWorldCell = INVALID_ATTACK_TYPE;
    	} else {
    		// Check the parameters validity
    		$toWorldCell = $this->checkSendingUnits($village, $parameters); 
    	}
    	
    	if (is_string($toWorldCell)) {
    		return [
    				'error' => $toWorldCell,
    				'targetVillageName' => $parameters['targetVillageName'],
    				'units' => $parameters['units'],
    				'c' => $parameters['c'],
    				'x' => $parameters['x'],
    				'y' => $parameters['y'],
    		];
    	}
    	
    	// Initialize
    	$units = [];
    	$spy = $parameters['c'] != MovementEnums::REINFORCEMENT;
    	$catapultTargets = [];
    	$catapultTargetBuildings = [];
    	
    	// Check if it's a normal attack and there is atleast one catapult
    	if ($parameters['c'] == MovementEnums::NORMAL && $parameters['units'][8] > 0) {
    		$catapultTargets = $this->getBonus();
    	}
    	
    	// Set the buildings
    	foreach ($catapultTargets as $type => $targets) {
    		foreach ($targets as $buildingID) {
    			$building = BuildingsFactory::newBuilding($buildingID, 0, 0);
    			$catapultTarget['id'] = $building->id;
    			$catapultTarget['name'] = $building->name;
    			$catapultTargetBuildings[$type][] = $catapultTarget;
    		}
    	}

    	// Create the units and check if it's a spy attack
    	for ($i = 1; $i <= 10; $i++) {
    		// Set the units to 0, if empty
    		if ($parameters['units'][$i] == '') {
    			$parameters['units'][$i] = 0;
    		}

    		$units[$i] = UnitsFactory::create($village->owner->tribe, $i, $parameters['units'][$i]);
    		
    		if (
    			$spy &&
    			$units[$i]->amount > 0 && 
    			$units[$i]->classes[1] != UnitEnums::SCOUT
    		) {
    			$spy = false;
    		}
    	}
    	
    	// Set the hero if present
    	if ($parameters['units'][11] > 0) {
    		$units[$i] = $village->getUnits()[11];
    	}
    	
    	// If it's a spy attack, change the attack type
    	if ($spy) {
    		$parameters['c'] = MovementEnums::SPY;
    	}
    	
    	// Get the walking units time
    	$walkingUnitsTime = Generator::getWalkingUnitsTime($village, $toWorldCell, $units);
    	
	    // Add the prepared movement on the database and return the needed informations
    	return [
    			'ckey' => $this->addPreparedUnits($village, $toWorldCell, $parameters['units'], $parameters['c']),
    			'units' => $parameters['units'],
    			'prepareUnits' => true,
    			'targetVillageVref' => $toWorldCell->vref,
    			'targetVillageMapCheck' => Generator::getMapCheck($toWorldCell->vref),
    			'targetVillageName' => $toWorldCell->name,
    			'targetVillageCoordinates' => $toWorldCell->coordinates,
    			'targetOwnerId' => $toWorldCell->owner->id,
    			'targetOwnerUsername' => $toWorldCell->owner->username,
    			'arrivalTime' => [
    					Generator::getTimeFormat($walkingUnitsTime),
    					Generator::procMtime($walkingUnitsTime + time())[1]
    			],
    			'c' => $parameters['c'],
    			'catapultTargetBuildings' => $catapultTargetBuildings,
    			'x' => $parameters['x'],
    			'y' => $parameters['y'],
    	];
    }
    
    /**
     * Add prepared units on the database
     * 
     * @param Village $fromVillage The sender village
     * @param WorldCell $toWorldCell The target village
     * @param array $units The units [type => amount]
     * @param int $type The movement type
     * @return string Returns the generated prepared units key
     */
    public function addPreparedUnits(Village $fromVillage, WorldCell $toWorldCell, array $units, int $type): string
    {
    	// Generate the string identifier
    	$stringIdentifier = Generator::generateRandStr(10);
    	
    	// Delete any previously prepared units
    	$sql = 'DELETE FROM
                    ' . TB_PREFIX . 'a2b
                WHERE
					`from` = ?';

    	$this->getDatabase()->queryNew($sql, $fromVillage->vref);

    	$sql = 'INSERT INTO
                    ' . TB_PREFIX . 'a2b
                    (ckey, `from`, `to`, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10, u11, type)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

    	$this->getDatabase()->queryNew(
    			$sql,
    			$stringIdentifier,
    			$fromVillage->vref,
    			$toWorldCell->vref,
    			$units[1] ?? 0,
    			$units[2] ?? 0,
    			$units[3] ?? 0,
    			$units[4] ?? 0,
    			$units[5] ?? 0,
    			$units[6] ?? 0,
    			$units[7] ?? 0,
    			$units[8] ?? 0,
    			$units[9] ?? 0,
    			$units[10] ?? 0,
    			$units[11] ?? 0,
    			$type
    	);
    	
    	return $stringIdentifier;
    }

    /**
     * Send previously prepared units
     *
     * @param Village $village
     * @param array $movements
     */
    public function sendUnits(Village $village, array $parameters): array
    {
    	// Check the parameters validity
    	if (!empty($this->validator->validateInputs($parameters, self::SEND_UNITS_RULES))) {
    		return [];
    	}

    	// Get the prepared units from the passed key
    	$preparedUnits = $this->getPreparedUnits($parameters['ckey']);

    	// Check if there are no prepared units with that key
    	if (empty($preparedUnits)) {
    		return [];
    	}

    	// Initialize
    	$validTargets = 0;
    	
    	// Check the catapult targets correctness
    	foreach ($this->getBonus() as $validCatapultTargets) {
    		foreach ($validCatapultTargets as $buildingID) {    			
    			// Check if the selected targets are on the list
    			if (
    				 ($parameters['ctar1'] == BuildingEnums::EMPTY || 
    				 $parameters['ctar1'] == $buildingID) ||
    				 ($parameters['ctar2'] == BuildingEnums::EMPTY || 
    				 $parameters['ctar2'] == -1 || 
    				 $parameters['ctar2'] == $buildingID)
    			) {
    				$validTargets++;
    			}

    			if ($validTargets == 2) {
    				break;
    			}
    		}
    	}
    	
    	// Check if the selected targets are valid
    	if ($validTargets < 2) {
    		return [];
    	}
    	
    	// Check the units correctness
    	$toWorldCell = $this->checkSendingUnits($village, $preparedUnits);

    	// Check if the units aren't valid
    	if (is_string($toWorldCell)) {
    		return [];
    	}
    	
    	// Initialize
    	$units = [];
    	$time = time();
    	
    	// Create the units
    	for ($i = 1; $i <= 10; $i++) {
    		$units[$i] = UnitsFactory::create($village->owner->tribe, $i, $preparedUnits['units'][$i]);
    	}
    	
    	// Set the hero if present
    	if ($parameters['units'][11] > 0) {
    		$units[$i] = $village->getUnits()[11];
    	}
    	
    	// Create the movement
    	$movement = MovementsFactory::create(
    			$preparedUnits['c'], 
    			$this->getDatabase(), 
    			0, 
    			$village, 
    			$toWorldCell, 
    			$time,
    			$time + Generator::getWalkingUnitsTime($village, $toWorldCell, $units), 
    			[],
    			$units,
    			0,
    			0,
    			0,
    			[$parameters['ctar1'], $parameters['ctar2']] ?? [],
    			$parameters['spy'] ?? 0
    	);
    	
    	// Add the movement to the database
    	$movement->add();
    	
    	// Remove the units from the village
    	$village->updateUnits($units, true);
    	
    	// Delete the prepared units
    	$this->deletePreparedUnits($parameters['ckey']);
    	
    	// Add the movement locally
    	$village->addMovement($movement);
    	
    	return [];
    }
    
    /**
     * Get previously prepared units
     * 
     * @param string $key The prepared units key
     * @return array Returns an array, containing all the prepared movement informations
     */
    public function getPreparedUnits(string $key): array
    {
    	$sql = 'SELECT * FROM
                    ' . TB_PREFIX . 'a2b
                WHERE
                    ckey = ?';
    	
    	$res = $this->getDatabase()->queryNew($sql, $key)[0];
    	
    	// If the units don't exist, return
    	if (empty($res)) {
    		return [];
    	}
    	
    	// Initialize
    	$informations = [
    		'lastTarget' => $res['to'],
    		'c' => $res['type'],
    		'units' => []
    	];
    	
    	// Create the units array
    	for($i = 1; $i <= 11; $i++) {
    		$informations['units'][$i] = $res['u'.$i];
    	}
    	
    	return $informations;
    }
    
    /**
     * Delete prepared units from the database
     * 
     * @param string $key The prepared units key
     */
    public function deletePreparedUnits(string $key)
    {
    	$sql = 'DELETE FROM
                    ' . TB_PREFIX . 'a2b
                WHERE
                    ckey = ?';
    	
    	$this->getDatabase()->queryNew($sql, $key);
    }
    
    /**
     * Add one ore more movements to the database, after checking their correctness
     * 
     * @param Village $village
     * @param array $movements
     */
    public function addMovements(Village $village, array $movements)
    {
        // Initialization
        $unitsCount = [];

        // Check the movements
        foreach ($movements as $movementIndex => $movement) {
            // Check if the movement is valid
            if (is_string($this->checkRaid($village, $movement->to))) {
                // Remove the movement from the list and continue
                unset($movements[$movementIndex]);
                continue;
            }

            // Check if there are some units
            if (!empty($movement->units)) {
                // Initialization
                $tempUnitsCount = [];
                
                // Check the units amount
                foreach($movement->units as $type => $unit) {
                    // Check if the unit exists
                    if ($type > 0 & $unit->amount > 0) {
                        // Check if there are enough units in the village, to perform this raid
                        if ($village->getUnits()[$type]->amount < $unit->amount ?? 0 + $unitsCount[$type]->amount ?? 0) {
                            // Remove the movement from the list and break
                            unset($movements[$movementIndex]);
                            break;
                        }

                        // Increment the valid units
                        $tempUnitsCount[$type] = $unit;
                    } 
                }
                
                // The movement is valid, add the units to the main list
                foreach($tempUnitsCount as $type => $unit) {
                    if (isset($unitsCount[$type])) {
                        $unitsCount[$type]->amount += $unit->amount ?? 0;
                    } else {
                        $unitsCount[$type] = UnitsFactory::create($village->owner->tribe, $type, $unit->amount ?? 0);
                    }
                }
            }
        }

        // Check if there are one ore more movements left
        if (empty($movements)) {
            return;
        }

        // Initialize
        $pairs = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $fields = $values = $validMovements = [];
        $firstInsertedID = 0;
        $validMovementsCount = 0;
                
        // Add the valid attacks to the database
        foreach ($movements as $movementIndex => $movement) {
            // Check if units aren't empty
            if (!empty($movement->units)) {
                // Add the fields and values
                $fields[] = $pairs;
                array_push(
                    $values,
                    $movement->from->vref,
                    $movement->units[1]->amount ?? 0,
                    $movement->units[2]->amount ?? 0,
                    $movement->units[3]->amount ?? 0,
                    $movement->units[4]->amount ?? 0,
                    $movement->units[5]->amount ?? 0,
                    $movement->units[6]->amount ?? 0,
                    $movement->units[7]->amount ?? 0,
                    $movement->units[8]->amount ?? 0,
                    $movement->units[9]->amount ?? 0,
                    $movement->units[10]->amount ?? 0,
                    $movement->units[11]->amount ?? 0,
                    $movement->catapultTargets[0] ?? 0,
                    $movement->catapultTargets[1] ?? 0,
                    $movement->spy ?? 0
                );
                
                $validMovements[$movementIndex] = true;
            } else {
                $validMovements[$movementIndex] = false;
            }
        }
        
        // Add the units to the database
        $sql = 'INSERT INTO
                        ' . TB_PREFIX . 'attacks
                        (vref, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10, u11, ctar1, ctar2, spy)
                    VALUES
                        ' . implode(',', $fields);

        $firstInsertedID = $this->getDatabase()->queryNew($sql, $values);
        
        // Reset the values
        $pairs = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $values = $fields = [];

        // Add the movement values and fields
        foreach ($movements as $movementIndex => $movement) {            
            $fields[] = $pairs;
            array_push(
                $values,
                $movement->from->vref,
                $movement->to->vref,
                $validMovements[$movementIndex] ? $firstInsertedID + $validMovementsCount : 0,
                $movement->startTime,
                $movement->endTime,
                $movement->merchants ?? 0,
                $movement->repetitions ?? 0,
                $movement->resources[0] ?? 0,
                $movement->resources[1] ?? 0,
                $movement->resources[2] ?? 0,
                $movement->resources[3] ?? 0,
                $movement->type
            );
            
            // Increment the valid movements
            $validMovementsCount += $validMovements[$movementIndex] ? 1 : 0;
            
            // Add the movement locally
            $village->addMovement($movement);
        }

        // Add the movements to the database
        // Add the units to the database
        $sql = 'INSERT INTO
                        ' . TB_PREFIX . 'movement
                        (`from`, `to`, ref, starttime, endtime, merchants, repetitions, wood, clay, iron, crop, type)
                    VALUES
                        ' . implode(',', $fields);
        
        $this->getDatabase()->queryNew($sql, $values);
        
        // Decrement the village units
        $village->updateUnits($unitsCount, true);
    }
    
    /**
     * Get the last attacked villages
     *
     * @param Village $village
     * @return array Returns the last attacked villages
     */
    private function getLastAttackedVillages(Village $village): array
    {
        //Initialize
        $lastAttackedTargets = [];
        
        // Set the last attacked villages
        foreach ($village->owner->getReports() as $report) {
            // Check if it's an attack
            if (
                $report->from->vref == $village->vref &&
                in_array($report->type, [1, 2, 3, 7])
                ) {
                    $lastAttackedTargets[$report->to->vref]['villageName'] = $report->to->name;
                    $lastAttackedTargets[$report->to->vref]['villageCoordinates'] = $report->to->coordinates;
                }
        }
        
        return $lastAttackedTargets;
    }
    
    /**
     * Get the units of a raid list
     *
     * @param Village $village
     * @param array $parameters
     * @return array Returns the raid list units
     */
    private function getRaidListUnits(Village $village, array $parameters): array
    {
        // Set the troops
        foreach ($village->getUnits() as $type => $unit) {
            // Skip scouts, siege units, colonizers and the hero
            if (
                ($unit->classes[1] == UnitEnums::SCOUT) ||
                $unit->classes[0] != UnitEnums::CAVALRY &&
                $unit->classes[0] != UnitEnums::INFANTRY
                ) {
                    continue;
                }
                
                $units[$type]['name'] = $unit->name;
                $units[$type]['amount'] = $parameters['units'][$type] ?? 0;
        }
        
        return $units;
    }
}