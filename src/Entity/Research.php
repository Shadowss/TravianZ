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

use TravianZ\Enums\ResearchEnums;
use TravianZ\Database\IDbConnection;

/**
 * @author iopietro
 */
class Research
{
    /**
     * @var Unit The researched unit
     */
    public $unit;

    /**
     * @var int The research time
     */
    public $researchTime;
    
    /**
     * @var array The needed resources to research the unit
     */
    public $researchNeededResources;
    
    /**
     * @var array The research building requirements
     */
    public $requirements;
    
    /**
     * @var int Determines if the unit is: not yet researched, researched or actually being researched
     */
    private $researchValue;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db,
        Unit $unit,
        int $researchTime, 
        array $researchNeededResources, 
        array $requirements,
        int $researchValue
    ) {
        $this->db = $db;
        $this->unit = $unit;
        $this->researchTime = $researchTime;
        $this->researchNeededResources = $researchNeededResources;
        $this->requirements = $requirements;
        $this->researchValue = $researchValue;
    }

    /**
     * Determines if the unit can be researched
     * 
     * @param array $buildings
     * @return bool
     */
    public function canBeResearched(array $buildings): bool
    {
        //Initialize
        $validBuildingsCount = 0;
        
        // Check if there are the building requirements
        foreach ($buildings as $building) {
            foreach ($this->requirements as $id => $level) {
                if ($building->id == $id && $building->level >= $level) {
                    $validBuildingsCount++;
                }
            }
        }
        
        return count($this->requirements) == $validBuildingsCount;
    }

    /**
     * Get the research state
     * 
     * @return int Returns the actual research state
     */
    public function getState()
    {
        if ($this->getValue() == 0) {
            return ResearchEnums::NOT_YET_RESEARCHED;
        } elseif ($this->getValue() == 1) {
            return ResearchEnums::RESEARCHED;
        } elseif ($this->getValue() > 1) {
            return ResearchEnums::IN_RESEARCH;
        }
    }

    /**
     * Get the research value
     * 
     * @return int Returns the actual research value
     */
    public function getValue(): int
    {
        return $this->researchValue;
    }

    /**
     * Change the research value
     * 
     * @param int $newValue
     */
    public function setValue(int $newValue)
    {
        $this->researchValue = $newValue;
    }
    
    /**
     * Update the research
     * 
     * @param int $type The unit type to update
     * @param int $vref The village where the research have to be updated
     */
    public function update(int $type, int $vref)
    {
        $sql = 'UPDATE
                    ' . TB_PREFIX . 'tdata
                SET
                    t' . $type . ' = ?
                WHERE
                    vref = ?';
        
        $this->db->queryNew($sql, $this->researchValue, $vref);
    }
}