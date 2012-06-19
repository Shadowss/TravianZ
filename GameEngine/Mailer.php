<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Mailer.php                                                  ##
##  Developed by:  Dixie                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Mailer {

	function sendActivate($email,$username,$pass,$act) {

		$subject = "Welcome to ".SERVER_NAME;

		$message = "Hello ".$username."

Thank you for your registration.

----------------------------
Name: ".$username."
Password: ".$pass."
Activation code: ".$act."
----------------------------

Click the following link in order to activate your account:
".SERVER."activate.php?code=".$act."

Greetings,
Travian adminision";

		$headers = "From: ".ADMIN_EMAIL."\n";

		mail($email, $subject, $message, $headers);
	}

	function sendInvite($email,$uid,$text) {

		$subject = "".SERVER_NAME." registeration";

		$message = "Hello ".$username."

Try the new ".SERVER_NAME."!


Link: ".SERVER."anmelden.php?id=ref".$uid."

".$text."


Greetings,
Travian";

		$headers = "From: ".ADMIN_EMAIL."\n";

		mail($email, $subject, $message, $headers);
	}

	function sendPassword($email,$uid,$username,$npw,$cpw) {

		$subject = "Password forgotten";

		$message = "Hello ".$username."

You have requested a new password for Travian.

----------------------------
Name: ".$username."
Password: ".$npw."
----------------------------

Please click this link to activate your new password. The old password then
becomes invalid:

http://${_SERVER['HTTP_HOST']}/password.php?cpw=$cpw&npw=$uid

If you want to change your new password, you can enter a new one in your profile
on tab \"account\".

In case you did not request a new password you may ignore this email.

Travian
";

		$headers = "From: ".ADMIN_EMAIL."\n";

		mail($email, $subject, $message, $headers);
	}

};
$mailer = new Mailer;
?>