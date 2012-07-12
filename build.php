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
if(isset($_GET['buildingFinish'])) {
	if($session->gold >= 2) {
		$building->finishAll();
		header("Location: build.php?gid=15");
	}
}
$start = $generator->pageLoadTimeStart();
$alliance->procAlliForm($_POST);
$technology->procTech($_POST);
$market->procMarket($_POST);
if(isset($_GET['gid'])) {
	$_GET['id'] = strval($building->getTypeField(preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['gid'])));
} else if(isset($_POST['id'])) {
	$_GET['id'] = preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['id']); // WTF is this?
}
if(isset($_POST['t'])){
	$_GET['t'] = preg_replace("/[^a-zA-Z0-9_-]/","",$_POST['t']);
}
if(isset($_GET['id'])) {
	if (!ctype_digit(preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['id']))){
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
if($session->goldclub == 1 && count($session->villages) > 1){
	if(isset($_GET['routeid'])){
	$routeid = $_GET['routeid'];
	}
if($routeaccess = 1){
		if(isset($_POST['action']) && $_POST['action'] == 'addRoute') {
		if($session->access != BANNED){
		if($session->gold >= 2) {
			for($i=1;$i<=4;$i++){
			if($_POST['r'.$i] == ""){
			$_POST['r'.$i] = 0;
			}
			}
			$totalres = preg_replace("/[^0-9]/","",$_POST['r1'])+preg_replace("/[^0-9]/","",$_POST['r2'])+preg_replace("/[^0-9]/","",$_POST['r3'])+preg_replace("/[^0-9]/","",$_POST['r4']);
			$reqMerc = ceil(($totalres-0.1)/$market->maxcarry);
			$second = date("s");
			$minute = date("i");
			$hour = date("G")-$_POST['start'];
			if(date("G") > $_POST['start']){
			$day = 1;
			}else{
			$day = 0;
			}
			$timestamp = strtotime("-$hour hours -$second second -$minute minutes +$day day");
			if($totalres > 0){
				$database->createTradeRoute($session->uid,$_POST['tvillage'],$village->wid,$_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4'],$_POST['start'],$_POST['deliveries'],$reqMerc,$timestamp);
				header("Location: build.php?gid=17&t=4");
				$route = 1;
			}else{
				header("Location: build.php?gid=17&t=4&create");
				$route = 1;
			}
		}
		}else{
		$route = 0;
		header("Location: banned.php");
		}
		}
		if(isset($_GET['action']) && $_GET['action'] == 'extendRoute') {
		if($session->access != BANNED){
		if($session->gold >= 2) {
		$traderoute = $database->getTradeRouteUid($_GET['routeid']);
		if($traderoute == $session->uid){
		$database->editTradeRoute($_GET['routeid'],"timeleft",604800,1);
		$newgold = $session->gold-2;
		$database->updateUserField($session->uid,'gold',$newgold,1);
		header("Location: build.php?gid=17&t=4");
		$route = 1;
		unset($routeid);
		}else{
		header("Location: build.php?gid=17&t=4");
		$route = 1;
		unset($routeid);
		}
		}else{
		header("Location: build.php?gid=17&t=4");
		$route = 1;
		}
		}else{
		$route = 0;
		header("Location: banned.php");
		}
		}
		if(isset($_POST['action']) && $_POST['action'] == 'editRoute') {
		if($session->access != BANNED){
		$totalres = $_POST['r1']+$_POST['r2']+$_POST['r3']+$_POST['r4'];
		$reqMerc = ceil(($totalres-0.1)/$market->maxcarry);
		if($totalres > 0){
		$database->editTradeRoute($_POST['routeid'],"wood",$_POST['r1'],0);
		$database->editTradeRoute($_POST['routeid'],"clay",$_POST['r2'],0);
		$database->editTradeRoute($_POST['routeid'],"iron",$_POST['r3'],0);
		$database->editTradeRoute($_POST['routeid'],"crop",$_POST['r4'],0);
		$database->editTradeRoute($_POST['routeid'],"start",$_POST['start'],0);
		$database->editTradeRoute($_POST['routeid'],"deliveries",$_POST['deliveries'],0);
		$database->editTradeRoute($_POST['routeid'],"merchant",$reqMerc,0);
		$second = date("s");
		$minute = date("i");
		$hour = date("G")-$_POST['start'];
		if(date("G") > $_POST['start']){
		$day = 1;
		}else{
		$day = 0;
		}
		$timestamp = strtotime("-$hour hours -$second seconds -$minute minutes +$day day");
		$database->editTradeRoute($_POST['routeid'],"timestamp",$timestamp,0);
		}
		header("Location: build.php?gid=17&t=4");
		$route = 1;
		unset($routeid);
		}else{
		$route = 0;
		header("Location: banned.php");
		}
		}
		if(isset($_GET['action']) && $_GET['action'] == 'delRoute') {
		if($session->access != BANNED){
		$traderoute = $database->getTradeRouteUid($_GET['routeid']);
		if($traderoute == $session->uid){
		$database->deleteTradeRoute($_GET['routeid']);
		header("Location: build.php?gid=17&t=4");
		$route = 1;
		unset($routeid);
		}else{
		header("Location: build.php?gid=17&t=4");
		$route = 1;
		unset($routeid);
		}
		}else{
		$route = 0;
		header("Location: banned.php");
		}
		}
}
}
if($session->goldclub == 1){
		if(isset($_GET['t'])==99) {

			if($_GET['action'] == 'addList') {
				$create = 1;
			}else if($_GET['action'] == 'addraid') {
				$create = 2;
			}else if($_GET['action'] == 'showSlot' && $_GET['eid']) {
				$create = 3;
			}else{
				$create = 0;
			}

			if($_GET['slid']) {
			$FLData = $database->getFLData($_GET['slid']);
			if($FLData['owner'] == $session->uid){
			$checked[$_GET['slid']] = 1;
			}
			}

			if($_GET['action'] == 'deleteList') {
				$database->delFarmList($_GET['lid'], $session->uid);
				header("Location: build.php?id=39&t=99");
			}elseif($_GET['action'] == 'deleteSlot') {
				$database->delSlotFarm($_GET['eid']);
				   header("Location: build.php?id=39&t=99");
			}
			if($_POST['action'] == 'startRaid'){
			if($session->access != BANNED){
			include ("Templates/a2b/startRaid.tpl");
			}else{
			header("Location: banned.php");
			}
			}

			if(isset($_GET['slid']) && is_numeric($_GET['slid'])) {
			$FLData = $database->getFLData($_GET['slid']);
			if($FLData['owner'] == $session->uid){
			$checked[$_GET['slid']] = 1;
			}
			}

			if(isset($_GET['evasion']) && is_numeric($_GET['evasion'])) {
			$evasionvillage = $database->getVillage($_GET['evasion']);
			if($evasionvillage['owner'] == $session->uid){
			$database->setVillageEvasion($_GET['evasion']);
			}
			header("Location: build.php?id=39&t=99");
			}

			if(isset($_POST['maxevasion']) && is_numeric($_POST['maxevasion'])) {
			$database->updateUserField($session->uid, "maxevasion", $_POST['maxevasion'], 1);
			header("Location: build.php?id=39&t=99");
			}
		}
}else{
$create = 0;
}

if (isset($_POST['a']) == 533374 && isset($_POST['id']) == 39){
if($session->access != BANNED){
	$units->Settlers($_POST);
}else{
header("Location: banned.php");
}
}
if($_GET['mode']=='troops' && $_GET['cancel']==1){
if($session->access != BANNED){
$oldmovement=$database->getMovementById($_GET['moveid']);
$now=time();
if(($now-$oldmovement[0]['starttime'])<90 && $oldmovement[0]['from'] == $village->wid){

$qc="SELECT * FROM " . TB_PREFIX . "movement where proc = 0 and moveid = ".$_GET['moveid'];
$resultc=$database->query($qc) or die(mysql_error());

	if (mysql_num_rows($resultc)==1){

	$q = "UPDATE " . TB_PREFIX . "movement set proc  = 1 where proc = 0 and moveid = ".$_GET['moveid'];
	$database->query($q);
	$end=$now+($now-$oldmovement[0]['starttime']);
	//echo "6,".$oldmovement[0]['to'].",".$oldmovement[0]['from'].",0,".$now.",".$end;
	$q2 = "SELECT id FROM " . TB_PREFIX . "send ORDER BY id DESC";
	$lastid=mysql_fetch_array(mysql_query($q2));
	$newid=$lastid['id']+1;
	$q2 = "INSERT INTO " . TB_PREFIX . "send values ($newid,0,0,0,0,0)";
	$database->query($q2);
	$database->addMovement(4,$oldmovement[0]['to'],$oldmovement[0]['from'],$oldmovement[0]['ref'],$now,$end);


	$database->addMovement(6,$oldmovement[0]['to'],$oldmovement[0]['from'],$newid,$now,$end);
	}
}
header("Location: ".$_SERVER['PHP_SELF']."?id=".$_GET['id']);
}else{
header("Location: banned.php");
}
}
if(isset($_GET['id'])){
$automation->isWinner();
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
if(isset($_GET['id']) or isset($_GET['gid']) or $route == 1 or isset($_GET['routeid'])) {
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
}else{
header("Location: dorf1.php");
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

<div id="ce">    </div>
</body>
</html>