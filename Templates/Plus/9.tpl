<?php
//////////////     made by alq0rsan, improved by evader   /////////////////////////
if($session->access != BANNED && $session->gold >= 5){
    $MyGold = mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
    $golds = mysqli_fetch_array($MyGold);
	if($session->sit == 0) {
		if (mysqli_num_rows($MyGold) == 1) {
			if($golds['gold'] >= 5) {
				if($golds['b1'] < time()) {
					mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set b1 = '".(time()+PLUS_PRODUCTION)."' where `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
				} else {
					mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set b1 = '".($golds['b1']+PLUS_PRODUCTION)."' where `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
				}
				$done1 = "+25% Production: Lumber";
				mysqli_query($GLOBALS['link'],"UPDATE ".TB_PREFIX."users set gold = ".($session->gold-5)." where `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
				mysqli_query($GLOBALS['link'],"INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', '+25%  Production: Lumber')") or die(mysqli_error($database->dblink));
			} else {
				$done1 = "You need more gold";
			}
		} else {
			$done1 = "Failed lumber attempt";
			mysqli_query($GLOBALS['link'],"INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', 'Failed +25%  Production: Lumber')") or die(mysqli_error($database->dblink));
		}
	}
	header("Location: plus.php?id=3");
} else {
	header("Location: banned.php");
}
?>