<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : ban.tpl                    				               ##
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
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");

$error = '';
$success = '';

// ========================= HANDLE ADD BAN =========================
if(isset($_POST['action']) && $_POST['action'] == 'addBan') {
    $uid = (int)($_POST['uid']??0);
    $reason = trim($_POST['reason']??'');
    $time = (int)($_POST['time']??0);
    $blocked = [1,2,3,4,5];

    if($uid <= 0) $error = "Invalid User ID!";
    elseif(in_array($uid,$blocked)) $error = "You cannot ban system accounts!";
    else {
        $userCheck = mysqli_query($database->dblink,"SELECT id,username FROM ".TB_PREFIX."users WHERE id=$uid LIMIT 1");
        if(!$userCheck || mysqli_num_rows($userCheck)==0) $error = "This user does not exist!";
        else {
            $check = mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."banlist WHERE uid=$uid AND active=1 LIMIT 1");
            if(mysqli_num_rows($check)>0) $error = "User is already banned!";
            else {
                $user = mysqli_fetch_assoc($userCheck);
                $name = $user['username'];
                $end = $time>0 ? time()+$time : 0;
                $stmt = $database->dblink->prepare("INSERT INTO `".TB_PREFIX."banlist` (uid,name,reason,time,end,admin,active) VALUES (?,?,?,?,?,0,1)");
                $now = time();
                $stmt->bind_param("issii",$uid,$name,$reason,$now,$end);
                $stmt->execute(); $stmt->close();
                $stmt2 = $database->dblink->prepare("UPDATE `".TB_PREFIX."users` SET access=0 WHERE id=? LIMIT 1");
                $stmt2->bind_param("i",$uid); $stmt2->execute(); $stmt2->close();
                $success = "User <b>$name</b> has been banned successfully!";
            }
        }
    }
}

// ========================= HANDLE ADD IP BAN (issue #185) =========================
if(isset($_POST['action']) && $_POST['action'] == 'addIpBan') {
    $ip     = trim($_POST['ip'] ?? '');
    $reason = trim($_POST['reason'] ?? '');
    $time   = (int)($_POST['time'] ?? 0);

    if(@inet_pton($ip) === false) {
        $error = "Invalid IP address!";
    } else {
        $end = $time > 0 ? time() + $time : 0;
        if($admin->AddIpBan($ip, $end, $reason)) {
            $success = "IP <b>".htmlspecialchars($ip)."</b> has been banned successfully!";
        } else {
            $error = "Could not ban this IP!";
        }
    }
}

// ========================= DATA =========================
$bannedUsers = $admin->search_banned();
$bannedIps   = $admin->search_banned_ip();
$banHistory = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."banlist WHERE active=0 ORDER BY id DESC LIMIT 50");
?>
<style>
.ban-wrap{max-width:1100px;margin:20px auto;font-family:Verdana}
.ban-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.ban-head svg{width:24px;height:24px}
.ban-head h2{margin:0;font-size:18px}
.alert{padding:10px 12px;border-radius:6px;margin-bottom12px;font-size:13px}
.alert.error{background:#ffeaea;border:1px solid #e74c3c;color:#c0392b}
.alert.success{background:#eaf1;border:1px solid #27ae60;color:#1e8449}
.ban-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px}
@media(max-width:800px){.ban-grid{grid-template-columns:1fr}}
.ban-card{background:#fff;border:1px solid #ddd;border-radius:8px;padding:14px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.ban-card h3{margin:0 0 10px;font-size:14px;display:flex;align-items:center;gap:6px}
.ban-form{display:flex;flex-direction:column;gap:8px}
.ban-form .row{display:flex;gap:8px}
.ban-form input,.ban-form select{flex:1;padding:8px 10px;border:1px solid #ccc;border-radius:6px;font-size:13px}
.ban-form button{background:#c0392b;color:#fff;border:0;padding:9px;border-radius:6px;font-weight:bold;cursor:pointer}
.ban-form button:hover{background:#a93226}
.ban-list{display:grid;gap:8px;max-height:400px;overflow:auto;padding-right:4px}
.ban-item{display:flex;justify-content:space-between;align-items:center;padding:8px 10px;background:#fafafa;border:1px solid #eee;border-radius:6px;font-size:12px}
.ban-item .user a{color:#222;text-decoration:none;font-weight:bold}
.ban-item .user a:hover{text-decoration:underline}
.ban-item .meta{color:#666;font-size:11px}
.ban-item .reason{padding:2px 6px;background:#eee;border-radius:3px;font-size:10px;margin:0 6px}
.ban-item .del{color:#c0392b;text-decoration:none;font-weight:bold;padding:2px 6px}
.ban-item .del:hover{background:#ffeaea;border-radius:3px}
.empty{padding:20px;text-align:center;color:#999;background:#fafafa;border:1px dashed #ddd;border-radius:6px}
</style>

<div class="ban-wrap">
  <div class="ban-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" fill="#c0392b"/><path d="M7 7l10 10M17 7L7 17" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
    <h2>Ban Management</h2>
  </div>

  <?php if($error){?><div class="alert error"><?php echo $error;?></div><?php }?>
  <?php if($success){?><div class="alert success"><?php echo $success;?></div><?php }?>

  <div class="ban-grid">
    <!-- ADD BAN -->
    <div class="ban-card">
      <h3>
        <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2L2 7v10l10 5 10-5V7L12 2z" fill="#c0392b"/></svg>
        Add New Ban
      </h3>
      <form method="post" class="ban-form">
        <input type="hidden" name="action" value="addBan">
        <div class="row">
          <input type="number" name="uid" placeholder="User ID" required>
          <select name="reason">
            <?php foreach(['Pushing','Cheat','Hack','Bug','Bad Name','Multi Account','Swearing'] as $r){ echo "<option>$r</option>"; }?>
          </select>
        </div>
        <div class="row">
          <select name="time" style="flex:1">
            <?php foreach([1,2,5,10,12] as $h) echo "<option value='".($h*3600)."'>$h hour/s</option>";
                  foreach([1,2,5,10,30,50,90] as $d) echo "<option value='".($d*86400)."'>$d day/s</option>"; ?>
            <option value="0">Forever</option>
          </select>
          <button type="submit">Ban User</button>
        </div>
      </form>
    </div>

    <!-- ACTIVE BANS -->
    <div class="ban-card">
      <h3>
        <svg width="16" height="16" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="#e74c3c"/></svg>
        Active Bans (<?php echo count($bannedUsers);?>)
      </h3>
      <div class="ban-list">
        <?php if($bannedUsers){ foreach($bannedUsers as $b){
            $name = $database->getUserField($b['uid'],'username',0) ?: $b['name'];
            $end = $b['end'] ? date("d.m H:i",$b['end']) : '∞';
        ?>
          <div class="ban-item">
            <div>
              <div class="user"><a href="?p=player&uid=<?php echo $b['uid'];?>"><?php echo htmlspecialchars($name);?></a></div>
              <div class="meta"><?php echo date("d.m H:i",$b['time']);?> → <?php echo $end;?></div>
            </div>
            <div>
              <span class="reason"><?php echo htmlspecialchars($b['reason']);?></span>
              <a class="del" href="?action=delBan&uid=<?php echo $b['uid'];?>&id=<?php echo $b['id'];?>" onclick="return confirm('Unban?')" title="Unban">✕</a>
            </div>
          </div>
        <?php }} else { echo '<div class="empty">No active bans</div>'; }?>
      </div>
    </div>
  </div>

  <!-- ===================== IP BANS (issue #185) ===================== -->
  <div class="ban-grid">
    <!-- ADD IP BAN -->
    <div class="ban-card">
      <h3>
        <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2L2 7v10l10 5 10-5V7L12 2z" fill="#c0392b"/></svg>
        Ban IP Address
      </h3>
      <form method="post" class="ban-form">
        <input type="hidden" name="action" value="addIpBan">
        <div class="row">
          <input type="text" name="ip" placeholder="IPv4 or IPv6" required>
          <select name="reason">
            <?php foreach(['Pushing','Cheat','Hack','Bug','Bad Name','Multi Account','Swearing'] as $r){ echo "<option>$r</option>"; }?>
          </select>
        </div>
        <div class="row">
          <select name="time" style="flex:1">
            <?php foreach([1,2,5,10,12] as $h) echo "<option value='".($h*3600)."'>$h hour/s</option>";
                  foreach([1,2,5,10,30,50,90] as $d) echo "<option value='".($d*86400)."'>$d day/s</option>"; ?>
            <option value="0">Forever</option>
          </select>
          <button type="submit">Ban IP</button>
        </div>
      </form>
    </div>

    <!-- ACTIVE IP BANS -->
    <div class="ban-card">
      <h3>
        <svg width="16" height="16" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="#e74c3c"/></svg>
        Active IP Bans (<?php echo count($bannedIps);?>)
      </h3>
      <div class="ban-list">
        <?php if($bannedIps){ foreach($bannedIps as $b){
            $end = $b['end'] ? date("d.m H:i",$b['end']) : '&infin;';
        ?>
          <div class="ban-item">
            <div>
              <div class="user"><?php echo htmlspecialchars($b['ip_text']);?></div>
              <div class="meta"><?php echo date("d.m H:i",$b['time']);?> &rarr; <?php echo $end;?></div>
            </div>
            <div>
              <span class="reason"><?php echo htmlspecialchars($b['reason']);?></span>
              <a class="del" href="?p=ban&action=delIpBan&id=<?php echo (int)$b['id'];?>" onclick="return confirm('Unban this IP?')" title="Unban IP">&#10005;</a>
            </div>
          </div>
        <?php }} else { echo '<div class="empty">No active IP bans</div>'; }?>
      </div>
    </div>
  </div>

  <!-- HISTORY -->
  <div class="ban-card">
    <h3>
      <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 5v7l4 2" stroke="#555" stroke-width="2" fill="none" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="#555" stroke-width="2" fill="none"/></svg>
      Ban History
    </h3>
    <div class="ban-list">
      <?php if($banHistory && mysqli_num_rows($banHistory)>0){ while($h=mysqli_fetch_assoc($banHistory)){
          $end = $h['end'] ? date("d.m H:i",$h['end']) : '∞';
      ?>
        <div class="ban-item" style="opacity:.7">
          <div>
            <div class="user"><?php echo htmlspecialchars($h['name']);?></div>
            <div class="meta"><?php echo date("d.m H:i",$h['time']);?> → <?php echo $end;?></div>
          </div>
          <span class="reason"><?php echo htmlspecialchars($h['reason']);?></span>
        </div>
      <?php }} else { echo '<div class="empty">No history</div>'; }?>
    </div>
  </div>
</div>