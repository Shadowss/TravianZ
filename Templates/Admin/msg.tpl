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
?>
<?php
$msg = $database->getMessage($_GET['nid'],3);;
if($msg){
?>
<div id="content" class="messages">
<h1>Messages</h1>

<div id="read_head" class="msg_head"></div>
<div id="read_content" class="msg_content">
	<img src="img/x.gif" id="label" class="read" alt="">
	<div id="heading">
		<div><span class="b">From</span>: <?php echo $database->getUserField($msg[0]['owner'],'username',0);?></div>
		<div><span class="b">To</span>: <?php echo $database->getUserField($msg[0]['target'],'username',0);?></div>
		<div><span class="b">Topic</span>: <?php echo $msg[0]['topic'];?> 
      <div style="float:right;"><?php echo date('d.m.y H:i',$msg[0]['time']);?></div>
    </div>
	</div>   
	<div class="clear"></div>
	<div id="line"></div>
	<div class="message" style="margin-top: 10px;">
    <?php echo $msg[0]['message'];?>
  </div> 
</div>
<div id="read_foot" class="msg_foot"></div>
</form>  
</div>
<?php
}else{
echo "Message id ".$_GET['nid']." wasn´t found.";
}
?>