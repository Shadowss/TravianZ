<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : PALACE CONQUERED VILLAGES                                 ##
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

global $database, $village, $generator;

$level = (int)$village->resarray['f'.$id];

// TAKE ALL SLOTS ONE TIME
$slots = [
    (int)$database->getVillageField($village->wid, 'exp1'),
    (int)$database->getVillageField($village->wid, 'exp2'),
    (int)$database->getVillageField($village->wid, 'exp3'),
];
$slots = array_filter($slots); // REMOVE 0
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

    <table cellpadding="1" cellspacing="1" id="expansion">
        <thead>
            <tr>
                <th colspan="6"><a name="h2"></a><?php echo CONQUERED_BY_VILLAGE; ?></th>
            </tr>
            <tr>
                <td colspan="2"><?php echo VILLAGE; ?></td>
                <td><?php echo PLAYER; ?></td>
                <td><?php echo INHABITANTS; ?></td>
                <td><?php echo COORDINATES; ?></td>
                <td><?php echo DATE; ?></td>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($slots)): 
            $i = 1;
            foreach ($slots as $wid):
                // ONE DATA TYPE PER VILLAGE
                $coor = $database->getCoor($wid);
                $villageData = $database->getVillage($wid); // conține name, owner, pop, created
                $ownerName = $database->getUserField($villageData['owner'], 'username', 0);
                $mapCheck = $generator->getMapCheck($wid);
        ?>
            <tr>
                <td class="ra"><?php echo $i; ?>.</td>
                <td class="vil">
                    <a href="karte.php?d=<?php echo $wid; ?>&c=<?php echo $mapCheck; ?>">
                        <?php echo htmlspecialchars($villageData['name']); ?>
                    </a>
                </td>
                <td class="pla">
                    <a href="spieler.php?uid=<?php echo (int)$villageData['owner']; ?>">
                        <?php echo htmlspecialchars($ownerName); ?>
                    </a>
                </td>
                <td class="ha"><?php echo (int)$villageData['pop']; ?></td>
                <td class="aligned_coords">
                    <div class="cox">(<?php echo (int)$coor['x']; ?></div>
                    <div class="pi">|</div>
                    <div class="coy"><?php echo (int)$coor['y']; ?>)</div>
                </td>
                <td class="dat"><?php echo date('d.m.Y', (int)$villageData['created']); ?></td>
            </tr>
        <?php 
            $i++;
            endforeach; 
        else: ?>
            <tr>
                <td colspan="6" class="none"><?php echo NONE_CONQUERED_BY_VILLAGE; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>