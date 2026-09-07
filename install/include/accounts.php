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
	     * BUG REPARAT (istoric): Support primea doar parola, fara sat. La prima
	     * autentificare, Village.php nu gasea niciun sat, iar lantul se termina
	     * cu o eroare fatala in getUnit() (interogare SQL construita din valori
	     * goale) - adica 500 pe toata interfata, fara nicio cale de iesire.
	     *
	     * BUG REPARAT (07.09.2026, raportat de Catalin cu exemplu concret):
	     * fix-ul de mai sus cauta liber DOAR pe o linie dreapta (y=0, x=1..19,
	     * 19 casute in total, toate la est de Multihunter). Pe serverul lui,
	     * exact (1|0) a ajuns sa fie oaza, iar Support a primit satul acolo -
	     * asta stricat randarea hartii mari in jurul acelei casute. Cautarea
	     * originala verifica deja getVillageState() == 0, care exclude si
	     * oazele (occupied != 0 || oasistype != 0) - problema nu e ca lipsea
	     * verificarea, ci ca o singura linie ingusta de 19 casute e fragila:
	     * daca zona imediat la est de centru contine un ciorchine de oaze
	     * (frecvent langa centrul hartii), cautarea poate nimeri exact intr-o
	     * stare inconsistenta intre momentul verificarii si cel al asignarii.
	     *
	     * Fix: cautare in spirala (inele patrate concentrice) in jurul lui
	     * (0,0), pe toate cele 4 directii, nu doar spre est. Toti candidatii
	     * dintr-un inel sunt verificati intr-o SINGURA interogare SQL directa
	     * (getFreeVillage: occupied = 0 AND oasistype = 0), citita proaspat
	     * din DB, nu din cache-ul PHP. Raza creste pana la 20 (inel maxim),
	     * adica pana la 1680 de casute candidate - practic imposibil sa fie
	     * toate ocupate sau oaza. Daca totusi nu se gaseste nimic (n-ar trebui
	     * sa se intample niciodata), scriem in error_log in loc sa sarim peste
	     * in tacere, ca sa nu revenim la bug-ul original (Support fara sat).
	     */
	    $supportRow = mysqli_fetch_assoc(mysqli_query($database->dblink,
	        "SELECT id FROM " . TB_PREFIX . "users WHERE username = 'Support' LIMIT 1"));

	    if ($supportRow) {
	        $supportUid = (int) $supportRow['id'];
	        $supportHas = mysqli_fetch_assoc(mysqli_query($database->dblink,
	            "SELECT COUNT(*) AS total FROM " . TB_PREFIX . "vdata WHERE owner = " . $supportUid));

	        if (!$supportHas || (int) $supportHas['total'] === 0) {
	            $supportWid = 0;

	            // inelul 0 ar fi doar (0,0), care e deja al Multihunter-ului,
	            // deci pornim direct de la inelul 1
	            for ($radius = 1; $radius <= 20 && $supportWid === 0; $radius++) {
	                $ringWids = [];

	                for ($dx = -$radius; $dx <= $radius; $dx++) {
	                    for ($dy = -$radius; $dy <= $radius; $dy++) {
	                        // doar marginea inelului curent (interiorul a fost
	                        // deja verificat la razele anterioare)
	                        if (max(abs($dx), abs($dy)) != $radius) {
	                            continue;
	                        }

	                        $ringWids[] = ((int) WORLD_MAX - $dy) * ((int) WORLD_MAX * 2 + 1) + ((int) WORLD_MAX + $dx + 1);
	                    }
	                }

	                // o singura interogare, sursa de adevar = DB-ul curent
	                $supportWid = (int) $database->getFreeVillage($ringWids);
	            }

	            if ($supportWid > 0) {
	                $database->setFieldTaken($supportWid);
	                $database->addVillage($supportWid, $supportUid, 'Support', 1);
	                $database->addResourceFields($supportWid, 3);
	                $database->addUnits($supportWid);
	                $database->addTech($supportWid);
	                $database->addABTech($supportWid);
	            } else {
	                // extrem de improbabil (ar insemna 1680 de casute ocupate
	                // sau oaza chiar langa centrul hartii) - semnalam clar in
	                // loc sa lasam Support fara sat in tacere
	                error_log('TravianZ install: nu am gasit nicio casuta libera (non-oaza) pentru satul Support in raza de 20 fata de centrul hartii.');
	            }
	        }
	    }

        $gameinstall = 0;
		header("Location: ../index.php?s=5");

?>
