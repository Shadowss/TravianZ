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

/* CREDIT SHADOW - ELEGANT */
.credits{margin-top:22px;text-align:center;font-size:11px;color:#64748b;letter-spacing:.4px;opacity:.9}
.credits .shadow{color:#38bdf8;font-weight:700;text-shadow:0 0 12px rgba(56,189,248,.45)}
.credits a{color:#7dd3fc;text-decoration:none;border-bottom:1px solid rgba(125,211,252,.25);padding-bottom:1px;transition:all .2s}
.credits a:hover{color:#fff;border-bottom-color:#38bdf8;text-shadow:0 0 10px rgba(56,189,248,.7)}
</style>

<div class="login-page">
  <div class="login-container">
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
      <div class="tribe-icon" title="Romans">⚔️</div>
      <div class="tribe-icon" title="Teutons">🪓</div>
      <div class="tribe-icon" title="Gauls">🛡️</div>
    </div>

    <div class="credits">
      Admin Panel Redesigned & Refactored by <span class="shadow">Shadow</span> – <a href="https://github.com/Shadowss/TravianZ" target="_blank" rel="noopener">TravianZ Copyright</a>
    </div>
  </div>
</div>