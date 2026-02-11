<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Mailer.php                                                  ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Mailer {

    /* =====================================================
       INTERNAL SANITIZERS (ANTI HEADER / CRLF INJECTION)
    ====================================================== */

    private function sanitizeEmail($email) {
        $email = trim($email);
        $email = str_replace(array("\r", "\n"), '', $email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return $email;
    }

    private function sanitizeHeader($value) {
        return str_replace(array("\r", "\n"), '', (string)$value);
    }

    private function sanitizeBody($value) {
        return str_replace("\r", '', (string)$value);
    }

    /* =====================================================
       SEND ACCOUNT ACTIVATION
    ====================================================== */

    public function sendActivate($email, $username, $pass, $act) {

        $email = $this->sanitizeEmail($email);
        if (!$email) return false;

        $username = $this->sanitizeBody($username);
        $pass = $this->sanitizeBody($pass);
        $act = $this->sanitizeBody($act);

        $subject = "Welcome to " . SERVER_NAME;

        $message =
"Hello ".$username."

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

        $headers = "From: " . $this->sanitizeHeader(ADMIN_EMAIL);

        return mail($email, $subject, $message, $headers);
    }

    /* =====================================================
       SEND INVITE (BACKWARD COMPATIBLE)
    ====================================================== */

    public function sendInvite($email, $uid, $text, $username = null) {

        $email = $this->sanitizeEmail($email);
        if (!$email) return false;

        $uid = (int)$uid;
        $text = $this->sanitizeBody($text);
        $username = $username !== null ? $this->sanitizeBody($username) : '';

        $subject = SERVER_NAME . " registeration";

        $greeting = $username !== ''
            ? "Hello " . $username
            : "Hello";

        $message =
$greeting."

Try the new ".SERVER_NAME."!

Link: ".SERVER."anmelden.php?id=ref".$uid."

".$text."

Greetings,
Travian";

        $headers = "From: " . $this->sanitizeHeader(ADMIN_EMAIL);

        return mail($email, $subject, $message, $headers);
    }

    /* =====================================================
       SEND PASSWORD RESET
    ====================================================== */

    public function sendPassword($email, $uid, $username, $npw, $cpw) {

        $email = $this->sanitizeEmail($email);
        if (!$email) return false;

        $uid = (int)$uid;
        $username = $this->sanitizeBody($username);
        $npw = $this->sanitizeBody($npw);
        $cpw = $this->sanitizeBody($cpw);

        $host = isset($_SERVER['HTTP_HOST'])
            ? $this->sanitizeHeader($_SERVER['HTTP_HOST'])
            : 'localhost';

        $subject = "Password forgotten";

        $message =
"Hello ".$username."

You have requested a new password for Travian.

----------------------------
Name: ".$username."
Password: ".$npw."
----------------------------

Please click this link to activate your new password. The old password then
becomes invalid:

http://".$host."/password.php?cpw=".$cpw."&npw=".$uid."

If you want to change your new password, you can enter a new one in your profile
on tab \"account\".

In case you did not request a new password you may ignore this email.

Travian";

        $headers = "From: " . $this->sanitizeHeader(ADMIN_EMAIL);

        return mail($email, $subject, $message, $headers);
    }
}

$mailer = new Mailer();
?>
