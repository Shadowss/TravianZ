<?php
use App\Entity\User;

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       Account.php                                                 ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################

/*
=========================================================
= AUTOLOADER DISCOVERY
=========================================================
*/

global $autoprefix;

$autoprefix = '';

for ($i = 0; $i < 5; $i++) {

    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

include_once($autoprefix . "GameEngine/Session.php");


/*
=========================================================
= ACCOUNT CLASS
=========================================================
*/

class Account
{
    /*
    =====================================================
    = CONSTRUCTOR / REQUEST ROUTER
    =====================================================
    */

    public function __construct()
    {
        global $session;

        if (isset($_POST['ft'])) {

            switch ($_POST['ft']) {

                case "a1":
                    $this->Signup();
                    break;

                case "a2":
                    $this->Activate();
                    break;

                case "a3":
                    $this->Unreg();
                    break;

                case "a4":
                    $this->Login();
                    break;
            }
        }

        elseif (isset($_GET['code'])) {

            $_POST['id'] = $_GET['code'];
            $this->Activate();
        }

        elseif (
            $session->logged_in &&
            in_array("logout.php", explode("/", $_SERVER['PHP_SELF']))
        ) {
            $this->Logout();
        }
    }


    /*
    =====================================================
    = SIGNUP
    =====================================================
    */

    private function Signup()
    {
        global $database, $form, $mailer, $generator;

        /*
        -------------------------------------------------
        USERNAME VALIDATION
        -------------------------------------------------
        */

        if (empty($_POST['name'])) {

            $form->addError("name", USRNM_EMPTY);

        } else {

            if (strlen($_POST['name']) < USRNM_MIN_LENGTH)
                $form->addError("name", USRNM_SHORT);

            elseif (!USRNM_SPECIAL && preg_match('/[^0-9A-Za-z]/', $_POST['name']))
                $form->addError("name", USRNM_CHAR);

            elseif (USRNM_SPECIAL &&
                preg_match("/[:,\\. \\n\\r\\t\\s\\<\\>]+/", $_POST['name']))
                $form->addError("name", USRNM_CHAR);

            elseif (strtolower($_POST['name']) == 'natars')
                $form->addError("name", USRNM_TAKEN);

            elseif (User::exists($database, $_POST['name']))
                $form->addError("name", USRNM_TAKEN);
        }


        /*
        -------------------------------------------------
        PASSWORD VALIDATION
        -------------------------------------------------
        */

        if (empty($_POST['pw'])) {

            $form->addError("pw", PW_EMPTY);

        } else {

            if (strlen($_POST['pw']) < PW_MIN_LENGTH)
                $form->addError("pw", PW_SHORT);

            elseif ($_POST['pw'] == $_POST['name'])
                $form->addError("pw", PW_INSECURE);
        }


        /*
        -------------------------------------------------
        EMAIL VALIDATION
        -------------------------------------------------
        */

        if (!isset($_POST['email'])) {

            $form->addError("email", EMAIL_EMPTY);

        } else {

            if (!$this->validEmail($_POST['email']))
                $form->addError("email", EMAIL_INVALID);

            elseif (User::exists($database, $_POST['email']))
                $form->addError("email", EMAIL_TAKEN);
        }


        /*
        -------------------------------------------------
        TRIBE & AGREEMENT VALIDATION
        -------------------------------------------------
        */

        if (!isset($_POST['vid']) || !in_array($_POST['vid'], [1,2,3]))
            $form->addError("tribe", TRIBE_EMPTY);

        if (!isset($_POST['agb']))
            $form->addError("agree", AGREE_ERROR);


        /*
        -------------------------------------------------
        ERROR HANDLING
        -------------------------------------------------
        */

        if ($form->returnErrors() > 0) {

            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;

            header("Location: anmelden.php");
            exit;
        }


        /*
        -------------------------------------------------
        REGISTRATION FLOW
        -------------------------------------------------
        */

        if (AUTH_EMAIL) {

            $act  = $generator->generateRandStr(10);
            $act2 = $generator->generateRandStr(5);

            $uid = $database->activate(
                $_POST['name'],
                password_hash($_POST['pw'], PASSWORD_BCRYPT, ['cost'=>12]),
                $_POST['email'],
                $_POST['vid'],
                $_POST['kid'],
                $act,
                $act2
            );

            if ($uid) {

                $mailer->sendActivate(
                    $_POST['email'],
                    $_POST['name'],
                    $_POST['pw'],
                    $act
                );

                header("Location: activate.php?id=$uid&q=$act2");
                exit;
            }

        } else {

            $uid = $database->register(
                $_POST['name'],
                password_hash($_POST['pw'], PASSWORD_BCRYPT, ['cost'=>12]),
                $_POST['email'],
                $_POST['vid'],
                ""
            );

            if ($uid) {

                setcookie("COOKUSR", $_POST['name'], time()+COOKIE_EXPIRE, COOKIE_PATH);
                setcookie("COOKEMAIL", $_POST['email'], time()+COOKIE_EXPIRE, COOKIE_PATH);

                $database->updateUserField(
                    $uid,
                    ["act", "invited"],
                    ["", $_POST['invited']],
                    1
                );

                $this->generateBase($_POST['kid'], $uid, $_POST['name']);

                header("Location: login.php");
                exit;
            }
        }
    }


    /*
    =====================================================
    = LOGIN
    =====================================================
    */

    private function Login()
    {
        global $database, $session, $form;

        if (empty($_POST['user']))
            $form->addError("user", LOGIN_USER_EMPTY);

        elseif (!User::exists($database, $_POST['user']))
            $form->addError("user", USR_NT_FOUND);

        if (empty($_POST['pw']))
            $form->addError("pw", LOGIN_PASS_EMPTY);

        elseif (
            !$database->login($_POST['user'], $_POST['pw']) &&
            !$database->sitterLogin($_POST['user'], $_POST['pw'])
        )
            $form->addError("pw", LOGIN_PW_ERROR);

        $userData = $database->getUserArray($_POST['user'], 0);

        if ($userData["vac_mode"] == 1 && $userData["vac_time"] > time())
            $form->addError("vacation", "Vacation mode is still enabled");

        if ($form->returnErrors() > 0) {

            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;

            header("Location: login.php");
            exit;
        }

        /*
        -------------------------------------------------
        SUCCESS LOGIN FLOW
        -------------------------------------------------
        */

        $database->removevacationmode($userData['id']);

        if ($database->login($_POST['user'], $_POST['pw']))
            $database->UpdateOnline("login", $_POST['user'], time(), $userData['id']);

        elseif ($database->sitterLogin($_POST['user'], $_POST['pw']))
            $database->UpdateOnline("sitter", $_POST['user'], time(), $userData['id']);

        setcookie("COOKUSR", $_POST['user'], time()+COOKIE_EXPIRE, COOKIE_PATH);

        $session->login($_POST['user']);
    }


    /*
    =====================================================
    = LOGOUT
    =====================================================
    */

    private function Logout()
    {
        global $session, $database;

        unset($_SESSION['wid']);

        $database->activeModify(addslashes($session->username), 1);
        $database->UpdateOnline("logout");

        $session->Logout();
    }


    /*
    =====================================================
    = EMAIL VALIDATOR
    =====================================================
    */

    private function validEmail($email)
    {
        $regexp = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
        return preg_match($regexp, $email);
    }


    /*
    =====================================================
    = BASE GENERATION
    =====================================================
    */

    function generateBase($kid, $uid, $username)
    {
        global $database;

        $message = new Message();

        if ($kid == 0)
            $kid = rand(1,4);
        else
            $kid = $_POST['kid'];

        $database->generateVillages(
            [[
                'wid'     => 0,
                'mode'    => 0,
                'type'    => 3,
                'kid'     => $kid,
                'capital' => 1,
                'pop'     => 2,
                'name'    => null,
                'natar'   => 0
            ]],
            $uid,
            $username
        );

        $message->sendWelcome($uid, $username);
    }
}

$account = new Account;
?>

