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
class Offer
{
    /**
     * @var int the offer ID
     */
    public $id;
    
    /**
     * @var Village The village in which the offer was created
     */
    public $from;
    
    /**
     * @var int The type of the offered resource
     */
    public $resourceOffered;
    
    /**
     * @var int The amount of the offered resource
     */
    public $resourceOfferedAmount;
    
    /**
     * @var int The type of the wanted resource 
     */
    public $resourceWanted;
    
    /**
     * @var int The amount of the wanted resource
     */
    public $resourceWantedAmount;
    
    /**
     * @var int The maximum time allowed (in hours)
     */
    public $maxTime;
    
    /**
     * @var int The allowed alliance
     */
    public $alliance;
    
    /**
     * @var int The number of merchants pending
     */
    public $merchants;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db,
        int $id,
        Village $from,
        int $resourceOffered, 
        int $resourceOfferedAmount,
        int $resourceWanted, 
        int $resourceWantedAmount,
        int $maxTime,
        int $alliance,
        int $merchants
    ) {
        $this->db = $db;
        $this->id = $id;
        $this->from = $from;
        $this->resourceOffered = $resourceOffered;
        $this->resourceOfferedAmount = $resourceOfferedAmount;
        $this->resourceWanted = $resourceWanted;
        $this->resourceWantedAmount = $resourceWantedAmount;
        $this->maxTime = $maxTime;
        $this->alliance = $alliance;
        $this->merchants = $merchants;
    }
    
    /**
     * Accept the offer
     */
    public function accept()
    {
        $sql = 'UPDATE
                    ' . TB_PREFIX . 'market
                SET
                    accept = 1
                WHERE
                    id = ?';
        
        $this->db->queryNew($sql, $this->id);
    }
    
    /**
     * Delete the offer
     */
    public function delete()
    {
        $sql = 'DELETE FROM
                    ' . TB_PREFIX . 'market
                WHERE
                    id = ?';
        
        $this->db->queryNew($sql, $this->id);
    }
    
    /**
     * Add the offer
     */
    public function add()
    {
        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'market
                    (vref, offered, offeredAmount, wanted, wantedAmount, maxtime, alliance, merchants)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?)';
        
        $id = $this->db->queryNew(
            $sql, 
            $this->from->vref,
            $this->resourceOffered,
            $this->resourceOfferedAmount,
            $this->resourceWanted,
            $this->resourceWantedAmount,
            $this->maxTime,
            $this->alliance,
            $this->merchants
        );
        
        // Set the new id
        $this->id = $id;
    }
}