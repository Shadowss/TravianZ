<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editOverall.tpl                                           ##
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
?>
<style>
.over-wrap{max-width:700px;margin:0 auto;font-family:Verdana,Arial;}
.over-head{background:linear-gradient(135deg,#7c3aed,#5b21b6);color:#fff;border-radius:6px;padding:16px 20px;margin-bottom:14px;display:flex;align-items:center;gap:12px;}
.over-head .icon{font-size:28px;background:rgba(255,255,255,.15);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
.over-head h2{margin:0;font-size:18px;}
.over-head h2 a{color:#fff;text-decoration:none;}
.over-head .sub{font-size:12px;opacity:.85;margin-top:2px;}

.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;}
.card .body{padding:20px;}
.info{background:#f5f3ff;border:1px solid #ddd6fe;border-radius:5px;padding:10px 12px;font-size:12px;color:#5b21b6;margin-bottom:16px;}

.stats-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
@media(max-width:600px){.stats-grid{grid-template-columns:1fr;}}
.stat-box{border:1px solid #e2e8f0;border-radius:8px;padding:18px;text-align:center;background:#fafafa;transition:.2s;}
.stat-box:hover{transform:translateY(-2px);box-shadow:0 4px 8px rgba(0,0,0,.06);}
.stat-box.off{border-top:3px solid #dc2626;background:#fef2f2;}
.stat-box.def{border-top:3px solid #2563eb;background:#eff6ff;}
.stat-box .icon{font-size:32px;margin-bottom:8px;}
.stat-box .label{font-size:13px;font-weight:600;color:#475569;margin-bottom:4px;text-transform:uppercase;letter-spacing:.5px;}
.stat-box .current{font-size:11px;color:#64748b;margin-bottom:10px;}
.stat-box input{width:140px;padding:10px;border:1px solid #cbd5e1;border-radius:5px;font-size:18px;font-weight:bold;text-align:center;font-family:monospace;}
.stat-box input:focus{outline:none;box-shadow:0 0 0 3px rgba(124,58,237,.15);}
.stat-box.off input:focus{border-color:#dc2626;box-shadow:0 0 0 3px rgba(220,38,38,.15);}
.stat-box.def input:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.15);}

.actions{display:flex;justify-content:space-between;align-items:center;margin-top:20px;padding-top:14px;border-top:1px solid #e5e7eb;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:9px 18px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-back:hover{background:#e5e7eb;}
.btn-save{background:linear-gradient(#7c3aed,#5b21b6);border:1px solid #4c1d95;color:#fff;padding:9px 20px;border-radius:5px;font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;}
.btn-save:hover{filter:brightness(1.05);}
</style>

<div class="over-wrap">
    <div class="over-head">
        <div class="icon">⚔️</div>
        <div>
            <h2>Overall Points: <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo htmlspecialchars($user['username']);?></a></h2>
            <div class="sub">UID: <?php echo $uid; ?> • Rank: #<?php echo (int)$user['rank']; ?></div>
        </div>
    </div>

    <form action="../GameEngine/Admin/Mods/editOverall.php" method="POST">
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="card">
            <div class="body">
                <div class="info">🛡️ Acestea sunt punctele <b>totale</b> din statistici (nu cele săptămânale). Se adună din toate atacurile.</div>
                
                <div class="stats-grid">
                    <div class="stat-box off">
                        <div class="icon">⚔️</div>
                        <div class="label">Attack Points</div>
                        <div class="current">Current: <?php echo number_format($user['apall']); ?></div>
                        <input type="number" name="off" value="<?php echo (int)$user['apall']; ?>" min="0" step="1">
                    </div>

                    <div class="stat-box def">
                        <div class="icon">🛡️</div>
                        <div class="label">Defence Points</div>
                        <div class="current">Current: <?php echo number_format($user['dpall']); ?></div>
                        <input type="number" name="def" value="<?php echo (int)$user['dpall']; ?>" min="0" step="1">
                    </div>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="admin.php?p=player&uid=<?php echo $uid;?>" class="btn-back">← Back</a>
            <button type="submit" class="btn-save">💾 Save Points</button>
        </div>
    </form>
</div>
<?php
} else {
    include("404.tpl");
}
?>