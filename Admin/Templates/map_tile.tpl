<h1 class="left">Check & Edit Map Tile</h1>

<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : map_tile.tpl 		                               		   ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

function get_map_tile_info($coord_x, $coord_y){
  $tbp = TB_PREFIX;
  $q = 'SELECT map_data.`id` AS village_id, map_data.`fieldtype`, map_data.`oasistype`, map_data.`occupied`, map_data.`image`, '.
   'oasis_data.`type`, '.
   'CASE WHEN oasis_data.`owner` IS NOT NULL AND oasis_data.`owner`!= 2 THEN oasis_data.`owner` ELSE village_data.`owner` END AS owner_id, '.
   'u.`username` '.
   'FROM (SELECT * FROM `'.$tbp.'wdata` WHERE `x` = '.$coord_x.' AND `y` = '.$coord_y.') AS map_data '.
   'LEFT JOIN `'.$tbp.'odata` AS oasis_data ON map_data.`id` = oasis_data.`wref` '.
   'LEFT JOIN `'.$tbp.'vdata` AS village_data ON village_data.`wref` = map_data.`id` '.
   'LEFT JOIN `'.$tbp.'users` AS u ON u.`id` = COALESCE(oasis_data.`owner`, village_data.`owner`, 0);';
  $result = mysqli_query($GLOBALS['link'], $q);
  return mysqli_fetch_assoc($result);
}

function upd_oasis_to_oasis($village_id, $new_oasis_type){
  mysqli_begin_transaction($GLOBALS['link']);
  mysqli_query($GLOBALS['link'], 'UPDATE `'.TB_PREFIX.'odata` SET `type` = '.$new_oasis_type.' WHERE `wref` = '.$village_id);
  mysqli_query($GLOBALS['link'], 'UPDATE `'.TB_PREFIX.'wdata` SET `oasistype` = '.$new_oasis_type.', `image` = "o'.$new_oasis_type.'" WHERE `id` = '.$village_id);
  mysqli_commit($GLOBALS['link']);
}
function upd_village_to_village($village_id, $new_village_type){
  mysqli_query($GLOBALS['link'], 'UPDATE `'.TB_PREFIX.'wdata` SET `fieldtype` = '.$new_village_type.', `image` = "t'.$new_village_type.'" WHERE `id` = '.$village_id);
}
function upd_village_to_oasis($village_id, $new_oasis_type){
  mysqli_begin_transaction($GLOBALS['link']);
  mysqli_query($GLOBALS['link'], 'INSERT INTO `'.TB_PREFIX.'odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `loyalty`, `owner`, `name`, `high`) VALUES ('.$village_id.', '.$new_oasis_type.', 0, 800, 800, 800, 800, 800, 800, 100, 2, "Unoccupied Oasis", '.rand(0, 2).')');
  mysqli_query($GLOBALS['link'], 'UPDATE `'.TB_PREFIX.'wdata` SET `fieldtype` = 0, `oasistype` = '.$new_oasis_type.', `image` = "o'.$new_oasis_type.'" WHERE `id` = '.$village_id);
  mysqli_commit($GLOBALS['link']);
}
function upd_oasis_to_village($village_id, $new_village_type){
  mysqli_begin_transaction($GLOBALS['link']);
  mysqli_query($GLOBALS['link'], 'DELETE FROM `'.TB_PREFIX.'odata` WHERE `wref` = '.$village_id);
  mysqli_query($GLOBALS['link'], 'UPDATE `'.TB_PREFIX.'wdata` SET `fieldtype` = '.$new_village_type.', `oasistype` = 0, `image` = "t'.rand(0, 8).'" WHERE `id` = '.$village_id);
  mysqli_commit($GLOBALS['link']);
}

$msg = ''; $coord_x = 0; $coord_y = 0; $search_result = ''; $edit_form = '';

function oasis_type_by_id($id){
  $map=[1=>'+25% Lumber',2=>'+25% Lumber',3=>'+25% Lumber +25% Crop',4=>'+25% Clay',5=>'+25% Clay',6=>'+25% Clay +25% Crop',7=>'+25% Iron',8=>'+25% Iron',9=>'+25% Iron +25% Crop',10=>'+25% Crop',11=>'+25% Crop',12=>'+50% Crop'];
  return $map[$id]??'undefined';
}
function village_type_by_fieldtype_id($id){
  $map=[1=>'3-3-3-9',2=>'3-4-5-6',3=>'4-4-4-6',4=>'4-5-3-6',5=>'5-3-4-6',6=>'1-1-1-15',7=>'4-4-3-7',8=>'3-4-4-7',9=>'4-3-4-7',10=>'3-5-4-6',11=>'4-3-5-6',12=>'5-4-3-6'];
  return $map[$id]??'undefined';
}

function gen_map_tiles_select_list_form($is_ocuppied,$is_oasis,$oasis_type,$fieldtype,$x,$y){
  $not_ocuppied =!$is_ocuppied;
  $html = '<div class="tile-edit"><b>New Map Tile Type</b><form method="post" action="?p=map_tile&do_save">' . csrf_field() . '<select name="new_field_type" class="tile-select">';
  if($is_oasis){
    for($i=1;$i<13;$i++){ $sel=($i==$oasis_type)?' selected':''; $html.='<option value="'.$i.'_0"'.$sel.'>['.$i.'] Oasis '.oasis_type_by_id($i).'</option>'; }
    if($not_ocuppied){ for($i=1;$i<13;$i++){ $html.='<option value="'.$i.'_1">['.$i.'] Valley '.village_type_by_fieldtype_id($i).'</option>'; } }
  }else{
    if($not_ocuppied){ for($i=1;$i<13;$i++){ $html.='<option value="'.$i.'_0">['.$i.'] Oasis '.oasis_type_by_id($i).'</option>'; } }
    for($i=1;$i<13;$i++){ $sel=($i==$fieldtype)?' selected':''; $html.='<option value="'.$i.'_1"'.$sel.'>['.$i.'] Valley '.village_type_by_fieldtype_id($i).'</option>'; }
  }
  $html.='</select><input type="hidden" name="x" value="'.$x.'"><input type="hidden" name="y" value="'.$y.'"><button type="submit" name="save" class="btn-save">Save</button></form></div>';
  return $html;
}

if(isset($_GET['do_save'])){
  $new = explode('_', $_POST['new_field_type']);
  $new_type=(int)$new[0]; $new_is=(int)$new[1];
  $coord_x=max(-WORLD_MAX,min(WORLD_MAX,(int)$_POST['x'])); $coord_y=max(-WORLD_MAX,min(WORLD_MAX,(int)$_POST['y']));
  $row=get_map_tile_info($coord_x,$coord_y); $is_village=($row['oasistype']==0);
  if($is_village && $row['owner_id'] && $row['owner_id']!=2){ $msg='Can not change map tile type for village that exists!'; }
  elseif(($is_village && $new_is==1 && $row['fieldtype']==$new_type) || (!$is_village && $new_is==0 && $row['oasistype']==$new_type)){ $msg='Can not change to the same field type!'; }
  else{
    if($is_village && $new_is==0) upd_village_to_oasis($row['village_id'],$new_type);
    elseif(!$is_village && $new_is==1) upd_oasis_to_village($row['village_id'],$new_type);
    elseif(!$is_village && $new_is==0) upd_oasis_to_oasis($row['village_id'],$new_type);
    else upd_village_to_village($row['village_id'],$new_type);
  }
  if($msg=='') $msg='Saved!';
}
elseif(isset($_GET['do_get']) && isset($_POST['x'])){
  $coord_x=max(-WORLD_MAX,min(WORLD_MAX,(int)$_POST['x'])); $coord_y=max(-WORLD_MAX,min(WORLD_MAX,(int)$_POST['y']));
  $row=get_map_tile_info($coord_x,$coord_y); $is_village=($row['oasistype']==0);
  if($is_village){
    $bonus='<b>type:</b> ['.$row['fieldtype'].'] '.village_type_by_fieldtype_id($row['fieldtype']);
    if(!$row['owner_id'] || $row['owner_id']==2){ $place='Abandoned Valley'; $owner=''; $edit_form=gen_map_tiles_select_list_form(false,false,false,$row['fieldtype'],$coord_x,$coord_y); }
    else{ $place='Village'; $owner='<b>owner:</b> <a href="?p=player&uid='.$row['owner_id'].'">'.$row['username'].' [id: '.$row['owner_id'].']</a>'; $edit_form=gen_map_tiles_select_list_form(true,false,false,$row['fieldtype'],$coord_x,$coord_y); }
  }else{
    $bonus='<b>bonus:</b> ['.$row['oasistype'].'] '.oasis_type_by_id($row['oasistype']);
    if(!$row['owner_id'] || $row['owner_id']==2){ $place='Unoccupied Oasis'; $owner=''; $edit_form=gen_map_tiles_select_list_form(false,true,$row['oasistype'],false,$coord_x,$coord_y); }
    else{ $place='Occupied Oasis'; $owner='<b>owner:</b> <a href="?p=player&uid='.$row['owner_id'].'">'.$row['username'].' [id: '.$row['owner_id'].']</a>'; $edit_form=gen_map_tiles_select_list_form(true,true,$row['oasistype'],false,$coord_x,$coord_y); }
  }
  $search_result='<div class="tile-card"><div class="tile-preview"><div class="map"><div id="map"><div id="map_content"><div class="'.$row['image'].'"></div></div></div></div></div><div class="tile-info"><div class="info-row"><span>X</span><b>'.$coord_x.'</b></div><div class="info-row"><span>Y</span><b>'.$coord_y.'</b></div><div class="info-row"><span>Type</span><b>'.$place.'</b></div><div class="info-row"><span>Detail</span><b>'.$bonus.'</b></div>'.($owner?'<div class="info-row"><span>Owner</span><b>'.$owner.'</b></div>':'').'</div></div>';
}
?>

<style>
/* === MAP TILE MODERN OVERRIDE === */
.tile-wrapper{max-width:760px !important;margin:12px 0 !important;font-family:system-ui,-apple-system,Segoe UI,Roboto !important}
.tile-form{background:#fff !important;border:1px solid #e5e7eb !important;border-radius:12px !important;padding:16px !important;margin-bottom:14px !important;box-shadow:0 1px 3px rgba(0,0,0,.05) !important}
.coord-wrap{display:flex !important;align-items:center !important;gap:14px !important}
.coord-item{display:flex !important;align-items:center !important;gap:6px !important}
.coord-item b{color:#0f172a !important;font-weight:700 !important;font-size:15px !important}
.coord-item input.text{width:90px !important;height:38px !important;padding:0 10px !important;border:1px solid #d1d5db !important;border-radius:8px !important;text-align:center !important;background:#fff !important;color:#111 !important}
.btn-go{height:38px !important;padding:0 18px !important;background:#0f172a !important;color:#fff !important;border:0 !important;border-radius:8px !important;font-weight:600 !important;cursor:pointer !important}

/* card info */
.tile-card{background:#fff !important;border:1px solid #e5e7eb !important;border-radius:12px !important;padding:16px !important;margin-bottom:14px !important;display:grid !important;grid-template-columns:110px 1fr !important;gap:16px !important;align-items:start !important}
.tile-preview .map{transform:scale(0.85) !important;transform-origin:top left !important}
.tile-info{display:flex !important;flex-direction:column !important;gap:6px !important}
.info-row{display:grid !important;grid-template-columns:70px 1fr !important;padding:4px 0 !important;border-bottom:1px dashed #f1f5f9 !important}
.info-row:last-child{border:0 !important}
.info-row span{color:#64748b !important;font-size:13px !important}
.info-row b{color:#0f172a !important;font-weight:600 !important}
.info-row b a{color:#16a34a !important;text-decoration:none !important;font-weight:600 !important}

/* edit form */
.tile-edit{background:#fff !important;border:1px solid #e5e7eb !important;border-radius:12px !important;padding:16px !important}
.tile-edit b{display:block !important;margin-bottom:8px !important;color:#0f172a !important;font-size:15px !important}
.tile-edit form{display:flex !important;gap:10px !important;align-items:center !important;flex-wrap:wrap !important}
.tile-select{
  flex:1 !important;min-width:220px !important;height:40px !important;
  padding:0 12px !important;border:1px solid #d1d5db !important;border-radius:8px !important;
  background:#fff !important;color:#111 !important;font-size:14px !important;
  appearance:none !important;-webkit-appearance:none !important;
}
.btn-save{
  height:40px !important;padding:0 20px !important;
  background:#0f172a !important;color:#fff !important;
  border:0 !important;border-radius:8px !important;font-weight:600 !important;
  cursor:pointer !important;white-space:nowrap !important
}
.btn-save:hover{opacity:.9 !important}

/* mesaje */
.msg-box{padding:10px 12px !important;border-radius:8px !important;margin:10px 0 !important;font-weight:600 !important}
.msg-ok{background:#f0fdf4 !important;color:#166534 !important;border:1px solid #bbf7d0 !important}
.msg-err{background:#fef2f2 !important;color:#991b1b !important;border:1px solid #fecaca !important}
</style>

<div class="tile-wrapper">
  <form class="tile-form" method="post" action="?p=map_tile&do_get">
    <?php echo csrf_field(); ?>
    <div class="coord-wrap">
      <div class="coord-item">
        <b>X</b>
        <input class="text" name="x" value="<?=$coord_x?>" maxlength="4">
      </div>
      <div class="coord-item">
        <b>Y</b>
        <input class="text" name="y" value="<?=$coord_y?>" maxlength="4">
      </div>
      <button class="btn-go" type="submit">Check Tile</button>
    </div>
  </form>

  <?php if($msg){ $cls = ($msg=='Saved!')?'msg-ok':'msg-err'; echo '<div class="msg-box '.$cls.'">'.$msg.'</div>'; }?>

  <?=$search_result?>
  <?=$edit_form?>
</div>

<link href="/css/admin_map_tile.css" rel="stylesheet">