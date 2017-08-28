<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////

include("constant.php");
class MYSQLi_DB {
	var $connection;
	function MYSQLi_DB() {
		$this->connection = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB) or die(mysqli_error());
	}
		function query($query) {
		return mysqli_query($this->connection, $query);
		}
};
class mysqli_DB {
	var $connection;
	function mysqli_DB() {
		$this->connection = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysqli_error());
		mysqli_select_db(SQL_DB, $this->connection) or die(mysqli_error());
	}

	function mysqli_exec_batch ($p_query, $p_transaction_safe = true) {
  if ($p_transaction_safe) {
	  $p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';
	};
  $query_split = preg_split ("/[;]+/", $p_query);
  foreach ($query_split as $command_line) {
	$command_line = trim($command_line);
	if ($command_line != '') {
	  $query_result = mysqli_query($GLOBALS["link"], $command_line);
	  if ($query_result == 0) {
		break;
	  };
	};
  };
  return $query_result;
}

	function query($query) {
		return mysqli_query($GLOBALS["link"], $query, $this->connection);
	}
};

if(DB_TYPE) {
	$database = new MYSQLi_DB;
}
else {
	$database = new mysqli_DB;
}
?>
