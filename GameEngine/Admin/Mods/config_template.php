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

    // Raw template contents (placeholders untouched), or false when unavailable.
    function admin_config_template_contents() {
        $path = admin_config_template_path();
        return $path !== false ? file_get_contents($path) : false;
    }
}
