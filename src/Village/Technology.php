<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Village;

use TravianZ\Utils\Generator;

class Technology
{
    public static $unarray = [
        1 => U1,
        U2,
        U3,
        U4,
        U5,
        U6,
        U7,
        U8,
        U9,
        U10,
        U11,
        U12,
        U13,
        U14,
        U15,
        U16,
        U17,
        U18,
        U19,
        U20,
        U21,
        U22,
        U23,
        U24,
        U25,
        U26,
        U27,
        U28,
        U29,
        U30,
        U31,
        U32,
        U33,
        U34,
        U35,
        U36,
        U37,
        U38,
        U39,
        U40,
        U41,
        U42,
        U43,
        U44,
        U45,
        U46,
        U47,
        U48,
        U49,
        U50,
        U99,
        U0
    ];
    
    private $village;

    public function __construct(Village $village){
        $this->village = $village;
    }
    
    public function grabAcademyRes()
    {
        $holder = [];
        foreach ($this->village->researching as $research) {
            if (substr($research['tech'], 0, 1) == "t")
                array_push($holder, $research);
        }
        return $holder;
    }

    public function getABUpgrades($type = 'a')
    {
        $holder = [];
        foreach ($this->village->researching as $research) {
            if (substr($research['tech'], 0, 1) == $type)
                array_push($holder, $research);
        }
        return $holder;
    }

    public function isResearch($tech, $type)
    {        
        if (count($this->village->researching) == 0) {
            return false;
        } else {
            switch ($type) {
                case 1:
                    $string = "t";
                    break;
                case 2:
                    $string = "a";
                    break;
                case 3:
                    $string = "b";
                    break;
            }
            
            foreach ($this->village->researching as $research) {
                if ($research['tech'] == $string . $tech)
                    return true;
            }
            
            return false;
        }
    }

    public function procTech($post)
    {
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "t1":
                    $this->procTrain($post);
                    break;
                case "t3":
                    $this->procTrain($post, true);
                    break;
            }
        }
    }

    public function procTechno($get)
    {
        if (isset($get['a'])) {
            switch ($this->village->resarray['f' . $get['id'] . 't']) {
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

    public function getUnitList()
    {
        $unitarray = func_num_args() == 1 ? $this->village->database->getUnit(func_get_arg(0)) : $this->village->unitall;
        $listArray = [];
        for ($i = 1; $i < count(self::unarray); $i++) {
            $holder = [];
            if (!empty($unitarray['u' . $i]) && $unitarray['u' . $i] > 0 && !empty($unitarray['u' . $i])) {
                $holder['id'] = $i;
                $holder['name'] = self::unarray[$i];
                $holder['amt'] = $unitarray['u' . $i];
                array_push($listArray, $holder);
            }
        }
        
        if ($unitarray['hero'] > 0 && !empty($unitarray['hero'])) {
            $holder['id'] = "hero";
            $holder['name'] = self::unarray[$i];
            $holder['amt'] = $unitarray['hero'];
            array_push($listArray, $holder);
        }
        return $listArray;
    }

    public function maxUnit($unit, $great = false)
    {
        $unit = "u" . $unit;
        global $$unit;
        
        $unitarray = $$unit;
        $res = $this->village->database->getVillage($this->village->wid, 0, false);
        if ($res['wood'] > $res['maxstore'])
            $res['wood'] = $res['maxstore'];
        if ($res['clay'] > $res['maxstore'])
            $res['clay'] = $res['maxstore'];
        if ($res['iron'] > $res['maxstore'])
            $res['iron'] = $res['maxstore'];
        if ($res['crop'] > $res['maxcrop'])
            $res['crop'] = $res['maxcrop'];
        
        $woodcalc = floor($res['wood'] / ($unitarray['wood'] * ($great ? 3 : 1)));
        $claycalc = floor($res['clay'] / ($unitarray['clay'] * ($great ? 3 : 1)));
        $ironcalc = floor($res['iron'] / ($unitarray['iron'] * ($great ? 3 : 1)));
        
        if ($res['crop'] > 0) {
            $cropcalc = floor($res['crop'] / ($unitarray['crop'] * ($great ? 3 : 1)));
        } else {
            $cropcalc = 0;
        }
            
        
        if ($unit != "u99") {
            $popcalc = floor($this->village->getProd("crop") / $unitarray['pop']);
        } else {
            $popcalc = $this->village->getProd("crop");
        }
        
        return min($woodcalc, $claycalc, $ironcalc, $cropcalc);
    }

    public function maxUnitPlus($unit, $great = false)
    {
        $unit = "u" . $unit;
        global $$unit;
        
        $unitarray = $$unit;
        $res = $this->village->database->getVillage($this->village->wid);
        $totalres = $res['wood'] + $res['clay'] + $res['iron'] + $res['crop'];
        $totalresunit = ($unitarray['wood'] * ($great ? 3 : 1)) + ($unitarray['clay'] * ($great ? 3 : 1)) + ($unitarray['iron'] * ($great ? 3 : 1)) + ($unitarray['crop'] * ($great ? 3 : 1));
        $max = round($totalres / $totalresunit);
        return $max;
    }

    public function getUnits()
    {        
        if (func_num_args() == 1) {
            $base = func_get_arg(0);
        } 

        $ownunit = func_num_args() == 2 ? func_get_arg(0) : $this->village->database->getUnit($base);
        $enforcementarray = func_num_args() == 2 ? func_get_arg(1) : $this->village->database->getEnforceVillage($base, 0);
        if (count($enforcementarray) > 0) {
            foreach ($enforcementarray as $enforce) {
                for ($i = 1; $i <= 50; $i++) {
                    $ownunit['u' . $i] += $enforce['u' . $i];
                }
            }
        }
        return $ownunit;
    }

    function getAllUnits($base, $InVillageOnly = false, $mode = 0, $useCache = true)
    {        
        $ownunit = $this->village->database->getUnit($base, $useCache);
        $ownunit['u99'] -= $ownunit['u99'];
        $ownunit['u99o'] -= $ownunit['u99o'];
        $enforcementarray = $this->village->database->getEnforceVillage($base, 0, $useCache);
        if (count($enforcementarray) > 0) {
            foreach ($enforcementarray as $enforce) {
                for ($i = 1; $i <= 50; $i++) {
                    $ownunit['u' . $i] += $enforce['u' . $i];
                }
                $ownunit['hero'] += $enforce['hero'];
            }
        }
        if ($mode == 0) {
            $enforceoasis = $this->village->database->getOasisEnforce($base, 0, $useCache);
            if (count($enforceoasis) > 0) {
                foreach ($enforceoasis as $enforce) {
                    for ($i = 1; $i <= 50; $i++) {
                        $ownunit['u' . $i] += $enforce['u' . $i];
                    }
                    $ownunit['hero'] += $enforce['hero'];
                }
            }
            $enforceoasis1 = $this->village->database->getOasisEnforce($base, 1, $useCache);
            if (count($enforceoasis1) > 0) {
                foreach ($enforceoasis1 as $enforce) {
                    for ($i = 1; $i <= 50; $i++) {
                        $ownunit['u' . $i] += $enforce['u' . $i];
                    }
                    $ownunit['hero'] += $enforce['hero'];
                }
            }
            
            $prisoners = $this->village->database->getPrisoners($base, 1, $useCache);
            if (!empty($prisoners)) {
                foreach ($prisoners as $prisoner) {
                    $owner = $this->village->database->getVillageField($base, "owner");
                    $ownertribe = $this->village->database->getUserField($owner, "tribe", 0);
                    $start = ($ownertribe - 1) * 10 + 1;
                    $end = ($ownertribe * 10);
                    for ($i = $start; $i <= $end; $i++) {
                        $j = $i - $start + 1;
                        $ownunit['u' . $i] += $prisoner['t' . $j];
                    }
                    $ownunit['hero'] += $prisoner['t11'];
                }
            }
        }
        
        if (!$InVillageOnly) {
            $movement = $this->village->database->getVillageMovement($base);
            if (!empty($movement)) {
                for ($i = 1; $i <= 50; $i++) {
                    if (!isset($ownunit['u' . $i]))
                        $ownunit['u' . $i] = 0;
                    $ownunit['u' . $i] += (isset($movement['u' . $i]) ? $movement['u' . $i] : 0);
                }
                
                if (!isset($ownunit['hero']))
                    $ownunit['hero'] = 0;
                $ownunit['hero'] += (isset($movement['hero']) ? $movement['hero'] : 0);
            }
        }
        return $ownunit;
    }

    public function meetTRequirement($unit)
    {
        switch ($unit) {
            
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
                return $this->getTech($unit) && $this->village->session->tribe == 1;
            
            case 1:
            case 10:
                return $this->village->session->tribe == 1;
            
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
                return $this->village->session->tribe == 2 && $this->getTech($unit);
            
            case 11:
            case 20:
                return $this->village->session->tribe == 2;
            
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                return $this->village->session->tribe == 3 && $this->getTech($unit);
            
            case 21:
            case 30:
                return $this->village->session->tribe == 3;
            
            case 32:
            case 33:
            case 34:
            case 35:
            case 36:
            case 37:
            case 38:
                return $this->village->session->tribe == 4 && $this->getTech($unit);
            
            case 31:
            case 40:
                return $this->village->session->tribe == 4;
            
            case 42:
            case 43:
            case 44:
            case 45:
            case 46:
            case 47:
            case 48:
                return $this->village->session->tribe && $this->getTech($unit);
            
            case 41:
            case 50:
                return $this->village->session->tribe == 5;
        }
    }

    public function getTech($tech)
    {
        return (isset($this->village->techarray['t' . $tech]) && $this->village->techarray['t' . $tech] == 1);
    }

    private function procTrain($post, $great = false)
    { 
        // first of all, check if we're not trying to train chieftain
        // and settlers together - which we cannot, since that can result
        // in 1 chieftain and 3 settlers, then conquering a village, then
        // founding a new one, all with only 1 available slot
        if (!((!empty($post['t9']) && !empty($post['t10'])) || (!empty($post['t19']) && !empty($post['t20'])) || (!empty($post['t29']) && !empty($post['t30'])) || (!empty($post['t39']) && !empty($post['t40'])) || (!empty($post['t49']) && !empty($post['t50'])))) {
            $start = ($this->village->session->tribe - 1) * 10 + 1;
            $end = ($this->village->session->tribe * 10);
            for ($i = $start; $i <= $end; $i++) {
                if (isset($post['t' . $i]) && $post['t' . $i] != 0) {
                    $amt = intval($post['t' . $i]);
                    if ($amt < 0) {
                        $amt = 1;
                    }
                    $this->trainUnit($i, $amt, $great);
                }
            }
            
            if ($this->village->session->tribe == 3) {
                if (isset($post['t99']) && $post['t99'] != 0) {
                    $amt = intval($post['t99']);
                    if ($amt < 0) {
                        $amt = 1;
                    }
                    $this->trainUnit(99, $amt, $great);
                }
            }
            
            header("Location: build.php?id=" . $post['id']);
            exit();
        }
    }

    private function trainUnit($unit, $amt, $great = false)
    {
        global ${'u' . $unit}, $bid19, $bid20, $bid21, $bid25, $bid26, $bid29, $bid30, $bid36, $bid41, $bid42;
        
        if ($this->getTech($unit) || $unit % 10 <= 1 || $unit == 99) {
            $footies = [1, 2, 3, 11, 12, 13, 14, 21, 22, 31, 32, 33, 34, 41, 42, 43, 44];
            $calvary = [4, 5, 6, 15, 16, 23, 24, 25, 26, 35, 36, 45, 46];
            $workshop = [7, 8, 17, 18, 27, 28, 37, 38, 47, 48];
            $special = [9, 10, 19, 20, 29, 30, 39, 40, 49, 50];
            $trapper = [99];
            
            // Check if the player is trying to train troops without the needed buildings
            if ((in_array($unit, $footies) && ($this->village->building->getTypeLevel(19) == 0 && $this->village->building->getTypeLevel(29) == 0))  || (in_array($unit, $calvary) && ($this->village->building->getTypeLevel(20) == 0 && $this->village->building->getTypeLevel(30) == 0)) || (in_array($unit, $workshop) && ($this->village->building->getTypeLevel(21) == 0 && $this->village->building->getTypeLevel(42) == 0)) || (in_array($unit, $special) && ($this->village->building->getTypeLevel(25) < 10 && $this->village->building->getTypeLevel(26) < 10)) || (in_array($unit, $trapper) && $this->village->building->getTypeLevel(36) == 0)) {
                return;
            }

            if (in_array($unit, $footies)) {
                if ($great) {
                    $each = round(($bid29[$this->village->building->getTypeLevel(29)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
                } else {
                    $each = round(($bid19[$this->village->building->getTypeLevel(19)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
                }
            }
            
            if (in_array($unit, $calvary)) {
                if ($great) {
                    $each = round(($bid30[$this->village->building->getTypeLevel(30)]['attri'] * ($this->village->building->getTypeLevel(41) >= 1 ? (1 / $bid41[$this->village->building->getTypeLevel(41)]['attri']) : 1) / 100) * ${'u' . $unit}['time'] / SPEED);
                } else {
                    $each = round(($bid20[$this->village->building->getTypeLevel(20)]['attri'] * ($this->village->building->getTypeLevel(41) >= 1 ? (1 / $bid41[$this->village->building->getTypeLevel(41)]['attri']) : 1) / 100) * ${'u' . $unit}['time'] / SPEED);
                }
            }
            
            if (in_array($unit, $workshop)) {
                if ($great) {
                    $each = round(($bid42[$this->village->building->getTypeLevel(42)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
                } else {
                    $each = round(($bid21[$this->village->building->getTypeLevel(21)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
                }
            }
            
            if (in_array($unit, $special)) {
                if ($this->village->building->getTypeLevel(25) > 0) {
                    $each = round(($bid25[$this->village->building->getTypeLevel(25)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
                } else {
                    $each = round(($bid26[$this->village->building->getTypeLevel(26)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
                }
            }
            
            if (in_array($unit, $trapper)) {             
                $each = round(($bid19[$this->village->building->getTypeLevel(36)]['attri'] / 100) * ${'u' . $unit}['time'] / SPEED);
            }
            
            if ($unit % 10 == 0 || $unit % 10 == 9 && $unit != 99) {
                $slots = $this->village->database->getAvailableExpansionTraining($this->village->session->uid, $this->village->wid);
                if ($unit % 10 == 0 && $slots['settlers'] <= $amt)
                    $amt = $slots['settlers'];
                    if ($unit % 10 == 9 && $slots['chiefs'] <= $amt) {
                        $amt = $slots['chiefs'];
                    }
            } else {
                if ($unit != 99) {
                    if ($this->maxUnit($unit, $great) < $amt) {
                        $amt = 0;
                    }
                } else {
                    $trainlist = $this->village->database->getTrainingList(8, $this->village->wid);
                    
                    foreach ($trainlist as $train) {
                        $train_amt += $train['amt'];
                    }

                    $max = 0;
                    for ($i = 19; $i < 41; $i++) {
                        if ($this->village->resarray['f' . $i . 't'] == 36) {
                            $max += $bid36[$this->village->resarray['f' . $i]]['attri'] * TRAPPER_CAPACITY;
                        }
                    }
                    
                    $max1 = $max - ($this->village->unitarray['u99'] + $train_amt);
                    if ($max1 < $amt) {
                        $amt = 0;
                    }
                }
            }
            
            $wood = ${'u' . $unit}['wood'] * $amt * ($great ? 3 : 1);
            $clay = ${'u' . $unit}['clay'] * $amt * ($great ? 3 : 1);
            $iron = ${'u' . $unit}['iron'] * $amt * ($great ? 3 : 1);
            $crop = ${'u' . $unit}['crop'] * $amt * ($great ? 3 : 1);
            
            if ($this->village->database->modifyResource($this->village->wid, $wood, $clay, $iron, $crop, 0) && $amt > 0) {
                $this->village->database->addUnitToTraining($this->village->wid, $unit + ($great ? 60 : 0), $amt, ${'u' . $unit}['pop'], $each, 0);
            }
        }
    }

    public function meetRRequirement($tech)
    {
        switch ($tech) {
            case 2:
                return $this->village->building->getTypeLevel(22) >= 1 && $this->village->building->getTypeLevel(13) >= 1;
            case 3:
                return $this->village->building->getTypeLevel(22) >= 5 && $this->village->building->getTypeLevel(12) >= 1;
            
            case 4:
            case 23:
                return $this->village->building->getTypeLevel(22) >= 5 && $this->village->building->getTypeLevel(20) >= 1;
            
            case 5:
            case 25:
                return $this->village->building->getTypeLevel(22) >= 5 && $this->village->building->getTypeLevel(20) >= 5;
            
            case 6:
                return $this->village->building->getTypeLevel(22) >= 15 && $this->village->building->getTypeLevel(20) >= 10;
            
            case 9:
            case 29:
                return $this->village->building->getTypeLevel(22) >= 20 && $this->village->building->getTypeLevel(16) >= 10;
            
            case 12:
            case 32:
            case 42:
                return $this->village->building->getTypeLevel(22) >= 1 && $this->village->building->getTypeLevel(19) >= 3;
            
            case 13:
            case 33:
            case 43:
                return $this->village->building->getTypeLevel(22) >= 3 && $this->village->building->getTypeLevel(12) >= 1;
            
            case 14:
            case 34:
            case 44:
                return $this->village->building->getTypeLevel(22) >= 1 && $this->village->building->getTypeLevel(15) >= 5;
            
            case 15:
            case 35:
            case 45:
                return $this->village->building->getTypeLevel(22) >= 1 && $this->village->building->getTypeLevel(20) >= 3;
            
            case 16:
            case 26:
            case 36:
            case 46:
                return $this->village->building->getTypeLevel(22) >= 15 && $this->village->building->getTypeLevel(20) >= 10;
            
            case 7:
            case 17:
            case 27:
            case 37:
            case 47:
                return $this->village->building->getTypeLevel(22) >= 10 && $this->village->building->getTypeLevel(21) >= 1;
            
            case 8:
            case 18:
            case 28:
            case 38:
            case 48:
                return $this->village->building->getTypeLevel(22) >= 15 && $this->village->building->getTypeLevel(21) >= 10;
            
            case 19:
            case 39:
            case 49:
                return $this->village->building->getTypeLevel(22) >= 20 && $this->village->building->getTypeLevel(16) >= 5;
            
            case 22:
                return $this->village->building->getTypeLevel(22) >= 3 && $this->village->building->getTypeLevel(12) >= 1;
            
            case 24:
                return $this->village->building->getTypeLevel(22) >= 5 && $this->village->building->getTypeLevel(20) >= 3;
        }
    }

    private function researchTech($get)
    {
        global ${'r' . $get['a']}, $bid22;
        if ($this->meetRRequirement($get['a']) && $get['c'] == $this->village->session->mchecker) {
            $data = ${'r' . $get['a']};
            $time = time() + round(($data['time'] * ($bid22[$this->village->building->getTypeLevel(22)]['attri'] / 100)) / SPEED);
            $this->village->database->modifyResource($this->village->wid, $data['wood'], $data['clay'], $data['iron'], $data['crop'], 0);
            $this->village->database->addResearch($this->village->wid, "t" . $get['a'], $time);
            //$logging->addTechLog($this->village->wid, "t" . $get['a'], 1);
        }
        
        $this->village->session->changeChecker();
        
        header("Location: build.php?id=" . $get['id']);
        exit();
    }

    // TODO: Merge these two functions in one function, they're very similar to each other
    private function upgradeSword($get)
    {
        global $bid12;
        
        $ABTech = $this->village->database->getABTech($this->village->wid);
        $ABUpgrades = $this->getABUpgrades('b');
        $ABUpgradesCount = count($ABUpgrades);
        
        $ups = 0;
        if ($ABUpgradesCount > 0) {
            foreach ($ABUpgrades as $upgrade) {
                if (in_array(("b" . $get['a']), $upgrade))
                    $ups++;
            }
        }
        
        $CurrentTech = $ABTech["b" . $get['a']] + $ups;
        $unit = ($this->village->session->tribe - 1) * 10 + intval($get['a']);
        if (($ABUpgradesCount < 2 && $this->village->session->plus || $ABUpgradesCount == 0) && ($this->getTech($unit) || ($unit % 10) == 1) && ($CurrentTech < $this->village->building->getTypeLevel(12)) && $get['c'] == $this->village->session->mchecker) {
            global ${'ab' . strval($unit)};
            $data = ${'ab' . strval($unit)};
            $time = time() + round(($data[$CurrentTech + 1]['time'] * ($bid12[$this->village->building->getTypeLevel(12)]['attri'] / 100)) / SPEED) + ($ABUpgradesCount > 0 ? ($ABUpgrades[$ABUpgradesCount - 1]['timestamp'] - time()) + ceil(60 / SPEED) : 0);
            if ($this->village->database->modifyResource($this->village->wid, $data[$CurrentTech + 1]['wood'], $data[$CurrentTech + 1]['clay'], $data[$CurrentTech + 1]['iron'], $data[$CurrentTech + 1]['crop'], 0)) {
                $this->village->database->addResearch($this->village->wid, "b" . $get['a'], $time);
                //$logging->addTechLog($this->village->wid, "b" . $get['a'], $CurrentTech + 1);
            }
        }
        
        $this->village->session->changeChecker();
        
        header("Location: build.php?id=" . $get['id']);
        exit();
    }

    private function upgradeArmour($get)
    {
        global $bid13;
        $ABTech = $this->village->database->getABTech($this->village->wid);
        $ABUpgrades = $this->getABUpgrades('a');
        $ABUpgradesCount = count($ABUpgrades);
        
        $ups = 0;
        if ($ABUpgradesCount > 0) {
            foreach ($ABUpgrades as $upgrade) {
                if (in_array(("a" . $get['a']), $upgrade))
                    $ups++;
            }
        }
        
        $CurrentTech = $ABTech["a" . $get['a']] + $ups;
        $unit = ($this->village->session->tribe - 1) * 10 + intval($get['a']);
        if (($ABUpgradesCount < 2 && $this->village->session->plus || $ABUpgradesCount == 0) && ($this->getTech($unit) || ($unit % 10) == 1) && ($CurrentTech < $this->village->building->getTypeLevel(13)) && $get['c'] == $this->village->session->mchecker) {
            global ${'ab' . strval($unit)};
            $data = ${'ab' . strval($unit)};
            $time = time() + round(($data[$CurrentTech + 1]['time'] * ($bid13[$this->village->building->getTypeLevel(13)]['attri'] / 100)) / SPEED) + ($ABUpgradesCount > 0 ? ($ABUpgrades[$ABUpgradesCount - 1]['timestamp'] - time()) + ceil(60 / SPEED) : 0);
            if ($this->village->database->modifyResource($this->village->wid, $data[$CurrentTech + 1]['wood'], $data[$CurrentTech + 1]['clay'], $data[$CurrentTech + 1]['iron'], $data[$CurrentTech + 1]['crop'], 0)) {
                $this->village->database->addResearch($this->village->wid, "a" . $get['a'], $time);
                //$logging->addTechLog($village->wid, "a" . $get['a'], $CurrentTech + 1);
            }
        }
        
        $this->village->session->changeChecker();
        
        header("Location: build.php?id=" . $get['id']);
        exit();
    }

    public function getUnitName($i)
    {
        return self::unarray[$i];
    }

    public function finishTech()
    {
        $q = "UPDATE " . TB_PREFIX . "research SET timestamp=" . (time() - 1) . " WHERE vref = " . (int) $this->village->wid;
        $result = $this->village->database->query($q);
        return mysqli_affected_rows($this->village->database->dblink);
    }

    public function calculateAvaliable($id, $resarray = [])
    {
        global ${'r' . $id};
        if (count($resarray) == 0) {
            $resarray['wood'] = ${'r' . $id}['wood'];
            $resarray['clay'] = ${'r' . $id}['clay'];
            $resarray['iron'] = ${'r' . $id}['iron'];
            $resarray['crop'] = ${'r' . $id}['crop'];
        }
        
        $rwtime = ($resarray['wood'] - $this->village->awood) / $this->village->getProd("wood") * 3600;
        $rcltime = ($resarray['clay'] - $this->village->aclay) / $this->village->getProd("clay") * 3600;
        $ritime = ($resarray['iron'] - $this->village->airon) / $this->village->getProd("iron") * 3600;
        $rctime = ($resarray['crop'] - $this->village->acrop) / $this->village->getProd("crop") * 3600;
        if ($this->village->getProd("crop") >= 0) {
            $reqtime = max($rwtime, $rcltime, $ritime, $rctime) + time();
        } else {
            $reqtime = max($rwtime, $rcltime, $ritime);
            if ($reqtime > $rctime) {
                $reqtime = 0;
            } else {
                $reqtime += time();
            }
        }
        return Generator::procMtime($reqtime);
    }

    public function checkReinf($id, $use_cache = true)
    {
        $enforce = $this->village->database->getEnforceArray($id, 0, $use_cache);
        $fail = 0;
        
        for ($i = 1; $i < 50; $i++) {
            if ($enforce['u' . $i] > 0) {
                $fail = 1;
            }
        }
        
        if ($enforce['hero'] > 0) {
            $fail = 1;
        }
            
        if ($fail == 0) {
            $this->village->database->deleteReinf($id);
        }
    }
}
