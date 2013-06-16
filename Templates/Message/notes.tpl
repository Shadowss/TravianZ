<div id="content"  class="messages">
<h1>Messages</h1>
<?php 
include("menu.tpl");
?>
<form method="post" action="nachrichten.php">
<div id="block">
	<input type="hidden" name="ft" value="m6" />
	<textarea name="notizen" id="notice"><?php echo $message->note; ?></textarea>
	<p class="btn"><input id="btn_save" type="image" value="" name="s1" src="img/x.gif" class="dynamic_img" alt"save" /><br />
	&nbsp;</p>
</div>
</form>
 
</div>
