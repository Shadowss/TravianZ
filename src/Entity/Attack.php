<?php

namespace TravianZ\Entity;

use TravianZ\Database\IDbConnection;

abstract class Attack extends Movement
{
    /**
     * @var array The units involved in the attack [0 => the Unit object, 1 => the amount of units]
     */
    public $units;
    
    /**
     * @var array The catapult targets
     */
    public $catapultTargets;
    
    /**
     * @var int The spying type
     */
    public $spy;
    
    public function __construct(
        IDbConnection $db,
        int $id,
        int $ref,
        WorldCell $from,
        WorldCell $to,
        int $startTime,
        int $endTime,
        int $type,
        array $resources,
        array $units,
        array $catapultTargets,
        int $spy
    ) {
        parent::__construct($db, $id, $ref, $from, $to, $startTime, $endTime, $type, $resources);
        $this->units = $units;
        $this->catapultTargets = $catapultTargets;
        $this->spy = $spy;
    }
    
    /**
     * Modify the attacking units
     *
     * @param array $units The units amount to be subtracted/summed up
     * @param bool $mode If true the units will be subtracted, summed up if true
     * @return bool Returns true if the query was successful, false otherwise
     */
    public function modify(array $units, bool $mode): bool
    {
        $pairs = $values = [];
        for($i = 1; $i <= 11; $i++) {
            $pairs[] = $field . 'u'.$i.' = ?';
            $values[] = $this->units[$i]->amount ($mode ? - $unit[$i]->amount : + $unit[$i]->amount);
        }
        
        $pairs = implode(',', $pairs);
        
        $sql = 'UPDATE
                     ' . TB_PREFIX . 'attacks
                 SET
                     ' . $pairs . '
                 WHERE
                     id = ?';
        
        $values[] = $this->ref;
        
        // Set the units
        $this->units = $units;
        
        return $this->db->queryNew($sql, $values);
    }
    
    /**
     * Add the attaking units to the database
     * 
     * @return bool Return true if the query was successful, false otherwise
     */
    protected function addAttack(): bool
    {
        $sql = 'INSERT INTO
                        ' . TB_PREFIX . 'attacks
                        (vref, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10, u11, ctar1, ctar2, spy)
                VALUES
                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        $this->id = $this->ref = $this->db->queryNew(
            $sql,
            $this->from->vref,
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
            $this->units[11]->amount,
            $this->catapultTargets[0],
            $this->catapultTargets[1],
            $this->spy
        );   
        
        return parent::addMovement();
    }
}