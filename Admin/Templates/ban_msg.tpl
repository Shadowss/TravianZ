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

<br><br><?php echo ADM_TO_ENSURE_THAT_YOU_WON_T_GET_BANNED_AGAIN_IN; ?><br><br>

<center>
    <a class="rules" href="rules.php"><?php echo ADM_GAME_RULES; ?></a>
</center>

<br><br><br><?php echo ADM_TO_CONTINUE_PLAYING_CONTACT_THE_MULTIHUNTER; ?><br><br>

<center>
    <a class="rules" href="nachrichten.php?t=1&id=5"><?php echo ADM_WRITE_MESSAGE; ?></a>
</center> </br>
</br><?php echo ADM_HEED_THE_FOLLOWING_ADVICE_WHEN_WRITING_YOUR; ?></br></br> 
 </br><?php echo ADM_THERE_IS_ALWAYS_A_REASON_FOR_A_BAN; ?><u><?php echo ADM_TRY_TO_THINK_ABOUT_POSSIBLE_REASONS_FOR_THIS; ?></u><?php echo ADM_AND_PUT_THINGS_STRAIGHT_WITH_THE_MULTIHUNTER; ?></br> 
 </br><?php echo ADM_MULTIHUNTERS_CAN_REVIEW_ENORMOUS_AMOUNTS_OF; ?><u><?php echo ADM_STICK_TO_THE_TRUTH; ?></u><?php echo ADM_AND_DO_NOT_MAKE_EXCUSES_TO_JUSTIFY_YOUR_VIOL; ?></br> 
 </br><?php echo ADM_BE_COOPERATIVE_AND_INSIGHTFUL_THIS_MIGHT_RED; ?></br> 
 </br><?php echo ADM_IF_THE_MULTIHUNTER_DOES_NOT_ANSWER_IMMEDIATE; ?></br> 
 </br><?php echo ADM_IF_YOU_HAVE_REALLY_BEEN_BANNED_UNJUSTLY_TRY; ?><u><?php echo ADM_CALM_AND_POLITE; ?></u><?php echo ADM_WHILE_TALKING_TO_THE_MULTIHUNTER_AND_TELLING; ?></p>