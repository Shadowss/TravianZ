<?php

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        8.tpl                                                  		   ##
## Description: Clay Plus 			                                           ##
## Made by:     alq0rsan													   ##
## Improved by: evader														   ##
## Refactor by: Shadow 														   ##
## 				                                                               ##
#################################################################################

if($session->sit == 0) {
    $uid  = (int)$session->uid;
    $wid  = (int)$village->wid;
    $now  = time();
    $cost = 5;

    // UPDATE atomic: scade gold și prelungește b2
    $sql = "UPDATE ".TB_PREFIX."users 
            SET gold = gold - $cost,
                b2 = IF(b2 > $now, b2 + ".PLUS_PRODUCTION.", $now + ".PLUS_PRODUCTION.")
            WHERE id = $uid AND gold >= $cost";

    mysqli_query($database->dblink, $sql);

    if(mysqli_affected_rows($database->dblink) == 1) {
        // update sesiune
        $session->gold -= $cost;
        $_SESSION['gold'] = $session->gold;
        $session->b2 = ($session->b2 > $now ? $session->b2 : $now) + PLUS_PRODUCTION;

        // LOG pentru a2b2.php
        mysqli_query($database->dblink,
            "INSERT INTO ".TB_PREFIX."gold_fin_log 
             (uid, wid, action, gold, time, details) 
             VALUES ($uid, $wid, 'Use 5 gold for +25% Clay', -$cost, $now, '+25% Production: Clay')"
        );

        // curăță cache
        if(method_exists($database, 'clearUserCache')) {
            $database->clearUserCache($uid);
        }
    }
}
header("Location: plus.php?id=3");
exit;
?>