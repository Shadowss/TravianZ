<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : COMMANDCENTER                                             ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Created by     : Shadow                                                    ##
##  Developed by   : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

global $village, $id, $session, $database, $building, $automation;

if(time() - (!empty($_SESSION['time_p']) ? $_SESSION['time_p'] : 0) > 5){
	$_SESSION['time_p'] = '';
	$_SESSION['error_p'] = '';
}
// --- CHANGE CAPITAL LOGIC (Command Center = echivalentul Palatului la Huni) ---
if($_POST && isset($_GET['action']) && $_GET['action'] == 'change_capital' && !$village->capital){
	$pass = $_POST['pass'];
	$query = mysqli_query($database->dblink, 'SELECT password FROM `'.TB_PREFIX.'users` WHERE `id` = '.(int)$session->uid);
	$data = mysqli_fetch_assoc($query);
	if(password_verify($pass, $data['password'])){
		$query1 = mysqli_query($database->dblink, 'SELECT wref FROM `'.TB_PREFIX.'vdata` WHERE `owner` = '.(int)$session->uid.' AND `capital` = 1');
		$data1 = mysqli_fetch_assoc($query1);
		$oldWid = (int)$data1['wref'];
		$newWid = (int)$village->wid;

		if($oldWid != $newWid){
			$query2 = mysqli_query($database->dblink, 'SELECT * FROM `'.TB_PREFIX.'fdata` WHERE `vref` = '.$oldWid);
			$data2 = mysqli_fetch_assoc($query2);
			$query3 = mysqli_query($database->dblink, 'SELECT * FROM `'.TB_PREFIX.'fdata` WHERE `vref` = '.$newWid);
			$data3 = mysqli_fetch_assoc($query3);

			// 1. campurile de resurse ale vechii capitale coboara la nivel 10
			for($i = 1; $i <= 18; ++$i){
				if($data2['f'.$i] > 10){
					mysqli_query($database->dblink, 'UPDATE `'.TB_PREFIX.'fdata` SET `f'.$i.'` = 10 WHERE `vref` = '.$oldWid);
				}
			}
			// 2. sterge Stonemason's Lodge (34) din vechea capitala
			for($i = 19; $i <= 40; ++$i){
				if($data2['f'.$i.'t'] == 34){
					mysqli_query($database->dblink, 'UPDATE `'.TB_PREFIX.'fdata` SET `f'.$i.'t` = 0, `f'.$i.'` = 0 WHERE `vref` = '.$oldWid);
				}
			}
			// 3. sterge cladirile capital-only din noua capitala
			//    (Great Barracks 29, Great Stable 30, Great Granary 38, Great Warehouse 39, Great Workshop 49)
			$capitalOnly = [29,30,38,39,49];
			for($i = 19; $i <= 40; ++$i){
				if(in_array((int)$data3['f'.$i.'t'], $capitalOnly)){
					mysqli_query($database->dblink, 'UPDATE `'.TB_PREFIX.'fdata` SET `f'.$i.'t` = 0, `f'.$i.'` = 0 WHERE `vref` = '.$newWid);
				}
			}

			$database->changeCapital($oldWid, 0);
			$database->changeCapital($newWid);

			if(!isset($automation)){
				include_once("GameEngine/Automation.php");
			}
			$automation->recountPop($oldWid, false);
			$automation->recountPop($newWid, false);

			header("location: build.php?gid=44");
			exit;
		}
	}else{
		$error = '<br /><font color="red">'.LOGIN_PW_ERROR.'</font><br />';
		$_SESSION['error_p'] = $error;
		$_SESSION['time_p'] = time();
		echo '<script>location.href="build.php?id='.$building->getTypeField(44).'&confirm=yes";</script>';
		exit;
	}
}

$level = (int)$village->resarray['f'.$id];
?>
<div id="build" class="gid44">
    <h1><?php echo COMMANDCENTER;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc">
        <a href="#" onClick="return Popup(44,4, 'gid');" class="build_logo">
            <img class="building g44" src="img/x.gif" alt="<?php echo COMMANDCENTER; ?>" title="<?php echo COMMANDCENTER;?>" />
        </a>
        <?php echo COMMANDCENTER_DESC;?>
    </p>

    <?php include("25_menu.tpl"); ?>

    <?php if ($level >= 10):?>
        <?php include("44_train.tpl");?>
    <?php else:?>
        <div class="c"><?php echo COMMANDCENTER_TRAIN_DESC;?></div>
    <?php endif;?>

    <?php
    // --- CAPITALA: afisare stare / schimbare (identic cu Palatul) ---
    if($village->capital == 1) {
        echo '<p class="none">'.CAPITAL.'</p>';
    } else {
        if(empty($_GET['confirm'])) {
            print '<p><a href="?id='.$building->getTypeField(44).'&confirm=yes">&raquo; '.CHANGE_CAPITAL.'</a></p>';
        } else {
            print '<p>Are you sure, that you want to change your capital?<br /><b>You can\'t undo this!</b><br />For security you must enter your password to confirm:<br />
<form method="post" action="build.php?id='.$building->getTypeField(44).'&action=change_capital">
'.(isset($_SESSION['error_p']) ? $_SESSION['error_p'] : '').'
'.PASSWORD.': <input type="password" name="pass" /><br />
<input type="image" id="btn_ok" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="'.TRAIN.'" />
</form>
</p>';
        }
    }
    ?>

    <?php include("upgrade.tpl");?>
</div>