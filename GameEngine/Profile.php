<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Profile.php                      	                       ##
##  Type           : Profile System Backend                                    ##
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

class Profile {

	/**
	 * Simple in-request cache (prevents duplicate DB calls inside same request)
	 */
	private static $cache = [
		'vac_check' => [],
		'villages'  => []
	];

	/**
	 * Sesiunea curenta e a unui sitter?
	 * Verificat defensiv, ca Profile.php sa mearga si daca ajunge intr-un
	 * context unde $session inca nu e initializat.
	 */
	private function isSitter() {
		global $session;

		return isset($session) && is_object($session)
			&& method_exists($session, 'isSitterSession')
			&& $session->isSitterSession();
	}

	public function procProfile($post) {
		global $session;

		/**
		 * RESTRICTIE SITTER - al doilea nivel, cel care conteaza.
		 *
		 * spieler.php blocheaza deja accesul la taburi, dar aceasta metoda e
		 * punctul unic prin care trec TOATE formularele de profil (p1..p5:
		 * descriere, preferinte, cont, parola, vacanta). Un sitter putea
		 * trimite POST-ul direct catre spieler.php, fara sa deschida tabul.
		 *
		 * Aici se opreste definitiv: un sitter nu modifica setarile
		 * proprietarului, indiferent pe unde intra.
		 */
		if ($this->isSitter()) {
			return;
		}

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
		//
		// Lista NU mai e scrisa de mana: se accepta orice limba care are fisier
		// in GameEngine/Lang/. Inainte, adaugarea unei limbi noi cerea si o
		// modificare aici, altfel alegerea jucatorului era respinsa in tacere -
		// exact ce s-a intamplat cu spaniola.
		//
		// Tiparul e acelasi cu cel din panou (editServerSet): doua litere mici
		// si fisierul sa existe. Verificarea pe nume opreste orice incercare de
		// a iesi din folder.
		if (!empty($post['lang'])) {
			$lang = strtolower(trim($post['lang']));

			if (preg_match('/^[a-z]{2}$/', $lang)
				&& is_file(__DIR__ . '/Lang/' . $lang . '.php')) {
				$database->updateUserField($session->uid, "lang", $lang, 1);
				$_SESSION['lang'] = $lang;
				$session->userinfo['lang'] = $lang;
			}
		}

		// Direct links table (add / update / delete the player's custom links).
		$this->updateLinks($post);

		header("Location: spieler.php?s=2");
		exit;
	}

	/**
	 * Direct links (ft=p2): add / update / delete the player's custom menu
	 * links from the preferences form. This logic used to live in
	 * Templates/Profile/preference.tpl, but since procProfile() now intercepts
	 * the ft=p2 POST and exits, the template was never reached and links could
	 * no longer be saved (issue #204). Mirrors the form's nr / id / linkname /
	 * linkziel row fields.
	 */
	private function updateLinks($post) {
		global $database, $session;

    $uid   = (int)$session->uid;
    $links = [];

    // Group the row fields (nr0, id0, linkname0, linkziel0, ...) by index.
    foreach ($post as $key => $value) {
        if (!is_string($value)) {
            continue;
        }
        $value = trim($value);

        if (strpos($key, 'linkname') === 0) {
            $links[substr($key, 8)]['name'] = $value;
        } elseif (strpos($key, 'linkziel') === 0) {
            $links[substr($key, 8)]['url'] = $value;
        } elseif (strpos($key, 'nr') === 0) {
            $links[substr($key, 2)]['nr'] = (int)$value;
        } elseif (strpos($key, 'id') === 0) {
            $links[substr($key, 2)]['id'] = (int)$value;
        }
    }

    foreach ($links as $link) {
        $nr = isset($link['nr']) ? (int)$link['nr'] : 0;
        $id = isset($link['id']) ? (int)$link['id'] : 0;

        // --- REMOVE XSS ---
        $name_raw = trim($link['name'] ?? '');
        $url_raw  = trim($link['url'] ?? '');

        // Bug fix: RemoveXSS() calls htmlspecialchars() (&,<,>,",' -> entities).
        // Every display site for these values ALREADY escapes correctly on output
        // (links.tpl's safeHTML(), and preference.tpl's edit-row value=""), so
        // encoding here too meant a saved "&" was stored as literal "&amp;" text
        // in the DB, then got escaped AGAIN on redisplay — surviving one level of
        // browser entity-decoding as visible "&amp;". Worse, it silently broke
        // any saved link with a real query parameter after the first one (e.g.
        // build.php?gid=16&t=99): the stored value no longer had a real "&"
        // separator there, so "t" was never received as its own GET param.
        // strip_tags() (for name) + mysqli_real_escape_string() (below, for SQL)
        // are sufficient at save time; HTML-escaping belongs only at display time.

        // name : without HTML, maximum 30 characters (as in the game)
        $name = mb_substr(strip_tags($name_raw), 0, 30);

        // url: accepts only http/https, max 120 characters
        $url = '';
        if ($url_raw !== '' && preg_match('#^https?://#i', $url_raw)) {
            $url = mb_substr($url_raw, 0, 120);
        }

        // SQL: escape for SQL (keeping the current TravianZ style used in TravianZ)
        $name_sql = mysqli_real_escape_string($database->dblink, $name);
        $url_sql  = mysqli_real_escape_string($database->dblink, $url);

        if ($nr !== 0 && $name !== '' && $url !== '' && $id === 0) {
            // New link.
            mysqli_query(
                $database->dblink,
                "INSERT INTO `" . TB_PREFIX . "links` (`userid`, `name`, `url`, `pos`) " .
                "VALUES ($uid, '$name_sql', '$url_sql', $nr)"
            );
        } elseif ($nr !== 0 && $name !== '' && $url !== '' && $id > 0) {
            // Update existing link (ownership enforced in the WHERE clause).
            mysqli_query(
                $database->dblink,
                "UPDATE `" . TB_PREFIX . "links` SET `name`='$name_sql', `url`='$url_sql', `pos`=$nr " .
                "WHERE `id`=$id AND `userid`=$uid"
            );
        } elseif ($nr === 0 && $name === '' && $url === '' && $id > 0) {
            // Emptied row -> delete (ownership enforced in the WHERE clause).
            mysqli_query(
                $database->dblink,
                "DELETE FROM `" . TB_PREFIX . "links` WHERE `id`=$id AND `userid`=$uid"
            );
			}
		}
	}

	public function procSpecial($get) {

		/**
		 * Aceleasi motive ca la procProfile(). Actiunile de aici sunt chiar mai
		 * sensibile, fiindca se declanseaza prin simplu GET:
		 *   e=2 removeMeSit    - se scoate ca sitter de pe un cont
		 *   e=3 removeSitter   - sterge un sitter al proprietarului (deci un
		 *                        sitter l-ar fi putut elimina pe celalalt, sau
		 *                        pe sine, ca sa scape de urme)
		 *   e=4 cancelDeleting - anuleaza stergerea contului proprietarului
		 * Niciuna nu are ce cauta intr-o sesiune de sitter.
		 */
		if ($this->isSitter()) {
			return;
		}

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
	// BUG-3: store the location/descriptions raw. submitProfile() uses a prepared
	// statement (SQL-safe) and every display site escapes with htmlspecialchars()
	// before rendering BBCode, so RemoveXSS() here only double-escaped the data
	// (baked-in backslashes from its SQL escape + literal &quot; entities).
	$ort = trim($post['ort'] ?? '');
	$be1 = trim($post['be1'] ?? ''); // right description
	$be2 = trim($post['be2'] ?? ''); // left description

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

        /**
         * FIX SECURITATE (XSS stocat): numele satului nu era validat deloc.
         * Un jucator putea sa-si numeasca satul "<script>...</script>", iar
         * numele se afiseaza in rapoarte de lupta, pe harta si in listele de
         * sate - deci codul se executa in browserul altor jucatori.
         *
         * Permise: litere, cifre, punct, liniuta, underscore, paranteze
         * rotunde si drepte, plus spatii simple intre grupuri.
         *
         * Parantezele sunt sigure aici: nu au niciun inteles in HTML, iar
         * numele satelor nu trec prin BBCode (acesta se aplica doar pe
         * descrierile de profil si pe forum), deci un sat numit "[b]x[/b]"
         * se afiseaza ca atare, nu ingrosat. Raman excluse < > & " ',
         * adica exact caracterele care ar putea sparge HTML-ul.
         */
        if (function_exists('mb_strlen')) {
            if (mb_strlen($newName, 'UTF-8') > 25) {
                $newName = mb_substr($newName, 0, 25, 'UTF-8');
            }
        } elseif (strlen($newName) > 25) {
            $newName = substr($newName, 0, 25);
        }

        if (!preg_match('/^[\p{L}\p{N}._\-\[\]()]+(?: [\p{L}\p{N}._\-\[\]()]+)*$/u', $newName)) {
            continue;   // nume respins, satul isi pastreaza numele vechi
        }

        $database->setVillageName($varray[$i]['wref'], $newName);
    }

    // Invalidate the 30s session user-cache (see Session::PopulateVar) so the
    // saved description/birthday/etc. show up immediately on the edit form and
    // header, without waiting for the cache to expire (issue #250).
    unset($_SESSION['cache_user_' . ($_SESSION['username'] ?? '')]);

    header("Location: spieler.php?uid=" . $session->uid);
    exit;
}
	/**
	 * Gpack settings
	 */
	private function gpack($post) {
		global $database, $session;

		$chosen = trim((string) $post['custom_url']);

		// Acceptam doar pachete locale reale: "gpack/<nume>/" cu travian.css pe
		// disc. Fara verificare, o cale gresita (sau trimisa manual) ar lasa
		// jucatorul cu o pagina fara stiluri, din care nu mai poate reveni.
		$isLocalPack = (bool) preg_match('#^gpack/[A-Za-z0-9_\-]+/$#', $chosen)
			&& is_file(__DIR__ . '/../' . $chosen . 'travian.css');

		// Sirul gol inseamna "inapoi la pachetul serverului" si e mereu permis.
		if ($chosen !== '' && !$isLocalPack) {
			header("Location: spieler.php?s=4");
			exit;
		}

		$database->gpack(
			$database->RemoveXSS($session->uid),
			$database->RemoveXSS($chosen)
		);

		// Sesiunea trebuie sa reflecte imediat alegerea: config.php citeste de
		// acolo, iar fara asta pachetul nou s-ar aplica abia dupa o relogare.
		$_SESSION['gpack'] = $chosen;

		// Invalidate the 30s session user-cache (see Session::PopulateVar) so the
		// new graphics pack applies immediately, without a re-login.
		unset($_SESSION['cache_user_' . ($_SESSION['username'] ?? '')]);

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

		/**
		 * Transforma un set de casute bifate intr-o masca de biti.
		 *
		 * Acceptam doar valorile din SITTER_PERM_ALL: orice altceva venit prin
		 * POST e ignorat, ca un jucator sa nu-si poata inventa biti noi.
		 * Un array gol inseamna "niciun drept" - stare perfect valida, deci NU
		 * cadem pe SITTER_PERM_ALL cand lipseste continutul.
		 */
		$sitterMaskFromPost = function ($raw) {

			$mask = 0;

			if (is_array($raw)) {
				foreach ($raw as $bit) {
					$bit = (int) $bit;

					if ($bit > 0 && ($bit & SITTER_PERM_ALL) === $bit) {
						$mask |= $bit;
					}
				}
			}

			return $mask;
		};

		// Sitter assignment
		if (!empty($post['v1'])) {

			$sitid = $database->getUserField($post['v1'], "id", 1);

			if ($sitid == $session->userinfo['sit1'] || $sitid == $session->userinfo['sit2']) {
				$form->addError("sit", SIT_ERROR);

			} else if ($sitid != $session->uid) {

				// permisiunile cu care intra noul sitter
				$newPerm = $sitterMaskFromPost($post['perm_new'] ?? null);

				if ($session->userinfo['sit1'] == 0) {
					$database->updateUserField($session->uid, "sit1", $sitid, 1);
					$database->updateUserField($session->uid, "sit1_perm", $newPerm, 1);

				} else if ($session->userinfo['sit2'] == 0) {
					$database->updateUserField($session->uid, "sit2", $sitid, 1);
					$database->updateUserField($session->uid, "sit2_perm", $newPerm, 1);
				}
			}
		}

		/**
		 * Actualizarea permisiunilor pentru sitterii deja existenti.
		 *
		 * Casutele sunt in acelasi formular cu restul setarilor de cont, deci
		 * ajung aici la orice salvare. Scriem doar pentru sloturile ocupate -
		 * altfel am seta permisiuni pentru un sitter inexistent.
		 *
		 * Atentie: casutele nebifate NU se trimit prin POST. De aceea ne uitam
		 * dupa cheia campului, nu dupa continutul ei: daca perm1 lipseste cu
		 * totul inseamna ca formularul nu continea sectiunea (nu ca sitterul
		 * si-a pierdut toate drepturile).
		 */
		foreach (array(1 => 'sit1', 2 => 'sit2') as $slot => $key) {

			if ((int) $session->userinfo[$key] === 0) {
				continue;
			}

			$field = 'perm' . $slot;

			// slotul e afisat in formular doar cand e ocupat; daca butonul de
			// salvare a fost apasat, campul exista chiar si gol (vezi hidden-ul
			// din account.tpl)
			if (!isset($post[$field . '_sent'])) {
				continue;
			}

			$database->updateUserField(
				$session->uid,
				$key . '_perm',
				$sitterMaskFromPost($post[$field] ?? null),
				1
			);
		}

		// Persist errors if any
		if ($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
		}

		// Invalidate the 30s session user-cache (see Session::PopulateVar) so the
		// updated account fields (email, sitters, password) are reflected
		// immediately, without a re-login.
		unset($_SESSION['cache_user_' . ($_SESSION['username'] ?? '')]);

		header("Location: spieler.php?s=3");
		exit;
	}

	/**
	 * Remove sitter
	 */
	private function removeSitter($get) {
		global $database, $session;

		// UM-W1: validam type in {1,2} inainte de a-l folosi in numele coloanei
		// (sit1/sit2). DB escapeaza campul, deci nu era injectabil, dar un type
		// invalid ar fi tintit o coloana inexistenta.
		$type = isset($get['type']) ? (int)$get['type'] : 0;
		if ($type !== 1 && $type !== 2) {
			header("Location: spieler.php?s=" . $get['s']);
			exit;
		}

		if (hash_equals((string) $session->checker, (string) ($get['a'] ?? ''))) {

			if ($session->userinfo['sit' . $type] == $get['id']) {
				$database->updateUserField($session->uid, "sit" . $type, 0, 1);
				// Invalidate the 30s session user-cache (see Session::PopulateVar) so the
				// removed sitter disappears immediately, without a re-login.
				unset($_SESSION['cache_user_' . ($_SESSION['username'] ?? '')]);
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

		if (hash_equals((string) $session->checker, (string) ($get['a'] ?? ''))) {
			$database->removeMeSit($get['id'], $session->uid);
			$session->changeChecker();
		}

		header("Location: spieler.php?s=" . $get['s']);
		exit;
	}
}

$profile = new Profile;
?>