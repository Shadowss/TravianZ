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
class Trapped
{
    /**
     * @var int The trapped units ID
     */
    public $id;
    
    /**
     * @var Village The trapped units owner's village ID
     */
    public $from;
    
    /**
     * @var Village The trapped units actual village ID
     */
    public $to;
    
    /**
     * @var array The trapped units
     */
    public $units;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(IDbConnection $db, int $id, Village $from, Village $to, array $units)
    {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->units = $units;
    }
    
    /**
     * Add trapped units
     * 
     * @return True if the query was successful, false otherwise
     */
    public function add(): bool
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX .'prisoners
                        (from, vref, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10, u11)
                VALUES
                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        return $this->db->queryNew(
            $sql, 
            $this->from->vref,
            $this->to->vref,
            $this->units[1]->amount,
            $this->units[2]->amount,
            $this->units[3]->amount,
            $this->units[4]->amount,
            $this->units[5]->amount,
            $this->units[6]->amount,
            $this->units[7]->amount,
            $this->units[8]->amount,
            $this->units[9]->amount,
            $this->units[10]->amount,
            $this->units[11]->amount
        );
    }
    
    /**
     * Modify the trapped units
     * 
     * @param array $units The units to be subtracted/summed
     * @param bool $mode If false, the units will be subtracted, summed otherwise
     * @return True if the query was successful, false otherwise
     */
    public function modify(array $units, bool $mode): bool
    {
        $pairs = $values = [];
        for($i = 1; $i <= 11; $i++) {
            $this->units[$i]->amount += $mode ? -$units[$i]->amount : $units[$i]->amount;
            $pairs[] = $field . 'u'.$i.' = ?';
            $values[] = $this->units[$i]->amount;
        }
        
        $pairs = implode(',', $pairs);
        
        $sql = 'UPDATE
                     ' . TB_PREFIX . 'prisoners
                 SET
                     ' . $pairs . '
                 WHERE
                     id = ?';
        
        $values[] = $this->id;
        
        return $this->db->queryNew($sql, $values);
    }
    
    /**
     * Delete the trapped units
     * 
     * @return True if the query was successful, false otherwise
     */
    public function delete(): bool
    {
        $sql = 'DELETE FROM
                        ' . TB_PREFIX .'prisoners
                WHERE
                        id = ?';
        
        return $this->db->queryNew($sql, $this->id);
    }
}