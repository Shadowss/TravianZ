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

use TravianZ\Error\Form;
use TravianZ\Utils\Generator;

class Units
{

    public $sending;

    public $recieving;

    public $return = [];

    private $village;
    
    private $form;

    public function __construct(Village $village, Form $form)
    {
        $this->village = $village;
        $this->form = $form;
    }

    public function procUnits($post)
    {
        if (isset($post['c'])) {
            if (!isset($post['disabled'])) {
                $post['disabled'] = '';
            }
            
            switch ($post['c']) {
                case 1:
                    if (isset($post['a']) && $post['a'] == 533374) {
                        $this->sendTroops($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                
                case 2:
                    if (isset($post['a']) && $post['a'] == 533374 && empty($post['disabled'])) {
                        $this->sendTroops($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                
                case 3:
                    if (isset($post['a']) && $post['a'] == 533374 && empty($post['disabled'])) {
                        $this->sendTroops($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                
                case 4:
                    if (isset($post['a']) && $post['a'] == 533374) {
                        $this->sendTroops($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                
                case 5:
                    if (isset($post['a']) && $post['a'] == "new") {
                        $this->Settlers($post);
                    } else {
                        $post = $this->loadUnits($post);
                        return $post;
                    }
                    break;
                
                case 8:
                    $this->sendTroopsBack($post);
                    break;
            }
        }
    }

    private function loadUnits($post)
    {
        if (!empty($error = $this->checkErrors($post))) {
            $this->form->addError("error", $error);
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $_POST;
            
            header("Location: a2b.php");
            exit();
        } else
            return $post;
    }

    /**
     * Gets an error if the user did a mistake
     *
     * @param array $post
     *            The array containing all of the needed informations
     * @return string Returns the errors, or empty if no errors was found
     */
    public function checkErrors(&$post)
    {
        // Search by town name
        // Coordinates and look confirm name people
        if (isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") {
            $vid = $this->village->database->getVilWref($post['x'], $post['y']);
            unset($post['dname'], $post['dname']);
        } else if (isset($post['dname']) && !empty($post['dname']))
            $vid = $this->village->database->getVillageByName(stripslashes($post['dname']));
        
        if (!empty($vid)) {
            if ($isOasis = $this->village->database->isVillageOases($vid)) {
                $too = $this->village->database->getOasisField($vid, "conqured");
                if ($too == 0)
                    $disabled = $disabledr = "disabled=disabled";
                else {
                    $disabledr = "";
                    if ($this->village->session->sit == 0)
                        $disabled = "";
                    else
                        $disabled = "disabled=disabled";
                }
            } else {
                $too = $this->village->database->getVillage($vid);
                if ($too['owner'] == 3) {
                    $disabledr = "disabled=disabled";
                    $disabled = "";
                } else {
                    $disabledr = "";
                    if ($this->village->session->sit == 0)
                        $disabled = "";
                    else
                        $disabled = "disabled=disabled";
                }
            }
        } else {
            $disabledr = "";
            if ($this->village->session->sit == 0)
                $disabled = "";
            else
                $disabled = "disabled=disabled";
        }
        
        if (!empty($disabledr) && $post['c'] == 2)
            return "You can't reinforce this village/oasis";
        if (!empty($disabled) && $post['c'] == 3)
            return "You can't attack this village/oasis with normal attack";
        if ($post['c'] < 2 || $post['c'] > 4)
            return "Invalid attack type.";
        
        // check if at least one troops has been selected
        for ($i = 1; $i <= 11; $i ++)
            $selectedTroops += empty($post['t' . $i]) ? 0 : $post['t' . $i];
        if ($selectedTroops == 0)
            return "You need to select min. one troop";
        
        if (!empty($post['dname']) && $post['x'] != "" && $post['y'] != "")
            return "Insert name or coordinates";
        
        if (isset($post['dname']) && !empty($post['dname'])) {
            $id = $this->village->database->getVillageByName(stripslashes($post['dname']));
            
            if (!isset($id))
                return "Village doesn't exist";
            else
                $coor = $this->village->database->getCoor($id);
        }
        
        // People search by coordinates
        // We confirm and seek coordinate coordinates Village
        if (isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") {
            $coor = [
                'x' => $post['x'],
                'y' => $post['y']
            ];
            $id = Generator::getBaseID($coor['x'], $coor['y']);
            
            if (!$this->village->database->getVillageState($id))
                return "Coordinates do not exist";
        }
        
        if (!empty($coor)) {
            $Gtribe = $this->village->session->tribe == 1 ? "" : $this->village->session->tribe - 1;
            for ($i = 1; $i < 12; $i ++) {
                if (isset($post['t' . $i])) {
                    if ($i < 10)
                        $troophave = $this->village->unitarray['u' . $Gtribe . $i];
                    if ($i == 10)
                        $troophave = $this->village->unitarray['u' . floor(intval($Gtribe) + 1) * $i];
                    if ($i == 11)
                        $troophave = $this->village->unitarray['hero'];
                    
                    if (intval($post['t' . $i]) > $troophave)
                        return "You can't send more units than you have";
                    if (intval($post['t' . $i]) < 0)
                        return "You can't send negative units.";
                    if (preg_match('/[^0-9]/', $post['t' . $i]))
                        return "Special characters can't entered";
                }
            }
        }
        
        if (isset($id)) {
            // check if the attacked village/oasis' owner is under beginners protection
            if ($this->village->database->hasBeginnerProtection($id) == 1)
                return "Player is under beginners protection. You can't attack him";
            
            // check if it's an oasis or not
            $villageInfo = (!$isOasis) ? $this->village->database->getVillage($id) : $this->village->database->getOasisV($id);
            
            // check if banned/admin:
            $villageOwner = $villageInfo['owner'];
            $userAccess = $this->village->database->getUserField($villageOwner, 'access', 0);
            $userID = $this->village->database->getUserField($villageOwner, 'id', 0);
            // check if he's an Admin and if he's attackable
            if ($userAccess == 0 || ($userAccess == MULTIHUNTER && $userID == 5) || (!ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN)) {
                return "Player is Banned. You can't attack him";
            }
            
            // check if the user' is on the vacation mode:
            if ($this->village->database->getvacmodexy($id))
                return "User is on vacation mode";
            
            // check if attacking same village that units are in
            if ($id == $this->village->wid)
                return "You cant attack same village you are sending from.";
        }
        
        // no errors, we can add the additional information to the post array
        array_push($post, $id, $villageInfo['name'], $villageInfo['owner'], 0);
        
        return "";
    }

    public static function returnTroops($wref, $mode = 0)
    {
        if (!$mode) {
            $getenforce = $this->village->database->getEnforceVillage($wref, 0);
            foreach ($getenforce as $enforce) {
                $this->processReturnTroops($enforce);
            }
        }
        
        // Check oasis
        $getenforce1 = $this->village->database->getOasisEnforce($wref, 1);
        foreach ($getenforce1 as $enforce) {
            $this->processReturnTroops($enforce);
        }
        
        // Set oasis to default
        if (count($getenforce1) > 0) {
            $this->village->database->regenerateOasisUnits($getenforce1[0]['vref']);
        }
    }

    private function processReturnTroops($enforce)
    {
        $to = $this->village->database->getVillage($enforce['from']);
        $tribe = $this->village->database->getUserField($to['owner'], 'tribe', 0);
        $start = ($tribe - 1) * 10 + 1;
        
        $troopsTime = $this->village->database->getWalkingTroopsTime($enforce['from'], $enforce['vref'], $to['owner'], $tribe, $enforce, 1);
        $time = $this->village->database->getArtifactsValueInfluence($from['owner'], $enforce['from'], 2, $troopsTime);
        
        $reference = $this->village->database->addAttack($enforce['from'], $enforce['u' . $start], $enforce['u' . ($start + 1)], $enforce['u' . ($start + 2)], $enforce['u' . ($start + 3)], $enforce['u' . ($start + 4)], $enforce['u' . ($start + 5)], $enforce['u' . ($start + 6)], $enforce['u' . ($start + 7)], $enforce['u' . ($start + 8)], $enforce['u' . ($start + 9)], $enforce['hero'], 2, 0, 0, 0, 0);
        $this->village->database->addMovement(4, $enforce['vref'], $enforce['from'], $reference, time(), ($time + time()));
        $this->village->database->deleteReinf($enforce['id']);
    }

    private function sendTroops($post)
    {
        $data = $this->village->database->getA2b($post['timestamp_checksum']);
        $Gtribe = ($this->village->session->tribe == 1) ? "" : $this->village->session->tribe - 1;
        
        for ($i = 1; $i < 10; $i ++) {
            if (isset($data['u' . $i])) {
                if ($data['u' . $i] > $this->village->unitarray['u' . $Gtribe . $i]) {
                    $this->form->addError("error", "You can't send more units than you have");
                    break;
                }
                
                if ($data['u' . $i] < 0) {
                    $this->form->addError("error", "You can't send negative units.");
                    break;
                }
            }
        }
        
        if ($data['u11'] > $this->village->unitarray['hero'])
            $this->form->addError("error", "You can't send more units than you have");
        if ($data['u11'] < 0)
            $this->form->addError("error", "You can't send negative units.");
        if ($data['type'] != 1 && $post['spy'] != 0)
            $post['spy'] = 0;
        
        if ($this->form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $this->form->getErrors();
            $_SESSION['valuearray'] = $_POST;
            header("Location: a2b.php");
            exit();
        } else {
            $u = ($this->village->session->tribe == 1) ? "" : $this->village->session->tribe - 1;
            
            $this->village->database->modifyUnit($this->village->wid, [
                $u . "1",
                $u . "2",
                $u . "3",
                $u . "4",
                $u . "5",
                $u . "6",
                $u . "7",
                $u . "8",
                $u . "9",
                $u . $this->village->session->tribe . "0",
                "hero"
            ], [
                $data['u1'],
                $data['u2'],
                $data['u3'],
                $data['u4'],
                $data['u5'],
                $data['u6'],
                $data['u7'],
                $data['u8'],
                $data['u9'],
                $data['u10'],
                $data['u11']
            ], [
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0
            ]);
            
            $troopsTime = $this->village->database->getWalkingTroopsTime($this->village->wid, $data['to_vid'], $this->village->session->uid, $this->village->session->tribe, $data, 1, 'u');
            $time = $this->village->database->getArtifactsValueInfluence($this->village->session->uid, $this->village->wid, 2, $troopsTime);
            
            // Check if have WW owner have artefact Rivals great confusion or Artefact of the unique fool with that effect
            // If is a WW village you can target on WW , if is not a WW village catapults will target randomly.
            // Like it says : Exceptions are the WW which can always be targeted and the treasure chamber which can always be targeted, except with the unique artifact.
            // Fixed by Advocaite and Shadow - Optimized by iopietro
            
            $to_owner = $this->village->database->getVillageField($data['to_vid'], "owner");
            $rivalsGreatConfusion = $this->village->database->getArtifactsSumByKind($to_owner, $data['to_vid'], 7);
            
            $rallyPointLevel = ($this->village->resarray)['f39'];
            $invalidBuildings = [];
            
            // fill the array with the invalid buildings
            if ($rallyPointLevel >= 3 && $rallyPointLevel < 5) {
                for ($i = 1; $i <= 37; $i ++) {
                    if (!in_array($i, [
                        10,
                        11
                    ]))
                        $invalidBuildings[] = $i;
                }
            } else if ($rallyPointLevel >= 5 && $rallyPointLevel < 10) {
                for ($i = 12; $i <= 37; $i ++)
                    $invalidBuildings[] = $i;
            } else if ($rallyPointLevel >= 10) {
                $invalidBuildings = [
                    23,
                    31,
                    32,
                    33,
                    34,
                    36
                ];
            }
            
            if (isset($post['ctar1']) && $post['ctar1'] != 0) {
                // check if the player has selected a valid building
                if ($rallyPointLevel < 3 || $data['u8'] == 0 || in_array($post['ctar1'], $invalidBuildings) || $post['ctar1'] < 0 || $post['ctar1'] > 40) {
                    $post['ctar1'] = 0;
                }
            }
            
            if (isset($post['ctar2']) && $post['ctar2'] != 0) {
                // check if there are atleast 20 catapults
                if ($data['u8'] < 20 || $rallyPointLevel != 20) {
                    $post['ctar2'] = 0;
                } else {
                    // check if the player has selected a valid building
                    if (in_array($post['ctar2'], $invalidBuildings) || ($post['ctar2'] < 0 || $post['ctar2'] > 40 && $post['ctar2'] != 99)) {
                        $post['ctar2'] = 99;
                    }
                }
            }
            
            if (isset($post['ctar1'])) {
                // Is the Brewery built?
                if ($this->village->session->tribe != 2 || $this->village->database->getFieldLevelInVillage($this->village->wid, 35) == 0) {
                    if ($rivalsGreatConfusion['totals'] > 0) {
                        if ($post['ctar1'] != 40 && ($post['ctar1'] != 27 || ($post['ctar1'] == 27 && $rivalsGreatConfusion['unique'] > 0))) {
                            $post['ctar1'] = 0;
                        }
                    }
                } else
                    $post['ctar1'] = 0;
            } else
                $post['ctar1'] = 0;
            
            if (isset($post['ctar2']) && $post['ctar2'] > 0) {
                // Is the Brewery built?
                if ($this->village->session->tribe != 2 || $this->village->database->getFieldLevelInVillage($this->village->wid, 35) == 0) {
                    if ($rivalsGreatConfusion['totals'] > 0) {
                        if ($post['ctar2'] != 40 && ($post['ctar2'] != 27 || ($post['ctar2'] == 27 && $rivalsGreatConfusion['unique'] > 0))) {
                            $post['ctar2'] = 99;
                        }
                    }
                } else
                    $post['ctar2'] = 99;
            } else
                $post['ctar2'] = 0;
            
            if (!isset($post['spy']))
                $post['spy'] = 0;
            
            $abdata = $this->village->database->getABTech($this->village->wid);
            $reference = $this->village->database->addAttack(($this->village->wid), $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $data['u11'], $data['type'], $post['ctar1'], $post['ctar2'], $post['spy'], $abdata['b1'], $abdata['b2'], $abdata['b3'], $abdata['b4'], $abdata['b5'], $abdata['b6'], $abdata['b7'], $abdata['b8']);
            $checkexist = $this->village->database->checkVilExist($data['to_vid']);
            $checkoexist = $this->village->database->checkOasisExist($data['to_vid']);
            if ($checkexist || $checkoexist) {
                $this->village->database->addMovement(3, $this->village->wid, $data['to_vid'], $reference, time(), ($time + time()));
                if ($this->village->database->hasBeginnerProtection($this->village->wid) == 1 && $checkexist) {
                    mysqli_query($this->village->database->dblink, "UPDATE " . TB_PREFIX . "users SET protect = 0 WHERE id = " . (int) $this->village->session->uid);
                }
            }
            
            if ($this->form->returnErrors() > 0) {
                $_SESSION['errorarray'] = $this->form->getErrors();
                $_SESSION['valuearray'] = $_POST;
                header("Location: a2b.php");
                exit();
            }
            
            // prevent re-use of the same attack via re-POSTing the same data
            $this->village->database->remA2b($data['id']);
            
            header("Location: build.php?id=39");
            exit();
        }
    }

    private function sendTroopsBack($post)
    {
        $enforce = $this->village->database->getEnforceArray($post['ckey'], 0);
        $enforceoasis = $this->village->database->getOasisEnforceArray($post['ckey'], 0);
        if (($enforce['from'] == $this->village->wid) || ($enforce['vref'] == $this->village->wid) || ($enforceoasis['conqured'] == $this->village->wid)) {
            $to = $this->village->database->getVillage($enforce['from']);
            $Gtribe = ($ownerTribe = $this->village->database->getUserField($to['owner'], 'tribe', 0)) == 1 ? "" : $ownerTribe - 1;
            
            for ($i = 1; $i < 10; $i ++) {
                if (isset($post['t' . $i])) {
                    if ($i != 10) {
                        if ($post['t' . $i] > $enforce['u' . $Gtribe . $i]) {
                            $this->form->addError("error", "You can't send back more units than you have");
                            break;
                        }
                        
                        if ($post['t' . $i] < 0) {
                            $this->form->addError("error", "You can't send back negative units.");
                            break;
                        }
                    }
                } else {
                    $post['t' . $i . ''] = '0';
                }
            }
            if (isset($post['t11'])) {
                if ($post['t11'] > $enforce['hero']) {
                    $this->form->addError("error", "You can't send back more units than you have");
                }
                
                if ($post['t11'] < 0) {
                    $this->form->addError("error", "You can't send back negative units.");
                }
            } else {
                $post['t11'] = '0';
            }
            
            if ($this->form->returnErrors() > 0) {
                $_SESSION['errorarray'] = $this->form->getErrors();
                $_SESSION['valuearray'] = $_POST;
                header("Location: a2b.php");
                exit();
            } else {
                
                // change units
                $tribe = $this->village->database->getUserField($to['owner'], 'tribe', 0);
                $start = ($tribe - 1) * 10 + 1;
                $end = $tribe * 10;
                
                $units = [];
                $amounts = [];
                $modes = [];
                
                $j = 1;
                for ($i = $start; $i <= $end; $i ++) {
                    $units[] = $i;
                    $amounts[] = $post['t' . $j . ''];
                    $modes[] = 0;
                    $j ++;
                }
                
                $units[] = 'hero';
                $amounts[] = $post['t11'];
                $modes[] = 0;
                
                $this->village->database->modifyEnforce($post['ckey'], $units, $amounts, $modes);
                $j ++;
                
                $troopsTime = $this->village->database->getWalkingTroopsTime($enforce['from'], $enforce['vref'], $to['owner'], $tribe, $post, 1, 't');
                $time = $this->village->database->getArtifactsValueInfluence($this->village->session->uid, $this->village->wid, 2, $troopsTime);
                
                $reference = $this->village->database->addAttack($enforce['from'], $post['t1'], $post['t2'], $post['t3'], $post['t4'], $post['t5'], $post['t6'], $post['t7'], $post['t8'], $post['t9'], $post['t10'], $post['t11'], 2, 0, 0, 0, 0);
                $this->village->database->addMovement(4, $this->village->wid, $enforce['from'], $reference, time(), ($time + time()));
                $this->village->technology->checkReinf($post['ckey'], false);
                
                header("Location: build.php?id=39&refresh=1");
                exit();
            }
        } else {
            $this->form->addError("error", "You cant change someones troops.");
            if ($this->form->returnErrors() > 0) {
                $_SESSION['errorarray'] = $this->form->getErrors();
                $_SESSION['valuearray'] = $_POST;
                header("Location: a2b.php");
                exit();
            }
        }
    }

    public function Settlers($post)
    {
        $mode = CP;
        $total = count($this->village->database->getProfileVillages($this->village->session->uid));
        $need_cps = ${'cp' . $mode}[$total + 1];
        $cps = $this->village->session->cp;
        $rallypoint = $this->village->database->getResourceLevel($this->village->wid);
        
        // -- Prevent user from founding a new village if there are not enough settlers or the player put an invalid village ID or an already occupied one
        // -- fix by AL-Kateb - Semplified and additions by iopietro
        if ($rallypoint['f39'] > 0 && $this->village->unitarray['u' . $this->village->session->tribe . '0'] >= 3 && isset($post['s']) && ($newvillage = $this->village->database->getMInfo($post['s']))['id'] > 0 && $newvillage['occupied'] == 0 && $newvillage['oasistype'] == 0) {
            if ($cps >= $need_cps) {
                $troopsTime = $this->village->database->getWalkingTroopsTime($this->village->wid, $newvillage['id'], 0, 0, [
                    300
                ], 0);
                $time = $this->village->database->getArtifactsValueInfluence($this->village->session->uid, $this->village->wid, 2, $troopsTime);
                
                $unit = ($this->village->session->tribe * 10);
                $this->village->database->modifyResource($this->village->wid, 750, 750, 750, 750, 0);
                $this->village->database->modifyUnit($this->village->wid, [
                    $unit
                ], [
                    3
                ], [
                    0
                ]);
                $this->village->database->addMovement(5, $this->village->wid, $post['s'], 0, time(), time() + $time);
            }
            header("Location: build.php?id=39");
            exit();
        } else {
            header("Location: dorf1.php");
            exit();
        }
    }

    public function Hero($uid, $all = 0, $include_dead = false)
    {
        $heroarray = $this->village->database->getHero($uid, $all, $include_dead);
        $herodata = false;
        $singleHeroArrayID = 0;
        
        // no hero data found
        if (!count($heroarray)) {
            return false;
        }
        
        // check all heroes and load hero data for the one,
        // whose data were updated more recently - if we're not getting all of them
        if (!$all) {
            foreach ($heroarray as $id => $hero) {
                // try to load a hero who's alive first
                if (!$herodata && $hero['dead'] != 1) {
                    // this global value comes from GameEngine/Data/unitdata.php
                    $herodata = $GLOBALS["h" . $hero['unit']];
                    $singleHeroArrayID = $id;
                    break;
                }
            }
            
            // if we couldn't get a living hero,
            // resort to loading the first one from the list,
            // as that would be the one most recently updated/used
            if (!$herodata) {
                // this global value comes from GameEngine/Data/unitdata.php
                $herodata = $GLOBALS["h" . $heroarray[0]['unit']];
            }
            
            $h_atk = $herodata['atk'] + 5 * floor($heroarray[$singleHeroArrayID]['attack'] * $herodata['atkp'] / 5);
            $h_di = $herodata['di'] + 5 * floor($heroarray[$singleHeroArrayID]['defence'] * $herodata['dip'] / 5);
            $h_dc = $herodata['dc'] + 5 * floor($heroarray[$singleHeroArrayID]['defence'] * $herodata['dcp'] / 5);
            $h_ob = 1 + 0.002 * $heroarray[$singleHeroArrayID]['attackbonus'];
            $h_db = 1 + 0.002 * $heroarray[$singleHeroArrayID]['defencebonus'];
            
            return [
                'heroid' => $heroarray[$singleHeroArrayID]['heroid'],
                'unit' => $heroarray[$singleHeroArrayID]['unit'],
                'name' => $heroarray[$singleHeroArrayID]['name'],
                'inrevive' => $heroarray[$singleHeroArrayID]['inrevive'],
                'intraining' => $heroarray[$singleHeroArrayID]['intraining'],
                'trainingtime' => $heroarray[$singleHeroArrayID]['trainingtime'],
                'level' => $heroarray[$singleHeroArrayID]['level'],
                'attack' => $heroarray[$singleHeroArrayID]['attack'],
                'atk' => $h_atk,
                'defence' => $heroarray[$singleHeroArrayID]['defence'],
                'di' => $h_di,
                'dc' => $h_dc,
                'attackbonus' => $heroarray[$singleHeroArrayID]['attackbonus'],
                'ob' => $h_ob,
                'defencebonus' => $heroarray[$singleHeroArrayID]['defencebonus'],
                'db' => $h_db,
                'regeneration' => $heroarray[$singleHeroArrayID]['regeneration'],
                'health' => $heroarray[$singleHeroArrayID]['health'],
                'dead' => $heroarray[$singleHeroArrayID]['dead'],
                'points' => $heroarray[$singleHeroArrayID]['points'],
                'experience' => $heroarray[$singleHeroArrayID]['experience']
            ];
        } else {
            // build up a full array of heroes and their stats
            $heroes = [];
            foreach ($heroarray as $id => $hero) {
                $herodata = $GLOBALS["h" . $heroarray[$id]['unit']];
                
                $h_atk = $herodata['atk'] + 5 * floor($heroarray[$id]['attack'] * $herodata['atkp'] / 5);
                $h_di = $herodata['di'] + 5 * floor($heroarray[$id]['defence'] * $herodata['dip'] / 5);
                $h_dc = $herodata['dc'] + 5 * floor($heroarray[$id]['defence'] * $herodata['dcp'] / 5);
                $h_ob = 1 + 0.002 * $heroarray[$id]['attackbonus'];
                $h_db = 1 + 0.002 * $heroarray[$id]['defencebonus'];
                
                $heroes[] = [
                    'heroid' => $heroarray[$id]['heroid'],
                    'unit' => $heroarray[$id]['unit'],
                    'name' => $heroarray[$id]['name'],
                    'inrevive' => $heroarray[$id]['inrevive'],
                    'intraining' => $heroarray[$id]['intraining'],
                    'trainingtime' => $heroarray[$id]['trainingtime'],
                    'level' => $heroarray[$id]['level'],
                    'attack' => $heroarray[$id]['attack'],
                    'atk' => $h_atk,
                    'defence' => $heroarray[$id]['defence'],
                    'di' => $h_di,
                    'dc' => $h_dc,
                    'attackbonus' => $heroarray[$id]['attackbonus'],
                    'ob' => $h_ob,
                    'defencebonus' => $heroarray[$id]['defencebonus'],
                    'db' => $h_db,
                    'regeneration' => $heroarray[$id]['regeneration'],
                    'health' => $heroarray[$id]['health'],
                    'dead' => $heroarray[$id]['dead'],
                    'points' => $heroarray[$id]['points'],
                    'experience' => $heroarray[$id]['experience']
                ];
            }
            
            return $heroes;
        }
    }

    /**
     * Function to kill/release prisoners
     *
     * @param
     *            int the ID of the prisoners you want to release
     */
    public function deletePrisoners($id)
    {
        global $bid19, $u99;
        
        $prisoner = $this->village->database->getPrisonersByID($id);
        $troops = 0;
        if ($prisoner['wref'] == $this->village->wid) {
            $p_owner = $this->village->database->getVillageField($prisoner['from'], "owner");
            $p_tribe = $this->village->database->getUserField($p_owner, "tribe", 0);
            
            $troopsTime = $this->village->database->getWalkingTroopsTime($prisoner['from'], $prisoner['wref'], $p_owner, $p_tribe, $prisoner, 1, 't');
            $p_time = $this->village->database->getArtifactsValueInfluence($p_owner, $prisoner['from'], 2, $troopsTime);
            
            $p_reference = $this->village->database->addAttack($prisoner['from'], $prisoner['t1'], $prisoner['t2'], $prisoner['t3'], $prisoner['t4'], $prisoner['t5'], $prisoner['t6'], $prisoner['t7'], $prisoner['t8'], $prisoner['t9'], $prisoner['t10'], $prisoner['t11'], 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
            $this->village->database->addMovement(4, $prisoner['wref'], $prisoner['from'], $p_reference, time(), ($p_time + time()));
            
            for ($i = 1; $i <= 11; $i ++)
                $troops += $prisoner['t' . $i];
            
            // Reset traps
            $this->village->database->modifyUnit($this->village->wid, [
                "99",
                "99o"
            ], [
                $troops,
                $troops
            ], [
                0,
                0
            ]);
            $repairDuration = $this->village->database->getArtifactsValueInfluence($this->village->session->uid, $this->village->wid, 5, round(($bid19[max($this->village->building->getTypeLevel(36, $this->village->wid), 1)]['attri'] / 100) * $u99['time'] / SPEED));
            $this->village->database->addUnitToTraining($this->village->wid, 99, $troops, $u99['pop'], $repairDuration, 0);
            
            $this->village->database->deletePrisoners($prisoner['id']);
        } else if ($prisoner['from'] == $this->village->wid) {
            $prisonersToOwner = $this->village->database->getVillageField($prisoner['wref'], "owner");
            
            for ($i = 1; $i <= 11; $i ++)
                $troops += $prisoner['t' . $i];
            
            if ($prisoner['t11'] > 0) {
                $p_owner = $this->village->database->getVillageField($prisoner['from'], "owner");
                mysqli_query($this->village->database->dblink, "UPDATE " . TB_PREFIX . "hero SET `dead` = '1', `health` = '0' WHERE `uid` = '" . $p_owner . "' AND dead = 0");
            }
            
            // Reset traps
            $this->village->database->modifyUnit($prisoner['wref'], [
                "99",
                "99o"
            ], [
                $troops,
                $troops
            ], [
                0,
                0
            ]);
            
            if (($troops = round($troops / 3)) > 0) {
                $repairDuration = $this->village->database->getArtifactsValueInfluence($prisonersToOwner, $prisoner['wref'], 5, round(($bid19[max($this->village->building->getTypeLevel(36, $prisoner['wref']), 1)]['attri'] / 100) * $u99['time'] / SPEED));
                $this->village->database->trainUnit($prisoner['wref'], 99, $troops, $u99['pop'], $repairDuration, 0);
            }
            
            $this->village->database->deletePrisoners($prisoner['id']);
        }
        
        header("Location: build.php?id=39");
        exit();
    }

    public function startRaidList($post)
    {
        $slots = $post['slot'];
        if (empty($slots)) {
            header("Location: build.php?id=39&t=99");
            exit();
        }
        
        $tribe = $this->village->session->tribe;
        
        foreach ($slots as $slot) {
            $raidList = $this->village->database->getRaidList($slot);
            $getFLData = $this->village->database->getFLData($raidList['lid']);
            
            // Check if we're trying to start our raidlists or other players raidlist
            if ($getFLData['owner'] != $this->village->session->uid)
                continue;
            
            // Get the units in the village
            $villageUnits = $this->village->database->getUnit($getFLData['wref'], false);
            
            $sid = $raidList['id'];
            $wref = $raidList['towref'];
            
            for ($i = 1; $i <= 6; $i ++) {
                ${'t' . $i} = $raidList['t' . $i];
            }  
            
            if (!$this->village->database->isVillageOases($wref)) {
                $villageOwner = $this->village->database->getVillageField($wref, 'owner');
            } else {
                $villageOwner = $this->village->database->getOasisField($wref, 'owner');
            }

            $userAccess = $this->village->database->getUserField($villageOwner, 'access', 0);
            $userID = $this->village->database->getUserField($villageOwner, 'id', 0);
            
            if ($userAccess != 0 && !($userAccess == MULTIHUNTER && $userID == 5) && ($userAccess != ADMIN || (ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN))) {
                
                // Start = the first troop of the player's tribe
                // End = the last selectable troop of the player's tribe
                $start = ($this->village->session->tribe - 1) * 10 + 1;
                $end = $start + 5;
                
                // Check if we've enough troops
                $canSend = true;
                for ($i = $start; $i <= $end; $i ++) {
                    if ($villageUnits['u' . $i] < ${'t' . ($i - $start + 1)}) {
                        $canSend = false;
                        break;
                    }
                }
                
                // Send the attack
                if ($canSend) {
                    $ckey = Generator::generateRandStr(6);
                    $id = $this->village->database->addA2b($ckey, 0, $wref, $t1, $t2, $t3, $t4, $t5, $t6, 0, 0, 0, 0, 0, 4);
                    $data = $this->village->database->getA2b($ckey);
                    
                    $troopsTime = $this->village->database->getWalkingTroopsTime($getFLData['wref'], $data['to_vid'], $this->village->session->uid, $this->village->session->tribe, $data, 1, 'u');
                    $time = $this->village->database->getArtifactsValueInfluence($getFLData['owner'], $getFLData['wref'], 2, $troopsTime);
                    
                    $abdata = $this->village->database->getABTech($getFLData['wref']);
                    $reference = $this->village->database->addAttack(($getFLData['wref']), $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], 0, 0, 0, 0, 0, $data['type'], 0, 0, 0, $abdata['b1'], $abdata['b2'], $abdata['b3'], $abdata['b4'], $abdata['b5'], $abdata['b6'], $abdata['b7'], $abdata['b8']);
                    
                    $troops = [];
                    $amounts = [];
                    $modes = [];
                    
                    for ($u = $start; $u <= $end; $u ++) {
                        $troops[] = $u;
                        $amounts[] = $data['u' . ($u - $start + 1)];
                        $modes[] = 0;
                    }
                    
                    $this->village->database->modifyUnit($getFLData['wref'], $troops, $amounts, $modes);
                    $this->village->database->addMovement(3, $getFLData['wref'], $data['to_vid'], $reference, time(), ($time + time()));
                    
                    // Prevent re-use of the same attack via re-POSTing the same data
                    $this->village->database->remA2b($id);
                }
            }
        }
        header("Location: build.php?id=39&t=99");
        exit();
    }
}
