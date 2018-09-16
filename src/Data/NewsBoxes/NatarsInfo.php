<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Data\NewsBoxes;

use TravianZ\Entity\NewsBox;
use TravianZ\Database\IDbConnection;
use TravianZ\Natars\Artifacts;

/**
 * @author iopietro
 */
class NatarsInfo extends NewsBox
{

    public function __construct(IDbConnection $db)
    {
        parent::__construct($db);
        $this->init();
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Entity\NewsBox::init()
     */
    public function init()
    {
        $this->addData('natarsTextArray', [
            [
                NATARS_SPAWN,
                WW_SPAWN,
                WW_PLAN_SPAWN
            ],
            [
                NATARS_TRIBE,
                WW_VILLAGE,
                CONSTRUCTION_PLANS
            ]
        ]);

        $this->addData('natarsSpawnTimeArray', [
            NATARS_SPAWN_TIME,
            NATARS_WW_SPAWN_TIME,
            NATARS_WW_BUILDING_PLAN_SPAWN_TIME
        ]);

        $this->addData('natarsSpawnArray', [
            Artifacts::areArtifactsSpawned($this->db),
            Artifacts::areWWVillagesSpawned($this->db),
            Artifacts::areArtifactsSpawned($this->db, true)
        ]);
    }
}
