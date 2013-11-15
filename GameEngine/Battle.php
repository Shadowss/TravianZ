<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                        		       	       ##
##  Version:       01.09.2013 						       ##
##  Filename       Battle.php                                                  ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow  	       ##
##  Fixed by:      Shadow - Doubleing Troops , STARVATION , HERO FIXED COMPL.  ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       ##
##                                                                             ##
#################################################################################

class Battle {

		public function procSim($post) {
				global $form;
				// Receive the form and process
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
								if (intval($_POST['h_off_bonus'])>20) $post['h_off_bonus']=20;
								if(isset($post['a1_1'])) {
										$sum = $sum2 = 0;
										for($i=1;$i<=10;$i++) {
												$sum += $post['a1_'.$i];
										}
										if($sum > 0) {
												if($post['palast'] == "") {
														$post['palast'] = 0;
												}
												if(isset($post['wall1']) && $post['wall1'] == "") {
														$post['wall1'] = 0;
												}
												if(isset($post['wall2']) && $post['wall2'] == "") {
														$post['wall2'] = 0;
												}
												if(isset($post['wall3']) && $post['wall3'] == "") {
														$post['wall3'] = 0;
												}if(isset($post['wall4']) && $post['wall4'] == "") {
							$post['wall4'] = 0;
						}if(isset($post['wall5']) && $post['wall5'] == "") {
							$post['wall5'] = 0;
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

                $h_atk = $herodata['atk'] + 5 * floor($heroarray[0]['attack'] * $herodata['atkp'] / 5);
                $h_di = $herodata['di'] + 5 * floor($heroarray[0]['defence'] * $herodata['dip'] / 5);
                $h_dc = $herodata['dc'] + 5 * floor($heroarray[0]['defence'] * $herodata['dcp'] / 5);
                $h_ob = 1 + 0.002 * $heroarray[0]['attackbonus'];
                $h_db = 1 + 0.002 * $heroarray[0]['defencebonus'];

                return array('heroid'=>$heroarray[0]['heroid'],'unit'=>$heroarray[0]['unit'],'atk'=>$h_atk,'di'=>$h_di,'dc'=>$h_dc,'ob'=>$h_ob,'db'=>$h_db,'health'=>$heroarray['health']);
                }
                
        private function getBattleHeroSim($attbonus) {
        	global $database;
        	$h_atk = 0;
        	$h_ob = 1 + 0.010 * $attbonus;
        	return array('unit'=>16,'atk'=>$h_atk,'ob'=>$h_ob);
        }  
		
        private function simulate($post) {
                //fix by ronix
                //set the arrays with attacking and defending units
                $attacker = array('u1'=>0,'u2'=>0,'u3'=>0,'u4'=>0,'u5'=>0,'u6'=>0,'u7'=>0,'u8'=>0,'u9'=>0,'u10'=>0,'u11'=>0,'u12'=>0,'u13'=>0,'u14'=>0,'u15'=>0,'u16'=>0,'u17'=>0,'u18'=>0,'u19'=>0,'u20'=>0,'u21'=>0,'u22'=>0,'u23'=>0,'u24'=>0,'u25'=>0,'u26'=>0,'u27'=>0,'u28'=>0,'u29'=>0,'u30'=>0,'u31'=>0,'u32'=>0,'u33'=>0,'u34'=>0,'u35'=>0,'u36'=>0,'u37'=>0,'u38'=>0,'u39'=>0,'u40'=>0,'u41'=>0,'u42'=>0,'u43'=>0,'u44'=>0,'u45'=>0,'u46'=>0,'u47'=>0,'u48'=>0,'u49'=>0,'u50'=>0);
                $start = ($post['a1_v']-1)*10+1;
                $index = 1;
                $offhero=intval($post['h_off_bonus']);
                                
                for($i=$start;$i<=($start+9);$i++) {
                        $attacker['u'.$i] = $post['a1_'.$index];
                        if($index <=8) {
                                ${att_ab.$index} = $post['f1_'.$index];
                        }
                        $index += 1;
                }
                
                $defender = array();
                
                for($i=1;$i<=50;$i++) {
                        if(isset($post['a2_'.$i]) && $post['a2_'.$i] != "") {
                                $defender['u'.$i] = $post['a2_'.$i];
                                $def_ab[$i]=$post['f2_'.$i];
                                
                        }
                        else {
                                $defender['u'.$i] = 0;
                                $def_ab[$i]=0;
                        }
                }
                $deftribe = $post['tribe']; //not valid if multi def
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
                if($post['wall1'] != 0){
                $walllevel = $post['wall1'];
                }else if($post['wall2'] != 0){
                $walllevel = $post['wall2'];
                }else if($post['wall3'] != 0){
                $walllevel = $post['wall3'];
                }else if($post['wall4'] != 0){
                $walllevel = $post['wall4'];
                }else if($post['wall5'] != 0){
                $walllevel = $post['wall5'];
                }else{
                $walllevel = 0;
                }
                if($walllevel > 20){
                $walllevel = 0;
                }
                $wall = $walllevel;
                
                if(!$scout) 
        
    			return $this->calculateBattle($attacker,$defender,$wall,$post['a1_v'],$deftribe,$post['palast'],$post['ew1'],$post['ew2'],$post['ktyp']+3,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$post['kata'],$post['stonemason'],$walllevel,$offhero,0,0,0,0);
		else 
   			return $this->calculateBattle($attacker,$defender,$wall,$post['a1_v'],$deftribe,$post['palast'],$post['ew1'],$post['ew2'],1,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$post['kata'],$post['stonemason'],$walllevel,0,0,0,0,0);
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
        function calculateBattle($Attacker,$Defender,$def_wall,$att_tribe,$def_tribe,$residence,$attpop,$defpop,$type,$def_ab,$att_ab1,$att_ab2,$att_ab3,$att_ab4,$att_ab5,$att_ab6,$att_ab7,$att_ab8,$tblevel,$stonemason,$walllevel,$offhero,$AttackerID,$DefenderID,$AttackerWref,$DefenderWref) {
                global $bid34,$bid35,$database;
                //fix by ronix
                
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
        if($Attacker['uhero'] != 0)
        {

          $atkhero = $this->getBattleHero($AttackerID);
        }

        if($Defender['hero'] != 0)
        {

        $defenderhero = $this->getBattleHero($DefenderID);
        }
        //own defender units
        if ($type==1) {
            $datadefScout=$this->getDataDefScout($Defender,$def_ab,$defender_artefact);
            $dp+=$datadefScout['dp'];
            $cdp+=$datadefScout['cdp'];
            $involve=$datadef['involve'];
            if ($datadefScout['detect']==1) $detected = 1;
        }else{
            $datadef=$this->getDataDef($Defender,$def_ab);
            $dp+=$datadef['dp'];
            $cdp+=$datadef['cdp'];
            $involve=$datadef['involve'];
            if($Defender['hero'] != 0){
                $units['Def_unit']['hero'] = $Defender['hero'];
                $cdp += $defenderhero['dc'];
                $dp += $defenderhero['di'];
                $dp = $dp * $defenderhero['db'];
                $cdp = $cdp * $defenderhero['db'];
            }
        }
                
        //get every enforcement in defender village
                
        $DefendersAll = $database->getEnforceVillage($DefenderWref,0);
    
        // Calculates the total points of the Defender
        if(!empty($DefendersAll)){
            foreach($DefendersAll as $defenders) {
                
                for ($i=1;$i<=50;$i++) {$def_ab[$i]=0;}
                $fromvillage = $defenders['from'];
                $enforcetribe = $database->getUserField($database->getVillageField($fromvillage,"owner"),"tribe",0);
                $ud=($enforcetribe-1)*10;                
                if($defenders['from']>1) { //don't check nature tribe
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
                    $datadefScout=$this->getDataDefScout($defenders,$def_ab,$defender_artefact);
                    $dp+=$datadefScout['dp'];
                    $cdp+=$datadefScout['cdp'];
                    $involve=$datadef['involve'];
                    if ($datadefScout['detect']==1) $detected = 1;
                }else{
                    $datadef=$this->getDataDef($defenders,$def_ab);
                    $dp+=$datadef['dp'];
                    $cdp+=$datade['cdp'];
                    $involve=$datadef['involve'];
                    
                }            
                
                $reinfowner = $database->getVillageField($fromvillage,"owner");
                $defhero[$fromvillage] = $this->getBattleHero($reinfowner);
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
        
                if($type == 1) //scout
                {
                        for($i=$start;$i<=$end;$i++) {
                                global ${'u'.$i};
                                $j = $i-$start+1;
                                if($abcount <= 8 && ${att_ab.$abcount} > 0) { 

                                        if(in_array($i,$calvary)) {
                                            $cap += (35 + (35 + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${att_ab.$abcount}) - 1)) * $Attacker['u'.$i];
                                        }
                                        else {
                                            $ap += (35 + (35 + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${att_ab.$abcount}) - 1)) * $Attacker['u'.$i];
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
                                }
                                else {
                                        if(in_array($i,$calvary)) {
                                                $cap += $Attacker['u'.$i]*33;
                                        }
                                        else {
                                                $ap += $Attacker['u'.$i]*30.7;
                                        }                                        
                                }
                                $abcount +=1;
                                $involve += $Attacker['u'.$i];
                                $units['Att_unit'][$i] = $Attacker['u'.$i];
                        }
                        if ($Attacker['uhero'] != 0){
                            $ap += $atkhero['atk'] * 35;
                            $ap = $ap * $atkhero['ob'];
                        }
                }
                else //type=3 normal 4=raid
                {
                $abcount = 1;
                        for($i=$start;$i<=$end;$i++) {
                                global ${'u'.$i};
                                $j = $i-$start+1;
                                if($abcount <= 8 && ${att_ab.$abcount} > 0) {
                                        if(in_array($i,$calvary)) {
                                                $cap += (${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${att_ab.$abcount}) - 1)) * $Attacker['u'.$i];
                                        }
                                        else {
                                                $ap += (${'u'.$i}['atk'] + (${'u'.$i}['atk'] + 300 * ${'u'.$i}['pop'] / 7) * (pow(1.007, ${att_ab.$abcount}) - 1)) * $Attacker['u'.$i];
                                        }
                                }
                                else {
                                        if(in_array($i,$calvary)) {
                                                $cap += $Attacker['u'.$i]*${'u'.$i}['atk'];
                                        }
                                        else {
                                                $ap += $Attacker['u'.$i]*${'u'.$i}['atk'];
                                        }
                                }


                                $abcount +=1;
                                // Points catapult the attacker
                                if(in_array($i,$catapult)) {
                                        $catp += $Attacker['u'.$i];
                                }
                                 // Points of the Rams attacker
                if(in_array($i,$rams))
                {
                    $ram += $Attacker['u'.$i];
                }
                $involve += $Attacker['u'.$i];
                $units['Att_unit'][$i] = $Attacker['u'.$i];
            }

           if ($Attacker['uhero'] != 0)
    	   {
           	$units['Att_unit']['hero'] = $Attacker['uhero'];
           	$ap = $ap * $atkhero['ob'];
           	$cap = $cap * $atkhero['ob'];
    }

    	   if ($offhero!=0) {
        	$atkhero=$this->getBattleHeroSim($offhero);
        	$ap = $ap * $atkhero['ob'];
        	$cap = $cap * $atkhero['ob'];  
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
                        
                        if ($dp>0 || $cdp >0) { //fix by ronix
                            $dp *= pow($factor,$def_wall); 
                        // Defense calvary calvary = * Wall (%)
                            $cdp *= pow($factor,$def_wall); 

                        // Calculation of the Basic defense bonus "Residence" 
                            $dp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
                            $cdp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
                        } else {
                                    
                            $dp = 10*pow($factor,$def_wall); 
                        // Defense calvary calvary = * Wall (%) 
                            
                            $cdp = 10*pow($factor,$def_wall); 

                        // Calculation of the Basic defense bonus "Residence"  
                            $dp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
                            $cdp += ((2*(pow($residence,2)))*(pow($factor,$def_wall))); 
                        }
                } 
                else 
                { 
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

                $result['Winner'] = ($winner)? "attacker" : "defender";

                // Formula for calculating the Moral
                if($attpop > $defpop) {
                        if ($rap < $rdp) {
                                $moralbonus = min(1.5, pow($attpop / $defpop, (0.2*($rap/$rdp))));
                        }
                        else {
                        if($defpop==0){
                                $moralbonus = min(1.5, pow($attpop, 0.2));
                        }else{
                                $moralbonus = min(1.5, pow($attpop / $defpop, 0.2));
                        }
                        }
                }
                else {
                        $moralbonus = 1.0;
                }

                if($involve >= 1000) {
                    $Mfactor = round(2*(1.8592-pow($involve,0.015)),4);
                }
                else {
                    $Mfactor = 1.5;
                }
                if ($Mfactor < 1.25778){$Mfactor=1.25778;}elseif ($Mfactor > 1.5){$Mfactor=1.5;}
                // Formula for calculating lost drives
                // $type = 1 scout, 2?
                // $type = 3 Normal, 4 Raid
                if($type == 1)
                {
                        
                        $holder = pow((($rdp*$moralbonus)/$rap),$Mfactor);
                        $holder = $holder / (1 + $holder);
                        // Attacker
                        $result[1] = $holder;

                        // Defender
                        $result[2] = 0;
                }
                else if($type == 2)
                {

                }
                else if($type == 4) {
                        $holder = ($winner) ? pow((($rdp*$moralbonus)/$rap),$Mfactor) : pow(($rap/($rdp*$moralbonus)),$Mfactor);
                        $holder = $holder / (1 + $holder);
                        // Attacker
                        $result[1] = $winner ? $holder : 1 - $holder;
                        // Defender
                        $result[2] = $winner ? 1 - $holder : $holder;
                        $ram -= round($ram*$result[1]/100);
                        $catp -= round($catp*$result[1]/100);
                }
                else if($type == 3)
        {
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
                                case 1:
                                $fealthy = rand(20,30);
                                break;
                                case 2:
                                $fealthy = rand(40,60);
                                break;
                                case 3:
                                $fealthy = rand(60,80);
                                break;
                                case 4:
                                $fealthy = rand(80,100);
                                break;
                                default:
                                $fealthy = 100;
                                break;
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
            $need = round((($moralbonus * (pow($tblevel,2) + $tblevel + 1)) / (8 * (round(200 * pow(1.0205,$att_ab8))/200) / $strongerbuildings / $good_effect * $bad_effect)) + 0.5);
            }else{
            $need = round((($moralbonus * (pow($tblevel,2) + $tblevel + 1)) / (8 * (round(200 * pow(1.0205,$att_ab8))/200) / ($bid34[$stonemason]['attri']/100) / $strongerbuildings / $good_effect * $bad_effect)) + 0.5);
            }
            // Number catapults to take down the building
            $result[3] = $need;
            //Number catapults nego
            $result[4] = $wctp;
            $result[5] = $moralbonus;
            $result[6] = $att_ab['a8'];
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

        for($i=$start;$i <= $end;$i++)
        {
            $y = $i-(($att_tribe-1)*10);
            $result['casualties_attacker'][$y] = round($result[1]*$units['Att_unit'][$i]);

        }

        if ($units['Att_unit']['hero']>0)
        {

            $_result=mysql_query("select * from " . TB_PREFIX . "hero where `dead`='0' and `heroid`='".$atkhero['heroid']."'");
            $fdb = mysql_fetch_array($_result);
            $hero_id=$fdb['heroid'];
            $hero_health=$fdb['health'];
            $damage_health=round(100*$result[1]);
            
            if ($hero_health<=$damage_health or $damage_health>90)
            {
                //hero die
                $result['casualties_attacker']['11'] = 1;
                mysql_query("update " . TB_PREFIX . "hero set `dead`='1' where `heroid`='".$hero_id."'");
                mysql_query("update " . TB_PREFIX . "hero set `health`='0' where `heroid`='".$hero_id."'");
            }
            else
            {
                mysql_query("update " . TB_PREFIX . "hero set `health`=`health`-".$damage_health." where `heroid`='".$hero_id."'");
            }
        }
            unset($_result,$fdb,$hero_id,$hero_health,$damage_health);


        if ($units['Def_unit']['hero']>0)
        {

            $_result=mysql_query("select * from " . TB_PREFIX . "hero where `dead`='0' and `heroid`='".$defenderhero['heroid']."'");
            $fdb = mysql_fetch_array($_result);
            $hero_id=$fdb['heroid'];
            $hero_health=$fdb['health'];
            $damage_health=round(100*$result[2]);
            if ($hero_health<=$damage_health or $damage_health>90)
            {
                //hero die
                $result['deadherodef'] = 1;
                mysql_query("update " . TB_PREFIX . "hero set `dead`='1' where `heroid`='".$hero_id."'");
                mysql_query("update " . TB_PREFIX . "hero set `health`='0' where `heroid`='".$hero_id."'");
            }
            else
            {
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
            if ($hero_health<=$damage_health or $damage_health>90)
            {
                //hero die
                $result['deadheroref'][$defenders['id']] = 1;
                mysql_query("update " . TB_PREFIX . "hero set `dead`='1' where `heroid`='".$hero_id."'");
                mysql_query("update " . TB_PREFIX . "hero set `health`='0' where `heroid`='".$hero_id."'");
            }
            else
            {
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
        
                public function getDataDefScout($defenders,$def_ab,$defender_artefact) {
            global $database;
            //fix by ronix            
            for($y=4;$y<=44;$y++) {
                if($y == 4 || $y == 14 || $y == 23 || $y == 44){
                    global ${'u'.$y};
                                                            
                    if($defenders['u'.$y]>0 && $def_ab[$y] > 0) {
                        $dp +=  (${'u'.$y}['di'] + (${'u'.$y}['di'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1)) * $defenders['u'.$y] * $defender_artefact;;
                        $cdp += (${'u'.$y}['dc'] + (${'u'.$y}['dc'] + 300 * ${'u'.$y}['pop'] / 7) * (pow(1.007, $def_ab[$y]) - 1)) * $defenders['u'.$y] * $defender_artefact;;
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
                        $dp += $defenders['u'.$y]*${'u'.$y}['di'];
                        $cdp += $defenders['u'.$y]*${'u'.$y}['dc'];
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
            //fix by ronix            
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

		public function resolveConflict($data) {
				global $database,$units,$unitsbytype;
				$UnitChief = $UnitRam = $UnitCatapult = 0;
				$attacker_count = $attack_infantry = $attack_cavalry = $attack_scout = $rams = $catapults = 0;
				$defender_count = $defense_infantry = $defense_cavalry = $defense_scout = $defense_heros = 0;
				$DefenderFieldsArray = $ResourceImprovementArray = $TrapperArray = array();
				$FieldPalRes = $BonusPalRes = $BonusStoneMason = $BonusArtefactDurability = 0;
				$ExperienceAttacker = $ExperienceDefender = 0;
				$RecountReqd = $AllDefendersDead = False;

				$AttackArrivalTime = $data['endtime'];
				$AttackerData = $database->getVillageBattleData($data['from']);
				$AttackerData['pop'] = $database->getPopulation($AttackerData['id']);
				$Blacksmith = $database->getABTech($data['from']);

				for($i=1;$i<=11;$i++) {        $attacker_count += $data['t'.$i]; }
				if($data['type'] != 1) {
						// Trap attacking troops if this is not a scouting mission
				}

				for($i=1;$i<=10;$i++) {
						if($data['t'.$i] > 0) {
								$unit = ($AttackerData['tribe']-1)*10+$i;
								$unitdata = $GLOBALS['u'.$unit];
								if(in_array($unit,$unitsbytype['cavalry'])) {
										$attack_cavalry += $data['t'.$i] * ($unitdata['atk'] + ($unitdata['atk'] + 300 * $unitdata['pop'] / 7) * (pow(1.007,$Blacksmith['b'.$i]) - 1));
								} else {
										$attack_infantry += $data['t'.$i] * ($unitdata['atk'] + ($unitdata['atk'] + 300 * $unitdata['pop'] / 7) * (pow(1.007,$Blacksmith['b'.$i]) - 1));
								}
								if(in_array($unit,$unitsbytype['scout'])) {
										$attack_scout = $data['t'.$i] * 35 * pow(1.021,$Blacksmith['b'.$i]);
								}
								if(in_array($unit,$unitsbytype['chief'])) { $UnitChief = $i; }
								if(in_array($unit,$unitsbytype['ram'])) { $UnitRam = $i; }
								if(in_array($unit,$unitsbytype['catapult'])) { $UnitCatapult = $i; }
						}
				}
				if($data['t11'] == 1 && $data['type'] != 1) {
						$heroarrayAttacker = $this->getBattleHero($AttackerData['id']);
						if(in_array($heroarrayAttacker['unit'],$unitsbytype['cavalry'])) {
								$attack_cavalry += $heroarrayAttacker['atk'];
						} else {
								$attack_infantry += $heroarrayAttacker['atk'];
						}
						$attack_infantry *= $heroarrayAttacker['ob'];
						$attack_cavalry *= $heroarrayAttacker['ob'];
				}
				$attack_total = $attack_infantry + $attack_cavalry;
				if($attacker_count == 1 && $attack_total < 83 && $data['type'] != 1) {
						// kill the single non-scout low level attacker due to basic village defense
				}

				if ($database->isVillageOases($id) == 0) {
						$DefenderData = $database->getVillageBattleData($data['to']);
						$DefenderData['pop'] = $database->getPopulation($DefenderData['id']);
						$IsOasis = False;
				} else {
						$OasisData = $database->getOMInfo($data['to']);
						$IsOasis = True;
						if($OasisData['conqured'] == 0) {
								$DefenderData['pop'] = 500;
						} else {
								$DefenderData['pop'] = $database->getPopulation($OasisData['conqured']);
						}
						$DefenderData['tribe'] = 4;
						$DefenderData['wall'] = 0;
				}
				$DefenderUnits = $database->getUnit($data['to']);
				$DefendersAll = $database->getEnforceVillage($data['to'],0);
				array_unshift($DefendersAll,$DefenderUnits);
				foreach($DefendersAll as $defenders) {
						$definf = $defcav = 0;
						if(!empty($Armoury)) { reset($Armoury); }
						$Armoury = $defenders['from'] != $defenders['vref'] ? $database->getABTech($defenders['from']) : $database->getABTech($defenders['vref']);
						for($i=1;$i<=50;$i++) {
								if($defenders['u'.$i] > 0) {
										if(!empty($unitdata)) { reset($unitdata); }
										$unitdata = $GLOBALS['u'.$i];
										$definf += $defenders['u'.$i] * ($unitdata['di'] + ($unitdata['di'] + 300 * $unitdata['pop'] / 7) * (pow(1.007,$Armoury['a'.($i%10)]) - 1));
										$defcav += $defenders['u'.$i] * ($unitdata['dc'] + ($unitdata['dc'] + 300 * $unitdata['pop'] / 7) * (pow(1.007,$Armoury['a'.($i%10)]) - 1));
										if(in_array($i,$unitsbytype['scout'])) {
												$defense_scout += $defenders['u'.$i] * 20 * pow(1.03,$Armoury['a'.($i%10)]);
										}
										$defender_count += $defenders['u'.$i];
								}
						}
						if($defenders['hero'] == 1 && $data['type'] != 1) {
								if(!empty($heroarray)) { reset($heroarray); }
								if($defenders['vref'] == $data['to']) {
										$heroarraydefender = $this->getBattleHero($DefenderData['id']);
								} else {
										$ReinforcerData = $database->getVillageBattleData($defenders['from']);
										$heroarraydefender = $this->getBattleHero($ReinforcerData['id']);
								}
								$definf = ($definf + $heroarraydefender['di']) * $heroarraydefender['db'];
								$defcav = ($defcav + $heroarraydefender['dc']) * $heroarraydefender['db'];
								$defense_heros++;
						}
						$defense_infantry += $definf;
						$defense_cavalry += $defcav;
				}

				if($data['type'] == 1) {
						if($attack_scout > $defense_scout) {
								$attack_scout_casualties = pow(($defense_scout / $attack_scout),1.5);
								// generate scout report and process casualties
						} else {
								$attack_scout_casualties = 1;
								// kill all scouts
						}
				} else {
						$defense_total = $attack_infantry * $defense_infantry / $attack_total + $attack_cavalry * $defense_cavalry / $attack_total;

						if($DefenderData['pop'] < $AttackerData['pop']) {
								$defense_total *= min(1.5,pow($AttackerData['pop']/$DefenderData['pop'],0.2));
						}

						$DefenderFields = $database->getResourceLevel($data['to']);
						for($i=1;$i<=38;$i++) {
								if($DefenderFields['f'.$i] > 0) { $DefenderFieldsArray[] = $i; }
								if($DefenderFields['f'.$i.'t'] == 25 || $DefenderFields['f'.$i.'t'] == 26) {
										$BonusPalRes = 2 * pow($DefenderFields['f'.$i],2);
										$FieldPalRes = $i;
								}
								if($DefenderFields['f'.$i.'t'] == 34) {
										$BonusStoneMason = $DefenderFields['f'.$i] / 10 + 1;
								}
								if($DefenderFields['f'.$i.'t'] >= 5 && $DefenderFields['f'.$i.'t'] <= 9) {
										$ResourceImprovementArray[] = $i;
								}
								if($DefenderFields['f'.$i.'t'] == 36) {
										$TrapperArray[] = $i;
								}
								if($DefenderFields['f'.$i.'t'] == $data['ctar1'] && $data['ctar1'] != 0) {
										$ctarf[1] = $i;
								}
								if($DefenderFields['f'.$i.'t'] == $data['ctar2'] && $data['ctar2'] != 0 && ($data['ctar1'] != $data['ctar2'] || $data['ctar2'] <= 18)) {
										$ctarf[2]= $i;
								}
						}
						$defense_total += $BonusPalRes;

						$BonusWall = $DefenderData['tribe'] == 1 ? 1.03 : ($DefenderData['tribe'] == 2 ? 1.02 : 1.025);
						$defense_total *= pow($BonusWall,$DefenderData['wall']);

						if($attacker_count + $defender_count + $defense_heros > 1000) {
								$DiffModifier = 2 * (1.8592 - pow(($attacker_count + $defender_count + $defense_heros),0.015));
						} else {
								$DiffModifier = 1.5;
						}
						$attack_casualties = $defense_casualties = 1;
						if($attack_total > $defense_total) {
								$attack_casualties = pow(($defense_total / $attack_total),$DiffModifier);
								if($data['type'] == 4) {
										$attack_casualties = $attack_casualties / (1 + $attack_casualties);
										$defense_casualties = 1 - $attack_casualties;
								}
						} else {
								$defense_casualties = pow(($attack_total / $defense_total),$DiffModifier);
								if($data['type'] == 4) {
										$defense_casualties = $defense_casualties / (1 + $defense_casualties);
										$attack_casualties = 1 - $defense_casualties;
								}
						}

						if($rams > 0 && $DefenderData['wall'] > 0) {
								if($attack_casualties < 1) {
										$database->setVillageLevel($data['to'],'f40t',0);
										$database->setVillageLevel($data['to'],'f40',0);
								} else {
										$RequiredRams=array(1=>array(1,2,2,3,4,6,7,10,12,14,17,20,23,27,31,35,39,43,48,53),array(1,4,8,13,19,27,36,46,57,69,83,98,114,132,151,171,192,214,238,263),array(1,2,4,6,8,11,15,19,23,28,34,40,46,53,61,69,77,86,96,106));
										$DC = max(1,$BonusStoneMason) * max(1,$BonusPalRes) / (pow(1.015,$Blacksmith['b'.$UnitRam])) ;
										$L = $DefenderData['wall'];
										$L2 = round(($DefenderData['wall'] - 1) /2);
										$DDR = $DC / ( $L*($L+1)/8 + 5 + (24.875 + 0.625*$L2)*$L2/2 );
										//calculate damage to wall based on surviving rams
								}
								$RecountReqd = True;
						}
						if($catapults > 0 && !$IsOasis) {
								$BuildLevelStrength=array(1=>1,2,2,3,4,6,8,10,12,14,17,20,23,27,31,35,39,43,48,53);
								$RequiredCatapults = $RequiredCatapultsMax = $BuildingLevelMax = array();
								if(!empty($RequiredCatapults)) { reset($RequiredCatapults); }
								for($i=1;$i<=2;$i++) {
										if($data['ctar'.$i] == 0 || $ctarf[$i] == 0) {
												$data['ctar'.$i] = $DefenderFieldsArray[rand(0,count($DefenderFieldsArray)-1)];
												if($data['ctar2'] == 0 && $i == 1) { $data['ctar2'] = $data['ctar1']; }
										}
										$RequiredCatapults[$i] = round((($DefenderData['pop'] < $AttackerData['pop'] ? min(3,pow($AttackerData['pop'] / $DefenderData['pop'],0.3)) : 1) * (pow($DefenderField['f'.$ctarf[$i]],2) + $DefenderField['f'.$ctarf[$i]] + 1) / (8 * (round(200 * pow(1.0205,$Blacksmith['b'.$UnitCatapult])) / 200) / max(1,($data['ctar'.$i]>=18?max(1,$BonusStoneMason + $BonusArtefactDurability):1)))) + 0.5);
										$BuildingLevelMax[$i] = 20;
										if($DefenderData['capital'] != 1 && $data['ctar'.$i] <= 18 || in_array($data['ctar'.$i],$TrapperArray)) { $BuildingLevelMax[$i] = 10; }
										if(in_array($data['ctar'.$i],$ResourceImprovementArray)) { $BuildingLevelMax[$i] = 5; }
										$RequiredCatapultsMax[$i] = round((($DefenderData['pop'] < $AttackerData['pop'] ? min(3,pow($AttackerData['pop'] / $DefenderData['pop'],0.3)) : 1) * (pow($BuildingLevelMax[$i],2) + $BuildingLevelMax[$i] + 1) / (8 * (round(200 * pow(1.0205,$Blacksmith['b'.$UnitCatapult])) / 200) / max(1,($data['ctar'.$i]>=18?max(1,$BonusStoneMason + $BonusArtefactDurability):1)))) + 0.5);
								}
								$CatapultsFiring = pow($attack_total / $defense_total,1.5);
								if($CatapultsFiring > 1) {
										$CatapultsFiring = 1 - 0.5 / $CatapultsFiring;
								} else {
										$CatapultsFiring = 0.5 * $CatapultsFiring;
								}
								$CatapultsFiring *= $data['t'.$UnitCatapult];
								for($i=1;$i=($data['ctar1']==$data['ctar2']?1:2);$i++) {
										$BuildingLevelOld[$i] = $DefenderField['f'.$data['ctar'.$i]];
										if($data['ctar1']!=$data['ctar2'] && $i==1) { $CatapultsFiring /= 2; }
										if($CatapultsFiring >= $RequiredCatapults[$i]) {
												if($DefenderField['f'.$data['ctar'.$i]] == $FieldPalRes) { $DestroyedPalRes = True; }
												if($data['ctar'.$i] >= 19) { $database->setVillageLevel($data['to'],'f'.$data['ctar'.$i].'t',0); }
												$database->setVillageLevel($data['to'],'f'.$data['ctar'.$i],0);
												$BuildingLevelNow[$i] = 0;
												$RecountReqd = True;
										} else {
												$BuildLevelCount = 0;
												for($j=$DefenderField['f'.$data['ctar'.$i]];$j=1;$j--) {
														$BuildLevelCount += ($BuildLevelStrength[$j] - $BuildLevelStrength[$j-1]) * $RequiredCatapultsMax[$i] / $BuildLevelStrength[$BuildingLevelMax[$i]];
														if($CatapultsFiring < $BuildLevelCount) {
																$BuildingLevelNow[$i] = $j;
																break;
														}
														$database->setVillageLevel($data['to'],'f'.$data['ctar'.$i],$BuildingLevelNow[$i]);
														$RecountReqd = True;
												}
										}
								}
						}

						for($i=1;$i<=10;$i++) {
								$attack_casualties_array[$i] = round($data['t'.$i] * $attack_casualties);
								if(!empty($unitdata)) { reset($unitdata); }
								$unitdata = $GLOBALS['u'.(($AttackerData['tribe']-1)*10+$i)];
								$ExperienceDefender += $attack_casualties_array[$i] * $unitdata['pop'];
						}
						if($data['t11'] == 1) {
								if($attack_casualties < 0.9) {
										if($heroarrayAttacker['health']-100*$attack_casualties > 0) {
												$database->modifyHero('health',(100*$attack_casualties),$heroarrayAttacker['heroid'],2);
												$database->modifyHero('lastupdate',time(),$heroarrayAttacker['heroid'],0);
										} else {
												$database->modifyHero('health',0,$heroarrayAttacker['heroid'],0);
												$database->modifyHero('dead',1,$heroarrayAttacker['heroid'],0);
												$database->modifyHero('lastupdate',time(),$heroarrayAttacker['heroid'],0);
										}
								} else {
										$database->modifyHero('health',0,$heroarrayAttacker['heroid'],0);
										$database->modifyHero('dead',1,$heroarrayAttacker['heroid'],0);
										$database->modifyHero('lastupdate',time(),$heroarrayAttacker['heroid'],0);
								}
						}
				$DefenderUnits = $database->getUnit($data['to']);
				$DefendersAll = $database->getEnforceVillage($data['to'],0);
				array_unshift($DefendersAll,$DefenderUnits);
				foreach($DefendersAll as $defenders) {
						if($defenders['hero'] == 1 && $data['type'] != 1) {
								if(!empty($heroarray)) { reset($heroarray); }
								if($defenders['vref'] == $data['to']) {
										$heroarraydefender = $this->getBattleHero($DefenderData['id']);
								} else {
										$ReinforcerData = $database->getVillageBattleData($defenders['from']);
										$heroarraydefender = $this->getBattleHero($ReinforcerData['id']);
								}
								if($defense_casualties < 0.9) {
										if($heroarrayDefender['health']-100*$defense_casualties > 0) {
												$database->modifyHero('health',(100*$defense_casualties),$heroarrayDefender['heroid'],2);
												$database->modifyHero('lastupdate',time(),$heroarrayDefender['heroid'],0);
										} else {
												$database->modifyHero('health',0,$heroarrayDefender['heroid'],0);
												$database->modifyHero('dead',1,$heroarrayDefender['heroid'],0);
												$database->modifyHero('lastupdate',time(),$heroarrayDefender['heroid'],0);
										}
								} else {
										$database->modifyHero('health',0,$heroarrayDefender['heroid'],0);
										$database->modifyHero('dead',1,$heroarrayDefender['heroid'],0);
										$database->modifyHero('lastupdate',time(),$heroarrayDefender['heroid'],0);
								}
						}
				}
						// send surviving attackers and hero home, report.
						// calculate defensive casualties, hero damage and experience (all heroes), modify units and reinforcements, report.
						// damage buildings report

						// Chiefing logic including wall and tribal specific building removal

						if($IsOasis && $data['t11'] == 1 && $AllDefendersDead) {
								$database->modifyOasisLoyalty($data['to']);
								if($database->canConquerOasis($data['from'],$data['to'])) {
										$database->conquerOasis($data['to'],$data['from'],$AttackerData['id']);
								}
						}

						if($RecountReqd) { $automation->recountPop($data['to']); }
				}
		}

};

$battle = new Battle;
?>
