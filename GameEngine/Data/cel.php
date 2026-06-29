<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : cel.php                         	                       ##
##  Type           : Data Page for Celebration                                 ##
## --------------------------------------------------------------------------- ##
##  Developed by   : G3n3s!s & JimJam & LoppyLukas 						       ##
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
 * Celebration definitions
 * ---------------------------------------------------------------------------
 * index 1 = Small Celebration
 * index 2 = Great Celebration
 */
$cel = [
    1 => [
        'name'   => 'Small Celebration',
        'wood'   => 6400,
        'clay'   => 6650,
        'iron'   => 5940,
        'crop'   => 1340,
        'attri'  => 500,
        'time'   => 86400
    ],
    2 => [
        'name'   => 'Great Celebration',
        'wood'   => 29700,
        'clay'   => 33250,
        'iron'   => 32000,
        'crop'   => 6700,
        'attri'  => 2000,
        'time'   => 216000
    ]
];

/**
 * Small celebration scaling / duration table
 * (level => time in seconds)
 */
$sc = [
    1  => 86400,
    2  => 83290,
    3  => 80291,
    4  => 77401,
    5  => 74614,
    6  => 71928,
    7  => 69338,
    8  => 66843,
    9  => 64436,
    10 => 62117,
    11 => 59880,
    12 => 57725,
    13 => 55647,
    14 => 53643,
    15 => 51712,
    16 => 49850,
    17 => 48056,
    18 => 46326,
    19 => 44658,
    20 => 43050
];

/**
 * Great celebration scaling / duration table
 * (level => time in seconds)
 */
$gc = [
    10 => 155291,
    11 => 149701,
    12 => 144312,
    13 => 139116,
    14 => 134108,
    15 => 129280,
    16 => 124626,
    17 => 120140,
    18 => 115815,
    19 => 111645,
    20 => 107626
];
?>
