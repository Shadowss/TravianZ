<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : RegBlock.php                                              ##
##  Type           : Registration blocklist engine                             ##
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
 * RegBlock
 * -------------------------------------------------------------------------
 * Blocklist for registration: reject specific usernames, specific e-mail
 * addresses, or whole e-mail domains (e.g. an obscene username, or the whole
 * "yahoo.com" domain). Managed from the admin panel (blockReg), enforced in
 * Account::Signup().
 *
 * Match rules (all case-insensitive, exact — no accidental substring blocks):
 *   - username : exact username match
 *   - email    : exact full-address match
 *   - domain   : the part after "@" of the candidate e-mail
 *
 * Self-contained (static, resolves DB link from globals, self-creates its
 * table) so both the registration flow and the admin panel can use it.
 */
class RegBlock
{
    const T_USERNAME = 'username';
    const T_EMAIL    = 'email';
    const T_DOMAIN   = 'domain';

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

    /** Create the reg_block table if missing. */
    public static function ensureSchema()
    {
        $link = self::link();
        if (!$link) {
            return;
        }
        @mysqli_query($link, "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "reg_block` (
            `id`       int(11) NOT NULL AUTO_INCREMENT,
            `type`     varchar(16) NOT NULL DEFAULT 'username',
            `value`    varchar(255) NOT NULL DEFAULT '',
            `note`     varchar(255) NOT NULL DEFAULT '',
            `added_by` int(11) NOT NULL DEFAULT 0,
            `time`     int(11) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE KEY `type_value` (`type`,`value`),
            KEY `type` (`type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    /** Normalise a value: trim + lowercase. */
    private static function norm($v)
    {
        return strtolower(trim((string) $v));
    }

    /** Valid type check. */
    private static function validType($t)
    {
        return in_array($t, [self::T_USERNAME, self::T_EMAIL, self::T_DOMAIN], true);
    }

    /* ---- Enforcement (called from registration) ------------------------ */

    /** True if this username is blocked. */
    public static function isBlockedName($database, $name)
    {
        return self::matches(self::T_USERNAME, self::norm($name));
    }

    /** True if this e-mail address OR its domain is blocked. */
    public static function isBlockedEmail($database, $email)
    {
        $email = self::norm($email);
        if ($email === '') {
            return false;
        }
        if (self::matches(self::T_EMAIL, $email)) {
            return true;
        }
        $at = strrpos($email, '@');
        if ($at !== false) {
            $domain = substr($email, $at + 1);
            if ($domain !== '' && self::matches(self::T_DOMAIN, $domain)) {
                return true;
            }
        }
        return false;
    }

    /** Low-level exact lookup. */
    private static function matches($type, $value)
    {
        $link = self::link();
        if (!$link || $value === '') {
            return false;
        }
        self::ensureSchema();
        $stmt = mysqli_prepare($link,
            "SELECT 1 FROM `" . TB_PREFIX . "reg_block` WHERE `type` = ? AND `value` = ? LIMIT 1");
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'ss', $type, $value);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $hit = mysqli_stmt_num_rows($stmt) > 0;
        mysqli_stmt_close($stmt);
        return $hit;
    }

    /* ---- Admin management ---------------------------------------------- */

    /** All blocks, newest first. */
    public static function all()
    {
        $link = self::link();
        $out = [];
        if (!$link) {
            return $out;
        }
        self::ensureSchema();
        $r = @mysqli_query($link,
            "SELECT * FROM `" . TB_PREFIX . "reg_block` ORDER BY `time` DESC, id DESC");
        if ($r) {
            while ($row = mysqli_fetch_assoc($r)) {
                $out[] = $row;
            }
            mysqli_free_result($r);
        }
        return $out;
    }

    /**
     * Add a block. Returns [ok(bool), message(string)].
     * Domain values may be given with or without a leading "@".
     */
    public static function add($type, $value, $note, $adminId)
    {
        $link = self::link();
        if (!$link) {
            return [false, 'No database connection.'];
        }
        self::ensureSchema();

        $type = (string) $type;
        if (!self::validType($type)) {
            return [false, 'Invalid block type.'];
        }

        $value = self::norm($value);
        if ($type === self::T_DOMAIN) {
            $value = ltrim($value, '@');
        }
        if ($value === '') {
            return [false, 'Value cannot be empty.'];
        }

        // Light sanity checks.
        if ($type === self::T_EMAIL && strpos($value, '@') === false) {
            return [false, 'That does not look like a full e-mail address.'];
        }
        if ($type === self::T_DOMAIN && strpos($value, '.') === false) {
            return [false, 'That does not look like a domain (e.g. yahoo.com).'];
        }
        if (strlen($value) > 255) {
            return [false, 'Value too long.'];
        }

        $note  = substr((string) $note, 0, 255);
        $admin = (int) $adminId;
        $now   = time();

        $stmt = mysqli_prepare($link,
            "INSERT INTO `" . TB_PREFIX . "reg_block` (`type`,`value`,`note`,`added_by`,`time`)
             VALUES (?,?,?,?,?)
             ON DUPLICATE KEY UPDATE `note` = VALUES(`note`), `added_by` = VALUES(`added_by`), `time` = VALUES(`time`)");
        if (!$stmt) {
            return [false, 'Could not prepare statement.'];
        }
        mysqli_stmt_bind_param($stmt, 'sssii', $type, $value, $note, $admin, $now);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $ok ? [true, 'Block saved.'] : [false, 'Could not save block.'];
    }

    /** Remove a block by id. */
    public static function remove($id)
    {
        $link = self::link();
        if (!$link) {
            return false;
        }
        self::ensureSchema();
        $stmt = mysqli_prepare($link,
            "DELETE FROM `" . TB_PREFIX . "reg_block` WHERE id = ?");
        if (!$stmt) {
            return false;
        }
        $id = (int) $id;
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }
}
