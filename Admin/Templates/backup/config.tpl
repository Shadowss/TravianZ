<?
if($_POST){
$database->update_config($_POST);
$database->reload('admin.php?page=1');
}
?>
<form action="" method="post">
<table id="del_acc" class="account" cellpadding="1" cellspacing="1"><thead>
<tr>
	<th colspan="2">Server Settings</th>
</tr>
</thead><tbody>

<tr>
  <th>Title name:</th>
  <td><input class="text" name="SERVER_NAME" value="<?php echo SERVER_NAME;?>" maxlength="20" type="text"></td>
</tr>
<tr>
  <th>Language:</th>
  <td>
  <select class="dropdown" name="LANG"">
<?php
$handle=opendir('GameEngine/lang');
while (false!==($file = readdir($handle)))
{
	if (similar_text(".",$file)<1)
	{
		if(LANG==$file){$sel = "selected";}else{$sel = "";}
		echo '<option value="'.$file.'"'.$sel.'>'.$file.'</option>\n';
   }
}
closedir($handle);
?>
		</select>

  </td>
</tr>
<tr>
  <th>Speed</th>
  <td class="speed">
  <input class="radio" name="SPEED" value="1" <?php if(SPEED==1){echo 'checked';}?> type="radio"> 1x
  <input class="radio" name="SPEED" value="2" <?php if(SPEED==2){echo 'checked';}?> type="radio"> 2x
  <input class="radio" name="SPEED" value="3" <?php if(SPEED==3){echo 'checked';}?> type="radio"> 3x
  <input class="radio" name="SPEED" value="5" <?php if(SPEED==5){echo 'checked';}?> type="radio"> 5x
  <input class="radio" name="SPEED" value="10" <?php if(SPEED==10){echo 'checked';}?> type="radio"> 10x
  </td>
</tr>
<tr>
  <th>Graphic pack:</th>
  <td>
  <input type="radio"  name="GP_ENABLE" <?php if(GP_ENABLE==1){echo 'checked';}?> value="1"> On
  <input type="radio"  name="GP_ENABLE" <?php if(GP_ENABLE==0){echo 'checked';}?> value="0"> Off
  </td>
</tr>
<tr>
  <th>Server online:</th>
  <td>
  <input class="checkbox" name="active" value="1" <?php if(active==1){echo 'checked';}?> type="radio"> On
  <input class="checkbox" name="active" value="0" <?php if(active==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Censored:</th>
  <td>
	<input class="checkbox" name="WORD_CENSOR" value="1" <?php if(WORD_CENSOR==1){echo 'checked';}?> type="radio"> On
	<input class="checkbox" name="WORD_CENSOR" value="0" <?php if(WORD_CENSOR==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Censored words:</th>
  <td><textarea class="text" name="CENSORED" maxlength="100"><?php echo CENSORED;?></textarea></td>
</tr>
<tr>
  <th>Log build:</th>
  <td>
  <input class="radio" name="LOG_BUILD" value="1" <?php if(LOG_BUILD==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_BUILD" value="0" <?php if(LOG_BUILD==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log Technology:</th>
  <td>
  <input class="radio" name="LOG_TECH" value="1" <?php if(LOG_TECH==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_TECH" value="0" <?php if(LOG_TECH==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log Login:</th>
  <td>
  <input class="radio" name="LOG_LOGIN" value="1" <?php if(LOG_LOGIN==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_LOGIN" value="0" <?php if(LOG_LOGIN==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log Gold:</th>
  <td>
  <input class="radio" name="LOG_GOLD_FIN" value="1" <?php if(LOG_GOLD_FIN==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_GOLD_FIN" value="0" <?php if(LOG_GOLD_FIN==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log Admin:</th>
  <td>
  <input class="radio" name="LOG_ADMIN" value="1" <?php if(LOG_ADMIN==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_ADMIN" value="0" <?php if(LOG_ADMIN==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log War:</th>
  <td>
  <input class="radio" name="LOG_WAR" value="1" <?php if(LOG_WAR==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_WAR" value="0" <?php if(LOG_WAR==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log Market:</th>
  <td>
  <input class="radio" name="LOG_MARKET" value="1" <?php if(LOG_MARKET==1){echo 'checked';}?> type="radio"> On
  <input class="radio" name="LOG_MARKET" value="0" <?php if(LOG_MARKET==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Log Illegal:</th>
  <td>
  <input class="checkbox" name="LOG_ILLEGAL" value="1" <?php if(LOG_ILLEGAL==1){echo 'checked';}?> type="radio"> On
  <input class="checkbox" name="LOG_ILLEGAL" value="0" <?php if(LOG_ILLEGAL==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
<tr>
  <th>Bug Report:</th>
  <td>
  <input class="checkbox" name="BUG_REPORT" value="1" <?php if(BUG_REPORT==1){echo 'checked';}?> type="radio"> On
  <input class="checkbox" name="BUG_REPORT" value="0" <?php if(BUG_REPORT==0){echo 'checked';}?> type="radio"> Off
  </td>
</tr>
</tbody></table>
<input type="submit">
</form>