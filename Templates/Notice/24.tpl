<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : 24.tpl                                                    ##
##  Type           : Settler Report - New Village / Oasis                      ##
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

$ntype  = (int)($message->readingNotice['ntype'] ?? 24);
$coords = explode(',', (string)($message->readingNotice['data'] ?? ''));
$x      = (int)($coords[0] ?? 0);
$y      = (int)($coords[1] ?? 0);
$wref   = (int)($message->readingNotice['toWref'] ?? 0);
$mapCheck = $generator->getMapCheck($wref);
$coordLink = '<a href="karte.php?d=' . $wref . '&c=' . $mapCheck . '">(' . $x . '|' . $y . ')</a>';
?>

<table cellpadding="1" cellspacing="1" id="report_surround">
<thead>

<tr>
    <th><?php echo SUBJECT; ?>:</th>
    <th><?php echo tz_loc_topic($message->readingNotice['topic']); ?></th>
</tr>

<tr>
    <?php $date = $generator->procMtime($message->readingNotice['time']); ?>
    <td class="sent"><?php echo TZ_SENT; ?></td>
    <td><?php echo ON; ?> <span><?php echo $date[0] . " " . $date[1]; ?></span></td>
</tr>

</thead>

<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<tr><td colspan="2" class="report_content">

<?php
if ($ntype == 25) {
    // Settlers could not settle - the valley is already occupied
    echo TZ_VALLEY_OCCUPIED_MSG . ' ' . $coordLink;
} else {
    // New village founded
    $vname = htmlspecialchars((string)$database->getVillageField($wref, 'name'), ENT_QUOTES, 'UTF-8');
    echo TZ_NEW_VILLAGE_MSG . ' <b>' . $vname . '</b> ' . $coordLink;
}
?>

</td></tr>
</tbody>
</table>
