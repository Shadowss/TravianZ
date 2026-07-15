<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : PushProtection.php                                        ##
##  Type           : Push-Protection engine (Admin/Multihunter dashboard)      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow (Cătălin)                                          ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

/**
 * PushProtection
 * -------------------------------------------------------------------------
 * Visibility + control layer over inter-player resource transfers, modelled
 * on Travian Legends' pushing-protection rules:
 *
 *   - Every COMPLETED marketplace delivery between DIFFERENT players is logged
 *     to resource_transfer_log (hook in Automation::marketCompleteDeliveries).
 *   - For each receiving player we compute, over a rolling 7-day window, the
 *     total resources RECEIVED FROM OTHERS ("7-day balance").
 *   - We compute an automatic limit from the player's hourly production
 *     ("hours of production" model: limit = HOURS_ALLOWED * net hourly prod).
 *   - Exceptions (like TL): WW villages may be supplied without limit; artefact
 *     villages are crop-supply exceptions. These are surfaced as suggested
 *     overrides, applied by an admin with one click (push_override table).
 *
 * This is a DASHBOARD + override store. It does not block transfers by itself;
 * an optional enforcement hook (allowedToReceive) is provided for the market
 * send flow if you later want hard enforcement.
 *
 * Self-contained (static, resolves DB link from globals) so both Automation
 * (logging) and the admin panel (dashboard) can use it without wiring.
 */
class PushProtection
{
    /* ---- Tunables ------------------------------------------------------ */

    /** Rolling balance window, in days (TL uses 7). */
    const WINDOW_DAYS = 7;

    /** Aggregate allowance: how many HOURS of the receiver's own production may
     *  be received from other players within the window. TL varies this by
     *  relationship (1 / 14 / 21h); this single aggregate cap is a moderation
     *  simplification — tune to taste. */
    const HOURS_ALLOWED = 24;

    /** Percent-of-limit at which a player is flagged "near limit". */
    const NEAR_LIMIT_PCT = 80;

    /** Override modes stored in push_override.mode. */
    const OV_NONE      = 0; // no override -> automatic limit applies
    const OV_UNLIMITED = 1; // exempt (WW villages, trusted) -> no limit
    const OV_CUSTOM    = 3; // custom_limit is an absolute cap (resources / window)

    /* ---- DB plumbing --------------------------------------------------- */

    private static function link()
    {
        if (isset($GLOBALS['link']) && $GLOBALS['link']) {
            return $GLOBALS['link'];
        }
        if (isset($GLOBALS['database']) && isset($GLOBALS['database']->dblink)) {
            return $GLOBALS['database']->dblink;
        }
        return null;
    }

    /** Create both tables if missing (lazy — works without re-running installer). */
    public static function ensureSchema()
    {
        $link = self::link();
        if (!$link) {
            return;
        }
        @mysqli_query($link, "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "resource_transfer_log` (
            `id`        int(11) NOT NULL AUTO_INCREMENT,
            `from_vref` int(11) NOT NULL DEFAULT 0,
            `to_vref`   int(11) NOT NULL DEFAULT 0,
            `from_uid`  int(11) NOT NULL DEFAULT 0,
            `to_uid`    int(11) NOT NULL DEFAULT 0,
            `wood`      int(11) NOT NULL DEFAULT 0,
            `clay`      int(11) NOT NULL DEFAULT 0,
            `iron`      int(11) NOT NULL DEFAULT 0,
            `crop`      int(11) NOT NULL DEFAULT 0,
            `time`      int(11) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `to_uid_time` (`to_uid`,`time`),
            KEY `from_uid_time` (`from_uid`,`time`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        @mysqli_query($link, "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "push_override` (
            `uid`          int(11) NOT NULL,
            `mode`         tinyint(2) NOT NULL DEFAULT 0,
            `custom_limit` bigint(20) NOT NULL DEFAULT 0,
            `note`         varchar(255) NOT NULL DEFAULT '',
            `set_by`       int(11) NOT NULL DEFAULT 0,
            `time`         int(11) NOT NULL DEFAULT 0,
            PRIMARY KEY (`uid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    /* ---- Data collection (called from Automation on delivery) ---------- */

    /**
     * Log one completed cross-player resource delivery. Best-effort; never
     * throws. Skips same-owner transfers and system accounts.
     */
    public static function logTransfer($fromVref, $toVref, $fromUid, $toUid,
        $wood, $clay, $iron, $crop, $time = 0)
    {
        try {
            $fromUid = (int) $fromUid;
            $toUid   = (int) $toUid;
            if ($fromUid === $toUid || $fromUid <= 3 || $toUid <= 3) {
                return; // own transfer or system account
            }
            $wood = (int) $wood; $clay = (int) $clay; $iron = (int) $iron; $crop = (int) $crop;
            if (($wood + $clay + $iron + $crop) <= 0) {
                return;
            }
            $link = self::link();
            if (!$link) {
                return;
            }
            self::ensureSchema();

            $fromVref = (int) $fromVref;
            $toVref   = (int) $toVref;
            $time     = $time > 0 ? (int) $time : time();

            $stmt = mysqli_prepare($link,
                "INSERT INTO `" . TB_PREFIX . "resource_transfer_log`
                 (from_vref, to_vref, from_uid, to_uid, wood, clay, iron, crop, `time`)
                 VALUES (?,?,?,?,?,?,?,?,?)");
            if (!$stmt) {
                return;
            }
            mysqli_stmt_bind_param($stmt, 'iiiiiiiii',
                $fromVref, $toVref, $fromUid, $toUid, $wood, $clay, $iron, $crop, $time);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } catch (\Throwable $e) {
            // never break the automation cron
        }
    }

    /* ---- Overrides ----------------------------------------------------- */

    /** All overrides as uid => ['mode','custom_limit','note','set_by','time']. */
    public static function overrides()
    {
        $link = self::link();
        $out = [];
        if (!$link) {
            return $out;
        }
        self::ensureSchema();
        $r = @mysqli_query($link, "SELECT * FROM `" . TB_PREFIX . "push_override`");
        if ($r) {
            while ($row = mysqli_fetch_assoc($r)) {
                $out[(int) $row['uid']] = $row;
            }
            mysqli_free_result($r);
        }
        return $out;
    }

    /** Insert/update or clear an override. mode OV_NONE removes it. */
    public static function setOverride($uid, $mode, $customLimit, $note, $adminId)
    {
        $link = self::link();
        if (!$link) {
            return false;
        }
        self::ensureSchema();

        $uid    = (int) $uid;
        $mode   = (int) $mode;
        $custom = (int) $customLimit;
        $admin  = (int) $adminId;
        $now    = time();

        if ($uid <= 3) {
            return false;
        }

        if ($mode === self::OV_NONE) {
            $stmt = mysqli_prepare($link,
                "DELETE FROM `" . TB_PREFIX . "push_override` WHERE uid = ?");
            if (!$stmt) { return false; }
            mysqli_stmt_bind_param($stmt, 'i', $uid);
            $ok = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $ok;
        }

        $note = substr((string) $note, 0, 255);
        $stmt = mysqli_prepare($link,
            "INSERT INTO `" . TB_PREFIX . "push_override` (uid, mode, custom_limit, note, set_by, `time`)
             VALUES (?,?,?,?,?,?)
             ON DUPLICATE KEY UPDATE mode=VALUES(mode), custom_limit=VALUES(custom_limit),
                                     note=VALUES(note), set_by=VALUES(set_by), `time`=VALUES(`time`)");
        if (!$stmt) { return false; }
        mysqli_stmt_bind_param($stmt, 'iiisii', $uid, $mode, $custom, $note, $admin, $now);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }

    /* ---- Exception sets (WW / artefact villages) ----------------------- */

    /** Owners holding at least one WW village (fdata.f99t = 40 = WONDER). */
    public static function wwOwners()
    {
        $link = self::link();
        $out = [];
        if (!$link) { return $out; }
        $r = @mysqli_query($link,
            "SELECT DISTINCT v.owner
             FROM `" . TB_PREFIX . "vdata` v
             JOIN `" . TB_PREFIX . "fdata` f ON v.wref = f.vref
             WHERE f.f99t = 40 AND v.owner > 3");
        if ($r) {
            while ($row = mysqli_fetch_row($r)) { $out[(int) $row[0]] = true; }
            mysqli_free_result($r);
        }
        return $out;
    }

    /** Owners holding at least one active artefact. */
    public static function artefactOwners()
    {
        $link = self::link();
        $out = [];
        if (!$link) { return $out; }
        $r = @mysqli_query($link,
            "SELECT DISTINCT owner FROM `" . TB_PREFIX . "artefacts`
             WHERE active = 1 AND (del = 0 OR del IS NULL) AND owner > 3");
        if ($r) {
            while ($row = mysqli_fetch_row($r)) { $out[(int) $row[0]] = true; }
            mysqli_free_result($r);
        }
        return $out;
    }

    /* ---- Production model ---------------------------------------------- */

    /**
     * Net hourly production for a whole account (sum of all villages).
     * Wood+Clay+Iron + max(0, Crop - population). Uses the same field/factory
     * math as Village.php (base fields + factory %, x SPEED), but omits oasis /
     * hero / plus bonuses (not resolvable in a batch context) — a documented,
     * slightly conservative approximation. Returns int resources/hour.
     */
    public static function hourlyProduction($uid, $link = null)
    {
        $link = $link ?: self::link();
        if (!$link) { return 0; }

        $uid = (int) $uid;
        $total = 0;
        $r = @mysqli_query($link,
            "SELECT f.*, v.pop
             FROM `" . TB_PREFIX . "fdata` f
             JOIN `" . TB_PREFIX . "vdata` v ON v.wref = f.vref
             WHERE v.owner = " . $uid);
        if (!$r) { return 0; }
        while ($f = mysqli_fetch_assoc($r)) {
            list($w, $c, $i, $cr) = self::villageProd($f);
            $pop = (int) ($f['pop'] ?? 0);
            $cropNet = max(0, $cr - $pop);
            $total += $w + $c + $i + $cropNet;
        }
        mysqli_free_result($r);
        return (int) $total;
    }

    /** Per-village production [wood,clay,iron,crop] per hour from an fdata row. */
    private static function villageProd(array $f)
    {
        global $bid1, $bid2, $bid3, $bid4, $bid5, $bid6, $bid7, $bid8, $bid9;
        if (!isset($bid1)) {
            return [0, 0, 0, 0]; // buidata not loaded in this context
        }
        $wood = $clay = $iron = $crop = 0;
        $saw = $brick = $found = $mill = $bake = 0;

        for ($i = 1; $i <= 38; $i++) {
            $t  = (int) ($f["f{$i}t"] ?? 0);
            $lv = (int) ($f["f{$i}"] ?? 0);
            if     ($t === 1) { $wood += $bid1[$lv]['prod'] ?? 0; }
            elseif ($t === 2) { $clay += $bid2[$lv]['prod'] ?? 0; }
            elseif ($t === 3) { $iron += $bid3[$lv]['prod'] ?? 0; }
            elseif ($t === 4) { $crop += $bid4[$lv]['prod'] ?? 0; }
            elseif ($t === 5) { $saw   = $lv; }
            elseif ($t === 6) { $brick = $lv; }
            elseif ($t === 7) { $found = $lv; }
            elseif ($t === 8) { $mill  = $lv; }
            elseif ($t === 9) { $bake  = $lv; }
        }
        if ($saw)   { $wood += $wood / 100 * ($bid5[$saw]['attri'] ?? 0); }
        if ($brick) { $clay += $clay / 100 * ($bid6[$brick]['attri'] ?? 0); }
        if ($found) { $iron += $iron / 100 * ($bid7[$found]['attri'] ?? 0); }
        if ($mill || $bake) {
            $crop += $crop / 100 * (($bid8[$mill]['attri'] ?? 0) + ($bid9[$bake]['attri'] ?? 0));
        }
        $spd = defined('SPEED') ? SPEED : 1;
        return [
            (int) round($wood * $spd),
            (int) round($clay * $spd),
            (int) round($iron * $spd),
            (int) round($crop * $spd),
        ];
    }

    /* ---- 7-day balance ------------------------------------------------- */

    /**
     * Total resources each player RECEIVED FROM OTHERS in the window, keyed by
     * to_uid. Returns uid => ['total','wood','clay','iron','crop','senders'].
     */
    public static function receivedFromOthers($sinceTs, $link = null)
    {
        $link = $link ?: self::link();
        $out = [];
        if (!$link) { return $out; }
        self::ensureSchema();

        $r = @mysqli_query($link,
            "SELECT to_uid,
                    SUM(wood) w, SUM(clay) c, SUM(iron) i, SUM(crop) cr,
                    SUM(wood+clay+iron+crop) tot,
                    COUNT(DISTINCT from_uid) senders
             FROM `" . TB_PREFIX . "resource_transfer_log`
             WHERE `time` >= " . (int) $sinceTs . " AND from_uid <> to_uid
             GROUP BY to_uid");
        if ($r) {
            while ($row = mysqli_fetch_assoc($r)) {
                $out[(int) $row['to_uid']] = [
                    'total'   => (int) $row['tot'],
                    'wood'    => (int) $row['w'],
                    'clay'    => (int) $row['c'],
                    'iron'    => (int) $row['i'],
                    'crop'    => (int) $row['cr'],
                    'senders' => (int) $row['senders'],
                ];
            }
            mysqli_free_result($r);
        }
        return $out;
    }

    /* ---- Dashboard ----------------------------------------------------- */

    /**
     * Build the push-protection dashboard rows.
     *
     * @param array $opts 'days','hours','only' ('all'|'over'|'flagged').
     * @return array ['rows'=>..., 'window_days'=>..., 'hours_allowed'=>...]
     */
    public static function dashboard(array $opts = [])
    {
        $link = self::link();
        if (!$link) {
            return ['rows' => [], 'window_days' => self::WINDOW_DAYS, 'hours_allowed' => self::HOURS_ALLOWED];
        }
        self::ensureSchema();

        $days  = isset($opts['days'])  ? max(1, (int) $opts['days'])  : self::WINDOW_DAYS;
        $hours = isset($opts['hours']) ? max(1, (int) $opts['hours']) : self::HOURS_ALLOWED;
        $only  = $opts['only'] ?? 'all';
        $since = time() - $days * 86400;

        $received  = self::receivedFromOthers($since, $link);
        $overrides = self::overrides();
        $ww        = self::wwOwners();
        $arte      = self::artefactOwners();

        // Candidate set: anyone who received from others, plus flagged/override.
        $uids = [];
        foreach (array_keys($received)  as $u) { $uids[$u] = true; }
        foreach (array_keys($overrides) as $u) { $uids[$u] = true; }
        foreach (array_keys($ww)        as $u) { $uids[$u] = true; }
        foreach (array_keys($arte)      as $u) { $uids[$u] = true; }
        unset($uids[0]);

        if (empty($uids)) {
            return ['rows' => [], 'window_days' => $days, 'hours_allowed' => $hours];
        }

        // Names / pop / village count in one pass.
        $in = implode(',', array_map('intval', array_keys($uids)));
        $meta = [];
        $r = @mysqli_query($link,
            "SELECT u.id, u.username,
                    (SELECT COUNT(*) FROM `" . TB_PREFIX . "vdata` v WHERE v.owner = u.id) AS villages,
                    (SELECT COALESCE(SUM(v2.pop),0) FROM `" . TB_PREFIX . "vdata` v2 WHERE v2.owner = u.id) AS pop
             FROM `" . TB_PREFIX . "users` u WHERE u.id IN ($in)");
        if ($r) {
            while ($row = mysqli_fetch_assoc($r)) {
                $meta[(int) $row['id']] = $row;
            }
            mysqli_free_result($r);
        }

        $rows = [];
        foreach (array_keys($uids) as $uid) {
            $uid = (int) $uid;
            if ($uid <= 3 || !isset($meta[$uid])) {
                continue;
            }
            $rec  = $received[$uid]['total'] ?? 0;
            $prod = self::hourlyProduction($uid, $link);
            $autoLimit = $hours * $prod;

            $isWW   = isset($ww[$uid]);
            $isArte = isset($arte[$uid]);
            $ov     = $overrides[$uid] ?? null;

            // Effective limit + status.
            $unlimited = false;
            $effLimit  = $autoLimit;
            $ovLabel   = '';
            if ($ov) {
                $mode = (int) $ov['mode'];
                if ($mode === self::OV_UNLIMITED) {
                    $unlimited = true;
                    $ovLabel = 'Exempt (manual)';
                } elseif ($mode === self::OV_CUSTOM) {
                    $effLimit = (int) $ov['custom_limit'];
                    $ovLabel = 'Custom cap';
                }
            }

            if ($unlimited) {
                $pct = 0;
                $status = 'Exempt';
            } elseif ($effLimit <= 0) {
                $pct = $rec > 0 ? 999 : 0;
                $status = $rec > 0 ? 'Over' : 'OK';
            } else {
                $pct = (int) round($rec / $effLimit * 100);
                $status = $pct > 100 ? 'Over' : ($pct >= self::NEAR_LIMIT_PCT ? 'Near' : 'OK');
            }

            $flags = [];
            if ($isWW)   { $flags[] = 'WW village'; }
            if ($isArte) { $flags[] = 'Artefact village'; }

            $row = [
                'uid'        => $uid,
                'name'       => $meta[$uid]['username'],
                'villages'   => (int) $meta[$uid]['villages'],
                'pop'        => (int) $meta[$uid]['pop'],
                'prod_h'     => $prod,
                'auto_limit' => $autoLimit,
                'eff_limit'  => $unlimited ? -1 : $effLimit, // -1 = unlimited
                'received'   => $rec,
                'senders'    => $received[$uid]['senders'] ?? 0,
                'pct'        => $pct,
                'status'     => $status,
                'is_ww'      => $isWW,
                'is_arte'    => $isArte,
                'ov_mode'    => $ov ? (int) $ov['mode'] : self::OV_NONE,
                'ov_label'   => $ovLabel,
                'ov_note'    => $ov['note'] ?? '',
                'flags'      => $flags,
            ];

            if ($only === 'over' && $status !== 'Over') { continue; }
            if ($only === 'flagged' && !$isWW && !$isArte && !$ov) { continue; }

            $rows[] = $row;
        }

        // Sort: Over first, then by pct desc, then received desc.
        usort($rows, function ($a, $b) {
            $rank = ['Over' => 0, 'Near' => 1, 'OK' => 2, 'Exempt' => 3];
            $ra = $rank[$a['status']] ?? 4;
            $rb = $rank[$b['status']] ?? 4;
            if ($ra !== $rb) { return $ra <=> $rb; }
            if ($a['pct'] !== $b['pct']) { return $b['pct'] <=> $a['pct']; }
            return $b['received'] <=> $a['received'];
        });

        return ['rows' => $rows, 'window_days' => $days, 'hours_allowed' => $hours];
    }

    /* ---- Optional enforcement hook ------------------------------------ */

    /**
     * OPTIONAL hard-enforcement helper for the market send flow. Returns how
     * many total resources $toUid may still receive from others in the window
     * (PHP_INT_MAX when exempt). Not wired by default — call from Market when
     * you want to actually block over-limit deliveries.
     */
    public static function remainingAllowance($toUid, array $opts = [])
    {
        $link = self::link();
        if (!$link) { return PHP_INT_MAX; }

        $toUid = (int) $toUid;
        $days  = isset($opts['days'])  ? max(1, (int) $opts['days'])  : self::WINDOW_DAYS;
        $hours = isset($opts['hours']) ? max(1, (int) $opts['hours']) : self::HOURS_ALLOWED;
        $since = time() - $days * 86400;

        $ov = self::overrides()[$toUid] ?? null;
        if ($ov && (int) $ov['mode'] === self::OV_UNLIMITED) {
            return PHP_INT_MAX;
        }
        if (isset(self::wwOwners()[$toUid])) {
            return PHP_INT_MAX; // WW villages supplied without limit (TL rule)
        }

        $prod  = self::hourlyProduction($toUid, $link);
        $limit = ($ov && (int) $ov['mode'] === self::OV_CUSTOM)
            ? (int) $ov['custom_limit']
            : $hours * $prod;

        $rec = self::receivedFromOthers($since, $link)[$toUid]['total'] ?? 0;
        return max(0, $limit - $rec);
    }
}
