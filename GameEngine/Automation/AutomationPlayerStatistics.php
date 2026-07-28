<?php

#################################################################################
##  AutomationPlayerStatistics                                                  ##
## ---------------------------------------------------------------------------  ##
##  Periodically takes a snapshot of every player's rank, population, and army. ##
##  These snapshots are used to draw the graphs on the Plus statistics page.    ##
##                                                                              ##
##  Guarded by NEW_FUNCTIONS_PLUS_STATISTICS. When enabled, snapshots are taken ##
##  for ALL players; however, the statistics tab is only visible to players     ##
##  with an active Plus account.                                                ##
##                                                                              ##
##  Data is recorded for ALL players, not only Plus users; otherwise, a player  ##
##  who purchases Plus would open the page and see an empty graph at the exact  ##
##  moment they activated it.                                                   ##
#################################################################################

trait AutomationPlayerStatistics
{
    /**
     * Inregistreaza un instantaneu, daca a trecut destul de la ultimul.
     *
     * Intervalul e controlat de PLUS_STATS_INTERVAL_HOURS. Verificarea se face
     * pe baza celui mai recent rand din tabela, nu pe un fisier marker: daca
     * tabela e goala (prima rulare) sau cron-ul a stat oprit, instantaneul se
     * ia imediat.
     */
    private function recordPlayerStatistics()
    {
        global $database;

        if (!defined('NEW_FUNCTIONS_PLUS_STATISTICS') || !NEW_FUNCTIONS_PLUS_STATISTICS) {
            return false;
        }

        $table = TB_PREFIX . 'player_statistics_history';

        // Pe un server care nu a rulat migrarea, tabela lipseste. Iesim linistit,
        // in loc sa aruncam o eroare la fiecare tick de cron.
        $check = @mysqli_query($database->dblink, "SHOW TABLES LIKE '" . $table . "'");

        if (!$check || mysqli_num_rows($check) === 0) {
            return false;
        }

        $hours    = defined('PLUS_STATS_INTERVAL_HOURS') ? (float) PLUS_STATS_INTERVAL_HOURS : 6.0;
        $interval = (int) max(600, round($hours * 3600));
        $now      = time();

        $res  = mysqli_query($database->dblink,
            "SELECT MAX(recorded_at) AS last FROM " . $table);
        $row  = $res ? mysqli_fetch_assoc($res) : null;
        $last = $row ? (int) $row['last'] : 0;

        if ($last > 0 && ($now - $last) < $interval) {
            return false;
        }

        $this->writePlayerStatisticsSnapshot($now);
        $this->trimPlayerStatistics($now);

        return true;
    }

    /**
     * Scrie efectiv instantaneul.
     *
     * Populatia, satele si punctele vin dintr-o singura interogare. Trupele se
     * numara separat, fiindca hrana consumata are nevoie de datele de unitate
     * din PHP (fiecare unitate are alt consum).
     */
    private function writePlayerStatisticsSnapshot($now)
    {
        global $database;

        $table = TB_PREFIX . 'player_statistics_history';

        // rang, populatie, sate si puncte de lupta, per jucator
        $q = "SELECT
                  u.id AS uid,
                  u.oldrank AS rank,
                  COALESCE(SUM(v.pop), 0) AS population,
                  COUNT(CASE WHEN v.type != 99 THEN v.wref END) AS villages,
                  u.apall AS attack_points,
                  u.dpall AS defence_points
              FROM " . TB_PREFIX . "users u
              LEFT JOIN " . TB_PREFIX . "vdata v ON v.owner = u.id
              WHERE u.id > 5 AND u.access > 0
              GROUP BY u.id";

        $res = mysqli_query($database->dblink, $q);

        if (!$res) {
            return;
        }

        $players = array();

        while ($row = mysqli_fetch_assoc($res)) {
            $players[(int) $row['uid']] = array(
                'rank'           => (int) $row['rank'],
                'population'     => (int) $row['population'],
                'villages'       => (int) $row['villages'],
                'attack_points'  => (int) $row['attack_points'],
                'defence_points' => (int) $row['defence_points'],
                'troop_count'    => 0,
                'troop_upkeep'   => 0,
            );
        }

        if (!$players) {
            return;
        }

        $this->addTroopTotals($players);

        // scriem in loturi, ca sa nu facem o interogare per jucator
        $values = array();

        foreach ($players as $uid => $p) {
            $values[] = '(' . (int) $uid . ',' . (int) $now . ','
                . $p['rank'] . ',' . $p['population'] . ',' . $p['villages'] . ','
                . $p['troop_count'] . ',' . $p['troop_upkeep'] . ','
                . $p['attack_points'] . ',' . $p['defence_points'] . ')';
        }

        foreach (array_chunk($values, 200) as $chunk) {
            mysqli_query($database->dblink,
                "INSERT IGNORE INTO " . $table . "
                    (uid, recorded_at, `rank`, population, villages,
                     troop_count, troop_upkeep, attack_points, defence_points)
                 VALUES " . implode(',', $chunk));
        }
    }

    /**
     * Aduna trupele fiecarui jucator si hrana pe care o consuma.
     *
     * Se numara trupele din satele proprii SI intaririle trimise altora
     * (enforcement.`from` pastreaza satul de origine, deci ele raman ale
     * trimitatorului). Trupele straine stationate la tine NU se numara: nu sunt
     * armata ta.
     *
     * Numarul brut de unitati e inselator - 1000 de falange nu inseamna cat 1000
     * de calareti de elita - de aceea inregistram si hrana consumata, care e
     * cantarul propriu al jocului si pondereaza automat unitatile dupa putere.
     */
    private function addTroopTotals(array &$players)
    {
        global $database;

        // consumul fiecarei unitati, din datele de joc
        $upkeep = array();

        for ($i = 1; $i <= 90; $i++) {
            $name = 'u' . $i;

            if (isset($GLOBALS[$name]) && isset($GLOBALS[$name]['pop'])) {
                $upkeep[$i] = (int) $GLOBALS[$name]['pop'];
            }
        }

        if (!$upkeep) {
            return;
        }

        // suma pe coloane, pentru trupele din satele proprii
        $sumCount  = array();
        $sumUpkeep = array();

        foreach ($upkeep as $i => $cost) {
            $sumCount[]  = 'SUM(t.u' . $i . ')';
            $sumUpkeep[] = 'SUM(t.u' . $i . ') * ' . $cost;
        }

        $sources = array(
            // trupele din satele proprii
            "SELECT v.owner AS uid,
                    " . implode(' + ', $sumCount) . " AS cnt,
                    " . implode(' + ', $sumUpkeep) . " AS upk
               FROM " . TB_PREFIX . "units t
               JOIN " . TB_PREFIX . "vdata v ON v.wref = t.vref
              GROUP BY v.owner",

            // intaririle trimise altora: raman ale satului de origine
            "SELECT v.owner AS uid,
                    " . implode(' + ', $sumCount) . " AS cnt,
                    " . implode(' + ', $sumUpkeep) . " AS upk
               FROM " . TB_PREFIX . "enforcement t
               JOIN " . TB_PREFIX . "vdata v ON v.wref = t.`from`
              GROUP BY v.owner",
        );

        foreach ($sources as $q) {
            $res = @mysqli_query($database->dblink, $q);

            while ($res && ($row = mysqli_fetch_assoc($res))) {
                $uid = (int) $row['uid'];

                if (!isset($players[$uid])) {
                    continue;
                }

                $players[$uid]['troop_count']  += (int) $row['cnt'];
                $players[$uid]['troop_upkeep'] += (int) $row['upk'];
            }
        }
    }

    /** Sterge instantaneele mai vechi decat retentia configurata. */
    private function trimPlayerStatistics($now)
    {
        global $database;

        $days = defined('PLUS_STATS_KEEP_DAYS') ? (int) PLUS_STATS_KEEP_DAYS : 0;

        if ($days <= 0) {
            return;     // 0 = pastram tot
        }

        mysqli_query($database->dblink,
            "DELETE FROM " . TB_PREFIX . "player_statistics_history
              WHERE recorded_at < " . (int) ($now - $days * 86400) . "
              LIMIT 5000");
    }
}
