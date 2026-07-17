<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Database.php                      	                       ##
##  Type           : Database Cache System and Methods                         ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Reworked by    : martinambrus	     	       				   			   ##
##  Thanks to      : InCube, Akakori, Elmar & Kirilloid                        ##
##  Split&Refactor : Shadow													   ##
##  Phase S1       : Methods split into 14 traits (GameEngine/Database/)       ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
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

// === Phase S1: the MYSQLi_DB class has been split into domain-specific traits (GameEngine/Database/) ===
// The traits are in the global namespace, so they are included explicitly (the autoloader only maps the App\ namespace).
include_once __DIR__ . '/Database/DatabaseConnectionCore.php';
include_once __DIR__ . '/Database/DatabaseUserQueries.php';
include_once __DIR__ . '/Database/DatabaseVillageQueries.php';
include_once __DIR__ . '/Database/DatabaseForumQueries.php';
include_once __DIR__ . '/Database/DatabaseAllianceQueries.php';
include_once __DIR__ . '/Database/DatabaseMessageQueries.php';
include_once __DIR__ . '/Database/DatabaseMarketQueries.php';
include_once __DIR__ . '/Database/DatabaseBuildingQueries.php';
include_once __DIR__ . '/Database/DatabaseTroopQueries.php';
include_once __DIR__ . '/Database/DatabaseMovementQueries.php';
include_once __DIR__ . '/Database/DatabaseHeroQueries.php';
include_once __DIR__ . '/Database/DatabaseStatisticsQueries.php';
include_once __DIR__ . '/Database/DatabaseArtefactQueries.php';
include_once __DIR__ . '/Database/DatabaseSystemQueries.php';

use App\Database\IDbConnection;
use App\Utils\Math;

class MYSQLi_DB implements IDbConnection {
    // === Phase S1: class methods grouped by domain ===
    use DatabaseConnectionCore;
    use DatabaseUserQueries;
    use DatabaseVillageQueries;
    use DatabaseForumQueries;
    use DatabaseAllianceQueries;
    use DatabaseMessageQueries;
    use DatabaseMarketQueries;
    use DatabaseBuildingQueries;
    use DatabaseTroopQueries;
    use DatabaseMovementQueries;
    use DatabaseHeroQueries;
    use DatabaseStatisticsQueries;
    use DatabaseArtefactQueries;
    use DatabaseSystemQueries;



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

    // === REFACTOR v2 ===
    /** @var array Cache generic pe request pentru SELECT-uri */
    private $queryCache = [];

    /** @var array Cache statements pregătite */
    private $stmtCache = [];
    // === END REFACTOR v2 ===


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
	        // $this->dblink is FALSE here, so we cannot call mysqli_error() on it.
	        // Use mysqli_connect_error() and show a friendly, actionable message.
	        $error = mysqli_connect_error();
	        die("Database connection failed: " . htmlspecialchars(
	            $error !== null && $error !== ''
	                ? $error
	                : 'could not connect to the database server. Please check the host, port and credentials. (When running with Docker, the database host is usually "db", not "localhost".)'
	        ));
	    }

		// we will operate in UTF8
		mysqli_query($this->dblink,"SET NAMES 'UTF8'");
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