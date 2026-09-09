<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : ajax.php                      	                           ##
##  Type           : In Game Ajax File                                         ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki & Advocaite & Donnchadh                             ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
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

// even with autoloader created, we can't use it here yet, as it's not been created
// ... so, let's see where it is and include it
$autoloader_found = false;
// go max 5 levels up - we don't have folders that go deeper than that
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

// we need config to determine whether to log access or not
include_once($autoprefix.'GameEngine/config.php');

use App\Utils\AccessLogger;
AccessLogger::logRequest();

/**
 * ajax.php poate fi cerut si fara parametrul "f" (boti, prefetch de browser,
 * un link vechi). Fara isset() iesea "Undefined array key f" la fiecare
 * astfel de cerere; acum pica linistit pe default.
 */
switch(isset($_GET['f']) ? $_GET['f'] : '') {
	case 'k7':
	    header('Content-Type: application/json');
		$x = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['x']);
		$y = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['y']);
		$xx = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['xx']);
		$yy = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['yy']);
		$howmany = $x - $xx;
		if($howmany == 12 || $howmany == -12) {
			include("Templates/Ajax/mapscroll2.tpl");
		}
		else {
		include("Templates/Ajax/mapscroll.tpl");
		}
		break;
	case 'qst':

	if (isset($_GET['qact'])){
	$qact=preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['qact']);
	}else {
	$qact=null;
	}
	if (isset($_GET['qact2'])){
	$qact2=preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['qact2']);
	}else {
	$qact2=null;
	}
	if (isset($_GET['qact3'])){
        $qact3=preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['qact3']);
    	}else {
        $qact3=null;
    	}  
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['qtyp']) && $_SESSION['qtyp']==37) {
        include("Templates/Ajax/quest_core.tpl");
    }else{
        include("Templates/Ajax/quest_core25.tpl");
    }
        break;
	// Rally-point attack marker (issue #245): persist the green/yellow/red tag
	// a defender sets on an incoming attack. setMovementMarker() enforces that
	// the targeted village belongs to the logged-in user.
	case 'marker':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0]);
			break;
		}
		$ok = $database->setMovementMarker($_POST['moveid'] ?? 0, $_POST['marker'] ?? 0, $uid);
		echo json_encode(['ok' => $ok ? 1 : 0]);
		break;

	// Chat general (server-wide), cerut de Catalin 07.09.2026. Separat de
	// alliance chat (Chat.php, SAJAX) - vazut/scris de orice user logat,
	// moderat de MH (access 8) si Admin (access 9).
	// Faza 2 (09.09.2026): sterge/editeaza mesaj, sondaje, mai jos.
	case 'gchat_poll':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		$sinceId = (int) ($_GET['sinceId'] ?? 0);
		echo json_encode([
			'ok' => 1,
			'messages' => $database->getGlobalChatMessages(30, $sinceId, $uid),
			'viewer' => $database->getGlobalChatViewerInfo($uid),
		]);
		break;

	// Faza 2 (09.09.2026): editari/stergeri intamplate de la ultimul cec al
	// clientului - separat de 'gchat_poll' de mai sus (acela e long-polling
	// pentru mesaje NOI dupa id; asta e watermark pe timp, pentru mesaje VECHI
	// deja afisate care s-au schimbat - denumiri diferite intentionat, ca sa
	// nu se confunde cele doua mecanisme).
	case 'gchat_updates':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		$sinceTs = (int) ($_GET['sinceTs'] ?? 0);
		$result = $database->getGlobalChatUpdates($sinceTs, $uid);
		echo json_encode([
			'ok' => 1,
			'rows' => $result['rows'],
			'now' => $result['now'],
		]);
		break;

	case 'gchat_send':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		echo json_encode($database->postGlobalChatMessage($uid, $_POST['msg'] ?? ''));
		break;

	// Faza 2 (09.09.2026): userul isi editeaza propriul mesaj. Verificarea de
	// proprietate (doar mesajul lui) se face in Database::editGlobalChatMessage().
	case 'gchat_edit':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		echo json_encode($database->editGlobalChatMessage($uid, $_POST['id'] ?? 0, $_POST['msg'] ?? ''));
		break;

	// Faza 2 (09.09.2026): MH/Admin sterg un mesaj (de obicei vulgar). Spre
	// deosebire de mute/block mai jos, aici NU se compara rangul cu al
	// autorului mesajului - vezi comentariul din Database::deleteGlobalChatMessage().
	case 'gchat_delete':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$modUid = (int) ($_SESSION['id_user'] ?? 0);
		$msgId = (int) ($_POST['id'] ?? 0);
		if (!$modUid || !$msgId) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		$modAccess = (int) $database->getUserField($modUid, 'access', 0);
		if ($modAccess < MULTIHUNTER) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'forbidden']);
			break;
		}
		echo json_encode(['ok' => $database->deleteGlobalChatMessage($msgId) ? 1 : 0]);
		break;

	// Faza 2 (09.09.2026): creare sondaj in chat-ul general. $_POST['options']
	// vine ca array (options[]=...&options[]=...) din formularul de creare.
	case 'gchat_poll_create':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		$options = isset($_POST['options']) && is_array($_POST['options']) ? $_POST['options'] : [];
		echo json_encode($database->createGlobalChatPoll($uid, $_POST['question'] ?? '', $options));
		break;

	case 'gchat_poll_vote':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$uid = (int) ($_SESSION['id_user'] ?? 0);
		if (!$uid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}
		echo json_encode($database->voteGlobalChatPoll($uid, $_POST['pollId'] ?? 0, $_POST['option'] ?? -1));
		break;

	case 'gchat_mute':
	case 'gchat_block':
	case 'gchat_unmute':
		header('Content-Type: application/json');
		if (!isset($_SESSION)) {
			session_start();
		}
		include_once($autoprefix.'GameEngine/Database.php');
		$modUid = (int) ($_SESSION['id_user'] ?? 0);
		$targetUid = (int) ($_POST['target'] ?? 0);

		if (!$modUid || !$targetUid) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'notloggedin']);
			break;
		}

		$modAccess = (int) $database->getUserField($modUid, 'access', 0);
		$targetAccess = (int) $database->getUserField($targetUid, 'access', 0);

		// doar MH (8) si Admin (9) modereaza chat-ul general, si nimeni nu
		// poate modera pe cineva de rang egal sau mai mare - deci MH nu
		// poate muta alt MH/Admin, iar Admin nu poate muta alt Admin
		if ($modAccess < MULTIHUNTER || $targetAccess >= $modAccess) {
			http_response_code(403);
			echo json_encode(['ok' => 0, 'reason' => 'forbidden']);
			break;
		}

		if ($_GET['f'] == 'gchat_unmute') {
			$ok = $database->unmuteGlobalChatUser($targetUid);
		} else {
			$reason = substr((string) ($_POST['reason'] ?? ''), 0, 255);
			// 'gchat_block' = permanent (~100 de ani); 'gchat_mute' = temporar, in minute (POST['minutes'])
			$until = ($_GET['f'] == 'gchat_block')
				? (time() + 3600 * 24 * 365 * 100)
				: (time() + max(1, (int) ($_POST['minutes'] ?? 0)) * 60);
			$ok = $database->muteGlobalChatUser($targetUid, $modUid, $until, $reason);
		}

		echo json_encode(['ok' => $ok ? 1 : 0]);
		break;
}
?>
