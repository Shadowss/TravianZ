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

$msg = $database->getMessage($_GET['nid'],3);;
if($msg)
{ ?>
	<link href="../gpack/travian_default/lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css">
	<link href="../gpack/travian_default/lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css">
	<link href="../gpack/travian_default/travian.css?e21d2" rel="stylesheet" type="text/css">
	<link href="../gpack/travian_default/lang/en/lang.css?e21d2" rel="stylesheet" type="text/css">
	
	
	<br />
	
	<span class="b">Send To</span>: <?php echo $database->getUserField($msg[0]['target'],'username',0);?><br />
	
	<div id="content" class="messages">
		<h1>Messages</h1>
		<div id="read_head" class="msg_head"></div>
		<div id="read_content" class="msg_content">
			<img src="../img/x.gif" id="label" class="read" alt="">
			<div id="heading">
				<div><?php echo $database->getUserField($msg[0]['owner'],'username',0);?></div>
				<div><?php echo $msg[0]['topic'];?></div>
			</div>
			<div id="time">
				<div><?php echo date('d.m.y',$msg[0]['time']);?></div>
				<div><?php echo date('H:i:s',$msg[0]['time']);?></div>
			</div>
			<div class="clear"></div>
			<div class="line"></div>
			<div class="message" style="min-height: 10px;">
				<?php echo $msg[0]['message'];?>
			</div>
	</div>
	<div id="read_foot" class="msg_foot"></div>
	</div><?php
}
else
{
	echo "Message ID ".$_GET['nid']." doesn't exist!";
}
?>