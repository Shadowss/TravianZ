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
##  Refactor B-D1 : finishAll nu mai ocoleste invalidarea de cache (recountCP  ##
##                  citeste fresh); isCastleBuilt strict pe f{i}t;             ##
##                  downgradeBuilding sters (mort + apel addBuilding cu 8      ##
##                  argumente la semnatura de 7); '>=' consecvent la coada;    ##
##                  FIX confirmat: master finish scade mereu resursele;        ##
##                  FIX confirmat: Hunii pot construi Stonemason via CC        ##
##  Refactor B-W1 : static-urile per metoda -> proprietati de instanta cheiate ##
##                  pe wid (sigur pt. instante multiple / admin switch);       ##
##                  dependinte trase in constructor; parametri redenumiti      ##
##                  consecvent ($gid = tipul cladirii, $fieldId = slotul)      ##
##  Refactor B-W2 : meetRequirement -> tabel declarativ de cerinte + cazuri    ##
##                  speciale; finishAll spart in helpers; SQL-ul raw mutat in  ##
##                  metode Database cu invalidare de cache                     ##
#################################################################################


class Building {

    public $NewBuilding = false;

    private $maxConcurrent;
    private $allocated;

    private $basic = 0;
    private $inner = 0;
    private $plus  = 0;

    public $buildArray = array();

    // B-W1: dependinte trase o singura data - bootstrap-ul din Village.php
    // construieste $building DUPA $village, deci toate exista deja.
    private $db;
    private $sess;
    private $vil;
    private $log;

    // B-W1: fostele "static $cache" din interiorul metodelor, mutate pe instanta
    // si cheiate pe wid unde conteaza. Static-urile per metoda NU se resetau la
    // "new Building" si nu stiau de sat -> mina pentru multi-village/admin switch.
    private $wwUpgradeCache = array();        // [wid => bool]
    private $typeLevelCache = array();        // [vid_gid => nivel]
    private $typeFieldCache = array();        // [wid_gid => fieldId|false]
    private $greatStoreArtefactCache = array(); // [wid => bool]
    private $prodCache = array();             // [wid => [wood, clay, iron, crop]]
    private $fieldLevelCache = array();       // [wid_fieldId => nivel]
    private $resourceReqCache = array();      // [fieldId_gid_plus_wid => array]

    // Zidurile per trib (folosite in 3 locuri: canProcess, walling, constructBuilding)
    private const WALL_GIDS = array(31, 32, 33, 42, 43, 47, 50);

    /**
     * B-W2: cerintele de constructie per gid, declarativ. Evaluate de
     * evaluateRequirements(). Chei:
     *   levels        => [[gid, nivel_minim], ...]   (>=)
     *   exact         => [[gid, nivel_exact], ...]   (==; [25, 0] = "fara Residence")
     *   tribe         => [triburi permise]
     *   notTribe      => [triburi interzise]
     *   capitalOnly   => true  (doar in capitala)
     *   notCapital    => true  (doar in non-capitala)
     *   unique        => false (poate exista deja; default: cere !isBuilt)
     *   rebuildAtLevel=> N     (se poate construi a doua cand prima e la nivelul N)
     * Cazurile ne-tabelare (25, 26, 34, 38, 39, 40, 49) raman in switch-ul din
     * meetRequirement(). Regulile noilor triburi se editeaza aici, intr-un loc.
     */
    private const BUILD_REQUIREMENTS = array(
        1  => array('unique' => false),
        2  => array('unique' => false),
        3  => array('unique' => false),
        4  => array('unique' => false),
        5  => array('levels' => array(array(1, 10), array(15, 5))),
        6  => array('levels' => array(array(2, 10), array(15, 5))),
        7  => array('levels' => array(array(3, 10), array(15, 5))),
        8  => array('levels' => array(array(4, 5))),
        9  => array('levels' => array(array(15, 5), array(4, 10), array(8, 5))),
        10 => array('levels' => array(array(15, 1)), 'rebuildAtLevel' => 20),
        11 => array('levels' => array(array(15, 1)), 'rebuildAtLevel' => 20),
        12 => array('levels' => array(array(22, 3), array(15, 3))),
        13 => array('levels' => array(array(15, 3), array(22, 1))),
        14 => array('levels' => array(array(16, 15))),
        15 => array(),
        16 => array(),
        17 => array('levels' => array(array(15, 3), array(10, 1), array(11, 1))),
        18 => array('levels' => array(array(15, 1))),
        19 => array('levels' => array(array(15, 3), array(16, 1))),
        20 => array('levels' => array(array(12, 3), array(22, 5))),
        21 => array('levels' => array(array(22, 10), array(15, 5))),
        22 => array('levels' => array(array(15, 3), array(19, 3))),
        23 => array('rebuildAtLevel' => 10),
        24 => array('levels' => array(array(22, 10), array(15, 10))),
        27 => array('levels' => array(array(15, 10))),
        28 => array('exact' => array(array(17, 20)), 'levels' => array(array(20, 10))),
        29 => array('exact' => array(array(19, 20)), 'notCapital' => true),
        30 => array('exact' => array(array(20, 20)), 'notCapital' => true),
        31 => array('tribe' => array(1), 'unique' => false),
        32 => array('tribe' => array(2), 'unique' => false),
        33 => array('tribe' => array(3), 'unique' => false),
        35 => array('levels' => array(array(16, 10)), 'exact' => array(array(11, 20)), 'tribe' => array(2), 'capitalOnly' => true),
        36 => array('levels' => array(array(16, 1)), 'tribe' => array(3), 'rebuildAtLevel' => 20),
        37 => array('levels' => array(array(15, 3), array(16, 1))),
        41 => array('levels' => array(array(16, 10)), 'exact' => array(array(20, 20)), 'tribe' => array(1)),
        // Noile triburi:
        42 => array('tribe' => array(7), 'unique' => false),                       // Stone Wall (Egipteni)
        43 => array('tribe' => array(6), 'unique' => false),                       // Makeshift Wall (Huni)
        44 => array('tribe' => array(6), 'levels' => array(array(15, 5)), 'exact' => array(array(25, 0), array(26, 0))), // Command Center
        45 => array('tribe' => array(7), 'levels' => array(array(37, 10))),        // Waterworks
        46 => array('notTribe' => array(8, 9), 'levels' => array(array(15, 10), array(22, 15))), // Hospital
        47 => array('tribe' => array(8), 'unique' => false),                       // Defensive Wall (Spartani)
        48 => array('tribe' => array(8, 9), 'levels' => array(array(15, 10), array(22, 15))),    // Big Hospital
        50 => array('tribe' => array(9), 'unique' => false),                       // Barricade (Vikingi)
    );

    public function __construct() {

        global $database, $session, $village, $logging;

        $this->db   = $database;
        $this->sess = $session;
        $this->vil  = $village;
        $this->log  = $logging;

        $maxConcurrent = BASIC_MAX;

        if (ALLOW_ALL_TRIBE || $this->sess->tribe == 1) {
            $maxConcurrent += INNER_MAX;
        }

        if ($this->sess->plus) {
            $maxConcurrent += PLUS_MAX;
        }

        $this->loadBuilding();

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

    $wid = $this->vil->wid;

    // B-W1: cache pe instanta, cheiat pe wid (era "static $cached" fara cheie)
    if (isset($this->wwUpgradeCache[$wid])) {
        return $this->wwUpgradeCache[$wid];
    }

    $wwHighestLevelFound = (int) $this->vil->resarray['f99'];

    $wwBuildingProgress = $this->db->getBuildingByType($wid, 99);

    if (!empty($wwBuildingProgress[0]['level'])) {
        $queuedLevel = (int) $wwBuildingProgress[0]['level'];

        if ($queuedLevel > $wwHighestLevelFound) {
            $wwHighestLevelFound = $queuedLevel;
        }
    }

    $userHasWWConstructionPlans = $this->db->getWWConstructionPlans($this->sess->uid);

    // Nu facem query inutil daca nu avem alianta
    $allyHasWWConstructionPlans = false;

    if ($this->sess->alliance > 0) {
        $allyHasWWConstructionPlans = $this->db->getWWConstructionPlans(
            $this->sess->uid,
            $this->sess->alliance
        );
    }

    return $this->wwUpgradeCache[$wid] = (
        $wwHighestLevelFound < 50
            ? $userHasWWConstructionPlans
            : ($userHasWWConstructionPlans && $allyHasWWConstructionPlans)
    );
}

	/*****************************************
	Function to Process
	$gid = tipul cladirii (bid), $fieldId = slotul (f1..f40, f99)
	*****************************************/

	public function canProcess($gid, $fieldId) {

    // WW restriction early exit
    if ($fieldId == 99 && !$this->allowWwUpgrade()) {
        $this->redirect($fieldId);
    }

    $fieldTypeKey = 'f'.$fieldId.'t';

    // B-D1: se citeste direct din resarray (acelasi rand fdata; vechiul
    // getResourceLevel() suplimentar era un cache hit pe aceleasi date)
    $currentFieldType = isset($this->vil->resarray[$fieldTypeKey])
        ? (int) $this->vil->resarray[$fieldTypeKey]
        : 0;

    // Validare slot/building
    $isValidSlot =
        (
            ($fieldId >= 1 && $fieldId <= 18 && $gid >= 1 && $gid <= 4) ||
            ($fieldId >= 19 && $gid > 4)
        );

    // Validare building existent
    $isValidFieldType =
        ($currentFieldType == $gid || $currentFieldType == 0);

    // Validare zid
    $isValidWall =
        ($fieldId != 40 || in_array($gid, self::WALL_GIDS));

    if (
        !isset($this->vil->resarray[$fieldTypeKey]) ||
        !$isValidSlot ||
        !$isValidFieldType ||
        !$isValidWall
    ) {
        header('Location: '.$_SERVER['SCRIPT_NAME']);
        exit;
    }

    if (!isset($_GET['master'])) {
        if ($this->checkResource($gid, $fieldId) != 4) {
            $this->redirect($fieldId);
        }

        return;
    }

    // MASTER BUILDER
    if ($currentFieldType == 0) {
        // build nou
        if (!$this->meetRequirement($gid)) {
            $this->redirect($fieldId);
        }
    } else {
        // upgrade
        $loopLevel = $this->isLoop($fieldId);
        $currentLevel = $this->isCurrent($fieldId);

        if ($this->isMax($gid, $fieldId, $loopLevel + $currentLevel)) {
            $this->redirect($fieldId);
        }
    }
}

	/*****************************************
	Function to redirect to dorf1 and dorf2
	*****************************************/

	private function redirect($fieldId) {
    header('Location: '.($fieldId >= 19 ? 'dorf2.php' : 'dorf1.php'));
    exit;
}

	/*****************************************
	Function to proc Building
	*****************************************/

	public function procBuild($get) {

    $validChecker = (
        isset($get['c']) &&
        $get['c'] == $this->sess->checker
    );

    // REMOVE / UPGRADE EXISTING
    if (isset($get['a']) && !isset($get['id']) && $validChecker) {

        if ($get['a'] == 0) {
            $this->removeBuilding($get['d']);
            return;
        }

        $this->sess->changeChecker();

        $fieldType = $this->vil->resarray['f'.$get['a'].'t'];

        $this->canProcess($fieldType, $get['a']);
        $this->upgradeBuilding($get['a']);

        return;
    }

    // MASTER BUILDER
    if (
        isset($get['master'], $get['id']) &&
        $validChecker &&
        $this->sess->gold >= 1 &&
        $this->sess->goldclub &&
        $this->vil->master == 0
    ) {

        $this->canProcess($get['master'], $get['id']);

        $this->sess->changeChecker();

        $level = $this->db->getResourceLevel($this->vil->wid);

        $required = $this->resourceRequired($get['id'], $get['master']);

        $queuedBuildings = $this->db->getBuildingByField(
            $this->vil->wid,
            $get['id']
        );

        // NOTA CONVENTIE (capcana, nu bug): pentru joburile master, coloana
        // timestamp primeste o DURATA ($required['time']), nu un moment absolut.
        // Automation::MasterBuilder() face "timestamp + time()" la promovarea
        // jobului in coada reala. Nu "corecta" cu time() + durata aici.
        $this->db->addBuilding(
            $this->vil->wid,
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

        // NOTA (capcana, nu bug): $get['id'] e NUMARUL SLOTULUI (f19..f40, respectiv
        // f99 pentru WW), NU gid-ul cladirii ($get['a'] e gid-ul). Gate-ul de mai
        // jos valideaza sloturile din dorf2, deci NU blocheaza cladirile cu gid
        // 41-50 (noile triburi).
        if ($get['id'] > 18 && ($get['id'] < 41 || $get['id'] == 99)) {

            $this->sess->changeChecker();

            $this->canProcess($get['a'], $get['id']);
            $this->constructBuilding($get['id'], $get['a']);
        }

        return;
    }

    // FINISH ALL
    if (
        isset($get['buildingFinish']) &&
        $this->sess->gold >= 2 &&
        $this->sess->sit == 0
    ) {
        $this->finishAll();
    }
}

	/*****************************************
	Function to can build
	$fieldId = slotul, $gid = tipul cladirii
	*****************************************/

	public function canBuild($fieldId, $gid) {

    $demolition = $this->db->getDemolition($this->vil->wid);

    if (
        isset($demolition[0]['buildnumber']) &&
        $demolition[0]['buildnumber'] == $fieldId
    ) {
        return 11;
    }

    $loop = $this->isLoop($fieldId);
    $current = $this->isCurrent($fieldId);

    if ($this->isMax($gid, $fieldId)) {
        return 1;
    }

    if (
        $this->isMax($gid, $fieldId, 1) &&
        ($loop || $current)
    ) {
        return 10;
    }

    if (
        $this->isMax($gid, $fieldId, 2) &&
        $loop &&
        $current
    ) {
        return 10;
    }

    if (
        $loop &&
        $current &&
        $this->isMax($gid, $fieldId, 3)
    ) {

        $masterJobs = $this->db->getMasterJobs($this->vil->wid);

        if (!empty($masterJobs)) {
            return 10;
        }
    }

    // FIX B4 (B-D1): '>=' in loc de '>' - la allocated == maxConcurrent coada e
    // deja plina; gate-ul dur din upgradeBuilding() folosea '>=', iar aici '>'
    // dadea un indicator "ok" urmat de un refuz silentios.
    if ($this->allocated >= $this->maxConcurrent) {
        return 2;
    }

    $fieldType = $this->vil->resarray['f'.$fieldId.'t'];

    $resRequired = $this->resourceRequired($fieldId, $fieldType);

    $resRequiredPop = isset($resRequired['pop'])
        ? $resRequired['pop']
        : 0;

    // Fallback doar daca trebuie (constructie noua: fieldType == 0)
    if (empty($resRequiredPop)) {
        $buildarray = $GLOBALS['bid'.$gid];
        $resRequiredPop = $buildarray[1]['pop'];
    }

    $jobs = $this->db->getJobs($this->vil->wid);

    $soonPop = 0;

    if (!empty($jobs)) {

        foreach ($jobs as $j) {

            $buildarray = $GLOBALS['bid'.$j['type']];

            // B-W1: cache pe instanta (era "static" per metoda, nu se reseta
            // la instante noi)
            $cacheKey = $this->vil->wid.'_'.$j['field'];

            if (!isset($this->fieldLevelCache[$cacheKey])) {
                $this->fieldLevelCache[$cacheKey] = $this->db->getFieldLevel(
                    $this->vil->wid,
                    $j['field']
                );
            }

            $soonPop += $buildarray[
                $this->fieldLevelCache[$cacheKey] + 1
            ]['pop'];
        }
    }

    if (
        ($this->vil->allcrop - $this->vil->pop - $soonPop - $resRequiredPop) <= 1 &&
        $fieldType != 4
    ) {
        return 4;
    }

    $resourceCheck = $this->checkResource($gid, $fieldId);

    switch ($resourceCheck) {

        case 1:
            return 5;

        case 2:
            return 6;

        case 3:
            return 7;

        case 4:

            if ($fieldId >= 19) {

                $hasMainBuilding =
                    (
                        $this->sess->tribe == 1 ||
                        ALLOW_ALL_TRIBE
                    )
                        ? $this->inner
                        : $this->basic;

                if ($hasMainBuilding == 0) {
                    return 8;
                }

                if ($this->sess->plus || $gid == 40) {
                    return ($this->plus == 0 ? 9 : 3);
                }

                return 2;
            }

            if ($this->basic == 1) {

                if (($this->sess->plus || $gid == 40) && $this->plus == 0) {
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

    foreach ($this->buildArray as $job) {

        if (in_array($job['type'], self::WALL_GIDS)) {
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

        if ((int) $job['type'] === 16) {
            return true;
        }
    }

    return false;
}

	/*****************************************
	Function to proc resource type
	*****************************************/

	public static function procResType($ref) {

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
        42 => STONEWALL,
        43 => MAKESHIFTWALL,
        44 => COMMANDCENTER,
        45 => WATERWORKS,
        46 => HOSPITAL,
        47 => DEFENSIVEWALL,
        48 => BIGHOSPITAL,
        49 => GREATWORKSHOP,
        50 => BARRICADE
    );

    return isset($types[$ref]) ? $types[$ref] : 'Error';
}

	/*****************************************
	Function to load all building
	*****************************************/

	public function loadBuilding() {

    $this->basic = 0;
    $this->inner = 0;
    $this->plus = 0;

    $this->buildArray = $this->db->getJobs($this->vil->wid);

    $this->allocated = count($this->buildArray);

    if ($this->allocated <= 0) {
        $this->NewBuilding = false;
        return;
    }

    $romanQueue = ($this->sess->tribe == 1 || ALLOW_ALL_TRIBE);

    foreach ($this->buildArray as $build) {

        // master queue
        if ((int) $build['loopcon'] === 1) {
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

    if (empty($this->buildArray)) {
        return;
    }

    foreach ($this->buildArray as $jobs) {

        if ($jobs['id'] != $d) {
            continue;
        }

        $uprequire = $this->resourceRequired(
            $jobs['field'],
            $jobs['type']
        );

        if (
            $this->db->removeBuilding(
                $d,
                $this->sess->tribe,
                $this->vil->wid,
                $this->vil->resarray
            )
        ) {

            // refund doar pentru non-master
            if ((int) $jobs['master'] === 0) {

                $this->db->modifyResource(
                    $this->vil->wid,
                    $uprequire['wood'],
                    $uprequire['clay'],
                    $uprequire['iron'],
                    $uprequire['crop'],
                    1
                );
            }

            $this->redirect($jobs['field']);
        }

        break;
    }
}

	/*****************************************
	Function to upgrade building
	$fieldId = slotul care se upgradeaza
	*****************************************/

	private function upgradeBuilding($fieldId) {

    if (!$this->db->getBuildLock($this->vil->wid)) {
        return;
    }

    try {

        $this->loadBuilding();

        if ($this->allocated >= $this->maxConcurrent) {
            return;
        }

        $fieldType = $this->vil->resarray['f'.$fieldId.'t'];

        $uprequire = $this->resourceRequired($fieldId, $fieldType);

        $time = time() + $uprequire['time'];

        $bindicate = $this->canBuild($fieldId, $fieldType);

        // early exit
        if (in_array($bindicate, array(1, 2, 3, 10, 11))) {

            header('Location: dorf2.php');
            exit;
        }

        $loop = ($bindicate == 9 ? 1 : 0);
        $loopsame = 0;

        if ($loop == 1) {

            foreach ($this->buildArray as $build) {

                if ($build['field'] == $fieldId) {

                    $loopsame++;

                    $uprequire = $this->resourceRequired(
                        $fieldId,
                        $fieldType,
                        ($loopsame > 0 ? 2 : 1)
                    );
                }
            }

            $romanQueue = ($this->sess->tribe == 1 || ALLOW_ALL_TRIBE);

            if ($romanQueue) {

                if ($fieldId >= 19) {

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

        $level = $this->db->getResourceLevel($this->vil->wid);

        $queuedBuildings = $this->db->getBuildingByField(
            $this->vil->wid,
            $fieldId
        );

        $nextLevel =
            $level['f'.$fieldId] +
            1 +
            count($queuedBuildings);

        if (
            $this->db->addBuilding(
                $this->vil->wid,
                $fieldId,
                $fieldType,
                $loop,
                $time + ($loop == 1 ? ceil(60 / SPEED) : 0),
                0,
                $nextLevel
            )
        ) {

            $this->db->modifyResource(
                $this->vil->wid,
                $uprequire['wood'],
                $uprequire['clay'],
                $uprequire['iron'],
                $uprequire['crop'],
                0
            );

            $this->log->addBuildLog(
                $this->vil->wid,
                self::procResType($fieldType),
                ($this->vil->resarray['f'.$fieldId] + ($loopsame > 0 ? 2 : 1)),
                0
            );

            $this->redirect($fieldId);
        }

    } finally {

        $this->db->releaseBuildLock($this->vil->wid);
    }
}

	// B-D1: downgradeBuilding() a fost STEARSA - cod mort (zero apelanti in tot
	// repo-ul; demolarea merge prin finishDemolition) si continea un bug latent:
	// apela addBuilding() cu 8 argumente la o semnatura de 7, deci nivelul
	// calculat era aruncat si jobul s-ar fi inserat cu level = 0.

	/*****************************************
	Function to construct building
	$fieldId = slotul, $gid = tipul cladirii
	*****************************************/

	private function constructBuilding($fieldId, $gid) {

    if (!$this->db->getBuildLock($this->vil->wid)) {
        return;
    }

    try {

        $this->loadBuilding();

        if ($this->allocated >= $this->maxConcurrent) {

            header('Location: dorf2.php');
            exit;
        }

        $buildField = $fieldId;

        if ($gid == 16) {
            $buildField = 39;
        } elseif (in_array($gid, self::WALL_GIDS)) {
            $buildField = 40;
        }

        $uprequire = $this->resourceRequired($buildField, $gid);

        $time = time() + $uprequire['time'];

        $bindicate = $this->canBuild($buildField, $gid);

        $loop = ($bindicate == 9 ? 1 : 0);

        if ($loop == 1) {

            $romanQueue = ($this->sess->tribe == 1 || ALLOW_ALL_TRIBE);

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
        if (!$this->meetRequirement($gid)) {

            header('Location: dorf2.php');
            exit;
        }

        $level = $this->db->getResourceLevel($this->vil->wid);

        $queuedBuildings = $this->db->getBuildingByField(
            $this->vil->wid,
            $buildField
        );

        $nextLevel =
            $level['f'.$buildField] +
            1 +
            count($queuedBuildings);

        if (
            $this->db->addBuilding(
                $this->vil->wid,
                $buildField,
                $gid,
                $loop,
                $time,
                0,
                $nextLevel
            )
        ) {

            $this->log->addBuildLog(
                $this->vil->wid,
                self::procResType($gid),
                ($this->vil->resarray['f'.$buildField] + 1),
                1
            );

            $this->db->modifyResource(
                $this->vil->wid,
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

        $this->db->releaseBuildLock($this->vil->wid);
    }
}

	/*****************************************
	Function to Pallace Build ?
	*****************************************/

	public function isCastleBuilt() {

    $villages = $this->db->getProfileVillages($this->sess->uid);

    if (empty($villages)) {
        return false;
    }

    foreach ($villages as $vilRow) {

        // getResourceLevel e deja cache-uit per request in Database
        $row = $this->db->getResourceLevel($vilRow['wref']);

        // FIX B2 (B-D1): verificare STRICTA pe tipurile sloturilor dorf2
        // (f19t..f40t == 26). Vechiul in_array(26, $row) cauta loose in TOT
        // randul fdata - matchuia si vref == 26, si orice nivel == 26 (WW la
        // nivelul 26) -> fals pozitiv "are Palace" care bloca Palace-ul peste tot.
        for ($i = 19; $i <= 40; $i++) {

            if (isset($row['f'.$i.'t']) && (int) $row['f'.$i.'t'] == 26) {
                return true;
            }
        }
    }

    return false;
}

	/*****************************************
	Function to meet requirement
	B-W2: cazuri speciale + tabel declarativ (BUILD_REQUIREMENTS)
	*****************************************/

	private function meetRequirement($gid) {

    switch ($gid) {

        // Residence: Hunii au Command Center in loc de Residence
        case 25:
            if ($this->sess->tribe == 6) return false;
            return $this->getTypeLevel(15) >= 5 &&
                   !$this->getTypeField(25) &&
                   !$this->getTypeField(26);

        // Palace: Hunii au Command Center in loc de Palace
        case 26:
            if ($this->sess->tribe == 6) return false;
            return $this->getTypeLevel(18) >= 1 &&
                   $this->getTypeLevel(15) >= 5 &&
                   !$this->getTypeField(26) &&
                   !$this->isCastleBuilt() &&
                   !$this->getTypeField(25);

        // Stonemason - doar in capitala
        case 34:
            // FIX confirmat (B-D1): Hunii nu au Palace, deci cerinta "Palace >= 3"
            // ii bloca definitiv. Pentru tribul 6, echivalentul e Command Center
            // (gid 44) >= 3.
            $palaceLevel = ($this->sess->tribe == 6)
                ? $this->getTypeLevel(44)
                : $this->getTypeLevel(26);

            return $palaceLevel >= 3 &&
                   $this->getTypeLevel(15) >= 5 &&
                   $this->getTypeLevel(25) == 0 &&
                   $this->vil->capital != 0 &&
                   !$this->getTypeField(34);

        // Great Warehouse / Great Granary: Natari sau artefact
        case 38:
        case 39:
            return $this->getTypeLevel(15) >= 10 &&
                   (!$this->getTypeField($gid) || $this->getTypeLevel($gid) == 20) &&
                   ($this->vil->natar == 1 || $this->hasGreatStoreArtefact());

        // Wonder of the World
        case 40:
            return $this->allowWwUpgrade();

        // Great Workshop (GREAT_WKS e constanta runtime -> ramane aici, nu in tabel)
        case 49:
            return GREAT_WKS &&
                   $this->getTypeLevel(21) == 20 &&
                   $this->vil->capital == 0 &&
                   !$this->getTypeField(49);
    }

    if (!isset(self::BUILD_REQUIREMENTS[$gid])) {
        return false;
    }

    return $this->evaluateRequirements($gid, self::BUILD_REQUIREMENTS[$gid]);
}

	/**
	 * B-W2: evaluatorul tabelului BUILD_REQUIREMENTS. Conditii pure, fara
	 * side effects - ordinea evaluarii nu schimba rezultatul.
	 */
	private function evaluateRequirements($gid, array $req) {

    if (isset($req['tribe']) && !in_array($this->sess->tribe, $req['tribe'])) {
        return false;
    }

    if (isset($req['notTribe']) && in_array($this->sess->tribe, $req['notTribe'])) {
        return false;
    }

    if (!empty($req['capitalOnly']) && $this->vil->capital == 0) {
        return false;
    }

    if (!empty($req['notCapital']) && $this->vil->capital != 0) {
        return false;
    }

    foreach ((isset($req['levels']) ? $req['levels'] : array()) as $pair) {
        if ($this->getTypeLevel($pair[0]) < $pair[1]) {
            return false;
        }
    }

    foreach ((isset($req['exact']) ? $req['exact'] : array()) as $pair) {
        if ($this->getTypeLevel($pair[0]) != $pair[1]) {
            return false;
        }
    }

    $unique = array_key_exists('unique', $req) ? $req['unique'] : true;

    if ($unique) {

        $isBuilt = $this->getTypeField($gid);

        if (isset($req['rebuildAtLevel'])) {
            return !$isBuilt || $this->getTypeLevel($gid) == $req['rebuildAtLevel'];
        }

        return !$isBuilt;
    }

    return true;
}

	/**
	 * Artefactul de stocare (folosit identic de Great Warehouse si Great Granary).
	 * B-W1: cache pe instanta cheiat pe wid (erau doua static-uri identice,
	 * ne-cheiate, in meetRequirement).
	 */
	private function hasGreatStoreArtefact() {

    $wid = $this->vil->wid;

    if (!isset($this->greatStoreArtefactCache[$wid])) {

        $this->greatStoreArtefactCache[$wid] =
            (
                count($this->db->getOwnUniqueArtefactInfo2($wid, 6, 1, 1)) ||
                count($this->db->getOwnUniqueArtefactInfo2($this->sess->uid, 6, 2, 0))
            );
    }

    return $this->greatStoreArtefactCache[$wid];
}

	/*****************************************
	Function to check resources available
	$gid = tipul cladirii, $fieldId = slotul
	*****************************************/

	private function checkResource($gid, $fieldId) {

    $dataarray = isset($GLOBALS['bid'.$gid]) ? $GLOBALS['bid'.$gid] : null;

    $plus = 1;

    if (!empty($this->buildArray)) {

        foreach ($this->buildArray as $job) {

            if (
                $job['type'] == $gid &&
                $job['field'] == $fieldId
            ) {
                $plus = 2;
                break;
            }
        }
    }

    $nextLevel = $this->vil->resarray['f'.$fieldId] + $plus;

    $required = $dataarray[$nextLevel];

    $wood = $required['wood'];
    $clay = $required['clay'];
    $iron = $required['iron'];
    $crop = $required['crop'];

    // store limit
    if (
        $wood > $this->vil->maxstore ||
        $clay > $this->vil->maxstore ||
        $iron > $this->vil->maxstore
    ) {
        return 1;
    }

    // granary limit
    if ($crop > $this->vil->maxcrop) {
        return 2;
    }

    // not enough resources
    if (
        $wood > $this->vil->awood ||
        $clay > $this->vil->aclay ||
        $iron > $this->vil->airon ||
        $crop > $this->vil->acrop
    ) {
        return 3;
    }

    return 4;
}

	/*****************************************
	Function to building is max level ?
	$gid = tipul cladirii, $fieldId = slotul
	*****************************************/

	public function isMax($gid, $fieldId, $loop = 0) {

    $dataarray = isset($GLOBALS['bid'.$gid]) ? $GLOBALS['bid'.$gid] : null;

    $currentLevel = $this->vil->resarray['f'.$fieldId];

    // special MH case
    if ($this->sess->tribe == 0) {
        return ($currentLevel == 20);
    }

    // resource fields
    if ($gid <= 4) {

        $maxLevel = (
            $this->vil->capital == 1
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

    // support account
    if ($this->sess->uid == 1) {
        return 0;
    }

    // B-W1: cheia foloseste vid-ul EFECTIV - vechea cheie "tid_0" era ambigua
    // intre sate cand $village se schimba in acelasi request (admin switch).
    $effVid = ($vid == 0 ? $this->vil->wid : $vid);
    $cacheKey = $effVid.'_'.$tid;

    if (isset($this->typeLevelCache[$cacheKey])) {
        return $this->typeLevelCache[$cacheKey];
    }

    // getResourceLevel e deja cache-uit per request in Database - vechiul
    // $resourceCache local era un duplicat.
    $resourcearray = ($vid == 0)
        ? $this->vil->resarray
        : $this->db->getResourceLevel($vid);

    $keyholder = array();

    foreach ($resourcearray as $key => $value) {

        if (
            $value == $tid &&
            strpos($key, 't') !== false
        ) {

            $keyholder[] = (int) preg_replace('/[^0-9]/', '', $key);
        }
    }

    $element = count($keyholder);

    // no building
    if ($element == 0) {
        return $this->typeLevelCache[$cacheKey] = 0;
    }

    // single building
    if ($element == 1) {
        return $this->typeLevelCache[$cacheKey] = $resourcearray['f'.$keyholder[0]];
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

    return $this->typeLevelCache[$cacheKey] = $result;
}

	/*****************************************
	Function to is current ?
	*****************************************/

	public function isCurrent($fieldId) {

    if (empty($this->buildArray)) {
        return false;
    }

    foreach ($this->buildArray as $build) {

        if (
            $build['field'] == $fieldId &&
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

	public function isLoop($fieldId = 0) {

    if (empty($this->buildArray)) {
        return false;
    }

    foreach ($this->buildArray as $build) {

        if (
            ($build['field'] == $fieldId && $build['loopcon']) ||
            ($build['loopcon'] == 1 && $fieldId == 0)
        ) {
            return true;
        }
    }

    return false;
}

	/*****************************************
	Function to finish all with gold
	B-W2: spart in helpers; SQL-ul raw mutat in metode Database cu invalidare
	*****************************************/

	public function finishAll($redirect_url = '') {

    global $technology;

    $countPlus2Gold  = false;
    $countMasterGold = false;

    $deletIDs = array();

    // cache local (un singur sat pe apel - bucla filtreaza pe wid-ul curent);
    // e tinut SINCRON dupa fiecare scadere, ca joburile master succesive sa se
    // cumuleze corect (inainte, a doua scriere suprascria prima scadere).
    $villageFields = null;

    foreach ($this->buildArray as $jobs) {

        if ($jobs['wid'] != $this->vil->wid) {
            continue;
        }

        $wid = $jobs['wid'];

        $wwvillage = $this->db->getResourceLevel($wid);

        // INTENTIONAT (confirmat): daca satul detine WW (f99t == 40), finish-ul
        // cu gold e blocat pentru TOATE cladirile satului, nu doar pentru WW -
        // anti-exploit pentru rush-ul de WW. Nu "repara" acest skip.
        if ($wwvillage['f99t'] == 40) {
            continue;
        }

        // Residence / Palace / WW nu se pot termina cu gold
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

            // FIX (B-D1, descoperit la implementare): se verifica cerintele
            // TIPULUI de cladire ($jobs['type']), nu ale numarului de slot -
            // vechiul meetRequirement($jobs['field']) evalua cerintele unui gid
            // aleatoriu (slotul 19..40 interpretat ca gid).
            if ($this->meetRequirement($jobs['type'])) {

                if ($this->sess->gold > 2) {

                    if ($villageFields === null) {

                        $villageFields = array(
                            'wood' => $this->db->getVillageField($wid, 'wood'),
                            'clay' => $this->db->getVillageField($wid, 'clay'),
                            'iron' => $this->db->getVillageField($wid, 'iron'),
                            'crop' => $this->db->getVillageField($wid, 'crop')
                        );
                    }

                    $buildarray = $GLOBALS['bid'.$jobs['type']];

                    $buildwood = $buildarray[$jobs['level']]['wood'];
                    $buildclay = $buildarray[$jobs['level']]['clay'];
                    $buildiron = $buildarray[$jobs['level']]['iron'];
                    $buildcrop = $buildarray[$jobs['level']]['crop'];

                    if (
                        $buildwood < $villageFields['wood'] &&
                        $buildclay < $villageFields['clay'] &&
                        $buildiron < $villageFields['iron'] &&
                        $buildcrop < $villageFields['crop']
                    ) {

                        $jobFinishSuccess = true;
                        $countMasterGold = true;
                        $enought_res = 1;

                        // FIX confirmat (B-D1): resursele se scad INTOTDEAUNA la
                        // finish de master. Vechea conditie "$buildcount > 2"
                        // permitea finish GRATUIT cand erau 1-2 joburi in coada.
                        $villageFields['wood'] -= $buildwood;
                        $villageFields['clay'] -= $buildclay;
                        $villageFields['iron'] -= $buildiron;
                        $villageFields['crop'] -= $buildcrop;

                        $this->db->setVillageField(
                            $wid,
                            array('wood', 'clay', 'iron', 'crop'),
                            array(
                                $villageFields['wood'],
                                $villageFields['clay'],
                                $villageFields['iron'],
                                $villageFields['crop']
                            )
                        );
                    }

                } else {

                    $exclude_master = true;
                    $deletIDs[] = (int) $jobs['id'];
                }
            }

        } else {

            // normal build
            $countPlus2Gold = true;
            $jobFinishSuccess = true;
        }

        // update building
        if ($jobFinishSuccess && !$exclude_master) {

            if (
                $this->db->finishBuildingLevel($wid, $jobs['field'], $jobs['level'], $jobs['type']) &&
                ($enought_res == 1 || $jobs['master'] == 0)
            ) {

                $this->db->modifyPop(
                    $wid,
                    $resource['pop'],
                    0
                );

                $deletIDs[] = (int) $jobs['id'];

                // embassy update
                if ($jobs['type'] == 18) {

                    $owner = $this->db->getVillageField($wid, 'owner');
                    $max = $GLOBALS['bid18'][$jobs['level']]['attri'];

                    $this->db->updateAllianceMax($owner, $max);
                }
            }
        }
    }

    if (!empty($deletIDs)) {
        $this->db->deleteBuildings($this->vil->wid, $deletIDs);
    }

    $demolition = $this->db->finishDemolition($this->vil->wid);
    $tech = $technology->finishTech();

    if ($demolition > 0 || $tech > 0) {

        $countPlus2Gold = true;
        $this->log->goldFinLog($this->vil->wid);
    }

    $this->chargeFinishGold($countMasterGold, $countPlus2Gold);

    $this->promotePendingLoopJob();

    self::recountCP($this->db, $this->vil->wid);

    header('Location: '.(
        $redirect_url
            ? $redirect_url
            : $this->sess->referrer
    ));

    exit;
}

	/**
	 * B-W2: plata cu gold pentru finishAll + log + invalidarea cache-ului de
	 * sesiune (anti double-spend, pastrata 1:1).
	 */
	private function chargeFinishGold($countMasterGold, $countPlus2Gold) {

    if (!$countMasterGold && !$countPlus2Gold) {
        return;
    }

    $spent = ($countMasterGold && $countPlus2Gold) ? 3 : 2;
    $newgold = $this->sess->gold - $spent;

    $this->db->updateUserField($this->sess->uid, 'gold', $newgold, 1);

    $this->db->addGoldFinLog(
        $this->vil->wid,
        $this->sess->uid,
        'Finish all constructions',
        -$spent,
        'Finish construction and research with gold'
    );

    $this->sess->gold = $newgold;
    $_SESSION['gold'] = $newgold;

    // Invalidate the 30s session user-cache (see Session::PopulateVar); the gold
    // write is absolute ($session->gold - $spent), so a stale cache would revert
    // the balance next request and could allow a double-spend.
    unset($_SESSION['cache_user_' . (isset($_SESSION['username']) ? $_SESSION['username'] : '')]);
}

	/**
	 * B-W2: daca a ramas un singur job si e in coada de asteptare (loopcon = 1),
	 * il promoveaza in coada activa. getJobs() citeste mereu fresh din DB
	 * (getBData($wid, false)), deci vede corect starea de dupa stergeri.
	 */
	private function promotePendingLoopJob() {

    $stillbuildingarray = $this->db->getJobs($this->vil->wid);

    if (
        count($stillbuildingarray) == 1 &&
        $stillbuildingarray[0]['loopcon'] == 1
    ) {
        $this->db->promoteLoopJob(
            $this->vil->wid,
            (int) $stillbuildingarray[0]['id']
        );
    }
}

	/*****************************************
	Function to recount culture point
	*****************************************/

	public static function recountCP($database, $vid) {

    $vid = (int) $vid;

    // FIX B1 (B-D1): citire FARA cache. recountCP ruleaza imediat dupa scrieri
    // in fdata si PERSISTA rezultatul in vdata.cp - cu cache-ul de request ar
    // calcula pe nivelele vechi si ar salva un CP gresit in DB.
    $fdata = $database->getResourceLevel($vid, false);

    $cpTot = 0;

    for ($i = 1; $i <= 40; $i++) {

        $building = (int) $fdata['f'.$i.'t'];

        if ($building <= 0) {
            continue;
        }

        $lvl = (int) $fdata['f'.$i];

        $cpTot += self::buildingCP($building, $lvl);
    }

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

    // date pure (bid tables), independente de sat -> static-ul e sigur aici
    static $cpCache = array();

    $cacheKey = $f.'_'.$lvl;

    if (isset($cpCache[$cacheKey])) {
        return $cpCache[$cacheKey];
    }

    $dataarray = isset($GLOBALS['bid'.$f]) ? $GLOBALS['bid'.$f] : null;

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
	$fieldId = slotul, $gid = tipul cladirii
	*****************************************/

	public function resourceRequired($fieldId, $gid, $plus = 1) {

    $cacheKey =
        $fieldId.'_'.
        $gid.'_'.
        $plus.'_'.
        $this->vil->wid;

    if (isset($this->resourceReqCache[$cacheKey])) {
        return $this->resourceReqCache[$cacheKey];
    }

    $dataarray = isset($GLOBALS['bid'.$gid]) ? $GLOBALS['bid'.$gid] : null;

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

        return $this->resourceReqCache[$cacheKey] = $empty;
    }

    $level = $this->vil->resarray['f'.$fieldId] + $plus;

    $required = $dataarray[$level];

    $result = array(
        'wood' => $required['wood'],
        'clay' => $required['clay'],
        'iron' => $required['iron'],
        'crop' => $required['crop'],
        'pop'  => $required['pop'],
        'time' => $this->db->getBuildingTime(
            $fieldId,
            $gid,
            $plus,
            $this->vil->wid,
            $this->vil->resarray
        ),
        'cp'   => $required['cp']
    );

    return $this->resourceReqCache[$cacheKey] = $result;
}

	/*****************************************
	Function to get type field
	*****************************************/

	public function getTypeField($type) {

    // B-W1: cache pe instanta, cheiat pe wid
    $cacheKey = $this->vil->wid.'_'.$type;

    if (isset($this->typeFieldCache[$cacheKey])) {
        return $this->typeFieldCache[$cacheKey];
    }

    for ($i = 19; $i <= 40; $i++) {

        if ($this->vil->resarray['f'.$i.'t'] == $type) {
            return $this->typeFieldCache[$cacheKey] = $i;
        }
    }

    return $this->typeFieldCache[$cacheKey] = false;
}

	/*****************************************
	Function to calculate avaliable
	*****************************************/

	public function calculateAvaliable($fieldId, $gid, $plus = 1) {

    global $generator;

    $uprequire = $this->resourceRequired($fieldId, $gid, $plus);

    // B-W1: cache pe instanta cheiat pe wid (era "static" ne-cheiat: pastra
    // productia PRIMULUI sat pentru orice alt sat din acelasi request)
    $wid = $this->vil->wid;

    if (!isset($this->prodCache[$wid])) {

        $this->prodCache[$wid] = array(
            'wood' => $this->vil->getProd('wood'),
            'clay' => $this->vil->getProd('clay'),
            'crop' => $this->vil->getProd('crop'),
            'iron' => $this->vil->getProd('iron')
        );
    }

    $prod = $this->prodCache[$wid];

    $rwood = $uprequire['wood'] - $this->vil->awood;
    $rclay = $uprequire['clay'] - $this->vil->aclay;
    $rcrop = $uprequire['crop'] - $this->vil->acrop;
    $riron = $uprequire['iron'] - $this->vil->airon;

    $rwtime = (
        $rwood > 0 && $prod['wood'] > 0
            ? ($rwood / $prod['wood']) * 3600
            : 0
    );

    $rcltime = (
        $rclay > 0 && $prod['clay'] > 0
            ? ($rclay / $prod['clay']) * 3600
            : 0
    );

    $rctime = (
        $rcrop > 0 && $prod['crop'] > 0
            ? ($rcrop / $prod['crop']) * 3600
            : 0
    );

    $ritime = (
        $riron > 0 && $prod['iron'] > 0
            ? ($riron / $prod['iron']) * 3600
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
