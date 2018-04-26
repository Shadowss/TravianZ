<div id="content"  class="messages">
<h1>Messages</h1>
<?php 
include("menu.tpl");
?>
<form method="post" action="nachrichten.php">
<div id="block">
	<input type="hidden" name="ft" value="m6" />
	<textarea name="notizen" id="notice"><?php echo $message->note; ?></textarea>
	<p class="btn"><button id="btn_save" value="" name="s1" class="trav_buttons" alt"save" /> Save </button><br />
	&nbsp;</p>
</div>
</form>
 
</div>
