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

// ========================= HANDLE ADD IP BAN =========================
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
$historyCount = $banHistory ? mysqli_num_rows($banHistory) : 0;
?>
<style>
.ban-wrap{max-width:900px;margin:0 auto;padding:4px 14px;font-family:Verdana,Arial,sans-serif;color:#0f172a}
.ban-head{display:flex;align-items:center;gap:10px;margin:0 0 14px;padding-bottom:10px;border-bottom:1px dashed rgba(255,255,255,.12)}
.ban-head svg{width:26px;height:26px}
.ban-head h2{margin:0;font-size:20px;font-weight:700;color:#fff;letter-spacing:.3px}

.alert{padding:11px 14px;border-radius:8px;margin:0 0 14px;font-size:13px;border:1px solid transparent}
.alert.error{background:#fef2f2;border-color:#fecaca;color:#b91c1c}
.alert.success{background:#f0fdf4;border-color:#bbf7d0;color:#166534}

.ban-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:18px}
@media(max-width:640px){.ban-stats{grid-template-columns:1fr}}
.stat{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:12px 14px;display:flex;align-items:center;gap:12px;box-shadow:0 1px 2px rgba(0,0,0,.04)}
.stat .ico{width:38px;height:38px;border-radius:10px;display:grid;place-items:center;background:#fef2f2;color:#c0392b}
.stat .lbl{font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:.5px}
.stat .val{font-size:20px;font-weight:700;color:#111;line-height:1}

/* STACK VERTICAL */
.ban-stack{display:flex;flex-direction:column;gap:16px}

.ban-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;box-shadow:0 1px 2px rgba(0,0,0,.04),0 6px 16px rgba(0,0,0,.03)}
.ban-card h3{margin:0 0 12px;font-size:14px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:8px}
.badge-count{background:#fee2e2;color:#b91c1c;padding:2px 8px;border-radius:999px;font-size:11px;font-weight:700;border:1px solid #fecaca}

.ban-form{display:grid;gap:10px}
.ban-form .row{display:grid;grid-template-columns:1fr 180px;gap:8px}
.ban-form .row.two{display:grid;grid-template-columns:120px 1fr}
@media(max-width:560px){.ban-form .row,.ban-form .row.two{grid-template-columns:1fr}}
.ban-form input,.ban-form select{width:100%;padding:11px 12px;border:1px solid #d1d5db;border-radius:9px;font-size:13px;background:#fff;color:#111;outline:none;transition:.15s}
.ban-form input:focus,.ban-form select:focus{border-color:#c0392b;box-shadow:0 0 0 3px rgba(192,57,43,.13)}
.ban-form button{background:#c0392b;color:#fff;border:0;padding:11px 16px;border-radius:9px;font-weight:700;cursor:pointer;transition:.15s;width:100%}
.ban-form button:hover{background:#a93226}

.ban-list{display:flex;flex-direction:column;gap:8px;max-height:380px;overflow:auto;padding-right:4px}
.ban-list::-webkit-scrollbar{width:6px}.ban-list::-webkit-scrollbar-thumb{background:#e5e7eb;border-radius:3px}
.ban-item{display:grid;grid-template-columns:1fr auto;gap:10px;align-items:center;padding:11px 12px;background:#fafafa;border:1px solid #eee;border-radius:10px}
.ban-item:hover{background:#fff;border-color:#e5e7eb}
.ban-item .user a{color:#111;text-decoration:none;font-weight:700;font-size:13px}
.ban-item .meta{color:#6b7280;font-size:11px;margin-top:3px}
.ban-item .right{display:flex;align-items:center;gap:8px}
.ban-item .reason{padding:4px 9px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:999px;font-size:11px;font-weight:600}
.ban-item .del{color:#c0392b;text-decoration:none;font-weight:700;padding:6px 8px;border-radius:6px}
.ban-item .del:hover{background:#fee2e2}
.empty{padding:26px;text-align:center;color:#9ca3af;background:#fafafa;border:1px dashed #e5e7eb;border-radius:10px;font-size:13px}
</style>

<div class="ban-wrap">
  <div class="ban-head">
    <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#c0392b"/><path d="M7 7l10 10M17 7L7 17" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
    <h2>Ban Management</h2>
  </div>

  <?php if($error){?><div class="alert error"><?php echo $error;?></div><?php }?>
  <?php if($success){?><div class="alert success"><?php echo $success;?></div><?php }?>

  <div class="ban-stats">
    <div class="stat"><div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zM4 20c0-3.3 2.7-6 6-6h4c3.3 0 6 2.7 6 6v1H4v-1z"/></svg></div><div><div class="lbl">Active User Bans</div><div class="val"><?php echo count($bannedUsers);?></div></div></div>
    <div class="stat"><div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg></div><div><div class="lbl">Active IP Bans</div><div class="val"><?php echo count($bannedIps);?></div></div></div>
    <div class="stat"><div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div><div><div class="lbl">History (last 50)</div><div class="val"><?php echo $historyCount;?></div></div></div>
  </div>

  <div class="ban-stack">
    <!-- 1. Add New Ban -->
    <div class="ban-card">
      <h3><svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2L2 7v10l10 5 10-5V7L12 2z" fill="#c0392b"/></svg> Add New Ban</h3>
      <form method="post" class="ban-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="addBan">
        <div class="row">
          <input type="number" name="uid" placeholder="User ID" required>
          <select name="reason"><?php foreach(['Pushing','Cheat','Hack','Bug','Bad Name','Multi Account','Swearing'] as $r){ echo "<option>$r</option>"; }?></select>
        </div>
        <div class="row two">
          <select name="time"><?php foreach([1,2,5,10,12] as $h) echo "<option value='".($h*3600)."'>$h hour/s</option>"; foreach([1,2,5,10,30,50,90] as $d) echo "<option value='".($d*86400)."'>$d day/s</option>"; ?><option value="0">Forever</option></select>
          <button type="submit">Ban User</button>
        </div>
      </form>
    </div>

    <!-- 2. Active Bans -->
    <div class="ban-card">
      <h3><svg width="16" height="16" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="#e74c3c"/></svg> Active Bans <span class="badge-count"><?php echo count($bannedUsers);?></span></h3>
      <div class="ban-list">
        <?php if($bannedUsers){ foreach($bannedUsers as $b){ $name = $database->getUserField($b['uid'],'username',0) ?: $b['name']; $end = $b['end'] ? date("d.m H:i",$b['end']) : '∞'; ?>
          <div class="ban-item">
            <div><div class="user"><a href="?p=player&uid=<?php echo $b['uid'];?>"><?php echo htmlspecialchars($name);?></a></div><div class="meta"><?php echo date("d.m H:i",$b['time']);?> → <?php echo $end;?></div></div>
            <div class="right"><span class="reason"><?php echo htmlspecialchars($b['reason']);?></span><a class="del" href="?action=delBan&uid=<?php echo $b['uid'];?>&id=<?php echo $b['id'];?>" onclick="return confirm('Unban?')">✕</a></div>
          </div>
        <?php }} else { echo '<div class="empty">No active bans</div>'; }?>
      </div>
    </div>

    <!-- 3. Ban IP Address -->
    <div class="ban-card">
      <h3><svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2L2 7v10l10 5 10-5V7L12 2z" fill="#c0392b"/></svg> Ban IP Address</h3>
      <form method="post" class="ban-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="addIpBan">
        <div class="row">
          <input type="text" name="ip" placeholder="IPv4 or IPv6" required>
          <select name="reason"><?php foreach(['Pushing','Cheat','Hack','Bug','Bad Name','Multi Account','Swearing'] as $r){ echo "<option>$r</option>"; }?></select>
        </div>
        <div class="row two">
          <select name="time"><?php foreach([1,2,5,10,12] as $h) echo "<option value='".($h*3600)."'>$h hour/s</option>"; foreach([1,2,5,10,30,50,90] as $d) echo "<option value='".($d*86400)."'>$d day/s</option>"; ?><option value="0">Forever</option></select>
          <button type="submit">Ban IP</button>
        </div>
      </form>
    </div>

    <!-- 4. Active IP Bans -->
    <div class="ban-card">
      <h3><svg width="16" height="16" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="#e74c3c"/></svg> Active IP Bans <span class="badge-count"><?php echo count($bannedIps);?></span></h3>
      <div class="ban-list">
        <?php if($bannedIps){ foreach($bannedIps as $b){ $end = $b['end'] ? date("d.m H:i",$b['end']) : '∞'; ?>
          <div class="ban-item">
            <div><div class="user"><strong><?php echo htmlspecialchars($b['ip_text']);?></strong></div><div class="meta"><?php echo date("d.m H:i",$b['time']);?> → <?php echo $end;?></div></div>
            <div class="right"><span class="reason"><?php echo htmlspecialchars($b['reason']);?></span><a class="del" href="?p=ban&action=delIpBan&id=<?php echo (int)$b['id'];?>" onclick="return confirm('Unban this IP?')">✕</a></div>
          </div>
        <?php }} else { echo '<div class="empty">No active IP bans</div>'; }?>
      </div>
    </div>

    <!-- 5. Ban History -->
    <div class="ban-card">
      <h3><svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 5v7l4 2" stroke="#555" stroke-width="2" fill="none" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="#555" stroke-width="2" fill="none"/></svg> Ban History</h3>
      <div class="ban-list" style="max-height:300px">
        <?php if($banHistory && $historyCount>0){ while($h=mysqli_fetch_assoc($banHistory)){ $end = $h['end'] ? date("d.m H:i",$h['end']) : '∞'; ?>
          <div class="ban-item" style="opacity:.8">
            <div><div class="user"><strong><?php echo htmlspecialchars($h['name']);?></strong></div><div class="meta"><?php echo date("d.m H:i",$h['time']);?> → <?php echo $end;?></div></div>
            <span class="reason"><?php echo htmlspecialchars($h['reason']);?></span>
          </div>
        <?php }} else { echo '<div class="empty">No history</div>'; }?>
      </div>
    </div>
  </div>
</div>