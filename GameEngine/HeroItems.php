<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HeroItems.php                                             ##
##  Type           : T4 Hero port - items backend (Phase 2)                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow 		                                           ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################
##                                                                             ##
##  Backend for hero inventory / equipment / consumables / silver.             ##
##  - All statements are prepared (mysqli), all ids cast to int.               ##
##  - Per-request memoization caches (invalidated on every write), matching    ##
##    the Database.php cache convention.                                       ##
##  - Consumables whose game mechanic lands in a later phase (bandages in      ##
##    battle, cages in oasis attacks, law tablets in loyalty, artwork CP)      ##
##    return HeroItems::USE_DEFERRED so the caller knows the item exists       ##
##    but its effect is wired elsewhere. They are NOT silently consumed.       ##
##                                                                             ##
#################################################################################

class HeroItems
{
    /** useItem() result codes */
    const USE_OK        = 1;   // consumed, effect applied here
    const USE_DEFERRED  = 2;   // valid item, but its effect is applied by another subsystem (Phase 3/5)
    const USE_INVALID   = 0;   // unknown item / not owned / not usable now

    /** @var array per-request caches, keyed by uid */
    private static $inventoryCache = array();
    private static $bonusCache     = array();

    /** @var mysqli */
    private $db;

    public function __construct()
    {
        global $database;
        // Reuse the game's single mysqli link.
        $this->db = $database->dblink;

        // Catalog is idempotent to include (guarded defines).
        global $heroItemCatalog, $heroAdventureConfig, $heroSlotIndex;
        if (!isset($heroItemCatalog)) {
            include_once __DIR__ . '/Data/hero_items.php';
        }
    }

    /* =========================================================================
     *  READS
     * ===================================================================== */

    /**
     * Full inventory of a user (equipped + bag), catalog-joined.
     * Rows whose itemid vanished from the catalog are returned flagged with
     * 'orphan' => true instead of being hidden - anomaly surfaced, not altered.
     */
    public function getInventory($uid)
    {
        global $heroItemCatalog;
        $uid = (int) $uid;

        if (isset(self::$inventoryCache[$uid])) {
            return self::$inventoryCache[$uid];
        }

        $stmt = $this->db->prepare(
            "SELECT id, uid, heroid, itemid, slot, stat_value, quantity, equipped, tstamp
               FROM " . TB_PREFIX . "hero_items
              WHERE uid = ? ORDER BY equipped DESC, slot ASC, itemid ASC"
        );
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res  = $stmt->get_result();
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            if (isset($heroItemCatalog[$row['itemid']])) {
                $row['def']    = $heroItemCatalog[$row['itemid']];
                $row['name']   = heroItemName($row['itemid']);
                $row['orphan'] = false;
            } else {
                $row['def']    = null;
                $row['name']   = 'Unknown item #' . $row['itemid'];
                $row['orphan'] = true;
            }
            $rows[] = $row;
        }
        $stmt->close();

        self::$inventoryCache[$uid] = $rows;
        return $rows;
    }

    /** Equipped items only, indexed by slot (one item per slot). */
    public function getEquipped($uid)
    {
        $equipped = array();
        foreach ($this->getInventory($uid) as $row) {
            if ($row['equipped'] == 1 && !$row['orphan']) {
                $equipped[(int) $row['slot']] = $row;
            }
        }
        return $equipped;
    }

    /** Silver balance (0 if the user has no hero row). */
    public function getSilver($uid)
    {
        $uid  = (int) $uid;
        $stmt = $this->db->prepare("SELECT silver FROM " . TB_PREFIX . "hero WHERE uid = ? LIMIT 1");
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $stmt->bind_result($silver);
        $found = $stmt->fetch();
        $stmt->close();
        return $found ? (int) $silver : 0;
    }

    /* =========================================================================
     *  BONUS AGGREGATION
     *  Returns a normalized array all later phases read from:
     *  [
     *    'fight_strength' => int,   'damage_reduce' => int,
     *    'regen_hp' => int,         'xp_percent' => int,
     *    'culture_points' => int,   'train_cavalry' => int, 'train_infantry' => int,
     *    'vs_natars' => int,        'raid_percent' => int,
     *    'return_speed' => int,     'speed_own' => int,     'speed_ally' => int,
     *    'troop_speed_20' => int,   'horse_speed' => int,   'mount_speed' => int,
     *    'unit_bonus' => [ unitId => perUnitValue, ... ]
     *  ]
     * ===================================================================== */
    public function getBonuses($uid)
    {
        $uid = (int) $uid;
        if (isset(self::$bonusCache[$uid])) {
            return self::$bonusCache[$uid];
        }

        $bonuses = array(
            HB_FIGHT => 0, HB_DMG_REDUCE => 0, HB_REGEN_HP => 0, HB_XP => 0,
            HB_CP => 0, HB_TRAIN_CAV => 0, HB_TRAIN_INF => 0, HB_VS_NATARS => 0,
            HB_RAID => 0, HB_RETURN_SPEED => 0, HB_SPEED_OWN => 0, HB_SPEED_ALLY => 0,
            HB_TROOP_SPEED_20 => 0, HB_HORSE_SPEED => 0, HB_MOUNT_SPEED => 0,
            HB_UNIT_BONUS => array(),
        );

        $equipped = $this->getEquipped($uid);
        $hasHorse = isset($equipped[HSLOT_HORSE]);

        foreach ($equipped as $row) {
            $def = $row['def'];

            // Spurs count only while a horse is equipped.
            if (!empty($def['requires_horse']) && !$hasHorse) {
                continue;
            }

            foreach ($def['bonus'] as $type => $value) {
                if ($type === HB_UNIT_BONUS) {
                    $u = (int) $value['unit'];
                    if (!isset($bonuses[HB_UNIT_BONUS][$u])) {
                        $bonuses[HB_UNIT_BONUS][$u] = 0;
                    }
                    $bonuses[HB_UNIT_BONUS][$u] += (int) $value['per_unit'];
                    continue;
                }
                if (isset($bonuses[$type])) {
                    $bonuses[$type] += $this->scaledBonusValue($def, (int) $value);
                }
            }
        }

        self::$bonusCache[$uid] = $bonuses;
        return $bonuses;
    }

    /**
     * Apply the server-speed scaling rules from the design sheet:
     *   'x2_on_speed' => true   -> value * 2 on speed servers (spurs, horses)
     *   'x2_on_speed' => false  -> value / 2 on speed servers (culture helmets)
     *   key absent              -> value unchanged
     * "Speed server" = SPEED >= 3 (per the sheet's "(1x) / (3x)" notation).
     */
    public function scaledBonusValue(array $def, $value)
    {
        if (!array_key_exists('x2_on_speed', $def)) {
            return $value;
        }
        $isSpeed = defined('SPEED') && SPEED >= 3;
        if (!$isSpeed) {
            return $value;
        }
        return $def['x2_on_speed'] ? $value * 2 : (int) floor($value / 2);
    }

    /* =========================================================================
     *  WRITES
     * ===================================================================== */

    /**
     * Grant an item to a user (adventure loot, auction win, admin).
     * Consumables (bag slot) stack onto an existing row; gear inserts a new row.
     * Returns the hero_items.id of the affected row, or 0 on failure.
     */
    public function addItem($uid, $itemid, $quantity = 1, $statValue = 0)
    {
        global $heroItemCatalog;
        $uid = (int) $uid; $itemid = (int) $itemid;
        $quantity = max(1, (int) $quantity); $statValue = (int) $statValue;

        if (!isset($heroItemCatalog[$itemid])) {
            return 0;
        }
        $def  = $heroItemCatalog[$itemid];
        $slot = (int) $def['slot'];
        $now  = time();

        if ($slot === HSLOT_BAG) {
            // Stack consumables.
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "hero_items
                    SET quantity = quantity + ?, tstamp = ?
                  WHERE uid = ? AND itemid = ? AND equipped = 0 LIMIT 1"
            );
            $stmt->bind_param('iiii', $quantity, $now, $uid, $itemid);
            $stmt->execute();
            $affected = $stmt->affected_rows;
            $stmt->close();

            if ($affected > 0) {
                $this->invalidateCaches($uid);
                $row = $this->findRow($uid, $itemid);
                return $row ? (int) $row['id'] : 0;
            }
        }

        $equipped = 0;
        $stmt = $this->db->prepare(
            "INSERT INTO " . TB_PREFIX . "hero_items
                    (uid, heroid, itemid, slot, stat_value, quantity, equipped, tstamp)
             VALUES (?, 0, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('iiiiiii', $uid, $itemid, $slot, $statValue, $quantity, $equipped, $now);
        $stmt->execute();
        $newId = (int) $stmt->insert_id;
        $stmt->close();

        $this->invalidateCaches($uid);
        return $newId;
    }

    /**
     * Equip an owned item into its slot. Returns true on success.
     * Rules enforced:
     *  - item must belong to $uid and not be a consumable
     *  - weapons ('unit' key) require the LIVING hero to be that exact unit
     *  - anything already in that slot is unequipped first (atomic enough for
     *    a per-user action; both statements touch only this user's rows)
     */
    public function equipItem($uid, $rowId)
    {
        global $database;
        $uid = (int) $uid; $rowId = (int) $rowId;

        $row = $this->findRowById($uid, $rowId);
        if (!$row || $row['orphan'] || (int) $row['def']['slot'] === HSLOT_BAG) {
            return false;
        }

        // Weapon unit restriction.
        if (isset($row['def']['unit'])) {
            $hero = $database->getHero($uid);
            $heroUnit = 0;
            if (is_array($hero)) {
                foreach ($hero as $h) {
                    if ($h['dead'] != 1) { $heroUnit = (int) $h['unit']; break; }
                }
            }
            if ($heroUnit !== (int) $row['def']['unit']) {
                return false;
            }
        }

        $slot = (int) $row['def']['slot'];

        // Vacate the slot.
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_items SET equipped = 0 WHERE uid = ? AND slot = ? AND equipped = 1"
        );
        $stmt->bind_param('ii', $uid, $slot);
        $stmt->execute();
        $stmt->close();

        // Equip the requested row.
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_items SET equipped = 1 WHERE uid = ? AND id = ? LIMIT 1"
        );
        $stmt->bind_param('ii', $uid, $rowId);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();

        $this->invalidateCaches($uid);
        return $ok;
    }

    /** Unequip a specific owned row. Returns true on success. */
    public function unequipItem($uid, $rowId)
    {
        $uid = (int) $uid; $rowId = (int) $rowId;
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_items SET equipped = 0 WHERE uid = ? AND id = ? AND equipped = 1 LIMIT 1"
        );
        $stmt->bind_param('ii', $uid, $rowId);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();

        $this->invalidateCaches($uid);
        return $ok;
    }

    /**
     * Remove quantity from an owned row (used by useItem, auction listing).
     * Deletes the row when the stack reaches zero. Returns true on success.
     */
    public function removeItem($uid, $rowId, $quantity = 1)
    {
        $uid = (int) $uid; $rowId = (int) $rowId; $quantity = max(1, (int) $quantity);

        // Conditional decrement - never goes below zero even under races.
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_items
                SET quantity = quantity - ?
              WHERE uid = ? AND id = ? AND quantity >= ? LIMIT 1"
        );
        $stmt->bind_param('iiii', $quantity, $uid, $rowId, $quantity);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();

        if ($ok) {
            $stmt = $this->db->prepare(
                "DELETE FROM " . TB_PREFIX . "hero_items WHERE uid = ? AND id = ? AND quantity <= 0 LIMIT 1"
            );
            $stmt->bind_param('ii', $uid, $rowId);
            $stmt->execute();
            $stmt->close();
        }

        $this->invalidateCaches($uid);
        return $ok;
    }

    /**
     * Use a consumable. Applies immediate effects (ointment, scroll, bucket,
     * book of wisdom, law tablets, artwork); returns USE_DEFERRED for
     * consumables whose mechanic is wired into battle processing (bandages,
     * cages - Phase 6) WITHOUT consuming them.
     * $vid: target village, required for law tablets (loyalty target).
     * Returns one of the USE_* class constants.
     */
    public function useItem($uid, $rowId, $quantity = 1, $vid = 0)
    {
        global $database;
        $uid = (int) $uid; $rowId = (int) $rowId; $quantity = max(1, (int) $quantity);

        $row = $this->findRowById($uid, $rowId);
        if (!$row || $row['orphan'] || (int) $row['def']['slot'] !== HSLOT_BAG) {
            return self::USE_INVALID;
        }
        if ((int) $row['quantity'] < $quantity) {
            return self::USE_INVALID;
        }

        $bonus = $row['def']['bonus'];

        /* ---- Ointment: +1% HP per unit, cap 99, hero must be alive ---- */
        if (isset($bonus[HB_HEAL_SELF])) {
            $hero = $this->getLivingHeroRow($uid);
            if (!$hero) {
                return self::USE_INVALID;
            }
            $health = (float) $hero['health'];
            if ($health >= 99) {
                return self::USE_INVALID;
            }
            // Only consume as many as actually heal (no waste past the 99 cap).
            $usable    = min($quantity, (int) ceil(99 - $health));
            $newHealth = min(99, $health + $usable * (int) $bonus[HB_HEAL_SELF]);

            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "hero SET health = ? WHERE heroid = ? LIMIT 1"
            );
            $heroid = (int) $hero['heroid'];
            $stmt->bind_param('di', $newHealth, $heroid);
            $stmt->execute();
            $stmt->close();

            $this->removeItem($uid, $rowId, $usable);
            return self::USE_OK;
        }

        /* ---- Scroll: +10 XP each ---- */
        if (isset($bonus[HB_SCROLL])) {
            $hero = $this->getLivingHeroRow($uid);
            if (!$hero) {
                return self::USE_INVALID;
            }
            $xp   = (int) $bonus[HB_SCROLL] * $quantity;
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "hero SET experience = experience + ? WHERE heroid = ? LIMIT 1"
            );
            $heroid = (int) $hero['heroid'];
            $stmt->bind_param('ii', $xp, $heroid);
            $stmt->execute();
            $stmt->close();

            $this->removeItem($uid, $rowId, $quantity);
            return self::USE_OK;
        }

        /* ---- Bucket of Water: instant free revive of the dead hero ---- */
        if (isset($bonus[HB_BUCKET])) {
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "hero
                    SET dead = 0, health = 100, inrevive = 0, lastupdate = ?
                  WHERE uid = ? AND dead = 1 LIMIT 1"
            );
            $now = time();
            $stmt->bind_param('ii', $now, $uid);
            $stmt->execute();
            $revived = $stmt->affected_rows > 0;
            $stmt->close();

            if (!$revived) {
                return self::USE_INVALID; // no dead hero to revive
            }
            $this->removeItem($uid, $rowId, 1); // one bucket per revive
            return self::USE_OK;
        }

        /* ---- Book of Wisdom: reset attribute points ---- */
        if (isset($bonus[HB_RESET])) {
            $hero = $this->getLivingHeroRow($uid);
            if (!$hero) {
                return self::USE_INVALID;
            }
            // Refund all spent points: 5 free points per level gained (same
            // convention as Automation::calculateLevelUp). Attributes return to 0.
            $level  = (int) $hero['level'];
            $points = $level * 5;
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "hero
                    SET points = ?, attack = 0, defence = 0, attackbonus = 0,
                        defencebonus = 0, regeneration = 0
                  WHERE heroid = ? LIMIT 1"
            );
            $heroid = (int) $hero['heroid'];
            $stmt->bind_param('ii', $points, $heroid);
            $stmt->execute();
            $stmt->close();

            $this->removeItem($uid, $rowId, 1);
            return self::USE_OK;
        }

        /* ---- Law Tablet: +1% loyalty per tablet on an OWN village, max 125% ---- */
        if (isset($bonus[HB_LOYALTY])) {
            $vid = (int) $vid;
            if ($vid <= 0) {
                return self::USE_INVALID;
            }
            // Village must belong to the user; cap enforced in SQL so
            // concurrent uses can never overshoot 125.
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "vdata
                    SET loyalty = LEAST(125, loyalty + ?)
                  WHERE wref = ? AND owner = ? AND loyalty < 125 LIMIT 1"
            );
            $gain = (int) $bonus[HB_LOYALTY] * $quantity;
            $stmt->bind_param('iii', $gain, $vid, $uid);
            $stmt->execute();
            $ok = $stmt->affected_rows > 0;
            $stmt->close();

            if (!$ok) {
                return self::USE_INVALID; // not owner, or already at cap
            }
            $this->removeItem($uid, $rowId, $quantity);
            return self::USE_OK;
        }

        /* ---- Artwork: culture points equal to the account's daily CP
         *      production, capped at 5000 (normal) / 2500 (speed >= 3).
         *      users.cp is the accumulator culturePoints() ticks into. ---- */
        if (isset($bonus[HB_ARTWORK])) {
            $stmt = $this->db->prepare(
                "SELECT COALESCE(SUM(cp), 0) FROM " . TB_PREFIX . "vdata WHERE owner = ?"
            );
            $stmt->bind_param('i', $uid);
            $stmt->execute();
            $stmt->bind_result($dailyCp);
            $stmt->fetch();
            $stmt->close();

            $cap  = (defined('SPEED') && SPEED >= 3) ? 2500 : 5000;
            $gain = min($cap, (int) $dailyCp) * $quantity;
            if ($gain <= 0) {
                return self::USE_INVALID;
            }

            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "users SET cp = cp + ? WHERE id = ? LIMIT 1"
            );
            $stmt->bind_param('ii', $gain, $uid);
            $stmt->execute();
            $ok = $stmt->affected_rows > 0;
            $stmt->close();

            if (!$ok) {
                return self::USE_INVALID;
            }
            $this->removeItem($uid, $rowId, $quantity);
            return self::USE_OK;
        }

        /* ---- Deferred consumables (mechanic lands in Phase 6 with the UI:
         *      bandages consume on post-battle healing, cages on oasis
         *      attacks). NOT consumed here. ---- */
        if (isset($bonus[HB_HEAL_TROOP]) || isset($bonus[HB_CAGE])) {
            return self::USE_DEFERRED;
        }

        return self::USE_INVALID;
    }

    /* =========================================================================
     *  SILVER (race-safe conditional updates)
     * ===================================================================== */

    /** Add silver to the user's hero row. Returns true if a hero row exists. */
    public function addSilver($uid, $amount)
    {
        $uid = (int) $uid; $amount = max(0, (int) $amount);
        if ($amount === 0) {
            return true;
        }
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero SET silver = silver + ? WHERE uid = ? LIMIT 1"
        );
        $stmt->bind_param('ii', $amount, $uid);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        return $ok;
    }

    /**
     * Spend silver. The WHERE silver >= ? guard makes this race-safe:
     * two concurrent spends can never take the balance negative.
     */
    public function spendSilver($uid, $amount)
    {
        $uid = (int) $uid; $amount = max(0, (int) $amount);
        if ($amount === 0) {
            return true;
        }
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero
                SET silver = silver - ?
              WHERE uid = ? AND silver >= ? LIMIT 1"
        );
        $stmt->bind_param('iii', $amount, $uid, $amount);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        return $ok;
    }

    /* =========================================================================
     *  INTERNALS
     * ===================================================================== */

    private function invalidateCaches($uid)
    {
        unset(self::$inventoryCache[(int) $uid], self::$bonusCache[(int) $uid]);
    }

    private function findRow($uid, $itemid)
    {
        foreach ($this->getInventory($uid) as $row) {
            if ((int) $row['itemid'] === (int) $itemid && $row['equipped'] == 0) {
                return $row;
            }
        }
        return null;
    }

    private function findRowById($uid, $rowId)
    {
        foreach ($this->getInventory($uid) as $row) {
            if ((int) $row['id'] === (int) $rowId) {
                return $row;
            }
        }
        return null;
    }

    /** Fetch the raw LIVING hero row directly (health/level/points included). */
    private function getLivingHeroRow($uid)
    {
        $uid  = (int) $uid;
        $stmt = $this->db->prepare(
            "SELECT heroid, uid, unit, level, points, experience, health, dead
               FROM " . TB_PREFIX . "hero WHERE uid = ? AND dead = 0 LIMIT 1"
        );
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }
}
