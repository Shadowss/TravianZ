<?php

		// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
		@set_time_limit(0);

        if(!isset($_SESSION)) session_start();
        $gameinstall = 1;
        include ("../../GameEngine/config.php");
        include ("../../GameEngine/Database.php");
        include ("../../GameEngine/Admin/database.php");

		// check if we don't already have world data
		$data_exist = $database->query_return("SELECT * FROM " . TB_PREFIX . "odata LIMIT 1");
		if (count($data_exist)) {
		    header("Location: ../index.php?s=6&err=1");
		    exit;
		}
		
		$database->populateOasisdata();
		$database->populateOasis();
		$database->populateOasisUnits2();




		header("Location: ../index.php?s=7");

?>