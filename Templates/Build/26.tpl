<?php
error_reporting(e_all);
if(time() - $_SESSION['time_p'] > 5) {
  $_SESSION['time_p'] = '';
  $_SESSION['error_p'] = '';
}

if($_POST AND $_GET['action'] == 'change_capital') {
  $pass = mysql_escape_string($_POST['pass']);
  $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'users` WHERE `id` = ' . $session->uid);
  $data = mysql_fetch_assoc($query);
  if($data['password'] == md5($pass)) {
    $query1 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $session->uid . ' AND `capital` = 1');
    $data1 = mysql_fetch_assoc($query1);
    $query2 = mysql_query('SELECT * FROM `' . TB_PREFIX . 'fdata` WHERE `vref` = ' . $data1['wref']);
    $data2 = mysql_fetch_assoc($query2);
    if($data2['vref'] != $village->wid) {
      for($i = 1; $i<=18; ++$i) {
        if($data2['f' . $i] > 10) {
          $query2 = mysql_query('UPDATE `' . TB_PREFIX . 'fdata` SET `f' . $i . '` = 10 WHERE `vref` = ' . $data2['vref']) or die(mysql_error());
        }
      }
      
      for($i=19; $i<=40; ++$i) {
        if($data2['f' . $i . 't'] == 34) {
          $query3 = mysql_query('UPDATE `' . TB_PREFIX . 'fdata` SET `f' . $i . 't` = 0, `f' . $i . '` = 0 WHERE `vref` = ' . $data2['vref']) or die(mysql_error());
        }
      }
      
      $query3 = mysql_query('UPDATE `' . TB_PREFIX . 'vdata` SET `capital` = 0 WHERE `wref` = ' . $data1['wref']);
      $query4 = mysql_query('UPDATE `' . TB_PREFIX . 'vdata` SET `capital` = 1 WHERE `wref` = ' . $village->wid);
    }
    #print '<script language="javascript">location.href="build.php?id=' . $building->getTypeField(26) . '";</script>';
  } else {
    $error = '<br /><font color="red">password is wrong</font><br />';
    $_SESSION['error_p'] = $error;
    $_SESSION['time_p'] = time();
    print '<script language="javascript">location.href="build.php?id=' . $building->getTypeField(26) . '&confirm=yes";</script>';
  }
}
?>
<div id="build" class="gid26"><h1>Palace <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(26,4, 'gid');"
		class="build_logo"> <img
		class="building g26"
		src="img/x.gif" alt="Palace"
		title="Palace" /> </a>
	The king or queen of the empire lives in the palace. Only one palace can exist in your realm at a time. You need a palace in order to proclaim a village to be your capital.</p>

<?php 
if ($building->getTypeLevel(26) > 0) {

include("26_menu.tpl"); 

$test=$database->getAvailableExpansionTraining();

if($village->resarray['f'.$id] >= 10){
	include ("26_train.tpl");	
}
else{
	echo '<div class="c">In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.</div>';
}

?>

<?php
$query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $session->uid . ' AND `capital` = 1');
$data = mysql_fetch_assoc($query);
if($data['wref'] == $village->wid) {
?>
<p class="none">This is your capital</p>
<?php 
} else {
  if($_GET['confirm'] == '') {
    print '<p><a href="?id=' . $building->getTypeField(26) . '&confirm=yes">&raquo change capital</a></p>';
  } else {
    print '<p>Are you sure, that you want to change your capital?<br /><b>You can\'t undone this!</b>.<br />For security you must enter your password to confirm:<br />
    <form method="post" action="build.php?id=' . $building->getTypeField(26) . '&action=change_capital">
     ' . $_SESSION['error_p'] . '
     password: <input type="password" name="pass" /><br />
     <input type="image" id="btn_ok" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" />
    </form>
    </p>';
  }
}
} else {
	echo "<b>Palace under construction</b>";
}
include("upgrade.tpl");
?>
</div>
