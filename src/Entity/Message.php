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
use TravianZ\Enums\MessageEnums;

/**
 * @author iopietro
 */
class Message
{
    /**
     * @var int The message ID
     */
    public $messageID;

    /**
     * @var int The message receiver
     */
    public $target;

    /**
     * @var int The message sender
     */
    public $owner;

    /**
     * @var int the message state
     */
    private $state;
    
    /**
     * @var IDbConnection
     */
    private $db;

    public function __construct(IDbConnection $db, int $target, int $owner, int $messageID = 0)
    {
        $this->db = $db;
        $this->target = $target;
        $this->owner = $owner;
        $this->messageID = $messageID;
        
        if ($this->messageID > 0) {
            $this->setState();
        }
    }
    
    public function getState()
    {
        return $this->state;
    }
    
    private function setState()
    {
        if ($this->exists()) {
            $this->state = MessageEnums::EXISTS;
        } else {
            $this->state = MessageEnums::DOES_NOT_EXIST;
        }
    }
    
    /**
     * Checks if the message exists in the database.
     *
     * @return array Returns true if the message exists, false otherwise.
     */
    private function exists(): bool
    {
        $sql = 'SELECT
                    Count(*) as Total
                FROM
                    ' . TB_PREFIX . 'messages
                WHERE
                    id = ?';
        
        $res = $this->db->queryNew($sql, $this->messageID);
        
        return $res[0]['Total'];
    }
    
    /**
     * Send a message
     * 
     * @param string $topic The message topic
     * @param string $message The message text
     * @param int $time The sending time
     * @return bool Returns true if sent successfully, false otherwise
     */
    public function send(string $topic, string $message, int $time): bool
    {
        if ($this->getState() != MessageEnums::DOES_NOT_EXIST) {
            return false;
        }
        
        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'messages
                    (target, owner, topic, message, time)
                VALUES
                    (?, ?, ?, ?, ?)';
        
        $this->messageID = $this->db->queryNew($sql, $this->target, $this->owner, $topic, $message, $time);

        return $this->messageID;
    }
    /**
     * Send the welcome message
     * 
     * @return bool Returns true if sent successfully, false otherwise
     */
    public function sendWelcome(string $username, int $time): bool
    {
        if ($this->getState() != MessageEnums::DOES_NOT_EXIST) {
            return false;
        }
        
        $getWelcomeData = $this->getWelcomeData();

        $welcomeMessage = "[message]" . preg_replace([
            "'%USER%'",
            "'%START%'",
            "'%TIME%'",
            "'%PLAYERS%'",
            "'%ALLI%'",
            "'%SERVER_NAME%'",
            "'%PROTECTION%'"
        ], [
            $username,
            date("y.m.d", COMMENCE),
            date("H:i", COMMENCE),
            $getWelcomeData['users'],
            $getWelcomeData['alliances'],
            SERVER_NAME,
            round((PROTECTION / 3600))
        ], WEL_MESSAGE) . "[/message]";
        
        return $this->send(WEL_TOPIC, $welcomeMessage, $time);
    }
    
    /**
     * Get datas for the welcome message
     * 
     * @return array
     */
    private function getWelcomeData(): array
    {
        $sql = '(
                    SELECT
                        Count(id) AS Total
                    FROM
                        ' . TB_PREFIX . 'users
                    WHERE
                        '.(!INCLUDE_ADMIN ? ' access < '.MULTIHUNTER.' AND' : '').'
                        id > 4
                )
                UNION ALL
                (
                    SELECT
                        Count(id) AS Total
                    FROM
                        ' . TB_PREFIX . 'alidata
                )';
        
        $res = $this->db->queryNew($sql);
        
        return [
            'users' => $res[0]['Total'],
            'alliances' => $res[1]['Total']
        ];
    }
}
