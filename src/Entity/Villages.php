<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: martinambrus <https://github.com/martinambrus>
 *          iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Entity;

use TravianZ\Database\IDbConnection;

/**
 * @author iopietro
 */
class Villages
{

    /**
     *
     * @var int The Villages count
     */
    private $count;

    /**
     *
     * @var array An array with the villages
     */
    private $villages;

    /**
     *
     * @var IDbConnection
     */
    private $db;

    public function __construct(IDbConnection $db, array $villages = [])
    {
        // Properties initialization
        $this->db = $db;
        $this->count = 0;
        $this->setVillages($villages);
    }

    /**
     * Initialize the actual villages
     * 
     * @param array The village vrefs
     */
    public function initByVrefs(array $vrefs)
    {
        $fields = implode(',', array_fill(0, count($vrefs), '?'));

        $sql = 'SELECT
                    v.*, w.x, w.y, w.fieldtype, u.id as userID, u.username, u.tribe
                FROM
                    ' . TB_PREFIX . 'vdata as v
                INNER JOIN
                    ' . TB_PREFIX . 'wdata as w
                ON
                    w.id = v.wref
                INNER JOIN
                    ' . TB_PREFIX . 'users as u
                ON
                    u.id = v.owner
                WHERE
                    v.wref IN(' . $fields . ')';

        $res = $this->db->queryNew($sql, $vrefs);

        // Check if there are some villages with that owner
        if (empty($res)) {
            return;
        }

        // Add the villages
        foreach ($res as $resultedVillage) {
            // Create the village
            $this->addVillage(
                $this->createVillage(
                    $resultedVillage, 
                    new User(
                        $this->db, 
                        [$resultedVillage['userID'], $resultedVillage['username'], $resultedVillage['tribe']],
                        false, 
                        false
                    )
                )
            );
        }
    }
    
    /**
     * Initialize the villages with a certain owner
     * 
     * @param int $owner
     */
    public function initByOwner(User $owner = null)
    {
        $sql = 'SELECT
                    v.*, w.x, w.y, w.fieldtype
                FROM
                    ' . TB_PREFIX . 'vdata as v
                INNER JOIN
                    ' . TB_PREFIX . 'wdata as w
                ON
                    w.id = v.wref
                WHERE
                    v.owner = ?';
        
        $res = $this->db->queryNew($sql, $owner->id);

        // Check if there are some villages with that owner
        if (empty($res)) {
            return;
        }

        // Add the villages
        foreach ($res as $resultedVillage) {
            // Create the village
            $this->addVillage($this->createVillage($resultedVillage, $owner));
        }
    }
    
    /**
     * Create a village with the passed datas
     * 
     * @param array $datas The datas
     * @param User $owner The village owner
     * @return Village Returns the village
     */
    public function createVillage(array $datas, User $owner): Village
    {
        // Create the village
        $village = new Village(
            $this->db,
            $owner,
            $datas['wref'],
            $datas['name'],
            false,
            false,
            0,
            0,
            $datas['capital'],
            $datas['pop'],
            $datas['natar'],
            $datas['fieldtype'],
            [],
            ['x' => $datas['x'], 'y' => $datas['y']]
        );
        
        $village->culturePoints = $datas['cp'];
        $village->setResources([
            'wood' => $datas['wood'],
            'clay' => $datas['clay'],
            'iron' => $datas['iron'],
            'crop' => $datas['crop']
        ]);
        $village->loyalty = $datas['loyalty'];
        $village->maxStore = $datas['maxstore'];
        $village->maxCrop = $datas['maxcrop'];
        $village->isNatar = $datas['natar'];
        $village->evasion = $datas['evasion'];
        $village->created = $datas['created'];
        $village->celebrationTime = $datas['celebration'];
        $village->lastUpdate = $datas['lastupdate'];
        $village->isCelebrating = $village->celebrationTime > time();
        $village->expansionSlots = [$datas['exp1'],$datas['exp2'], $datas['exp3']];
        $village->occupied = $datas['occupied'];
        $village->image = $datas['image'];
        
        // Return the village
        return $village;
    }

    /**
     * Get the villages count
     *
     * @return int Returns the villages count
     */
    public function getVillagesCount(): int
    {
        return $this->count;
    }

    /**
     * Get the villages
     * 
     * @return array Returns the array of villages
     */
    public function getVillages(): array
    {
        return $this->villages;
    }
    
    /**
     * Set the villages
     * 
     * @param array $villages The villages array
     */
    public function setVillages(array $villages)
    {
        $this->villages = $villages;
        $this->count = count($villages);
    }
    
    /**
     * Add a village to the villages array
     * 
     * @param Village $village The new village to be added
     */
    public function addVillage(Village $village)
    {
        $this->villages[] = $village;
        $this->count++;
    }
    
    /**
     * Create new villages
     *
     * @param array $troopsArray The troops that need to be added in the village(s)
     * @param array $buildingsArray The buildings that need to be created in the village(s)
     */
    public function create(array $troopsArray = [], array $buildingsArray = [])
    {
        // Initialize the variables
        $vrefs = $takenVrefs = $countedVrefs = $generatedVrefs = $i = [];
        
        // Count each village sector, to check how many villages per sector must be created
        foreach ($this->villages as $village) {
            if ($village->vref == 0) {
                $countedVrefs[$village->mode][$village->getSector()]++;
            }
        }
        
        // Generate the number of desired village for each sector
        // and merge them with the more general 'vrefs' array
        foreach ($countedVrefs as $mode => $totalCount) {
            foreach ($totalCount as $sector => $count) {
                $generatedVrefs = $this->generateBase($sector, $mode, $count);
                
                $vrefs[$mode] = array_merge((array) $vrefs[$mode], $generatedVrefs);
                
                if (empty($i[$mode])) {
                    $i[$mode] = 0;
                }
            }
        }
        
        // Create the villages
        foreach ($this->villages as $village) {
            // Check if the village vref isn't already set and assing one among the generated ones
            if ($village->vref == 0) {
                $village->vref = $vrefs[$village->mode][$i[$village->mode]++];
            }
            // Merge the vrefs into an unique array
            $takenVrefs[] = $village->vref;
            $villageTypes[] = $village->type;
        }
        
        // Add the villages
        $this->add($this->villages);
        
        // Create tables for the just generated villages
        $this->addResourceFields($takenVrefs, $villageTypes, $buildingsArray);
        $this->setFieldTaken($takenVrefs);
        $this->addUnits($takenVrefs, $troopsArray);
        $this->addTech($takenVrefs);
        $this->addABTech($takenVrefs);
    }

    /**
     * Generates a list of 'free to take' villages
     *
     * @param int $sector The map sector, (+ | -), (- | +), (+ | +), (- | -) [0 and > 3, 1, 2, 3]
     * @param int $mode 0 if villages need be generated under certain filters, 1 if not
     * @param int $numberOfVillages Number of villages which need to be generated
     * @return array Return the generated villages
     */
    private function generateBase(int $sector, int $mode = 0, int $numberOfVillages = 1): array
    {
        // Don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
        // It shouldn't be necessary, but it could be in low end computers
        @set_time_limit(0);
        
        // Variables initializations
        $numberOfRows = $count = 0;
        $villages = [];
        
        while ($numberOfVillages > 0) {
            switch ($mode) {
                case 0:
                    $daysPassedFromStart = ($this->time - strtotime(START_DATE) - strtotime(date('d.m.Y')) + strtotime(START_TIME)) / 86400;
                    
                    $radiusMin = min(round(pow(2 * ($daysPassedFromStart / 5 * SPEED), 2)), round(pow(WORLD_MAX * 0.8, 2)) + round(pow(WORLD_MAX * 0.8, 2)));
                    $radiusMax = min(round(pow(4 * ($daysPassedFromStart / 5 * SPEED), 2)), pow(WORLD_MAX, 2) + pow(WORLD_MAX, 2));
                    break;
                
                case 1:
                default:
                    $radiusMin = 1;
                    $radiusMax = pow(WORLD_MAX, 2);
                    break;
                
                case 2: // Small artifacts & WW building plans
                    $radiusMin = round(pow(WORLD_MAX * 0.50, 2));
                    $radiusMax = round(pow(WORLD_MAX * 0.75, 2));
                    break;
                
                case 3: // Large artifacts
                    $radiusMin = round(pow(WORLD_MAX * 0.35, 2));
                    $radiusMax = round(pow(WORLD_MAX * 0.55, 2));
                    break;
                
                case 4: // Unique artifacts
                    $radiusMin = round(pow(WORLD_MAX * 0.05, 2));
                    $radiusMax = round(pow(WORLD_MAX * 0.25, 2));
                    break;
                
                case 5: // WW villages
                    $radiusMin = round(pow(WORLD_MAX * 0.8, 2));
                    $radiusMax = round(pow(WORLD_MAX, 2));
                    break;
            }
            
            // Select the sector
            switch ($sector) {
                case 1:
                    $sector = "x <= 0 AND y >= 0";
                    break; // - | +
                case 2:
                    $sector = "x >= 0 AND y >= 0";
                    break; // + | +
                case 3:
                    $sector = "x <= 0 AND y <= 0";
                    break; // - | -
                case 4:
                default:
                    $sector = "x >= 0 AND y <= 0"; // + | -
            }
            
            // Choose villages beetween two circumferences, by using their formula (x^2 + y^2 = r^2)
            $sql = 'SELECT 
                          id
                    FROM 
                          ' . TB_PREFIX . 'wdata 
                    WHERE 
                          fieldtype = 3 
                    AND 
                          ' . $sector . '
                    AND 
                          (POWER(x, 2) + POWER(y, 2) >= ? AND POWER(x, 2) + POWER(y, 2) <= ?) 
                    AND
                          occupied = 0 
                    ORDER BY RAND() 
                    LIMIT 
                          ?';
            
            $res = $this->db->queryNew($sql, $radiusMin, $radiusMax, $numberOfVillages);
            
            // Prevent an infinite loop
            $resultedRows = count($res);
            if ($resultedRows == 0 && $count >= 20) {
                break;
            }
            
            // Fill the villages array
            $villages = array_merge($villages, $res);
            
            $numberOfRows += $resultedRows;
            $numberOfVillages -= $resultedRows;
            $count++;
            
            // If there are no more free cells in that sector, it have to be changed
            // This instruction will be used only (in the next cicle(s)) if not all vrefs have been generated yet
            $sector = rand(1, 4);
        }
        
        foreach ($villages as $village) {
            $vrefs[] = $village['id'];
        }
        
        return $vrefs;
    }

    /**
     * Create a series of villages
     *
     * @param $villages array The array of villages
     * @return bool Returns true if the query was successful, false otherwise
     */
    private function add(array $villages): bool
    {
        $pairs = $values = [];
        foreach ($villages as $village) {
            $pairs[] = implode(',', array_fill(0, 16, '?'));
            $values = array_merge($values, [$village->vref, $village->owner->id, $village->name, $village->isCapital, $village->pop, 1, 0, 750, 750, 750, STORAGE_BASE, 750, STORAGE_BASE, $village->created, $village->created, $village->isNatar]);
        }
        
        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'vdata
                    (wref, owner, name, capital, pop, cp, celebration, wood, clay, iron, maxstore, crop, maxcrop, lastupdate, created, natar)
                VALUES
                    (' . implode('),(', $pairs) . ')';
        
        return $this->db->queryNew($sql, $values);
    }

    /**
     * Take one or multiple village IDs
     *
     * @param array $ids The village IDs
     * @return bool Return true if the query was successful, false otherwise
     */
    private function setFieldTaken(array $ids): bool
    {
        $pairs = array_fill(0, count($ids), '?');
        $sql = 'UPDATE 
                    ' . TB_PREFIX . 'wdata 
                SET 
                    occupied = 1 
                WHERE 
                    id IN(' . implode(',', $pairs) . ')';
        
        return $this->db->queryNew($sql, $ids);
    }

    /**
     *
     * Add the buildings tables to a specified village(s), and its relative buildings
     *
     * @param array $vrefsThe village ID(s)
     * @param array $types The villages type
     * @param array $buildingsArray divided in two portion, which contains the types (unidimensional array) and the values of the
     *        buildings to be added (bidimensional array)
     * @return bool Return true if the query was successful, false otherwise
     */
    private function addResourceFields(array $vrefs, array $types, array $buildingsArray = [])
    {
        // Set the default villages structure (resources fields and main building)
        $defaultVillage = 'vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t' . (!empty($buildingsArray) ? ',' . implode(',', $buildingsArray[0]) : ',f26,f26t');
        $defaultValues = $pairs = [];
        $buildingsCount = !empty($buildingsArray) ? count($buildingsArray[0]) : 2;
        
        // Select the village type and assemble the building values
        foreach ($vrefs as $index => $vref) {
            $pairs[] = implode(',', array_fill(0, 19 + $buildingsCount, '?'));
            
            $defaultValues[] = $vref;
            
            $defaultValues = array_merge($defaultValues, $this->getVillageType($types[$index]), !empty($buildingsArray) ? $buildingsArray[1][$index] : [1, 15]);
        }
        
        $sql = 'INSERT INTO 
                        ' . TB_PREFIX . 'fdata 
                        (' . $defaultVillage . ')
                VALUES
                        (' . implode('),(', $pairs) . ')';
        
        return $this->db->queryNew($sql, $defaultValues);
    }

    /**
     * Add the unit table(s) and troops if presents
     *
     * @param array $vrefs The village ID(s)
     * @param array $troopsArray divided in two portion, which contains the types (unidimensional array) and the values of the
     *        troops that need to be added (bidimensional array)
     * @return bool Returns true if the query was successful, false otherwise
     */
    private function addUnits(array $vrefs, array $troopsArray = []): bool
    {
        // Varible initialization
        $types = '';
        $pairs = $values = [];
        
        // Check if the troops array is empty
        if (!empty($troopsArray)) {  
            $types = ',u' . implode(',u', $troopsArray[0]);
        }
        
        foreach ($vrefs as $index => $vref) {
            $values[] = $vref;
            $pairs[] = '?';

            if (!empty($troopsArray)) {
                $pairs[] = implode(',', array_fill(0, 10, '?'));
                $values = array_merge($values, $troopsArray[1][$index]);
            } 
        }
        
        $sql = 'INSERT INTO 
                        ' . TB_PREFIX . 'units 
                        (vref' . $types . ') 
                values 
                        (' . implode('),(', $pairs) . ')';
        
        return $this->db->queryNew($sql, $values);
    }

    /**
     * Add the Tech table(s)
     *
     * @param array $vrefs The village ID(s
     * @return bool Returns true if the query was successful, false otherwise
     */
    private function addTech(array $vrefs): bool
    {
        $pairs = array_fill(0, count($vrefs), '?');
        $sql = 'INSERT INTO 
                        ' . TB_PREFIX . 'tdata 
                        (vref) 
                VALUES 
                        (' . implode('),(', $pairs) . ')';
        
        return $this->db->queryNew($sql, $vrefs);
    }

    /**
     * Add the ABTech table(s)
     *
     * @param array $vrefs The village ID(s
     * @return bool Returns true if the query was successful, false otherwise
     */
    private function addABTech(array $vrefs): bool
    {
        $pairs = array_fill(0, count($vrefs), '?');
        $sql = 'INSERT INTO 
                        ' . TB_PREFIX . 'abdata 
                        (vref) 
              VALUES 
                        (' . implode('),(', $pairs) . ')';
        
        return $this->db->queryNew($sql, $vrefs);
    }

    /**
     * Get the type of a village
     *
     * @param int $type The village type
     * @return string Returns the type of a village
     */
    private function getVillageType(int $type): array
    {
        switch ($type) {
            case 1:
                return [4, 4, 1, 4, 4, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 2:
                return [3, 4, 1, 3, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 3:
                return [1, 4, 1, 3, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 4:
                return [1, 4, 1, 2, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 5:
                return [1, 4, 1, 3, 1, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 6:
                return [4, 4, 1, 3, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 2, 4, 4];
            case 7:
                return [1, 4, 4, 1, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 8:
                return [3, 4, 4, 1, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 9:
                return [3, 4, 4, 1, 1, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 10:
                return [3, 4, 1, 2, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            case 11:
                return [3, 1, 1, 3, 1, 4, 4, 3, 3, 2, 2, 3, 1, 4, 4, 2, 4, 4];
            case 12:
                return [1, 4, 1, 1, 2, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
            default:
                return [4, 4, 1, 4, 4, 2, 3, 4, 4, 3, 3, 4, 4, 1, 4, 2, 1, 2];
        }
    }
}

