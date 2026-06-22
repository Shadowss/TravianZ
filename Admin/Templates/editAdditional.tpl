<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editAdditional.tpl                                        ##
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
if (!isset($_SESSION)) { session_start(); }
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
$id = (int)$_GET['uid'];
$dur = $user['protect'] - time();
$protect = 0;
if($dur > 43200) { $protect = intval($dur/86400) + 1; }

if(isset($id)) {
    $sitter1 = $user['sit1'] ? $database->getUserArray($user['sit1'], 1) : null;
    $sitter2 = $user['sit2'] ? $database->getUserArray($user['sit2'], 1) : null;
?>
<style>
.editAdd-wrap{max-width:950px;margin:0 auto;font-family:Verdana,Arial;}
.editAdd-head{background:linear-gradient(#fff,#f3f3);border:1px solid #ccc;border-radius:5px;padding:12px 16px;margin-bottom:14px;display:flex;justify-content:space-between;align-items:center;}
.editAdd-head h2{margin:0;font-size:18px;color:#222;}
.editAdd-head h2 a{color:#71D000;text-decoration:none;}
.editAdd-head .uid{font-size:12px;color:#666;}

.grid-2{display:grid;grid-template-columns:1fr;gap:12px;}
@media(max-width:800px){.grid-2{grid-template-columns:1fr;}}

.card{background:#fff;border:1px solid #d4d4d4;border-radius:4px;overflow:hidden;margin-bottom:12px;box-shadow:0 1px 2px rgba(0,0,0,.04);}
.card h3{margin:0;padding:8px 12px;background:#f7f7f7;border-bottom:1px solid #e5e5e5;font-size:12px;text-transform:uppercase;color:#444;letter-spacing:.5px;}
.card .body{padding:14px;}

.form-row{display:flex;align-items:center;margin-bottom:12px;gap:10px;}
.form-row label{width:160px;font-size:12px;color:#333;font-weight:bold;}
.form-row .field{flex:1;}
.form-row input[type=text], .form-row input[type=number], .form-row select{
    width:100%;box-sizing:border-box;padding:6px 8px;border:1px solid #bbb;border-radius:3px;font-size:13px;
}
.form-row input:focus, select:focus{border-color:#71D000;outline:none;box-shadow:0 0 3px rgba(113,208,0,.3);}
.input-icon{display:flex;align-items:center;gap:6px;}
.input-icon img{vertical-align:middle;}

.badge{display:inline-block;padding:2px 6px;border-radius:3px;font-size:11px;color:#fff;margin-left:6px;}
.badge.banned{background:#c00;} .badge.user{background:#666;} .badge.mh{background:#06a;} .badge.admin{background:#e67e00;}

.sitter-link{font-size:11px;margin-top:3px;display:block;}
.sitter-link a{color:#0066cc;text-decoration:none;}

.actions{display:flex;justify-content:space-between;margin-top:16px;padding-top:12px;border-top:1px solid #eee;}
.btn{padding:8px 18px;border-radius:4px;font-size:13px;font-weight:bold;cursor:pointer;border:1px solid;text-decoration:none;display:inline-block;}
.btn-save{background:linear-gradient(#7ed321,#5eae0f);border-color:#4a8a0c;color:#fff;}
.btn-back{background:#f0f0f0;border-color:#bbb;color:#333;}
.btn-save:hover{filter:brightness(1.05);}
</style>

<div class="editAdd-wrap">
    <div class="editAdd-head">
        <h2>⚙️ Edit Additional: <a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></a></h2>
        <div class="uid">UID: <?php echo $id; ?> | Gold: <?php echo $user['gold']; ?> <img src="../img/admin/gold.gif" style="vertical-align:-2px;"></div>
    </div>

    <form action="../GameEngine/Admin/Mods/additional.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <div class="grid-2">
            <!-- LEFT: ACCOUNT CONTROL -->
            <div class="card">
                <h3>🔐 Account Control</h3>
                <div class="body">
                    <div class="form-row">
                        <label>Access Level</label>
                        <div class="field">
                        <?php if($id != $_SESSION['id']) { ?>
                            <select name="access">
                                <option value="0" <?php if($user['access']==0)echo'selected'; ?>>0 - Banned</option>
                                <option value="2" <?php if($user['access']==2)echo'selected'; ?>>2 - Normal User</option>
                                <option value="8" <?php if($user['access']==8)echo'selected'; ?>>8 - Multihunter</option>
                                <option value="9" <?php if($user['access']==9)echo'selected'; ?>>9 - Admin</option>
                            </select>
                        <?php } else {
                            $names=[0=>'Banned',2=>'Normal',8=>'Multihunter',9=>'Admin'];
                            $cls=[0=>'banned',2=>'user',8=>'mh',9=>'admin'];
                            echo '<input type="hidden" name="access" value="'.$user['access'].'">';
                            echo '<span class="badge '.$cls[$user['access']].'">'.$names[$user['access']].'</span> <span style="font-size:11px;color:#c00;">(you cannot change your own access)</span>';
                        } ?>
                        </div>
                    </div>
	
			<div class="form-row">
				<label>🏖 Vacation Mode</label>
				<div class="field">
						<select name="vac_mode">
							<option value="0" <?php if(!$user['vac_mode']) echo 'selected'; ?>>0 - Disabled</option>
							<option value="1" <?php if($user['vac_mode']) echo 'selected'; ?>>1 - Enabled</option>
						</select>
					</div>
			</div>
                    <div class="form-row">
                        <label>💰 Gold</label>
                        <div class="field input-icon">
                            <input type="number" name="gold" value="<?php echo (int)$user['gold']; ?>">
                            <img src="../img/admin/gold.gif" alt="gold">
                        </div>
                    </div>

                    <div class="form-row">
                        <label>🛡️ Protection</label>
                        <div class="field input-icon">
                            <input type="number" name="protect" value="<?php echo $protect; ?>" min="0" max="30">
                            <span style="font-size:12px;color:#666;">zile</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: SITTERS -->
            <div class="card">
                <h3>👥 Sitters</h3>
                <div class="body">
                    <div class="form-row">
                        <label>Sitter 1 (UID)</label>
                        <div class="field">
                            <input type="number" name="sitter1" value="<?php echo (int)$user['sit1']; ?>">
                            <span class="sitter-link"><?php echo $sitter1 ? '→ <a href="admin.php?p=player&uid='.$sitter1['id'].'">'.htmlspecialchars($sitter1['username']).'</a>' : 'No Sitter'; ?></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <label>Sitter 2 (UID)</label>
                        <div class="field">
                            <input type="number" name="sitter2" value="<?php echo (int)$user['sit2']; ?>">
                            <span class="sitter-link"><?php echo $sitter2 ? '→ <a href="admin.php?p=player&uid='.$sitter2['id'].'">'.htmlspecialchars($sitter2['username']).'</a>' : 'No Sitter'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATISTICS -->
        <div class="card">
            <h3>📊 Statistics & Points</h3>
            <div class="body">
                <div class="grid-2">
                    <div class="form-row"><label>🏛️ Culture Points</label><div class="field"><input type="number" name="cp" value="<?php echo round($user['cp']); ?>"></div></div>
                    <div class="form-row"><label>⚔️ Attack Points</label><div class="field"><input type="number" name="off" value="<?php echo (int)$user['ap']; ?>"></div></div>
                    <div class="form-row"><label>🛡️ Defence Points</label><div class="field"><input type="number" name="def" value="<?php echo (int)$user['dp']; ?>"></div></div>
                    <div class="form-row"><label>💎 Resources Raided</label><div class="field"><input type="number" name="res" value="<?php echo (int)$user['RR']; ?>"></div></div>
                    <div class="form-row"><label>⚔️ Total Attack</label><div class="field"><input type="number" name="ooff" value="<?php echo (int)$user['apall']; ?>"></div></div>
                    <div class="form-row"><label>🛡️ Total Defence</label><div class="field"><input type="number" name="odef" value="<?php echo (int)$user['dpall']; ?>"></div></div>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="admin.php?p=player&uid=<?php echo $id; ?>" class="btn btn-back">← Back</a>
            <button type="submit" name="save" class="btn btn-save">💾 Save Changes</button>
        </div>
    </form>
</div>
<?php
} else {
    include("404.tpl");
}
?>