<?php

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        8.tpl                                                  		   ##
## Description: Crop Plus 			                                           ##
## Made by:     alq0rsan													   ##
## Improved by: evader														   ##
## Refactor by: Shadow 														   ##
## 				                                                               ##
#################################################################################

if($session->sit == 0) {
    $uid  = (int)$session->uid;
    $now  = time();
    $cost = 5;

    // UPDATE atomic: scade gold doar dacă ai, și prelungește b4
    $sql = "UPDATE ".TB_PREFIX."users 
            SET gold = gold - $cost,
                b4 = IF(b4 > $now, b4 + ".PLUS_PRODUCTION.", $now + ".PLUS_PRODUCTION.")
            WHERE id = '$uid' AND gold >= $cost";

    mysqli_query($database->dblink, $sql) or die(mysqli_error($database->dblink));

    if(mysqli_affected_rows($database->dblink) == 1) {
        // succes - update instant în sesiune
        $session->gold -= $cost;

        // log
        mysqli_query($database->dblink, "INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', '+25% Production: Crop')") or die(mysqli_error($database->dblink));

        // invalidează cache v9
        if(method_exists($database, 'clearUserCache')) {
            $database->clearUserCache($uid);
        }
    }
}
header("Location: plus.php?id=3");
exit;
?>