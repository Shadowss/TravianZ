<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       field.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Refactor notes:                                                            ##
##  - păstrată logica originală 100%                                           ##
##  - compatibil PHP 5.6+ / 7+                                                 ##
##  - redus cod duplicat                                                       ##
##  - optimizat verificarea upgrade-urilor                                     ##
##  - output HTML mai sigur                                                    ##
##  - comentarii adăugate                                                      ##
##                                                                             ##
#################################################################################

/**
 * Escape HTML compatibil PHP vechi
 */
if (!function_exists('safeHTML')) {
    function safeHTML($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Coordonatele câmpurilor de resurse
 * Format:
 * fieldId => coords
 */
$coorarray = array(
    1  => "101,33,28",
    2  => "165,32,28",
    3  => "224,46,28",
    4  => "46,63,28",
    5  => "138,74,28",
    6  => "203,94,28",
    7  => "262,86,28",
    8  => "31,117,28",
    9  => "83,110,28",
    10 => "214,142,28",
    11 => "269,146,28",
    12 => "42,171,28",
    13 => "93,164,28",
    14 => "160,184,28",
    15 => "239,199,28",
    16 => "87,217,28",
    17 => "140,231,28",
    18 => "190,232,28"
);

/**
 * Shortcut către resarray
 */
$arrayVillage = $village->resarray;

/**
 * Tipuri câmpuri resurse
 */
$fieldNames = array(
    1 => 'Woodcutter Level',
    2 => 'Clay Pit Level',
    3 => 'Iron Mine Level',
    4 => 'Cropland Level'
);
?>

<!-- ===================== RESOURCE MAP ===================== -->

<map name="rx" id="rx">

<?php

/**
 * Lucrări active în sat
 * Folosit pentru highlight upgrade în progres
 */
$jobs = $database->getJobs($village->wid);

/**
 * Cache fields active
 */
$activeFields = array();

/**
 * Compatibil PHP vechi
 */
if (!empty($jobs) && is_array($jobs)) {

    foreach ($jobs as $job) {

        /**
         * Doar resource fields (1-4)
         */
        if (isset($job['type']) && (int)$job['type'] <= 4) {

            $activeFields[(int)$job['field']] = true;
        }
    }
}

/**
 * Generare areas resurse
 */
for ($i = 1; $i <= 18; $i++) {

    $fieldType  = isset($arrayVillage['f'.$i.'t'])
        ? (int)$arrayVillage['f'.$i.'t']
        : 0;

    $fieldLevel = isset($arrayVillage['f'.$i])
        ? (int)$arrayVillage['f'.$i]
        : 0;

    /**
     * Nume resursă
     */
    $resourceName = Building::procResType($fieldType);

    /**
     * Upgrade activ
     */
    $isActive = isset($activeFields[$i]);

    /**
     * Tooltip
     */
    $title = $resourceName .
             ' Level ' .
             $fieldLevel;

    if ($isActive) {
        $title .= ' (upgrade in progress)';
    }

    echo '<area href="build.php?id=' . $i . '"
                coords="' . safeHTML($coorarray[$i]) . '"
                shape="circle"
                title="' . safeHTML($title) . '" />' . "\r\n";
}
?>

    <!-- Village center -->
    <area href="dorf2.php"
          coords="144,131,36"
          shape="circle"
          title="<?php echo VILLAGE_CENTER; ?>"
          alt="" />

</map>

<!-- ===================== RESOURCE VILLAGE MAP ===================== -->

<div id="village_map" class="f<?php echo (int)$village->type; ?>">

<?php

/**
 * Randare resource fields
 */
for ($i = 1; $i <= 18; $i++) {

    $fieldType = isset($arrayVillage['f'.$i.'t'])
        ? (int)$arrayVillage['f'.$i.'t']
        : 0;

    $fieldLevel = isset($arrayVillage['f'.$i])
        ? (int)$arrayVillage['f'.$i]
        : 0;

    /**
     * Dacă slotul este gol skip
     */
    if ($fieldType == 0) {
        continue;
    }

    /**
     * Text alt
     */
    $text = isset($fieldNames[$fieldType])
        ? $fieldNames[$fieldType]
        : 'Resource Field Level';

    /**
     * Upgrade activ
     */
    $isActive = isset($activeFields[$i]);

    /**
     * CSS class
     */
    $cssClass = 'reslevel rf' .
                $i .
                ' level' .
                $fieldLevel;

    if ($isActive) {
        $cssClass .= '_active';
    }

    /**
     * Alt text
     */
    $altText = $text . ' ' . $fieldLevel;

    if ($isActive) {
        $altText .= ' (upgrade in progress)';
    }

    echo '<img src="img/x.gif"
               class="' . safeHTML($cssClass) . '"
               alt="' . safeHTML($altText) . '" />';
}
?>

    <!-- Overlay click map -->
    <img id="resfeld"
         usemap="#rx"
         src="img/x.gif"
         alt="" />

</div>