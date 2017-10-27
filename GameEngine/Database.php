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
	    $this->dblink = mysqli_connect($this->hostname, $this->username, $this->password);

	    // return on error
	    if (mysqli_error($this->dblink)) {
	        return false;
	    }

	    // select the DB to use
	    mysqli_select_db($this->dblink, $this->dbname);

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
	    // check for SELECT
	    preg_match('/[^AZ-az]*(\()?[^AZ-az]*SELECT/i', $statement, $matches);	    

	    // SELECT statement it is...
	    if (count($matches)) {
            if ($prep = mysqli_prepare($this->dblink, $statement)) {
                // prepare all parameter types
                $types = [];

                foreach ($params as $param) {
                    // default to string, change if neccessary
                    $paramType = 's';
                    
                    if (Math::isInt($param)) {
                        $paramType = 'i';
                    } else if (Math::isFloat($param)) {
                        $paramType = 'd';
                    }
                    
                    $types[] = $paramType;
                }

                // dynamically bind parameters
                $bind_names = [implode('', $types)];
                for ($i=0; $i<count($params); $i++){
                    $bind_name = 'bind' . $i;
                    $$bind_name = $params[$i];
                    $bind_names[] = &$$bind_name;
                }
                call_user_func_array(array($prep, 'bind_param'),$bind_names);

                // execute the statement to get its value back
                if (mysqli_stmt_execute($prep)) {
                    $this->selectQueryCount++;
                    return mysqli_stmt_get_result($prep);
                } else {
                    throw new Exception('Failed to execute an SQL statement!');
                }
            } else {
                throw new Exception('Failed to prepare an SQL statement!');
            }
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

	function escape($value) {
	    $value = stripslashes($value);
	    return mysqli_real_escape_string($this->dblink, $value);
	}
	
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
	}
	function updateResource($vid, $what, $number) {
	    list($vid, $what, $number) = $this->escape_input((int) $vid, $what, (int) $number);


		$q = "UPDATE " . TB_PREFIX . "vdata set " . $what . "=" . $number . " where wref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_query($this->dblink,$q);
	}

	public function hasBeginnerProtection($vid) {
        list($vid) = $this->escape_input($vid);

        $q = "SELECT u.protect FROM ".TB_PREFIX."users u,".TB_PREFIX."vdata v WHERE u.id=v.owner AND v.wref=".(int) $vid;
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
        list($ref, $field, $value, $switch) = $this->escape_input($ref, $field, $value, $switch);

		if(!$switch) {
			$q = "UPDATE " . TB_PREFIX . "users set $field = '$value' where username = '$ref'";
		} else {
		    $q = "UPDATE " . TB_PREFIX . "users set $field = '$value' where id = " . (int) $ref;
		}
		return mysqli_query($this->dblink,$q);
	}

	function getSitee($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id from " . TB_PREFIX . "users where sit1 = $uid or sit2 = $uid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getVilWref($x, $y) {
	    list($x, $y) = $this->escape_input((int) $x, (int) $y);

		$q = "SELECT * FROM " . TB_PREFIX . "wdata where x = $x AND y = $y";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['id'];
	}
	
	function caststruc($user) {
	    list($user) = $this->escape_input((int) $user);

		//loop search village user
		$query = mysqli_query($this->dblink,"SELECT * FROM ".TB_PREFIX."vdata WHERE owner = ".$user);
		while($villaggi_array = mysqli_fetch_array($query))

		//loop structure village
		    $query1 = mysqli_query($this->dblink,"SELECT * FROM ".TB_PREFIX."fdata WHERE vref = ".(int) $villaggi_array['wref']."");
		$strutture= mysqli_fetch_array($query1);
		return $strutture;
	}
	
	function removeMeSit($uid, $uid2) {
	    list($uid, $uid2) = $this->escape_input((int) $uid, (int) $uid2);

		$q = "UPDATE " . TB_PREFIX . "users set sit1 = 0 where id = $uid and sit1 = $uid2";
		mysqli_query($this->dblink,$q);
		$q2 = "UPDATE " . TB_PREFIX . "users set sit2 = 0 where id = $uid and sit2 = $uid2";
		mysqli_query($this->dblink,$q2);
	}

    function getUserField($ref, $field, $mode) {
        list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);
        
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
        if($result) {
            $dbarray = mysqli_fetch_array($result);
            return $dbarray[$field];
        }elseif($field=="username"){
            return "??";
        }else return 0;    
    }

	function getInvitedUser($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "users where invited = $uid order by regtime desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getVrefField($ref, $field) {
	    list($ref, $field) = $this->escape_input((int) $ref, $field);
			$q = "SELECT $field FROM " . TB_PREFIX . "vdata where wref = $ref";
			$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
			$dbarray = mysqli_fetch_array($result);
			return $dbarray[$field];
	}

	function getVrefCapital($ref) {
	    list($ref) = $this->escape_input((int) $ref);
		$q = "SELECT * FROM " . TB_PREFIX . "vdata where owner = $ref and capital = 1";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray;
	}

	function getStarvation() {
			$q = "SELECT * FROM " . TB_PREFIX . "vdata where starv != 0 and owner != 3";
			$result = mysqli_query($this->dblink,$q);
			return $this->mysqli_fetch_all($result);
	}

	function getUnstarvation() {
      			$q = "SELECT * FROM " . TB_PREFIX . "vdata where starv = 0 and starvupdate = 0";
      			$result = mysqli_query($this->dblink,$q);
      			return $this->mysqli_fetch_all($result);
  	} 

	function getActivateField($ref, $field, $mode) {
        list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);

		if(!$mode) {
		    $q = "SELECT $field FROM " . TB_PREFIX . "activate where id = " . (int) $ref;
		} else {
			$q = "SELECT $field FROM " . TB_PREFIX . "activate where username = '$ref'";
		}
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function login($username, $password) {
        list($username, $password) = $this->escape_input($username, $password);
		$q = "SELECT id,password,sessid,is_bcrypt FROM " . TB_PREFIX . "users where username = '$username'";
		$result = mysqli_query($this->dblink,$q);
		
		// if we didn't update the database for bcrypt hashes yet...
		if (mysqli_error($this->dblink) != '') {
		    $q = "SELECT id, password,sessid,0 as is_bcrypt FROM " . TB_PREFIX . "users where username = '$username'";
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
			return true;
		} else {
			return false;
		}
	}

	function checkActivate($act) {
        list($act) = $this->escape_input($act);

		$q = "SELECT * FROM " . TB_PREFIX . "activate where act = '$act'";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

		return $dbarray;
	}

	function sitterLogin($username, $password) {
        list($username, $password) = $this->escape_input($username, $password);

		$q = "SELECT sit1,sit2 FROM " . TB_PREFIX . "users where username = '$username' and access != " . BANNED;
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['sit1'] != 0) {
		    $q2 = "SELECT password FROM " . TB_PREFIX . "users where id = " . (int) $dbarray['sit1'] . " and access != " . BANNED;
			$result2 = mysqli_query($this->dblink,$q2);
			$dbarray2 = mysqli_fetch_array($result2);
		}
		if($dbarray['sit2'] != 0) {
		    $q3 = "SELECT password FROM " . TB_PREFIX . "users where id = " . (int) $dbarray['sit2'] . " and access != " . BANNED;
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

		$q = "SELECT timestamp from " . TB_PREFIX . "deleting where uid = $uid";
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

	function getUserArray($ref, $mode) {
        list($ref, $mode) = $this->escape_input($ref, $mode);

		if(!$mode) {
			$q = "SELECT * FROM " . TB_PREFIX . "users where username = '$ref'";
		} else {
		    $q = "SELECT * FROM " . TB_PREFIX . "users where id = " . (int) $ref;
		}
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
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
        list($username, $time) = $this->escape_input($username, $time);

		$q = "REPLACE into " . TB_PREFIX . "active values ('$username',$time)";
		$q2 = "UPDATE " . TB_PREFIX . "users set timestamp = $time where username = '$username'";
		$exec1 = mysqli_query($this->dblink,$q);
		$exec2 = mysqli_query($this->dblink,$q2);
		if($exec1 && $exec2) {
			return true;
		} else {
			return false;
		}
	}

	function checkactiveSession($username, $sessid) {
        list($username, $sessid) = $this->escape_input($username, $sessid);

		$q = "SELECT username FROM " . TB_PREFIX . "users where username = '$username' and sessid = '$sessid' LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result) != 0) {
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

	function GetOnline($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT sit FROM " . TB_PREFIX . "online where uid = $uid";
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

    while (!$num_rows){
    if (!$mode) {
        $gamesday=time()-COMMENCE;
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
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "wdata set occupied = 1 where id = ". $id;
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
		return mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
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
    function isVillageOases($wref) {
        list($wref) = $this->escape_input((int) $wref);

        $q = "SELECT id, oasistype FROM " . TB_PREFIX . "wdata where id = ". $wref;
        $result = mysqli_query($this->dblink,$q);
        if($result){
            $dbarray = mysqli_fetch_array($result);
            return $dbarray['oasistype'];
        }else return 0;    
    }

	public function VillageOasisCount($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT count(*) FROM `".TB_PREFIX."odata` WHERE conqured=". $vref;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

	 public function countOasisTroops($vref) {
	     list($vref) = $this->escape_input((int) $vref);
		//count oasis troops: $troops_o
	$troops_o=0;
	$o_unit2=mysqli_query($this->dblink,"select * from ".TB_PREFIX."units where `vref`=".$vref);
	$o_unit=mysqli_fetch_array($o_unit2);

	for ($i=1;$i<51;$i++)
	{
		$troops_o+=$o_unit[$i];
	}
	$troops_o+=$o_unit['hero'];

	$o_unit2=mysqli_query($this->dblink,"select * from ".TB_PREFIX."enforcement where `vref`=".$vref);
	while ($o_unit=@mysqli_fetch_array($o_unit2))
	{
		for ($i=1;$i<51;$i++)
		{
			$troops_o+=$o_unit[$i];
		}
		$troops_o+=$o_unit['hero'];
	}
	return $troops_o;
	}

    public function canConquerOasis($vref,$wref) {
        list($vref,$wref) = $this->escape_input($vref,$wref);

        $AttackerFields = $this->getResourceLevel($vref);
        for($i=19;$i<=38;$i++) {
            if($AttackerFields['f'.$i.'t'] == 37) { $HeroMansionLevel = $AttackerFields['f'.$i]; }
        }
        if($this->VillageOasisCount($vref) < floor(($HeroMansionLevel-5)/5)) {
            $OasisInfo = $this->getOasisInfo($wref);
            //fix by ronix
            if($OasisInfo['conqured'] == 0 || $OasisInfo['conqured'] != 0 && intval($OasisInfo['loyalty']) < 99 / min(3,(4-$this->VillageOasisCount($OasisInfo['conqured'])))){ 
                $CoordsVillage = $this->getCoor($vref);
                $CoordsOasis = $this->getCoor($wref);
                                $max = 2 * WORLD_MAX + 1;
                        $x1 = intval($CoordsOasis['x']);
                        $y1 = intval($CoordsOasis['y']);
                        $x2 = intval($CoordsVillage['x']);
                        $y2 = intval($CoordsVillage['y']);
                        $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
                        $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
                    if ($distanceX<=3 && $distanceY<=3) {
                    return 1; //can
                } else {
                    return 2; //can but not in 7x7 field
                }
            } else {
                return 3; //loyalty >0
            }
        } else {
            return 0; //req level hero mansion
        }
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
	function getVillageType($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT id, fieldtype FROM " . TB_PREFIX . "wdata where id = ".$wref;
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['fieldtype'];
	}



	/*****************************************
	Function to retrieve if is ocuped via ID
	References: Village ID
	*****************************************/
	function getVillageState($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT oasistype,occupied FROM " . TB_PREFIX . "wdata where id = ".$wref;
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['occupied'] != 0 || $dbarray['oasistype'] != 0) {
			return true;
		} else {
			return false;
		}
	}

	function getProfileVillages($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT capital,wref,name,pop,created from " . TB_PREFIX . "vdata where owner = $uid order by pop desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getProfileMedal($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id,categorie,plaats,week,img,points from " . TB_PREFIX . "medal where userid = $uid and del = 0 order by id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);

	}

	function getProfileMedalAlly($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT id,categorie,plaats,week,img,points from " . TB_PREFIX . "allimedal where allyid = $uid and del = 0 order by id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);

	}

	function getVillageID($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT wref FROM " . TB_PREFIX . "vdata WHERE owner = $uid";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['wref'];
	}


	function getVillagesID($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT wref from " . TB_PREFIX . "vdata where owner = $uid order by capital DESC,pop DESC";
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		$newarray = array();
		for($i = 0; $i < count($array); $i++) {
			array_push($newarray, $array[$i]['wref']);
		}
		return $newarray;
	}
	
	function getVillagesID2($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT wref from " . TB_PREFIX . "vdata where owner = $uid order by capital DESC,pop DESC";
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

	function getVillage($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "vdata where wref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	public function getVillageBattleData($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT u.id,u.tribe,v.capital,f.f40 AS wall FROM ".TB_PREFIX."users u,".TB_PREFIX."fdata f,".TB_PREFIX."vdata v WHERE u.id=v.owner AND f.vref=v.wref AND v.wref=".$vid;
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	public function getPopulation($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT sum(pop) AS pop FROM ".TB_PREFIX."vdata WHERE owner=".$uid;
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['pop'];
	}

	function getOasisV($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "odata where wref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function getMInfo($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "wdata left JOIN " . TB_PREFIX . "vdata ON " . TB_PREFIX . "vdata.wref = " . TB_PREFIX . "wdata.id where " . TB_PREFIX . "wdata.id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function getOMInfo($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "wdata left JOIN " . TB_PREFIX . "odata ON " . TB_PREFIX . "odata.wref = " . TB_PREFIX . "wdata.id where " . TB_PREFIX . "wdata.id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function getOasis($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "odata where conqured = $vid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getOasisInfo($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$q = "SELECT * FROM " . TB_PREFIX . "odata where wref = $wid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

    function getVillageField($ref, $field) {
        list($ref, $field) = $this->escape_input((int) $ref, $field);

        $q = "SELECT $field FROM " . TB_PREFIX . "vdata where wref = $ref";
        $result = mysqli_query($this->dblink,$q);
        if($result){
            $dbarray = mysqli_fetch_array($result);
            return $dbarray[$field];
         }elseif($field=="name"){
            return "??";
        }else return 0;    
    }

	function getOasisField($ref, $field) {
	    list($ref, $field) = $this->escape_input((int) $ref, $field);

		$q = "SELECT $field FROM " . TB_PREFIX . "odata where wref = $ref";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function setVillageField($ref, $field, $value) {
	    list($ref, $field, $value) = $this->escape_input((int) $ref, $field, $value);

		$q = "UPDATE " . TB_PREFIX . "vdata set $field = '$value' where wref = $ref";
		return mysqli_query($this->dblink,$q);
	}

	function setVillageLevel($ref, $field, $value) {
	    list($ref, $field, $value) = $this->escape_input((int) $ref, $field, $value);

		$q = "UPDATE " . TB_PREFIX . "fdata set " . $field . " = '" . $value . "' where vref = " . $ref . "";
		return mysqli_query($this->dblink,$q);
	}

	function getResourceLevel($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * from " . TB_PREFIX . "fdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
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

	function getCoor($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		if ($wref !=""){
		$q = "SELECT x,y FROM " . TB_PREFIX . "wdata where id = $wref";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
		}
	}

	function CheckForum($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where alliance = '$id'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function CountCat($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_topic where cat = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

	function LastTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' order by post_date";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function CheckLastTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function CheckLastPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function LastPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function CountTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_post where owner = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

		$qs = "SELECT count(id) FROM " . TB_PREFIX . "forum_topic where owner = '$id'";
		$results = mysqli_query($this->dblink,$qs);
		$rows = mysqli_fetch_row($results);
		return $row[0] + $rows[0];
	}

	function CountPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT count(id) FROM " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

	function ForumCat($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where alliance = '$id' ORDER BY id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function ForumCatEdit($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_cat where id = '$id'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function ForumCatAlliance($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT alliance from " . TB_PREFIX . "forum_cat where id = $id";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['alliance'];
	}

	function ForumCatName($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT forum_name from " . TB_PREFIX . "forum_cat where id = $id";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['forum_name'];
	}

	function CheckCatTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function CheckResultEdit($alli) {
        list($alli) = $this->escape_input($alli);

		$q = "SELECT * from " . TB_PREFIX . "forum_edit where alliance = '$alli'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function CheckCloseTopic($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT close from " . TB_PREFIX . "forum_topic where id = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['close'];
	}

	function CheckEditRes($alli) {
        list($alli) = $this->escape_input($alli);

		$q = "SELECT result from " . TB_PREFIX . "forum_edit where alliance = '$alli'";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['result'];
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
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT * FROM " . TB_PREFIX . "wdata where id = $wref";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['oasistype'];
	}

	function getVillageType3($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT * FROM " . TB_PREFIX . "wdata where id = $wref";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray;
	}

	function getFLData($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "farmlist where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function checkVilExist($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT * FROM " . TB_PREFIX . "vdata where wref = '$wref'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	function checkOasisExist($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT * FROM " . TB_PREFIX . "odata where wref = '$wref'";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
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

	function ForumCatTopic($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' AND stick = '' ORDER BY post_date desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function ForumCatTopicStick($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where cat = '$id' AND stick = '1' ORDER BY post_date desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function ShowTopic($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "forum_topic where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function ShowPost($id) {
        list($id) = $this->escape_input($id);

		$q = "SELECT * from " . TB_PREFIX . "forum_post where topic = '$id'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

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
        list($title, $post, $cat, $owner, $alli, $ends, $alliance, $player, $coor, $report) = $this->escape_input($title, $post, $cat, $owner, $alli, $ends, (int) $alliance, (int) $player, (int) $coor, (int) $report);

        $date = time();
        $q = "INSERT into " . TB_PREFIX . "forum_topic values (0,'$title','$post','$date','$date','$cat','$owner','$alli','$ends','','',$alliance,$player,$coor,$report)";
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

  function getSurvey($topic) {
      list($topic) = $this->escape_input((int) $topic);

    $q = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic";
    $result = mysqli_query($this->dblink,$q);
    return mysqli_fetch_array($result);
  }

  function checkSurvey($topic) {
      list($topic) = $this->escape_input((int) $topic);

    $q = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic";
    $result = mysqli_query($this->dblink,$q);
    if(mysqli_num_rows($result)) {
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

  function checkVote($topic, $uid) {
      list($topic, $uid) = $this->escape_input((int) $topic, $uid);

        $q = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic";
    $result = mysqli_query($this->dblink,$q);
    $array = mysqli_fetch_array($result);
    $text = $array['voted'];
    if(preg_match('/,'.$uid.',/',$text)) {
      return true;
    } else {
      return false;
    }
    }

  function getVoteSum($topic) {
      list($topic) = $this->escape_input((int) $topic);

        $q = "SELECT * FROM " . TB_PREFIX . "forum_survey where topic = $topic";
    $result = mysqli_query($this->dblink,$q);
    $array = mysqli_fetch_array($result);
    $sum = 0;
    for($i=1;$i<=8;$i++){
    $sum += $array['vote'.$i];
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
                            2,
                            'New Message in Alliance Forum',
                            "Hi!\n\n".$this->escape($session->username)." posted a new message into your common topic. Here\\'s a link that will get you there: <a href=\"".rtrim(SERVER, '/')."/allianz.php?s=2&amp;pid=2&amp;fid2=$fid2&amp;tid=$tids\">forum link</a>\n\nYours sincerely,\n<i>Server Robot :)</i>",
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
            foreach($array as $ss) {
                $this->DeleteSurvey($ss['id']);
            }
        }
        mysqli_query($this->dblink,$qs);
        return mysqli_query($this->dblink,$q);
    }
	
	function DeleteSurvey($id) {
        list($id) = $this->escape_input($id);

        $qs = "DELETE from " . TB_PREFIX . "forum_survey where topic = '$id'";
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

	function getAllianceName($id) {
	    list($id) = $this->escape_input((int) $id);

		if (!$id) {
			return '';
		}

		$q = "SELECT tag from " . TB_PREFIX . "alidata where id = $id";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['tag'];
	}

	function getAlliancePermission($ref, $field, $mode) {
        list($ref, $field, $mode) = $this->escape_input($ref, $field, $mode);

		if(!$mode) {
		    $q = "SELECT $field FROM " . TB_PREFIX . "ali_permission where uid = ". (int) $ref;
		} else {
			$q = "SELECT $field FROM " . TB_PREFIX . "ali_permission where username = '$ref'";
		}
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function getAlliance($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "alidata where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	function setAlliName($aid, $name, $tag) {
	    list($aid, $name, $tag) = $this->escape_input((int) $aid, $name, $tag);

		$q = "UPDATE " . TB_PREFIX . "alidata set name = '$name', tag = '$tag' where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function isAllianceOwner($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * from " . TB_PREFIX . "alidata where leader = ". $id;
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

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
	    list($aid, $points, $amt) = $this->escape_input((int) $aid, $points, (int) $amt);

		$q = "UPDATE " . TB_PREFIX . "users set $points = $points + $amt where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function modifyPointsAlly($aid, $points, $amt) {
	    list($aid, $points, $amt) = $this->escape_input((int) $aid, $points, (int) $amt);

		$q = "UPDATE " . TB_PREFIX . "alidata set $points = $points + $amt where id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	/*****************************************
	Function to create an alliance
	References:
	*****************************************/
	function createAlliance($tag, $name, $uid, $max) {
	    list($tag, $name, $uid, $max) = $this->escape_input($tag, $name, (int) $uid, (int) $max);

		$q = "INSERT into " . TB_PREFIX . "alidata values (0,'$name','$tag',$uid,0,0,0,'','',$max,'','','','','','','','','')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}
	
	function procAllyPop($aid) {
        list($aid) = $this->escape_input($aid);

		$ally = $this->getAlliance($aid);
		$memberlist = $this->getAllMember($ally['id']);
		$oldrank = 0;
		foreach($memberlist as $member) {
			$oldrank += $this->getVSumField($member['id'],"pop");
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

		$result = mysqli_query($this->dblink,"SELECT * FROM " . TB_PREFIX . "users where alliance = $aid");
		$num_rows = mysqli_num_rows($result);
		if($num_rows == 0) {
			$q = "DELETE FROM " . TB_PREFIX . "alidata WHERE id = $aid";
			mysqli_query($this->dblink,$q);
			return mysqli_insert_id($this->dblink);
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
		return mysqli_insert_id($this->dblink);
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


		$q = "UPDATE " . TB_PREFIX . "ali_permission SET rank = '$rank', opt1 = '$opt1', opt2 = '$opt2', opt3 = '$opt3', opt4 = '$opt4', opt5 = '$opt5', opt6 = '$opt6', opt7 = '$opt7' where uid = $uid && alliance =$aid";
		return mysqli_query($this->dblink,$q);
	}

	/*****************************************
	Function to read alliance permissions
	References: ID, notice, description
	*****************************************/
	function getAlliPermissions($uid, $aid) {
	    list($uid, $aid) = $this->escape_input((int) $uid, (int) $aid);

		$q = "SELECT * FROM " . TB_PREFIX . "ali_permission where uid = $uid && alliance = $aid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
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

	function getAllianceID($name) {
        list($name) = $this->escape_input($name);

		$q = "SELECT id FROM " . TB_PREFIX . "alidata WHERE tag ='" . $this->RemoveXSS($name) . "'";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['id'];
	}

	function getDiplomacy($aid) {
	    list($aid) = $this->escape_input((int) $aid);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE id = $aid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
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

	function diplomacyInviteCheck($session_alliance) {
	    list($session_alliance) = $this->escape_input((int) $session_alliance);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli2 = $session_alliance AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function diplomacyInviteCheck2($ally1, $ally2) {
	    list($ally1, $ally2) = $this->escape_input((int) $ally1, (int) $ally2);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $ally1 AND alli2 = $ally2 AND accepted = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getAllianceDipProfile($aid, $type) {
	    list($aid, $type) = $this->escape_input($aid, $type);
		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '$type' AND accepted = '1' OR alli2 = '$aid' AND type = '$type' AND accepted = '1'";
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

	function getAllianceWar($aid) {
	    list($aid) = $this->escape_input($aid);
		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
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

	function getAllianceAlly($aid, $type) {
	    list($aid, $type) = $this->escape_input($aid, $type);
		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE (alli1 = '$aid' or alli2 = '$aid') AND (type = '$type' AND accepted = '1')";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getAllianceWar2($aid) {
	    list($aid) = $this->escape_input($aid);
		$q = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = '$aid' AND type = '3' OR alli2 = '$aid' AND type = '3' AND accepted = '1'";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function diplomacyExistingRelationships($session_alliance) {
	    list($session_alliance) = $this->escape_input((int) $session_alliance);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli2 = $session_alliance AND accepted = 1";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

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
	
	function checkDiplomacyInviteAccept($aid, $type) {
	    list($aid, $type) = $this->escape_input((int) $aid, (int) $type);

		$q = "SELECT * FROM " . TB_PREFIX . "diplomacy WHERE alli1 = $aid AND type = $type AND accepted = 1 OR alli2 = $aid AND type = $type AND accepted = 1";
		$result = mysqli_query($this->dblink,$q);
		if($type == 3){
			return true;
		}else{
		if(mysqli_num_rows($result) < 4) {
			return true;
		} else {
			return false;
		}
		}
	}

	function setAlliForumdblink($aid, $dblink) {
	    list($aid, $dblink) = $this->escape_input((int) $aid, $dblink);

		$q = "UPDATE " . TB_PREFIX . "alidata SET `forumdblink` = '$dblink' WHERE id = $aid";
		return mysqli_query($this->dblink,$q);
	}

	function getUserAlliance($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT " . TB_PREFIX . "alidata.tag from " . TB_PREFIX . "users join " . TB_PREFIX . "alidata where " . TB_PREFIX . "users.alliance = " . TB_PREFIX . "alidata.id and " . TB_PREFIX . "users.id = $id";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		if($dbarray['tag'] == "") {
			return "-";
		} else {
			return $dbarray['tag'];
		}
	}

	/////////////ADDED BY BRAINIAC - THANK YOU

	 function modifyResource($vid, $wood, $clay, $iron, $crop, $mode) {
	     list($vid, $wood, $clay, $iron, $crop, $mode) = $this->escape_input((int) $vid, (int) $wood, (int) $clay, (int) $iron, (int) $crop, $mode);

            $shit = false;
    		$q="SELECT wood,clay,iron,crop,maxstore,maxcrop from " . TB_PREFIX . "vdata where wref = ".$vid."";
                $result = mysqli_query($this->dblink,$q);
    		$checkres= $this->mysqli_fetch_all($result);
                if(!$mode){
    		$nwood=$checkres[0]['wood']-$wood;
    		$nclay=$checkres[0]['clay']-$clay;
    		$niron=$checkres[0]['iron']-$iron;
    		$ncrop=$checkres[0]['crop']-$crop;
    		if($nwood<0 or $nclay<0 or $niron<0 or $ncrop<0){$shit=true;}
    		$dwood=($nwood<0)?0:$nwood;
    		$dclay=($nclay<0)?0:$nclay;
    		$diron=($niron<0)?0:$niron;
    		$dcrop=($ncrop<0)?0:$ncrop;
    	}else{
    		$nwood=$checkres[0]['wood']+$wood;
    		$nclay=$checkres[0]['clay']+$clay;
    		$niron=$checkres[0]['iron']+$iron;
    		$ncrop=$checkres[0]['crop']+$crop;
    		$dwood=($nwood>$checkres[0]['maxstore'])?$checkres[0]['maxstore']:$nwood;
    		$dclay=($nclay>$checkres[0]['maxstore'])?$checkres[0]['maxstore']:$nclay;
    		$diron=($niron>$checkres[0]['maxstore'])?$checkres[0]['maxstore']:$niron;
    		$dcrop=($ncrop>$checkres[0]['maxcrop'])?$checkres[0]['maxcrop']:$ncrop;
    		}
    	if(!$shit){
    		$q = "UPDATE " . TB_PREFIX . "vdata set wood = $dwood, clay = $dclay, iron = $diron, crop = $dcrop where wref = ".$vid;
    			return mysqli_query($this->dblink,$q); }else{return false;}
   	}

	function modifyOasisResource($vid, $wood, $clay, $iron, $crop, $mode) {
	    list($vid, $wood, $clay, $iron, $crop, $mode) = $this->escape_input((int) $vid, (int) $wood, (int) $clay, (int) $iron, (int) $crop, $mode);

        $shit = false;
		$q="SELECT wood,clay,iron,crop,maxstore,maxcrop from " . TB_PREFIX . "odata where wref = ".$vid."";
                $result = mysqli_query($this->dblink,$q);
    		$checkres= $this->mysqli_fetch_all($result);
                if(!$mode){
    		$nwood=$checkres[0]['wood']-$wood;
    		$nclay=$checkres[0]['clay']-$clay;
    		$niron=$checkres[0]['iron']-$iron;
    		$ncrop=$checkres[0]['crop']-$crop;
    		if($nwood<0 or $nclay<0 or $niron<0 or $ncrop<0){$shit=true;}
    		$dwood=($nwood<0)?0:$nwood;
    		$dclay=($nclay<0)?0:$nclay;
    		$diron=($niron<0)?0:$niron;
    		$dcrop=($ncrop<0)?0:$ncrop;
    	}else{
    		$nwood=$checkres[0]['wood']+$wood;
    		$nclay=$checkres[0]['clay']+$clay;
    		$niron=$checkres[0]['iron']+$iron;
    		$ncrop=$checkres[0]['crop']+$crop;
    		$dwood=($nwood>$checkres[0]['maxstore'])?$checkres[0]['maxstore']:$nwood;
    		$dclay=($nclay>$checkres[0]['maxstore'])?$checkres[0]['maxstore']:$nclay;
    		$diron=($niron>$checkres[0]['maxstore'])?$checkres[0]['maxstore']:$niron;
    		$dcrop=($ncrop>$checkres[0]['maxcrop'])?$checkres[0]['maxcrop']:$ncrop;
    		}
    	if(!$shit){
    		$q = "UPDATE " . TB_PREFIX . "odata set wood = $dwood, clay = $dclay, iron = $diron, crop = $dcrop where wref = ".$vid;
    			return mysqli_query($this->dblink,$q); }else{return false;}
   	}

	function getFieldLevel($vid, $field) {
	    list($vid, $field) = $this->escape_input((int) $vid, $field);

		$q = "SELECT f" . $field . " from " . TB_PREFIX . "fdata where vref = $vid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);	
		$row = mysqli_fetch_array($result);
		return $row["f" . $field];
	}

	function getFieldType($vid, $field) {
	    list($vid, $field) = $this->escape_input((int) $vid, $field);

		$q = "SELECT f" . $field . "t from " . TB_PREFIX . "fdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_array($result);
		return $row["f" . $field . "t"];
	}
	
	function getFieldDistance($wid) {
	    list($wid) = $this->escape_input((int) $wid);

        $q = "SELECT * FROM " . TB_PREFIX . "vdata where owner > 4 and wref != $wid";
        $array = $this->query_return($q);
        $coor = $this->getCoor($wid);
        $x1 = intval($coor['x']);
        $y1 = intval($coor['y']);
        $prevdist = 0;
        $q2 = "SELECT * FROM " . TB_PREFIX . "vdata where owner = 4";
        $array2 = mysqli_fetch_array(mysqli_query($this->dblink,$q2));
        $vill = $array2['wref'];
        if(mysqli_num_rows(mysqli_query($this->dblink,$q)) > 0){
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

	function getVSumField($uid, $field) {
	    list($uid, $field) = $this->escape_input((int) $uid, $field);

		if($field != "cp"){
		$q = "SELECT sum(" . $field . ") FROM " . TB_PREFIX . "vdata where owner = $uid";
		}else{
		$q = "SELECT sum(" . $field . ") FROM " . TB_PREFIX . "vdata where owner = $uid and natar = 0";
		}
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
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
	function getCel() {
		$time = time();
		$q = "SELECT * FROM " . TB_PREFIX . "vdata where celebration < $time AND celebration != 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
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
	    list($id) = $this->escape_input((int) $id);

		for($i = 1; $i <= 3; $i++) {
			$q = "UPDATE " . TB_PREFIX . "vdata SET exp" . $i . "=0 WHERE exp" . $i . "=" . $id;
			mysqli_query($this->dblink,$q);
		}
	}

	function getInvitation($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ali_invite where uid = $uid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function getInvitation2($uid, $aid) {
	    list($uid, $aid) = $this->escape_input((int) $uid, (int) $aid);

		$q = "SELECT * FROM " . TB_PREFIX . "ali_invite where uid = $uid and alliance = $aid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

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
		return mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
	}

	function removeInvitation($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "ali_invite where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function sendMessage($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report, $skip_escaping = false) {
	    if (!$skip_escaping) {
	       list($client, $owner, $topic, $message, $send, $alliance, $player, $coor, $report) = $this->escape_input((int) $client, (int) $owner, $topic, $message, (int) $send, (int) $alliance, (int) $player, (int) $coor, (int) $report);
	    }

		$time = time();
		$q = "INSERT INTO " . TB_PREFIX . "mdata values (0,$client,$owner,'$topic','$message',0,0,$send,$time,0,0,$alliance,$player,$coor,$report)";
		return mysqli_query($this->dblink,$q);
	}

	function setArchived($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "mdata set archived = 1 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function setNorm($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "mdata set archived = 0 where id = $id";
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
	function getMessage($id, $mode) {
	    global $session;

	    list($id, $mode) = $this->escape_input((int) $id, $mode);

	    // update $id if we should show Support messages for Admins and we are an admin
	    if (
	       ($session->access == MULTIHUNTER || $session->access == ADMIN)
	       && ADMIN_RECEIVE_SUPPORT_MESSAGES
	       && in_array($mode, [1,2,6,9,10,11])
	    ) {
	        $id = $id . ', 1';
	    }
	    
		global $session;
		switch($mode) {
			case 1:
				$q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target IN($id) and send = 0 and archived = 0 ORDER BY time DESC";
				break;
			case 2:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner IN($id) ORDER BY time DESC";
				break;
			case 3:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata where id = $id";
				break;
			case 4:
			    $q = "UPDATE " . TB_PREFIX . "mdata set viewed = 1 where id = $id AND target IN(".((($session->access == MULTIHUNTER || $session->access == ADMIN) && ADMIN_RECEIVE_SUPPORT_MESSAGES) ? $session->uid.',1' : $session->uid).")";
				break;
			case 5:
				$q = "UPDATE " . TB_PREFIX . "mdata set deltarget = 1,viewed = 1 where id = $id";
				break;
			case 6:
				$q = "SELECT * FROM " . TB_PREFIX . "mdata where target IN($id) and send = 0 and archived = 1";
				break;
			case 7:
				$q = "UPDATE " . TB_PREFIX . "mdata set delowner = 1 where id = $id";
				break;
			case 8:
				$q = "UPDATE " . TB_PREFIX . "mdata set deltarget = 1,delowner = 1,viewed = 1 where id = $id";
				break;
			case 9:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target IN($id) and send = 0 and archived = 0 and deltarget = 0 ORDER BY time DESC";
				break;
			case 10:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner IN($id) and delowner = 0 ORDER BY time DESC";
				break;
			case 11:
			    $q = "SELECT * FROM " . TB_PREFIX . "mdata where target IN($id) and send = 0 and archived = 1 and deltarget = 0";
				break;
		}
		if($mode <= 3 || $mode == 6 || $mode > 8) {
			$result = mysqli_query($this->dblink,$q);
			return $this->mysqli_fetch_all($result);
		} else {
			return mysqli_query($this->dblink,$q);
		}
	}

	function getDelSent($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE owner = $uid and delowner = 1 ORDER BY time DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getDelInbox($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target = $uid and deltarget = 1 ORDER BY time DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getDelArchive($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "mdata WHERE target = $uid and archived = 1 and deltarget = 1 OR owner = $uid and archived = 1 and delowner = 1 ORDER BY time DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function unarchiveNotice($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "ndata set ntype = archive, archive = 0 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function archiveNotice($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "update " . TB_PREFIX . "ndata set archive = ntype, ntype = 9 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function removeNotice($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "ndata set del = 1,viewed = 1 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function noticeViewed($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "ndata set viewed = 1 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

    function addNotice($uid, $toWref, $ally, $type, $topic, $data, $time = 0) {
    list($uid, $toWref, $ally, $type, $topic, $data, $time) = $this->escape_input($uid, $toWref, $ally, $type, $topic, $data, $time);

    	if($time == 0) {
    	$time = time();
    	}
    	$q = "INSERT INTO " . TB_PREFIX . "ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'$uid','$toWref','$ally','$topic',$type,'$data',$time,0)";
    	return mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
    }

	function getNotice($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid and del = 0 ORDER BY time DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getNotice2($id, $field) {
        list($id, $field) = $this->escape_input($id, $field);

		$q = "SELECT ".$field." FROM " . TB_PREFIX . "ndata where `id` = '$id'";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
	}

	function getNotice3($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid ORDER BY time DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getNotice4($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where id = $id ORDER BY time DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	function getUnViewNotice($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "ndata where uid = $uid AND viewed=0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	function createTradeRoute($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time) {
	    list($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time) = $this->escape_input((int) $uid,(int) $wid,(int) $from,(int) $r1,(int) $r2,(int) $r3,(int) $r4,(int) $start,(int) $deliveries,(int) $merchant,(int) $time);

	$x = "UPDATE " . TB_PREFIX . "users SET gold = gold - 2 WHERE id = ".$uid;
		mysqli_query($this->dblink,$x);
		$timeleft = time()+604800;
	$q = "INSERT into " . TB_PREFIX . "route values (0,$uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time,$timeleft)";
		return mysqli_query($this->dblink,$q);
	}

	function getTradeRoute($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "route where uid = $uid ORDER BY timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getTradeRoute2($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "route where id = $id";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray;
	}

	function getTradeRouteUid($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "route where id = $id";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['uid'];
	}

	function editTradeRoute($id,$column,$value,$mode) {
	    list($id,$column,$value,$mode) = $this->escape_input((int) $id,$column,(int) $value,$mode);

	if(!$mode){
		$q = "UPDATE " . TB_PREFIX . "route set $column = $value where id = $id";
	}else{
		$q = "UPDATE " . TB_PREFIX . "route set $column = $column + $value where id = $id";
	}
		return mysqli_query($this->dblink,$q);
	}

	function deleteTradeRoute($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "route where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	function addBuilding($wid, $field, $type, $loop, $time, $master, $level) {
	    list($wid, $field, $type, $loop, $time, $master, $level) = $this->escape_input((int) $wid, $field, (int) $type, (int) $loop, (int) $time, (int) $master, (int) $level);

		$x = "UPDATE " . TB_PREFIX . "fdata SET f" . $field . "t=" . $type . " WHERE vref=" . $wid;
		mysqli_query($this->dblink,$x) or die(mysqli_error($this->dblink));
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
                $result = mysqli_query($this->dblink,$x) or die(mysqli_error($this->dblink));
                $fieldlevel = mysqli_fetch_row($result);
                    if($fieldlevel[0] == 0) {
                    if ($village->natar==1 && $jobs[$jobDeleted]['field']==99) { //fix by ronix
                    }else{    
                        $x = "UPDATE " . TB_PREFIX . "fdata SET f" . $jobs[$jobDeleted]['field'] . "t=0 WHERE vref=" . (int) $jobs[$jobDeleted]['wid'];
                        mysqli_query($this->dblink,$x) or die(mysqli_error($this->dblink));
                    }    
                }
			}
			if(($jobLoopconID >= 0) && ($jobs[$jobDeleted]['loopcon'] != 1)) {
				if(($jobs[$jobLoopconID]['field'] <= 18 && $jobs[$jobDeleted]['field'] <= 18) || ($jobs[$jobLoopconID]['field'] >= 19 && $jobs[$jobDeleted]['field'] >= 19) || sizeof($jobs) < 3) {
					$uprequire = $building->resourceRequired($jobs[$jobLoopconID]['field'], $jobs[$jobLoopconID]['type']);
					$x = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0,timestamp=" . (time() + (int) $uprequire['time']) . " WHERE wid=" . (int) $jobs[$jobDeleted]['wid'] . " AND loopcon=1 AND master=0";
					mysqli_query($this->dblink,$x) or die(mysqli_error($this->dblink));
				}
			}
		}
		$q = "DELETE FROM " . TB_PREFIX . "bdata where id = $d";
		return mysqli_query($this->dblink,$q);
	}

	function addDemolition($wid, $field) {
	    list($wid, $field) = $this->escape_input((int) $wid, (int) $field);

		global $building, $village;
		$q = "DELETE FROM ".TB_PREFIX."bdata WHERE field=$field AND wid=$wid";
		mysqli_query($this->dblink,$q);
		$uprequire = $building->resourceRequired($field,$village->resarray['f'.$field.'t'],0);
		$q = "INSERT INTO ".TB_PREFIX."demolition VALUES (".$wid.",".$field.",".($this->getFieldLevel($wid,$field)-1).",".(time()+floor($uprequire['time']/2)).")";
		return mysqli_query($this->dblink,$q);
	}


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
        	return mysqli_affected_rows();
    	}  

	function delDemolition($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$q = "DELETE FROM " . TB_PREFIX . "demolition WHERE vref=" . $wid;
		return mysqli_query($this->dblink,$q);
	}

	function getJobs($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid order by master,timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function FinishWoodcutter($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$time = time()-1;
		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and type = 1 order by master,timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		$q = "UPDATE ".TB_PREFIX."bdata SET timestamp = $time WHERE id = '".$dbarray['id']."'";
		$this->query($q);
		$tribe = $this->getUserField($this->getVillageField($wid, "owner"), "tribe", 0);
		if($tribe == 1){
		$q2 = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and loopcon = 1 and field >= 19 order by master,timestamp ASC";
		}else{
		$q2 = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and loopcon = 1 order by master,timestamp ASC";
		}
		$result2 = mysqli_query($this->dblink,$q2);
		if(mysqli_num_rows($result2) > 0){
		$dbarray2 = mysqli_fetch_array($result2);
		$wc_time = $dbarray['timestamp'];
		$q2 = "UPDATE ".TB_PREFIX."bdata SET timestamp = timestamp - $wc_time WHERE id = '".$dbarray2['id']."'";
		$this->query($q2);
		}
	}

	function getMasterJobs($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and master = 1 order by master,timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getMasterJobsByField($wid,$field) {
	    list($wid,$field) = $this->escape_input((int) $wid,(int) $field);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and field = $field and master = 1 order by master,timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getBuildingByField($wid,$field) {
	    list($wid,$field) = $this->escape_input((int) $wid,(int) $field);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and field = $field and master = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function getBuildingByField2($wid,$field) {
	    list($wid,$field) = $this->escape_input((int) $wid,(int) $field);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and field = $field and master = 0";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_num_rows($result);
	}

	function getBuildingByType($wid,$type) {
	    list($wid,$type) = $this->escape_input((int) $wid,(int) $type);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and type = $type and master = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function getBuildingByType2($wid,$type) {
	    list($wid,$type) = $this->escape_input((int) $wid,(int) $type);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and type = $type and master = 0";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_num_rows($result);
	}

	function getDorf1Building($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and field < 19 and master = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getDorf2Building($wid) {
	    list($wid) = $this->escape_input((int) $wid);

		$q = "SELECT * FROM " . TB_PREFIX . "bdata where wid = $wid and field > 18 and master = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function updateBuildingWithMaster($id, $time,$loop) {
	    list($id, $time,$loop) = $this->escape_input((int) $id, (int) $time,(int) $loop);

		$q = "UPDATE " . TB_PREFIX . "bdata SET master = 0, timestamp = ".$time.",loopcon = ".$loop." WHERE id = ".$id."";
		return mysqli_query($this->dblink,$q);
	}

	function getVillageByName($name) {
        list($name) = $this->escape_input($name);

		$q = "SELECT wref FROM " . TB_PREFIX . "vdata where name = '$name' limit 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['wref'];
	}

	/***************************
	Function to set accept flag on market
	References: id
	***************************/
	function setMarketAcc($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "UPDATE " . TB_PREFIX . "market set accept = 1 where id = $id";
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to send resource to other village
	Mode 0: Send
	Mode 1: Cancel
	References: Wood/ID, Clay, Iron, Crop, Mode
	***************************/
	function sendResource($ref, $clay, $iron, $crop, $merchant, $mode) {
	    list($ref, $clay, $iron, $crop, $merchant, $mode) = $this->escape_input((int) $ref, (int) $clay, (int) $iron, (int) $crop, (int) $merchant, $mode);

		if(!$mode) {
			$q = "INSERT INTO " . TB_PREFIX . "send values (0,$ref,$clay,$iron,$crop,$merchant)";
			mysqli_query($this->dblink,$q);
			return mysqli_insert_id($this->dblink);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "send where id = $ref";
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

	function getMarketField($vref, $field) {
        list($vref, $field) = $this->escape_input($vref, $field);

		$q = "SELECT $field FROM " . TB_PREFIX . "market where vref = '$vref'";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$field];
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
	function getMarketInfo($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "market where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	function setMovementProc($moveid) {
	    list($moveid) = $this->escape_input((int) $moveid);

		$q = "UPDATE " . TB_PREFIX . "movement set proc = 1 where moveid = $moveid";
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to retrieve used merchant
	References: Village
	***************************/
	function totalMerchantUsed($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$time = time();
		$q = "SELECT sum(" . TB_PREFIX . "send.merchant) from " . TB_PREFIX . "send, " . TB_PREFIX . "movement where " . TB_PREFIX . "movement.from = '$vid' and " . TB_PREFIX . "send.id = " . TB_PREFIX . "movement.ref and " . TB_PREFIX . "movement.proc = 0 and sort_type = 0";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		$q2 = "SELECT sum(ref) from " . TB_PREFIX . "movement where sort_type = 2 and " . TB_PREFIX . "movement.to = '$vid' and proc = 0";
		$result2 = mysqli_query($this->dblink,$q2);
		$row2 = mysqli_fetch_row($result2);
		$q3 = "SELECT sum(merchant) from " . TB_PREFIX . "market where vref = $vid and accept = 0";
		$result3 = mysqli_query($this->dblink,$q3);
		$row3 = mysqli_fetch_row($result3);
		return $row[0] + $row2[0] + $row3[0];
	}

	function getMovement($type, $village, $mode) {
        list($type, $village, $mode) = $this->escape_input($type, $village, $mode);

		$time = time();
		if(!$mode) {
			$where = "from";
		} else {
			$where = "to";
		}
		switch($type) {
			case 0:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "send where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "send.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 0 ORDER BY endtime ASC";
				break;
			case 1:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "send where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "send.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 6 ORDER BY endtime ASC";
				break;
			case 2:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 2 ORDER BY endtime ASC";
				break;
			case 3:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				break;
			case 4:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 4 ORDER BY endtime ASC";
				break;
			case 5:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement." . $where . " = '$village' and sort_type = 5 and proc = 0 ORDER BY endtime ASC";
				break;
			case 6:
				$q = "SELECT * FROM " . TB_PREFIX . "movement," . TB_PREFIX . "odata, " . TB_PREFIX . "attacks where " . TB_PREFIX . "odata.wref = '$village' and " . TB_PREFIX . "movement.to = $village and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "attacks.attack_type != 1 and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				//$q = "SELECT * FROM " . TB_PREFIX . "movement," . TB_PREFIX . "odata, " . TB_PREFIX . "attacks where " . TB_PREFIX . "odata.conqured = $village and " . TB_PREFIX . "movement.to = " . TB_PREFIX . "odata.wref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 ORDER BY endtime ASC";
				break;
			case 7:
				$q = "SELECT * FROM " . TB_PREFIX . "movement where " . TB_PREFIX . "movement." . $where . " = '$village' and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC";
				break;
			case 8:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 1 ORDER BY endtime ASC";
				break;
			case 34:
				$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 or " . TB_PREFIX . "movement." . $where . " = '$village' and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 4 ORDER BY endtime ASC";
				break;
			default:
				return null;
		}
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

	function addA2b($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type) {
	    list($ckey, $timestamp, $to, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type) = $this->escape_input($ckey, (int) $timestamp, (int) $to, (int) $t1, (int) $t2, (int) $t3, (int) $t4, (int) $t5, (int) $t6, (int) $t7, (int) $t8, (int) $t9, (int) $t10, (int) $t11, (int) $type);

		$q = "INSERT INTO " . TB_PREFIX . "a2b (ckey,time_check,to_vid,u1,u2,u3,u4,u5,u6,u7,u8,u9,u10,u11,type) VALUES ('$ckey', '$timestamp', '$to', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$type')";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

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
	    list($type, $from, $to, $ref, $time, $endtime, $send, $wood, $clay, $iron, $crop, $ref2) = $this->escape_input((int) $type, (int) $from, (int) $to, (int) $ref, (int) $time, (int) $endtime, (int) $send, (int) $wood, (int) $clay, (int) $iron, (int) $crop, (int) $ref2);

		$q = "INSERT INTO " . TB_PREFIX . "movement values (0,$type,$from,$to,$ref,$ref2,$time,$endtime,0,$send,$wood,$clay,$iron,$crop)";
		return mysqli_query($this->dblink,$q);
	}

	function addAttack($vid, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type, $ctar1, $ctar2, $spy,$b1=0,$b2=0,$b3=0,$b4=0,$b5=0,$b6=0,$b7=0,$b8=0) {
	    list($vid, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $type, $ctar1, $ctar2, $spy,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8) = $this->escape_input((int) $vid, (int) $t1, (int) $t2, (int) $t3, (int) $t4, (int) $t5, (int) $t6, (int) $t7, (int) $t8, (int) $t9, (int) $t10, (int) $t11, (int) $type, (int) $ctar1, (int) $ctar2, (int) $spy,(int) $b1,(int) $b2,(int) $b3,(int) $b4,(int) $b5,(int) $b6,(int) $b7,(int) $b8);

		$q = "INSERT INTO " . TB_PREFIX . "attacks values (0,$vid,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11,$type,$ctar1,$ctar2,$spy,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8)";
		mysqli_query($this->dblink,$q);
		return mysqli_insert_id($this->dblink);
	}

	function modifyAttack($aid, $unit, $amt) {
	    list($aid, $unit, $amt) = $this->escape_input((int) $aid, $unit, (int) $amt);

		$unit = 't' . $unit;
		$q = "UPDATE " . TB_PREFIX . "attacks set $unit = $unit - $amt where id = $aid";
		return mysqli_query($this->dblink,$q);
	}
	
	function modifyAttack2($aid, $unit, $amt) {
	    list($aid, $unit, $amt) = $this->escape_input((int) $aid, $unit, (int) $amt);

		$unit = 't' . $unit;
		$q = "UPDATE " . TB_PREFIX . "attacks set $unit = $unit + $amt where id = $aid";
		return mysqli_query($this->dblink,$q);
	}
	
	function modifyAttack3($aid, $units) {
	    list($aid, $units) = $this->escape_input((int) $aid, $units);

        $q = "UPDATE ".TB_PREFIX."attacks set $units WHERE id = $aid";
        return mysqli_query($this->dblink,$q);
    }

	function getRanking() {
		$q = "SELECT id,username,alliance,ap,apall,dp,dpall,access FROM " . TB_PREFIX . "users WHERE tribe<=3 AND access<" . (INCLUDE_ADMIN ? "10" : "8");
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getVRanking() {
	    $q = "SELECT v.wref,v.name,v.owner,v.pop FROM " . TB_PREFIX . "vdata AS v," . TB_PREFIX . "users AS u WHERE v.owner=u.id AND u.tribe IN(1,2,3".(SHOW_NATARS ? ',5' : '').") AND v.wref != '' AND u.access<" . (INCLUDE_ADMIN ? "10" : "8");
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getARanking() {
		$q = "SELECT id,name,tag,oldrank,Aap,Adp FROM " . TB_PREFIX . "alidata where id != '' ORDER BY id DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getUserByTribe($tribe) {
	    list($tribe) = $this->escape_input((int) $tribe);
		$q = "SELECT * FROM " . TB_PREFIX . "users where tribe = $tribe";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getUserByAlliance($aid) {
	    list($aid) = $this->escape_input((int) $aid);
		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getHeroRanking() {
		$q = "SELECT * FROM " . TB_PREFIX . "hero WHERE dead = 0";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getAllMember($aid) {
	    list($aid) = $this->escape_input((int) $aid);

		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid order  by (SELECT sum(pop) FROM " . TB_PREFIX . "vdata WHERE owner =  " . TB_PREFIX . "users.id) desc, " . TB_PREFIX . "users.id desc";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function getAllMember2($aid) {
	    list($aid) = $this->escape_input((int) $aid);

		$q = "SELECT * FROM " . TB_PREFIX . "users where alliance = $aid order  by (SELECT sum(pop) FROM " . TB_PREFIX . "vdata WHERE owner =  " . TB_PREFIX . "users.id) desc, " . TB_PREFIX . "users.id desc LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function addUnits($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "INSERT into " . TB_PREFIX . "units (vref) values ($vid)";
		return mysqli_query($this->dblink,$q);
	}

	function getUnit($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * from " . TB_PREFIX . "units where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		if (!empty($result)) {
			return mysqli_fetch_assoc($result);
		} else {
			return NULL;
		}
	}

	function getUnitsNumber($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * from " . TB_PREFIX . "units where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_assoc($result);
		$totalunits = 0;
		$movingunits = $this->getVillageMovement($vid);
		for($i=1;$i<=50;$i++){
		$totalunits += $dbarray['u'.$i];
		}
		$totalunits += $dbarray['hero'];
		$movingunits = $this->getVillageMovement($vid);
		$reinforcingunits = $this->getEnforceArray($vid,1);
		$owner = $this->getVillageField($vid,"owner");
		$ownertribe = $this->getUserField($owner,"tribe",0);
		$start = ($ownertribe-1)*10+1;
		$end = ($ownertribe*10);
		for($i=$start;$i<=$end;$i++){
		$totalunits += $movingunits['u'.$i];
		$totalunits += $reinforcingunits['u'.$i];
		}
		$totalunits += $movingunits['hero'];
		$totalunits += $reinforcingunits['hero'];
		return $totalunits;
	}

	function getHero($uid=0,$all=0) {
	    list($uid,$all) = $this->escape_input((int) $uid,$all);

		if ($all) {
			$q = "SELECT * FROM ".TB_PREFIX."hero WHERE uid=$uid";
		} elseif (!$uid) {
			$q = "SELECT * FROM ".TB_PREFIX."hero";
		} else {
			$q = "SELECT * FROM ".TB_PREFIX."hero WHERE dead=0 AND uid=$uid LIMIT 1";
		}
		$result = mysqli_query($this->dblink,$q);
		if (!empty($result)) {
			return $this->mysqli_fetch_all($result);
		} else {
			return NULL;
		}
	}

	function getHeroField($uid,$field) {
	    list($uid,$field) = $this->escape_input((int) $uid,$field);
			$q = "SELECT * FROM ".TB_PREFIX."hero WHERE uid = $uid";
			$result = mysqli_query($this->dblink,$q);
			return $this->mysqli_fetch_all($result);
	}

	function modifyHero($column,$value,$heroid,$mode=0) {
	    list($column,$value,$heroid,$mode) = $this->escape_input($column,$value,(int) $heroid,$mode);

		if(!$mode) {
			$q = "UPDATE `".TB_PREFIX."hero` SET $column = '$value' WHERE heroid = $heroid";
		} elseif($mode=1) {
		    $q = "UPDATE `".TB_PREFIX."hero` SET $column = $column + ". (int) $value . " WHERE heroid = $heroid";
		} else {
		    $q = "UPDATE `".TB_PREFIX."hero` SET $column = $column - ". (int) $value ." WHERE heroid = $heroid";
		}
		return mysqli_query($this->dblink,$q);
	}

	function modifyHeroByOwner($column,$value,$uid,$mode=0) {
	    list($column,$value,$uid,$mode) = $this->escape_input($column,$value,(int) $uid,$mode);

		if(!$mode) {
			$q = "UPDATE `".TB_PREFIX."hero` SET $column = '$value' WHERE uid = $uid";
		} elseif($mode=1) {
		    $q = "UPDATE `".TB_PREFIX."hero` SET $column = $column + ". (int) $value ." WHERE uid = $uid";
		} else {
		    $q = "UPDATE `".TB_PREFIX."hero` SET $column = $column - ". (int) $value ." WHERE uid = $uid";
		}
		return mysqli_query($this->dblink,$q);
	}

	function modifyHeroXp($column,$value,$heroid) {
	    list($column,$value,$heroid) = $this->escape_input($column,(int) $value,(int) $heroid);

		$q = "UPDATE ".TB_PREFIX."hero SET $column = $column + $value WHERE uid=$heroid";
		return mysqli_query($this->dblink,$q);
	}

	function addTech($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "INSERT into " . TB_PREFIX . "tdata (vref) values ($vid)";
		return mysqli_query($this->dblink,$q);
	}

	function addABTech($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "INSERT into " . TB_PREFIX . "abdata (vref) values ($vid)";
		return mysqli_query($this->dblink,$q);
	}

	function getABTech($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "abdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	function addResearch($vid, $tech, $time) {
	    list($vid, $tech, $time) = $this->escape_input((int) $vid, $tech, (int) $time);

		$q = "INSERT into " . TB_PREFIX . "research values (0,$vid,'$tech',$time)";
		return mysqli_query($this->dblink,$q);
	}

	function getResearching($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "research where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function checkIfResearched($vref, $unit) {
	    list($vref, $unit) = $this->escape_input((int) $vref, $unit);

		$q = "SELECT $unit FROM " . TB_PREFIX . "tdata WHERE vref = $vref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray[$unit];
	}

	function getTech($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * from " . TB_PREFIX . "tdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	function getTraining($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "training where vref = $vid ORDER BY id";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function countTraining($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$q = "SELECT * FROM " . TB_PREFIX . "training WHERE vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
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

	$uid = $this->getVillageField($vid, "owner");
	$artefact = count($this->getOwnUniqueArtefactInfo2($uid,5,3,0));
	$artefact1 = count($this->getOwnUniqueArtefactInfo2($vid,5,1,1));
	$artefact2 = count($this->getOwnUniqueArtefactInfo2($uid,5,2,0));
	if($artefact > 0){
	$time = $now+round(($time-$now)/2);
	$each /= 2;
	$each = round($each);
	}else if($artefact1 > 0){
	$time = $now+round(($time-$now)/2);
	$each /= 2;
	$each = round($each);
	}else if($artefact2 > 0){
	$time = $now+round(($time-$now)/4*3);
	$each /= 4;
	$each = round($each);
	$each *= 3;
	$each = round($each);
	}
	$foolartefact = $this->getFoolArtefactInfo(5,$vid,$uid);
	if(count($foolartefact) > 0){
	foreach($foolartefact as $arte){
	if($arte['bad_effect'] == 1){
	$each *= $arte['effect2'];
	}else{
	$each /= $arte['effect2'];
	$each = round($each);
	}
	}
	}
	if($each == 0){ $each = 1; }
	$time2 = $now+$each;
	if(count($queued) > 0) {
	$time += $queued[count($queued) - 1]['timestamp'] - $now;
	$time2 += $queued[count($queued) - 1]['timestamp'] - $now;
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
		$array_amt[$i] = $array_amt[$i] < 0 ? 0 : $array_amt[$i];
		//Fixed part of negativ troops (double troops) - by InCube
		$units .= $unit.' = '.$unit.' '.(($array_mode[$i] == 1)? '+':'-').'  '.$array_amt[$i].(($number > $i+1) ? ', ' : '');
		}
		$q = "UPDATE ".TB_PREFIX."units set $units WHERE vref = $vref";
		return mysqli_query($this->dblink,$q);
	}

	function getEnforce($vid, $from) {
	    list($vid, $from) = $this->escape_input((int) $vid, (int) $from);

		$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` = $from and vref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}
	
    	function getOasisEnforce($ref, $mode=0) {
    	    list($ref, $mode) = $this->escape_input((int) $ref, $mode);

        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.conqured = $ref AND e.from !=$ref";
        }else{
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where o.conqured = $ref";
        }
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    	}
    	
    	function getOasisEnforceArray($id, $mode=0) {
    	    list($id, $mode) = $this->escape_input((int) $id, $mode);

        if (!$mode) {
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.vref=o.wref where e.id = $id";
        }else{
            $q = "SELECT e.*,o.conqured FROM ".TB_PREFIX."enforcement as e LEFT JOIN ".TB_PREFIX."odata as o ON e.from=o.wref where e.id =$id";
        }
        $result = mysqli_query($this->dblink,$q);
        return mysqli_fetch_assoc($result);
    	}
	
	function getEnforceControllTroops($vid) {
	    list($vid) = $this->escape_input((int) $vid);

  		$q = "SELECT * from " . TB_PREFIX . "enforcement where  vref = $vid";
  		$result = mysqli_query($this->dblink,$q);
  		return mysqli_fetch_assoc($result);
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
		$j = '1';
		for($i = $start; $i <= $end; $i++) {
			$this->modifyEnforce($id, $i, $data['t' . $j . ''], 1);
			$j++;
		}
		$this->modifyEnforce($id,'hero',$data['t11'],1);
		return mysqli_insert_id($this->dblink);
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
		$j = '1';
		for($i = $start; $i <= $end; $i++) {
			$this->modifyEnforce($id, $i, $data['t' . $j . ''], 1);
			$this->modifyEnforce($id, $i, ${dead.$j}, 0);
			$j++;
		}
		$this->modifyEnforce($id,'hero',$data['t11'],1);
		$this->modifyEnforce($id,'hero',$dead11,0);
		return mysqli_insert_id($this->dblink);
	}

	function modifyEnforce($id, $unit, $amt, $mode) {
	    list($id, $unit, $amt, $mode) = $this->escape_input((int) $id, $unit, (int) $amt, $mode);

		if($unit != 'hero') { $unit = 'u' . $unit; }
		if(!$mode) {
			$q = "UPDATE " . TB_PREFIX . "enforcement set $unit = $unit - $amt where id = $id";
		} else {
			$q = "UPDATE " . TB_PREFIX . "enforcement set $unit = $unit + $amt where id = $id";
		}
		mysqli_query($this->dblink,$q);
	}

	function getEnforceArray($id, $mode) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

		if(!$mode) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where id = $id";
		} else {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` = $id";
		}
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	function getEnforceVillage($id, $mode) {
	    list($id, $mode) = $this->escape_input((int) $id, $mode);

		if(!$mode) {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where vref = $id";
		} else {
			$q = "SELECT * from " . TB_PREFIX . "enforcement where `from` = $id";
		}
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getVillageMovement($id) {
        list($id) = $this->escape_input($id);

		$vinfo = $this->getVillage($id);
		$vtribe = $this->getUserField($vinfo['owner'], "tribe", 0);
		$movingunits = array();
		$outgoingarray = $this->getMovement(3, $id, 0);
		if(!empty($outgoingarray)) {
			foreach($outgoingarray as $out) {
				for($i = 1; $i <= 10; $i++) {
					$movingunits['u' . (($vtribe - 1) * 10 + $i)] += $out['t' . $i];
				}
				$movingunits['hero'] += $out['t11'];
			}
		}
		$returningarray = $this->getMovement(4, $id, 1);
		if(!empty($returningarray)) {
			foreach($returningarray as $ret) {
				if($ret['attack_type'] != 1) {
					for($i = 1; $i <= 10; $i++) {
						$movingunits['u' . (($vtribe - 1) * 10 + $i)] += $ret['t' . $i];
					}
					$movingunits['hero'] += $ret['t11'];
				}
			}
		}
		$settlerarray = $this->getMovement(5, $id, 0);
		if(!empty($settlerarray)) {
			$movingunits['u' . ($vtribe * 10)] += 3 * count($settlerarray);
		}
		return $movingunits;
	}

	################# -START- ##################
	##   WORLD WONDER STATISTICS FUNCTIONS!   ##
	############################################

	/***************************
	Function to get all World Wonders
	Made by: Dzoki
	***************************/

	function getWW() {
		$q = "SELECT * FROM " . TB_PREFIX . "fdata WHERE f99t = 40";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
			return true;
		} else {
			return false;
		}
	}

	/***************************
	Function to get world wonder level!
	Made by: Dzoki
	***************************/

	function getWWLevel($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT f99 FROM " . TB_PREFIX . "fdata WHERE vref = $vref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['f99'];
	}

	/***************************
	Function to get world wonder owner ID!
	Made by: Dzoki
	***************************/

	function getWWOwnerID($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT owner FROM " . TB_PREFIX . "vdata WHERE wref = $vref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['owner'];
	}

	/***************************
	Function to get user alliance name!
	Made by: Dzoki
	***************************/

	function getUserAllianceID($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT alliance FROM " . TB_PREFIX . "users where id = $id";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['alliance'];
	}

	/***************************
	Function to get WW name
	Made by: Dzoki
	***************************/

	function getWWName($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT wwname FROM " . TB_PREFIX . "fdata WHERE vref = $vref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
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
	function addclimberpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set Rc = Rc + $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}
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
	function removeclimberpop($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "users set Rc = Rc - $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}
	// ALLIANCE MEDAL FUNCTIONS
	function addclimberpopAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set Rc = Rc + $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}
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
	function removeclimberpopAlly($user, $cp) {
	    list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

		$q = "UPDATE " . TB_PREFIX . "alidata set Rc = Rc - $cp where id = $user";
		return mysqli_query($this->dblink,$q);
	}

	function getTrainingList() {
		$q = "SELECT * FROM " . TB_PREFIX . "training where vref IS NOT NULL";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getNeedDelete() {
		$time = time();
		$q = "SELECT uid FROM " . TB_PREFIX . "deleting where timestamp < $time";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function countUser() {
		$q = "SELECT count(id) FROM " . TB_PREFIX . "users where id > 5";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

	function countAlli() {
		$q = "SELECT count(id) FROM " . TB_PREFIX . "alidata where id != 0";
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		return $row[0];
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

	//MARKET FIXES
	function getWoodAvailable($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT wood FROM " . TB_PREFIX . "vdata WHERE wref = $wref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['wood'];
	}

	function getClayAvailable($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT clay FROM " . TB_PREFIX . "vdata WHERE wref = $wref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['clay'];
	}

	function getIronAvailable($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT iron FROM " . TB_PREFIX . "vdata WHERE wref = $wref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['iron'];
	}

	function getCropAvailable($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT crop FROM " . TB_PREFIX . "vdata WHERE wref = $wref";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['crop'];
	}

	function Getowner($vid) {
	    list($vid) = $this->escape_input((int) $vid);

		$s = "SELECT owner FROM " . TB_PREFIX . "vdata where wref = $vid";
		$result1 = mysqli_query($this->dblink,$s);
		$row1 = mysqli_fetch_row($result1);
		return $row1[0];
	}

	public function debug($time, $uid, $debug_info) {
        list($time, $uid, $debug_info) = $this->escape_input($time, $uid, $debug_info);

		$q = "INSERT INTO " . TB_PREFIX . "debug_info (time,uid,debug_info) VALUES ($time,$uid,$debug_info)";
		if(mysqli_query($this->dblink,$q)) {
			return mysqli_insert_id($this->dblink);
		} else {
			return false;
		}
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
                echo mysqli_error($this->dblink);
                return -1;
            }
        } catch (\Exception $e) {
            return -1;
        }
        
        return true;
    }

	public function getAvailableExpansionTraining() {
		global $building, $session, $technology, $village;
		$q = "SELECT (IF(exp1=0,1,0)+IF(exp2=0,1,0)+IF(exp3=0,1,0)) FROM " . TB_PREFIX . "vdata WHERE wref = ".(int) $village->wid;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		$maxslots = $row[0];
		$residence = $building->getTypeLevel(25);
		$palace = $building->getTypeLevel(26);
		if($residence > 0) {
			$maxslots -= (3 - floor($residence / 10));
		}
		if($palace > 0) {
			$maxslots -= (3 - floor(($palace - 5) / 5));
		}

		$q = "SELECT (u10+u20+u30) FROM " . TB_PREFIX . "units WHERE vref = ". (int) $village->wid;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		$settlers = $row[0];
		$q = "SELECT (u9+u19+u29) FROM " . TB_PREFIX . "units WHERE vref = ". (int) $village->wid;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);
		$chiefs = $row[0];

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
		// trapped settlers/chiefs calculation required

		$settlerslots = $maxslots * 3 - $settlers - $chiefs * 3;
		$chiefslots = $maxslots - $chiefs - floor(($settlers + 2) / 3);

		if(!$technology->getTech(($session->tribe - 1) * 10 + 9)) {
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

	function getOwnArtefactInfo($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vref";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}
	
	function getOwnArtefactInfo2($vref) {
	    list($vref) = $this->escape_input((int) $vref);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vref";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function getOwnArtefactInfo3($uid) {
	    list($uid) = $this->escape_input((int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE owner = $uid";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getOwnArtefactInfoByType($vref, $type) {
        list($vref, $type) = $this->escape_input($vref, $type);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = '$vref' AND type = '$type' order by size";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function getOwnArtefactInfoByType2($vref, $type) {
	    list($vref, $type) = $this->escape_input((int) $vref, (int) $type);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vref AND type = $type";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getOwnUniqueArtefactInfo($id, $type, $size) {
	    list($id, $type, $size) = $this->escape_input((int) $id, (int) $type, (int) $size);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE owner = $id AND type = $type AND size=$size";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function getOwnUniqueArtefactInfo2($id, $type, $size, $mode) {
	    list($id, $type, $size, $mode) = $this->escape_input((int) $id, (int) $type, (int) $size, $mode);

	if(!$mode){
		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE owner = $id AND active = 1 AND type = $type AND size=$size";
	}else{
		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $id AND active = 1 AND type = $type AND size=$size";
	}
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function getFoolArtefactInfo($type,$vid,$uid) {
	    list($type,$vid,$uid) = $this->escape_input((int) $type,(int) $vid,(int) $uid);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE vref = $vid AND ((type = 8 AND kind = $type) OR (owner = $uid AND size > 1 AND active = 1 AND type = 8 AND kind = $type))";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	function claimArtefact($vref, $ovref, $id) {
	    list($vref, $ovref, $id) = $this->escape_input((int) $vref, (int) $ovref, (int) $id);

		$time = time();
		$q = "UPDATE " . TB_PREFIX . "artefacts SET vref = $vref, owner = $id, conquered = $time, active = 1 WHERE vref = $ovref";
		return mysqli_query($this->dblink,$q);
	}

    public function canClaimArtifact($from,$vref,$size,$type) {
        list($size,$type) = $this->escape_input((int) $size,(int) $type);

    //fix by Ronix
    global $session, $form;
    $size1 = $size2 = $size3 = 0;
    
    $artifact = $this->getOwnArtefactInfo($from);
    if (!empty($artifact)) {
        $form->addError("error","Treasury is full. Your hero could not claim the artefact");
        return false;
    }
    $uid=$session->uid;    
    $q="SELECT Count(size) AS totals,
    SUM(IF(size = '1',1,0)) small,
    SUM(IF(size = '2',1,0)) great,
    SUM(IF(size = '3',1,0)) `unique`
    FROM ".TB_PREFIX."artefacts WHERE owner = ".(int) $uid;
    $result = mysqli_query($this->dblink,$q);
    $artifact= $this->mysqli_fetch_all($result);

    if($artifact['totals'] < 3 || $type==11) {    
        $DefenderFields = $this->getResourceLevel($vref);
        $defcanclaim = TRUE;
        for($i=19;$i<=38;$i++) {
            if($DefenderFields['f'.$i.'t'] == 27) {
                $defTresuaryLevel = $DefenderFields['f'.$i];
                if($defTresuaryLevel > 0) {
                    $defcanclaim = FALSE;
                    $form->addError("error","Treasury has not been destroyed. Your hero could not claim the artefact");
                    return false;
                } else {
                    $defcanclaim = TRUE;
                }
            }
        }
        $AttackerFields = $this->getResourceLevel($from,2);
        for($i=19;$i<=38;$i++) {
            if($AttackerFields['f'.$i.'t'] == 27) {
                $attTresuaryLevel = $AttackerFields['f'.$i];
                if ($attTresuaryLevel >= 10) {
                    $villageartifact = TRUE;
                } else {
                    $villageartifact = FALSE;
                }
                if ($attTresuaryLevel >= 20){
                    $accountartifact = TRUE;
                } else {
                    $accountartifact = FALSE;
                }
            }
        }
        if (($artifact['great']>0 || $artifact['unique']>0) && $size>1) {
            $form->addError("error","Max num. of great/unique artefacts. Your hero could not claim the artefact");
            return FALSE;
        }
        if (($size == 1 && ($villageartifact || $accountartifact)) || (($size == 2 || $size == 3)&& $accountartifact)) {
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
                $form->addError("error","Your level treasury is low. Your hero could not claim the artefact");
                return FALSE;
        }
    } else {
        $form->addError("error","Max num. of artefacts. Your hero could not claim the artefact");
        return FALSE;
    }
}

	function getArtefactDetails($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "artefacts WHERE id = " . $id . "";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}

	function getMovementById($id) {
	    list($id) = $this->escape_input((int) $id);
		$q = "SELECT * FROM ".TB_PREFIX."movement WHERE moveid = ".$id."";
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

	function getLinks($id) {
	    list($id) = $this->escape_input((int) $id);
		$q = 'SELECT * FROM `' . TB_PREFIX . 'links` WHERE `userid` = ' . $id . ' ORDER BY `pos` ASC';
		return mysqli_query($this->dblink,$q);
	}

	function removeLinks($id,$uid) {
	    list($id,$uid) = $this->escape_input((int) $id,(int) $uid);
		$q = "DELETE FROM " . TB_PREFIX . "links WHERE `id` = ".$id." and `userid` = ".$uid."";
		return mysqli_query($this->dblink,$q);
	}

	function getVilFarmlist($wref) {
	    list($wref) = $this->escape_input((int) $wref);
		$q = 'SELECT * FROM ' . TB_PREFIX . 'farmlist WHERE wref = ' . $wref . ' ORDER BY wref ASC';
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

		if($dbarray['id']!=0) {
				return true;
			} else {
				return false;
			}

	}

	function getRaidList($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "raidlist WHERE id = ".$id;
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
		mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
	}

	function resetPassword($uid, $cpw) {
	    list($uid, $cpw) = $this->escape_input((int) $uid, $cpw);
		$q = "SELECT npw FROM `" . TB_PREFIX . "password` WHERE uid = $uid AND cpw = '$cpw' AND used = 0";
		$result = mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
		$dbarray = mysqli_fetch_array($result);

		if(!empty($dbarray)) {
		    if(!$this->updateUserField($uid, 'password', password_hash($dbarray['npw'], PASSWORD_BCRYPT,['cost' => 12]), 1)) return false;
			$q = "UPDATE `" . TB_PREFIX . "password` SET used = 1 WHERE uid = $uid AND cpw = '$cpw' AND used = 0";
			mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
			return true;
		}

		return false;
	}

	function getCropProdstarv($wref) {
	    global $bid4,$bid8,$bid9,$sesion,$technology;

	    $wood = 0;
	    $cropo = 0;
	    $clay = 0;
	    $iron = 0;
		$basecrop = $grainmill = $bakery = 0;
		$owner = $this->getVrefField($wref, 'owner');
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
				$wood += 1;
				$cropo += 1;
				break;
				case 4:
				case 5:
				$clay += 1;
				break;
				case 6:
				$clay += 1;
				$cropo += 1;
				break;
				case 7:
				case 8:
				$iron += 1;
				break;
				case 9:
				$iron += 1;
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
		for($i=0;$i<=count($cropholder)-1;$i++) { $basecrop+= $bid4[$buildarray[$cropholder[$i]]]['prod']; }
		$crop = $basecrop + $basecrop * 0.25 * $cropo;
		if($grainmill >= 1 || $bakery >= 1) {
			$crop += $basecrop /100 * ((isset($bid8[$grainmill]['attri']) ? $bid8[$grainmill]['attri'] : 0) + (isset($bid9[$bakery]['attri']) ? $bid9[$bakery]['attri'] : 0));
		}
		if($bonus > time()) {
			$crop *= 1.25;
		}
		$crop *= SPEED;
		return $crop;
	}

	//general statistics

	function addGeneralAttack($casualties) {
        list($casualties) = $this->escape_input($casualties);

		$time = time();
		$q = "INSERT INTO " . TB_PREFIX . "general values (0,'$casualties','$time',1)";
		return mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
	}

	function getAttackByDate($time) {
        list($time) = $this->escape_input($time);

		$q = "SELECT * FROM " . TB_PREFIX . "general where shown = 1";
		$result = $this->query_return($q);
		$attack = 0;
		foreach($result as $general) {
		if(date("j. M",$time) == date("j. M",$general['time'])){
		$attack += 1;
		}
		}
		return $attack;
	}

	function getAttackCasualties($time) {
        list($time) = $this->escape_input($time);

		$q = "SELECT * FROM " . TB_PREFIX . "general where shown = 1";
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

	function checkFriends($uid) {
        list($uid) = $this->escape_input($uid);

	    global $session;
		$user = $this->getUserArray($uid, 1);
		for($i=0;$i<=19;$i++) {
		if($user['friend'.$i] == 0 && $user['friend'.$i.'wait'] == 0){
		for($j=$i+1;$j<=19;$j++) {
		$k = $j-1;
		if($user['friend'.$j] != 0){
		$friend = $this->getUserField($uid, "friend".$j, 0);
		$this->addFriend($uid,"friend".$k,$friend);
		$this->deleteFriend($uid,"friend".$j);
		}
		if($user['friend'.$j.'wait'] == 0){
		$friendwait = $this->getUserField($uid, "friend".$j."wait", 0);
		$this->addFriend($session->uid,"friend".$k."wait",$friendwait);
		$this->deleteFriend($uid,"friend".$j."wait");
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
		return mysqli_insert_id($this->dblink);
	}
	
	function updatePrisoners($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) {
	    list($wid,$from,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11) = $this->escape_input((int) $wid,(int) $from,(int) $t1,(int) $t2,(int) $t3,(int) $t4,(int) $t5,(int) $t6,(int) $t7,(int) $t8,(int) $t9,(int) $t10,(int) $t11);

        $q = "UPDATE " . TB_PREFIX . "prisoners set t1 = t1 + $t1, t2 = t2 + $t2, t3 = t3 + $t3, t4 = t4 + $t4, t5 = t5 + $t5, t6 = t6 + $t6, t7 = t7 + $t7, t8 = t8 + $t8, t9 = t9 + $t9, t10 = t10 + $t10, t11 = t11 + $t11 where wref = $wid and ".TB_PREFIX."prisoners.from = $from";
        return mysqli_query($this->dblink,$q) or die(mysqli_error($this->dblink));
    	}
	
    function getPrisoners($wid,$mode=0) {
        list($wid,$mode) = $this->escape_input((int) $wid,$mode);

        if(!$mode) {
            $q = "SELECT * FROM " . TB_PREFIX . "prisoners where wref = $wid";
        }else {
            $q = "SELECT * FROM " . TB_PREFIX . "prisoners where `from` = $wid";
        }    
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

	function getPrisoners2($wid,$from) {
	    list($wid,$from) = $this->escape_input((int) $wid,(int) $from);

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where wref = $wid and " . TB_PREFIX . "prisoners.from = $from";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function getPrisonersByID($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_array($result);
	}
	
	function getPrisoners3($from) {
	    list($from) = $this->escape_input((int) $from);

		$q = "SELECT * FROM " . TB_PREFIX . "prisoners where " . TB_PREFIX . "prisoners.from = $from";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}
	
	function deletePrisoners($id) {
        list($id) = $this->escape_input($id);

		$q = "DELETE from " . TB_PREFIX . "prisoners where id = '$id'";
		mysqli_query($this->dblink,$q);
	}
	
/*****************************************
Function to vacation mode - by advocaite
References:
*****************************************/

   function setvacmode($uid,$days) {
       list($uid,$days) = $this->escape_input((int) $uid,(int) $days);
     $days1 =60*60*24*$days;
     $time =time()+$days1;
     $q ="UPDATE ".TB_PREFIX."users SET vac_mode = '1' , vac_time=".$time." WHERE id=".$uid."";
	 $result =mysqli_query($this->dblink,$q);
     }
	 
   function removevacationmode($uid) {
       list($uid) = $this->escape_input((int) $uid);
     $q ="UPDATE ".TB_PREFIX."users SET vac_mode = '0' , vac_time='0' WHERE id=".$uid."";
     $result =mysqli_query($this->dblink,$q);
     }

   function getvacmodexy($wref) {
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
 
    /*****************************************
	Function to vacation mode - by advocaite
	References:
	*****************************************/

	/***************************
	Function to get Hero Dead
	Made by: Shadow and brainiacX
	***************************/

 	function getHeroDead($id) {
 	    list($id) = $this->escape_input((int) $id);

    		$q = "SELECT dead FROM " . TB_PREFIX . "hero WHERE `uid` = $id";
    		$result = mysqli_query($this->dblink,$q);
    		$notend= mysqli_fetch_array($result);
     		return $notend['dead'];
   	}
	
	/***************************
	Function to get Hero In Revive
	Made by: Shadow
	***************************/

 	function getHeroInRevive($id) {
 	    list($id) = $this->escape_input((int) $id);

    		$q = "SELECT inrevive FROM " . TB_PREFIX . "hero WHERE `uid` = $id";
    		$result = mysqli_query($this->dblink,$q);
    		$notend= mysqli_fetch_array($result);
     		return $notend['inrevive'];
   	}
	
	/***************************
	Function to get Hero In Training
	Made by: Shadow
	***************************/

 	function getHeroInTraining($id) {
 	    list($id) = $this->escape_input((int) $id);

    		$q = "SELECT intraining FROM " . TB_PREFIX . "hero WHERE `uid` = $id";
    		$result = mysqli_query($this->dblink,$q);
    		$notend= mysqli_fetch_array($result);
     		return $notend['intraining'];
   	}

	/***************************
	Function to check Hero Not in Village
	Made by: Shadow and brainiacX
	***************************/

	function HeroNotInVil($id) {
        list($id) = $this->escape_input($id);

                $heronum=0;
    		$outgoingarray = $this->getMovement(3, $id, 0);
    		if(!empty($outgoingarray)) {
     		foreach($outgoingarray as $out) {
      		$heronum += $out['t11'];
     		}
    	}
    		$returningarray = $this->getMovement(4, $id, 1);
    		if(!empty($returningarray)) {
     		foreach($returningarray as $ret) {
      		if($ret['attack_type'] != 1) {
       		$heronum += $ret['t11'];
      		}
     		}
    	}
    		return $heronum;
   	}

	/***************************
	Function to Kill hero if not found
	Made by: Shadow and brainiacX
	***************************/

       function KillMyHero($id) {
           list($id) = $this->escape_input((int) $id);

  	       $q = "UPDATE " . TB_PREFIX . "hero set dead = 1 where uid = ".$id;
               return mysqli_query($this->dblink,$q);
       }
	   
	/***************************
        Function to find Hero place
        Made by: ronix
        ***************************/
        function FindHeroInVil($wid) {
        list($wid) = $this->escape_input($wid);

            $result = $this->query("SELECT * FROM ".TB_PREFIX."units WHERE hero>0 AND vref='".$wid."'");
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

       function checkAttack($wref, $toWref) {
           list($wref, $toWref) = $this->escape_input((int) $wref, (int) $toWref);
            	$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.from = $wref and " . TB_PREFIX . "movement.to = $toWref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and (" . TB_PREFIX . "attacks.attack_type = 3 or " . TB_PREFIX . "attacks.attack_type = 4) ORDER BY endtime ASC";
		$result = mysqli_query($this->dblink,$q);
		if(mysqli_num_rows($result)) {
		return true;
		} else {
		return false;
		}
            }

	/***************************
	Function checkEnforce
	Made by: Shadow
	***************************/

	function checkEnforce($wref, $toWref) {
	    list($wref, $toWref) = $this->escape_input((int) $wref, (int) $toWref);

    		$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.from = $wref and " . TB_PREFIX . "movement.to = $toWref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 2 ORDER BY endtime ASC";
        	$result = mysqli_query($this->dblink,$q);
    		if(mysqli_num_rows($result)) {
    		return true;
     		}else{
    		return false;
    		}
  	}	

	/***************************
  	Function checkScout
  	Made by: yi12345
  	***************************/

	function checkScout($wref, $toWref) {
	    list($wref, $toWref) = $this->escape_input((int) $wref, (int) $toWref);

    		$q = "SELECT * FROM " . TB_PREFIX . "movement, " . TB_PREFIX . "attacks where " . TB_PREFIX . "movement.from = $wref and " . TB_PREFIX . "movement.to = $toWref and " . TB_PREFIX . "movement.ref = " . TB_PREFIX . "attacks.id and " . TB_PREFIX . "movement.proc = 0 and " . TB_PREFIX . "movement.sort_type = 3 and " . TB_PREFIX . "attacks.attack_type = 1 ORDER BY endtime ASC";
        	$result = mysqli_query($this->dblink,$q);
    		if(mysqli_num_rows($result)) {
     		return true;
    		}else{
    		return false;
     		}
   	}  

};

// database is not needed if we're displaying static pages
$req_file = basename($_SERVER['PHP_SELF']);
if (!in_array($req_file, ['tutorial.php', 'anleitung.php'])) {
    $database = new MYSQLi_DB(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB);
    $link = $database->return_link();
    $GLOBALS['db'] = $database;
    $GLOBALS['link'] = $database->return_link();
}
?>