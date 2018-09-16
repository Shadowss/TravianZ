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

use TravianZ\Entity\User;

/**
 * Contains the basic functions of the Session
 *
 * @author iopietro
 */
interface ISessionBase
{
    /**
     * Log the user into the game
     *
     * @param string $password The user's password
     * @param User $user The user who wants to log in
     * @return bool Returns if the user's logged in sucesfully
     */
    public function logIn(string $password): bool;
    
    /**
     * Log out from the game
     */
    public function logOut();

    /**
     * Change the Session checkers
     */
    public function changeCheckers();
    
    /**
     * Get the session informations
     */
    public function getInformations(): array;
    
    /**
     * Check if the server is under maintenance
     * 
     * @return bool Returns true if it's under maintenance, false otherwise
     */
    public function maintenance(): bool;
    
    /**
     * Set the Session user
     *
     * @param User $user The User to be set
     */
    public function setUser(User $user);

    /**
     * Set the Session newsBoxes
     * 
     * @param array $newsBoxes The newsBoxes to be set
     */
    public function setNewsBoxes(array $newsBoxes);
    
    /**
     * Re-init all Session newsBoxes
     */
    public function updateNewsBoxes();
    
    /**
     * Return the Session User
     * 
     * @return User The User object
     */
    public function getUser(): User;
}
