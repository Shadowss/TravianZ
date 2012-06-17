<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       msg.tpl                                                     ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

$sql = "SELECT * FROM ".TB_PREFIX."ndata WHERE id = ".$_GET['bid']."";
$result = mysql_query($sql);
$rep = mysql_fetch_assoc($result);
if($rep)
{
	$att = $database->getUserArray($rep['uid'],1);
	?>
	<h1>Under Construction</h1>
	<div id="content" class="reports" style="padding: 0;">
	<?php
		include("report/".$rep['ntype'].".tpl");
	?>
	</div>
	<?php
}
else
{
	echo "Report ID ".$_GET['bid']." doesn't exist!";
}
?>