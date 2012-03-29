<?php
//////////////     made by alq0rsan MADE BETER BY advocaite   /////////////////////////
if($session->access != BANNED){
    $MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
    $golds = mysql_fetch_array($MyGold);

    $MyId = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `username`='".$session->username."'") or die(mysql_error());
    $uuid = mysql_fetch_array($MyId);


    $MyVilId = mysql_query("SELECT * FROM ".TB_PREFIX."bdata WHERE `wid`='".$village->wid."'") or die(mysql_error());
    $uuVilid = mysql_fetch_array($MyVilId);
    $MyVilId2 = mysql_query("SELECT * FROM ".TB_PREFIX."research WHERE `vref`='".$village->wid."'") or die(mysql_error());
    $uuVilid2 = mysql_fetch_array($MyVilId2);


    $goldlog = mysql_query("SELECT * FROM ".TB_PREFIX."gold_fin_log") or die(mysql_error());

        $today = date("mdHi");

if (mysql_num_rows($MyGold)) {
    if($golds['6'] > 2) {

if (mysql_num_rows($MyVilId) || mysql_num_rows($MyVilId2)) {

mysql_query("UPDATE ".TB_PREFIX."bdata set timestamp = '1' where wid = ".$village->wid." AND type != '25' OR type != '26'") or die(mysql_error());
mysql_query("UPDATE ".TB_PREFIX."research set timestamp = '1' where vref = '".$village->wid."'") or die(mysql_error());



$done1 = "&nbsp;&nbsp; All construction orders and Researches in this village has been Completed";
    mysql_query("UPDATE ".TB_PREFIX."users set gold = ".($session->gold-2)." where `username`='".$session->username."'") or die(mysql_error());
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Finish construction and research with gold')") or die(mysql_error());

} else {
$done1 = "&nbsp;&nbsp; Nothing has been Completed";
    mysql_query("INSERT INTO ".TB_PREFIX."gold_fin_log VALUES ('".(mysql_num_rows($goldlog)+1)."', '".$village->wid."', 'Failed construction and research with gold')") or die(mysql_error());

}
} else {
        $done1 = "&nbsp;&nbsp;You need more Gold";
}
}


print "<BR><BR><BR><BR>";

echo $done1;

print "<BR>";

include("Templates/Plus/3.tpl");
}else{
header("Location: banned.php");
}
 ?>