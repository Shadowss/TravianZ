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


$txt="<h1><b>World Wonder Construction Plans</b></h1>\n\n\nMany moons ago the tribes of Travian were surprised by the unforeseen return of the Natars. This tribe from immemorial times surpassing all in wisdom, might and glory was about to trouble the free ones again. Thus they put all their efforts in preparing a last war against the Natars and vanquishing them forever. Many thought about the so-called \'Wonders of the World\', a construction of many legends, as the only solution. It was told that it would render anyone invincible once completed. Ultimately making the constructors the rulers and conquerors of all known Travian. \n\nHowever, it was also told that one would need construction plans to construct such a building. Due to this fact, the architects devised cunning plans about how to store these safely. After a while, one could see temple-like buildings in many a city and metropolis - the Treasure Chambers (Treasuries). \n\nSadly, no one - not even the wise and well versed - knew where to find these construction plans. The harder people tried to locate them, the more it seemed as if they where only legends. \n\nToday, however, this last secret will be revealed. Deprivations and endeavors of the past will not have been in vain, as today scouts of several tribes have successfully obtained the whereabouts of the construction plans. Well guarded by the Natars, they lie hidden in several oases to be found all over Travian. Only the most valiant heroes will be able to secure such a plan and bring it home safely so that the construction can begin. \n\nIn the end, we will see whether the free tribes of Travian can once again outwit the Natars and vanquish them once and for all. Do not be so foolish as to assume that the Natars will leave without a fight, though!\n\n<img src=\"img/x.gif\" class=\"WWBuildingPlansAnnouncement\" title=\"Ancient Construction Plan\" alt=\"Ancient Construction Plan\">\n\nTo steal a set of Construction Plans from the Natars, the following things must happen:\n- You must Attack the village (NOT Raid!)\n- You must WIN the Attack\n- You must DESTROY the Treasure Chamber (Treasury)\n- Your Hero MUST be in that attack, as he is the only one who may carry the Construction Plans\n- An empty level 10 Treasure Chamber (Treasury) MUST be in the village where that attack came from\nNOTE: If the above criteria is not met during the attack, the next attack on that village which does meet the above criteria will take the Construction Plans.\n\n\n\nTo build a Treasure Chamber (Treasury), you will need a Main Building level 10 and the village MUST NOT be  contain a World Wonder.\n\nTo build a World Wonder, you must own the Construction Plans yourself (you = the World Wonder Village Owner) from level 0 to 50, and then from level 51 to 100 you will need an additional set of Construction Plans in your Alliance! Two sets of Construction Plans in the World Wonder Village Account will not work!";

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