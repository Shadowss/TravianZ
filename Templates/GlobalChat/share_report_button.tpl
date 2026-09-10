<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      Templates/GlobalChat/share_report_button.tpl               ##
##  Purpose:       Buton "Distribuie in chat" pe pagina unui raport propriu de ##
##                 atac (berichte.php) - Faza 3 Global Chat.                   ##
##                                                                             ##
##  Inclus DOAR de berichte.php, DOAR cand $tzShareEligible e true (proprietar ##
##  + ntype 1-7) - vezi acolo. id-ul raportului vine ca $_GET['id'], deja      ##
##  curatat in berichte.php inainte de a ajunge aici.                          ##
##                                                                             ##
##  Cerut de Catalin, 09.09.2026 (Faza 3 Global Chat).                        ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
#################################################################################

$tzShareNoticeId = (int) preg_replace("/[^0-9]/", "", (string) ($_GET['id'] ?? 0));
?>
<div id="gchat_share_report_wrap" style="margin:8px 0;">
    <button type="button" id="gchat_share_report_btn" data-id="<?php echo $tzShareNoticeId; ?>"
        style="padding:4px 10px;border:1px solid #6b8f47;border-radius:4px;background:#6b8f47;color:#fff;cursor:pointer;font-size:12px;">
        <?php echo GCHAT_SHARE_REPORT; ?>
    </button>
    <span id="gchat_share_report_status" style="margin-left:6px;font-size:12px;color:#666;"></span>
</div>
<script>
(function () {
    "use strict";
    var btn = document.getElementById('gchat_share_report_btn');
    var status = document.getElementById('gchat_share_report_status');
    if (!btn) { return; }

    var OK_TXT = <?php echo json_encode(GCHAT_SHARE_REPORT_OK); ?>;
    var ERR_TXT = <?php echo json_encode(GCHAT_ERROR_GENERIC); ?>;

    btn.addEventListener('click', function () {
        btn.disabled = true;
        status.textContent = '';

        fetch('ajax.php?f=gchat_share_report', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + encodeURIComponent(btn.getAttribute('data-id'))
        }).then(function (r) { return r.json(); })
          .then(function (data) {
              btn.disabled = false;
              status.textContent = (data && data.ok) ? OK_TXT : ERR_TXT;
          })
          .catch(function () {
              btn.disabled = false;
              status.textContent = ERR_TXT;
          });
    });
})();
</script>
