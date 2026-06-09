<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       2011.11.06                                                  ##
##  Filename:      Templates/Travian/3.6/Tutorial/2.tpl                        ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     TravianZ (c) 2025 - All rights reserved                     ##
##  URLs:          http://travian.shadowss.ro                                  ##
##  Source code:   https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################
?>
<h2><?php echo TZ_N_2_5_RESOURCES; ?></h2>
            <table class="tutorial_table">
                <tbody>
                    <tr>
                        <td class="visual">
                            <img src="img/en/tut/rohstofffeld.gif" alt="" />
                            <?php echo TZ_N_1_CHOOSE_A_RESOURCE_FIELD; ?>
                        </td>
                        <td class="visual">
                            <img src="img/en/tut/rohstofffeld2.gif" alt="" />
                            <?php echo TZ_N_2_EXTEND_THE_RESOURCE_FIELD; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="beschreibung" colspan="2">
                            <?php echo TZ_THERE_ARE_FOUR_DIFFERENT_TYPES_OF; ?>
                            <br><br>
                            <?php echo TZ_BEFORE_YOU_EXPAND_YOUR_VILLAGE_S_B; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="tutorial_nav">
                <tbody>
                    <tr>
                        <td class="nav_prev">
                            <a href="tutorial.php" title="<?php echo BACK; ?>">&laquo; back</a>
                        </td>
                        <td class="nav_next">
                            <a href="tutorial.php?s=3" title="<?php echo TZ_FORWARD; ?>">forward &raquo;</a>
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
