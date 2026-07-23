<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : cron.php                                                   ##
##  Type           : Standalone automation runner (P2 - performance)           ##
## --------------------------------------------------------------------------- ##
##  Scop           : Ruleaza Automation.php separat de request-urile           ##
##                   jucatorilor. Se apeleaza dintr-un cron job cPanel la      ##
##                   fiecare minut, astfel incat procesarea (batalii, miscari, ##
##                   antrenamente) nu mai e carata de pagina unui jucator.     ##
## --------------------------------------------------------------------------- ##
##  Instalare cron cPanel (la fiecare minut):                                  ##
##    * * * * * /usr/bin/php /home/USER/public_html/cron.php >/dev/null 2>&1    ##
##  sau prin wget/curl daca php-cli nu e disponibil:                           ##
##    * * * * * wget -q -O /dev/null "https://DOMENIU/cron.php?key=SECRET"      ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
#################################################################################

// -----------------------------------------------------------------------------
// 1. Detectare mod de rulare
//    - CLI (php cron.php): mereu permis, e apelat doar de cron-ul serverului.
//    - HTTP (wget/curl): permis DOAR daca cheia din config se potriveste, ca sa
//      nu poata declansa oricine automation-ul de pe internet.
// -----------------------------------------------------------------------------
$isCli = (PHP_SAPI === 'cli');

// -----------------------------------------------------------------------------
// 2. Bootstrap minimal - NU includem Session.php (porneste sesiune, se leaga de
//    request si de un user logat). Automation are nevoie doar de config (constante
//    SQL_*, TB_PREFIX, AUTOMATION_LOCK_FILE_NAME) si de $database; restul (buidata,
//    unitdata, Units, Battle, etc.) si le include Automation.php singur.
// -----------------------------------------------------------------------------
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

require_once($autoprefix . 'autoloader.php');

if (!file_exists($autoprefix . 'GameEngine/config.php')) {
    // instalarea nu e finalizata - nu avem ce rula
    if ($isCli) { fwrite(STDERR, "cron: config.php lipseste, jocul nu e instalat\n"); }
    exit(1);
}

include_once($autoprefix . 'GameEngine/config.php');

// -----------------------------------------------------------------------------
// 3. Verificare cheie pentru accesul HTTP (nu se aplica in CLI)
//    Defineste in GameEngine/config.php:  define('CRON_KEY', 'un-secret-lung');
//    Apoi apeleaza:  https://domeniu/cron.php?key=un-secret-lung
//    Daca CRON_KEY nu e definit, accesul HTTP este refuzat (doar CLI merge).
// -----------------------------------------------------------------------------
if (!$isCli) {
    $providedKey = isset($_GET['key']) ? (string)$_GET['key'] : '';
    if (!defined('CRON_KEY') || CRON_KEY === '' || !hash_equals(CRON_KEY, $providedKey)) {
        header('HTTP/1.1 403 Forbidden');
        exit('Forbidden');
    }
    // nu tinem conexiunea deschisa pentru client - raspundem si continuam in fundal
    ignore_user_abort(true);
    @set_time_limit(0);
    header('Content-Type: text/plain');
    echo "OK\n";
    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }
}

// -----------------------------------------------------------------------------
// 4. Conexiune la baza de date (acelasi mod ca in Database.php - variabila globala
//    $database folosita de Automation prin "global $database").
// -----------------------------------------------------------------------------
include_once($autoprefix . 'GameEngine/Database.php');

if (!isset($database) || !$database) {
    if ($isCli) { fwrite(STDERR, "cron: conexiunea la baza de date a esuat\n"); }
    exit(1);
}

// -----------------------------------------------------------------------------
// 5. Marcam ca suntem sursa oficiala de automation. AUTOMATION_MANUAL_RUN spune
//    Automation.php sa NU mai treaca prin gardul de lock file (acela era pentru
//    coordonarea request-urilor concurente ale jucatorilor; cron-ul e sursa unica,
//    o data pe minut, deci nu are nevoie de el).
//
//    In plus scriem un marker cu timestamp, ca Village.php sa stie ca exista un
//    cron activ si sa NU mai declanseze automation din paginile jucatorilor
//    (fallback: daca cron-ul se opreste > 90s, paginile preiau automat).
// -----------------------------------------------------------------------------
if (!defined('AUTOMATION_MANUAL_RUN')) {
    define('AUTOMATION_MANUAL_RUN', true);
}

$cronMarker = $autoprefix . 'GameEngine/Prevention/cron_active.txt';
@file_put_contents($cronMarker, (string)time(), LOCK_EX);

// -----------------------------------------------------------------------------
// 6. Rulam automation-ul propriu-zis. Constructorul din Automation.php face toata
//    treaba (procNewClimbers, buildComplete, trainingComplete, batalii, miscari...).
// -----------------------------------------------------------------------------
include_once($autoprefix . 'GameEngine/Automation.php');

if ($isCli) {
    echo "cron: automation rulat la " . date('Y-m-d H:i:s') . "\n";
}
