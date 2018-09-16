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
class Unit
{
    /**
     * @var string The Unit name
     */
    public $name;

    /**
     * @var int The Unit attack
     */
    public $attack;
    
    /**
     * @var int The defense against not-cavalry Units (called infantry for convention)
     */
    public $infantryDefense;
    
    /**
     * @var int The defense against cavalry Units
     */
    public $cavalryDefense;
    
    /**
     * @var int The unit speed
     */
    public $speed;

    /**
     * @var int The amount of resources which could stole the Unit
     */
    public $capacity;
    
    /**
     * @var int The Unit crop consumption
     */
    public $upkeep;

    /**
     * @var int Time required to train the Unit
     */
    public $trainTime;
    
    /**
     * @var array Resources required to train the Unit
     */
    public $trainResources;
    
    /**
     * @var int Total resources required to train this unit
     */
    public $totalTrainResources;

    /**
     * @var array The Unit classes
     * @example Catapult, Ram, Infantry, Cavalry, Chief, Settler, Scout
     */
    public $classes;
    
    /**
     * @var int The Unit amount
     */
    public $amount;
    
    /**
     * @var int Max trainable units of this type
     */
    public $max;
    
    public function __construct(
        string $name,
        int $attack,
        int $infantryDefense,
        int $cavalryDefense,
        int $speed,
        int $capacity,
        int $upkeep,
        int $trainTime,
        array $trainResources,
        array $classes,
        int $amount,
        float $max = INF
    ) {
        $this->name = $name;
        $this->attack = $attack;
        $this->infantryDefense = $infantryDefense;
        $this->cavalryDefense = $cavalryDefense;
        $this->speed = $speed;
        $this->capacity = $capacity;
        $this->upkeep = $upkeep;
        $this->trainTime = $trainTime;
        $this->trainResources = $trainResources;
        $this->totalTrainResources = array_sum($this->trainResources);
        $this->classes = $classes;
        $this->amount = $amount;
        $this->max = $max;
    }
}