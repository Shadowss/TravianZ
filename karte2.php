<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       karte2.php                                                  ##
##  Developed by:  Advocaite                                                   ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
use App\Utils\AccessLogger;

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

$building->procBuild($_GET);
if($session->plus){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?> - World Map</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js" type="text/javascript"></script>
	<script src="unx.js?f4b7h type="text/javascript"></script>
	<script src="mt-more.js" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<script type="text/javascript">window.addEvent('domready', start);</script>
</head>
<body onload="start()"><?php
	include("Templates/Map/mapviewlarge.tpl");?>
	<div id="ce"></div>
</body>
</html>
<?php
}
else{header("Location: karte.php");exit;}?>
