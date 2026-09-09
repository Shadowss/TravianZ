<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseConnectionCore.php                                  ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       MySQLi connection, query(), escaping, generic query cache   ##
##                                                                             ##
##  Phase S1: Trait extracted from GameEngine/Database.php                     ##
##            (MYSQLi_DB class).                                               ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

use App\Utils\Math;

trait DatabaseConnectionCore {


    private function countQueryType(string $sql): void {
        $trim = ltrim($sql);
        if (stripos($trim, 'SELECT') === 0) $this->selectQueryCount++;
        elseif (stripos($trim, 'INSERT') === 0) $this->insertQueryCount++;
        elseif (stripos($trim, 'UPDATE') === 0) $this->updateQueryCount++;
        elseif (stripos($trim, 'DELETE') === 0) $this->deleteQueryCount++;
        elseif (stripos($trim, 'REPLACE') === 0) $this->replaceQueryCount++;
    }

    private function fetchCached(string $key, string $sql, callable $fetcher) {
        if (isset($this->queryCache[$key])) return $this->queryCache[$key];
        $this->countQueryType($sql);
        $res = mysqli_query($this->dblink, $sql);
        $data = $fetcher($res);
        $this->queryCache[$key] = $data;
        return $data;
    }

    private function clearQueryCache(?string $prefix = null): void {
        if ($prefix === null) $this->queryCache = [];
        else foreach (array_keys($this->queryCache) as $k) if (strpos($k, $prefix)===0) unset($this->queryCache[$k]);
    }

	/**
	 * {@inheritDoc}
	 * @see \App\Database\IDbConnection::connect()
	 */
	public function connect() {
        $host = (string) $this->hostname;
        $port = (int) $this->port;
        if ($port <= 0) $port = 3306;

        // If host is in form host:port (common in env files), split it once.
        if (strpos($host, ':') !== false && substr_count($host, ':') === 1) {
            $hostPort = explode(':', $host, 2);
            if (isset($hostPort[0], $hostPort[1]) && is_numeric($hostPort[1])) {
                $host = $hostPort[0];
                $port = (int) $hostPort[1];
            }
        }

        $attempts = 15;
        $waitMicros = 1000000; // 1 second

        for ($i = 0; $i < $attempts; $i++) {
            try {
                $this->dblink = mysqli_connect($host, $this->username, $this->password, $this->dbname, $port);
            } catch (\Throwable $exception) {
                $this->dblink = false;
            }

            if ($this->dblink instanceof \mysqli) {
                // FIX (Faza 2 Global Chat, 09.09.2026): fara asta, conexiunea foloseste
                // charset-ul implicit al serverului MySQL, care poate sa nu fie utf8mb4 -
                // emoji-urile (caractere pe 4 octeti) ar pica cu eroare sau ar fi trunchiate
                // silentios la INSERT in chat_global.msg (acum utf8mb4). utf8mb4 e superset
                // peste utf8, deci restul tabelelor (ramase utf8) nu sunt afectate negativ.
                @mysqli_set_charset($this->dblink, 'utf8mb4');
                return true;
            }

            // During container startup DB may still be booting.
            if ($i < $attempts - 1) {
                usleep($waitMicros);
            }
        }

        return false;
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
        // REFACTORIZAT: garantăm array pentru PHP 7.2+, eliminăm escape pe resource
        $all = [];
        if($result instanceof \mysqli_result) {
            while($row = mysqli_fetch_assoc($result)) {
                $all[] = $row;
            }
            mysqli_free_result($result);
        }
        return $all;
    }

    function query_return($q) {
        $this->countQueryType($q);
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    /***************************
    Function to do free query
    References: Query
     ***************************/
    function query($query) {
        // REFACTORIZAT: contorizare centralizată
        $this->countQueryType($query);

        // HOTFIX deadlock (log 20-23 iul): pe PHP 8.1+ mysqli arunca mysqli_sql_exception,
        // deci un deadlock InnoDB (1213) / lock wait timeout (1205) omora tot tick-ul de
        // automation. Reincercam de maximum 3 ori cu pauza crescatoare; orice alta eroare
        // se arunca mai departe neschimbata. Sigur fata de tranzactii: singurele tranzactii
        // explicite din cod (updateStore, populateWorldData) folosesc mysqli_query direct,
        // nu metoda aceasta - verificat pe tot repo-ul.
        //
        // HOTFIX "MySQL server has gone away" (log 1-3 sep, cod 2006/CR_SERVER_GONE_ERROR
        // sau 2013/CR_SERVER_LOST): conexiunea poate cadea intre tick-urile ciclului intern
        // al cron.php (pana la CRON_LOOP_SECONDS=300s), la fel de fatal pe PHP 8.1+. Cod
        // separat de cel de deadlock (reconectam, nu doar reincercam): $this->reconnect()
        // (deja existent in acest trait) inchide si redeschide $this->dblink inainte de a
        // repeta interogarea. Maxim 2 reconectari, dupa care aruncam eroarea mai departe.
        $attempt = 0;
        $reconnectAttempt = 0;
        while (true) {
            try {
                return mysqli_query($this->dblink, $query);
            } catch (mysqli_sql_exception $e) {
                $code = (int) $e->getCode();

                if (in_array($code, [2006, 2013], true)) {
                    if (++$reconnectAttempt > 2) {
                        throw $e;
                    }
                    $this->reconnect();
                    usleep(150000 * $reconnectAttempt);
                    continue;
                }

                if (!in_array($code, [1213, 1205], true) || ++$attempt >= 3) {
                    throw $e;
                }
                usleep(150000 * $attempt); // 150ms, apoi 300ms
            }
        }
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

        if (isset($arrayVariable[$arrayStructure]) && !empty($arrayVariable[$arrayStructure])) {
            return $arrayVariable[$arrayStructure];
        } 
        else return null;
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
}
