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

/**
 * @author iopietro
 */
class Changelog extends NewsBox
{
    public function __construct(IDbConnection $db)
    {
        parent::__construct($db);
    }

    public function init()
    {}
}