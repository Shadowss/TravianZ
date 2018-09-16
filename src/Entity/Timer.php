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
class Timer
{    
    /**
     * @var float When the object had been created
     */
    private $startTime;
    
    public function __construct()
    {
        $this->startTime = microtime(true);
    }
    
    /**
     * Get the script execution time
     * 
     * @return float Returns the script execution time, in ms
     */
    public function getExecutionTime(): float
    {
        return round((microtime(true) - $this->startTime) * 1000);
    }
}