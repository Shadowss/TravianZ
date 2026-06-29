<?php
/**
 * CSRF protection helpers (issue #139).
 *
 * Shared by Admin/admin.php and the admin Mods (GameEngine/Admin/Mods/*.php),
 * which are POSTed to directly and therefore cannot rely on admin.php's
 * formerly-inline helpers. Include this file after the session is started:
 *
 *   - csrf_token():  current per-session token (hex string)
 *   - csrf_field():  hidden <input> to drop into any POST <form>
 *   - csrf_verify(): abort with HTTP 403 if the POSTed token is missing/invalid
 */

// Defensive: callers normally start the session themselves, but make sure we
// have one to store the token in.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Generate the token once per session.
if (empty($_SESSION['_csrf_token'])) {
    $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
}

if (!function_exists('csrf_token')) {
    /**
     * Return the current CSRF token as a hex string.
     */
    function csrf_token(): string
    {
        return $_SESSION['_csrf_token'] ?? '';
    }

    /**
     * Emit a ready-to-use hidden <input> for any POST <form> in a template.
     * Usage in a .tpl: <?php echo csrf_field(); ?>
     */
    function csrf_field(): string
    {
        return '<input type="hidden" name="_csrf_token" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
    }

    /**
     * Render a clean, self-contained error page and stop execution (issue #299).
     *
     * The admin Mods are POSTed to directly; when the admin session is missing
     * (e.g. it was destroyed by a game logout that shares the same PHP session,
     * or the form was served from a mobile cache with a stale/empty token) the
     * old code stopped with a bare die('<h1>Access Denied</h1>') fragment, which
     * shows up as an essentially blank page. This renders a proper, styled error
     * with a way back into the panel instead.
     */
    function admin_deny(string $message, string $title = 'Access Denied', int $httpCode = 403): void
    {
        if (!headers_sent()) {
            http_response_code($httpCode);
            header('Content-Type: text/html; charset=UTF-8');
            // Never let this error page be cached (it is session-dependent).
            header('Cache-Control: no-store, no-cache, must-revalidate');
        }

        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $safeMsg   = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">'
           . '<meta name="viewport" content="width=device-width, initial-scale=1">'
           . '<title>' . $safeTitle . '</title><style>'
           . 'body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;'
           . 'font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;'
           . 'background:#0f172a;color:#e2e8f0}'
           . '.card{background:#1e293b;border:1px solid #334155;border-radius:12px;padding:32px 28px;'
           . 'max-width:420px;width:calc(100% - 32px);text-align:center;box-shadow:0 10px 30px rgba(0,0,0,.4)}'
           . '.card h1{margin:0 0 10px;font-size:20px;color:#f87171}'
           . '.card p{margin:0 0 22px;font-size:14px;line-height:1.55;color:#cbd5e1}'
           . '.card a{display:inline-block;background:#2563eb;color:#fff;text-decoration:none;'
           . 'padding:10px 18px;border-radius:8px;font-size:14px;font-weight:500}'
           . '.card a:hover{background:#1d4ed8}'
           . '</style></head><body><div class="card">'
           . '<h1>' . $safeTitle . '</h1>'
           . '<p>' . $safeMsg . '</p>'
           . '<a href="/Admin/admin.php">Return to Admin Panel</a>'
           . '</div></body></html>';
        exit;
    }

    /**
     * Verify the CSRF token of a POST request.
     * Stops execution with HTTP 403 if the token is missing or does not match.
     * Uses hash_equals() instead of === to prevent timing attacks.
     */
    function csrf_verify(): void
    {
        $submitted = isset($_POST['_csrf_token']) ? (string)$_POST['_csrf_token'] : '';
        $stored    = csrf_token();

        if ($stored === '' || !hash_equals($stored, $submitted)) {
            // Generic message — does not reveal details about the mechanism.
            admin_deny(
                'Your session may have expired or this page was loaded from cache. '
                . 'Please reload the admin panel and try again.',
                'Security Check Failed',
                403
            );
        }
    }
}
