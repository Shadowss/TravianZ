<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       a2b.php                                                     ##
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
if(isset($_GET['w'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?w=".$_GET['w']);
	exit;
}
else if(isset($_GET['r'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?r=".$_GET['r']);
	exit;
}
else if(isset($_GET['o'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?o=".$_GET['o']);
	exit;
}
else if(isset($_GET['z'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?z=".$_GET['z']);
	exit;
}
else if($_GET['id']!=0){
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
}
}
else {
$building->procBuild($_GET);
}

if(isset($_GET['id'])) {
	$id = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['id']);
}
if(isset($_GET['w'])) {
	$w = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['w']);
}
if(isset($_GET['r'])) {
	$r = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['r']);
}
if(isset($_GET['delprisoners'])) {
	$delprisoners = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['delprisoners']);
}
if(isset($_GET['o'])) {
	$o = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['o']);
	$oid = preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['z']);
	$too = $database->getOasisField($oid,"conqured");
	if($too == 0){$disabledr ="disabled=disabled"; $disabled ="disabled=disabled";}else{
	$disabledr ="";
	if($session->sit == 0){
	$disabled ="";
	}else{
	$disabled ="disabled=disabled";
	}
	}
	$checked  ="checked=checked";
}else{
	if($session->sit == 0){
	$disabled ="";
	}else{
	$disabled ="disabled=disabled";
	}
}
	$process = $units->procUnits($_POST);
	$automation->isWinner();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<title><?php

		echo SERVER_NAME . ' - Send Troops'

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
	<link href="<?php

		echo GP_LOCATE;

?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php

		echo GP_LOCATE;

?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<?php

		if($session->gpack == null || GP_ENABLE == false) {
			echo "
	<link href='" . GP_LOCATE . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . GP_LOCATE . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
		} else {
			echo "
	<link href='" . $session->gpack . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . $session->gpack . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
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
<?php

		include ("Templates/header.tpl");

?>
<div id="mid">
<?php

		include ("Templates/menu.tpl");

?>
<div id="content"  class="a2b">
<?php

		if(!empty($id)) {
			include ("Templates/a2b/newdorf.tpl");
		} else
			if(isset($w)) {
				$enforce = $database->getEnforceArray($w, 0);
				if($enforce['vref'] == $village->wid) {
					$to = $database->getVillage($enforce['from']);
					$ckey = $w;
					include ("Templates/a2b/sendback.tpl");
				} else {
					include ("Templates/a2b/units_" . $session->tribe . ".tpl");
					include ("Templates/a2b/search.tpl");
				}
			} else
				if(isset($r)) {
					$enforce = $database->getEnforceArray($r, 0);
					$enforceoasis=$database->getOasisEnforceArray($r, 0);
					if($enforce['from'] == $village->wid || $enforceoasis['conqured']==$village->wid) {
						$to = $database->getVillage($enforce['from']);
						$ckey = $r;
						include ("Templates/a2b/sendback.tpl");
					} else {
						include ("Templates/a2b/units_" . $session->tribe . ".tpl");
						include ("Templates/a2b/search.tpl");
					}
				} else if(isset($delprisoners)){
			$prisoner = $database->getPrisonersByID($delprisoners);
			if($prisoner['wref'] == $village->wid){
			$p_owner = $database->getVillageField($prisoner['from'],"owner");
			$p_tribe = $database->getUserField($p_owner,"tribe",0);
			
			$troopsTime = $units->getWalkingTroopsTime($prisoner['from'], $prisoner['wref'], $p_owner, $p_tribe, $prisoner, 1, 't');
			$p_time = $database->getArtifactsValueInfluence($p_owner, $prisoner['from'], 2, $troopsTime);
			
			$p_reference = $database->addAttack($prisoner['from'],$prisoner['t1'],$prisoner['t2'],$prisoner['t3'],$prisoner['t4'],$prisoner['t5'],$prisoner['t6'],$prisoner['t7'],$prisoner['t8'],$prisoner['t9'],$prisoner['t10'],$prisoner['t11'],3,0,0,0,0,0,0,0,0,0,0,0);
			$database->addMovement(4,$prisoner['wref'],$prisoner['from'],$p_reference,time(),($p_time+time()));
			$troops = $prisoner['t1']+$prisoner['t2']+$prisoner['t3']+$prisoner['t4']+$prisoner['t5']+$prisoner['t6']+$prisoner['t7']+$prisoner['t8']+$prisoner['t9']+$prisoner['t10']+$prisoner['t11'];
			$database->modifyUnit($prisoner['wref'],array("99o"),array($troops),array(0));
			$database->deletePrisoners($prisoner['id']);
				}else if($prisoner['from'] == $village->wid){
			$troops = $prisoner['t1']+$prisoner['t2']+$prisoner['t3']+$prisoner['t4']+$prisoner['t5']+$prisoner['t6']+$prisoner['t7']+$prisoner['t8']+$prisoner['t9']+$prisoner['t10']+$prisoner['t11'];
			if($prisoner['t11'] > 0){
			$p_owner = $database->getVillageField($prisoner['from'],"owner");
			mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."hero SET `dead` = '1', `health` = '0' WHERE `uid` = '".$p_owner."' AND dead = 0");
			}
			$database->modifyUnit($prisoner['wref'],array("99o"),array($troops),array(0));
			$database->deletePrisoners($prisoner['id']);
				}
				header("Location: build.php?id=39");
				exit;
				} else {
					if(isset($process['0'])) {
						$coor = $database->getCoor($process['0']);
						include ("Templates/a2b/attack.tpl");
					} else {
						include ("Templates/a2b/units_" . $session->tribe . ".tpl");
						include ("Templates/a2b/search.tpl");
					}
				}

?>

<br /><br /><br /><br /><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>
<?php

		include ("Templates/footer.tpl");
		include ("Templates/res.tpl");

?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php

		echo CALCULATED;

?> <b><?php

		echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000);

?></b> ms

<br /><?php

		echo SERVER_TIME;

?> <span id="tp1" class="b"><?php

		echo date('H:i:s');

?></span>
</div>
</div>
</div>
<div id="ce"></div>
</body>
</html>
