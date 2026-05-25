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
.addv-box{width:100%;max-width:220px;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);font-family:system-ui}
.addv-box th{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:6px 10px;font-weight:600;text-align:center;font-size:13px}
.addv-box td{padding:6px 8px;border-bottom:1px solid #f1f5f9;font-size:12px;color:#334155}
.addv-box tr:last-child td{border-bottom:0;text-align:center}
.addv-sub{font-size:11px;color:#64748b;text-align:center;padding:4px 8px !important;border-bottom:0 !important}
.addv-box td:first-child{width:25%;color:#64748b;font-weight:500}
.addv-box input.fm{width:100%;padding:3px 6px;font-size:12px;border:1px solid #cbd5e1;border-radius:5px;box-sizing:border-box}
.addv-box input.fm:focus{outline:none;border-color:#3b82f6;box-shadow:0 0 0 1px #3b82f6}
.btn-add{display:inline-block;padding:4px 14px;font-size:11px;font-weight:600;color:#fff;background:linear-gradient(180deg,#3b82f6,#2563eb);border:0;border-radius:5px;cursor:pointer;box-shadow:0 1px 2px rgba(0,0,0,.1);text-transform:uppercase;letter-spacing:.3px}
.btn-add:hover{filter:brightness(1.05)}
.btn-add:disabled{opacity:.5;cursor:not-allowed}
</style>

<form method="post" action="admin.php" style="margin:0">
<input name="action" type="hidden" value="addVillage">
<input name="uid" type="hidden" value="<?php echo $user['id'];?>">
<table class="addv-box">
  <thead>
    <tr><th>Add Village</th></tr>
  </thead>
  <tbody>
	<tr><td class="addv-sub">Coordinates (X|Y)</td></tr>
	<tr>
        <td style="display:flex;align-items:center;gap:6px;border-bottom:0">
            <span style="width:15px">X:</span>
            <input name="x" class="fm" type="text" <?php if($_SESSION['access'] != ADMIN){ echo 'disabled'; } ?>>
        </td>
    </tr>
    <tr>
        <td style="display:flex;align-items:center;gap:6px;border-bottom:0;padding-top:0">
            <span style="width:15px">Y:</span>
            <input name="y" class="fm" type="text" <?php if($_SESSION['access'] != ADMIN){ echo 'disabled'; } ?>>
        </td>
    </tr>
    <tr>
        <td style="padding-top:8px">
            <button type="submit" class="btn-add" <?php if($_SESSION['access'] != ADMIN){ echo 'disabled'; } ?>>Add Village</button>
        </td>
    </tr>
  </tbody>
</table>
</form>