<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: yi12345 <https://github.com/martinambrus>
 * ronix <http://forum.ragezone.com/members/833088.html>
 * Advocaite <https://github.com/advocaite>
 * Shadow <https://github.com/shadowss>
 * Mr.php <https://github.com/mrphp>
 * brainiacX <https://github.com/brainiacX>
 * InCube <http://forum.ragezone.com/members/1333458070.html>
 * martinambrus <https://github.com/martinambrus>
 * iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Village;

use TravianZ\Utils\Generator;

class Building
{
    public $NewBuilding = false;  
    
    public $buildArray = [];

    private $maxConcurrent;

    private $allocated;

    private $basic;
    
    private $inner;
    
    private $village;
    
    private $plus = 0;

    public function __construct(Village $village)
    {
        $this->village = $village;
        
        $this->maxConcurrent = BASIC_MAX;
        
        if (ALLOW_ALL_TRIBE || $this->village->session->tribe == 1)
        {
            $this->maxConcurrent += INNER_MAX;
        }
        
        if ($this->village->session->plus) {
            $this->maxConcurrent += PLUS_MAX;
        }

        $this->LoadBuilding();
        foreach ($this->buildArray as $build) {
            if ($build['master'] == 1) {
                $this->maxConcurrent ++;
            }  
        }
    }

    /*
     * Checks whether to allow building Wonder of the World
     * above current level. This includes checks for WW upgrade
     * currently in progress as well as current WW level
     * and the right number of building plans in the alliance.
     */
    public function allowWwUpgrade()
    {
        static $cached = null;
        
        if ($cached === null) {
            $wwHighestLevelFound = $this->village->resarray['f99'];
            $wwBuildingProgress = $this->village->database->getBuildingByType($this->village->wid, 99);
            
            if (count($wwBuildingProgress)) {
                if ($wwBuildingProgress[0]['level'] > $wwHighestLevelFound) {
                    $wwHighestLevelFound = $wwBuildingProgress[0]['level'];
                }
            }
            
            // Get our WW construction plans
            $userHasWWConstructionPlans = $this->village->database->getWWConstructionPlans($this->village->session->uid);
            
            // Get ally WW construction plans
            $allyHasWWConstructionPlans = $this->village->session->alliance > 0 ? $this->village->database->getWWConstructionPlans($this->village->session->uid, $this->village->session->alliance) : false;
            
            // Check if we should allow building the WW this high
            if ($wwHighestLevelFound < 50) {
                $cached = $userHasWWConstructionPlans;
            } else {
                $cached = $userHasWWConstructionPlans && $allyHasWWConstructionPlans;
            }    
        }
        
        return $cached;
    }

    public function canProcess($id, $tid)
    {       
        $levels = $this->village->database->getResourceLevel($this->village->wid);
        
        // Don't allow building WW to level 51 with a waiting loop
        if (!(($tid != 99 || ($tid == 99 && $this->allowWwUpgrade()))))
            $this->redirect($tid);
        
        if (
        // Check that our ID actually exists within the buildings list
        isset($this->village->resarray['f' . $tid . 't']) && 
        // Let's see if we should allow building what we want where we want to
        // (Prevent building resource fields in the village
        (($tid >= 1 && $tid <= 18 && $id >= 1 && $id <= 4) || ($tid >= 19 && $id > 4)) && 
        // Check that we're not trying to change a standing building type
        ($levels['f' . $tid . 't'] == $id || $levels['f' . $tid . 't'] == 0) && 
        // Check that we're not trying to build in the walls id
        (($tid == 40 && in_array($id, [
            31,
            32,
            33
        ])) || $tid != 40)) {
            if (!isset($_GET['master']) && $this->checkResource($id, $tid) != 4) {
                $this->redirect($tid);
            }
            
            // Check if the building will be built with the master builder
            if (isset($_GET['master'])) {
                // If so, we have to check if it'll be built or upgraded
                if ($levels['f' . $tid . 't'] == 0) {
                    // The building will be built, we have to check if we can build it
                    if (!$this->meetRequirement($id))
                        $this->redirect($tid);
                } else {
                    // The building will be upgraded, we have to check if we can upgrade it
                    if ($this->isMax($id, $tid, $this->isLoop($tid) + $this->isCurrent($tid))) {
                        $this->redirect($tid);
                    }
                }
            }
        } else {
            header('Location: ' . $_SERVER['SCRIPT_NAME']);
            exit();
        }
    }

    /**
     * Redirects to dorf1.php if we're building/upgrading resource fields otherwise in dorf2.php
     *
     * @param int $tid
     *            the id where the building is built/upgraded
     */
    private function redirect($tid)
    {
        if ($tid >= 19)
            header("Location: dorf2.php");
        else
            header("Location: dorf1.php");
        exit();
    }

    public function procBuild($get)
    {       
        if (isset($get['a']) && $get['c'] == $this->village->session->checker && !isset($get['id'])) {
            if ($get['a'] == 0)
                $this->removeBuilding($get['d']);
            else {
                $this->village->session->changeChecker();
                $this->canProcess($this->village->resarray['f' . $get['a'] . 't'], $get['a']);
                $this->upgradeBuilding($get['a']);
            }
        } elseif (isset($get['master']) && isset($get['id']) && $this->village->session->gold >= 1 && $this->village->session->goldclub && $this->village->master == 0 && (isset($get['c']) && $get['c'] == $this->village->session->checker)) {
            $this->canProcess($get['master'], $get['id']);
            $this->village->session->changeChecker();
            $level = $this->village->database->getResourceLevel($this->village->wid);
            $time = $this->resourceRequired($get['id'], $get['master'])['time'];
            $this->village->database->addBuilding($this->village->wid, $get['id'], $get['master'], 1, $time, 1, $level['f' . $get['id']] + 1 + count($this->village->database->getBuildingByField($this->village->wid, $get['id'])));
            $this->redirect($get['id']);
        } elseif (isset($get['a']) && $get['c'] == $this->village->session->checker && isset($get['id'])) {
            if ($get['id'] > 18 && ($get['id'] < 41 || $get['id'] == 99)) {
                $this->village->session->changeChecker();
                $this->canProcess($get['a'], $get['id']);
                $this->constructBuilding($get['id'], $get['a']);
            }
        } elseif (isset($get['buildingFinish']) && $this->village->session->gold >= 2 && $this->village->session->sit == 0)
            $this->finishAll();
    }

    public function canBuild($id, $tid)
    {       
        $demolition = $this->village->database->getDemolition($this->village->wid);
        if ((isset($demolition[0])) && $demolition[0]['buildnumber'] == $id)
            return 11;
        
        if ($this->isMax($tid, $id))
            return 1;
        else if ($this->isMax($tid, $id, 1) && ($this->isLoop($id) || $this->isCurrent($id)))
            return 10;
        else if ($this->isMax($tid, $id, 2) && $this->isLoop($id) && $this->isCurrent($id))
            return 10;
        else if ($this->isMax($tid, $id, 3) && $this->isLoop($id) && $this->isCurrent($id) && count($this->village->database->getMasterJobs($this->village->wid)) > 0) {
            return 10;
        } else {
            if ($this->allocated <= $this->maxConcurrent) {
                $resRequired = $this->resourceRequired($id, $this->village->resarray['f' . $id . 't']);
                $resRequiredPop = $resRequired['pop'];
                if (empty($resRequiredPop)) {
                    $buildarray = $GLOBALS["bid" . $tid];
                    $resRequiredPop = $buildarray[1]['pop'];
                }
                $jobs = $this->village->database->getJobs($this->village->wid);
                if ($jobs > 0) {
                    $soonPop = 0;
                    foreach ($jobs as $j) {
                        $buildarray = $GLOBALS["bid" . $j['type']];
                        $soonPop += $buildarray[$this->village->database->getFieldLevel($this->village->wid, $j['field']) + 1]['pop'];
                    }
                }
                if (($this->village->allcrop - $this->village->pop - $soonPop - $resRequiredPop) <= 1 && $this->village->resarray['f' . $id . 't'] != 4) {
                    return 4;
                } else {
                    switch ($this->checkResource($tid, $id)) {
                        case 1:
                            return 5;
                        case 2:
                            return 6;
                        case 3:
                            return 7;
                        case 4:
                            if ($id >= 19) {
                                if ($this->village->session->tribe == 1 || ALLOW_ALL_TRIBE) {
                                    if ($this->inner == 0)
                                        return 8;
                                    else {
                                        if ($this->village->session->plus || $tid == 40) {
                                            if ($this->plus == 0)
                                                return 9;
                                            else
                                                return 3;
                                        } else
                                            return 2;
                                    }
                                } else {
                                    if ($this->basic == 0)
                                        return 8;
                                    else {
                                        if ($this->village->session->plus || $tid == 40) {
                                            if ($this->plus == 0)
                                                return 9;
                                            else
                                                return 3;
                                        } else
                                            return 2;
                                    }
                                }
                            } else {
                                if ($this->basic == 1) {
                                    if (($this->village->session->plus || $tid == 40) && $this->plus == 0)
                                        return 9;
                                    else
                                        return 3;
                                } else
                                    return 8;
                            }
                    }
                }
            } else
                return 2;
        }
    }

    function addDemolition($wid, $field)
    {
        // check if we're not demolishing an Embassy if the player is in an alliance
        if ($this->village->database->getFieldType($wid, $field) == 18 && $this->village->session->alliance) {
            
            // get field level, alliance members count and the minimum
            // level of Embassy to be able to hold this number of people
            $fLevel = $this->village->database->getFieldLevel($wid, $field);
            $membersCount = $this->village->database->countAllianceMembers($this->village->session->alliance);
            $minEmbassyLevel = $this->village->database->getMinEmbassyLevel($membersCount);
            $isOwner = $this->village->database->isAllianceOwner($this->village->session->uid) == $this->village->session->alliance;
            
            // make sure minimum Embassy level is 3 of the player is alliance owner
            if ($isOwner && $minEmbassyLevel < 3) {
                $minEmbassyLevel = 3;
            }
            
            // check if this user is the founder of the alliance
            // and whether we're not trying to demolish under the lowest level
            // which can hold current number of members
            if ($fLevel == $minEmbassyLevel && $this->village->session->alliance && $isOwner) {
                // check if we have any other players in this alliance left
                if ($membersCount > 1) {
                    // check if this player has only 1 last Embassy on a sufficient level
                    if ($this->village->database->getSingleFieldTypeCount($this->village->session->uid, 18, '>=', $minEmbassyLevel) == 1) {
                        // cannot demolish Embassy further until the player quits the alliance,
                        // as they are founder and there are still other players in the alliance,
                        // thus destroying Embassy would evict this player from the alliance
                        // and leave a new random leader
                        return 18;
                    }
                }
            }
        }
        
        $q = "DELETE FROM " . TB_PREFIX . "bdata WHERE field=$field AND wid=$wid";
        $this->village->database->query($q);
        $uprequire = $this->resourceRequired($field, $this->village->resarray['f' . $field . 't'], 0);
        $q = "INSERT INTO " . TB_PREFIX . "demolition VALUES (" . $wid . "," . $field . "," . ($fLevel - 1) . "," . (time() + floor($uprequire['time'] / 2)) . ")";
        $this->village->database->query($q);
        
        return true;
    }
    
    public function walling()
    {
        $wall = [31, 32, 33];
        foreach ($this->buildArray as $job) {
            if (in_array($job['type'], $wall))
                return "3" . $this->village->session->tribe;
        }
        return false;
    }

    public function rallying()
    {
        foreach ($this->buildArray as $job) {
            if ($job['type'] == 16)
                return true;
        }
        return false;
    }

    public static function procResType($ref)
    {
        switch ($ref) {
            case 1:
                return "Woodcutter";
            case 2:
                return "Clay Pit";
            case 3:
                return "Iron Mine";
            case 4:
                return "Cropland";
            case 5:
                return "Sawmill";
            case 6:
                return "Brickyard";
            case 7:
                return "Iron Foundry";
            case 8:
                return "Grain Mill";
            case 9:
                return "Bakery";
            case 10:
                return "Warehouse";
            case 11:
                return "Granary";
            case 12:
                return "Blacksmith";
            case 13:
                return "Armoury";
            case 14:
                return "Tournament Square";
            case 15:
                return "Main Building";
            case 16:
                return "Rally Point";
            case 17:
                return "Marketplace";
            case 18:
                return "Embassy";
            case 19:
                return "Barracks";
            case 20:
                return "Stable";
            case 21:
                return "Workshop";
            case 22:
                return "Academy";
            case 23:
                return "Cranny";
            case 24:
                return "Town Hall";
            case 25:
                return "Residence";
            case 26:
                return "Palace";
            case 27:
                return "Treasury";
            case 28:
                return "Trade Office";
            case 29:
                return "Great Barracks";
            case 30:
                return "Great Stable";
            case 31:
                return "City Wall";
            case 32:
                return "Earth Wall";
            case 33:
                return "Palisade";
            case 34:
                return "Stonemason's Lodge";
            case 35:
                return "Brewery";
            case 36:
                return "Trapper";
            case 37:
                return "Hero's Mansion";
            case 38:
                return "Great Warehouse";
            case 39:
                return "Great Granary";
            case 40:
                return "Wonder of the World";
            case 41:
                return "Horse Drinking Trough";
            case 42:
                return "Great Workshop";
            default:
                return "Error";
        }
    }

    public function loadBuilding()
    {
        $this->buildArray = $this->village->database->getJobs($this->village->wid);
        $this->allocated = count($this->buildArray);
        if ($this->allocated > 0) {
            foreach ($this->buildArray as $build) {
                if ($build['loopcon'] == 1) {
                    $this->plus = 1;
                } else {
                    if ($build['field'] <= 18) {
                        $this->basic ++;
                    } else {
                        if ($this->village->session->tribe == 1 || ALLOW_ALL_TRIBE) {
                            $this->inner ++;
                        } else {
                            $this->basic ++;
                        }
                    }
                }
            }
            $this->NewBuilding = true;
        } else {
            $this->NewBuilding = false;
        }
    }

    private function removeBuilding($d)
    {
        foreach ($this->buildArray as $jobs) {
            if ($jobs['id'] == $d) {
                $uprequire = $this->resourceRequired($jobs['field'], $jobs['type']);
                if ($this->village->database->removeBuilding($d, $this->village->session->tribe, $this->village->wid, $this->village->resarray)) {
                    if ($jobs['master'] == 0)
                        $this->village->database->modifyResource($this->village->wid, $uprequire['wood'], $uprequire['clay'], $uprequire['iron'], $uprequire['crop'], 1);
                    $this->redirect($jobs['field']);
                }
            }
        }
    }

    private function upgradeBuilding($id)
    {
        global ${'bid' . $this->village->resarray['f' . $id . 't']};
        
        if ($this->allocated < $this->maxConcurrent) {
            $uprequire = $this->resourceRequired($id, $this->village->resarray['f' . $id . 't']);
            $time = time() + $uprequire['time'];
            $bindicate = $this->canBuild($id, $this->village->resarray['f' . $id . 't']);
            
            // don't allow building above max levels and don't allow building if it's in demolition
            if (in_array($bindicate, [
                1,
                2,
                3,
                10,
                11
            ])) {
                header("Location: dorf2.php");
                exit();
            }
            
            $loop = ($bindicate == 9 ? 1 : 0);
            $loopsame = 0;
            if ($loop == 1) {
                foreach ($this->buildArray as $build) {
                    if ($build['field'] == $id) {
                        $loopsame ++;
                        $uprequire = $this->resourceRequired($id, $this->village->resarray['f' . $id . 't'], ($loopsame > 0 ? 2 : 1));
                    }
                }
                if ($this->village->session->tribe == 1 || ALLOW_ALL_TRIBE) {
                    if ($id >= 19) {
                        foreach ($this->buildArray as $build) {
                            if ($build['field'] >= 19) {
                                $time = $build['timestamp'] + $uprequire['time'];
                            }
                        }
                    } else {
                        foreach ($this->buildArray as $build) {
                            if ($build['field'] <= 18) {
                                $time = $build['timestamp'] + $uprequire['time'];
                            }
                        }
                    }
                } else {
                    $time = $this->buildArray[0]['timestamp'] + $uprequire['time'];
                }
            }
            $level = $this->village->database->getResourceLevel($this->village->wid);
            
            if ($this->village->database->addBuilding($this->village->wid, $id, $this->village->resarray['f' . $id . 't'], $loop, $time + ($loop == 1 ? ceil(60 / SPEED) : 0), 0, $level['f' . $id] + 1 + count($this->village->database->getBuildingByField($this->village->wid, $id)))) {
                $this->village->database->modifyResource($this->village->wid, $uprequire['wood'], $uprequire['clay'], $uprequire['iron'], $uprequire['crop'], 0);
                //$logging->addBuildLog($this->village->wid, self::procResType($this->village->resarray['f' . $id . 't']), ($this->village->resarray['f' . $id] + ($loopsame > 0 ? 2 : 1)), 0);
                $this->redirect($id);
            }
        }
    }

    private function downgradeBuilding($id)
    {        
        if ($this->allocated < $this->maxConcurrent) {
            $name = "bid" . $this->village->resarray['f' . $id . 't'];
            global $$name;
            $dataarray = $$name;
            $time = time() + round($dataarray[$this->village->resarray['f' . $id] - 1]['time'] / 4);
            $loop = 0;
            if ($this->inner == 1 || $this->basic == 1) {
                if (($this->village->session->plus || $this->village->resarray['f' . $id . 't'] == 40) && $this->plus == 0) {
                    $loop = 1;
                }
            }
            if ($loop == 1) {
                if ($this->village->session->tribe == 1 || ALLOW_ALL_TRIBE) {
                    if ($id >= 19) {
                        foreach ($this->buildArray as $build) {
                            if ($build['field'] >= 19) {
                                $time = $build['timestamp'] + round($dataarray[$this->village->resarray['f' . $id] - 1]['time'] / 4);
                            }
                        }
                    }
                } else {
                    $time = $this->buildArray[0]['timestamp'] + round($dataarray[$this->village->resarray['f' . $id] - 1]['time'] / 4);
                }
            }
            
            $level = $this->village->database->getResourceLevel($this->village->wid);
            if ($this->village->database->addBuilding($this->village->wid, $id, $this->village->resarray['f' . $id . 't'], $loop, $time, 0, 0, $level['f' . $id] + 1 + count($this->village->database->getBuildingByField($this->village->wid, $id)))) {
                //$logging->addBuildLog($this->village->wid, self::procResType($this->village->resarray['f' . $id . 't']), ($this->village->resarray['f' . $id] - 1), 2);
                header("Location: dorf2.php");
                exit();
            }
        }
    }

    private function constructBuilding($id, $tid)
    {        
        if ($this->allocated < $this->maxConcurrent) {
            if ($tid == 16) {
                $id = 39;
            } elseif ($tid == 31 || $tid == 32 || $tid == 33) {
                $id = 40;
            }

            $uprequire = $this->resourceRequired($id, $tid);
            $time = time() + $uprequire['time'];
            $bindicate = $this->canBuild($id, $tid);
            $loop = ($bindicate == 9 ? 1 : 0);
            
            if ($loop == 1) {
                foreach ($this->buildArray as $build) {
                    if ($build['field'] >= 19 || ($this->village->session->tribe != 1 && !ALLOW_ALL_TRIBE)) {
                        $time = $build['timestamp'] + ceil(60 / SPEED) + $uprequire['time'];
                    }
                }
            }
            
            if ($this->meetRequirement($tid)) {
                $level = $this->village->database->getResourceLevel($this->village->wid);
                if ($this->village->database->addBuilding($this->village->wid, $id, $tid, $loop, $time, 0, $level['f' . $id] + 1 + count($this->village->database->getBuildingByField($this->village->wid, $id)))) {
                    $logging->addBuildLog($this->village->wid, self::procResType($tid), ($this->village->resarray['f' . $id] + 1), 1);
                    $this->village->database->modifyResource($this->village->wid, $uprequire['wood'], $uprequire['clay'], $uprequire['iron'], $uprequire['crop'], 0);
                    header("Location: dorf2.php");
                    exit();
                }
            } else {
                header("location: dorf2.php");
                exit();
            }
        } else {
            header("Location: dorf2.php");
            exit();
        }
    }

    /**
     * Search through all user's villages if the castle is built or not
     *
     * @return boolean Returns true if the castle is already built in the whole account, otherwise returns false
     */
    public function isCastleBuilt()
    {        
        $this->villages = $this->village->database->getProfileVillages($this->village->session->uid);
        foreach ($this->villages as $vil) {
            if (in_array(26, $this->village->database->getResourceLevel($vil['wref'])))
                return true;
        }
        return false;
    }

    private function meetRequirement($id)
    {        
        $isBuilt = $this->getTypeField($id);
        
        switch ($id) {
            case 1:
            case 2:
            case 3:
            case 4:
                return true;
            
            case 5:
                return $this->getTypeLevel(1) >= 10 && $this->getTypeLevel(15) >= 5 && !$isBuilt;
            case 6:
                return $this->getTypeLevel(2) >= 10 && $this->getTypeLevel(15) >= 5 && !$isBuilt;
            case 7:
                return $this->getTypeLevel(3) >= 10 && $this->getTypeLevel(15) >= 5 && !$isBuilt;
            case 8:
                return $this->getTypeLevel(4) >= 5 && !$isBuilt;
            case 9:
                return $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(4) >= 10 && $this->getTypeLevel(8) >= 5 && !$isBuilt;
            
            case 10:
            case 11:
                return $this->getTypeLevel(15) >= 1 && (!$isBuilt || $this->getTypeLevel($id) == 20);
            
            case 12:
                return $this->getTypeLevel(22) >= 3 && $this->getTypeLevel(15) >= 3 && !$isBuilt;
            case 13:
                return $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(22) >= 1 && !$isBuilt;
            case 14:
                return $this->getTypeLevel(16) >= 15 && !$isBuilt;
            
            case 15:
            case 16:
                return !$isBuilt;
            
            case 17:
                return $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(10) >= 1 && $this->getTypeLevel(11) >= 1 && !$isBuilt;
            case 18:
                return $this->getTypeLevel(15) >= 1 && !$isBuilt;
            case 19:
                return $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1 && !$isBuilt;
            case 20:
                return $this->getTypeLevel(12) >= 3 && $this->getTypeLevel(22) >= 5 && !$isBuilt;
            case 21:
                return $this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15) >= 5 && !$isBuilt;
            case 22:
                return $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(19) >= 3 && !$isBuilt;
            case 23:
                return !$isBuilt || $this->getTypeLevel($id) == 10;
            case 24:
                return $this->getTypeLevel(22) >= 10 && $this->getTypeLevel(15) >= 10 && !$isBuilt;
            case 25:
                return $this->getTypeLevel(15) >= 5 && !$isBuilt && !$this->getTypeField(26);
            case 26:
                return $this->getTypeLevel(18) >= 1 && $this->getTypeLevel(15) >= 5 && !$isBuilt && !$this->isCastleBuilt() && !$this->getTypeField(25);
            case 27:
                return $this->getTypeLevel(15) >= 10 && !$isBuilt;
            case 28:
                return $this->getTypeLevel(17) == 20 && $this->getTypeLevel(20) >= 10 && !$isBuilt;
            case 29:
                return $this->getTypeLevel(19) == 20 && $this->village->capital == 0 && !$isBuilt;
            case 30:
                return $this->getTypeLevel(20) == 20 && $this->village->capital == 0 && !$isBuilt;
            case 31:
                return $this->village->session->tribe == 1;
            case 32:
                return $this->village->session->tribe == 2;
            case 33:
                return $this->village->session->tribe == 3;
            case 34:
                return $this->getTypeLevel(26) >= 3 && $this->getTypeLevel(15) >= 5 && $this->getTypeLevel(25) == 0 && $this->village->capital != 0 && !$isBuilt;
            case 35:
                return $this->getTypeLevel(16) >= 10 && $this->getTypeLevel(11) == 20 && $this->village->session->tribe == 2 && $this->village->capital != 0 && !$isBuilt;
            case 36:
                return $this->getTypeLevel(16) >= 1 && $this->village->session->tribe == 3 && (!$isBuilt || $this->getTypeLevel($id) == 20);
            case 37:
                return $this->getTypeLevel(15) >= 3 && $this->getTypeLevel(16) >= 1 && !$isBuilt;
            
            // great warehouse can only be built with artefact or in Natar villages
            case 38:
                return $this->getTypeLevel(15) >= 10 && (!$isBuilt || $this->getTypeLevel($id) == 20) && ($this->village->natar == 1 || count($this->village->database->getOwnUniqueArtefactInfo2($this->village->wid, 6, 1, 0)) || count($this->village->database->getOwnUniqueArtefactInfo2($this->village->session->uid, 6, 2, 0)));
            
            // great granary can only be built with artefact or in Natar villages
            case 39:
                return $this->getTypeLevel(15) >= 10 && (!$isBuilt || $this->getTypeLevel($id) == 20) && ($this->village->natar == 1 || count($this->village->database->getOwnUniqueArtefactInfo2($this->village->wid, 6, 1, 0)) || count($this->village->database->getOwnUniqueArtefactInfo2($this->village->session->uid, 6, 2, 0)));
            
            case 40:
                return $this->allowWwUpgrade();
            case 41:
                return $this->getTypeLevel(16) >= 10 && $this->getTypeLevel(20) == 20 && $this->village->session->tribe == 1 && !$isBuilt;
            case 42:
                return GREAT_WKS && $this->getTypeLevel(21) == 20 && $this->village->capital == 0 && !$isBuilt;
            default:
                return false;
        }
    }

    private function checkResource($tid, $id)
    {
        $name = "bid" . $tid;
        global $$name;
        
        $plus = 1;
        foreach ($this->buildArray as $job) {
            if ($job['type'] == $tid && $job['field'] == $id) {
                $plus = 2;
                break;
            }
        }
        
        $dataarray = $$name;
        $wood = $dataarray[$this->village->resarray['f' . $id] + $plus]['wood'];
        $clay = $dataarray[$this->village->resarray['f' . $id] + $plus]['clay'];
        $iron = $dataarray[$this->village->resarray['f' . $id] + $plus]['iron'];
        $crop = $dataarray[$this->village->resarray['f' . $id] + $plus]['crop'];
        
        if ($wood > $this->village->maxstore || $clay > $this->village->maxstore || $iron > $this->village->maxstore)
            return 1;
        else {
            if ($crop > $this->village->maxcrop)
                return 2;
            else {
                if ($wood > $this->village->awood || $clay > $this->village->aclay || $iron > $this->village->airon || $crop > $this->village->acrop) {
                    return 3;
                } else {
                    if ($this->village->awood >= $wood && $this->village->aclay >= $clay && $this->village->airon >= $iron && $this->village->acrop >= $crop) {
                        return 4;
                    } else
                        return 3;
                }
            }
        }
    }

    public function isMax($id, $field, $loop = 0)
    {
        $name = "bid" . $id;
        global $$name;
        $dataarray = $$name;
        
        // special case for Multihunter login which mathematically (because of the resarray length)
        // allows for building resource fields above level 20
        if ($this->village->session->tribe == 0)
            return $this->village->resarray['f' . $field] == 20;
        
        if ($id <= 4) {
            if ($this->village->capital == 1)
                return ($this->village->resarray['f' . $field] == (count($dataarray) - 1 - $loop));
            else
                return ($this->village->resarray['f' . $field] == (count($dataarray) - 11 - $loop));
        } else
            return ($this->village->resarray['f' . $field] == count($dataarray) - $loop);
    }

    public function getTypeLevel($tid, $vid = 0)
    {        
        // Support would not have a village, so this is irrelevant
        if ($this->village->session->uid == 1) {
            return 0;
        }

        $keyholder = [];
        
        if ($vid == 0) {
            $resourcearray = $this->village->resarray;
        } else {
            $resourcearray = $this->village->database->getResourceLevel($vid);
        }
            
        
        foreach (array_keys($resourcearray, $tid) as $key) {
            if (strpos($key, 't')) {
                $key = preg_replace("/[^0-9]/", '', $key);
                array_push($keyholder, $key);
            }
        }
        
        $element = count($keyholder);
        
        // if we count more than 1 instance of the building (mostly resource fields)
        if ($element >= 2) {
            // resource field
            if ($tid <= 4) {
                $temparray = [];
                
                for ($i = 0; $i <= $element - 1; $i ++) {
                    // collect current field level
                    array_push($temparray, $resourcearray['f' . $keyholder[$i]]);
                }
                
                // find out the maximum field level for this village
                $maValue = max($temparray);
                foreach ($temparray as $key => $val) {
                    if ($val == $maValue) {
                        $target = $key;
                    }
                }
            } else { // village building
                $target = 0;
                
                // find the highest level built for this building type
                for ($i = 1; $i <= $element - 1; $i ++) {
                    if ($resourcearray['f' . $keyholder[$i]] > $resourcearray['f' . $keyholder[$target]]) {
                        $target = $i;
                    }
                }
            }
        }        
        // if we count only a single building
        else if ($element == 1) {
            $target = 0;
        } else {
            return 0; // no building matching search criteria
        }
                    
        if (!empty($keyholder[$target])) {
            return $resourcearray['f' . $keyholder[$target]];
        } else {
            return 0;
        }   
    }

    public function isCurrent($id)
    {
        foreach ($this->buildArray as $build) {
            if ($build['field'] == $id && $build['loopcon'] != 1) {
                return true;
            }
        }
    }

    public function isLoop($id = 0)
    {
        foreach ($this->buildArray as $build) {
            if (($build['field'] == $id && $build['loopcon']) || ($build['loopcon'] == 1 && $id == 0)) {
                return true;
            }
        }
        return false;
    }

    public function finishAll($redirect_url = "")
    {
        global $bid18, $bid10, $bid11;
        
        // will be true if we should decrease player's gold by 2
        // for the immediate completion action
        $countPlus2Gold = false;
        // will be true if we should decrease player's gold by 1
        // for master builder queue
        $countMasterGold = false;
        // number of jobs to finish
        $buildcount = ($this->buildArray ? count($this->buildArray) : 0);
        // will be true if the job was successfully finished
        $jobFinishSuccess = false;
        // IDs of successful jobs to delete
        $deletIDs = [];
        
        foreach ($this->buildArray as $jobs) {
            if ($jobs['wid'] == $this->village->wid) {
                $wwvillage = $this->village->database->getResourceLevel($jobs['wid']);
                if ($wwvillage['f99t'] != 40) {
                    $level = $jobs['level'];
                    if ($jobs['type'] != 25 && $jobs['type'] != 26 && $jobs['type'] != 40) {
                        $resource = $this->resourceRequired($jobs['field'], $jobs['type']);
                        // master builder involved
                        if ($jobs['master'] != 0) {
                            if ($this->meetRequirement($jobs['field'])) {
                                // don't allow master builder to build anything
                                // if we only have 2 gold, since that would take us to -1 gold
                                if ($this->village->session->gold > 2) {
                                    $villwood = $this->village->database->getVillageField($jobs['wid'], 'wood');
                                    $villclay = $this->village->database->getVillageField($jobs['wid'], 'clay');
                                    $villiron = $this->village->database->getVillageField($jobs['wid'], 'iron');
                                    $villcrop = $this->village->database->getVillageField($jobs['wid'], 'crop');
                                    $type = $jobs['type'];
                                    $buildarray = $GLOBALS["bid" . $type];
                                    $buildwood = $buildarray[$level]['wood'];
                                    $buildclay = $buildarray[$level]['clay'];
                                    $buildiron = $buildarray[$level]['iron'];
                                    $buildcrop = $buildarray[$level]['crop'];
                                    if ($buildwood < $villwood && $buildclay < $villclay && $buildiron < $villiron && $buildcrop < $villcrop) {
                                        $jobFinishSuccess = true;
                                        $countMasterGold = true;
                                        $enought_res = 1;
                                        // we need to subtract resources for this, if another 2 jobs are active,
                                        // as we'd never subtract those otherwise
                                        if ($buildcount > 2) {
                                            $this->village->database->setVillageField($jobs['wid'], [
                                                'wood',
                                                'clay',
                                                'iron',
                                                'crop'
                                            ], [
                                                ($villwood - $buildwood),
                                                ($villclay - $buildclay),
                                                ($villiron - $buildiron),
                                                ($villcrop - $buildcrop)
                                            ]);
                                        }
                                    }
                                } else {
                                    // if we only have 2 gold, we need to cancel this job, as there will never
                                    // be enough gold now in our account to finish this up
                                    $exclude_master = true;
                                    $deletIDs[] = (int) $jobs['id'];
                                }
                            }
                        } else {
                            // non-master builder build, we should count +2 gold for it
                            $countPlus2Gold = true;
                            $jobFinishSuccess = true;
                        }
                        
                        // update build level in the database
                        if ($jobFinishSuccess) {
                            $q = "UPDATE " . TB_PREFIX . "fdata set f" . $jobs['field'] . " = " . $jobs['level'] . ", f" . $jobs['field'] . "t = " . $jobs['type'] . " where vref = " . $jobs['wid'];
                        }
                        
                        if (!isset($exclude_master) && $this->village->database->query($q) && ($enought_res == 1 || $jobs['master'] == 0)) {
                            $this->village->database->modifyPop($jobs['wid'], $resource['pop'], 0);
                            $this->village->database->addCP($jobs['wid'], $resource['cp']);
                            $deletIDs[] = (int) $jobs['id'];
                            if ($jobs['type'] == 18) {
                                $owner = $this->village->database->getVillageField($jobs['wid'], "owner");
                                $max = $bid18[$level]['attri'];
                                $q = "UPDATE " . TB_PREFIX . "alidata set max = $max where leader = $owner";
                                $this->village->database->query($q);
                            }
                        }
                        
                        if (($jobs['field'] >= 19 && ($this->village->session->tribe == 1 || ALLOW_ALL_TRIBE)) || (!ALLOW_ALL_TRIBE && $this->village->session->tribe != 1)) {
                            $innertimestamp = $jobs['timestamp'];
                        }
                    }
                }
            }
            
            // reset the flag for the next job
            $jobFinishSuccess = false;
        }
        
        if (count($deletIDs)) {
            $this->village->database->query("DELETE FROM " . TB_PREFIX . "bdata WHERE id IN(" . implode(', ', $deletIDs) . ")");
        }
        
        $demolition = $this->village->database->finishDemolition($this->village->wid);
        $tech = $this->village->technology->finishTech();
        if ($demolition > 0 || $tech > 0) {
            $countPlus2Gold = true;
            $logging->goldFinLog($this->village->wid);
        }
        
        // deduct the right amount of gold
        if ($countMasterGold || $countPlus2Gold) {
            $newgold = $this->village->session->gold - (($countMasterGold && $countPlus2Gold) ? 3 : 2);
            $this->village->database->updateUserField($this->village->session->uid, "gold", $newgold, 1);
        }
        
        $stillbuildingarray = $this->village->database->getJobs($this->village->wid);
        if (count($stillbuildingarray) == 1) {
            if ($stillbuildingarray[0]['loopcon'] == 1) {
                // $q = "UPDATE ".TB_PREFIX."bdata SET loopcon=0,timestamp=".(time()+$stillbuildingarray[0]['timestamp']-$innertimestamp)." WHERE id=".$stillbuildingarray[0]['id'];
                $q = "UPDATE " . TB_PREFIX . "bdata SET loopcon=0 WHERE id=" . (int) $stillbuildingarray[0]['id'];
                $this->village->database->query($q);
            }
        }
        
        header("Location: " . ($redirect_url ? $redirect_url : $this->village->session->referrer));
        exit();
    }

    public function resourceRequired($id, $tid, $plus = 1)
    {
        $name = "bid" . $tid;
        global $$name, $bid15;
        
        $dataarray = $$name;
        $wood = $dataarray[$this->village->resarray['f' . $id] + $plus]['wood'];
        $clay = $dataarray[$this->village->resarray['f' . $id] + $plus]['clay'];
        $iron = $dataarray[$this->village->resarray['f' . $id] + $plus]['iron'];
        $crop = $dataarray[$this->village->resarray['f' . $id] + $plus]['crop'];
        $pop = $dataarray[$this->village->resarray['f' . $id] + $plus]['pop'];
        $time = $this->village->database->getBuildingTime($id, $tid, $plus, $this->village->wid, $this->village->resarray);
        $cp = $dataarray[$this->village->resarray['f' . $id] + $plus]['cp'];
        
        return [
            "wood" => $wood,
            "clay" => $clay,
            "iron" => $iron,
            "crop" => $crop,
            "pop" => $pop,
            "time" => $time,
            "cp" => $cp
        ];
    }

    public function getTypeField($type)
    {       
        for ($i = 19; $i <= 40; $i ++) {
            if ($this->village->resarray['f' . $i . 't'] == $type) {
                return $i;
            }
        }
    }

    public function calculateAvaliable($id, $tid, $plus = 1)
    {        
        $uprequire = $this->resourceRequired($id, $tid, $plus);
        
        $rwood = $uprequire['wood'] - $this->village->awood;
        $rclay = $uprequire['clay'] - $this->village->aclay;
        $rcrop = $uprequire['crop'] - $this->village->acrop;
        $riron = $uprequire['iron'] - $this->village->airon;
        
        $rwtime = $rwood / $this->village->getProd("wood") * 3600;
        $rcltime = $rclay / $this->village->getProd("clay") * 3600;
        $rctime = $rcrop / $this->village->getProd("crop") * 3600;
        $ritime = $riron / $this->village->getProd("iron") * 3600;
        
        $reqtime = max($rwtime, $rctime, $rcltime, $ritime);
        $reqtime += time();
        
        return Generator::procMtime($reqtime);
    }
}
