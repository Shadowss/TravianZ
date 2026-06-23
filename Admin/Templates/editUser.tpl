<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editUser.tpl                                              ##
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

$id = (int)$_GET['uid'];
if(isset($id) && $id > 0) {
    $varray = $database->getProfileVillages($id);
    $varmedal = $database->getProfileMedal($id);
    $uid = $id;
?>
<style>
.editUser-wrap { max-width:1100px; margin:0 auto; font-family:system-ui; }
.editUser-head {
    background: linear-gradient(135deg,#66CCFF,#66CCCC); color:#fff;
    padding:10px 14px; margin-bottom:12px;
    border-radius:10px; display:flex; align-items:center; justify-content:space-between;
}
.editUser-head h2 { margin:0; font-size:16px; }
.editUser-head h2 a { color:#86efac; text-decoration:none; }
.editUser-head .meta { font-size:12px; color:#cbd5e1; }
@media(max-width:900px){ .editUser-grid{grid-template-columns:1fr;} }

.card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; margin-bottom:12px; box-shadow:0 1px 3px rgba(0,0,0,.04); }
.card h3 { margin:0; padding:9px 12px; background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:12px; text-transform:uppercase; color:#475569; letter-spacing:.5px; }
.card .body { padding:12px; }

.form-row { display:flex; margin-bottom:10px; align-items:center; }
.form-row label { width:110px; font-size:12px; color:#333; font-weight:bold; }
.form-row input.fm, .form-row select.dropdown { flex:1; border:1px solid #bbb; padding:5px 6px; font-size:12px; border-radius:3px; background:#fff; }
.form-row input.fm:focus, select.dropdown:focus { border-color:#71D000; outline:none; box-shadow:0 0 3px rgba(113,208,0,.4); }
select.dropdown { width:100%; }

.username-row { background:#f9fff0; border:1px solid #d4edaa; border-radius:3px; padding:8px; margin-bottom:12px; }
.username-row .form-row { margin-bottom:0; }
.btn-mini { background:linear-gradient(#7ed321,#5eae0f); border:1px solid #4a8a0c; color:#fff; padding:5px 10px; font-size:11px; font-weight:bold; border-radius:3px; cursor:pointer; margin-left:6px; }
.btn-mini:hover { filter:brightness(1.05); }

.desc-box textarea { width:100%; box-sizing:border-box; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-family:system-ui; font-size:13px; resize:vertical; }
.desc-box textarea:focus { border-color:#71D000; outline:none; }

.medals-table { width:100%; border-collapse:collapse; font-size:12px; }
.medals-table th { background:#f5f5f5; padding:6px; border:1px solid #ddd; text-align:left; }
.medals-table td { padding:6px; border:1px solid #eee; }
.medals-table tr:nth-child(even){ background:#fafafa; }
.badge { display:inline-block; padding:2px 6px; border-radius:3px; font-size:11px; color:#fff; }
.badge.att { background:#c00; } .badge.def { background:#069; } .badge.climb { background:#e67e00; } .badge.rob { background:#6a0dad; }

.actions { margin-top:14px; text-align:center; }
.btn-save { background:linear-gradient(#7ed321,#5eae0f); border:1px solid #4a8a0c; color:#fff; padding:8px 24px; font-size:14px; font-weight:bold; border-radius:4px; cursor:pointer; text-shadow:0 -1px 0 rgba(0,0,0,.2); }
.btn-save:hover { filter:brightness(1.05); }
.back-link { font-size:12px; margin-left:12px; }
.back-link a { color:#0066cc; text-decoration:none; }
.back-link a:hover { text-decoration:underline; }
</style>

<div class="editUser-wrap">
    <div class="editUser-head">
        <h2>✏️ Edit Player: <a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></a></h2>
        <div class="meta">ID: <?php echo $id; ?> | Villages: <?php echo count($varray); ?> | Gold: <?php echo $user['gold']; ?> <img src="../img/x.gif" class="gold" style="vertical-align:-2px;"></div>
    </div>

    <div class="editUser-grid">
        <!-- LEFT: DETAILS -->
        <div class="card">
            <h3>👤 Account Details</h3>
            <div class="body">
                
                <!-- USERNAME EDIT - NOU -->
                <div class="username-row">
                    <form action="../GameEngine/Admin/Mods/editUsername.php" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <div class="form-row">
                            <label>👤 Username</label>
                            <input class="fm" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" style="flex:1;">
                            <button type="submit" class="btn-mini" title="Change Username">💾 Save</button>
                        </div>
                    </form>
                </div>

                <!-- RESTUL FORMULUI PRINCIPAL -->
                <form action="../GameEngine/Admin/Mods/editUser.php" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />

                    <div class="form-row">
                        <label> ⚔️ Tribe</label>
                        <select name="tribe" class="dropdown">
                            <option value="1" <?php if($user['tribe']==1)echo"selected"; ?>>1. Roman</option>
                            <option value="2" <?php if($user['tribe']==2)echo"selected"; ?>>2. Teuton</option>
                            <option value="3" <?php if($user['tribe']==3)echo"selected"; ?>>3. Gaul</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label>📍 Location</label>
                        <input class="fm" name="location" value="<?php echo htmlspecialchars($user['location']); ?>">
                    </div>
                    <div class="form-row">
                        <label>✉️ E-mail</label>
                        <input class="fm" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>
                    <div class="form-row">
                        <label>🎯 Quest</label>
                        <input class="fm" name="quest" value="<?php echo (int)$user['quest']; ?>">
                    </div>

                    <div style="margin-top:14px; border-top:1px dashed #ddd; padding-top:10px;">
                        <label style="font-weight:bold; font-size:12px; display:block; margin-bottom:4px;">📝 Profile Description (left)</label>
                        <div class="desc-box">
                            <textarea name="desc1" rows="10"><?php echo htmlspecialchars($user['desc1']); ?></textarea>
                        </div>
                    </div>
                
            </div>
        </div>

        <!-- RIGHT: DESCRIPTION -->
        <div class="card">
            <h3>📄 Profile Description (right)</h3>
            <div class="body desc-box">
                <textarea name="desc2" rows="22"><?php echo htmlspecialchars($user['desc2']); ?></textarea>
                <div style="font-size:11px; color:#777; margin-top:4px;">Suport BBCode. Folosește Enter pentru linii noi.</div>
            </div>
        </div>
    </div>

    <!-- MEDALS -->
    <div class="card" style="margin-top:12px;">
        <h3>🏅 Medals</h3>
        <div class="body" style="padding:0;">
            <table class="medals-table">
                <thead>
                    <tr>
                        <th style="width:35%;">Category</th>
                        <th style="width:15%;">Rank</th>
                        <th style="width:15%;">Week</th>
                        <th>BB-Code</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($varmedal as $medal){
                    $titel="Bonus"; $class=""; $icon="⭐";
                    switch($medal['categorie']){
                        case "1": $titel="Attacker of the Week"; $class="att"; $icon="⚔️"; break;
                        case "2": $titel="Defender of the Week"; $class="def"; $icon="🛡️"; break;
                        case "3": $titel="Climber of the Week"; $class="climb"; $icon="📈"; break;
                        case "4": $titel="Robber of the Week"; $class="rob"; $icon="💰"; break;
                    }
                    echo "<tr>
                        <td><span class='badge $class'>$icon</span> $titel</td>
                        <td>#".$medal['plaats']."</td>
                        <td>".$medal['week']."</td>
                        <td><code>[#".$medal['id']."]</code></td>
                    </tr>";
                }
                ?>
                <tr>
                    <td><span class="badge" style="background:#999;">🔰</span> Beginners Protection</td>
                    <td>-</td><td>-</td><td><code>[#0]</code></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="actions">
        </form> <!-- închidem form-ul principal aici -->
        <button type="submit" form="dummy" onclick="document.querySelector('form[action*=\'editUser.php\']').submit()" class="btn-save">💾 Save Changes</button>
        <span class="back-link"><a href="?p=player&uid=<?php echo $user['id']; ?>">« Go back to player</a></span>
    </div>
</div>
<?php
} else {
    echo "<div style='padding:20px; text-align:center;'>❌ Player not found. <a href=\"javascript:history.go(-1)\">Go Back</a></div>";
}
?>