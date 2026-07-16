<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HeroAdventure.php                                         ##
##  Type           : T4 Hero port - adventures backend (Phase 3)               ##
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
##  Adventure lifecycle:                                                       ##
##    offer (status 0) -> running (status 1, movement sort_type 20)            ##
##    -> arrival processed by Automation (rewards + ntype 26 report,           ##
##       status 2, return movement sort_type 21 carrying resources)            ##
##    -> return processed by Automation (hero back in units.hero,              ##
##       resources credited)                                                   ##
##                                                                             ##
##  Death: if HP loss would drop health to 0, the hero dies AT the site        ##
##  (dead=1, health=0, loot forfeited, no return movement). units.hero was     ##
##  already decremented at send - identical end state to dying in battle,      ##
##  so the existing revive flow (37_revive.tpl + handleReviveCompletion)       ##
##  works unchanged.                                                           ##
##                                                                             ##
##  XP: only `experience` is incremented (with the helmet HB_XP% bonus).       ##
##  Level-up/points are intentionally NOT touched here - Automation's          ##
##  updateHero()/calculateLevelUp() already handles that every tick.           ##
##                                                                             ##
#################################################################################

class HeroAdventure
{
    /** Hero base speed on foot, fields/hour (T4 convention). */
    const BASE_HERO_SPEED = 7;

    /** How far from the hero's village adventure sites are picked (tiles). */
    const SITE_MIN_RADIUS = 3;
    const SITE_MAX_RADIUS = 25;

    /** Max users to top-up with fresh offers per automation tick (bounded work). */
    const BATCH_LIMIT = 50;

    /** startAdventure() result codes */
    const START_OK            = 1;
    const START_INVALID       = 0;  // offer missing/expired/not yours/already running
    const START_NO_HERO       = -1; // no living hero
    const START_HERO_AWAY     = -2; // hero not at home village

    /** @var mysqli */
    private $db;

    public function __construct()
    {
        global $database;
        $this->db = $database->dblink;

        global $heroItemCatalog, $heroAdventureConfig;
        if (!isset($heroAdventureConfig)) {
            include_once __DIR__ . '/Data/hero_items.php';
        }
    }

    /* =========================================================================
     *  OFFERS
     * ===================================================================== */

    /** Non-expired, still-available offers for a user. */
    public function getOffers($uid)
    {
        $uid = (int) $uid; $now = time();
        $stmt = $this->db->prepare(
            "SELECT id, uid, wref, difficulty, duration, created, expire, status, moveid
               FROM " . TB_PREFIX . "hero_adventure
              WHERE uid = ? AND status = 0 AND expire > ?
              ORDER BY difficulty ASC, duration ASC"
        );
        $stmt->bind_param('ii', $uid, $now);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = array();
        while ($row = $res->fetch_assoc()) {
            $out[] = $row;
        }
        $stmt->close();
        return $out;
    }

    /** The adventure the hero is currently running, or null. */
    public function getRunning($uid)
    {
        $uid = (int) $uid;
        $stmt = $this->db->prepare(
            "SELECT a.id, a.wref, a.difficulty, a.moveid, m.endtime, m.sort_type
               FROM " . TB_PREFIX . "hero_adventure a
               JOIN " . TB_PREFIX . "movement m ON m.moveid = a.moveid
              WHERE a.uid = ? AND a.status = 1 AND m.proc = 0 LIMIT 1"
        );
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    /**
     * Top up a single user's offer list (expires stale ones first).
     * Respects max_offers and refresh_interval from $heroAdventureConfig.
     * Returns the number of offers created.
     */
    public function generateOffers($uid)
    {
        global $database, $heroAdventureConfig;
        $uid = (int) $uid; $now = time();

        // Living hero needed - offers are anchored to the hero's village.
        $hero = $this->getLivingHero($uid);
        if (!$hero) {
            return 0;
        }

        // Expire stale offers (kept as rows with status untouched would clutter
        // the uid_status index; a hard delete of expired *available* offers is safe).
        $stmt = $this->db->prepare(
            "DELETE FROM " . TB_PREFIX . "hero_adventure WHERE uid = ? AND status = 0 AND expire <= ?"
        );
        $stmt->bind_param('ii', $uid, $now);
        $stmt->execute();
        $stmt->close();

        // Respect refresh interval: don't regenerate too often.
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) AS cnt, COALESCE(MAX(created), 0) AS latest
               FROM " . TB_PREFIX . "hero_adventure WHERE uid = ? AND status = 0"
        );
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res  = $stmt->get_result();
        $info = $res->fetch_assoc();
        $stmt->close();

        $have   = (int) $info['cnt'];
        $latest = (int) $info['latest'];
        $max    = (int) $heroAdventureConfig['max_offers'];

        if ($have >= $max) {
            return 0;
        }
        if ($latest > 0 && ($now - $latest) < (int) $heroAdventureConfig['refresh_interval']) {
            return 0;
        }

        // Pick random unoccupied tiles around the hero's village.
        $coor = $database->getCoor($hero['wref']);
        if (!$coor) {
            return 0;
        }
        $x = (int) $coor['x']; $y = (int) $coor['y']; $r = self::SITE_MAX_RADIUS;

        $need = $max - $have;
        // Min radius enforced in SQL so LIMIT never undercounts (the bounding
        // box doesn't wrap around the map seam, so plain coordinate distance
        // is exact within it).
        $stmt = $this->db->prepare(
            "SELECT id, x, y FROM " . TB_PREFIX . "wdata
              WHERE occupied = 0 AND id <> ?
                AND x BETWEEN ? AND ? AND y BETWEEN ? AND ?
                AND (POW(x - ?, 2) + POW(y - ?, 2)) >= ?
              ORDER BY RAND() LIMIT ?"
        );
        $wref = (int) $hero['wref'];
        $x1 = $x - $r; $x2 = $x + $r; $y1 = $y - $r; $y2 = $y + $r;
        $minSq = self::SITE_MIN_RADIUS * self::SITE_MIN_RADIUS;
        $stmt->bind_param('iiiiiiiii', $wref, $x1, $x2, $y1, $y2, $x, $y, $minSq, $need);
        $stmt->execute();
        $res   = $stmt->get_result();
        $tiles = array();
        while ($row = $res->fetch_assoc()) {
            $tiles[] = $row;
        }
        $stmt->close();

        $created = 0;
        foreach ($tiles as $tile) {
            $dist = $database->getDistance($x, $y, $tile['x'], $tile['y']);
            // Hard adventures ~30% of offers.
            $difficulty = (mt_rand(1, 100) <= 30) ? 1 : 0;
            $duration   = $this->travelSeconds($uid, $dist);
            $expire     = $now + (int) $heroAdventureConfig['offer_lifetime'];

            $stmt = $this->db->prepare(
                "INSERT INTO " . TB_PREFIX . "hero_adventure
                        (uid, wref, difficulty, duration, created, expire, status, moveid)
                 VALUES (?, ?, ?, ?, ?, ?, 0, 0)"
            );
            $tileId = (int) $tile['id'];
            $stmt->bind_param('iiiiii', $uid, $tileId, $difficulty, $duration, $now, $expire);
            $stmt->execute();
            $stmt->close();
            $created++;
        }
        return $created;
    }

    /**
     * Batch top-up used by Automation: refresh offers for users with living,
     * at-home heroes that are below max_offers. Work bounded by BATCH_LIMIT.
     */
    public function generateOffersBatch()
    {
        global $heroAdventureConfig;
        $now = time();
        $threshold = $now - (int) $heroAdventureConfig['refresh_interval'];
        $max = (int) $heroAdventureConfig['max_offers'];
        $limit = self::BATCH_LIMIT;

        // Users with a living hero whose available-offer count is below max
        // and whose newest offer (if any) is older than the refresh interval.
        $stmt = $this->db->prepare(
            "SELECT h.uid
               FROM " . TB_PREFIX . "hero h
          LEFT JOIN " . TB_PREFIX . "hero_adventure a
                 ON a.uid = h.uid AND a.status = 0 AND a.expire > ?
              WHERE h.dead = 0
           GROUP BY h.uid
             HAVING COUNT(a.id) < ? AND COALESCE(MAX(a.created), 0) < ?
              LIMIT ?"
        );
        $stmt->bind_param('iiii', $now, $max, $threshold, $limit);
        $stmt->execute();
        $res  = $stmt->get_result();
        $uids = array();
        while ($row = $res->fetch_assoc()) {
            $uids[] = (int) $row['uid'];
        }
        $stmt->close();

        foreach ($uids as $uid) {
            $this->generateOffers($uid);
        }
        return count($uids);
    }

    /* =========================================================================
     *  START
     * ===================================================================== */

    /**
     * Send the hero on an available adventure offer.
     * Returns one of the START_* class constants.
     */
    public function startAdventure($uid, $adventureId)
    {
        $uid = (int) $uid; $adventureId = (int) $adventureId; $now = time();

        $hero = $this->getLivingHero($uid);
        if (!$hero) {
            return self::START_NO_HERO;
        }
        // Only one adventure at a time.
        if ($this->getRunning($uid)) {
            return self::START_INVALID;
        }

        // Load the offer (must be this user's, available, not expired).
        $stmt = $this->db->prepare(
            "SELECT id, wref, difficulty, duration FROM " . TB_PREFIX . "hero_adventure
              WHERE id = ? AND uid = ? AND status = 0 AND expire > ? LIMIT 1"
        );
        $stmt->bind_param('iii', $adventureId, $uid, $now);
        $stmt->execute();
        $res   = $stmt->get_result();
        $offer = $res->fetch_assoc();
        $stmt->close();
        if (!$offer) {
            return self::START_INVALID;
        }

        // Hero must be AT HOME: race-safe conditional decrement of units.hero.
        $homeWref = (int) $hero['wref'];
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "units SET hero = hero - 1 WHERE vref = ? AND hero >= 1 LIMIT 1"
        );
        $stmt->bind_param('i', $homeWref);
        $stmt->execute();
        $atHome = $stmt->affected_rows > 0;
        $stmt->close();
        if (!$atHome) {
            return self::START_HERO_AWAY;
        }

        // Claim the offer atomically; if someone double-clicked and a parallel
        // request claimed it first, put the hero back and bail out.
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_adventure SET status = 1 WHERE id = ? AND status = 0 LIMIT 1"
        );
        $stmt->bind_param('i', $adventureId);
        $stmt->execute();
        $claimed = $stmt->affected_rows > 0;
        $stmt->close();
        if (!$claimed) {
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "units SET hero = hero + 1 WHERE vref = ? LIMIT 1"
            );
            $stmt->bind_param('i', $homeWref);
            $stmt->execute();
            $stmt->close();
            return self::START_INVALID;
        }

        // Movement out: from = home village, to = adventure tile, ref = adventure id.
        // Recompute duration now (equipment may have changed since the offer was made).
        global $database;
        $coorHome = $database->getCoor($homeWref);
        $coorSite = $database->getCoor((int) $offer['wref']);
        $dist     = $database->getDistance($coorHome['x'], $coorHome['y'], $coorSite['x'], $coorSite['y']);
        $duration = $this->travelSeconds($uid, $dist);
        $endtime  = $now + $duration;

        $stmt = $this->db->prepare(
            "INSERT INTO " . TB_PREFIX . "movement
                    (sort_type, `from`, `to`, ref, ref2, starttime, endtime, proc, send, wood, clay, iron, crop, marker)
             VALUES (?, ?, ?, ?, 0, ?, ?, 0, 1, 0, 0, 0, 0, 0)"
        );
        $sortType = MOVEMENT_ADVENTURE_OUT; $siteWref = (int) $offer['wref'];
        $stmt->bind_param('iiiiii', $sortType, $homeWref, $siteWref, $adventureId, $now, $endtime);
        $stmt->execute();
        $moveid = (int) $stmt->insert_id;
        $stmt->close();

        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_adventure SET moveid = ? WHERE id = ? LIMIT 1"
        );
        $stmt->bind_param('ii', $moveid, $adventureId);
        $stmt->execute();
        $stmt->close();

        return self::START_OK;
    }

    /* =========================================================================
     *  AUTOMATION PROCESSORS
     * ===================================================================== */

    /**
     * Process heroes ARRIVING at adventure sites (sort_type 20).
     * Rolls rewards, applies HP loss/XP/silver/items, files the ntype 26
     * report, and creates the return movement carrying the resource loot.
     */
    public function processArrivals()
    {
        global $database, $heroAdventureConfig;
        $now = time();

        $q = "SELECT m.moveid, m.`from`, m.`to`, m.ref, m.endtime,
                     a.id AS advid, a.uid, a.difficulty
                FROM " . TB_PREFIX . "movement m
                JOIN " . TB_PREFIX . "hero_adventure a ON a.id = m.ref
               WHERE m.sort_type = " . (int) MOVEMENT_ADVENTURE_OUT . "
                 AND m.proc = 0 AND m.endtime < $now";
        $rows = $database->query_return($q);
        if (!$rows || !count($rows)) {
            return 0;
        }

        $processed = 0;
        foreach ($rows as $data) {
            if (!$this->claimMovement($data['moveid'])) {
                continue;
            }

            $uid  = (int) $data['uid'];
            $hero = $this->getLivingHero($uid);
            $cfg  = $heroAdventureConfig[(int) $data['difficulty']];

            // Hero vanished/died meanwhile (edge case): close the adventure quietly.
            if (!$hero) {
                $this->finishAdventure($data['advid']);
                continue;
            }

            /* ---- Roll rewards ---- */
            $exp    = mt_rand($cfg['exp'][0], $cfg['exp'][1]);
            $silver = mt_rand($cfg['silver'][0], $cfg['silver'][1]);
            $hpLoss = mt_rand($cfg['hp_loss'][0], $cfg['hp_loss'][1]);
            $wood   = mt_rand($cfg['resources'][0], $cfg['resources'][1]);
            $clay   = mt_rand($cfg['resources'][0], $cfg['resources'][1]);
            $iron   = mt_rand($cfg['resources'][0], $cfg['resources'][1]);
            $crop   = mt_rand($cfg['resources'][0], $cfg['resources'][1]);

            // Item drop: gear first (rarer, tier-weighted toward T1), and only
            // if no gear dropped, roll the consumable pool. One item max.
            $itemId = 0; $itemQty = 0;
            if (mt_rand(1, 100) <= (int) ($cfg['equip_chance'] ?? 0)) {
                $itemId  = $this->rollEquipment($uid);
                $itemQty = ($itemId > 0) ? 1 : 0;
            }
            if ($itemId === 0 && mt_rand(1, 100) <= (int) $cfg['item_chance']) {
                $pool    = $cfg['consumable'];
                $itemId  = (int) $pool[array_rand($pool)];
                $itemQty = 1;
            }

            $health    = (float) $hero['health'];
            $newHealth = $health - $hpLoss;

            if ($newHealth <= 0) {
                /* ---- Hero dies at the site: loot forfeited, no return trip. ---- */
                $stmt = $this->db->prepare(
                    "UPDATE " . TB_PREFIX . "hero SET dead = 1, health = 0, lastupdate = ? WHERE heroid = ? LIMIT 1"
                );
                $heroid = (int) $hero['heroid'];
                $stmt->bind_param('ii', $now, $heroid);
                $stmt->execute();
                $stmt->close();

                $payload = 'difficulty=' . (int) $data['difficulty'] . '&died=1&hp=' . $hpLoss;
                $database->addNotice($uid, (int) $data['from'], 0, NTYPE_ADVENTURE_REPORT,
                    'Hero fell on an adventure', $payload, $now);

                $this->finishAdventure($data['advid']);
                $processed++;
                continue;
            }

            /* ---- Hero survives: apply rewards ---- */
            $heroItems = new HeroItems();

            // XP with helmet bonus; level-up handled by Automation::updateHero().
            $bonuses = $heroItems->getBonuses($uid);
            $xpGain  = (int) floor($exp * (100 + (int) $bonuses[HB_XP]) / 100);
            $database->modifyHeroXp('experience', $xpGain, (int) $hero['heroid']);

            // Health loss.
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "hero SET health = ? WHERE heroid = ? LIMIT 1"
            );
            $heroid = (int) $hero['heroid'];
            $stmt->bind_param('di', $newHealth, $heroid);
            $stmt->execute();
            $stmt->close();

            // Silver + item drop.
            if ($silver > 0) {
                $heroItems->addSilver($uid, $silver);
            }
            if ($itemId > 0) {
                $heroItems->addItem($uid, $itemId, $itemQty);
            }

            /* ---- Return movement carries the resource loot home ---- */
            // Same travel time back as out: reuse the adventure's stored one-way duration.
            $legDuration    = $this->travelLegDuration($data);
            $stmt = $this->db->prepare(
                "INSERT INTO " . TB_PREFIX . "movement
                        (sort_type, `from`, `to`, ref, ref2, starttime, endtime, proc, send, wood, clay, iron, crop, marker)
                 VALUES (?, ?, ?, ?, 0, ?, ?, 0, 1, ?, ?, ?, ?, 0)"
            );
            $sortType = MOVEMENT_ADVENTURE_BACK;
            $fromSite = (int) $data['to']; $toHome = (int) $data['from'];
            $advid    = (int) $data['advid'];
            $end      = $now + $legDuration;
            $stmt->bind_param('iiiiiiiiii', $sortType, $fromSite, $toHome, $advid, $now, $end, $wood, $clay, $iron, $crop);
            $stmt->execute();
            $stmt->close();

            /* ---- Report (ntype 26) ---- */
            $payload = 'difficulty=' . (int) $data['difficulty']
                     . '&exp=' . $xpGain . '&silver=' . $silver . '&hp=' . $hpLoss
                     . '&wood=' . $wood . '&clay=' . $clay . '&iron=' . $iron . '&crop=' . $crop;
            if ($itemId > 0) {
                $payload .= '&itemid=' . $itemId . '&itemqty=' . $itemQty;
            }
            $database->addNotice($uid, $toHome, 0, NTYPE_ADVENTURE_REPORT,
                'Hero returned from an adventure', $payload, $now);

            $this->finishAdventure($data['advid']);
            $processed++;
        }
        return $processed;
    }

    /**
     * Process heroes RETURNING home (sort_type 21): hero re-enters units.hero,
     * resource loot is credited to the village.
     */
    public function processReturns()
    {
        global $database;
        $now = time();

        $q = "SELECT moveid, `from`, `to`, wood, clay, iron, crop
                FROM " . TB_PREFIX . "movement
               WHERE sort_type = " . (int) MOVEMENT_ADVENTURE_BACK . "
                 AND proc = 0 AND endtime < $now";
        $rows = $database->query_return($q);
        if (!$rows || !count($rows)) {
            return 0;
        }

        $processed = 0;
        foreach ($rows as $data) {
            if (!$this->claimMovement($data['moveid'])) {
                continue;
            }

            $home = (int) $data['to'];

            // Hero is home again.
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "units SET hero = hero + 1 WHERE vref = ? LIMIT 1"
            );
            $stmt->bind_param('i', $home);
            $stmt->execute();
            $stmt->close();

            // Credit the loot (same pattern as returnunitsComplete).
            if ($data['wood'] + $data['clay'] + $data['iron'] + $data['crop'] > 0) {
                $database->modifyResource($home, $data['wood'], $data['clay'], $data['iron'], $data['crop'], 1);
                $database->addStarvationData($home);
            }
            $processed++;
        }
        return $processed;
    }

    /**
     * Roll one random piece of EQUIPMENT. Universal gear (helmets, armors,
     * boots, horses, left-hand) drops for everyone; right-hand WEAPONS only
     * drop for the owner's own tribe (T4 behavior - a Roman never finds a
     * Teuton club). Tier picked by 'equip_tier_weights' (T1 common, T3 very
     * rare), then a uniform pick inside that tier. Returns an itemid, or 0
     * if the rolled tier happens to be empty (defensive; never true with
     * the shipped catalog).
     */
    public function rollEquipment($uid = 0)
    {
        global $database, $heroItemCatalog, $heroAdventureConfig;

        $tribe = ((int) $uid > 0) ? (int) $database->getUserField((int) $uid, 'tribe', 0) : 0;

        $weights = $heroAdventureConfig['equip_tier_weights'];
        $roll = mt_rand(1, 100); $acc = 0; $tier = 1;
        foreach ($weights as $t => $w) {
            $acc += (int) $w;
            if ($roll <= $acc) { $tier = (int) $t; break; }
        }

        $pool = array();
        foreach ($heroItemCatalog as $iid => $def) {
            if ((int) $def['slot'] === HSLOT_BAG || (int) $def['tier'] !== $tier) {
                continue;
            }
            $itemTribe = heroItemTribe($iid);
            if ($itemTribe !== 0 && $tribe > 0 && $itemTribe !== $tribe) {
                continue; // foreign-tribe weapon
            }
            $pool[] = $iid;
        }
        return count($pool) ? (int) $pool[array_rand($pool)] : 0;
    }

    /* =========================================================================
     *  INTERNALS
     * ===================================================================== */

    /**
     * Travel time in seconds for a given distance, honoring equipment:
     * horse replaces the on-foot base speed, spurs add on top (only with a
     * horse - already enforced inside HeroItems::getBonuses()).
     */
    public function travelSeconds($uid, $distance)
    {
        $heroItems = new HeroItems();
        $bonuses   = $heroItems->getBonuses((int) $uid);

        $speed = ((int) $bonuses[HB_HORSE_SPEED] > 0)
            ? (int) $bonuses[HB_HORSE_SPEED] + (int) $bonuses[HB_MOUNT_SPEED]
            : self::BASE_HERO_SPEED;

        $increase = defined('INCREASE_SPEED') ? max(1, (int) INCREASE_SPEED) : 1;
        return max(60, (int) round($distance / $speed * 3600 / $increase));
    }

    /** Duration of the just-finished leg (endtime - starttime is not selected; use stored offer duration). */
    private function travelLegDuration($data)
    {
        // The return leg mirrors the outbound one. We recompute from the
        // adventure's stored one-way duration to avoid drift when Automation
        // runs late (endtime long in the past).
        $stmt = $this->db->prepare(
            "SELECT duration FROM " . TB_PREFIX . "hero_adventure WHERE id = ? LIMIT 1"
        );
        $advid = (int) $data['advid'];
        $stmt->bind_param('i', $advid);
        $stmt->execute();
        $stmt->bind_result($duration);
        $found = $stmt->fetch();
        $stmt->close();
        return $found ? max(60, (int) $duration) : 3600;
    }

    /** Same claim pattern as Automation::claimMovementRecord (race-safe). */
    private function claimMovement($moveid)
    {
        $moveid = (int) $moveid;
        if ($moveid <= 0) {
            return false;
        }
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "movement SET proc = 1 WHERE moveid = ? AND proc = 0 LIMIT 1"
        );
        $stmt->bind_param('i', $moveid);
        $stmt->execute();
        $ok = $stmt->affected_rows === 1;
        $stmt->close();
        return $ok;
    }

    private function finishAdventure($advid)
    {
        $advid = (int) $advid;
        $stmt  = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "hero_adventure SET status = 2 WHERE id = ? LIMIT 1"
        );
        $stmt->bind_param('i', $advid);
        $stmt->execute();
        $stmt->close();
    }

    private function getLivingHero($uid)
    {
        $uid  = (int) $uid;
        $stmt = $this->db->prepare(
            "SELECT heroid, uid, unit, wref, level, experience, health, dead
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
