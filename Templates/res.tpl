<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       res.tpl                                                     ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original functionality                                         ##
##  - Added safety checks for legacy PHP                                       ##
##  - Reduced repeated property access                                         ##
##  - Improved readability                                                     ##
##  - Kept UI structure unchanged                                              ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Safety check (avoid undefined village context)
 * ---------------------------------------------------------
 */
if (!empty($village)) {

    /**
     * -----------------------------------------------------
     * Production values (rounded)
     * -----------------------------------------------------
     */
    $wood = round($village->getProd("wood"));
    $clay = round($village->getProd("clay"));
    $iron = round($village->getProd("iron"));
    $crop = round($village->getProd("crop"));

    /**
     * Total crop production capacity
     */
    $totalproduction = $village->allcrop;

    /**
     * Safely cache values to reduce repeated access
     */
    $woodStore = round($village->awood);
    $clayStore = round($village->aclay);
    $ironStore = round($village->airon);
    $cropStore = round($village->acrop);

    $maxStore  = $village->maxstore;
    $maxCrop   = $village->maxcrop;
?>

<div id="res">
<div id="resWrap">

    <!-- ================= RESOURCES ================= -->
    <table cellpadding="1" cellspacing="1">
        <tr>

            <!-- Wood -->
            <td>
                <img src="img/x.gif" class="r1" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" />
            </td>

            <td id="l4" title="<?php echo $wood; ?>">
                <?php echo $woodStore . "/" . $maxStore; ?>
            </td>

            <!-- Clay -->
            <td>
                <img src="img/x.gif" class="r2" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" />
            </td>

            <td id="l3" title="<?php echo $clay; ?>">
                <?php echo $clayStore . "/" . $maxStore; ?>
            </td>

            <!-- Iron -->
            <td>
                <img src="img/x.gif" class="r3" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />
            </td>

            <td id="l2" title="<?php echo $iron; ?>">
                <?php echo $ironStore . "/" . $maxStore; ?>
            </td>

            <!-- Crop -->
            <td>
                <img src="img/x.gif" class="r4" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />
            </td>

            <?php if ($village->acrop > 0) { ?>
                <td id="l1" title="<?php echo $crop; ?>">
                    <?php echo $cropStore . "/" . $maxCrop; ?>
                </td>
            <?php } else { ?>
                <td title="<?php echo $crop; ?>">
                    0/<?php echo $maxCrop; ?>
                </td>
            <?php } ?>

            <!-- Crop consumption -->
            <td>
                <img src="img/x.gif" class="r5" alt="<?php echo CROP_COM; ?>" title="<?php echo CROP_COM; ?>" />
            </td>

            <td>
                <?php echo ($village->pop + $technology->getUpkeep($village->unitall, 0)) . "/" . $totalproduction; ?>
            </td>

        </tr>
    </table>

    <!-- ================= GOLD / STATUS ================= -->
    <table cellpadding="1" cellspacing="1">
        <tr>

            <!-- spacing (kept as original layout) -->
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td></td>

            <!-- Gold display -->
            <td>
                <?php
                if ($session->gold <= 1) {
                    echo '<font color="#B3B3B3">
                            <img src="' . GP_LOCATE . 'img/a/gold_g.gif" alt="Gold" title="Gold"/>
                            ' . $session->gold . ' Gold
                          </font>';
                } else {
                    echo '<img src="' . GP_LOCATE . 'img/a/gold.gif" alt="Gold" title="Gold"/>
                          ' . $session->gold . ' Gold';
                }
                ?>
            </td>

        </tr>
    </table>

</div>
</div>

<?php } ?>