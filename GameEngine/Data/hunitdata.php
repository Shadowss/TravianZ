<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       unitdata.php                                                ##
##  Developed by:  Akakori                                                     ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
$getheroinfo = mysql_query("SELECT * FROM ".TB_PREFIX."hero  WHERE `uid`='".$session->uid."'") or die(mysql_error());
    $heroinfo = mysql_fetch_array($getheroinfo);
    echo    $heroinfo['attackpower'];
$hero=array('atk'=>40*$heroinfo['attackpower'],'di'=>35,'dc'=>50,'wood'=>120,'clay'=>100,'iron'=>150,'crop'=>30,'pop'=>6,'speed'=>6,'time'=>1600,'cap'=>0);

?>
