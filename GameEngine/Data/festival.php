<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : festival.php                      	                       ##
##  Type           : Data Page for Festival                                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki 						                               ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

/**
 * Mead-Festival definition (Brewery, building 35 — Teutons only)
 * ---------------------------------------------------------------------------
 * Unlike the Town Hall celebrations (Data/cel.php), the festival's duration
 * is FIXED at 72 hours regardless of Brewery level — only the combat bonus
 * percentage scales with level (see $bid35 in Data/buidata.php).
 *
 * 'time' is in seconds and is divided by SPEED at the point of use, exactly
 * like the Town Hall celebration durations.
 */
$festival = [
    'name'  => 'Mead-Festival',
    'wood'  => 3870,
    'clay'  => 1680,
    'iron'  => 215,
    'crop'  => 10900,
    'time'  => 259200 // 72 hours
];
?>
