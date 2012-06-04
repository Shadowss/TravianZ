<?php
//////////////     made by alq0rsan   /////////////////////////
if($session->access != BANNED){
if($session->gold >= 100 && $session->sit == 0 && $session->goldclub == 0) {
mysql_query("UPDATE ".TB_PREFIX."users set goldclub = 1, gold = gold - 100 where `username`='".$session->username."'");
}
header("Location: plus.php?id=3");

}else{
header("Location: banned.php");
}
 ?>