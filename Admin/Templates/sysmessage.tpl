<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : sysmsg.tpl                                                ##
##  Type           : Admin Panel System Messages                               ##
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

if ($_SESSION['access'] < ADMIN) die("Access Denied");

$id = $_SESSION['id'];

$_SESSION['sys_subject'] = $_SESSION['sys_subject'] ?? '';
$_SESSION['sys_message'] = $_SESSION['sys_message'] ?? '';
$_SESSION['sys_color']   = $_SESSION['sys_color'] ?? 'black';
?>

<style>
.sysmsg-wrap{max-width:700px;margin:30px auto;font-family:Verdana}
.sysmsg-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.sysmsg-head svg{width:26px;height:26px}
.sysmsg-head h2{margin:0;font-size:18px}

.sysmsg-card{background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.06)}

.sysmsg-card .top{display:flex;align-items:center;gap:12px;margin-bottom:16px}
.sysmsg-card .icon{background:linear-gradient(135deg,#8e44ad,#6c3483);width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center}
.sysmsg-card .icon svg{width:24px;height:24px;fill:#fff}

.sysmsg-form{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:14px}
.sysmsg-form .field{display:flex;flex-direction:column;gap:4px}
.sysmsg-form label{font-size:11px;color:#555;font-weight:bold}
.sysmsg-form input,.sysmsg-form textarea{
    padding:9px 10px;border:1px solid #ccc;border-radius:6px;font-size:13px;font-family:Verdana
}
.sysmsg-form input:focus,.sysmsg-form textarea:focus{
    outline:none;border-color:#8e44ad;box-shadow:0 0 0 2px rgba(142,68,173,.2)
}
.sysmsg-form .full{grid-column:1/-1}
.sysmsg-form button{
    grid-column:1/-1;background:#8e44ad;color:#fff;border:0;padding:10px;
    border-radius:6px;font-weight:bold;cursor:pointer;font-size:14px;
    display:flex;align-items:center;justify-content:center;gap:6px
}
.sysmsg-form button:hover{background:#6c3483}

.sysmsg-confirm{
    background:#fff3cd;border:1px solid #ffeaa7;padding:15px;border-radius:8px;margin-bottom:15px
}

.sysmsg-success{
    margin-top:16px;padding:10px;background:#e8f5e9;border:1px solid #2ecc71;
    color:#1e7e34;border-radius:6px;text-align:center;font-weight:bold
}
</style>

<div class="sysmsg-wrap">

  <div class="sysmsg-head">
    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" fill="#8e44ad"/></svg>
    <h2>System Message</h2>
  </div>

  <div class="sysmsg-card">

<?php if(isset($_GET['confirm'])): ?>

    <div class="sysmsg-confirm">
        <b>Confirmare system message</b><br><br>
        <b>Color:</b> <span style="color:<?=htmlspecialchars($_SESSION['sys_color'])?>">
            <?=htmlspecialchars($_SESSION['sys_subject'])?>
        </span>
        <br><br>
        <div><?=nl2br(htmlspecialchars($_SESSION['sys_message']))?></div>
    </div>

    <form action="../GameEngine/Admin/Mods/sysmessage.php" method="POST" class="sysmsg-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?=$id?>">
        <input type="hidden" name="action" value="execute">

        <button type="submit" name="confirm" value="Yes" style="background:#27ae60">✓ Send System Message</button>
        <button type="submit" name="confirm" value="No" style="background:#95a5a6;margin-top:8px">Cancel</button>
    </form>

<?php elseif(isset($_GET['sending'])): ?>

    <div style="text-align:center;padding:30px">
        <div style="font-size:16px;margin-bottom:10px">Sending system message...</div>
    </div>

<?php else: ?>

    <form action="../GameEngine/Admin/Mods/sysmessage.php" method="POST" class="sysmsg-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?=$id?>">
        <input type="hidden" name="action" value="prepare">

        <div class="field">
            <label>Subject</label>
            <input type="text" name="subject" required maxlength="100">
        </div>

        <div class="field">
            <label>Color</label>
            <input type="text" name="color" value="black">
        </div>

        <div class="field full">
            <label>Message</label>
            <textarea name="message" rows="12" required></textarea>
        </div>

        <button type="submit">Continue</button>

    </form>

<?php endif; ?>

<?php if(isset($_GET['done'])): ?>
    <div class="sysmsg-success">✓ System message sent successfully</div>
<?php endif; ?>

  </div>
</div>