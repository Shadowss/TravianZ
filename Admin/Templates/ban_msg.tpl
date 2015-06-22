<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       ban_msq.tpl                                                 ##
##  Developed by:  yi12345                                                     ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
$time = time();
$ban = mysql_query("SELECT * FROM ".TB_PREFIX."banlist WHERE `uid` = '".$session->uid."' and active = 1");
$ban1 = mysql_fetch_array($ban);
?>

<p></br>
Hello <?php echo $ban1['name']; ?>!
You have been banned due to a violation of the rules.
</br>
Your banning reason is <?php echo $ban1['reason']; ?>.
</br>

</br></br> To ensure that you won't get banned again in the future, you should read the rules carefully:
</br></br><center> <?php echo "<a class=\"rules\" href=\"rules.php\">» Game rules</a>"; ?> </center>
</br></br></br>
To continue playing contact the Multihunter and put things straight with him/her
</br></br><center> <?php echo "<a class=\"rules\" href=\"nachrichten.php?t=1&id=5\">» Write Message</a>"; ?> </center>
</br></br>
Heed the following advice when writing your message:
</br></br>
● There is always a reason for a ban. <u>Try to think about possible reasons for this ban</u> and put things straight with the Multihunter.
</br>
● Multihunters can review enormous amounts of information about accounts. <u>Stick to the truth</u> and do not make excuses to justify your violation of the rules.
</br>
● Be cooperative and insightful, this might reduce the punishment.
</br>
● If the Multihunter does not answer immediately, then he/she is probably not online. The issue will not be resolved any faster by sending multiple messages, especially if he/she did not even read the first one yet.
</br>
● If you have really been banned unjustly, try to stay <u>calm and polite</u> while talking to the Multihunter and telling him/her about your point of view.
</p>