<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Newmessage.tpl 	    	                               ##
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
error_reporting(E_ALL ^ E_NOTICE);
$id = (int)$_GET['uid'];
if($id){
$user = $database->getUserArray($id,1);
?>
<style>
.msg-wrap{font-family:system-ui;max-width:720px;margin:12px auto}
.msg-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.06);overflow:hidden}
.msg-head{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:14px 18px;display:flex;align-items:center;justify-content:space-between}
.msg-head h4{margin:0;font-size:15px;font-weight:600}
.msg-head a{color:#93c5fd;text-decoration:none}
.msg-head a:hover{color:#fff}
.msg-body{padding:18px}
.msg-row{display:grid;grid-template-columns:120px 1fr;gap:12px;align-items:center;margin-bottom:12px}
.msg-label{font-size:12px;color:#64748b;text-transform:uppercase;font-weight:600}
.msg-input,.msg-text{width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;font-family:system-ui;box-sizing:border-box;transition:.15s}
.msg-input:focus,.msg-text:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.15)}
.msg-text{min-height:220px;resize:vertical;line-height:1.5}
.msg-meta{display:flex;gap:16px;font-size:12px;color:#64748b;margin:-4px 0 14px 132px}
.msg-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:16px;padding-top:14px;border-top:1px solid #f1f5f9}
.btn-primary{background:#2563eb;color:#fff;border:0;padding:9px 18px;border-radius:8px;font-weight:600;cursor:pointer;font-size:14px}
.btn-primary:hover{background:#1d4ed8}
.btn-ghost{background:#f1f5f9;color:#334155;border:0;padding:9px 14px;border-radius:8px;text-decoration:none;font-size:14px}
.alert-ok{background:#ecfdf5;color:#065f46;padding:10px 12px;border-radius:8px;margin-bottom:12px;font-size:13px;border:1px solid #a7f3d0}
@media(max-width:600px){.msg-row{grid-template-columns:1fr}.msg-meta{margin-left:0}}
</style>

<div class="msg-wrap">
  <?php if(isset($_GET['msg'])){ echo '<div class="alert-ok">✓ Message sent successfully</div>'; } ?>
  
  <div class="msg-card">
    <div class="msg-head">
      <h4>New Message</h4>
      <div>to <a href="admin.php?p=player&uid=<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></a></div>
    </div>
    
    <form method="post" action="../GameEngine/Admin/Mods/sendMessage.php" name="msg">
      <?php echo csrf_field(); ?>
      <div class="msg-body">
        <input type="hidden" name="uid" value="<?php echo $id; ?>">
        
        <div class="msg-row">
          <div class="msg-label">Recipient</div>
          <div><strong style="color:#0f172a"><?php echo htmlspecialchars($user['username']); ?></strong> (UID <?php echo $id; ?>)</div>
        </div>
        
        <div class="msg-row">
          <div class="msg-label">Subject</div>
          <input class="msg-input" type="text" name="topic" maxlength="35" value="Message From Admin" required>
        </div>
        
        <div class="msg-meta">
          <span><?php echo date('d.m.Y'); ?></span>
          <span><?php echo date('H:i:s'); ?></span>
        </div>
        
        <div class="msg-row" style="align-items:start">
          <div class="msg-label" style="padding-top:8px">Message</div>
          <textarea class="msg-text" name="message" required placeholder="Write your message here..."></textarea>
        </div>
        
        <div class="msg-actions">
          <a href="javascript:history.go(-1)" class="btn-ghost">Cancel</a>
          <button type="submit" name="s1" class="btn-primary">Send Message</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php } else { ?>
<div style="font-family:system-ui;padding:30px;text-align:center;color:#64748b">
  Player not found. <a href="javascript:history.go(-1)" style="color:#2563eb">Go Back</a>
</div>
<?php } ?>