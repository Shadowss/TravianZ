<h1 class="left">Check &#38; Edit Map Tile</h1>

<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       map_tile.tpl                                                   ##
##  Developed by:  Taras                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

function get_map_tile_info($coord_x, $coord_y){ // todo mv to queries file
  $q = 'SELECT map_data.`id` AS village_id, map_data.`fieldtype`, map_data.`oasistype`, map_data.`occupied`, map_data.`image`, '.
   'oasis_data.`type`, '.
   'CASE '.
     'WHEN oasis_data.`owner` IS NOT NULL AND oasis_data.`owner` != 2 '.
     'THEN oasis_data.`owner` '.
     'ELSE village_data.`owner` '.
   'END AS owner_id, '.
   'u.`username` '.
   'FROM (SELECT * FROM `s1_wdata` WHERE `x` = '.$coord_x.' AND `y` = '.$coord_y.') AS map_data '.
   'LEFT JOIN `s1_odata` AS oasis_data ON map_data.`id` = oasis_data.`wref` '.
   'LEFT JOIN `s1_vdata` AS village_data ON village_data.`wref` = map_data.`id` '.
   'LEFT JOIN s1_users AS u ON u.`id` = COALESCE(oasis_data.`owner`, village_data.`owner`, 0);'; // todo check this db tables fields -- del doublings like oasistype = '2' and image = 'o2'
  $result = mysqli_query($GLOBALS['link'], $q);
  return mysqli_fetch_assoc($result);
}


function upd_oasis_to_oasis($village_id, $new_oasis_type){ // $village_id aka wref
  mysqli_begin_transaction($GLOBALS['link']);
  $q = 'UPDATE `'.TB_PREFIX.'odata` SET `type` = '.$new_oasis_type.' WHERE `wref` = '.$village_id;
  mysqli_query($GLOBALS['link'], $q);
  $q2 = 'UPDATE `'.TB_PREFIX.'wdata` SET `oasistype` = '.$new_oasis_type.', `image` = "o'.$new_oasis_type.'" WHERE `id` = '.$village_id;
  mysqli_query($GLOBALS['link'], $q2);
  mysqli_commit($GLOBALS['link']);
}


function upd_village_to_village($village_id, $new_village_type){ // $village_id aka wref
  //mysqli_begin_transaction($GLOBALS['link']);
  //$q = '';
  //mysqli_query($GLOBALS['link'], $q);
  $q2 = 'UPDATE `'.TB_PREFIX.'wdata` SET `fieldtype` = '.$new_village_type.', `image` = "t'.$new_village_type.'" WHERE `id` = '.$village_id;
  mysqli_query($GLOBALS['link'], $q2);
  //mysqli_commit($GLOBALS['link']);
}


function upd_village_to_oasis($village_id, $new_oasis_type){ // $village_id aka wref
  mysqli_begin_transaction($GLOBALS['link']);
  //$q = 'INSERT INTO `'.TB_PREFIX.'odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `lastupdated`, `lastupdated2`, `loyalty`, `owner`, `name`, `high`) VALUES ('.$village_id.', '.$new_oasis_type.', 0, 800, 800, 800, 800, 800, 800, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 100, 2, "Unoccupied Oasis", '.rand(0, 2).')'; // todo fix maxstore + maxcrop
  $q = 'INSERT INTO `'.TB_PREFIX.'odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `loyalty`, `owner`, `name`, `high`) VALUES ('.$village_id.', '.$new_oasis_type.', 0, 800, 800, 800, 800, 800, 800, 100, 2, "Unoccupied Oasis", '.rand(0, 2).')'; // todo fix maxstore + maxcrop
  mysqli_query($GLOBALS['link'], $q);
  $q2 = 'UPDATE `'.TB_PREFIX.'wdata` SET `fieldtype` = 0, `oasistype` = '.$new_oasis_type.', `image` = "o'.$new_oasis_type.'" WHERE `id` = '.$village_id;
  mysqli_query($GLOBALS['link'], $q2);
  mysqli_commit($GLOBALS['link']);
}


function upd_oasis_to_village($village_id, $new_village_type){ // $village_id aka wref
  mysqli_begin_transaction($GLOBALS['link']);
  $q = 'DELETE FROM `'.TB_PREFIX.'odata` WHERE `wref` = '.$village_id;
  mysqli_query($GLOBALS['link'], $q);
  $q2 = 'UPDATE `'.TB_PREFIX.'wdata` SET `fieldtype` = '.$new_village_type.', `oasistype` = 0, `image` = "t'.rand(0, 8).'" WHERE `id` = '.$village_id;
  mysqli_query($GLOBALS['link'], $q2);
  mysqli_commit($GLOBALS['link']);
}


$msg = '';
$coord_x = 0;
$coord_y = 0;
$search_result = '';
$edit_form = '';

//print_r($_GET);
//print_r($_POST);

// todo mv to other file with functions
function oasis_type_by_id($oasis_type_id){
  if($oasis_type_id == 1){
    return '+25% Lumber';
  }else if($oasis_type_id == 2){
    return '+25% Lumber'; // todo think maybe add +50% instead the same +25% ?
  }else if($oasis_type_id == 3){
    return '+25% Lumber +25% Crop';
  }else if($oasis_type_id == 4){
    return '+25% Clay';
  }else if($oasis_type_id == 5){
    return '+25% Clay';
  }else if($oasis_type_id == 6){
    return '+25% Clay +25% Crop';
  }else if($oasis_type_id == 7){
    return '+25% Iron';
  }else if($oasis_type_id == 8){
    return '+25% Iron';
  }else if($oasis_type_id == 9){
    return '+25% Iron +25% Crop';
  }else if($oasis_type_id == 10){
    return '+25% Crop';
  }else if($oasis_type_id == 11){
    return '+25% Crop';
  }else if($oasis_type_id == 12){
    return '+50% Crop';
  }else{
    return 'undefined';
  }
}

// fieldtype =
// 0 = oasis ?
// 1+ = village - valley ?

function village_type_by_fieldtype_id($village_fieldtype_id){ // fieldtype (and image aka t0, t1, .. - can be any?)
  //  1 = 3-3-3-9
  //  2 = 3-4-5-6
  //  3 = 4-4-4-6
  //  4 = 4-5-3-6
  //  5 = 5-3-4-6
  //  6 = 1-1-1-15 // todo add 0-0-0-18 (with few resources for 0 fields)
  //  7 = 4-4-3-7
  //  8 = 3-4-4-7
  //  9 = 4-3-4-7
  // 10 = 3-5-4-6
  // 11 = 4-3-5-6
  // 12 = 5-4-3-6
  if($village_fieldtype_id == 1){
    return '3-3-3-9';
  }else if($village_fieldtype_id == 2){
    return '3-4-5-6'; // todo think maybe add +50% instead the same +25% ?
  }else if($village_fieldtype_id == 3){
    return '4-4-4-6';
  }else if($village_fieldtype_id == 4){
    return '4-5-3-6';
  }else if($village_fieldtype_id == 5){
    return '5-3-4-6';
  }else if($village_fieldtype_id == 6){
    return '1-1-1-15'; // todo add 0-0-0-18 (with few resources for 0 fields)
  }else if($village_fieldtype_id == 7){
    return '4-4-3-7';
  }else if($village_fieldtype_id == 8){
    return '3-4-4-7';
  }else if($village_fieldtype_id == 9){
    return '4-3-4-7';
  }else if($village_fieldtype_id == 10){
    return '3-5-4-6';
  }else if($village_fieldtype_id == 11){
    return '4-3-5-6';
  }else if($village_fieldtype_id == 12){
    return '5-4-3-6';
  }else{
    return 'undefined';
  }
}


function gen_map_tiles_select_list_form($is_ocuppied, $is_oasis_tile_type, $oasis_type, $fieldtype, $coord_x, $coord_y){
  // if ocuppied village --can change only to other $fieldtype (cannot change to oasis)
  // if ocuppied oasis -- can change only to other $oasis_type (cannot change to village field - valley)
  // unoccypied can change to oasis, to village field, and back
  $not_ocuppied = (!($is_ocuppied));
  $result = '<br><hr><br>'.
   '<b>New Map Tile Type</b>:<br>'.
   '<form name="new_tile_type" method="post" action="?p=map_tile&do_save" style="padding-top:10px">'.
   '<select name="new_field_type">';
  if($is_oasis_tile_type){
    for($i = 1; $i < 13; $i++){
      $oasis_txt = oasis_type_by_id($i);
      $selected = ($i == $oasis_type) ? ' selected' : '';
      $result .= '<option value="'.$i.'_0"'.$selected.'>['.$i.'] Oasis '.$oasis_txt.'</option>'; // value "x_0" -- 0 for oasis
    }
    if($not_ocuppied){
      for($i = 1; $i < 13; $i++){
        $village_field_type_txt = village_type_by_fieldtype_id($i);
        $result .= '<option value="'.$i.'_1">['.$i.'] Valley ' .$village_field_type_txt.'</option>'; // value "x_1" -- 1 for village - valley filed type
      }
    }
  
  }else{ // village fieldtype
    if($not_ocuppied){
      for($i = 1; $i < 13; $i++){
        $oasis_txt = oasis_type_by_id($i);
        $result .= '<option value="'.$i.'_0">['.$i.'] Oasis '.$oasis_txt.'</option>'; // value "x_0" -- 0 for oasis
      }
    }
    for($i = 1; $i < 13; $i++){
      $village_field_type_txt = village_type_by_fieldtype_id($i);
      $selected = ($i == $fieldtype) ? ' selected' : '';
      $result .= '<option value="'.$i.'_1"'.$selected.'>['.$i.'] Valley '.$village_field_type_txt.'</option>'; // value "x_1" -- 1 for village - valley filed type
    }
  }
  $result .= '</select>'.
   '<input type="image" id="btn_save" class="dynamic_img" value="save" name="save" src="/img/x.gif" alt="Save">'.
   '<input type="hidden" name="x" value="'.$coord_x.'">'.
   '<input type="hidden" name="y" value="'.$coord_y.'">'.
   '</form>';
  return $result;
}



if(isset($_GET['do_save'])){ // update map tile type
  //print_r($_POST); // Array ( [new_field_type] => 2_1 [save_x] => 29 [save_y] => 18 [x] => 0 [y] => 1 )
  
  $new_tile_numbers = explode('_', $_POST['new_field_type']);
  $new_tile_is_type = (int) $new_tile_numbers[0]; // oasis field type OR village - valley - field type
  $new_tile_is_oasis_or_village = (int) $new_tile_numbers[1]; // 0 - oasis, 1 - village - valley - field
  
  $coord_x = (int) $_POST['x'];
  $coord_y = (int) $_POST['y'];
  if($coord_x > WORLD_MAX){ $coord_x = WORLD_MAX; }
  if($coord_x < (-WORLD_MAX)){ $coord_x = (-WORLD_MAX); }
  if($coord_y > WORLD_MAX){ $coord_y = WORLD_MAX; }
  if($coord_y < (-WORLD_MAX)){ $coord_y = (-WORLD_MAX); }
  
  $row = get_map_tile_info($coord_x, $coord_y);
  
  $is_not_oasis_tile_type = ($row['oasistype'] == 0); // not oasis but village - valley - field
  
  if($is_not_oasis_tile_type && $row['owner_id'] && ($row['owner_id'] != 2) ){
    $msg = 'Can not change map tile type for village that exists!<br>'; // todo add this feature as other option
  
  }else if( ($is_not_oasis_tile_type && ($new_tile_is_oasis_or_village == 1) && ($row['fieldtype'] == $new_tile_is_type) ) ||
      ( (!($is_not_oasis_tile_type)) && ($new_tile_is_oasis_or_village == 0) && ($row['oasistype'] == $new_tile_is_type) ) ){ // check new tile not same as old tile
    $msg = 'Can not change to the same field type!<br>';
  
  }else if($is_not_oasis_tile_type && ($new_tile_is_oasis_or_village == 0) ){ // old tile was not oasis - new is oasis
    upd_village_to_oasis($row['village_id'], $new_tile_is_type);
  
  }else if( (!($is_not_oasis_tile_type)) && ($new_tile_is_oasis_or_village == 1) ){ // old tile was oasis - new is village
    upd_oasis_to_village($row['village_id'], $new_tile_is_type);
  
  }else if( (!($is_not_oasis_tile_type)) && ($new_tile_is_oasis_or_village == 0) ){ // from same to same - from oasis to oasis
    upd_oasis_to_oasis($row['village_id'], $new_tile_is_type);
  
  }else{ // from same to same - from village valley to village valley
    upd_village_to_village($row['village_id'], $new_tile_is_type);
  }
  if($msg == ''){ $msg = 'Saved!<br>'; }
  
  
  
}else if(isset($_GET['do_get']) && isset($_POST['x']) && isset($_POST['y'])){ // get and show map tile type
  $coord_x = (int) $_POST['x'];
  $coord_y = (int) $_POST['y'];
  if($coord_x > WORLD_MAX){ $coord_x = WORLD_MAX; }
  if($coord_x < (-WORLD_MAX)){ $coord_x = (-WORLD_MAX); }
  if($coord_y > WORLD_MAX){ $coord_y = WORLD_MAX; }
  if($coord_y < (-WORLD_MAX)){ $coord_y = (-WORLD_MAX); }
  
  $row = get_map_tile_info($coord_x, $coord_y);
  
  //print_r($row);
  
  $is_not_oasis_tile_type = ($row['oasistype'] == 0);
  
  if($is_not_oasis_tile_type){ // not oasis map tile
    $bonus_or_type = '<b>type:</b> ['.$row['fieldtype'].'] '.village_type_by_fieldtype_id( $row['fieldtype'] );
    if( is_null($row['owner_id']) || ($row['owner_id'] == 2) ){
      $place_type = 'Abandoned Valley';
      $owner = '';
      //$edit_form = gen_map_tiles_select_list_form($is_ocuppied, $is_oasis, $oasistype_id, $row['fieldtype'], $coord_x, $coord_y);
      $edit_form = gen_map_tiles_select_list_form(false, false, false, $row['fieldtype'], $coord_x, $coord_y);
    }else{
      $place_type = 'Village';
      $owner = '<b>owner:</b> <a href="?p=player&uid='.$row['owner_id'].'" target="_blank">'.$row['username'].' [id: '.$row['owner_id'].']</a><br>';
      //$edit_form = gen_map_tiles_select_list_form($is_ocuppied, $is_oasis, $oasistype_id, $row['fieldtype'], $coord_x, $coord_y);
      $edit_form = gen_map_tiles_select_list_form(true, false, false, $row['fieldtype'], $coord_x, $coord_y);
    }
  
  }else{ // oasis map tile
    $bonus_or_type = '<b>bonus:</b> ['.$row['oasistype'].'] '.oasis_type_by_id( $row['oasistype'] );
    if( is_null($row['owner_id']) || ($row['owner_id'] == 2) ){ // todo check why $row['occupied'] == 0 for ocuppied oasis // todo use only owner_id / status -- not save 'Nature'/'oasis' texts in db
      $place_type = 'Unocuppied oasis';
      //$owner = '<b>owner:</b> <a href="?p=player&uid='.$row['owner_id'].'" target="_blank">'.$row['username'].' [id: '.$row['owner_id'].']</a><br>'; // Nature
      $owner = '';
      
      //$edit_form = gen_map_tiles_select_list_form($is_ocuppied, $is_oasis, $row['oasistype'], $village_filedtype_id, $coord_x, $coord_y);
      $edit_form = gen_map_tiles_select_list_form(false, true, $row['oasistype'], false, $coord_x, $coord_y);
    }else{
      $place_type = 'Occupied oasis';
      $owner = '<b>owner:</b> <a href="?p=player&uid='.$row['owner_id'].'" target="_blank">'.$row['username'].' [id: '.$row['owner_id'].']</a><br>';
      //$edit_form = gen_map_tiles_select_list_form($is_ocuppied, $is_oasis, $row['oasistype'], $village_filedtype_id, $coord_x, $coord_y);
      $edit_form = gen_map_tiles_select_list_form(true, true, $row['oasistype'], false, $coord_x, $coord_y);
    }
  }
  
  $search_result = '<link href="/css/compact.css" rel="stylesheet">'.
'<p>'.
'<b>x:</b> '.$coord_x.'<br>'.
'<b>y:</b> '.$coord_y.'<br>'.
'<b>type:</b> '.$place_type.'<br>'.
$bonus_or_type.'<br>'.$owner.
'</p>'.
'<div class="map">'.
'<div id="map">'.
'<div id="map_content">'.
  '<div class="'.$row['image'].'"></div>'.
'</div>'.
'</div>'.
'</div>';
  
  
//}else{ // show begin search map tile form
  
}

echo $search_result;
?>

<link href="/css/admin_map_tile.css" rel="stylesheet">

<div id="map_coords">
<!--<form name="map_coords" method="post" action="./Mods/edit_map_tile.php" style="padding-top:10px">-->
<form name="map_coords" method="post" action="?p=map_tile&do_get" style="padding-top:10px">
  <span><b>x</b> </span><input id="x" class="text fm" name="x" style="width:30px" value="<?php echo $coord_x; ?>" maxlength="4">
  <span><b>y</b> </span><input id="y" class="text fm" name="y" style="width:30px" value="<?php echo $coord_y; ?>" maxlength="4">
  <!-- <input type="hidden" name="do_get"> -->
  <input type="image" id="btn_ok" class="dynamic_img" value="ok" name="btn" src="/img/x.gif" alt="OK"><br><br>
<?php

echo $msg;

?>
</form>
<?php

echo $edit_form;

?>
</div>