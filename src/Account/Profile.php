<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */
namespace TravianZ\Account;

use TravianZ\Database\Database;

class Profile
{

    private $database;

    private $session;

    public function __construct(Database $database, Session $session)
    {
        $this->database = $database;
        $this->session = $session;
    }

    public function procProfile($post)
    {
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "p1":
                    $this->updateProfile($post);
                    break;
                case "p3":
                    $this->updateAccount($post);
                    break;
                case "p4":
                    $this->setvactionmode($post);
                    break;
            }
        }
        
        if (isset($post['s']) && $post['s'] == 4)
            $this->gpack($post);
    }

    public function procSpecial($get)
    {
        if (isset($get['e'])) {
            switch ($get['e']) {
                case 2:
                    $this->removeMeSit($get);
                    break;
                case 3:
                    $this->removeSitter($get);
                    break;
                case 4:
                    $this->cancelDeleting($get);
                    break;
            }
        }
    }

    private function updateProfile($post)
    {
        $birthday = $post['jahr'] . '-' . $post['monat'] . '-' . $post['tag'];
        $this->database->submitProfile($this->session->uid, $this->database->RemoveXSS($post['mw']), $this->database->RemoveXSS($post['ort']), $this->database->RemoveXSS($birthday), $this->database->RemoveXSS($post['be2']), $this->database->RemoveXSS($post['be1']));
        $varray = $this->database->getProfileVillages($this->session->uid);
        
        for ($i = 0; $i < count($varray); $i ++) {
            $this->database->setVillageName($varray[$i]['wref'], $this->database->RemoveXSS(trim($post['dname' . $i])));
        }
        
        header("Location: spieler.php?uid=" . $this->session->uid);
        exit();
    }

    private function gpack($post)
    {
        $this->database->gpack($this->database->RemoveXSS($this->session->uid), $this->database->RemoveXSS($post['custom_url']));
        
        header("Location: spieler.php?uid=" . $this->session->uid);
        exit();
    }

    /**
     * Function to activate the vacation mode - by advocaite and Shadow
     *
     * @param array $post
     *            The $_POST array
     */
    private function setvactionmode($post)
    {
        if (isset($post['vac']) && $post['vac'] && isset($post['vac_days']) && $post['vac_days'] >= 2 && $post['vac_days'] <= 14) {
            unset($_SESSION['wid']);
            
            $this->database->setvacmode($this->session->uid, $post['vac_days']);
            $this->database->activeModify(addslashes($this->session->username), 1);
            $this->database->UpdateOnline("logout");
            $this->session->Logout();
            
            header("Location: login.php");
            exit();
        } else {
            $this->form->add("vac", VAC_MODE_WRONG_DAYS);
            
            header("Location: spieler.php?s=" . $this->session->uid);
            exit();
        }
    }

    /**
     * Function to deactivate the vacation mode - by advocaite and Shadow
     *
     * @param array $post
     *            The $_POST array
     */
    private function updateAccount($post)
    {
        if (!empty($post['pw1']) && !empty($post['pw2']) && !empty($post['pw3'])) {
            if ($post['pw2'] == $post['pw3']) {
                if ($this->database->login($this->session->username, $post['pw1'])) {
                    $this->database->updateUserField($this->session->uid, "password", password_hash($post['pw2'], PASSWORD_BCRYPT, [
                        'cost' => 12
                    ]), 1);
                } else
                    $this->form->addError("pw", LOGIN_PW_ERROR);
            } else
                $this->form->addError("pw", PASS_MISMATCH);
        }
        
        if (!empty($post['email_alt']) && !empty($post['email_neu'])) {
            if ($post['email_alt'] == $this->session->userinfo['email']) {
                $this->database->updateUserField($this->session->uid, "email", $post['email_neu'], 1);
            } else
                $this->form->addError("email", EMAIL_ERROR);
        }
        
        if (!empty($post['del_pw']) && $post['del']) {
            if (password_verify($post['del_pw'], $this->session->userinfo['password'])) {
                $this->database->setDeleting($this->session->uid, 0);
            } else
                $this->form->addError("del", PASS_MISMATCH);
        }
        
        if (!empty($post['v1'])) {
            $sitid = $this->database->getUserField($post['v1'], "id", 1);
            if ($sitid == $this->session->userinfo['sit1'] || $sitid == $this->session->userinfo['sit2']) {
                $this->form->addError("sit", SIT_ERROR);
            } else if ($sitid != $this->session->uid) {
                if ($this->session->userinfo['sit1'] == 0) {
                    $this->database->updateUserField($this->session->uid, "sit1", $sitid, 1);
                } else if ($this->session->userinfo['sit2'] == 0) {
                    $this->database->updateUserField($this->session->uid, "sit2", $sitid, 1);
                }
            }
        }
        
        if ($this->form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $_POST;
        }
        
        header("Location: spieler.php?s=3");
        exit();
    }

    private function removeSitter($get)
    {
        if ($get['a'] == $this->session->checker) {
            if ($this->session->userinfo['sit' . $get['type']] == $get['id']) {
                $this->database->updateUserField($this->session->uid, "sit" . $get['type'], 0, 1);
            }
            
            $this->session->changeChecker();
        }
        
        header("Location: spieler.php?s=" . $get['s']);
        exit();
    }

    private function cancelDeleting($get)
    {
        $this->database->setDeleting($this->session->uid, 1);
        
        header("Location: spieler.php?s=" . $get['s']);
        exit();
    }

    private function removeMeSit($get)
    {
        if ($get['a'] == $this->session->checker) {
            $this->database->removeMeSit($get['id'], $this->session->uid);
            $this->session->changeChecker();
        }
        
        header("Location: spieler.php?s=" . $get['s']);
        exit();
    }
}
