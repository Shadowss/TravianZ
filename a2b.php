<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       a2b.php                                                     ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

include("GameEngine/Village.php");

$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
if(isset($_GET['w'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?w=".$_GET['w']);
}
else if(isset($_GET['r'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?r=".$_GET['r']);
}
else if(isset($_GET['o'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?o=".$_GET['o']);
}
else if(isset($_GET['z'])) {
	header("Location: ".$_SERVER['PHP_SELF']."?z=".$_GET['z']);
}
else if($_GET['id']!=0){
	header("Location: ".$_SERVER['PHP_SELF']);
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

		echo SERVER_NAME

?></title>
	<link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php

		echo GP_LOCATE;

?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php

		echo GP_LOCATE;

?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
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
					include ("Templates/a2b/sendback_" . $database->getUserField($to['owner'], 'tribe', 0) . ".tpl");
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
						include ("Templates/a2b/sendback_" . $database->getUserField($to['owner'], 'tribe', 0) . ".tpl");
					} else {
						include ("Templates/a2b/units_" . $session->tribe . ".tpl");
						include ("Templates/a2b/search.tpl");
					}
				} else if(isset($delprisoners)){
			$prisoner = $database->getPrisonersByID($delprisoners);
			if($prisoner['wref'] == $village->wid){
			$p_owner = $database->getVillageField($prisoner['from'],"owner");
            $p_eigen = $database->getCoor($prisoner['wref']);
            $p_from = array('x'=>$p_eigen['x'], 'y'=>$p_eigen['y']);
            $p_ander = $database->getCoor($prisoner['from']);
            $p_to = array('x'=>$p_ander['x'], 'y'=>$p_ander['y']);
			$p_tribe = $database->getUserField($p_owner,"tribe",0);
            
            $p_speeds = array();
    
            //find slowest unit.            
            for($i=1;$i<=10;$i++){
                if ($prisoner['t'.$i]){
                    if($prisoner['t'.$i] != '' && $prisoner['t'.$i] > 0){
                        if($p_unitarray) { reset($p_unitarray); }
                        $p_unitarray = $GLOBALS["u".(($p_tribe-1)*10+$i)];
                        $p_speeds[] = $p_unitarray['speed'];
                    }
                }
            }
			
			if ($prisoner['t11']>0){
				$p_qh = "SELECT * FROM ".TB_PREFIX."hero WHERE uid = ".$p_owner."";
				$p_resulth = mysql_query($p_qh);
				$p_hero_f=mysql_fetch_array($p_resulth);
				$p_hero_unit=$p_hero_f['unit'];
				$p_speeds[] = $GLOBALS['u'.$p_hero_unit]['speed'];
			}
            
            $p_artefact = count($database->getOwnUniqueArtefactInfo2($p_owner,2,3,0));
			$p_artefact1 = count($database->getOwnUniqueArtefactInfo2($prisoner['from'],2,1,1));
			$p_artefact2 = count($database->getOwnUniqueArtefactInfo2($p_owner,2,2,0));
			if($p_artefact > 0){
			$p_fastertroops = 3;
			}else if($p_artefact1 > 0){
			$p_fastertroops = 2;
			}else if($p_artefact2 > 0){
			$p_fastertroops = 1.5;
			}else{
			$p_fastertroops = 1;
			}
			$p_time = round($automation->procDistanceTime($p_to,$p_from,min($p_speeds),1)/$p_fastertroops);
			$p_reference = $database->addAttack($prisoner['from'],$prisoner['t1'],$prisoner['t2'],$prisoner['t3'],$prisoner['t4'],$prisoner['t5'],$prisoner['t6'],$prisoner['t7'],$prisoner['t8'],$prisoner['t9'],$prisoner['t10'],$prisoner['t11'],3,0,0,0,0,0,0,0,0,0,0,0);
			$database->addMovement(4,$prisoner['wref'],$prisoner['from'],$p_reference,time(),($p_time+time()));
			$troops = $prisoner['t1']+$prisoner['t2']+$prisoner['t3']+$prisoner['t4']+$prisoner['t5']+$prisoner['t6']+$prisoner['t7']+$prisoner['t8']+$prisoner['t9']+$prisoner['t10']+$prisoner['t11'];
			$database->modifyUnit($prisoner['wref'],array("99o"),array($troops),array(0));
			$database->deletePrisoners($prisoner['id']);
				}else if($prisoner['from'] == $village->wid){
			$troops = $prisoner['t1']+$prisoner['t2']+$prisoner['t3']+$prisoner['t4']+$prisoner['t5']+$prisoner['t6']+$prisoner['t7']+$prisoner['t8']+$prisoner['t9']+$prisoner['t10']+$prisoner['t11'];
			if($prisoner['t11'] > 0){
			$p_owner = $database->getVillageField($prisoner['from'],"owner");
			mysql_query("UPDATE ".TB_PREFIX."hero SET `dead` = '1', `health` = '0' WHERE `uid` = '".$p_owner."'");
			}
			$database->modifyUnit($prisoner['wref'],array("99o"),array($troops),array(0));
			$database->deletePrisoners($prisoner['id']);
				}
				header("Location: build.php?id=39");} else {
					if(isset($process['0'])) {
						$coor = $database->getCoor($process['0']);
						include ("Templates/a2b/attack.tpl");
					} else {
						include ("Templates/a2b/units_" . $session->tribe . ".tpl");
						include ("Templates/a2b/search.tpl");
					}
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

		include ("Templates/footer.tpl");
		include ("Templates/res.tpl");

?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php

		echo CALCULATED;

?> <b><?php

		echo round(($generator->pageLoadTimeEnd() - $start) * 1000);

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
