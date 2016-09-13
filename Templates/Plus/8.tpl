<?php
//////////////     made by alq0rsan   /////////////////////////
if($session->access != BANNED && $session->gold >= 10){
    $MyGold = mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysqli_error());
    $golds = mysqli_fetch_array($MyGold);

    $MyId = mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysqli_error());
    $uuid = mysqli_fetch_array($MyId);


    $MyVilId = mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."bdata WHERE `wid`='".$village->wid."'") or die(mysqli_error());
    $uuVilid = mysqli_fetch_array($MyVilId);


    $goldlog = mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."gold_fin_log") or die(mysqli_error());

        $today = date("mdHi");
if($session->sit == 0) {
if (mysqli_num_rows($MyGold)) {
	if($golds['6'] > 2) {

if (mysqli_num_rows($MyGold)) {


if($golds['12'] == 0) {
mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set plus = ('".mktime(date("H"),date("i"), date("s"),date("m") , date("d"), date("Y"))."')+".PLUS_TIME." where `id`='".$session->uid."'") or die(mysqli_error());
} else {
mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set plus = '".($golds['12']+PLUS_TIME)."' where `id`='".$session->uid."'") or die(mysqli_error());
}


$done1 = "&nbsp;&nbsp;Plus Account";
    mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set gold = ".($session->gold-10)." where `id`='".$session->uid."'") or die(mysqli_error());
    mysqli_query($GLOBALS['link'],"INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysqli_num_rows($goldlog)+1)."', '".$village->wid."', 'Plus Account')") or die(mysqli_error());

} else {
$done1 = "nothing has been done";
    mysqli_query($GLOBALS['link'],"INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysqli_num_rows($goldlog)+1)."', '".$village->wid."', 'Failed Plus Account')") or die(mysqli_error());

}
} else {
		$done1 = "&nbsp;&nbsp;You need more gold";
}
}
}






header("Location: plus.php?id=3");
}else{
header("Location: banned.php");
}
 ?>