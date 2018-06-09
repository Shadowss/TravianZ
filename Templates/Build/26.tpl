<?php
if(time() - (!empty($_SESSION['time_p']) ? $_SESSION['time_p'] : 0) > 5){
	$_SESSION['time_p'] = '';
	$_SESSION['error_p'] = '';
}

if($_POST and $_GET['action'] == 'change_capital' && !$village->capital){
	$pass = mysqli_escape_string($database->dblink, $_POST['pass']);
	$query = mysqli_query($database->dblink, 'SELECT password FROM `'.TB_PREFIX.'users` WHERE `id` = '.(int)$session->uid);
	$data = mysqli_fetch_assoc($query);
	if(password_verify($pass, $data['password'])){
		$query1 = mysqli_query($database->dblink, 'SELECT wref FROM `'.TB_PREFIX.'vdata` WHERE `owner` = '.(int)$session->uid.' AND `capital` = 1');
		$data1 = mysqli_fetch_assoc($query1);
		$query2 = mysqli_query($database->dblink, 'SELECT * FROM `'.TB_PREFIX.'fdata` WHERE `vref` = '.(int)$data1['wref']);
		$data2 = mysqli_fetch_assoc($query2);
		if($data2['vref'] != $village->wid){
			for($i = 1; $i <= 18; ++$i){
				if($data2['f'.$i] > 10){
					$query2 = mysqli_query($database->dblink, 'UPDATE `'.TB_PREFIX.'fdata` SET `f'.$i.'` = 10 WHERE `vref` = '.(int)$data2['vref']);
				}
			}
			for($i = 19; $i <= 40; ++$i){
				if($data2['f'.$i.'t'] == 34){
					$query3 = mysqli_query($database->dblink, 'UPDATE `'.TB_PREFIX.'fdata` SET `f'.$i.'t` = 0, `f'.$i.'` = 0 WHERE `vref` = '.(int)$data2['vref']);
				}
			}
			
			for($i = 19; $i <= 40; ++$i){
				if($data2['f'.$i.'t'] == 29 || $data2['f'.$i.'t'] == 30 || $data2['f'.$i.'t'] == 38 || $data2['f'.$i.'t'] == 39 || $data2['f'.$i.'t'] == 42){
					$query3 = mysqli_query($database->dblink, 'UPDATE `'.TB_PREFIX.'fdata` SET `f'.$i.'t` = 0, `f'.$i.'` = 0 WHERE `vref` = '.(int)$village->wid);
				}
			}	
			
			$database->changeCapital((int)$data1['wref'], 0);
			$database->changeCapital($village->wid);
			header("location: build.php?gid=26");
			exit;
		}
	}else{
		$error = '<br /><font color="red">'.LOGIN_PW_ERROR.'</font><br />';
		$_SESSION['error_p'] = $error;
		$_SESSION['time_p'] = time();
		echo '<script language="javascript">location.href="build.php?id='.$building->getTypeField(26).'&confirm=yes";</script>';
	}
}
?>
<div id="build" class="gid26"><h1><?php echo PALACE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
        <a href="#" onClick="return Popup(26,4, 'gid');"
                class="build_logo"> <img
                class="building g26"
                src="img/x.gif" alt="Palace"
                title="<?php echo PALACE; ?>" /> </a>
        <?php echo PALACE_DESC; ?></p>

<?php
if ($building->getTypeLevel(26) > 0) {

include("26_menu.tpl");

if($village->resarray['f'.$id] >= 10) include ("26_train.tpl");
else echo '<div class="c">'.PALACE_TRAIN_DESC.'</div>';

?>

<?php
if($village->capital == 1) {
?>
<p class="none"><?php echo CAPITAL; ?></p>
<?php
} else {
  if(empty($_GET['confirm'])) {
    print '<p><a href="?id='.$building->getTypeField(26).'&confirm=yes">&raquo '.CHANGE_CAPITAL.'</a></p>';
  } else {
    print '<p>Are you sure, that you want to change your capital?<br /><b>You can\'t undo this!</b><br />For security you must enter your password to confirm:<br />
<form method="post" action="build.php?id='.$building->getTypeField(26).'&action=change_capital">
'.$_SESSION['error_p'].'
'.PASSWORD.': <input type="password" name="pass" /><br />
<input type="image" id="btn_ok" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" />
</form>
</p>';
  }
}
} 
else echo "<b><?php echo PALACE_CONSTRUCTION; ?></b>";

include("upgrade.tpl");
?>
</div>