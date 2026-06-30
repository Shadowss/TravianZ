<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:        TravianZ                                                   ##
##  Version:        18.05.2026                                                 ##
##  Filename:       GameEngine\Admin\database.php                              ##
##  Developed by:   Dzoki		                                               ##
##  Refactored by:  Shadow                                                     ##
##  License:        TravianZ Project                                           ##
##  Copyright:      TravianZ (c) 2010-2026. All rights reserved.               ##
##  URLs:           https://travianz.org                                       ##
##                  https://github.com/Shadowss/TravianZ                       ##
##                                                                             ##
#################################################################################

/* ---------------------------------------------------------------------------
 * Compatibilitate mysqli_result pentru cod legacy
 * --------------------------------------------------------------------------- */
if (!function_exists('mysqli_result')) {
    function mysqli_result($res, $row, $field = 0) {
        $res->data_seek($row);
        $datarow = $res->fetch_array();
        return $datarow[$field];
    }
}

/* ---------------------------------------------------------------------------
 * Autoloader path - caută maxim 5 nivele în sus
 * --------------------------------------------------------------------------- */
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix. 'autoloader.php')) {
        break;
    }
}

/* ---------------------------------------------------------------------------
 * Include-uri condiționate
 * --------------------------------------------------------------------------- */
if (isset($gameinstall) && $gameinstall == 1) {
    include_once($autoprefix. "GameEngine/config.php");
    include_once($autoprefix. "GameEngine/Data/buidata.php");
} else {
    include_once($autoprefix. "GameEngine/Data/unitdata.php");
    include_once($autoprefix. "GameEngine/Technology.php");
    include_once($autoprefix. "GameEngine/Data/buidata.php");
}
include_once($autoprefix. "GameEngine/Database.php");

/* ---------------------------------------------------------------------------
 * Clasa principală admin DB
 * --------------------------------------------------------------------------- */
class adm_DB {

    var $connection;

    function __construct() {
        global $database;
        $database = new MYSQLi_DB(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB, (defined('SQL_PORT')? SQL_PORT : 3306));
        $this->connection = $database->return_link();
    }

    /* ---------------- Login admin ---------------- */
    function Login($username, $password) {
        global $database;
        list($username, $password) = $database->escape_input($username, $password);

        $q = "SELECT id, password, is_bcrypt FROM ". TB_PREFIX. "users WHERE username = '$username' AND access >= ". MULTIHUNTER;
        $result = mysqli_query($this->connection, $q);

        // compatibilitate cu DB fără coloana is_bcrypt
        if (mysqli_error($database->dblink)!= '') {
            $q = "SELECT id, password, 0 as is_bcrypt FROM ". TB_PREFIX. "users WHERE username = '$username' AND access >= ". MULTIHUNTER;
            $result = mysqli_query($this->connection, $q);
            $bcrypt_update_done = false;
        } else {
            $bcrypt_update_done = true;
        }

        $dbarray = mysqli_fetch_array($result);

        // verificare parolă - bcrypt sau md5 legacy
        $bcrypted = true;
        $pwOk = password_verify($password, $dbarray['password']);

        if (!$pwOk &&!$dbarray['is_bcrypt']) {
            $pwOk = ($dbarray['password'] == md5($password));
            $bcrypted = false;
        }

        $username = htmlspecialchars($username);
        // proxy-aware (issue #185): log the real client IP behind a trusted reverse proxy
        $realIp = \App\Utils\IpResolver::getClientIp() ?? ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
        if ($pwOk) {
            // upgrade la bcrypt dacă e necesar
            if (!$dbarray['is_bcrypt'] &&!$bcrypted) {
                mysqli_query($this->connection, "UPDATE ". TB_PREFIX. "users SET password = '". password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]). "'". ($bcrypt_update_done? ", is_bcrypt = 1" : ""). " WHERE id = ". (int)$dbarray['id']);
            }
            mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0,'X','$username logged in (IP: <b>". $realIp. "</b>)',". time(). ")");
            return true;
        } else {
            mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0,'X','<font color=\'red\'><b>IP: ". $realIp. " tried to log in with username <u> $username</u> but access was denied!</font></b>',". time(). ")");
            return false;
        }
    }

    /* ---------------- Recalculare populație ---------------- */
    function recountPopUser($uid) {
        global $database;
        $villages = $database->getProfileVillages($uid);
        for ($i = 0; $i <= count($villages) - 1; $i++) {
            $vid = $villages[$i]['wref'];
            $this->recountPop($vid);
            $this->recountCP($vid);
        }
    }

    function recountPop($vid) {
        global $database;
        $fdata = $database->getResourceLevel($vid);
        $popTot = 0;
        for ($i = 1; $i <= 40; $i++) {
            $lvl = $fdata["f". $i];
            $building = $fdata["f". $i. "t"];
            if ($building > 0 && $lvl > 0) {
                $popTot += $this->buildingPOP($building, $lvl);
            }
        }
        $q = "UPDATE ". TB_PREFIX. "vdata SET pop = $popTot WHERE wref = ". (int)$vid;
        mysqli_query($this->connection, $q);
    }

    function recountCP($vid) {
        global $database;
        $fdata = $database->getResourceLevel($vid);
        $popTot = 0;
        for ($i = 1; $i <= 40; $i++) {
            $lvl = $fdata["f". $i];
            $building = $fdata["f". $i. "t"];
            if ($building > 0 && $lvl > 0) {
                $popTot += $this->buildingCP($building, $lvl);
            }
        }
        $q = "UPDATE ". TB_PREFIX. "vdata SET cp = $popTot WHERE wref = ". (int)$vid;
        mysqli_query($this->connection, $q);
    }

    function buildingPOP($f, $lvl) {
        $name = "bid". $f;
        global $$name;
        $popT = 0;
        $dataarray = $$name;
        for ($i = 1; $i <= $lvl; $i++) {
            $popT += $dataarray[$i]['pop']?? 0;
        }
        return $popT;
    }

    function buildingCP($f, $lvl) {
        $name = "bid". $f;
        global $$name;
        $popT = 0;
        $dataarray = $$name;
        for ($i = 1; $i <= $lvl; $i++) {
            $popT += $dataarray[$i]['cp']?? 0;
        }
        return $popT;
    }

    /* ---------------- Utilitare sate ---------------- */
    function getWref($x, $y) {
        $q = "SELECT id FROM ". TB_PREFIX. "wdata WHERE x = ". (int)$x. " AND y = ". (int)$y;
        $result = mysqli_query($this->connection, $q);
        $r = mysqli_fetch_array($result);
        return $r['id'];
    }

	function AddVillage($post) {
		global $database;

    $wid = $this->getWref($post['x'], $post['y']);
    $uid = (int)$post['uid'];
    $status = $database->getVillageState($wid);
    $status = 0;

    if ($status == 0) {
        $database->setFieldTaken($wid);

        $user = $database->getUserArray($uid, 1);
        $username = $user['username'];

        $database->addVillage($wid, $uid, $username, '0');
        $database->addResourceFields($wid, $database->getVillageType($wid, false));
        $database->addUnits($wid);
        $database->addTech($wid);
        $database->addABTech($wid);

        /* ---------------- Admin log ---------------- */
        $villageName = $database->getVillageField($wid, 'name');
        if (empty($villageName) || $villageName == '?') {
            $villageName = $username . "'s village";
        }

        $villageNameSafe = htmlspecialchars($villageName, ENT_QUOTES, 'UTF-8');
        $userNameSafe = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        $logText = "Added new village <b><a href='admin.php?p=village&did=$wid'>$villageNameSafe</a></b> to user <b><a href='admin.php?p=player&uid=$uid'>$userNameSafe</a></b>";
        $logEsc = $database->escape($logText);

        mysqli_query(
            $this->connection,
            "INSERT INTO " . TB_PREFIX . "admin_log (`id`, `user`, `log`, `time`)
             VALUES (
                 0,
                 " . (int)$_SESSION['id'] . ",
                 '$logEsc',
                 " . time() . "
             )"
        );
    }
}

    /* ---------------- Pedepsire jucător ---------------- */

	function Punish($post) {
		global $database;
		$villages = $database->getProfileVillages($post['uid']);
		$user = $database->getUserArray($post['uid'], 1);
		$logPunishment = '';

    for ($i = 0; $i < count($villages); $i++) {
        $vid = (int)$villages[$i]['wref'];

        // 1. pedeapsă procent populație
        if (!empty($post['punish'])) {
            $punish = (int)$post['punish'];
            $logPunishment = "<b>-". $punish ."%</b> population";
            $popOld = (int)$villages[$i]['pop'];
            $proc = 100 - $punish;
            $pop = floor(($popOld / 100) * $proc);
            if ($pop < 2) { $pop = 2; }
            $this->PunishBuilding($vid, $proc, $pop);
        }

        // 2. ștergere trupe - CORECTAT
        if (!empty($post['del_troop'])) {
            $logPunishment = "<b>troops removal</b>";
            $tribe = (int)$user['tribe'];
            // 1=Romani (1-10), 2=Teutoni (11-20), 3=Gali (21-30), 4=Natura (31-40), 5=Natari (41-50)
            $unitStart = ($tribe >= 1 && $tribe <= 5) ? (($tribe - 1) * 10 + 1) : 1;
            $this->DelUnits($vid, $unitStart);
        }

        // 3. golire depozite
        if (!empty($post['clean_ware'])) {
            $logPunishment = "<b>emptying warehouses</b>";
            $time = time();
            $q = "UPDATE ". TB_PREFIX ."vdata SET `wood`='0', `clay`='0', `iron`='0', `crop`='0', `lastupdate`='$time' WHERE wref=$vid";
            mysqli_query($this->connection, $q);
        }
    }

    mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX ."admin_log VALUES (0,". (int)$_SESSION['id'] .",'Punished user: <a href=\'admin.php?p=player&uid=". (int)$post['uid'] ."\'>". (int)$post['uid'] ."</a> with ". $logPunishment ."',". time() .")");
	}

	function PunishBuilding($vid, $proc, $pop) {
		global $database;
		$vid = (int)$vid;
		mysqli_query($this->connection, "UPDATE ". TB_PREFIX ."vdata SET pop=". (int)$pop ." WHERE wref=$vid");
    
    $fdata = $database->getResourceLevel($vid);
    for ($i = 1; $i <= 40; $i++) {
        if ($fdata['f'.$i] > 1) {
            $zm = ($fdata['f'.$i] / 100) * $proc;
            $zm = ($zm < 1) ? 1 : floor($zm);
            mysqli_query($this->connection, "UPDATE ". TB_PREFIX ."fdata SET `f$i`='$zm' WHERE `vref`=$vid");
        }
    }
	}

	// CORECTAT: șterge doar cele 10 unități ale tribului, FĂRĂ erou
	function DelUnits($vid, $unitStart) {
		$vid = (int)$vid;
		$unitStart = (int)$unitStart;
		$sets = [];
    for ($i = $unitStart; $i <= $unitStart + 9; $i++) {
        $sets[] = "`u$i`='0'";
    }
    // intenționat NU includem `hero` - eroul trebuie să rămână în sat
    $q = "UPDATE ". TB_PREFIX ."units SET ". implode(', ', $sets) ." WHERE `vref`=$vid";
    mysqli_query($this->connection, $q);
	}

	// păstrată pentru compatibilitate (nu mai e folosită în buclă)
	function DelUnits2($vid, $unit) {
    $q = "UPDATE ". TB_PREFIX ."units SET `u". (int)$unit ."`='0' WHERE `vref`=". (int)$vid;
    mysqli_query($this->connection, $q);
	}

    /* ---------------- Ștergere jucător ---------------- */
    function DelPlayer($uid, $pass) {
        global $database;
        $ID = (int)$_SESSION['id'];
        if ($this->CheckPass($pass, $ID)) {
            $villages = $database->getProfileVillages($uid);
            for ($i = 0; $i <= count($villages) - 1; $i++) {
                $this->DelVillage($villages[$i]['wref'], 1);
            }
            $q = "DELETE FROM ". TB_PREFIX. "hero WHERE uid = ". (int)$uid;
            mysqli_query($this->connection, $q);

            $name = $database->getUserField($uid, "username", 0);
            mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0,$ID,'Deleted user <a>$name</a>',". time(). ")");

            $q = "DELETE FROM ". TB_PREFIX. "users WHERE `id` = ". (int)$uid;
            mysqli_query($this->connection, $q);
        } else {
            return false;
        }
        return true;
    }

    function getUserActive() {
        $time = time() - (60 * 5);
        $q = "SELECT * FROM ". TB_PREFIX. "users WHERE timestamp > $time AND username!= 'support' ORDER BY access DESC, username ASC";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function CheckPass($password, $uid) {
        $q = "SELECT id,password, is_bcrypt FROM ". TB_PREFIX. "users WHERE id = ". (int)$uid. " AND access = ". ADMIN;
        $result = mysqli_query($this->connection, $q);

        if (mysqli_error($this->connection)!= '') {
            $q = "SELECT password, 0 as is_bcrypt FROM ". TB_PREFIX. "users WHERE id = ". (int)$uid. " AND access = ". ADMIN;
            $result = mysqli_query($this->connection, $q);
            $bcrypt_update_done = false;
        } else {
            $bcrypt_update_done = true;
        }

        $dbarray = mysqli_fetch_array($result);

        if (!$dbarray) {
            // proxy-aware (issue #185)
            $realIp = \App\Utils\IpResolver::getClientIp() ?? ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
            mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0,'X','<font color=\'red\'><b>IP: ". $realIp. " tried to log in with uid $uid but access was denied!</font></b>',". time(). ")");
            return false;
        }

        $bcrypted = true;
        $pwOk = password_verify($password, $dbarray['password']);

        if (!$pwOk &&!$dbarray['is_bcrypt']) {
            $pwOk = ($dbarray['password'] == md5($password));
            $bcrypted = false;
        }

        if ($pwOk) {
            if ($bcrypt_update_done &&!$dbarray['is_bcrypt']) {
                mysqli_query($this->connection, "UPDATE ". TB_PREFIX. "users SET password = '". password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]). "', is_bcrypt = 1 WHERE id = ". (int)$dbarray['id']);
            }
            return true;
        } else {
            return false;
        }
    }

    /* ---------------- Ștergere sat ---------------- */

	function DelVillage($wref, $mode = 0) {
    global $database;

    $wref = (int)$wref;
    $mode = (int)$mode;

    // Check if village exist
    if ($mode === 0) {
        $q = "SELECT COUNT(*) AS Total
              FROM " . TB_PREFIX . "vdata
              WHERE wref = $wref AND capital = 0";
    } else {
        $q = "SELECT COUNT(*) AS Total
              FROM " . TB_PREFIX . "vdata
              WHERE wref = $wref";
    }

    $result = mysqli_fetch_assoc(mysqli_query($this->connection, $q));

    if (empty($result['Total'])) {
        return false;
    }

    // Log admin
    mysqli_query(
        $this->connection,
        "INSERT INTO " . TB_PREFIX . "admin_log
         VALUES (
            0,
            " . (int)$_SESSION['id'] . ",
            'Deleted village <b>$wref</b>',
            " . time() . "
         )"
    );

    // clean expansion slots
    $database->clearExpansionSlot($wref);

    // tables
    $tables = [
        'abdata'   => 'vref',
        'bdata'    => 'wid',
        'market'   => 'vref',
        'odata'    => 'wref',
        'research' => 'vref',
        'tdata'    => 'vref',
        'fdata'    => 'vref',
        'training' => 'vref',
        'units'    => 'vref',
        'farmlist' => 'wref'
    ];

    foreach ($tables as $table => $field) {
        mysqli_query(
            $this->connection,
            "DELETE FROM " . TB_PREFIX . "$table
             WHERE $field = $wref"
        );
    }

    // delete raids and unprocessed movements
    mysqli_query(
        $this->connection,
        "DELETE FROM " . TB_PREFIX . "raidlist
         WHERE towref = $wref"
    );

    mysqli_query(
        $this->connection,
        "DELETE FROM " . TB_PREFIX . "movement
         WHERE `from` = $wref AND proc = 0"
    );

    // mark coor as free
    mysqli_query(
        $this->connection,
        "UPDATE " . TB_PREFIX . "wdata
         SET occupied = 0
         WHERE id = $wref"
    );

    // clean exp1/exp2/exp3 from other village
    mysqli_query(
        $this->connection,
        "UPDATE " . TB_PREFIX . "vdata
         SET
            exp1 = IF(exp1 = $wref, 0, exp1),
            exp2 = IF(exp2 = $wref, 0, exp2),
            exp3 = IF(exp3 = $wref, 0, exp3)
         WHERE
            exp1 = $wref
            OR exp2 = $wref
            OR exp3 = $wref"
    );

    // come back all troops
    $getmovement = $database->getMovement(3, $wref, 1);

    foreach ($getmovement as $movedata) {
        $time = microtime(true);
        $time2 = $time - $movedata['starttime'];

        $database->setMovementProc($movedata['moveid']);

        $database->addMovement(
            4,
            $movedata['to'],
            $movedata['from'],
            $movedata['ref'],
            $time,
            $time + $time2
        );
    }

    // come back reinforcements
    $this->returnTroops($wref);

    // delete village
    mysqli_query(
        $this->connection,
        "DELETE FROM " . TB_PREFIX . "vdata
         WHERE wref = $wref"
    );

    if (mysqli_affected_rows($this->connection) > 0) {

        mysqli_query(
            $this->connection,
            "UPDATE " . TB_PREFIX . "wdata
             SET occupied = 0
             WHERE id = $wref"
        );

        // free the prisoners
        $getprisoners = $database->getPrisoners($wref);

        foreach ($getprisoners as $pris) {
            $troops = 0;

            for ($i = 1; $i < 12; $i++) {
                $troops += (int)$pris['t' . $i];
            }

            $database->modifyUnit(
                $pris['wref'],
                ['99o'],
                [$troops],
                [0]
            );

            $database->deletePrisoners($pris['id']);
        }

        $getprisoners = $database->getPrisoners3($wref);

        foreach ($getprisoners as $pris) {
            $troops = 0;

            for ($i = 1; $i < 12; $i++) {
                $troops += (int)$pris['t' . $i];
            }

            $database->modifyUnit(
                $pris['wref'],
                ['99o'],
                [$troops],
                [0]
            );

            $database->deletePrisoners($pris['id']);
        }
    }

    return true;
}


    /* ---------------- Ban / Unban ---------------- */
    function DelBan($uid, $id) {
        global $database;
        $name = addslashes($database->getUserField($uid, "username", 0));
        $uid = (int)$uid;
        mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0,". (int)$_SESSION['id']. ",'Unbanned user <a href=\'admin.php?p=player&uid=$uid\'>$name</a>',". time(). ")");
        mysqli_query($this->connection, "UPDATE ". TB_PREFIX. "users SET `access` = '". USER. "' WHERE `id` = $uid;");
        mysqli_query($this->connection, "UPDATE ". TB_PREFIX. "banlist SET `active` = '0' WHERE `id` = ". (int)$id. ";");
    }

    function AddBan($uid, $end, $reason) {
        global $database;
        $name = addslashes($database->getUserField($uid, "username", 0));
        list($end, $reason) = $database->escape_input($end, $reason);
        $uid = (int)$uid;
        mysqli_query($this->connection, "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0,". (int)$_SESSION['id']. ",'Banned user <a href=\'admin.php?p=player&uid=$uid\'>$name</a>',". time(). ")");
        mysqli_query($this->connection, "UPDATE ". TB_PREFIX. "users SET `access` = '0' WHERE `id` = $uid");
        $time = time();
        $admin = (int)$_SESSION['id'];
        $name = addslashes($database->getUserField($uid, 'username', 0));
        $q = "INSERT INTO ". TB_PREFIX. "banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES ($uid, '$name', '$reason', '$time', '$end', '$admin', '1');";
        mysqli_query($this->connection, $q);
    }

    /* ---------------- IP Ban / Unban (issue #185) ---------------- */

    // Lazily creates the IP ban table so existing servers do not need a manual migration.
    function ensureIpBanTable() {
        mysqli_query($this->connection,
            "CREATE TABLE IF NOT EXISTS `". TB_PREFIX. "banlist_ip` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `ip` varbinary(16) NOT NULL,
                `ip_text` varchar(45) DEFAULT NULL,
                `reason` varchar(100) DEFAULT NULL,
                `time` int(11) UNSIGNED DEFAULT NULL,
                `end` int(11) UNSIGNED DEFAULT NULL,
                `admin` int(11) DEFAULT NULL,
                `active` tinyint(1) UNSIGNED DEFAULT 1,
                PRIMARY KEY (`id`),
                UNIQUE KEY `ip` (`ip`),
                KEY `active-end` (`active`,`end`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    // $end is an absolute UNIX timestamp (0 = permanent).
    function AddIpBan($ip, $end, $reason) {
        $this->ensureIpBanTable();

        $ip  = trim((string)$ip);
        $bin = @inet_pton($ip);
        if ($bin === false) {
            return false; // invalid IP, ignore
        }

        $reason = substr((string)$reason, 0, 100);
        $time   = time();
        $end    = (int)$end;
        $admin  = (int)$_SESSION['id'];
        $ipText = $ip;

        $stmt = $this->connection->prepare(
            "INSERT INTO `". TB_PREFIX. "banlist_ip` (ip, ip_text, reason, time, end, admin, active)
             VALUES (?,?,?,?,?,?,1)
             ON DUPLICATE KEY UPDATE
                ip_text = VALUES(ip_text), reason = VALUES(reason),
                time = VALUES(time), end = VALUES(end), admin = VALUES(admin), active = 1"
        );
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sssiii", $bin, $ipText, $reason, $time, $end, $admin);
        $ok = $stmt->execute();
        $stmt->close();

        $logIp = addslashes($ipText);
        mysqli_query($this->connection,
            "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0, $admin, 'Banned IP <b>$logIp</b>', $time)");

        return $ok;
    }

    function DelIpBan($id) {
        $id    = (int)$id;
        $admin = (int)$_SESSION['id'];

        $stmt = $this->connection->prepare(
            "UPDATE `". TB_PREFIX. "banlist_ip` SET active = 0 WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        mysqli_query($this->connection,
            "INSERT INTO ". TB_PREFIX. "admin_log VALUES (0, $admin, 'Removed IP ban #$id', ". time(). ")");
    }

    function search_banned_ip() {
        $this->ensureIpBanTable();
        $now = time();
        $q = "SELECT * FROM ". TB_PREFIX. "banlist_ip
              WHERE active = 1 AND (end IS NULL OR end = 0 OR end > $now) ORDER BY id DESC";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    /* ---------------- Căutări ---------------- */
    function search_player($player) {
        global $database;
        $player = $database->escape($player);
        $q = "SELECT id,username FROM ". TB_PREFIX. "users WHERE `username` LIKE '%$player%' AND username!= 'support'";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function search_email($email) {
        global $database;
        $email = $database->escape($email);
        $q = "SELECT id,email FROM ". TB_PREFIX. "users WHERE `email` LIKE '%$email%' AND username!= 'support'";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function search_village($village) {
        global $database;
        $village = $database->escape($village);
        $q = "SELECT * FROM ". TB_PREFIX. "vdata WHERE `name` LIKE '%$village%' OR `wref` LIKE '%$village%'";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function search_alliance($alliance) {
        global $database;
        $alliance = $database->escape($alliance);
        $q = "SELECT * FROM ". TB_PREFIX. "alidata WHERE `name` LIKE '%$alliance%' OR `tag` LIKE '%$alliance%' OR `id` LIKE '%$alliance%'";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function search_ip($ip) {
        global $database;
        $ip = $database->escape($ip);
        $q = "SELECT * FROM ". TB_PREFIX. "login_log WHERE `ip` LIKE '%$ip%'";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function search_banned() {
        $q = "SELECT * FROM ". TB_PREFIX. "banlist WHERE active = '1'";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function Del_banned() {
        $q = "SELECT * FROM ". TB_PREFIX. "banlist";
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    /* ---------------- Helpers MySQLi ---------------- */
    function mysqli_fetch_all($result) {
        $all = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $all[] = $row;
            }
            return $all;
        }
    }

    function query_return($q) {
        $result = mysqli_query($this->connection, $q);
        return $this->mysqli_fetch_all($result);
    }

    function query($query) {
        // corectat ordinea parametrilor
        return mysqli_query($this->connection, $query);
    }

    /* ---------------- Funcții joc ---------------- */
    public function getTypeLevel($tid, $vid) {
        global $village, $database;
        $keyholder = array();

        if ($vid == 0) {
            $resourcearray = $village->resarray;
        } else {
            $resourcearray = $database->getResourceLevel($vid);
        }
        foreach (array_keys($resourcearray, $tid) as $key) {
            if (strpos($key, 't')) {
                $key = preg_replace("/[^0-9]/", '', $key);
                array_push($keyholder, $key);
            }
        }
        $element = count($keyholder);
        if ($element >= 2) {
            if ($tid <= 4) {
                $temparray = array();
                for ($i = 0; $i <= $element - 1; $i++) {
                    array_push($temparray, $resourcearray['f'. $keyholder[$i]]);
                }
                foreach ($temparray as $key => $val) {
                    if ($val == max($temparray))
                        $target = $key;
                }
            } else {
                $target = 0;
                for ($i = 1; $i <= $element - 1; $i++) {
                    if ($resourcearray['f'. $keyholder[$i]] > $resourcearray['f'. $keyholder[$target]]) {
                        $target = $i;
                    }
                }
            }
        } else if ($element == 1) {
            $target = 0;
        } else {
            return 0;
        }
        if ($keyholder[$target]!= "") {
            return $resourcearray['f'. $keyholder[$target]];
        } else {
            return 0;
        }
    }

    public function procDistanceTime($coor, $thiscoor, $ref, $vid) {
        global $bid28, $bid14;

        $xdistance = ABS($thiscoor['x'] - $coor['x']);
        if ($xdistance > WORLD_MAX) {
            $xdistance = (2 * WORLD_MAX + 1) - $xdistance;
        }
        $ydistance = ABS($thiscoor['y'] - $coor['y']);
        if ($ydistance > WORLD_MAX) {
            $ydistance = (2 * WORLD_MAX + 1) - $ydistance;
        }
        $distance = SQRT(POW($xdistance, 2) + POW($ydistance, 2));
        $speed = $ref;
        $tSquareLevel = $this->getTypeLevel(14, $vid);

        if ($tSquareLevel != 0 && $distance >= TS_THRESHOLD && $speed > 0) {
            // Tournament Square only speeds up the part of the journey beyond
            // the threshold (issue #304): the first TS_THRESHOLD tiles are
            // walked at base speed and the remainder at the boosted speed.
            $boostedSpeed = $speed * ($bid14[$tSquareLevel]['attri'] / 100);
            $time = (TS_THRESHOLD / $speed) + (($distance - TS_THRESHOLD) / $boostedSpeed);

            return round($time * 3600 / INCREASE_SPEED);
        }

        if ($speed!= 0) {
            return round(($distance / $speed) * 3600 / INCREASE_SPEED);
        } else {
            return round($distance * 3600 / INCREASE_SPEED);
        }
    }

    public function returnTroops($wref) {
        global $database;
        $getenforce = $database->getEnforceVillage($wref, 0);
        foreach ($getenforce as $enforce) {
            $to = $database->getVillage($enforce['from']);
            $start = ($database->getUserField($to['owner'], 'tribe', 0) - 1) * 10 + 1;
            $end = ($database->getUserField($to['owner'], 'tribe', 0) * 10);

            $from = $database->getVillage($enforce['from']);
            $fromcoor = $database->getCoor($enforce['from']);
            $tocoor = $database->getCoor($enforce['vref']);
            $fromCor = array('x' => $tocoor['x'], 'y' => $tocoor['y']);
            $toCor = array('x' => $fromcoor['x'], 'y' => $fromcoor['y']);

            $speeds = array();
            for ($i = $start; $i <= $end; $i++) {
                if (intval($enforce['u'. $i]) > 0) {
                    $unitarray = $GLOBALS["u". $i];
                    $speeds[] = $unitarray['speed'];
                } else {
                    $enforce['u'. $i] = '0';
                }
            }

            if (intval($enforce['hero']) > 0) {
                $q = "SELECT * FROM ". TB_PREFIX. "hero WHERE uid = ". (int)$from['owner']. " AND dead = 0";
                $result = mysqli_query($database->dblink, $q);
                $hero_f = mysqli_fetch_array($result);
                $hero_unit = $hero_f['unit'];
                $speeds[] = $GLOBALS['u'. $hero_unit]['speed'];
            } else {
                $enforce['hero'] = '0';
            }

            $troopsTime = $this->procDistanceTime($fromCor, $toCor, min($speeds), $enforce['from']);
            $time = $database->getArtifactsValueInfluence($from['owner'], $enforce['from'], 2, $troopsTime);

            $reference = $database->addAttack($enforce['from'], $enforce['u'. $start], $enforce['u'. ($start + 1)], $enforce['u'. ($start + 2)], $enforce['u'. ($start + 3)], $enforce['u'. ($start + 4)], $enforce['u'. ($start + 5)], $enforce['u'. ($start + 6)], $enforce['u'. ($start + 7)], $enforce['u'. ($start + 8)], $enforce['u'. ($start + 9)], $enforce['hero'], 2, 0, 0, 0, 0);
            $database->addMovement(4, $wref, $enforce['from'], $reference, time(), ($time + time()));
            $database->deleteReinf($enforce['id']);
        }
    }

    public function calculateProduction($wid, $uid, $b1, $b2, $b3, $b4, $fdata, $ocounter, $pop) {
        global $technology, $database;
        $isNatar = $database->getVillageField($wid, "natar");
        $upkeep = $technology->getUpkeep($this->getAllUnits($wid), 0, $wid);
        $production = [];
        $production['wood'] = $this->getWoodProd($fdata, $ocounter, $b1);
        $production['clay'] = $this->getClayProd($fdata, $ocounter, $b2);
        $production['iron'] = $this->getIronProd($fdata, $ocounter, $b3);
        $production['crop'] = $this->getCropProd($fdata, $ocounter, $b4) - (!$isNatar? $pop : round($pop / 2)) - $upkeep;
        return $production;
    }

    private function getWoodProd($fdata, $ocounter, $b1) {
        global $bid1, $bid5;
        $basewood = $sawmill = 0;
        $woodholder = array();
        for ($i = 1; $i <= 38; $i++) {
            if ($fdata['f'. $i. 't'] == 1) {
                array_push($woodholder, 'f'. $i);
            }
            if ($fdata['f'. $i. 't'] == 5) {
                $sawmill = $fdata['f'. $i];
            }
        }
        for ($i = 0; $i <= count($woodholder) - 1; $i++) {
            $basewood += $bid1[$fdata[$woodholder[$i]]]['prod'];
        }
        $wood = $basewood + $basewood * 0.25 * $ocounter[0];
        if ($sawmill >= 1) {
            $wood += $basewood / 100 * $bid5[$sawmill]['attri'];
        }
        if ($b1 > time()) {
            $wood *= 1.25;
        }
        $wood *= SPEED;
        return round($wood);
    }

    private function getClayProd($fdata, $ocounter, $b2) {
        global $bid2, $bid6;
        $baseclay = $brick = 0;
        $clayholder = array();
        for ($i = 1; $i <= 38; $i++) {
            if ($fdata['f'. $i. 't'] == 2) {
                array_push($clayholder, 'f'. $i);
            }
            if ($fdata['f'. $i. 't'] == 6) {
                $brick = $fdata['f'. $i];
            }
        }
        for ($i = 0; $i <= count($clayholder) - 1; $i++) {
            $baseclay += $bid2[$fdata[$clayholder[$i]]]['prod'];
        }
        $clay = $baseclay + $baseclay * 0.25 * $ocounter[1];
        if ($brick >= 1) {
            $clay += $baseclay / 100 * $bid6[$brick]['attri'];
        }
        if ($b2 > time()) {
            $clay *= 1.25;
        }
        $clay *= SPEED;
        return round($clay);
    }

    private function getIronProd($fdata, $ocounter, $b3) {
        global $bid3, $bid7;
        $baseiron = $foundry = 0;
        $ironholder = array();
        for ($i = 1; $i <= 38; $i++) {
            if ($fdata['f'. $i. 't'] == 3) {
                array_push($ironholder, 'f'. $i);
            }
            if ($fdata['f'. $i. 't'] == 7) {
                $foundry = $fdata['f'. $i];
            }
        }
        for ($i = 0; $i <= count($ironholder) - 1; $i++) {
            $baseiron += $bid3[$fdata[$ironholder[$i]]]['prod'];
        }
        $iron = $baseiron + $baseiron * 0.25 * $ocounter[2];
        if ($foundry >= 1) {
            $iron += $baseiron / 100 * $bid7[$foundry]['attri'];
        }
        if ($b3 > time()) {
            $iron *= 1.25;
        }
        $iron *= SPEED;
        return round($iron);
    }

    private function getCropProd($fdata, $ocounter, $b4) {
        global $bid4, $bid8, $bid9;
        $basecrop = $grainmill = $bakery = 0;
        $cropholder = array();
        for ($i = 1; $i <= 38; $i++) {
            if ($fdata['f'. $i. 't'] == 4) {
                array_push($cropholder, 'f'. $i);
            }
            if ($fdata['f'. $i. 't'] == 8) {
                $grainmill = $fdata['f'. $i];
            }
            if ($fdata['f'. $i. 't'] == 9) {
                $bakery = $fdata['f'. $i];
            }
        }
        for ($i = 0; $i <= count($cropholder) - 1; $i++) {
            $basecrop += $bid4[$fdata[$cropholder[$i]]]['prod'];
        }
        $crop = $basecrop + $basecrop * 0.25 * $ocounter[3];
        $jcrop = 0;
        if ($grainmill >= 1) $jcrop = (isset($bid8[$grainmill]['attri'])? $bid8[$grainmill]['attri'] : 0);
        if ($bakery >= 1) $jcrop += (isset($bid9[$bakery]['attri'])? $bid9[$bakery]['attri'] : 0);
        $crop += $basecrop / 100 * $jcrop;
        if ($b4 > time()) {
            $crop *= 1.25;
        }
        $crop *= SPEED;
        return round($crop);
    }

    function getAllUnits($base, $InVillageOnly = False, $mode = 0) {
        global $database;
        $ownunit = $database->getUnit($base);
        $ownunit['u99'] -= $ownunit['u99'];
        $ownunit['u99o'] -= $ownunit['u99o'];
        $enforcementarray = $database->getEnforceVillage($base, 0);
        if (count($enforcementarray) > 0) {
            foreach ($enforcementarray as $enforce) {
                for ($i = 1; $i <= 50; $i++) {
                    $ownunit['u'. $i] += $enforce['u'. $i];
                }
                $ownunit['hero'] += $enforce['hero'];
            }
        }
        if ($mode == 0) {
            $enforceoasis = $database->getOasisEnforce($base, 0);
            if (count($enforceoasis) > 0) {
                foreach ($enforceoasis as $enforce) {
                    for ($i = 1; $i <= 50; $i++) {
                        $ownunit['u'. $i] += $enforce['u'. $i];
                    }
                    $ownunit['hero'] += $enforce['hero'];
                }
            }
            $enforceoasis1 = $database->getOasisEnforce($base, 1);
            if (count($enforceoasis1) > 0) {
                foreach ($enforceoasis1 as $enforce) {
                    for ($i = 1; $i <= 50; $i++) {
                        $ownunit['u'. $i] += $enforce['u'. $i];
                    }
                    $ownunit['hero'] += $enforce['hero'];
                }
            }

            $prisoners = $database->getPrisoners($base, 1);
            if (!empty($prisoners)) {
                foreach ($prisoners as $prisoner) {
                    $owner = $database->getVillageField($base, "owner");
                    $ownertribe = $database->getUserField($owner, "tribe", 0);
                    $start = ($ownertribe - 1) * 10 + 1;
                    $end = ($ownertribe * 10);
                    for ($i = $start; $i <= $end; $i++) {
                        $j = $i - $start + 1;
                        $ownunit['u'. $i] += $prisoner['t'. $j];
                    }
                    $ownunit['hero'] += $prisoner['t11'];
                }
            }
        }

        if (!$InVillageOnly) {
            $movement = $database->getVillageMovement($base);
            if (!empty($movement)) {
                for ($i = 1; $i <= 50; $i++) {
                    if (isset($movement['u'. $i])) {
                        $ownunit['u'. $i] += $movement['u'. $i];
                    }
                }
                $ownunit['hero'] += $movement['hero'];
            }
        }
        return $ownunit;
    }
};

$admin = new adm_DB;
include("function.php");
?>