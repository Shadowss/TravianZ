<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       User.php                                                    ##
##  Developed by:  martinambrus                                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2017. All rights reserved.                ##
##  URLs:          https://travian.martinambrus.com                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################

namespace App\Entity;

if (!isset($src_prefix)) {
    $src_prefix = '';
    
    if (substr(getcwd(), -5) === 'Admin') {
        $src_prefix = '../';
    }
    
    if (substr(getcwd(), -4) === 'Mods') {
        $src_prefix = '../../../';
    }
}

include_once($src_prefix."src/Database/IDbConnection.php");
include_once($src_prefix."src/Utils/Math.php");

use App\Database\IDbConnection;
use App\Utils\Math;

/** 
 * Defines the properties of a user, e.g. player entity
 * connected to their profile and other personal and account-specific
 * information.
 * 
 * @author martinambrus
 */
class User {
    
    /**
     * @var int Database ID of the user.
     */
    private $id;
    
    /**
     * @var string A unique username for this user.
     */
    private $username;
    
    /**
     * 
     * @var IDbConnection Database connection to perform queries on.
     */
    private $db;
    
    /**
     * Constructor for the User class.
     * Depending on the parameter input, a User class with
     * database ID or username will be instantiated.
     * 
     * @example $user = new User(1);
     * @example $user = new User("martinambrus");
     * 
     * @param int|string    $identifier ID or username for this user.
     * @param IDbConnection $database   Instance of the database class to use to perform queries.
     * 
     * @return void This method doesn't have a return value.
     */
    public function __construct($identifier, IDbConnection $database) {
        // check if we passed an ID or a username
        if (Math::isInt($identifier)) {
            $this->id = $identifier;
        } else {
            $this->username = $identifier;
        }

        $this->db = $database;
    }

    /**
     * Checks whether username or e-mail already exists in the database.
     * 
     * @param  IDbConnection $db    The current database connection.
     * @param  string        $value Value to check names and emails for.
     * @return boolean       Returns true if the value exists in database,
     *                       false otherwise.
     */
    public static function exists(IDbConnection $db, $value) {
        $sql = '(
                    SELECT
                        Count(*) AS in_users
                    FROM
                        '.TB_PREFIX.'users
                    WHERE
                        username = ? OR email = ?
                )
                UNION ALL
                (
                    SELECT
                        Count(*) AS in_act
                    FROM
                        '.TB_PREFIX.'activate
                    WHERE
                        username = ? OR email = ?
                )';

        $res = $db->query_new($sql, $value, $value, $value, $value);

        // convert result into an array
        $res = mysqli_fetch_array($res, MYSQLI_NUM);

        return ($res[0] > 0 || $res[1] > 0);
    }
}