<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       plus.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}
$automation->isWinner();
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
<?php
if(isset($_GET['id'])) {
$id = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['id']);
} else {
$id = "";
}
if ($id == "") {
include("Templates/Plus/1.tpl");
}
if ($id == 1) {
include("Templates/Plus/3.tpl");
}
if ($id == 2) {
include("Templates/Plus/2.tpl");
}
if ($id == 3) {
include("Templates/Plus/3.tpl");
}
if ($id == 4) {
include("Templates/Plus/4.tpl");
}
if (isset($_GET['mail']) && $id == 5){
include("Templates/Plus/invite.tpl");
}else if ($id == 5) {
include("Templates/Plus/5.tpl");
}
if ($id == 7) {
include("Templates/Plus/7.tpl");
}
if ($id == 8) {
include("Templates/Plus/8.tpl");
}
if ($id == 9) {
include("Templates/Plus/9.tpl");
}
if ($id == 10) {
include("Templates/Plus/10.tpl");
}
if ($id == 11) {
include("Templates/Plus/11.tpl");
}
if ($id == 12) {
include("Templates/Plus/12.tpl");
}
if ($id == 13) {
include("Templates/Plus/13.tpl");
}
if ($id == 14) {
include("Templates/Plus/14.tpl");
}
if ($id == 15) {
include("Templates/Plus/15.tpl");
}
if ($id > 15) {
include("Templates/Plus/3.tpl");
}
if(isset($_POST['mail'])) {
$mailer->sendInvite($_POST['mail'],$session->uid,$_POST['text']);
}
?>

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