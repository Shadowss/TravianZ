<?php
        // verify form
        if (empty($_POST['mhpw']) || empty($_POST['spw'])) {
            header("Location: ../index.php?s=4&err=1");
            exit;
        }

        // don't allow creating Natars user
        if (!empty($_POST['aname']) && strtolower($_POST['aname']) == 'natars') {
            header("Location: ../index.php?s=4&err=2");
            exit;
        }

		// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
		@set_time_limit(0);

		$gameinstall = 1;

		$configFile = "../../GameEngine/config.php";
		include_once($configFile);
		include_once("../../GameEngine/Database.php");
		include_once("../../GameEngine/Admin/database.php");
		include_once("../../GameEngine/Lang/" . LANG . ".php");

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
		    mysqli_query($database->dblink, "INSERT INTO " . TB_PREFIX . "users SET username = '".$database->escape($_POST['aname'])."', password = '" . password_hash($_POST['apass'], PASSWORD_BCRYPT, ['cost' => 12]) . "', email = '".$database->escape($_POST['aemail'])."', tribe = ".(int) $_POST['atribe'].", access = 9, is_bcrypt = 1") OR DIE (mysqli_error($database->dblink));
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
    		        $database->addResourceFields($wid, $database->getVillageType($wid, false));
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
		mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "users SET password = '" . password_hash($password, PASSWORD_BCRYPT,['cost' => 12]) . "' WHERE username = 'Multihunter'");
		$wid = $admin->getWref(0, 0);
		$uid = 5;
		$status = $database->getVillageState($wid);
		if($status == 0) {
			$database->setFieldTaken($wid);
			$database->addVillage($wid, $uid, 'Multihunter', 0);
			$database->addResourceFields($wid, $database->getVillageType($wid, false));
			$database->addUnits($wid);
			$database->addTech($wid);
			$database->addABTech($wid);
		}

		// set up Support
	    $password = $_POST['spw'];
	    mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "users SET password = '" . password_hash($password, PASSWORD_BCRYPT,['cost' => 12]) . "' WHERE username = 'Support'");

        $gameinstall = 0;
		header("Location: ../index.php?s=5");

?>