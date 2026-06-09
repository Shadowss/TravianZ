<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       natars.tpl                                                  ##
##  Original Code  TravianZ Project                                            ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original functionality                                         ##
##  - Compatible with older PHP 7+ environments                                ##
##  - Improved readability and maintainability                                 ##
##  - Reduced magic numbers                                                    ##
##  - Added safer variable handling                                            ##
##  - Added comments                                                           ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Current server time
 * ---------------------------------------------------------
 */
$currentTime = time();

/**
 * ---------------------------------------------------------
 * Server start timestamp
 * ---------------------------------------------------------
 */
$startDate = strtotime(START_DATE);

/**
 * ---------------------------------------------------------
 * Display upcoming events only in next 5 real days
 * Adjusted by server speed
 * ---------------------------------------------------------
 */
$displayWindow = 432000 / SPEED; // 5 days in seconds

/**
 * ---------------------------------------------------------
 * Upcoming Natars-related events
 * ---------------------------------------------------------
 */
$spawnEvents = array(

    'Artifacts' => (
        $startDate + (NATARS_SPAWN_TIME * 86400)
    ) - $currentTime,

    'WW villages' => (
        $startDate + (NATARS_WW_SPAWN_TIME * 86400)
    ) - $currentTime,

    'WW building plans' => (
        $startDate + (NATARS_WW_BUILDING_PLAN_SPAWN_TIME * 86400)
    ) - $currentTime
);

/**
 * ---------------------------------------------------------
 * Render events
 * ---------------------------------------------------------
 */
foreach ($spawnEvents as $eventName => $spawnTime) {

    /**
     * Show only future events
     * inside configured display window
     */
    if ($spawnTime > 0 && $spawnTime <= $displayWindow) {
?>
        <br /><br />

        <div>

            <span>
                <b><?php echo $eventName; ?></b>
                <?php echo TZ_WILL_SPAWN_IN; ?>
            </span>

            <span id="timer<?php echo ++$session->timer; ?>">
                <?php echo $generator->getTimeFormat($spawnTime); ?>
            </span>

        </div>

<?php
    }
}
?>