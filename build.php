<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       build.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

ob_start();
include_once("GameEngine/Village.php");
include_once("GameEngine/Units.php");
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF'].(isset($_GET['id'])?'?id='.$_GET['id']:(isset($_GET['gid'])?'?gid='.$_GET['gid']:'')));
}
$start = $generator->pageLoadTimeStart();
$alliance->procAlliForm($_POST);
$technology->procTech($_POST);
$market->procMarket($_POST);	
if(isset($_GET['gid'])) {
	$_GET['id'] = strval($building->getTypeField($_GET['gid']));
} else if(isset($_POST['id'])) {
	$_GET['id'] = $_POST['id'];
}
if(isset($_POST['t'])){
	$_GET['t'] = $_POST['t'];
}
if(isset($_GET['id'])) {
	if (!ctype_digit($_GET['id'])){
        $_GET['id'] = "1";
    }
	if($village->resarray['f'.$_GET['id'].'t'] == 17) {
		$market->procRemove($_GET);
	}
	if($village->resarray['f'.$_GET['id'].'t'] == 18) {
		$alliance->procAlliance($_GET);
	}
	if($village->resarray['f'.$_GET['id'].'t'] == 12 || $village->resarray['f'.$_GET['id'].'t'] == 13 || $village->resarray['f'.$_GET['id'].'t'] == 22) {
		$technology->procTechno($_GET);
	}
}

if (isset($_POST['a']) == 533374 && isset($_POST['id']) == 39){  
	$units->Settlers($_POST);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME; ?></title>
    <link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script src="mt-full.js?ebe79" type="text/javascript"></script>
	<script src="unx.js?ebe79" type="text/javascript"></script>
	<script src="new.js?ebe79" type="text/javascript"></script>
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
<div id="content"  class="build">
<?php
if(isset($_GET['id'])) {
	if(isset($_GET['s']))
	{
		if (!ctype_digit($_GET['s'])) {
			$_GET['s'] = null;
		}
	}
	if(isset($_GET['t']))
	{
		if (!ctype_digit($_GET['t'])) {
			$_GET['t'] = null;
		}
	}
	if (!ctype_digit($_GET['id'])) {
		$_GET['id'] = "1";
	}
	$id = $_GET['id'];
	if($id=='99' AND $village->resarray['f99t'] == 40){
	include("Templates/Build/ww.tpl");
	} else
	if($village->resarray['f'.$_GET['id'].'t'] == 0 && $_GET['id'] >= 19) {
		include("Templates/Build/avaliable.tpl");
	}
	else {
		if(isset($_GET['t'])) {
			if($_GET['t'] == 1) {
			$_SESSION['loadMarket'] = 1;
			}
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".tpl");
		} else
		if(isset($_GET['s'])) {
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['s'].".tpl");
		}
		else {
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t'].".tpl");
		}
	}
}
?>

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

<div id="ce">	</div>
</body>
</html>
