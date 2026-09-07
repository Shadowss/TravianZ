<?php

/**
 * TravianZ Global Chat endpoint.
 *
 * This endpoint is intentionally separate from ajax.php because the browser
 * polls chat frequently. Keeping it separate avoids filling AccessLogger with
 * thousands of periodic chat requests.
 */

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
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => 0, 'error' => 'bootstrap']);
    exit;
}

include_once $autoprefix . 'GameEngine/config.php';
include_once $autoprefix . 'GameEngine/Database.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

$uid = isset($_SESSION['id_user']) ? (int) $_SESSION['id_user'] : 0;

if ($uid <= 0) {
    http_response_code(401);
    echo json_encode(['ok' => 0, 'error' => 'unauthorized']);
    exit;
}

if (!isset($database) || !is_object($database)) {
    http_response_code(500);
    echo json_encode(['ok' => 0, 'error' => 'database']);
    exit;
}

$link = $database->return_link();

if (!$link) {
    http_response_code(500);
    echo json_encode(['ok' => 0, 'error' => 'connection']);
    exit;
}

$table = TB_PREFIX . 'chat';
$username = (string) $database->getUserField($uid, 'username', '');

if ($username === '') {
    http_response_code(403);
    echo json_encode(['ok' => 0, 'error' => 'user']);
    exit;
}

$action = isset($_REQUEST['action']) ? (string) $_REQUEST['action'] : 'messages';

if ($action === 'messages') {
    $after = isset($_GET['after']) ? max(0, (int) $_GET['after']) : 0;

    if ($after > 0) {
        $stmt = mysqli_prepare(
            $link,
            "SELECT id, id_user AS uid, name AS username, date, msg AS message
             FROM `" . $table . "`
             WHERE id > ? AND alli = ''
             ORDER BY id ASC
             LIMIT 50"
        );

        if (!$stmt) {
            http_response_code(500);
            echo json_encode(['ok' => 0, 'error' => 'query']);
            exit;
        }

        mysqli_stmt_bind_param($stmt, 'i', $after);
    } else {
        $stmt = mysqli_prepare(
            $link,
            "SELECT id, id_user AS uid, name AS username, date, msg AS message
             FROM `" . $table . "`
             WHERE alli = ''
             ORDER BY id DESC
             LIMIT 40"
        );

        if (!$stmt) {
            http_response_code(500);
            echo json_encode(['ok' => 0, 'error' => 'query']);
            exit;
        }
    }

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        http_response_code(500);
        echo json_encode(['ok' => 0, 'error' => 'execute']);
        exit;
    }

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        mysqli_stmt_close($stmt);
        http_response_code(500);
        echo json_encode(['ok' => 0, 'error' => 'result']);
        exit;
    }

    $messages = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = [
            'id'       => (int) $row['id'],
            'uid'      => (int) $row['uid'],
            'username' => (string) $row['username'],
            'message'  => (string) $row['message'],
            'time'     => date('H:i', (int) $row['date']),
        ];
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmt);

    if ($after === 0) {
        $messages = array_reverse($messages);
    }

    $latestResult = mysqli_query(
        $link,
        "SELECT MAX(id) AS latest_id FROM `" . $table . "` WHERE alli = ''"
    );

    $latestId = 0;

    if ($latestResult) {
        $latestRow = mysqli_fetch_assoc($latestResult);
        $latestId = isset($latestRow['latest_id']) ? (int) $latestRow['latest_id'] : 0;
        mysqli_free_result($latestResult);
    }

    echo json_encode([
        'ok' => 1,
        'uid' => $uid,
        'messages' => $messages,
        'latest_id' => $latestId,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

if ($action === 'send') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['ok' => 0, 'error' => 'method']);
        exit;
    }

    $now = microtime(true);
    $lastSend = isset($_SESSION['tz_chat_last_send']) ? (float) $_SESSION['tz_chat_last_send'] : 0.0;

    if (($now - $lastSend) < 1.0) {
        http_response_code(429);
        echo json_encode(['ok' => 0, 'error' => 'rate']);
        exit;
    }

    $message = isset($_POST['message']) ? (string) $_POST['message'] : '';
    $message = str_replace(["\r", "\n"], ' ', $message);
    $message = trim($message);
    $message = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $message);

    if ($message === null) {
        $message = '';
    }

    // The existing TravianZ chat table uses VARCHAR(255) for msg.
    $length = function_exists('mb_strlen') ? mb_strlen($message, 'UTF-8') : strlen($message);

    if ($length < 1) {
        http_response_code(400);
        echo json_encode(['ok' => 0, 'error' => 'empty']);
        exit;
    }

    if ($length > 255) {
        http_response_code(400);
        echo json_encode(['ok' => 0, 'error' => 'length']);
        exit;
    }

    $alliance = '';
    $timestamp = time();

    $stmt = mysqli_prepare(
        $link,
        "INSERT INTO `" . $table . "` (id_user, name, alli, date, msg)
         VALUES (?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['ok' => 0, 'error' => 'prepare']);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'issis', $uid, $username, $alliance, $timestamp, $message);
    $ok = mysqli_stmt_execute($stmt);
    $newId = $ok ? mysqli_insert_id($link) : 0;
    mysqli_stmt_close($stmt);

    if (!$ok) {
        http_response_code(500);
        echo json_encode(['ok' => 0, 'error' => 'insert']);
        exit;
    }

    $_SESSION['tz_chat_last_send'] = $now;

    echo json_encode([
        'ok' => 1,
        'id' => (int) $newId,
    ]);
    exit;
}

http_response_code(400);
echo json_encode(['ok' => 0, 'error' => 'action']);
