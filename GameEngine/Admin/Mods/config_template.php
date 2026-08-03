<?php

/**
 * Scrie in siguranta o valoare in sablonul de configuratie.
 *
 * DE CE EXISTA: pana acum fiecare modul facea direct
 *     $text = preg_replace("'%SERVERNAME%'", $_POST['servername'], $text);
 * adica lua valoarea din formular si o punea nefiltrata intr-un fisier PHP
 * care se include la fiecare cerere. Consecinte reale:
 *   - un nume de server cu ghilimele strica config.php (server oprit)
 *   - o valoare potrivita executa cod PHP la fiecare pagina
 *   - o constanta booleana pusa direct devenea sirul vid: define("X",);
 *
 * Aici valoarea e verificata dupa CONTEXTUL in care ajunge:
 *   'bare'   - inlocuieste cod PHP nud: se accepta doar numere si true/false
 *   'string' - ajunge intre ghilimele: se escapeaza si se taie randurile noi
 *   'code'   - fragment de cod: doar dintr-o lista alba
 *
 * $type poate fi omis: se deduce din sablon (daca placeholderul e intre
 * ghilimele => string, altfel => bare).
 */
if (!function_exists('tz_config_set')) {

    function tz_config_detect_type($text, $placeholder)
    {
        $q = preg_quote($placeholder, '/');

        // %X% intre ghilimele simple sau duble => context de sir
        if (preg_match('/["\']\s*' . $q . '\s*["\']/', $text)) {
            return 'string';
        }

        return 'bare';
    }

    function tz_config_sanitize($value, $type)
    {
        if ($type === 'bare') {
            if (is_bool($value)) {
                return $value ? 'true' : 'false';
            }

            $v = trim((string) $value);

            // Booleeni. Formularele din panou trimit "True"/"False" cu majuscula
            // (asa sunt scrise <option value="True">), iar instalarea trimite
            // "true"/"false". Le acceptam pe toate si le normalizam la litere
            // mici, care e forma canonica in PHP.
            $lower = strtolower($v);

            if ($lower === 'true' || $lower === 'false') {
                return $lower;
            }

            // Numere simple.
            if (preg_match('/^-?\d+(\.\d+)?$/', $v)) {
                return $v;
            }

            // Expresii aritmetice din constante de timp, ca "(3600*24*7)" pentru
            // intervalul de medalii. Le acceptam pentru ca sunt in config-ul
            // livrat si sunt lizibile, dar STRICT: doar cifre, + - * / ( ) si
            // spatii. Nimic care sa poata apela o functie sau citi o variabila.
            if (preg_match('/^[0-9+\-*\/() ]+$/', $v) && preg_match('/[0-9]/', $v)) {
                return $v;
            }

            // Orice altceva ar fi cod. Nu punem direct 0, fiindca o valoare ca
            // SPEED=0 ar strica jocul; convertim la intreg, ceea ce pastreaza
            // partea numerica de la inceput ("1); system(...)" -> 1) si e mereu
            // un literal sigur.
            return (string) (int) $v;
        }

        if ($type === 'code') {
            $allowed = array(
                'error_reporting (E_ALL ^ E_NOTICE);',
                'error_reporting (E_ALL ^ E_NOTICE ^ E_DEPRECATED);',
                'error_reporting (0);',
            );

            $v = trim((string) $value);

            return in_array($v, $allowed, true) ? $v : 'error_reporting (0);';
        }

        // context de sir: scoatem randurile noi si caracterele de control, apoi
        // escapam ce ar putea inchide sirul sau introduce interpolare
        $v = (string) $value;
        $v = preg_replace('/[\x00-\x1F\x7F]/', '', $v);

        return addcslashes($v, "\\'\"$");
    }

    /**
     * Inlocuieste un placeholder cu o valoare curatata.
     * Se foloseste in locul apelurilor preg_replace directe din module.
     */
    function tz_config_set(&$text, $placeholder, $value, $type = null)
    {
        if (strpos($text, $placeholder) === false) {
            return false;
        }

        if ($type === null) {
            $type = tz_config_detect_type($text, $placeholder);
        }

        $text = str_replace($placeholder, tz_config_sanitize($value, $type), $text);

        return true;
    }
}


/**
 * Pachetele grafice disponibile pe server.
 *
 * Un director din gpack/ conteaza ca pachet valid daca are travian.css - acelasi
 * criteriu pe care il verifica si jocul cand incarca stilurile. Se intoarce o
 * lista cale => nume afisabil, folosita atat de panoul de administrare, cat si de
 * pagina de profil a jucatorului.
 */
if (!function_exists('tz_available_gpacks')) {
    function tz_available_gpacks($root = null)
    {
        $root = $root ?: dirname(__DIR__, 3) . '/gpack';
        $out  = array();

        if (!is_dir($root)) {
            return $out;
        }

        foreach (scandir($root) as $dir) {
            if ($dir === '.' || $dir === '..' || $dir === 'download') {
                continue;
            }

            if (!is_dir($root . '/' . $dir) || !is_file($root . '/' . $dir . '/travian.css')) {
                continue;
            }

            $label = ucwords(str_replace('_', ' ', $dir));
            $out['gpack/' . $dir . '/'] = $label;
        }

        return $out;
    }
}
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
    // $overrides permite unui mod de editare sa IMPUNA o valoare pentru un
    // placeholder pe care altfel l-am pastra din constanta curenta (ex.
    // editServerSet care schimba HERO_BASE_REGEN). Celelalte module apeleaza
    // fara argumente si valorile curente raman neatinse.
    function admin_config_template_contents(array $overrides = array()) {
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

        // regenerarea de baza a eroului: acelasi tratament, sa nu fie resetata
        $cleanupDefaults['%HEROBASEREGEN%'] = array('HERO_BASE_REGEN', 10);
        $cleanupDefaults['%HEROSILVERPERGOLD%'] = array('HERO_SILVER_PER_GOLD', 10);
        $cleanupDefaults['%HEROSILVERTOGOLD%']  = array('HERO_SILVER_TO_GOLD', 25);
        $cleanupDefaults['%HERORESALL%'] = array('HERO_RES_PER_POINT_ALL', 3);
        $cleanupDefaults['%HERORESONE%'] = array('HERO_RES_PER_POINT_ONE', 10);

        foreach ($overrides as $ovPlaceholder => $ovValue) {
            if (strpos($text, $ovPlaceholder) !== false) {
                $text = str_replace($ovPlaceholder, (string) $ovValue, $text);
            }
        }

        // Comutatoare adaugate dupa modelul lui %GP%: bonusurile de alianta si
        // statisticile grafice Plus.
        //
        // BUG REPARAT: aceste placeholdere erau rezolvate DOAR de
        // editNewFunctions. Orice alta pagina din panou (Server Configuration,
        // Log Settings, PLUS Settings, NewsBox, Admin Info, Extra Settings)
        // regenereaza si ea config.php din acelasi sablon, dar le lasa
        // neinlocuite - deci in config ajungea
        //     define("NEW_FUNCTIONS_ALLIANCE_BONUSES", %ALLIANCEBONUSES%);
        // adica eroare de parsare si server cazut cu 500 pana la reparare
        // manuala a fisierului.
        //
        // Ca si la %GP%, blocul de aici e doar REZERVA: pastreaza valoarea
        // curenta pentru modulele care nu trimit nimic. Modulul care chiar
        // detine setarea o trimite prin $overrides, iar bucla de mai sus
        // ruleaza INAINTE, deci alegerea adminului are intaietate.
        $boolFallbacks = array(
            '%ALLIANCEBONUSES%' => 'NEW_FUNCTIONS_ALLIANCE_BONUSES',
            '%PLUSSTATS%'       => 'NEW_FUNCTIONS_PLUS_STATISTICS',
        );

        foreach ($boolFallbacks as $ovPlaceholder => $constant) {
            if (strpos($text, $ovPlaceholder) === false) {
                continue;
            }

            $value = (defined($constant) && constant($constant)) ? 'true' : 'false';
            $text  = str_replace($ovPlaceholder, $value, $text);
        }

        // Setarile numerice ale statisticilor, tot ca rezerva.
        $numFallbacks = array(
            '%PLUSSTATSHOURS%' => array('PLUS_STATS_INTERVAL_HOURS', 6),
            '%PLUSSTATSKEEP%'  => array('PLUS_STATS_KEEP_DAYS', 0),
        );

        foreach ($numFallbacks as $ovPlaceholder => $info) {
            if (strpos($text, $ovPlaceholder) === false) {
                continue;
            }

            list($constant, $default) = $info;
            $value = defined($constant) ? constant($constant) : $default;
            $text  = str_replace($ovPlaceholder, (string) $value, $text);
        }

        // Pachetul grafic si comutatorul de pachete proprii.
        //
        // ATENTIE LA ORDINE: acest bloc trebuie sa ruleze DUPA bucla de
        // override-uri de mai sus. Rulat inainte, ar inlocui %GP% cu valoarea
        // CURENTA din config, iar override-ul trimis de editServerSet (alegerea
        // adminului) nu ar mai avea ce inlocui - deci comutatorul parea ca se
        // intoarce singur pe Disabled la fiecare salvare.
        //
        // Rolul blocului e doar de REZERVA, pentru modulele care nu trimit
        // aceste valori (editNewFunctions, editPlusSet etc.): ele trebuie sa
        // pastreze setarea existenta, nu s-o piarda.
        //
        // Valoarea se scrie explicit ca 'true'/'false'. Inainte, trei module
        // puneau direct constanta GP_ENABLE in preg_replace; cand era false,
        // PHP o convertea la sirul vid si in config ajungea
        // define("GP_ENABLE",); - eroare de parsare care dobora serverul.
        if (strpos($text, '%GP%') !== false) {
            $gpEnable = (defined('GP_ENABLE') && GP_ENABLE) ? 'true' : 'false';
            $text = str_replace('%GP%', $gpEnable, $text);
        }

        if (strpos($text, '%GP_LOCATE%') !== false) {
            $gpLocate = defined('GP_LOCATE') ? GP_LOCATE : 'gpack/travian_default/';
            $text = str_replace('%GP_LOCATE%', $gpLocate, $text);
        }

        foreach ($cleanupDefaults as $placeholder => $info) {
            if (strpos($text, $placeholder) === false) {
                continue;
            }

            list($constant, $default) = $info;
            $value = defined($constant) ? (int) constant($constant) : $default;
            $text  = str_replace($placeholder, (string) $value, $text);
        }

        /**
         * PLASA DE SIGURANTA: orice placeholder ramas se rezolva din constanta
         * pe care o defineste chiar linia lui.
         *
         * De ce e nevoie: fiecare pagina din panou regenereaza INTREG config.php
         * din acelasi sablon, dar rezolva doar setarile ei. O setare noua,
         * tratata de un singur modul, ramanea literala cand salvai din alta
         * pagina:
         *     define("NEW_FUNCTIONS_ALLIANCE_BONUSES", %ALLIANCEBONUSES%);
         * adica eroare de parsare si 500 pe tot serverul, pana la reparare
         * manuala a fisierului. Ni s-a intamplat de trei ori: %GP%,
         * %ALLIANCEBONUSES% si %NATARS_WW_START_DELAY%.
         *
         * Listele de mai sus raman - sunt explicite si mai lizibile. Blocul asta
         * prinde ce scapa, ca urmatoarea setare adaugata sa nu mai poata sparge
         * serverul. Ruleaza ULTIMUL, deci nu suprascrie nimic rezolvat inainte.
         */
        if (preg_match_all('/^\s*define\(\s*["\']([A-Z0-9_]+)["\']\s*,\s*(.*?%[A-Z0-9_]+%.*?)\s*\)\s*;/m',
                $text, $leftovers, PREG_SET_ORDER)) {

            foreach ($leftovers as $row) {
                $constant = $row[1];

                if (!preg_match('/%[A-Z0-9_]+%/', $row[2], $ph)) {
                    continue;
                }

                if (!defined($constant)) {
                    // Constanta nu exista inca (prima instalare, sau setare noua
                    // adaugata in sablon dar nu si in config-ul curent). Punem o
                    // valoare neutra, ca fisierul sa ramana PHP valid.
                    $value = 'false';
                } else {
                    $current = constant($constant);

                    if (is_bool($current)) {
                        $value = $current ? 'true' : 'false';
                    } elseif (is_int($current) || is_float($current)) {
                        $value = (string) $current;
                    } else {
                        // Sir: pastram ghilimelele din sablon daca exista deja,
                        // altfel le adaugam noi.
                        $quoted = (strpos($row[2], '"' . $ph[0] . '"') !== false)
                               || (strpos($row[2], "'" . $ph[0] . "'") !== false);

                        $safe  = addcslashes((string) $current, "\"\\\$");
                        $value = $quoted ? $safe : '"' . $safe . '"';
                    }
                }

                $text = str_replace($ph[0], $value, $text);

                error_log('[TravianZ] config: placeholder ' . $ph[0]
                    . ' nerezolvat de niciun modul, completat din ' . $constant);
            }
        }

        return $text;
    }
}
