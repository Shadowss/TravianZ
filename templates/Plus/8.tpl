<?php
//////////////     made by alq0rsan, improved by evader   /////////////////////////
if($session->gold >= 10){
    $MyGold = mysqli_query($database->dblink,"SELECT gold, plus FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
    $golds = mysqli_fetch_array($MyGold);
	if($session->sit == 0) {
		if (mysqli_num_rows($MyGold) == 1) {
			if($golds['gold'] >= 10) {
				if($golds['plus'] == 0) {
					mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."users set plus = ('".mktime(date("H"),date("i"), date("s"),date("m") , date("d"), date("Y"))."')+".PLUS_TIME." where `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
				} else {
					mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."users set plus = '".($golds['plus']+PLUS_TIME)."' where `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
				}
				$done1 = "&nbsp;&nbsp;Plus Account";
				mysqli_query($database->dblink,"UPDATE ".TB_PREFIX."users set gold = ".($session->gold-10)." where `id`='".$session->uid."'") or die(mysqli_error($database->dblink));
				mysqli_query($database->dblink,"INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', 'Plus Account')") or die(mysqli_error($database->dblink));
			} else {
				$done1 = "&nbsp;&nbsp;You need more gold";
			}
		} else {
			$done1 = "Failed plus attempt";
			mysqli_query($database->dblink,"INSERT INTO ".TB_PREFIX."gold_fin_log (wid,log) VALUES ('".$village->wid."', 'Failed Plus Account')") or die(mysqli_error($database->dblink));
		}
	}
	header("Location: plus.php?id=3");
	exit;
}
 ?>