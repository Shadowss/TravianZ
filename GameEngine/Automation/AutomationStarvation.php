<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationStarvation.php                                    ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Complete starvation pipeline (starvation*)                  ##
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

trait AutomationStarvation {

    
    /**
     * Function for starvation - by brainiacX and Shadow
     * Rework by ronix
     * Refactored by iopietro
     */
    
    private function starvation() {
        global $database, $technology;

        // Starvation is disabled during the peace period (holidays).
        if(PEACE) return;
        
        $time = time();

        // 1. Update starvation data for all villages.
        $this->starvationUpdateAllVillages();

        // 2. Load villages with negative production.
        $starvarray = $this->starvationGetVillagesWithDeficit();
        if (empty($starvarray)) return;

        $vilIDs = array_column($starvarray, 'wref');
        
        // 3. Prepare caches to reduce queries.
        $this->starvationPrepareCaches($vilIDs);

        foreach ($starvarray as $starv) {
            $this->starvationProcessVillage($starv, $time);
        }
    }

    /**
     * Update the starvation table for all villages.
    **/
	 
    private function starvationUpdateAllVillages() {
        global $database;
        $starvarray = $database->getProfileVillages(0, 7);
        foreach($starvarray as $starv) {
            $database->addStarvationData($starv['wref']);
        }
    }

    /**
     * Return villages with crop deficit.
    **/
	
    private function starvationGetVillagesWithDeficit() {
        global $database;
        return $database->getStarvation();
    }

    /**
     * Prepare troop caches.
    **/
	
    private function starvationPrepareCaches(array $vilIDs) {
        global $database;
        $database->getEnforceVillage($vilIDs, 0);
        $database->getOasisEnforce($vilIDs, 2);
        $database->getOasisEnforce($vilIDs, 3);
        $database->getPrisoners($vilIDs, 1);
        $database->getMovement(3, $vilIDs, 0);
        $database->getMovement(4, $vilIDs, 1);
    }

    /**
     * Process a single village for starvation.
    **/
	
    private function starvationProcessVillage($starv, $time) {
        global $database, $technology;

        $unitarrays = $this->getAllUnits($starv['wref']);
        // Original upkeep formula
        $upkeep = $starv['pop'] + $technology->getUpkeep($unitarrays, 0, $starv['wref']);

        $troopData = $this->starvationFindFirstTroopGroup($starv);
        if (empty($troopData['troops'])) {
            // No troops exist, only check reset.
            $this->starvationCheckReset($starv, $upkeep);
            return;
        }

        $starvingTroops = $troopData['troops'];
        $type = $troopData['type'];
        $subtype = $troopData['subtype'];

        $timedif = $time - $starv['starvupdate'];
        $cropProd = $database->getCropProdstarv($starv['wref']) - $starv['starv'];
        
        if($cropProd < 0){
            // Deficit calculation
            $starvsec = (abs($cropProd) / 3600);
            $difcrop = ($timedif * $starvsec);
            $oldcrop = $database->getVillageField($starv['wref'], 'crop');

            // Use granary crop first for consumption.
            if ($oldcrop > 100) {
                $difcrop = $difcrop - $oldcrop;
                if($difcrop < 0){
                    $difcrop = 0;
                    $newcrop = $oldcrop - $difcrop;
                    $database->setVillageField($starv['wref'], 'crop', $newcrop);
                }
            }

            if($difcrop > 0 && $oldcrop <= 0){
                $this->starvationKillTroops($starv, $starvingTroops, $type, $subtype, $difcrop, $upkeep, $time);
            }
        }

        $this->starvationCheckReset($starv, $upkeep);
    }

    /**
     * Locate the first troop group eligible for starvation.
     * Processing order: oasis enforcement → village enforcement → prisoners → own units → attacks.
    **/
	 
    private function starvationFindFirstTroopGroup($starv) {
        global $database;
        
        $enforceArrays = [
            $database->getOasisEnforce($starv['wref'], 2),
            $database->getOasisEnforce($starv['wref'], 3),
            $database->getEnforceVillage($starv['wref'], 2),
            $database->getEnforceVillage($starv['wref'], 3)
        ];
        
        $prisonerArrays = [$database->getPrisoners($starv['wref'], 1)];
        $unitArrays = ($database->getUnitsNumber($starv['wref'], 0) > 0) ? [[$database->getUnit($starv['wref'])]] : [];
        $attackArrays = [
            $database->getMovement(3, $starv['wref'], 0),
            $database->getMovement(4, $starv['wref'], 1)
        ];

        $allTroopsArray = [$enforceArrays, $prisonerArrays, $unitArrays, $attackArrays];

        foreach($allTroopsArray as $type => $allTroops) {
            if(!empty($allTroops)){
                foreach($allTroops as $subtype => $troops){
                    if(!empty($troops)){
                        return [
                            'troops' => reset($troops),
                            'type' => $type,
                            'subtype' => $subtype
                        ];
                    }
                }
            }
        }
        return ['troops' => [], 'type' => null, 'subtype' => null];
    }

    /**
     * Kill troops according to crop deficit.
    **/
	
    private function starvationKillTroops($starv, &$starvingTroops, $type, $subtype, $difcrop, $upkeep, $time) {
        global $database;

        $tribe = $database->getUserField(($type == 2) ? $starv['owner'] : $database->getVillageField($starvingTroops['from'], "owner"), "tribe", 0);
        $special = in_array($type, [1, 3]);
        $start = $special ? 1 : ($tribe - 1) * 10 + 1;
        $end = $special ? 10 : $tribe * 10;
        $utype = $special ? 't' : 'u';
        $heroType = $special ? 't11' : 'hero';

        $killedUnits = [];
        $totalUnits = 0;
        $counting = true;

        while($difcrop > 0) {
            $maxcount = $maxtype = 0;
            for($i = $start; $i <= $end; $i++) {
                $units = (isset($starvingTroops[$utype.$i]) ? $starvingTroops[$utype.$i] : 0);
                if($counting) $totalUnits += $units;
                if($units > $maxcount){
                    $maxcount = $units;
                    $maxtype = $i;
                }
            }
            if($counting) $counting = false;
            
            if($maxtype > 0){
                $starvingTroops[$utype.$maxtype]--;
                $killedUnits[$maxtype] = ($killedUnits[$maxtype] ?? 0) + 1;
                // Original per-unit crop consumption formula unchanged.
                $unitIndex = $special ? $maxtype + ($tribe - 1) * 10 : $maxtype;
                $difcrop -= $GLOBALS['u'.$unitIndex]['crop'];
            } else break;
        }

        $totalKilledUnits = array_sum($killedUnits);
        $newCrop = 0;

        // Determine whether the hero dies.
        if($starvingTroops[$heroType] > 0 && ($totalUnits == 0 || $totalUnits == $totalKilledUnits)){
            $totalKilledUnits += $starvingTroops[$heroType];
            $totalUnits += $starvingTroops[$heroType];
            $heroOwner = ($type == 2) ? $starv['owner'] : $database->getVillageField(($type == 3 && $subtype == 1) ? $starvingTroops['to'] : $starvingTroops['from'], "owner");
            $heroInfo = $database->getHero($heroOwner)[0];
            $database->modifyHero("dead", 1, $heroInfo['heroid']);
            $database->modifyHero("health", 0, $heroInfo['heroid']);
            $newCrop = $GLOBALS['h'.$heroInfo['unit'].'_full'][min($heroInfo['level'], 60)]['crop'] + $difcrop;
        } else if($maxtype > 0) {
            $newCrop = $GLOBALS['u'.$maxtype]['crop'];
        }

        if($totalKilledUnits > 0) {
            $this->starvationApplyDatabaseChanges($starv, $starvingTroops, $type, $killedUnits, $totalUnits, $totalKilledUnits, $newCrop, $upkeep, $time);
        }
    }

    /**
     * Apply starvation changes to the database.
    **/
	 
    private function starvationApplyDatabaseChanges($starv, $starvingTroops, $type, $killedUnits, $totalUnits, $totalKilledUnits, $newCrop, $upkeep, $time) {
        global $database;

        switch($type){
            case 0: // enforce
                if($totalKilledUnits < $totalUnits){
                    $database->modifyEnforce($starvingTroops['id'], array_keys($killedUnits), array_values($killedUnits), 0);
                } else {
                    $database->deleteReinf($starvingTroops['id']);
                }
                break;
            case 1: // prisoners
                if($totalKilledUnits < $totalUnits){
                    $database->modifyPrisoners($starvingTroops['id'], array_keys($killedUnits), array_values($killedUnits), 0);
                    $database->modifyUnit($starvingTroops['wref'], ["99o"], [$totalKilledUnits], [0]);
                } else {
                    $database->deletePrisoners($starvingTroops['id']);
                    $database->modifyUnit($starvingTroops['wref'], ["99o"], [$totalUnits], [0]);
                }
                break;
            case 2: // own units
                $database->modifyUnit($starv['wref'], array_keys($killedUnits), array_values($killedUnits), [0]);
                break;
            case 3: // moving attacks.
                if($totalKilledUnits < $totalUnits){
                    $database->modifyAttack2($starvingTroops['id'], array_keys($killedUnits), array_values($killedUnits), 0);
                } else {
                    $database->setMovementProc($starvingTroops['moveid']);
                }
                break;
        }
        
        $database->modifyResource($starv['wref'], 0, 0, 0, max($newCrop, 0), 1);
        $database->setVillageField($starv['wref'], ['starv', 'starvupdate'], [$upkeep, $time]);
    }

    /**
     * Verify whether starvation reset is allowed.
    **/
	 
    private function starvationCheckReset($starv, $upkeep) {
        global $database;
        $crop = $database->getCropProdstarv($starv['wref'], false);
        if ($crop > $upkeep) {
            $database->setVillageFields($starv['wref'], ['starv', 'starvupdate'], [0, 0]);
        }
    }
}
