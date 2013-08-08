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
        <a href="dorf1.php" id="n1" accesskey="1"><img src="img/x.gif" title="Village overview" alt="Village overview" /></a>
        <a href="dorf2.php" id="n2" accesskey="2"><img src="img/x.gif" title="Village centre" alt="Village centre" /></a>
        <a href="karte.php" id="n3" accesskey="3"><img src="img/x.gif" title="Map" alt="Map" /></a>
        <a href="statistiken.php" id="n4" accesskey="4"><img src="img/x.gif" title="Statistics" alt="Statistics" /></a>
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
            <a href="berichte.php" accesskey="5"><img src="img/x.gif" class="l" title="Reports" alt="Reports"/></a>
            <a href="nachrichten.php" accesskey="6"><img src="img/x.gif" class="r" title="Messages" alt="Messages" /></a>
        </div>


        <a href="plus.php" id="plus">
        <span class="plus_text">
            <span class="plus_g">P</span>
            <span class="plus_o">l</span>
            <span class="plus_g">u</span>
            <span class="plus_o">s</span>
       </span><img src="img/x.gif" id="btn_plus" class="<?php echo ($session->plus == 1 && strtotime("NOW") <= $session->userinfo['plus'])? 'active' : 'inactive';?>" title="Plus menu" alt="Plus menu" /></a>

<style>

.day_image {
    background-image: url("../gpack/travian_default/img/l/day.gif");
width: 18px;
height:18px;
}
.night_image {
      background-image: url("../gpack/travian_default/img/l/night.gif");
width: 18px;
height:18px;
}
  #container {
    width: 30px;
    height: 60px;
    position: relative;
  }
  #wrapper > #container {
    display: table;
    position: static;
  }
  #container div {
    position: absolute;
    top: 50%;
  }
  #container div div {
    position: relative;
    top: -50%;
  }
  #container > div {
    display: table-cell;
    vertical-align: middle;
    position: static;
  }
</style>
<?php
$hour = date('Hi'); 
if ($hour > 1759 or $hour < 500) {
$day_night_img = 'night_image';
} elseif ($hour > 1200) {
$day_night_img = 'day_image';
} else {
$day_night_img = 'day_image';
}
?>
<div id="wrapper">
  <div id="container">
 <div><div><p><img src="img/x.gif" style="display: block; margin: 0 auto; vertical-align:middle;" class="<?php echo $day_night_img;?>"  /></p></div></div>
  </div>
</div>
        <div class="clear"></div>
    </div>
</div>
