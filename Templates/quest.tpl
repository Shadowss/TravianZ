<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       quest.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

if ($_SESSION['qst']<38 && QUEST==true){?>

<div id="anm" style="width:120px; height:140px; visibility:hidden;"></div>
			<div id="qge">
				<?php if ($_SESSION['qst']==0 or $_SESSION['qstnew']==1){ ?>
				<img onclick="qst_handle();" src="<?php echo GP_LOCATE; ?>img/q/l<?php echo $session->userinfo['tribe'];?>g.jpg" title="to the task" style="height:174px" alt="to the task" />
				<?php }else{?>
				<img onclick="qst_handle();" src="<?php echo GP_LOCATE; ?>img/q/l<?php echo $session->userinfo['tribe'];?>.jpg" title="to the task" style="height:174px" alt="to the task" />
				<?php } ?>
			</div>
			<script type="text/javascript">
				<?php if ($_SESSION['qst']==0){ ?>
				quest.number=null;
				<?php }else{ ?>
				quest.number=0;
				<?php } ?>
				quest.last = 37;
				cache_preload = new Image();
				cache_preload.src = "img/x.gif";
				cache_preload.className = "wood";
			</script>						
<?php } ?>

