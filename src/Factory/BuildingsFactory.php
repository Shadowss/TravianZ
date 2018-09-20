<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Author: iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */
namespace TravianZ\Factory;

use TravianZ\Entity\Building;
use TravianZ\Data\Buildings\Academy;
use TravianZ\Data\Buildings\Armoury;
use TravianZ\Data\Buildings\Bakery;
use TravianZ\Data\Buildings\Barracks;
use TravianZ\Data\Buildings\Blacksmith;
use TravianZ\Data\Buildings\Brewery;
use TravianZ\Data\Buildings\Brickyard;
use TravianZ\Data\Buildings\CityWall;
use TravianZ\Data\Buildings\ClayPit;
use TravianZ\Data\Buildings\Cranny;
use TravianZ\Data\Buildings\Cropland;
use TravianZ\Data\Buildings\EarthWall;
use TravianZ\Data\Buildings\Embassy;
use TravianZ\Data\Buildings\EmptyCell;
use TravianZ\Data\Buildings\GrainMill;
use TravianZ\Data\Buildings\Granary;
use TravianZ\Data\Buildings\GreatBarracks;
use TravianZ\Data\Buildings\GreatGranary;
use TravianZ\Data\Buildings\GreatStable;
use TravianZ\Data\Buildings\GreatWarehouse;
use TravianZ\Data\Buildings\GreatWorkshop;
use TravianZ\Data\Buildings\HeroMansion;
use TravianZ\Data\Buildings\HorseDrinkingTrough;
use TravianZ\Data\Buildings\IronFoundry;
use TravianZ\Data\Buildings\IronMine;
use TravianZ\Data\Buildings\MainBuilding;
use TravianZ\Data\Buildings\Marketplace;
use TravianZ\Data\Buildings\Palace;
use TravianZ\Data\Buildings\Palisade;
use TravianZ\Data\Buildings\RallyPoint;
use TravianZ\Data\Buildings\Residence;
use TravianZ\Data\Buildings\Sawmill;
use TravianZ\Data\Buildings\Stable;
use TravianZ\Data\Buildings\StonemasonLodge;
use TravianZ\Data\Buildings\TournamentSquare;
use TravianZ\Data\Buildings\TownHall;
use TravianZ\Data\Buildings\TradeOffice;
use TravianZ\Data\Buildings\Trapper;
use TravianZ\Data\Buildings\Treasury;
use TravianZ\Data\Buildings\Warehouse;
use TravianZ\Data\Buildings\WonderOfTheWorld;
use TravianZ\Data\Buildings\Woodcutter;
use TravianZ\Data\Buildings\Workshop;
use TravianZ\Enums\BuildingEnums;
use TravianZ\Enums\UnitEnums;

/**
 *
 * @author iopietro
 */
abstract class BuildingsFactory
{
    /**
     * Instantiate a new class of the selected building
     * 
     * @param int $id The building ID
     * @param int $position The building position on the village 
     * @param int $level The actual building level
     * @return Building Return the class instance
     */
    public static function newBuilding(int $id, int $position, int $level): Building
    {
        switch ($id) {
            case BuildingEnums::WOODCUTTER:
                return new Woodcutter($id, $position, $level, B1, B1_DESC, [40, 100, 50, 60], 1, [1780 / 3, 1.6, 1000 / 3], 1.67, 2, self::getBuildingBonus($id), 20, []);
            case BuildingEnums::CLAY_PIT:
                return new ClayPit($id, $position, $level, B2, B2_DESC, [80, 40, 80, 50], 1, [1660 / 3, 1.6, 1000 / 3], 1.67, 2, self::getBuildingBonus($id), 20, []);
            case BuildingEnums::CROPLAND:
                return new Cropland($id, $position, $level, B3, B3_DESC, [70, 90, 70, 20], 1, [1450 / 3, 1.6, 1000 / 3], 1.67, 3, self::getBuildingBonus($id), 20, []);
            case BuildingEnums::IRON_MINE:
                return new IronMine($id, $position, $level, B4, B4_DESC, [100, 80, 30, 60], 1, [2350 / 3,1.6, 1000 / 3], 1.67, 0, self::getBuildingBonus($id), 20, []);
            case BuildingEnums::SAWMILL:
                return new Sawmill($id, $position, $level, SAWMILL, SAWMILL_DESC, [520, 380, 290, 90], 1, [5400, 1.5, 2400], 1.80, 4, self::getBuildingBonus($id), 5, [BuildingEnums::WOODCUTTER => 10, BuildingEnums::MAIN_BUILDING => 5]);
            case BuildingEnums::BRICKYARD:
                return new Brickyard($id, $position, $level, BRICKYARD, BRICKYARD_DESC, [440, 480, 320, 50], 1, [5240, 1.5, 2400], 1.80, 3, self::getBuildingBonus($id), 5, [BuildingEnums::CLAY_PIT => 10, BuildingEnums::MAIN_BUILDING => 5]);
            case BuildingEnums::IRON_FOUNDRY:
                return new IronFoundry($id, $position, $level, IRONFOUNDRY, IRONFOUNDRY_DESC, [200, 450, 510, 120], 1, [6480, 1.5, 2400], 1.80, 6, self::getBuildingBonus($id), 5, [BuildingEnums::IRON_MINE => 10, BuildingEnums::MAIN_BUILDING => 5]);
            case BuildingEnums::GRAIN_MILL:
                return new GrainMill($id, $position, $level, GRAINMILL, GRAINMILL_DESC, [500, 440, 380, 1240], 1, [4240, 1.5, 2400], 1.80, 3, self::getBuildingBonus($id), 5, [BuildingEnums::CROPLAND => 5, BuildingEnums::MAIN_BUILDING => 5]);
            case BuildingEnums::BAKERY:
                return new Bakery($id, $position, $level, BAKERY, BAKERY_DESC, [1200, 1480, 870, 1600], 1, [6080, 1.5, 2400], 1.80, 4, self::getBuildingBonus($id), 5, [BuildingEnums::CROPLAND => 10, BuildingEnums::BAKERY => 5, BuildingEnums::MAIN_BUILDING => 5]);
            case BuildingEnums::WAREHOUSE:
                return new Warehouse($id, $position, $level, WAREHOUSE, WAREHOUSE_DESC, [130, 160, 90, 40], 1, [3875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 1]);
            case BuildingEnums::GRANARY:
                return new Granary($id, $position, $level, GRANARY, GRANARY_DESC, [80, 100, 70, 20], 1, [3475, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 1]);
            case BuildingEnums::ARMOURY:
                return new Armoury($id, $position, $level, ARMOURY, ARMOURY_DESC, [170, 200, 380, 130], 2, [3875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 3, BuildingEnums::ACADEMY => 1]);
            case BuildingEnums::BLACKSMITH:
                return new Blacksmith($id, $position, $level, BLACKSMITH, BLACKSMITH_DESC, [130, 210, 410, 130], 2, [3875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 3, BuildingEnums::ACADEMY => 3]);
            case BuildingEnums::TOURNAMENT_SQUARE:
                return new TournamentSquare($id, $position, $level, TOURNAMENTSQUARE, TOURNAMENTSQUARE_DESC, [1750, 2250, 1530, 240], 1, [5375, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::RALLY_POINT => 15]);
            case BuildingEnums::MAIN_BUILDING:
                return new MainBuilding($id, $position, $level, MAINBUILDING, MAINBUILDING_DESC, [70, 40, 60, 20], 2, [3875, 1.16, 1875], 1.28, 2, self::getBuildingBonus($id), 20, []);
            case BuildingEnums::RALLY_POINT:
                return new RallyPoint($id, $position, $level, RALLYPOINT, RALLYPOINT_DESC, [110, 160, 90, 70], 1, [3875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, []);
            case BuildingEnums::MARKETPLACE:
                return new Marketplace($id, $position, $level, MARKETPLACE, MARKETPLACE_DESC, [80, 70, 120, 70], 4, [3675, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::WAREHOUSE => 1, BuildingEnums::GRANARY => 1, BuildingEnums::MAIN_BUILDING => 3]);
            case BuildingEnums::EMBASSY:
                return new Embassy($id, $position, $level, EMBASSY, EMBASSY_DESC, [180, 130, 150, 80], 5, [3875, 1.16, 1875], 1.28, 3, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 1]);
            case BuildingEnums::BARRACKS:
                return new Barracks($id, $position, $level, BARRACKS, BARRACKS_DESC, [210, 140, 260, 120], 1, [3875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 3, BuildingEnums::RALLY_POINT => 1], UnitEnums::INFANTRY, 0);
            case BuildingEnums::STABLE:
                return new Stable($id, $position, $level, STABLE, STABLE_DESC, [260, 140, 220, 100], 2, [4075, 1.16, 1875], 1.28, 5, self::getBuildingBonus($id), 20, [BuildingEnums::ARMOURY => 3, BuildingEnums::ACADEMY => 5], UnitEnums::CAVALRY, 0);
            case BuildingEnums::WORKSHOP:
                return new Workshop($id, $position, $level, WORKSHOP, WORKSHOP_DESC, [460, 510, 600, 320], 4, [4875, 1.16, 1875], 1.28, 3, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 5, BuildingEnums::ACADEMY => 10], UnitEnums::SIEGE, 0);
            case BuildingEnums::ACADEMY:
                return new Academy($id, $position, $level, ACADEMY, ACADEMY_DESC, [220, 160, 90, 40], 5, [3875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 3, BuildingEnums::BARRACKS => 3]);
            case BuildingEnums::CRANNY:
                return new Cranny($id, $position, $level, CRANNY, CRANNY_DESC, [40, 50, 30, 10], 1, [2625, 1.16, 1875], 1.28, 0, self::getBuildingBonus($id), 10, []);
            case BuildingEnums::TOWN_HALL:
                return new TownHall($id, $position, $level, TOWNHALL, TOWNHALL_DESC, [1250, 1110, 1260, 600], 6, [14375, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 10, BuildingEnums::ACADEMY => 10]);
            case BuildingEnums::RESIDENCE:
                return new Residence($id, $position, $level, RESIDENCE, RESIDENCE_DESC, [580, 460, 350, 180], 2, [3875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 5, BuildingEnums::PALACE => -1], UnitEnums::COLONIZERS, 0);
            case BuildingEnums::PALACE:
                return new Palace($id, $position, $level, PALACE, PALACE_DESC, [550, 800, 750, 250], 6, [6875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 5, BuildingEnums::EMBASSY => 1, BuildingEnums::RESIDENCE => 0, 'natar' => 0], UnitEnums::COLONIZERS, 0);
            case BuildingEnums::TREASURY:
                return new Treasury($id, $position, $level, TREASURY, TREASURY_DESC, [2880, 2740, 2580, 990], 7, [9875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 10, BuildingEnums::WONDER_OF_THE_WORLD => -1]);
            case BuildingEnums::TRADE_OFFICE:
                return new TradeOffice($id, $position, $level, TRADEOFFICE, TRADEOFFICE_DESC, [1400, 1330, 1200, 400], 4, [4875, 1.16, 1875], 1.28, 3, self::getBuildingBonus($id), 20, [BuildingEnums::MARKETPLACE => 20, BuildingEnums::STABLE => 10]);
            case BuildingEnums::GREAT_BARRACKS:
                return new GreatBarracks($id, $position, $level, GREATBARRACKS, GREATBARRACKS_DESC, [630, 420, 780, 360], 1, [3875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::BARRACKS => 20, 'capital' => 0], UnitEnums::INFANTRY, 1);
            case BuildingEnums::GREAT_STABLE:
                return new GreatStable($id, $position, $level, GREATSTABLE, GREATSTABLE_DESC, [780, 420, 660, 300], 2, [4075, 1.16, 1875], 1.28, 5, self::getBuildingBonus($id), 20, [BuildingEnums::STABLE => 20, 'capital' => 0], UnitEnums::CAVALRY, 1);
            case BuildingEnums::CITY_WALL:
                return new CityWall($id, $position, $level, CITYWALL, CITYWALL_DESC, [70, 90, 170, 70], 1, [3875, 1.16, 1875], 1.28, 0, self::getBuildingBonus($id), 20, ['tribe' => 1]);
            case BuildingEnums::EARTH_WALL:
                return new EarthWall($id, $position, $level, EARTHWALL, EARTHWALL_DESC, [120, 200, 0, 80], 1, [3875, 1.16, 1875], 1.28, 0, self::getBuildingBonus($id), 20, ['tribe' => 2]);
            case BuildingEnums::PALISADE:
                return new Palisade($id, $position, $level, PALISADE, PALISADE_DESC, [160, 100, 80, 60], 1, [3875, 1.16, 1875], 1.28, 0, self::getBuildingBonus($id), 20, ['tribe' => 3]);
            case BuildingEnums::STONEMASON_LODGE:
                return new StonemasonLodge($id, $position, $level, STONEMASON, STONEMASON_DESC, [155, 130, 125, 70], 1, [4075, 1.16, 1875], 1.28, 2, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 5, BuildingEnums::PALACE => 3, 'capital' => 1]);
            case BuildingEnums::BREWERY:
                return new Brewery($id, $position, $level, BREWERY, BREWERY_DESC, [1460, 930, 1250, 1740], 5, [9875, 1.16, 1875], 1.28, 6, self::getBuildingBonus($id), 10, [BuildingEnums::GRANARY => 20, BuildingEnums::RALLY_POINT => 10, 'tribe' => 2]);
            case BuildingEnums::TRAPPER:
                return new Trapper($id, $position, $level, TRAPPER, TRAPPER_DESC, [80, 120, 70, 90], 1, [3875, 1.16, 1875], 1.28, 4, self::getBuildingBonus($id), 20, [BuildingEnums::RALLY_POINT => 1, 'tribe' => 3], UnitEnums::TRAP, 0);
            case BuildingEnums::HERO_MANSION:
                return new HeroMansion($id, $position, $level, HEROSMANSION, HEROSMANSION_DESC, [700, 670, 700, 240], 1, [4175, 1.16, 1875], 1.28, 2, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 3, BuildingEnums::RALLY_POINT => 1]);
            case BuildingEnums::GREAT_WAREHOUSE:
                return new GreatWarehouse($id, $position, $level, GREATWAREHOUSE, GREATWAREHOUSE_DESC, [650, 800, 450, 200], 1, [10875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 10, 'artifact' => 1]);
            case BuildingEnums::GREAT_GRANARY:
                return new GreatGranary($id, $position, $level, GREATGRANARY, GREATGRANARY_DESC, [400, 500, 350, 100], 1, [8875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 20, [BuildingEnums::MAIN_BUILDING => 10, 'artifact' => 1]);
            case BuildingEnums::WONDER_OF_THE_WORLD:
                return new WonderOfTheWorld($id, $position, $level, WONDER, WONDER_DESC, [66700, 69050, 72200, 13200], 0, [19875, 1.16, 1875], 1.28, 1, self::getBuildingBonus($id), 100, ['buildingPlan1' => 1]);
            case BuildingEnums::HORSE_DRINKING_TROUGH:
                return new HorseDrinkingTrough($id, $position, $level, HORSEDRINKING, HORSEDRINKING_DESC, [780, 420, 660, 540], 4, [4075, 1.16, 1875], 1.28, 5, self::getBuildingBonus($id), 20, [BuildingEnums::RALLY_POINT => 10, 20 => 20, 'tribe' => 1]);
            case BuildingEnums::GREAT_WORKSHOP:
                return new GreatWorkshop($id, $position, $level, GREATWORKSHOP, GREATWORKSHOP_DESC, [460, 510, 600, 320], 4, [4875, 1.16, 1875], 1.28, 3, self::getBuildingBonus($id), 20, [BuildingEnums::WORKSHOP => 20, 'capital' => 0], UnitEnums::SIEGE, 1);
            default:
                return new EmptyCell(0, $position, $level, BUILDING_SITE, '', [0, 0, 0, 0], 0, [0, 0, 0], 0, 0, [], 0, []);
        }
    }

    /**
     * Get a buildings bonus
     * 
     * @param int $id The building ID
     * @return array Returns the building bonus
     */
    private static function getBuildingBonus(int $id): array
    {
        switch ($id) {
            case BuildingEnums::WOODCUTTER:
            case BuildingEnums::CLAY_PIT:
            case BuildingEnums::CROPLAND:
            case BuildingEnums::IRON_MINE:
                return [2, 5, 9, 15, 22, 33, 50, 70, 100, 145, 200, 280, 375, 495, 635, 800, 1000, 1300, 1600, 2000, 2450];
            case BuildingEnums::SAWMILL:
            case BuildingEnums::BRICKYARD:
            case BuildingEnums::IRON_FOUNDRY:
            case BuildingEnums::GRAIN_MILL:
            case BuildingEnums::BAKERY:
                return array_combine(range(0, 5), range(0, 25, 5));
            case BuildingEnums::WAREHOUSE:
            case BuildingEnums::GRANARY:
                return [0, 1200, 1700, 2300, 3100, 4000, 5000, 6300, 7800, 9600, 11800, 14400, 17600, 21400, 25900, 31300, 37900, 45700, 55100, 66400, 80000];
            case BuildingEnums::TOURNAMENT_SQUARE:
            case BuildingEnums::TRADE_OFFICE:
            case BuildingEnums::STONEMASON_LODGE:;
                return array_combine(range(0, 20), range(100, 300, 10));
            case BuildingEnums::RALLY_POINT:
                return [
                1 => [],
                3 => [
                		2 => 
                		[
                				BuildingEnums::WAREHOUSE, 
                		    	BuildingEnums::GRANARY
						]
                	],
                5 => [
                        0 => 
                        [
                        		BuildingEnums::WOODCUTTER,
                        		BuildingEnums::CLAY_PIT, 
                        		BuildingEnums::IRON_MINE,
                        		BuildingEnums::CROPLAND,
                        		BuildingEnums::SAWMILL,
                        		BuildingEnums::BRICKYARD,
                        		BuildingEnums::IRON_FOUNDRY,
                        		BuildingEnums::GRAIN_MILL,
                        		BuildingEnums::BAKERY
                        ]
                ],
                10 => [
                		1 => 
                		[
                				BuildingEnums::ACADEMY, 
                				BuildingEnums::BARRACKS,
                				BuildingEnums::STABLE,
                				BuildingEnums::WORKSHOP,
                				BuildingEnums::ARMOURY,
                				BuildingEnums::BLACKSMITH,
                				BuildingEnums::RALLY_POINT,
                				BuildingEnums::GREAT_BARRACKS,
                				BuildingEnums::GREAT_STABLE,
                				BuildingEnums::GREAT_WORKSHOP,
                				BuildingEnums::HERO_MANSION,
                				BuildingEnums::TOURNAMENT_SQUARE
                		],

                		2 => 
                		[
                				2 => BuildingEnums::BREWERY,
                		        BuildingEnums::EMBASSY,
                		 		BuildingEnums::HORSE_DRINKING_TROUGH,
                				BuildingEnums::MAIN_BUILDING,
                				BuildingEnums::MARKETPLACE,
                				BuildingEnums::PALACE,
                				BuildingEnums::RESIDENCE,
                				BuildingEnums::TOWN_HALL,
                				BuildingEnums::TRADE_OFFICE,
                				BuildingEnums::TREASURY,
                				BuildingEnums::WONDER_OF_THE_WORLD
                		]
                ]
                ];
            case BuildingEnums::MARKETPLACE:
                return array_combine(range(0, 20), range(0, 20));
            case BuildingEnums::EMBASSY:
                return array_combine(range(0, 20), range(0, 60, 3));
            case BuildingEnums::CRANNY:
                return [0, 100, 130, 170, 220, 280, 360, 460, 600, 770, 1000];
            case BuildingEnums::TREASURY:
                return [10 => 1, 20 => 2];
            case BuildingEnums::BREWERY:
                return array_combine(range(0, 10), range(0, 10, 1));
            case BuildingEnums::TRAPPER:
                return [0, 10, 22, 35, 49, 64, 80, 97, 115, 134, 154, 175, 196, 218, 241, 265, 290, 316, 343, 371, 400];
            case BuildingEnums::HERO_MANSION:
                return [10 => 1, 15 => 2, 20 => 3];
            case BuildingEnums::GREAT_WAREHOUSE:
            case BuildingEnums::GREAT_GRANARY:
                return [0, 3600, 5100, 6900, 9300, 12000, 15000, 18900, 23400, 28800, 35400, 43200, 52800, 64200, 77700, 93900, 133700, 137100, 165300, 199200, 240000];
            case BuildingEnums::HORSE_DRINKING_TROUGH:
                return [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 14, 15, 16, 18, 19, 20, 22, 23, 25];
            default:
                return [];
        }
    }
}