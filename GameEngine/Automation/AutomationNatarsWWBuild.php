<?php
#################################################################################
##  AutomationNatarsWWBuild                                                    ##
## --------------------------------------------------------------------------- ##
##  Natarii isi ridica singuri Minunea Lumii din capitala lor.                  ##
##                                                                             ##
##  Pornesc dupa un numar configurabil de zile de la aparitia planurilor de     ##
##  constructie (NATARS_WW_START_DELAY) si urca nivel cu nivel, folosind        ##
##  timpii REALI din datele de joc (bid40), scalati cu viteza serverului.       ##
##                                                                             ##
##  Ca in Travian: la nivelul 100 Minunea e gata (si serverul se incheie), iar  ##
##  la nivelul 75 Natarii isi recheama trupele ca s-o apere.                    ##
#################################################################################

trait AutomationNatarsWWBuild
{
    /**
     * Ridica Minunea Natarilor cu un nivel, cand vine timpul.
     *
     * Se apeleaza la fiecare tick; face ceva doar cand nivelul curent s-a
     * terminat de construit.
     */
    private function buildNatarsWonder()
    {
        global $database, $bid40;

        $delay = defined('NATARS_WW_START_DELAY') ? (int) NATARS_WW_START_DELAY : 10;

        // 0 = Natarii nu construiesc deloc
        if ($delay <= 0) {
            return false;
        }

        // Planurile trebuie sa fi aparut deja: pana atunci nici jucatorii nu pot
        // construi, deci nu are sens ca Natarii s-o ia inainte.
        if (!method_exists($database, 'areArtifactsSpawned') || !$database->areArtifactsSpawned(true)) {
            return false;
        }

        $planTime = strtotime(START_DATE)
            + ((defined('NATARS_WW_BUILDING_PLAN_SPAWN_TIME') ? (int) NATARS_WW_BUILDING_PLAN_SPAWN_TIME : 0) * 86400);

        $speed  = (defined('SPEED') && SPEED > 0) ? (float) SPEED : 1.0;
        $startAt = $planTime + (int) round($delay * 86400 / $speed);

        if (time() < $startAt) {
            return false;
        }

        $natarUid = defined('NATARS_UID') ? (int) NATARS_UID : 2;

        // capitala Natarilor: satul lor care are slotul de Minune
        $res = mysqli_query($database->dblink,
            "SELECT v.wref, f.f99 AS level
               FROM " . TB_PREFIX . "vdata v
               JOIN " . TB_PREFIX . "fdata f ON f.vref = v.wref
              WHERE v.owner = " . $natarUid . " AND v.capital = 1 AND f.f99t = 40
              LIMIT 1");

        $row = $res ? mysqli_fetch_assoc($res) : null;

        if (!$row) {
            return false;
        }

        $wref  = (int) $row['wref'];
        $level = (int) $row['level'];

        if ($level >= 100) {
            return false;       // gata, nu mai are ce urca
        }

        // Un nivel deja in lucru? Coada de constructii tine randul in bdata.
        $busy = mysqli_query($database->dblink,
            "SELECT COUNT(*) AS total FROM " . TB_PREFIX . "bdata WHERE wid = " . $wref);
        $busyRow = $busy ? mysqli_fetch_assoc($busy) : null;

        if ($busyRow && (int) $busyRow['total'] > 0) {
            return false;       // asteptam sa se termine nivelul curent
        }

        $next = $level + 1;

        if (!isset($bid40[$next]['time'])) {
            return false;
        }

        // Timpul REAL din datele de joc, scalat cu viteza serverului - la fel ca
        // pentru orice alta constructie. Natarii nu sar peste el.
        $buildTime = (int) max(1, round($bid40[$next]['time'] / $speed));

        // Folosim metoda jocului, nu SQL propriu: ea actualizeaza si tipul
        // cladirii in fdata si respecta formatul cozii.
        $ok = $database->addBuilding($wref, 99, 40, 0, time() + $buildTime, 0, $next);

        if (!$ok) {
            error_log('[TravianZ] Natars WW: constructia nu a pornit: '
                . mysqli_error($database->dblink));

            return false;
        }

        return true;
    }
}
