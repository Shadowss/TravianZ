<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianZ Project All rights reserved       |
\** --------------------------------------------------- **/

?><?php
if(!$session->logged_in) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title></title>
    <style type="text/css">
div.c1 {text-align: center}
    </style>
</head>

<body>
    <div id="side_navi">
        <a id="logo" href="<?php echo HOMEPAGE; ?>" name="logo"><img src="img/x.gif" alt="Travian"></a>

        <p><a href="<?php echo HOMEPAGE; ?>"><?php echo HOME; ?></a> <a href="login.php"><?php echo LOGIN; ?></a> <a href="anmelden.php"><?php echo REG; ?></a></p>
    </div><?php
    }
    else {
    ?>

    <div id="side_navi">
        <a id="logo" href="<?php echo HOMEPAGE; ?>" name="logo"><img src="img/x.gif" <?php if($session->plus) { echo "class=\"logo_plus\""; } ?> alt="Travian"></a>


        <p><a href="<?php echo HOMEPAGE; ?>"><?php echo HOME; ?></a> <a href="#" onclick="return Popup(0,0,1);"><?php echo $lang['index'][0][2]; ?></a> <a href="spieler.php?uid=<?php echo $session->uid; ?>"><?php echo PROFILE; ?></a> <?php if($session->access == MULTIHUNTER) {

                    echo "<a href=\"Admin/admin.php\"><font color=\"Blue\">Multihunter Panel</font></a>";
                    } ?> <?php if($session->access == ADMIN) {
                    echo "<a href=\"Admin/admin.php\"><font color=\"Red\">".ADMIN_PANEL."</font></a>";
                    echo "<a href=\"massmessage.php\">".MASS_MESSAGE."</a>";
					echo '<a href="build_croppers.php">Build Cropper</a>';
                    echo "<a href=\"sysmsg.php\">".SYSTEM_MESSAGE."</a>";
                    } ?> <a href="logout.php"><?php echo LOGOUT;?></a></p>
        <p>
            <a href="allianz.php?s=2"><?php echo FORUM;?></a>
        </p>
        <p>
		    <?php
        	// no PLUS needed for Support
        	    if ($_SESSION['id_user'] != 1) {
            ?>
			<a href="plus.php?id=3"><!--<?php echo SERVER_NAME; ?>-->TravianZ <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></b></a>
            <?php
        	    }
            	// no support for support :-D
            	if ($_SESSION['id_user'] != 1) {
            ?>
            <a href="spieler.php?uid=1"><?php echo SUPPORT;?></a>
            <?php
            	}
            	if(NEW_FUNCTIONS_DISPLAY_LINKS) include("Templates/links.tpl");
            	include("Templates/natars.tpl")
            ?>
        </p>
		<?php
		$timestamp = $database->isDeleting($session->uid);
		if($timestamp){
		echo "<br /><td colspan=\"2\" class=\"count\">";
		
		if($timestamp > time() + 172800){
			echo "<a href=\"spieler.php?s=3&id=" . $session->uid . "&a=1&e=4\"><img
			class=\"del\" src=\"img/x.gif\" alt=\"Cancel process\"
			title=\"Cancel process\" /> </a>";
		}
		
		$time = $generator->getTimeFormat(($timestamp - time()));
		echo "<a href=\"spieler.php?s=3\"> The account will be deleted in <span
		id=\"timer" . ++$session->timer . "\">" . $time . "</span> .</a></td><br />";
		}
		?>
    </div><?php
    if($_SESSION['ok'] == 1){
    ?>

    <div id="content" class="village1">
        <h1><?php echo ANNOUNCEMENT; ?></h1>
		<br />
        <h3>Hi <?php echo $session->username; ?>,</h3>
        <?php include("Templates/text.tpl"); ?>
        <div class="c1">
		<br />
            <h3><a href="dorf1.php?ok">&raquo; <?php echo GO2MY_VILLAGE; ?></a></h3>
        </div>
    </div>

    <br /><br /><br /><br /><div id="side_info">
        <?php 
        include("Templates/multivillage.tpl");
        include("Templates/quest.tpl");
        include("Templates/news.tpl");
		if(!NEW_FUNCTIONS_DISPLAY_LINKS) {
			echo "<br><br><br><br>";
			include("Templates/links.tpl");
		}
        ?>
    </div>

    <div class="clear"></div>

    <div class="footer-stopper"></div>

    <div class="clear"></div><?php
    include("Templates/footer.tpl");
    include("Templates/res.tpl");
    ?>

    <div id="stime">
        <div id="ltime">
            <div id="ltimeWrap">
                <?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
?></b> ms

<br /><?php echo SERVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
            </div>
        </div>
    </div>

    <div id="ce"></div><?php
    die();
    }
    }
    ?>
</body>
</html>
