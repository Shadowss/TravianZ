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
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       	   ##
##                                                                             ##
#################################################################################
// Save new link or just edit a link
if($_POST) {
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
            $links[$i]['linkname'] = mysqli_real_escape_string($database->dblink, $value);
        }
        
        if(substr($key, 0, 8) == 'linkziel') {
            $i = substr($key, 8);
            $links[$i]['linkziel'] = mysqli_real_escape_string($database->dblink, $value);
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
    <th>Time zones</th>
    <td><select name="timezone" class="dropdown">
	<optgroup label="local time zones"><option value="495">Europe</option>
<option value="99" selected="selected">UK</option>
<option value="492">Turkey</option>
<option value="328">Asia/Kolkata</option>
<option value="345">Asia/Bangkok</option>

<option value="257">USA/New York</option>
<option value="189">USA/Chicago</option>
<option value="474">New Zealand</option></optgroup><optgroup label="general time zones"><option value="12">UTC-11</option>
	   <option value="13">UTC-10</option>
	   <option value="14">UTC-9</option>
	   <option value="15">UTC-8</option>
	   <option value="16">UTC-7</option>

	   <option value="17">UTC-6</option>
	   <option value="18">UTC-5</option>
	   <option value="19">UTC-4</option>
	   <option value="20">UTC-3</option>
	   <option value="21">UTC-2</option>
	   <option value="22">UTC-1</option>

	   <option value="23">UTC</option>
	   <option value="0">UTC+1</option>
	   <option value="1">UTC+2</option>
	   <option value="2">UTC+3</option>
	   <option value="3">UTC+4</option>
	   <option value="4">UTC+5</option>

	   <option value="5">UTC+6</option>
	   <option value="6">UTC+7</option>
	   <option value="7">UTC+8</option>
	   <option value="8">UTC+9</option>
	   <option value="9">UTC+10</option>
	   <option value="10">UTC+11</option>

	   <option value="11">UTC+12</option>
	   
	</optgroup></select>

    </td>
</tr><tr>
    <th>Date</th>
    <td>
	<label><input class="radio" type="Radio" name="tformat" value="0" checked> EU (dd.mm.yy 24h)</label><br />

	<label><input class="radio" type="Radio" name="tformat" value="1"> US (mm/dd/yy 12h)</label><br />
	<label><input class="radio" type="Radio" name="tformat" value="2"> UK (dd/mm/yy 12h)</label><br />
	<label><input class="radio" type="Radio" name="tformat" value="3"> ISO (yy/mm/dd 24h)</label>
    </td>
</tr>
</tbody>
</table><p class="btn"><input type="image" value="" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>

</form> 

