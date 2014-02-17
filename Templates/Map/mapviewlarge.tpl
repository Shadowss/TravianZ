<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                        		       	       ##
##  Version:       01.09.2013 						       ##
##  Filename       mapview.php                                                 ##
##  Developed by:  Advocaite , yi12345 , Shadow , MisterX		       ##
##  Fixed by:      Shadow & MisterX - Attack image view on map		       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       ##
##                                                                             ##
#################################################################################

if(isset($_GET['z'])){
    $currentcoor = $database->getCoor($_GET['z']);
    $y = $currentcoor['y'];
    $x = $currentcoor['x'];
    $bigmid = $_GET['z'];
}
else if(isset($_POST['xp']) && isset($_POST['yp'])){
    $x = $_POST['xp'];
    $y = $_POST['yp'];
    $bigmid = $generator->getBaseID($x,$y);
}
else{
    $y = $village->coor['y'];
    $x = $village->coor['x'];
    $bigmid = $village->wid;
}
$xm7 = ($x-7) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-6 : $x-7;
$xm6 = ($x-6) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-5 : $x-6;
$xm5 = ($x-5) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-4 : $x-5; 
$xm4 = ($x-4) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-3 : $x-4;
$xm3 = ($x-3) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-2 : $x-3;
$xm2 = ($x-2) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-1 : $x-2;
$xm1 = ($x-1) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX : $x-1;
$xp1 = ($x+1) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX : $x+1;
$xp2 = ($x+2) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+1 : $x+2;
$xp3 = ($x+3) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+2: $x+3;
$xp4 = ($x+4) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+3 : $x+4;
$xp5 = ($x+5) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+4 : $x+5;
$xp6 = ($x+6) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+5: $x+6;
$xp7 = ($x+7) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+6: $x+7;

$ym7 = ($y-7) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-6 : $y-7;
$ym6 = ($y-6) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-5 : $y-6;
$ym5 = ($y-5) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-4 : $y-5;
$ym4 = ($y-4) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-3 : $y-4;
$ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
$ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
$ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
$yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
$yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
$yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
$yp4 = ($y+4) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+3 : $y+4;
$yp5 = ($y+5) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+4: $y+5;
$yp6 = ($y+6) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+5: $y+6;
$yp7 = ($y+7) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+6: $y+7;

$xarray = array($xm6,$xm5,$xm4,$xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3,$xp4,$xp5,$xp6);
$yarray = array($ym6,$ym5,$ym4,$ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3,$yp4,$yp5,$yp6);
$maparray = array();
$xcount = 0;
$maparray = '';
$maparray2 = '';
for($i=0; $i<=12; $i++){
    if($xcount != 13){
		$maparray .= '\''.$generator->getBaseID($xarray[$xcount],$yarray[$i]).'\',';
		$maparray2 .= $generator->getBaseID($xarray[$xcount],$yarray[$i]).',';
		if($i==12){
			$i = -1;
			$xcount +=1;
		}
	}
}

$maparray = (substr($maparray, 0, -1));
$maparray2 = (substr($maparray2, 0, -1));
//echo $maparray;

$query2 = "SELECT
					".TB_PREFIX."wdata.id AS map_id,
					".TB_PREFIX."wdata.fieldtype AS map_fieldtype,
					".TB_PREFIX."wdata.oasistype AS map_oasis,
					".TB_PREFIX."wdata.x AS map_x,
					".TB_PREFIX."wdata.y AS map_y,
					".TB_PREFIX."wdata.occupied AS map_occupied,
					".TB_PREFIX."wdata.image AS map_image,

					".TB_PREFIX."odata.conqured AS oasis_conqured,
					info_user_oasis.username AS oasis_user,
					info_user_oasis.tribe AS oasis_tribe,
					info_alliance_oasis.tag AS oasis_alli_name,

					".TB_PREFIX."vdata.wref AS ville_id,
					".TB_PREFIX."vdata.owner AS ville_user,
					".TB_PREFIX."vdata.name AS ville_name,
					".TB_PREFIX."vdata.capital AS ville_capital,
					".TB_PREFIX."vdata.pop AS ville_pop,

					".TB_PREFIX."users.id AS user_id,
					".TB_PREFIX."users.username AS user_username,
					".TB_PREFIX."users.tribe AS user_tribe,
					".TB_PREFIX."users.alliance AS user_alliance,

					".TB_PREFIX."alidata.id AS aliance_id,
					".TB_PREFIX."alidata.tag AS aliance_name

				FROM ((((((".TB_PREFIX."wdata
					LEFT JOIN ".TB_PREFIX."vdata ON ".TB_PREFIX."vdata.wref = ".TB_PREFIX."wdata.id )
					LEFT JOIN ".TB_PREFIX."odata ON ".TB_PREFIX."odata.wref = ".TB_PREFIX."wdata.id )
					LEFT JOIN ".TB_PREFIX."users AS info_user_oasis ON info_user_oasis.id = ".TB_PREFIX."odata.owner )
					LEFT JOIN ".TB_PREFIX."alidata AS info_alliance_oasis ON info_alliance_oasis.id = info_user_oasis.alliance )
					LEFT JOIN ".TB_PREFIX."users ON ".TB_PREFIX."users.id = ".TB_PREFIX."vdata.owner )
					LEFT JOIN ".TB_PREFIX."alidata ON ".TB_PREFIX."alidata.id = ".TB_PREFIX."users.alliance )
			where ".TB_PREFIX."wdata.id IN ($maparray)
			ORDER BY FIND_IN_SET(".TB_PREFIX."wdata.id,'$maparray2')";

//echo $query2;
$result2 = mysql_query($query2) or die(mysql_error());

$targetalliance = array();
$neutralarray = array();
$friendarray = array();
$enemyarray = array();
$i=0;
$i2=0;
$yrow = 0;
$row = 0;
$coorindex = 0;
$map_js ='';
$map_content='';
$map_gen='';
$coorarray = array(
"48, 253, 85, 273, 48, 293, 11, 273"
,"84, 233, 121, 253, 84, 273, 47, 253" 
,"120, 213, 157, 233, 120, 253, 83, 233"
,"156, 193, 193, 213, 156, 233, 119, 213" 
,"192, 173, 229, 193, 192, 213, 155, 193" 
,"228, 153, 265, 173, 228, 193, 191, 173"
,"264, 133, 301, 153, 264, 173, 227, 153"
,"300, 113, 337, 133, 300, 153, 263, 133"
,"336, 93, 373, 113, 336, 133, 299, 113"
,"372, 73, 409, 93, 372, 113, 335, 93"
,"408, 53, 445, 73, 408, 93, 371, 73"
,"444, 33, 481, 53, 444, 73, 407, 53"
,"480, 13, 517, 33, 480, 53, 443, 33"
,"85, 273, 122, 293, 85, 313, 48, 293"
,"121, 253, 158, 273, 121, 293, 84, 273"
,"157, 233, 194, 253, 157, 273, 120, 253"
,"193, 213, 230, 233, 193, 253, 156, 233"
,"229, 193, 266, 213, 229, 233, 192, 213"
,"265, 173, 302, 193, 265, 213, 228, 193"
,"301, 153, 338, 173, 301, 193, 264, 173"
,"337, 133, 374, 153, 337, 173, 300, 153"
,"373, 113, 410, 133, 373, 153, 336, 133"
,"409, 93, 446, 113, 409, 133, 372, 113"
,"445, 73, 482, 93, 445, 113, 408, 93"
,"481, 53, 518, 73, 481, 93, 444, 73"
,"517, 33, 554, 53, 517, 73, 480, 53"
,"122, 293, 159, 313, 122, 333, 85, 313"
,"158, 273, 195, 293, 158, 313, 121, 293"
,"194, 253, 231, 273, 194, 293, 157, 273"
,"230, 233, 267, 253, 230, 273, 193, 253"
,"266, 213, 303, 233, 266, 253, 229, 233"
,"302, 193, 339, 213, 302, 233, 265, 213"
,"338, 173, 375, 193, 338, 213, 301, 193"
,"374, 153, 411, 173, 374, 193, 337, 173"
,"410, 133, 447, 153, 410, 173, 373, 153"
,"446, 113, 483, 133, 446, 153, 409, 133" 
,"482, 93, 519, 113, 482, 133, 445, 113" 
,"518, 73, 555, 93, 518, 113, 481, 93"
,"554, 53, 591, 73, 554, 93, 517, 73"
,"159, 313, 196, 333, 159, 353, 122, 333"
,"195, 293, 232, 313, 195, 333, 158, 313"
,"231, 273, 268, 293, 231, 313, 194, 293"
,"267, 253, 304, 273, 267, 293, 230, 273"
,"303, 233, 340, 253, 303, 273, 266, 253"
,"339, 213, 376, 233, 339, 253, 302, 233"
,"375, 193, 412, 213, 375, 233, 338, 213"
,"411, 173, 448, 193, 411, 213, 374, 193"
,"447, 153, 484, 173, 447, 193, 410, 173"
,"483, 133, 520, 153, 483, 173, 446, 153"
,"519, 113, 556, 133, 519, 153, 482, 133"
,"555, 93, 592, 113, 555, 133, 518, 113"
,"591, 73, 628, 93, 591, 113, 554, 93"
,"196, 333, 233, 353, 196, 373, 159, 353"
,"232, 313, 269, 333, 232, 353, 195, 333"
,"268, 293, 305, 313, 268, 333, 231, 313"
,"304, 273, 341, 293, 304, 313, 267, 293"
,"340, 253, 377, 273, 340, 293, 303, 273"
,"376, 233, 413, 253, 376, 273, 339, 253"
,"412, 213, 449, 233, 412, 253, 375, 233"
,"448, 193, 485, 213, 448, 233, 411, 213"
,"484, 173, 521, 193, 484, 213, 447, 193"
,"520, 153, 557, 173, 520, 193, 483, 173"
,"556, 133, 593, 153, 556, 173, 519, 153"
,"592, 113, 629, 133, 592, 153, 555, 133"
,"628, 93, 665, 113, 628, 133, 591, 113"
,"233, 353, 270, 373, 233, 393, 196, 373"
,"269, 333, 306, 353, 269, 373, 232, 353"
,"305, 313, 342, 333, 305, 353, 268, 333"
,"341, 293, 378, 313, 341, 333, 304, 313"
,"377, 273, 414, 293, 377, 313, 340, 293"
,"413, 253, 450, 273, 413, 293, 376, 273"
,"449, 233, 486, 253, 449, 273, 412, 253"
,"485, 213, 522, 233, 485, 253, 448, 233"
,"521, 193, 558, 213, 521, 233, 484, 213"
,"557, 173, 594, 193, 557, 213, 520, 193"
,"593, 153, 630, 173, 593, 193, 556, 173"
,"629, 133, 666, 153, 629, 173, 592, 153"
,"665, 113, 702, 133, 665, 153, 628, 133"
,"270, 373, 307, 393, 270, 413, 233, 393"
,"306, 353, 343, 373, 306, 393, 269, 373"
,"342, 333, 379, 353, 342, 373, 305, 353"
,"378, 313, 415, 333, 378, 353, 341, 333"
,"414, 293, 451, 313, 414, 333, 377, 313"
,"450, 273, 487, 293, 450, 313, 413, 293"
,"486, 253, 523, 273, 486, 293, 449, 273"
,"522, 233, 559, 253, 522, 273, 485, 253"
,"558, 213, 595, 233, 558, 253, 521, 233"
,"594, 193, 631, 213, 594, 233, 557, 213"
,"630, 173, 667, 193, 630, 213, 593, 193"
,"666, 153, 703, 173, 666, 193, 629, 173"
,"702, 133, 739, 153, 702, 173, 665, 153"
,"307, 393, 344, 413, 307, 433, 270, 413"
,"343, 373, 380, 393, 343, 413, 306, 393"
,"379, 353, 416, 373, 379, 393, 342, 373"
,"415, 333, 452, 353, 415, 373, 378, 353"
,"451, 313, 488, 333, 451, 353, 414, 333"
,"487, 293, 524, 313, 487, 333, 450, 313"
,"523, 273, 560, 293, 523, 313, 486, 293"
,"559, 253, 596, 273, 559, 293, 522, 273"
,"595, 233, 632, 253, 595, 273, 558, 253"
,"631, 213, 668, 233, 631, 253, 594, 233"
,"667, 193, 704, 213, 667, 233, 630, 213"
,"703, 173, 740, 193, 703, 213, 666, 193"
,"739, 153, 776, 173, 739, 193, 702, 173"
,"344, 413, 381, 433, 344, 453, 307, 433"
,"380, 393, 417, 413, 380, 433, 343, 413"
,"416, 373, 453, 393, 416, 413, 379, 393"
,"452, 353, 489, 373, 452, 393, 415, 373"
,"488, 333, 525, 353, 488, 373, 451, 353"
,"524, 313, 561, 333, 524, 353, 487, 333"
,"560, 293, 597, 313, 560, 333, 523, 313"
,"596, 273, 633, 293, 596, 313, 559, 293"
,"632, 253, 669, 273, 632, 293, 595, 273"
,"668, 233, 705, 253, 668, 273, 631, 253"
,"704, 213, 741, 233, 704, 253, 667, 233"
,"740, 193, 777, 213, 740, 233, 703, 213"
,"776, 173, 813, 193, 776, 213, 739, 193"
,"381, 433, 418, 453, 381, 473, 344, 453"
,"417, 413, 454, 433, 417, 453, 380, 433"
,"453, 393, 490, 413, 453, 433, 416, 413"
,"489, 373, 526, 393, 489, 413, 452, 393"
,"525, 353, 562, 373, 525, 393, 488, 373"
,"561, 333, 598, 353, 561, 373, 524, 353"
,"597, 313, 634, 333, 597, 353, 560, 333"
,"633, 293, 670, 313, 633, 333, 596, 313"
,"669, 273, 706, 293, 669, 313, 632, 293"
,"705, 253, 742, 273, 705, 293, 668, 273"
,"741, 233, 778, 253, 741, 273, 704, 253"
,"777, 213, 814, 233, 777, 253, 740, 233"
,"813, 193, 850, 213, 813, 233, 776, 213"
,"418, 453, 455, 473, 418, 493, 381, 473"
,"454, 433, 491, 453, 454, 473, 417, 453"
,"490, 413, 527, 433, 490, 453, 453, 433"
,"526, 393, 563, 413, 526, 433, 489, 413"
,"562, 373, 599, 393, 562, 413, 525, 393"
,"598, 353, 635, 373, 598, 393, 561, 373"
,"634, 333, 671, 353, 634, 373, 597, 353"
,"670, 313, 707, 333, 670, 353, 633, 333"
,"706, 293, 743, 313, 706, 333, 669, 313"
,"742, 273, 779, 293, 742, 313, 705, 293"
,"778, 253, 815, 273, 778, 293, 741, 273"
,"814, 233, 851, 253, 814, 273, 777, 253"
,"850, 213, 887, 233, 850, 253, 813, 233"
,"455, 473, 492, 493, 455, 513, 418, 493"
,"491, 453, 528, 473, 491, 493, 454, 473"
,"527, 433, 564, 453, 527, 473, 490, 453"
,"563, 413, 600, 433, 563, 453, 526, 433"
,"599, 393, 636, 413, 599, 433, 562, 413"
,"635, 373, 672, 393, 635, 413, 598, 393"
,"671, 353, 708, 373, 671, 393, 634, 373"
,"707, 333, 744, 353, 707, 373, 670, 353"
,"743, 313, 780, 333, 743, 353, 706, 333"
,"779, 293, 816, 313, 779, 333, 742, 313"
,"815, 273, 852, 293, 815, 313, 778, 293"
,"851, 253, 888, 273, 851, 293, 814, 273"
,"887, 233, 924, 253, 887, 273, 850, 253"
,"492, 493, 529, 513, 492, 533, 455, 513"
,"528, 473, 565, 493, 528, 513, 491, 493"
,"564, 453, 601, 473, 564, 493, 527, 473"
,"600, 433, 637, 453, 600, 473, 563, 453"
,"636, 413, 673, 433, 636, 453, 599, 433"
,"672, 393, 709, 413, 672, 433, 635, 413"
,"708, 373, 745, 393, 708, 413, 671, 393"
,"744, 353, 781, 373, 744, 393, 707, 373"
,"780, 333, 817, 353, 780, 373, 743, 353"
,"816, 313, 853, 333, 816, 353, 779, 333"
,"852, 293, 889, 313, 852, 333, 815, 313"
,"888, 273, 925, 293, 888, 313, 853, 293"
,"924, 253, 961, 273, 924, 293, 887, 273"
);

while ($donnees = mysql_fetch_assoc($result2)){

$targetalliance=$donnees["aliance_id"];
$friendarray=$database->getAllianceAlly($donnees["aliance_id"],1);
$neutralarray=$database->getAllianceAlly($donnees["aliance_id"],2);
$enemyarray=$database->getAllianceWar2($donnees["aliance_id"]);
//var_dump($friendarray);
//echo "(".$friendarray[0]['alli1'].">0 or ".$donnees["aliance_id"].">0) and (".$friendarray[0]['alli1']."==".$donnees["aliance_id"]." or ".$friendarray[0]['alli2']."==".$donnees["aliance_id"].") and (".$session->alliance." != ".$targetalliance." and ".$session->alliance." and ".$targetalliance.")<br>\n";
if (isset($friendarray[0])) {
	$friend = (($friendarray[0]['alli1']>0 and $friendarray[0]['alli2']>0 and $donnees["aliance_id"]>0) and ($friendarray[0]['alli1']==$session->alliance or $friendarray[0]['alli2']==$session->alliance) and ($session->alliance != $targetalliance and $session->alliance and $targetalliance)) ? '1':'0';
}else $friend='0';
if (isset($enemyarray[0])) {
	$war = (($enemyarray[0]['alli1']>0 and $enemyarray[0]['alli2']>0 and $donnees["aliance_id"]>0) and ($enemyarray[0]['alli1']==$session->alliance or $enemyarray[0]['alli2']==$session->alliance) and ($session->alliance != $targetalliance and $session->alliance and $targetalliance)) ? '1':'0';
}else $war='0';
if (isset($neutralarray[0])) {
	$neutral = (($neutralarray[0]['alli1']>0 and $neutralarray[0]['alli2']>0 and $donnees["aliance_id"]>0) and ($neutralarray[0]['alli1']==$session->alliance or $neutralarray[0]['alli2']==$session->alliance) and ($session->alliance != $targetalliance and $session->alliance and $targetalliance)) ? '1':'0';
}else $neutral='0';

//echo $targetalliance.">>";
//var_dump($friendarray);
//echo"|||<br>";
//var_dump($arraydiplo);
//echo in_array($targetalliance,$friendarray);
	$image = ($donnees['map_occupied'] == 1 && $donnees['map_fieldtype'] > 0)?(($donnees['ville_user'] == $session->uid)? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b30': 'b20' :'b10' : 'b00') : (($targetalliance != 0)? ($friend==1? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b31': 'b21' :'b11' : 'b01') : ($war==1? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b32': 'b22' :'b12' : 'b02') : ($neutral==1? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b35': 'b25' :'b15' : 'b05') : ($targetalliance == $session->alliance? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b33': 'b23' :'b13' : 'b03') : ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b34': 'b24' :'b14' : 'b04'))))) : ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b34': 'b24' :'b14' : 'b04'))) : $donnees['map_image'];

		// Map Attacks by Shadow and MisterX
    	$att = '';
    	if($session->plus) {
        $wref = $village->wid;
        $toWref =  $donnees['map_id'];

        if ($database->checkAttack($wref,$toWref) != 0) {
		$att = '<span class=\'m3\' ></span>';
        }elseif ($database->checkEnforce($wref,$toWref) != 0) {
		$att = '<span class=\'m9\' ></span>';
		}elseif ($database->checkScout($wref,$toWref) != 0) {
		$att = '<span class=\'m6\' ></span>';
		}
    	}

	
	// Map content
	if($donnees['ville_user']==3 && $donnees['ville_name']=='WW Buildingplan'){
	$map_content .= "<div id='i_".$row."_".$i."' class='o99'>$att</div>\r"; 
	}else{
	$map_content .= "<div id='i_".$row."_".$i."' class='".$image."'>$att</div>\r";
	}

	//Map create
	$map_gen .= "<area id='a_".$row."_".$i."' shape='poly' coords='".$coorarray[$coorindex]."' title='".$donnees['ville_name']."' href='karte.php?d=".$donnees['map_id']."&c=".$generator->getMapCheck($donnees['map_id'])."' target='_parent' />\n"; 
	
	//Javascript map info
	if($yrow!=13){
		$map_js .= "[".$donnees['map_x'].",".$donnees['map_y'].",".$donnees['map_fieldtype'].",". ((!empty($donnees['map_oasis'])) ? $donnees['map_oasis'] : 0) .",\"d=".$donnees['map_id']."&c=".$generator->getMapCheck($donnees['map_id'])."\",\"".$image."\"";
		if($donnees['map_occupied']){
			if($donnees['map_fieldtype'] != 0){
				$map_js.= ",\"".$donnees['ville_name']."\",\"".$donnees['user_username']."\",\"".$donnees['ville_pop']."\",\"".$donnees['aliance_name']."\",\"".$donnees['user_tribe']."\"]\n";
			}
		}
		elseif($donnees['map_oasis'] != 0){
			if ($donnees['oasis_conqured'] != 0){
					$map_js.= ",\"\",\"".$donnees['oasis_user']."\",\"-\",\"".$donnees['oasis_alli_name']."\",\"".$donnees['oasis_tribe']."\"]";
			} 
			else{
				$map_js.="]";
			}
		}
		else{$map_js .= "]\n";}

		if($i2 == 12 && $yrow !=12){
			$i2 = -1;
			$yrow +=1;
			$map_js .= "],\n[";
		}
		else {
			if($yrow == 12 && $i2 == 12) {$map_js .= "]\n";}
			else {$map_js .= ",";}
		}
		//$regcount += 1;
	}
	else {$map_js .= "]";}
	
	if($i == 12 && $row <= 11){	$row += 1;	$i = -1;}
	$i++;
	$i2++;
	$coorindex+=1;

}
?>


<div id="map_content">
	<div id="mbig">
		<div id="lightframe">
			<div id="darkframe"><a id="map_popclose" onClick="Close();"><img src="img/x.gif" alt="close Map" title="close Map"></a>
				<h1>Map(<span id="x"><?php echo $x;?></span>|<span id="y"><?php echo $y;?></span>)</h1>
				<div id="map">
					<script type="text/javascript">
						var text_k = {}
						text_k.details = '<?php echo DETAIL;?>';
						text_k.spieler = '<?php echo PLAYER;?>';
						text_k.einwohner = '<?php echo POP;?>';
						text_k.allianz = '<?php echo ALLIANCE;?>';
						text_k.verlassenes_tal = '<?php echo ABANDVALLEY;?>';
						text_k.besetztes_tal = '<?php echo OCCUOASIS;?>';
						text_k.freie_oase = '<?php echo UNOCCUOASIS;?>';
						var text_x = {}
						text_x.r1 = '<?php echo LUMBER;?>';
						text_x.r2 = '<?php echo CLAY;?>';
						text_x.r3 = '<?php echo IRON;?>';
						text_x.r4 = '<?php echo CROP;?>';
					</script>
					<div id="map_content">
						<?php echo $map_content;?>
						
					</div>
					<div id="map_rulers"><?php
						for($i=0;$i<=12;$i++){
						echo "<div id=\"mx".$i."\">".$xarray[$i]."</div>\n";
						echo "<div id=\"my".$i."\">".$yarray[$i]."</div>\n";
						}?>
					</div>
					<map id="map_overlay_large" name="map_overlay_large"> 
						<?php echo $map_gen;?>
						<area id="ma_n1" href="karte2.php?z=<?php echo $generator->getBaseID($x,$yp1);?>" coords="762,115,30" shape="circle" title="North"/>
						<area id="ma_n2" href="karte2.php?z=<?php echo $generator->getBaseID($xp1,$y);?>" coords="770,430,30" shape="circle" title="East"/>
						<area id="ma_n3" href="karte2.php?z=<?php echo $generator->getBaseID($x,$ym1);?>" coords="210,430,30" shape="circle" title="South"/>
						<area id="ma_n4" href="karte2.php?z=<?php echo $generator->getBaseID($xm1,$y);?>" coords="200,115,30" shape="circle" title="West"/>
					</map>
					<img id="map_links" src="img/x.gif" usemap="#map_overlay_large">
					<script type="text/javascript">
						m_c.az = {"n1":<?php echo $generator->getBaseID($x,$yp1) ?>,"n1p7":<?php echo $generator->getBaseID($x,$yp7) ?>,"n2":<?php echo $generator->getBaseID($xp1,$y) ?>,"n2p7":<?php echo $generator->getBaseID($xm7,$y) ?>,"n3":<?php echo $generator->getBaseID($x,$ym1) ?>,"n3p7":<?php echo $generator->getBaseID($x,$ym7) ?>,"n4":<?php echo $generator->getBaseID($xm1,$y) ?>,"n4p7":<?php echo $generator->getBaseID($xp7,$y) ?>};
						m_c.ad = [[<?php echo $map_js?>];
						m_c.z = {"x":<?php echo $x ?>,"y":<?php echo $y ?>};
						m_c.size = 13;
						var mdim = {"x":13,"y":13,"rad":6}
						var mmode = 0;
						function init_local(){map_init();}
					</script>
					<img id="map_navibox" src="img/x.gif" usemap="#map_navibox"/>
					<map name="map_navibox">
						<area id="ma_n1p7" href="karte.php?z=<?php echo $generator->getBaseID($x,$yp7) ?>" coords="51,15,73,3,95,15,73,27" shape="poly" title="North"/>
						<area id="ma_n2p7" href="karte.php?z=<?php echo $generator->getBaseID($xm7,$y) ?>" coords="51,41,73,29,95,41,73,53" shape="poly" title="East"/>
						<area id="ma_n3p7" href="karte.php?z=<?php echo $generator->getBaseID($x,$ym7) ?>" coords="4,41,26,29,48,41,26,53" shape="poly" title="South"/>
						<area id="ma_n4p7" href="karte.php?z=<?php echo $generator->getBaseID($xp7,$y) ?>" coords="4,15,26,3,48,15,26,27" shape="poly" title="West"/>
					</map>
					<div id="map_coords">
						<form name="map_coords" method="post" >
							<span>x </span><input id="mcx" class="text" name="xp" value="<?php echo $x ?>" maxlength="4"/>
							<span>y </span><input id="mcy" class="text" name="yp" value="<?php echo $y ?>" maxlength="4"/>
							<input type="image" id="btn_ok" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="OK" />
						</form>
					</div>
					<table cellpadding="1" cellspacing="1" id="map_infobox" class="default"><thead><tr><th colspan="2"><?php echo DETAIL;?></th></tr></thead><tbody><tr><th><?php echo PLAYER;?></th><td>-</td></tr><tr><th><?php echo POP;?></th><td>-</td></tr><tr><th><?php echo ALLIANCE;?></th><td></td></tr></tbody></table>
				</div>
			</div>
		</div>
	</div>
</div>
