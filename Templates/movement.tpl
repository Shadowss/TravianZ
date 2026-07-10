<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       movement.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  Updated by:    Shadow                                                      ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original functionality and structure                           ##
##  - Compatible with older PHP 7+ environments                                ##
##  - Reduced duplicated database calls                                        ##
##  - Reduced duplicated rendering logic                                       ##
##  - Added safer array handling                                               ##
##  - Added reusable renderer function                                         ##
##  - Added comments for maintainability                                       ##
##                                                                             ##
#################################################################################

/**
 * ---------------------------------------------------------
 * Helper: Render movement row
 * ---------------------------------------------------------
 */
if (!function_exists('renderMovementRow')) {

    function renderMovementRow(
        $action,
        $aclass,
        $title,
        $short,
        $count,
        $arrivalTime,
        $generator,
        $session
    ) {

        if ($count <= 0 || empty($arrivalTime)) {
            return;
        }

        echo '
        <tr>
            <td class="typ">
                <a href="build.php?id=39">
                    <img
                        src="img/x.gif"
                        class="' . $action . '"
                        alt="' . $title . '"
                        title="' . $title . '"
                    />
                </a>

                <span class="' . $aclass . '">
                    &raquo;
                </span>
            </td>

            <td>
                <div class="mov">
                    <span class="' . $aclass . '">
                        ' . $count . '&nbsp;' . $short . '
                    </span>
                </div>

                <div class="dur_r">
                    in&nbsp;
                    <span id="timer' . ++$session->timer . '">
                        ' . $generator->getTimeFormat($arrivalTime - time()) . '
                    </span>
                    &nbsp;' . HOURS . '
                </div>
            </td>
        </tr>';
    }
}

/**
 * ---------------------------------------------------------
 * Preload oasis data
 * ---------------------------------------------------------
 */
$oases = 0;
$oasisMovements = array();

$oasisArray = $database->getOasis($village->wid);

foreach ($oasisArray as $conqured) {

    $oasisData = $database->getMovement(6, $conqured['wref'], 0);

    $oases += count($oasisData);

    if (!empty($oasisData)) {
        $oasisMovements = array_merge($oasisMovements, $oasisData);
    }
}

/**
 * ---------------------------------------------------------
 * Cache movement queries
 * Reduces duplicated SQL/database calls
 * ---------------------------------------------------------
 */
$movement4_1 = $database->getMovement(4, $village->wid, 1);
$movement7_1 = $database->getMovement(7, $village->wid, 1);
$movement3_1 = $database->getMovement(3, $village->wid, 1);
$movement3_0 = $database->getMovement(3, $village->wid, 0);
$movement5_0 = $database->getMovement(5, $village->wid, 0);
$movement8_1 = $database->getMovement(8, $village->wid, 1);
$movement9_0 = $database->getMovement(9, $village->wid, 0);
// T4 hero port: hero adventure movements are only relevant for the hero's
// home village and only when the feature is on.
$movement20_0 = (defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4)
    ? $database->getMovement(20, $village->wid, 0) : [];
$movement21_1 = (defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4)
    ? $database->getMovement(21, $village->wid, 1) : [];

/**
 * ---------------------------------------------------------
 * Total movement count
 * ---------------------------------------------------------
 */
$totalMovements =
    count($movement4_1) +
    count($movement3_1) +
    count($movement3_0) +
    count($movement7_1) +
    count($movement5_0) +
    $oases -
    count($movement8_1) -
    count($movement9_0);

/**
 * ---------------------------------------------------------
 * Table header
 * ---------------------------------------------------------
 */
if ($totalMovements > 0) {

    echo '
    <table id="movements" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <th colspan="3">' . TROOP_MOVEMENTS . '</th>
            </tr>
        </thead>
        <tbody>';
}

/**
 * =========================================================
 * ARRIVING REINFORCEMENTS
 * =========================================================
 */

$reinforcementCount = 0;
$reinforcementArrival = array();

/**
 * Returning reinforcement
 */
foreach ($movement4_1 as $receive) {

    $reinforcementCount++;
    $reinforcementArrival[] = $receive['endtime'];
}

/**
 * Evasion / special reinforcement
 */
foreach ($movement7_1 as $receive) {

    $reinforcementCount++;
    $reinforcementArrival[] = $receive['endtime'];
}

/**
 * Incoming support from movement type 3
 */
foreach ($movement3_1 as $receive) {

    if ($receive['attack_type'] == 2) {

        $reinforcementCount++;
        $reinforcementArrival[] = $receive['endtime'];
    }
}

renderMovementRow(
    'def1',
    'd1',
    ARRIVING_REINF_TROOPS,
    ARRIVING_REINF_TROOPS_SHORT,
    $reinforcementCount,
    !empty($reinforcementArrival) ? min($reinforcementArrival) : 0,
    $generator,
    $session
);

/**
 * =========================================================
 * INCOMING ATTACKS / RAIDS
 * =========================================================
 */

$attackCount = 0;
$attackArrival = array();

foreach ($movement3_1 as $receive) {

    if (
        $receive['attack_type'] != 2 &&
        $receive['attack_type'] != 1
    ) {

        $attackCount++;
        $attackArrival[] = $receive['endtime'];
    }
}

renderMovementRow(
    'att1',
    'a1',
    UNDERATTACK,
    ATTACK,
    $attackCount,
    !empty($attackArrival) ? min($attackArrival) : 0,
    $generator,
    $session
);

/**
 * =========================================================
 * OWN ATTACKING TROOPS
 * =========================================================
 */

$ownAttackCount = 0;
$ownAttackArrival = array();

foreach ($movement3_0 as $receive) {

    if ($receive['attack_type'] != 2) {

        $ownAttackCount++;
        $ownAttackArrival[] = $receive['endtime'];
    }
}

renderMovementRow(
    'att2',
    'a2',
    OWN_ATTACKING_TROOPS,
    ATTACK,
    $ownAttackCount,
    !empty($ownAttackArrival) ? min($ownAttackArrival) : 0,
    $generator,
    $session
);

/**
 * =========================================================
 * OWN REINFORCING TROOPS
 * =========================================================
 */

$ownReinfCount = 0;
$ownReinfArrival = array();

foreach ($movement3_0 as $receive) {

    if ($receive['attack_type'] == 2) {

        $ownReinfCount++;
        $ownReinfArrival[] = $receive['endtime'];
    }
}

renderMovementRow(
    'def2',
    'd2',
    OWN_REINFORCING_TROOPS,
    ARRIVING_REINF_TROOPS_SHORT,
    $ownReinfCount,
    !empty($ownReinfArrival) ? min($ownReinfArrival) : 0,
    $generator,
    $session
);

/**
 * =========================================================
 * HERO ADVENTURE (T4 hero port): outbound + returning
 * =========================================================
 */

$advOutArrival = array();
foreach ($movement20_0 as $receive) {
    $advOutArrival[] = $receive['endtime'];
}
renderMovementRow(
    'att2',
    'a2',
    defined('HERO_ADV_MOV_OUT') ? HERO_ADV_MOV_OUT : 'Hero on an adventure',
    defined('HERO_ADV_MOV_SHORT') ? HERO_ADV_MOV_SHORT : 'Adventure',
    count($movement20_0),
    !empty($advOutArrival) ? min($advOutArrival) : 0,
    $generator,
    $session
);

$advBackArrival = array();
foreach ($movement21_1 as $receive) {
    $advBackArrival[] = $receive['endtime'];
}
renderMovementRow(
    'def1',
    'd1',
    defined('HERO_ADV_MOV_BACK') ? HERO_ADV_MOV_BACK : 'Hero returning from an adventure',
    defined('HERO_ADV_MOV_SHORT') ? HERO_ADV_MOV_SHORT : 'Adventure',
    count($movement21_1),
    !empty($advBackArrival) ? min($advBackArrival) : 0,
    $generator,
    $session
);

/**
 * =========================================================
 * FOUNDING NEW VILLAGE
 * =========================================================
 */

$newVillageCount = count($movement5_0);
$newVillageArrival = array();

foreach ($movement5_0 as $receive) {

    $newVillageArrival[] = $receive['endtime'];
}

renderMovementRow(
    'att3',
    'a3',
    FOUNDNEWVILLAGE,
    NEWVILLAGE,
    $newVillageCount,
    !empty($newVillageArrival) ? min($newVillageArrival) : 0,
    $generator,
    $session
);

/**
 * =========================================================
 * OASIS ATTACKS / REINFORCEMENTS
 * =========================================================
 */

$oasisCount = count($oasisMovements);
$oasisArrival = array();

$oasisAction = 'att3';
$oasisClass  = 'a3';
$oasisTitle  = OASISATTACK;
$oasisShort  = OASISATTACKS;

foreach ($oasisMovements as $receive) {

    /**
     * Reinforcement to oasis
     */
    if ($receive['attack_type'] == 2) {

        $oasisAction = 'def3';
        $oasisClass  = 'd3';
        $oasisTitle  = ARRIVING_REINF_TROOPS;
        $oasisShort  = ARRIVING_REINF_TROOPS_SHORT;
    }

    $oasisArrival[] = $receive['endtime'];
}

renderMovementRow(
    $oasisAction,
    $oasisClass,
    $oasisTitle,
    $oasisShort,
    $oasisCount,
    !empty($oasisArrival) ? min($oasisArrival) : 0,
    $generator,
    $session
);

/**
 * ---------------------------------------------------------
 * Close table
 * ---------------------------------------------------------
 */
if ($totalMovements > 0) {

    echo '
        </tbody>
    </table>';
}
?>