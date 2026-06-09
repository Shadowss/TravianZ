<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       2011.11.06                                                  ##
##  Filename:      Templates/Travian/3.6/Tutorial/5.tpl                        ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     TravianZ (c) 2025 - All rights reserved                     ##
##  URLs:          http://travian.shadowss.ro                                  ##
##  Source code:   https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################
?>
<h2><?php echo TZ_N_5_5_NAVIGATION; ?></h2>
            <table class="tutorial_table">
                <tbody>
                    <tr>
                        <td class="visual">
                            <img src="img/en/tut/navi.jpg" alt="" />
                            <?php echo TZ_THE_NAVIGATION_BAR; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="beschreibung"><ol start="1" type="1">
                            <li><b><?php echo TZ_OVERVIEW; ?></b> <?php echo TZ_HERE_YOU_FIND_YOUR_RESOURCE_FIELDS; ?></li>
                            <li><b><?php echo TZ_CENTRE; ?></b> <?php echo TZ_IN_THE_VILLAGE_YOU_CAN_BUILD_BUILD; ?></li>
                            <li><b><?php echo TZ_MAP_2; ?></b> <?php echo TZ_HERE_YOU_CAN_HAVE_A_LOOK_AT_YOUR_V; ?></li>
                            <li><b><?php echo TZ_STATISTICS; ?></b> <?php echo TZ_RANKING_OF_ALL_PLAYERS; ?></li>
                            <li><b><?php echo TZ_REPORTS; ?></b> <?php echo TZ_INFORMATION_ON_HAPPENINGS_IN_YOUR; ?></li>
                            <li><b><?php echo TZ_MESSAGES; ?></b> <?php echo TZ_SEND_AND_RECEIVE_MESSAGES; ?></li></ol>
                        </td>
                    </tr>
                    <tr>
                        <td class="beschreibung">
                            <?php echo TZ_NOW_YOU_KNOW_EVERYTHING_IMPORTANT; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="tutorial_nav">
                <tbody>
                    <tr>
                        <td class="nav_prev">
                            <a href="tutorial.php?s=4" title="<?php echo BACK; ?>">&laquo; back</a>
                        </td>
                        <td class="nav_next">
                            <a href="index.php?signup" title="<?php echo TZ_TO_THE_REGISTRATION; ?>"> &raquo; to the registration</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> 
        <div class="clear"></div> 
    </div>  
    <div id="footer">
        <div class="container">
            <a href="#" class="logo"><img src="img/x.gif" alt="<?php echo TZ_TRAVIAN_GAMES; ?>" class="logo_traviangames" /></a>
            <ul class="menu">
                <li><a href="anleitung.php?s=3"><?php echo FAQ; ?></a>|</li>
                <li><a href="index.php?screenshots"><?php echo SCREENSHOTS; ?></a>|</li>
                <li><a href="spielregeln.php"><?php echo GAME_RULES; ?></a>|</li>
                <li><a href="agb.php"><?php echo TZ_TERMS; ?></a>|</li>
                <li><a href="impressum.php"><?php echo IMPRINT; ?></a></li>
                <li class="copyright">&copy; 2010 - <?php echo date('Y') . ' ' . (defined('SERVER_NAME') ? SERVER_NAME : 'TravianZ');?> All rights reserved</li>
            </ul>
        </div>
    </div>
</div> 
