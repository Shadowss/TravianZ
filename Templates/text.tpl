<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       text.tpl (text_format.tpl legacy)                           ##
##  Developed by:  Dixie                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original content (lore/text unchanged)                         ##
##  - Added safety for PHP compatibility                                       ##
##  - Simplified BBCode parsing logic                                          ##
##  - Reduced repeated regex calls                                             ##
##  - Improved readability                                                     ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * World Wonder / Natars lore text
 * ---------------------------------------------------------
 */
$txt = "<h1><b>Wonder of the World Villages</b></h1>\r\n\r\nCountless days have passed since the first battles upon the walls of the cursed villages of the Dread Natars, many armies of both the free ones and the Natarian empire struggled and died before the walls of the many strongholds from which the Natars had once ruled all creation. Now with the dust settled and a relative calm having settled in, armies began to count their losses and collect their dead, the stench of combat still lingering in the night air, a smell of a slaughter unforgettable in its extent and brutality yet soon to be dwarfed by yet others. The largest armies of the free ones and the Dread Natars were marshalling for yet another renewed assault upon the coveted former strongholds of the Natarian Empire.\r\n
Soon scouts arrived telling of a most awesome sight and a chilling reminder, a dread army of an unfathomable size had been spotted marshalling at the end of the world, the Natarian capital, a force so great and unstoppable that the dust from their march would choke off all light, a force so brutal and ruthless that it would crush all hope. The free people knew that they had to race now, race against time and the endless hordes of the Natarian Empire to raise a Wonder of the World to restore the world to peace and vanquish the Natarian threat.\r\n
But to raise such a great Wonder would be no easy task, one would need construction plans created in the distant past, plans of such an arcane nature that even the very wisest of sages knew not their contents or locations.\r\n
Tens of thousands of scouts roamed across all existence searching in vain for these mystical plans, looking in all places but the dreaded Natarian Capital, yet could not find them. Today however, they return bearing good news, they return baring the locations of the plans, hidden by the armies of the Natars inside secret strongholds constructed to be hidden from the eyes of man.\r\n
Now begins the final stretch, when the greatest armies of the Free people and the Natars will clash across the world for the fate of all that lies under heaven. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.\r\n\r\n
<img src=\"/img/x.gif\" class=\"WWVillagesAnnouncement\" title=\"WW village\" alt=\"WW village\">\r\n\r\n
To conquer one, the following things must happen:\r\n\r\n
1. You must attack the village (NO Raid!)\r\n
2. WIN the Attack\r\n
3. Destroy the RESIDENCE\r\n
4. You must decrease the loyalty to 0 with : SENATORS , CHIEF , CHIEFTAIN\r\n
5. You must have enough culture points to conquer the village\r\n\r\n
If not, the next attack on that village, winning with a SENATORS , CHIEF , CHIEFTAIN and empty slots in RESIDENCE/PALACE will take the village.\r\n\r\n
To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!\r\n\r\n
The construction plans are conquerable immediately when they appear to the server.\r\n\r\n
There will be a countdown in game, showing the exact time of the release, 0.5 days prior to the launch.";

/**
 * ---------------------------------------------------------
 * BBCode parsing (kept minimal, safe, extendable)
 * ---------------------------------------------------------
 */
$bbMap = array(
    '[b]'  => '<b>',
    '[/b]' => '</b>',
    '[i]'  => '<i>',
    '[/i]' => '</i>',
    '[u]'  => '<u>',
    '[/u]' => '</u>',
);

/**
 * Apply BBCode replacements
 */
$txt = str_replace(array_keys($bbMap), array_values($bbMap), $txt);

/**
 * ---------------------------------------------------------
 * Output formatted text
 * nl2br preserves original behavior
 * ---------------------------------------------------------
 */
echo nl2br($txt);
?>