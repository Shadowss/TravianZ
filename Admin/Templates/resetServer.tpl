<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : resetServer.tpl 			                               ##
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
?>
<style>
.reset-wrap{max-width:720px;margin:20px auto;font-family:Tahoma,Verdana,Arial,sans-serif;padding:0 10px;box-sizing:border-box}
.reset-card{background:#fff;border:1px solid #bbb;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.08)}
.reset-head{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:12px 16px;display:flex;align-items:center;gap:8px}
.reset-head h2{margin:0;font-size:16px;font-weight:bold}
.reset-body{padding:24px 20px 10px;text-align:center;color:#333;font-size:13px;line-height:1.6}
.reset-warning{background:#fff5f5;border:1px solid #e74c3c;border-left:4px solid #c0392b;padding:14px;margin:0 auto 16px;max-width:520px;border-radius:4px;color:#a93226;text-align:left}
.reset-warning strong{display:block;margin-bottom:4px;font-size:13px}
.reset-option{padding:0 20px 18px;text-align:left;background:#fff} /* DOAR ASTA E NOU */
.reset-option label{font-size:12px;color:#333;cursor:pointer}
.reset-option input{margin-right:6px;vertical-align:-1px}
.reset-foot{display:flex;justify-content:space-between;align-items:center;padding:14px 16px;background:#f8f9fa;border-top:1px solid #ddd;gap:10px}
.btn{padding:7px 16px;border-radius:4px;font-size:12px;font-weight:bold;cursor:pointer;border:1px solid transparent;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all 0.15s}
.btn-back{background:#ecf0f1;color:#2c3e50;border-color:#bdc3c7}
.btn-back:hover{background:#d5dbdb}
.btn-reset{background:#c0392b;color:#fff;border-color:#a93226}
.btn-reset:hover{background:#a93226}
.btn:disabled{opacity:0.6;cursor:not-allowed}
.reset-loader{display:none;padding:30px 20px;text-align:center}
.reset-loader .spinner{width:28px;height:28px;border:3px solid #f3f3f3;border-top:3px solid #c0392b;border-radius:50%;animation:spin 1s linear infinite;margin:0 auto 12px}
@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
@media (max-width:600px){
  .reset-foot{flex-direction:column-reverse}
  .btn{width:100%;justify-content:center}
}
</style>

<form action="Templates/resetServer.php" method="post" id="resetForm">
<div class="reset-wrap">
  <div class="reset-card">
    <div class="reset-head">
      <h2>⚠️ Server Resetting</h2>
    </div>
    
    <div class="reset-body" id="txtreset">
      <div class="reset-warning">
        <strong>WARNING! Irreversible action</strong>
        This operation will delete ALL data: players, watches, allies, reports. The server will be reset for a new game.
      </div>
      <p>This server will be reset to create new game server.<br>Click button <b>Reset</b> to proceed.</p>
    </div>
<!-- BIFA MUTATA AICI, IN AFARA reset-body -->
    <div class="reset-option">
       <label>
        <input type="checkbox" name="keep_admin" value="1" checked>
Keep Admin accout (<?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>) after reset
      </label>
    </div>
</br></br>
    <div class="reset-loader" id="resetLoader">
      <div class="spinner"></div>
      <div>Please wait... while the server is being reset</div>
    </div>
    
    <div class="reset-foot" id="hideobj">
      <button type="button" class="btn btn-back" onclick="go_url('../Admin/admin.php')">« Back</button>
      <button type="button" class="btn btn-reset" onclick="go_proceed()">Reset Server</button>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
function go_proceed() {
    if(!confirm('ARE YOU SURE? All data will be deleted permanently!')) return;
    
    document.getElementById("txtreset").style.display = 'none';
    document.querySelector('.reset-option').style.display = 'none';
    document.getElementById("hideobj").style.display = 'none';
    document.getElementById("resetLoader").style.display = 'block';
    
    setTimeout(function(){
        document.getElementById('resetForm').submit();
    }, 800);
}
</script>