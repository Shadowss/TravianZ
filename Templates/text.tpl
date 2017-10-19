<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       text_format.tpl                                             ##
##  Developed by:  Dixie                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


$txt="dobrá modrá nedotknutá mliečna krava s rosnatými rohmi a bacuľatými kostičkami

καλή γαλάζια παρθένα γαλακτοπαραγωγική αγελάδα με καυτά κέρατα και κούτσουρα

azgın boynuzları ve tombul chubs ile iyi mavi temiz kuru süt ineği

хороша синя незаймана молочна корова з роговими рогами і пухкими чуваками

良好的藍色原始乳白色牛與角角和胖胖的小孩";

//bbcode = html code
$txt = preg_replace("/\[b\]/is",'<b>', $txt);
$txt = preg_replace("/\[\/b\]/is",'</b>', $txt);
$txt = preg_replace("/\[i\]/is",'<i>', $txt);
$txt = preg_replace("/\[\/i\]/is",'</i>', $txt);
$txt = preg_replace("/\[u\]/is",'<u>', $txt);
$txt = preg_replace("/\[\/u\]/is",'</u>', $txt);

//nl2br = enter
echo nl2br($txt);

?>