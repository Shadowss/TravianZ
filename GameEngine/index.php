<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       index.php                                                   ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

// Send proper 404 header if not already sent
if (!headers_sent()) {
    header("HTTP/1.1 404 Not Found");
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");
}
?>
<div style="margin-top: 50px;">
    <div style="text-align: center">
        <h1>404 - File not found</h1>
        <img src="../../gpack/travian_default/img/misc/404.gif" 
             title="Not Found" 
             alt="Not Found"><br />
        <p>We looked 404 times already but can't find anything, Not even an X marking the spot.</p>
        <p>This system is not complete yet. So the page probably does not exist.</p><br>
    </div>
</div>