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

namespace TravianZ\Factory;

use TravianZ\Data\Movements\Normal;
use TravianZ\Data\Movements\Raid;
use TravianZ\Data\Movements\Reinforcement;
use TravianZ\Data\Movements\Returning;
use TravianZ\Data\Movements\ReturningTrade;
use TravianZ\Data\Movements\Settling;
use TravianZ\Data\Movements\Spy;
use TravianZ\Data\Movements\Trade;
use TravianZ\Database\IDbConnection;
use TravianZ\Enums\MovementEnums;
use TravianZ\Entity\WorldCell;
/**
 * @author iopietro
 */
abstract class MovementsFactory
{
    public static function create(
        int $type,
        IDbConnection $db,
        int $id,
        WorldCell $from,
        WorldCell $to,
        int $startTime,
        int $endTime,
        array $resources,
        array $units = [],
        int $merchants = 0,
        int $repetitions = 0,
        int $ref = 0,
        array $catapultTargets = [0, 0],
        int $spy = 0
    ) {
        switch($type) {
            case MovementEnums::SPY:
                return new Spy($db, $id, $ref, $from, $to, $startTime, $endTime, $resources, $units, $catapultTargets, $spy);
            case MovementEnums::REINFORCEMENT:
                return new Reinforcement($db, $id, $ref, $from, $to, $startTime, $endTime, $resources, $units, $catapultTargets, $spy);
            case MovementEnums::NORMAL:
                return new Normal($db, $id, $ref, $from, $to, $startTime, $endTime, $resources, $units, $catapultTargets, $spy);
            case MovementEnums::RAID:
                return new Raid($db, $id, $ref, $from, $to, $startTime, $endTime, $resources, $units, $catapultTargets, $spy);
            case MovementEnums::SETTLING:
                return new Settling($db, $id, $ref, $from, $to, $startTime, $endTime, $resources, $units, $catapultTargets, $spy);
            case MovementEnums::TRADE:
                return new Trade($db, $id, $from, $to, $startTime, $endTime, $resources, $merchants, $repetitions);
            case MovementEnums::RETURNING:
                return new Returning($db, $id, $ref, $from, $to, $startTime, $endTime, $resources, $units, $catapultTargets, $spy);
            case MovementEnums::RETURNING_TRADE:
                return new ReturningTrade($db, $id, $from, $to, $startTime, $endTime, $resources, $merchants, $repetitions);
        }
    }
}