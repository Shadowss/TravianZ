<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : gold.tpl 		                     	                   ##
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
$id = $_SESSION['id'];
?>
<style>
.gold-wrap{max-width:600px;margin:30px auto;font-family:Verdana}
.gold-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.gold-head svg{width:26px;height:26px}
.gold-head h2{margin:0;font-size:18px}
.gold-card{background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.06);text-align:center}
.gold-card .icon-big{width:48px;height:48px;margin:0 auto 10px;background:linear-gradient(135deg,#ffd700,#ffb700);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 4px rgba(0,0,0,.2)}
.gold-card .icon-big svg{width:28px;height:28px;fill:#fff}
.gold-card h3{margin:8px 0 4px;font-size:16px;color:#333}
.gold-card p{margin:0 0 16px;color:#666;font-size:12px}
.gold-form{display:flex;justify-content:center;align-items:center;gap:10px;margin-top:10px}
.gold-form input[type="number"]{width:100px;padding:10px;font-size:18px;text-align:center;border:2px solid #d4af37;border-radius:8px;font-weight:bold;color:#b8860b;background:#fffbea}
.gold-form input[type="number"]:focus{outline:none;border-color:#ffb700;box-shadow:0 0 0 2px rgba(255,183,0,.3)}
.gold-form button{background:#d4af37;color:#fff;border:0;padding:10px 18px;border-radius:8px;font-weight:bold;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:6px}
.gold-form button:hover{background:#b8860b}
.gold-success{margin-top:20px;padding:12px;background:#e8f5e9;border:1px solid #4caf50;color:#2e7d32;border-radius:6px;font-weight:bold;text-align:center}
</style>

<div class="gold-wrap">
  <div class="gold-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" fill="#d4af37"/><path d="M12 7v10M9 10h6M9 14h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
    <h2><?php echo ADM_GOLD_MANAGEMENT; ?></h2>
  </div>

  <div class="gold-card">
    <div class="icon-big">
      <svg viewBox="0 0 24 24"><path d="M12 2L9 8H3l5 4-2 6 6-4 6 4-2-6 5-4h-6z"/></svg>
    </div>
    <h3><?php echo ADM_GIVE_EVERYONE_FREE_GOLD; ?></h3>
    <p><?php echo ADM_THIS_GOLD_WILL_BE_ADDED_TO_ALL_ACTIVE_PLAYER; ?></p>

    <form action="../GameEngine/Admin/Mods/gold.php" method="POST" class="gold-form">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="admid" value="<?php echo $id; ?>">
      <input type="number" name="gold" value="20" min="1" max="9999" required>
      <button type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg><?php echo ADM_GIVE_GOLD; ?></button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="gold-success"><?php echo ADM_GOLD_HAS_BEEN_SUCCESSFULLY_ADDED_TO_ALL_PLAY; ?></div>
  <?php } ?>
</div>