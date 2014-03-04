<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       dorf3.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
    $_SESSION['wid'] = $_GET['newdid'];
    $database->query("UPDATE ".TB_PREFIX."users SET village_select=".$_GET['newdid']." WHERE id=".$session->uid);  
	if(isset($_GET['s'])){
	header("Location: ".$_SERVER['PHP_SELF']."?s=".$_GET['s']);
	}else{
	header("Location: ".$_SERVER['PHP_SELF']);
}
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
<div id="content"  class="village3">

<?php
if($session->plus){
  if(isset($_GET['s'])){
	if($_GET['s'] == 2){
	  include("Templates/dorf3/2.tpl");
	}elseif($_GET['s'] == 3){
	  include("Templates/dorf3/3.tpl");
	}elseif($_GET['s'] == 4){
	  include("Templates/dorf3/4.tpl");
	}elseif($_GET['s'] == 5){
	  include("Templates/dorf3/5.tpl");
	}
  }else{
	include("Templates/dorf3/1.tpl");
  }
}else{
  include("Templates/dorf3/noplus.tpl");
}
?>
</div>

</br></br></br></br><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
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
