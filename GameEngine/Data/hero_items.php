<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : hero_items.php                                            ##
##  Type           : Static Data / Catalog for T4 Hero port                    ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################
##                                                                             ##
##  SINGLE SOURCE OF TRUTH for the T4 hero port (Phase 2 - full catalog,       ##
##  built from the design spreadsheet "Obiecte_Erou_Travian.xlsx").            ##
##  Pure data + guarded constants, no side effects - safe to include anywhere. ##
##                                                                             ##
##  Display names are stored as English strings in the catalog. For future     ##
##  localisation, heroItemName() checks for a HERO_ITEM_<id> lang constant     ##
##  first and falls back to the English catalog name.                          ##
##                                                                             ##
#################################################################################

/* ============================================================================
 *  GAME CONSTANTS (unchanged from Phase 1; guarded against re-includes)
 *  movement.sort_type in use: 0,2,3,4,5,6,10,11,12,13 -> 20/21 free
 *  attacks.attack_type in use: 1,2                     -> 9 free
 *  ndata.ntype mapped up to 25 (settlers)              -> 26 free
 * ------------------------------------------------------------------------- */
if (!defined('MOVEMENT_ADVENTURE_OUT'))  define('MOVEMENT_ADVENTURE_OUT',  20);
if (!defined('MOVEMENT_ADVENTURE_BACK')) define('MOVEMENT_ADVENTURE_BACK', 21);
if (!defined('ATTACK_TYPE_ADVENTURE'))   define('ATTACK_TYPE_ADVENTURE',    9);
if (!defined('NTYPE_ADVENTURE_REPORT'))  define('NTYPE_ADVENTURE_REPORT',  26);
if (!defined('NTYPE_AUCTION_REPORT'))    define('NTYPE_AUCTION_REPORT',    27);

/* Equipment slots */
if (!defined('HSLOT_HELMET')) define('HSLOT_HELMET', 1);
if (!defined('HSLOT_BODY'))   define('HSLOT_BODY',   2);
if (!defined('HSLOT_RIGHT'))  define('HSLOT_RIGHT',  3); // weapon
if (!defined('HSLOT_LEFT'))   define('HSLOT_LEFT',   4); // shield/horn/sack/map/pennant/standard
if (!defined('HSLOT_SHOES'))  define('HSLOT_SHOES',  5); // boots + spurs
if (!defined('HSLOT_HORSE'))  define('HSLOT_HORSE',  6);
if (!defined('HSLOT_BAG'))    define('HSLOT_BAG',    7); // stackable consumables

/* ============================================================================
 *  BONUS TYPES (keys inside $item['bonus'])
 *  Flat vs percent is documented per constant. Consumers: HeroItems::getBonuses()
 *  (Phase 2), Battle/Automation/a2b integration (Phase 5).
 * ------------------------------------------------------------------------- */
if (!defined('HB_FIGHT'))          define('HB_FIGHT',          'fight_strength');   // flat hero fighting strength
if (!defined('HB_UNIT_BONUS'))     define('HB_UNIT_BONUS',     'unit_bonus');       // ['unit'=>uX,'per_unit'=>N] +N off & +N def per unit of that type in the hero's army
if (!defined('HB_VS_NATARS'))      define('HB_VS_NATARS',      'vs_natars');        // +% hero strength vs Natars
if (!defined('HB_RAID'))           define('HB_RAID',           'raid_percent');     // +% resources stolen on raids
if (!defined('HB_RETURN_SPEED'))   define('HB_RETURN_SPEED',   'return_speed');     // +% troop return speed
if (!defined('HB_SPEED_OWN'))      define('HB_SPEED_OWN',      'speed_own');        // +% speed between own villages
if (!defined('HB_SPEED_ALLY'))     define('HB_SPEED_ALLY',     'speed_ally');       // +% speed between ally villages
if (!defined('HB_XP'))             define('HB_XP',             'xp_percent');       // +% hero experience
if (!defined('HB_REGEN_HP'))       define('HB_REGEN_HP',       'regen_hp');         // flat +HP per day
if (!defined('HB_CP'))             define('HB_CP',             'culture_points');   // flat +culture points per day
if (!defined('HB_TRAIN_CAV'))      define('HB_TRAIN_CAV',      'train_cavalry');    // -% cavalry training time
if (!defined('HB_TRAIN_INF'))      define('HB_TRAIN_INF',      'train_infantry');   // -% infantry training time
if (!defined('HB_DMG_REDUCE'))     define('HB_DMG_REDUCE',     'damage_reduce');    // flat damage reduction per hit
if (!defined('HB_TROOP_SPEED_20')) define('HB_TROOP_SPEED_20', 'troop_speed_20');   // +% troop speed beyond 20 tiles
if (!defined('HB_MOUNT_SPEED'))    define('HB_MOUNT_SPEED',    'mount_speed');      // flat +fields/hour, ONLY while a horse is equipped (spurs)
if (!defined('HB_HORSE_SPEED'))    define('HB_HORSE_SPEED',    'horse_speed');      // flat hero speed in fields/hour (horse)
/* consumables */
if (!defined('HB_HEAL_SELF'))      define('HB_HEAL_SELF',      'heal_self');        // +1% hero HP per unit (max 99%, hero must be alive)
if (!defined('HB_SCROLL'))         define('HB_SCROLL',         'scroll_xp');        // +XP per scroll
if (!defined('HB_BUCKET'))         define('HB_BUCKET',         'bucket');           // instant free revive
if (!defined('HB_LOYALTY'))        define('HB_LOYALTY',        'loyalty');          // +1% own village loyalty per tablet (max 125%)
if (!defined('HB_RESET'))          define('HB_RESET',          'reset_points');     // reset attribute points
if (!defined('HB_ARTWORK'))        define('HB_ARTWORK',        'artwork_cp');       // CP = daily production (cap: 5000 normal / 2500 speed)
if (!defined('HB_HEAL_TROOP'))     define('HB_HEAL_TROOP',     'heal_troops');      // heals % of the hero's army (bandages)
if (!defined('HB_CAGE'))           define('HB_CAGE',           'cage');             // traps 1 oasis animal per cage

/* ============================================================================
 *  ITEM CATALOG
 *  itemid => [
 *      'name'  => English display name,
 *      'slot'  => HSLOT_*,
 *      'tier'  => 1..3,
 *      'bonus' => [HB_* => value, ...],
 *      'unit'  => uX      (weapons only: hero must BE this unit to equip),
 *      'x2_on_speed' => true (value doubles on speed servers, per design sheet:
 *                       "+3 (1x) / +6 (3x)" - runtime multiplies by 2 when SPEED >= 3),
 *      'requires_horse' => true (spurs: bonus only counts with a horse equipped)
 *  ]
 *
 *  ID ranges: 1-15 helmets | 20-31 body | 40-57 left hand | 60-68 shoes
 *             70-72 horses | 101-145 weapons | 200-208 consumables
 * ------------------------------------------------------------------------- */
$heroItemCatalog = array(

    /* ---------------- HELMETS (sheet: Coifuri) ---------------- */
    1  => array('name' => 'Helmet of Awareness',      'slot' => HSLOT_HELMET, 'tier' => 1, 'bonus' => array(HB_XP => 15)),
    2  => array('name' => 'Helmet of Enlightenment',  'slot' => HSLOT_HELMET, 'tier' => 2, 'bonus' => array(HB_XP => 20)),
    3  => array('name' => 'Helmet of Wisdom',         'slot' => HSLOT_HELMET, 'tier' => 3, 'bonus' => array(HB_XP => 25)),
    4  => array('name' => 'Helmet of Regeneration',   'slot' => HSLOT_HELMET, 'tier' => 1, 'bonus' => array(HB_REGEN_HP => 10)),
    5  => array('name' => 'Helmet of Health',         'slot' => HSLOT_HELMET, 'tier' => 2, 'bonus' => array(HB_REGEN_HP => 15)),
    6  => array('name' => 'Helmet of Healing',        'slot' => HSLOT_HELMET, 'tier' => 3, 'bonus' => array(HB_REGEN_HP => 20)),
    7  => array('name' => 'Helmet of the Gladiator',  'slot' => HSLOT_HELMET, 'tier' => 1, 'bonus' => array(HB_CP => 100), 'x2_on_speed' => false), // sheet: 100/day (1x), 50 (3x) -> HALVED on speed; handled below
    8  => array('name' => 'Helmet of the Tribune',    'slot' => HSLOT_HELMET, 'tier' => 2, 'bonus' => array(HB_CP => 400), 'x2_on_speed' => false),
    9  => array('name' => 'Helmet of the Consul',     'slot' => HSLOT_HELMET, 'tier' => 3, 'bonus' => array(HB_CP => 800), 'x2_on_speed' => false),
    10 => array('name' => 'Helmet of the Horseman',       'slot' => HSLOT_HELMET, 'tier' => 1, 'bonus' => array(HB_TRAIN_CAV => 10)),
    11 => array('name' => 'Helmet of the Cavalry',        'slot' => HSLOT_HELMET, 'tier' => 2, 'bonus' => array(HB_TRAIN_CAV => 15)),
    12 => array('name' => 'Helmet of the Heavy Cavalry',  'slot' => HSLOT_HELMET, 'tier' => 3, 'bonus' => array(HB_TRAIN_CAV => 20)),
    13 => array('name' => 'Helmet of the Mercenary',  'slot' => HSLOT_HELMET, 'tier' => 1, 'bonus' => array(HB_TRAIN_INF => 10)),
    14 => array('name' => 'Helmet of the Warrior',    'slot' => HSLOT_HELMET, 'tier' => 2, 'bonus' => array(HB_TRAIN_INF => 15)),
    15 => array('name' => 'Helmet of the Ruler',      'slot' => HSLOT_HELMET, 'tier' => 3, 'bonus' => array(HB_TRAIN_INF => 20)),

    /* ---------------- BODY ARMOUR (sheet: Armuri) ---------------- */
    20 => array('name' => 'Light Breastplate of Regeneration', 'slot' => HSLOT_BODY, 'tier' => 1, 'bonus' => array(HB_REGEN_HP => 20)),
    21 => array('name' => 'Breastplate of Regeneration',       'slot' => HSLOT_BODY, 'tier' => 2, 'bonus' => array(HB_REGEN_HP => 30)),
    22 => array('name' => 'Heavy Breastplate of Regeneration', 'slot' => HSLOT_BODY, 'tier' => 3, 'bonus' => array(HB_REGEN_HP => 40)),
    23 => array('name' => 'Light Armor', 'slot' => HSLOT_BODY, 'tier' => 1, 'bonus' => array(HB_DMG_REDUCE => 4, HB_REGEN_HP => 10)),
    24 => array('name' => 'Armor',       'slot' => HSLOT_BODY, 'tier' => 2, 'bonus' => array(HB_DMG_REDUCE => 6, HB_REGEN_HP => 15)),
    25 => array('name' => 'Heavy Armor', 'slot' => HSLOT_BODY, 'tier' => 3, 'bonus' => array(HB_DMG_REDUCE => 8, HB_REGEN_HP => 20)),
    26 => array('name' => 'Light Cuirass', 'slot' => HSLOT_BODY, 'tier' => 1, 'bonus' => array(HB_FIGHT => 500)),
    27 => array('name' => 'Cuirass',       'slot' => HSLOT_BODY, 'tier' => 2, 'bonus' => array(HB_FIGHT => 1000)),
    28 => array('name' => 'Heavy Cuirass', 'slot' => HSLOT_BODY, 'tier' => 3, 'bonus' => array(HB_FIGHT => 1500)),
    29 => array('name' => 'Light Segmented Armor', 'slot' => HSLOT_BODY, 'tier' => 1, 'bonus' => array(HB_DMG_REDUCE => 3, HB_FIGHT => 250)),
    30 => array('name' => 'Segmented Armor',       'slot' => HSLOT_BODY, 'tier' => 2, 'bonus' => array(HB_DMG_REDUCE => 4, HB_FIGHT => 500)),
    31 => array('name' => 'Heavy Segmented Armor', 'slot' => HSLOT_BODY, 'tier' => 3, 'bonus' => array(HB_DMG_REDUCE => 5, HB_FIGHT => 750)),

    /* ---------------- LEFT HAND (sheets: Mana_Stanga + Diverse) ---------------- */
    40 => array('name' => 'Small Shield', 'slot' => HSLOT_LEFT, 'tier' => 1, 'bonus' => array(HB_FIGHT => 500)),
    41 => array('name' => 'Shield',       'slot' => HSLOT_LEFT, 'tier' => 2, 'bonus' => array(HB_FIGHT => 1000)),
    42 => array('name' => 'Great Shield', 'slot' => HSLOT_LEFT, 'tier' => 3, 'bonus' => array(HB_FIGHT => 1500)),
    43 => array('name' => 'Small Hunting Horn', 'slot' => HSLOT_LEFT, 'tier' => 1, 'bonus' => array(HB_VS_NATARS => 20)),
    44 => array('name' => 'Hunting Horn',       'slot' => HSLOT_LEFT, 'tier' => 2, 'bonus' => array(HB_VS_NATARS => 25)),
    45 => array('name' => 'Great Hunting Horn', 'slot' => HSLOT_LEFT, 'tier' => 3, 'bonus' => array(HB_VS_NATARS => 30)),
    46 => array('name' => "Thief's Satchel", 'slot' => HSLOT_LEFT, 'tier' => 1, 'bonus' => array(HB_RAID => 10)),
    47 => array('name' => "Thief's Bag",     'slot' => HSLOT_LEFT, 'tier' => 2, 'bonus' => array(HB_RAID => 15)),
    48 => array('name' => "Thief's Sack",    'slot' => HSLOT_LEFT, 'tier' => 3, 'bonus' => array(HB_RAID => 20)),
    49 => array('name' => 'Small Map', 'slot' => HSLOT_LEFT, 'tier' => 1, 'bonus' => array(HB_RETURN_SPEED => 30)),
    50 => array('name' => 'Map',       'slot' => HSLOT_LEFT, 'tier' => 2, 'bonus' => array(HB_RETURN_SPEED => 40)),
    51 => array('name' => 'Great Map', 'slot' => HSLOT_LEFT, 'tier' => 3, 'bonus' => array(HB_RETURN_SPEED => 50)),
    52 => array('name' => 'Small Pennant', 'slot' => HSLOT_LEFT, 'tier' => 1, 'bonus' => array(HB_SPEED_OWN => 30)),
    53 => array('name' => 'Pennant',       'slot' => HSLOT_LEFT, 'tier' => 2, 'bonus' => array(HB_SPEED_OWN => 40)),
    54 => array('name' => 'Great Pennant', 'slot' => HSLOT_LEFT, 'tier' => 3, 'bonus' => array(HB_SPEED_OWN => 50)),
    55 => array('name' => 'Small Standard', 'slot' => HSLOT_LEFT, 'tier' => 1, 'bonus' => array(HB_SPEED_ALLY => 15)),
    56 => array('name' => 'Standard',       'slot' => HSLOT_LEFT, 'tier' => 2, 'bonus' => array(HB_SPEED_ALLY => 20)),
    57 => array('name' => 'Great Standard', 'slot' => HSLOT_LEFT, 'tier' => 3, 'bonus' => array(HB_SPEED_ALLY => 25)),

    /* ---------------- SHOES (sheet: Incaltaminte_Cai - boots + spurs) ---------------- */
    60 => array('name' => 'Boots of Regeneration', 'slot' => HSLOT_SHOES, 'tier' => 1, 'bonus' => array(HB_REGEN_HP => 10)),
    61 => array('name' => 'Boots of Recovery',     'slot' => HSLOT_SHOES, 'tier' => 2, 'bonus' => array(HB_REGEN_HP => 15)),
    62 => array('name' => 'Boots of Healing',      'slot' => HSLOT_SHOES, 'tier' => 3, 'bonus' => array(HB_REGEN_HP => 20)),
    63 => array('name' => 'Boots of the Mercenary', 'slot' => HSLOT_SHOES, 'tier' => 1, 'bonus' => array(HB_TROOP_SPEED_20 => 25)),
    64 => array('name' => 'Boots of the Warrior',   'slot' => HSLOT_SHOES, 'tier' => 2, 'bonus' => array(HB_TROOP_SPEED_20 => 50)),
    65 => array('name' => 'Boots of the Ruler',     'slot' => HSLOT_SHOES, 'tier' => 3, 'bonus' => array(HB_TROOP_SPEED_20 => 75)),
    // Spurs share the shoes slot (worn on boots) and only apply while a horse is equipped.
    // Design sheet: "+3 f/h (1x) / +6 (3x)" -> base value is the 1x one, doubled on speed servers.
    66 => array('name' => 'Small Spurs', 'slot' => HSLOT_SHOES, 'tier' => 1, 'bonus' => array(HB_MOUNT_SPEED => 3), 'x2_on_speed' => true, 'requires_horse' => true),
    67 => array('name' => 'Spurs',       'slot' => HSLOT_SHOES, 'tier' => 2, 'bonus' => array(HB_MOUNT_SPEED => 4), 'x2_on_speed' => true, 'requires_horse' => true),
    68 => array('name' => 'Great Spurs', 'slot' => HSLOT_SHOES, 'tier' => 3, 'bonus' => array(HB_MOUNT_SPEED => 5), 'x2_on_speed' => true, 'requires_horse' => true),

    /* ---------------- HORSES (sheet: Incaltaminte_Cai) ---------------- */
    70 => array('name' => 'Riding Horse', 'slot' => HSLOT_HORSE, 'tier' => 1, 'bonus' => array(HB_HORSE_SPEED => 14), 'x2_on_speed' => true),
    71 => array('name' => 'Thoroughbred', 'slot' => HSLOT_HORSE, 'tier' => 2, 'bonus' => array(HB_HORSE_SPEED => 17), 'x2_on_speed' => true),
    72 => array('name' => 'Warhorse',     'slot' => HSLOT_HORSE, 'tier' => 3, 'bonus' => array(HB_HORSE_SPEED => 20), 'x2_on_speed' => true),

    /* ---------------- WEAPONS (sheets: Romani / Barbari / Daci) ----------------
     * Weapons are unit-bound: the hero must be trained from that unit.
     * Each gives flat fight strength (500/1000/1500 by tier) plus
     * +N off AND +N def per unit of that type accompanying the hero. */

    // Romans - u1 Legionnaire
    101 => array('name' => "Legionnaire's Short Sword", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 1, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 1, 'per_unit' => 3))),
    102 => array('name' => "Legionnaire's Sword",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 1, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 1, 'per_unit' => 4))),
    103 => array('name' => "Legionnaire's Long Sword",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 1, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 1, 'per_unit' => 5))),
    // Romans - u2 Praetorian
    104 => array('name' => "Praetorian's Short Sword", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 2, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 2, 'per_unit' => 3))),
    105 => array('name' => "Praetorian's Sword",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 2, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 2, 'per_unit' => 4))),
    106 => array('name' => "Praetorian's Long Sword",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 2, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 2, 'per_unit' => 5))),
    // Romans - u3 Imperian
    107 => array('name' => "Imperian's Short Sword", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 3, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 3, 'per_unit' => 3))),
    108 => array('name' => "Imperian's Sword",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 3, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 3, 'per_unit' => 4))),
    109 => array('name' => "Imperian's Long Sword",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 3, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 3, 'per_unit' => 5))),
    // Romans - u5 Equites Imperatoris
    110 => array('name' => "Imperatoris' Short Saber", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 5, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 5, 'per_unit' => 9))),
    111 => array('name' => "Imperatoris' Saber",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 5, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 5, 'per_unit' => 12))),
    112 => array('name' => "Imperatoris' Long Saber",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 5, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 5, 'per_unit' => 15))),
    // Romans - u6 Equites Caesaris
    113 => array('name' => "Caesaris' Light Lance", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 6, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 6, 'per_unit' => 12))),
    114 => array('name' => "Caesaris' Lance",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 6, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 6, 'per_unit' => 16))),
    115 => array('name' => "Caesaris' Heavy Lance", 'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 6, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 6, 'per_unit' => 20))),

    // Teutons - u11 Clubswinger
    116 => array('name' => "Clubswinger's Cudgel", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 11, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 11, 'per_unit' => 3))),
    117 => array('name' => "Clubswinger's Club",   'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 11, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 11, 'per_unit' => 4))),
    118 => array('name' => "Clubswinger's Mace",   'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 11, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 11, 'per_unit' => 5))),
    // Teutons - u12 Spearman
    119 => array('name' => "Spearman's Pitchfork", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 12, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 12, 'per_unit' => 3))),
    120 => array('name' => "Spearman's Pike",      'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 12, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 12, 'per_unit' => 4))),
    121 => array('name' => "Spearman's Spear",     'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 12, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 12, 'per_unit' => 5))),
    // Teutons - u13 Axeman
    122 => array('name' => "Axeman's Hatchet",    'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 13, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 13, 'per_unit' => 3))),
    123 => array('name' => "Axeman's Axe",        'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 13, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 13, 'per_unit' => 4))),
    124 => array('name' => "Axeman's Battle Axe", 'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 13, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 13, 'per_unit' => 5))),
    // Teutons - u15 Paladin
    125 => array('name' => "Paladin's Small Hammer", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 15, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 15, 'per_unit' => 6))),
    126 => array('name' => "Paladin's Hammer",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 15, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 15, 'per_unit' => 8))),
    127 => array('name' => "Paladin's Sledgehammer", 'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 15, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 15, 'per_unit' => 10))),
    // Teutons - u16 Teutonic Knight
    128 => array('name' => "Teutonic Knight's Short Sword", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 16, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 16, 'per_unit' => 9))),
    129 => array('name' => "Teutonic Knight's Sword",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 16, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 16, 'per_unit' => 12))),
    130 => array('name' => "Teutonic Knight's Long Sword",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 16, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 16, 'per_unit' => 15))),

    // Gauls - u21 Phalanx  (design sheet tribe "Daci": Scutier)
    131 => array('name' => "Phalanx's Pitchfork", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 21, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 21, 'per_unit' => 3))),
    132 => array('name' => "Phalanx's Spear",     'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 21, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 21, 'per_unit' => 4))),
    133 => array('name' => "Phalanx's Lance",     'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 21, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 21, 'per_unit' => 5))),
    // Gauls - u22 Swordsman (Pedestras)
    134 => array('name' => "Swordsman's Short Sword", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 22, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 22, 'per_unit' => 3))),
    135 => array('name' => "Swordsman's Sword",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 22, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 22, 'per_unit' => 4))),
    136 => array('name' => "Swordsman's Long Sword",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 22, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 22, 'per_unit' => 5))),
    // Gauls - u24 Theutates Thunder (Calaret Fulger)
    137 => array('name' => "Thunder's Short Bow", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 24, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 24, 'per_unit' => 6))),
    138 => array('name' => "Thunder's Bow",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 24, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 24, 'per_unit' => 8))),
    139 => array('name' => "Thunder's Long Bow",  'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 24, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 24, 'per_unit' => 10))),
    // Gauls - u25 Druidrider
    140 => array('name' => "Druidrider's Baton",       'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 25, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 25, 'per_unit' => 6))),
    141 => array('name' => "Druidrider's Staff",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 25, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 25, 'per_unit' => 8))),
    142 => array('name' => "Druidrider's Great Staff", 'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 25, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 25, 'per_unit' => 10))),
    // Gauls - u26 Haeduan (Tarabostes)
    143 => array('name' => "Haeduan's Light Lance", 'slot' => HSLOT_RIGHT, 'tier' => 1, 'unit' => 26, 'bonus' => array(HB_FIGHT => 500,  HB_UNIT_BONUS => array('unit' => 26, 'per_unit' => 9))),
    144 => array('name' => "Haeduan's Lance",       'slot' => HSLOT_RIGHT, 'tier' => 2, 'unit' => 26, 'bonus' => array(HB_FIGHT => 1000, HB_UNIT_BONUS => array('unit' => 26, 'per_unit' => 12))),
    145 => array('name' => "Haeduan's Heavy Lance", 'slot' => HSLOT_RIGHT, 'tier' => 3, 'unit' => 26, 'bonus' => array(HB_FIGHT => 1500, HB_UNIT_BONUS => array('unit' => 26, 'per_unit' => 15))),

    /* ---------------- CONSUMABLES (sheet: Consumabile; stackable, bag) ---------------- */
    200 => array('name' => 'Ointment',        'slot' => HSLOT_BAG, 'tier' => 1, 'bonus' => array(HB_HEAL_SELF => 1)),    // +1% HP per unit, max 99%, hero must be alive
    201 => array('name' => 'Scroll',          'slot' => HSLOT_BAG, 'tier' => 1, 'bonus' => array(HB_SCROLL => 10)),      // +10 XP per scroll
    202 => array('name' => 'Bucket of Water', 'slot' => HSLOT_BAG, 'tier' => 2, 'bonus' => array(HB_BUCKET => 1)),       // instant revive, no resource cost
    203 => array('name' => 'Law Tablet',      'slot' => HSLOT_BAG, 'tier' => 2, 'bonus' => array(HB_LOYALTY => 1)),      // +1% own village loyalty, max 125%
    204 => array('name' => 'Book of Wisdom',  'slot' => HSLOT_BAG, 'tier' => 3, 'bonus' => array(HB_RESET => 1)),        // reset attribute points
    205 => array('name' => 'Artwork',         'slot' => HSLOT_BAG, 'tier' => 3, 'bonus' => array(HB_ARTWORK => 1)),      // CP = daily production, cap 5000 (1x) / 2500 (speed)
    206 => array('name' => 'Small Bandage',   'slot' => HSLOT_BAG, 'tier' => 1, 'bonus' => array(HB_HEAL_TROOP => 25)),  // heals 25% of hero's army
    207 => array('name' => 'Bandage',         'slot' => HSLOT_BAG, 'tier' => 2, 'bonus' => array(HB_HEAL_TROOP => 33)),  // heals 33% of hero's army
    208 => array('name' => 'Cage',            'slot' => HSLOT_BAG, 'tier' => 1, 'bonus' => array(HB_CAGE => 1)),         // traps 1 oasis animal per cage
);

/* Helmets 7-9 (culture) are HALVED on speed servers per the design sheet
 * ("+100/day (1x) / +50 (3x)"). Runtime consumers must apply:
 *     value = (SPEED >= 3) ? value / 2 : value
 * whenever 'x2_on_speed' === false is explicitly set (see HeroItems::scaledBonusValue()). */

/* ============================================================================
 *  ADVENTURE CONFIGURATION (Phase 1, itemids updated to the new catalog;
 *  equipment drops added per design feedback: adventures are the primary
 *  T4 source of gear, rarer than consumables and weighted toward low tiers)
 * ------------------------------------------------------------------------- */
$heroAdventureConfig = array(
    'offer_lifetime'   => 24 * 3600,
    'max_offers'       => 3,
    'refresh_interval' => 8 * 3600,

    // Tier weights for equipment drops (percent, must sum to 100).
    'equip_tier_weights' => array(1 => 70, 2 => 25, 3 => 5),

    0 => array( // NORMAL
        'label'        => 'HERO_ADV_NORMAL',
        'exp'          => array(6, 12),
        'silver'       => array(0, 40),
        'hp_loss'      => array(0, 8),
        'resources'    => array(0, 400),
        'equip_chance' => 3,                              // % chance: 1 random piece of gear
        'item_chance'  => 5,                              // % chance: consumables (rolled only if no gear dropped)
        'consumable'   => array(200, 201, 208),           // Ointment, Scroll, Cage
    ),
    1 => array( // HARD
        'label'        => 'HERO_ADV_HARD',
        'exp'          => array(18, 30),
        'silver'       => array(30, 120),
        'hp_loss'      => array(10, 35),
        'resources'    => array(200, 1200),
        'equip_chance' => 10,
        'item_chance'  => 20,
        'consumable'   => array(200, 201, 203, 206, 208), // + Law Tablet, Small Bandage
    ),
);

/* Convenience index: itemids grouped by slot. */
$heroSlotIndex = array();
foreach ($heroItemCatalog as $iid => $def) {
    $heroSlotIndex[$def['slot']][] = $iid;
}

/**
 * Resolve the display name of an item. Checks for a HERO_ITEM_<id> lang
 * constant first (future localisation hook), falls back to the English
 * catalog name, and finally to 'Unknown item' for ids not in the catalog.
 */
if (!function_exists('heroItemName')) {
    function heroItemName($itemid) {
        global $heroItemCatalog;
        $const = 'HERO_ITEM_' . (int) $itemid;
        if (defined($const)) {
            return constant($const);
        }
        return isset($heroItemCatalog[$itemid]['name']) ? $heroItemCatalog[$itemid]['name'] : 'Unknown item';
    }
}

/**
 * Tribe an item belongs to: 0 = universal (helmets, armors, boots, etc.),
 * 1/2/3 = Romans/Teutons/Gauls for the unit-bound right-hand weapons
 * (u1-10 -> 1, u11-20 -> 2, u21-30 -> 3). Single source for both the
 * adventure drop filter and the tribe-filtered auction listing.
 */
if (!function_exists('heroItemTribe')) {
    function heroItemTribe($itemid) {
        global $heroItemCatalog;
        if (!isset($heroItemCatalog[$itemid]['unit'])) {
            return 0;
        }
        return intdiv((int) $heroItemCatalog[$itemid]['unit'] - 1, 10) + 1;
    }
}

/**
 * Human-readable effect line for an item, GENERATED from its bonus array so
 * tooltips can never drift from the actual battle/speed mechanics. Values
 * are shown as effective for THIS server (speed scaling applied, same rule
 * as HeroItems::scaledBonusValue). Uses HB_TXT_* lang constants with English
 * fallbacks, so it works before/without a translation pass.
 */
if (!function_exists('heroItemBonusText')) {
    function heroItemBonusText($itemid) {
        global $heroItemCatalog;
        if (!isset($heroItemCatalog[$itemid])) {
            return '';
        }
        $def = $heroItemCatalog[$itemid];

        $txt = function ($const, $fallback) {
            return defined($const) ? constant($const) : $fallback;
        };
        // Effective value on this server (mirrors HeroItems::scaledBonusValue).
        $scale = function ($value) use ($def) {
            if (!array_key_exists('x2_on_speed', $def) || !defined('SPEED') || SPEED < 3) {
                return (int) $value;
            }
            return $def['x2_on_speed'] ? (int) $value * 2 : (int) floor($value / 2);
        };

        $parts = array();
        foreach ($def['bonus'] as $type => $value) {
            switch ($type) {
                case HB_FIGHT:          $parts[] = '+' . $scale($value) . ' ' . $txt('HB_TXT_FIGHT', 'fighting strength'); break;
                case HB_UNIT_BONUS:
                    $u = (int) $value['unit'];
                    $uname = defined('U' . $u) ? constant('U' . $u) : 'unit ' . $u;
                    $parts[] = '+' . (int) $value['per_unit'] . ' ' . $txt('HB_TXT_UNIT_OFF', 'attack') . ' / +'
                             . (int) $value['per_unit'] . ' ' . $txt('HB_TXT_UNIT_DEF', 'defense') . ' '
                             . $txt('HB_TXT_PER', 'per') . ' ' . $uname;
                    break;
                case HB_VS_NATARS:      $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_VS_NATARS', 'strength vs Natars'); break;
                case HB_RAID:           $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_RAID', 'raided resources'); break;
                case HB_RETURN_SPEED:   $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_RETURN', 'troop return speed'); break;
                case HB_SPEED_OWN:      $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_SPEED_OWN', 'speed between own villages'); break;
                case HB_SPEED_ALLY:     $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_SPEED_ALLY', 'speed between ally villages'); break;
                case HB_XP:             $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_XP', 'experience'); break;
                case HB_REGEN_HP:       $parts[] = '+' . $scale($value) . ' ' . $txt('HB_TXT_REGEN', 'HP per day'); break;
                case HB_CP:             $parts[] = '+' . $scale($value) . ' ' . $txt('HB_TXT_CP', 'culture points per day'); break;
                case HB_TRAIN_CAV:      $parts[] = '-' . $scale($value) . '% ' . $txt('HB_TXT_TRAIN_CAV', 'cavalry training time'); break;
                case HB_TRAIN_INF:      $parts[] = '-' . $scale($value) . '% ' . $txt('HB_TXT_TRAIN_INF', 'infantry training time'); break;
                case HB_DMG_REDUCE:     $parts[] = '-' . $scale($value) . ' ' . $txt('HB_TXT_DMG', 'damage taken by the hero'); break;
                case HB_TROOP_SPEED_20: $parts[] = '+' . $scale($value) . '% ' . $txt('HB_TXT_SPEED20', 'troop speed beyond 20 tiles'); break;
                case HB_MOUNT_SPEED:    $parts[] = '+' . $scale($value) . ' ' . $txt('HB_TXT_MOUNT', 'fields/hour while mounted'); break;
                case HB_HORSE_SPEED:    $parts[] = $scale($value) . ' ' . $txt('HB_TXT_HORSE', 'fields/hour hero speed'); break;
                case HB_HEAL_SELF:      $parts[] = $txt('HB_TXT_OINTMENT', 'Heals 1% hero health per unit (max 99%)'); break;
                case HB_SCROLL:         $parts[] = '+' . (int) $value . ' ' . $txt('HB_TXT_SCROLL', 'hero experience each'); break;
                case HB_BUCKET:         $parts[] = $txt('HB_TXT_BUCKET', 'Instantly revives the hero at no cost'); break;
                case HB_LOYALTY:        $parts[] = $txt('HB_TXT_TABLET', '+1% own village loyalty each (max 125%)'); break;
                case HB_RESET:          $parts[] = $txt('HB_TXT_BOOK', 'Resets the hero attribute points'); break;
                case HB_ARTWORK:        $parts[] = $txt('HB_TXT_ARTWORK', 'Culture points equal to your daily production'); break;
                case HB_HEAL_TROOP:     $parts[] = $txt('HB_TXT_BANDAGE_A', 'Heals') . ' ' . (int) $value . '% ' . $txt('HB_TXT_BANDAGE_B', "of the hero's fallen troops after battle"); break;
                case HB_CAGE:           $parts[] = $txt('HB_TXT_CAGE', 'Captures 1 oasis animal per cage'); break;
            }
        }

        $out = implode(', ', $parts);
        if (!empty($def['requires_horse'])) {
            $out .= ' (' . $txt('HB_TXT_NEEDS_HORSE', 'requires an equipped horse') . ')';
        }
        if (isset($def['unit'])) {
            $u = (int) $def['unit'];
            $uname = defined('U' . $u) ? constant('U' . $u) : 'unit ' . $u;
            $out .= ' (' . $txt('HB_TXT_ONLY', 'only for a') . ' ' . $uname . ' ' . $txt('HB_TXT_HERO', 'hero') . ')';
        }
        return $out;
    }
}
