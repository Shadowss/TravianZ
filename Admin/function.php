<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       05.03.2014                                                  ##
##  Filename:      Admin/function.php  				                           ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     Shadow and ronix                                            ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     TravianZ (c) 2014 - All rights reserved                     ##
##  URLs:          http://travian.shadowss/ro                                  ##
##  Source code:   https://github.com/Shadowss/TravianZ	                       ##
##                                                                             ##
#################################################################################

class funct {

  function CheckLogin(){
	if($_SESSION['access'] >= MULTIHUNTER and $_SESSION['id']){
	  return true;
	}else{
	  return false;
	}
  }

   function Act($get){
    global $admin,$database;

    switch($get['action']){
      case "recountPop":
        $admin->recountPop($get['did']);
        $admin->recountCP($get['did']);
      break;
      case "recountPopUsr":
        $admin->recountPopUser($get['uid']);
      break;
      case "StopDel":
        //stop deleting
      break;
      case "delVil":
        if($get['mode'] != 1){
        $admin->DelVillage($get['did']);
        }else{
        $admin->DelVillage($get['did'], 1);
        }
      break;
      case "delBan":
        $admin->DelBan($get['uid'],$get['id']);
        //remove ban
      break;
      case "addBan":
        if($get['time']){$end = time()+$get['time']; }else{$end = '';}

          if(is_numeric($get['uid'])){
          $get['uid'] = $get['uid'];
          }else{
          $get['uid'] = $database->getUserField(addslashes($get['uid']),'id',1);
          }

        $admin->AddBan($get['uid'],$end,$get['reason']);
        //add ban
      break;
      case "delOas":
        //oaza
      break;
      case "logout":
        $this->LogOut();
      break;
      case "killHero":
        $varray = $database->getProfileVillages($get['uid']);
        $killhero=false;
        $error="";
        for ($i = 0; $i <= count($varray)-1; $i++) {
            $killhero=$database->FindHeroInVil($varray[$i]['wref']);
            if ($killhero) break;
            $killhero=$database->FindHeroInDef($varray[$i]['wref']);
            if ($killhero) break;
            $killhero=$database->FindHeroInMovement($varray[$i]['wref']);
            if ($killhero) break;
        }
        if (!$killhero){
            $killhero=$database->FindHeroInOasis($get['uid']);
        }    
        if ($killhero) {
            $database->KillMyHero($get['uid']);
            $error="&kc=1";
        }else $error="&e=1";    
        header("Location: admin.php?p=player&uid=".$get['uid'].$error);
        exit;
      case "reviveHero":
        $result=$database->query("SELECT * FROM ".TB_PREFIX."hero WHERE uid='".$get['uid']."'");
        $hdata=mysql_fetch_array($result);
        $database->query("UPDATE ".TB_PREFIX."units SET hero = 1 WHERE vref = ".$hdata['wref']);
        $database->query("UPDATE ".TB_PREFIX."hero SET `dead` = '0', `inrevive` = '0', `health` = '100', `lastupdate` = ".time()." WHERE `uid` = '".$get['uid']."'");
        header("Location: admin.php?p=player&uid=".$get['uid']."&rc=1");
        exit;
      case "addHero":
        $user = $database->getUserArray($get['uid'],1);
        $vilarray=$database->getVrefCapital($get['uid']);
        
        $database->query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`,
        `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`,
        `intraining`) VALUES ('".$get['uid']."', '" . $vilarray['wref'] . "', '0', '".$get['u']."', '".addslashes($user['username'])."',
        '0', '5', '0', '0', '100', '0', '0', '0', '0', '".time()."', '50', '0')");
        
        $database->query("UPDATE ".TB_PREFIX."units SET hero = 1 WHERE vref = ".$vilarray['wref']);
        
        header("Location: admin.php?p=player&uid=".$get['uid']."&ac=1");
        exit;
		}
    if($get['action'] == 'logout'){
      header("Location: admin.php");
    }else{
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  }

  function Act2($post){
    global $admin,$database;
      switch($post['action']){
      case "DelPlayer":
        $admin->DelPlayer($post['uid'],$post['pass']);
        header("Location: ?p=search&msg=ursdel");
      break;
      case "punish":
        $admin->Punish($post);
        header("Location: ".$_SERVER['HTTP_REFERER']);
      break;
      case "addVillage":
        $admin->AddVillage($post);
        header("Location: ".$_SERVER['HTTP_REFERER']);
      break;
      }
  }

  function LogIN($username,$password){
	global $admin,$database;
	if($admin->Login($username,$password)){
	  //$_SESSION['username'] = $username;
	  $_SESSION['access'] = $database->getUserField($username,'access',1);
	  $_SESSION['id'] = $database->getUserField($username,'id',1);
	  header("Location: ".$_SERVER['HTTP_REFERER']);
	  //header("Location: admin.php");
	}else{
	  echo "Error";
	}
  }

  function LogOut(){
	$_SESSION['access'] = '';
	$_SESSION['id'] = '';
  }

	public function procResType($ref) {
		global $session;
		switch($ref) {
			case 1: $build = "Woodcutter"; break;
			case 2: $build = "Clay Pit"; break;
			case 3: $build = "Iron Mine"; break;
			case 4: $build = "Cropland"; break;
			case 5: $build = "Sawmill"; break;
			case 6: $build = "Brickyard"; break;
			case 7: $build = "Iron Foundry"; break;
			case 8: $build = "Grain Mill"; break;
			case 9: $build = "Bakery"; break;
			case 10: $build = "Warehouse"; break;
			case 11: $build = "Granary"; break;
			case 12: $build = "Blacksmith"; break;
			case 13: $build = "Armoury"; break;
			case 14: $build = "Tournament Square"; break;
			case 15: $build = "Main Building"; break;
			case 16: $build = "Rally Point"; break;
			case 17: $build = "Marketplace"; break;
			case 18: $build = "Embassy"; break;
			case 19: $build = "Barracks"; break;
			case 20: $build = "Stable"; break;
			case 21: $build = "Workshop"; break;
			case 22: $build = "Academy"; break;
			case 23: $build = "Cranny"; break;
			case 24: $build = "Town Hall"; break;
			case 25: $build = "Residence"; break;
			case 26: $build = "Palace"; break;
			case 27: $build = "Treasury"; break;
			case 28: $build = "Trade Office"; break;
			case 29: $build = "Great Barracks"; break;
			case 30: $build = "Great Stable"; break;
			case 31: $build = "City Wall"; break;
			case 32: $build = "Earth Wall"; break;
			case 33: $build = "Palisade"; break;
			case 34: $build = "Stonemason's Lodge"; break;
			case 35: $build = "Brewery"; break;
			case 36: $build = "Trapper"; break;
			case 37: $build = "Hero's Mansion"; break;
			case 38: $build = "Great Warehouse"; break;
			case 39: $build = "Great Granary"; break;
			case 40: $build = "Wonder of the World"; break;
			case 41: $build = "Horse Drinking Trough"; break;
			default: $build = "Error"; break;
		}
		return $build;
	}

};

$funct = new funct;
if($funct->CheckLogin()){
  if($_GET['action']){
	$funct->Act($_GET);
  }
  if($_POST['action']){
	$funct->Act2($_POST);
  }
}
if($_POST['action']=='login'){
  $funct->LogIN($_POST['name'],$_POST['pw']);
}
?>
