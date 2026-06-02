<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : addABTroops.tpl                                           ##
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
$unarray = array(1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U99,U0);
if (empty($_SESSION['access']) || $_SESSION['access'] < 9) {
    die(defined('ACCESS_DENIED_ADMIN') ? ACCESS_DENIED_ADMIN : 'Access Denied: You are not Admin!');
}
$id = $_GET['did'];
if(isset($id)){
	$abtech = $database->getABTech($id);
	$units = $database->getUnit($village['wref']);
	$coor = $database->getCoor($village['wref']);
	$tribe = $user['tribe'];
	if($tribe ==1){ $img = 0;} if($tribe ==2){ $img = 10;} if($tribe ==3){ $img = 20;} if($tribe ==4){ $img = 30;} if($tribe ==5){ $img = 40;} if($tribe ==6){ $img = 50;}
	include("search2.tpl");
?>
<style>
.ab-wrap{max-width:650px;margin:12px auto;font-family:system-ui}
.ab-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.ab-head{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:10px 14px;font-weight:600;font-size:14px}
.ab-grid{display:grid;grid-template-columns:1fr}
.ab-row{display:grid;grid-template-columns:48px 1.2fr 90px 90px;align-items:center;padding:8px 12px;border-bottom:1px solid #f1f5f9;gap:10px}
.ab-row.header{background:#f8fafc;font-size:11px;color:#64748b;text-transform:uppercase;font-weight:600;border-bottom:1px solid #e5e7eb}
.ab-row:last-child{border-bottom:0}
.ab-row:hover:not(.header){background:#fcfdff}
.ab-row img{width:20px;height:20px;margin:0 auto}
.ab-name{font-size:13px;color:#334155}
.ab-input input{width:70px;padding:5px 6px;border:1px solid #d1d5db;border-radius:6px;font-size:13px;text-align:center;font-family:monospace}
.ab-input input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 2px rgba(37,99,235,.1)}
.ab-foot{display:flex;justify-content:space-between;padding:10px 12px;background:#f8fafc;border-top:1px solid #e5e7eb}
.btn{padding:7px 14px;border-radius:6px;font-size:13px;font-weight:500;cursor:pointer;border:0;display:inline-flex;gap:6px;align-items:center}
.btn-back{background:#fff;color:#475569;border:1px solid #d1d5db}
.btn-save{background:#16a34a;color:#fff}
.btn-save:hover{background:#15803d}
.btn svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2}
</style>

<div class="ab-wrap">
<form action="../GameEngine/Admin/Mods/addABTroops.php" method="POST">
<input type="hidden" name="id" value="<?php echo $_GET['did']; ?>">
<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">

<div class="ab-card">
  <div class="ab-head">Upgrades – <?php echo $village['name']; ?> (<?php echo $coor['x'].'|'.$coor['y']; ?>)</div>
  
  <div class="ab-grid">
    <div class="ab-row header">
      <div></div><div>Troop</div><div style="text-align:center">Armoury</div><div style="text-align:center">Blacksmith</div>
    </div>
    <?php for($i=1;$i<9;$i++){ ?>
    <div class="ab-row">
      <img src="../img/un/u/<?=($img+$i)?>.gif" alt="">
      <div class="ab-name"><?=$unarray[$img+$i]?></div>
      <div class="ab-input"><input name="a<?=$i?>" value="<?=$abtech['a'.$i]?>" type="number" min="0" max="20"></div>
      <div class="ab-input"><input name="b<?=$i?>" value="<?=$abtech['b'.$i]?>" type="number" min="0" max="20"></div>
    </div>
    <?php } ?>
  </div>
  
  <div class="ab-foot">
    <button type="button" class="btn btn-back" onclick="location.href='admin.php?p=village&did=<?=$_GET['did']?>'">
      <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>Back
    </button>
    <button type="submit" name="save" class="btn btn-save">
      <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>Save
    </button>
  </div>
</div>

</form>
</div>
<?php } ?>