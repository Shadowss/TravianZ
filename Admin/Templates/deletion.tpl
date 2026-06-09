<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : deletion.tpl                                              ##
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
include_once("../GameEngine/Ranking.php");

if(isset($_GET['uid']) && (int)$_GET['uid'] > 0) {
    $uid = (int)$_GET['uid'];
    $target = $database->getUserArray($uid, 1);
    
    if(!$target) {
        include("404.tpl");
        exit;
    }

    $varray = $database->getProfileVillages($uid);
    $totalpop = 0;
    foreach($varray as $vil) { $totalpop += $vil['pop']; }
    
    $ranking->procRankArray();
    $rank = $ranking->getUserRank($uid);
    
    $villages = mysqli_fetch_array(mysqli_query($GLOBALS["link"], "SELECT COUNT(*) as Total FROM ".TB_PREFIX."vdata WHERE owner = $uid"), MYSQLI_ASSOC)['Total'];
?>
<style>
.del-wrap{max-width:650px;margin:0 auto;font-family:Verdana,Arial;}
.del-head{background:linear-gradient(135deg,#FF6666,#FF9933);color:#fff;border-radius:6px;padding:18px 20px;margin-bottom:14px;text-align:center;}
.del-head .icon{font-size:36px;margin-bottom:6px;}
.del-head h2{margin:0;font-size:20px;}
.del-head .warn{font-size:12px;opacity:.9;margin-top:4px;}

.card{background:#fff;border:2px solid #fecaca;border-radius:6px;box-shadow:0 2px 8px rgba(220,38,38,.15);overflow:hidden;}
.card h3{margin:0;padding:10px 14px;background:#fef2f2;border-bottom:1px solid #fecaca;font-size:13px;text-transform:uppercase;color:#991b1b;}

.player-info{display:grid;grid-template-columns:1fr 1fr;gap:0;border-bottom:1px solid #fee2e2;}
.info-item{padding:12px 14px;border-right:1px solid #fee2e2;border-bottom:1px solid #fee2e2;font-size:13px;}
.info-item:nth-child(2n){border-right:none;}
.info-item b{color:#6b7280;font-weight:normal;display:block;font-size:11px;text-transform:uppercase;margin-bottom:2px;}
.info-item .val{font-weight:600;color:#1f2937;}
.info-item .val a{color:#dc2626;text-decoration:none;}
.info-item .val a:hover{text-decoration:underline;}

.danger-box{background:#fff1f2;border:1px solid #fca5a5;border-radius:5px;padding:12px;margin:14px;font-size:12px;color:#7f1d1d;display:flex;gap:10px;align-items:flex-start;}
.danger-box .icon{font-size:20px;flex-shrink:0;}

.confirm-area{padding:0 14px 16px;text-align:center;}
.confirm-area label{display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;}
.confirm-area input[type=password]{width:240px;max-width:100%;padding:9px;border:2px solid #fca5a5;border-radius:5px;font-size:14px;text-align:center;}
.confirm-area input[type=password]:focus{outline:none;border-color:#dc2626;box-shadow:0 0 0 3px rgba(220,38,38,.2);}

.actions{display:flex;justify-content:space-between;align-items:center;padding:14px;background:#fef2f2;border-top:1px solid #fecaca;}
.btn-cancel{background:#fff;border:1px solid #d1d5db;color:#374151;padding:9px 18px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;}
.btn-cancel:hover{background:#f9fafb;}
.btn-delete{background:linear-gradient(#dc2626,#b91c1c);border:1px solid #7f1d1d;color:#fff;padding:9px 22px;border-radius:5px;font-size:13px;font-weight:700;cursor:pointer;box-shadow:0 1px 3px rgba(0,0,0,.2);}
.btn-delete:hover{filter:brightness(1.1);}
</style>

<div class="del-wrap">
    <div class="del-head">
        <div class="icon">⚠️</div>
        <h2>DELETE PLAYER PERMANENTLY</h2>
        <div class="warn">This action cannot be undone!</div>
    </div>

    <form action="../GameEngine/Admin/Mods/delUser.php" method="post" onsubmit="return confirm('ESTI SIGUR? Se va sterge tot: sate, trupe, rapoarte!')">
        <input type="hidden" name="uid" value="<?php echo $target['id']; ?>">
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">

        <div class="card">
            <h3>🗑️ Player to delete</h3>
            
            <div class="player-info">
                <div class="info-item"><b>Name</b><div class="val"><a href="?p=player&uid=<?php echo $target['id']; ?>"><?php echo htmlspecialchars($target['username']); ?></a></div></div>
                <div class="info-item"><b>Gold</b><div class="val"><?php echo $target['gold']; ?> <img src="../img/x.gif" class="gold" style="vertical-align:-2px;"></div></div>
                <div class="info-item"><b>Rank</b><div class="val">#<?php echo $rank; ?></div></div>
                <div class="info-item"><b>Population</b><div class="val"><?php echo number_format($totalpop); ?></div></div>
                <div class="info-item"><b>Villages</b><div class="val"><?php echo $villages; ?></div></div>
                <div class="info-item"><b>Plus ends</b><div class="val"><?php echo $target['plus'] > time() ? date('d.m.Y H:i',$target['plus']) : '-'; ?></div></div>
                <div class="info-item" style="grid-column:1/-1;border-bottom:none;"><b>Alliance</b><div class="val"><?php echo $database->getAllianceName($target['alliance']) ?: '-'; ?></div></div>
            </div>

            <div class="danger-box">
                <div class="icon">🚨</div>
                <div><b>WARNING:</b> All villages (<?php echo $villages; ?>), troops, buildings, reports, messages and player statistics will be <u>permanently</u> deleted. There is no recovery!</div>
            </div>

            <div class="confirm-area">
                <label for="pass">Confirm with your admin password:</label>
                <input type="password" name="pass" id="pass" placeholder="••••••••" required autocomplete="current-password">
            </div>

            <div class="actions">
                <a href="?p=player&uid=<?php echo $uid; ?>" class="btn-cancel">← Cancel</a>
                <button type="submit" class="btn-delete">🗑️ DELETE PLAYER</button>
            </div>
        </div>
    </form>
</div>
<?php
} else {
    include("404.tpl");
}
?>