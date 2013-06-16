<?php 
include("GameEngine/Session.php");
header("Content-Type: application/json;");
$currentcoor = $database->getCoor($z);
$y = $currentcoor['y'];
$x = $currentcoor['x'];

$xm13 = ($x-13) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-12 : $x-13;
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
$xp13 = ($x+13) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+12: $x+13;
$ym13 = ($y-13) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-12 : $y-13;
$ym6 = ($y-6) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-5 : $y-6;
$ym5 = ($y-5) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-4 : $y-5;
$ym4 = ($y-4) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-3 : $y-4;
$ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
$ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
$ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
$yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
$yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
$yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
$yp4 = ($y+4) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+3: $y+4;
$yp5 = ($y+5) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+4 : $y+5;
$yp6 = ($y+6) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+5: $y+6;
$yp13 = ($y+13) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+12: $y+13;
$xarray = array($xm6,$xm5,$xm4,$xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3,$xp4,$xp5,$xp6);
$yarray = array($ym6,$ym5,$ym4,$ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3,$yp4,$yp5,$yp6);
$maparray = array();
$xcount = 0;
for($i=0;$i<=12;$i++) {
    if($xcount != 13) {
    array_push($maparray,$database->getMInfo($generator->getBaseID($xarray[$xcount],$yarray[$i])));
        if($i==12) {
        $i = -1;
        $xcount +=1;
        }
    }
}
echo "{\"lm\":\"<div id=\\\"mbig\\\"><div id=\\\"lightframe\\\"><div id=\\\"darkframe\\\"><a id=\\\"map_popclose\\\" href=\\\"karte.php?z=2356\\\"><img src=\\\"img\\/x.gif\\\" alt=\\\"close map\\\" title=\\\"close map\\\" \\/><\\/a><h1>Map(<span id=\\\"x\\\">";
echo $x;
echo "<\\/span>|<span id=\\\"y\\\">";
echo $y;
echo "<\\/span>)<\/h1><div id=\\\"map\\\"><div id=\\\"map_content\\\">";
$index = 0;
$row1 = 0;
for($i=0;$i<=12;$i++) {
	if($maparray[$index]['occupied'] == 1 && $maparray[$index]['fieldtype'] > 0) {
	$targetalliance = $database->getUserField($maparray[$index]['owner'],"alliance",0);
    $friendarray = array();
    $enemyarray = array();
    $neutralarray = array();
    }
   	$image = ($maparray[$index]['occupied'] == 1 && $maparray[$index]['fieldtype'] > 0)? (($maparray[$index]['owner'] == $session->uid)? ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b30': 'b20' :'b10' : 'b00') : (($targetalliance != 0)? (in_array($targetalliance,$friendarray)? ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b31': 'b21' :'b11' : 'b01') : (in_array($targetalliance,$enemyarray)? ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b32': 'b22' :'b12' : 'b02') : (in_array($targetalliance,$neutralarray)? ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b35': 'b25' :'b15' : 'b05') : ($targetalliance == $session->alliance? ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b33': 'b23' :'b13' : 'b03') : ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b34': 'b24' :'b14' : 'b04'))))) : ($maparray[$index]['pop']>=50? $maparray[$index]['pop']>= 100?$maparray[$index]['pop']>=200? 'b34': 'b24' :'b14' : 'b04'))) : $maparray[$index]['image'];
	echo "<div id=\\\"i_".$row1."_".$i."\\\" class=\\\"".$image."\\\" ><\\/div>";
	if($i == 12 && $row1 <= 11) {
		$row1 += 1;
		$i = -1;
	}
	if($row1 != 13 && $i != 12) {
		echo "\\n";
	}	
	$index+=1;
}
echo "<\\/div><div id=\\\"map_rulers\\\">";
for($i=0;$i<=12;$i++) {
	echo "<div id=\\\"mx".$i."\\\">".$xarray[$i]."<\\/div>";
}
for($i=0;$i<=12;$i++) {
	echo "<div id=\\\"my".$i."\\\">".$yarray[$i]."<\\/div>";
}
echo "<\\/div><map id=\\\"map_overlay_large\\\" name=\\\"map_overlay_large\\\">";
$coorarray = array("49, 253, 86, 273, 49, 293, 12, 273","85, 233, 122, 253, 85, 273, 48, 253","121, 213, 158, 233, 121, 253, 84, 233","157, 193, 194, 213, 157, 233, 120, 213","193, 173, 230, 193, 193, 213, 156, 193","229, 153, 266, 173, 229, 193, 192, 173","265, 133, 302, 153, 265, 173, 228, 153","301, 113, 338, 133, 301, 153, 264, 133","337, 93, 374, 113, 337, 133, 300, 113","373, 73, 410, 93, 373, 113, 336, 93","409, 53, 446, 73, 409, 93, 372, 73","445, 33, 482, 53, 445, 73, 408, 53","481, 13, 518, 33, 481, 53, 444, 33","86, 273, 123, 293, 86, 313, 49, 293","122, 253, 159, 273, 122, 293, 85, 273","158, 233, 195, 253, 158, 273, 121, 253","194, 213, 231, 233, 194, 253, 157, 233","230, 193, 267, 213, 230, 233, 193, 213","266, 173, 303, 193, 266, 213, 229, 193","302, 153, 339, 173, 302, 193, 265, 173","338, 133, 375, 153, 338, 173, 301, 153","374, 113, 411, 133, 374, 153, 337, 133","410, 93, 447, 113, 410, 133, 373, 113","446, 73, 483, 93, 446, 113, 409, 93","482, 53, 519, 73, 482, 93, 445, 73","518, 33, 555, 53, 518, 73, 481, 53","123, 293, 160, 313, 123, 333, 86, 313","159, 273, 196, 293, 159, 313, 122, 293","195, 253, 232, 273, 195, 293, 158, 273","231, 233, 268, 253, 231, 273, 194, 253","267, 213, 304, 233, 267, 253, 230, 233","303, 193, 340, 213, 303, 233, 266, 213","339, 173, 376, 193, 339, 213, 302, 193","375, 153, 412, 173, 375, 193, 338, 173","411, 133, 448, 153, 411, 173, 374, 153","447, 113, 484, 133, 447, 153, 410, 133","483, 93, 520, 113, 483, 133, 446, 113","519, 73, 556, 93, 519, 113, 482, 93","555, 53, 592, 73, 555, 93, 518, 73","160, 313, 197, 333, 160, 353, 123, 333","196, 293, 233, 313, 196, 333, 159, 313","232, 273, 269, 293, 232, 313, 195, 293","268, 253, 305, 273, 268, 293, 231, 273","304, 233, 341, 253, 304, 273, 267, 253","340, 213, 377, 233, 340, 253, 303, 233","376, 193, 413, 213, 376, 233, 339, 213","412, 173, 449, 193, 412, 213, 375, 193","448, 153, 485, 173, 448, 193, 411, 173","484, 133, 521, 153, 484, 173, 447, 153","520, 113, 557, 133, 520, 153, 483, 133","556, 93, 593, 113, 556, 133, 519, 113","592, 73, 629, 93, 592, 113, 555, 93","197, 333, 234, 353, 197, 373, 160, 353","233, 313, 270, 333, 233, 353, 196, 333","269, 293, 306, 313, 269, 333, 232, 313","305, 273, 342, 293, 305, 313, 268, 293","341, 253, 378, 273, 341, 293, 304, 273","377, 233, 414, 253, 377, 273, 340, 253","413, 213, 450, 233, 413, 253, 376, 233","449, 193, 486, 213, 449, 233, 412, 213","485, 173, 522, 193, 485, 213, 448, 193","521, 153, 558, 173, 521, 193, 484, 173","557, 133, 594, 153, 557, 173, 520, 153","593, 113, 630, 133, 593, 153, 556, 133","629, 93, 666, 113, 629, 133, 592, 113","234, 353, 271, 373, 234, 393, 197, 373","270, 333, 307, 353, 270, 373, 233, 353","306, 313, 343, 333, 306, 353, 269, 333","342, 293, 379, 313, 342, 333, 305, 313","378, 273, 415, 293, 378, 313, 341, 293","414, 253, 451, 273, 414, 293, 377, 273","450, 233, 487, 253, 450, 273, 413, 253","486, 213, 523, 233, 486, 253, 449, 233","522, 193, 559, 213, 522, 233, 485, 213","558, 173, 595, 193, 558, 213, 521, 193","594, 153, 631, 173, 594, 193, 557, 173","630, 133, 667, 153, 630, 173, 593, 153","666, 113, 703, 133, 666, 153, 629, 133","271, 373, 308, 393, 271, 413, 234, 393","307, 353, 344, 373, 307, 393, 270, 373","343, 333, 380, 353, 343, 373, 306, 353","379, 313, 416, 333, 379, 353, 342, 333","415, 293, 452, 313, 415, 333, 378, 313","451, 273, 488, 293, 451, 313, 414, 293","487, 253, 524, 273, 487, 293, 450, 273","523, 233, 560, 253, 523, 273, 486, 253","559, 213, 596, 233, 559, 253, 522, 233","595, 193, 632, 213, 595, 233, 558, 213","631, 173, 668, 193, 631, 213, 594, 193","667, 153, 704, 173, 667, 193, 630, 173","703, 133, 740, 153, 703, 173, 666, 153","308, 393, 345, 413, 308, 433, 271, 413","344, 373, 381, 393, 344, 413, 307, 393","380, 353, 417, 373, 380, 393, 343, 373","416, 333, 453, 353, 416, 373, 379, 353","452, 313, 489, 333, 452, 353, 415, 333","488, 293, 525, 313, 488, 333, 451, 313","524, 273, 561, 293, 524, 313, 487, 293","560, 253, 597, 273, 560, 293, 523, 273","596, 233, 633, 253, 596, 273, 559, 253","632, 213, 669, 233, 632, 253, 595, 233","668, 193, 705, 213, 668, 233, 631, 213","704, 173, 741, 193, 704, 213, 667, 193","740, 153, 777, 173, 740, 193, 703, 173","345, 413, 382, 433, 345, 453, 308, 433","381, 393, 418, 413, 381, 433, 344, 413","417, 373, 454, 393, 417, 413, 380, 393","453, 353, 490, 373, 453, 393, 416, 373","489, 333, 526, 353, 489, 373, 452, 353","525, 313, 562, 333, 525, 353, 488, 333","561, 293, 598, 313, 561, 333, 524, 313","597, 273, 634, 293, 597, 313, 560, 293","633, 253, 670, 273, 633, 293, 596, 273","669, 233, 706, 253, 669, 273, 632, 253","705, 213, 742, 233, 705, 253, 668, 233","741, 193, 778, 213, 741, 233, 704, 213","777, 173, 814, 193, 777, 213, 740, 193","382, 433, 419, 453, 382, 473, 345, 453","418, 413, 455, 433, 418, 453, 381, 433","454, 393, 491, 413, 454, 433, 417, 413","490, 373, 527, 393, 490, 413, 453, 393","526, 353, 563, 373, 526, 393, 489, 373","562, 333, 599, 353, 562, 373, 525, 353","598, 313, 635, 333, 598, 353, 561, 333","634, 293, 671, 313, 634, 333, 597, 313","670, 273, 707, 293, 670, 313, 633, 293","706, 253, 743, 273, 706, 293, 669, 273","742, 233, 779, 253, 742, 273, 705, 253","778, 213, 815, 233, 778, 253, 741, 233","814, 193, 851, 213, 814, 233, 777, 213","419, 453, 456, 473, 419, 493, 382, 473","455, 433, 492, 453, 455, 473, 418, 453","491, 413, 528, 433, 491, 453, 454, 433","527, 393, 564, 413, 527, 433, 490, 413","563, 373, 600, 393, 563, 413, 526, 393","599, 353, 636, 373, 599, 393, 562, 373","635, 333, 672, 353, 635, 373, 598, 353","671, 313, 708, 333, 671, 353, 634, 333","707, 293, 744, 313, 707, 333, 670, 313","743, 273, 780, 293, 743, 313, 706, 293","779, 253, 816, 273, 779, 293, 742, 273","815, 233, 852, 253, 815, 273, 778, 253","851, 213, 888, 233, 851, 253, 814, 233","456, 473, 493, 493, 456, 513, 419, 493","492, 453, 529, 473, 492, 493, 455, 473","528, 433, 565, 453, 528, 473, 491, 453","564, 413, 601, 433, 564, 453, 527, 433","600, 393, 637, 413, 600, 433, 563, 413","636, 373, 673, 393, 636, 413, 599, 393","672, 353, 709, 373, 672, 393, 635, 373","708, 333, 745, 353, 708, 373, 671, 353","744, 313, 781, 333, 744, 353, 707, 333","780, 293, 817, 313, 780, 333, 743, 313","816, 273, 853, 293, 816, 313, 779, 293","852, 253, 889, 273, 852, 293, 815, 273","888, 233, 925, 253, 888, 273, 851, 253","493, 493, 530, 513, 493, 533, 456, 513","529, 473, 566, 493, 529, 513, 492, 493","565, 453, 602, 473, 565, 493, 528, 473","601, 433, 638, 453, 601, 473, 564, 453","637, 413, 674, 433, 637, 453, 600, 433","673, 393, 710, 413, 673, 433, 636, 413","709, 373, 746, 393, 709, 413, 672, 393","745, 353, 782, 373, 745, 393, 708, 373","781, 333, 818, 353, 781, 373, 744, 353","817, 313, 854, 333, 817, 353, 780, 333","853, 293, 890, 313, 853, 333, 816, 313","889, 273, 926, 293, 889, 313, 852, 293","925, 253, 962, 273, 925, 293, 888, 273");
$row = 0;
$coorindex = 0;
for($i=0;$i<=12;$i++) {
	echo "<area id=\\\"a_".$row."_".$i."\\\" shape=\\\"poly\\\" coords=\\\"".$coorarray[$coorindex]."\\\" title=\\\"".$maparray[$coorindex]['name']."\\\" href=\\\"karte.php?d=".$maparray[$coorindex]['id']."&c=".$generator->getMapCheck($maparray[$coorindex]['id'])."\\\" \\/>";
	if($i == 12 && $row <= 11) {
		$row += 1;
		$i = -1;
	}
	if($row1 != 13 && $i != 12) {
		echo "\\n";
	}
	$coorindex+=1;
}
echo "<area id=\\\"ma_n1\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($x,$yp1);
echo "\\\" coords=\\\"762,115,30\\\" shape=\\\"circle\\\" title=\\\"North\\\"\\/>\\n";
echo "<area id=\\\"ma_n2\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($xp1,$y);
echo "\\\" coords=\\\"770,430,30\\\" shape=\\\"circle\\\" title=\\\"East\\\"\\/>\\n";
echo "<area id=\\\"ma_n3\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($x,$ym1);
echo "\\\" coords=\\\"210,430,30\\\" shape=\\\"circle\\\" title=\\\"South\\\"\\/>\\n";
echo "<area id=\\\"ma_n4\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($xm1,$y);
echo "\\\" coords=\\\"200,115,30\\\" shape=\\\"circle\\\" title=\\\"West\\\"\\/>\\n";
echo "<\\/map><img id=\\\"map_links\\\" src=\\\"img\\/x.gif\\\" usemap=\\\"#map_overlay_large\\\" \\/><img id=\\\"map_navibox\\\" src=\\\"img\\/x.gif\\\" usemap=\\\"#map_navibox\\\"\\/><map name=\\\"map_navibox\\\">";
echo"<area id=\\\"ma_n1p7\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($x,$yp13);
echo "\\\" coords=\\\"51,15,73,3,95,15,73,27\\\" shape=\\\"poly\\\" title=\\\"North\\\"\\/>\\n";
echo"<area id=\\\"ma_n2p7\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($xm13,$y);
echo "\\\" coords=\\\"51,41,73,29,95,41,73,53\\\" shape=\\\"poly\\\" title=\\\"East\\\"\\/>\\n";
echo"<area id=\\\"ma_n3p7\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($x,$ym13);
echo "\\\" coords=\\\"4,41,26,29,48,41,26,53\\\" shape=\\\"poly\\\" title=\\\"South\\\"\\/>\\n";
echo"<area id=\\\"ma_n4p7\\\" href=\\\"karte2.php?z=";
echo $generator->getBaseID($xp13,$y);
echo "\\\" coords=\\\"4,15,26,3,48,15,26,27\\\" shape=\\\"poly\\\" title=\\\"West\\\"\\/>\\n";
echo "<\\/map><div id=\\\"map_coords\\\"><form name=\\\"map_coords\\\" method=\\\"post\\\" action=\\\"karte2.php\\\">\\n\\t\\t\\t<span>x <\\/span><input id=\\\"mcx\\\" class=\\\"text\\\" name=\\\"xp\\\" value=\\\"";
echo $x; 
echo "\\\" maxlength=\\\"4\\\"\\/>\\n\\t\\t\\t<span>y <\\/span><input id=\\\"mcy\\\" class=\\\"text\\\" name=\\\"yp\\\" value=\\\"";
echo $y;
echo "\\\" maxlength=\\\"4\\\"\\/>\\n\\t\\t\\t<input type=\\\"image\\\" id=\\\"btn_ok\\\" class=\\\"dynamic_img\\\" value=\\\"ok\\\" name=\\\"s1\\\" src=\\\"img\\/x.gif\\\" alt=\\\"\\\" \\/>\\n\\t\\t\\t<\\/form><\\/div><table cellpadding=\\\"1\\\" cellspacing=\\\"1\\\" id=\\\"map_infobox\\\" class=\\\"default\\\"><thead><tr><th colspan=\\\"2\\\">Details<\\/th><\\/tr><\\/thead><tbody><tr><th>Player<\\/th><td>-<\\/td><\\/tr><tr><th>Population<\\/th><td>-<\\/td><\\/tr><tr><th>Alliance<\\/th><td>-<\\/td><\\/tr><\\/tbody><\\/table><\\/div><\\/div><\\/div><\\/div>\",\"dat\":{\"m_c\":{\"az\":{\"n1\":";
echo $generator->getBaseID($x,$yp1);
echo ",\"n1p7\":";
echo $generator->getBaseID($x,$yp13);
echo ",\"n2\":";
echo $generator->getBaseID($xp1,$y);
echo ",\"n2p7\":";
echo $generator->getBaseID($xm13,$y);
echo ",\"n3\":";
echo $generator->getBaseID($x,$ym1);
echo ",\"n3p7\":";
echo $generator->getBaseID($x,$ym13);
echo ",\"n4\":";
echo $generator->getBaseID($xm1,$y);
echo ",\"n4p7\":";
echo $generator->getBaseID($xp13,$y);
echo "},\"ad\":[";
$yrow = 0;
$regcount = 0;
	echo "[";
for($h=0;$h<=12;$h++) {
	if($yrow!=13) {
		$text = "[".$maparray[$regcount]['x'].",".$maparray[$regcount]['y'].",".$maparray[$regcount]['fieldtype'].",".$maparray[$regcount]['oasistype'].",\"d=".$maparray[$regcount]['id']."&c=".$generator->getMapCheck($maparray[$regcount]['id'])."\",\"".$maparray[$regcount]['image']."\"";
		if($maparray[$regcount]['occupied']) {
			if($maparray[$regcount]['fieldtype'] != 0) {
			$text.= ",\"".$maparray[$regcount]['name']."\",\"".$database->getUserField($maparray[$regcount]['owner'],'username',0)."\",\"".$maparray[$regcount]['pop']."\",\"".$database->getUserAlliance($maparray[$regcount]['owner'])."\",\"".$database->getUserField($maparray[$regcount]['owner'],'tribe',0)."\"]";
			}
			else {
				$oasisinfo = $database->getOasisInfo($maparray[$regcount]['id']);
				$oowner = $database->getVillageField($oasisinfo['conqured'],"owner");
				$text.= ",\"\",\"".$database->getUserField($oowner,'username',0)."\",\"-\",\"".$database->getUserAlliance($oowner)."\",\"".$database->getUserField($oowner,'tribe',0)."\"]";
			}
		}
		else {
			$text .= "]";
		}
		echo $text;
		if($h == 12 && $yrow !=12) {
			$h = -1;
			$yrow +=1;
			echo "],[";
		}
		else {
			if($yrow == 12 && $h == 12) {
				echo "]";
			}
			else {
			echo ",";
			}
		}
		$regcount += 1;
	}
	else {
		echo "]";
		exit;
	}
}
echo "],\"z\":{\"x\":";
echo $x;
echo ",\"y\":";
echo $y;
echo "},\"size\":13},\"mdim\":{\"x\":13,\"y\":13,\"rad\":6},\"mmode\":0}}";																																																																																																									
?>