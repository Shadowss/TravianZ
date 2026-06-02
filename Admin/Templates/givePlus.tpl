<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : givePlus.tpl 		                                       ##
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
.plus-wrap{max-width:600px;margin:30px auto;font-family:Verdana}
.plus-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.plus-head svg{width:26px;height:26px}
.plus-head h2{margin:0;font-size:18px}
.plus-card{background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.06);text-align:center}
.plus-card .icon-big{width:48px;height:48px;margin:0 auto 10px;background:linear-gradient(135deg,#8e44ad,#6c3483);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 4px rgba(0,0,0,.2)}
.plus-card .icon-big svg{width:28px;height:28px;fill:#fff}
.plus-card h3{margin:8px 0 4px;font-size:16px;color:#333}
.plus-card p{margin:0 0 16px;color:#666;font-size:12px}
.plus-form{display:flex;justify-content:center;align-items:center;gap:10px;margin-top:10px;flex-wrap:wrap}
.plus-form input[type="number"]{width:90px;padding:10px;font-size:18px;text-align:center;border:2px solid #8e44ad;border-radius:8px;font-weight:bold;color:#5b2c6f;background:#f5eef8}
.plus-form input[type="number"]:focus{outline:none;border-color:#6c3483;box-shadow:0 0 0 2px rgba(142,68,173,.3)}
.plus-form span{font-size:13px;color:#555;font-weight:bold}
.plus-form button{background:#8e44ad;color:#fff;border:0;padding:10px 18px;border-radius:8px;font-weight:bold;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:6px}
.plus-form button:hover{background:#6c3483}
.plus-success{margin-top:20px;padding:12px;background:#f5eef8;border:1px solid #8e44ad;color:#5b2c6f;border-radius:6px;font-weight:bold;text-align:center}
</style>

<div class="plus-wrap">
  <div class="plus-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l4 4-4 4-4-4 4-4zm0 8l4 4-4-4 4-4zm-8 4l4 4-4 4-4-4 4-4zm16 0l4 4-4 4-4-4 4-4z" fill="#8e44ad"/></svg>
    <h2>Plus Management</h2>
  </div>

  <div class="plus-card">
    <div class="icon-big">
      <svg viewBox="0 0 24 24"><path d="M12 4v16M4 12h16" stroke="white" stroke-width="3" stroke-linecap="round"/></svg>
    </div>
    <h3>Give Everyone Free Plus</h3>
    <p>Activate Travian Plus for ALL players on the server.</p>

    <form action="../GameEngine/Admin/Mods/givePlus.php" method="POST" class="plus-form">
      <input type="hidden" name="admid" value="<?php echo $id; ?>">
      <input type="number" name="plus" value="1" min="1" max="365" required>
      <span>Days</span>
      <button type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
        Give Plus
      </button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="plus-success">✓ Plus has been successfully activated for all players!</div>
  <?php } ?>
</div>