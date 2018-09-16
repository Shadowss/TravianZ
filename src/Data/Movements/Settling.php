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

namespace TravianZ\Data\Movements;

use TravianZ\Entity\Attack;
use TravianZ\Entity\Village;
use TravianZ\Enums\MovementEnums;
use TravianZ\Database\IDbConnection;

/**
 * @author iopietro
 */
final class Settling extends Attack
{
    public function __construct(
        IDbConnection $db,
        int $id,
        int $ref,
        Village $from,
        Village $to,
        int $startTime,
        int $endTime,
        array $resources,
        array $units,
        array $catapultTargets,
        int $spy
    ) {
        parent::__construct(
            $db,
            $id,
            $ref,
            $from,
            $to,
            $startTime,
            $endTime,
            MovementEnums::SETTLING,
            $resources,
            $units,
            $catapultTargets,
            $spy
        );
    }
    
    /**
     * {@inheritDoc}
     * @see \TravianZ\Entity\Attack::addAttack()
     */
    public function add()
    {
        parent::addAttack();
    }
}