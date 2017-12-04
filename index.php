<?php
use App\Utils\AccessLogger;

#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.30                                                  ##
##  Filename:      index.php                            					   ##
##  Developed by:  Dzoki & Advocaite & Donnchadh                               ##
##  Reworked by:   ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

if(!file_exists('var/installed') && @opendir('install')) {
    header("Location: install/");
    exit;
}

include_once("GameEngine/config.php");
/*
if($_SERVER['HTTP_HOST'] != '.SERVER.')
{
    header('location: '.SERVER.'');
    exit;
}
*/

// delete the /* and the */ if you not use localhost.

error_reporting(E_ALL || E_NOTICE);

if(file_exists('Security/Security.class.php'))
{
    require 'Security/Security.class.php';
    Security::instance();
}
else
{
    die('Security: Please activate security class!');
}

include_once "GameEngine/Database.php";
include_once "GameEngine/Lang/".LANG.".php";

AccessLogger::logRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo SERVER_NAME; ?></title>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="gpack/travian/main.css" />
	<link rel="stylesheet" type="text/css" href="gpack/travian/flaggs.css" />
	<link rel="stylesheet" type="text/css" href="gpack/travian/main_en.css" />
	<meta name="content-language" content="<?php echo LANG; ?>" />
	<meta http-equiv="imagetoolbar" content="no" />
	<script src="mt-core.js" type="text/javascript"></script>
	<script src="new.js?22102017" type="text/javascript"></script>
	<script src="new2.js?22102017" type="text/javascript"></script>
	<style type="text/css">
		<!-- li.c4 {background-image:url('img/en/welten/en1_big.jpg');} -->
		<!-- li.c3 {background-image:url('img/en/welten/en1_big_g.jpg');} -->
		div.c2 {left:237px;}
		ul.c1 {position:absolute; left:0px; width: 686px;}
	</style>
</head>

<body class="presto indexPage">
	<div class="wrapper">
		<div id="country_select">
			<div id="flags"></div>
			<script src="flaggen.js?a" type="text/javascript"></script>
			<script type="text/javascript">
			var region_list = new Array('Europe','America','Asia','Middle East','Africa','Oceania');
			show_flags('', '', region_list);
			</script>
		</div>
		<div id="header"><h1><?php echo $lang['index'][0][1]; ?></h1></div>
		<div id="navigation">
			<a href="index.php" class="home"><img src="img/x.gif" alt="Travian" /></a>
			<table class="menu">
				<tr>
					<td><a href="tutorial.php"><span><?php echo TUTORIAL; ?></span></a></td>
					<td><a href="anleitung.php"><span><?php echo $lang['index'][0][2]; ?></span></a></td>
					<td><a href="http://forum.travian.com/" target="_blank"><span><?php echo FORUM; ?></span></a></td>
					<td><a href="?signup" class="signup_link mark"><span><?php echo $lang['register']; ?></span></a></td>
					<td><a href="?login" class="login_link"><span><?php echo LOGIN; ?></span></a></td>
				</tr>
			</table>
		</div>
		<?php
		if(T4_COMING==true){
		?>
		<div id="t4play">
		<a href="notification/">
		<img src="img/t4n/Teaser_Prelandingpage_EN.png" alt="Travian 4" />
		</a>
		</div>
		<?php } ?>
		<div id="register_now">
			<a href="?signup" class="signup_link"><?php echo $lang['register']; ?></a>
			<span><?php echo PLAY_NOW; ?></span>
		</div>
		<div id="content">
			<div class="grit">
				<div class="infobox">
					<div id="what_is_travian">
						<h2><?php echo $lang['index'][0][4]; ?></h2>
						<p><?php echo $lang['index'][0][5]; ?></p>
						<p class="play_now"><a href="?signup" class="signup_link"><?php echo $lang['index'][0][6]; ?></a></p>
					</div>
					<div id="player_counter">
						<table>
							<tbody>
								<tr>
									<th><?php

										   echo $lang['index'][0][7];

									?>:</th>

									<td><?php

											$return=mysqli_query($link,"SELECT Count(*) as Total FROM " . TB_PREFIX . "users WHERE tribe!=0 AND tribe!=4 AND tribe!=5");
											$users=(!empty($return))? mysqli_fetch_assoc($return)['Total']:0;
											echo $users;
									?></td>
								</tr>

								<tr>
									<th><?php

										   echo $lang['index'][0][8];

									?>:</th>

									<td><?php

									       $return = mysqli_query($link,"SELECT Count(*) as Total FROM " . TB_PREFIX . "users WHERE timestamp > ".(time() - (3600*24))." AND tribe!=0 AND tribe!=4 AND tribe!=5");
									       $active=(!empty($return))? mysqli_fetch_assoc($return)['Total']:0;
										   echo $active;

									?></td>
								</tr>

								<tr>
									<th><?php

										   echo $lang['index'][0][9];

									?>:</th>

									<td><?php

										   $return = mysqli_query($link,"SELECT Count(*) as Total FROM " . TB_PREFIX . "users WHERE timestamp > ".(time() - (60*10))." AND tribe!=0 AND tribe!=4 AND tribe!=5");
										   $online=(!empty($return))? mysqli_fetch_assoc($return)['Total']:0;
										   echo $online;

									?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="about_the_game">
						<h2><?php echo $lang['index'][0][10]; ?>:</h2>
						<ul>
							<li><?php echo $lang['index'][0][11]; ?></li>
							<li><?php echo $lang['index'][0][12]; ?></li>
							<li><?php echo $lang['index'][0][13]; ?></li>
						</ul>
					</div>
				</div>
				<div class="secondarybox">
					<div id="screenshots">
						<h2><?php echo SCREENSHOTS; ?></h2>
						<a href="#last" class="navi prev dynamic_btn"><img class="dynamic_btn" src="img/x.gif" alt="previous" /></a>
						<div id="screenshots_preview">
							<ul id="screenshot_list" class="c1">
								<li><a href="#"><img src="img/un/s/s1s.jpg" alt="Screenshot" /></a></li>
								<li><a href="#"><img src="img/un/s/s2s.jpg" alt="Screenshot" /></a></li>
								<li><a href="#"><img src="img/un/s/s4s.jpg" alt="Screenshot" /></a></li>
								<li><a href="#"><img src="img/un/s/s3s.jpg" alt="Screenshot" /></a></li>
								<li><a href="#"><img src="img/un/s/s5s.jpg" alt="Screenshot" /></a></li>
								<li><a href="#"><img src="img/un/s/s7s.jpg" alt="Screenshot" /></a></li>
								<li><a href="#"><img src="img/un/s/s8s.jpg" alt="Screenshot" /></a></li>
							</ul>
						</div><a href="#next" class="navi next"><img class="dynamic_btn" src="img/x.gif" alt="next" /></a>
					</div>
					<div id="newsbox">
						<h2><?php echo NEWS; ?></h2>
						<div class="news"><?php include ("Templates/indexnews.tpl"); ?></div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div id="footer">
			<div class="container">
				<a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/3.0/" class="logo"><img alt="Licencia Creative Commons" style="border-width:0; height:31px; width:88px;" src="https://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" class="logo_traviangames" /></a>
				<ul class="menu">
					<li><a href="anleitung.php?s=3"><?php echo FAQ; ?></a>|</li>
					<li><a href="index.php?screenshots"><?php echo SCREENSHOTS; ?></a>|</li>
					<li><a href="spielregeln.php"><?php echo SPIELREGELN; ?></a>|</li>
					<li><a href="agb.php"><?php echo AGB; ?></a>|</li>
					<li><a href="impressum.php"><?php echo IMPRINT; ?></a></li>
					<li class="copyright">&copy; 2011-<?php echo date('Y'); ?> - TravianZ - All rights reserved</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="login_layer" class="overlay">
		<div class="mask closer"></div>
		<div id="login_list" class="overlay_content">
			<h2><?php echo CHOOSE; ?></h2>
			<a href="#" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>
			<ul class="world_list">
				<li class="w_big c3" style="background-image:url('img/en/welten/en1_big.jpg');">
					<a href="login.php"><img class="w_button" src="img/un/x.gif" alt="World" title="<?php echo $users; echo "&nbsp;"; echo PLAYERS; echo "&nbsp;|&nbsp;"; echo $active; echo "&nbsp;"; echo ACTIVE; echo "&nbsp;|&nbsp;"; echo $online; echo "&nbsp;"; echo ONLINE; ?>" /></a>
					<div class="label_players c0"><?php echo PLAYERS; ?>:</div>
					<div class="label_online c0"><?php echo ONLINE; ?>:</div>
					<div class="players c1"><?php echo $users; ?></div>
					<div class="online c1"><?php echo $online; ?></div>
				</li>
			</ul>
			<div class="footer"></div>
		</div>
	</div>
	<div id="signup_layer" class="overlay">
		<div class="mask closer"></div>
		<div id="signup_list" class="overlay_content">
			<h2><?php echo CHOOSE; ?></h2>
			<a href="#" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>
			<ul class="world_list">
				<li class="w_big c4" style="background-image:url('img/en/welten/en1_big.jpg');">
					<a href="anmelden.php"><img class="w_button" src="img/un/x.gif" alt="World" title="<?php echo $users; echo "&nbsp;"; echo PLAYERS; echo "&nbsp;|&nbsp;"; echo $active; echo "&nbsp;"; echo ACTIVE; echo "&nbsp;|&nbsp;"; echo $online; echo "&nbsp;"; echo ONLINE; ?>" /></a>
					<div class="label_players c0"><?php echo PLAYERS; ?>:</div>
					<div class="label_online c0"><?php echo ONLINE; ?>:</div>
					<div class="players c1"><?php echo $users; ?></div>
					<div class="online c1"><?php echo $online; ?></div>
				</li>
			</ul>
			<div class="footer"></div>
		</div>
	</div>
	<div id="iframe_layer" class="overlay">
		<div class="mask closer"></div>
		<div class="overlay_content">
			<a href="#" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>
			<h2><?php echo $lang['index'][0][2]; ?></h2>
			<div id="frame_box"></div>
			<div class="footer"></div>
		</div>
	</div>
	<div id="screenshot_layer" class="overlay">
		<div class="mask closer"></div>
		<div class="overlay_content">
			<h3><?php echo SCREENSHOTS; ?></h3>
			<a href="#" class="closer"><img class="dynamic_img" alt="Close" src="img/x.gif" /></a>
			<div class="screenshot_view">
				<h4 id="screen_hl"></h4>
				<img id="screen_view" src="img/x.gif" alt="Screenshot" name="screen_view" />
				<div id="screen_desc"></div>
			</div>
			<a href="#prev" class="navi prev" onclick="galarie.showPrev();"><img class="dynamic_img" src="img/x.gif" alt="previous" /></a>
			<a href="#next" class="navi next" onclick="galarie.showNext();"><img class="dynamic_img" src="img/x.gif" alt="next" /></a>
			<div class="footer"></div>
		</div>
	</div>
	<script type="text/javascript">
		var screenshots = [
			{'img':'img/en/s/s1.png','hl':"<?php echo $lang['screenshots']['title1']; ?>", 'desc':"<?php echo $lang['screenshots']['desc1']; ?>"},{'img':'img/en/s/s2.png','hl':"<?php echo $lang['screenshots']['title2']; ?>", 'desc':"<?php echo $lang['screenshots']['desc2']; ?>"},{'img':'img/en/s/s4.png','hl':"<?php echo $lang['screenshots']['title3']; ?>", 'desc':"<?php echo $lang['screenshots']['desc3']; ?>"},{'img':'img/en/s/s3.png','hl':"<?php echo $lang['screenshots']['title4']; ?>", 'desc':"<?php echo $lang['screenshots']['desc4']; ?>"},{'img':'img/en/s/s5.png','hl':"<?php echo $lang['screenshots']['title5']; ?>", 'desc':"<?php echo $lang['screenshots']['desc5']; ?>"},{'img':'img/en/s/s7.png','hl':"<?php echo $lang['screenshots']['title6']; ?>", 'desc':"<?php echo $lang['screenshots']['desc6']; ?>"},{'img':'img/en/s/s8.png','hl':"<?php echo $lang['screenshots']['title7']; ?>", 'desc':"<?php echo $lang['screenshots']['desc7']; ?>"}
		];
		var galarie = new Fx.Screenshots('screen_view', 'screen_hl', 'screen_desc', screenshots);
	<?php
	    if (isset($_GET['signup'])) {
	?>
		window.addEvent('domready', function() {
			$$('.signup_link').fireEvent('click');
		});
	<?php
	   }
	?>

	<?php
    	if (isset($_GET['login'])) {
	?>
		window.addEvent('domready', function() {
    		$$('.login_link').fireEvent('click');
    	});
	<?php
	   }
	?>
	</script>
</body>
</html>
