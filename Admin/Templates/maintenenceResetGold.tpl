<?php
#################################################################################
## MaintenenceResetGold.tpl - REDESIGN 2025 ##
#################################################################################
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
?>
<style>
.resetgold-wrap{max-width:600px;margin:30px auto;font-family:Verdana}
.resetgold-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.resetgold-head svg{width:26px;height:26px}
.resetgold-head h2{margin:0;font-size:18px}
.resetgold-card{background:#fff;border:1px solid #e74c3c;border-radius:10px;padding:22px;box-shadow:0 2px 8px rgba(231,76,60,.15);text-align:center}
.resetgold-card .warn-icon{width:60px;height:60px;margin:0 auto 12px;background:linear-gradient(135deg,#e74c3c,#c0392b);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 6px rgba(0,0,0,.2)}
.resetgold-card .warn-icon svg{width:32px;height:32px;fill:#fff}
.resetgold-card h3{margin:8px 0 6px;font-size:17px;color:#c0392b}
.resetgold-card p{margin:0 0 18px;color:#555;font-size:13px;line-height:1.4}
.resetgold-card .danger-box{background:#ffeaea;border:1px dashed #e74c3c;padding:10px;border-radius:6px;font-size:12px;color:#a93226;margin-bottom:16px}
.resetgold-form button{background:#e74c3c;color:#fff;border:0;padding:12px 24px;border-radius:8px;font-weight:bold;cursor:pointer;font-size:14px;display:inline-flex;align-items:center;gap:8px;transition:.2s}
.resetgold-form button:hover{background:#c0392b;transform:translateY(-1px)}
.resetgold-success{margin-top:18px;padding:12px;background:#ffeaea;border:1px solid #e74c3c;color:#c0392b;border-radius:6px;font-weight:bold;text-align:center}
</style>

<div class="resetgold-wrap">
  <div class="resetgold-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2v10l4-4" stroke="#e74c3c" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="17" r="5" fill="#c0392b"/></svg>
    <h2>Maintenance</h2>
  </div>

  <div class="resetgold-card">
    <div class="warn-icon">
      <svg viewBox="0 0 24 24"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
    </div>
    <h3>Reset All Players Gold</h3>
    <p>Această acțiune va seta gold-ul la <b>0</b> pentru TOȚI jucătorii de pe server.</p>
    
    <div class="danger-box">
      ⚠️ ATENȚIE: Acțiunea este ireversibilă! Asigură-te că ai backup înainte.
    </div>

    <form action="../GameEngine/Admin/Mods/mainteneceResetGold.php" method="POST" class="resetgold-form" onsubmit="return confirm('Ești SIGUR că vrei să resetezi gold-ul la TOȚI jucătorii?');">
      <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
      <button type="submit">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
        RESET GOLD NOW
      </button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="resetgold-success">✓ Gold-ul tuturor jucătorilor a fost resetat!</div>
  <?php } ?>
</div>