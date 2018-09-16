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

use TravianZ\Enums\OasesEnums;
use TravianZ\Database\IDbConnection;
use TravianZ\Data\Users\Nature;

/**
 * @author iopietro
 */
class Oases extends WorldCell
{
    /**
     * @var int The oases vref
     */
    public $vref;
    
    /**
     * @var User The oases owner
     */
    public $owner;
    
    /**
     * @var string The oases name
     */
    public $name;
    
    /**
     * @var int The village which conquered the oases
     */
    public $conquered;
    
    /**
     * @var array The oases resources
     */
    public $resources;
    
    /**
     * @var int The oases max store
     */
    public $maxStore;
    
    /**
     * @var int The oases max crop
     */
    public $maxCrop;
    
    /**
     * @var int The oases last update
     */
    public $lastUpdated;
    
    /**
     * @var int The oases last units regeneration
     */
    public $lastUnitsUpdated;
    
    /**
     * @var float The oases loyalty
     */
    public $loyalty;
    
    /**
     * @var int The oases units type
     */
    public $high;
    
    /**
     * @var int The oases state
     */
    private $state;
    
    public function __construct(
        IDbConnection $db,
        $owner,
        int $wref,
        string $name = '',
        bool $checkExistence = true,
        bool $init = true,
        int $oasesType = 0,
        array $coordinates = [],
        int $conquered = 0,
        array $resources = [],
        int $maxStore = 0,
        int $maxCrop = 0,
        int $lastUpdated = 0,
        int $lastUnitsUpdated = 0,
        float $loyalty = 0,
        int $high = 0,
        string $image = ''
    ) {
        parent::__construct($db, $wref, 0, $oasesType, $coordinates, 0, $image);
        $this->owner = $owner;
        $this->vref = $wref; //TODO: remove this and unify it with wref
        $this->name = $name;
        
        // Check if the oases ID exists
        if ($this->wref > 0) {
            if ($checkExistence) {
                $this->setState();
            }
            
            // Initialize the village
            if ($init) {
                $this->init();
            }
        }
        
        if (!$this->wref || $init) {
            $this->conquered = $conquered;
            $this->resources = $resources;
            $this->maxStore = $maxStore;
            $this->maxCrop = $maxCrop;
            $this->lastUpdated = $lastUpdated;
            $this->lastUnitsUpdated = $lastUnitsUpdated;
            $this->loyalty = $loyalty;
            $this->high = $high;
        }
    }
    
    /**
     * Initialize the oases
     */
    private function init()
    {
        // If the oases doesn't exist, it can't be initialized
        if ($this->getState() == OasesEnums::DOES_NOT_EXIST) {
            return;
        }
        
        $sql = 'SELECT
                    o.*, w.x, w.y, w.oasestype, w.image
                FROM
                    ' . TB_PREFIX . 'odata as o
                INNER JOIN
                    ' . TB_PREFIX . 'wdata as w
                ON
                    w.id = o.wref
                WHERE
                    o.wref = ?
                LIMIT 1';
        
        $res = $this->db->queryNew($sql, $this->wref)[0];

        // If the oases isn't conquered, set the Nature as a owner
        if (!$res['conquered']) {
            $this->owner = new Nature($this->db);
        }
        
        // If the oases owner is null, set it
        if (is_null($this->owner)) {
            $this->owner = new User($this->db, $res['owner'], true);
        }
        
        // Set the properties
        $this->name = $res['name'];
        $this->conquered = $res['conquered'];
        $this->resources = [
            'wood' => $res['wood'],
            'clay' => $res['clay'],
            'iron' => $res['iron'],
            'crop' => $res['crop'],
        ];
        $this->maxStore = $res['maxstore'];
        $this->maxCrop = $res['maxcrop'];
        $this->lastUpdated = $res['lastupdated'];
        $this->lastUnitsUpdated = $res['lastupdated2'];
        $this->loyalty = $res['loyalty'];
        $this->high = $res['high'];
        $this->oasesType = $res['oasestype'];
        $this->coordinates = ['x' => $res['x'], 'y' => $res['y']];
        $this->image = $res['image'];
    }
    
    
    /**
     * Get the oases state
     *
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }
    
    /**
     * Set the oases state
     */
    private function setState()
    {
        // Check the oases existence
        if ($this->exists()) {
            $this->state = OasesEnums::EXISTS;
        } else {
            $this->state = OasesEnums::DOES_NOT_EXIST;
        }
    }
    
    /**
     * Checks if the oases exists in the database.
     *
     * @return array Returns true if the oases exists, false otherwise
     */
    private function exists(): bool
    {
        $sql = 'SELECT
                    Count(*) as Total
                FROM
                    ' . TB_PREFIX . 'odata
                WHERE
                    wref = ?';

        return $this->db->queryNew($sql, $this->wref)[0]['Total'];
    }
}