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
     * Verify the CSRF token of a POST request.
     * Stops execution with HTTP 403 if the token is missing or does not match.
     * Uses hash_equals() instead of === to prevent timing attacks.
     */
    function csrf_verify(): void
    {
        $submitted = isset($_POST['_csrf_token']) ? (string)$_POST['_csrf_token'] : '';
        $stored    = csrf_token();

        if ($stored === '' || !hash_equals($stored, $submitted)) {
            http_response_code(403);
            // Generic message — does not reveal details about the mechanism.
            die('<h1>403 Forbidden</h1><p>Invalid or missing security token. Please go back and try again.</p>');
        }
    }
}
