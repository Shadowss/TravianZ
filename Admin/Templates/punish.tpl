<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : punish.tpl 		                       			       ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : ronix (Original)                                          ##
##  Refactored by  : iopietro                                                  ##
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

$active = $admin->getUserActive();
?>
<style>
.punish-box{
  width:100%;
  max-width:none; /* asta era problema */
  border-collapse:separate;
  border-spacing:0;
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:10px;
  overflow:hidden;
  box-shadow:0 2px 8px rgba(0,0,0,.04);
  font-family:system-ui;
  margin-bottom:12px; /* spațiu între ele */
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
.punish-box select{padding:4px 8px;font-size:13px;border:1px solid #cbd5e1;border-radius:6px;background:#fff;flex:1}
.punish-box label{display:flex;align-items:center;gap:6px;cursor:pointer;flex:1}
.btn-ok{padding:4px 12px;font-size:12px;font-weight:600;color:#fff;background:linear-gradient(180deg,#22c55e,#16a34a);border:0;border-radius:6px;cursor:pointer;box-shadow:0 1px 2px rgba(0,0,0,.1);text-transform:uppercase}
.btn-ok:hover{filter:brightness(1.05)}
</style>

<table class="punish-box">
	<thead><tr><th>Punish Player</th></tr></thead>
	<tbody>
		<tr><td>
			<form method="post" action="admin.php" style="margin:0">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="action" value="punish">
				<input type="hidden" name="uid" value="<?php echo $user['id'];?>">
				<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
				<div class="punish-row">
					<select name="punish">
						<option value="10" selected>10%</option>
						<option value="20">20%</option>
						<option value="30">30%</option>
						<option value="40">40%</option>
						<option value="50">50%</option>
						<option value="60">60%</option>
						<option value="70">70%</option>
						<option value="80">80%</option>
						<option value="90">90%</option>
						<option value="100">100%</option>
					</select>
					<button type="submit" class="btn-ok">OK</button>
				</div>
			</form>
		</td></tr>
		
		<tr><td>
			<form method="post" action="admin.php" style="margin:0">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="action" value="punish">
				<input type="hidden" name="uid" value="<?php echo $user['id'];?>">
				<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
				<div class="punish-row">
					<label><input type="checkbox" name="del_troop" value="1"> <span style="text-decoration:line-through;color:#94a3b8">Delete Troops</span></label>
					<button type="submit" class="btn-ok">OK</button>
				</div>
			</form>
		</td></tr>
		
		<tr><td>
			<form method="post" action="admin.php" style="margin:0">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="action" value="punish">
				<input type="hidden" name="uid" value="<?php echo $user['id'];?>">
				<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
				<div class="punish-row">
					<label><input type="checkbox" name="clean_ware" value="1"> Empty Warehouses</label>
					<button type="submit" class="btn-ok">OK</button>
				</div>
			</form>
		</td></tr>
	</tbody>
</table>