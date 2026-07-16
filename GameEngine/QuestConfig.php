<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : QuestConfig.php                                          ##
##  Type           : Editable quest rewards (Admin quest editor)              ##
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
 * QuestConfig
 * -------------------------------------------------------------------------
 * Makes the (previously hardcoded) quest rewards editable from the admin panel.
 *
 * The quest system ships in two variants — extended (Templates/Ajax/quest_core.tpl)
 * and standard (quest_core25.tpl) — selected per player by $_SESSION['qtyp']==37.
 * The two have different reward values and quest sets, so config is keyed by
 * (variant, quest_id).
 *
 * This class is the SINGLE SOURCE OF TRUTH for what a completed quest grants:
 * quest_core*.tpl calls QuestConfig::grantReward() instead of the old hardcoded
 * modifyResource()/gold/plus lines (see "wiring" note in the admin editor). The
 * table is seeded on first use with the exact current values, so behaviour is
 * unchanged until an admin edits something.
 *
 * Self-contained (static, resolves DB link from globals, self-creates + seeds
 * its table).
 */
class QuestConfig
{
    const V_EXTENDED = 'extended';
    const V_STANDARD = 'standard';

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

    /** Which quest variant is active for the current player/session. */
    public static function activeVariant()
    {
        return (isset($_SESSION['qtyp']) && (int) $_SESSION['qtyp'] === 37)
            ? self::V_EXTENDED : self::V_STANDARD;
    }

    public static function ensureSchema()
    {
        $link = self::link();
        if (!$link) {
            return;
        }
        @mysqli_query($link, "CREATE TABLE IF NOT EXISTS `" . TB_PREFIX . "quest_config` (
            `variant`   varchar(16) NOT NULL DEFAULT 'standard',
            `quest_id`  int(11) NOT NULL,
            `enabled`   tinyint(1) NOT NULL DEFAULT 1,
            `wood`      int(11) NOT NULL DEFAULT 0,
            `clay`      int(11) NOT NULL DEFAULT 0,
            `iron`      int(11) NOT NULL DEFAULT 0,
            `crop`      int(11) NOT NULL DEFAULT 0,
            `gold`      int(11) NOT NULL DEFAULT 0,
            `plus_days` float NOT NULL DEFAULT 0,
            `req_level` int(11) NOT NULL DEFAULT 0,
            `note`      varchar(255) NOT NULL DEFAULT '',
            PRIMARY KEY (`variant`,`quest_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    /** Seed the table with the current (extracted) hardcoded values, once. */
    public static function seedDefaults()
    {
        $link = self::link();
        if (!$link) {
            return;
        }
        self::ensureSchema();

        // Only seed when empty, so admin edits are never overwritten.
        $r = @mysqli_query($link, "SELECT 1 FROM `" . TB_PREFIX . "quest_config` LIMIT 1");
        if ($r && mysqli_num_rows($r) > 0) {
            mysqli_free_result($r);
            return;
        }
        if ($r) { mysqli_free_result($r); }

        $stmt = mysqli_prepare($link,
            "INSERT IGNORE INTO `" . TB_PREFIX . "quest_config`
             (variant, quest_id, enabled, wood, clay, iron, crop, gold, plus_days, req_level, note)
             VALUES (?,?,1,?,?,?,?,?,?,0,'')");
        if (!$stmt) {
            return;
        }
        foreach (self::defaults() as $variant => $quests) {
            foreach ($quests as $qid => $v) {
                $qid = (int) $qid;
                $w = (int) $v['wood']; $c = (int) $v['clay']; $i = (int) $v['iron'];
                $cr = (int) $v['crop']; $g = (int) $v['gold']; $pd = (float) $v['plus_days'];
                mysqli_stmt_bind_param($stmt, 'siiiiiid', $variant, $qid, $w, $c, $i, $cr, $g, $pd);
                mysqli_stmt_execute($stmt);
            }
        }
        mysqli_stmt_close($stmt);
    }

    /* ---- Reads --------------------------------------------------------- */

    /** All quest rows for a variant (seeds first). */
    public static function all($variant)
    {
        $variant = self::normVariant($variant);
        $link = self::link();
        $out = [];
        if (!$link) {
            return $out;
        }
        self::seedDefaults();
        $stmt = mysqli_prepare($link,
            "SELECT * FROM `" . TB_PREFIX . "quest_config` WHERE variant = ? ORDER BY quest_id ASC");
        if (!$stmt) {
            return $out;
        }
        mysqli_stmt_bind_param($stmt, 's', $variant);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        while ($res && $row = mysqli_fetch_assoc($res)) {
            $out[(int) $row['quest_id']] = $row;
        }
        mysqli_stmt_close($stmt);
        return $out;
    }

    /** One quest's config, falling back to the hardcoded default if absent. */
    public static function get($variant, $qid)
    {
        $variant = self::normVariant($variant);
        $qid = (int) $qid;
        $link = self::link();
        if ($link) {
            self::ensureSchema();
            $stmt = mysqli_prepare($link,
                "SELECT * FROM `" . TB_PREFIX . "quest_config` WHERE variant = ? AND quest_id = ? LIMIT 1");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'si', $variant, $qid);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $row = $res ? mysqli_fetch_assoc($res) : null;
                mysqli_stmt_close($stmt);
                if ($row) {
                    return $row;
                }
            }
        }
        // Fallback to compiled-in defaults.
        $d = self::defaults();
        if (isset($d[$variant][$qid])) {
            $v = $d[$variant][$qid];
            return [
                'variant' => $variant, 'quest_id' => $qid, 'enabled' => 1,
                'wood' => $v['wood'], 'clay' => $v['clay'], 'iron' => $v['iron'],
                'crop' => $v['crop'], 'gold' => $v['gold'], 'plus_days' => $v['plus_days'],
                'req_level' => 0, 'note' => '',
            ];
        }
        return null;
    }

    /* ---- Write --------------------------------------------------------- */

    public static function setQuest($variant, $qid, array $fields)
    {
        $variant = self::normVariant($variant);
        $link = self::link();
        if (!$link) {
            return false;
        }
        self::ensureSchema();

        $qid     = (int) $qid;
        $enabled = !empty($fields['enabled']) ? 1 : 0;
        $wood    = (int) ($fields['wood'] ?? 0);
        $clay    = (int) ($fields['clay'] ?? 0);
        $iron    = (int) ($fields['iron'] ?? 0);
        $crop    = (int) ($fields['crop'] ?? 0);
        $gold    = (int) ($fields['gold'] ?? 0);
        $plus    = (float) ($fields['plus_days'] ?? 0);
        $req     = (int) ($fields['req_level'] ?? 0);
        $note    = substr((string) ($fields['note'] ?? ''), 0, 255);

        $stmt = mysqli_prepare($link,
            "INSERT INTO `" . TB_PREFIX . "quest_config`
             (variant, quest_id, enabled, wood, clay, iron, crop, gold, plus_days, req_level, note)
             VALUES (?,?,?,?,?,?,?,?,?,?,?)
             ON DUPLICATE KEY UPDATE enabled=VALUES(enabled), wood=VALUES(wood), clay=VALUES(clay),
                 iron=VALUES(iron), crop=VALUES(crop), gold=VALUES(gold), plus_days=VALUES(plus_days),
                 req_level=VALUES(req_level), note=VALUES(note)");
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'siiiiiiidis',
            $variant, $qid, $enabled, $wood, $clay, $iron, $crop, $gold, $plus, $req, $note);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $ok;
    }

    /** Reset a whole variant back to compiled-in defaults. */
    public static function resetVariant($variant)
    {
        $variant = self::normVariant($variant);
        $link = self::link();
        if (!$link) {
            return false;
        }
        self::ensureSchema();
        $stmt = mysqli_prepare($link,
            "DELETE FROM `" . TB_PREFIX . "quest_config` WHERE variant = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $variant);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        self::seedDefaults();
        return true;
    }

    /* ---- Reward granting (called from quest_core*.tpl) ----------------- */

    /**
     * Grant a quest's reward from config. Replaces the old hardcoded
     * modifyResource()/gold/plus lines in the quest switch. Special side
     * effects (messages, FinishWoodcutter, etc.) stay in the template.
     *
     * @param object      $database
     * @param object      $session
     * @param int         $qid
     * @param string|null $variant  Auto-detected from session if null.
     */
    public static function grantReward($database, $session, $qid, $variant = null)
    {
        try {
            $variant = $variant ? self::normVariant($variant) : self::activeVariant();
            $cfg = self::get($variant, $qid);
            if (!$cfg) {
                return;
            }

            $vil = (isset($session->villages) && isset($session->villages[0])) ? $session->villages[0] : 0;
            $uid = 0;
            if (isset($session->uid)) {
                $uid = (int) $session->uid;
            } elseif (isset($session->userinfo) && isset($session->userinfo['id'])) {
                $uid = (int) $session->userinfo['id'];
            }

            $w = (int) $cfg['wood']; $c = (int) $cfg['clay'];
            $i = (int) $cfg['iron']; $cr = (int) $cfg['crop'];
            if (($w || $c || $i || $cr) && $vil && method_exists($database, 'modifyResource')) {
                $database->modifyResource($vil, $w, $c, $i, $cr, 1);
            }

            $gold = (int) $cfg['gold'];
            if ($gold > 0 && $uid > 0 && method_exists($database, 'modifyGold')) {
                $database->modifyGold($uid, $gold, 1);
            }

            $plusDays = (float) $cfg['plus_days'];
            if ($plusDays > 0 && $uid > 0) {
                $sec = (int) round($plusDays * 86400);
                $now = time();
                $link = self::link();
                if ($link) {
                    @mysqli_query($link, "UPDATE `" . TB_PREFIX . "users`
                        SET plus = IF(plus > $now, plus + $sec, $now + $sec) WHERE id = $uid");
                }
            }
        } catch (\Throwable $e) {
            // never break the quest flow
        }
    }

    /* ---- Helpers ------------------------------------------------------- */

    public static function normVariant($v)
    {
        return ($v === self::V_EXTENDED) ? self::V_EXTENDED : self::V_STANDARD;
    }

    /**
     * Quests that keep their original hardcoded logic in quest_core*.tpl and are
     * therefore NOT affected by edits here (conditional rewards, atomic-claim
     * milestones, special mechanics). Shown as read-only in the editor.
     *   2  = FinishWoodcutter (completes a building, not a resource grant)
     *   9  = conditional crop cost + spawned attack
     *   26 = (standard only) two-branch reward depending on a session flag
     *   91 = atomic-claim milestone (gold + Plus, issue #129)
     *   97 = atomic-claim milestone (gold + Plus, issue #129)
     */
    public static function nativeQuests($variant)
    {
        $variant = self::normVariant($variant);
        return ($variant === self::V_STANDARD)
            ? [2, 9, 26, 91, 97]
            : [2, 9, 91, 97];
    }

    /**
     * Compiled-in default reward values, extracted from the shipped quest
     * templates (extended = quest_core.tpl, standard = quest_core25.tpl).
     * Used to seed the table and as a fallback.
     */
    public static function defaults()
    {
        return [
            'extended' => [
                2 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                3 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>1],
                4 => ['wood'=>30,'clay'=>60,'iron'=>30,'crop'=>20,'gold'=>0,'plus_days'=>0],
                5 => ['wood'=>40,'clay'=>30,'iron'=>20,'crop'=>30,'gold'=>0,'plus_days'=>0],
                6 => ['wood'=>50,'clay'=>60,'iron'=>30,'crop'=>30,'gold'=>0,'plus_days'=>0],
                7 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>20,'plus_days'=>0],
                8 => ['wood'=>75,'clay'=>80,'iron'=>30,'crop'=>50,'gold'=>0,'plus_days'=>0],
                9 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>-200,'gold'=>0,'plus_days'=>0],
                10 => ['wood'=>75,'clay'=>90,'iron'=>30,'crop'=>50,'gold'=>0,'plus_days'=>0],
                11 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>2],
                12 => ['wood'=>60,'clay'=>30,'iron'=>40,'crop'=>90,'gold'=>0,'plus_days'=>0],
                13 => ['wood'=>150,'clay'=>180,'iron'=>30,'crop'=>130,'gold'=>0,'plus_days'=>0],
                14 => ['wood'=>60,'clay'=>50,'iron'=>40,'crop'=>30,'gold'=>0,'plus_days'=>0],
                15 => ['wood'=>50,'clay'=>30,'iron'=>60,'crop'=>20,'gold'=>0,'plus_days'=>0],
                16 => ['wood'=>75,'clay'=>75,'iron'=>40,'crop'=>40,'gold'=>0,'plus_days'=>0],
                17 => ['wood'=>100,'clay'=>90,'iron'=>100,'crop'=>60,'gold'=>0,'plus_days'=>0],
                18 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                19 => ['wood'=>80,'clay'=>90,'iron'=>60,'crop'=>40,'gold'=>0,'plus_days'=>0],
                20 => ['wood'=>70,'clay'=>120,'iron'=>90,'crop'=>50,'gold'=>0,'plus_days'=>0],
                21 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                22 => ['wood'=>200,'clay'=>200,'iron'=>700,'crop'=>450,'gold'=>0,'plus_days'=>0],
                23 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                24 => ['wood'=>300,'clay'=>320,'iron'=>360,'crop'=>570,'gold'=>0,'plus_days'=>0],
                28 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>15,'plus_days'=>0],
                29 => ['wood'=>240,'clay'=>280,'iron'=>180,'crop'=>100,'gold'=>0,'plus_days'=>0],
                30 => ['wood'=>600,'clay'=>750,'iron'=>600,'crop'=>300,'gold'=>0,'plus_days'=>0],
                31 => ['wood'=>900,'clay'=>850,'iron'=>600,'crop'=>300,'gold'=>0,'plus_days'=>0],
                32 => ['wood'=>1800,'clay'=>2000,'iron'=>1650,'crop'=>800,'gold'=>0,'plus_days'=>0],
                33 => ['wood'=>1600,'clay'=>1800,'iron'=>1950,'crop'=>1200,'gold'=>0,'plus_days'=>0],
                34 => ['wood'=>3400,'clay'=>2800,'iron'=>3600,'crop'=>2200,'gold'=>0,'plus_days'=>0],
                35 => ['wood'=>1050,'clay'=>800,'iron'=>900,'crop'=>750,'gold'=>0,'plus_days'=>0],
                36 => ['wood'=>1600,'clay'=>2000,'iron'=>1800,'crop'=>1300,'gold'=>0,'plus_days'=>0],
                37 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                91 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>15,'plus_days'=>1],
                92 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                93 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                94 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                95 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                96 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                97 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>20,'plus_days'=>2],
            ],
            'standard' => [
                2 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                3 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>1],
                4 => ['wood'=>30,'clay'=>60,'iron'=>30,'crop'=>20,'gold'=>0,'plus_days'=>0],
                5 => ['wood'=>40,'clay'=>30,'iron'=>20,'crop'=>30,'gold'=>0,'plus_days'=>0],
                6 => ['wood'=>50,'clay'=>60,'iron'=>30,'crop'=>30,'gold'=>0,'plus_days'=>0],
                7 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>20,'plus_days'=>0],
                8 => ['wood'=>60,'clay'=>30,'iron'=>40,'crop'=>90,'gold'=>0,'plus_days'=>0],
                9 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>-200,'gold'=>0,'plus_days'=>0],
                10 => ['wood'=>100,'clay'=>80,'iron'=>40,'crop'=>40,'gold'=>0,'plus_days'=>0],
                11 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>2],
                12 => ['wood'=>75,'clay'=>140,'iron'=>40,'crop'=>40,'gold'=>0,'plus_days'=>0],
                13 => ['wood'=>75,'clay'=>80,'iron'=>30,'crop'=>50,'gold'=>0,'plus_days'=>0],
                14 => ['wood'=>120,'clay'=>200,'iron'=>140,'crop'=>100,'gold'=>0,'plus_days'=>0],
                15 => ['wood'=>150,'clay'=>180,'iron'=>30,'crop'=>130,'gold'=>0,'plus_days'=>0],
                16 => ['wood'=>60,'clay'=>50,'iron'=>40,'crop'=>30,'gold'=>0,'plus_days'=>0],
                17 => ['wood'=>50,'clay'=>30,'iron'=>60,'crop'=>20,'gold'=>0,'plus_days'=>0],
                18 => ['wood'=>75,'clay'=>75,'iron'=>40,'crop'=>40,'gold'=>0,'plus_days'=>0],
                19 => ['wood'=>100,'clay'=>90,'iron'=>100,'crop'=>60,'gold'=>0,'plus_days'=>0],
                20 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>0,'plus_days'=>0],
                21 => ['wood'=>80,'clay'=>90,'iron'=>60,'crop'=>40,'gold'=>0,'plus_days'=>0],
                22 => ['wood'=>70,'clay'=>120,'iron'=>90,'crop'=>50,'gold'=>0,'plus_days'=>0],
                23 => ['wood'=>80,'clay'=>90,'iron'=>60,'crop'=>40,'gold'=>0,'plus_days'=>0],
                24 => ['wood'=>80,'clay'=>90,'iron'=>60,'crop'=>40,'gold'=>0,'plus_days'=>0],
                25 => ['wood'=>70,'clay'=>100,'iron'=>90,'crop'=>100,'gold'=>0,'plus_days'=>0],
                26 => ['wood'=>200,'clay'=>200,'iron'=>700,'crop'=>250,'gold'=>0,'plus_days'=>0],
                27 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>15,'plus_days'=>0],
                28 => ['wood'=>80,'clay'=>70,'iron'=>60,'crop'=>40,'gold'=>0,'plus_days'=>0],
                29 => ['wood'=>100,'clay'=>60,'iron'=>90,'crop'=>40,'gold'=>0,'plus_days'=>0],
                30 => ['wood'=>100,'clay'=>140,'iron'=>90,'crop'=>50,'gold'=>0,'plus_days'=>0],
                91 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>15,'plus_days'=>1],
                92 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                93 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                94 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                95 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                96 => ['wood'=>217,'clay'=>247,'iron'=>177,'crop'=>207,'gold'=>0,'plus_days'=>0],
                97 => ['wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'gold'=>20,'plus_days'=>2],
            ],
        ];
    }
}
