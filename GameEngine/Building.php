<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Building.php                                                ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################


class Building {

	public $NewBuilding = false;
	private $maxConcurrent;
	private $allocated;
	private $basic,$inner,$plus = 0;
	public $buildArray = array();

	public function Building() {
		global $session;
		$this->maxConcurrent = BASIC_MAX;
		if(ALLOW_ALL_TRIBE || $session->tribe == 1) {
			$this->maxConcurrent += INNER_MAX;
		}
		if($session->plus) {
			$this->maxConcurrent += PLUS_MAX;
		}
		$this->LoadBuilding();
		foreach($this->buildArray as $build) {
		if($build['master']==1){
		$this->maxConcurrent += 1;
		}
		}
	}
	
	public function canProcess($id,$tid) {
           	//add fix by ronix
                global $session;
        if($session->access==BANNED){
            header("Location: banned.php");
                        exit;
        } else {
            if ($this->checkResource($id,$tid)!=4) {
                if($tid >= 19) {
                    header("Location: dorf2.php");
                             }
                else {
                    header("Location: dorf1.php");
                              }
                                exit;
             		}
        	}
    	}  

    public function procBuild($get) {
        global $session, $village, $database;
        if(isset($get['a']) && $get['c'] == $session->checker && !isset($get['id'])) {
            if($get['a'] == 0) {
                $this->removeBuilding($get['d']);
            }else {
                $session->changeChecker();
                $this->canProcess($village->resarray['f'.$get['a'].'t'],$get['a']);
                $this->upgradeBuilding($get['a']);
            }
        }
        if(isset($get['master']) && isset($get['id']) && isset($get['time']) && $session->gold >= 1 && $session->goldclub && $village->master == 0 && (isset($get['c']) && $get['c']== $session->checker)) {
            $m=$get['master'];
            $master = $_GET;
            $session->changeChecker();
            if($session->access==BANNED){
                header("Location: banned.php");
                exit;
            }    
            $level = $database->getResourceLevel($village->wid);
            $database->addBuilding($village->wid, $get['id'], $get['master'], 1, $get['time'], 1, $level['f'.$get['id']] + 1 + count($database->getBuildingByField($village->wid,$get['id'])));
            $database->modifyGold($session->uid,1,0);
            if($get['id'] > 18) {
                header("Location: dorf2.php");
            } else {
                header("Location: dorf1.php");
            }
        }
        if(isset($get['a']) && $get['c'] == $session->checker && isset($get['id'])) {
            if  ($get['id'] > 18 && ($get['id'] < 41 || $get['id'] == 99)){
            	$session->changeChecker();
            	$this->canProcess($get['a'],$get['id']);
            	$this->constructBuilding($get['id'],$get['a']);
            }
        }
        if(isset($get['buildingFinish']) && $session->plus) {
            if($session->gold >= 2 && $session->sit == 0) {
                $this->finishAll();
            }
        }
    }

	public function canBuild($id,$tid) {
		global $village,$session,$database;
		$demolition = $database->getDemolition($village->wid);
		if($demolition[0]['buildnumber']==$id) { return 11; }
		if($this->isMax($tid,$id)) {
			return 1;
		} else if($this->isMax($tid,$id,1) && ($this->isLoop($id) || $this->isCurrent($id))) {
			return 10;
		} else if($this->isMax($tid,$id,2) && $this->isLoop($id) && $this->isCurrent($id)) {
			return 10;
		} else if($this->isMax($tid,$id,3) && $this->isLoop($id) && $this->isCurrent($id) && count($database->getMasterJobs($village->wid)) > 0) {
			return 10;
		}
		else {
			if($this->allocated <= $this->maxConcurrent) {
				$resRequired = $this->resourceRequired($id,$village->resarray['f'.$id.'t']);
				$resRequiredPop = $resRequired['pop'];
				if ($resRequiredPop == "") {
					$buildarray = $GLOBALS["bid".$tid];
					$resRequiredPop = $buildarray[1]['pop'];
				}
				$jobs = $database->getJobs($village->wid);
				if ($jobs > 0) {
					$soonPop = 0;
					foreach ($jobs as $j) {
						$buildarray = $GLOBALS["bid".$j['type']];
						$soonPop += $buildarray[$database->getFieldLevel($village->wid,$j['field'])+1]['pop'];
					}
				}
				if(($village->allcrop - $village->pop - $soonPop - $resRequiredPop) <= 1 && $village->resarray['f'.$id.'t'] <> 4) {
					return 4;
				}
				else {
					switch($this->checkResource($tid,$id)) {
						case 1:
						return 5;
						break;
						case 2:
						return 6;
						break;
						case 3:
						return 7;
						break;
						case 4:
						if($id >= 19) {
							if($session->tribe == 1 || ALLOW_ALL_TRIBE) {
								if($this->inner == 0) {
									return 8;
								}
								else {
									if($session->plus or $tid==40) {
										if($this->plus == 0) {
											return 9;
										}
										else {
											return 3;
										}
									}
									else {
										return 2;
									}
								}
							}
							else {
								if($this->basic == 0) {
									return 8;
								}
								else {
									if($session->plus or $tid==40) {
										if($this->plus == 0) {
											return 9;
										}
										else {
											return 3;
										}
									}
									else {
										return 2;
									}
								}
							}
						}
						else {
							if($this->basic == 1) {
								if(($session->plus or $tid==40) && $this->plus == 0) {
									return 9;
								}
								else {
									return 3;
								}
							}
							else {
								return 8;
							}
						}
						break;
					}
				}
			}
			else {
				return 2;
			}
		}
	}

	public function walling() {
		global $session;
		$wall = array(31,32,33);
		foreach($this->buildArray as $job) {
			if(in_array($job['type'],$wall)) {
				return "3".$session->tribe;
			}
		}
		return false;
	}

	public function rallying() {
		foreach($this->buildArray as $job) {
			if($job['type'] == 16) {
				return true;
			}
		}
		return false;
	}

	public function procResType($ref) {
		global $session;
		switch($ref) {
			case 1: $build = "Woodcutter"; break;
			case 2: $build = "Clay Pit"; break;
			case 3: $build = "Iron Mine"; break;
			case 4: $build = "Cropland"; break;
			case 5: $build = "Sawmill"; break;
			case 6: $build = "Brickyard"; break;
			case 7: $build = "Iron Foundry"; break;
			case 8: $build = "Grain Mill"; break;
			case 9: $build = "Bakery"; break;
			case 10: $build = "Warehouse"; break;
			case 11: $build = "Granary"; break;
			case 12: $build = "Blacksmith"; break;
			case 13: $build = "Armoury"; break;
			case 14: $build = "Tournament Square"; break;
			case 15: $build = "Main Building"; break;
			case 16: $build = "Rally Point"; break;
			case 17: $build = "Marketplace"; break;
			case 18: $build = "Embassy"; break;
			case 19: $build = "Barracks"; break;
			case 20: $build = "Stable"; break;
			case 21: $build = "Workshop"; break;
			case 22: $build = "Academy"; break;
			case 23: $build = "Cranny"; break;
			case 24: $build = "Town Hall"; break;
			case 25: $build = "Residence"; break;
			case 26: $build = "Palace"; break;
			case 27: $build = "Treasury"; break;
			case 28: $build = "Trade Office"; break;
			case 29: $build = "Great Barracks"; break;
			case 30: $build = "Great Stable"; break;
			case 31: $build = "City Wall"; break;
			case 32: $build = "Earth Wall"; break;
			case 33: $build = "Palisade"; break;
			case 34: $build = "Stonemason's Lodge"; break;
			case 35: $build = "Brewery"; break;
			case 36: $build = "Trapper"; break;
			case 37: $build = "Hero's Mansion"; break;
			case 38: $build = "Great Warehouse"; break;
			case 39: $build = "Great Granary"; break;
			case 40: $build = "Wonder of the World"; break;
			case 41: $build = "Horse Drinking Trough"; break;
			case 42: $build = "Great Workshop"; break;
			default: $build = "Error"; break;
		}
		return $build;
	}

	private function loadBuilding() {
		global $database,$village,$session;
		$this->buildArray = $database->getJobs($village->wid);
		$this->allocated = count($this->buildArray);
		if($this->allocated > 0) {
			foreach($this->buildArray as $build) {
				if($build['loopcon'] == 1) {
					$this->plus = 1;
				}
				else {
					if($build['field'] <= 18) {
						$this->basic += 1;
					}
					else {
						if($session->tribe == 1 || ALLOW_ALL_TRIBE) {
							$this->inner += 1;
						}
						else {
							$this->basic += 1;
						}
					}
				}
			}
			$this->NewBuilding = true;
		}
	}

	private function removeBuilding($d) {
		global $database,$village;
		foreach($this->buildArray as $jobs) {
			if($jobs['id'] == $d) {
				$uprequire = $this->resourceRequired($jobs['field'],$jobs['type']);
				if($database->removeBuilding($d)) {
				if($jobs['master'] == 0){
					$database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],1);
					}
					if($jobs['field'] >= 19) {
						header("Location: dorf2.php");
					}
					else {
						header("Location: dorf1.php");
					}
				}
			}
		}
	}

	private function upgradeBuilding($id) {
		global $database,$village,$session,$logging;
		if($this->allocated < $this->maxConcurrent) {
			$uprequire = $this->resourceRequired($id,$village->resarray['f'.$id.'t']);
			$time = time() + $uprequire['time'];
			$bindicate = $this->canBuild($id,$village->resarray['f'.$id.'t']);
			$loop = ($bindicate == 9 ? 1 : 0);
			$loopsame = 0;
			if($loop == 1) {
				foreach($this->buildArray as $build) {
					if($build['field']==$id) {
						$loopsame += 1;
						$uprequire = $this->resourceRequired($id,$village->resarray['f'.$id.'t'],($loopsame>0?2:1));
					}
				}
				if($session->tribe == 1 || ALLOW_ALL_TRIBE) {
					if($id >= 19) {
						foreach($this->buildArray as $build) {
							if($build['field'] >= 19) {
								$time = $build['timestamp'] + $uprequire['time'];
							}
						}
					}
					else {
						foreach($this->buildArray as $build) {
							if($build['field'] <= 18) {
								$time = $build['timestamp'] + $uprequire['time'];
							}
						}
					}
				}
				else {
					$time = $this->buildArray[0]['timestamp'] + $uprequire['time'];
				}
			}
			$level = $database->getResourceLevel($village->wid);
			if($session->access!=BANNED){
			if($database->addBuilding($village->wid,$id,$village->resarray['f'.$id.'t'],$loop,$time+($loop==1?ceil(60/SPEED):0),0,$level['f'.$id] + 1 + count($database->getBuildingByField($village->wid,$id)))) {
				$database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],0);
				$logging->addBuildLog($village->wid,$this->procResType($village->resarray['f'.$id.'t']),($village->resarray['f'.$id]+($loopsame>0?2:1)),0);
				if($id >= 19) {
					header("Location: dorf2.php");
				}
				else {
					header("Location: dorf1.php");
				}
			}
			}else{
			header("Location: banned.php");
			}
		}
	}

		private function downgradeBuilding($id) {
		global $database,$village,$session,$logging;
		if($this->allocated < $this->maxConcurrent) {
			$name = "bid".$village->resarray['f'.$id.'t'];
			global $$name;
			$dataarray = $$name;
			$time = time() + round($dataarray[$village->resarray['f'.$id]-1]['time'] / 4);
			$loop = 0;
			if($this->inner == 1 || $this->basic == 1) {
				if(($session->plus or $village->resarray['f'.$id.'t']==40)&& $this->plus == 0) {
					$loop = 1;
				}
			}
			if($loop == 1) {
				if($session->tribe == 1 || ALLOW_ALL_TRIBE) {
					if($id >= 19) {
						foreach($this->buildArray as $build) {
							if($build['field'] >= 19) {
								$time = $build['timestamp'] + round($dataarray[$village->resarray['f'.$id]-1]['time'] / 4);
							}
						}
					}
				}
				else {
					$time = $this->buildArray[0]['timestamp'] + round($dataarray[$village->resarray['f'.$id]-1]['time'] / 4);
				}
			}
			if($session->access!=BANNED){
			$level = $database->getResourceLevel($village->wid);
			if($database->addBuilding($village->wid,$id,$village->resarray['f'.$id.'t'],$loop,$time,0,0,$level['f'.$id] + 1 + count($database->getBuildingByField($village->wid,$id)))) {
				$logging->addBuildLog($village->wid,$this->procResType($village->resarray['f'.$id.'t']),($village->resarray['f'.$id]-1),2);
				header("Location: dorf2.php");
			}
			}else{
			header("Location: banned.php");
			}
		}
	}



	private function constructBuilding($id,$tid) {
		global $database,$village,$session,$logging;
		if($this->allocated < $this->maxConcurrent) {
			if($tid == 16) {
				$id = 39;
			}
			else if($tid == 31 || $tid == 32 || $tid == 33) {
				$id = 40;
			}
			$uprequire = $this->resourceRequired($id,$tid);
			$time = time() + $uprequire['time'];
			$bindicate = $this->canBuild($id,$village->resarray['f'.$id.'t']);
			$loop = ($bindicate == 9 ? 1 : 0);
			if($loop == 1) {
				foreach($this->buildArray as $build) {
					if($build['field'] >= 19 || ($session->tribe <> 1 && !ALLOW_ALL_TRIBE)) {
						$time = $build['timestamp'] + ceil(60/SPEED) + $uprequire['time'];
					}
				}
			}
			if($this->meetRequirement($tid)) {
			if($session->access!=BANNED){
			$level = $database->getResourceLevel($village->wid);
				if($database->addBuilding($village->wid,$id,$tid,$loop,$time,0,$level['f'.$id] + 1 + count($database->getBuildingByField($village->wid,$id)))) {
					$logging->addBuildLog($village->wid,$this->procResType($tid),($village->resarray['f'.$id]+1),1);
					$database->modifyResource($village->wid,$uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop'],0);
					header("Location: dorf2.php");
				}
			}else{
			header("Location: banned.php");
			}
			}
		}
	}

	private function meetRequirement($id) {
		global $village,$session,$database;
		switch($id) {
			case 1:
			case 2:
			case 3:
			case 4:
			case 11:
			case 15:
			case 16:
			case 18:
			case 23:
			case 31:
			case 32:
			case 33:
			return true;
			break;
			case 10:
			case 20:
			return ($this->getTypeLevel(15) >= 1)? true : false;
			break;
			case 5:
			if($this->getTypeLevel(1) >= 10 && $this->getTypeLevel(15) >= 5) { return true; } else { return false; }
			break;
			case 6:
			if($this->getTypeLevel(2) >= 10 && $this->getTypeLevel(15) >= 5) { return true; } else { return false; }
			break;
			case 7:
			if($this->getTypeLevel(3) >= 10 && $this->getTypeLevel(15) >= 5) { return true; } else { return false; }
			break;
			case 8:
			if($this->getTypeLevel(4) >= 5) { return true; } else { return false; }
			break;
			case 9:
			if($this->getTypeLevel(15) >= 5 && $this->getTypeLevel(4) >= 10 && $this->getTypeLevel(8) >= 5) { return true; } else { return false; }
			break;
			case 12:
			if($this->getTypeLevel(22) >= 3 && $this->getTypeLevel(15) >= 3) { return true; } else { return false; }
			break;
			case 13:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(22) >= 1) { return true; } else { return false; }
			break;
			case 14:
			if($this->getTypeLevel(16) >= 15) { return true; } else { return false; }
			break;
			case 17:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(10) >= 1 && $this->getTypeLevel(11) >= 1) { return true; } else { return false; }
			break;
			case 19:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1) { return true; } else { return false; }
			break;
			case 20:
			if($this->getTypeLevel(12) >= 3 && $this->getTypeLevel(22) >= 5) { return true; } else { return false; }
			break;
			case 21:
			if($this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15) >= 5) { return true; } else { return false; }
			break;
			case 22:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1) { return true; } else { return false; }
			break;
			case 24:
			if($this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15) >= 10) { return true; } else { return false; }
			break;
			case 25:
			if($this->getTypeLevel(15) >= 5 && $this->getTypeLevel(26) == 0) { return true; } else { return false; }
			break;
			case 26:
			if($this->getTypeLevel(18) >= 1 && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(25) == 0) { return true; } else { return false; }
			break;
			case 27:
			if($this->getTypeLevel(15) >= 10) { return true; } else { return false; }
			break;
			case 28:
			if($this->getTypeLevel(17) == 20 && $this->getTypeLevel(20) >= 10) { return true; } else { return false; }
			break;
			case 29:
			if($this->getTypeLevel(19) == 20 && $village->capital == 0) { return true; } else { return false; }
			break;
			case 30:
			if($this->getTypeLevel(20) == 20 && $village->capital == 0) { return true; } else { return false; }
			break;
			case 34:
			if($this->getTypeLevel(26) >= 3 && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(25) == 0) { return true; } else { return false; }
			break;
			case 35:
			if($this->getTypeLevel(16) >= 10 && $this->getTypeLevel(11) == 20) { return true; } else { return false; }
			break;
			case 36:
			if($this->getTypeLevel(16) >= 1) { return true; } else { return false; }
			break;
			case 37:
			if($this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1) { return true; } else { return false; }
			break;
			case 38:
            		if($this->getTypeLevel(15) >= 10) { return true; } else { return false; }
            		break;
            		case 39:
            		if($this->getTypeLevel(15) >= 10) { return true; } else { return false; }
            		break; 
			case 40:
			$wwlevel = $village->resarray['f99'];
			if($wwlevel > 50){
			$needed_plan = 1;
			}else{
			$needed_plan = 0;
			}
			$wwbuildingplan = 0;
			$villages = $database->getVillagesID($session->uid);
			foreach($villages as $village1){
			$plan = count($database->getOwnArtefactInfoByType2($village1,11));
			if($plan > 0){
			$wwbuildingplan = 1;
			}
			}
			if($session->alliance != 0){
			$alli_users = $database->getUserByAlliance($session->alliance);
			foreach($alli_users as $users){
			$villages = $database->getVillagesID($users['id']);
			if($users['id'] != $session->uid){
			foreach($villages as $village1){
			$plan = count($database->getOwnArtefactInfoByType2($village1,11));
			if($plan > 0){
			$wwbuildingplan += 1;
			}
			}
			}
			}
			}
			if($village->natar == 1 && $wwbuildingplan > $needed_plan) { return true; } else { return false; }
			break;
			case 41:
			if($this->getTypeLevel(16) >= 10 && $this->getTypeLevel(20) == 20) { return true; } else { return false; }
			break;
			case 42:
			if($this->getTypeLevel(21) == 20 && $village->capital == 0) { return true; } else { return false; }
			break;
		}
	}

	private function checkResource($tid,$id) {
		$name = "bid".$tid;
		global $village,$$name,$database;
		$plus = 1;
		foreach($this->buildArray as $job) {
			if($job['type'] == $tid && $job['field'] == $id) {
				$plus = 2;
			}
		}
		$dataarray = $$name;
		$wood = $dataarray[$village->resarray['f'.$id]+$plus]['wood'];
		$clay = $dataarray[$village->resarray['f'.$id]+$plus]['clay'];
		$iron = $dataarray[$village->resarray['f'.$id]+$plus]['iron'];
		$crop = $dataarray[$village->resarray['f'.$id]+$plus]['crop'];
		if($wood > $village->maxstore || $clay > $village->maxstore || $iron > $village->maxstore) {
			return 1;
		}
		else {
			if($crop > $village->maxcrop) {
				return 2;
			}
			else {
				if($wood > $village->awood || $clay > $village->aclay || $iron > $village->airon || $crop > $village->acrop) {
					return 3;
				}
				else {
					if($village->awood>=$wood && $village->aclay>=$clay && $village->airon>=$iron && $village->acrop>=$crop){
						return 4;
					}
					else {
						return 3;
					}
				}
			}
		}
	}

	public function isMax($id,$field,$loop=0) {
		$name = "bid".$id;
		global $$name,$village;
		$dataarray = $$name;
		if($id <= 4) {
			if($village->capital == 1) {
				return ($village->resarray['f'.$field] == (count($dataarray) - 1 - $loop));
			}
			else {
				return ($village->resarray['f'.$field] == (count($dataarray) - 11 - $loop));
			}
		}
		else {
			return ($village->resarray['f'.$field] == count($dataarray) - $loop);
		}
	}

	public function getTypeLevel($tid,$vid=0) {
		global $village,$database;
		$keyholder = array();
		if($vid == 0) {
			$resourcearray = $village->resarray;
		} else {
			$resourcearray = $database->getResourceLevel($vid);
		}
		foreach(array_keys($resourcearray,$tid) as $key) {
			if(strpos($key,'t')) {
				$key = preg_replace("/[^0-9]/", '', $key);
				array_push($keyholder, $key);
			}
		}
		$element = count($keyholder);
		if($element >= 2) {
			if($tid <= 4) {
				$temparray = array();
				for($i=0;$i<=$element-1;$i++) {
					array_push($temparray,$resourcearray['f'.$keyholder[$i]]);
				}
				foreach ($temparray as $key => $val) {
					if ($val == max($temparray))
					$target = $key;
				}
			}
			else {
				$target = 0;
				for($i=1;$i<=$element-1;$i++) {
					if($resourcearray['f'.$keyholder[$i]] > $resourcearray['f'.$keyholder[$target]]) {
						$target = $i;
					}
				}
			}
		}
		else if($element == 1) {
			$target = 0;
		}
		else {
			return 0;
		}
		if($keyholder[$target] != "") {
			return $resourcearray['f'.$keyholder[$target]];
		}
		else {
			return 0;
		}
	}


	public function isCurrent($id) {
		foreach($this->buildArray as $build) {
			if($build['field'] == $id && $build['loopcon'] <> 1) {
				return true;
			}
		}
	}

	public function isLoop($id=0) {
		foreach($this->buildArray as $build) {
			if(($build['field'] == $id && $build['loopcon']) || ($build['loopcon'] == 1 && $id == 0)) {
				return true;
			}
		}
		return false;
	}

    public function finishAll() {
        global $database,$session,$logging,$village,$bid18,$bid10,$bid11,$technology,$_SESSION;
        if($session->access!=BANNED){
        $finish = 0;
        
        foreach($this->buildArray as $jobs) {
        if($jobs['wid']==$village->wid){
            $finish=2;
        $wwvillage = $database->getResourceLevel($jobs['wid']);
        if($wwvillage['f99t']!=40){
            $level = $jobs['level'];
            if($jobs['type'] != 25 AND $jobs['type'] != 26 AND $jobs['type'] != 40) {
            $finish = 1;
                $resource = $this->resourceRequired($jobs['field'],$jobs['type']);
                if($jobs['master'] == 0){
                $q = "UPDATE ".TB_PREFIX."fdata set f".$jobs['field']." = ".$jobs['level'].", f".$jobs['field']."t = ".$jobs['type']." where vref = ".$jobs['wid'];
                }else{
                $villwood = $database->getVillageField($jobs['wid'],'wood');
                $villclay = $database->getVillageField($jobs['wid'],'clay');
                $villiron = $database->getVillageField($jobs['wid'],'iron');
                $villcrop = $database->getVillageField($jobs['wid'],'crop');
                $type = $jobs['type'];
                $buildarray = $GLOBALS["bid".$type];
                $buildwood = $buildarray[$level]['wood'];
                $buildclay = $buildarray[$level]['clay'];
                $buildiron = $buildarray[$level]['iron'];
                $buildcrop = $buildarray[$level]['crop'];
                if($buildwood < $villwood && $buildclay < $villclay && $buildiron < $villiron && $buildcrop < $villcrop){
                $newgold = $session->gold-1;
                $database->updateUserField($session->uid, "gold", $newgold, 1);
                $enought_res = 1;
                $q = "UPDATE ".TB_PREFIX."fdata set f".$jobs['field']." = ".$jobs['level'].", f".$jobs['field']."t = ".$jobs['type']." where vref = ".$jobs['wid'];
                }
                }
                if($database->query($q) && ($enought_res == 1 or $jobs['master'] == 0)) {
                    $database->modifyPop($jobs['wid'],$resource['pop'],0);
                    $database->addCP($jobs['wid'],$resource['cp']);
                    $q = "DELETE FROM ".TB_PREFIX."bdata where id = ".$jobs['id'];
                    $database->query($q);
                    if($jobs['type'] == 18) {
                        $owner = $database->getVillageField($jobs['wid'],"owner");
                        $max = $bid18[$level]['attri'];
                        $q = "UPDATE ".TB_PREFIX."alidata set max = $max where leader = $owner";
                        $database->query($q);
                    }
                }
                if(($jobs['field'] >= 19 && ($session->tribe == 1 || ALLOW_ALL_TRIBE)) || (!ALLOW_ALL_TRIBE && $session->tribe != 1)) { $innertimestamp = $jobs['timestamp']; }
            }
        }
        }
        }
        if($finish != 2){
            $demolition=$database->finishDemolition($village->wid);
            $tech=$technology->finishTech();
            if ($finish==1 || $demolition>0 || $tech>0) {
                $logging->goldFinLog($village->wid);
                $database->modifyGold($session->uid,2,0);
            }
                        $stillbuildingarray = $database->getJobs($village->wid);  
        if(count($stillbuildingarray) == 1) {
            if($stillbuildingarray[0]['loopcon'] == 1) {
                //$q = "UPDATE ".TB_PREFIX."bdata SET loopcon=0,timestamp=".(time()+$stillbuildingarray[0]['timestamp']-$innertimestamp)." WHERE id=".$stillbuildingarray[0]['id'];
                $q = "UPDATE ".TB_PREFIX."bdata SET loopcon=0 WHERE id=".$stillbuildingarray[0]['id'];
                $database->query($q);
            }
        }
        }
        header("Location: ".$session->referrer);
        }else{
        header("Location: banned.php");
        }
    }  

	public function resourceRequired($id,$tid,$plus=1) {
		$name = "bid".$tid;
		global $$name,$village,$bid15;
		$dataarray = $$name;
		$wood = $dataarray[$village->resarray['f'.$id]+$plus]['wood'];
		$clay = $dataarray[$village->resarray['f'.$id]+$plus]['clay'];
		$iron = $dataarray[$village->resarray['f'.$id]+$plus]['iron'];
		$crop = $dataarray[$village->resarray['f'.$id]+$plus]['crop'];
		$pop = $dataarray[$village->resarray['f'.$id]+$plus]['pop'];
		if ($tid == 15) {
			if($this->getTypeLevel(15) == 0) {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time']/ SPEED *5);
			}
			else {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time'] / SPEED);
			}
		}
		else {
			if($this->getTypeLevel(15) != 0) {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time'] * ($bid15[$this->getTypeLevel(15)]['attri']/100)  / SPEED);
			}
			else {
				$time = round($dataarray[$village->resarray['f'.$id]+$plus]['time']*5 / SPEED);
			}
		}
		$cp = $dataarray[$village->resarray['f'.$id]+$plus]['cp'];
		return array("wood"=>$wood,"clay"=>$clay,"iron"=>$iron,"crop"=>$crop,"pop"=>$pop,"time"=>$time,"cp"=>$cp);
	}

	public function getTypeField($type) {
		global $village;
		for($i=19;$i<=40;$i++) {
			if($village->resarray['f'.$i.'t'] == $type) {
				return $i;
			}
		}
	}

	public function calculateAvaliable($id,$tid,$plus=1) {
		global $village,$generator;
		$uprequire = $this->resourceRequired($id,$tid,$plus);
		$rwood = $uprequire['wood']-$village->awood;
		$rclay = $uprequire['clay']-$village->aclay;
		$rcrop = $uprequire['crop']-$village->acrop;
		$riron = $uprequire['iron']-$village->airon;
		$rwtime = $rwood / $village->getProd("wood") * 3600;
		$rcltime = $rclay / $village->getProd("clay")* 3600;
		$rctime = $rcrop / $village->getProd("crop")* 3600;
		$ritime = $riron / $village->getProd("iron")* 3600;
		$reqtime = max($rwtime,$rctime,$rcltime,$ritime);
		$reqtime += time();
		return $generator->procMtime($reqtime);
	}
};

?>
