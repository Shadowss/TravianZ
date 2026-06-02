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

session_start();

include_once("../../config.php");
include_once("../../Database.php");

if (!isset($_SESSION['access']) || $_SESSION['access'] < ADMIN) {
    die("Access Denied");
}

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
    $_SESSION['mass_color'] = trim($_POST['color']);

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

    $message = preg_replace(
        "/\[img\](.*?)\[\/img\]/i",
        "<img src='$1' alt='' />",
        $message
    );

    $message = preg_replace(
        "/\[url\](.*?)\[\/url\]/i",
        "<a href='$1'>$1</a>",
        $message
    );

    $message = preg_replace(
        "/\[url=(.*?)\](.*?)\[\/url\]/i",
        "<a href='$1'>$2</a>",
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