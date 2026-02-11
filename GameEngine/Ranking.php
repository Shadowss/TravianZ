<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianZ Project All rights reserved       |
\** --------------------------------------------------- **/

class Ranking {

    public $rankarray = array();
    private $rlastupdate = 0;

    public function getRank() {
        return $this->rankarray;
    }

    public function getUserRank($id) {
        global $database;

        $id = (int)$id;
        $ranking = $this->getRank();

        $usersQuery = "SELECT Count(*) as Total FROM " . TB_PREFIX . "users 
                       WHERE access < " . (INCLUDE_ADMIN ? "10" : "8");

        $usersResult = mysqli_query($database->dblink, $usersQuery);
        if(!$usersResult) return 0;

        $usersRow = mysqli_fetch_array($usersResult, MYSQLI_ASSOC);
        $totalUsers = isset($usersRow['Total']) ? (int)$usersRow['Total'] : 0;

        $limit = $totalUsers + 1;
        $myrank = 0;

        if(!empty($ranking)) {
            for($i = 0; $i < $limit; $i++) {
                if(isset($ranking[$i]['userid']) && $ranking[$i] !== "pad") {
                    if((int)$ranking[$i]['userid'] === $id) {
                        $myrank = $i;
                        break;
                    }
                }
            }
        }

        return $myrank;
    }

    public function procRankReq($get) {
        global $village, $session;

        if(isset($get['id'])) {

            $id = (int)$get['id'];

            switch($id) {

                case 1:
                    $this->procRankArray();
                    break;

                case 8:
                    $this->procHeroRankArray();
                    if(isset($get['hero']) && (int)$get['hero'] !== 0) {
                        $this->getStart($this->searchRank($session->uid, "uid"));
                    } else {
                        $this->getStart(1);
                    }
                    break;

                case 11:
                case 12:
                case 13:
                    $this->procRankRaceArray($id - 10);
                    $rank = $this->searchRank($session->uid, "userid");
                    $this->getStart($rank !== 0 ? $rank : 1);
                    break;

                case 31:
                    $this->procAttRankArray();
                    $this->getStart($this->searchRank($session->uid, "userid"));
                    break;

                case 32:
                    $this->procDefRankArray();
                    $this->getStart($this->searchRank($session->uid, "userid"));
                    break;

                case 2:
                    $this->procVRankArray();
                    $this->getStart($this->searchRank($village->wid, "wref"));
                    break;

                case 4:
                case 41:
                case 42:
                    if($id == 4) $this->procARankArray();
                    if($id == 41) $this->procAAttRankArray();
                    if($id == 42) $this->procADefRankArray();

                    $aid = isset($get['aid']) ? (int)$get['aid'] : 0;
                    if($aid === 0) {
                        $this->getStart(1);
                    } else {
                        $this->getStart($this->searchRank($aid, "id"));
                    }
                    break;
            }

        } else {
            $this->procRankArray();
            $this->getStart($this->searchRank($session->uid, "userid"));
        }
    }

    public function procRank($post) {

        if(!isset($post['ft'])) return;

        $ft = $post['ft'];

        if(isset($post['rank']) && $post['rank'] !== "") {
            $this->getStart((int)$post['rank']);
        }

        if(isset($post['name']) && $post['name'] !== "") {

            $name = stripslashes($post['name']);

            switch($ft) {
                case "r1":
                case "r11":
                case "r12":
                case "r13":
                case "r31":
                case "r32":
                    $this->getStart($this->searchRank($name, "username"));
                    break;

                case "r4":
                case "r42":
                case "r41":
                    $this->getStart($this->searchRank($name, "tag"));
                    break;

                case "r2":
                case "r8":
                    $this->getStart($this->searchRank($name, "name"));
                    break;
            }
        }
    }

    private function getStart($search) {

        if(!is_numeric($search)) {
            $_SESSION['search'] = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
            return;
        }

        $search = (int)$search;
        $count = count($this->rankarray);

        if($count <= 1) return;

        if($search > $count) {
            $search = $count - 1;
        }

        $multiplier = 1;

        while($search > (20 * $multiplier)) {
            $multiplier++;
        }

        $start = (20 * $multiplier) - 19 - 1;

        $_SESSION['search'] = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
        $_SESSION['start']  = htmlspecialchars($start, ENT_QUOTES, 'UTF-8');
    }

    public function getAllianceRank($id) {

        $id = (int)$id;
        $this->procARankArray();

        if(count($this->rankarray) <= 1) return 1;

        foreach($this->rankarray as $key => $row) {
            if($row !== "pad" && isset($row['id']) && (int)$row['id'] === $id) {
                return $key;
            }
        }

        return false;
    }

    public function searchRank($name, $field) {

        if(empty($this->rankarray)) return 0;

        foreach($this->rankarray as $key => $row) {
            if($row !== "pad" && isset($row[$field])) {
                if($row[$field] == $name) {
                    return $key;
                }
            }
        }

        return ($field !== "userid") ? $name : 0;
    }
    public function procRankArray() {
        global $database;

        if($GLOBALS['db']->countUser() <= 0) {
            $this->rankarray = array("pad");
            return;
        }

        $holder = array();

        if(SHOW_NATARS == true) {

            $q = "SELECT u.id userid, u.username username, u.oldrank oldrank, 
                         u.alliance alliance,

                    (SELECT SUM(v.pop) FROM ".TB_PREFIX."vdata v WHERE v.owner = u.id) totalpop,

                    (SELECT COUNT(v.wref) FROM ".TB_PREFIX."vdata v 
                        WHERE v.owner = u.id AND v.type != 99) totalvillages,

                    (SELECT a.tag FROM ".TB_PREFIX."alidata a 
                        WHERE a.id = u.alliance) allitag

                  FROM ".TB_PREFIX."users u
                  WHERE u.access < ".(INCLUDE_ADMIN ? "10" : "8")."
                  AND (u.tribe <= 5 OR u.tribe = 5)
                  AND (u.id > 5 OR u.id = 3)
                  ORDER BY totalpop DESC, totalvillages DESC, userid DESC";

        } else {

            $q = "SELECT u.id userid, u.username username, u.oldrank oldrank, 
                         u.alliance alliance,

                    (SELECT SUM(v.pop) FROM ".TB_PREFIX."vdata v WHERE v.owner = u.id) totalpop,

                    (SELECT COUNT(v.wref) FROM ".TB_PREFIX."vdata v 
                        WHERE v.owner = u.id AND v.type != 99) totalvillages,

                    (SELECT a.tag FROM ".TB_PREFIX."alidata a 
                        WHERE a.id = u.alliance) allitag

                  FROM ".TB_PREFIX."users u
                  WHERE u.access < ".(INCLUDE_ADMIN ? "10" : "8")."
                  AND u.tribe <= 3
                  AND u.id > 5
                  ORDER BY totalpop DESC, totalvillages DESC, userid DESC";
        }

        $result = mysqli_query($database->dblink, $q);
        if(!$result) {
            $this->rankarray = array("pad");
            return;
        }

        while($row = mysqli_fetch_assoc($result)) {

            $value = array();
            $value['userid']       = (int)$row['userid'];
            $value['username']     = $row['username'];
            $value['oldrank']      = (int)$row['oldrank'];
            $value['alliance']     = (int)$row['alliance'];
            $value['aname']        = $row['allitag'];
            $value['totalpop']     = (int)$row['totalpop'];
            $value['totalvillage'] = (int)$row['totalvillages'];

            $holder[] = $value;
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procRankRaceArray($race) {
        global $database;

        $race = (int)$race;
        $holder = array();

        $q = "SELECT u.id userid, u.tribe tribe, u.username username,
                     u.alliance alliance,

                (SELECT SUM(v.pop) FROM ".TB_PREFIX."vdata v 
                    WHERE v.owner = u.id) totalpop,

                (SELECT COUNT(v.wref) FROM ".TB_PREFIX."vdata v 
                    WHERE v.owner = u.id AND v.type != 99) totalvillages,

                (SELECT a.tag FROM ".TB_PREFIX."alidata a 
                    WHERE a.id = u.alliance) allitag

              FROM ".TB_PREFIX."users u
              WHERE u.tribe = $race
              AND u.access < ".(INCLUDE_ADMIN ? "10" : "8")."
              AND u.id > 5
              ORDER BY totalpop DESC, totalvillages DESC, userid DESC";

        $result = mysqli_query($database->dblink, $q);

        if($result && mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                $value = array();
                $value['userid']       = (int)$row['userid'];
                $value['username']     = $row['username'];
                $value['alliance']     = (int)$row['alliance'];
                $value['aname']        = $row['allitag'];
                $value['totalpop']     = (int)$row['totalpop'];
                $value['totalvillage'] = (int)$row['totalvillages'];

                $holder[] = $value;
            }

        } else {

            $holder[] = array(
                'userid'       => 0,
                'username'     => "No User",
                'alliance'     => "",
                'aname'        => "",
                'totalpop'     => "",
                'totalvillage' => ""
            );
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procAttRankArray() {
        global $database;

        $holder = array();

        $q = "SELECT u.id userid, u.username username, u.apall,

                (SELECT COUNT(v.wref) FROM ".TB_PREFIX."vdata v 
                    WHERE v.owner = u.id AND v.type != 99) totalvillages,

                (SELECT SUM(v.pop) FROM ".TB_PREFIX."vdata v 
                    WHERE v.owner = u.id) pop

              FROM ".TB_PREFIX."users u
              WHERE u.apall >= 0
              AND u.access < ".(INCLUDE_ADMIN ? "10" : "8")."
              AND u.tribe <= 3
              AND u.id > 5
              ORDER BY u.apall DESC, pop DESC, userid DESC";

        $result = mysqli_query($database->dblink, $q);

        if(!$result) {
            $this->rankarray = array("pad");
            return;
        }

        while($row = mysqli_fetch_assoc($result)) {

            $value = array();
            $value['userid']        = (int)$row['userid'];
            $value['username']      = $row['username'];
            $value['totalvillages'] = (int)$row['totalvillages'];
            $value['id']            = (int)$row['userid'];
            $value['totalpop']      = (int)$row['pop'];
            $value['apall']         = (int)$row['apall'];

            $holder[] = $value;

            // păstrăm debug comment original (nu afectează logica)
            printf("\n<!-- %s %s %s %s -->\n",
                $value['username'],
                $value['totalvillages'],
                $value['totalpop'],
                $value['apall']
            );
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procDefRankArray() {
        global $database;

        $holder = array();

        $q = "SELECT u.id userid, u.username username, u.dpall,

                (SELECT COUNT(v.wref) FROM ".TB_PREFIX."vdata v 
                    WHERE v.owner = u.id AND v.type != 99) totalvillages,

                (SELECT SUM(v.pop) FROM ".TB_PREFIX."vdata v 
                    WHERE v.owner = u.id) pop

              FROM ".TB_PREFIX."users u
              WHERE u.dpall >= 0
              AND u.access < ".(INCLUDE_ADMIN ? "10" : "8")."
              AND u.tribe <= 3
              AND u.id > 5
              ORDER BY u.dpall DESC, pop DESC, userid DESC";

        $result = mysqli_query($database->dblink, $q);

        if(!$result) {
            $this->rankarray = array("pad");
            return;
        }

        while($row = mysqli_fetch_assoc($result)) {

            $value = array();
            $value['userid']        = (int)$row['userid'];
            $value['username']      = $row['username'];
            $value['totalvillages'] = (int)$row['totalvillages'];
            $value['id']            = (int)$row['userid'];
            $value['totalpop']      = (int)$row['pop'];
            $value['dpall']         = (int)$row['dpall'];

            $holder[] = $value;
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procVRankArray() {
        global $multisort;

        $array = $GLOBALS['db']->getVRanking();
        $holder = array();

        if(!is_array($array)) {
            $this->rankarray = array("pad");
            return;
        }

        foreach($array as $value) {

            $coor = $GLOBALS['db']->getCoor($value['wref']);

            if(!is_array($coor)) {
                $coor = array('x' => 0, 'y' => 0);
            }

            $value['x'] = isset($coor['x']) ? (int)$coor['x'] : 0;
            $value['y'] = isset($coor['y']) ? (int)$coor['y'] : 0;
            $value['user'] = $GLOBALS['db']->getUserField($value['owner'], "username", 0);

            $holder[] = $value;
        }

        if(is_array($holder) && count($holder) > 0) {
            $holder = $multisort->sorte($holder, "x", true, 2, "y", true, 2, "pop", false, 2);
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procARankArray() {
        global $multisort, $database;

        $array = $GLOBALS['db']->getARanking();
        $holder = array();

        if(!is_array($array)) {
            $this->rankarray = array("pad");
            return;
        }

        foreach($array as $value) {

            $memberlist = $GLOBALS['db']->getAllMember($value['id']);
            $totalpop = 0;

            if(!is_array($memberlist)) {
                $memberlist = array();
            }

            $memberIDs = array();
            foreach($memberlist as $member) {
                if(isset($member['id'])) {
                    $memberIDs[] = (int)$member['id'];
                }
            }

            if(count($memberIDs) > 0) {

                $data = $database->getVSumField($memberIDs, "pop");

                if(is_array($data)) {
                    foreach($data as $row) {
                        if(isset($row['Total'])) {
                            $totalpop += (int)$row['Total'];
                        }
                    }
                }
            }

            $value['players'] = count($memberlist);
            $value['totalpop'] = $totalpop;

            if(count($memberlist) > 0) {
                $value['avg'] = (int)round($totalpop / count($memberlist));
            } else {
                $value['avg'] = 0;
            }

            $holder[] = $value;
        }

        if(is_array($holder) && count($holder) > 0) {
            $holder = $multisort->sorte($holder, "totalpop", false, 2);
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procHeroRankArray() {
        global $multisort;

        $array = $GLOBALS['db']->getHeroRanking();
        $holder = array();

        if(!is_array($array)) {
            $this->rankarray = array("pad");
            return;
        }

        foreach($array as $value) {

            $value['owner'] = $GLOBALS['db']->getUserField($value['uid'], "username", 0);

            $holder[] = $value;
        }

        if(count($holder) > 0) {
            $holder = $multisort->sorte($holder, "experience", false, 2);
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procAAttRankArray() {
        global $multisort;

        $array = $GLOBALS['db']->getARanking();
        $holder = array();

        if(!is_array($array)) {
            $this->rankarray = array("pad");
            return;
        }

        foreach($array as $value) {

            $memberlist = $GLOBALS['db']->getAllMember($value['id']);
            $totalap = 0;

            if(!is_array($memberlist)) {
                $memberlist = array();
            }

            foreach($memberlist as $member) {
                if(isset($member['ap'])) {
                    $totalap += (int)$member['ap'];
                }
            }

            $value['players'] = count($memberlist);
            $value['totalap'] = $totalap;

            if(count($memberlist) > 0) {
                $value['avg'] = (int)round($totalap / count($memberlist));
            } else {
                $value['avg'] = 0;
            }

            $holder[] = $value;
        }

        if(count($holder) > 0) {
            $holder = $multisort->sorte($holder, "Aap", false, 2);
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
    public function procADefRankArray() {
        global $multisort;

        $array = $GLOBALS['db']->getARanking();
        $holder = array();

        if(!is_array($array)) {
            $this->rankarray = array("pad");
            return;
        }

        foreach($array as $value) {

            $memberlist = $GLOBALS['db']->getAllMember($value['id']);
            $totaldp = 0;

            if(!is_array($memberlist)) {
                $memberlist = array();
            }

            foreach($memberlist as $member) {
                if(isset($member['dp'])) {
                    $totaldp += (int)$member['dp'];
                }
            }

            $value['players'] = count($memberlist);
            $value['totaldp'] = $totaldp;

            if(count($memberlist) > 0) {
                $value['avg'] = (int)round($totaldp / count($memberlist)); // FIX BUG (era $totalap)
            } else {
                $value['avg'] = 0;
            }

            $holder[] = $value;
        }

        if(count($holder) > 0) {
            $holder = $multisort->sorte($holder, "Adp", false, 2);
        }

        $newholder = array("pad");
        foreach($holder as $row) {
            $newholder[] = $row;
        }

        $this->rankarray = $newholder;
    }
        }
        ;

        $ranking = new Ranking;

?>
