<?php
#################################################################################
##  editAli.php - Backend pentru editAli.tpl                                   ##
#################################################################################

include_once("../../config.php");
include_once("../../Session.php");
include_once("../../Database.php");

$session = new Session();
$database = new Database();

// doar admini
if(!$session->isAdmin()){
    header("Location: ../../../Admin/admin.php");
    exit;
}

$aid = (int)($_POST['aid'] ?? 0);
$admid = (int)($_POST['admid'] ?? 0);

// verificare sesiune
if($admid != $session->uid || $aid <= 0){
    die("Access denied");
}

$tag = $database->escape(substr(trim($_POST['tag']), 0, 8));
$name = $database->escape(substr(trim($_POST['name']), 0, 25));
$leader = (int)$_POST['leader'];
$max = (int)$_POST['max'];
if($max < 3) $max = 3;
if($max > 60) $max = 60;

$notice = $database->escape($_POST['notice']);
$desc = $database->escape($_POST['desc']);

// update alidata
$database->query("UPDATE ".TB_PREFIX."alidata SET 
    tag = '$tag',
    name = '$name',
    leader = $leader,
    `max` = $max,
    notice = '$notice',
    `desc` = '$desc'
WHERE id = $aid");

// log admin
$database->query("INSERT INTO ".TB_PREFIX."admin_log (uid, action, time) VALUES ($admid, 'Edited alliance $aid ($tag)', ".time().")");

// redirect inapoi
header("Location: ../../../Admin/admin.php?p=alliance&aid=$aid&edited=1");
exit;
?>