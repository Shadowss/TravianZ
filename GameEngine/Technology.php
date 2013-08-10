<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Technology.php                                              ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Technology {

	public $unarray = array(1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U99,U0);

	public function grabAcademyRes() {
		global $village;
		$holder = array();
		foreach($village->researching as $research) {
			if(substr($research['tech'],0,1) == "t"){
				array_push($holder,$research);
			}
		}
		return $holder;
	}

	public function getABUpgrades($type='a') {
		global $village;
		$holder = array();
		foreach($village->researching as $research) {
			if(substr($research['tech'],0,1) == $type){
				array_push($holder,$research);
			}
		}
		return $holder;
	}

	public function isResearch($tech,$type) {
		global $village;
		if(count($village->researching) == 0) {
			return false;
		}
		else {
		switch($type) {
			case 1: $string = "t"; break;
			case 2: $string = "a"; break;
			case 3: $string = "b"; break;
		}
		foreach($village->researching as $research) {
			if($research['tech'] == $string.$tech) {
				return true;
			}
		}
		return false;
		}
	}

	public function procTech($post) {
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "t1":
				$this->procTrain($post);
				break;
				case "t3":
				$this->procTrain($post,true);
				break;
			}
		}
	}

	public function procTechno($get) {
		global $village;
		if(isset($get['a'])) {
			switch($village->resarray['f'.$get['id'].'t']) {
				case 22:
				$this->researchTech($get);
				break;
				case 13:
				$this->upgradeArmour($get);
				break;
				case 12:
				$this->upgradeSword($get);
				break;
			}
		}
	}

	public function getTrainingList($type) {
		global $database,$village;
		$trainingarray = $database->getTraining($village->wid);
		$listarray = array();
		$barracks = array(1,2,3,11,12,13,14,21,22,31,32,33,34,35,36,37,38,39,40,41,42,43,44);
		$greatbarracks = array(61,62,63,71,72,73,74,81,82,91,92,93,94,95,96,97,98,99,100,101,102,103,104);
		$stables = array(4,5,6,15,16,23,24,25,26,45,46);
		$greatstables = array(64,65,66,75,76,83,84,85,86,105,106);
		$workshop = array(7,8,17,18,27,28,47,48);
		$greatworkshop = array(67,68,77,78,87,88,107,108);
		$residence = array(9,10,19,20,29,30,49,50);
		$trapper = array(99);
		if(count($trainingarray) > 0) {
			foreach($trainingarray as $train) {
				if($type == 1 && in_array($train['unit'],$barracks)) {
				$train['name'] = $this->unarray[$train['unit']];
				array_push($listarray,$train);
				}
				if($type == 2 && in_array($train['unit'],$stables)) {
					$train['name'] = $this->unarray[$train['unit']];
					array_push($listarray,$train);
				}
				if($type == 3 && in_array($train['unit'],$workshop)) {
					$train['name'] = $this->unarray[$train['unit']];
					array_push($listarray,$train);
				}
				if($type == 4 && in_array($train['unit'],$residence)) {
					$train['name'] = $this->unarray[$train['unit']];
					array_push($listarray,$train);
				}
				if($type == 5 && in_array($train['unit'],$greatbarracks)) {
					$train['name'] = $this->unarray[$train['unit']-60];
					$train['unit'] -= 60;
					array_push($listarray,$train);
				}
				if($type == 6 && in_array($train['unit'],$greatstables)) {
					$train['name'] = $this->unarray[$train['unit']-60];
					$train['unit'] -= 60;
					array_push($listarray,$train);
				}
				if($type == 7 && in_array($train['unit'],$greatworkshop)) {
					$train['name'] = $this->unarray[$train['unit']-60];
					$train['unit'] -= 60;
					array_push($listarray,$train);
				}
				if($type == 8 && in_array($train['unit'],$trapper)) {
					$train['name'] = $this->unarray[$train['unit']];
					array_push($listarray,$train);
				}
			}
		}
		return $listarray;
	}

	public function getUnitList() {
		global $database,$village;
		$unitarray = func_num_args() == 1? $database->getUnit(func_get_arg(0)) : $village->unitall;
		$listArray = array();
		for($i=1;$i<count($this->unarray);$i++) {
			$holder = array();
			if($unitarray['u'.$i] != 0 && $unitarray['u'.$i] != "") {
				$holder['id'] = $i;
				$holder['name'] = $this->unarray[$i];
				$holder['amt'] = $unitarray['u'.$i];
				array_push($listArray,$holder);
			}
		}if($unitarray['hero'] != 0 && $unitarray['hero'] != "") {
				$holder['id'] = "hero";
				$holder['name'] = $this->unarray[$i];
				$holder['amt'] = $unitarray['hero'];
				array_push($listArray,$holder);
			}
		return $listArray;
	}

	public function maxUnit($unit,$great=false) {
		$unit = "u".$unit;
		global $village,$$unit;
		$unitarray = $$unit;
		$res = array();
		$res = mysql_fetch_assoc(mysql_query("SELECT maxstore, maxcrop, wood, clay, iron, crop FROM ".TB_PREFIX."vdata WHERE wref = ".$village->wid)) or die(mysql_error());
		if ($res['wood'] > $res['maxstore']){$res['wood'] = $res['maxstore'];}
		if ($res['clay'] > $res['maxstore']){$res['clay'] = $res['maxstore'];}
		if ($res['iron'] > $res['maxstore']){$res['iron'] = $res['maxstore'];}
		if ($res['crop'] > $res['maxcrop']){$res['crop'] = $res['maxcrop'];}
		$woodcalc = floor($res['wood'] / ($unitarray['wood'] * ($great?3:1)));
		$claycalc = floor($res['clay'] / ($unitarray['clay'] * ($great?3:1)));
		$ironcalc = floor($res['iron'] / ($unitarray['iron'] * ($great?3:1)));
		if($res['crop']>0){
		$cropcalc = floor($res['crop'] / ($unitarray['crop'] * ($great?3:1)));
		}else{
		$cropcalc = 0;
		}
		if($unit != "u99"){
		$popcalc = floor($village->getProd("crop")/$unitarray['pop']);
		}else{
		$popcalc = $village->getProd("crop");
		}
		return min($woodcalc,$claycalc,$ironcalc,$cropcalc);
	}

	public function maxUnitPlus($unit,$great=false) {
		$unit = "u".$unit;
		global $village,$$unit;
		$unitarray = $$unit;
		$res = array();
		$res = mysql_fetch_assoc(mysql_query("SELECT maxstore, maxcrop, wood, clay, iron, crop FROM ".TB_PREFIX."vdata WHERE wref = ".$village->wid)) or die(mysql_error());
		$totalres = $res['wood']+$res['clay']+$res['iron']+$res['crop'];
		$totalresunit = ($unitarray['wood'] * ($great?3:1))+($unitarray['clay'] * ($great?3:1))+($unitarray['iron'] * ($great?3:1))+($unitarray['crop'] * ($great?3:1));
		$max =round($totalres/$totalresunit);
		return $max;
	}

	public function getUnits() {
		global $database,$village;
		if(func_num_args() == 1) {
			$base = func_get_arg(0);
		}
		$ownunit = func_num_args() == 2? func_get_arg(0) : $database->getUnit($base);
		$enforcementarray = func_num_args() == 2? func_get_arg(1) : $database->getEnforceVillage($base,0);
		if(count($enforcementarray) > 0) {
			foreach($enforcementarray as $enforce) {
				for($i=1;$i<=50;$i++) {
					$ownunit['u'.$i] += $enforce['u'.$i];
				}
			}
		}
		return $ownunit;
	}

	function getAllUnits($base,$InVillageOnly=False,$mode=0) {
		global $database;
		$ownunit = $database->getUnit($base);
		$ownunit['u99'] -= $ownunit['u99'];
		$ownunit['u99o'] -= $ownunit['u99o'];
		$enforcementarray = $database->getEnforceVillage($base,0);
		if(count($enforcementarray) > 0) {
			foreach($enforcementarray as $enforce) {
				for($i=1;$i<=50;$i++) {
					$ownunit['u'.$i] += $enforce['u'.$i];
				}
				$ownunit['hero'] += $enforce['hero'];
			}
		}
		if($mode==0){
		$prisoners = $database->getPrisoners($base);
		if(!empty($prisoners)) {
		foreach($prisoners as $prisoner){
			$owner = $database->getVillageField($base,"owner");
			$ownertribe = $database->getUserField($owner,"tribe",0);
			$start = ($ownertribe-1)*10+1;
			$end = ($ownertribe*10);
			for($i=$start;$i<=$end;$i++) {
			$j = $i-$start+1;
			$ownunit['u'.$i] += $prisoner['t'.$j];
			}
			$ownunit['hero'] += $prisoner['t11'];
		}
		}
		}
		if(!$InVillageOnly) {
			$movement = $database->getVillageMovement($base);
			if(!empty($movement)) {
				for($i=1;$i<=50;$i++) {
					$ownunit['u'.$i] += $movement['u'.$i];
				}
				$ownunit['hero'] += $movement['hero'];
			}
		}
		return $ownunit;
	}

	public function meetTRequirement($unit) {
		global $session;
		switch($unit) {
			case 1:
			if($session->tribe == 1) { return true; } else { return false; }
			break;
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:
			if($this->getTech($unit) && $session->tribe == 1) { return true; } else { return false; }
			break;
			case 10:
			if($session->tribe == 1) { return true; } else { return false; }
			break;
			case 11:
			if($session->tribe == 2) { return true; } else { return false; }
			break;
			case 12:
			case 13:
			case 14:
			case 15:
			case 16:
			case 17:
			case 18:
			if($session->tribe == 2 && $this->getTech($unit)) { return true; } else { return false; }
			break;
			case 20:
			if($session->tribe == 2) { return true; } else { return false; }
			break;
			case 21:
			if($session->tribe == 3) { return true; } else { return false; }
			break;
			case 22:
			case 23:
			case 24:
			case 25:
			case 26:
			case 27:
			case 28:
			if($session->tribe == 3 && $this->getTech($unit)) { return true; } else { return false; }
			break;
			case 30:
			if($session->tribe == 3) { return true; } else { return false; }
			break;
			case 31:
			if($session->tribe == 4) { return true; } else { return false; }
			break;
			case 32:
			case 33:
			case 34:
			case 35:
			case 36:
			case 37:
			case 38:
			if($session->tribe == 4 && $this->getTech($unit)) { return true; } else { return false; }
			break;
			case 40:
			if($session->tribe == 4) { return true; } else { return false; }
			break;
			case 41:
			if($session->tribe == 5) { return true; } else { return false; }
			break;
			case 42:
			case 43:
			case 44:
			case 45:
			case 46:
			case 47:
			case 48:
			if($session->tribe == 5 && $this->getTech($unit)) { return true; } else { return false; }
			break;
			case 50:
			if($session->tribe == 5) { return true; } else { return false; }
			break;
		}
	}

	public function getTech($tech) {
		global $village;
		return ($village->techarray['t'.$tech] == 1);
	}

	private function procTrain($post,$great=false) {
		global $session;
		if($session->access != BANNED){
		$start = ($session->tribe-1)*10+1;
		$end = ($session->tribe*10);
		for($i=$start;$i<=($end);$i++) {
			if(isset($post['t'.$i]) && $post['t'.$i] != 0) {
				$amt = $post['t'.$i];
				$amt = intval($amt);
					if ($amt < 0) $amt = 1;
					$this->trainUnit($i,$amt,$great);
			}
		}
		if($session->tribe == 3){
			if(isset($post['t99']) && $post['t99'] != 0) {
				$amt = $post['t99'];
				$amt = intval($amt);
					if ($amt < 0) $amt = 1;
					$this->trainUnit(99,$amt,$great);
			}
		}
		header("Location: build.php?id=".$post['id']);
	}else{
		header("Location: banned.php");
	}
	}

	public function getUpkeep($array,$type,$vid=0,$prisoners=0) {
		global $database,$session,$village;
		if($vid==0) { $vid=$village->wid; }
		$buildarray = array();
		$buildarray = $database->getResourceLevel($vid);
		$upkeep = 0;
		switch($type) {
			case 0:
			$start = 1;
			$end = 50;
			break;
			case 1:
			$start = 1;
			$end = 10;
			break;
			case 2:
			$start = 11;
			$end = 20;
			break;
			case 3:
			$start = 21;
			$end = 30;
			break;
			case 4:
			$start = 31;
			$end = 40;
			break;
			case 5:
			$start = 41;
			$end = 50;
			break;
		}
		for($i=$start;$i<=$end;$i++) {
			$k = $i-$start+1;
			$unit = "u".$i;
			$unit2 = "t".$k;
			global $$unit;
			$dataarray = $$unit;
			for($j=19;$j<=38;$j++) {
			if($buildarray['f'.$j.'t'] == 41) {
			$horsedrinking = $j;
			}
			}
			if($prisoners == 0){
			if(isset($horsedrinking)){
			if(($i==4 && $buildarray['f'.$horsedrinking] >= 10)
			|| ($i==5 && $buildarray['f'.$horsedrinking] >= 15)
			|| ($i==6 && $buildarray['f'.$horsedrinking] == 20)) {
			$upkeep += ($dataarray['pop']-1) * $array[$unit];
			} else {
			$upkeep += $dataarray['pop'] * $array[$unit];
			}}else{
			$upkeep += $dataarray['pop'] * $array[$unit];
			}
			}else{
			if(isset($horsedrinking)){
			if(($i==4 && $buildarray['f'.$horsedrinking] >= 10)
			|| ($i==5 && $buildarray['f'.$horsedrinking] >= 15)
			|| ($i==6 && $buildarray['f'.$horsedrinking] == 20)) {
			$upkeep += ($dataarray['pop']-1) * $array[$unit2];
			} else {
			$upkeep += $dataarray['pop'] * $array[$unit2];
			}}else{
			$upkeep += $dataarray['pop'] * $array[$unit2];
			}
			}
		}
		 //   $unit = "hero";
		 //   global $$unit;
		 //   $dataarray = $$unit;
		 if($prisoners == 0){
			$upkeep += $array['hero'] * 6;
		 }else{
			$upkeep += $array['t11'] * 6;
		 }
			$artefact = count($database->getOwnUniqueArtefactInfo2($session->uid,4,3,0));
			$artefact1 = count($database->getOwnUniqueArtefactInfo2($vid,4,1,1));
			$artefact2 = count($database->getOwnUniqueArtefactInfo2($session->uid,4,2,0));
			if($artefact > 0){
			$upkeep /= 2;
			$upkeep = round($upkeep);
			}else if($artefact1 > 0){
			$upkeep /= 2;
			$upkeep = round($upkeep);
			}else if($artefact2 > 0){
			$upkeep /= 4;
			$upkeep = round($upkeep);
			$upkeep *= 3;
			}
			$foolartefact = $database->getFoolArtefactInfo(4,$vid,$session->uid);
			if(count($foolartefact) > 0){
			foreach($foolartefact as $arte){
			if($arte['bad_effect'] == 1){
			$upkeep *= $arte['effect2'];
			}else{
			$upkeep /= $arte['effect2'];
			$upkeep = round($upkeep);
			}
			}
			}
		return $upkeep;
	}

private function trainUnit($unit,$amt,$great=false) {
		global $session,$database,${'u'.$unit},$building,$village,$bid19,$bid20,$bid21,$bid25,$bid26,$bid29,$bid30,$bid36,$bid41,$bid42;

		if($this->getTech($unit) || $unit%10 <= 1 || $unit == 99) {
			$footies = array(1,2,3,11,12,13,14,21,22,31,32,33,34,41,42,43,44);
			$calvary = array(4,5,6,15,16,23,24,25,26,35,36,45,46);
			$workshop = array(7,8,17,18,27,28,37,38,47,48);
			$special = array(9,10,19,20,29,30,39,40,49,50);
			$trapper = array(99);
			if(in_array($unit,$footies)) {
				if($great) {
					$each = round(($bid29[$building->getTypeLevel(29)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
				} else {
					$each = round(($bid19[$building->getTypeLevel(19)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
				}
			}
			if(in_array($unit,$calvary)) {
				if($great) {
					$each = round(($bid30[$building->getTypeLevel(30)]['attri'] * ($building->getTypeLevel(41)>=1?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / 100) * ${'u'.$unit}['time'] / SPEED);
				} else {
					$each = round(($bid20[$building->getTypeLevel(20)]['attri'] * ($building->getTypeLevel(41)>=1?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / 100) * ${'u'.$unit}['time'] / SPEED);
				}
			}
			if(in_array($unit,$workshop)) {
				if($great) {
					$each = round(($bid42[$building->getTypeLevel(42)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
				} else {
					$each = round(($bid21[$building->getTypeLevel(21)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
				}
			}
			if(in_array($unit,$special)) {
				if($building->getTypeLevel(25) > 0){
					$each = round(($bid25[$building->getTypeLevel(25)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
				} else {
					$each = round(($bid26[$building->getTypeLevel(26)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
				}
			}
			if(in_array($unit,$trapper)) {
					$each = round(($bid19[$building->getTypeLevel(36)]['attri'] / 100) * ${'u'.$unit}['time'] / SPEED);
			}
			if($unit%10 == 0 || $unit%10 == 9 && $unit != 99) {
				$slots = $database->getAvailableExpansionTraining();
				if($unit%10 == 0 && $slots['settlers'] <= $amt) { $amt = $slots['settlers']; }
				if($unit%10 == 9 && $slots['chiefs'] <= $amt) { $amt = $slots['chiefs']; }
			} else {
			if($unit != 99){
				if($this->maxUnit($unit,$great) < $amt) {
					$amt = 0;
				}
			}else{
			$trainlist = $this->getTrainingList(8);
			foreach($trainlist as $train) {
			$train_amt += $train['amt'];
			}
			$max = 0;
			for($i=19;$i<41;$i++){
			if($village->resarray['f'.$i.'t'] == 36){
			$max += $bid36[$village->resarray['f'.$i]]['attri'];
			}
			}
			$max1 = $max - ($village->unitarray['u99'] + $train_amt);
				if($max1 < $amt) {
					$amt = 0;
				}
			}
			}
			$wood = ${'u'.$unit}['wood'] * $amt * ($great?3:1);
			$clay = ${'u'.$unit}['clay'] * $amt * ($great?3:1);
			$iron = ${'u'.$unit}['iron'] * $amt * ($great?3:1);
			$crop = ${'u'.$unit}['crop'] * $amt * ($great?3:1);
			$each = ($each == 0) ? 1 : $each;
			$time = $each*$amt;
			if($database->modifyResource($village->wid,$wood,$clay,$iron,$crop,0) && $amt > 0) {
				$database->trainUnit($village->wid,$unit+($great?60:0),$amt,${'u'.$unit}['pop'],$each,time()+$time,0);
			}
		}
	}

	public function meetRRequirement($tech) {
		global $session,$building;
		switch($tech) {
			case 2:
			if($building->getTypeLevel(22) >= 1 && $building->getTypeLevel(13) >= 1) { return true; } else { return false; }
			break;
			case 3:
			if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 4:
			case 23:
			if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(20) >= 1) { return true; } else { return false; }
			break;
			case 5:
			case 25:
			if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(20) >= 5) { return true; } else { return false; }
			break;
			case 6:
			if($building->getTypeLevel(22) >= 15 && $building->getTypeLevel(20) >= 10) { return true; } else { return false; }
			break;
			case 9:
			case 29:
			if($building->getTypeLevel(22) >= 20 && $building->getTypeLevel(16) >= 10) { return true; } else { return false; }
			break;
			case 12:
			case 32:
			case 42:
			if($building->getTypeLevel(22) >= 1 && $building->getTypeLevel(19) >= 3) { return true; } else { return false; }
			break;
			case 13:
			case 33:
			case 43:
			if($building->getTypeLevel(22) >= 3 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 14:
			case 34:
			case 44:
			if($building->getTypeLevel(22) >= 1 && $building->getTypeLevel(15) >= 5) { return true; } else { return false; }
			break;
			case 15:
			case 35:
			case 45:
			if($building->getTypeLevel(22) >= 1 && $building->getTypeLevel(20) >= 3) { return true; } else { return false; }
			break;
			case 16:
			case 26:
			case 36:
			case 46:
			if($building->getTypeLevel(22) >= 15 && $building->getTypeLevel(20) >= 10) { return true; } else { return false; }
			break;
			case 7:
			case 17:
			case 27:
			case 37:
			case 47:
			if($building->getTypeLevel(22) >= 10 && $building->getTypeLevel(21) >= 1) { return true; } else { return false; }
			break;
			case 8:
			case 18:
			case 28:
			case 38:
			case 48:
			if($building->getTypeLevel(22) >= 15 && $building->getTypeLevel(21) >= 10) { return true; } else { return false; }
			break;
			case 19:
			case 39:
			case 49:
			if($building->getTypeLevel(22) >= 20 && $building->getTypeLevel(16) >= 5) { return true; } else { return false; }
			break;
			case 22:
			if($building->getTypeLevel(22) >= 3 && $building->getTypeLevel(12) >= 1) { return true; } else { return false; }
			break;
			case 24:
			if($building->getTypeLevel(22) >= 5 && $building->getTypeLevel(20) >= 3) { return true; } else { return false; }
			break;
		}
	}

	private function researchTech($get) {
		//global $database,$session,${'r'.$get['a']},$village,$logging;
		global $database,$session,${'r'.$get['a']},$bid22,$building,$village,$logging;
		if($this->meetRRequirement($get['a']) && $get['c'] == $session->mchecker) {
			$data = ${'r'.$get['a']};
			$time = time() + round(($data['time'] * ($bid22[$building->getTypeLevel(22)]['attri'] / 100))/SPEED);
			//$time = time() + round($data['time']/SPEED);
			$database->modifyResource($village->wid,$data['wood'],$data['clay'],$data['iron'],$data['crop'],0);
			$database->addResearch($village->wid,"t".$get['a'],$time);
			$logging->addTechLog($village->wid,"t".$get['a'],1);
		}
		$session->changeChecker();
		header("Location: build.php?id=".$get['id']);
	}

	private function upgradeSword($get) {
		global $database,$session,$bid12,$building,$village,$logging;
		$ABTech = $database->getABTech($village->wid);
		$CurrentTech = $ABTech["b".$get['a']];
		$unit = ($session->tribe-1)*10+intval($get['a']);
		if(($this->getTech($unit) || ($unit % 10) == 1) && ($CurrentTech < $building->getTypeLevel(12)) && $get['c'] == $session->mchecker) {
			global ${'ab'.strval($unit)};
			$data = ${'ab'.strval($unit)};
			$time = time() + round(($data[$CurrentTech+1]['time'] * ($bid12[$building->getTypeLevel(12)]['attri'] / 100))/SPEED);
			if ($database->modifyResource($village->wid,$data[$CurrentTech+1]['wood'],$data[$CurrentTech+1]['clay'],$data[$CurrentTech+1]['iron'],$data[$CurrentTech+1]['crop'],0)) {
				$database->addResearch($village->wid,"b".$get['a'],$time);
				$logging->addTechLog($village->wid,"b".$get['a'],$CurrentTech+1);
			}
		}
		$session->changeChecker();
		header("Location: build.php?id=".$get['id']);
	}

	private function upgradeArmour($get) {
		global $database,$session,$bid13,$building,$village,$logging;
		$ABTech = $database->getABTech($village->wid);
		$CurrentTech = $ABTech["a".$get['a']];
		$unit = ($session->tribe-1)*10+intval($get['a']);
		if(($this->getTech($unit) || ($unit % 10) == 1) && ($CurrentTech < $building->getTypeLevel(13)) && $get['c'] == $session->mchecker) {
			global ${'ab'.strval($unit)};
			$data = ${'ab'.strval($unit)};
			$time = time() + round(($data[$CurrentTech+1]['time'] * ($bid13[$building->getTypeLevel(13)]['attri'] / 100))/SPEED);
			if ($database->modifyResource($village->wid,$data[$CurrentTech+1]['wood'],$data[$CurrentTech+1]['clay'],$data[$CurrentTech+1]['iron'],$data[$CurrentTech+1]['crop'],0)) {
				$database->addResearch($village->wid,"a".$get['a'],$time);
				$logging->addTechLog($village->wid,"a".$get['a'],$CurrentTech+1);
			}
		}
		$session->changeChecker();
		header("Location: build.php?id=".$get['id']);
	}

	public function getUnitName($i) {
		return $this->unarray[$i];
	}

	public function finishTech() {
		global $database,$village;
		$q = "UPDATE ".TB_PREFIX."research SET timestamp=".(time()-1)." WHERE vref = ".$village->wid;
		$database->query($q);
	}

	public function calculateAvaliable($id,$resarray=array()) {
		global $village,$generator,${'r'.$id};
		if(count($resarray)==0) {
			$resarray['wood'] = ${'r'.$id}['wood'];
			$resarray['clay'] = ${'r'.$id}['clay'];
			$resarray['iron'] = ${'r'.$id}['iron'];
			$resarray['crop'] = ${'r'.$id}['crop'];
		}
		$rwtime = ($resarray['wood']-$village->awood) / $village->getProd("wood") * 3600;
		$rcltime = ($resarray['clay']-$village->aclay) / $village->getProd("clay") * 3600;
		$ritime = ($resarray['iron']-$village->airon) / $village->getProd("iron") * 3600;
		$rctime = ($resarray['crop']-$village->acrop) / $village->getProd("crop") * 3600;
		if($village->getProd("crop") >= 0) {
			$reqtime = max($rwtime,$rcltime,$ritime,$rctime) + time();
		} else {
			$reqtime = max($rwtime,$rcltime,$ritime);
			if($reqtime > $rctime) {
				$reqtime = 0;
			} else {
				$reqtime += time();
			}
		}
		return $generator->procMtime($reqtime);
	}

	public function checkReinf($id) {
		global $database;
		$enforce=$database->getEnforceArray($id,0);
		$fail='0';
					for($i=1; $i<50; $i++){
						if($enforce['u'.$i.'']>0){
						$fail='1';
						}
					}
			if($fail==0){
			$database->deleteReinf($id);
			}

	}

}
$technology = new Technology;
?>
