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
class FarmList
{
    /**
     * @var int The farm list ID
     */
    public $id;
    
    /**
     * @var Village The attacker village
     */
    public $from;
    
    /**
     * @var array The farm list name
     */
    public $name;
    
    /**
     * @var array The raids list which belong to this farm list
     */
    public $raidsList;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(IDbConnection $db, int $id, Village $from, string $name, array $raidsList)
    {
        $this->db = $db;
        $this->id = $id;
        $this->from = $from;
        $this->name = $name;
        $this->raidsList = $raidsList;
    }
    
    /**
     * Add the farm list
     */
    public function add()
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX .'farmlist
                        (`from`, owner, name)
                VALUES
                        (?, ?, ?)';
        
        $this->id = $this->db->queryNew(
            $sql,
            $this->from->vref,
            $this->from->owner->id,
            $this->name
        );
    }
    
    /**
     * Delete the farm list and all of its raid lists
     */
    public function delete()
    {
        $sql = 'DELETE farmlist, raidlist FROM
                    ' . TB_PREFIX .'farmlist farmlist
                LEFT JOIN
                    ' . TB_PREFIX .'raidlist raidlist
                ON
                    raidlist.lid = farmlist.id
                WHERE
                    farmlist.id = ?';

        $this->db->queryNew($sql, $this->id);
    }
}