<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: martinambrus <https://github.com/martinambrus>
 *          iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Entity;

use TravianZ\Database\IDbConnection;
use TravianZ\Enums\UserEnums;
use TravianZ\Factory\UnitsFactory;
use TravianZ\Natars\Artifacts;
use TravianZ\Utils\Math;

/**
 * Defines the properties of a user, e.g.
 * player entity
 * connected to their profile and other personal and account-specific
 * information.
 *
 * @author martinambrus
 * @author iopietro
 */
class User
{
    /**
     * @var bool Determines if the user is logged in.
     */
    public $isLoggedIn;
    
    /**
     * @var int Database ID of the logged sitter.
     */
    public $loggedSitter;

    /**
     * @var int Database ID of the User.
     */
    public $id;

    /**
     * @var string A unique username for this User.
     */
    public $username;
    
    /**
     * @var string A unique email for this User.
     */
    public $email;

    /**
     * @var int The User's tribe.
     */
    public $tribe;
    
    /**
     * @var int The User's alliance.
     */
    public $alliance;
    
    /**
     * @var int The User's gold.
     */
    public $gold;
    
    /**
     * @var bool Determines if the User has a plus account.
     */
    public $plus;
    
    /**
     * @var bool Determines if the User is a gold club member.
     */
    public $goldclub;
    
    /**
     * @var array The User's bonuses.
     */
    public $bonuses;

    /**
     * @var int The User's culture points.
     */
    public $culturePoints;
    
    /** 
     * @var int The User's access.
     */
    public $access;
    
    /**
     * @var int When the User's beginner protection will end
     */
    public $beginnerProtectionEndTime;
    
    /**
     * @var string The User's actual gpack.
     */
    public $gpack;
    
    /**
     * @var int Determines if there's a pending system message.
     */
    public $ok;

    /**
     * @var int The User's Quest number.
     */
    public $questNumber;

    /**
     * @var int The User's units max evasion
     */
    public $maxEvasion;
    
    /**
     * @var int The User's selected village.
     */
    public $selectedVillage;
    
    /**
     * @var bool Determines if the User has enabled the vacation mode.
     */
    private $vacationModeEnabled;
    
    /**
     * @var int The vacation end time
     */
    private $vacationTime;
    
    /**
     * @var Villages The User's villages.
     */
    private $villages;
    
    /**
     * @var Villages The User's farm lists.
     */
    private $farmLists;
    
    /**
     * @var array The User's reports
     */
    private $reports;
    
    /**
     * @var array The User's messages
     */
    private $messages;
    
    /**
     * @var int If the User is deleting, provides the deleting timestamp.
     */
    private $inDeleting;

    /**
     * @var array The User's sitters.
     */
    private $sitters;

    /**
     * @var string The User's password.
     */
    private $password;

    /**
     * @var UserEnums The User's state.
     */
    private $state;

    /**
     * @var IDbConnection Database connection to perform queries on.
     */
    private $db;

    /**
     * Constructor for the User class.
     * Depending on the parameter input, a User class with
     * database ID or username will be instantiated.
     *
     * @example $user = new User($database, 1);
     * @example $user = new User($database, "martinambrus");
     * @example $user = new User($database, "iopietro", true);
     * @example $user = new User($database, "example@example.com");
     *
     * @param IDbConnection $database
     *            Instance of the database class to use to perform queries.
     * @param int|string|array $identifier
     *            ID or username for this user.
     * @param bool $identifier Determines if the user needs to be initialized or not.
     */
    public function __construct(IDbConnection $database, $identifier, bool $init = false, bool $checkExistence = true)
    {
        $this->db = $database;
        
        $this->setIdentifier($identifier);
        
        // Check the User existence
        if ($checkExistence) {
            $this->setState();
        }

        if ($init) {
            //If the user exists and it's already active, initialize him
            if ($this->getState() == UserEnums::ACTIVATED) {
                $this->init();
            }
        }
    }

    /**
     * Checks whether username or e-mail already exists in the database.
     *
     * @return array Returns true if the value exists in database,
     *         false otherwise.
     */
    public function exists(): array
    {
        $sql = '(
                    SELECT
                        Count(*) AS Total
                    FROM
                        ' . TB_PREFIX . 'users
                    WHERE
                        id = ? OR username = ? OR email = ?
                )
                UNION ALL
                (
                    SELECT
                        Count(*) AS Total
                    FROM
                        ' . TB_PREFIX . 'activate
                    WHERE
                        username = ? OR email = ? OR act = ?
                )';

        $res = $this->db->queryNew(
            $sql, 
            $this->getIdentifier(), 
            $this->getIdentifier(), 
            $this->getIdentifier(), 
            $this->getIdentifier(),
            $this->getIdentifier(),
            $this->getIdentifier()
            );

        return [
            'activated' => $res[0]['Total'],
            'needActivation' => $res[1]['Total']
        ];
    }

    /**
     * Initialize the user
     * 
     * @param $identifier int|string The user's identifier
     */
    private function init()
    {
        $sql =  'SELECT
                     *
                 FROM
                     ' . TB_PREFIX . 'users
                 WHERE
                     id = ? OR username = ? OR email = ?';
        
        $res = $this->db->queryNew($sql, $this->getIdentifier(), $this->getIdentifier(), $this->getIdentifier())[0];

        // Set the time variable
        $time = time();
        
        // Set public properties
        $this->id = $res['id'];
        $this->username = $res['username'];
        $this->email = $res['email'];
        $this->tribe = $res['tribe'];
        $this->alliance = $res['alliance'];
        $this->gold = $res['gold'];
        $this->plus = $res['plus'] >= time();;
        $this->goldclub = $res['goldclub'];
        $this->bonuses = [
            'wood' => $res['b1'],
            'clay' => $res['b2'],
            'iron' => $res['b3'],
            'crop' => $res['b4']
        ];
        $this->culturePoints = floor($res['cp']);
        $this->access = $res['access'];
        $this->beginnerProtectionEndTime = $res['protect'];
        $this->ok = $res['ok'];
        $this->vacationModeEnabled = $res['vac_mode'];
        $this->vacationTime = $res['vac_time'];
        $this->questNumber = $res['quest'];
        $this->maxEvasion = $res['maxevasion'];
        $this->selectedVillage = $res['actualvillage'];

        // Set private properties
        $this->sitters = [$res['sit1'], $res['sit2']];
        $this->password = $res['password'];
        
        // Set the User's villages
        $this->setVillages();
    }
    
    /**
     * Check if the user is an admin
     * 
     * @return bool Returns true if it's an admin, false otherwise
     */
    public function isAdmin()
    {
        return $this->access >= 8;
    }
    
    /**
     * Check if the user is banned
     * 
     * @return bool Returns true if the User is banned, false otherwise
     */
    public function isBanned(): bool
    {
        return $this->access == 0;
    }
    
    /**
     * Check if the user is under the beginner protection
     *
     * @return bool Returns true if the User is an admin, false otherwise
     */
    public function isUnderBeginnerProtection(): bool
    {
        return $this->beginnerProtectionEndTime > time();
    }
    
    /**
     * Check if the user is on vacation
     *
     * @return bool Returns true if the User is on vaction, false otherwise
     */
    public function isOnVacation(): bool
    {
        return $this->vacationModeEnabled && $this->vacationTime > time();
    }
    
    /**
     * Check if the user started the account deletion process
     *
     * @return bool Returns true if it's banned, false otherwise
     */
    public function inDeleting(): int
    {
        if (!is_null($this->inDeleting)) {
            return $this->inDeleting;
        }
        
        $sql = 'SELECT
                     timestamp
                 FROM
                     ' . TB_PREFIX . 'deleting
                 WHERE
                     uid = ?';
        
        $res = $this->db->queryNew($sql, $this->id)[0]['timestamp'];
        
        $this->inDeleting = is_null($res) ? 0 : $res;
        
        return $this->inDeleting;
    }
    
    /**
     * Log the user into the game
     *
     * @param string $password The user's password
     * @return bool Returns if the user's logged in sucesfully
     */
    public function logIn(string $password): bool
    {
        $this->isLoggedIn = password_verify($password, $this->password);

        // Check if the login was sucessful
        if (!$this->isLoggedIn && ($this->sitters[0] || $this->sitters[1])) {
            // Try to log in as a sitter
            $this->isLoggedIn = $this->sitterLogin($this->sitters);
        } else {
            // No sitters have logged in, set the property to 0
            $this->loggedSitter = 0;
        }

        return $this->isLoggedIn;
    }
    
    /**
     * If the normal login has failed, try to log in as a sitter
     *
     * @param array $sitters The sitter's informations
     * @return bool Returns true if the password matched one of the two sitters, false otherwise
     */
    private function sitterLogIn(array $sitters): bool
    {
        $sql = 'SELECT
                    id, password
                FROM
                    ' . TB_PREFIX . 'users
                WHERE
                    id = ? OR id = ?';
        
        $res = $this->db->queryNew($sql, $sitters['sit1'], $sitters['sit2']);
        
        if(password_verify($res[0]['password'], $sitters['password'])) {
            $this->loggedSitter = $res[0]['id'];
            return true;
        } elseif(password_verify($res[1]['password'], $sitters['password'])) {
            $this->loggedSitter = $res[1]['id'];
            return true;
        }
        
        return false;
    }

    /**
     * Activate the user
     * 
     * @param string $activationCode The user's activation code
     * @return bool Returns true if activated succesfully, false otherwise
     */
    public function activate(): bool
    {
        if ($this->state != UserEnums::NOT_ACTIVATED) return false;
        
        $sql = 'SELECT
                    *
                FROM
                    ' . TB_PREFIX . 'activate
                WHERE
                    act = ?';
        
        $res = $this->db->queryNew($sql, $this->getIdentifier())[0];
        
        // Set the username
        $this->setIdentifier($res['username']);
        
        // Register the account
        if ($this->register($res['password'], $res['email'], $res['tribe'], $res['act'], $res['sector'])) {
            return $this->deactivate();
        }
       
        return false;
    }
    
    /**
     * Add the user to the activation table
     * 
     * @param string $password The user's password
     * @param string $email The user's email
     * @param int $tribe The chosen tribe
     * @param int $sector The starting village sector
     * @param string The activation code
     * @param int $invite The user who sent the invite
     * @param int $time The actual time
     * @return bool Returns true if the query was successful, false otherwise
     */
    public function addActivation(string $password, string $email, int $tribe, int $sector, string $act, int $invite, int $time): bool
    {
        if ($this->state != UserEnums::DOES_NOT_EXIST) {
            return false;
        }

        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'activate
                    (username, password, access, email, tribe, timestamp, location, act, invite)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?)';

        return $this->db->queryNew(
            $sql, 
            $this->getIdentifier(),
            $password,
            2,
            $email,
            $tribe,
            $time,
            $sector,
            $act,
            $invite
            );
    }
    
    /**
     * Deactivate the user
     * 
     * @return bool Returns true if the query was successful, false otherwise
     */
    public function deActivate(): bool
    {
        $sql = 'DELETE FROM
                    ' . TB_PREFIX . 'activate
                WHERE
                    username = ? OR act = ?';

        return $this->db->queryNew($sql, $this->getIdentifier(), $this->getIdentifier());
    }
    
    /**
     * Register the user
     * 
     * @param string $password
     * @param string $email
     * @param int $tribe
     * @param string $act
     * @param int $sector
     * @param int $invite
     * @param int $time The actual time
     * @param int $id
     * @param string $desc
     * @return bool
     */
    public function register(string $password, string $email, int $tribe, string $act, int $sector, int $invited, int $time, int $id = 0, string $desc = ''): bool
    {
        if ($this->state == UserEnums::ACTIVATED) return false;

        $startTime = strtotime(START_DATE) - strtotime(date('d.m.Y')) + strtotime(START_TIME);
        
        // If we're registering the Natars tribe, the protection must be 0
        $protectionTime = $id != Artifacts::NATARS_UID ? (($startTime > $time) ? $time : $startTime) + PROTECTION : 0;

        $sql = 'INSERT INTO
                    ' . TB_PREFIX . 'users
                    (id, username, password, access, email, tribe, act, protect, lastupdate, regtime, desc2, invited)
                VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $res = $this->db->queryNew(
            $sql, 
            $id, 
            $this->username,
            password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
            2,
            $email,
            $tribe,
            $act,
            $protectionTime,
            $time,
            $time,
            $desc,
            $invited
            );

        // Set the User ID
        $this->id = $res;
        
        if ($res && AUTH_EMAIL) {
            $this->state = UserEnums::NOT_ACTIVATED;
        } else {
            $this->state = UserEnums::ACTIVATED;
        }
        
        return $res;
    }
    
    /**
     * Generate a new password
     * 
     * @param string $newPassword The new password
     * @param string $codePassword The new password code
     * @param int $time The password generation timestamp
     * @return bool Returns true if the query was successful, false otherwise
     */
    public function generateNewPassword(string $newPassword, string $codePassword, int $time): bool
    {
        if ($this->state != UserEnums::ACTIVATED) {
            return false;
        }
 
        $sql = 'INSERT IGNORE INTO
                        ' . TB_PREFIX . 'password
                        (uid, npw, cpw, timestamp)
                VALUES
                        (?, ?, ?, ?)';
        
        return $this->db->queryNew(
            $sql,
            $this->id,
            password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]),
            $codePassword,
            $time
        );
    }
    
    /**
     * Set the new generated password
     * 
     * @param string $code
     * @return bool
     */
    public function setNewPassword(string $code): bool
    {
        if ($this->getState() != UserEnums::ACTIVATED) {
            return false;
        }

        $sql = 'SELECT
                    npw, cpw
                FROM
                    ' . TB_PREFIX . 'password
                WHERE
                    uid = ? AND used = 0';
        $res = $this->db->queryNew($sql, $this->id)[0];

        // Check if it exists and if so, if the code is valid
        if (empty($res) || $res['cpw'] != $code) {
            return false;
        }

        $sql = 'UPDATE
                    ' . TB_PREFIX . 'password
                SET
                    used = 1
                WHERE
                    uid = ?';
        
        // Check if it exists
        if ($this->db->queryNew($sql, $this->id)) {
            return $this->changePassword($res['npw']);
        } else {
            return false;
        }
    }
    
    /**
     * Get the User's password
     * 
     * @return string Returns the User's password
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * Change the user's password
     * 
     * @param string $newPassword The new password (already hashed)
     * @return bool Returns true if the query was successful, false otherwise
     */
    public function changePassword(string $newPassword): bool
    {
        $sql = 'UPDATE
                    ' . TB_PREFIX . 'users
                SET
                    password = ?
                WHERE
                    id = ?';

        // Change the password locally
        $this->password = $newPassword;
        
        return $this->db->queryNew($sql, $newPassword, $this->id);
    }
    
    /**
     * Change the actual selected village
     */
    public function changeSelectedVillage(int $newVillage)
    {
        // Check if the actual selected village is equal to the new selected village
        if ($newVillage == $this->selectedVillage) {
            return;
        }
        
        // Check if the village is owned by the user
        foreach ($this->getVillages() as $village) {
            if ($village->vref == $newVillage) {
                $this->selectedVillage = $newVillage;
                $this->setUserFields(['actualvillage'], [$newVillage]);
                break;
            }
        }
    }
    
    
    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int|string $identifier
     */
    private function setState()
    {
        $exists = $this->exists();

        if ($exists['activated']) {
            $this->state = UserEnums::ACTIVATED;
        } elseif($exists['needActivation']) {
            $this->state = UserEnums::NOT_ACTIVATED;
        } else {
            $this->state = UserEnums::DOES_NOT_EXIST;
        }
    }
    
    /**
     * Get one or more user's fields
     * 
     * @param array $fields The fields to be obtained
     * @return array Returns the fields from the database
     */
    public function getUserFields(array $fields): array
    {
        // Check if the user exist
        if($this->getState() != UserEnums::ACTIVATED) {
            return [];
        }
        
        $fields = implode(',', $fields);

        $sql =  'SELECT
                     ?
                 FROM
                     ' . TB_PREFIX . 'users
                 WHERE
                     id = ? OR username = ?';
        
        return $this->db->queryNew($sql, $fields, $this->getIdentifier(), $this->getIdentifier())[0];
    }

    /**
     * Set one or more user's fields
     * 
     * @param array $fields The fields to be set
     * @param array $values The values to be set
     * @return bool True if the query was successful, false otherwise
     */
    public function setUserFields(array $fields, array $values): bool
    {
        if ($this->getState() != UserEnums::ACTIVATED) {
            return false;
        }
        
        $pairs = [];
        foreach ($fields as $field) {
            $pairs[] = $field.' = ?';
        }

        $pairs = implode(',', $pairs);
        
        $sql =  'UPDATE
                     ' . TB_PREFIX . 'users
                 SET
                     '.$pairs.'
                 WHERE
                     id = ? OR username = ?';

        $values[] = $this->getIdentifier();
        $values[] = $this->getIdentifier();

        return $this->db->queryNew($sql, $values);
    }
    
    /**
     * Set an user's identification property, based on the passed identifier
     * 
     * @param int|string|array $identifier
     */
    public function setIdentifier($identifier)
    {
        if (is_array($identifier)){ // It's an array --> [$id, $username, $tribe]
            $this->id = $identifier[0];
            $this->username = $identifier[1];
            $this->tribe = $identifier[2];
        } elseif (Math::isInt($identifier)) { // User ID
            $this->id = $identifier;
        } elseif (strpos($identifier, '@') !== false) { // Email
            $this->email = $identifier;
        } else { // Username or activation code
            $this->username = $identifier;
        }
    }
    
    /**
     * Get the first not-null user's identifier
     * 
     * @return int|string Returns the user's ID, the email or the username
     */
    public function getIdentifier()
    {
        if (!is_null($this->id)) { // User ID
            return $this->id;
        } elseif (!is_null($this->email)) { // Email
            return $this->email;
        } else { // Username or activation code
            return $this->username;
        }
    }
    
    /**
     * Get the User's villages count
     *
     * @param bool $fast The expansion rate
     * @return int Returns the User's villages count
     */
    public function getNextVillageCulturePoints(bool $slow): int
    {
        return Math::roundWithPrecision(1600 / ($slow ? 1 : 3) * $this->villages->getVillagesCount() ** 2.3, $slow ? 1000 : 100);
    }

    /**
     * Get the User's villages count
     *
     * @return int Returns the User's villages count
     */
    public function getVillagesCount(): int
    {
        return $this->villages->getVillagesCount();
    }
    
    /**
     * Get the User's villages
     * 
     * @return array Returns the User's villages
     */
    public function getVillages(): array
    {
        return $this->villages->getVillages();
    }
    
    /**
     * Set the User's villages
     */
    private function setVillages()
    {
        $this->villages = new Villages($this->db);
        $this->villages->initByOwner($this);
    }
    
    /**
     * Get the User's farm lists
     * 
     * @return array Returns the User's farm lists
     */
    public function getFarmLists(): array
    {
        return $this->farmLists;
    }
    
    /**
     * Set the User's farm lists
     */
    public function setFarmLists()
    {
        $sql = 'SELECT
                    farmlist.*, raidlist.*, farmlist.id as farmListID, raidlist.id as raidListID,
                    fromVillage.name as fromVillageName,
                    toVillage.name as toVillageName, toVillage.pop as toVillagePop,
                    fromVillageCell.x as fromVillageX, fromVillageCell.y as fromVillageY, 
                    toVillageCell.x as toVillageX, toVillageCell.y as toVillageY,
                    toOases.name as toOasesName,
                    toUser.id as toUserID, toUser.username as toUsername, toUser.tribe as toUserTribe, 
                    toUser.access as toUserAccess, toUser.protect as toUserProtection,
                    toUser.vac_time as toUserVacationTime, toUser.vac_mode as toUserVacationEnabled
                FROM
                    ' . TB_PREFIX . 'farmlist as farmlist
                LEFT JOIN
                    ' . TB_PREFIX . 'raidlist as raidlist
                ON
                    raidlist.lid = farmlist.id
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as fromVillage
                ON
                    fromVillage.wref = farmlist.`from`
                LEFT JOIN
                    ' . TB_PREFIX . 'vdata as toVillage
                ON
                    toVillage.wref = raidlist.`to`
                LEFT JOIN
                    ' . TB_PREFIX . 'wdata as fromVillageCell
                ON
                    fromVillageCell.id = fromVillage.wref
                LEFT JOIN
                    ' . TB_PREFIX . 'odata as toOases
                ON
                    toOases.wref = raidlist.`to`
                LEFT JOIN
                    ' . TB_PREFIX . 'wdata as toVillageCell
                ON
                    toVillageCell.id = IFNULL(toVillage.wref, toOases.wref)
                LEFT JOIN
                    ' . TB_PREFIX . 'users as toUser
                ON
                    toUser.id = IFNULL(toVillage.owner, toOases.owner)
                WHERE
                    farmlist.owner = ?';

        $res = $this->db->queryNew($sql, $this->id);

        // Reset the actual farm lists
        $this->farmLists = [];
        
        // Check if there's at least one farm list
        if (empty($res)) {
            return;
        }
        
        foreach ($res as $farmList) {
            // Initialization
            $lastReport = null;

            // Search for the last attack report
            foreach ($this->getReports() as $report) {                
                // Check if it was the last attack report
                if (
                    $report->to->vref == $farmList['to'] &&
                    in_array($report->type, [1, 2, 3, 7])
                ) {
                    $lastReport = $report;
                    break;
                }
            }

            // Check if there's not a farm list with that id
            if (!isset($this->farmLists[$farmList['farmListID']])) {
                // Create the farm list
                $this->farmLists[$farmList['farmListID']] = new FarmList(
                    $this->db,
                    $farmList['farmListID'],
                    new Village(
                        $this->db, 
                        $this, 
                        $farmList['from'],
                        $farmList['fromVillageName'], 
                        false,
                        false,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        [],
                        ['x' => $farmList['fromVillageX'], 'y' => $farmList['fromVillageY']]
                    ), 
                    $farmList['name'], 
                    []
                );
            }

            // Check if the raid list isn't null
            if (!is_null($farmList['raidListID'])) {
                // Initialize the units
                $units = [];

                // Set the units
                for ($i = 1; $i <= 6; $i++) {
                    $units[$i] = UnitsFactory::create($this->tribe, $i, $farmList['u'.$i]);
                }

                // Create the user
                $farmListUser = new User(
                    $this->db,
                    [$farmList['toUserID'], $farmList['toUsername'], $farmList['toUserTribe']],
                    false,
                    false
                );
                
                // Set the access and the beginner protection
                $farmListUser->access = $farmList['toUserAccess'];
                $farmListUser->beginnerProtectionEndTime = $farmList['toUserProtection'];
                $farmListUser->vacationModeEnabled = $farmList['toUserVacationEnabled'];
                $farmListUser->vacationTime = $farmList['toUserVacationTime'];
                
                // Create the village/oases
                if (!is_null($farmList['toVillageName'])) {
                    $farmListWorldCell = new Village(
                        $this->db,
                        $farmListUser,
                        $farmList['to'],
                        $farmList['toVillageName'],
                        false,
                        false,
                        0,
                        0,
                        0,
                        $farmList['toVillagePop'],
                        0,
                        0,
                        [],
                        ['x' => $farmList['toVillageX'], 'y' => $farmList['toVillageY']]
                    );
                } elseif (!is_null($farmList['toOasesName'])) {
                    $farmListWorldCell = new Oases(
                        $this->db, 
                        $farmListUser, 
                        $farmList['to'],
                        $farmList['toOasesName'],
                        false,
                        false,
                        0,
                        ['x' => $farmList['toVillageX'], 'y' => $farmList['toVillageY']]
                    );
                }

                // Add the raid list
                $this->farmLists[$farmList['farmListID']]->raidsList[] = new RaidList(
                    $this->db,
                    $farmList['raidListID'],
                    $farmList['farmListID'],
                    $farmListWorldCell,
                    $units,
                    $lastReport
                );
            }
        }
    }
    
    /**
     * Add a raid list to farm list
     * 
     * @param int $farmListID The farm list ID in which the raid list should be added
     * @param RaidList $raidList The raid list to add
     */
    public function addRaidList(int $farmListID, RaidList $raidList)
    {
        $this->farmLists[$farmListID]->raidsList[] = $raidList;
    }
    
    /**
     * Delete a raid list
     *
     * @param int $farmListID The farm list ID
     * @param int $raidListID The raid list ID
     */
    public function deleteRaidList(int $farmListID, int $raidListIndex)
    {
        unset($this->farmLists[$farmListID]->raidsList[$raidListIndex]);
    }

    /**
     * Add a farm list
     *
     * @param FarmList $farmList The farm list to add
     */
    public function addFarmList(FarmList $farmList)
    {
        $this->farmLists[$farmList->id] = $farmList;
    }
    
    /**
     * Delete a farm list
     *
     * @param int $farmListID The farm list ID
     */
    public function deleteFarmList(int $farmListID)
    {
        unset($this->farmLists[$farmListID]);
    }
    
    /**
     * Get the User's reports
     * 
     * @return array Returns the User's reports
     */
    public function getReports(): array
    {
        return $this->reports;
    }
    
    /**
     * Set the User's reports
     */
    public function setReports()
    {
        $sql =  'SELECT
                     reports.*, toVillage.name as toVillageName, toOases.name as toOasesName,
                     fromVillage.name as fromVillageName, fromOases.name as fromOasesName,
                     fromUser.id as fromUserID, fromUser.username as fromUsername, fromUser.tribe as fromUserTribe, 
                     toUser.id as toUserID, toUser.username as toUsername, toUser.tribe as toUserTribe,
                     fromVillageCell.x as fromCoordinatesX, fromVillageCell.y as fromCoordinatesY,
                     toVillageCell.x as toCoordinatesX, toVillageCell.y as toCoordinatesY
                 FROM
                     ' . TB_PREFIX . 'reports as reports
                 LEFT JOIN
                     ' . TB_PREFIX . 'vdata as fromVillage
                 ON
                     fromVillage.wref = reports.`from`
                 LEFT JOIN
                     ' . TB_PREFIX . 'vdata as toVillage
                 ON
                     toVillage.wref = reports.`to`
                 LEFT JOIN
                     ' . TB_PREFIX . 'odata as fromOases
                 ON
                     fromOases.wref = reports.`from`
                 LEFT JOIN
                     ' . TB_PREFIX . 'odata as toOases
                 ON
                     toOases.wref = reports.`to`
                 LEFT JOIN
                    ' . TB_PREFIX . 'wdata as fromVillageCell
                 ON
                     fromVillageCell.id = IFNULL(fromVillage.wref, fromOases.wref)
                 LEFT JOIN
                    ' . TB_PREFIX . 'wdata as toVillageCell
                 ON
                     toVillageCell.id = IFNULL(toVillage.wref, toOases.wref)
                 LEFT JOIN
                    ' . TB_PREFIX . 'users as fromUser
                 ON
                     fromUser.id = IFNULL(fromVillage.owner, fromOases.owner)
                 LEFT JOIN
                    ' . TB_PREFIX . 'users as toUser
                 ON
                     toUser.id = IFNULL(toVillage.owner, toOases.owner)
                 WHERE
                     reports.owner = ?
                 ORDER BY
                     reports.time
                 ASC';

        $res = $this->db->queryNew($sql, $this->id);
        
        // Reset the actual reports
        $this->reports = [];

        // Check if there's at least one report
        if (empty($res)) {
            return;
        }

        // Set the reports
        foreach ($res as $report) {
            // Set the from village/oases
            if (!is_null($report['fromVillageName'])) {
                $reportFromWorldCell = new Village(
                    $this->db,
                    new User(
                        $this->db,
                        [$report['fromUserID'], $report['fromUsername'], $report['fromTribe']],
                        false,
                        false
                    ),
                    $report['from'],
                    $report['fromVillageName'],
                    false,
                    false,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    [],
                    ['x' => $report['fromCoordinatesX'], 'y' => $report['fromCoordinatesY']]
                );
            } elseif (!is_null($report['fromOasesName'])) {
                $reportFromWorldCell = new Oases(
                    $this->db,
                    new User(
                        $this->db,
                        [$report['fromUserID'], $report['fromUsername'], $report['fromTribe']],
                        false,
                        false
                    ),
                    $report['from'],
                    $report['fromOasesName'],
                    false,
                    false,
                    0,
                    ['x' => $report['fromCoordinatesX'], 'y' => $report['fromCoordinatesY']]
                );
            }
            
            // Set the to village/oases
            if (!is_null($report['toVillageName'])) {
                $reportToWorldCell = new Village(
                    $this->db,
                    new User(
                        $this->db,
                        [$report['toUserID'], $report['toUsername'], $report['toTribe']],
                        false,
                        false
                    ),
                    $report['to'],
                    $report['toVillageName'],
                    false,
                    false,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    [],
                    ['x' => $report['toCoordinatesX'], 'y' => $report['toCoordinatesY']]
                );
            } elseif(!is_null($report['toOasesName'])) {
                $reportToWorldCell = new Oases(
                    $this->db,
                    new User(
                        $this->db,
                        [$report['toUserID'], $report['toUsername'], $report['toTribe']],
                        false,
                        false
                    ),
                    $report['to'],
                    $report['toOasesName'],
                    false,
                    false,
                    0,
                    ['x' => $report['toCoordinatesX'], 'y' => $report['toCoordinatesY']]
                );
            }
            
            $this->reports[] = new Report(
                $this->db,
                $report['id'],
                $this,
                $reportFromWorldCell,
                $reportToWorldCell,
                $report['topic'],
                $report['type'],
                explode(',', $report['data']),
                $report['time'],
                $report['viewed'],
                $report['archived'],
                $report['deleted']
            );
        }
    }
    
    /**
     * Get the User's activation data
     *
     * @return array
     */
    public function getActivationData(): array
    {
        if ($this->getState() != UserEnums::NOT_ACTIVATED) {
            return [];
        }
        
        $sql =  'SELECT
                     *
                 FROM
                     ' . TB_PREFIX . 'activate
                 WHERE
                     act = ? OR username = ?';
        
        return $this->db->queryNew($sql, $this->getIdentifier(), $this->getIdentifier())[0];
    }
    
    /**
     * @return string
     */
    public function __tostring(): string
    {
        return $this->getIdentifier();
    }
}
