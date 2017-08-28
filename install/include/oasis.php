<?php


        if(!isset($_SESSION)) session_start();
        $gameinstall = 1;
        include ("../../GameEngine/config.php");
        include ("../../GameEngine/Database.php");
        include ("../../GameEngine/Admin/database.php");


		mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysql_select_db(SQL_DB);

		$database->populateOasisdata();
		$database->populateOasis();
		$database->populateOasisUnits2();




		header("Location: ../index.php?s=6");

?>