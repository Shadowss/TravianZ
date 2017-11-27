<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
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


        <p><a href="<?php echo HOMEPAGE; ?>"><?php echo HOME; ?></a> <a href="spieler.php?uid=<?php echo $session->uid; ?>"><?php echo PROFILE; ?></a> <a href="#" onclick="return Popup(0,0,1);"><?php echo INSTRUCT; ?></a> <?php if($session->access == MULTIHUNTER) {

                    echo "<a href=\"Admin/admin.php\"><font color=\"Blue\">Multihunter Panel</font></a>";
                    } ?> <?php if($session->access == ADMIN) {
                    echo "<a href=\"Admin/admin.php\"><font color=\"Red\">".ADMIN_PANEL."</font></a>";
                    echo "<a href=\"massmessage.php\">".MASS_MESSAGE."</a>";
                    echo "<a href=\"sysmsg.php\">".SYSTEM_MESSAGE."</a>";
					echo "<a href=\"create_account.php\">Create Natars</a>";
                    } ?> <a href="logout.php"><?php echo LOGOUT;?></a></p>
        <?php
        	// no PLUS needed for Support
        	if ($_SESSION['id_user'] != 1) {
        ?>
        <p>
            <a href="plus.php?id=3"><?php echo SERVER_NAME; ?> <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></b></a>
        </p>
        <?php
        	}
        ?>
        <p>
            <a href="rules.php"><b><?php echo GAME_RULES;?></b></a>
            <?php
            	// no support for support :-D
            	if ($_SESSION['id_user'] != 1) {
            ?>
            <a href="support.php"><b><?php echo SUPPORT;?></b></a>
            <?php
            	}
            ?>
        <br></p>

        <b>VOTE FOR US</b>
        <br /><br />

        <!-- SERVER VOTING //-->
        <a href="http://topg.org/travian-private-servers/in-474476" target="_blank"><img src="http://topg.org/topg2.gif" width="88" height="31" border="0" alt="travian private servers"></a><br /><br />
        <a href="http://www.arena-top100.com/index.php?a=in&u=ZathrusWriter"><img src="http://www.arena-top100.com/button.php?u=ZathrusWriter&buttontype=static" alt="Travian Private Servers" title="Travian Private Servers" /></a><br /><br />
        <a href="http://www.gtop100.com/topsites/Travian/sitedetails/TRAVIANZ--LATEST-UPDATES-93181?vote=1" title="Travian Private Server" target="_blank"><img src="http://www.gtop100.com/images/votebutton.jpg" border="0" alt="Travian Private Server"></a><br /><br />
        <a href="http://www.mmorpgprivateserver.com/Travian-Private-Server/?v=ZathrusWriter" title="Travian Private Server" rev="vote-for" rel="directory" target="_blank"><img src="http://www.mmorpgprivateserver.com/Travian-Private-Server.gif" alt="" /></a><noscript><a href="http://www.mmorpgprivateserver.com/" title="" rev="vote-for" rel="tag directory"></a><a href="http://www.mmorpgprivateserver.com/Travian-Private-Server/" title="Travian" rev="vote-for" rel="tag directory">Travian Private Server</a></noscript><br /><br />
        <div style="width:88px"><a href="http://www.topmmorpgservers.com/in/ZathrusWriter" title="Toplist Travian P Servers"><img src="http://www.topmmorpgservers.com/images/button.png" alt="Top Travian Private Servers" border="0"></a></div>


        <br>
        <br>
		<?php
		$timestamp = $database->isDeleting($session->uid);
		if($timestamp) {
		echo "<td colspan=\"2\" class=\"count\">";
		if($timestamp > time()+48*3600) {
		echo "<a href=\"spieler.php?s=3&id=".$session->uid."&a=1&e=4\"><img
		class=\"del\" src=\"img/x.gif\" alt=\"Cancel process\"
		title=\"Cancel process\" /> </a>";
		}
		$time=$generator->getTimeFormat(($timestamp-time()));
        echo "<a href=\"spieler.php?s=3\"> The account will be deleted in <span
		id=\"timer1\">".$time."</span> .</a></td>";
		}
		?>
    </div><?php
    if($_SESSION['ok']=='1'){
    ?>

    <div id="content" class="village1">
        <h1><?php echo ANNOUNCEMENT; ?></h1>
</br>
        <h3>Hi <?php echo $session->username; ?>,</h3>
        <?php include("Templates/text.tpl"); ?>
        <div class="c1">
		</br>
            <h3><a href="dorf1.php?ok">&raquo; <?php echo GO2MY_VILLAGE; ?></a></h3>
        </div>
    </div>

    <div id="side_info">
        <?php
        include("Templates/quest.tpl");
        include("Templates/news.tpl");
        include("Templates/multivillage.tpl");
        include("Templates/links.tpl");
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
                Calculated in <b><?php
                echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
                ?></b> ms
                <br>
                Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
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
