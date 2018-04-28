<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       newmessage.tpl                                              ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

error_reporting(E_ALL ^ E_NOTICE);

$id = $_GET['uid'];
if(isset($id))
{
	$varray = $database->getProfileVillages($id);
	$varmedal = $database->getProfileMedal($id); ?>

	<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
	<style type="text/css">
		input.dynamic_img, img.dynamic_img
		{
			background-position: center top;
			height: 20px;
		}
		input#btn_send
		{
			width: 97px;
			background-image: url(../<?php echo GP_LOCATE; ?>lang/en/b/send.gif);
		}
		div.messages div#write_content #heading input
		{

		}
	</style>

	<h4>Compose New Message to <a href="admin.php?p=player&uid=<?php echo $user['id'] ?>"><?php echo $user['username']; ?></a></h4>

	<form method="post" action="../Admin/Mods/sendMessage.php" accept-charset="UTF-8" name="msg">
	<div id="content" class="messages">
		<div id="read_head" class="msg_head"></div>
		<div id="read_content" class="msg_content">
			<img src="../../<?php echo GP_LOCATE; ?>lang/en/msg/block_bg24b.gif" id="label" class="read" alt="">

			<div id="heading">
				<input type="hidden" name="uid" value="<?php echo $id; ?>">
				<div><a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></div>
				<div><input type="text" value="Message From Admin" name="topic" id="subject" value="" maxlength="35" style="background-image: url('../<?php echo GP_LOCATE; ?>img/msg/underline.gif'); background-position: left -2px; background-repeat: repeat-x; outline: none; border: medium none; width: 267px; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px;"></div>
			</div>
			<div id="time">
				<div><?php echo date('d.m.y'); ?></div>
				<div><?php echo date('H:i:s'); ?></div>
			</div>
			<div class="clear"></div>
			<div class="line"></div>
			<div class="message" style="margin-top: 10px;">
				<textarea id="message" name="message" style="background-image: url('../<?php echo GP_LOCATE; ?>img/msg/underline.gif'); background-repeat: repeat; font-size: 12px; border: medium none; height: 258px; line-height: 16px; width: 412px; font-family: Verdana,Arial,Helvetica,sans-serif;">Message Here</textarea>
			</div>
			<p class="btn">
				<button value="submit" name="s1" id="btn_send" class="trav_buttons" alt="send" tabindex="4;">Send</button>
			</p>
			<div id="read_foot" class="msg_foot"></div>
		</div>
		<br /><br /><br />
	</div>
	<?php
	if(isset($_GET['msg']))
	{
		echo "<font color=\"blue\">Message Sent</font>";
	}
	else
	{
		echo '';
	}
}
else
{
	echo "<br /><br />Not found. <a href=\"javascript: history.go(-1)\"> Go Back</a>";
}?>
