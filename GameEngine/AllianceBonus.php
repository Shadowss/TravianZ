<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : AllianceBonus.php                                         ##
##  Type           : AllianceBonus port                                        ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################
##                                                                             ##
##  Alliance members donate resources, allowing the alliance to unlock four    ##
##  bonuses, each with five levels:                                            ##
##                                                                             ##
##   1 Recruitment - Faster troop training in all military buildings           ##
##   2 Philosophy  - Increased Culture Point production                        ##
##   3 Metallurgy  - Higher attack and defense values (in addition to Smithy   ##
##                   upgrades)                                                 ##
##   4 Commerce    - Increased merchant carrying capacity                      ##
##                                                                             ##
##  The mechanics follow Travian T4: the type of resource donated does not     ##
##  matter, only the total amount; while a bonus level is being unlocked,      ##
##  donations to that bonus are temporarily disabled; each player has a daily  ##
##  donation limit that increases with the alliance level; and new members     ##
##  gradually gain access to higher bonus levels.                              ##
#################################################################################

class AllianceBonus
{
    const RECRUITMENT = 1;
    const PHILOSOPHY  = 2;
    const METALLURGY  = 3;
    const COMMERCE    = 4;

    const MAX_LEVEL = 5;

    // rezultate pentru donate()
    const DONATE_OK          = 0;
    const DONATE_DISABLED    = 1;
    const DONATE_NO_ALLIANCE = 2;
    const DONATE_UPGRADING   = 3;
    const DONATE_LIMIT       = 4;
    const DONATE_RESOURCES   = 5;
    const DONATE_INVALID     = 6;
    const DONATE_NO_GOLD     = 7;
    /** Ultimul nivel: s-a donat mai mult decat mai era nevoie. */
    const DONATE_OVER_MAX    = 8;

    /** Cat se putea dona de fapt; citit de interfata cand primeste DONATE_OVER_MAX. */
    public static $overMaxAllowed = 0;

    private $db;

    /** cache per cerere: nivelurile fiecarei aliante deja citite */
    private static $levelCache = array();

    public function __construct()
    {
        global $database;
        $this->db = $database->dblink;
    }

    /**
     * Functiile sunt pornite? Verificam si flagul, si existenta tabelei, ca sa
     * nu cada jocul pe un server care nu a rulat inca migrarea SQL.
     */
    public static function enabled()
    {
        static $ok = null;

        if ($ok !== null) {
            return $ok;
        }

        if (!defined('NEW_FUNCTIONS_ALLIANCE_BONUSES') || !NEW_FUNCTIONS_ALLIANCE_BONUSES) {
            return $ok = false;
        }

        global $database;
        $res = @mysqli_query($database->dblink,
            "SHOW TABLES LIKE '" . TB_PREFIX . "alliance_bonus'");

        return $ok = ($res && mysqli_num_rows($res) > 0);
    }

    /** Lista tipurilor, cu cheia de limba si iconita. */
    public static function types()
    {
        return array(
            self::RECRUITMENT => array('key' => 'recruitment', 'lang' => 'ALLYBONUS_RECRUITMENT'),
            self::PHILOSOPHY  => array('key' => 'philosophy',  'lang' => 'ALLYBONUS_PHILOSOPHY'),
            self::METALLURGY  => array('key' => 'metallurgy',  'lang' => 'ALLYBONUS_METALLURGY'),
            self::COMMERCE    => array('key' => 'commerce',    'lang' => 'ALLYBONUS_COMMERCE'),
        );
    }

    /* ------------------------------------------------------------------ */
    /* Tabele de valori (din config, cu rezerva pe valorile din T4)        */
    /* ------------------------------------------------------------------ */

    private static function listFromConst($name, $fallback)
    {
        $raw = defined($name) ? (string) constant($name) : $fallback;
        $out = array();

        foreach (explode(',', $raw) as $v) {
            $v = trim($v);

            if ($v !== '' && is_numeric($v)) {
                $out[] = (float) $v;
            }
        }

        return $out ? $out : array_map('floatval', explode(',', $fallback));
    }

    /** Resurse necesare pentru a trece de la $level la $level+1. */
    public static function costFor($level)
    {
        $costs = self::listFromConst('ALLIANCE_BONUS_COSTS',
            '1200000,5600000,17100000,51200000,153600000');

        return isset($costs[$level]) ? (float) $costs[$level] : 0.0;
    }

    /** Durata upgrade-ului, in secunde, scalata cu viteza serverului. */
    public static function upgradeSeconds($level)
    {
        $hours = self::listFromConst('ALLIANCE_BONUS_HOURS', '24,48,72,96,120');
        $h     = isset($hours[$level]) ? (float) $hours[$level] : 24.0;
        $speed = (defined('SPEED') && SPEED > 0) ? (float) SPEED : 1.0;

        return (int) max(60, round($h * 3600 / $speed));
    }

    /**
     * Plafonul zilnic de donatie al unui jucator, dupa cel mai mare nivel
     * deblocat in alianta. Se scaleaza cu viteza serverului, ca in T4.
     */
    public static function dailyLimit($highestLevel)
    {
        $limits = self::listFromConst('ALLIANCE_BONUS_DAILY',
            '300000,300000,400000,550000,750000,1000000');

        $idx = max(0, min(count($limits) - 1, (int) $highestLevel));
        $val = (float) $limits[$idx];
        $speed = (defined('SPEED') && SPEED > 0) ? (float) SPEED : 1.0;

        return (float) round($val * $speed);
    }

    /** Procentul acordat de un nivel, pentru un tip de bonus. */
    public static function percentFor($btype, $level)
    {
        $level = max(0, min(self::MAX_LEVEL, (int) $level));

        if ($level === 0) {
            return 0.0;
        }

        $small = defined('ALLIANCE_BONUS_PCT_SMALL') ? (float) ALLIANCE_BONUS_PCT_SMALL : 2.0;
        $large = defined('ALLIANCE_BONUS_PCT_LARGE') ? (float) ALLIANCE_BONUS_PCT_LARGE : 4.0;

        // Recruitment si Philosophy cresc cu 2% pe nivel, Metallurgy si
        // Commerce cu 4% pe nivel (vezi tabelul din T4).
        $step = in_array((int) $btype, array(self::METALLURGY, self::COMMERCE), true)
            ? $large : $small;

        return $level * $step;
    }

    /* ------------------------------------------------------------------ */
    /* Citire                                                              */
    /* ------------------------------------------------------------------ */

    /**
     * Starea completa a bonusurilor unei aliante: nivel, progres, upgrade activ.
     * Randurile lipsa se completeaza cu nivel 0, deci apelantul primeste mereu
     * toate cele patru tipuri.
     */
    public function getState($aid)
    {
        $aid = (int) $aid;
        $out = array();

        foreach (array_keys(self::types()) as $btype) {
            $out[$btype] = array(
                'btype'       => $btype,
                'level'       => 0,
                'pool'        => 0.0,
                'upgrade_end' => 0,
            );
        }

        if ($aid <= 0 || !self::enabled()) {
            return $out;
        }

        $res = mysqli_query($this->db,
            "SELECT btype, level, pool, upgrade_end FROM " . TB_PREFIX . "alliance_bonus
              WHERE aid = " . $aid);

        while ($res && ($row = mysqli_fetch_assoc($res))) {
            $b = (int) $row['btype'];

            if (isset($out[$b])) {
                $out[$b] = array(
                    'btype'       => $b,
                    'level'       => (int) $row['level'],
                    'pool'        => (float) $row['pool'],
                    'upgrade_end' => (int) $row['upgrade_end'],
                );
            }
        }

        return $out;
    }

    /**
     * Nivelurile efective ale unei aliante, ca array btype => nivel.
     * Cache-uit pe cerere: se citeste des (lupte, instruire, productie).
     */
    public function getLevels($aid)
    {
        $aid = (int) $aid;

        if (isset(self::$levelCache[$aid])) {
            return self::$levelCache[$aid];
        }

        $levels = array();

        foreach (array_keys(self::types()) as $btype) {
            $levels[$btype] = 0;
        }

        if ($aid > 0 && self::enabled()) {
            $res = mysqli_query($this->db,
                "SELECT btype, level FROM " . TB_PREFIX . "alliance_bonus WHERE aid = " . $aid);

            while ($res && ($row = mysqli_fetch_assoc($res))) {
                $b = (int) $row['btype'];

                if (isset($levels[$b])) {
                    $levels[$b] = (int) $row['level'];
                }
            }
        }

        return self::$levelCache[$aid] = $levels;
    }

    /** Cel mai mare nivel deblocat in alianta (pentru plafonul de donatie). */
    public function highestLevel($aid)
    {
        $levels = $this->getLevels($aid);

        return $levels ? max($levels) : 0;
    }

    /**
     * Nivelul de care beneficiaza EFECTIV un jucator.
     *
     * Membrii noi capata acces treptat: nivelul 1 imediat, nivelul 2 dupa 24h,
     * nivelul 3 dupa 48h si asa mai departe (scalat cu viteza serverului).
     * Asa nu se poate sari dintr-o alianta in alta doar ca sa culegi bonusuri.
     */
    public function effectiveLevel($uid, $btype)
    {
        if (!self::enabled()) {
            return 0;
        }

        $uid = (int) $uid;
        $res = mysqli_query($this->db,
            "SELECT alliance, alliance_joined FROM " . TB_PREFIX . "users WHERE id = " . $uid . " LIMIT 1");
        $row = $res ? mysqli_fetch_assoc($res) : null;

        if (!$row || (int) $row['alliance'] <= 0) {
            return 0;
        }

        $levels = $this->getLevels((int) $row['alliance']);
        $level  = isset($levels[(int) $btype]) ? (int) $levels[(int) $btype] : 0;

        if ($level <= 1) {
            return $level;      // nivelul 1 e disponibil imediat
        }

        $joined = (int) $row['alliance_joined'];

        // 0 sau 1 inseamna membru dinainte de aceasta functie: primeste tot
        if ($joined <= 1) {
            return $level;
        }

        $speed   = (defined('SPEED') && SPEED > 0) ? (float) SPEED : 1.0;
        $elapsed = time() - $joined;

        // nivelul N devine disponibil dupa (N-1) * 24h de la intrare
        $allowed = 1 + (int) floor($elapsed / max(60, (86400 / $speed)));

        return max(0, min($level, $allowed));
    }

    /**
     * Cat mai are de asteptat un jucator pana i se deschide nivelul urmator.
     *
     * Intoarce numarul de secunde, sau 0 daca deja beneficiaza de tot ce a
     * deblocat alianta. Se foloseste in pagina de bonusuri: fara asta, un
     * membru nou vede "nivel 2" dar simte efectul nivelului 1 si nu are cum
     * sa-si dea seama de ce.
     */
    public function waitingFor($uid, $btype)
    {
        if (!self::enabled()) {
            return 0;
        }

        $uid = (int) $uid;
        $res = mysqli_query($this->db,
            "SELECT alliance, alliance_joined FROM " . TB_PREFIX . "users WHERE id = " . $uid . " LIMIT 1");
        $row = $res ? mysqli_fetch_assoc($res) : null;

        if (!$row || (int) $row['alliance'] <= 0) {
            return 0;
        }

        $levels    = $this->getLevels((int) $row['alliance']);
        $unlocked  = isset($levels[(int) $btype]) ? (int) $levels[(int) $btype] : 0;
        $effective = $this->effectiveLevel($uid, $btype);

        if ($effective >= $unlocked) {
            return 0;       // beneficiaza deja de tot
        }

        $joined = (int) $row['alliance_joined'];

        if ($joined <= 1) {
            return 0;
        }

        $speed = (defined('SPEED') && SPEED > 0) ? (float) SPEED : 1.0;
        $step  = max(60, (int) (86400 / $speed));

        // nivelul (effective + 1) devine disponibil dupa effective * step
        $ready = $joined + ($effective * $step);

        return max(0, $ready - time());
    }

    /* ------------------------------------------------------------------ */
    /* Donatii                                                             */
    /* ------------------------------------------------------------------ */

    /** Cat a donat un jucator azi. */
    public function donatedToday($uid)
    {
        if (!self::enabled()) {
            return 0.0;
        }

        $uid = (int) $uid;
        $day = (int) floor(time() / 86400);

        $res = mysqli_query($this->db,
            "SELECT amount FROM " . TB_PREFIX . "alliance_donation
              WHERE uid = " . $uid . " AND day = " . $day . " LIMIT 1");
        $row = $res ? mysqli_fetch_assoc($res) : null;

        return $row ? (float) $row['amount'] : 0.0;
    }

    /**
     * Doneaza resurse catre un bonus.
     *
     * $amounts   - array cu patru valori: lemn, lut, fier, cereale
     * $triple    - daca jucatorul plateste aur ca donatia sa conteze intreit
     *
     * Tipul resursei nu conteaza, doar totalul; resursele se scad din satul
     * activ. Intoarce una dintre constantele DONATE_*.
     */
    public function donate($uid, $wref, $btype, array $amounts, $triple = false)
    {
        global $database, $session;

        if (!self::enabled()) {
            return self::DONATE_DISABLED;
        }

        $uid   = (int) $uid;
        $wref  = (int) $wref;
        $btype = (int) $btype;

        if (!isset(self::types()[$btype])) {
            return self::DONATE_INVALID;
        }

        // sumele trebuie sa fie intregi pozitivi
        $clean = array();
        $total = 0.0;

        foreach (array_slice($amounts, 0, 4) as $a) {
            $a = (float) $a;

            if ($a < 0 || !is_finite($a)) {
                return self::DONATE_INVALID;
            }

            $a = floor($a);
            $clean[] = $a;
            $total  += $a;
        }

        while (count($clean) < 4) {
            $clean[] = 0.0;
        }

        if ($total <= 0) {
            return self::DONATE_INVALID;
        }

        // alianta jucatorului
        $res = mysqli_query($this->db,
            "SELECT alliance FROM " . TB_PREFIX . "users WHERE id = " . $uid . " LIMIT 1");
        $row = $res ? mysqli_fetch_assoc($res) : null;
        $aid = $row ? (int) $row['alliance'] : 0;

        if ($aid <= 0) {
            return self::DONATE_NO_ALLIANCE;
        }

        // bonusul nu trebuie sa fie in curs de upgrade
        $state = $this->getState($aid);

        if ($state[$btype]['upgrade_end'] > time()) {
            return self::DONATE_UPGRADING;
        }

        if ($state[$btype]['level'] >= self::MAX_LEVEL) {
            return self::DONATE_INVALID;
        }

        // valoarea contorizata (triplata sau nu)
        $counted = $triple ? $total * 3 : $total;

        /**
         * ULTIMUL NIVEL: nu se accepta mai mult decat mai e nevoie.
         *
         * La nivelurile intermediare surplusul e util - ramane in fond si
         * finanteaza nivelul urmator. Dar la trecerea spre nivelul MAXIM nu mai
         * exista nivel urmator: ce depaseste costul ar ramane blocat in fond
         * pentru totdeauna, fara sa mai poata fi folosit sau recuperat.
         *
         * Asa ca aici oprim donatia si spunem exact cat se poate dona. Nu
         * plafonam automat: jucatorul ar plati fara sa stie cat, iar cu triplare
         * diferenta ar fi si mai greu de urmarit.
         */
        if ($state[$btype]['level'] === self::MAX_LEVEL - 1) {

            $needed = self::costFor($state[$btype]['level']) - (float) $state[$btype]['pool'];
            $needed = max(0, $needed);

            if ($counted > $needed) {
                // cat trebuie sa introduca in casute (inainte de triplare)
                self::$overMaxAllowed = $triple
                    ? (float) floor($needed / 3)
                    : $needed;

                return self::DONATE_OVER_MAX;
            }
        }

        $limit   = self::dailyLimit($this->highestLevel($aid));
        $already = $this->donatedToday($uid);

        if ($already + $counted > $limit) {
            return self::DONATE_LIMIT;
        }

        // aurul pentru triplare
        if ($triple) {
            $cost = defined('ALLIANCE_BONUS_TRIPLE_GOLD') ? (int) ALLIANCE_BONUS_TRIPLE_GOLD : 3;

            if ((int) $session->gold < $cost) {
                return self::DONATE_NO_GOLD;
            }
        }

        // Resursele trebuie sa existe in sat.
        // FIX: getResource() nu exista in clasa de baza de date; randul satului
        // (cu wood/clay/iron/crop) se citeste cu getVillage(), fara cache, ca sa
        // vedem valorile de dupa ultima productie, nu unele vechi de cateva zeci
        // de secunde.
        $vres = $database->getVillage($wref, 0, false);

        if (!$vres) {
            return self::DONATE_RESOURCES;
        }

        $fields = array('wood', 'clay', 'iron', 'crop');

        foreach ($fields as $i => $f) {
            if ((float) $vres[$f] < $clean[$i]) {
                return self::DONATE_RESOURCES;
            }
        }

        /* ---- de aici incolo modificam starea; totul intr-o tranzactie ---- */
        mysqli_query($this->db, "START TRANSACTION");

        // ATENTIE LA SEMN: modifyResource cu modul 0 SCADE deja
        // ("wood = wood - $wood"). Trimiterea de valori negative ar fi
        // ADAUGAT resurse - aceeasi capcana ca la aurul de la demolare.
        $ok = $database->modifyResource($wref, $clean[0], $clean[1], $clean[2], $clean[3], 0);

        if (!$ok) {
            mysqli_query($this->db, "ROLLBACK");
            return self::DONATE_RESOURCES;
        }

        // randul de bonus poate lipsi: il cream la prima donatie
        mysqli_query($this->db,
            "INSERT INTO " . TB_PREFIX . "alliance_bonus (aid, btype, level, pool, upgrade_end)
             VALUES (" . $aid . ", " . $btype . ", 0, 0, 0)
             ON DUPLICATE KEY UPDATE aid = aid");

        // adaugam in fond DOAR daca bonusul tot nu e in upgrade (protejeaza
        // impotriva a doua donatii simultane care ar sari peste verificare)
        $res = mysqli_query($this->db,
            "UPDATE " . TB_PREFIX . "alliance_bonus
                SET pool = pool + " . $counted . "
              WHERE aid = " . $aid . " AND btype = " . $btype . "
                AND upgrade_end <= " . time() . " AND level < " . self::MAX_LEVEL . " LIMIT 1");

        if (!$res || mysqli_affected_rows($this->db) === 0) {
            mysqli_query($this->db, "ROLLBACK");
            return self::DONATE_UPGRADING;
        }

        $day = (int) floor(time() / 86400);
        mysqli_query($this->db,
            "INSERT INTO " . TB_PREFIX . "alliance_donation (uid, day, amount)
             VALUES (" . $uid . ", " . $day . ", " . $counted . ")
             ON DUPLICATE KEY UPDATE amount = amount + " . $counted);

        mysqli_query($this->db,
            "INSERT INTO " . TB_PREFIX . "alliance_donation_log (aid, uid, btype, amount, time)
             VALUES (" . $aid . ", " . $uid . ", " . $btype . ", " . $counted . ", " . time() . ")");

        if ($triple) {
            $cost = defined('ALLIANCE_BONUS_TRIPLE_GOLD') ? (int) ALLIANCE_BONUS_TRIPLE_GOLD : 3;

            // PERMISIUNI SITTER: donatia tripla costa aur. Daca sitterul nu are
            // dreptul, donatia simpla (deja inregistrata mai sus) ramane valida,
            // doar bonusul platit nu se aplica.
            if (!isset($session) || !method_exists($session, 'sitterCan')
                || $session->sitterCan(SITTER_PERM_GOLD)) {

                if ($database->spendGold($uid, $cost, 'Alliance bonus triple donation')) {
                    $session->gold -= $cost;
                }
            }
        }

        mysqli_query($this->db, "COMMIT");

        // daca fondul a atins pragul, pornim upgrade-ul
        $this->startUpgradeIfReady($aid, $btype);

        unset(self::$levelCache[$aid]);

        return self::DONATE_OK;
    }

    /**
     * Porneste numaratoarea daca fondul acopera costul nivelului urmator.
     * Costul se scade din fond, ca surplusul sa se reporteze la nivelul urmator.
     */
    public function startUpgradeIfReady($aid, $btype)
    {
        $aid   = (int) $aid;
        $btype = (int) $btype;

        $res = mysqli_query($this->db,
            "SELECT level, pool, upgrade_end FROM " . TB_PREFIX . "alliance_bonus
              WHERE aid = " . $aid . " AND btype = " . $btype . " LIMIT 1");
        $row = $res ? mysqli_fetch_assoc($res) : null;

        if (!$row || (int) $row['upgrade_end'] > time() || (int) $row['level'] >= self::MAX_LEVEL) {
            return false;
        }

        $level = (int) $row['level'];
        $cost  = self::costFor($level);

        if ($cost <= 0 || (float) $row['pool'] < $cost) {
            return false;
        }

        $end = time() + self::upgradeSeconds($level);

        mysqli_query($this->db,
            "UPDATE " . TB_PREFIX . "alliance_bonus
                SET pool = pool - " . $cost . ", upgrade_end = " . $end . "
              WHERE aid = " . $aid . " AND btype = " . $btype . "
                AND upgrade_end <= " . time() . " LIMIT 1");

        return true;
    }

    /**
     * Finalizeaza upgrade-urile expirate. Se apeleaza din Automation.
     * Dupa crestere, verificam din nou fondul: daca surplusul acopera si
     * nivelul urmator, upgrade-ul continua fara alta donatie.
     */
    public function processUpgrades()
    {
        if (!self::enabled()) {
            return 0;
        }

        $now  = time();
        $done = 0;

        $res = mysqli_query($this->db,
            "SELECT aid, btype FROM " . TB_PREFIX . "alliance_bonus
              WHERE upgrade_end > 0 AND upgrade_end <= " . $now);

        $rows = array();

        while ($res && ($row = mysqli_fetch_assoc($res))) {
            $rows[] = array((int) $row['aid'], (int) $row['btype']);
        }

        foreach ($rows as $r) {
            list($aid, $btype) = $r;

            $ok = mysqli_query($this->db,
                "UPDATE " . TB_PREFIX . "alliance_bonus
                    SET level = level + 1, upgrade_end = 0
                  WHERE aid = " . $aid . " AND btype = " . $btype . "
                    AND upgrade_end > 0 AND upgrade_end <= " . $now . "
                    AND level < " . self::MAX_LEVEL . " LIMIT 1");

            if ($ok && mysqli_affected_rows($this->db) > 0) {
                $done++;
                unset(self::$levelCache[$aid]);
                $this->startUpgradeIfReady($aid, $btype);
            }
        }

        return $done;
    }

    /** Contributia fiecarui membru, pentru afisare. */
    public function contributions($aid, $limit = 30)
    {
        if (!self::enabled()) {
            return array();
        }

        $aid   = (int) $aid;
        $limit = max(1, min(100, (int) $limit));
        $out   = array();

        $res = mysqli_query($this->db,
            "SELECT d.uid, u.username, SUM(d.amount) AS total
               FROM " . TB_PREFIX . "alliance_donation_log d
               LEFT JOIN " . TB_PREFIX . "users u ON u.id = d.uid
              WHERE d.aid = " . $aid . "
              GROUP BY d.uid, u.username
              ORDER BY total DESC
              LIMIT " . $limit);

        while ($res && ($row = mysqli_fetch_assoc($res))) {
            $out[] = array(
                'uid'      => (int) $row['uid'],
                'username' => (string) $row['username'],
                'total'    => (float) $row['total'],
            );
        }

        return $out;
    }

    /* ------------------------------------------------------------------ */
    /* Ajutor pentru hook-urile din joc                                    */
    /* ------------------------------------------------------------------ */

    /**
     * Multiplicatorul unui bonus pentru un jucator, ca numar (1.0 = fara bonus).
     * Folosit de Technology, Battle, Market si Building.
     *
     * Rezultatul e cache-uit pe cerere: se cere de multe ori intr-o singura
     * pagina (fiecare unitate din lista de instruire, fiecare val din lupta).
     */
    public static function multiplier($uid, $btype)
    {
        static $cache = array();

        $uid   = (int) $uid;
        $btype = (int) $btype;
        $key   = $uid . ':' . $btype;

        if (isset($cache[$key])) {
            return $cache[$key];
        }

        if (!self::enabled() || $uid <= 0) {
            return $cache[$key] = 1.0;
        }

        $engine = new self();
        $level  = $engine->effectiveLevel($uid, $btype);
        $pct    = self::percentFor($btype, $level);

        return $cache[$key] = 1.0 + ($pct / 100.0);
    }
}
