<?php
//////////////     made by alq0rsan   /////////////////////////
if($session->access != BANNED){
if($session->gold >= 100) {
mysql_query("UPDATE ".TB_PREFIX."users set goldclub = 1, gold = gold - 100 where `username`='".$session->username."'");
}
include("Templates/Plus/3.tpl");
}else{
header("Location: banned.php");
}
 ?>