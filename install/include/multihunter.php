<?php
$gameinstall = 1;

		include ("../../GameEngine/config.php");
		include ("../../GameEngine/Database.php");
		include ("../../GameEngine/Admin/database.php");
		include ("../../GameEngine/Lang/" . LANG . ".php");

		mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysqli_select_db(SQL_DB);

		if(isset($_POST['mhpw'])) {
			$password = $_POST['mhpw'];
			mysqli_query($GLOBALS['link'],"UPDATE " . TB_PREFIX . "users SET password = '" . md5($password) . "' WHERE username = 'Multihunter'");
			$wid = $admin->getWref(0, 0);
			$uid = 5;
			$status = $database->getVillageState($wid);
			if($status == 0) {
				$database->setFieldTaken($wid);
				$database->addVillage($wid, $uid, 'Multihunter', '0');
				$database->addResourceFields($wid, $database->getVillageType($wid));
				$database->addUnits($wid);
				$database->addTech($wid);
				$database->addABTech($wid);
			}
		}

$gameinstall = 0;
		header("Location: ../index.php?s=5");

?>