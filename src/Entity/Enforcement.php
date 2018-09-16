<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Author: iopietro <https://github.com/iopietro>
 *
 * Source: All formulas used in this class was taken from this file:
 *         <https://github.com/kirilloid/travian/blob/26b27f0a9a98dda196c9154faf1545dbd9ac5066/src/model/base/buildings.ts>
 *         of Kirilloid <https://github.com/kirilloid>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Entity;

use TravianZ\Database\IDbConnection;

class Enforcement
{
    /**
     * @var int The enforcement ID
     */
    public $id;
    
    /**
     * @var Village From which village the enforement is sent
     */
    public $from;
    
    /**
     * @var Village In which village the enforcement is
     */
    public $to;
    
    /**
     * @var array The enforcement units
     */
    public $units;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(IDbConnection $db, int $id, Village $from, WorldCell $to, array $units)
    {
        $this->db = $db;
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->units = $units;
    }
    
    /**
     * Add the enforcement
     *
     * @return mixed
     */
    public function add(): bool
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX. 'enforcement
                        (u1, u2, u3, u4, u5, u6, u7, u8, u9, u10, u11, from, vref)
                VALUES
                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        $values = [];
        foreach ($this->units as $unit) {
            $values[] = $unit['amount'];
        }

        $values[] = $this->from->vref;
        $values[] = $this->to->vref;
        
        return $this->db->queryNew($sql, $values);
    }
    
    /**
     * Delete an enforcement
     * 
     * @return bool
     */
    public function delete(): bool
    {
        $sql = 'DELETE FROM
                ' . TB_PREFIX . 'enforcement
                WHERE id = ?';
        
        return $this->db->queryNew($sql, $this->id);
    }
}