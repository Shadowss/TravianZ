<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Logging.php                                                 ##
##  License:       TravianZ Project                                            ##
##  Refactor by:   Shadow                                                      ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Logging {

    /* ==============================
       INTERNAL SAFE EXECUTOR
    ============================== */

    private function safeInsert($query, $types, $params) {
        global $database;

        $stmt = mysqli_prepare($database->dblink, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    /* ==============================
       ILLEGAL LOG
    ============================== */

    public function addIllegal($uid, $ref, $type) {
        if (!LOG_ILLEGAL) return;

        $uid = (int)$uid;
        $ref = (string)$ref;
        $type = (int)$type;

        $log = "Attempted to ";
        if ($type === 1) {
            $log .= "access village " . $ref;
        }

        $this->safeInsert(
            "INSERT INTO ".TB_PREFIX."illegal_log (user, log) VALUES (?, ?)",
            "is",
            array($uid, $log)
        );
    }

    /* ==============================
       LOGIN LOG
    ============================== */

    public function addLoginLog($id, $ip) {
        if (!LOG_LOGIN) return;

        $id = (int)$id;
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';

        $this->safeInsert(
            "INSERT INTO ".TB_PREFIX."login_log (uid, ip) VALUES (?, ?)",
            "is",
            array($id, $ip)
        );
    }

    /* ==============================
       BUILD LOG
    ============================== */

    public function addBuildLog($wid, $building, $level, $type) {
        if (!LOG_BUILD) return;

        $wid = (int)$wid;
        $building = (string)$building;
        $level = (int)$level;
        $type = (int)$type;

        $log = $type
            ? "Start Construction of "
            : "Start Upgrade of ";

        $log .= $building . " to level " . $level;

        $this->safeInsert(
            "INSERT INTO ".TB_PREFIX."build_log (wid, log) VALUES (?, ?)",
            "is",
            array($wid, $log)
        );
    }

    /* ==============================
       TECH LOG
    ============================== */

    public function addTechLog($wid, $tech, $level) {
        if (!LOG_TECH) return;

        $wid = (int)$wid;
        $tech = (string)$tech;
        $level = (int)$level;

        $log = "Upgrading of tech " . $tech . " to level " . $level;

        $this->safeInsert(
            "INSERT INTO ".TB_PREFIX."tech_log (wid, log) VALUES (?, ?)",
            "is",
            array($wid, $log)
        );
    }

    /* ==============================
       GOLD FINISH LOG
    ============================== */

    public function goldFinLog($wid) {
        if (!LOG_GOLD_FIN) return;

        $wid = (int)$wid;
        $log = "Finish construction and research with gold";

        $this->safeInsert(
            "INSERT INTO ".TB_PREFIX."gold_fin_log (wid, log) VALUES (?, ?)",
            "is",
            array($wid, $log)
        );
    }

    /* ==============================
       MARKET LOG
    ============================== */

    public function addMarketLog($wid, $type, $data) {
        if (!LOG_MARKET) return;

        $wid = (int)$wid;
        $type = (int)$type;

        if (!is_array($data)) return;

        if ($type === 1) {
            $log = "Sent "
                . (int)$data[0] . ","
                . (int)$data[1] . ","
                . (int)$data[2] . ","
                . (int)$data[3]
                . " to village " . (int)$data[4];
        }
        elseif ($type === 2) {
            $log = "Traded resource between "
                . $wid . " and "
                . (int)$data[0]
                . " market ref is "
                . (int)$data[1];
        } else {
            return;
        }

        $this->safeInsert(
            "INSERT INTO ".TB_PREFIX."market_log (wid, log) VALUES (?, ?)",
            "is",
            array($wid, $log)
        );
    }

    /* ==============================
       DEBUG (SAFE)
    ============================== */

    public static function debug($debug_info, $time = 0) {
        global $generator;

        $prefix = '';

        if ($time > 0 && isset($generator)) {
            $t = $generator->procMtime($time);
            if (is_array($t) && isset($t[1])) {
                $prefix = "[" . $t[1] . "] ";
            }
        }

        $safe = json_encode($prefix . (string)$debug_info, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

        echo "<script>console.log(" . $safe . ");</script>";
    }
}

$logging = new Logging();
