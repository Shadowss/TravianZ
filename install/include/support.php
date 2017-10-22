<?php
		// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
		@set_time_limit(0);

		$gameinstall = 1;

		include ("../../GameEngine/config.php");
		include ("../../GameEngine/Database.php");
		include ("../../GameEngine/Admin/database.php");
		include ("../../GameEngine/Lang/" . LANG . ".php");

		$conn = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysqli_select_db($conn, SQL_DB);

		if(isset($_POST['spw'])) {
			$password = $_POST['spw'];
			mysqli_query($conn, "UPDATE " . TB_PREFIX . "users SET password = '" . password_hash($password, PASSWORD_BCRYPT,['cost' => 12]) . "' WHERE username = 'Support'");
		}

        $gameinstall = 0;
		header("Location: ../index.php?s=6");

?>