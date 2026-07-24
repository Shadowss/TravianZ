<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationBuildQueue.php                                    ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Building completion, WW, demolitions, research              ##
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

trait AutomationBuildQueue {


    private function buildComplete() {
        global $database;

        $time = time();
        // IDs of villages that were affected by this building completion update,
        // used to calculate statistical data at the end
        $villagesAffected = [];
        // holds additional conditions when updating loopcon records in the bdata table
        $loopconUpdates = [];
        // this will hold IDs of bdata table records to delete
        $dbIdsToDelete = [];

        // get all pending builds that should be complete by now
        $res = $database->query_return(
            "SELECT
                id, wid, field, level, type, timestamp
             FROM
                ".TB_PREFIX."bdata
            WHERE
                timestamp < $time and master = 0"
        );

        // preload village data
        $vilIDs = [];
        foreach($res as $indi) {
            $vilIDs[$indi['wid']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getProfileVillages($vilIDs, 5);
        $database->getEnforceVillage($vilIDs, 0);

        // complete buildings
        foreach($res as $indi) {
            // store village ID for later for statistical updates
            $villageData = $database->getVillageFields($indi['wid'],'owner, maxcrop, maxstore, starv, pop');
            $villageOwner = $villageData['owner'];
            $villagesAffected[] = (int) $indi['wid'];
            $fieldsToSet = [];
            
            $q = "UPDATE ".TB_PREFIX."fdata SET f".$indi['field']." = ".$indi['level'].", f".$indi['field']."t = ".$indi['type']." WHERE vref = ".(int) $indi['wid'];

            if($database->query($q)) {
                // this will be the level we brought the building to now
                $level = $indi['level'];

                // TODO: magic numbers into constants (for building types below)

                // update capacity if we updated a warehouse or a granary
                if (in_array($indi['type'], [10, 11, 38, 39])) {
                    [$fieldDbName, $max] = $this->updateStorageCapacity($indi['type'], $level, $villageData);
                    $fieldsToSet[$fieldDbName] = $max;
                }

                // if we updated Embassy, update maximum members that the alliance can take
                if($indi['type'] == 18) Automation::updateMax($villageOwner);

                // World Wonder completion handling (Natar attacks, winner lock, last-upgrade time)
                if ($indi['type'] == 40) $this->completeWorldWonder($indi);

                // TODO: find out what exactly these conditions are for
                // no special military conditioning for Teutons and Gauls
                if ($database->getUserField($villageOwner, "tribe", 0) != 1) $loopconUpdates[$indi['wid']] = '';                 
                else
                {
                    // special condition for Roman military buildings
                    if ($indi['field'] > 18) $loopconUpdates[$indi['wid']] = ' AND field > 18';                    
                    else $loopconUpdates[$indi['wid']] = ' AND field < 19';                                      
                }

                $dbIdsToDelete[] = (int) $indi['id'];
            }

            //Update starvation data
            $database->addStarvationData($indi['wid']);

            // update the requested fields, all at once
            $database->setVillageFields($indi['wid'], array_keys($fieldsToSet), array_values($fieldsToSet));
        }

        // update statistical data for affected villages
        foreach ($villagesAffected as $affected_id) $this->recountPop($affected_id, false);

        // update data that can be done in one swoop instead of using multiple update queries
        // no special checks for Romans
        foreach ($loopconUpdates as $villageId => $updateCondition) {
            $database->query(
                "UPDATE
                    ".TB_PREFIX."bdata
                 SET
                    loopcon = 0
                 WHERE
                    loopcon = 1 AND
                    master = 0 AND
                    wid = ".$villageId.$updateCondition);
        }

        // delete all processed entries
        if (count($dbIdsToDelete)) {
            $database->query( "DELETE FROM " . TB_PREFIX . "bdata WHERE id IN(" . implode( ',', $dbIdsToDelete ) . ")" );
        }
    }

    /**
     * Handle the side effects of completing a World Wonder (type 40) build:
     * launch the Natar attack waves, lock out further winners at level 100,
     * and record the last upgrade time.
     */
    private function completeWorldWonder($indi) {
        global $database;

        if (($indi['level'] % 5 == 0 || $indi['level'] > 95) && $indi['level'] != 100) {
            $this->startNatarAttack($indi['level'], $indi['wid'], $indi['timestamp']);
        }

        //now can't be more than one winner if ww to level 100 is build by 2 users or more on same time
        if ($indi['level'] == 100) {
            mysqli_query($database->dblink,"TRUNCATE ".TB_PREFIX."bdata");
        }

        // Update ww last finish upgrade
        $qW = "UPDATE ".TB_PREFIX."fdata set ww_lastupdate = ".time()." where vref = ".(int) $indi['wid'];
        $database->query($qW);
    }

    private function researchComplete() {
        global $database;

        $time = time();
        $deleteIDs = [];
        $tdata = [];
        $abdata = [];

        $q = "SELECT tech, vref, id FROM ".TB_PREFIX."research where timestamp < $time";
        $dataarray = $database->query_return($q);

        foreach($dataarray as $data) {
            $sort_type = substr($data['tech'],0,1);
            switch($sort_type) {
                case "t":
                    if (!isset($tdata[$data['vref']])) $tdata[$data['vref']] = [];
                    $tdata[$data['vref']][] = $data['tech'].' = 1';
                    break;
                case "a":
                case "b":
                    if (!isset($abdata[$data['vref']])) $abdata[$data['vref']] = [];
                    $abdata[$data['vref']][] = $data['tech']." = ".$data['tech']." + 1";
                    break;
            }
            $deleteIDs[] = (int) $data['id'];
        }

        // execute queries with consolidated research data
        if (count($tdata)) {
            foreach ( $tdata as $vid => $preparedData ) {
                $q = "UPDATE ".TB_PREFIX."tdata SET ".implode(', ', $preparedData)." WHERE vref = ".$vid;
                $database->query($q);
            }
        }

        if (count($abdata)) {
            foreach ( $abdata as $vid => $preparedData ) {
                $q = "UPDATE ".TB_PREFIX."abdata SET ".implode(', ', $preparedData)." WHERE vref = ".$vid;
                $database->query($q);
            }
        }

        if (count($deleteIDs)) {
            $q = "DELETE FROM " . TB_PREFIX . "research where id IN(" . implode( ', ', $deleteIDs ) . ")";
            $database->query( $q );
        }
    }

    private function demolitionComplete() {
        global $database;

        $varray = $database->getDemolition();
        foreach($varray as $vil) {
			if ($vil['lvl'] < 0) {
		$database->delDemolition($vil['vref'], true);
		continue;
		}
            if ($vil['timetofinish'] <= time()) {
                $type = $database->getFieldType($vil['vref'],$vil['buildnumber']);
                $level = $database->getFieldLevel($vil['vref'],$vil['buildnumber']);

                $newLevel = max(0, $level - 1);

                $buildarray = $GLOBALS["bid".$type];

                // FIX: capacitatea de depozitare se RECALCULEAZA din cladirile
                // ramase, dupa ce nivelul nou e scris mai jos. Scaderea de
                // dinainte lua `attri` al nivelului, dar `attri` e capacitatea
                // TOTALA la acel nivel (1200, 1700, 2300...), nu incrementul -
                // deci taia prea mult. Ignora si STORAGE_MULTIPLIER. Efectul era
                // ascuns de pragul STORAGE_BASE si "reparat" abia la urmatoarea
                // rulare a lui updateStore().
                $needsStorageRecalc = in_array($type, [10, 11, 38, 39]);

                if ($level == 1) $clear = ",f".$vil['buildnumber']."t=0";
                else $clear = "";

                if ($database->getVillageField($vil['vref'], 'natar') == 1 && $type == 40) $clear = ""; //fix by ronix - fixed by iopietro
				$q = "UPDATE ".TB_PREFIX."fdata SET f".$vil['buildnumber']."=".$newLevel." ".$clear." WHERE vref=".(int)$vil['vref'];
                $database->query($q);

                if ($needsStorageRecalc) {
                    $database->recalculateStorage($vil['vref']);
                }

                $pop = $this->getPop($type, $newLevel);
                $database->modifyPop($vil['vref'], $pop[0], 1);
                $this->procClimbers($database->getVillageField($vil['vref'], 'owner'));
                $database->delDemolition($vil['vref'], true);

                if ($type == 18) Automation::updateMax($database->getVillageField($vil['vref'], 'owner'));
            }
        }

    }

    private function MasterBuilder() {
        global $database;
        
        $q = "SELECT id, wid, type, level, field, timestamp FROM ".TB_PREFIX."bdata WHERE master = 1";
        $array = $database->query_return($q);

        foreach($array as $master) {      
            $owner = $database->getVillageField($master['wid'], 'owner');
            $tribe = $database->getUserField($owner, 'tribe', 0);
            $villwood = $database->getVillageField($master['wid'], 'wood');
            $villclay = $database->getVillageField($master['wid'], 'clay');
            $villiron = $database->getVillageField($master['wid'], 'iron');
            $villcrop = $database->getVillageField($master['wid'], 'crop');
            $type = $master['type'];
            $level = $master['level'];
            $buildarray = $GLOBALS["bid".$type];
            $buildwood = $buildarray[$level]['wood'];
            $buildclay = $buildarray[$level]['clay'];
            $buildiron = $buildarray[$level]['iron'];
            $buildcrop = $buildarray[$level]['crop'];
            $ww = count($database->getBuildingByType($master['wid'], 40));

            if($tribe == 1){
                if($master['field'] < 19){
                    $bdata = $database->getDorf1Building($master['wid']);
                    $bdataTotal = count($bdata);
                    $bbdata = count($database->getDorf2Building($master['wid']));
                }else{
                    $bdata = $database->getDorf2Building($master['wid']);
                    $bdataTotal = count($bdata);
                    $bbdata = count($database->getDorf1Building($master['wid']));
                }
            }else{
                $bdata = array_merge($database->getDorf1Building($master['wid']), $database->getDorf2Building($master['wid']));
                $bdataTotal = $bbdata = count($bdata);          
            }

            if($database->getUserField($owner, 'plus', 0) > time() || $ww > 0){
                if($bbdata < 2) $inbuild = 2;                
                else $inbuild = 1;
            }
            else $inbuild = 1;

            $usergold = $database->getUserField($owner, 'gold', 0);

            if($bdataTotal < $inbuild && $buildwood <= $villwood && $buildclay <= $villclay && $buildiron <= $villiron && $buildcrop <= $villcrop && $usergold > 0){
                $time = $master['timestamp'] + time();

                if(!empty($bdata)){
                    foreach($bdata as $masterLoop) $time += ($masterLoop['timestamp'] - time());
                }

                if($bdataTotal == 0) $database->updateBuildingWithMaster($master['id'], $time, 0);                  
                else $database->updateBuildingWithMaster($master['id'], $time, 1);             

                $database->updateUserField($owner, 'gold', --$usergold, 1);
                $database->modifyResource($master['wid'], $buildwood, $buildclay, $buildiron, $buildcrop, 0);
            }
        }
    }
}
