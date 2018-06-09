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
include_once("../GameEngine/Generator.php");
include_once("../GameEngine/Technology.php");
include_once("../GameEngine/Message.php");

if(isset($_GET['nid']) && is_numeric($_GET['nid'])) $msg = $database->getMessage($_GET['nid'], 3);
else
{
    $sql = "SELECT * FROM " . TB_PREFIX . "mdata ORDER BY time DESC ";
    $result = mysqli_query($GLOBALS["link"], $sql);
    $allMessages = $database->mysqli_fetch_all($result);
}

if(!empty($allMessages)){
    ?>
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>travian.css?e21d2" rel="stylesheet" type="text/css">
	<h1>Players Message</h1>
	<div id="content" class="messages" style="padding: 0;">
	<?php
		include("Message/inbox.tpl");
	?>
	</div>
	<?php
}
elseif(!empty($msg)){
?>
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>travian.css?e21d2" rel="stylesheet" type="text/css">
	<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css">


	<br />

	<span class="b">Sent to</span>: <?php echo $database->getUserField($msg[0]['target'],'username',0);?>

	<div style="padding: 43px 0 0;" id="content" class="messages">
		<h1>Message</h1>
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
<?php 
$input = $msg[0]['message'];
$alliance = $msg[0]['alliance'];
$player = $msg[0]['player'];
$coor = $msg[0]['coor'];
$report = $msg[0]['report'];
include("../GameEngine/BBCode.php");
echo stripslashes(nl2br($bbcoded));
?>
			</div>
	</div>
	<div id="read_foot" class="msg_foot"></div>
	</div><?php
}
else echo "Message ID ".$_GET['nid']." doesn't exist!";
?>