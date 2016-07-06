<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Battle.php                                                  ##
##  Developed by:  Dzoki & Dixie   					       ## 
##  Fixed by:      Shadow 				  		       ##
##  Thanks to:     Akakori & Elmar                                             ##
##  Reworked and Fix by:   ronix                                               ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################


class Battle {

		public function procSim($post) {
			global $form;
			// receive form and process
			if(isset($post['a1_v']) && (isset($post['a2_v1']) || isset($post['a2_v2']) || isset($post['a2_v3']) || isset($post['a2_v4']))) {
				$_POST['mytribe'] = $post['a1_v'];
				$target = array();
				if(isset($post['a2_v1'])) {
					array_push($target,1);
				}
				if(isset($post['a2_v2'])) {
					array_push($target,2);
				}
				if(isset($post['a2_v3'])) {
					array_push($target,3);
				}
				if(isset($post['a2_v4'])) {
					array_push($target,4);
				}
				if(isset($post['a2_v5'])) {
					array_push($target,5);
				}					
				$_POST['target'] = $target;
				if(isset($post['h_off_bonus'])) {
					if (intval($post['h_off_bonus'])>20) {$post['h_off_bonus']=20;}
				}else $post['h_off_bonus']=0;
				
				if(isset($post['h_def_bonus'])) {
					if (intval($post['h_def_bonus'])>20) {$post['h_def_bonus']=20;}
				}else $post['h_def_bonus']=0;
								
				if(isset($post['a1_1'])) {
					$sum = $sum2 = $post['walllevel'] = 0;
					for($i=1;$i<=10;$i++) {
						$sum += $post['a1_'.$i];
					}
					if($sum > 0) {
						$post['palast'] = intval($post['palast']);
						if($post['palast'] > 20) $post['palast'] = 20; 

						if(isset($post['wall1'])) {
							$post['wall1'] = intval($post['wall1']);
							if ($post['wall1'] > 20) $post['wall1']=20;
							if ($post['walllevel']==0) $post['walllevel']=$post['wall1'];
						}	
						if(isset($post['wall2'])) {
							$post['wall2'] = intval($post['wall2']);
							if ($post['wall2'] > 20) $post['wall2']=20;
							if ($post['walllevel']==0) $post['walllevel']=$post['wall2'];
						}
						if(isset($post['wall3'])) {
							$post['wall3'] = intval($post['wall3']);
							if ($post['wall3'] > 20) $post['wall3']=20;
							if ($post['walllevel']==0) $post['walllevel']=$post['wall3'];
						}
						if(isset($post['wall4'])) {
							$post['wall4'] = intval($post['wall4']);
							if ($post['wall4'] > 20) $post['wall4']=20;
							if ($post['walllevel']==0) $post['walllevel']=$post['wall4'];
						}
						if(isset($post['wall5'])) {
							$post['wall5'] = intval($post['wall5']);
							if ($post['wall5'] > 20) $post['wall5']=20;
							if ($post['walllevel']==0) $post['walllevel']=$post['wall5'];
						}
						$post['tribe'] = $target[0];
						$_POST['result'] = $this->simulate($post);
						$form->valuearray = $post;
					}
				}
			}
		}
		private function getBattleHero($uid) {
		global $database;
		$heroarray = $database->getHero($uid);
		$herodata = $GLOBALS["h".$heroarray[0]['unit']];
		if(!isset($heroarray['health'])) $heroarray['health']=0;
		$h_atk = $herodata['atk'] + ($heroarray[0]['attack'] * $herodata['atkp']);
		$h_di = $herodata['di'] + 5 * floor($heroarray[0]['defence'] * $herodata['dip'] / 5);
		$h_dc = $herodata['dc'] + 5 * floor($heroarray[0]['defence'] * $herodata['dcp'] / 5);
		$h_ob = 1 + 0.010 * ($heroarray[0]['attackbonus']/5);
		$h_db = 1 + 0.010 * ($heroarray[0]['defencebonus']/5);
		return array('heroid'=>$heroarray[0]['heroid'],'unit'=>$heroarray[0]['unit'],'atk'=>$h_atk,'di'=>$h_di,'dc'=>$h_dc,'ob'=>$h_ob,'db'=>$h_db,'health'=>$heroarray['health']);
		}
		
		private function getBattleHeroSim($attbonus) {
		global $database;
		$h_atk =0;
		$h_ob = 1 + 0.010 * $attbonus;
		
		return array('unit'=>16,'atk'=>$h_atk,'ob'=>$h_ob);
		}
		
		private function simulate($post) {
				//set the arrays with attacking and defending units
				$attacker = array('u1'=>0,'u2'=>0,'u3'=>0,'u4'=>0,'u5'=>0,'u6'=>0,'u7'=>0,'u8'=>0,'u9'=>0,'u10'=>0,'u11'=>0,'u12'=>0,'u13'=>0,'u14'=>0,'u15'=>0,'u16'=>0,'u17'=>0,'u18'=>0,'u19'=>0,'u20'=>0,'u21'=>0,'u22'=>0,'u23'=>0,'u24'=>0,'u25'=>0,'u26'=>0,'u27'=>0,'u28'=>0,'u29'=>0,'u30'=>0,'u31'=>0,'u32'=>0,'u33'=>0,'u34'=>0,'u35'=>0,'u36'=>0,'u37'=>0,'u38'=>0,'u39'=>0,'u40'=>0,'u41'=>0,'u42'=>0,'u43'=>0,'u44'=>0,'u45'=>0,'u46'=>0,'u47'=>0,'u48'=>0,'u49'=>0,'u50'=>0);
				$start = ($post['a1_v']-1)*10+1;
				$index = 1;
				$offhero=intval($post['h_off_bonus']);
				$hero_strenght=intval($post['h_off']);
				$deffhero=intval($post['h_def_bonus']);		
				for($i=$start;$i<=($start+9);$i++) {
						$attacker['u'.$i] = $post['a1_'.$index];
						if($index <=8) {
								${'att_ab'.$index} = $post['f1_'.$index];
						}
						$index += 1;
				}
				
				$defender = array();
				$defscout=0;
				//fix by ronix
				for($i=1;$i<=50;$i++) {
						if(isset($post['a2_'.$i]) && $post['a2_'.$i] != "") {
								$defender['u'.$i] = $post['a2_'.$i];
								$def_ab[$i]=$post['f2_'.$i];
								if($i == 4 || $i == 14 || $i == 23 || $i == 44){
									$defscout+=$defender['u'.$i];
								}
								
						}
						else {
								$defender['u'.$i] = 0;
								$def_ab[$i]=0;
						}
				}
				$deftribe = $post['tribe'];
				$wall = 0;

				if($post['kata'] == "") {
						$post['kata'] = 0;
				}

				// check scout

				$scout = 1;
				for($i=$start;$i<=($start+9);$i++) {
						if($i == 4 || $i == 14 || $i == 23 || $i == 44){
						}else{
								if($attacker['u'.$i]>0) {
										$scout = 0;
										break;
								}
						}
				}
				$walllevel=$post['walllevel'];
				$wall = $walllevel;
				$palast = $post['palast'];
				if($scout ==1) {
					$palast = 0; //no def point palace n residence when scout
				}
				
				if(!$scout) 
					return $this->calculateBattle($attacker,$defender,$wall,$post['a1_v'],$deftribe,$palast,$post['ew1'],$post['ew2'],$post['ktyp']+3,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$post['kata'],$post['stonemason'],$walllevel,$offhero,$post['h_off'],$deffhero,0,0,0,0,0);
				else 
					return $this->calculateBattle($attacker,$defender,$wall,$post['a1_v'],$deftribe,$palast,$post['ew1'],$post['ew2'],1,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$post['kata'],$post['stonemason'],$walllevel,0,0,0,0,0,0,0,0);
				}

	 public function getTypeLevel($tid,$vid) {
		global $village,$database;
		$keyholder = array();

			$resourcearray = $database->getResourceLevel($vid);

		foreach(array_keys($resourcearray,$tid) as $key) {
			if(strpos($key,'t')) {
				$key = preg_replace("/[^0-9]/", '', $key);
				array_push($keyholder, $key);
			}
		}
		$element = count($keyholder);
		if($element >= 2) {
			if($tid <= 4) {
				$temparray = array();
				for($i=0;$i<=$element-1;$i++) {
					array_push($temparray,$resourcearray['f'.$keyholder[$i]]);
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
		else if($element == 1) {
			$target = 0;
		}
		else {
			return 0;
		}
		if($keyholder[$target] != "") {
			return $resourcearray['f'.$keyholder[$target]];
		}
		else {
			return 0;
		}
	}

		//1 raid 0 normal
		function calculateBattle($Attacker,$Defender,$def_wall,$att_tribe,$def_tribe,$residence,$attpop,$defpop,$type,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$tblevel,$stonemason,$walllevel,$offhero,$hero_strenght,$deffhero,$AttackerID,$DefenderID,$AttackerWref,$DefenderWref,$conqureby) {
			global $bid34,$bid35,$database;
				
			// Define the array, with the units
			$calvary = array(4,5,6,15,16,23,24,25,26,45,46);
			$catapult = array(8,18,28,48);
			$rams = array(7,17,27,47);
			$catp = $ram = 0;
			// Array to return the result of the calculation back
			$result = array();
			$involve = 0;
			$winner = false;
			// at 0 all partial results
			$cap = $ap = $dp = $cdp = $rap = $rdp = 0;
				
		
			$att_artefact = count($database->getOwnUniqueArtefactInfo2($AttackerID,3,3,0));
			$att_artefact1 = count($database->getOwnUniqueArtefactInfo2($AttackerWref,3,1,1));
			$att_artefact2 = count($database->getOwnUniqueArtefactInfo2($AttackerID,3,2,0));
			if($att_artefact > 0){
				$attacker_artefact = 10;
			}else if($att_artefact1 > 0){
				$attacker_artefact = 5;
			}else if($att_artefact2 > 0){
				$attacker_artefact = 3;
			}else{
				$attacker_artefact = 1;
			}
			$def_artefact = count($database->getOwnUniqueArtefactInfo2($DefenderID,3,3,0));
			$def_artefact1 = count($database->getOwnUniqueArtefactInfo2($DefenderWref,3,1,1));
			$def_artefact2 = count($database->getOwnUniqueArtefactInfo2($DefenderID,3,2,0));
			if($def_artefact > 0){
				$defender_artefact = 10;
			}else if($att_artefact1 > 0){
				$defender_artefact = 5;
			}else if($def_artefact2 > 0){
				$defender_artefact = 3;
			}else{
				$defender_artefact = 1;
			}
			if(isset($Attacker['uhero']) && $Attacker['uhero'] != 0){
				$atkhero = $this->getBattleHero($AttackerID);
			}
			if(isset($Defender['hero']) && $Defender['hero'] != 0){
				$defenderhero = $this->getBattleHero($DefenderID);
			}
			//own defender units
			if ($type==1) {
				$datadefScout=$this->getDataDefScout($Defender,$def_ab,$defender_artefact,$AttackerWref,$AttackerID);
				$dp+=$datadefScout['dp'];
				$cdp+=$datadefScout['cdp'];
				$involve=$datadefScout['involve'];
				if ($datadefScout['detect']==1) $detected = 1;
			}else{
				$datadef=$this->getDataDef($Defender,$def_ab);
				$dp+=$datadef['dp'];
				$cdp+=$datadef['cdp'];
				$involve=$datadef['involve'];
				if(isset($Defender['hero']) && $Defender['hero'] != 0){
					$units['Def_unit']['hero'] = $Defender['hero'];
					$cdp += $defenderhero['dc'];
					$dp += $defenderhero['di'];
					$dp *= $defenderhero['db'];
					$cdp *= $defenderhero['db'];
				}
			}
            $DefendersAll = $database->getEnforceVillage($DefenderWref,0);
            if(!empty($DefendersAll) && $DefenderWref>0){
                foreach($DefendersAll as $defenders) {
                    for ($i=1;$i<=50;$i++) {$def_ab[$i]=0;}
                    $fromvillage = $defenders['from'];
                    $enforcetribe = $database->getUserField($database->getVillageField($fromvillage,"owner"),"tribe",0);
                    $ud=($enforcetribe-1)*10;                
                    if($defenders['from']>0) { //don't check nature tribe
                        $armory = $database->getABTech($defenders['from']); // Armory level every village enforcement
                        $def_ab[$ud+1] = $armory['a1'];
                        $def_ab[$ud+2] = $armory['a2'];
                        $def_ab[$ud+3] = $armory['a3'];
                        $def_ab[$ud+4] = $armory['a4'];
                        $def_ab[$ud+5] = $armory['a5'];
                        $def_ab[$ud+6] = $armory['a6'];
                        $def_ab[$ud+7] = $armory['a7'];
                        $def_ab[$ud+8] = $armory['a8'];
                    }
                    if ($type==1) {
                        $datadefScout=$this->getDataDefScout($defenders,$def_ab,$defender_artefact,$AttackerWref,$AttackerID);
                        $dp+=$datadefScout['dp'];
                        $cdp+=$datadefScout['cdp'];
                        $involve=$datadefScout['involve'];
                        if ($datadefScout['detect']==1) $detected = 1;
                    }else{
                        $datadef=$this->getDataDef($defenders,$def_ab);
                        $dp+=$datadef['dp'];
                        $cdp+=$datadef['cdp'];
                        $involve=$datadef['involve'];
                    }            
                    $reinfowner = $database->getVillageField($fromvillage,"owner");
                    $defhero = $this->getBattleHero($reinfowner);
                    //calculate def hero from enforcement
                    if($defenders['hero'] != 0){
                        //$cdp += $defhero['dc'];
                        //$dp += $defhero['di'];
                        $dp *= $defhero['db'];
                        $cdp *= $defhero['db'];
                    }    
                }
            }
			// Calculate the total number of points Attacker
			$start = ($att_tribe-1)*10+1;
			$end = ($att_tribe*10);
			if($att_tribe == 3){
				$abcount = 3;
			}else{
				$abcount = 4;
			}
		
			if($type == 1) {//scout

					for($i=$start;$i<=$end;$i++) {
						global ${'u'.$i};
						$j = $i-$start+1;
						if($Attacker['u'.$i]>0 && ($i == 4 || $i == 14 || $i == 23 || $i == 44)){
							if(${'att_ab'.$abcount} > 0) { 
									$ap += (35 + (35 + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.00697, ${'att_ab'.$abcount}) - 1)) * $Attacker['u'.$i];// ^ ($Attacker['u'.$i]/100);
							}else{
								$ap += $Attacker['u'.$i]*35;
							}
						}	
						$involve += $Attacker['u'.$i];
						$units['Att_unit'][$i] = $Attacker['u'.$i];
						
					}
					$att_foolartefact = $database->getFoolArtefactInfo(3,$AttackerWref,$AttackerID);
					if(count($att_foolartefact) > 0){
						foreach($att_foolartefact as $arte){
							if($arte['bad_effect'] == 1){
								$ap *= $arte['effect2'];
							}else{
								$ap /= $arte['effect2'];
								$ap = round($ap);
							}
						}
					}
					
				}else{ //type=3 normal 4=raid
					$abcount = 1;
					for($i=$start;$i<=$end;$i++) {
						global ${'u'.$i};
						$j = $i-$start+1;
						if($abcount <= 8 && ${'att_ab'.$abcount} > 0) {
							if(in_array($i,$calvary)) {
								$cap += (${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${'att_ab'.$abcount}) - 1)) * $Attacker['u'.$i];
							}else{
								$ap += (${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${'att_ab'.$abcount}) - 1)) * $Attacker['u'.$i];
							}
						}else{
							if(in_array($i,$calvary)) {
								$cap += $Attacker['u'.$i]*${'u'.$i}['atk'];
							}else{
								$ap += $Attacker['u'.$i]*${'u'.$i}['atk'];
							}
						}
						$abcount +=1;
						// Points catapult the attacker
						if(in_array($i,$catapult)) {
							$catp += $Attacker['u'.$i];
						}
						// Points of the Rams attacker
						if(in_array($i,$rams)){
							$ram += $Attacker['u'.$i];
						}
						$involve += $Attacker['u'.$i];
						$units['Att_unit'][$i] = $Attacker['u'.$i];
					}
					if (isset($Attacker['uhero']) && $Attacker['uhero'] != 0){
						$units['Att_unit']['hero'] = $Attacker['uhero'];
						$ap *= $atkhero['ob'];
						$cap *= $atkhero['ob'];
						$ap += $atkhero['atk'];
					}
			
					if ($offhero!=0 || $hero_strenght!=0) {
						$atkhero=$this->getBattleHeroSim($offhero);
						$ap *= $atkhero['ob'];
						$cap *= $atkhero['ob'];
						$ap += $hero_strenght;
					}
					if ($deffhero!=0) {
						$dfdhero=$this->getBattleHeroSim($deffhero);
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
                // Defense infantry = Infantry * Wall (%) 
				// Defense calvary calvary = * Wall (%)                        
				if ($dp>0 || $cdp >0) {
					if($type==1) { 
						$dp *=  pow($factor,$def_wall);
						$dp1 = 10 * pow($factor,$def_wall) * $def_wall;
						$dp +=$dp1;
					}else{
						$dp *= pow($factor,$def_wall); 
						$cdp *= pow($factor,$def_wall); 
					
						// Calculation of the Basic defense bonus "Residence"
						$dp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
						$cdp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
					}
				} else {
					$dp = 10 * pow($factor,$def_wall) * $def_wall; 
					// Defense calvary calvary = * Wall (%) 
					$cdp = 10 * pow($factor,$def_wall) * $def_wall;
					if($type!=1) {
						// Calculation of the Basic defense bonus "Residence"  
						$dp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
						$cdp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
					}else $cdp=0;
				}
            }elseif($type!=1) { 
                // Calculation of the Basic defense bonus "Residence" 
                $dp += (2*(pow($residence,2))); 
                $cdp += (2*(pow($residence,2))); 
            }  

			// Formula for calculating points attackers (Infantry & Cavalry)
				
			if($AttackerWref != 0){
				$rap = ($ap+$cap)+(($ap+$cap)/100*$bid35[$this->getTypeLevel(35,$AttackerWref)]['attri']);
			}else{
				$rap = $ap+$cap;
			}
				
			// Formula for calculating Defensive Points
				
			if ($rap==0) 
				$rdp = ($dp) + ($cdp) + 10;
			else
				$rdp = ($dp * ($ap/$rap)) + ($cdp * ($cap/$rap)) + 10;
					
				
			// The Winner is....:
			$result['Attack_points'] = $rap;
			$result['Defend_points'] = $rdp;
			$winner = ($rap > $rdp);
								
			// Formula for calculating the Moral
			if($attpop > $defpop) {
				if ($rap < $rdp) {
					$moralbonus = min(1.5, pow($attpop / $defpop, (0.2*($rap/$rdp))));
				}else{
					if($defpop==0){
						$moralbonus = min(1.5, pow($attpop, 0.2));
					}else{
						$moralbonus = min(1.5, pow($attpop / $defpop, 0.2));
					}
				}
			}else{
				$moralbonus = 1.0;
			}

			if($involve >= 1000) {
				$Mfactor = round(2*(1.8592-pow($involve,0.015)),4);
			}else{
				$Mfactor = 1.5;
			}
			if ($Mfactor < 1.25778){$Mfactor=1.25778;}elseif ($Mfactor > 1.5){$Mfactor=1.5;}
				// Formula for calculating lost drives
				// $type = 1 scout, 2?
				// $type = 3 Normal, 4 Raid
			if($type == 1){
				$holder = pow((($rdp*$moralbonus)/$rap),$Mfactor);
				if($holder>1) $holder=1;
				if ($rdp>$rap) $holder=1;		
				
				// Attacker
				$result[1] = $holder;
				if ($att_tribe==5) $result[1] = 0; //Birds of Prey cannot die when scout
						
				// Defender
				$result[2] = 0;
			}else if($type == 2){

			}else if($type == 4) {
				$holder = ($winner) ? pow((($rdp*$moralbonus)/$rap),$Mfactor) : pow(($rap/($rdp*$moralbonus)),$Mfactor);
				$holder = $holder / (1 + $holder);
				// Attacker
				$result[1] = $winner ? $holder : 1 - $holder;
				// Defender
				$result[2] = $winner ? 1 - $holder : $holder;
				$ram -= round($ram*$result[1]/100);
				$catp -= round($catp*$result[1]/100);
			}else if($type == 3){
				// Attacker
												
				$result[1] = ($winner)? round(pow((($rdp*$moralbonus)/$rap),$Mfactor),8) : 1;
				if ($result[1]>1) {$result[1]=1;$winner=false;$result['Winner'] = "defender";}
						
				// Defender
				$result[2] = (!$winner)? round(pow(($rap/($rdp*$moralbonus)),$Mfactor),8) : 1;
				if ($result[1]==1) {$result[2]=round(pow(($rap/($rdp*$moralbonus)),$Mfactor),8);}
				if ($result[2]>1) {$result[2]=1;$result['Winner'] = "attacker";$winner=true;}
				// If attacked with "Hero"
				$ku = ($att_tribe-1)*10+9;
				$kings = $Attacker['u'.$ku];

				$aviables= $kings-round($kings*$result[1]);
				if ($aviables>0){
						switch($aviables){
						case 1:$fealthy = rand(20,30);break;
						case 2:$fealthy = rand(40,60);break;
						case 3:$fealthy = rand(60,80);break;
						case 4:$fealthy = rand(80,100);break;
						default:$fealthy = 100;break;
					}
					$result['hero_fealthy'] = $fealthy;
				}
				$ram -= ($winner)? round($ram*$result[1]/100) : round($ram*$result[2]/100);
				$catp -= ($winner)? round($catp*$result[1]/100) : round($catp*$result[2]/100);
			}
			// Formula for the calculation of catapults needed
			if($catp > 0 && $tblevel != 0) {
				$wctp = pow(($rap/$rdp),1.5);
				$wctp = ($wctp >= 1)? 1-0.5/$wctp : 0.5*$wctp;
				$wctp *= $catp+($att_ab8/1.5);
				$artowner = $database->getVillageField($DefenderWref,"owner");
				$bartefact = count($database->getOwnUniqueArtefactInfo2($artowner,1,3,0));
				$bartefact1 = count($database->getOwnUniqueArtefactInfo2($DefenderWref,1,1,1));
				$bartefact2 = count($database->getOwnUniqueArtefactInfo2($artowner,1,2,0));
				if($bartefact > 0){
					$strongerbuildings = 5;
				}elseif($bartefact1 > 0){
					$strongerbuildings = 4;
				}elseif($bartefact2 > 0){
					$strongerbuildings = 3;
				}else{
					$strongerbuildings = 1;
				}
				$good_effect = $bad_effect = 1;
				$foolartefact = $database->getFoolArtefactInfo(3,$DefenderWref,$artowner);
				if(count($foolartefact) > 0){
					foreach($foolartefact as $arte){
						if($arte['bad_effect'] == 1){
							$bad_effect = $arte['effect2'];
						}else{
							$good_effect = $arte['effect2'];
						}
					}
				}
			
				if($stonemason==0){
					$need = round((($moralbonus * (pow($tblevel,2) + $tblevel + 1)) / (8 * (round(200 * pow(1.0205,$att_ab8))/200) / $strongerbuildings / $good_effect * $bad_effect)) + 0.5);
				}else{
					$need = round((($moralbonus * (pow($tblevel,2) + $tblevel + 1)) / (8 * (round(200 * pow(1.0205,$att_ab8))/200) / ($bid34[$stonemason]['attri']/100) / $strongerbuildings / $good_effect * $bad_effect)) + 0.5);
				}
				
				// Number catapults to take down the building
				$result[3] = $need;
				//Number catapults nego
				$result[4] = $wctp;
				$result[5] = $moralbonus;
				$result[9] = $att_ab8;
				$result[10]=$strongerbuildings / $good_effect * $bad_effect;
			}
			if($ram > 0 && $walllevel != 0) {
				$wctp = pow(($rap/$rdp),1.5);
				$wctp = ($wctp >= 1)? 1-0.5/$wctp : 0.5*$wctp;
				$wctp *= ($ram/2) + ($att_ab7/1.5);
				$artowner = $database->getVillageField($DefenderWref,"owner");
				$bartefact = count($database->getOwnUniqueArtefactInfo2($artowner,1,3,0));
				$bartefact1 = count($database->getOwnUniqueArtefactInfo2($DefenderWref,1,1,1));
				$bartefact2 = count($database->getOwnUniqueArtefactInfo2($artowner,1,2,0));
				if($bartefact > 0){
					$strongerbuildings = 5;
				}else if($bartefact1 > 0){
					$strongerbuildings = 4;
				}else if($bartefact2 > 0){
					$strongerbuildings = 3;
				}else{
					$strongerbuildings = 1;
				}
				$good_effect = $bad_effect = 1;
				$foolartefact = $database->getFoolArtefactInfo(3,$DefenderWref,$artowner);
				if(count($foolartefact) > 0){
					foreach($foolartefact as $arte){
						if($arte['bad_effect'] == 1){
							$bad_effect = $arte['effect2'];
						}else{
							$good_effect = $arte['effect2'];
						}
					}
				}
				if($stonemason==0){
					$need = round((($moralbonus * (pow($walllevel,2) + $walllevel + 1)) / (8 * (round(200 * pow(1.0205,$att_ab7))/200) / $strongerbuildings / $good_effect * $bad_effect)) + 0.5);
				}else{
					$need = round((($moralbonus * (pow($walllevel,2) + $walllevel + 1)) / (8 * (round(200 * pow(1.0205,$att_ab7))/200) / ($bid34[$stonemason]['attri']/100) / $strongerbuildings / $good_effect * $bad_effect)) + 0.5);
				}
				// Number catapults to take down the building
				$result[7] = $need;

				// Number catapults to action
				$result[8] = $wctp;
			
			}

			$result[6] = pow($rap/$rdp*$moralbonus,$Mfactor);

			$total_att_units = count($units['Att_unit']);
			$start = intval(($att_tribe-1)*10+1);
			$end = intval(($att_tribe*10));

			for($i=$start;$i <= $end;$i++){
				$y = $i-(($att_tribe-1)*10);
				$result['casualties_attacker'][$y] = round($result[1]*$units['Att_unit'][$i]);

			}

			if (isset($units['Att_unit']['hero']) && $units['Att_unit']['hero'] >0){

				$_result=mysql_query("select * from " . TB_PREFIX . "hero where `dead`='0' and `heroid`='".$atkhero['heroid']."'");
				$fdb = mysql_fetch_array($_result);
				$hero_id=$fdb['heroid'];
				$hero_health=$fdb['health'];
				$damage_health=round(100*$result[1]);
			
				if ($hero_health<=$damage_health or $damage_health>90){
					//hero die
					$result['casualties_attacker']['11'] = 1;
					mysql_query("update " . TB_PREFIX . "hero set `dead`='1' where `heroid`='".$hero_id."'");
					mysql_query("update " . TB_PREFIX . "hero set `health`='0' where `heroid`='".$hero_id."'");
				}else{
					mysql_query("update " . TB_PREFIX . "hero set `health`=`health`-".$damage_health." where `heroid`='".$hero_id."'");
				}
			}
			unset($_result,$fdb,$hero_id,$hero_health,$damage_health);


			if (isset($units['Def_unit']['hero']) && $units['Def_unit']['hero'] >0){

				$_result=mysql_query("select * from " . TB_PREFIX . "hero where `dead`='0' and `heroid`='".$defenderhero['heroid']."'");
				$fdb = mysql_fetch_array($_result);
				$hero_id=$fdb['heroid'];
				$hero_health=$fdb['health'];
				$damage_health=round(100*$result[2]);
				if ($hero_health<=$damage_health or $damage_health>90){
					//hero die
					$result['deadherodef'] = 1;
					mysql_query("update " . TB_PREFIX . "hero set `dead`='1' where `heroid`='".$hero_id."'");
					mysql_query("update " . TB_PREFIX . "hero set `health`='0' where `heroid`='".$hero_id."'");
				}else{
					$result['deadherodef'] = 0;
					mysql_query("update " . TB_PREFIX . "hero set `health`=`health`-".$damage_health." where `heroid`='".$hero_id."'");
				}
			}
			unset($_result,$fdb,$hero_id,$hero_health,$damage_health);

			$DefendersAll = $database->getEnforceVillage($DefenderWref,0);
			if(!empty($DefendersAll)){
				foreach($DefendersAll as $defenders) {
					if($defenders['hero']>0) {
						if(!empty($heroarray)) { reset($heroarray); }
						$Reinforcer = $database->getVillageField($defenders['from'],"owner");
						$heroarraydefender = $this->getBattleHero($Reinforcer);
						$_result=mysql_query("select * from " . TB_PREFIX . "hero where `dead`='0' and `heroid`='".$heroarraydefender['heroid']."'");
						$fdb = mysql_fetch_array($_result);
						$hero_id=$fdb['heroid'];
						$hero_health=$fdb['health'];
						$damage_health=round(100*$result[2]);
						if ($hero_health<=$damage_health or $damage_health>90){
							//hero die
							$result['deadheroref'][$defenders['id']] = 1;
							mysql_query("update " . TB_PREFIX . "hero set `dead`='1' where `heroid`='".$hero_id."'");
							mysql_query("update " . TB_PREFIX . "hero set `health`='0' where `heroid`='".$hero_id."'");
						}else{
							$result['deadheroref'][$defenders['id']] = 0;
							mysql_query("update " . TB_PREFIX . "hero set `health`=`health`-".$damage_health." where `heroid`='".$hero_id."'");
						}
					}
				}
			}
			unset($_result,$fdb,$hero_id,$hero_health,$damage_health);


			// Work out bounty
			$start = ($att_tribe-1)*10+1;
			$end = ($att_tribe*10);

			$max_bounty = 0;

			for($i=$start;$i<=$end;$i++) {
				$j = $i-$start+1;
				$y = $i-(($att_tribe-1)*10);

				$max_bounty += ($Attacker['u'.$i]-$result['casualties_attacker'][$y])*${'u'.$i}['cap'];

			}

			$result['bounty'] = $max_bounty;

			
			return $result;
		}

		public function getDataDefScout($defenders,$def_ab,$defender_artefact,$AttackerWref,$AttackerID) {
			global $database;
			$abcount=1;
			$invol=0;
			$dp=0;
			$cdp=0;
			$detected=0;
			
			for($y=4;$y<=54;$y++) {
				if($y == 4 || $y == 14 || $y == 23 || $y == 44){
					global ${'u'.$y};
																				
					if($defenders['u'.$y]>0 && $def_ab[$y] > 0) {
						$dp +=  (20 + (20 + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.00696, $def_ab[$y]) - 1)) * $defenders['u'.$y] * $defender_artefact;

						$def_foolartefact = $database->getFoolArtefactInfo(3,$AttackerWref,$AttackerID);
						if(count($def_foolartefact) > 0){
							foreach($def_foolartefact as $arte){
								if($arte['bad_effect'] == 1){
									$dp *= $arte['effect2'];
								}else{
									$dp /= $arte['effect2'];
									$dp = round($dp);
								}
							}
						}
					}else {
						if($defenders['u'.$y]>0) {
							$dp +=  $defenders['u'.$y]* 20 * $defender_artefact;
						}
												
						$units['Def_unit'][$y] = $defenders['u'.$y];
						if($units['Def_unit'][$y] > 0){
							$detected = 1;
						}
					}
					$invol += $defenders['u'.$y]; //total troops
					$units['Def_unit'][$y] = $defenders['u'.$y];						
				}
			}
		
			$datadef['dp']=$dp;
			$datadef['cdp']=$cdp;
			$datadef['detect']=($detected==1)? 1:0;
			$datadef['involve']=$invol;
			return $datadef;
		}
		public function getDataDef($defenders,$def_ab) {

			$dp=0;
			$cdp=0;
			$invol=0;
			for($y=1;$y<=50;$y++) {
				global ${'u'.$y};
				if ($defenders['u'.$y]>0) {
					if ($def_ab[$y]>0) {
						$dp +=  (${'u'.$y}['di'] + (${'u'.$y}['di'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1)) * $defenders['u'.$y];
						$cdp += (${'u'.$y}['dc'] + (${'u'.$y}['dc'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1)) * $defenders['u'.$y];
					}else{
						$dp += $defenders['u'.$y]*${'u'.$y}['di'];
						$cdp += $defenders['u'.$y]*${'u'.$y}['dc'];
					}	
					
				}
				$invol += $defenders['u'.$y]; //total troops		
				$units['Def_unit'][$y] = $defenders['u'.$y];
			}
			$datadef['dp']=$dp;
			$datadef['cdp']=$cdp;
			$datadef['involve']=$invol;
			
			return $datadef;
		
		}
};

$battle = new Battle;
?>
