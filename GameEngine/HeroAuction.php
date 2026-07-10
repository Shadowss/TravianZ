<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HeroAuction.php                                           ##
##  Type           : T4 Hero port - auction house backend (Phase 4)            ##
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
##  T4-style auction house with PROXY BIDDING (eBay model):                    ##
##    - a bid is a secret MAXIMUM (bid_max); the visible price                 ##
##      (silver_current) only rises to (loser's max + 1), capped at the        ##
##      winner's max.                                                          ##
##                                                                             ##
##  SILVER ESCROW MODEL (documented invariant):                                ##
##    - when a bidder becomes top bidder, their FULL bid_max is deducted;      ##
##    - when outbid, their full bid_max is refunded immediately;               ##
##    - at finalization the winner is refunded (bid_max - silver_current),     ##
##      so they only ever pay the visible price.                               ##
##    => at any moment: sum of all player silver + escrowed bid_max of top     ##
##       bidders is constant (minus the seller fee at finalization).           ##
##                                                                             ##
##  SELLER FEE: player sellers receive silver_current minus AUCTION_FEE_PCT    ##
##  (10%, T4 convention). NPC-seller (seller = 0) proceeds vanish (silver      ##
##  sink). Unsold player items are returned to the seller's inventory.         ##
##                                                                             ##
##  No cancellation once listed (T4 convention) - flagged, not implemented.    ##
##                                                                             ##
#################################################################################

class HeroAuction
{
    /** Seller fee percent taken from the hammer price (player sellers only). */
    const AUCTION_FEE_PCT = 10;

    /** Minimum bid increment over the visible price. */
    const MIN_INCREMENT = 1;

    /** Allowed listing durations, seconds (4h / 8h / 24h like T4). */
    public static $allowedDurations = array(14400, 28800, 86400);

    /** How many NPC auctions to keep open at once. */
    const NPC_OPEN_TARGET = 10;

    /** NPC listing duration: 8 hours. */
    const NPC_DURATION = 28800;

    /** status values (mirror the auction table docs from Phase 1) */
    const ST_OPEN      = 0;
    const ST_SOLD      = 1; // reserved intermediate state; finalization goes straight to 2
    const ST_PROCESSED = 2;
    const ST_EXPIRED   = 3;

    /** result codes for placeBid() / createAuction() */
    const BID_OK           = 1;
    const BID_OUTBID       = 2;  // accepted, but instantly below the holder's secret max
    const BID_INVALID      = 0;  // bad auction/own auction/too low
    const BID_NO_SILVER    = -1;

    /** @var mysqli */
    private $db;

    public function __construct()
    {
        global $database;
        $this->db = $database->dblink;

        global $heroItemCatalog;
        if (!isset($heroItemCatalog)) {
            include_once __DIR__ . '/Data/hero_items.php';
        }
    }

    /* =========================================================================
     *  READS
     * ===================================================================== */

    /** All open, unexpired auctions (newest ending first optional; default: ending soonest). */
    public function getOpenAuctions($limit = 50)
    {
        $now = time(); $limit = max(1, (int) $limit);
        $stmt = $this->db->prepare(
            "SELECT id, seller, itemid, slot, stat_value, quantity,
                    silver_start, silver_current, bidder, created, time_end, status
               FROM " . TB_PREFIX . "auction
              WHERE status = " . self::ST_OPEN . " AND time_end > ?
              ORDER BY time_end ASC LIMIT ?"
        );
        $stmt->bind_param('ii', $now, $limit);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = array();
        while ($row = $res->fetch_assoc()) {
            $row['name'] = heroItemName($row['itemid']);
            // bid_max intentionally NOT selected - it's the bidder's secret.
            $out[] = $row;
        }
        $stmt->close();
        return $out;
    }

    /** Auctions where $uid is the current top bidder. */
    public function getMyBids($uid)
    {
        $uid = (int) $uid; $now = time();
        $stmt = $this->db->prepare(
            "SELECT id, seller, itemid, quantity, silver_current, bid_max, time_end
               FROM " . TB_PREFIX . "auction
              WHERE bidder = ? AND status = " . self::ST_OPEN . " AND time_end > ?
              ORDER BY time_end ASC"
        );
        $stmt->bind_param('ii', $uid, $now);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = array();
        while ($row = $res->fetch_assoc()) {
            $row['name'] = heroItemName($row['itemid']);
            $out[] = $row;
        }
        $stmt->close();
        return $out;
    }

    /** Open auctions listed by $uid. */
    public function getMySales($uid)
    {
        $uid = (int) $uid;
        $stmt = $this->db->prepare(
            "SELECT id, itemid, quantity, silver_start, silver_current, bidder, time_end, status
               FROM " . TB_PREFIX . "auction
              WHERE seller = ? AND status = " . self::ST_OPEN . "
              ORDER BY time_end ASC"
        );
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = array();
        while ($row = $res->fetch_assoc()) {
            $row['name'] = heroItemName($row['itemid']);
            $out[] = $row;
        }
        $stmt->close();
        return $out;
    }

    /* =========================================================================
     *  LISTING
     * ===================================================================== */

    /**
     * List an owned, UNEQUIPPED item (or part of a consumable stack).
     * The item leaves the inventory immediately (escrowed in the auction row).
     * Returns the new auction id, or 0 on failure.
     */
    public function createAuction($uid, $inventoryRowId, $quantity, $startPrice, $duration)
    {
        $uid = (int) $uid; $inventoryRowId = (int) $inventoryRowId;
        $quantity = max(1, (int) $quantity);
        $startPrice = max(1, (int) $startPrice);
        $duration = (int) $duration;

        if (!in_array($duration, self::$allowedDurations, true)) {
            return 0;
        }

        $heroItems = new HeroItems();
        $row = null;
        foreach ($heroItems->getInventory($uid) as $r) {
            if ((int) $r['id'] === $inventoryRowId) { $row = $r; break; }
        }
        // Must exist, be catalog-known, unequipped, and cover the quantity.
        if (!$row || $row['orphan'] || (int) $row['equipped'] === 1 || (int) $row['quantity'] < $quantity) {
            return 0;
        }
        // Gear always lists as a single piece.
        if ((int) $row['def']['slot'] !== HSLOT_BAG) {
            $quantity = 1;
        }

        // Take the item out of the inventory first (race-safe decrement inside).
        if (!$heroItems->removeItem($uid, $inventoryRowId, $quantity)) {
            return 0;
        }

        $now = time(); $end = $now + $duration;
        $itemid = (int) $row['itemid']; $slot = (int) $row['def']['slot'];
        $statValue = (int) $row['stat_value'];

        $stmt = $this->db->prepare(
            "INSERT INTO " . TB_PREFIX . "auction
                    (seller, itemid, slot, stat_value, quantity,
                     silver_start, silver_current, bidder, bid_max, created, time_end, status)
             VALUES (?, ?, ?, ?, ?, ?, ?, 0, 0, ?, ?, " . self::ST_OPEN . ")"
        );
        $stmt->bind_param('iiiiiiiii', $uid, $itemid, $slot, $statValue, $quantity,
            $startPrice, $startPrice, $now, $end);
        $stmt->execute();
        $auctionId = (int) $stmt->insert_id;
        $stmt->close();

        return $auctionId;
    }

    /* =========================================================================
     *  BIDDING (proxy model)
     * ===================================================================== */

    /**
     * Place a maximum bid. Returns a BID_* code.
     *
     * Escrow choreography (all conditional statements, race-safe):
     *  1. take $maxBid silver from the bidder (refused if balance is short);
     *  2. try to become top bidder atomically
     *     (WHERE bid_max < $maxBid guards the proxy comparison);
     *  3a. success -> refund the PREVIOUS top bidder's full escrow;
     *  3b. failure -> we lost against the holder's secret max: bump the
     *      visible price to min(holderMax, ourMax + 1) and refund ourselves.
     */
    public function placeBid($uid, $auctionId, $maxBid)
    {
        $uid = (int) $uid; $auctionId = (int) $auctionId; $maxBid = (int) $maxBid;
        $now = time();

        // Snapshot for validation (authoritative checks are in the UPDATEs).
        // bid_max is only used for the self-raise delta below - it is the
        // caller's OWN secret in that case, never exposed to rivals.
        $stmt = $this->db->prepare(
            "SELECT seller, silver_current, bidder, bid_max FROM " . TB_PREFIX . "auction
              WHERE id = ? AND status = " . self::ST_OPEN . " AND time_end > ? LIMIT 1"
        );
        $stmt->bind_param('ii', $auctionId, $now);
        $stmt->execute();
        $res = $stmt->get_result();
        $auction = $res->fetch_assoc();
        $stmt->close();

        if (!$auction || (int) $auction['seller'] === $uid) {
            return self::BID_INVALID;
        }
        // A fresh auction (no bidder) can be won AT the start price;
        // an active one needs current + increment.
        $minBid = (int) $auction['silver_current']
                + ((int) $auction['bidder'] > 0 ? self::MIN_INCREMENT : 0);
        if ($maxBid < $minBid) {
            return self::BID_INVALID;
        }
        // Self-raise: the old escrow (old bid_max) is already held, so only
        // the difference is taken; a raise below the current max is pointless.
        $selfRaise = ((int) $auction['bidder'] === $uid);
        if ($selfRaise && $maxBid <= (int) $auction['bid_max']) {
            return self::BID_INVALID;
        }
        $escrow = $selfRaise ? $maxBid - (int) $auction['bid_max'] : $maxBid;

        $heroItems = new HeroItems();

        // 1. escrow (conditional - fails on insufficient silver).
        if (!$heroItems->spendSilver($uid, $escrow)) {
            return self::BID_NO_SILVER;
        }

        // 2. capture the current holder as the refund target, then claim.
        //    Correctness anchor is the conditional UPDATE below - this read
        //    only records who to refund if we displace them.
        $stmt = $this->db->prepare(
            "SELECT bidder, bid_max FROM " . TB_PREFIX . "auction WHERE id = ? LIMIT 1"
        );
        $stmt->bind_param('i', $auctionId);
        $stmt->execute();
        $res  = $stmt->get_result();
        $prev = $res->fetch_assoc();
        $stmt->close();

        if ($selfRaise) {
            // Deepening our own secret max never moves the visible price and
            // never refunds anyone - the old escrow stays held, only the
            // delta was added above.
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "auction
                    SET bid_max = ?
                  WHERE id = ? AND status = " . self::ST_OPEN . " AND time_end > ?
                    AND bidder = ? AND bid_max < ?"
            );
            $stmt->bind_param('iiiii', $maxBid, $auctionId, $now, $uid, $maxBid);
            $stmt->execute();
            $won = $stmt->affected_rows > 0;
            $stmt->close();

            if ($won) {
                return self::BID_OK;
            }
            // Race lost: a rival displaced us between snapshot and update, so
            // their winning path already refunded our OLD escrow - the delta
            // is all we still hold. Return it.
            $heroItems->addSilver($uid, $escrow);
            return self::BID_OUTBID;
        }

        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "auction
                SET silver_current = LEAST(?, GREATEST(silver_current, bid_max + " . self::MIN_INCREMENT . ")),
                    bidder = ?, bid_max = ?
              WHERE id = ? AND status = " . self::ST_OPEN . " AND time_end > ?
                AND bid_max < ? AND seller <> ? AND bidder <> ?"
        );
        $stmt->bind_param('iiiiiiii', $maxBid, $uid, $maxBid, $auctionId, $now, $maxBid, $uid, $uid);
        $stmt->execute();
        $won = $stmt->affected_rows > 0;
        $stmt->close();

        if ($won) {
            // 3a. refund the displaced bidder's full escrow.
            if ($prev && (int) $prev['bidder'] > 0 && (int) $prev['bidder'] !== $uid && (int) $prev['bid_max'] > 0) {
                $heroItems->addSilver((int) $prev['bidder'], (int) $prev['bid_max']);
            }
            return self::BID_OK;
        }

        // 3b. lost against the holder's secret max (or the auction closed in
        //     the meantime): bump the visible price if still open, refund us.
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "auction
                SET silver_current = LEAST(bid_max, ? + " . self::MIN_INCREMENT . ")
              WHERE id = ? AND status = " . self::ST_OPEN . " AND time_end > ? AND bid_max >= ?"
        );
        $stmt->bind_param('iiii', $maxBid, $auctionId, $now, $maxBid);
        $stmt->execute();
        $stmt->close();

        $heroItems->addSilver($uid, $escrow);
        return self::BID_OUTBID;
    }

    /* =========================================================================
     *  AUTOMATION PROCESSORS
     * ===================================================================== */

    /**
     * Finalize ended auctions:
     *  - with a bidder: award the item, refund (bid_max - silver_current) to
     *    the winner, pay the player seller (minus fee), file reports;
     *  - without: return the item to a player seller, mark expired.
     * NPC (seller 0) items simply vanish when unsold; NPC proceeds vanish too.
     */
    public function processFinished()
    {
        global $database;
        $now = time();

        $q = "SELECT id, seller, itemid, stat_value, quantity,
                     silver_current, bidder, bid_max
                FROM " . TB_PREFIX . "auction
               WHERE status = " . self::ST_OPEN . " AND time_end <= $now";
        $rows = $database->query_return($q);
        if (!$rows || !count($rows)) {
            return 0;
        }

        $heroItems = new HeroItems();
        $processed = 0;

        foreach ($rows as $a) {
            // Claim the row (same race-safe pattern as movement claiming).
            $stmt = $this->db->prepare(
                "UPDATE " . TB_PREFIX . "auction SET status = " . self::ST_PROCESSED . "
                  WHERE id = ? AND status = " . self::ST_OPEN . " LIMIT 1"
            );
            $aid = (int) $a['id'];
            $stmt->bind_param('i', $aid);
            $stmt->execute();
            $claimed = $stmt->affected_rows > 0;
            $stmt->close();
            if (!$claimed) {
                continue;
            }

            $bidder = (int) $a['bidder'];
            $seller = (int) $a['seller'];
            $price  = (int) $a['silver_current'];

            if ($bidder > 0) {
                /* ---- SOLD ---- */
                $heroItems->addItem($bidder, (int) $a['itemid'], (int) $a['quantity'], (int) $a['stat_value']);

                // Winner escrowed bid_max; they only pay the hammer price.
                $refund = (int) $a['bid_max'] - $price;
                if ($refund > 0) {
                    $heroItems->addSilver($bidder, $refund);
                }

                // Player seller gets the price minus the fee; NPC proceeds sink.
                if ($seller > 0) {
                    $fee = (int) floor($price * self::AUCTION_FEE_PCT / 100);
                    $heroItems->addSilver($seller, $price - $fee);
                    $database->addNotice($seller, 0, 0, NTYPE_AUCTION_REPORT,
                        'Auction sold',
                        'role=seller&itemid=' . (int) $a['itemid'] . '&qty=' . (int) $a['quantity']
                        . '&price=' . $price . '&fee=' . $fee, $now);
                }

                $database->addNotice($bidder, 0, 0, NTYPE_AUCTION_REPORT,
                    'Auction won',
                    'role=winner&itemid=' . (int) $a['itemid'] . '&qty=' . (int) $a['quantity']
                    . '&price=' . $price . '&refund=' . max(0, $refund), $now);
            } else {
                /* ---- UNSOLD ---- */
                if ($seller > 0) {
                    $heroItems->addItem($seller, (int) $a['itemid'], (int) $a['quantity'], (int) $a['stat_value']);
                    $database->addNotice($seller, 0, 0, NTYPE_AUCTION_REPORT,
                        'Auction expired',
                        'role=seller&expired=1&itemid=' . (int) $a['itemid'] . '&qty=' . (int) $a['quantity'], $now);
                }
                // Correct the claimed status for the unsold case.
                $stmt = $this->db->prepare(
                    "UPDATE " . TB_PREFIX . "auction SET status = " . self::ST_EXPIRED . " WHERE id = ? LIMIT 1"
                );
                $stmt->bind_param('i', $aid);
                $stmt->execute();
                $stmt->close();
            }
            $processed++;
        }
        return $processed;
    }

    /**
     * ADMIN-ONLY: cancel an open auction outright (Phase 7 admin panel).
     * Player-facing cancellation intentionally does not exist (T4 convention);
     * this is the moderation escape hatch. Refunds the top bidder's full
     * escrow and returns the item to a player seller (NPC items vanish).
     * Returns true when an open auction was cancelled.
     */
    public function adminCancel($auctionId)
    {
        $auctionId = (int) $auctionId;

        // Snapshot before claiming so we know who to refund.
        $stmt = $this->db->prepare(
            "SELECT seller, itemid, stat_value, quantity, bidder, bid_max
               FROM " . TB_PREFIX . "auction
              WHERE id = ? AND status = " . self::ST_OPEN . " LIMIT 1"
        );
        $stmt->bind_param('i', $auctionId);
        $stmt->execute();
        $res = $stmt->get_result();
        $a   = $res->fetch_assoc();
        $stmt->close();
        if (!$a) {
            return false;
        }

        // Race-safe claim straight to EXPIRED so processFinished can't touch it.
        $stmt = $this->db->prepare(
            "UPDATE " . TB_PREFIX . "auction SET status = " . self::ST_EXPIRED . "
              WHERE id = ? AND status = " . self::ST_OPEN . " LIMIT 1"
        );
        $stmt->bind_param('i', $auctionId);
        $stmt->execute();
        $claimed = $stmt->affected_rows > 0;
        $stmt->close();
        if (!$claimed) {
            return false;
        }

        $heroItems = new HeroItems();
        if ((int) $a['bidder'] > 0 && (int) $a['bid_max'] > 0) {
            $heroItems->addSilver((int) $a['bidder'], (int) $a['bid_max']);
        }
        if ((int) $a['seller'] > 0) {
            $heroItems->addItem((int) $a['seller'], (int) $a['itemid'], (int) $a['quantity'], (int) $a['stat_value']);
        }
        return true;
    }

    /**
     * Keep ~NPC_OPEN_TARGET NPC-seller auctions open so the market always has
     * stock. Random catalog items; consumables list in small stacks.
     * Start price scales with tier so tier-3 gear stays expensive.
     */
    public function seedNpcAuctions()
    {
        global $heroItemCatalog;
        $now = time();

        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM " . TB_PREFIX . "auction
              WHERE seller = 0 AND status = " . self::ST_OPEN . " AND time_end > ?"
        );
        $stmt->bind_param('i', $now);
        $stmt->execute();
        $stmt->bind_result($open);
        $stmt->fetch();
        $stmt->close();

        $need = self::NPC_OPEN_TARGET - (int) $open;
        if ($need <= 0) {
            return 0;
        }

        $ids = array_keys($heroItemCatalog);
        $created = 0;
        for ($i = 0; $i < $need; $i++) {
            $itemid = (int) $ids[array_rand($ids)];
            $def    = $heroItemCatalog[$itemid];
            $isBag  = ((int) $def['slot'] === HSLOT_BAG);
            $qty    = $isBag ? mt_rand(3, 15) : 1;
            // Start price: tier-scaled for gear, per-piece for consumables.
            $start  = $isBag ? $qty * mt_rand(2, 5) : (int) $def['tier'] * mt_rand(40, 80);
            $end    = $now + self::NPC_DURATION;
            $slot   = (int) $def['slot'];

            $stmt = $this->db->prepare(
                "INSERT INTO " . TB_PREFIX . "auction
                        (seller, itemid, slot, stat_value, quantity,
                         silver_start, silver_current, bidder, bid_max, created, time_end, status)
                 VALUES (0, ?, ?, 0, ?, ?, ?, 0, 0, ?, ?, " . self::ST_OPEN . ")"
            );
            $stmt->bind_param('iiiiiii', $itemid, $slot, $qty, $start, $start, $now, $end);
            $stmt->execute();
            $stmt->close();
            $created++;
        }
        return $created;
    }
}
