<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Mailer.php                                                  ##
##  Developed by:  Dixie                                                       ##
##  Refactored:    Shadow (PHP 7+ compatibility, cleanup, safety pass)         ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

class Mailer
{
	/**
	 * -------------------------------------------------------------------------
	 * SEND ACTIVATION EMAIL
	 * -------------------------------------------------------------------------
	 */
	function sendActivate($email, $username, $pass, $act)
	{
		$subject = "Welcome to " . SERVER_NAME;

		$message =
			"Hello " . $username . "\n\n" .
			"Thank you for your registration.\n\n" .
			"----------------------------\n" .
			"Name: " . $username . "\n" .
			"Password: " . $pass . "\n" .
			"Activation code: " . $act . "\n" .
			"----------------------------\n\n" .
			"Click the following link in order to activate your account:\n" .
			SERVER . "activate.php?code=" . $act . "\n\n" .
			"Greetings,\n" .
			"Travian administration";

		$headers = "From: " . ADMIN_EMAIL . "\r\n";

		@mail($email, $subject, $message, $headers);
	}

	/**
	 * -------------------------------------------------------------------------
	 * SEND INVITE EMAIL
	 * -------------------------------------------------------------------------
	 * FIX: $username was undefined -> fallback safe value added
	 */
	function sendInvite($email, $uid, $text)
	{
		$subject = SERVER_NAME . " registration";

		// FIX: prevent undefined variable notice
		$username = "User";

		$message =
			"Hello " . $username . "\n\n" .
			"Try the new " . SERVER_NAME . "!\n\n\n" .
			"Link: " . SERVER . "anmelden.php?id=ref" . $uid . "\n\n" .
			$text . "\n\n\n" .
			"Greetings,\n" .
			"Travian";

		$headers = "From: " . ADMIN_EMAIL . "\r\n";

		@mail($email, $subject, $message, $headers);
	}

	/**
	 * -------------------------------------------------------------------------
	 * SEND PASSWORD RESET EMAIL
	 * -------------------------------------------------------------------------
	 */
	function sendPassword($email, $uid, $username, $npw, $cpw)
	{
		$subject = "Password forgotten";

		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';

		$message =
			"Hello " . $username . "\n\n" .
			"You have requested a new password for Travian.\n\n" .
			"----------------------------\n" .
			"Name: " . $username . "\n" .
			"Password: " . $npw . "\n" .
			"----------------------------\n\n" .
			"Please click this link to activate your new password. The old password then becomes invalid:\n\n" .
			"http://" . $host . "/password.php?cpw=" . $cpw . "&npw=" . $uid . "\n\n" .
			"If you want to change your new password, you can enter a new one in your profile\n" .
			"on tab \"account\".\n\n" .
			"In case you did not request a new password you may ignore this email.\n\n" .
			"Travian";

		$headers = "From: " . ADMIN_EMAIL . "\r\n";

		@mail($email, $subject, $message, $headers);
	}
}

/**
 * -------------------------------------------------------------------------
 * GLOBAL INSTANCE (legacy compatibility)
 * -------------------------------------------------------------------------
 */
$mailer = new Mailer();

?>