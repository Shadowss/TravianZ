<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       plus.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


use App\Utils\AccessLogger;

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
}
else $building->procBuild($_GET);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php
	echo SERVER_NAME . ' &raquo; &raquo; &raquo; PLUS ';

	if (!empty($_GET['id'])) {
	    switch ($_GET['id']) {
	        case '2':
	            echo 'Advantages';
	            break;

	        case '3':
	            echo 'Gold';
	            break;

	        case '4':
	            echo 'FAQ';
	            break;

	        case '5':
	            echo 'Earn Gold';
	            break;
	    }
	} else {
	    echo 'Tariffs';
	}
	?></title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
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
<?php include("templates/header.tpl"); ?>
<div id="mid">
<?php include("templates/menu.tpl"); ?>
<?php
if(isset($_GET['id'])){
	$id = preg_replace("/[^a-zA-Z0-9_-]/", "", $_GET['id']);
} 
else $id = "";

if(empty($id)) include ("templates/Plus/1.tpl");

if($id == 1){
	include ("templates/Plus/3.tpl");
}
if($id == 2){
	include ("templates/Plus/2.tpl");
}
if($id == 3){
	include ("templates/Plus/3.tpl");
}
if($id == 4){
	include ("templates/Plus/4.tpl");
}
if(isset($_GET['mail']) && $id == 5){
	include ("templates/Plus/invite.tpl");
}else if($id == 5){
	include ("templates/Plus/5.tpl");
}
if($id == 7){
	include ("templates/Plus/7.tpl");
}
if($id == 8){
	include ("templates/Plus/8.tpl");
}
if($id == 9){
	include ("templates/Plus/9.tpl");
}
if($id == 10){
	include ("templates/Plus/10.tpl");
}
if($id == 11){
	include ("templates/Plus/11.tpl");
}
if($id == 12){
	include ("templates/Plus/12.tpl");
}
if($id == 13){
	include ("templates/Plus/13.tpl");
}
if($id == 14){
	include ("templates/Plus/14.tpl");
}
if($id == 15){
	include ("templates/Plus/15.tpl");
}
if($id > 15){
	include ("templates/Plus/3.tpl");
}
if(isset($_POST['mail'])){
	$mailer->sendInvite($_POST['mail'], $session->uid, $_POST['text']);
}
?>

<br /><br /><br /><br /><div id="side_info">
<?php
include("templates/multivillage.tpl");
include("templates/quest.tpl");
include("templates/news.tpl");
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("templates/footer.tpl");
include("templates/res.tpl");
?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
?></b> ms

<br /><?php echo SEVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
