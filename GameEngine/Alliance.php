<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Alliance.php                                                ##
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

$autoloader_found = false;
$autoprefix = '';

for ($i = 0; $i < 5; $i++) {

    $autoprefix = str_repeat('../', $i);

    if (file_exists($autoprefix . 'autoloader.php')) {
        $autoloader_found = true;
        include_once $autoprefix . 'autoloader.php';
        break;
    }
}

if (!$autoloader_found) {
    die('Could not find autoloading class.');
}


/*
=========================================================
= ALLIANCE DOMAIN CONTROLLER
=========================================================
*/

class Alliance
{
    /*
    =====================================================
    = PROPERTIES
    =====================================================
    */

    public $gotInvite      = false;
    public $inviteArray    = [];
    public $allianceArray  = [];
    public $userPermArray  = [];


    /*
    =====================================================
    = INITIAL PROCESSOR
    =====================================================
    */

    public function procAlliance($get)
    {
        global $session, $database;

        /*
        -------------------------------------------------
        LOAD ALLIANCE OR INVITES
        -------------------------------------------------
        */

        if ($session->alliance > 0) {

            $this->allianceArray = $database->getAlliance($session->alliance);
            $this->userPermArray = $database->getAlliPermissions(
                $session->uid,
                $session->alliance
            );

        } else {

            $this->inviteArray = $database->getInvitation($session->uid);
            $this->gotInvite   = count($this->inviteArray) > 0;
        }

        /*
        -------------------------------------------------
        INVITE ACTIONS
        -------------------------------------------------
        */

        if (isset($get['a'])) {

            switch ($get['a']) {

                case 2:
                    $this->rejectInvite($get);
                    break;

                case 3:
                    $this->acceptInvite($get);
                    break;
            }
        }

        /*
        -------------------------------------------------
        OWNER ACTIONS
        -------------------------------------------------
        */

        if (isset($get['o'])) {

            if ($get['o'] == 4) {
                $this->delInvite($get);
            }
        }
    }


    /*
    =====================================================
    = FORUM ACCESS CONTROL
    =====================================================
    */

    public function isForumAccessible($forumID)
    {
        global $session;

        foreach ($session->sharedForums as $forums) {
            foreach ($forums as $forum) {
                if ($forum['id'] == $forumID) {
                    return true;
                }
            }
        }

        return false;
    }


    /*
    =====================================================
    = PERMISSION CHECKER
    =====================================================
    */

    public static function canAct($datas, $mode = 0)
    {
        global $database, $session;

        $hasSwitchedToAdmin =
            isset($datas['admin']) &&
            $datas['admin'] == "switch_admin";

        return (
            (
                $datas['alliance'] > 0 &&
                (
                    $database->isAllianceOwner($session->uid) == $datas['alliance'] ||
                    ($datas['forum_perm'] == 1 &&
                     $session->alliance == $datas['alliance'])
                )
            ) ||
            ($datas['owner'] == $session->uid && $session->access != ADMIN) ||
            ($session->access == ADMIN)
        ) && ($mode || $hasSwitchedToAdmin);
    }


    /*
    =====================================================
    = FORUM VISIBILITY BUILDER
    =====================================================
    */

    public function createForumVisiblity(
        $alliancesID,
        $alliancesName,
        $usersID,
        $usersName
    )
    {
        global $database, $session;

        $alliances = [];
        $users     = [];

        /*
        -------------------------------------------------
        DEDUPLICATE ALLIANCES
        -------------------------------------------------
        */

        if (!empty($alliancesID)) {

            foreach ($alliancesID as $alliance) {

                if (
                    !empty($alliance) &&
                    is_numeric($alliance) &&
                    $database->aExist($alliance, 'id') &&
                    $alliance != $session->alliance &&
                    empty($database->diplomacyExistingRelationships($alliance))
                ) {
                    $alliances[$alliance] = true;
                }
            }
        }

        if (!empty($alliancesName)) {

            foreach ($alliancesName as $alliance) {

                $allianceID = $database->getAllianceID($alliance);

                if (
                    !empty($allianceID) &&
                    $allianceID != $session->alliance &&
                    empty($database->diplomacyExistingRelationships($allianceID))
                ) {
                    $alliances[$allianceID] = true;
                }
            }
        }

        /*
        -------------------------------------------------
        DEDUPLICATE USERS
        -------------------------------------------------
        */

        if (!empty($usersID)) {

            foreach ($usersID as $user) {

                $userAlly = $database->getUserAllianceID($user);

                if (
                    !empty($user) &&
                    is_numeric($user) &&
                    $userAlly > 0 &&
                    $userAlly != $session->alliance &&
                    $user != $session->uid &&
                    empty($database->diplomacyExistingRelationships($userAlly))
                ) {
                    $users[$user] = true;
                }
            }
        }

        if (!empty($usersName)) {

            foreach ($usersName as $user) {

                $userID = $database->getUserField($user, 'id', 1);
                $userAlly = $database->getUserAllianceID($userID);

                if (
                    !empty($userID) &&
                    $userID != $session->uid &&
                    $userAlly > 0 &&
                    $userAlly != $session->alliance &&
                    empty($database->diplomacyExistingRelationships($userAlly))
                ) {
                    $users[$userID] = true;
                }
            }
        }

        return [
            'alliances' => implode(',', array_keys($alliances)),
            'users'     => implode(',', array_keys($users))
        ];
    }


    /*
    =====================================================
    = REDIRECTION HANDLER
    =====================================================
    */

    public function redirect($get = null)
    {
        header(
            "Location: allianz.php?s=2" .
            (isset($get['fid']) && $get['admin'] != 'pos'
                ? "&fid=" . $get['fid']
                : ""
            ) .
            (isset($get['admin'])
                ? "&admin=switch_admin"
                : ""
            )
        );
        exit;
    }


    /*
    =====================================================
    = ALLIANCE FORM PROCESSOR
    =====================================================
    */

    public function procAlliForm($post)
    {
        if (isset($post['ft']) && $post['ft'] == "ali1") {
            $this->createAlliance($post);
        }

        if (isset($post['dipl'], $post['a_name'])) {
            $this->changediplomacy($post);
        }

        if (isset($post['s'], $post['o'])) {

            switch ($post['o']) {

                case 1:
                    if (isset($post['a']))
                        $this->changeUserPermissions($post);
                    break;

                case 2:
                    if (isset($post['a_user']))
                        $this->kickAlliUser($post);
                    break;

                case 3:
                    $this->updateAlliProfile($post);
                    break;

                case 4:
                    if ($post['a'] == 4)
                        $this->sendInvite($post);
                    break;

                case 11:
                    $this->quitally($post);
                    break;

                case 100:
                    $this->changeAliName($post);
                    break;
            }
        }
    }


    /*
    =====================================================
    = INVITATION MANAGEMENT
    =====================================================
    */

    public function sendInvite($post)
    {
        global $form, $database, $session;

        $UserData = $database->getUserArray(
            stripslashes($post['a_name']),
            0
        );

        if ($this->userPermArray['opt4'] == 0)
            $form->addError("name", NO_PERMISSION);

        elseif (!User::exists($database, $post['a_name']))
            $form->addError("name", NAME_NO_EXIST);

        elseif ($UserData['alliance'] > 0)
            $form->addError("name", ALREADY_IN_AN_ALLY);

        else {

            $database->sendInvitation(
                $UserData['id'],
                $session->alliance,
                $session->uid
            );

            $database->insertAlliNotice(
                $session->alliance,
                '<a href="spieler.php?uid=' . $session->uid . '">' .
                addslashes($session->username) .
                '</a> has invited <a href="spieler.php?uid=' .
                $UserData['id'] . '">' .
                addslashes($UserData['username']) .
                '</a>.'
            );
        }
    }

    /*
    =====================================================
    = QUIT ALLIANCE
    =====================================================
    */

    private function quitally($post)
    {
        global $database, $session, $form;

        if (
            empty($post['pw']) ||
            !password_verify($post['pw'], $session->userinfo['password'])
        ) {
            $form->addError("pw", LOGIN_PW_ERROR);
            return;
        }

        $database->updateUserField($session->uid, 'alliance', 0, 1);
        $database->deleteAlliPermissions($session->uid);

        $database->insertAlliNotice(
            $session->alliance,
            '<a href="spieler.php?uid=' . $session->uid . '">' .
            addslashes($session->username) .
            '</a> has quit the alliance.'
        );

        header("Location: spieler.php?uid=" . $session->uid);
        exit;
    }
}


/*
=========================================================
= INSTANTIATION
=========================================================
*/

$alliance = new Alliance;

?>

