<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationVillageUpkeep.php                                 ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Population recalculation, resources, warehouses, loyalty,   ##
##                 oases                                                       ##
##                                                                             ##
##  Phase S2: Trait extracted from GameEngine/Automation.php                   ##
##            (Automation class).                                              ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

trait AutomationVillageUpkeep {



    public function procResType($ref, $mode = 0) {
        //Capital or only 1 village left = cannot be destroyed
        return addslashes(empty($build = Building::procResType($ref)) && !$mode ? RC_VILLAGE_CANT_BE : $build);
    }

    function recountPop($vid, $use_cache = true){
        global $database;
        
        $vid = (int) $vid;
        $fdata = $database->getResourceLevel($vid, $use_cache);
        $popTot = 0;

        for ($i = 1; $i <= 40; $i++) {
            $lvl = $fdata["f".$i];
            $building = $fdata["f".$i."t"];
			if($building) $popTot += $this->buildingPOP($building, $lvl);
        }
        
        Building::recountCP($database, $vid);
		$q = "UPDATE ".TB_PREFIX."vdata set pop = $popTot where wref = $vid";
		mysqli_query($database->dblink, $q);
		$owner = $database->getVillageField($vid, "owner");

		// Milestone: first player ever to reach 1000 total population,
		// summed across all their villages. recountPop() is the single
		// funnel every population-changing event (building, demolishing,
		// founding/conquering a village) already passes through, so this
		// is the one place that's guaranteed to catch the threshold being
		// crossed regardless of which village/action caused it.
		// Excludes owner 3 (Natars) — see Artifacts::NATARS_UID — same
		// convention already used elsewhere in this file (e.g. the
		// "fix natar report by ronix" check a few hundred lines below).
		if (defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES && $owner > 0 && $owner != 3) {
			$totalPop = (int) $database->getVSumField($owner, 'pop', false);
			if ($totalPop >= 1000) {
				$database->recordMilestoneIfFirst('population_1000', $owner, $vid);
			}
		}
		
		$this->procClimbers($owner);

        return $popTot;
    }

    function buildingPOP($f, $lvl){
        $name = "bid".$f;
        global $$name;
        
        $popT = 0;
        $dataarray = $$name;

        for ($i = 0; $i <= $lvl; $i++) {
            $popT += ((isset($dataarray[$i]) && isset($dataarray[$i]['pop'])) ? $dataarray[$i]['pop'] : 0);
        }
        return $popT;
    }

    private function loyaltyRegeneration() {
    	global $database;
        
        $array = [];
        $array = $database->getProfileVillages(0, 6);
        if(!empty($array)) {
            foreach($array as $loyalty) {
                if (($t25_level = $this->getTypeLevel(25, $loyalty['wref'])) >= 1) {
                    $value = $t25_level;
                }elseif(($t26_level = $this->getTypeLevel(26, $loyalty['wref'])) >= 1){
                    $value = $t26_level;
                }
                else $value = 0;
                
                if($value > 0){
                    $newloyalty = min(100, $loyalty['loyalty'] + $value * (time() - $loyalty['lastupdate2']) / 3600);
                    $q = "UPDATE ".TB_PREFIX."vdata SET loyalty = $newloyalty, lastupdate2=".time()." WHERE wref = '".$loyalty['wref']."'";
                    $database->query($q);
                }            
            }
        }
        
        $array = [];
        $q = "SELECT conqured, loyalty, lastupdated, wref FROM ".TB_PREFIX."odata WHERE loyalty < 100";
        $array = $database->query_return($q);
        if(!empty($array)) {
            foreach($array as $loyalty) {
                $value = $this->getTypeLevel(37, $loyalty['conqured']);   
                
                if($value > 0){
                    $newloyalty = min(100, $loyalty['loyalty'] + $value * (time() - $loyalty['lastupdated']) / 3600);
                    $q = "UPDATE ".TB_PREFIX."odata SET loyalty = $newloyalty, lastupdated=".time()." WHERE wref = '".$loyalty['wref']."'";
                    $database->query($q);
                }              
            }
        }
    }

    public function getTypeLevel($tid, $vid) {
        global $database;
        
        $keyholder = [];

        $resourcearray = $database->getResourceLevel($vid);
        foreach(array_keys($resourcearray, $tid) as $key) {
            if(strpos($key,'t')) {
                $key = preg_replace("/[^0-9]/", '', $key);
                array_push($keyholder, $key);
            }
        }
        
        $element = count($keyholder);
        if($element >= 2) {
            if($tid <= 4) {
                $temparray = [];
                for($i = 0; $i <= $element - 1; $i++) {
                    array_push($temparray,$resourcearray['f'.$keyholder[$i]]);
                }
                foreach ($temparray as $key => $val) {
                    if ($val == max($temparray)) $target = $key;                        
                }
            }
            else {
                $target = 0;
                for($i = 1; $i <= $element - 1; $i++) {
                    if($resourcearray['f'.$keyholder[$i]] > $resourcearray['f'.$keyholder[$target]]) {
                        $target = $i;
                    }
                }
            }
        }
        else if($element == 1) $target = 0;
        else return 0;

        if(!empty($keyholder[$target])) return $resourcearray['f'.$keyholder[$target]];
        else return 0;
    }
    
    // Clamp resources/storage up to their minimums for the given table (vdata or
    // odata): negative resources back to 0 and maxstore/maxcrop back to
    // STORAGE_BASE. This floor pass is identical for both tables, so both
    // pruneResource() (vdata) and pruneOResource() (odata) share it. The $table
    // argument is an internal constant string, never user input.
    private function pruneResourceMinimums($table) {
        global $database;

        $database->query("UPDATE
                  ".TB_PREFIX.$table."
              SET
                  wood = IF(wood < 0, 0, wood),
                  clay = IF(clay < 0, 0, clay),
                  iron = IF(iron < 0, 0, iron),
                  crop = IF(crop < 0, 0, crop),
                  maxstore = IF(maxstore < ".STORAGE_BASE.", ".STORAGE_BASE.", maxstore),
                  maxcrop = IF(maxcrop < ".STORAGE_BASE.", ".STORAGE_BASE.", maxcrop)
              WHERE
                  maxstore < ".STORAGE_BASE." OR
                  maxcrop < ".STORAGE_BASE." OR
                  wood < 0 OR
                  clay < 0 OR
                  iron < 0 OR
                  crop < 0");
    }

    private function pruneOResource() {
        if(!ALLOW_BURST) {
            $this->pruneResourceMinimums('odata');
        }
    }
    private function pruneResource() {
        global $database;

        if(!ALLOW_BURST) {
            $this->pruneResourceMinimums('vdata');

            $database->query("UPDATE
                      ".TB_PREFIX."vdata
                  SET
                      wood = IF(wood > maxstore, maxstore, wood),
                      clay = IF(clay > maxstore, maxstore, clay),
                      iron = IF(iron > maxstore, maxstore, iron),
                      crop = IF(crop > maxcrop, maxcrop, crop)
                  WHERE
                      wood > maxstore OR
                      clay > maxstore OR
                      iron > maxstore OR
                      crop > maxcrop");
        }
    }

    private function culturePoints() {
        global $database;

        // FIX: punctele de cultura date de coifuri (Gladiator/Tribune/Consul =
        // 100/400/800 pe zi) nu erau adaugate nicaieri - HB_CP exista doar in
        // definitia itemelor si in agregarea din HeroItems::getBonuses().
        // Se aplica INAINTE de updateVSumField, fiindca acela reseteaza
        // users.lastupdate; asa ambele folosesc exact aceeasi fereastra de timp.
        $this->applyHeroCulturePoints();

        $database->updateVSumField('cp');
    }

    /**
     * Adauga in users.cp punctele de cultura ale coifurilor echipate.
     *
     * Acumularea imita formula din updateVSumField(): valoarea e "pe zi", iar
     * ziua de joc e 86400/SPEED (minim o ora), la fel ca pentru cladiri.
     * Valorile sunt luate din catalog prin scaledBonusValue(), care aplica deja
     * regula de server rapid (coifurile de cultura se injumatatesc la SPEED>=3).
     *
     * Se numara doar eroii vii (hero.dead = 0). Cum exista un singur slot de
     * coif, un jucator nu poate avea doua iteme cu CP echipate simultan, deci
     * join-ul nu poate dubla castigul.
     */
    private function applyHeroCulturePoints() {
        global $database, $heroItemCatalog;

        if (!class_exists('HeroBattleBonus') || !HeroBattleBonus::enabled()) {
            return;
        }

        if (empty($heroItemCatalog) || !is_array($heroItemCatalog)) {
            return;
        }

        $heroItems = new HeroItems();
        $cpValues  = array();

        foreach ($heroItemCatalog as $itemid => $def) {
            if (!isset($def['bonus']) || !is_array($def['bonus']) || !isset($def['bonus'][HB_CP])) {
                continue;
            }

            $value = (int) $heroItems->scaledBonusValue($def, (int) $def['bonus'][HB_CP]);

            if ($value > 0) {
                $cpValues[(int) $itemid] = $value;
            }
        }

        if (empty($cpValues)) {
            return;
        }

        $durDay = 86400 / SPEED;

        if ($durDay < 3600) {
            $durDay = 3600;
        }

        $case = '';

        foreach ($cpValues as $itemid => $value) {
            $case .= ' WHEN ' . (int) $itemid . ' THEN ' . (int) $value;
        }

        $ids = implode(',', array_map('intval', array_keys($cpValues)));

        $q = "UPDATE " . TB_PREFIX . "users AS u
              INNER JOIN " . TB_PREFIX . "hero_items AS hi
                      ON hi.uid = u.id AND hi.equipped = 1 AND hi.itemid IN (" . $ids . ")
              INNER JOIN " . TB_PREFIX . "hero AS h
                      ON h.uid = u.id AND h.dead = 0
              SET u.cp = u.cp + ((CASE hi.itemid" . $case . " END) * (UNIX_TIMESTAMP() - u.lastupdate) / " . $durDay . ")
              WHERE u.lastupdate < (UNIX_TIMESTAMP() - 600)";

        mysqli_query($database->dblink, $q);
    }

    /**
     * Recompute a warehouse/granary capacity after a build completion.
     * Returns [$fieldDbName, $max]: the vdata column to update and its new value.
     */
    private function updateStorageCapacity($type, $level, $villageData) {
        global $bid10, $bid11, $bid38, $bid39;

        $fieldDbName = (in_array($type, [10, 38]) ? 'maxstore' : 'maxcrop');
        $max = $villageData[$fieldDbName];

        if($level == 1 && $max == STORAGE_BASE) $max = STORAGE_BASE;

        if ($level != 1) $max -= ${'bid'.$type}[$level - 1]['attri'] * STORAGE_MULTIPLIER;

        $max += ${'bid'.$type}[$level]['attri'] * STORAGE_MULTIPLIER;

        return [$fieldDbName, $max];
    }

    private function getPop($tid, $level) {
        $name = "bid".$tid;
        global $$name;
        
        $dataarray = $$name;
        $pop = $dataarray[($level + 1)]['pop'];
        $cp = $dataarray[($level + 1)]['cp'];
        return [$pop, $cp];
    }

    private function updateORes($bountywid) {
    	global $database;
    	
    	$oasisInfoArray = $database->getOasisV($bountywid);
    	$timepast = time() - $oasisInfoArray['lastupdated'];
    	$nwood = (OASIS_WOOD_PRODUCTION / 3600) * $timepast;
    	$nclay = (OASIS_CLAY_PRODUCTION / 3600) * $timepast;
    	$niron = (OASIS_IRON_PRODUCTION / 3600) * $timepast;
    	$ncrop = (OASIS_CROP_PRODUCTION / 3600) * $timepast;
    	$database->modifyOasisResource($bountywid, $nwood, $nclay, $niron, $ncrop, 1);
    	$database->updateOasis($bountywid);
    }
    
    private function updateRes($bountywid) {
    	global $database, $technology;
    	
    	//Get village infos
    	$villageInfoArray = $database->getVillage($bountywid);
    	
    	//Get building and resource fields array
    	$resArray = $database->getResourceLevel($bountywid, false);
    	
    	//Get oasis array
    	$oasisArray = $database->getOasis($bountywid);
    	
    	//Get an array with the numbers of the oasis
    	$numberOfOasis = $this->bountysortOasis($oasisArray);
    	
    	//Set the village population (if WW Villages, it's halved)
    	$villagePopulation = !$villageInfoArray['natar'] ? $villageInfoArray['pop'] : round($villageInfoArray['pop'] / 2);
    	
    	//Get the upkeep of the village
    	$upkeep = $technology->getUpkeep($this->getAllUnits($bountywid), 0, $bountywid);   	
 
    	//Calculate the produced resources
    	$timepast = time() - $villageInfoArray['lastupdate'];
    	$nwood = ($this->bountyGetResourceProd($resArray, $numberOfOasis, 1) / 3600) * $timepast;
    	$nclay = ($this->bountyGetResourceProd($resArray, $numberOfOasis, 2) / 3600) * $timepast;
    	$niron = ($this->bountyGetResourceProd($resArray, $numberOfOasis, 3) / 3600) * $timepast;
    	$ncrop = (($this->bountyGetResourceProd($resArray, $numberOfOasis, 4) - $villagePopulation - $upkeep) / 3600) * $timepast;
    	$database->modifyResource($bountywid, $nwood, $nclay, $niron, $ncrop, 1);
    	$database->updateVillage($bountywid);
    }

    private function getsort_typeLevel($tid, $resarray) {
        $keyholder = [];

        foreach(array_keys($resarray, $tid) as $key) {
            if(strpos($key, 't')) {
                $key = preg_replace("/[^0-9]/", '', $key);
                array_push($keyholder, $key);
            }
        }

        $element = count($keyholder);
        if($element >= 2) {
            if($tid <= 4) {
                $temparray = [];

                for($i = 0; $i <= $element - 1; $i++) {
                    array_push($temparray, $resarray['f'.$keyholder[$i]]);
                }

                foreach ($temparray as $key => $val) {
                    if ($val == max($temparray)) $target = $key;                   
                }
            }
        }
        else if($element == 1) $target = 0;
        else return 0;

        if(!empty($keyholder[$target])) return $resarray['f'.$keyholder[$target]];
        else return 0;
    }

    private function updateStore() {
        global $database, $bid10, $bid38, $bid11, $bid39;

        // HOTFIX deadlock (log 20-23 iul): rutina scria toata vdata intr-o SINGURA
        // tranzactie lunga, tinand lock-uri pe multe randuri => coliziuni fatale cu
        // scrierile jucatorilor. Doua schimbari: (1) commit in transe de 200 de randuri
        // (ferestre de lock scurte), (2) reincercare de maximum 3 ori la deadlock / lock
        // timeout. Rutina e idempotenta (recalculeaza maxstore/maxcrop de la zero), deci
        // o rulare partiala e inofensiva - urmatorul tick o completeaza.
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            try {
                $result = mysqli_query($database->dblink, 'SELECT * FROM `' . TB_PREFIX . 'fdata`');

                $pending = 0;
                mysqli_begin_transaction($database->dblink);
                while ($row = mysqli_fetch_assoc($result))
                {
                    $ress = $crop = 0;
                    for ($i = 19; $i < 40; ++$i)
                    {
                        //Warehouse
                        if ($row['f' . $i . 't'] == 10)
                        {
                            $ress += ((isset($bid10[$row['f' . $i]]) && isset($bid10[$row['f' . $i]]['attri'])) ? $bid10[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                        }

                        //Great warehouse
                        if ($row['f' . $i . 't'] == 38)
                        {
                            $ress += ((isset($bid38[$row['f' . $i]]) && isset($bid38[$row['f' . $i]]['attri'])) ? $bid38[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                        }
                
                        //Granary
                        if ($row['f' . $i . 't'] == 11)
                        {
                            $crop += ((isset($bid11[$row['f' . $i]]) && isset($bid11[$row['f' . $i]]['attri'])) ? $bid11[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                        }
              
                        //Great granary
                        if ($row['f' . $i . 't'] == 39)
                        {
                            $crop += ((isset($bid39[$row['f' . $i]]) && isset($bid39[$row['f' . $i]]['attri'])) ? $bid39[$row['f' . $i]]['attri'] * STORAGE_MULTIPLIER : 0);
                        }
                    }

                    // no need for update, since we didn't find any warehouses or granaries
                    // and maximums would have been set to correct values inside prune* functions already
                    if ($ress == 0 && $crop == 0) continue;

                    // maxstore nor maxcrop can go below the minimum threshold
                    if ($ress < STORAGE_BASE) $ress = STORAGE_BASE;
                    if ($crop < STORAGE_BASE) $crop = STORAGE_BASE;

                    mysqli_query($database->dblink,'UPDATE `' . TB_PREFIX . 'vdata` SET `maxstore` = ' . (int) $ress . ', `maxcrop` = ' . (int) $crop . ' WHERE `wref` = ' . (int) $row['vref']);

                    // commit in transe: tranzactii scurte = ferestre de lock mici
                    if (++$pending >= 200) {
                        mysqli_commit($database->dblink);
                        mysqli_begin_transaction($database->dblink);
                        $pending = 0;
                    }
                }
        mysqli_commit($database->dblink);
                return;
            } catch (mysqli_sql_exception $e) {
                if (!in_array((int) $e->getCode(), [1213, 1205], true)) {
                    throw $e; // orice alta eroare ramane fatala, ca inainte
                }
                try { mysqli_rollback($database->dblink); } catch (mysqli_sql_exception $ignored) {}
                if ($attempt === 3) {
                    // dupa 3 incercari renuntam la ACEST tick fara sa-l omoram;
                    // urmatorul tick reia calculul de la zero
                    error_log('Automation::updateStore: deadlock persistent dupa 3 incercari, amanat pentru tick-ul urmator');
                    return;
                }
                usleep(150000 * $attempt);
            }
        }
    }

    private function regenerateOasisTroops() {
        global $database;
        
        $timeFinal = time() - NATURE_REGTIME;
        $q = "SELECT wref FROM " . TB_PREFIX . "odata where conqured = 0 and lastupdated2 < $timeFinal";
        $array = $database->query_return($q);
        if (count($array)) {
            $ids = [];
            foreach($array as $oasis) $ids[] = $oasis['wref'];
            $database->regenerateOasisUnits($ids, true);
        }
    }
}
