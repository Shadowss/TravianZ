<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : massmessage.tpl                                           ##
##  Type           : Admin Panel Mass Messages                                 ##
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
.massmsg-confirm{background:#fff3cd;border:1px solid #ffeaa7;padding:12px;border-radius:8px;margin-bottom:12px;color:#6b5900}
/* Previzualizare: fundal alb si text inchis, ca mesajul sa fie lizibil
   indiferent ce culoare a fost aleasa pentru titlu. */
.massmsg-preview{border:1px solid #ddd;border-radius:8px;overflow:hidden;margin-bottom:15px;background:#fff}
.massmsg-preview-head{background:#f4f4f6;border-bottom:1px solid #e2e2e6;padding:7px 12px;
    font-size:11px;font-weight:bold;color:#666;text-transform:uppercase;letter-spacing:.5px}
.massmsg-preview-body{padding:16px 18px}
.massmsg-preview-text{color:#2b2b2b;font-size:13px;line-height:1.55;word-wrap:break-word}
.massmsg-preview-text a{color:#2980b9}
/* bara de formatare */
.bbbar{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:6px}
.bbbar button{background:#f2f2f4;border:1px solid #d8d8dc;color:#333;border-radius:5px;
    padding:4px 10px;font-size:12px;cursor:pointer;line-height:1.2}
.bbbar button:hover{background:#e6e6ea}
</style>

<div class="massmsg-wrap">
  <div class="massmsg-head">
    <svg viewBox="0 0 24 24" fill="none"><path d="M20 4H4c-1.1 0-2.9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="#e67e22"/></svg>
    <h2><?php echo ADMIN_MASS_MESSAGE; ?></h2>
  </div>

  <div class="massmsg-card">
    <div class="top">
      <div class="icon">
        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2.9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      </div>
      <div>
        <h3><?php echo ADM_SEND_MESSAGE_TO_ALL_PLAYERS; ?></h3>
        <p>In-game message for all users (ID > 5)</p>
      </div>
    </div>

<?php if(isset($_GET['confirm'])):?>
    <div class="massmsg-confirm">
      <b><?php echo ADM_CONFIRM; ?></b><?php echo ADM_ARE_YOU_SURE_YOU_WANT_TO_SEND; ?>
    </div>

    <?php
        /**
         * Previzualizare REALA a mesajului.
         *
         * Inainte se vedea doar subiectul, pe fundalul galben de avertizare -
         * iar daca alegeai o culoare deschisa, devenea invizibil. Corpul
         * mesajului nu se afisa deloc.
         *
         * Randam aceleasi coduri ca la trimitere: [b] [i] [u] din BBCode.php,
         * plus [url] si [img], care sunt convertite de massmessage.php.
         */
        $mmText = htmlspecialchars($_SESSION['mass_message'] ?? '', ENT_QUOTES, 'UTF-8');

        $mmText = str_replace(
            array('[b]','[/b]','[i]','[/i]','[u]','[/u]'),
            array('<b>','</b>','<i>','</i>','<u>','</u>'),
            $mmText
        );

        // Doar adrese http(s), ca in massmessage.php. Textul e deja escapat,
        // deci ghilimelele nu pot iesi din atribut.
        $mmText = preg_replace_callback('/\[img\](.*?)\[\/img\]/is', function ($m) {
            $u = trim($m[1]);
            return preg_match('#^https?://#i', $u)
                ? '<img src="' . $u . '" alt="" style="max-width:100%">'
                : $u;
        }, $mmText);

        $mmText = preg_replace_callback('/\[url\](.*?)\[\/url\]/is', function ($m) {
            $u = trim($m[1]);
            return preg_match('#^https?://#i', $u)
                ? '<a href="' . $u . '" target="_blank" rel="noopener">' . $u . '</a>'
                : $u;
        }, $mmText);

        $mmColor = preg_match('/^(#[0-9a-fA-F]{3,6}|[a-zA-Z]{3,20})$/', (string) ($_SESSION['mass_color'] ?? ''))
            ? $_SESSION['mass_color'] : '#333333';
    ?>

    <div class="massmsg-preview">
        <div class="massmsg-preview-head"><?php echo ADM_PREVIEW ?? 'Preview'; ?></div>
        <div class="massmsg-preview-body">
            <h2 style="color:<?=htmlspecialchars($mmColor)?>;margin:0 0 10px 0;font-size:16px">
                <?=htmlspecialchars($_SESSION['mass_subject'], ENT_QUOTES, 'UTF-8')?>
            </h2>
            <div class="massmsg-preview-text"><?=nl2br($mmText)?></div>
        </div>
    </div>
    <form action="../GameEngine/Admin/Mods/massmessage.php" method="POST" class="massmsg-form">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="admid" value="<?=$id?>">
      <input type="hidden" name="action" value="execute">
      <button type="submit" name="confirm" value="Yes" style="background:#27ae60"><?php echo ADM_YES_SEND; ?></button>
      <button type="submit" name="confirm" value="No" style="background:#95a5a6;margin-top:8px"><?php echo ADM_CANCEL; ?></button>
    </form>

<?php elseif(isset($_GET['sending'])):?>
    <div style="text-align:center;padding:30px">
      <div style="font-size:16px;margin-bottom:10px"><?php echo ADM_SENDING_MESSAGES; ?></div>
      <div style="color:#666"><?=e($_GET['msg'] ?? '')?></div>
    </div>

<?php else:?>
    <form action="../GameEngine/Admin/Mods/massmessage.php" method="POST" class="massmsg-form">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="admid" value="<?=$id?>">
      <input type="hidden" name="action" value="prepare">

      <div class="field">
        <label><?php echo ADM_SUBJECT_2; ?></label>
        <input type="text" name="subject" placeholder="<?php echo ADM_EX_MAINTENANCE; ?>" required maxlength="100">
      </div>

      <div class="field">
        <label><?php echo ADM_MESSAGE_COLOR; ?></label>
        <input type="text" name="color" value="black" placeholder="<?php echo ADM_BLACK_SAU_E67E22; ?>">
      </div>

      <div class="field full">
        <label><?php echo ADM_MESSAGE_CONTENT; ?></label>
        <div class="bbbar">
            <button type="button" onclick="bbWrap('[b]','[/b]')"><b>B</b></button>
            <button type="button" onclick="bbWrap('[i]','[/i]')"><i>I</i></button>
            <button type="button" onclick="bbWrap('[u]','[/u]')"><u>U</u></button>
            <button type="button" onclick="bbWrap('[url]','[/url]')">URL</button>
            <button type="button" onclick="bbWrap('[img]','[/img]')">IMG</button>
        </div>
        <textarea name="message" id="massmsg_text" rows="12" placeholder="<?php echo ADM_WRITE_THE_MESSAGE_YOU_CAN_USE_URL_IMG; ?>" required></textarea>

<script>
/**
 * Insereaza coduri BBCode in jurul selectiei.
 * Fara selectie, le pune la cursor si lasa cursorul intre ele.
 *
 * Codurile disponibile sunt cele pe care le randeaza jocul: [b] [i] [u] din
 * BBCode.php, plus [url] si [img], convertite de massmessage.php la trimitere.
 * Culoarea NU apare aici - la mesajele catre jucatori ea se aplica doar
 * titlului, prin campul separat de mai sus.
 */
function bbWrap(open, close) {
    var t = document.getElementById('massmsg_text');
    if (!t) { return; }

    var a = t.selectionStart, b = t.selectionEnd;
    var sel = t.value.substring(a, b);

    t.value = t.value.substring(0, a) + open + sel + close + t.value.substring(b);

    var pos = a + open.length + sel.length;
    t.focus();
    t.setSelectionRange(pos, pos);
}
</script>
      </div>

      <button type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M2 21l21-9L2 3v7l15 2-15 2v7z" fill="#fff"/></svg><?php echo ADM_CONTINUA; ?></button>
    </form>
<?php endif;?>
  </div>

  <?php if(isset($_GET['done'])){?>
    <div class="massmsg-success"><?php echo ADM_MASS_MESSAGE_SUCCESSFULLY_SENT_TO_ALL_PLAYER; ?></div>
  <?php }?>
</div>