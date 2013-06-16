<?php
//////////////     made by alq0rsan   /////////////////////////
if($session->access != BANNED){
    $MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
    $golds = mysql_fetch_array($MyGold);

    $MyId = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
    $uuid = mysql_fetch_array($MyId);


    $MyVilId = mysql_query("SELECT * FROM ".TB_PREFIX."bdata WHERE `wid`='".$village->wid."'") or die(mysql_error());
    $uuVilid = mysql_fetch_array($MyVilId);


    $goldlog = mysql_query("SELECT * FROM ".TB_PREFIX."gold_fin_log") or die(mysql_error());

        $today = date("mdHi");
if($session->sit == 0) {
if (mysql_num_rows($MyGold)) {
	if($golds['6'] > 2) {

if (mysql_num_rows($MyGold)) {

if($golds['b3'] < time()) {
mysql_query("UPDATE ".TB_PREFIX."users set b3 = '".(time()+PLUS_PRODUCTION)."' where `id`='".$session->uid."'") or die(mysql_error());
} else {
mysql_query("UPDATE ".TB_PREFIX."users set b3 = '".($golds['b3']+PLUS_PRODUCTION)."' where `id`='".$session->uid."'") or die(mysql_error());
}


$done1 = "+25% Production: Iron";
    mysql_query("UPDATE ".TB_PREFIX."users set gold = ".($session->gold-5)." where `id`='".$session->uid."'") or die(mysql_error());
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', '+25%  Production: Iron')") or die(mysql_error());

} else {
$done1 = "nothing has been done";
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Failed +25%  Production: Iron')") or die(mysql_error());

}
} else {
		$done1 = "You need more gold";
}
}
}






header("Location: plus.php?id=3");
}else{
header("Location: banned.php");
}
 ?>