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
class BeerFest
{
    /**
     * @var int The base duration of a beer fest (3 days)
     */
    const BASE_DURATION = 259200;
    
    /**
     * @var int The needed resources to start a beer fest
     */
    const NEEDED_RESOURCES = [3870, 1680, 215, 10900];
    
    /**
     * @var User The beerFest owner
     */
    public $owner;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db,
        User $owner
    ) {
        $this->db = $db;
        $this->owner = $owner;
    }
    
    /**
     * Start a beerfest
     */
    public function start()
    {        
        // Set the new beer fest time and update it on the database
        $this->owner->setBeerFestEndTime(time() + self::BASE_DURATION);
        $this->owner->setUserFields(['beerfest'], [$this->owner->getBeerFestEndTime()]);
    }
    
    /**
     * Get the total needed resources
     *
     * @return int Returns the total needed resources
     */
    public function getTotalNeededResources(): int
    {
        return array_sum(self::NEEDED_RESOURCES);
    }
}
