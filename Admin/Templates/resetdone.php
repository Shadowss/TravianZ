<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : resetdone.tpl                                             ##
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
unset($_SESSION['admin_username'], $_SESSION['sessid']);

// Set this to match the password you set in resetServer.php
$mh_password = '123456';
?>
<style>
.reset-wrap{max-width:720px;margin:20px auto;font-family:Tahoma,Verdana,Arial,sans-serif;padding:0 10px;box-sizing:border-box}
.reset-card{background:#fff;border:1px solid #bbb;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.08)}
.reset-head{background:#27ae60;color:#fff;padding:12px 16px;display:flex;align-items:center;gap:8px}
.reset-head h2{margin:0;font-size:16px;font-weight:bold}
.reset-body{padding:24px 20px 18px;text-align:center;color:#333;font-size:13px;line-height:1.6}
.reset-success{background:#f0fff4;border:1px solid #27ae60;border-left:4px solid #1e8449;padding:14px;margin:0 auto 16px;max-width:520px;border-radius:4px;color:#1e8449;text-align:left}
.reset-success strong{display:block;margin-bottom:4px;font-size:13px}
.reset-info{background:#f7f7f7;border:1px solid #ddd;border-radius:6px;display:inline-block;padding:12px 20px;margin:15px 0}
.reset-info code{font-size:18px;font-weight:bold;color:#c0392b;letter-spacing:1px}
.reset-foot{display:flex;justify-content:center;align-items:center;padding:14px 16px;background:#f8f9fa;border-top:1px solid #ddd;gap:10px}
.btn{padding:7px 16px;border-radius:4px;font-size:12px;font-weight:bold;cursor:pointer;border:1px solid transparent;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all 0.15s}
.btn-login{background:#27ae60;color:#fff;border-color:#1e8449}
.btn-login:hover{background:#219150}
.btn-back{background:#ecf0f1;color:#2c3e50;border-color:#bdc3c7}
.btn-back:hover{background:#d5dbdb}
@media (max-width:600px){
  .reset-foot{flex-direction:column}
  .btn{width:100%;justify-content:center}
}
</style>

<div class="reset-wrap">
  <div class="reset-card">
    <div class="reset-head">
      <h2>✓ Server Reset Complete</h2>
    </div>
    
    <div class="reset-body">
      <div class="reset-success">
        <strong>SUCCESS!</strong>
        The server has been reset and is ready for a new round.
      </div>
      
      <p>All game data has been deleted: players, villages, alliances, reports, and messages.<br>
      Admin sessions have been terminated automatically.</p>

      <div class="reset-info">
        <span style="color:#333;">Multihunter account password:</span><br>
        <code><?php echo htmlspecialchars($mh_password); ?></code>
      </div>

      <p style="color:#a93226;font-size:12px;margin-top:10px;">
        IMPORTANT: Change this password immediately after your first login!
      </p>
    </div>
    
    <div class="reset-foot">
      <a href="../login.php" class="btn btn-login">Go to Login »</a>
      <a href="admin.php" class="btn btn-back">« Back to Admin</a>
    </div>
  </div>
</div>