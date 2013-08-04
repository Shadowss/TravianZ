<?php
		if($session->access!=BANNED){
		$finish = 0;
		foreach($building->buildArray as $jobs) {
		if($jobs['wid']==$village->wid){
		$wwvillage = $database->getResourceLevel($jobs['wid']);
		if($wwvillage['f99t']!=40){
			$level = $jobs['level'];
			if($jobs['type'] != 25 AND $jobs['type'] != 26 AND $jobs['type'] != 40) {
			$finish = 1;
				$resource = $building->resourceRequired($jobs['field'],$jobs['type']);
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
		if($finish == 1){
		$database->finishDemolition($village->wid);
		$technology->finishTech();
		$logging->goldFinLog($village->wid);
		$database->modifyGold($session->uid,2,0);
		$stillbuildingarray = $database->getJobs($village->wid);
		if(count($stillbuildingarray) == 1) {
			if($stillbuildingarray[0]['loopcon'] == 1) {
				$q = "UPDATE ".TB_PREFIX."bdata SET loopcon=0,timestamp=".(time()+$stillbuildingarray[0]['timestamp']-$innertimestamp)." WHERE id=".$stillbuildingarray[0]['id'];
				$database->query($q);
			}
		}
		}
		header("Location: plus.php?id=3");
		}else{
		header("Location: banned.php");
		}
 ?>