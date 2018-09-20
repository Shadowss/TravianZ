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
use TravianZ\Enums\MovementEnums;

/**
 * @author iopietro
 */
abstract class Movement
{
    /**
     * @var int The movement ID
     */
    public $id;
    /**
     * @var int The movement ref
     */
    public $ref;
    
    /**
     * @var Village From what village it arrives
     */
    public $from;
    
    /**
     * @var Village Where it will ll land
     */
    public $to;
    
    /**
     * @var int When it has been started
     */
    public $startTime;
    
    /**
     * @var int When it will land
     */
    public $endTime;
    
    /**
     * @var int The movement type
     */
    public $type;

    /**
     * @var array The robbed/sent resources
     */
    public $resources;
    
    /**
     * @var IDbConnection
     */
    protected $db;
    
    public function __construct(
        IDbConnection $db,
        int $id,
        int $ref,
        WorldCell $from,
        WorldCell $to, 
        int $startTime,
        int $endTime,
        int $type,
        array $resources
    ) {
        $this->db = $db;
        $this->id = $id;
        $this->ref = $ref;
        $this->from = $from;
        $this->to = $to;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->type = $type;
        $this->resources = $resources;
    }

    /**
     * Set the proc of a movement
     * 
     * @param int $proc 0 if deleted, 1 otherwise
     */
    public function setProc(int $proc)
    {
        $sql = 'UPDATE
                    ' . TB_PREFIX . 'movement
                SET 
                    proc = ?
                WHERE
                    moveid = ?';
        
        $this->db->queryNew($sql, $proc, $this->id);
    }
    
    /**
     * Set one or more movement fields
     *
     * @param array $fields The fields to be set
     * @param array $values The values to be set
     * @return bool True if the query was successful, false otherwise
     */
    public function setFields(array $fields, array $values): bool
    {
        if ($this->state == MovementEnums::DOES_NOT_EXIST) {
            return false;
        }
        
        $pairs = [];
        foreach ($fields as $field) {
            $pairs[] = $field . ' = ?';
        }
        
        $pairs = implode(',', $pairs);
        
        $sql = 'UPDATE
                     ' . TB_PREFIX . 'movement
                 SET
                     ' . $pairs . '
                 WHERE
                     moveid = ?';
        
        $values[] = $this->id;
        
        return $this->db->queryNew($sql, $values);
    }
    
    /**
     * Add a movement to the database
     *
     * @return bool Return true if the query was successful, false otherwise
     */
    public function addMovement(int $merchants = 0, int $repetitions = 0): bool
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX . 'movement
                        (`from`, `to`, ref, starttime, endtime, merchants, repetitions, wood, clay, iron, crop, type)
                VALUES
                        (?, ?, ?, ?, ?, ?, ?, IFNULL(?, DEFAULT(wood)), IFNULL(?, DEFAULT(clay)), IFNULL(?, DEFAULT(iron)), IFNULL(?, DEFAULT(crop)), ?)';

        $this->id = $this->db->queryNew(
            $sql,
            $this->from->vref,
            $this->to->vref,
            $this->ref,
            $this->startTime,
            $this->endTime,
            $merchants,
            $repetitions,
            $this->resources[0],
            $this->resources[1],
            $this->resources[2],
            $this->resources[3],
            $this->type
        );
        
        return $this->id;
    }
}