<?php
$input = $message->reading['message'];
$alliance = $message->reading['alliance'];
$player = $message->reading['player'];
$coor = $message->reading['coor'];
$report = $message->reading['report'];
include("GameEngine/BBCode.php");
?>
<div id="content"  class="messages">
<h1>Messages</h1>
<?php 
include("menu.tpl");
?>
<form method="post" action="nachrichten.php">
 
<div id="read_head" class="msg_head"></div>
<div id="read_content" class="msg_content">
	<img src="img/x.gif" id="label" class="read" alt="" />
	<div id="heading">
		<div><?php echo $database->getUserField($message->reading['owner'],"username",0); ?></div>
		<div><?php echo $message->reading['topic']; ?></div>
	</div>
	<div id="time">
		<div><?php $date = $generator->procMtime($message->reading['time']);echo $date[0]; ?></div>
		<div><?php echo $date[1]; ?></div>
	</div>
	<div class="clear"></div>
	<div class="line"></div>
	<div class="message"><?php echo stripslashes(nl2br($bbcoded)); ?></div> 
	<input type="hidden" name="id" value="<?php echo $message->reading['id']; ?>" />
    <input type="hidden" name="ft" value="m1" />
	<input type="hidden" name="t" value="1" />
	<p class="btn">
		<input type="image" value="" name="s1" id="btn_reply" class="dynamic_img" src="img/x.gif" alt="answer" />
	</p>
</div>
<div id="read_foot" class="msg_foot"></div>
</form>
 
 
</div>
