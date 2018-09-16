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

/**
 * @author iopietro
 */
class Training
{
    /**
     * @var int The training ID
     */
    public $id;
    
    /**
     * @var int The unit village
     */
    public $vref;
    
    /**
     * @var int The unit type
     */
    public $type;
    
    /**
     * @var int The unit
     */
    public $unit;

    /**
     * @var int How long every unit must be trained for
     */
    public $eachTime;
    
    /**
     * @var int The last time an unit was trained
     */
    public $lastTrainedTime;
    
    /**
     * @var int The finish time
     */
    public $finishTime;
    
    /**
     * @var bool Determines if the unit is trained in a great building
     */
    public $great;
    
    public function __construct(
        int $id,
        int $vref,
        int $type,
        Unit $unit, 
        int $eachTime,
        int $lastTrainedTime,
        int $finishTime,
        bool $great
    ) {
        $this->id = $id;
        $this->vref = $vref;
        $this->type = $type;
        $this->unit = $unit;
        $this->eachTime = $eachTime;
        $this->lastTrainedTime = $lastTrainedTime;
        $this->finishTime = $finishTime;
        $this->great = $great;
        
        if ($this->great) {
            for ($i = 0; $i <= 3; $i++) {
                $this->unit->trainResources[$i] *= 3;
            }

            $this->unit->totalTrainResources *= 3;
        }
    }
    
    /**
     * Delete the training
     *
     * @return True if the query was successful, false otherwise
     */
    public function delete(): bool
    {
        $sql = 'DELETE FROM
                        ' . TB_PREFIX .'training
                WHERE
                        id = ?';
        
        return $this->db->queryNew($sql, $this->id);
    }
}
