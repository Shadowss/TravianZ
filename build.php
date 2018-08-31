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

use App\Utils\AccessLogger;

ob_start();
include_once( "GameEngine/Village.php" );
include_once( "GameEngine/Units.php" );
AccessLogger::logRequest();

if(isset($_GET['newdid'])){
    $_SESSION['wid'] = $_GET['newdid'];
    header("Location: " . $_SERVER['PHP_SELF'].(isset($_GET['id']) ? '?id='.$_GET['id'] : (isset($_GET['gid']) ? '?gid='.$_GET['gid'] : '')));
    exit;
}
if(isset($_GET['id']) && ($_GET['id'] < 1 || $_GET['id'] > 40 && ($_GET['id'] == 99 && $village->natar == 0 || $_GET['id'] != 99))){
    header("Location: dorf2.php");
    exit;
}

$pagestart = $generator->pageLoadTimeStart();
$alliance->procAlliForm($_POST);
$technology->procTech($_POST);
$market->procMarket($_POST);

if ( isset( $_GET['gid'] ) ) {
    $_GET['id'] = strval( $building->getTypeField( preg_replace( "/[^a-zA-Z0-9_-]/", "", $_GET['gid'] ) ) );
} else if ( isset( $_POST['id'] ) ) {
    $_GET['id'] = preg_replace( "/[^a-zA-Z0-9_-]/", "", $_POST['id'] ); // WTF is this?
}

if ( isset( $_POST['t'] ) ) {
    $_GET['t'] = preg_replace( "/[^a-zA-Z0-9_-]/", "", $_POST['t'] );
}

if ( isset( $_GET['id'] ) ) {
    if ( ! ctype_digit( preg_replace( "/[^a-zA-Z0-9_-]/", "", $_GET['id'] ) ) ) {
        $_GET['id'] = "1";
    }

    $checkBuildings = [0, 16, 17, 25, 26, 27];

    if ( $_GET['id'] < 19 || ( isset( $_GET['gid'] ) && ! in_array( $_GET['gid'], $checkBuildings ) ) ) {
        $_GET['t'] = "";
        $_GET['s'] = "";
    }

    if ( $village->resarray[ 'f' . $_GET['id'] . 't' ] == 17 ) {
        $market->procRemove( $_GET );
    }

    if ( $village->resarray[ 'f' . $_GET['id'] . 't' ] == 18 ) {
        $alliance->procAlliance( $_GET );
    }

    if ( $village->resarray[ 'f' . $_GET['id'] . 't' ] == 12 || $village->resarray[ 'f' . $_GET['id'] . 't' ] == 13 || $village->resarray[ 'f' . $_GET['id'] . 't' ] == 22 ) {
        $technology->procTechno( $_GET );
    }
}

if ($session->goldclub == 1 && count($session->villages) > 1) {
    if (isset($_POST['routeid'])) $routeid = $_POST['routeid'];

    if (isset($_POST['action']) && $_POST['action'] == 'addRoute') {
        if ($session->gold >= 2 && $session->goldclub == 1) {
            for ($i = 1; $i <= 4; $i ++) {
                if (empty($_POST['r'.$i])) $_POST['r'.$i] = 0;
            }
            
            $totalres = preg_replace("/[^0-9]/", "", $_POST['r1']) + preg_replace("/[^0-9]/", "", $_POST['r2']) + preg_replace("/[^0-9]/", "", $_POST['r3']) + preg_replace("/[^0-9]/", "", $_POST['r4']);
            $reqMerc  = ceil(($totalres - 0.1) / $market->maxcarry);
            $second   = date("s");
            $minute   = date("i");
            $hour     = date("G") - $_POST['start'];
            
            if (date("G") > $_POST['start']) $day = 1;
            else $day = 0;
            
            $timestamp = strtotime("-$hour hours -$second second -$minute minutes +$day day");
            
            if ($totalres > 0 && $_POST['tvillage'] != $village->wid && in_array($_POST['tvillage'], $session->villages) && ($_POST['start'] >= 0 && $_POST['start'] <= 23) && ($_POST['deliveries'] >= 1 && $_POST['deliveries'] <= 3)) {
                $database->createTradeRoute($session->uid, $_POST['tvillage'], $village->wid, $_POST['r1'], $_POST['r2'], $_POST['r3'], $_POST['r4'], $_POST['start'], $_POST['deliveries'], $reqMerc, $timestamp);
                $route = 1;
                header("Location: build.php?gid=17&t=4");
                exit;
            } else {
                $route = 1;
                header("Location: build.php?gid=17&t=4&create");
                exit;
            }
        }
    }

    if (isset($_POST['routeid']) && isset($_POST['action']) && $_POST['action'] == 'extendRoute') {
        if ($session->gold >= 2 && $session->goldclub == 1) {
            $traderoute = $database->getTradeRouteUid($_POST['routeid']);
            if ($traderoute == $session->uid) {
                $database->editTradeRoute($_POST['routeid'], "timeleft", 604800, 1);
                $newgold = $session->gold - 2;
                $database->updateUserField($session->uid, 'gold', $newgold, 1);
            }
        }
        $route = 1;
        unset($routeid);
        header("Location: build.php?gid=17&t=4");
        exit;
    }

    if (isset($_POST['routeid']) && isset($_POST['action']) && $_POST['action'] == 'editRoute2') {
        if($session->goldclub == 1){
            for ($i = 1; $i <= 4; $i ++) {
                if (empty($_POST['r'.$i])) {
                    $_POST['r'.$i] = 0;
                }
            }
            $totalres = preg_replace("/[^0-9]/", "", $_POST['r1']) + preg_replace("/[^0-9]/", "", $_POST['r2']) + preg_replace("/[^0-9]/", "", $_POST['r3']) + preg_replace("/[^0-9]/", "", $_POST['r4']);
            $reqMerc  = ceil(($totalres - 0.1) / $market->maxcarry);
            
            $traderoute = $database->getTradeRouteUid($_POST['routeid']);
            if ($totalres > 0 && $traderoute == $session->uid && ($_POST['start'] >= 0 && $_POST['start'] <= 23) && ($_POST['deliveries'] >= 1 && $_POST['deliveries'] <= 3)) {
                $database->editTradeRoute($_POST['routeid'], "wood", $_POST['r1'], 0);
                $database->editTradeRoute($_POST['routeid'], "clay", $_POST['r2'], 0);
                $database->editTradeRoute($_POST['routeid'], "iron", $_POST['r3'], 0);
                $database->editTradeRoute($_POST['routeid'], "crop", $_POST['r4'], 0);
                $database->editTradeRoute($_POST['routeid'], "start", $_POST['start'], 0);
                $database->editTradeRoute($_POST['routeid'], "deliveries", $_POST['deliveries'], 0);
                $database->editTradeRoute($_POST['routeid'], "merchant", $reqMerc, 0);
                $second = date("s");
                $minute = date("i");
                $hour   = date("G") - $_POST['start'];
                if (date("G") > $_POST['start'])  $day = 1;
                else $day = 0;
                $timestamp = strtotime("-$hour hours -$second seconds -$minute minutes +$day day");
                $database->editTradeRoute($_POST['routeid'], "timestamp", $timestamp, 0);
            }
            
            $route = 1;
            unset($routeid);
            header("Location: build.php?gid=17&t=4");
            exit;
        } 
    }

    if (isset($_POST['routeid']) && isset($_POST['action']) && $_POST['action'] == 'delRoute') {
        if($session->goldclub == 1){
            $traderoute = $database->getTradeRouteUid($_POST['routeid']);
            if ($traderoute == $session->uid) $database->deleteTradeRoute($_POST['routeid']);
            $route = 1;
            unset($routeid);
            header("Location: build.php?gid=17&t=4");
            exit;
        }
    }
}

if ($session->goldclub == 1) {
    if (isset($_GET['t']) == 99) {
        if(isset($_GET['action'])){
            if($_GET['action'] == 'addList') $create = 1;
            elseif($_GET['action'] == 'addraid') $create = 2;
            elseif($_GET['action'] == 'showSlot' && $_GET['eid']) $create = 3; 
        }       
        else $create = 0;

        if(isset($_GET['slid']) && $_GET['slid']){
            $FLData = $database->getFLData($_GET['slid']);
            if ($FLData['owner'] == $session->uid) $checked[$_GET['slid']] = 1;
        }

        if(isset($_GET['action']) && $_GET['action'] == 'deleteList') {
            $database->delFarmList($_GET['lid'], $session->uid);
            header("Location: build.php?id=39&t=99");
            exit;
        } elseif(isset($_GET['action']) && $_GET['action'] == 'deleteSlot') {
            $database->delSlotFarm($_GET['eid'], $session->uid, $_GET['lid']);
            header("Location: build.php?id=39&t=99");
            exit;
        }

        if(isset($_POST['action']) && $_POST['action'] == 'startRaid') $units->startRaidList($_POST);

        if(isset($_GET['slid']) && is_numeric($_GET['slid'])) {
            $FLData = $database->getFLData($_GET['slid']);
            if ($FLData['owner'] == $session->uid) $checked[$_GET['slid']] = 1;
        }

        if(isset($_GET['evasion']) && is_numeric($_GET['evasion'])) {
            $evasionvillage = $database->getVillage($_GET['evasion']);
            if($evasionvillage['owner'] == $session->uid) $database->setVillageEvasion($_GET['evasion']);
            
            header("Location: build.php?id=39&t=99");
            exit;
        }

        if (isset($_POST['maxevasion']) && is_numeric($_POST['maxevasion'])) {
            $database->updateUserField($session->uid, "maxevasion", $_POST['maxevasion'], 1);
            header("Location: build.php?id=39&t=99" );
            exit;
        }
    }
}
else $create = 0;

if(isset($_POST['a']) == 533374 && isset($_POST['id']) == 39) $units->Settlers($_POST);

if(isset($_GET['mode']) && $_GET['mode'] == 'troops' && isset($_GET['cancel']) && $_GET['cancel'] == 1){
    $oldmovement = $database->getMovementById($_GET['moveid']);
    $now = time();
    if(($now - $oldmovement[0]['starttime']) < 90 && $oldmovement[0]['from'] == $village->wid){
        $qc = "SELECT Count(*) as Total FROM " . TB_PREFIX . "movement where proc = 0 and moveid = " . $database->escape((int)$_GET['moveid']);
        $resultc = mysqli_fetch_array(mysqli_query($database->dblink, $qc), MYSQLI_ASSOC);
        if($resultc['Total'] == 1){
            $q = "UPDATE " . TB_PREFIX . "movement set proc  = 1 where proc = 0 and moveid = " . $database->escape((int)$_GET['moveid']);
            $database->query($q);
            $end = $now + ($now - $oldmovement[0]['starttime']);
            $q2 = "SELECT id FROM " . TB_PREFIX . "send ORDER BY id DESC";
            $lastid = mysqli_fetch_array(mysqli_query($database->dblink, $q2));
            $database->addMovement(4, $oldmovement[0]['to'], $oldmovement[0]['from'], $oldmovement[0]['ref'], $now, $end);
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $_GET['id']);
    exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME; ?></title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script src="mt-full.js?ebe79" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?ebe79" type="text/javascript"></script>
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
<?php include("Templates/header.tpl"); ?>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>
<div id="content"  class="build">
<?php
if(isset($_GET['id']) || isset($_GET['gid']) || $route == 1 || isset($_POST['routeid']) || isset($_GET['buildingFinish'])) {
    
    if(isset($_GET['s']) && !ctype_digit($_GET['s'])) $_GET['s'] = null;
    if(isset($_GET['t']) && !ctype_digit($_GET['t'])) $_GET['t'] = null;
	if (!ctype_digit($_GET['id'])) $_GET['id'] = 1;

	$id = $_GET['id'];
	if($_GET['id'] == 99 && $village->resarray['f99t'] == 40){
	   include("Templates/Build/ww.tpl");
	} elseif($village->resarray['f'.$_GET['id'].'t'] == 0 && $_GET['id'] >= 19) {
		include("Templates/Build/avaliable.tpl");
	}
	else {
		if(isset($_GET['t'])) {
		    if($_GET['t'] == 1) $_SESSION['loadMarket'] = 1;
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".tpl");
		} elseif(isset($_GET['s'])) {
			include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['s'].".tpl");
		}
		else include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t'].".tpl");
		
		if((isset($_GET['buildingFinish'])) && $_GET['buildingFinish'] == 1) {
        	if($session->gold >= 2) {
        		$building->finishAll("build.php?gid=".$_GET['id']."&ty=".$_GET['ty']);
        		exit;
        	}
        }
	}
}else{
header("Location: ".$_SERVER['PHP_SELF']."?id=39");
exit;
}
?>

</div>

<br /><br /><br /><br /><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
if(!NEW_FUNCTIONS_DISPLAY_LINKS) {
	echo "<br><br><br><br>";
	include("Templates/links.tpl");
}
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
<?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$pagestart)*1000);
?></b> ms

<br />Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce">    </div>
<script type="text/javascript">
	// update TITLE to include building name, as it's not very possible to do in PHP in current codebase
	if (document.getElementsByTagName('h1').length) {
		document.title = document.title + ' » » ' + document.getElementsByTagName('h1')[0].innerHTML.replace(/(<([^>]+)>)/ig,"");
	} 
	else document.title + ' » » New Building'
</script>
</body>
</html>