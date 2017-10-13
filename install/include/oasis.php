<?php

		// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
		@set_time_limit(0);

        if(!isset($_SESSION)) session_start();
        $gameinstall = 1;
        include ("../../GameEngine/config.php");
        include ("../../GameEngine/Database.php");
        include ("../../GameEngine/Admin/database.php");


		$conn = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysqli_select_db($conn, SQL_DB);

		$database->populateOasisdata();
		$database->populateOasis();
		$database->populateOasisUnits2();




		header("Location: ../index.php?s=6");

?>