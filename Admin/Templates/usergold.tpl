<?php
#################################################################################
## usergold.tpl - REDESIGN 2025 ##
#################################################################################
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
$id = $_SESSION['id'];
?>
<style>
.usergold-wrap{max-width:600px;margin:30px auto;font-family:Verdana}
.usergold-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.usergold-head svg{width:26px;height:26px}
.usergold-head h2{margin:0;font-size:18px}
.usergold-card{background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.06)}
.usergold-card .top{display:flex;align-items:center;gap:12px;margin-bottom16px}
.usergold-card .icon{background:linear-gradient(135deg,#3498db,#2c3e50);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center}
.usergold-card .icon svg{width:24px;height:24px;fill:#fff}
.usergold-card h3{margin:0;font-size:15px}
.usergold-card p{margin:2px 0 0;color:#666;font-size:12px}
.usergold-form{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:14px}
.usergold-form .field{display:flex;flex-direction:column;gap:4px}
.usergold-form label{font-size:11px;color:#555;font-weight:bold}
.usergold-form input{padding:9px 10px;border:1px solid #ccc;border-radius:6px;font-size:14px}
.usergold-form input:focus{outline:none;border-color:#3498db;box-shadow:0 0 0 2px rgba(52,152,219,.2)}
.usergold-form .full{grid-column:1/-1}
.usergold-form button{grid-column:1/-1;background:#3498db;color:#fff;border:0;padding:10px;border-radius:6px;font-weight:bold;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;gap:6px}
.usergold-form button:hover{background:#2980b9}
.usergold-success{margin-top:16px;padding:10px;background:#e8f4fd;border:1px solid #3498db;color:#1a5276;border-radius:6px;text-align:center;font-weight:bold}
</style>

<div class="usergold-wrap">
  <div class="usergold-head">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="8" r="4" fill="#3498db"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6" fill="#2c3e50"/></svg>
    <h2>User Gold</h2>
  </div>

  <div class="usergold-card">
    <div class="top">
      <div class="icon">
        <svg viewBox="0 0 24 24"><path d="M12 2l3 7h7l-5.5 4 2 7-6.5-4.5L5.5 20l2-7L2 9h7z"/></svg>
      </div>
      <div>
        <h3>Give Gold to Specific Player</h3>
        <p>Adaugă gold doar pentru un singur cont (după ID).</p>
      </div>
    </div>

    <form action="../GameEngine/Admin/Mods/gold_1.php" method="POST" class="usergold-form">
      <input type="hidden" name="admid" value="<?php echo $id; ?>">
      
      <div class="field">
        <label>User ID</label>
        <input type="number" name="id" placeholder="ex: 123" required min="1">
      </div>
      
      <div class="field">
        <label>Amount Gold</label>
        <input type="number" name="gold" value="20" min="1" max="999999" required>
      </div>
      
      <button type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
        Give Gold
      </button>
    </form>
  </div>

  <?php if(isset($_GET['g'])){ ?>
    <div class="usergold-success">✓ Gold adăugat cu succes pentru user!</div>
  <?php } ?>
</div>