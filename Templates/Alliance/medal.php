<?php			   
	//gp link
	if($session->gpack == null || GP_ENABLE == false) {
	$gpack= GP_LOCATE;
	} else {
	$gpack= $session->gpack;
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
$geregistreerd=date('d-m-Y', ($allianceinfo['timestamp']));

$profiel = preg_replace("/\[war]/s",'At war with<br>'.$database->getAllianceDipProfile($aid,3), $profiel, 1); 
$profiel = preg_replace("/\[ally]/s",'Confederacies<br>'.$database->getAllianceDipProfile($aid,1), $profiel, 1); 
$profiel = preg_replace("/\[nap]/s",'NAPs<br>'.$database->getAllianceDipProfile($aid,2), $profiel, 1); 
$profiel = preg_replace("/\[diplomatie]/s",'Confederacies<br>'.$database->getAllianceDipProfile($aid,1).'<br>NAPs<br>'.$database->getAllianceDipProfile($aid,2).'<br>At war with<br>'.$database->getAllianceDipProfile($aid,3), $profiel, 1); 


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
        $titel="Climbers of the week(Ranks)";
 		$woord="Ranks";
       break;
    case "4":
        $titel="Robbers of the week";
		$woord="Resources";
        break;
	 case "5":
        $titel="Receiving this medal shows that your alliance was in the top 3 of both attacckers and defenders of the week.";
        $bonus[$medal['id']]=1;
		break;
	 case "6":
        $titel="Receiving this medal shows that your alliance was in the top 3 of the attackers of the week ".$medal['points']." in a row";
        $bonus[$medal['id']]=1;
		break;
	 case "7":
        $titel="Receiving this medal shows that your alliance was in the top 3 of the deffenders of the week ".$medal['points']." in a row";
        $bonus[$medal['id']]=1;
		break;
	 case "8":
        $titel="Receiving this medal shows that your alliance was in the top 3 of the rank climbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
		break;
	 case "9":
        $titel="Receiving this medal shows that your alliance was in the top 3 of the robbers of the week ".$medal['points']." in a row.";
        $bonus[$medal['id']]=1;
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

