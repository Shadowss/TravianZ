<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Profile.php                                                 ##
##  License:       TravianZ Project                                            ##
##  Refactor:      Shadow  		                                               ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Profile {

    /* ===================================================== */
    /* ================= MAIN PROCESS ====================== */
    /* ===================================================== */

    public function procProfile($post) {

        if(!isset($post['ft'])) return;

        switch($post['ft']) {

            case "p1":
                $this->updateProfile($post);
                break;

            case "p3":
                $this->updateAccount($post);
                break;

            case "p4":
                $this->setVacationMode($post);
                break;
        }

        if(isset($post['s']) && (int)$post['s'] === 4) {
            $this->gpack($post);
        }
    }

    public function procSpecial($get) {

        if(!isset($get['e'])) return;

        switch((int)$get['e']) {

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

    /* ===================================================== */
    /* ================= UPDATE PROFILE ==================== */
    /* ===================================================== */

    private function updateProfile($post) {

        global $database, $session;

        $uid = (int)$session->uid;

        $year  = (int)$post['jahr'];
        $month = (int)$post['monat'];
        $day   = (int)$post['tag'];

        $birthday = $year.'-'.$month.'-'.$day;

        $mw  = $database->RemoveXSS(trim($post['mw']));
        $ort = $database->RemoveXSS(trim($post['ort']));
        $be2 = $database->RemoveXSS(trim($post['be2']));
        $be1 = $database->RemoveXSS(trim($post['be1']));

        $database->submitProfile($uid, $mw, $ort, $birthday, $be2, $be1);

        $villages = $database->getProfileVillages($uid);

        if(is_array($villages)) {
            for($i = 0; $i < count($villages); $i++) {

                if(isset($post['dname'.$i])) {
                    $name = trim($post['dname'.$i]);
                    $name = $database->RemoveXSS($name);

                    $database->setVillageName(
                        (int)$villages[$i]['wref'],
                        $name
                    );
                }
            }
        }

        header("Location: spieler.php?uid=".$uid);
        exit;
    }

    /* ===================================================== */
    /* ================= GP PACK =========================== */
    /* ===================================================== */

    private function gpack($post) {

        global $database, $session;

        $uid = (int)$session->uid;

        if(isset($post['custom_url'])) {

            $url = trim($post['custom_url']);
            $url = $database->RemoveXSS($url);

            $database->gpack($uid, $url);
        }

        header("Location: spieler.php?uid=".$uid);
        exit;
    }

    /* ===================================================== */
    /* ================= VACATION MODE ===================== */
    /* ===================================================== */

    private function setVacationMode($post){

        global $database, $session, $form;

        $days = isset($post['vac_days']) ? (int)$post['vac_days'] : 0;

        if(isset($post['vac']) && $post['vac'] && $days >= 2 && $days <= 14){

            unset($_SESSION['wid']);

            $database->setvacmode((int)$session->uid, $days);
            $database->activeModify($session->username, 1);
            $database->UpdateOnline("logout");

            $session->Logout();

            header("Location: login.php");
            exit;
        }

        $form->addError("vac", VAC_MODE_WRONG_DAYS);

        header("Location: spieler.php?s=".$session->uid);
        exit;
    }

    /* ===================================================== */
    /* ================= UPDATE ACCOUNT ==================== */
    /* ===================================================== */

    private function updateAccount($post) {

        global $database, $session, $form;

        $uid = (int)$session->uid;

        /* ---- PASSWORD CHANGE ---- */

        if(!empty($post['pw1']) && !empty($post['pw2']) && !empty($post['pw3'])) {

            if($post['pw2'] === $post['pw3']) {

                if($database->login($session->username, $post['pw1'])) {

                    $hash = password_hash($post['pw2'], PASSWORD_BCRYPT, array('cost' => 12));
                    $database->updateUserField($uid, "password", $hash, 1);

                } else {
                    $form->addError("pw", LOGIN_PW_ERROR);
                }

            } else {
                $form->addError("pw", PASS_MISMATCH);
            }
        }

        /* ---- EMAIL CHANGE ---- */

        if(!empty($post['email_alt']) && !empty($post['email_neu'])) {

            $newEmail = filter_var($post['email_neu'], FILTER_VALIDATE_EMAIL);

            if($post['email_alt'] === $session->userinfo['email'] && $newEmail) {
                $database->updateUserField($uid, "email", $newEmail, 1);
            } else {
                $form->addError("email", EMAIL_ERROR);
            }
        }

        /* ---- ACCOUNT DELETE ---- */

        if(!empty($post['del_pw']) && !empty($post['del'])) {

            if(password_verify($post['del_pw'], $session->userinfo['password'])) {
                $database->setDeleting($uid, 0);
            } else {
                $form->addError("del", PASS_MISMATCH);
            }
        }

        /* ---- SITTER ADD ---- */

        if(!empty($post['v1'])) {

            $sitID = (int)$database->getUserField($post['v1'], "id", 1);

            if($sitID > 0 && $sitID !== $uid) {

                if($sitID == $session->userinfo['sit1'] ||
                   $sitID == $session->userinfo['sit2']) {

                    $form->addError("sit", SIT_ERROR);

                } else {

                    if((int)$session->userinfo['sit1'] === 0) {
                        $database->updateUserField($uid, "sit1", $sitID, 1);
                    } elseif((int)$session->userinfo['sit2'] === 0) {
                        $database->updateUserField($uid, "sit2", $sitID, 1);
                    }
                }
            }
        }

        if($form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;
        }

        header("Location: spieler.php?s=3");
        exit;
    }

    /* ===================================================== */
    /* ================= REMOVE SITTER ===================== */
    /* ===================================================== */

    private function removeSitter($get) {

        global $database, $session;

        $type = isset($get['type']) ? (int)$get['type'] : 0;
        $id   = isset($get['id']) ? (int)$get['id'] : 0;

        if(isset($get['a']) && $get['a'] == $session->checker) {

            if((int)$session->userinfo['sit'.$type] === $id) {
                $database->updateUserField($session->uid, "sit".$type, 0, 1);
            }

            $session->changeChecker();
        }

        header("Location: spieler.php?s=".(int)$get['s']);
        exit;
    }

    private function cancelDeleting($get) {

        global $database, $session;

        $database->setDeleting((int)$session->uid, 1);

        header("Location: spieler.php?s=".(int)$get['s']);
        exit;
    }

    private function removeMeSit($get) {

        global $database, $session;

        if(isset($get['a']) && $get['a'] == $session->checker) {

            $database->removeMeSit((int)$get['id'], (int)$session->uid);
            $session->changeChecker();
        }

        header("Location: spieler.php?s=".(int)$get['s']);
        exit;
    }

}

$profile = new Profile;
