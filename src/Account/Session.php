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

namespace TravianZ\Account;

use TravianZ\Database\IDbConnection;
use TravianZ\Entity\User;
use TravianZ\Utils\Generator;
use TravianZ\Data\NewsBoxes\ServerInfo;
use TravianZ\Data\NewsBoxes\NatarsInfo;
use TravianZ\Data\NewsBoxes\Changelog;

/**
 * @author iopietro
 */
final class Session implements ISessionBase
{ 
    /**
     * @var User The user's of the session.
     */
    private $user;

    /**
     * @var array All newsBoxes
     */
    private $newsBoxes;
    
    /**
    * @var int
    */
    private $serverStartsIn;
    /**
     * @var bool
     */
    private $isServerStarted;

    /**
     * @var bool
     */
    private $isServerFinished;

    /**
     * @var string
     */
    private $mchecker;

    /**
     * @var string
     */
    private $checker;

    /**
     * @var int The actual unix time
     */
    private $time;

    /**
     * @var IDbConnection Database connection to perform queries on.
     */
    private $db;
    
    /**
     * 
     * @param IDbConnection $db
     * @param array $newsBoxes
     * @param bool $alreadyLoggedIn
     */
    public function __construct(IDbConnection $db, array $newsBoxes = [])
    {
        // Set the database
        $this->db = $db;
        
        // Set the object creation time
        $this->time = time();

        // UTF-8 variables
        mb_internal_encoding('UTF-8'); 
        
        // Start the Session
        $this->start();

        // Check if there is a Session already
        if (isset($_SESSION['username']))
        {
            // Create the user
            $this->user = new User($this->db, $_SESSION['username'], true);
            $this->user->isLoggedIn = true;

            // Update the user activity
            $this->user->setUserFields(['timestamp'], [$this->time]);

            // Populate the session properties
            $this->isServerFinished = $this->isThereAWinner();
            
            // Set the checkers
            $this->checker = $_SESSION['checker'];
            $this->mchecker = $_SESSION['mchecker'];
        } else {
            // Stop the Session
            $this->stop();
        }
        
        // Set the default newsBoxes, if none are passed
        if(empty($newsBoxes)) {
            $this->setNewsBoxes([
                new ServerInfo($this->db),
                new NatarsInfo($this->db),
                new Changelog($this->db)
            ]);
        } else {
            $this->setNewsBoxes($newsBoxes);
        }

        // Check if the server has been started
        $secondsToStart = strtotime(START_DATE.' '.START_TIME) - strtotime('now');
        $this->isServerStarted = $secondsToStart <= 0;
        $this->serverStartsIn = Generator::getTimeFormat($secondsToStart);
    }

    /**
     * Start the Session
     */
    public function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    
    /**
     * Stop the session
     */
    public function stop()
    {
        if(session_status() == PHP_SESSION_ACTIVE) {
            unset($_SESSION);
            session_destroy();
        }
    }
    
    /**
     * {@inheritdoc}
     * @see \TravianZ\Account\ISessionBase::logIn()
     */
    public function logIn(string $password): bool
    {
        // Check if the user has been set
        if (!isset($this->user)) {
            return false;
        }

        if ($this->user->logIn($password)) {
            // Update the user activity and remove its vacation datas
            $this->user->setUserFields(['timestamp', 'vac_mode', 'vac_time'], [$this->time, 0, 0]);
            
            //$this->sharedForums = $this->database->getSharedForums($this->uid, $this->alliance);

            //Start the Session
            $this->start();
            
            // Populate vars
            $_SESSION['username'] = $this->user->username;
         
            // Change the checkers
            $this->changeCheckers();
            
            // Set the cookies
            setcookie("COOKUSR", $this->user->username, time() + COOKIE_EXPIRE, COOKIE_PATH);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     * @see \TravianZ\Account\ISessionBase::logOut()
     */
    public function logOut()
    {
        // LogOut the user
        $this->user = null;

        // Delete the session cookies
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        // Stop the Session
        $this->stop();
    }

    /**
     * Delete all game cookies
     */
    public function deleteCookies()
    {
        setcookie('COOKUSR', '', $this->time - 86400, DIRECTORY_SEPARATOR);
        setcookie('SHOWLEVELS', '', $this->time - 86400, DIRECTORY_SEPARATOR);
        unset($_COOKIE);
    }
    
    /**
     * {@inheritdoc}
     * @see \TravianZ\Account\Session::getInformations()
     */
    public function getInformations(): array
    {
        // Set the default Session informations
        $sessionInformations = [
            'serverStartsIn' => $this->serverStartsIn,
            'isServerStarted' => $this->isServerStarted,
            'serverTime' => date('H:i:s'),
            'sessionChecker' => $this->checker,
            'UsernameCookie' => $_COOKIE['COOKUSR'],
            'showLevels' => $_COOKIE['SHOWLEVELS']
        ];

        // Merge the data from the newsboxes
        if (!empty($this->newsBoxes)) {
            foreach ($this->newsBoxes as $newsBox) {
                $sessionInformations = array_merge($sessionInformations, $newsBox->getData());
            }
        }

        return $sessionInformations;
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Account\ISessionBase::changeCheckers()
     */
    public function changeCheckers()
    {
        $this->checker = $_SESSION['checker'] = Generator::generateRandStr(3);
        $this->mchecker = $_SESSION['mchecker'] = Generator::generateRandStr(5);
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Account\ISessionBase::maintenance()
     */
    public function maintenance(): bool
    {
        return PEACE == 5;
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Account\ISessionBase::setUser()
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Account\ISessionBase::setNewsBoxes()
     */
    public function setNewsBoxes(array $newsBoxes)
    {
        $this->newsBoxes = $newsBoxes;
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Account\ISessionBase::updateNewsBoxes()
     */
    public function updateNewsBoxes()
    {
        if (!empty($this->newsBoxes)) {
            foreach ($this->newsBoxes as $newsBox) {
                $newsBox->init();
            }
        }
    }

    /**
     * {@inheritDoc}
     * @see \TravianZ\Account\ISessionBase::getUser()
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Check if a player built a WW to level 100
     */
    private function isThereAWinner()
    {
        $sql = 'SELECT
                    Count(*) AS Total
                FROM
                    ' . TB_PREFIX . 'fdata
                WHERE
                    f99 = ? and f99t = ?';
        
        return $res = $this->db->queryNew($sql, 100, 40)[0];
    }
}
