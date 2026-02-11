<?php

/*
=========================================================
= ARTIFACT DOMAIN ENGINE
=========================================================
= Responsible for:
= - Natars creation
= - Artifact villages generation
= - WW villages creation
= - Artifact activation logic
= - Artifact recovery logic
=========================================================
*/

class Artifacts
{
    /*
    =====================================================
    = CORE CONSTANTS – NATARS IDENTITY
    =====================================================
    */

    const NATARS_UID   = 3;
    const NATARS_TRIBE = 5;
    const NATARS_EMAIL = TRIBE5 . "@noreply.com";
    const NATARS_DESC = "**************************
				[#natars]
			**************************";

    /*
    =====================================================
    = NATARS WORLD CONFIGURATION
    =====================================================
    */

    const NATARS_BASE_SPY          = 1500;
    const NATARS_BASE_WW_VILLAGES  = 13;

    /*
    =====================================================
    = NATARS CAPITAL POSSIBLE LOCATIONS
    =====================================================
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
    =====================================================
    = DYNAMIC TROOP GENERATORS
    =====================================================
    */

    public $natarsArtifactsUnits;
    public $natarsWWVillagesUnits;
    public function __construct()
    {
        /*
        -------------------------------------------------
        ARTIFACT VILLAGE TROOPS
        -------------------------------------------------
        */

        $this->natarsArtifactsUnits = function ($multiplier) {

            return [
                41 => rand(1000*$multiplier, 2000*$multiplier) * NATARS_UNITS,
                42 => rand(1500*$multiplier, 2000*$multiplier) * NATARS_UNITS,
                43 => rand(2300*$multiplier, 2800*$multiplier) * NATARS_UNITS,
                44 => rand(25*$multiplier, 75*$multiplier)     * NATARS_UNITS,
                45 => rand(1200*$multiplier, 1900*$multiplier) * NATARS_UNITS,
                46 => rand(1500*$multiplier, 2000*$multiplier) * NATARS_UNITS,
                47 => rand(500*$multiplier, 900*$multiplier)   * NATARS_UNITS,
                48 => rand(100*$multiplier, 300*$multiplier)   * NATARS_UNITS,
                49 => rand(1*$multiplier, 5*$multiplier)       * NATARS_UNITS,
                50 => rand(1*$multiplier, 5*$multiplier)       * NATARS_UNITS
            ];
        };

        /*
        -------------------------------------------------
        WW VILLAGE TROOPS
        -------------------------------------------------
        */

        $this->natarsWWVillagesUnits = function () {

            return [
                41 => rand(500, 12000)  * NATARS_UNITS,
                42 => rand(1000, 14000) * NATARS_UNITS,
                43 => rand(2000, 16000) * NATARS_UNITS,
                44 => rand(100, 500)    * NATARS_UNITS,
                45 => rand(480, 17000)  * NATARS_UNITS,
                46 => rand(600, 18000)  * NATARS_UNITS,
                47 => rand(2000, 16000) * NATARS_UNITS,
                48 => rand(400, 2000)   * NATARS_UNITS,
                49 => rand(40, 200)     * NATARS_UNITS,
                50 => rand(50, 250)     * NATARS_UNITS
            ];
        };
    }


    /*
    =====================================================
    = NATARS ACCOUNT CREATION
    =====================================================
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
        $wid          = $database->getFreeVillage($possibleWids);

        $wid = $database->generateVillages(
            [[
                'wid'     => $wid,
                'mode'    => 2,
                'type'    => 3,
                'kid'     => 0,
                'capital' => 1,
                'pop'     => 834,
                'name'    => null,
                'natar'   => 0
            ]],
            self::NATARS_UID,
            TRIBE5
        );

        $this->scoutAllPlayers($wid);
        $this->addArtifactVillages(self::NATARS_ARTIFACTS);
    }


    /*
    =====================================================
    = ACTIVATE ARTIFACTS ENGINE
    =====================================================
    */

    public function activateArtifacts()
    {
        global $database;

        $activationTime = 86400 / (
            SPEED == 2 ? 1.5 :
            (SPEED == 3 ? 2 : SPEED)
        );

        $artifacts = $database->getInactiveArtifacts(
            round(time() - $activationTime)
        );

        if (empty($artifacts)) {
            return;
        }

        /*
        -------------------------------------------------
        GROUP BY OWNER
        -------------------------------------------------
        */

        $grouped = [];

        foreach ($artifacts as $artifact) {
            $grouped[$artifact['owner']][] = $artifact;
        }

        /*
        -------------------------------------------------
        PROCESS PER OWNER
        -------------------------------------------------
        */

        foreach ($grouped as $owner => $inactiveArtifacts) {

            $ownArtifacts = $database->getOwnArtifactsSum($owner, true);

            foreach ($inactiveArtifacts as $artifact) {

                if ($ownArtifacts['totals'] < 3) {

                    $database->activateArtifact($artifact['id']);
                    $ownArtifacts['totals']++;

                }
            }
        }
    }


    /*
    =====================================================
    = RETURN ARTIFACT TO NATARS
    =====================================================
    */

    public function returnArtifactToNatars($artifactArray)
    {
        global $database;

        $multiplier = $artifactArray['size'] == 3
            ? 4
            : $artifactArray['size'];

        $unitsArray = ($this->natarsArtifactsUnits)($multiplier);

        $artifactTroops[1][] = array_values($unitsArray);
        $artifactTroops[0]   = array_keys($unitsArray);

        $artifactBuildings[1][] = array_values(self::NATARS_ARTIFACTS_BUILDINGS);
        $artifactBuildings[0]   = array_keys(self::NATARS_ARTIFACTS_BUILDINGS);

        $wid = $database->generateVillages(
            [[
                'wid'     => 0,
                'mode'    => $artifactArray['size'] + 1,
                'type'    => 3,
                'kid'     => rand(1,4),
                'capital' => 0,
                'pop'     => 163,
                'name'    => 'Artifact Village',
                'natar'   => 0
            ]],
            self::NATARS_UID,
            TRIBE5,
            $artifactTroops,
            $artifactBuildings
        );

        $database->updateArtifactDetails(
            $artifactArray['id'],
            [
                'vref'  => $wid,
                'owner' => self::NATARS_UID,
                'active'=> 0,
                'del'   => 0
            ]
        );
    }


    /*
    =====================================================
    = ARTIFACT INFO HELPER
    =====================================================
    */

    public static function getArtifactInfo($artifact)
    {
        if (!is_array($artifact)) {
            return [
                "requiredLevel"   => 0,
                "active"          => 0,
                "bonus"           => 0,
                "effectInfluence" => 0,
                "nextEffect"      => 0
            ];
        }

        $activationTime = 86400 / (
            SPEED == 2 ? 1.5 :
            (SPEED == 3 ? 2 : SPEED)
        );

        $time = time();

        $requiredLevel =
            ($artifact['size'] == 1 && $artifact['type'] != 11)
            ? 10
            : 20;

        $active =
            $artifact['owner'] == self::NATARS_UID
            ? "-"
            : ($artifact['active'] ? "<b>".ACTIVE."</b>" : "-");

        return [
            "requiredLevel"   => $requiredLevel,
            "active"          => $active,
            "bonus"           => $artifact['effect'] ?? '',
            "effectInfluence" => ACCOUNT,
            "nextEffect"      => $time + $activationTime
        ];
    }
}

?>
