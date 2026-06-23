<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editPassword.tpl                                          ##
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

if(isset($_GET['uid'])) {
    $uid = (int)$_GET['uid'];
    $user = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT id, username, email FROM ".TB_PREFIX."users WHERE id = $uid"));
    if(!$user){ include("404.tpl"); return; }
?>
<style>
.pw-wrap{max-width:600px;margin:0 auto;font-family:Verdana,Arial;}
.pw-head{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;border-radius:6px;padding:16px 20px;margin-bottom:14px;display:flex;align-items:center;gap:12px;}
.pw-head .icon{font-size:28px;background:rgba(255,255,255,.15);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
.pw-head h2{margin:0;font-size:18px;}
.pw-head h2 a{color:#fff;text-decoration:none;}
.pw-head .sub{font-size:12px;opacity:.85;margin-top:2px;}

.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;}
.card .body{padding:20px;}
.warning{background:#fef2f2;border:1px solid #fecaca;border-radius:5px;padding:10px 12px;font-size:12px;color:#991b1b;margin-bottom:16px;display:flex;gap:8px;align-items:flex-start;}

.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;}
.input-wrap{position:relative;display:flex;align-items:center;}
.input-wrap input{width:100%;padding:10px 40px 10px 12px;border:1px solid #d1d5db;border-radius:5px;font-size:14px;font-family:monospace;box-sizing:border-box;}
.input-wrap input:focus{border-color:#dc2626;outline:none;box-shadow:0 0 0 3px rgba(220,38,38,.15);}
.toggle-eye{position:absolute;right:8px;background:none;border:none;cursor:pointer;font-size:18px;color:#6b7280;padding:4px;}
.btn-gen{background:#f3f4f6;border:1px solid #d1d5db;color:#374151;padding:6px 12px;border-radius:4px;font-size:12px;cursor:pointer;margin-top:6px;}
.btn-gen:hover{background:#e5e7eb;}

.actions{display:flex;justify-content:space-between;align-items:center;margin-top:20px;padding-top:14px;border-top:1px solid #e5e7eb;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:9px 18px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-back:hover{background:#e5e7eb;}
.btn-save{background:linear-gradient(#dc2626,#b91c1c);border:1px solid #991b1b;color:#fff;padding:9px 20px;border-radius:5px;font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 1px 2px rgba(0,0,0,.1);}
.btn-save:hover{filter:brightness(1.05);}
</style>
<script>
function togglePw(){
    const i = document.getElementById('newpw');
    i.type = i.type === 'password' ? 'text' : 'password';
}
function genPw(){
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789!@#';
    let pw = '';
    for(let i=0;i<12;i++) pw += chars.charAt(Math.floor(Math.random()*chars.length));
    document.getElementById('newpw').value = pw;
    document.getElementById('newpw').type = 'text';
}
</script>

<div class="pw-wrap">
    <div class="pw-head">
        <div class="icon">🔐</div>
        <div>
            <h2>Change Password: <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo htmlspecialchars($user['username']);?></a></h2>
            <div class="sub">UID: <?php echo $uid; ?> • <?php echo htmlspecialchars($user['email']); ?></div>
        </div>
    </div>

    <form action="../GameEngine/Admin/Mods/editPassword.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="uid" value="<?php echo $uid; ?>">

        <div class="card">
            <div class="body">
                <div class="warning">
                    <span>⚠️</span>
                    <div><b>WARNING:</b> The password is changed instantly. The player will be logged out. No automatic email is sent.</div>
                </div>

                <div class="form-group">
                    <label for="newpw">New Password</label>
                    <div class="input-wrap">
                        <input type="text" id="newpw" name="newpw" value="" placeholder="Introdu parola nouă" autocomplete="new-password" required>
                        <button type="button" class="toggle-eye" onclick="togglePw()" title="Show/Hide">👁️</button>
                    </div>
                    <button type="button" class="btn-gen" onclick="genPw()">🎲 Generate secure password</button>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="admin.php?p=player&uid=<?php echo $uid;?>" class="btn-back">← Back</a>
            <button type="submit" class="btn-save">🔐 Change Password</button>
        </div>
    </form>
</div>
<?php
} else {
    include("404.tpl");
}
?>