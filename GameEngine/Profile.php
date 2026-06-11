<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Profile.php                                                 ##
##  Filename:      Account.php                                                 ##
##  Developed by:  Dzoki		                                               ##
##  Refactored by: Shadow (cata7007@gmail.com)								   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
##  Refactor notes (2026):                                                     ##
##  - Incremental optimization (no logic changes)                              ##
##  - Reduced repeated calls / minor optimizations                             ##
##  - Added lightweight per-request caching                                    ##
##  - Improved readability + structure                                         ##
##  - PHP 7+ compatible                                                        ##
#################################################################################

class Profile {

	/**
	 * Simple in-request cache (prevents duplicate DB calls inside same request)
	 */
	private static $cache = [
		'vac_check' => [],
		'villages'  => []
	];

	public function procProfile($post) {
		global $session;

		if (isset($post['ft'])) {
			switch ($post['ft']) {
				case "p1":
					$this->updateProfile($post);
					break;

				case "p2":
					$this->updatePreferences($post);
					break;

				case "p3":
					$this->updateAccount($post);
					break;

				case "p4":
					$this->setvactionmode($post);
					break;
			}
		}

		if (isset($post['s']) && $post['s'] == 4) {
			$this->gpack($post);
		}
	}

	/**
	 * Preferences form (ft=p2): persist all per-user preferences.
	 * Stores the checkbox prefs (auto-completion v1-v3, large map, report
	 * filter v4-v6), the time preference (timezone/tformat) and the game
	 * language. Columns match struct.sql + Session seeding. Some of these are
	 * stored only for now and applied in-game incrementally (issue #198).
	 */
	private function updatePreferences($post) {
		global $database, $session;

		// Checkbox preferences -> 0/1 (unchecked boxes are absent from POST).
		$v1  = empty($post['v1'])  ? 0 : 1;
		$v2  = empty($post['v2'])  ? 0 : 1;
		$v3  = empty($post['v3'])  ? 0 : 1;
		$map = empty($post['map']) ? 0 : 1;
		$v4  = empty($post['v4'])  ? 0 : 1;
		$v5  = empty($post['v5'])  ? 0 : 1;
		$v6  = empty($post['v6'])  ? 0 : 1;

		// Time preference: timezone index + date format (0..3).
		$timezone = isset($post['timezone']) ? (int)$post['timezone'] : 1;
		$tformat  = isset($post['tformat'])  ? (int)$post['tformat']  : 0;
		if ($tformat < 0 || $tformat > 3) {
			$tformat = 0;
		}

		$database->query(
			"UPDATE " . TB_PREFIX . "users SET " .
			"v1=$v1, v2=$v2, v3=$v3, map=$map, v4=$v4, v5=$v5, v6=$v6, " .
			"timezone=$timezone, tformat=$tformat " .
			"WHERE id=" . (int)$session->uid
		);

		// Invalidate the 30s session user-cache (see Session::PopulateVar) so the
		// reloaded page reflects the new values immediately, without a re-login.
		$cacheKeyUser = 'cache_user_' . ($_SESSION['username'] ?? '');
		unset($_SESSION[$cacheKeyUser]);

		// Game language.
		$allowed = ['en', 'fr', 'it', 'ro', 'zh'];
		if (!empty($post['lang'])) {
			$lang = strtolower(trim($post['lang']));
			if (in_array($lang, $allowed, true)) {
				$database->updateUserField($session->uid, "lang", $lang, 1);
				$_SESSION['lang'] = $lang;
				$session->userinfo['lang'] = $lang;
			}
		}

		header("Location: spieler.php?s=2");
		exit;
	}

	public function procSpecial($get) {
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

	/**
	 * Update player profile + village names
	 */
	private function updateProfile($post) {
    global $database, $session;

    $birthday = $post['jahr'] . '-' . $post['monat'] . '-' . $post['tag'];
    $birthday = preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $birthday) ? $birthday : '0';

    $mw   = (int)($post['mw'] ?? 0);
    $ort  = trim($post['ort'] ?? '');
    $be2  = trim($post['be2'] ?? ''); // descrierea stânga
    $be1  = trim($post['be1'] ?? ''); // descrierea dreapta

    $database->submitProfile($session->uid, $mw, $ort, $birthday, $be2, $be1);

    // Cache villages
    if (!isset(self::$cache['villages'][$session->uid])) {
        self::$cache['villages'][$session->uid] = $database->getProfileVillages($session->uid);
    }
    $varray = self::$cache['villages'][$session->uid];
    $cnt = count($varray);

    for ($i = 0; $i < $cnt; $i++) {
        if (!isset($post['dname' . $i])) continue;
        $newName = trim($post['dname' . $i]);
        if ($newName === '') continue;
        $database->setVillageName($varray[$i]['wref'], $newName);
    }

    header("Location: spieler.php?uid=" . $session->uid);
    exit;
}
	/**
	 * Gpack settings
	 */
	private function gpack($post) {
		global $database, $session;

		$database->gpack(
			$database->RemoveXSS($session->uid),
			$database->RemoveXSS($post['custom_url'])
		);

		header("Location: spieler.php?uid=" . $session->uid);
		exit;
	}

	/**
	 * Vacation mode activation
	 */
	private function setvactionmode($post) {
		global $database, $session;

		if (isset($post['vac']) && $post['vac'] && isset($post['vac_days']) && $post['vac_days'] >= 2 && $post['vac_days'] <= 14) {

			$uid = $session->uid;

			// Cache check per request (avoid duplicate heavy checks)
			if (!isset(self::$cache['vac_check'][$uid])) {
				self::$cache['vac_check'][$uid] = $database->checkVacationRequirements($uid);
			}

			$check = self::$cache['vac_check'][$uid];

			if ($check !== true) {

				$messages = [
					"TROOPS_MOVING"     => "You still have troops moving",
					"INCOMING_TROOPS"   => "You have incoming troops",
					"REINFORCEMENTS"    => "You have reinforcements on your villages",
					"WW"                => "You own a Wonder of the World",
					"ARTEFACTS"        => "You own artefacts",
					"PROTECTION"       => "You are still under beginner protection",
					"PRISONERS_IN"     => "No units trapped in your traps",
					"PRISONERS_OUT"    => "No units in enemy traps",
					"MARKET"           => "Marketplace transport active",
					"ACCOUNT_DELETION" => "Account is scheduled for deletion"
				];

				$output = "";

				foreach ($check as $err) {
					$output .= (isset($messages[$err]) ? $messages[$err] : $err) . "<br>";
				}

				$_SESSION['vac_error'] = $output;

				header("Location: spieler.php?s=5");
				exit;
			}

			// OK -> enter vacation mode
			unset($_SESSION['wid']);

			$database->setvacmode($uid, $post['vac_days']);
			$database->activeModify(addslashes($session->username), 1);
			$database->UpdateOnline("logout");

			$session->Logout();

			header("Location: login.php");
			exit;

		} else {
			$_SESSION['vac_error'] = "Vacation days must be between 2 and 14";
			header("Location: spieler.php?s=5");
			exit;
		}
	}

	/**
	 * Update account settings (password, email, sitter, deletion)
	 */
	private function updateAccount($post) {
		global $database, $session, $form;

		// Password change
		if (!empty($post['pw1']) && !empty($post['pw2']) && !empty($post['pw3'])) {

			if ($post['pw2'] == $post['pw3']) {

				if ($database->login($session->username, $post['pw1'])) {
					$database->updateUserField(
						$session->uid,
						"password",
						password_hash($post['pw2'], PASSWORD_BCRYPT, ['cost' => 12]),
						1
					);
				} else {
					$form->addError("pw", LOGIN_PW_ERROR);
				}

			} else {
				$form->addError("pw", PASS_MISMATCH);
			}
		}

		// Email change
		if (!empty($post['email_alt']) && !empty($post['email_neu'])) {

			if ($post['email_alt'] == $session->userinfo['email']) {
				$database->updateUserField($session->uid, "email", $post['email_neu'], 1);
			} else {
				$form->addError("email", EMAIL_ERROR);
			}
		}

		// Delete request cancel
		if (!empty($post['del_pw']) && !empty($post['del'])) {

			if (password_verify($post['del_pw'], $session->userinfo['password'])) {
				$database->setDeleting($session->uid, 0);
			} else {
				$form->addError("del", PASS_MISMATCH);
			}
		}

		// Sitter assignment
		if (!empty($post['v1'])) {

			$sitid = $database->getUserField($post['v1'], "id", 1);

			if ($sitid == $session->userinfo['sit1'] || $sitid == $session->userinfo['sit2']) {
				$form->addError("sit", SIT_ERROR);

			} else if ($sitid != $session->uid) {

				if ($session->userinfo['sit1'] == 0) {
					$database->updateUserField($session->uid, "sit1", $sitid, 1);

				} else if ($session->userinfo['sit2'] == 0) {
					$database->updateUserField($session->uid, "sit2", $sitid, 1);
				}
			}
		}

		// Persist errors if any
		if ($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
		}

		header("Location: spieler.php?s=3");
		exit;
	}

	/**
	 * Remove sitter
	 */
	private function removeSitter($get) {
		global $database, $session;

		if ($get['a'] == $session->checker) {

			if ($session->userinfo['sit' . $get['type']] == $get['id']) {
				$database->updateUserField($session->uid, "sit" . $get['type'], 0, 1);
			}

			$session->changeChecker();
		}

		header("Location: spieler.php?s=" . $get['s']);
		exit;
	}

	/**
	 * Cancel account deletion
	 */
	private function cancelDeleting($get) {
		global $database, $session;

		$database->setDeleting($session->uid, 1);

		header("Location: spieler.php?s=" . $get['s']);
		exit;
	}

	/**
	 * Remove me as sitter
	 */
	private function removeMeSit($get) {
		global $database, $session;

		if ($get['a'] == $session->checker) {
			$database->removeMeSit($get['id'], $session->uid);
			$session->changeChecker();
		}

		header("Location: spieler.php?s=" . $get['s']);
		exit;
	}
}

$profile = new Profile;
?>