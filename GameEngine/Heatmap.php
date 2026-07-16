<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Heatmap.php                                               ##
##  Type           : World-map heatmap aggregation (Admin tool)                ##
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
 * Heatmap
 * -------------------------------------------------------------------------
 * Aggregates the world map into a coarse grid for the admin heatmap: village
 * density, per-tribe density, inactive-player density, and incoming-attack
 * density. Read-only — no schema, purely derived from existing tables
 * (vdata + wdata + users + movement). Helps with spawn / starting-balance
 * decisions and spotting attack hotspots or dead zones.
 */
class Heatmap
{
    const DEFAULT_RES           = 40;  // grid is RES x RES cells
    const MIN_RES               = 10;
    const MAX_RES               = 90;
    const DEFAULT_INACTIVE_DAYS = 14;

    /** Tribe id -> display name (for legend / tooltips). */
    public static function tribeNames()
    {
        return [
            1 => 'Romans', 2 => 'Teutons', 3 => 'Gauls',
            6 => 'Huns', 7 => 'Egyptians', 8 => 'Spartans', 9 => 'Vikings',
        ];
    }

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

    /** Map radius: coordinates run -MAX .. +MAX on both axes. */
    private static function worldMax()
    {
        if (defined('WORLD_MAX') && (int) WORLD_MAX > 0) {
            return (int) WORLD_MAX;
        }
        return 200; // sane fallback
    }

    /**
     * Build the heatmap grid.
     *
     * @param array $opts 'res' (cells per side), 'inactive_days'.
     * @return array {
     *   res, world_max, cell_span, inactive_days,
     *   cells        => list of non-empty cells (see below),
     *   max          => ['villages'=>, 'inactive'=>, 'attacks'=>, 'pop'=>],
     *   tribe_totals => [tribe => count],
     *   totals       => ['villages'=>, 'inactive'=>, 'attacks'=>, 'players'=>],
     * }
     *
     * Each cell:
     *   cx, cy      grid indices (0..res-1, cy from top)
     *   x0,y0,x1,y1 world-coordinate bounds of the cell
     *   villages, inactive, attacks, pop
     *   tribes      => [tribe => count]
     *   dom         => dominant tribe id (0 if none)
     */
    public static function grid(array $opts = [])
    {
        $res  = isset($opts['res']) ? (int) $opts['res'] : self::DEFAULT_RES;
        $res  = max(self::MIN_RES, min(self::MAX_RES, $res));
        $days = isset($opts['inactive_days']) ? max(1, (int) $opts['inactive_days']) : self::DEFAULT_INACTIVE_DAYS;

        $max  = self::worldMax();
        $span = 2 * $max + 1;                 // total coordinate width
        $cellSpan = $span / $res;             // coords per cell

        $empty = [
            'res' => $res, 'world_max' => $max, 'cell_span' => $cellSpan,
            'inactive_days' => $days, 'cells' => [],
            'max' => ['villages' => 0, 'inactive' => 0, 'attacks' => 0, 'pop' => 0],
            'tribe_totals' => [], 'totals' => ['villages' => 0, 'inactive' => 0, 'attacks' => 0, 'players' => 0],
        ];

        $link = self::link();
        if (!$link) {
            return $empty;
        }

        // cellIndex: map a coordinate to 0..res-1.
        $idx = function ($coord) use ($max, $span, $res) {
            $i = (int) floor(($coord + $max) / $span * $res);
            if ($i < 0) { $i = 0; }
            if ($i >= $res) { $i = $res - 1; }
            return $i;
        };

        $cells = [];        // "cx:cy" => cell
        $tribeTotals = [];
        $totVil = $totInact = $totAtk = 0;
        $players = [];

        $touch = function ($cx, $cy) use (&$cells, $max, $cellSpan, $res) {
            $key = $cx . ':' . $cy;
            if (!isset($cells[$key])) {
                $x0 = -$max + $cx * $cellSpan;
                // cy is measured from the TOP (north = +y), so invert for y bounds.
                $y1 = $max - $cy * $cellSpan;
                $cells[$key] = [
                    'cx' => $cx, 'cy' => $cy,
                    'x0' => (int) round($x0), 'x1' => (int) round($x0 + $cellSpan),
                    'y0' => (int) round($y1 - $cellSpan), 'y1' => (int) round($y1),
                    'villages' => 0, 'inactive' => 0, 'attacks' => 0, 'pop' => 0,
                    'tribes' => [],
                ];
            }
            return $key;
        };

        // ---- Villages + tribe + inactivity ----
        $now = time();
        $cut = $now - $days * 86400;
        $q = "SELECT w.x AS x, w.y AS y, u.tribe AS tribe, v.pop AS pop, u.timestamp AS ts, u.id AS uid
              FROM `" . TB_PREFIX . "vdata` v
              JOIN `" . TB_PREFIX . "wdata` w ON v.wref = w.id
              JOIN `" . TB_PREFIX . "users` u ON v.owner = u.id
              WHERE v.owner > 3 AND w.x IS NOT NULL AND w.y IS NOT NULL";
        if ($r = @mysqli_query($link, $q)) {
            while ($row = mysqli_fetch_assoc($r)) {
                $cx = $idx((int) $row['x']);
                // North is +y at the top of the map, so top row (cy=0) = +max.
                $cy = $idx(-(int) $row['y']);
                $key = $touch($cx, $cy);

                $cells[$key]['villages']++;
                $cells[$key]['pop'] += (int) $row['pop'];
                $tribe = (int) $row['tribe'];
                if ($tribe > 0) {
                    if (!isset($cells[$key]['tribes'][$tribe])) { $cells[$key]['tribes'][$tribe] = 0; }
                    $cells[$key]['tribes'][$tribe]++;
                    if (!isset($tribeTotals[$tribe])) { $tribeTotals[$tribe] = 0; }
                    $tribeTotals[$tribe]++;
                }
                if ((int) $row['ts'] > 0 && (int) $row['ts'] < $cut) {
                    $cells[$key]['inactive']++;
                    $totInact++;
                }
                $totVil++;
                $players[(int) $row['uid']] = true;
            }
            mysqli_free_result($r);
        }

        // ---- Incoming attacks in flight (sort_type 3 = attack, 4 = raid) ----
        $q2 = "SELECT w.x AS x, w.y AS y, COUNT(*) AS c
               FROM `" . TB_PREFIX . "movement` m
               JOIN `" . TB_PREFIX . "wdata` w ON m.`to` = w.id
               WHERE m.sort_type IN (3,4) AND m.proc = 0
               GROUP BY w.x, w.y";
        if ($r = @mysqli_query($link, $q2)) {
            while ($row = mysqli_fetch_assoc($r)) {
                $cx = $idx((int) $row['x']);
                $cy = $idx(-(int) $row['y']);
                $key = $touch($cx, $cy);
                $cells[$key]['attacks'] += (int) $row['c'];
                $totAtk += (int) $row['c'];
            }
            mysqli_free_result($r);
        }

        // ---- Finalise: dominant tribe + maxima ----
        $maxV = $maxI = $maxA = $maxP = 0;
        $list = [];
        foreach ($cells as $c) {
            $dom = 0; $domCount = 0;
            foreach ($c['tribes'] as $t => $n) {
                if ($n > $domCount) { $domCount = $n; $dom = $t; }
            }
            $c['dom'] = $dom;
            if ($c['villages'] > $maxV) { $maxV = $c['villages']; }
            if ($c['inactive'] > $maxI) { $maxI = $c['inactive']; }
            if ($c['attacks']  > $maxA) { $maxA = $c['attacks']; }
            if ($c['pop']      > $maxP) { $maxP = $c['pop']; }
            $list[] = $c;
        }

        return [
            'res' => $res, 'world_max' => $max, 'cell_span' => $cellSpan,
            'inactive_days' => $days,
            'cells' => $list,
            'max' => ['villages' => $maxV, 'inactive' => $maxI, 'attacks' => $maxA, 'pop' => $maxP],
            'tribe_totals' => $tribeTotals,
            'totals' => [
                'villages' => $totVil, 'inactive' => $totInact,
                'attacks' => $totAtk, 'players' => count($players),
            ],
        ];
    }
}
