<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationMarket.php                                        ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Trade routes, marketplace deliveries, merchant returns      ##
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

trait AutomationMarket {


    private function delTradeRoute() {
        global $database;
     
        $database->delTradeRoute();
    }

    private function TradeRoute() {
        global $database;
        $time = time();
        $q = "SELECT `from`, wood, clay, iron, crop, wid, deliveries, id FROM ".TB_PREFIX."route where timestamp < $time";
        $dataarray = $database->query_return($q);

        $vilIDs = [];
        foreach($dataarray as $data) {
            $vilIDs[$data['wid']] = true;
            $vilIDs[$data['from']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getVillageByWorldID($vilIDs);

        foreach($dataarray as $data) {
            $targettribe = $database->getUserField($database->getVillageField($data['from'], "owner"), "tribe", 0);
			$this->sendResource2($data['wood'], $data['clay'], $data['iron'], $data['crop'], $data['from'], $data['wid'], $targettribe, $data['deliveries']);
			$database->editTradeRoute($data['id'], "timestamp", 86400, 1);
        }
    }

    private function marketComplete() {
        // Two independent phases share a single cutoff timestamp: sort_type = 0
        // new trade deliveries, then sort_type = 2 resending of resources.
        $time = microtime(true);
        $this->marketCompleteDeliveries($time);
        $this->marketCompleteResends($time);
    }

    private function marketCompleteDeliveries($time) {
        global $database, $units;

        $q = "SELECT s.wood, s.clay, s.iron, s.crop, `to`, `from`, endtime, merchant, send, moveid FROM ".TB_PREFIX."movement m, ".TB_PREFIX."send s WHERE m.ref = s.id AND m.proc = 0 AND sort_type = 0 AND endtime < $time";
        $dataarray = $database->query_return($q);

        foreach($dataarray as $data) {
            $userData_from = $database->getUserFields($database->getVillageField($data['from'], "owner"), "alliance, tribe", 0);
            $userData_to = $database->getUserFields($database->getVillageField($data['to'], "owner"), "alliance, tribe", 0);

            if($data['wood'] >= $data['clay'] && $data['wood'] >= $data['iron'] && $data['wood'] >= $data['crop']) $sort_type = 10;
            elseif($data['clay'] >= $data['wood'] && $data['clay'] >= $data['iron'] && $data['clay'] >= $data['crop']) $sort_type = 11;
            elseif($data['iron'] >= $data['wood'] && $data['iron'] >= $data['clay'] && $data['iron'] >= $data['crop']) $sort_type = 12;
            elseif($data['crop'] >= $data['wood'] && $data['crop'] >= $data['clay'] && $data['crop'] >= $data['iron']) $sort_type = 13;

            $to = $database->getMInfo($data['to']);
            $from = $database->getMInfo($data['from']);

            $ownally = $userData_from['alliance'];
            $targetally = $userData_to['alliance'];

            // Report filter preferences (#198): skip merchant-transfer notices
            // according to the saved checkboxes of the involved players.
            //   v4 -> recipient: no report for transfers to own villages
            //   v6 -> recipient: no report for transfers from foreign villages
            //   v5 -> sender:    no report for transfers to foreign villages
            $ownTransfer   = ($from['owner'] == $to['owner']);
            $skipRecipient = $ownTransfer ? !empty($userData_to['v4']) : !empty($userData_to['v6']);
            if(!$skipRecipient) {
                $database->addNotice($to['owner'],$to['wref'],$targetally,$sort_type,''.addslashes($from['name']).' send resources to '.addslashes($to['name']).'',''.$from['owner'].','.$from['wref'].','.$data['wood'].','.$data['clay'].','.$data['iron'].','.$data['crop'].'',$data['endtime']);
            }
            if(!$ownTransfer && empty($userData_from['v5'])) {
                $database->addNotice($from['owner'],$to['wref'],$ownally,$sort_type,''.addslashes($from['name']).' send resources to '.addslashes($to['name']).'',''.$from['owner'].','.$from['wref'].','.$data['wood'].','.$data['clay'].','.$data['iron'].','.$data['crop'].'',$data['endtime']);
            }
            $database->modifyResource($data['to'],$data['wood'],$data['clay'],$data['iron'],$data['crop'],1);

            // Push protection: record completed cross-player deliveries so the
            // admin dashboard can compute 7-day resource balance. Best-effort;
            // skips own-village transfers internally.
            if (!$ownTransfer) {
                PushProtection::logTransfer(
                    (int)$from['wref'], (int)$to['wref'],
                    (int)$from['owner'], (int)$to['owner'],
                    (int)$data['wood'], (int)$data['clay'], (int)$data['iron'], (int)$data['crop'],
                    (int)$data['endtime']
                );
            }
            $targettribe = $userData_to["tribe"];
            $endtime = $units->getWalkingTroopsTime($data['from'], $data['to'], 0, 0, [$targettribe], 0) + $data['endtime'];
            $database->addMovement(2, $data['to'], $data['from'], $data['merchant'], time(), $endtime, $data['send'], $data['wood'], $data['clay'], $data['iron'], $data['crop']);
            $database->setMovementProc($data['moveid']);
        }
    }

    private function marketCompleteResends($time) {
        global $database;

        $q1 = "SELECT send, moveid, `to`, wood, clay, iron, crop, `from` FROM ".TB_PREFIX."movement WHERE proc = 0 and sort_type = 2 and endtime < $time";
        $dataarray1 = $database->query_return($q1);

        $vilIDs = [];
        foreach($dataarray1 as $data1) {
            $vilIDs[$data1['to']] = true;
            $vilIDs[$data1['from']] = true;
        }
        $vilIDs = array_keys($vilIDs);
        $database->getVillageByWorldID($vilIDs);

        foreach($dataarray1 as $data1) {
            $database->setMovementProc($data1['moveid']);
            if($data1['send'] > 1){
                $targettribe1 = $database->getUserFields($database->getVillageField($data1['to'],"owner"),"alliance, tribe",0)['tribe'];
                $send = $data1['send']-1;
                $this->sendResource2($data1['wood'],$data1['clay'],$data1['iron'],$data1['crop'],$data1['to'],$data1['from'],$targettribe1,$send);
            }
        }
    }

    private function sendResource2($wtrans, $ctrans, $itrans, $crtrans, $from, $to, $tribe, $send) {
        global $bid17, $bid28, $database, $units;

        $availableWood = $database->getWoodAvailable($from);
        $availableClay = $database->getClayAvailable($from);
        $availableIron = $database->getIronAvailable($from);
        $availableCrop = $database->getCropAvailable($from);
        
        if($availableWood + $availableClay + $availableIron + $availableCrop > 0)
        {
            if($availableWood < $wtrans) $wtrans = $availableWood;
            if($availableClay < $ctrans) $ctrans = $availableClay;
            if($availableIron < $itrans) $itrans = $availableIron;
            if($availableCrop < $crtrans) $crtrans = $availableCrop;          
            
            $merchant2 = ($this->getTypeLevel(17, $from) > 0)? $this->getTypeLevel(17, $from) : 0;
            $used2 = $database->totalMerchantUsed($from, false);
            $merchantAvail2 = $merchant2 - $used2;
            $carrymap = array(1 => 500, 2 => 1000, 3 => 750, 6 => 500, 7 => 750, 8 => 500, 9 => 750);
            $maxcarry2 = isset($carrymap[$tribe]) ? $carrymap[$tribe] : 750;
            $maxcarry2 *= TRADER_CAPACITY;
            
            if($this->getTypeLevel(28, $from) != 0) {
                $maxcarry2 *= $bid28[$this->getTypeLevel(28, $from)]['attri'] / 100;
            }
            
            $resource = [$wtrans, $ctrans, $itrans, $crtrans];
            $reqMerc = ceil((array_sum($resource) - 0.1) / $maxcarry2);
            
            if($merchantAvail2 > 0 && $reqMerc <= $merchantAvail2) {                
                if($database->getVillageState($to)) {
                    $timetaken = $units->getWalkingTroopsTime($from, $to, 0, 0, [$tribe], 0);
                    $res = $resource[0] + $resource[1] + $resource[2] + $resource[3];
                    if($res > 0){
                        $reference = $database->sendResource($resource[0], $resource[1], $resource[2], $resource[3], $reqMerc, 0);
                        $database->modifyResource($from, $resource[0], $resource[1], $resource[2], $resource[3], 0);
                        $database->addMovement(0, $from, $to, $reference, microtime(true), microtime(true) + $timetaken, $send);
                    }
                }           
            }
        }
    }
}
