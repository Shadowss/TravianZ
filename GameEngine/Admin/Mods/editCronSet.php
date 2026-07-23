<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editCronSet.php                                             ##
##  Type           Admin Panel - Cron & Automation settings                    ##
## --------------------------------------------------------------------------- ##
##  Contact        cata7007@gmail.com                                          ##
##  Project        TravianZ                                                    ##
##  GitHub         https://github.com/Shadowss/TravianZ                        ##
##  License        TravianZ Project                                            ##
##  Copyright      TravianZ (c) 2010-2026. All rights reserved.                ##
## --------------------------------------------------------------------------- ##
##  NOTA DE PROIECTARE - de ce acest mod NU regenereaza tot config.php:        ##
##    Celelalte module edit*.php reconstruiesc config.php din constant_format  ##
##    .tpl si trebuie sa reumple TOATE placeholderele (peste 100). Aici avem   ##
##    de schimbat trei valori, iar o gresala intr-o mapare fara legatura ar    ##
##    strica setari de joc. De aceea modificam DOAR liniile de cron din        ##
##    config.php existent; restul fisierului ramane bit-cu-bit neatins.        ##
##    Daca liniile lipsesc (server instalat inainte de aceasta versiune), ele  ##
##    sunt inserate dupa AUTOMATION_LOCK_FILE_NAME.                            ##
#################################################################################

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['access'] < 9) {
    die(ACCESS_DENIED_ADMIN);
}

// Acest mod primeste POST direct, deci isi verifica singur tokenul CSRF
// (nu trece prin csrf_verify()-ul central din admin.php). Vezi issue #139.
require_once(__DIR__ . '/../csrf.php');
csrf_verify();

include_once("../../Database.php");

$id = (int) $_POST['id'];

// ---------------------------------------------------------------------------
// Validarea valorilor primite
// ---------------------------------------------------------------------------
$loop = isset($_POST['cron_loop']) ? (int) $_POST['cron_loop'] : 300;
$tick = isset($_POST['cron_tick']) ? (int) $_POST['cron_tick'] : 60;

// 0 = o singura rulare per invocare (host care permite cron la fiecare minut).
// Peste 0, limitam la 55 de minute ca sa nu ramana procese agatate.
if ($loop < 0)    { $loop = 0; }
if ($loop > 3300) { $loop = 3300; }

// Automation se asteapta sa ruleze pe la 60s; sub 15s doar incarcam serverul.
if ($tick < 15)  { $tick = 15; }
if ($tick > 900) { $tick = 900; }

// Un ciclu care nu incape nici macar un tick nu are sens - il tratam ca "o
// singura rulare", ca sa nu iasa o configuratie care pare activa dar nu e.
if ($loop > 0 && $loop < $tick) {
    $loop = 0;
}

$regenerateKey = !empty($_POST['regenerate_key']);

$cronKey = (defined('CRON_KEY') && CRON_KEY !== '' && CRON_KEY !== '%CRONKEY%')
    ? CRON_KEY
    : '';

if ($regenerateKey || $cronKey === '') {
    $cronKey = bin2hex(random_bytes(24));
}

// ---------------------------------------------------------------------------
// Editarea chirurgicala a fisierului de configuratie
// ---------------------------------------------------------------------------
$configFile = "../../config.php";
$config     = @file_get_contents($configFile);

if ($config === false) {
    die("<br/><br/><br/>Can't read file: GameEngine\\config.php");
}

/**
 * Inlocuieste valoarea unei constante daca linia exista; altfel intoarce false
 * ca apelantul sa stie ca trebuie inserata.
 *
 * $rawValue se scrie exact asa cum e dat (deja citat pentru siruri).
 */
function cron_set_define(&$text, $constant, $rawValue)
{
    $pattern = "/define\s*\(\s*(['\"])" . preg_quote($constant, '/') . "\\1\s*,.*?\)\s*;/s";

    if (!preg_match($pattern, $text)) {
        return false;
    }

    // str_replace pe potrivirea gasita, ca sa nu interpretam $ sau \ din valoare
    // ca referinte de grup (capcana clasica a lui preg_replace).
    preg_match($pattern, $text, $m);
    $text = str_replace($m[0], "define('" . $constant . "', " . $rawValue . ");", $text);

    return true;
}

$missing = array();

if (!cron_set_define($config, 'CRON_LOOP_SECONDS', (string) $loop)) {
    $missing[] = "define('CRON_LOOP_SECONDS', " . $loop . ");";
}

if (!cron_set_define($config, 'CRON_TICK_SECONDS', (string) $tick)) {
    $missing[] = "define('CRON_TICK_SECONDS', " . $tick . ");";
}

if (!cron_set_define($config, 'CRON_KEY', "'" . addcslashes($cronKey, "'\\") . "'")) {
    $missing[] = "define('CRON_KEY', '" . addcslashes($cronKey, "'\\") . "');";
}

// Server instalat inainte ca aceste constante sa existe: le adaugam dupa
// AUTOMATION_LOCK_FILE_NAME (locul lor din template).
if (!empty($missing)) {
    $anchorPattern = "/define\s*\(\s*(['\"])AUTOMATION_LOCK_FILE_NAME\\1\s*,.*?\)\s*;/s";

    $block = "\n\n//////////////////////////////////\n"
           . "// *****  CRON / AUTOMATION *****//\n"
           . "//////////////////////////////////\n"
           . implode("\n", $missing);

    if (preg_match($anchorPattern, $config, $anchor)) {
        $config = str_replace($anchor[0], $anchor[0] . $block, $config);
    } else {
        // fara ancora: adaugam la finalul fisierului, inaintea eventualului
        // tag de inchidere PHP (atentie: nu-l scriem literal in comentariu,
        // fiindca intr-un comentariu "//" ar inchide chiar blocul PHP curent)
        $config = preg_replace('/\?>\s*$/', '', $config) . $block . "\n";
    }
}

$fh = @fopen($configFile, 'w') or die("<br/><br/><br/>Can't open file: GameEngine\\config.php");
fwrite($fh, $config);
fclose($fh);

$database->query(
    "Insert into " . TB_PREFIX . "admin_log values (0," . $id . ",'Changed Cron & Automation Settings'," . time() . ")"
);

header("Location: ../../../Admin/admin.php?p=config");
