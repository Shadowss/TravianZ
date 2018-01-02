<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       db_MYSQL.php                                                ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################

global $autoprefix;

// even with autoloader created, we can't use it here yet, as it's not been created
// ... so, let's see where it is and include it
$autoloader_found = false;
// go max 5 levels up - we don't have folders that go deeper than that
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        $autoloader_found = true;
        include_once $autoprefix.'autoloader.php';
        break;
    }
}

if (!$autoloader_found) {
    die('Could not find autoloading class.');
}

include_once("config.php");

use App\Database\IDbConnection;
use App\Utils\Math;

class MYSQLi_DB implements IDbConnection {

    private
        /**
         * @var string MySQL server hostname to connect to.
         */
        $hostname = 'localhost',

        /**
         * @var int MySQL server port to connect to.
         */
        $port = 3306,

        /**
         * @var string Username to authenticate with to the MySQL connection.
         */
        $username = 'root',

        /**
         * @var string Password to authenticate with to the MySQL connection.
         */
        $password = '',

        /**
         * @var string Database to use with TravianZ.
         */
        $dbname = 'travian',

        /**
         * @var int Counter of all SELECT queries performed.
         */
        $selectQueryCount = 0,

        /**
         * @var int Counter of all INSERT queries performed.
         */
        $insertQueryCount = 0,

        /**
         * @var int Counter of all UPDATE queries performed.
         */
        $updateQueryCount = 0,

        /**
         * @var int Counter of all DELETE queries performed.
         */
        $deleteQueryCount = 0,

        /**
         * @var int Counter of all REPLACE queries performed.
         */
        $replaceQueryCount = 0;

    // variables for DB-cached data for this request
    private static
        /**
         * @var array Cache of user fields and their values.
         */
        $fieldsCache = [],

        /**
         * @var array Cache of village fields and their values.
         */
        $villageFieldsCache = [],

        /**
         * @var array Cache of village fields and their values, retrieved by world ID.
         */
        $villageFieldsCacheByWorldID = [],

        /**
         * @var array Cache of village IDs for users.
         */
        $villageIDsCache = [],

        /**
         * @var array Cache of village IDs for users, using simple associative arrays.
         */
        $villageIDsCacheSimple = [],

        /**
         * @var array Cache of village battle data.
         */
        $villageBattleDataCache = [],

        /**
         * @var array Cache of village data by owner IDs.
         */
        $villageDataByOwnerCache = [],

        /**
         * @var array Cache of world and village data.
         */
        $worldAndVillageDataCache = [],

        /**
         * @var array Cache of world and oasis data.
         */
        $worldAndOasisDataCache = [],

        /**
         * @var array Cache of last topic check for a category.
         */
        $lastTopicCheckCache = [],

        /**
         * @var array Cache of last post check for a topic.
         */
        $lastPostForTopicCheckCache = [],

        /**
         * @var array Cache of last post for a topic.
         */
        $lastPostForTopicCache = [],

        /**
         * @var array Cache of topics count for a user.
         */
        $topicCountCache = [],

        /**
         * @var array Cache of edit results.
         */
        $editResultsCache = [],

        /**
         * @var array Cache of users count.
         */
        $usersCountCache = [],

        /**
         * @var array Cache of alliances count.
         */
        $allianceCountCache = [],

        /**
         * @var array Cache of alliance data from the DB.
         */
        $allianceDataCache = [],

        /**
         * @var array Cache of alliance permissions.
         */
        $alliancePermissionsCache = [],

        /**
         * @var array Cache of alliance members.
         */
        $allianceMembersCache = [],

        /**
         * @var array Cache of alliance member counts.
         */
        $allianceMembersCountCache = [],

        /**
         * @var array Cache of alliance owner checks.
         */
        $allianceOwnerCheckCache = [],

        /**
         * @var array Cache of alliance allies.
         */
        $allianceAlliesCache = [],

        /**
         * @var array Cache of alliance ranking.
         */
        $allianceRankingCache = [],

        /**
         * @var array Cache of user alliances.
         */
        $userAllianceCache = [],

        /**
         * @var array Cache of user summary fields.
         */
        $userSumFieldCache = [],

        /**
         * @var array Cache of artefact infos.
         */
        $artefactDataCache = [],

        /**
         * @var array Cache of fool artefacts.
         */
        $foolArtefactCache = [],

        /**
         * @var array Cache of own artefact infos, from the simple SQL select.
         */
        $artefactInfoSimpleCache = [],

        /**
         * @var array Cache of own artefact infos by type.
         */
        $artefactInfoByTypeCache = [],

        /**
         * @var array Cache of heroes.
         */
        $heroCache = [],

        /**
         * @var array Cache of hero field values.
         */
        $heroFieldCache = [],

        /**
         * @var array Cache of market field values.
         */
        $marketFieldCache = [],

        /**
         * @var array Cache of market movement values.
         */
        $marketMovementCache = [],

        /**
         * @var array Cache of units in a village.
         */
        $unitsCache = [],

        /**
         * @var array Cache of reinforcements in a village.
         */
        $villageReinforcementsCache = [],

        /**
         * @var array Cache of reinforcements by from ID and village ID.
         */
        $villageFromReinforcementsCache = [],

        /**
         * @var array Cache of reinforcements by ID.
         */
        $reinforcementsCache = [],

        /**
         * @var array Cache of oasis reinforcements by conquered & from ID.
         */
        $oasisReinforcementsCache = [],

        /**
         * @var array Cache of oasis reinforcements by ID.
         */
        $oasisArrayReinforcementsCache = [],

        /**
         * @var array Cache of prisoners.
         */
        $prisonersCache = [],

        /**
         * @var array Cache of prisoners by ID.
         */
        $prisonersCacheByID = [],

        /**
         * @var array Cache of prisoners by village ID and from ID.
         */
        $prisonersCacheByVillageAndFromIDs = [],

        /**
         * @var array Cache of resource levels.
         */
        $resourceLevelsCache = [],

        /**
         * @var array Cache of field levels in village search.
         */
        $fieldLevelsInVillageSearchCache = [],

        /**
         * @var array Cache of field levels.
         */
        $fieldLevelsCache = [],

        /**
         * @var array Cache of single field type for users.
         */
        $singleFieldTypeCountCache = [],

        /**
         * @var array Cache of field types.
         */
        $fieldTypeCache = [],

        /**
         * @var array Cache of oasis data.
         */
        $oasisFieldsCache = [],

        /**
         * @var array Cache of oasis data by conquered ID.
         */
        $oasisFieldsCacheByConqueredID = [],

        /**
         * @var array Cache of research.
         */
        $abTechCache = [],

        /**
         * @var array Cache of oasis' count for a village.
         */
        $oasisCountCache = [],

        /**
         * @var array Cache of oasis' troops count.
         */
        $oasisTroopsCountCache = [],

        /**
         * @var array Cache of oasis' conquerable status.
         */
        $oasisConquerableCache = [],

        /**
         * @var array Cache of notices by ID.
         */
        $noticesCacheById = [],

        /**
         * @var array Cache of notices by user ID.
         */
        $noticesCacheByUId = [],

        /**
         * @var array Cache of merchants used count.
         */
        $merchantsUseCountCache = [],

        /**
         * @var array Cache of crop production starvation value.
         */
        $cropProductionStarvationValueCache = [],

        /**
         * @var array Cache of profile villages.
         */
        $userVillagesCache = [],

        /**
         * @var array Cache of fdata research values.
         */
        $isResearchedCache = [],

        /**
         * @var array Cache of items in research.
         */
        $researchingCache = [],

        /**
         * @var array Cache of buildings being under construction.
         */
        $buildingsUnderConstructionCache = [],

        /**
         * @var array Cache of messages to be sent out to players,
         *            so we can collect them and send them out together
         *            at the end of script execution.
         */
        $sendMessageQueryCache = [],

        /**
         * @var int Maximum number of INSERT query values to cache in the sendMessageQueryCache.
         *          Once this amount is reached, the cache is flushed and a single query with all
         *          the cached values is executed.
         */
        $sendMessageQueryCacheMaxRecords = 75;

	public $dblink;

	/**
	 *
	 * Constructor.
	 * Will initialize the connection to MySQL
	 * and die on any error it would encounter.
	 *
	 * @example $db = new MYSQLi_DB(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
	 *
	 * @param   string $hostname Hostname of the MySQL server.
	 * @param   string $username Username to be used to to connect.
	 * @param   string $password Password to be used to to connect.
	 * @param   string $dbname   Name of the database to use.
	 * @param   int    $port     [Optional] server port to connect to. Default: 3306
	 * @return  void   This method doesn't have a return value.
	 */
	public function __construct($hostname, $username, $password, $dbname, $port = 3306) {
	    $this->hostname = $hostname;
	    $this->port     = $port;
	    $this->username = $username;
	    $this->password = $password;
	    $this->dbname   = $dbname;

	    // connect to the DB
		if (!$this->connect()) {
		    die(mysqli_error($this->dblink));
		}

		// we will operate in UTF8
		mysqli_query($this->dblink,"SET NAMES 'UTF8'");
	}

	/**
	 * {@inheritDoc}
	 * @see \App\Database\IDbConnection::connect()
	 */
	public function connect() {
	    // try to connect
        try {
            $this->dblink = mysqli_connect( $this->hostname, $this->username, $this->password, $this->dbname, $this->port );
        } catch (\Exception $exception) {
            $this->dblink = mysqli_connect( $this->hostname . ':' . $this->port, $this->username, $this->password );

            // return on error
            if (mysqli_error($this->dblink)) {
                return false;
            }

            // select the DB to use
            mysqli_select_db($this->dblink, $this->dbname);
        }

	    // return on error
	    if (mysqli_error($this->dblink)) {
	        return false;
	    } else {
	        // connected and DB exists, we're good to go
	        return true;
	    }
	}

	/**
	 * {@inheritDoc}
	 * @see \App\Database\IDbConnection::disconnect()
	 */
	public function disconnect() {
	    if ($this->dblink) {
	        if (!$this->dblink->close()) {
	            return false;
	        }

	        $this->dblink = null;
	    }

	    return true;
	}

	/**
	 * {@inheritDoc}
	 * @see \App\Database\IDbConnection::reconnect()
	 */
	public function reconnect() {
	    $this->disconnect();
	    return $this->connect();
	}

	/**
	 * {@inheritDoc}
	 * @see \App\Database\IDbConnection::query_new()
	 */
	public function query_new($statement, ...$params) {
	    if ($prep = mysqli_prepare($this->dblink, $statement)) {
	        // if we're doing a multi-update/insert/delete query,
	        // we'll need to mark it as such
	        $is_multi_query = false;

	        // determine the nature of this query
	        preg_match('/[^AZ-az]*(\()?[^AZ-az]*SELECT/i', $statement, $select_matches);
	        preg_match('/[^AZ-az]*(\()?[^AZ-az]*DELETE/i', $statement, $delete_matches);
	        preg_match('/[^AZ-az]*(\()?[^AZ-az]*INSERT/i', $statement, $insert_matches);
	        preg_match('/[^AZ-az]*(\()?[^AZ-az]*REPLACE/i', $statement, $replace_matches);
	        preg_match('/[^AZ-az]*(\()?[^AZ-az]*UPDATE/i', $statement, $update_matches);

	        // a single array parameter means that we're batching multiple
	        // value feeds for a single prepared statement, so we just use
	        // the first array value to actually prepare the statement
	        // and determine all the binding types
	        if (count($params) == 1) {
	            $paramsArray = $params[0];
	            $is_multi_query = true;
	        } else {
	            $paramsArray = $params;
	            // convert method parameters into an array,
	            // so we can reuse it in both cases - when we're executing
	            // just a single prepared statement and also when we're
	            // batching up multiple values for an insert/update/delete statement
	            $params = [$params];
	        }

	        // determine and prepare parameter types
	        $types = [];
	        foreach ($paramsArray as $param) {
	            // default to string, change if neccessary
	            $paramType = 's';

	            if (Math::isInt($param)) {
	                $paramType = 'i';
	            } else if (Math::isFloat($param)) {
	                $paramType = 'd';
	            }

	            $types[] = $paramType;
	        }

	        // dynamically bind each data batch using previously
	        // defined parameters
	        $implodedNames = [implode('', $types)];
	        $outputValues = [];

	        foreach ($params as $dataBatch) {
	            $bind_names = $implodedNames;
    	        for ($i=0; $i<count($dataBatch); $i++) {
    	            $bind_name = 'bind' . $i;
    	            $$bind_name = $dataBatch[$i];
    	            $bind_names[] = &$$bind_name;
    	        }
    	        call_user_func_array(array($prep, 'bind_param'), $bind_names);

        	    // SELECT
        	    if (count($select_matches)) {
                    // execute the statement to get its value back
                    if (mysqli_stmt_execute($prep)) {
                        $this->selectQueryCount++;
                        $queryResult = [];

                        // read metadata, so we know what fields we were actually selecting
                        // and can prepare our temporary variables to read them into
                        $resultMetaData = mysqli_stmt_result_metadata($prep);

                        $stmtRow = array();
                        $rowReferences = array();
                        while ($field = mysqli_fetch_field($resultMetaData)) {
                            $rowReferences[] = &$stmtRow[$field->name];
                        }
                        mysqli_free_result($resultMetaData);

                        // now call bind_result with all our variables to recive the data prepared
                        call_user_func_array(array($prep, 'bind_result'), $rowReferences);

                        // prepare the array-ed result
                        while(mysqli_stmt_fetch($prep)){
                            $row = array();
                            foreach($stmtRow as $key => $value){
                                $row[$key] = $value;
                            }
                            $queryResult[] = $row;
                        }

                        // free the result
                        mysqli_stmt_free_result($prep);

                        $outputValues[] = $queryResult;
                    } else {
                        throw new Exception('Failed to execute an SQL statement!');
                    }
        	    }
    	    }

    	    // free the prepared statement
    	    mysqli_stmt_close($prep);

    	    // return the expected result
    	    if (count($select_matches)) {
    	        // if there is only a single result, return it alone
    	        if (count($outputValues) === 1) {
    	            return $outputValues[0];
    	        } else {
    	            // otherwise, return all the data
    	            return $outputValues;
    	        }
    	    }
        } else {
            throw new Exception('Failed to prepare an SQL statement!');
	    }

	    return false;
	}

	/**
	 * {@inheritDoc}
	 * @see \App\Database\IDbConnection::is_connected()
	 */
	public function is_connected() {
	    return ($this->dblink ? true : false);
	}

    /***************************
    Function to process MYSQLi->fetch_all (Only exist in MYSQL)
    References: Result
     ***************************/
    function mysqli_fetch_all($result) {
        list($result) = $this->escape_input($result);

        $all = array();
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $all[] = $row;
            }
            return $all;
        }
    }

    function query_return($q) {
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    /***************************
    Function to do free query
    References: Query
     ***************************/
    function query($query) {
        return mysqli_query($this->dblink,$query);
    }

    function RemoveXSS($val) {
        list($val) = $this->escape_input($val);

        return htmlspecialchars($val, ENT_QUOTES);
    }

    /**
     * Returns a value previously cached from the database, if present.
     *
     * @param $arrayVariable  array  Reference to the static array in Database class to use for the lookup.
     * @param $arrayFieldName string The actual array field name to look a cached value for.
     *
     * @return Returns the requested cached value or null if it's not cached yet.
     */
	private static function returnCachedContent(&$arrayVariable, $arrayStructure) {
        if (!isset($arrayVariable[$arrayStructure])) {
            $arrayVariable[$arrayStructure] = [];
        }

        if (isset($arrayVariable[$arrayStructure]) && count($arrayVariable[$arrayStructure])) {
            return $arrayVariable[$arrayStructure];
        } else {
            return null;
        }
    }

    /**
     * Clears cached village data, so after automation is run, we can re-load new data (like resource levels etc)
     * to be displayed in the front-end.
     */
    public static function clearVillageCache() {
        self::$villageFieldsCache          = [];
        self::$villageFieldsCacheByWorldID = [];
    }

    /**
     * Returns a string value safely escaped to be used in mysqli_query() method.
     *
     * @param $value string The value to sanitize.
     *
     * @return string Returns a sanitized string, safe for SQL queries.
     */
	function escape($value) {
	    if (is_string($value)) {
            $value = stripslashes( $value );
            return mysqli_real_escape_string($this->dblink, $value);
        } else {
	        return $value;
        }
	}

    /**
     * Returns a list of safely escaped values which can be used to re-retrieve
     * them in a list() method.
     *
     * @example list($username, $password) = $database->escape_input($username, $password);
     *
     * @return array Returns an array with all items sanitized and safe to be used in SQL statements.
     */
	function escape_input() {
	    $numargs = func_num_args();
	    $arg_list = func_get_args();
	    $ret = [];

	    for ($i = 0; $i < $numargs; $i++) {
	        if (is_string($arg_list[$i])) {
               $arg_list[$i] = stripslashes($arg_list[$i]);
	           $res[] = mysqli_real_escape_string($this->dblink, $arg_list[$i]);
	        } else {
	           $res[] = $arg_list[$i];
	        }
	    }

	    return $res;
	}

	function return_link() {
		return $this->dblink;
	}

	function register($username, $password, $email, $tribe, $act) {
        list($username, $password, $email, $tribe, $act) = $this->escape_input($username, $password, $email, $tribe, $act);

		$time = time();
        	$stime = strtotime(START_DATE)-strtotime(date('m/d/Y'))+strtotime(START_TIME);
		if($stime > time()){
		$time = $stime;
		}
		$timep = $time + PROTECTION;
		$time = time();
		$q = "INSERT INTO " . TB_PREFIX . "users (username,password,access,email,timestamp,tribe,act,protect,lastupdate,regtime,is_bcrypt) VALUES ('$username', '$password', " . USER . ", '$email', $time, " . (int) $tribe . ", '$act', $timep, $time, $time,1)";
		if(mysqli_query($this->dblink,$q)) {
			return mysqli_insert_id($this->dblink);
		} else {
		    // if an error has occured, we probably don't have DB converted to handle bcrypt passwords yet
		    $q = "INSERT INTO " . TB_PREFIX . "users (username,password,access,email,timestamp,tribe,act,protect,lastupdate,regtime) VALUES ('$username', '$password', " . USER . ", '$email', $time, " . (int) $tribe . ", '$act', $timep, $time, $time)";
		    if(mysqli_query($this->dblink,$q)) {
		        return mysqli_insert_id($this->dblink);
		    } else {
			    return false;
		    }
		}
	}

	function activate($username, $password, $email, $tribe, $locate, $act, $act2) {
        list($username, $password, $email, $tribe, $locate, $act, $act2) = $this->escape_input($username, $password, $email, $tribe, $locate, $act, $act2);

		$time = time();
		$q = "INSERT INTO " . TB_PREFIX . "activate (username,password,access,email,tribe,timestamp,location,act,act2) VALUES ('$username', '$password', " . USER . ", '$email', " . (int) $tribe .", $time, $locate, '$act', '$act2')";
				if(mysqli_query($this->dblink,$q)) {
			return mysqli_insert_id($this->dblink);
		} else {
			return false;
		}
	}

	function unreg($username) {
        list($username) = $this->escape_input($username);

		$q = "DELETE from " . TB_PREFIX . "activate where username = '$username'";
		return mysqli_query($this->dblink,$q);
	}
	function deleteReinf($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE from " . TB_PREFIX . "enforcement where id = '$id'";
		mysqli_query($this->dblink,$q);
		self::clearReinforcementsCache();
	}

	function updateResource($vid, $what, $number) {
	    $vid = (int) $vid;

	    if (!is_array($what)) {
	        $what = [$what];
	        $number = [$number];
        }

        $pairs = [];
        foreach ($what as $index => $whatValue) {
            $pairs[] = $this->escape($whatValue) . ' = ' . (Math::isInt($number[$index]) ? $number[$index] : '"'.$this->escape($number[$index]).'"');
        }

		$q = "UPDATE " . TB_PREFIX . "vdata SET ".implode(', ', $pairs)." WHERE wref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_query($this->dblink,$q);
	}

	// no need to cache this method
	public function hasBeginnerProtection($vid) {
        list($vid) = $this->escape_input($vid);

        $q = "SELECT u.protect FROM ".TB_PREFIX."users u,".TB_PREFIX."vdata v WHERE u.id=v.owner AND v.wref=".(int) $vid." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if(!empty($dbarray)) {
			if(time()<$dbarray[0]) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function updateUserField($ref, $field, $value, $switch) {
        list($ref) = $this->escape_input($ref);

        if (!is_array($field)) {
            $field = [$field];
            $value = [$value];
        }

        $pairs = [];
        foreach ($field as $index => $fieldName) {
            $pairs[] = $this->escape($fieldName) . ' = ' . (Math::isInt($value[$index]) ? $value[$index] : '"'.$this->escape($value[$index]).'"');
        }

		if(!$switch) {
			$q = "UPDATE " . TB_PREFIX . "users SET ".implode(', ', $pairs)." where username = '$ref'";
		} else {
		    $q = "UPDATE " . TB_PREFIX . "users SET ".implode(', ', $pairs)." where id = " . (int) $ref;
		}

		// update cached values
		if ($ret = mysqli_query($this->dblink,$q)) {
            foreach ($field as $index => $fieldName) {
                if (isset(self::$fieldsCache[$ref.($switch ? 0 : 1)][$fieldName]))
                self::$fieldsCache[$ref.($switch ? 0 : 1)][$fieldName] = $value[$index];
            }
        }

        return $ret;
	}

	// no n eed to cache this method
	function getSitee($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id from " . TB_PREFIX . "users where sit1 = $uid or sit2 = $uid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	// no need to cache this method
	function getVilWref($x, $y) {
	    list($x, $y) = $this->escape_input((int) $x, (int) $y);

		$q = "SELECT id FROM " . TB_PREFIX . "wdata where x = $x AND y = $y LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['id'];
	}

	function removeMeSit($uid, $uid2) {
	    list($uid, $uid2) = $this->escape_input((int) $uid, (int) $uid2);

		$q = "UPDATE " . TB_PREFIX . "users set sit1 = 0 where id = $uid and sit1 = $uid2";
		mysqli_query($this->dblink,$q);
		$q2 = "UPDATE " . TB_PREFIX . "users set sit2 = 0 where id = $uid and sit2 = $uid2";
		mysqli_query($this->dblink,$q2);
	}

    function getUserField($ref, $field, $mode, $use_cache = true) {
        // update for Multihunter's username and ID
        if (($mode && $ref == '') || (!$mode && $ref == 0)) {
            $ref = 'Multihunter';
            $mode = 1;
        }

        // return all data, don't waste time by selecting fields one by one
        $userArray = $this->getUserArray($ref, ($mode ? 0 : 1), $use_cache);
        $result = (isset($userArray[$field]) ? $userArray[$field] : null);

        if ($result) {
            // will return the result
        } elseif($field=="username") {
            $result = "??";
        } else {
            $result = 0;
        }

        return $result;

        /*list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$fieldsCache, $ref.$mode)) && !is_null($cachedValue)) {
            // check if we have the requested field type cached
            if (isset($cachedValue[$field])) {
                return $cachedValue[$field];
            }
        }

        // update for Multihunter's username and ID
        if (($mode && $ref == '') || (!$mode && $ref == 0)) {
            $ref = 'Multihunter';
            $mode = 1;
        }

        if(!$mode) {
            $q = "SELECT $field FROM " . TB_PREFIX . "users where id = " . (int) $ref;
        } else {
            $q = "SELECT $field FROM " . TB_PREFIX . "users where username = '$ref'";
        }

        $result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));

        if ($result) {
            $dbarray = mysqli_fetch_array($result);
            self::$fieldsCache[$ref.$mode][$field] = $dbarray[$field];
        } elseif($field=="username") {
            self::$fieldsCache[$ref.$mode][$field] = "??";
        } else {
            self::$fieldsCache[$ref.$mode][$field] = 0;
        }

        return self::$fieldsCache[$ref.$mode][$field];*/
    }

    function getUserFields($ref, $fields, $mode, $use_cache = true) {
        // update for Multihunter's username and ID
        if (($mode && $ref == '') || (!$mode && $ref == 0)) {
            $ref = 'Multihunter';
            $mode = 1;
        }

	    // return all data, don't waste time by selecting fields one by one
	    return $this->getUserArray($ref, ($mode ? 0 : 1), $use_cache);

        /*list($ref, $fields, $mode) = $this->escape_input($ref, $fields, $mode);

        // update for Multihunter's username and ID
        if (($mode && $ref == '') || (!$mode && $ref == 0)) {
            $ref = 'Multihunter';
            $mode = 1;
        }

        // check fields one by one to see which ones we can return cached
        if ($use_cache) {
            $allFieldsFound = false;
            $fieldsLeft = [];
            $fieldValues = [];

            // split fields
            $fields = explode(',', str_replace(', ', ',', $fields));

            // iterate over all the fields and see what we have cached
            foreach ($fields as $fieldName) {
                if (($cached = self::returnCachedContent(self::$fieldsCache, $ref.$mode)) && !is_null($cached) && isset($cached[$fieldName])) {
                    $fieldValues[$fieldName] = $cached[$fieldName];
                } else {
                    $fieldsLeft[] = $fieldName;
                }
            }

            // check if we should return here (if we have all the values) or continue with the rest below
            if (!count($fieldsLeft)) {
                return $fieldValues;
            }
        }

        if(!$mode) {
            $q = "SELECT ".implode(', ', $fieldsLeft)." FROM " . TB_PREFIX . "users where id = " . (int) $ref;
        } else {
            $q = "SELECT ".implode(', ', $fieldsLeft)." FROM " . TB_PREFIX . "users where username = '$ref'";
        }

        $result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
        if($result) {
            $ret = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else {
            $ret = [0];
        }

        // cache results and return everything that we have
        foreach ($ret as $fieldName => $fieldValue) {
            $fieldValues[$fieldName] = $fieldValue;
            self::$fieldsCache[$ref.$mode][$fieldName] = $fieldValue;
        }

        return $fieldValues;*/
    }

    // no need to cache this method
	function getInvitedUser($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "users where invited = $uid order by regtime desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getVrefField($ref, $field, $use_cache = true) {
        return $this->getVillage($ref, 0, $use_cache)[$field];
	}

    // no need to cache this method
	function getVrefCapital($ref) {
	    $vdata = $this->getProfileVillages($ref);

	    foreach ($vdata as $village) {
	        if ($village['capital']) {
	            return $village;
            }
        }

        return false;
	}

    // no need to cache this method
	function getStarvation() {
        return $this->getProfileVillages(0, 2);
	}

    // no need to cache this method
	function getActivateField($ref, $field, $mode) {
        list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);

		if(!$mode) {
		    $q = "SELECT $field FROM " . TB_PREFIX . "activate where id = " . (int) $ref . " LIMIT 1";
		} else {
			$q = "SELECT $field FROM " . TB_PREFIX . "activate where username = '$ref' LIMIT 1";
		}
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function login($username, $password) {
        static $cachedResult = null;

        if ($cachedResult !== null) {
            return $cachedResult;
        }

        list($username, $password) = $this->escape_input($username, $password);
		$q = "SELECT id,password,sessid,is_bcrypt FROM " . TB_PREFIX . "users where username = '$username'";
		$result = mysqli_query($this->dblink,$q);

		// if we didn't update the database for bcrypt hashes yet...
		if (mysqli_error($this->dblink) != '') {
		    $q = "SELECT id, password,sessid,0 as is_bcrypt FROM " . TB_PREFIX . "users where username = '$username' LIMIT 1";
		    $result = mysqli_query($this->dblink,$q);
		    $bcrypt_update_done = false;
		} else {
		    $bcrypt_update_done = true;
		}

		$dbarray = mysqli_fetch_array($result);

		// even if we didn't do a DB conversion for bcrypt passwords,
		// we still need to check if this password wasn't encrypted via password_hash,
		// since all methods were updated to use that instead of md5 and therefore
		// new passwords in DB will be bcrypt already even without the is_bcrypt field present
		$bcrypted = true;
		$pwOk = password_verify($password, $dbarray['password']);

		if (!$pwOk && !$dbarray['is_bcrypt']) {
		    $pwOk = ($dbarray['password'] == md5($password));
		    $bcrypted = false;
		}

		if($pwOk) {
		    // update password to bcrypt, if correct
		    if (!$dbarray['is_bcrypt'] && !$bcrypted) {
		        mysqli_query($this->dblink, "UPDATE " . TB_PREFIX . "users SET password = '".password_hash($password, PASSWORD_BCRYPT,['cost' => 12])."'".($bcrypt_update_done ? ', is_bcrypt = 1' : '')." where id = ".(int) $dbarray['id']);
		    }
            $cachedResult = true;
		} else {
            $cachedResult = false;
		}

		return $cachedResult;
	}

	function sitterLogin($username, $password) {
        list($username, $password) = $this->escape_input($username, $password);

		$q = "SELECT sit1,sit2 FROM " . TB_PREFIX . "users where username = '$username' and access != " . BANNED ." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['sit1'] != 0) {
		    $q2 = "SELECT password FROM " . TB_PREFIX . "users where id = " . (int) $dbarray['sit1'] . " and access != " . BANNED . " LIMIT 1";
			$result2 = mysqli_query($this->dblink,$q2);
			$dbarray2 = mysqli_fetch_array($result2);
		}
		if($dbarray['sit2'] != 0) {
		    $q3 = "SELECT password FROM " . TB_PREFIX . "users where id = " . (int) $dbarray['sit2'] . " and access != " . BANNED . " LIMIT 1";
				$result3 = mysqli_query($this->dblink,$q3);
				$dbarray3 = mysqli_fetch_array($result3);
		}
		if($dbarray['sit1'] != 0 || $dbarray['sit2'] != 0) {
		    if(password_verify($password, $dbarray2['password']) || password_verify($password, $dbarray3['password'])) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function setDeleting($uid, $mode) {
	    list($uid, $mode) = $this->escape_input((int) $uid, $mode);

		$time = time() + 72 * 3600;
		if(!$mode) {
			$q = "INSERT into " . TB_PREFIX . "deleting values ($uid,$time)";
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "deleting where uid = $uid";
		}
		mysqli_query($this->dblink,$q);
	}

	function isDeleting($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT timestamp from " . TB_PREFIX . "deleting where uid = $uid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['timestamp'];
	}

	function modifyGold($userid, $amt, $mode) {
	    list($userid, $amt, $mode) = $this->escape_input((int) $userid, (int) $amt, $mode);

		if(!$mode) {
			$q = "UPDATE " . TB_PREFIX . "users set gold = gold - $amt where id = $userid";
		} else {
			$q = "UPDATE " . TB_PREFIX . "users set gold = gold + $amt where id = $userid";
		}
		return mysqli_query($this->dblink,$q);
	}

	/*****************************************
	Function to retrieve user array via Username or ID
	Mode 0: Search by Username
	Mode 1: Search by ID
	References: Alliance ID
	*****************************************/

	function getUserArray($ref, $mode, $use_cache = true) {
        list($ref, $mode) = $this->escape_input($ref, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$fieldsCache, $ref.$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		if(!$mode) {
			$q = "SELECT * FROM " . TB_PREFIX . "users where username = '$ref' LIMIT 1";
		} else {
		    $q = "SELECT * FROM " . TB_PREFIX . "users where id = " . (int) $ref . " LIMIT 1";
		}
		$result = mysqli_query($this->dblink,$q);

        self::$fieldsCache[$ref.$mode] = mysqli_fetch_array($result);
        return self::$fieldsCache[$ref.$mode];
	}

	function activeModify($username, $mode) {
        list($username, $mode) = $this->escape_input($username, $mode);

		$time = time();
		if(!$mode) {
			$q = "INSERT into " . TB_PREFIX . "active VALUES ('$username',$time)";
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "active where username = '$username'";
		}
		return mysqli_query($this->dblink,$q);
	}

	function addActiveUser($username, $time) {
        list($username, $time) = $this->escape_input($username, $time);

		$q = "REPLACE into " . TB_PREFIX . "active values ('$username',$time)";
		if(mysqli_query($this->dblink,$q)) {
			return true;
		} else {
			return false;
		}
	}

	function updateActiveUser($username, $time) {
	    static $updated = false;

	    if ($updated) {
	        return;
        }

        list($username, $time) = $this->escape_input($username, $time);

        $res1 = $this->addActiveUser($username, $time);
        $q = "UPDATE " . TB_PREFIX . "users set timestamp = $time where username = '$username'";
		$res2 = mysqli_query($this->dblink,$q);
		if($res1 && $res2) {
            $updated = true;
			return true;
		} else {
			return false;
		}
	}

	function submitProfile($uid, $gender, $location, $birthday, $des1, $des2) {
	    // temporarily replace newlines with placeholders, so they don't get escaped and backslashed stripped out of them
	    $des1 = str_replace(['\\r', '\\n'], ['[!RETURN_CARRIAGE!]','[!NEW_LINE!]'], $des1);
	    $des2 = str_replace(['\\r', '\\n'], ['[!RETURN_CARRIAGE!]','[!NEW_LINE!]'], $des2);

	    list($uid, $gender, $location, $birthday, $des1, $des2) = $this->escape_input((int) $uid, (int) $gender, $location, $birthday, $des1, $des2);

	    // return new lines and return carriages to descriptions
	    $des1 = str_replace(['[!RETURN_CARRIAGE!]','[!NEW_LINE!]'], ['\\r', '\\n'], $des1);
	    $des2 = str_replace(['[!RETURN_CARRIAGE!]','[!NEW_LINE!]'], ['\\r', '\\n'], $des2);

		$q = "UPDATE " . TB_PREFIX . "users set gender = $gender, location = '$location', birthday = '$birthday', desc1 = '$des1', desc2 = '$des2' where id = $uid";
		return mysqli_query($this->dblink,$q);
	}

	function gpack($uid, $gpack) {
	    list($uid, $gpack) = $this->escape_input((int) $uid, $gpack);

		$q = "UPDATE " . TB_PREFIX . "users set gpack = '$gpack' where id = $uid";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function GetOnline($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT sit FROM " . TB_PREFIX . "online WHERE uid = $uid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['sit'];
	}

	function UpdateOnline($mode, $name = "", $time = "", $uid = 0) {
	    list($mode, $name, $time, $uid) = $this->escape_input($mode, $name, $time, (int) $uid);

		global $session;
		if($mode == "login") {
			$q = "INSERT IGNORE INTO " . TB_PREFIX . "online (name, uid, time, sit) VALUES ('$name', $uid, '" . time() . "', 0)";
			return mysqli_query($this->dblink,$q);
		} else if($mode == "sitter") {
			$q = "INSERT IGNORE INTO " . TB_PREFIX . "online (name, uid, time, sit) VALUES ('$name', $uid, '" . time() . "', 1)";
			return mysqli_query($this->dblink,$q);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "online WHERE name ='" . $this->escape($session->username) . "'";
			return mysqli_query($this->dblink,$q);
		}
	}

	// if $respect_gametime is false, we generate user base really anywhere
	// and that means we can generate farms closer to the middle of the map as well
	// ... otherwise we'd only generate farms at corner edges in late game, which
	//     sucks for people in the middle who registered too soon
	function generateBase($sector, $mode=1, $respect_gametime = true) {
        list($sector, $mode) = $this->escape_input($sector, $mode);

        // don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
        @set_time_limit(0);
        $num_rows = 0;
        $count_while = 0;

        // random position on the map - used when generating farms via Admin
        if (!$respect_gametime) {
           $rand = rand(1,4);
        }

        while (!$num_rows) {
            if (!$mode) {
                $gamesday = time() - COMMENCE;
                // TODO: scale these with game speed?
                if ((!$respect_gametime && $rand === 1) || ($respect_gametime && $gamesday<3600*24*10 && $count_while==0)) { //10 day
                    $wide1=1;
                    $wide2=20;
                } elseif ((!$respect_gametime && $rand === 2) || ($respect_gametime && $gamesday<3600*24*20 && $count_while==1)) { //20 day
                    $wide1=20;
                    $wide2=40;
                } elseif ((!$respect_gametime && $rand === 3) || ($respect_gametime && $gamesday<3600*24*30 && $count_while==2)) { //30 day
                    $wide1=40;
                    $wide2=80;
                } else {        // over 30 day
                    $wide1=80;
                    $wide2=WORLD_MAX;
                }
            }
            else {
                $wide1=1;
                $wide2=WORLD_MAX;
            }

            switch($sector) {
            case 1:
                $q = "Select * from ".TB_PREFIX."wdata where fieldtype = 3 and (x < -$wide1 and x > -$wide2) and (y > $wide1 and y < $wide2) and occupied = 0"; //x- y+
                break;
            case 2:
                $q = "Select * from ".TB_PREFIX."wdata where fieldtype = 3 and (x > $wide1 and x < $wide2) and (y > $wide1 and y < $wide2) and occupied = 0"; //x+ y+
                break;
            case 3:
                $q = "Select * from ".TB_PREFIX."wdata where fieldtype = 3 and (x < -$wide1 and x > -$wide2) and (y < -$wide1 and y > -$wide2) and occupied = 0"; //x- y-
                break;
            default:
                $q = "Select * from ".TB_PREFIX."wdata where fieldtype = 3 and (x > $wide1 and x < $wide2) and (y < -$wide1 and y > -$wide2) and occupied = 0"; //x+ y-
            }
            $result = mysqli_query($this->dblink,$q);
            $num_rows = mysqli_num_rows($result);
            $count_while++;
        }

        $result = $this->mysqli_fetch_all($result);
        $base = rand(0, ($num_rows-1));

        return $result[$base]['id'];
    }

	function setFieldTaken($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $idValue) {
            $id[$index] = (int) $idValue;
        }

		$q = "UPDATE " . TB_PREFIX . "wdata SET occupied = 1 WHERE id IN(". implode(', ', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function addVillage($wid, $uid, $username, $capital) {
	    list($wid, $uid, $username, $capital) = $this->escape_input((int) $wid, (int) $uid, $username, (int) $capital);

		$total = count($this->getVillagesID($uid));
		if($total >= 1) {
			$vname = $username . "\'s village " . ($total + 1);
		} else {
			$vname = $username . "\'s village";
		}
		$time = time();
		$q = "INSERT into " . TB_PREFIX . "vdata (wref, owner, name, capital, pop, cp, celebration, wood, clay, iron, maxstore, crop, maxcrop, lastupdate, created) values ($wid, $uid, '$vname', $capital, 2, 1, 0, 750, 750, 750, ".STORAGE_BASE.", 750, ".STORAGE_BASE.", $time, $time)";
		return mysqli_query($this->dblink,$q);
	}

	function addResourceFields($vid, $type) {
	    list($vid, $type) = $this->escape_input((int) $vid, $type);

		switch($type) {
			case 1:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 2:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 3:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 4:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 5:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,3,1,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 6:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,4,4,1,3,4,4,4,4,4,4,4,4,4,4,4,2,4,4,1,15)";
				break;
			case 7:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 8:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 9:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,4,1,1,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 10:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			case 11:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,3,1,1,3,1,4,4,3,3,2,2,3,1,4,4,2,4,4,1,15)";
				break;
			case 12:
				$q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,1,4,1,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
				break;
			default: $q = "INSERT into " . TB_PREFIX . "fdata (vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t,f26,f26t) values($vid,4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2,1,15)";
		}
		return mysqli_query($this->dblink,$q);
	}

    function isVillageOases($wref, $use_cache = true) {
        // retirieve form cache
        return $this->getVillageByWorldID($wref, $use_cache)['oasistype'];
    }

	public function VillageOasisCount($vref, $use_cache = true) {
	    list($vref) = $this->escape_input((int) $vref);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisCountCache, $vref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(*) FROM `".TB_PREFIX."odata` WHERE conqured=". $vref;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

        self::$oasisCountCache[$vref] = $row[0];
        return self::$oasisCountCache[$vref];
	}

	public function countOasisTroops($vref, $use_cache = true) {
	    list($vref) = $this->escape_input((int) $vref);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisTroopsCountCache, $vref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		//count oasis troops: $troops_o
        $troops_o = 0;
        $o_unit   = $this->getUnit($vref, $use_cache);

        for ( $i = 1; $i < 51; $i ++ ) {
            $troops_o += $o_unit[ 'u'.$i ];
        }

        $troops_o += $o_unit['hero'];
        $o_unit2 = $this->getEnforceVillage($vref, 0, $use_cache);

        foreach ($o_unit2 as $o_unit) {
            for ( $i = 1; $i < 51; $i ++ ) {
                $troops_o += $o_unit[ 'u'.$i ];
            }

            $troops_o += $o_unit['hero'];
        }

        self::$oasisTroopsCountCache[$vref] = $troops_o;
            return self::$oasisTroopsCountCache[$vref];
	}

    public function canConquerOasis($vref, $wref, $use_cache = true) {
        list($vref,$wref) = $this->escape_input($vref,$wref);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisConquerableCache, $vref.$wref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $AttackerFields = $this->getResourceLevel( $vref, $use_cache );
        for ( $i = 19; $i <= 38; $i ++ ) {
            if ( $AttackerFields[ 'f' . $i . 't' ] == 37 ) {
                $HeroMansionLevel = $AttackerFields[ 'f' . $i ];
            }
        }
        if ( $this->VillageOasisCount( $vref ) < floor( ( $HeroMansionLevel - 5 ) / 5 ) ) {
            $OasisInfo = $this->getOasisInfo( $wref );
            //fix by ronix
            if (
                $OasisInfo['conqured'] == 0 ||
                $OasisInfo['conqured'] != 0 &&
                intval( $OasisInfo['loyalty'] ) < ( 99 / min(3, (4 - $this->VillageOasisCount($OasisInfo['conqured'], $use_cache))) )
            ) {
                $CoordsVillage = $this->getCoor( $vref );
                $CoordsOasis   = $this->getCoor( $wref );
                $max           = 2 * WORLD_MAX + 1;
                $x1            = intval( $CoordsOasis['x'] );
                $y1            = intval( $CoordsOasis['y'] );
                $x2            = intval( $CoordsVillage['x'] );
                $y2            = intval( $CoordsVillage['y'] );
                $distanceX     = min( abs( $x2 - $x1 ), abs( $max - abs( $x2 - $x1 ) ) );
                $distanceY     = min( abs( $y2 - $y1 ), abs( $max - abs( $y2 - $y1 ) ) );

                if ( $distanceX <= 3 && $distanceY <= 3 ) {
                    self::$oasisConquerableCache[ $vref . $wref ] = 1; //can
                } else {
                    self::$oasisConquerableCache[ $vref . $wref ] = 2; //can but not in 7x7 field
                }

            } else {
                self::$oasisConquerableCache[ $vref . $wref ] = 3; //loyalty >0
            }

        } else {
            self::$oasisConquerableCache[ $vref . $wref ] = 0; //req level hero mansion
        }

        return self::$oasisConquerableCache[ $vref . $wref ];
    }

	public function conquerOasis($vref,$wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$vinfo = $this->getVillage($vref);
		$uid = (int) $vinfo['owner'];
		$q = "UPDATE `".TB_PREFIX."odata` SET conqured=".(int) $vref. ",loyalty=100,lastupdated=".time().",owner=$uid,name='Occupied Oasis' WHERE wref=".$wref;
		return mysqli_query($this->dblink,$q);
	}

    public function modifyOasisLoyalty($wref) {
        list($wref) = $this->escape_input((int) $wref);

        if($this->isVillageOases($wref) != 0) {
            $OasisInfo = $this->getOasisInfo($wref);
            if($OasisInfo['conqured'] != 0) {
                $LoyaltyAmendment = floor(100 / min(3,(4-$this->VillageOasisCount($OasisInfo['conqured']))));
                $q = "UPDATE `".TB_PREFIX."odata` SET loyalty=loyalty-$LoyaltyAmendment, lastupdated=".time()." WHERE wref=".$wref;
                $result=mysqli_query($this->dblink,$q);
                return $OasisInfo['loyalty']-$LoyaltyAmendment;
            }
        }
    }

	function regenerateOasisUnits($wid, $automation = false) {
	    global $autoprefix;

	    if (is_array($wid)) {
	        $wid = '(' . implode('),(', $wid) . ')';
	    } else {
	        $wid = '(' . (int) $wid . ')';
	    }

	    // load the oasis regeneration (in-game) and units generation (during install) SQL file
	    // and replace village IDs for the given $wid
	    $str = file_get_contents($autoprefix."var/db/datagen-oasis-troops-regen.sql");
	    $str = preg_replace(["'%PREFIX%'", "'%VILLAGEID%'", "'%NATURE_REG_TIME%'"], [TB_PREFIX, $wid, ($automation ? NATURE_REGTIME : -1)], $str);
	    $result = $this->dblink->multi_query($str);

	    // fetch results of the multi-query in order to allow subsequent query() and multi_query() calls to work
	    while (mysqli_more_results($this->dblink) && mysqli_next_result($this->dblink)) {;}

	    if (!$result) {
	        return false;
	    }

	    return true;
	}

	function removeOases($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "UPDATE ".TB_PREFIX."odata SET conqured = 0, owner = 2, name = 'Unoccupied Oasis' WHERE wref = ".$wref;
		return mysqli_query($this->dblink,$q);
	}


	/***************************
	Function to retrieve type of village via ID
	References: Village ID
	***************************/
	function getVillageType($wref, $use_cache = true) {
        // retrieve this value from the full village data cache
        return $this->getVillageByWorldID($wref, $use_cache)['fieldtype'];
	}



	/*****************************************
	Function to retrieve if is ocuped via ID
	References: Village ID
	*****************************************/
	function getVillageState($wref, $use_cache = true) {
        // retrieve this value from the full village data cache
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageFieldsCacheByWorldID, $wref)) && !is_null($cachedValue)) {
            return ($cachedValue['occupied'] != 0 || $cachedValue['oasistype'] != 0);
        } else {
            $vil = $this->getVillageByWorldID($wref, $use_cache);
            return ($vil['occupied'] != 0 || $vil['oasistype'] != 0);
        }
	}

	// no need to refactor this method
	function getProfileMedal($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id,categorie,plaats,week,img,points from " . TB_PREFIX . "medal where userid = $uid and del = 0 order by id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);

	}

    // no need to refactor this method
	function getProfileMedalAlly($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id,categorie,plaats,week,img,points from " . TB_PREFIX . "allimedal where allyid = $uid and del = 0 order by id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);

	}

	function getVillageID($uid, $use_cache = true) {
	    // load cached value
	    return $this->getVillagesID($uid, $use_cache)[0];
	}

	function getVillagesID($uid, $use_cache = true) {
	    list($uid) = $this->escape_input((int) $uid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageIDsCache, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $array = $this->getProfileVillages($uid, 0, $use_cache);
		$newarray = array();

		for($i = 0; $i < count($array); $i++) {
			array_push($newarray, $array[$i]['wref']);
		}

		self::$villageIDsCache[$uid] = $newarray;
		return self::$villageIDsCache[$uid];
	}

	function getVillagesID2($uid, $use_cache = true) {
	    list($uid) = $this->escape_input((int) $uid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageIDsCacheSimple, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $array = $this->getProfileVillages($uid, 0, $use_cache);
        self::$villageIDsCacheSimple[$uid] = $array;

        return self::$villageIDsCacheSimple[$uid];
	}

	function findAlreadyCachedVillageData($vid, $mode) {
        // check if we don't actually have this data cached already in one of the other modes
        for ($i = 0; $i <= 4; $i++) {
            if ($mode !== $i && isset(self::$villageFieldsCache[$vid.$i])) {
                // loop through cached values
                foreach (self::$villageFieldsCache[$vid.$i] as $index => $value) {
                    // check for existing record with our requested ID/name/owner...
                    switch ($mode) {
                        case 0: if ($value['wref'] == $vid) {
                                    return $value;
                                }
                                break;

                        case 1: if ($value['name'] == $vid) {
                                    return $value;
                                }
                                break;

                        case 2: if ($value['owner'] == $vid) {
                                    return $value;
                                }
                                break;

                        case 3: if ((isset($value['owner']) && isset($value['capital'])) && $value['owner'] == $vid && $value['capital'] == 1) {
                                    return $value;
                                }
                                break;

                        case 4: if ($value['owner'] == 4) {
                                    return $value;
                                }
                                break;
                    }
                }
            }
        }

        return false;
    }

	function getVillage($vid, $mode = 0, $use_cache = true) {
	    // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageFieldsCache, ((int) $vid).$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if ($use_cache && ($altCachedContentSearch = $this->findAlreadyCachedVillageData($vid, $mode))) {
            return $altCachedContentSearch;
        }

        switch ($mode) {
            // by WREF
            case 0: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE wref = $vid LIMIT 1";
                    break;

            // by name
            case 1: $name = $this->escape($vid);
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE `name` = '$name' LIMIT 1";
                    break;

            // by owner ID
            case 2: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $vid LIMIT 1";
                    break;

            // by owner ID and capital = 1
            case 3: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $vid AND capital = 1 LIMIT 1";
                    break;

            // by owner = Taskmaster
            case 4: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = 4 LIMIT 1";
                    break;
        }

		$result = mysqli_query($this->dblink,$q);

        self::$villageFieldsCache[$vid.$mode] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return self::$villageFieldsCache[$vid.$mode];
	}

    function getProfileVillages($uid, $mode = 0, $use_cache = true) {
        $arrayPassed = is_array($uid);

        if (!$arrayPassed) {
            $uid = [(int) $uid];
        } else {
            foreach ($uid as $index => $uidValue) {
                $uid[$index] = (int) $uidValue;
            }
        }

        if (!count($uid)) {
            return [];
        }

        // first of all, check if we should be using cache
        if ($use_cache && !$arrayPassed && ($cachedValue = self::returnCachedContent(self::$userVillagesCache, $uid[0].$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        // if we've given a number of villages to preload, remove those that already are
        if ($use_cache && $arrayPassed) {
            $newIDs = [];
            foreach ($uid as $id) {
                if (!isset(self::$userVillagesCache[$id.$mode])) {
                    $newIDs[] = $id;
                }
            }
            $uid = $newIDs;
        }

        // nothing left to cache, return the full cache
        if (!count($uid)) {
            return self::$userVillagesCache;
        }

        switch ($mode) {
            // by owner ID
            case 0: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner IN(".implode(', ', $uid).") ORDER BY capital DESC,pop DESC";
                    break;

            // villages where owner is a real player (i.e. not Natars etc.)
            case 1: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE capital = 1 and owner > 5";
                    break;

            // villages with starvation data
            case 2: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE starv != 0 and owner != 3";
                    break;

            // field distance calculator query
            case 3: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner > 4 and wref != ".$uid[0];
                    break;

            // villages in need of celebration data update
            case 4: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE celebration < ".$uid[0]." AND celebration != 0";
                    break;

            // by vref ID
            case 5: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE wref IN(".implode(', ', $uid).")";
                    break;

            // by loyalty updates required
            case 6: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE loyalty < 100";
                    break;
        }

        $result = mysqli_query($this->dblink,$q);

        if (!$arrayPassed) {
            $result                             = $this->mysqli_fetch_all($result);
            self::$userVillagesCache[ $uid[0].$mode ] = $result;

            // cache each village individually into the fields cache as well
            foreach ($result as $v) {
                $amode = 0;
                self::$villageFieldsCache[((int) $v['wref']).$amode] = $v;
            }
        } else {
            // we're preloading, cache all the data individually
            if (mysqli_num_rows($result)) {
                $amode = 0;
                while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
                    if ( ! isset( self::$userVillagesCache[ $row['owner'].$mode ] ) ) {
                        self::$userVillagesCache[ $row['owner'].$mode ] = [];
                    }

                    self::$userVillagesCache[ $row['owner'].$mode ][] = $row;
                    self::$villageFieldsCache[((int) $row['wref']).$amode] = $row;
                }

                // just return the full cache if we've given an array of IDs to load villages for
                $result = self::$userVillagesCache;
            }
        }

        return $result;
    }

    function cacheVillageByWorldIDs($uid, $mode = 0) {
	    if (!is_array($uid)) {
	        $uid = [(int) $uid];
        } else {
	        foreach ($uid as $index => $uidValue) {
	            $uid[$index] = (int) $uidValue;
            }
        }

        $result = mysqli_query($this->dblink, "
          SELECT
            *
          FROM
            " . TB_PREFIX . "wdata as wdata
            LEFT JOIN " . TB_PREFIX . "vdata as vdata ON wdata.id = vdata.wref
          WHERE vdata.owner IN(".implode('', $uid).")"
        );

	    if (mysqli_num_rows($result)) {
	        $result = $this->mysqli_fetch_all($result);

	        $amode = 0;
	        foreach ($result as $row) {
                self::$villageFieldsCacheByWorldID[$row['id']] = $row;

                // cache village fields by wref as well, for future use
                if (!isset(self::$villageFieldsCache[((int) $row['wref']).$amode])) {
                    self::$villageFieldsCache[ ( (int) $row['wref'] ) . $amode ] = $row;
                }
            }
        }
    }

    function getVillageByWorldID($vid, $use_cache = true) {
        $array_passed = is_array($vid);

        if (!$array_passed) {
            $vid = [(int) $vid];
        } else {
            foreach ($vid as $index => $ivdValue) {
                $vid[$index] = (int) $ivdValue;
            }
        }

        if (!count($vid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$villageFieldsCacheByWorldID[$vid[0]]) && is_array(self::$villageFieldsCacheByWorldID[$vid[0]]) && !count(self::$villageFieldsCacheByWorldID[$vid[0]])) {
            return self::$villageFieldsCacheByWorldID[$vid[0]];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newVIDs = [];
            foreach ($vid as $key) {
                if (!isset(self::$villageFieldsCacheByWorldID[$key])) {
                    $newVIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newVIDs)) {
                return self::$villageFieldsCacheByWorldID;
            } else {
                // update remaining IDs to select and cache
                $vid = $newVIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$villageFieldsCacheByWorldID, $vid[0])) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $q = "SELECT * FROM " . TB_PREFIX . "wdata where id IN(".implode(', ', $vid).")";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$villageFieldsCacheByWorldID[$vid[0]] = $result[0];
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$villageFieldsCacheByWorldID[$record['id']] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($vid as $key) {
                if (!isset(self::$villageFieldsCacheByWorldID[$key])) {
                    self::$villageFieldsCacheByWorldID[$key] = [];
                }
            }
        }

        return ($array_passed ? self::$villageFieldsCacheByWorldID : self::$villageFieldsCacheByWorldID[$vid[0]]);
    }

	public function getVillageBattleData($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageBattleDataCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT u.id,u.tribe,v.capital,f.f40 AS wall FROM ".TB_PREFIX."users u,".TB_PREFIX."fdata f,".TB_PREFIX."vdata v WHERE u.id=v.owner AND f.vref=v.wref AND v.wref=".$vid." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$villageBattleDataCache[$vid] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return self::$villageBattleDataCache[$vid];
	}

	function getOasisV($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisFieldsCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "odata where wref = $vid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$oasisFieldsCache[$vid] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return self::$oasisFieldsCache[$vid];
	}

	function getMInfo($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$worldAndVillageDataCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "wdata left JOIN " . TB_PREFIX . "vdata ON " . TB_PREFIX . "vdata.wref = " . TB_PREFIX . "wdata.id where " . TB_PREFIX . "wdata.id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$worldAndVillageDataCache[$id] = mysqli_fetch_array($result);
        return self::$worldAndVillageDataCache[$id];
	}

	function getOMInfo($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$worldAndOasisDataCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "wdata left JOIN " . TB_PREFIX . "odata ON " . TB_PREFIX . "odata.wref = " . TB_PREFIX . "wdata.id where " . TB_PREFIX . "wdata.id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$worldAndOasisDataCache[$id] = mysqli_fetch_array($result);
        return self::$worldAndOasisDataCache[$id];
	}

	function getOasis($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisFieldsCacheByConqueredID, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "odata where conqured = $vid";
		$result = mysqli_query($this->dblink,$q);

        self::$oasisFieldsCacheByConqueredID[$vid] = $this->mysqli_fetch_all($result);
        return self::$oasisFieldsCacheByConqueredID[$vid];
	}

	function getOasisInfo($wid, $use_cache = true) {
	    return $this->getOasisV($wid, $use_cache);
	}

    function getVillageField($ref, $field, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        $villageArray = $this->getVillage($ref, 0, $use_cache);
        $result = (isset($villageArray[$field]) ? $villageArray[$field] : null);

        if($result){
            // will return the result
        }elseif($field=="name"){
            $result = "??";
        }else $result = 0;

        return $result;

        /*list($ref, $field) = $this->escape_input((int) $ref, $field);

        $q = "SELECT $field FROM " . TB_PREFIX . "vdata where wref = $ref";
        $result = mysqli_query($this->dblink,$q);
        if($result){
            $dbarray = mysqli_fetch_array($result);
            return $dbarray[$field];
         }elseif($field=="name"){
            return "??";
        }else return 0;*/
    }

    function getVillageFields($ref, $fields, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        return $this->getVillage($ref, 0, $use_cache);

        /*list($ref, $field) = $this->escape_input((int) $ref, $fields);

        $q = "SELECT $field FROM " . TB_PREFIX . "vdata where wref = $ref";
        $result = mysqli_query($this->dblink,$q);
        if($result) {
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else return 0;*/
    }

	function getOasisField($ref, $field, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        $oasisArray = $this->getOasisV($ref, $use_cache);
        return (isset($oasisArray[$field]) ? $oasisArray[$field] : null);

	    /*list($ref, $field) = $this->escape_input((int) $ref, $field);

		$q = "SELECT $field FROM " . TB_PREFIX . "odata where wref = $ref";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];*/
	}

    function getOasisFields($ref, $fields, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        return $this->getOasisV($ref, $use_cache);

        /*list($ref, $fields) = $this->escape_input((int) $ref, $fields);

        $q = "SELECT $fields FROM " . TB_PREFIX . "odata where wref = $ref";
        return mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);*/
    }

	function setVillageField($ref, $field, $value) {
	    if (!is_array($field)) {
	        $field = [$field];
	        $value = [$value];
        }

        $pairs = [];
	    foreach ($field as $index => $fieldValue) {
            $newValue = ((Math::isInt($value[$index]) || Math::isFloat($value[$index])) ? $value[$index] : '"'.$this->escape($value[$index]).'"');
	        $pairs[] = $this->escape($fieldValue).' = '.$newValue;

	        // update cache
	        if (isset(self::$villageFieldsCache[$ref])) {
                self::$villageFieldsCache[$ref][$fieldValue] = $newValue;
            }
        }

		$q = "UPDATE " . TB_PREFIX . "vdata SET ".implode(', ', $pairs)." WHERE wref = ".(int) $ref;
		return mysqli_query($this->dblink,$q);
	}

    function setVillageFields($ref, $fields, $values) {
        list($ref, $fields, $values) = $this->escape_input((int) $ref, $fields, $values);

        if (!count($fields)) {
            return;
        }

        // build the field-value query parts
        $fieldValues = [];
        foreach ($fields as $id => $fieldName) {
            $fieldValues[] = $this->escape($fieldName).' = '.((Math::isInt($values[$id]) || Math::isFloat($values[$id])) ? $values[$id] : '"'.$this->escape($values[$id]).'"');
        }

        $q = "UPDATE " . TB_PREFIX . "vdata set ".implode(', ', $fieldValues)." where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

	function setVillageLevel($ref, $fields, $values) {
	    list($ref, $fields, $values) = $this->escape_input((int) $ref, $fields, $values);

        // build the field-value query parts
        $fieldValues = [];

        if (!is_array($fields)) {
            $fields = [$fields];
            $values = [$values];
        }

        foreach ($fields as $id => $fieldName) {
            $fieldValues[] = $this->escape($fieldName).' = '.((Math::isInt($values[$id]) || Math::isFloat($values[$id])) ? $values[$id] : '"'.$this->escape($values[$id]).'"');
        }

		$q = "UPDATE " . TB_PREFIX . "fdata set ".implode(', ', $fieldValues)." where vref = " . $ref;
		return mysqli_query($this->dblink,$q);
	}

	function cacheResourceLevels($vids) {
        if (!is_array($vids)) {
            $vids = [$vids];
        }

        $newVids = [];
	    foreach ($vids as $index => $vidValue) {
            $vids[ $index ] = (int) $vidValue;

            // don't cache what's cached
	        if (!isset(self::$resourceLevelsCache[$vids[ $index ]])) {
                $newVids[] = $vids[ $index ];
            }
        }
        $vids = $newVids;

	    if (!count($vids)) {
	        return [];
        }

        $q = "SELECT * FROM " . TB_PREFIX . "fdata WHERE vref IN(".implode(', ', $vids).")";
        $result = mysqli_query($this->dblink,$q);

        foreach ( $this->mysqli_fetch_all( $result ) as $row ) {
            self::$resourceLevelsCache[ $row['vref'] ] = $row;
        }

        return self::$resourceLevelsCache;
    }

	function getResourceLevel($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$resourceLevelsCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * from " . TB_PREFIX . "fdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);

        self::$resourceLevelsCache[$vid] = mysqli_fetch_assoc($result);
        return self::$resourceLevelsCache[$vid];
	}

	public static function clearResourseLevelsCache() {
	    self::$resourceLevelsCache = [];
        self::$fieldLevelsInVillageSearchCache = [];
        self::$fieldLevelsCache = [];
    }

	function getAdminLog() {
		$q = "SELECT id,user,log,time from " . TB_PREFIX . "admin_log where id != 0 ORDER BY id DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	//fix market log
	function getMarketLog() {
        	$q = "SELECT id,wid,log from " . TB_PREFIX . "market_log where id != 0 ORDER BY id ASC";
        	$result = mysqli_query($this->dblink,$q);
        	return $this->mysqli_fetch_all($result);
	}

	function getMarketLogVillage($village) {
	    list($village) = $this->escape_input((int) $village);

		$q = "SELECT wref,owner,name from " . TB_PREFIX . "vdata where wref =$village ";
        	$result = mysqli_query($this->dblink,$q);
        	return $this->mysqli_fetch_all($result);
        }
	function getMarketLogUsers($id_user) {
	    list($id_user) = $this->escape_input((int) $id_user);

        	$q = "SELECT id,username from " . TB_PREFIX . "users where id = $id_user ";
        	$result = mysqli_query($this->dblink,$q);
        	return $this->mysqli_fetch_all($result);
        }
	//end fix

	function getCoor($wref, $use_cache = true) {
	    // retirieve form cache
        return $this->getVillageByWorldID($wref, $use_cache);
	}

    // no need to refactor this method
	function CheckForum($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "forum_cat where alliance = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if ($result['Total']) {
			return true;
		} else {
			return false;
		}
	}

    // no need to refactor this method
	function CountCat($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_topic where cat = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

    // no need to refactor this method
	function LastTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' order by post_date";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function CheckLastTopic($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$lastTopicCheckCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_topic where cat = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if($result['Total']) {
            self::$lastTopicCheckCache[$id] = true;
		} else {
            self::$lastTopicCheckCache[$id] = false;
		}

		return self::$lastTopicCheckCache[$id];
	}

	function CheckLastPost($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$lastPostForTopicCheckCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_post where topic = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if ($result['Total']) {
            self::$lastPostForTopicCheckCache[$id] = true;
		} else {
            self::$lastPostForTopicCheckCache[$id] = false;
		}

		return self::$lastPostForTopicCheckCache[$id];
	}

	function LastPost($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$lastPostForTopicCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);

        self::$lastPostForTopicCache[$id] = $this->mysqli_fetch_all($result);
        return self::$lastPostForTopicCache[$id];
	}

	function CountTopic($id, $use_cache = true) {
        list($id) = $this->escape_input($id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$topicCountCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_post where owner = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

		$qs = "SELECT count(id) FROM " . TB_PREFIX . "forum_topic where owner = '$id'";
		$results = mysqli_query($this->dblink,$qs);
		$rows = mysqli_fetch_row($results);

        self::$topicCountCache[$id] = $row[0] + $rows[0];
        return self::$topicCountCache[$id];
	}

	// no need to cache this method
	function CountPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

    // no need to cache this method
	function ForumCat($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where alliance = '$id' ORDER BY id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ForumCatEdit($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where id = '$id'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ForumCatAlliance($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT alliance from " . TB_PREFIX . "forum_cat where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['alliance'];
	}

    // no need to cache this method
	function ForumCatName($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT forum_name from " . TB_PREFIX . "forum_cat where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['forum_name'];
	}

    // no need to cache this method
	function CheckCatTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_topic where cat = $id";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if ($result['Total']) {
			return true;
		} else {
			return false;
		}
	}

    // no need to cache this method
	function CheckResultEdit($alli) {
        list($alli) = $this->escape_input($alli);

		$q = "SELECT Count(*) as Total from " . TB_PREFIX . "forum_edit where alliance = $alli";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if ($result['Total']) {
			return true;
		} else {
			return false;
		}
	}

    // no need to cache this method
	function CheckCloseTopic($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT close from " . TB_PREFIX . "forum_topic where id = '$id' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['close'];
	}

	function CheckEditRes($alli, $use_cache = true) {
        list($alli) = $this->escape_input($alli);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$editResultsCache, $alli)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT result from " . TB_PREFIX . "forum_edit where alliance = '$alli' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

        self::$editResultsCache[$alli] = $dbarray['result'];
        return self::$editResultsCache[$alli];
	}

	function CreatResultEdit($alli, $result) {
        list($alli, $result) = $this->escape_input($alli, $result);

		$q = "INSERT into " . TB_PREFIX . "forum_edit values (0,'$alli','$result')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	function UpdateResultEdit($alli, $result) {
        list($alli, $result) = $this->escape_input($alli, $result);

		$date = time();
		$q = "UPDATE " . TB_PREFIX . "forum_edit set result = '$result' where alliance = '$alli'";
		return mysqli_query($this->dblink,$q);
	}

	function getVillageType2($wref) {
        // retirieve form cache
        return $this->getVillageByWorldID($wref, $use_cache)['oasistype'];
	}

	// no need to cache this method
	function getFLData($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "farmlist where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	// no need to cache this method
	function checkVilExist($wref) {
	    list($wref) = $this->escape_input((int) $wref);

	    // first of all, check if this exists in our cache already - and if so, we don't need an extra query
        $mode = 0;
        if (isset(self::$villageFieldsCache[((int) $wref).$mode])) {
            return true;
        }

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "vdata where wref = '$wref'";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if ($result['Total']) {
			return true;
		} else {
			return false;
		}
	}

	// no need to cache this method
	function checkOasisExist($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "odata where wref = '$wref'";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if($result['Total']) {
			return true;
		} else {
			return false;
		}
	}

	function UpdateEditTopic($id, $title, $cat) {
	    list($id, $title, $cat) = $this->escape_input((int) $id, $title, $cat);

		$q = "UPDATE " . TB_PREFIX . "forum_topic set title = '$title', cat = '$cat' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function UpdateEditForum($id, $name, $des) {
	    list($id, $name, $des) = $this->escape_input((int) $id, $name, $des);

		$q = "UPDATE " . TB_PREFIX . "forum_cat set forum_name = '$name', forum_des = '$des' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function StickTopic($id, $mode) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

		$q = "UPDATE " . TB_PREFIX . "forum_topic set stick = '$mode' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function ForumCatTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' AND stick = '' ORDER BY post_date desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ForumCatTopicStick($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' AND stick = '1' ORDER BY post_date desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ShowTopic($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ShowPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id' ORDER BY id ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function ShowPostEdit($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function CreatForum($owner, $alli, $name, $des, $area) {
        list($owner, $alli, $name, $des, $area) = $this->escape_input($owner, $alli, $name, $des, $area);

		$q = "INSERT into " . TB_PREFIX . "forum_cat values (0,'$owner','$alli','$name','$des','$area')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

    function CreatTopic($title, $post, $cat, $owner, $alli, $ends, $alliance, $player, $coor, $report) {
        list($title, $post, $cat, $owner, $alli, $ends, $alliance, $player, $coor, $report) = $this->escape_input($title, $post, (int) $cat, (int) $owner, (int) $alli, (int) $ends, (int) $alliance, (int) $player, (int) $coor, (int) $report);

        $date = time();
        $q = "INSERT into " . TB_PREFIX . "forum_topic values (0,'$title','$post',$date, $date, $cat, $owner, $alli, $ends, 0, 0, $alliance, $player, $coor, $report)";
        mysqli_query($this->dblink,$q);
        return mysqli_insert_id($this->dblink);
    }

	/*************************
	        FORUM SUREY
	*************************/

  function createSurvey($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends) {
        list($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends) = $this->escape_input($topic, $title, $option1, $option2, $option3, $option4, $option5, $option6, $option7, $option8, $ends);

        $q = "INSERT into " . TB_PREFIX . "forum_survey (topic,title,option1,option2,option3,option4,option5,option6,option7,option8,ends) values ('$topic','$title','$option1','$option2','$option3','$option4','$option5','$option6','$option7','$option8','$ends')";
        return mysqli_query($this->dblink,$q);
  }

    // no need to cache this method
  function getSurvey($topic) {
      list($topic) = $this->escape_input((int) $topic);

    $q = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic LIMIT 1";
    $result = mysqli_query($this->dblink,$q);
    return mysqli_fetch_array($result);
  }

    // no need to cache this method
  function checkSurvey($topic) {
      list($topic) = $this->escape_input((int) $topic);

      $q      = "SELECT Count(*) as Total FROM " . TB_PREFIX . "forum_survey where topic = $topic";
      $result = mysqli_fetch_array( mysqli_query( $this->dblink, $q ), MYSQLI_ASSOC );

      if ( $result['Total'] ) {
          return true;
      } else {
          return false;
      }
  }

  function Vote($topic, $num, $text) {
      list($topic, $num, $text) = $this->escape_input((int) $topic, (int) $num, $text);

      $q = "UPDATE " . TB_PREFIX . "forum_survey set vote".$num." = vote".$num." + 1, voted = '$text' where topic = ".$topic."";
      return mysqli_query($this->dblink,$q);
  }

  // no need to cache this method
  function checkVote($topic, $uid) {
      list( $topic, $uid ) = $this->escape_input( (int) $topic, $uid );

      $q      = "SELECT voted FROM " . TB_PREFIX . "forum_survey where topic = $topic LIMIT 1";
      $result = mysqli_query( $this->dblink, $q );
      $array  = mysqli_fetch_array( $result );
      $text   = $array['voted'];

      if ( preg_match( '/,' . $uid . ',/', $text ) ) {
          return true;
      } else {
          return false;
      }
  }

    // no need to cache this method
  function getVoteSum($topic) {
      list( $topic ) = $this->escape_input( (int) $topic );

      $q      = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic LIMIT 1";
      $result = mysqli_query( $this->dblink, $q );
      $array  = mysqli_fetch_array( $result );
      $sum    = 0;

      for ( $i = 1; $i <= 8; $i ++ ) {
          $sum += $array[ 'vote' . $i ];
      }

      return $sum;
  }


	/*************************
	        FORUM SUREY
	*************************/

    function CreatPost($post, $tids, $owner, $alliance, $player, $coor, $report, $fid2 = 0) {
        global $message, $session;
        list($post, $tids, $owner, $alliance, $player, $coor, $report, $fid2) = $this->escape_input($post, (int) $tids, $owner, (int) $alliance, (int) $player, (int) $coor, (int) $report, (int) $fid2);

        $date = time();
        $q = "INSERT into " . TB_PREFIX . "forum_post values (0,'$post',$tids,'$owner','$date',$alliance,$player,$coor,$report)";
        mysqli_query($this->dblink,$q);
        $postID = mysqli_insert_id($this->dblink);

        // create a message notification for each person subscribed to this topic
        // ... for now it's everyone who ever posted there, there is no real un/subscription yet
        if ($fid2 !== 0) {
            $q = "SELECT DISTINCT owner FROM ".TB_PREFIX . "forum_post WHERE topic = $tids";
            $result = mysqli_query($this->dblink, $q);
            if ($result->num_rows) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['owner'] != $owner) {
                        $this->sendMessage(
                            (int) $row['owner'],
                            4,
                            'New Message in Alliance Forum',
                            "Hi!\n\n<a href=\"".rtrim(SERVER, '/')."/spieler.php?uid=".(int) $session->uid."\">".$this->escape($session->username)."</a> posted a new message into your common topic. Here\\'s a link that will get you there: <a href=\"".rtrim(SERVER, '/')."/allianz.php?s=2&amp;pid=2&amp;fid2=$fid2&amp;tid=$tids\">forum link</a>\n\nYours sincerely,\n<i>Server Robot :)</i>",
                            0,
                            0,
                            0,
                            0,
                            0,
                            true);
                    }
                }
            }
        }

        return $postID;
    }

	function UpdatePostDate($id) {
	    list($id) = $this->escape_input((int) $id);

		$date = time();
		$q = "UPDATE " . TB_PREFIX . "forum_topic set post_date = '$date' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function EditUpdateTopic($id, $post, $alliance, $player, $coor, $report) {
        list($id, $post, $alliance, $player, $coor, $report) = $this->escape_input((int) $id, $post, (int) $alliance, (int) $player, (int) $coor, (int) $report);

        $q = "UPDATE " . TB_PREFIX . "forum_topic set post = '$post', alliance0 = $alliance, player0 = $player, coor0 = $coor, report0 = $report where id = $id";
        return mysqli_query($this->dblink,$q);
    }

    function EditUpdatePost($id, $post, $alliance, $player, $coor, $report) {
        list($id, $post, $alliance, $player, $coor, $report) = $this->escape_input((int) $id, $post, (int) $alliance, (int) $player, (int) $coor, (int) $report);

       	$q = "UPDATE " . TB_PREFIX . "forum_post set post = '$post', alliance0 = $alliance, player0 = $player, coor0 = $coor, report0 = $report where id = $id";
        return mysqli_query($this->dblink,$q);
    }

	function LockTopic($id, $mode) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

		$q = "UPDATE " . TB_PREFIX . "forum_topic set close = '$mode' where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function DeleteCat($id) {
        list($id) = $this->escape_input($id);

        $qs = "DELETE from " . TB_PREFIX . "forum_cat where id = '$id'";
        $q = "DELETE from " . TB_PREFIX . "forum_topic where cat = '$id'";
        $q2="SELECT id from ".TB_PREFIX."forum_topic where cat ='$id'";
        $result = mysqli_query($this->dblink,$q2);
        if (!empty($result)) {
            $array=$this->mysqli_fetch_all($result);
            $toDelete = [];
            foreach($array as $ss) {
                $toDelete[] = $ss['id'];
            }
            $this->DeleteSurvey($toDelete);
        }
        mysqli_query($this->dblink,$qs);
        return mysqli_query($this->dblink,$q);
    }

	function DeleteSurvey($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $idValue) {
            $id[$index] = (int) $idValue;
        }

        $qs = "DELETE from " . TB_PREFIX . "forum_survey where topic IN(".implode(', ', $id).")";
        return mysqli_query($this->dblink,$qs);
    }

	function DeleteTopic($id) {
        list($id) = $this->escape_input($id);

		$qs = "DELETE from " . TB_PREFIX . "forum_topic where id = '$id'";
		//  $q = "DELETE from ".TB_PREFIX."forum_post where topic = '$id'";//
		return mysqli_query($this->dblink,$qs); //
		// mysqli_query($this->dblink,$q);
	}

	function DeletePost($id) {
        list($id) = $this->escape_input($id);

		$q = "DELETE from " . TB_PREFIX . "forum_post where id = '$id'";
		return mysqli_query($this->dblink,$q);
	}

	function getAllianceName($id, $use_cache = true) {
        // return from cache
        return $this->getAlliance($id, $use_cache)['tag'];
	}

	// no need to cache this method
	function getAlliancePermission($ref, $field, $mode) {
        list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);

		if(!$mode) {
		    $q = "SELECT $field FROM " . TB_PREFIX . "ali_permission where uid = ". (int) $ref . " LIMIT 1";
		} else {
			$q = "SELECT $field FROM " . TB_PREFIX . "ali_permission where username = '$ref' LIMIT 1";
		}
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function getAlliance($id, $use_cache = true) {
	    $id = (int) $id;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceDataCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * from " . TB_PREFIX . "alidata where id = $id";
		$result = mysqli_query($this->dblink,$q);

        self::$allianceDataCache[$id] = mysqli_fetch_assoc($result);
        return self::$allianceDataCache[$id];
	}

	function setAlliName($aid, $name, $tag) {
	    list($aid, $name, $tag) = $this->escape_input((int) $aid, $name, $tag);

		$q = "UPDATE " . TB_PREFIX . "alidata set name = '$name', tag = '$tag' where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function isAllianceOwner($id, $use_cache = true) {
	    $id = (int) $id;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceOwnerCheckCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT id from " . TB_PREFIX . "alidata where leader = ". $id;
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
		    $result = mysqli_fetch_assoc($result);
			$result = $result['id'];
		} else {
			$result = false;
		}

        self::$allianceOwnerCheckCache[$id] = $result;
        return self::$allianceOwnerCheckCache[$id];
	}

	function countAllianceMembers($aid, $use_cache = true) {
	    $aid = (int) $aid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceMembersCountCache, $aid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    $q = "SELECT Count(*) as Total from ".TB_PREFIX."users WHERE alliance = ".$aid;
	    $membersCount = $this->query_return($q);

        self::$allianceMembersCountCache[$aid] = $membersCount[0]['Total'];
        return self::$allianceMembersCountCache[$aid];
	}

    // no need to cache this method
	function aExist($ref, $type) {
        list($ref, $type) = $this->escape_input($ref, $type);

		$q = "SELECT $type FROM " . TB_PREFIX . "alidata where $type = '$ref'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function modifyPoints($aid, $points, $amt) {
	    $aid = (int) $aid;

	    if (!is_array($points)) {
	        $points = [$points];
	        $amt    = [$amt];
        }

        $updates = [];
        foreach ($points as $index => $value) {
            $value = $this->escape($value);
	        $updates[] = $value.' = ' . $value . ' + ' . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "users SET ".implode(', ', $updates)." WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyPointsAlly($aid, $points, $amt) {
        $aid = (int) $aid;

        if (!is_array($points)) {
            $points = [$points];
            $amt    = [$amt];
        }

        $updates = [];
        foreach ($points as $index => $value) {
            $value = $this->escape($value);
            $updates[] = $value.' = ' . $value . ' + ' . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "alidata SET ".implode(', ', $updates)." WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	/*****************************************
	Function to create an alliance
	References:
	*****************************************/
	function createAlliance($tag, $name, $uid, $max) {
	    list($tag, $name, $uid, $max) = $this->escape_input($tag, $name, (int) $uid, (int) $max);

	    $q = "INSERT into " . TB_PREFIX . "alidata values (0,'$name','$tag',$uid,0,0,0,'','',$max,0,0,0,0,0,0,0,0,0)";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	function procAllyPop($aid) {
        list($aid) = $this->escape_input($aid);

		$ally = $this->getAlliance($aid);
		$memberlist = $this->getAllMember($ally['id']);
		$oldrank = 0;
        $memberIDs = [];

        foreach($memberlist as $member) {
            $memberIDs[] = $member['id'];
        }

        $data = $this->getVSumField($memberIDs,"pop");

        if (count($data)) {
            foreach ($data as $row) {
                $oldrank += $row['Total'];
            }
        }

		if($ally['oldrank'] != $oldrank){
			if($ally['oldrank'] < $oldrank) {
				$totalpoints = $oldrank - $ally['oldrank'];
				$this->addclimberrankpopAlly($ally['id'], $totalpoints);
				$this->updateoldrankAlly($ally['id'], $oldrank);
			} else
				if($ally['oldrank'] > $oldrank) {
					$totalpoints = $ally['oldrank'] - $oldrank;
					$this->removeclimberrankpopAlly($ally['id'], $totalpoints);
					$this->updateoldrankAlly($ally['id'], $oldrank);
				}
		}
	}

	/*****************************************
	Function to insert an alliance new
	References:
	*****************************************/
	function insertAlliNotice($aid, $notice) {
        list($aid, $notice) = $this->escape_input($aid, $notice);

		$time = time();
		$q = "INSERT into " . TB_PREFIX . "ali_log values (0,'$aid','$notice',$time)";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	/*****************************************
	Function to delete alliance if empty
	References:
	*****************************************/
	function deleteAlliance($aid) {
	    list($aid) = $this->escape_input((int) $aid);

	    $result = mysqli_fetch_array(mysqli_query($this->dblink,"SELECT Count(*) as Total FROM " . TB_PREFIX . "users where alliance = $aid"), MYSQLI_ASSOC);
		if ($result['Total'] == 0) {
	        // remove the alliance
	        $q = "DELETE FROM " . TB_PREFIX . "alidata WHERE id = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all permissions for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "ali_permission WHERE alliance = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all logs for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "ali_log WHERE aid = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all medals for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "allimedal WHERE allyid = $aid";
	        mysqli_query($this->dblink,$q);

	        // remove all invitations for that alliance
	        $q = "DELETE FROM " . TB_PREFIX . "ali_invite WHERE alliance = $aid";
	        mysqli_query($this->dblink,$q);
	    }
	}

	/*****************************************
	Function to read all alliance news
	References:
	*****************************************/
	function readAlliNotice($aid) {
	    list($aid) = $this->escape_input((int) $aid);

		$q = "SELECT * from " . TB_PREFIX . "ali_log where aid = $aid ORDER BY date DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	/*****************************************
	Function to create alliance permissions
	References: ID, notice, description
	*****************************************/
	function createAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8) {
        list($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8) = $this->escape_input($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7, $opt8);


		$q = "INSERT into " . TB_PREFIX . "ali_permission values(0,'$uid','$aid','$rank','$opt1','$opt2','$opt3','$opt4','$opt5','$opt6','$opt7','$opt8')";
		mysqli_query($this->dblink,$q);

		// update cache
        $insertID = mysqli_insert_id($this->dblink);
        self::$alliancePermissionsCache[$uid.$aid] = [
            'id' => $insertID,
            'uid' => $uid,
            'alliance' => $aid,
            'rank' => $rank,
            'opt1' => $opt1,
            'opt2' => $opt2,
            'opt3' => $opt3,
            'opt4' => $opt4,
            'opt5' => $opt5,
            'opt6' => $opt6,
            'opt7' => $opt7,
            'opt8' => $opt8
        ];

		return $insertID;
	}

	/*****************************************
	Function to update alliance permissions
	References:
	*****************************************/
	function deleteAlliPermissions($uid) {
        list($uid) = $this->escape_input($uid);

		$q = "DELETE from " . TB_PREFIX . "ali_permission where uid = '$uid'";
		return mysqli_query($this->dblink,$q);
	}
	/*****************************************
	Function to update alliance permissions
	References:
	*****************************************/
	function updateAlliPermissions($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7) {
	    list($uid, $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7) = $this->escape_input((int) $uid, (int) $aid, $rank, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7);

        // update cache
        if (isset(self::$alliancePermissionsCache[$uid.$aid])) {
            self::$alliancePermissionsCache[ $uid . $aid ]['rank'] = $rank;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt1'] = $opt1;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt2'] = $opt2;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt3'] = $opt3;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt4'] = $opt4;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt5'] = $opt5;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt6'] = $opt6;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt7'] = $opt7;
            self::$alliancePermissionsCache[ $uid . $aid ]['opt8'] = $opt8;
        }

		$q = "UPDATE " . TB_PREFIX . "ali_permission SET rank = '$rank', opt1 = '$opt1', opt2 = '$opt2', opt3 = '$opt3', opt4 = '$opt4', opt5 = '$opt5', opt6 = '$opt6', opt7 = '$opt7' where uid = $uid && alliance =$aid";
		return mysqli_query($this->dblink,$q);
	}

	/*****************************************
	Function to read alliance permissions
	References: ID, notice, description
	*****************************************/
	function getAlliPermissions($uid, $aid, $use_cache = true) {
	    list($uid, $aid) = $this->escape_input((int) $uid, (int) $aid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$alliancePermissionsCache, $uid.$aid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "ali_permission where uid = $uid && alliance = $aid";
		$result = mysqli_query($this->dblink,$q);

        self::$alliancePermissionsCache[$uid.$aid] = mysqli_fetch_assoc($result);
        return self::$alliancePermissionsCache[$uid.$aid];
	}

	/*****************************************
	Function to update an alliance description and notice
	References: ID, notice, description
	*****************************************/
	function submitAlliProfile($aid, $notice, $desc) {
	    list($aid, $notice, $desc) = $this->escape_input((int) $aid, $notice, $desc);


		$q = "UPDATE " . TB_PREFIX . "alidata SET `notice` = '$notice', `desc` = '$desc' where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyInviteAdd($alli1, $alli2, $type) {
	    list($alli1, $alli2, $type) = $this->escape_input((int) $alli1, (int) $alli2, $type);

		$q = "INSERT INTO " . TB_PREFIX . "diplomacy (alli1,alli2,type,accepted) VALUES ($alli1,$alli2," . (int)intval($type) . ",0)";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyOwnOffers($session_alliance) {
	    list($session_alliance) = $this->escape_input((int) $session_alliance);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $session_alliance AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getAllianceID($name) {
        list($name) = $this->escape_input($name);

		$q = "SELECT id FROM " . TB_PREFIX . "alidata WHERE tag ='" . $this->RemoveXSS($name) . "' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['id'];
	}

	function diplomacyCancelOffer($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "diplomacy WHERE id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyInviteAccept($id, $session_alliance) {
	    list($id, $session_alliance) = $this->escape_input((int) $id, (int) $session_alliance);

		$q = "UPDATE " . TB_PREFIX . "diplomacy SET accepted = 1 WHERE id = $id AND alli2 = $session_alliance";
		return mysqli_query($this->dblink,$q);
	}

	function diplomacyInviteDenied($id, $session_alliance) {
	    list($id, $session_alliance) = $this->escape_input((int) $id, (int) $session_alliance);

		$q = "DELETE FROM " . TB_PREFIX . "diplomacy WHERE id = $id AND alli2 = $session_alliance";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function diplomacyInviteCheck($session_alliance) {
	    list($session_alliance) = $this->escape_input((int) $session_alliance);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli2 = $session_alliance AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function diplomacyInviteCheck2($ally1, $ally2) {
	    list($ally1, $ally2) = $this->escape_input((int) $ally1, (int) $ally2);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $ally1 AND alli2 = $ally2 AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getAllianceDipProfile($aid, $type) {
	    list($aid, $type) = $this->escape_input($aid, $type);
		$q = "SELECT alli1, alli2 FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '$type' AND accepted = '1' OR alli2 = '$aid' AND type = '$type' AND accepted = '1'";
		$array = $this->query_return($q);
		$text = "";

		if ($array) {
    		foreach($array as $row){
    			if($row['alli1'] == $aid){
    			$alliance = $this->getAlliance($row['alli2']);
    			}elseif($row['alli2'] == $aid){
    			$alliance = $this->getAlliance($row['alli1']);
    			}
    			$text .= "";
    			$text .= "<a href=allianz.php?aid=".$alliance['id'].">".$alliance['tag']."</a><br> ";
    		}
		}
		if(strlen($text) == 0){
			$text = "-<br>";
		}
		return $text;
	}

    // no need to cache this method
	function getAllianceWar($aid) {
	    list($aid) = $this->escape_input($aid);
		$q = "SELECT alli1, alli2 FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
		$array = $this->query_return($q);
        $text = "";

        if ($array) {
    		foreach($array as $row){
    			if($row['alli1'] == $aid){
    			$alliance = $this->getAlliance($row['alli2']);
    			}elseif($row['alli2'] == $aid){
    			$alliance = $this->getAlliance($row['alli1']);
    			}
    			$text .= "";
    			$text .= "<a href=allianz.php?aid=".$alliance['id'].">".$alliance['tag']."</a><br> ";
    		}
        }
		if(strlen($text) == 0){
			$text = "-<br>";
		}
		return $text;
	}

	function getAllianceAlly($aid, $type, $use_cache = true) {
	    list($aid, $type) = $this->escape_input($aid, $type);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceAlliesCache, $aid.$type)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE (alli1 = '$aid' or alli2 = '$aid') AND (type = '$type' AND accepted = '1')";
		$result = mysqli_query($this->dblink,$q);

        self::$allianceAlliesCache[$aid.$type] = $this->mysqli_fetch_all($result);
        return self::$allianceAlliesCache[$aid.$type];
	}

    // no need to cache this method
	function getAllianceWar2($aid) {
	    list($aid) = $this->escape_input($aid);
		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function diplomacyExistingRelationships($session_alliance) {
	    list($session_alliance) = $this->escape_input((int) $session_alliance);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli2 = $session_alliance AND accepted = 1";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function diplomacyExistingRelationships2($session_alliance) {
	    list($session_alliance) = $this->escape_input((int) $session_alliance);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $session_alliance AND accepted = 1";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function diplomacyCancelExistingRelationship($id, $session_alliance) {
	    list($id, $session_alliance) = $this->escape_input((int) $id, (int) $session_alliance);

		$q = "DELETE FROM " . TB_PREFIX . "diplomacy WHERE id = $id AND alli2 = $session_alliance OR id = $id AND alli1 = $session_alliance";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function checkDiplomacyInviteAccept($aid, $type) {
	    list($aid, $type) = $this->escape_input((int) $aid, (int) $type);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $aid AND type = $type AND accepted = 1 OR alli2 = $aid AND type = $type AND accepted = 1";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if($type == 3){
			return true;
		}else{
		if($result['Total'] < 4) {
			return true;
		} else {
			return false;
		}
		}
	}

	function setAlliForumdblink($aid, $dblink) {
	    list($aid, $dblink) = $this->escape_input((int) $aid, $dblink);

		$q = "UPDATE " . TB_PREFIX . "alidata SET `forumlink` = '$dblink' WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function getUserAlliance($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$userAllianceCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT " . TB_PREFIX . "alidata.tag from " . TB_PREFIX . "users join " . TB_PREFIX . "alidata where " . TB_PREFIX . "users.alliance = " . TB_PREFIX . "alidata.id and " . TB_PREFIX . "users.id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['tag'] == "") {
            self::$userAllianceCache[$id] =  "-";
		} else {
            self::$userAllianceCache[$id] = $dbarray['tag'];
		}

		return self::$userAllianceCache[$id];
	}

	/////////////ADDED BY BRAINIAC - THANK YOU

	 function modifyResource($vid, $wood, $clay, $iron, $crop, $mode) {
	     list($vid, $wood, $clay, $iron, $crop, $mode) = $this->escape_input((int) $vid, (int) $wood, (int) $clay, (int) $iron, (int) $crop, $mode);
         $sign = (!$mode ? '-' : '+');

         $q = "
            UPDATE " . TB_PREFIX . "vdata
                SET
                    wood = IF(wood $sign $wood < 0, 0, IF(wood $sign $wood > maxstore, maxstore, wood $sign $wood)),
                    clay = IF(clay $sign $clay < 0, 0, IF(clay $sign $clay > maxstore, maxstore, clay $sign $clay)),
                    iron = IF(iron $sign $iron < 0, 0, IF(iron $sign $iron > maxstore, maxstore, iron $sign $iron)),
                    crop = IF(crop $sign $crop < 0, 0, IF(crop $sign $crop > maxcrop, maxcrop, crop $sign $crop))
                WHERE
                    wref = " . $vid ;

         return mysqli_query( $this->dblink, $q);
	}

   	function setMaxStoreForVillage($vid, $maxLevel) {
	    $vid = (int) $vid;
	    $maxLevel = (int) $maxLevel;

        $this->query("
                        UPDATE
                            ".TB_PREFIX."vdata
                        SET
                            `maxstore` = IF( `maxstore` - $maxLevel < ".STORAGE_BASE.", ".STORAGE_BASE.", `maxstore` - $maxLevel )
                        WHERE
                            wref=$vid");
    }

    function setMaxCropForVillage($vid, $maxLevel) {
        $vid = (int) $vid;
        $maxLevel = (int) $maxLevel;

        $this->query("
                        UPDATE
                            ".TB_PREFIX."vdata
                        SET
                            `maxcrop` = IF( `maxcrop` - $maxLevel < ".STORAGE_BASE.", ".STORAGE_BASE.", `maxcrop` - $maxLevel )
                        WHERE
                            wref=$vid");
    }

	function modifyOasisResource($vid, $wood, $clay, $iron, $crop, $mode) {
	    list($vid, $wood, $clay, $iron, $crop, $mode) = $this->escape_input((int) $vid, (int) $wood, (int) $clay, (int) $iron, (int) $crop, $mode);

        $negativeResources = false;
        $checkres = $this->getOasisV($vid);

        if ( ! $mode ) {
            $nwood = $checkres[0]['wood'] - $wood;
            $nclay = $checkres[0]['clay'] - $clay;
            $niron = $checkres[0]['iron'] - $iron;
            $ncrop = $checkres[0]['crop'] - $crop;

            if ( $nwood < 0 or $nclay < 0 or $niron < 0 or $ncrop < 0 ) {
                $negativeResources = true;
            }

            $dwood = ( $nwood < 0 ) ? 0 : $nwood;
            $dclay = ( $nclay < 0 ) ? 0 : $nclay;
            $diron = ( $niron < 0 ) ? 0 : $niron;
            $dcrop = ( $ncrop < 0 ) ? 0 : $ncrop;
        } else {
            $nwood = $checkres[0]['wood'] + $wood;
            $nclay = $checkres[0]['clay'] + $clay;
            $niron = $checkres[0]['iron'] + $iron;
            $ncrop = $checkres[0]['crop'] + $crop;
            $dwood = ( $nwood > $checkres[0]['maxstore'] ) ? $checkres[0]['maxstore'] : $nwood;
            $dclay = ( $nclay > $checkres[0]['maxstore'] ) ? $checkres[0]['maxstore'] : $nclay;
            $diron = ( $niron > $checkres[0]['maxstore'] ) ? $checkres[0]['maxstore'] : $niron;
            $dcrop = ( $ncrop > $checkres[0]['maxcrop'] ) ? $checkres[0]['maxcrop'] : $ncrop;
        }

        if ( ! $negativeResources ) {
            $q = "UPDATE " . TB_PREFIX . "odata set wood = $dwood, clay = $dclay, iron = $diron, crop = $dcrop where wref = " . $vid;
            return mysqli_query( $this->dblink, $q );
        } else {
            return false;
        }
   	}

    function getFieldLevelInVillage($vid, $fieldType, $use_cache = true) {
        $vid = (int) $vid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$fieldLevelsInVillageSearchCache, $vid.$fieldType)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        // $fieldType can be both, integer and string, to be used in the IN statement,
        // so we need to handle it correctly here
        if (!Math::isInt($fieldType)) {
            $fieldType = $this->escape($fieldType);
        }

        // please don't scream...
        // with the current table structure, there really IS NOT another way
        // (except for stored procedures, which we can't rely on to be allowed on the server)
        $result = mysqli_query($this->dblink,"
                SELECT
                    IF(
                        f1t IN ($fieldType),
                        f1,
                        IF(
                            f2t IN ($fieldType),
                            f2,
                            IF(
                                f3t IN ($fieldType),
                                f3,
                                IF(
                                    f4t IN ($fieldType),
                                    f4,
                                    IF(
                                        f5t IN ($fieldType),
                                        f5,
                                        IF(
                                            f6t IN ($fieldType),
                                            f6,
                                            IF(
                                                f7t IN ($fieldType),
                                                f7,
                                                IF(
                                                    f8t IN ($fieldType),
                                                    f8,
                                                    IF(
                                                        f9t IN ($fieldType),
                                                        f9,
                                                        IF(
                                                            f10t IN ($fieldType),
                                                            f10,
                                                            IF(
                                                                f11t IN ($fieldType),
                                                                f11,
                                                                IF(
                                                                    f12t IN ($fieldType),
                                                                    f12,
                                                                    IF(
                                                                        f13t IN ($fieldType),
                                                                        f13,
                                                                        IF(
                                                                            f14t IN ($fieldType),
                                                                            f14,
                                                                            IF(
                                                                                f15t IN ($fieldType),
                                                                                f15,
                                                                                IF(
                                                                                    f16t IN ($fieldType),
                                                                                    f16,
                                                                                    IF(
                                                                                        f17t IN ($fieldType),
                                                                                        f17,
                                                                                        IF(
                                                                                            f18t IN ($fieldType),
                                                                                            f18,
                                                                                            IF(
                                                                                                f19t IN ($fieldType),
                                                                                                f19,
                                                                                                IF(
                                                                                                    f20t IN ($fieldType),
                                                                                                    f20,
                                                                                                    IF(
                                                                                                        f20t IN ($fieldType),
                                                                                                        f20,
                                                                                                        IF(
                                                                                                            f21t IN ($fieldType),
                                                                                                            f21,
                                                                                                            IF(
                                                                                                                f22t IN ($fieldType),
                                                                                                                f22,
                                                                                                                IF(
                                                                                                                    f23t IN ($fieldType),
                                                                                                                    f23,
                                                                                                                    IF(
                                                                                                                        f24t IN ($fieldType),
                                                                                                                        f24,
                                                                                                                        IF(
                                                                                                                            f25t IN ($fieldType),
                                                                                                                            f25,
                                                                                                                            IF(
                                                                                                                                f26t IN ($fieldType),
                                                                                                                                f26,
                                                                                                                                IF(
                                                                                                                                    f27t IN ($fieldType),
                                                                                                                                    f27,
                                                                                                                                    IF(
                                                                                                                                        f28t IN ($fieldType),
                                                                                                                                        f28,
                                                                                                                                        IF(
                                                                                                                                            f29t IN ($fieldType),
                                                                                                                                            f29,
                                                                                                                                            IF(
                                                                                                                                                f30t IN ($fieldType),
                                                                                                                                                f30,
                                                                                                                                                IF(
                                                                                                                                                    f31t IN ($fieldType),
                                                                                                                                                    f31,
                                                                                                                                                    IF(
                                                                                                                                                        f32t IN ($fieldType),
                                                                                                                                                        f32,
                                                                                                                                                        IF(
                                                                                                                                                            f33t IN ($fieldType),
                                                                                                                                                            f33,
                                                                                                                                                            IF(
                                                                                                                                                                f34t IN ($fieldType),
                                                                                                                                                                f34,
                                                                                                                                                                IF(
                                                                                                                                                                    f35t IN ($fieldType),
                                                                                                                                                                    f35,
                                                                                                                                                                    IF(
                                                                                                                                                                        f36t IN ($fieldType),
                                                                                                                                                                        f36,
                                                                                                                                                                        IF(
                                                                                                                                                                            f37t IN ($fieldType),
                                                                                                                                                                            f37,
                                                                                                                                                                            IF(
                                                                                                                                                                                f38t IN ($fieldType),
                                                                                                                                                                                f38,
                                                                                                                                                                                IF(
                                                                                                                                                                                    f39t IN ($fieldType),
                                                                                                                                                                                    f39,
                                                                                                                                                                                    IF(
                                                                                                                                                                                        f40t IN ($fieldType),
                                                                                                                                                                                        f40,
                                                                                                                                                                                        0
                                                                                                                                                                                    )
                                                                                                                                                                                )
                                                                                                                                                                            )
                                                                                                                                                                        )
                                                                                                                                                                    )
                                                                                                                                                                )
                                                                                                                                                            )
                                                                                                                                                        )
                                                                                                                                                    )
                                                                                                                                                )
                                                                                                                                            )
                                                                                                                                        )
                                                                                                                                    )
                                                                                                                                )
                                                                                                                            )
                                                                                                                        )
                                                                                                                    )
                                                                                                                )
                                                                                                            )
                                                                                                        )
                                                                                                    )
                                                                                                )
                                                                                            )
                                                                                        )
                                                                                    )
                                                                                )
                                                                            )
                                                                        )
                                                                    )
                                                                )
                                                            )
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    ) as level
                FROM
                    `s1_fdata`
                WHERE
                    vref = $vid
                    AND
                    (f1t IN ($fieldType)
                    OR
                    f2t IN ($fieldType)
                    OR
                    f3t IN ($fieldType)
                    OR
                    f4t IN ($fieldType)
                    OR
                    f5t IN ($fieldType)
                    OR
                    f6t IN ($fieldType)
                    OR
                    f7t IN ($fieldType)
                    OR
                    f8t IN ($fieldType)
                    OR
                    f9t IN ($fieldType)
                    OR
                    f10t IN ($fieldType)
                    OR
                    f11t IN ($fieldType)
                    OR
                    f12t IN ($fieldType)
                    OR
                    f13t IN ($fieldType)
                    OR
                    f14t IN ($fieldType)
                    OR
                    f15t IN ($fieldType)
                    OR
                    f16t IN ($fieldType)
                    OR
                    f17t IN ($fieldType)
                    OR
                    f18t IN ($fieldType)
                    OR
                    f19t IN ($fieldType)
                    OR
                    f20t IN ($fieldType)
                    OR
                    f20t IN ($fieldType)
                    OR
                    f21t IN ($fieldType)
                    OR
                    f22t IN ($fieldType)
                    OR
                    f23t IN ($fieldType)
                    OR
                    f24t IN ($fieldType)
                    OR
                    f25t IN ($fieldType)
                    OR
                    f26t IN ($fieldType)
                    OR
                    f27t IN ($fieldType)
                    OR
                    f28t IN ($fieldType)
                    OR
                    f29t IN ($fieldType)
                    OR
                    f30t IN ($fieldType)
                    OR
                    f30t IN ($fieldType)
                    OR
                    f31t IN ($fieldType)
                    OR
                    f32t IN ($fieldType)
                    OR
                    f33t IN ($fieldType)
                    OR
                    f34t IN ($fieldType)
                    OR
                    f35t IN ($fieldType)
                    OR
                    f36t IN ($fieldType)
                    OR
                    f37t IN ($fieldType)
                    OR
                    f38t IN ($fieldType)
                    OR
                    f39t IN ($fieldType)
                    OR
                    f40t IN ($fieldType)
                    OR
                    f99 IN ($fieldType))
                LIMIT 1
        ");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        self::$fieldLevelsInVillageSearchCache[$vid.$fieldType] = $row['level'];
        return self::$fieldLevelsInVillageSearchCache[$vid.$fieldType];
    }

	function getFieldLevel($vid, $field, $use_cache = true) {
	    list($vid, $field) = $this->escape_input((int) $vid, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$resourceLevelsCache, $vid.$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT f" . $field . " from " . TB_PREFIX . "fdata where vref = $vid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_array($result);

        self::$resourceLevelsCache[$vid.$field] = $row["f" . $field];
        return self::$resourceLevelsCache[$vid.$field];
	}

	function getSingleFieldTypeCount($uid, $field, $lvlComparisonSign = '=', $lvl = false, $use_cache = true) {
	    $uid = (int) $uid;
	    $field = (int) $field;
	    $lvl = ($lvl === false ? $lvl : (int) $lvl);

	    if (!in_array($lvlComparisonSign, ['=', '<', '>', '>=', '<=', '!='])) {
	        $lvlComparisonSign = '=';
	    }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$singleFieldTypeCountCache, $uid.$field.$lvlComparisonSign.($lvl ? 1 : 0))) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    $q = "
            SELECT
            	Count(*) as Total
            FROM
            	".TB_PREFIX."fdata f
            	LEFT JOIN ".TB_PREFIX."vdata v ON f.vref = v.wref
                LEFT JOIN ".TB_PREFIX."users u ON v.owner = u.id
            WHERE
            	u.id = ".$uid."
                AND
                (
                    (f1t = ".$field.($lvl !== false ? ' AND f1 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f2t = ".$field.($lvl !== false ? ' AND f2 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f3t = ".$field.($lvl !== false ? ' AND f3 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f4t = ".$field.($lvl !== false ? ' AND f4 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f5t = ".$field.($lvl !== false ? ' AND f5 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f6t = ".$field.($lvl !== false ? ' AND f6 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f7t = ".$field.($lvl !== false ? ' AND f7 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f8t = ".$field.($lvl !== false ? ' AND f8 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f9t = ".$field.($lvl !== false ? ' AND f9 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f10t = ".$field.($lvl !== false ? ' AND f10 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f11t = ".$field.($lvl !== false ? ' AND f11 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f12t = ".$field.($lvl !== false ? ' AND f12 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f13t = ".$field.($lvl !== false ? ' AND f13 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f14t = ".$field.($lvl !== false ? ' AND f14 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f15t = ".$field.($lvl !== false ? ' AND f15 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f16t = ".$field.($lvl !== false ? ' AND f16 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f17t = ".$field.($lvl !== false ? ' AND f17 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f18t = ".$field.($lvl !== false ? ' AND f18 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f19t = ".$field.($lvl !== false ? ' AND f19 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f20t = ".$field.($lvl !== false ? ' AND f20 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f21t = ".$field.($lvl !== false ? ' AND f21 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f22t = ".$field.($lvl !== false ? ' AND f22 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f23t = ".$field.($lvl !== false ? ' AND f23 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f24t = ".$field.($lvl !== false ? ' AND f24 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f25t = ".$field.($lvl !== false ? ' AND f25 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f26t = ".$field.($lvl !== false ? ' AND f26 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f27t = ".$field.($lvl !== false ? ' AND f27 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f28t = ".$field.($lvl !== false ? ' AND f28 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f29t = ".$field.($lvl !== false ? ' AND f29 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f30t = ".$field.($lvl !== false ? ' AND f30 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f31t = ".$field.($lvl !== false ? ' AND f31 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f32t = ".$field.($lvl !== false ? ' AND f32 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f33t = ".$field.($lvl !== false ? ' AND f33 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f34t = ".$field.($lvl !== false ? ' AND f34 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f35t = ".$field.($lvl !== false ? ' AND f35 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f36t = ".$field.($lvl !== false ? ' AND f36 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f37t = ".$field.($lvl !== false ? ' AND f37 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f38t = ".$field.($lvl !== false ? ' AND f38 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f39t = ".$field.($lvl !== false ? ' AND f39 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f40t = ".$field.($lvl !== false ? ' AND f40 '.$lvlComparisonSign.' '.$lvl : '').")
                )";

	    $result = mysqli_query($this->dblink,$q);
	    $row = mysqli_fetch_array($result);

        self::$singleFieldTypeCountCache[$uid.$field.$lvlComparisonSign.($lvl ? 1 : 0)] = $row["Total"];
        return self::$singleFieldTypeCountCache[$uid.$field.$lvlComparisonSign.($lvl ? 1 : 0)];
	}

	function getFieldType($vid, $field, $use_cache = true) {
	    list($vid, $field) = $this->escape_input((int) $vid, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$fieldTypeCache, $vid.$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    if ($field && $vid) {
    		$q = "SELECT f" . $field . "t from " . TB_PREFIX . "fdata where vref = $vid LIMIT 1";
    		$result = mysqli_query($this->dblink,$q);
    		$row = mysqli_fetch_array($result);
            self::$fieldTypeCache[$vid.$field] = $row["f" . $field . "t"];
	    } else {
            self::$fieldTypeCache[$vid.$field] = 0;
	    }

	    return self::$fieldTypeCache[$vid.$field];
	}

	// no need to cache this method
	function getFieldDistance($wid) {
	    list($wid) = $this->escape_input((int) $wid);

        $array = $this->getProfileVillages($wid, 3);
        $coor = $this->getCoor($wid);
        $x1 = intval($coor['x']);
        $y1 = intval($coor['y']);
        $prevdist = 0;
        $array2 = $this->getVillage(0, 4);
        $vill = $array2['wref'];

        if ($array && count($array)){
            foreach($array as $village){
                $coor2 = $this->getCoor($village['wref']);
                $max = 2 * WORLD_MAX + 1;
                $x2 = intval($coor2['x']);
                $y2 = intval($coor2['y']);
                $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
                $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
                $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
                if($dist < $prevdist or $prevdist == 0){
                    $prevdist = $dist;
                    $vill = $village['wref'];
                }
            }
        }
        return $vill;
    }

    function updateVSumField($field) {
        list($field) = $this->escape_input($field);

        //fix by ronix
        if (SPEED >10) {
            $speed = 10;
        } else {
            $speed = SPEED;
        }

        // cultural points to gain during a day
        $dur_day = (86400/SPEED);

        if ($dur_day < 3600) {
            $dur_day = 3600;
        }

        $q = "
            UPDATE " . TB_PREFIX . "users as users
                SET cp = cp + (
                        ( SELECT sum($field) FROM " . TB_PREFIX . "vdata as vdata WHERE vdata.owner = users.id ".($field == 'cp' ? ' AND vdata.natar = 0' : '')." ) *
                        (UNIX_TIMESTAMP() - lastupdate) / $dur_day
                    ),
                    lastupdate = UNIX_TIMESTAMP()
                WHERE
                    lastupdate < (UNIX_TIMESTAMP() - 600)
        "; // recount every 10 minutes

        mysqli_query($this->dblink, $q);
    }

    function getVSumField($uid, $field, $use_cache = true) {
        list($field) = $this->escape_input($field);

        $array_passed = is_array($uid);
        if (!$array_passed) {
            $uid = [(int) $uid];
        } else {
            foreach ($uid as $index => $uidValue) {
                $uid[$index] = (int) $uidValue;
            }
        }

        if (!count($uid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$userSumFieldCache, $uid[0].$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if($field != "cp"){
            $q = "SELECT owner, MIN(lastupdate), SUM(" . $field . ") as Total FROM " . TB_PREFIX . "vdata where owner IN(".implode(', ', $uid).") GROUP BY owner";
        }else{
            $q = "SELECT owner, MIN(lastupdate), SUM(" . $field . ") as Total FROM " . TB_PREFIX . "vdata where owner IN(".implode(', ', $uid).") and natar = 0 GROUP BY owner";
        }

        $result = mysqli_query($this->dblink,$q);

        // return a single value
        if (!$array_passed) {
            $row = mysqli_fetch_row( $result );
            self::$userSumFieldCache[$row[0].$field] = $row[2];
        } else {
            $result = $this->mysqli_fetch_all($result);
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$userSumFieldCache[ $record['owner'] . $field ] = $record['Total'];
                }
            }
        }

        return ($array_passed ? $result : self::$userSumFieldCache[$uid[0].$field]);
    }

    function updateVillage($vid) {
        list($vid) = $this->escape_input((int) $vid);

        $time = time();
        $q = "UPDATE " . TB_PREFIX . "vdata set lastupdate = $time where wref = $vid";
        return mysqli_query($this->dblink,$q);
    }


    function updateOasis($vid) {
        list($vid) = $this->escape_input((int) $vid);

        $time = time();
        $q = "UPDATE " . TB_PREFIX . "odata set lastupdated = $time where wref = $vid";
        return mysqli_query($this->dblink,$q);
    }

    function setVillageName($vid, $name) {
        list($vid, $name) = $this->escape_input((int) $vid, $name);

        if(!empty($name))
        {
        $q = "UPDATE " . TB_PREFIX . "vdata set name = '$name' where wref = $vid";
        return mysqli_query($this->dblink,$q);
        }
    }

    function modifyPop($vid, $pop, $mode) {
        list($vid, $pop, $mode) = $this->escape_input((int) $vid, (int) $pop, $mode);

        if(!$mode) {
            $q = "UPDATE " . TB_PREFIX . "vdata set pop = pop + $pop where wref = $vid";
        } else {
            $q = "UPDATE " . TB_PREFIX . "vdata set pop = pop - $pop where wref = $vid";
        }
        return mysqli_query($this->dblink,$q);
    }

    function addCP($ref, $cp) {
        list($ref, $cp) = $this->escape_input((int) $ref, (int) $cp);

        $q = "UPDATE " . TB_PREFIX . "vdata set cp = cp + $cp where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    function addCel($ref, $cel, $type) {
        list($ref, $cel, $type) = $this->escape_input((int) $ref, (int) $cel, (int) $type);

        $q = "UPDATE " . TB_PREFIX . "vdata set celebration = $cel, type= $type where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
    function getCel() {
        return $this->getProfileVillages(time(), 4);
    }

    function clearCel($ref) {
        list($ref) = $this->escape_input((int) $ref);

        $q = "UPDATE " . TB_PREFIX . "vdata set celebration = 0, type = 0 where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    function setCelCp($user, $cp) {
        list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

        $q = "UPDATE " . TB_PREFIX . "users set cp = cp + $cp where id = $user";
        return mysqli_query($this->dblink,$q);
    }

    function clearExpansionSlot($id) {
        $id = (int) $id;

        $pairs = [];
        for($i = 1; $i <= 3; $i++) {
            $pairs[] = 'exp'.$i.' = 0';
        }

        $q = "UPDATE " . TB_PREFIX . "vdata SET ".implode(',', $pairs)." WHERE wref = " . $id;
        mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
    function getInvitation($uid) {
        list($uid) = $this->escape_input((int) $uid);

        $q = "SELECT * FROM " . TB_PREFIX . "ali_invite where uid = $uid";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    // no need to cache this method
    function getInvitation2($uid, $aid) {
        list($uid, $aid) = $this->escape_input((int) $uid, (int) $aid);

        $q = "SELECT * FROM " . TB_PREFIX . "ali_invite where uid = $uid and alliance = $aid";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    // no need to cache this method
    function getAliInvitations($aid) {
        list($aid) = $this->escape_input((int) $aid);

        $q = "SELECT * FROM " . TB_PREFIX . "ali_invite where alliance = $aid && accept = 0";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    function sendInvitation($uid, $alli, $sender) {
        list($uid, $alli, $sender) = $this->escape_input((int) $uid, (int) $alli, (int) $sender);

        $time = time();
        $q = "INSERT INTO " . TB_PREFIX . "ali_invite values (0,$uid,$alli,$sender,$time,0)";
        return mysqli_query($this->dblink,$q);
    }

    function removeInvitation($id) {
        list($id) = $this->escape_input((int) $id);

        $q = "DELETE FROM " . TB_PREFIX . "ali_invite where id = $id";
        return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
    function getUnreadMessagesCount($uid) {
        $uid = (int) $uid;

        $ids = [$uid];

        if (($this->getUserField($uid, 'access', 0) == ADMIN) && ADMIN_RECEIVE_SUPPORT_MESSAGES) {
            $ids[] = 1;
        }

        if ($this->getUserField($uid, 'access', 0) == MULTIHUNTER) {
            $ids[] = 5;
        }

        $q = 'SELECT Count(*) as numUnread FROM '.TB_PREFIX.'mdata WHERE target IN('.implode(', ', $ids).') AND viewed = 0';
        return mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC)['numUnread'];
    }

    // no need to cache this method
    function getUnreadNoticesCount($uid) {
        $uid = (int) $uid;

        return mysqli_fetch_array(mysqli_query($this->dblink, '
            SELECT Count(*) as numUnread FROM '.TB_PREFIX.'ndata WHERE uid = '.$uid.' AND viewed = 0'
        ), MYSQLI_ASSOC)['numUnread'];
    }

    function sendMessage($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report, $skip_escaping = false) {
        if (!$skip_escaping) {
           list($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report) = $this->escape_input((int) $client, (int) $owner, $topic, $message, (int) $send, (int) $alliance, (int) $player, (int) $coor, (int) $report);
        }

        $time = time();

        // add this message to the query cache, so we save some queries
        // if we need to send multiple messages at once
        self::$sendMessageQueryCache[] = "(0,$client,$owner,'$topic','$message',0,0,$send,$time,0,0,$alliance,$player,$coor,$report)";

        // check if we don't have too many messages to be sent out cached,
        // in which case we'll flush the cache and start again
        $retValue = true;
        if (count(self::$sendMessageQueryCache) >= self::$sendMessageQueryCacheMaxRecords) {
            $retValue = mysqli_query($this->dblink, "INSERT INTO " . TB_PREFIX . "mdata VALUES " . implode(', ', self::$sendMessageQueryCache));
            self::$sendMessageQueryCache = [];
        }

        return $retValue;
    }

    public function sendPendingMessages() {
        if (count(self::$sendMessageQueryCache)) {
            mysqli_query($this->dblink, "INSERT INTO " . TB_PREFIX . "mdata VALUES " . implode(', ', self::$sendMessageQueryCache));
        }
    }

    function setArchived($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

        $q = "UPDATE " . TB_PREFIX . "mdata set archived = 1 where id IN(".implode(', ', $id).")";
        return mysqli_query($this->dblink,$q);
    }

    function setNorm($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

        $q = "UPDATE " . TB_PREFIX . "mdata set archived = 0 where id IN(".implode(',', $id).")";
        return mysqli_query($this->dblink,$q);
    }

/***************************
Function to get messages
Mode 1: Get inbox
Mode 2: Get sent
Mode 3: Get message
Mode 4: Set viewed
Mode 5: Remove message
Mode 6: Retrieve archive
References: User ID/Message ID, Mode
***************************/
    // no need to cache this method
	function getMessage($id, $mode) {
	    global $session;

	    $mode = (int) $mode;
	    $mode_updated = false;
	    // update $id if we should show Support messages for Admins and we are an admin
	    if (
	       $session->access == ADMIN
	       && ADMIN_RECEIVE_SUPPORT_MESSAGES
	       && in_array($mode, [1,2,6,9,10,11])
	    ) {
	        $id = $id . ', 1';
            $mode_updated = true;
	    }

        // update $id if we should show Multihunter messages for the current player
        if (
            $session->access == MULTIHUNTER
            && in_array($mode, [1,2,6,9,10,11])
        ) {
            $id = $id . ', 5';
            $mode_updated = true;
        }

        if (in_array($mode, [5,7,8])) {
            if (!is_array($id)) {
                $id = [$id];

                foreach ($id as $index => $idValue) {
                    $id[$index] = (int) $idValue;
                }
            }
        } else {
	        if (!$mode_updated) {
                $id = (int) $id;
            }
        }

		global $session;
		switch($mode) {
			case 1:
				$q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target IN($id) and send = 0 and archived = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 2:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner IN($id) ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 3:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata where id = $id";
				break;
			case 4:
			    $show_target = $session->uid;

			    if ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES) {
			        $show_target .= ',1';
                }

                if ($session->access == MULTIHUNTER) {
                    $show_target .= ',5';
                }

			    $q = "UPDATE " . TB_PREFIX . "mdata set viewed = 1 where id = $id AND target IN(".$show_target.")";
				break;
			case 5:
				$q = "UPDATE " . TB_PREFIX . "mdata set deltarget = 1,viewed = 1 where id IN(".implode(', ', $id).")";
				break;
			case 6:
				$q = "SELECT * FROM " . TB_PREFIX . "mdata where target IN($id) and send = 0 and archived = 1 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 7:
				$q = "UPDATE " . TB_PREFIX . "mdata set delowner = 1 where id IN(".implode(', ', $id).")";
				break;
			case 8:
				$q = "UPDATE " . TB_PREFIX . "mdata set deltarget = 1,delowner = 1,viewed = 1 where IN(".implode(', ', $id).")";
				break;
			case 9:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target IN($id) and send = 0 and archived = 0 and deltarget = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 10:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner IN($id) and delowner = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
			case 11:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata where target IN($id) and send = 0 and archived = 1 and deltarget = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
				break;
		}

		if($mode <= 3 || $mode == 6 || $mode > 8) {
			$result = mysqli_query($this->dblink,$q);
			return $this->mysqli_fetch_all($result);
		} else {
			return mysqli_query($this->dblink,$q);
		}
	}

	function unarchiveNotice($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

		$q = "UPDATE " . TB_PREFIX . "ndata set ntype = archive, archive = 0 where id IN(".implode(',', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function archiveNotice($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

		$q = "update " . TB_PREFIX . "ndata set archive = ntype, ntype = 9 where id IN(".implode(',', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function removeNotice($id) {
        if (!is_array($id)) {
            $id = [$id];

            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

		$q = "UPDATE " . TB_PREFIX . "ndata set del = 1,viewed = 1 where id IN(".implode(',', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	function noticeViewed($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "ndata set viewed = 1 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function addNotice($uid, $toWref, $ally, $type, $topic, $data, $time = 0) {
    list($uid, $toWref, $ally, $type, $topic, $data, $time) = $this->escape_input((int) $uid, (int) $toWref, (int) $ally, (int) $type, $topic, $data, (int) $time);

    	if($time == 0) {
    	$time = time();
    	}
    	$q = "INSERT INTO " . TB_PREFIX . "ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'$uid','$toWref','$ally','$topic',$type,'$data',$time,0)";
    	return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
	function getNotice($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid and del = 0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getNotice2($id, $field, $use_cache = true) {
        list($id, $field) = $this->escape_input((int) $id, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$noticesCacheById, $id)) && !is_null($cachedValue)) {
            return $cachedValue[$field];
        }

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where `id` = $id ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC')." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

        self::$noticesCacheById[$id] = $dbarray;
        return self::$noticesCacheById[$id][$field];
	}

	function getNotice3($uid, $use_cache = true) {
	    list($uid) = $this->escape_input((int) $uid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$noticesCacheByUId, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
		$result = mysqli_query($this->dblink,$q);

        $noticesCacheByUId[$uid] = $this->mysqli_fetch_all($result);
        return $noticesCacheByUId[$uid];
	}

	function getNotice4($id, $use_cache = true) {
	    return $this->getNotice2($id, $use_cache);
	}

	function getUnViewNotice($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid AND viewed=0 ORDER BY time ".(isset($_GET['o']) && $_GET['o'] == 1 ? 'ASC' : 'DESC');
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function createTradeRoute($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time) {
	    list($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time) = $this->escape_input((int) $uid,(int) $wid,(int) $from,(int) $r1,(int) $r2,(int) $r3,(int) $r4,(int) $start,(int) $deliveries,(int) $merchant,(int) $time);

	    $x = "UPDATE " . TB_PREFIX . "users SET gold = gold - 2 WHERE id = " . $uid;
        mysqli_query( $this->dblink, $x );
        $timeleft = time() + 604800;
        $q        = "INSERT into " . TB_PREFIX . "route values (0,$uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time,$timeleft)";

        return mysqli_query( $this->dblink, $q );
	}

    // no need to cache this method
	function getTradeRoute($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "route where uid = $uid ORDER BY timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getTradeRoute2($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "route where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray;
	}

    // no need to cache this method
	function getTradeRouteUid($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT uid FROM " . TB_PREFIX . "route where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['uid'];
	}

	function editTradeRoute($id,$column,$value,$mode) {
	    list($id,$column,$value,$mode) = $this->escape_input((int) $id,$column,(int) $value,$mode);

        if ( ! $mode ) {
            $q = "UPDATE " . TB_PREFIX . "route set $column = $value where id = $id";
        } else {
            $q = "UPDATE " . TB_PREFIX . "route set $column = $column + $value where id = $id";
        }

        return mysqli_query( $this->dblink, $q );
	}

	function deleteTradeRoute($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "route where id = $id";
		return mysqli_query($this->dblink,$q);
	}
	
	function deleteTradeRoutesByVillage($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "route where `from` = $id";
		return mysqli_query($this->dblink,$q);
	}
	
	function addBuilding($wid, $field, $type, $loop, $time, $master, $level) {
	    list($wid, $field, $type, $loop, $time, $master, $level) = $this->escape_input((int) $wid, $field, (int) $type, (int) $loop, (int) $time, (int) $master, (int) $level);

		$x = "UPDATE " . TB_PREFIX . "fdata SET f" . $field . "t=" . $type . " WHERE vref=" . $wid;
		mysqli_query($this->dblink,$x);
		$q = "INSERT into " . TB_PREFIX . "bdata values (0,$wid,$field,$type,$loop,$time,$master,$level)";
		return mysqli_query($this->dblink,$q);
	}

	function removeBuilding($d) {
	    list($d) = $this->escape_input((int) $d);

		global $building, $village;
		$jobLoopconID = -1;
		$SameBuildCount = 0;
		$jobs = $building->buildArray;
		for($i = 0; $i < sizeof($jobs); $i++) {
			if($jobs[$i]['id'] == $d) {
				$jobDeleted = $i;
			}
			if($jobs[$i]['loopcon'] == 1) {
				$jobLoopconID = $i;
			}
			if($jobs[$i]['master'] == 1) {
				$jobMaster = $i;
			}
		}
		if(count($jobs) > 1 && ($jobs[0]['field'] == $jobs[1]['field'])) {
			$SameBuildCount = 1;
		}
		if(count($jobs) > 2 && ($jobs[0]['field'] == $jobs[2]['field'])) {
			$SameBuildCount = 2;
		}
		if(count($jobs) > 2 && ($jobs[1]['field'] == $jobs[2]['field'])) {
			$SameBuildCount = 3;
		}
		if(count($jobs) > 3 && ($jobs[0]['field'] == $jobs[3]['field'])) {
			$SameBuildCount = 8;
		}
		if(count($jobs) > 3 && ($jobs[1]['field'] == $jobs[3]['field'])) {
			$SameBuildCount = 9;
		}
		if(count($jobs) > 3 && ($jobs[2]['field'] == $jobs[3]['field'])) {
			$SameBuildCount = 10;
		}
		if(count($jobs) > 2 && ($jobs[0]['field'] == $jobs[1]['field'] && $jobs[1]['field'] == $jobs[2]['field'])) {
			$SameBuildCount = 4;
		}
		if(count($jobs) > 3 && ($jobs[0]['field'] == $jobs[1]['field'] && $jobs[1]['field'] == $jobs[3]['field'])) {
			$SameBuildCount = 5;
		}
		if(count($jobs) > 3 && ($jobs[0]['field'] == $jobs[2]['field'] && $jobs[2]['field'] == $jobs[3]['field'])) {
			$SameBuildCount = 6;
		}
		if(count($jobs) > 3 && ($jobs[1]['field'] == $jobs[2]['field'] && $jobs[2]['field'] == $jobs[3]['field'])) {
			$SameBuildCount = 7;
		}
		if($SameBuildCount > 0) {
			if($SameBuildCount > 3){
			if($SameBuildCount == 4 or $SameBuildCount == 5){
			if($jobDeleted == 0){
			$uprequire = $building->resourceRequired($jobs[1]['field'],$jobs[1]['type'],1);
			$time = $uprequire['time'];
			$timestamp = $time+time();
			$q = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0,level=level-1,timestamp=".$timestamp." WHERE id=".(int) $jobs[1]['id'];
				mysqli_query($this->dblink,$q);
			}
			}else if($SameBuildCount == 6){
			if($jobDeleted == 0){
			$uprequire = $building->resourceRequired($jobs[2]['field'],$jobs[2]['type'],1);
			$time = $uprequire['time'];
			$timestamp = $time+time();
			$q = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0,level=level-1,timestamp=".$timestamp." WHERE id=".(int) $jobs[2]['id'];
				mysqli_query($this->dblink,$q);
			}
			}else if($SameBuildCount == 7){
			if($jobDeleted == 1){
			$uprequire = $building->resourceRequired($jobs[2]['field'],$jobs[2]['type'],1);
			$time = $uprequire['time'];
			$timestamp = $time+time();
			$q = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0,level=level-1,timestamp=".$timestamp." WHERE id=".(int) $jobs[2]['id'];
				mysqli_query($this->dblink,$q);
			}
			}
			if($SameBuildCount < 8){
			$uprequire1 = $building->resourceRequired($jobs[$jobMaster]['field'],$jobs[$jobMaster]['type'],2);
			$time1 = $uprequire1['time'];
			$timestamp1 = $time1;
			$q1 = "UPDATE " . TB_PREFIX . "bdata SET level=level-1,timestamp=".$timestamp1." WHERE id=".(int) $jobs[$jobMaster]['id'];
				mysqli_query($this->dblink,$q1);
			}else{
			$uprequire1 = $building->resourceRequired($jobs[$jobMaster]['field'],$jobs[$jobMaster]['type'],1);
			$time1 = $uprequire1['time'];
			$timestamp1 = $time1;
			$q1 = "UPDATE " . TB_PREFIX . "bdata SET level=level-1,timestamp=".$timestamp1." WHERE id=".(int) $jobs[$jobMaster]['id'];
				mysqli_query($this->dblink,$q1);
			}
			}else if($d == $jobs[floor($SameBuildCount / 3)]['id'] || $d == $jobs[floor($SameBuildCount / 2) + 1]['id']) {
			    $q = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0,level=level-1,timestamp=" . (int) $jobs[floor($SameBuildCount / 3)]['timestamp'] . " WHERE master = 0 AND id > ".$d." and (ID=" . (int) $jobs[floor($SameBuildCount / 3)]['id'] . " OR ID=" . (int) $jobs[floor($SameBuildCount / 2) + 1]['id'] . ")";
				mysqli_query($this->dblink,$q);
			}
		} else {
            if($jobs[$jobDeleted]['field'] >= 19) {
                $x = "SELECT f" . $jobs[$jobDeleted]['field'] . " FROM " . TB_PREFIX . "fdata WHERE vref=" . (int) $jobs[$jobDeleted]['wid'];
                $result = mysqli_query($this->dblink,$x);
                $fieldlevel = mysqli_fetch_row($result);
                    if($fieldlevel[0] == 0) {
                    if ($village->natar==1 && $jobs[$jobDeleted]['field']==99) { //fix by ronix
                    }else{
                        $x = "UPDATE " . TB_PREFIX . "fdata SET f" . $jobs[$jobDeleted]['field'] . "t=0 WHERE vref=" . (int) $jobs[$jobDeleted]['wid'];
                        mysqli_query($this->dblink,$x);
                    }
                }
			}
			if(($jobLoopconID >= 0) && ($jobs[$jobDeleted]['loopcon'] != 1)) {
				if(($jobs[$jobLoopconID]['field'] <= 18 && $jobs[$jobDeleted]['field'] <= 18) || ($jobs[$jobLoopconID]['field'] >= 19 && $jobs[$jobDeleted]['field'] >= 19) || sizeof($jobs) < 3) {
					$uprequire = $building->resourceRequired($jobs[$jobLoopconID]['field'], $jobs[$jobLoopconID]['type']);
					$x = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0,timestamp=" . (time() + (int) $uprequire['time']) . " WHERE wid=" . (int) $jobs[$jobDeleted]['wid'] . " AND loopcon=1 AND master=0";
					mysqli_query($this->dblink,$x);
				}
			}
		}
		$q = "DELETE FROM " . TB_PREFIX . "bdata where id = $d";
		return mysqli_query($this->dblink,$q);
	}

	function addDemolition($wid, $field) {
	    list($wid, $field) = $this->escape_input((int) $wid, (int) $field);

		global $building, $village, $session;

		// check if we're not demolishing an Embassy if the player is in an alliance
		if ($this->getFieldType($wid,$field) == 18 && $session->alliance) {

		    // get field level, alliance members count and the minimum
		    // level of Embassy to be able to hold this number of people
		    $fLevel          = $this->getFieldLevel($wid,$field);
		    $membersCount    = $this->countAllianceMembers($session->alliance);
		    $minEmbassyLevel = $this->getMinEmbassyLevel($membersCount);
		    $isOwner         = $this->isAllianceOwner($session->uid) == $session->alliance;

		    // make sure minimum Embassy level is 3 of the player is alliance owner
            if ($isOwner && $minEmbassyLevel < 3) {
                $minEmbassyLevel = 3;
            }

		    // check if this user is the founder of the alliance
		    // and whether we're not trying to demolish under the lowest level
		    // which can hold current number of members
		    if ($fLevel == $minEmbassyLevel && $session->alliance && $isOwner) {
		        // check if we have any other players in this alliance left
		        if ($membersCount > 1) {
		            // check if this player has only 1 last Embassy on a sufficient level
		            if ($this->getSingleFieldTypeCount($session->uid, 18, '>=', $minEmbassyLevel) == 1) {
    		            // cannot demolish Embassy further until the player quits the alliance,
    		            // as they are founder and there are still other players in the alliance,
    		            // thus destroying Embassy would evict this player from the alliance
    		            // and leave a new random leader
    		            return 18;
		            }
		        }
		    }
		}

		$q = "DELETE FROM ".TB_PREFIX."bdata WHERE field=$field AND wid=$wid";
		mysqli_query($this->dblink,$q);
		$uprequire = $building->resourceRequired($field,$village->resarray['f'.$field.'t'],0);
		$q = "INSERT INTO ".TB_PREFIX."demolition VALUES (".$wid.",".$field.",".($fLevel-1).",".(time()+floor($uprequire['time']/2)).")";
		mysqli_query($this->dblink,$q);

		return true;
	}

    // no need to cache this method
	function getDemolition($wid = 0) {
	    list($wid) = $this->escape_input((int) $wid);

		if($wid) {
			$q = "SELECT * FROM " . TB_PREFIX . "demolition WHERE vref=" . $wid;
		} else {
			$q = "SELECT * FROM " . TB_PREFIX . "demolition WHERE timetofinish<=" . time();
		}
		$result = mysqli_query($this->dblink,$q);
		if(!empty($result)) {
			return $this->mysqli_fetch_all($result);
		} else {
			return NULL;
		}
	}

	function finishDemolition($wid) {
	    list($wid) = $this->escape_input((int) $wid);

    	$q = "UPDATE " . TB_PREFIX . "demolition SET timetofinish=" . time() . " WHERE vref=" . $wid;
    	$result= mysqli_query($this->dblink,$q);
    	return mysqli_affected_rows($this->dblink);
	}

	function delDemolition($wid, $checkEmbassy = false) {
	    $wid = (int) $wid;

	    if ($checkEmbassy) {
	        // check if we've demolished an Embassy
	        // and select the user it belonged to as well,
	        // so we can potentially evict them from the alliance
	        // and remove it - if they don't have any more Embassies
	        //                 or if the they are founder and they have no more lvl 3+ Embassies
	        $q = '
            SELECT
                u.id, u.username, u.alliance, d.buildnumber, d.lvl
            FROM
                '.TB_PREFIX.'demolition d
                LEFT JOIN '.TB_PREFIX.'vdata v ON d.vref = v.wref
                LEFT JOIN '.TB_PREFIX.'users u ON u.id = v.owner
            WHERE d.vref = '.$wid;

	        $res = $this->mysqli_fetch_all(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
	        foreach ($res as $key) {
	            // if this building being demolished is an Embassy or was demolished completely
	            // and the player is in an alliance, check and update their alliance status
	            if (($key['alliance'] > 0) && ($key['lvl'] == 0 || $this->getFieldType($wid, $key['buildnumber']) == 18)) {
                    $this->checkAllianceEmbassiesStatus($key, true);
                }
	        }
	    }

		$q = "DELETE FROM " . TB_PREFIX . "demolition WHERE vref=" . $wid;
		return mysqli_query($this->dblink,$q);
	}

	/**
	 * Returns a minimum level for an Embassy in order to accomodate
	 * the given number of members.
	 *
	 * @param int $membersCount Number of members for an alliance to accomodate.
	 *                          Maximum = 60
	 *
	 * @return number Returns the level of Embassy required to accomodate
	 *                the given number of members.
	 */
	public function getMinEmbassyLevel($membersCount) {
	    $membersCount = (int) $membersCount;

	    if ($membersCount > 60) {
	        $membersCount = 60;
	    }

	    if ($membersCount < 0) {
	        $membersCount = 0;
	    }

	    return ceil((20 / 60) * $membersCount);
	}

	/***
	 * Returns the number of members an alliance can hold
	 * with the current level of leader's Embassy.
	 *
	 * @param int $embassyLevel Level of leader's Embassy building.
	 *
	 * @return number Returns the number of members an alliance
	 *                can hold with the current level of leader's Embassy.
	 */
	public function getAllianceCapacity($embassyLevel) {
	    $embassyLevel = (int) $embassyLevel;

	    if ($embassyLevel > 20) {
	        $embassyLevel = 20;
	    }

	    if ($embassyLevel < 0) {
	        $embassyLevel = 0;
	    }

	    // ceil is not really necessary but to make sure
	    // decimals won't crack this up, it's here
	    return ceil((60 / 20) * $embassyLevel);
	}

	/**
	 * Checks and potentially updates the status of a player-alliance
	 * relationship given the user input.
	 *
	 * @param array $userData     Data of the user for which we want to check
	 *                            the player-alliance relationship.
	 * @param boolean $demolition Determines whether the request came from
	 *                            a buiding demolition (true) or from a battle
	 *                            report (false).
	 *
	 * @return boolean            Returns TRUE if there was no change
	 *                            to the player-alliance relationship
	 *                            FALSE if the player was an alliance
	 *                            leader and the alliance was destroyed
	 *                            and 0 when the player was evicted from
	 *                            the alliance due to Embassy damage.
	 */
	public function checkAllianceEmbassiesStatus($userData, $demolition = false, $use_cache = true) {
	    // TODO: refactor this and break it into more smaler methods
	    global $session;

	    if ($userData['alliance']) {
            // check whether this player is an alliance owner
            $isOwner = ($userData['alliance'] && $this->isAllianceOwner($userData['id'], $use_cache) == $userData['alliance']);

            $minimumExistingEmbassyRecords = 1;

            // if they are not an alliance owner, simply check whether we have any Embassies
            // at lvl 1+ standing somewhere
            if (!$isOwner) {
                // TODO: replace magic numbers by constants (18 = Embassy)
                if ($this->getSingleFieldTypeCount($userData['id'], 18, '>=', 1, $use_cache) < $minimumExistingEmbassyRecords) {

                    // the player has no more Embassies, evict them from the alliance
                    mysqli_query($this->dblink, 'UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id = '.$userData['id']);

                    // unset the alliance in session, if we're evicting
                    // currently logged-in player
                    if ($session->uid == $userData['id']) {
                        $_SESSION['alliance_user'] = 0;
                    }

                    // notify them via in-game messaging, if we come from a demolition,
                    // otherwise return a result which can be used in battle reports
                    if ($demolition) {
                        $this->sendMessage(
                            $userData['id'],
                            4,
                            'You left the alliance',
                            $this->escape("Hi, ".$userData['username']."!\n\nThis is to inform you that due to a finished demolition of your last Embassy, you have now successfully left your alliance.\n\nYours sincerely,\n<i>Server Robot :)</i>"),
                            0,
                            0,
                            0,
                            0,
                            0,
                            true);
                    } else {
                        // player has been removed from the alliance
                        $this->sendMessage(
                            $userData['id'],
                            4,
                            'An attack has forced you to leave the alliance',
                            $this->escape("Hi, ".$userData['username']."!\n\nThis is to inform you that due to a successful attack and destruction of your last Embassy, you have been forced to leave your alliance.\n\nTo re-establish your position in this alliance, you will need to build a new Embassy and ask the leader to send you an invite again.\n\nYours sincerely,\n<i>Server Robot :)</i>"),
                            0,
                            0,
                            0,
                            0,
                            0,
                            true);

                        return 0;
                    }

                }
            } else {
                // the player IS an alliance owner, check if we need to take any action
                $membersCount            = $this->countAllianceMembers($userData['alliance'], $use_cache);
                $minAllianceEmbassyLevel = $this->getMinEmbassyLevel($membersCount);

                // in this case, the minimum Embassy level cannot go below 3,
                // since this player is a leader and as such, he needs at least
                // a level 3 Embassy
                if ($minAllianceEmbassyLevel < 3) {
                    $minAllianceEmbassyLevel = 3;
                }

                $takeAction              = (
                    // was the Embassy taken below a threshold level?
                    ($userData['lvl'] <= $minAllianceEmbassyLevel)
                    &&
                    // check for standing Embassies with sufficient level
                    // TODO: replace magic numbers by constants (18 = Embassy)
                    ($this->getSingleFieldTypeCount($userData['id'], 18, '>=', $minAllianceEmbassyLevel, false, $use_cache) < $minimumExistingEmbassyRecords)
                );

                // the Embassy got damaged below a sufficient level and there are no more Embassies
                // at that level standing on this player's account, additional actions are needed
                if ($takeAction) {

                    // load all alliance members
                    $members = $this->getAllMember($userData['alliance'], 0, $use_cache);

                    // if we come from demolition, we need to evict all new members
                    // that accepted an invitation while level 3 of the last
                    // Embassy was already under demolition. The demolition dialog itself
                    // already checks if there are no more people other than the owner
                    // present before the demolition is allowed.
                    if ($demolition) {
                        $evicts = [];
                        foreach ($members as $member) {
                            // evict the player from the alliance
                            $evicts[] = $member['id'];

                            // notify them via in-game messaging
                            $this->sendMessage(
                                $member['id'],
                                4,
                                'Your alliance was disbanded',
                                (
                                    ($member['id'] == $userData['id'])
                                    ?
                                    $this->escape("Hi, ".$userData['username']."!\n\nThis is to inform you that due to a finished demolition of your last Embassy at level 3, and the fact that you were the leader of your alliance, this alliance has been disbanded.\n\nIn order to found a new alliance, please build a level 3 Embassy again in one of your villages.\n\nYours sincerely,\n<i>Server Robot :)</i>")
                                    :
                                    $this->escape("Hi, ".$member['username']."!\n\nThis is to inform you that due to a demolition of your alliance founder's last Embassy below level 3, this alliance has been disbanded.\n\n\You can now accept invitations from other alliances or found a new alliance yourself.\n\nYours sincerely,\n<i>Server Robot :)</i>")
                                ),
                                0,
                                0,
                                0,
                                0,
                                0,
                                true);
                        }

                        mysqli_query($this->dblink, 'UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id IN('.implode(',', $evicts).")");
                    } else {
                        // we come from a battle result, therefore we need to check
                        // for the first player in the alliance who has a sufficient
                        // level Embassy and to which we can auto-reassign the leadership
                        $newLeaderFound = false;

                        // in case we'll need these later to disband the alliance,
                        // we'll collect them inside this foeach loop
                        $memberIDs      = [];

                        // no need for this whole foreach loop if this player is the lone
                        // founder and member of their alliance
                        if ($membersCount > 1) {
                            foreach ($members as $member) {
                                if (!$newLeaderFound && $this->getSingleFieldTypeCount($member['id'], 18, '>=', $minAllianceEmbassyLevel) >= 1) {
                                    // found a new leader for the alliance
                                    $newLeaderFound = true;
                                    $newleader = $member['id'];
                                    $q = "UPDATE " . TB_PREFIX . "alidata set leader = ".(int) $newleader." where id = ".(int) $userData['alliance'];
                                    $this->query($q);
                                    $this->updateAlliPermissions($newleader, $userData['alliance'], "Leader", 1, 1, 1, 1, 1, 1, 1);
                                    Automation::updateMax($newleader);

                                    // update permissions for the old leader
                                    $this->updateAlliPermissions($userData['id'], $userData['alliance'], "Former Leader", 0, 0, 0, 0, 0, 0, 0);

                                    // notify new leader via in-game messaging
                                    $this->sendMessage(
                                        $newleader,
                                        4,
                                        'You are now the alliance leader',
                                        $this->escape("Hi, ".$member['username']."!\n\nThis is to inform you that there was a successful attack on player <a href=\"spieler.php?uid=".$userData['id']."\">".$userData['username']."</a> which has damaged their Embassy badly enough that they are no longer able to sustain the leadership of your alliance.\n\nSince your Embassy level is of a sufficient level, you have been auto-elected to the position of a new leader of your alliance with all duties and responsibilities thereof.\n\nYours sincerely,\n<i>Server Robot :)</i>"),
                                        0,
                                        0,
                                        0,
                                        0,
                                        0,
                                        true);
                                }

                                $memberIDs[] = $member['id'];
                            }
                        } else {
                            // if there is only 1 member and it's the actual founder
                            $memberIDs[] = $userData['id'];
                        }

                        // if there wasn't anyone with a sufficient level of Embassy
                        // among the existing members, disperse this alliance
                        if (!$newLeaderFound) {

                            // evict all members from the alliance
                            mysqli_query($this->dblink, 'UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id IN('.implode(',', $memberIDs).")");

                            // notify all of them via in-game messaging
                            foreach ($members as $member) {
                                $this->sendMessage(
                                    $member['id'],
                                    4,
                                    'Your alliance was dispersed',
                                    (
                                        ($member['id'] == $userData['id'])
                                        ?
                                        $this->escape("Hi, ".$userData['username']."!\n\nThis is to inform you that due to a successful attack that has degraded your last Embassy to a level ".($membersCount > 1 ? "which is unable to hold all ".$membersCount." alliance members, and because there was no other alliance member with an Embassy on a high enough level to overtake the leadership," : "lower then 3 - which is required to found and hold your own alliance - ")." your alliance has been dispersed.\n\nYours sincerely,\n<i>Server Robot :)</i>")
                                        :
                                        $this->escape("Hi, ".$member['username']."!\n\nThis is to inform you that due to a successful attack on your alliance leader's Embassy by another player that degraded it below threshold allowed to hold all ".$membersCount." alliance members, and because there was no other alliance member with an Embassy on a high enough level to overtake the leadership, your alliance has been dispersed.\n\nYours sincerely,\n<i>Server Robot :)</i>")
                                    ),
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    true);
                            }
                        } else {
                            // let's determine whether to keep currently attacked player
                            // in the alliance or not
                            if ($userData['lvl'] > 0 || $this->getSingleFieldTypeCount($member['id'], 18, '>=', 1, $use_cache) >= $minimumExistingEmbassyRecords) {
                                $keepCurrentPlayer = true;
                            } else {
                                $keepCurrentPlayer = false;
                            }

                            // if a new leader was found, notify all alliance member of this change
                            // notify all of them via in-game messaging
                            foreach ($members as $member) {
                                // don't send duplicate messages to the new leader
                                if ($member['id'] != $newleader) {
                                    // also, don't send to the attacked player if we're
                                    // not keeping them in alliance
                                    if ($keepCurrentPlayer || (!$keepCurrentPlayer && $member['id'] != $userData['id']))
                                        $this->sendMessage(
                                            $member['id'],
                                            4,
                                            'Your alliance has a new leader',
                                            (
                                                ($member['id'] == $userData['id'])
                                                ?
                                                $this->escape("Hi, ".$userData['username']."!\n\nThis is to inform you that due to a successful attack that has degraded your last Embassy to a level which is unable to hold all ".$membersCount." alliance members, another alliance member who meets these criteria has been auto-elected as a new alliance leader.\n\nAdditionally - due to the Embassy destruction - you have been forcefuly evicted from your alliance.\n\nPlease re-establish the connection with your alliance by building a new Embassy and contacting <a href=\"spieler.php?uid=".$newleader."\">the new leader</a> for an invitation.\n\nYours sincerely,\n<i>Server Robot :)</i>")
                                                :
                                                $this->escape("Hi, ".$member['username']."!\n\nThis is to inform you that due to a successful attack on your alliance leader's Embassy by another player, <a href=\"spieler.php?uid=".$newleader."\">another alliance member</a> with enough Embassy capacity has been auto-elected as the new alliance leader.\n\nYours sincerely,\n<i>Server Robot :)</i>")
                                                ),
                                            0,
                                            0,
                                            0,
                                            0,
                                            0,
                                            true);
                                }
                            }

                            // evict current player from the alliance
                            // if this was their last Embassy and was completely destroyed
                            if (!$keepCurrentPlayer) {
                                mysqli_query($this->dblink, 'UPDATE '.TB_PREFIX.'users SET alliance = 0 WHERE id = '.$userData['id']);

                                // unset the alliance in session, if we're evicting
                                // currently logged-in player
                                if ($session->uid == $userData['id']) {
                                    $_SESSION['alliance_user'] = 0;
                                }

                                // notify the evicted player
                                $this->sendMessage(
                                    $userData['id'],
                                    4,
                                    'An attack has forced you to leave the alliance',
                                    $this->escape("Hi, ".$userData['username']."!\n\nThis is to inform you that due to a successful attack and destruction of your last Embassy, you have been forced to leave your alliance.\n\nTo re-establish your position in this alliance, you will need to build a new Embassy and ask the <a href=\"spieler.php?uid=".$newleader."\">newly auto-elected leader</a> to send you an invite again.\n\nYours sincerely,\n<i>Server Robot :)</i>"),
                                    0,
                                    0,
                                    0,
                                    0,
                                    0,
                                    true);
                            }
                        }
                    }

                    // execute a method that will delete an alliance
                    // if no members are left in it
                    $this->deleteAlliance($userData['alliance']);

                    return ((isset($newLeaderFound) && $newLeaderFound === true) ? true : false);
                }
            }
        }

	    // no changes in player-to-alliance relationship
	    return true;
	}

	function checkEmbassiesAfterBattle($vid, $current_level, $use_cache = true) {
        $userData = $this->getUserArray($this->getVillageField($vid,"owner"), 1);

        Automation::updateMax($this->getVillageField($vid,"owner"));
        $allianceStatus = $this->checkAllianceEmbassiesStatus([
            'id'       => $userData['id'],
            'alliance' => $userData["alliance"],
            'username' => $userData["username"],
            'lvl'      => $current_level
        ], false, $use_cache);

        if ($allianceStatus === false) {
            return ' This player\'s alliance has been dispersed.';
        } else if ($allianceStatus === 0) {
            return ' Player was forced to leave their alliance.';
        } else {
            // all is good, no need to append additional alliance-related text
            return '';
        }
    }

    private function getBData($wid, $use_cache = true) {
	    $wid = (int) $wid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$buildingsUnderConstructionCache[$wid]) && is_array(self::$buildingsUnderConstructionCache[$wid]) && !count(self::$buildingsUnderConstructionCache[$wid])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$buildingsUnderConstructionCache, $wid)) && !is_null($cachedValue)) {
            return self::$buildingsUnderConstructionCache[$wid];
        }

        $q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid order by master,timestamp ASC";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        self::$buildingsUnderConstructionCache[$wid] = $result;
        return $result;
    }

    // do not cache output, as building jobs can change when using instant build (PLUS) etc.
	function getJobs($wid) {
	    return $this->getBData($wid, false);
	}

	function FinishWoodcutter($wid) {
	    $bdata = $this->getBData($wid);
		$time = time()-1;

		// find our woodcutter
        $dbarray = [];
        foreach ($bdata as $row) {
            if ($row['type'] == 1) {
                $dbarray = $row;
                break;
            }
        }

        // no woodcutters? just return
        if (!count($dbarray)) {
            return;
        }

        // make it complete
		$q = "UPDATE ".TB_PREFIX."bdata SET timestamp = $time WHERE id = ".$dbarray['id'];
		$this->query($q);

		$tribe = $this->getUserField($this->getVillageField($wid, "owner"), "tribe", 0);

		// find first field that's the next one in the loop after our finished woodcutter
		$dbarray2 = [];
        foreach ($bdata as $row) {
            if ($row['loopcon'] == 1 && ($tribe == 1 ? $row['field'] >= 19 : true)) {
                $dbarray2 = $row;
                break;
            }
        }

        // if found, update it's finish time by subtracting the resulting time for our woodcutter,
        // which is now finished
		if (count($dbarray2)){
            $wc_time = $dbarray['timestamp'];
            $q2 = "UPDATE ".TB_PREFIX."bdata SET timestamp = timestamp - $wc_time WHERE id = ".$dbarray2['id'];
            $this->query($q2);
		}
	}

	function getMasterJobs($wid) {
	    // cache data
        $bdata = $this->getBData($wid);

        // return all master jobs
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 1) {
                $data[] = $row;
            }
        }

		return $data;
	}

	function getMasterJobsByField($wid,$field) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all master jobs for the requested field
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 1 && $row['field'] == $field) {
                $data[] = $row;
            }
        }

        return $data;
	}

	function getBuildingByField($wid,$field) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all non-master jobs for the requested field
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 0 && $row['field'] == $field) {
                $data[] = $row;
            }
        }

        return $data;
	}

    // no need to cache this method
	function getBuildingByField2($wid,$field) {
	    list($wid,$field) = $this->escape_input((int) $wid,(int) $field);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "bdata where wid = $wid and field = $field and master = 0";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		return $result['Total'];
	}

	function getBuildingByType($wid,$type) {
        // cache data
        $bdata = $this->getBData($wid);
        $type = (strpos($type, ',') === false ? [(int) $type] : explode(',', str_replace(' ', '', $this->escape($type))));

        // return all jobs which are of the requested type
        $data = [];
        foreach ($bdata as $row) {
            if (in_array($row['field'], $type)) {
                $data[] = $row;
            }
        }

        return $data;
	}

	function getBuildingByType2($wid,$type) {
	    $wid = (int) $wid;

	    if (!is_array($type)) {
	        $type = [$type];
        } else {
	        foreach ($type as $index => $typeValue) {
	            $type[$index] = (int) $typeValue;
            }
        }

		$q = "SELECT CONCAT(type, \"=\", Count(type)) FROM " . TB_PREFIX . "bdata where wid = $wid and type IN(".implode(', ', $type).") and master = 0 GROUP BY type";
		$result = mysqli_query($this->dblink, $q);
		$newresult = [];

		if (mysqli_num_rows($result)) {
		    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		        if ($row[0]) {
                    $val                  = explode( '=', $row[0] );
                    $newresult[ $val[0] ] = $val[1];
                }
            }

            $result = $newresult;

        } else {
		    $result = [];
        }

		return $result;
	}

	function getDorf1Building($wid) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all non-master jobs for field type under 19
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 0 && $row['field'] < 19) {
                $data[] = $row;
            }
        }

        return $data;
	}

	function getDorf2Building($wid) {
        // cache data
        $bdata = $this->getBData($wid);

        // return all non-master jobs for field type above 18
        $data = [];
        foreach ($bdata as $row) {
            if ($row['master'] == 0 && $row['field'] > 18) {
                $data[] = $row;
            }
        }

        return $data;
	}

	function updateBuildingWithMaster($id, $time,$loop) {
	    list($id, $time,$loop) = $this->escape_input((int) $id, (int) $time,(int) $loop);

		$q = "UPDATE " . TB_PREFIX . "bdata SET master = 0, timestamp = ".$time.",loopcon = ".$loop." WHERE id = ".$id."";
		return mysqli_query($this->dblink,$q);
	}

	function getVillageByName($name, $use_cache = true) {
        return $this->getVillage($name, 1, $use_cache)['wref'];
	}

    function getVillageByOwner($uid, $use_cache = true) {
        $uid = (int) $uid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageDataByOwnerCache, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $q = 'SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $uid . ' LIMIT 1';
        $result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);

        self::$villageDataByOwnerCache[$uid] = $result;
        return self::$villageDataByOwnerCache[$uid];
    }

	/***************************
	Function to set accept flag on market
	References: id
	***************************/
	function setMarketAcc($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $value) {
            $id[$index] = (int) $value;
        }

		$q = "UPDATE " . TB_PREFIX . "market set accept = 1 where id IN(".implode(', ', $id ).")";
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to send resource to other village
	Mode 0: Send
	Mode 1: Cancel
	References: Wood/ID, Clay, Iron, Crop, Mode
	***************************/
	function sendResource($ref, $clay, $iron, $crop, $merchant, $mode) {
	    // always prepare for multiple inserts at once
	    if (!is_array($ref)) {
	        $ref = [$ref];
	        $clay = [$clay];
	        $iron = [$iron];
	        $crop = [$crop];
	        $merchant = [$merchant];
        }

        $pairs = [];
        foreach ($ref as $index => $refValue) {
            if(!$mode) {
                $pairs[] = '(0, ' . (int) $refValue . ', ' . (int) $clay[$index] . ', ' . (int) $iron[$index] . ', ' . (int) $crop[$index] . ', ' . (int) $merchant[$index] . ')';
            } else {
                $pairs[] = (int) $refValule;
            }
        }

		if(!$mode) {
			$q = "INSERT INTO " . TB_PREFIX . "send VALUES ".implode(', ', $pairs);
			mysqli_query($this->dblink,$q);
			return mysqli_insert_id($this->dblink);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "send WHERE id IN(".implode(', ', $pairs).")";
			return mysqli_query($this->dblink,$q);
		}
	}

	/***************************
	Function to get resources back if you delete offer
	References: VillageRef (vref)
	Made by: Dzoki
	***************************/

	function getResourcesBack($vref, $gtype, $gamt) {
	    list($vref, $gtype, $gamt) = $this->escape_input((int) $vref, (int) $gtype, (int) $gamt);

		//Xtype (1) = wood, (2) = clay, (3) = iron, (4) = crop
		if($gtype == 1) {
			$q = "UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` + $gamt WHERE wref = $vref";
			return mysqli_query($this->dblink,$q);
		} else
			if($gtype == 2) {
				$q = "UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` + $gamt WHERE wref = $vref";
				return mysqli_query($this->dblink,$q);
			} else
				if($gtype == 3) {
					$q = "UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` + $gamt WHERE wref = $vref";
					return mysqli_query($this->dblink,$q);
				} else
					if($gtype == 4) {
						$q = "UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` + $gamt WHERE wref = $vref";
						return mysqli_query($this->dblink,$q);
					}
	}

	/***************************
	Function to get info about offered resources
	References: VillageRef (vref)
	Made by: Dzoki
	***************************/

	function getMarketField($vref, $field, $use_cache = true) {
        list($vref, $field) = $this->escape_input($vref, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$marketFieldCache, $vref.$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "market where vref = '$vref' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

        self::$marketFieldCache[$vref.$field] = $dbarray[$field];
        return self::$marketFieldCache[$vref.$field];
	}

	function removeAcceptedOffer($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "market where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	/***************************
	Function to add market offer
	Mode 0: Add
	Mode 1: Cancel
	References: Village, Give, Amt, Want, Amt, Time, Alliance, Mode
	***************************/
	function addMarket($vid, $gtype, $gamt, $wtype, $wamt, $time, $alliance, $merchant, $mode) {
	    list($vid, $gtype, $gamt, $wtype, $wamt, $time, $alliance, $merchant, $mode) = $this->escape_input((int) $vid, (int) $gtype, (int) $gamt, (int) $wtype, (int) $wamt, (int) $time, (int) $alliance, (int) $merchant, $mode);

		if(!$mode) {
			$q = "INSERT INTO " . TB_PREFIX . "market values (0,$vid,$gtype,$gamt,$wtype,$wamt,0,$time,$alliance,$merchant)";
			mysqli_query($this->dblink,$q);
			return mysqli_insert_id($this->dblink);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "market where id = $gtype and vref = $vid";
			return mysqli_query($this->dblink,$q);
		}
	}

	/***************************
	Function to get market offer
	References: Village, Mode
	***************************/
    // no need to cache this method
	function getMarket($vid, $mode) {
	    list($vid, $mode) = $this->escape_input((int) $vid, $mode);

	    $alliance = (int) $this->getUserField($this->getVillageField($vid, "owner"), "alliance", 0);
		if(!$mode) {
			$q = "SELECT * FROM " . TB_PREFIX . "market where vref = $vid and accept = 0";
		} else {
			$q = "SELECT * FROM " . TB_PREFIX . "market where vref != $vid and alliance = $alliance or vref != $vid and alliance = 0 and accept = 0";
		}
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	/***************************
	Function to get market offer
	References: ID
	***************************/
    // no need to cache this method
	function getMarketInfo($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "market where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	function setMovementProc($moveid) {
        if (!Math::isInt($moveid)) {
            list($moveid) = $this->escape_input($moveid);
        }

        // rather than re-selecting data and updating cache here, let's just
        // flush the cache and let it re-cach itself as neccessary
        self::$marketMovementCache = [];

		$q = "UPDATE " . TB_PREFIX . "movement set proc = 1 where moveid IN($moveid)";
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to retrieve used merchant
	References: Village
	***************************/
	function totalMerchantUsed($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$merchantsUseCountCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        self::$merchantsUseCountCache[$vid] = mysqli_fetch_array(mysqli_query($this->dblink, '
            SELECT
                IFNULL((SELECT sum('.TB_PREFIX.'send.merchant) FROM '.TB_PREFIX.'send, '.TB_PREFIX.'movement WHERE '.TB_PREFIX.'movement.`from` = '.$vid.' AND '.TB_PREFIX.'send.id = '.TB_PREFIX.'movement.ref AND '.TB_PREFIX.'movement.proc = 0 AND sort_type = 0), 0) +
                IFNULL((SELECT sum(ref) FROM '.TB_PREFIX.'movement WHERE sort_type = 2 AND '.TB_PREFIX.'movement.`to` = '.$vid.' AND proc = 0), 0) +
                IFNULL((SELECT sum(merchant) FROM '.TB_PREFIX.'market WHERE vref = '.$vid.' AND accept = 0), 0)
            as merchants_used'
        ), MYSQLI_ASSOC)['merchants_used'];

        return self::$merchantsUseCountCache[$vid];
	}

	function getMovement($type, $village, $mode, $use_cache = true) {
        $array_passed = is_array($village);

        if (!$array_passed) {
            $village = [(int) $village];
        } else {
            foreach ($village as $index => $villageValue) {
                $village[$index] = (int) $villageValue;
            }
        }

        if (!count($village)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$marketMovementCache[$type.$village[0].$mode]) && is_array(self::$marketMovementCache[$type.$village[0].$mode]) && !count(self::$marketMovementCache[$type.$village[0].$mode])) {
            return self::$marketMovementCache[$type.$village[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newIDs = [];
            foreach ($village as $key) {
                if (!isset(self::$marketMovementCache[$type.$key.$mode])) {
                    $newIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newIDs)) {
                return self::$marketMovementCache;
            } else {
                // update remaining IDs to select and cache
                $village = $newIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$marketMovementCache, $type.$village[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return ($array_passed ? self::$marketMovementCache: $cachedValue);
        }

		$time = time();
		if(!$mode) {
			$where = "from";
		} else {
			$where = "to";
		}
		switch($type) {
			case 0:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "send where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "send.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 0 ORDER BY endtime ASC";
				break;
			case 1:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "send where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "send.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 6 ORDER BY endtime ASC";
				break;
			case 2:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 2 ORDER BY endtime ASC";
				break;
			case 3:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				break;
			case 4:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 4 ORDER BY endtime ASC";
				break;
			case 5:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and sort_type = 5 and proc = 0 ORDER BY endtime ASC";
				break;
			case 6:
				$q = "SELECT * FROM " . TB_PREFIX . "movement," . TB_PREFIX . "odata, " . TB_PREFIX . "attacks where " . TB_PREFIX . "odata.wref IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.to IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "attacks.attack_type != 1 and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				//$q = "SELECT * FROM " . TB_PREFIX . "movement," . TB_PREFIX . "odata, " . TB_PREFIX . "attacks where " . TB_PREFIX . "odata.conqured IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.to = " . TB_PREFIX . "odata.wref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				break;
			case 7:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC";
				break;
			case 8:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 1 ORDER BY endtime ASC";
				break;
			case 34:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 or " . TB_PREFIX . "movement.`" . $where . "` IN(".implode(', ', $village).") and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 4 ORDER BY endtime ASC";
				break;
			default:
				return null;
		}

		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$marketMovementCache[$type.$village[0].$mode] = $result;
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$marketMovementCache[ $type . $record[ $where ] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no movements were found for these villages
            foreach ($village as $key) {
                if (!isset(self::$marketMovementCache[$type.$key.$mode])) {
                    self::$marketMovementCache[$type.$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$marketMovementCache : self::$marketMovementCache[$type.$village[0].$mode]);
	}

	function addA2b($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type) {
	    list($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type) = $this->escape_input($ckey, (int) $timestamp, (int) $to, (int) $t1, (int) $t2, (int) $t3, (int) $t4, (int) $t5, (int) $t6, (int) $t7, (int) $t8, (int) $t9, (int) $t10, (int) $t11, (int) $type);

		$q = "INSERT INTO " . TB_PREFIX . "a2b (ckey,time_check,to_vid,u1,u2,u3,u4,u5,u6,u7,u8,u9,u10,u11,type) VALUES ('$ckey', '$timestamp', '$to', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$type')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

    function remA2b($id) {
        $id = (int) $id;

        $q = "DELETE FROM " . TB_PREFIX . "a2b WHERE id = $id";
        return mysqli_query($this->dblink,$q);
    }

	// no need to cache this method
	function getA2b($ckey, $check) {
        list($ckey, $check) = $this->escape_input($ckey, $check);

		$q = "SELECT * from " . TB_PREFIX . "a2b where ckey = '" . $ckey . "' AND time_check = '" . $check . "'";
		$result = mysqli_query($this->dblink,$q);
		if($result) {
			return mysqli_fetch_assoc($result);
		} else {
			return false;
		}
	}

	function addMovement($type, $from, $to, $ref, $time, $endtime, $send = 1, $wood = 0, $clay = 0, $iron = 0, $crop = 0, $ref2 = 0) {
        // always prepare for multiple inserts at once
        if (!is_array($type)) {
            $type = [$type];
            $from = [$from];
            $to = [$to];
            $ref = [$ref];
            $time = [$time];
            $endtime = [$endtime];
            $send = [$send];
            $wood = [$wood];
            $clay = [$clay];
            $iron = [$iron];
            $crop = [$crop];
            $ref2 = [$ref2];
        }

        $counter = 0;
        $pairs = [];

        foreach ($type as $index => $typeValue) {
            $pairs[] = '(0, '.(int) $typeValue.', '.(int) $from[$index].', '.(int) $to[$index].', '.(int) $ref[$index].', '.(int) $ref2[$index].', '.(int) $time[$index].', '.(int) $endtime[$index].', 0, '.(int) $send[$index].', '.(int) $wood[$index].', '.(int) $clay[$index].', '.(int) $iron[$index].', '.(int) $crop[$index].')';

            if ($counter++ > 25) {
                $q = "INSERT INTO " . TB_PREFIX . "movement VALUES ".implode(', ', $pairs);
                mysqli_query($this->dblink,$q);

                $pairs = [];
                $counter = 0;
            }
        }

        if ($counter > 0) {
            $q = "INSERT INTO " . TB_PREFIX . "movement VALUES " . implode( ', ', $pairs );
            return mysqli_query( $this->dblink, $q );
        } else {
            return true;
        }
	}

	function addAttack($vid, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type, $ctar1, $ctar2, $spy,$b1=0,$b2=0,$b3=0,$b4=0,$b5=0,$b6=0,$b7=0,$b8=0) {
	    if (!is_array($vid)) {
	        $vid = [$vid];
	        $t1 = [$t1];
            $t2 = [$t2];
            $t3 = [$t3];
            $t4 = [$t4];
            $t5 = [$t5];
            $t6 = [$t6];
            $t7 = [$t7];
            $t8 = [$t8];
            $t9 = [$t9];
            $t10 = [$t10];
            $t11 = [$t11];
            $type = [$type];
            $ctar1 = [$ctar1];
            $ctar2 = [$ctar2];
            $spy = [$spy];
            $b1 = [$b1];
            $b2 = [$b2];
            $b3 = [$b3];
            $b4 = [$b4];
            $b5 = [$b5];
            $b6 = [$b6];
            $b7 = [$b7];
            $b8 = [$b8];
        }

        $values = [];
        foreach ($vid as $index => $vidValue) {
            $values[] = '(0, '.(int) $vidValue.', '.(int) $t1[$index].', '.(int) $t2[$index].', '.(int) $t3[$index].', '.
                        (int) $t4[$index].', '.(int) $t5[$index].', '.(int) $t6[$index].', '.(int) $t7[$index].', '.
                        (int) $t8[$index].', '.(int) $t9[$index].', '.(int) $t10[$index].', '.(int) $t11[$index].
                        ', '.(int) $type[$index].', '.(int) $ctar1[$index].', '.(int) $ctar2[$index].', '.
                        (int) $spy[$index].', '.(int) $b1[$index].', '.(int) $b2[$index].', '.(int) $b3[$index].
                        ', '.(int) $b4[$index].', '.(int) $b5[$index].', '.(int) $b6[$index].', '.(int) $b7[$index].
                        ', '.(int) $b8[$index].')';
        }

		$q = "INSERT INTO " . TB_PREFIX . "attacks VALUES ".implode(', ', $values);
		mysqli_query($this->dblink,$q);

		return (count($vid) == 1 ? mysqli_insert_id($this->dblink) : true);
	}

	function modifyAttack($aid, $unit, $amt) {
	    list($aid, $unit, $amt) = $this->escape_input((int) $aid, $unit, (int) $amt);

		$unit = 't' . $unit;
		$q = "UPDATE " . TB_PREFIX . "attacks set $unit = $unit - $amt where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyAttack2($aid, $unit, $amt) {
	    list($aid, $unit, $amt) = $this->escape_input((int) $aid, $unit, $amt);

	    if (!is_array($unit)) {
	        $unit = [$unit];
	        $amt = [$amt];
        }

        $pairs = [];
	    foreach ($unit as $index => $unitValue) {
	        $unitValue = 't' . $this->escape($unitValue);
            $pairs[] = $unitValue . ' = ' . $unitValue . ' + ' . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "attacks SET ".implode(', ', $pairs)." WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyAttack3($aid, $units) {
	    list($aid, $units) = $this->escape_input((int) $aid, $units);

        $q = "UPDATE ".TB_PREFIX."attacks set $units WHERE id = $aid";
        return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
	function getVRanking() {
	    $q = "SELECT v.wref,v.name,v.owner,v.pop FROM " . TB_PREFIX . "vdata AS v," . TB_PREFIX . "users AS u WHERE v.owner=u.id AND u.tribe IN(1,2,3".(SHOW_NATARS ? ',5' : '').") AND v.wref != '' AND u.access<" . (INCLUDE_ADMIN ? "10" : "8");
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getARanking($use_cache = true) {
        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceRankingCache, 0)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT id,name,tag,oldrank,Aap,Adp FROM " . TB_PREFIX . "alidata where id != '' ORDER BY id DESC";
		$result = mysqli_query($this->dblink,$q);

        self::$allianceRankingCache[0] = $this->mysqli_fetch_all($result);
        return self::$allianceRankingCache[0];
	}

    // no need to cache this method
	function getUserByTribe($tribe) {
	    list($tribe) = $this->escape_input((int) $tribe);
		$q = "SELECT * FROM " . TB_PREFIX . "users where tribe = $tribe";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getUserByAlliance($aid) {
	    list($aid) = $this->escape_input((int) $aid);
		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getHeroRanking() {
		$q = "SELECT * FROM " . TB_PREFIX . "hero WHERE dead = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getAllMember($aid, $limit = 0, $use_cache = true) {
	    list($aid) = $this->escape_input((int) $aid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceMembersCache, $aid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid order  by (SELECT sum(pop) FROM " . TB_PREFIX . "vdata WHERE owner =  " . TB_PREFIX . "users.id) desc, " . TB_PREFIX . "users.id desc".($limit > 0 ? ' LIMIT '.(int) $limit : '');
		$result = mysqli_query($this->dblink,$q);

        self::$allianceMembersCache[$aid] = $this->mysqli_fetch_all($result);
        return self::$allianceMembersCache[$aid];
	}

	function getAllMember2($aid) {
	    return $this->getAllMember($aid, 1);
	}

	function addUnits($vid) {
	    if (!is_array($vid)) {
	        $vid = [$vid];
        }

        foreach ($vid as $index => $vidValue) {
	        $vid[$index] = (int) $vidValue;
        }

		$q = "INSERT into " . TB_PREFIX . "units (vref) values (".implode(', ', $vid).")";
		return mysqli_query($this->dblink,$q);
	}

	function getUnit($vid, $use_cache = true) {
	    $array_passed = is_array($vid);

        if (!$array_passed) {
            $singleVillage = true;
            $vid = [$vid];
        } else {
            foreach ($vid as $index => $vidValue) {
                $vid[$index] = (int) $vidValue;
            }
        }

        $returnArray = [];

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$unitsCache, (int) $vid[0])) && !is_null($cachedValue)) {
            return $cachedValue;
        } else if ($use_cache && $array_passed) {
            $newIDs = [];
            foreach ($vid as $villageID) {
                // don't cache what we don't need to cache
                if (isset(self::$unitsCache[$villageID])) {
                    $returnArray[$villageID] = self::$unitsCache[$villageID];
                } else {
                    // add the uncached ID, so we can select and cache it
                    $newIDs[] = $villageID;
                }
            }
            $vid = $newIDs;

            // nothing to cache? return what we have
            if (!count($vid)) {
                return $returnArray;
            }
        }

		$q = "SELECT * from " . TB_PREFIX . "units where vref IN(".implode(', ', $vid).")";
		$result = mysqli_query($this->dblink,$q);
		$resCount = 0;
		$vidCount = count($vid);

		if (!empty($result) && ($resCount = mysqli_num_rows($result)) && $resCount) {
		    while ($row = mysqli_fetch_assoc($result)) {
                self::$unitsCache[$row['vref']] = $row;
                $returnArray[$row['vref']] = $row;
            }
		} else {
		    // fill everything with nulls
		    foreach ($vid as $id) {
                self::$unitsCache[$id] = null;
                $returnArray[$id] = null;
            }
		}

		// check if we're not missing any return values
        if ($vidCount != $resCount) {
		    // fill-in the gaps, as it would mean some of the IDs we got were not found
            // (which is super-strange, but it's still a mathematical possibility)
            foreach ($vid as $id) {
                if (!isset($returnArray[$id])) {
                    $returnArray[$id] = null;
                }
            }
        }

		return (!isset($singleVillage) ? $returnArray : reset($returnArray));
	}

    // no need to cache this method
	function getUnitsNumber($vid, $use_cache = false) {
        list( $vid ) = $this->escape_input( (int) $vid );

        $dbarray     = $this->getUnit( $vid );
        $totalunits  = 0;
        $movingunits = $this->getVillageMovement( $vid );
        for ( $i = 1; $i <= 50; $i ++ ) {
            $totalunits += $dbarray[ 'u' . $i ];
        }

        $totalunits       += $dbarray['hero'];
        $movingunits      = $this->getVillageMovement( $vid );
        $reinforcingunits = $this->getEnforceArray( $vid, 1 );
        $owner            = $this->getVillageField( $vid, "owner" );
        $ownertribe       = $this->getUserField( $owner, "tribe", 0 );
        $start            = ( $ownertribe - 1 ) * 10 + 1;
        $end              = ( $ownertribe * 10 );

        for ( $i = $start; $i <= $end; $i ++ ) {
            $totalunits += $movingunits[ 'u' . $i ];
            $totalunits += $reinforcingunits[ 'u' . $i ];
        }

        $totalunits += $movingunits['hero'];
        $totalunits += $reinforcingunits['hero'];

		return $totalunits;
	}

	function getHero($uid=0, $all=0, $include_dead = false, $use_cache = true) {
	    list($uid,$all) = $this->escape_input((int) $uid,$all);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$heroCache, $uid.$all.($include_dead ? 1 : 0))) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		if ($all) {
			$q = "SELECT * FROM ".TB_PREFIX."hero WHERE uid=$uid ORDER BY lastupdate DESC";
		} elseif (!$uid) {
			$q = "SELECT * FROM ".TB_PREFIX."hero";
		} else {
			$q = "SELECT * FROM ".TB_PREFIX."hero WHERE ".($include_dead ? '' : "dead=0 AND ")."uid=$uid LIMIT 1";
		}

		$result = mysqli_query($this->dblink,$q);
		if (!empty($result)) {
            self::$heroCache[$uid.$all.($include_dead ? 1 : 0)] = $this->mysqli_fetch_all($result);
		} else {
            self::$heroCache[$uid.$all.($include_dead ? 1 : 0)] = null;
		}

		return self::$heroCache[$uid.$all.($include_dead ? 1 : 0)];
	}

	function getHeroField($uid,$field, $use_cache = true) {
	    list($uid,$field) = $this->escape_input((int) $uid,$field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$heroFieldCache, $uid.$field)) && !is_null($cachedValue)) {
            return $cachedValue[$field];
        }

        $q = "SELECT * FROM ".TB_PREFIX."hero WHERE uid = $uid AND dead = 0";
        $result = mysqli_query($this->dblink,$q);

        self::$heroFieldCache[$uid.$field] = $this->mysqli_fetch_all($result)[0];
        return self::$heroFieldCache[$uid.$field][$field];
	}

	function modifyHero($column,$value,$heroid,$mode=null) {
	    if (!is_array($column)) {
	        $column = [$column];
	        $value = [$value];
	        $mode = [$mode];
        }

        $pairs = [];
	    foreach ($column as $index => $columnValue) {
            if($mode[$index] === null) {
                $pairs[] = "$columnValue = ".(Math::isInt($value[$index]) ? $value[$index] : '"'.$this->escape($value[$index]).'"');
            } elseif($mode[$index]=1) {
                $pairs[] = "$columnValue = $columnValue + ".(int) $value[$index];
            } else {
                $pairs[] = "$columnValue = $columnValue - ".(int) $value[$index];
            }
        }

        $q = "UPDATE `".TB_PREFIX."hero` SET ".implode(', ', $pairs)." WHERE heroid = $heroid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyHeroXp($column,$value,$heroid) {
	    list($column,$value,$heroid) = $this->escape_input($column,(int) $value,(int) $heroid);

		$q = "UPDATE ".TB_PREFIX."hero SET $column = $column + $value WHERE uid=$heroid";
		return mysqli_query($this->dblink,$q);
	}

	function addTech($vid) {
        if (!is_array($vid)) {
            $vid = [$vid];
        }

        foreach ($vid as $index => $vidValue) {
            $vid[$index] = (int) $vidValue;
        }

		$q = "INSERT INTO " . TB_PREFIX . "tdata (vref) VALUES (".implode(', ', $vid).")";
		return mysqli_query($this->dblink,$q);
	}

	function addABTech($vid) {
        if (!is_array($vid)) {
            $vid = [$vid];
        }

        foreach ($vid as $index => $vidValue) {
            $vid[$index] = (int) $vidValue;
        }

        self::$abTechCache = [];
		$q = "INSERT INTO " . TB_PREFIX . "abdata (vref) VALUES (".implode(', ', $vid).")";
		return mysqli_query($this->dblink,$q);
	}

	function getABTech($vid, $use_cache = true) {
        $array_passed = is_array($vid);

        if (!$array_passed) {
            $vid = [(int) $vid];
        } else {
            foreach ($vid as $index => $ivdValue) {
                $vid[$index] = (int) $ivdValue;
            }
        }

        if (!count($vid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$abTechCache[$vid[0]]) && is_array(self::$abTechCache[$vid[0]]) && !count(self::$abTechCache[$vid[0]])) {
            return self::$abTechCache[$vid[0]];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newVIDs = [];
            foreach ($vid as $key) {
                if (!isset(self::$abTechCache[$key])) {
                    $newVIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newVIDs)) {
                return self::$abTechCache;
            } else {
                // update remaining IDs to select and cache
                $vid = $newVIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$abTechCache, $vid[0])) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "abdata where vref IN(".implode(', ', $vid).")";
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$abTechCache[$vid[0]] = $result[0];
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$abTechCache[ $record['vref']] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($vid as $key) {
                if (!isset(self::$abTechCache[$key])) {
                    self::$abTechCache[$key] = [];
                }
            }
        }

        return ($array_passed ? self::$abTechCache : self::$abTechCache[$vid[0]]);
	}

	function addResearch($vid, $tech, $time) {
	    list($vid, $tech, $time) = $this->escape_input((int) $vid, $tech, (int) $time);

        self::$researchingCache = [];
		$q = "INSERT into " . TB_PREFIX . "research values (0,$vid,'$tech',$time)";
		return mysqli_query($this->dblink,$q);
	}

	function getResearching($vid, $use_cache = true) {
        $vid = (int) $vid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$researchingCache[$vid]) && is_array(self::$researchingCache[$vid]) && !count(self::$researchingCache[$vid])) {
            return self::$researchingCache[$vid];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$researchingCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "research where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
        $researchingCache[$vid] = $this->mysqli_fetch_all($result);
        return $researchingCache[$vid];
	}

	function checkIfResearched($vref, $unit, $use_cache = true) {
	    list($vref, $unit) = $this->escape_input((int) $vref, $unit);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$isResearchedCache, $vref)) && !is_null($cachedValue)) {
            return $cachedValue[$unit];
        }

		$q = "SELECT * FROM " . TB_PREFIX . "tdata WHERE vref = $vref LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result, MYSQLI_ASSOC);

        self::$isResearchedCache[$vref] = $dbarray;
        return self::$isResearchedCache[$vref][$unit];
	}

	function getTech($vid) {
	    // this is a somewhat non-ideal, externally non-changeable way of caching
        // but since we're only ever going to be calling this from Village constructor
        // for our current village, this will more than suffice
	    static $cachedData = [];
	    $vid = (int) $vid;

	    if (isset($cachedData[$vid])) {
            return $cachedData[$vid];
        }

		$q = "SELECT * from " . TB_PREFIX . "tdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
        $cachedData[$vid] = mysqli_fetch_assoc($result);

        return $cachedData[$vid];
	}

    // no need to cache this method
	function getTraining($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "training where vref = $vid ORDER BY id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function trainUnit($vid, $unit, $amt, $pop, $each, $time, $mode) {
	    list($vid, $unit, $amt, $pop, $each, $time, $mode) = $this->escape_input((int) $vid, (int) $unit, (int) $amt, (int) $pop, (int) $each, (int) $time, $mode);

		global $village, $building, $session, $technology;

		if(!$mode) {
			$barracks = array(1,2,3,11,12,13,14,21,22,31,32,33,34,35,36,37,38,39,40,41,42,43,44);
			// fix by brainiac - THANK YOU
			$greatbarracks = array(61,62,63,71,72,73,74,81,82,91,92,93,94,95,96,97,98,99,100,101,102,103,104);
			$stables = array(4,5,6,15,16,23,24,25,26,45,46);
			$greatstables = array(64,65,66,75,76,83,84,85,86,105,106);
			$workshop = array(7,8,17,18,27,28,47,48);
			$greatworkshop = array(67,68,77,78,87,88,107,108);
			$residence = array(9,10,19,20,29,30,49,50);
			$trapper = array(99);

			if(in_array($unit, $barracks)) {
				$queued = $technology->getTrainingList(1);
			} elseif(in_array($unit, $stables)) {
				$queued = $technology->getTrainingList(2);
			} elseif(in_array($unit, $workshop)) {
				$queued = $technology->getTrainingList(3);
			} elseif(in_array($unit, $residence)) {
				$queued = $technology->getTrainingList(4);
			} elseif(in_array($unit, $greatstables)) {
				$queued = $technology->getTrainingList(6);
			} elseif(in_array($unit, $greatbarracks)) {
				$queued = $technology->getTrainingList(5);
			} elseif(in_array($unit, $greatworkshop)) {
				$queued = $technology->getTrainingList(7);
			} elseif(in_array($unit, $trapper)) {
				$queued = $technology->getTrainingList(8);
			}
			$now = time();

            $uid       = $this->getVillageField( $vid, "owner" );
            $artefact  = count( $this->getOwnUniqueArtefactInfo2( $uid, 5, 3, 0 ) );
            $artefact1 = count( $this->getOwnUniqueArtefactInfo2( $vid, 5, 1, 1 ) );
            $artefact2 = count( $this->getOwnUniqueArtefactInfo2( $uid, 5, 2, 0 ) );
            if ( $artefact > 0 ) {
                $time = $now + round( ( $time - $now ) / 2 );
                $each /= 2;
                $each = round( $each );
            } else if ( $artefact1 > 0 ) {
                $time = $now + round( ( $time - $now ) / 2 );
                $each /= 2;
                $each = round( $each );
            } else if ( $artefact2 > 0 ) {
                $time = $now + round( ( $time - $now ) / 4 * 3 );
                $each /= 4;
                $each = round( $each );
                $each *= 3;
                $each = round( $each );
            }
            $foolartefact = $this->getFoolArtefactInfo( 5, $vid, $uid );
            if ( count( $foolartefact ) > 0 ) {
                foreach ( $foolartefact as $arte ) {
                    if ( $arte['bad_effect'] == 1 ) {
                        $each *= $arte['effect2'];
                    } else {
                        $each /= $arte['effect2'];
                        $each = round( $each );
                    }
                }
            }
            if ( $each == 0 ) {
                $each = 1;
            }
            $time2 = $now + $each;
            if ( count( $queued ) > 0 ) {
                $time  += $queued[ count( $queued ) - 1 ]['timestamp'] - $now;
                $time2 += $queued[ count( $queued ) - 1 ]['timestamp'] - $now;
            }
	// TROOPS MAKE SUM IN BARAKS , ETC
	//if($queued[count($queued) - 1]['unit'] == $unit){
	//$time = $amt*$queued[count($queued) - 1]['eachtime'];
	//$q = "UPDATE " . TB_PREFIX . "training SET amt = amt + $amt, timestamp = timestamp + $time WHERE id = ".$queued[count($queued) - 1]['id']."";
	//}else{
			$q = "INSERT INTO " . TB_PREFIX . "training values (0,$vid,$unit,$amt,$pop,$time,$each,$time2)";
	//}
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "training where id = $vid";
		}
		return mysqli_query($this->dblink,$q);
	}

	function updateTraining($id, $trained, $each) {
	    list($id, $trained, $each) = $this->escape_input((int) $id, (int) $trained, (int) $each);

		$q = "UPDATE " . TB_PREFIX . "training set amt = amt - $trained, timestamp2 = timestamp2 + $each where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function modifyUnit($vref, $array_unit, $array_amt, $array_mode) {
	    list($vref, $array_unit, $array_amt, $array_mode) = $this->escape_input((int) $vref, $array_unit, $array_amt, $array_mode);
		$i = -1;
		$units='';
		$number = count($array_unit);
		foreach($array_unit as $unit){
			if($unit == 230){$unit = 30;}
			if($unit == 231){$unit = 31;}
			if($unit == 120){$unit = 20;}
			if($unit == 121){$unit = 21;}
			if($unit =="hero"){$unit = 'hero';}
			else{$unit = 'u' . $unit;}

            ++$i;
            //Fixed part of negativ troops (double troops) - by InCube
            $array_amt[$i] = (int) $array_amt[$i] < 0 ? 0 : $array_amt[$i];
            //Fixed part of negativ troops (double troops) - by InCube
            $units .= $unit.' = '.$unit.' '.(($array_mode[$i] == 1)? '+':'-').'  '.($array_amt[$i] ? $array_amt[$i] : 0).(($number > $i+1) ? ', ' : '');
		}
		$q = "UPDATE ".TB_PREFIX."units set $units WHERE vref = $vref";
		return mysqli_query($this->dblink,$q);
	}

	function getEnforce($vid, $from, $use_cache = true) {
	    $array_passed = is_array($vid);
	    if (!$array_passed) {
	        $vid = [$vid];
	        $from = [$from];
        } else {
            foreach ($vid as $index => $vidValue) {
                $vid[$index] = (int) $vidValue;
                $from[$index] = (int) $from[$index];
            }
        }

        if (!count($vid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$villageFromReinforcementsCache[$vid[0].$from[0]]) && is_array(self::$villageFromReinforcementsCache[$vid[0].$from[0]]) && !count(self::$villageFromReinforcementsCache[$vid[0].$from[0]])) {
            return $cachedValue;
        }  else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newVIDs = [];
            $newFROMs = [];
            foreach ($vid as $index => $vidValue) {
                if (!isset(self::$villageFromReinforcementsCache[$vidValue.$from[$index]])) {
                    $newVIDs[] = $vidValue;
                    $newFROMs[] = $from[$index];
                }
            }

            // everything's cached, just return the cache
            if (!count($newVIDs)) {
                return self::$villageFromReinforcementsCache;
            } else {
                // update remaining IDs to select and cache
                $vid = $newVIDs;
                $from = $newFROMs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$villageFromReinforcementsCache, $vid[0].$from[0])) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        // build SELECT pairs
        $pairs = [];
        foreach ($vid as $index => $vidValue) {
            $pairs[] = '(`from` = '.(int) $vidValue.' AND vref = '.(int) $from[$index].')';
        }

		$q = "SELECT * FROM " . TB_PREFIX . "enforcement WHERE ".implode(' OR ', $pairs);
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$villageFromReinforcementsCache[$vid[0].$from[0]] = $result[0];
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$villageFromReinforcementsCache[ $record['from'] . $record['vref'] ] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($vid as $index => $vidValue) {
                if (!isset(self::$villageFromReinforcementsCache[$vidValue.$from[$index]])) {
                    self::$villageFromReinforcementsCache[$vidValue.$from[$index]] = [];
                }
            }
        }

        return ($array_passed ? self::$villageFromReinforcementsCache : self::$villageFromReinforcementsCache[$vid[0].$from[0]]);
	}

    function getOasisEnforce($ref, $mode=0, $use_cache = true) {
        $array_passed = is_array($ref);
        $mode = (int) $mode;

        if (!$array_passed) {
            $ref = [(int) $ref];
        } else {
            foreach ($ref as $index => $refValue) {
                $ref[$index] = (int) $refValue;
            }
        }

        if (!count($ref)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$oasisReinforcementsCache[$ref[0].$mode]) && is_array(self::$oasisReinforcementsCache[$ref[0].$mode]) && !count(self::$oasisReinforcementsCache[$ref[0].$mode])) {
            return self::$oasisReinforcementsCache[$ref[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newREFs = [];
            foreach ($ref as $key) {
                if (!isset(self::$oasisReinforcementsCache[$key.$mode])) {
                    $newREFs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newREFs)) {
                return self::$oasisReinforcementsCache;
            } else {
                // update remaining IDs to select and cache
                $ref = $newREFs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$oasisReinforcementsCache, $ref[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.conqured IN(".implode(', ', $ref).") AND e.from NOT IN(".implode(', ', $ref).")";
        }else if ($mode == 1) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.conqured IN(".implode(', ', $ref).")";
        } else if ($mode == 2) {
            $q = "SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref where o.conqured IN(".implode(', ', $ref).") AND o.owner<>v.owner";
        } else if ($mode == 3) {
            $q = "SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref where o.conqured IN(".implode(', ', $ref).") AND o.owner=v.owner";
        }
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$oasisReinforcementsCache[$ref[0].$mode] = $result;
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    if ( ! isset( self::$oasisReinforcementsCache[ $record['conqured'] . $mode ] ) ) {
                        self::$oasisReinforcementsCache[ $record['conqured'] . $mode ] = [];
                    }

                    self::$oasisReinforcementsCache[ $record['conqured'] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($ref as $key) {
                if (!isset(self::$oasisReinforcementsCache[$key.$mode])) {
                    self::$oasisReinforcementsCache[$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$oasisReinforcementsCache : self::$oasisReinforcementsCache[$ref[0].$mode]);
    }

    function getOasisEnforceArray($id, $mode=0, $use_cache = true) {
        list($id, $mode) = $this->escape_input((int) $id, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisArrayReinforcementsCache, $id.$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where e.id = $id";
        }else{
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.from=o.wref where e.id =$id";
        }
        $result = mysqli_query($this->dblink,$q);

        self::$oasisArrayReinforcementsCache[$id.$mode] = mysqli_fetch_assoc($result);
        return self::$oasisArrayReinforcementsCache[$id.$mode];
    }

	function addEnforce($data) {
        list($data) = $this->escape_input($data);

        $q = "INSERT into " . TB_PREFIX . "enforcement (vref,`from`) values (" . (int) $data['to'] . "," . (int) $data['from'] . ")";
		mysqli_query($this->dblink,$q);
		$id = mysqli_insert_id($this->dblink);
		$owntribe = $this->getUserField($this->getVillageField($data['from'], "owner"), "tribe", 0);
		$start = ($owntribe - 1) * 10 + 1;
		$end = ($owntribe * 10);
		//add unit
		$j = 1;
		$units = [];
		$amounts = [];
		$modes = [];

		for($i = $start; $i <= $end; $i++) {
		    $units[] = ($i < 0 ? 0 : $i);
		    $amounts[] = $data['t' . $j . ''];
		    $modes[] = 1;
			$j++;
		}

		// add hero
        $units[] = 'hero';
        $amounts[] = $data['t11'];
        $modes[] = 1;

		$this->modifyEnforce($id,$units, $amounts, $modes);
	}

	function addEnforce2($data,$tribe,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11) {
        list($data,$tribe,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11) = $this->escape_input($data,$tribe,$dead1,$dead2,$dead3,$dead4,$dead5,$dead6,$dead7,$dead8,$dead9,$dead10,$dead11);

        $q = "INSERT into " . TB_PREFIX . "enforcement (vref,`from`) values (" . (int) $data['to'] . "," . (int) $data['from'] . ")";
		mysqli_query($this->dblink,$q);
		$id = mysqli_insert_id($this->dblink);
		$owntribe = $this->getUserField($this->getVillageField($data['from'], "owner"), "tribe", 0);
		$start = ($owntribe - 1) * 10 + 1;
		$end = ($owntribe * 10);
		$start2 = ($tribe - 1) * 10 + 1;
		$start3 = ($tribe - 1) * 10;
		if($start3 == 0){
		    $start3 = "";
		}
		$end2 = ($tribe * 10);
		//add unit
		$j = 1;

        $units = [];
        $amounts = [];
        $modes = [];

		for($i = $start; $i <= $end; $i++) {
            $units[] = ($i < 0 ? 0 : $i);
            $amounts[] = $data['t' . $j . ''];
            $modes[] = 1;

            $units[] = ($i < 0 ? 0 : $i);
            $amounts[] = ${'dead'.$j};
            $modes[] = 0;

			$j++;
		}

        // process heroes
        $units[] = 'hero';
        $amounts[] = $data['t11'];
        $modes[] = 1;

        $units[] = 'hero';
        $amounts[] = $dead11;
        $modes[] = 0;

        $this->modifyEnforce($id,$units, $amounts, $modes);
	}

	function modifyEnforce($id, $unit, $amt, $mode) {
	    $id = (int) $id;

		// prepare pairing array, even if we're not passing arrays, so we can use the same logic
        $pairs = [];
		if (!is_array($unit)) {
		    $unit = [$unit];
		    $amt = [(int) $amt];
		    $mode = [(int) $mode];
        }

        foreach ($unit as $index => $unitType) {
            $unitType = ($unitType != 'hero' ? 'u' . $this->escape($unitType) : $unitType);
		    $pairs[] = $unitType . ' = ' . $unitType . (!(int) $mode[$index] ? ' - ' : ' + ') . (int) $amt[$index];
        }

		$q = "UPDATE " . TB_PREFIX . "enforcement SET ".implode(', ', $pairs)." WHERE id = $id";
		mysqli_query($this->dblink,$q);

		// clear enforce cache
        self::$villageReinforcementsCache = [];
        self::$villageFromReinforcementsCache = [];
        self::$reinforcementsCache = [];
	}

	function getEnforceArray($id, $mode, $use_cache = true) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$reinforcementsCache, $id.$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		if(!$mode) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where id = $id";
		} else {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` = $id";
		}
		$result = mysqli_query($this->dblink,$q);

        self::$reinforcementsCache[$id.$mode] = mysqli_fetch_assoc($result);
        return self::$reinforcementsCache[$id.$mode];
	}

	function getEnforceVillage($id, $mode, $use_cache = true) {
        $array_passed = is_array($id);
        $mode = (int) $mode;

        if (!$array_passed) {
            $id = [(int) $id];
        } else {
            foreach ($id as $index => $idValue) {
                $id[$index] = (int) $idValue;
            }
        }

        if (!count($id)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$villageReinforcementsCache[$id[0].$mode]) && is_array(self::$villageReinforcementsCache[$id[0].$mode]) && !count(self::$villageReinforcementsCache[$id[0].$mode])) {
            return self::$villageReinforcementsCache[$id[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newIDs = [];
            foreach ($id as $key) {
                if (!isset(self::$villageReinforcementsCache[$key.$mode])) {
                    $newIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newIDs)) {
                return self::$villageReinforcementsCache;
            } else {
                // update remaining IDs to select and cache
                $id = $newIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$villageReinforcementsCache, $id[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

		if(!$mode) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where vref IN(".implode(', ', $id).")";
		} else if ($mode == 1) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` IN(".implode(', ', $id).")";
		} else if ($mode == 2) {
            $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref LEFT JOIN ".TB_PREFIX."vdata as v1 ON e.vref=v1.wref where e.vref IN(".implode(', ', $id).") AND v.owner<>v1.owner";
        } else if ($mode == 3) {
            $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref LEFT JOIN ".TB_PREFIX."vdata as v1 ON e.vref=v1.wref where e.vref IN(".implode(', ', $id).") AND v.owner=v1.owner";
        } else if ($mode == 4) {
            $q = "SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."vdata as v ON e.from=v.wref LEFT JOIN ".TB_PREFIX."vdata as v1 ON e.vref=v1.wref where e.vref IN(".implode(', ', $id).") AND v.owner=v1.owner";
        }
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$villageReinforcementsCache[$id[0].$mode] = $result;
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    if ( ! isset( self::$villageReinforcementsCache[ $record['vref'] . $mode ] ) ) {
                        self::$villageReinforcementsCache[ $record['vref'] . $mode ] = [];
                    }

                    self::$villageReinforcementsCache[ $record['vref'] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($id as $key) {
                if (!isset(self::$villageReinforcementsCache[$key.$mode])) {
                    self::$villageReinforcementsCache[$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$villageReinforcementsCache : self::$villageReinforcementsCache[$id[0].$mode]);
	}

	public static function clearReinforcementsCache() {
	    self::$reinforcementsCache = [];
	    self::$villageReinforcementsCache = [];
	    self::$villageFromReinforcementsCache = [];
	    self::$oasisArrayReinforcementsCache = [];
	    self::$oasisReinforcementsCache = [];
	    self::clearUnitsCache();
    }

    public static function clearUnitsCache() {
        self::$unitsCache = [];
    }

    // no need to cache this method
	function getVillageMovement($id) {
        list($id) = $this->escape_input($id);

		$vinfo = $this->getVillage($id);
		$vtribe = $this->getUserField($vinfo['owner'], "tribe", 0);
        $movingunits = array();
		$outgoingarray = $this->getMovement(3, $id, 0);
		if(!empty($outgoingarray) && count($outgoingarray)) {
			foreach($outgoingarray as $out) {
				for($i = 1; $i <= 10; $i++) {
				    if (!isset($movingunits['u' . (($vtribe - 1) * 10 + $i)])) {
				        $movingunits['u' . (($vtribe - 1) * 10 + $i)] = 0;
				    }

				    if (!isset($out['t' . $i])) {
                        $out['t' . $i] = 0;
                    }

					$movingunits['u' . (($vtribe - 1) * 10 + $i)] += $out['t' . $i];
				}

				if (!isset($movingunits['hero'])) {
				    $movingunits['hero'] = 0;
				}

				if (!isset($out['t11'])) {
                    $out['t11'] = 0;
                }

				$movingunits['hero'] += $out['t11'];
			}
		}
		$returningarray = $this->getMovement(4, $id, 1);
		if(!empty($returningarray) && count($returningarray)) {
			foreach($returningarray as $ret) {
				if($ret['attack_type'] != 1) {
					for($i = 1; $i <= 10; $i++) {
					    if (!isset($movingunits['u' . (($vtribe - 1) * 10 + $i)])) {
					        $movingunits['u' . (($vtribe - 1) * 10 + $i)] = 0;
					    }
						$movingunits['u' . (($vtribe - 1) * 10 + $i)] += $ret['t' . $i];
					}

					if (!isset($movingunits['hero'])) {
					    $movingunits['hero'] = 0;
					}
					$movingunits['hero'] += $ret['t11'];
				}
			}
		}
		$settlerarray = $this->getMovement(5, $id, 0);
		if(!empty($settlerarray)) {
		    if (!isset($movingunits['u' . ($vtribe * 10)])) {
		        $movingunits['u' . ($vtribe * 10)] = 0;
		    }
			$movingunits['u' . ($vtribe * 10)] += 3 * count($settlerarray);
		}
		return $movingunits;
	}

	################# -START- ##################
	##   WORLD WONDER STATISTICS FUNCTIONS!   ##
	############################################

	/***************************
	Function to get user alliance name!
	Made by: Dzoki
	***************************/

    // no need to cache this method
	function getUserAllianceID($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT alliance FROM " . TB_PREFIX . "users where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['alliance'];
	}

	/***************************
	Function to get WW name
	Made by: Dzoki
	***************************/

    // no need to cache this method
	function getWWName($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT wwname FROM " . TB_PREFIX . "fdata WHERE vref = $vref LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['wwname'];
	}

	/***************************
	Function to change WW name
	Made by: Dzoki
	***************************/

	function submitWWname($vref, $name) {
	    list($vref, $name) = $this->escape_input((int) $vref, $name);

		$q = "UPDATE " . TB_PREFIX . "fdata SET `wwname` = '$name' WHERE " . TB_PREFIX . "fdata.`vref` = $vref";
		return mysqli_query($this->dblink,$q);
	}

	//medal functions
	function addclimberrankpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set clp = clp + $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function removeclimberrankpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set clp = clp - $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function setclimberrankpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set clp = $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function updateoldrank($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set oldrank = $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	// ALLIANCE MEDAL FUNCTIONS
	function addclimberrankpopAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set clp = clp + $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function removeclimberrankpopAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set clp = clp - $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function updateoldrankAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set oldrank = $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function getTrainingList() {
		$q = "SELECT * FROM " . TB_PREFIX . "training where vref IS NOT NULL";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getNeedDelete() {
		$time = time();
		$q = "SELECT uid FROM " . TB_PREFIX . "deleting where timestamp < $time";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function countUser($use_cache = true) {
        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$usersCountCache, 0)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(id) FROM " . TB_PREFIX . "users where id > 5";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

        self::$usersCountCache[0] = $row[0];
        return self::$usersCountCache[0];
	}

	function countAlli($use_cache = true) {
        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$allianceCountCache, 0)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(id) FROM " . TB_PREFIX . "alidata where id != 0";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

        self::$allianceCountCache[0] = $row[0];
        return self::$allianceCountCache[0];
	}

	//MARKET FIXES
	function getWoodAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['wood'];
	}

	function getClayAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['clay'];
	}

	function getIronAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['iron'];
	}

	function getCropAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['crop'];
	}

	function Getowner($vid) {
        // return from cache
        return $this->getVillage($vid, 0, $use_cache)['owner'];
	}

	/**
	 * Creates a database structure for the game.
	 * Used during installation.
	 *
	 * @return boolean|number Returns TRUE, FALSE or -1. True is for successful data import
	 *                        (from prepared SQL file), false is in case of an SQL error.
	 *                        -1 will be returned in case of any unexpected behavior
	 *                        and unhandled exceptions.
	 */

    public function createDbStructure() {
        global $autoprefix;

        try {
            // check that we don't have the structure in place already
            // (we'd have at least 1 user present, since 4 are being created by default - Support, Nature, Multihunter & Taskmaster)
            $data_exist = $this->query_return("SELECT * FROM " . TB_PREFIX . "users LIMIT 1");
            if ($data_exist && count($data_exist)) {
                return false;
            }

            // load the DB structure SQL file
            $str = file_get_contents($autoprefix."var/db/struct.sql");
            $str = preg_replace("'%PREFIX%'", TB_PREFIX, $str);
            $result = $this->dblink->multi_query($str);

            // fetch results of the multi-query in order to allow subsequent query() and multi_query() calls to work
            while (mysqli_more_results($this->dblink) && mysqli_next_result($this->dblink)) {;}

            if (!$result) {
                return false;
            }
        } catch (\Exception $e) {
            return -1;
        }

        return true;
    }

    /**
     * Populates the game database with Map World Data (i.e. creates the whole
     * world with X,Y coordinate squares and their types).
     *
     * Also populates oasis' table data for the squares where there are oasis.
     *
     * @return boolean|number Returns TRUE, FALSE or -1. True is for successful data import
	 *                        (from prepared SQL file), false is in case of an SQL error.
	 *                        -1 will be returned in case of any unexpected behavior
	 *                        and unhandled exceptions.
     */
    public function populateWorldData() {
        global $autoprefix;

        try {
            // check if we don't already have world data
            $data_exist = $this->query_return("SELECT * FROM " . TB_PREFIX . "wdata LIMIT 1");
            if ($data_exist && count($data_exist)) {
                return false;
            }

            // load the data generation SQL file
            $str = file_get_contents($autoprefix."var/db/datagen-world-data.sql");
            $str = preg_replace(["'%PREFIX%'", "'%WORLDSIZE%'"], [TB_PREFIX, WORLD_MAX], $str);
            $result = $this->dblink->multi_query($str);

            // fetch results of the multi-query in order to allow subsequent query() and multi_query() calls to work
            while (mysqli_more_results($this->dblink) && mysqli_next_result($this->dblink)) {;}

            if (!$result) {
                return -1;
            }

            $result = $this->regenerateOasisUnits(-1);
            if (!$result) {
                return -1;
            }
        } catch (\Exception $e) {
            return -1;
        }

        return true;
    }

    // no need to cache, not used in any loops or more than once for each page load
	public function getAvailableExpansionTraining() {
		global $building, $session, $technology, $village;

		$vilData = $this->getVillage($village->wid);
		$maxslots = (($vilData['exp1'] == 0 ? 1 : 0) + ($vilData['exp2'] == 0 ? 1 : 0) + ($vilData['exp3'] == 0 ? 1 : 0));
		$residence = $building->getTypeLevel(25);
		$palace = $building->getTypeLevel(26);

		if($residence > 0) {
			$maxslots -= (3 - floor($residence / 10));
		}

		if($palace > 0) {
			$maxslots -= (3 - floor(($palace - 5) / 5));
		}

		$q = "SELECT (u10+u20+u30) as R1, (u9+u19+u29) as R2 FROM " . TB_PREFIX . "units WHERE vref = ". (int) $village->wid;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$settlers = $row['R1'];
		$chiefs = $row['R2'];

		$settlers += 3 * count($this->getMovement(5, $village->wid, 0));
		$current_movement = $this->getMovement(3, $village->wid, 0);
		if(!empty($current_movement)) {
			foreach($current_movement as $build) {
				$settlers += $build['t10'];
				$chiefs += $build['t9'];
			}
		}
		$current_movement = $this->getMovement(3, $village->wid, 1);
		if(!empty($current_movement)) {
			foreach($current_movement as $build) {
				$settlers += $build['t10'];
				$chiefs += $build['t9'];
			}
		}
		$current_movement = $this->getMovement(4, $village->wid, 0);
		if(!empty($current_movement)) {
			foreach($current_movement as $build) {
				$settlers += $build['t10'];
				$chiefs += $build['t9'];
			}
		}
		$current_movement = $this->getMovement(4, $village->wid, 1);
		if(!empty($current_movement)) {
			foreach($current_movement as $build) {
				$settlers += $build['t10'];
				$chiefs += $build['t9'];
			}
		}

		$q = "SELECT (u10+u20+u30) FROM " . TB_PREFIX . "enforcement WHERE `from` = ".(int) $village->wid;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		if(!empty($row)) {
			foreach($row as $reinf) {
				$settlers += $reinf[0];
			}
		}

		$q = "SELECT (u9+u19+u29) FROM " . TB_PREFIX . "enforcement WHERE `from` = ".(int) $village->wid;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		if(!empty($row)) {
			foreach($row as $reinf) {
				$chiefs += $reinf[0];
			}
		}

		$trainlist = $technology->getTrainingList(4);
		if(!empty($trainlist)) {
			foreach($trainlist as $train) {
				if($train['unit'] % 10 == 0) {
					$settlers += $train['amt'];
				}
				if($train['unit'] % 10 == 9) {
					$chiefs += $train['amt'];
				}
			}
		}
		// TODO: trapped settlers/chiefs calculation required
		$settlerslots = ($maxslots * 3)  - $chiefs - $settlers;

		// don't allow training of settlers if there is at least 1 chief in the village
        if ($chiefs > 0) {
            $settlerslots = 0;
        }

		$chiefslots = $maxslots - $chiefs - floor(($settlers + 2) / 3);

		if(!$technology->getTech(($session->tribe - 1) * 10 + 9)) {
			$chiefslots = 0;
		}

        // don't allow training of chieftains if there is at least 1 settler in the village
        if ($settlers > 0) {
            $chiefslots = 0;
        }

		$slots = array("chiefs" => $chiefslots, "settlers" => $settlerslots);
		return $slots;
	}

	function addArtefact($vref, $owner, $type, $size, $name, $desc, $effect, $img) {
        list($vref, $owner, $type, $size, $name, $desc, $effect, $img) = $this->escape_input($vref, $owner, $type, $size, $name, $desc, $effect, $img);

		$q = "INSERT INTO `" . TB_PREFIX . "artefacts` (`vref`, `owner`, `type`, `size`, `conquered`, `name`, `desc`, `effect`, `img`, `active`) VALUES ('$vref', '$owner', '$type', '$size', '" . time() . "', '$name', '$desc', '$effect', '$img', '0')";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function getOwnArtefactInfo($vref) {
	    // load the data - type is irrelevant, since the method caches all data
        // then returns the one for our type
        $this->getOwnArtefactInfoByType($vref, 1);

        // return what we've cached
        return (self::$artefactInfoByTypeCache[$vref]);
	}

    // no need to cache this method
	function getOwnArtefactInfo3($uid) {
        // load the data - type and size are irrelevant, since the method caches all data
        // then returns the one for our type and size
        $this->getOwnUniqueArtefactInfo($uid, 1, 1);

        // return what we've cached
        return (self::$artefactInfoSimpleCache[$uid]);
	}

	function getOwnArtefactInfoByType($vref, $type, $use_cache = true) {
        $vref = (int) $vref;
        $type = (int) $type;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$artefactInfoByTypeCache[$vref]) && is_array(self::$artefactInfoByTypeCache[$vref]) && !count(self::$artefactInfoByTypeCache[$vref])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$artefactInfoByTypeCache, $vref)) && !is_null($cachedValue)) {
            return (isset($cachedValue[$type]) ? $cachedValue[$type] : []);
        }

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vref ORDER BY size";
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

		// cache all types and return the requested one
        if (count($result)) {
            foreach ($result as $arteInfo) {
                if (!isset(self::$artefactInfoByTypeCache[$arteInfo['vref']])) {
                    self::$artefactInfoByTypeCache[$arteInfo['vref']] = [];
                }

                // we're sorting by size, thus we only need the first one per each type
                if (isset(self::$artefactInfoByTypeCache[$arteInfo['vref']]) && !isset(self::$artefactInfoByTypeCache[$arteInfo['vref']][$arteInfo['type']])) {
                    self::$artefactInfoByTypeCache[$arteInfo['vref']][$arteInfo['type']] = $arteInfo;
                }
            }
        } else {
            self::$artefactInfoByTypeCache[$vref] = [];
        }

        return (isset(self::$artefactInfoByTypeCache[$vref][$type]) ? self::$artefactInfoByTypeCache[$vref][$type] : []);
	}

	function getOwnArtefactInfoByType2($vref, $type, $use_cache = true) {
        return $this->getOwnArtefactInfoByType($vref, $type, $use_cache);
	}

	function getOwnUniqueArtefactInfo($id, $type, $size, $use_cache = true) {
	    list($id, $type, $size) = $this->escape_input((int) $id, (int) $type, (int) $size);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$artefactInfoSimpleCache[$id]) && is_array(self::$artefactInfoSimpleCache[$id]) && !count(self::$artefactInfoSimpleCache[$id])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$artefactInfoSimpleCache, $id)) && !is_null($cachedValue)) {
            return (isset($cachedValue[$type.$size]) ? $cachedValue[$type.$size] : []);
        }

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE owner = $id";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // cache all types and return the requested one
        if (count($result)) {
            foreach ($result as $arteInfo) {
                if (!isset(self::$artefactInfoSimpleCache[$arteInfo['owner']])) {
                    self::$artefactInfoSimpleCache[$arteInfo['owner']] = [];
                }

                self::$artefactInfoSimpleCache[$arteInfo['owner']][$arteInfo['type'].$arteInfo['size']] = $arteInfo;
            }
        } else {
            self::$artefactInfoSimpleCache[$id] = [];
        }

        return (isset(self::$artefactInfoSimpleCache[$id][$type.$size]) ? self::$artefactInfoSimpleCache[$id][$type.$size] : []);
	}

	function getOwnUniqueArtefactInfo2($id, $type, $size, $mode, $use_cache = true) {
	    list($id, $type, $size, $mode) = $this->escape_input((int) $id, (int) $type, (int) $size, $mode);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$artefactDataCache[$id.$mode]) && is_array(self::$artefactDataCache[$id.$mode]) && !count(self::$artefactDataCache[$id.$mode])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$artefactDataCache, $id.$mode)) && !is_null($cachedValue)) {
            return (isset($cachedValue[$size.$type]) ? $cachedValue[$size.$type] : []);
        }

        $q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE ".(!$mode ? 'owner' : 'vref')." = $id AND active = 1";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // cache all types and return the requested one
        if (count($result)) {
            foreach ($result as $arteInfo) {
                if (!isset(self::$artefactDataCache[$arteInfo[(!$mode ? 'owner' : 'vref')] . $mode])) {
                    self::$artefactDataCache[$arteInfo[(!$mode ? 'owner' : 'vref')] . $mode] = [];
                }

                self::$artefactDataCache[$arteInfo[(!$mode ? 'owner' : 'vref')] . $mode][$arteInfo['size'].$arteInfo['type']] = $arteInfo;
            }
        } else {
            self::$artefactDataCache[$id.$mode] = [];
        }

        return (isset(self::$artefactDataCache[$id.$mode][$size.$type]) ? self::$artefactDataCache[$id.$mode][$size.$type] : []);
	}

	function getFoolArtefactInfo($type,$vid,$uid, $use_cache = true) {
	    list($type,$vid,$uid) = $this->escape_input((int) $type,(int) $vid,(int) $uid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && isset(self::$foolArtefactCache[$vid]) && is_array(self::$foolArtefactCache[$vid]) && !count(self::$foolArtefactCache[$vid])) {
            return [];
        } else if ($use_cache && ($cachedValue = self::returnCachedContent(self::$foolArtefactCache, $vid)) && !is_null($cachedValue)) {
            $data = [];
            // prepare the data as requested
            if (isset($cachedValue[$type.$uid])) {
                foreach ($cachedValue[$type.$uid] as $row) {
                    if ($row['type'] == 8 && $row['kind'] == $type && $row['owner'] == $uid && $row['size'] > 1 && $row['active'] > 1) {
                        $data[] = $row;
                    }
                }
            }
            return $data;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vid"; //" AND ((type = 8 AND kind = $type) OR (owner = $uid AND size > 1 AND active = 1 AND type = 8 AND kind = $type))";
		$result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // cache all types and return the requested one
        if (count($result)) {
            foreach ($result as $arteInfo) {
                if (!isset(self::$foolArtefactCache[$vid][$arteInfo['type'].$arteInfo['owner']])) {
                    self::$foolArtefactCache[$vid][$arteInfo['type'].$arteInfo['owner']] = [];
                }

                self::$foolArtefactCache[$vid][$arteInfo['type'].$arteInfo['owner']][] = $arteInfo;
            }
        } else {
            self::$foolArtefactCache[$vid] = [];
        }

        if (
            isset(self::$foolArtefactCache[$vid][$type.$uid]) &&
            self::$foolArtefactCache[$vid][$type.$uid]['type'] == 8 &&
            self::$foolArtefactCache[$vid][$type.$uid]['kind'] == $type &&
            self::$foolArtefactCache[$vid][$type.$uid]['owner'] == $uid &&
            self::$foolArtefactCache[$vid][$type.$uid]['size'] > 1 &&
            self::$foolArtefactCache[$vid][$type.$uid]['active'] > 1
        ) {
            return self::$foolArtefactCache[$vid][$type.$uid];
        } else {
            return [];
        }
	}

	function villageHasArtefact($vref) {
        // this is a somewhat non-ideal, externally non-changeable way of caching
        // but since we're only ever going to be calling this from a single point of Automation,
        // this will more than suffice
        static $cachedData = [];
        $vref = (int) $vref;

        if (isset($cachedData[$vref])) {
            return $cachedData[$vref];
        }

        $q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "artefacts WHERE vref = $vref";
        $result = mysqli_fetch_array(mysqli_query($this->dblink, $q), MYSQLI_ASSOC);
        $cachedData[$vref] = $result['Total'];

        return $cachedData[$vref];
    }

	function claimArtefact($vref, $ovref, $id) {
	    list($vref, $ovref, $id) = $this->escape_input((int) $vref, (int) $ovref, (int) $id);

		$time = time();
		$q = "UPDATE " . TB_PREFIX . "artefacts SET vref = $vref, owner = $id, conquered = $time, active = 1 WHERE vref = $ovref";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
    public function canClaimArtifact($from,$vref,$size,$type) {
        list($size,$type) = $this->escape_input((int) $size,(int) $type);

        //fix by Ronix
        global $session, $form;
        $size1 = $size2 = $size3 = 0;

        $artifact = $this->getOwnArtefactInfo( $from );
        if ( ! empty( $artifact ) ) {
            $form->addError( "error", "Treasury is full. Your hero could not claim the artefact" );

            return false;
        }
        $uid      = $session->uid;
        $q        = "
            SELECT Count(size) AS totals,
                SUM(IF(size = '1',1,0)) small,
                SUM(IF(size = '2',1,0)) great,
                SUM(IF(size = '3',1,0)) `unique`
                FROM " . TB_PREFIX . "artefacts WHERE owner = " . (int) $uid;
        $result   = mysqli_query( $this->dblink, $q );
        $artifact = $this->mysqli_fetch_all( $result )[0];

        if ( $artifact['totals'] < 3 || $type == 11 ) {
            $DefenderFields = $this->getResourceLevel( $vref );
            $defcanclaim    = true;

            for ( $i = 19; $i <= 38; $i ++ ) {
                if ( $DefenderFields[ 'f' . $i . 't' ] == 27 ) {
                    $defTresuaryLevel = $DefenderFields[ 'f' . $i ];
                    if ( $defTresuaryLevel > 0 ) {
                        $defcanclaim = false;
                        $form->addError( "error", "Treasury has not been destroyed. Your hero could not claim the artefact" );

                        return false;
                    } else {
                        $defcanclaim = true;
                    }
                }
            }

            $AttackerFields = $this->getResourceLevel( $from, 2 );

            for ( $i = 19; $i <= 38; $i ++ ) {
                if ( $AttackerFields[ 'f' . $i . 't' ] == 27 ) {
                    $attTresuaryLevel = $AttackerFields[ 'f' . $i ];
                    if ( $attTresuaryLevel >= 10 ) {
                        $villageartifact = true;
                    } else {
                        $villageartifact = false;
                    }
                    if ( $attTresuaryLevel >= 20 ) {
                        $accountartifact = true;
                    } else {
                        $accountartifact = false;
                    }
                }
            }

            if ( ( $artifact['great'] > 0 || $artifact['unique'] > 0 ) && $size > 1 ) {
                $form->addError( "error", "Max num. of great/unique artefacts. Your hero could not claim the artefact" );
                return false;
            }

            if ( ( $size == 1 && ( $villageartifact || $accountartifact ) ) || ( ( $size == 2 || $size == 3 ) && $accountartifact ) ) {
                return true;
                /*
                    if($this->getVillageField($from,"capital")==1 && $type==11) {
                                $form->addError("error","Ancient Construction Plan cannot kept in capital village");
                                return FALSE;
                            }else{
                                return TRUE;
                            }
                */
            } else {
                $form->addError( "error", "Your level treasury is low. Your hero could not claim the artefact" );
                return false;
            }
        } else {
            $form->addError( "error", "Max num. of artefacts. Your hero could not claim the artefact" );
            return false;
        }
    }

// no need to cache this method
	function getArtefactDetails($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE id = " . $id . " LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

    // no need to cache this method
	function getMovementById($id) {
	    list($id) = $this->escape_input((int) $id);
		$q = "SELECT * FROM ".TB_PREFIX."movement WHERE moveid = ".$id;
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

    // no need to cache this method
	function getLinks($id) {
	    list($id) = $this->escape_input((int) $id);
		$q = 'SELECT * FROM `' . TB_PREFIX . 'links` WHERE `userid` = ' . $id . ' ORDER BY `pos` ASC';
		return mysqli_query($this->dblink,$q);
	}

	function removeLinks($id,$uid) {
	    list($id,$uid) = $this->escape_input((int) $id,(int) $uid);
		$q = "DELETE FROM " . TB_PREFIX . "links WHERE `id` = ".$id." and `userid` = ".$uid;
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function getVilFarmlist($wref) {
	    list($wref) = $this->escape_input((int) $wref);
		$q = 'SELECT * FROM ' . TB_PREFIX . 'farmlist WHERE wref = ' . $wref . ' ORDER BY wref ASC LIMIT 1';
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

		if($dbarray['id']!=0) {
				return true;
			} else {
				return false;
			}

	}

    // no need to cache this method
	function getRaidList($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "raidlist WHERE id = ".$id." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function delFarmList($id, $owner) {
	    list($id, $owner) = $this->escape_input((int) $id, (int) $owner);

		$q = "DELETE FROM " . TB_PREFIX . "farmlist where id = $id and owner = $owner";
		return mysqli_query($this->dblink,$q);
	}

	function delSlotFarm($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "raidlist where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function createFarmList($wref, $owner, $name) {
        list($wref, $owner, $name) = $this->escape_input($wref, $owner, $name);

		$q = "INSERT INTO " . TB_PREFIX . "farmlist (`wref`, `owner`, `name`) VALUES ('$wref', '$owner', '$name')";
		return mysqli_query($this->dblink,$q);
	}

	function addSlotFarm($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10) {
        list($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10) = $this->escape_input($lid, $towref, $x, $y, $distance, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10);

		$q = "INSERT INTO " . TB_PREFIX . "raidlist (`lid`, `towref`, `x`, `y`, `distance`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`, `t7`, `t8`, `t9`, `t10`) VALUES ('$lid', '$towref', '$x', '$y', '$distance', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10')";
		return mysqli_query($this->dblink,$q);
	}

	function editSlotFarm($eid, $lid, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10) {
	    list($eid, $lid, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10) = $this->escape_input((int) $eid, $lid, $wref, $x, $y, $dist, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10);

		$q = "UPDATE " . TB_PREFIX . "raidlist set lid = '$lid', towref = '$wref', x = '$x', y = '$y', t1 = '$t1', t2 = '$t2', t3 = '$t3', t4 = '$t4', t5 = '$t5', t6 = '$t6', t7 = '$t7', t8 = '$t8', t9 = '$t9', t10 = '$t10' WHERE id = $eid";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function getArrayMemberVillage($uid) {
	    list($uid) = $this->escape_input((int) $uid);
		$q = 'SELECT a.wref, a.name, b.x, b.y from '.TB_PREFIX.'vdata AS a left join '.TB_PREFIX.'wdata AS b ON b.id = a.wref where owner = '.$uid.' order by capital DESC,pop DESC';
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

	function addPassword($uid, $npw, $cpw) {
	    list($uid, $npw, $cpw) = $this->escape_input((int) $uid, $npw, $cpw);
		$q = "REPLACE INTO `" . TB_PREFIX . "password`(uid, npw, cpw) VALUES ($uid, '$npw', '$cpw')";
		mysqli_query($this->dblink,$q);
	}

	function resetPassword($uid, $cpw) {
	    list($uid, $cpw) = $this->escape_input((int) $uid, $cpw);
		$q = "SELECT npw FROM `" . TB_PREFIX . "password` WHERE uid = $uid AND cpw = '$cpw' AND used = 0 LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

		if(!empty($dbarray)) {
		    if(!$this->updateUserField($uid, 'password', password_hash($dbarray['npw'], PASSWORD_BCRYPT,['cost' => 12]), 1)) return false;
			$q = "UPDATE `" . TB_PREFIX . "password` SET used = 1 WHERE uid = $uid AND cpw = '$cpw' AND used = 0";
			mysqli_query($this->dblink,$q);
			return true;
		}

		return false;
	}

	function getCropProdstarv($wref, $use_cache = true) {
	    global $bid4,$bid8,$bid9,$sesion,$technology;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$cropProductionStarvationValueCache, $wref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    $wood = 0;
	    $cropo = 0;
	    $clay = 0;
	    $iron = 0;
		$basecrop = $grainmill = $bakery = 0;
		$owner = $this->getVrefField($wref, 'owner', $use_cache);
		$bonus = $this->getUserField($owner, 'b4', 0);

		$buildarray = $this->getResourceLevel($wref);
		$cropholder = array();
		for($i=1;$i<=38;$i++) {
			if($buildarray['f'.$i.'t'] == 4) {
				array_push($cropholder,'f'.$i);
			}
			if($buildarray['f'.$i.'t'] == 8) {
				$grainmill = $buildarray['f'.$i];
			}
			if($buildarray['f'.$i.'t'] == 9) {
				$bakery = $buildarray['f'.$i];
			}
		}
		$q = "SELECT type FROM `" . TB_PREFIX . "odata` WHERE conqured = ".(int) $wref;
		$oasis = $this->query_return($q);
		foreach($oasis as $oa){
			switch($oa['type']) {
                case 1:
                case 2:
                    $wood += 1;
                    break;
                case 3:
                    $wood  += 1;
                    $cropo += 1;
                    break;
                case 4:
                case 5:
                    $clay += 1;
                    break;
                case 6:
                    $clay  += 1;
                    $cropo += 1;
                    break;
                case 7:
                case 8:
                    $iron += 1;
                    break;
                case 9:
                    $iron  += 1;
                    $cropo += 1;
                    break;
                case 10:
                case 11:
                    $cropo += 1;
                    break;
                case 12:
                    $cropo += 2;
                    break;
			}
		}
        for ( $i = 0; $i <= count( $cropholder ) - 1; $i ++ ) {
            $basecrop += $bid4[ $buildarray[ $cropholder[ $i ] ] ]['prod'];
        }
        $crop = $basecrop + $basecrop * 0.25 * $cropo;
        if ( $grainmill >= 1 || $bakery >= 1 ) {
            $crop += $basecrop / 100 * ( ( isset( $bid8[ $grainmill ]['attri'] ) ? $bid8[ $grainmill ]['attri'] : 0 ) + ( isset( $bid9[ $bakery ]['attri'] ) ? $bid9[ $bakery ]['attri'] : 0 ) );
        }
        if ( $bonus > time() ) {
            $crop *= 1.25;
        }
        $crop *= SPEED;

        self::$cropProductionStarvationValueCache[$wref] = $crop;
        return self::$cropProductionStarvationValueCache[$wref];
	}

	//general statistics

	function addGeneralAttack($casualties) {
        list($casualties) = $this->escape_input($casualties);

		$time = time();
		$q = "INSERT INTO " . TB_PREFIX . "general values (0,'$casualties','$time',1)";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function getAttackByDate($time) {
        list($time) = $this->escape_input($time);

		$q = "SELECT time FROM " . TB_PREFIX . "general where shown = 1";
		$result = $this->query_return($q);
		$attack = 0;
		foreach($result as $general) {
		    if(date("j. M",$time) == date("j. M",$general['time'])){
		        $attack += 1;
		    }
		}
		return $attack;
	}

    // no need to cache this method
	function getAttackCasualties($time) {
        list($time) = $this->escape_input($time);

		$q = "SELECT time, casualties FROM " . TB_PREFIX . "general where shown = 1";
		$result = $this->query_return($q);
		$casualties = 0;
		foreach($result as $general){
		    if(date("j. M",$time) == date("j. M",$general['time'])){
		        $casualties += $general['casualties'];
		    }
		}
		return $casualties;
	}

	//end general statistics

	function addFriend($uid, $column, $friend) {
	    list($uid, $column, $friend) = $this->escape_input((int) $uid, $column, (int) $friend);

		$q = "UPDATE " . TB_PREFIX . "users SET $column = $friend WHERE id = $uid";
		return mysqli_query($this->dblink,$q);
	}

	function deleteFriend($uid, $column) {
	    list($uid, $column) = $this->escape_input((int) $uid, $column);

		$q = "UPDATE " . TB_PREFIX . "users SET $column = 0 WHERE id = $uid";
		return mysqli_query($this->dblink,$q);
	}

    // no need to cache this method
	function checkFriends($uid) {
        list($uid) = $this->escape_input($uid);

        global $session;
        $user = $this->getUserArray( $uid, 1 );
        for ( $i = 0; $i <= 19; $i ++ ) {
            if ( $user[ 'friend' . $i ] == 0 && $user[ 'friend' . $i . 'wait' ] == 0 ) {
                for ( $j = $i + 1; $j <= 19; $j ++ ) {
                    $k = $j - 1;
                    if ( $user[ 'friend' . $j ] != 0 ) {
                        $friend = $this->getUserField( $uid, "friend" . $j, 0 );
                        $this->addFriend( $uid, "friend" . $k, $friend );
                        $this->deleteFriend( $uid, "friend" . $j );
                    }

                    if ( $user[ 'friend' . $j . 'wait' ] == 0 ) {
                        $friendwait = $this->getUserField( $uid, "friend" . $j . "wait", 0 );
                        $this->addFriend( $session->uid, "friend" . $k . "wait", $friendwait );
                        $this->deleteFriend( $uid, "friend" . $j . "wait" );
                    }
                }
            }
        }
	}

	function setVillageEvasion($vid) {
        list($vid) = $this->escape_input($vid);

        $village = $this->getVillage((int) $vid);
		if($village['evasion'] == 0){
		$q = "UPDATE " . TB_PREFIX . "vdata SET evasion = 1 WHERE wref = $vid";
		}else{
		$q = "UPDATE " . TB_PREFIX . "vdata SET evasion = 0 WHERE wref = $vid";
		}
		return mysqli_query($this->dblink,$q);
	}

	function addPrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {
	    list($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) = $this->escape_input((int) $wid,(int) $from,(int) $t1,(int) $t2,(int) $t3,(int) $t4,(int) $t5,(int) $t6,(int) $t7,(int) $t8,(int) $t9,(int) $t10,(int) $t11);

		$q = "INSERT INTO " . TB_PREFIX . "prisoners values (0,$wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11)";
		mysqli_query($this->dblink,$q);
		self::$prisonersCache = [];
		return mysqli_insert_id($this->dblink);
	}

	function updatePrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {
	    list($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) = $this->escape_input((int) $wid,(int) $from,(int) $t1,(int) $t2,(int) $t3,(int) $t4,(int) $t5,(int) $t6,(int) $t7,(int) $t8,(int) $t9,(int) $t10,(int) $t11);

        $q = "UPDATE " . TB_PREFIX . "prisoners set t1 = t1 + $t1, t2 = t2 + $t2, t3 = t3 + $t3, t4 = t4 + $t4, t5 = t5 + $t5, t6 = t6 + $t6, t7 = t7 + $t7, t8 = t8 + $t8, t9 = t9 + $t9, t10 = t10 + $t10, t11 = t11 + $t11 where wref = $wid and ".TB_PREFIX."prisoners.from = $from";
        $res = mysqli_query($this->dblink,$q);
        self::$prisonersCache = [];
        return $res;
    }

    function getPrisoners($wid,$mode=0, $use_cache = true) {
        $array_passed = is_array($wid);
        $mode = (int) $mode;

        if (!$array_passed) {
            $wid = [(int) $wid];
        } else {
            foreach ($wid as $index => $widValue) {
                $wid[$index] = (int) $widValue;
            }
        }

        if (!count($wid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$prisonersCache[$wid[0].$mode]) && is_array(self::$prisonersCache[$wid[0].$mode]) && !count(self::$prisonersCache[$wid[0].$mode])) {
            return self::$prisonersCache[$wid[0].$mode];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newWIDs = [];
            foreach ($wid as $key) {
                if (!isset(self::$prisonersCache[$key.$mode])) {
                    $newWIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newWIDs)) {
                return self::$prisonersCache;
            } else {
                // update remaining IDs to select and cache
                $wid = $newWIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$prisonersCache, $wid[0].$mode)) && !is_null($cachedValue)) {
            // special case when we have empty arrays cached for this cache only
            return $cachedValue;
        }

        if(!$mode) {
            $q = "SELECT * FROM " . TB_PREFIX . "prisoners where wref IN(".implode(', ', $wid).")";
        }else {
            $q = "SELECT * FROM " . TB_PREFIX . "prisoners where `from` IN(".implode(', ', $wid).")";
        }
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            if (count($result) == 1) {
                $result = $result[0];
            }
            self::$prisonersCache[$wid[0].$mode] = (count($result) ? [$result] : []);
        } else {
            if ($result && count($result)) {
                if (!isset(self::$prisonersCache[ $record[ ( $mode ? 'from' : 'wref' ) ] . $mode ])) {
                    self::$prisonersCache[ $record[ ( $mode ? 'from' : 'wref' ) ] . $mode ] = [];
                }

                foreach ( $result as $record ) {
                    self::$prisonersCache[ $record[ ( $mode ? 'from' : 'wref' ) ] . $mode ][] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($wid as $key) {
                if (!isset(self::$prisonersCache[$key.$mode])) {
                    self::$prisonersCache[$key.$mode] = [];
                }
            }
        }

        return ($array_passed ? self::$prisonersCache : self::$prisonersCache[$wid[0].$mode]);
    }

	function getPrisoners2($wid,$from, $use_cache = true) {
	    list($wid,$from) = $this->escape_input((int) $wid,(int) $from);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$prisonersCacheByVillageAndFromIDs, $wid.$from)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where wref = $wid and " . TB_PREFIX . "prisoners.from = $from";
		$result = mysqli_query($this->dblink,$q);

        self::$prisonersCacheByVillageAndFromIDs[$wid.$from] = $this->mysqli_fetch_all($result);
        return self::$prisonersCacheByVillageAndFromIDs[$wid.$from];
	}

	function getPrisonersByID($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$prisonersCacheByID, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$prisonersCacheByID[$id] = mysqli_fetch_array($result);
        return self::$prisonersCacheByID[$id];
	}

	function getPrisoners3($from) {
        return $this->getPrisoners($from, 1);
	}

	function deletePrisoners($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $idValue) {
            $id[$index] = (int) $idValue;
        }

		$q = "DELETE FROM " . TB_PREFIX . "prisoners WHERE id IN(".implode(', ', $id).")";
		mysqli_query($this->dblink,$q);

		self::$prisonersCache = [];
	}

/*****************************************
Function to vacation mode - by advocaite
References:
*****************************************/

   function setvacmode($uid,$days) {
       // TODO: refactor vacation mode
       return;

       list($uid,$days) = $this->escape_input((int) $uid,(int) $days);
     $days1 =60*60*24*$days;
     $time =time()+$days1;
     $q ="UPDATE ".TB_PREFIX."users SET vac_mode = '1' , vac_time=".$time." WHERE id=".$uid."";
	 $result =mysqli_query($this->dblink,$q);
     }

   function removevacationmode($uid) {
       // TODO: refactor vacation mode
       return;

       list($uid) = $this->escape_input((int) $uid);
     $q ="UPDATE ".TB_PREFIX."users SET vac_mode = '0' , vac_time='0' WHERE id=".$uid."";
     $result =mysqli_query($this->dblink,$q);
     }

   function getvacmodexy($wref) {
       // TODO: refactor vacation mode
       return;

       list($wref) = $this->escape_input((int) $wref);
	$q = "SELECT id,oasistype,occupied FROM " . TB_PREFIX . "wdata where id = $wref";
     $result = mysqli_query($this->dblink,$q);
     $dbarray = mysqli_fetch_array($result);
     if($dbarray['occupied'] != 0 && $dbarray['oasistype'] == 0) {
         $q1 = "SELECT owner FROM " . TB_PREFIX . "vdata where wref = ".(int) $dbarray['id']."";
     $result1 = mysqli_query($this->dblink,$q1);
     $dbarray1 = mysqli_fetch_array($result1);
     if($dbarray1['owner'] != 0){
         $q2 = "SELECT vac_mode,vac_time FROM " . TB_PREFIX . "users where id = ".(int) $dbarray1['owner']."";
     $result2 = mysqli_query($this->dblink,$q2);
     $dbarray2 = mysqli_fetch_array($result2);
     if($dbarray2['vac_mode'] ==1){
     return true;
     }else{
     return false;
     }
     }
     } else {
     return false;
     }
   }

    // no need to cache this method
    function getHeroDeadReviveOrInTraining($id) {
        $id = (int) $id;

        $q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "hero WHERE `uid` = $id AND dead = 0 AND inrevive = 0 AND intraining = 0";
        $result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
        if ($result['Total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

	/***************************
	Function to Kill hero if not found
	Made by: Shadow and brainiacX
	***************************/
    function KillMyHero($id) {
        list( $id ) = $this->escape_input( (int) $id );

        $q = "UPDATE " . TB_PREFIX . "hero set dead = 1, intraining = 0, inrevive = 0 where uid = " . $id . " AND dead = 0";

        return mysqli_query( $this->dblink, $q );
    }

	/***************************
    Function to find Hero place
    Made by: ronix
    ***************************/
    // no need to cache this method
    function FindHeroInVil($wid) {
    list($wid) = $this->escape_input($wid);

        $result = $this->query("SELECT hero FROM ".TB_PREFIX."units WHERE hero>0 AND vref='".$wid."' LIMIT 1");
        if (!empty($result)) {
            $dbarray = mysqli_fetch_array($result);
            if(isset($dbarray['hero'])) {
                $this->query("UPDATE ".TB_PREFIX."units SET hero=0 WHERE vref='".$wid."'");
                unset($dbarray);
                return true;
            }
        }
        return false;
    }

    // no need to cache this method
    function FindHeroInDef($wid) {
        list($wid) = $this->escape_input($wid);

            $delDef=true;
            $result = $this->query_return("SELECT * FROM ".TB_PREFIX."enforcement WHERE hero>0 AND `from` = ".$wid);
            if (!empty($result)) {
                $dbarray = $result;
                if(isset($dbarray['hero'])) {
                    $this->query("UPDATE ".TB_PREFIX."enforcement SET hero=0 WHERE `from` = ".$wid);
                    for ($i=0;$i<50;$i++) {
                        if($dbarray['u'.$i]>0) {
                            $delDef=false;
                            break;
                        }
                    }
                    if ($delDef) $this->deleteReinf($wid);
                    unset($dbarray);
                    return true;
                }
            }
            return false;
    }

    // no need to cache this method
    function FindHeroInOasis($uid) {
        list($uid) = $this->escape_input($uid);

        $delDef=true;
        $dbarray = $this->query_return("SELECT e.*,o.conqured,o.owner FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.owner=".$uid." AND e.hero>0");
        if(!empty($dbarray)) {
            foreach($dbarray as $defoasis) {
                if($defoasis['hero']>0) {
                    $this->query("UPDATE ".TB_PREFIX."enforcement SET hero=0 WHERE `from` = ".$defoasis['from']);
                    for ($i=0;$i<50;$i++) {
                        if($dbarray['u'.$i]>0) {
                            $delDef=false;
                            break;
                        }
                    }
                    if ($delDef) $this->deleteReinf($defoasis['from']);
                    unset($dbarray);
                    return true;
                }
            }
        }
        return 0;
    }

    // no need to cache this method
    function FindHeroInMovement($wid) {
        list($wid) = $this->escape_input($wid);

        $outgoingarray = $this->getMovement(3, $wid, 0);
        if(!empty($outgoingarray)) {
            foreach($outgoingarray as $out) {
                if ($out['t11']>0) {
                    $dbarray = $this->query("UPDATE ".TB_PREFIX."attacks SET t11=0 WHERE `id` = ".$out['ref']);
                    return true;
                    break;
                }
            }
        }
        $returningarray = $this->getMovement(4, $wid, 1);
        if(!empty($returningarray)) {
            foreach($returningarray as $ret) {
                if($ret['attack_type'] != 1 && $ret['t11']>0) {
                    $dbarray = $this->query("UPDATE ".TB_PREFIX."attacks SET t11=0 WHERE `id` = ".$ret['ref']);
                    return true;
                    break;
                }
            }
        }
        return false;
    }

	/***************************
	Function checkAttack
	Made by: Shadow
	***************************/
    // no need to cache this method
    function checkAttack($wref, $toWref) {
        list($wref, $toWref) = $this->escape_input((int) $wref, (int) $toWref);

        $q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.from = $wref and " . TB_PREFIX . "movement.to = $toWref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and (" . TB_PREFIX . "attacks.attack_type = 3 or " . TB_PREFIX . "attacks.attack_type = 4) ORDER BY endtime ASC";
        $result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);

        if ($result['Total']) {
            return true;
        } else {
            return false;
        }
    }

	/***************************
	Function checkEnforce
	Made by: Shadow
	***************************/
    // no need to cache this method
	function checkEnforce($wref, $toWref) {
	    list($wref, $toWref) = $this->escape_input((int) $wref, (int) $toWref);

    		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.from = $wref and " . TB_PREFIX . "movement.to = $toWref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 2 ORDER BY endtime ASC";
    		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
    		if($result['Total']) {
    		return true;
     		}else{
    		return false;
    		}
  	}

	/***************************
  	Function checkScout
  	Made by: yi12345
  	***************************/
    // no need to cache this method
	function checkScout($wref, $toWref) {
	    list($wref, $toWref) = $this->escape_input((int) $wref, (int) $toWref);

    		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.from = $wref and " . TB_PREFIX . "movement.to = $toWref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 1 ORDER BY endtime ASC";
    		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
    		if($result['Total']) {
     		return true;
    		}else{
    		return false;
     		}
   	}

};

// database is not needed if we're displaying static pages
$req_file = basename($_SERVER['PHP_SELF']);
if (!in_array($req_file, ['tutorial.php', 'anleitung.php'])) {
    $database = new MYSQLi_DB(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB, (defined('SQL_PORT') ? SQL_PORT : 3306));
    $link = $database->return_link();
    $GLOBALS['db'] = $database;
    $GLOBALS['link'] = $database->return_link();

    // register all functions to be executed when the script is over,
    // so we can flush any SQL caches we may still have pending
    register_shutdown_function(function() {
        global $database;
        $database->sendPendingMessages();
    });
}
?>