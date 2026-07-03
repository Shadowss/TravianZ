<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       massmessage.php                                             ##
##  Type           BACKEND                                                     ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// #299: load CSRF helpers + admin_deny() before the access check below.
require_once(__DIR__ . '/../csrf.php');
session_start();

include_once("../../config.php");
include_once("../../Database.php");

if (!isset($_SESSION['access']) || $_SESSION['access'] < ADMIN) {
    admin_deny('You must be signed in as an administrator to view this page. Your session may have expired — please return to the admin panel and sign in again.');
}

// Issue #139: this Mod is POSTed to directly, so it must verify the CSRF token
// itself (it does not go through admin.php's central csrf_verify()).
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

/*
|--------------------------------------------------------------------------
| PREPARE
|--------------------------------------------------------------------------
*/
if (
    isset($_POST['action']) &&
    $_POST['action'] == 'prepare'
) {

    if (empty($_POST['subject'])) {
        die("Subject required");
    }

    if (empty($_POST['message'])) {
        die("Message required");
    }

    $_SESSION['mass_subject'] = trim($_POST['subject']);
    $_SESSION['mass_message'] = trim($_POST['message']);
	$allowedColors = array(
    'black',
    'red',
    'green',
    'blue',
    'orange',
    'purple',
    'brown'
	);

	$color = strtolower(trim($_POST['color']));

	if (!in_array($color, $allowedColors, true)) {
    $color = 'black';
	}

	$_SESSION['mass_color'] = $color;

    header("Location: ../../../Admin/admin.php?p=massmessage&confirm=1");
    exit;
}

/*
|--------------------------------------------------------------------------
| EXECUTE
|--------------------------------------------------------------------------
*/
if (
    isset($_POST['action']) &&
    $_POST['action'] == 'execute'
) {

    if (
        empty($_SESSION['mass_subject']) ||
        empty($_SESSION['mass_message'])
    ) {
        header("Location: ../../../Admin/admin.php?p=massmessage");
        exit;
    }

    $subject = $database->escape($_SESSION['mass_subject']);
    $message = $_SESSION['mass_message'];
    $color = $database->escape(
        $_SESSION['mass_color'] ?: 'black'
    );

    /*
    |--------------------------------------------------------------------------
    | BBCode
    |--------------------------------------------------------------------------
    */

	$message = preg_replace_callback(
    "/\[img\](.*?)\[\/img\]/is",
    function ($m) {

        $url = trim($m[1]);

        if (!preg_match('#^https?://#i', $url)) {
            return '';
        }

        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        return '<img src="' . $safe . '" alt="" />';
    },
    $message
	);

	$message = preg_replace_callback(
    "/\[url\](.*?)\[\/url\]/is",
    function ($m) {

        $url = trim($m[1]);

        if (!preg_match('#^https?://#i', $url)) {
            return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        }

        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        return '<a href="' .
               $safe .
               '" target="_blank" rel="noopener noreferrer">' .
               $safe .
               '</a>';
    },
    $message
	);

	$message = preg_replace_callback(
    "/\[url=(.*?)\](.*?)\[\/url\]/is",
    function ($m) {

        $url = trim($m[1]);
        $text = htmlspecialchars($m[2], ENT_QUOTES, 'UTF-8');

        if (!preg_match('#^https?://#i', $url)) {
            return $text;
        }

        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        return '<a href="' .
               $safe .
               '" target="_blank" rel="noopener noreferrer">' .
               $text .
               '</a>';
    },
    $message
	);

    $message = "[message]".$message."[/message]";

    $message = $database->escape($message);

    /*
    |--------------------------------------------------------------------------
    | ALL PLAYERS
    |--------------------------------------------------------------------------
    */

    $result = mysqli_query(
        $database->dblink,
        "SELECT id
         FROM ".TB_PREFIX."users
         WHERE id > 5
         ORDER BY id ASC"
    );

    $rows = [];

    $time = time();

    while ($user = mysqli_fetch_assoc($result)) {

        $uid = (int)$user['id'];

        $rows[] =
        "(".
            $uid.",".
            "1,".
            "'<span style=\"color:".$color.";\">".$subject."</span>',".
            "'".$message."',".
            "0,".
            "0,".
            "0,".
            $time.",".
            "0,".
            "0,".
            "0,".
            "0,".
            "0,".
            "0".
        ")";
    }

    if (!empty($rows)) {

        $sql =
        "INSERT INTO ".TB_PREFIX."mdata
        (
            target,
            owner,
            topic,
            message,
            viewed,
            archived,
            send,
            time,
            deltarget,
            delowner,
            alliance,
            player,
            coor,
            report
        )
        VALUES
        ".implode(",", $rows);

        mysqli_query(
            $database->dblink,
            $sql
        );
    }

    unset(
        $_SESSION['mass_subject'],
        $_SESSION['mass_message'],
        $_SESSION['mass_color']
    );

    header("Location: ../../../Admin/admin.php?p=massmessage&done=1");
    exit;
}

header("Location: ../../../Admin/admin.php?p=massmessage");
exit;
?>