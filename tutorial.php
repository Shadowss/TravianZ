<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.06                                                  ##
##  Filename:      tutorial.php						                           ##
##  Developed by:  ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

	include("GameEngine/config.php");
	include("GameEngine/Database.php");
	include("GameEngine/Lang/".LANG.".php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo SERVER_NAME; echo "&nbsp;-&nbsp;"; echo TUTORIAL; ?></title>
	<link rel="stylesheet" type="text/css" href="gpack/travian/main.css"/>
	<link rel="stylesheet" type="text/css" href="gpack/travian/flaggs.css"/>
	<meta name="content-language" content="<?php echo LANG; ?>"/>
	<meta http-equiv="imagetoolbar" content="no"/>
	<script src="mt-core.js" type="text/javascript"></script>
	<script src="new.js" type="text/javascript"></script>
	<style type="text/css" media="screen">

	</style>
</head>
<body class="contentPage">
	<div class="wrapper">
		<div id="country_select">
			<div id="flags"></div>
			<script src="flaggen.js?a" type="text/javascript"></script>
			<script type="text/javascript">
			var region_list = new Array('Europe','America','Asia','Middle East','Africa','Oceania');
			show_flags('', '', region_list);
			</script>
		</div>
		<div id="header">
			<h1><?php echo $lang['index'][0][2]; ?></h1>
		</div>
		<div id="navigation">
		<a href="index.php" class="home"><img src="img/x.gif" alt="<?php echo SERVER_NAME; ?>"/></a>
		<table class="menu">
		<tr>
			<td><a href="tutorial.php"><span><?php echo TUTORIAL; ?></span></a></td>
			<td><a href="anleitung.php"><span><?php echo $lang['index'][0][2]; ?></span></a></td>
			<td><a href="http://forum.travian.com/" target="_blank"><span><?php echo FORUM; ?></span></a></td>
			<td><a href="index.php?signup" class="mark"><span><?php echo $lang['register']; ?></span></a></td>
			<td><a href="index.php?login"><span><?php echo LOGIN; ?></span></a></td>
		</tr>
		</table>
		</div>
		<div id="content">
			<div class="grit">
				<div class="grit">
					<h1><?php echo TUTORIAL; ?></h1>
					<?php
						if(!isset($_GET['s'])) {
						$_GET['s'] = ""; }
						if ($_GET['s'] == "") {
						include("Templates/Tutorial/1.tpl"); }
						if ($_GET['s'] == "1") {
						include("Templates/Tutorial/1.tpl"); }
						if ($_GET['s'] == "2") {
						include("Templates/Tutorial/2.tpl"); }
						if ($_GET['s'] == "3") {
						include("Templates/Tutorial/3.tpl"); }
						if ($_GET['s'] == "4") {
						include("Templates/Tutorial/4.tpl"); }
						if ($_GET['s'] == "5") {
						include("Templates/Tutorial/5.tpl"); }
					?>
					<div class="footer"></div>
				</div>
		<div id="iframe_layer" class="overlay">
		<div class="mask closer"></div>
		<div class="overlay_content">
			<a href="index.php" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>
			<h2><?php echo MANUAL; ?></h2>
			<div id="frame_box"></div>
			<div class="footer"></div>
		</div>
	</div>
</body>
</html>