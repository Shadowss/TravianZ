<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Units.php                                                   ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Units {
    public $sending,$recieving,$return = array();

    public function procUnits($post) {
        if(isset($post['c'])) {
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
                if (isset($post['a'])&& $post['a']==533374 && $post['disabledr'] == ""){
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
                // Busqueda por nombre de pueblo
                // Confirmamos y buscamos las coordenadas por nombre de pueblo
                    if($post['x']!="" && $post['y']!=""){
                    $oid = $database->getVilWref($post['x'],$post['y']);
                    }else if($post['dname']!=""){
                    $oid = $database->getVillageByName(stripslashes($post['dname']));
                    }
                    if($database->isVillageOases($oid) != 0){
                    $too = $database->getOasisField($oid,"conqured");
                    if($too['conqured'] == 0){$disabledr ="disabled=disabled"; $disabled ="disabled=disabled";}else{
                    $disabledr ="";
                    if($session->sit == 0){
                    $disabled ="";
                    }else{
                    $disabled ="disabled=disabled";
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
                if(    !$post['t1'] && !$post['t2'] &&  !$post['t3'] && !$post['t4'] && !$post['t5'] &&
                    !$post['t6'] && !$post['t7'] &&  !$post['t8'] && !$post['t9'] && !$post['t10'] &&  !$post['t11']){
                $form->addError("error","You need to mark min. one troop");
                }

                if(!$post['dname'] && !$post['x'] && !$post['y']){
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
                // Busqueda por coordenadas de pueblo
                // Confirmamos y buscamos las coordenadas por coordenadas de pueblo
                if(isset($post['x']) && isset($post['y']) && $post['x'] != "" && $post['y'] != "") {
                    $coor = array('x'=>$post['x'], 'y'=>$post['y']);
                    $id = $generator->getBaseID($coor['x'],$coor['y']);
                    if (!$database->getVillageState($id)){
                        $form->addError("error","Coordinates do not exist");
                    }
                    if ($session->tribe == 1){$Gtribe = "";}elseif  ($session->tribe == 2){$Gtribe = "1";}elseif ($session->tribe ==  3){$Gtribe = "2";}elseif ($session->tribe == 4){$Gtribe = "3";}elseif  ($session->tribe == 5){$Gtribe = "4";}
                    for($i=1; $i<11; $i++)
                    {
                        if(isset($post['t'.$i]))
                        {

                            if ($post['t'.$i] > $village->unitarray['u'.$Gtribe.$i])
                            {
                                $form->addError("error","You can't send more units than you have");
                                break;
                            }

                            if($post['t'.$i]<0)
                            {
                                $form->addError("error","You can't send negative units.");
                                break;
                            }

                        }
                    }
                    if ($post['t11'] > $village->unitarray['hero'])
                            {
                                $form->addError("error","You can't send more units than you have");
                                break;
                            }

                            if($post['t11']<0)
                            {
                                $form->addError("error","You can't send negative units.");
                                break;
                            }
                }
                if ($database->isVillageOases($id) == 0) {
                if($database->hasBeginnerProtection($id)==1) {
                    $form->addError("error","Player is under beginners protection. You can't attack him");
                }

                //check if banned/admin:
                $villageOwner = $database->getVillageField($id,'owner');
                $userAccess = $database->getUserField($villageOwner,'access',0);
                    if($userAccess == '0' or $userAccess == '8' or $userAccess == '9'){
                                $form->addError("error","Player is Banned. You can't attack him");
                                //break;
                    }

                //check if attacking same village that units are in
                    if($id == $village->wid){
                                $form->addError("error","You cant attack same village you are sending from.");
                                //break;
                    }
                // Procesamos el array con los errores dados en el formulario
                if($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: a2b.php");
                }else{
                // Debemos devolver un array con $post, que contiene todos los datos mas
                // otra variable que definira que el flag esta levantado y se va a enviar y el tipo de envio
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
                }else{

                $villageName = $database->getOasisField($oid,"name");
                $speed= 300;
                $timetaken = $generator->procDistanceTime($coor,$village->coor,INCREASE_SPEED,1);
                array_push($post, "$id", "$villageName", "2","$timetaken");
                return $post;

            }
                  }

    }
    private function sendTroops($post) {
        global $form, $database, $village, $generator, $session;

        $data = $database->getA2b($post['timestamp_checksum'], $post['timestamp']);



         $Gtribe = "";
        if ($session->tribe == '2'){ $Gtribe = "1"; } else if  ($session->tribe == '3'){ $Gtribe = "2"; }else if ($session->tribe  == '4'){ $Gtribe = "3"; }else if ($session->tribe == '5'){ $Gtribe =  "4"; }
                for($i=1; $i<10; $i++){
                        if(isset($data['u'.$i])){

                            if ($data['u'.$i] > $village->unitarray['u'.$Gtribe.$i])
                            {
                                $form->addError("error","You can't send more units than you have");
                                break;
                            }

                            if($data['u'.$i]<0)
                            {
                                $form->addError("error","You can't send negative units.");
                                break;
                            }

                        }
                    }
                    if ($data['u11'] > $village->unitarray['hero'])
                            {
                                $form->addError("error","You can't send more units than you have");
                                break;
                            }

                            if($data['u11']<0)
                            {
                                $form->addError("error","You can't send negative units.");
                                break;
                            }
                if($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: a2b.php");
                } else {

if($session->access != BANNED){

         if($session->tribe == 1){ $u = ""; }  elseif($session->tribe == 2){ $u = "1"; } elseif($session->tribe  == 3){ $u = "2"; }elseif($session->tribe == 4){ $u = "3"; }else {$u =  "4"; }


            $database->modifyUnit(
                $village->wid,
                array($u."1",$u."2",$u."3",$u."4",$u."5",$u."6",$u."7",$u."8",$u."9",$u.$session->tribe."0","hero"),
                 array($data['u1'],$data['u2'],$data['u3'],$data['u4'],$data['u5'],$data['u6'],$data['u7'],$data['u8'],$data['u9'],$data['u10'],$data['u11']),
                array(0,0,0,0,0,0,0,0,0,0,0)
            );

    $query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = ' . mysql_escape_string($data['to_vid']));
    $data1 = mysql_fetch_assoc($query1);
    $query2 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = ' . $data1['owner']);
    $data2 = mysql_fetch_assoc($query2);
    $query11 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = ' . mysql_escape_string($village->wid));
    $data11 = mysql_fetch_assoc($query11);
    $query21 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = ' . $data11['owner']);
    $data21 = mysql_fetch_assoc($query21);



        $eigen = $database->getCoor($village->wid);
        $from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
        $ander = $database->getCoor($data['to_vid']);
        $to = array('x'=>$ander['x'], 'y'=>$ander['y']);
        $start = ($data21['tribe']-1)*10+1;
        $end = ($data21['tribe']*10);

        $speeds = array();
        $scout = 1;

        //find slowest unit.
        for($i=1;$i<=10;$i++){
            if (isset($data['u'.$i])){
                if($data['u'.$i] != '' && $data['u'.$i] > 0){
                    if($unitarray) { reset($unitarray); }
                    $unitarray = $GLOBALS["u".(($session->tribe-1)*10+$i)];
                    $speeds[] = $unitarray['speed'];
                }
            }
        }
        if (isset($data['u11'])) {
            if($data['u11'] != '' && $data['u11'] > 0){
                $heroarray = $database->getHero($session->uid);
                $herodata = $GLOBALS["u".$heroarray[0]['unit']];
                $speeds[] = $herodata['speed'];
            }
        }
            $artefact = count($database->getOwnUniqueArtefactInfo2($session->uid,2,3,0));
            $artefact1 = count($database->getOwnUniqueArtefactInfo2($village->wid,2,1,1));
            $artefact2 = count($database->getOwnUniqueArtefactInfo2($session->uid,2,2,0));
            if($artefact > 0){
            $fastertroops = 3;
            }else if($artefact1 > 0){
            $fastertroops = 2;
            }else if($artefact2 > 0){
            $fastertroops = 1.5;
            }else{
            $fastertroops = 1;
            }
        $time = round($generator->procDistanceTime($from,$to,min($speeds),1)/$fastertroops);
        $foolartefact = $database->getFoolArtefactInfo(2,$village->wid,$session->uid);
        if(count($foolartefact) > 0){
        foreach($foolartefact as $arte){
        if($arte['bad_effect'] == 1){
        $time *= $arte['effect2'];
        }else{
        $time /= $arte['effect2'];
        $time = round($time);
        }
        }
        }
        $to_owner = $database->getVillageField($data['to_vid'],"owner");
        $artefact_2 = count($database->getOwnUniqueArtefactInfo2($to_owner,7,3,0));
        $artefact1_2 = count($database->getOwnUniqueArtefactInfo2($data['to_vid'],7,1,1));
        $artefact2_2 = count($database->getOwnUniqueArtefactInfo2($to_owner,7,2,0));
        $foolartefact2 = $database->getFoolArtefactInfo(7,$data['to_vid'],$to_owner);
        $good_artefact = 0;
        if(count($foolartefact2) > 0){
        foreach($foolartefact2 as $arte){
        if($arte['bad_effect'] == 0){
        $good_artefact = 1;
        }
        }
        }
        if (isset($post['ctar1'])){if($artefact_2 > 0 or $artefact1_2  > 0 or $artefact2_2 > 0 or $good_artefact == 1){$post['ctar1'] =  99;}else{$post['ctar1'] = $post['ctar1'];}}else{ $post['ctar1'] = 0;}
        if (isset($post['ctar2'])){if($artefact_2 > 0 or $artefact1_2  > 0 or $artefact2_2 > 0 or $good_artefact == 1){$post['ctar2'] =  99;}else{$post['ctar2'] = $post['ctar2'];}}else{ $post['ctar2'] = 0;}
        if (isset($post['spy'])){$post['spy'] = $post['spy'];}else{ $post['spy'] = 0;}
        $abdata = $database->getABTech($village->wid);
        $reference =  $database->addAttack(($village->wid),$data['u1'],$data['u2'],$data['u3'],$data['u4'],$data['u5'],$data['u6'],$data['u7'],$data['u8'],$data['u9'],$data['u10'],$data['u11'],$data['type'],$post['ctar1'],$post['ctar2'],$post['spy'],$abdata['b1'],$abdata['b2'],$abdata['b3'],$abdata['b4'],$abdata['b5'],$abdata['b6'],$abdata['b7'],$abdata['b8']);
        $checkexist = $database->checkVilExist($data['to_vid']);
        $checkoexist = $database->checkOasisExist($data['to_vid']);
        if($checkexist or $checkoexist){
        $database->addMovement(3,$village->wid,$data['to_vid'],$reference,time(),($time+time()));
        }

        if($form->returnErrors() > 0) {
            $_SESSION['errorarray'] = $form->getErrors();
            $_SESSION['valuearray'] = $_POST;
            header("Location: a2b.php");
        }
        header("Location: build.php?id=39");

}else{
header("Location: banned.php");
}
    }}

    private function sendTroopsBack($post) {
        global $form, $database, $village, $generator, $session, $technology;
if($session->access != BANNED){
        $enforce=$database->getEnforceArray($post['ckey'],0);
        if(($enforce['from']==$village->wid) || ($enforce['vref']==$village->wid)){
            $to = $database->getVillage($enforce['from']);
            $Gtribe = "";
            if ($database->getUserField($to['owner'],'tribe',0) ==  '2'){ $Gtribe = "1"; } else if  ($database->getUserField($to['owner'],'tribe',0) == '3'){ $Gtribe =  "2"; } else if ($database->getUserField($to['owner'],'tribe',0) ==  '4'){ $Gtribe = "3"; }else if  ($database->getUserField($to['owner'],'tribe',0) == '5'){ $Gtribe =  "4"; }

                    for($i=1; $i<10; $i++){
                        if(isset($post['t'.$i])){
                            if($i!=10){
                                if ($post['t'.$i] > $enforce['u'.$Gtribe.$i])
                                {
                                    $form->addError("error","You can't send more units than you have");
                                    break;
                                }

                                if($post['t'.$i]<0)
                                {
                                    $form->addError("error","You can't send negative units.");
                                    break;
                                }
                            }
                        } else {
                        $post['t'.$i.'']='0';
                        }
                    }
                        if(isset($post['t11'])){
                                if ($post['t11'] > $enforce['hero'])
                                {
                                    $form->addError("error","You can't send more units than you have");
                                    break;
                                }

                                if($post['t11']<0)
                                {
                                    $form->addError("error","You can't send negative units.");
                                    break;
                                }
                        } else {
                        $post['t11']='0';
                        }

                if($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: a2b.php");
                } else {

                    //change units
                    $start = ($database->getUserField($to['owner'],'tribe',0)-1)*10+1;
                    $end = ($database->getUserField($to['owner'],'tribe',0)*10);

                    $j='1';
                    for($i=$start;$i<=$end;$i++){
                        $database->modifyEnforce($post['ckey'],$i,$post['t'.$j.''],0); $j++;
                    }
                        $database->modifyEnforce($post['ckey'],'hero',$post['t11'],0); $j++;
                        //get cord
                        $from = $database->getVillage($enforce['from']);
                        $fromcoor = $database->getCoor($enforce['from']);
                        $tocoor = $database->getCoor($enforce['vref']);
                        $fromCor = array('x'=>$tocoor['x'], 'y'=>$tocoor['y']);
                        $toCor = array('x'=>$fromcoor['x'], 'y'=>$fromcoor['y']);

                $speeds = array();

                //find slowest unit.
                for($i=1;$i<=10;$i++){
                    if (isset($post['t'.$i])){
                        if( $post['t'.$i] != '' && $post['t'.$i] > 0){
                        if($unitarray) { reset($unitarray); }
                        $unitarray = $GLOBALS["u".(($session->tribe-1)*10+$i)];
                        $speeds[] = $unitarray['speed'];
                    } else {
                        $post['t'.$i.'']='0';
                        }
                    } else {
                        $post['t'.$i.'']='0';
                    }
                }
                    if (isset($post['t11'])){
                        if( $post['t11'] != '' && $post['t11'] > 0){
                        $qh = "SELECT * FROM ".TB_PREFIX."hero WHERE uid = ".$from['owner']."";
                        $resulth = mysql_query($qh);
                        $hero_f=mysql_fetch_array($resulth);
                        $hero_unit=$hero_f['unit'];
                        $speeds[] = $GLOBALS['u'.$hero_unit]['speed'];
                    } else {
                        $post['t11']='0';
                        }
                    } else {
                        $post['t11']='0';
                    }
            $artefact = count($database->getOwnUniqueArtefactInfo2($session->uid,2,3,0));
            $artefact1 = count($database->getOwnUniqueArtefactInfo2($village->wid,2,1,1));
            $artefact2 = count($database->getOwnUniqueArtefactInfo2($session->uid,2,2,0));
            if($artefact > 0){
            $fastertroops = 3;
            }else if($artefact1 > 0){
            $fastertroops = 2;
            }else if($artefact2 > 0){
            $fastertroops = 1.5;
            }else{
            $fastertroops = 1;
            }
                $time = round($generator->procDistanceTime($fromCor,$toCor,min($speeds),1)/$fastertroops);
                $foolartefact2 = $database->getFoolArtefactInfo(2,$village->wid,$session->uid);
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
                $reference =  $database->addAttack($enforce['from'],$post['t1'],$post['t2'],$post['t3'],$post['t4'],$post['t5'],$post['t6'],$post['t7'],$post['t8'],$post['t9'],$post['t10'],$post['t11'],2,0,0,0,0);
                $database->addMovement(4,$village->wid,$enforce['from'],$reference,time(),($time+time()));
                $technology->checkReinf($post['ckey']);

                        header("Location: build.php?id=39");

                }
        } else {
            $form->addError("error","You cant change someones troops.");
                if($form->returnErrors() > 0) {
                    $_SESSION['errorarray'] = $form->getErrors();
                    $_SESSION['valuearray'] = $_POST;
                    header("Location: a2b.php");
                }
        }
}else{
header("Location: banned.php");
}
    }

    public function Settlers($post) {
        global $form, $database, $village, $session;
        if($session->access != BANNED){
    $mode = CP;
    $total = count($database->getProfileVillages($session->uid));
    $need_cps = ${'cp'.$mode}[$total+1];
    $cps = $session->cp;
    $rallypoint = $database->getResourceLevel($village->wid);
    if($rallypoint['f39'] > 0){
    if($cps >= $need_cps) {
     $unit = ($session->tribe*10);
          $database->modifyResource($village->wid,750,750,750,750,0);
          $database->modifyUnit($village->wid,array($unit),array(3),array(0));
          $database->addMovement(5,$village->wid,$post['s'],0,time(),time()+$post['timestamp']);
          header("Location: build.php?id=39");

          if($form->returnErrors() > 0) {
              $_SESSION['errorarray'] = $form->getErrors();
              $_SESSION['valuearray'] = $_POST;
              header("Location: a2b.php");
          }
    } else {
      header("Location: build.php?id=39");
    }
    }else{
      header("Location: dorf1.php");
    }
    }else{
        header("Location: banned.php");
    }
    }

    public function Hero($uid) {
        global $database;
        $heroarray = $database->getHero($uid);
        $herodata = $GLOBALS["h".$heroarray[0]['unit']];

        $h_atk = $herodata['atk'] + 5 * floor($heroarray[0]['attack'] * $herodata['atkp'] / 5);
        $h_di = $herodata['di'] + 5 * floor($heroarray[0]['defence'] * $herodata['dip'] / 5);
        $h_dc = $herodata['dc'] + 5 * floor($heroarray[0]['defence'] * $herodata['dcp'] / 5);
        $h_ob = 1 + 0.002 * $heroarray[0]['attackbonus'];
        $h_db = 1 + 0.002 * $heroarray[0]['defencebonus'];

        return  array('heroid'=>$heroarray[0]['heroid'],'unit'=>$heroarray[0]['unit'],'atk'=>$h_atk,'di'=>$h_di,'dc'=>$h_dc,'ob'=>$h_ob,'db'=>$h_db,'health'=>$heroarray[0]['health']);
    }
};

$units = new Units;

?>
