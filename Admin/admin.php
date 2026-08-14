<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       05.03.2026                                                  ##
##  Filename:      Admin/admin.php                                             ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

// Multi-instance bootstrap MUST run before session_start() so each world gets
// its own session name and its own configuration before Admin loads the DB.
require_once __DIR__ . "/../GameEngine/Instance/Bootstrap.php";

// ─── SESSION ─────────────────────────────────────────────────────────────────
// Harden session cookie before session_start() — has no effect after.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

// ─── CSRF PROTECTION ──────────────────────────────────────────────────────────
// Token init + csrf_token()/csrf_field()/csrf_verify() helpers, shared with the
// admin Mods (which are POSTed to directly). See GameEngine/Admin/csrf.php.
include_once("../GameEngine/Admin/csrf.php");

// ─── CORE INCLUDES ───────────────────────────────────────────────────────────
// Bootstrap already selected the authoritative instance config. Keep this
// include for backwards compatibility with the existing Admin bootstrap.
include_once("../GameEngine/config.php");
include_once("../GameEngine/Database.php");
require_once __DIR__ . "/../GameEngine/Lang/loader.php";
tz_load_language(LANG);
include_once("../GameEngine/Admin/database.php");

// Helperul care descopera pachetele grafice din gpack/ (tz_available_gpacks).
// Sabloanele panoului il folosesc pentru selectorul de pachet; fara acest
// include, functia nu exista la randare si lista arata doar pachetul curent.
include_once("../GameEngine/Admin/Mods/config_template.php");
include_once("../GameEngine/Data/buidata.php");
include_once("../GameEngine/Artifacts.php");
include_once("../GameEngine/MultiAccount.php");
include_once("../GameEngine/PushProtection.php");
include_once("../GameEngine/RegBlock.php");
include_once("../GameEngine/Heatmap.php");
include_once("../GameEngine/GoldShop.php");
include_once("../GameEngine/QuestConfig.php");

// ─── SECURITY HELPERS ────────────────────────────────────────────────────────

/**
 * Return a sanitised integer from a superglobal key, or null if missing/invalid.
 * Replaces direct (int) casts on $_GET inside switch — ensures 0 is treated as
 * absent (IDs are always >= 1 in TravianZ).
 */
function admin_input_id(array $source, string $key): ?int
{
    if (!isset($source[$key]) || !ctype_digit((string)$source[$key])) {
        return null;
    }
    $v = (int)$source[$key];
    return $v > 0 ? $v : null;
}

/**
 * HTML-escape a value for safe output inside HTML attributes or text nodes.
 */
function e(string $value): string
{
    // decode first prevents &amp;#39; / &#39; double encoding
    return htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'),
        ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
