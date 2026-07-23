<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : AutomationCleanup.php                                     ##
##  Type           : Automation - periodic database cleanup (P3 - performance) ##
## --------------------------------------------------------------------------- ##
##  Scop           : Tabelele care cresc nelimitat (rapoarte de lupta, chat,   ##
##                   mesaje sterse de ambele parti) incetinesc in timp intreg  ##
##                   serverul si umfla backup-urile. Aici le taiem periodic,   ##
##                   dupa reguli de retentie configurabile.                    ##
## --------------------------------------------------------------------------- ##
##  Reglaje in GameEngine/config.php (0 = dezactivat pentru fiecare):          ##
##    define('CLEANUP_REPORTS_DAYS', 14);   // rapoarte NEARHIVATE mai vechi   ##
##    define('CLEANUP_CHAT_DAYS', 7);       // mesaje de chat mai vechi        ##
##    define('CLEANUP_MESSAGES_DAYS', 0);   // mesaje sterse de AMBELE parti   ##
##    define('CLEANUP_INTERVAL', 3600);     // la cat timp ruleaza curatenia   ##
##    define('CLEANUP_BATCH', 5000);        // randuri sterse per tabel/rulare ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
#################################################################################

trait AutomationCleanup {

    /**
     * Curatenie periodica in tabelele care cresc nelimitat.
     *
     * Rulata din lista de metode a constructorului, deci ar fi apelata la
     * fiecare tick. Nu vrem asta: stergerile sunt scumpe, iar datele nu se
     * strang atat de repede. De aceea metoda are propriul interval (implicit o
     * data pe ora), tinut intr-un fisier marker din Prevention/.
     *
     * Stergerile sunt facute in LOTURI (LIMIT), ca sa nu blocam tabelele minute
     * intregi la prima rulare pe un server vechi cu milioane de randuri: ce nu
     * intra intr-o rulare se sterge la urmatoarele, pana se ajunge din urma.
     */
    private function cleanupOldData() {

        global $database;

        $interval = defined('CLEANUP_INTERVAL') ? (int) CLEANUP_INTERVAL : 3600;

        if ($interval < 60) {
            $interval = 60;
        }

        $markerFile = __DIR__ . '/../Prevention/cleanup_last.txt';
        $lastRun    = 0;

        if (@is_file($markerFile)) {
            $raw = @json_decode((string) @file_get_contents($markerFile), true);

            if (is_array($raw) && isset($raw['time'])) {
                $lastRun = (int) $raw['time'];
            }
        }

        if ($lastRun > 0 && (time() - $lastRun) < $interval) {
            return;
        }

        $batch = defined('CLEANUP_BATCH') ? (int) CLEANUP_BATCH : 5000;

        if ($batch < 100)    { $batch = 100; }
        if ($batch > 100000) { $batch = 100000; }

        $removed = array(
            'reports'  => 0,
            'chat'     => 0,
            'messages' => 0,
        );

        // --- Rapoarte de lupta ------------------------------------------------
        // Se sterg doar cele NEARHIVATE: arhivarea e alegerea explicita a
        // jucatorului de a pastra un raport, deci nu o calcam.
        // Coloana `time` e indexata, deci stergerea e ieftina.
        $reportDays = defined('CLEANUP_REPORTS_DAYS') ? (int) CLEANUP_REPORTS_DAYS : 14;

        if ($reportDays > 0) {
            $cutoff = time() - ($reportDays * 86400);

            $q = "DELETE FROM " . TB_PREFIX . "ndata
                  WHERE archive = 0 AND `time` < " . $cutoff . "
                  LIMIT " . $batch;

            if (mysqli_query($database->dblink, $q)) {
                $removed['reports'] = mysqli_affected_rows($database->dblink);
            }
        }

        // --- Chat --------------------------------------------------------------
        // ATENTIE: coloana `date` e varchar, dar contine un timestamp unix scris
        // de Chat::add_data() (time()). Comparatia se face pe valoarea numerica.
        // Chat-ul afiseaza oricum doar ultimele 13 mesaje per alianta, deci
        // istoricul vechi nu e folosit nicaieri.
        $chatDays = defined('CLEANUP_CHAT_DAYS') ? (int) CLEANUP_CHAT_DAYS : 7;

        if ($chatDays > 0) {
            $cutoff = time() - ($chatDays * 86400);

            $q = "DELETE FROM " . TB_PREFIX . "chat
                  WHERE (`date` + 0) < " . $cutoff . "
                  LIMIT " . $batch;

            if (mysqli_query($database->dblink, $q)) {
                $removed['chat'] = mysqli_affected_rows($database->dblink);
            }
        }

        // --- Mesaje sterse de ambele parti -------------------------------------
        // Implicit DEZACTIVAT (0). Un mesaj cu deltarget = 1 SI delowner = 1 nu
        // mai e vizibil nici expeditorului, nici destinatarului, deci purjarea
        // lui nu se vede in joc. Activeaza din config daca vrei.
        $messageDays = defined('CLEANUP_MESSAGES_DAYS') ? (int) CLEANUP_MESSAGES_DAYS : 0;

        if ($messageDays > 0) {
            $cutoff = time() - ($messageDays * 86400);

            $q = "DELETE FROM " . TB_PREFIX . "mdata
                  WHERE deltarget = 1 AND delowner = 1 AND `time` < " . $cutoff . "
                  LIMIT " . $batch;

            if (mysqli_query($database->dblink, $q)) {
                $removed['messages'] = mysqli_affected_rows($database->dblink);
            }
        }

        // Marker + ultimul rezultat (citit de panoul de admin pentru afisare).
        @file_put_contents(
            $markerFile,
            json_encode(array(
                'time'    => time(),
                'removed' => $removed,
            )),
            LOCK_EX
        );
    }
}
