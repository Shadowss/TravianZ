<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      Templates/GlobalChat/widget.tpl                             ##
##  Purpose:       Floating server-wide chat widget (bubble + panel), included ##
##                 from Templates/footer.tpl for any logged-in user.           ##
##                                                                             ##
##  Cerut de Catalin, 07.09.2026:                                              ##
##   - chat general, vazut/scris de orice jucator logat                       ##
##   - MH (access 8) si Admin (access 9) pot muta/bloca jucatori care          ##
##     vorbesc urat                                                            ##
##   - MH si Admin evidentiati fata de restul jucatorilor                      ##
##   - format afisare: [TAG] Nume, sau doar Nume daca nu are alianta          ##
##                                                                             ##
##  Nu depinde de MooTools/jQuery (evita coliziuni cu $ / $$ din unx.js /      ##
##  mt-full.js) - JS vanilla, prefixat "gchat_" peste tot.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
#################################################################################
?>
<div id="gchat_root" data-uid="<?php echo (int) $session->uid; ?>">
    <button id="gchat_bubble" type="button" title="<?php echo GCHAT_TITLE; ?>">
        💬<span id="gchat_badge" style="display:none">0</span>
    </button>

    <div id="gchat_panel" style="display:none">
        <div id="gchat_head">
            <span><?php echo GCHAT_TITLE; ?></span>
            <button id="gchat_close" type="button" title="&times;">&times;</button>
        </div>

        <div id="gchat_messages"></div>

        <div id="gchat_notice" style="display:none"></div>

        <form id="gchat_form" autocomplete="off">
            <input id="gchat_input" type="text" maxlength="250" placeholder="<?php echo GCHAT_PLACEHOLDER; ?>"/>
            <button id="gchat_send_btn" type="submit" title="<?php echo GCHAT_SEND; ?>">&#9658;</button>
        </form>
    </div>
</div>

<style>
    #gchat_root, #gchat_root * { box-sizing: border-box; }

    #gchat_bubble {
        position: fixed;
        right: 18px;
        bottom: 18px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #4a7c2f;
        border: 2px solid #d9e8c8;
        box-shadow: 0 2px 8px rgba(0,0,0,.35);
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
        z-index: 9998;
    }

    #gchat_badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #c0392b;
        color: #fff;
        font-size: 11px;
        font-weight: bold;
        border-radius: 9px;
        min-width: 18px;
        height: 18px;
        line-height: 18px;
        padding: 0 4px;
    }

    #gchat_panel {
        position: fixed;
        right: 18px;
        bottom: 76px;
        width: 300px;
        max-width: calc(100vw - 36px);
        height: 380px;
        max-height: calc(100vh - 110px);
        background: #fdfcf7;
        border: 1px solid #ab9770;
        border-radius: 6px;
        box-shadow: 0 4px 18px rgba(0,0,0,.4);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 9999;
        font-size: 12px;
        font-family: Verdana, Arial, sans-serif;
    }

    #gchat_head {
        background: #6b8f47;
        color: #fff;
        padding: 6px 8px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }

    #gchat_head button {
        background: none;
        border: none;
        color: #fff;
        font-size: 16px;
        line-height: 1;
        cursor: pointer;
        padding: 0 4px;
    }

    #gchat_messages {
        flex: 1;
        overflow-y: auto;
        padding: 6px 8px;
    }

    .gchat_msg { margin-bottom: 6px; word-wrap: break-word; }
    .gchat_time { color: #999; font-size: 10px; margin-right: 3px; }
    .gchat_name { font-weight: bold; text-decoration: none; }
    .gchat_name:hover { text-decoration: underline; }
    .gchat_tag { font-weight: bold; text-decoration: none; }
    .gchat_tag:hover { text-decoration: underline; }
    .gchat_text { color: #222; }

    /* evidentiere MH / Admin fata de restul jucatorilor */
    .gchat_name_admin, .gchat_tag_admin { color: #b8290a; }
    .gchat_name_mh, .gchat_tag_mh { color: #1a5aa8; }
    .gchat_badge_role {
        font-size: 9px;
        font-weight: bold;
        border-radius: 3px;
        padding: 0 3px;
        margin-right: 3px;
        color: #fff;
        vertical-align: middle;
    }
    .gchat_badge_role.admin { background: #b8290a; }
    .gchat_badge_role.mh { background: #1a5aa8; }

    .gchat_mod_actions { margin-left: 4px; }
    .gchat_mod_actions a {
        font-size: 10px;
        color: #888;
        text-decoration: none;
        border-bottom: 1px dotted #aaa;
        margin-right: 4px;
        cursor: pointer;
    }
    .gchat_mod_actions a:hover { color: #b8290a; }

    #gchat_notice {
        padding: 4px 8px;
        background: #fff3cd;
        color: #7a5c00;
        border-top: 1px solid #e0d29a;
        flex-shrink: 0;
    }

    #gchat_form {
        display: flex;
        border-top: 1px solid #ddd;
        flex-shrink: 0;
    }

    #gchat_input {
        flex: 1;
        border: none;
        padding: 6px 8px;
        font-size: 12px;
        outline: none;
    }

    #gchat_send_btn {
        border: none;
        background: #6b8f47;
        color: #fff;
        width: 36px;
        cursor: pointer;
    }

    #gchat_input:disabled { background: #eee; color: #999; }

    @media (max-width: 480px) {
        #gchat_panel { right: 8px; bottom: 66px; }
        #gchat_bubble { right: 8px; bottom: 8px; }
    }
</style>

<script>
(function () {
    "use strict";

    var GCHAT_TXT = {
        muted: <?php echo json_encode(GCHAT_MUTED); ?>,
        ratelimit: <?php echo json_encode(GCHAT_RATELIMIT); ?>,
        empty: <?php echo json_encode(GCHAT_EMPTY); ?>,
        confirmBlock: <?php echo json_encode(GCHAT_CONFIRM_BLOCK); ?>,
        mute5: <?php echo json_encode(GCHAT_MUTE_5M); ?>,
        mute30: <?php echo json_encode(GCHAT_MUTE_30M); ?>,
        mute60: <?php echo json_encode(GCHAT_MUTE_1H); ?>,
        mute1440: <?php echo json_encode(GCHAT_MUTE_24H); ?>,
        block: <?php echo json_encode(GCHAT_BLOCK); ?>,
        unmute: <?php echo json_encode(GCHAT_UNMUTE); ?>,
        adminBadge: <?php echo json_encode(GCHAT_ADMIN_BADGE); ?>,
        mhBadge: <?php echo json_encode(GCHAT_MH_BADGE); ?>
    };

    var ACCESS_ADMIN = 9, ACCESS_MH = 8;
    var AJAX_URL = 'ajax.php';

    var root = document.getElementById('gchat_root');
    if (!root) { return; }

    var bubble = document.getElementById('gchat_bubble');
    var badge = document.getElementById('gchat_badge');
    var panel = document.getElementById('gchat_panel');
    var closeBtn = document.getElementById('gchat_close');
    var messagesBox = document.getElementById('gchat_messages');
    var notice = document.getElementById('gchat_notice');
    var form = document.getElementById('gchat_form');
    var input = document.getElementById('gchat_input');

    var myUid = parseInt(root.getAttribute('data-uid'), 10) || 0;
    var lastId = 0;
    var unread = 0;
    var isOpen = false;
    var viewerIsMod = false;
    var pollTimer = null;

    function fmtTime(unixTs) {
        var d = new Date(unixTs * 1000);
        function pad(n) { return (n < 10 ? '0' : '') + n; }
        return pad(d.getHours()) + ':' + pad(d.getMinutes());
    }

    function showNotice(text) {
        notice.textContent = text;
        notice.style.display = text ? 'block' : 'none';
    }

    function escapeForLog(s) { return s; } // (folosim textContent peste tot mai jos - nu innerHTML pe input de utilizator)

    function renderModActions(row) {
        if (!viewerIsMod || row.id_user === myUid || (row.access || 0) >= ACCESS_MH) {
            return null;
        }

        var span = document.createElement('span');
        span.className = 'gchat_mod_actions';

        function actionLink(label, handler) {
            var a = document.createElement('a');
            a.textContent = label;
            a.addEventListener('click', handler);
            span.appendChild(a);
        }

        actionLink(GCHAT_TXT.mute5, function () { doModerate('gchat_mute', row.id_user, 5); });
        actionLink(GCHAT_TXT.mute30, function () { doModerate('gchat_mute', row.id_user, 30); });
        actionLink(GCHAT_TXT.mute60, function () { doModerate('gchat_mute', row.id_user, 60); });
        actionLink(GCHAT_TXT.mute1440, function () { doModerate('gchat_mute', row.id_user, 1440); });
        actionLink(GCHAT_TXT.block, function () {
            if (window.confirm(GCHAT_TXT.confirmBlock)) {
                doModerate('gchat_block', row.id_user, 0);
            }
        });
        actionLink(GCHAT_TXT.unmute, function () { doModerate('gchat_unmute', row.id_user, 0); });

        return span;
    }

    function renderMessage(row) {
        var line = document.createElement('div');
        line.className = 'gchat_msg';

        var time = document.createElement('span');
        time.className = 'gchat_time';
        time.textContent = fmtTime(row.date);
        line.appendChild(time);

        var access = row.access || 0;
        var roleClass = access >= ACCESS_ADMIN ? 'admin' : (access >= ACCESS_MH ? 'mh' : '');

        if (roleClass) {
            var roleBadge = document.createElement('span');
            roleBadge.className = 'gchat_badge_role ' + roleClass;
            roleBadge.textContent = roleClass === 'admin' ? GCHAT_TXT.adminBadge : GCHAT_TXT.mhBadge;
            line.appendChild(roleBadge);
        }

        if (row.ally_tag) {
            var tagLink = document.createElement('a');
            tagLink.className = 'gchat_tag' + (roleClass ? ' gchat_tag_' + roleClass : '');
            tagLink.href = 'allianz.php?aid=' + encodeURIComponent(row.ally_id);
            tagLink.textContent = '[' + row.ally_tag + ']';
            line.appendChild(tagLink);
            line.appendChild(document.createTextNode(' '));
        }

        var nameLink = document.createElement('a');
        nameLink.className = 'gchat_name' + (roleClass ? ' gchat_name_' + roleClass : '');
        nameLink.href = 'spieler.php?uid=' + encodeURIComponent(row.id_user);
        nameLink.textContent = row.username || ('#' + row.id_user);
        line.appendChild(nameLink);

        line.appendChild(document.createTextNode(': '));

        var text = document.createElement('span');
        text.className = 'gchat_text';
        text.textContent = row.msg;
        line.appendChild(text);

        var mod = renderModActions(row);
        if (mod) { line.appendChild(mod); }

        return line;
    }

    function appendMessages(rows) {
        var wasAtBottom = messagesBox.scrollTop + messagesBox.clientHeight >= messagesBox.scrollHeight - 4;

        rows.forEach(function (row) {
            messagesBox.appendChild(renderMessage(row));
            lastId = Math.max(lastId, row.id);
        });

        if (rows.length && (wasAtBottom || !isOpen)) {
            messagesBox.scrollTop = messagesBox.scrollHeight;
        }

        if (rows.length && !isOpen) {
            unread += rows.length;
            badge.textContent = unread > 99 ? '99+' : String(unread);
            badge.style.display = 'inline-block';
        }
    }

    function applyViewerState(viewer) {
        viewerIsMod = !!viewer.isMod;

        if (viewer.mutedUntil) {
            input.disabled = true;
            var mins = Math.max(1, Math.ceil((viewer.mutedUntil - Date.now() / 1000) / 60));
            showNotice(GCHAT_TXT.muted + ' (' + mins + 'm)');
        } else {
            input.disabled = false;
            if (notice.textContent && notice.textContent.indexOf(GCHAT_TXT.muted) === 0) {
                showNotice('');
            }
        }
    }

    function poll() {
        fetch(AJAX_URL + '?f=gchat_poll&sinceId=' + lastId, { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (!data || !data.ok) { return; }
                appendMessages(data.messages || []);
                applyViewerState(data.viewer || {});
            })
            .catch(function () { /* hiccup de retea - reincercam la urmatorul tick */ });
    }

    function loadInitial() {
        fetch(AJAX_URL + '?f=gchat_poll&sinceId=0', { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (!data || !data.ok) { return; }
                messagesBox.innerHTML = '';
                if (!data.messages || !data.messages.length) {
                    var empty = document.createElement('div');
                    empty.style.color = '#999';
                    empty.textContent = GCHAT_TXT.empty;
                    messagesBox.appendChild(empty);
                }
                appendMessages(data.messages || []);
                applyViewerState(data.viewer || {});
            });
    }

    function doModerate(action, targetUid, minutes) {
        var body = 'target=' + encodeURIComponent(targetUid);
        if (minutes) { body += '&minutes=' + encodeURIComponent(minutes); }

        fetch(AJAX_URL + '?f=' + action, {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: body
        }).then(function (r) { return r.json(); })
          .then(function (data) {
              if (data && data.ok) {
                  poll();
              }
          });
    }

    function openPanel() {
        isOpen = true;
        panel.style.display = 'flex';
        unread = 0;
        badge.style.display = 'none';
        messagesBox.scrollTop = messagesBox.scrollHeight;
        input.focus();
    }

    function closePanel() {
        isOpen = false;
        panel.style.display = 'none';
    }

    bubble.addEventListener('click', function () {
        if (isOpen) { closePanel(); } else { openPanel(); }
    });

    closeBtn.addEventListener('click', closePanel);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var msg = input.value.trim();
        if (!msg || input.disabled) { return; }

        fetch(AJAX_URL + '?f=gchat_send', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'msg=' + encodeURIComponent(msg)
        }).then(function (r) { return r.json(); })
          .then(function (data) {
              if (data && data.ok) {
                  input.value = '';
                  showNotice('');
                  poll();
              } else if (data && data.reason === 'muted') {
                  applyViewerState({ isMod: viewerIsMod, mutedUntil: data.mutedUntil });
              } else if (data && data.reason === 'ratelimit') {
                  showNotice(GCHAT_TXT.ratelimit);
              }
          });
    });

    loadInitial();
    pollTimer = window.setInterval(poll, 2500);

    window.addEventListener('beforeunload', function () {
        if (pollTimer) { window.clearInterval(pollTimer); }
    });
})();
</script>
