<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       05.03.2014                                                  ##
##  Filename:      Admin/database.php      			                           ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     Shadow and ronix                                            ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     TravianZ (c) 2014 - All rights reserved                     ##
##  URLs:          http://travian.shadowss/ro                                  ##
##  Source code:   https://github.com/Shadowss/TravianZ	                       ##
##                                                                             ##
#################################################################################
if($gameinstall == 1){
include_once("../../GameEngine/config.php");
include_once("../../GameEngine/Data/buidata.php");
}else{
include_once("../GameEngine/config.php");
include_once("../GameEngine/Data/buidata.php");
include_once("../GameEngine/Data/unitdata.php");
include_once("../GameEngine/Technology.php");
include_once("../GameEngine/Units.php");
}
class adm_DB {
	var $connection;

  function adm_DB(){
	global $database;
		$this->connection = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysqli_error($database->dblink));
		mysqli_select_db($this->connection, SQL_DB) or die(mysqli_error($database->dblink));
	}

	function Login($username,$password){
		global $database;
		list($username,$password) = $database->escape_input($username,$password);

		$q = "SELECT id, password, is_bcrypt FROM ".TB_PREFIX."users where username = '$username' and access >= ".MULTIHUNTER;
		$result = mysqli_query($this->connection, $q);
		
		// if we didn't update the database for bcrypt hashes yet...
		if (mysqli_error($database->dblink) != '') {
		    // no need to select ID here, since the DB is not updated, so there will be no password conversion later
		    $q = "SELECT id, password, 0 as is_bcrypt FROM ".TB_PREFIX."users where username = '$username' and access >= ".MULTIHUNTER;
		    $result = mysqli_query($this->connection, $q);
		    $bcrypt_update_done = false;
		} else {
		    $bcrypt_update_done = true;
		}
		
		$dbarray = mysqli_fetch_array($result);
		
		// even if we didn't do a DB conversion for bcrypt passwords,
		// we still need to check if this password wasn't encrypted via password_hash,
		// since all methods were updated to use that instead of md5 and therefore
		// new passwords in DB will be bcrypt already even without the is_bcrypt field present
		$bcrypted = true;
		$pwOk = password_verify($password, $dbarray['password']);

		if (!$pwOk && !$dbarray['is_bcrypt']) {
		    $pwOk = ($dbarray['password'] == md5($password));
		    $bcrypted = false;
		}
		
		if($pwOk) {
		    // update password to bcrypt, if correct
		    if (!$dbarray['is_bcrypt'] && !$bcrypted) {
		        mysqli_query($this->connection, "UPDATE " . TB_PREFIX . "users SET password = '".password_hash($password, PASSWORD_BCRYPT,['cost' => 12])."'".($bcrypt_update_done ? ', is_bcrypt = 1' : '')." where id = ".(int) $dbarray['id']);
		    }

		    mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,'X','$username logged in (IP: <b>".$_SERVER['REMOTE_ADDR']."</b>)',".time().")");

			return true;
		}
		else {
		    mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,'X','<font color=\'red\'><b>IP: ".$_SERVER['REMOTE_ADDR']." tried to log in with username <u> $username</u> but access was denied!</font></b>',".time().")");
			return false;
		}
	}

	function recountPopUser($uid){
	 global $database;
	 $villages = $database->getProfileVillages($uid);
	for ($i = 0; $i <= count($villages)-1; $i++) {
	  $vid = $villages[$i]['wref'];
	  $this->recountPop($vid);
	  $this->recountCP($vid);
	}
  }

	function recountPop($vid){
	global $database;
	$fdata = $database->getResourceLevel($vid);
	$popTot = 0;
	for ($i = 1; $i <= 40; $i++) {
	  $lvl = $fdata["f".$i];
	  $building = $fdata["f".$i."t"];
	  if($building){
		$popTot += $this->buildingPOP($building,$lvl);
	  }
	}
	$q = "UPDATE ".TB_PREFIX."vdata set pop = $popTot where wref = ".(int) $vid;
	mysqli_query($this->connection, $q);
  }

  function buildingPOP($f,$lvl){
	$name = "bid".$f;
		global $$name;
		$popT = 0;
		$dataarray = $$name;
	for ($i = 0; $i <= $lvl; $i++) {
	  $popT += $dataarray[$i]['pop'];
	}
	return $popT;
  }
  
          function buildingCP($f,$lvl){
        $name = "bid".$f;
        global $$name;
                $popT = 0;
                $dataarray = $$name;

                for ($i = 0; $i <= $lvl; $i++) {
                        $popT += $dataarray[$i]['cp'];
                }
        return $popT;
        }
  
          function recountCP($vid){
        global $database;
        $fdata = $database->getResourceLevel($vid);
        $popTot = 0;
        for ($i = 1; $i <= 40; $i++) {
                $lvl = $fdata["f".$i];
                $building = $fdata["f".$i."t"];
                if($building){
                $popTot += $this->buildingCP($building,$lvl);
                }
        }
        $q = "UPDATE ".TB_PREFIX."vdata set cp = $popTot where wref = ".(int) $vid;
        mysqli_query($this->connection, $q);
        }

	function getWref($x,$y) {
		$q = "SELECT id FROM ".TB_PREFIX."wdata where x = ".(int) $x." and y = ".(int) $y;
		$result = mysqli_query($this->connection, $q);
		$r = mysqli_fetch_array($result);
		return $r['id'];
	}

	function AddVillage($post){
	global $database;
	  $wid = $this->getWref($post['x'],$post['y']);
	  $uid = (int) $post['uid'];
	$status = $database->getVillageState($wid);
	$status = 0;
	if($status == 0){
	mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Added new village <b><a href=\'admin.php?p=village&did=$wid\'>$wid</a></b> to user <b><a href=\'admin.php?p=player&uid=$uid\'>$uid</a></b>',".time().")");
	  $database->setFieldTaken($wid);
		  $database->addVillage($wid,$uid,'new village','0');
		  $database->addResourceFields($wid,$database->getVillageType($wid));
		  $database->addUnits($wid);
		  $database->addTech($wid);
		  $database->addABTech($wid);
	}
  }

	function Punish($post){
	 global $database;
	   $villages = $database->getProfileVillages($post['uid']);
	   $admid = $post['admid'];
	   $user = $database->getUserArray($post['uid'],1);
		  for ($i = 0; $i <= count($villages)-1; $i++) {
			$vid = $villages[$i]['wref'];
			if($post['punish']){
			  $popOld = $villages[$i]['pop'];
			  $proc = 100-$post['punish'];
			  $pop = floor(($popOld/100)*($proc));
				if($pop <= 1 ){$pop = 2;}
				$this->PunishBuilding($vid,$proc,$pop);

			}
			if($post['del_troop']){
				if($user['tribe'] == 1) {
				  $unit = 1;
				}else if($user['tribe'] == 2) {
				  $unit = 11;
				}else if($user['tribe'] == 3) {
				  $unit = 21;
				}
				  $this->DelUnits($villages[$i]['wref'],$unit);
			}
			if($post['clean_ware']){
			  $time = time();
			  $q = "UPDATE ".TB_PREFIX."vdata SET `wood` = '0', `clay` = '0', `iron` = '0', `crop` = '0', `lastupdate` = '$time' WHERE wref = ".(int) $vid;
			  mysqli_query($this->connection, $q);
			}
		  }
			mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Punished user: <a href=\'admin.php?p=player&uid=".(int) $post['uid']."\'>".(int) $post['uid']."</a> with <b>-".(int) $post['punish']."%</b> population',".time().")");
  }

  function PunishBuilding($vid,$proc,$pop){
	global $database;
	$q = "UPDATE ".TB_PREFIX."vdata set pop = ".(int) $pop." where wref = ".(int) $vid;;
	mysqli_query($this->connection, $q);
	$fdata = $database->getResourceLevel($vid);
	for ($i = 1; $i <= 40; $i++) {
	  if($fdata['f'.$i]>1){
		$zm = ($fdata['f'.$i]/100)*$proc;
		if($zm < 1){$zm = 1;}else{$zm = floor($zm);}
		$q = "UPDATE ".TB_PREFIX."fdata SET `f$i` = '$zm' WHERE `vref` = ".(int) $vid;
		mysqli_query($this->connection, $q);
	  }
	}
  }

  function DelUnits($vid,$unit){
	for ($i = $unit; $i <= 9+$unit; $i++) {
	  $this->DelUnits2($vid,$unit);
	}
  }

  function DelUnits2($vid,$unit){
	  global $database;
	  $unit = $database->escape($unit);
	  $q = "UPDATE ".TB_PREFIX."units SET `u$unit` = '0' WHERE `vref` = ".(int) $vid;
	  mysqli_query($this->connection, $q);
  }

    function DelPlayer($uid,$pass){
     global $database;
     $ID = (int) $_SESSION['id'];
       if($this->CheckPass($pass,$ID)){
         $villages = $database->getProfileVillages($uid);
          for ($i = 0; $i <= count($villages)-1; $i++) {
            $this->DelVillage($villages[$i]['wref'], 1);
          }
         $q = "DELETE FROM ".TB_PREFIX."hero where uid = ".(int) $uid;
        mysqli_query($this->connection, $q);
 
        $name = $database->getUserField($uid,"username",0);
        mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,$ID,'Deleted user <a>$name</a>',".time().")");
        $q = "DELETE FROM ".TB_PREFIX."users WHERE `id` = $uid;";
         mysqli_query($this->connection, $q);
    }
  }

  function getUserActive() {
	$time = time() - (60*5);
		$q = "SELECT * FROM ".TB_PREFIX."users where timestamp > $time and username != 'support'";
		$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
	}

  function CheckPass($password,$uid){
      $q = "SELECT id,password, is_bcrypt FROM ".TB_PREFIX."users where id = ".(int) $uid." and access = ".ADMIN;
      $result = mysqli_query($this->connection, $q);
      
      // if we didn't update the database for bcrypt hashes yet...
      if (mysqli_error($this->connection) != '') {
          // no need to select ID here, since the DB is not updated, so there will be no password conversion later
          $q = "SELECT password, 0 as is_bcrypt FROM ".TB_PREFIX."users where id = ".(int) $uid." and access = ".ADMIN;
          $result = mysqli_query($this->dblink,$q);
          $bcrypt_update_done = false;
      } else {
          $bcrypt_update_done = true;
      }
      
      $dbarray = mysqli_fetch_array($result);
      
      // even if we didn't do a DB conversion for bcrypt passwords,
      // we still need to check if this password wasn't encrypted via password_hash,
      // since all methods were updated to use that instead of md5 and therefore
      // new passwords in DB will be bcrypt already even without the is_bcrypt field present
      $bcrypted = true;
      $pwOk = password_verify($password, $dbarray['password']);
      
      if (!$pwOk && !$dbarray['is_bcrypt']) {
          $pwOk = ($dbarray['password'] == md5($password));
          $bcrypted = false;
      }
      
      if($pwOk) {
          // update password to bcrypt, if correct
          if ($bcrypt_update_done && !$dbarray['is_bcrypt']) {
              mysqli_query($this->connection, "UPDATE " . TB_PREFIX . "users SET password = '".password_hash($password, PASSWORD_BCRYPT,['cost' => 12])."', is_bcrypt = 1 where id = ".(int) $dbarray['id']);
          }
          return true;
      } else {
          return false;
      }
  }

    function DelVillage($wref, $mode=0){
        global $database;
		$wref = (int) $wreff;
        if($mode==0){
            $q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `wref` = $wref and capital = 0";
      }else{
        $q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `wref` = $wref";
      }
        $result = mysqli_query($this->connection, $q);
        if(mysqli_num_rows($result) > 0){
            mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Deleted village <b>$wref</b>',".time().")");

            $database->clearExpansionSlot($wref);
        
            $q = "DELETE FROM ".TB_PREFIX."abdata where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."bdata where wid = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."market where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."odata where wref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."research where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."tdata where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."fdata where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."training where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."units where vref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."farmlist where wref = $wref";
            mysqli_query($this->connection, $q);
            $q = "DELETE FROM ".TB_PREFIX."raidlist where towref = $wref";
            mysqli_query($this->connection, $q);
        
            $q = "DELETE FROM ".TB_PREFIX."movement where `from` = $wref and proc=0";
            mysqli_query($this->connection, $q);
                
            $getmovement = $database->getMovement(3,$wref,1);
            foreach($getmovement as $movedata) {
                $time = microtime(true);
                $time2 = $time - $movedata['starttime'];
                $database->setMovementProc($movedata['moveid']);
                $database->addMovement(4,$movedata['to'],$movedata['from'],$movedata['ref'],$time,$time+$time2);
            
            }

            //check    return enforcement from del village
            $this->returnTroops($wref);
        
            $q = "DELETE FROM ".TB_PREFIX."vdata WHERE `wref` = $wref";
            mysqli_query($this->connection, $q);
    
            if (mysqli_affected_rows()>0) {
                $q = "UPDATE ".TB_PREFIX."wdata set occupied = 0 where id = $wref";
                mysqli_query($this->connection, $q);
            
                $getprisoners = $database->getPrisoners($wref);
                foreach($getprisoners as $pris) {
                    $troops = 0;
                    for($i=1;$i<12;$i++){
                        $troops += $pris['t'.$i];
                    }
                    $database->modifyUnit($pris['wref'],array("99o"),array($troops),array(0));
                    $database->deletePrisoners($pris['id']);
                }
                $getprisoners = $database->getPrisoners3($wref);
                foreach($getprisoners as $pris) {
                    $troops = 0;
                    for($i=1;$i<12;$i++){
                        $troops += $pris['t'.$i];
                    }
                    $database->modifyUnit($pris['wref'],array("99o"),array($troops),array(0));
                    $database->deletePrisoners($pris['id']);
                }
            }
        }
    }
    
        public function returnTroops($wref) {
        global $database;

        $getenforce=$database->getEnforceVillage($wref,0);
        
        foreach($getenforce as $enforce) {
            
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
                    //echo print_r(array_keys($speeds))."unitspd\n".$i."trib\n";
                    

                } else {
                    $enforce['u'.$i]='0';
                }
                
            }
            
            if( intval($enforce['hero']) > 0){
                $q = "SELECT * FROM ".TB_PREFIX."hero WHERE uid = ".(int) $from['owner']."";
                $result = mysqli_query($q);
                $hero_f=mysqli_fetch_array($result);
                $hero_unit=$hero_f['unit'];
                $speeds[] = $GLOBALS['u'.$hero_unit]['speed'];
            } else {
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
            $time = round($this->procDistanceTime($fromCor,$toCor,min($speeds),$enforce['from'])/$fastertroops);
            
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
            $database->addMovement(4,$wref,$enforce['from'],$reference,time(),($time+time()));
            $database->deleteReinf($enforce['id']);
        }
    }

    public function getTypeLevel($tid,$vid) {
        global $village,$database;
        $keyholder = array();
        
        if($vid == 0) {
            $resourcearray = $village->resarray;
        } else {
            $resourcearray = $database->getResourceLevel($vid);
        }
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

       public function procDistanceTime($coor,$thiscoor,$ref,$vid) {
        global $bid28,$bid14;
        
        $xdistance = ABS($thiscoor['x'] - $coor['x']);
        if($xdistance > WORLD_MAX) {
            $xdistance = (2 * WORLD_MAX + 1) - $xdistance;
        }
        $ydistance = ABS($thiscoor['y'] - $coor['y']);
        if($ydistance > WORLD_MAX) {
            $ydistance = (2 * WORLD_MAX + 1) - $ydistance;
        }
        $distance = SQRT(POW($xdistance,2)+POW($ydistance,2));
        $speed = $ref;
        if($this->getTypeLevel(14,$vid) != 0 && $distance >= TS_THRESHOLD) {
            $speed = $speed * ($bid14[$this->getTypeLevel(14,$vid)]['attri']/100) ;
        }

        if($speed!=0){
        return round(($distance/$speed) * 3600 / INCREASE_SPEED);
        }else{
        return round($distance * 3600 / INCREASE_SPEED);
        }
    }

	function DelBan($uid,$id){
	 global $database;
	$name = addslashes($database->getUserField($uid,"username",0));
	mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Unbanned user <a href=\'admin.php?p=player&uid=$uid\'>$name</a>',".time().")");
	$q = "UPDATE ".TB_PREFIX."users SET `access` = '".USER."' WHERE `id` = ".(int) $uid;
	mysqli_query($this->connection, $q);
	$q = "UPDATE ".TB_PREFIX."banlist SET `active` = '0' WHERE `id` = ".(int) $id;
	mysqli_query($this->connection, $q);
  }

  function AddBan($uid,$end,$reason){
	global $database;
	list($end,$reason) = $database->escape_input($end,$reason);
	$name = addslashes($database->getUserField($uid,"username",0));
	mysqli_query($this->connection,"Insert into ".TB_PREFIX."admin_log values (0,".(int) $_SESSION['id'].",'Banned user <a href=\'admin.php?p=player&uid=$uid\'>$name</a>',".time().")");
	$q = "UPDATE ".TB_PREFIX."users SET `access` = '0' WHERE `id` = ".(int) $uid;
	mysqli_query($this->connection, $q);
	$time = time();
	$admin = (int) $_SESSION['id'];  //$database->getUserField($_SESSION['username'],'id',1);
	$name = addslashes($database->getUserField($uid,'username',0));
	$q = "INSERT INTO ".TB_PREFIX."banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES (".(int) $uid.", '$name' , '$reason', '$time', '$end', '$admin', '1');";
	mysqli_query($this->connection, $q);
  }

  function search_player($player){
	global $database;
	$player = $database->escape($player);
	$q = "SELECT id,username FROM ".TB_PREFIX."users WHERE `username` LIKE '%$player%' and username != 'support'";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

  function search_email($email){
	global $database;
	$email = $database->escape($email);
	$q = "SELECT id,email FROM ".TB_PREFIX."users WHERE `email` LIKE '%$email%' and username != 'support'";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

  function search_village($village){
	global $database;
	$village = $database->escape($village);
	$q = "SELECT * FROM ".TB_PREFIX."vdata WHERE `name` LIKE '%$village%' or `wref` LIKE '%$village%'";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

  function search_alliance($alliance){
	global $database;
	$alliance = $database->escape($alliance);
	$q = "SELECT * FROM ".TB_PREFIX."alidata WHERE `name` LIKE '%$alliance%' or `tag` LIKE '%$alliance%' or `id` LIKE '%$alliance%'";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

  function search_ip($ip){
	global $database;
	$ip = $database->escape($ip);
	$q = "SELECT * FROM ".TB_PREFIX."login_log WHERE `ip` LIKE '%$ip%'";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

  function search_banned(){
	$q = "SELECT * FROM ".TB_PREFIX."banlist where active = '1'";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

  function Del_banned(){
	//$q = "SELECT * FROM ".TB_PREFIX."banlist";
	$result = mysqli_query($this->connection, $q);
	return $this->mysqli_fetch_all($result);
  }

	/***************************
	Function to process MYSQLi->fetch_all (Only exist in MYSQL)
	References: Result
	***************************/
	function mysqli_fetch_all($result) {
		$all = array();
		if($result) {
		while ($row = mysqli_fetch_assoc($result)){ $all[] = $row; }
		return $all;
		}
	}

	function query_return($q) {
		$result = mysqli_query($this->connection, $q);
		return $this->mysqli_fetch_all($result);
	}

	/***************************
	Function to do free query
	References: Query
	***************************/
	function query($query) {
		return mysqli_query($query, $this->connection);
	}


};

$admin = new adm_DB;
include("function.php");
?>
