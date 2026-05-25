<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editVillage.tpl                                           ##
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

$id = $_GET['did'];
$coor = $database->getCoor($village['wref']);
$type = $database->getVillageType($village['wref']);
$fdata = $database->getResourceLevel($village['wref']);
if(isset($id)) { include("search2.tpl"); ?>
<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css" rel="stylesheet">
<style>
/* centrează mizeria aia de hartă */
#content.village1 {float: none !important;margin: 0 auto !important;width: 300px;display: block;padding: 20px 0;}
#content.village1 #village_map {float: none !important;margin: 0 auto !important;left: 0 !important;right: 0 !important;position: relative !important;display: block;}
.village-page{font-family:system-ui;max-width:1100px;margin:0 auto;padding:0 6px}
.vcard{background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.04);margin-bottom:12px}
.vhead{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:8px 12px;font-weight:600;font-size:13px;display:flex;align-items:center}
.vtable{width:100%;border-collapse:collapse;font-size:12.5px}
.vtable th{background:#f8fafc;padding:6px;border-bottom:1px solid #e5e7eb;text-align:left;font-weight:600;color:#475569}
.vtable td{padding:5px 6px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
.vtable tr:last-child td{border-bottom:0}
.input-mini{width:60px;padding:4px 6px;border:1px solid #d1d5db;border-radius:5px;font-size:12.5px;text-align:center}
.btn-save{padding:8px 18px;background:#16a34a;color:#fff;border:0;border-radius:6px;font-weight:600;cursor:pointer}
.btn-save:hover{background:#15803d}
.instr-link{margin-left:auto;color:#93c5fd;font-size:12px;text-decoration:none;cursor:pointer}
.map-wrap{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media(max-width:900px){.map-wrap{grid-template-columns:1fr}}
.map-box{background:#fcfcfd;border:1px solid #e5e7eb;border-radius:8px;padding:8px;text-align:center}
</style>

<div class="village-page">
<form action="../GameEngine/Admin/Mods/editBuildings.php" method="POST">
<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
<input type="hidden" name="id" value="<?php echo $_GET['did']; ?>">

<div class="vcard">
  <div class="vhead">Edit Village – <?php echo htmlspecialchars($village['name']); ?> (<?php echo $coor['x'].'|'.$coor['y']; ?>)
    <a class="instr-link" onclick="document.getElementById('instr').style.display = document.getElementById('instr').style.display=='none'?'block':'none';return false">Show Instructions</a>
  </div>
<div id="instr" style="display:none;padding:12px;background:#fcfcfd;border-bottom:1px solid #e5e7eb">
  <div style="display:flex;flex-direction:column;gap:24px;align-items:center">
    
    <div style="text-align:center">
      <h4 style="margin:0 8px;font-size:12px;color:#475569">Resource Fields (1-18)</h4>
      <div id="content" class="village1" style="min-height:auto">
        <div id="village_map" class="f<?php echo $type; ?>" style="margin:0 auto;float:none">
          <?php for($f=1;$f<19;$f++) echo '<img src="../img/x.gif" class="reslevel rf'.$f.' level'.$f.'">'; ?>
        </div>
      </div>
    </div>

    <div style="text-align:center">
      <h4 style="margin:0 0 8px;font-size:12px;color:#475569">Village Center (19-38)</h4>
      <div id="content" class="village2" style="padding:0">
        <div id="village_map" class="d2_0" style="margin:0 auto;transform:scale(.85);transform-origin:top">
          <?php for($b=1;$b<21;$b++) echo '<img src="../img/x.gif" class="building d'.$b.' iso">'; ?>
          <div id="levels" class="on"><?php for($b=1;$b<21;$b++) echo '<div class="d'.$b.'">'.($b+18).'</div>'; ?></div>
        </div>
      </div>
    </div>

  </div>
  <!-- tabelul cu GID rămâne sub ele -->
    <div style="margin-top:10px;max-height:180px;overflow:auto;border:1px solid #e5e7eb;border-radius:6px">
      <table class="vtable" style="font-size:11.5px">
        <thead><tr><th style="width:50px">GID</th><th>Name</th></tr></thead>
        <tbody><?php for($i=1;$i<=42;$i++){ echo '<tr><td>'.$i.'</td><td>'.$funct->procResType($i).'</td></tr>'; } ?></tbody>
      </table>
    </div>
  </div>
</div>

<div class="vcard">
  <div class="vhead">Modify Buildings</div>
  <div style="overflow-x:auto">
    <table class="vtable">
      <thead><tr><th style="width:50px">ID</th><th style="width:70px">GID</th><th>Name</th><th style="width:70px">Level</th></tr></thead>
      <tbody>
      <?php
      for($i=1;$i<=41;$i++){
        if($i==41)$i=99;
        $gid=(int)$fdata['f'.$i.'t']; $lvl=(int)$fdata['f'.$i];
        $bu=$gid==0?'-':$funct->procResType($gid);
        echo '<tr>
          <td style="text-align:center;color:#64748b">'.$i.'</td>
          <td><input class="input-mini" name="id'.$i.'gid" value="'.$gid.'"></td>
          <td>'.$bu.'</td>
          <td><input class="input-mini" name="id'.$i.'level" value="'.$lvl.'"></td>
        </tr>';
      }
      ?>
      </tbody>
    </table>
  </div>
  <div style="text-align:center;padding:12px;border-top:1px solid #f1f5f9">
    <button type="submit" class="btn-save">Save Changes</button>
  </div>
</div>
</form>

<div class="vcard">
  <div class="vhead">Current Layout Preview</div>
  <div style="padding:16px;display:flex;flex-direction:column;gap:28px;align-items:center">
    
    <!-- 1. Resource Fields -->
    <div style="text-align:center">
      <div style="font-size:12px;font-weight:600;color:#475569;margin-bottom:8px">Resource Fields</div>
      <div id="content" class="village1" style="min-height:auto">
        <div id="village_map" class="f<?php echo $type; ?>" style="float:none;margin:0 auto">
          <?php for($f=1;$f<19;$f++){ $level=$fdata['f'.$f]; echo '<img src="../img/x.gif" class="reslevel rf'.$f.' level'.$level.'">'; } ?>
        </div>
      </div>
    </div>

    <!-- 2. Village Center -->
    <div style="text-align:center">
      <div style="font-size:12px;font-weight:600;color:#475569;margin-bottom:8px">Village Center</div>
      <?php $WW=$fdata['f99t']; $wall=$fdata['f40t']; $wallType=$wall==0?'d2_0':($user['tribe']==2?'d2_12':($user['tribe']==3?'d2_1':'d2_11')); ?>
      <div id="content" class="village2" style="padding:0">
        <div id="village_map" class="<?php echo $wallType; ?>" style="margin:0 auto;transform:scale(.9);transform-origin:top">
          <?php for($b=1;$b<21;$b++){ $gid=$fdata['f'.($b+18).'t']; echo $gid>0?'<img src="../img/x.gif" class="building d'.$b.' g'.$gid.'">':'<img src="../img/x.gif" class="building d'.$b.' iso">'; }
          echo $fdata['f39t']>0?'<img src="../img/x.gif" class="dx1 g16">':'<img src="../img/x.gif" class="dx1 g16e">';
          if($WW==40){$l=$fdata['f99'];$c='g40';if($l>19)$c='g40_1';if($l>39)$c='g40_2';if($l>59)$c='g40_3';if($l>79)$c='g40_4';if($l>99)$c='g40_5';echo '<img class="ww '.$c.'" src="img/x.gif">';} ?>
          <div id="levels" class="on"><?php for($b=1;$b<21;$b++){ $lv=$fdata['f'.($b+18)]; if($lv>0)echo'<div class="d'.$b.'">'.$lv.'</div>'; } if($fdata['f39t']>0)echo'<div class="l39">'.$fdata['f39'].'</div>'; if($wall>0)echo'<div class="l40">'.$fdata['f40'].'</div>'; if($WW>0)echo'<div class="d40">'.$fdata['f99'].'</div>'; ?></div>
        </div>
      </div>
    </div>

  </div>
</div>

</div>
<?php } else { include("404.tpl"); } ?>