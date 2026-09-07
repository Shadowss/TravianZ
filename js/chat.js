(function () {
    'use strict';

    function initChat() {
        if (document.getElementById('tz-chat-root')) {
            return;
        }

        var endpoint = 'chat.php';
        var lastId = 0;
        var initialized = false;
        var opened = false;
        var loading = false;
        var pollingTimer = null;
        var unread = 0;
        var storageKey = 'tzChatLastSeen';

        var style = document.createElement('style');
        style.id = 'tz-chat-style';
        style.textContent = [
            '#tz-chat-root{position:fixed;right:18px;bottom:18px;z-index:99999;font-family:Arial,Helvetica,sans-serif;}',
            '#tz-chat-toggle{position:relative;width:52px;height:52px;border:1px solid #6f543d;border-radius:50%;background:linear-gradient(#8f6a4a,#6b4e36);color:#fff;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.28);font-size:22px;font-weight:bold;}',
            '#tz-chat-toggle:hover{filter:brightness(1.08);}',
            '#tz-chat-badge{display:none;position:absolute;top:-4px;right:-2px;min-width:19px;height:19px;padding:0 5px;border-radius:10px;background:#b22a1f;color:#fff;font-size:11px;line-height:19px;text-align:center;box-sizing:border-box;border:2px solid #fff;}',
            '#tz-chat-panel{display:none;width:330px;height:430px;margin-bottom:10px;overflow:hidden;background:#f4efe7;border:1px solid #6b513a;border-radius:6px;box-shadow:0 8px 28px rgba(0,0,0,.32);}',
            '#tz-chat-root.tz-chat-open #tz-chat-panel{display:flex;flex-direction:column;}',
            '#tz-chat-root.tz-chat-open #tz-chat-toggle{display:none;}',
            '#tz-chat-head{height:42px;flex:0 0 42px;display:flex;align-items:center;justify-content:space-between;padding:0 10px 0 12px;box-sizing:border-box;background:linear-gradient(#876241,#684a33);color:#fff;border-bottom:1px solid #573c29;}',
            '#tz-chat-title{font-size:13px;font-weight:bold;letter-spacing:.2px;}',
            '#tz-chat-status{font-size:10px;font-weight:normal;opacity:.78;margin-left:6px;}',
            '#tz-chat-close{width:27px;height:27px;border:0;background:transparent;color:#fff;cursor:pointer;font-size:21px;line-height:27px;padding:0;}',
            '#tz-chat-messages{flex:1;overflow-y:auto;padding:10px 9px;background:linear-gradient(#f7f2ea,#eee7dc);box-sizing:border-box;}',
            '.tz-chat-empty{padding:30px 18px;text-align:center;color:#8c8175;font-size:12px;}',
            '.tz-chat-msg{display:flex;margin:0 0 8px;}',
            '.tz-chat-msg.tz-chat-self{justify-content:flex-end;}',
            '.tz-chat-bubble{max-width:82%;padding:6px 8px 5px;border:1px solid #d1c2af;border-radius:5px;background:#fffaf3;box-shadow:0 1px 2px rgba(0,0,0,.07);}',
            '.tz-chat-self .tz-chat-bubble{background:#efe2d0;border-color:#c5ad92;}',
            '.tz-chat-meta{font-size:10px;color:#806e5b;margin-bottom:3px;display:flex;gap:6px;align-items:baseline;}',
            '.tz-chat-name{font-weight:bold;color:#5b4330;}',
            '.tz-chat-time{opacity:.75;}',
            '.tz-chat-text{font-size:12px;line-height:1.35;color:#40362f;word-break:break-word;white-space:pre-wrap;}',
            '#tz-chat-form{display:flex;gap:6px;padding:8px;border-top:1px solid #c9b9a6;background:#e5dbcf;box-sizing:border-box;}',
            '#tz-chat-input{flex:1;min-width:0;height:32px;border:1px solid #b7a58f;border-radius:4px;background:#fff;color:#3e342d;padding:0 8px;outline:none;font-size:12px;box-sizing:border-box;}',
            '#tz-chat-input:focus{border-color:#806143;box-shadow:0 0 0 1px rgba(128,97,67,.14);}',
            '#tz-chat-send{height:32px;padding:0 12px;border:1px solid #6c5139;border-radius:4px;background:linear-gradient(#9b744f,#755337);color:#fff;font-weight:bold;font-size:12px;cursor:pointer;}',
            '#tz-chat-send:hover{filter:brightness(1.06);}',
            '#tz-chat-send:disabled{opacity:.55;cursor:default;}',
            '#tz-chat-error{display:none;padding:6px 9px;color:#8e2a20;background:#f7d8d3;border-top:1px solid #d59a92;font-size:11px;}',
            '@media (max-width:600px){#tz-chat-root{right:10px;bottom:10px;}#tz-chat-panel{width:min(330px,calc(100vw - 20px));height:min(430px,calc(100vh - 80px));}}'
        ].join('');
        document.head.appendChild(style);

        var root = document.createElement('div');
        root.id = 'tz-chat-root';
        root.innerHTML = [
            '<div id="tz-chat-panel" role="dialog" aria-label="Global chat">',
                '<div id="tz-chat-head">',
                    '<div id="tz-chat-title">💬 Global Chat <span id="tz-chat-status">online</span></div>',
                    '<button id="tz-chat-close" type="button" aria-label="Close">×</button>',
                '</div>',
                '<div id="tz-chat-messages"><div class="tz-chat-empty">Loading chat…</div></div>',
                '<div id="tz-chat-error"></div>',
                '<form id="tz-chat-form" autocomplete="off">',
                    '<input id="tz-chat-input" type="text" maxlength="500" placeholder="Write a message…" aria-label="Message">',
                    '<button id="tz-chat-send" type="submit">Send</button>',
                '</form>',
            '</div>',
            '<button id="tz-chat-toggle" type="button" aria-label="Open chat">💬<span id="tz-chat-badge">0</span></button>'
        ].join('');
        document.body.appendChild(root);

        var toggle = document.getElementById('tz-chat-toggle');
        var closeButton = document.getElementById('tz-chat-close');
        var messages = document.getElementById('tz-chat-messages');
        var form = document.getElementById('tz-chat-form');
        var input = document.getElementById('tz-chat-input');
        var errorBox = document.getElementById('tz-chat-error');
        var badge = document.getElementById('tz-chat-badge');

        function setError(message) {
            errorBox.textContent = message || '';
            errorBox.style.display = message ? 'block' : 'none';
        }

        function scrollBottom() {
            messages.scrollTop = messages.scrollHeight;
        }

        function showBadge(value) {
            unread = Math.max(0, Number(value || 0));
            if (unread > 0 && !opened) {
                badge.style.display = 'block';
                badge.textContent = unread > 99 ? '99+' : String(unread);
            } else {
                badge.style.display = 'none';
            }
        }

        function markSeen() {
            try {
                localStorage.setItem(storageKey, String(lastId));
            } catch (e) {}
            showBadge(0);
        }

        function getStoredSeen() {
            try {
                var value = parseInt(localStorage.getItem(storageKey) || '0', 10);
                return isFinite(value) ? value : 0;
            } catch (e) {
                return 0;
            }
        }

        function appendMessage(item) {
            var row = document.createElement('div');
            row.className = 'tz-chat-msg' + (Number(item.uid) === Number(window.TZ_CHAT_UID || 0) ? ' tz-chat-self' : '');

            var bubble = document.createElement('div');
            bubble.className = 'tz-chat-bubble';

            var meta = document.createElement('div');
            meta.className = 'tz-chat-meta';

            var name = document.createElement('span');
            name.className = 'tz-chat-name';
            name.textContent = item.username || 'Player';

            var time = document.createElement('span');
            time.className = 'tz-chat-time';
            time.textContent = item.time || '';

            var text = document.createElement('div');
            text.className = 'tz-chat-text';
            text.textContent = item.message || '';

            meta.appendChild(name);
            meta.appendChild(time);
            bubble.appendChild(meta);
            bubble.appendChild(text);
            row.appendChild(bubble);
            messages.appendChild(row);
        }

        function renderInitial(items) {
            messages.innerHTML = '';
            if (!items || !items.length) {
                messages.innerHTML = '<div class="tz-chat-empty">No messages yet. Start the conversation.</div>';
                return;
            }
            items.forEach(appendMessage);
            scrollBottom();
        }

        function requestMessages(after) {
            if (loading) {
                return;
            }
            loading = true;
            var url = endpoint + '?action=messages&after=' + encodeURIComponent(after || 0) + '&_=' + Date.now();

            fetch(url, {
                method: 'GET',
                credentials: 'same-origin',
                cache: 'no-store'
            })
            .then(function (response) {
                return response.json().then(function (body) {
                    return { status: response.status, body: body };
                });
            })
            .then(function (result) {
                var body = result.body || {};
                if (!body.ok) {
                    throw new Error(body.error || 'chat_error');
                }

                window.TZ_CHAT_UID = Number(body.uid || window.TZ_CHAT_UID || 0);
                var items = body.messages || [];

                if (!initialized && after === 0) {
                    renderInitial(items);
                    lastId = Number(body.latest_id || 0);
                    initialized = true;

                    var previousSeen = getStoredSeen();
                    if (!previousSeen) {
                        markSeen();
                    } else if (lastId > previousSeen) {
                        var initialUnread = items.filter(function (item) {
                            return Number(item.id) > previousSeen;
                        }).length;
                        showBadge(initialUnread);
                    }
                } else {
                    items.forEach(function (item) {
                        appendMessage(item);
                        lastId = Math.max(lastId, Number(item.id || 0));
                    });

                    if (items.length && !opened) {
                        showBadge(unread + items.length);
                    }

                    if (items.length && opened) {
                        scrollBottom();
                        markSeen();
                    }
                }

                if (opened) {
                    markSeen();
                }

                setError('');
            })
            .catch(function () {
                if (!initialized) {
                    messages.innerHTML = '<div class="tz-chat-empty">Chat unavailable. Please refresh.</div>';
                }
                if (opened) {
                    setError('Unable to reach the chat server.');
                }
            })
            .finally(function () {
                loading = false;
            });
        }

        function startPolling() {
            if (pollingTimer) {
                return;
            }
            pollingTimer = window.setInterval(function () {
                requestMessages(lastId);
            }, 2500);
        }

        function openChat() {
            opened = true;
            root.classList.add('tz-chat-open');
            showBadge(0);
            requestMessages(lastId);
            window.setTimeout(function () {
                input.focus();
                scrollBottom();
            }, 0);
        }

        function closeChat() {
            opened = false;
            root.classList.remove('tz-chat-open');
        }

        toggle.addEventListener('click', openChat);
        closeButton.addEventListener('click', closeChat);

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            setError('');

            var message = input.value.trim();
            if (!message) {
                return;
            }

            var sendButton = document.getElementById('tz-chat-send');
            sendButton.disabled = true;

            var formData = new FormData();
            formData.append('message', message);

            fetch(endpoint + '?action=send', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
                cache: 'no-store'
            })
            .then(function (response) {
                return response.json().then(function (body) {
                    return { status: response.status, body: body };
                });
            })
            .then(function (result) {
                var body = result.body || {};
                if (!body.ok) {
                    if (body.error === 'rate') {
                        throw new Error('Please wait a moment before sending another message.');
                    }
                    if (body.error === 'length') {
                        throw new Error('Message is too long (maximum 500 characters).');
                    }
                    throw new Error('Message could not be sent.');
                }
                input.value = '';
                requestMessages(lastId);
            })
            .catch(function (error) {
                setError(error.message || 'Message could not be sent.');
            })
            .finally(function () {
                sendButton.disabled = false;
                input.focus();
            });
        });

        requestMessages(0);
        startPolling();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChat);
    } else {
        initChat();
    }
})();
