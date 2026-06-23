<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editProtection.tpl                                        ##
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
$id = (int)($_GET['uid'] ?? 0);
$uid = $id;
$user = $database->getUserArray($id,1);
if($id && $user){
    $now = time();
    $prot = (int)$user['protect'];
    $isActive = $prot > $now;
    $ends = $isActive ? date('d.m.Y H:i', $prot) : 'Expired';
    $left = $isActive ? ceil(($prot - $now)/86400) : 0;
?>
<style>
.prot-wrap{max-width:550px;margin:0 auto;font-family:Verdana,Arial;}
.prot-head{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;border-radius:6px;padding:16px 20px;margin-bottom:14px;display:flex;align-items:center;gap:12px;}
.prot-head .icon{font-size:28px;background:rgba(255,255,255,.15);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
.prot-head h2{margin:0;font-size:18px;}
.prot-head h2 a{color:#fff;text-decoration:none;}
.prot-head .sub{font-size:12px;opacity:.85;margin-top:2px;}

.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;}
.card .body{padding:20px;}

.status-box{text-align:center;padding:16px;border-radius:6px;margin-bottom:18px;border:1px solid;}
.status-box.active{background:#ecfdf5;border-color:#a7f3d0;color:#065f46;}
.status-box.expired{background:#fef2f2;border-color:#fecaca;color:#991b1b;}
.status-box .label{font-size:12px;text-transform:uppercase;font-weight:600;opacity:.8;}
.status-box .date{font-size:18px;font-weight:bold;margin:4px 0;}
.status-box .left{font-size:12px;}

.input-group{display:flex;align-items:center;justify-content:center;gap:10px;margin:18px 0;}
.input-group input{width:100px;padding:10px;border:2px solid #cbd5e1;border-radius:5px;font-size:18px;font-weight:bold;text-align:center;}
.input-group input:focus{outline:none;border-color:#0ea5e9;box-shadow:0 0 0 3px rgba(14,165,233,.2);}
.input-group span{font-size:14px;color:#475569;font-weight:600;}

.quick-btns{display:flex;justify-content:center;gap:8px;flex-wrap:wrap;margin-bottom:10px;}
.quick-btns button{background:#f1f5f9;border:1px solid #cbd5e1;padding:5px 10px;border-radius:4px;font-size:12px;cursor:pointer;}
.quick-btns button:hover{background:#e2e8f0;}

.info{background:#eff6ff;border:1px solid #bfdbfe;border-radius:5px;padding:10px;font-size:12px;color:#1e40af;text-align:center;}

.actions{display:flex;justify-content:space-between;align-items:center;margin-top:20px;padding-top:14px;border-top:1px solid #e5e7eb;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:9px 18px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;}
.btn-save{background:linear-gradient(#0ea5e9,#0284c7);border:1px solid #0369a1;color:#fff;padding:9px 20px;border-radius:5px;font-size:13px;font-weight:600;cursor:pointer;}
</style>
<script>
function setDays(d){ document.getElementById('protect').value = d; }
</script>

<div class="prot-wrap">
    <div class="prot-head">
        <div class="icon">🛡️</div>
        <div>
            <h2>Protection: <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo htmlspecialchars($user['username']);?></a></h2>
            <div class="sub">UID: <?php echo $uid; ?></div>
        </div>
    </div>

    <form action="../GameEngine/Admin/Mods/editProtection.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="card">
            <div class="body">
                <div class="status-box <?php echo $isActive ? 'active' : 'expired'; ?>">
                    <div class="label">Current Status</div>
                    <div class="date"><?php echo $isActive ? 'ACTIVE' : 'EXPIRED'; ?></div>
                    <div class="left">Ends: <?php echo $ends; ?><?php if($isActive) echo " ($left days left)"; ?></div>
                </div>

                <div class="input-group">
                    <input type="number" id="protect" name="protect" value="0" min="0" max="365">
                    <span>Days</span>
                </div>

                <div class="quick-btns">
                    <button type="button" onclick="setDays(1)">+1 day</button>
                    <button type="button" onclick="setDays(3)">+3 days</button>
                    <button type="button" onclick="setDays(7)">+7 days</button>
                    <button type="button" onclick="setDays(0)">Remove</button>
                </div>

                <div class="info">💡 Set to 0 to remove protection. Protection is added from the time of saving.</div>
            </div>
        </div>

        <div class="actions">
            <a href="admin.php?p=player&uid=<?php echo $uid;?>" class="btn-back">← Back</a>
            <button type="submit" class="btn-save">💾 Save Protection</button>
        </div>
    </form>
</div>
<?php
} else {
    include("404.tpl");
}
?>