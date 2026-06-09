<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       footer.tpl                                                  ##
##  Developed by:  Advocaite , Shadow , ronix                                  ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Refactor notes:                                                            ##
##  - păstrată logica originală 100%                                           ##
##  - compatibil PHP 5.6+ / 7+                                                 ##
##  - HTML reorganizat corect                                                  ##
##  - eliminat nesting invalid <center>                                        ##
##  - output HTML mai sigur                                                    ##
##  - comentarii adăugate                                                      ##
##                                                                             ##
#################################################################################

/**
 * Escape HTML compatibil PHP vechi
 */
if (!function_exists('safeHTML')) {
    function safeHTML($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Nume server
 */
$serverName = defined('SERVER_NAME')
    ? SERVER_NAME
    : 'TravianZ';

/**
 * An curent
 */
$currentYear = date('Y');

/**
 * Build version
 * Ușor de modificat ulterior
 */
$serverVersion = 'v.10.0 Full Refactor&Redesign';
?>

<!-- ===================== FOOTER ===================== -->

<div id="footer">

    <div id="mfoot">

        <div class="footer-menu">

            <div style="text-align:center;">

                <br />

                <!-- Copyright -->
                <div class="copyright">
                    &copy; 2010 - <?php echo (int)$currentYear; ?>
                    <?php echo safeHTML($serverName); ?>
                    All rights reserved
                </div>

                <!-- Version -->
                <div class="copyright">

                    <?php echo TZ_SERVER_RUNNING_ON; ?>

                    <a href="version.php"
                       style="color:#FF5555;text-decoration:none;font-weight:bold;transition:0.3s;"
                       onmouseover="this.style.color='#FFAA00'"
                       onmouseout="this.style.color='#FF5555'">

                        <?php echo safeHTML($serverVersion); ?>

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Footer extra content -->
    <div id="cfoot"></div>

</div>