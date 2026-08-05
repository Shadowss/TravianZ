<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : news.tpl                                                  ##
##  Type           : Alliance News Feed                                        ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
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

// -------------------------------------------------
// SAFE ALLIANCE ID
// -------------------------------------------------

$aid = isset($aid) ? (int)$aid : (int)$session->alliance;

// -------------------------------------------------
// DATA LOAD
// -------------------------------------------------

$allianceinfo = $database->getAlliance($aid);
$noticeArray = $database->readAlliNotice($aid);

// -------------------------------------------------
// HEADER
// -------------------------------------------------

echo "<h1>" .
    htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
    " - " .
    htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
    "</h1>";

include("alli_menu.tpl");
?>

<!-- ALLIANCE EVENTS TABLE -->
<table cellpadding="1" cellspacing="1" id="events">

<thead>

<tr>
    <th colspan="2"><?php echo TZ_ALLIANCE_EVENTS; ?></th>
</tr>

<tr>
    <td><?php echo TZ_EVENT; ?></td>
    <td><?php echo DATE; ?></td>
</tr>

</thead>

<tbody>

<?php
// -------------------------------------------------
// EVENTS LOOP
// -------------------------------------------------

if (!empty($noticeArray)) {

    foreach ($noticeArray as $notice) {

        // safe timestamp formatting
        $date = $generator->procMtime($notice['date']);

        echo "<tr>

            <td class=\"event\">" . html_entity_decode(tz_expand_report($notice['comment']), ENT_QUOTES, 'UTF-8') . "</td>

            <td class=\"dat\">" .
                $date[0] . " " . $date[1] .
            "</td>

        </tr>";
    }

} else {

    // optional fallback (keeps table valid)
    echo "<tr><td class=\"none\" colspan=\"2\">No events</td></tr>";
}
?>

</tbody>

</table>