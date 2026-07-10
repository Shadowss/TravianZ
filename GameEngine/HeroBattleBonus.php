<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HeroBattleBonus.php                                       ##
##  Type           : T4 Hero port - battle & speed integration (Phase 5)       ##
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
##  Thin, static bridge between the hero item system and the combat/speed      ##
##  engine. Every entry point:                                                 ##
##    - is a NO-OP returning neutral values when NEW_FUNCTIONS_HERO_T4 is      ##
##      off, so vanilla battle math is bit-for-bit unchanged;                  ##
##    - memoizes per uid for the duration of the request (Automation ticks     ##
##      process many battles; bonuses must not re-query per battle).           ##
##                                                                             ##
##  Consumers (surgical hooks):                                                ##
##    Battle::getBattleHero()      -> statBonus(), attaches uid/unit_bonus/    ##
##                                    vs_natars/dmg_reduce to the hero array   ##
##    Battle HERO OFFENSE block    -> unitOffense(), natarMultiplier()         ##
##    Battle defender hero block   -> unitDefense()                            ##
##    Battle HERO DAMAGE block     -> reduceDamage()                           ##
##    Automation bounty callsite   -> raidMultiplier()                         ##
##    Automation return callsites  -> adjustReturnEndtime()                    ##
##    Units::getWalkingTroopsTime  -> adjustTravelTime()                       ##
##                                                                             ##
#################################################################################

class HeroBattleBonus
{
    /** @var array per-request bonus cache: uid => bonuses array */
    private static $cache = array();

    /** @var array per-request "does uid have a living hero" cache */
    private static $livingCache = array();

    /** Feature flag gate used by every public entry point. */
    public static function enabled()
    {
        return defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4;
    }

    /** Cached HeroItems::getBonuses(). Returns null when the feature is off. */
    public static function bonuses($uid)
    {
        if (!self::enabled()) {
            return null;
        }
        $uid = (int) $uid;
        if (!array_key_exists($uid, self::$cache)) {
            $heroItems = new HeroItems();
            self::$cache[$uid] = $heroItems->getBonuses($uid);
        }
        return self::$cache[$uid];
    }

    /* =========================================================================
     *  BATTLE MATH
     * ===================================================================== */

    /**
     * Flat fighting strength from items (weapons, cuirasses, shields).
     * Added to the hero's atk AND di/dc - T4 fight strength is a single stat
     * that counts on whichever side the hero fights.
     */
    public static function statBonus($uid)
    {
        $b = self::bonuses($uid);
        return $b ? (int) $b[HB_FIGHT] : 0;
    }

    /** [unitId => perUnit] map from the equipped weapon (empty when none). */
    public static function unitBonusMap($uid)
    {
        $b = self::bonuses($uid);
        return ($b && !empty($b[HB_UNIT_BONUS])) ? $b[HB_UNIT_BONUS] : array();
    }

    /**
     * Extra offense from the weapon's per-unit bonus:
     * +N attack per accompanying unit of the weapon's type.
     * $isCavalry tells the caller whether to add it to ap or cap.
     * Returns [addedInfantryAp, addedCavalryAp].
     */
    public static function unitOffense($uid, array $attackerUnits, array $cavalryLookup)
    {
        $map = self::unitBonusMap($uid);
        if (empty($map)) {
            return array(0, 0);
        }
        $ap = 0; $cap = 0;
        foreach ($map as $unitId => $perUnit) {
            $count = isset($attackerUnits['u' . $unitId]) ? (int) $attackerUnits['u' . $unitId] : 0;
            if ($count <= 0) {
                continue;
            }
            if (isset($cavalryLookup[$unitId])) {
                $cap += $perUnit * $count;
            } else {
                $ap += $perUnit * $count;
            }
        }
        return array($ap, $cap);
    }

    /**
     * Extra defense from the weapon's per-unit bonus:
     * +N defense per accompanying unit of the weapon's type. The design sheet
     * grants a single "+N def" figure, so it is added to BOTH the infantry
     * (dp) and cavalry (cdp) defense pools.
     * Returns the flat amount to add to each pool.
     */
    public static function unitDefense($uid, array $defenderUnits)
    {
        $map = self::unitBonusMap($uid);
        if (empty($map)) {
            return 0;
        }
        $add = 0;
        foreach ($map as $unitId => $perUnit) {
            $count = isset($defenderUnits['u' . $unitId]) ? (int) $defenderUnits['u' . $unitId] : 0;
            if ($count > 0) {
                $add += $perUnit * $count;
            }
        }
        return $add;
    }

    /**
     * Hunting horn: multiplier applied to the HERO's own attack contribution
     * when the defender is the Natars (uid 3, see Artifacts::NATARS_UID).
     */
    public static function natarMultiplier($uid, $defenderUid)
    {
        if ((int) $defenderUid !== 3) {
            return 1.0;
        }
        $b = self::bonuses($uid);
        if (!$b || (int) $b[HB_VS_NATARS] <= 0) {
            return 1.0;
        }
        return 1 + ((int) $b[HB_VS_NATARS] / 100);
    }

    /**
     * Armor damage reduction: flat points subtracted from the health damage
     * the hero takes in one battle (never below 0).
     */
    public static function reduceDamage($uid, $damage)
    {
        $b = self::bonuses($uid);
        if (!$b || (int) $b[HB_DMG_REDUCE] <= 0) {
            return (int) $damage;
        }
        return max(0, (int) $damage - (int) $b[HB_DMG_REDUCE]);
    }

    /* =========================================================================
     *  RAID BOUNTY (thief sacks)
     * ===================================================================== */

    /**
     * Sacks increase the resources stolen. Applies only when the attacker's
     * living hero actually took part in the strike ($heroSent > 0). The hero
     * that died in this very battle was already flagged dead by Battle.php
     * before the bounty step runs, so livingHero() naturally excludes them.
     */
    public static function raidMultiplier($uid, $heroSent)
    {
        if ((int) $heroSent <= 0 || !self::livingHero($uid)) {
            return 1.0;
        }
        $b = self::bonuses($uid);
        if (!$b || (int) $b[HB_RAID] <= 0) {
            return 1.0;
        }
        return 1 + ((int) $b[HB_RAID] / 100);
    }

    /* =========================================================================
     *  TRAVEL TIME (boots / pennant / standard / map)
     * ===================================================================== */

    /**
     * Adjust an OUTBOUND troop-travel time (seconds) computed by
     * Generator::procDistanceTime(). Only applies when the hero rides along.
     *
     *  - Pennant  (HB_SPEED_OWN):  +% speed when the target village belongs
     *                              to the same player;
     *  - Standard (HB_SPEED_ALLY): +% speed when the target belongs to an
     *                              alliance mate (pennant wins if both match);
     *  - Boots    (HB_TROOP_SPEED_20): +% speed for the part of the journey
     *    beyond 20 tiles, same piecewise idea as the Tournament Square
     *    (issue #304). NOTE: applied proportionally on the final time, which
     *    is exact on its own; when a Tournament Square is also active the two
     *    boosts compose multiplicatively on the >20 segment - a documented,
     *    deliberate approximation.
     */
    public static function adjustTravelTime($ownerUid, $heroInArmy, $fromWref, $toWref, $seconds)
    {
        global $database;

        if (!self::enabled() || (int) $heroInArmy <= 0 || $seconds <= 0) {
            return (int) $seconds;
        }
        $b = self::bonuses($ownerUid);
        if (!$b) {
            return (int) $seconds;
        }

        $seconds = (float) $seconds;

        // --- pennant / standard ---
        // Pennant: BOTH endpoints must belong to the player (journeys between
        // own villages). Standard: both endpoints inside the same alliance.
        // Destination-only checks would wrongly buff every return leg home.
        $pct = 0;
        $fromOwner   = (int) $database->getVillageField((int) $fromWref, 'owner');
        $targetOwner = (int) $database->getVillageField((int) $toWref, 'owner');
        if ($fromOwner > 0 && $targetOwner > 0) {
            if ($fromOwner === (int) $ownerUid && $targetOwner === (int) $ownerUid) {
                $pct = (int) $b[HB_SPEED_OWN];
            } elseif ((int) $b[HB_SPEED_ALLY] > 0) {
                $ownAlly    = (int) $database->getUserField($fromOwner, 'alliance', 0);
                $targetAlly = (int) $database->getUserField($targetOwner, 'alliance', 0);
                if ($ownAlly > 0 && $ownAlly === $targetAlly) {
                    $pct = (int) $b[HB_SPEED_ALLY];
                }
            }
        }
        if ($pct > 0) {
            $seconds = $seconds / (1 + $pct / 100);
        }

        // --- boots: only the beyond-20-tiles share of the journey ---
        $bootsPct = (int) $b[HB_TROOP_SPEED_20];
        if ($bootsPct > 0) {
            $fromCoor = $database->getCoor((int) $fromWref);
            $toCoor   = $database->getCoor((int) $toWref);
            if ($fromCoor && $toCoor) {
                $distance = (float) $database->getDistance($fromCoor['x'], $fromCoor['y'], $toCoor['x'], $toCoor['y']);
                if ($distance > 20) {
                    $shareBeyond = ($distance - 20) / $distance;   // time share past 20 tiles
                    $timeBeyond  = $seconds * $shareBeyond;
                    $seconds     = ($seconds - $timeBeyond) + $timeBeyond / (1 + $bootsPct / 100);
                }
            }
        }

        return max(1, (int) round($seconds));
    }

    /**
     * Map: shorten the RETURN leg after a battle. Receives the arrival time
     * and the planned return endtime; compresses the leg duration by the
     * map's percentage when the (still living) hero is coming home.
     */
    public static function adjustReturnEndtime($ownerUid, $heroSent, $arrivalTime, $endtime)
    {
        if (!self::enabled() || (int) $heroSent <= 0 || !self::livingHero($ownerUid)) {
            return $endtime;
        }
        $b = self::bonuses($ownerUid);
        if (!$b || (int) $b[HB_RETURN_SPEED] <= 0) {
            return $endtime;
        }
        $leg = (float) $endtime - (float) $arrivalTime;
        if ($leg <= 0) {
            return $endtime;
        }
        return $arrivalTime + $leg / (1 + (int) $b[HB_RETURN_SPEED] / 100);
    }

    /* =========================================================================
     *  BANDAGES (post-battle troop healing)
     * ===================================================================== */

    /**
     * Heal part of the attacker's fallen troops after a battle (Phase 6):
     * up to pct% of each unit type's losses return home, consuming ONE
     * bandage per healed unit. Better bandages (33%, itemid 207) are used
     * before small ones (25%, itemid 206). Applies only when the hero came
     * home alive ($returning['t11'] > 0). The hero itself is never healable.
     *
     * NOTE: hero XP was already granted on the full casualty count before
     * this runs - healed troops still award XP (deliberate, documented).
     *
     * @param int   $uid       Attacking player.
     * @param array $returning ['t1'..'t11' => surviving counts] (modified copy returned).
     * @param array $dead      [1..11 => losses per unit index].
     * @param int   $attackRef attacks.id of this strike. returnunitsComplete
     *                         reads the homecoming troop counts from the
     *                         attacks row (movement.ref join), NOT from the
     *                         in-memory array - healed units MUST be written
     *                         back there or they would vanish on arrival.
     * @return array The adjusted returning-troops array.
     */
    public static function applyBandages($uid, array $returning, array $dead, $attackRef = 0)
    {
        global $database;

        if (!self::enabled() || (int) ($returning['t11'] ?? 0) <= 0) {
            return $returning;
        }

        $heroItems = new HeroItems();
        // Bandage stacks, strongest first: [rowId, remaining, pct]
        $stacks = array();
        foreach ($heroItems->getInventory((int) $uid) as $row) {
            if ($row['orphan'] || $row['equipped'] == 1) {
                continue;
            }
            if ((int) $row['itemid'] === 207) {
                $stacks[0] = array('id' => (int) $row['id'], 'qty' => (int) $row['quantity'], 'pct' => 33);
            } elseif ((int) $row['itemid'] === 206) {
                $stacks[1] = array('id' => (int) $row['id'], 'qty' => (int) $row['quantity'], 'pct' => 25);
            }
        }
        if (empty($stacks)) {
            return $returning;
        }
        ksort($stacks);

        $healedPerUnit = array();

        foreach ($stacks as $stack) {
            if ($stack['qty'] <= 0) {
                continue;
            }
            $budget = $stack['qty'];
            $used   = 0;

            for ($i = 1; $i <= 10 && $budget > 0; $i++) {
                $lost = isset($dead[$i]) ? (int) $dead[$i] : 0;
                if ($lost <= 0) {
                    continue;
                }
                $healable = (int) floor($lost * $stack['pct'] / 100);
                $healed   = min($healable, $budget);
                if ($healed <= 0) {
                    continue;
                }
                $returning['t' . $i] = (int) ($returning['t' . $i] ?? 0) + $healed;
                $dead[$i]           -= $healed; // a unit is only healed once across stacks
                $budget             -= $healed;
                $used               += $healed;
                $healedPerUnit[$i]   = ($healedPerUnit[$i] ?? 0) + $healed;
            }

            if ($used > 0) {
                $heroItems->removeItem((int) $uid, $stack['id'], $used);
            }
        }

        // Persist the revived units into the attacks row: it is the source of
        // truth returnunitsComplete hands back to the village on arrival.
        if (!empty($healedPerUnit) && (int) $attackRef > 0) {
            $sets = array();
            foreach ($healedPerUnit as $i => $healed) {
                $sets[] = 't' . (int) $i . ' = t' . (int) $i . ' + ' . (int) $healed;
            }
            mysqli_query(
                $database->dblink,
                "UPDATE " . TB_PREFIX . "attacks SET " . implode(', ', $sets)
                . " WHERE id = " . (int) $attackRef . " LIMIT 1"
            );
        }

        return $returning;
    }

    /* =========================================================================
     *  CAGES (oasis animal capture)
     * ===================================================================== */

    /**
     * Cages (itemid 208): when the hero attacks an UNOCCUPIED oasis, up to
     * one animal per cage is captured BEFORE the fight - captured animals do
     * not defend. They are stationed as defensive reinforcements in the
     * attack's home village (enforcement row vref=home, from=home; nature
     * units u31-u40 count in defense through the normal enforcement path).
     *
     * Deliberate, documented simplification vs T4: the animals appear at
     * home the moment the battle resolves instead of travelling back with
     * the hero (the attacks row can only carry the attacker's own tribe
     * units, and a schema change for this isn't worth it).
     *
     * Removal from the oasis is a CONDITIONAL decrement per unit type
     * (u31 >= N guards), so a parallel process can never drive counts
     * negative; on a lost race the capture simply shrinks.
     *
     * @param int   $uid       Attacking player.
     * @param int   $homeWref  Village the attack was sent from.
     * @param int   $oasisWref The unoccupied oasis under attack.
     * @param array $Defender  Defender unit array (modified copy returned).
     * @return array The Defender array minus whatever was captured.
     */
    public static function applyCages($uid, $homeWref, $oasisWref, array $Defender)
    {
        global $database;

        if (!self::enabled()) {
            return $Defender;
        }

        // Animals present?
        $animals = 0;
        for ($i = 31; $i <= 40; $i++) {
            $animals += max(0, (int) ($Defender['u' . $i] ?? 0));
        }
        if ($animals <= 0) {
            return $Defender;
        }

        // Cage stack (unequipped, itemid 208).
        $heroItems = new HeroItems();
        $cageRow = null;
        foreach ($heroItems->getInventory((int) $uid) as $row) {
            if (!$row['orphan'] && (int) $row['itemid'] === 208 && $row['equipped'] == 0) {
                $cageRow = $row;
                break;
            }
        }
        if (!$cageRow || (int) $cageRow['quantity'] <= 0) {
            return $Defender;
        }

        $budget   = (int) $cageRow['quantity'];
        $captured = array();

        for ($i = 31; $i <= 40 && $budget > 0; $i++) {
            $have = max(0, (int) ($Defender['u' . $i] ?? 0));
            if ($have <= 0) {
                continue;
            }
            $take = min($have, $budget);

            // Conditional removal from the oasis - authoritative count.
            $stmt = $database->dblink->prepare(
                "UPDATE " . TB_PREFIX . "units
                    SET u{$i} = u{$i} - ?
                  WHERE vref = ? AND u{$i} >= ? LIMIT 1"
            );
            $stmt->bind_param('iii', $take, $oasisWref, $take);
            $stmt->execute();
            $removed = $stmt->affected_rows > 0;
            $stmt->close();
            if (!$removed) {
                continue; // lost a race; leave these animals to fight
            }

            $Defender['u' . $i] = $have - $take;
            $captured[$i]       = $take;
            $budget            -= $take;
        }

        if (empty($captured)) {
            return $Defender;
        }

        $used = array_sum($captured);
        $heroItems->removeItem((int) $uid, (int) $cageRow['id'], $used);

        // Station the animals at home: reuse the self-enforcement row if one
        // exists (vref = from = home), otherwise create it.
        $homeWref = (int) $homeWref;
        $res = mysqli_query(
            $database->dblink,
            "SELECT id FROM " . TB_PREFIX . "enforcement
              WHERE vref = $homeWref AND `from` = $homeWref LIMIT 1"
        );
        $rowE = $res ? mysqli_fetch_assoc($res) : null;
        if (!$rowE) {
            mysqli_query(
                $database->dblink,
                "INSERT INTO " . TB_PREFIX . "enforcement (vref, `from`) VALUES ($homeWref, $homeWref)"
            );
            $enfId = (int) mysqli_insert_id($database->dblink);
        } else {
            $enfId = (int) $rowE['id'];
        }

        $sets = array();
        foreach ($captured as $i => $n) {
            $sets[] = 'u' . (int) $i . ' = u' . (int) $i . ' + ' . (int) $n;
        }
        mysqli_query(
            $database->dblink,
            "UPDATE " . TB_PREFIX . "enforcement SET " . implode(', ', $sets)
            . " WHERE id = $enfId LIMIT 1"
        );

        return $Defender;
    }

    /* =========================================================================
     *  INTERNALS
     * ===================================================================== */

    /** Cached "uid has a living hero" check. */
    private static function livingHero($uid)
    {
        global $database;
        $uid = (int) $uid;
        if (!array_key_exists($uid, self::$livingCache)) {
            $res = mysqli_query(
                $database->dblink,
                "SELECT heroid FROM " . TB_PREFIX . "hero WHERE uid = $uid AND dead = 0 LIMIT 1"
            );
            self::$livingCache[$uid] = ($res && mysqli_fetch_row($res)) ? true : false;
        }
        return self::$livingCache[$uid];
    }

    /** Test helper: clear per-request caches (mirrors HeroItems invalidation). */
    public static function flushCache()
    {
        self::$cache = array();
        self::$livingCache = array();
    }
}
