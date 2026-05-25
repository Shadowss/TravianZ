<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : addTroops.tpl                                             ##
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
$unarray = [1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U99,U0];
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
$id = $_GET['did'];
if(isset($id)){
	$units = $database->getUnit($village['wref']);
	$coor = $database->getCoor($village['wref']);
	$tribe = $user['tribe'];
	$img = ($tribe - 1) * 10;
	include("search2.tpl");
?>
<style>
.addtroops-wrap{max-width:600px;margin:12px auto;font-family:system-ui}
.addtroops-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.addtroops-head{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:10px 14px;font-weight:600;font-size:14px}
.addtroops-grid{display:grid;grid-template-columns:1fr;gap:0}
.troop-row{display:grid;grid-template-columns:48px 1fr 120px;align-items:center;padding:8px 12px;border-bottom:1px solid #f1f5f9;gap:10px}
.troop-row:last-child{border-bottom:0}
.troop-row:hover{background:#f8fafc}
.troop-row img{width:22px;height:22px;margin:0 auto;display:block}
.troop-name{font-size:13px;color:#334155;font-weight:500}
.troop-input{display:flex;flex-direction:column;align-items:flex-end;gap:2px}
.troop-input input{width:100px;padding:6px 8px;border:1px solid #d1d5db;border-radius:6px;font-size:13px;text-align:right;font-family:monospace}
.troop-input input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.troop-current{font-size:11px;color:#9ca3af}
.troop-current b{color:#64748b}
.addtroops-foot{display:flex;justify-content:space-between;padding:10px 12px;background:#f8fafc;border-top:1px solid #e5e7eb}
.btn{padding:7px 14px;border-radius:6px;font-size:13px;font-weight:500;cursor:pointer;border:0;display:inline-flex;align-items:center;gap:6px;text-decoration:none}
.btn-back{background:#fff;color:#475569;border:1px solid #d1d5db}
.btn-back:hover{background:#f8fafc}
.btn-save{background:#2563eb;color:#fff}
.btn-save:hover{background:#1d4ed8}
.btn svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2}
</style>

<div class="addtroops-wrap">
<form action="../GameEngine/Admin/Mods/addTroops.php" method="POST">
<input type="hidden" name="id" value="<?php echo $_GET['did']; ?>">
<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">

<div class="addtroops-card">
  <div class="addtroops-head">Edit troops – <?php echo $village['name']; ?> (<?php echo $coor['x'].'|'.$coor['y']; ?>)</div>
  
  <div class="addtroops-grid">
  <?php for($i=1;$i<11;$i++){
    $uid = $img+$i;
    $current = $units['u'.$uid];
  ?>
    <div class="troop-row">
      <img src="../img/un/u/<?=$uid?>.gif" alt="">
      <div class="troop-name"><?=$unarray[$uid]?></div>
      <div class="troop-input">
        <input name="u<?=$uid?>" id="u<?=$uid?>" value="<?=$current?>" maxlength="10" type="number" min="0">
        <div class="troop-current">Now: <b><?=number_format($current)?></b></div>
      </div>
    </div>
  <?php } ?>
  </div>
  
  <div class="addtroops-foot">
    <button type="button" class="btn btn-back" onclick="location.href='admin.php?p=village&did=<?=$_GET['did']?>'">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>Back
    </button>
    <button type="submit" name="save" class="btn btn-save">
      <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>Save
    </button>
  </div>
</div>

</form>
</div>
<?php } ?>