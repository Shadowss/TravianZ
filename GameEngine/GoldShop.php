<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : GoldShop.php                                              ##
##  Type           : Gold shop / promo-code engine                             ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow 		                                           ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

/**
 * GoldShop
 * -------------------------------------------------------------------------
 * Promo / voucher codes redeemable by players for gold. Admin creates codes
 * (fixed gold amount, optional max-uses, optional per-user-once, optional
 * expiry); players redeem them on the Plus page.
 *
 * "Free gold for bug hunters" is already covered by the existing admin pages
 * (Give Free Gold To Specific User / To All) — a single-use code created here
 * is also a convenient way to hand a bug hunter their reward.
 *
 * Self-contained (static, resolves DB link + optional Database from globals,
 * self-creates its tables). Use-claiming is atomic (conditional UPDATE) so a
 * limited code cannot be over-redeemed under concurrency.
 */
class GoldShop
{
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

    public static function ensureSchema()
    {
        $link = self::link();
        if (!$link) {
            return;
        }
        @mysqli_query($link, "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "gold_promo` (
            `id`         int(11) NOT NULL AUTO_INCREMENT,
            `code`       varchar(64) NOT NULL,
            `gold`       int(11) NOT NULL DEFAULT 0,
            `max_uses`   int(11) NOT NULL DEFAULT 0,
            `uses`       int(11) NOT NULL DEFAULT 0,
            `per_user`   tinyint(1) NOT NULL DEFAULT 1,
            `expires`    int(11) NOT NULL DEFAULT 0,
            `active`     tinyint(1) NOT NULL DEFAULT 1,
            `note`       varchar(255) NOT NULL DEFAULT '',
            `created_by` int(11) NOT NULL DEFAULT 0,
            `time`       int(11) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE KEY `code` (`code`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        @mysqli_query($link, "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "gold_promo_redeem` (
            `id`       int(11) NOT NULL AUTO_INCREMENT,
            `promo_id` int(11) NOT NULL DEFAULT 0,
            `uid`      int(11) NOT NULL DEFAULT 0,
            `gold`     int(11) NOT NULL DEFAULT 0,
            `time`     int(11) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `promo_uid` (`promo_id`,`uid`),
            KEY `uid` (`uid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    /** Normalise a code: trim, uppercase, collapse to allowed charset. */
    public static function normCode($code)
    {
        $code = strtoupper(trim((string) $code));
        return preg_replace('/[^A-Z0-9._-]/', '', $code);
    }

    /* ---- Admin management ---------------------------------------------- */

    /**
     * Create a promo code.
     * @return array [ok(bool), message(string)]
     */
    public static function createCode($code, $gold, $maxUses, $perUser, $expires, $note, $adminId)
    {
        $link = self::link();
        if (!$link) {
            return [false, 'No database connection.'];
        }
        self::ensureSchema();

        $code = self::normCode($code);
        if ($code === '' || strlen($code) < 3) {
            return [false, 'Code must be at least 3 characters (A-Z 0-9 . _ -).'];
        }
        $gold = (int) $gold;
        if ($gold <= 0) {
            return [false, 'Gold amount must be positive.'];
        }
        $maxUses = max(0, (int) $maxUses);
        $perUser = $perUser ? 1 : 0;
        $expires = max(0, (int) $expires);
        $note    = substr((string) $note, 0, 255);
        $admin   = (int) $adminId;
        $now     = time();

        $stmt = mysqli_prepare($link,
            "INSERT INTO `" . TB_PREFIX . "gold_promo`
             (code, gold, max_uses, uses, per_user, expires, active, note, created_by, time)
             VALUES (?,?,?,0,?,?,1,?,?,?)");
        if (!$stmt) {
            return [false, 'Could not prepare statement.'];
        }
        mysqli_stmt_bind_param($stmt, 'siiiisii',
            $code, $gold, $maxUses, $perUser, $expires, $note, $admin, $now);
        $ok = mysqli_stmt_execute($stmt);
        $err = mysqli_stmt_errno($stmt);
        mysqli_stmt_close($stmt);

        if (!$ok) {
            if ($err === 1062) {
                return [false, 'A code with that name already exists.'];
            }
            return [false, 'Could not create code.'];
        }
        return [true, 'Code "' . $code . '" created.'];
    }

    /** All codes, newest first, each with a resolved status string. */
    public static function listCodes()
    {
        $link = self::link();
        $out = [];
        if (!$link) {
            return $out;
        }
        self::ensureSchema();
        $r = @mysqli_query($link,
            "SELECT * FROM `" . TB_PREFIX . "gold_promo` ORDER BY `time` DESC, id DESC");
        if ($r) {
            $now = time();
            while ($row = mysqli_fetch_assoc($r)) {
                $row['status'] = self::statusOf($row, $now);
                $out[] = $row;
            }
            mysqli_free_result($r);
        }
        return $out;
    }

    private static function statusOf($row, $now)
    {
        if ((int) $row['active'] !== 1) {
            return 'Disabled';
        }
        if ((int) $row['expires'] > 0 && $now > (int) $row['expires']) {
            return 'Expired';
        }
        if ((int) $row['max_uses'] > 0 && (int) $row['uses'] >= (int) $row['max_uses']) {
            return 'Used up';
        }
        return 'Active';
    }

    public static function setActive($id, $active)
    {
        $link = self::link();
        if (!$link) {
            return false;
        }
        self::ensureSchema();
        $stmt = mysqli_prepare($link,
            "UPDATE `" . TB_PREFIX . "gold_promo` SET active = ? WHERE id = ?");
        if (!$stmt) {
            return false;
        }
        $a = $active ? 1 : 0;
        $id = (int) $id;
        mysqli_stmt_bind_param($stmt, 'ii', $a, $id);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }

    public static function deleteCode($id)
    {
        $link = self::link();
        if (!$link) {
            return false;
        }
        self::ensureSchema();
        $id = (int) $id;
        $stmt = mysqli_prepare($link, "DELETE FROM `" . TB_PREFIX . "gold_promo` WHERE id = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        return true;
    }

    /** Recent redemptions (joined with code + username) for the admin view. */
    public static function recentRedemptions($limit = 30)
    {
        $link = self::link();
        $out = [];
        if (!$link) {
            return $out;
        }
        self::ensureSchema();
        $limit = max(1, min(200, (int) $limit));
        $r = @mysqli_query($link,
            "SELECT rr.time, rr.gold, rr.uid, u.username, p.code
             FROM `" . TB_PREFIX . "gold_promo_redeem` rr
             LEFT JOIN `" . TB_PREFIX . "users` u ON u.id = rr.uid
             LEFT JOIN `" . TB_PREFIX . "gold_promo` p ON p.id = rr.promo_id
             ORDER BY rr.id DESC LIMIT " . $limit);
        if ($r) {
            while ($row = mysqli_fetch_assoc($r)) {
                $out[] = $row;
            }
            mysqli_free_result($r);
        }
        return $out;
    }

    /* ---- Player redemption --------------------------------------------- */

    /**
     * Redeem a code for a player.
     * @return array [ok(bool), message(string), gold(int)]
     */
    public static function redeem($uid, $code)
    {
        $uid = (int) $uid;
        if ($uid <= 0) {
            return [false, 'You must be logged in.', 0];
        }
        $link = self::link();
        if (!$link) {
            return [false, 'Service unavailable, try again later.', 0];
        }
        self::ensureSchema();

        $code = self::normCode($code);
        if ($code === '') {
            return [false, 'Please enter a code.', 0];
        }

        // Fetch the code row.
        $stmt = mysqli_prepare($link,
            "SELECT * FROM `" . TB_PREFIX . "gold_promo` WHERE code = ? LIMIT 1");
        if (!$stmt) {
            return [false, 'Service unavailable, try again later.', 0];
        }
        mysqli_stmt_bind_param($stmt, 's', $code);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $promo = $res ? mysqli_fetch_assoc($res) : null;
        mysqli_stmt_close($stmt);

        if (!$promo) {
            return [false, 'Invalid code.', 0];
        }
        $now = time();
        if ((int) $promo['active'] !== 1) {
            return [false, 'This code is no longer available.', 0];
        }
        if ((int) $promo['expires'] > 0 && $now > (int) $promo['expires']) {
            return [false, 'This code has expired.', 0];
        }
        if ((int) $promo['max_uses'] > 0 && (int) $promo['uses'] >= (int) $promo['max_uses']) {
            return [false, 'This code has already been fully redeemed.', 0];
        }

        $promoId = (int) $promo['id'];
        $gold    = (int) $promo['gold'];

        // Per-user-once check.
        if ((int) $promo['per_user'] === 1) {
            $chk = mysqli_prepare($link,
                "SELECT 1 FROM `" . TB_PREFIX . "gold_promo_redeem` WHERE promo_id = ? AND uid = ? LIMIT 1");
            if ($chk) {
                mysqli_stmt_bind_param($chk, 'ii', $promoId, $uid);
                mysqli_stmt_execute($chk);
                mysqli_stmt_store_result($chk);
                $already = mysqli_stmt_num_rows($chk) > 0;
                mysqli_stmt_close($chk);
                if ($already) {
                    return [false, 'You have already redeemed this code.', 0];
                }
            }
        }

        // Atomically claim a use (guards against concurrent over-redemption).
        $claim = mysqli_prepare($link,
            "UPDATE `" . TB_PREFIX . "gold_promo`
             SET uses = uses + 1
             WHERE id = ? AND active = 1
               AND (max_uses = 0 OR uses < max_uses)
               AND (expires = 0 OR expires >= ?)");
        if (!$claim) {
            return [false, 'Service unavailable, try again later.', 0];
        }
        mysqli_stmt_bind_param($claim, 'ii', $promoId, $now);
        mysqli_stmt_execute($claim);
        $claimed = mysqli_stmt_affected_rows($claim) === 1;
        mysqli_stmt_close($claim);

        if (!$claimed) {
            return [false, 'This code has already been fully redeemed.', 0];
        }

        // Grant the gold. Prefer the Database helper (also writes gold_fin_log).
        $granted = false;
        if (isset($GLOBALS['database']) && method_exists($GLOBALS['database'], 'modifyGold')) {
            $GLOBALS['database']->modifyGold($uid, $gold, 1);
            $granted = true;
        }
        if (!$granted) {
            $g = mysqli_prepare($link,
                "UPDATE `" . TB_PREFIX . "users` SET gold = gold + ? WHERE id = ?");
            if ($g) {
                mysqli_stmt_bind_param($g, 'ii', $gold, $uid);
                mysqli_stmt_execute($g);
                mysqli_stmt_close($g);
            }
        }

        // Record the redemption.
        $ins = mysqli_prepare($link,
            "INSERT INTO `" . TB_PREFIX . "gold_promo_redeem` (promo_id, uid, gold, time)
             VALUES (?,?,?,?)");
        if ($ins) {
            mysqli_stmt_bind_param($ins, 'iiii', $promoId, $uid, $gold, $now);
            mysqli_stmt_execute($ins);
            mysqli_stmt_close($ins);
        }

        return [true, 'Success! ' . $gold . ' gold has been added to your account.', $gold];
    }
}
