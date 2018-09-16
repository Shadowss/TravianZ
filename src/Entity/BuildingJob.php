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

/**
 * @author iopietro
 */
class BuildingJob
{
    /**
     * @var int The building job ID
     */
    public $id;
    
    /**
     * @var Building The building type
     */
    public $building;
    
    /**
     * @var int The finishing time of the building
     */
    public $timestamp;
    
    /**
     * @var int The building job type
     * @example Normal, in loop, master builder, demolition
     */
    public $sort;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db,
        int $id,
        Building $building,
        int $timestamp,
        int $sort
    ) {
        $this->db = $db;
        $this->id = $id;
        $this->building = $building;
        $this->timestamp = $timestamp;
        $this->sort = $sort;
    }
    
    /**
     * Add the Building Job
     *
     * @return mixed
     */
    public function add(int $vref)
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX . 'bdata
                        (wid, field, type, timestamp, level, sort)
                VALUES
                        (?, ?, ?, ?, ?, ?)';

        $this->id = $this->db->queryNew(
            $sql,
            $vref,
            $this->building->position,
            $this->building->id,
            $this->timestamp,
            $this->building->level,
            $this->sort
        );
    }
    
    /**
     * Delete the Building Job
     */
    public function delete()
    {
        $sql = 'DELETE FROM
                        ' . TB_PREFIX . 'bdata
                WHERE 
                        id = ?';
        
        $this->db->queryNew($sql, $this->id);
    }
    
    /**
     * Set one or more Building Job fields
     *
     * @param array $fields The fields to be set
     * @param array $values The values to be set
     * @return bool True if the query was successful, false otherwise
     */
    public function setFields(array $fields, array $values): bool
    {
        //if ($this->state == BuildingEnums::DOES_NOT_EXIST)
           // return false;
            
        $pairs = [];
        foreach ($fields as $field) {
            $pairs[] = $field . ' = ?';
        }
        
        $pairs = implode(',', $pairs);
        
        $sql = 'UPDATE
                     ' . TB_PREFIX . 'bdata
                 SET
                     ' . $pairs . '
                 WHERE
                     id = ?';
        
        $values[] = $this->id;
        
        return $this->db->queryNew($sql, $values);
    }
}