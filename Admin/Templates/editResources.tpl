<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editResources.tpl                                         ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : aggenkeech (Original)                                     ##
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

$id = (int)$_GET['did'];
if($id){
  $coor = $database->getCoor($village['wref']);
  include("search2.tpl"); ?>
<style>
.res-wrap{font-family:system-ui;max-width:600px;margin:12px auto}
.res-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.06)}
.res-head{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:12px 16px;font-weight:600;font-size:14px}
.res-table{width:100%;border-collapse:collapse}
.res-table thead td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;font-weight:600;padding:8px 12px;border-bottom:1px solid #e5e7eb}
.res-table tbody td{padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px}
.res-table tbody tr:last-child td{border-bottom:0}
.res-name{display:flex;align-items:center;gap:8px;font-weight:500;color:#334155}
.res-name img{width:18px;height:18px}
.res-input{width:100%;padding:7px 10px;border:1px solid #d1d5db;border-radius:6px;font-size:13px;box-sizing:border-box}
.res-input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.15)}
.res-actions{display:flex;justify-content:space-between;align-items:center;padding:12px 16px;background:#f8fafc;border-top:1px solid #e5e7eb}
.btn-back{color:#64748b;text-decoration:none;font-size:13px}
.btn-back:hover{color:#0f172a}
.btn-save{background:#2563eb;color:#fff;border:0;padding:8px 16px;border-radius:8px;font-weight:600;cursor:pointer;font-size:13px}
.btn-save:hover{background:#1d4ed8}
</style>

<div class="res-wrap">
  <form action="../GameEngine/Admin/Mods/editResources.php" method="POST">
    <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
	<input type="hidden" name="did" id="did" value="<?php echo $_GET['did']; ?>">
    
    <div class="res-card">
      <div class="res-head">Modify Resources — <?php echo $village['name']; ?> (<?php echo $coor['x']; ?>|<?php echo $coor['y']; ?>)</div>
      
      <table class="res-table">
        <thead>
          <tr>
            <td style="width:140px">Resource</td>
            <td>Amount</td>
            <td style="width:160px">Maximum Capacity</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div class="res-name"><img src="../img/admin/r/1.gif"> Wood</div></td>
            <td><input class="res-input" name="wood" value="<?php echo round($village['wood'],0); ?>"></td>
            <td rowspan="3"><input class="res-input" name="maxstore" value="<?php echo round($village['maxstore'],0); ?>"></td>
          </tr>
          <tr>
            <td><div class="res-name"><img src="../img/admin/r/2.gif"> Clay</div></td>
            <td><input class="res-input" name="clay" value="<?php echo round($village['clay'],0); ?>"></td>
          </tr>
          <tr>
            <td><div class="res-name"><img src="../img/admin/r/3.gif"> Iron</div></td>
            <td><input class="res-input" name="iron" value="<?php echo round($village['iron'],0); ?>"></td>
          </tr>
          <tr>
            <td><div class="res-name"><img src="../img/admin/r/4.gif"> Crop</div></td>
            <td><input class="res-input" name="crop" value="<?php echo round($village['crop'],0); ?>"></td>
            <td><input class="res-input" name="maxcrop" value="<?php echo round($village['maxcrop'],0); ?>"></td>
          </tr>
        </tbody>
      </table>
      
      <div class="res-actions">
        <a href="../Admin/admin.php?p=village&did=<?php echo $_GET['did'];?>" class="btn-back">← Back to village</a>
        <button type="submit" class="btn-save">Save Changes</button>
      </div>
    </div>
  </form>
</div>
<?php } else { include("404.tpl"); } ?>