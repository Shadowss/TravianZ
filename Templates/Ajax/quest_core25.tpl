<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					                           ##
##  Version:       01.09.2013 						                           ##
##  Filename       quest_core25.tpl                                            ##
##  Developed by:  DesPlus and Marvin                                          ##
##  Fixed by:      Shadow / Skype : cata7007 and Armando                       ##
##  Revision by:   noonn                                 		               ##
##  Official Quest by: ronix                                                   ## 
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				                   ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	           ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) {
 session_start();
}
include_once("GameEngine/Village.php");
include_once("GameEngine/Data/cp.php");

$uArray = $database->getUserArray($_SESSION['username'],0);
$check_quest=$uArray['quest'];
$_SESSION['qst_time'] = $uArray['quest_time'];

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

if (isset($qact)){
	if ($qact == $_SESSION['qst']+1 && (($_SESSION['qst']>= 1 && $_SESSION['qst']<=30) || (time()-$_SESSION['qst_time']>=0 && ($_SESSION['qst'] >= 90 && $_SESSION['qst'] <=97))) || ($_SESSION['qst']== 0 && ($qact == "enter" || $qact == "skip")) || ($qact == "rank" && ($_SESSION['qst']== 4 || $_SESSION['qst']== 18)) || ($_SESSION['qst']== 7 && $qact == "coor") || ($_SESSION['qst']== 16 && $qact == "lumber") || ($_SESSION['qst']== 19 && $qact == 23) || ($_SESSION['qst']== 22 && $qact == 26) || ($_SESSION['qst']== 27 && $qact == "gold")) {		//avoid hacking gold, resources or reward -- added by Ronix - Fixed by Pietro
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
			$Subject=Q6_SUBJECT;
			$Message=Q6_MESSAGE;
			$database->sendMessage($session->userinfo['id'],4,$Subject,$Message,0,0,0,0,0);
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

		case 'coor':
			$x=$qact2;
			$y=$qact3;
			break;
			
		case '8':
			$database->updateUserField($_SESSION['username'],'quest','8',0);
			$_SESSION['qst']= 8;
			//Give Reward
			$database->modifyResource($session->villages[0],60,30,40,90,1);
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
			$database->modifyResource($session->villages[0],100,80,40,40,1);
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

		case '12':
			$database->updateUserField($_SESSION['username'],'quest','12',0);
			$_SESSION['qst']= 12;
			//Give Reward
			$database->modifyResource($session->villages[0],75,140,40,40,1);	
			break;
		
		case '13':
			$database->updateUserField($_SESSION['username'],'quest','13',0);
			$_SESSION['qst']= 13;
			//Give Reward
			$database->modifyResource($session->villages[0],75,80,30,50,1);
			break;
	
		case '14':
			$database->updateUserField($_SESSION['username'],'quest','14',0);
			$_SESSION['qst']= 14;
			//Give Reward
			$database->modifyResource($session->villages[0],120,200,140,100,1);
			break;

		case '15':
			$database->updateUserField($_SESSION['username'],'quest','15',0);
			$_SESSION['qst']= 15;
			//Give Reward
			$database->modifyResource($session->villages[0],150,180,30,130,1);
			break;
	
		case '16':
			$database->updateUserField($_SESSION['username'],'quest','16',0);
			$_SESSION['qst']= 16;
			//Give Reward
			$database->modifyResource($session->villages[0],60,50,40,30,1);
			break;

		case 'lumber':
			$lSubmited=$qact2;
			break;

		case '17':
			$database->updateUserField($_SESSION['username'],'quest','17',0);
			$_SESSION['qst']= 17;
			//Give Reward
			$database->modifyResource($session->villages[0],50,30,60,20,1);
			break;
	
		case '18':
			$database->updateUserField($_SESSION['username'],'quest','18',0);
			$_SESSION['qst']= 18;
			//Give Reward
			$database->modifyResource($session->villages[0],75,75,40,40,1);
			break;
	
		case '19':
			$database->updateUserField($_SESSION['username'],'quest','19',0);
			$_SESSION['qst']= 19;
			//Give Reward
			$database->modifyResource($session->villages[0],100,90,100,60,1);
			break;
	
		case '20':
			$database->updateUserField($_SESSION['username'],'quest','20',0);
			$_SESSION['qst']= 20;
			break;

		case '21':
			$_SESSION['dough']= true;
			$database->updateUserField($_SESSION['username'],'quest','21',0);
			$_SESSION['qst']= 21;
			//Give Reward granary
			$database->modifyResource($session->villages[0],80,90,60,40,1);
			break;
	
		case '22':
			$database->updateUserField($_SESSION['username'],'quest','22',0);
			$_SESSION['qst']= 22;
			//Give Reward warehouse
			$database->modifyResource($session->villages[0],70,120,90,50,1);
			break;
	
		case '23':
			$database->updateUserField($_SESSION['username'],'quest','23',0);
			$_SESSION['qst']= 23;
			//Give Reward
			//$database->modifyResource($session->villages[0],80,90,60,40,1);
			break;
	
		case '24':
			$database->updateUserField($_SESSION['username'],'quest','24',0);
			$_SESSION['qst']= 24;
			//Give Reward rally point
			$database->modifyResource($session->villages[0],80,90,60,40,1);
			break;
	
		case '25':
			//$dataarray[3] = 1;
			$database->updateUserField($_SESSION['username'],'quest','25',0);
			$_SESSION['qst']= 25;
			//Give Reward barrack
			$database->modifyResource($session->villages[0],70,100,90,100,1);
			break;

		case '26':
			//$dataarray[4] = 1;
			$database->updateUserField($_SESSION['username'],'quest','26',0);
			$_SESSION['qst']= 26;
			//Give Reward
			if (isset($_SESSION['dough']) && $_SESSION['dough']==true) {
				unset($_SESSION['dough']);
				$database->modifyResource($session->villages[0],200,200,700,250,1);
			}else{
				$database->modifyResource($session->villages[0],300,320,360,370,1);
			}
			break;

		case '27':
			//$dataarray[5] = 1;
			$database->updateUserField($_SESSION['username'],'quest','27',0);
			$_SESSION['qst']= 27;
			//Give Reward
			$gold=$database->getUserField($_SESSION['username'],'gold',1);
			$gold+=15;
			$database->updateUserField($_SESSION['username'],'gold',$gold,0);
			break;
		
		case 'gold':
			$lSubmited=$qact2;
			break;
			
		case '28':
			//$dataarray[6] = 1;
			$database->updateUserField($_SESSION['username'],'quest','28',0);
			$_SESSION['qst']= 28;
			//Give Reward
			$database->modifyResource($session->villages[0],80,70,60,40,1);
			break;
			
		case '29':
			//$dataarray[7] = 1;
			$database->updateUserField($_SESSION['username'],'quest','29',0);
			$_SESSION['qst']= 29;
			//Give Reward
			$database->modifyResource($session->villages[0],100,60,90,40,1);
			break;
    
		case '30':
			//$dataarray[8] = 1;
			$database->updateUserField($_SESSION['username'],'quest','30',0);
			$_SESSION['qst']= 30;
			//Give Reward
			$database->modifyResource($session->villages[0],100,140,90,50,1);
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
				$plus=$database->getUserField($_SESSION['username'],'plus',1);
				$plus+=86400;
				$database->updateUserField($_SESSION['username'],'plus',$plus,0);
			}
			$gold=$database->getUserField($_SESSION['username'],'gold',1);
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
				$plus=$database->getUserField($_SESSION['username'],'plus',1);
				$plus+=172800;
				$database->updateUserField($_SESSION['username'],'plus',$plus,0);
			}
			$gold=$database->getUserField($_SESSION['username'],'gold',1);
			$gold+=20;
			$database->updateUserField($_SESSION['username'],'gold',$gold,0);
			break;
		}	
	}
}

header("Content-Type: application/json;");
if($session->access!=BANNED){
    if($_SESSION['qst']== 0){?>
{"markup":"<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo Q0; ?> <?php echo SERVER_NAME; ?>!<\/h1><br \/><i>&rdquo;<?php echo Q0_DESC; ?>&rdquo;<\/i><br><br><span id=\"qst_accpt\"><a class=\"qle\" href=\"javascript: qst_next('','enter')\"><?php echo Q0_OPT1; ?></a><a class=\"qri\" href=\"javascript: qst_fhandle();\"><?php echo Q0_OPT2; ?></a><input type=\"hidden\" id=\"qst_val\" value=\"2\"><br><br><br><a class=\"qri\" href=\"javascript: qst_next('','skip');\"><?php echo Q0_OPT3; ?></a></span></div><div id=\"qstbg\" class=\"intro\"></div>","number":null,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":1}

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
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_RESP; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q1_REWARD; ?><br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','2')\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
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
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q4_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','rank',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":-4,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
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
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q6; ?><\/h1><br \/><i>&rdquo;<?php echo Q6_RESP; ?><b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><?php echo Q6_RESP1; ?><a href=\"plus.php?id=3\"><font color=\"#000000\"><?php echo SERVER_NAME; ?><\/font> <b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><\/a> <?php echo Q6_RESP2; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p>20 <img src=\"img\/x.gif\" class=\"gold\" alt=\"Gold\" title=\"Gold\" \/><br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','7');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":6,"reward":{"gold":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 7){
//neighbourhood
$getvID = $database->getVillageID($session->uid);
$nvillage = $database->getFieldDistance($getvID);
$ncoor = $database->getCoor($nvillage);
$nvillagename = $database->getVillageField($nvillage,"name");
if ($x!=$ncoor['x'] or $y!=$ncoor['y']){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_7; ?></h1><br><i>&rdquo;<?php echo Q25_7_DESC; ?> <b><?php echo $nvillagename; ?></b>. <?php echo Q25_7_DESC1; ?>&rdquo;</i><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_7_ORDER; ?> <b><?php echo $nvillagename; ?></b> <?php echo Q25_7_ORDER1; ?></div><div id=\"map_coords\"><span>X </span><input class=\"text\" value=\"\" maxlength=\"4\" id=\"qst_val_x\" name=\"xp\"><span> Y </span><input class=\"text\" value=\"\" maxlength=\"4\" id=\"qst_val_y\" name=\"xy\"> <input type=\"button\" value=\"<?php echo Q_BUTN; ?>\" onclick=\"qst_next2('1','coor',document.getElementById('qst_val_x').value,document.getElementById('qst_val_y').value)\"></div></div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":-7,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_7; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_7_RESP; ?> <b> <?php echo $nvillagename;?> <\/b> <?php echo Q25_7_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>90&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','8');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":7,"reward":{"wood":60,"clay":30,"iron":40,"crop":90},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 8){
//hugh army
?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_8; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_8_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_8_ORDER; ?><\/div><br \/><img class=\"r4\" src=\"img\/x.gif\" title=\"Crop\" alt=\"Crop\" \/>200 <input type=\"hidden\" id=\"qst_val\" value=\"set\" \/><input onclick=\"javascript: qst_next('','9');\" name=\"qstin\" type=\"button\" value=\"<?php echo Q25_8_BUTN; ?>\" \/><br \/><font color='#FF0000'><?php if(isset($NoCrop)){echo $NoCrop;}?><font\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"army\"><\/div>\n\t\t","number":-8,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php } elseif($_SESSION['qst']== 9){
//one each
//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}

if ($ironL<2 || $clayL<2 || $woodL<2 || $cropL<2){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_9; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_9_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_9_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-9,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_9; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_9_RESP; ?>&rdquo;\r\n<br \/><br \/>\r\n<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','10');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":9,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 10){
//comming soon
//Check rat is in villa
$rat = $database->getEnforce($session->villages[0], 0);
if ($rat['u31']<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_10; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_10_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_10_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"army\"><\/div>\n\t\t","number":-10,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_10; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_10_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q25_10_REWARD; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','11');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"army\"><\/div>\n\t\t","number":10,"reward":{"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 11){ 

//Check report is viewed or no
if (count($database->getUnViewNotice($session->uid))>0) {?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_11; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_11_DESC; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_11_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"report\"><\/div>\n\t\t","number":"-11","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"i2","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_11; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_11_RESP; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>140&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','12');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"report\"><\/div>\n\t\t","number":11,"reward":{"wood":75,"clay":140,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 12){
//everything to One
//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_12; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_12_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_12_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-12,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_12; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_12_RESP; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','13');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":12,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 13){ 

//Check player Descriptions for [#0]
$Dave= strrpos ($uArray['desc1'],'[#0]');
$Dave2=strrpos ($uArray['desc2'],'[#0]');
if (!is_numeric($Dave) and !is_numeric($Dave2)){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_13; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_13_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_13_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":"-13","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_13; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_13_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>140&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','14');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":13,"reward":{"wood":120,"clay":200,"iron":140,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 14){

//Check cranny builded or no
$cranny = $building->getTypeLevel(23);
if ($cranny == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_14; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_14_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_14_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":-14,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_14; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_14_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>150&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>130&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','15');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":14,"reward":{"wood":150,"clay":180,"iron":30,"crop":130},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 15){

//Check one of each resource is lvl2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<1 || $clayL<1 || $woodL<1 || $cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_15; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_15_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_15_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-15","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_15; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_15_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','16');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":15,"reward":{"wood":60,"clay":50,"iron":40,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 16){ 

//Check player submited number Barracks cost lumber
if ($lSubmited!=210){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_16; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_16_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_16_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','lumber',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":"-16","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_16; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_16_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','17');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":16,"reward":{"wood":50,"clay":30,"iron":60,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 17){

//Check main building lvl is 3 or upper
$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding<3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_17; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_17_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_17_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":-17,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_17; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_17_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','18');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":17,"reward":{"wood":75,"clay":75,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 18){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_18; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_18_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_18_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','rank',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":"-18","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_18; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_18_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">90&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">60&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','19');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":18,"reward":{"wood":100,"clay":90,"iron":100,"crop":60},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 19){

// Ask from plyer ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_19; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_19_DESC; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"\" \/><input onclick=\"javascript: qst_next('','20');\" type=\"button\" value=\"<?php echo Q25_19_BUTN; ?>\" class=\"qb1\"\/><input onclick=\"javascript: qst_next('','23');\" type=\"button\" value=\"<?php echo Q25_19_BUTN1; ?>\" class=\"qb2\" \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php } elseif($_SESSION['qst']== 20){

// Checking granary builded or no
$granary = $building->getTypeLevel(11);
if ($granary ==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_20; ?> <\/h1><br \/><i>&rdquo;<?php echo Q25_20_DESC; ?>&rdquo;<br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_20_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary\"><\/div>\n\t\t","number":"-20","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_20; ?> <\/h1><br \/><i>&rdquo;<?php echo Q25_20_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','21');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary\"><\/div>\n\t\t","number":20,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']==21){

// Checking warehouse builded or no
$warehouse = $building->getTypeLevel(10);
if ($warehouse==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_21; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_21_DESC; ?>&rdquo;\r\n<br><br>\r\n<\/i><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_21_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-21","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_21; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_21_RESP; ?><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','22');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":21,"reward":{"wood":70,"clay":120,"iron":90,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 22){

// Checking market builded or no
$market = $building->getTypeLevel(17);
if ($market==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_22; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_22_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_22_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":"-22","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_22; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_22_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','26');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":22,"reward":{"wood":200,"clay":200,"iron":700,"crop":450},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 23){

// Checking rollypoint builded or no
$rallypoint = $building->getTypeLevel(16);
if ($rallypoint==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_23; ?><\/h1><br \/><i>&rdquo; <?php echo Q25_23_DESC; ?> <a href=\"build.php?id=39\"><?php echo Q25_23_DESC1; ?><\/a> <?php echo Q25_23_DESC2; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_23_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rally\"><\/div>\n\t\t","number":"-23","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_23; ?><\/h1><br \/><i>&rdquo; <?php echo Q25_23_RESP; ?> &rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','24');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rally\"><\/div>\n\t\t","number":23,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']==24){

// Checking barrack builded or no
$barrack = $building->getTypeLevel(19);
if ($barrack==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_24; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_24_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_24_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":"-24","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_24; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_24_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','25');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":24,"reward":{"wood":70,"clay":100,"iron":90,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 25){

// Checking 2 warrior trained or no
$units = $village->unitall;
$unarray=array("",U1,U11,U21);
$unarray2=array("","u1", "u11","u21");
if ($units[$unarray2[$session->userinfo['tribe']]]<2){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_25; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_25_DESC; ?> <?php echo $unarray[$session->userinfo['tribe']];?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_25_ORDER; ?> <?php echo $unarray[$session->userinfo['tribe']];?>.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":"-25","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_25; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_25_RESP; ?> <a href=\"warsim.php\"><?php echo Q25_25_RESP1; ?><\/a>  <?php echo Q25_25_RESP2; ?> &rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>300&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>320&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>360&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>370&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','26');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":25,"reward":{"wood":300,"clay":320,"iron":360,"crop":570},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 26){

// Checking all resource lvl are 2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_26; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_26_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-26","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_26; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p>15 <img src=\"img\/x.gif\" class=\"gold\" alt=\"Gold\" title=\"Gold\" \/><br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','27');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":26,"reward":{"gold":15},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 27){ 

//Check player submited number gold
if ($lSubmited!=50){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_27; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_27_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_27_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"qst_next('','gold',document.getElementById('qst_val').value)\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"gold\"><\/div>\n\t\t","number":"-27","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_27; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_27_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','28');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"gold\"><\/div>\n\t\t","number":27,"reward":{"wood":50,"clay":30,"iron":60,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 28){
//check embassy exist
$embassy = $building->getTypeLevel(18);
if ($embassy < 1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_28; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_28_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_28_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"embassy\"><\/div>\n\t\t","number":"-28","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_28; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_28_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','29');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"embassy\"><\/div>\n\t\t","number":28,"reward":{"wood":600,"clay":750,"iron":600,"crop":300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 29){
//check create alliance or joined
$aid = $session->alliance;
$allianceinfo = $database->getAlliance($aid);
if ($aid==0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_29; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_29_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_29_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"ally\"><\/div>\n\t\t","number":"-29","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_29; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_29_RESP; ?> <b><?php echo $allianceinfo['tag'];?><\/b><?php echo Q25_29_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>140&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>60&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"javascript: qst_next('','30');\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"ally\"><\/div>\n\t\t","number":29,"reward":{"wood":240,"clay":280,"iron":180,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 30 ){
// End tasks message
$database->updateUserField($_SESSION['username'],'quest','31',0);
$_SESSION['qst']= 31; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_30; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_30_DESC; ?>&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":30,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
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
$database->updateUserField($_SESSION['username'],'quest','31',0);
$_SESSION['qst']= 31; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_30; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_30_DESC; ?>&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":23,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php } else { ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> Tasks<\/h1><br \/><i>&rdquo;Not loaded!&rdquo;<\/i><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":-25,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }}else{
      if($_SESSION['qst']== 0){
	  ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q0; ?> <?php echo SERVER_NAME; ?>!<\/h1><br \/><i>&rdquo;<?php echo Q0_DESC; ?>&rdquo;<\/i><br \/><br \/><span id=\"qst_accpt\"><a class=\"qle\" href=\"banned.php\"><?php echo Q0_OPT1; ?><\/a><a class=\"qri\" href=\"banned.php\"><?php echo Q0_OPT2; ?><\/a><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><br \/><br \/><br \/><a class=\"qri\" href=\"banned.php\"><?php echo Q0_OPT3; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"intro\"><\/div>\n\t\t","number":null,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":1}

<?php } elseif($_SESSION['qst']== 1){

//Check one of Woodcutters is level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$woodL=$tRes['f1']+$tRes['f3']+$tRes['f14']+$tRes['f17'];
if ($woodL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q1_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q1; ?><\/h1><br \/><i>&rdquo;<?php echo Q1_RESP; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q1_REWARD; ?><br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"wood\"><\/div>\n\t\t","number":"-1","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 2){ 

//Check one of Croplands is level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$cropL=$tRes['f2']+$tRes['f8']+$tRes['f9']+$tRes['f12']+$tRes['f13']+$tRes['f15'];
if ($cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q2; ?><\/h1><br \/><i>&rdquo;<?php echo Q2_DESC; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q2_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":"-2","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q2; ?><\/h1><br \/><i>&rdquo;<?php echo Q2_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q2_REWARD; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"farm\"><\/div>\n\t\t","number":2,"reward":{"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 3){ 

//Check the village name is changed or is default name
$vName=$village->vname;
if ($vName==$session->userinfo['username']."'s village"){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q3; ?><\/h1><br \/><i>&rdquo;<?php echo Q3_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q3_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":"-3","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q3; ?><\/h1><br \/><i>&rdquo;<?php echo Q3_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"village_name\"><\/div>\n\t\t","number":3,"reward":{"wood":30,"clay":60,"iron":30,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 4){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q4_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q4_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":-4,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q4; ?><\/h1><br \/><i>&rdquo;<?php echo Q4_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>20&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t","number":4,"reward":{"wood":40,"clay":30,"iron":20,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 5){ 

//Check one of Iron Mines and one of Clay Pites are level 1 or upper 
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=$tRes['f4']+$tRes['f7']+$tRes['f10']+$tRes['f11'];
$clayL=$tRes['f5']+$tRes['f6']+$tRes['f16']+$tRes['f18'];
if ($ironL<1 || $clayL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q5; ?><\/h1><br \/><i>&rdquo;<?php echo Q5_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q5_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":-5,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/><?php echo Q5; ?><\/h1><br \/><i>&rdquo;<?php echo Q5_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"clay_iron\"><\/div>\n\t\t","number":5,"reward":{"wood":50,"clay":60,"iron":30,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 6){ 

//Check message is viewed or no
if ($message->unread || $RB==true){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q6; ?><\/h1><br \/><i>&rdquo;<?php echo Q6_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q6_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":"-6","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"i2","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q6; ?><\/h1><br \/><i>&rdquo;<?php echo Q6_RESP; ?><b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><?php echo Q6_RESP1; ?><a href=\"plus.php?id=3\"><font color=\"#000000\"><?php echo SERVER_NAME; ?><\/font> <b><font color=\"#71D000\">P<\/font><font color=\"#FF6F0F\">l<\/font><font color=\"#71D000\">u<\/font><font color=\"#FF6F0F\">s<\/font><\/b><\/a> <?php echo Q6_RESP2; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p>20 Gold<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"msg\"><\/div>\n\t\t","number":6,"reward":{"gold":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 7){
//neighbourhood
$getvID = $database->getVillageID($session->uid);
$nvillage = $database->getFieldDistance($getvID);
$ncoor = $database->getCoor($nvillage);
$nvillagename = $database->getVillageField($nvillage,"name");
if ($x!=$ncoor['x'] or $y!=$ncoor['y']){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_7; ?></h1><br><i>&rdquo;<?php echo Q25_7_DESC; ?> <b><?php echo $nvillagename; ?></b>. <?php echo Q25_7_DESC1; ?>&rdquo;</i><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_7_ORDER; ?> <b><?php echo $nvillagename; ?></b> <?php echo Q25_7_ORDER1; ?></div><div id=\"map_coords\"><span>X </span><input class=\"text\" value=\"\" maxlength=\"4\" id=\"qst_val_x\" name=\"xp\"><span> Y </span><input class=\"text\" value=\"\" maxlength=\"4\" id=\"qst_val_y\" name=\"xy\"> <input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q25_7_BUTN; ?>\"></div></div><span id=\"qst_accpt\"><\/span><\/div><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":-7,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_7; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_7_RESP; ?> <b> <?php echo $nvillagename;?> <\/b> <?php echo Q25_7_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>90&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"neighbour\"><\/div>\n\t\t","number":7,"reward":{"wood":60,"clay":30,"iron":40,"crop":90},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 8){
//hugh army
?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_8; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_8_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_8_ORDER; ?><\/div><br \/><img class=\"r4\" src=\"img\/x.gif\" title=\"Crop\" alt=\"Crop\" \/>200 <input type=\"hidden\" id=\"qst_val\" value=\"set\" \/><input onclick=\"banned.php\" name=\"qstin\" type=\"button\" value=\"<?php echo Q25_8_BUTN; ?>\" \/><br \/><font color='#FF0000'><?php if(isset($NoCrop)){echo $NoCrop;}?><font\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"army\"><\/div>\n\t\t","number":-8,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php } elseif($_SESSION['qst']== 9){ 

//one each
//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}

if ($ironL<2 || $clayL<2 || $woodL<2 || $cropL<2){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_9; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_9_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_9_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-9,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_9; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_9_RESP; ?>&rdquo;\r\n<br \/><br \/>\r\n<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":9,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 10){

//comming soon
//Check rat is in villa
$rat = $database->getEnforce($session->villages[0], 0);
if ($rat['u31']>0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_10; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_10_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_10_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-10,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_10; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_10_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q25_10_REWARD; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":10,"reward":{"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 11){

//Check report is viewed or no
if (count($database->getUnViewNotice($session->uid))>0) {?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_11; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_11_DESC; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_11_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"report\"><\/div>\n\t\t","number":"-11","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"i2","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_11; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_11_RESP; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>140&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"report\"><\/div>\n\t\t","number":11,"reward":{"wood":75,"clay":140,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 12){ 

//everything to One
//Check additional of each resource upgraded to lvl1 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>0){$ironL++;};if($tRes['f7']>0){$ironL++;};if($tRes['f10']>0){$ironL++;};if($tRes['f11']>0){$ironL++;}
if($tRes['f5']>0){$clayL++;};if($tRes['f6']>0){$clayL++;};if($tRes['f16']>0){$clayL++;};if($tRes['f18']>0){$clayL++;}
if($tRes['f1']>0){$woodL++;};if($tRes['f3']>0){$woodL++;};if($tRes['f14']>0){$woodL++;};if($tRes['f17']>0){$woodL++;}
if($tRes['f2']>0){$cropL++;};if($tRes['f8']>0){$cropL++;};if($tRes['f9']>0){$cropL++;};if($tRes['f12']>0){$cropL++;};if($tRes['f13']>0){$cropL++;};if($tRes['f15']>0){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_12; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_12_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_12_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":-12,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_12; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_12_RESP; ?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":12,"reward":{"wood":75,"clay":80,"iron":30,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 13){

//Check player Descriptions for [#0]
$Dave= strrpos ($uArray['desc1'],'[#0]');
$Dave2=strrpos ($uArray['desc2'],'[#0]');
if (!is_numeric($Dave) and !is_numeric($Dave2)){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_13; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_13_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_13_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":"-13","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_13; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_13_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q25_13_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>140&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"medal\"><\/div>\n\t\t","number":13,"reward":{"wood":120,"clay":200,"iron":140,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 14){

//Check cranny builded or no
$cranny = $building->getTypeLevel(23);
if ($cranny == 0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_14; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_14_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_14_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":-14,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_14; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_14_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>150&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>130&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"hide\"><\/div>\n\t\t","number":14,"reward":{"wood":150,"clay":180,"iron":30,"crop":130},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 15){

//Check one of each resource is lvl2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<1 || $clayL<1 || $woodL<1 || $cropL<1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_15; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_15_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_15_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-15","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_15; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_15_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>30&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":15,"reward":{"wood":60,"clay":50,"iron":40,"crop":30},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 16){

//Check player submited number Barracks cost lumber
if ($lSubmited!=210){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_16; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_16_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_16_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":"-16","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_16; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_16_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"cost\"><\/div>\n\t\t","number":16,"reward":{"wood":50,"clay":30,"iron":60,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']==17){

//Check main building lvl is 3 or upper
$mainbuilding = $building->getTypeLevel(15);
if ($mainbuilding<3){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_17; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_17_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_17_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":-17,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_17; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_17_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>75&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>40&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"main\"><\/div>\n\t\t","number":17,"reward":{"wood":75,"clay":75,"iron":40,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php }?>

<?php } elseif($_SESSION['qst']== 18){

// Compare real player rank with submited rank
$temp['uid']=$session->userinfo['id'];
$ranking->procRankReq($temp);
$displayarray = $database->getUserArray($temp['uid'],1);
$rRes=$ranking->searchRank($displayarray['username'],"username");
if ($rRes!=$rSubmited){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_18; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_18_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_18_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":"-18","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_18; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_18_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">90&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">100&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">60&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"rank\"><\/div>\n\t\t","number":18,"reward":{"wood":100,"clay":90,"iron":100,"crop":60},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 19){

// Ask from plyer ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_19; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_19_DESC; ?>&rdquo;<\/i><br \/><br \/><input type=\"hidden\" id=\"qst_val\" value=\"\" \/><input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q25_19_BUTN; ?>\" class=\"qb1\"\/><input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q25_19_BUTN1; ?>\" class=\"qb2\" \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-19","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php } elseif($_SESSION['qst']==20){

// Checking granary builded or no
$granary = $building->getTypeLevel(11);
if ($granary ==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_20; ?> <\/h1><br \/><i>&rdquo;<?php echo Q25_20_DESC; ?>&rdquo;<br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_20_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary\"><\/div>\n\t\t","number":"-20","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_20; ?> <\/h1><br \/><i>&rdquo;<?php echo Q25_20_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary\"><\/div>\n\t\t","number":20,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 21){

// Checking warehouse builded or no
$warehouse = $building->getTypeLevel(10);
if ($warehouse==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_21; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_21_DESC; ?>&rdquo;\r\n<br><br>\r\n<\/i><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_21_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":"-21","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_21; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_21_RESP; ?><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>120&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>50&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"warehouse\"><\/div>\n\t\t","number":21,"reward":{"wood":70,"clay":120,"iron":90,"crop":50},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 22){

// Checking market builded or no
$market = $building->getTypeLevel(17);
if ($market==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_22; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_22_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_22_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":"-22","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_22; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_22_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>200&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>700&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>450&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"market\"><\/div>\n\t\t","number":22,"reward":{"wood":200,"clay":200,"iron":700,"crop":450},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 23){

// Checking rollypoint builded or no
$rallypoint = $building->getTypeLevel(16);
if ($rallypoint==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_23; ?><\/h1><br \/><i>&rdquo; <?php echo Q25_23_DESC; ?> <a href=\"banned.php\"><?php echo Q25_23_DESC1; ?><\/a> <?php echo Q25_23_DESC2; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_23_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":"-23","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_23; ?><\/h1><br \/><i>&rdquo; <?php echo Q25_23_RESP; ?> &rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>80&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>40&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"granary_rally\"><\/div>\n\t\t","number":23,"reward":{"wood":80,"clay":90,"iron":60,"crop":40},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']==24){

// Checking barrack builded or no
$barrack = $building->getTypeLevel(19);
if ($barrack==0){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_24; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_24_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_24_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":"-24","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_24; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_24_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>70&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>100&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>90&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"barracks\"><\/div>\n\t\t","number":24,"reward":{"wood":70,"clay":100,"iron":90,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 25){

// Checking 2 warrior trained or no
$units = $village->unitall;
$unarray=array("",U1,U11,U21);
$unarray2=array("","u1", "u11","u21");
if ($units[$unarray2[$session->userinfo['tribe']]]<2){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_25; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_25_DESC; ?> <?php echo $unarray[$session->userinfo['tribe']];?>.&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_25_ORDER; ?> <?php echo $unarray[$session->userinfo['tribe']];?>.<\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":"-25","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_25; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_25_RESP; ?> <a href=\"warsim.php\"><?php echo Q25_25_RESP1; ?><\/a>  <?php echo Q25_25_RESP2; ?> &rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>300&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>320&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>360&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>570&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"units\"><\/div>\n\t\t","number":25,"reward":{"wood":300,"clay":320,"iron":360,"crop":570},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 26){

// Checking all resource lvl are 2 or upper
$tRes = $database->getResourceLevel($session->villages[0]);
$ironL=0;$clayL=0;$woodL=0;$cropL=0;
if($tRes['f4']>1){$ironL++;};if($tRes['f7']>1){$ironL++;};if($tRes['f10']>1){$ironL++;};if($tRes['f11']>1){$ironL++;}
if($tRes['f5']>1){$clayL++;};if($tRes['f6']>1){$clayL++;};if($tRes['f16']>1){$clayL++;};if($tRes['f18']>1){$clayL++;}
if($tRes['f1']>1){$woodL++;};if($tRes['f3']>1){$woodL++;};if($tRes['f14']>1){$woodL++;};if($tRes['f17']>1){$woodL++;}
if($tRes['f2']>1){$cropL++;};if($tRes['f8']>1){$cropL++;};if($tRes['f9']>1){$cropL++;};if($tRes['f12']>1){$cropL++;};if($tRes['f13']>1){$cropL++;};if($tRes['f15']>1){$cropL++;}
if ($ironL<4 || $clayL<4 || $woodL<4 || $cropL<6){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_26; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_26_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":"-26","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_26; ?><\/h1><br \/><i>&rdquo;<?php echo Q24_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p>15 Gold<br \/><\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":26,"reward":{"gold":15},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 27){ 

//Check player submited number gold
if ($lSubmited!=50){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_27; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_27_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_27_ORDER; ?><\/div><br \/><input id=\"qst_val\" class=\"text\" type=\"text\" name=\"qstin\" \/> <input onclick=\"banned.php\" type=\"button\" value=\"<?php echo Q_BUTN; ?>\"\/><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"gold\"><\/div>\n\t\t","number":"-27","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_27; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_27_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>50&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>30&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>60&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>20&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"gold\"><\/div>\n\t\t","number":27,"reward":{"wood":50,"clay":30,"iron":60,"crop":20},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php }?>

<?php } elseif($_SESSION['qst']== 28){
//check embassy exist
$embassy = $building->getTypeLevel(18);
if ($embassy < 1){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_28; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_28_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_28_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"embassy\"><\/div>\n\t\t","number":"-28","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_28; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_28_RESP; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>750&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>600&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>300&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"embassy\"><\/div>\n\t\t","number":28,"reward":{"wood":600,"clay":750,"iron":600,"crop":300},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 29){
//check create alliance or joined
$aid = $session->alliance;
$allianceinfo = $database->getAlliance($aid);
if ($aid==0){?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_29; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_29_DESC; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><?php echo Q25_29_ORDER; ?><\/div><br \/><span id=\"qst_accpt\"><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"alliance\"><\/div>\n\t\t","number":"-29","reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":0}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_29; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_29_RESP; ?> <b><?php echo $allianceinfo['tag'];?><\/b><?php echo Q25_29_RESP1; ?>&rdquo;<\/i><br \/><br \/><div class=\"rew\"><p class=\"ta_aw\"><input type=\"hidden\" id=\"qst_val\" value=\"2\" \/><?php echo Q_REWARD; ?><\/p><img src=\"img\/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\" \/>240&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\" \/>280&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\" \/>180&nbsp;&nbsp;<img src=\"img\/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\" \/>100&nbsp;&nbsp;<\/div><br \/><span id=\"qst_accpt\"><a href=\"banned.php\"><?php echo Q_CONTINUE; ?><\/a><\/span><\/div>\n\t\t<div id=\"qstbg\" class=\"alliance\"><\/div>\n\t\t","number":29,"reward":{"wood":240,"clay":280,"iron":180,"crop":100},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php } elseif($_SESSION['qst']== 30 ){
// End tasks message
$database->updateUserField($_SESSION['username'],'quest','31',0);
$_SESSION['qst']= 31; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_30; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_30_DESC; ?>&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":31,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php } elseif($_SESSION['qst']==90){
$time=time();?>

{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":90,"reward":{"gold":15,"plus":1},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}

<?php
//2
} elseif($_SESSION['qst']==91){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-91,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":91,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//3
} else if($_SESSION['qst']==92){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-92,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":92,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//4
} else if($_SESSION['qst']==93){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-93,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":93,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//5
} else if($_SESSION['qst']==94){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-94,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":94,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//6
} else if($_SESSION['qst']==95){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></div></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\"><?php echo T4; ?></a></div></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T6; ?></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":95,"reward":{"wood":217,"clay":247,"iron":177,"crop":207},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

<?php
//7
} else if($_SESSION['qst']==96){
$time=time();
if ($_SESSION['qst_time']>= $time ){ ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></div></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><div id=\"qst_resonway\" style=\"display:;\"><span id=\"qst_timer\"><?php echo $generator->getTimeFormat($uArray['quest_time']-time());?></div><div id=\"qst_reshere\" style=\"display:none;\"><a href=\"banned.php\"><?php echo T4; ?></a></div></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":-96,"reward":{"gold":20,"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php $_SESSION['qstnew']='0'; }else{ $_SESSION['qstnew']='1'; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img/x.gif\" alt=\"\" title=\"\"> <?php echo OPT3; ?></h1><br><table class=\"altquest\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"4\"><?php echo T; ?></th></tr><tr><td></td><td><?php echo T1; ?></td><td><?php echo T2; ?></td><td><?php echo T3; ?></td></tr></thead><tbody><tr class=\"c\"><td class=\"fc ra\">1</td><td class=\"desc\"><?php echo T7; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>15 Gold<br></td><td class=\"dur\">0:00:00</td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">2</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">3</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">4</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">5</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr class=\"c\"><td class=\"fc ra\">6</td><td class=\"desc\"><img src=\"img/x.gif\" class=\"r1\" alt=\"Lumber\" title=\"Lumber\">217&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"Clay\">247&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"Iron\">177&nbsp;&nbsp;<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"Crop\">207&nbsp;&nbsp;</td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><?php echo T5; ?></td></tr><tr><td class=\"fc ra\">7</td><td class=\"desc\"><?php echo T8; ?> <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></b><br>20 Gold<br></td><td class=\"dur\"><?php echo $generator->getTimeFormat($skipp_time); ?></td><td class=\"lc stat\"><a href=\"banned.php\"><?php echo T4; ?></a></td></tr></tbody></table><span id=\"qst_accpt\"><input type=\"hidden\" id=\"qst_val\"></span></div>\n\t\t","number":96,"reward":{"gold":20,"plus":2},"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":99}
<?php } ?>

// End tasks message
<?php } else if($_SESSION['qst']== 97){
$database->updateUserField($_SESSION['username'],'quest','31',0);
$_SESSION['qst']= 31; ?>
{"markup":"\n\t\t<div id=\"qstd\"><h1> <img class=\"point\" src=\"img\/x.gif\" alt=\"\" title=\"\"\/> <?php echo Q25_30; ?><\/h1><br \/><i>&rdquo;<?php echo Q25_30_DESC; ?>&rdquo;<\/i><br \/><br \/><br \/><\/div>\n\t\t<div id=\"qstbg\" class=\"allres\"><\/div>\n\t\t","number":31,"reward":false,"qgsrc":"q_l<?php echo $session->userinfo['tribe'];?>g","msrc":"<?php echo $messagelol; ?>","altstep":0}

<?php } else {

 }} ?>
