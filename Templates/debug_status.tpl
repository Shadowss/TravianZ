<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : debug_status.tpl                                          ##
##  Type           : Left Menu Widget (admin only)                            ##
## --------------------------------------------------------------------------- ##
##  Project        : TravianZ                                                  ##
##  Quick on/off toggle for the Debug Error Log, handy to flip while playing  ##
##  to reproduce a bug. Transparent to players; visible to admins only.       ##
## --------------------------------------------------------------------------- ##
#################################################################################

global $database, $session;

if($isAdmin) {

    // === QUICK TOGGLE from the menu (?dbg=on / ?dbg=off) ===
    if(isset($_GET['dbg']) && ($_GET['dbg'] == 'on' || $_GET['dbg'] == 'off')) {
        $newState = ($_GET['dbg'] == 'on') ? 1 : 0;
        $database->setDebugMode($newState, $session->uid);
        // redirect to clean the URL
        $cleanUrl = strtok($_SERVER["REQUEST_URI"], '?');
        header("Location: $cleanUrl");
        exit;
    }

    $dbg = $database->getDebugMode();

    if(!empty($dbg['active'])) {
        $started = !empty($dbg['started_at']) ? date('H:i d.m.Y', $dbg['started_at']) : '-';
        ?>
        <a href="?dbg=off"
           title="Debug capture ON since <?=$started?> - Click to STOP"
           style="color:#dc2626; font-weight:700;">
           <?php echo TZ_DEBUG_ON; ?>
        </a>
        <?php
    } else {
        ?>
        <a href="?dbg=on"
           title="Debug capture OFF - Click to START"
           style="color:#16a34a; font-weight:700;">
           <?php echo TZ_DEBUG_OFF; ?>
        </a>
        <?php
    }
}
?>
