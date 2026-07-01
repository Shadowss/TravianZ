<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Alliance.php                      	                       ##
##  Type           : Alliance System Backend                                   ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

use App\Entity\User;

global $autoprefix;

$autoloader_found = false;
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        $autoloader_found = true;
        include_once $autoprefix.'autoloader.php';
        break;
    }
}
if (!$autoloader_found) {
    die('Could not find autoloading class.');
}

class Alliance {

    public $gotInvite = false;
    public $inviteArray = [];
    public $allianceArray = [];
    public $userPermArray = [];
    
    public function procAlliance(array $get): void {
        global $session, $database;
		// ==================== SANITIZARE GET ====================
        $get['a'] = isset($get['a']) ? (int)$get['a'] : 0;
        $get['o'] = isset($get['o']) ? (int)$get['o'] : 0;
        $get['d'] = isset($get['d']) ? (int)$get['d'] : 0;
		 // ==================== ÎNCĂRCARE DATE ALIANȚĂ SAU INVITAȚII ====================
        if ($session->alliance > 0) {
			// Utilizatorul este membru al unei alianțe
            $this->allianceArray = $database->getAlliance($session->alliance);
			 // Permissions Array
            $this->userPermArray = $database->getAlliPermissions($session->uid, $session->alliance);
        } else {
			// Utilizatorul NU este într-o alianță → încarcă invitațiile primite
            $this->inviteArray = $database->getInvitation($session->uid);
            $this->gotInvite = count($this->inviteArray) > 0;
        }
		// ==================== PROCESARE ACȚIUNI DIN URL (GET) ====================
        if ($get['a'] > 0) {
            switch ($get['a']) {
                case 2: $this->rejectInvite($get); break;
                case 3: $this->acceptInvite($get); break;
            }
        }
        if ($get['o'] > 0) {
            switch ($get['o']) {
                case 4: $this->delInvite($get); break;
            }
        }
    }

    public function isForumAccessible(int $forumID): bool {
        global $session;
		 // Căutăm forumul în lista de forumuri partajate
        foreach ($session->sharedForums as $forums) {
            foreach ($forums as $forum) {
                if ($forum['id'] == $forumID) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function canAct(array $datas, int $mode = 0): bool {
        global $database, $session;
        $hasSwitchedToAdmin = isset($datas['admin']) && !empty($datas['admin']) && $datas['admin'] === "switch_admin";
		// ==================== CONDIȚII DE ACCES ====================
        $isAllianceOwner = $database->isAllianceOwner($session->uid) == $datas['alliance'];
        $hasForumPerm = $datas['forum_perm'] == 1 && $session->alliance == $datas['alliance'];
        $isForumOwner = $datas['owner'] == $session->uid && $session->access != ADMIN;
        $isGlobalAdmin = $session->access == ADMIN;
        $canActInAlliance = $datas['alliance'] > 0 && ($isAllianceOwner || $hasForumPerm);
        return (($canActInAlliance || $isForumOwner || $isGlobalAdmin)) && ($mode || $hasSwitchedToAdmin);
    }
        
    public function createForumVisiblity(array $alliancesID, array $alliancesName, array $usersID, array $usersName): array {
        global $database, $session;
        $visibleAlliances = [];
        $visibleUsers = [];
		// ==================== ALIANȚE VIZIBILE ====================
		// Procesăm atât ID-urile cât și numele (deduplicate automat prin array keys)
        if (!empty($alliancesID)) {
            foreach ($alliancesID as $alliance) {
                if ($this->isValidAllianceForForum($alliance, $session->alliance, $database)) {
                    $visibleAlliances[$alliance] = true;
                }
            }
        }
        if (!empty($alliancesName)) {
            foreach ($alliancesName as $allianceName) {
                $allianceID = $database->getAllianceID($allianceName);
                if ($this->isValidAllianceForForum($allianceID, $session->alliance, $database)) {
                    $visibleAlliances[$allianceID] = true;
                }
            }
        }
		// ==================== UTILIZATORI VIZIBILI ====================
        if (!empty($usersID)) {
            foreach ($usersID as $user) {
                if ($this->isValidUserForForum($user, $session->alliance, $session->uid, $database)) {
                    $visibleUsers[$user] = true;
                }
            }
        }
        if (!empty($usersName)) {
            foreach ($usersName as $username) {
                $userID = $database->getUserField($username, 'id', 1);
                if ($this->isValidUserForForum($userID, $session->alliance, $session->uid, $database)) {
                    $visibleUsers[$userID] = true;
                }
            }
        }
		// ==================== RETURN ====================
        return [
            'alliances' => implode(',', array_keys($visibleAlliances)),
            'users' => implode(',', array_keys($visibleUsers))
        ];
    }
	
	/**
	* Verifică dacă o alianță poate fi adăugată la vizibilitatea forumului
	*/

    private function isValidAllianceForForum($allianceID, $myAllianceID, $database): bool {
        if (empty($allianceID) || !is_numeric($allianceID)) return false;
        if (!$database->aExist($allianceID, 'id')) return false;
        if ($allianceID == $myAllianceID) return false;
        return empty($database->diplomacyExistingRelationships($allianceID));
    }

	/**
	* Verifică dacă un utilizator poate fi adăugat la vizibilitatea forumului
	*/

    private function isValidUserForForum($userID, $myAllianceID, $myUserID, $database): bool {
        if (empty($userID) || !is_numeric($userID)) return false;
        $userAlliance = $database->getUserAllianceID($userID);
        $username = $database->getUserField($userID, 'username', 0);
        return (
            $userAlliance > 0 &&
            $userAlliance != $myAllianceID &&
            $username !== "[?]" &&
            $userID != $myUserID &&
            empty($database->diplomacyExistingRelationships($userAlliance))
        );
    }
	
	/**
	* Redirecționează către pagina de selecție forum (allianz.php?s=2)
	*
	* Construiește URL-ul cu parametrii opționali fid și switch_admin,
	* respectând exact condițiile din codul original.
	*
	* @param array|null $get Datele din cererea GET (poate fi null)
	*/
        
    public function redirect(?array $get = null): void {
        $get = $get ?? [];
        $url = "allianz.php?s=2";
        if (isset($get['fid']) && !empty($get['fid']) && ($get['admin'] ?? '') !== 'pos') {
            $url .= "&fid=" . $get['fid'];
        }
        if (isset($get['admin']) && !empty($get['admin'])) {
            $url .= "&admin=switch_admin";
        }
        header("Location: " . $url);
        exit;
    }
	
	/*****************************************
	Function to process of sending Forms
	*****************************************/
        
    public function procAlliForm(array $post): void {
		// ==================== TIP FORMULAR (ft) ====================
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "ali1": $this->createAlliance($post); break;
            }
        }
		// ==================== SCHIMBARE DIPLOMAȚIE ====================
        if (isset($post['dipl']) && isset($post['a_name'])) {
            $this->changediplomacy($post);
        }
		// ==================== ACȚIUNI GENERALE (s + o) ====================
        if (isset($post['s']) && isset($post['o'])) {
            switch ($post['o']) {
                case 1:  // Schimbare permisiuni utilizator
                    if (isset($post['a'])) $this->changeUserPermissions($post);
                    break;
                case 2:  // Kick utilizator din alianță
                    if (isset($post['a_user'])) $this->kickAlliUser($post);
                    break;
                case 4: // Trimitere invitație
                    if (isset($post['a']) && $post['a'] == 4) $this->sendInvite($post);
                    break;
                case 3: // Actualizare profil alianță
					$this->updateAlliProfile($post); 
					break;
                case 11: // Părăsire alianță
				$this->quitally($post); 
					break;
                case 100: // Schimbare nume alianță
				$this->changeAliName($post); 
					break;
            }
        }
    }
	
	/*****************************************
	Function to process of sending invitations
	*****************************************/

    public function sendInvite(array $post): void {
        global $form, $database, $session;
		// ==================== DATE DE INTRARE ====================
        $invitedUsername = stripslashes($post['a_name'] ?? '');
		// Obținem datele utilizatorului invitat (comportament exact ca în original)
        $UserData = $database->getUserArray($invitedUsername, 0);
		 // ==================== VERIFICĂRI DE PERMISIUNI ȘI VALIDĂRI ====================
        if ($this->userPermArray['opt4'] == 0) {
            $form->addError("name", NO_PERMISSION);
        } elseif (!isset($post['a_name']) || $post['a_name'] === '') {
            $form->addError("name", NAME_EMPTY);
        } elseif (!User::exists($database, $post['a_name'])) {
            $form->addError("name", NAME_NO_EXIST . stripslashes(stripslashes($post['a_name'])));
        } elseif ($UserData['id'] == $session->uid) {
            $form->addError("name", SAME_NAME);
        } elseif ($database->getInvitation2($UserData['id'], $session->alliance)) {
            $form->addError("name", $post['a_name'] . ALREADY_INVITED);
        } elseif ($UserData['alliance'] == $session->alliance) {
            $form->addError("name", $post['a_name'] . ALREADY_IN_ALLY);
        } elseif ($UserData['alliance'] > 0) {
            $form->addError("name", $post['a_name'] . ALREADY_IN_AN_ALLY);
        } else {
		// ==================== TOATE VERIFICĂRILE AU TRECUT → TRIMITE INVITAȚIA ====================
            $aid = $session->alliance;
			// Inserăm invitația în baza de date
            $database->sendInvitation($UserData['id'], $aid, $session->uid);
			// Log notice în alianță
            $database->insertAlliNotice(
                $session->alliance,
                rc_tok(
                    'MSG_INVITE_NOTICE',
                    '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>',
                    '<a href="spieler.php?uid=' . $UserData['id'] . '">' . addslashes($UserData['username']) . '</a>'
                )
            );
			// Trimite invitație și prin mesaj în joc (dacă este activată funcționalitatea nouă)
            if (NEW_FUNCTIONS_ALLIANCE_INVITATION) {
                $messageBody = rc_tok('MSG_INVITE_BODY', $UserData['username']);
                $database->sendMessage($UserData['id'], 4, rc_tok('MSG_INVITE_ALLIANCE'), $database->escape($messageBody), 0, 0, 0, 0, 0, true);
            }
        }
    }
	
	/*****************************************
	Function to reject an invitation
	*****************************************/

    private function rejectInvite(array $get): void {
        global $database, $session;
        $inviteID = $get['d'] ?? 0;
		// ==================== CĂUTARE ȘI RESPINGERE INVITAȚIE ====================
        foreach ($this->inviteArray as $invite) {
            if ($invite['id'] == $inviteID && $invite['uid'] == $session->uid) {
				// Ștergem invitația din baza de date
                $database->removeInvitation($inviteID);
				// Adăugăm notice în logul alianței
                $notice = rc_tok('MSG_NEWS_REJECTED', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>');
                $database->insertAlliNotice($invite['alliance'], $notice);
                break; // am găsit și procesat invitația → nu mai continuăm bucla
            }
        }
		// ==================== REDIRECȚIONARE ====================
		// (întotdeauna se face redirect, chiar dacă invitația nu a fost găsită)
        header("Location: build.php?gid=18");
        exit;
    }
	
	/*****************************************
	Function to del an invitation
	*****************************************/
	
    private function delInvite(array $get): void {
        global $database, $session;
        $inviteID = $get['d'] ?? 0;
		// Încărcăm lista de invitații trimise de alianța curentă
        $inviteArray = $database->getAliInvitations($session->alliance);
		// ==================== CĂUTARE ȘI ȘTERGERE INVITAȚIE ====================
        foreach ($inviteArray as $invite) {
            if ($invite['id'] == $inviteID && $invite['alliance'] == $session->alliance && $this->userPermArray['opt4'] == 1) {
				// Obținem numele utilizatorului invitat
                $invitename = $database->getUserArray($invite['uid'], 1);
				// Ștergem invitația
                $database->removeInvitation($inviteID);
				// Adăugăm notice în logul alianței
                $notice = rc_tok('MSG_NEWS_DELETED_INVITE', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>', '<a href="spieler.php?uid=' . $invitename['id'] . '">' . addslashes($invitename['username']) . '</a>');
                $database->insertAlliNotice($session->alliance, $notice);
                break; // am procesat invitația → ieșim din buclă
            }
        }
		// ==================== REDIRECȚIONARE ====================
		// (întotdeauna se face redirect, chiar dacă invitația nu a fost găsită)
        header("Location: allianz.php?delinvite");
        exit;
    }
	
	/*****************************************
	Function to accept an invitation
	*****************************************/

    private function acceptInvite(array $get): void {
        global $form, $database, $session;
        $inviteID = $get['d'] ?? 0;
        $acceptError = false;
        $maxMembers = 0;
		// ==================== PROCESARE INVITAȚII ====================
        foreach ($this->inviteArray as $invite) {
            if ($session->alliance == 0 && $invite['id'] == $inviteID && $invite['uid'] == $session->uid) {
                $memberlist = $database->getAllMember($invite['alliance']);
                $alliance_info = $database->getAlliance($invite['alliance']);
                if (count($memberlist) < $alliance_info['max']) {
					// Acceptăm invitația
                    $database->removeInvitation($inviteID);
                    $database->updateUserField($invite['uid'], "alliance", $invite['alliance'], 1);
                    $database->createAlliPermissions($invite['uid'], $invite['alliance'], '', 0, 0, 0, 0, 0, 0, 0, 0);
                    // Invalidate the 30s session user-cache (see Session::PopulateVar) so the
                    // new alliance membership shows up immediately, without a re-login.
                    unset($_SESSION['cache_user_' . $session->username]);
                    $_SESSION['alliance_user'] = $invite['alliance'];
					// Log notice în alianță
                    $notice = rc_tok('MSG_NEWS_JOINED', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>');
                    $database->insertAlliNotice($invite['alliance'], $notice);
                } else {
					// Alianța este plină
                    $acceptError = true;
                    $maxMembers = $alliance_info['max'];
                }
                break;
            }
        }
		 // ==================== REZULTAT FINAL ====================
        if ($acceptError) {
            $form->addError("ally_accept", "The alliance can contain only " . $maxMembers . " members at this moment.");
        } else {
            header("Location: build.php?gid=18");
            exit;
        }
    }


	/*****************************************
	Function to create an alliance
	*****************************************/

    private function createAlliance(array $post): void {
        global $form, $database, $session, $bid18, $building;
        $tag = $post['ally1'] ?? '';
        $name = $post['ally2'] ?? '';
		// ==================== VALIDĂRI ====================
        if ($tag === '') $form->addError("ally1", ATAG_EMPTY);
        if ($name === '') $form->addError("ally2", ANAME_EMPTY);
        if ($database->aExist($tag, "tag")) $form->addError("ally1", ATAG_EXIST);
        if ($database->aExist($name, "name")) $form->addError("ally2", ANAME_EXIST);
        if ($session->alliance != 0) $form->addError("ally3", ALREADY_ALLY_MEMBER);
        if ($building->getTypeLevel(18) < 3) $form->addError("ally4", ALLY_TOO_LOW);
        if ($form->returnErrors() != 0) {
			// ==================== ERORI ? ================
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $post;
			// Redirect în funcție de existența ambasadei (comportament original)
            header("Location: " . ($building->getTypeLevel(18) > 0 ? "build.php?gid=18" : "dorf2.php"));
            exit;
        }
        $maxMembers = $bid18[$building->getTypeLevel(18)]['attri'];
        $aid = $database->createAlliance($tag, $name, $session->uid, $maxMembers);
		
		// Milestone: first alliance ever founded on the server.
        if (defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES) {
            $database->recordMilestoneIfFirst('first_alliance', $session->uid, 0, $tag . ' - ' . $name);
        }
		
        $database->updateUserField($session->uid, "alliance", $aid, 1);
        $database->procAllyPop($aid);
        $database->createAlliPermissions($session->uid, $aid, 'Alliance founder', '1', '1', '1', '1', '1', '1', '1', '1');
        // Invalidate the 30s session user-cache (see Session::PopulateVar) so the
        // new alliance shows up immediately, without a re-login.
        unset($_SESSION['cache_user_' . $session->username]);
        $_SESSION['alliance_user'] = $aid;
        $notice = rc_tok('MSG_ALLIANCE_FOUNDED', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>');
        $database->insertAlliNotice($aid, $notice);
        header("Location: build.php?gid=18");
        exit;
    }
	
	/*****************************************
	Function to change the alliance name
	*****************************************/

    private function changeAliName(array $get): void {
        global $form, $database, $session;
        $newTag = $get['ally1'] ?? '';
        $newName = $get['ally2'] ?? '';
        $userAlly = $database->getAlliance($session->alliance);
		// ==================== VALIDĂRI ====================
        if ($newTag === '') $form->addError("ally1", ATAG_EMPTY);
        if ($newName === '') $form->addError("ally2", ANAME_EMPTY);
        if ($newTag !== $userAlly['tag'] && $database->aExist($newTag, "tag")) $form->addError("ally1", ATAG_EXIST);
        if ($newName !== $userAlly['name'] && $database->aExist($newName, "name")) $form->addError("ally2", ANAME_EXIST);
        if ($this->userPermArray['opt3'] == 0) $form->addError("perm", NO_PERMISSION);
		// ==================== ERORI ? ====================
        if ($form->returnErrors() == 0) {
            $database->setAlliName($session->alliance, $newName, $newTag);
            $notice = rc_tok('MSG_NEWS_NAME_CHANGED', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>');
            $database->insertAlliNotice($session->alliance, $notice);
            $form->addError("perm", NAME_OR_TAG_CHANGED);
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $get;
            header("Location: allianz.php?s=5");
            exit;
        }
    }
	
	/*****************************************
	Function to create/change the alliance description
	*****************************************/

    private function updateAlliProfile(array $post): void {
        global $database, $session, $form;
		// ==================== VERIFICARE PERMISIUNI ====================
        if ($this->userPermArray['opt3'] == 0) $form->addError("perm", NO_PERMISSION);
		// ==================== REZULTAT ====================
        if ($form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $post;
        } else {
			// ==================== ACTUALIZARE PROFIL ====================
            $database->submitAlliProfile($session->alliance, $post['be2'] ?? '', $post['be1'] ?? '');
			// Log notice în alianță
            $notice = rc_tok('MSG_NEWS_DESC_CHANGED', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>');
            $database->insertAlliNotice($session->alliance, $notice);
        }
    }

    /*****************************************
    Function to change the user permissions
    MODIFICAT - permite liderului sa-si editeze rank-ul
    *****************************************/
    private function changeUserPermissions(array $post): void {
        global $database, $session, $form;

        $targetUID = (int)($post['a_user'] ?? 0);
        $rankTitle = $post['a_titel'] ?? '';
		// ==================== VERIFICĂRI DE PERMISIUNI ȘI VALIDĂRI ====================
        $isLeader = $database->isAllianceOwner($session->uid) == $session->alliance;
        $isSelf = ($targetUID == $session->uid);
        $isTargetLeader = $database->isAllianceOwner($targetUID) == $session->alliance;

        if ($this->userPermArray['opt1'] == 0) {
            $form->addError("perm", NO_PERMISSION);
        } elseif ($database->getUserField($targetUID, "alliance", 0) != $session->alliance) {
            $form->addError("perm", USER_NOT_IN_YOUR_ALLY);
        } elseif ($isSelf && !$isLeader) {
            $form->addError("perm", CANT_EDIT_YOUR_PERMISSIONS);
        } elseif ($isTargetLeader && !$isSelf) {
            $form->addError("perm", CANT_EDIT_LEADER_PERMISSIONS);
        } else {
			// ==================== NORMALIZARE CHECKBOX-URI ====================
            if ($isLeader && $isSelf) {
                $opt1 = $opt2 = $opt3 = $opt4 = $opt5 = $opt6 = $opt7 = 1;
            } else {
                $opt1 = isset($post['e1']) ? 1 : 0;
                $opt2 = isset($post['e2']) ? 1 : 0;
                $opt3 = isset($post['e3']) ? 1 : 0;
                $opt4 = isset($post['e4']) ? 1 : 0;
                $opt5 = isset($post['e5']) ? 1 : 0;
                $opt6 = isset($post['e6']) ? 1 : 0;
                $opt7 = isset($post['e7']) ? 1 : 0;
            }
			// Actualizăm permisiunile în baza de date
            $ok = $database->updateAlliPermissions($targetUID, (int)$session->alliance, $rankTitle, $opt1, $opt2, $opt3, $opt4, $opt5, $opt6, $opt7);
            if (!$ok) {
                $form->addError("perm", "DB UPDATE FAILED");
            } else {
				// Log notice în alianță
                $username = $database->getUserField($targetUID, "username", 0);
                $notice = rc_tok('MSG_NEWS_PERMS_CHANGED', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>', addslashes($username));
                $database->insertAlliNotice($session->alliance, $notice);
				// Mesaj de succes (comportament original)
                $_SESSION['success'] = ALLY_PERMISSIONS_UPDATED;
            }
        }
		 // ==================== REDIRECȚIONARE LA ERORI ====================
        if ($form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $post;
            header("Location: allianz.php?s=5");
            exit;
        }
    }
	
	/*****************************************
	Function to kick a user from alliance
	REFACTORIZAT 14.05.2026 - blochează kick la fondator
	*****************************************/

    private function kickAlliUser(array $post): void {
        global $database, $session, $form;
        $targetUID = (int)($post['a_user'] ?? 0);
        $UserData = $database->getUserArray($targetUID, 1);
        $allyId = (int)$session->alliance;
		// ==================== VERIFICĂRI ====================
        if ($this->userPermArray['opt2'] == 0) {
            $form->addError("perm", NO_PERMISSION); return;
        }
        if ($database->getUserField($targetUID, "alliance", 0) != $allyId) {
            $form->addError("perm", USER_NOT_IN_YOUR_ALLY); return;
        }
        if ($UserData['id'] == $session->uid) {
            $form->addError("perm", CANT_EDIT_YOUR_PERMISSIONS); return;
        }
        if ($database->isAllianceOwner($targetUID) == $allyId) {
            $form->addError("perm", CANT_REMOVE_LEADER); return;
        }
		 // ==================== EXECUTARE KICK ====================
        $kickedUsername = $UserData['username'];
        $database->evictUserFromAlliance($targetUID);
        $database->deleteAlliPermissions($targetUID);
        $notice = rc_tok('MSG_NEWS_EXPELLED', '<a href="spieler.php?uid=' . $UserData['id'] . '">' . addslashes($kickedUsername) . '</a>', '<a href="spieler.php?uid=' . $session->uid . '">' . addslashes($session->username) . '</a>');
        $database->insertAlliNotice($allyId, $notice);
        $database->deleteAlliance($allyId);
        $form->addError("perm", $kickedUsername . ALLY_USER_KICKED);
    }
	
	/*****************************************
	Function to set forum link
	*****************************************/
        
    public function setForumLink(array $post): void {
        global $database, $session, $form;
        if ($this->userPermArray['opt5'] == 0) {
            $form->addError("perm", NO_PERMISSION);
        } else {
            $database->setAlliForumdblink($session->alliance, $post['f_link'] ?? '');
            $form->addError("perm", ALLY_FORUM_LINK_UPDATED);
        }
    }
        
    public function Vote(array $post): void {
        global $database, $session;
        $surveyID = (int)($post['tid'] ?? 0);
        $voteOption = (int)($post['vote'] ?? 0);
        $fid2 = (int)($post['fid2'] ?? 0);
        if ($database->checkSurvey($surveyID) && !$database->checkVote($surveyID, $session->uid)) {
            $survey = $database->getSurvey($surveyID);
            $votedText = $survey['voted'] . ',' . $session->uid . ',';
            $database->Vote($surveyID, $voteOption, $votedText);
        }
        header("Location: allianz.php?s=2&fid2=" . $fid2 . "&tid=" . $surveyID);
        exit;
    }
       
	/*****************************************
	Function to quit from alliance
	REFACTORIZAT 14.05.2026 - folosește Database v7
	*****************************************/   
	
    private function quitally(array $post): void {
        global $database, $session, $form;
		// ==================== VERIFICARE PAROLĂ ====================
        if (!isset($post['pw']) || $post['pw'] === '') { $form->addError("pw", PW_EMPTY); return; }
        if (!password_verify($post['pw'], $session->userinfo['password'])) { $form->addError("pw", LOGIN_PW_ERROR); return; }
		 // Parola corectă → continuăm
        $allyId = (int)$session->alliance;
        $uid = (int)$session->uid;
        $isFounder = $allyId && $database->isAllianceOwner($uid) == $allyId;
        $memberCount = $database->countAllianceMembers($allyId);
		// ==================== CAZ SPECIAL: LIDERUL PLEACĂ ====================
        if ($isFounder && $memberCount > 1) {
            if (empty($post['new_founder'])) { $form->addError("founder", FOUNDER_LEAVE_NEW); return; }
            $newFounderID = (int)$post['new_founder'];
            $members = $database->getAllMember($allyId);
            $valid = false;
            foreach ($members as $m) {
                if ($m['id'] == $newFounderID && $newFounderID != $uid) { $valid = true; $newFounderName = $m['username']; break; }
            }
            if (!$valid) { $form->addError("founder", FOUNDER_LEAVE_INVALID); return; }
            // Mesaj specific pentru quit voluntar
			$messageBody = rc_tok('MSG_QUIT_REPLACEMENT_BODY', "<a href=\"" . rtrim(SERVER, '/') . "/spieler.php?uid=" . $uid . "\">" . $database->escape($session->username) . "</a>");
            // Folosim metoda centralizată cu mesaj custom
			$database->promoteNewAllianceLeader($allyId, $newFounderID, $uid, $newFounderName, ['username' => $session->username, 'id' => $uid], $messageBody);
            $_SESSION['alliance_user'] = 0;
        }
		// ==================== PĂRĂSIRE ALIANȚĂ ====================
        $database->updateUserField($uid, 'alliance', 0, 1);
        $database->deleteAlliPermissions($uid);
		// șterge alianța dacă e goală (comportament original)
        $database->deleteAlliance($allyId);
        // Invalidate the 30s session user-cache (see Session::PopulateVar) so the
        // alliance the player just left disappears immediately, without a re-login.
        unset($_SESSION['cache_user_' . $session->username]);
        $_SESSION['alliance_user'] = 0;
        $notice = rc_tok('MSG_NEWS_QUIT', '<a href="spieler.php?uid=' . $uid . '">' . addslashes($session->username) . '</a>');
        $database->insertAlliNotice($allyId, $notice);
        header("Location: spieler.php?uid=" . $uid);
        exit;
    }
	
	/*****************************************
	Function for change diplomacy
	*****************************************/

    private function changediplomacy(array $post): void {
        global $database, $session, $form;
        if ($this->userPermArray['opt6'] == 0) { $form->addError("name", NO_PERMISSION); return; }
        $targetAllianceName = $post['a_name'] ?? '';
        $diplType = (int)($post['dipl'] ?? 0);
        if (empty($targetAllianceName) || $diplType === 0) { $form->addError("name", NAME_OR_DIPL_EMPTY); return; }
        if (!$database->aExist($targetAllianceName, "tag")) { $form->addError("name", ALLY_DOESNT_EXISTS); return; }
        $targetAllianceID = $database->getAllianceID($targetAllianceName);
        if ($targetAllianceID == $session->alliance) { $form->addError("name", CANNOT_INVITE_SAME_ALLY); return; }
        if ($diplType < 1 || $diplType > 3) { $form->addError("name", WRONG_DIPLOMACY); return; }
        if ($database->diplomacyInviteCheck2($session->alliance, $targetAllianceID)) { $form->addError("name", INVITE_ALREADY_SENT); return; }
        if (!$database->diplomacyCheckLimits($session->alliance, $diplType)) { $form->addError("name", ALLY_TOO_MUCH_PACTS); return; }

        $database->diplomacyInviteAdd($session->alliance, $targetAllianceID, $diplType);
        if ($diplType == 1) $diploKey = 'MSG_NEWS_DIPLO_CONFED';
        elseif ($diplType == 2) $diploKey = 'MSG_NEWS_DIPLO_NAP';
        elseif ($diplType == 3) $diploKey = 'MSG_NEWS_DIPLO_WAR';
        else $diploKey = '';
        $myAllianceName = $database->getAllianceName($session->alliance);
        $notice = ($diploKey === '') ? '' : rc_tok($diploKey, '<a href="allianz.php?aid=' . $session->alliance . '">' . $myAllianceName . '</a>', '<a href="allianz.php?aid=' . $targetAllianceID . '">' . $targetAllianceName . '</a>');
        $database->insertAlliNotice($session->alliance, $notice);
        $database->insertAlliNotice($targetAllianceID, $notice);
        $form->addError("name", INVITE_SENT);
    }
}

$alliance = new Alliance;
?>