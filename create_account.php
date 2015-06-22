<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       create_account.php                                          ##
##  Developed by:  Dzoki , Advocaite , Donnchadh , yi12345 , Shadow , MisterX  ## 
##  Fixed by:      Shadow & MisterX - Scouting all players , artefact names.   ##
##  Fixed by:      InCube - double troops				       ##
##  Fixed by:      ronix						       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################


		include_once ("GameEngine/Session.php");
		include_once ("GameEngine/config.php");

		mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysql_select_db(SQL_DB);

/**
 * If user is not administrator, access is denied!
 */
		if($session->access < ADMIN){
			die("Access Denied: You are not Admin!");
			}else{

$start = $generator->pageLoadTimeStart();

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
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?e21d2" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />
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
<div id="content"  class="village1">
<?php
/**
 * Functions
 */
if($_POST['password'] != ""){
		function generateBase($kid, $uid, $username) {
			global $database, $message;
			if($kid == 0) {
				$kid = rand(1, 4);
			} else {
				$kid = $_POST['kid'];
			}

			$wid = $database->generateBase($kid);
			$database->setFieldTaken($wid);
			$database->addVillage($wid, $uid, $username, 1);
			$database->addResourceFields($wid, $database->getVillageType($wid));
			$database->addUnits($wid);
			$database->addTech($wid);
			$database->addABTech($wid);
			$database->updateUserField($uid, "access", USER, 1);
			$message->sendWelcome($uid, $username);
		}

/**
 * Creating account & capital village - Fixed by Shadow - cata7007@gmail.com / Skype : cata7007
 */ 

		$username = "Natars";
		$password = md5($_POST['password']);
		$email = "natars@noreply.com";
		$tribe = 5;
		$desc = "***************************
				[#natars]
			***************************";

		$q = "INSERT INTO " . TB_PREFIX . "users (id,username,password,access,email,timestamp,tribe,location,act,protect) VALUES (3, '$username', '$password', " . USER . ", '$email', ".time().", $tribe, '', '', 0)";
		mysql_query($q);
		unset($q);
		$uid = $database->getUserField($username, 'id', 1);
		$arrayXY=array();
        $arrayXY=array
        (
            array(WORLD_MAX, WORLD_MAX),
            array(WORLD_MAX, -WORLD_MAX),
            array(-WORLD_MAX, -WORLD_MAX),
            array(WORLD_MAX-1, WORLD_MAX),
            array(WORLD_MAX, WORLD_MAX-1),
            array(-WORLD_MAX, WORLD_MAX-1),
            array(WORLD_MAX-1, -WORLD_MAX),
            array(WORLD_MAX-1, WORLD_MAX-1),
            array(WORLD_MAX, -WORLD_MAX+1),
            array(WORLD_MAX-1, -WORLD_MAX+1),
            array(-WORLD_MAX+1, -WORLD_MAX+1),
            array(WORLD_MAX-2, WORLD_MAX),
            array(WORLD_MAX-2, -WORLD_MAX),
            array(WORLD_MAX-2, WORLD_MAX-1),
            array(WORLD_MAX-1, WORLD_MAX-2),
            array(-WORLD_MAX+2, WORLD_MAX),
            array(-WORLD_MAX+2, WORLD_MAX-1),
            array(-WORLD_MAX+2, -WORLD_MAX+2)
        );
        $status=0;
        $i=0;
        while ($i<=17) {
            $wid = $database->getVilWref($arrayXY[$i][0],$arrayXY[$i][1]);
            $status = $database->getVillageState($wid);
            $i++;
            if ($status==0) break;
        }
        if($status != 0) { //have taken then random
            generateBase(0, $uid, $username);
            $status = 1;
        }
        if($status == 0) {
            $database->setFieldTaken($wid);
            $database->addVillage($wid, $uid, $username, 1);
            $database->addResourceFields($wid, $database->getVillageType($wid));
            $database->addUnits($wid);
            $database->addTech($wid);
            $database->addABTech($wid);
            $database->updateUserField($uid, "access", USER, 1);
        }
                
        $wid = mysql_fetch_assoc(mysql_query("SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $uid"));
        $q = "UPDATE " . TB_PREFIX . "vdata SET pop = 834 WHERE owner = $uid";
        mysql_query($q) or die(mysql_error());
        $q2 = "UPDATE " . TB_PREFIX . "users SET access = 2 WHERE id = $uid";
        mysql_query($q2) or die(mysql_error());
        if(SPEED > 3) {
            $speed = 5;
        } else {
            $speed = SPEED;
        }
        $q3 = "UPDATE " . TB_PREFIX . "units SET u41 = " . (64700 * $speed) . ", u42 = " . (295231 * $speed) . ", u43 = " . (180747 * $speed) . ", u44 = " . (20000 * $speed) . ", u45 = " . (364401 * $speed) . ", u46 = " . (217602 * $speed) . ", u47 = " . (2034 * $speed) . ", u48 = " . (1040 * $speed) . " , u49 = " . (1 * $speed) . ", u50 = " . (9 * $speed) . " WHERE vref = " . $wid['wref'] . "";
        mysql_query($q3) or die(mysql_error());
        $q4 = "UPDATE " . TB_PREFIX . "users SET desc2 = '$desc' WHERE id = $uid";
        mysql_query($q4) or die(mysql_error());
		
/**
 * SCOUTING ALL PLAYERS FIX BY MisterX
 */
 
 		$natar = mysql_fetch_array(mysql_query("SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $uid and capital = 1"));
  		$multiplier = NATARS_UNITS;
  		$q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE capital = '1' and owner > '5'";
  		$array = $database->query_return($q);
        	$sendspytroops = 1500 * $multiplier;
  		foreach($array as $vill){
  		$ref = $database->addAttack($natar['wref'], 0, 0, 0, $sendspytroops, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 20, 0, 0, 0, 0);
  		$database->addMovement(3, $natar['wref'], $vill['wref'], $ref, time(), time()+10000);
  		}

/**
 * SMALL ARTEFACTS
 */
		function Artefact($uid, $type, $size, $art_name, $village_name, $desc, $effect, $img) {
			global $database;
			$kid = rand(1, 4);
			$wid = $database->generateBase($kid, 1);
			$database->addArtefact($wid, $uid, $type, $size, $art_name, $desc, $effect, $img);
			$database->setFieldTaken($wid);
			$database->addVillage($wid, $uid, $village_name, '0');
			$database->addResourceFields($wid, $database->getVillageType($wid));
			$database->addUnits($wid);
			$database->addTech($wid);
			$database->addABTech($wid);
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET pop = 163 WHERE wref = $wid");
			mysql_query("UPDATE " . TB_PREFIX . "vdata SET name = '$village_name' WHERE wref = $wid");
			if(SPEED > 3) {
				$speed = 5;
			} else {
				$speed = SPEED;
			}
			if($size == 1) {
				mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(1000, 2000) * $speed) . ", u42 = " . (rand(1500, 2000) * $speed) . ", u43 = " . (rand(2300, 2800) * $speed) . ", u44 = " . (rand(25, 75) * $speed) . ", u45 = " . (rand(1200, 1900) * $speed) . ", u46 = " . (rand(1500, 2000) * $speed) . ", u47 = " . (rand(500, 900) * $speed) . ", u48 = " . (rand(100, 300) * $speed) . " , u49 = " . (rand(1, 5) * $speed) . ", u50 = " . (rand(1, 5) * $speed) . " WHERE vref = " . $wid . "");
				mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
			} elseif($size == 2) {
				mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(2000, 4000) * $speed) . ", u42 = " . (rand(3000, 4000) * $speed) . ", u43 = " . (rand(4600, 5600) * $speed) . ", u44 = " . (rand(50, 150) * $speed) . ", u45 = " . (rand(2400, 3800) * $speed) . ", u46 = " . (rand(3000, 4000) * $speed) . ", u47 = " . (rand(1000, 1800) * $speed) . ", u48 = " . (rand(200, 600) * $speed) . " , u49 = " . (rand(2, 10) * $speed) . ", u50 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");
				mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
			} elseif($size == 3) {
				mysql_query("UPDATE " . TB_PREFIX . "units SET u41 = " . (rand(4000, 8000) * $speed) . ", u42 = " . (rand(6000, 8000) * $speed) . ", u43 = " . (rand(9200, 11200) * $speed) . ", u44 = " . (rand(100, 300) * $speed) . ", u45 = " . (rand(4800, 7600) * $speed) . ", u46 = " . (rand(6000, 8000) * $speed) . ", u47 = " . (rand(2000, 3600) * $speed) . ", u48 = " . (rand(400, 1200) * $speed) . " , u49 = " . (rand(4, 20) * $speed) . ", u50 = " . (rand(4, 20) * $speed) . " WHERE vref = " . $wid . "");
				mysql_query("UPDATE " . TB_PREFIX . "fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
			}
		}

/**
 * THE ARCHITECTS
 */

		$desc = ARCHITECTS_DESC;


		$vname = ARCHITECTS_SMALLVILLAGE;
		$effect = '(4x)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 1, 1, ARCHITECTS_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = ARCHITECTS_LARGEVILLAGE;
		$effect = '(3x)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 1, 2, ARCHITECTS_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = ARCHITECTS_UNIQUEVILLAGE;
		$effect = '(5x)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 1, 3, ARCHITECTS_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
		}

/**
 * MILITARY HASTE
 */


		$desc = HASTE_DESC;

		unset($i);
		unset($vname);
		unset($effect);
		$vname = HASTE_SMALLVILLAGE;
		$effect = '(2x)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 2, 1, HASTE_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = HASTE_LARGEVILLAGE;
		$effect = '(1.5x)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 2, 2, HASTE_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = HASTE_UNIQUEVILLAGE;
		$effect = '(3x)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 2, 3, HASTE_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
		}

/**
 * HAWK'S EYESIGHT
 */


		$desc =  EYESIGHT_DESC;

		unset($i);
		unset($vname);
		unset($effect);
		$vname = EYESIGHT_SMALLVILLAGE;
		$effect = '(5x)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 3, 1, EYESIGHT_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = EYESIGHT_LARGEVILLAGE;
		$effect = '(3x)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 3, 2, EYESIGHT_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = EYESIGHT_UNIQUEVILLAGE;
		$effect = '(10x)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 3, 3, EYESIGHT_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
		}

/**
 * THE DIET
 */


		$desc = DIET_DESC;

		unset($i);
		unset($vname);
		unset($effect);
		$vname = DIET_SMALLVILLAGE;
		$effect = '(50%)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 4, 1, DIET_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = DIET_LARGEVILLAGE;
		$effect = '(25%)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 4, 2, DIET_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = DIET_UNIQUEVILLAGE;
		$effect = '(50%)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 4, 3, DIET_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
		}


/**
 * ACADEMIC ADVANCEMENT
 */


		$desc = ACADEMIC_DESC;

		unset($i);
		unset($vname);
		unset($effect);
		$vname = ACADEMIC_SMALLVILLAGE;
		$effect = '(50%)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 5, 1, ACADEMIC_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = ACADEMIC_LARGEVILLAGE;
		$effect = '(25%)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 5, 2, ACADEMIC_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = ACADEMIC_UNIQUEVILLAGE;
		$effect = '(50%)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 5, 3, ACADEMIC_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
		}


/**
 * STORAGE MASTER PLAN
 */


		$desc = STORAGE_DESC;

		unset($i);
		unset($vname);
		unset($effect);;
		$vname = STORAGE_SMALLVILLAGE;
		$effect = '(GG&GW)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 6, 1, STORAGE_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = STORAGE_LARGEVILLAGE;
		$effect = '(GG&GW)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 6, 2, STORAGE_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
		}


/**
 * RIVAL'S CONFUSION
 */


		$desc = CONFUSION_DESC;

		unset($i);
		unset($vname);
		unset($effect);
		$vname = CONFUSION_SMALLVILLAGE;
		$effect = '(200)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 7, 1, CONFUSION_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = CONFUSION_LARGEVILLAGE;
		$effect = '(100)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 7, 2, CONFUSION_LARGE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = CONFUSION_UNIQUEVILLAGE;
		$effect = '(500)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 7, 3, CONFUSION_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
		}


/**
 * ARTEFACT OF THE FOOL
 */


		$desc = FOOL_DESC;

		unset($i);
		unset($vname);
		unset($effect);
		$vname = FOOL_SMALLVILLAGE;
		for($i > 1; $i < 5; $i++) {
			Artefact($uid, 8, 1, FOOL_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = FOOL_SMALLVILLAGE;
		for($i > 1; $i < 5; $i++) {
			Artefact($uid, 8, 2, FOOL_SMALL, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = FOOL_UNIQUEVILLAGE;
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 8, 3, FOOL_UNIQUE, '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
		}
		$myFile = "Templates/text.tpl";
		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: templates/text.tpl");
		$text = file_get_contents("Templates/text_format.tpl");
		$text = preg_replace("'%TEKST%'",ARTEFACT ,$text);
		fwrite($fh, $text);

			$query="SELECT * FROM ".TB_PREFIX."users ORDER BY id + 0 DESC";
			$result=mysql_query($query) or die (mysql_error());
			for ($i=0; $row=mysql_fetch_row($result); $i++) {
					$updateattquery = mysql_query("UPDATE ".TB_PREFIX."users SET ok = '1' WHERE id = '".$row[0]."'")
					or die(mysql_error());
			}

		echo "Done";
}elseif($database->checkExist('Natars', 0))    {
?>
<p>
<span class="c2">Error: Natar account already exist</span>
</p>
<?php
}else {
?>
<form action="create_account.php" method="post">

<p>
	<span>Choose Password</span>
		<table>
			<tr><td>Password:</td><td><input type="text" name="password" value=""></td></tr>
		</table>
</p>

	<center>
	<input type="submit" name="Submit" id="Submit" value="Submit"></center>
</form>
<?php } ?>
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
include("Templates/res.tpl")
?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$start)*1000);
?></b> ms

<br /><?php echo SEVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
<?php
}
?>
