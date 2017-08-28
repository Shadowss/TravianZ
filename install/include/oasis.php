<?php


        if(!isset($_SESSION)) session_start();
        $gameinstall = 1;
        include ("../../GameEngine/config.php");
        include ("../../GameEngine/Database.php");

		$database->populateOasisdata();
		$database->populateOasis();
		$database->populateOasisUnits2();

		header("Location: ../index.php?s=6");

?>