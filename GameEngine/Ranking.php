<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|														  |
| Clean some bullshit : Shadow                            |
|														  |
| Copyright:   TravianZ Project All rights reserved       |
\** --------------------------------------------------- **/

		class Ranking {

			public $rankarray = [];
			private $rlastupdate;

			public function getRank() {
				return $this->rankarray;
			}

			public function getUserRank($id) {
				$ranking = $this->getRank();
					if(count($ranking) > 0) {
					foreach($ranking as $key => $row) {
					if($row != "pad" && isset($row['userid']) && $row['userid'] == $id) {
					return $key;
					}
				}
			}
			return 0;
		}

			public function procRankReq($get) {
				global $village, $session;
				if(isset($get['id'])) {
					switch($get['id']) {
						case 1:
							$this->procRankArray();
							break;
						case 8:
							$this->procHeroRankArray();
							if($get['hero'] == 0) {
								$this->getStart(1);
							} else {
								$this->getStart($this->searchRank($session->uid, "uid"));
							}
							break;
						case 11:
							$this->procRankRaceArray(1);
							if($this->searchRank($session->uid, "userid") != 0){
							$this->getStart($this->searchRank($session->uid, "userid"));
							}else{
							$this->getStart(1);
							}
							break;
						case 12:
							$this->procRankRaceArray(2);
							if($this->searchRank($session->uid, "userid") != 0){
							$this->getStart($this->searchRank($session->uid, "userid"));
							}else{
							$this->getStart(1);
							}
							break;
						case 13:
							$this->procRankRaceArray(3);
							if($this->searchRank($session->uid, "userid") != 0){
							$this->getStart($this->searchRank($session->uid, "userid"));
							}else{
							$this->getStart(1);
							}
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
							$this->procARankArray();
							if($get['aid'] == 0) {
								$this->getStart(1);
							} else {
								$this->getStart($this->searchRank($get['aid'], "id"));
							}
							break;
						case 41:
							$this->procAAttRankArray();
							if($get['aid'] == 0) {
								$this->getStart(1);
							} else {
								$this->getStart($this->searchRank($get['aid'], "id"));
							}
							break;
						case 42:
							$this->procADefRankArray();
							if($get['aid'] == 0) {
								$this->getStart(1);
							} else {
								$this->getStart($this->searchRank($get['aid'], "id"));
							}
							break;
					}
				} else {
					$this->procRankArray();
					$this->getStart($this->searchRank($session->uid, "userid"));
				}
			}

			public function procRank($post) {
				if(isset($post['ft'])) {
					switch($post['ft']) {
						case "r1":
						case "r11":
						case "r12":
						case "r13":
						case "r31":
						case "r32":
							if(isset($post['rank']) && $post['rank'] != "") {
								$this->getStart($post['rank']);
							}
							if(isset($post['name']) && $post['name'] != "") {
								$this->getStart($this->searchRank(stripslashes($post['name']), "username"));
							}
							break;
						case "r4":
						case "r42":
						case "r41":
							if(isset($post['rank']) && $post['rank'] != "") {
								$this->getStart($post['rank']);
							}
							if(isset($post['name']) && $post['name'] != "") {
								$this->getStart($this->searchRank(stripslashes($post['name']), "tag"));
							}
							break;
						case "r2":
						case "r8":
							if(isset($post['rank']) && $post['rank'] != "") {
								$this->getStart($post['rank']);
							}
							if(isset($post['name']) && $post['name'] != "") {
								$this->getStart($this->searchRank(stripslashes($post['name']), "name"));
							}
							break;
					}
				}
			}

			private function getStart($search) {
				$multiplier = 1;
				if(!is_numeric($search)) {
					$_SESSION['search'] = htmlspecialchars($search);
				} else {
					if($search > count($this->rankarray)) {
						$search = count($this->rankarray) - 1;
					}
					while($search > (20 * $multiplier)) {
						$multiplier += 1;
					}
					$start = 20 * $multiplier - 19 - 1;
					$_SESSION['search'] = htmlspecialchars($search);
					$_SESSION['start'] = htmlspecialchars($start);
				}
			}

			public function getAllianceRank($id) {
				$this->procARankArray();
				while(true) {
					if(count($this->rankarray) > 1) {
						$key = key($this->rankarray);
						if(isset ($this->rankarray[$key]["id"]) && $this->rankarray[$key]["id"] === $id) {
							return $key;
							break;
						} else {
							if(!next($this->rankarray)) {
								return false;
								break;
							}
						}
					} else {
						return 1;
					}
				}
			}

			public function searchRank($name, $field) {
				$count = count($this->rankarray);
				for ($key = 1; $key < $count; $key++) {
					if (!isset($this->rankarray[$key]) || $this->rankarray[$key] === "pad") {
					continue;
				}
					if (isset($this->rankarray[$key][$field]) &&
					$this->rankarray[$key][$field] == $name) {
					return $key;
				}
			}
					if ($field != "userid") {
					return $name;
			}
					return 0;
			}

			public function procRankArray() {
				global $multisort, $database;
				
				if($GLOBALS['db']->countUser() > 0){
				$holder = array();
				$tribeCondition = SHOW_NATARS ? "(u.tribe <= 5) AND (u.id > 5 OR u.id = 3)" : "u.tribe <= 3 AND u.id > 5";
				$q = "
				SELECT
				u.id AS userid,
				u.username,
				u.oldrank,
				u.alliance,
				a.tag AS allitag,
				SUM(v.pop) AS totalpop,
				COUNT(CASE WHEN v.type != 99 THEN v.wref END) AS totalvillages
				FROM " . TB_PREFIX . "users u
				LEFT JOIN " . TB_PREFIX . "vdata v
				ON v.owner = u.id
				LEFT JOIN " . TB_PREFIX . "alidata a
				ON a.id = u.alliance
				WHERE
				u.access < " . (INCLUDE_ADMIN ? 10 : 8) . "
				AND $tribeCondition
				GROUP BY
				u.id
				ORDER BY
				totalpop DESC,
				totalvillages DESC,
				u.id DESC";
				$result = (mysqli_query($database->dblink,$q));
				$datas = [];
				while($row = mysqli_fetch_assoc($result)) 
				$datas[] = $row;
				if (count($datas)) {
					foreach($datas as $result) {
						$value['userid'] = $result['userid'];
						$value['username'] = $result['username'];
						$value['oldrank'] = $result['oldrank'];
						$value['alliance'] = $result['alliance'];
						$value['aname'] = $result['allitag'];
						$value['totalpop'] = $result['totalpop'];
						$value['totalvillage'] = $result['totalvillages'];
						$holder[] = $value;
					}
				}
				$newholder = ["pad"];
				foreach($holder as $key) array_push($newholder, $key);
				$this->rankarray = $newholder;
			    }
			}

			public function procRankRaceArray($race) {
				global $multisort, $database;
				$race = $database->escape((int) $race);
				$holder = array();
				$q = "SELECT u.id AS userid, u.tribe, u.username, u.alliance, COALESCE(SUM(v.pop),0) AS totalpop, COUNT(CASE WHEN v.type != 99 THEN v.wref END) AS totalvillages, a.tag AS allitag
				FROM " . TB_PREFIX . "users u LEFT JOIN " . TB_PREFIX . "vdata v ON v.owner = u.id LEFT JOIN " . TB_PREFIX . "alidata a ON a.id = u.alliance
				WHERE u.tribe = $race
				AND u.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND u.id > 5 GROUP BY u.id ORDER BY totalpop DESC, totalvillages DESC, userid DESC";
				$result = (mysqli_query($database->dblink,$q));
				$datas = [];
				while($row = mysqli_fetch_assoc($result)) {
				$datas[] = $row;
				}
				if(!empty($datas)) {
					foreach($datas as $result) {
						$value['userid'] = $result['userid'];
						$value['username'] = $result['username'];
						$value['alliance'] = $result['alliance'];
						$value['aname'] = $result['allitag'];
						$value['totalpop'] = $result['totalpop'];
						$value['totalvillage'] = $result['totalvillages'];					
						$holder[] = $value;
					}
				} else {
					$value['userid'] = 0;
					$value['username'] = "No User";
					$value['alliance'] = "";
					$value['aname'] = "";
					$value['totalpop'] = "";
					$value['totalvillage'] = "";
					$holder[] = $value;
				}
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procAttRankArray() {
				global $multisort, $database;
				$holder = array();
			$q = "SELECT u.id AS userid, u.username, u.apall, COUNT(CASE WHEN v.type != 99 THEN v.wref END) AS totalvillages, COALESCE(SUM(v.pop),0) AS pop
			FROM " . TB_PREFIX . "users u LEFT JOIN " . TB_PREFIX . "vdata v ON v.owner = u.id
			WHERE u.apall >= 0 AND u.access < " . (INCLUDE_ADMIN ? 10 : 8) . " AND u.tribe <= 3 AND u.id > 5
			GROUP BY u.id ORDER BY u.apall DESC, pop DESC, u.id DESC";
				$result = mysqli_query($database->dblink,$q) or die(mysqli_error($database->dblink));
				$datas = [];
				while($row = mysqli_fetch_assoc($result)) {
					$datas[] = $row;
				}
				foreach($datas as $key => $row) {
					$value['userid'] = $row['userid'];
					$value['username'] = $row['username'];
					$value['totalvillages'] = $row['totalvillages'];
					$value['id'] = $row['userid'];
					$value['totalpop'] = $row['pop'];
					$value['apall'] = $row['apall'];
					$holder[] = $value;
				}
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procDefRankArray() {
			    global $database;
				$holder = array();
			$q = "SELECT u.id AS userid, u.username, u.dpall, COUNT(CASE WHEN v.type != 99 THEN v.wref END) AS totalvillages, COALESCE(SUM(v.pop),0) AS pop
			FROM " . TB_PREFIX . "users u LEFT JOIN " . TB_PREFIX . "vdata v ON v.owner = u.id
			WHERE u.dpall >= 0 AND u.access < " . (INCLUDE_ADMIN ? 10 : 8) . " AND u.tribe <= 3 AND u.id > 5
			GROUP BY u.id ORDER BY u.dpall DESC, pop DESC, u.id DESC";
				$result = mysqli_query($database->dblink,$q) or die(mysqli_error($database->dblink));
				$datas = [];
				while($row = mysqli_fetch_assoc($result)) {
					$datas[] = $row;
				}
				foreach($datas as $key => $row) {
					$value['userid'] = $row['userid'];
					$value['username'] = $row['username'];
					$value['totalvillages'] = $row['totalvillages'];
					$value['id'] = $row['userid'];
					$value['totalpop'] = $row['pop'];
					$value['dpall'] = $row['dpall'];
					$holder[] = $value;
				}
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procVRankArray() {
				global $multisort;
				$array = $GLOBALS['db']->getVRanking();
				$holder = array();
				foreach($array as $value) {
					$coor = $GLOBALS['db']->getCoor($value['wref']);
					$value['x'] = $coor['x'];
					$value['y'] = $coor['y'];
					$value['user'] = $GLOBALS['db']->getUserField($value['owner'], "username", 0);
					$holder[] = $value;
				}
				$holder = $multisort->sorte($holder, "x", true, 2, "y", true, 2, "pop", false, 2);
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procARankArray() {
				global $multisort, $database;
				$array = $GLOBALS['db']->getARanking();
				$holder = array();
				foreach($array as $value) {
					$memberlist = $GLOBALS['db']->getAllMember($value['id']);
					$totalpop = 0;
                    $memberIDs = [];
                    foreach($memberlist as $member) {
                        $memberIDs[] = $member['id'];
                    }
                    $data = $database->getVSumField($memberIDs,"pop");
                    if (count($data)) {
                        foreach ($data as $row) {
                            $totalpop += $row['Total'];
                        }
                    }
					$value['players'] = count($memberlist);
					$value['totalpop'] = $totalpop;
					if(!isset($value['avg'])) {
						$value['avg'] = (count($memberlist) > 0) ? round($totalpop / count($memberlist)) : 0;
					} else {
						$value['avg'] = 0;
					}
					$holder[] = $value;
				}
				$holder = $multisort->sorte($holder, "totalpop", false, 2);
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procHeroRankArray() {
				global $multisort;
				$array = $GLOBALS['db']->getHeroRanking();
				$holder = array();
				foreach($array as $value) {
					$value['owner'] = $GLOBALS['db']->getUserField($value['uid'], "username", 0);
					$value['level'];
					$value['name'];
					$value['uid'];
					$holder[] = $value;
				}
				$holder = $multisort->sorte($holder, "experience", false, 2);
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procAAttRankArray() {
				global $multisort;
				$array = $GLOBALS['db']->getARanking();
				$holder = array();
				foreach($array as $value) {
					$memberlist = $GLOBALS['db']->getAllMember($value['id']);
					$totalap = 0;
					foreach($memberlist as $member) {
						$totalap += $member['ap'];
					}
					$value['players'] = count($memberlist);
					$value['totalap'] = $totalap;
					if($value['avg'] > 0) {
					$value['avg'] = ($totalap > 0 && count($memberlist) > 0) ? round($totalap / count($memberlist)) : 0;
					} else {
						$value['avg'] = 0;
					}
					$holder[] = $value;
				}
				$holder = $multisort->sorte($holder, "Aap", false, 2);
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}

			public function procADefRankArray() {
				global $multisort;
				$array = $GLOBALS['db']->getARanking();
				$holder = array();
				foreach($array as $value) {
					$memberlist = $GLOBALS['db']->getAllMember($value['id']);
					$totaldp = 0;
					foreach($memberlist as $member) {
						$totaldp += $member['dp'];
					}
					$value['players'] = count($memberlist);
					$value['totaldp'] = $totaldp;
					if($value['avg'] > 0) {
					$value['avg'] = ($totaldp > 0 && count($memberlist) > 0) ? round($totaldp / count($memberlist)) : 0;
					} else {
						$value['avg'] = 0;
					}
					$holder[] = $value;
				}
				$holder = $multisort->sorte($holder, "Adp", false, 2);
				$newholder = array("pad");
				foreach($holder as $key) {
					array_push($newholder, $key);
				}
				$this->rankarray = $newholder;
			}
		}
		;

		$ranking = new Ranking;

?>