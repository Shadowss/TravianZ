<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : MultiAccount.php                                          ##
##  Type           : Multi-Account Detection engine (Admin/Multihunter tool)   ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow 		                                           ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

/**
 * MultiAccount
 * -------------------------------------------------------------------------
 * Heuristic multi-account (bot / pushing account) detection. It does NOT ban
 * anyone; it produces a ranked list of suspicious account PAIRS with a risk
 * score (0-100) and a breakdown of WHY, so a human (admin / multihunter) can
 * investigate.
 *
 * Data sources (all optional — the engine degrades gracefully):
 *   - login_log          : existing table (uid, ip, date). Gives shared-IP and
 *                          login-timing signals for history that predates this
 *                          feature.
 *   - mad_session        : NEW table written by recordSession() at every login.
 *                          Adds the User-Agent signal (login_log has no UA).
 *   - movement / send    : in-flight merchant transfers -> "currently pushing"
 *                          trade signal.
 *   - resource_transfer_log : if present (created by the Push-Protection phase),
 *                          gives a richer historical trade-flow signal. Used
 *                          automatically when the table exists.
 *
 * The engine is intentionally self-contained (static methods, resolves the DB
 * link from globals) so it can be called from both the in-game login flow and
 * the admin panel without wiring.
 */
class MultiAccount
{
    /* ---- Tunables (safe to adjust) ------------------------------------- */

    /** How far back to look, in days. */
    const WINDOW_DAYS = 30;

    /** Hard cap on login rows scanned per source (memory / runtime guard). */
    const MAX_ROWS = 60000;

    /** A shared key (IP / subnet / UA) used by MORE than this many accounts is
     *  treated as a public/NAT/proxy artefact: it still counts, but with a
     *  reduced weight and it never explodes pair generation. */
    const POPULAR_KEY_CAP = 12;

    /** Two logins closer than this (seconds) from the SAME IP look like one
     *  person switching accounts. */
    const SWITCH_WINDOW = 900; // 15 minutes

    /** Only pairs at or above this score are returned. */
    const MIN_REPORT_SCORE = 20;

    /** Max pairs returned to the UI. */
    const MAX_PAIRS = 150;

    /* ---- DB plumbing --------------------------------------------------- */

    /** Resolve the raw mysqli link from whatever context we run in. */
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

    /**
     * Create the mad_session table if it does not exist. Called lazily so the
     * feature works even on servers that never re-ran the installer.
     */
    public static function ensureSchema()
    {
        $link = self::link();
        if (!$link) {
            return;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "mad_session` (
            `id`         int(11)      NOT NULL AUTO_INCREMENT,
            `uid`        int(11)      NOT NULL,
            `ip`         varbinary(16) DEFAULT NULL,
            `ip_text`    varchar(45)  NOT NULL DEFAULT '',
            `ua_hash`    char(32)     NOT NULL DEFAULT '',
            `ua_text`    varchar(255) NOT NULL DEFAULT '',
            `login_time` int(11)      NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `uid` (`uid`),
            KEY `ip` (`ip`),
            KEY `ua_hash` (`ua_hash`),
            KEY `login_time` (`login_time`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        @mysqli_query($link, $sql);
    }

    /* ---- Data collection (called at login) ----------------------------- */

    /**
     * Record one login "session fingerprint". Best-effort: any failure is
     * swallowed so it can never block a login.
     *
     * @param int    $uid       User id.
     * @param string $ipText    Client IP (already resolved by the caller).
     * @param string $userAgent Raw User-Agent header ($_SERVER['HTTP_USER_AGENT']).
     */
    public static function recordSession($uid, $ipText, $userAgent)
    {
        try {
            $uid = (int) $uid;
            if ($uid <= 3) {
                return; // system accounts
            }

            $link = self::link();
            if (!$link) {
                return;
            }

            self::ensureSchema();

            $ipText = (string) $ipText;
            $packed = @inet_pton($ipText);
            if ($packed === false) {
                $packed = null;
            }
            $uaText = substr((string) $userAgent, 0, 255);
            $uaHash = md5($uaText);
            $now    = time();

            $stmt = mysqli_prepare(
                $link,
                "INSERT INTO `" . TB_PREFIX . "mad_session`
                 (uid, ip, ip_text, ua_hash, ua_text, login_time)
                 VALUES (?,?,?,?,?,?)"
            );
            if (!$stmt) {
                return;
            }
            // ip is binary -> bind as blob ('b') via send_long_data-free path:
            // mysqli lets us bind a string to a varbinary column with type 's'.
            $ipBind = $packed === null ? '' : $packed;
            mysqli_stmt_bind_param($stmt, 'issssi', $uid, $ipBind, $ipText, $uaHash, $uaText, $now);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } catch (\Throwable $e) {
            // never break login
        }
    }

    /* ---- Correlation / scoring ---------------------------------------- */

    /**
     * Build the ranked list of suspicious account pairs.
     *
     * @param array $opts  Optional overrides: 'days', 'min_score', 'focus_uid'.
     * @return array {
     *   'pairs'   => list of pair rows (see below), sorted by score desc,
     *   'scanned' => ['login_log'=>int, 'mad_session'=>int],
     *   'window_days' => int,
     *   'truncated' => bool,   // true if a source hit MAX_ROWS
     * }
     *
     * Each pair row:
     *   uid_a, name_a, uid_b, name_b, score (0-100), label,
     *   shared_ips, shared_subnets, shared_uas, switch_events,
     *   trade_gross, trade_dir, reasons (string[])
     */
    public static function riskPairs(array $opts = [])
    {
        $link = self::link();
        if (!$link) {
            return ['pairs' => [], 'scanned' => ['login_log' => 0, 'mad_session' => 0],
                    'window_days' => self::WINDOW_DAYS, 'truncated' => false];
        }
        self::ensureSchema();

        $days     = isset($opts['days']) ? max(1, (int) $opts['days']) : self::WINDOW_DAYS;
        $minScore = isset($opts['min_score']) ? (int) $opts['min_score'] : self::MIN_REPORT_SCORE;
        $focusUid = isset($opts['focus_uid']) ? (int) $opts['focus_uid'] : 0;
        $since    = time() - $days * 86400;

        // Per-uid aggregates and inverted indices.
        $ips     = [];   // uid => [ip => true]
        $subnets = [];   // uid => [subnet => true]
        $uas     = [];   // uid => [uaHash => true]
        $logins  = [];   // uid => [ [ts, ip], ... ]

        $ipIndex     = []; // ip     => [uid => true]
        $subnetIndex = []; // subnet => [uid => true]
        $uaIndex     = []; // uaHash => [uid => true]

        $scannedLogin = 0;
        $scannedMad   = 0;
        $truncated    = false;

        // ---- Source 1: login_log (uid, ip text, date) ----
        $cap = self::MAX_ROWS;
        $q = "SELECT uid, ip, UNIX_TIMESTAMP(`date`) AS ts
              FROM `" . TB_PREFIX . "login_log`
              WHERE uid > 3 AND UNIX_TIMESTAMP(`date`) >= " . (int) $since . "
              ORDER BY `date` DESC
              LIMIT " . (int) $cap;
        if ($res = @mysqli_query($link, $q)) {
            while ($row = mysqli_fetch_assoc($res)) {
                $scannedLogin++;
                self::ingest((int) $row['uid'], (string) $row['ip'], (int) $row['ts'], '',
                    $ips, $subnets, $uas, $logins, $ipIndex, $subnetIndex, $uaIndex);
            }
            mysqli_free_result($res);
            if ($scannedLogin >= $cap) {
                $truncated = true;
            }
        }

        // ---- Source 2: mad_session (adds UA) ----
        $q = "SELECT uid, ip_text, ua_hash, login_time
              FROM `" . TB_PREFIX . "mad_session`
              WHERE uid > 3 AND login_time >= " . (int) $since . "
              ORDER BY login_time DESC
              LIMIT " . (int) $cap;
        if ($res = @mysqli_query($link, $q)) {
            while ($row = mysqli_fetch_assoc($res)) {
                $scannedMad++;
                self::ingest((int) $row['uid'], (string) $row['ip_text'], (int) $row['login_time'],
                    (string) $row['ua_hash'],
                    $ips, $subnets, $uas, $logins, $ipIndex, $subnetIndex, $uaIndex);
            }
            mysqli_free_result($res);
            if ($scannedMad >= $cap) {
                $truncated = true;
            }
        }

        // ---- Candidate pair generation from shared keys ----
        $candidates = []; // "a:b" => true
        self::pairsFromIndex($ipIndex, $candidates, $focusUid);
        self::pairsFromIndex($subnetIndex, $candidates, $focusUid);
        self::pairsFromIndex($uaIndex, $candidates, $focusUid);

        // ---- Score each candidate pair ----
        $pairs = [];
        foreach ($candidates as $key => $_) {
            list($a, $b) = explode(':', $key);
            $a = (int) $a;
            $b = (int) $b;

            $scored = self::scorePair($a, $b, $ips, $subnets, $uas, $logins, $link, $days);
            if ($scored['score'] >= $minScore) {
                $pairs[] = $scored;
            }
        }

        // Resolve names for the pairs we keep (bounded set).
        self::attachNames($pairs, $link);

        // Sort by score desc, then trade gross desc.
        usort($pairs, function ($x, $y) {
            if ($x['score'] === $y['score']) {
                return $y['trade_gross'] <=> $x['trade_gross'];
            }
            return $y['score'] <=> $x['score'];
        });

        if (count($pairs) > self::MAX_PAIRS) {
            $pairs = array_slice($pairs, 0, self::MAX_PAIRS);
        }

        return [
            'pairs'       => $pairs,
            'scanned'     => ['login_log' => $scannedLogin, 'mad_session' => $scannedMad],
            'window_days' => $days,
            'truncated'   => $truncated,
        ];
    }

    /** Fold one login event into all aggregates + indices. */
    private static function ingest($uid, $ip, $ts, $uaHash,
        &$ips, &$subnets, &$uas, &$logins, &$ipIndex, &$subnetIndex, &$uaIndex)
    {
        if ($uid <= 3) {
            return;
        }
        $ip = trim($ip);
        if ($ip !== '' && $ip !== '0.0.0.0') {
            $ips[$uid][$ip]         = true;
            $ipIndex[$ip][$uid]     = true;
            $sub = self::subnet($ip);
            if ($sub !== '') {
                $subnets[$uid][$sub]      = true;
                $subnetIndex[$sub][$uid]  = true;
            }
        }
        if ($uaHash !== '' && $uaHash !== md5('')) {
            $uas[$uid][$uaHash]     = true;
            $uaIndex[$uaHash][$uid] = true;
        }
        if ($ts > 0) {
            $logins[$uid][] = [$ts, $ip];
        }
    }

    /** /24 for IPv4, /48-ish (first 3 hextets) for IPv6. */
    private static function subnet($ip)
    {
        if (strpos($ip, '.') !== false) {
            $p = explode('.', $ip);
            if (count($p) === 4) {
                return $p[0] . '.' . $p[1] . '.' . $p[2] . '.';
            }
        } elseif (strpos($ip, ':') !== false) {
            $p = explode(':', $ip);
            return $p[0] . ':' . ($p[1] ?? '') . ':' . ($p[2] ?? '') . '::';
        }
        return '';
    }

    /**
     * Turn an inverted index (key => [uid => true]) into candidate pairs.
     * Skips popular keys (public NAT/proxy) to avoid noise and O(n^2) blowup.
     */
    private static function pairsFromIndex(array $index, array &$candidates, $focusUid)
    {
        foreach ($index as $key => $uidSet) {
            $uids = array_keys($uidSet);
            $n = count($uids);
            if ($n < 2 || $n > self::POPULAR_KEY_CAP) {
                continue;
            }
            sort($uids);
            for ($i = 0; $i < $n; $i++) {
                for ($j = $i + 1; $j < $n; $j++) {
                    $a = $uids[$i];
                    $b = $uids[$j];
                    if ($focusUid && $a !== $focusUid && $b !== $focusUid) {
                        continue;
                    }
                    $candidates[$a . ':' . $b] = true;
                }
            }
        }
    }

    /** Score a single (a,b) pair and produce a reason breakdown. */
    private static function scorePair($a, $b, $ips, $subnets, $uas, $logins, $link, $days)
    {
        $sharedIps = array_keys(array_intersect_key(
            $ips[$a] ?? [], $ips[$b] ?? []
        ));
        $sharedSubs = array_keys(array_intersect_key(
            $subnets[$a] ?? [], $subnets[$b] ?? []
        ));
        $sharedUas = array_keys(array_intersect_key(
            $uas[$a] ?? [], $uas[$b] ?? []
        ));

        // Subnets that are shared but NOT already covered by a shared full IP.
        // Compare exact subnets (self::subnet) — a string-prefix test would treat
        // e.g. "85.204.1." as a prefix of IP "85.204.13.9" (false positive).
        $subOnly = [];
        foreach ($sharedSubs as $s) {
            $hasFull = false;
            foreach ($sharedIps as $ip) {
                if (self::subnet($ip) === $s) {
                    $hasFull = true;
                    break;
                }
            }
            if (!$hasFull) {
                $subOnly[] = $s;
            }
        }

        // Login "switch" events: logins of a and b from the same shared IP within
        // SWITCH_WINDOW seconds of each other.
        $switch = self::switchEvents($logins[$a] ?? [], $logins[$b] ?? [], $sharedIps);

        // Trade flow between the pair (villages resolved inside).
        $trade = self::tradeFlow($a, $b, $link, $days);

        // ---- Weighted score ----
        $score   = 0;
        $reasons = [];

        if (count($sharedIps) > 0) {
            $add = min(50, 35 + 5 * (count($sharedIps) - 1));
            $score += $add;
            $reasons[] = count($sharedIps) . ' shared IP' . (count($sharedIps) > 1 ? 's' : '');
        }
        if (count($sharedUas) > 0) {
            $add = min(30, 20 + 5 * (count($sharedUas) - 1));
            $score += $add;
            $reasons[] = count($sharedUas) . ' identical device/browser fingerprint'
                . (count($sharedUas) > 1 ? 's' : '');
        }
        if (count($subOnly) > 0) {
            $score += 10;
            $reasons[] = 'same /24 subnet';
        }
        if ($switch > 0) {
            $add = min(30, 15 + 5 * $switch);
            $score += $add;
            $reasons[] = $switch . ' rapid account switch' . ($switch > 1 ? 'es' : '')
                . ' from one IP';
        }
        if ($trade['gross'] > 0 && $trade['directional']) {
            $score += 20;
            $reasons[] = 'one-directional resource transfers';
        } elseif ($trade['gross'] > 0) {
            $score += 8;
            $reasons[] = 'resource transfers between them';
        }

        $score = (int) min(100, $score);
        $label = $score >= 70 ? 'High' : ($score >= 40 ? 'Medium' : 'Low');

        return [
            'uid_a'          => $a,
            'uid_b'          => $b,
            'name_a'         => '',
            'name_b'         => '',
            'score'          => $score,
            'label'          => $label,
            'shared_ips'     => count($sharedIps),
            'shared_ip_list' => array_slice($sharedIps, 0, 6),
            'shared_subnets' => count($subOnly),
            'shared_uas'     => count($sharedUas),
            'switch_events'  => $switch,
            'trade_gross'    => (int) $trade['gross'],
            'trade_dir'      => $trade['directional'] ? 1 : 0,
            'reasons'        => $reasons,
        ];
    }

    /** Count login "switches" from a shared IP within SWITCH_WINDOW seconds. */
    private static function switchEvents(array $la, array $lb, array $sharedIps)
    {
        if (empty($sharedIps) || empty($la) || empty($lb)) {
            return 0;
        }
        $sharedSet = array_flip($sharedIps);

        // Keep only events from shared IPs.
        $ea = [];
        foreach ($la as $e) {
            if (isset($sharedSet[$e[1]])) {
                $ea[] = $e[0];
            }
        }
        $eb = [];
        foreach ($lb as $e) {
            if (isset($sharedSet[$e[1]])) {
                $eb[] = $e[0];
            }
        }
        if (empty($ea) || empty($eb)) {
            return 0;
        }
        sort($ea);
        sort($eb);

        // Two-pointer count of a<->b logins within the window.
        $count = 0;
        $j = 0;
        $m = count($eb);
        foreach ($ea as $ta) {
            while ($j < $m && $eb[$j] < $ta - self::SWITCH_WINDOW) {
                $j++;
            }
            $k = $j;
            while ($k < $m && $eb[$k] <= $ta + self::SWITCH_WINDOW) {
                $count++;
                $k++;
                if ($count >= 20) {
                    return 20; // cap
                }
            }
        }
        return $count;
    }

    /**
     * Resource-transfer signal between two players.
     * Prefers resource_transfer_log (Push-Protection phase) when present, else
     * falls back to in-flight merchant movements. Returns gross total moved and
     * whether flow is strongly one-directional.
     */
    private static function tradeFlow($a, $b, $link, $days)
    {
        $out = ['gross' => 0, 'directional' => false];

        // Village ids owned by each player.
        $va = self::villagesOf($a, $link);
        $vb = self::villagesOf($b, $link);
        if (empty($va) || empty($vb)) {
            return $out;
        }
        $vaIn = implode(',', array_map('intval', $va));
        $vbIn = implode(',', array_map('intval', $vb));
        $since = time() - $days * 86400;

        $aToB = 0;
        $bToA = 0;

        // Preferred: persistent transfer log (created by push protection).
        $hasLog = @mysqli_query($link,
            "SELECT 1 FROM `" . TB_PREFIX . "resource_transfer_log` LIMIT 1");
        if ($hasLog !== false) {
            @mysqli_free_result($hasLog);
            $sumCols = "(wood+clay+iron+crop)";
            $r = @mysqli_query($link,
                "SELECT COALESCE(SUM($sumCols),0) FROM `" . TB_PREFIX . "resource_transfer_log`
                 WHERE from_vref IN ($vaIn) AND to_vref IN ($vbIn) AND `time` >= " . (int) $since);
            if ($r && ($row = mysqli_fetch_row($r))) {
                $aToB = (int) $row[0];
            }
            $r = @mysqli_query($link,
                "SELECT COALESCE(SUM($sumCols),0) FROM `" . TB_PREFIX . "resource_transfer_log`
                 WHERE from_vref IN ($vbIn) AND to_vref IN ($vaIn) AND `time` >= " . (int) $since);
            if ($r && ($row = mysqli_fetch_row($r))) {
                $bToA = (int) $row[0];
            }
        } else {
            // Fallback: in-flight merchant transfers (movement sort_type = 0),
            // resources live in the linked `send` row (m.ref = s.id).
            $sql = "SELECT COALESCE(SUM(s.wood+s.clay+s.iron+s.crop),0)
                    FROM `" . TB_PREFIX . "movement` m
                    JOIN `" . TB_PREFIX . "send` s ON m.ref = s.id
                    WHERE m.sort_type = 0 AND m.proc = 0
                      AND m.`from` IN (%FROM%) AND m.`to` IN (%TO%)";
            $r = @mysqli_query($link, str_replace(['%FROM%', '%TO%'], [$vaIn, $vbIn], $sql));
            if ($r && ($row = mysqli_fetch_row($r))) {
                $aToB = (int) $row[0];
            }
            $r = @mysqli_query($link, str_replace(['%FROM%', '%TO%'], [$vbIn, $vaIn], $sql));
            if ($r && ($row = mysqli_fetch_row($r))) {
                $bToA = (int) $row[0];
            }
        }

        $gross = $aToB + $bToA;
        $out['gross'] = $gross;
        if ($gross > 0) {
            $maxDir = max($aToB, $bToA);
            // Strongly one-directional if >= 85% flows one way and it is material.
            $out['directional'] = ($maxDir >= 0.85 * $gross) && ($gross >= 5000);
        }
        return $out;
    }

    /** Village wrefs owned by a user (cached per-request). */
    private static function villagesOf($uid, $link)
    {
        static $cache = [];
        $uid = (int) $uid;
        if (isset($cache[$uid])) {
            return $cache[$uid];
        }
        $out = [];
        $r = @mysqli_query($link,
            "SELECT wref FROM `" . TB_PREFIX . "vdata` WHERE owner = " . $uid);
        if ($r) {
            while ($row = mysqli_fetch_row($r)) {
                $out[] = (int) $row[0];
            }
            mysqli_free_result($r);
        }
        return $cache[$uid] = $out;
    }

    /** Fill name_a / name_b for the reported pairs in one query. */
    private static function attachNames(array &$pairs, $link)
    {
        if (empty($pairs)) {
            return;
        }
        $ids = [];
        foreach ($pairs as $p) {
            $ids[$p['uid_a']] = true;
            $ids[$p['uid_b']] = true;
        }
        $in = implode(',', array_map('intval', array_keys($ids)));
        $names = [];
        $r = @mysqli_query($link,
            "SELECT id, username FROM `" . TB_PREFIX . "users` WHERE id IN ($in)");
        if ($r) {
            while ($row = mysqli_fetch_assoc($r)) {
                $names[(int) $row['id']] = $row['username'];
            }
            mysqli_free_result($r);
        }
        foreach ($pairs as &$p) {
            $p['name_a'] = $names[$p['uid_a']] ?? ('#' . $p['uid_a']);
            $p['name_b'] = $names[$p['uid_b']] ?? ('#' . $p['uid_b']);
        }
        unset($p);
    }
}
