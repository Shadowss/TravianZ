<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       accounts.php                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################


        // The account step is a separate HTTP request. Keep the selected
        // instance explicit so account creation can never update the shared
        // GameEngine/config.php bootstrap.
        @session_start();
        require_once dirname(__DIR__, 2) . "/GameEngine/Instance/Resolver.php";

        $instanceId = InstanceResolver::sanitize(isset($_POST['instance']) ? $_POST['instance'] : '');
        if ($instanceId === null) {
            $instanceId = InstanceResolver::sanitize(isset($_SESSION['install_instance']) ? $_SESSION['install_instance'] : '');
        }
        if ($instanceId === null) {
            die("Invalid or missing TravianZ instance identifier.");
        }
        $_SESSION['install_instance'] = $instanceId;

        // verify form
        if (empty($_POST['mhpw']) || empty($_POST['spw'])) {
            header("Location: ../index.php?instance=" . rawurlencode($_SESSION['install_instance'] ?? 's1') . "&s=4&err=1");
            exit;
        }

        // don't allow creating Natars user
        if (!empty($_POST['aname']) && strtolower($_POST['aname']) == 'natars') {
            header("Location: ../index.php?instance=" . rawurlencode($_SESSION['install_instance'] ?? 's1') . "&s=4&err=2");
            exit;
        }

		// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
		@set_time_limit(0);

		$gameinstall = 1;

		$configFile = InstanceResolver::configPath($instanceId);
		include_once($configFile);
		include_once("../../GameEngine/Database.php");
		include_once("../../GameEngine/Admin/database.php");
		require_once dirname(__DIR__, 2) . "/GameEngine/Lang/loader.php";
		tz_load_language(LANG);

		// update Admin details first
		$gameConfig = file_get_contents($configFile);

		// easy string replacements
		$findReplace["%AEMAIL%"] = $_POST['aemail'];
		$findReplace["%ANAME%"] = $_POST['aname'];
		$gameConfig = str_replace(array_keys($findReplace), array_values($findReplace), $gameConfig);

		// more complicated regex replacements
		$regexFindReplace = [
		    '/define\("ADMIN_RECEIVE_SUPPORT_MESSAGES",[^)]+\);/' => 'define("ADMIN_RECEIVE_SUPPORT_MESSAGES", '.($_POST['admin_support_msgs'] == 'true' ? 'true' : 'false').');',
		    '/define\("ADMIN_ALLOW_INCOMING_RAIDS",[^)]+\);/' => 'define("ADMIN_ALLOW_INCOMING_RAIDS", '.($_POST['admin_raidable'] == 'true' ? 'true' : 'false').');',
		    '/define\("INCLUDE_ADMIN",[^)]+\);/' => 'define("INCLUDE_ADMIN", '.($_POST['admin_rank'] == 'true' ? 'true' : 'false').');'
		];

		$gameConfig = preg_replace(array_keys($regexFindReplace), array_values($regexFindReplace), $gameConfig);
		file_put_contents($configFile, $gameConfig);

		// create Admin user, if details were provided and was not created yet
		if (
		    !empty($_POST['aname']) &&
		    !empty($_POST['aemail']) &&
		    !empty($_POST['apass']) &&
		    !empty($_POST['atribe']) &&
		    strtolower($_POST['aname']) != 'multihunter' &&
		    strtolower($_POST['aname']) != 'support'
		) {
		    mysqli_query($database->dblink, "INSERT INTO " . TB_PREFIX . "users SET username = '".$database->escape($_POST['aname'])."', password = '" . password_hash($_POST['apass'], PASSWORD_BCRYPT, ['cost' => 12]) . "', email = '".$database->escape($_POST['aemail'])."', tribe = ".(int) $_POST['atribe'].", access = 9, is_bcrypt = 1, desc1 = '[#MH]\n[#TEAM]', desc2 = '[#MULTIHUNTER]\n[#roman]'") OR DIE (mysqli_error($database->dblink));
			$uid = mysqli_insert_id($database->dblink);
		    $admin_village_created = false;
		    $xcoor = round(WORLD_MAX / 2);
            $addUnitsWrefs = [];
            $addTechWrefs = [];
            $addABTechWrefs = [];

		    while (!$admin_village_created) {
    		    $wid = $admin->getWref($xcoor++, round(WORLD_MAX / 2));
    		    $status = $database->getVillageState($wid);
    		    if($status == 0) {
    		        $database->setFieldTaken($wid);
    		        $database->addVillage($wid, $uid, $_POST['aname'], 1);

    		        // Satul adminului primeste mereu configuratia 4-4-4-6 (tipul 3),
    		        // nu una aleatoare: e satul de la centrul hartii si trebuie sa fie
    		        // echilibrat, indiferent ce tip are casuta pe harta.
    		        $database->addResourceFields($wid, 3);
                    $addUnitsWrefs[] = $wid;
                    $addTechWrefs[] = $wid;
                    $addABTechWrefs[] = $wid;
    		        $admin_village_created = true;
    		    }
		    }

            $database->addUnits($addUnitsWrefs);
            $database->addTech($addTechWrefs);
            $database->addABTech($addABTechWrefs);
		}

		// set up MultiHunter
		$password = $_POST['mhpw'];
		mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "users SET password = '" . password_hash($password, PASSWORD_BCRYPT,['cost' => 12]) . "', desc1 = '[#MH]', desc2 = '[#MULTIHUNTER]' WHERE username = 'Multihunter'");
		$wid = $admin->getWref(0, 0);
		$uid = 5;
		$status = $database->getVillageState($wid);
		if($status == 0) {
			$database->setFieldTaken($wid);
			$database->addVillage($wid, $uid, 'Multihunter', 1);
			$database->addResourceFields($wid, $database->getVillageType($wid, false));
			$database->addUnits($wid);
			$database->addTech($wid);
			$database->addABTech($wid);
		}

		// set up Support
	    $password = $_POST['spw'];
	    mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "users SET password = '" . password_hash($password, PASSWORD_BCRYPT,['cost' => 12]) . "' WHERE username = 'Support'");

	    /**
	     * Satul contului Support.
	     *
	     * BUG REPARAT: Support primea doar parola, fara sat. La prima autentificare,
	     * Village.php nu gasea niciun sat, iar lantul se termina cu o eroare fatala
	     * in getUnit() (interogare SQL construita din valori goale) - adica 500 pe
	     * toata interfata, fara nicio cale de iesire.
	     *
	     * Ii dam un sat langa Multihunter, cu aceeasi configuratie 4-4-4-6.
	     */
	    $supportRow = mysqli_fetch_assoc(mysqli_query($database->dblink,
	        "SELECT id FROM " . TB_PREFIX . "users WHERE username = 'Support' LIMIT 1"));

	    if ($supportRow) {
	        $supportUid = (int) $supportRow['id'];
	        $supportHas = mysqli_fetch_assoc(mysqli_query($database->dblink,
	            "SELECT COUNT(*) AS total FROM " . TB_PREFIX . "vdata WHERE owner = " . $supportUid));

	        if (!$supportHas || (int) $supportHas['total'] === 0) {
	            // pornim de langa Multihunter (0,0) si mergem pana gasim liber
	            $supportX = 1;

	            while ($supportX < 20) {
	                $supportWid = $admin->getWref($supportX, 0);

	                if ($database->getVillageState($supportWid) == 0) {
	                    $database->setFieldTaken($supportWid);
	                    $database->addVillage($supportWid, $supportUid, 'Support', 1);
	                    $database->addResourceFields($supportWid, 3);
	                    $database->addUnits($supportWid);
	                    $database->addTech($supportWid);
	                    $database->addABTech($supportWid);
	                    break;
	                }

	                $supportX++;
	            }
	        }
	    }

        $gameinstall = 0;
		header("Location: ../index.php?instance=" . rawurlencode($_SESSION['install_instance'] ?? 's1') . "&s=5");

?>
