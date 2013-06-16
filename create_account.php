<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/


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
 * Creating account & capital village
 */
		$username = "Natars";
		$password = md5($_POST['password']);
		$email = "natars@noreply.com";
		$tribe = 5;
		$desc = "********************
					[#natars]
				********************";

		$q = "INSERT INTO " . TB_PREFIX . "users (id,username,password,access,email,timestamp,tribe,location,act,protect) VALUES (3, '$username', '$password', " . USER . ", '$email', ".time().", $tribe, '', '', 0)";
		mysql_query($q);
		unset($q);
		$uid = $database->getUserField($username, 'id', 1);
		generateBase(0, $uid, $username);
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
 * SCOUTING ALL PLAYERS
 */
 
		$natar = mysql_fetch_array(mysql_query("SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $uid and capital = 1"));
		$multiplier = NATARS_UNITS;
		$q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE capital = 1 and owner > 5";
		$array = $database->query_return($q);
		foreach($array as $vill){
		$ref = $database->addAttack($natar['wref'], 0, 0, 0, 1500*$multiplier, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 20, 0, 0, 0, 0);
		$database->addMovement(3, $natar['wref'], $vill['wref'], $ref, time(), time()+1);
		}

/**
 * SMALL ARTEFACTS
 */
		function Artefact($uid, $type, $size, $art_name, $village_name, $desc, $effect, $img) {
			global $database;
			$kid = rand(1, 4);
			$wid = $database->generateBase($kid);
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

		$desc = 'All buildings in the area of effect are stronger. This means that you will need more catapults to damage buildings protected by this artifacts powers.';


		$vname = 'Diamond Chisel';
		$effect = '(4x)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 1, 1, 'The architects slight secret', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Giant Marble Hammer';
		$effect = '(3x)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 1, 2, 'The architects great secret', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Hemons Scrolls';
		$effect = '(5x)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 1, 3, 'The architects unique secret', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type1.gif');
		}

/**
 * MILITARY HASTE
 */


		$desc = 'All troops in the area of effect move faster.';

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Opal Horseshoe';
		$effect = '(2x)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 2, 1, 'The slight titan boots', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Golden Chariot';
		$effect = '(1.5x)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 2, 2, 'The great titan boots', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Pheidippides Sandals';
		$effect = '(3x)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 2, 3, 'The unique titan boots', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type2.gif');
		}

/**
 * HAWK'S EYESIGHT
 */


		$desc = 'All spies (Scouts, Pathfinders, and Equites Legati) increase their spying ability. In addition, with all versions of this artifact you can see the incoming TYPE of troops but not how many there are.';

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Tale of a Rat';
		$effect = '(5x)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 3, 1, 'The eagles slight eyes', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Generals Letter';
		$effect = '(3x)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 3, 2, 'The eagles great eyes', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Diary of Sun Tzu';
		$effect = '(10x)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 3, 3, 'The eagles unique eyes', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type3.gif');
		}

/**
 * THE DIET
 */


		$desc = 'All troops in the artifacts range consume less wheat, making it possible to maintain a larger army.';

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Silver Platter';
		$effect = '(50%)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 4, 1, 'Slight diet control', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Sacred Hunting Bow';
		$effect = '(25%)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 4, 2, 'Great diet control', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'King Arthurs Chalice';
		$effect = '(50%)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 4, 3, 'Unique diet control', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type4.gif');
		}


/**
 * ACADEMIC ADVANCEMENT
 */


		$desc = 'Troops are built a certain percentage faster within the scope of the artifact.';

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Scribed Soldiers Oath';
		$effect = '(50%)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 5, 1, 'The trainers slight talent', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Declaration of War';
		$effect = '(25%)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 5, 2, 'The trainers great talent', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Memoirs of Alexander the Great';
		$effect = '(50%)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 5, 3, 'The trainers unique talent', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type5.gif');
		}


/**
 * STORAGE MASTER PLAN
 */


		$desc = 'With this building plan you are able to build the Great Granary or Great Warehouse in the Village with the artifact, or the whole account depending on the artifact. As long as you posses that artifact you are able to build and enlarge those buildings.';

		unset($i);
		unset($vname);
		unset($effect);;
		$vname = 'Builders Sketch';
		$effect = '';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 6, 1, 'Slight storage masterplan', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Babylonian Tablet';
		$effect = '';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 6, 2, 'Great storage masterplan', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type6.gif');
		}


/**
 * RIVAL'S CONFUSION
 */


		$desc = 'Cranny capacity is increased by a certain amount for each type of artifact. Catapults can only shoot random on villages within this artifacts power. Exceptions are the WW which can always be targeted and the treasure chamber which can always be targeted, except with the unique artifact. When aiming at a resource field only random resource fields can be hit, when aiming at a building only random buildings can be hit.';

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Map of the Hidden Caverns';
		$effect = '(200)';
		for($i > 1; $i < 6; $i++) {
			Artefact($uid, 7, 1, 'Rivals slight confusion', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Bottomless Satchel';
		$effect = '(100)';
		for($i > 1; $i < 4; $i++) {
			Artefact($uid, 7, 2, 'Rivals great confusion', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Trojan Horse';
		$effect = '(500)';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 7, 3, 'Rivals unique confusion', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type7.gif');
		}


/**
 * ARTEFACT OF THE FOOL
 */


		$desc = 'Every 24 hours it gets a random effect, bonus, or penalty (all are possible with the exception of great warehouse, great granary and WW building plans). They change effect AND scope every 24 hours. The unique artifact will always take positive bonuses.';

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Pendant of Mischief';
		for($i > 1; $i < 5; $i++) {
			Artefact($uid, 8, 1, 'Artefact of the slight fool', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Pendant of Mischief';
		for($i > 1; $i < 5; $i++) {
			Artefact($uid, 8, 2, 'Artefact of the slight fool', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
		}

		unset($i);
		unset($vname);
		unset($effect);
		$vname = 'Forbidden Manuscript';
		for($i > 1; $i < 1; $i++) {
			Artefact($uid, 8, 3, 'Artefact of the unique fool', '' . $vname . '', '' . $desc . '', '' . $effect . '', 'type8.gif');
		}
		$myFile = "Templates/text.tpl";
		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: templates/text.tpl");
		$text = file_get_contents("Templates/text_format.tpl");
		$text = preg_replace("'%TEKST%'","Construction plans



Countless days have passed since the first battles upon the walls of the cursed villages of the Dread Natars, many armies of both the free ones and the Natarian empire struggled and died before the walls of the many strongholds from which the Natars had once ruled all creation. Now with the dust settled and a relative calm having settled in, armies began to count their losses and collect their dead, the stench of combat still lingering in the night air, a smell of a slaughter unforgettable in its extent and brutality yet soon to be dwarfed by yet others. The largest armies of the free ones and the Dread Natars were marshalling for yet another renewed assault upon the coveted former strongholds of the Natarian Empire.

Soon scouts arrived telling of a most awesome sight and a chilling reminder, a dread army of an unfathomable size had been spotted marshalling at the end of the world, the Natarian capital, a force so great and unstoppable that the dust from their march would choke off all light, a force so brutal and ruthless that it would crush all hope. The free people knew that they had to race now, race against time and the endless hordes of the Natarian Empire to raise a Wonder of the World to restore the world to peace and vanquish the Natarian threat.

But to raise such a great Wonder would be no easy task, one would need construction plans created in the distant past, plans of such an arcane nature that even the very wisest of sages knew not their contents or locations.

Tens of thousands of scouts roamed across all existence searching in vain for these mystical plans, looking in all places but the dreaded Natarian Capital, yet could not find them. Today however, they return bearing good news, they return baring the locations of the plans, hidden by the armies of the Natars inside secret strongholds constructed to be hidden from the eyes of man.

Now begins the final stretch, when the greatest armies of the Free people and the Natars will clash across the world for the fate of all that lies under heaven. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.


Facts:
To steal one, the following things must happen:
you must attack the village (NO Raid!)
WIN the Attack
destroy the treasury
an empty treasury lvl 10 MUST be in the village where that attack came from
have a hero in an attack

If not, the next attack on that village, winning with a hero and empty treasury will take the building plan.

To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 49, from 50 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!

The construction plans are conquerable immediately when they appear to the server. 

There will be a countdown in game, showing the exact time of the release, 5 days prior to the launch." ,$text);
		fwrite($fh, $text);

			$query="SELECT * FROM ".TB_PREFIX."users ORDER BY id + 0 DESC";
			$result=mysql_query($query) or die (mysql_error());
			for ($i=0; $row=mysql_fetch_row($result); $i++) {
					$updateattquery = mysql_query("UPDATE ".TB_PREFIX."users SET ok = '1' WHERE id = '".$row[0]."'")
					or die(mysql_error());
			}

		echo "Done";
}else{
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