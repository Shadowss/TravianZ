<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editAli.tpl                                               ##
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

$aid = isset($_GET['aid']) ? (int)$_GET['aid'] : 0;
if($aid) {
    $alidata = $database->getAlliance($aid);
    $members = $database->getAllMember($aid);
    if(!$alidata){ echo "<div style='padding:30px'>Alliance not found</div>"; return; }
    
    // calculeaza max dupa ambasada ca fallback
    $embLevel = 0;
    $embQ = mysqli_query($GLOBALS["link"], "SELECT MAX(level) as lvl FROM ".TB_PREFIX."bdata b JOIN ".TB_PREFIX."vdata v ON v.wref=b.wid WHERE v.owner=".(int)$alidata['leader']." AND b.type=18");
    if($r = mysqli_fetch_assoc($embQ)) $embLevel = (int)$r['lvl'];
    $calcMax = max(3, $embLevel * 3);
?>
<style>
.editAli-wrap{max-width:900px;margin:0 auto;font-family:Verdana,Arial;}
.editAli-head{background:linear-gradient(#fff,#f2f2f2);border:1px solid #c9c9c9;border-radius:5px;padding:14px 16px;margin-bottom:12px;}
.editAli-head h2{margin:0;font-size:20px;color:#222;}
.editAli-head h2 span{color:#71D000;}
.card{background:#fff;border:1px solid #d5d5d5;border-radius:4px;margin-bottom:12px;overflow:hidden;}
.card h3{margin:0;padding:8px 12px;background:#f7f7f7;border-bottom:1px solid #e0e0e0;font-size:13px;text-transform:uppercase;color:#444;}
.card .body{padding:14px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:700px){.form-grid{grid-template-columns:1fr;}}
.form-row{margin-bottom:12px;}
.form-row label{display:block;font-size:12px;font-weight:bold;color:#333;margin-bottom:4px;}
.form-row input[type=text], .form-row select, .form-row input[type=number]{
    width:100%;box-sizing:border-box;padding:7px 8px;border:1px solid #bbb;border-radius:3px;font-size:13px;
}
.form-row input:focus, select:focus, textarea:focus{border-color:#71D000;outline:none;box-shadow:0 0 3px rgba(113,208,0,.3);}
textarea{width:100%;box-sizing:border-box;min-height:120px;padding:8px;border:1px solid #bbb;border-radius:3px;font-family:Verdana,Arial;font-size:12px;resize:vertical;}
.btn-save{background:linear-gradient(#7ed321,#5eae0f);border:1px solid #4a8a0c;color:#fff;padding:9px 26px;font-size:14px;font-weight:bold;border-radius:4px;cursor:pointer;}
.btn-save:hover{filter:brightness(1.05);}
.actions{text-align:center;margin-top:16px;}
.hint{font-size:11px;color:#777;margin-top:3px;}
</style>

<div class="editAli-wrap">
    <div class="editAli-head">
        <h2>✏️ Edit Alliance: <span><?php echo htmlspecialchars($alidata['tag']); ?></span> - <?php echo htmlspecialchars($alidata['name']); ?></h2>
    </div>

    <form action="../GameEngine/Admin/Mods/editAli.php" method="POST">
        <input type="hidden" name="aid" value="<?php echo $aid; ?>">
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">

        <div class="card">
            <h3>⚙️ Basic Settings</h3>
            <div class="body">
                <div class="form-grid">
                    <div class="form-row">
                        <label>Alliance Tag (max 8)</label>
                        <input type="text" name="tag" maxlength="8" value="<?php echo htmlspecialchars($alidata['tag']); ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Alliance Name</label>
                        <input type="text" name="name" maxlength="25" value="<?php echo htmlspecialchars($alidata['name']); ?>" required>
                    </div>
                    <div class="form-row">
                        <label>👑 Leader (Founder)</label>
                        <select name="leader">
                            <?php foreach($members as $m){
                                $sel = $m['id']==$alidata['leader'] ? 'selected' : '';
                                echo '<option value="'.$m['id'].'" '.$sel.'>'.htmlspecialchars($m['username']).'</option>';
                            } ?>
                        </select>
                        <div class="hint">Schimbă fondatorul alianței</div>
                    </div>
                    <div class="form-row">
                        <label>👥 Max Members</label>
                        <input type="number" name="max" min="3" max="60" value="<?php echo (int)($alidata['max'] ? $alidata['max'] : $calcMax); ?>">
                        <div class="hint">Calculat automat: <?php echo $calcMax; ?> (Ambasada lvl <?php echo $embLevel; ?> × 3)</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h3>📢 Alliance Notice (apare sus)</h3>
            <div class="body">
                <textarea name="notice" placeholder="Mesaj scurt pentru membri..."><?php echo htmlspecialchars($alidata['notice']); ?></textarea>
            </div>
        </div>

        <div class="card">
            <h3>📖 Alliance Description (pagina publică)</h3>
            <div class="body">
                <textarea name="desc" style="min-height:200px;" placeholder="Descriere lungă, BBCode permis..."><?php echo htmlspecialchars($alidata['desc']); ?></textarea>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn-save">💾 Save Alliance</button>
            <a href="admin.php?p=alliance&aid=<?php echo $aid; ?>" style="margin-left:12px;color:#555;text-decoration:none;">← Cancel</a>
        </div>
    </form>
</div>
<?php
} // <- închide if($aid)
?>