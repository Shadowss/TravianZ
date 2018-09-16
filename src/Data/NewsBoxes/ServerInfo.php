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
 * Create a the ServerInfo newsbox
 *
 * @author iopietro
 */
class ServerInfo extends NewsBox
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
        $this->addData('onlineUsers', $this->getOnlineUsers());
        $this->addData('topRanked', $this->getTopRanked());
    }
    
    /**
     * Get the biggest user on the server
     *
     * @return string
     */
    private function getTopRanked(): string
    {
        if (!is_null($this->topRanked)) {
            return $this->topRanked;
        }
        
        $sql = 'SELECT
                    username
                FROM
                    ' . TB_PREFIX . 'users
                WHERE'.
                (!INCLUDE_ADMIN ? ' access < '.MULTIHUNTER.' AND' : '').
                ' id > 4 AND oldrank > 0 ORDER BY oldrank ASC LIMIT 1';
                
        return $this->db->queryNew($sql)[0]['username'];
    }
    
    
    /**
     * Get the number of online users
     *
     * @return int Returns the number of online users
     */
    private function getOnlineUsers(): int
    {
        if (!is_null($this->onlineUsers)) {
            return $this->onlineUsers;
        }
        
        $sql = 'SELECT
                    Count(*) AS Total
                FROM
                    ' . TB_PREFIX . 'users
                WHERE
                    timestamp > ?';
        
        return $this->db->queryNew($sql, time() - 300)[0]['Total'];
    }
}