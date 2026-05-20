<?php

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        8.tpl                                                  		   ##
## Description: Plus Account			                                       ##
## Made by:     alq0rsan													   ##
## Improved by: evader														   ##
## Refactor by: Shadow 														   ##
## 				                                                               ##
#################################################################################

if($session->sit == 0) {
    $now = time();
    $uid = (int)$session->uid;
    $cost = 10;

    // un singur UPDATE: scade gold DOAR dacă ai destul, și prelungește plus-ul
    $sql = "UPDATE ".TB_PREFIX."users 
            SET gold = gold - $cost,
                plus = IF(plus > $now, plus + ".PLUS_TIME.", $now + ".PLUS_TIME.")
            WHERE id = '$uid' AND gold >= $cost";

    mysqli_query($database->dblink, $sql) or die(mysqli_error($database->dblink));

    if(mysqli_affected_rows($database->dblink) == 1) {
        // a reușit - actualizează sesiunea instant
        $session->gold -= $cost;

        // log (opțional)
        mysqli_query($database->dblink, "INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', 'Plus Account')") or die(mysqli_error($database->dblink));
        
        // invalidează cache v9
        if(method_exists($database, 'clearUserCache')) {
            $database->clearUserCache($uid);
        }
    }
}
header("Location: plus.php?id=3");
exit;
?>