<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: yi12345 <https://github.com/martinambrus>
 * ronix <http://forum.ragezone.com/members/833088.html>
 * Advocaite <https://github.com/advocaite>
 * Shadow <https://github.com/shadowss>
 * Mr.php <https://github.com/mrphp>
 * brainiacX <https://github.com/brainiacX>
 * InCube <http://forum.ragezone.com/members/1333458070.html>
 * martinambrus <https://github.com/martinambrus>
 * iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */
namespace TravianZ\Account;

use TravianZ\Entity\User;
use TravianZ\Database\Database;
use TravianZ\Village\Building;
use TravianZ\Error\Form;

class Alliance
{

    public $gotInvite = false;

    public $inviteArray = [];

    public $allianceArray = [];

    public $userPermArray = [];

    private $database;
    
    private $session;
    
    private $building;
    
    private $form;
    
    public function __construct(Database $database, Session $session, Building $building, Form $form)
    {
        $this->database = $database;
        $this->session = $session;
        $this->building = $building;
        $this->form = $form;
    }

    public function procAlliance($get)
    {        
        if ($this->session->alliance > 0) {
            $this->allianceArray = $this->database->getAlliance($this->session->alliance);
            // Permissions Array
            // [id] => id [uid] => uid [alliance] => alliance [opt1] => X [opt2] => X [opt3] => X [opt4] => X [opt5] => X [opt6] => X [opt7] => X [opt8] => X
            $this->userPermArray = $this->database->getAlliPermissions($this->session->uid, $this->session->alliance);
        } else {
            $this->inviteArray = $this->database->getInvitation($this->session->uid);
            $this->gotInvite = count($this->inviteArray) > 0;
        }
        
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
        if (isset($get['o'])) {
            switch ($get['o']) {
                case 4:
                    $this->delInvite($get);
                    break;
            }
        }
    }

    /**
     * Determines if a forum is accessible or not
     *
     * @param int $forumID
     *            The forum ID
     * @return bool Returns if the forum is accessible or not
     */
    public function isForumAccessible($forumID)
    {        
        // Loop through the shared forums and try to find the passed one
        foreach ($this->session->sharedForums as $forums) {
            foreach ($forums as $forum) {
                if ($forum['id'] == $forumID) {
                    return true;
                }      
            }
        }
        return false;
    }

    /**
     * Determines if a player can act with the forum (edit/delete/create things, etc.)
     *
     * @param array $datas
     *            The array which contains: [aid, alliance, forum_perm, admin, owner, forum_owner]
     * @return bool Returns true if you are able to act, false otherwise
     */
    public static function canAct($datas, $mode = 0)
    {        
        $hasSwitchedToAdmin = isset($datas['admin']) && !empty($datas['admin']) && $datas['admin'] == "switch_admin";
        
        return (/*$this->database->CheckEditRes($datas['aid']) == 1 && */($datas['alliance'] > 0 && (($this->database->isAllianceOwner($this->session->uid) == $datas['alliance'] || ($datas['forum_perm'] == 1 && $this->session->alliance == $datas['alliance']))) || ($datas['owner'] == $this->session->uid && $this->session->access != ADMIN)) || ($this->session->access == ADMIN)) && ($mode || $hasSwitchedToAdmin);
    }

    /**
     * Create two string, representing alliances ID and users ID which can see a specific forum
     *
     * @param int $alliancesID
     *            A list of alliances ID
     * @param int $alliancesName
     *            A list of alliances Name
     * @param int $usersID
     *            A list of users ID
     * @param int $usersName
     *            A list of users name
     * @return array Returns the two string, composed by alliances ID and users ID
     */
    public function createForumVisiblity($alliancesID, $alliancesName, $usersID, $usersName)
    {        
        $alliances = $users = [];
        // TODO: Reduce the code of this part and cache existing diplomacy relationship
        // Deduplicate alliances
        if (!empty($alliancesID)) {
            foreach ($alliancesID as $alliance) {
                if (!empty($alliance) && is_numeric($alliance) && $this->database->aExist($alliance, 'id') && $alliance != $this->session->alliance && empty($this->database->diplomacyExistingRelationships($alliance))) {
                    $alliances[$alliance] = true;
                }
            }
        }
        if (!empty($alliancesName)) {
            foreach ($alliancesName as $alliance) {
                if (!empty($alliance) && !empty($allianceID = $this->database->getAllianceID($alliance)) && $allianceID != $this->session->alliance && empty($this->database->diplomacyExistingRelationships($allianceID))) {
                    $alliances[$allianceID] = true;
                }
            }
        }
        
        // Deduplicate users
        if (!empty($usersID)) {
            foreach ($usersID as $user) {
                if (!empty($user) && is_numeric($user) && ($userAlly = $this->database->getUserAllianceID($user)) > 0 && $userAlly != $this->session->alliance && $this->database->getUserField($user, 'username', 0) != "[?]" && $user != $this->session->uid && empty($this->database->diplomacyExistingRelationships($userAlly))) {
                    $users[$user] = true;
                }
            }
        }
        if (!empty($usersName)) {
            foreach ($usersName as $user) {
                if (!empty($user) && !empty($userID = $this->database->getUserField($user, 'id', 1)) && $userID != $this->session->uid && ($userAlly = $this->database->getUserAllianceID($userID)) > 0 && $userAlly != $this->session->alliance && empty($this->database->diplomacyExistingRelationships($userAlly))) {
                    $users[$userID] = true;
                }
            }
        }
        
        return [
            'alliances' => implode(',', array_keys($alliances)),
            'users' => implode(',', array_keys($users))
        ];
    }

    /**
     * Redirects to the forum selection
     *
     * @param array $get
     *            Contains the values of a GET request
     */
    public function redirect($get = null)
    {
        header("Location: allianz.php?s=2" . (isset($get['fid']) && !empty($get['fid']) && $get['admin'] != 'pos' ? "&fid=" . $get['fid'] . "" : "") . (isset($get['admin']) && !empty($get['admin']) ? "&admin=switch_admin" : ""));
        exit();
    }

    public function procAlliForm($post)
    {
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "ali1":
                    $this->createAlliance($post);
                    break;
            }
        }
        
        if (isset($post['dipl']) && isset($post['a_name']))
            $this->changediplomacy($post);
        
        if (isset($post['s'])) {
            if (isset($post['o'])) {
                switch ($post['o']) {
                    case 1:
                        if (isset($_POST['a']))
                            $this->changeUserPermissions($post);
                        break;
                    case 2:
                        if (isset($_POST['a_user']))
                            $this->kickAlliUser($post);
                        break;
                    case 4:
                        if (isset($_POST['a']) && $_POST['a'] == 4)
                            $this->sendInvite($post);
                        break;
                    case 3:
                        $this->updateAlliProfile($post);
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
    }

    /**
     * ***************************************
     * Function to process of sending invitations
     * ***************************************
     */
    public function sendInvite($post)
    {        
        $UserData = $this->database->getUserArray(stripslashes($post['a_name']), 0);
        if ($this->userPermArray['opt4'] == 0) {
            $this->form->addError("name", NO_PERMISSION);
        } elseif (!isset($post['a_name']) || $post['a_name'] == "") {
            $this->form->addError("name", NAME_EMPTY);
        } elseif (!User::exists($this->database, $post['a_name'])) {
            $this->form->addError("name", NAME_NO_EXIST . "" . stripslashes(stripslashes($post['a_name'])));
        } elseif ($UserData['id'] == $this->session->uid) {
            $this->form->addError("name", SAME_NAME);
        } elseif ($this->database->getInvitation2($UserData['id'], $this->session->alliance)) {
            $this->form->addError("name", $post['a_name'] . ALREADY_INVITED);
        } elseif ($UserData['alliance'] == $this->session->alliance) {
            $this->form->addError("name", $post['a_name'] . ALREADY_IN_ALLY);
        } elseif ($UserData['alliance'] > 0) {
            $this->form->addError("name", $post['a_name'] . ALREADY_IN_AN_ALLY);
        } else {
            // Obtenemos la informacion necesaria
            $aid = $this->session->alliance;
            // Insertamos invitacion
            $this->database->sendInvitation($UserData['id'], $aid, $this->session->uid);
            // Log the notice
            $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has invited  <a href="spieler.php?uid=' . $UserData['id'] . '">' . addslashes($UserData['username']) . '</a> into the alliance.');
            // send invitation via in-game messages
            if (NEW_FUNCTIONS_ALLIANCE_INVITATION) {
                $this->database->sendMessage($UserData['id'], 4, 'Invitation to Alliance', $this->database->escape("Hi, " . $UserData['username'] . "!\n\nThis is to inform you that you have been invited to join an alliance. To accept this invitation, please visit your Embassy.\n\nYours sincerely,\n<i>Server Robot :)</i>"), 0, 0, 0, 0, 0, true);
            }
        }
    }

    /**
     * ***************************************
     * Function to reject an invitation
     * ***************************************
     */
    private function rejectInvite($get)
    {        
        foreach ($this->inviteArray as $invite) {
            if ($invite['id'] == $get['d'] && $invite['uid'] == $this->session->uid) {
                $this->database->removeInvitation($get['d']);
                $this->database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has rejected the invitation.');
            }
        }
        
        header("Location: build.php?gid=18");
        exit();
    }

    /**
     * ***************************************
     * Function to del an invitation
     * ***************************************
     */
    private function delInvite($get)
    {        
        $inviteArray = $this->database->getAliInvitations($this->session->alliance);
        foreach ($inviteArray as $invite) {
            if ($invite['id'] == $get['d'] && $invite['alliance'] == $this->session->alliance && $this->userPermArray['opt4'] == 1) {
                $invitename = $this->database->getUserArray($invite['uid'], 1);
                $this->database->removeInvitation($get['d']);
                $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has deleted the invitation for <a href="spieler.php?uid=' . $invitename['id'] . '">' . addslashes($invitename['username']) . '</a>.');
            }
        }
        header("Location: allianz.php?delinvite");
        exit();
    }

    /**
     * ***************************************
     * Function to accept an invitation
     * ***************************************
     */
    private function acceptInvite($get)
    {       
        foreach ($this->inviteArray as $invite) {
            if ($this->session->alliance == 0) {
                if ($invite['id'] == $get['d'] && $invite['uid'] == $this->session->uid) {
                    $memberlist = $this->database->getAllMember($invite['alliance']);
                    $alliance_info = $this->database->getAlliance($invite['alliance']);
                    if (count($memberlist) < $alliance_info['max']) {
                        $this->database->removeInvitation($get['d']);
                        $this->database->updateUserField($invite['uid'], "alliance", $invite['alliance'], 1);
                        $this->database->createAlliPermissions($invite['uid'], $invite['alliance'], '', 0, 0, 0, 0, 0, 0, 0, 0);
                        // Log the notice
                        $this->database->insertAlliNotice($invite['alliance'], '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has joined the alliance.');
                    } else {
                        $accept_error = 1;
                        $max = $alliance_info['max'];
                    }
                }
            }
        }
        
        if ($accept_error == 1)
            $this->form->addError("ally_accept", "The alliance can contain only " . $max . " members at this moment.");
        else {
            header("Location: build.php?gid=18");
            exit();
        }
    }

    /**
     * ***************************************
     * Function to create an alliance
     * ***************************************
     */
    private function createAlliance($post)
    {
        global $bid18;
        
        if (!isset($post['ally1']) || $post['ally1'] == "") {
            $this->form->addError("ally1", ATAG_EMPTY);
        }
        
        if (!isset($post['ally2']) || $post['ally2'] == "") {
            $this->form->addError("ally2", ANAME_EMPTY);
        }
        
        if ($this->database->aExist($post['ally1'], "tag")) {
            $this->form->addError("ally1", ATAG_EXIST);
        }
        
        if ($this->database->aExist($post['ally2'], "name")) {
            $this->form->addError("ally2", ANAME_EXIST);
        }
        
        if ($this->session->alliance != 0) {
            $this->form->addError("ally3", ALREADY_ALLY_MEMBER);
        }
        
        if ($this->building->getTypeLevel(18) < 3) {
            $this->form->addError("ally4", ALLY_TOO_LOW);
        }
        
        if ($this->form->returnErrors() != 0) {
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $post;
            if ($this->building->getTypeLevel(18) > 0)
                header("Location: build.php?gid=18");
            else
                header("Location: dorf2.php");
            exit();
        } else {
            $max = $bid18[$this->building->getTypeLevel(18)]['attri'];
            $aid = $this->database->createAlliance($post['ally1'], $post['ally2'], $this->session->uid, $max);
            $this->database->updateUserField($this->session->uid, "alliance", $aid, 1);
            $this->database->procAllyPop($aid);
            // Asign Permissions
            $this->database->createAlliPermissions($this->session->uid, $aid, 'Alliance founder', '1', '1', '1', '1', '1', '1', '1', '1');
            // log the notice
            $this->database->insertAlliNotice($aid, 'The alliance has been founded by <a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a>.');
            header("Location: build.php?gid=18");
            exit();
        }
    }

    /**
     * ***************************************
     * Function to change the alliance name
     * ***************************************
     */
    private function changeAliName($get)
    {        
        $userAlly = $this->database->getAlliance($this->session->alliance);
        
        if (!isset($get['ally1']) || $get['ally1'] == "")
            $this->form->addError("ally1", ATAG_EMPTY);
        
        if (!isset($get['ally2']) || $get['ally2'] == "")
            $this->form->addError("ally2", ANAME_EMPTY);
        
        if ($get['ally1'] != $userAlly['tag'] && $this->database->aExist($get['ally1'], "tag"))
            $this->form->addError("ally1", ATAG_EXIST);
        
        if ($get['ally2'] != $userAlly['name'] && $this->database->aExist($get['ally2'], "name"))
            $this->form->addError("ally2", ANAME_EXIST);
        
        if ($this->userPermArray['opt3'] == 0)
            $this->form->addError("perm", NO_PERMISSION);
        
        if ($this->form->returnErrors() == 0) {
            $this->database->setAlliName($this->session->alliance, $get['ally2'], $get['ally1']);
            // log the notice
            $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has changed the alliance name.');
            $this->form->addError("perm", NAME_OR_TAG_CHANGED);
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $get;
            header("Location: allianz.php?s=5");
            exit();
        }
    }

    /**
     * ***************************************
     * Function to create/change the alliance description
     * ***************************************
     */
    private function updateAlliProfile($post)
    {
        if ($this->userPermArray['opt3'] == 0) {
            $this->form->addError("perm", NO_PERMISSION);
        }
        if ($this->form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $post;
        } else {
            $this->database->submitAlliProfile($this->session->alliance, $post['be2'], $post['be1']);
            // log the notice
            $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has changed the alliance description.');
        }
    }

    /**
     * ***************************************
     * Function to change the user permissions
     * ***************************************
     */
    private function changeUserPermissions($post)
    {
        if ($this->userPermArray['opt1'] == 0)
            $this->form->addError("perm", NO_PERMISSION);
        elseif ($this->database->getUserField($post['a_user'], "alliance", 0) != $this->session->alliance)
            $this->form->addError("perm", USER_NOT_IN_YOUR_ALLY);
        elseif ($post['a_user'] == $this->session->uid)
            $this->form->addError("perm", CANT_EDIT_YOUR_PERMISSIONS);
        elseif ($this->database->isAllianceOwner($_POST['a_user']))
            $this->form->addError("perm", CANT_EDIT_LEADER_PERMISSIONS);
        else {
            $this->database->updateAlliPermissions($post['a_user'], $this->session->alliance, $post['a_titel'], $post['e1'], $post['e2'], $post['e3'], $post['e4'], $post['e5'], $post['e6'], $post['e7']);
            // log the notice
            $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has changed permissions of <a href="spieler.php?uid=' . $post['a_user'] . '">' . addslashes($this->database->getUserField($post['a_user'], "username", 0)) . '</a>.');
            $this->form->addError("perm", ALLY_PERMISSIONS_UPDATED);
        }
        
        if ($this->form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $post;
            header("Location: allianz.php?s=5");
            exit();
        }
    }

    /**
     * ***************************************
     * Function to kick a user from alliance
     * ***************************************
     */
    private function kickAlliUser($post)
    {
        $UserData = $this->database->getUserArray($post['a_user'], 1);
        if ($this->userPermArray['opt2'] == 0) {
            $this->form->addError("perm", NO_PERMISSION);
        } else if ($this->database->getUserField($post['a_user'], "alliance", 0) != $this->session->alliance) {
            $this->form->addError("perm", USER_NOT_IN_YOUR_ALLY);
        } else if ($UserData['id'] != $this->session->uid) {
            $this->database->updateUserField($post['a_user'], 'alliance', 0, 1);
            $this->database->deleteAlliPermissions($post['a_user']);
            $this->database->deleteAlliance($this->session->alliance);
            // log the notice
            $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $UserData['id'] . '">' . ($kickedUsername = addslashes($this->database->getUserField($post['a_user'], "username", 0))) . '</a> has been expelled from the alliance by <a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a>.');
            if ($this->session->alliance && $this->database->isAllianceOwner($UserData['id']) == $this->session->alliance) {
                $newowner = $this->database->getAllMember2($this->session->alliance);
                $newleader = $newowner['id'];
                $q = "UPDATE " . TB_PREFIX . "alidata set leader = " . (int) $newleader . " where id = " . (int) $this->session->alliance . "";
                $this->database->query($q);
                $this->database->updateAlliPermissions($newleader, 1, 1, 1, 1, 1, 1, 1, 1, 1);
                Database::updateMax($newleader);
            }
            $this->form->addError("perm", $kickedUsername . ALLY_USER_KICKED);
        }
    }

    /**
     * ***************************************
     * Function to set forum link
     * ***************************************
     */
    public function setForumLink($post)
    {
        if ($this->userPermArray['opt5'] == 0) {
            $this->form->addError("perm", NO_PERMISSION);
        } else {
            $this->database->setAlliForumdblink($this->session->alliance, $post['f_link']);
            $this->form->addError("perm", ALLY_FORUM_LINK_UPDATED);
        }
    }

    /**
     * ***************************************
     * Function to vote on forum survey
     * ***************************************
     */
    public function Vote($post)
    {       
        if ($this->database->checkSurvey($post['tid']) && !$this->database->checkVote($post['tid'], $this->session->uid)) {
            $survey = $this->database->getSurvey($post['tid']);
            $text = '' . $survey['voted'] . ',' . $this->session->uid . ',';
            $this->database->Vote($post['tid'], $post['vote'], $text);
        }
        header("Location: allianz.php?s=2&fid2=" . $post['fid2'] . "&tid=" . $post['tid']);
        exit();
    }

    /**
     * ***************************************
     * Function to quit from alliance
     * ***************************************
     */
    private function quitally($post)
    {
        if (!isset($post['pw']) || $post['pw'] == "") {
            $this->form->addError("pw", PW_EMPTY);
        } elseif (!password_verify($post['pw'], $this->session->userinfo['password'])) {
            $this->form->addError("pw", LOGIN_PW_ERROR);
        } else {
            // check whether this is not the founder leaving and if he is, see whether
            // his replacement has been selected
            if ($this->session->alliance && $this->database->isAllianceOwner($this->session->uid) == $this->session->alliance && $this->database->countAllianceMembers($this->session->alliance) > 1) {
                // check that we have a valid new founder
                if (!isset($post['new_founder'])) {
                    $this->form->addError("founder", 'Founder was not selected.');
                    return;
                } else {
                    $post['new_founder'] = (int) $post['new_founder'];
                }
                
                $members = $this->database->getAllMember($this->session->alliance);
                $validMemberFound = false;
                
                foreach ($members as $member) {
                    if ($member['id'] == $post['new_founder']) {
                        $validMemberFound = true;
                        break;
                    }
                }
                
                if (!$validMemberFound || $post['new_founder'] == $this->session->uid) {
                    $this->form->addError("founder", 'Invalid founder.');
                    return;
                }
                
                $newleader = (int) $post['new_founder'];
                $q = "UPDATE " . TB_PREFIX . "alidata set leader = " . $newleader . " where id = " . (int) $this->session->alliance;
                $_SESSION['alliance_user'] = 0;
                $this->database->query($q);
                $this->database->createAlliPermissions($newleader, $this->session->alliance, 'Alliance Leader', 1, 1, 1, 1, 1, 1, 1, 1);
                Database::updateMax($newleader);
                
                // send the new founder an in-game message, notifying them of their election
                $this->database->sendMessage($newleader, 4, 'You are now leader of your alliance', "Hi!\n\nThis is to inform you that the former leader of your alliance - <a href=\"" . rtrim(SERVER, '/') . "/spieler.php?uid=" . (int) $this->session->uid . "\">" . $this->database->escape($this->session->username) . "</a>, has decided to quit and elected you as his replacement. You now gain full access, administration and responsibilities to your alliance.\n\nGood luck!\n\nYours sincerely,\n<i>Server Robot :)</i>", 0, 0, 0, 0, 0, true);
            }
            
            $this->database->updateUserField($this->session->uid, 'alliance', 0, 1);
            $this->database->deleteAlliPermissions($this->session->uid);
            // log the notice
            $this->database->deleteAlliance($this->session->alliance);
            $this->database->insertAlliNotice($this->session->alliance, '<a href="spieler.php?uid=' . $this->session->uid . '">' . addslashes($this->session->username) . '</a> has quit the alliance.');
            header("Location: spieler.php?uid=" . $this->session->uid);
            exit();
        }
    }

    private function changediplomacy($post)
    {
        if ($this->userPermArray['opt6'] == 1) {
            if (!empty($post['a_name']) || !empty($post['dipl'])) {
                $aName = $post['a_name'];
                $aType = (int) intval($post['dipl']);
                if ($this->database->aExist($aName, "tag")) {
                    $allianceID = $this->database->getAllianceID($aName);
                    if ($allianceID != $this->session->alliance) {
                        if ($aType >= 1 and $aType <= 3) {
                            if (!$this->database->diplomacyInviteCheck2($this->session->alliance, $allianceID)) {
                                if ($this->database->diplomacyCheckLimits($this->session->alliance, $aType)) {
                                    $this->database->diplomacyInviteAdd($this->session->alliance, $allianceID, $aType);
                                    if ($aType == 1) {
                                        $notice = OFFERED_CONFED_TO;
                                    } else if ($aType == 2) {
                                        $notice = OFFERED_NON_AGGRESION_PACT_TO;
                                    } else if ($aType == 3) {
                                        $notice = DECLARED_WAR_ON;
                                    }
                                    $this->database->insertAlliNotice($this->session->alliance, '<a href="allianz.php?aid=' . $this->session->alliance . '">' . $this->database->getAllianceName($this->session->alliance) . '</a> ' . $notice . ' <a href="allianz.php?aid=' . $allianceID . '">' . $aName . '</a>.');
                                    $this->database->insertAlliNotice($allianceID, '<a href="allianz.php?aid=' . $this->session->alliance . '">' . $this->database->getAllianceName($this->session->alliance) . '</a> ' . $notice . ' <a href="allianz.php?aid=' . $allianceID . '">' . $aName . '</a>.');
                                    $this->form->addError("name", INVITE_SENT);
                                } else {
                                    $this->form->addError("name", ALLY_TOO_MUCH_PACTS);
                                }
                            } else {
                                $this->form->addError("name", INVITE_ALREADY_SENT);
                            }
                        } else {
                            $this->form->addError("name", WRONG_DIPLOMACY);
                        }
                    } else {
                        $this->form->addError("name", CANNOT_INVITE_SAME_ALLY);
                    }
                } else {
                    $this->form->addError("name", ALLY_DOESNT_EXISTS);
                }
            } else {
                $this->form->addError("name", NAME_OR_DIPL_EMPTY);
            }
        } else {
            $this->form->addError("name", NO_PERMISSION);
        }
    }
}
