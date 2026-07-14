<?php


#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       medal.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Fixed by:      Shadow / Skype : cata7007                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org      				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       	   ##
##                                                                             ##
#################################################################################


    //gp link
    $separator=isset($separator)? $separator:"";
    $gpack_load=isset($user['gpack'])? $user['gpack']:$database->getUserField($_SESSION['username'], 'gpack', 1);
    if($gpack_load== null || GP_ENABLE == false) {
    $gpack= $separator.GP_LOCATE;
    } else {
    $gpack= $separator.$gpack_load;
    }

//de bird
if($displayarray['protect'] > time()){
$secondsDiff      = $displayarray['protect'] - time();
$remainingDay     = floor($secondsDiff/(3600*24));

$left = \App\Utils\DateTime::getTimeFormat($secondsDiff);
$profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tn.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>This player has '.$left.' hours of beginners protection left.</td></tr></table>\')">', $profiel, 1);
} else {
$geregistreerd=date('d.m.Y', ($displayarray['regtime']));
$profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tnd.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>This player registered his account on '.$geregistreerd.'.</td></tr></table>\')">', $profiel, 1);
}

// Added by Shadow - cata7007@gmail.com
if (NEW_FUNCTIONS_TRIBE_IMAGES) {

    $tribe = (int)($displayarray['tribe'] ?? 0);

    switch ($tribe) {
        case 1: // Romans
            $replacement = '<img src="'.$gpack.'../../img/rpage/Roman1.jpg" border="0" '
                         . 'onmouseout="med_closeDescription()" '
                         . 'onmousemove="med_mouseMoveHandler(arguments[0],\''
                         . '<table><tr><td>The Romans : Because of its high level of social and technological development the Romans are masters at building and its coordination. Also, their troops are part of the elite in Travian. They are very balanced and useful in attacking and defending.</td></tr></table>'
                         . '\')">';
            $profiel = preg_replace("/\[#roman]/is", $replacement, $profiel, 1);
            break;

        case 2: // Teutons
            $replacement = '<img src="'.$gpack.'../../img/rpage/Teuton1.jpg" border="0" '
                         . 'onmouseout="med_closeDescription()" '
                         . 'onmousemove="med_mouseMoveHandler(arguments[0],\''
                         . '<table><tr><td>The Teutons : The Teutons are the most aggressive tribe. Their troops are notorious and feared for their rage and frenzy when they attack. They move around as a plundering horde, not even afraid of death.</td></tr></table>'
                         . '\')">';
            $profiel = preg_replace("/\[#teuton]/is", $replacement, $profiel, 1);
            break;

        case 3: // Gauls
            $replacement = '<img src="'.$gpack.'../../img/rpage/Gaul1.jpg" border="0" '
                         . 'onmouseout="med_closeDescription()" '
                         . 'onmousemove="med_mouseMoveHandler(arguments[0],\''
                         . '<table><tr><td>The Gauls : The Gauls are the most peaceful of all three tribes in Travian. Their troops are trained for an excellent defence, but their ability to attack can still compete with the other two tribes. The Gauls are born riders and their horses are famous for their speed. This means that their riders can hit the enemy exactly where they can cause the most damage and swiftly take care of them.</td></tr></table>'
                         . '\')">';
            $profiel = preg_replace("/\[#gaul]/is", $replacement, $profiel, 1);
            break;

        // ==================== NOILE TRIBURI ====================
		case 6: // Huns
			$tooltip = '<table><tr><td>The Huns: Fast and deadly, the Huns are known for their lightning raids and powerful cavalry. They live to conquer and leave nothing but ashes behind.</td></tr></table>';
			$replacement = '<img src="'.$gpack.'../../img/rpage/Huns1.jpg" border="0" '
                 . 'onmouseout="med_closeDescription()" '
                 . 'onmousemove="med_mouseMoveHandler(arguments[0], \''.addslashes($tooltip).'\')">';
			$profiel = preg_replace('/\[#huns\]/i', $replacement, $profiel, 1);
			break;

		case 7: // Egyptians
			$tooltip = '<table><tr><td>The Egyptians: Masters of architecture and ancient magic. Their troops are resilient and their cities are fortified with monumental structures.</td></tr></table>';
			$replacement = '<img src="'.$gpack.'../../img/rpage/Egyptians1.jpg" border="0" '
                 . 'onmouseout="med_closeDescription()" '
                 . 'onmousemove="med_mouseMoveHandler(arguments[0], \''.addslashes($tooltip).'\')">';
			$profiel = preg_replace('/\[#egyptians\]/i', $replacement, $profiel, 1);
			break;

		case 8: // Spartans
			$tooltip = '<table><tr><td>The Spartans: Born warriors with unbreakable discipline. &quot;Come back with your shield or on it&quot; is their creed.</td></tr></table>';
			$replacement = '<img src="'.$gpack.'../../img/rpage/Spartans1.jpg" border="0" '
                 . 'onmouseout="med_closeDescription()" '
                 . 'onmousemove="med_mouseMoveHandler(arguments[0], \''.addslashes($tooltip).'\')">';
			$profiel = preg_replace('/\[#spartans\]/i', $replacement, $profiel, 1);
			break;

		case 9: // Vikings
			$tooltip = '<table><tr><td>The Vikings: Fierce seafarers and feared raiders. Their axes sing songs of glory and their longships strike terror across the seas.</td></tr></table>';
			$replacement = '<img src="'.$gpack.'../../img/rpage/Vikings1.jpg" border="0" '
                 . 'onmouseout="med_closeDescription()" '
                 . 'onmousemove="med_mouseMoveHandler(arguments[0], \''.addslashes($tooltip).'\')">';
			$profiel = preg_replace('/\[#vikings\]/i', $replacement, $profiel, 1);
			break;
    }
}
// =========================
// NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM - DYNAMIC
// =========================
if(defined('NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM') && NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM){

    $uid = (int)$displayarray['id'];
    $username = htmlspecialchars($displayarray['username'], ENT_QUOTES);
    $tribeMap = [1=>'Romans',2=>'Teutons',3=>'Gauls'];
    $tribeName = $tribeMap[$displayarray['tribe']??0]?? 'Unknown';

    // luam WW real
	$wwLevel = 0;
	$wwName = 'N/A';

	$qww = $database->query("
    SELECT v.name AS village, f.f99 AS lvl
    FROM ".TB_PREFIX."vdata v
    INNER JOIN ".TB_PREFIX."fdata f ON f.vref = v.wref
    WHERE v.owner = $uid
      AND f.f99t = 40 -- tipul 40 = Wonder
      AND f.f99 > 0 -- nivel real
    ORDER BY f.f99 DESC
    LIMIT 1
	");

	if($qww && $row = $qww->fetch_assoc()){
    $wwLevel = (int)$row['lvl'];
    $wwName = htmlspecialchars($row['village'], ENT_QUOTES);
	}

	// [#ARTEFACT]
	$profiel = preg_replace_callback("/\[#ARTEFACT\]/is", function($m) use ($database,$uid,$username,$tribeName,$gpack){
    $q = $database->query("SELECT size, name FROM ".TB_PREFIX."artefacts WHERE owner=$uid");
    if(!$q || !$q->num_rows) return '';
    
    $sizeMap = [
        1 => 'Small (Village Effect)',
        2 => 'Large (Account Effect)',
        3 => 'Unique (Account Effect)'
    ];
    
    $arts = '';
    while($a = $q->fetch_assoc()){
        $type = $sizeMap[(int)$a['size']] ?? 'Unknown';
        $aname = htmlspecialchars($a['name'], ENT_QUOTES);
        $arts .= "<tr><td>Type:</td><td>{$type}</td></tr><tr><td>Artefact:</td><td>{$aname}</td></tr>";
    }
    
    $tip = "<table><tr><td>Name:</td><td>{$username}</td></tr><tr><td>Tribe:</td><td>{$tribeName}</td></tr><tr><td>Category:</td><td>Artefact Holder</td></tr>{$arts}</table>";
    
    return "<img src='{$gpack}img/gloriamedals/artifact.png' border='0' onmouseout='med_closeDescription()' onmousemove=\"med_mouseMoveHandler(arguments[0],'{$tip}')\">";
	}, $profiel);

    // [#WWBUILDER]
	if($wwLevel > 0){
    $tip = "<table <tr><td>Name:</td><td>{$username}</td></tr><tr><td>Tribe:</td><td>{$tribeName}</td></tr><tr><td>Category:</td><td>World Wonder</td></tr><tr><td>Village:</td><td>{$wwName}</td></tr><tr><td>WW Level:</td><td>{$wwLevel}</td></tr></table>";
    $profiel = preg_replace("/\[#WWBUILDER\]/is","<img src='{$gpack}img/gloriamedals/ww_builder.png' border='0' onmouseout='med_closeDescription()' onmousemove=\"med_mouseMoveHandler(arguments[0],'{$tip}')\">",
    $profiel);
	} else {
    $profiel = str_replace("[#WWBUILDER]", "", $profiel);
	}

    // [#WINNERWW]
    if($wwLevel >= 100){
        $tip = "<table><tr><td>Name:</td><td>{$username}</td></tr><tr><td>Tribe:</td><td>{$tribeName}</td></tr><tr><td>Category:</td><td>Winner</td></tr><tr><td>WW Level:</td><td>100</td></tr></table>";
        $profiel = preg_replace("/\[#WINNERWW\]/is",
            "<img src='{$gpack}img/gloriamedals/ww_winner.png' border='0' onmouseout='med_closeDescription()' onmousemove=\"med_mouseMoveHandler(arguments[0],'{$tip}')\">",
        $profiel);
    }
	
	//[#GREATSTORE] - DOAR Great Warehouse (38) si Great Granary (39) nivel 20
	$hasGreatStore = false;
	$gsVillage = '';
	$q = $database->query("SELECT v.name, f.* FROM ".TB_PREFIX."fdata f JOIN ".TB_PREFIX."vdata v ON v.wref=f.vref WHERE v.owner=$uid");
	if($q){
    while($f = $q->fetch_assoc()){
        $wh = $gr = false;
        for($i=1; $i<=99; $i++){
            if(!isset($f["f{$i}t"])) continue;
            $t = (int)$f["f{$i}t"];
            $l = (int)$f["f{$i}"];
            if($l == 20 && $t == 38) $wh = true; // Great Warehouse
            if($l == 20 && $t == 39) $gr = true; // Great Granary
        }
        if($wh && $gr){ 
            $hasGreatStore = true; 
            $gsVillage = htmlspecialchars($f['name'], ENT_QUOTES);
            break; 
        }
    }
	}

	if($hasGreatStore){
    $tip = "<table><tr><td>Name:</td><td>{$username}</td></tr><tr><td>Tribe:</td><td>{$tribeName}</td></tr><tr><td>Category:</td><td>Great Store</td></tr><tr><td>Village:</td><td>{$gsVillage}</td></tr><tr><td>Great Warehouse:</td><td>20</td></tr><tr><td>Great Granary:</td><td>20</td></tr></table>";
    $profiel = str_replace("[#GREATSTORE]", "<img src='{$gpack}img/gloriamedals/greatstore.png' border='0' onmouseout='med_closeDescription()' onmousemove=\"med_mouseMoveHandler(arguments[0],'{$tip}')\">", $profiel);
	} else {
    $profiel = str_replace("[#GREATSTORE]", "", $profiel);
	}
	
	// [#HERO100]
	$q = $database->query("SELECT level FROM ".TB_PREFIX."hero WHERE uid=$uid AND level>=99 LIMIT 1");
	if($q && $q->num_rows){
    $heroLvl = (int)$q->fetch_assoc()['level'];
    $tip = "<table><tr><td>Name:</td><td>{$username}</td></tr><tr><td>Tribe:</td><td>{$tribeName}</td></tr><tr><td>Category:</td><td>Hero Level</td></tr><tr><td>Level:</td><td>{$heroLvl}</td></tr></table>";
    $profiel = str_replace("[#HERO100]", "<img src='{$gpack}img/gloriamedals/hero.png' border='0' onmouseout='med_closeDescription()' onmousemove=\"med_mouseMoveHandler(arguments[0],'{$tip}')\">", $profiel);
	} else {
    $profiel = str_replace("[#HERO100]", "", $profiel);
	}
	
	// [#WALLMASTER] - 3 sate cu zid (31/32/33) nivel 20 in slotul 40
	$wallCount = 0;
	$q = $database->query("SELECT f.f40, f.f40t FROM ".TB_PREFIX."fdata f 
                       JOIN ".TB_PREFIX."vdata v ON v.wref=f.vref 
                       WHERE v.owner=$uid");
	if($q){
    while($r = $q->fetch_assoc()){
        if((int)$r['f40'] == 20 && in_array((int)$r['f40t'], [31,32,33])){
            $wallCount++;
        }
    }
	}

	if($wallCount >= 3){
    $tip = "<table><tr><td>Name:</td><td>{$username}</td></tr><tr><td>Tribe:</td><td>{$tribeName}</td></tr><tr><td>Category:</td><td>Wall Master</td></tr><tr><td>Walls level 20:</td><td>{$wallCount}</td></tr></table>";
    $profiel = str_replace("[#WALLMASTER]", "<img src='{$gpack}img/gloriamedals/wallmaster.png' border='0' onmouseout='med_closeDescription()' onmousemove=\"med_mouseMoveHandler(arguments[0],'{$tip}')\">", $profiel);
	} else {
    $profiel = str_replace("[#WALLMASTER]", "", $profiel);
	}

}

// METHOD CODED IN CONFIG
// Added by Shadow - cata7007@gmail.com
if(NEW_FUNCTIONS_MHS_IMAGES){
	if($displayarray['access'] == "9"){
		$profiel = preg_replace("/\[#MULTIHUNTER]/is",'<img src="'.$gpack.'img/t/t6_1.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Server Global Multihunter</td></tr></table>\')">', $profiel, 1);
		$profiel = preg_replace("/\[#MH]/is",'<img src="'.$gpack.'img/t/MH.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Multihunter is an official Travian position mainly used for enforcement of Travian rules within a server. Multihunters all use the account named Multihunter with its only village located in (0|0). A Multihunter may not play on the server on which they are the Multihunter, but be an active player on other servers. </td></tr></table>\')">', $profiel, 1);
		$profiel = preg_replace("/\[#TEAM]/is",'<img src="'.$gpack.'img/t/team.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Travian is a persistent, browser-based, massively multiplayer, online real-time strategy game developed by the German software company Travian Games. It was originally written and released in June 2004 by Gerhard Müller. Set in classical antiquity, Travian is a predominantly militaristic real-time strategy game.</td></tr></table>\')">', $profiel, 1);
	}elseif($displayarray['access'] == "8"){
		$profiel = preg_replace("/\[#MULTIHUNTER]/is",'<img src="'.$gpack.'img/t/t6_1.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Server Global Multihunter</td></tr></table>\')">', $profiel, 1);
		$profiel = preg_replace("/\[#MH]/is",'<img src="'.$gpack.'img/t/MH.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Multihunter is an official Travian position mainly used for enforcement of Travian rules within a server. Multihunters all use the account named Multihunter with its only village located in (0|0). A Multihunter may not play on the server on which they are the Multihunter, but be an active player on other servers. </td></tr></table>\')">', $profiel, 1);
		$profiel = preg_replace("/\[#TEAM]/is",'<img src="'.$gpack.'img/t/team.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Travian is a persistent, browser-based, massively multiplayer, online real-time strategy game developed by the German software company Travian Games. It was originally written and released in June 2004 by Gerhard Müller. Set in classical antiquity, Travian is a predominantly militaristic real-time strategy game.</td></tr></table>\')">', $profiel, 1);
	}
}

// METHOD CODED IN CONFIG
// VETERAN & VETERAN 5 YEARS & VETERAN 10 YEARS IMAGES
if(NEW_FUNCTIONS_MEDAL_3YEAR){
	$profiel = preg_replace("/\[#g2300]/is",'<img src="'.$gpack.'img/t/Veteran_Medal.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Veteran Player 3 Years<br><br>Medal achieved for playing 3 years of Travian.</td></tr></table>\')">', $profiel, 1);
}
if(NEW_FUNCTIONS_MEDAL_5YEAR){
	$profiel = preg_replace("/\[#g2301]/is",'<img src="'.$gpack.'img/t/5year_medal.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Veteran Player 5 Years<br><br>Medal achieved for playing 5 years of Travian.</td></tr></table>\')">', $profiel, 1);
}
if(NEW_FUNCTIONS_MEDAL_10YEAR){
	$profiel = preg_replace("/\[#g2302]/is",'<img src="'.$gpack.'img/t/10_year_medal.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Veteran Player 10 Years<br><br>Medal achieved for playing 10 years of Travian.</td></tr></table>\')">', $profiel, 1);
}

// NO NEED TO CODE THIS METHOD
// Added by Shadow - cata7007@gmail.com
if($displayarray['username'] == "Shadow"){
$profiel = preg_replace("/\[#SHADOW]/is",'<img src="'.$gpack.'img/t/shadow.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Server Administrator of TravianZ Project</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#MH]/is",'<img src="'.$gpack.'img/t/MH.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Multihunter is an official Travian position mainly used for enforcement of Travian rules within a server. Multihunters all use the account named Multihunter with its only village located in (0|0). A Multihunter may not play on the server on which they are the Multihunter, but be an active player on other servers. </td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#TEAM]/is",'<img src="'.$gpack.'img/t/team.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Travian is a persistent, browser-based, massively multiplayer, online real-time strategy game developed by the German software company Travian Games. It was originally written and released in June 2004 by Gerhard Müller. Set in classical antiquity, Travian is a predominantly militaristic real-time strategy game.</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#EVENT]/is",'<img src="'.$gpack.'img/t/t10_1.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>You played on Travian Hammelburg Event. Congrats !</td></tr></table>\')">', $profiel, 1);
}

// NO NEED TO CODE THIS METHOD NATARS
// Added by Shadow - cata7007@gmail.com
if($displayarray['username'] == "Natars"){
$profiel = preg_replace("/\[#natars]/is",'<img src="'.$gpack.'img/t/t10_2.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Natar account</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#WW]/is",'<img src="'.$gpack.'img/t/g40_11-ltr.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official World Wonder Village</td></tr></table>\')">', $profiel, 1);
}

// NO NEED TO CODE THIS METHOD NATURE
// Added by Shadow - cata7007@gmail.com
if($displayarray['username'] == "Nature"){
$profiel = preg_replace("/\[#NATURE]/is",'<img src="'.$gpack.'img/t/nature.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Natures troops are the animals living in unoccupied oases. You can use the combat simulator to see whether you have enough troops to defeat the animals in an oasis you want to conquer, but remember that you can only raid oasis. Keep in mind that all the animals above Bear can kill its contemporary max tier travian troop in single combat. </td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#NATURE2]/is",'<img src="'.$gpack.'img/t/nature2.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Natures troops are the animals living in unoccupied oases. You can use the combat simulator to see whether you have enough troops to defeat the animals in an oasis you want to conquer, but remember that you can only raid oasis. Keep in mind that all the animals above Bear can kill its contemporary max tier travian troop in single combat. </td></tr></table>\')">', $profiel, 1);
}

// NO NEED TO CODE THIS METHOD TASKMASTER
// Added by Shadow - cata7007@gmail.com
if($displayarray['username'] == "Taskmaster"){
$profiel = preg_replace("/\[#TASKMASTER]/is",'<img src="'.$gpack.'img/t/taskmaster.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Taskmaster Account</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#TASKMASTER2]/is",'<img src="'.$gpack.'img/t/taskmaster2.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Taskmaster Account</td></tr></table>\')">', $profiel, 1);
}


//de lintjes
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Aanvallers top 10      ==
== 2. Defence top 10         ==
== 3. Klimmers top 10        ==
== 4. Overvallers top 10     ==
== 5. In att en def tegelijk ==
== 6. in top 3 - aanval      ==
== 7. in top 3 - verdediging ==
== 8. in top 3 - klimmers    ==
== 9. in top 3 - overval     ==
******************************/

foreach($varmedal as $medal) {

switch ($medal['categorie']) {
    case "1":
        $titel="Attackers of the Week";
		$woord="Points";
        break;
    case "2":
        $titel="Defenders of the Week";
 		$woord="Points";
       break;
    case "3":
        $titel="Pop Climbers of the week";
 		$woord="Pop";
       break;
    case "4":
        $titel="Robbers of the week";
		$woord="Resources";
        break;
	case "5":
        $titel="Receiving this medal shows that you where in the top 10 of both Attackers and Defenders of the week.";
        $bonus[$medal['id']]=1;
		break;
	case "6":
        $titel="Receiving this medal shows that you were in the top 3 Attackers of the week ".$medal['points']." in a row";
        $bonus[$medal['id']]=1;
		break;
	case "7":
        $titel="Receiving this medal shows that you were in the top 3 Defenders of the week ".$medal['points']." in a row";
        $bonus[$medal['id']]=1;
		break;
	case "8":
        $titel="Receiving this medal shows that you were in the top 3 Pop Climbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
		break;
	case "9":
        $titel="Receiving this medal shows that you were in the top 3 Robbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
		break;
    case "10":
        $titel="Rank Climbers of the week.";
        $woord="Ranks";
        break;
    case "11":
        $titel="Receiving this medal shows that you were in the top 3 Rank Climbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
        break;
    case "12":
        $titel="Receiving this medal shows that you were in the top 10 Attackers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
        break;
    case "13":
        $titel="Receiving this medal shows that you were in the top 10 Defenders of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
        break;
    case "14":
        $titel="Receiving this medal shows that you were in the top 10 Pop Climbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
        break;
    case "15":
        $titel="Receiving this medal shows that you were in the top 10 Robbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
        break;
    case "16":
        $titel="Receiving this medal shows that you were in the top 10 Rank Climbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
        break;
}

if(isset($bonus[$medal['id']])){
$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img src="'.$gpack.'img/t/'.$medal['img'].'.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>'.$titel.'<br /><br />Received in week: '.$medal['week'].'</td></tr></table>\')">', $profiel, 1);
} else {
$profiel = preg_replace("/\[#".$medal['id']."]/is",'<img src="'.$gpack.'img/t/'.$medal['img'].'.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Category:</td><td>'.$titel.'</td></tr><tr><td>Week:</td><td>'.$medal['week'].'</td></tr><tr><td>Rank:</td><td>'.$medal['plaats'].'</td></tr><tr><td>'.$woord.':</td><td>'.$medal['points'].'</td></tr></table>\')">', $profiel, 1);
}
}



?>

