<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       field.tpl                                                   ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error creating wdata. Check configuration or file.</span></div><br>";
}
?>
<form action="process.php" method="post" id="dataform">
<input type="hidden" name="subwdata" value="1">

        <p>
        <span class="f10 c">Create World Data</span>
<table>
<tr><td><b>Warning</b>: This can take some time. Wait till the next page has been loaded! Click Create to proceed..</td></tr>
<tr><td><center><input type="submit" name="Submit" id="Submit" value="Create.." onClick="return proceed()"></center></td></tr>
</table>
        </p>
</form>
</div>
