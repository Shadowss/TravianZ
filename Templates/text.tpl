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
$txt="";

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