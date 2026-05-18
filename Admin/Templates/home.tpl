<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       home.tpl                                                    ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenekech                                                 ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.               ##
#################################################################################
?>

<!-- HEADER -->
<div style="text-align:center; margin-top:20px;">
    <div style="font-size:20px; font-weight:bold; color:#333;">
        WELCOME TO
        <?php
        if ($_SESSION['access'] == MULTIHUNTER) {
            echo 'MULTIHUNTER';
        } else if ($_SESSION['access'] == ADMIN) {
            echo 'ADMINISTRATOR';
        } else {
            echo 'CONTROL';
        }
        ?>
        CONTROL PANEL
    </div>
</div>

<br /><br />

<!-- USER INFO -->
<?php
$role = '';
$color = '#2c3e50';

if ($_SESSION['access'] == MULTIHUNTER) {
    $role = 'MultiHunter';
    $color = '#e67e22';
} else if ($_SESSION['access'] == ADMIN) {
    $role = 'Administrator';
    $color = '#c0392b';
} else {
    $role = 'User';
}
?>

<div style="text-align:center; font-size:13px; color:#444;">
    Hello <b><?php echo $_SESSION['admin_username']; ?></b>,<br />
    You are logged in as:
    <b style="color:<?php echo $color; ?>">
        <?php echo $role; ?>
    </b>
</div>

<br /><br /><br />

<!-- SPACER -->
<div style="height:60px;"></div>

<!-- CREDITS -->
<div style="
    margin-top:60px;
    padding:12px;
    border-top:1px solid #e5e5e5;
    text-align:center;
    color:#666;
    font-size:11px;
    line-height:18px;
">
    Credits: Akakori & Elmar<br />
    Fixed, remade and new features added by <b>Dzoki</b><br />
    Reworked by <b>aggenkeech</b><br />
    Refactored by <b>Shadow</b>
</div>