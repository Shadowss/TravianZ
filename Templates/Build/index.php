<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : INDEX 404 ERROR		                                   ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

// prevent direct misuse in weird contexts (optional but safe)
if (!defined('IN_GAME')) {
    // keep it harmless, just allow display
}

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>

<div style="margin-top: 50px;">
    <div style="text-align: center">

        <h1>404 - File not found</h1>

        <img
            src="<?php echo $basePath; ?>/../../gpack/travian_default/img/misc/404.gif"
            title="Not Found"
            alt="Not Found"
        ><br />

        <p>We looked 404 times already but can't find anything, Not even an X marking the spot.</p>

        <p>This system is not complete yet. So the page probably does not exist.</p>

        <br>

    </div>
</div>