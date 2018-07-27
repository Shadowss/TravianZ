<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.php                                                ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/Database.php");

$id = (int) $_POST['id'];

$bonusDuration = [];
$time = time();
$bonusDuration['plus'] =  (int) $_POST['plus'] * 86400; //Plus
$bonusDuration['b1'] = (int) $_POST['wood'] * 86400; //+25% Wood
$bonusDuration['b2'] = (int) $_POST['clay'] * 86400; //+25% Clay
$bonusDuration['b3'] = (int) $_POST['iron'] * 86400; //+25% Iron
$bonusDuration['b4'] = (int) $_POST['crop'] * 86400; //+25% Crop

$user = $database->getUserArray($id, 1);

foreach($bonusDuration as $index => $bonus){
    $bonusDuration[$index] = $bonusDuration[$index] + ($user[$index] < $time ? $time : $user[$index]);
    if($bonusDuration[$index] < $time) $bonusDuration[$index] = 0;
}

$database->updateUserField($id, array_keys($bonusDuration), array_values($bonusDuration), 1);

header("Location: ../../../Admin/admin.php?p=player&uid=".$id."");
?>