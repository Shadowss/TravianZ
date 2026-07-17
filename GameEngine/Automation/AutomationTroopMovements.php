<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationTroopMovements.php                                ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Reinforcements, troop returns, settlers                     ##
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

trait AutomationTroopMovements {


    private function sendreinfunitsComplete() {
        global $bid23, $database, $technology, $battle;

        $time = time();
        $q = "
            SELECT
                `to`, `from`, moveid,
                t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11
            FROM
                ".TB_PREFIX."movement,
                ".TB_PREFIX."attacks 
            WHERE
                ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id
                AND
                ".TB_PREFIX."movement.proc = 0
                AND
                ".TB_PREFIX."movement.sort_type = 3
                AND
                ".TB_PREFIX."attacks.attack_type = 2
                AND
                endtime < $time";
        $dataarray = $database->query_return($q);

        if ($dataarray && count($dataarray)) {
            // preload village data
            $vilIDs = [];
            $tos = [];
            $froms = [];
            foreach($dataarray as $data) {
                $vilIDs[$data['from']] = true;
                $vilIDs[$data['to']] = true;
                $tos[$data['to']] = true;
                $froms[$data['from']] = true;
            }
            $vilIDs = array_keys($vilIDs);
            $database->getProfileVillages($vilIDs, 5);
            $database->getUnit($vilIDs);
            $database->getEnforce(array_keys($tos), array_keys($froms));
            $database->getVillageByWorldID($vilIDs);

            // calculate reinforcements data
            foreach($dataarray as $data) {
                if (!$this->claimMovementRecord($data['moveid'])) {
                    continue;
                }

				$isoasis = $database->isVillageOases($data['to']);
				if($isoasis == 0){
					$to = $database->getMInfo($data['to']);
					$toF = $database->getVillage($data['to']);
					$DefenderID = $to['owner'];
					$targettribe = $database->getUserField($DefenderID, "tribe", 0);
					$conqureby = 0;
				}else{
					$to = $database->getOMInfo($data['to']);
					$toF = $database->getOasisV($data['to']);
					$DefenderID = $to['owner'];
					$targettribe = $database->getUserField($DefenderID, "tribe", 0);
					$conqureby = $toF['conqured'];
				}

                if($data['from'] == 0){
                    // flow 1: a "village of the elders" reinforcement returning home
                    $this->completeReinforcementFromElders($data, $to);
                }else{
                    // flow 2: a standard reinforcement delivery (hero transfer + enforce merge + report)
                    $this->completeReinforcementDelivery($data, $to, $isoasis, $DefenderID);
                }

                //Update starvation data
                $database->addStarvationData($data['to']);

                //check empty reinforcement in rally point
                $e_units = '';
                for ($i = 1; $i <= 90; $i++) $e_units.= 'u'.$i.'= 0 AND ';

                $e_units.= 'hero = 0';
                $q = "DELETE FROM ".TB_PREFIX."enforcement WHERE ".$e_units." AND (vref=".(int) $data['to']." OR `from`=".(int) $data['to'].")";
                $database->query($q);
            }
        }
    }

    // Flow 1 of sendreinfunitsComplete(): a "village of the elders" reinforcement
    // (from = 0) returning home. $targetally / $AttackArrivalTime are intentionally
    // left undefined here, exactly as in the original inline code.
    private function completeReinforcementFromElders($data, $to) {
        global $database;

        $DefenderID = $database->getVillageField($data['to'], "owner");
        $database->addEnforce(['from' => $data['from'], 'to' => $data['to'], 't1' => 0, 't2' => 0, 't3' => 0, 't4' => 0, 't5' => 0, 't6' => 0, 't7' => 0, 't8' => 0, 't9' => 0, 't10' => 0, 't11' => 0]);
        $reinf = $database->getEnforce($data['to'], $data['from']);
        $database->modifyEnforce($reinf['id'], 31, 1, 1);
        $data_fail = '0,0,4,1,0,0,0,0,0,0,0,0,0,0';
		$database->addNotice($to['owner'], $to['wref'], (isset($targetally) ? $targetally : 0), 8, 'village of the elders reinforcement ' . addslashes($to['name']), $data_fail, isset($AttackArrivalTime) ? $AttackArrivalTime : time());
    }

    // Flow 2 of sendreinfunitsComplete(): a standard reinforcement delivery. Handles
    // the lone-hero transfer between own villages, the enforcement merge-or-create,
    // and the reinforcement notices. $ownally / $targetally / $AttackArrivalTime are
    // intentionally left undefined (guarded by isset()), exactly as in the original.
    private function completeReinforcementDelivery($data, $to, $isoasis, $DefenderID) {
        global $database;

        //set base things
        $from = $database->getMInfo($data['from']);
        $fromF = $database->getVillage($data['from']);
        $AttackerID = $from['owner'];
        $owntribe = $database->getUserField($AttackerID,"tribe",0);

        $HeroTransfer = $troopsPresent = 0;
        for($i = 1;$i <= 10; $i++) {
        	if($data['t'.$i] > 0) {
        		$troopsPresent = 1;
        		break;
        	}
        }

        //check if the hero is present and we're not sending him to an occupied oasis
        //only add hero if we're sending him alone
        if($data['t11'] > 0 && !$isoasis && !$troopsPresent) {
        	//check if we're sending a hero between own villages
            if($AttackerID == $DefenderID) {
                //check if there's a Mansion at target village
                if($this->getTypeLevel(37, $data['to']) > 0){
                    //don't reinforce, addunit instead
                    $database->modifyUnit($data['to'], ["hero"], [1], [1]);
                    $heroid = $database->getHeroField($DefenderID, 'heroid');
                    $database->modifyHero("wref", $data['to'], $heroid);
                    $HeroTransfer = 1;
                }
            }
        }

        if($data['t11'] > 0 || $troopsPresent) {
            $this->mergeOrCreateEnforcement($data, $owntribe, $HeroTransfer);
        }

        //send rapport
        $unitssend_att = ''.$data['t1'].','.$data['t2'].','.$data['t3'].','.$data['t4'].','.$data['t5'].','.$data['t6'].','.$data['t7'].','.$data['t8'].','.$data['t9'].','.$data['t10'].','.$data['t11'].'';
        $data_fail = ''.$from['wref'].','.$from['owner'].','.$owntribe.','.$unitssend_att.'';


        if($isoasis == 0) $to_name = $to['name'];
        else $to_name = "Oasis ".$database->getVillageField($to['conqured'],"name");

        $database->addNotice($from['owner'],$from['wref'],(isset($ownally) ? $ownally : 0),8,''.addslashes($from['name']).' reinforcement '.addslashes($to_name).'',$data_fail,(isset($AttackArrivalTime) ? $AttackArrivalTime : time()));
        if($from['owner'] != $to['owner']) {
            $database->addNotice($to['owner'],$to['wref'],(isset($targetally) ? $targetally : 0),8,''.addslashes($from['name']).' reinforcement '.addslashes($to_name).'',$data_fail,(isset($AttackArrivalTime) ? $AttackArrivalTime : time()));
        }
    }

    // Flow 3 of sendreinfunitsComplete(): merge the incoming troops into an existing
    // enforcement record at the target, or create a new one. When the hero was already
    // transferred as a unit ($HeroTransfer), his t11 is temporarily zeroed for the
    // merge and restored afterwards, exactly as in the original.
    private function mergeOrCreateEnforcement($data, $owntribe, $HeroTransfer) {
        global $database;

        $temphero = $data['t11'];
        if ($HeroTransfer) $data['t11'] = 0;
        //check if there is defence from town in to town
        $check = $database->getEnforce($data['to'], $data['from']);
        if (!isset($check['id'])) $database->addEnforce($data);
        else
        {
            //yes
            $start = ($owntribe - 1) * 10 + 1;
            $end = ($owntribe * 10);

            //add unit.
            $t_units = '';
            for($i = $start, $j = 1; $i <= $end; $i++, $j++)
            {
                $t_units .= "u".$i." = u".$i." + ".$data['t'.$j].(($j > 9) ? '' : ', ');
            }

            $q = "UPDATE ".TB_PREFIX."enforcement set $t_units where id =".(int) $check['id'];
            $database->query($q);
            $database->modifyEnforce($check['id'], 'hero', $data['t11'], 1);
        }
        $data['t11'] = $temphero;
    }

    private function returnunitsComplete() {
        global $database, $technology;

        $time = time();
        $q = "
            SELECT
                `to`, `from`, moveid, starttime, endtime, wood, clay, iron, crop,
                t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11
            FROM
                ".TB_PREFIX."movement,
                ".TB_PREFIX."attacks
            WHERE
                ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id
                AND
                ".TB_PREFIX."movement.proc = 0
                AND
                ".TB_PREFIX."movement.sort_type = 4
                AND
                endtime < $time";
        $dataarray = $database->query_return($q);

        if ($dataarray && count($dataarray)) {
            // preload village data
            $vilIDs = [];
            foreach($dataarray as $data) {
                $vilIDs[$data['from']] = true;
                $vilIDs[$data['to']] = true;
            }
            $database->getProfileVillages(array_keys($vilIDs), 5);
            $database->getOasisEnforce($vilIDs, 0);
            $database->getOasisEnforce($vilIDs, 1);

            foreach($dataarray as $data) {
                if (!$this->claimMovementRecord($data['moveid'])) {
                    continue;
                }

            	$tribe = $database->getUserField($database->getVillageField($data['to'], "owner"), "tribe", 0);
            	$u = $tribe == 1 ? "" : $tribe - 1;
            	$database->modifyUnit(
            			$data['to'],
            			[$u."1", $u."2", $u."3", $u."4", $u."5", $u."6", $u."7", $u."8", $u."9", $tribe."0", "hero"],
            			[$data['t1'], $data['t2'], $data['t3'], $data['t4'], $data['t5'], $data['t6'], $data['t7'], $data['t8'], $data['t9'], $data['t10'], $data['t11']],
            			[1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
            			);
            	
            	//If there's at least 1 resource, add it to the village
            	if($data['wood'] + $data['clay'] + $data['iron'] + $data['crop'] > 0){
            		$database->modifyResource($data['to'], $data['wood'], $data['clay'], $data['iron'], $data['crop'], 1);
            	}
            	
            	//Update starvation data
            	$database->addStarvationData($data['to']);
            }

            $this->pruneResource();
        }

        // Settlers
        $q = "SELECT `to`, moveid FROM ".TB_PREFIX."movement where ref = 0 and proc = '0' and sort_type = '4' and endtime < $time";
        $dataarray = $database->query_return($q);
        if ($dataarray && count($dataarray)) {
            foreach($dataarray as $data) {
                if (!$this->claimMovementRecord($data['moveid'])) {
                    continue;
                }

                $tribe = $database->getUserField($database->getVillageField($data['to'], "owner"), "tribe", 0);
                $database->modifyUnit($data['to'], [$tribe."0"], [3], [1]);
                
                //If a settling is canceled, add 750 for each resource type
                $database->modifyResource($data['to'], 750, 750, 750, 750, 1);
            }
        }
    }

    private function sendSettlersComplete() {
        global $database;

        $time = microtime(true);
        $q = "SELECT `to`, `from`, moveid, starttime, ref FROM ".TB_PREFIX."movement where proc = 0 and sort_type = 5 and endtime < $time";

        $dataarray = $database->query_return($q);
        $fieldIDs = [];
        $addUnitsWrefs = [];
        $addTechWrefs = [];
        $addABTechWrefs = [];
        $time = microtime(true);
        $types = [];
        $froms = [];
        $tos = [];
        $refs = [];
        $times = [];
        $endtimes = [];

        // preload village data
        $vilIDs = [];
        foreach($dataarray as $data) {
            $vilIDs[$data['from']] = true;
            $vilIDs[$data['to']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getProfileVillages($vilIDs, 5);
        $database->getVillageByWorldID($vilIDs);

        foreach($dataarray as $data) {
            if (!$this->claimMovementRecord($data['moveid'])) {
                continue;
            }

            $ownerID = $database->getUserField($database->getVillageField($data['from'], "owner"), "id", 0);
			$to = $database->getMInfo($data['from']);
			$user = addslashes($database->getUserField($to['owner'], 'username', 0));
			$taken = $database->getVillageState($data['to']);
			if($taken != 1){
				$fieldIDs[] = $data['to'];
				$database->addVillage($data['to'], $to['owner'], $user, '0');
				$database->addResourceFields($data['to'], $database->getVillageType($data['to']));
                $addUnitsWrefs[] = $data['to'];
                $addTechWrefs[] = $data['to'];
                $addABTechWrefs[] = $data['to'];
                
				$exp1 = $database->getVillageField($data['from'], 'exp1');
				$exp2 = $database->getVillageField($data['from'], 'exp2');
				$exp3 = $database->getVillageField($data['from'], 'exp3');
				
				if($exp1 == 0){
					$exp = 'exp1';
					$value = $data['to'];
				}elseif($exp2 == 0){
					$exp = 'exp2';
					$value = $data['to'];
				}else{
					$exp = 'exp3';
					$value = $data['to'];
				}
				
				$database->setVillageField($data['from'], $exp, $value);

				// Report: new village founded (issue #178)
				$ncoor = $database->getCoor($data['to']);
				$database->addNotice($to['owner'], $data['to'], 0, 24, 'New village founded', ($ncoor['x'] ?? 0) . ',' . ($ncoor['y'] ?? 0), time());
				
				// Milestone: first player ever to settle their 2nd village.
				// Checked right after the new village row exists, so the
				// COUNT below already includes it.
				if (defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES) {
					$villageCount = $database->countVillages($to['owner']);
					if ($villageCount == 2) {
						$database->recordMilestoneIfFirst('second_village', $to['owner'], $data['to']);
					}
				if ($villageCount == 5) {
						$database->recordMilestoneIfFirst('five_villages', $to['owner'], $data['to']);
					}
				}
            }else{
                // here must come movement from returning settlers
                $types[] = 4;
                $froms[] = $data['to'];
                $tos[] = $data['from'];
                $refs[] = $data['ref'];
                $times[] = $time;
                $endtimes[] = $time + ($time - $data['starttime']);

                // Report: valley already occupied, settlers returning (issue #178)
                $fcoor = $database->getCoor($data['to']);
                $database->addNotice($to['owner'], $data['to'], 0, 25, 'Settlers returned - valley occupied', ($fcoor['x'] ?? 0) . ',' . ($fcoor['y'] ?? 0), time());
            }
        }

        $database->addMovement($types, $froms, $tos, $refs, $times, $endtimes);
        $database->setFieldTaken($fieldIDs);
        $database->addUnits($addUnitsWrefs);
        $database->addTech($addTechWrefs);
        $database->addABTech($addABTechWrefs);

    }
}
