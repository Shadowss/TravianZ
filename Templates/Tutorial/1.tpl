<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       2011.11.06                                                  ##
##  Filename:      Templates/Travian/3.6/Tutorial/1.tpl                        ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     TravianZ (c) 2025 - All rights reserved                     ##
##  URLs:          http://travian.shadowss.ro                                  ##
##  Source code:   https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################
?>
<h2><?php echo TZ_N_1_5_YOUR_VILLAGE; ?></h2>
            <table class="tutorial_table">
                <tbody>
                    <tr>
                        <td class="visual">
                            <img src="img/en/tut/dorf_klein.jpg" alt="" />
                            <?php echo TZ_THIS_IS_HOW_YOU_START; ?>
                        </td>
                        <td class="visual">
                            <img src="img/en/tut/dorf_gross.jpg" alt="" />
                            <?php echo TZ_AND_LATER_YOUR_VILLAGE_COULD_LOOK; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="beschreibung" colspan="2">
                            <?php echo TZ_IN_THE_BEGINNING_YOUR_SMALL_VILLAG; ?>
                            <br /><br />
                            <?php echo TZ_WE_WILL_SHOW_YOU_HOW_TO_EXPAND_YOU; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="tutorial_nav">
                <tbody>
                    <tr>
                        <td class="nav_prev">
                            <a href="index.php" title="<?php echo BACK; ?>">&laquo; back</a>
                        </td>
                        <td class="nav_next">
                            <a href="tutorial.php?s=2" title="<?php echo TZ_FORWARD; ?>">forward &raquo;</a>
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
