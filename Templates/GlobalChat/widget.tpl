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
##  Faza 2 (09.09.2026): stergere mesaj (mod), editare mesaj propriu (user),   ##
##  sondaje, emoji, si fix la badge-ul de mesaje necitite (vezi loadInitial). ##
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

        <div id="gchat_emoji_panel" style="display:none"></div>

        <div id="gchat_poll_form" style="display:none">
            <input id="gchat_poll_question" type="text" maxlength="200" placeholder="<?php echo GCHAT_POLL_QUESTION_PLACEHOLDER; ?>"/>
            <div id="gchat_poll_options"></div>
            <div class="gchat_poll_form_actions">
                <button id="gchat_poll_add_option" type="button"><?php echo GCHAT_POLL_ADD_OPTION; ?></button>
                <button id="gchat_poll_submit" type="button"><?php echo GCHAT_POLL_CREATE; ?></button>
            </div>
        </div>

        <form id="gchat_form" autocomplete="off">
            <button id="gchat_emoji_btn" type="button" class="gchat_toolbar_btn" title="<?php echo GCHAT_EMOJI_TITLE; ?>">🙂</button>
            <button id="gchat_poll_btn" type="button" class="gchat_toolbar_btn" title="<?php echo GCHAT_POLL_TITLE; ?>">📊</button>
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

    /* Faza 2: actiuni (edit propriu + moderare) - o singura clasa flat,
       ca sa nu se dubleze margin-left cand cele doua se combina pe acelasi rand.
       Inlocuieste .gchat_mod_actions din Faza 1 (nu mai e generata de JS). */
    .gchat_actions { margin-left: 4px; }
    .gchat_actions a {
        font-size: 10px;
        color: #888;
        text-decoration: none;
        border-bottom: 1px dotted #aaa;
        margin-right: 4px;
        cursor: pointer;
    }
    .gchat_actions a:hover { color: #b8290a; }

    .gchat_text_deleted { color: #999; font-style: italic; }
    .gchat_edited_tag { color: #999; font-size: 10px; }

    .gchat_edit_bar { display: flex; gap: 4px; margin-top: 3px; }
    .gchat_edit_bar input {
        flex: 1;
        font-size: 11px;
        padding: 2px 4px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .gchat_edit_bar a {
        font-size: 10px;
        color: #6b8f47;
        cursor: pointer;
        align-self: center;
        text-decoration: none;
    }

    /* sondaje */
    .gchat_poll_block {
        margin-top: 3px;
        padding: 5px 6px;
        background: #f2f0e6;
        border: 1px solid #ddd6bd;
        border-radius: 4px;
    }
    .gchat_poll_question { font-weight: bold; margin-bottom: 4px; }
    .gchat_poll_option {
        position: relative;
        display: block;
        width: 100%;
        text-align: left;
        margin-bottom: 3px;
        padding: 3px 6px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background: #fff;
        cursor: pointer;
        overflow: hidden;
        font-size: 11px;
    }
    .gchat_poll_bar {
        position: absolute;
        left: 0; top: 0; bottom: 0;
        background: #cfe0bb;
        z-index: 0;
    }
    .gchat_poll_option_label { position: relative; z-index: 1; }
    .gchat_poll_option_mine { border-color: #6b8f47; }
    .gchat_poll_total { font-size: 10px; color: #888; margin-top: 2px; }

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

    .gchat_toolbar_btn {
        border: none;
        background: none;
        font-size: 16px;
        line-height: 1;
        cursor: pointer;
        padding: 0 4px;
        flex-shrink: 0;
    }

    #gchat_emoji_panel {
        display: none;
        grid-template-columns: repeat(8, 1fr);
        gap: 2px;
        padding: 6px;
        max-height: 110px;
        overflow-y: auto;
        border-top: 1px solid #ddd;
        flex-shrink: 0;
    }
    .gchat_emoji_item {
        border: none;
        background: none;
        font-size: 16px;
        cursor: pointer;
        padding: 2px;
        border-radius: 3px;
    }
    .gchat_emoji_item:hover { background: #eee; }

    #gchat_poll_form {
        display: none;
        padding: 6px 8px;
        border-top: 1px solid #ddd;
        flex-shrink: 0;
        background: #f7f5ef;
    }
    #gchat_poll_form input[type="text"] {
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 4px;
        padding: 4px 6px;
        font-size: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .gchat_poll_option_row {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 4px;
    }
    .gchat_poll_option_row input { flex: 1; }
    .gchat_poll_option_remove {
        border: none;
        background: #ddd;
        border-radius: 3px;
        width: 20px;
        height: 20px;
        cursor: pointer;
        flex-shrink: 0;
    }
    .gchat_poll_form_actions { display: flex; justify-content: space-between; gap: 6px; }
    .gchat_poll_form_actions button {
        flex: 1;
        padding: 4px;
        font-size: 11px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    #gchat_poll_add_option { background: #ddd; }
    #gchat_poll_submit { background: #6b8f47; color: #fff; }

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
        mhBadge: <?php echo json_encode(GCHAT_MH_BADGE); ?>,
        edit: <?php echo json_encode(GCHAT_EDIT); ?>,
        save: <?php echo json_encode(GCHAT_SAVE); ?>,
        cancel: <?php echo json_encode(GCHAT_CANCEL); ?>,
        editedTag: <?php echo json_encode(GCHAT_EDITED_TAG); ?>,
        deleteMsg: <?php echo json_encode(GCHAT_DELETE); ?>,
        confirmDelete: <?php echo json_encode(GCHAT_CONFIRM_DELETE); ?>,
        deletedPlaceholder: <?php echo json_encode(GCHAT_DELETED_PLACEHOLDER); ?>,
        pollOptionPlaceholder: <?php echo json_encode(GCHAT_POLL_OPTION_PLACEHOLDER); ?>,
        pollVotesWord: <?php echo json_encode(GCHAT_POLL_VOTES_WORD); ?>,
        errorGeneric: <?php echo json_encode(GCHAT_ERROR_GENERIC); ?>
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
    var emojiBtn = document.getElementById('gchat_emoji_btn');
    var emojiPanel = document.getElementById('gchat_emoji_panel');
    var pollBtn = document.getElementById('gchat_poll_btn');
    var pollForm = document.getElementById('gchat_poll_form');
    var pollQuestionInput = document.getElementById('gchat_poll_question');
    var pollOptionsBox = document.getElementById('gchat_poll_options');

    var myUid = parseInt(root.getAttribute('data-uid'), 10) || 0;
    var lastId = 0;
    var unread = 0;
    var isOpen = false;
    var viewerIsMod = false;
    var viewerAccess = 0;
    var pollTimer = null;
    // Faza 2: watermark de timp pentru editari/stergeri/voturi pe mesaje deja
    // afisate (separat de 'lastId', care e watermark pe mesaje NOI) - initializat
    // la "acum", nu la 0, ca sa nu tragem tot istoricul de mutatii de la
    // pornirea serverului (irelevant - contam doar ce s-a schimbat de cand
    // pagina curenta a fost incarcata)
    var lastMutationTs = Math.floor(Date.now() / 1000);
    var MAX_POLL_OPTIONS = 6;
    var EMOJI_LIST = ['😀','😂','😅','😊','😍','😎','🤔','😴','😭','😡','👍','👎','👏','🙏','💪','🔥','⭐','❤️','💯','🎉','⚔️','🛡️','🏰','🌾','🪵','⛏️','🧱','⏳','🐎','🏆'];

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

    function appendModActionLinks(parentSpan, row) {
        if (!viewerIsMod) { return; }

        var targetAccess = parseInt(row.access, 10) || 0;
        var targetUid = parseInt(row.id_user, 10) || 0;

        function actionLink(label, handler) {
            var a = document.createElement('a');
            a.textContent = label;
            a.addEventListener('click', handler);
            parentSpan.appendChild(a);
        }

        // mute/block: doar pe alt user, cu rang strict mai mic (neschimbat)
        if (targetUid !== myUid && targetAccess < viewerAccess) {
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
        }

        // Faza 2: stergere mesaj - NU e limitata de rang (vezi comentariul din
        // Database::deleteGlobalChatMessage) - orice MH/Admin poate sterge orice
        // mesaj, inclusiv al altui MH sau al lui insusi, ca sa poata curata
        // rapid continut vulgar
        actionLink(GCHAT_TXT.deleteMsg, function () {
            if (window.confirm(GCHAT_TXT.confirmDelete)) {
                deleteMessage(row.id);
            }
        });
    }

    function deleteMessage(id) {
        fetch(AJAX_URL + '?f=gchat_delete', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + encodeURIComponent(id)
        }).then(function (r) { return r.json(); })
          .then(function (data) {
              if (data && data.ok) {
                  fetchUpdatesNow();
              } else {
                  showNotice(GCHAT_TXT.errorGeneric);
              }
          });
    }

    function startEdit(line, row, textSpan) {
        var actions = line.querySelector('.gchat_actions');
        var original = textSpan.textContent;

        var editInput = document.createElement('input');
        editInput.type = 'text';
        editInput.className = 'gchat_edit_input';
        editInput.maxLength = 250;
        editInput.value = original;

        var saveBtn = document.createElement('a');
        saveBtn.textContent = GCHAT_TXT.save;
        var cancelBtn = document.createElement('a');
        cancelBtn.textContent = GCHAT_TXT.cancel;

        var editBar = document.createElement('div');
        editBar.className = 'gchat_edit_bar';
        editBar.appendChild(editInput);
        editBar.appendChild(saveBtn);
        editBar.appendChild(cancelBtn);

        textSpan.style.display = 'none';
        if (actions) { actions.style.display = 'none'; }
        line.appendChild(editBar);
        editInput.focus();

        function cleanup() {
            editBar.remove();
            textSpan.style.display = '';
            if (actions) { actions.style.display = ''; }
        }

        cancelBtn.addEventListener('click', cleanup);

        saveBtn.addEventListener('click', function () {
            var newMsg = editInput.value.trim();
            if (!newMsg) { return; }

            fetch(AJAX_URL + '?f=gchat_edit', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + encodeURIComponent(row.id) + '&msg=' + encodeURIComponent(newMsg)
            }).then(function (r) { return r.json(); })
              .then(function (data) {
                  cleanup();
                  if (data && data.ok) {
                      fetchUpdatesNow();
                  } else {
                      showNotice(GCHAT_TXT.errorGeneric);
                  }
              });
        });
    }

    function renderPollBlock(pollData, msgId) {
        var wrap = document.createElement('div');
        wrap.className = 'gchat_poll_block';
        if (!pollData) { return wrap; }

        var q = document.createElement('div');
        q.className = 'gchat_poll_question';
        q.textContent = pollData.question;
        wrap.appendChild(q);

        var total = pollData.total || 0;
        (pollData.options || []).forEach(function (optText, idx) {
            var count = (pollData.counts && pollData.counts[idx]) || 0;
            var pct = total > 0 ? Math.round((count / total) * 100) : 0;
            var isMine = pollData.myVote !== null && pollData.myVote !== undefined
                && parseInt(pollData.myVote, 10) === idx;

            var optBtn = document.createElement('button');
            optBtn.type = 'button';
            optBtn.className = 'gchat_poll_option' + (isMine ? ' gchat_poll_option_mine' : '');

            var bar = document.createElement('span');
            bar.className = 'gchat_poll_bar';
            bar.style.width = pct + '%';
            optBtn.appendChild(bar);

            var label = document.createElement('span');
            label.className = 'gchat_poll_option_label';
            label.textContent = optText + ' \u2014 ' + pct + '% (' + count + ')';
            optBtn.appendChild(label);

            optBtn.addEventListener('click', function () {
                fetch(AJAX_URL + '?f=gchat_poll_vote', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'pollId=' + encodeURIComponent(pollData.id) + '&option=' + encodeURIComponent(idx)
                }).then(function (r) { return r.json(); })
                  .then(function (data) {
                      if (data && data.ok) {
                          fetchUpdatesNow();
                      } else {
                          showNotice(GCHAT_TXT.errorGeneric);
                      }
                  });
            });

            wrap.appendChild(optBtn);
        });

        var totalLine = document.createElement('div');
        totalLine.className = 'gchat_poll_total';
        totalLine.textContent = total + ' ' + GCHAT_TXT.pollVotesWord;
        wrap.appendChild(totalLine);

        return wrap;
    }

    function renderMessage(row) {
        var line = document.createElement('div');
        line.className = 'gchat_msg';
        line.id = 'gchat_msg_' + row.id;

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

        // Faza 2: mesaj sters de moderator - text golit server-side, aici doar
        // afisam un placeholder; nicio actiune (nimic de moderat pe un mesaj deja sters)
        if (parseInt(row.deleted, 10) === 1) {
            var delText = document.createElement('span');
            delText.className = 'gchat_text gchat_text_deleted';
            delText.textContent = GCHAT_TXT.deletedPlaceholder;
            line.appendChild(delText);
            return line;
        }

        // Faza 2: sondaj - randare separata, doar cu actiunea de stergere (mod)
        if (row.type === 'poll') {
            line.appendChild(renderPollBlock(row.poll, row.id));

            var pollActions = document.createElement('span');
            pollActions.className = 'gchat_actions';
            appendModActionLinks(pollActions, row);
            if (pollActions.childNodes.length) { line.appendChild(pollActions); }

            return line;
        }

        var text = document.createElement('span');
        text.className = 'gchat_text';
        text.textContent = row.msg;
        line.appendChild(text);

        var editedTag = document.createElement('span');
        editedTag.className = 'gchat_edited_tag';
        editedTag.textContent = ' ' + GCHAT_TXT.editedTag;
        editedTag.style.display = parseInt(row.edited, 10) === 1 ? 'inline' : 'none';
        line.appendChild(editedTag);

        var actions = document.createElement('span');
        actions.className = 'gchat_actions';

        var targetUid = parseInt(row.id_user, 10) || 0;
        if (targetUid === myUid) {
            var editLink = document.createElement('a');
            editLink.textContent = GCHAT_TXT.edit;
            editLink.addEventListener('click', function () { startEdit(line, row, text); });
            actions.appendChild(editLink);
        }

        appendModActionLinks(actions, row);

        if (actions.childNodes.length) { line.appendChild(actions); }

        return line;
    }

    function applyMutation(row) {
        var line = document.getElementById('gchat_msg_' + row.id);
        if (!line) { return; }

        if (parseInt(row.deleted, 10) === 1) {
            var textEl = line.querySelector('.gchat_text');
            var pollEl = line.querySelector('.gchat_poll_block');
            var actionsEl = line.querySelector('.gchat_actions');
            var editedTagEl = line.querySelector('.gchat_edited_tag');
            if (pollEl) { pollEl.remove(); }
            if (actionsEl) { actionsEl.remove(); }
            if (editedTagEl) { editedTagEl.remove(); }
            if (textEl) {
                textEl.textContent = GCHAT_TXT.deletedPlaceholder;
                textEl.className = 'gchat_text gchat_text_deleted';
            } else {
                var span = document.createElement('span');
                span.className = 'gchat_text gchat_text_deleted';
                span.textContent = GCHAT_TXT.deletedPlaceholder;
                line.appendChild(span);
            }
            return;
        }

        if (row.type === 'poll' && row.poll) {
            var existingPoll = line.querySelector('.gchat_poll_block');
            var freshPoll = renderPollBlock(row.poll, row.id);
            if (existingPoll) {
                existingPoll.replaceWith(freshPoll);
            } else {
                line.appendChild(freshPoll);
            }
            return;
        }

        var textEl2 = line.querySelector('.gchat_text');
        var editedTagEl2 = line.querySelector('.gchat_edited_tag');
        if (textEl2) { textEl2.textContent = row.msg; }
        if (editedTagEl2 && parseInt(row.edited, 10) === 1) {
            editedTagEl2.style.display = 'inline';
        }
    }

    function fetchUpdatesNow() {
        fetch(AJAX_URL + '?f=gchat_updates&sinceTs=' + lastMutationTs, { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (!data || !data.ok) { return; }
                (data.rows || []).forEach(applyMutation);
                lastMutationTs = data.now;
            })
            .catch(function () { /* reincercam la urmatorul tick */ });
    }

    function appendMessages(rows, countUnread) {
        if (countUnread === undefined) { countUnread = true; }
        var wasAtBottom = messagesBox.scrollTop + messagesBox.clientHeight >= messagesBox.scrollHeight - 4;

        rows.forEach(function (row) {
            messagesBox.appendChild(renderMessage(row));
            lastId = Math.max(lastId, row.id);
        });

        if (rows.length && (wasAtBottom || !isOpen)) {
            messagesBox.scrollTop = messagesBox.scrollHeight;
        }

        if (countUnread && rows.length && !isOpen) {
            unread += rows.length;
            badge.textContent = unread > 99 ? '99+' : String(unread);
            badge.style.display = 'inline-block';
        }
    }

    function applyViewerState(viewer) {
        viewerAccess = parseInt(viewer.access, 10) || 0;
        viewerIsMod = viewerAccess >= ACCESS_MH;

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

    // NOTA: numele functiei 'poll()' vine de la mecanismul de long-polling
    // pentru mesaje NOI (dupa id) - nu are legatura cu sondajele (chat_global_polls,
    // "gchat_poll_create/vote" mai jos); denumire mostenita din Faza 1, pastrata
    // ca sa nu umblam degeaba prin tot fisierul.
    function poll() {
        fetch(AJAX_URL + '?f=gchat_poll&sinceId=' + lastId, { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (!data || !data.ok) { return; }
                applyViewerState(data.viewer || {});
                appendMessages(data.messages || []);
            })
            .catch(function () { /* hiccup de retea - reincercam la urmatorul tick */ });

        fetchUpdatesNow();
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
                applyViewerState(data.viewer || {});
                // FIX (Faza 2, 09.09.2026): istoricul incarcat la deschiderea/
                // reincarcarea paginii NU e "necitit" - inainte se aduna la
                // contorul de mesaje noi de fiecare data cand pagina se
                // (re)incarca, motiv pentru care badge-ul arata numarul total
                // de mesaje din istoric (ex. 17), nu doar cele aparute cat timp
                // panoul a stat efectiv inchis.
                appendMessages(data.messages || [], false);
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
                  applyViewerState({
                      access: viewerAccess,
                      mutedUntil: data.mutedUntil
                  });
              } else if (data && data.reason === 'ratelimit') {
                  showNotice(GCHAT_TXT.ratelimit);
              }
          });
    });

    function insertAtCursor(field, text) {
        var start = field.selectionStart != null ? field.selectionStart : field.value.length;
        var end = field.selectionEnd != null ? field.selectionEnd : field.value.length;
        field.value = field.value.slice(0, start) + text + field.value.slice(end);
        var pos = start + text.length;
        field.focus();
        if (field.setSelectionRange) { field.setSelectionRange(pos, pos); }
    }

    function addPollOptionRow(value) {
        if (pollOptionsBox.children.length >= MAX_POLL_OPTIONS) { return; }

        var row = document.createElement('div');
        row.className = 'gchat_poll_option_row';

        var optInput = document.createElement('input');
        optInput.type = 'text';
        optInput.maxLength = 60;
        optInput.placeholder = GCHAT_TXT.pollOptionPlaceholder;
        optInput.value = value || '';
        row.appendChild(optInput);

        // primele 2 optiuni sunt obligatorii (minim necesar la un sondaj) -
        // fara buton de stergere pe ele
        if (pollOptionsBox.children.length >= 2) {
            var removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'gchat_poll_option_remove';
            removeBtn.textContent = '\u00d7';
            removeBtn.addEventListener('click', function () { row.remove(); });
            row.appendChild(removeBtn);
        }

        pollOptionsBox.appendChild(row);
    }

    function resetPollForm() {
        pollQuestionInput.value = '';
        pollOptionsBox.innerHTML = '';
        addPollOptionRow('');
        addPollOptionRow('');
    }

    function closePollForm() {
        pollForm.style.display = 'none';
    }

    EMOJI_LIST.forEach(function (em) {
        var b = document.createElement('button');
        b.type = 'button';
        b.className = 'gchat_emoji_item';
        b.textContent = em;
        b.addEventListener('click', function () { insertAtCursor(input, em); });
        emojiPanel.appendChild(b);
    });

    emojiBtn.addEventListener('click', function () {
        pollForm.style.display = 'none';
        emojiPanel.style.display = emojiPanel.style.display === 'none' ? 'grid' : 'none';
    });

    pollBtn.addEventListener('click', function () {
        emojiPanel.style.display = 'none';
        var opening = pollForm.style.display === 'none';
        pollForm.style.display = opening ? 'block' : 'none';
        if (opening) { resetPollForm(); }
    });

    document.getElementById('gchat_poll_add_option').addEventListener('click', function () {
        addPollOptionRow('');
    });

    document.getElementById('gchat_poll_submit').addEventListener('click', function () {
        var question = pollQuestionInput.value.trim();
        var options = Array.prototype.map.call(
            pollOptionsBox.querySelectorAll('input'),
            function (inp) { return inp.value.trim(); }
        ).filter(function (v) { return v !== ''; });

        if (!question || options.length < 2) { return; }

        var body = 'question=' + encodeURIComponent(question);
        options.forEach(function (opt) { body += '&options[]=' + encodeURIComponent(opt); });

        fetch(AJAX_URL + '?f=gchat_poll_create', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: body
        }).then(function (r) { return r.json(); })
          .then(function (data) {
              if (data && data.ok) {
                  closePollForm();
                  poll();
              } else if (data && data.reason === 'muted') {
                  applyViewerState({ access: viewerAccess, mutedUntil: data.mutedUntil });
              } else {
                  showNotice(GCHAT_TXT.errorGeneric);
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
