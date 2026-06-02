<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : givePlusRes.tpl                                           ##
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
.resbonus-wrap{max-width:700px;margin:30px auto;font-family:Verdana}
.resbonus-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.resbonus-head svg{width:26px;height:26px}
.resbonus-head h2{margin:0;font-size:18px}
.resbonus-card{background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.06)}
.resbonus-card .top{text-align:center;margin-bottom:18px}
.resbonus-card .icon-big{width:48px;height:48px;margin:0 auto 8px;background:linear-gradient(135deg,#27ae60,#16a085);border-radius:50%;display:flex;align-items:center;justify-content:center}
.resbonus-card .icon-big svg{width:26px;height:26px;fill:#fff}
.resbonus-card h3{margin:0;font-size:16px}
.resbonus-card p{margin:4px 0 0;color:#666;font-size:12px}
.res-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:12px}
@media(max-width:600px){.res-grid{grid-template-columns:1fr}}
.res-item{background:#fafafa;border:1px solid #eee;border-radius:8px;padding:12px;display:flex;align-items:center;justify-content:space-between}
.res-item .left{display:flex;align-items:center;gap:8px;font-weight:bold;font-size:13px}
.res-item img{width:18px;height:18px}
.res-item input{width:70px;padding:6px;text-align:center;border:1px solid #ccc;border-radius:6px;font-size:14px}
.res-item input:focus{outline:none;border-color:#27ae60;box-shadow:0 0 0 2px rgba(39,174,96,.2)}
.resbonus-form button{margin-top:16px;width:100%;background:#27ae60;color:#fff;border:0;padding:11px;border-radius:8px;font-weight:bold;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;gap:6px}
.resbonus-form button:hover{background:#1e8449}
.resbonus-success{margin-top:18px;padding:12px;background:#eaf1;border:1px solid #27ae60;color:#1e8449;border-radius:6px;font-weight:bold;text-align:center}
.wood{color:#8b5a2b} .clay{color:#c0392b} .iron{color:#7f8c8d} .crop{color:#f1c40f}
</style>

<div class="resbonus-wrap">
  <div class="resbonus-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 7h16v10H4z" fill="#27ae60"/><path d="M8 3v4M16 3v4" stroke="#16a085" stroke-width="2"/></svg>
    <h2>Resource Bonus</h2>
  </div>

  <div class="resbonus-card">
    <div class="top">
      <div class="icon-big">
        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <h3>Give Everyone Resource Bonus</h3>
      <p>Activate a 25% bonus for all resources for ALL players.</p>
    </div>

    <form action="../GameEngine/Admin/Mods/givePlusRes.php" method="POST" class="resbonus-form">
      <input type="hidden" name="admid" value="<?php echo $id; ?>">
      
      <div class="res-grid">
        <div class="res-item">
          <div class="left wood"><img src="../img/admin/r/1.gif" alt=""> Wood</div>
          <div><input type="number" name="wood" value="1" min="0" max="365"> days</div>
        </div>
        <div class="res-item">
          <div class="left clay"><img src="../img/admin/r/2.gif" alt=""> Clay</div>
          <div><input type="number" name="clay" value="1" min="0" max="365"> days</div>
        </div>
        <div class="res-item">
          <div class="left iron"><img src="../img/admin/r/3.gif" alt=""> Iron</div>
          <div><input type="number" name="iron" value="1" min="0" max="365"> days</div>
        </div>
        <div class="res-item">
          <div class="left crop"><img src="../img/admin/r/4.gif" alt=""> Crop</div>
          <div><input type="number" name="crop" value="1" min="0" max="365"> days</div>
        </div>
      </div>

      <button type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
        Give Resource Bonus
      </button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="resbonus-success">✓ Resource bonuses have been activated for all players!</div>
  <?php } ?>
</div>