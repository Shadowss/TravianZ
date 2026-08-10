<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : 12.tpl                                                    ##
##  Type           : Plus - Activate Crop Bonus                                ##
## --------------------------------------------------------------------------- ##
##  Developed by   : alq0rsan & evader & Shadow                                ##
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

if($session->sit == 0) {
    $uid  = (int)$session->uid;
    $wid  = (int)$village->wid;
    $now  = time();
    $cost = 5;

    $sql = "UPDATE ".TB_PREFIX."users 
            SET gold = gold - $cost,
                b4 = IF(b4 > $now, b4 + ".PLUS_PRODUCTION.", $now + ".PLUS_PRODUCTION.")
            WHERE id = $uid AND gold >= $cost";

    mysqli_query($database->dblink, $sql);

    if(mysqli_affected_rows($database->dblink) == 1) {
        $session->gold -= $cost;
        $_SESSION['gold'] = $session->gold;
        // Session nu are proprietatea ->b4; valoarea sta in userarray, de unde
        // o citeste si PopulateVar(). Scrierea directa crea o proprietate
        // dinamica (depreciata in PHP 8.2) si nu se vedea nicaieri.
        $currentB4 = isset($session->userarray['b4']) ? (int) $session->userarray['b4'] : 0;
        $session->userarray['b4'] = ($currentB4 > $now ? $currentB4 : $now) + PLUS_PRODUCTION;

        // LOG pentru a2b2
        mysqli_query($database->dblink,
            "INSERT INTO ".TB_PREFIX."gold_fin_log 
             (uid, wid, action, gold, time, details) 
             VALUES ($uid, $wid, 'Use 5 gold for +25% Crop', -$cost, $now, '+25% Production: Crop')"
        );

        if(method_exists($database, 'clearUserCache')) {
            $database->clearUserCache($uid);
        }
    }
}
header("Location: plus.php?id=3");
exit;
?>