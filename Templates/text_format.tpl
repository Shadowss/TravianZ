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
##  - Preserved original placeholder logic (the message placeholder)          ##
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
 * Culoare: [color=#rrggbb]...[/color]
 *
 * Se accepta DOAR cod hexazecimal, verificat cu expresie regulata. Fara asta,
 * un mesaj de sistem ar putea strecura CSS arbitrar in pagina fiecarui jucator.
 * ---------------------------------------------------------
 */
$txt = preg_replace(
    '/\[color=(#[0-9a-fA-F]{3,6})\]/',
    '<span style="color:$1">',
    $txt
);
// Inchidem doar atatea etichete cate s-au deschis: un cod de culoare invalid
// nu trebuie sa lase un </span> orfan in pagina jucatorului.
$colorOpen = substr_count($txt, '<span style="color:');
$txt = preg_replace('/\[\/color\]/', '</span>', $txt, $colorOpen);
$txt = str_replace('[/color]', '', $txt);

/**
 * ---------------------------------------------------------
 * Preserve line breaks as in original implementation
 * ---------------------------------------------------------
 */
echo nl2br($txt);
?>