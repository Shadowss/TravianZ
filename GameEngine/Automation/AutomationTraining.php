<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationTraining.php                                      ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Unit training, hospital/healing, celebrations               ##
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

trait AutomationTraining {


    /**
     * Spital (gid 46) / Spital Mare (gid 48): o parte din trupele proprii moarte
     * in apararea satului devin ranite, in limita capacitatii spitalului.
     * Cota: 40% (Spital) / 50% (Spital Mare). Capacitate: nivel x 30 / nivel x 60.
     * Doar unitatile de lupta (X1-X8); chief, settler si eroul nu pot fi raniti.
     */
    private function applyHospitalWounded($vref, array $deadByUnit) {
        global $database;

        $hospital = $database->getFieldLevelInVillage($vref, '46');
        $bighospital = $database->getFieldLevelInVillage($vref, '48');
        if($hospital <= 0 && $bighospital <= 0) return;

        $share = $bighospital > 0 ? 0.50 : 0.40;
        $capacity = $bighospital > 0 ? $bighospital * 60 : $hospital * 30;

        $stored = 0;
        $current = $database->getWounded($vref);
        if(!empty($current)) {
            for($i = 1; $i <= 90; $i++) $stored += isset($current['u'.$i]) ? (int)$current['u'.$i] : 0;
        }
        $free = $capacity - $stored;
        if($free <= 0) return;

        $units = []; $amounts = [];
        foreach($deadByUnit as $i => $deadAmt) {
            if(empty($deadAmt)) continue;
            $wounded = (int)floor($deadAmt * $share);
            if($wounded <= 0) continue;
            if($wounded > $free) $wounded = $free;
            $units[] = $i;
            $amounts[] = $wounded;
            $free -= $wounded;
            if($free <= 0) break;
        }
        if(!empty($units)) $database->addWounded($vref, $units, $amounts);
    }

    /**
     * Proceseaza coada de vindecare: unitatile vindecate se intorc in sat
     * incremental (una la fiecare 'eachtime' secunde), ca la antrenare.
     */
    private function healingComplete() {
        global $database;

        $time = time();
        $healinglist = $database->getHealingDue($time);
        foreach($healinglist as $heal) {
            $healed = 1;
            if($heal['eachtime'] > 0) {
                $healed += (int)floor(($time - $heal['timestamp2']) / $heal['eachtime']);
            }
            if($healed > $heal['amt']) $healed = (int)$heal['amt'];
            if($healed <= 0) continue;

            $database->modifyUnit($heal['vref'], [$heal['unit']], [$healed], [1]);

            $remaining = (int)$heal['amt'] - $healed;
            if($remaining <= 0) {
                $database->deleteHealing($heal['id']);
            } else {
                $database->updateHealing($heal['id'], $remaining, (int)$heal['timestamp2'] + $healed * (int)$heal['eachtime']);
            }
        }
    }

    private function trainingComplete() {
        global $database, $technology;

        $time = time();
        $trainlist = $database->getTrainingList();
        if(count($trainlist) > 0){
            // preload village data
            $vilIDs = [];
            foreach($trainlist as $train){
                $vilIDs[$train['vref']] = true;
            }
            $vilIDs = array_keys($vilIDs);
            $database->getProfileVillages($vilIDs, 5);
            $database->cacheResourceLevels($vilIDs);
            $database->getUnit($vilIDs);
            $database->getEnforceVillage($vilIDs, 0 );
            $database->getMovement(3, $vilIDs, 0);
            $database->getMovement(4, $vilIDs, 1);
            $database->getMovement(5, $vilIDs, 0);
            $database->getOasisEnforce($vilIDs, 0);
            $database->getOasisEnforce($vilIDs, 1);
            $database->getPrisoners($vilIDs, 1);

            // calculate training updates
            foreach($trainlist as $train){
                $timepast = $train['timestamp2'] - $time;
                $pop = $train['pop'];
                $valuesUpdated = false;
                if($timepast <= 0 && $train['amt'] > 0) {
                    $valuesUpdated = true;
                    if($train['eachtime'] > 0){                       
                        $timepast2 = $time - $train['timestamp2'];
                        $trained = 1;
                        while($timepast2 >= $train['eachtime']){
                            $timepast2 -= $train['eachtime'];
                            $trained += 1;
                        }
                        
                        if($trained > $train['amt']) $trained = $train['amt'];
                    }
                    else $trained = $train['amt'];               
                    
                    if($train['unit'] > 1000 && $train['unit'] != 99){
                        $database->modifyUnit($train['vref'], [$train['unit'] - 1000], [$trained], [1]);
                    }
                    else $database->modifyUnit($train['vref'], [$train['unit']], [$trained], [1]);
                
                    $database->updateTraining($train['id'], $trained, $trained * $train['eachtime']);
                    
                    if($train['amt'] - $trained <= 0) $database->trainUnit($train['id'], 0, 0, 0, 0, 1);
                }

                if ($valuesUpdated) call_user_func(get_class($database).'::clearUnitsCache');
             
                //Update starvation data
                $database->addStarvationData($train['vref']);
            }
        }
    }

    private function celebrationComplete() {
        global $database;

        $varray = $database->getCel();
        foreach($varray as $vil){
            $id = $vil['wref'];
            $type = $vil['type'];
            $user = $vil['owner'];
            $cp = ($type == 1) ? 500 : 2000;           
            $database->clearCel($id);
            $database->setCelCp($user, $cp);
        }
    }

    /**
     * Expires Mead-Festivals (Brewery, building 35). Unlike celebrationComplete()
     * this grants no reward — the festival only gated the temporary combat
     * bonus / chief penalty / catapult randomization while it was active.
     */
    private function festivalComplete() {
        global $database;

        $varray = $database->getFestivals();
        foreach($varray as $vil){
            $database->clearFestival($vil['wref']);
        }
    }
}
