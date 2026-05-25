<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : ban_msg.tpl                                               ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : yi12345 (Original)                                        ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

$uid = isset($session->uid) ? (int)$session->uid : 0;
$name = isset($session->username) ? $session->username : 'Unknown';
$reason = 'No reason specified';


  /* =========================
   DB CONNECTION SAFE CHECK
   ========================= */
   
if($uid > 0){

    $query = "SELECT reason FROM ".TB_PREFIX."banlist WHERE uid = $uid LIMIT 1";

    // 🔥 AICI E FIXUL IMPORTANT
    $res = mysqli_query($database->dblink, $query);

    if($res && mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        if(!empty($row['reason'])){
            $reason = $row['reason'];
        }
    }
}
?>

<p><br>

Hello <?php echo htmlspecialchars($name, ENT_QUOTES); ?>!
You have been banned due to a violation of the rules.
<br>
Your banning reason is <?php echo htmlspecialchars($reason, ENT_QUOTES); ?>.
<br>

<br><br>
To ensure that you won't get banned again in the future, you should read the rules carefully:
<br><br>

<center>
    <a class="rules" href="rules.php">» Game rules</a>
</center>

<br><br><br>

To continue playing contact the Multihunter and put things straight with him/her
<br><br>

<center>
    <a class="rules" href="nachrichten.php?t=1&id=5">» Write Message</a>
</center> </br>
</br> Heed the following advice when writing your message: </br></br> 
 </br> ● There is always a reason for a ban. <u>Try to think about possible reasons for this ban</u> and put things straight with the Multihunter. </br> 
 </br> ● Multihunters can review enormous amounts of information about accounts. <u>Stick to the truth</u> and do not make excuses to justify your violation of the rules. </br> 
 </br> ● Be cooperative and insightful, this might reduce the punishment. </br> 
 </br> ● If the Multihunter does not answer immediately, then he/she is probably not online. The issue will not be resolved any faster by sending multiple messages, especially if he/she did not even read the first one yet. </br> 
 </br> ● If you have really been banned unjustly, try to stay <u>calm and polite</u> while talking to the Multihunter and telling him/her about your point of view. </p>