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

namespace TravianZ\Data\Units;

use TravianZ\Entity\Unit;
use TravianZ\Enums\UnitEnums;

final class Hero extends Unit
{
    /**
     * @var string The hero name
     */
    public $name;

    /**
     * @var int The hero ID
     */
    private $id;
    
    /**
     * @var int The hero owner
     */
    private $owner;

    /**
     * @var int The hero level
     */
    private $level;

    /**
     * @var float The hero health
     */
    private $health;
    
    /**
     * @var int The hero regeneration points
     */
    private $regenerationPoints;
    
    /**
     * @var int The hero regeneration points
     */
    private $attackingPoints;
    
    /**
     * @var int The hero regeneration points
     */
    private $defensivePoints;
    
    /**
     * @var int The hero regeneration points
     */
    private $attackingBonusPoints;

    /**
     * @var int The hero regeneration points
     */
    private $defensiveBonusPoints;
    
    public function __construct(
        string $name,
        Unit $unit,
        int $id,
        int $owner,     
        int $level,
        float $health,
        int $regenerationPoints,
        int $attackingPoints,
        int $defensivePoints,
        int $attackingBonusPoints,
        int $defensiveBonusPoints,
        int $trainTime,
        array $trainResources
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->owner = $owner;
        $this->level = $level;
        $this->health = $health;
        $this->regenerationPoints = $regenerationPoints;
        $this->attackingPoints = $attackingPoints;
        $this->defensivePoints = $defensivePoints;
        $this->attackingBonusPoints = $attackingBonusPoints;
        $this->defensiveBonusPoints = $defensiveBonusPoints;
        array_unshift($unit->classes, UnitEnums::HERO);
        
        parent::__construct(
            $unit->name, 
            $unit->attack,
            $unit->infantryDefense,
            $unit->cavalryDefense,
            $unit->speed, 
            0,
            6,
            $trainTime,
            $trainResources, 
            $unit->classes, 
            $unit->amount
        );
    }
    
    /**
     * Get the hero attack
     * 
     * @return int
     */
    public function getAttack(): int
    {
        
    }
    
    /**
     * Get the hero defense
     * 
     * @return int
     */
    public function getDefense(): int
    {
        
    }
    
    /**
     * Get the hero attack bonus
     * 
     * @return float
     */
    public function getAttackBonus(): float
    {
        
    }
    
    /**
     * Get the hero defense bonus
     * 
     * @return float
     */
    public function getDefenseBonus(): float
    {
        
    }
}