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


$txt="<h1><b>Wonder of the World Villages</b></h1>\n\nCountless days have passed since the first battles upon the walls of the cursed villages of the Dread Natars, many armies of both the free ones and the Natarian empire struggled and died before the walls of the many strongholds from which the Natars had once ruled all creation. Now with the dust settled and a relative calm having settled in, armies began to count their losses and collect their dead, the stench of combat still lingering in the night air, a smell of a slaughter unforgettable in its extent and brutality yet soon to be dwarfed by yet others. The largest armies of the free ones and the Dread Natars were marshalling for yet another renewed assault upon the coveted former strongholds of the Natarian Empire.\nSoon scouts arrived telling of a most awesome sight and a chilling reminder, a dread army of an unfathomable size had been spotted marshalling at the end of the world, the Natarian capital, a force so great and unstoppable that the dust from their march would choke off all light, a force so brutal and ruthless that it would crush all hope. The free people knew that they had to race now, race against time and the endless hordes of the Natarian Empire to raise a Wonder of the World to restore the world to peace and vanquish the Natarian threat.\nBut to raise such a great Wonder would be no easy task, one would need construction plans created in the distant past, plans of such an arcane nature that even the very wisest of sages knew not their contents or locations.\nTens of thousands of scouts roamed across all existence searching in vain for these mystical plans, looking in all places but the dreaded Natarian Capital, yet could not find them. Today however, they return bearing good news, they return baring the locations of the plans, hidden by the armies of the Natars inside secret strongholds constructed to be hidden from the eyes of man.\nNow begins the final stretch, when the greatest armies of the Free people and the Natars will clash across the world for the fate of all that lies under heaven. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.\n\n<img src=\"img/x.gif\" class=\"WWVillagesAnnouncement\" title=\"WW village\" alt=\"WW village\">\n\nTo conquer one, the following things must happen:\n\n1. You must attack the village (NO Raid!)\n2. WIN the Attack\n3. Destroy the RESIDENCE\n4. You must decrease the loyalty to 0 with : SENATORS , CHIEF , CHIEFTAIN\n5. You must have enough culture points to conquer the village\n\nIf not, the next attack on that village, winning with a SENATORS , CHIEF , CHIEFTAIN and empty slots in RESIDENCE/PALACE will take the village.\n\nTo build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!\n\nThe construction plans are conquerable immediately when they appear to the server. \n\nThere will be a countdown in game, showing the exact time of the release, 5 days prior to the launch. ";

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