<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editUser.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

$uid = $_GET['uid'];
$user = $database->getUser($uid);
if($_POST){
$profile->updateProfil($_POST);
$database->reload('?uid='.$uid);
}

?>
<div id="content"  class="player" style="width:100%">
<form action="" method="POST">
	<input type="hidden" name="ft" value="p1" />
	<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
	<input type="hidden" name="id" value="<?php echo $id; ?>" />

	<table cellpadding="1" cellspacing="1" id="edit" ><thead>
	<tr>
		<th colspan="3">Player <?php echo $user['username']; ?> </th>
	</tr>
	<tr>
		<td colspan="2">Details</td>

		<td>Description</td>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td colspan="2" class="empty"></td><td class="empty"></td></tr>
	<tr>
	<?php
	if($user['birthday'] != 0) {
   $bday = explode("-",$user['birthday']);
   }
   else {
   $bday = array('','','');
   }
   ?>
	<th>Birthday</th><td class="birth"><input tabindex="1" class="text day" type="text" name="tag" value="<?php echo $bday[2]; ?>" maxlength="2" /> <select tabindex="2" name="monat" size="" class="dropdown">

				<option value="0"></option><option value="1" <?php if($bday[1] == 1) { echo "selected"; } ?>>Jan</option><option value="2"<?php if($bday[1] == 2) { echo "selected"; } ?>>Feb</option><option value="3"<?php if($bday[1] == 3) { echo "selected"; } ?>>Mar</option><option value="4"<?php if($bday[1] == 4) { echo "selected"; } ?>>Apr</option><option value="5"<?php if($bday[1] == 5) { echo "selected"; } ?>>May</option><option value="6"<?php if($bday[1] == 6) { echo "selected"; } ?>>June</option><option value="7"<?php if($bday[1] == 7) { echo "selected"; } ?>>July</option><option value="8"<?php if($bday[1] == 8) { echo "selected"; } ?>>Aug</option><option value="9"<?php if($bday[1] == 9) { echo "selected"; } ?>>Sep</option><option value="10"<?php if($bday[1] == 10) { echo "selected"; } ?>>Oct</option><option value="11"<?php if($bday[1] == 11) { echo "selected"; } ?>>Nov</option><option value="12"<?php if($bday[1] == 12) { echo "selected"; } ?>>Dec</option></select> <input tabindex="3" type="text" name="jahr" value="<?php echo $bday[0]; ?>" maxlength="4" class="text year"></td>

	<td rowspan="100" class="desc1"><textarea tabindex="7" name="be1"><?php echo $user['desc2']; ?></textarea></td></tr>

	<tr><th>Gender</th>
	<td class="gend">
		<label><input class="radio" type="radio" name="mw" value="0" <?php if($user['gender'] == 0) { echo "checked"; } ?> tabindex="4">n/a</label>
		<label><input class="radio" type="radio" name="mw" value="1" <?php if($user['gender'] == 1) { echo "checked"; } ?> >m</label>
		<label><input class="radio" type="radio" name="mw" value="2" <?php if($user['gender'] == 2) { echo "checked"; } ?> >f</label>
	</td></tr>

	<tr><th>Location</th><td><input tabindex="5" type="text" name="ort" value="<?php echo $user['location']; ?>" maxlength="30" class="text"></td></tr>


	<tr><td colspan="2" class="empty"></td></tr>
	<?php
	$varray = $database->getProfileVillages($uid);
	for($i=0;$i<=count($varray)-1;$i++) {
	echo "<tr><th>Village name</th><td><input tabindex=\"6\" type=\"text\" name=\"dname$i\" value=\"".$varray[$i]['name']."\" maxlength=\"20\" class=\"text\"></td></tr>";
	}
	?>
	<tr><td colspan="2" class="empty"></td></tr>

	<tr><td colspan="2" class="desc2"><textarea tabindex="8" name="be2"><?php echo $user['desc1']; ?></textarea></td></tr>
	</table><p class="btn"><input type="image" value="" tabindex="9" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>
	</form>
