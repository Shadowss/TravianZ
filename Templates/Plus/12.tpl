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

// PERMISIUNI SITTER: cumparaturile cu aur.
// Inlocuieste vechiul "$session->sit", care citea un flag din tabela online
// scris cu INSERT IGNORE - deci nu se actualiza daca randul exista deja.
// sitterCan() se bazeaza pe sesiune, deci e mereu corect.
if($session->sitterCan(SITTER_PERM_GOLD)) {
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
        // Interogarea de mai sus a prelungit deja b4 in baza de date, atomic.
        // Aici doar marcam bonusul ca activ in sesiune, ca pagina sa arate
        // corect imediat, fara sa mai citim o data din baza.
        //
        // Session NU are proprietatea ->b4 (momentul expirarii sta in
        // userarray, care e privat). Are insa ->bonus4, indicatorul public
        // 0/1 pe care il foloseste restul interfetei.
        $session->bonus4 = 1;

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