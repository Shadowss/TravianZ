<?php			   
	//gp link
	if($session->gpack == null || GP_ENABLE == false) {
	$gpack= GP_LOCATE;
	} else {
	$gpack= $session->gpack;
	}

	
//de bird
if($displayarray['protect'] > time()){
$uurover=date('H:i:s', ($displayarray['protect']-time())-3600);
$profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tn.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>This player has '.$uurover.' hours of beginners protection left.</td></tr></table>\')">', $profiel, 1);
} else {
$geregistreerd=date('d-m-Y', ($displayarray['timestamp']));
$profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tnd.gif" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>This player registered his account on '.$geregistreerd.'.</td></tr></table>\')">', $profiel, 1);
}

//natar image
if($displayarray['username'] == "Natars"){
$profiel = preg_replace("/\[#natars]/is",'<img src="'.$gpack.'img/t/t10_2.jpg" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official Natar account</td></tr></table>\')">', $profiel, 1);
$profiel = preg_replace("/\[#WW]/is",'<img src="'.$gpack.'img/t/g40_11-ltr.png" width="250" border="0" onmouseout="med_closeDescription()" onmousemove="med_mouseMoveHandler(arguments[0],\'<table><tr><td>Official World Wonder Village</td></tr></table>\')">', $profiel, 1);
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
        $titel="Receiving this medal shows that you where in the top 10 of both attacckers and defenders of the week.";
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
        $titel="Receiving this medal shows that you were in the top 3 of the Rank Climbers of the week ".$medal['points']." in a row.";
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

