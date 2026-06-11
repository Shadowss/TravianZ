<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       troops.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original functionality                                         ##
##  - Reduced repeated method calls for unit names                             ##
##  - Added small safety guards for legacy PHP                                 ##
##  - Improved readability                                                     ##
##                                                                             ##
#################################################################################
?>

<table id="troops" cellpadding="1" cellspacing="1">

<thead>
<tr>
    <th colspan="3">
        <?php echo TROOPS; ?>
    </th>
</tr>
</thead>

<tbody>

<?php
/**
 * ---------------------------------------------------------
 * Load all village troops
 * ---------------------------------------------------------
 */
$troops = $technology->getAllUnits($village->wid, true, 1);

/**
 * Cache unit list to avoid repeated calls
 */
$unitNameCache = array();

$troopsPresent = false;

/**
 * ---------------------------------------------------------
 * Loop all possible units (Travian standard max 50)
 * ---------------------------------------------------------
 */
for ($i = 1; $i <= 50; $i++) {

    $unitKey = 'u' . $i;

    if (!empty($troops[$unitKey])) {

        /**
         * Cache unit name (avoid repeated calls)
         */
        if (!isset($unitNameCache[$i])) {
            $unitNameCache[$i] = $technology->getUnitName($i);
        }

        $unitName = $unitNameCache[$i];

        echo '
        <tr>
            <td class="ico">
                <a href="build.php?id=39">
                    <img
                        class="unit u' . $i . '"
                        src="img/x.gif"
                        alt="' . $unitName . '"
                        title="' . $unitName . '"
                    />
                </a>
            </td>

            <td class="num">
                ' . $troops[$unitKey] . '
            </td>

            <td class="un">
                ' . $unitName . '
            </td>
        </tr>';

        $troopsPresent = true;
    }
}

/**
 * ---------------------------------------------------------
 * Hero handling
 * ---------------------------------------------------------
 */
if (!empty($troops['hero'])) {

    echo '
    <tr>
        <td class="ico">
            <a href="build.php?id=39">
                <img
                    class="unit uhero"
                    src="img/x.gif"
                    alt="'.U0.'"
                    title="'.U0.'"
                />
            </a>
        </td>

        <td class="num">
            ' . (int)$troops['hero'] . '
        </td>

        <td class="un">
            ' . U0 . '
        </td>
    </tr>';

    $troopsPresent = true;
}

/**
 * ---------------------------------------------------------
 * Empty state
 * ---------------------------------------------------------
 */
if (!$troopsPresent) {
    echo '<tr><td>none</td></tr>';
}
?>

</tbody>

</table>
</div>