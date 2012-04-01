<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.05                                                  ##
##  Filename:      Templates/Admin/home.tpl                                    ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################
?>
<br />
<font size="3">
    <b>
        <center>
            WELCOME TO <?php if($_SESSION['access'] == MULTIHUNTER) { echo 'MULTIHUNTER';	} else if($_SESSION['access'] == ADMIN){ echo 'ADMINISTRATOR'; } ?> CONTROL PANEL
        </center>
    </b>
</font>
<br />
<br />
<br />
<br />
Hello <b><?php echo $_SESSION['username']; ?></b>:
<br />
<br />
<center>
    You are logged in as <b><?php if($_SESSION['access'] == MULTIHUNTER) { echo '<font color="Blue">Multihunter</font>'; } else if($_SESSION['access'] == ADMIN){ echo '<font color="Red">Administrator</font>'; } ?></b>
</center>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<font color="#c5c5c5" size="1">
	Credits: Akakori, Elmar, Dzoki & ZZJHONS
    <br />
	Fixed, remade and new features added by <b>Dzoki</b>
    <br />
    Reworked by <b>ZZJHONS</b>
</font>