<h5><img src="img/en/t2/newsbox2.gif" alt="newsbox 2"></h5>
<?php

$online = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*10) AND tribe!=0 AND tribe!=4 AND tribe!=5"));


?>

<div class="news">
<b><left>Online Users     &nbsp;&nbsp;&nbsp;: <font color="Red"><?php echo $online ?> users</font></left></b></br>
<b><left>Server Speed     &nbsp;&nbsp;: <font color="Red"><?php echo ''.SPEED.'x';?></font></left></b></br>
<b><left>Troop Speed      &nbsp;&nbsp;&nbsp;&nbsp;: <font color="Red"><?php echo INCREASE_SPEED;?>x</font></left></b></br>
<b><left>Evasion Speed    &nbsp;: <font color="Red"><?php echo EVASION_SPEED;?></font></left></b></br>
<b><left>Map Size         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <font color="Red"><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></font></left></b></br>
<b><left>Village Exp.     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <font color="Red"><?php if(CP == 0){ echo "Fast"; } else if(CP == 1){ echo "Slow"; } ?></font></left></b></br>
<b><left>Beginners Prot.  : <font color="Red"><?php echo (PROTECTION/3600);?> hrs</font></left></b></br>
<b><left>Medal Interval   &nbsp;&nbsp;: <font color="Red"><?php if(MEDALINTERVAL >= 86400){ echo ''.(MEDALINTERVAL/86400).' Days'; } else if(MEDALINTERVAL < 86400){ echo ''.(MEDALINTERVAL/3600).' Hours'; } ?></font></left></b></br>
<b><left>Server Start     : <font color="Red"><?php echo START_DATE;?></font></left></b><br /><br />
<b><u><center>Released by: Shadow</u></b><br />
<b>Visit: <a href="http://forum.ragezone.com/f742/travianz-official-yi12345-bugs-list-952593/">RageZone.com</a></b><br /></center>
</div>
