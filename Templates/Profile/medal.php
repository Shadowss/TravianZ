<?php


#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       medal.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Fixed by:      Shadow / Skype : cata7007                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
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

//natar image
if($displayarray['username'] == "Natars"){
$profiel = preg_replace("/\[#natars]/is",'<img src="'.$gpack.'img/t/t10_2.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Natar account</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#WW]/is",'<img src="'.$gpack.'img/t/g40_11-ltr.png" width="250" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official World Wonder Village</td></tr></table>\')">', $profiel, 1);
}

// Added by Shadow - cata7007@gmail.com / Skype : cata7007
if(NEW_FUNCTIONS_TRIBE_IMAGES){
    if($displayarray['tribe'] == "1"){
        $profiel = preg_replace("/\[#roman]/is",'<img src="'.$gpack.'../../img/rpage/Roman1.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Romans : Because of its high level of social and technological development the Romans are masters at building and its coordination. Also, their troops are part of the elite in Travian. They are very balanced and useful in attacking and defending.</td></tr></table>\')">', $profiel, 1);
    }elseif($displayarray['tribe'] == "2"){
        $profiel = preg_replace("/\[#teuton]/is",'<img src="'.$gpack.'../../img/rpage/Teuton1.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Teutons : The Teutons are the most aggressive tribe. Their troops are notorious and feared for their rage and frenzy when they attack. They move around as a plundering horde, not even afraid of death. </td></tr></table>\')">', $profiel, 1);
    }elseif($displayarray['tribe'] == "3"){
        $profiel = preg_replace("/\[#gaul]/is",'<img src="'.$gpack.'../../img/rpage/Gaul1.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Gauls : The Gauls are the most peaceful of all three tribes in Travian. Their troops are trained for an excellent defence, but their ability to attack can still compete with the other two tribes. The Gauls are born riders and their horses are famous for their speed. This means that their riders can hit the enemy exactly where they can cause the most damage and swiftly take care of them.</td></tr></table>\')">', $profiel, 1);
    }
}

//Shadow image  - MUST TO BE SET FROM ADMIN PANEL @iopietro must code
// Added by Shadow - cata7007@gmail.com / Skype : cata7007
if($displayarray['username'] == "Shadow"){
$profiel = preg_replace("/\[#SHADOW]/is",'<img src="'.$gpack.'img/t/shadow.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Server Administrator</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#MH]/is",'<img src="'.$gpack.'img/t/MH.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>The Multihunter is an official Travian position mainly used for enforcement of Travian rules within a server. Multihunters all use the account named Multihunter with its only village located in (0|0). A Multihunter may not play on the server on which they are the Multihunter, but be an active player on other servers. </td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#TEAM]/is",'<img src="'.$gpack.'img/t/team.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Travian is a persistent, browser-based, massively multiplayer, online real-time strategy game developed by the German software company Travian Games. It was originally written and released in June 2004 by Gerhard Müller. Set in classical antiquity, Travian is a predominantly militaristic real-time strategy game.</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#EVENT]/is",'<img src="'.$gpack.'img/t/t10_1.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>You played on Travian Hammelburg Event. Congrats !</td></tr></table>\')">', $profiel, 1);
}

// WW Winner IMAGES - MUST TO BE SET FROM ADMIN PANEL @iopietro must code
// Added by Shadow - cata7007@gmail.com / Skype : cata7007
if($displayarray['username'] == "Shadow"){
$profiel = preg_replace("/\[#WWBUILDER]/is",'<img src="'.$gpack.'img/t/builderWW.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Country:</td><td>Romania</td></tr><tr><td>Category:</td><td>World of Wonder</td></tr><tr><td>Name:</td><td>Shadow</td></tr><tr><td>Tribe:</td><td>Romans</td></tr><tr><td>WW LEVEL:</td><td>80</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#WINNERWW]/is",'<img src="'.$gpack.'img/t/winnerww.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Country:</td><td>Romania</td></tr><tr><td>Category:</td><td>World of Wonder</td></tr><tr><td>Name:</td><td>Shadow</td></tr><tr><td>Tribe:</td><td>Romans</td></tr><tr><td>WW LEVEL:</td><td>100</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#OFFENSIVE]/is",'<img src="'.$gpack.'img/t/Offensive_1.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Country:</td><td>Romania</td></tr><tr><td>Category:</td><td>Offensive</td></tr><tr><td>Name:</td><td>Shadow</td></tr><tr><td>Tribe:</td><td>Romans</td></tr><tr><td>Rank:</td><td>1</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#DEFENSIVE]/is",'<img src="'.$gpack.'img/t/Defensive_1.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Country:</td><td>Romania</td></tr><tr><td>Category:</td><td>Defensive</td></tr><tr><td>Name:</td><td>Shadow</td></tr><tr><td>Tribe:</td><td>Romans</td></tr><tr><td>Rank:</td><td>1</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#POPULATION]/is",'<img src="'.$gpack.'img/t/Population_1.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Country:</td><td>Romania</td></tr><tr><td>Category:</td><td>Population</td></tr><tr><td>Name:</td><td>Shadow</td></tr><tr><td>Tribe:</td><td>Romans</td></tr><tr><td>Rank:</td><td>1</td></tr></table>\')">', $profiel, 1);
}

// Added by Shadow - cata7007@gmail.com / Skype : cata7007
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

//NATURE image  - MUST TO BE SET FROM ADMIN PANEL @iopietro must code
// Added by Shadow - cata7007@gmail.com / Skype : cata7007
if($displayarray['username'] == "Nature"){
$profiel = preg_replace("/\[#NATURE]/is",'<img src="'.$gpack.'img/t/nature.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Natures troops are the animals living in unoccupied oases. You can use the combat simulator to see whether you have enough troops to defeat the animals in an oasis you want to conquer, but remember that you can only raid oasis. Keep in mind that all the animals above Bear can kill its contemporary max tier travian troop in single combat. </td></tr></table>\')">', $profiel, 1);
}

//Taskmaster image  - MUST TO BE SET FROM ADMIN PANEL @iopietro must code
// Added by Shadow - cata7007@gmail.com / Skype : cata7007
if($displayarray['username'] == "Taskmaster"){
$profiel = preg_replace("/\[#TASKMASTER]/is",'<img src="'.$gpack.'img/t/taskmaster.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Taskmaster Account</td></tr></table>\')">', $profiel, 1);
}

//veteran & veteran_5a IMAGES
if(NEW_FUNCTIONS_MEDAL_3YEAR){
	$profiel = preg_replace("/\[#g2300]/is",'<img src="'.$gpack.'img/t/Veteran_Medal.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Veteran Player<br><br>Medal achieved for playing 3 years of Travian.</td></tr></table>\')">', $profiel, 1);
}
if(NEW_FUNCTIONS_MEDAL_5YEAR){
	$profiel = preg_replace("/\[#g2301]/is",'<img src="'.$gpack.'img/t/5year_medal.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Veteran Player 5a<br><br>Medal achieved for playing 5 years of Travian.</td></tr></table>\')">', $profiel, 1);
}
if(NEW_FUNCTIONS_MEDAL_10YEAR){
	$profiel = preg_replace("/\[#g2302]/is",'<img src="'.$gpack.'img/t/10_year_medal.png" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Veteran Player 10a<br><br>Medal achieved for playing 10 years of Travian.</td></tr></table>\')">', $profiel, 1);
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

