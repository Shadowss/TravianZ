<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       password.php                                                ##
##  Developed by:  Dixie                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
use App\Utils\AccessLogger;

if(!file_exists('var/installed') && @opendir('install')) {
	header("Location: install/");
	exit;
}
include_once("GameEngine/config.php");
include_once("GameEngine/Lang/" . LANG . ".php");
include_once("GameEngine/Database.php");
include_once("GameEngine/Mailer.php");
include_once("GameEngine/Generator.php");
AccessLogger::logRequest();

if(!isset($_REQUEST['npw'])){
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title><?php echo SERVER_NAME; ?> - Forgotten Password</title>
		<link rel="shortcut icon" href="favicon.ico"/>
	<meta name="content-language" content="en" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js?0faab" type="text/javascript"></script>
	<script src="mt-more.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE ?>travian.css?f4b7d" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE ?>lang/en/lang.css" rel="stylesheet" type="text/css" />
	   </head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
<div id="dynamic_header">
</div>
<div id="header"></div>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>
<div id="content"  class="activate">

		<h1><img src="img/x.gif" class="passwort" alt="new password" /></h1>
		<h5><img src="img/x.gif" class="img_u22" alt="forgotten password" /></h5>

<?php
	// user input email and submit
	if(isset($_POST['email']) && isset($_POST['npw'])){
		$uid = intval($_POST['npw']);
		$email = $database->getUserField($uid, 'email', 0);
		$username = $database->getUserField($uid, 'username', 0);
		if($email != $_POST['email']){
			echo "<p>Unfortunately the entered email address does not match the one used to register the account.</p>\n";
		}else{
			// generate password and cpw
			$npw = $generator->generateRandStr(7);
			$cpw = $generator->generateRandStr(10);

			$database->addPassword($uid, $npw, $cpw);

			// send password mail
			$mailer->sendPassword($email, $uid, $username, $npw, $cpw);

			echo "<p>Password was sent to: ${_POST['email']}</p>\n";
		}

	// user click the link in 'password forgotten' email
	}else if(isset($_GET['cpw']) && isset($_GET['npw'])){
		$uid = intval($_GET['npw']);
		$cpw = preg_replace('#[^a-zA-Z0-9]#', '', $_GET['cpw']);

		if(!$database->resetPassword($uid, $cpw)){
			echo '<p>The password has not been changed. Perhaps the activation code has already been used.</p>';
		}else{
			echo '<p>The password has been successfully changed.</p>';
		}


	// user click 'generate password' link in login fail page, display input form here
	}else {

?>
		<p>Before you can request a new password you have to enter the email address that has been used to register the account.
<br /><br />Afterwards you will receive an e-mail with a new password. The password will only work after confirming it, though.</p>
		<form action="password.php" method="post">
			<p>
				<b>Email</b><br />
				<input type="hidden" name="npw" value="<?php echo intval($_GET['npw']); ?>" />
				<input class="text" type="text" name="email" maxlength="50" />
			</p>

			<p>
				<input type="image" value="ok" name="s1" src="img/x.gif" class="dynamic_img" id="btn_ok" alt="OK" />
			</p>
		</form>
<?php
	}
?>
</div>
<div id="side_info" class="outgame">
</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
			<div class="clear"></div>

<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
</body>
</html>