<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =- ##
## --------------------------------------------------------------------------- ##
## Filename : massmessage.tpl ##
## Type : Admin Panel Frontend ##
## --------------------------------------------------------------------------- ##
## Developed by : Dzoki (Original) ##
## Refactored by : Shadow ##
## Redesign by : Shadow ##
## --------------------------------------------------------------------------- ##
## Project : TravianZ ##
## GitHub : https://github.com/Shadowss/TravianZ ##
#################################################################################
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
$id = $_SESSION['id'];
$_SESSION['mass_subject'] = $_SESSION['mass_subject'] ?? '';
$_SESSION['mass_color']   = $_SESSION['mass_color'] ?? 'black';
?>
<style>
.massmsg-wrap{max-width:700px;margin:30px auto;font-family:Verdana}
.massmsg-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.massmsg-head svg{width:26px;height:26px}
.massmsg-head h2{margin:0;font-size:18px}

.massmsg-card{background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.06)}
.massmsg-card .top{display:flex;align-items:center;gap:12px;margin-bottom:16px}
.massmsg-card .icon{background:linear-gradient(135deg,#e67e22,#d35400);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.massmsg-card .icon svg{width:24px;height:24px;fill:#fff}
.massmsg-card h3{margin:0;font-size:15px}
.massmsg-card p{margin:2px 0 0;color:#666;font-size:12px}

.massmsg-form{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:14px}
.massmsg-form .field{display:flex;flex-direction:column;gap:4px}
.massmsg-form label{font-size:11px;color:#555;font-weight:bold}
.massmsg-form input,.massmsg-form textarea{padding:9px 10px;border:1px solid #ccc;border-radius:6px;font-size:13px;font-family:Verdana}
.massmsg-form input:focus,.massmsg-form textarea:focus{outline:none;border-color:#e67e22;box-shadow:0 0 0 2px rgba(230,126,34,.2)}
.massmsg-form .full{grid-column:1/-1}
.massmsg-form button{grid-column:1/-1;background:#e67e22;color:#fff;border:0;padding:10px;border-radius:6px;font-weight:bold;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;gap:6px}
.massmsg-form button:hover{background:#d35400}

.massmsg-success{margin-top:16px;padding:10px;background:#fef5e7;border:1px solid #e67e22;color:#a04000;border-radius:6px;text-align:center;font-weight:bold}
.massmsg-confirm{background:#fff3cd;border:1px solid #ffeaa7;padding:15px;border-radius:8px;margin-bottom:15px}
</style>

<div class="massmsg-wrap">
  <div class="massmsg-head">
    <svg viewBox="0 0 24 24" fill="none"><path d="M20 4H4c-1.1 0-2.9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="#e67e22"/></svg>
    <h2>Mass Message</h2>
  </div>

  <div class="massmsg-card">
    <div class="top">
      <div class="icon">
        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2.9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      </div>
      <div>
        <h3>Send Message to All Players</h3>
        <p>In-game message for all users (ID > 5)</p>
      </div>
    </div>

<?php if(isset($_GET['confirm'])):?>
    <div class="massmsg-confirm">
      <b>Confirm:</b> Are you sure you want to send?<br>
      <b>Subject:</b> <span style="color:<?=$_SESSION['mass_color']?>"><?=htmlspecialchars($_SESSION['mass_subject'])?></span>
    </div>
    <form action="../GameEngine/Admin/Mods/massmessage.php" method="POST" class="massmsg-form">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="admid" value="<?=$id?>">
      <input type="hidden" name="action" value="execute">
      <button type="submit" name="confirm" value="Yes" style="background:#27ae60">✓ Yes, Send</button>
      <button type="submit" name="confirm" value="No" style="background:#95a5a6;margin-top:8px">Cancel</button>
    </form>

<?php elseif(isset($_GET['sending'])):?>
    <div style="text-align:center;padding:30px">
      <div style="font-size:16px;margin-bottom:10px">Sending messages...</div>
      <div style="color:#666"><?=$_GET['msg']?? ''?></div>
    </div>

<?php else:?>
    <form action="../GameEngine/Admin/Mods/massmessage.php" method="POST" class="massmsg-form">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="admid" value="<?=$id?>">
      <input type="hidden" name="action" value="prepare">

      <div class="field">
        <label>Subject</label>
        <input type="text" name="subject" placeholder="ex: Maintenance" required maxlength="100">
      </div>

      <div class="field">
        <label>Message Color</label>
        <input type="text" name="color" value="black" placeholder="black sau #e67e22">
      </div>

      <div class="field full">
        <label>Message Content</label>
        <textarea name="message" rows="12" placeholder="Write the message... you can use [url][img]" required></textarea>
      </div>

      <button type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M2 21l21-9L2 3v7l15 2-15 2v7z" fill="#fff"/></svg>
        Continua
      </button>
    </form>
<?php endif;?>
  </div>

  <?php if(isset($_GET['done'])){?>
    <div class="massmsg-success">✓ Mass message successfully sent to all players!</div>
  <?php }?>
</div>