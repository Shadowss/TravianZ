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

namespace TravianZ\Enums;

/**
 * @author iopietro
 */
abstract class BuildingEnums
{
    // Buildings

    const EMPTY = 0;
    
    const WOODCUTTER = 1;

    const CLAY_PIT = 2;
    
    const CROPLAND = 3;

    const IRON_MINE = 4;

    const SAWMILL = 5;

    const BRICKYARD = 6;
    
    const IRON_FOUNDRY = 7;
   
    const GRAIN_MILL = 8;
    
    const BAKERY = 9;
    
    const WAREHOUSE = 10;
    
    const GRANARY = 11;
    
    const ARMOURY = 12;
    
    const BLACKSMITH = 13;
    
    const TOURNAMENT_SQUARE = 14;
    
    const MAIN_BUILDING = 15;
    
    const RALLY_POINT = 16;
    
    const MARKETPLACE = 17;
    
    const EMBASSY = 18;
    
    const BARRACKS = 19;
    
    const STABLE = 20;
    
    const WORKSHOP = 21;
    
    const ACADEMY = 22;
    
    const CRANNY = 23;
    
    const TOWN_HALL = 24;
    
    const RESIDENCE = 25;
    
    const PALACE = 26;
    
    const TREASURY = 27;
    
    const TRADE_OFFICE = 28;
    
    const GREAT_BARRACKS = 29;
    
    const GREAT_STABLE = 30;
    
    const CITY_WALL = 31;
    
    const EARTH_WALL = 32;
    
    const PALISADE = 33;
    
    const STONEMASON_LODGE = 34;
    
    const BREWERY = 35;
    
    const TRAPPER = 36;
    
    const HERO_MANSION = 37;
    
    const GREAT_WAREHOUSE = 38;
    
    const GREAT_GRANARY = 39;
    
    const WONDER_OF_THE_WORLD = 40;
    
    const HORSE_DRINKING_TROUGH = 41;
    
    const GREAT_WORKSHOP = 42;
    
    // Errors

    const CANNOT_BE_BUILT = 0;
    
    const MAX_LEVEL_REACHED = 1;
    
    const WORKERS_ALREADY_WORK = 2;

    const WORKERS_ALREADY_WORK_WAITING_LOOP = 3;
    
    const NOT_ENOUGH_FOOD = 4;
    
    const UPGRADE_WAREHOUSE = 5;

    const UPGRADE_GRANARY = 6;
    
    const NOT_ENOUGH_RESOURCES = 7;
    
    const CAN_BE_BUILT = 8;
    
    const CAN_BE_BUILT_WAITING_LOOP = 9;
    
    const MAX_LEVEL_UNDER_CONSTRUCTION = 10;
    
    const BEING_DEMOLISHED = 11;
    
    const NEED_WW_BUILDING_PLAN = 12;
    
    const NEED_MORE_WW_BUILDING_PLANS = 13;
}