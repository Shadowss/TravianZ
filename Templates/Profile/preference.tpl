<?php 
if(isset($_GET['del']) && is_numeric($_GET['del'])){
	$database->removeLinks($_GET['del'],$session->uid);
	header("Location: spieler.php?s=2");
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
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       	   ##
##                                                                             ##
#################################################################################
// Save new link or just edit a link
if($_POST) {
    $links = array();
    
    // let's do some complicated code x'D
    foreach($_POST as $key => $value) {
	if(substr($key, 0, 2) == 'nr') {
	    $i = substr($key, 2);
	    $links[$i]['nr'] = mysql_real_escape_string($value);
	}
	
	if(substr($key, 0, 2) == 'id') {
	    $i = substr($key, 2);
	    $links[$i]['id'] = mysql_real_escape_string($value);
	}
	
	if(substr($key, 0, 8) == 'linkname') {
	    $i = substr($key, 8);
	    $links[$i]['linkname'] = mysql_real_escape_string($value);
	}
	
	if(substr($key, 0, 8) == 'linkziel') {
	    $i = substr($key, 8);
	    $links[$i]['linkziel'] = mysql_real_escape_string($value);
	}
    }
    
    // Save
    foreach($links as $link) {
	settype($link['nr'], 'int');
	
	if(trim($link['nr']) != '' AND trim($link['linkname']) != '' AND trim($link['linkziel']) != '' AND trim($link['id']) == '') {
	    // Add new link
	    $userid = $session->uid;
	    if($session->access!=BANNED){
	    $query = mysql_query('INSERT INTO `' . TB_PREFIX . 'links` (`userid`, `name`, `url`, `pos`) VALUES (' . $userid . ', \'' . $link['linkname'] . '\', \'' . $link['linkziel'] . '\', ' . $link['nr'] . ')');
		}else{
		header("Location: banned.php");
		}
		} elseif(trim($link['nr']) != '' AND trim($link['linkname']) != '' AND trim($link['linkziel']) != '' AND trim($link['id']) != '') {
	    // Update link
	    $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'links` WHERE `id` = ' . $link['id']);
	    $data = mysql_fetch_assoc($query);
	    
	    // May the user update this entry?
	    if($data['userid'] == $session->uid) {
		$query2 = mysql_query('UPDATE `' . TB_PREFIX . 'links` SET `name` = \'' . $link['linkname'] . '\', `url` = \'' . $link['linkziel'] . '\', `pos` = ' . $link['nr'] . ' WHERE `id` = ' . $link['id']);
	    }
	} elseif(trim($link['nr']) == '' AND trim($link['linkname']) == '' AND trim($link['linkziel']) == '' AND trim($link['id']) != '') {
	    // Delete entry
	    $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'links` WHERE `id` = ' . $link['id']);
	    $data = mysql_fetch_assoc($query);
	    
	    // May the user delete this entry?
	    if($data['userid'] == $session->uid) {
		$query2 = mysql_query('DELETE FROM `' . TB_PREFIX . 'links` WHERE `id` = ' . $link['id']);
	    }
	}
    }
    
    print '<meta http-equiv="refresh" content="0">';
}


// Fetch all links
$query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'links` WHERE `userid` = ' . $session->uid . ' ORDER BY `pos` ASC') or die(mysql_error());
$links = array();
while($data = mysql_fetch_assoc($query)) {
    $links[] = $data;
}
?>

<h1>Player profile</h1>

<?php include("menu.tpl"); ?>
<form action="spieler.php?s=2" method="POST">
  <input type="hidden" name="ft" value="p2">
  <input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
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
      <tr>
       <td colspan="4"><input type="image" value="" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></td>
      </tr>
    </tbody>
  </table>
</form>

<table cellpadding="1" cellspacing="1" id="completion" class="set"><thead>
    <tr>
	<th colspan="2">Auto completion</th>
    </tr>
    <tr>
	<td colspan="2">Used for rally point and marketplace:</td>

    </tr>
    </thead><tbody>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="v1" value="1" checked></td>
	<td>own villages</td>
    </tr>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="v2" value="1" ></td>

	<td>villages of the surroundings</td>
    </tr>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="v3" value="1" ></td>
	<td>villages from players of the alliance</td>
    </tr>
    </tbody></table><table cellpadding="1" cellspacing="1" id="big_map" class="set"><thead>
    <tr>

	<th colspan="2">Large map</th>
    </tr>
    </thead><tbody>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="map" ></td>
	<td>Show the large map in an extra window.</td>
    </tr>
    </tbody>

    </table><table cellpadding="1" cellspacing="1" id="report_filter" class="set"><thead>
    <tr>
	<th colspan="2">Report filter</th>
    </tr>
    </thead><tbody>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="v4" value="1" ></td>
	<td>No reports for transfers to own villages.</td>

    </tr>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="v5" value="1" ></td>
	<td>No reports for transfers to foreign villages.</td>
    </tr>
    <tr>
	<td class="sel"><input class="check" type="checkbox" name="v6" value="1" ></td>
	<td>No reports for transfers from foreign villages.</td>

    </tr>
    </tbody>
    </table><table cellpadding="1" cellspacing="1" id="time" class="set"><thead>
<tr>
    <th colspan="2">Time preferences</th>
</tr>
<tr>
    <td colspan="2">Here you can change Travian's displayed time to fit your time zone.</td>
</tr>
</thead><tbody>

			<tr>
				<th>Time zone:</th>
				<td>
					 <select name="timeZone">
						<optgroup label="local time zones">
							<option value="30"<?php echo $timeZone == 30 ? " selected=\"selected\"" : "" ?>>Europe/Vilnius</option>
							<option value="31"<?php echo $timeZone == 31 ? " selected=\"selected\"" : "" ?>>Newfoundland</option>
							<option value="32"<?php echo $timeZone == 32 ? " selected=\"selected\"" : "" ?>>United Kingdom</option>
							<option value="33"<?php echo $timeZone == 33 ? " selected=\"selected\"" : "" ?>>Central Europe</option>
							<option value="34"<?php echo $timeZone == 34 ? " selected=\"selected\"" : "" ?>>Iran</option>
							<option value="35"<?php echo $timeZone == 35 ? " selected=\"selected\"" : "" ?>>Calcutta</option>
							<option value="36"<?php echo $timeZone == 36 ? " selected=\"selected\"" : "" ?>>Cocos</option>
							<option value="37"<?php echo $timeZone == 37 ? " selected=\"selected\"" : "" ?>>Australian Central</option>
						</optgroup>
						<optgroup label="general time zones">
							<option value="13"<?php echo $timeZone == 13 ? " selected=\"selected\"" : "" ?>>UTC-11</option>
							<option value="14"<?php echo $timeZone == 14 ? " selected=\"selected\"" : "" ?>>UTC-10</option>
							<option value="15"<?php echo $timeZone == 15 ? " selected=\"selected\"" : "" ?>>UTC-9</option>
							<option value="16"<?php echo $timeZone == 16 ? " selected=\"selected\"" : "" ?>>UTC-8</option>
							<option value="17"<?php echo $timeZone == 17 ? " selected=\"selected\"" : "" ?>>UTC-7</option>
							<option value="18"<?php echo $timeZone == 18 ? " selected=\"selected\"" : "" ?>>UTC-6</option>
							<option value="19"<?php echo $timeZone == 19 ? " selected=\"selected\"" : "" ?>>UTC-5</option>
							<option value="20"<?php echo $timeZone == 20 ? " selected=\"selected\"" : "" ?>>UTC-4</option>
							<option value="21"<?php echo $timeZone == 21 ? " selected=\"selected\"" : "" ?>>UTC-3</option>
							<option value="22"<?php echo $timeZone == 22 ? " selected=\"selected\"" : "" ?>>UTC-2</option>
							<option value="23"<?php echo $timeZone == 23 ? " selected=\"selected\"" : "" ?>>UTC-1</option>
							<option value="0"<?php echo $timeZone == 0 ? " selected=\"selected\"" : "" ?>>UTC</option>
							<option value="1"<?php echo $timeZone == 1 ? " selected=\"selected\"" : "" ?>>UTC+1</option>
							<option value="2"<?php echo $timeZone == 2 ? " selected=\"selected\"" : "" ?>>UTC+2</option>
							<option value="3"<?php echo $timeZone == 3 ? " selected=\"selected\"" : "" ?>>UTC+3</option>
							<option value="4"<?php echo $timeZone == 4 ? " selected=\"selected\"" : "" ?>>UTC+4</option>
							<option value="5"<?php echo $timeZone == 5 ? " selected=\"selected\"" : "" ?>>UTC+5</option>
							<option value="6"<?php echo $timeZone == 6 ? " selected=\"selected\"" : "" ?>>UTC+6</option>
							<option value="7"<?php echo $timeZone == 7 ? " selected=\"selected\"" : "" ?>>UTC+7</option>
							<option value="8"<?php echo $timeZone == 8 ? " selected=\"selected\"" : "" ?>>UTC+8</option>
							<option value="9"<?php echo $timeZone == 9 ? " selected=\"selected\"" : "" ?>>UTC+9</option>
							<option value="10"<?php echo $timeZone == 10 ? " selected=\"selected\"" : "" ?>>UTC+10</option>
							<option value="11"<?php echo $timeZone == 11 ? " selected=\"selected\"" : "" ?>>UTC+11</option>
							<option value="12"<?php echo $timeZone == 12 ? " selected=\"selected\"" : "" ?>>UTC+12</option>
						</optgroup>
					</select>
				</td>
			</tr>
			<tr>
				<th class="timeFormat">Date format:</th>
				<td>
					<label>
						<input class="radio" type="radio" name="dateFormat" value="0"<?php echo $dateFormat == 0 ? " checked=\"checked\"" : "" ?>></input> EU (dd.mm.yy 24h)
					</label>
					<label>
						<input class="radio" type="radio" name="dateFormat" value="1"<?php echo $dateFormat == 1 ? " checked=\"checked\"" : "" ?>></input> US (mm/dd/yy 12h)
					</label>
					<label>
						<input class="radio" type="radio" name="dateFormat" value="2"<?php echo $dateFormat == 2 ? " checked=\"checked\"" : "" ?>></input> UK (dd/mm/yy 12h)
					</label>
					<label>
						<input class="radio" type="radio" name="dateFormat" value="3"<?php echo $dateFormat == 3 ? " checked=\"checked\"" : "" ?>></input> ISO (yy/mm/dd 24h)
					</label>
				</td>
			</tr>
		</tbody>
	</table><p class="btn"><input type="image" value="" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>

</form> 

