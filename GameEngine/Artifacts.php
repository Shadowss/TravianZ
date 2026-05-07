<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       30.04.2026	           			       			   		   ##
##  Filename       Artifactis.php                                              ##
##  			   Incremental Refactor Modul						           ##
##  Refactor by:   Shadow 									 		       	   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       	   ##
##  Source code:   https://github.com/Shadowss/TravianZ		               	   ## 
##                                                                             ##
#################################################################################

class Artifacts
{
    /*
    |--------------------------------------------------------------------------
    | NATARS CONFIGURATION
    |--------------------------------------------------------------------------
    */

    const NATARS_UID   = 3;   // Natars user ID
    const NATARS_TRIBE = 5;   // Natars tribe ID

    const NATARS_EMAIL = TRIBE5 . "natars@travian.com";

    const NATARS_DESC = "**************************
[#natars]
**************************";

    /**
     * Helper: speed factor for time-based systems
     * (centralized to avoid duplication)
     */
    private function getSpeedFactor()
    {
        if (SPEED == 2) return 1.5;
        if (SPEED == 3) return 2;
        return SPEED;
    }

    /**
     * Helper: artifact activation time
     */
    private function getActivationTime()
    {
        return 86400 / $this->getSpeedFactor();
    }

    /*
    |--------------------------------------------------------------------------
    | NATARS CAPITAL LOCATIONS
    |--------------------------------------------------------------------------
    */

    const NATARS_CAPITAL_COORDINATES = [
        [WORLD_MAX, WORLD_MAX],
        [WORLD_MAX, 0],
        [WORLD_MAX, -WORLD_MAX],
        [0, -WORLD_MAX],
        [-WORLD_MAX, -WORLD_MAX],
        [-WORLD_MAX, 0],
        [-WORLD_MAX, WORLD_MAX],
        [0, WORLD_MAX],
        [WORLD_MAX / 10, WORLD_MAX / 20],
        [WORLD_MAX / 10, -WORLD_MAX / 10],
        [-WORLD_MAX / 20, -WORLD_MAX / 10],
        [-WORLD_MAX / 10, 0],
        [-WORLD_MAX / 20, WORLD_MAX / 10]
    ];

    /*
    |--------------------------------------------------------------------------
    | ARTIFACT DEFINITIONS
    |--------------------------------------------------------------------------
    */

    const NATARS_ARTIFACTS = [
        ARCHITECTS_DESC => [
            ["type" => 1, "size" => 1, "name" => ARCHITECTS_SMALL, "vname" => ARCHITECTS_SMALLVILLAGE, "effect" => "(4x)", "quantity" => 6, "img" => 2],
            ["type" => 1, "size" => 2, "name" => ARCHITECTS_LARGE, "vname" => ARCHITECTS_LARGEVILLAGE, "effect" => "(3x)", "quantity" => 4, "img" => 2],
            ["type" => 1, "size" => 3, "name" => ARCHITECTS_UNIQUE, "vname" => ARCHITECTS_UNIQUEVILLAGE, "effect" => "(5x)", "quantity" => 1, "img" => 2],
        ],

        HASTE_DESC => [
            ["type" => 2, "size" => 1, "name" => HASTE_SMALL, "vname" => HASTE_SMALLVILLAGE, "effect" => "(2x)", "quantity" => 6, "img" => 4],
            ["type" => 2, "size" => 2, "name" => HASTE_LARGE, "vname" => HASTE_LARGEVILLAGE, "effect" => "(1.5x)", "quantity" => 4, "img" => 4],
            ["type" => 2, "size" => 3, "name" => HASTE_UNIQUE, "vname" => HASTE_UNIQUEVILLAGE, "effect" => "(3x)", "quantity" => 1, "img" => 4],
        ],

        EYESIGHT_DESC => [
            ["type" => 3, "size" => 1, "name" => EYESIGHT_SMALL, "vname" => EYESIGHT_SMALLVILLAGE, "effect" => "(5x)", "quantity" => 6, "img" => 5],
            ["type" => 3, "size" => 2, "name" => EYESIGHT_LARGE, "vname" => EYESIGHT_LARGEVILLAGE, "effect" => "(3x)", "quantity" => 4, "img" => 5],
            ["type" => 3, "size" => 3, "name" => EYESIGHT_UNIQUE, "vname" => EYESIGHT_UNIQUEVILLAGE, "effect" => "(10x)", "quantity" => 1, "img" => 5],
        ],

        DIET_DESC => [
            ["type" => 4, "size" => 1, "name" => DIET_SMALL, "vname" => DIET_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 6],
            ["type" => 4, "size" => 2, "name" => DIET_LARGE, "vname" => DIET_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 6],
            ["type" => 4, "size" => 3, "name" => DIET_UNIQUE, "vname" => DIET_UNIQUEVILLAGE, "effect" => "(50%)", "quantity" => 1, "img" => 6],
        ],

        ACADEMIC_DESC => [
            ["type" => 5, "size" => 1, "name" => ACADEMIC_SMALL, "vname" => ACADEMIC_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 8],
            ["type" => 5, "size" => 2, "name" => ACADEMIC_LARGE, "vname" => ACADEMIC_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 8],
            ["type" => 5, "size" => 3, "name" => ACADEMIC_UNIQUE, "vname" => ACADEMIC_UNIQUEVILLAGE, "effect" => "(50%)", "quantity" => 1, "img" => 8],
        ],

        STORAGE_DESC => [
            ["type" => 6, "size" => 1, "name" => STORAGE_SMALL, "vname" => STORAGE_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 9],
            ["type" => 6, "size" => 2, "name" => STORAGE_LARGE, "vname" => STORAGE_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 9],
        ],

        CONFUSION_DESC => [
            ["type" => 7, "size" => 1, "name" => CONFUSION_SMALL, "vname" => CONFUSION_SMALLVILLAGE, "effect" => "(200)", "quantity" => 6, "img" => 10],
            ["type" => 7, "size" => 2, "name" => CONFUSION_LARGE, "vname" => CONFUSION_LARGEVILLAGE, "effect" => "(100)", "quantity" => 4, "img" => 10],
            ["type" => 7, "size" => 3, "name" => CONFUSION_UNIQUE, "vname" => CONFUSION_UNIQUEVILLAGE, "effect" => "(500)", "quantity" => 1, "img" => 10],
        ],

        FOOL_DESC => [
            ["type" => 8, "size" => 1, "name" => FOOL_SMALL, "vname" => FOOL_SMALLVILLAGE, "effect" => "", "quantity" => 10, "img" => "fool"],
            2 => ["type" => 8, "size" => 3, "name" => FOOL_UNIQUE, "vname" => FOOL_UNIQUEVILLAGE, "effect" => "", "quantity" => 1, "img" => "fool"]
        ]
    ];

    /*
    |--------------------------------------------------------------------------
    | WW BUILDING PLANS
    |--------------------------------------------------------------------------
    */

    const NATARS_WW_BUILDING_PLANS = [
        PLAN_DESC => [
            ["type" => 11, "size" => 1, "name" => PLAN, "vname" => PLANVILLAGE, "effect" => "", "quantity" => 13, "img" => 1]
        ]
    ];

    /*
    |--------------------------------------------------------------------------
    | BUILDINGS SETUP
    |--------------------------------------------------------------------------
    */

    const NATARS_ARTIFACTS_BUILDINGS = [
        "f22t" => 27, "f22" => 20,
        "f28t" => 25, "f28" => 10,
        "f39t" => 16, "f39" => 1,

        "f19t" => 23, "f19" => 10,
        "f20t" => 23, "f20" => 10,
        "f21t" => 23, "f21" => 10,
        "f23t" => 23, "f23" => 10,
        "f24t" => 23, "f24" => 10,
        "f25t" => 23, "f25" => 10,
        "f26t" => 23, "f26" => 10,
        "f27t" => 23, "f27" => 10,
        "f29t" => 23, "f29" => 10,
        "f30t" => 23, "f30" => 10,
        "f31t" => 23, "f31" => 10,
        "f32t" => 23, "f32" => 10,
        "f33t" => 23, "f33" => 10,
        "f34t" => 23, "f34" => 10,
        "f35t" => 23, "f35" => 10,
        "f36t" => 23, "f36" => 10,
        "f37t" => 23, "f37" => 10,
        "f38t" => 23, "f38" => 10,
    ];

    const NATARS_WW_VILLAGES_BUILDINGS = [
        "f99t" => 40, "f99" => 0,
        "f22t" => 15, "f22" => 10,
        "f34t" => 17, "f34" => 1,

        "f20t" => 10, "f20" => 20,
        "f19t" => 10, "f19" => 10,
        "f23t" => 11, "f23" => 20,
        "f27t" => 11, "f27" => 10,

        "f1" => 5, "f3" => 5, "f14" => 5, "f17" => 5,
        "f5" => 5, "f6" => 5, "f16" => 5, "f18" => 5,
        "f4" => 5, "f7" => 5, "f10" => 5, "f11" => 5,
        "f2" => 6, "f8" => 6, "f9" => 6, "f12" => 6, "f13" => 6, "f15" => 6,
    ];

    const NATARS_BASE_SPY = 1500;
    const NATARS_BASE_WW_VILLAGES = 13;

    /*
    |--------------------------------------------------------------------------
    | TROOP GENERATORS
    |--------------------------------------------------------------------------
    */

    public $natarsArtifactsUnits;
    public $natarsWWVillagesUnits;

    public function __construct()
    {
        /**
         * Units for artifact villages
         */
        $this->natarsArtifactsUnits = function ($multiplier) {
            return [
                41 => rand(1000 * $multiplier, 2000 * $multiplier) * NATARS_UNITS,
                42 => rand(1500 * $multiplier, 2000 * $multiplier) * NATARS_UNITS,
                43 => rand(2300 * $multiplier, 2800 * $multiplier) * NATARS_UNITS,
                44 => rand(25 * $multiplier, 75 * $multiplier) * NATARS_UNITS,
                45 => rand(1200 * $multiplier, 1900 * $multiplier) * NATARS_UNITS,
                46 => rand(1500 * $multiplier, 2000 * $multiplier) * NATARS_UNITS,
                47 => rand(500 * $multiplier, 900 * $multiplier) * NATARS_UNITS,
                48 => rand(100 * $multiplier, 300 * $multiplier) * NATARS_UNITS,
                49 => rand(1 * $multiplier, 5 * $multiplier) * NATARS_UNITS,
                50 => rand(1 * $multiplier, 5 * $multiplier) * NATARS_UNITS,
            ];
        };

        /**
         * Units for WW villages
         */
        $this->natarsWWVillagesUnits = function () {
            return [
                41 => rand(500, 12000) * NATARS_UNITS,
                42 => rand(1000, 14000) * NATARS_UNITS,
                43 => rand(2000, 16000) * NATARS_UNITS,
                44 => rand(100, 500) * NATARS_UNITS,
                45 => rand(480, 17000) * NATARS_UNITS,
                46 => rand(600, 18000) * NATARS_UNITS,
                47 => rand(2000, 16000) * NATARS_UNITS,
                48 => rand(400, 2000) * NATARS_UNITS,
                49 => rand(40, 200) * NATARS_UNITS,
                50 => rand(50, 250) * NATARS_UNITS,
            ];
        };
    }

    /*
    |--------------------------------------------------------------------------
    | NATARS CREATION
    |--------------------------------------------------------------------------
    */

    public function createNatars()
    {
        global $database;

        $password = $database->getUserField(5, 'password', 0);

        $database->register(
            TRIBE5,
            $password,
            self::NATARS_EMAIL,
            self::NATARS_TRIBE,
            null,
            self::NATARS_UID,
            self::NATARS_DESC
        );

        $possibleWids = $database->getVilWrefs(self::NATARS_CAPITAL_COORDINATES);
        $wid = $database->getFreeVillage($possibleWids);

        $wid = $database->generateVillages(
            [
                [
                    'wid' => $wid,
                    'mode' => 2,
                    'type' => 3,
                    'kid' => 0,
                    'capital' => 1,
                    'pop' => 834,
                    'name' => null,
                    'natar' => 0
                ]
            ],
            self::NATARS_UID,
            TRIBE5
        );

        $this->scoutAllPlayers($wid);
        $this->addArtifactVillages(self::NATARS_ARTIFACTS);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOUT SYSTEM
    |--------------------------------------------------------------------------
    */

    public function scoutAllPlayers($wid)
    {
        global $database;

        $array = $database->getProfileVillages(0, 1);

        $refs = [];
        $vils = [];

        foreach ($array as $vill) {
            $refs[] = $database->addAttack(
                $wid,
                0,
                0,
                0,
                self::NATARS_BASE_SPY * NATARS_UNITS,
                0, 0, 0, 0, 0, 0, 0,
                1,
                0,
                0,
                1,
                0,
                0,
                0,
                20,
                0, 0, 0, 0
            );

            $vils[] = $vill['wref'];
        }

        $type = $from = $to = $ref = $time = $endtime = [];
        $counter = 0;

        $timeValue = time();
        $endtimeValue = $timeValue + round(10000 / SPEED);

        foreach ($refs as $index => $refID) {

            $type[] = 3;
            $from[] = $wid;
            $to[] = $vils[$index];
            $ref[] = $refID;
            $time[] = $timeValue;
            $endtime[] = $endtimeValue;

            if (++$counter > 25) {
                $database->addMovement($type, $from, $to, $ref, $time, $endtime);

                $type = $from = $to = $ref = $time = $endtime = [];
                $counter = 0;
            }
        }

        if ($counter > 0) {
            $database->addMovement($type, $from, $to, $ref, $time, $endtime);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ARTIFACT VILLAGES
    |--------------------------------------------------------------------------
    */

    public function addArtifactVillages($artifactArrays, $uid = self::NATARS_UID, $addTroops = true)
    {
        global $database;

        $artifactVillages = $artifactTroops = $artifactBuildings = $artifactsToAdd = $wids = [];

        foreach ($artifactArrays as $desc => $artifactType) {
            foreach ($artifactType as $artifact) {
                for ($i = 0; $i < $artifact['quantity']; $i++) {

                    $artifactVillages[] = [
                        'wid' => 0,
                        'mode' => $artifact['size'] + 1,
                        'type' => 3,
                        'kid' => rand(1, 4),
                        'capital' => 0,
                        'pop' => 163,
                        'name' => $artifact['vname'],
                        'natar' => 0
                    ];

                    $multiplier = ($artifact['size'] == 3) ? 4 : $artifact['size'];
                    $unitArrays = ($this->natarsArtifactsUnits)($multiplier);

                    if ($addTroops) {
                        $artifactTroops[1][] = array_values($unitArrays);
                    }

                    $artifactBuildings[1][] = array_values(self::NATARS_ARTIFACTS_BUILDINGS);

                    $artifactsToAdd[] = [
                        'owner' => $uid,
                        'type' => $artifact['type'],
                        'size' => $artifact['size'],
                        'name' => $artifact['name'],
                        'desc' => $desc,
                        'effect' => $artifact['effect'],
                        'img' => "type" . $artifact['img'] . ".gif"
                    ];
                }
            }
        }

        if ($addTroops) {
            $artifactTroops[0] = array_keys($unitArrays);
        }

        $artifactBuildings[0] = array_keys(self::NATARS_ARTIFACTS_BUILDINGS);

        $wids = $database->generateVillages(
            $artifactVillages,
            $uid,
            TRIBE5,
            $addTroops ? $artifactTroops : null,
            $artifactBuildings
        );

        $database->addArtefacts($wids, $artifactsToAdd);
    }

    /*
    |--------------------------------------------------------------------------
    | WW VILLAGES
    |--------------------------------------------------------------------------
    */

    public function createWWVillages($numberOfVillages = self::NATARS_BASE_WW_VILLAGES, $uid = self::NATARS_UID, $addTroops = true)
    {
        global $database;

        $villageArrays = $troopArrays = $buildingArrays = [];

        for ($i = 1; $i <= $numberOfVillages; $i++) {

            $villageArrays[] = [
                'wid' => 0,
                'mode' => 5,
                'type' => 3,
                'kid' => ($i == $numberOfVillages ? rand(1, 4) : ($i % 4) + 1),
                'capital' => 0,
                'pop' => 233,
                'name' => WWVILLAGE,
                'natar' => 1
            ];

            if ($addTroops) {
                $troopArrays[1][] = array_values(($this->natarsWWVillagesUnits)());
            }

            $buildingArrays[1][] = array_values(self::NATARS_WW_VILLAGES_BUILDINGS);
        }

        if ($addTroops) {
            $troopArrays[0] = array_keys(($this->natarsWWVillagesUnits)());
        }

        $buildingArrays[0] = array_keys(self::NATARS_WW_VILLAGES_BUILDINGS);

        $database->generateVillages(
            $villageArrays,
            $uid,
            null,
            $addTroops ? $troopArrays : null,
            $buildingArrays
        );
    }

    /*
    |--------------------------------------------------------------------------
    | WW BUILDING PLANS
    |--------------------------------------------------------------------------
    */

    public function createWWBuildingPlans()
    {
        $this->addArtifactVillages(self::NATARS_WW_BUILDING_PLANS);
    }

    /*
    |--------------------------------------------------------------------------
    | ARTIFACT ACTIVATION SYSTEM
    |--------------------------------------------------------------------------
    */

    public function activateArtifacts()
    {
        global $database;

        $time = time();

        $artifacts = $database->getInactiveArtifacts(
            round($time - $this->getActivationTime())
        );

        if (empty($artifacts)) return;

        $cache = [];

        foreach ($artifacts as $artifact) {
            $cache[$artifact['owner']][] = $artifact;
        }

        foreach ($cache as $owner => $inactiveArtifacts) {

            $ownArtifacts = $database->getOwnArtifactsSum($owner, true);

            foreach ($inactiveArtifacts as $artifact) {

                if ($ownArtifacts['totals'] < 3) {

                    if ($artifact['size'] == 1) {

                        $database->activateArtifact($artifact['id']);
                        $ownArtifacts['totals']++;
                        $ownArtifacts['small']++;

                    } elseif ($artifact['size'] == 2 && !$ownArtifacts['unique'] && !$ownArtifacts['great']) {

                        $database->activateArtifact($artifact['id']);
                        $ownArtifacts['totals']++;
                        $ownArtifacts['great']++;

                    } elseif ($artifact['size'] == 3 && !$ownArtifacts['unique'] && !$ownArtifacts['great']) {

                        $database->activateArtifact($artifact['id']);
                        $ownArtifacts['totals']++;
                        $ownArtifacts['unique']++;
                    }

                } elseif ($ownArtifacts['small'] == 3 && $artifact['size'] > 1) {

                    $database->activateArtifact(
                        $database->getNewestArtifactBySize($owner, 1)['id'],
                        0
                    );

                    $database->activateArtifact($artifact['id']);

                    $ownArtifacts['small']--;
                    $ownArtifacts['totals']++;

                    if ($artifact['size'] == 2) $ownArtifacts['great']++;
                    else $ownArtifacts['unique']++;
                }
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RETURN ARTIFACT
    |--------------------------------------------------------------------------
    */

    public function returnArtifactToNatars($artifactArray)
    {
        global $database;

        $artifactArrays = array_merge(
            self::NATARS_ARTIFACTS,
            self::NATARS_WW_BUILDING_PLANS
        );

        $villageArrays = [[
            'wid' => 0,
            'mode' => $artifactArray['size'] + 1,
            'type' => 3,
            'kid' => rand(1, 4),
            'capital' => 0,
            'pop' => 163,
            'name' => $artifactArrays[$artifactArray['desc']][$artifactArray['size'] - 1]['vname'],
            'natar' => 0
        ]];

        $multiplier = ($artifactArray['size'] == 3) ? 4 : $artifactArray['size'];
        $unitsArray = ($this->natarsArtifactsUnits)($multiplier);

        $artifactTroops[1][] = array_values($unitsArray);
        $artifactTroops[0] = array_keys($unitsArray);

        $artifactBuildings[1][] = array_values(self::NATARS_ARTIFACTS_BUILDINGS);
        $artifactBuildings[0] = array_keys(self::NATARS_ARTIFACTS_BUILDINGS);

        $wid = $database->generateVillages(
            $villageArrays,
            self::NATARS_UID,
            TRIBE5,
            $artifactTroops,
            $artifactBuildings
        );

        $database->updateArtifactDetails(
            $artifactArray['id'],
            [
                'vref' => $wid,
                'owner' => self::NATARS_UID,
                'active' => 0,
                'del' => 0
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ARTIFACT INFO DISPLAY
    |--------------------------------------------------------------------------
    */

    public static function getArtifactInfo($artifact)
    {
        $instance = new self();
        $activationTime = $instance->getActivationTime();

        $time = time();

        $nextEffect = "-";

        if (is_array($artifact)) {

            if ($artifact['size'] == 1 && $artifact['type'] != 11) {
                $requiredLevel = 10;
                $effectInfluence = VILLAGE;
            } else {
                $requiredLevel = ($artifact['type'] != 11) ? 20 : 10;
                $effectInfluence = ACCOUNT;
            }

            if ($artifact['owner'] == 3) {
                $active = "-";
            } elseif (!$artifact['active'] && $artifact['conquered'] < $time - $activationTime) {
                $active = "<b>Can't be activated</b>";
            } elseif (!$artifact['active']) {
                $active = date("d.m.Y H:i:s", $artifact['conquered'] + $activationTime);
            } else {
                $active = "<b>" . ACTIVE . "</b>";
                $nextEffect = date("d.m.Y H:i:s", $artifact['lastupdate'] + $activationTime);
            }

            $kind = ($artifact['type'] == 8) ? $artifact['kind'] : $artifact['type'];
            $effect = ($artifact['type'] == 8) ? $artifact['effect2'] : $artifact['effect'];

            $artifactBadEffect = ($artifact['type'] == 8 && $artifact['bad_effect'] == 1);

            switch ($kind) {
                case 1: $betterorbadder = $artifactBadEffect ? BUILDING_WEAKER : BUILDING_STRONGER; break;
                case 2: $betterorbadder = $artifactBadEffect ? TROOPS_SLOWEST : TROOPS_FASTER; break;
                case 3: $betterorbadder = $artifactBadEffect ? SPIES_DECRESE : SPIES_INCREASE; break;
                case 4: $betterorbadder = $artifactBadEffect ? CONSUME_HIGH : CONSUME_LESS; break;
                case 5: $betterorbadder = $artifactBadEffect ? TROOPS_MAKE_SLOWEST : TROOPS_MAKE_FASTER; break;
                case 6: $betterorbadder = YOU_CONSTRUCT; break;
                case 7: $betterorbadder = $artifactBadEffect ? CRANNY_DECRESE : CRANNY_INCREASED; break;
                case 8: $betterorbadder = $artifactBadEffect ? SPIES_INCREASE : SPIES_DECRESE; break;
            }

            $bonus = isset($betterorbadder)
                ? $betterorbadder . " (<b>" . str_replace(["(", ")"], "", $effect) . "</b>)"
                : (($kind == 11 && $artifact['active']) ? "<b>" . WW_BUILDING_PLAN . "</b>" : "<b>Not yet active</b>");

        } else {
            $requiredLevel = $active = $bonus = $effectInfluence = $nextEffect = 0;
        }

        return [
            "requiredLevel" => $requiredLevel,
            "active" => $active,
            "bonus" => $bonus,
            "effectInfluence" => $effectInfluence,
            "nextEffect" => $nextEffect
        ];
    }
}
?>