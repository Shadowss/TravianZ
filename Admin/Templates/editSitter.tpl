<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editSitter.tpl                                            ##
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
$id = (int)($_GET['uid'] ?? 0);
$uid = $id;
if($id){
    $sitter1 = $user['sit1'] ? $database->getUserArray($user['sit1'], 1) : null;
    $sitter2 = $user['sit2'] ? $database->getUserArray($user['sit2'], 1) : null;
?>
<style>
.sit-wrap{max-width:700px;margin:0 auto;font-family:Verdana,Arial;}
.sit-head{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;border-radius:6px;padding:16px 20px;margin-bottom:14px;display:flex;align-items:center;gap:12px;}
.sit-head .icon{font-size:28px;background:rgba(255,255,255,.15);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
.sit-head h2{margin:0;font-size:18px;}
.sit-head h2 a{color:#fff;text-decoration:none;}
.sit-head .sub{font-size:12px;opacity:.85;margin-top:2px;}

.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,.05);margin-bottom:14px;overflow:hidden;}
.card h3{margin:0;padding:10px 14px;background:#f9fafb;border-bottom:1px solid #e5e7eb;font-size:13px;text-transform:uppercase;color:#374151;}
.card .body{padding:16px;}
.info{background:#eff6ff;border:1px solid #bfdbfe;border-radius:5px;padding:10px 12px;font-size:12px;color:#1e40af;margin-bottom:14px;}

.sitter-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:600px){.sitter-grid{grid-template-columns:1fr;}}
.sitter-box{border:1px solid #e2e8f0;border-radius:6px;padding:14px;background:#f8fafc;}
.sitter-box h4{margin:0 0 10px;font-size:13px;color:#334155;display:flex;align-items:center;gap:6px;}
.sitter-box input{width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:4px;font-size:14px;text-align:center;font-weight:bold;box-sizing:border-box;}
.sitter-box input:focus{border-color:#0ea5e9;outline:none;box-shadow:0 0 0 2px rgba(14,165,233,.2);}
.sitter-current{margin-top:8px;font-size:12px;text-align:center;min-height:20px;}
.sitter-current a{color:#0284c7;text-decoration:none;font-weight:600;}
.sitter-current a:hover{text-decoration:underline;}
.sitter-current.none{color:#94a3b8;font-style:italic;}
.btn-clear{background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:4px 8px;border-radius:3px;font-size:11px;cursor:pointer;margin-top:6px;}
.btn-clear:hover{background:#fecaca;}

.actions{display:flex;justify-content:space-between;align-items:center;margin-top:18px;padding-top:14px;border-top:1px solid #e5e7eb;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:9px 18px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-back:hover{background:#e5e7eb;}
.btn-save{background:linear-gradient(#0ea5e9,#0284c7);border:1px solid #0369a1;color:#fff;padding:9px 20px;border-radius:5px;font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;}
.btn-save:hover{filter:brightness(1.05);}
</style>
<script>
function clearSitter(n){ document.getElementById('sit'+n).value = '0'; }
</script>

<div class="sit-wrap">
    <div class="sit-head">
        <div class="icon">👥</div>
        <div>
            <h2>Edit Sitters: <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo htmlspecialchars($user['username']);?></a></h2>
            <div class="sub">UID: <?php echo $uid; ?></div>
        </div>
    </div>

    <form action="../GameEngine/Admin/Mods/editSitter.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="card">
            <h3>⚙️ Sitter Settings</h3>
            <div class="body">
                <div class="info">💡 Use the player's UID. Enter <b>0</b> to delete the sitter. You can find the UID in Search.</div>
                
                <div class="sitter-grid">
                    <div class="sitter-box">
                        <h4>👤 Sitter 1</h4>
                        <input type="number" id="sit1" name="sitter1" value="<?php echo (int)$user['sit1']; ?>" min="0">
                        <div class="sitter-current <?php echo $sitter1 ? '' : 'none'; ?>">
                            <?php if($sitter1){ echo '→ <a href="admin.php?p=player&uid='.$sitter1['id'].'">'.htmlspecialchars($sitter1['username']).'</a> (UID '.$sitter1['id'].')'; } else { echo 'No Sitter'; } ?>
                        </div>
                        <?php if($sitter1){ echo '<div style="text-align:center"><button type="button" class="btn-clear" onclick="clearSitter(1)">✕ Remove</button></div>'; } ?>
                    </div>

                    <div class="sitter-box">
                        <h4>👤 Sitter 2</h4>
                        <input type="number" id="sit2" name="sitter2" value="<?php echo (int)$user['sit2']; ?>" min="0">
                        <div class="sitter-current <?php echo $sitter2 ? '' : 'none'; ?>">
                            <?php if($sitter2){ echo '→ <a href="admin.php?p=player&uid='.$sitter2['id'].'">'.htmlspecialchars($sitter2['username']).'</a> (UID '.$sitter2['id'].')'; } else { echo 'No Sitter'; } ?>
                        </div>
                        <?php if($sitter2){ echo '<div style="text-align:center"><button type="button" class="btn-clear" onclick="clearSitter(2)">✕ Remove</button></div>'; } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="admin.php?p=player&uid=<?php echo $uid;?>" class="btn-back">← Back</a>
            <button type="submit" class="btn-save">💾 Save Sitters</button>
        </div>
    </form>
</div>
<?php
} else {
    include("404.tpl");
}
?>