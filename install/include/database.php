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
$database = new MYSQLi_DB;
?>
