<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       report.tpl                                                     ##
##  Developed by:  Armando                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
include_once("../GameEngine/Generator.php");
include_once("../GameEngine/Technology.php");
include_once("../GameEngine/Message.php");
if ($_GET['bid']){
$rep = $database->getNotice4($_GET['bid']);
}else
$sql = "SELECT * FROM ".TB_PREFIX."ndata ORDER BY time DESC ";
$result = mysql_query($sql);
$rep1 = $database->mysql_fetch_all($result);
if($rep1)
{
	//$att = $database->getUserArray($rep1['uid'],1);
	?>
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>travian.css?e21d2" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css">
	<h1>Under Construction</h1>
	<div id="content" class="reports" style="padding: 0;">
	<?php
		include("Notice/all.tpl");
	?>
	</div>
	<?php
}
if($rep)
{ ?>
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>travian.css?e21d2" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css">
	
	<br />

	<span class="b">reporte de</span>: <?php echo $database->getUserField($rep[0]['uid'],'username',0);?><br />

	<div id="content" class="reports">
		<h1>Reporte</h1>
<?php 
$type = $rep[0]['ntype'];
		include("Notice/".$type.".tpl");

}
else
{
	echo "Report ID ".$_GET['bid']." doesn't exist!";
}

?>
