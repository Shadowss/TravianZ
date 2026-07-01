<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : BBCode.php                      	                       ##
##  Type           : BBCode System Backend                                     ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
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

include_once("config.php");
include_once("Lang/" . LANG . ".php");

/**
 * Ensure input exists (avoid undefined variable issues)
 */
if (!isset($input)) {
    $input = '';
}

/**
 * -------------------------------------------------------------------------
 * BUILD PATTERNS + REPLACEMENTS (optimized, loop-based, no duplication)
 * -------------------------------------------------------------------------
 */

$pattern = [];
$replace = [];

/* Basic BBCode */
$pattern[] = "/\[b\](.*?)\[\/b\]/is";
$replace[] = "<b>$1</b>";

$pattern[] = "/\[i\](.*?)\[\/i\]/is";
$replace[] = "<i>$1</i>";

$pattern[] = "/\[u\](.*?)\[\/u\]/is";
$replace[] = "<u>$1</u>";

/* Unit placeholders tid1 - tid50 */
for ($i = 1; $i <= 50; $i++) {
    $pattern[] = "/\[tid{$i}\]/";
    $replace[] = "<img class='unit u{$i}' src='img/x.gif' title='" . constant("U{$i}") . "' alt='" . constant("U{$i}") . "'>";
}

/* Hero */
$pattern[] = "/\[hero\]/";
$replace[] = "<img class='unit uhero' src='img/x.gif' title='" . U0 . "' alt='" . U0 . "'>";

/* Resources */
$resourceMap = [
    'lumber' => [1, LUMBER],
    'clay'   => [2, CLAY],
    'iron'   => [3, IRON],
    'crop'   => [4, CROP],
];

foreach ($resourceMap as $tag => $data) {
    [$id, $name] = $data;

    $pattern[] = "/\[" . $tag . "\]/";
    $replace[] = "<img src='img/x.gif' class='r{$id}' title='{$name}' alt='{$name}'>";
}

/* Smilies & emoticons */
$smilies = [
    "/\*aha\*/" => "<img class='smiley aha' src='img/x.gif' alt='*aha*' title='*aha*'>",
    "/\*angry\*/" => "<img class='smiley angry' src='img/x.gif' alt='*angry*' title='*angry*'>",
    "/\*cool\*/" => "<img class='smiley cool' src='img/x.gif' alt='*cool*' title='*cool*'>",
    "/\*cry\*/" => "<img class='smiley cry' src='img/x.gif' alt='*cry*' title='*cry*'>",
    "/\*cute\*/" => "<img class='smiley cute' src='img/x.gif' alt='*cute*' title='*cute*'>",
    "/\*depressed\*/" => "<img class='smiley depressed' src='img/x.gif' alt='*depressed*' title='*depressed*'>",
    "/\*eek\*/" => "<img class='smiley eek' src='img/x.gif' alt='*eek*' title='*eek*'>",
    "/\*ehem\*/" => "<img class='smiley ehem' src='img/x.gif' alt='*ehem*' title='*ehem*'>",
    "/\*emotional\*/" => "<img class='smiley emotional' src='img/x.gif' alt='*emotional*' title='*emotional*'>",
    "/:D/" => "<img class='smiley grin' src='img/x.gif' alt=':D' title=':D'>",
    "/:\)/" => "<img class='smiley happy' src='img/x.gif' alt=':)' title=':)'>",
    "/\*hit\*/" => "<img class='smiley hit' src='img/x.gif' alt='*hit*' title='*hit*'>",
    "/\*hmm\*/" => "<img class='smiley hmm' src='img/x.gif' alt='*hmm*' title='*hmm*'>",
    "/\*hmpf\*/" => "<img class='smiley hmpf' src='img/x.gif' alt='*hmpf*' title='*hmpf*'>",
    "/\*hrhr\*/" => "<img class='smiley hrhr' src='img/x.gif' alt='*hrhr*' title='*hrhr*'>",
    "/\*huh\*/" => "<img class='smiley huh' src='img/x.gif' alt='*huh*' title='*huh*'>",
    "/\*lazy\*/" => "<img class='smiley lazy' src='img/x.gif' alt='*lazy*' title='*lazy*'>",
    "/\*love\*/" => "<img class='smiley love' src='img/x.gif' alt='*love*' title='*love*'>",
    "/\*nocomment\*/" => "<img class='smiley nocomment' src='img/x.gif' alt='*nocomment*' title='*nocomment*'>",
    "/\*noemotion\*/" => "<img class='smiley noemotion' src='img/x.gif' alt='*noemotion*' title='*noemotion*'>",
    "/\*notamused\*/" => "<img class='smiley notamused' src='img/x.gif' alt='*notamused*' title='*notamused*'>",
    "/\*pout\*/" => "<img class='smiley pout' src='img/x.gif' alt='*pout*' title='*pout*'>",
    "/\*redface\*/" => "<img class='smiley redface' src='img/x.gif' alt='*redface*' title='*redface*'>",
    "/\*rolleyes\*/" => "<img class='smiley rolleyes' src='img/x.gif' alt='*rolleyes*' title='*rolleyes*'>",
    "/:\(/" => "<img class='smiley sad' src='img/x.gif' alt=':(' title=':('>",
    "/\*shy\*/" => "<img class='smiley shy' src='img/x.gif' alt='*shy*' title='*shy*'>",
    "/\*smile\*/" => "<img class='smiley smile' src='img/x.gif' alt='*smile*' title='*smile*'>",
    "/\*tongue\*/" => "<img class='smiley tongue' src='img/x.gif' alt='*tongue*' title='*tongue*'>",
    "/\*veryangry\*/" => "<img class='smiley veryangry' src='img/x.gif' alt='*veryangry*' title='*veryangry*'>",
    "/\*veryhappy\*/" => "<img class='smiley veryhappy' src='img/x.gif' alt='*veryhappy*' title='*veryhappy*'>",
    "/;\)/" => "<img class='smiley wink' src='img/x.gif' alt=';)' title=';)'>",
];

foreach ($smilies as $k => $v) {
    $pattern[] = $k;
    $replace[] = $v;
}

/* Message cleanup */
$input = preg_replace('/\[message\]/', '', $input);
$input = preg_replace('/\[\/message\]/', '', $input);

/* Apply BBCode/static replacements */
$bbcoded = preg_replace($pattern, $replace, $input);

/**
 * -------------------------------------------------------------------------
 * CALLBACK REPLACEMENTS (dynamic database-driven content)
 * -------------------------------------------------------------------------
 */

/* Alliance */
$bbcoded = preg_replace_callback(
    "/\[alliance(\d{0,20})\]([^\]]*)\[\/alliance\d{0,20}\]/is",
    function ($matches) {
        global $database;

        $aname = $database->getAllianceName($matches[2]);
        if (!empty($aname)) {
            return "<a href='allianz.php?aid={$matches[2]}'>{$aname}</a>";
        }
        return "Alliance not found!";
    },
    $bbcoded
);

/* Player */
$bbcoded = preg_replace_callback(
    "/\[player(\d{0,20})\]([^\]]*)\[\/player\d{0,20}\]/is",
    function ($matches) {
        global $database;

        $uname = $database->getUserField((int)$matches[2], "username", 0);
        if (!empty($uname) && $uname !== "[?]") {
            return "<a href='spieler.php?uid={$matches[2]}'>{$uname}</a>";
        }
        return "Player not found!";
    },
    $bbcoded
);

/* Report */
$bbcoded = preg_replace_callback(
    "/\[report(\d{0,20})\]([^\]]*)\[\/report\d{0,20}\]/is",
    function ($matches) {
        global $database;

        $reportID = $matches[1] > 0 ? $matches[1] : $matches[2];
        $report = $database->getNotice2((int)$reportID, null, false);

        if (!empty($report)) {
            return "<a href='berichte.php?id={$reportID}'>{$report['topic']}</a>";
        }
        return "Report not found!";
    },
    $bbcoded
);

/* Coordinates */
$bbcoded = preg_replace_callback(
    "/\[coor(\d{0,20})\]([^\]]*)\[\/coor\d{0,20}\]/is",
    function ($matches) {
        global $generator, $database;

        $coordinates = explode("|", $matches[2]);
        $wRef = $database->getVilWref($coordinates[0], $coordinates[1]);
        $cwref = $generator->getMapCheck($wRef);

        $state = $database->getVillageType($wRef);

        if ($state > 0) {
            $name = $database->getVillageState($wRef)
                ? $database->getVillageField($wRef, 'name')
                : ABANDVALLEY;
        } else {
            $name = $database->getOasisInfo($wRef)['name'] ?? '';
        }

        if (!empty($name)) {
            return "<a href='karte.php?d={$wRef}&amp;c={$cwref}'>{$name} ({$coordinates[0]}|{$coordinates[1]})</a>";
        }

        return "Village not found!";
    },
    $bbcoded
);

/* Final cleanup safety */
$bbcoded = preg_replace('/\[message\]/', '', $bbcoded);
$bbcoded = preg_replace('/\[\/message\]/', '', $bbcoded);

?>