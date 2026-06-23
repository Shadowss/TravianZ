<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : maintenenceResetPlus.tpl 		                           ##
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

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
?>
<style>
.resetplus-wrap{max-width:600px;margin:30px auto;font-family:Verdana}
.resetplus-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.resetplus-head svg{width:26px;height:26px}
.resetplus-head h2{margin:0;font-size:18px}
.resetplus-card{background:#fff;border:1px solid #8e44ad;border-radius:10px;padding:22px;box-shadow:0 2px 8px rgba(142,68,173,.15);text-align:center}
.resetplus-card .warn-icon{width:60px;height:60px;margin:0 auto 12px;background:linear-gradient(135deg,#8e44ad,#6c3483);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 6px rgba(0,0,0,.2)}
.resetplus-card .warn-icon svg{width:32px;height:32px;fill:#fff}
.resetplus-card h3{margin:8px 0 6px;font-size:17px;color:#5b2c6f}
.resetplus-card p{margin:0 0 18px;color:#555;font-size:13px;line-height:1.4}
.resetplus-card .danger-box{background:#f5eef8;border:1px dashed #8e44ad;padding:10px;border-radius:6px;font-size:12px;color:#5b2c6f;margin-bottom:16px}
.resetplus-form button{background:#8e44ad;color:#fff;border:0;padding:12px 24px;border-radius:8px;font-weight:bold;cursor:pointer;font-size:14px;display:inline-flex;align-items:center;gap:8px;transition:.2s}
.resetplus-form button:hover{background:#6c3483;transform:translateY(-1px)}
.resetplus-success{margin-top:18px;padding:12px;background:#f5eef8;border:1px solid #8e44ad;color:#5b2c6f;border-radius:6px;font-weight:bold;text-align:center}
</style>

<div class="resetplus-wrap">
  <div class="resetplus-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2v10l4-4" stroke="#8e44ad" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="17" r="5" fill="#6c3483"/></svg>
    <h2>Reset All Players Plus</h2>
  </div>

  <div class="resetplus-card">
    <div class="warn-icon">
      <svg viewBox="0 0 24 24"><path d="M12 4v16M4 12h16" stroke="white" stroke-width="3" stroke-linecap="round"/></svg>
    </div>
    <h3>Reset All Players Plus</h3>
    <p>This action will disable Travian Plus for ALL players.</p>
    
    <div class="danger-box">
      ⚠️ Plus it will be set to 0 days for everyone.
    </div>

    <form action="../GameEngine/Admin/Mods/mainteneceResetPlus.php" method="POST" class="resetplus-form" onsubmit="return confirm('Are you SURE you want to reset the Plus to ALL players?');">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
      <button type="submit">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
        RESET PLUS NOW
      </button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="resetplus-success">✓ Plus all the players have been reset!</div>
  <?php } ?>
</div>