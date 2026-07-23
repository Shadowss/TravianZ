<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config_template.php                                         ##
##  Project        TravianZ                                                     ##
##  License        TravianZ Project                                            ##
#################################################################################

// Shared helper for the admin "Server Settings" Mods, which regenerate
// GameEngine/config.php from the constant_format.tpl template.
//
// Issue #322: each Mod used to read the install-time copy
// GameEngine/Admin/Mods/constant_format.tpl. That copy is written once by the
// installer and is gitignored, so a code update NEVER refreshes it. When a new
// line is added to config.php (e.g. the per-user LANG block, issue #166),
// servers installed before that change keep the stale copy and the admin panel
// silently rewrites config.php without the new line.
//
// Fix: prefer the version-controlled template (install/data/constant_format.tpl)
// so shipping a new template via git is enough. Fall back to the install-time
// copy only when the install folder was deleted (a common hardening step once
// setup is done).

if (!function_exists('admin_config_template_path')) {

    // Absolute path of the template to use, or false when none is available.
    function admin_config_template_path() {
        $canonical = __DIR__ . '/../../../install/data/constant_format.tpl';
        if (is_file($canonical)) {
            return $canonical;
        }

        $local = __DIR__ . '/constant_format.tpl';
        return is_file($local) ? $local : false;
    }

    function admin_config_template_available() {
        return admin_config_template_path() !== false;
    }

    // Raw template contents, or false when unavailable.
    //
    // Placeholders are left untouched for the caller to fill in, with ONE
    // exception: %CRONKEY%. Every edit*.php mod regenerates config.php from this
    // template and replaces only the placeholders it knows about, so a value that
    // no mod handles would be written to config.php literally — breaking the key
    // used to call cron.php over HTTP. CRON_KEY is not something the admin edits
    // in any of those forms, so it is resolved here, once, for all callers:
    //   - existing server  -> keep the current CRON_KEY (survives config saves)
    //   - key not defined  -> provision a fresh random one (servers installed
    //                         before CRON_KEY existed in the template)
    function admin_config_template_contents() {
        $path = admin_config_template_path();

        if ($path === false) {
            return false;
        }

        $text = file_get_contents($path);

        if ($text === false) {
            return false;
        }

        if (strpos($text, '%CRONKEY%') !== false) {
            $cronKey = (defined('CRON_KEY') && CRON_KEY !== '' && CRON_KEY !== '%CRONKEY%')
                ? CRON_KEY
                : bin2hex(random_bytes(24));

            $text = str_replace('%CRONKEY%', $cronKey, $text);
        }

        // Acelasi tratament pentru durata ciclului si intervalul de tick: sunt
        // editate din ACP (editCronSet), deci orice alt mod care regenereaza
        // config.php trebuie sa PASTREZE valorile curente, nu sa le reseteze la
        // cele din template.
        if (strpos($text, '%CRONLOOP%') !== false) {
            $cronLoop = defined('CRON_LOOP_SECONDS') ? (int) CRON_LOOP_SECONDS : 300;
            $text = str_replace('%CRONLOOP%', (string) $cronLoop, $text);
        }

        if (strpos($text, '%CRONTICK%') !== false) {
            $cronTick = defined('CRON_TICK_SECONDS') ? (int) CRON_TICK_SECONDS : 60;
            $text = str_replace('%CRONTICK%', (string) $cronTick, $text);
        }

        // Retentiile de curatenie: la fel, editate din ACP, deci orice alt mod
        // care regenereaza config.php trebuie sa le pastreze.
        $cleanupDefaults = array(
            '%CLEANUPREPORTS%'  => array('CLEANUP_REPORTS_DAYS', 14),
            '%CLEANUPCHAT%'     => array('CLEANUP_CHAT_DAYS', 7),
            '%CLEANUPMESSAGES%' => array('CLEANUP_MESSAGES_DAYS', 0),
        );

        foreach ($cleanupDefaults as $placeholder => $info) {
            if (strpos($text, $placeholder) === false) {
                continue;
            }

            list($constant, $default) = $info;
            $value = defined($constant) ? (int) constant($constant) : $default;
            $text  = str_replace($placeholder, (string) $value, $text);
        }

        return $text;
    }
}
