<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       spieler.php                                                 ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
ob_start();
include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
$profile->procProfile($_POST);
$profile->procSpecial($_GET);
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	if(isset($_GET['s'])){
	header("Location: ".$_SERVER['PHP_SELF']."?s=".preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['s']));
	}else if(isset($_GET['uid'])){
	header("Location: ".$_SERVER['PHP_SELF']."?uid=".preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['uid']));
	}else{
	header("Location: ".$_SERVER['PHP_SELF']);
}
}
else {
	$building->procBuild($_GET);
}
if(isset($_GET['s'])){
$automation->isWinner();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?></title>
	<link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
	<?php
	if($session->gpack == null || GP_ENABLE == false) {
	echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
	echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>
	<script type="text/javascript">

		window.addEvent('domready', start);
	</script>
</head>


<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php include("Templates/header.tpl"); ?>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>
<script type="text/javascript">
				function getMouseCoords(e) {
					var coords = {};
					if (!e) var e = window.event;
					if (e.pageX || e.pageY) 	{
						coords.x = e.pageX;
						coords.y = e.pageY;
					}
					else if (e.clientX || e.clientY) 	{
						coords.x = e.clientX + document.body.scrollLeft
							+ document.documentElement.scrollLeft;
						coords.y = e.clientY + document.body.scrollTop
							+ document.documentElement.scrollTop;
					}
					return coords;
				}

				function med_mouseMoveHandler(e, desc_string){
					var coords = getMouseCoords(e);
					med_showDescription(coords, desc_string);
				}

				function med_closeDescription(){
					var layer = document.getElementById("medal_mouseover");
					layer.className = "hide";
				}

				function init_local(){
					med_init();
				}

				function med_init(){
					layer = document.createElement("div");
					layer.id = "medal_mouseover";
					layer.className = "hide";
					document.body.appendChild(layer);
				}

				function med_showDescription(coords, desc_string){
					var layer = document.getElementById("medal_mouseover");
					layer.style.top = (coords.y + 25)+ "px";
					layer.style.left = (coords.x - 20) + "px";
					layer.className = "";
					layer.innerHTML = desc_string;
				}
			   </script>
		<div id="content"  class="player">
<?php
if(isset($_GET['uid'])) {
	if($_GET['uid'] >= 2) {
		$user = $database->getUserArray(preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['uid']),1);
		if(isset($user['id'])){
			include("Templates/Profile/overview.tpl");
		} else {
			include("Templates/Profile/notfound.tpl");
		}
	}
	else {
		include("Templates/Profile/special.tpl");
	}
}
else if (isset($_GET['s'])) {
	if($_GET['s'] == 1) {
		include("Templates/Profile/profile.tpl");
	}
	if($_GET['s'] == 2) {
		include("Templates/Profile/preference.tpl");
	}
	if($_GET['s'] == 3) {
		include("Templates/Profile/account.tpl");
	}
	if($_GET['s'] == 4) {
		include("Templates/Profile/graphic.tpl");
	}
	if($_GET['s'] > 4 or $session->sit == 1) {
	header("Location: ".$_SERVER['PHP_SELF']."?uid=".preg_replace("/[^a-zA-Z0-9_-]/","",$session->uid));
	}
}
?>
</div>

</br></br></br></br><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
include("Templates/links.tpl");
?>
 </div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl");
?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
Calculated in <b><?php
echo round(($generator->pageLoadTimeEnd()-$start)*1000);
?></b> ms

<br />Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>