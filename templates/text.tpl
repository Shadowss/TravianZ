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


$txt="<h1><b>Natars Artifacts</b></h1>\n\nWhispering rumors echo through the villages, sharing legends told only by the best storytellers. It refers to NATARS, the most feared warrior of the TRAVIAN world. Their killing is the dream of any hero, the purpose of any fighter. No one knows how NATARS got to get such power, and their warriors so cruel. Determined to discover the source of the NATARS power, the fighters send a group of elite spies to spy them. I do not go through many hours and come back with fear in their eyes and balancing fantastic theories: it seems that the natural power comes from the mysterious objects they call artifacts that they stole from our ancestors. Try to steal the artefacts of her, and you can control their power.\n\n<img src=\"img/x.gif\" class=\"ArtifactsAnnouncement\">\n\nThe time has come for claiming artifacts. Collaborate with your alliance and bring your worriors to get these wanted objects. However, NATARS will not give up without war to the artefacts ... nor your enemies. If you are successful in retrieving artifacts and you will be able to reject enemies, you will be able to collect the rewards. Your buildings will become incredibly strong and mightest, and the troops will be much faster and will consume less food. Capture the artifacts, bring glory over your empire and become new legends for your followers.\n\nTo steal one, the following things must happen:\n\n1. You must attack the village (NO Raid!)\n2. WIN the Attack\n3. Destroy the treasury\n4. An empty treasury level 10 for SMALL ARTIFACTS and level 20 for LARGE ARTIFACT must be in the village where that attack came from\n5. Have a hero in an attack\n\nIf not, the next attack on that village, winning with a hero and empty treasury will take the artifact.\n\nTo build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!\n\nThe construction plans are conquerable immediately when they appear to the server. \n\nThere will be a countdown in game, showing the exact time of the release, 5 days prior to the launch. ";

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