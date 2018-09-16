<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: Dixie
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */
namespace TravianZ\Utils;

abstract class Mailer
{

    /**
     * Sends the activation message
     *
     * @param string $email
     * @param string $username
     * @param string $pass
     * @param string $act
     * @return bool
     */
    public static function sendActivate(string $email, string $username, string $pass, string $act): bool
    {
        $subject = 'Welcome to ' . SERVER_NAME;
        
        $message = 'Hello ' . $username . '

Thank you for your registration.

----------------------------
Name: ' . $username . '
Password: ' . $pass . '
Activation code: ' . $act . '
----------------------------

Click the following link in order to activate your account:
' . SERVER . 'activate.php?code=' . $act . '

Greetings,
Travian adminision';
        
        $headers = 'From: ' . ADMIN_EMAIL . '\n';
        
        return mail($email, $subject, $message, $headers);
    }

    /**
     * Sends an invite to an email
     *
     * @param string $email
     * @param int $uid
     * @param string $text
     * @return bool
     */
    public static function sendInvite(string $email, int $uid, string $text): bool
    {
        $subject = SERVER_NAME . ' registeration';
        
        $message = 'Hello ' . $username . '

Try the new ' . SERVER_NAME . '!


Link: ' . SERVER . 'anmelden.php?ref=' . $uid . '

' . $text . '


Greetings,
Travian';
        
        $headers = 'From: ' . ADMIN_EMAIL . '\n';
        
        return mail($email, $subject, $message, $headers);
    }

    /**
     * Send an email with a link for resetting the password
     *
     * @param string $email
     * @param int $uid
     * @param string $username
     * @param string $npw
     * @param string $cpw
     * @return bool
     */
    public static function sendPassword(string $email, int $uid, string $username, string $npw, string $cpw): bool
    {
        $subject = 'Password forgotten';
        
        $message = 'Hello ' . $username . '

You have requested a new password for Travian.

----------------------------
Name: ' . $username . '
Password: ' . $npw . '
----------------------------

Please click this link to activate your new password. The old password then
becomes invalid:

' . SERVER . 'password.php?id=' . $uid . '&code=' . $cpw . '

If you want to change your new password, you can enter a new one in your profile
on tab \'account\'.

In case you did not request a new password you may ignore this email.

Travian
';
        
        $headers = 'From: ' . ADMIN_EMAIL . '\n';
        
        return mail($email, $subject, $message, $headers);
    }
}
