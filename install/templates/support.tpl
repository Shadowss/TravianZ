<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       support.tpl                                             ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################
	rename("include/constant.php","../GameEngine/config.php");
?>



<form action="include/support.php" method="post" id="dataform">

<p>
	<span class="f10 c">Create Support account</span>
		<table>
			<tr><td>Name:</td><td><input type="text" name="sname" value="Support" disabled="disabled"></td></tr>
			<tr><td>Password:</td><td><input type="text" name="spw" id="spw" value=""></td></tr>
			<tr><td>Note: Rember this password! You need it for the ACP</td><td></td></tr>
		</table>
</p>

	<center>
	<input type="submit" name="Submit" id="Submit" value="Submit"></center>
</form>

</div>
