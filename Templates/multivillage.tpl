<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       multivillage.tpl                                            ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original functionality and HTML structure                      ##
##  - Compatible with older PHP 7+ environments                                ##
##  - Removed massive duplicated blocks                                        ##
##  - Added safer GET handling                                                 ##
##  - Reduced repeated count() calls                                           ##
##  - Centralized URL generation                                               ##
##  - Added comments for maintainability                                       ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Default fallback
 * ---------------------------------------------------------
 */
if (!isset($id)) {
    $id = '';
}

/**
 * ---------------------------------------------------------
 * Show multivillage only if user owns >1 village
 * ---------------------------------------------------------
 */
if (count($session->villages) > 1) {

    /**
     * Load villages once
     */
    $returnVillageArray = $database->getArrayMemberVillage($session->uid);

    /**
     * Total village count
     */
    $villageCount = count($session->villages);

    /**
     * Current selected village
     */
    $currentVillage = isset($_SESSION['wid'])
        ? (int)$_SESSION['wid']
        : 0;

    /**
     * -----------------------------------------------------
     * Allowed GET parameters
     * -----------------------------------------------------
     * Keeps original functionality while avoiding
     * duplicated if/else blocks.
     */
    $allowedParams = array(
        'w',
        'r',
        'z',
        'o',
        's',
        'c',
        't',
        'd',
        'aid',
        'uid',
        'vill',
        'id'
    );

    /**
     * -----------------------------------------------------
     * Build extra URL parameters
     * -----------------------------------------------------
     */
    $extraParams = '';

    foreach ($allowedParams as $param) {

        if (isset($_GET[$param]) && $_GET[$param] !== '') {

            /**
             * Keep original special logic:
             * if $id >= 19, preserve internal id
             */
            if ($param == 'id' && $id >= 19) {
                continue;
            }

            $extraParams .= '&' . $param . '=' . urlencode($_GET[$param]);
        }
    }

    /**
     * -----------------------------------------------------
     * Preserve original behavior for internal building id
     * -----------------------------------------------------
     */
    if ($id >= 19) {
        $extraParams = '&id=' . (int)$id;
    }

?>
<table id="vlist" cellpadding="1" cellspacing="1">

    <thead>
        <tr>
            <td colspan="3">
                <a href="dorf3.php" accesskey="9">
                    <?php echo VILLAGES; ?>:
                </a>
            </td>
        </tr>
    </thead>

    <tbody>

<?php
    /**
     * -----------------------------------------------------
     * Render village list
     * -----------------------------------------------------
     */
    for ($i = 0; $i < $villageCount; $i++) {

        /**
         * Safety checks for older PHP versions
         */
        if (!isset($returnVillageArray[$i])) {
            continue;
        }

        $villageData = $returnVillageArray[$i];

        /**
         * Village values
         */
        $villageWref = isset($villageData['wref'])
            ? (int)$villageData['wref']
            : 0;

        $villageName = isset($villageData['name'])
            ? $villageData['name']
            : '';

        $villageX = isset($villageData['x'])
            ? (int)$villageData['x']
            : 0;

        $villageY = isset($villageData['y'])
            ? (int)$villageData['y']
            : 0;

        /**
         * Highlight current village
         */
        $highlight = ($currentVillage == $villageWref)
            ? 'hl'
            : '';

        /**
         * Build village switch URL
         */
        $villageUrl =
            '?newdid=' . $villageWref . $extraParams;

?>
        <tr>

            <td class="dot <?php echo $highlight; ?>">
                ●
            </td>

            <td class="link">
                <a href="<?php echo $villageUrl; ?>">
                    <?php echo htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </td>

            <td class="aligned_coords">

                <div class="cox">
                    (<?php echo $villageX; ?>
                </div>

                <div class="pi">
                    |
                </div>

                <div class="coy">
                    <?php echo $villageY; ?>)
                </div>

            </td>

        </tr>

<?php
    }
?>

    </tbody>

</table>

<?php
}
?>