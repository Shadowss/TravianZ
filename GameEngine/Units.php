<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       Units.php                                                   ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

class Units {
    public $sending,$recieving,$return = array();

    public function procUnits($post) {
        if(isset($post['c'])) {
            if (!isset($post['disabled'])) {
                $post['disabled'] = '';
            }

            switch($post['c']) {

                case "1":
                if (isset($post['a'])&& $post['a']==533374){
                $this->sendTroops($post);
                }else{
                $post = $this->loadUnits($post);
                return $post;
                }
                break;

                case "2":
                if (isset($post['a'])&& $post['a']==533374 && $post['disabled'] == ""){
                $this->sendTroops($post);
                }else{
                $post = $this->loadUnits($post);
                return $post;
                }
                break;

                case "8":
                $this->sendTroopsBack($post);
                break;

                case "3":
                if (isset($post['a'])&& $post['a']==533374 && $post['disabled'] == ""){
                $this->sendTroops($post);
                }else{
                $post = $this->loadUnits($post);
                return $post;
                }
                break;

                case "4":
                if (isset($post['a'])&& $post['a']==533374){
                    $this->sendTroops($post);
                }else{
                $post = $this->loadUnits($post);
                return $post;
                }

                case "5":
                if (isset($post['a'])&& $post['a']== "new"){
                    $this->Settlers($post);
                }else{
                $post = $this->loadUnits($post);
                return $post;
                }
                break;
            }
        }
    }
    private function loadUnits($post) {
        global $database,$village,$session,$generator,$logging,$form;
                // Search by town name
                // Coordinates and look confirm name people
        if(isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") {
            $vid = $database->getVilWref($post['x'],$post['y']);
            unset($post['dname']);
            unset($_POST['dname']);
        }else if(isset($post['dname']) && $post['dname']!=""){
            $vid = $database->getVillageByName(stripslashes($post['dname']));
        }
        if (!empty($vid)) {
            if($database->isVillageOases($vid) != 0){
                $too = $database->getOasisField($vid,"conqured");
                if($too == 0){
                    $disabledr ="disabled=disabled"; $disabled ="disabled=disabled";
                }else{
                    $disabledr ="";
                    if($session->sit == 0){
                        $disabled ="";
                    }else{
                        $disabled ="disabled=disabled";
                    }
                }
            }else{
                $too = $database->getVillage($vid);
                if($too['owner'] == 3){
                    $disabledr ="disabled=disabled"; $disabled ="";
                }else{
                    $disabledr ="";
                    if($session->sit == 0){
                        $disabled ="";
                    }else{
                        $disabled ="disabled=disabled";
                    }
                }
            }
        }else{
            $disabledr ="";
            if($session->sit == 0){
                $disabled ="";
            }else{
                $disabled ="disabled=disabled";
            }
        }
                if($disabledr != "" && $post['c'] == 2){
                $form->addError("error","You can't reinforce this village/oasis");
                }
                if($disabled != "" && $post['c'] == 3){
                $form->addError("error","You can't attack this village/oasis with normal attack");
                }
                if(empty($post['t1']) && empty($post['t2']) &&  empty($post['t3']) && empty($post['t4']) && empty($post['t5']) &&
                    empty($post['t6']) && empty($post['t7']) &&  empty($post['t8']) && empty($post['t9']) && empty($post['t10']) &&  empty($post['t11'])){
                $form->addError("error","You need to mark min. one troop");
                }

                if(!empty($post['dname']) && !empty($post['x']) && !empty($post['y'])){
                $form->addError("error","Insert name or coordinates");
                }

                if(isset($post['dname']) && $post['dname'] != "") {
                    $id = $database->getVillageByName(stripslashes($post['dname']));
                    if (!isset($id)){
                    $form->addError("error","Village do not exist");
                    }else{
                    $coor = $database->getCoor($id);
                    }
                }
		
                // People search by coordinates
                // We confirm and seek coordinate coordinates Village
        if(isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") {
            $coor = array('x'=>$post['x'], 'y'=>$post['y']);
            $id = $generator->getBaseID($coor['x'],$coor['y']);
            if (!$database->getVillageState($id)){
                $form->addError("error","Coordinates do not exist");
            }
        }   
        if (!empty($coor)) {    
            if ($session->tribe == 1){$Gtribe = "";}elseif  ($session->tribe == 2){$Gtribe = "1";}elseif ($session->tribe ==  3){$Gtribe = "2";}elseif ($session->tribe == 4){$Gtribe = "3";}elseif  ($session->tribe == 5){$Gtribe = "4";}
            for($i=1; $i<12; $i++){
                if(isset($post['t'.$i])){
                    if ($i<10) $troophave=$village->unitarray['u'.$Gtribe.$i];
                    if ($i==10)$troophave=$village->unitarray['u'.floor(intval($Gtribe)+1)*$i];
                    if ($i==11)$troophave=$village->unitarray['hero'];
                                        
                    if (intval($post['t'.$i]) > $troophave){
                        $form->addError("error","You can't send more units than you have");
                        break;
                    }
                    if(intval($post['t'.$i])<0){
                        $form->addError("error","You can't send negative units.");
                        break;
                    }
                    if(preg_match('/[^0-9]/',$post['t'.$i])){
                        $form->addError("error","Special characters can't entered");
                        break;
                    } 
                }
            }
        }
                if (isset($id) && $database->isVillageOases($id) == 0) {
                if($database->hasBeginnerProtection($id)==1) {
                    $form->addError("error","Player is under beginners protection. You can't attack him");
                }

                //check if banned/admin:
                $villageOwner = $database->getVillageField($id,'owner');
                $userAccess = $database->getUserField($villageOwner,'access',0);
                $userID = $database->getUserField($villageOwner,'id',0);
                if($userAccess == '0' or ($userAccess == MULTIHUNTER && $userID == 5) or (!ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN)){
                                $form->addError("error","Player is Banned. You can't attack him");
                                //break;
                    }
                //check if vacation mode:
                    if($database->getvacmodexy($id)){
                                $form->addError("error","User is on vacation mode");
                                //break;
                    }

                //check if attacking same village that units are in
                    if($id == $village->wid){
                                $form->addError("error","You cant attack same village you are sending from.");
                                //break;
                    }
                // We process the array with the errors given in the form
                if($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: a2b.php");
                    exit;
                }else{
                // We must return an array with $ post, which contains all the data more
                // another variable that will define the flag is raised and is being sent and the type of shipping
                $villageName = $database->getVillageField($id,'name');
                $speed= 300;
                $timetaken = $generator->procDistanceTime($coor,$village->coor,INCREASE_SPEED,1);
                array_push($post, "$id", "$villageName", "$villageOwner","$timetaken");
                return $post;

            }
                  }else{

                      if($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: a2b.php");
                    exit;
                } else if (isset($id)) {
                $villageName = $database->getOasisField($id,"name");
                $speed= 300;
                $timetaken = $generator->procDistanceTime($coor,$village->coor,INCREASE_SPEED,1);
                array_push($post, "$id", "$villageName", "2","$timetaken");
                return $post;

            }
                  }

    }
    
    public function returnTroops($wref,$mode=0) {
        global $database;
        if (!mode) {
            $getenforce=$database->getEnforceVillage($wref,0);
            foreach($getenforce as $enforce) {
                $this->processReturnTroops($enforce);    
            }
        }    
        //check oasis
        $getenforce1=$database->getOasisEnforce($wref,1);
        foreach($getenforce1 as $enforce) {
            $this->processReturnTroops($enforce);
        }
        //set oasis to default
        if (count($getenforce1)>0) {
            $database->regenerateOasisUnits($getenforce1[0]['vref']);
        }    
    }

    private function processReturnTroops($enforce) {
        global $database, $generator;
        $to = $database->getVillage($enforce['from']);
        $Gtribe = "";
        if ($database->getUserField($to['owner'],'tribe',0) ==  '2'){ $Gtribe = "1"; }
        else if ($database->getUserField($to['owner'],'tribe',0) == '3'){ $Gtribe =  "2"; }
        else if ($database->getUserField($to['owner'],'tribe',0) ==  '4'){ $Gtribe = "3"; }
        else if  ($database->getUserField($to['owner'],'tribe',0) == '5'){ $Gtribe =  "4"; }
                    
        $start = ($database->getUserField($to['owner'],'tribe',0)-1)*10+1;
        $end = ($database->getUserField($to['owner'],'tribe',0)*10);

        $from = $database->getVillage($enforce['from']);
        $fromcoor = $database->getCoor($enforce['from']);
        $tocoor = $database->getCoor($enforce['vref']);
        $fromCor = array('x'=>$tocoor['x'], 'y'=>$tocoor['y']);
        $toCor = array('x'=>$fromcoor['x'], 'y'=>$fromcoor['y']);

        $speeds = array();

        //find slowest unit.
        for($i=$start;$i<=$end;$i++){
        
            if(intval($enforce['u'.$i]) > 0){
                if($unitarray) { reset($unitarray); }
                $unitarray = $GLOBALS["u".$i];
                $speeds[] = $unitarray['speed'];
            }else{
                $enforce['u'.$i]='0';
            }
        }
        if( intval($enforce['hero']) > 0){
            $hero_unit = $database->getHeroField($from['owner'], 'unit');
            $speeds[]  = $GLOBALS['u'.$hero_unit]['speed'];
        }else{
            $enforce['hero']='0';
        }
            
        $artefact = count($database->getOwnUniqueArtefactInfo2($from['owner'],2,3,0));
        $artefact1 = count($database->getOwnUniqueArtefactInfo2($enforce['from'],2,1,1));
        $artefact2 = count($database->getOwnUniqueArtefactInfo2($from['owner'],2,2,0));
        if($artefact > 0){
            $fastertroops = 3;
        }else if($artefact1 > 0){
            $fastertroops = 2;
        }else if($artefact2 > 0){
            $fastertroops = 1.5;
        }else{
            $fastertroops = 1;
        }
        $time = round($generator->procDistanceTime($fromCor,$toCor,min($speeds),$enforce['from'])/$fastertroops);
            
        $foolartefact2 = $database->getFoolArtefactInfo(2,$enforce['from'],$from['owner']);
        if(count($foolartefact2) > 0){
            foreach($foolartefact2 as $arte){
                if($arte['bad_effect'] == 1){
                    $time *= $arte['effect2'];
                }else{
                    $time /= $arte['effect2'];
                    $time = round($time);
                }
            }
        }
        $reference =  $database->addAttack($enforce['from'],$enforce['u'.$start],$enforce['u'.($start+1)],$enforce['u'.($start+2)],$enforce['u'.($start+3)],$enforce['u'.($start+4)],$enforce['u'.($start+5)],$enforce['u'.($start+6)],$enforce['u'.($start+7)],$enforce['u'.($start+8)],$enforce['u'.($start+9)],$enforce['hero'],2,0,0,0,0);
        $database->addMovement(4,$enforce['vref'],$enforce['from'],$reference,time(),($time+time()));
        $database->deleteReinf($enforce['id']);
    }
    
    private function sendTroops($post) {
        global $form, $database, $village, $generator, $session;

        $data   = $database->getA2b( $post['timestamp_checksum'], $post['timestamp'] );
        $Gtribe = "";

        if ( $session->tribe == '2' ) {
            $Gtribe = "1";
        } else if ( $session->tribe == '3' ) {
            $Gtribe = "2";
        } else if ( $session->tribe == '4' ) {
            $Gtribe = "3";
        } else if ( $session->tribe == '5' ) {
            $Gtribe = "4";
        }

        for ( $i = 1; $i < 10; $i ++ ) {
            if ( isset( $data[ 'u' . $i ] ) ) {

                if ( $data[ 'u' . $i ] > $village->unitarray[ 'u' . $Gtribe . $i ] ) {
                    $form->addError( "error", "You can't send more units than you have" );
                    break;
                }

                if ( $data[ 'u' . $i ] < 0 ) {
                    $form->addError( "error", "You can't send negative units." );
                    break;
                }

            }
        }

        if ( $data['u11'] > $village->unitarray['hero'] ) {
            $form->addError( "error", "You can't send more units than you have" );
        }

        if ( $data['u11'] < 0 ) {
            $form->addError( "error", "You can't send negative units." );
        }

        if ( $form->returnErrors() > 0 ) {
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;
            header( "Location: a2b.php" );
            exit;
        } else {
            if ( $session->access != BANNED ) {
                if ( $session->tribe == 1 ) {
                    $u = "";
                } elseif ( $session->tribe == 2 ) {
                    $u = "1";
                } elseif ( $session->tribe == 3 ) {
                    $u = "2";
                } elseif ( $session->tribe == 4 ) {
                    $u = "3";
                } else {
                    $u = "4";
                }

                $database->modifyUnit(
                    $village->wid,
                    array(
                        $u . "1",
                        $u . "2",
                        $u . "3",
                        $u . "4",
                        $u . "5",
                        $u . "6",
                        $u . "7",
                        $u . "8",
                        $u . "9",
                        $u . $session->tribe . "0",
                        "hero"
                    ),
                    array(
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
                    ),
                    array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 )
                );

                $data21 = $database->getUserField( $database->getVrefField( $village->wid, 'owner' )['owner'], 'tribe', 0 );
                $eigen  = $database->getCoor( $village->wid );
                $from   = array( 'x' => $eigen['x'], 'y' => $eigen['y'] );
                $ander  = $database->getCoor( $data['to_vid'] );
                $to     = array( 'x' => $ander['x'], 'y' => $ander['y'] );
                $start  = ( $data21['tribe'] - 1 ) * 10 + 1;
                $end    = ( $data21['tribe'] * 10 );

                $speeds = array();
                $scout  = 1;

                //find slowest unit.
                for ( $i = 1; $i <= 10; $i ++ ) {
                    if ( isset( $data[ 'u' . $i ] ) ) {
                        if ( $data[ 'u' . $i ] != '' && $data[ 'u' . $i ] > 0 ) {
                            if ( $unitarray ) {
                                reset( $unitarray );
                            }
                            $unitarray = $GLOBALS[ "u" . ( ( $session->tribe - 1 ) * 10 + $i ) ];
                            $speeds[]  = $unitarray['speed'];
                        }
                    }
                }
                if ( isset( $data['u11'] ) ) {
                    if ( $data['u11'] != '' && $data['u11'] > 0 ) {
                        $heroarray = $database->getHero( $session->uid );
                        $herodata  = $GLOBALS[ "u" . $heroarray[0]['unit'] ];
                        $speeds[]  = $herodata['speed'];
                    }
                }
                $artefact  = count( $database->getOwnUniqueArtefactInfo2( $session->uid, 2, 3, 0 ) );
                $artefact1 = count( $database->getOwnUniqueArtefactInfo2( $village->wid, 2, 1, 1 ) );
                $artefact2 = count( $database->getOwnUniqueArtefactInfo2( $session->uid, 2, 2, 0 ) );
                if ( $artefact > 0 ) {
                    $fastertroops = 3;
                } else if ( $artefact1 > 0 ) {
                    $fastertroops = 2;
                } else if ( $artefact2 > 0 ) {
                    $fastertroops = 1.5;
                } else {
                    $fastertroops = 1;
                }
                $time         = round( $generator->procDistanceTime( $from, $to, min( $speeds ), 1 ) / $fastertroops );
                $foolartefact = $database->getFoolArtefactInfo( 2, $village->wid, $session->uid );
                if ( count( $foolartefact ) > 0 ) {
                    foreach ( $foolartefact as $arte ) {
                        if ( $arte['bad_effect'] == 1 ) {
                            $time *= $arte['effect2'];
                        } else {
                            $time /= $arte['effect2'];
                            $time = round( $time );
                        }
                    }
                }
                $to_owner = $database->getVillageField( $data['to_vid'], "owner" );
                // Check if have WW owner have artefact Rivals great confusion or Artefact of the unique fool with that effect
                // If is a WW village you can target on WW , if is not a WW village catapults will target randomly.
                // Like it says : Exceptions are the WW which can always be targeted and the treasure chamber which can always be targeted, except with the unique artifact.
                // Fixed by Advocaite and Shadow
                $q       = mysqli_fetch_array( mysqli_query( $GLOBALS['link'], "SELECT Count(*) as Total FROM " . TB_PREFIX . "fdata WHERE f99t = '40' AND vref = " . (int) $data['to_vid'] ), MYSQLI_ASSOC );
                $isThere = $q['Total'];
                if ( $isThere > 0 ) {
                    $iswwvilla     = 1;
                    $artefact_2    = count( $database->getOwnUniqueArtefactInfo2( $to_owner, 7, 3, 0 ) );
                    $artefact1_2   = count( $database->getOwnUniqueArtefactInfo2( $data['to_vid'], 7, 1, 1 ) );
                    $artefact2_2   = count( $database->getOwnUniqueArtefactInfo2( $to_owner, 7, 2, 0 ) );
                    $foolartefact2 = $database->getFoolArtefactInfo( 7, $data['to_vid'], $to_owner );
                    $good_artefact = 0;
                    if ( count( $foolartefact2 ) > 0 ) {
                        foreach ( $foolartefact2 as $arte ) {
                            if ( $arte['bad_effect'] == 0 ) {
                                $good_artefact = 1;
                            }
                        }
                    }
                } else {
                    $artefact_2    = count( $database->getOwnUniqueArtefactInfo2( $to_owner, 7, 3, 0 ) );
                    $artefact1_2   = count( $database->getOwnUniqueArtefactInfo2( $data['to_vid'], 7, 1, 1 ) );
                    $artefact2_2   = count( $database->getOwnUniqueArtefactInfo2( $to_owner, 7, 2, 0 ) );
                    $foolartefact2 = $database->getFoolArtefactInfo( 7, $data['to_vid'], $to_owner );
                    $iswwvilla     = 0;
                    $good_artefact = 0;
                    if ( count( $foolartefact2 ) > 0 ) {
                        foreach ( $foolartefact2 as $arte ) {
                            if ( $arte['bad_effect'] == 0 ) {
                                $good_artefact = 1;
                            }
                        }
                    }
                }

                if ( isset( $post['ctar1'] ) ) {
                    if ( $artefact_2 > 0 or $artefact1_2 > 0 or $artefact2_2 > 0 or $good_artefact == 1 ) {
                        if ( $post['ctar1'] != 40 or $post['ctar1'] != 27 and $iswwvilla == 1 ) {
                            $post['ctar1'] = 99;
                        } else {
                            $post['ctar1'] = 99;
                        }
                    } else {
                        $post['ctar1'] = $post['ctar1'];
                    }
                } else {
                    $post['ctar1'] = 0;
                }
                if ( isset( $post['ctar2'] ) ) {
                    if ( $artefact_2 > 0 or $artefact1_2 > 0 or $artefact2_2 > 0 or $good_artefact == 1 ) {
                        if ( $post['ctar2'] != 40 or $post['ctar2'] != 27 and $iswwvilla == 1 ) {
                            $post['ctar2'] = 99;
                        } else {
                            $post['ctar2'] = 99;
                        }
                    } else {
                        $post['ctar2'] = $post['ctar2'];
                    }
                } else {
                    $post['ctar2'] = 0;
                }
                if ( isset( $post['spy'] ) ) {
                    $post['spy'] = $post['spy'];
                } else {
                    $post['spy'] = 0;
                }
                $abdata      = $database->getABTech( $village->wid );
                $reference   = $database->addAttack( ( $village->wid ), $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $data['u11'], $data['type'], $post['ctar1'], $post['ctar2'], $post['spy'], $abdata['b1'], $abdata['b2'], $abdata['b3'], $abdata['b4'], $abdata['b5'], $abdata['b6'], $abdata['b7'], $abdata['b8'] );
                $checkexist  = $database->checkVilExist( $data['to_vid'] );
                $checkoexist = $database->checkOasisExist( $data['to_vid'] );
                if ( $checkexist or $checkoexist ) {
                    $database->addMovement( 3, $village->wid, $data['to_vid'], $reference, time(), ( $time + time() ) );
                    if ( ( $database->hasBeginnerProtection( $village->wid ) == 1 ) && ( $checkexist ) ) {
                        mysqli_query( $GLOBALS['link'], "UPDATE " . TB_PREFIX . "users SET protect = 0 WHERE id = " . (int) $session->uid );
                    }
                }

                if ( $form->returnErrors() > 0 ) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header( "Location: a2b.php" );
                    exit;
                }

                // prevent re-use of the same attack via re-POSTing the same data
                $database->remA2b($data['id']);

                header( "Location: build.php?id=39" );
                exit;

            } else {
                header( "Location: banned.php" );
                exit;
            }
        }
    }

    private function sendTroopsBack($post) {
        global $form, $database, $village, $generator, $session, $technology;
        if ( $session->access != BANNED ) {
            $enforce      = $database->getEnforceArray( $post['ckey'], 0 );
            $enforceoasis = $database->getOasisEnforceArray( $post['ckey'], 0 );
            if ( ( $enforce['from'] == $village->wid ) || ( $enforce['vref'] == $village->wid ) || ( $enforceoasis['conqured'] == $village->wid ) ) {
                $to     = $database->getVillage( $enforce['from'] );
                $Gtribe = "";
                if ( $database->getUserField( $to['owner'], 'tribe', 0 ) == '2' ) {
                    $Gtribe = "1";
                } else if ( $database->getUserField( $to['owner'], 'tribe', 0 ) == '3' ) {
                    $Gtribe = "2";
                } else if ( $database->getUserField( $to['owner'], 'tribe', 0 ) == '4' ) {
                    $Gtribe = "3";
                } else if ( $database->getUserField( $to['owner'], 'tribe', 0 ) == '5' ) {
                    $Gtribe = "4";
                }

                for ( $i = 1; $i < 10; $i ++ ) {
                    if ( isset( $post[ 't' . $i ] ) ) {
                        if ( $i != 10 ) {
                            if ( $post[ 't' . $i ] > $enforce[ 'u' . $Gtribe . $i ] ) {
                                $form->addError( "error", "You can't send more units than you have" );
                                break;
                            }

                            if ( $post[ 't' . $i ] < 0 ) {
                                $form->addError( "error", "You can't send negative units." );
                                break;
                            }
                        }
                    } else {
                        $post[ 't' . $i . '' ] = '0';
                    }
                }
                if ( isset( $post['t11'] ) ) {
                    if ( $post['t11'] > $enforce['hero'] ) {
                        $form->addError( "error", "You can't send more units than you have" );
                    }

                    if ( $post['t11'] < 0 ) {
                        $form->addError( "error", "You can't send negative units." );
                    }
                } else {
                    $post['t11'] = '0';
                }

                if ( $form->returnErrors() > 0 ) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header( "Location: a2b.php" );
                    exit;
                } else {

                    //change units
                    $start = ( $database->getUserField( $to['owner'], 'tribe', 0 ) - 1 ) * 10 + 1;
                    $end   = ( $database->getUserField( $to['owner'], 'tribe', 0 ) * 10 );

                    $units = [];
                    $amounts = [];
                    $modes = [];

                    $j = 1;
                    for ( $i = $start; $i <= $end; $i ++ ) {
                        $units[] = $i;
                        $amounts[] = $post[ 't' . $j . '' ];
                        $modes[] = 0;
                        $j ++;
                    }

                    $units[] = 'hero';
                    $amounts[] = $post['t11'];
                    $modes[] = 0;

                    $database->modifyEnforce( $post['ckey'], $units, $amounts, $modes );
                    $j ++;
                    //get cord
                    $from     = $database->getVillage( $enforce['from'] );
                    $fromcoor = $database->getCoor( $enforce['from'] );
                    $tocoor   = $database->getCoor( $enforce['vref'] );
                    $fromCor  = array( 'x' => $tocoor['x'], 'y' => $tocoor['y'] );
                    $toCor    = array( 'x' => $fromcoor['x'], 'y' => $fromcoor['y'] );

                    $speeds = array();

                    //find slowest unit.
                    for ( $i = 1; $i <= 10; $i ++ ) {
                        if ( isset( $post[ 't' . $i ] ) ) {
                            if ( $post[ 't' . $i ] != '' && $post[ 't' . $i ] > 0 ) {
                                if ( $unitarray ) {
                                    reset( $unitarray );
                                }
                                $unitarray = $GLOBALS[ "u" . ( ( $session->tribe - 1 ) * 10 + $i ) ];
                                $speeds[]  = $unitarray['speed'];
                            } else {
                                $post[ 't' . $i . '' ] = '0';
                            }
                        } else {
                            $post[ 't' . $i . '' ] = '0';
                        }
                    }
                    if ( isset( $post['t11'] ) ) {
                        if ( $post['t11'] != '' && $post['t11'] > 0 ) {
                            $hero_unit = $database->getHeroField($from['owner'], 'unit');
                            $speeds[]  = $GLOBALS[ 'u' . $hero_unit ]['speed'];
                        } else {
                            $post['t11'] = '0';
                        }
                    } else {
                        $post['t11'] = '0';
                    }
                    $artefact  = count( $database->getOwnUniqueArtefactInfo2( $session->uid, 2, 3, 0 ) );
                    $artefact1 = count( $database->getOwnUniqueArtefactInfo2( $village->wid, 2, 1, 1 ) );
                    $artefact2 = count( $database->getOwnUniqueArtefactInfo2( $session->uid, 2, 2, 0 ) );
                    if ( $artefact > 0 ) {
                        $fastertroops = 3;
                    } else if ( $artefact1 > 0 ) {
                        $fastertroops = 2;
                    } else if ( $artefact2 > 0 ) {
                        $fastertroops = 1.5;
                    } else {
                        $fastertroops = 1;
                    }
                    $time          = round( $generator->procDistanceTime( $fromCor, $toCor, min( $speeds ), 1 ) / $fastertroops );
                    $foolartefact2 = $database->getFoolArtefactInfo( 2, $village->wid, $session->uid );
                    if ( count( $foolartefact2 ) > 0 ) {
                        foreach ( $foolartefact2 as $arte ) {
                            if ( $arte['bad_effect'] == 1 ) {
                                $time *= $arte['effect2'];
                            } else {
                                $time /= $arte['effect2'];
                                $time = round( $time );
                            }
                        }
                    }
                    $reference = $database->addAttack( $enforce['from'], $post['t1'], $post['t2'], $post['t3'], $post['t4'], $post['t5'], $post['t6'], $post['t7'], $post['t8'], $post['t9'], $post['t10'], $post['t11'], 2, 0, 0, 0, 0 );
                    $database->addMovement( 4, $village->wid, $enforce['from'], $reference, time(), ( $time + time() ) );
                    $technology->checkReinf( $post['ckey'], false );

                    header( "Location: build.php?id=39&refresh=1" );
                    exit;

                }
            } else {
                $form->addError( "error", "You cant change someones troops." );
                if ( $form->returnErrors() > 0 ) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header( "Location: a2b.php" );
                    exit;
                }
            }
        } else {
            header( "Location: banned.php" );
            exit;
        }
    }
    
    public function Settlers($post) {
        global $form, $database, $village, $session;

        if ( $session->access != BANNED ) {
            $mode       = CP;
            $total      = count( $database->getProfileVillages( $session->uid ) );
            $need_cps   = ${'cp' . $mode}[ $total + 1 ];
            $cps        = $session->cp;
            $rallypoint = $database->getResourceLevel( $village->wid );
            if ( $rallypoint['f39'] > 0 ) {
                if ( $cps >= $need_cps ) {
                    $unit = ( $session->tribe * 10 );
                    $database->modifyResource( $village->wid, 750, 750, 750, 750, 0 );
                    $database->modifyUnit( $village->wid, array( $unit ), array( 3 ), array( 0 ) );
                    $database->addMovement( 5, $village->wid, $post['s'], 0, time(), time() + $post['timestamp'] );
                    header( "Location: build.php?id=39" );
                    exit;

                    if ( $form->returnErrors() > 0 ) {
                        $_SESSION['errorarray'] = $form->getErrors();
                        $_SESSION['valuearray'] = $_POST;
                        header( "Location: a2b.php" );
                        exit;
                    }
                } else {
                    header( "Location: build.php?id=39" );
                    exit;
                }
            } else {
                header( "Location: dorf1.php" );
                exit;
            }
        } else {
            header( "Location: banned.php" );
            exit;
        }
    }

    public function Hero($uid, $all = 0, $include_dead = false) {
        global $database;
        $heroarray = $database->getHero($uid, $all, $include_dead);
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
                    $herodata = $GLOBALS["h".$hero['unit']];
                    $singleHeroArrayID = $id;
                    break;
                }
            }

            // if we couldn't get a living hero,
            // resort to loading the first one from the list,
            // as that would be the one most recently updated/used
            if (!$herodata) {
                // this global value comes from GameEngine/Data/unitdata.php
                $herodata = $GLOBALS["h".$heroarray[0]['unit']];
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
                $herodata = $GLOBALS["h".$heroarray[$id]['unit']];

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
};

$units = new Units;

?>
