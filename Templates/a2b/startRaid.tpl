<?php

    $slots = $_POST['slot'];
    $lid = $_POST['lid'];
    $tribe = $_POST['tribe'];
    $getFLData = $database->getFLData($lid);
    $unitslist = $database->getFLData($lid);
    $sql = mysql_query("SELECT * FROM ".TB_PREFIX."raidlist WHERE lid = ".$lid."");
	$sql1 = mysql_fetch_array(mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE vref = ".$getFLData['wref']));
    while($row = mysql_fetch_array($sql)){
        $sid = $row['id'];
        $wref = $row['towref'];
        $t1 = $row['t1'];$t2 = $row['t2'];$t3 = $row['t3'];$t4 = $row['t4'];$t5 = $row['t5'];
        $t6 = $row['t6'];$t7 = $row['t7'];$t8 = $row['t8'];$t9 = $row['t9'];$t10 = $row['t10'];
        $t11 = 0;
		if($tribe == 1){ $u = "u"; } elseif($tribe == 2){ $u = "u1"; } elseif($tribe == 3){ $u = "u2"; }elseif($tribe == 4){ $u = "u3"; }else {$u = "u4"; }
		if($tribe == 1){ $u1 = "u1"; } elseif($tribe == 2){ $u1 = "u2"; } elseif($tribe == 3){ $u1 = "u3"; }elseif($tribe == 4){ $u1 = "u4"; }else {$u1 = "u5"; }
		if($tribe == 1){ $u2 = ""; } elseif($tribe == 2){ $u2 = "1"; } elseif($tribe == 3){ $u2 = "2"; }elseif($tribe == 4){ $u2 = "3"; }else {$u2 = "4"; }
        if($sql1[$u.'1']>=$t1 && $sql1[$u.'2']>=$t2 && $sql1[$u.'3']>=$t3 && $sql1[$u.'4']>=$t4 && $sql1[$u.'5']>=$t5 && $sql1[$u.'6']>=$t6 && $sql1[$u.'7']>=$t7 && $sql1[$u.'8']>=$t8 && $sql1[$u.'9']>=$t9 && $sql1[$u1.'0']>=$t10 && $sql1['hero']>=$t11){
        if($_POST['slot'.$sid]=='on'){
            $ckey = $generator->generateRandStr(6);
            $id = $database->addA2b($ckey,time(),$wref,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$t11,4);
            
            $data = $database->getA2b($ckey, time()); 
            
            if($database->checkVilExist($data['to_vid'])){
                $query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = ' . $data['to_vid']);
            }else{
                $query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'odata` WHERE `wref` = ' . $data['to_vid']);
            }
            $data1 = mysql_fetch_assoc($query1);
            $query2 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = '.$data1['owner']);
            $data2 = mysql_fetch_assoc($query2);
            $query11 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `wref` = '.$getFLData['wref']);
            $data11 = mysql_fetch_assoc($query11);
            $query21 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = '.$data11['owner']);
            $data21 = mysql_fetch_assoc($query21);
            
            $eigen = $database->getCoor($getFLData['wref']);
            $from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
            $ander = $database->getCoor($data['to_vid']);
            $to = array('x'=>$ander['x'], 'y'=>$ander['y']);
            $start = ($data21['tribe']-1)*10+1;
            $end = ($data21['tribe']*10);
            
            $speeds = array();
            $scout = 1;
    
            //find slowest unit.            
            for($i=1;$i<=10;$i++){
                if ($data['u'.$i]){
                    if($data['u'.$i] != '' && $data['u'.$i] > 0){
                        if($unitarray) { reset($unitarray); }
                        $unitarray = $GLOBALS["u".(($tribe-1)*10+$i)];
                        $speeds[] = $unitarray['speed'];
                    }
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
			$time = round($generator->procDistanceTime($from,$to,min($speeds),0)/$fastertroops);
            
            $ctar1 = 0;
            $ctar2 = 0; 
            $abdata = $database->getABTech($getFLData['wref']);
            $reference = $database->addAttack(($getFLData['wref']),$data['u1'],$data['u2'],$data['u3'],$data['u4'],$data['u5'],$data['u6'],$data['u7'],$data['u8'],$data['u9'],$data['u10'],$data['u11'],$data['type'],$ctar1,$ctar2,0,$abdata['b1'],$abdata['b2'],$abdata['b3'],$abdata['b4'],$abdata['b5'],$abdata['b6'],$abdata['b7'],$abdata['b8']);
            $totalunits = $data['u1']+$data['u2']+$data['u3']+$data['u4']+$data['u5']+$data['u6']+$data['u7']+$data['u8']+$data['u9']+$data['u10']+$data['u11'];
			$database->modifyUnit($getFLData['wref'], array($u2.'1'), array($data['u1']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'2'), array($data['u2']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'3'), array($data['u3']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'4'), array($data['u4']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'5'), array($data['u5']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'6'), array($data['u6']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'7'), array($data['u7']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'8'), array($data['u8']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'9'), array($data['u9']), array(0));
			$database->modifyUnit($getFLData['wref'], array($u2.'10'), array($data['u10']), array(0));
			$database->modifyUnit($getFLData['wref'], array('hero'), array($data['u11']), array(0));

			$database->addMovement(3,$getFLData['wref'],$data['to_vid'],$reference,time(),($time+time()));
        }    
    }
	}
header("Location: build.php?id=39&t=99");
?>