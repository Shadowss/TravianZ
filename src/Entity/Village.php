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

namespace TravianZ\Entity;

use TravianZ\Database\IDbConnection;
use TravianZ\Enums\VillageEnums;
use TravianZ\Factory\BuildingsFactory;
use TravianZ\Factory\MovementsFactory;
use TravianZ\Factory\UnitsFactory;
use TravianZ\Data\Movements\Returning;
use TravianZ\Data\Movements\Trade;
use TravianZ\Data\Buildings\Marketplace;
use TravianZ\Data\Movements\ReturningTrade;
use TravianZ\Data\Buildings\Residence;
use TravianZ\Data\Buildings\Palace;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Factory\ResearchesFactory;
use TravianZ\Enums\BuildingJobEnums;
use TravianZ\Enums\ResearchEnums;
use TravianZ\Enums\MovementEnums;
use TravianZ\Enums\TribeEnums;

/**
 * @author iopietro
 */
class Village extends WorldCell
{
    /**
     * @var array The default village resources field coordinates
     */
    const RESOURCES_FIELD_COORDINATES_ARRAY = [
        1 => '101,33,28',
        '165,32,28',
        '224,46,28',
        '46,63,28',
        '138,74,28',
        '203,94,28',
        '262,86,28',
        '31,117,28',
        '83,110,28',
        '214,142,28',
        '269,146,28',
        '42,171,28',
        '93,164,28',
        '160,184,28',
        '239,199,28',
        '87,217,28',
        '140,231,28',
        '190,232,28'
    ];
    
    /**
     * @var array The default village buildings field coordinates
     */
    const VILLAGE_COORDINATES_ARRAY = [
        19 => '53,91,91,71,127,91,91,112', 
        '136,66,174,46,210,66,174,87', 
        '196,56,234,36,270,56,234,77', 
        '270,69,308,49,344,69,308,90', 
        '327,117,365,97,401,117,365,138',
        '14,129,52,109,88,129,52,150',
        '97,137,135,117,171,137,135,158',
        '182,119,182,65,257,65,257,119,220,140', 
        '337,156,375,136,411,156,375,177', 
        '2,199,40,179,76,199,40,220',
        '129,164,167,144,203,164,167,185',
        '92,189,130,169,166,189,130,210',
        '342,216,380,196,416,216,380,237', 
        '22,238,60,218,96,238,60,259', 
        '167,232,205,212,241,232,205,253', 
        '290,251,328,231,364,251,328,272',
        '95,273,133,253,169,273,133,294',
        '222,284,260,264,296,284,260,305', 
        '80,306,118,286,154,306,118,327',
        '199,316,237,296,273,316,237,337', 
        '270,158,303,135,316,155,318,178,304,211,288,227,263,238,250,215'
    ];
    

    /**
     * @var int The village population
     */
    public $pop;

    /**
     * @var bool Determines if the village is the capital
     */
    public $isCapital;

    /**
     * @var string The village name
     */
    public $name;

    /**
     * @var int The village culture points
     */
    public $culturePoints;

    /**
     * @var int The village loyalty
     */
    public $loyalty;

    /**
     * @var int The village max containable resources
     */
    public $maxStore;

    /**
     * @var int The village max containable crop
     */
    public $maxCrop;

    /**
     * @var bool Determines if it's a WW Village
     */
    public $isNatar;

    /**
     * @var int The ID of the village
     */
    public $created;

    /**
     * @var int The village creation mode
     */
    public $mode;

    /**
     * @var User The village owner
     */
    public $owner;

    /**
     * @var int The ID of the village
     */
    public $vref; 
    
    /**
     * @var int Time when the celebration will end
     */
    public $celebrationTime;

    /**
     * @var bool Determines if the village is celebrating
     */
    public $isCelebrating;
    
    /**
     * @var array The village expansion slots
     */
    public $expansionSlots;

    /**
     *
     * @var bool The village evasion
     */
    public $evasion;
    
    /**
     * @var int Village resources last update
     */
    public $lastUpdate;
    
    /**
     * @var array The village resources
     */
    private $resources;
    
    /**
     * @var int The village total resources
     */
    private $totalResources;
    
    /**
     * @var int The available merchants
     */
    private $availableMerchants;
    
    /**
     * @var int The total merchants
     */
    private $totalMerchants;
    
    /**
     * @var int The maximum carryable resources
     */
    private $merchantsMaxCarry;

    /**
     * @var array The village oasis
     */
    private $oasis;

    /**
     * @var array The enforcements in the village and of the village
     */
    private $enforcements;
    
    /**
     * @var array The trapped Units in the village and of the village
     */
    private $trappedUnits;

    /**
     * @var array The units in the village
     */
    private $units;

    /**
     * @var array The village movements
     */
    private $movements;
    
    /**
     * @var array The village in training units
     */
    private $training;
    
    /**
     * @var array The village buildings
     */
    private $buildings;
    
    /**
     * @var array The village building jobs
     */
    private $buildingJobs;
    
    /**
     * @var int Used expansion slots
     */
    private $usedSlots;
    
    /**
     * @var int Total expansion slots available
     */
    private $availableSlots;
    
    /**
     * @var int The village culture points production
     */
    public $culturePointsProduction;
    
    /**
     * @var array The village researches
     */
    private $researches;
    
    /**
    * @var array The village trainable units
    */
    private $trainableUnits;
    
    /**
     * @var array The village total units
     */
    private $totalUnits;

    /**
     * @var array The village market offers
     */
    private $marketOffers;
    
    /**
     * @var array The village trade routes
     */
    private $tradeRoutes;

    /**
     * @var array The village production
     */
    private $production;

    /**
     * @var array The troops upkeep
     */   
    private $upkeep;

    /**
     * @var int The village state
     */
    private $state;

    /**
     * @var int The village map sector
     */
    private $sector;

    public function __construct(
        IDbConnection $db, 
        $owner,
        int $vref = 0,
        string $name = '',
        bool $checkExistence = true,
        bool $init = true,
        int $sector = 0, 
        int $mode = 0, 
        int $isCapital = 1, 
        int $pop = 2, 
        int $isNatar = 0, 
        int $fieldType = 3,
        array $buildings = [],
        array $coordinates = []
    ) {
        // Properties initialization
        $this->db = $db;
        $this->owner = $owner;
        $this->vref = $vref;
        $this->name = $name;
        
        // Check if the village ID exists
        if ($this->vref > 0 || $this->name != '') {
            if ($checkExistence) {
                $this->setState();
            }
            
            // Initialize the village
            if ($init) {
                $this->init();
            }
        } 

        // Check if the vref is 0
        if (!$this->vref || !$init) {
            $this->sector = $sector;
            $this->mode = $mode;
            $this->isCapital = $isCapital;
            $this->pop = $pop;
            $this->isNatar = $isNatar;
            $this->fieldType = $fieldType;
            $this->buildings = $buildings;
            $this->coordinates = $coordinates;
            $this->created = time();
            $this->upkeep = 0;
            $this->culturePointsProduction = 0;
            $this->production = [
                'wood' => 0,
                'clay' => 0,
                'iron' => 0,
                'crop' => 0
            ];
            $this->expansionSlots = [];
            $this->training = [];
            $this->buildings = [];
            $this->buildingJobs = [];
            $this->movements = [];
            $this->units = [];
            $this->oasis = [];
            $this->trappedUnits = [];
            $this->enforcements = [];
            $this->researches = [];
            $this->marketOffers = [];
            $this->tradeRoutes = [];
            $this->trainableUnits = [];
            $this->totalUnits = [];
        }
    }

    /**
     * Initialize the village
     */
    private function init()
    {
        if ($this->getState() == VillageEnums::DOES_NOT_EXIST) {
            return;
        }
        
        $sql = 'SELECT
                    v.*, w.x, w.y, w.fieldtype, w.occupied, w.image
                FROM
                    ' . TB_PREFIX . 'vdata as v
                INNER JOIN
                    ' . TB_PREFIX . 'wdata as w
                ON
                    w.id = v.wref
                WHERE
                    v.wref = ?
                LIMIT 1';
        
        $res = $this->db->queryNew($sql, $this->vref)[0];

        // If the village owner is null, set it
        if (is_null($this->owner)) {
            $this->owner = new User($this->db, $res['owner'], true);
        }
        
        // Set the properties
        $this->pop = $res['pop'];
        $this->isCapital = $res['capital'];
        $this->name = $res['name'];
        $this->coordinates = ['x' => $res['x'], 'y' => $res['y']];
        $this->culturePoints = $res['cp'];
        $this->setResources([
            'wood' => $res['wood'],
            'clay' => $res['clay'],
            'iron' => $res['iron'],
            'crop' => $res['crop']
        ]);
        $this->loyalty = $res['loyalty'];
        $this->maxStore = $res['maxstore'];
        $this->maxCrop = $res['maxcrop'];
        $this->isNatar = $res['natar'];
        $this->type = $res['fieldtype'];
        $this->evasion = $res['evasion'];
        $this->created = $res['created'];
        $this->lastUpdate = $res['lastupdate'];
        $this->celebrationTime = $res['celebration'];
        $this->isCelebrating = $this->celebrationTime > time();
        $this->expansionSlots = [$res['exp1'], $res['exp2'], $res['exp3']];
        $this->occupied = $res['occupied'];
        $this->image = $res['image'];
    }
    
    /**
     * Initialize all village-related objects
     */
    public function initAll()
    {
        $this->setSector();
        $this->setOasis();
        $this->setUnits();
        $this->setEnforcements();
        $this->setTrappedUnits();
        $this->setMovements();
        $this->setUnitsInTraining();
        $this->setUpkeep();
        $this->setBuildings();
        $this->setCulturePointsProduction();
        $this->setSlots();
        $this->setProduction();
        $this->updateResources();
        $this->setBuildingJobs();
        $this->setResearches();
        $this->setTrainableUnits();
        $this->setMarketOffers();
        $this->setTradeRoutes();
        $this->setMerchants();
    }
    
    /**
     * Get the village state
     *
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * Set the village state
     */
    private function setState()
    {
        $this->vref = $this->exists();
        
        if ($this->vref) {
            $this->state = VillageEnums::EXISTS;    
        } else {
            $this->state = VillageEnums::DOES_NOT_EXIST;
        }
    }

    /**
     * Check if the village already exists in the database.
     *
     * @return array Returns the village ref if the village exists, 0 otherwise.
     */
    private function exists(): int
    {
        $sql = 'SELECT
                    wref
                FROM
                    ' . TB_PREFIX . 'vdata
                WHERE
                    ' . ($this->vref > 0 ? ' wref = ?' : ' name = ?') . '
                LIMIT 
                    1';

        $res = $this->db->queryNew($sql, $this->vref > 0 ? $this->vref : $this->name);

        // Check if the village exists
        if (empty($res)) {
            return 0;
        }

        return $res[0]['wref'];
    }

    /**
     * Get one or more village fields
     *
     * @param array $fields The fields to be obtained
     * @return array Returns the fields from the database
     */
    public function getFields(array $fields): array
    {
        $fields = implode(',', $fields);
        
        $sql = 'SELECT
                     '.$fields.'
                 FROM
                     ' . TB_PREFIX . 'vdata
                 WHERE
                     wref = ?';
        
        return $this->db->queryNew($sql, $this->vref)[0];
    }

    /**
     * Set one or more village fields
     *
     * @param array $fields The fields to be set
     * @param array $values The values to be set
     * @return bool True if the query was successful, false otherwise
     */
    public function setFields(array $fields, array $values): bool
    {
        $pairs = [];
        foreach ($fields as $field) {
            $pairs[] = $field . ' = ?';
        }
        
        $pairs = implode(',', $pairs);
        
        $sql = 'UPDATE
                     ' . TB_PREFIX . 'vdata
                 SET
                     ' . $pairs . '
                 WHERE
                     wref = ?';
        
        $values[] = $this->vref;
        
        return $this->db->queryNew($sql, $values);
    }
    
    /**
     * Get the Village oasis
     * 
     * @return array
     */
    public function getOasis(): array
    {
        return $this->oasis;
    }
   
    /**
     * Set the village oasis
     */
    public function setOasis()
    {
        $sql = 'SELECT
                    o.*, w.x, w.y, w.image, w.oasestype
                FROM
                    ' . TB_PREFIX . 'odata as o
                LEFT JOIN
                    ' . TB_PREFIX . 'wdata as w
                ON
                    w.id = o.wref
                WHERE
                    o.conquered = ?';
        
        $res = $this->db->queryNew($sql, $this->vref);

        // Reset the actual oasis
        $this->oasis = [];
        
        // Check if there's at least one oases
        if (empty($res)) {
            return;
        }
        
        // Set the oasis
        foreach ($res as $oases) {
            $this->oasis[] = new Oases(
                $this->db,
                $this,
                $oases['wref'],
                $oases['name'],
                false,
                false,
                $oases['oasestype'],
                [$oases['x'], $oases['y']],
                $oases['conquered'], 
                [$oases['wood'], $oases['clay'], $oases['iron'], $oases['crop']],
                $oases['maxstore'],
                $oases['maxcrop'],
                $oases['lastupdated'],
                $oases['lastupdated2'],
                $oases['loyalty'],
                $oases['high'],
                $oases['image']
            );
        }
    }

    /**
     * Get the village culture points production
     *
     * @return int
     */
    public function getCulturePointsProduction(): int
    {
        return $this->culturePointsProduction;
    }
    
    /**
     * Set the village culture points production
     */
    public function setCulturePointsProduction()
    {
        // Reset the actual culture points production
        $this->culturePointsProduction = 0;
        foreach ($this->getBuildings() as $building) {
            if ($building->level > 0) {
                $this->culturePointsProduction += $building->getCulturePoints();
            }
        }
    }
    
    /**
     * Get the village buildings
     * 
     * @return array
     */
    public function getBuildings(): array
    {
        return $this->buildings;
    }
    
    /**
     * Set the village building jobs
     */
    public function setBuildings()
    {
        $sql = 'SELECT
                    *
                FROM
                    ' . TB_PREFIX . 'fdata
                WHERE
                    vref = ?';
        
        $res = $this->db->queryNew($sql, $this->vref)[0];

        // Reset the actual buildings
        $this->buildings = [];
        for ($i = 1; $i <= 41; $i++) {
            if ($i == 41) {
                $i = 99;
            }

            $this->buildings[$i] = BuildingsFactory::newBuilding($res['f'.$i.'t'], $i, $res['f'.$i]);
        }
    }
    
    /**
     * Update the village buildings
     * 
     * @param int $fields The fields to be set
     * @param int $values The values to be set
     * @param bool Returns true if the query was successful, false otherwise
     */
    public function updateBuildings(array $fields, array $values): bool
    {
        if ($this->getState() == VillageEnums::DOES_NOT_EXIST || empty($fields) || empty($values)) {
            return false;
        }

        $pairs = [];
        foreach ($fields as $field) {
            $pairs[] = $field . ' = ?';
        }

        $pairs = implode(',', $pairs);

        $sql = 'UPDATE
                    ' . TB_PREFIX . 'fdata
                SET
                    ' . $pairs . '
                WHERE
                    vref = ?';

        $values[] = $this->vref;

        if ($this->db->queryNew($sql, $values)) {
            // Update the buildings
            foreach ($this->getBuildings() as $buildingIndex => $building) {
                // Search the right building
                foreach ($fields as $index => $field) {
                    if ($building->position == preg_replace('/\D/', '', $field)) {
                        // Check if the building needs to be removed
                        if ($values[$index] > 0) {
                            // It's a building position
                            if (preg_match('/t/', $field)) {
                                $building->position = $values[$index];
                            } else { // It's a building level
                                $building->level = $values[$index];
                            }
                        } else {
                            // Remove the building
                            unset($this->buildings[$buildingIndex]);
                        }
                    }
                }
            }
  
            return true;
        }
        
        return false;
    }
    
    /**
     * Get the available and used expansion slots
     * 
     * @return array Returns the ['available' => n, 'used' => m] slots
     */
    public function getSlots(): array
    {
        return [
            'used' => $this->usedSlots,
            'available' => $this->availableSlots
        ];
    }
    
    /**
     * Set the available and used expansion slots
     */
    public function setSlots()
    {
        // Initialize the slots
        $this->availableSlots = 0;
        $this->usedSlots = 0;
        
        // Set the used slots
        foreach ($this->expansionSlots as $slot) {
            if ($slot > 0) {
                $this->usedSlots++;
            }
        }
        
        // Set the available slots
        foreach ($this->getBuildings() as $building) {
            if ($building instanceof Residence) {
                $this->availableSlots = floor($building->level / 10);
            } elseif ($building instanceof Palace) {
                $this->availableSlots = floor(($building->level - 5) / 5);
            }
        }
    }

    /**
     * Returns the village building jobs
     * 
     * @return array
     */
    public function getBuildingJobs(): array
    {
        return $this->buildingJobs;
    }
    
    /**
     * Set the village building jobs
     */
    public function setBuildingJobs()
    {
        $sql = 'SELECT
                    *
                FROM 
                    ' . TB_PREFIX . 'bdata
                WHERE
                    wid = ?';

        $res = $this->db->queryNew($sql, $this->vref);

        // Reset the actual building jobs
        $this->buildingJobs = [];
        
        // Check if there's at least one building job
        if (empty($res)) {
            return;
        }
        
        // Set the buildings
        foreach($res as $building) {
            $this->buildingJobs[] = new BuildingJob(
                $this->db,
                $building['id'],
                BuildingsFactory::newBuilding($building['type'], $building['field'], $building['level']),
                $building['timestamp'],
                $building['sort']
            );
        }
    }
    
    /**
     * Add a building job
     * 
     * @param BuildingJob $buildingJob The building job to be added
     */
    public function addBuildingJob(BuildingJob $buildingJob)
    {
        $this->buildingJobs[] = $buildingJob;
    }
    
    /**
     * Remove a building job
     *
     * @param int $jobID The building job ID
     * @param int $jobType The job Type
     * @param bool $returnResources Determines if the resources spent to built it, have to be added
     */
    public function removeBuildingJob(int $jobID, int $jobType = BuildingJobEnums::IN_LOOP, bool $returnResources = true)
    {
        // Initialization
        $jobToDelete = null;
        $jobIndex = 0;
        
        // Search the job ID through the building jobs of the village
        foreach ($this->getBuildingJobs() as $index => $job) {
            if (
                $job->id == $jobID &&
                ($job->sort == $jobType || 
                 $job->sort == $jobType - 1)               
            ) {
                $jobToDelete = $job;
                $jobIndex = $index;
                break;
            }
        }
        
        // Check if it it has been found
        if (is_null($jobToDelete)) {
            return;
        }
        
        // Count the totals building jobs
        $totalBuildingJobsCount = count($this->getBuildingJobs());
        
        // Count the building jobs after the deleted one
        $partialBuildingJobsCount = count(array_slice($this->getBuildingJobs(), $jobIndex + 1));

        // If there are more than one job after the deleted one, update them
        if ($partialBuildingJobsCount >= 1) {
            // Initialize the first waiting loop job
            $first = true;
            $loopTime = 0;
            $time = time();
            
            // If there are more than one building job
            for ($i = $jobIndex + 1; $i < $totalBuildingJobsCount; $i++) {
                // If the building is not in queue
                if ($this->buildingJobs[$i]->sort != $jobType) {
                    continue;
                }

                // Set the first waiting loop job to 0
                if ($first) {
                    $this->buildingJobs[$i]->sort = $jobType - 1;
                    $first = false;
                }
                
                // Reduce the level by one if it's the same type
                if ($jobToDelete->building->position == $this->buildingJobs[$i]->building->position) {
                    $this->buildingJobs[$i]->building->level -= 1;
                }
                
                // Recalculate the building time
                $loopTime += $this->buildingJobs[$i]->building->getNeededTime() + ($this->buildingJobs[$i]->sort == $jobType ? round(60 / SPEED) : 0);
                $this->buildingJobs[$i]->timestamp = $time + $loopTime;

                // Update the database
                $sql = 'UPDATE
                                ' . TB_PREFIX . 'bdata
                            SET
                                timestamp = ?, level = ?, sort = ?
                            WHERE
                                id = ?';
                
                $this->db->queryNew(
                    $sql,
                    $this->buildingJobs[$i]->timestamp,
                    $this->buildingJobs[$i]->building->level,
                    $this->buildingJobs[$i]->sort,
                    $this->buildingJobs[$i]->id
                );
            }
        }

        if ($returnResources) {
            $this->updateResources(
                [
                    'wood' => $jobToDelete->building->getNeededResources()['wood'],
                    'clay' => $jobToDelete->building->getNeededResources()['clay'],
                    'iron' => $jobToDelete->building->getNeededResources()['iron'],
                    'crop' => $jobToDelete->building->getNeededResources()['crop']
                ]
            );
        }

        // Unset the building job locally
        unset($this->buildingJobs[$jobIndex]);
        
        // Set the village fields
        if (
            $jobType != BuildingJobEnums::IN_DEMOLITION_LOOP && 
            $jobToDelete->building->level - 1 == 0 && 
            $jobToDelete->building->id != 40 &&
            $jobToDelete->building->position > 18
        ) {
            $this->updateBuildings(['f' . $jobToDelete->building->position . 't'], [0]);
        }

        // Delete the building job
        $jobToDelete->delete();
    }
    
    /**
     * Get the village enforcements
     *
     * @return array Returns an object array, containing the enforcements in the village
     */
    public function getEnforcements(): array
    {
        return $this->enforcements;
    }
    
    /**
     * Set the village enforcements
     */
    public function setEnforcements()
    {
        $pairs = implode(',', array_fill(0, count($this->getOasis()) + 1, '?'));
        
        $sql = 'SELECT
                    enforcement.*, hero.*, fromVillage.name as fromVillageName, toVillage.name as toVillageName,
                    toOases.name as toOasesName, users.tribe, users.username, users.id as userID
                FROM
                    ' . TB_PREFIX . 'enforcement as enforcement
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as fromVillage
                ON
                    fromVillage.wref = enforcement.`from`
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as toVillage
                ON
                    toVillage.wref = enforcement.vref
                LEFT JOIN
                    ' . TB_PREFIX . 'odata as toOases
                ON
                    toOases.wref = enforcement.vref
                LEFT JOIN
                    ' . TB_PREFIX . 'users as users
                ON
                    users.id = IF(enforcement.`from` = ?, toVillage.owner, fromVillage.owner) 
                LEFT JOIN
                    ' . TB_PREFIX . 'hero as hero
                ON 
                    IF(enforcement.u11 > 0, hero.wref = enforcement.`from`, 0)
                WHERE
                    enforcement.`from` = ?
                OR  
                    enforcement.vref IN(' . $pairs . ')';

        // Set this vref three times
        $vrefs = array_fill(0, 3, $this->vref);
        
        // Set the oasis vrefs
        foreach ($this->getOasis() as $oases) {
            $vrefs[] = $oases->wref;
        } 

        $res = $this->db->queryNew($sql, $vrefs);

        // Reset the actual enforcements
        $this->enforcements = [];

        // Check if there's at least one enforcement
        if (empty($res)) {
            return;
        }

        foreach ($res as $enforcement) {
            $units = [];
            
            for ($i = 1; $i <= 10; $i++) {
                $units[$i] = UnitsFactory::create(
                    $enforcement['from'] == $this->vref ? $this->owner->tribe : $enforcement['tribe'], 
                    $i, 
                    $enforcement['u'.$i]
                );
            }
            
            // Set the hero
            if ($enforcement['u11'] > 0) {
                $units[11] = UnitsFactory::createHero(
                    $enforcement['name'],
                    UnitsFactory::create(
                        $enforcement['from'] == $this->vref ? $this->owner->tribe : $enforcement['tribe'], 
                        $enforcement['unit'], 
                        $enforcement['u'.$i]
                    ),
                    $enforcement['heroid'],
                    $enforcement['uid'],
                    $enforcement['level'],
                    $enforcement['health'],
                    $enforcement['regeneration'],
                    $enforcement['attack'],
                    $enforcement['defence'],
                    $enforcement['attackbonus'],
                    $enforcement['defencebonus']
                );
            }
            
            if (!is_null($enforcement['toVillageName'])) {
                $enforcementToVillage = new Village(
                    $this->db,
                    $enforcement['vref'] == $this->vref ?
                    $this->owner :
                    new User(
                        $this->db,
                        [$enforcement['userID'], $enforcement['username'], $enforcement['tribe']],
                        false, 
                        false
                    ),
                    $enforcement['vref'],
                    $enforcement['toVillageName'] ?? $enforcement['toOasesName'],
                    false,
                    false
                );
            } elseif (!is_null($enforcement['toOasesName'])) {
                $enforcementToVillage = new Oases(
                    $this->db,
                    $enforcement['vref'] == $this->vref ?
                    $this->owner :
                    new User(
                        $this->db,
                        [$enforcement['userID'], $enforcement['username'], $enforcement['tribe']],
                        false,
                        false
                    ),
                    $enforcement['vref'],
                    $enforcement['toOasesName'],
                    false,
                    false
                );
            }
            
            // Set the enforcements
            $this->enforcements[] = new Enforcement(
                $this->db,
                $enforcement['id'],
                new Village(
                    $this->db,
                    $enforcement['from'] == $this->vref ? 
                    $this->owner : 
                    new User($this->db, [$enforcement['userID'], $enforcement['username'], $enforcement['tribe']], false, false), 
                    $enforcement['from'],
                    $enforcement['fromVillageName'],
                    false,
                    false
                ),
                $enforcementToVillage,
                $units
            );
        }
    }

    /**
     * Get the village trapped units
     * 
     * @return array
     */
    public function getTrappedUnits(): array
    {        
        return $this->trappedUnits;
    }
    
    /**
     * Set the village trapped units
     */
    public function setTrappedUnits()
    {
        $sql = 'SELECT
                    prisoners.*, hero.*, fromVillage.name as fromVillageName, toVillage.name as toVillageName, 
                    users.tribe, users.username, users.id as userID
                FROM
                    ' . TB_PREFIX . 'prisoners as prisoners
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as fromVillage
                ON
                    prisoners.`from` = fromVillage.wref
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as toVillage
                ON
                    prisoners.vref = toVillage.wref
                LEFT JOIN
                    ' . TB_PREFIX . 'users as users
                ON
                    users.id = IF(prisoners.`from` = ?, toVillage.owner, fromVillage.owner)
                LEFT JOIN
                    ' . TB_PREFIX . 'hero as hero
                ON
                    IF(prisoners.u11 > 0, prisoners.vref = hero.wref, 0)
                WHERE
                    prisoners.`from` = ?
                OR
                    prisoners.vref = ?';

        $res = $this->db->queryNew($sql, array_fill(0, 3, $this->vref));

        // Reset the actual trapped units
        $this->trappedUnits = [];
        
        // Check if there's at least one trapped unit
        if (empty($res)) {
            return;
        }
        
        foreach ($res as $trappedUnit) {
            $units = [];
            
            for ($i = 1; $i <= 10; $i++) {
                $units[$i] = UnitsFactory::create(
                    $trappedUnit['from'] == $this->vref ? $this->owner->tribe : $trappedUnit['tribe'], 
                    $i, 
                    $trappedUnit['u'.$i]
                );
            }
            
            // Set the trapped hero
            if ($trappedUnit['u11'] > 0) {
                $units[11] = UnitsFactory::createHero(
                    $trappedUnit['name'],
                    UnitsFactory::create(
                        $trappedUnit['from'] == $this->vref ? $this->owner->tribe : $trappedUnit['tribe'], 
                        $trappedUnit['unit'], 
                        $trappedUnit['u'.$i]
                    ),
                    $trappedUnit['heroid'],
                    $trappedUnit['uid'],
                    $trappedUnit['level'],
                    $trappedUnit['health'],
                    $trappedUnit['regeneration'],
                    $trappedUnit['attack'],
                    $trappedUnit['defence'],
                    $trappedUnit['attackbonus'],
                    $trappedUnit['defencebonus']
                    );
            }
            
            // Set the trapped units
            $this->trappedUnits[] = new Trapped(
                $this->db,
                $trappedUnit['id'],
                new Village(
                    $this->db,
                    $trappedUnit['from'] == $this->vref ?
                    $this->owner :
                    new User($this->db, [$trappedUnit['userID'], $trappedUnit['username'], $trappedUnit['tribe']], false, false),
                    $trappedUnit['from'],
                    $trappedUnit['fromVillageName'],
                    false,
                    false
                ),
                new Village(
                    $this->db,
                    $trappedUnit['vref'] == $this->vref ?
                    $this->owner :
                    new User($this->db, [$trappedUnit['userID'], $trappedUnit['username'], $trappedUnit['tribe']], false, false),
                    $trappedUnit['vref'],
                    $trappedUnit['toVillageName'],
                    false,
                    false
                ),
                $units
            );
        }
    }

    /**
     * Get the village units
     * 
     * @return array Returns an object array, containing the units in the village
     */
    public function getUnits(): array
    {
        return $this->units;
    }
    
    /**
     * Set the village units
     */
    public function setUnits()
    {
        $sql = 'SELECT 
                    units.*, hero.*
                FROM
                    ' . TB_PREFIX . 'units as units
                LEFT JOIN
                    ' . TB_PREFIX . 'hero as hero
                ON
                    IF(units.u11 > 0, units.vref = hero.wref, 0)
                WHERE
                    units.vref = ?';

        $res = $this->db->queryNew($sql, $this->vref)[0];

        // Reset the actual units
        $this->units = [];
        for ($i = 1; $i <= 10; $i++) {
            $this->units[$i] = UnitsFactory::create($this->owner->tribe, $i, $res['u'.$i]);
        }
        
        // Set the hero
        if ($res['u11'] > 0) {
            $this->units[11] = UnitsFactory::createHero(
                $res['name'],
                UnitsFactory::create($this->owner->tribe, $res['unit'], $res['u'.$i]),
                $res['heroid'],
                $res['uid'],
                $res['level'],
                $res['health'],
                $res['regeneration'],
                $res['attack'],
                $res['defence'],
                $res['attackbonus'],
                $res['defencebonus']
            );
        }

        // Set the traps (if gauls)
        if ($this->owner->tribe == TribeEnums::GAULS) {
            $this->units[12] = UnitsFactory::create($this->owner->tribe, 12, $res['u12']);
            $this->units[13] = UnitsFactory::create($this->owner->tribe, 13, $res['u13']);
        }
    }
    
    /**
     * Update the village units
     * 
     * @param array $units The units to be updated
     * @param bool $mode If true, it will subtract the units, sum otherwise
     */
    public function updateUnits(array $units, bool $subtract)
    {
        // Initialization
        $pairs = $values = [];

        // Set the units
        foreach($units as $type => $unit) {
            $this->units[$type]->amount += $subtract ? -$unit->amount : +$unit->amount;
            $pairs[] = $field . 'u'.$type.' = ?';
            $values[] = $this->units[$type]->amount;
        }

        $pairs = implode(',', $pairs);
        
        $sql = 'UPDATE
                     ' . TB_PREFIX . 'units
                 SET
                     ' . $pairs . '
                 WHERE
                     vref = ?';
        
        $values[] = $this->vref;

        $this->db->queryNew($sql, $values);
    }
    
    /**
     * Get village troops/merchants movements
     * 
     * @return array
     */
    public function getMovements(): array
    {        
        return $this->movements;
    }

    /**
     * Set village troops/merchants movements
     *
     * @return array
     */
    public function setMovements()
    {
        $pairs = implode(',', array_fill(0, count($this->getOasis()) + 1, '?'));

        $sql = 'SELECT 
                        movement.*, attacks.*, hero.*, fromVillage.name as fromVillageName, 
                        fromOases.name as fromOasesName, toVillage.name as toVillageName,
                        toOases.name as toOasesName, users.tribe, users.username, 
                        users.id as userID
                FROM
                        ' . TB_PREFIX . 'movement as movement
                LEFT JOIN
                        ' . TB_PREFIX . 'attacks as attacks
                ON
                        movement.ref = attacks.id
                LEFT JOIN
                        ' . TB_PREFIX . 'vdata as fromVillage
                ON
                        movement.`from` = fromVillage.wref 
                LEFT JOIN
                        ' . TB_PREFIX . 'odata as fromOases
                ON
                        movement.`from` = fromOases.wref 
                LEFT JOIN
                        ' . TB_PREFIX . 'vdata as toVillage
                ON
                        movement.`to` = toVillage.wref 
                LEFT JOIN
                        ' . TB_PREFIX . 'odata as toOases
                ON
                        movement.`to` = toOases.wref 
                LEFT JOIN
                        ' . TB_PREFIX . 'users as users
                ON
                        users.id = IF(movement.`from` = ?, toVillage.owner, fromVillage.owner)
                LEFT JOIN
                        ' . TB_PREFIX . 'hero as hero
                ON
                        IF(attacks.u11 > 0, hero.wref = IF(movement.type = 7, movement.`to`, movement.`from`), 0)
                WHERE
                        movement.proc = 0 
                AND 
                        (movement.`from` = ?
                OR
                        movement.`to` IN(' . $pairs . '))  
                ORDER BY 
                        endtime ASC';

        // Set this vref three times
        $vrefs = array_fill(0, 3, $this->vref);
        
        // Get the oasis vrefs
        foreach ($this->getOasis() as $oases) {
            $vrefs[] = $oases->wref;
        }
        
        $res = $this->db->queryNew($sql, $vrefs);

        // Reset the movements
        $this->movements = [];
        
        // Check if there's at least one movement
        if (empty($res)) {
            return;
        }

        // Set the movements
        foreach ($res as $movement) {
            $units = [];

            // Trades don't have any units
            if ($movement['type'] != MovementEnums::TRADE && $movement['type'] != MovementEnums::RETURNING_TRADE) {
                // Set the movement troops
                for ($i = 1; $i <= 10; $i++) {
                    $units[$i] = UnitsFactory::create(
                        ($movement['from'] == $this->vref && $movement['type'] != MovementEnums::RETURNING) ||
                        ($movement['to'] == $this->vref && $movement['type'] == MovementEnums::RETURNING) ?
                        $this->owner->tribe :
                        $movement['tribe'],
                        $i,
                        $movement['u'.$i]);
                }

                // Set the hero
                if ($movement['u11'] > 0) {
                    $units[11] = UnitsFactory::createHero(
                        $movement['name'],
                        UnitsFactory::create(
                            ($movement['from'] == $this->vref && $movement['type'] != MovementEnums::RETURNING) ||
                            ($movement['to'] == $this->vref && $movement['type'] == MovementEnums::RETURNING) ?
                            $this->owner->tribe :
                            $movement['tribe'],
                            $movement['unit'],
                            $movement['u'.$i]
                        ),
                        $movement['heroid'],
                        $movement['uid'],
                        $movement['level'],
                        $movement['health'],
                        $movement['regeneration'],
                        $movement['attack'],
                        $movement['defence'],
                        $movement['attackbonus'],
                        $movement['defencebonus']
                        );
                }
            }

            // Set the from village/oases
            if (!is_null($movement['fromVillageName'])) {
                $movementFromWorldCell = new Village(
                    $this->db,
                    ($movement['from'] == $this->vref && $movement['type'] != MovementEnums::RETURNING) ?
                    $this->owner :
                    new User(
                        $this->db,
                        [$movement['userID'], $movement['username'], $movement['tribe']],
                        false,
                        false
                    ),
                    $movement['from'],
                    $movement['fromVillageName'],
                    false,
                    false,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    [],
                    ['x' => $$movement['fromCoordinatesX'], 'y' => $movement['fromCoordinatesY']]
                );
            } elseif (!is_null($movement['fromOasesName'])) {
                $movementFromWorldCell = new Oases(
                    $this->db,
                    ($movement['from'] == $this->vref && $movement['type'] != MovementEnums::RETURNING) ?
                    $this->owner :
                    new User(
                        $this->db,
                        [$movement['userID'], $movement['username'], $movement['tribe']],
                        false,
                        false
                    ),
                    $movement['from'],
                    $movement['fromOasesName'],
                    false,
                    false,
                    0,
                    ['x' => $movement['fromCoordinatesX'], 'y' => $movement['fromCoordinatesY']]
                );
            }
            
            // Set the to village/oases
            if (!is_null($movement['toVillageName'])) {
                $movementToWorldCell = new Village(
                    $this->db,
                    $movement['to'] == $this->vref ?
                    $this->owner :
                    new User(
                        $this->db,
                        [$movement['userID'], $movement['username'], $movement['tribe']], 
                        false, 
                        false
                    ),
                    $movement['to'],
                    $movement['toVillageName'],
                    false,
                    false,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    [],
                    ['x' => $movement['toCoordinatesX'], 'y' => $movement['toCoordinatesY']]
                );
            } elseif(!is_null($movement['toOasesName'])) {
                $movementToWorldCell = new Oases(
                    $this->db,
                    $movement['to'] == $this->vref ?
                    $this->owner :
                    new User(
                        $this->db,
                        [$movement['userID'], $movement['username'], $movement['tribe']],
                        false,
                        false
                    ),
                    $movement['to'],
                    $movement['toOasesName'],
                    false,
                    false,
                    0,
                    ['x' => $$movement['toCoordinatesX'], 'y' => $movement['toCoordinatesY']]
                );
            }

            // Set the movement type
            $this->movements[] = MovementsFactory::create(
                $movement['type'], 
                $this->db,
                $movement['moveid'],
                $movementFromWorldCell,
                $movementToWorldCell,
                $movement['starttime'],
                $movement['endtime'],
                [$movement['wood'], $movement['clay'], $movement['iron'], $movement['crop']],
                $units,
                $movement['merchants'],
                $movement['repetitions'],
                $movement['ref'],
                [$movement['ctar1'] ?? 0, $movement['ctar2'] ?? 0],
                $movement['spy'] ?? 0
            );
        }
    }
    
    /**
     * Add a movement to the village movements
     * 
     * @param Movement $movement The movement to be added
     */
    public function addMovement(Movement $movement)
    {
        $this->movements[] = $movement;
    }
    
    /**
     * Get the units in training
     * 
     * @return array Returns the units in training
     */
    public function getUnitsInTraining(): array
    {
        return $this->training;
    }
    
    /**
     * Set the units in training
     */
    public function setUnitsInTraining()
    {
        $sql = 'SELECT
                    *
                FROM
                    ' . TB_PREFIX . 'training
                WHERE
                    vref = ?
                ORDER BY
                    id
                ASC';
        
        $res = $this->db->queryNew($sql, $this->vref);
        
        // Reset the actual units in training
        $this->training = [];
        
        // Check if there's at least one unit in traning
        if (empty($res)) {
            return;
        }

        // Set the units in training
        foreach ($res as $inTraining) {
            $this->training[] = new Training(
                $inTraining['id'], 
                $inTraining['vref'],
                $inTraining['unit'], 
                UnitsFactory::create($this->owner->tribe, $inTraining['unit'], $inTraining['amount']), 
                $inTraining['eachtime'],
                $inTraining['lasttrainedtime'],
                $inTraining['finishtime'],
                $inTraining['great']
            );
        }
    }
    
    /**
     * Add units in training
     * 
     * @param array $training
     */
    public function addUnitsInTraining(Training $training) 
    {
        $this->training[] = $training;
    }
    
    /**
     * Get the village researches
     * 
     * @return array Returns the village researches
     */
    public function getResearches(): array
    {
        return $this->researches;
    }
    
    /**
     * Set the village researches
     */
    public function setResearches()
    {
        $sql = 'SELECT
                    *
                FROM
                    ' . TB_PREFIX . 'tdata
                WHERE
                    vref = ?';
        
        $res = $this->db->queryNew($sql, $this->vref)[0];
        
        // Reset the actual researches
        $this->researches = [];
        
        // Check if 
        if (empty($res)) {
            return;
        }
        
        // Set the researches
        for ($i = 2; $i <= 9; $i++) {
            $this->researches[$i] = ResearchesFactory::create($this->db, $this->owner->tribe, $i, $res['t'.$i]);
        }
    }

    /**
     * Return the village total resources
     * 
     * @return int
     */
    public function getTotalResources(): int
    {
        return $this->totalResources;
    }
    
    /**
     * Get the village resources
     * 
     * @return array Returns the resources (rounded up to the nearest integer value)
     */
    public function getResources(): array
    {
        $resources = [];
        foreach ($this->resources as $key => $value) {
            $resources[$key] = round($value);
        }
        
        return $resources;
    }

    /**
     * Set the village resources
     * 
     * @param array $resources Resources to be set
     */
    public function setResources(array $resources)
    {
        $this->resources = $resources;
        $this->totalResources = round(array_sum($resources));
    }
    
    /**
     * Update the village resources
     * 
     * @param array $extra
     */
    public function updateResources(array $extra = [])
    {
        // Initialization
        $time = time();
        $timePast = $time - $this->lastUpdate;
        
        //Check if we have to update the resources
        if ($timePast > 0) {
            $resources = [];
            
            // Update the new production
            foreach ($this->getProduction() as $key => $production) {
                if ($key == 'crop') {
                    $production -= $this->getCropConsumption();
                }

                // Calculate the produced resources and sum the extra resources (if any)
                $resources[$key] = min(
                    ($this->resources[$key] + ($production / 3600) * $timePast) + (isset($extra[$key]) ? $extra[$key] : 0), 
                    ($key != 'crop' ? $this->maxStore : $this->maxCrop)
                );
            }
            
            $sql = 'UPDATE
                    ' . TB_PREFIX . 'vdata
                SET
                    wood = ?, clay = ?, iron = ?, crop = ?, lastupdate = ?
                WHERE
                    wref = ?';
            
            $this->db->queryNew(
                $sql,
                $resources['wood'],
                $resources['clay'],
                $resources['iron'],
                $resources['crop'],
                $time,
                $this->vref);
            
            $this->setResources($resources);
        }
    }
    
    /**
     * Get the village upkeep
     * 
     * @return int Returns the upkeep
     */
    public function getUpkeep(): int
    {
        return $this->upkeep;
    }

    //TODO: This can be done directly in the above methods
    /**
     * Set the upkeep of all troops
     */
    public function setUpkeep()
    {
        // Reset the upkeep
        $this->upkeep = 0;
        $this->totalUnits = [];

        if (!empty($this->getUnits())) {
            // Set the units upkeep
            foreach ($this->getUnits() as $index => $unit) {
                $this->upkeep += $unit->upkeep * $unit->amount;
                $this->totalUnits[$index] += $unit->amount; 
            }
        }

        if (!empty($this->getEnforcements())) {
            // Set this village ID
            $vrefs = [$this->vref];

            // Get the oasis wref
            foreach ($this->getOasis() as $oases) {
                $vrefs[] = $oases->wref;
            }

            // Set the enforcements upkeep
            foreach ($this->getEnforcements() as $enforcement) {
                // Check if the enforcement is in the village or in the oasis
                if (in_array($enforcement->to->vref, $vrefs)) {
                    // Get reinforcing units
                    foreach ($enforcement->units as $index => $unit) {
                        $this->upkeep += $unit->upkeep * $unit->amount;
                        
                        // Check if the enforcement belong to this village
                        if ($enforcement->from->vref == $this->vref) {
                            $this->totalUnits[$index] += $unit->amount;
                        }
                    }
                }
                    
                // Check if the enforcement belong to this village
                if ($enforcement->from->vref == $this->vref) {
                    foreach ($enforcement->units as $index => $unit) {
                        $this->totalUnits[$index] += $unit->amount;
                    }
                }
            }
        }

        // Check if there's at least one trapped unit
        if (!empty($this->getTrappedUnits())) {
            // Set the trapped units upkeep
            foreach ($this->getTrappedUnits() as $trapped) {
                // Get trapped units
                if ($trapped->from->vref == $this->vref) {
                    foreach ($trapped->units as $index => $unit) {
                        $this->upkeep += $unit->upkeep * $unit->amount;
                        $this->totalUnits[$index] += $unit->amount; 
                    }
                }
            }
        } 

        // Check if there's at least one moving unit
        if (!empty($this->getMovements())) {
            // Set the movements upkeep
            foreach ($this->getMovements() as $movement) {
                // Get the moving units
                if (!($movement instanceof Trade || $movement instanceof ReturningTrade) &&
                    ((!($movement instanceof Returning) && $movement->from->vref == $this->vref) ||
                    (($movement instanceof Returning && $movement->to->vref == $this->vref)))
                ) {                   
                    foreach ($movement->units as $index => $unit) {
                        $this->upkeep += $unit->upkeep * $unit->amount;
                        $this->totalUnits[$index] += $unit->amount;
                    }
                }
            }
        }
    }
    
    /**
     * Get the village trade routes
     *
     * @return array Returns the trade routes
     */
    public function getTradeRoutes(): array
    {
        return $this->tradeRoutes;
    }
    
    /**
     * Set the offers made in this village
     */
    public function setTradeRoutes()
    {
        $sql = 'SELECT
                    route.*, village.name as villageName
                FROM
                    '. TB_PREFIX . 'route as route
                LEFT JOIN
                    '. TB_PREFIX . 'vdata as village
                ON
                    village.wref = route.`to`
                WHERE
                    route.`from` = ?';
        
        $res = $this->db->queryNew($sql, $this->vref);

        // Reset the actual offers
        $this->tradeRoutes = [];
        
        // Check if there's at least one offer
        if (empty($res)) {
            return;
        }
        
        // Set the offers of this village
        foreach ($res as $tradeRoute) {
            $this->tradeRoutes[] = new TradeRoute(
                $this->db,
                $tradeRoute['id'], 
                $this,
                new Village($this->db, null, $tradeRoute['to'], $tradeRoute['villageName'], false, false), 
                [$tradeRoute['wood'], $tradeRoute['clay'], $tradeRoute['iron'], $tradeRoute['crop']],
                $tradeRoute['start'],
                $tradeRoute['deliveries'], 
                $tradeRoute['timestamp'],
                $tradeRoute['timeleft']
           );
        }
    }
    
    /**
     * Remove a village trade route
     * 
     * @param int $tradeRouteID
     */
    public function removeTradeRoute(int $tradeRouteID)
    {
        unset($this->tradeRoutes[$tradeRouteID]);
    }

    /**
     * Add a new trade route
     *
     * @param TradeRoute $tradeRoute
     */
    public function addTradeRoute(TradeRoute $tradeRoute)
    {
        $this->tradeRoutes[] = $tradeRoute;
    }

    /**
     * Get the offers made in this village
     * 
     * @return array Returns the market offers
     */
    public function getMarketOffers(): array
    {
        return $this->marketOffers;
    }
    
    /**
     * Set the offers made in this village
     */
    public function setMarketOffers()
    {
        $sql = 'SELECT
                    *
                FROM
                    '. TB_PREFIX . 'market
                WHERE
                    vref = ?';
        
        $res = $this->db->queryNew($sql, $this->vref);
        
        // Reset the actual offers
        $this->marketOffers = [];
        
        // Check if there's at least one offer
        if (empty($res)) {
            return;
        }
        
        // Set the offers of this village
        foreach ($res as $offer) {
            $this->marketOffers[] = new Offer(
                $this->db, 
                $offer['id'], 
                $this,
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
     * Add a new market offer
     * 
     * @param Offer $offer
     */
    public function addMarketOffer(Offer $offer)
    {
        $this->marketOffers[] = $offer;   
    }
    
    /**
     * Remove a market offer
     * 
     * @param int $offerID The offer ID
     */
    public function removeMarketOffer(int $offerID)
    {
        unset($this->marketOffers[$offerID]);
    }
    
    /**
     * Get the available and total merchants
     * 
     * @return array Returns [Available merchants, Total merchants]
     */
    public function getMerchants(): array
    {
        return [
            'available' => $this->availableMerchants, 
            'total' => $this->totalMerchants,
            'maxCarry' => $this->merchantsMaxCarry
        ];
    }
    
    //TODO: This can be done directly in the above methods
    /**
     * Set the available and total merchants and the totals
     */
    public function setMerchants()
    {
        // Initialization
        $this->availableMerchants = 0;
        $this->totalMerchants = 0;

        // Set the merchants
        foreach ($this->getBuildings() as $building) {
            if ($building instanceof Marketplace) {
                $this->availableMerchants = $building->level;
                $this->totalMerchants = $building->level;
            }
        }

        // Check if the market is built and there's at least one moving unit
        if ($this->totalMerchants > 0) {
            // Check if there's at least one movement
            if (!empty($this->getMovements())) {
                foreach ($this->getMovements() as $movement) {
                    if (
                        $movement instanceof Trade && $movement->from->vref == $this->vref ||
                        $movement instanceof ReturningTrade && $movement->to->vref == $this->vref
                        ) {
                            $this->availableMerchants -= $movement->merchants;
                        }
                }
            }          
            
            // Check if there's at least one offer
            if (!empty($this->getMarketOffers())){
                foreach ($this->getMarketOffers() as $offer) {
                    $this->availableMerchants -= $offer->merchants;
                }
            }    
        }
        
        // Set the max resources a single merchant cuould carry
        $this->merchantsMaxCarry = $this->owner->tribe == 1 ? 500 : ($this->owner->tribe == 2 ? 1000 : 750);
    }
    
    /**
     * Get the village production
     * 
     * @return array Returns the village production [wood, clay, iron, crop]
     */
    public function getProduction(): array
    {
        return $this->production;
    }
    
    /**
     * Set the village production
     * 
     * @return array
     */
    public function setProduction()
    {
        // Reset the village production
        $this->production = [
            'wood' => 0,
            'clay' => 0,
            'iron' => 0,
            'crop' => 0
        ];

        // Get the village production
        foreach ($this->getBuildings() as $building) {
            switch ($building->id) {
                case BuildingEnums::WOODCUTTER:
                    $this->production['wood'] += $building->getBonus();
                    break;
                case BuildingEnums::CLAY_PIT:
                    $this->production['clay'] += $building->getBonus();
                    break;
                case BuildingEnums::CROPLAND:
                    $this->production['crop'] += $building->getBonus();
                    break;
                case BuildingEnums::IRON_MINE:
                    $this->production['iron'] += $building->getBonus();
                    break;              
            }
        }
    }
    
    /**
     * Get the village trainable units
     * 
     * @return array Returns the units which can be trained
     */
    public function getTrainableUnits(): array
    {
        return $this->trainableUnits;   
    }
    
    /**
     * Set the village trainable units
     */
    public function setTrainableUnits()
    {
        // Initialization
        $this->trainableUnits = [];
        $inTraining = [];

        // Check the total units in training
        foreach ($this->training as $training) {
            $inTraining[$training->type] += $training->unit->amount;
        }

        // Set the trainable units
        foreach ($this->getUnits() as $index => $unit) {
            // Filter out the not researched units
            if (!in_array($index, [1, 10, 11, 12]) && $this->researches[$index]->getState() != ResearchEnums::RESEARCHED) {
                continue;
            }     

            // Check if the maximum amount of chiefs/settlers has been reached
            if ($index == 9) {
                // Calculate the max trainable chiefs
                $maxChiefs = $this->getSlots()['available'] - ($this->getTotalUnits()[9] + $inTraining[9]) - floor(($this->getTotalUnits()[10] + $inTraining[10] + 2) / 3);

                // Set the maximum amount of trainable chiefs
                $unit->max = $maxChiefs;
                
            } elseif ($index == 10) {
                // Calculate the max trainable settlers
                $maxSettlers = ($this->getSlots()['available'] * 3) - (($this->getTotalUnits()[9] + $inTraining[9]) * 3) - ($this->getTotalUnits()[10] + $inTraining[10]);

                // Set the maximum amount of trainable settler
                $unit->max = $maxSettlers;
            }
                
            // Check if this unit has reached his limit
            if ($unit->max <= 0) {
                continue;
            }

            // Add the unit to the trainable units list
            $this->trainableUnits[$index] = $unit;
        }
    }
    
    /**
     * Get the village units
     * 
     * @return array
     */
    public function getTotalUnits(): array
    {
        if (empty($this->totalUnits)) {
            return array_fill(1, 13, 0);
        }

        return $this->totalUnits;
    }

    /**
     * Get the village crop consumption
     * 
     * @return int Returns the village crop consumption
     */
    public function getCropConsumption(): int
    {
        return ceil(($this->pop + $this->getUpkeep()) / ($this->isNatar ? 2 : 1));
    }
    
    /**
     * Get the village sector
     *
     * @return int Return the village sector
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set the village sector
     */
    private function setSector()
    {
        if ($this->coordinates['x'] <= 0 && $this->coordinates['y'] >= 0) { // (- | +)
            $this->sector = 1;
        } elseif ($this->coordinates['x'] >= 0 && $this->coordinates['y'] >= 0) { // (+ | +)
            $this->sector = 2;
        } elseif ($this->coordinates['x'] <= 0 && $this->coordinates['y'] <= 0) { // (- | -)
            $this->sector = 3;
        } elseif ($this->coordinates['x'] >= 0 && $this->coordinates['y'] <= 0) { // (+ | -)
            $this->sector = 4;
        }
    }
    
    /**
     * Instantly complete all building/researches/upgrades in the village
     */
    public function finishAll() 
    {
        // Check if this is a nataren village
        if ($this->isNatar) {
            return;
        }

        foreach ($this->getBuildingJobs() as $building) {
            // Residence and Palace cannot be completed instantly
            if ($building instanceof Residence || $building instanceof Palace) {
                continue;
            }
            
            //Finish all buildings
        }
    }
}
