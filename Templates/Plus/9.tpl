<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : 9.tpl                                                     ##
##  Type           : Plus - Activate Lumber Bonus                              ##
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

    // UPDATE atomic: scade gold și prelungește b1
    $sql = "UPDATE ".TB_PREFIX."users 
            SET gold = gold - $cost,
                b1 = IF(b1 > $now, b1 + ".PLUS_PRODUCTION.", $now + ".PLUS_PRODUCTION.")
            WHERE id = $uid AND gold >= $cost";

    mysqli_query($database->dblink, $sql);

    if(mysqli_affected_rows($database->dblink) == 1) {
        // update sesiune instant
        $session->gold -= $cost;
        $_SESSION['gold'] = $session->gold;
        // Interogarea de mai sus a prelungit deja b1 in baza de date, atomic.
        // Aici doar marcam bonusul ca activ in sesiune, ca pagina sa arate
        // corect imediat, fara sa mai citim o data din baza.
        //
        // Session NU are proprietatea ->b1 (momentul expirarii sta in
        // userarray, care e privat). Are insa ->bonus1, indicatorul public
        // 0/1 pe care il foloseste restul interfetei.
        $session->bonus1 = 1;

        // LOG pentru a2b2.php
		mysqli_query($database->dblink,
		"INSERT INTO ".TB_PREFIX."gold_fin_log 
		(uid, wid, action, gold, time, details) 
		VALUES ($uid, $wid, 'Use 5 gold for +25% Lumber', -$cost, $now, '+25% Production: Lumber')"
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