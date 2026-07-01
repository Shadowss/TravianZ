<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Building.php                      	                       ##
##  Type           : Building System Backend                                   ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki & Dixie          	                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
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


class Building {

    public $NewBuilding = false;

    private $maxConcurrent;
    private $allocated;

    private $basic = 0;
    private $inner = 0;
    private $plus  = 0;

    public $buildArray = array();

    public function __construct() {

        global $session;

        $maxConcurrent = BASIC_MAX;

        if (ALLOW_ALL_TRIBE || $session->tribe == 1) {
            $maxConcurrent += INNER_MAX;
        }

        if ($session->plus) {
            $maxConcurrent += PLUS_MAX;
        }

        $this->LoadBuilding();

        if (!empty($this->buildArray)) {

            foreach ($this->buildArray as $build) {

                if ($build['master'] == 1) {
                    $maxConcurrent++;
                }
            }
        }

        $this->maxConcurrent = $maxConcurrent;
    }

	/*****************************************
	Function to Allow WW Upgrade
	*****************************************/
	
	public function allowWwUpgrade() {
    global $database, $village, $session;

    static $cached = null;

    if ($cached !== null) {
        return $cached;
    }

    $wwHighestLevelFound = (int)$village->resarray['f99'];

    // Evităm count() pe array doar pentru existență
    $wwBuildingProgress = $database->getBuildingByType($village->wid, 99);

    if (!empty($wwBuildingProgress[0]['level'])) {
        $queuedLevel = (int)$wwBuildingProgress[0]['level'];

        if ($queuedLevel > $wwHighestLevelFound) {
            $wwHighestLevelFound = $queuedLevel;
        }
    }

    // Cache natural prin static
    $userHasWWConstructionPlans = $database->getWWConstructionPlans($session->uid);

    // Nu mai facem query inutil dacă nu avem alianță
    $allyHasWWConstructionPlans = false;

    if ($session->alliance > 0) {
        $allyHasWWConstructionPlans = $database->getWWConstructionPlans(
            $session->uid,
            $session->alliance
        );
    }

    // Reducem branch-urile
    $cached = (
        $wwHighestLevelFound < 50
            ? $userHasWWConstructionPlans
            : ($userHasWWConstructionPlans && $allyHasWWConstructionPlans)
    );

    return $cached;
}

	/*****************************************
	Function to Process
	*****************************************/

	public function canProcess($id, $tid) {
    global $session, $database, $village;

    // Un singur query
    $levels = $database->getResourceLevel($village->wid);

    // WW restriction early exit
    if ($tid == 99 && !$this->allowWwUpgrade()) {
        $this->redirect($tid);
    }

    $fieldTypeKey = 'f'.$tid.'t';

    // Mic cache local
    $currentFieldType = isset($levels[$fieldTypeKey]) ? (int)$levels[$fieldTypeKey] : 0;

    // Validare slot/building
    $isValidSlot =
        (
            ($tid >= 1 && $tid <= 18 && $id >= 1 && $id <= 4) ||
            ($tid >= 19 && $id > 4)
        );

    // Validare building existent
    $isValidFieldType =
        ($currentFieldType == $id || $currentFieldType == 0);

    // Validare zid
    $isValidWall =
        ($tid != 40 || in_array($id, array(31, 32, 33)));

    if (
        !isset($village->resarray[$fieldTypeKey]) ||
        !$isValidSlot ||
        !$isValidFieldType ||
        !$isValidWall
    ) {
        header('Location: '.$_SERVER['SCRIPT_NAME']);
        exit;
    }

    // Evităm apel dublu inutil
    if (!isset($_GET['master'])) {
        if ($this->checkResource($id, $tid) != 4) {
            $this->redirect($tid);
        }

        return;
    }

    // MASTER BUILDER
    if ($currentFieldType == 0) {
        // build nou
        if (!$this->meetRequirement($id)) {
            $this->redirect($tid);
        }
    } else {
        // upgrade
        $loopLevel = $this->isLoop($tid);
        $currentLevel = $this->isCurrent($tid);

        if ($this->isMax($id, $tid, $loopLevel + $currentLevel)) {
            $this->redirect($tid);
        }
    }
}

	/*****************************************
	Function to redirect to dorf1 and dorf2
	*****************************************/

	private function redirect($tid) {
    header('Location: '.($tid >= 19 ? 'dorf2.php' : 'dorf1.php'));
    exit;
}

	/*****************************************
	Function to proc Building
	*****************************************/

	public function procBuild($get) {
    global $session, $village, $database;

    // Cache checker comparison
    $validChecker = (
        isset($get['c']) &&
        $get['c'] == $session->checker
    );

    // REMOVE / UPGRADE EXISTING
    if (isset($get['a']) && !isset($get['id']) && $validChecker) {

        if ($get['a'] == 0) {
            $this->removeBuilding($get['d']);
            return;
        }

        $session->changeChecker();

        $fieldType = $village->resarray['f'.$get['a'].'t'];

        $this->canProcess($fieldType, $get['a']);
        $this->upgradeBuilding($get['a']);

        return;
    }

    // MASTER BUILDER
    if (
        isset($get['master'], $get['id']) &&
        $validChecker &&
        $session->gold >= 1 &&
        $session->goldclub &&
        $village->master == 0
    ) {

        $this->canProcess($get['master'], $get['id']);

        $session->changeChecker();

        // Un singur query
        $level = $database->getResourceLevel($village->wid);

        // Un singur calcul
        $required = $this->resourceRequired($get['id'], $get['master']);

        // Un singur query
        $queuedBuildings = $database->getBuildingByField(
            $village->wid,
            $get['id']
        );

        $database->addBuilding(
            $village->wid,
            $get['id'],
            $get['master'],
            1,
            $required['time'],
            1,
            $level['f'.$get['id']] + 1 + count($queuedBuildings)
        );

        $this->redirect($get['id']);
    }

    // CONSTRUCT NEW BUILDING
    if (
        isset($get['a'], $get['id']) &&
        $validChecker
    ) {

        if ($get['id'] > 18 && ($get['id'] < 41 || $get['id'] == 99)) {

            $session->changeChecker();

            $this->canProcess($get['a'], $get['id']);
            $this->constructBuilding($get['id'], $get['a']);
        }

        return;
    }

    // FINISH ALL
    if (
        isset($get['buildingFinish']) &&
        $session->gold >= 2 &&
        $session->sit == 0
    ) {
        $this->finishAll();
    }
}

	public function canBuild($id, $tid) {
    global $village, $session, $database;

    // Query unic
    $demolition = $database->getDemolition($village->wid);

    if (
        isset($demolition[0]['buildnumber']) &&
        $demolition[0]['buildnumber'] == $id
    ) {
        return 11;
    }

    // Cache funcții repetitive
    $loop = $this->isLoop($id);
    $current = $this->isCurrent($id);

    if ($this->isMax($tid, $id)) {
        return 1;
    }

    if (
        $this->isMax($tid, $id, 1) &&
        ($loop || $current)
    ) {
        return 10;
    }

    if (
        $this->isMax($tid, $id, 2) &&
        $loop &&
        $current
    ) {
        return 10;
    }

    // Evităm query inutil getMasterJobs()
    if (
        $loop &&
        $current &&
        $this->isMax($tid, $id, 3)
    ) {

        $masterJobs = $database->getMasterJobs($village->wid);

        if (!empty($masterJobs)) {
            return 10;
        }
    }

    if ($this->allocated > $this->maxConcurrent) {
        return 2;
    }

    // Un singur apel
    $fieldType = $village->resarray['f'.$id.'t'];

    // Un singur apel
    $resRequired = $this->resourceRequired($id, $fieldType);

    $resRequiredPop = isset($resRequired['pop'])
        ? $resRequired['pop']
        : 0;

    // Fallback doar dacă trebuie
    if (empty($resRequiredPop)) {
        $buildarray = $GLOBALS['bid'.$tid];
        $resRequiredPop = $buildarray[1]['pop'];
    }

    // Un singur query
    $jobs = $database->getJobs($village->wid);

    $soonPop = 0;

    if (!empty($jobs)) {

        foreach ($jobs as $j) {

            $buildarray = $GLOBALS['bid'.$j['type']];

            // Aici era query per job (!)
            // Reducem drastic CPU + SQL
            static $fieldLevelCache = array();

            $cacheKey = $village->wid.'_'.$j['field'];

            if (!isset($fieldLevelCache[$cacheKey])) {
                $fieldLevelCache[$cacheKey] = $database->getFieldLevel(
                    $village->wid,
                    $j['field']
                );
            }

            $soonPop += $buildarray[
                $fieldLevelCache[$cacheKey] + 1
            ]['pop'];
        }
    }

    if (
        ($village->allcrop - $village->pop - $soonPop - $resRequiredPop) <= 1 &&
        $fieldType != 4
    ) {
        return 4;
    }

    // Un singur apel
    $resourceCheck = $this->checkResource($tid, $id);

    switch ($resourceCheck) {

        case 1:
            return 5;

        case 2:
            return 6;

        case 3:
            return 7;

        case 4:

            if ($id >= 19) {

                $hasMainBuilding =
                    (
                        $session->tribe == 1 ||
                        ALLOW_ALL_TRIBE
                    )
                        ? $this->inner
                        : $this->basic;

                if ($hasMainBuilding == 0) {
                    return 8;
                }

                if ($session->plus || $tid == 40) {
                    return ($this->plus == 0 ? 9 : 3);
                }

                return 2;
            }

            if ($this->basic == 1) {

                if (($session->plus || $tid == 40) && $this->plus == 0) {
                    return 9;
                }

                return 3;
            }

            return 8;
    }
}

	/*****************************************
	Function to wall 
	*****************************************/

	public function walling() {

    global $session;

    foreach ($this->buildArray as $job) {

        // verificăm STRICT tipul clădirii
        if (
            $job['type'] == 31 ||
            $job['type'] == 32 ||
            $job['type'] == 33
        ) {
            return $job['type'];
        }
    }

    return false;
}

	/*****************************************
	Function to rally point
	*****************************************/

	public function rallying() {

    if (empty($this->buildArray)) {
        return false;
    }

    foreach ($this->buildArray as $job) {

        // comparație directă mai rapidă
        if ((int)$job['type'] === 16) {
            return true;
        }
    }

    return false;
}

	/*****************************************
	Function to proc resource type
	*****************************************/

	public static function procResType($ref) {

    // Cache static -> switch-ul nu mai este evaluat constant
    static $types = array(
        1  => WOODCUTTER,
        2  => CLAYPIT,
        3  => IRONMINE,
        4  => CROPLAND,
        5  => SAWMILL,
        6  => BRICKYARD,
        7  => IRONFOUNDRY,
        8  => GRAINMILL,
        9  => BAKERY,
        10 => WAREHOUSE,
        11 => GRANARY,
        12 => BLACKSMITH,
        13 => ARMOURY,
        14 => TOURNAMENTSQUARE,
        15 => MAINBUILDING,
        16 => RALLYPOINT,
        17 => MARKETPLACE,
        18 => EMBASSY,
        19 => BARRACKS,
        20 => STABLE,
        21 => WORKSHOP,
        22 => ACADEMY,
        23 => CRANNY,
        24 => TOWNHALL,
        25 => RESIDENCE,
        26 => PALACE,
        27 => TREASURY,
        28 => TRADEOFFICE,
        29 => GREATBARRACKS,
        30 => GREATSTABLE,
        31 => CITYWALL,
        32 => EARTHWALL,
        33 => PALISADE,
        34 => STONEMASON,
        35 => BREWERY,
        36 => TRAPPER,
        37 => HEROSMANSION,
        38 => GREATWAREHOUSE,
        39 => GREATGRANARY,
        40 => WONDER,
        41 => HORSEDRINKING,
        42 => GREATWORKSHOP
    );

    return isset($types[$ref]) ? $types[$ref] : 'Error';
}

	/*****************************************
	Function to load all building
	*****************************************/

	public function loadBuilding() {
    global $database, $village, $session;

    $this->basic = 0;
    $this->inner = 0;
    $this->plus = 0;

    // un singur query
    $this->buildArray = $database->getJobs($village->wid);

    // count() o singură dată
    $this->allocated = count($this->buildArray);

    if ($this->allocated <= 0) {
        $this->NewBuilding = false;
        return;
    }

    $romanQueue = ($session->tribe == 1 || ALLOW_ALL_TRIBE);

    foreach ($this->buildArray as $build) {

        // master queue
        if ((int)$build['loopcon'] === 1) {
            $this->plus = 1;
            continue;
        }

        // resource fields
        if ($build['field'] <= 18) {
            $this->basic++;
            continue;
        }

        // village buildings
        if ($romanQueue) {
            $this->inner++;
        } else {
            $this->basic++;
        }
    }

    $this->NewBuilding = true;
}

	/*****************************************
	Function to remove building
	*****************************************/

	private function removeBuilding($d) {
    global $database, $village, $session;

    if (empty($this->buildArray)) {
        return;
    }

    foreach ($this->buildArray as $jobs) {

        // early continue
        if ($jobs['id'] != $d) {
            continue;
        }

        // calcul doar când chiar trebuie
        $uprequire = $this->resourceRequired(
            $jobs['field'],
            $jobs['type']
        );

        if (
            $database->removeBuilding(
                $d,
                $session->tribe,
                $village->wid,
                $village->resarray
            )
        ) {

            // refund doar pentru non-master
            if ((int)$jobs['master'] === 0) {

                $database->modifyResource(
                    $village->wid,
                    $uprequire['wood'],
                    $uprequire['clay'],
                    $uprequire['iron'],
                    $uprequire['crop'],
                    1
                );
            }

            $this->redirect($jobs['field']);
        }

        // nu mai continuăm foreach inutil
        break;
    }
}

	/*****************************************
	Function to upgrade building
	*****************************************/

	private function upgradeBuilding($id) {
    global $database, $village, $session, $logging, ${'bid'.$village->resarray['f'.$id.'t']};

    if (!$database->getBuildLock($village->wid)) {
        return;
    }

    try {

        $this->loadBuilding();

        if ($this->allocated >= $this->maxConcurrent) {
            return;
        }

        $fieldType = $village->resarray['f'.$id.'t'];

        // un singur apel
        $uprequire = $this->resourceRequired($id, $fieldType);

        $time = time() + $uprequire['time'];

        // un singur apel
        $bindicate = $this->canBuild($id, $fieldType);

        // early exit
        if (in_array($bindicate, array(1, 2, 3, 10, 11))) {

            header('Location: dorf2.php');
            exit;
        }

        $loop = ($bindicate == 9 ? 1 : 0);
        $loopsame = 0;

        if ($loop == 1) {

            foreach ($this->buildArray as $build) {

                if ($build['field'] == $id) {

                    $loopsame++;

                    // păstrăm logica originală
                    $uprequire = $this->resourceRequired(
                        $id,
                        $fieldType,
                        ($loopsame > 0 ? 2 : 1)
                    );
                }
            }

            $romanQueue = ($session->tribe == 1 || ALLOW_ALL_TRIBE);

            if ($romanQueue) {

                if ($id >= 19) {

                    foreach ($this->buildArray as $build) {

                        if ($build['field'] >= 19) {
                            $time = $build['timestamp'] + $uprequire['time'];
                        }
                    }
                } else {

                    foreach ($this->buildArray as $build) {

                        if ($build['field'] <= 18) {
                            $time = $build['timestamp'] + $uprequire['time'];
                        }
                    }
                }
            } else {

                if (isset($this->buildArray[0]['timestamp'])) {
                    $time = $this->buildArray[0]['timestamp'] + $uprequire['time'];
                }
            }
        }

        // un singur query
        $level = $database->getResourceLevel($village->wid);

        // un singur query
        $queuedBuildings = $database->getBuildingByField(
            $village->wid,
            $id
        );

        $nextLevel =
            $level['f'.$id] +
            1 +
            count($queuedBuildings);

        if (
            $database->addBuilding(
                $village->wid,
                $id,
                $fieldType,
                $loop,
                $time + ($loop == 1 ? ceil(60 / SPEED) : 0),
                0,
                $nextLevel
            )
        ) {

            $database->modifyResource(
                $village->wid,
                $uprequire['wood'],
                $uprequire['clay'],
                $uprequire['iron'],
                $uprequire['crop'],
                0
            );

            $logging->addBuildLog(
                $village->wid,
                self::procResType($fieldType),
                ($village->resarray['f'.$id] + ($loopsame > 0 ? 2 : 1)),
                0
            );

            $this->redirect($id);
        }

    } finally {

        $database->releaseBuildLock($village->wid);
    }
}

	/*****************************************
	Function to downgrade building
	*****************************************/

	private function downgradeBuilding($id) {
    global $database, $village, $session, $logging;

    if (!$database->getBuildLock($village->wid)) {
        return;
    }

    try {

        $this->loadBuilding();

        if ($this->allocated >= $this->maxConcurrent) {
            return;
        }

        $fieldType = $village->resarray['f'.$id.'t'];
        $currentLevel = $village->resarray['f'.$id];

        $name = 'bid'.$fieldType;

        global $$name;

        $dataarray = $$name;

        // calcul o singură dată
        $buildTime = round($dataarray[$currentLevel - 1]['time'] / 4);

        $time = time() + $buildTime;

        $loop = 0;

        // logică identică, branch-uri reduse
        if (
            ($this->inner == 1 || $this->basic == 1) &&
            (($session->plus || $fieldType == 40) && $this->plus == 0)
        ) {
            $loop = 1;
        }

        if ($loop == 1) {

            $romanQueue = ($session->tribe == 1 || ALLOW_ALL_TRIBE);

            if ($romanQueue) {

                if ($id >= 19) {

                    foreach ($this->buildArray as $build) {

                        if ($build['field'] >= 19) {
                            $time = $build['timestamp'] + $buildTime;
                        }
                    }
                }
            } else {

                if (isset($this->buildArray[0]['timestamp'])) {
                    $time = $this->buildArray[0]['timestamp'] + $buildTime;
                }
            }
        }

        // un singur query
        $level = $database->getResourceLevel($village->wid);

        // un singur query
        $queuedBuildings = $database->getBuildingByField(
            $village->wid,
            $id
        );

        if (
            $database->addBuilding(
                $village->wid,
                $id,
                $fieldType,
                $loop,
                $time,
                0,
                0,
                $level['f'.$id] + 1 + count($queuedBuildings)
            )
        ) {

            $logging->addBuildLog(
                $village->wid,
                self::procResType($fieldType),
                ($currentLevel - 1),
                2
            );

            header('Location: dorf2.php');
            exit();
        }

    } finally {

        $database->releaseBuildLock($village->wid);
    }
}

	/*****************************************
	Function to construct building
	*****************************************/

	private function constructBuilding($id, $tid) {
    global $database, $village, $session, $logging;

    if (!$database->getBuildLock($village->wid)) {
        return;
    }

    try {

        $this->loadBuilding();

        if ($this->allocated >= $this->maxConcurrent) {

            header('Location: dorf2.php');
            exit;
        }

        // păstrăm exact logica originală
		$buildField = $id;
		if ($tid == 16) {
		$buildField = 39;
		}
		elseif ($tid == 31 || $tid == 32 || $tid == 33) {
		$buildField = 40;
		}

        // un singur apel
        $uprequire = $this->resourceRequired($buildField, $tid);

        $time = time() + $uprequire['time'];

        // un singur apel
        $bindicate = $this->canBuild($buildField, $tid);

        $loop = ($bindicate == 9 ? 1 : 0);

        if ($loop == 1) {

            $romanQueue = ($session->tribe == 1 || ALLOW_ALL_TRIBE);

            foreach ($this->buildArray as $build) {

                if (
                    $build['field'] >= 19 ||
                    !$romanQueue
                ) {

                    $time =
                        $build['timestamp'] +
                        ceil(60 / SPEED) +
                        $uprequire['time'];
                }
            }
        }

        // early exit
        if (!$this->meetRequirement($tid)) {

            header('Location: dorf2.php');
            exit;
        }

        // un singur query
        $level = $database->getResourceLevel($village->wid);

        // un singur query
        $queuedBuildings = $database->getBuildingByField(
            $village->wid,
            $buildField
        );

        $nextLevel =
            $level['f'.$buildField] +
            1 +
            count($queuedBuildings);

        if (
            $database->addBuilding(
                $village->wid,
                $buildField,
                $tid,
                $loop,
                $time,
                0,
                $nextLevel
            )
        ) {

            $logging->addBuildLog(
                $village->wid,
                self::procResType($tid),
                ($village->resarray['f'.$buildField] + 1),
                1
            );

            $database->modifyResource(
                $village->wid,
                $uprequire['wood'],
                $uprequire['clay'],
                $uprequire['iron'],
                $uprequire['crop'],
                0
            );

            header('Location: dorf2.php');
            exit;
        }

    } finally {

        $database->releaseBuildLock($village->wid);
    }
}

	/*****************************************
	Function to Pallace Build ?
	*****************************************/
	public function isCastleBuilt() {

    global $database, $session;

    // un singur query
    $villages = $database->getProfileVillages($session->uid);

    if (empty($villages)) {
        return false;
    }

    // cache local pentru level queries
    static $villageLevelCache = array();

    foreach ($villages as $vil) {

        $wid = $vil['wref'];

        if (!isset($villageLevelCache[$wid])) {
            $villageLevelCache[$wid] = $database->getResourceLevel($wid);
        }

        if (in_array(26, $villageLevelCache[$wid])) {
            return true;
        }
    }

    return false;
}

	/*****************************************
	Function to meet requirement
	*****************************************/

	private function meetRequirement($id) {

    global $village, $session, $database;

    // cache local enorm de important
    static $typeLevelCache = array();
    static $typeFieldCache = array();

    $getLevel = function($type) use (&$typeLevelCache) {

        if (!isset($typeLevelCache[$type])) {
            $typeLevelCache[$type] = $this->getTypeLevel($type);
        }

        return $typeLevelCache[$type];
    };

    $getField = function($type) use (&$typeFieldCache) {

        if (!isset($typeFieldCache[$type])) {
            $typeFieldCache[$type] = $this->getTypeField($type);
        }

        return $typeFieldCache[$type];
    };

    $isBuilt = $getField($id);

    switch ($id) {

        case 1:
        case 2:
        case 3:
        case 4:
            return true;

        case 5:
            return $getLevel(1) >= 10 &&
                   $getLevel(15) >= 5 &&
                   !$isBuilt;

        case 6:
            return $getLevel(2) >= 10 &&
                   $getLevel(15) >= 5 &&
                   !$isBuilt;

        case 7:
            return $getLevel(3) >= 10 &&
                   $getLevel(15) >= 5 &&
                   !$isBuilt;

        case 8:
            return $getLevel(4) >= 5 &&
                   !$isBuilt;

        case 9:
            return $getLevel(15) >= 5 &&
                   $getLevel(4) >= 10 &&
                   $getLevel(8) >= 5 &&
                   !$isBuilt;

        case 10:
        case 11:
            return $getLevel(15) >= 1 &&
                   (!$isBuilt || $getLevel($id) == 20);

        case 12:
            return $getLevel(22) >= 3 &&
                   $getLevel(15) >= 3 &&
                   !$isBuilt;

        case 13:
            return $getLevel(15) >= 3 &&
                   $getLevel(22) >= 1 &&
                   !$isBuilt;

        case 14:
            return $getLevel(16) >= 15 &&
                   !$isBuilt;

        case 15:
        case 16:
            return !$isBuilt;

        case 17:
            return $getLevel(15) >= 3 &&
                   $getLevel(10) >= 1 &&
                   $getLevel(11) >= 1 &&
                   !$isBuilt;

        case 18:
            return $getLevel(15) >= 1 &&
                   !$isBuilt;

        case 19:
            return $getLevel(15) >= 3 &&
                   $getLevel(16) >= 1 &&
                   !$isBuilt;

        case 20:
            return $getLevel(12) >= 3 &&
                   $getLevel(22) >= 5 &&
                   !$isBuilt;

        case 21:
            return $getLevel(22) >= 10 &&
                   $getLevel(15) >= 5 &&
                   !$isBuilt;

        case 22:
            return $getLevel(15) >= 3 &&
                   $getLevel(19) >= 3 &&
                   !$isBuilt;

        case 23:
            return !$isBuilt || $getLevel($id) == 10;

        case 24:
            return $getLevel(22) >= 10 &&
                   $getLevel(15) >= 10 &&
                   !$isBuilt;

        case 25:
            return $getLevel(15) >= 5 &&
                   !$isBuilt &&
                   !$getField(26);

        case 26:
            return $getLevel(18) >= 1 &&
                   $getLevel(15) >= 5 &&
                   !$isBuilt &&
                   !$this->isCastleBuilt() &&
                   !$getField(25);

        case 27:
            return $getLevel(15) >= 10 &&
                   !$isBuilt;

        case 28:
            return $getLevel(17) == 20 &&
                   $getLevel(20) >= 10 &&
                   !$isBuilt;

        case 29:
            return $getLevel(19) == 20 &&
                   $village->capital == 0 &&
                   !$isBuilt;

        case 30:
            return $getLevel(20) == 20 &&
                   $village->capital == 0 &&
                   !$isBuilt;

        case 31:
            return $session->tribe == 1;

        case 32:
            return $session->tribe == 2;

        case 33:
            return $session->tribe == 3;

        case 34:
            return $getLevel(26) >= 3 &&
                   $getLevel(15) >= 5 &&
                   $getLevel(25) == 0 &&
                   $village->capital != 0 &&
                   !$isBuilt;

        case 35:
            return $getLevel(16) >= 10 &&
                   $getLevel(11) == 20 &&
                   $session->tribe == 2 &&
                   $village->capital != 0 &&
                   !$isBuilt;

        case 36:
            return $getLevel(16) >= 1 &&
                   $session->tribe == 3 &&
                   (!$isBuilt || $getLevel($id) == 20);

        case 37:
            return $getLevel(15) >= 3 &&
                   $getLevel(16) >= 1 &&
                   !$isBuilt;

        // Great Warehouse
        case 38:

            static $greatWarehouseArtefact = null;

            if ($greatWarehouseArtefact === null) {

                $greatWarehouseArtefact =
                    (
                        count($database->getOwnUniqueArtefactInfo2($village->wid, 6, 1, 1)) ||
                        count($database->getOwnUniqueArtefactInfo2($session->uid, 6, 2, 0))
                    );
            }

            return $getLevel(15) >= 10 &&
                   (!$isBuilt || $getLevel($id) == 20) &&
                   ($village->natar == 1 || $greatWarehouseArtefact);

        // Great Granary
        case 39:

            static $greatGranaryArtefact = null;

            if ($greatGranaryArtefact === null) {

                $greatGranaryArtefact =
                    (
                        count($database->getOwnUniqueArtefactInfo2($village->wid, 6, 1, 1)) ||
                        count($database->getOwnUniqueArtefactInfo2($session->uid, 6, 2, 0))
                    );
            }

            return $getLevel(15) >= 10 &&
                   (!$isBuilt || $getLevel($id) == 20) &&
                   ($village->natar == 1 || $greatGranaryArtefact);

        case 40:
            return $this->allowWwUpgrade();

        case 41:
            return $getLevel(16) >= 10 &&
                   $getLevel(20) == 20 &&
                   $session->tribe == 1 &&
                   !$isBuilt;

        case 42:
            return GREAT_WKS &&
                   $getLevel(21) == 20 &&
                   $village->capital == 0 &&
                   !$isBuilt;

        default:
            return false;
    }
}

	/*****************************************
	Function to check resources available
	*****************************************/

	private function checkResource($tid, $id) {

    global $village, $database;

    $name = 'bid'.$tid;

    global $$name;

    $dataarray = $$name;

    // evităm foreach inutil lung
    $plus = 1;

    if (!empty($this->buildArray)) {

        foreach ($this->buildArray as $job) {

            if (
                $job['type'] == $tid &&
                $job['field'] == $id
            ) {
                $plus = 2;
                break;
            }
        }
    }

    // cache local
    $nextLevel = $village->resarray['f'.$id] + $plus;

    $required = $dataarray[$nextLevel];

    $wood = $required['wood'];
    $clay = $required['clay'];
    $iron = $required['iron'];
    $crop = $required['crop'];

    // store limit
    if (
        $wood > $village->maxstore ||
        $clay > $village->maxstore ||
        $iron > $village->maxstore
    ) {
        return 1;
    }

    // granary limit
    if ($crop > $village->maxcrop) {
        return 2;
    }

    // not enough resources
    if (
        $wood > $village->awood ||
        $clay > $village->aclay ||
        $iron > $village->airon ||
        $crop > $village->acrop
    ) {
        return 3;
    }

    return 4;
}

	/*****************************************
	Function to building is max level ?
	*****************************************/

	public function isMax($id, $field, $loop = 0) {

    global $village, $session;

    $name = 'bid'.$id;

    global $$name;

    $dataarray = $$name;

    $currentLevel = $village->resarray['f'.$field];

    // special MH case
    if ($session->tribe == 0) {
        return ($currentLevel == 20);
    }

    // resource fields
    if ($id <= 4) {

        $maxLevel = (
            $village->capital == 1
                ? (count($dataarray) - 1 - $loop)
                : (count($dataarray) - 11 - $loop)
        );

        return ($currentLevel == $maxLevel);
    }

    // normal buildings
    return ($currentLevel == (count($dataarray) - $loop));
}

	/*****************************************
	Function to get type level
	*****************************************/

	public function getTypeLevel($tid, $vid = 0) {

    global $village, $database, $session;

    // support account
    if ($session->uid == 1) {
        return 0;
    }

    // cache masiv de important
    static $resourceCache = array();
    static $typeLevelCache = array();

    $cacheKey = $tid.'_'.$vid;

    if (isset($typeLevelCache[$cacheKey])) {
        return $typeLevelCache[$cacheKey];
    }

    // evităm query-uri repetate
    if ($vid == 0) {

        $resourcearray = $village->resarray;

    } else {

        if (!isset($resourceCache[$vid])) {
            $resourceCache[$vid] = $database->getResourceLevel($vid);
        }

        $resourcearray = $resourceCache[$vid];
    }

    $keyholder = array();

    // mai rapid decât array_keys + strpos
    foreach ($resourcearray as $key => $value) {

        if (
            $value == $tid &&
            strpos($key, 't') !== false
        ) {

            $keyholder[] = (int)preg_replace('/[^0-9]/', '', $key);
        }
    }

    $element = count($keyholder);

    // no building
    if ($element == 0) {
        $typeLevelCache[$cacheKey] = 0;
        return 0;
    }

    // single building
    if ($element == 1) {

        $result = $resourcearray['f'.$keyholder[0]];

        $typeLevelCache[$cacheKey] = $result;

        return $result;
    }

    // multiple buildings
    $target = 0;

    // resource fields
    if ($tid <= 4) {

        $maxLevel = -1;

        foreach ($keyholder as $index => $fieldId) {

            $level = $resourcearray['f'.$fieldId];

            if ($level > $maxLevel) {
                $maxLevel = $level;
                $target = $index;
            }
        }

    } else {

        // village buildings
        foreach ($keyholder as $index => $fieldId) {

            if (
                $resourcearray['f'.$fieldId] >
                $resourcearray['f'.$keyholder[$target]]
            ) {
                $target = $index;
            }
        }
    }

    $result = isset($keyholder[$target])
        ? $resourcearray['f'.$keyholder[$target]]
        : 0;

    $typeLevelCache[$cacheKey] = $result;

    return $result;
}

	/*****************************************
	Function to is current ?
	*****************************************/

	public function isCurrent($id) {

    if (empty($this->buildArray)) {
        return false;
    }

    foreach ($this->buildArray as $build) {

        if (
            $build['field'] == $id &&
            $build['loopcon'] != 1
        ) {
            return true;
        }
    }

    return false;
}

	/*****************************************
	Function to is loop ?
	*****************************************/

	public function isLoop($id = 0) {

    if (empty($this->buildArray)) {
        return false;
    }

    foreach ($this->buildArray as $build) {

        if (
            ($build['field'] == $id && $build['loopcon']) ||
            ($build['loopcon'] == 1 && $id == 0)
        ) {
            return true;
        }
    }

    return false;
}

	/*****************************************
	Function to finish all with gold
	*****************************************/

	public function finishAll($redirect_url = '') {

    global $database, $session, $logging, $village;
    global $bid18, $bid10, $bid11, $technology, $_SESSION;

    $countPlus2Gold  = false;
    $countMasterGold = false;

    $buildcount = (!empty($this->buildArray)
        ? count($this->buildArray)
        : 0);

    $deletIDs = array();

    // cache query-uri
    static $villageResourceCache = array();
    static $villageFieldCache = array();

    foreach ($this->buildArray as $jobs) {

        if ($jobs['wid'] != $village->wid) {
            continue;
        }

        $wid = $jobs['wid'];

        // cache getResourceLevel
        if (!isset($villageResourceCache[$wid])) {
            $villageResourceCache[$wid] = $database->getResourceLevel($wid);
        }

        $wwvillage = $villageResourceCache[$wid];

        // skip WW
        if ($wwvillage['f99t'] == 40) {
            continue;
        }

        $level = $jobs['level'];

        // skip excluded
        if (
            $jobs['type'] == 25 ||
            $jobs['type'] == 26 ||
            $jobs['type'] == 40
        ) {
            continue;
        }

        $resource = $this->resourceRequired(
            $jobs['field'],
            $jobs['type']
        );

        $jobFinishSuccess = false;
        $enought_res = 0;
        $exclude_master = false;

        // MASTER BUILDER
        if ($jobs['master'] != 0) {

            if ($this->meetRequirement($jobs['field'])) {

                // fix gold edge case
                if ($session->gold > 2) {

                    // cache village fields
                    if (!isset($villageFieldCache[$wid])) {

                        $villageFieldCache[$wid] = array(
                            'wood' => $database->getVillageField($wid, 'wood'),
                            'clay' => $database->getVillageField($wid, 'clay'),
                            'iron' => $database->getVillageField($wid, 'iron'),
                            'crop' => $database->getVillageField($wid, 'crop')
                        );
                    }

                    $villwood = $villageFieldCache[$wid]['wood'];
                    $villclay = $villageFieldCache[$wid]['clay'];
                    $villiron = $villageFieldCache[$wid]['iron'];
                    $villcrop = $villageFieldCache[$wid]['crop'];

                    $type = $jobs['type'];

                    $buildarray = $GLOBALS['bid'.$type];

                    $buildwood = $buildarray[$level]['wood'];
                    $buildclay = $buildarray[$level]['clay'];
                    $buildiron = $buildarray[$level]['iron'];
                    $buildcrop = $buildarray[$level]['crop'];

                    if (
                        $buildwood < $villwood &&
                        $buildclay < $villclay &&
                        $buildiron < $villiron &&
                        $buildcrop < $villcrop
                    ) {

                        $jobFinishSuccess = true;
                        $countMasterGold = true;
                        $enought_res = 1;

                        // scădem resurse doar dacă e nevoie
                        if ($buildcount > 2) {

                            $database->setVillageField(
                                $wid,
                                array('wood', 'clay', 'iron', 'crop'),
                                array(
                                    ($villwood - $buildwood),
                                    ($villclay - $buildclay),
                                    ($villiron - $buildiron),
                                    ($villcrop - $buildcrop)
                                )
                            );
                        }
                    }

                } else {

                    $exclude_master = true;
                    $deletIDs[] = (int)$jobs['id'];
                }
            }

        } else {

            // normal build
            $countPlus2Gold = true;
            $jobFinishSuccess = true;
        }

        // update building
        if ($jobFinishSuccess) {

            $q = "
                UPDATE ".TB_PREFIX."fdata
                SET
                    f".$jobs['field']." = ".$jobs['level'].",
                    f".$jobs['field']."t = ".$jobs['type']."
                WHERE vref = ".$wid;

            if (
                !$exclude_master &&
                $database->query($q) &&
                ($enought_res == 1 || $jobs['master'] == 0)
            ) {

                $database->modifyPop(
                    $wid,
                    $resource['pop'],
                    0
                );

                $deletIDs[] = (int)$jobs['id'];

                // embassy update
                if ($jobs['type'] == 18) {

                    $owner = $database->getVillageField(
                        $wid,
                        'owner'
                    );

                    $max = $bid18[$level]['attri'];

					$database->query("UPDATE ".TB_PREFIX."alidata SET max=".$max." WHERE leader=".$owner);
                }
            }
        }

        // roman queue
        if (
            ($jobs['field'] >= 19 &&
            ($session->tribe == 1 || ALLOW_ALL_TRIBE)) ||
            (!ALLOW_ALL_TRIBE && $session->tribe != 1)
        ) {
            $innertimestamp = $jobs['timestamp'];
        }
    }

    // single delete query
    if (!empty($deletIDs)) {

        $database->query("
            DELETE FROM ".TB_PREFIX."bdata
            WHERE id IN(".implode(',', $deletIDs).")
        ");
    }

    $demolition = $database->finishDemolition($village->wid);
    $tech = $technology->finishTech();

    if ($demolition > 0 || $tech > 0) {

        $countPlus2Gold = true;
        $logging->goldFinLog($village->wid);
    }

    // gold update
    if ($countMasterGold || $countPlus2Gold) {
        $spent = ($countMasterGold && $countPlus2Gold) ? 3 : 2;
        $newgold = $session->gold - $spent;

        $database->updateUserField($session->uid, 'gold', $newgold, 1);

        // LOG complet
        $database->query("INSERT INTO ".TB_PREFIX."gold_fin_log 
            (wid, uid, action, gold, time, details) 
            VALUES (".$village->wid.", ".$session->uid.", 'Finish all constructions', -".$spent.", ".time().", 'Finish construction and research with gold')");

        $session->gold = $newgold;
        $_SESSION['gold'] = $newgold;
        // Invalidate the 30s session user-cache (see Session::PopulateVar); the gold
        // write is absolute ($session->gold - $spent), so a stale cache would revert
        // the balance next request and could allow a double-spend.
        unset($_SESSION['cache_user_' . ($_SESSION['username'] ?? '')]);
    }

    // un singur query
    $stillbuildingarray = $database->getJobs($village->wid);

    if (
        count($stillbuildingarray) == 1 &&
        $stillbuildingarray[0]['loopcon'] == 1
    ) {

        $database->query("
            UPDATE ".TB_PREFIX."bdata
            SET loopcon = 0
            WHERE id = ".(int)$stillbuildingarray[0]['id']
        );
    }

    self::recountCP($database, $village->wid);

    header('Location: '.(
        $redirect_url
            ? $redirect_url
            : $session->referrer
    ));

    exit;
}

	/*****************************************
	Function to recount culture point
	*****************************************/

	public static function recountCP($database, $vid) {

    $vid = (int)$vid;

    // un singur query
    $fdata = $database->getResourceLevel($vid);

    $cpTot = 0;

    // micro-optimizare
    for ($i = 1; $i <= 40; $i++) {

        $building = (int)$fdata['f'.$i.'t'];

        // skip rapid
        if ($building <= 0) {
            continue;
        }

        $lvl = (int)$fdata['f'.$i];

        $cpTot += self::buildingCP($building, $lvl);
    }

    // evităm string concat multiplu
    mysqli_query(
        $database->dblink,
        "
        UPDATE ".TB_PREFIX."vdata
        SET cp = ".$cpTot."
        WHERE wref = ".$vid
    );
}

	/*****************************************
	Function to building culture point
	*****************************************/

	public static function buildingCP($f, $lvl) {

    // cache static enorm de util
    static $cpCache = array();

    $cacheKey = $f.'_'.$lvl;

    if (isset($cpCache[$cacheKey])) {
        return $cpCache[$cacheKey];
    }

    $name = 'bid'.$f;

    global $$name;

    $dataarray = $$name;

    $cp = (
        isset($dataarray[$lvl]['cp'])
            ? $dataarray[$lvl]['cp']
            : 0
    );

    $cpCache[$cacheKey] = $cp;

    return $cp;
}

	/*****************************************
	Function to ressource required
	*****************************************/

	public function resourceRequired($id, $tid, $plus = 1) {

    global $village, $bid15, $database;

    $name = 'bid'.$tid;

    global $$name;

    // cache static foarte important
    static $resourceCache = array();

    $cacheKey =
        $id.'_'.
        $tid.'_'.
        $plus.'_'.
        $village->wid;

    if (isset($resourceCache[$cacheKey])) {
        return $resourceCache[$cacheKey];
    }

    $dataarray = $$name;

    // safety
    if (!$dataarray) {

        $empty = array(
            'wood' => 0,
            'clay' => 0,
            'iron' => 0,
            'crop' => 0,
            'pop'  => 0,
            'time' => 0,
            'cp'   => 0
        );

        $resourceCache[$cacheKey] = $empty;

        return $empty;
    }

    $level = $village->resarray['f'.$id] + $plus;

    // un singur lookup
    $required = $dataarray[$level];

    $result = array(
        'wood' => $required['wood'],
        'clay' => $required['clay'],
        'iron' => $required['iron'],
        'crop' => $required['crop'],
        'pop'  => $required['pop'],
        'time' => $database->getBuildingTime(
            $id,
            $tid,
            $plus,
            $village->wid,
            $village->resarray
        ),
        'cp'   => $required['cp']
    );

    $resourceCache[$cacheKey] = $result;

    return $result;
}

	/*****************************************
	Function to get type level
	*****************************************/

	public function getTypeField($type) {

    global $village;

    // cache static
    static $typeFieldCache = array();

    if (isset($typeFieldCache[$type])) {
        return $typeFieldCache[$type];
    }

    for ($i = 19; $i <= 40; $i++) {

        if ($village->resarray['f'.$i.'t'] == $type) {

            $typeFieldCache[$type] = $i;

            return $i;
        }
    }

    $typeFieldCache[$type] = false;

    return false;
}

	/*****************************************
	Function to calculate avaliable
	*****************************************/

	public function calculateAvaliable($id, $tid, $plus = 1) {

    global $village, $generator;

    // un singur apel
    $uprequire = $this->resourceRequired($id, $tid, $plus);

    // cache producții
    static $prodCache = array();

    if (empty($prodCache)) {

        $prodCache = array(
            'wood' => $village->getProd('wood'),
            'clay' => $village->getProd('clay'),
            'crop' => $village->getProd('crop'),
            'iron' => $village->getProd('iron')
        );
    }

    $rwood = $uprequire['wood'] - $village->awood;
    $rclay = $uprequire['clay'] - $village->aclay;
    $rcrop = $uprequire['crop'] - $village->acrop;
    $riron = $uprequire['iron'] - $village->airon;

    // formule identice, branch-uri reduse
    $rwtime = (
        $rwood > 0 && $prodCache['wood'] > 0
            ? ($rwood / $prodCache['wood']) * 3600
            : 0
    );

    $rcltime = (
        $rclay > 0 && $prodCache['clay'] > 0
            ? ($rclay / $prodCache['clay']) * 3600
            : 0
    );

    $rctime = (
        $rcrop > 0 && $prodCache['crop'] > 0
            ? ($rcrop / $prodCache['crop']) * 3600
            : 0
    );

    $ritime = (
        $riron > 0 && $prodCache['iron'] > 0
            ? ($riron / $prodCache['iron']) * 3600
            : 0
    );

    $reqtime = max(
        $rwtime,
        $rctime,
        $rcltime,
        $ritime
    ) + time();

    return $generator->procMtime($reqtime);
}
};

?>