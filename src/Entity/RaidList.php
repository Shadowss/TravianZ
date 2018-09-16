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
class RaidList
{
    /**
     * @var int The raid list ID
     */
    public $id;   
    
    /**
     * @var int The id of the farm list, the raid list belong to
     */
    public $farmListID;
    
    /**
     * @var Village The target village
     */
    public $to;
    /**
     * @var Report The last report to that village
     */
    public $lastReport;
    
    /**
     * @var array The raid list units
     */
    private $units;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db, 
        int $id,
        int $farmListID,
        WorldCell $to,
        array $units,
        $lastReport
    ) {
        $this->db = $db;
        $this->id = $id;
        $this->farmListID = $farmListID;
        $this->to = $to;
        $this->setUnits($units);
        $this->lastReport = $lastReport;
    }
    
    /**
     * Get the raid list units
     * 
     * @return array Returns the raid list units
     */
    public function getUnits(): array
    {
       return $this->units; 
    }
    
    /**
     * Set the raid list units
     * 
     * @param array $units The units to be set
     */
    public function setUnits(array $units)
    {
        foreach ($units as $type => $unit) {
            // Set the unit amount to 0 if null
            $unit->amount = $unit->amount ?? 0;
            
            // Set the unit
            $this->units[$type] = $unit;
        }
    }
    
    /**
     * Add the raid list
     */
    public function add()
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX .'raidlist
                        (lid, `to`, u1, u2, u3, u4, u5, u6)
                VALUES
                        (?, ?, ?, ?, ?, ?, ?, ?)';
        
        $this->id = $this->db->queryNew(
            $sql,
            $this->farmListID,
            $this->to->vref,
            $this->getUnits()[1]->amount ?? 0,
            $this->getUnits()[2]->amount ?? 0,
            $this->getUnits()[3]->amount ?? 0,
            $this->getUnits()[4]->amount ?? 0,
            $this->getUnits()[5]->amount ?? 0,
            $this->getUnits()[6]->amount ?? 0
        );
    }
    
    /**
     * Modify the raid list
     */
    public function update()
    {
        // Initialization
        $pairs = $values = [];
        
        // Set the units
        foreach($this->getUnits() as $type => $unit) {
            $pairs[] = $field . 'u'.$type.' = ?';
            $values[] = $unit->amount;
        }

        $pairs = implode(',', $pairs);

        $sql = 'UPDATE
                     ' . TB_PREFIX . 'raidlist
                 SET
                     ' . $pairs . ', `to` = ?, lid = ?
                 WHERE
                     id = ?';

        $values[] = $this->to->vref;
        $values[] = $this->farmListID;
        $values[] = $this->id;

        $this->db->queryNew($sql, $values);
    }
    
    /**
     * Delete the raid list
     */
    public function delete()
    {
        $sql = 'DELETE FROM
                    ' . TB_PREFIX .'raidlist
                WHERE
                    id = ?';
        
        $this->db->queryNew($sql, $this->id);
    }
}