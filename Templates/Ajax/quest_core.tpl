<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       ##
##  Version:       01.09.2013 						       ##
##  Filename       quest_core.tpl                                              ##
##  Developed by:  DesPlus and Marvin                                          ##
##  Fixed by:      Shadow / Skype : cata7007 and Armando                       ##
##  Revision by:   noonn                                 		       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       ##
##                                                                             ##
#################################################################################

include("GameEngine/Village.php");
include("GameEngine/Data/cp.php");

$uArray = $database->getUserArray($_SESSION['username'],0);
$check_quest=$database->getUserField($_SESSION['username'],'quest','username');

if($message->unread && !$message->nunread) { $messagelol = "i2"; }
else if(!$message->unread && $message->nunread) { $messagelol = "i3"; }
else if($message->unread && $message->nunread) { $messagelol = "i1"; }
else { $messagelol = "i4"; }

//set $skipp_time. Use the SPEED. standard (1x) = 10 hours. 
if(SPEED == '1'){ 
	$skipp_time="43200"; 
} else if(SPEED == '2'){ 
	$skipp_time="21600"; 
} else if(SPEED == '3'){ 
	$skipp_time="11988"; 
} else if(SPEED <= '5'){
	$skipp_time="7200"; 
} else if(SPEED > '5'){ 
	$skipp_time="3600"; 
} 
$_SESSION['qst_time'] = $uArray['quest_time'];
if (isset($qact)){
	if ($check_quest==$qact) {
		//avoid hacking gold, resources or reward -- added by Ronix
	}else {
		switch($qact) {
		case 'enter':
			$database->updateUserField($_SESSION['username'],'quest','1',0);
			$_SESSION['qst']= 1;
			break;
	
	
			//user does not follow the quest. 
			//Get reward: Resources: Every 24 hours (1 speed)  24/speed=hours
			//Gold: 25 gold
		case 'skip':
			$database->updateUserField($_SESSION['username'],'quest','90',0);
			$_SESSION['qst']= 90;
			break;

		case '2':
			$database->updateUserField($_SESSION['username'],'quest','2',0);		
			$_SESSION['qst']= 2;	
			//Give Reward
			$database->FinishWoodcutter($session->villages[0]);	
			break;

		case '3':
			$database->updateUserField($_SESSION['username'],'quest','3',0);
			$_SESSION['qst']= 3;
			//Give Reward
			if(!$session->plus){
				mysql_query("UPDATE ".TB_PREFIX."users set plus = ('".mktime(date("H"),date("i"), date("s"),date("m") , date("d"), date("Y"))."')+86400 where `username`='".$_SESSION['username']."'") or die(mysql_error());
			} else {
				$plus=$database->getUserField($_SESSION['username'],'plus','username');
				$plus+=86400;
				$database->updateUserField($_SESSION['username'],'plus',$plus,0);
			}
			break;

		case '4':
			$database->updateUserField($_SESSION['username'],'quest','4',0);
			$_SESSION['qst']= 4;
			//Give Reward
			$database->modifyResource($session->villages[0],30,60,30,20,1);		
			break;
	
		case 'rank':
			$rSubmited=$qact2;
			break;
	
		case '5':
			$database->updateUserField($_SESSION['username'],'quest','5',0);
			$_SESSION['qst']= 5;
			//Give Reward
			$database->modifyResource($session->villages[0],40,30,20,30,1);	
			break;

		case '6':
			$database->updateUserField($_SESSION['username'],'quest','6',0);
			$_SESSION['qst']= 6;
			$Subject="Message From The Taskmaster";
			$Subject=Q6_SUBJECT;
			$Message=Q6_MESSAGE;
			$RB=true;
			//Give Reward
			$database->modifyResource($session->villages[0],50,60,30,30,1);	
			break;
	
		case '7':
			$database->updateUserField($_SESSION['username'],'quest','7',0);
			$_SESSION['qst']= 7;
			//Give Reward
			$gold=$database->getUserField($_SESSION['username'],'gold','username');
			$gold+=20;
			$database->updateUserField($_SESSION['username'],'gold',$gold,0);
			break;
			
		case '8':
			$database->updateUserField($_SESSION['username'],'quest','8',0);
			$_SESSION['qst']= 8;
			//Give Reward
			$database->modifyResource($session->villages[0],75,80,30,50,1);
			break;
	
		case '9':
			$crop = round($village->acrop);
			if ($crop>=200){
				$database->updateUserField($_SESSION['username'],'quest','9',0);
				//Get 200 Crop	
				$database->modifyResource($session->villages[0],0,0,0,-200,1);		
				//Give Reward
				$attack = $database->addAttack(0,1,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0);
				$database->addMovement(3,0,$session->villages[0],$attack,time(),time()+43200/INCREASE_SPEED);
			} else{
				$NoCrop=Q8_NOCROP;
			}
			$_SESSION['qst']= 9;	
			break;
	
		case '10':
			$database->updateUserField($_SESSION['username'],'quest','10',0);
			$_SESSION['qst']= 10;
			//Give Reward
			$database->modifyResource($session->villages[0],75,90,30,50,1);
			break;
	
		case '11':
			$database->updateUserField($_SESSION['username'],'quest','11',0);
			$_SESSION['qst']= 11;
			//Give Reward
			if(!$session->plus){
				mysql_query("UPDATE ".TB_PREFIX."users set plus = ('".mktime(date("H"),date("i"), date("s"),date("m") , date("d"), date("Y"))."')+172800 where `username`='".$_SESSION['username']."'") or die(mysql_error());
			} else {
				$plus=$database->getUserField($_SESSION['username'],'plus','username');
				$plus+=172800;
				$database->updateUserField($_SESSION['username'],'plus',$plus,0);
			}
			break;
	
		case 'coor':
			$x=$qact2;
			$y=$qact3;
			break;
	
		case '12':
			$database->updateUserField($_SESSION['username'],'quest','12',0);
			$_SESSION['qst']= 12;
			//Give Reward
			$database->modifyResource($session->villages[0],60,30,40,90,1);	
			break;
		
		case '13':
			$database->updateUserField($_SESSION['username'],'quest','13',0);
			$_SESSION['qst']= 13;
			//Give Reward
			$database->modifyResource($session->villages[0],150,180,30,130,1);
			break;
	
		case '14':
			$database->updateUserField($_SESSION['username'],'quest','14',0);
			$_SESSION['qst']= 14;
			//Give Reward
			$database->modifyResource($session->villages[0],60,50,40,30,1);
			break;
	
		case 'lumber':
			$lSubmited=$qact2;
			break;
	
		case '15':
			$database->updateUserField($_SESSION['username'],'quest','15',0);
			$_SESSION['qst']= 15;
			//Give Reward
			$database->modifyResource($session->villages[0],50,30,60,20,1);
			break;
	
		case '16':
			$database->updateUserField($_SESSION['username'],'quest','16',0);
			$_SESSION['qst']= 16;
			//Give Reward
			$database->modifyResource($session->villages[0],75,75,40,40,1);
			break;
	
		case '17':
			$database->updateUserField($_SESSION['username'],'quest','17',0);
			$_SESSION['qst']= 17;
			//Give Reward
			$database->modifyResource($session->villages[0],100,90,100,60,1);
			break;
	
		case '18':
			$database->updateUserField($_SESSION['username'],'quest','18',0);
			$_SESSION['qst']= 18;			
			break;
	
		case '19':
			$database->updateUserField($_SESSION['username'],'quest','19',0);
			$_SESSION['qst']= 19;
			//Give Reward
			$database->modifyResource($session->villages[0],80,90,60,40,1);
			break;
	
		case '20':
			$database->updateUserField($_SESSION['username'],'quest','20',0);
			$_SESSION['qst']= 20;
			//Give Reward
			$database->modifyResource($session->villages[0],70,120,90,50,1);
			break;

		case '21':
			$database->updateUserField($_SESSION['username'],'quest','21',0);
			$_SESSION['qst']= 21;			
			break;
	
		case '22':
			$database->updateUserField($_SESSION['username'],'quest','22',0);
			$_SESSION['qst']= 22;
			//Give Reward
			$database->modifyResource($session->villages[0],200,200,700,450,1);
			break;
	
		case '23':
			$database->updateUserField($_SESSION['username'],'quest','23',0);
			$_SESSION['qst']= 23;
			break;
	
		case '24':
			$database->updateUserField($_SESSION['username'],'quest','24',0);
			$_SESSION['qst']= 24;
			//Give Reward
			$database->modifyResource($session->villages[0],300,320,360,570,1);
			break;
	
		case '28':
			$dataarray[3] = 1;
			$database->updateUserField($_SESSION['username'],'quest','28',0);
			$_SESSION['qst']= 28;
			//Give Reward
			$gold=$database->getUserField($_SESSION['username'],'gold','username');
			$gold+=15;
			$database->updateUserField($_SESSION['username'],'gold',$gold,0);
			break;
	
		case '29':
			$dataarray[4] = 1;
			$database->updateUserField($_SESSION['username'],'quest','29',0);
			$_SESSION['qst']= 29;
			//Give Reward
			$database->modifyResource($session->villages[0],240,280,180,100,1);
			break;
    
		case '30':
			$dataarray[5] = 1;
			$database->updateUserField($_SESSION['username'],'quest','30',0);
			$_SESSION['qst']= 30;
			//Give Reward
			$database->modifyResource($session->villages[0],600,750,600,300,1);
			break;
    
		case '31':
			$dataarray[6] = 1;
			$database->updateUserField($_SESSION['username'],'quest','31',0);
			$_SESSION['qst']= 31;
			//Give Reward
			$database->modifyResource($session->villages[0],900,850,600,300,1);
			break;
    
		case '32':
			$dataarray[7] = 1;
			$database->updateUserField($_SESSION['username'],'quest','32',0);
			$_SESSION['qst']= 32;
			//Give Reward
			$database->modifyResource($session->villages[0],1800,2000,1650,800,1);
			break;
    
		case '33':
			$dataarray[8] = 1;
			$database->updateUserField($_SESSION['username'],'quest','33',0);
			$_SESSION['qst']= 33;
			//Give Reward
			$database->modifyResource($session->villages[0],1600,1800,1950,1200,1);
			break;
    
		case '34':
			$dataarray[9] = 1;
			$database->updateUserField($_SESSION['username'],'quest','34',0);
			$_SESSION['qst']= 34;
			//Give Reward
			$database->modifyResource($session->villages[0],3400,2800,3600,2200,1);
			break;
    
		case '35':
			$dataarray[10] = 1;
			$database->updateUserField($_SESSION['username'],'quest','35',0);
			$_SESSION['qst']= 35;
			//Give Reward
			$database->modifyResource($session->villages[0],1050,800,900,750,1);
			break;
    
		case '36':
			$database->updateUserField($_SESSION['username'],'quest','36',0);
			$_SESSION['qst']= 36;
			//Give Reward
			$database->modifyResource($session->villages[0],1600,2000,1800,1300,1);
			break;
	
		case '37':
			$database->updateUserField($_SESSION['username'],'quest','37',0);
			$_SESSION['qst']= 37;
			break;
	
		case '91':
			$database->updateUserField($_SESSION['username'],'quest','91',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()+$skipp_time).'',0);
			$_SESSION['qst']= 91;
			$_SESSION['qst_time'] = time()+$skipp_time;
			//Give Reward
			if(!$session->plus){
				mysql_query("UPDATE ".TB_PREFIX."users set plus = ('".mktime(date("H"),date("i"), date("s"),date("m") , date("d"), date("Y"))."')+86400 where `username`='".$_SESSION['username']."'") or die(mysql_error());
			} else {
				$plus=$database->getUserField($_SESSION['username'],'plus','username');
				$plus+=86400;
				$database->updateUserField($_SESSION['username'],'plus',$plus,0);
			}
			$gold=$database->getUserField($_SESSION['username'],'gold','username');
			$gold+=15;
			$database->updateUserField($_SESSION['username'],'gold',$gold,0);
			break;
		
		case '92':
			$database->updateUserField($_SESSION['username'],'quest','92',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()+$skipp_time).'',0);
			$_SESSION['qst']= 92;
			$_SESSION['qst_time'] = time()+$skipp_time;
			//Give Reward
			$database->modifyResource($session->villages[0],217,247,177,207,1);
			break;	
	
		case '93':
			$database->updateUserField($_SESSION['username'],'quest','93',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()+$skipp_time).'',0);
			$_SESSION['qst']= 93;
			$_SESSION['qst_time'] = time()+$skipp_time;
			//Give Reward
			$database->modifyResource($session->villages[0],217,247,177,207,1);
			break;	
	
		case '94':
			$database->updateUserField($_SESSION['username'],'quest','94',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()+$skipp_time).'',0);
			$_SESSION['qst']= 94;
			$_SESSION['qst_time'] = time()+$skipp_time;
			//Give Reward
			$database->modifyResource($session->villages[0],217,247,177,207,1);
			break;	
	
		case '95':
			$database->updateUserField($_SESSION['username'],'quest','95',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()+$skipp_time).'',0);
			$_SESSION['qst']= 95;
			$_SESSION['qst_time'] = time()+$skipp_time;
			//Give Reward
			$database->modifyResource($session->villages[0],217,247,177,207,1);
			break;	
	
		case '96':
			$database->updateUserField($_SESSION['username'],'quest','96',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()+$skipp_time).'',0);
			$_SESSION['qst']= 96;
			$_SESSION['qst_time'] = time()+$skipp_time;
			//Give Reward
			$database->modifyResource($session->villages[0],217,247,177,207,1);
			break;	
	
		case '97':
			$database->updateUserField($_SESSION['username'],'quest','97',0);
			$database->updateUserField($_SESSION['username'],'quest_time',''.(time()).'',0);
			$_SESSION['qst_time'] = time();
			$_SESSION['qst']= 97;
			//Give Reward 20 gold + 2 days plus
			if(!$session->plus){
				mysql_query("UPDATE ".TB_PREFIX."users set plus = ('".mktime(date("H"),date("i"), date("s"),date("m") , date("d"), date("Y"))."')+172800 where `username`='".$_SESSION['username']."'") or die(mysql_error());
			} else {
				$plus=$database->getUserField($_SESSION['username'],'plus','username');
				$plus+=172800;
				$database->updateUserField($_SESSION['username'],'plus',$plus,0);
			}
			$gold=$database->getUserField($_SESSION['username'],'gold','username');
			$gold+=20;
			$database->updateUserField($_SESSION['username'],'gold',$gold,0);
			break;
		}	
	}
}

header("Content-Type: application/json;");
if($session->access!=BANNED){
      if($_SESSION['qst']== 0){
	  ?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q0; ?> <?php echo SERVER_NAME; ?>!<\/h1><br \/><i>&rdquo;<?php echo Q0_DESC; ?>&rdquo;<\/i><br \/><br \/><span id=\"qst_accpt\"><a class=\"qle\" href=\"javascript: qst_next('','enter'); \"><?php echo Q0_OPT1; ?><\/a><a class=\"qri\" href=\"javascript: qst_fhandle();\"><?php echo Q0_OPT2; ?><\/a><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><br \/><br \/><br \/><a class=\"qri\" href=\"javascript: qst_next('','skip');\"><?php echo Q0_OPT3; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":null,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":1}

<?php } elseif($_SESSION['qst']== 1){

//Check one of Woodcutters is level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$woodL=$tRes['f1']+$tRes['f3']+$tRes['f14']+$tRes['f17'];
	//check if you are building a woodcutter to level 1
	foreach($building->buildArray as $jobs) {
			if($jobs['type']==1){
				$woodL="99";
			}	
      	}
if ($woodL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q1_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_RESP; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q1_REWARD; ?><br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','2');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 2){ 

//Check one of Croplands is level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$cropL=$tRes['f2']+$tRes['f8']+$tRes['f9']+$tRes['f12']+$tRes['f13']+$tRes['f15'];
if ($cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q2; ?><\/h1><br \/><i>&rdquo;<?php echo Q2_DESC; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q2_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":"-2","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q2; ?><\/h1><br \/><i>&rdquo;<?php echo Q2_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q2_REWARD; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','3');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":2,"reward":{"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 3){ 

//Check the village name is changed or is default name

$vName=$village->vname;
if ($vName==$session->userinfo['username']."'s village"){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q3; ?><\/h1><br \/><i>&rdquo;<?php echo Q3_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q3_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":"-3","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q3; ?><\/h1><br \/><i>&rdquo;<?php echo Q3_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','4');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":3,"reward":{"wood":30,"clay":60,"iron":30,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 4){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q4_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','rank',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q4_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":-4,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>20&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','5');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t","number":4,"reward":{"wood":40,"clay":30,"iron":20,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 5){ 

//Check one of Iron Mines and one of Clay Pites are level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=$tRes['f4']+$tRes['f7']+$tRes['f10']+$tRes['f11'];
$clayL=$tRes['f5']+$tRes['f6']+$tRes['f16']+$tRes['f18'];
if ($ironL<1 || $clayL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q5; ?><\/h1><br \/><i>&rdquo;<?php echo Q5_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q5_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":-5,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q5; ?><\/h1><br \/><i>&rdquo;<?php echo Q5_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','6');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":5,"reward":{"wood":50,"clay":60,"iron":30,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 6){ 

//Check message is viewed or no
if ($message->unread || $RB==true){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q6; ?><\/h1><br \/><i>&rdquo;<?php echo Q6_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q6_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":"-6","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"i2","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q6; ?><\/h1><br \/><i>&rdquo;<?php echo Q6_RESP; ?><b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><?php echo Q6_RESP1; ?><a href=\"plus.php?id=3\"><font color=\"#000000\"><?php echo SERVER_NAME; ?><\/font> <b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><\/a> <?php echo Q6_RESP2; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p>20 Gold<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','7');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":6,"reward":{"gold":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 7){

//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}

if ($ironL<2 || $clayL<2 || $woodL<2 || $cropL<2){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo $questc->q;?><?php echo Q7; ?><\/h1><br \/><i>&rdquo;<?php echo Q7_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q7_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-7,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q7; ?><\/h1><br \/><i>&rdquo;<?php echo Q7_RESP; ?>&rdquo;\r\n<br \/><br \/>\r\n<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','8');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":7,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 8){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q8; ?><\/h1><br \/><i>&rdquo;<?php echo Q8_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q8_ORDER; ?><\/div><br \/><img class=\"r4\" src=\"img\/x.gif\" title=\"Crop\" alt=\"Crop\" \/>200 <input type=\"hidden\" id=\"qst_val\" value=\"set\" \/><input onclick=\"javascript: qst_next('','9');\" name=\"qstin\" type=\"button\" value=\"<?php echo Q8_BUTN; ?>\" \/><br \/><font color='#FF0000'><?php if(isset($NoCrop)){echo $NoCrop;}?><font\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"army\"><\/div>\n\t\t","number":-8,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php } elseif($_SESSION['qst']== 9){

//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo $questc->q;?> <?php echo Q9; ?><\/h1><br \/><i>&rdquo;<?php echo Q9_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q9_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-9,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q9; ?><\/h1><br \/><i>&rdquo;<?php echo Q9_RESP; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','10');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":9,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 10){ 

//Check player Descriptions for [#0]
$Dave= strrpos ($uArray['desc1'],'[#0]');
$Dave2=strrpos ($uArray['desc2'],'[#0]');
if (!is_numeric($Dave) and !is_numeric($Dave2)){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q10; ?><\/h1><br \/><i>&rdquo;<?php echo Q10_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q10_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":"-10","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q10; ?><\/h1><br \/><i>&rdquo;<?php echo Q10_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q10_REWARD; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','11');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":10,"reward":{"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 11){

$getvID = $database->getVillageID($session->uid);
$nvillage = $database->getFieldDistance($getvID);
$ncoor = $database->getCoor($nvillage);
$nvillagename = $database->getVillageField($nvillage,"name");
if ($x!=$ncoor['x'] or $y!=$ncoor['y']){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q11; ?></h1><br><i>&rdquo;<?php echo Q11_DESC; ?> <b><?php echo $nvillagename; ?></b>. <?php echo Q11_DESC1; ?>&rdquo;</i><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q11_ORDER; ?> <b><?php echo $nvillagename; ?></b> <?php echo Q11_ORDER1; ?></div><div id=\"map_coords\"><span>X </span><input class=\"text\" value=\"\" maxlength=\"4\" id=\"qst_val_x\" name=\"xp\"><span> Y </span><input class=\"text\" value=\"\" maxlength=\"4\" id=\"qst_val_y\" name=\"xy\"> <input type=\"button\" value=\"<?php echo Q11_BUTN; ?>\" onclick=\"qst_next2('1','coor',document.getElementById('qst_val_x').value,document.getElementById('qst_val_y').value)\"></div></div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":-11,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q11; ?><\/h1><br \/><i>&rdquo;<?php echo Q11_RESP; ?> <b> <?php echo $nvillagename;?> <\/b> <?php echo Q11_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>90&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','12');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":11,"reward":{"wood":60,"clay":30,"iron":40,"crop":90},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 12){

//Check cranny builded or no
$cranny = $building->getTypeLevel(23);
if ($cranny == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q12; ?><\/h1><br \/><i>&rdquo;<?php echo Q12_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q12_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":-12,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q12; ?><\/h1><br \/><i>&rdquo;<?php echo Q12_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>150&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>130&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','13');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":12,"reward":{"wood":150,"clay":180,"iron":30,"crop":130},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 13){

//Check one of each resource is lvl2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<1 || $clayL<1 || $woodL<1 || $cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q13; ?><\/h1><br \/><i>&rdquo;<?php echo Q13_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q13_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-13","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q13; ?><\/h1><br \/><i>&rdquo;<?php echo Q13_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','14');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":13,"reward":{"wood":60,"clay":50,"iron":40,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 14){ 

//Check player submited number Barracks cost lumber
if ($lSubmited!=210){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q14; ?><\/h1><br \/><i>&rdquo;<?php echo Q14_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q14_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','lumber',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q14_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":"-14","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q14; ?><\/h1><br \/><i>&rdquo;<?php echo Q14_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','15');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t","number":14,"reward":{"wood":50,"clay":30,"iron":60,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 15){

//Check main building lvl is 3 or upper
$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding<3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q15; ?><\/h1><br \/><i>&rdquo;<?php echo Q15_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q15_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":-15,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q15; ?><\/h1><br \/><i>&rdquo;<?php echo Q15_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','16');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":15,"reward":{"wood":75,"clay":75,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 16){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q16; ?><\/h1><br \/><i>&rdquo;<?php echo Q16_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q16_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','rank',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":"-16","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q16; ?><\/h1><br \/><i>&rdquo;<?php echo Q16_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">90&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">60&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','17');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":16,"reward":{"wood":100,"clay":90,"iron":100,"crop":60},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 17){

// Ask from plyer ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q17; ?><\/h1><br \/><i>&rdquo;<?php echo Q17_DESC; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"\" \/><input onclick=\"javascript: qst_next('','21');\" type=\"button\" value=\"<?php echo Q17_BUTN; ?>\" class=\"qb1\"\/><input onclick=\"javascript: qst_next('','18');\" type=\"button\" value=\"<?php echo Q17_BUTN1; ?>\" class=\"qb2\" \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-17","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php } elseif($_SESSION['qst']== 18){

// Checking rollypoint builded or no
$rallypoint = $building->getTypeLevel(16);
if ($rallypoint==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q18; ?><\/h1><br \/><i>&rdquo; <?php echo Q18_DESC; ?> <a href=\"build.php?id=39\"><?php echo Q18_DESC1; ?><\/a> <?php echo Q18_DESC2; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q18_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-18","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q18; ?><\/h1><br \/><i>&rdquo; <?php echo Q18_RESP; ?> &rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','19');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":18,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']==19){

// Checking barrack builded or no
$barrack = $building->getTypeLevel(19);
if ($barrack==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q19; ?><\/h1><br \/><i>&rdquo;<?php echo Q19_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q19_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q19; ?><\/h1><br \/><i>&rdquo;<?php echo Q19_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','20');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":19,"reward":{"wood":70,"clay":100,"iron":90,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 20){

// Checking 2 warrior trained or no
$units = $village->unitall;
$unarray=array("",U1,U11,U21);
$unarray2=array("","u1", "u11","u21");
if ($units[$unarray2[$session->userinfo['tribe']]]<2){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q20; ?><\/h1><br \/><i>&rdquo;<?php echo Q20_DESC; ?> <?php echo $unarray[$session->userinfo['tribe']];?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q20_ORDER; ?> <?php echo $unarray[$session->userinfo['tribe']];?>.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":"-20","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q20; ?><\/h1><br \/><i>&rdquo;<?php echo Q20_RESP; ?> <a href=\"warsim.php\"><?php echo Q20_RESP1; ?><\/a>  <?php echo Q20_RESP2; ?> &rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>300&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>320&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>360&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>570&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','24');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":20,"reward":{"wood":300,"clay":320,"iron":360,"crop":570},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 21){

// Checking granary builded or no
$granary = $building->getTypeLevel(11);
if ($granary ==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q21; ?> <\/h1><br \/><i>&rdquo;<?php echo Q21_DESC; ?>&rdquo;<br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q21_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-21","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q21; ?> <\/h1><br \/><i>&rdquo;<?php echo Q21_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','22');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":21,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']==22){

// Checking warehouse builded or no
$warehouse = $building->getTypeLevel(10);
if ($warehouse==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q22; ?><\/h1><br \/><i>&rdquo;<?php echo Q22_DESC; ?>&rdquo;\r\n<br><br>\r\n<\/i><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q22_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-22","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q22; ?><\/h1><br \/><i>&rdquo;<?php echo Q22_RESP; ?><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','23');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":22,"reward":{"wood":70,"clay":120,"iron":90,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 23){

// Checking market builded or no
$market = $building->getTypeLevel(17);
if ($market==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q23; ?><\/h1><br \/><i>&rdquo;<?php echo Q23_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q23_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":"-23","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q23; ?><\/h1><br \/><i>&rdquo;<?php echo Q23_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>700&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>450&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','24');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":23,"reward":{"wood":200,"clay":200,"iron":700,"crop":450},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>
<?php } elseif($_SESSION['qst']== 24){

// Checking all resource lvl are 2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q24; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q24_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-24","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q24; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p>15 Gold<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','28');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":24,"reward":{"gold":15},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>


////////////////// DE AICI INCEPE TOT \\\\\\\\\\\\\\\\\\\\\\\
//////////////////// Added by Shadow \\\\\\\\\\\\\\\\\\\\\\\\\

<?php } elseif($_SESSION['qst']== 28){

$aid = $session->alliance;
$allianceinfo = $database->getAlliance($aid);
if ($aid==0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q28; ?><\/h1><br \/><i>&rdquo;<?php echo Q28_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q28_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":"-28","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q28; ?><\/h1><br \/><i>&rdquo;<?php echo Q28_RESP; ?> <b><?php echo $allianceinfo['tag'];?><\/b><?php echo Q28_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>240&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>280&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','29');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":28,"reward":{"wood":240,"clay":280,"iron":180,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 29){

$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding < 5){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q29; ?><\/h1><br \/><i>&rdquo;<?php echo Q29_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q29_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":"-29","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q29; ?><\/h1><br \/><i>&rdquo;<?php echo Q29_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>750&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','30');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":29,"reward":{"wood":600,"clay":750,"iron":600,"crop":300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 30){

$granary = $building->getTypeLevel(11);
if ($granary < 3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q30; ?><\/h1><br \/><i>&rdquo;<?php echo Q30_DESC; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q30_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-30","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q30; ?><\/h1><br \/><i>&rdquo;<?php echo Q30_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>900&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>850&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','31');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":30,"reward":{"wood":900,"clay":850,"iron":600,"crop":300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 31){

$warehouse = $building->getTypeLevel(10);
if ($warehouse < 7){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q31; ?><\/h1><br \/><i>&rdquo;<?php echo Q31_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q31_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-31","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q31; ?><\/h1><br \/><i>&rdquo;<?php echo Q31_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2000&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1650&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>800&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','32');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":31,"reward":{"wood":1800,"clay":2000,"iron":1650,"crop":800},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 32){

//Check one of each resource is lvl5 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>4){$ironL++;};if($tRes['f7']>4){$ironL++;};if($tRes['f10']>4){$ironL++;};if($tRes['f11']>4){$ironL++;}
if($tRes['f5']>4){$clayL++;};if($tRes['f6']>4){$clayL++;};if($tRes['f16']>4){$clayL++;};if($tRes['f18']>4){$clayL++;}
if($tRes['f1']>4){$woodL++;};if($tRes['f3']>4){$woodL++;};if($tRes['f14']>4){$woodL++;};if($tRes['f17']>4){$woodL++;}
if($tRes['f2']>4){$cropL++;};if($tRes['f8']>4){$cropL++;};if($tRes['f9']>4){$cropL++;};if($tRes['f12']>4){$cropL++;};if($tRes['f13']>4){$cropL++;};if($tRes['f15']>4){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q32; ?><\/h1><br \/><i>&rdquo;<?php echo Q32_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q32_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-32","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q32; ?><\/h1><br \/><i>&rdquo;<?php echo Q32_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>1800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1950&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>1200&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','33');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":32,"reward":{"wood":1600,"clay":1800,"iron":1950,"crop":1200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 33){

$residence = $building->getTypeLevel(25);
$palace = $building->getTypeLevel(26);
if($palace >= 10){
$text =PALACE;
}else if($residence >= 10){
$text =RESIDENCE;
}
if ($residence<10 && $palace<10){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q33; ?><\/h1><br \/><i>&rdquo;<?php echo Q33_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q33_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":"-33","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q33; ?><\/h1><br \/><i>&rdquo;<?php echo $text; ?> <?php echo Q33_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>3400&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>3600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>2200&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','34');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":33,"reward":{"wood":3400,"clay":2800,"iron":3600,"crop":2200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 34){

// Checking 3 settlers trained or no
$units = $village->unitall;
$unarray2=array("","u10", "u20","u30");
if ($units[$unarray2[$session->userinfo['tribe']]]<3){ $cp = CP;?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q34; ?><\/h1><br \/><i>&rdquo;<?php echo Q34_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q34_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":"-34","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q34; ?><\/h1><br \/><i>&rdquo;<?php echo Q34_RESP; ?> <b><?php $mode = CP; $total = count($database->getProfileVillages($session->uid)); echo ${'cp'.$mode}[$total+1]; ?><\/b> <?php echo Q34_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1050&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>900&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>750&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','35');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":34,"reward":{"wood":1050,"clay":800,"iron":900,"crop":750},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 35){

$vil = $database->getProfileVillages($session->uid);
if (count($vil)<2){ ?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q35; ?><\/h1><br \/><i>&rdquo;<?php echo Q35_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q35_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":"-35","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q35; ?><\/h1><br \/><i>&rdquo;<?php echo Q35_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2000&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>1300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','36');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":35,"reward":{"wood":1600,"clay":2000,"iron":1800,"crop":1300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 36){

$unarray=array("",CITYWALL,EARTHWALL,"PALISADE");


$wall = $village->resarray['f40'];
if ($wall==0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q36; ?>*<?php echo $unarray[$session->userinfo['tribe']];?>*<\/h1><br \/><i>&rdquo;<?php echo Q36_DESC; ?><b> <?php echo $unarray[$session->userinfo['tribe']];?><\/b> <?php echo Q36_DESC1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q36_ORDER; ?><b><?php echo $unarray[$session->userinfo['tribe']];?><\/b>.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":"-36","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q36; ?>*<?php echo $unarray[$session->userinfo['tribe']];?>*<\/h1><br \/><i>&rdquo;<?php echo Q36_RESP; ?> <b><?php echo $unarray[$session->userinfo['tribe']];?> <\/b> <?php echo Q36_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1700&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1900&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>1400&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','37');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":36,"reward":{"wood":1700,"clay":2100,"iron":1900,"crop":1400},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

//////////////////// Added by Shadow \\\\\\\\\\\\\\\\\\\\\\\\
/////////////////////// AICI SE TERMINA TOTUL \\\\\\\\\\\\\\\\\\\\\\\

// End tasks message
<?php } elseif($_SESSION['qst']== 37 ){
$database->updateUserField($_SESSION['username'],'quest','38',0);
$_SESSION['qst']= 38; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q37; ?><\/h1><br \/><i>&rdquo;<?php echo Q37_DESC; ?>&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":37,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php
} elseif($_SESSION['qst']==90){
$time=time();?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><a href=\"javascript: qst_next('','91');\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":91,"reward":{"gold":15,"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}


<?php
//2
} elseif($_SESSION['qst']==91){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"javascript: qst_next('','92');\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-92,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"javascript: qst_next('','92');\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":92,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>


<?php
//3
} else if($_SESSION['qst']==92){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"javascript: qst_next('','93');\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-93,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"javascript: qst_next('','93');\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":93,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//4
} else if($_SESSION['qst']==93){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"javascript: qst_next('','94');\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"javascript: qst_next('','94');\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>



<?php
//5
} else if($_SESSION['qst']==94){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"javascript: qst_next('','95');\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"javascript: qst_next('','95');\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>


<?php
//6
} else if($_SESSION['qst']==95){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></div></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"javascript: qst_next('','96');\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-96,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"javascript: qst_next('','96');\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":96,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//7
} else if($_SESSION['qst']==96){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></div></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"javascript: qst_next('','97');\"><?php echo T4; ?></a></div></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-24,"reward":{"gold":20,"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"javascript: qst_next('','97');\"><?php echo T4; ?></a></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":24,"reward":{"gold":20,"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

// End tasks message
<?php } else if($_SESSION['qst']== 97){
$database->updateUserField($_SESSION['username'],'quest','38',0);
$_SESSION['qst']= 38; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q37; ?><\/h1><br \/><i>&rdquo;<?php echo Q37_DESC; ?>&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":23,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}





<?php } else { ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Tasks<\/h1><br \/><i>&rdquo;Not loaded!&rdquo;<\/i><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":-25,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }}else{
      if($_SESSION['qst']== 0){
	  ?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Welcome to <?php echo SERVER_NAME; ?>!<\/h1><br \/><i>&rdquo;As I see you have been made chieftain of this little village. I will be your counselor for the first few days and never leave your (right hand) side.&rdquo;<\/i><br \/><br \/><span id=\"qst_accpt\"><a class=\"qle\" href=\"banned.php\">To the first task.<\/a><a class=\"qri\" href=\"banned.php\">Look\u00a0around\u00a0on\u00a0your\u00a0own.<\/a><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><br \/><br \/><br \/><a class=\"qri\" href=\"banned.php\">Play no tasks.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":null,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":1}


<?php } elseif($_SESSION['qst']== 1){

//Check one of Woodcutters is level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$woodL=$tRes['f1']+$tRes['f3']+$tRes['f14']+$tRes['f17'];
if ($woodL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 1: Woodcutter<\/h1><br \/><i>&rdquo;There are four green forests around your village. Construct a woodcutter on one of them. Lumber is an important resource for our new settlement.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Construct a woodcutter.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 1: Woodcutter<\/h1><br \/><i>&rdquo;Yes, that way you gain more lumber.I helped a bit and completed the order instantly.&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><div class=\"rew\"><p class=\"ta_aw\">Your reward:<\/p>Woodcutter instantly completed.<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 2){ 

//Check one of Croplands is level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$cropL=$tRes['f2']+$tRes['f8']+$tRes['f9']+$tRes['f12']+$tRes['f13']+$tRes['f15'];
if ($cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 2: Crop<\/h1><br \/><i>&rdquo;Now your subjects are hungry from working all day. Extend a cropland to improve your subjects' supply. Come back here once the building is complete.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Extend one cropland.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":"-2","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 2: Crop<\/h1><br \/><i>&rdquo;Very good. Now your subjects have enough to eat again...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>10&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":2,"reward":{"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 3){ 

//Check the village name is changed or is default name

$vName=$village->vname;
if ($vName==$session->userinfo['username']."'s village"){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/>Task 3: Your Village's Name<\/h1><br \/><i>&rdquo;Creative as you are you can grant your village the ultimate name.\r\n<br \/><br \/>\r\nClick on 'profile' in the left hand menu and then select 'change profile'...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Change your village's name to something nice.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":"-3","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/>Task 3: Your Village's Name<\/h1><br \/><i>&rdquo;Wow, a great name for their village. It could have been the name of my village!...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":3,"reward":{"wood":30,"clay":60,"iron":30,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 4){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 4: Other Players<\/h1><br \/><i>&rdquo;In <?php echo SERVER_NAME; ?> you play along with billions of other players. Click 'statistics' in the top menu to look up your rank and enter it here.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Look for your rank in the statistics and enter it here.<\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"complete task\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":-4,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 4: Other Players<\/h1><br \/><i>&rdquo;Exactly! That's your rank.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>20&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t","number":4,"reward":{"wood":40,"clay":30,"iron":20,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 5){ 

//Check one of Iron Mines and one of Clay Pites are level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=$tRes['f4']+$tRes['f7']+$tRes['f10']+$tRes['f11'];
$clayL=$tRes['f5']+$tRes['f6']+$tRes['f16']+$tRes['f18'];
if ($ironL<1 || $clayL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 5: Two Building Orders<\/h1><br \/><i>&rdquo;Build an iron mine and a clay pit. Of iron and clay one can never have enough.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p><ul><li>Extend one iron mine.<\/li><li>Extend one clay pit.<\/li><\/ul><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":-5,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 5: Two Building Orders<\/h1><br \/><i>&rdquo;As you noticed, building orders take rather long. The world of <?php echo SERVER_NAME; ?> will continue to spin even if you are offline. Even in a few months there will be many new things for you to discover.\r\n<br \/><br \/>\r\nThe best thing to do is occasionally checking your village and giving you subjects new tasks to do.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":5,"reward":{"wood":50,"clay":60,"iron":30,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 6){ 

//Check message is viewed or no
if ($message->unread || $RB==true){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 6: Messages<\/h1><br \/><i>&rdquo;You can talk to other players using the messaging system. I sent a message to you. Read it and come back here.\r\n<br \/><br \/>\r\nP.S. Don't forget: on the left the reports, on the right the messages.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Read your new message.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":"-6","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"i2","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 6: Messages<\/h1><br \/><i>&rdquo;You received it? Very good.\r\n<br \/><br \/>\r\nHere is some Gold. With Gold you can do several things, e.g. extend your <b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b>-Account or increase your resource production.To do so click <a href=\"banned.php\"><font color=\"#000000\"><?php echo SERVER_NAME; ?><\/font> <b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><\/a> in the left hand menu.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p>20 Gold<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":6,"reward":{"gold":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 7){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 7: Huge Army!<\/h1><br \/><i>&rdquo;Now I've got a very special quest for you. I am hungry. Give me 200 crop!\r\n<br \/><br \/>\r\nIn return I will try to organize a huge army to protect your village.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Send 200 crop to the taskmaster.<\/div><br \/><img class=\"r4\" src=\"img\/x.gif\" title=\"Crop\" alt=\"Crop\" \/>200 <input type=\"hidden\" id=\"qst_val\" value=\"set\" \/><input onclick=\"banned.php\" name=\"qstin\" type=\"button\" value=\"Send crop.\" \/><br \/><font color='#FF0000'><?php if(isset($NoCrop)){echo $NoCrop;}?><font\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"army\"><\/div>\n\t\t","number":-8,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php } elseif($_SESSION['qst']== 8){

//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo $questc->q;?> Task 8: Everything to 1.<\/h1><br \/><i>&rdquo;Now we should increase your resource production a bit. Extend all your resource tiles to level 1.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Extend all resource tiles to level 1.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-12,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 8: Everything to 1.<\/h1><br \/><i>&rdquo;Very good, your resource production just thrives.\r\n<br \/><br \/>\r\nSoon we can start with constructing buildings in the village.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":12,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 9){ 

//Check player Descriptions for [#0]
$Dave= strrpos ($uArray['desc1'],'[#0]');
$Dave2=strrpos ($uArray['desc2'],'[#0]');
if (!is_numeric($Dave) and !is_numeric($Dave2)){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 9: Dove of Peace<\/h1><br \/><i>&rdquo;The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]<\/b> to your profile.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Write the code <b>[#0]<\/b> into your profile by adding it to one of the two description fields.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":"-13","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 9: Dove of Peace<\/h1><br \/><i>&rdquo;Well done! Now everyone can see what a great warrior the world is approached by.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>140&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":13,"reward":{"wood":120,"clay":200,"iron":140,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 10){

//Check cranny builded or no
$cranny = $building->getTypeLevel(23);
if ($cranny == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 10: Cranny<\/h1><br \/><i>&rdquo;It's getting time to erect a cranny. The world of <?php echo SERVER_NAME; ?> is dangerous.\r\n<br \/><br \/>\r\nMany players live by stealing other players' resources. Build a cranny to hide some of your resources from enemies.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Construct a Cranny.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":-14,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 10: Cranny<\/h1><br \/><i>&rdquo;Well done, now it's way harder for your mean fellow players to plunder your village.\r\n<br \/><br \/>\r\nIf under attack, your villagers will hide the resources in the Cranny all on their own.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>150&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>130&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":14,"reward":{"wood":150,"clay":180,"iron":30,"crop":130},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 11){

//Check one of each resource is lvl2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<1 || $clayL<1 || $woodL<1 || $cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 11: To Two.<\/h1><br \/><i>&rdquo;In <?php echo SERVER_NAME; ?> there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Extend one of each resource tile to level 2.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-15","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 11: To Two.<\/h1><br \/><i>&rdquo;Very good, your village grows and thrives!&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":15,"reward":{"wood":60,"clay":50,"iron":40,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 12){ 

//Check player submited number Barracks cost lumber
if ($lSubmited!=210){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 12: Instructions<\/h1><br \/><i>&rdquo;In the ingame instructions you can find short information texts about different buildings and types of units.\r\n<br \/><br \/>\r\nClick on 'instructions' at the left to find out how much lumber is required for the barracks.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Enter how much lumber the barracks cost<\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"complete task\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":"-16","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 12: Instructions<\/h1><br \/><i>"Exactly! Barracks cost 210 lumber."<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t","number":16,"reward":{"wood":50,"clay":30,"iron":60,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 13){

//Check main building lvl is 3 or upper
$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding<3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 13: Main Building<\/h1><br \/><i>&rdquo;Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Extend your main building to level 3.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":-17,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 13: Main Building<\/h1><br \/><i>&rdquo;Well done. The main building level 3 has been completed.\r\n<br><br>\r\nWith this upgrade your master builders can construct more types of buildings and also do so faster.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":17,"reward":{"wood":75,"clay":75,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 14){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 14: Advanced!<\/h1><br \/><i>&rdquo;Look up your rank in the player statistics again and enjoy your progress.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Look for your rank in the statistics and enter it here.<\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"complete task\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":"-18","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 14: Advanced!<\/h1><br \/><i>"Well done! That's your current rank."<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">90&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">60&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":18,"reward":{"wood":100,"clay":90,"iron":100,"crop":60},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 15){

// Ask from plyer ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 16: Weapons or Dough<\/h1><br \/><i>&rdquo;Now you have to make a decision: Either trade peacefully or become a dreaded warrior.\r\n<br \/><br \/>\r\nFor the marketplace you need a granary, for the barracks you need a rally point.&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"\" \/><input onclick=\"banned.php\" type=\"button\" value=\"Economy\" class=\"qb1\"\/><input onclick=\"banned.php\" type=\"button\" value=\"Military\" class=\"qb2\" \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php } elseif($_SESSION['qst']== 16){

// Checking rollypoint builded or no
$rallypoint = $building->getTypeLevel(16);
if ($rallypoint==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 16: Military<\/h1><br \/><i>&rdquo;A brave decision. To be able to send troops you need a rally point.\r\n<br \/><br \/>\r\nThe rally point must be built on a specific building site. The <a href=\"banned.php\">building site<\/a> is located on the right side of the main building, slightly below it. The building site itself is curved.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Construct a rally point.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 16: Military<\/h1><br \/><i>&rdquo;Your rally point has been erected! A good move towards world domination!&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":19,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

<?php } elseif($_SESSION['qst']==17){

// Checking barrack builded or no
$barrack = $building->getTypeLevel(19);
if ($barrack==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 17: Barracks<\/h1><br \/><i>&rdquo;Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.\r\n<br><br>\r\nYou can use the barracks to train troops for fighting.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Construct barracks.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":"-20","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 17: Barracks<\/h1><br \/><i>&rdquo;Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":20,"reward":{"wood":70,"clay":100,"iron":90,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

<?php } elseif($_SESSION['qst']== 18){

// Checking 2 warrior trained or no
$units = $village->unitall;
$unarray=array("","Legionnaire", "Clubswinger","Phalanx");
$unarray2=array("","u1", "u11","u21");
if ($units[$unarray2[$session->userinfo['tribe']]]<2){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 18: Train.<\/h1><br \/><i>&rdquo;Now that you have barracks you can start training troops. Train two <?php echo $unarray[$session->userinfo['tribe']];?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Please train 2 <?php echo $unarray[$session->userinfo['tribe']];?>.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":"-21","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 18: Train.<\/h1><br \/><i>&rdquo;The foundation for your glorious army has been laid.<br \/><br \/>\r\nBefore sending your army off to plunder you should check with the <a href=\"banned.php\">Combat-Simulator<\/a> to see how many troops you need to successfully fight one rat without losses.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>300&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>320&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>360&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>570&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":21,"reward":{"wood":300,"clay":320,"iron":360,"crop":570},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

<?php } elseif($_SESSION['qst']== 19){

// Checking granary builded or no
$granary = $building->getTypeLevel(11);
if ($granary ==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 16: Economy <\/h1><br \/><i>&rdquo;"Trade & Economy was your choice. Golden times await you for sure!"<br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Construct a Granary.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 16: Economy <\/h1><br \/><i>&rdquo;Well done! With the Granary you can store more wheat.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":19,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

<?php } elseif($_SESSION['qst']==20){

// Checking warehouse builded or no
$warehouse = $building->getTypeLevel(10);
if ($warehouse==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 17: Warehouse<\/h1><br \/><i>&rdquo;Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!&rdquo;\r\n<br><br>\r\n<\/i><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Construct Warehouse.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-20","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 17: Warehouse<\/h1><br \/><i>&rdquo;Well done, your Warehouse is complete...&rdquo;<\/i><br \/>Now you have fulfilled all prerequisites required to construct a Marketplace.<br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":20,"reward":{"wood":70,"clay":120,"iron":90,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

<?php } elseif($_SESSION['qst']== 21){

// Checking market builded or no
$market = $building->getTypeLevel(17);
if ($market==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 18: Marketplace.<\/h1><br \/><i>&rdquo;Construct a Marketplace so you can trade with your fellow players.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Please build a Marketplace.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":"-21","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 18: Marketplace.<\/h1><br \/><i>&rdquo;The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>700&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>450&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":21,"reward":{"wood":200,"clay":200,"iron":700,"crop":450},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

<?php } elseif($_SESSION['qst']== 22){

// Checking all resource lvl are 2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 19: Everything to 2.<\/h1><br \/><i>&rdquo;Now it's time again to extend the cornerstones of might and wealth! This time level 1 is not enough... it will take a while but in the end it will be worth it. Extend all your resource tiles to level 2!&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Extend all resource tiles to level 2.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-22","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 19: Everything to 2.<\/h1><br \/><i>&rdquo;Congratulations! Your village grows and thrives...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p>15 Gold<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":22,"reward":{"gold":15},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php } ?>

////////////////// DE AICI INCEPE TOT \\\\\\\\\\\\\\\\\\\\\\\
//////////////////// Added by Shadow \\\\\\\\\\\\\\\\\\\\\\\\\

<?php } elseif($_SESSION['qst']== 28){

$aid = $session->alliance;
$allianceinfo = $database->getAlliance($aid);
if ($aid['alliance'] == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 20: Alliance.<\/h1><br \/><i>&rdquo;Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Join an alliance or found one on your own.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":"-28","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 20: Alliance.<\/h1><br \/><i>&rdquo;Is good! Now you're in a union called <b><?php echo $allianceinfo['tag'];?><\/b>, and you're a member of their alliance with the faster you'll progress...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>240&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>280&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":28,"reward":{"wood":240,"clay":280,"iron":180,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 29){

$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding < 5){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 21: Main Building to Level 5<\/h1><br \/><i>&rdquo;To be able to build a palace or residence, you will need a main building at level 5.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Upgrade your main building to level 5.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":"-29","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 21: Main Building to Level 5<\/h1><br \/><i>&rdquo;The main building is level 5 now and you can build palace or residence...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>750&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":29,"reward":{"wood":600,"clay":750,"iron":600,"crop":300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 30){

$granary = $building->getTypeLevel(11);
if ($granary < 3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 22: Granary to Level 3.<\/h1><br \/><i>&rdquo;That you do not lose crop, you should upgrade your granary.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Upgrade your granary to level 3.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-30","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 22: Granary to Level 3.<\/h1><br \/><i>&rdquo;Granary is level 3 now...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>900&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>850&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":30,"reward":{"wood":900,"clay":850,"iron":600,"crop":300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 31){

$warehouse = $building->getTypeLevel(10);
if ($warehouse < 7){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 23: Warehouse to Level 7.<\/h1><br \/><i>&rdquo;To make sure your resources won't overflow, you should upgrade your warehouse.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Upgrade your warehouse to level 7.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-31","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 23: Warehouse to Level 7.<\/h1><br \/><i>&rdquo;Warehouse has upgraded to level 7...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2000&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1650&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>800&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":31,"reward":{"wood":1800,"clay":2000,"iron":1650,"crop":800},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 32){

//Check one of each resource is lvl5 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>4){$ironL++;};if($tRes['f7']>4){$ironL++;};if($tRes['f10']>4){$ironL++;};if($tRes['f11']>4){$ironL++;}
if($tRes['f5']>4){$clayL++;};if($tRes['f6']>4){$clayL++;};if($tRes['f16']>4){$clayL++;};if($tRes['f18']>4){$clayL++;}
if($tRes['f1']>4){$woodL++;};if($tRes['f3']>4){$woodL++;};if($tRes['f14']>4){$woodL++;};if($tRes['f17']>4){$woodL++;}
if($tRes['f2']>4){$cropL++;};if($tRes['f8']>4){$cropL++;};if($tRes['f9']>4){$cropL++;};if($tRes['f12']>4){$cropL++;};if($tRes['f13']>4){$cropL++;};if($tRes['f15']>4){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 24: All to five!<\/h1><br \/><i>&rdquo;You will always need more resources. Resource tiles are quite expensive but will always pay out in the long term.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Upgrade all resources tiles to level 5.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-32","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 24: All to five!<\/h1><br \/><i>&rdquo;All resources were to level 5, the village's products have gone up and take a step forward...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>1800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1950&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>1200&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":32,"reward":{"wood":1600,"clay":1800,"iron":1950,"crop":1200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 33){

$residence = $building->getTypeLevel(25);
$palace = $building->getTypeLevel(26);
if($palace >= 10){
$text = "Palace ";
}else if($residence >= 10){
$text = "Residence ";
}
if ($residence<10 && $palace<10){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 25: Palace or Residence?<\/h1><br \/><i>&rdquo;To found a new village, you will need settlers. Those you can train in either a palace or a residence.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Build a palace or residence to level 10.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":"-33","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 25: Palace or Residence?<\/h1><br \/><i>&rdquo;<?php echo $text; ?> had reached to level 10, you can now train settlers and found your second village. Notice the cultural points...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>3400&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>3600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>2200&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":33,"reward":{"wood":3400,"clay":2800,"iron":3600,"crop":2200},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 34){

// Checking 3 settlers trained or no
$units = $village->unitall;
$unarray2=array("","u10", "u20","u30");
if ($units[$unarray2[$session->userinfo['tribe']]]<3){ $cp = CP;?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 26: 3 settlers.<\/h1><br \/><i>&rdquo;To found a new village, you will need settlers. You can train them in the palace or residence.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Train 3 settlers.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":"-34","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 26: 3 settlers.<\/h1><br \/><i>&rdquo;3 settlers were trained. To found new village you need at least <?php $mode = CP; $total = count($database->getProfileVillages($session->uid)); echo ${'cp'.$mode}[$total+1]; ?> culture points...&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1050&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>900&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>750&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":34,"reward":{"wood":1050,"clay":800,"iron":900,"crop":750},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 35){

$vil = $database->getProfileVillages($session->uid);
if (count($vil)<2){ ?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 27: New Village.<\/h1><br \/><i>&rdquo;There are a lot of empty tiles on the map. Find one that suits you and found a new village.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Found a new village.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":"-35","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 27: New Village.<\/h1><br \/><i>&rdquo;I am proud of you! Now you have two villages and have all the possibilities to build a mighty empire. I wish you luck with this.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2000&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1800&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>1300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"new_village\"><\/div>\n\t\t","number":35,"reward":{"wood":1600,"clay":2000,"iron":1800,"crop":1300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 36){

$unarray=array("","city wall", "earth wall","palisade");


$wall = $village->resarray['f40'];
if ($wall==0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 28: Build a <?php echo $unarray[$session->userinfo['tribe']];?><\/h1><br \/><i>&rdquo;Now that you have trained some soldiers, you should build a <?php echo $unarray[$session->userinfo['tribe']];?> too. It increases the base defence and your soldiers will receive a defensive bonus.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\">Order:<\/p>Build a <?php echo $unarray[$session->userinfo['tribe']];?>.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":"-36","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Task 28: Build a <?php echo $unarray[$session->userinfo['tribe']];?><\/h1><br \/><i>&rdquo;That's what I'm talking about. A <?php echo $unarray[$session->userinfo['tribe']];?> Very useful. It increases the defence of the troops in the village.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/>Your reward:<\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>1700&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>2100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>1900&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>1400&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\">Continue with the next task.<\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":36,"reward":{"wood":1700,"clay":2100,"iron":1900,"crop":1400},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

//////////////////// Added by Shadow \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/////////////////////// AICI SE TERMINA TOTUL \\\\\\\\\\\\\\\\\\\\\\\

// End tasks message
<?php } elseif($_SESSION['qst']== 23){
$database->updateUserField($_SESSION['username'],'quest','24',0);
$_SESSION['qst']= 24; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Tasks<\/h1><br \/><i>&rdquo;All tasks achieved!&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":23,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php
} elseif($_SESSION['qst']==90){
$time=time();?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":91,"reward":{"gold":15,"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}


<?php
//2
} elseif($_SESSION['qst']==91){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\">fetch</a></div></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-92,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":92,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>


<?php
//3
} else if($_SESSION['qst']==92){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\">fetch</a></div></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-93,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":93,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//4
} else if($_SESSION['qst']==93){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\">fetch</a></div></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>



<?php
//5
} else if($_SESSION['qst']==94){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\">fetch</a></div></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>


<?php
//6
} else if($_SESSION['qst']==95){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</div></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\">fetch</a></div></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-96,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">on hold</td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":96,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//7
} else if($_SESSION['qst']==96){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</div></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\">fetch</a></div></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-24,"reward":{"gold":20,"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> Resource overview</h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\">Your resource deliveries</th></tr><tr><td></td><td>Delivery</td><td>Delivery time</td><td>Status</td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\">1 day Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr class=\"c\"><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\">fetched</td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\">2 days Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\">fetch</a></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":24,"reward":{"gold":20,"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

// End tasks message
<?php } else if($_SESSION['qst']== 97){
$database->updateUserField($_SESSION['username'],'quest','24',0);
$_SESSION['qst']= 24; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Tasks<\/h1><br \/><i>&rdquo;All tasks achieved!&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":23,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}




<?php } else {

 }} ?>

