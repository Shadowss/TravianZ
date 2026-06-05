<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : add_village.tpl                                           ##
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
?>
<style>
.punish-box{
  width:100%;
  max-width:none;
  border-collapse:separate;
  border-spacing:0;
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:10px;
  overflow:hidden;
  box-shadow:0 2px 8px rgba(0,0,0,.04);
  font-family:system-ui;
  margin-bottom:12px;
}
.punish-box th{
  background:linear-gradient(135deg,#66CCFF,#66CCCC) !important;
  color:#fff;
  padding:8px 12px;
  font-weight:600;
  text-align:center;
  font-size:14px
}
.punish-box td{padding:8px 10px;border-bottom:1px solid #f1f5f9;font-size:13px}
.punish-box tr:last-child td{border-bottom:0}
.punish-row{display:flex;align-items:center;justify-content:space-between;gap:8px}
.fm{padding:4px 8px;font-size:13px;border:1px solid #cbd5e1;border-radius:6px;background:#fff;width:100%}
.fm:disabled{background:#f1f5f9;color:#94a3b8}
.btn-add{
  padding:4px 14px;font-size:12px;font-weight:600;color:#fff;
  background:linear-gradient(180deg,#3b82f6,#2563eb);
  border:0;border-radius:6px;cursor:pointer;
  box-shadow:0 1px 2px rgba(0,0,0,.1);text-transform:uppercase
}
.btn-add:hover{filter:brightness(1.05)}
.btn-add:disabled{opacity:.6;cursor:not-allowed}
.addv-label{color:#64748b;font-size:12px;text-align:center;display:block;margin-bottom:2px}
</style>

<form method="post" action="admin.php" style="margin:0">
<input name="action" type="hidden" value="addVillage">
<input name="uid" type="hidden" value="<?php echo $user['id'];?>">
<table class="punish-box">
  <thead>
    <tr><th>Add Village</th></tr>
  </thead>
  <tbody>
    <tr>
      <td style="padding-bottom:4px;border-bottom:0">
        <span class="addv-label">Coordinates (X|Y)</span>
      </td>
    </tr>
    <tr>
      <td style="border-bottom:0;padding-top:0;padding-bottom:4px">
        <div class="punish-row">
          <label style="width:18px">X:</label>
          <input name="x" class="fm" type="text" <?php if($_SESSION['access'] != ADMIN){ echo 'disabled'; } ?>>
        </div>
      </td>
    </tr>
    <tr>
      <td style="border-bottom:0;padding-top:0">
        <div class="punish-row">
          <label style="width:18px">Y:</label>
          <input name="y" class="fm" type="text" <?php if($_SESSION['access'] != ADMIN){ echo 'disabled'; } ?>>
        </div>
      </td>
    </tr>
    <tr>
      <td style="padding-top:8px">
        <div class="punish-row" style="justify-content:center">
          <button type="submit" class="btn-add" <?php if($_SESSION['access'] != ADMIN){ echo 'disabled'; } ?>>ADD VILLAGE</button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</form>