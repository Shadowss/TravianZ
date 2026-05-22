<?php
#################################################################################
## MaintenenceResetPlusBonus.tpl - REDESIGN 2025 ##
#################################################################################
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
?>
<style>
.resetres-wrap{max-width:600px;margin:30px auto;font-family:Verdana}
.resetres-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.resetres-head svg{width:26px;height:26px}
.resetres-head h2{margin:0;font-size:18px}
.resetres-card{background:#fff;border:1px solid #27ae60;border-radius:10px;padding:22px;box-shadow:0 2px 8px rgba(39,174,96,.15);text-align:center}
.resetres-card .warn-icon{width:60px;height:60px;margin:0 auto 12px;background:linear-gradient(135deg,#27ae60,#16a085);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 6px rgba(0,0,0,.2)}
.resetres-card .warn-icon svg{width:32px;height:32px;fill:#fff}
.resetres-card h3{margin:8px 0 6px;font-size:17px;color:#145a32}
.resetres-card p{margin:0 0 18px;color:#555;font-size:13px;line-height:1.4}
.resetres-card .danger-box{background:#eafaf1;border:1px dashed #27ae60;padding:10px;border-radius:6px;font-size:12px;color:#145a32;margin-bottom:16px}
.res-icons{display:flex;justify-content:center;gap:12px;margin-bottom:12px}
.res-icons img{width:24px;height:24px;opacity:.8}
.resetres-form button{background:#27ae60;color:#fff;border:0;padding:12px 24px;border-radius:8px;font-weight:bold;cursor:pointer;font-size:14px;display:inline-flex;align-items:center;gap:8px;transition:.2s}
.resetres-form button:hover{background:#1e8449;transform:translateY(-1px)}
.resetres-success{margin-top:18px;padding:12px;background:#eafaf1;border:1px solid #27ae60;color:#145a32;border-radius:6px;font-weight:bold;text-align:center}
</style>

<div class="resetres-wrap">
  <div class="resetres-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 7h16v10H4z" fill="#27ae60"/><path d="M8 3v4M16 3v4" stroke="#16a085" stroke-width="2"/></svg>
    <h2>Maintenance</h2>
  </div>

  <div class="resetres-card">
    <div class="warn-icon">
      <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
    </div>
    <h3>Reset All Resource Bonuses</h3>
    <p>Această acțiune va dezactiva bonusul de 25% pentru TOATE resursele la toți jucătorii.</p>
    
    <div class="res-icons">
      <img src="../img/admin/r/1.gif" title="Wood">
      <img src="../img/admin/r/2.gif" title="Clay">
      <img src="../img/admin/r/3.gif" title="Iron">
      <img src="../img/admin/r/4.gif" title="Crop">
    </div>

    <div class="danger-box">
      ⚠️ Toate bonusurile de resurse vor fi setate la 0 zile.
    </div>

    <form action="../GameEngine/Admin/Mods/mainteneceResetPlusBonus.php" method="POST" class="resetres-form" onsubmit="return confirm('Ești SIGUR că vrei să resetezi bonusurile de resurse?');">
      <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
      <button type="submit">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
        RESET RESOURCE BONUS
      </button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="resetres-success">✓ Bonusurile de resurse au fost resetate pentru toți jucătorii!</div>
  <?php } ?>
</div>