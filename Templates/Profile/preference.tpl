<?php 
if(isset($_GET['del']) && is_numeric($_GET['del'])){
	$database->removeLinks($_GET['del'],$session->uid);
	header("Location: spieler.php?s=2");
	exit;
}
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       preference.php                                              ##
##  Developed by:  Dzoki                                                       ##
##  Fixed by:      Shadow / Skype : cata7007                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/	       	               ##
##                                                                             ##
#################################################################################
// Save new link or just edit a link
if(isset($_POST['ft']) && $_POST['ft'] == 'p3'){
    return;
}

if(isset($_POST['nr0']) || isset($_POST['id0']) || isset($_POST['linkname0']) || isset($_POST['linkziel0'])) {
    $links = [];
    
    // let's do some complicated code x'D
    foreach($_POST as $key => $value) {
        if(substr($key, 0, 2) == 'nr') {
            $i = substr($key, 2);
            $links[$i]['nr'] = mysqli_real_escape_string($database->dblink, $value);
        }
        
        if(substr($key, 0, 2) == 'id') {
            $i = substr($key, 2);
            $links[$i]['id'] = mysqli_real_escape_string($database->dblink, $value);
        }
        
        if(substr($key, 0, 8) == 'linkname') {
            $i = substr($key, 8);
            $links[$i]['linkname'] = htmlspecialchars(mysqli_real_escape_string($database->dblink, $value));
        }
        
        if(substr($key, 0, 8) == 'linkziel') {
            $i = substr($key, 8);
            $links[$i]['linkziel'] = htmlspecialchars(mysqli_real_escape_string($database->dblink, $value));
        }
    }
    
    // Save
    foreach($links as $link) {
        settype($link['nr'], 'int');
        
        if(trim($link['nr']) != '' AND trim($link['linkname']) != '' AND trim($link['linkziel']) != '' AND trim($link['id']) == '') {
            // Add new link
            $userid = (int) $session->uid;
            $query = mysqli_query($database->dblink,'INSERT INTO `' . TB_PREFIX . 'links` (`userid`, `name`, `url`, `pos`) VALUES (' . $userid . ', \'' . $link['linkname'] . '\', \'' . $link['linkziel'] . '\', ' . $link['nr'] . ')');
            
        } elseif(trim($link['nr']) != '' AND trim($link['linkname']) != '' AND trim($link['linkziel']) != '' AND trim($link['id']) != '') {
            // Update link
            $query = mysqli_query($database->dblink,'SELECT userid FROM `' . TB_PREFIX . 'links` WHERE `id` = ' . $link['id']);
            $data = mysqli_fetch_assoc($query);
            
            // May the user update this entry?
            if($data['userid'] == $session->uid) {
                $query2 = mysqli_query($database->dblink,'UPDATE `' . TB_PREFIX . 'links` SET `name` = \'' . $link['linkname'] . '\', `url` = \'' . $link['linkziel'] . '\', `pos` = ' . $link['nr'] . ' WHERE `id` = ' . $link['id']);
            }
        } elseif(trim($link['nr']) == '' AND trim($link['linkname']) == '' AND trim($link['linkziel']) == '' AND trim($link['id']) != '') {
            // Delete entry
            $query = mysqli_query($database->dblink,'SELECT userid FROM `' . TB_PREFIX . 'links` WHERE `id` = ' . $link['id']);
            $data = mysqli_fetch_assoc($query);
            
            // May the user delete this entry?
            if($data['userid'] == $session->uid) {
                $query2 = mysqli_query($database->dblink,'DELETE FROM `' . TB_PREFIX . 'links` WHERE `id` = ' . $link['id']);
            }
        }
    }
    echo '<meta http-equiv="refresh" content="0">';
}


// Fetch all links
$query = mysqli_query($database->dblink,'SELECT * FROM `' . TB_PREFIX . 'links` WHERE `userid` = ' . (int) $session->uid . ' ORDER BY `pos` ASC') or die(mysqli_error($database->dblink));
$links = [];
while($data = mysqli_fetch_assoc($query)) $links[] = $data;

//Code for preference (map,timezone,timeformat,etc.)

if(isset($_POST['v1']) || isset($_POST['v2']) || isset($_POST['timezone'])) {

    $v1 = isset($_POST['v1']) ? 1 : 0;
    $v2 = isset($_POST['v2']) ? 1 : 0;
    $v3 = isset($_POST['v3']) ? 1 : 0;
    $map = isset($_POST['map']) ? 1 : 0;
    $v4 = isset($_POST['v4']) ? 1 : 0;
    $v5 = isset($_POST['v5']) ? 1 : 0;
    $v6 = isset($_POST['v6']) ? 1 : 0;

    $timezone = isset($_POST['timezone']) ? intval($_POST['timezone']) : 1;
    $tformat = isset($_POST['tformat']) ? intval($_POST['tformat']) : 0;

    $database->query("
        UPDATE ".TB_PREFIX."users SET
        v1 = $v1,
        v2 = $v2,
        v3 = $v3,
        map = $map,
        v4 = $v4,
        v5 = $v5,
        v6 = $v6,
        timezone = $timezone,
        tformat = $tformat
        WHERE id = ".$session->uid."
    ");

    header("Location: spieler.php?s=2");
    exit;
}
?>

<h1>Player profile</h1>

<?php include("menu.tpl"); ?>
<form action="spieler.php?s=2" method="POST">
<input type="hidden" name="ft" value="p2">
  <table cellpadding="1" cellspacing="1" id="links">
    <thead>
      <tr>
	<th colspan="4">Direct links</th>
      </tr>
      <tr>
	<td>Delete</td>
	<td>No.</td>
	<td>Link name</td>
	<td>Link target</td>
      </tr>
    </thead>      
    <tbody>
	  <?php $i = 0; foreach($links as $link): ?>
      <tr>
	  <td>
	  <a href="spieler.php?del=<?php echo $link['id']; ?>&s=2"><img class="del" src="img/x.gif" alt="delete" title="delete"></a>
	  </td>
	 <td class="nr"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="nr<?php print $i; ?>" value="<?php print $link['pos']; ?>" size="1" maxlength="3" /><input type="hidden" name="id<?php print $i; ?>" value="<?php print $link['id']; ?>" /></td>
	 <td class="nam"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkname<?php print $i; ?>" value="<?php print $link['name']; ?>" maxlength="30" /></td>
	 <td class="txt"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkziel<?php print $i; ?>" value="<?php print $link['url']; ?>" maxlength="255" /></td>          
      </tr>
      <?php ++$i; $last_pos = $link['pos']; endforeach; ?>
      <tr>
	<td></td>
	<td class="nr"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="nr<?php print $i; ?>" value="<?php print ($last_pos + 1); ?>" size="1" maxlength="3"></td>
	<td class="nam"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkname<?php print $i; ?>" value="" maxlength="30"></td>
	<td class="txt"><input <?php if(!$session->plus){echo"disabled";} ?> class="text" type="text" name="linkziel<?php print $i; ?>" value="" maxlength="255"></td>
      </tr>
    </tbody>
  </table>

<table cellpadding="1" cellspacing="1" id="completion" class="set">
<thead>
<tr><th colspan="2">Auto completion</th></tr>
<tr><td colspan="2">Used for rally point and marketplace:</td></tr>
</thead>
<tbody>
<tr>
<td class="sel">
<input class="check" type="checkbox" name="v1" value="1" <?php if($session->userinfo['v1']) echo 'checked'; ?>>
</td>
<td>own villages</td>
</tr>

<tr>
<td class="sel">
<input class="check" type="checkbox" name="v2" value="1" <?php if($session->userinfo['v2']) echo 'checked'; ?>>
</td>
<td>villages of the surroundings</td>
</tr>

<tr>
<td class="sel">
<input class="check" type="checkbox" name="v3" value="1" <?php if($session->userinfo['v3']) echo 'checked'; ?>>
</td>
<td>villages from players of the alliance</td>
</tr>
</tbody>
</table>


<table cellpadding="1" cellspacing="1" id="big_map" class="set">
<thead>
<tr><th colspan="2">Large map</th></tr>
</thead>
<tbody>
<tr>
<td class="sel">
<input class="check" type="checkbox" name="map" <?php if($session->userinfo['map']) echo 'checked'; ?>>
</td>
<td>Show the large map in an extra window.</td>
</tr>
</tbody>
</table>


<table cellpadding="1" cellspacing="1" id="report_filter" class="set">
<thead>
<tr><th colspan="2">Report filter</th></tr>
</thead>
<tbody>

<tr>
<td class="sel">
<input class="check" type="checkbox" name="v4" value="1" <?php if($session->userinfo['v4']) echo 'checked'; ?>>
</td>
<td>No reports for transfers to own villages.</td>
</tr>

<tr>
<td class="sel">
<input class="check" type="checkbox" name="v5" value="1" <?php if($session->userinfo['v5']) echo 'checked'; ?>>
</td>
<td>No reports for transfers to foreign villages.</td>
</tr>

<tr>
<td class="sel">
<input class="check" type="checkbox" name="v6" value="1" <?php if($session->userinfo['v6']) echo 'checked'; ?>>
</td>
<td>No reports for transfers from foreign villages.</td>
</tr>

</tbody>
</table>


<table cellpadding="1" cellspacing="1" id="time" class="set">
<thead>
<tr><th colspan="2">Time preferences</th></tr>
<tr><td colspan="2">Here you can change Travian's displayed time to fit your time zone.</td></tr>
</thead>
<tbody>

<tr>
<th>Time zones</th>
<td>
<select name="timezone" class="dropdown">

<optgroup label="local time zones">
    <option value="495" <?php if($session->userinfo['timezone']==495) echo 'selected'; ?>>Europe</option>
    <option value="99" <?php if($session->userinfo['timezone']==99) echo 'selected'; ?>>UK</option>
    <option value="492" <?php if($session->userinfo['timezone']==492) echo 'selected'; ?>>Turkey</option>
    <option value="328" <?php if($session->userinfo['timezone']==328) echo 'selected'; ?>>Asia/Kolkata</option>
    <option value="345" <?php if($session->userinfo['timezone']==345) echo 'selected'; ?>>Asia/Bangkok</option>
    <option value="257" <?php if($session->userinfo['timezone']==257) echo 'selected'; ?>>USA/New York</option>
    <option value="189" <?php if($session->userinfo['timezone']==189) echo 'selected'; ?>>USA/Chicago</option>
    <option value="474" <?php if($session->userinfo['timezone']==474) echo 'selected'; ?>>New Zealand</option>
</optgroup>

<optgroup label="general time zones">
    <option value="12" <?php if($session->userinfo['timezone']==12) echo 'selected'; ?>>UTC-11</option>
    <option value="13" <?php if($session->userinfo['timezone']==13) echo 'selected'; ?>>UTC-10</option>
    <option value="14" <?php if($session->userinfo['timezone']==14) echo 'selected'; ?>>UTC-9</option>
    <option value="15" <?php if($session->userinfo['timezone']==15) echo 'selected'; ?>>UTC-8</option>
    <option value="16" <?php if($session->userinfo['timezone']==16) echo 'selected'; ?>>UTC-7</option>
    <option value="17" <?php if($session->userinfo['timezone']==17) echo 'selected'; ?>>UTC-6</option>
    <option value="18" <?php if($session->userinfo['timezone']==18) echo 'selected'; ?>>UTC-5</option>
    <option value="19" <?php if($session->userinfo['timezone']==19) echo 'selected'; ?>>UTC-4</option>
    <option value="20" <?php if($session->userinfo['timezone']==20) echo 'selected'; ?>>UTC-3</option>
    <option value="21" <?php if($session->userinfo['timezone']==21) echo 'selected'; ?>>UTC-2</option>
    <option value="22" <?php if($session->userinfo['timezone']==22) echo 'selected'; ?>>UTC-1</option>
    <option value="23" <?php if($session->userinfo['timezone']==23) echo 'selected'; ?>>UTC</option>
    <option value="0" <?php if($session->userinfo['timezone']==0) echo 'selected'; ?>>UTC+1</option>
    <option value="1" <?php if($session->userinfo['timezone']==1) echo 'selected'; ?>>UTC+2</option>
    <option value="2" <?php if($session->userinfo['timezone']==2) echo 'selected'; ?>>UTC+3</option>
    <option value="3" <?php if($session->userinfo['timezone']==3) echo 'selected'; ?>>UTC+4</option>
    <option value="4" <?php if($session->userinfo['timezone']==4) echo 'selected'; ?>>UTC+5</option>
    <option value="5" <?php if($session->userinfo['timezone']==5) echo 'selected'; ?>>UTC+6</option>
    <option value="6" <?php if($session->userinfo['timezone']==6) echo 'selected'; ?>>UTC+7</option>
    <option value="7" <?php if($session->userinfo['timezone']==7) echo 'selected'; ?>>UTC+8</option>
    <option value="8" <?php if($session->userinfo['timezone']==8) echo 'selected'; ?>>UTC+9</option>
    <option value="9" <?php if($session->userinfo['timezone']==9) echo 'selected'; ?>>UTC+10</option>
    <option value="10" <?php if($session->userinfo['timezone']==10) echo 'selected'; ?>>UTC+11</option>
    <option value="11" <?php if($session->userinfo['timezone']==11) echo 'selected'; ?>>UTC+12</option>
</optgroup>

</select>
</td>
</tr>


<tr>
<th>Date</th>
<td>

<label>
<input class="radio" type="radio" name="tformat" value="0" <?php if($session->userinfo['tformat']==0) echo 'checked'; ?>>
EU (dd.mm.yy 24h)
</label><br />

<label>
<input class="radio" type="radio" name="tformat" value="1" <?php if($session->userinfo['tformat']==1) echo 'checked'; ?>>
US (mm/dd/yy 12h)
</label><br />

<label>
<input class="radio" type="radio" name="tformat" value="2" <?php if($session->userinfo['tformat']==2) echo 'checked'; ?>>
UK (dd/mm/yy 12h)
</label><br />

<label>
<input class="radio" type="radio" name="tformat" value="3" <?php if($session->userinfo['tformat']==3) echo 'checked'; ?>>
ISO (yy/mm/dd 24h)
</label>

</td>
</tr>

</tbody>
</table>


<p class="btn">
<td colspan="4"><input type="image" value="" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></td>
</p>
</form>

