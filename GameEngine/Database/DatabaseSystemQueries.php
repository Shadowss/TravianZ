<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseSystemQueries.php                                   ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       World installation/generation, administration,              ##
##                 maintenance, debugging                                      ##
##                                                                             ##
##  Phase S1: Trait extracted from GameEngine/Database.php                     ##
##            (MYSQLi_DB class).                                               ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

trait DatabaseSystemQueries {


	function getAdminLog() {
		$q = "SELECT id,user,log,time from " . TB_PREFIX . "admin_log where id != 0 ORDER BY id DESC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	/**
	 * Creates a database structure for the game.
	 * Used during installation.
	 *
	 * @return boolean|number Returns TRUE, FALSE or -1. True is for successful data import
	 *                        (from prepared SQL file), false is in case of an SQL error.
	 *                        -1 will be returned in case of any unexpected behavior
	 *                        and unhandled exceptions.
	 */

    public function createDbStructure() {
        global $autoprefix;

        try {
            // check that we don't have the structure in place already
            // (we'd have at least 1 user present, since 4 are being created by default - Support, Nature, Multihunter & Taskmaster)
            try {
                $data_exist = $this->query_return("SELECT * FROM " . TB_PREFIX . "users LIMIT 1");
                if ($data_exist && count($data_exist)) {
                    return false;
                }
            } catch (\Exception $e) {

            }

            // load the DB structure SQL file
            $str = file_get_contents($autoprefix."var/db/struct.sql");
            $str = preg_replace("'%PREFIX%'", TB_PREFIX, $str);
            $result = $this->dblink->multi_query($str);

            // fetch results of the multi-query in order to allow subsequent query() and multi_query() calls to work
            while (mysqli_more_results($this->dblink) && mysqli_next_result($this->dblink)) {;}

            if (!$result) {
                return false;
            }
        } catch (\Exception $e) {
            echo($e);
            return -1;
        }

        return true;
    }

    /**
     * Populates the game database with Map World Data (i.e. creates the whole
     * world with X,Y coordinate squares and their types).
     *
     * Also populates oasis' table data for the squares where there are oasis.
     *
     * @return boolean|number Returns TRUE, FALSE or -1. True is for successful data import
	 *                        (from prepared SQL file), false is in case of an SQL error.
	 *                        -1 will be returned in case of any unexpected behavior
	 *                        and unhandled exceptions.
     */
    public function populateWorldData() {
        global $autoprefix;

        $wdataTable = TB_PREFIX . "wdata";
        $droppedIndexes = [];

        try {
            // check if we don't already have world data
            $data_exist = $this->query_return("SELECT * FROM " . $wdataTable . " LIMIT 1");
            if ($data_exist && count($data_exist)) {
                return false;
            }

            // Best-effort session tuning for faster bulk inserts.
            $sessionTuningStatements = [
                "SET SESSION innodb_flush_log_at_trx_commit=2",
                "SET SESSION sync_binlog=0",
                "SET SESSION unique_checks=0",
                "SET SESSION foreign_key_checks=0",
            ];
            foreach ($sessionTuningStatements as $stmt) {
                try {
                    mysqli_query($this->dblink, $stmt);
                } catch (Throwable $e) {
                    // Ignore tuning failures, they are not required for correctness.
                }
            }

            // Temporarily drop secondary indexes before heavy INSERT .. SELECT.
            // Recreated at the end to speed up map generation on larger worlds.
            $indexesToDrop = ['occupied', 'fieldtype', 'x-y'];
            foreach ($indexesToDrop as $indexName) {
                try {
                    $escapedIndexName = mysqli_real_escape_string($this->dblink, $indexName);
                    $res = mysqli_query($this->dblink, "SHOW INDEX FROM `{$wdataTable}` WHERE Key_name = '{$escapedIndexName}'");
                    if ($res && mysqli_num_rows($res) > 0) {
                        mysqli_query($this->dblink, "ALTER TABLE `{$wdataTable}` DROP INDEX `{$indexName}`");
                        $droppedIndexes[$indexName] = true;
                    }
                } catch (Throwable $e) {
                    // If we can't drop an index, continue with generation anyway.
                }
            }

            // load the data generation SQL file
            $str = file_get_contents($autoprefix."var/db/datagen-world-data.sql");
            $str = preg_replace(["'%PREFIX%'", "'%WORLDSIZE%'"], [TB_PREFIX, WORLD_MAX], $str);
            $result = $this->dblink->multi_query($str);

            // fetch results of the multi-query in order to allow subsequent query() and multi_query() calls to work
            while (mysqli_more_results($this->dblink) && mysqli_next_result($this->dblink)) {;}

            if (!$result) {
                return -1;
            }

            $result = $this->regenerateOasisUnits(-1);
            if (!$result) {
                return -1;
            }
        } catch (\Throwable $e) {
            return -1;
        } finally {
            // Recreate dropped indexes to keep runtime query performance unchanged.
            if (!empty($droppedIndexes)) {
                try {
                    if (isset($droppedIndexes['occupied'])) {
                        mysqli_query($this->dblink, "CREATE INDEX `occupied` ON `{$wdataTable}` (`occupied`)");
                    }
                    if (isset($droppedIndexes['fieldtype'])) {
                        mysqli_query($this->dblink, "CREATE INDEX `fieldtype` ON `{$wdataTable}` (`fieldtype`)");
                    }
                    if (isset($droppedIndexes['x-y'])) {
                        mysqli_query($this->dblink, "CREATE INDEX `x-y` ON `{$wdataTable}` (`x`, `y`)");
                    }
                } catch (Throwable $e) {
                    // Best effort only; installation can proceed and indexes may be rebuilt manually if needed.
                }
            }

            // Restore conservative defaults for this session (best effort).
            try { mysqli_query($this->dblink, "SET SESSION unique_checks=1"); } catch (Throwable $e) {}
            try { mysqli_query($this->dblink, "SET SESSION foreign_key_checks=1"); } catch (Throwable $e) {}
            try { mysqli_query($this->dblink, "SET SESSION innodb_flush_log_at_trx_commit=1"); } catch (Throwable $e) {}
            try { mysqli_query($this->dblink, "SET SESSION sync_binlog=1"); } catch (Throwable $e) {}
        }

        return true;
    }


	/*** Build/rebuild the croppers precompute table from wdata. */
	
		public function TotalCroppers(): int {
			$TBP   = defined('TB_PREFIX') ? TB_PREFIX : 's1_';
			$WDATA = $TBP . 'wdata';

			$res = mysqli_query($this->dblink, "SELECT COUNT(*) AS cnt FROM `$WDATA` WHERE fieldtype IN (1,6)");
			if (!$res) {
				throw new Exception('Count query failed: ' . mysqli_error($this->dblink));
			}

			$row = mysqli_fetch_assoc($res);
			return (int)($row['cnt'] ?? 0);
		}
	
		public function populateCroppers(int $countTotal = 0, bool $truncateFirst = false, int $batch = 20000, ?callable $reporter = null ): array {
            @set_time_limit(0);
            @ini_set('memory_limit', '1G');

            $TBP        = defined('TB_PREFIX') ? TB_PREFIX : 's1_';
            $CROP_TABLE = $TBP . 'croppers';
            $WDATA      = $TBP . 'wdata';

            $total = 0;
            $inTransaction = false;

            try {
                if ($countTotal <= 0) {
                    $row = mysqli_fetch_assoc(mysqli_query($this->dblink, "SELECT COUNT(*) cnt FROM `$WDATA` WHERE fieldtype IN (1,6)"));
                    $countTotal = (int)($row['cnt'] ?? 0);
                }

                if ($truncateFirst && !mysqli_query($this->dblink, "TRUNCATE TABLE `$CROP_TABLE`")) {
                    return ['ok'=>false,'msg'=>'TRUNCATE failed: '.mysqli_error($this->dblink)];
                }

                $sessionTuningStatements = [
                    "SET SESSION innodb_flush_log_at_trx_commit=2",
                    "SET SESSION sync_binlog=0",
                    "SET SESSION unique_checks=0",
                    "SET SESSION foreign_key_checks=0",
                ];
                foreach($sessionTuningStatements as $stmt){
                    try {
                        mysqli_query($this->dblink, $stmt);
                    } catch (Throwable $e) {
                        // Ignore tuning failures, they are not required for correctness.
                    }
                }

                if ($batch < 1000) $batch = 1000;
                if ($batch > 100000) $batch = 100000;
                if($countTotal < 1000) $sliceSize = 200;
                elseif($countTotal < 5000) $sliceSize = 500;
                else $sliceSize = 1000;

                $lastId = 0;
                while (true) {
                    $res = mysqli_query(
                        $this->dblink,
                        "SELECT id AS wref, x, y, fieldtype
                         FROM `$WDATA`
                         WHERE fieldtype IN (1,6) AND id > $lastId
                         ORDER BY id ASC
                         LIMIT $batch"
                    );
                    if (!$res) {
                        return ['ok'=>false,'msg'=>'SELECT failed: '.mysqli_error($this->dblink),'processed'=>$total,'target'=>$countTotal];
                    }

                    $rows = [];
                    while ($r = mysqli_fetch_assoc($res)) { $rows[] = $r; }
                    if (!$rows) break;

                    mysqli_begin_transaction($this->dblink);
                    $inTransaction = true;

                    $n = count($rows);
                    for ($i = 0; $i < $n; $i += $sliceSize) {
                        $chunk  = array_slice($rows, $i, $sliceSize);
                        $values = [];

                        // Compute oasis crop bonus in batch for the whole chunk.
                        $bonusByWref = [];
                        $wrefs = [];
                        foreach ($chunk as $r) {
                            $wrefs[] = (int)$r['wref'];
                        }

                        if (!empty($wrefs)) {
                            $bonusSql = "SELECT
                                    c.id AS wref,
                                    LEAST(
                                        150,
                                        (50 * LEAST(SUM(CASE WHEN od.type = 12 THEN 1 ELSE 0 END), 3)) +
                                        (25 * LEAST(
                                            GREATEST(3 - LEAST(SUM(CASE WHEN od.type = 12 THEN 1 ELSE 0 END), 3), 0),
                                            SUM(CASE WHEN od.type IN (4,9,10,11) THEN 1 ELSE 0 END)
                                        ))
                                    ) AS bonus
                                FROM `$WDATA` c
                                LEFT JOIN `$WDATA` o
                                    ON o.fieldtype = 0
                                   AND o.x BETWEEN (c.x - 3) AND (c.x + 3)
                                   AND o.y BETWEEN (c.y - 3) AND (c.y + 3)
                                LEFT JOIN `{$TBP}odata` od
                                    ON od.wref = o.id
                                   AND od.type IN (12,4,9,10,11)
                                WHERE c.id IN (".implode(',', $wrefs).")
                                GROUP BY c.id";

                            $bonusRes = mysqli_query($this->dblink, $bonusSql);
                            if (!$bonusRes) {
                                mysqli_rollback($this->dblink);
                                $inTransaction = false;
                                return ['ok'=>false,'msg'=>'BONUS SELECT failed: '.mysqli_error($this->dblink),'processed'=>$total,'target'=>$countTotal];
                            }

                            while ($bonusRow = mysqli_fetch_assoc($bonusRes)) {
                                $bonusByWref[(int)$bonusRow['wref']] = (int)($bonusRow['bonus'] ?? 0);
                            }
                        }

                        foreach ($chunk as $r) {
                            $x = (int)$r['x'];
                            $y = (int)$r['y'];
                            $bonus = (int)($bonusByWref[(int)$r['wref']] ?? 0);
                            if ($bonus < 0) $bonus = 0;
                            if ($bonus > 150) $bonus = 150;
                            $values[] = sprintf("(%d,%d,%d,%d,%d)", (int)$r['wref'], $x, $y, (int)$r['fieldtype'], $bonus);
                        }

                        if ($values) {
                            $sql = "INSERT INTO `$CROP_TABLE`
                                    (`wref`,`x`,`y`,`fieldtype`,`best_oasis_bonus`)
                                    VALUES ".implode(',', $values)."
                                    ON DUPLICATE KEY UPDATE
                                      `x`=VALUES(`x`),
                                      `y`=VALUES(`y`),
                                      `fieldtype`=VALUES(`fieldtype`),
                                      `best_oasis_bonus`=VALUES(`best_oasis_bonus`)";
                            if (!mysqli_query($this->dblink, $sql)) {
                                mysqli_rollback($this->dblink);
                                $inTransaction = false;
                                return ['ok'=>false,'msg'=>'INSERT failed: '.mysqli_error($this->dblink),'processed'=>$total,'target'=>$countTotal];
                            }
                        }

                        $total += count($chunk);
                        if ($reporter) {
                            $pct = $countTotal ? min(100, (int)floor(($total / $countTotal) * 100)) : 0;
                            $reporter($total, $countTotal, $pct);
                        }
                    }

                    mysqli_commit($this->dblink);
                    $inTransaction = false;
                    $lastId = (int)$rows[$n - 1]['wref'];
                }

                foreach(["SET SESSION unique_checks=1", "SET SESSION foreign_key_checks=1"] as $stmt){
                    try {
                        mysqli_query($this->dblink, $stmt);
                    } catch (Throwable $e) {
                        // Ignore restore failures if the engine does not support the setting.
                    }
                }

                @mysqli_query($this->dblink, "ANALYZE TABLE `$CROP_TABLE`");
                if ($reporter) { $reporter($total, $countTotal, 100); }
                return ['ok'=>true,'msg'=>'Croppers populated','processed'=>$total,'target'=>$countTotal];
            } catch (Throwable $e) {
                if ($inTransaction) {
                    try {
                        mysqli_rollback($this->dblink);
                    } catch (Throwable $rollbackException) {
                        // Ignore rollback errors after fatal DB exceptions.
                    }
                }
                return ['ok'=>false,'msg'=>$e->getMessage(),'processed'=>$total,'target'=>$countTotal];
            }
		}
	
	/**
	 * Display a system message to all players
	 * 
	 * @param string $message The text of the system message that will be written and displayed to all players
	 */
	
	function displaySystemMessage($message){	
		list($message) = $this->escape_input($message);
		global $autoprefix;
		
		$myFile = $autoprefix."Templates/text.tpl";
		$fh = fopen($myFile, 'w');
		$text = file_get_contents($autoprefix."Templates/text_format.tpl");
		$text = preg_replace("'%TEKST%'", $message, $text);
		fwrite($fh, $text);
		
		//Set "OK" to 1 to all players, so they can visualize the message
		$this->setUsersOk();
	}
	
	/**
	 * Called when a system message is sent or Natars/Artifacts have been spawned
	 * 
	 * @param int $value 1 to make a system message visible to all users, 0 to hide it 
	 * @return bool Returns true if the query was successful, false otherwise
	 */
	
	function setUsersOk($value = 1){
		list($value) = $this->escape_input((int) $value);
		
		$q = "UPDATE " . TB_PREFIX . "users SET ok = $value";
		return mysqli_query($this->dblink, $q);
	}

	public function getMaintenance() {
		$q = "SELECT * FROM ".TB_PREFIX."maintenance WHERE id=1 LIMIT 1";
		$res = $this->query_return($q);
    return $res[0]?? ['active'=>0];
	}
	public function setMaintenance($active, $uid=0) {
		$time = time();
		$active = (int)$active;
		$uid = (int)$uid;
    // REPLACE creează rândul dacă nu există
		return $this->query("REPLACE INTO ".TB_PREFIX."maintenance
        (id, active, started_by, started_at)
        VALUES (1, $active, $uid, $time)");
	}

	/**
	* Debug error-log mode (admin-controlled, transparent to players).
	* Returns the single config row, falling back to safe defaults when the
	* table does not exist yet (so deploying the code before creating the table
	* never produces a blank page).
	*/
	public function getDebugMode() {
		$default = [
        'active'         => 0,
        'lvl_warning'    => 1,
        'lvl_notice'     => 1,
        'lvl_deprecated' => 1,
        'lvl_fatal'      => 1,
        'max_size_mb'    => 5,
        'auto_off_hours' => 6,
        'started_by'     => null,
        'started_at'     => null,
    ];
    try {
        $res = @mysqli_query($this->dblink, "SELECT * FROM ".TB_PREFIX."debug_log WHERE id=1 LIMIT 1");
        if (!$res) {
            return $default;
        }
        $row = mysqli_fetch_assoc($res);
        return $row ?: $default;
    } catch (\Throwable $e) {
        return $default;
    }
}

	/**
	* Toggle the debug mode on/off (stamps who/when on activation).
	*/
	public function setDebugMode($active, $uid = 0) {
		$active = (int)$active;
		$uid    = (int)$uid;
		$time   = time();
    return $this->query("UPDATE ".TB_PREFIX."debug_log
        SET active = $active, started_by = $uid, started_at = $time
        WHERE id = 1");
	}

	/**
	* Persist the debug capture parameters (levels, size cap, auto-off window).
	*/
	public function setDebugSettings($warning, $notice, $deprecated, $fatal, $maxSizeMb, $autoOffHours) {
    $warning      = $warning ? 1 : 0;
    $notice       = $notice ? 1 : 0;
    $deprecated   = $deprecated ? 1 : 0;
    $fatal        = $fatal ? 1 : 0;
    $maxSizeMb    = max(1, (int)$maxSizeMb);
    $autoOffHours = max(0, (int)$autoOffHours);
    return $this->query("UPDATE ".TB_PREFIX."debug_log
        SET lvl_warning = $warning, lvl_notice = $notice, lvl_deprecated = $deprecated,
            lvl_fatal = $fatal, max_size_mb = $maxSizeMb, auto_off_hours = $autoOffHours
        WHERE id = 1");
}
}
