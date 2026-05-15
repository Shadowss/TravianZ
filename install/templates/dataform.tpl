<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       dataform.php                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

include_once('../GameEngine/config.php');

if(isset($_GET['c']) && $_GET['c'] == 1) {
	echo "<div class=\"headline\"><span class=\"f10 c5\">Error importing database. Check configuration.</span></div><br>";
}

if(isset($_GET['err']) && $_GET['err'] == 1) {
	echo "<br /><hr /><br /><div class=\"headline\"><span class=\"f10 c5\">Existing structure was found in the database! Please remove old game tables with the <i>".TB_PREFIX."</i> prefix from the '<strong>".SQL_DB."</strong>' database before continuing.</span></div><br /><br />";
}
?>
<form action="process.php" method="post" id="dataform">
	<input type="hidden" name="substruc" value="1">

	<p>
	    <span class="f10 c">Create Database Structure</span>
	
		<table>
			<tr>
				<td>
					<b>Warning</b>: This can take some time. Please wait until the next page has been loaded. Click Create to proceed...
					<br>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<input type="submit" name="Submit" id="Submit" value="Create..." onClick="return proceed()">
						<br>
						<br>
					</center>
				</td>
			</tr>
		</table>
	</p>
</form>
</div>
