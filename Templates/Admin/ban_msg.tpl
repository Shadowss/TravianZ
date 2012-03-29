<?php  

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       ban_msq.tpl                                                 ##
##  Developed by:  yi12345                                                     ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
$ban = mysql_query("SELECT * FROM ".TB_PREFIX."banlist WHERE `uid` = '".$session->uid."'");
$ban1 = mysql_fetch_array($ban);
?>

<p></br>
Hello <?php echo $ban1['name']; ?>!
You have been banned due to a violation of the rules.
</br><?php
if ($ban1['reason']=='Pushing') {
echo "Every player may only own and play one account on each server."; }
if ($ban1['reason']=='Cheat') {
echo "Every player may only own and play one account on each server."; }
if ($ban1['reason']=='Hack') {
echo "Every player may only own and play one account on each server."; }
if ($ban1['reason']=='Bug') {
echo "Every player may only own and play one account on each server."; }
if ($ban1['reason']=='Bad Name') {
echo "Every player may only own and play one account on each server."; }
if ($ban1['reason']=='Multi Account') {
echo "Every player may only own and play one account on each server."; }
if ($ban1['reason']=='Swearing') {
echo "Every player may only own and play one account on each server."; }
?>

</br></br> To ensure that you won't get banned again in the future, you shuold read the rules carefully:
</br></br> <?php echo "<a class=\"rules\" href=\"rules.php\">» Game rules"; ?>
</br></br></br>
</p>