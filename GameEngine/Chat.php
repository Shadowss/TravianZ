<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Chat.php                                                    ##
##  Developed by:  TTMMTT                                                      ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

if (!isset($SAJAX_INCLUDED)) {

    $GLOBALS['sajax_version'] = '0.12';
    $GLOBALS['sajax_debug_mode'] = 0;
    $GLOBALS['sajax_export_list'] = [];
    $GLOBALS['sajax_request_type'] = 'GET';
    $GLOBALS['sajax_remote_uri'] = $_SERVER['REQUEST_URI'] ?? '';
    $GLOBALS['sajax_failure_redirect'] = '';

    /* ==============================
       SECURITY HELPERS
    ============================== */

    function sajax_safe_string($value) {
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function sajax_validate_function($func_name) {
        global $sajax_export_list;
        return in_array($func_name, $sajax_export_list, true);
    }

    /* ==============================
       CLIENT REQUEST HANDLER (HARDENED)
    ============================== */

    function sajax_handle_client_request() {

        global $sajax_export_list;

        $mode = '';

        if (isset($_GET['rs'])) $mode = 'get';
        if (isset($_POST['rs'])) $mode = 'post';

        if (!$mode) return;

        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");

        $func_name = $mode === 'get'
            ? (string)$_GET['rs']
            : (string)$_POST['rs'];

        $args = $mode === 'get'
            ? ($_GET['rsargs'] ?? [])
            : ($_POST['rsargs'] ?? []);

        if (!is_array($args)) {
            $args = [$args];
        }

        if (!sajax_validate_function($func_name) || !function_exists($func_name)) {
            echo "-:Function not callable";
            exit;
        }

        echo "+:";
        $result = call_user_func_array($func_name, $args);
        echo "var res = " . trim(sajax_get_js_repr($result)) . "; res;";
        exit;
    }

    /* ==============================
       SAFE JS ENCODER
    ============================== */

    function sajax_get_js_repr($value) {

        if (is_bool($value)) {
            return $value ? "Boolean(true)" : "Boolean(false)";
        }

        if (is_int($value)) {
            return "parseInt($value)";
        }

        if (is_float($value)) {
            return "parseFloat($value)";
        }

        if (is_array($value) || is_object($value)) {

            $value = (array)$value;
            $pairs = [];

            foreach ($value as $k => $v) {
                $k = sajax_safe_string($k);
                $pairs[] = is_numeric($k)
                    ? "$k: " . sajax_get_js_repr($v)
                    : "\"$k\": " . sajax_get_js_repr($v);
            }

            return "{ " . implode(', ', $pairs) . " }";
        }

        return "'" . sajax_safe_string($value) . "'";
    }

    function sajax_export() {
        global $sajax_export_list;
        foreach (func_get_args() as $func) {
            if (is_string($func)) {
                $sajax_export_list[] = $func;
            }
        }
    }

    $SAJAX_INCLUDED = 1;
}

/* ==============================
   CHAT FUNCTIONS (HARDENED)
============================== */

function add_data($data) {

    global $session, $database;

    if (!$session->uid) return;

    $msg = is_array($data) ? ($data[1] ?? '') : $data;
    $msg = trim((string)$msg);

    if ($msg === '') return;

    $id_user = (int)$session->uid;
    $name = $database->escape($session->username);
    $alliance = $database->escape($session->alliance);
    $now = time();

    $stmt = mysqli_prepare(
        $database->dblink,
        "INSERT INTO ".TB_PREFIX."chat (id_user, name, alli, date, msg) VALUES (?, ?, ?, ?, ?)"
    );

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "issis",
            $id_user,
            $name,
            $alliance,
            $now,
            $msg
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

function get_data() {

    global $session, $database;

    $alliance = $database->escape($session->alliance);

    $stmt = mysqli_prepare(
        $database->dblink,
        "SELECT id_user, name, date, msg 
         FROM ".TB_PREFIX."chat 
         WHERE alli = ? 
         ORDER BY id DESC 
         LIMIT 13"
    );

    $data = '';

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $alliance);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($r = mysqli_fetch_assoc($result)) {

            $dates = date("H:i", (int)$r['date']);
            $uid = (int)$r['id_user'];

            $username = sajax_safe_string($r['name']);
            $message = sajax_safe_string($r['msg']);

            $data .= "[{$dates}] <a href='spieler.php?uid={$uid}'>{$username}</a>: {$message} <br>";
        }

        mysqli_stmt_close($stmt);
    }

    return $data;
}

/* ==============================
   SAJAX BOOTSTRAP
============================== */

$sajax_request_type = "GET";
sajax_export("add_data", "get_data");
sajax_handle_client_request();
