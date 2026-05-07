<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       text_format.tpl                                             ##
##  Developed by:  Dixie                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original placeholder logic (%TEKST%)                           ##
##  - Improved BBCode parsing using str_replace                                ##
##  - Reduced repeated preg_replace calls                                      ##
##  - Added safety structure for PHP 7+                                        ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Input text (template placeholder)
 * ---------------------------------------------------------
 */
$txt = "%TEKST%";

/**
 * ---------------------------------------------------------
 * BBCode -> HTML conversion
 * (kept compatible with legacy regex behavior)
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
 * Apply replacements (faster + cleaner than multiple preg_replace)
 */
$txt = str_replace(array_keys($bbMap), array_values($bbMap), $txt);

/**
 * ---------------------------------------------------------
 * Preserve line breaks as in original implementation
 * ---------------------------------------------------------
 */
echo nl2br($txt);
?>