<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       IDbConnection.php                                           ##
##  Developed by:  martinambrus                                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2017. All rights reserved.                ##
##  URLs:          https://travian.martinambrus.com                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################
namespace App\Database;

/**
 * Defines database connection class structure
 * and all required methods for it to work.
 * 
 * @author martinambrus
 */
interface IDbConnection {
    
    /** 
     * Method used to connect to the database
     * using the data provided via the DB class' constructor.
     * 
     * @return bool Returns true if the connection was made and the chosen database exists, false otherwise. 
     */
    public function connect();

    /** 
     * Method used to disconnect from the database.
     * 
     * @return bool Returns true if the disconnect was successful, false otherwise. 
     */
    public function disconnect();
    
    /** 
     * Method used to reconnect to the database
     * using the data provided via the DB class' constructor.
     * 
     * @return bool Returns true if the reconnect was successful, false otherwise. 
     */
    public function reconnect();
    
    /**
     * Method to check whether or not we are connected
     * to the database.
     * 
     * @return bool Returns true if a connection exists, false otherwise.
     */
    public function is_connected();
    
    /**
     * Prepares and executes a MySQL query and returns the result.
     * -> SELECT statements will return a mysqli_result
     * -> INSERT, UPDATE, DELETE, REPLACE statements will return an integer
     *    (last insert ID for INSERTs, number of affected rows for everything else)
     * 
     * @example $dbConnection->query("SELECT id FROM ".TB_PREFIX."users WHERE email = ? AND activated = ?", "my@mail.com", 1);
     * @example $dbConnection->query("UPDATE ".TB_PREFIX."users SET name = ? WHERE id = ?", "John Doe", 1);
     * @example $dbConnection->query("INSERT INTO ".TB_PREFIX."users (name, email) VALUES (?, ?)", "John Doe", "john@doe.com");
     * @example $dbConnection->query("REPLACE INTO ".TB_PREFIX."users (name, email) VALUES (?, ?)", "John Doe", "john@doe.com");
     * @example $dbConnection->query("DELETE FROM ".TB_PREFIX."users WHERE id IN(?, ?, ?)", 1, 2 3);
     * 
     * @param  string $statement The query to prepare and execute.
     * @param  mixed  ...$params Parameters for the query. These usually come from user via POST or GET requests.
     * @return mixed  Returns either a mysqli_result or a number. If number is returned, it will be last insert ID
     *                for INSERTs or number of affected rows for anything else.
     */
    public function query_new($statement, ...$params);
}

