<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       header.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<div id="header">
    <div id="mtop">
        <a href="dorf1.php" id="n1" accesskey="1"><img src="img/x.gif" title="<?php echo $lang['header'][0]; ?>" alt="<?php echo $lang['header'][0]; ?>" /></a>
        <a href="dorf2.php" id="n2" accesskey="2"><img src="img/x.gif" title="<?php echo $lang['header'][1]; ?>" alt="<?php echo $lang['header'][1]; ?>" /></a>
        <a href="karte.php" id="n3" accesskey="3"><img src="img/x.gif" title="<?php echo $lang['header'][2]; ?>" alt=<?php echo $lang['header'][2]; ?>" /></a>
        <a href="statistiken.php" id="n4" accesskey="4"><img src="img/x.gif" title="<?php echo $lang['header'][3]; ?>" alt="<?php echo $lang['header'][3]; ?>" /></a>
        <?php
        if($message->unread && !$message->nunread) {
        $class = "i2";
        }
        else if(!$message->unread && $message->nunread) {
        $class = "i3";
        }
        else if($message->unread && $message->nunread) {
        $class = "i1";
        }
        else {
        $class = "i4";
        }
        ?>
          <div id="n5" class="<?php echo $class ?>">
            <a href="berichte.php" accesskey="5"><img src="img/x.gif" class="l" title="<?php echo $lang['header'][4]; ?>" alt="<?php echo $lang['header'][4]; ?>"/></a>
            <a href="nachrichten.php" accesskey="6"><img src="img/x.gif" class="r" title="<?php echo $lang['header'][5]; ?>" alt="<?php echo $lang['header'][5]; ?>" /></a>
        </div>
        <a href="plus.php" id="plus">
        <span class="plus_text">
            <span class="plus_g">P</span>
            <span class="plus_o">l</span>
            <span class="plus_g">u</span>
            <span class="plus_o">s</span>
       </span><img src="img/x.gif" id="btn_plus" class="<?php echo ($session->plus == 1 && strtotime("NOW") <= $session->userinfo['plus'])? 'active' : 'inactive';?>" title="<?php echo $lang['header'][6]; ?>" alt="<?php echo $lang['header'][6]; ?>" /></a>
       
        <div class="clear"></div>
    </div>
</div>