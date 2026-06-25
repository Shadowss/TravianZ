<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : PALACE CULTURE POINTS                                     ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

global $database, $session, $village;

$level = (int)$village->resarray['f'.$id];
$isNatar = (int)$database->getVillageField($village->wid, 'natar') === 1;

// TAKE DATA ONCE
$cpVillage = $isNatar ? 0 : (int)$database->getVillageField($village->wid, 'cp');
$cpTotal = (int)$database->getVSumField($session->uid, 'cp');
$villages = $database->getProfileVillages($session->uid);
$totalVillages = count($villages);

// calculation for the next village - without variables
$cpMode = CP; // 0 = normal, 1 = speed
$cpArrayName = 'cp' . $cpMode;
$cpArray = $GLOBALS[$cpArrayName] ?? [];
$nextCpNeed = $cpArray[$totalVillages + 1] ?? 0;
$currentCp = (int)$session->cp;
?>
<div id="build" class="gid26">
    <h1><?php echo PALACE; ?> <span class="level"><?php echo LEVEL.' '.$level; ?></span></h1>
    
    <p class="build_desc">
        <a href="#" onclick="return Popup(26,4,'gid');" class="build_logo">
            <img class="building g26" src="img/x.gif" alt="<?php echo PALACE; ?>" title="<?php echo PALACE; ?>" />
        </a>
        <?php echo PALACE_DESC; ?>
    </p>

    <?php include("26_menu.tpl"); ?>

    <p><?php echo RESIDENCE_CULTURE_DESC; ?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo PRODUCTION_POINTS; ?></th>
            <td><b><?php echo $cpVillage; ?></b> <?php echo POINTS_DAY; ?></td>
        </tr>
        <tr>
            <th><?php echo PRODUCTION_ALL_POINTS; ?></th>
            <td><b><?php echo $cpTotal; ?></b> <?php echo POINTS_DAY; ?></td>
        </tr>
    </table>

    <p>
        <?php echo VILLAGES_PRODUCED; ?> <b><?php echo $currentCp; ?></b> 
        <?php echo POINTS_NEED; ?> <b><?php echo $nextCpNeed; ?></b> 
        <?php echo POINTS; ?>.
    </p>
</div>