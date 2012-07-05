<?php

//////////////     edited by Pyrrhic of A.G.B.   /////////////////////////


include("Templates/Plus/pmenu.tpl");


	echo " <br /><div align=center><h2>Get <font color=#71D000>P</font><font color=#FF6F0F>l</font><font  color=#71D000>u</font><font color=#FF6F0F>s</font></h2>";
	echo " <br /> To enter you login then select the plus site. <br />You will be redirected to the plus site.";
	echo " <br /> <i>The plus system will be monitored. Account name, site plus on ip, <br /> and points given are logged,<br /> if caught cheating account will be banned.</i> <br /> <br /> </div>";

if(!$_POST['plus']){
echo <<<EOT
<form method="POST">
<table border="0" width="300" align="center">
<tr><td><b>$session->username</b></td></tr>
<tr><td align=center><b>Select Reward: </b>
		<select name="reward">
			<option value="error" selected>Select reward...</option>
			<option value="p_plus">VIP Account</option>
			<option value="p_b1">Lumber</option>
			<option value="p_b2">Clay</option>
			<option value="p_b3">Iron</option>
			<option value="p_b4">Crop </option>";
		</select><br/><br/>
  <input type="submit" name="plus" value="Get Now"></td></tr>
</table>
</form>
<br /> <br /> 

EOT;
}else{

    $account = mysql_real_escape_string($_POST['username']);
    $reward = mysql_real_escape_string($_POST['reward']);
    $valid=TRUE;


    if($reward == ""){
        echo "<b>ERROR:</b><br />";
        echo "Please select a reward.";
        echo "<br /><br /><input type=\"button\" value=\"Back\" onclick=\"history.go(-1)\">";
        $valid=FALSE;
    }

    if(!$valid) break;
    $valid=TRUE; 
/////////////////////////////////////////////////////////
    $plusTime = 604800; // 7 days
    $time = time();
    $giveplus = ($time + $plustime);
    $accountCheck = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
    if(mysql_num_rows($accountCheck) <= 0){
        echo "<b>ERROR:</b><br />";
        echo "The account name you entered does not exist.";
        echo "<br /><br /><input type=\"button\" value=\"Back\" onclick=\"history.go(-1)\">";
        $valid=FALSE;
    }
    if(!$valid) break;
    $valid=TRUE;
    $acc = mysql_fetch_array($accountCheck);

    $plusCheck = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
    $pluss = mysql_fetch_array($plusCheck);

    switch($reward){
      case 'p_plus':
        $key='plus';
        $gldz='10';
        $url='URL=./plus.php?id=3';
        break;
      case 'p_b1':
        $key ='b1';
        $gldz='5';
        $url='URL=./plus.php?id=3';
        break;
      case 'p_b2':
        $key ='b2';
        $gldz='5';
        $url='URL=./plus.php?id=3';
        break;
      case 'p_b3':
        $key ='b3';
        $gldz='5';
        $url='URL=./plus.php?id=3';
        break;
      case 'p_b4':
        $key ='b4';
        $gldz='5';
        $url='URL=./plus.php?id=3';
        break;

      default:
echo' Please select the option you wish to activate or extend.<br>';
        $valid=FALSE;
        break;
    }
    if(!$valid) break;
    $valid=TRUE;
    


    if(mysql_num_rows($plusCheck) > 0){ 
        if($time > $pluss[$key] ){
            $editplus = mysql_query("UPDATE ".TB_PREFIX."users SET `{$key}`= `{$key}` + ('".$time."'+'".$plusTime."'),  `gold` =  `gold` - {$gldz}   WHERE `id`='".$session->uid."'") or die(mysql_error());
            echo "<META HTTP-EQUIV=Refresh CONTENT=\"2; {$url}\" ><br /><br /><div align=center><font color=green size=4><b> Your Status has been updated!</b></font></div>";
       }else
        if($time < $pluss[$key]){
            $editplus = mysql_query("UPDATE ".TB_PREFIX."users SET `{$key}`= `{$key}` +'".$plusTime."',  `gold` =  `gold` - {$gldz}  WHERE `id`='".$session->uid."'") or die(mysql_error());
            echo "<META HTTP-EQUIV=Refresh CONTENT=\"2; {$url}\" ><br /><br /><div align=center><font color=green size=4><b> Your Status has been updated!</b></font></div>";
       
       }
    }
else{
        $insertplus = mysql_query("INSERT INTO ".TB_PREFIX."users (`username`,`{$key}`, `gold`) VALUES ('".$session->username."', ('".$time."'+'".$plusTime."'),`gold` - {$gldz})") or die(mysql_error());
        echo "<META HTTP-EQUIV=Refresh CONTENT=\"3; {$url})\" ><br /><br /><div align=center><font color=green size=4><b> Your Status has been updated!</b></font></div>";
	 }   
}


?>
</div>