<?php
//////////////     made by alq0rsan, improved by evader   /////////////////////////
if($session->access != BANNED && $session->gold >= 5){
    $MyGold = mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysqli_error());
    $golds = mysqli_fetch_array($MyGold);
	if($session->sit == 0) {
		if (mysqli_num_rows($MyGold)) {
			if($golds['gold'] >= 5) {
				if($golds['b4'] < time()) {
					mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set b4 = '".(time()+PLUS_PRODUCTION)."' where `id`='".$session->uid."'") or die(mysqli_error());
				} else {
					mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set b4 = '".($golds['b4']+PLUS_PRODUCTION)."' where `id`='".$session->uid."'") or die(mysqli_error());
				}
				$done1 = "+25% Production: Crop";
				mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set gold = ".($session->gold-5)." where `id`='".$session->uid."'") or die(mysqli_error());
				mysqli_query($GLOBALS['link'],"INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', '+25%  Production: Crop')") or die(mysqli_error());
			} else {
				$done1 = "You need more gold";
			}
		} else {
			$done1 = "Failed crop attempt";
			mysqli_query($GLOBALS['link'],"INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', 'Failed +25%  Production: Crop')") or die(mysqli_error());
		}
	}
	header("Location: plus.php?id=3");
} else {
	header("Location: banned.php");
}
 ?>