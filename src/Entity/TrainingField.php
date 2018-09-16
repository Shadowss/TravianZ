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

use TravianZ\Factory\UnitsFactory;
use TravianZ\Data\Validator;

/**
 * @author iopietro
 */
abstract class TrainingField extends Building
{
    /**
     * @var int The unit to train accepted class
     */
    public $unitToTrainClass;
    
    /**
     * @var bool Determines if the units to train are "great"
     */
    public $unitToTrainGreat;
    
    public function __construct(
        int $id,
        int $position,
        int $level,
        string $name,
        string $desc,
        array $baseResourcesRequired,
        int $baseCulturePoints,
        array $baseTime,
        float $baseCostGrowth,
        int $baseUpkeep,
        array $bonus,
        int $maxLevel,
        array $prerequisites,
        int $unitToTrainClass,
        bool $unitToTrainGreat
    ) {
        parent::__construct(
            $id,
            $position,
            $level, 
            $name,
            $desc, 
            $baseResourcesRequired,
            $baseCulturePoints,
            $baseTime, 
            $baseCostGrowth, 
            $baseUpkeep,
            $bonus, 
            $maxLevel, 
            $prerequisites
        );
        
        $this->unitToTrainClass = $unitToTrainClass;
        $this->unitToTrainGreat = $unitToTrainGreat;
    }

    /**
     * Check if one or more units can be trained, then train it/them
     * 
     * @param Village $village
     * @param array $parameters
     */
    public function train(Village $village, array $parameters)
    {
        // Initialization
        $units = $totalResources = [];
        
        // Check if the inserted units are valid
        for ($i = 1; $i <= 12; $i++) {
            if (
                empty((new Validator())->validateInputs($parameters, ['u'.$i => 'isRequired|isInt|minValue=1'])) &&
                isset($village->getTrainableUnits()[$i]) &&
                $parameters['u'.$i] <= $village->getTrainableUnits()[$i]->max
            ) {
                $units[$i] = UnitsFactory::create($village->owner->tribe, $i, $parameters['u'.$i]);
            }
        }

        // Check if there's at least one unit to be trained
        if (!empty($units)) {
            foreach ($units as $unitIndex => $unit) {
                // Check if the unit class is valid
                if ($unit->classes[0] != $this->unitToTrainClass) {
                    // Remove the unit from the array
                    unset($units[$unitIndex]);
                    
                    // Skip the next instructions
                    continue;
                }
                
                // Initialize the temporary resources array
                $tempResources = [];
                
                foreach ($unit->trainResources as $index => $value) {
                    // Get the resource key
                    $key = array_keys($village->getResources())[$index];
                    
                    // Calculate the total needed resources
                    $tempResources[$key] += $value * $unit->amount * ($this->unitToTrainGreat ? 3 : 1);
                    
                    // Check if the total units to train resources exceed the village resources
                    if ($tempResources[$key] + abs($totalResources[$key]) > $village->getResources()[$key]) {
                        // Remove the unit from the array
                        unset($units[$unitIndex], $tempResources);
                        
                        // Break the loop
                        break;
                    }
                }
                
                // Check if there are resources to subtract
                if (!empty($tempResources)) {
                    // Subtract the resources
                    foreach ($tempResources as $key => $value) {
                        $totalResources[$key] -= $value;
                    }
                }
            }
            
            // Check again if there's at least one unit to be trained
            if (!empty($units)) {
                // Initialization
                $trainings = [];
                $time = time();
                
                // Create the trainings
                foreach($units as $index => $unit) {
                    // Reset the queue time
                    $queueTime = $time;
                    
                    foreach ($village->getUnitsInTraining() as $training) {
                        // Check for the right queue
                        // Search the maximum finished time
                        if (
                            $training->unit->classes[0] == $this->unitToTrainClass && 
                            $training->great == $this->unitToTrainGreat && 
                            $queueTime < $training->finishTime
                        ) {
                            $queueTime = $training->finishTime;
                        }
                    }
                    
                    $training = new Training(
                        0,
                        $village->vref,
                        $index,
                        $unit,
                        $unit->trainTime,
                        $queueTime,
                        $queueTime + $unit->trainTime * $unit->amount,
                        $this->unitToTrainGreat
                    );

                    // Check if the unit hasn't reached the maximum trainable amount
                    if ($unit->amount <= $village->getTrainableUnits()[$index]->max) {
                        // Update the village units in training
                        $village->addUnitsInTraining($training);
                        
                        // Update the village trainable units
                        $village->setTrainableUnits();
                        
                        // Add the training to the list
                        $trainings[] = $training;
                    } else {
                        // Return the resources if they can't be trained
                        foreach ($unit->trainResources as $index => $value) {
                            // Get the resource key
                            $key = array_keys($village->getResources())[$index];

                            // Sum the units resources
                            $totalResources[$key] += $value * $unit->amount * ($this->unitToTrainGreat ? 3 : 1);
                        }
                    }
                }

                // Train the units
                $this->addTrainings($trainings);

                // Update the village resources
                $village->updateResources($totalResources);
            }
        }
    }
    
    /**
     * Train one or more units
     * 
     * @param array $trainings The units to be trained
     */
    public function addTrainings(array $trainings)
    {
        // Check if the building is above level 0
        if ($this->level == 0) {
            return;
        }
        
        // Initialization
        $pairs = '(?, ?, ?, ?, ?, ?, ?)';
        $fields = $values = [];
        
        // Add the fields and values
        foreach ($trainings as $training) {
            $fields[] = $pairs;
            array_push(
                $values,
                $training->vref, 
                $training->type, 
                $training->unit->amount,
                $training->eachTime,
                $training->lastTrainedTime,
                $training->finishTime,
                $training->great
            );
        }

        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'training
                    (vref, unit, amount, eachtime, lasttrainedtime, finishtime, great)
                VALUES
                    ' . implode(',', $fields);

        $this->getDatabase()->queryNew($sql, $values);
    }
    
    /**
     * Override the __tostring() method of the Building class
     * 
     * @return string
     */
    public function __tostring(): string
    {
        return 'TrainingField';
    }
}