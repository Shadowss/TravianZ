<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       production.tpl                                              ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original functionality                                         ##
##  - Compatible with older PHP 7+ environments                                ##
##  - Reduced repeated method calls where possible                             ##
##  - Added small safety layer for village object                              ##
##  - Improved readability                                                     ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Safety checks (legacy PHP compatibility)
 * ---------------------------------------------------------
 */
$woodProd = isset($village) ? $village->getProd("wood") : 0;
$clayProd = isset($village) ? $village->getProd("clay") : 0;
$ironProd = isset($village) ? $village->getProd("iron") : 0;
$cropProd = isset($village) ? $village->getProd("crop") : 0;
?>

<table id="production" cellpadding="1" cellspacing="1">

    <thead>
        <tr>
            <th colspan="4">
                <?php echo PRODUCTION; ?>:
            </th>
        </tr>
    </thead>

    <tbody>

        <!-- Wood -->
        <tr>
            <td class="ico">
                <img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" />
            </td>

            <td class="res">
                <?php echo LUMBER; ?>:
            </td>

            <td class="num">
                <?php echo $woodProd; ?>
            </td>

            <td class="per">
                <?php echo PER_HR; ?>
            </td>
        </tr>

        <!-- Clay -->
        <tr>
            <td class="ico">
                <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" />
            </td>

            <td class="res">
                <?php echo CLAY; ?>:
            </td>

            <td class="num">
                <?php echo $clayProd; ?>
            </td>

            <td class="per">
                <?php echo PER_HR; ?>
            </td>
        </tr>

        <!-- Iron -->
        <tr>
            <td class="ico">
                <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />
            </td>

            <td class="res">
                <?php echo IRON; ?>:
            </td>

            <td class="num">
                <?php echo $ironProd; ?>
            </td>

            <td class="per">
                <?php echo PER_HR; ?>
            </td>
        </tr>

        <!-- Crop -->
        <tr>
            <td class="ico">
                <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />
            </td>

            <td class="res">
                <?php echo CROP; ?>:
            </td>

            <td class="num">
                <?php echo $cropProd; ?>
            </td>

            <td class="per">
                <?php echo PER_HR; ?>
            </td>
        </tr>

    </tbody>

</table>