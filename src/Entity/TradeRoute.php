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
class TradeRoute
{
    /**
     * @var int the trade route ID
     */
    public $id;
    
    /**
     * @var Village The village in which the trade route was created
     */
    public $from;
    
    /**
     * @var Village The village in which the trade route must be delivered
     */
    public $to;
    
    /**
     * @var int The hour in which the merchants must start to deliver the resources
     */
    public $start;
    
    /**
     * @var int The number of deliveries
     */
    public $deliveries;
    
    /**
     * @var int The timestamp
     */
    public $timestamp;
    
    /**
     * @var array The trade route resources
     */
    public $resources;
    
    /**
     * @var int The timeleft for the trade route
     */
    public $timeLeft;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db,
        int $id,
        Village $from,
        Village $to,
        array $resources,
        int $start,
        int $deliveries,
        int $timestamp,
        int $timeLeft
        ) {
            $this->db = $db;
            $this->id = $id;
            $this->from = $from;
            $this->to = $to;
            $this->setResources($resources);
            $this->start = $start;
            $this->deliveries = $deliveries;
            $this->timestamp = $timestamp;
            $this->timeLeft = $timeLeft;
    }
    
    /**
     * Get the resources
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set the resources
     * 
     * @param array $resources
     */
    public function setResources(array $resources)
    {
        foreach ($resources as $key => $value) {
            $this->resources[$key] = $value ?? 0;
        }
    }
    
    /**
     * Get the total resources of the trade route
     * 
     * @return int Returns the total resources
     */
    public function getTotalResources(): int
    {
        return array_sum($this->resources);
    }
    
    /**
     * Accept the trade route
     */
    public function extend()
    {
        //Initialize
        $time = time();
        
        // Check if the trade route time left is below the actual time
        if ($this->timeLeft < $time) {
            // Set the new time and extend the trade route
            $this->timeLeft = $time + 604800;
        } else {
            // Extend the trade route
            $this->timeLeft += 604800;
        }

        $sql = 'UPDATE
                    ' . TB_PREFIX . 'route
                SET
                    timeleft = ?
                WHERE
                    id = ?';
        
        $this->db->queryNew($sql, $this->timeLeft, $this->id);
    }
    
    /**
     * Delete the trade route
     */
    public function delete()
    {
        $sql = 'DELETE FROM
                    ' . TB_PREFIX . 'route
                WHERE
                    id = ?';
        
        $this->db->queryNew($sql, $this->id);
    }
    
    /**
     * Add the trade route
     */
    public function add()
    {
        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'route
                    (uid, `from`, `to`, wood, clay, iron, crop, start, deliveries, timestamp, timeleft)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        $id = $this->db->queryNew(
            $sql,
            $this->from->owner->id,
            $this->from->vref,
            $this->to->vref,
            $this->resources[0],
            $this->resources[1],
            $this->resources[2],
            $this->resources[3],
            $this->start,
            $this->deliveries,
            $this->timestamp,
            $this->timeLeft
        );
        
        // Set the new id
        $this->id = $id;
    }
    
    /**
     * Update the trade route
     * 
     * @param array $resources
     * @param int $start
     * @param int $deliveries
     */
    public function update() 
    {
        $sql = 'UPDATE
                    ' . TB_PREFIX . 'route
                SET
                    wood = ?,
                    clay = ?,
                    iron = ?,
                    crop = ?,
                    start = ?,
                    deliveries = ?
                WHERE
                    id = ?';
        
        $this->db->queryNew(
            $sql,
            $this->resources[0],
            $this->resources[1],
            $this->resources[2],
            $this->resources[3],
            $this->start,
            $this->deliveries,
            $this->id
        );
    }
}