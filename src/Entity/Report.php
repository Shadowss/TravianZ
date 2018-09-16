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
class Report
{
    /**
     * @var int The report ID
     */
    public $id;
    
    /**
     * @var int The report owner
     */
    public $owner;
    
    /**
     * @var int The sender village
     */
    public $from;
    
    /**
     * @var int The target village
     */
    public $to;
    
    /**
     * @var string The report topic
     */
    public $topic;
    
    /**
     * @var int The report type
     */
    public $type;

    /**
     * @var array The report data
     */
    public $data;
    
    /**
     * @var int The report time
     */
    public $time;
    
    /**
     * @var bool The report reading state
     */
    public $viewed;
    
    /**
     * @var bool The report archiviation state
     */
    public $archived;
    
    /**
     * @var bool The report deletion state
     */
    public $deleted;
    
    /**
     * @var IDbConnection
     */
    private $db;
    
    public function __construct(
        IDbConnection $db, 
        int $id,
        User $owner,
        WorldCell $from,
        WorldCell $to,
        string $topic,
        int $type,
        array $data,
        int $time,
        bool $viewed,
        bool $archived,
        bool $deleted
    ) {
        $this->db = $db;
        $this->id = $id;
        $this->owner = $owner;
        $this->from = $from;
        $this->to = $to;
        $this->topic = $topic;
        $this->type = $type;
        $this->data = $data;
        $this->time = $time;
        $this->viewed = $viewed;
        $this->archived = $archived;
        $this->deleted = $deleted;
    }
    
    /**
     * Send a report
     */
    public function send()
    {        
        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'reports
                    (owner, from, to, topic, type, data, time)
                VALUES
                    (?, ?, ?, ?, ?, ?)';
        
        $this->id = $this->db->queryNew(
            $sql, 
            $this->owner->id, 
            $this->from->vref,
            $this->to->vref, 
            $this->topic,
            $this->type, 
            implode(',', $this->data),
            $this->time
        );
    }
    
    /**
     * Delete a report
     */
    public function delete()
    {
        $sql = 'DELETE FROM
                    ' . TB_PREFIX . 'reports
                WHERE
                    id = ?';
        
        $this->db->queryNew(
            $sql,
            $this->id
        );
    }
    
    /**
     * Get the report resources
     *
     * @return array Returns the stolen resources
     */
    public function getRobbedResources(): array
    {
        return [$this->data[23], $this->data[24], $this->data[25], $this->data[26]] ?? [];
    }
    
    /**
     * Get the report total stolen resources
     *
     * @return int Returns the total stolen resources
     */
    public function getTotalRobbedResources(): int
    {
        return array_sum($this->getRobbedResources()) ?? 0;
    }
    
    /**
     * Get the max carryable resources
     *
     * @return int Returns the max carryable resources
     */
    public function getMaxCarry(): int
    {
        return $this->data[27] ?? 0;
    }
}
