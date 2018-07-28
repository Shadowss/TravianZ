<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       Battle.php                                                  ##
##  Developed by:  Dzoki & Dixie   					       ##
##  Fixed by:      Shadow 				  		       ##
##  Thanks to:     Akakori, Elmar & Kirilloid                                  ##
##  Reworked and Fix by:   ronix                                               ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################


class Battle {

        /**
        * 
        * @author Kirilloid --> https://github.com/kirilloid/travian/blob/master/src/model/base/combat.ts
        * @var double The number of attacking catapults: 1 = 100%, 0 = 0%
        * 
        */
    
        private $sigma;
        
        public function __construct(){
            
            $this->sigma = function($x) { return ($x > 1 ? 2 - $x ** -1.5 : $x ** 1.5) / 2; }; 
            
        }
        
		public function procSim($post) {
			global $form;
			
			// receive form and process
			if(isset($post['a1_v']) && (isset($post['a2_v1']) || isset($post['a2_v2']) || isset($post['a2_v3']) || isset($post['a2_v4']))){
				$_POST['mytribe'] = $post['a1_v'];
				
				$target = [];
				if(isset($post['a2_v1'])) array_push($target, 1);
				if(isset($post['a2_v2'])) array_push($target, 2);
				if(isset($post['a2_v3'])) array_push($target, 3);
				if(isset($post['a2_v4'])) array_push($target, 4);
				if(isset($post['a2_v5'])) array_push($target, 5);
				
				$_POST['target'] = $target;
				if(isset($post['h_off_bonus'])){
					if(intval($post['h_off_bonus']) > 20) $post['h_off_bonus'] = 20;
				}
				else $post['h_off_bonus'] = 0;
					
				if(isset($post['h_def_bonus'])){
					if(intval($post['h_def_bonus']) > 20) $post['h_def_bonus'] = 20;
				}
				else $post['h_def_bonus'] = 0;
				
				$sum = 0;
				for($i = 1; $i <= 10; $i++) $sum += (!empty($post['a1_'.$i]) ? $post['a1_'.$i] : 0);
				
				if($sum > 0){
					$post['palast'] = intval($post['palast']);
					if($post['palast'] > 20) $post['palast'] = 20;
					
					for($i = 1; $i <= 5; $i++){
						if(isset($post['wall'.$i])){
							$post['wall'.$i] = intval($post['wall'.$i]);
							if($post['wall'.$i] > 20) $post['wall'.$i] = 20;
							elseif($post['wall'.$i] < 0) $post['wall'.$i] = 0;
							$post['walllevel'] = $post['wall'.$i];
						}
					}

					$post['tribe'] = $target[0];
					$_POST['result'] = $this->simulate($post);
					$newWallLevel = $_POST['result'][7];
					$oldWallLevel = $_POST['result'][8];
					
					//If the wall level is reduce, we have to re-do the whole battle
					if($newWallLevel != $oldWallLevel){
						$post['walllevel'] = $newWallLevel;
						$_POST['result'] = $this->simulate($post);
						
						//Reset the datas
						$_POST['result'][7] = $newWallLevel;
						$_POST['result'][8] = $post['walllevel'] = $oldWallLevel;
					}
					
					$form->valuearray = $post;
				}
			}
		}
		
		private function getBattleHero($uid) {
			global $database;
			$heroarray = $database->getHero($uid);

			if (!count($heroarray)) return ['heroid' => 0, 'unit' =>'','atk' => 0,'di' => 0,'dc' => 0,'ob' => 0,'db' => 0,'health' => 0];

			$herodata = $GLOBALS["h".$heroarray[0]['unit']];
			if(!isset($heroarray['health'])) $heroarray['health'] = 0;
			$h_atk = $herodata['atk'] + ($heroarray[0]['attack'] * $herodata['atkp']);
			$h_di = $herodata['di'] + 5 * floor($heroarray[0]['defence'] * $herodata['dip'] / 5);
			$h_dc = $herodata['dc'] + 5 * floor($heroarray[0]['defence'] * $herodata['dcp'] / 5);
			$h_ob = 1 + 0.010 * ($heroarray[0]['attackbonus'] / 5);
			$h_db = 1 + 0.010 * ($heroarray[0]['defencebonus'] / 5);

			return ['heroid' => (int) $heroarray[0]['heroid'], 'unit' => $heroarray[0]['unit'], 'atk' => $h_atk, 'di' => $h_di, 'dc' => $h_dc, 'ob' => $h_ob, 'db' => $h_db, 'health' => $heroarray['health']];
		}

		private function getBattleHeroSim($attbonus) {
            $h_atk = 0;
            $h_ob = 1 + 0.010 * $attbonus;

            return ['unit' => 16,'atk' => $h_atk,'ob' => $h_ob];
		}

		private function simulate($post) {
				//set the arrays with attacking and defending units
				$attacker = ['u1' => 0, 'u2' => 0, 'u3' => 0, 'u4' => 0, 'u5' => 0, 'u6' => 0, 'u7' => 0, 'u8' => 0, 'u9' => 0, 'u10' => 0, 'u11' => 0, 'u12' => 0, 'u13' => 0, 'u14' => 0, 'u15' => 0, 'u16' => 0, 'u17' => 0, 'u18' => 0, 'u19' => 0, 'u20' => 0, 'u21' => 0, 'u22' => 0, 'u23' => 0, 'u24' => 0,
				'u25' => 0, 'u26' => 0, 'u27' => 0, 'u28' => 0, 'u29' => 0, 'u30' => 0, 'u31' => 0, 'u32' => 0, 'u33' => 0, 'u34' => 0, 'u35' => 0, 'u36' => 0, 'u37' => 0, 'u38' => 0, 'u39' => 0, 'u40' => 0, 'u41' => 0, 'u42' => 0, 'u43' => 0, 'u44' => 0, 'u45' => 0, 'u46' => 0, 'u47' => 0, 'u48' => 0,
				'u49' => 0, 'u50' => 0];
				$start = ($post['a1_v'] - 1) * 10 + 1;
				$offhero = intval($post['h_off_bonus']);
				$hero_strenght = intval($post['h_off']);
				$deffhero = intval($post['h_def_bonus']);
				for($i = $start, $index = 1; $i <= $start + 9; $i++, $index++) {
				    if(isset($post['a1_'.$index]) && !empty($post['a1_'.$index])) {
				        $attacker['u'.$i] = $post['a1_'.$index];
				    }
				    else $attacker['u'.$i] = 0;
				    
				    if($index <=8 && isset($post['f1_'.$index]) && !empty($post['f1_'.$index])) {
				        ${'att_ab'.$index} = $post['f1_'.$index];
				    }
				    else ${'att_ab'.$index} = 0;
				}

				$defender = [];
				$defscout = 0;
				//fix by ronix
				for($i = 1;$i <= 50; $i++) {
				    if(isset($post['a2_'.$i]) && !empty($post['a2_'.$i])) {
				        $defender['u'.$i] = $post['a2_'.$i];
				        $def_ab[$i] = $post['f2_'.$i];
				        if($i == 4 || $i == 14 || $i == 23 || $i == 44){
				            $defscout += $defender['u'.$i];
				        }
				        
				    }
				    else {
				        $defender['u'.$i] = 0;
				        $def_ab[$i] = 0;
				    }
				}
				
				$deftribe = $post['tribe'];
				$wall = 0;

				if(empty($post['kata'])) $post['kata'] = 0;

				// check scout

				$scout = 1;
				for($i = $start; $i <= $start + 9 ; $i++) {
				    if($i == 4 || $i == 14 || $i == 23 || $i == 44){
				    }else{
				        if($attacker['u'.$i] > 0) {
				            $scout = 0;
				            break;
				        }
				    }
				}
				
				$walllevel = $post['walllevel'];
				$wall = $walllevel;
				$palast = $post['palast'];

				if($scout == 1 && $defscout == 0) $walllevel = $wall = $palast = 0;

				if($scout == 1) $palast = 0; //no def point palace and residence when scout

				if(!$scout) return $this->calculateBattle($attacker,$defender,$wall,$post['a1_v'],$deftribe,$palast,$post['ew1'],$post['ew2'],$post['ktyp']+3,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$post['kata'],$post['stonemason'],$walllevel,$offhero,$post['h_off'],$deffhero,0,0,0,0,0);
				else return $this->calculateBattle($attacker,$defender,$wall,$post['a1_v'],$deftribe,$palast,$post['ew1'],$post['ew2'],1,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$post['kata'],$post['stonemason'],$walllevel,0,0,0,0,0,0,0,0);
				
		}

	 public function getTypeLevel($tid,$vid) {
		global $village,$database;

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
				for($i = 0; $i <= $element - 1; $i++){
					array_push($temparray, $resourcearray['f'.$keyholder[$i]]);
				}
				foreach ($temparray as $key => $val) {
					if ($val == max($temparray))
					$target = $key;
				}
			}
			else {
				$target = 0;
				for($i=1;$i<=$element-1;$i++) {
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

    //1 raid 0 normal
    function calculateBattle($Attacker, $Defender, $def_wall, $att_tribe, $def_tribe, $residence, $attpop, $defpop, $type, $def_ab, $att_ab1, $att_ab2, $att_ab3, $att_ab4, $att_ab5, $att_ab6, $att_ab7, $att_ab8, $tblevel, $stonemason, $walllevel, $offhero, $hero_strenght, $deffhero, $AttackerID, $DefenderID, $AttackerWref, $DefenderWref, $conqureby, $defReinforcements = null) {
        global $bid34, $bid35, $database;

        // Define the array, with the units
        $calvary = [4, 5, 6, 15, 16, 23, 24, 25, 26, 45, 46];
        $catapult = [8, 18, 28, 48];
        $rams = [7, 17, 27, 47];
        $catp = $ram = 0;
        
        // Array to return the result of the calculation back
        $result = [];
        $involve = 0;
        $winner = false;
        
        // at 0 all partial results
        
        //cap = Cavalry attack points
        //ap = Infantry attack points
        //cdp = Cavalry attack points
        //dp = Infantry defense points
        //rap = Result attack points
        //rdp = Result defense points
        //detected = Detected or not by defender spies
        $cap = $ap = $dp = $cdp = $rap = $rdp = 0;
        $detected = false;
        
        //Get involved artifacts
        $attacker_artefact = $database->getArtifactsValueInfluence($AttackerID, $AttackerWref, 3, 1, false);
        $defender_artefact = $database->getArtifactsValueInfluence($DefenderID, $DefenderWref, 3, 1, false);
        $strongerbuildings = $database->getArtifactsValueInfluence($DefenderID, $DefenderWref, 1, 1, false);
        $isWWVillage = $database->getVillageField($DefenderWref, 'natar');
        
        if(isset($Attacker['uhero']) && $Attacker['uhero'] > 0){
            $atkhero = $this->getBattleHero($AttackerID);
        }
        if(isset($Defender['hero']) && $Defender['hero'] > 0){
            $defenderhero = $this->getBattleHero($DefenderID);
        }
        //own defender units
        if ($type == 1) {
            $datadefScout = $this->getDataDefScout($Defender, $def_ab, $defender_artefact);
            $dp += $datadefScout['dp'];
            $cdp += $datadefScout['cdp'];
            $involve = $datadefScout['involve'];
            if(!$detected && $datadefScout['detect']) $detected = $datadefScout['detect'];
        }else{
            $datadef = $this->getDataDef($Defender, $def_ab);
            $dp += $datadef['dp'];
            $cdp += $datadef['cdp'];
            $involve = $datadef['involve'];
            if(isset($Defender['hero']) && $Defender['hero'] != 0){
                $units['Def_unit']['hero'] = $Defender['hero'];
                $cdp += $defenderhero['dc'];
                $dp += $defenderhero['di'];
                $dp *= $defenderhero['db'];
                $cdp *= $defenderhero['db'];
            }
        }
        $DefendersAll = (!is_null($defReinforcements) ? $database->getEnforceVillage($DefenderWref, 0) : $defReinforcements);

        if(!empty($DefendersAll) && $DefenderWref > 0){
            // preload village IDs
            $vilIDs = [];
            foreach($DefendersAll as $defenders) {
                $vilIDs[$defenders['from']] = true;
                $vilIDs[$defenders['to']] = true;
            }
            $vilIDs = array_keys($vilIDs);
            $database->getABTech($vilIDs);

            foreach($DefendersAll as $defenders) {
                for ($i = 1; $i <= 50; $i++) $def_ab[$i] = 0;
                $fromvillage = $defenders['from'];

                $userdataCache[$fromvillage] = $database->getUserArray($database->getVillageField($fromvillage, "owner"), 1);

                $enforcetribe = $userdataCache[$fromvillage]["tribe"];
                $ud=($enforcetribe - 1) * 10;
                if($defenders['from'] > 0) { //don't check nature tribe
                    $armory = $database->getABTech($defenders['from']); // Armory level every village enforcement
                    $def_ab[$ud + 1] = $armory['a1'];
                    $def_ab[$ud + 2] = $armory['a2'];
                    $def_ab[$ud + 3] = $armory['a3'];
                    $def_ab[$ud + 4] = $armory['a4'];
                    $def_ab[$ud + 5] = $armory['a5'];
                    $def_ab[$ud + 6] = $armory['a6'];
                    $def_ab[$ud + 7] = $armory['a7'];
                    $def_ab[$ud + 8] = $armory['a8'];
                }
                if ($type == 1) {
                    $datadefScout = $this->getDataDefScout($defenders, $def_ab, $defender_artefact);
                    $dp += $datadefScout['dp'];
                    $cdp += $datadefScout['cdp'];
                    $involve = $datadefScout['involve'];
                    if(!$detected && $datadefScout['detect']) $detected = $datadefScout['detect'];
                }else{
                    $datadef = $this->getDataDef($defenders, $def_ab);
                    $dp += $datadef['dp'];
                    $cdp += $datadef['cdp'];
                    $involve = $datadef['involve'];
                }
                $reinfowner = $database->getVillageField($fromvillage, "owner");
                $defhero = $this->getBattleHero($reinfowner);
                
                //calculate def hero from enforcement
                if($defenders['hero'] != 0){
                    $cdp += $defhero['dc'];
                    $dp += $defhero['di'];
                    $dp *= $defhero['db'];
                    $cdp *= $defhero['db'];
                }
            }
        }
        // Calculate the total number of points Attacker
        $start = ($att_tribe - 1) * 10 + 1;
        $end = $att_tribe * 10;
        
        if($att_tribe == 3) $abcount = 3;
        else $abcount = 4;

        if($type == 1) {//scout
                for($i = $start;$i <= $end; $i++) {
                    global ${'u'.$i};
                    $j = $i - $start + 1;
                    if($Attacker['u'.$i] > 0 && ($i == 4 || $i == 14 || $i == 23 || $i == 44)){
                        if(${'att_ab'.$abcount} > 0) {
                            $ap += round(35 + (35 + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${'att_ab'.$abcount}) - 1), 4) * $Attacker['u'.$i];
                        }
                        else $ap += $Attacker['u'.$i] * 35;
                    }
                    $involve += $Attacker['u'.$i];
                    $units['Att_unit'][$i] = $Attacker['u'.$i];

                }
                $ap *= $attacker_artefact;

            }else{ //type=3 normal 4=raid
                $abcount = 1;
                for($i = $start; $i <= $end; $i++) {
                    global ${'u'.$i};
                    $j = $i - $start + 1;
                    if($abcount <= 8 && ${'att_ab'.$abcount} > 0) {
                        if(in_array($i,$calvary)) {
                            $cap += round(${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${'att_ab'.$abcount}) - 1), 4) * (int) $Attacker['u'.$i];
                        }else{
                            $ap += round(${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${'att_ab'.$abcount}) - 1), 4) * (int) $Attacker['u'.$i];
                        }
                    }else{
                        if(in_array($i,$calvary)) $cap += (int) $Attacker['u'.$i]*${'u'.$i}['atk'];                       
                        else $ap += (int) $Attacker['u'.$i]*${'u'.$i}['atk'];                      
                    }
                    
                    $abcount += 1;
                    
                    // Points catapult the attacker
                    if(in_array($i, $catapult)) $catp += (int) $Attacker['u'.$i];

                    // Points of the Rams attacker
                    if(in_array($i, $rams)) $ram += (int) $Attacker['u'.$i];

                    $involve += (int) $Attacker['u'.$i];
                    $units['Att_unit'][$i] = (int) $Attacker['u'.$i];
                }
                if (isset($Attacker['uhero']) && $Attacker['uhero'] != 0){
                    $units['Att_unit']['hero'] = $Attacker['uhero'];
                    $ap *= $atkhero['ob'];
                    $cap *= $atkhero['ob'];
                    $ap += $atkhero['atk'];
                }

                if ($offhero > 0 || $hero_strenght > 0) {
                    $atkhero= $this->getBattleHeroSim($offhero);
                    $ap *= $atkhero['ob'];
                    $cap *= $atkhero['ob'];
                    $ap += $hero_strenght;
                }
                if ($deffhero > 0) {
                    $dfdhero = $this->getBattleHeroSim($deffhero);
                    $dp *= $dfdhero['ob'];
                    $cdp *= $dfdhero['ob'];
                }
            }
         // Formula for calculating the bonus defensive wall and Residence

        if($def_wall > 0) {
            // Set the factor calculation for the "wall" as the type of the civilization
            // Factor = 1030 Wall Roman
            // Factor = 1020 Wall Teuton
            // Factor = 1025 Wall Goul
            $factor = ($def_tribe == 1)? 1.030 : (($def_tribe == 2)? 1.020 : 1.025);
            $wallMultiplier = round(pow($factor, $def_wall), 3);
            // Defense infantry = Infantry * Wall (%)
            // Defense calvary calvary = * Wall (%)          
            if ($dp > 0 || $cdp > 0){
                if($type == 1) {
                    $dp *=  $wallMultiplier;
                    $dp += 10;
                }else{                
                    $dp *= $wallMultiplier;
                    $cdp *= $wallMultiplier;

                    // Calculation of the Basic defense bonus "Residence"
                    $dp += (2 * (pow($residence, 2)) + 10) * $wallMultiplier;
                    $cdp += (2 * (pow($residence, 2)) + 10) * $wallMultiplier;
                }
            }else{
                $dp = 10 * $wallMultiplier * $def_wall;
                // Defense calvary calvary = * Wall (%)
                $cdp = 10 * $wallMultiplier * $def_wall;
                if($type != 1){
                    // Calculation of the Basic defense bonus "Residence"
                    $dp += (2 * (pow($residence, 2)) + 10) * $wallMultiplier;
                    $cdp += (2 * (pow($residence, 2)) + 10) * $wallMultiplier;
                }else{
                    $dp += 10;
                    $cdp = 0;
                }
            }
        }elseif($type != 1) {
            
            // Calculation of the Basic defense bonus "Residence"
            $dp += (2 * (pow($residence, 2)) + 10);
            $cdp += (2 * (pow($residence, 2)) + 10);
        }

        // Formula for calculating Attacking Points (Infantry & Cavalry)
        if($AttackerWref != 0){
            $rap = round(($ap + $cap) + (($ap + $cap) / 100 * (isset($bid35[$this->getTypeLevel(35, $AttackerWref)]) ? $bid35[$this->getTypeLevel(35, $AttackerWref)]['attri'] : 0)));
        }
        else $rap = round($ap + $cap);

        // Formula for calculating Defensive Points
        if ($rap == 0) $rdp = round(($dp) + ($cdp));          
        else $rdp = round(round($cap / $rap, 4) * ($cdp) + round($ap / $rap, 4) * ($dp));

        // The Winner is....:
        $result['Attack_points'] = $rap;
        $result['Defend_points'] = $rdp;
        $winner = ($rap > $rdp);

        // Formula for calculating the Morale bonus
        // WW villages aren't affected by this bonus
        if($attpop > $defpop && !$isWWVillage) {
            $moralbonus = 1 / round(max(0.667, pow($defpop / $attpop, 0.2 * min(1, $rap / ($rdp > 0 ? $rdp : 1)))), 3);  
        }
        else $moralbonus = 1.0;

        if($involve >= 1000 && $type != 1) $Mfactor = 2 * round((1.8592 - pow($involve, 0.015)), 4);
        else $Mfactor = 1.5;
        
        if ($Mfactor < 1.2578) $Mfactor = 1.2578;
        elseif ($Mfactor > 1.5) $Mfactor = 1.5;
        
        // Formula for calculating losses
        // $type = 1 Scout, 2 Enforcement
        // $type = 3 Normal, 4 Raid
        if($type == 1){
            $holder = pow((($rdp * $moralbonus) / $rap), $Mfactor);
            if($holder > 1) $holder = 1;
            if ($rdp > $rap) $holder = 1;
            
            //Birds of Prey cannot die when scouting
            //Spies cannot die if the attacked village has no defending spies
            //Attacker result
            $result[1] = ($att_tribe == 5 || !$detected) ? 0 : $holder;

            //Defender result
            $result[2] = 0;
        }else if($type == 4) {
            $holder = ($winner) ? pow((($rdp * $moralbonus) / $rap), $Mfactor) : pow(($rap / ($rdp * $moralbonus)), $Mfactor);
            $holder = $holder / (1 + $holder);
            //Attacker result
            $result[1] = $winner ? $holder : 1 - $holder;
            //Defender result
            $result[2] = $winner ? 1 - $holder : $holder;
            $ram -= round($ram * $result[1] / 100);
            $catp -= round($catp * $result[1] / 100);
        }else if($type == 3){
            
            // Attacker
            $result[1] = ($winner) ? pow((($rdp * $moralbonus) / $rap), $Mfactor) : 1;
            
            if ($result[1] > 1){
                $result[1] = 1;
                $winner = false;
                $result['Winner'] = "defender";
            }

            // Defender
            $result[2] = (!$winner) ? pow(($rap / ($rdp * $moralbonus)), $Mfactor) : 1;
            
            if ($result[1] == 1) $result[2] = pow(($rap / ($rdp * $moralbonus)), $Mfactor);

            if ($result[2] > 1) {
                $result[2] = 1;
                $result['Winner'] = "attacker";
                $winner = true;
            }
            
            // If attacked with "Hero"
            $ku = ($att_tribe - 1) * 10 + 9;
            $kings = (int) $Attacker['u'.$ku];

            $aviables = $kings - round($kings * (int) $result[1]);
            if ($aviables > 0){
                    switch($aviables){
                    case 1: $fealthy = rand(20, 30); break;
                    case 2: $fealthy = rand(40, 60); break;
                    case 3: $fealthy = rand(60, 80); break;
                    case 4: $fealthy = rand(80, 100); break;
                    default: $fealthy = 100; break;
                }
                $result['hero_fealthy'] = $fealthy;
            }
            
            $ram -= ($winner) ? round($ram * $result[1] / 100) : round($ram * $result[2] / 100);
            $catp -= ($winner) ? round($catp * $result[1] / 100) : round($catp * $result[2] / 100);
        }

        if($catp > 0 && $tblevel != 0) {
            
            //Catapults blacksmith upgrades
            $upgrades = round(200 * pow(1.0205, $att_ab8)) / 200; 
            
            //Buildings durability
            $durability = ($stonemason > 0 ? $bid34[$stonemason]['attri'] / 100 : 1);

            //Calculates the catapults morale bonus
            $catpMoraleBonus = min(max(($attpop / ($defpop > 0 ? $defpop : 1)) ** 0.3, 1), 3);

            //New level of the building (only for warsim.php)
            $catapultsDamage = $this->calculateCatapultsDamage($catp, $upgrades, $durability, $rap / $rdp, $strongerbuildings, $catpMoraleBonus);
            $result[3] = $this->calculateNewBuildingLevel($tblevel, $catapultsDamage);
            $result[4] = $tblevel;
            
            //Results for Automation.php          
            $result['catapults']['upgrades'] = $upgrades;
            $result['catapults']['durability'] = $durability;
            $result['catapults']['attackDefenseRatio'] = $rap / $rdp;
            $result['catapults']['strongerBuildings'] = $strongerbuildings;
            $result['catapults']['moraleBonus'] = $catpMoraleBonus;
        }
        
        if($ram > 0 && $walllevel != 0) {
            
            //Rams blacksmith upgrades
            $upgrades = round(200 * pow(1.0205, $att_ab7)) / 200;

            //Building durability
            $durability = ($stonemason > 0 ? $bid34[$stonemason]['attri'] / 100 : 1);
           
            // New level of the building (only for warsim.php)
            $ramsDamage = $this->calculateCatapultsDamage($ram, $upgrades, $durability, $rap / $rdp, $strongerbuildings, 1);
            $result[7] = $this->calculateNewBuildingLevel($walllevel, $ramsDamage);
            $result[8] = $walllevel;

            // Results for Automation.php
            $result['rams']['upgrades'] = $upgrades;
            $result['rams']['durability'] = $durability;
            $result['rams']['attackDefenseRatio'] = $rap / $rdp;
            $result['rams']['strongerBuildings'] = $strongerbuildings;
            $result['rams']['moraleBonus'] = 1;
        }

        $result[6] = pow($rap / ($rdp * $moralbonus > 0 ? $rdp * $moralbonus : 1), $Mfactor);
        $result['moralBonus'] = $moralbonus;
        
        $total_att_units = count($units['Att_unit']);
        $start = intval(($att_tribe - 1) * 10 + 1);
        $end = intval($att_tribe * 10);
        
        for($i = $start; $i <= $end; $i++){
            $y = $i - (($att_tribe - 1) * 10);
            $result['casualties_attacker'][$y] = round($result[1] * $units['Att_unit'][$i]);
        }

        if (isset($units['Att_unit']['hero']) && $units['Att_unit']['hero'] >0){

            $_result = mysqli_query($database->dblink,"select heroid, health from " . TB_PREFIX . "hero where `dead`='0' and `heroid`=".(int) $atkhero['heroid']);
            $fdb = mysqli_fetch_array($_result);
            $hero_id = (int) $fdb['heroid'];
            $hero_health = $fdb['health'];
            $damage_health = round(100 * $result[1]);

            if ($hero_health <= $damage_health || $damage_health > 90){
                //hero die
                $result['casualties_attacker'][11] = 1;
                mysqli_query($database->dblink,"update " . TB_PREFIX . "hero set `dead` = 1, `health` = 0 where `heroid`=".(int) $hero_id);
            }else{
                mysqli_query($database->dblink,"update " . TB_PREFIX . "hero set `health`=`health`-".(int) $damage_health." where `heroid`=".(int) $hero_id);
            }
        }
        unset($_result, $fdb, $hero_id, $hero_health, $damage_health);


        if (isset($units['Def_unit']['hero']) && $units['Def_unit']['hero'] >0){

            $_result = mysqli_query($database->dblink,"select heroid, health from " . TB_PREFIX . "hero where `dead`='0' and `heroid`=".(int) $defenderhero['heroid']);
            $fdb = mysqli_fetch_array($_result);
            $hero_id = (int) $fdb['heroid'];
            $hero_health = $fdb['health'];
            $damage_health = round(100 * $result[2]);
            if ($hero_health <= $damage_health || $damage_health > 90){
                //hero die
                $result['deadherodef'] = 1;
                mysqli_query($database->dblink,"update " . TB_PREFIX . "hero set `dead` = 1, `health` = 0 where `heroid`=".(int) $hero_id);
            }else{
                $result['deadherodef'] = 0;
                mysqli_query($database->dblink,"update " . TB_PREFIX . "hero set `health`=`health`-".(int) $damage_health." where `heroid`=".(int) $hero_id);
            }
        }
        unset($_result, $fdb, $hero_id, $hero_health, $damage_health);

        if(!empty($DefendersAll)){
            $battleHeroesCache = [];
            foreach($DefendersAll as $defenders) {
                if($defenders['hero'] > 0) {
                    $battleHeroesCache[$defenders['from']] = $this->getBattleHero($database->getVillageField($defenders['from'],"owner"));
                    $heroarraydefender = $battleHeroesCache[$defenders['from']];
                    $_result = mysqli_query($database->dblink,"select heroid, health from " . TB_PREFIX . "hero where `dead`='0' and `heroid`=".(int) $heroarraydefender['heroid']);
                    $fdb = mysqli_fetch_array($_result);
                    $hero_id = (int) $fdb['heroid'];
                    $hero_health = $fdb['health'];
                    $damage_health = round(100 * $result[2]);
                    if ($hero_health <= $damage_health || $damage_health > 90){
                        //hero die
                        $result['deadheroref'][$defenders['id']] = 1;
                        mysqli_query($database->dblink,"update " . TB_PREFIX . "hero set `dead` = 1, `health` = 0 where `heroid`=".(int) $hero_id);
                    }else{
                        $result['deadheroref'][$defenders['id']] = 0;
                        mysqli_query($database->dblink,"update " . TB_PREFIX . "hero set `health`=`health`-".(int) $damage_health." where `heroid`=".(int) $hero_id);
                    }
                }
            }
        }
        unset($_result, $fdb, $hero_id, $hero_health, $damage_health);


        // Work out bounty
        $start = ($att_tribe - 1) * 10 + 1;
        $end = ($att_tribe * 10);

        $max_bounty = 0;

        for($i = $start; $i <= $end; $i++) {
            $j = $i - $start + 1;
            $y = $i -(($att_tribe - 1) * 10);

            $max_bounty += ((int) $Attacker['u'.$i] - (int) $result['casualties_attacker'][$y]) * (int) ${'u'.$i}['cap'];
        }

        $result['bounty'] = $max_bounty;
        return $result;
    }

    public function getDataDefScout($defenders, $def_ab, $defender_artefact) {
        $abcount = 1;
        $invol = $dp = $cdp = 0;
        $detected = false;
        
        for($y = 4; $y <= 50; $y++) {
            if($y == 4 || $y == 14 || $y == 23 || $y == 44){
                global ${'u'.$y};

                if($defenders['u'.$y] > 0 && $def_ab[$y] > 0){
                    $dp += round(20 + (20 + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1), 4) * $defenders['u'.$y] * $defender_artefact;
                    $detected = true;
                }else{
                	if($defenders['u'.$y] > 0){
                		$dp +=  $defenders['u'.$y] * 20 * $defender_artefact;
                		$detected = true;
                	}
                }
                
                $invol += $defenders['u'.$y]; //total troops
                $units['Def_unit'][$y] = $defenders['u'.$y];
            }
        }

        $datadef['dp'] = $dp;
        $datadef['cdp'] = $cdp;
        $datadef['detect'] = $detected;
        $datadef['involve'] = $invol;
        return $datadef;
    }

    public function getDataDef($defenders,$def_ab) {
        $dp = $cdp = $invol = 0;
        for($y = 1;$y <= 50; $y++) {
            global ${'u'.$y};
            if ($defenders['u'.$y] > 0) {
                if (!isset($def_ab[$y])) {
                    $def_ab[$y] = 0;
                }
                if ($def_ab[$y] > 0) {
                    $dp +=  round(${'u'.$y}['di'] + (${'u'.$y}['di'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1), 4) * $defenders['u'.$y];
                    $cdp += round(${'u'.$y}['dc'] + (${'u'.$y}['dc'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1), 4) * $defenders['u'.$y];
                }else{
                    $dp += $defenders['u'.$y] * ${'u'.$y}['di'];
                    $cdp += $defenders['u'.$y] * ${'u'.$y}['dc'];
                }

            }
            $invol += $defenders['u'.$y]; //total troops
            $units['Def_unit'][$y] = $defenders['u'.$y];
        }
        $datadef['dp'] = $dp;
        $datadef['cdp'] = $cdp;
        $datadef['involve'] = $invol;
        return $datadef;
    }
    
    /**
     * @author Kirilloid --> https://github.com/kirilloid/travian/blob/master/src/model/base/combat.ts
     * 
     * Calculates the new building level, after damaging it
     * 
     * @param int $oldLevel The old building level
     * @param float $damage The damage done by catapults
     * @return int Returns the new building level
     */
    
    public function calculateNewBuildingLevel($oldLevel, $damage){
        $damage -= 0.5;
        if ($damage < 0) return $oldLevel;
        
        while ($damage >= $oldLevel && $oldLevel) $damage -= $oldLevel--;
        
        return $oldLevel;
    }
    
    /**
     * @author Kirilloid --> https://github.com/kirilloid/travian/blob/master/src/model/base/combat.ts
     * 
     * Calculates the damage done by catapults
     * 
     * @param int $catapultsQuantity The quantity of catapults which take part in the attack
     * @param double $catapultsUpgrade The catapults upgrade multiplier, affected by the cataputls level in the blacksmith
     * @param double $durability The building durability, affected by the stonemason's lodge
     * @param double $ADRatio The attack points / defensive points ratio
     * @param double $strongerBuildings The artifacts multiplier, which strengthens the building, affected by durability artifacts
     * @param double $moraleBonus The defender morale bonus
     * @return double Returns the damage done by catapults
     */
    
    public function calculateCatapultsDamage($catapultsQuantity, $catapultsUpgrade, $durability, $ADRatio, $strongerBuildings, $moraleBonus){
        $catapultsEfficiency = floor($catapultsQuantity / ($durability * $strongerBuildings));
        return 4 * ($this->sigma)($ADRatio) * $catapultsEfficiency * $catapultsUpgrade / $moraleBonus;
    }
};

$battle = new Battle;
?>
