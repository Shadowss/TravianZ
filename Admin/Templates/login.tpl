<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : login.tpl 		                                           ##
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
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Cinzel:wght@600&display=swap');
*{box-sizing:border-box}
body{margin:0;background:#0a0f1c;font-family:'Inter',sans-serif;color:#e2e8f0}
/* ASCUNDE ELEMENTELE VECHI */
body > img[src*="Travian"], img[src*="admin.gif"]{display:none !important}

.login-page{min-height:100vh;display:flex;align-items:flex-start;justify-content:center;padding:60px 20px 20px;position:relative;background:#0a0f1c}
.login-page::before{content:"";position:absolute;inset:0;background:url('https://i.imgur.com/8Km9tLL.jpg') center/cover no-repeat;opacity:.25;filter:brightness(.6);z-index:0}
.login-page::before{display:none}

.login-container{position:relative;z-index:2;width:100%;max-width:420px;margin-top:0}
.login-header{text-align:center;margin-bottom:24px}
.travian-logo{font-family:'Cinzel',serif;font-size:38px;font-weight:600;color:#fff;letter-spacing:2px;text-shadow:0 0 20px rgba(14,165,233,.6);margin-bottom:8px}
.travian-logo span{color:#0ea5e9}
.admin-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(14,165,233,.15);border:1px solid rgba(14,165,233,.3);padding:4px 12px;border-radius:20px;font-size:11px;color:#7dd3fc;text-transform:uppercase;letter-spacing:1px}

.login-card{background:rgba(15,23,42,.9);backdrop-filter:blur(20px);border:1px solid rgba(148,163,184,.15);border-radius:20px;padding:32px;box-shadow:0 25px 50px rgba(0,0,0,.7)}
.login-title{text-align:center;margin-bottom:28px}
.login-title h2{margin:0;font-size:20px;font-weight:600;color:#fff}
.login-title p{margin:6px 0 0;font-size:13px;color:#94a3b8}

.form-group{margin-bottom:18px}
.form-group label{display:block;font-size:12px;color:#cbd5e1;margin-bottom:6px;font-weight:500}
.form-input{width:100%;padding:12px 14px;background:#1e293b;border:1px solid #334155;border-radius:10px;color:#f1f5f9;font-size:14px;transition:all .2s}
.form-input:focus{outline:none;border-color:#0ea5e9;background:#0f172a;box-shadow:0 0 0 3px rgba(14,165,233,.15)}
.form-input::placeholder{color:#64748b}

.login-btn{width:100%;padding:13px;background:linear-gradient(135deg,#0ea5e9 0%,#0284c7 100%);border:none;border-radius:10px;color:#fff;font-weight:600;font-size:14px;cursor:pointer;transition:all .2s;margin-top:8px;box-shadow:0 4px 14px rgba(2,132,199,.35)}
.login-btn:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(2,132,199,.45)}
.login-btn:active{transform:translateY(0)}

.login-footer{margin-top:28px;padding-top:20px;border-top:1px solid rgba(148,163,184,.1);text-align:center;font-size:11px;color:#64748b}
.login-footer a{color:#38bdf8;text-decoration:none}

.tribes{display:flex;justify-content:center;gap:24px;margin-top:24px;opacity:.6}
.tribe-icon{width:36px;height:36px;border-radius:50%;background:rgba(30,41,59,.8);display:flex;align-items:center;justify-content:center;font-size:18px;border:1px solid rgba(148,163,184,.2)}

/* === FOOTER SHADOW - pentru login === */
.credits{
  margin-top:24px !important;
  text-align:center !important;
  background:rgba(15,23,42,.85) !important;
  backdrop-filter:blur(16px) !important;
  border:1px solid rgba(239,68,68,.35) !important;
  border-radius:14px !important;
  padding:16px !important;
  box-shadow:0 10px 30px rgba(0,0,0,.5), 0 0 20px rgba(239,68,68,.15) !important;
}
.credits .shadow-main{
  font-size:15px !important;
  font-weight:800 !important;
  color:#fff !important;
  letter-spacing:.3px !important;
  margin-bottom:4px !important;
}
.credits .shadow-main span{
  color:#ef4444 !important;
  font-size:18px !important;
  font-weight:900 !important;
  text-shadow:0 0 10px rgba(239,68,68,.7) !important;
}
.credits .shadow-sub{
  font-size:11px !important;
  color:#cbd5e1 !important;
  margin-bottom:6px !important;
}
.credits .shadow-old{
  font-size:10px !important;
  color:#64748b !important;
  border-top:1px solid rgba(148,163,184,.12) !important;
  padding-top:6px !important;
  margin-top:6px !important;
}

/* === NOU: EROARE LOGIN === */
.login-error{
  background:rgba(220,38,38,.12);
  border:1px solid rgba(220,38,38,.35);
  border-left:3px solid #ef4444;
  color:#fecaca;
  padding:12px 16px;
  border-radius:12px;
  margin-bottom:18px;
  font-size:13px;
  display:flex;
  align-items:center;
  gap:10px;
  backdrop-filter:blur(12px);
  animation:tzShake .4s ease;
  box-shadow:0 8px 20px rgba(0,0,0,.4);
}
.login-error::before{content:"⚠️";font-size:16px;filter:drop-shadow(0 0 6px rgba(239,68,68,.5))}
.login-error strong{color:#fff;font-weight:600}
@keyframes tzShake{0%,100%{transform:translateX(0)}20%,60%{transform:translateX(-3px)}40%,80%{transform:translateX(3px)}}
</style>

<div class="login-page">
  <div class="login-container">
    
    <!-- BANNER EROARE - apare deasupra logo-ului -->
    <div id="tz-error-holder"></div>

    <div class="login-header">
      <div class="travian-logo">TRA<span>VIAN</span>Z</div>
      <div class="admin-badge">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10z"/></svg>
        Admin Control
      </div>
    </div>

    <div class="login-card">
      <div class="login-title">
        <h2>Server Administration</h2>
        <p>Secure access to TravianZ panel</p>
      </div>

      <form method="post" action="admin.php">
        <input type="hidden" name="action" value="login">
        
        <div class="form-group">
          <label>Username</label>
          <input class="form-input" type="text" name="name" value="<?php echo (isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : '')?>" maxlength="20" placeholder="Enter admin username" autocomplete="username" required>
        </div>
        
        <div class="form-group">
          <label>Password</label>
          <input class="form-input" type="password" name="pw" value="" maxlength="20" placeholder="••••••••" autocomplete="current-password" required>
        </div>
        
        <button type="submit" class="login-btn">Access Panel</button>
      </form>

      <div class="login-footer">
        © 2010-2026 TravianZ Project • v5.0
      </div>
    </div>

    <div class="tribes">
      <div class="tribe-icon" title="Romans">⚔</div>
      <div class="tribe-icon" title="Teutons">🪓</div>
      <div class="tribe-icon" title="Gauls">🛡</div>
    </div>

	<div class="credits">
		<div class="shadow-main">⚡ ADMIN PANEL 100% REBUILT BY Shadow</div>
		<div class="shadow-sub">Dashboard v5.0 • TravianZ 2025 • Full code, design & optimization</div>
		<div class="shadow-old">Based on: Akakori & Elmar | Fixed by: Dzoki | Reworked by: aggenkeech</div>
	</div>
  </div>
</div>

<script>
// Prinde "Error" printat de admin.php și îl mută în bannerul frumos
(function(){
  const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
  let found = false;
  while(walker.nextNode()){
    const n = walker.currentNode;
    if(n.nodeValue && n.nodeValue.trim() === 'Error'){
      n.nodeValue = '';
      found = true;
      break;
    }
  }
  if(found || document.body.innerText.includes('Error')){
    const holder = document.getElementById('tz-error-holder');
    if(holder){
      holder.innerHTML = '<div class="login-error"><div><strong>Login failed</strong> – Invalid username or password</div></div>';
    }
  }
})();
</script>