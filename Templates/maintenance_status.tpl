<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : maintenance_status.tpl                                    ##
##  Type           : Left Menu Widget                                          ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
##  Project        : TravianZ                                                  ##
## --------------------------------------------------------------------------- ##
#################################################################################

global $database, $session;

// rulează doar pentru admin
if($isAdmin) {

    // === TOGGLE RAPID din meniu (?m=on / ?m=off) ===
    if(isset($_GET['m']) && ($_GET['m'] == 'on' || $_GET['m'] == 'off')) {
        $newState = ($_GET['m'] == 'on') ? 1 : 0;
        $database->setMaintenance($newState, $session->uid);
        // redirect ca sa curatam URL-ul
        $cleanUrl = strtok($_SERVER["REQUEST_URI"], '?');
        header("Location: $cleanUrl");
        exit;
    }

    $maint = $database->getMaintenance();

    if(!empty($maint['active'])) {
        $started = $maint['started_at'] ? date('H:i d.m.Y', $maint['started_at']) : '-';
        $starter = $database->getUserArray($maint['started_by'], 1);
        $starterName = $starter['username'] ?? 'UID '.$maint['started_by'];
        ?>
        <a href="?m=off" 
           title="Pornit de <?=htmlspecialchars($starterName)?> la <?=$started?> - Click pentru OPRIRE"
           style="color:#dc2626; font-weight:700;">
           <?php echo TZ_MAINTENANCE_ON; ?>
        </a>
        <?php
    } else {
        ?>
        <a href="?m=on" 
           title="Server deschis - Click pentru ACTIVARE"
           style="color:#16a34a; font-weight:700;">
           <?php echo TZ_MAINTENANCE_OFF; ?>
        </a>
        <?php
    }
}
?>