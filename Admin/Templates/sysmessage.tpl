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
/* Previzualizare: fundal alb si text inchis, ca mesajul sa fie lizibil
   indiferent ce culoare a ales adminul pentru titlu. */
.sysmsg-preview{border:1px solid #ddd;border-radius:8px;overflow:hidden;margin-bottom:15px;background:#fff}
.sysmsg-preview-head{background:#f4f4f6;border-bottom:1px solid #e2e2e6;padding:7px 12px;
    font-size:11px;font-weight:bold;color:#666;text-transform:uppercase;letter-spacing:.5px}
.sysmsg-preview-body{padding:16px 18px}
.sysmsg-preview-text{color:#2b2b2b;font-size:13px;line-height:1.55;word-wrap:break-word}
/* bara de formatare */
.bbbar{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:6px}
.bbbar button{background:#f2f2f4;border:1px solid #d8d8dc;color:#333;border-radius:5px;
    padding:4px 10px;font-size:12px;cursor:pointer;line-height:1.2}
.bbbar button:hover{background:#e6e6ea}
.bbbar .sw{width:22px;height:22px;padding:0;border-radius:50%;border:1px solid rgba(0,0,0,.25)}
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
    background:#fff3cd;border:1px solid #ffeaa7;padding:12px;border-radius:8px;margin-bottom:12px;color:#6b5900
}

.sysmsg-success{
    margin-top:16px;padding:10px;background:#e8f5e9;border:1px solid #2ecc71;
    color:#1e7e34;border-radius:6px;text-align:center;font-weight:bold
}
</style>

<div class="sysmsg-wrap">

  <div class="sysmsg-head">
    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" fill="#8e44ad"/></svg>
    <h2><?php echo ADMIN_SYSTEM_MESSAGE; ?></h2>
  </div>

  <div class="sysmsg-card">

<?php if(isset($_GET['confirm'])): ?>

    <div class="sysmsg-confirm">
        <b><?php echo ADM_CONFIRMARE_SYSTEM_MESSAGE; ?></b>
    </div>

    <?php
        /**
         * Previzualizare REALA a mesajului.
         *
         * Inainte, textul se afisa cu htmlspecialchars pe fundal galben: BBCode-ul
         * aparea brut ([b]...[/b]), iar un subiect intr-o culoare deschisa devenea
         * invizibil. Acum randam aceleasi coduri ca text_format.tpl, pe fundal alb,
         * deci vezi exact ce vor vedea jucatorii.
         */
        $prevText = htmlspecialchars($_SESSION['sys_message'], ENT_QUOTES, 'UTF-8');

        $prevText = str_replace(
            array('[b]','[/b]','[i]','[/i]','[u]','[/u]'),
            array('<b>','</b>','<i>','</i>','<u>','</u>'),
            $prevText
        );

        // doar cod hexazecimal, ca in text_format.tpl
        $prevText = preg_replace('/\[color=(#[0-9a-fA-F]{3,6})\]/', '<span style="color:$1">', $prevText);
        // Inchidem doar atatea etichete cate s-au deschis, ca sa nu ramana
        // un </span> orfan cand codul de culoare a fost invalid.
        $prevOpen = substr_count($prevText, '<span style="color:');
        $prevText = preg_replace('/\[\/color\]/', '</span>', $prevText, $prevOpen);
        $prevText = str_replace('[/color]', '', $prevText);

        $prevColor = preg_match('/^#[0-9a-fA-F]{3,6}$/', (string) $_SESSION['sys_color'])
            ? $_SESSION['sys_color'] : '#333333';
    ?>

    <div class="sysmsg-preview">
        <div class="sysmsg-preview-head"><?php echo ADM_PREVIEW ?? 'Preview'; ?></div>
        <div class="sysmsg-preview-body">
            <h2 style="color:<?=htmlspecialchars($prevColor)?>;margin:0 0 10px 0;font-size:16px">
                <?=htmlspecialchars($_SESSION['sys_subject'], ENT_QUOTES, 'UTF-8')?>
            </h2>
            <div class="sysmsg-preview-text"><?=nl2br($prevText)?></div>
        </div>
    </div>

    <form action="../GameEngine/Admin/Mods/sysmessage.php" method="POST" class="sysmsg-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?=$id?>">
        <input type="hidden" name="action" value="execute">

        <button type="submit" name="confirm" value="Yes" style="background:#27ae60"><?php echo ADM_SEND_SYSTEM_MESSAGE; ?></button>
        <button type="submit" name="confirm" value="No" style="background:#95a5a6;margin-top:8px"><?php echo ADM_CANCEL; ?></button>
    </form>

<?php elseif(isset($_GET['sending'])): ?>

    <div style="text-align:center;padding:30px">
        <div style="font-size:16px;margin-bottom:10px"><?php echo ADM_SENDING_SYSTEM_MESSAGE; ?></div>
    </div>

<?php else: ?>

    <form action="../GameEngine/Admin/Mods/sysmessage.php" method="POST" class="sysmsg-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?=$id?>">
        <input type="hidden" name="action" value="prepare">

        <div class="field">
            <label><?php echo ADM_SUBJECT_2; ?></label>
            <input type="text" name="subject" required maxlength="100">
        </div>

        <div class="field">
            <label><?php echo ADM_COLOR_2; ?></label>
            <input type="text" name="color" value="black">
        </div>

        <div class="field full">
            <label><?php echo ADM_MESSAGE; ?></label>
            <div class="bbbar">
                <button type="button" onclick="bbWrap('[b]','[/b]')"><b>B</b></button>
                <button type="button" onclick="bbWrap('[i]','[/i]')"><i>I</i></button>
                <button type="button" onclick="bbWrap('[u]','[/u]')"><u>U</u></button>
                <?php
                    // culori uzuale; se pot schimba fara sa atingi restul
                    $bbColors = array('#c0392b', '#d35400', '#27ae60', '#2980b9', '#8e44ad', '#2b2b2b');
                    foreach ($bbColors as $bbc) {
                        echo '<button type="button" class="sw" style="background:' . $bbc . '"'
                           . ' title="' . $bbc . '"'
                           . " onclick=\"bbWrap('[color=" . $bbc . "]','[/color]')\"></button>";
                    }
                ?>
            </div>
            <textarea name="message" id="sysmsg_text" rows="12" required></textarea>

<script>
/**
 * Insereaza coduri BBCode in jurul selectiei din caseta de mesaj.
 * Daca nu e nimic selectat, pune codurile la pozitia cursorului si lasa
 * cursorul intre ele, ca sa poti scrie direct.
 */
function bbWrap(open, close) {
    var t = document.getElementById('sysmsg_text');
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

        <button type="submit"><?php echo ADM_CONTINUE; ?></button>

    </form>

<?php endif; ?>

<?php if(isset($_GET['done'])): ?>
    <div class="sysmsg-success"><?php echo ADM_SYSTEM_MESSAGE_SENT_SUCCESSFULLY; ?></div>
<?php endif; ?>

  </div>
</div>